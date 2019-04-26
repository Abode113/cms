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

class adminitemcontroller extends Controller
{
    public $globalVariable;
    public $role;
    public static $controller = 'item';
    public $action;
    public function __construct(){

        $this->role = 'Data';
        (new User())->CheckUserauthorization($this, $this->role);//Front //Data //Role

        $this->globalVariable = (new globalcontroller())->getGlobalVariable();
    }

    public function homepage(){

        $this->action = 'browse';
        (new User())->CheckUserPermissions($this, $this->action, self::$controller);

        $AllLanguage = (new Language())->getAllLanguage();

        $AllItemData = (new item)->getAllData();
        //dd('hey');
        $AllCategoryData = (new category)->getAllData();



        $this->role = (new User())->getAllUser_Roles(Auth::user()->id);
        $Data = [
            'globalVariable' => $this->globalVariable
            , 'items' => $AllItemData
            , 'category' => $AllCategoryData
            , 'Languages' => $AllLanguage
            , 'role' => $this->role
        ];
        return view('Admin.item.item', compact('Data'));
    }
}
