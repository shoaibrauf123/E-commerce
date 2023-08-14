<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;
use App\Models\Category;
use App\Models\ContactUs;
use App\Models\User;

use App\CustomService\Custom_service;

class HomeController extends Controller
{

    //  private $service;
    // function __construct(Custom_service $ser)
    // {
    //     $this->service = $ser;

    // }

    public function user_register_form(){
        return view("register");
    }
    public function user_register(Request $req){
        $req->validate([
            "username" =>  "required",
            "email" =>  "required|email|unique:users",
            "password" =>  "required",
        ]);

        $user = new User();
        $user->username = $req->username;
        $user->email = $req->email;
        $user->password = Hash::make($req->password);
        $result = $user->save();
        if($result){
            return redirect()->route("user-login-form")->with("success","You are Successfully Register.");
        }


    }
    public function user_logout(Request $req){
        if(Auth::guard("web")->check()){
            Auth::logout();
            return redirect()->route("user-login-form")->with("success","User Successfully Logout.");
        }
    }

    public function home(){



        $product = Product::orderBy("id","desc")->where("status",1)->take(2)->get();
        $month_of_the_category = Category::orderBy("id","desc")
        ->where("status",1)
        ->where("month_of_the_category",1)->get();
        
        return view("home",[
            "feature_product" => $product,
            "month_of_the_category" => $month_of_the_category,
        ]);
    }
    public function contact_us(){
        return view("contact_us");
    }
    public function submit_contact_us(Request $req){
        
        $req->validate([
            "name" => "required",
            "email" => "required",
            "mobile" => "required",
            "comment" => "required",
        ]);

        $contact_us = new ContactUs;
        $contact_us->name = $req->name;
        $contact_us->email = $req->email;
        $contact_us->mobile = $req->mobile;
        $contact_us->comment = $req->comment;
        $result = $contact_us->save();
        if($result){
            return redirect()->route("contact_us")->with("success","Your Contact Details Successfully Added.");
        }
    }
    public function user_login_form(){
        return view("login");
    }
    public function user_login(Request $req){
        $req->validate([
            "email" => "required",
            "password" => "required",
        ]);
        $credentials = $req->only('email', 'password');
        
        if(Auth::attempt($credentials)){
           
            return redirect()->route("home")->with("success","Loggin Successfully");
        }
        return redirect()->route("admin.loginForm")->with("error",'Oppes! You have entered invalid credentials');

    }
    public function category($id){
        $category = Category::orderBy("id","desc")->where("status",1)->where("month_of_the_category",1)->find($id)->products;

     //dd($category);
        return view("category",[
            "get_product" => $category,
        ]);
    }
    public function single_product($id){
        $single_product = Product::where("status",1)->find($id);
      //  dd($single_product);
        return view("single_product",[
            "single_product" => $single_product,
        ]);
    }
}
