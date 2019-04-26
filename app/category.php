<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use DB;
use Session;

class category extends Model
{
    public static $tableName = 'categories';
    public static $tbid="id";
    public static $tbimage ="image";
    public static $tbcoverimage = "coverimage";
    public static $tbparent = 'parent';
    public static $tbcategoryOrder = "categoryOrder";
    public static $tbevent_id  = "event_id";


    public function items(){
        return $this->hasMany(item::class);
    }

    public function setallAttribute($request){

        $this->image = $request->image;
        $this->coverimage = $request->coverimage;
        $this->parent = $request->parent;
        $this->categoryOrder = $request->categoryOrder;
        $this->event_id = $request->event_id;
        $this->created_at = Carbon::now();
        $this->updated_at = Carbon::now();
    }
    public function getAllData(){

        $AllData = DB::table(self::$tableName)
            ->join(Langcategory::$tableName, self::$tableName . '.' . self::$tbid, '=', Langcategory::$tableName . '.' . Langcategory::$tbcategory_id)
            ->join(Language::$tableName, Langcategory::$tableName . '.' . Langcategory::$tblanguage_id, '=', Language::$tableName . '.' . Language::$tbid)
            ->select(self::$tableName . '.*', Langcategory::$tableName . '.' . Langcategory::$tbtitle  ,Langcategory::$tableName . '.' . Langcategory::$tbdesc , Langcategory::$tableName .'.' . Langcategory::$tbinfo, Language::$tableName . '.' . Language::$tbLanguageName,
            Language::$tableName . '.' . Language::$tbid  . ' as LanguageId')
            ->get()->sortBy(self::$tbcategoryOrder);
      // dd($AllData[0]);
        return $AllData;
       
    }
    public function GetCategoryById($id, $LangId){
        $AllData = DB::table(self::$tableName)
            ->join(Langcategory::$tableName, Langcategory::$tableName . '.' . Langcategory::$tbcategory_id, '=', self::$tableName . '.' . self::$tbid)
            ->join(Language::$tableName, Language::$tableName . '.' . Language::$tbid, '=', Langcategory::$tableName . '.' . Langcategory::$tblanguage_id)
            ->where(self::$tableName . '.' . self::$tbid, '=', $id)
            ->where(Language::$tableName . '.' . Language::$tbid, '=', $LangId)
            ->select(self::$tableName . '.*'
                    ,Langcategory::$tableName . '.' . Langcategory::$tbtitle
                    ,Langcategory::$tableName . '.' . Langcategory::$tbinfo
                    ,Langcategory::$tableName . '.' . Langcategory::$tbdesc
                )
            ->get();
        return $AllData[0];
    }

    public function getAllDataOfSpecificLang($langId){
        $AllData = DB::table(self::$tableName)
            ->join(Langcategory::$tableName, self::$tableName . '.' . self::$tbid, '=', Langcategory::$tableName . '.' . Langcategory::$tbcategory_id)
            ->where(Langcategory::$tableName . '.' . Langcategory::$tblanguage_id, '=', $langId)
            ->select(self::$tableName . '.*', Langcategory::$tableName . '.' . Langcategory::$tbtitle  ,Langcategory::$tableName . '.' . Langcategory::$tbdesc , Langcategory::$tableName .'.' . Langcategory::$tbinfo)
            ->get()->sortBy(self::$tbcategoryOrder);
        // dd($AllData[0]);
        return $AllData;
    }

    public function getSonsArray($AllData){
        $sonsArray = array();
        foreach ($AllData as $index => $elem){
            $count = parent::all()->where(category::$tbparent, '==', $elem->id)->count();

            $sonsArrayelem['categoryId'] = $elem->id;
            $sonsArrayelem['NumberOfSons'] = $count;

            array_push($sonsArray, $sonsArrayelem);
        }
        return $sonsArray;
    }
    public function getDataById($id){

        $AllData = DB::table(self::$tableName)
            ->join(Langcategory::$tableName, self::$tableName . '.' . self::$tbid, '=', Langcategory::$tableName . '.' . Langcategory::$tbcategory_id)
            ->join(Language::$tableName, Langcategory::$tableName . '.' . Langcategory::$tblanguage_id, '=', Language::$tableName . '.' . Language::$tbid)
            ->where(self::$tableName . '.' . self::$tbid, '=', $id)
            ->select(self::$tableName . '.*', Langcategory::$tableName . '.' . Langcategory::$tbtitle, Langcategory::$tableName .'.' . Langcategory::$tbdesc , Langcategory::$tableName .'.' . Langcategory::$tbinfo ,  Language::$tableName . '.' . Language::$tbLanguageName)
            ->get()->sortBy(self::$tbcategoryOrder);
       
        return $AllData[0];
    }


    public function getCountOfParentCategoies($id, $LangId){

        $count = DB::table(self::$tableName)
            ->join(Langcategory::$tableName, self::$tableName . '.' . self::$tbid, '=', Langcategory::$tableName . '.' . Langcategory::$tbcategory_id)
            ->join(Language::$tableName, Langcategory::$tableName . '.' . Langcategory::$tblanguage_id, '=', Language::$tableName . '.' . Language::$tbid)
            ->where(self::$tableName . '.' . self::$tbparent, '=', $id)
            ->where(Language::$tableName . '.' . Language::$tbid, '=', $LangId)
            ->get()->count();
        Session::put('defaultLanguage', $LangId);
        return $count;
    }
    public function getDataByParentId($id, $LangId){

        $AllData = DB::table(self::$tableName)
            ->join(Langcategory::$tableName, self::$tableName . '.' . self::$tbid, '=', Langcategory::$tableName . '.' . Langcategory::$tbcategory_id)
            ->join(Language::$tableName, Langcategory::$tableName . '.' . Langcategory::$tblanguage_id, '=', Language::$tableName . '.' . Language::$tbid)
            ->where(self::$tableName . '.' . self::$tbparent, '=', $id)
            ->where(Language::$tableName . '.' . Language::$tbid, '=', $LangId)
            ->select(self::$tableName . '.*', Langcategory::$tableName . '.' . Langcategory::$tbtitle, Langcategory::$tableName .'.' . Langcategory::$tbdesc, Langcategory::$tableName .'.' . Langcategory::$tbinfo ,  Language::$tableName . '.' . Language::$tbLanguageName)
            ->get()->sortBy(self::$tbcategoryOrder);
        Session::put('defaultLanguage', $LangId);
        return $AllData;
    }

    public function arrayOfReqest($Objects){

        $request = array();
        $Languages = array();
        foreach ($Objects->request->keys() as $elem){
            if(strpos($elem, 'lang')){
                $splitedArray = explode("_",$elem);
                if(!in_array($splitedArray[2], $Languages)) {
                    array_push($Languages, $splitedArray[2]);
                }
            }
        }

        foreach ($Languages as $elem){
            $Data = array();
            $Data['Langkey'] = $elem;
            $Data['AttrKey'] = array();
            $Data['AttrVal'] = array();
            array_push($request, $Data);
        }

        foreach ($Objects->request->keys() as $elem){
            if(strpos($elem, 'lang')){
                $splitedArray = explode("_",$elem);
                array_push($request[(new helper())->returnIndex($request, $splitedArray[2])]['AttrKey'], $splitedArray[0]);
                array_push($request[(new helper())->returnIndex($request, $splitedArray[2])]['AttrVal'], $Objects[$elem]);
            }
        }
        return $request;
    }
    public function makeRequest($request, $MenuItemId){
        $secRequest = array();
        foreach ($request as $elem){
            $curr = array();
            $curr['category_id'] = $MenuItemId;
            $curr['language_id'] = $elem['Langkey'];
            foreach ($elem['AttrKey'] as $index => $attr){
                $curr[$attr] = $elem['AttrVal'][$index];
            }
            array_push($secRequest, $curr);
        }
        return $secRequest;
    }

}
