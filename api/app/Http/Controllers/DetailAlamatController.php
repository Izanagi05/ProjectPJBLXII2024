<?php

namespace App\Http\Controllers;

use App\Models\Alamat;
use App\Models\DetailAlamat;
use Illuminate\Http\Request;

class DetailAlamatController extends Controller
{
    public function tambahDetailAlamat(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'nama' => 'required|string',
                'alamat_id' => 'required|exists:alamats,alamat_id',
            ]);
            $dataAlamat = Alamat::where('alamat_id', $validatedData['rt_id'])->first();
            $detailAlamat = DetailAlamat::create([
                    'nama' => $validatedData['nama'],
                    'alamat_id' => $dataAlamat->alamat_id
                ]);

            return response()->json([
                'data' => $detailAlamat,
                'message' => 'Berhasil menambahkan detail alamat',
                'success' => true
            ], 201);
        } catch (\Throwable $th) {
            return response()->json([
                'data' => null,
                'message' => 'Terjadi kesalahan: ' . $th->getMessage(),
                'success' => false
            ], 500);
        }
    }

    public function updateDetailAlamat(Request $request, $id)
    {
        try {
            $validatedData = $request->validate([
                'nama' => 'required|string',
                'alamat_id' => 'required|exists:alamats,alamat_id',
            ]);

            // Mencari detail alamat berdasarkan ID
            $detailAlamat = DetailAlamat::findOrFail($id);
            $dataAlamat = Alamat::where('alamat_id', $validatedData['rt_id'])->first();

            // Memperbarui data detail alamat
            $detailAlamat->update([
                'nama' => $validatedData['nama'],
                'alamat_id' => $dataAlamat->alamat_id
            ]);

            return response()->json([
                'data' => $detailAlamat,
                'message' => 'Berhasil memperbarui detail alamat',
                'success' => true
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'data' => null,
                'message' => 'Terjadi kesalahan: ' . $th->getMessage(),
                'success' => false
            ], 500);
        }
    }

    public function deleteDetailAlamat($id)
    {
        try {
            // Mencari detail alamat berdasarkan ID
            $detailAlamat = DetailAlamat::findOrFail($id);

            // Menghapus detail alamat
            $detailAlamat->delete();

            return response()->json([
                'data' => null,
                'message' => 'Berhasil menghapus detail alamat',
                'success' => true
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'data' => null,
                'message' => 'Terjadi kesalahan: ' . $th->getMessage(),
                'success' => false
            ], 500);
        }
    }
}
