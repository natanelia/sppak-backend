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
        $this->middleware('auth.basic.once', ['only' => ['index', 'show', 'login']]);
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

                $penggunas = \App\Pengguna::limit($limit)->offset($start)->get();

                foreach ($penggunas as $pengguna) {
                    $pengguna->userable;
                    $response['data'][] = $pengguna;
                }

            } catch (Exception $e) {
                $statusCode = 400;
                $response = [];
            } finally {
                return response()->json($response, $statusCode);
            }
        } else {
            return response()->json(['error' => 'Anda tidak memiliki otorisasi untuk menampilkan daftar pengguna.'], 401);
        }
    }

    public function show(Request $request, $id)
    {
        $user = $request->user();
        if ($user) {
            try {
                $statusCode = 200;

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
                    $response = [
                        'data' => $pengguna,
                    ];
                } else {
                    $response = ['error' => "Anda tidak memiliki otorisasi untuk menampilkan pengguna dengan id = $id"];
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
            return response()->json(['error' => "Anda tidak memiliki otorisasi untuk menampilkan pengguna dengan id = $id"], 401);
        }
    }

    public function store(Request $request)
    {
        try {
            $validator = validator()->make($request->all(), [
                'email' => 'required|email|unique:pengguna|max:255',
                'password' => 'required|min:6',
                'userable_id' => 'required',
                'userable_type' => 'required|in:MorphPenduduk,MorphKelurahan,MorphInstansiKesehatan,MorphPegawai',
            ]);

            if ($validator->fails()) throw new Exception(implode(" ", $validator->getMessageBag()->all()));

            $dataPengguna = $request->all();
            $dataPengguna['password'] = Hash::make($dataPengguna['password']);
            $this->pengguna->create($dataPengguna);

            $statusCode = 200;
            $response = [
                'message' => 'Berhasil membuat data pengguna.',
            ];
        } catch (Exception $e) {
            $response = [
                'error' => 'Gagal membuat data pengguna.',
                'message' => $e->getMessage(),
            ];
            $statusCode = 400;
        } finally {
            return response()->json($response, $statusCode);
        }
    }

    public function login(Request $request)
    {
        $user = $request->user();
        try {
            $pengguna = \App\Pengguna::where('email', $user['email'])->first();
            // $pengguna->userable;
            $response = [
                'data' => $pengguna,
            ];
            $statusCode = 200;
        } catch (Exception $e) {
            $statusCode = 400;
            $response = [
                'error' => $e->getMessage(),
            ];
        } finally {
            return response()->json($response, $statusCode);
        }
    }
}
