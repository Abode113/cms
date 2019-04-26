<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use App\itemcatvalues;
use App\item;
use App\catcustomattr;
use DB;

class langcatcustom extends Model
{
    public static $tableName = 'langcatcustoms';
    public static $tbid = 'id';
    public static $tblang_id  = 'lang_id';
    public static $tbcatvalcustom_id = 'catvalcustom_id';
    public static $tbvalue = 'value';
    public static $tbcreated_at  = 'created_at';
    public static $tbupdated_at  = 'updated_at';

    public function getDynamicObjByItemId($id){
        $AllData = DB::table(self::$tableName)
            ->join(itemcatvalues::$tableName, itemcatvalues::$tableName . '.' . itemcatvalues::$tbid, '=', self::$tableName . '.' . self::$tbcatvalcustom_id)
            ->join(item::$tableName, item::$tableName . '.' . item::$tbid, '=', itemcatvalues::$tableName . '.' . itemcatvalues::$tbitem_Id)
            ->where(item::$tableName . '.' . item::$tbid, '=', $id)
            ->select(self::$tableName . '.*')
            ->get();
        //dd($AllData);
        return $AllData;
    }
    public function getItemcatvaluesid($elem, $ItemcatvaluesArray){
//        var_dump($elem);
//        var_dump($ItemcatvaluesArray);
        foreach ($ItemcatvaluesArray as $Itemcatvalelem){
            if($Itemcatvalelem['categoryCustomId'] == $elem['categoryCustomId']){
                //var_dump($Itemcatvalelem['ItemcatvaluesId']);
                return $Itemcatvalelem['ItemcatvaluesId'];
            }
        }
    }
    public function AnalyseData($object){

        //dd($object);
        $request = array();
        $Languages = array();
        foreach ($object->request->keys() as $elem){
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
            $Data['value'] = array();
            $Data['category_id'] = $object['category_id'];
            array_push($request, $Data);
        }
        foreach ($object->request->keys() as $elem){
            if(strpos($elem, 'lang')){
                $splitedArray = explode("_",$elem);
                if(sizeof($splitedArray) >= 4){
                    if($splitedArray[3] == 'dynamicValue'){
                        $request[(new helper())->returnIndex($request, $splitedArray[2])]['value'][$splitedArray[0]] = $object[$elem];
                    }
                }
            }
        }
        //$request['category_id'] = $object['category_id'];
        return $request;
//        public function makeObject($AllRequest){
//            $Data = array();
//            $AllObj = array();
//            foreach ($AllRequest as $elem){
//                foreach ($elem['AttrVal'] as $val){
//                    $Obj = array();
//                    $Obj['language_id'] = $elem['Langkey'];
//                    $Obj['value'] = $val['value'];
//                    $Obj['categoryCustomId'] = $val['categoryCustomId'];
//                    array_push($AllObj, $Obj);
//                }
//            }
//            return $AllObj;
//        }
    }
    public function getNewEditedObject($CurrentObj, $EditedData){
        //dd($EditedData);
        foreach ($EditedData as $elem){
            if($elem['Langkey'] == $CurrentObj->lang_id){
                $ObjType = self::getTypeOfCurrentObjectBy_langCategoryCustomItemID($CurrentObj->id);
                $request = array();
                $request['language_id'] = $elem['Langkey'];
                $request['itemCatValueId'] = $CurrentObj->catvalcustom_id;
                $request['value'] = $elem['value'][$ObjType->name];
            }
        }
        return $request;
    }
    public function setallAttribute($request, $itemCatValueId){
        $this->lang_id = $request['language_id'];
        $this->catvalcustom_id = $itemCatValueId;
        $this->value = $request['value'];
        $this->created_at = Carbon::now();
        $this->updated_at = Carbon::now();
    }
    public function getTypeOfCurrentObjectBy_langCategoryCustomItemID($LangCategoryCustomId){
        $AllData = DB::table(self::$tableName)
            ->join(itemcatvalues::$tableName, itemcatvalues::$tableName . '.' . itemcatvalues::$tbid, '=', self::$tableName . '.' . self::$tbcatvalcustom_id)
            ->join(catcustomattr::$tableName, catcustomattr::$tableName . '.' . catcustomattr::$tbid, '=', itemcatvalues::$tableName . '.' . itemcatvalues::$tbcategoryCustom_Id)
            ->where(self::$tableName . '.' . self::$tbid, '=', $LangCategoryCustomId)
            ->select(catcustomattr::$tableName . '.' . catcustomattr::$tbname, catcustomattr::$tableName . '.' . catcustomattr::$tbtype)
            ->get()->first();
        return $AllData;
    }
    public function getlangcatcustomById($id){
        $AllData = DB::table(self::$tableName)
            ->where(self::$tableName . '.' . self::$tbid, '=', $id)
            ->get();
        return $AllData;
    }
}
