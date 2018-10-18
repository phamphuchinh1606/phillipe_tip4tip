<?php

namespace App\Http\Controllers\Api;

use App\Model\Region;
use App\Model\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Common\Common;
use App\Common\Utils;

class ProductsAPIControler extends Controller
{
    /*===========================================================================
      * CONTROLLER FOR API
      * ==========================================================================*/
    public function products(){
        $products = Product::getProducts();
        $pathImage = asset(Utils::$PATH__IMAGE);
        foreach ($products as $product) {
            $product->path_image = $pathImage;
        }
        return $products;
    }

    public function regions(){
        $regions = Region::getAllRegion();
        return $regions;
    }
}
