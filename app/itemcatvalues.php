<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use App\catcustomattr;
use DB;

class itemcatvalues extends Model
{
    public static $tableName = 'itemcatvalues';
    public static $tbid = 'id';
    public static $tbitem_Id = 'item_id';
    public static $tbcategoryCustom_Id = 'categoryCustom_Id';
    public static $tbcreated_at = 'created_at';
    public static $tbupdated_at  = 'updated_at ';

    public function getcategoryCustomId($ValueData){

        $categoryCustomId = array();
        foreach ($ValueData as $elem){
            if(!in_array($elem['categoryCustomId'], $categoryCustomId)){
                array_push($categoryCustomId, $elem['categoryCustomId']);
            }
        }
        return $categoryCustomId;
    }
    public function getDatatypeOfCurrentData($itemcatvalues_ID){
        $AllData = DB::table(self::$tableName)
            ->join(catcustomattr::$tableName, catcustomattr::$tableName . '.' . catcustomattr::$tbid, '=', self::$tableName . '.' . self::$tbcategoryCustom_Id)
            ->where(self::$tableName . '.' . catcustomattr::$tbid, '=', $itemcatvalues_ID)
            ->select(catcustomattr::$tbname, catcustomattr::$tbtype)
            ->get();
        return $AllData[0];
    }

    public function setallAttribute($ItemID, $categoryCustomId){

        $this->item_id = $ItemID;
        $this->categoryCustom_Id = $categoryCustomId;
        $this->created_at = Carbon::now();
        $this->updated_at = Carbon::now();
    }
}
