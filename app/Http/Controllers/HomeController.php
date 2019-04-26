<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use DB;
use \App\MenuItem;
use Session;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    protected $user;
    public $globalVariable;
    public $role;
    public function __construct()
    {
        //$user=User::where('id',2)->first();
        //dd(Auth::user()->id);

        $this->role = 'Front';

        (new User())->CheckUserauthorization($this, $this->role);//Front //Data //Role

        $this->globalVariable = (new globalcontroller())->getGlobalVariable();
    }


    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //dd(Auth::user()->id);
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
//        return view('home');
    }
}
