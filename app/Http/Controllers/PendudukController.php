<?php

namespace App\Http\Controllers;

use App\Repositories\EloquentPendudukRepository as Penduduk;
use Exception;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Hash;

class PendudukController extends Controller
{
    protected $penduduk;

    public function __construct(Penduduk $penduduk)
    {
        $this->penduduk = $penduduk;
        $this->middleware('auth.basic.once', ['only' => ['index', 'show']]);
    }

    public function index(Request $request)
    {
        $limit = $request->input('limit') ? $request->input('limit') : 10;
        $start = $request->input('start') ? $request->input('start') : 0;
        try {
            $statusCode = 200;
            $response = [
                'data' => []
            ];

            $penduduks = \App\Penduduk::limit($limit)->offset($start)->get();

            foreach ($penduduks as $penduduk) {
                if ($request->user()['userable_type'] === 'MorphPegawai'
                    || ($request->user()['userable_type'] === 'MorphPenduduk' && $request->user()['userable_id'] == $penduduk['id'])
                ) {

                    $penduduk->pengguna;
                }

                $response['data'][] = $penduduk;
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
        $user = $request->user();
        $isAuthorized = false;
        if ($user) {
            if ($user['userable_type'] === 'MorphPenduduk') {
                if ($user['userable_id'] == $id) {
                    $isAuthorized = true;
                }
            } else {
                $isAuthorized = true;
            }
        }

        try {
            $statusCode = 200;

            $penduduk = $this->penduduk->find($id);

            if ($isAuthorized) $penduduk->pengguna;
            $response = [
                'data' => $penduduk,
            ];

        } catch (Exception $e) {
            $statusCode = 400;
            $response = [];
        } finally {
            return response()->json($response, $statusCode);
        }
    }
}
