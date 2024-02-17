<?php

namespace App\Http\Controllers;

use App\Models\RW;
use Illuminate\Http\Request;

class RWController extends Controller
{
    public function getRW(){
        try {
            //code...
            $data=RW::get();
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
    public function updateRW(Request $request){
        try {
            $validateData = $request->validate([
                'nama' => 'required|string|max:255',
                'no' => 'required|string|max:255',
                'tanggal' => 'required',
                'kota' => 'required|string|max:255',
                'alamat' => 'required|string',
                'ketua_rw' => 'required|string|max:255',
                'wakil_rw' => 'required|string|max:255',
            ]);
            $data=RW::findOrFail($request->rw_id);
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
}
