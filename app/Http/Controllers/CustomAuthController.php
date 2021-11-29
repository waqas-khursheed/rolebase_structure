<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\CustomUser;
use Hash;
use Session;
class CustomAuthController extends Controller
{
    public function login(){
        return view('customAuth.login');
    }


    public function registration(){
        return view('customAuth.registration');
    }

    public function registerUser(Request $request){

        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:custom_users',
            'password' => 'required',
        ]);

        $user = new CustomUser();

        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $res = $user->save();

        if($res){
            return back()->with('success', 'You have register successfuly');
        }else{
            return back()->with('fail', 'Something Wrong');
        }
    }

    public function loginUser(Request $request){

        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:5|max:12',
        ]);

        $user = CustomUser::where('email', '=', $request->email)->first(); 
        if($user){
            if(Hash::check($request->password, $user->password)){

                $request->session()->put('loginId', $user->id);
                return redirect('dashboard');
            }else{
                return back()->with('fail', 'password not matches.');
            }

        }else{
            return back()->with('fail', 'Email is not registered.');
        }
    }

   


    //Dashboard

    public function dashboard(){

        $data = array();

        if(Session::has('loginId')){
            $data = CustomUser::where('id', '=', Session::get('loginId'))->first();
        }
        return view('dashboard', compact('data'));
    }

    public function logout(){

        if(Session::has('loginId')){
            Session::pull('loginId');

            return redirect('custom/login');
        }
    }













    
}
