<?php

namespace App\Http\Controllers;

use Hash;
use Mail;
use Exception;
use Illuminate\Http\Request;

use App\Http\Requests;

class SaksiController extends Controller
{
    public static function sendVerificationEmail($id, $penduduk, $anak, $emailTo) {
        $saksi = \App\Saksi::findOrFail($id);
        $pid = \App\Kelahiran::findOrFail($anak['id']);
        $data = [
            'penduduk' => [
                'nama' => $penduduk['nama'],
            ],
            'anak' => $anak,
            //'url' => action('www.sppak.dev', [
                //'id' => $saksi['id'],
                //'token' => urlencode($saksi['token']),
            //]),
            'url' => 'http://www.sppak.dev/#/saksi?id=' . $saksi['id'] . '&token=' . urlencode($saksi['token']) . '&pid=' . $pid['id'],
        ];

        Mail::send('emails.verifikasiSaksi', $data, function ($message) use ($emailTo) {
            $message->subject('[SPPAK] Permohonan Verifikasi Kelahiran')
                ->to($emailTo);
        });

        // return response()->json(['message' => "Email terkirim ke saksi dengan NIK $saksi[pendudukId]"], 200);
    }

    public function verifyBirth(Request $request, $id, $token) {
        try {
            $saksi = \App\Saksi::findOrFail($id);

            $token = urldecode($token);
            if ($saksi['token'] != $token) {
                throw new Exception("Invalid credentials.");
            }

            $kelahiran = \App\Kelahiran
                ::where('saksiSatuId', $id)
                ->orWhere('saksiDuaId', $id)
                ->first();

            if ($kelahiran == null) throw new Exception("Permohonan akta kelahiran tidak ditemukan.");
            $changed = false;
            if ($kelahiran['saksiSatuId'] == $id) {
                if (!$kelahiran['verifikasiSaksi1']) {
                    $kelahiran['verifikasiSaksi1'] = true;
                    $changed = true;
                }
            } else if ($kelahiran['saksiDuaId'] == $id) {
                if (!$kelahiran['verifikasiSaksi2']) {
                    $kelahiran['verifikasiSaksi2'] = true;
                    $changed = true;
                }
            }

            if ($changed) {
                $kelahiran->save();

                $saksi['token'] = Hash::make(str_random(255));
                $saksi->save();

                $response = [
                    'message' => 'Saksi berhasil melakukan verifikasi kelahiran.',
                ];
            } else {
                $response = [
                    'message' => 'Saksi sudah pernah melakukan verifikasi.',
                ];
            }

            $statusCode = 200;
        } catch (Exception $e) {
            $response = [
                'error' => $e->getMessage(),
            ];
            $statusCode = 400;
        } finally {
            return response()->json($response, $statusCode);
        }

    }
}
