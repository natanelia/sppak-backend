<?php

namespace App\Http\Controllers;

use App\Penduduk as Penduduk;
use App\Repositories\EloquentPenggunaRepository as Pengguna;
use Exception;
use Illuminate\Http\Request;

use App\Http\Requests;

class PenggunaController extends Controller
{
    protected $pengguna;

    public function __construct(Pengguna $pengguna)
    {
        $this->pengguna = $pengguna;

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

            $penggunas = $this->pengguna->all()->take(10);

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
    }

    public function show($id)
    {
        try {
            $pengguna = $this->pengguna->find($id);
            $statusCode = 200;
            $response = [
                'data' => [
                    'id' => $pengguna->id,
                    'nama' => $pengguna->nama,
                    'jenisKelamin' => $pengguna->jenisKelamin,
                    'kotaLahirId' => $pengguna->kotaLahirId,
                    'tanggalLahir' => $pengguna->tanggalLahir,
                    'jenisLahir' => $pengguna->jenisLahir,
                    'penolongKelahiran' => $pengguna->penolongKelahiran,
                    'berat' => $pengguna->berat,
                    'panjang' => $pengguna->panjang,
                ],
            ];
        } catch (Exception $e) {
            $response = [
                'error' => 'Pengguna tidak ditemukan.',
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
                'penggunaKe' => '',
                'penolongKelahiran' => '',
                'berat' => '',
                'panjang' => '',
            ]);

            if ($validator->fails()) throw new Exception(implode(" ", $validator->getMessageBag()->all()));

            $this->pengguna->create($request->all());

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

    public function update(Request $request, $id) {
        try {
            $pengguna = $this->pengguna->find($id);
            if (!$pengguna) throw new Exception("No pengguna found with id=$id.");

            $pengguna['nama'] = (array_key_exists('nama', $request->all())) ? ($request->all()['nama']) : $pengguna['nama'];
            $pengguna['jenisKelamin'] = (array_key_exists('jenisKelamin', $request->all())) ? ($request->all()['jenisKelamin']) : $pengguna['jenisKelamin'];
            $pengguna['kotaLahirId'] = (array_key_exists('kotaLahirId', $request->all()))  ? ($request->all()['kotaLahirId']) : $pengguna['kotaLahirId'];
            $pengguna['tanggalLahir'] = (array_key_exists('tanggalLahir', $request->all())) ? ($request->all()['tanggalLahir']) : $pengguna['tanggalLahir'];
            $pengguna['jenisLahir'] = (array_key_exists('jenisLahir', $request->all()))  ? ($request->all()['jenisLahir']) : $pengguna['jenisLahir'];
            $pengguna['penggunaKe'] = (array_key_exists('penggunaKe', $request->all()))  ? ($request->all()['penggunaKe']) : $pengguna['penggunaKe'];
            $pengguna['penolongKelahiran'] = (array_key_exists('penolongKelahiran', $request->all())) ? ($request->all()['penolongKelahiran']) : $pengguna['penolongKelahiran'];
            $pengguna['berat'] = (array_key_exists('berat', $request->all()))  ? ($request->all()['berat']) : $pengguna['berat'];
            $pengguna['panjang'] = (array_key_exists('panjang', $request->all()) ) ? ($request->all()['panjang']) : $pengguna['panjang'];
            $pengguna->save();

            $statusCode = 200;
            $response = [
                'message' => 'Berhasil menyimpan data pengguna.',
            ];
        } catch (Exception $e) {
            $response = [
                'error' => 'Gagal menyimpan data pengguna.',
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
            $pengguna = $this->pengguna->find($id);
            if (!$pengguna) throw new Exception("No pengguna found with id=$id.");

            $pengguna->delete();

            $statusCode = 200;
            $response = [
                'message' => 'Berhasil menghapus data pengguna.',
            ];
        } catch (Exception $e) {
            $response = [
                'error' => 'Gagal menghapus data pengguna.',
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
