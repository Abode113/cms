<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;
use Carbon\Carbon;
use App\helper;
use App\Langmenuitem;
use App\Language;

class MenuItem extends Model
{
    public static $tableName = 'menu_items';
    public static $tbid = 'id';
    public static $tbnavOrder = 'navOrder';
    public static $tbparent = 'parent';
    public static $tbvisible = 'visible';
    public static $tbcategory_id = 'category_id';
    public static $tbevent_id = 'event_id';


    public function __construct(){
    }

    public function MakeNavBarTree(){

        $res = $this->getAllDataByLanguage(1);
        $res = (new helper())->addAtributeAsArray($res, 'father');
        $res = (new helper())->addAtributeAsArray($res, 'sons');
        $res = $this->link($res);
        return $res;
    }

    public function link($allObjects){
        $inheritanceArray = $this->getAllinheritedProp($allObjects);
        while (!empty($inheritanceArray)) {
            foreach ($allObjects as $index => $elem) {
                if ($this->canMove($elem, $inheritanceArray)) {
                    $allObjects[$index]->father = $allObjects[(new helper())->getindexById($allObjects, $elem->parent)];

                }
            }
            $allObjects = $this->swapArray($allObjects);
            $inheritanceArray = $this->getAllinheritedProp($allObjects);
        }
        return $allObjects;
    }

    public function swapArray($allObjects){
        $helper = new helper();
        $itemToDelete = array();

        foreach ($allObjects as $index => $val){
            if(!empty($val->father)){
                if(!is_array($allObjects[$helper->getindexById($allObjects, $val->father->id)]->sons)){
                    $allObjects[$helper->getindexById($allObjects, $val->father->id)]->sons = array();
                }
                array_push($allObjects[$helper->getindexById($allObjects, $val->father->id)]->sons, $val);
                array_push($itemToDelete, $index);
            }
        }

        $allObjects = $helper->DeleteFromArrayOfIndex($allObjects, $itemToDelete);
        return $allObjects;
    }

    public function getAllinheritedProp($allObject){
        $result = array();
        foreach ($allObject as $val){
            if(!in_array($val->parent, $result) && $val->parent != 0){
                array_push($result, $val->parent);
            }
        }
        return $result;
    }

    public function canMove($object, $inheritanceArray){
        if($object->parent == 0){
            return false;
        }else if(in_array($object->id, $inheritanceArray)){
            return false;
        }
        return true;
    }

    public function setallAttribute($request){

        $this->parent=$request->parent;
        $this->navOrder=$request->navOrder;
        $this['visible']=$request->visible;
        $this->category_id=$request->category_id;
        $this->event_id=$request->event_id;
        $this->created_at = Carbon::now();
        $this->updated_at = Carbon::now();
    }

    public function getAllData(){

        $AllData = DB::table(self::$tableName)
            ->join(Langmenuitem::$tableName, self::$tableName . '.' . self::$tbid, '=', Langmenuitem::$tableName . '.' . Langmenuitem::$tbmenuitem_id)
            ->join(Language::$tableName, Langmenuitem::$tableName . '.' . Langmenuitem::$tblanguage_id, '=', Language::$tableName . '.' . Language::$tbid)
            ->select(self::$tableName . '.*',
                Langmenuitem::$tableName . '.' . Langmenuitem::$tbtitle,
                Language::$tableName . '.' . Language::$tbLanguageName,
                Language::$tableName . '.' . Language::$tbid  . ' as LanguageId')
            ->get()->sortBy(self::$tbnavOrder);

        return $AllData;
    }

    public function getAllDataByLanguage($id){

        $AllData = DB::table(self::$tableName)
            ->join(Langmenuitem::$tableName, self::$tableName . '.' . self::$tbid, '=', Langmenuitem::$tableName . '.' . Langmenuitem::$tbmenuitem_id)
            ->join(Language::$tableName, Langmenuitem::$tableName . '.' . Langmenuitem::$tblanguage_id, '=', Language::$tableName . '.' . Language::$tbid)
            ->where(Language::$tableName . '.' . self::$tbid, '=', $id)
            ->select(self::$tableName . '.*',
                Langmenuitem::$tableName . '.' . Langmenuitem::$tbtitle,
                Language::$tableName . '.' . Language::$tbLanguageName,
                Language::$tableName . '.' . Language::$tbid  . ' as LanguageId')
            ->get()->sortBy(self::$tbnavOrder);

        return $AllData;
    }

    public function getDataById($id){

        $AllData = DB::table(self::$tableName)
            ->join(Langmenuitem::$tableName, self::$tableName . '.' . self::$tbid, '=', Langmenuitem::$tableName . '.' . Langmenuitem::$tbmenuitem_id)
            ->join(Language::$tableName, Langmenuitem::$tableName . '.' . Langmenuitem::$tblanguage_id, '=', Language::$tableName . '.' . Language::$tbid)
            ->where(self::$tableName . '.' . self::$tbid, '=', $id)
            ->select(self::$tableName . '.*', Langmenuitem::$tableName . '.' . Langmenuitem::$tbtitle, Language::$tableName . '.' .  Language::$tbLanguageName)
            ->get()->sortBy(self::$tbnavOrder);

        return $AllData[0];
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
            $curr['menuitem_id'] = $MenuItemId;
            $curr['language_id'] = $elem['Langkey'];
            foreach ($elem['AttrKey'] as $index => $attr){
                $curr[$attr] = $elem['AttrVal'][$index];
            }
            array_push($secRequest, $curr);
        }
        return $secRequest;
    }

}
