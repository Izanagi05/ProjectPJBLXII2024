<?php

namespace App\Http\Controllers;

use App\Models\Alamat;
use Illuminate\Http\Request;

class AlamatController extends Controller
{
    public function getallalamat(){
            try{
                $datas= Alamat::get();
                foreach ($datas as $key => $data) {
                    # code...
                    $data->DetailAlamats;
                }
                return response()->json([
                    'data' => $datas,
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
