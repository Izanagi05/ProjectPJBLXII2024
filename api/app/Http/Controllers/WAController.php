<?php

namespace App\Http\Controllers;

use App\Models\TagihanBulanan;
use App\Models\Tahun;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use GuzzleHttp\Client;
use PhpParser\Node\Stmt\Foreach_;

class WAController extends Controller
{
    public function postMessageCustomToGroup(Request $request)
    {
        try {
            $to = $request->to;
            $message = $request->message;
            $data = [
                'to' => $to,
                'message' => $message
            ];
            $client = new Client();
            $response = Http::post('http://localhost:6700/incoming-message', [
                'to' => $to,
                'message' => $message
            ]);
            return response()->json([
                'data' => $response,
                'message' => 'Berhasil',
                'success' => true
            ], 201);
        } catch (\Throwable $th) {
            //throw $th;
            return response()->json([
                'data' => null,
                'message' => 'Terjadi kesalahan: ' . $th,
                'success' => false
            ], 500);
        }
    }
    public function postMessageNotifIplUser(Request $request)
    {
        try {
            $validatedData =     $request->validate([
                'tahun_id' => 'required|exists:tahuns,tahun_id',
                'bulan_id' => 'required|exists:bulans,bulan_id',
                'user_id' => 'required|exists:users,user_id',
                'jenis_iuran_id' => 'required|exists:jenis_iurans,jenis_iuran_id',
            ]);
            $dataUser = User::where('user_id', $validatedData['user_id'])->first();
            $tagihan = $dataUser->TagihanBulanans->where(
                'tahun_id',
                $validatedData['tahun_id']
            )->where(
                'bulan_id',
                $validatedData['bulan_id']
            )->where(
                'jenis_iuran_id',
                $validatedData['jenis_iuran_id']
            )->first();

            //    echo $dataUser;
            if (!$tagihan) {
                return response()->json([
                    'data' => null,
                    'message' => 'Tagihan tidak ditemukan untuk pengguna ini',
                    'success' => false
                ], 404);
            }
            $to = $dataUser->no_telp;
            // $message = [
            //     'nama' => $dataUser->nama,
            //     'bulan' => $tagihan->Bulan->nama,
            //     'jenis_iuran' => $tagihan->JenisIuran->nama,
            //     'jumlah' => $tagihan->JenisIuran->jumlah

            // ];
            $message = 'Warga yang terhormat ' . $dataUser->nama .
                "\n\nMohon segera membayar tagihan bulan " . $tagihan->Bulan->nama . " Tahun ".$tagihan->Tahun->tahun.
                "\njenis iuran " . $tagihan->JenisIuran->nama .
                "\nSebesar Rp. " . $tagihan->JenisIuran->jumlah .
                "\nTerima Kasih";

            $data = [
                'to' => $to,
                'message' => $message
            ];
            $client = new Client();
            $response = Http::post('http://localhost:6700/iplnotif-message', [
                'to' => $to,
                'message' => $message
            ]);
            return response()->json([
                'data' => $response,
                'message' => 'Berhasil',
                'success' => true
            ], 201);
        } catch (\Throwable $th) {
            //throw $th;
            return response()->json([
                'data' => null,
                'message' => 'Terjadi kesalahan: ' . $th,
                'success' => false
            ], 500);
        }
    }
    public function getQrCodeinUrl(Request $request)
    {
        try {
            $response = Http::get('http://localhost:6700/qr');

            // Tangkap URL gambar QR code dari respons
            $qrCodeUrl = $response->body();
            return response()->json([
                'data' => $qrCodeUrl,
                'message' => 'Berhasil',
                'success' => true
            ], 201);
        } catch (\Throwable $th) {
            //throw $th;
            return response()->json([
                'data' => null,
                'message' => 'Terjadi kesalahan: ' . $th,
                'success' => false
            ], 500);
        }
    }
    public function getUserProfilById($no_telp)
    {
        try {
            $requestNoTelp = substr($no_telp, 0, -5);
            $data = User::where('no_telp', $requestNoTelp)->first();
            $dataProfil = [
                'nama' => $data->nama ?? 'Belum di set',
                'nik' => $data->nik ?? 'Belum di set',
                'no_kk' => $data->no_kk ?? 'Belum di set',
                'tempat_tanggal_lahir' => $data->UserProvinsi->provinsi ?? 'Belum di set' . ', ' . $data->tgl_lahir ?? 'Belum di set',
                'pekerjaan' => $data->pekerjaan ?? 'Belum di set',
                'status_berktp' => $data->status_berktp ?? 'Belum di set',
                'hubungan' => $data->hubungan ?? 'Belum di set',
                'status_perkawinan' => $data->status_perkawina ?? 'Belum di set',
                'agama' => $data->Agama->nama ?? 'Belum di set'
            ];

            return response()->json([
                'data' => $dataProfil,
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
    public function getDataIPL($no_telp)
    {
        try {
            $requestNoTelp = substr($no_telp, 0, -5);
            // dd($no_telp);
            $dataUser = User::where('no_telp', $requestNoTelp)->first();
            // echo $dataUser
            // dd($requestNoTelp);
            $dataTahuns = Tahun::get();
            $addedYears = [];
            $bulanPerTahun = [];

            foreach ($dataUser->TagihanBulanans as $key => $userTagihan) {
                $dataIPL[] = [
                    'tahun' => $userTagihan->Tahun->tahun,
                    'bulan' => $userTagihan->Bulan->nama,
                    'jenis_iuran' => $userTagihan->JenisIuran->nama,
                    'sebesar' => 'Rp.' . substr($userTagihan->JenisIuran->jumlah, 0, -3),
                    'status_pembayaran' => $userTagihan->status_pembayaran === 'Lunas' ? '*' . $userTagihan->status_pembayaran . '*' : $userTagihan->status_pembayaran,
                ];
            }

            return response()->json([
                'data' => $dataIPL,
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
