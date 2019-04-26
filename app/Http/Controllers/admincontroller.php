<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;

class admincontroller extends Controller
{

    public $globalVariable;
    public $role;
    public function __construct(){

        $this->role = 'Data';
        (new User())->CheckUserauthorization($this, $this->role);//Front //Data //Role

        $this->globalVariable = (new globalcontroller())->getGlobalVariable();
    }

    public function homepage(){


        $this->role = (new User())->getAllUser_Roles(Auth::user()->id);

        $Data = ['globalVariable' => $this->globalVariable
                , 'role' => $this->role
        ];
        return view('Admin.home.home', compact('Data'));
    }
}
