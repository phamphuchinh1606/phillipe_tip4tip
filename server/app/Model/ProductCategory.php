<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class ProductCategory extends Model
{
    //
    protected $table = 'productcategories';
    protected $fillable = [
        'name',
        'code',
        'description',
    ];

    public static function getAllCategory(){
    	$categorys = ProductCategory::all();
        return $categorys;
    }
}
