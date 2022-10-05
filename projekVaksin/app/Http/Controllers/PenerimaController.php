<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PenerimaModel;
use App\Models\WebModel;
use App\Models\VaksinModel;

class PenerimaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->PenerimaModel = new PenerimaModel();
        $this->VaksinModel = new VaksinModel();
        $this->WebModel = new WebModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Penerima',
            'vaksin' => $this->VaksinModel->AllData(),
            'penerima'=>$this->PenerimaModel->AllData(),
            'penerimabyPenerima'=>$this->PenerimaModel->DataGroupbyPenerima(),
            'penerimabyTipe'=>$this->PenerimaModel->DataGroupbyTipe(),
            'jnsPenerima'=>$this->WebModel->AllDataPenerima(),
            'tipeVaksin'=>$this->WebModel->AllDataTipe(),
        ];
        return view('admin.penerima.index',$data);
    }

    public function store()
    {
        Request()->validate(
            [
                'tanggal' => 'required',
                'jumlah' => 'required',
                'dosisVaksin' => 'required',
                'penerimaVaksin' => 'required',
                'tempatVaksin' => 'required',
            ],
            [
                'tanggal.required' => 'Wajib diisi !!!',
                'jumlah.required' => 'Wajib diisi !!!',
                'dosisVaksin.required' => 'Wajib diisi !!!',
                'penerimaVaksin.required' => 'Wajib diisi !!!',
                'tempatVaksin.required' => 'Wajib diisi !!!',
            ]
        );
        $tgl = Request()->tanggal;
        $t = date('Y-m-d',strtotime($tgl));

        $penerima = [
            'tanggal'=> $t,
            'jumlah'=> Request()->jumlah,
            'id_penerima' => Request()->penerimaVaksin,
            'id_tipe' => Request()->dosisVaksin,
            'id_tempatVaksin' => Request()->tempatVaksin,
        ];

        $query = $this->PenerimaModel->addData($penerima);
        return redirect()->route('PenerimaVaksin')->with('pesan', 'Data berhasil ditambahkan');
    }
    
    public function update($id_jumlahPenerima)
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

        $query = $this->JadwalModel->UpdateJadwal($id_jadwalVaksin, $jadwal);
        return redirect()->route('JadwalVaksin')->with('pesan', 'Data berhasil disimpan');
    }

    public function delete($id_jumlahPenerima)
    {
        $this->PenerimaModel->DeleteJumlah($id_jumlahPenerima);
        return redirect()->route('PenerimaVaksin')->with('pesan', 'Data berhasil dihapus');
    }
}
