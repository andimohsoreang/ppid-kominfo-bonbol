<?php

use App\Http\Controllers\InformasiPublikController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegistrationController;
use GuzzleHttp\Middleware;
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


Route::group(['middleware' => ['auth','role:admin'],'prefix'=>'admin'],function (){

    Route::get('/infopublik', function (){
        return view('fe.ollie.perminfo');
    });

    Route::get('/dashboard', function (){
        return view('be.dashboard', [
            "title" => "Dashboard"
        ]);
    });

    Route::get('/perinfo', function (){
        return view('be.permohonan', [ 
            "title" => "Permohonan Informasi"
        ]);
    });

    Route::get('/permohonan', [RegistrationController::class, 'index']);
    
    
    Route::get('/infopub',[InformasiPublikController::class, 'index']);
    Route::post('/infopub/store',[InformasiPublikController::class, 'store'])->name('informasipublik.store');

});    


Route::group(['middleware' => ['auth','role:petugas'],'prefix'=>'petugas'],function (){

    Route::get('/infopublik', function (){
        return view('fe.ollie.perminfo');
    });

    Route::get('/dashboard', function (){
        return view('be.dashboard', [
            "title" => "Dashboard"
        ]);
    });

    Route::get('/perinfo', function (){
        return view('be.permohonan', [ 
            "title" => "Permohonan Informasi"
        ]);
    });

    Route::get('/permohonan', [RegistrationController::class, 'index']);
    
    
    Route::get('/infopub',[InformasiPublikController::class, 'index'])->name('petugas.informasipublik');
    Route::get('/infopub/create', [InformasiPublikController::class, 'create'])->name('petugas.informasipublik.create');
    Route::post('/infopub/store',[InformasiPublikController::class, 'store'])->name('petugas.informasipublik.store');
    Route::get('/infopub/show/{id}',[InformasiPublikController::class, 'show'])->name('petugas.informasipublik.show');
    Route::delete('infpub/destroy/{id}',[InformasiPublikController::class,'destroy'])->name('petugas.informasipublik.destroy');
    Route::get('/infopub/edit/{id}',[InformasiPublikController::class,'edit'])->name('petugas.informasipublik.edit');
    Route::put('/infopub/update/{id}',[InformasiPublikController::class,'update'])->name('petugas.informasipublik.update');



});    



Route::group(['middleware' => ['auth','role:user'],'prefix'=>'user'],function (){
    
    Route::get('/infopub',[InformasiPublikController::class, 'index']);
    Route::post('/infopub/store',[InformasiPublikController::class, 'store'])->name('informasipublik.store');
    
});    

    Route::get('/infopublik', function (){
        return view('fe.ollie.perminfo');
    });

    Route::get('/dashboard', function (){
        return view('be.dashboard', [
            "title" => "Dashboard"
        ]);
    });

    Route::get('/perinfo', function (){
        return view('be.permohonan', [ 
            "title" => "Permohonan Informasi"
        ]);
    });

    Route::get('/permohonan', [RegistrationController::class, 'index']);
    








Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Route::get('/login', [LoginController::class, 'index']);
// Route::post('/login', [LoginController::class, 'authenticate']);
