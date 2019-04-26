<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laratrust\Traits\LaratrustUserTrait;
use DB;
use Carbon\Carbon;
use App\Role;
use Illuminate\Support\Facades\Auth;

class User extends Authenticatable
{
    use LaratrustUserTrait;
    use Notifiable;

    public static $tableName = 'users';
    public static $tbid = 'id';
    public static $tbname = 'name';
    public static $tbemail = 'email';
    public static $tbpassword = 'password';
    public static $tbcreated_at = 'created_at';
    public static $tbupdated_at = 'updated_at';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function getAllUsers(){
        $AllData = DB::table(self::$tableName)
            ->get();
        return $AllData;
    }

    public function getAllUsers_Roles(){
        $AllData = DB::table(self::$tableName)
            ->leftjoin('role_user', self::$tableName . '.' . self::$tbid, '=', 'role_user.user_id')
            ->leftjoin(Role::$tableName, Role::$tableName . '.' . Role::$tbid, '=', 'role_user.role_id')
            ->select(self::$tableName . '.' . self::$tbid
                    ,self::$tableName . '.' . self::$tbname
                    ,self::$tableName . '.' . self::$tbemail
                    ,self::$tableName . '.' . self::$tbcreated_at
                    ,self::$tableName . '.' . self::$tbupdated_at
                    ,Role::$tableName . '.' . Role::$tbid . ' as Role_id'
                    ,Role::$tableName . '.' . Role::$tbname . ' as Role_name')
            ->get();

        $admin_id = array();
        foreach ($AllData as $index => $elem){
            if(!in_array($elem->id, $admin_id)){
                array_push($admin_id, $elem->id);
                // Role_id
                $temp = $elem->Role_id;
                $elem->Role_id = array();
                if($temp == null){
                    array_push($elem->Role_id, -1);
                }else{
                    array_push($elem->Role_id, $temp);
                }

                // Role_name
                $temp = $elem->Role_name;
                $elem->Role_name = array();
                if($temp == null){
                    array_push($elem->Role_name, -1);
                }else{
                    array_push($elem->Role_name, $temp);
                }
            }else{
                array_push($AllData[self::getIndexOf($AllData, $elem->id)]->Role_id, $elem->Role_id);
                array_push($AllData[self::getIndexOf($AllData, $elem->id)]->Role_name, $elem->Role_name);
                unset($AllData[$index]);
            }
        }
        $NewArray = array();
        foreach ($AllData as $elem){
            array_push($NewArray, $elem);
        }
        return $NewArray;
    }

    public function getAllUser_Roles($id){
        $AllData = DB::table(self::$tableName)
            ->leftjoin('role_user', self::$tableName . '.' . self::$tbid, '=', 'role_user.user_id')
            ->leftjoin(Role::$tableName, Role::$tableName . '.' . Role::$tbid, '=', 'role_user.role_id')
            ->where(self::$tableName . '.' . self::$tbid, '=', $id)
            ->select(Role::$tableName . '.' . Role::$tbid . ' as Role_id'
                ,Role::$tableName . '.' . Role::$tbname . ' as Role_name')
            ->get();

        $Role_Id = array();
        $Role_name = array();
        foreach ($AllData as $elem){
            array_push($Role_Id, $elem->Role_id);
            array_push($Role_name, $elem->Role_name);
        }
        $AllData = [$Role_Id, $Role_name];
        //dd($AllData);
        return $AllData;
    }

    public function getIndexOf($object, $id){
        foreach ($object as $index => $elem){
            if($elem->id == $id){
                return $index;
            }
        }
        return 0;
    }

    public function AddRole($UserID, $Role_id){

        $user = User::find($UserID);
        $Role = Role::find($Role_id);
        //var_dump($user->name);
        //var_dump($Role->name);

        $user->attachRole($Role->id);

    }

    public function removeRole($UserID, $Role_id){

        $user = User::find($UserID);
        $Role = Role::find($Role_id);

        $user->detachRole($Role->id);
    }


    public function CheckUserauthorization($obj, $Place){

        $obj->middleware(function ($request, $next) use ($Place){
            //dd($this);
            $this->user = Auth::user();
            if($this->user) {
                switch($Place){
                    case 'Front':
                        $hasPermission = $this->user->hasRole(['enduser_role_name', 'dataentry_role_name', 'admin_role_name']);
                        break;

                    case 'Data':
                        $hasPermission = $this->user->hasRole(['dataentry_role_name', 'admin_role_name']);
                        break;

                    case 'Role':
                        $hasPermission = $this->user->hasRole(['admin_role_name']);
                        break;
                }
                if (!$hasPermission) {
                    Auth::logout();
                    return abort(403);
                }
            }
            return $next($request);
        });
    }

    public function CheckUserPermissions($obj, $action, $controller){
        $permission = $action . '_' . $controller;
        $this->user = Auth::user();
        //dd($permission);
        //dd($this->user->can($permission));
        if (!$this->user->can($permission)) {
            Auth::logout();
            return abort(403);
        }
    }

    public function GetUserInfo($obj){
        $obj->middleware(function ($request, $next){
            //dd(Auth::user());
            return Auth::user();
        });
    }
}


//$this->middleware(function ($request, $next) {
//
//    $this->user = Auth::user();
//    dd($this->user);
//    return $next($request);
//});
