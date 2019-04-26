<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Language;
use Session;
use App\User;
use Illuminate\Support\Facades\Auth;

class globalcontroller extends Controller
{
    public function getGlobalVariable (){ // {{$Data['globalVariable']['']}}

        (new User())->CheckUserauthorization($this, 'Front');//Front //Data //Role

        if(Session::get('defaultLanguage') == null){
            Session::put('defaultLanguage', 1);
        }

        $Languages = (new Language())->getAllLanguage();//$Data['globalVariable']['Url']

        $GlobalVariable = array();
        $GlobalVariable = [ 'Url' => 'http://localhost:8012/cms-2/public',
                            'adminUrl' => 'http://localhost:8012/cms-2/public/admin',
                            'imagesUrl' => 'http://localhost:8012/cms-2/resources/views/images',
                            'shortUrl' => '/cms-2/public',
                            'Languages' => $Languages
                            ];
        return $GlobalVariable;
    }
}

