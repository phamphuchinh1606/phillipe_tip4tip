<?php

namespace App\Http\Controllers;

use App\Common\Common;
use App\Common\RoleCommon;
use App\Model\Region;
use App\Model\Role;
use App\Model\RoleType;
use App\Model\UserRole;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Common\Utils;

class UsersController extends Controller
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
        $editAction = false;
        $deleteAction = false;
        $createAction = false;
        $users = User::getAllConsultant();

        if(RoleCommon::checkRoleAdmin()){
            $editAction = true;
            $deleteAction = true;
            $createAction = true;
            $users = User::getAllUserNotTipster($auth->id);
        }
        if(RoleCommon::checkRoleaSale()){
            $editAction = true;
            $createAction = true;
            $deleteAction = true;
        }

        return view('users.index', [
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
        $roles = Role::all();
        $regions = Region::getAllRegion();
        $auth = Auth::user();
        $roleAuth = Role::getInfoRoleByID($auth->role_id);
        $roletypeAuth = RoleType::getNameByID($roleAuth->roletype_id);
        $createAction = false;
        $roletypes = RoleType::where('code', '<>', 'tipster')->get();
        if(RoleCommon::checkRoleAdmin() || RoleCommon::checkRoleaSale()){
            $createAction = true;
        }
        if(RoleCommon::checkRoleaSale()){
            $roletypes = RoleType::where('code', 'consultant')->get();
        }
        return view('users.create')->with([
            'roles' => $roles,
            'roletypes' => $roletypes,
            'regions'=> $regions,
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
        $user = $this->validate(request(),[
            'username' => 'required',
            'password' => 'required|string|min:6|confirmed',
            'fullname' => 'required',
            'email' => 'required|string|email|max:255|unique:users',
            'birthday' => 'required|date_format:"d/m/Y"',
            'avatar' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);
        $user['username'] = $request->username;
        $user['fullname'] = $request->fullname;
        if(isset($request->birthday) && null != $request->birthday){
            $user['birthday'] = \Carbon\Carbon::createFromFormat('d/m/Y',$request->birthday);
        }
        $roleIds = $request->department;
        $user['email'] = $request->email;
        $user['password']= bcrypt($request->password);
        $user['gender'] = $request->gender;
        $user['phone'] = $request->phone;
        $user['address'] = $request->address;
        $user['point'] = 0;
        $user['vote'] = 0;
        $user['region_id'] = $request->region;
        if(isset($roleIds) && count($roleIds) > 1){
            $user['role_id'] = $roleIds[0];
        }
        $user['create_by_id'] = Auth::user()->id;
        $user['delete_is'] = 0;
        $imageName = 'no_image_available.jpg';
        if(!empty(request()->avatar)){
            $imageName = time().'.'.request()->avatar->getClientOriginalExtension();
            request()->avatar->move(Utils::pathUploadImage('images/upload'), $imageName);
        }

        $user['avatar'] = $imageName;
        $userDb = User::create($user);
        if(isset($roleIds) && count($roleIds) > 1){
            foreach ($roleIds as $index => $roleId){
                if($index > 0){
                    $userRole['user_id'] = $userDb->id;
                    $userRole['role_id'] = $roleId;
                    UserRole::create($userRole);
                }
            }
        }

        return redirect()->route('users.index')->with('success', 'User was added successfully.');
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
        $user = User::getUserByID($id);
        $auth = Auth::user();
        $roleAuth = Role::getInfoRoleByID($auth->role_id);
        $roletypeAuth = RoleType::getNameByID($roleAuth->roletype_id);
        $editAction = false;
        $deleteAction = false;

        if(RoleCommon::checkRoleSaleAdmin() || $user->id == $auth->id){
            $editAction = true;
        }
        if(RoleCommon::checkRoleSaleAdmin()){
            if($user->roleCode != 'admin' || $user->id != $auth->id){
                $deleteAction = true;
            }
        }

        //Get list tipster by user
        $tipsters = [];
        $roleCommunity = false;
        if(RoleCommon::checkRoleCommunity($user->role_id)){
            $tipsters = User::getAllTipster($user->id);
            $roleCommunity = true;
        }
        $consultants = [];
        $roleSale = false;
        if(RoleCommon::checkRoleaSale()){
            $consultants = User::getAllConsultant($user->id);
            $roleSale = true;
        }


        return view('users.show', compact('user', 'id'))->with([
            'editAction' => $editAction,
            'deleteAction' => $deleteAction,
            'tipsters' => $tipsters,
            'consultants' => $consultants,
            'roleCommunity' => $roleCommunity,
            'roleSale' => $roleSale
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
        if($roletypeAuth->code != 'tipster'){
            $user = User::getUserByID($id);
            if($user->birthday != null){
                $user->birthday = Common::dateFormat($user->birthday,'d/m/Y');
            }
            $userRoleIds = RoleCommon::listRoleIdUser($user->id, $user->role_id);
            $roles = Role::where('code','<>', 'admin')->get();
            $roletypes = RoleType::where('code', '<>', 'tipster')->get();
            $regions = Region::getAllRegion();
            if($roleAuth->code == 'admin' || $roleAuth->code == 'sale' || $user->id == $auth->id){
                $editAction = true;
            }
            if($roleAuth->code == 'admin'){
                $roles = Role::all();
            }
            if($roleAuth->code == 'sale' && $user->id != $auth->id){
                $roletypes = RoleType::where('code', 'consultant')->get();
            }

            return view('users.edit',compact('user','id'))->with([
                'roles' => $roles,
                'roletypes' => $roletypes,
                'regions'=> $regions,
                'editAction' => $editAction,
                'userRoleIds' => $userRoleIds
            ]);
        }else{
            return view('users.edit',compact('user','id'))->with([
                'editAction' => $editAction
            ]);
        }


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
        //
        request()->validate([
            'username' => 'required',
            'email' => 'required',
            'fullname' => 'required',
            'birthday' => 'required|date_format:"d/m/Y"',
            'avatar' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
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
        $roleIds = $request->department;
        if(isset($roleIds) && count($roleIds) > 1){
            $user['role_id'] = $roleIds[0];
        }
        $user->fullname = $request->get('fullname');
        $user->phone = $request->get('phone');
        $user->address = $request->get('address');
        $user->gender = $request->get('gender');
        $user->delete_is = $request->get('status');
        if(null != $request->get('birthday')){
            $user->birthday = \Carbon\Carbon::createFromFormat('d/m/Y',$request->birthday);
        }
        $imageName = $user->avatar;
        if(!empty(request()->avatar)){
            $imageName = time().'.'.request()->avatar->getClientOriginalExtension();

            request()->avatar->move(Utils::pathUploadImage('images/upload'), $imageName);
        }
        $user->avatar = $imageName;

        $user->save();
        if(isset($roleIds) && count($roleIds) > 0 && isset($user)){
            UserRole::where('user_id',$id)->delete();
            foreach ($roleIds as $index => $roleId){
                if($index > 0){
                    $userRole['user_id'] = $id;
                    $userRole['role_id'] = $roleId;
                    UserRole::create($userRole);
                }
            }
        }
        return redirect()->route('users.index')->with('success','User was updated successfully');
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
        $auth = Auth::user();
        $roleAuth = Role::getInfoRoleByID($auth->role_id);
        $roletypeAuth = RoleType::getNameByID($roleAuth->roletype_id);

        $user = User::find($id);
        if(RoleCommon::checkRoleTipster() || RoleCommon::checkRoleaConsultant()){
            return back()->with('error', 'You do not have access delete user.');
        }else{
            if(RoleCommon::checkRoleaSale()){
                if(RoleCommon::checkRoleaConsultant()){
                    $user->delete_is = 1;
                    $user->save();
                    return back()->with('success', 'Delete a user successfully.');
                } else{
                    return back()->with('error', 'You do not have access delete user.');
                }
            }elseif(RoleCommon::checkRoleCommunity()){
                if(RoleCommon::checkRoleTipster()){
                    $user->delete_is = 1;
                    $user->save();
                    return back()->with('success', 'Delete a user successfully.');
                }else{
                    return back()->with('error', 'You do not have access delete user.');
                }
            }else{
                $user->delete_is = 1;
                $user->save();
                return back()->with('success', 'Delete a user successfully.');
            }
        }
    }
}
