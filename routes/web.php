<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DecisionTreeController;
use App\Http\Controllers\DhtController;
use App\Http\Controllers\FlameController;
use App\Http\Controllers\GasController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//sensor-kiriman-arduino
Route::post('/tambahdht', [DhtController::class, 'store']);
Route::post('/tambahapi', [FlameController::class, 'store']);
Route::post('/tambahgas', [GasController::class, 'store']);
Route::get('/fetchdata', [FlameController::class,'fetchdata']);


// Route admin site
Route::get('/',[DashboardController::class ,'index'])->middleware('IsLogin');
Route::get('/admin',[DashboardController::class ,'index'])->middleware('IsLogin');
Route::get('/decision-tree', [DecisionTreeController::class, 'showCalculations'])->name('decision.tree');


//DHT22
Route::prefix('dht22')->middleware('IsLogin')->group(function (){
    Route::get('',[DhtController::class, 'index']);
    Route::any('/hapus/{id}',[DhtController::class,'destroy']);

});

Route::prefix('flame')->middleware('IsLogin')->group(function (){
    Route::get('',[FlameController::class, 'index']);
    Route::any('/hapus/{id}',[FlameController::class,'destroy']);
    Route::get('/tambahdataflame', [FlameController::class, 'tambah']);
    Route::post('/tambahdataflame', [FlameController::class, 'store'])->name("flame.tambah");


});

Route::prefix('gas')->middleware('IsLogin')->group(function (){
    Route::get('',[GasController::class, 'index']);
    Route::any('/hapus/{id}',[GasController::class,'destroy']);

});





// Login 
Route::get('/login',['as' => 'login', 'uses' => 'LoginController@do',LoginController::class , 'index'])->middleware('guest')->name('login');
Route::post('login',[LoginController::class , 'authenticate']);

// Logout 
Route::post('/logout',[LoginController::class, 'logout']);

// Register 
Route::get('/register',[RegisterController::class , 'index'])->middleware('guest');
Route::post('/register',[RegisterController::class , 'store']);


// end of route admin site 