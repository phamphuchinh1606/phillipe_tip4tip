<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class RoleType extends Model
{
    //
    protected $table = 'roletypes';
    protected $fillable = [
        'name',
        'code'
    ];

    public static function getNameByID($id){
        return RoleType::where('id', $id)->select('*')->first();
    }

    public static function getByListID($listId){
        return RoleType::whereIn('id', $listId)->select('*')->get();
    }

    public static function getAll(){
        return RoleType::select('*')->first();
    }
}
