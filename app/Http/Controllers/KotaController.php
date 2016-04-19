<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Kota;

class KotaController extends Controller
{
    public function index(Request $request)
    {
        $start = $request->input('start') ? $request->input('start') : 0;
        $limit = $request->input('limit') ? $request->input('limit') : 100;

        $daftarKota = Kota::limit($limit)->skip($start)->get();
        foreach ($daftarKota as $kota) {
            $kota->provinsi;
//            foreach ($daftarKota as $kota) {
//                $daftarKecamatan = $kota->kecamatan;
//            }
        }
        return response()->json(['data' => $daftarKota]);
    }
}
