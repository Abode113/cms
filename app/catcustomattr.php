<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use DB;
use App\category;
use App\Langcategory;
use App\Language;
use phpDocumentor\Reflection\Types\Self_;

class catcustomattr extends Model
{
    public static $tableName = 'catcustomattrs';
    public static $tbid = 'id';
    public static $tbname  = 'name';
    public static $tbtype   = 'type';
    public static $tbcategory_id = 'category_id';
    public static $tbcreated_at = 'created_at';
    public static $tbupdated_at = 'updated_at';

    public function getAllData(){
        $AllData = DB::table(self::$tableName)
            ->join(category::$tableName, category::$tableName . '.' . category::$tbid, '=', Self::$tableName . '.' . self::$tbcategory_id)
            ->join(Langcategory::$tableName, Langcategory::$tableName . '.' . Langcategory::$tbcategory_id, '=', category::$tableName . '.' . category::$tbid)
            ->join(Language::$tableName, Language::$tableName . '.' . Language::$tbid, '=', Langcategory::$tableName . '.' . Langcategory::$tblanguage_id)
            ->where(Language::$tableName . '.' . Language::$tbid, '=', 1)
            ->select(self::$tableName . '.' . self::$tbid,
                    self::$tableName . '.' . self::$tbname,
                    self::$tableName . '.' . self::$tbtype,
                    self::$tableName . '.' . self::$tbcategory_id,
                    Langcategory::$tableName . '.' . Langcategory::$tbtitle,
                    self::$tableName . '.' . self::$tbcreated_at,
                    self::$tableName . '.' . self::$tbupdated_at
            )
            ->get();

        return $AllData;
    }
    public function getAllDataByCategoryId($categoryId){
        $AllData = DB::table(self::$tableName)
            ->join(category::$tableName, category::$tableName . '.' . category::$tbid, '=', self::$tableName . '.' . self::$tbcategory_id)
            ->where(category::$tableName . '.' . category::$tbid, '=', $categoryId)
            ->select(self::$tableName . '.*')
            ->get();
        return $AllData;
    }
    public function setallAttribute($request){
        //dd($request->request->all());
        $this->name = $request->name;
        $this->type = $request->type;
        $this->category_id = $request->category_id;
        $this->created_at = Carbon::now();
        $this->updated_at = Carbon::now();
    }
}
