<?php

namespace App\Http\Controllers;

use App\Models\Alamat;
use App\Models\DetailAlamat;
use App\Models\User;
use App\Models\UserAlamat;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function getUserLogin(Request $request)
    {
        try {
            $authorizationHeader = $request->header('Authorization');
            $token = str_replace('Bearer ', '', $authorizationHeader);
            $data = User::where('remember_token', $token)->first();
            $data->UserProvinsi ;
           $detailalamats= $data->DetailAlamats ;
        //    unset($data->DetailAlamats);
        //    $dataalamats=[];
           foreach ($detailalamats as $key => $dtdetail) {
            //    $dataalamats[] = $dtdetail;
                $dtdetail->Alamat;
            }
            // $data['detail_alamat']=$dataalamats;
            // unset($data->UserProvinsi);
            // $dataa=[
            //     'AdminRole'=>$tampung['AdminRole']->name,
            //     'UserName'=>$tampung['UserData'],
            // ];
            return response()->json([
                'data' => $data,
                'message' => 'data user login',
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
    public function buatAkunVia(Request $request)
    {
        try {

            // 'email' => 'required|email|unique:users,email',
            // 'password' => 'required|string|min:8',
            $validatedData = $request->validate([
                'nama' => 'string|max:255',
                'email' => '',
                'password' => '',
                'jenis_kelamin' => 'nullable',
                'nik' => 'nullable|string|max:255',
                'no_kk' => 'nullable|string|max:255',
                'foto_ktp' => 'nullable|string|max:255',
                'foto_kk' => 'nullable|string|max:255',
                'provinsi_lahir_id' => 'nullable|exists:provinsis,provinsi_id',
                'tempat_lahir_lainnya' => 'nullable|string|max:255',
                'tgl_lahir' => 'nullable',
                'no_telp' => 'string|max:255',
                'pekerjaan' => 'nullable|string|max:255',
                'hubungan' => 'nullable',
                'status_berktp' => 'nullable',
                'status_perkawinan' => 'nullable',
                'agama' => 'nullable',
                'status' => 'nullable',
                'edit' => 'nullable',
                'role' => 'nullable'
            ]);
            $tes = 'NAMA SAYA      2       [][=;/ DALAH#081209   p- 0-                   9288#Bl=====222Okd# Jalan M0948209320398               elati No #5';
            $requestalamat = $request->alamat;
            if(!$request->storedataviawa){
                return response()->json([
                    'data' => null,
                    'message' => 'Terjadi kesalahan daftar: ',
                    'success' => false
                ], 500);
            }
            $pisahdata = explode('#', $request->storedataviawa);
            $namabersih = preg_replace('/[^a-zA-Z ]/', ' ', $pisahdata[0]);
            $namabersih2 = trim(preg_replace('/\s+/', ' ', $namabersih));
            $emailbersih = preg_replace('/[^a-zA-Z]/', '', $pisahdata[0]);
            $nobersih = preg_replace('/[^0-9]/', '', $pisahdata[1]);
            $alamatbersih = preg_replace('/[^a-zA-Z ]/', '', $pisahdata[2]);
            $alamatbersih2 = strtolower(trim(preg_replace('/\s+/', '', $alamatbersih)));
            $detailalamatbersih = preg_replace('/[^a-zA-Z]/', '', $pisahdata[3]);
            $noalamatdetail = preg_replace('/[^0-9]/', '', $pisahdata[4]);
            $detailalamatbersih2 = strtolower(trim(preg_replace('/\s+/', '', $detailalamatbersih))) . $noalamatdetail;
            // dd($detailalamatbersih2);

            $dataAlamat = Alamat::whereRaw("REPLACE(nama, ' ', '') = REPLACE(?, ' ', '')", [$alamatbersih2])->first();
            $dataDetailAlamat = DetailAlamat::where('alamat_id', $dataAlamat->alamat_id)->whereRaw("REPLACE(nama, ' ', '') = REPLACE(?, ' ', '')", [$detailalamatbersih2])->first();
            // dd($dataDetailAlamat);

            // dd(implode('',explode(' ',$requestnama)));
            $validatedData['nama'] = $namabersih2;
            $validatedData['email'] = strtolower($emailbersih) . '@gmail.com';
            $validatedData['no_telp'] = $nobersih;
            $pashrand = Str::random(10);
            $passhash = Hash::make($pashrand);
            $validatedData['password'] = $passhash;
            $data = User::create($validatedData);
            if ($data && ($dataAlamat->alamat_id == $dataDetailAlamat->alamat_id)) {
                // dd($dataDetailAlamat->detail_alamat_id);
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
                'datas' => $dataAlamat,
                'data' => $dataDetailAlamat,
                'message' => 'Berhasil',
                'email' => $data->email,
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
    public function editUser(Request $request)
    {
        try {
            //code...

            $validatedData = $request->validate([
                'nama' => 'string|max:255',
                'email' => '',
                'password' => '',
                'jenis_kelamin' => 'nullable',
                'nik' => 'required|string|max:255',
                'no_kk' => 'required|string|max:255',
                'foto_ktp' => 'nullable|string|max:255',
                'foto_kk' => 'nullable|string|max:255',
                'provinsi_lahir_id' => 'required|exists:provinsis,provinsi_id',
                'tempat_lahir_lainnya' => 'nullable|string|max:255',
                'tgl_lahir' => 'nullable',
                'no_telp' => 'required|string|max:255',
                'pekerjaan' => 'required|string|max:255',
                'hubungan' => 'required',
                'status_berktp' => 'required',
                'status_perkawinan' => 'required',
                'agama' => 'required',
                'status' => 'required',
                'edit' => 'nullable',
                'role' => 'nullable'
            ]);
            if ($validatedData) {
                $data = User::findOrFail($request->report_id);
                if ($data) {
                    if ($request->file('foto_ktp')) {
                        if (!empty(User::find($request->user_id)->foto_ktp)) {
                            Storage::delete(User::find($request->user_id)->foto_ktp);
                        }
                        $validateData['foto_ktp'] = $request->file('foto_ktp')->store('fotoktp');
                    }
                    if ($request->file('foto_kk')) {
                        if (!empty(User::find($request->user_id)->foto_kk)) {
                            Storage::delete(User::find($request->user_id)->foto_kk);
                        }
                        $validateData['foto_kk'] = $request->file('foto_kk')->store('fotokk');
                    }
                    $data->update($validateData);
                    $dataupdate = User::where('user_id', $request->user_id)->get();
                }
            }
            return response()->json([
                'data' => $dataupdate,
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
