<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use DB;
use App\langitemcustom;
class itemcustomattr extends Model
{
    public static $tableName = 'itemcustomattrs';
    public static $tbid="id";
    public static $tbitem_id  ="item_id";
    public static $tbname = "name";
    public static $tbtype = 'type';
    public static $tbcreated_at = "created_at";
    public static $tbupdated_at  = "updated_at ";

    public function setallAttribute($item_id, $request){

        $this->item_id = $item_id;
        $this->name = $request->name;
        $this->type = $request->type;
        $this->created_at = Carbon::now();
        $this->updated_at = Carbon::now();
    }

    public function _setallAttribute($request){

        $this->name = $request->name;
        $this->type = $request->type;
        $this->created_at = Carbon::now();
        $this->updated_at = Carbon::now();
    }


    public function getAllData(){
        $AllData = DB::table(self::$tableName)
            ->join(item::$tableName, item::$tableName . '.' . item::$tbid, '=', self::$tableName . '.' . self::$tbitem_id)
            ->join(Langitem::$tableName, Langitem::$tableName . '.' . Langitem::$tbitem_id, '=', item::$tableName . '.' . item::$tbid)
            ->join(Language::$tableName, Language::$tableName . '.' . Language::$tbid, '=', Langitem::$tableName . '.' . Langitem::$tblanguage_id)
            ->where(Language::$tableName . '.' . Language::$tbid, '=', 1)
            ->select(
                self::$tableName . '.*'
                ,Langitem::$tableName . '.' . Langitem::$tbtitle . ' as ItemName'
            )
            ->get();
        return $AllData;
    }

    public function IsThereDocInLang($id){
        $AllData = DB::table(self::$tableName)
            ->join(item::$tableName, item::$tableName . '.' . item::$tbid, '=', self::$tableName . '.' . self::$tbitem_id)
            ->join(langitemcustom::$tableName, langitemcustom::$tableName . '.' . langitemcustom::$tbitemcustom_id, '=', self::$tableName . '.' . self::$tbid)
            ->where(self::$tableName . '.' . self::$tbid, '=', $id)
            ->get()->count();
        if($AllData > 0){
            return false;
        }else{
            return true;
        }
    }
}
