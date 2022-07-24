<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\KecamatanModel;

class AdminController extends Controller
{
    public function __construct()
    {
        // $this->middleware('auth');
        $this->KecamatanModel = new KecamatanModel();
        // $this->JenisModel = new JenisModel();
        // $this->UserModel = new User();
    }
    public function index()
    {
        $data = [
            'title' => 'Beranda',
            'kecamatan'=> $this->KecamatanModel->AllData(),
        ];
        return view('admin.home',$data);
    }
}
