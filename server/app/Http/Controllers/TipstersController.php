<?php

namespace App\Http\Controllers;

use App\Common\Common;
use App\Common\RoleCommon;
use App\Common\Utils;
use App\Model\Gift;
use App\Model\Lead;
use App\Model\PointHistory;
use App\Model\Product;
use App\Model\Region;
use App\Model\Role;
use App\Model\RoleType;
use App\User;
use App\Model\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Log;
use Illuminate\Support\Facades\Mail;
use Mockery\Exception;

class TipstersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $users = User::getAllTipster();

        $auth = Auth::user();
        $roleAuth = Role::getInfoRoleByID($auth->role_id);
        $roletypeAuth = RoleType::getNameByID($roleAuth->roletype_id);
        $editAction = false;
        $deleteAction = false;
        $createAction = false;

        if(RoleCommon::checkRoleCommunity() || RoleCommon::checkRoleAdmin() || RoleCommon::checkRoleAmbassador()){
            $editAction = true;
            $deleteAction = true;
            $createAction = true;
        }

        if(RoleCommon::checkRoleaConsultant()){
            $editAction = true;
        }

        return view('tipsters.index', [
            'users' => $users,
            'editAction' => $editAction,
            'deleteAction' => $deleteAction,
            'createAction' => $createAction
            ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $auth = Auth::user();
        $roleAuth = Role::getInfoRoleByID($auth->role_id);
        $roletypeAuth = RoleType::getNameByID($roleAuth->roletype_id);
        $createAction = false;
        if(RoleCommon::checkRoleCommunity() || RoleCommon::checkRoleAdmin() || RoleCommon::checkRoleAmbassador()){
            $createAction = true;
        }

        $roles = Role::all();
        $roletypes = RoleType::where('code', 'tipster')->get();
        $regions = Region::getAllRegion();
        return view('tipsters.create')->with([
            'roles' => $roles,
            'roletypes' => $roletypes,
            'regions'=> $regions,
            'createAction' =>$createAction
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $user = $this->validate(request(),[
            'username' => 'required|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'fullname' => 'required',
            'email' => 'required|string|email|max:255|unique:users',
            'birthday' => 'required|date_format:"d/m/Y"',
            'phone' => 'required',
            'region' => 'required',
            'avatar' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);
        $user['password']= bcrypt($request->password);
        $user['gender'] = $request->gender;
        $user['phone'] = $request->phone;
        $user['address'] = $request->address;
        $user['point'] = 0;
        $user['vote'] = 0;
        $user['region_id'] = $request->region;
        $user['role_id'] = $request->department;
        $user['create_by_id'] = Auth::user()->id;
        $user['delete_is'] = 0;
        $user['reference_lang'] = $request->reference_lang;
        $user['description'] = $request->description;
        if(isset($request->birthday) && null != $request->birthday){
            $user['birthday'] = \Carbon\Carbon::createFromFormat('d/m/Y',$request->birthday);
        }
        $imageName = 'no_image_available.jpg';
        if(!empty(request()->avatar)){
            $imageName = time().'.'.request()->avatar->getClientOriginalExtension();
            request()->avatar->move(Utils::pathUploadImage('images/upload'), $imageName);
        }

        $user['avatar'] = $imageName;

        User::create($user);
        return redirect()->route('tipsters.index')->with('success', 'Tipster was added successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $user = User::find($id);
        $role = Role::find($user->role_id);
        $auth = Auth::user();
        $roletype = RoleType::find($role->roletype_id);
        $roleAuth = Role::getInfoRoleByID($auth->role_id);
        $roletypeAuth = RoleType::getNameByID($roleAuth->roletype_id);
        $deleteAction = false;
        $editAction = false;

//        //get list lead belong tipster
        $leads = Lead::getAllLeadBelongTipster($id);
        foreach ($leads as $lead){
            $lead->statusLead = Common::showNameStatus($lead->status);
            $lead->create = Common::dateFormat($lead->created_at);
            $lead->product = Product::getProductByID($lead->product_id)->name;
            $point = PointHistory::getPointByTipsterIDLeadID($id, $lead->id);
            if(!empty($point)){
                $lead->point = $point->point;
            }else{
                $lead->point = 0;
            }

        }

        //Get points histories
        $histories = PointHistory::getPointByTipsterID($id);

        foreach ($histories as $history){
            $leadInfo = Lead::getLeadByID($history->lead_id);
            if (!empty($leadInfo)){
                $history['leadName'] = $leadInfo->fullname;
                $history['product'] = $leadInfo->product;
                $history['statusLead'] = Common::showNameStatus($leadInfo->status);
                $history['statusColor'] = Common::showColorStatus($leadInfo->status);
            }else{
                $history['leadName'] = '';
                $history['product'] = '';
                $history['statusLead'] = $history->activity;
                $history['statusColor'] = '';
            }
            $history['create'] = Common::dateFormat($history->created_at);

        }
        if(RoleCommon::checkRoleCommunity() || RoleCommon::checkRoleAdmin() || RoleCommon::checkRoleAmbassador() || RoleCommon::checkRoleaConsultant()){
            $deleteAction = true;
            $editAction = true;
        }
        if($user->id == $auth->id){
            $editAction = true;
        }

        //Show list lead
        $listStatus = [Utils::$lead_process_status_new,Utils::$lead_process_status_assign, Utils::$lead_process_status_call, Utils::$lead_process_status_quote];
        $leadsProcess = Lead::leadsByTipster($id, null , $listStatus);

        //Get all Gift
        $gifts = Gift::getAllGifts();
        $giftsBuyAble = Gift::getGiftBuyAble($user->point);

        return view('tipsters.show', compact('user', 'id'))->with([
            'role' => $role,
            'roletype' => $roletype,
            'deleteAction' => $deleteAction,
            'editAction' => $editAction,
            'leadsProcess' =>$leadsProcess,
            'histories' =>$histories,
            'gifts' => $gifts,
            'giftsBuyAble' => $giftsBuyAble
        ]);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $auth = Auth::user();
        $roleAuth = Role::getInfoRoleByID($auth->role_id);
        $roletypeAuth = RoleType::getNameByID($roleAuth->roletype_id);
        $editAction = false;
        $editPoints = true;
        $isAdmin = false;
        $user = User::getUserByID($id);
        if($user->birthday != null){
            $user->birthday = Common::dateFormat($user->birthday,'d/m/Y');
        }
        if(RoleCommon::checkRoleAdmin()){
            $isAdmin = true;
        }
        if(RoleCommon::checkRoleCommunity() || RoleCommon::checkRoleAdmin() || RoleCommon::checkRoleaConsultant()
            || RoleCommon::checkRoleAmbassador() || $user->id == $auth->id){
            $editAction = true;
        }
        if(RoleCommon::checkRoleTipster() || $user->id == $auth->id){
            $editPoints = false;
        }
        $roles = Role::getAllRole();
        if(RoleCommon::checkRoleTipsterNormal()){
            $roles = Role::getRoleByCode('tipster_normal');
        }

        $roletypes = RoleType::where('code', 'tipster')->get();
        $regions = Region::getAllRegion();

        return view('tipsters.edit',compact('user','id'))->with([
            'roles'=>$roles,
            'roletypes' => $roletypes,
            'regions'=> $regions,
            'editAction' => $editAction,
            'editPoints' => $editPoints,
            'isAdmin' => $isAdmin
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = request()->validate([
            'username' => 'required',
            'password' => 'required|string|min:6|confirmed',
            'email' => 'required',
            'fullname' => 'required',
            'birthday' => 'required|date_format:"d/m/Y"',
            'phone' => 'required',
            'avatar' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ],[
            'birthday.date_format' => 'The birthday does not match the format dd/mm/yyyy.'
        ]);
        $user = User::find($id);
        $username = $request->get('username');
        if($username != $user->username){
            $countUsername = User::where('username', $username)->count();
            if($countUsername > 0){
                request()->validate([
                    'username' => 'unique:users',
                ]);
            }else{
                $user->username = $username;
            }
        }

        $email = $request->get('email');
        if($email != $user->email){
            $countEmail = User::where('email', $email)->count();
            if($countEmail > 0){
                request()->validate([
                    'email' => 'unique:users',
                ]);
            }else{
                $user->email = $email;
            }
        }

        $user->fullname = $request->get('fullname');
        $user->phone = $request->get('phone');
        if(null != $request->get('birthday')){
            $user->birthday = \Carbon\Carbon::createFromFormat('d/m/Y',$request->birthday);
        }
        if($user->password != $request->get('password')){
            $user->password= bcrypt($request->get('password'));
        }
        $user->address = $request->get('address');
        $user->gender = $request->get('gender');
        $user->role_id = $request->get('department');
        $user->delete_is = $request->get('status');
        $user->preferred_lang = $request->get('preferred_lang');
        $imageName = $user->avatar;
        if(!empty(request()->avatar)){
            $imageName = time().'.'.request()->avatar->getClientOriginalExtension();

            request()->avatar->move(Utils::pathUploadImage('images/upload'), $imageName);
        }
        $user->avatar = $imageName;
        $user->description = $request->description;
        $user->save();
        return redirect()->route('tipsters.index')->with([
            'success' => 'Tipster was updated successfully.',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $tipster = User::find($id);
        $tipster->delete_is = 1;
        $tipster->save();

        return redirect()->route('tipsters.index')->with('success','Tipster was deleted successfully.');
    }

    public function updatePoint(Request $request){
        $lead_id = $request->lead;
        $tipster_id = $request->tipster;
        $pointnew = $request->point;
        $product_id = Lead::getLeadByID($lead_id)->product_id;
        //Add points, tipster, lead to point_histories
        $history['lead_id'] = $lead_id;
        $history['tipster_id'] = $tipster_id;
        $history['point'] = $pointnew;
        PointHistory::create($history);

        //Update points to Tipster
        $tipster = User::find($tipster_id);
        $tipster->point = $tipster->point + $pointnew;
        $tipster->save();
        $win = Utils::$lead_process_status_win;
        Common::sendMailChangeStatus($win,$tipster_id, $lead_id, $product_id, $pointnew);
        return redirect()->route('tipsters.index');
    }

    public function updatePointAjax(Request $request){
        //get info of ajax
        $lead_id = $request->lead;
        $tipster_id = $request->tipster;
        $newpoint = $request->point;
        $lead = Lead::getLeadByID($lead_id);
        $product_id = $lead->product_id;
        $ups = 'ups';
        $pps = 'pps';
        $response = array();
        try{
            /*Check point plussed for this tipster from lead?*/
            $countRowPlus = PointHistory::countRowPlusPointForTipsterFollowLead($lead_id, $tipster_id);

            if(isset($countRowPlus)){ /*If tipster was plussed point*/
                $warning = "This tipster was updated the point successfully.";
                $response["warning"] = $warning;
                $response["status"] = "-1";

                $historyUpdate = PointHistory::where([
                    ['lead_id', $lead_id],
                    ['tipster_id', $tipster_id]
                ])->first();
                $oldPoint = $historyUpdate->point;
                $historyUpdate['point'] = $newpoint;
                $historyUpdate->save();

                /*Update point for tipster*/
                $tipster = User::find($tipster_id);
                $tipster['point'] = $tipster['point'] - $oldPoint + $newpoint;
                $tipster->save();
                /*----------------------------------------------------
                 * Send email to tipster to notify update points
                 * ---------------------------------------------------*/
                Common::sendMailChangeStatus($ups,$tipster_id, $lead_id, $product_id, $newpoint);

            }else{/*If tipster do not plussed point yet.*/
                //Add points, tipster, lead to point_histories table
                $history['lead_id'] = $lead_id;
                $history['tipster_id'] = $tipster_id;
                $history['point'] = $newpoint;
                PointHistory::create($history);

                //Update points to Tipster
                $tipster = User::find($tipster_id);
                $tipster->point = $tipster->point + $newpoint;
                $tipster->save();

                $success = 'Added points successfully.';
                $response["status"] = "0";
                $response["success"] = $success;
                /*----------------------------------------------------
                 * Send email to tipster to notify plus points
                 * ---------------------------------------------------*/
                Common::sendMailChangeStatus($pps,$tipster_id, $lead_id, $product_id, $newpoint);
            }

        }catch(Exception $e){
            $response['error'] = $e->getMessage();
            $response["status"] = "-2";
        }

        return response()->json($response);
    }

    public function updatePointManual(Request $request, $id){
        $tipster = User::find($id);
        $actionType = $request->actionType;
        $pointsNew = $request->pointsUpdate;
        $action = $request->get('action');
        $comment = $request->get('comment');
        $history = [];
        $history['tipster_id'] = $id;
        if($actionType === 'plus'){
            $tipster->point = $tipster->point + $pointsNew;
            $history['point'] = $pointsNew;
        }elseif ($actionType === 'minus'){
            $tipster->point = $tipster->point - $pointsNew;
            $history['point'] = - $pointsNew;
        }
        $history['comment'] = $comment;
        $history['activity'] = $action;


        $data['title'] = '';
        $data['body'] = $comment;
        $emailTo = $tipster->email;
        $subjectTo = $action;
        $tipster_name = $tipster->fullname;

        try{
            //update point for tipster to users table
            $tipster->save();
            //create new row in point_stories table
            PointHistory::create($history);

            //Send info to tipster
            if(isset($request->comment) && $request->comment != ''){
                $message['author'] = Auth::user()->id;
                $message['title'] = 'Update point tipster';
                $message['content'] = $comment;
                $message['delete_is'] = 0;
                $message['read_is'] = 0;
                $message['receiver'] = $id;
                Message::create($message);
            }

            //Send email to email of tipster
            Mail::send('messagetemplates.emails.email', $data, function($message) use ($emailTo, $subjectTo, $tipster_name) {

                $message->to($emailTo, $tipster_name)
                    ->subject($subjectTo);

            });
        }catch(Exception $ex){
            Log::error($ex);
        }

        return redirect()->route('tipsters.show', $id)->with('success', 'Update points of tipster successfully.');
    }
}
