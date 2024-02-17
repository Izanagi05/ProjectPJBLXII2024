<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AgamaController;
use App\Http\Controllers\AlamatController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PdfController;
use App\Http\Controllers\ProvinsiController;
use App\Http\Controllers\RtController;
use App\Http\Controllers\UserController;
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
Route::get('/getUserLogin', [UserController::class, 'getUserLogin']);
Route::get('/home', [PdfController::class, 'exportPDF']);

Route::post('/register', [LoginController::class, 'register']);
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout']);

Route::post('/storeRT', [RtController::class, 'storeRT']);
Route::post('/updateRT', [RtController::class, 'updateRT']);
Route::delete('/deleteRT/{id}', [RtController::class, 'deleteRT']);

Route::post('/buatAkunVia', [UserController::class, 'buatAkunVia']);
Route::post('/editUser', [UserController::class, 'editUser']);

Route::get('/getAgama', [AgamaController::class, 'getAgama']);

Route::get('/getProvinsi', [ProvinsiController::class, 'getProvinsi']);

Route::get('/getallalamat', [AlamatController::class, 'getallalamat']);

Route::post('/storeUser', [AdminController::class, 'storeUser']);
