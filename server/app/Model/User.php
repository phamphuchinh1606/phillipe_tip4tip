<?php

namespace App;

use App\Model\Region;
use App\Model\Role;
use App\Common\Common;
use App\Model\RoleType;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\DB;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'users';
    protected $fillable = [
        'username',
        'email',
        'password',
        'fullname',
        'avatar',
        'gender',
        'birthday',
        'address',
        'phone',
        'role_id',
        'region_id',
        'create_by_id',
        'delete_is'
    ];

    public function region(){
        return $this->belongsTo('App\Region');
    }

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function role(){
        return $this->belongsTo('App\Role');
    }

    public function getAllRole(){
        return Role::all();
    }
    public static function getUserByID($id){
        $user = User::find($id);
        $roleUser = Role::getInfoRoleByID($user->role_id);
        $roletypeUser = RoleType::getNameByID($roleUser->roletype_id);

        $user['region'] = Region::getNameByID($user->region_id)->name;
        $user['genderName'] = Common::showGender($user->gender);

        $user['role'] = $roleUser->name;
        $user['roleCode'] = $roleUser->code;
        $user['roletype'] = $roletypeUser->name;
        $user['roletypeCode'] = $roletypeUser->code;
        return $user;
    }

    public static function getAllConsultant($userId = null){
        $query = User::select('users.*')
            ->leftjoin('user_roles','user_roles.user_id','users.id')
            ->leftjoin('roles as roles2', 'roles2.id','user_roles.role_id')
            ->leftjoin('roletypes as roletypes2', 'roles2.roletype_id', 'roletypes2.id')
            ->join('roles', 'users.role_id', 'roles.id')
            ->join('roletypes', 'roles.roletype_id', 'roletypes.id')
            ->where('roletypes.code' ,'consultant')
            ->OrWhere('roletypes2.code','manager');
        if(isset($userId)){
            $query->where('users.create_by_id',$userId);
        }
        $consultants = $query->select('users.*', 'roles.code as role', 'roletypes.name as roletype')
            ->distinct()
            ->get();
        return $consultants;
    }
    public static function getAllManager(){
        $managers = User::select('users.*')
            ->leftjoin('user_roles','user_roles.user_id','users.id')
            ->leftjoin('roles as roles2', 'roles2.id','user_roles.role_id')
            ->leftjoin('roletypes as roletypes2', 'roles2.roletype_id', 'roletypes2.id')
            ->join('roles', 'users.role_id', 'roles.id')
            ->join('roletypes', 'roles.roletype_id', 'roletypes.id')
            ->where('roletypes.code' ,'manager')
            ->whereOr('roletypes2.code','manager')
            ->select('users.*', 'roles.code as role', 'roletypes.name as roletype')
            ->get();
        return $managers;
    }
    public static function getAllUserNotTipster($userId = null){
        $query = User::select('users.*')
            ->join('roles', 'users.role_id', 'roles.id')
            ->join('roletypes', 'roles.roletype_id', 'roletypes.id')
            ->where('roletypes.code', '<>', 'tipster');
        if(isset($userId)){
            $query->where('create_by_id',$userId);
        }
        $managers = $query->select('users.*', 'roles.name as role', 'roletypes.name as roletype')
            ->get();

        return $managers;
    }

    public static function getAllRoleByCode($code){
        $roles = DB::table('users')
            ->join('roles', 'users.role_id', 'roles.id')
            ->join('roletypes', 'roletypes.id', 'roles.roletype_id')
            ->select('users.*', 'roles.code as role', 'roletypes.name as roletype')
            ->where('roles.code' ,$code)
            ->get();
        return $roles;
    }

    public static function getAllTipster($userId = null){
        $query = User::select('users.*','regions.name as region_name')
            ->join('roles', 'users.role_id', 'roles.id')
            ->join('roletypes', 'roles.roletype_id', 'roletypes.id')
            ->leftjoin('regions','regions.id','users.region_id')
            ->where('roletypes.code' ,'tipster');
        if(isset($userId)){
            $query->where('users.create_by_id',$userId);
        }
        $tipsters = $query->orderBy('created_at', 'desc')
            ->get();
        return $tipsters;
    }

    public static function getTipsterById($tipsterId){
        $tipsters = User::select('users.*','regions.name as region_name')
            ->join('roles', 'users.role_id', 'roles.id')
            ->join('roletypes', 'roles.roletype_id', 'roletypes.id')
            ->leftjoin('regions','regions.id','users.region_id')
            ->where('roletypes.code' ,'tipster')
            ->where('users.id' ,$tipsterId)
            ->orderBy('created_at', 'desc')
            ->get();
        return $tipsters;
    }

    public static function showGender($gender){
        $name = '';
        switch ($gender){
            case 0:
                $name = 'Male';
                break;
            case 1:
                $name = 'Female';
                break;
        }
        return $name;
    }

    public static function getRecentTipsters($num = 5){
        $tipsters = DB::table('users')
            ->join('roles', 'users.role_id', 'roles.id')
            ->join('roletypes', 'roles.roletype_id', 'roletypes.id')
            ->where('roletypes.code' ,'tipster')
            ->orderBy('created_at', 'desc')
            ->select('users.*')
            ->limit($num)
            ->get();
        return $tipsters;
    }


    public static function getHighestPointTipster($num = 5){
        $tipsters = DB::table('users')
            ->join('roles', 'users.role_id', 'roles.id')
            ->join('roletypes', 'roles.roletype_id', 'roletypes.id')
            ->where([
                ['roletypes.code' ,'tipster'],
                ['users.point', '>', '0']
            ])
            ->orderBy('users.point', 'desc')
            ->select('users.*')
            ->limit($num)
            ->get();
        return $tipsters;
    }

    public static function getMostActiveTipsters($limit = 5){
        $leads = DB::table('leads')
            ->select('tipster_id', DB::raw('count(*) as total'))
            ->groupBy('tipster_id')
            ->orderBy('total', 'desc')->limit($limit)
            ->get();

        return $leads;
    }

}
