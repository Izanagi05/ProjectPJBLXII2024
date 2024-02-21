<?php

namespace App\Http\Controllers;

use App\Models\Laporan;
use App\Models\User;
use Illuminate\Http\Request;

class LaporanController extends Controller
{
    public function createLaporan(Request $request){
        try{
            $authorizationHeader = $request->header('Authorization');
            $token = str_replace('Bearer ', '', $authorizationHeader);
            $data = User::where('remember_token', $token)->first();
            $validateData= $request->validate([
            'user_id' => 'numeric|exists:users,user_id',
            'keperluan'=>'required|string|max:255'
        ]);
        $validateData['user_id']= $data->user_id;
        if(!$validateData){
            return response()->json([
                'data' => null,
                'message' => 'Data tidak lengkap',
                'success' => false
            ], 500);
        }
        $data=Laporan::create($validateData);
        return response()->json([
            'data' => $data,
            'message' => 'Berhasil',
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
    public function updateLaporan(Request $request){
        try{
        $validateData= $request->validate([
            'keperluan'=>'required|string|max:255'
        ]);

        if(!$validateData){
            return response()->json([
                'data' => null,
                'message' => 'Data tidak lengkap',
                'success' => false
            ], 500);
        }
        $data=Laporan::where('laporan_id',$request->laporan_id);
        $data->update($validateData);
        $dataupdate=Laporan::where('laporan_id',$request->laporan_id)->first();
        return response()->json([
            'data' => $dataupdate,
            'message' => 'Berhasil',
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
    public function allLaporan(Request $request){
        try{
            $authorizationHeader = $request->header('Authorization');
            $token = str_replace('Bearer ', '', $authorizationHeader);
            $data = User::where('remember_token', $token)->first();
            $data->UserLaporans;
        return response()->json([
            'data' => $data,
            'message' => 'Berhasil',
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
    public function deleteLaporan($id){
        try{
          $data= Laporan::where('laporan_id', $id);
          $data->delete();
        return response()->json([
            'data' => $data,
            'message' => 'Berhasil',
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
