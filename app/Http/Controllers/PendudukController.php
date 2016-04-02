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

                $penduduks = \App\Penduduk::limit($limit)->offset($start)->get();

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
            return response()->json(['error' => 'Anda tidak memiliki otorisasi untuk menampilkan daftar penduduk.'], 401);
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

        if ($isAuthorized) {
          try {
              $statusCode = 200;
              $response = [
                  'data' => []
              ];

              $penduduk = $this->penduduk->find($id);

              $penduduk->pengguna;
              $response['data'][] = $penduduk;

          } catch (Exception $e) {
              $statusCode = 400;
              $response = [];
          } finally {
              return response()->json($response, $statusCode);
          }
        } else {
          return response()->json(['error' => "Anda tidak memiliki otorisasi untuk menampilkan penduduk dengan id = $id"], 401);
        }
    }
}
