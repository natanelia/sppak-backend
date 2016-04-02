<?php

namespace App\Http\Controllers;

use App\Repositories\EloquentPegawaiRepository as Pegawai;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Hash;

class PegawaiController extends Controller
{
    protected $pegawai;

    public function __construct(Pegawai $pegawai)
    {
        $this->pegawai = $pegawai;
        $this->middleware('auth.basic.once', ['only' => ['index']]);
    }

    public function index(Request $request)
    {
        if ($request->user()) {
            try {
                $statusCode = 200;
                $response = [
                    'data' => []
                ];

                $pegawais = $this->pegawai->all()->take(10);

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
            return response()->json([], 400);
        }
    }
}
