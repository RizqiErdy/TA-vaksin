<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class JadwalModel extends Model
{
    // use HasFactory;
    protected $fillable = [
        'id',
        'tanggal',
        'jam_mulai',
        'jam_selesai',
        'jenis_vaksin',
        'tipe_vaksin',
        'id_tempatVaksin',
    ];

    public function AllData(){
        return DB::table('jadwal_vaksin')
        ->join('tempat_vaksin', 'jadwal_vaksin.id_tempatVaksin', '=', 'tempat_vaksin.id_tempatVaksin')
        ->get();;
    }

    public function addData($request){
        DB::table('jadwal_vaksin')->insert($request);
    }
}
