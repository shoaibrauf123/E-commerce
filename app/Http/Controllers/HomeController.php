<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;

class HomeController extends Controller
{

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
    public function product(){
        $product = Product::orderBy("id","desc")->where("status","1")->paginate(10);

        return view("product",[
            "get_product" => $product,
        ]);
    }
    public function category($id){
        $category = Category::orderBy("id","desc")->where("status",1)->where("month_of_the_category",1)->find($id)->products;
        //dd($category);
        return view("category");
    }
}
