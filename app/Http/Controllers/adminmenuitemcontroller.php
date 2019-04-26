<?php

namespace App\Http\Controllers;
use App\helper;
use DB;
use \App\MenuItem;
use \App\category;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Language;
use App\User;
use Illuminate\Support\Facades\Auth;

class adminmenuitemcontroller extends Controller
{
    public $globalVariable;
    public $role;
    public static $controller = 'menuItem';
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
        $AllData = (new MenuItem)->getAllData();
        $AllData2 = (new category)->getAllData();
        //dd($AllData2);
        $this->role = (new User())->getAllUser_Roles(Auth::user()->id);
        $Data = ['globalVariable' => $this->globalVariable
                , 'MenuItem' => $AllData
                ,'category' => $AllData2
                , 'Languages' => $AllLanguage
                , 'role' => $this->role
        ];
        return view('Admin.menuitem.menuitem', compact('Data'));
    }
}
