<?php

namespace App\Http\Controllers;
use App\helper;
use DB;
use \App\item;
use App\Language;
use App\category;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;
use App\itemcustomattr;

class itemcustomattrcontroller extends Controller
{
    public $globalVariable;
    public $role;
    public static $controller = 'itemCustom_attribute';
    public $action;
    public function __construct(){

        $this->role = 'Data';
        (new User())->CheckUserauthorization($this, $this->role);//Front //Data //Role

        $this->globalVariable = (new globalcontroller())->getGlobalVariable();
    }

    public function homepage(){

        $this->action = 'browse';
        (new User())->CheckUserPermissions($this, $this->action, self::$controller);

        $AllData = (new itemcustomattr)->getAllData();
        //dd($AllData);
        $AllDataItem = (new item)->getDataByLanguage(1);
        $this->role = (new User())->getAllUser_Roles(Auth::user()->id);
        $Data = ['globalVariable' => $this->globalVariable
            , 'itemsCustomAttr' => $AllData
            , 'items' => $AllDataItem
            , 'role' => $this->role
        ];
        return view('Admin.itemCustom.itemCustom', compact('Data'));
    }

    public function store(Request $request){

        $this->action = 'store';
        (new User())->CheckUserPermissions($this, $this->action, self::$controller);

        if($request['items']){
            foreach ($request['items'] as $elem){
                $obj = new itemcustomattr();
                $obj->setallAttribute($elem, $request);
                $obj->save();
            }
        }

        $AllData = (new itemcustomattr)->getAllData();
        $AllDataItem = (new item)->getDataByLanguage(1);
        $this->role = (new User())->getAllUser_Roles(Auth::user()->id);
        $Data = ['globalVariable' => $this->globalVariable
            , 'itemsCustomAttr' => $AllData
            , 'items' => $AllDataItem
            , 'role' => $this->role
        ];
        return view('Admin.itemCustom.itemCustom', compact('Data'));
    }

    public function destroy($id){

        $this->action = 'delete';
        (new User())->CheckUserPermissions($this, $this->action, self::$controller);

        $SafeToRemove = (new itemcustomattr())->IsThereDocInLang($id);
        if($SafeToRemove){
            $itemCustomAttr = itemcustomattr::find($id);
            $itemCustomAttr->delete();
        }

        $AllData = (new itemcustomattr)->getAllData();
        $AllDataItem = (new item)->getDataByLanguage(1);
        $this->role = (new User())->getAllUser_Roles(Auth::user()->id);
        $Data = ['globalVariable' => $this->globalVariable
            , 'itemsCustomAttr' => $AllData
            , 'items' => $AllDataItem
            , 'role' => $this->role
        ];
        return view('Admin.itemCustom.itemCustom', compact('Data'));
    }

    public function update($id, Request $request){

        $this->action = 'edit';
        (new User())->CheckUserPermissions($this, $this->action, self::$controller);

        $SafeToRemove = (new itemcustomattr())->IsThereDocInLang($id);
        if($SafeToRemove){
            $itemCustomAttr = itemcustomattr::find($id);
            $itemCustomAttr->_setallAttribute($request);
            $itemCustomAttr->save();
        }



        $AllData = (new itemcustomattr)->getAllData();
        $AllDataItem = (new item)->getDataByLanguage(1);
        $this->role = (new User())->getAllUser_Roles(Auth::user()->id);
        $Data = ['globalVariable' => $this->globalVariable
            , 'itemsCustomAttr' => $AllData
            , 'items' => $AllDataItem
            , 'role' => $this->role
        ];
        return view('Admin.itemCustom.itemCustom', compact('Data'));
    }
}
