<?php

namespace App\Http\Controllers;

use App\Model\Assignment;
use App\Model\Lead;
use App\Model\Role;
use App\Model\RoleType;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Mockery\Exception;
use Log;

class AssignmentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        //
        $assignments = Assignment::all();

        $auth = Auth::user();
        $roleAuth = Role::getInfoRoleByID($auth->role_id);
        $roletypeAuth = RoleType::getNameByID($roleAuth->roletype_id);
        $editAction = false;
        $deleteAction = false;
        $createAction = false;
        if($roleAuth->code == 'sale' || $roleAuth->code == 'admin'){
            $editAction = true;
            $deleteAction = true;
            $createAction = true;
        }
        return view('assignments.index', [
            'assignments'=>$assignments,
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
        if($roleAuth->code == 'sale' || $roleAuth->code == 'admin'){
            $createAction = true;
        }

        $consultants = User::getAllConsultant();

        $leads = Lead::getAllLeadNotYetAssign();

        return view('assignments.create', [
            'consultants'=>$consultants,
            'leads' => $leads,
            'createAction' => $createAction
            ])->with('success', 'Assignment successfully.');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validate = $this->validate($request,[
            'consultant' => 'required',
            'lead' => 'required'
        ]);
        $user =  Auth::user();
        $assignment['consultant_id'] = $request->get('consultant');
        $assignment['lead_id'] = $request->get('lead');
        $assignment['create_by'] = $user->id;

        try{
            $assignmentDb = Assignment::where('lead_id',$assignment['lead_id'])->first();
            if($assignmentDb){
                $assignmentDb->delete();
            }
            Assignment::create($assignment);
        }catch (Exception $e){
            Log::error($e->getMessage());
        }
        $backUrl = url()->previous();
        return redirect($backUrl);
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
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $auth = Auth::user();
        $roleAuth = Role::getInfoRoleByID($auth->role_id);
        $roletypeAuth = RoleType::getNameByID($roleAuth->roletype_id);
        $editAction = false;
        if($roleAuth->code == 'sale' || $roleAuth->code == 'admin'){
            $editAction = true;
        }
        $consultants = User::getAllConsultant();

        $leads = Lead::getAllLeadNotYetAssign();
        $assignment = Assignment::find($id);
        $leadAssignning = Lead::find($assignment->lead_id);

        return  view('assignments.edit', compact('assignment', 'id'))->with([
            'consultants'=>$consultants,
            'leads' => $leads,
            'editAction' => $editAction,
            'leadAssignning' => $leadAssignning
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
        $user =  Auth::user();
        $assignment = Assignment::find($id);
        $assignment->consultant_id = $request->get('consultant');
        $assignment->lead_id = $request->get('lead');
        $assignment->create_by = $user->id;
        $assignment->save();
        return redirect()->route('assignments.index')->with('success', 'Updated successfully');
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
        $ass = Assignment::find($id);
        $ass->delete();
        return redirect()->route('assignments.index')->with('success', 'Delete Successfully.');
    }
}
