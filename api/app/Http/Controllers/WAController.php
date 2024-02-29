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
            $to = $request->to; // Get the recipient number from the request
            $message = $request->message; // Get the message from the request

            // Data yang akan dikirimkan dalam format JSON
            $data = [
                'to' => $to,
                'message' => $message
            ];

            // Membuat permintaan HTTP POST dengan badan permintaan raw
            $client = new Client();
            // $response = $client->request('POST', 'http://localhost:3000/incoming-message', [
            //     'json' => [
            //         'to' => $to,
            //         'message' =>$message,
            //     ]
            // ]);
            $response = Http::post('http://localhost:6700/incoming-message', [
                'to' => $to,
                'message' => $message
                // Add other data as needed
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
