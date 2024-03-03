<?php

namespace App\Http\Controllers;

use App\Models\Bulan;
use App\Models\JenisIuran;
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
            if(!$tahunNama){
                $tahunNama = $tahunSekarang;
            }
            $tahun= Tahun::where('tahun', $tahunNama)->first();
            $userAllTagihanByTahun = User::where('role', 'User')->whereHas('UserAlamats', function ($query2) use($data){
                $query2->whereHas('Alamat', function ($query3)use($data){
                    $query3->where('rt_id',  $data->admin_data_role->rt_id);
                });
            } )->with(['TagihanBulanans' => function ($query) use ($tahun) {
                $query->where('tahun_id', $tahun->tahun_id)->orderBy('bulan_id', 'asc');;
            }])->get();

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
    public function getUserLoginbyTahun(Request $request, $tahunNama=null){
        try {
            $tahunSekarang = Carbon::now()->year;
            $authorizationHeader = $request->header('Authorization');
            $token = str_replace('Bearer ', '', $authorizationHeader);
            $data = User::where('remember_token', $token)->where('role', 'User')
                ->first();
            if(!$tahunNama){
                $tahunNama = $tahunSekarang;
            }
            $tahun= Tahun::where('tahun', $tahunNama)->first();
                $data->TagihanBulanans;
                foreach ($data->TagihanBulanans as $key => $jenisiuran) {
                    $jenisiuran->JenisIuran;
                    $jenisiuran->Bulan;
                    $jenisiuran->Tahun;
                }
            return response()->json([
                'data' => $data,
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
    public function createTagihanByUserIdIPL(Request $request){
        try {
            if ($request->withtagihan === 'true') {
                $validatedData =     $request->validate([
                    'nama' => 'required|string',
                    'deskripsi' => 'required|string',
                    'jumlah' => 'required|numeric|min:0',
                    'tahun_id' => 'required|exists:tahuns,tahun_id',
                    'bulan_id' => 'required|exists:bulans,bulan_id',
                    'user_id' => 'required|exists:users,user_id',
                    'jenis_iuran_id' => 'required|exists:jenis_iurans,jenis_iuran_id',
                ]);
                $Tahun = Tahun::findOrFail($validatedData['tahun_id']);
                $jenisIuran=JenisIuran::where('jenis_iuran_id', $validatedData['jenis_iuran_id'])->first();
                $user = User::where('role', 'User')->where('user_id', $validatedData['user_id'])->first();
                if ($request->semuabulan === 'true') {
                    $bulans = Bulan::get();
                        foreach ($bulans as $bulan) {
                            TagihanBulanan::create([
                                'user_id' => $user->user_id,
                                'tahun_id' => $Tahun->tahun_id,
                                'bulan_id' => $bulan->bulan_id,
                                'jenis_iuran_id' => $jenisIuran->jenis_iuran_id,
                                'status_pembayaran' => 'Belum Dibayar',
                            ]);

                    }
                }else{
                    $Bulan = Bulan::findOrFail($validatedData['bulan_id']);
                        $tagihan = TagihanBulanan::create([
                            'user_id' => $user->user_id,
                            'tahun_id' => $Tahun->tahun_id,
                            'bulan_id' => $Bulan->bulan_id,
                            'jenis_iuran_id' => $jenisIuran->jenis_iuran_id,
                        ]);

                }
            }

            return response()->json([
                'data' => $jenisIuran,
                'message' => 'data user login',
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
