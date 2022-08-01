<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\WebModel;

class WebController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->WebModel = new WebModel();
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $data = [
            'title' => 'Sistem Informasi Geografis Persebaran Vaksinasi Kabupaten Sukoharjo',
            'kecamatan' => $this->WebModel->DataKecamatan(),
            // 'jenis' => $this->WebModel->DataJenis(),
            'vaksin' => $this->WebModel->AllDataVaksin(),
        ];
        return view('v_web', $data);
    }

    public function cari()
    {
        Request()->validate(
            [
                'cari' => 'required',
            ],
            [
                'cari.required' => 'Tidak Boleh Kosong !!!',
            ]
        );

        $cari = Request()->cari;
        $data = [
            'title' => 'Cari Tempat Vaksin',
            'kecamatan' => $this->WebModel->DataKecamatan(),
            // 'jenis' => $this->WebModel->DataJenis(),
            'cari' => $cari,
            'vaksin' => $this->WebModel->CariDataVaksin($cari),
        ];
        return view('v_cari', $data);
    }

    public function tempatvaksin()
    {
        $data = [
            'title' => 'Tempat Vaksinasi Di Kab.Sukoharjo ',
            'vaksin' => $this->WebModel->TempatVaksin(),
            'kecamatan' => $this->WebModel->DataKecamatan(),
        ];

        return view('v_tempatVaksin', $data);
    }

    // public function jenis($id_jenis)
    // {
    //     $jns = $this->WebModel->JenisById($id_jenis);
    //     $data = [
    //         'title' => 'Pemetaan Tempat Vaksin ' . $jns->jenis_vak,
    //         'kecamatan' => $this->WebModel->DataKecamatan(),
    //         'jenis' => $this->WebModel->DataJenis(),
    //         'jns' => $jns,
    //         'ibadah' => $this->WebModel->DataIbadahbyJenis($id_jenis),
    //     ];

    //     return view('v_jenis', $data);
    // }

    public function detail($id_tempatVaksin)
    {
        $tvaksin = $this->WebModel->DataVaksinById($id_tempatVaksin);
        $data = [
            'title' => 'Detail Tempat Vaksin ' . $tvaksin->nama_tempatVaksin,
            'kecamatan' => $this->WebModel->DataKecamatan(),
            // 'jenis' => $this->WebModel->DataJenis(),
            'vaksin' => $this->WebModel->DataVaksinById($id_tempatVaksin),
        ];

        return view('v_detail', $data);
    }
}
