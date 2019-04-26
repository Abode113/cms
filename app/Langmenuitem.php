<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;
use Carbon\Carbon;

class Langmenuitem extends Model
{
    public static $tableName = 'langmenuitems';
    public static $tbid = 'id';
    public static $tbmenuitem_id = 'menuitem_id';
    public static $tblanguage_id = 'language_id';
    public static $tbtitle = 'title';

    public function setallAttribute($request){
        $this->title = $request['title'];
        $this->menuitem_id = $request['menuitem_id'];
        $this->language_id = $request['language_id'];
        $this->created_at = Carbon::now();
        $this->updated_at = Carbon::now();
    }

    public function IsThereDocInLang($id){

        $AllData = DB::table(self::$tableName)
            ->join(Language::$tableName, self::$tableName . '.' . self::$tblanguage_id, '=', Language::$tableName . '.' . Langitem::$tbid)
            ->where(Language::$tableName . '.' . Language::$tbid, '=', $id)
            ->get()->first();
        return $AllData == null;
    }
}
