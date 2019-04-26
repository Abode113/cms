<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use App\category;
use DB;
use App\helper;
use App\Langitem;
use Session;
use App\itemcatvalues;
use App\langcatcustom;
use App\langitemcustom;


class item extends Model
{
    public static $tableName = 'items';
    public static $tbid = 'id';
    public static $tbimage = 'image';
    public static $tbcoverimage = 'coverimage ';
    public static $tbvisible = 'visible';
    public static $tbitemOrder  = 'itemOrder ';
    public static $tbcategory_id  = 'category_id ';
    public static $tbevent_id   = 'event_id  ';

    public static $tbcategoryId = 'category_id';

    public function cateogory(){
        return $this->belongsTo(category::class);
    }

    public function getindexById($allObject, $id){
        foreach ($allObject as $index => $val){
            if($val['id'] == $id){
                return $index;
            }
        }
        return -1;
    }

    public function setallAttribute($request){

      //  $this->title=$request->title;
      //  $this->desc=$request->desc;
      //  $this->info=$request->info;
        $this->image =$request->image;
        $this->coverimage =$request->coverimage;
        $this['visible']=$request->visible;
        $this->itemOrder=$request->itemOrder;
        $this->category_id=$request->category_id;
        $this->event_id=$request->event_id;
        $this->created_at = Carbon::now();
        $this->updated_at = Carbon::now();
    }

    public function getDataByLanguage($Lang_id){
        $AllData = DB::table(self::$tableName)
            ->join(Langitem::$tableName, self::$tableName . '.' . self::$tbid, '=', Langitem::$tableName . '.' . Langitem::$tbitem_id)
            ->join(Language::$tableName, Langitem::$tableName . '.' . Langitem::$tblanguage_id, '=', Language::$tableName . '.' . Language::$tbid)
            ->where(Language::$tableName . '.' . Language::$tbid, '=', $Lang_id)
            ->select(self::$tableName . '.' . self::$tbid
                    ,Langitem::$tableName . '.' . Langitem::$tbtitle)
            ->get();
        return $AllData;
    }
    public function getAllData(){

        $AllData = DB::table(self::$tableName)
            ->join(Langitem::$tableName, self::$tableName . '.' . self::$tbid, '=', Langitem::$tableName . '.' . Langitem::$tbitem_id)
            ->join(Language::$tableName, Langitem::$tableName . '.' . Langitem::$tblanguage_id, '=', Language::$tableName . '.' . Language::$tbid)
            ->leftJoin(itemcatvalues::$tableName, itemcatvalues::$tableName . '.' . itemcatvalues::$tbitem_Id, '=', self::$tableName . '.' . self::$tbid)
            //->join(langcatcustom::$tableName, langcatcustom::$tableName . '.' . langcatcustom::$tbcatvalcustom_id, '=', itemcatvalues::$tableName . '.' . itemcatvalues::$tbid)
            //->where(langcatcustom::$tableName . '.' . langcatcustom::$tblang_id, '=', Language::$tableName . '.' . Language::$tbid)
            ->select(self::$tableName . '.*'
                ,Langitem::$tableName . '.' . Langitem::$tbtitle
                ,Langitem::$tableName . '.' . Langitem::$tbdesc
                ,Langitem::$tableName . '.' . Langitem::$tbinfo
                ,Language::$tableName . '.' . Language::$tbLanguageName
                ,Language::$tableName . '.' . Language::$tbid  . ' as LanguageId'
                ,itemcatvalues::$tableName . '.' . itemcatvalues::$tbid . ' as itemcatvalues_ID'
                //,langcatcustom::$tableName . '.' . langcatcustom::$tbvalue
            )
            ->get()->sortBy(self::$tbitemOrder);


        //dd($AllData);
        foreach ($AllData as $elem){
            if($elem->itemcatvalues_ID != null){
                $obj = self::getDynamicValueData($elem->itemcatvalues_ID, $elem->LanguageId);
                $DataTypeObj = (new itemcatvalues())->getDatatypeOfCurrentData($elem->itemcatvalues_ID);
                $elem->value = array();
                $elem->value[$DataTypeObj->name] = $obj->value;
            }
        }
        //dd($AllData);
        $NewData = array();
        $counter = array();
        foreach ($AllData as $elem){
            if(self::counterExist($counter, $elem->id, $elem->LanguageId)){
                $index = self::getIndexOf($NewData, $elem->id, $elem->LanguageId);
                $val = $NewData[$index]->value;
                $key = key($NewData[$index]->value);
                $NewData[$index]->value = array();

                $obj = array();

                $obj['key'] = $key;
                $obj['value'] = $val[$key];
                array_push($NewData[$index]->value, $obj);

                $obj['key'] = key($elem->value);
                $obj['value'] = $elem->value[key($elem->value)];
                array_push($NewData[$index]->value, $obj);
//                $NewData[$index]['key'] =
                //$NewData[$index]['value'] = $elem->value;
                //$NewData[$index]->value = array_merge($NewData[$index]->value, $elem->value);
                //dd($NewData[$index]->value);
            }else{
                array_push($NewData, $elem);
                $counter = self::recorde($counter, $elem);
            }
        }

        foreach ($NewData as $index => $elem){
            $itemCustomAttributeFeilds = DB::table(self::$tableName)
                ->join(itemcustomattr::$tableName, itemcustomattr::$tableName . '.' . itemcustomattr::$tbitem_id, '=', self::$tableName . '.' . self::$tbid)
                ->where(self::$tableName . '.' . self::$tbid, '=', $elem->id)
                ->select(itemcustomattr::$tableName . '.' . itemcustomattr::$tbid
                        ,itemcustomattr::$tableName . '.' . itemcustomattr::$tbname
                        ,itemcustomattr::$tableName . '.' . itemcustomattr::$tbtype
                )
                ->get();
            if(sizeof($itemCustomAttributeFeilds) >= 1){
                $NewData[$index]->itemCustomAttr = array();
                $NewData[$index]->itemCustomAttr['id'] = array();
                $NewData[$index]->itemCustomAttr['name'] = array();
                $NewData[$index]->itemCustomAttr['type'] = array();
            }
            foreach ($itemCustomAttributeFeilds as $type){
                array_push($NewData[$index]->itemCustomAttr['id'], $type->id);
                array_push($NewData[$index]->itemCustomAttr['name'], $type->name);
                array_push($NewData[$index]->itemCustomAttr['type'], $type->type);
            }
            //var_dump($itemCustomAttributeFeilds);
        }
//dd($NewData);
        foreach ($NewData as $index => $elem) {
            $CustomAttrData = DB::table(self::$tableName)
                ->join(itemcustomattr::$tableName, itemcustomattr::$tableName . '.' . itemcustomattr::$tbitem_id, '=', self::$tableName . '.' . self::$tbid)
                ->join(langitemcustom::$tableName, langitemcustom::$tableName . '.' . langitemcustom::$tbitemcustom_id, '=', itemcustomattr::$tableName . '.' . itemcustomattr::$tbid)
                ->join(Language::$tableName, Language::$tableName . '.' . Language::$tbid, '=', langitemcustom::$tableName . '.' . langitemcustom::$tblang_id)
                ->where(self::$tableName . '.' . self::$tbid, '=', $elem->id)
                ->where(Language::$tableName . '.' . Language::$tbid, '=', $elem->LanguageId)
                ->select(
                    self::$tableName . '.' . self::$tbid
                    , itemcustomattr::$tableName . '.*'
                    , langitemcustom::$tableName . '.*'
                    , Language::$tableName . '.' . Language::$tbid . ' as Language_id'
                )
                ->get();
            //dd($CustomAttrData);
            if(sizeof($CustomAttrData) > 0){
                foreach ($CustomAttrData as $val) {
                    $NewData[$index]->itemCustomAttr['value'] = array();
                    array_push($NewData[$index]->itemCustomAttr['value'], $val->value);
                    //$NewData[$index]->itemCustomAttr['value'] = $val->value;
                }
            }
        }
        // ----------------------

        //dd($CustomAttrData);
        // ----------------------


        //dd($NewData);
        //dd($AllData);
        return $NewData;
    }
    public function getIndexOf($AllData, $item_id, $Lang_id){
//        var_dump($item_id);
//        var_dump($Lang_id);
        foreach ($AllData as $index => $elem){
//            var_dump($elem);
//            var_dump($index);
            if($elem->id == $item_id && $elem->LanguageId == $Lang_id){
                return $index;
            }
        }
    }
    public function counterExist($counter, $id, $Langid){
        foreach ($counter as $elem){
            if($elem['item_id'] == $id && $elem['language_id'] == $Langid){
                return true;
            }
        }
        return false;
    }
    public function recorde($counter, $obj){
        $Data = ['item_id' => $obj->id, 'language_id' => $obj->LanguageId];
        array_push($counter, $Data);
        return $counter;
    }

    public function getFirstCategoryId(){
        $AllData = DB::table(category::$tableName)
            ->select(category::$tableName . '.' . category::$tbid)
            ->get()->first();
        return $AllData->id;
    }
    public function getDynamicValueData($itemcatvalues_ID, $lang_id){
        $AllData = DB::table(langcatcustom::$tableName)
            ->where(langcatcustom::$tableName . '.' . langcatcustom::$tbcatvalcustom_id, '=', $itemcatvalues_ID)
            ->where(langcatcustom::$tableName . '.' . langcatcustom::$tblang_id, '=', $lang_id)
            ->select(langcatcustom::$tableName. '.' . langcatcustom::$tbvalue)
            ->get();
        ;
        return $AllData[0];
    }

    public function getitembycategoy($id, $LangId){

        $AllData = DB::table(self::$tableName)
            ->join(Langitem::$tableName, self::$tableName . '.' . self::$tbid, '=', Langitem::$tableName . '.' . Langitem::$tbitem_id)
            ->join(Language::$tableName, Langitem::$tableName . '.' . Langitem::$tblanguage_id, '=', Language::$tableName . '.' . Language::$tbid)
            ->where(Langitem::$tableName . '.' . Langitem::$tblanguage_id, '=', $LangId)
            ->where(self::$tableName . '.' . self::$tbcategoryId, '=', $id)
            ->select(self::$tableName . '.*',
                Langitem::$tableName . '.title',
                Langitem::$tableName . '.desc',
                Langitem::$tableName . '.info',
                Language::$tableName . '.LanguageName',
                Language::$tableName . '.' . Language::$tbid  . ' as LanguageId')
            ->get()->sortBy(self::$tbitemOrder);
        Session::put('defaultLanguage', $LangId);
        return $AllData;
    }

    public function getDataById($id, $LangId){

        $AllData = DB::table(self::$tableName)
            ->join(Langitem::$tableName, self::$tableName . '.' . self::$tbid, '=', Langitem::$tableName . '.' . Langitem::$tbitem_id)
            ->join(Language::$tableName, Langitem::$tableName . '.' . Langitem::$tblanguage_id, '=', Language::$tableName . '.' . Language::$tbid)
            ->where(Language::$tableName . '.' . Language::$tbid, '=', $LangId)
            ->where(self::$tableName . '.' . self::$tbid, '=', $id)
            ->select(self::$tableName . '.*'
                , Langitem::$tableName . '.title'
                , Langitem::$tableName .'.desc'
                , Langitem::$tableName .'.info'
                ,  Language::$tableName . '.LanguageName'
            )
            ->get()->sortBy('itemOrder');

        Session::put('defaultLanguage', $LangId);
        return $AllData[0];
    }


    public function arrayOfReqestItemCustom($Objects){

        //dd($Objects);
        $request = array();
        $Languages = array();
        foreach ($Objects->request->keys() as $elem){
            if(strpos($elem, 'dynamicItemCustomAttrValue')) {
                if (strpos($elem, 'lang')) {
                    $splitedArray = explode("_", $elem);
                    //var_dump($splitedArray);
                    if (!in_array($splitedArray[2], $Languages)) {
                        array_push($Languages, $splitedArray[2]);
                    }
                }
            }
        }

        foreach ($Languages as $elem){
            $Data = array();
            $Data['Langkey'] = $elem;
            $Data['Attrid'] = array();
            $Data['AttrKey'] = array();
            $Data['AttrVal'] = array();
            array_push($request, $Data);
        }

        foreach ($Objects->request->keys() as $elem){
            if(strpos($elem, 'dynamicItemCustomAttrValue')) {
                if (strpos($elem, 'lang')) {
                    $splitedArray = explode("_", $elem);
                    array_push($request[(new helper())->returnIndex($request, $splitedArray[2])]['Attrid'], $splitedArray[4]);
                    array_push($request[(new helper())->returnIndex($request, $splitedArray[2])]['AttrKey'], $splitedArray[0]);
                    array_push($request[(new helper())->returnIndex($request, $splitedArray[2])]['AttrVal'], $Objects[$elem]);
                }
            }
        }
        return $request;
    }

    public function arrayOfReqest($Objects){

        //dd($Objects);
        $request = array();
        $Languages = array();
        foreach ($Objects->request->keys() as $elem){
            if(!strpos($elem, 'dynamicItemCustomAttrValue')) {
                if (strpos($elem, 'lang')) {
                    $splitedArray = explode("_", $elem);
                    //var_dump($splitedArray);
                    if (!in_array($splitedArray[2], $Languages)) {
                        array_push($Languages, $splitedArray[2]);
                    }
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
            if(!strpos($elem, 'dynamicItemCustomAttrValue')) {
                if (strpos($elem, 'lang')) {
                    $splitedArray = explode("_", $elem);
                    array_push($request[(new helper())->returnIndex($request, $splitedArray[2])]['AttrKey'], $splitedArray[0]);
                    array_push($request[(new helper())->returnIndex($request, $splitedArray[2])]['AttrVal'], $Objects[$elem]);
                }
            }
        }
        return $request;
    }

    public function makeRequestItemCustom($request, $MenuItemId){
        $secRequest = array();
        foreach ($request as $elem){
            $curr = array();
            $curr['item_id'] = $MenuItemId;
            $curr['language_id'] = $elem['Langkey'];
            foreach ($elem['AttrKey'] as $index => $attr){
                //$curr[$attr] = $elem['AttrVal'][$index];
                $curr['value'] = $elem['AttrVal'][$index];
                $curr['itemAttr_id'] = $elem['Attrid'][$index];
            }
            array_push($secRequest, $curr);
        }
        return $secRequest;
    }

    public function makeRequest($request, $MenuItemId){
        $secRequest = array();
        foreach ($request as $elem){
            $curr = array();
            $curr['item_id'] = $MenuItemId;
            $curr['language_id'] = $elem['Langkey'];
            foreach ($elem['AttrKey'] as $index => $attr){
                $curr[$attr] = $elem['AttrVal'][$index];
            }
            array_push($secRequest, $curr);
        }
        return $secRequest;
    }

    public function getDataValue($AllRequest){
        //dd($AllRequest->request->all());
        $request = array();
        $Languages = array();
        foreach ($AllRequest->request->keys() as $elem){
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

        foreach ($AllRequest->request->keys() as $elem){
            if(strpos($elem, 'lang')){
                $splitedArray = explode("_",$elem);
                if(sizeof($splitedArray) >= 4){
                    array_push($request[(new helper())->returnIndex($request, $splitedArray[2])]['AttrKey'], $splitedArray[0]);
                    $value = array();
                    $value['categoryCustomId'] = $splitedArray[4];
                    $value['value'] = $AllRequest[$elem];
                    array_push($request[(new helper())->returnIndex($request, $splitedArray[2])]['AttrVal'], $value);
                }
            }
        }
        return $request;
    }
    public function makeObject($AllRequest){
        $Data = array();
        $AllObj = array();
        foreach ($AllRequest as $elem){
            foreach ($elem['AttrVal'] as $val){
                $Obj = array();
                $Obj['language_id'] = $elem['Langkey'];
                $Obj['value'] = $val['value'];
                $Obj['categoryCustomId'] = $val['categoryCustomId'];
                array_push($AllObj, $Obj);
            }
        }
        return $AllObj;
    }
}
