<?php

namespace App\Http\Controllers;

use App\Model\ProductCategory;
use App\Model\Role;
use Illuminate\Http\Request;
use App\Common\RoleCommon;
use App\Model\Product;
use Auth;

class ProductCategoriesController extends Controller
{
    public function index()
    {
        $editAction = false;
        $deleteAction = false;
        $createAction = false;
        if(RoleCommon::checkRoleSaleAdmin()){
            $editAction = true;
            $deleteAction = true;
            $createAction = true;
        }
        $categories = ProductCategory::all();
        return view('productcategories.index', ['categories' => $categories])->with([
            'editAction' => $editAction,
            'deleteAction' => $deleteAction,
            'createAction' => $createAction
        ]);;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('productcategories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $category = $this->validate($request,[
            'name' => 'required',
        ]);
        $category['name'] = $request->name;
        $category['code'] =strtolower(preg_replace('/\s*/', '', $request->name));
        $category['description'] = $request->description;
        ProductCategory::create($category);

        return redirect()->route('productcategories.index')->with('success', 'Category was added successfully.');
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
        if($roleAuth->code == 'sale' || $roleAuth->code == 'admin'){
            $editAction = true;
            $deleteAction = true;
        }
        $category = ProductCategory::find($id);
        return view('productcategories.show', compact('category', $category))
            ->with([
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
        $category = ProductCategory::find($id);
        return view('productcategories.edit', compact('category', $category));
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
        $category = ProductCategory::find($id);
        $name = $request->get('name');
        $description = $request->get('description');
        if($name !== $category->name){
            $validate = $this->validate(request(),[
                'name' => 'required|unique:productcategories',
            ]);
        }

        $category->name = $name;
        $category->description = $description;
        $category->save();
        return redirect()->route('productcategories.index')->with('success', 'Update category successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $products = Product::getProductByCategory($id);
        if(isset($products) && count($products) > 0){
            return redirect()->route('productcategories.index')->with('error', 'Category existing product.');
        }
        $category = ProductCategory::find($id);
        $category->delete();
        return redirect()->route('productcategories.index')->with('success', 'Delete Successfully.');
    }
}
