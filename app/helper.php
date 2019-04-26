<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;
use App\Langitem;
use Session;

class helper extends Model
{

    public function getObjectsArray($allObject){
        $result = array();
        foreach ($allObject as $val){
            array_push($result, $val->attributes);
        }
        return $result;
    }

    public function getObjectArray($allObject){
        return $allObject->attributes;
    }

    public function addAtributeAsArray($allObject, $attribute){
        $result = array();
        foreach ($allObject as $val){
            $val->$attribute = array();
            array_push($result, $val);
        }
        return $result;
    }

    public function getindexById($allObject, $id){
        foreach ($allObject as $index => $val){
            if($val->id == $id){
                return $index;
            }
        }
        return -1;
    }
    public function returnIndex($allObject, $id){
        foreach ($allObject as $index => $elem){
            if($elem['Langkey'] == $id) {
                return $index;
            }
        }
        return -1;
    }

    public function DeleteFromArrayOfIndex($allObjects, $itemToDelete){
        foreach ($itemToDelete as $val){
            unset($allObjects[$val]);
        }
        $newArray = array();
        foreach ($allObjects as $val){
            array_push($newArray, $val);
        }
        return $newArray;
    }

    public function getlangitemobj(){
        $obj = new Langitem();
        return $obj;
    }


}

?>
