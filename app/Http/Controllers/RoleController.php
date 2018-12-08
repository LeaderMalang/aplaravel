<?php

namespace App\Http\Controllers;
use Spatie\Permission\Models\Role;

use Illuminate\Http\Request;
use Validator;
use App\User;

class RoleController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /*
    It loads the list of view Role
    */
    public function index(){
        $data=[];
        $data['roles']=Role::all();
        return view('acl.role.index',$data);


    }
    /*
    it loads the create form of role
    */
    public function create(){
        return view('acl.role.create');
     }
     /*
     It store new role
     */
     public function store(Request $request){
         $validator=Validator::make($request->all(),[
             'name'=>'required|min:3'
         ]);

         if($request->isMethod('post')){
             if($validator->fails()){
                 return redirect('role/create')
                     ->withErrors($validator)
                     ->withInput();
             }
             else{
                 $role = Role::create($request->all());
                 return redirect('role/list');

             }


         }


     }
     /*
     load Edit Form
     Argument: Receives the ID of Role
     */
     public function edit($id){
         $data=[];

         $role = Role::find($id);
         $data['role']=$role;
         return view('acl.role.update',$data);
     }
     /*
     It receives Post request and Update the Role Record
     */
     public  function update(Request $request){
         $validator=Validator::make($request->all(),[
             'name'=>'required|min:3'
         ]);
         if($request->isMethod('post')){
             if($validator->fails()){
                 return redirect('role/edit/'.$request->id)
                     ->withErrors($validator)
                     ->withInput();

             }else{
                 $id=$request->id;
                 $role = Role::find($id);
                 $role->name=$request->name;
                 $role->save();
                 return redirect('role/list');

             }


         }else {
             die('Method is not Post');

         }
     }
     /* Deletes the Role
     Argument : It receives the Role ID
     */
     public function destory($id){
         $role = Role::find($id);
         $role->delete();
         return redirect('role/list');

     }
     /*It load users and roles
      *
      *  */
     public function roleforuser(){
         $data=[];
         $users=User::all();
         $data['users']=$users;
         $roles=Role::all();
         $data['roles']=$roles;
         //return $data;
         return view('acl.role.assigntouser',$data);
     }
     /*
     It assign roles to User
     */
     public function assignrole(Request $request){
         $validator=Validator::make($request->all(),[
             'user'=>'required',
             'role'=>'required'
         ]);
         if($request->isMethod('post')){
             if($validator->fails()){
                 return redirect('role/assign/user')
                     ->withErrors($validator)
                     ->withInput();
             }else {
                 $user=User::find($request->user);
                 $user->assignRole($request->role);
                 $user->save();
                 return redirect('role/roleuser/list');

             }

         }else {
             die('post nhi hy');
         }

     }
     /*
     It loads roles list against user
     */
     public  function roleuserlist(){
         $data=[];
         //$users=User::all();
         $roles=Role::all();
         $users = User::role($roles)->get();

         foreach ($users as $user){
             $userrole =[$user->name,$user->id,$user->getRoleNames()];
             array_push($data,$userrole);
         }

         return view('acl.role.roleuserlist')->with('userroles',$data);
     }
     /*
     It delete the Roles against user
     Argument: ID (It receive User ID and find roles against it and delete them)
     */
     public function deleteroles($id){
         $user=User::find($id);
         $roles=$user->getRoleNames();
         foreach ($roles as $role){
             $user->removeRole($role);
         }
         return redirect('role/roleuser/list');
         //$user->syncRoles(['writer', 'admin']);
     }
     /*
     It Load Edit View for Updation of User roles
     Argument:ID (It receive User ID and Find Roles Against it)
     */
     public function editUserRole($id){
         $data=[];
         //All users
         $users=User::all();
         $data['users']=$users;
         //Specific User and its roles
         $user=User::find($id);
         $data['user']=$user;
         $userRoles=$user->getRoleNames();
         $data['userRoles']=$userRoles;

         //All roles
         $roles=Role::all();

         foreach ($roles as $myroles){
             $data['roles'][]=$myroles->name;
         }

       // $no= array_diff($data['userRoles'],$data['roles']);

         // return $data;
         return view('acl.role.updateassignrole',$data);


     }
     /*
     It Update the User Roles
     Request Method:Post

     */
     public function updateUserRole(Request $request){
         $validator=Validator::make($request->all(),[
             'user'=>'required',
             'role'=>'required'
         ]);
         if($request->isMethod('post')){
             if($validator->fails()){
                 $url='role/roleuser/edit/'.$request->id;

                 return redirect($url)->withErrors($validator)->withInput();

             }else{
                 $user=User::find($request->user);
                 $user->syncRoles($request->role);
                 $user->save();
                 return redirect('role/roleuser/list');
             }


         }else{
             die('post ni hy');
         }



     }

}
