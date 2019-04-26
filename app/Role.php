<?php

namespace App;

use Laratrust\Models\LaratrustRole;
use DB;
use App\User;
use Carbon\Carbon;
use App\permission_role;
use App\Permission;

class Role extends LaratrustRole
{
    public static $tableName = 'roles';
    public static $tbid = 'id';
    public static $tbname = 'name';
    public static $tbDisplayName = 'display_name';
    public static $tbDescription = 'description';
    //
    public function getAllData(){
        $AllData = DB::table(self::$tableName)
            ->get();
        foreach ($AllData as $index => $elem){
            $permissions = DB::table('permission_role')
                ->join(Role::$tableName, Role::$tableName . '.' . Role::$tbid, '=', 'permission_role.role_id')
                ->join(Permission::$tableName, Permission::$tableName . '.' . Permission::$tbid, '=', 'permission_role.permission_id')
                ->where(Role::$tableName . '.' . Role::$tbid, '=', $elem->id)
                ->select('permission_role.permission_id')
                ->get();
            $AllData[$index]->permissions = array();
            if(sizeof($permissions) > 0){
                foreach ($permissions as $val){
                    array_push($AllData[$index]->permissions, $val->permission_id);
                }
            }else{
                array_push($AllData[$index]->permissions, -1);
            }
            //var_dump($elem->id);
            //var_dump($permissions);
        }
//dd($AllData);
        return $AllData;
    }

    public function getRolesIDOfUser($UserID){
        $AllData = DB::table(self::$tableName)
            ->join('role_user', self::$tableName . '.' . self::$tbid, '=', 'role_user.role_id')
            ->join(User::$tableName, User::$tableName . '.' . User::$tbid, '=', 'role_user.user_id')
            ->where(User::$tableName . '.' . User::$tbid, '=', $UserID)
            ->select(self::$tableName . '.' . self::$tbid)
            ->get();

        $Result = array();
        foreach ($AllData as $elem){
            array_push($Result, $elem->id);
        }
        return $Result;
    }

    public function setallAttribute($request){
        $this->name  = $request->name ;
        $this->display_name  = $request->display_name ;
        $this->description  = $request->description ;
        $this->created_at = Carbon::now();
        $this->updated_at = Carbon::now();
    }

    public function NewPermission($role_id, $request){//$request['Permissions']
        $role = Role::find($role_id);
        $role_permission = $role->permissions;
        $role_permission_arr = array();
        foreach ($role_permission as $elem){
            array_push($role_permission_arr, $elem->id);
        }
        $permission_toAdd = array();
        $permission_toremove = array();
        foreach ($role_permission_arr as $elem){
            if(!in_array($elem, $request['Permissions'])){
                array_push($permission_toremove, $elem);
            }
        }
        foreach ($request['Permissions'] as $elem){
            if(!in_array($elem, $role_permission_arr)){
                array_push($permission_toAdd, $elem);
            }
        }
        $Data = array();
        $Data = ['permission_toremove' => $permission_toremove
                , 'permission_toAdd' => $permission_toAdd];
        return $Data;
    }
}
