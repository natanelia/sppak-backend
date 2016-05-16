<?php

namespace App\Http\Controllers;

use App\Repositories\EloquentPendudukRepository as Penduduk;
use Exception;
use Illuminate\Http\Request;

use App\Http\Requests;

class PendudukController extends Controller
{
    protected $penduduk;

    public function __construct(Penduduk $penduduk)
    {
        $this->penduduk = $penduduk;
        $this->middleware('auth.basic', ['only' => ['getPermohonanAsPemohon']]);
    }

    public function index(Request $request)
    {
        return response()->json(\App\Penduduk::__generateId(0, 1, 3273010, 100395));
        $limit = $request->input('limit') ? $request->input('limit') : 1000;
        $start = $request->input('start') ? $request->input('start') : 0;
        try {
            $statusCode = 200;
            $response = [
                'data' => []
            ];

            $penduduks = \App\Penduduk::limit($limit)->offset($start)->get();

            foreach ($penduduks as $penduduk) {
                $penduduk->keluarga->rt->rw->kelurahan->kecamatan->kota->provinsi;
                $penduduk->kotaTempatLahir->provinsi;
                $response['data'][] = $penduduk;
            }
        } catch (Exception $e) {
            $statusCode = 400;
            $response = [
                'error' => $e->getMessage(),
            ];
        } finally {
            return response()->json($response, $statusCode);
        }
    }

    public function show(Request $request, $id)
    {
//        $user = $request->user();
//        $isAuthorized = false;
//        if ($user) {
//            if ($user['userable_type'] === 'MorphPenduduk') {
//                if ($user['userable_id'] == $id) {
//                    $isAuthorized = true;
//                }
//            } else {
//                $isAuthorized = true;
//            }
//        }

        try {
            $statusCode = 200;

            $penduduk = $this->penduduk->find($id);
            if ($penduduk !== null) {
              $penduduk->keluarga->rt->rw->kelurahan->kecamatan->kota->provinsi;
              $penduduk->kotaTempatLahir->provinsi;
            }

            // if ($isAuthorized) $penduduk->pengguna;
            $response = [
                'data' => $penduduk,
            ];

        } catch (Exception $e) {
            $statusCode = 400;
            $response = [
                'error' => $e,
                'message' => $e->getMessage(),
            ];
        } finally {
            return response()->json($response, $statusCode);
        }
    }

    public function getPermohonanAsPemohon(Request $request, $id)
    {
        $user = $request->user();
        try {
            if ($user['userable_type'] !== 'MorphPegawai') throw new Exception("Anda tidak memiliki otorisasi untuk menampilkan permohonan penduduk.");

            $sudahDicetak = $request->input('sudahDicetak');
            $status = $request->input('status');

            $pemohon = \App\Penduduk::findOrFail($id);
            $daftarKelahiran = $pemohon->kelahiranOfPemohon;

            foreach ($daftarKelahiran as $kelahiran) {
                $kelahiran->anak;
            }

            unset($pemohon->kelahiranOfPemohon);

            $response = [
                'data' => $kelahiran,
                'pemohon' => $pemohon,
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
