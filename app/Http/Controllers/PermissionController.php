<?php

namespace App\Http\Controllers;

use Spatie\Permission\Models\Role;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Validator;

class PermissionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(){
        $data=[];
        $permissions=Permission::all();
        $data['permissions']=$permissions;
        return view('acl.permission.index',$data);


    }
    /*
      Its loads create view of Permissions
     */
    public function create(){
        return view('acl.permission.create');
    }
    /*
     It validate and store new Permission
     */
    public function store(Request $request){

        $validator=Validator::make($request->all(),[
            'name'=>'required|min:3',
            'slug'=>'required|min:3'
        ]);


        if($request->isMethod('post')){

            if($validator->fails()){
                return redirect('/permission/create')
                    ->withErrors($validator)
                    ->withInput();
            }
            else{


                Permission::create(['name' => $request->name,'slug'=>$request->slug]);
                return redirect('/permission/list');

            }


        }else {
            die('post nhi hy');
        }


    }
    /*
    load Edit Form
    Argument: Receives the ID of Permission
    */
    public function edit($id){
        $data=[];

        $permission = Permission::find($id);
        $data['permission']=$permission;
        return view('acl.permission.update',$data);
    }
    /*
     It receives Post request validate and Update the Permission Record
     */
    public  function update(Request $request){
        $validator=Validator::make($request->all(),[
            'name'=>'required|min:3'
        ]);
        if($request->isMethod('post')){
            if($validator->fails()){
                return redirect('/permission/edit/'.$request->id)
                    ->withErrors($validator)
                    ->withInput();

            }else{
                $id=$request->id;
                $permission= Permission::find($id);
                $permission->name=$request->name;
                $permission->save();
                return redirect('/permission/list');

            }


        }else {
            die('Method is not Post');

        }
    }
    /* Deletes the Role
     Argument : It receives the Permission ID
     */
    public function destory($id){
        $role = Permission::find($id);
        $role->delete();
        return redirect('/permission/list');

    }
    /*
    It loads the permission and roles return all data
    to assign permission page
    */
    public function assignpermission(){
        $data=[];
        //All Permissions
        $permissions=Permission::all();
        $data['permissions']=$permissions;
        //All Roles
        $roles=Role::all();
        $data['roles']=$roles;

        return view('acl.permission.permissionassign',$data);
    }
    /*
    it store permissions against Role
    */
    public function storeassignpermission(Request $request){
        $validator=Validator::make($request->all(),[
            'role'=>'required',
            'permission'=>'required'
        ]);
        if($request->isMethod('post')){
            if($validator->fails()){
                return redirect('permission/assign/torole')->withErrors($validator)->withInput();

            }else {
                $role = Role::findByName($request->role);
                $role->givePermissionTo($request->permission);
                return $this->listpermissions();

            }
        }else{
            die('post ni hy');
        }


    }
    /*
    It loads the list of permissions against roles

    */
    public function listpermissions(){
        $data=[];
        $roles=Role::all();

        foreach ($roles as $role){
            $permisson=$role->getAllPermissions();
            $data[$role->name]=$permisson;

        }



        return view('acl.permission.assignpermissionlist')->with('roleslist',$data);
    }
    /*
    Argument : Name of Permission
    It loads Edit view with all permissions and specfic permissions against role

    */
    public function editAssignPermission($name){
        $data=[];
        $roles=Role::all();
        $permissons=Permission::all();
        $role=Role::findByName($name);
        $permisson=$role->getAllPermissions();

        $data['roleName']=$name;
        //$data['permissionOfRole']=$permisson;
        $data['roles']=$roles;
        //$data['permissions']=$permissons;
        foreach ($permisson as $per){
            $data['permissionOfRole'][]=$per->name;
        }
        foreach ($permissons as $tper){
            $data['permissions'][]=$tper->name;
        }
        //return $data;
        return view('acl.permission.updateassignpermission',$data);


    }
    /*
    It receives post request and  updates the permissions against role

    */
    public function updateAssignPermission(Request $request){
        $validator=Validator::make($request->all(),[
           'roleSelect'=>'required|min:2',
           'permission'=>'required'
        ]);
        if($request->isMethod('post')){
            if($validator->fails()){
                return redirect('permission/assigntorole/edit/'.$request->roleName)->withErrors($validator)->withInput();

            }else {
                $role=Role::findByName($request->roleSelect);
                $permissons=$role->getAllPermissions();
                $role->revokePermissionTo($permissons);
                $role->givePermissionTo($request->permission);
                return redirect('permission/assigntorole/list');



            }

        }else {
            die('post ni hy');
        }


    }
    /*
    Argument:Name of Role
    It deletes the permissions against role then redirect to list view

    */
    public function deleteAssignPermission($name){
        $role=Role::findByName($name);
        $permissons=$role->getAllPermissions();
        $role->revokePermissionTo($permissons);
        return redirect('permission/assigntorole/list');


    }

}
