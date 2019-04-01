<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Gift extends Model
{
    //
    protected $table = 'gifts';
    protected $fillable = [
        'name',
        'description',
        'point',
        'category_id',
        'thumbnail'
    ];

    public static function getAllGifts(){
        $gifts = Gift::leftjoin('giftcategories','giftcategories.id','gifts.category_id')
            ->where('gifts.delete_is',0)
            ->select('gifts.*','giftcategories.name as category_name')
            ->get();
        return $gifts;
    }

    public static function getGiftBuyAble($point, $filterPoint = null){
        $query = Gift::leftjoin('giftcategories','giftcategories.id','gifts.category_id')
            ->where('gifts.delete_is',0);
        if(isset($filterPoint)){
            $query->where('gifts.point', '<=' ,$point);
        }
        $gifts = $query->orderBy('category_id')
            ->select('gifts.*','giftcategories.name as category_name')
            ->get();
        return $gifts;
    }

    public static function getGiftByID($id){
        return Gift::leftjoin('giftcategories','giftcategories.id','gifts.category_id')
            ->where('gifts.id', $id)
            ->select('gifts.*','giftcategories.name as category_name')
            ->first();
    }
}
