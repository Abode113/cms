<?php

namespace App\Http\Controllers;

use App\helper;
use App\Language;
use Illuminate\Http\Request;
use Session;
use Carbon\Carbon;
use DB;
use App\User;
use Illuminate\Support\Facades\Auth;

class LanguageController extends Controller
{

    public $globalVariable;
    public $role;
    public static $controller = 'Language';
    public $action;
    public function __construct(){

        $this->role = 'Data';
        (new User())->CheckUserauthorization($this, $this->role);//Front //Data //Role

        $this->globalVariable = (new globalcontroller())->getGlobalVariable();
    }

    public function setdefaultLanguage(Request $request){
        //dd($request->request->all()['defaultLanguage']);
        Session::put('defaultLanguage', $request->request->all()['defaultLanguage']);

    }

    public function homepage(){

        //dd('hey');
        $this->action = 'browse';
        (new User())->CheckUserPermissions($this, $this->action, self::$controller);

        $AllData = (new Language())->getAllLanguage();

        $this->role = (new User())->getAllUser_Roles(Auth::user()->id);
        $Data = ['globalVariable' => $this->globalVariable
                , 'Languages' => $AllData
                , 'role' => $this->role
        ];
        return view('Admin.Language.Language', compact('Data'));
    }

    public function storeview(){
        $this->role = (new User())->getAllUser_Roles(Auth::user()->id);
        $Data = ['globalVariable' => $this->globalVariable
                , 'role' => $this->role
        ];
        return view('Admin.Language.storeLanguage', compact('Data'));
    }

    public function store(Request $request){

        $this->action = 'store';
        (new User())->CheckUserPermissions($this, $this->action, self::$controller);

        $Language = new Language();
        $Language->setallAttribute($request);
        $Language->save();

        $AllData = (new Language())->getAllLanguage();
        $this->role = (new User())->getAllUser_Roles(Auth::user()->id);
        $Data = ['globalVariable' => $this->globalVariable
                , 'Languages' => $AllData
                , 'role' => $this->role
        ];
        return view('Admin.Language.Language', compact('Data'));
    }

    public function destroy($id){

        $this->action = 'delete';
        (new User())->CheckUserPermissions($this, $this->action, self::$controller);

        $Language = Language::find($id);

        $SafeToRemove = (new Language())->IsThereDocInLang($id);
        //dd($SafeToRemove);
        if($SafeToRemove){
            $Language->delete();
        }

        $AllData = (new Language())->getAllLanguage();
        $this->role = (new User())->getAllUser_Roles(Auth::user()->id);
        $Data = ['globalVariable' => $this->globalVariable
                , 'Languages' => $AllData
                , 'role' => $this->role
        ];
        return view('Admin.Language.Language', compact('Data'));
    }

    public function update($id, Request $request){

        $this->action = 'edit';
        (new User())->CheckUserPermissions($this, $this->action, self::$controller);

        $Language = new Language();
        $Language = Language::find($id);
        $Language->setallAttribute($request);
        $Language->save();

        $AllData = (new Language())->getAllLanguage();
        $this->role = (new User())->getAllUser_Roles(Auth::user()->id);
        $Data = ['globalVariable' => $this->globalVariable
                , 'Languages' => $AllData
                , 'role' => $this->role
        ];
        return view('Admin.Language.Language', compact('Data'));
    }

}
