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

        $query = $this->PenerimaModel->UpdateJumlah($id_jumlahPenerima, $penerima);
        return redirect()->route('PenerimaVaksin')->with('pesan', 'Data berhasil disimpan');
    }

    public function delete($id_jumlahPenerima)
    {
        $this->PenerimaModel->DeleteJumlah($id_jumlahPenerima);
        return redirect()->route('PenerimaVaksin')->with('pesan', 'Data berhasil dihapus');
    }
}
