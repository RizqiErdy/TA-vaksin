<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\JadwalModel;
use App\Models\VaksinModel;

class JadwalController extends Controller
{
    public function __construct()
    {
        // $this->middleware('auth');
        $this->JadwalModel = new JadwalModel();
        $this->VaksinModel = new VaksinModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Jadwal',
            'vaksin' => $this->VaksinModel->AllData(),
            'jadwal'=>$this->JadwalModel->AllData(),
        ];
        return view('admin.jadwal.index',$data);
    }

    public function store()
    {
        Request()->validate(
            [
                'tanggal' => 'required',
                'jam_mulai' => 'required',
                'jam_selesai' => 'required',
                'jenis_vaksin' => 'required',
                'tipe_vaksin' => 'required',
                'jenis_vaksin' => 'required',
                'tempatVaksin' => 'required',
            ],
            [
                'tanggal.required' => 'Wajib diisi !!!',
                'jam_mulai.required' => 'Wajib diisi !!!',
                'jam_selesai.required' => 'Wajib diisi !!!',
                'tipe_vaksin.required' => 'Wajib diisi !!!',
                'jenis_vaksin.required' => 'Wajib diisi !!!',
                'tempatVaksin.required' => 'Wajib diisi !!!',
            ]
        );
        $tgl = Request()->tanggal;
        $t = date('Y-m-d',strtotime($tgl));

        $jadwal = [
            'tanggal'=> $t,
            'jam_mulai'=> Request()->jam_mulai,
            'jam_selesai'=> Request()->jam_selesai,
            'jenis_vaksin' => Request()->jenis_vaksin,
            'tipe_vaksin' => Request()->tipe_vaksin,
            'id_tempatVaksin' => Request()->tempatVaksin,
        ];

        $this->JadwalModel->addData($jadwal);
        return redirect()->route('JadwalVaksin')->with('pesan', 'Data berhasil ditambahkan');
    }
    
    public function delete($id_jadwalVaksin)
    {
        $this->JadwalModel->DeleteJadwal($id_jadwalVaksin);
        return redirect()->route('JadwalVaksin')->with('pesan', 'Data berhasil dihapus');
    }
}
