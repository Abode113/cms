<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use DB;

class diclang extends Model
{
    public static $tableName = 'diclang';
    public static $tbLanguage_id  = 'Language_id ';
    public static $tbdictionary_id = 'dictionary_id';
    public static $tbcreated_at = 'created_at';
    public static $tbupdated_at = 'updated_at';

    public function setallAttribute($request){

        $this->word = $request['word'];
        $this->Language_id = $request['language_id'];
        $this->dictionary_id = $request['dictionary_id'];
        $this->created_at = Carbon::now();
        $this->updated_at = Carbon::now();
    }

}
?>
