<?php

namespace App\Http\Controllers;

use App\Models\TagihanBulanan;
use App\Models\Tahun;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class TagihanBulananController extends Controller
{
    public function getTagihanallUser(Request $request){
        try {

            $users=User::where('role', 'User')->get();
            foreach ($users as $key => $user) {
                foreach ($user->TagihanBulanans as $key => $tagihanBulananUser) {
                    $tagihanBulananUser->PembayaranIurans;
                    # code...
                }
            }
            return response()->json([
                'data' => $users,
                'message' => 'Berhasil get ',
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
    public function getUserBelumBayarTagihan(){
        try {

            $tahunSekarang = date('Y');
            $bulanSekarang = date('n');

            // Menampilkan data pengguna yang belum membayar tagihan untuk bulan ini
            $usersBelumBayar = User::whereHas('TagihanBulanans', function($query) use ($tahunSekarang, $bulanSekarang) {
                $query->where('tahun_id',2027)
                      ->where('bulan_id', 2)
                      ->where('status_pembayaran', 'Lunas');
            })->orWhereDoesntHave('TagihanBulanans')->get();
            return response()->json([
                'data' => $usersBelumBayar,
                'message' => 'Berhasil get ',
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
    public function getAllTagihanUserbyTahun(Request $request, $tahunNama=null){
        try {
            $tahunSekarang = Carbon::now()->year;
            $authorizationHeader = $request->header('Authorization');
            $token = str_replace('Bearer ', '', $authorizationHeader);
            $data = User::where('remember_token', $token)->where('role', 'Admin')
                ->first();
            $data->provinsi = $data->UserProvinsi->provinsi;
            $data->admin_data_role = $data->AdminData->AdminRole;
            // $data->user_alamats = $data->AdminData->AdminRole;
            unset($data->AdminData);
            unset($data->UserProvinsi);
            // dd($tahunSekarang);

            // Set nilai default untuk $tahunNama jika tidak diberikan
            if(!$tahunNama){
                $tahunNama = $tahunSekarang;
            }
            $tahun= Tahun::where('tahun', $tahunNama)->first();
            // dd($tahun->tahun_id);
            $userAllTagihanByTahun = User::where('role', 'User')->whereHas('UserAlamats', function ($query2) use($data){
                $query2->whereHas('Alamat', function ($query3)use($data){
                    $query3->where('rt_id',  $data->admin_data_role->rt_id);
                });
            } )->with(['TagihanBulanans' => function ($query) use ($tahun) {
                $query->where('tahun_id', $tahun->tahun_id)->orderBy('bulan_id', 'asc');;
            }])->get();
            // $userAllTagihanByTahun = User::with(['TagihanBulanans' => function ($query) use ($tahun) {
            //     $query->where('tahun_id', $tahun->tahun_id)->orderBy('bulan_id', 'asc');;
            // }])->get();

            foreach ($userAllTagihanByTahun as $key => $dt) {
                // Di sini Anda dapat mengakses tagihan bulanan untuk tahun tertentu
                $dt->TagihanBulanans;
                foreach ($dt->TagihanBulanans as $key => $jenisiuran) {
                    $jenisiuran->JenisIuran;
                    $jenisiuran->Bulan;
                    $jenisiuran->Tahun;
                }
                // Lakukan sesuatu dengan $tagihanBulanansTahunIni...
            }
            // $userAllTagihanByTahun= TagihanBulanan::where('tahun_id', $tahun->tahun_id)->get();

            return response()->json([
                'data' => $userAllTagihanByTahun,
                'message' => 'Berhasil get ',
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
