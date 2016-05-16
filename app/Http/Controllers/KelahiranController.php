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

        $this->middleware('auth.basic', ['only' => ['index', 'show', 'store', 'update', 'destroy']]);
    }

    public function index(Request $request)
    {
        $user = $request->user();
        try {
            $statusCode = 200;
            $response = [
                'data' => []
            ];

            $limit = $request->input('limit') ? $request->input('limit') : 1000;
            $start = $request->input('start') ? $request->input('start') : 0;

            if ($user) {
                if ($user['userable_type'] === 'MorphPenduduk') {
                    // kalo penduduk, dia hanya bisa lihat kelahiran yang pemohonId / ibuId / ayahId nya sama dengan userable_id
                    $kelahirans = \App\Kelahiran
                        ::limit($limit)
                        ->skip($start)
                        ->where('pemohonId', $user['userable_id'])
                        //->orWhere('ibuId', $user['userable_id'])
                        //->orWhere('ayahId', $user['userable_id'])
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
                    $kelahiran->pendudukId;
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
            $kelahiran->pendudukId;
            $response = [
                'data' => $kelahiran,
            ];
        } catch (Exception $e) {
            $response = [
                'error' => 'Kelahiran tidak ditemukan.',
                'message' => $e->getMessage(),
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
            if ($user['userable_type'] !== 'MorphPenduduk') throw new Exception("Hanya penduduk yang dapat membuat permohonan akta kelahiran.");

            $kelahiranData = $request->all();
            $validator = validator()->make($kelahiranData, [
                'anak.nama' => 'required|string',
                'anak.jenisKelamin' => 'required|in:laki-laki,perempuan',
                'anak.kotaLahirId' => 'required|numeric',
                'anak.golonganDarah' => 'required|string|in:A,B,AB,O',
            ]);

            if ($validator->fails()) throw new Exception(implode(" ", $validator->getMessageBag()->all()));

            foreach ($kelahiranData as $key => $value) {
                if ($value === null) {
                    unset($kelahiranData[$key]);
                }
            }
            $kelahiranData['pemohonId'] = $user->userable_id;

            $kelahiranToCreate = [
              'anak' => [
                'nama' => $kelahiranData['anak']['nama'],
                'jenisKelamin' => $kelahiranData['anak']['jenisKelamin'],
                'kotaLahirId' => $kelahiranData['anak']['kotaLahirId'],
                'golonganDarah' => $kelahiranData['anak']['golonganDarah'],
              ],
              'pemohonId' => $kelahiranData['pemohonId'],
            ];

            //////////////////////////////////////////////////////////////
            $result = null;
            DB::beginTransaction();
            try {
                $anak = \App\Anak::create($kelahiranToCreate['anak']);

                $kelahiranToCreate['anakId'] = $anak->id;
                unset($kelahiranToCreate['anak']);

                $kelahiran = $this->kelahiran->create($kelahiranToCreate);
                $result = $this->updateKelahiran($kelahiranData, $user, $kelahiran->id);

                if ($result->status() !== 200) {
                  throw new Exception(json_decode($result->content(), true)['message']);
                }
            } catch (Exception $e) {
                DB::rollback();
                throw $e;
            }
            DB::commit();

            return $result;
        } catch (Exception $e) {
            $response = [
                'error' => 'Gagal membuat data permohonan kelahiran.',
                'message' => $e->getMessage(),
            ];
            $statusCode = 400;
            return response()->json($response, $statusCode);
        }
    }

    public function update(Request $request, $id) {
        $user = $request->user();
        $kelahiranData = $request->all();
        return $this->updateKelahiran($kelahiranData, $user, $id);
    }

    public function updateKelahiran($kelahiranData, $user, $id) {
      try {
          $errors = [];
          $kelahiranData['id'] = $id;
          $validator = validator()->make($kelahiranData, [
              'anak.nama' => 'string',
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
              'status' => 'numeric|in:0,1,2,3',
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
                      throw new Exception("Anda tidak dapat mengubah permohonan yang sudah diajukan");
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
                              if ($kelahiran['status'] == 1 || (isset($kelahiranData['status']) && $kelahiranData['status'] == 1)) {
                                  SaksiController::sendVerificationEmail($saksiSatu['id'], $user->userable, $kelahiranData['anak'], $saksiSatuData['email'], $kelahiran['id']);
                              }
                          } else {
                              if ($saksiSatuData['pendudukId'] != $saksiSatu['pendudukId'] || $saksiSatuData['email'] != $saksiSatu['email']) {
                                  $saksiSatu['pendudukId'] = $saksiSatuData['pendudukId'];
                                  $saksiSatu['email'] = $saksiSatuData['email'];
                                  $saksiSatu['token'] = Hash::make(str_random(255));
                                  $saksiSatu->save();
                              }
                              if ($kelahiran['status'] == 1 || (isset($kelahiranData['status']) && $kelahiranData['status'] == 1)) {
                                  SaksiController::sendVerificationEmail($saksiSatu['id'], $user->userable, $kelahiranData['anak'], $saksiSatuData['email'], $kelahiran['id']);
                              }
                          }
                          unset($kelahiranData['saksiSatu']);
                          $kelahiranData['saksiSatuId'] = $saksiSatu['id'];
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
                              if ($kelahiran['status'] == 1 || (isset($kelahiranData['status']) && $kelahiranData['status'] == 1)) {
                                  SaksiController::sendVerificationEmail($saksiDua['id'], $user->userable, $kelahiranData['anak']['nama'], $saksiDuaData['email'], $kelahiran['id']);
                              }
                          } else {
                              if ($saksiDuaData['pendudukId'] != $saksiDua['pendudukId'] || $saksiDuaData['email'] != $saksiDua['email']) {
                                  $saksiDua['pendudukId'] = $saksiDuaData['pendudukId'];
                                  $saksiDua['email'] = $saksiDuaData['email'];
                                  $saksiDua['token'] = Hash::make(str_random(255));
                                  $saksiDua->save();
                              }
                              if ($kelahiran['status'] == 1 || (isset($kelahiranData['status']) && $kelahiranData['status'] == 1)) {
                                  SaksiController::sendVerificationEmail($saksiDua['id'], $user->userable, $kelahiranData['anak'], $saksiDuaData['email'], $kelahiran['id']);
                              }
                          }

                          unset($kelahiranData['saksiDua']);
                          $kelahiranData['saksiDuaId'] = $saksiDua['id'];
                      }
                  }
              }
          } else if ($user['userable_type'] === 'MorphKelurahan') {
              if ($user['userable_id'] != $kelahiran['kelurahanId']) {
                  throw new Exception("Anda tidak memiliki otorisasi untuk mengedit permohonan kelahiran ini.");
              } else {
                  $kelahiranData = [
                      'id' => $kelahiranData['id'],
                      'verifikasiLurah' => $kelahiranData['verifikasiLurah'],
                  ];
              }
          } else if ($user['userable_type'] === 'MorphInstansiKesehatan') {
              if ($user['userable_id'] != $kelahiran['instansiKesehatanId']) {
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
              unset($kelahiranData['verifikasiInstansiKesehatan']);
              unset($kelahiranData['verifikasiSaksiLurah']);
          } else {
              throw new Exception("Anda tidak memiliki otorisasi untuk mengedit permohonan kelahiran ini.");
          }

          //////////////////////////////////////////////////////////////
          if (isset($kelahiran['anakId']) && isset($kelahiranData['anak'])) {
              $anak = \App\Anak::find($kelahiran['anakId']);
              if (!$anak) throw new Exception("No anak found with id=$id.");
              $anakData = $kelahiranData['anak'];

              unset($anakData['kota_lahir']);
              foreach ($anakData as $key => $value) {
                $anak[$key] = $value;
              }
              $anak->save();
          }
          unset($kelahiranData['anak']);

          if (isset($kelahiranData['kartuKeluargaId'])) {
              $keluarga = \App\Keluarga::find($kelahiranData['kartuKeluargaId']);
              if ($keluarga !== null) {
                $kelurahan = $keluarga->RT->RW->kelurahan;
                if ($kelurahan !== null) {
                    $kelahiranData['kelurahanId'] = $kelurahan['id'];
                }
              }
          }

          $ktpApiUrl = env('KTP_BASE_API_URL') . '/permohonan_ktps';
          $ktpByNikUrl = $ktpApiUrl . "/ktp-by-nik";

          if (isset($kelahiranData['ayahId'])) {
              $res = json_decode(file_get_contents($ktpByNikUrl . '/' . $kelahiranData['ayahId']), true);
              if ($res['data'] !== 'No data available') {
                  $ayah = \App\Penduduk::find($kelahiranData['ayahId']);
                  if ($ayah !== null) {
                    if ($ayah['id_keluarga'] != $kelahiranData['kartuKeluargaId']) {
                      array_push($errors, "Ayah tidak terdaftar pada KK Nomor $kelahiranData[kartuKeluargaId].");
                      unset($kelahiranData['ayahId']);
                    } else if ($ayah['jenis_kelamin'] != 'l') {
                      array_push($errors, "Ayah harus berjenis kelamin pria.");
                      unset($kelahiranData['ayahId']);
                    }
                  }
              } else {
                  array_push($errors, "Ayah belum memiliki KTP.");
                  unset($kelahiranData['ayahId']);
              }

              if (isset($kelahiranData['ayahId'])) {
                if ((isset($saksiSatuData) && $kelahiranData['ayahId'] === $saksiSatuData['pendudukId'])
                  || (isset($saksiDuaData) && $kelahiranData['ayahId'] === $saksiDuaData['pendudukId'])) {
                    unset($kelahiranData['ayahId']);
                    array_push($errors, "Ayah tidak boleh menjadi saksi.");
                }
              }
          }

          if (isset($kelahiranData['ibuId'])) {
              $res = json_decode(file_get_contents($ktpByNikUrl . '/' . $kelahiranData['ibuId']), true);
              if ($res['data'] !== 'No data available') {
                $ibu = \App\Penduduk::find($kelahiranData['ibuId']);
                if ($ibu !== null) {
                  if ($ibu['id_keluarga'] != $kelahiranData['kartuKeluargaId']) {
                    array_push($errors, "Ibu tidak terdaftar pada KK Nomor $kelahiranData[kartuKeluargaId].");
                    unset($kelahiranData['ibuId']);
                  } else if ($ibu['jenis_kelamin'] != 'p') {
                    array_push($errors, "Ibu harus berjenis kelamin wanita.");
                    unset($kelahiranData['ibuId']);
                  }
                }
              } else {
                  array_push($errors, "Ibu belum memiliki KTP.");
                  unset($kelahiranData['ibuId']);
              }

              if (isset($kelahiranData['ibuId'])) {
                if ((isset($saksiSatuData) && $kelahiranData['ibuId'] === $saksiSatuData['pendudukId'])
                  || (isset($saksiDuaData) && $kelahiranData['ibuId'] === $saksiDuaData['pendudukId'])) {
                    unset($kelahiranData['ibuId']);
                    array_push($errors, "Ibu tidak boleh menjadi saksi.");
                }
              }
          }

          if ((isset($kelahiranData['ibuId']) && isset($kelahiranData['ayahId'])) && isset($kelahiranData['aktaNikahId'])) {
            $nikahAPIUrl = env('NIKAH_BASE_API_URL') . '/aktaAPI.php';
            $res = json_decode(file_get_contents($nikahAPIUrl . '?' . 'nik_suami=' . $kelahiranData['ayahId'] . '&nik_istri=' . $kelahiranData['ibuId'] . '&id=' . $kelahiranData['aktaNikahId']), true);
            if ($res['id'] == 0) {
              array_push($errors, "Akta nikah ayah dan ibu tidak memiliki nomor yang benar atau tidak terdaftar.");
              unset($kelahiranData['aktaNikahId']);
            }
          }

          if (isset($kelahiranData['kartuKeluargaId'])) {
            $kkApiUrl = env('KTP_BASE_API_URL') . '/pengajuan_permohonan_kks/is-kk-available/' . $kelahiranData['kartuKeluargaId'];
            $res = json_decode(file_get_contents($kkApiUrl), true);
            if (!$res['message']) {
              array_push($errors, "Kartu Keluarga belum terdaftar.");
              unset($kelahiranData['kartuKeluargaId']);
            }
          }

          foreach ($kelahiranData as $key => $value) {
              if ($key != 'status') {
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

                  // tambah penduduk di kk
                  $this->addPendudukOnKK($kelahiran);
          }

          if (isset($kelahiranData['status'])) {
              if ($kelahiranData['status'] == 1) {
                  $validatorAnak = validator()->make($anak->toArray(), [
                      'nama' => 'required|string',
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

                  if ($validatorKelahiran->fails() || $validatorAnak->fails() || count($errors) > 0) {
                      $kelahiran->save();
                      throw new Exception('Data pengajuan belum lengkap. '
                          . implode(" \n", $errors)
                          . ' '
                          . implode(" \n", $validatorKelahiran->getMessageBag()->all())
                          . ' '
                          . implode(" \n", $validatorAnak->getMessageBag()->all())
                      );
                  }

                  $kelahiran['status'] = $kelahiranData['status'];
              } else {
                if (count($errors) > 0) {
                  $kelahiran->save();
                  throw new Exception(implode(" ", $errors));
                } else {
                  $kelahiran['status'] = $kelahiranData['status'];
                }
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
              'stack' => $e->getTraceAsString(),
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
            $kelahiran = \App\Kelahiran::find($id);
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
                    $kelahiran->delete();
                    $anak->delete();
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
        $newId = \App\Penduduk::generateId($kelahiran['kelurahanId'], $anak['waktuLahir']);
        $pendudukData = [
            'id' => $newId,
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

        $kelahiranPendudukData = [
          'kelahiranId' => $kelahiran['id'],
          'pendudukId' => $newId,
        ];
        $kelahiranPenduduk = \App\KelahiranPenduduk::create($kelahiranPendudukData);
    }

    public function addPendudukOnKK(\App\Kelahiran $kelahiran){
		$ktpApiUrl = env('KTP_BASE_API_URL') . '/pengajuan_permohonan_kks/add-anak/';

		$noKK = $kelahiran['kartuKeluargaId'];
		$nikAnak = $kelahiran['anakId'];
		$pemohon = \App\Penduduk::findOrFail($kelahiran['pemohonId']);
		$pemohonId = $pemohon['id'];

		// method post to KTP API
		// taken from http://thisinterestsme.com/sending-json-via-post-php/

		$data = array(
			'noKK' => $noKK,
			'nikAnak' => $nikAnak,
			'pemohonId' => $pemohonId
		);
		$jsonData = json_encode($data);

		//Initiate cURL.
		$ch = curl_init($ktpApiUrl);

		//Tell cURL that we want to send a POST request.
		curl_setopt($ch, CURLOPT_POST, 1);

		//Attach our encoded JSON string to the POST fields.
		curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonData);

		//Set the content type to application/json
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));

		//Execute the request
		$result = curl_exec($ch);
	}
}
