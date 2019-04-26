<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use DB;

class Language extends Model
{
    public static $tableName = 'languages';
    public static $tbid = 'id';
    public static $tbLanguageName = 'LanguageName';

    public function getAllLanguage(){
        $AllLanguage = Language::all()->sortBy('LanguageName ');
        $AllLanguage = (new helper())->getObjectsArray($AllLanguage);
        foreach ($AllLanguage as $index => $Lang){
            $AllLanguage[$index] = (object) $Lang;
        }
        return $AllLanguage;
    }

    public function setallAttribute($request){

        $this->LanguageName  = $request->LanguageName ;
        $this->created_at = Carbon::now();
        $this->updated_at = Carbon::now();
    }

    public function IsThereDocInLang($id){

        $Lang = (new Langmenuitem())->IsThereDocInLang($id);
        if(!$Lang)return false;

        $Lang = (new Langcategory())->IsThereDocInLang($id);
        if(!$Lang)return false;

        $Lang = (new Langitem())->IsThereDocInLang($id);
        if(!$Lang)return false;

        return true;
    }

}
