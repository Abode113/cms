<?php

namespace App;

use Laratrust\Models\LaratrustPermission;
use DB;
use Carbon\Carbon;

class Permission extends LaratrustPermission
{
    public static $tableName = 'permissions';
    public static $tbid = 'id';
    public static $tbname = 'name';
    public static $tbDisplayName = 'display_name';
    public static $tbDescription = 'description';
    //
    public function getAllData(){
        $AllData = DB::table(self::$tableName)
            ->get();
        //dd($AllData);
        return $AllData;
    }

    public function setallAttribute($request){
        //dd($request);
        $this->name  = $request->name ;
        $this->display_name  = $request->display_name ;
        $this->description  = $request->description ;
        $this->created_at = Carbon::now();
        $this->updated_at = Carbon::now();
    }

    public function isSafe($id){
        $AllData = DB::table(self::$tableName)
            ->join('permission_role', 'permission_role.permission_id', '=', self::$tableName . '.' . self::$tbid)
            ->where(self::$tableName . '.' . self::$tbid, '=', $id)
            ->get();
        if(sizeof($AllData) > 0){
            return false;
        }else{
            return true;
        }
    }
}
