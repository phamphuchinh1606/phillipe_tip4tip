<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Region extends Model
{
    //
    protected $table = 'regions';
    protected $fillable = [
        'id',
        'name',
        'code'
    ];

    public static function getNameByID($id){
        $region = Region::find($id);
        return $region;
    }

    public static function getAllRegion(){
        return Region::where('delete_is' , 0)->get();
    }
}
