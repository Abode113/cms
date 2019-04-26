<?php

namespace App\Http\Controllers;

use App\dictionary;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Language;
use App\diclang;

class DictionaryController extends Controller
{
    public $globalVariable;
    public $role;
    public static $controller = 'Dictionary';
    public $action;
    public function __construct(){

        $this->role = 'Data';
        (new User())->CheckUserauthorization($this, $this->role);//Front //Data //Role

        $this->globalVariable = (new globalcontroller())->getGlobalVariable();
    }

    public function homepage(){

        $this->action = 'browse';
        (new User())->CheckUserPermissions($this, $this->action, self::$controller);

        $Allobj = (new dictionary())->getAllWordsData();

        $AllLanguage = (new Language())->getAllLanguage();
        $AllData = (new dictionary())->getAllWordsByLang(1);// english = 1
        $this->role = (new User())->getAllUser_Roles(Auth::user()->id);
        $Data = ['globalVariable' => $this->globalVariable
                , 'dictionary' => $AllData
                , 'AllData' => $Allobj
                , 'Languages' => $AllLanguage
                , 'role' => $this->role
        ];
        return view('Admin.dictionary.dictionary', compact('Data'));
    }

    public function store(Request $request){

        $this->action = 'store';
        (new User())->CheckUserPermissions($this, $this->action, self::$controller);

        $Dictionary = new dictionary;
        $Dictionary->setallAttribute();
        $Dictionary->save();

        $secRequest = (new dictionary())->makeRequest((new dictionary())->arrayOfReqest($request), $Dictionary['id']);

        foreach ($secRequest as $elem){
            $Diclang = new diclang();
            $Diclang->setallAttribute($elem);
            $Diclang->save();
        }

        $Allobj = (new dictionary())->getAllWordsData();
        $AllLanguage = (new Language())->getAllLanguage();
        $AllData = (new dictionary())->getAllWordsByLang(1);// english = 1
        $this->role = (new User())->getAllUser_Roles(Auth::user()->id);
        $Data = ['globalVariable' => $this->globalVariable
                , 'dictionary' => $AllData
                , 'AllData' => $Allobj
                , 'Languages' => $AllLanguage
                , 'role' => $this->role
        ];
        return view('Admin.dictionary.dictionary', compact('Data'));
    }

    public function destroy($id){

        $this->action = 'delete';
        (new User())->CheckUserPermissions($this, $this->action, self::$controller);

        $Dictionary = dictionary::find($id);

        $dicLang = (new dictionary())->getAllLangsOfSpecificWords($Dictionary->id);

        foreach ($dicLang as $elem){
            $obj = diclang::find($elem->id);
            $obj->delete();
        }

        $Dictionary->delete();

        $Allobj = (new dictionary())->getAllWordsData();
        $AllLanguage = (new Language())->getAllLanguage();
        $AllData = (new dictionary())->getAllWordsByLang(1);// english = 1
        $this->role = (new User())->getAllUser_Roles(Auth::user()->id);
        $Data = ['globalVariable' => $this->globalVariable
            , 'dictionary' => $AllData
            , 'AllData' => $Allobj
            , 'Languages' => $AllLanguage
            , 'role' => $this->role
        ];
        return view('Admin.dictionary.dictionary', compact('Data'));
    }

    public function update($id, Request $request){

        $this->action = 'edit';
        (new User())->CheckUserPermissions($this, $this->action, self::$controller);

        $secRequest = (new dictionary())->makeRequest((new dictionary())->arrayOfReqest($request), $id);
        //dd($secRequest);
        foreach($secRequest as $elem){
            $id = (new dictionary())->getWordID($elem['dictionary_id'], $elem['language_id']);
            $obj = diclang::find($id);
            $obj['word'] = $elem['word'];
            $obj->save();
        }

        $Allobj = (new dictionary())->getAllWordsData();
        $AllLanguage = (new Language())->getAllLanguage();
        $AllData = (new dictionary())->getAllWordsByLang(1);// english = 1
        $this->role = (new User())->getAllUser_Roles(Auth::user()->id);
        $Data = ['globalVariable' => $this->globalVariable
            , 'dictionary' => $AllData
            , 'AllData' => $Allobj
            , 'Languages' => $AllLanguage
            , 'role' => $this->role
        ];
        return view('Admin.dictionary.dictionary', compact('Data'));
    }

}
