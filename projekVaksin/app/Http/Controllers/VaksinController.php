<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\KecamatanModel;
use App\Models\VaksinModel;

class VaksinController extends Controller
{
    public function __construct()
    {
        // $this->middleware('auth');
        $this->VaksinModel = new VaksinModel();
        $this->KecamatanModel = new KecamatanModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Tempat Vaksin',
            'vaksin' => $this->VaksinModel->AllData(),
        ];
        return view('admin.tempatvaksin.index', $data);
    }

    //Tambah Tempat vaksin
    public function create()
    {
        $data = [
            'title' => 'Tambah Tempat Vaksin',
            'kecamatan' => $this->KecamatanModel->AllData(),
        ];
        return view('admin.tempatvaksin.create', $data);
    }

    public function store()
    {
        Request()->validate(
            [
                'tempatvaksin' => 'required',
                'kecamatan' => 'required',
                'alamat' => 'required',
                'fasilitas' => 'required',
                'posisi' => 'required',
                'foto' => 'max:1024',
            ],
            [
                'tempatvaksin.required' => 'Wajib diisi !!!',
                'kecamatan.required' => 'Wajib diisi !!!',
                'alamat.required' => 'Wajib diisi !!!',
                'fasilitas.required' => 'Wajib diisi !!!',
                'posisi.required' => 'Wajib diisi !!!',
                'foto.max' => 'Maksimal ukuran 1024 KB',
            ]
        );

        if (Request()->foto <> "") {
            $file = Request()->foto;
            $filename = $file->getClientOriginalName();
            $file->move(public_path('foto'), $filename);

            $Tempatvaksin = [
                'nama_tempatvaksin' => Request()->tempatvaksin,
                'alamat' => Request()->alamat,
                'fasilitas' => Request()->fasilitas,
                'posisi' => Request()->posisi,
                'foto' => $filename,
                'id_kecamatan' => Request()->kecamatan,
            ];

            $this->VaksinModel->addData($Tempatvaksin);
        } else {
            $Tempatvaksin = [
                'nama_tempatvaksin' => Request()->tempatvaksin,
                'alamat' => Request()->alamat,
                'fasilitas' => Request()->fasilitas,
                'posisi' => Request()->posisi,
                'id_kecamatan' => Request()->kecamatan,
            ];

            $this->VaksinModel->addData($Tempatvaksin);
        }

        return redirect()->route('TempatVaksin')->with('pesan', 'Data berhasil ditambahkan');
    }

    public function edit($id_tempatvaksin)
    {

        $data = [
            'title' => 'Edit Tempat vaksin',
            // 'jenis' => $this->JenisModel->AllData(),
            'kecamatan' => $this->KecamatanModel->AllData(),
            'tempatVaksin' => $this->VaksinModel->TempatvaksinById($id_tempatvaksin),

        ];
        return view('admin.tempatvaksin.edit', $data);
    }

    public function update($id_tempatvaksin)
    {
        Request()->validate(
            [
                'tempatvaksin' => 'required',
                'kecamatan' => 'required',
                'alamat' => 'required',
                'fasilitas' => 'required',
                'posisi' => 'required',
                'foto' => 'max:1024',
            ],
            [
                'tempatvaksin.required' => 'Wajib diisi !!!',
                'kecamatan.required' => 'Wajib diisi !!!',
                'alamat.required' => 'Wajib diisi !!!',
                'fasilitas.required' => 'Wajib diisi !!!',
                'posisi.required' => 'Wajib diisi !!!',
                'foto.max' => 'Maksimal ukuran 1024 KB',
            ]
        );

        if (Request()->foto <> "") {
            $vaksin = $this->VaksinModel->TempatvaksinById($id_tempatvaksin);
            if ($vaksin->foto <> "") {
                unlink(public_path('foto') . '/' . $vaksin->foto);
            }
            $file = Request()->foto;
            $filename = $file->getClientOriginalName();
            $file->move(public_path('foto'), $filename);

            $Tempatvaksin = [
                'nama_tempatvaksin' => Request()->tempatvaksin,
                'alamat' => Request()->alamat,
                'fasilitas' => Request()->fasilitas,
                'posisi' => Request()->posisi,
                'foto' => $filename,
                'id_kecamatan' => Request()->kecamatan,
            ];

            $this->VaksinModel->UpdateTempatvaksin($id_tempatvaksin, $Tempatvaksin);
        } else {
            $Tempatvaksin = [
                'nama_tempatvaksin' => Request()->tempatvaksin,
                'alamat' => Request()->alamat,
                'fasilitas' => Request()->fasilitas,
                'posisi' => Request()->posisi,
                'id_kecamatan' => Request()->kecamatan,
            ];

            $this->VaksinModel->UpdateTempatvaksin($id_tempatvaksin, $Tempatvaksin);
        }

        return redirect()->route('TempatVaksin')->with('pesan', 'Data berhasil diupdate');
    }

    public function delete($id_vaksin)
    {
        $vaksin = $this->VaksinModel->TempatvaksinById($id_vaksin);
        if ($vaksin->foto <> "") {
            unlink(public_path('foto') . '/' . $vaksin->foto);
        }

        $this->VaksinModel->Deletevaksin($id_vaksin);
        return redirect()->route('TempatVaksin')->with('pesan', 'Data berhasil dihapus');
    }
}
