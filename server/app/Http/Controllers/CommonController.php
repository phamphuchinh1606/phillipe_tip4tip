<?php

namespace App\Http\Controllers;

use App\Model\Gift;
use App\Model\GiftCategory;
use App\Model\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class CommonController extends Controller
{
    public function show($errorId){
        $messageError = "There was a system error. Please do so again";
        switch ($errorId) {
            case '1':
                $messageError = "You do not access to this screen. Please contact to admin.";
                break;
        }
        return view('common.error_common')->with([
            'messageError' => $messageError
        ]);
    }
}
