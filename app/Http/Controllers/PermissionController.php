<?php

namespace App\Http\Controllers;

use App\helper;
use App\User;
use Illuminate\Http\Request;
use Session;
use Carbon\Carbon;
use DB;
use App\Role;
use Illuminate\Support\Facades\Auth;
use App\Permission;

class PermissionController extends Controller
{
    public $globalVariable;
    public $role;
    public static $controller = 'permission';
    public $action;
    public function __construct(){
        $this->role = 'Role';
        (new User())->CheckUserauthorization($this, $this->role);//Data //Role
        $this->globalVariable = (new globalcontroller())->getGlobalVariable();
    }

    public function homepage(){

        $this->action = 'browse';
        (new User())->CheckUserPermissions($this, $this->action, self::$controller);

        $AllData = (new Permission())->getAllData();
        $this->role = (new User())->getAllUser_Roles(Auth::user()->id);
        $Data = ['globalVariable' => $this->globalVariable
            , 'Permissions' => $AllData
            , 'role' => $this->role
        ];
        return view('Admin.Permission.Permission', compact('Data'));
    }

    public function store(Request $request){

        $this->action = 'store';
        (new User())->CheckUserPermissions($this, $this->action, self::$controller);

        $permission = new Permission();
        $permission->setallAttribute($request);
        $permission->save();
//
        $AllData = (new Permission())->getAllData();
        $this->role = (new User())->getAllUser_Roles(Auth::user()->id);
        $Data = ['globalVariable' => $this->globalVariable
            , 'Permissions' => $AllData
            , 'role' => $this->role
        ];
        return view('Admin.Permission.Permission', compact('Data'));
    }

    public function destroy($id){

        $this->action = 'delete';
        (new User())->CheckUserPermissions($this, $this->action, self::$controller);

        $safeToremove = (new Permission())->isSafe($id);
        if($safeToremove){
            $permission = Permission::find($id);
            $permission->delete();
        }

        $AllData = (new Permission())->getAllData();
        $this->role = (new User())->getAllUser_Roles(Auth::user()->id);
        $Data = ['globalVariable' => $this->globalVariable
            , 'Permissions' => $AllData
            , 'role' => $this->role
        ];
        return view('Admin.Permission.Permission', compact('Data'));
    }

    public function update($id, Request  $request){
//dd($request);
        $this->action = 'edit';
        (new User())->CheckUserPermissions($this, $this->action, self::$controller);

        $permission = new Permission();
        $permission = Permission::find($id);
        $permission->setallAttribute($request);
        $permission->save();

        $AllData = (new Permission())->getAllData();
        $this->role = (new User())->getAllUser_Roles(Auth::user()->id);
        $Data = ['globalVariable' => $this->globalVariable
            , 'Permissions' => $AllData
            , 'role' => $this->role
        ];
        return view('Admin.Permission.Permission', compact('Data'));
    }
}


?>
