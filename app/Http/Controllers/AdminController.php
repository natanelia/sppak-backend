<?php

namespace App\Http\Controllers;

use App\Admin;
use Exception;
use Illuminate\Http\Request;

use App\Http\Requests;

class AdminController extends Controller
{
    public function __construct()
    {
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

            $admins = Admin::all()->take(10);

            foreach ($admins as $admin) {
                $response['data'][] = [
                    'id' => $admin->id,
                    'nama' => $admin->nama,
                    'jenisKelamin' => $admin->jenisKelamin,
                    'tempatLahir' => $admin->tempatLahir,
                    'waktuLahir' => $admin->waktuLahir,
                    'jenisLahir' => $admin->jenisLahir,
                    'penolongKelahiran' => $admin->penolongKelahiran,
                    'berat' => $admin->berat,
                    'panjang' => $admin->panjang,
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
            $admin = Admin::find($id);
            $statusCode = 200;
            $response = [
                'data' => [
                    'id' => $admin->id,
                    'nama' => $admin->nama,
                    'jenisKelamin' => $admin->jenisKelamin,
                    'tempatLahir' => $admin->tempatLahir,
                    'waktuLahir' => $admin->waktuLahir,
                    'jenisLahir' => $admin->jenisLahir,
                    'penolongKelahiran' => $admin->penolongKelahiran,
                    'berat' => $admin->berat,
                    'panjang' => $admin->panjang,
                ],
            ];
        } catch (Exception $e) {
            $response = [
                'error' => 'Admin tidak ditemukan.',
            ];
            $statusCode = 404;
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
