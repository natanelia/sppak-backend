<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Provinsi;

class ProvinsiController extends Controller
{
    public function index(Request $request)
    {
        $start = $request->input('start') ? $request->input('start') : 0;
        $limit = $request->input('limit') ? $request->input('limit') : 100;

        $daftarProvinsi = Provinsi::limit($limit)->skip($start)->get();
        foreach ($daftarProvinsi as $provinsi) {
            $daftarKota = $provinsi->kota;
//            foreach ($daftarKota as $kota) {
//                $daftarKecamatan = $kota->kecamatan;
//            }
        }
        return response()->json(['data' => $daftarProvinsi]);
    }
}
