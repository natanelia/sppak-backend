<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;

use Carbon\Carbon;
use App\Http\Requests;

class StatistikController extends Controller
{

    public function __construct()
    {
        // $this->middleware('auth.basic', ['only' => ['getStatistikCBR', 'getStatistikFrekuensiKelahiran', 'getStatistikStatusPermohonan']]);
    }

    public function getStatistikCBR(Request $request) {
        $startYear = (int)$request->input('startYear');
        $endYear = (int)$request->input('endYear');

        try {
            $statusCode = 200;
            $response = [
                'data' => [[]],
                'series' => [],
                'labels' => [],
            ];

            $penduduks = \App\Penduduk::where('status', 1)->get();

            //mendaftar semua tanggal lahir
            $format = 'Y-m-d';
            $tanggalLahirs = [];
            foreach ($penduduks as $penduduk) {
                $tanggalLahirs[] = $penduduk['tanggal_lahir'];
            }
            //die(json_encode($tanggalLahirs[0]->year, JSON_PRETTY_PRINT));

            //mengisi labels
            for ($i = $startYear; $i <= $endYear; $i++) {
                $response['labels'][] = $i;
            }

            $birthCounts = [];
            $popCounts = [];

            for ($i = $startYear; $i <= $endYear; $i++) {
                $birthCounts[] = 0;
                $popCounts[] = 0;
            }

            foreach ($tanggalLahirs as $tanggalLahir) {
                for ($i = $startYear; $i <= $endYear; $i++) {
                    //mendapatkan count tanggal lahir untuk setiap year dalam $startYear - $endYear
                    if ($tanggalLahir->year == $i) {
                        $birthCounts[$i - $startYear] += 1;
                    }

                    //mendapatkan count populasi dari masing-masing year ke bawah
                    if ($tanggalLahir->year <= $i) {
                        $popCounts[$i - $startYear] += 1;
                    }
                }
            }


            //melakukan perhitungan CBR tanggal lahir / populasi * 1000
            for ($i = 0; $i < count($birthCounts); $i++) {
                if ($birthCounts[$i] == 0 || $popCounts[$i] == 0) {
                    $response['data'][0][] = 0;
                } else {
                    $response['data'][0][] = $birthCounts[$i] * 1000 / $popCounts[$i];
                }
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

    public function getStatistikFrekuensiKelahiran(Request $request) {

    }

    public function getStatistikStatusPermohonan(Request $request) {

    }
}
