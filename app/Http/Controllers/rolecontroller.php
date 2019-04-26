<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use App\Role;
use App\User;
use Illuminate\Support\Facades\Auth;
use App\Permission;
use App\permission_role;

class rolecontroller extends Controller
{

    public $globalVariable;
    public $role;
    public static $controller = 'role';
    public $action;
    public function __construct()
    {
        $this->role = 'Role';
        (new User())->CheckUserauthorization($this, $this->role);//Data //Role

        $this->globalVariable = (new globalcontroller())->getGlobalVariable();
    }

    public function homepage(){

        $this->action = 'browse';
        (new User())->CheckUserPermissions($this, $this->action, self::$controller);

        $AllRoleData = (new Role())->getAllData();

        $permission = (new Permission())->getAllData();
        $this->role = (new User())->getAllUser_Roles(Auth::user()->id);
        $Data = ['globalVariable' => $this->globalVariable
                , 'RoleData' => $AllRoleData
                , 'Permissions' => $permission
                , 'role' => $this->role
        ];
        return view('Admin.role.role', compact('Data'));
    }

    public function storeview(){

        $AllRoleData = (new Role())->getAllData();

        $permission = (new Permission())->getAllData();
        $this->role = (new User())->getAllUser_Roles(Auth::user()->id);
        $Data = ['globalVariable' => $this->globalVariable
                , 'RoleData'=> $AllRoleData
                , 'Permissions' => $permission
                , 'role' => $this->role
        ];
        return view('Admin.role.role', compact('Data'));
    }


    public function store(Request $request){

        $this->action = 'store';
        (new User())->CheckUserPermissions($this, $this->action, self::$controller);

        $role = new Role();
        $role->setallAttribute($request);
        $role->save();

        foreach ($request['Permissions'] as $elem){
            $permission = Permission::find($elem);
            $role->attachPermission($permission);
        }

        $permission = (new Permission())->getAllData();
        $AllRoleData = (new Role())->getAllData();
        $this->role = (new User())->getAllUser_Roles(Auth::user()->id);
        $Data = ['globalVariable' => $this->globalVariable
                , 'RoleData' => $AllRoleData
                , 'Permissions' => $permission
                , 'role' => $this->role
        ];
        return view('Admin.role.role', compact('Data'));
    }

    public function destroy($id){

        $this->action = 'delete';
        (new User())->CheckUserPermissions($this, $this->action, self::$controller);

        $role = Role::find($id);
        $role->delete();

        $permission = (new Permission())->getAllData();
        $AllRoleData = (new Role())->getAllData();
        $this->role = (new User())->getAllUser_Roles(Auth::user()->id);
        $Data = ['globalVariable' => $this->globalVariable
                , 'RoleData' => $AllRoleData
                , 'Permissions' => $permission
                , 'role' => $this->role
        ];
        return view('Admin.role.role', compact('Data'));
    }

    public function update($id, Request  $request){

        $this->action = 'edit';
        (new User())->CheckUserPermissions($this, $this->action, self::$controller);

        $role = new Role();
        $role = Role::find($id);
        $role->setallAttribute($request);
        $role->save();

        $Permission = (new Role())->NewPermission($id, $request);

        foreach ($Permission['permission_toremove'] as $elem){
            $role->detachPermission($elem);
        }

        foreach ($Permission['permission_toAdd'] as $elem){
            $role->attachPermission($elem);
        }

        $permission = (new Permission())->getAllData();
        $AllRoleData = (new Role())->getAllData();
        $this->role = (new User())->getAllUser_Roles(Auth::user()->id);
        $Data = ['globalVariable' => $this->globalVariable
                , 'RoleData' => $AllRoleData
                , 'Permissions' => $permission
                , 'role' => $this->role
        ];
        return view('Admin.role.role', compact('Data'));
    }

}

?>
