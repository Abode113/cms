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

class UserController extends Controller
{
    public $globalVariable;
    public $role;
    public $action;
    public static $controller = 'user';
    public function __construct(){
        $this->role = 'Role';
        (new User())->CheckUserauthorization($this, $this->role);//Data //Role
        //(new User())->CheckUserPermissions($this, $this->action, self::$controller);
        $this->globalVariable = (new globalcontroller())->getGlobalVariable();
    }

    public function homepage(){

        $this->action = 'browse';
        (new User())->CheckUserPermissions($this, $this->action, self::$controller);

        $AllRoleData = (new Role())->getAllData();
        $AllUsersData = (new User())->getAllUsers_Roles();

        $this->role = (new User())->getAllUser_Roles(Auth::user()->id);
        $Data = ['globalVariable' => $this->globalVariable
            , 'Users' => $AllUsersData
            , 'RoleData' => $AllRoleData
            , 'role' => $this->role
        ];
        return view('Admin.User.User', compact('Data'));
    }

    public function destroy($id){

        $this->action = 'delete';
        (new User())->CheckUserPermissions($this, $this->action, self::$controller);

        $user = User::find($id);
        $user->delete();

        $AllRoleData = (new Role())->getAllData();
        $AllUsersData = (new User())->getAllUsers_Roles();
        $this->role = (new User())->getAllUser_Roles(Auth::user()->id);
        $Data = ['globalVariable' => $this->globalVariable
                , 'Users' => $AllUsersData
                , 'RoleData' => $AllRoleData
                , 'role' => $this->role
        ];
        return view('Admin.User.User', compact('Data'));
    }

    public function AddRole($UserID, Request $request){

        $this->action = 'edit';
        (new User())->CheckUserPermissions($this, $this->action, self::$controller);

        $userObj = new User();

        $Roles = (new Role())->getRolesIDOfUser($UserID);
        if($request['roles'] == null){
            $request['roles'] = [];
        }

        $unNeededRole = array();
        foreach ($Roles as $elem){
            if(!in_array($elem, $request['roles'])){
//                var_dump($elem);
                array_push($unNeededRole, $elem);
            }
        }

        $NewRole = array();
        foreach ($request['roles'] as $elem){
            if(!in_array($elem, $Roles)){
                array_push($NewRole, $elem);
            }
        }

        foreach ($unNeededRole as $elem){
            $userObj->removeRole($UserID, $elem);
        }


        foreach ($NewRole as $Role_id){
            //var_dump($Role_id);
            $userObj->AddRole($UserID, $Role_id);
        }

        $AllRoleData = (new Role())->getAllData();
        $AllUsersData = (new User())->getAllUsers_Roles();
        $this->role = (new User())->getAllUser_Roles(Auth::user()->id);
        $Data = ['globalVariable' => $this->globalVariable
                , 'Users' => $AllUsersData
                , 'RoleData' => $AllRoleData
                , 'role' => $this->role
        ];
        return view('Admin.User.User', compact('Data'));
    }
}


?>
