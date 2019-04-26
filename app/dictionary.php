<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use DB;

class dictionary extends Model
{
    public static $tableName = 'dictionaries';
    public static $tbid = 'id';
    public static $tbWord  = 'Word';
    public static $tbLanguage_id   = 'Language_id';
    public static $tbcreated_at  = 'created_at';
    public static $tbupdated_at   = 'updated_at';

    public function getAllWordsByLang($LangId){
        $AllData = DB::table(self::$tableName)
            ->join('diclangs', 'diclangs.dictionary_id', '=', self::$tableName . '.' . self::$tbid)
            ->join(Language::$tableName, Language::$tableName . '.' . Language::$tbid, '=', 'diclangs.Language_id')
            ->where(Language::$tableName . '.' . Language::$tbid, '=', $LangId)
            ->select(
                self::$tableName . '.' . self::$tbid
                ,'diclangs.word'
                ,Language::$tbLanguageName
                ,'diclangs.created_at'
                ,'diclangs.updated_at')
            ->get();
        return $AllData;
    }

    public function getAllWordsData(){
        $AllData = DB::table(self::$tableName)
            ->join('diclangs', 'diclangs.dictionary_id', '=', self::$tableName . '.' . self::$tbid)
            ->join(Language::$tableName, Language::$tableName . '.' . Language::$tbid, '=', 'diclangs.Language_id')
            ->select(
                self::$tableName . '.' . self::$tbid
                ,'diclangs.word'
                ,'diclangs.id as Word_id'
                ,Language::$tableName . '.' . Language::$tbLanguageName
                ,Language::$tableName . '.' . Language::$tbid . ' as Language_id'
                ,'diclangs.created_at'
                ,'diclangs.updated_at')
            ->get();
        //dd($AllData);
        $arrayOf_id = array();
        $Data = array();
        foreach ($AllData as $elem){
            if(!in_array($elem->id, $arrayOf_id)){
                array_push($arrayOf_id, $elem->id);
                $obj = array();
                $obj['id'] = $elem->id;
                $obj['Data'] = array();
                $DataObj = array();
                $DataObj['word'] = $elem->word;
                $DataObj['LanguageName'] = $elem->LanguageName;
                $DataObj['Language_id'] = $elem->Language_id;
                $DataObj['Word_id'] = $elem->Word_id;
                array_push($obj['Data'], $DataObj);
                array_push($Data, $obj);
            }else{
                foreach($Data as $index => $_elem){
                    if($elem->id == $_elem['id']){
                        $DataObj = array();
                        $DataObj['word'] = $elem->word;
                        $DataObj['LanguageName'] = $elem->LanguageName;
                        $DataObj['Language_id'] = $elem->Language_id;
                        $DataObj['Word_id'] = $elem->Word_id;

                        array_push($Data[$index]['Data'], $DataObj);
                    }
                }
            }
        }
        return $Data;
    }

    public function getDictionaryData($DictionaryWord, $LangId){
        $AllData = array();
        foreach ($DictionaryWord as $word) {
            $id = DB::table(self::$tableName)
                ->join('diclangs', 'diclangs.dictionary_id', '=', self::$tableName . '.' . self::$tbid)
                ->where('diclangs.word', '=', $word)
                ->select(
                    self::$tableName . '.' . self::$tbid)
                ->get();
            if ($id != null) {
                $id = $id[0]->id;
                $Data = DB::table(self::$tableName)
                    ->join('diclangs', 'diclangs.dictionary_id', '=', self::$tableName . '.' . self::$tbid)
                    ->join(Language::$tableName, Language::$tableName . '.' . Language::$tbid, '=', 'diclangs.Language_id')
                    ->where(Language::$tableName . '.' . Language::$tbid, '=', $LangId)
                    ->where(self::$tableName . '.' . self::$tbid, '=', $id)
                    ->select(
                        self::$tableName . '.' . self::$tbid
                        , 'diclangs.word'
                        , Language::$tbLanguageName
                        , 'diclangs.created_at'
                        , 'diclangs.updated_at')
                    ->get();
                $AllData[$word] = $Data[0];
            }
        }
        return $AllData;
    }

    public function getWordID($dictionary_id, $language_id){
        $AllData = DB::table(self::$tableName)
            ->join('diclangs', 'diclangs.dictionary_id', '=', self::$tableName . '.' . self::$tbid)
            ->join(Language::$tableName, Language::$tableName . '.' . Language::$tbid, '=', 'diclangs.Language_id')
            ->where(self::$tableName . '.' . self::$tbid, '=', $dictionary_id)
            ->where(Language::$tableName . '.' . Language::$tbid, '=', $language_id)
            ->select('diclangs.id')
            ->get();
        return $AllData[0]->id;
    }

    public function getAllLangsOfSpecificWords($WordId){
        $AllData = DB::table(self::$tableName)
            ->join('diclangs', 'diclangs.dictionary_id', '=', self::$tableName . '.' . self::$tbid)
            ->join(Language::$tableName, Language::$tableName . '.' . Language::$tbid, '=', 'diclangs.Language_id')
            ->where(self::$tableName . '.' . self::$tbid, '=', $WordId)
            ->select('diclangs.id')
            ->get();
        return $AllData;
    }

    public function setallAttribute(){
        $this->created_at = Carbon::now();
        $this->updated_at = Carbon::now();
    }

    public function arrayOfReqest($Objects){
        //dd($Objects->request->all());
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
        //dd($request);
        $secRequest = array();
        foreach ($request as $elem){
            $curr = array();
            $curr['dictionary_id'] = $MenuItemId;
            $curr['language_id'] = $elem['Langkey'];
            foreach ($elem['AttrKey'] as $index => $attr){
                $curr[$attr] = $elem['AttrVal'][$index];
            }
            array_push($secRequest, $curr);
        }
        return $secRequest;
    }

}
