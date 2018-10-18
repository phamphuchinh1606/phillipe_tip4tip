<?php
namespace App\Common;

use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Model\Role;
use App\Model\RoleType;
use Illuminate\Http\Request;

class RoleCommon{
	public static $ROLE_CODE_TIPSTER = "tipster";
    public static $ROLE_CODE_TIPSTER_NORMAL = "tipster_normal";
    public static $ROLE_CODE_TIPSTER_AMBASSADOR = "ambassador";
	public static $ROLE_CODE_SALE = "sale";    
	public static $ROLE_CODE_ADMIN = "admin";    
	public static $ROLE_CODE_CONSULTANT = "consultant";
    //Role Consultant
    public static $ROLE_CODE_CONSULTANT_INSURANCE = "insurance";
    public static $ROLE_CODE_CONSULTANT_CAR = "car";
    public static $ROLE_CODE_CONSULTANT_REALESTATE = "realestate";
    public static $ROLE_CODE_CONSULTANT_SERVICE = "service";

    public static function checkRoleTipster($roleCode){
        if($roleCode == RoleCommon::$ROLE_CODE_TIPSTER || $roleCode == RoleCommon::$ROLE_CODE_TIPSTER_NORMAL
            || $roleCode == RoleCommon::$ROLE_CODE_TIPSTER_AMBASSADOR){
            return true;
        }
        return false;
    }

    public static function checkRoleAdmin($roleCode){
        if($roleCode == RoleCommon::$ROLE_CODE_ADMIN){
            return true;
        }
        return false;
    }

    public static function checkRoleaSale($roleCode){
        if($roleCode == RoleCommon::$ROLE_CODE_SALE){
            return true;
        }
        return false;
    }

    public static function checkRoleaConsultant($roleCode){
        if($roleCode == RoleCommon::$ROLE_CODE_CONSULTANT || 
            $roleCode == RoleCommon::$ROLE_CODE_CONSULTANT_INSURANCE ||
            $roleCode == RoleCommon::$ROLE_CODE_CONSULTANT_CAR ||
            $roleCode == RoleCommon::$ROLE_CODE_CONSULTANT_REALESTATE ||
            $roleCode == RoleCommon::$ROLE_CODE_CONSULTANT_SERVICE){
            return true;
        }
        return false;
    }

    //Check Role Edit Action Lead
    public static function checkRoleEditActionLead($roleCode){
        if(RoleCommon::checkRoleAdmin($roleCode) || RoleCommon::checkRoleaSale($roleCode) || RoleCommon::checkRoleaConsultant($roleCode) ){
            return true;
        }
        return false;
    }

    public static function checkRoleEditLead($roleCode){
        if(RoleCommon::checkRoleEditActionLead($roleCode) || RoleCommon::checkRoleTipster($roleCode)){
            return true;
        }
        return false;
    }

    public static function checkRoleSaleAdmin(){
        $auth = Auth::user();
        $roleAuth = Role::getInfoRoleByID($auth->role_id);
        $role_code = $roleAuth->code;
        if(RoleCommon::checkRoleaSale($role_code) || RoleCommon::checkRoleAdmin($role_code)){
            return true;
        }
        return false;
    }
}