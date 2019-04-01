<?php

namespace App\Http\Controllers\Api;

use App\Model\Gift;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Common\Utils;

class GiftsAPIController extends Controller
{
    /*===========================================================================
     * CONTROLLER FOR API
     * ==========================================================================*/
    public function index(){
        $gifts = Gift::getAllGifts();
        return $gifts;
    }

    public function listGift($tipsterId, Request $request){
        $gifts = [];
        $tipster = User::find($tipsterId);
        $filterPoint = $request->filter_point;
        if(isset($tipster)){
            $pathImage = asset(Utils::$PATH__IMAGE);
            $gifts = Gift::getGiftBuyAble($tipster->point,$filterPoint);
            foreach ($gifts as $gift) {
                $gift->path_image = $pathImage;
            }
        }
        $jsonValue = [
            "gifts" => $gifts,
        ];
        return response()->json($jsonValue, 201);
    }

    public function show($id){
        $gift = Gift::getGiftByID($id);
        $gift->path_image = asset(Utils::$PATH__IMAGE);
        return $gift;
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'name' => 'required',
            'thumbnail' => 'image|mimes:jpeg,png,jpg,gif,svg|max:8112'
        ]);
        $gift = Gift::create($request->all());

        return response()->json($gift, 201);
    }

    public function update(Request $request, Gift $gift)
    {
        $this->validate($request,[
            'name' => 'required',
        ]);
        $gift->update($request->all());

        return response()->json($gift, 200);
    }

    public function delete(Gift $gift)
    {
        $gift->delete();

        return response()->json(null, 204);
    }
}
