<?php

namespace App\Http\Controllers;

use App\Models\Alamat;
use App\Models\DetailAlamat;
use Illuminate\Http\Request;

class DetailAlamatController extends Controller
{
    public function getAllDetailAlamat(Request $request)
    {
        try {
            // orderBy('created_at', 'desc')
            $data=DetailAlamat::get();
            foreach ($data as $key => $dt) {
                $dt->Alamat;
            }

            return response()->json([
                'data' => $data,
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
    public function tambahDetailAlamat(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'nama' => 'required|string',
                'alamat_id' => 'required|exists:alamats,alamat_id',
            ]);
            $dataAlamat = Alamat::where('alamat_id', $validatedData['alamat_id'])->first();
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
    public function updateDetailAlamat(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'nama' => 'required|string',
                'alamat_id' => 'required|exists:alamats,alamat_id',
            ]);
            $detailAlamat = DetailAlamat::findOrFail($request->detail_alamat_id);
            $dataAlamat = Alamat::where('alamat_id', $validatedData['alamat_id'])->first();
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
                'data' => $dataAlamat,
                'message' => 'Terjadi kesalahan: ' . $th->getMessage(),
                'success' => false
            ], 500);
        }
    }

    public function deleteDetailAlamat($id)
    {
        try {
            $detailAlamat = DetailAlamat::where('alamat_id', $id)->first();
            foreach ($detailAlamat->UserAlamats as $key => $dtuseralamat) {
                $dtuseralamat->delete();
            }
            $detailAlamat->delete();

            return response()->json([
                'data' => $detailAlamat,
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
