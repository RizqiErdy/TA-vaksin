<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\KecamatanModel;
use App\Models\User;
use App\Models\WebModel;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->KecamatanModel = new KecamatanModel();
        $this->WebModel = new WebModel();
        $this->UserModel = new User();
    }
    public function index()
    {
        $data = [
            'title' => 'Beranda',
            'kecamatan'=> $this->KecamatanModel->AllData(),
            'vaksin'=>$this->WebModel->AllDataVaksin(),
            'jadwal'=>$this->WebModel->DataJadwal(),
            'user'=> $this->UserModel->AllData(),
        ];
        return view('admin.home',$data);
    }
}
