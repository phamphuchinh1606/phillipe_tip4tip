<?php

namespace App\Http\Controllers;

use App\Common\RoleCommon;
use App\Model\Product;
use App\Model\ProductCategory;
use App\Model\Role;
use App\Model\RoleType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Common\Utils;

class ProductsController extends Controller
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
        $editAction = false;
        $deleteAction = false;
        $createAction = false;
        if(RoleCommon::checkRoleSaleAdmin()){
            $editAction = true;
            $deleteAction = true;
            $createAction = true;
        }
        $products = DB::table('products')
            ->join('productcategories', 'products.category_id', 'productcategories.id')
            ->select('products.*', 'productcategories.name as category')
            ->where('products.delete_is', '<>', 1)
            ->orderByRaw("ISNULL(sort_num), sort_num ASC")
            ->orderBy('created_at', 'desc')
        ->get();

        return view('products.index')->with([
            'products'=>$products,
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
        $categories = ProductCategory::all();
        $auth = Auth::user();
        $roleAuth = Role::getInfoRoleByID($auth->role_id);
        $createAction = false;
        if($roleAuth->code == 'sale' || $roleAuth->code == 'admin'){
            $createAction = true;
        }
        return view('products.create')->with(['categories'=> $categories, 'createAction' => $createAction]);
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
        $product = $this->validate($request, [
            'name' => 'required',
            'thumbnail' => 'image|mimes:jpeg,png,jpg,gif,svg|max:8112',
            'category' => 'required',
            'price' => 'numeric'
        ]);
        $product['description'] = $request->description;
        $product['price'] = 0;
        $product['quality'] = 0;
        $product['sort_num'] = $request->sort_num;
        $imageName = 'no_image_available.jpg';
        if(!empty(request()->thumbnail)){
            $imageName = time().'.'.request()->thumbnail->getClientOriginalExtension();
            request()->thumbnail->move(Utils::pathUploadImage('images/upload'), $imageName);
        }
        $product['thumbnail'] = $imageName;
        $product['category_id'] = $request->category;
        Product::create($product);
        return redirect()->route('products.index')->with('success', 'Product was added successfully');

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
        if(RoleCommon::checkRoleSaleAdmin()){
            $editAction = true;
            $deleteAction = true;
        }
        $product = DB::table('products')
        ->join('productcategories', 'productcategories.id', 'products.category_id')
        ->select('products.*', 'productcategories.name as category')
            ->where('products.id', $id)
        ->first();
        return view('products.show', compact('product', 'id'))
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
        //
        $auth = Auth::user();
        $roleAuth = Role::getInfoRoleByID($auth->role_id);
        $editAction = false;
        if(RoleCommon::checkRoleSaleAdmin()){
            $editAction = true;
        }
        $product = Product::find($id);
        $categories = ProductCategory::all();
        return view('products.edit', compact('product', 'id'))->with([
            'categories'=>$categories,
            'editAction' => $editAction
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
        request()->validate([
            'thumbnail' => 'image|mimes:jpeg,png,jpg,gif,svg|max:8112',
            'category' => 'required',
            'price' => 'numeric'
        ]);
        $product = Product::find($id);
        $product->name = $request->get('name');
        $product->sort_num = $request->get('sort_num');
        $product->description = $request->get('description');
        $price = $request->get('price');
        if(empty($price)){
            $price = 0;
        }
        $product->price = $price;
        $quality = $request->get('quality');
        if(empty($quality)){
            $quality = 0;
        }
        $product->quality = $quality;
        $product->category_id = $request->get('category');
        $imageName = $product->thumbnail;
        if(!empty(request()->thumbnail)){
            $imageName = time().'.'.request()->thumbnail->getClientOriginalExtension();

            request()->thumbnail->move(Utils::pathUploadImage('images/upload'), $imageName);
        }
        $product->thumbnail = $imageName;
        $product->save();
        return redirect()->route('products.index')->with('success', 'Product updated successfully');
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
        $product = Product::find($id);
        $product->delete_is = 1;
        $product->save();
        return redirect()->route('products.index')->with('success', 'Product deleted successfully.');
    }

    public function ajaxAddCategory(Request $request){
        $response = array(
            'status' => $request->name,
            'msg' => 'Added successfully',
        );
        $category['name'] = $request->name;
        $category['code'] =strtolower(preg_replace('/\s*/', '', $request->name));
        ProductCategory::create($category);

        return response()->json($response);
    }
}
