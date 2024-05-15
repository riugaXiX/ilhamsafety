<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DhtController;
use App\Http\Controllers\FlameController;
use App\Http\Controllers\GasController;
// use App\Http\Controllers\GuruController;
use App\Http\Controllers\LoginController;
// use App\Http\Controllers\PelajaranController;
// use App\Http\Controllers\PpdbController;1
use App\Http\Controllers\RegisterController;
// use App\Http\Controllers\SiswaController;
// use App\Http\Controllers\ClientController;
// use App\Http\Controllers\PpdbcController;
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









// Route admin site
Route::get('/',[DashboardController::class ,'index'])->middleware('IsLogin');
Route::get('/admin',[DashboardController::class ,'index'])->middleware('IsLogin');



//sensor-kiriman-arduino
Route::post('/tambahdht', [DhtController::class, 'store']);
Route::post('/tambahapi', [FlameController::class, 'store']);
Route::post('/tambahgas', [GasController::class, 'store']);

//DHT22
Route::prefix('dht22')->middleware('IsLogin')->group(function (){
    Route::get('',[DhtController::class, 'index']);
// Route::any('/hapusguru/{id}',[GuruController::class,'destroy']);
    Route::any('/hapus/{id}',[DhtController::class,'destroy']);

});

Route::prefix('flame')->middleware('IsLogin')->group(function (){
    Route::get('',[FlameController::class, 'index']);
// Route::any('/hapusguru/{id}',[GuruController::class,'destroy']);
    Route::any('/hapus/{id}',[FlameController::class,'destroy']);

});

Route::prefix('gas')->middleware('IsLogin')->group(function (){
    Route::get('',[GasController::class, 'index']);
// Route::any('/hapusguru/{id}',[GuruController::class,'destroy']);
    Route::any('/hapus/{id}',[GasController::class,'destroy']);

});


// Mata pelajaran
// Route::prefix('pelajaran')->middleware('IsLogin')->group(function(){
//     Route::get('',[PelajaranController::class ,'index']);

//     // Tambah pelajaran
//     Route::get('/tambahpelajaran',[PelajaranController::class,'create']);
//     Route::post('/tambahPelajaran',[PelajaranController::class,'store'])->name('pelajaran.tambah');

//     // Edit Pelajaran 
//     Route::get('/editpelajaran/{id}',[PelajaranController::class,'edit']);
//     Route::post('/editpelajaran/{id}',[PelajaranController::class,'update'])->name('pelajaran.edit');

//     // Hapus pelajaran 
//     Route::any('/hapuspelajaran/{id}',[PelajaranController::class,'destroy']);


// });

// // PPDB 
// Route::get('/ppdb',[PpdbController::class ,'index'])->middleware('IsLogin');
// Route::any('/terima/{id}',[PpdbController::class ,'update'])->middleware('IsLogin');
// Route::any('/tolak/{id}',[PpdbController::class,'tolak'])->middleware('IsLogin');


// Route::prefix('guru')->middleware('IsLogin')->group(function () {
//     // Rute yang berada dalam grup ini akan memiliki awalan '/admin'
//     // Middleware 'auth' akan diterapkan pada semua rute dalam grup ini
//     // Anda juga dapat menambahkan middleware lain sesuai kebutuhan

// // Guru 
// Route::get('/',[GuruController::class ,'index']);
// Route::get('/guru/{id}',[GuruController::class,'show']);

// // tambah guru 
// Route::get('/tambahguru',[GuruController::class,'create']);
// Route::post('/tambahguru',[GuruController::class,'store'])->name('guru.tambah');



// // edit Guru 
// Route::get('/editguru/{id}',[GuruController::class,'edit']);
// Route::post('/updateguru/{id}',[GuruController::class,'update'])->name('guru.edit');

// // hapus guru 
// Route::any('/hapusguru/{id}',[GuruController::class,'destroy']);

// });


// Route::prefix('siswa')->middleware('IsLogin')->group(function(){
 
//     // Siswa 
//     Route::get('/',[SiswaController::class ,'index'])->middleware('IsLogin');

//     // tambah siswa 
//     Route::get('/tambahsiswa',[siswaController::class,'create']);
//     Route::post('/tambahsiswa',[siswaController::class,'store'])->name('siswa.tambah');



//     // edit siswa 
//     Route::get('/editsiswa/{id}',[siswaController::class,'edit']);
//     Route::post('/updatesiswa/{id}',[siswaController::class,'update'])->name('siswa.edit');

//     // hapus siswa 
//     Route::any('/hapussiswa/{id}',[SiswaController::class,'destroy']);
// });


// Login 
Route::get('/login',['as' => 'login', 'uses' => 'LoginController@do',LoginController::class , 'index'])->middleware('guest')->name('login');
Route::post('login',[LoginController::class , 'authenticate']);

// Logout 
Route::post('/logout',[LoginController::class, 'logout']);

// Register 
Route::get('/register',[RegisterController::class , 'index'])->middleware('guest');
Route::post('/register',[RegisterController::class , 'store']);

// end of route admin site 