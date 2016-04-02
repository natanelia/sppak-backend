<?php

namespace App\Http\Controllers;

use App\Repositories\EloquentPenggunaRepository as Pengguna;
use Exception;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Hash;

class PenggunaController extends Controller
{
    protected $pengguna;

    public function __construct(Pengguna $pengguna)
    {
        $this->pengguna = $pengguna;
        $this->middleware('auth.basic.once', ['only' => ['index', 'show']]);
    }

    public function index(Request $request)
    {
        if ($request->user() && $request->user()['userable_type'] === 'MorphAdmin') {
          $limit = $request->input('limit') ? $request->input('limit') : 10;
          $start = $request->input('start') ? $request->input('start') : 0;
          try {
                $statusCode = 200;
                $response = [
                    'data' => []
                ];

                $penggunas = \App\Pengguna::limit($limit)->offset($start)->get();

                foreach ($penggunas as $pengguna) {
                    $pengguna->pengguna;
                    $response['data'][] = $pengguna;
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
        if ($user) {
          try {
              $statusCode = 200;
              $response = [
                  'data' => []
              ];

              $isAuthorized = false;
              $pengguna = $this->pengguna->find($id);

              if ($pengguna === null) throw new Exception("Pengguna dengan id = $id tidak ditemukan.");

              $userType = $pengguna['userable_type'];
              if ($userType !== 'MorphPegawai') {
                if ($user['id'] == $id) {
                    $isAuthorized = true;
                }
              } else {
                  $isAuthorized = true;
              }

              if ($isAuthorized) {
                  $pengguna->userable;
                  $response['data'][] = $pengguna;
              } else {
                  $response = ['error' => "Anda tidak memiliki otorisasi untuk menampilkan penduduk dengan id = $id"];
                  $statusCode = 401;
              }
          } catch (Exception $e) {
              $statusCode = 400;
              $response = [
                  'error' => $e->getMessage(),
              ];
          } finally {
              return response()->json($response, $statusCode);
          }
        } else {
          return response()->json(['error' => "Anda tidak memiliki otorisasi untuk menampilkan penduduk dengan id = $id"], 401);
        }
    }
}
