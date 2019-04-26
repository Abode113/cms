<?php

namespace App\Http\Controllers;

use App\category;
use App\Langcategory;
use App\Language;
use Illuminate\Http\Request;
use DB;
use \App\MenuItem;
use App\helper;
use Carbon\Carbon;
use App\item;
use Session;
use App\User;
use Illuminate\Support\Facades\Auth;
use App\dictionary;

class categorycontroller extends Controller
{

    public $globalVariable;
    public $role;
    public static $controller = 'category';
    public $action;
    public function __construct(){

        $this->role = 'Front';
        (new User())->CheckUserauthorization($this, $this->role);//Front //Data //Role

        $this->globalVariable = (new globalcontroller())->getGlobalVariable();
    }

    public function getallcategories(){

        $this->action = 'browse';
        (new User())->CheckUserPermissions($this, $this->action, self::$controller);

        $result = (new MenuItem())->MakeNavBarTree();

        $categories = category::all();
        $categories = (new helper())->getObjectsArray($categories);

        $this->role = (new User())->getAllUser_Roles(Auth::user()->id);
        $Data = ['globalVariable' => $this->globalVariable
                , 'MenuItem' => $result
                , 'allcategory' => $categories
                , 'role' => $this->role
        ];
        return view('category.category', compact('Data'));
    }

    public function getallcategoriesByParentId($id, $LangId){

        $this->action = 'browse';
        (new User())->CheckUserPermissions($this, $this->action, self::$controller);

        $result = (new MenuItem())->MakeNavBarTree();
        $categoryObect = new category();


        $DictionaryWord = array();
        array_push($DictionaryWord, 'Detail_en');
        $DictionaryData = (new dictionary())->getDictionaryData($DictionaryWord, $LangId);

        if($id == -1){
            $this->role = (new User())->getAllUser_Roles(Auth::user()->id);
            $Data = ['globalVariable' => $this->globalVariable
                    , 'MenuItem' => $result
                , 'Words' => $DictionaryData
                    , 'role' => $this->role
            ];
            return view('view.HomePage.home', compact('Data'));
        }

        $categoriesCount = (new category())->getCountOfParentCategoies($id, $LangId);

        if($categoriesCount > 0){
            $categoryFatherObj = (new category())->GetCategoryById($id, $LangId);
            $categories = (new category())->getDataByParentId($id, $LangId);
            $sonsArray = $categoryObect->getSonsArray($categories);
            $this->role = (new User())->getAllUser_Roles(Auth::user()->id);
            $Data = [   'globalVariable' => $this->globalVariable,
                        'MenuItem' => $result,
                        'allcategory' => $categories,
                        'sonsExsit' => $sonsArray
                        , 'fatherObj' => $categoryFatherObj
                        , 'role' => $this->role
                , 'Words' => $DictionaryData
            ];
            Session::put('defaultLanguage', $LangId);
            return view('category.category', compact('Data'));
        }else{
            $itemObj = new item();
            $ItemsCat = $itemObj->getitembycategoy($id, $LangId);
            $count = sizeof($ItemsCat);

            if($count > 0){
                if($count == 1){
                    $itemObj = new item();

                    $item = $itemObj->getitembycategoy($id, $LangId);
                    $this->role = (new User())->getAllUser_Roles(Auth::user()->id);
                    $Data = ['globalVariable' => $this->globalVariable
                            , 'MenuItem' => $result
                            , 'allItems' => $item[0]
                            , 'role' => $this->role
                        , 'Words' => $DictionaryData
                    ];
                    return view('item.itemDetail.itemDetail', compact('Data'));
                }
                $this->role = (new User())->getAllUser_Roles(Auth::user()->id);
                $Data = ['globalVariable' => $this->globalVariable
                        , 'MenuItem' => $result
                        , 'allItems' => $ItemsCat
                        , 'role' => $this->role
                    , 'Words' => $DictionaryData
                ];
                Session::put('defaultLanguage', $LangId);
                return view('item.item', compact('Data'));
            }else{
                $this->role = (new User())->getAllUser_Roles(Auth::user()->id);
                $Data = ['globalVariable' => $this->globalVariable
                        , 'MenuItem' => $result
                        , 'role' => $this->role
                    , 'Words' => $DictionaryData
                ];

                Session::put('defaultLanguage', $LangId);
                return view('view.HomePage.home', compact('Data'));
                //var_dump('no item exist');
            }


        }
    }

    public function storeview(){

        $this->action = 'store';
        (new User())->CheckUserPermissions($this, $this->action, self::$controller);

        $AllLanguage = (new Language())->getAllLanguage();
        $AllData=(new category())->getAllData();

        $this->role = (new User())->getAllUser_Roles(Auth::user()->id);
        $Data = ['globalVariable' => $this->globalVariable
                ,'category'=>$AllData
                , 'allLang' => $AllLanguage
                , 'role' => $this->role
        ];
        return view('Admin.category.storecategory', compact('Data'));
    }

    public function store(Request $request){

        $this->action = 'store';
        (new User())->CheckUserPermissions($this, $this->action, self::$controller);

        $Category=new category;
        $Category->setallAttribute($request);
        $Category->save();

        $secRequest = (new category())->makeRequest((new category())->arrayOfReqest($request), $Category['id']);

        foreach ($secRequest as $elem){
            $Lang_category = new Langcategory();
            $Lang_category->setallAttribute($elem);
            $Lang_category->save();
        }

        
        $AllData = (new category)->getAllData();
        $AllLanguage = (new Language())->getAllLanguage();

        $this->role = (new User())->getAllUser_Roles(Auth::user()->id);
        $Data = ['globalVariable' => $this->globalVariable
                , 'category' => $AllData
                , 'Languages' => $AllLanguage
                , 'role' => $this->role
        ];

        return view('Admin.category.category', compact('Data'));
    }

    public function edit($id){

        $this->action = 'edit';
        (new User())->CheckUserPermissions($this, $this->action, self::$controller);

        $helper = new helper();

        $AllData = (new category)->getDataById($id);

        $this->role = (new User())->getAllUser_Roles(Auth::user()->id);
        $Data = ['globalVariable' => $this->globalVariable
                , 'Obj' => $AllData
                , 'role' => $this->role
        ];
        //dd($Data);
        return view('Admin.category.updatecategory',compact('Data'));
    }

    public function update($id,Request  $request ){

        $this->action = 'edit';
        (new User())->CheckUserPermissions($this, $this->action, self::$controller);

        $Category = new category();
        $Category = category::find($id);
        $Category->setallAttribute($request);
        $Category->save();

        $secRequest = (new category())->makeRequest((new category())->arrayOfReqest($request), $id);

        $Lang_category = Langcategory::get()->where(Langcategory::$tbcategory_id, '==', $id);

        $Lang_category = array_values($Lang_category->all());

        foreach ($secRequest as $index => $elem){
            $Lang_category_obj = new Langcategory();
            $Lang_category_obj = $Lang_category[$index];
            $Lang_category_obj->setallAttribute($elem);
            $Lang_category_obj->save();
        }

        $AllData = (new category)->getAllData();
        $AllLanguage = (new Language())->getAllLanguage();

        $this->role = (new User())->getAllUser_Roles(Auth::user()->id);
        $Data = ['globalVariable' => $this->globalVariable
                , 'category' => $AllData
                , 'Languages' => $AllLanguage
                , 'role' => $this->role
        ];
        return view('Admin.category.category', compact('Data'));
    }

    public function destroy($id){

        $this->action = 'delete';
        (new User())->CheckUserPermissions($this, $this->action, self::$controller);

        $Category=category::find($id) ;
        
        $Lang_category= new Langcategory();

        $Lang_category = Langcategory::all()->where(Langcategory::$tbcategory_id, '==', $id);
        foreach ($Lang_category as $elem){
                        $elem->delete();
                    }
        $Category->delete();
    
        $AllData = (new category)->getAllData();
        $AllLanguage = (new Language())->getAllLanguage();

        $this->role = (new User())->getAllUser_Roles(Auth::user()->id);
        $Data = ['globalVariable' => $this->globalVariable
                , 'category' => $AllData
                , 'Languages' => $AllLanguage
                , 'role' => $this->role
        ];
        return view('Admin.category.category', compact('Data'));
    }

}
