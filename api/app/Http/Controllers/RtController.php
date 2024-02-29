<?php

namespace App\Http\Controllers;

use App\Models\AdminRole;
use App\Models\Alamat;
use App\Models\DetailAlamat;
use App\Models\Rt;
use App\Models\User;
use Illuminate\Http\Request;

class RtController extends Controller
{
    public function getAllWargaRT($rt_id = null)
    {
        try {

            $data = Rt::where('rt_id', 2)->first();
            foreach ($data->Alamats as $key => $dtalamat) {
                $dtalamat->Users;
            }

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
    public function getAllRT()
    {
        try {

            $data = Rt::get();

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
    public function getDataAlamatByRt(Request $request)
    {
        try {
            $authorizationHeader = $request->header('Authorization');
            $token = str_replace('Bearer ', '', $authorizationHeader);
            $data = User::where('remember_token', $token)->where('role', 'Admin')
                ->first();
            $data->admin_data_role = $data->AdminData->AdminRole;
            // $data->user_alamats = $data->AdminData->AdminRole;
            $dataAlamats =    $data->admin_data_role->nama === 'Admin' ? Alamat::where('rt_id', $data->admin_data_role->rt_id)->get() : Alamat::get();
            return response()->json([
                'data' => $dataAlamats,
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
    public function getDataDetailAlamatByRt($alamat_id)
    {
        try {
            // $data->user_alamats = $data->AdminData->AdminRole;
            $dataDetailAlamats = DetailAlamat::where('alamat_id', $alamat_id)->get();
            return response()->json([
                'data' => $dataDetailAlamats,
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
    public function storeRT(Request $request)
    {
        try {
            $validateData = $request->validate([
                'rt' => 'required',
                'ketua_rt' => 'required|',
                'wakil_ketua_rt' => 'required'
            ]);
            $data = Rt::create($validateData);
            if ($validateData) {
                $data = AdminRole::create([
                    'nama' => 'Admin ' . $validateData['rt'],
                    'rt_id' => $data->rt_id
                ]);
            }
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
    public function updateRT(Request $request)
    {
        try {
            $validateData = $request->validate([
                'rt' => 'required',
                'ketua_rt' => 'required',
                'wakil_ketua_rt' => 'required'
            ]);
            $rt = Rt::findOrFail($request->rt_id);
            // dd($rt);
            $adminRole = AdminRole::where('rt_id', $rt->rt_id)->first();
            if ($adminRole) {
                $adminRole->update(['nama' => 'Admin ' . $validateData['rt']]);
            }
            $rt->update($validateData);

            // Update juga data AdminRole jika diperlukan
            return response()->json([
                'data' => $rt,
                'message' => 'Berhasil memperbarui data RT',
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

    public function deleteRT($id)
    {
        try {
            $rt = Rt::findOrFail($id);

            $adminRole = AdminRole::where('rt_id', $rt->rt_id)->first();
            if ($adminRole) {
                $adminRole->Admins()->delete();
                $adminRole->delete();
            }
            $rt->delete();
            return response()->json([
                'data' => null,
                'message' => 'Berhasil menghapus data RT',
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
