<?php

namespace App\Http\Controllers;

use App\Models\Alamat;
use App\Models\Rt;
use Illuminate\Http\Request;

class AlamatController extends Controller
{
    public function getallalamat()
    {
        try {
            $datas = Alamat::get();
            foreach ($datas as $key => $data) {
                # code...
                $data->DetailAlamats;
            }
            return response()->json([
                'data' => $datas,
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
    public function tambahallalamat(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'nama' => 'required|string',
                'rt_id' => 'required|numeric|exists:rts,rt_id',
            ]);
            $dataRt = Rt::where('rt_id', $validatedData['rt_id'])->first();
            // Membuat alamat baru
            $alamat = Alamat::create([
                'nama' => $validatedData['nama'],
                'rt_id' => $dataRt->rt_id
            ]);

            return response()->json([
                'data' => $alamat,
                'message' => 'Berhasil menambahkan alamat',
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

    public function updateAlamat(Request $request, $id)
    {
        try {
            $validatedData = $request->validate([
                'nama' => 'required|string',
                'rt_id' => 'required|numeric|exists:rts,rt_id',
            ]);
            $alamat = Alamat::findOrFail($id);
            $dataRt = Rt::where('rt_id', $validatedData['rt_id'])->first();
            $alamat->update([
                'nama' => $validatedData['nama'],
                'rt_id' => $dataRt->rt_id
            ]);
            return response()->json([
                'data' => $alamat,
                'message' => 'Berhasil memperbarui alamat',
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

    public function deleteAlamat($id)
    {
        try {
            $alamat = Alamat::findOrFail($id);
            foreach ($alamat as $key => $dt) {
                $dt->DetailAlamats->delete();
            }
            $alamat->delete();
            return response()->json([
                'data' => null,
                'message' => 'Berhasil menghapus alamat',
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
