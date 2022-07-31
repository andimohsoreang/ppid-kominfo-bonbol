<?php

use App\Http\Controllers\InformasiPublikController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegistrationController;
use Illuminate\Support\Facades\Auth;
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

Route::get('/home', function () {
    return view('welcome');
});

Route::get('/', function (){
    return view('fe.ollie.index');
});


Route::middleware('role:admin')->get('/infopublik', function (){
    return view('fe.ollie.perminfo');
});

Route::middleware('role:petugas')->get('/dashboard', function (){
    return view('be.dashboard', [
        "title" => "Dashboard"
    ]);
});

Route::middleware('role:user')->get('/perinfo', function (){
    return view('be.permohonan', [ 
        "title" => "Permohonan Informasi"
    ]);
});

Route::get('/infopub',[InformasiPublikController::class, 'index']);
Route::post('/infopub/store',[InformasiPublikController::class, 'store'])->name('informasipublik.store');


Route::get('/permohonan', [RegistrationController::class, 'index']);


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Route::get('/login', [LoginController::class, 'index']);
// Route::post('/login', [LoginController::class, 'authenticate']);
