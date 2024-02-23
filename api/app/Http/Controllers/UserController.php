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
           $wargaperalamats=[];

           foreach ($detailalamats as $key => $dtdetail) {
                $dtdetail->Alamat->RT;
               $wargaperalamats[]= $dtdetail->Wargas;
               $dtdetail['jumlah_wargas']=count($dtdetail->Wargas);
            }
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
    public function getallwargabyalamat(Request $request)
    {
        try {
            $authorizationHeader = $request->header('Authorization');
            $token = str_replace('Bearer ', '', $authorizationHeader);
            $data = User::where('remember_token', $token)->first();
                $data->UserProvinsi ;
                $detailalamats= $data->DetailAlamats ;
                //    unset($data->DetailAlamats);
                $wargaperalamats=[];
                $datakeluarga=[];

                foreach ($detailalamats as $key => $dtdetail) {
                    // $datakeluarga[$key]=DetailAlamat::where('alamat_id', $dtdetail->alamat_id)->where('detail_alamat_id', $dtdetail->detail_alamat_id)->Wargas;
                    //    $dataalamats[] = $dtdetail;
                    // dd($datakeluarga);
                    // $wargaperalamats[]=DetailAlamat::where('detail_alamat_id', $dtdetail->detail_alamat_id)->first();
                    $dtdetail->Wargas;
                    foreach ($dtdetail->Wargas as $key => $dtwarga) {
                        # code...
                        $dtwarga->UserProvinsi ;
                        unset($dtwarga->pivot);

                    }
                    $dtdetail->Alamat->RT;
                    $dtdetail['jumlah_wargas']=count($dtdetail->Wargas);
                // }
            }
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
                'agama_id' => 'nullable',
                'status' => 'nullable',
                'role' => 'nullable'
            ]);
            // $tes = 'NAMA SAYA      2       [][=;/ DALAH#081209   p- 0-                   9288#Bl=====222Okd# Jalan M0948209320398               elati No #5';
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
            $validatedData['email'] = strtolower($emailbersih).strtolower(Str::random(7)) . '@gmail.com';
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
                'jenis_kelamin' => 'required',
                'nik' => 'required|numeric',
                'no_kk' => 'required|numeric',
                'foto_ktp' => 'nullable|max:255',
                'foto_kk' => 'nullable|max:255',
                'provinsi_lahir_id' => 'nullable',
                'tempat_lahir_lainnya' => 'nullable|string|max:255',
                'tgl_lahir' => 'required',
                'no_telp' => 'required|string|max:255',
                'pekerjaan' => 'required|string|max:255',
                'hubungan' => 'required',
                'status_berktp' => 'required',
                'status_perkawinan' => 'required',
                'agama_id' => 'required',
                'status' => 'required',
                'role' => 'nullable'
            ]);
            if ($validatedData) {
                $authorizationHeader = $request->header('Authorization');
                $token = str_replace('Bearer ', '', $authorizationHeader);
                $data = User::where('remember_token', $token)->first();
                if ($data) {
                    if ($request->file('foto_ktp')) {
                        if (!empty(User::find($data->user_id)->foto_ktp)) {
                            Storage::delete(User::find($data->user_id)->foto_ktp);
                        }
                        $validatedData['foto_ktp'] = $request->file('foto_ktp')->store('fotoktp');
                    }
                    if ($request->file('foto_profil')) {
                        if (!empty(User::find($data->user_id)->foto_profil)) {
                            Storage::delete(User::find($data->user_id)->foto_profil);
                        }
                        $validatedData['foto_profil'] = $request->file('foto_profil')->store('fotoprofil');
                    }
                    if ($request->file('foto_kk')) {
                        if (!empty(User::find($data->user_id)->foto_kk)) {
                            Storage::delete(User::find($data->user_id)->foto_kk);
                        }
                        $validatedData['foto_kk'] = $request->file('foto_kk')->store('fotokk');
                    }
                    $data->update($validatedData);
                    $dataupdate = User::where('user_id', $data->user_id)->first();
                    $dataupdate->UserProvinsi ;
                    $detailalamats= $dataupdate->DetailAlamats ;
                    foreach ($detailalamats as $key => $dtdetail) {
                         $dtdetail->Alamat;
                     }
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
    public function editUserbyid(Request $request)
    {
        try {
            //code...

            $validatedData = $request->validate([
                'nama' => 'string|max:255',
                'email' => '',
                'password' => '',
                'jenis_kelamin' => 'required',
                'nik' => 'required|numeric',
                'no_kk' => 'required|numeric',
                'foto_ktp' => 'nullable|max:5120',
                'foto_kk' =>'nullable|max:5120',
                'provinsi_lahir_id' => 'nullable',
                'tempat_lahir_lainnya' => 'nullable|string|max:255',
                'tgl_lahir' => 'required',
                'no_telp' => 'required|string|max:255',
                'pekerjaan' => 'required|string|max:255',
                'hubungan' => 'required',
                'status_berktp' => 'required',
                'status_perkawinan' => 'required',
                'agama_id' => 'required',
                'status' => 'required',
                'role' => 'nullable'
            ]);
            if ($validatedData) {
                $data = User::where('user_id', $request->user_id)->first();
                if ($data) {
                    if ($request->file('foto_ktp')) {
                        if (!empty(User::find($data->user_id)->foto_ktp)) {
                            Storage::delete(User::find($data->user_id)->foto_ktp);
                        }
                        $validatedData['foto_ktp'] = $request->file('foto_ktp')->store('fotoktp');
                    }
                    if ($request->file('foto_profil')) {
                        if (!empty(User::find($data->user_id)->foto_profil)) {
                            Storage::delete(User::find($data->user_id)->foto_profil);
                        }
                        $validatedData['foto_profil'] = $request->file('foto_profil')->store('fotoprofil');
                    }
                    if ($request->file('foto_kk')) {
                        if (!empty(User::find($data->user_id)->foto_kk)) {
                            Storage::delete(User::find($data->user_id)->foto_kk);
                        }
                        $validatedData['foto_kk'] = $request->file('foto_kk')->store('fotokk');
                    }
                    $data->update($validatedData);
                    $dataupdate = User::where('user_id', $data->user_id)->first();
                    $dataupdate->UserProvinsi ;
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
    public function tambahUserbyid(Request $request)
    {
        try {
            //code...

            $validatedData = $request->validate([
                'nama' => 'required|string|max:255',
                'email' => '',
                'password' => '',
                'jenis_kelamin' => 'required',
                'nik' => 'required|numeric',
                'no_kk' => 'required|numeric',
                'foto_ktp' => 'nullable|max:5120',
                'foto_kk' =>'nullable|max:5120',
                'provinsi_lahir_id' => 'nullable',
                'tempat_lahir_lainnya' => 'nullable|string|max:255',
                'tgl_lahir' => 'required',
                'no_telp' => 'required|string|max:255',
                'pekerjaan' => 'required|string|max:255',
                'hubungan' => 'required',
                'status_berktp' => 'required',
                'status_perkawinan' => 'required',
                'agama_id' => 'required',
                'status' => 'required',
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
                    $data->UserProvinsi ;

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
    public function deleteUserbyid($id)
    {
        try {
            //code...
                $data = User::where('user_id', $id)->first();
                if ($data) {
                    if(!empty(User::find($id)->foto_profil)) {
                        Storage::delete(User::find($id)->foto_profil);
                    }
                    if(!empty(User::find($id)->foto_ktp)) {
                        Storage::delete(User::find($id)->foto_ktp);
                    }
                    if(!empty(User::find($id)->foto_kk)) {
                        Storage::delete(User::find($id)->foto_kk);
                    }
                    $dataDelete = User::where('user_id', $data->user_id)->first();
                    $dataDelete->UserProvinsi ;
                    $useralamats= $dataDelete->UserAlamats ;
                    $userLaporans= $dataDelete->UserLaporans;
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
}
