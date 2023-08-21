<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class AddToCartController extends Controller
{
    public function cart(){
        return view("shopping_cart");
    }
    public function add_to_cart(Product $product){
        
        $cart = session()->get("cart");
        if(!$cart){

            $cart = [
                $product->id => [
                    "name" => $product->product_name,
                    "price" => $product->product_price,
                    "qty" => 1,
                    "cart_image" => $product->product_image,
                ],
            ];

            session()->put("cart",$cart);
            return redirect()->route("cart")->with("success","Added To Product");
        }

        // if(isset($cart[$product->id])){
        //     $cart[$product->id]["qty"]++;
        //     session()->put("cart",$cart);
        //     return redirect()->route("cart")->with("success","Added To Product");
        // }

        $cart[$product->id] = [
            "name" => $product->product_name,
            "price" => $product->product_price,
            "qty" => 1,
            "cart_image" => $product->product_image,

        ];
        session()->put("cart",$cart);
        return redirect()->route("cart")->with("success","Added To Product");
    }   

    public function delete_cart_item($id){
        $cart = session()->get('cart');
        if(isset($cart[$id])){
            unset($cart[$id]);
            session()->put("cart",$cart);
        }
        return redirect()->route("cart")->with("success","Cart Item Successfully deleted.");
    }
    public function qty_update(Request $request){

        $cart = session()->get('cart');
    
        if(isset($cart[$request->product_id])){

            $cart[$request->product_id]['qty'] = $request->qty_id;
            session()->put("cart",$cart);
            return response()->json(["status"=>true]);
        }
       
    }

    public function checkout(){
        return view("checkout");
    }
}
