<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class langitemcustom extends Model
{
    public static $tableName = 'langitemcustoms';
    public static $tbid = "id";
    public static $tblang_id = "lang_id";
    public static $tbitemcustom_id = "itemcustom_id";
    public static $tbvalue = 'value';
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
//dd($request);
        $this->itemcustom_id = $request['itemAttr_id'];
        $this->lang_id = $request['language_id'];
        $this->value = $request['value'];
        $this->created_at = Carbon::now();
        $this->updated_at = Carbon::now();
    }

}
