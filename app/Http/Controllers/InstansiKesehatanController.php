<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;

use App\Http\Requests;

class InstansiKesehatanController extends Controller
{
    protected $instansiKesehatan;

    public function index(Request $request)
    {
        $limit = $request->input('limit') ? $request->input('limit') : 10;
        $start = $request->input('start') ? $request->input('start') : 0;
        try {
            $statusCode = 200;
            $response = [
                'data' => []
            ];

            $instansiKesehatans = \App\InstansiKesehatan::limit($limit)->offset($start)->get();

            foreach ($instansiKesehatans as $instansiKesehatan) {
                $instansiKesehatan->kota;
                $response['data'][] = $instansiKesehatan;
            }

        } catch (Exception $e) {
            $statusCode = 400;
            $response = [];
        } finally {
            return response()->json($response, $statusCode);
        }
    }

    public function show(Request $request, $id)
    {
        $isAuthorized = true;

        if ($isAuthorized) {
            try {
                $statusCode = 200;
                $response = [
                    'data' => []
                ];

                $instansiKesehatan = $this->pegawai->find($id);

                $response['data'][] = $instansiKesehatan;

            } catch (Exception $e) {
                $statusCode = 400;
                $response = [];
            } finally {
                return response()->json($response, $statusCode);
            }
        } else {
            return response()->json(['error' => "Anda tidak memiliki otorisasi untuk menampilkan pegawai dengan id = $id"], 401);
        }
    }
}
