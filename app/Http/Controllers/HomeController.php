<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;

class HomeController extends Controller
{

    public function home(){
        $product = Product::orderBy("id","desc")->take(2)->get();
        $month_of_the_category = Category::all();
        return view("home",[
            "feature_product" => $product,
        ]);
    }
    public function contact_us(){
        return view("contact_us");
    }
    public function product(){
        return view("product");
    }

    public function single_product(){
        return view("single_product");
    }
}
