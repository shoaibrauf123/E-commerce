<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use App\Models\User;
use App\Models\Category;
use App\Models\Product;
use App\Models\ContactUs;

use App\Models\Admin;


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
        
        if(Auth::guard("admin")->attempt($credentials)){
           
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
            "month_of_category" => "required",
        ]);
        

        $category = new Category;
        $category->cat_name = $req->cat_name;
        $category->status = $req->status;
        $category->month_of_the_category = $req->month_of_category;
        $result = $category->save();
        if($result){
            return redirect()->route("admin.category")->with("success","Category Successfully Added.");
        }
    }
    public function update_category(Request $req,$id){
        $req->validate([
            "cat_name" => "required",
            "status" => "required",
            "month_of_category" => "required",
        ]);
        $category = Category::find($id);
        $category->cat_name = $req->cat_name;
        $category->status = $req->status;
        $category->month_of_the_category = $req->month_of_category;
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
        $product = Product::orderBy("id","desc")->paginate(5);
      
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
    public function add_product(Request $req){
        $req->validate([
            "categories" => "required",
            "product_name" => "required",
            "product_price" => "required",
            "product_mrp" => "required",
            "product_qty" => "required",
            "short_desc" => "required",
            "description" => "required",
            "meta_title" => "required",
            "meta_desc" => "required",
            "meta_keyword" => "required",
            "product_image" => "required",
            "product_status" => "required",
        ]);

        $product_image = null;
        if(request()->hasfile('product_image')){
            $product_image = time().'.'.request()->product_image->getClientOriginalExtension();
            request()->product_image->move(public_path('assets/img/admin_product/'), $product_image);
        }

        $product = new Product;
        $product->category_id_fk = $req->categories;
        $product->product_name = $req->product_name;
        $product->product_price = $req->product_price;
        $product->product_mrp = $req->product_mrp;
        $product->product_qty = $req->product_qty;
        $product->product_image = $product_image;
        $product->short_desc = $req->short_desc;
        $product->description = $req->description;
        $product->meta_title = $req->meta_title;
        $product->meta_desc = $req->meta_desc;
        $product->meta_keyword = $req->meta_keyword;
        $product->status = $req->product_status;
        $result = $product->save();
        if($result){
            return redirect()->route("admin.product")->with("success","Product Successfully Updated.");
        }
    }

    public function product_eidt_form($id){
        $category = Category::all();
        $product = Product::find($id);
        return view("admin.product.updateProductForm")
                ->with("product",$product)
                ->with("category",$category);
    }

    public function product_update(Request $req,$id){
        $req->validate([
            "categories" => "required",
            "product_name" => "required",
            "product_price" => "required",
            "product_mrp" => "required",
            "product_qty" => "required",
            "short_desc" => "required",
            "description" => "required",
            "meta_title" => "required",
            "meta_desc" => "required",
            "meta_keyword" => "required",
            "product_status" => "required",
        ]);

        $product = Product::find($id);

        // Update Product image Code
        if($req->hasFile('product_image'))
        {
            $destination = public_path("assets/img/admin_product/").$product->Product_image;
            if(File::exists($destination))
            {
                File::delete($destination);
            }
            $file = $req->file('product_image');
            $extension = $file->getClientOriginalExtension();
            $filename = time(). '.' . $extension;
            $file->move(public_path("assets/img/admin_product/"), $filename);
        }

        // Update product image Code End
        
        $product->category_id_fk = $req->categories;
        $product->product_name = $req->product_name;
        $product->product_price = $req->product_price;
        $product->product_mrp = $req->product_mrp;
        $product->product_qty = $req->product_qty;
        if($req->product_image == ""){
            $product_image = $product->product_image;
            $product->product_image = $product_image;
        }else{
            $product->product_image = $filename;
        }
        $product->short_desc = $req->short_desc;
        $product->description = $req->description;
        $product->meta_title = $req->meta_title;
        $product->meta_desc = $req->meta_desc;
        $product->meta_keyword = $req->meta_keyword;
        $product->status = $req->product_status;
        $result = $product->update();
        if($result){
            return redirect()->route("admin.product")->with("success","Product Successfully Added.");
        }
    }
    public function product_delete($id){
        $product = Product::find($id);
         $result = $product->delete(); 
        if($result){
            return redirect()->route("admin.product")->with("success","Product Successfully Deleted.");
        }
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

    public function delete_contact_us($id){
        $contact_us = ContactUs::find($id);
         $result = $contact_us->delete(); 
        if($result){
            return redirect()->route("admin.contactUs")->with("success","Contact Us Successfully Deleted.");
        }
    }
    // End Contact Us Method

    // Start User Method

    public function users(){
        $user = User::orderBy("id","desc")->paginate(5);
        return view("admin.user.user",[
            "users"=>$user,
        ]);
    }

    public function delete_user($id){
        $user = User::find($id);
         $result = $user->delete(); 
        if($result){
            return redirect()->route("admin.users")->with("success","User Successfully Deleted.");
        }
    }

    // End User Method
}
