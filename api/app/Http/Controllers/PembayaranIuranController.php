<?php

namespace App\Http\Controllers;

use App\Models\PembayaranIuran;
use App\Models\TagihanBulanan;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PembayaranIuranController extends Controller
{
    public function TransaksiPembayaranIuran(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'tagihan_bulanan_id' => 'required|exists:tagihan_bulanans,tagihan_bulanan_id',
                'user_id' => 'required|numeric|exists:users,user_id',
                'rt_id' => '',
                'jenis_iuran_id' => '',
                'tanggal_pembayaran' => '',
                'jumlah_pembayaran' => 'required|numeric|min:0',
            ]);
            $authorizationHeader = $request->header('Authorization');
            $token = str_replace('Bearer ', '', $authorizationHeader);
            $data = User::where('remember_token', $token)->where('role', 'Admin')
                ->first();
            $data->provinsi = $data->UserProvinsi->provinsi;
            $data->admin_data_role = $data->AdminData->AdminRole;
            // $data->user_alamats = $data->AdminData->AdminRole;
            unset($data->AdminData);
            unset($data->UserProvinsi);
            // echo  $validatedData['rt_id'];
            $TagihanBulanan = TagihanBulanan::where('user_id',  $validatedData['user_id'])->where('tagihan_bulanan_id',  $validatedData['tagihan_bulanan_id']);
            if ($TagihanBulanan->first()->status_pembayaran === 'Lunas') {
                return response()->json([
                    'data' => 'Success',
                    'message' => 'Tagihan ini sudah lunas',
                    'success' => true
                ], 201);
            }
            if ($validatedData['jumlah_pembayaran'] . '.00' === $TagihanBulanan->first()->JenisIuran->jumlah) {
                $validatedData['rt_id']= $data->admin_data_role->rt_id;
                $validatedData['tanggal_pembayaran'] = Carbon::now()->toDateString();
                $validatedData['jenis_iuran_id'] =    $TagihanBulanan->first()->JenisIuran->jenis_iuran_id;
                $TransaksiIuran =  PembayaranIuran::create([
                    'tagihan_bulanan_id' => $validatedData['tagihan_bulanan_id'],
                    'jenis_iuran_id' => $validatedData['jenis_iuran_id'],
                    'user_id' => $validatedData['user_id'],
                    'tanggal_pembayaran' => $validatedData['tanggal_pembayaran'],
                    'rt_id' => $validatedData['rt_id'],
                    'jumlah_pembayaran' => $validatedData['jumlah_pembayaran'],
                ]);
                $statusLunas = 'Lunas';
                $TagihanBulanan->update([
                    'status_pembayaran' => $statusLunas
                ]);
            }

            return response()->json([
                'data' => $TransaksiIuran ?? null,
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
