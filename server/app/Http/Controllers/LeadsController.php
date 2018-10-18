<?php

namespace App\Http\Controllers;

use App\Common\Utils;
use App\Model\Lead;
use App\Model\LeadProcess;
use App\Model\MessageTemplate;
use App\Model\PointHistory;
use App\Model\Product;
use App\Model\Region;
use App\Model\Role;
use App\Model\RoleType;
use App\Model\Assignment;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Mockery\Exception;
use App\Common\Common;
use App\Common\RoleCommon;
use App\User;
use Validator;

class LeadsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $auth = Auth::user();
        $roleAuth = Role::getInfoRoleByID($auth->role_id);
        $roletypeAuth = RoleType::getNameByID($roleAuth->roletype_id);
        $editAction = false;
        $deleteAction = false;
        $createAction = false;
        $isAdmin = false;
        if($roleAuth->code == 'admin'){
            $leads= Lead::getAllLead();
        }else{
            if(RoleCommon::checkRoleaConsultant($roleAuth->code)){
                $leads= Lead::leadsByConsultant($auth->id);
            }else{
                $leads= Lead::leadsByTipster($auth->id);
            }
        }
        if($roleAuth->code == 'sale' || $roleAuth->code == 'admin'){
            $editAction = true;
            $deleteAction = true;
            $createAction = true;
            if($roleAuth->code == 'admin'){
                $isAdmin = true;
            }
        }
        if($roletypeAuth->code == 'consultant'){
            $editAction = true;
            $deleteAction = true;
        }
        if($roletypeAuth->code == 'tipster'){
            $editAction = true;
            $createAction = true;
        }
        return view('leads.index', [
            'leads' => $leads,
            'editAction' => $editAction,
            'deleteAction' => $deleteAction,
            'createAction' => $createAction,
            'isAdmin' => $isAdmin
        ]);
    }

    public function deletedList(){
        $leads= Lead::getAllLeadDeleted();
        return view('leads.delete_list', [
            'leads' => $leads
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
        if($roleAuth->code == 'sale' || $roleAuth->code == 'admin' || $roletypeAuth->code == 'tipster'){
            $createAction = true;
        }

        $tipsters = DB::table('users')
            ->join('roles', 'users.role_id', 'roles.id')
            ->join('roletypes', 'roletypes.id', 'roles.roletype_id')
            ->select('users.*', 'roles.name', 'roletypes.code')
            ->where('roletypes.code','tipster')
            ->get();
        $regions = Region::getAllRegion();
        return view('leads.create', [
            'tipsters' => $tipsters,
            'regions' => $regions,
            'createAction' => $createAction
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
        $lead = $this->validate(request(),[
            'fullname' => 'required',
            'product' => 'required',
            'region' => 'required',
            'tipster' => 'required',
            'email' => 'required_if:phone,==,|nullable|email|max:255',
            'phone' => 'nullable|numeric',
            ],
            [
                'email.required_if' => 'Please enter email or phone number.'
            ]);
        $lead['fullname'] = $request->fullname;
        $lead['email'] = $request->email;
        $lead['birthday'] = $request->birthday;
        $lead['gender'] = $request->gender;
        $lead['relationship'] = $request->Relationship;
        $lead['phone'] = $request->phone;
        $lead['address'] = $request->address;
        $lead['notes'] = $request->notes;
        $lead['product_id'] = $request->product;
        $lead['status'] = 0;
        $lead['region_id'] = $request->region;
        $lead['tipster_id'] = $request->tipster;
        $leadnew = Lead::create($lead);
        $new = Utils::$lead_process_status_new;
        Common::sendMailChangeStatus($new, $leadnew->tipster_id, $leadnew->id, $leadnew->product_id, 0);

        return redirect()->route('leads.index')->with('success', 'Lead was added successfully.');
    }

    private function checkRoleLeadByTipster($leadId){
        $auth = Auth::user();
        $roleAuth = Role::getInfoRoleByID($auth->role_id);
        if(RoleCommon::checkRoleTipster($roleAuth->code)){
            $lead = Lead::getLeadByID($leadId);
            if(isset($lead) && $lead->tipster_id == $auth->id){
                return true;
            }else{
                return false;
            }
        }
        return true;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $kqCheckRole = $this->checkRoleLeadByTipster($id);
        if(!$kqCheckRole){
            return redirect()->route('common.error','1');
        }
        $auth = Auth::user();
        $roleAuth = Role::getInfoRoleByID($auth->role_id);
        $roletypeAuth = RoleType::getNameByID($roleAuth->roletype_id);
        $deleteAction = false;
        if($roleAuth->code == 'sale' || $roleAuth->code == 'admin' || $roletypeAuth->code == 'consultant'){
            $deleteAction = true;
        }

        $lead = Lead::getLeadByID($id);

        return view('leads.show', compact('lead', 'id'))->with([
            'deleteAction' => $deleteAction
        ]);
    }

    public function deleteShow($id){
        $kqCheckRole = $this->checkRoleLeadByTipster($id);
        if(!$kqCheckRole){
            return redirect()->route('common.error','1');
        }
        $lead = Lead::getLeadByID($id);
        return view('leads.delete_show', compact('lead', 'id'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $kqCheckRole = $this->checkRoleLeadByTipster($id);
        if(!$kqCheckRole){
            return redirect()->route('common.error','1');
        }
        $auth = Auth::user();
        $roleAuth = Role::getInfoRoleByID($auth->role_id);
        $roletypeAuth = RoleType::getNameByID($roleAuth->roletype_id);
        $editLead = false;
        if(RoleCommon::checkRoleEditLead($roleAuth->code)){
            $editLead = true;
        }
        $editAction = false;
        if(RoleCommon::checkRoleEditActionLead($roleAuth->code)){
            $editAction = true;
        }

        $consultants = User::getAllConsultant();

        $lead = Lead::getLeadByID($id);
        if($lead->relationship == null){
            $lead->relationship = "family";
        }
        if(isset($lead)){
            $listAssignment = Assignment::getConsultantByLead($lead->id);
            $lead["consultant_id"] = "";
            $lead["consultant_name"] = "Not assign yet.";
            if(!empty($listAssignment)){
                $lead["consultant_id"] = $listAssignment->consultant_id;
                foreach ($consultants as $consultant) {
                    if($consultant->id == $listAssignment->consultant_id){
                        $lead["consultant_name"] = Role::getInfoRoleByID($consultant->role_id)->name;
                    }
                }
            }
            if(isset($lead->status)){
                $lead["status_name"] = Common::showNameStatus($lead->status);
            }else{
                $lead["status_name"] = "Not status yet.";
            }
            
        }
        $products = Product::getAllProduct();
        $rowPoint = PointHistory::countRowPlusPointForTipsterFollowLead(
            $lead->id,
            $lead->tipster_id
        );
        $oldPoint = 0;
        $plussed = false;
        if(!empty($rowPoint)){
            $oldPoint = $rowPoint->point;
            $plussed = true;
        }
        $regions = Region::getAllRegion();
        
        if(RoleCommon::checkRoleTipster($roleAuth->code)){
           $tipsters = User::getTipsterById($auth->id);
        }else{
            $tipsters = User::getAllTipster();
        }
        
        return view('leads.edit', compact('lead', 'id'))->with([
            'products'=> $products,
            'regions'=> $regions,
            'tipsters'=>$tipsters,
            'editLead' => $editLead,
            'editAction' => $editAction,
            'plussed' => $plussed,
            'oldPoint' => $oldPoint,
            'consultants' => $consultants
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
        $request->validate([
            'email' => 'required_if:phone,==|nullable|email|max:255',
            'phone' => 'nullable|numeric',
        ],
            [
                'email.required_if' => 'Please enter email or phone number.'
            ]);
        $lead = Lead::find($id);
        $lead->fullname = $request->get('fullname');
        $lead->email = $request->get('email');
        $lead->phone = $request->get('phone');
        $lead->address = $request->get('address');
        $lead->gender = $request->get('gender');
        $lead->relationship = $request->get('Relationship');
        $lead->product_id = $request->get('product');
        $lead->notes = $request->get('notes');
        $lead->tipster_id = $request->get('tipster');
        $lead->region_id = $request->get('region');
//        $lead->status = $request->get('status');
        $lead->save();
        return redirect()->route('leads.index')->with('success','Lead was updated successfully.');
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
        $lead = Lead::find($id);
        if($lead){
            $lead->delete_is = 1;
            $lead->save();
        }
        return redirect()->route('leads.index')->with('success', 'Lead was deleted successfully.');
    }

    public function restore($id){
        $lead = Lead::find($id);
        if($lead){
            $lead->delete_is = 0;
            $lead->save();
        }
        return redirect()->route('leads.deleteList')->with('success', 'Lead was restore successfully.');
    }

    public function ajaxStatus(Request $request){
        //
        $lead_id = $request->lead;
        $status = $request->status;
        $tipster_id = $request->tipster_id;
        $product_id = $request->product_id;
        $tipster = User::getUserByID($tipster_id);
        $product = Product::getProductByID($product_id);
        $response = array();
        try{
            $result = count(LeadProcess::checkExist($lead_id, $status));
            $leadTable = Lead::find($lead_id);
            if($result < 1){
                $statusDb = $leadTable->status;
                $response['status_db'] = $statusDb;
                $response['status_view'] = $status;
                if($statusDb != $status){
                    $process['lead_id'] = $lead_id;
                    $process['status_id'] = $status;
                    LeadProcess::create($process);
                    $leadTable->status = $status;
                    $leadTable->save();
                    //get all history
                    $newHistoryProcess = LeadProcess::getStatusByLead($lead_id)->first();
                    $newHistoryProcess->created_format = Common::dateFormat($newHistoryProcess->created_at,'d-M-Y H:i');
                    $newHistoryProcess->classStatus = Lead::showColorStatus($status);
                    $newHistoryProcess->nameStatus = Lead::showNameStatus($status);

                    $response["newHistoryProcess"] = $newHistoryProcess;
                    $message= "Update successfully";
                    $response["status"] = "0";
                    $response["message"] = $message;

                    /*-----------------------------------------------
                     * config send mail when lead status change to:
                     * CALL/QUOTE/LOST
                     * ----------------------------------------------*/
                    if($status != 0){
                        $kqSendMail = Common::sendMailChangeStatus($status, $tipster_id, $lead_id, $product_id, 0);
                    }
                }else{
                    $error = "Current status was picked. Please pick another.";
                    $response["error"] = $error;
                    $response["status"] = "-1";
                    BaseController::rollbackLogActiviteis($request);
                }
            }else{
                $error = "Current status was picked. Please pick another.";
                $response["error"] = $error;
                $response["status"] = "-1";
                BaseController::rollbackLogActiviteis($request);
            }

//            $result = count(LeadProcess::checkExist($lead, $status));
//            if($result > 0){
//                $error = "Current status was picked. Please pick another.";
//                $response["error"] = $error;
//                $response["status"] = "-1";
//            }else{
//                $process['lead_id'] = $lead;
//                $process['status_id'] = $status;
//                LeadProcess::create($process);
//                $lead = Lead::find($lead);
//                $lead->status = $status;
//                $lead->save();
//                $message= "Update successfully";
//                $response["status"] = "0";
//                $response["message"] = $message;
//            }
        }catch (\Exception $e) {
            BaseController::rollbackLogActiviteis($request);
            $response['error'] = $e->getMessage();
            $response["status"] = "-2";
        }
        return response()->json($response);
    }

    public function updateStatus(Request $request){
        $lead = $request->lead;
        $status = $request->status;

        $result = count(LeadProcess::checkExist($lead, $status));
        if($result > 0){
            $error = "Current status was picked. Please pick another.";
            return back()->with(['error', $error]);
        }else{
            $process['lead_id'] = $lead;
            $process['status_id'] = $status;
            LeadProcess::create($process);
            $lead = Lead::find($lead);
            $lead->status = $status;
//            $this->sendMailChangeStatus($status, $request->tipster_id, $lead->id, $request->product_id, 0);
            $lead->save();
            return back()->with(['success', 'Updated status successfully']);
        }
    }

    public function updateTipster(Request $request){
        $tipster = $request->tipster;
        $lead = Lead::find($request->lead);
        $lead->tipster_id = $tipster;
        $lead->save();
        return back()->with('Updated tipster successfully.');
    }
}
