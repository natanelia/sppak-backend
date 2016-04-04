<?php

namespace App\Http\Controllers;

use App\Repositories\EloquentKelahiranRepository as Kelahiran;
use Exception;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class KelahiranController extends Controller
{
    protected $kelahiran;

    public function __construct(Kelahiran $kelahiran)
    {
        $this->kelahiran = $kelahiran;

        $this->middleware('auth.basic.once', ['only' => ['index', 'show', 'store', 'update', 'destroy']]);
    }

    public function index(Request $request)
    {
        $user = $request->user();
        try {
            $statusCode = 200;
            $response = [
                'data' => []
            ];

            $limit = $request->input('limit') ? $request->input('limit') : 10;
            $start = $request->input('start') ? $request->input('start') : 0;

            if ($user) {
                if ($user['userable_type'] === 'MorphPenduduk') {
                    // kalo penduduk, dia hanya bisa lihat kelahiran yang pemohonId / ibuId / ayahId nya sama dengan userable_id
                    $kelahirans = \App\Kelahiran
                        ::limit($limit)
                        ->skip($start)
                        ->where('pemohonId', $user['userable_id'])
                        ->orWhere('ibuId', $user['userable_id'])
                        ->orWhere('ayahId', $user['userable_id'])
                        ->get();
                } else if ($user['userable_type'] === 'MorphInstansiKesehatan') {
                    $kelahirans = \App\Kelahiran
                        ::limit($limit)
                        ->skip($start)
                        ->where('instansiKesehatanId', $user['userable_id'])
                        ->get();
                } else if ($user['userable_type'] === 'MorphKelurahan') {
                    $kelahirans = \App\Kelahiran
                        ::limit($limit)
                        ->skip($start)
                        ->where('kelurahanId', $user['userable_id'])
                        ->get();
                } else if ($user['userable_type'] === 'MorphPegawai') {
                    $kelahirans = \App\Kelahiran
                        ::limit($limit)
                        ->skip($start)
                        ->get();
                } else {
                    $kelahirans = [];
                }
                
                foreach ($kelahirans as $kelahiran) {
                    $kelahiran->insertAllRelated();
                    $response['data'][] = $kelahiran;
                }
            } else {
                throw new Exception('Anda tidak memiliki otorisasi untuk menampilkan daftar permohonan kelahiran.');
            }
        } catch (Exception $e) {
            $statusCode = 400;
            $response = [
                'error' => 'Gagal melihat daftar permohonan kelahiran.',
                'message' => $e->getMessage(),
            ];
        } finally {
            return response()->json($response, $statusCode);
        }
    }

    public function show($id)
    {
        try {
            $kelahiran = $this->kelahiran->find($id);
            $statusCode = 200;

            $kelahiran->insertAllRelated();
            $response = [
                'data' => $kelahiran,
            ];
        } catch (Exception $e) {
            $response = [
                'error' => 'Kelahiran tidak ditemukan.',
            ];
            $statusCode = 404;
        } finally {
            return response()->json($response, $statusCode);
        }
    }

    public function store(Request $request)
    {
        $user = $request->user();
        try {
            $failures = false;

            $kelahiranData = $request->all();
            $validator = validator()->make($kelahiranData, [
                'anak.nama' => 'required|string',
                'anak.jenisKelamin' => 'required|in:laki-laki,perempuan',
                'anak.kotaLahirId' => 'required|numeric',
                'anak.golonganDarah' => 'string|in:A,B,AB,O',
                'anak.waktuLahir' => 'date',
                'anak.jenisLahir' => 'string',
                'anak.anakKe' => 'numeric',
                'anak.penolongKelahiran' => 'alpha',
                'anak.berat' => 'numeric',
                'anak.panjang' => 'numeric',
                'kelurahanId' => 'numeric',
                'instansiKesehatanId' => 'numeric',
                'kartuKeluargaId' => 'numeric',
                'aktaNikahId' => 'numeric',
                'ibuId' => 'numeric',
                'ayahId' => 'numeric',
                'saksiSatu.pendudukId' => 'numeric',
                'saksiSatu.email' => 'email',
                'saksiDua.pendudukId' => 'numeric',
                'saksiDua.email' => 'email',
                'pemohonId' => 'numeric',
                'status' => 'numeric|in:0,1,2',
            ]);

            if ($validator->fails()) throw new Exception(implode(" ", $validator->getMessageBag()->all()));
            ////////////////////////////////////////////////////////////////////////////////////////////////
            if ($user['userable_type'] === 'MorphPenduduk') {
                $kelahiranData['pemohonId'] = $user['userable_id'];
                unset($kelahiranData['verifikasiSaksi1']);
                unset($kelahiranData['verifikasiSaksi2']);
                unset($kelahiranData['verifikasiInstansiKesehatan']);
                unset($kelahiranData['verifikasiLurah']);
                unset($kelahiranData['verifikasiAdmin']);
                unset($kelahiranData['waktuCetakTerakhir']);

                if (isset($kelahiranData['status']) && $kelahiranData['status'] > 1) { // !== 2
                    unset($kelahiranData['status']);
                }

                if (isset($kelahiranData['saksiSatu'])) {
                    $saksiSatuData = $kelahiranData['saksiSatu'];
                    if (isset($saksiSatuData['pendudukId']) && isset($saksiSatuData['email'])) {
                        $saksiSatu = \App\Saksi::create([
                            'pendudukId' => $saksiSatuData['pendudukId'],
                            'email' => $saksiSatuData['email'],
                            'token' => Hash::make(str_random(255)),
                        ]);
                        unset($kelahiranData['saksiSatu']);
                        $kelahiranData['saksiSatuId'] = $saksiSatu['id'];
                        
                        SaksiController::sendVerificationEmail($saksiSatu['id'], $user->userable, $kelahiranData['anak'], $saksiSatuData['email']);
                    }
                }

                if (isset($kelahiranData['saksiDua'])) {
                    $saksiDuaData = $kelahiranData['saksiDua'];
                    if (isset($saksiDuaData['pendudukId']) && isset($saksiDuaData['email'])) {
                        $saksiDua = \App\Saksi::create([
                            'pendudukId' => $saksiDuaData['pendudukId'],
                            'email' => $saksiDuaData['email'],
                            'token' => Hash::make(str_random(255)),
                        ]);
                        unset($kelahiranData['saksiDua']);
                        $kelahiranData['saksiDuaId'] = $saksiDua->id;

                        SaksiController::sendVerificationEmail($saksiDua['id'], $user->userable, $kelahiranData['anak'], $saksiDuaData['email']);
                    }
                }
            } else if ($user['userable_type'] === 'MorphKelurahan') {
                $kelahiranData = [
                    'id' => $kelahiranData['id'],
                    'verifikasiLurah' => $kelahiranData['verifikasiLurah'],
                ];
            } else if ($user['userable_type'] === 'MorphInstansiKesehatan') {
                $kelahiranData = [
                    'id' => $kelahiranData['id'],
                    'verifikasiInstansiKesehatan' => $kelahiranData['verifikasiInstansiKesehatan'],
                ];
            } else if ($user['userable_type'] === 'MorphPegawai') {
                unset($kelahiranData['verifikasiSaksi1']);
                unset($kelahiranData['verifikasiSaksi2']);
                unset($kelahiranData['verifikasiSaksiInstansiKesehatan']);
                unset($kelahiranData['verifikasiSaksiLurah']);
                unset($kelahiranData['status']);
            } else {
                throw new Exception("Anda tidak memiliki otorisasi untuk membuat permohonan kelahiran ini.");
            }

            //////////////////////////////////////////////////////////////
            DB::beginTransaction();
            try {
                $anak = \App\Anak::create($request->get('anak'));

                $kelahiranData['anakId'] = $anak->id;
                unset($kelahiranData['anak']);

                if (isset($kelahiranData['status'])) {
                    if ($kelahiranData['status'] == 1) {
                        $validatorAnak = validator()->make($anak->toArray(), [
                            'nama' => 'required|alpha',
                            'jenisKelamin' => 'required|in:laki-laki,perempuan',
                            'kotaLahirId' => 'required|numeric',
                            'golonganDarah' => 'required|string|in:A,B,AB,O',
                            'waktuLahir' => 'required|date',
                            'jenisLahir' => 'required|string',
                            'anakKe' => 'required|numeric',
                            'penolongKelahiran' => 'required|alpha',
                            'berat' => 'required|numeric',
                            'panjang' => 'required|numeric',
                        ]);

                        $validatorKelahiran = validator()->make($kelahiranData, [
                            'kelurahanId' => 'required|numeric',
                            'instansiKesehatanId' => 'required|numeric',
                            'kartuKeluargaId' => 'required|numeric',
                            'aktaNikahId' => 'required|numeric',
                            'ibuId' => 'required|numeric',
                            'ayahId' => 'required|numeric',
                            'saksiSatuId' => 'required|numeric',
                            'saksiDuaId' => 'required|numeric',
                            'pemohonId' => 'required|numeric',
                            'status' => 'required|numeric|in:0,1,2',
                        ]);

                        if ($validatorKelahiran->fails() || $validatorAnak->fails()) {
                            unset($kelahiranData['status']);

                            $failures = new Exception('Data pengajuan belum lengkap'
                                . implode(" \n", $validatorKelahiran->getMessageBag()->all())
                                . ' \n'
                                . implode(" \n", $validatorAnak->getMessageBag()->all())
                            );                        }
                    }
                }

                $this->kelahiran->create($kelahiranData);

            } catch (Exception $e) {
                DB::rollback();
                throw $e;
            }
            DB::commit();

            if ($failures) throw $failures;

            $statusCode = 200;
            $response = [
                'message' => 'Berhasil membuat data permohonan kelahiran.',
            ];
        } catch (Exception $e) {
            $response = [
                'error' => 'Gagal membuat data permohonan kelahiran.',
                'message' => $e->getMessage(),
            ];
            $statusCode = 400;
        } finally {
            return response()->json($response, $statusCode);
        }
    }

    public function update(Request $request, $id) {
        $user = $request->user();
        try {
            $kelahiranData = $request->all();
            $kelahiranData['id'] = $id;
            $validator = validator()->make($kelahiranData, [
                'anak.nama' => 'alpha',
                'anak.jenisKelamin' => 'in:laki-laki,perempuan',
                'anak.kotaLahirId' => 'numeric',
                'anak.golonganDarah' => 'string|in:A,B,AB,O',
                'anak.waktuLahir' => 'date',
                'anak.jenisLahir' => 'string',
                'anak.anakKe' => 'numeric',
                'anak.penolongKelahiran' => 'alpha',
                'anak.berat' => 'numeric',
                'anak.panjang' => 'numeric',
                'kelurahanId' => 'numeric',
                'instansiKesehatanId' => 'numeric',
                'kartuKeluargaId' => 'numeric',
                'aktaNikahId' => 'numeric',
                'ibuId' => 'numeric',
                'ayahId' => 'numeric',
                'saksiSatu.pendudukId' => 'numeric',
                'saksiSatu.email' => 'email',
                'saksiDua.pendudukId' => 'numeric',
                'saksiDua.email' => 'email',
                'pemohonId' => 'numeric',
                'status' => 'numeric|in:0,1,2',
            ]);

            if ($validator->fails()) throw new Exception(implode(" ", $validator->getMessageBag()->all()));

            ////////////////////////////////////////////////////////////////////////////////////////////////
            $kelahiran = $this->kelahiran->find($id);
            if (!$kelahiran) throw new Exception("No kelahiran found with id=$id.");

            if ($user['userable_type'] === 'MorphPenduduk') {
                if ($user['userable_id'] !== $kelahiran['pemohonId']) {
                    throw new Exception("Anda tidak memiliki otorisasi untuk mengedit permohonan kelahiran ini.");
                } else {
                    unset($kelahiranData['verifikasiSaksi1']);
                    unset($kelahiranData['verifikasiSaksi2']);
                    unset($kelahiranData['verifikasiInstansiKesehatan']);
                    unset($kelahiranData['verifikasiLurah']);
                    unset($kelahiranData['verifikasiAdmin']);
                    unset($kelahiranData['waktuCetakTerakhir']);

                    if (isset($kelahiranData['status']) && $kelahiranData['status'] > 1) { // !== 2
                        unset($kelahiranData['status']);
                    }

                    if ($kelahiran['status'] != 0) {
                        unset($kelahiranData['status']);
                    }

                    if (isset($kelahiranData['saksiSatu'])) {
                        $saksiSatu = \App\Saksi::find($kelahiran['saksiSatuId']);
                        $saksiSatuData = $kelahiranData['saksiSatu'];

                        if (isset($saksiSatuData['pendudukId']) && isset($saksiSatuData['email'])) {
                            if ($saksiSatu == null) {
                                $saksiSatu = \App\Saksi::create([
                                    'pendudukId' => $saksiSatuData['pendudukId'],
                                    'email' => $saksiSatuData['email'],
                                    'token' => Hash::make(str_random(255)),
                                ]);
                                SaksiController::sendVerificationEmail($saksiSatu['id'], $user->userable, $kelahiranData['anak'], $saksiSatuData['email']);
                            } else {
                                if ($saksiSatuData['pendudukId'] != $saksiSatu['pendudukId'] || $saksiSatuData['email'] != $saksiSatu['email']) {
                                    $saksiSatu['pendudukId'] = $saksiSatuData['pendudukId'];
                                    $saksiSatu['email'] = $saksiSatuData['email'];
                                    $saksiSatu['token'] = Hash::make(str_random(255));
                                    $saksiSatu->save();
                                    SaksiController::sendVerificationEmail($saksiSatu['id'], $user->userable, $kelahiranData['anak'], $saksiSatuData['email']);
                                }
                            }

                            unset($kelahiranData['saksiSatu']);
                            $kelahiranData['saksiSatuId'] = $saksiSatu->id;
                        }
                    }

                    if (isset($kelahiranData['saksiDua'])) {
                        $saksiDua = \App\Saksi::find($kelahiran['saksiDuaId']);
                        $saksiDuaData = $kelahiranData['saksiDua'];

                        if (isset($saksiDuaData['pendudukId']) && isset($saksiDuaData['email'])) {
                            if ($saksiDua == null) {
                                $saksiDua = \App\Saksi::create([
                                    'pendudukId' => $saksiDuaData['pendudukId'],
                                    'email' => $saksiDuaData['email'],
                                    'token' => Hash::make(str_random(255)),
                                ]);
                                SaksiController::sendVerificationEmail($saksiDua['id'], $user->userable, $kelahiranData['anak']['nama'], $saksiDuaData['email']);
                            } else {
                                if ($saksiDuaData['pendudukId'] != $saksiDua['pendudukId'] || $saksiDuaData['email'] != $saksiDua['email']) {
                                    $saksiDua['pendudukId'] = $saksiDuaData['pendudukId'];
                                    $saksiDua['email'] = $saksiDuaData['email'];
                                    $saksiDua['token'] = Hash::make(str_random(255));
                                    $saksiDua->save();

                                    SaksiController::sendVerificationEmail($saksiDua['id'], $user->userable, $kelahiranData['anak']['nama'], $saksiDuaData['email']);
                                }
                            }

                            unset($kelahiranData['saksiDua']);
                            $kelahiranData['saksiDuaId'] = $saksiDua->id;

                        }
                    }
                }
            } else if ($user['userable_type'] === 'MorphKelurahan') {
                if ($user['userable_id'] !== $kelahiran['kelurahanId']) {
                    throw new Exception("Anda tidak memiliki otorisasi untuk mengedit permohonan kelahiran ini.");
                } else {
                    $kelahiranData = [
                        'id' => $kelahiranData['id'],
                        'verifikasiLurah' => $kelahiranData['verifikasiLurah'],
                    ];
                }
            } else if ($user['userable_type'] === 'MorphInstansiKesehatan') {
                if ($user['userable_id'] !== $kelahiran['kelurahanId']) {
                    throw new Exception("Anda tidak memiliki otorisasi untuk mengedit permohonan kelahiran ini.");
                } else {
                    $kelahiranData = [
                        'id' => $kelahiranData['id'],
                        'verifikasiInstansiKesehatan' => $kelahiranData['verifikasiInstansiKesehatan'],
                    ];
                }
            } else if ($user['userable_type'] === 'MorphPegawai') {
                unset($kelahiranData['verifikasiSaksi1']);
                unset($kelahiranData['verifikasiSaksi2']);
                unset($kelahiranData['verifikasiSaksiInstansiKesehatan']);
                unset($kelahiranData['verifikasiSaksiLurah']);
                unset($kelahiranData['status']);
            } else {
                throw new Exception("Anda tidak memiliki otorisasi untuk mengedit permohonan kelahiran ini.");
            }

            //////////////////////////////////////////////////////////////
            if (isset($kelahiran['anakId']) && isset($kelahiranData['anak'])) {
                $anak = \App\Anak::find($kelahiran['anakId']);
                if (!$anak) throw new Exception("No anak found with id=$id.");
                $anakData = $kelahiranData['anak'];

                foreach ($anakData as $key => $value) {
                    $anak[$key] = $value;
                }
                $anak->save();
            }
            unset($kelahiranData['anak']);

            foreach ($kelahiranData as $key => $value) {
                if ($key !== 'status') {
                    $kelahiran[$key] = $value;
                }
            }

            if ($kelahiran['verifikasiSaksi1']
                && $kelahiran['verifikasiSaksi2']
                && $kelahiran['verifikasiInstansiKesehatan']
                && $kelahiran['verifikasiLurah']
                && $kelahiran['verifikasiAdmin']
                && $kelahiran['status'] == 1) {

                    $kelahiran['status'] = 2;
                    $this->makePenduduk($kelahiran);

            }


            if (isset($kelahiranData['status'])) {
                if ($kelahiranData['status'] == 1) {
                    $validatorAnak = validator()->make($anak->toArray(), [
                        'nama' => 'required|alpha',
                        'jenisKelamin' => 'required|in:laki-laki,perempuan',
                        'kotaLahirId' => 'required|numeric',
                        'golonganDarah' => 'required|string|in:A,B,AB,O',
                        'waktuLahir' => 'required|date',
                        'jenisLahir' => 'required|string',
                        'anakKe' => 'required|numeric',
                        'penolongKelahiran' => 'required|alpha',
                        'berat' => 'required|numeric',
                        'panjang' => 'required|numeric',
                    ]);

                    $validatorKelahiran = validator()->make($kelahiran->toArray(), [
                        'kelurahanId' => 'required|numeric',
                        'instansiKesehatanId' => 'required|numeric',
                        'kartuKeluargaId' => 'required|numeric',
                        'aktaNikahId' => 'required|numeric',
                        'ibuId' => 'required|numeric',
                        'ayahId' => 'required|numeric',
                        'saksiSatuId' => 'required|numeric',
                        'saksiDuaId' => 'required|numeric',
                        'pemohonId' => 'required|numeric',
                        'status' => 'required|numeric|in:0,1,2',
                    ]);

                    if ($validatorKelahiran->fails() || $validatorAnak->fails()) {
                        $kelahiran->save();
                        throw new Exception('Data pengajuan belum lengkap'
                            . implode(" \n", $validatorKelahiran->getMessageBag()->all())
                            . ' \n'
                            . implode(" \n", $validatorAnak->getMessageBag()->all())
                        );
                    }

                    $kelahiran['status'] = $kelahiranData['status'];
                }
            }

            $kelahiran->save();

            $statusCode = 200;
            $response = [
                'message' => 'Berhasil menyimpan data kelahiran.',
            ];
        } catch (Exception $e) {
            $response = [
                'error' => 'Gagal menyimpan data kelahiran.',
                'message' => $e->getMessage(),
            ];
            $statusCode = 400;
        } finally {
            return response()->json($response, $statusCode);
        }
    }

    public function destroy(Request $request, $id)
    {
        $user = $request->user();
        try {
            $kelahiran = $this->kelahiran->find($id);
            if (!$kelahiran) throw new Exception("No kelahiran found with id = $id.");

            $isAuthorized = false;
            if ($user['userable_type'] === 'MorphPenduduk') {
                if ($user['userable_id'] === $kelahiran['pemohonId'] && $kelahiran['status'] == 0) {
                    $isAuthorized = true;
                }
            } else if ($user['userable_type'] === 'MorphPegawai') {
                $isAuthorized = true;
            }

            if ($isAuthorized) {
                DB::beginTransaction();
                try {
                    $anak = \App\Anak::find($kelahiran['anakId']);
                    $anak->delete();
                    $kelahiran->delete();
                } catch (Exception $e) {
                    DB::rollback();
                    throw $e;
                }
                DB::commit();

                $statusCode = 200;
                $response = [
                    'message' => 'Berhasil menghapus data kelahiran.',
                ];
            } else {
                throw new Exception("Anda tidak memiliki otorisasi untuk menghapus data kelahiran dengan id = $id");
            }
        } catch (Exception $e) {
            $response = [
                'error' => 'Gagal menghapus data kelahiran.',
                'message' => $e->getMessage(),
            ];
            $statusCode = 400;
        } finally {
            return response()->json($response, $statusCode);
        }
    }

    public function makePenduduk(\App\Kelahiran $kelahiran)
    {
        $anak = $kelahiran->anak;
        $ayah = \App\Penduduk::findOrFail($kelahiran['ayahId']);
        $pendudukData = [
            'id' => \App\Penduduk::generateId($kelahiran['kelurahanId'], $anak['waktuLahir']),
            'nama' => $anak['nama'],
            'tanggal_lahir' => $anak['waktuLahir'],
            'tempat_lahir' => $anak['kotaLahirId'],
            'jenis_kelamin' => substr($anak['jenisKelamin'], 0, 1),
            'id_keluarga' => $kelahiran['kartuKeluargaId'],
            'id_ayah' => $kelahiran['ayahId'],
            'id_ibu' => $kelahiran['ibuId'],
            'hubungan_keluarga' => 'Anak',
            'golongan_darah' => $anak['golonganDarah'],
            'agama' => $ayah['agama'],
            'wni' => true,
            'status_perkawinan' => 'Belum Kawin',
            'status' => true,
        ];
        $penduduk = \App\Penduduk::create($pendudukData);
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
