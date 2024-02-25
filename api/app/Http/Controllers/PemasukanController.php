<?php

namespace App\Http\Controllers;

use App\Models\PembayaranIuran;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PemasukanController extends Controller
{
    public function getSumPembayaranIuran(Request $request, $rt_id=null)
    {
        try {

            $tahunSekarang = Carbon::now()->year;
            if($rt_id ==='Admin'){

                $authorizationHeader = $request->header('Authorization');
                $token = str_replace('Bearer ', '', $authorizationHeader);
                $data = User::where('remember_token', $token)->where('role', 'Admin')
                ->first();
                $data->provinsi = $data->UserProvinsi->provinsi;
                $data->admin_data_role = $data->AdminData->AdminRole;
                // $data->user_alamats = $data->AdminData->AdminRole;
                unset($data->AdminData);
                unset($data->UserProvinsi);
                $datamasuk=PembayaranIuran::where('rt_id',   $data->admin_data_role->rt_id)->whereYear('tanggal_pembayaran', $tahunSekarang)->get()->sum('jumlah_pembayaran');
            }else{
                $datamasuk=PembayaranIuran::whereYear('tanggal_pembayaran', $tahunSekarang)->get()->sum('jumlah_pembayaran');
            }
            return response()->json([
                'data' => $datamasuk,
                'message' => 'berhasil',
                'success' => true
            ], 201);
        } catch (\Throwable $th) {
            return response()->json([
                'data' => null,
                'message' => 'Terjadi kesalahan: ' . $th,
                'success' => false
            ], 500);
        }
    }
    public function getDataPembayaranIuran(Request $request, $rt_id=null)
    {
        try {
            $tahunSekarang = Carbon::now()->year;
            if($rt_id ==='Admin'){
                $authorizationHeader = $request->header('Authorization');
                $token = str_replace('Bearer ', '', $authorizationHeader);
                $data = User::where('remember_token', $token)->where('role', 'Admin')->first();
                $data->provinsi = $data->UserProvinsi->provinsi;
                $data->admin_data_role = $data->AdminData->AdminRole;
                // $data->user_alamats = $data->AdminData->AdminRole;
                unset($data->AdminData);
                unset($data->UserProvinsi);
                $datamasuk=PembayaranIuran::where('rt_id',   $data->admin_data_role->rt_id)->whereYear('tanggal_pembayaran', $tahunSekarang)->get();
                foreach ($datamasuk as $key => $dt) {
                    # code...
                    $dt->JenisIuran;
                }

            }else{
                $datamasuk=PembayaranIuran::whereYear('tanggal_pembayaran', $tahunSekarang)->get();
                foreach ($datamasuk as $key => $dt) {
                    # code...
                    $dt->JenisIuran;
                }
                 }
            return response()->json([
                'data' => $datamasuk,
                'message' => 'berhasil',
                'success' => true
            ], 201);
        } catch (\Throwable $th) {
            return response()->json([
                'data' => null,
                'message' => 'Terjadi kesalahan: ' . $th,
                'success' => false
            ], 500);
        }
    }
}
