<?php

namespace App\Http\Controllers;

use App\Models\KecamatanModel;

use Illuminate\Http\Request;

class KecamatanController extends Controller
{
    public function __construct()
    {
        // $this->middleware('auth');
        $this->KecamatanModel = new KecamatanModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Kecamatan',
            'kecamatan' => $this->KecamatanModel->AllData(),
        ];
        return view('admin.kecamatan.index', $data);
    }

    //Tambah Kecamatan
    public function create()
    {
        $data = [
            'title' => 'Tambah Kecamatan',
        ];
        return view('admin.kecamatan.create', $data);
    }

    public function store()
    {
        Request()->validate(
            [
                'kecamatan' => 'required',
                'warna' => 'required',
                'geojson' => 'required',
            ],
            [
                'kecamatan.required' => 'Wajib diisi !!!',
                'warna.required' => 'Wajib diisi !!!',
                'geojson.required' => 'Wajib diisi !!!',
            ]
        );

        $Kecamatan = [
            'nama_kecamatan' => Request()->kecamatan,
            'warna' => Request()->warna,
            'geojson' => Request()->geojson,
        ];
        $this->KecamatanModel->addData($Kecamatan);
        return redirect()->route('Kecamatan')->with('pesan', 'Data berhasil ditambahkan');
    }

    public function edit($id_kecamatan)
    {

        $data = [
            'title' => 'Edit Kecamatan',
            'kecamatan' => $this->KecamatanModel->KecamatanById($id_kecamatan),

        ];
        return view('admin.kecamatan.edit', $data);
    }

    public function update($id_kecamatan)
    {
        Request()->validate(
            [
                'kecamatan' => 'required',
                'warna' => 'required',
                'geojson' => 'required',
            ],
            [
                'kecamatan.required' => 'Wajib diisi !!!',
                'warna.required' => 'Wajib diisi !!!',
                'geojson.required' => 'Wajib diisi !!!',
            ]
        );

        $Kecamatan = [
            'nama_kecamatan' => Request()->kecamatan,
            'warna' => Request()->warna,
            'geojson' => Request()->geojson,
        ];
        $this->KecamatanModel->UpdateKecamatan($id_kecamatan, $Kecamatan);
        return redirect()->route('Kecamatan')->with('pesan', 'Data berhasil diubah');
    }

    public function delete($id_kecamatan)
    {
        $this->KecamatanModel->DeleteKecamatan($id_kecamatan);
        return redirect()->route('Kecamatan')->with('pesan', 'Data berhasil dihapus');
    }
}
