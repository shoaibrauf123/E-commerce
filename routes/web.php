<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AddToCartController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });
Route::controller(AdminController::class)->prefix("admin")->group(function(){

    
    Route::middleware("admin.guest:admin")->group(function(){
         Route::get("loginForm","loginForm")->name("admin.loginForm");
        Route::post("login","login")->name("admin.login");
    });
    Route::middleware("admin.auth")->group(function(){
        Route::get("/","index")->name("admin.home");
        Route::get("logout","logout")->name("admin.logout");

        // categories Route Start 
        Route::get("category","category")->name("admin.category");
        Route::post("add-category","add_category")->name("admin.addCategory");
        Route::post("update-category/{id}","update_category")->name("admin.updateCategory");
        Route::get("delete-category/{id}","delete_category")->name("admin.deleteCategory");

        // categorires Route End

        // Product Route Start
        Route::get("product","product")->name("admin.product");
        Route::get("product-form","product_form")->name("admin.productForm");
        Route::post("add-product","add_product")->name("admin.addProduct");
        Route::get("eidt-product-form/{id}","product_eidt_form")->name("admin.editProductForm");
        Route::Post("update-product/{id}","product_update")->name("admin.updateProduct");
        Route::get("delete-product/{id}","product_delete")->name("admin.deleteProduct");
        
        // Product Route End

        // Contact Us Route Start 

        Route::get("contact-us","contact_us")->name("admin.contactUs");
        Route::get("delete-contactUs/{id}","delete_contact_us")->name("admin.deleteContactUs");
        // Route::post("add-contact-us","add_contact_us")->name("admin.addContactUs");
        // Route::post("update-contact-us/{id}","update_contact_us")->name("admin.updateContactUs");
       
        // Contact Us Route End

        // Start User Route 
        
        Route::get("users","users")->name("admin.users");
        Route::get("delete-user/{id}","delete_user")->name("admin.deleteUser");

        // End User Route 
        

    });  
});

Route::controller(HomeController::class)->group(function(){
    Route::get("/","home")->name("home");
    Route::get("contact_us","contact_us")->name("contact_us");
    Route::post("submit-contact-us","submit_contact_us")->name("submit_contact_us");

    Route::get("user-register-form","user_register_form")->name("user-register-form");
    Route::post("user-register","user_register")->name("user-register");
    Route::get("user-login-form","user_login_form")->name("user-login-form");
    Route::post("user-login","user_login")->name("user-login");
    Route::get("user-logout","user_logout")->name("user-logout");
    
    // Start Category
    Route::get("category/{id}","category")->name("category");
    
    // End Category

    // start Product
    Route::get("single-product/{id}","single_product")->name("single-product");
    // end Product
});

Route::controller(AddToCartController::class)->group(function(){

    Route::get("cart/","cart")->name("cart");
    Route::get("add-to-cart/{product}","add_to_cart")->name("add-to-cart");
    Route::get('delete-cart-item/{id}','delete_cart_item')->name('delete-cart-item');

});
