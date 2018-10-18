<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Common\Common;
use App\Common\Utils;
use App\User;
use App\Model\Role;
use App\Model\RoleType;
use App\Model\Region;
use Log;
use Validator;

class UsersAPIController extends Controller
{
    /*===========================================================================
      * CONTROLLER FOR API
      * ==========================================================================*/
    public function show($tipsterId){
        $user = User::find($tipsterId);
        $role = Role::find($user->role_id);
        $roletype = RoleType::find($role->roletype_id);
        if(isset($user) && isset($user) && isset($user)){
            $user["level"] = $role->name." - ".$roletype->name;
            $user["showGender"] = $user->showGender($user->gender);
            $region = Region::getNameByID($user->region_id);
            if($region){
                $user["region"] = $region->name;
            }
            $user["lang_text"] = Common::showTextLanguage($user->preferred_lang);
            $user["path_image"] = asset(Utils::$PATH__IMAGE);
        }
        $jsonValue = [
            "userInfo" => $user
        ];
        return response()->json($jsonValue, 201);
    }

    public function  showUpdate($tipsterId){
        $user = User::find($tipsterId);
        if(isset($user)){
            $user["path_image"] = asset(Utils::$PATH__IMAGE);
        }
        $regions = Region::getAllRegion();
        $jsonValue = [
            "userInfo" => $user,
            "regions" => $regions
        ];
        return response()->json($jsonValue, 201);
    }

    public function update(Request $request){
        $value = $request->json()->all();
        Log::info($value);
        $rules = [
            'id' => 'required',
            'fullname' => 'required',
            'phone' => 'required',
            'region_id' => 'required',
            'birthday' =>'required'
        ];
        $validator = Validator::make($value,$rules);
        if (!$validator->fails())
        {
            $user = User::find($value["id"]);
            if(isset($user)){
                $user["username"] = $value["username"];
                $user["fullname"] = $value["fullname"];
                $user["phone"] = $value["phone"];
                $user["region_id"] = $value["region_id"];
                $user["address"] = $value["address"];
                $user["birthday"] = $value["birthday"];
                $user["gender"] = $value["gender"];
                $user->update();
                $jsonValue = [
                    "message" => "update tipster success",
                    "status" => "0"
                ];
                return response()->json($jsonValue, 200);
            }
        }
        $jsonValue = [
            "message" => "update tipster fail",
            "status" => "1"
        ];
        return response()->json($jsonValue, 200);
    }
}
