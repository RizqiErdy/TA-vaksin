<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class KecamatanModel extends Model
{
    protected $fillable = [
        'id_kecamatan',
        'nama_kecamatan',
        'warna',
        'geojson',
    ];

    public function AllData(){
        return DB::table('kecamatan')->get();
    }

    public function addData($request){
        DB::table('kecamatan')->insert($request);
    }

    public function KecamatanById($id_kecamatan){
        return DB::table('kecamatan')
            ->where('id_kecamatan', $id_kecamatan)
            ->first();
    }
    
    public function UpdateKecamatan($id_kecamatan, $data){
        DB::table('kecamatan')
            ->where('id_kecamatan', $id_kecamatan)
            ->update($data);
    }

    public function DeleteKecamatan($id_kecamatan){
        DB::table('kecamatan')
            ->where('id_kecamatan',$id_kecamatan)
            ->delete();
    }
}
