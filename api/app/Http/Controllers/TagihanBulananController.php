<?php

namespace App\Http\Controllers;

use App\Models\User;
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
    public function getAllTagihanUserbyTahun(){
        try {



            return response()->json([
                'data' => $$userAllTagihanByTahun,
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
