<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Controller;

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

// base
Route::get('/dashboard',  [Controller::class, 'dashboard'])->name('dashboard');
Route::get('/generateCaptcha', [Controller::class, 'generateCaptcha'])->name('generateCaptcha');
Route::get('/logout', [Controller::class, 'logout']);
Route::get('/error404', [Controller::class, 'error404'])->name('error404');

// page
Route::get('/login',  [Controller::class, 'login'])->name('login');
Route::get('/setting', [Controller::class, 'setting'])->name('setting');
Route::get('/logactivity', [Controller::class, 'logactivity'])->name('logactivity');
Route::get('/register', [Controller::class, 'register'])->name('register');
Route::get('/suratmasuk', [Controller::class, 'suratmasuk'])->name('suratmasuk');
Route::get('/document', [Controller::class, 'document'])->name('document');
Route::get('/telathadir', [Controller::class, 'telathadir'])->name('telathadir');
Route::get('/suratkeluar', [Controller::class, 'suratkeluar'])->name('suratkeluar');
Route::get('/pengajuancuti', [Controller::class, 'pengajuancuti'])->name('pengajuancuti');
Route::get('/datasuratmasuk', [Controller::class, 'datasuratmasuk'])->name('datasuratmasuk');
Route::get('/datasuratkeluar', [Controller::class, 'datasuratkeluar'])->name('datasuratkeluar');
Route::get('/dataketerlambatan', [Controller::class, 'dataketerlambatan'])->name('dataketerlambatan');
Route::get('/datapengajuancuti', [Controller::class, 'datapengajuancuti'])->name('datapengajuancuti');
Route::get('/restoredeletesuratmasuk', [Controller::class, 'restoredeletesuratmasuk'])->name('restoredeletesuratmasuk');
Route::get('/restoredeletesuratkeluar', [Controller::class, 'restoredeletesuratkeluar'])->name('restoredeletesuratkeluar');

// aksi
Route::post('/aksi_login', [Controller::class, 'aksi_login']);
Route::post('/editsetting', [Controller::class, 'editsetting']);
Route::post('/aksi_register', [Controller::class, 'aksiregister'])->name('aksi_register');
Route::post('/aksiTambahSuratMasuk', [Controller::class, 'aksiTambahSuratMasuk']);
Route::post('/aksiTambahKeterlambatan', [Controller::class, 'tambahKeterlambatan'])->name('aksiTambahKeterlambatan');
Route::post('/aksiTambahSuratKeluar', [Controller::class, 'aksiTambahSuratKeluar'])->name('aksiTambahSuratKeluar');
Route::post('/aksiTambahCuti', [Controller::class, 'aksiTambahCuti'])->name('aksiTambahCuti');
Route::delete('/deletesuratmasuk/{id}', [Controller::class, 'deletesuratmasuk'])->name('deletesuratmasuk');
Route::post('/restoreSuratMasuk/{id}', [Controller::class, 'restoreSuratMasuk'])->name('restoreSuratMasuk');
Route::delete('/deletesuratkeluar/{id}', [Controller::class, 'deletesuratkeluar'])->name('deletesuratkeluar');
Route::post('/restoreSuratKeluar/{id}', [Controller::class, 'restoreSuratKeluar'])->name('restoreSuratKeluar');
