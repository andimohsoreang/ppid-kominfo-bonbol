<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\InformasiPublikController;
use App\Http\Controllers\KlasifikasiController;
use App\Http\Controllers\KontakKamiController;
use App\Http\Controllers\PengajuanKeberatanController;
use App\Http\Controllers\PermohonanInformasiController;
use App\Http\Controllers\PetugasController;
use App\Http\Controllers\PetugasInformasiPublikController;
use App\Http\Controllers\PetugasPengajuanKeberatanController;
use App\Http\Controllers\PetugasPermohonanInformasiController;
use App\Http\Controllers\ProfilKantorController;
use App\Http\Controllers\UserController;
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

// Route::get('/home', function () {
//     return view('welcome');
// });

Route::get('/', [UserController::class, 'index'])->name('home');

Route::get('/daftar-informasi-publik', [InformasiPublikController::class, 'index'])->name('infopub');
Route::get('/daftar-informasi-publik/download/{id}', [InformasiPublikController::class, 'download'])->name('download.infopub');

Route::get('/pemohon', [PermohonanInformasiController::class, 'index'])->name('pemohon.register');

Route::get('/pemohon/lembaga', [PermohonanInformasiController::class, 'indexlembaga'])->name('lembaga.register');
Route::post('/pemohon/lembaga', [PermohonanInformasiController::class, 'storelembaga'])->name('lembaga.register.store');

Route::get('/pemohon/perorangan', [PermohonanInformasiController::class, 'indexperorangan'])->name('perorangan.register');
Route::post('/pemohon/perorangan', [PermohonanInformasiController::class, 'storeperorangan'])->name('perorangan.register.store');

Route::get('/statistik', [UserController::class, 'statistik'])->name('statistik');

Route::post('/kontakkami', [UserController::class, 'kontakkami'])->name('kontakkami');

Auth::routes(['register' => false]);

// Route Admin
Route::group(['middleware' => ['auth','role:admin'],'prefix'=>'admin'],function (){
    Route::get('/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::get('/akun', [AdminController::class, 'akun'])->name('admin.akun');
    Route::put('/akun/update/{id}', [AdminController::class, 'akunupdate'])->name('admin.akun.update');
    Route::get('/akun/password', [AdminController::class, 'akunpassword'])->name('admin.password');
    Route::put('/akun/password/update/{id}', [AdminController::class, 'akunpasswordupdate'])->name('admin.password.update');

    Route::get('/klasifikasi', [KlasifikasiController::class, 'index'])->name('admin.klasifikasi');
    Route::get('/klasifikasi/create', [KlasifikasiController::class, 'create'])->name('admin.klasifikasi.create');
    Route::post('/klasifikasi/store', [KlasifikasiController::class, 'store'])->name('admin.klasifikasi.store');
    Route::get('/klasifikasi/edit/{id}', [KlasifikasiController::class, 'edit'])->name('admin.klasifikasi.edit');
    Route::put('/klasifikasi/update/{id}', [KlasifikasiController::class, 'update'])->name('admin.klasifikasi.update');
    Route::delete('/klasifikasi/destroy/{id}', [KlasifikasiController::class, 'destroy'])->name('admin.klasifikasi.destroy');

    // Informasi Publikasi
    Route::get('/infopub',[PetugasInformasiPublikController::class, 'index'])->name('admin.informasipublik');
    Route::get('/infopub/create', [PetugasInformasiPublikController::class, 'create'])->name('admin.informasipublik.create');
    Route::post('/infopub/store',[PetugasInformasiPublikController::class, 'store'])->name('admin.informasipublik.store');
    Route::get('/infopub/show/{id}',[PetugasInformasiPublikController::class, 'show'])->name('admin.informasipublik.show');
    Route::delete('infpub/destroy/{id}',[PetugasInformasiPublikController::class,'destroy'])->name('admin.informasipublik.destroy');
    Route::get('/infopub/edit/{id}',[PetugasInformasiPublikController::class,'edit'])->name('admin.informasipublik.edit');
    Route::put('/infopub/update/{id}',[PetugasInformasiPublikController::class,'update'])->name('admin.informasipublik.update');

    // Permohonan Informasi
    Route::get('/permohonaninformasi', [PetugasPermohonanInformasiController::class, 'index'])->name('admin.permohonaninformasi');
    Route::get('/permohonaninformasi/proses/{id}', [PetugasPermohonanInformasiController::class, 'proses'])->name('admin.permohonaninformasi.proses');
    Route::get('/permohonaninformasi/show/{id}', [PetugasPermohonanInformasiController::class, 'show'])->name('admin.permohonaninformasi.show');
    Route::put('/permohonaninformasi/terima/{id}', [PetugasPermohonanInformasiController::class, 'terima'])->name('admin.permohonaninformasi.terima');
    Route::put('/permohonaninformasi/batalterima/{id}', [PetugasPermohonanInformasiController::class, 'batalterima'])->name('admin.permohonaninformasi.batalterima');
    Route::put('/permohonaninformasi/sendterima/{id}', [PetugasPermohonanInformasiController::class, 'sendterima'])->name('admin.permohonaninformasi.sendterima');
    Route::put('/permohonaninformasi/tolak/{id}', [PetugasPermohonanInformasiController::class, 'tolak'])->name('admin.permohonaninformasi.tolak');
    Route::put('/permohonaninformasi/sendtolak/{id}', [PetugasPermohonanInformasiController::class, 'sendtolak'])->name('admin.permohonaninformasi.sendtolak');

    Route::delete('/permohonaninformasi/destroy/{id}', [PermohonanInformasiController::class, 'userdestroypermohonaninformasi'])->name('admin.permohonaninformasi.destroy');
    Route::get('/permohonaninformasi/edit/{id}', [PermohonanInformasiController::class, 'usereditpermohonaninformasi'])->name('admin.permohonaninformasi.edit');
    Route::put('/permohonaninformasi/update/{id}', [PermohonanInformasiController::class, 'userupdatepermohonaninformasi'])->name('admin.permohonaninformasi.update');

    // Pengajuan Keberatan
    Route::get('/pengajuankeberatan', [PetugasPengajuanKeberatanController::class, 'index'])->name('admin.pengajuankeberatan');
    Route::get('/pengajuankeberatan/show/{id}', [PetugasPengajuanKeberatanController::class, 'show'])->name('admin.pengajuankeberatan.show');
    Route::put('/pengajuankeberatan/terima/{id}', [PetugasPengajuanKeberatanController::class, 'terima'])->name('admin.pengajuankeberatan.terima');
    Route::put('/pengajuankeberatan/tolak/{id}', [PetugasPengajuanKeberatanController::class, 'tolak'])->name('admin.pengajuankeberatan.tolak');
    Route::put('/pengajuankeberatan/sendterima/{id}', [PetugasPengajuanKeberatanController::class, 'sendterima'])->name('admin.pengajuankeberatan.sendterima');
    Route::put('/pengajuankeberatan/sendtolak/{id}', [PetugasPengajuanKeberatanController::class, 'sendtolak'])->name('admin.pengajuankeberatan.sendtolak');

    Route::delete('/pengajuankeberatan/destroy/{id}', [PengajuanKeberatanController::class, 'destroy'])->name('admin.pengajuankeberatan.destroy');
    Route::get('/pengajuankeberatan/edit/{id}', [PengajuanKeberatanController::class, 'edit'])->name('admin.pengajuankeberatan.edit');
    Route::put('/pengajuankeberatan/update/{id}', [PengajuanKeberatanController::class, 'update'])->name('admin.pengajuankeberatan.update');
    Route::get('/getpermohonaninformasi/{id}', [PengajuanKeberatanController::class, 'getPermohonanInformasi']);
    
    Route::get('/petugas', [AdminController::class, 'user'])->name('admin.petugas');
    Route::get('/petugas/create', [AdminController::class, 'usercreate'])->name('admin.petugas.create');
    Route::post('/petugas/store', [AdminController::class, 'userstore'])->name('admin.petugas.store');
    Route::get('/petugas/password/{id}', [AdminController::class, 'userpassword'])->name('admin.petugas.password');
    Route::get('/pemohon/password/{id}', [AdminController::class, 'userpassword'])->name('admin.pemohon.password');
    Route::put('/petugas/password/update/{id}', [AdminController::class, 'userpasswordupdate'])->name('admin.password.update');
    Route::get('/pemohon', [AdminController::class, 'user'])->name('admin.pemohon');
    Route::get('/petugas/show/{id}', [AdminController::class, 'usershow'])->name('admin.petugas.show');
    Route::get('/pemohon/show/{id}', [AdminController::class, 'usershow'])->name('admin.pemohon.show');
    Route::get('/petugas/edit/{id}', [AdminController::class, 'useredit'])->name('admin.petugas.edit');
    Route::get('/pemohon/edit/{id}', [AdminController::class, 'useredit'])->name('admin.pemohon.edit');
    Route::put('/petugas/update/{id}', [AdminController::class, 'userupdate'])->name('admin.petugas.update');
    Route::put('/pemohon/update/{id}', [AdminController::class, 'userupdate'])->name('admin.pemohon.update');
    Route::delete('/petugas/destroy/{id}', [AdminController::class, 'userdestroy'])->name('admin.petugas.destroy');
    Route::delete('/pemohon/destroy/{id}', [AdminController::class, 'userdestroy'])->name('admin.pemohon.destroy');

    Route::get('/profilkantor', [ProfilKantorController::class, 'index'])->name('admin.profilkantor');
    Route::put('/profilkantor/update/{id}', [ProfilKantorController::class, 'update'])->name('admin.profilkantor.update');
    Route::get('/kotakpesan', [KontakKamiController::class, 'index'])->name('admin.kotakpesan');
    Route::delete('/kotakpesan/destroy/{id}', [KontakKamiController::class, 'destroy'])->name('admin.kotakpesan.destroy');

    Route::get('/laporan', [AdminController::class, 'laporan'])->name('admin.laporan');
    Route::get('/laporan/search', [AdminController::class, 'laporansearch'])->name('admin.laporan.search');
});

// Route Petugas
Route::group(['middleware' => ['auth','role:petugas'],'prefix'=>'petugas'],function (){
    Route::get('/dashboard', [PetugasController::class, 'index'])->name('petugas.dashboard');
    Route::get('/akun', [PetugasController::class, 'akun'])->name('petugas.akun');
    Route::put('/akun/update/{id}', [PetugasController::class, 'akunupdate'])->name('petugas.akun.update');
    Route::get('/akun/password', [PetugasController::class, 'akunpassword'])->name('petugas.password');
    Route::put('/akun/password/update/{id}', [PetugasController::class, 'akunpasswordupdate'])->name('petugas.password.update');
    
    // Informasi Publikasi
    Route::get('/infopub',[PetugasInformasiPublikController::class, 'index'])->name('petugas.informasipublik');
    Route::get('/infopub/create', [PetugasInformasiPublikController::class, 'create'])->name('petugas.informasipublik.create');
    Route::post('/infopub/store',[PetugasInformasiPublikController::class, 'store'])->name('petugas.informasipublik.store');
    Route::get('/infopub/show/{id}',[PetugasInformasiPublikController::class, 'show'])->name('petugas.informasipublik.show');
    Route::delete('infpub/destroy/{id}',[PetugasInformasiPublikController::class,'destroy'])->name('petugas.informasipublik.destroy');
    Route::get('/infopub/edit/{id}',[PetugasInformasiPublikController::class,'edit'])->name('petugas.informasipublik.edit');
    Route::put('/infopub/update/{id}',[PetugasInformasiPublikController::class,'update'])->name('petugas.informasipublik.update');
    
    // Permohonan Informasi
    Route::get('/permohonaninformasi', [PetugasPermohonanInformasiController::class, 'index'])->name('petugas.permohonaninformasi');
    Route::get('/permohonaninformasi/proses/{id}', [PetugasPermohonanInformasiController::class, 'proses'])->name('petugas.permohonaninformasi.proses');
    Route::get('/permohonaninformasi/show/{id}', [PetugasPermohonanInformasiController::class, 'show'])->name('petugas.permohonaninformasi.show');
    Route::put('/permohonaninformasi/terima/{id}', [PetugasPermohonanInformasiController::class, 'terima'])->name('petugas.permohonaninformasi.terima');
    Route::put('/permohonaninformasi/batalterima/{id}', [PetugasPermohonanInformasiController::class, 'batalterima'])->name('petugas.permohonaninformasi.batalterima');
    Route::put('/permohonaninformasi/sendterima/{id}', [PetugasPermohonanInformasiController::class, 'sendterima'])->name('petugas.permohonaninformasi.sendterima');
    Route::put('/permohonaninformasi/tolak/{id}', [PetugasPermohonanInformasiController::class, 'tolak'])->name('petugas.permohonaninformasi.tolak');
    Route::put('/permohonaninformasi/sendtolak/{id}', [PetugasPermohonanInformasiController::class, 'sendtolak'])->name('petugas.permohonaninformasi.sendtolak');
    
    // Pengajuan Keberatan
    Route::get('/pengajuankeberatan', [PetugasPengajuanKeberatanController::class, 'index'])->name('petugas.pengajuankeberatan');
    Route::get('/pengajuankeberatan/show/{id}', [PetugasPengajuanKeberatanController::class, 'show'])->name('petugas.pengajuankeberatan.show');
    Route::put('/pengajuankeberatan/terima/{id}', [PetugasPengajuanKeberatanController::class, 'terima'])->name('petugas.pengajuankeberatan.terima');
    Route::put('/pengajuankeberatan/tolak/{id}', [PetugasPengajuanKeberatanController::class, 'tolak'])->name('petugas.pengajuankeberatan.tolak');
    Route::put('/pengajuankeberatan/sendterima/{id}', [PetugasPengajuanKeberatanController::class, 'sendterima'])->name('petugas.pengajuankeberatan.sendterima');
    Route::put('/pengajuankeberatan/sendtolak/{id}', [PetugasPengajuanKeberatanController::class, 'sendtolak'])->name('petugas.pengajuankeberatan.sendtolak');
});    

// Route User
Route::group(['middleware' => ['auth','role:user'],'prefix'=>'user'],function (){
    Route::get('/dashboard', [UserController::class, 'indexlogin'])->name('user.dashboard');
    Route::get('/akun', [UserController::class, 'akun'])->name('user.akun');
    Route::put('/akun/update/{id}', [UserController::class, 'akunupdate'])->name('user.akun.update');
    Route::get('/akun/password', [UserController::class, 'akunpassword'])->name('user.password');
    Route::put('/akun/password/update/{id}', [UserController::class, 'akunpasswordupdate'])->name('user.password.update');

    // Permohonan Informasi
    Route::get('/permohonaninformasi', [PermohonanInformasiController::class, 'userpermohonaninformasi'])->name('user.permohonaninformasi');
    Route::get('/permohonaninformasi/create', [PermohonanInformasiController::class, 'usercreatepermohonaninformasi'])->name('user.permohonaninformasi.create');
    Route::post('/permohonaninformasi/store', [PermohonanInformasiController::class, 'userstorepermohonaninformasi'])->name('user.permohonaninformasi.store');
    Route::get('/permohonaninformasi/show/{id}', [PermohonanInformasiController::class, 'usershowpermohonaninformasi'])->name('user.permohonaninformasi.show');
    Route::get('/permohonaninformasi/edit/{id}', [PermohonanInformasiController::class, 'usereditpermohonaninformasi'])->name('user.permohonaninformasi.edit');
    Route::put('/permohonaninformasi/update/{id}', [PermohonanInformasiController::class, 'userupdatepermohonaninformasi'])->name('user.permohonaninformasi.update');
    Route::delete('/permohonaninformasi/destroy/{id}', [PermohonanInformasiController::class, 'userdestroypermohonaninformasi'])->name('user.permohonaninformasi.destroy');

    // Pengajuan Keberatan
    Route::get('/pengajuankeberatan', [PengajuanKeberatanController::class, 'index'])->name('user.pengajuankeberatan');
    Route::get('/pengajuankeberatan/create', [PengajuanKeberatanController::class, 'create'])->name('user.pengajuankeberatan.create');
    Route::get('/getpermohonaninformasi/{id}', [PengajuanKeberatanController::class, 'getPermohonanInformasi']);
    Route::post('/pengajuankeberatan/store', [PengajuanKeberatanController::class, 'store'])->name('user.pengajuankeberatan.store');
    Route::get('/pengajuankeberatan/show/{id}', [PengajuanKeberatanController::class, 'show'])->name('user.pengajuankeberatan.show');
    Route::get('/pengajuankeberatan/edit/{id}', [PengajuanKeberatanController::class, 'edit'])->name('user.pengajuankeberatan.edit');
    Route::put('/pengajuankeberatan/update/{id}', [PengajuanKeberatanController::class, 'update'])->name('user.pengajuankeberatan.update');
    Route::delete('/pengajuankeberatan/destroy/{id}', [PengajuanKeberatanController::class, 'destroy'])->name('user.pengajuankeberatan.destroy');
    
});    

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Route::get('/login', [LoginController::class, 'index']);
// Route::post('/login', [LoginController::class, 'authenticate']);