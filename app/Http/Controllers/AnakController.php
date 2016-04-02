<?php

namespace App\Http\Controllers;

use App\Repositories\EloquentAnakRepository as Anak;
use Exception;
use Illuminate\Http\Request;

use App\Http\Requests;

class AnakController extends Controller
{
    protected $anak;

    public function __construct(Anak $anak)
    {
        $this->anak = $anak;

        // $this->middleware('auth');
        // $this->middleware('log');
    }

    public function index()
    {
        try {
            $statusCode = 200;
            $response = [
                'data' => []
            ];


            $limit = $request->input('limit') ? $request->input('limit') : 10;
            $start = $request->input('start') ? $request->input('start') : 0;

            $anaks = \App\Anak::limit($limit)->skip($start)->get();

            foreach ($anaks as $anak) {
                $response['data'][] = [
                    'id' => $anak->id,
                    'nama' => $anak->nama,
                    'jenisKelamin' => $anak->jenisKelamin,
                    'kotaLahirId' => $anak->kotaLahirId,
                    'tanggalLahir' => $anak->tanggalLahir,
                    'jenisLahir' => $anak->jenisLahir,
                    'penolongKelahiran' => $anak->penolongKelahiran,
                    'berat' => $anak->berat,
                    'panjang' => $anak->panjang,
                ];
            }

        } catch (Exception $e) {
            $statusCode = 400;
            $response = [];
        } finally {
            return response()->json($response, $statusCode);
        }
    }

    public function show($id)
    {
        try {
            $anak = $this->anak->find($id);
            $statusCode = 200;
            $response = [
                'data' => [
                    'id' => $anak->id,
                    'nama' => $anak->nama,
                    'jenisKelamin' => $anak->jenisKelamin,
                    'kotaLahirId' => $anak->kotaLahirId,
                    'tanggalLahir' => $anak->tanggalLahir,
                    'jenisLahir' => $anak->jenisLahir,
                    'penolongKelahiran' => $anak->penolongKelahiran,
                    'berat' => $anak->berat,
                    'panjang' => $anak->panjang,
                ],
            ];
        } catch (Exception $e) {
            $response = [
                'error' => 'Anak tidak ditemukan.',
            ];
            $statusCode = 404;
        } finally {
            return response()->json($response, $statusCode);
        }
    }

    public function store(Request $request)
    {
        try {
            $validator = validator()->make($request->all(), [
                'nama' => 'required|max:255',
                'jenisKelamin' => 'required|in:laki-laki,perempuan',
                'kotaLahirId' => 'required',
                'tanggalLahir' => '',
                'jenisLahir' => '',
                'anakKe' => '',
                'penolongKelahiran' => '',
                'berat' => '',
                'panjang' => '',
            ]);

            if ($validator->fails()) throw new Exception(implode(" ", $validator->getMessageBag()->all()));

            $this->anak->create($request->all());

            $statusCode = 200;
            $response = [
                'message' => 'Berhasil membuat data anak.',
            ];
        } catch (Exception $e) {
            $response = [
                'error' => 'Gagal membuat data anak.',
                'message' => $e->getMessage(),
            ];
            $statusCode = 400;
        } finally {
            return response()->json($response, $statusCode);
        }
    }

    public function update(Request $request, $id) {
        try {
            $anak = $this->anak->find($id);
            if (!$anak) throw new Exception("No anak found with id=$id.");

            $anak['nama'] = (array_key_exists('nama', $request->all())) ? ($request->all()['nama']) : $anak['nama'];
            $anak['jenisKelamin'] = (array_key_exists('jenisKelamin', $request->all())) ? ($request->all()['jenisKelamin']) : $anak['jenisKelamin'];
            $anak['kotaLahirId'] = (array_key_exists('kotaLahirId', $request->all()))  ? ($request->all()['kotaLahirId']) : $anak['kotaLahirId'];
            $anak['tanggalLahir'] = (array_key_exists('tanggalLahir', $request->all())) ? ($request->all()['tanggalLahir']) : $anak['tanggalLahir'];
            $anak['jenisLahir'] = (array_key_exists('jenisLahir', $request->all()))  ? ($request->all()['jenisLahir']) : $anak['jenisLahir'];
            $anak['anakKe'] = (array_key_exists('anakKe', $request->all()))  ? ($request->all()['anakKe']) : $anak['anakKe'];
            $anak['penolongKelahiran'] = (array_key_exists('penolongKelahiran', $request->all())) ? ($request->all()['penolongKelahiran']) : $anak['penolongKelahiran'];
            $anak['berat'] = (array_key_exists('berat', $request->all()))  ? ($request->all()['berat']) : $anak['berat'];
            $anak['panjang'] = (array_key_exists('panjang', $request->all()) ) ? ($request->all()['panjang']) : $anak['panjang'];
            $anak->save();

            $statusCode = 200;
            $response = [
                'message' => 'Berhasil menyimpan data anak.',
            ];
        } catch (Exception $e) {
            $response = [
                'error' => 'Gagal menyimpan data anak.',
                'message' => $e->getMessage(),
            ];
            $statusCode = 400;
        } finally {
            return response()->json($response, $statusCode);
        }
    }

    public function destroy(Request $request, $id)
    {
        try {
            $anak = $this->anak->find($id);
            if (!$anak) throw new Exception("No anak found with id=$id.");

            $anak->delete();

            $statusCode = 200;
            $response = [
                'message' => 'Berhasil menghapus data anak.',
            ];
        } catch (Exception $e) {
            $response = [
                'error' => 'Gagal menghapus data anak.',
                'message' => $e->getMessage(),
            ];
            $statusCode = 400;
        } finally {
            return response()->json($response, $statusCode);
        }
    }

    public function missingMethod($parameters = array())
    {
        $statusCode = 404;
        $response = [
            'error' => 'URL tidak ditemukan.',
        ];
        return response()->json($response, $statusCode);
    }
}
