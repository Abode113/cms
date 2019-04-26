<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use \App\MenuItem;
use Illuminate\Support\Facades\Auth;
use Session;
use App\User;

class homePageController extends Controller
{
    public $globalVariable;
    public $role;
    public function __construct(){
//        dd(Auth::id());
//        $this->middleware(['role:dataentry_role_name', 'role:admin_role_name']);
        $this->role = 'Front';
        (new User())->CheckUserauthorization($this, $this->role);//Front //Data //Role
        $this->globalVariable = (new globalcontroller())->getGlobalVariable();
    }

    public function index(){
        if(Session::get('defaultLanguage') == null) {
            Session::put('defaultLanguage', 1); // english
        }
        //dd(Session::get('defaultLanguage'));
        $MenuItems = new MenuItem();
        $result = $MenuItems->MakeNavBarTree();

        $this->role = (new User())->getAllUser_Roles(Auth::user()->id);
        $Data = ['globalVariable' => $this->globalVariable
                , 'MenuItem' => $result
                , 'role' => $this->role
        ];

        return view('view.HomePage.home', compact('Data'));
    }

    public function indexByLang($id){
        Session::put('defaultLanguage', $id);
        //dd(Session::get('defaultLanguage'));
        $MenuItems = new MenuItem();
        $result = $MenuItems->MakeNavBarTree();

        $this->role = (new User())->getAllUser_Roles(Auth::user()->id);
        $Data = ['globalVariable' => $this->globalVariable
                , 'MenuItem' => $result
                , 'role' => $this->role
        ];
        return view('view.HomePage.home', compact('Data'));
    }
}
