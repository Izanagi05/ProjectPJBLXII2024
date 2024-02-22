<?php

namespace App\Http\Controllers;

use App\Models\PembayaranIuran;
use App\Models\TagihanBulanan;
use App\Models\User;
use Illuminate\Http\Request;

class PembayaranIuranController extends Controller
{
    public function TransaksiPembayaranIuran(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'tagihan_bulanan_id' => 'required|exists:tagihan_bulanans,tagihan_bulanan_id',
                'user_id' => 'required|numeric|exists:users,user_id',
                'tanggal_pembayaran' => 'required',
                'jumlah_pembayaran' => 'required|numeric',
            ]);
            $TagihanBulanan = TagihanBulanan::where('user_id',  $validatedData['user_id'])->where('tagihan_bulanan_id',  $validatedData['tagihan_bulanan_id']);
            if($TagihanBulanan->first()->status_pembayaran ==='Lunas'){
                return response()->json([
                    'data' => 'Success',
                    'message' => 'Tagihan ini sudah lunas',
                    'success' => true
                ], 201);
            }
            if ( $validatedData['jumlah_pembayaran'] . '.00' === $TagihanBulanan->first()->JenisIuran->jumlah) {
                $TransaksiIuran =  PembayaranIuran::create([
                    'tagihan_bulanan_id' => $validatedData['tagihan_bulanan_id'],
                    'user_id' => $validatedData['user_id'],
                    'tanggal_pembayaran' => $validatedData['tanggal_pembayaran'],
                    'jumlah_pembayaran' => $validatedData['jumlah_pembayaran'],
                ]);
                    $statusLunas = 'Lunas';
                    $TagihanBulanan->update([
                        'status_pembayaran' => $statusLunas
                    ]);
                }

            return response()->json([
                'data' => $TransaksiIuran,
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
