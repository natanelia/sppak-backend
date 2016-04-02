<?php

namespace App\Http\Controllers;

use App\Repositories\EloquentPendudukRepository as Penduduk;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Hash;

class PendudukController extends Controller
{
    protected $penduduk;

    public function __construct(Penduduk $penduduk)
    {
        $this->penduduk = $penduduk;
        $this->middleware('auth.basic.once', ['only' => ['index']]);
    }

    public function index(Request $request)
    {
        if ($request->user()) {
          $limit = $request->input('limit') ? $request->input('limit') : 10;
          $start = $request->input('start') ? $request->input('start') : 0;
          try {
                $statusCode = 200;
                $response = [
                    'data' => []
                ];

                $penduduks = $this->penduduk->all()->take($limit);

                foreach ($penduduks as $penduduk) {
                    $penduduk->pengguna;
                    $response['data'][] = $penduduk;
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
