<?php

namespace App\Http\Controllers;

use App\dictionary;
use APP\Langitem;
use App\helper;
use App\langitemcustom;
use Illuminate\Http\Request;
use DB;
use \App\MenuItem;
use \App\item;
use App\category;

use App\Language;
use Carbon\Carbon;
use Session;
use App\catcustomattr;
use App\itemcatvalues;
use App\langcatcustom;
use App\User;
use Illuminate\Support\Facades\Auth;
use App\itemcustomattr;

class itemcontroller extends Controller
{

    public $globalVariable;
    public $role;
    public static $controller = 'item';
    public $action;
    public function __construct(){

        $this->role = 'Front';
        (new User())->CheckUserauthorization($this, $this->role);//Front //Data //Role

        $this->globalVariable = (new globalcontroller())->getGlobalVariable();
    }

    public function storeview($CatDefId){

        $this->action = 'store';
        (new User())->CheckUserPermissions($this, $this->action, self::$controller);

        //dd($CatDefId);
        $AllLanguage = (new Language())->getAllLanguage();
        $AllData2 = (new category())->getAllDataOfSpecificLang(1);

        if($CatDefId == 0){
            $CatDefaultId = (new item())->getFirstCategoryId();
        }else{
            $CatDefaultId = $CatDefId;
        }
        $AllData3 = (new catcustomattr)->getAllDataByCategoryId($CatDefaultId);

        $this->role = (new User())->getAllUser_Roles(Auth::user()->id);
        $Data = [
            'globalVariable' => $this->globalVariable
            ,'category'=>$AllData2
            , 'Languages' => $AllLanguage
            , 'CatCustomAttr' => $AllData3
            , 'CatDefaultId' => $CatDefaultId
            , 'role' => $this->role
        ];
        return view('Admin.item.storeitem', compact('Data'));
    }

    public function index(){

        $this->action = 'browse';
        (new User())->CheckUserPermissions($this, $this->action, self::$controller);

        $result = (new MenuItem())->MakeNavBarTree();

        $items = item::all();
        $items = (new helper())->getObjectsArray($items);

        $this->role = (new User())->getAllUser_Roles(Auth::user()->id);
        $Data = ['globalVariable' => $this->globalVariable
                , 'MenuItem' => $result
                , 'allItems' => $items
        ];
        return view('item.item', compact('Data'));
    }
    public function getallitem(){

        $this->action = 'browse';
        (new User())->CheckUserPermissions($this, $this->action, self::$controller);

        $result = (new MenuItem())->MakeNavBarTree();

        $items = item::all();
        $items = (new helper())->getObjectsArray($items);

        $this->role = (new User())->getAllUser_Roles(Auth::user()->id);
        $Data = ['globalVariable' => $this->globalVariable
                , 'MenuItem' => $result
                , 'allItems' => $items
        ];
        return view('item.item', compact('Data'));
    }

    public function getitembycategoy($id, $LangId){

        $this->action = 'browse';
        (new User())->CheckUserPermissions($this, $this->action, self::$controller);

        $result = (new MenuItem())->MakeNavBarTree();

        $ItemsCat = (new item())->getitembycategoy($id, $LangId);

        $categoryFatherObj = (new category())->GetCategoryById($id, $LangId);

        $DictionaryWord = array();
        array_push($DictionaryWord, 'Detail_en');
        //array_push($DictionaryWord, 'word_2_en');
        $DictionaryData = (new dictionary())->getDictionaryData($DictionaryWord, $LangId);

        $this->role = (new User())->getAllUser_Roles(Auth::user()->id);
        $Data = ['globalVariable' => $this->globalVariable
                , 'MenuItem' => $result
                , 'allItems' => $ItemsCat
                , 'fatherObj' => $categoryFatherObj
                , 'Words' => $DictionaryData
                , 'role' => $this->role
        ];
        Session::put('defaultLanguage', $LangId);
        return view('item.item', compact('Data'));
    }

    public function getitembyid($id, $LangId){

        $this->action = 'browse';
        (new User())->CheckUserPermissions($this, $this->action, self::$controller);

        $result = (new MenuItem())->MakeNavBarTree();

        $item = (new item())->getDataById($id, $LangId);

        $this->role = (new User())->getAllUser_Roles(Auth::user()->id);
        $Data = ['globalVariable' => $this->globalVariable
                , 'MenuItem' => $result
                , 'allItems' => $item
                , 'role' => $this->role
        ];
        Session::put('defaultLanguage', $LangId);
        return view('item.itemDetail.itemDetail', compact('Data'));
    }


    public function store(Request $request){

        $this->action = 'store';
        (new User())->CheckUserPermissions($this, $this->action, self::$controller);

        $Item=new item;     // item
        $Item->setallAttribute($request);
        $Item->save();

        $ValueData = (new item())->makeObject((new item())->getDataValue($request));

        $categoryCustomIds = (new itemcatvalues)->getcategoryCustomId($ValueData);

        $ItemcatvaluesArray = array();
        foreach ($categoryCustomIds as $elem) {
            $Itemcatvalues = new itemcatvalues();   // item category value
            $Itemcatvalues->setallAttribute($Item['id'], $elem);//, $request['category_id']
            $Itemcatvalues->save();
            $obj = array();
            $obj['categoryCustomId'] = $elem;
            $obj['ItemcatvaluesId'] = $Itemcatvalues['id'];
            array_push($ItemcatvaluesArray, $obj);
        }

        foreach ($ValueData as $elem){  //  language category cutsom value
            $Itemcatvaluesid = (new langcatcustom())->getItemcatvaluesid($elem, $ItemcatvaluesArray);
            $Langcatcustom = new langcatcustom();
            $Langcatcustom->setallAttribute($elem, $Itemcatvaluesid);
            $Langcatcustom->save();
        }

        $secRequest = (new item())->makeRequest((new item())->arrayOfReqest($request), $Item['id']);

        foreach ($secRequest as $elem){ //  static data
            $Lang_item = (new helper())->getlangitemobj();
            $Lang_item->setallAttribute($elem);
            $Lang_item->save();
        }

        $AllData = (new item)->getAllData();
        $AllData2 = (new category())->getAllData();
        $AllLanguage = (new Language())->getAllLanguage();
        $cat = (new category())->getAllData();

        $this->role = (new User())->getAllUser_Roles(Auth::user()->id);
        $Data = ['globalVariable' => $this->globalVariable
                , 'items' => $AllData
                ,'category'=>$AllData2
                , 'Languages' => $AllLanguage
                , 'cat' => $cat
                , 'role' => $this->role
        ];
        return view('Admin.item.item', compact('Data'));
    }

    public function edit($id, $LangId){

        $this->action = 'edit';
        (new User())->CheckUserPermissions($this, $this->action, self::$controller);

        $AllData = (new item)->getDataById($id, $LangId);

        $this->role = (new User())->getAllUser_Roles(Auth::user()->id);
        $Data = ['globalVariable' => $this->globalVariable
                , 'obj' => $AllData
                , 'role' => $this->role
        ];
        Session::put('defaultLanguage', $LangId);
        return view('Admin.item.updateitem',compact('Data'));
    }

    public function update($id,Request $request){

        $this->action = 'edit';
        (new User())->CheckUserPermissions($this, $this->action, self::$controller);

        $thirdRequest = (new item())->makeRequestItemCustom((new item())->arrayOfReqestItemCustom($request), $id);
        //dd($thirdRequest);
        foreach ($thirdRequest as $index => $elem){
            $obj = new langitemcustom();
            $obj->_setallAttribute($elem);
            $obj->save();
        }

        $secRequest = (new item())->makeRequest((new item())->arrayOfReqest($request), $id);

        $LangItemObj = (new helper())->getlangitemobj();
        $Lang_item = $LangItemObj::get()->where(Langitem::$tbitem_id, '==', $id);
        $Lang_item = array_values($Lang_item->all());
        foreach ($secRequest as $index => $elem){
            $Lang_item_obj = (new helper())->getlangitemobj();
            $Lang_item_obj = $Lang_item[$index];
            $Lang_item_obj->setallAttribute($elem);
            $Lang_item_obj->save();
        }

        $Item=new item;
        $Item=item::find($id);
        $Item->setallAttribute($request);
        $Item->save();

        $EditedData = (new langcatcustom())->AnalyseData($request);
        $DynamicObj = (new langcatcustom())->getDynamicObjByItemId($id);

        //dd($EditedData);
        foreach ($DynamicObj as $elem){
            $obj = (new langcatcustom())->getNewEditedObject($elem, $EditedData);
            //dd($obj);

            $Langcatcustom = new langcatcustom();
            $Langcatcustom = langcatcustom::find($elem->id);
            $Langcatcustom->setallAttribute($obj, $obj['itemCatValueId']);
            $Langcatcustom->save();
        }

        $AllLanguage = (new Language())->getAllLanguage();
        $AllItemData = (new item)->getAllData();
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

//        $AllData = (new item)->getAllData();
//        $AllLanguage = (new Language())->getAllLanguage();
//        $AllData2 = (new category)->getAllData();
//        $Data = ['globalVariable' => $this->globalVariable, 'items' => $AllData,'category' => $AllData2, 'Languages' => $AllLanguage];
//        return view('Admin.item.item', compact('Data'));
    }

    public function destroy($id)
    {

        $this->action = 'delete';
        (new User())->CheckUserPermissions($this, $this->action, self::$controller);

        $Item=item::find($id) ;

//        $Lang_item = (new helper())->getlangitemobj();
//        $Lang_item = Langitem::all()->where(Langitem::$tbitem_id, '==', $id);
//        foreach ($Lang_item as $elem){
//            $elem->delete();
//        }

        $Itemcatvalues = itemcatvalues::all()->where(itemcatvalues::$tbitem_Id, '=', $id);

        foreach ($Itemcatvalues as $elem){
            $Langcatcustom = langcatcustom::all()->where(langcatcustom::$tbcatvalcustom_id, '=', $elem->id);
            foreach ($Langcatcustom as $obj){
                $obj->delete();
            }
            //$Langcatcustom->delete();
        }

        foreach($Itemcatvalues as $obj){
            $obj->delete();
        }
        //$Itemcatvalues->delete();


        $Item->delete();

        $AllData = (new item)->getAllData();
        $AllLanguage = (new Language())->getAllLanguage();
        $AllData2 = (new category())->getAllData();

        $this->role = (new User())->getAllUser_Roles(Auth::user()->id);
        $Data = ['globalVariable' => $this->globalVariable
            , 'items' => $AllData
            ,'category'=>$AllData2
            , 'Languages' => $AllLanguage
            , 'role' => $this->role
        ];
        return view('Admin.item.item', compact('Data'));
    }

    public function storeItemCustomAttribute($id, Request $request){

        $this->action = 'store';
        (new User())->CheckUserPermissions($this, $this->action, self::$controller);

        $AllData = (new item)->getAllData();
        $AllLanguage = (new Language())->getAllLanguage();
        $AllData2 = (new category())->getAllData();
        $this->role = (new User())->getAllUser_Roles(Auth::user()->id);
        $Data = ['globalVariable' => $this->globalVariable
            , 'items' => $AllData
            ,'category'=>$AllData2
            , 'Languages' => $AllLanguage
            , 'role' => $this->role
        ];
        //return view('Admin.item.item', compact('Data'));
        return redirect('/admin/home/item');
    }


}
