<?php

namespace App\Http\Controllers;
use App\Models\Bulan;
use Illuminate\Http\Request;

class BulanController extends Controller
{
    public function getAllBulan()
    {
        try {
            $data=Bulan::get();
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
}
