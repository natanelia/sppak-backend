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
            $tanggalLahirs = [];
            foreach ($penduduks as $penduduk) {
                $tanggalLahirs[] = $penduduk['tanggal_lahir'];
            }

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
        $timeUnit = $request->input('timeUnit') ? $request->input('timeUnit') : 'day';
        $startDate = $request->input('startDate');
        $endDate = $request->input('endDate');

        $startDate = Carbon::createFromFormat('Y-m-d', $startDate);
        $endDate = Carbon::createFromFormat('Y-m-d', $endDate);

        try {
            $statusCode = 200;

            $response = [
                'data' => [[]],
                'series' => [],
                'labels' => [],
            ];

            switch ($timeUnit) {
                case 'day':
                    $startDate = $startDate->startOfDay();
                    $endDate = $endDate->endOfDay();

                    $penduduks = \App\Penduduk
                        ::where('status', 1)
                        ->where('tanggal_lahir', '>=', $startDate)
                        ->where('tanggal_lahir', '<=', $endDate)
                        ->get();

                    $iterator = $startDate->copy();
                    $i = 0;
                    while ($iterator->diffInDays($endDate) !== 0) {
                        $response['labels'][] = $iterator->format('j M Y');
                        $response['data'][0][] = 0;

                        foreach ($penduduks as $penduduk) {
                            if ($penduduk['tanggal_lahir']->day === $iterator->day && $penduduk['tanggal_lahir']->month === $iterator->month && $penduduk['tanggal_lahir']->year === $iterator->year) {
                                $response['data'][0][$i]++;
                            }
                        }

                        $iterator->addDay();
                        $i++;
                    }
                    $response['labels'][] = $iterator->format('j M Y');
                    $response['data'][0][] = 0;

                    foreach ($penduduks as $penduduk) {
                        if ($penduduk['tanggal_lahir']->day === $iterator->day && $penduduk['tanggal_lahir']->month === $iterator->month && $penduduk['tanggal_lahir']->year === $iterator->year) {
                            $response['data'][0][$i]++;
                        }
                    }

                    break;
                case 'month':
                    $startDate = $startDate->startOfMonth();
                    $endDate = $endDate->endOfMonth();

                    $penduduks = \App\Penduduk
                        ::where('status', 1)
                        ->where('tanggal_lahir', '>=', $startDate)
                        ->where('tanggal_lahir', '<=', $endDate)
                        ->get();

                    $iterator = $startDate->copy();
                    $i = 0;
                    while ($iterator->diffInMonths($endDate) !== 0) {
                        $response['labels'][] = $iterator->format('M Y');
                        $response['data'][0][] = 0;

                        foreach ($penduduks as $penduduk) {
                            if ($penduduk['tanggal_lahir']->month === $iterator->month && $penduduk['tanggal_lahir']->year === $iterator->year) {
                                $response['data'][0][$i]++;
                            }
                        }

                        $iterator->addMonth();
                        $i++;
                    }
                    $response['labels'][] = $iterator->format('M Y');
                    $response['data'][0][] = 0;

                    foreach ($penduduks as $penduduk) {
                        if ($penduduk['tanggal_lahir']->month === $iterator->month && $penduduk['tanggal_lahir']->year === $iterator->year) {
                            $response['data'][0][$i]++;
                        }
                    }

                    break;
                 case 'year':
                    $startDate = $startDate->startOfYear();
                    $endDate = $endDate->endOfYear();

                    $penduduks = \App\Penduduk
                        ::where('status', 1)
                        ->where('tanggal_lahir', '>=', $startDate)
                        ->where('tanggal_lahir', '<=', $endDate)
                        ->get();

                    $iterator = $startDate->copy();
                    $i = 0;
                    while ($iterator->diffInYears($endDate) !== 0) {
                        $response['labels'][] = $iterator->format('Y');
                        $response['data'][0][] = 0;

                        foreach ($penduduks as $penduduk) {
                            if ($penduduk['tanggal_lahir']->year === $iterator->year) {
                                $response['data'][0][$i]++;
                            }
                        }

                        $iterator->addYear();
                        $i++;
                    }
                    $response['labels'][] = $iterator->format('Y');
                    $response['data'][0][] = 0;

                    foreach ($penduduks as $penduduk) {
                        if ($penduduk['tanggal_lahir']->year === $iterator->year) {
                            $response['data'][0][$i]++;
                        }
                    }

                    break;
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

    public function getStatistikStatusPermohonan(Request $request) {
        $timeUnit = $request->input('timeUnit') ? $request->input('timeUnit') : 'day';
        $startDate = $request->input('startDate');
        $endDate = $request->input('endDate');

        $startDate = Carbon::createFromFormat('Y-m-d', $startDate);
        $endDate = Carbon::createFromFormat('Y-m-d', $endDate);

        try {
            $statusCode = 200;

            $response = [
                'data' => [[],[],[]],
                'series' => [
                    'Belum Diajukan',
                    'Diajukan',
                    'Diterima',
                    'Ditolak',
                ],
                'labels' => [],
            ];

            switch ($timeUnit) {
                case 'day':
                    $startDate = $startDate->startOfDay();
                    $endDate = $endDate->endOfDay();

                    $kelahirans = \App\Kelahiran
                        ::where('updated_at', '>=', $startDate)
                        ->where('updated_at', '<=', $endDate)
                        ->get();

                    $iterator = $startDate->copy();
                    $i = 0;
                    while ($iterator->diffInDays($endDate) !== 0) {
                        $response['labels'][] = $iterator->format('j M Y');
                        for ($j = 0; $j < count($response['series']); $j++) {
                            $response['data'][$j][] = 0;
                        }

                        foreach ($kelahirans as $kelahiran) {
                            if ($kelahiran['updated_at']->day === $iterator->day && $kelahiran['updated_at']->month === $iterator->month && $kelahiran['updated_at']->year === $iterator->year) {
                                $response['data'][(int)$kelahiran['status']][$i]++;
                            }
                        }

                        $iterator->addDay();
                        $i++;
                    }
                    $response['labels'][] = $iterator->format('j M Y');
                    for ($j = 0; $j < count($response['series']); $j++) {
                        $response['data'][$j][] = 0;
                    }

                    foreach ($kelahirans as $kelahiran) {
                        if ($kelahiran['updated_at']->day === $iterator->day && $kelahiran['updated_at']->month === $iterator->month && $kelahiran['updated_at']->year === $iterator->year) {
                            $response['data'][(int)$kelahiran['status']][$i]++;
                        }
                    }

                    break;
                case 'month':
                    $startDate = $startDate->startOfMonth();
                    $endDate = $endDate->endOfMonth();

                    $kelahirans = \App\Kelahiran
                        ::where('updated_at', '>=', $startDate)
                        ->where('updated_at', '<=', $endDate)
                        ->get();

                    $iterator = $startDate->copy();
                    $i = 0;
                    while ($iterator->diffInMonths($endDate) !== 0) {
                        $response['labels'][] = $iterator->format('M Y');
                        for ($j = 0; $j < count($response['series']); $j++) {
                            $response['data'][$j][] = 0;
                        }

                        foreach ($kelahirans as $kelahiran) {
                            if ($kelahiran['updated_at']->month === $iterator->month && $kelahiran['updated_at']->year === $iterator->year) {
                                $response['data'][(int)$kelahiran['status']][$i]++;
                            }
                        }

                        $iterator->addMonth();
                        $i++;
                    }
                    $response['labels'][] = $iterator->format('M Y');
                    for ($j = 0; $j < count($response['series']); $j++) {
                        $response['data'][$j][] = 0;
                    }

                    foreach ($kelahirans as $kelahiran) {
                        if ($kelahiran['updated_at']->month === $iterator->month && $kelahiran['updated_at']->year === $iterator->year) {
                            $response['data'][(int)$kelahiran['status']][$i]++;
                        }
                    }

                    break;
                 case 'year':
                    $startDate = $startDate->startOfYear();
                    $endDate = $endDate->endOfYear();

                    $kelahirans = \App\Kelahiran
                        ::where('updated_at', '>=', $startDate)
                        ->where('updated_at', '<=', $endDate)
                        ->get();

                    $iterator = $startDate->copy();
                    $i = 0;
                    while ($iterator->diffInYears($endDate) !== 0) {
                        $response['labels'][] = $iterator->format('Y');
                        for ($j = 0; $j < count($response['series']); $j++) {
                            $response['data'][$j][] = 0;
                        }

                        foreach ($kelahirans as $kelahiran) {
                            if ($kelahiran['updated_at']->year === $iterator->year) {
                                $response['data'][(int)$kelahiran['status']][$i]++;
                            }
                        }

                        $iterator->addYear();
                        $i++;
                    }
                    $response['labels'][] = $iterator->format('Y');
                    for ($j = 0; $j < count($response['series']); $j++) {
                        $response['data'][$j][] = 0;
                    }

                    foreach ($kelahirans as $kelahiran) {
                        if ($penduduk['updated_at']->year === $iterator->year) {
                            $response['data'][(int)$kelahiran['status']][$i]++;
                        }
                    }

                    break;
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
}
