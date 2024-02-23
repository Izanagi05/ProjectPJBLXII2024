<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AgamaController;
use App\Http\Controllers\AlamatController;
use App\Http\Controllers\JenisIuranController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PdfController;
use App\Http\Controllers\PembayaranIuranController;
use App\Http\Controllers\ProvinsiController;
use App\Http\Controllers\RtController;
use App\Http\Controllers\TagihanBulananController;
use App\Http\Controllers\TahunController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WAController;
use Database\Seeders\AdminSeeder;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('pdf.page1');
});
Route::group(['middleware' => 'corscustom'], function () {
    // Daftar rute yang ingin dikecualikan dari middleware CORS
    Route::get('/exportPDF/{laporan_id}/{detail_alamat_id}/{alamat_id}', [PdfController::class, 'exportPDF']);
});

Route::get('/getTagihanallUser', [TagihanBulananController::class, 'getTagihanallUser']);
Route::get('/getUserBelumBayarTagihan', [TagihanBulananController::class, 'getUserBelumBayarTagihan']);


Route::get('/getUserLogin', [UserController::class, 'getUserLogin']);
Route::post('/createLaporan', [LaporanController::class, 'createLaporan']);
Route::get('/allLaporan', [LaporanController::class, 'allLaporan']);
Route::delete('/deleteLaporan/{id}', [LaporanController::class, 'deleteLaporan']);
Route::post('/updateLaporan', [LaporanController::class, 'updateLaporan']);

Route::post('/postMessageCustomToGroup', [WAController::class, 'postMessageCustomToGroup']);

Route::get('/getUserProfilById/{no_telp}', [WAController::class, 'getUserProfilById']);
Route::get('/getDataIPL/{no_telp}', [WAController::class, 'getDataIPL']);

Route::post('/register', [LoginController::class, 'register']);
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout']);

Route::post('/storeRT', [RtController::class, 'storeRT']);
Route::get('/getAllWargaRT', [RtController::class, 'getAllWargaRT']);
Route::post('/updateRT', [RtController::class, 'updateRT']);
Route::delete('/deleteRT/{id}', [RtController::class, 'deleteRT']);

Route::get('/getAllTahun', [TahunController::class, 'getAllTahun']);
Route::post('/createNewYear', [TahunController::class, 'createNewYear']);
Route::post('/updateTahun', [TahunController::class, 'updateTahun']);
Route::delete('/deleteYear/{id}', [TahunController::class, 'deleteYear']);

Route::post('/TransaksiPembayaranIuran', [PembayaranIuranController::class, 'TransaksiPembayaranIuran']);

Route::delete('/deleteJenisIuran/{id}', [JenisIuranController::class, 'deleteJenisIuran']);

Route::post('/buatAkunVia', [UserController::class, 'buatAkunVia']);
Route::post('/editUser', [UserController::class, 'editUser']);
Route::post('/editUserbyid', [UserController::class, 'editUserbyid']);
Route::post('/tambahUserbyid', [UserController::class, 'tambahUserbyid']);
Route::get('/getallwargabyalamat', [UserController::class, 'getallwargabyalamat']);
Route::delete('/deleteUserbyid/{id}', [UserController::class, 'deleteUserbyid']);

Route::get('/getAgama', [AgamaController::class, 'getAgama']);

Route::get('/getProvinsi', [ProvinsiController::class, 'getProvinsi']);
Route::get('/getallalamat', [AlamatController::class, 'getallalamat']);


Route::post('/createJenisIuran', [JenisIuranController::class, 'createJenisIuran']);
Route::group(['middleware' => 'admindata'], function () {
    Route::post('/updateJenisIuran', [JenisIuranController::class, 'updateJenisIuran']);
    Route::get('/getAllJenisIurans', [JenisIuranController::class, 'getAllJenisIurans']);
});
Route::group(['middleware' => 'admindata'], function () {
    Route::get('/jumlahWargaAndTransaksiAndLaporan', [AdminController::class, 'jumlahWargaAndTransaksiAndLaporan']);
    Route::post('/storeUser', [AdminController::class, 'storeUser']);
    Route::get('/getDataAlamatByRt', [RtController::class, 'getDataAlamatByRt']);
    Route::get('/getDataDetailAlamatByRt/{alamat_id}', [RtController::class, 'getDataDetailAlamatByRt']);
});
Route::get('/getAllTagihanUserbyTahun/{tahun_id?}', [TagihanBulananController::class, 'getAllTagihanUserbyTahun']);

Route::get('/getAdminLogin', [AdminController::class, 'getAdminLogin']);
Route::get('/getDataAlamatByRt', [RtController::class, 'getDataAlamatByRt']);
Route::get('/getAllUserRt', [AdminController::class, 'getAllUserRt']);
