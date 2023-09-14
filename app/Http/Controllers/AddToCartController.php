<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Product;
use App\Models\Order;

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

    public function order_payment(Request $req){

        $req->validate([
            "address" => "required",
            "state" => "required",
            "city" => "required",
            "postal_code" => "required",
            "pin_code" => "required",
            "payment_type" => "required",
        ]);
        $order = new Order();
        if(Auth::check()){
            $order->user_id = Auth::user()->id;
        }
        $order->address = $req->address;
        $order->state = $req->state;
        $order->city = $req->city;
        $order->postal_code = $req->postal_code;
        $order->pincode = $req->pin_code;
        $order->payment_type = $req->payment_type;
        $order->total_price = $req->total_price;
        $order->payment_status = 'pending';
        if($req->payment_type == 'cod'){
            $order->payment_status = 'success';
        }
        $order->order_status = 'pending';
        $order->save();
        $lastInsertId = $order->id;

        if($lastInsertId){
            if(session()->has('cart')){
                foreach(session()->get('cart') as $key => $value){
                   DB::table('order_details')->insert([
                        "order_id" => $lastInsertId,
                        "product_id" => $key,
                        "qty" => $value['qty'],
                        "price" => $req->total_price,
                        'created_at' => date('Y-m-d h:i:s'),
                        'updated_at' => date('Y-m-d h:i:s'),
                    ]); 
                }
            }
        }
        session()->forget('cart');
        return redirect()->route('order-placement');     

    }
    public function order_placement(){
        return view("order_placement");
    }

}
