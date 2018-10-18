<?php

namespace App\Http\Controllers;

use App\Common\Common;
use App\Model\Region;
use App\Model\Role;
use App\Model\RoleType;
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
        $roleAuth = Role::getInfoRoleByID($auth->role_id);
//        $roletypeAuth = RoleType::getNameByID($roleAuth->roletype_id);
        $editAction = false;
        $deleteAction = false;
        $createAction = false;
        $users = User::getAllConsultant();

        if($roleAuth->code == 'admin'){
            $editAction = true;
            $deleteAction = true;
            $createAction = true;
            $users = User::getAllUserNotTipster();
        }
        if($roleAuth->code == 'sale'){
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
        if($roleAuth->code == 'admin' || $roleAuth->code == 'sale'){
            $createAction = true;
        }
        if($roleAuth->code == 'sale'){
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
        $user['email'] = $request->email;
        $user['password']= bcrypt($request->password);
        $user['gender'] = $request->gender;
        $user['phone'] = $request->phone;
        $user['address'] = $request->address;
        $user['point'] = 0;
        $user['vote'] = 0;
        $user['region_id'] = $request->region;
        $user['role_id'] = $request->department;
        $user['delete_is'] = 0;
        $imageName = 'no_image_available.jpg';
        if(!empty(request()->avatar)){
            $imageName = time().'.'.request()->avatar->getClientOriginalExtension();
            request()->avatar->move(Utils::pathUploadImage('images/upload'), $imageName);
        }

        $user['avatar'] = $imageName;

        User::create($user);
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

        if($roleAuth->code == 'admin' || $roleAuth->code == 'sale' || $user->id == $auth->id){
            $editAction = true;
        }
        if($roleAuth->code == 'admin' || $roleAuth->code == 'sale'){
            if($user->roleCode != 'admin' || $user->id != $auth->id){
                $deleteAction = true;
            }
        }


        return view('users.show', compact('user', 'id'))->with([
            'editAction' => $editAction,
            'deleteAction' => $deleteAction
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
                'editAction' => $editAction
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
        $user->fullname = $request->get('fullname');
        $user->phone = $request->get('phone');
        $user->address = $request->get('address');
        $user->gender = $request->get('gender');
        $user->role_id = $request->get('department');
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
        if($roletypeAuth->code == 'tipster' || $roletypeAuth->code == 'consultant'){
            return back()->with('error', 'You do not have access delete user.');
        }else{
            if($roleAuth->code == 'sale'){
                if(RoleType::getNameByID(Role::getInfoRoleByID($user->role_id)->roletype_id)->code == 'consultant'){
                    $user->delete_is = 1;
                    $user->save();
                    return back()->with('success', 'Delete a user successfully.');
                } else{
                    return back()->with('error', 'You do not have access delete user.');
                }
            }elseif($roleAuth->code == 'community'){
                if(Role::getInfoRoleByID($user->id) == 'tipster'){
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
