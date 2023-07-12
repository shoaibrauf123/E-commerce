<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
//use App\Models\Admin;


class AdminController extends Controller
{
    public function index(){
        return view("admin.dashboard");
    }

    public function loginForm(){
        return view("admin.loginForm");
    }
    public function login(Request $req){
        //dd($req->all());
        $req->validate([
            "email" => "required",
            "password" => "required",
        ]);
        $credentials = $req->only('email', 'password');
        
        if(Auth::attempt($credentials)){
           
            return redirect()->route("admin.home")->with("success","Loggin Successfully");
        }
        return redirect()->route("admin.loginForm")->with("error",'Oppes! You have entered invalid credentials');

    }
    public function logout(){
        if(Auth::check()){
            session()->flush();
            Auth::logout();
            return redirect()->route("admin.loginForm")->with("success","Logout Successfully");
        }
    }
}
