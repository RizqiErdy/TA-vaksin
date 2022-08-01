<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class WebModel extends Model
{
    public function AllDataVaksin()
    {
        return DB::table('tempat_vaksin')
            // ->join('jenis', 'jenis.id_jenis', '=', 'tempat_vaksin.id_jenis')
            ->join('kecamatan', 'kecamatan.id_kecamatan', '=', 'tempat_vaksin.id_kecamatan')
            ->get();
    }

    public function DataKecamatan()
    {
        return DB::table('kecamatan')->get();
    }

    // public function DataJenis()
    // {
    //     return DB::table('jenis')->get();
    // }

    public function KecamatanById($id_kecamatan)
    {
        return DB::table('kecamatan')
            ->where('id_kecamatan', $id_kecamatan)
            ->first();
    }

    public function DataVaksinbyKecamatan($id_kecamatan)
    {
        return DB::table('tempat_vaksin')
            // ->join('jenis', 'jenis.id_jenis', '=', 'tempat_vaksin.id_jenis')
            ->join('kecamatan', 'kecamatan.id_kecamatan', '=', 'tempat_vaksin.id_kecamatan')
            ->where('tempat_vaksin.id_kecamatan', $id_kecamatan)
            ->get();
    }

    public function TempatVaksin()
    {
        return DB::table('tempat_vaksin')
            // ->join('jenis', 'jenis.id_jenis', '=', 'tempat_vaksin.id_jenis')
            ->join('kecamatan', 'kecamatan.id_kecamatan', '=', 'tempat_vaksin.id_kecamatan')
            ->get();
    }

    public function Jadwal7hari(){
        return DB::table('jadwal_vaksin')
        ->join('tempat_vaksin', 'jadwal_vaksin.id_tempatVaksin', '=', 'tempat_vaksin.id_tempatVaksin')
        ->whereBetween('tanggal',[Carbon::now(),Carbon::now()->addDays(7)])
        ->orderby('tanggal', 'ASC')
        ->get();
    }

    public function JadwalByTempatVaksin($id_tempatVaksin){
        return DB::table('jadwal_vaksin')
        ->join('tempat_vaksin', 'jadwal_vaksin.id_tempatVaksin', '=', 'tempat_vaksin.id_tempatVaksin')
        ->where('id_tempatVaksin', $id_tempatVaksin)
        ->where('tanggal','>=',Carbon::now())
        ->orderby('tanggal', 'ASC')
        ->get();
    }
    // public function JenisById($id_jenis)
    // {
    //     return DB::table('jenis')
    //         ->where('id_jenis', $id_jenis)
    //         ->first();
    // }

    // public function DataVaksinbyJenis($id_jenis)
    // {
    //     return DB::table('tempat_vaksin')
    //         // ->join('jenis', 'jenis.id_jenis', '=', 'tempat_vaksin.id_jenis')
    //         ->join('kecamatan', 'kecamatan.id_kecamatan', '=', 'tempat_vaksin.id_kecamatan')
    //         ->where('tempat_vaksin.id_jenis', $id_jenis)
    //         ->get();
    // }

    public function CariDataVaksin($search)
    {
        return DB::table('tempat_vaksin')
            // ->join('jenis', 'jenis.id_jenis', '=', 'tempat_vaksin.id_jenis')
            ->join('kecamatan', 'kecamatan.id_kecamatan', '=', 'tempat_vaksin.id_kecamatan')
            ->where(function ($query) use ($search) {
                $query->orWhere('tempat_vaksin.nama_tempatVaksin', 'like', '%' . $search . '%')
                    ->orWhere('tempat_vaksin.alamat', 'like', '%' . $search . '%')
                    ->orWhere('tempat_vaksin.fasilitas', 'like', '%' . $search . '%')
                    ->orWhere('kecamatan.nama_kecamatan', 'like', '%' . $search . '%');
                // ->orWhere('jenis.jenis_vaksin', 'like', '%' . $search . '%');
            })
            ->get();
    }

    public function DataVaksinById($id_tempatVaksin)
    {
        return DB::table('tempat_vaksin')
            // ->join('jenis', 'jenis.id_jenis', '=', 'tempat_vaksin.id_jenis')
            ->join('kecamatan', 'kecamatan.id_kecamatan', '=', 'tempat_vaksin.id_kecamatan')
            ->where('id_tempatVaksin', $id_tempatVaksin)
            ->first();
    }
}
