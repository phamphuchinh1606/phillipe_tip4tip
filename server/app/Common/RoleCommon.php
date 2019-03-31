<?php
namespace App\Common;

use App\Model\UserRole;
use App\User;
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
    public static $ROLE_CODE_COMMUNITY = "community";
    //Role Consultant
    public static $ROLE_CODE_CONSULTANT_INSURANCE = "insurance";
    public static $ROLE_CODE_CONSULTANT_CAR = "car";
    public static $ROLE_CODE_CONSULTANT_REALESTATE = "realestate";
    public static $ROLE_CODE_CONSULTANT_SERVICE = "service";

    public static $ROLE_CODE_MANAGER_COMMUNITY_ID = 2;
    public static $ROLE_CODE_TIPSTER_TIPSTER_ID = 8;
    public static $ROLE_CODE_TIPSTER_AMBASSADOR_ID = 9;

    public static $ROLE_TYPE_ID_MANAGER = 1;
    public static $ROLE_TYPE_ID_CONSULTANT = 2;
    public static $ROLE_TYPE_ID_TIPSTER = 3;

    private static $userRoles = [];

    public static function checkRoleTipster(){
        $user = Auth::user();
        return (
            self::checkRoleCode($user->id,RoleCommon::$ROLE_CODE_TIPSTER) ||
            self::checkRoleCode($user->id,RoleCommon::$ROLE_CODE_TIPSTER_NORMAL) ||
            self::checkRoleCode($user->id,RoleCommon::$ROLE_CODE_TIPSTER_AMBASSADOR)
        );
    }

    public static function checkRoleAdmin(){
        $user = Auth::user();
        return self::checkRoleCode($user->id,RoleCommon::$ROLE_CODE_ADMIN);
    }

    public static function checkRoleaSale(){
        $user = Auth::user();
        return self::checkRoleCode($user->id,RoleCommon::$ROLE_CODE_SALE);
    }

    public static function checkRoleAmbassador(){
        $user = Auth::user();
        return self::checkRoleCode($user->id,RoleCommon::$ROLE_CODE_TIPSTER_AMBASSADOR);
    }

    public static function checkRoleTipsterNormal(){
        $user = Auth::user();
        return self::checkRoleCode($user->id,RoleCommon::$ROLE_CODE_TIPSTER_NORMAL);
    }

    public static function checkRoleaConsultant(){
        $user = Auth::user();
        return (
            self::checkRoleCode($user->id,RoleCommon::$ROLE_CODE_CONSULTANT) ||
            self::checkRoleCode($user->id,RoleCommon::$ROLE_CODE_CONSULTANT_INSURANCE) ||
            self::checkRoleCode($user->id,RoleCommon::$ROLE_CODE_CONSULTANT_CAR) ||
            self::checkRoleCode($user->id,RoleCommon::$ROLE_CODE_CONSULTANT_REALESTATE) ||
            self::checkRoleCode($user->id,RoleCommon::$ROLE_CODE_CONSULTANT_SERVICE)
        );
    }

    //Check Role Edit Action Lead
    public static function checkRoleEditActionLead(){
        if(RoleCommon::checkRoleAdmin() || RoleCommon::checkRoleaSale() || RoleCommon::checkRoleaConsultant() ){
            return true;
        }
        return false;
    }

    public static function checkRoleEditLead(){
        if(RoleCommon::checkRoleEditActionLead() || RoleCommon::checkRoleTipster()){
            return true;
        }
        return false;
    }

    public static function checkRoleSaleAdmin(){
        if(RoleCommon::checkRoleaSale() || RoleCommon::checkRoleAdmin()){
            return true;
        }
        return false;
    }

    public static function checkRoleCommunity(){
        $user = Auth::user();
        return self::checkRoleCode($user->id,RoleCommon::$ROLE_CODE_COMMUNITY);
    }

    public static function listRoleIdUser($userId, $roleId = null ){
        $userRoles = UserRole::where('user_id',$userId)->get();
        $roleIds = [];
        if(isset($roleId)){
            $roleIds[] = $roleId;
        }
        if(isset($userRoles)){
            foreach ($userRoles as $userRole){
                $roleIds[] = $userRole->role_id;
            }
        }
        return $roleIds;
    }

    public static function listRoleByUser($userId){
        $user = User::find($userId);
        $roles = [];
        if(isset($user)){
            $roles[] = Role::find($user->role_id);
            $userRoles = Role::getRoleByUser($userId);
            foreach ($userRoles as $role){
                $roles[] = $role;
            }
        }
        return $roles;
    }

    public static function checkRoleCode($userId, $roleCode){
        if(isset(self::$userRoles)){
            self::$userRoles = self::listRoleByUser($userId);
        }
        foreach (self::$userRoles as $role){
            if($role->code == $roleCode){
                return true;
            }
        }
        return false;
    }
}