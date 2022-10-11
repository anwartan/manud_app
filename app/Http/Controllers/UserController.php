<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller{
    public function index()
    {
        $user = User::all();
        return view('pages.user',['users'=>$user]);
    }

    public function create()
    {
        return view('pages.create-user');
    }

    public function save(Request $request){
       
        $validate = $request->validate([
            'first_name' => 'required|max:255|min:2',
            'last_name' => 'required|max:255|min:2',
            'role'=>'required|in:SUPER_ADMIN,ADMIN',
            'password' => 'required|min:8|confirmed',
            'email' => 'required|email|unique:users,email',
        ]);
   
        $user = new User();
        $user->password = Hash::make($request->password);
        $user->email = $request->email;
        $user->role = $request->role;
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->name = $request->first_name." ".$request->last_name;
        $user->save();
        

     
        return redirect('/admin/user')
                        ->with('success','User created successfully.');
        
    }

    public function edit(User $user){
        return view('pages.edit-user',compact('user'));
    }
    public function update(Request $request,User $user){
        
        $request->validate([
            'first_name' => 'required|max:255|min:2',
            'last_name' => 'required|max:255|min:2',
            'role'=>'required|in:SUPER_ADMIN,ADMIN',
            'password' => 'required|min:8|confirmed',
            'email' => 'required|email',
        ]);
        if(Hash::check($request->password, $user->password)==false){
            
            return redirect('/admin/user')
                ->with('failed','User updated failed');
        }
        $request->name=$request->first_name. " ". $request->last_name;
        $user->first_name = $request->first_name;
        $user->role = $request->role;
        $user->last_name = $request->last_name;
        $user->name = $request->first_name." ".$request->last_name;
        $user->save();

        return redirect('/admin/user')
                        ->with('success','User updated successfully');
    }
    public function destroy(User $user)
    {   
        if(Auth::id()==$user->id){
            return redirect('/admin/user')
            ->with('failed','User deleted failed');
        }
        $user->delete();
    
        return redirect('/admin/user')
                        ->with('success','User deleted successfully');
    }
}