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

});
