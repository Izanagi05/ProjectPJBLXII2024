<?php

namespace App\Http\Controllers;

use App\Models\TataTertib;
use Illuminate\Http\Request;

class TataTertibController extends Controller
{
    public function getTataTertib(){
        try {

            $data=TataTertib::get();

            return response()->json([
                'data' => $data,
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

    public function  tambahTataTertib(Request $request){
        try {
            $validatedData = $request->validate([
                'judul' => 'required|string',
                'deskripsi' => 'required|string'
            ]);
            $data=TataTertib::create($validatedData);
            return response()->json([
                'data' => $data,
                'message' => 'Tata tertib berhasil diperbarui',
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
    public function updateTataTertib(Request $request){
        try {
            $validatedData = $request->validate([
                'judul' => 'required|string',
                'deskripsi' => 'required|string'
            ]);
            $dataupdate=TataTertib::where('tata_tertib_id', $request->tata_tertib_id)->first();
            $dataupdate->update($validatedData);
            return response()->json([
                'data' => $dataupdate,
                'message' => 'Tata tertib berhasil diperbarui',
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

    public function deleteTataTertib($tata_tertib_id){
        try {
            $data=TataTertib::where('tata_tertib_id', $tata_tertib_id)->first();
            $data->delete();
            return response()->json([
                'data' => null,
                'message' => 'Tata tertib berhasil dihapus',
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
