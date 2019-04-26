<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;
use Session;
use Carbon\Carbon;

class permission_role extends Model
{
    public static $tableName = 'permission_role';
    public static $tbpermission_id = 'permission_id';//permission_id
    public static $tbrole_id = 'role_id';
    //
    public function getAllData(){
        $AllData = DB::table(self::$tableName)
            ->get();
        return $AllData;
    }

    public function setallAttribute($role_id, $request){
        //dd($request);
        $this->permission_id  = intval($request);
        $this->role_id  = $role_id;
    }
}
