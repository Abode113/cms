<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;
use Session;
use Carbon\Carbon;

class user_permission extends Model
{
    public static $tableName = 'permission_user';
    public static $tbpermission_id = 'permission_id';
    public static $tbuser_id = 'user_id';
    //
    public function getAllData(){
        $AllData = DB::table(self::$tableName)
            ->get();
        return $AllData;
    }

    public function setallAttribute($request){
        dd($request);
        $this->permission_id  = $request->name ;
        $this->user_id  = $request->display_name ;
    }
}
