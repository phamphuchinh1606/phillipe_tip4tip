<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use DB;

class Product extends Model
{
    //
    protected $table = 'products';
    protected $fillable = [
        'name',
        'sort_num',
        'description',
        'price',
        'thumbnail',
        'quality',
        'category_id',
    ];

    public static function getAllProduct(){
        $product = Product::all();
        return $product;
    }

    public static function getProducts(){
        $products = DB::table('products')
            ->join('productcategories', 'products.category_id', 'productcategories.id')
            ->select('products.*', 'productcategories.name as category')
            ->where('products.delete_is', '<>', 1)
            ->orderByRaw("ISNULL(sort_num), sort_num ASC")
            ->orderBy('created_at', 'desc')
        ->get();
        return $products;
    }

    public static function getProductByID($id){
        return Product::find($id);
    }

    public static function getProductByCategory($categoryId){
        $products = DB::table('products')
            ->where('products.category_id', $categoryId)
            ->get();
        return $products;
    }
}
