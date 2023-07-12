<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;

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
    Route::get("/","index")->name("admin.home");
    Route::get("loginForm","loginForm")->name("admin.loginForm");
    Route::post("login","login")->name("admin.login");
    Route::get("logout","logout")->name("admin.logout");

    // categories Route Start 
        Route::get("category","category")->name("admin.category");
        Route::post("add-category","add_category")->name("admin.addCategory");
        Route::post("update-category/{id}","update_category")->name("admin.updateCategory");
        Route::get("delete-category/{id}","delete_category")->name("admin.deleteCategory");

    // categorires Route End


});
