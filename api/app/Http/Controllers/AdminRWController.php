<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\AdminRole;
use App\Models\Alamat;
use App\Models\DetailAlamat;
use App\Models\User;
use App\Models\UserAlamat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Http;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Storage;

class AdminRWController extends Controller
{
    public function tambahDataAdmin(Request $request)
    {
        try {
            //code...

            $validatedData = $request->validate([
                'user_id' => '',
                'admin_role_id' => '',
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
            if ($validatedData) {
                if ($request->file('foto_ktp')) {

                    $validatedData['foto_ktp'] = $request->file('foto_ktp')->store('fotoktp');
                }
                if ($request->file('foto_profil')) {

                    $validatedData['foto_profil'] = $request->file('foto_profil')->store('fotoprofil');
                }
                if ($request->file('foto_kk')) {

                    $validatedData['foto_kk'] = $request->file('foto_kk')->store('fotokk');
                }
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
                    $validatedData['role']='Admin';
                    $data = User::create($validatedData);
                    $to=$data->no_telp;
                        $message=[
                            'nama'=>$data->nama,
                            'email'=>$data->email,
                            'password'=>$pashrand,
                        ];
                        $client = new Client();
                        $response = Http::post('http://localhost:6700/passemail-message', [
                            'to' => $to,
                            'message' => $message
                        ]);
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
                $dataAdmin = Admin::create([
                    'user_id'=>$data->user_id,
                    'admin_role_id'=>$validatedData['admin_role_id'],
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
    public function getAllDataAdmin(Request $request, $search = null)
    {
        try {
            if ($search) {
                $adminDatas = Admin::where(function ($query) use ($search) {
                    $query->whereHas('AdminRole', function ($query) use ($search) {
                        $query->where('nama', 'LIKE', '%' . $search . '%');
                    })->orWhereHas('UserData', function ($query) use ($search) {
                        $query->where('nama', 'LIKE', '%' . $search . '%')->orWhere('email', 'LIKE', '%' . $search . '%')
                            ->orWhereHas('UserProvinsi', function ($query) use ($search) {
                                $query->where('provinsi', 'LIKE', '%' . $search . '%');
                            });
                    });
                })->latest()->get();
            } else {
                $adminDatas = Admin::get();
            }
            foreach ($adminDatas as $key => $adminData) {
                $adminData->AdminRole->name;
                $adminData->UserData;
                $adminData->UserData->UserProvinsi;
                # code...
            }
            return response()->json([
                'data' => $adminDatas,
                'message' => 'data semua admin berhasil diambil ',
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
    public function deleteDataAdmiControl($userId)
    {
        try {
            $data = Admin::where('user_id', $userId)->first();
            if ($data) {
                if (!empty(User::find($userId)->foto_profil)) {
                    Storage::delete(User::find($userId)->foto_profil);
                }
                if (!empty(User::find($userId)->foto_ktp)) {
                    Storage::delete(User::find($userId)->foto_ktp);
                }
                if (!empty(User::find($userId)->foto_kk)) {
                    Storage::delete(User::find($userId)->foto_kk);
                }
                $dataDelete = User::where('user_id', $data->user_id)->first();
                $dataDelete->UserProvinsi;
                $useralamats = $dataDelete->UserAlamats;
                $userLaporans = $dataDelete->UserLaporans;
                foreach ($useralamats as $key => $dtdetail) {
                    $dtdetail->delete();
                }
                foreach ($userLaporans as $key => $dtLaporan) {
                    $dtLaporan->delete();
                }
                foreach ($dataDelete->TagihanBulanans as $key => $tagihanBulanan) {
                    foreach ($tagihanBulanan->PembayaranIurans as $key => $pembayaranIuran) {
                        $pembayaranIuran->delete();
                    }
                    $tagihanBulanan->delete();
                }
                $data->delete();
                $dataDelete->delete();
                return response()->json([
                    'data' => $data,
                    'message' => 'data admin berhasil dihapus ',
                    'success' => true
                ], 201);
            } else {
                return response()->json([
                    'data' => null,
                    'message' => 'data tidak ditemukan',
                    'success' => false
                ], 404);
            }
        } catch (\Throwable $th) {
            return response()->json([
                'data' => null,
                'message' => 'Terjadi kesalahan: ' . $th,
                'success' => false
            ], 500);
        }
    }
    public function changePasswordAdminControl(Request $request)
    {
        try {
            $data = Admin::where('user_id', $request->user_id)->first();
            // dd($data);
            if ($data) {
                $validatedData = $request->validate([
                    'new_password' => 'required|string|min:8',
                    'confirm_password' => 'required|string|same:new_password',
                ]);
                $data->UserData->update([
                    'password' => Hash::make($request->new_password),
                ]);
                return response()->json([
                    'data' => 'Berhasil',
                    'message' => 'berhasil ubah password admin',
                    'success' => true
                ], 201);
            }
            return response()->json([
                'data' => $data,
                'message' => 'data admin berhasil dihapus ',
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
    public function getADminRolesData($rt_id = null)
    {
        try {

            $data = AdminRole::get();

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
}
