<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminRWController;
use App\Http\Controllers\AgamaController;
use App\Http\Controllers\AlamatController;
use App\Http\Controllers\BulanController;
use App\Http\Controllers\DetailAlamatController;
use App\Http\Controllers\JenisIuranController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PdfController;
use App\Http\Controllers\PemasukanController;
use App\Http\Controllers\PembayaranIuranController;
use App\Http\Controllers\PengeluaranController;
use App\Http\Controllers\ProvinsiController;
use App\Http\Controllers\RtController;
use App\Http\Controllers\RWController;
use App\Http\Controllers\TagihanBulananController;
use App\Http\Controllers\TahunController;
use App\Http\Controllers\TataTertibController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WAController;
use App\Http\Controllers\WaGroupController;
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
// Route::get('/getUserBelumBayarTagihan', [TagihanBulananController::class, 'getUserBelumBayarTagihan']);


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



Route::post('/TransaksiPembayaranIuran', [PembayaranIuranController::class, 'TransaksiPembayaranIuran']);


Route::post('/buatAkunVia', [UserController::class, 'buatAkunVia']);
Route::get('/getAgama', [AgamaController::class, 'getAgama']);
Route::get('/getProvinsi', [ProvinsiController::class, 'getProvinsi']);
Route::get('/getAllDetailAlamat', [DetailAlamatController::class, 'getAllDetailAlamat']);
Route::get('/getallalamat', [AlamatController::class, 'getallalamat']);
Route::group(['middleware' => 'adminpusat'], function () {


});


Route::group(['middleware' => 'userlogin'], function () {
    Route::post('/createJenisIuran', [JenisIuranController::class, 'createJenisIuran']);
    Route::post('/updateJenisIuran', [JenisIuranController::class, 'updateJenisIuran']);
    Route::delete('/deleteJenisIuran/{id}', [JenisIuranController::class, 'deleteJenisIuran']);
    Route::post('/editUser', [UserController::class, 'editUser']);
    Route::post('/editUserbyid', [UserController::class, 'editUserbyid']);
    Route::get('/getallwargabyalamat', [UserController::class, 'getallwargabyalamat']);
    Route::get('/getUserLoginbyTahun', [TagihanBulananController::class, 'getUserLoginbyTahun']);
    Route::post('/tambahUserbyid', [UserController::class, 'tambahUserbyid']);
    Route::delete('/deleteUserbyid/{id}', [UserController::class, 'deleteUserbyid']);
});

Route::get('/getwhereizinBerizin/{group_data_id}', [WaGroupController::class, 'getwhereizinBerizin']);
Route::post('/createGroupData', [WaGroupController::class, 'createGroupData']);

Route::get('/getTataTertib', [TataTertibController::class, 'getTataTertib']);
Route::group(['middleware' => 'adminpusat'], function () {
    Route::post('/tambahTataTertib', [TataTertibController::class, 'tambahTataTertib']);
    Route::post('/updateTataTertib', [TataTertibController::class, 'updateTataTertib']);
    Route::delete('/deleteTataTertib/{tata_tertib_id}', [TataTertibController::class, 'deleteTataTertib']);
    Route::post('/tambahallalamat', [AlamatController::class, 'tambahallalamat']);
    Route::post('/updateAlamat', [AlamatController::class, 'updateAlamat']);
    Route::delete('/deleteAlamat/{id}', [AlamatController::class, 'deleteAlamat']);

    Route::post('/tambahDetailAlamat', [DetailAlamatController::class, 'tambahDetailAlamat']);
    Route::post('/updateDetailAlamat', [DetailAlamatController::class, 'updateDetailAlamat']);
    Route::delete('/deleteDetailAlamat/{id}', [DetailAlamatController::class, 'deleteDetailAlamat']);




    Route::get('/getRW', [RWController::class, 'getRW']);
    Route::delete('/deleteGroupData/{id}', [WaGroupController::class, 'deleteGroupData']);
    Route::get('/getQrCodeinUrl', [WAController::class, 'getQrCodeinUrl']);
    Route::post('/updateIzinGroupData', [WaGroupController::class, 'updateIzinGroupData']);
    Route::get('/getAllGroupData', [WaGroupController::class, 'getAllGroupData']);
    Route::post('/updateRW', [RWController::class, 'updateRW']);
    Route::get('/getAllRT', [RtController::class, 'getAllRT']);

    Route::post('/createNewYear', [TahunController::class, 'createNewYear']);
    Route::post('/updateTahun', [TahunController::class, 'updateTahun']);
    Route::delete('/deleteYear/{id}', [TahunController::class, 'deleteYear']);

    Route::get('/getADminRolesData', [AdminRWController::class, 'getADminRolesData']);
    Route::post('/tambahDataAdmin', [AdminRWController::class, 'tambahDataAdmin']);
    Route::get('/getAllDataAdmin/{search?}', [AdminRWController::class, 'getAllDataAdmin']);
    Route::post('/tambahDataAdmin', [AdminRWController::class, 'tambahDataAdmin']);
    Route::post('/changePasswordAdminControl', [AdminRWController::class, 'changePasswordAdminControl']);
    Route::delete('/deleteDataAdmiControl/{userId}', [AdminRWController::class, 'deleteDataAdmiControl']);
});
Route::group(['middleware' => 'admindata'], function () {
    Route::post('/createTagihanByUserIdIPL', [TagihanBulananController::class, 'createTagihanByUserIdIPL']);
    Route::post('/postMessageNotifIplUser', [WAController::class, 'postMessageNotifIplUser']);
    Route::get('/getAllJenisIurans', [JenisIuranController::class, 'getAllJenisIuransData']);
    Route::get('/getAllTahun', [TahunController::class, 'getAllTahun']);
    Route::get('/getAllBulan', [BulanController::class, 'getAllBulan']);
    Route::get('/getSumPengeluaranIuran/{rt_id?}', [PengeluaranController::class, 'getSumPengeluaranIuran']);
    Route::get('/getPengeluaranIuran/{rt_id?}', [PengeluaranController::class, 'getPengeluaranIuran']);
    Route::post('/tambahDataPengeluaran', [PengeluaranController::class, 'tambahDataPengeluaran']);
    Route::post('/updateDataPengeluaran', [PengeluaranController::class, 'updateDataPengeluaran']);
    Route::delete('/deleteDataPengeluaran/{id}', [PengeluaranController::class, 'deleteDataPengeluaran']);
    Route::get('/getSumPembayaranIuran/{rt_id?}', [PemasukanController::class, 'getSumPembayaranIuran']);
    Route::get('/getDataPembayaranIuran/{rt_id?}', [PemasukanController::class, 'getDataPembayaranIuran']);
    Route::get('/jumlahWargaAndTransaksiAndLaporan', [AdminController::class, 'jumlahWargaAndTransaksiAndLaporan']);
    Route::post('/storeUser', [AdminController::class, 'storeUser']);
    Route::get('/getDataAlamatByRt/{cookiesData}', [RtController::class, 'getDataAlamatByRt']);
    Route::get('/getDataDetailAlamatByRt/{alamat_id}', [RtController::class, 'getDataDetailAlamatByRt']);
    Route::get('/getAllUser', [AdminController::class, 'getAllUser']);
    Route::get('/getAllUserRt', [AdminController::class, 'getAllUserRt']);
    Route::get('/getAdminLogin', [AdminController::class, 'getAdminLogin']);
});
Route::get('/getAllTagihanUserbyTahun/{tahun_id?}', [TagihanBulananController::class, 'getAllTagihanUserbyTahun']);

// Route::get('/getDataAlamatByRt', [RtController::class, 'getDataAlamatByRt']);
