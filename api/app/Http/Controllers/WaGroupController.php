<?php

namespace App\Http\Controllers;

use App\Models\Tahun;
use App\Models\WaGroup;
use Illuminate\Http\Request;

class WaGroupController extends Controller
{
    public function getwhereizinBerizin($group_data_id)
    {
        try {

            $data=WaGroup::where('group_data_id', $group_data_id)->first();
            if($data){

                if($data->izin==='Berizin'){
                return response()->json([
                    'data' => $data,
                    'status'=>'Berizin',
                    'message' => 'berhasil',
                    'success' => true
                ], 201);
            }else{
                return response()->json([
                    'data' => null,
                    'status'=>'Tidak Berizin',
                    'message' => 'berhasil',
                    'success' => false
                ], 201);
            }
        }else{
            return response()->json([
                'data' => null,
                'status'=>'Data tidak ada',
                'message' => 'berhasil',
                'success' => false
            ], 201);

        }
        } catch (\Throwable $th) {
            return response()->json([
                'data' => null,
                'message' => 'Terjadi kesalahan: ' . $th,
            'success' => false
            ], 500);
        }
    }
    public function createGroupData(Request $request)
    {
        try {
            $validatedData=$request->validate([
                'rt_id'=>'',
                'group_data_id'=>'required|string|max:100',
                'group_nama'=>'required|string|max:100',
                'izin'=>''
            ]);
            if($validatedData){
                if ($validatedData) {
                    $existingData = WaGroup::where('group_data_id', $validatedData['group_data_id'])->first();
                    if ($existingData) {
                        return response()->json([
                            'data' => null,
                            'message' => 'Group data ID sudah ada',
                            'success' => false
                        ], 409);
                    }
                $data=WaGroup::create($validatedData);
            }
        }
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
    public function updateIzinGroupData(Request $request)
    {
        try {
            $validatedData=$request->validate([
                'izin'=>'required',
                'rt_id'=>''
            ]);
            $data=WaGroup::where('wa_group_id', $request->wa_group_id)->first();
            if($validatedData && $validatedData['izin']==='Berizin'){
                $data->update([
                    'izin'=>$validatedData['izin'],
                    'rt_id'=>$validatedData['rt_id'],
                ]);
            }else{
                return response()->json([
                    'data' => null,
                    'message' => 'Terjadi kesalahan atau status belum berizin',
                    'success' => false
                ], 500);
            }
                return response()->json([
                'data' => $data,
                'data_detail' => $data,
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
    public function getAllGroupData()
    {
        try {
          $data=WaGroup::get();
          foreach ($data as $key => $dt) {
            # code...
            $dt->RT;
          }
                return response()->json([
                'data' => $data,
                'data_detail' => $data,
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
    public function deleteGroupData($id)
    {
        try {
          $data=WaGroup::where('wa_group_id', $id)->first();
          $data->delete();
                return response()->json([
                'data' => $data,
                'data_detail' => $data,
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
