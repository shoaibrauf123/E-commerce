<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Category;
use App\Models\Product;
use App\Models\ContactUs;
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

    // Start category Method
    public function category(){
        $category = Category::orderBy("id","desc")->paginate(5);
        //dd($category);
        return view("admin.category.category",[
                "category" => $category,
            ]);
    }
    public function add_category(Request $req){
        $req->validate([
            "cat_name" => "required",
            "status" => "required",
        ]);

        $category = new Category;
        $category->cat_name = $req->cat_name;
        $category->status = $req->status;
        $result = $category->save();
        if($result){
            return redirect()->route("admin.category")->with("success","Category Successfully Added.");
        }
    }
    public function update_category(Request $req,$id){
        $req->validate([
            "cat_name" => "required",
            "status" => "required",
        ]);
        $category = Category::find($id);
        $category->cat_name = $req->cat_name;
        $category->status = $req->status;
        $result = $category->update();
        if($result){
            return redirect()->route("admin.category")->with("success","Category Successfully Updated.");
        }
    }
    public function delete_category($id){
        $category = Category::find($id);
        $result = $category->delete();
        if($result){
            return redirect()->route("admin.category")->with("success","Category Successfully Deleted.");
        }
    }
    // End Category Methods

    // Start Product Method

    public function product(){
        $product = Product::paginate(5);
        return view("admin.product.product",[
            "product" => $product,
        ]);
    }
    public function product_form(){
        $category = Category::all();
        return view("admin.product.productForm",[
            "category" => $category,
        ]);
    }
    // End Product Method

    // Start Contact Us Method
    public function contact_us(){
        $contact_us = ContactUs::orderBy("id","desc")->paginate(5);
        return view("admin.contact_us.contact_us",[
            "contact_us" => $contact_us,
        ]);
    }
    // public function add_contact_us(Request $req){
    //     $req->validate([
    //         "name" => "required",
    //         "email" => "required",
    //         "mobile" => "required",
    //         "comment" => "required",
    //     ]);
    //     $contact_us = new ContactUs;
    //     $contact_us->name = $req->name;
    //     $contact_us->email = $req->email;
    //     $contact_us->mobile = $req->mobile;
    //     $contact_us->comment = $req->comment;
    //     $result = $contact_us->save(); 
    //     if($result){
    //         return redirect()->route("admin.contactUs")->with("success","Contact Us Successfully Added.");
    //     }

    // }

    // public function update_contact_us(Request $req,$id){
    //     $req->validate([
    //         "name" => "required",
    //         "email" => "required",
    //         "mobile" => "required",
    //         "comment" => "required",
    //     ]);

    //     $contact_us = ContactUs::find($id);
    //     $contact_us->name = $req->name;
    //     $contact_us->email = $req->email;
    //     $contact_us->mobile = $req->mobile;
    //     $contact_us->comment = $req->comment;
    //     $result = $contact_us->save(); 
    //     if($result){
    //         return redirect()->route("admin.contactUs")->with("success","Contact Us Successfully Updated.");
    //     }

    // }

    // public function delete_contact_us($id){
    //     $category = ContactUs::find($id);
    //      $result = $contact_us->delete(); 
    //     if($result){
    //         return redirect()->route("admin.contactUs")->with("success","Contact Us Successfully Deleted.");
    //     }
    // }
    // End Contact Us Method
}
