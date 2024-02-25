<?php

namespace App\Http\Controllers;

use App\Models\Alamat;
use App\Models\DetailAlamat;
use App\Models\Laporan;
use App\Models\PembayaranIuran;
use App\Models\TagihanBulanan;
use App\Models\User;
use App\Models\UserAlamat;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function getAdminLogin(Request $request){
        try {

        $authorizationHeader = $request->header('Authorization');
        $token = str_replace('Bearer ', '', $authorizationHeader);
        $data = User::where('remember_token', $token)->where('role', 'Admin')
           ->first();
        $data->provinsi = $data->UserProvinsi->provinsi;
        $data->admin_data_role = $data->AdminData->AdminRole;
        // $data->user_alamats = $data->AdminData->AdminRole;
        unset($data->AdminData);
        unset($data->UserProvinsi);
        $tampung = [];
        return response()->json([
            'data' => $data,
            'message' => 'data admin login',
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
    public function getAllUserRt(Request $request)
    {
        try {
            $authorizationHeader = $request->header('Authorization');
            $token = str_replace('Bearer ', '', $authorizationHeader);
            $data = User::where('remember_token', $token)->where('role', 'Admin')
                ->first();
            $data->provinsi = $data->UserProvinsi->provinsi;
            $data->admin_data_role = $data->AdminData->AdminRole;
            // $data->user_alamats = $data->AdminData->AdminRole;
            unset($data->AdminData);
            unset($data->UserProvinsi);
            $dataUsers=[];
            $dataAlamats=Alamat::where('rt_id',  $data->admin_data_role->rt_id)->get();
            foreach ($dataAlamats as $key => $dtAlamat) {

                $dataUsers= array_merge($dataUsers, $dtAlamat->Users->toArray());

                // unset($dtAlamat->nama);
                $dataUsersUnique = collect($dataUsers)->unique('user_id')->values()->all();
            }
            return response()->json([
                'data' => $dataUsersUnique??null,
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
    public function getAllUser(Request $request)
    {
        try {
          $data=User::get();
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
    public function storeUser(Request $request)
    {
        try {

            // 'email' => 'required|email|unique:users,email',
            // 'password' => 'required|string|min:8',
            $validatedData = $request->validate([
                'nama' => 'required|string|max:255',
                'email' => '',
                'password' => '',
                'jenis_kelamin' => 'nullable',
                'alamat_id' => 'required|numeric|exists:alamats,alamat_id',
                'detail_alamat_id' => 'required|numeric|exists:detail_alamats,detail_alamat_id',
                'nik' => 'nullable|string|max:255',
                'no_kk' => 'nullable|string|max:255',
                'foto_ktp' => 'nullable|string|max:255',
                'foto_kk' => 'nullable|string|max:255',
                'provinsi_lahir_id' => 'nullable|exists:provinsis,provinsi_id',
                'tempat_lahir_lainnya' => 'nullable|string|max:255',
                'tgl_lahir' => 'nullable',
                'no_telp' => 'required|string|max:255',
                'pekerjaan' => 'nullable|string|max:255',
                'hubungan' => 'nullable',
                'status_berktp' => 'nullable',
                'status_perkawinan' => 'nullable',
                'agama' => 'nullable',
                'status' => 'nullable',
                'edit' => 'nullable',
                'role' => 'nullable'
            ]);
            $requestnama = $validatedData['nama'];
            $namabersih = preg_replace('/[^a-zA-Z]/', '', $requestnama);
            $validatedData['nama'] = $namabersih;
            $validatedData['email'] = strtolower($namabersih) .strtolower(Str::random(7)) .  '@gmail.com';
            $dataAlamat = Alamat::where('alamat_id', $request->alamat_id)->first();
            $dataDetailAlamat = DetailAlamat::where('alamat_id', $dataAlamat->alamat_id)->where('detail_alamat_id', $request->detail_alamat_id)->first();

            $pashrand = Str::random(10);
            $passhash = Hash::make($pashrand);
            $validatedData['password'] = $passhash;

            if ($dataAlamat->alamat_id == $dataDetailAlamat->alamat_id) {
                $data = User::create($validatedData);
                UserAlamat::create([
                    'user_id' => $data->user_id,
                    'alamat_id' => $dataAlamat->alamat_id,
                    'detail_alamat_id' => $dataDetailAlamat->detail_alamat_id,
                ]);
                // dd('gas');
            } else {
                return response()->json([
                    'data' => null,
                    'message' => 'Terjadi kesalahan: ',
                    'success' => false
                ], 500);
            }
            return response()->json([
                'data' => $data,
                'message' => 'Berhasil',
                'password' => $pashrand,
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
    public function jumlahWargaAndTransaksiAndLaporan(){
        try {
            $tahunSekarang = Carbon::now()->year;
            $data=[
                [
                    'key' => 'Jumlah User',
                    'count' => User::where('role', 'User')->count(),
                    'icon' => 'icon1',
                ],
                [
                    'key' => 'Jumlah Pembayaran ',
                    'count' => PembayaranIuran::whereYear('tanggal_pembayaran', $tahunSekarang)->count(),
                    'icon' => 'icon2',
                ],
                [
                    'key' => 'Jumlah Laporan',
                    'count' => Laporan::all()->count(),
                    'icon' => 'icon6',
                ],
            ];
            return response()->json([
                'data' => $data,
                'message' => 'Berhasil get ',
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
