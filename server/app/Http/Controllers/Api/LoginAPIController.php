<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Common\Common;
use App\Common\Utils;
use Validator;
use Auth;

class LoginAPIController extends Controller
{
    /*===========================================================================
      * CONTROLLER FOR API
      * ==========================================================================*/
    public function login(Request $request){
    	$value = $request->json()->all();
    	$rules = [
            'email' => 'required',
            'password' => 'required'
        ];

        $validator = Validator::make($value,$rules);
        if (!$validator->fails())
        {
        	$remember = false;
	        if(!empty($request->get('remember'))){
	            $remember = true;
	        }
	        if (Auth::attempt(['email' => $value['email'], 'password' => $value['password'], 'delete_is' => 0, 'role_id' => 9], $remember)) {
	        	$user = Auth::user();
	        	$user->path_image = asset(Utils::$PATH__IMAGE);
	        	$user->date = Common::dateFormat($user->birthday, 'd F Y');
	        	$jsonValue = [
		            "message" => "Login success",
		            "status" => "0",
		            "user_info" => $user,
		        ];
	        	return response()->json($jsonValue, 201);
	        }
        }
        $jsonValue = [
            "message" => "Your email, password incorrect or Your account does not exit.",
            "status" => "1"
        ];
    	return response()->json($jsonValue, 201);
        	
    }
}
