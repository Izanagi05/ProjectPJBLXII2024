<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\AdminLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        try {

            $validator = Validator::make($request->all(), [
                'email' => 'required|email',
                'password' => 'required|min:8'
            ]);
            if ($validator->fails()) {
                return response()->json(['message' => $validator->errors()->first()], 422);
            }
            $credentials = $request->only('email', 'password');
            if (!$token = JWTAuth::attempt($credentials)) {
                return response()->json(['message' => 'Invalid credentials'], 401);
            }
            $user = Auth::user();
            // dd($user);
            $userModel = User::where('user_id', $user->user_id);
            // dd($token);
            if ($userModel->first()->role === 'Admin') {
                // dd('[');
                $adminCheck =  Admin::where('user_id', $userModel->first()->user_id)->first();
                $logpost = AdminLog::create([
                    'admin_id' => $adminCheck->admin_id,
                    'activity_type' => 'login',
                    'logged_at' => now()
                ]);
                $role = ($adminCheck->AdminRole->nama === 'Admin RW') ? 'Admin RW' : $userModel->first()->role;
            } else {
                $role = $userModel->first()->role;
            }
            $data = [
                'token' => $token,
                'role' => $role
            ];
            $userModel->update([
                'remember_token' => $token,
                'status' => 'Online'
            ]);
            Auth::login($user);

            return response()->json([
                'data' => $data,
                'message' => 'berhasil login',
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
    public function logout(Request $request)
    {
        try {
            // // $user = Auth::user();
            // $userModel = User::where('remember_token', $request->remember_token);
            $authorizationHeader = $request->header('Authorization');
            $token = str_replace('Bearer ', '', $authorizationHeader);
            $userModel = User::where('remember_token', $token);
            if ($userModel->first()->role === 'Admin') {
                $adminCheck =  Admin::where('user_id', $userModel->first()->user_id)->first();
                $logpost = AdminLog::create([
                    'admin_id' => $adminCheck->admin_id,
                    'activity_type' => 'logout',
                    'logged_at' => now()
                ]);
            }
            $userModel->update([
                'remember_token' => null,
                'status' => 'Offline'
            ]);
            Auth::logout();
            return response()->json([
                'token' => null,
                'data' => null,
                'message' => 'berhasil logout',
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
    public function register(Request $request)
    {
        try {
            $request->validate([
                'nama' => 'required|string',
                'password' => 'required|string|min:8',
                'email' => 'required|email|unique:users,email',
                'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
                'provinsi_lahir_id'=>'required|numeric|exists:provinsis,provinsi_id',
                'no_telp'=>'required|numeric'
            ]);
            // $request->validate([
            //     'nama' => 'required|string',
            //     'password' => 'required|string|min:8|confirmed',
            //     'email' => 'required|email|unique:users,email',
            //     'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            //     'tempat_lahir' => 'required|string',
            //     'tgl_lahir' => 'required|date',
            //     'no_telp' => 'required|string',
            //     'pekerjaan' => 'nullable|string',
            //     'status_berktp' => 'required|in:Sudah,Belum',
            //     'status_perkawinan' => 'nullable|in:Belum Menikah,Menikah,Duda,Janda,Lainnya',
            //     'agama' => 'nullable|in:Islam,Kristen,Katolik,Hindu,Buddha,Konghucu',
            // ]);

            $user = User::create([
                'nama' => $request->nama,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'jenis_kelamin' => $request->jenis_kelamin,
                'provinsi_lahir_id'=>$request->provinsi_lahir_id,
                'no_telp'=>$request->no_telp,
            ]);
            // dd($user);
            $token = JWTAuth::fromUser($user);
            $data = [
                'token' => $token,
                'role' => 'User'
            ];
            Auth::login($user);
            $authenticatedUser = Auth::user();
            $userModel = User::where('user_id', $authenticatedUser->user_id);
            $userModel->update([
                'remember_token' => $token,
                'status' => 'Online'
            ]);
            // dd(Auth::login($user));
            return response()->json([
                'data' => $data,
                'message' => 'berhasil buat akun dan login',
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
