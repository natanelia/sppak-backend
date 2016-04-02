<?php

namespace App\Http\Controllers;

use App\Repositories\EloquentPegawaiRepository as Pegawai;
use Exception;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Hash;

class PegawaiController extends Controller
{
    protected $pegawai;

    public function __construct(Pegawai $pegawai)
    {
        $this->pegawai = $pegawai;
        $this->middleware('auth.basic.once', ['only' => ['index', 'show']]);
    }

    public function index(Request $request)
    {
        if ($request->user() && $request->user()['userable_type'] === 'MorphPegawai') {
            $limit = $request->input('limit') ? $request->input('limit') : 10;
            $start = $request->input('start') ? $request->input('start') : 0;
            try {
                $statusCode = 200;
                $response = [
                    'data' => []
                ];

                $pegawais = \App\Pegawai::limit($limit)->offset($start)->get();

                foreach ($pegawais as $pegawai) {
                    $pegawai->pengguna;
                    $response['data'][] = $pegawai;
                }

            } catch (Exception $e) {
                $statusCode = 400;
                $response = [];
            } finally {
                return response()->json($response, $statusCode);
            }
        } else {
            return response()->json(['error' => 'Anda tidak memiliki otorisasi untuk menampilkan daftar pegawai.'], 401);
        }
    }

    public function show(Request $request, $id)
    {
        $user = $request->user();
        $isAuthorized = false;
        if ($user) {
            if ($user['userable_type'] === 'MorphPegawai') {
                if ($user['userable_id'] == $id) {
                    $isAuthorized = true;
                }
            } else {
                $isAuthorized = true;
            }
        }

        if ($isAuthorized) {
            try {
                $statusCode = 200;
                $response = [
                    'data' => []
                ];

                $pegawai = $this->pegawai->find($id);

                $pegawai->pengguna;
                $response['data'][] = $pegawai;

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
