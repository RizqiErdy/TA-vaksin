<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class PenerimaModel extends Model
{
    // use HasFactory;
    protected $fillable = [
        'id_jumlahPenerima',
        'tanggal',
        'jumlah',
        'id_tipe',
        'id_penerima',
        'id_tempatVaksin',
    ];

    public function AllData(){
        return DB::table('jumlah_penerima')
        ->join('tempat_vaksin', 'jumlah_penerima.id_tempatVaksin', '=', 'tempat_vaksin.id_tempatVaksin')
        ->join('tipe_vaksin', 'jumlah_penerima.id_tipe', '=', 'tipe_vaksin.id_tipe')
        ->join('penerima_vaksin', 'jumlah_penerima.id_penerima', '=', 'penerima_vaksin.id_penerima')
        ->orderby('tanggal', 'DESC')
        ->get();
    }

    public function DataGroupbyPenerima(){
        return DB::table('jumlah_penerima')
        ->selectRaw('sum(jumlah) as total, nama_penerima')
        ->groupBy('nama_penerima')
        ->join('penerima_vaksin', 'jumlah_penerima.id_penerima', '=', 'penerima_vaksin.id_penerima')
        ->get();
    }

    public function DataGroupbyTipe(){
        return DB::table('jumlah_penerima')
        ->selectRaw('sum(jumlah) as total, nama_tipe')
        ->groupBy('nama_tipe')
        ->join('tipe_vaksin', 'jumlah_penerima.id_tipe', '=', 'tipe_vaksin.id_tipe')
        ->get();
    }

    public function addData($request){
        DB::table('jumlah_penerima')->insert($request);
    }

    public function UpdateJadwal($id_jadwalVaksin, $data)
    {
        DB::table('jadwal_vaksin')
            ->where('id_jadwalVaksin', $id_jadwalVaksin)
            ->update($data);
    }

    public function DeleteJumlah($id_jumlahPenerima)
    {
        DB::table('jumlah_penerima')
            ->where('id_jumlahPenerima', $id_jumlahPenerima)
            ->delete();
    }
}
