<?php

namespace App\Http\Controllers;

use App\Models\Bulan;
use App\Models\JenisIuran;
use App\Models\TagihanBulanan;
use App\Models\Tahun;
use App\Models\User;
use Illuminate\Http\Request;

class TahunController extends Controller
{
    public function getAllTahun()
    {
        try {
            $data=Tahun::get();
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
    public function createNewYear(Request $request)
    {
        try {

            if ($request->yearwithtagihan === 'true') {
                // dd('atas');
                $validatedData = $request->validate([
                    'tahun' => 'required|numeric',
                    'jenis_iuran_id' => 'required|numeric',
                ]);
                $jenisIuran = JenisIuran::findOrFail($validatedData['jenis_iuran_id']);
                $newYear = Tahun::create([
                    'tahun' => $validatedData['tahun'],
                ]);
                $users = User::where('role', 'User')->get();
                $bulans = Bulan::get();

                foreach ($users as $user) {
                    foreach ($bulans as $bulan) {
                        TagihanBulanan::create([
                            'user_id' => $user->user_id,
                            'tahun_id' => $newYear->tahun_id,
                            'bulan_id' => $bulan->bulan_id,
                            'jenis_iuran_id' => $jenisIuran->jenis_iuran_id,
                            'status_pembayaran' => 'Belum Dibayar',
                        ]);
                    }
                }
            } else {
                // dd('bh');
                $validatedData = $request->validate([
                    'tahun' => 'required|numeric',
                ]);
                $newYear = Tahun::create([
                    'tahun' => $validatedData['tahun'],
                ]);
            }

            return response()->json([
                'data' => $newYear,
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
    public function updateTahun(Request $request)
    {
        try {
            $validateData = $request->validate([
                'tahun' => 'required',
            ]);
            $data = Tahun::findOrFail($request->tahun_id);
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
    public function deleteYear($id)
    {
        try {

            $data = Tahun::where('tahun_id', $id)->first();
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
