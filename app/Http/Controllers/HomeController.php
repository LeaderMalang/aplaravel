<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Validator;
use Spatie\Permission\Models\Role;
use Illuminate\Validation\Rule;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }
    /*it loads Add new User view*/
    public function newUser()
    {
        $data=[];
        $roles=Role::all();
        $data['roles']=$roles;
        return view('acl.user.create',$data);

    }
    /* It deletes the user */
    public  function destory($id){

        $user=User::find($id);
        $user->delete();
        return redirect('user/list');
    }
    /* It stores new user and assign role to user*/
    public function store(Request $request){
        $validator=Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6',
            'role'=>'required'
        ]);
        if($request->isMethod('post')){
            if($validator->fails()){
                return redirect('/user/new')->withErrors($validator)->withInput();
            }else{
                $user=User::create([
                    'name' => $request->name,
                    'username' => $request->username,
                    'email' => $request->email,
                    'password' => Hash::make($request->password),
                ]);
                $user->assignRole($request->role);

                $user->save();
                return redirect('/user/list');
            }

        }else{
            abort(403, 'Unauthorized action.');
        }

    }
    /*it loads Update view of User with its role */
    public function editUser($id){
        $data=[];
        $user=User::find($id);
        $user->getRoleNames();
        $roles=Role::all();
        $data['user']=$user;
        $data['roles']=$roles;


        //return $data;
        return view('acl.user.update',$data);

    }

    /*Updating user role and details*/

    public function updateUser(Request $request){
        $validator=Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255',
            'email' => ['required','email',Rule::unique('users')->ignore($request->userid,'id')],
            'role'=>'required'
        ]);
        $obj_user = User::find($request->userid);
        //$data['user']=$obj_user;
        //return $obj_user;
        if($request->isMethod('post')){
            if($validator->fails()){
                return redirect('/user/update/'.$request->userid)->withErrors($validator)->withInput();

            }else{
                $obj_user->name=$request->name;
                $obj_user->username=$request->username;
                $obj_user->email=$request->email;
                if(!empty($request->password)) $obj_user->password = Hash::make($request->password);
                $obj_user->syncRoles($request->role);
                $obj_user->save();
                return redirect('/user/list');

            }
        }else{
            abort(403, 'Unauthorized action.');
        }

    }
    /* It loads user list and their role*/
    public function listUser(){

        $data=[];
        $users = User::all();
        foreach ($users as $user){
            $userrole =[$user->name,$user->id,$user->email,$user->getRoleNames(),$user->username];
            array_push($data,$userrole);
        }

        //return $data;
        return view('acl.user.list')->with('userroles',$data);

    }
    /*
    Showing Profile Page
    */
    public function profile(){
        $data=[];
        $id=Auth::user()->id;
        $data['user']=User::find($id);
        return view('profile',$data);

    }
    /*
    Updating Profile
    */
    public function update(Request $request){

        $data=[];
        $user = Auth::user();
        $user_id = $user->id;
        $obj_user = User::find($user_id)->first();
        $data['user']=$obj_user;


        $curPassword = $request->oldpassword;
        $newPassword = $request->newpassword;

        $validator = Validator::make($request->all(), [
            'name'=>'required',
            'email'=>'required',
            'oldpassword'=>'required|min:6',
            'newpassword'=>'required|min:6'
        ]);
        if($request->isMethod('post')){
            if($validator->fails()){
                //$data['errors']=$validator->errors();

                return redirect('profile')
                    ->withErrors($validator)
                    ->withInput();

            }
            else {
                if (Hash::check($curPassword, $user->password)) {

                    $obj_user->name=$request->name;
                    $obj_user->email=$request->email;
                    $obj_user->password = Hash::make($newPassword);
                    $obj_user->save();
                    // $data['user']=$obj_user;
                    //$data['result']=true;
                    $request->session()->flash('success', 'Profile is updated !');
                    return redirect('profile')
                        ->withInput();

                }
                else
                {
                    //$data['result']=false;
                    $request->session()->flash('error', 'Profile is not updated Wrong Old Password!');
                    return redirect('profile')
                        ->withInput();

                }
            }
        }else {
            $request->session()->flash('error', 'Request Method is not Post !');
            return redirect('profile')
                ->withInput();
        }


    }
}
