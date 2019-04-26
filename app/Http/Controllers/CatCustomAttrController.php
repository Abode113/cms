<?php

namespace App\Http\Controllers;
use App\helper;
use DB;
use \App\category;
use \App\Language;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\catcustomattr;
use App\User;
use Illuminate\Support\Facades\Auth;

class CatCustomAttrController extends Controller
{

    public $globalVariable;
    public $role;
    public static $controller = 'categoryCustom_attribute';
    public $action;
    public function __construct(){

        $this->role = 'Front';
        (new User())->CheckUserauthorization($this, $this->role);//Front //Data //Role

        $this->globalVariable = (new globalcontroller())->getGlobalVariable();
    }

    public function homepage(){

        $this->action = 'browse';
        (new User())->CheckUserPermissions($this, $this->action, self::$controller);

        $AllData = (new catcustomattr)->getAllData();
        $AllCategoryData=(new category())->getAllDataOfSpecificLang(1);

        $this->role = (new User())->getAllUser_Roles(Auth::user()->id);
        $Data = ['globalVariable' => $this->globalVariable
                , 'CatCustomAttr' => $AllData
                , 'category' => $AllCategoryData
                , 'role' => $this->role
        ];
        return view('Admin.CatCustomAttr.CatCustomAttr', compact('Data'));
    }

    public function storeview(){

        $this->action = 'store';
        (new User())->CheckUserPermissions($this, $this->action, self::$controller);

        $AllData=(new category())->getAllDataOfSpecificLang(1);
        //dd($AllData);
        $this->role = (new User())->getAllUser_Roles(Auth::user()->id);
        $Data = ['globalVariable' => $this->globalVariable
                ,'category'=>$AllData
                , 'role' => $this->role
        ];
        return view('Admin.CatCustomAttr.CatCustomAttrstore', compact('Data'));
    }

    public function store(Request $request){

        $this->action = 'store';
        (new User())->CheckUserPermissions($this, $this->action, self::$controller);

        $Catcustomattr = new catcustomattr();
        $Catcustomattr->setallAttribute($request);
        $Catcustomattr->save();

        $AllData = (new catcustomattr)->getAllData();

        $this->role = (new User())->getAllUser_Roles(Auth::user()->id);
        $Data = ['globalVariable' => $this->globalVariable
                , 'CatCustomAttr' => $AllData
                , 'role' => $this->role
        ];
        return view('Admin.CatCustomAttr.CatCustomAttr', compact('Data'));
    }

    public function update($id, Request $request){

        $this->action = 'edit';
        (new User())->CheckUserPermissions($this, $this->action, self::$controller);

        $Catcustomattr = new catcustomattr();
        $Catcustomattr = catcustomattr::find($id);
        $Catcustomattr->setallAttribute($request);
        $Catcustomattr->save();

        $AllData = (new catcustomattr)->getAllData();
        $AllCategoryData=(new category())->getAllDataOfSpecificLang(1);

        $this->role = (new User())->getAllUser_Roles(Auth::user()->id);
        $Data = ['globalVariable' => $this->globalVariable
                , 'CatCustomAttr' => $AllData
                , 'category' => $AllCategoryData
                , 'role' => $this->role
        ];
        return view('Admin.CatCustomAttr.CatCustomAttr', compact('Data'));

    }

    public function destroy($id){

        $this->action = 'delete';
        (new User())->CheckUserPermissions($this, $this->action, self::$controller);

        $Catcustomattr = catcustomattr::find($id);
        $Catcustomattr->delete();

        $AllData = (new catcustomattr)->getAllData();

        $this->role = (new User())->getAllUser_Roles(Auth::user()->id);
        $Data = ['globalVariable' => $this->globalVariable
                , 'CatCustomAttr' => $AllData
                , 'role' => $this->role
        ];
        return view('Admin.CatCustomAttr.CatCustomAttr', compact('Data'));
    }
}
