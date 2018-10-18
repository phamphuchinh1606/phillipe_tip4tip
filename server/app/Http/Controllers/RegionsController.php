<?php

namespace App\Http\Controllers;

use App\Model\Region;
use App\Model\Role;
use Illuminate\Http\Request;
use Auth;

class RegionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $auth = Auth::user();
        $roleAuth = Role::getInfoRoleByID($auth->role_id);
        $editAction = false;
        $deleteAction = false;
        $createAction = false;
        if($roleAuth->code == 'community' || $roleAuth->code == 'admin'){
            $editAction = true;
            $deleteAction = true;
            $createAction = true;
        }
        $regions = Region::getAllRegion();
        return view('regions.index',
            [
                'regions' => $regions,
                'editAction' => $editAction,
                'deleteAction' => $deleteAction,
                'createAction' => $createAction
            ] );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('regions.create');
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
        $region['name'] = $request->name;
        $region['code'] = $request->code;
        Region::create($region);
        return redirect()->route('regions.index')->with('success', 'Created region successfully.');
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
        if($roleAuth->code == 'community' || $roleAuth->code == 'admin'){
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
        $region = Region::find($id);
        return view('regions.edit', compact('region', $region));
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

        $region = Region::find($id);
        $name = $request->get('name');
        $code = $request->get('code');
        if($code !== $region->code){
            $validate = $this->validate(request(),[
                'code' => 'required|unique:regions',
            ]);
        }
        if($name !== $region->name){
            $validate = $this->validate(request(),[
                'name' => 'required|unique:regions',
            ]);
        }

        $region->name = $name;
        $region->code = $code;
        $region->save();
        return redirect()->route('regions.index')->with('success', 'Update region successfully.');
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
