<?php

namespace App\Http\Controllers;

use App\Models\Pengeluaran;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PengeluaranController extends Controller
{
    public function tambahDataPengeluaran(Request $request)
    {
        try {
            $validatedData =  $request->validate([
                'nama_pengeluaran' => 'required|string|max:255',
                'deskripsi' => 'nullable|string',
                'tanggal_pengeluaran' => '',
                'rt_id' => '',
                'jumlah' => 'required|numeric|min:0',
            ]);
            $authorizationHeader = $request->header('Authorization');
            $token = str_replace('Bearer ', '', $authorizationHeader);
            $data = User::where('remember_token', $token)->where('role', 'Admin')
                ->first();
            $data->provinsi = $data->UserProvinsi->provinsi;
            $data->admin_data_role = $data->AdminData->AdminRole;
            // $data->user_alamats = $data->AdminData->AdminRole;
            unset($data->AdminData);
            unset($data->UserProvinsi);
            $validatedData['rt_id'] = $data->admin_data_role->rt_id;
            $validatedData['tanggal_pengeluaran'] = Carbon::now();
            $data = Pengeluaran::create($validatedData);
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
    public function updateDataPengeluaran(Request $request)
    {
        try {
            $validatedData =  $request->validate([
                'nama_pengeluaran' => 'required|string|max:255',
                'deskripsi' => 'nullable|string',
                'tanggal_pengeluaran' => '',
                'rt_id' => '',
                'jumlah' => 'required|numeric|min:0',
            ]);
            $authorizationHeader = $request->header('Authorization');
            $token = str_replace('Bearer ', '', $authorizationHeader);
            $data = User::where('remember_token', $token)->where('role', 'Admin')
                ->first();
            $data->provinsi = $data->UserProvinsi->provinsi;
            $data->admin_data_role = $data->AdminData->AdminRole;
            // $data->user_alamats = $data->AdminData->AdminRole;
            unset($data->AdminData);
            unset($data->UserProvinsi);
            $validatedData['rt_id'] = $data->admin_data_role->rt_id;
            $validatedData['tanggal_pengeluaran'] = Carbon::now();
            $data = Pengeluaran::where('pengeluaran_id', $request->pengeluaran_id)->first()->update($validatedData);
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
    public function deleteDataPengeluaran($id)
    {
        try {
            $data = Pengeluaran::where('pengeluaran_id', $id)->first();
            $data->delete();
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

    public function getSumPengeluaranIuran(Request $request, $rt_id = null)
    {
        try {
            $tahunSekarang = Carbon::now()->year;
            if ($rt_id ==='Admin') {
                $authorizationHeader = $request->header('Authorization');
                $token = str_replace('Bearer ', '', $authorizationHeader);
                $data = User::where('remember_token', $token)->where('role', 'Admin')
                    ->first();
                $data->provinsi = $data->UserProvinsi->provinsi;
                $data->admin_data_role = $data->AdminData->AdminRole;
                // $data->user_alamats = $data->AdminData->AdminRole;
                unset($data->AdminData);
                unset($data->UserProvinsi);
                $datakeluar = Pengeluaran::where('rt_id', $data->admin_data_role->rt_id)->whereYear('tanggal_pengeluaran', $tahunSekarang)->get()->sum('jumlah');
            } else {
                $datakeluar = Pengeluaran::whereYear('tanggal_pengeluaran', $tahunSekarang)->get()->sum('jumlah');
            }
            return response()->json([
                'data' => $datakeluar,
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
    public function getPengeluaranIuran(Request $request, $rt_id = null)
    {
        try {
            $tahunSekarang = Carbon::now()->year;

            if ($rt_id ==='Admin') {
                $authorizationHeader = $request->header('Authorization');
                $token = str_replace('Bearer ', '', $authorizationHeader);
                $data = User::where('remember_token', $token)->where('role', 'Admin')->first();
                $data->provinsi = $data->UserProvinsi->provinsi;
                $data->admin_data_role = $data->AdminData->AdminRole;
                // $data->user_alamats = $data->AdminData->AdminRole;
                unset($data->AdminData);
                unset($data->UserProvinsi);
                $datakeluar = Pengeluaran::where('rt_id', $data->admin_data_role->rt_id)->whereYear('tanggal_pengeluaran', $tahunSekarang)->get();
            } else {
                $datakeluar = Pengeluaran::whereYear('tanggal_pengeluaran', $tahunSekarang)->get();
            }
            return response()->json([
                'data' => $datakeluar,
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
