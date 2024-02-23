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
    public function getAllTagihanUserbyTahun($tahunNama=null){
        try {
            $tahunSekarang = Carbon::now()->year;
            // dd($tahunSekarang);

            // Set nilai default untuk $tahunNama jika tidak diberikan
            if(!$tahunNama){
                $tahunNama = $tahunSekarang;
            }
            $tahun= Tahun::where('tahun', $tahunNama)->first();
            // dd($tahun->tahun_id);
            $userAllTagihanByTahun = User::with(['TagihanBulanans' => function ($query) use ($tahun) {
                $query->where('tahun_id', $tahun->tahun_id);
            }])->get();

            foreach ($userAllTagihanByTahun as $key => $dt) {
                // Di sini Anda dapat mengakses tagihan bulanan untuk tahun tertentu
               $dt->TagihanBulanans;
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
