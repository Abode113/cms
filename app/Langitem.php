<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use DB;

class Langitem extends Model
{
    public static $tableName = 'langitems';
    public static $tbid = 'id';
    public static $tbitem_id = 'item_id';
    public static $tblanguage_id = 'language_id';
    public static $tbtitle = 'title';
    public static $tbdesc = 'desc';
    public static $tbinfo = 'info';

    public function setallAttribute($request){

        $this->title = $request['title'];
        $this->item_id = $request['item_id'];
        $this->language_id = $request['language_id'];
        $this->desc = $request['desc'];
        $this->info = $request['info'];
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
