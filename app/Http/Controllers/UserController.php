<?php

namespace App\Http\Controllers;

use App\Models\bankList;
use App\Models\User;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function profile($id){

     $user = DB::table('users')->where('id',$id)->first();
        return view('Admin.User.profile',['user'=>$user]);
    }


    public function user_list(){

        $user_list = User::get();

        return view('Admin.User.user_list',['user_list'=>$user_list]);
    }


    public function role_edit($id){
     $role = Role::get();

        $user = User::where('id', $id)->first();

        return view('Admin.User.role_edit',['user'=>$user,'role'=>$role]);


    }


    public function role_update(Request $request,$id){

        $inputs = request()->validate([
            'name'=>'required'
        ]);

        User::whereId($id)->update($inputs);

        return back();

    }


     public function attach(User $user){
        $user->roles()->attach(request('role'));
         return back();
        }


        public function detach(User $user){
            $user->roles()->detach(request('role'));
            return back();
        }

        public function destory($id){

            $destory = Role::find($id);

            $destory->delete();

            return back();
        }

        public function add_user(){
        return view('Admin.User.add_user');
        }



        public function register(){

            $user_list = User::get();
            $banklist =DB::table('bank_lists')->get();
            return view('Admin.User.register',['user_list'=>$user_list,'banklist'=>$banklist]);

        }
        public function register_store(){
            $user = request()->validate([
                'name' => ['required'],
                'email' => ['required', 'email', 'unique:users'],
                'password' => ['required', 'min:8', 'confirmed'],
            ]);
              User::create([
            'email' => $user['email'],
            'name' => $user['name'],
            'password' => Hash::make($user['password']),
              ]);
              session()->flash('user','User Created');
            return back();
        }

function bank_store()
{
$input = request()->validate([
    'name'=> "required",
    'accountNumber'=> "required",
]);
bankList::create($input);
return back();
}


function delete($id)
{
    DB::table('bank_lists')->where('id',$id)->delete();
    return back();
}
        public function register_edit($id){
            $register_edit = DB::table('users')->where('id',$id)->first();
            return view('Admin.User.register_edit',['register_edit'=>$register_edit]);
 }

        public function register_update($id){
            $user = request()->validate([
                'name' => ['required'],
                'password' => ['required', 'min:8', 'confirmed'],
                'syn_flag' =>['required']
            ]);
            User::whereId($id)->update([
            'name' => $user['name'],
            'password' => Hash::make($user['password']),
            'syn_flag'=>'0'
              ]);
              return redirect()->route('Admin.User.register');
           }

}

