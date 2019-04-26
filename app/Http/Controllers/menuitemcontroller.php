<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use \App\MenuItem;
use \App\category;
use App\helper;
use Carbon\Carbon;
use App\Langmenuitem;
use App\Language;
use App\User;
use Illuminate\Support\Facades\Auth;

class menuitemcontroller extends Controller
{

    public $globalVariable;
    public $role;
    public static $controller = 'menuItem';
    public $action;
    public function __construct(){

        $this->role = 'Front';
        (new User())->CheckUserauthorization($this, $this->role);//Front //Data //Role

        $this->globalVariable = (new globalcontroller())->getGlobalVariable();
    }

    public function storeview(){

        $this->action = 'store';
        (new User())->CheckUserPermissions($this, $this->action, self::$controller);

        $AllLanguage = (new Language())->getAllLanguage();
        $AllData2 =(new category())->getAllData();
        $AllData =(new MenuItem)->getAllData();
        $this->role = (new User())->getAllUser_Roles(Auth::user()->id);
        $Data = ['globalVariable' => $this->globalVariable
                ,'category'=>$AllData2
                ,'MenuItem'=>$AllData
                , 'allLang' => $AllLanguage
                , 'role' => $this->role
        ];
        return view('Admin.menuitem.storemenuitem', compact('Data'));
    }

    public function store(Request $request){

        $this->action = 'store';
        (new User())->CheckUserPermissions($this, $this->action, self::$controller);

        $Menu_item=new MenuItem;
        $Menu_item->setallAttribute($request);
        $Menu_item->save();

        $secRequest = (new MenuItem())->makeRequest((new MenuItem())->arrayOfReqest($request), $Menu_item['id']);

        foreach ($secRequest as $elem){
            $Lang_Menu_item = new Langmenuitem();
            $Lang_Menu_item->setallAttribute($elem);
            $Lang_Menu_item->save();
        }

        $AllData = (new MenuItem)->getAllData();  $AllData2 = (new category)->getAllData();
        $AllLanguage = (new Language())->getAllLanguage();

        $this->role = (new User())->getAllUser_Roles(Auth::user()->id);
        $Data = ['globalVariable' => $this->globalVariable
                , 'MenuItem' => $AllData
                , 'category'=>$AllData2
                ,'Languages' => $AllLanguage
                , 'role' => $this->role
        ];
        return view('Admin.menuitem.menuitem', compact('Data'));
    }

    public function edit($id)
    {
        $this->action = 'edit';
        (new User())->CheckUserPermissions($this, $this->action, self::$controller);

        $AllData = (new MenuItem)->getDataById($id);

        $this->role = (new User())->getAllUser_Roles(Auth::user()->id);
        $Data = ['globalVariable' => $this->globalVariable
                , 'obj' => $AllData
                , 'role' => $this->role
        ];
        return view('Admin.menuitem.updatemenuitem',compact('Data'));
    }

    public function update($id, Request $request){

        $this->action = 'edit';
        (new User())->CheckUserPermissions($this, $this->action, self::$controller);

        $secRequest = (new MenuItem())->makeRequest((new MenuItem())->arrayOfReqest($request), $id);

        $Lang_Menu_item = Langmenuitem::get()->where(Langmenuitem::$tbmenuitem_id, '==', $id);

        $Lang_Menu_item = array_values($Lang_Menu_item->all());
        //dd($secRequest);
        foreach ($secRequest as $index => $elem){
            $Lang_Menu_item_obj = new Langmenuitem();
            $Lang_Menu_item_obj = $Lang_Menu_item[$index];
            $Lang_Menu_item_obj->setallAttribute($elem);
            $Lang_Menu_item_obj->save();
        }

        $Menu_item = MenuItem::find($id);
        $Menu_item->setallAttribute($request);
        $Menu_item->save();

        $AllData = (new MenuItem)->getAllData();
        $AllData2 = (new category)->getAllData();
        $AllLanguage = (new Language())->getAllLanguage();

        $this->role = (new User())->getAllUser_Roles(Auth::user()->id);
        $Data = ['globalVariable' => $this->globalVariable
                , 'MenuItem' => $AllData
                ,'category' => $AllData2
                , 'Languages' => $AllLanguage
                , 'role' => $this->role
        ];
        return view('Admin.menuitem.menuitem', compact('Data'));
    }

    public function destroy($id)
    {
        $this->action = 'delete';
        (new User())->CheckUserPermissions($this, $this->action, self::$controller);

        $Menu_item=MenuItem::find($id);

        $Lang_Menu_item = Langmenuitem::all()->where(Langmenuitem::$tbmenuitem_id, '==', $id);

        foreach ($Lang_Menu_item as $elem){
            $elem->delete();
        }
        $Menu_item->delete();

        $AllData = (new MenuItem)->getAllData();
        $AllData2 = (new category())->getAllData();
        $AllLanguage = (new Language())->getAllLanguage();

        $this->role = (new User())->getAllUser_Roles(Auth::user()->id);
        $Data = ['globalVariable' => $this->globalVariable
                , 'MenuItem' => $AllData
                ,'category' =>$AllData2
                , 'Languages' => $AllLanguage
                , 'role' => $this->role
        ];
        return view('Admin.menuitem.menuitem', compact('Data'));
    }

}
