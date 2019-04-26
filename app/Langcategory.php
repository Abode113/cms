<?php

namespace App;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use DB;

class Langcategory extends Model
{
    public static $tableName = 'langcategories';
    public static $tbid = 'id';
    public static $tbcategory_id = 'category_id';
    public static $tblanguage_id = 'language_id';
    public static $tbtitle = 'title';
    public static $tbdesc = 'desc';
    public static $tbinfo = 'info';

    public function setallAttribute($request){

        $this->title = $request['title'];
        $this->category_id = $request['category_id'];
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
