<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use GuzzleHttp\Client;

class WAController extends Controller
{
    public function postMessageCustomToGroup(Request $request)
    {
        try {
            $to = $request->input('to'); // Get the recipient number from the request
            $message = $request->input('message'); // Get the message from the request

            // Data yang akan dikirimkan dalam format JSON
            $data = [
                'to' => $to,
                'message' => $message
            ];

            // Membuat permintaan HTTP POST dengan badan permintaan raw
            $client = new Client();
    // $response = $client->request('POST', 'http://localhost:3000/incoming-message', [
    //     'json' => [
    //         'to' => $to,
    //         'message' =>$message,
    //     ]
    // ]);
    $response = Http::post('http://localhost:6700/incoming-message', [
        'to' => $to,
        'message' => $message
        // Add other data as needed
    ]);
            return response()->json([
                'data' => $response,
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
