<?php

namespace App\Http\Controllers;

use App\Common\RoleCommon;
use Illuminate\Http\Request;
use Auth;
use App\Model\{Role,RoleType,Region};

class DepartmentController extends Controller
{
    private $roleList;

    public function __construct()
    {
        $this->roleList = [RoleCommon::$ROLE_TYPE_ID_MANAGER,RoleCommon::$ROLE_TYPE_ID_CONSULTANT];
    }

    public function index()
    {
        $roles = Role::getInfoRoleByListID($this->roleList);
        return view('departments.index',
            [
                'roles' => $roles
            ] );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roleTypes = RoleType::getByListID($this->roleList);
        return view('departments.create',[
            'roleTypes' => $roleTypes
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
        $validate = $this->validate(request(),[
            'name' => 'required',
            'code' => 'required',
        ]);
        $role = new Role();
        $role->name = $request->name;
        $role->code = $request->code;
        $role->roletype_id = $request->role_type_id;
        $role->save();
        return redirect()->route('departments.index')->with('success', 'Created department successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $auth = Auth::user();
        $roleAuth = Role::getInfoRoleByID($auth->role_id);
        $editAction = false;
        $deleteAction = false;
        $createAction = false;
        if(RoleCommon::checkRoleCommunity() || RoleCommon::checkRoleAdmin()){
            $editAction = true;
            $deleteAction = true;
            $createAction = true;
        }
        $region = Region::find($id);
        return view('regions.show', [
            'region' => $region,
            'editAction' => $editAction,
            'deleteAction' => $deleteAction,
            'createAction' => $createAction
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
        $roleTypes = RoleType::getByListID($this->roleList);
        $role = Role::getInfoRoleByID($id);
        return view('departments.edit',[
            'role' => $role,
            'roleTypes' => $roleTypes
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
        //
        $validate = $this->validate(request(),[
            'name' => 'required',
            'code' => 'required',
        ]);
        $role = Role::find($id);
        if(isset($role)){
            $role->name = $request->name;
            $role->code = $request->code;
            $role->roletype_id = $request->role_type_id;
            $role->save();
        }
        return redirect()->route('departments.index')->with('success', 'Update department successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $region = Region::find($id);
        $region->delete_is = 1;
        $region->save();
        return redirect()->route('regions.index')->with('success', 'Region was deleted successfully.');
    }
}
