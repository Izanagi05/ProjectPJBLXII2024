<?php

namespace App\Http\Controllers;

use App\Models\Bulan;
use App\Models\JenisIuran;
use App\Models\TagihanBulanan;
use App\Models\Tahun;
use App\Models\User;
use Illuminate\Http\Request;

class JenisIuranController extends Controller
{
    public function getAllJenisIuran()
    {
        try {
            $data=JenisIuran::get();
            return response()->json([
                'data' => $data,
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
    public function createJenisIuran(Request $request)
    {


        try {
            if ($request->withtagihan === 'true') {
                $validatedData =     $request->validate([
                    'nama' => 'required|string',
                    'deskripsi' => 'required|string',
                    'jumlah' => 'required|numeric',
                    'tahun_id' => 'required|exists:tahuns,tahun_id',
                    'bulan_id' => 'required|exists:bulans,bulan_id',
                ]);
                $Tahun = Tahun::findOrFail($validatedData['tahun_id']);
                $jenisIuran = JenisIuran::create([
                    'nama' => $request->nama,
                    'deskripsi' => $request->deskripsi,
                    'jumlah' => $request->jumlah,
                ]);
                $users = User::where('role', 'User')->get();
                if ($request->semuabulan === 'true') {
                    $bulans = Bulan::get();
                    foreach ($users as $user) {
                        foreach ($bulans as $bulan) {
                            TagihanBulanan::create([
                                'user_id' => $user->user_id,
                                'tahun_id' => $Tahun->tahun_id,
                                'bulan_id' => $bulan->bulan_id,
                                'jenis_iuran_id' => $jenisIuran->jenis_iuran_id,
                                'status_pembayaran' => 'Belum Dibayar',
                            ]);
                        }
                    }
                }else{
                    $Bulan = Bulan::findOrFail($validatedData['bulan_id']);
                    foreach ($users as $user) {
                        $tagihan = TagihanBulanan::create([
                            'user_id' => $user->user_id,
                            'tahun_id' => $Tahun->tahun_id,
                            'bulan_id' => $Bulan->bulan_id,
                            'jenis_iuran_id' => $jenisIuran->jenis_iuran_id,
                        ]);
                    }
                }
            } else {
                $validatedData =     $request->validate([
                    'nama' => 'required|string',
                    'jumlah' => 'required|numeric',
                    'deskripsi' => 'required|string',
                ]);
                $jenisIuran = JenisIuran::create([
                    'nama' => $request->nama,
                    'deskripsi' => $request->deskripsi,
                    'jumlah' => $request->jumlah,
                ]);
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
    public function updateJenisIuran(Request $request)
    {
        try {
            $validateData = $request->validate([
                'nama' => 'required|string',
                'jumlah' => 'required|numeric',
                'tahun_id' => '',
                'bulan_id' => '',
            ]);
            $data = JenisIuran::findOrFail($request->jenis_iuran_id);
            $data->update($validateData);
            return response()->json([
                'data' => $data,
                'message' => 'Berhasil ubah ',
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
    public function deleteJenisIuran($id)
    {
        try {

            $data = JenisIuran::where('jenis_iuran_id', $id)->first();
            foreach ($data->TagihanBulanans as $key => $tagihanbulanan) {
                foreach ($tagihanbulanan->PembayaranIurans as $key => $pembayaranIuran) {
                    $pembayaranIuran->delete();
                }
                $tagihanbulanan->delete();
                # code...
            }
            $data->delete();
            return response()->json([
                'data' => $data,
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
