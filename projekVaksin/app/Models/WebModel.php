<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class WebModel extends Model
{
    public function AllDataVaksin()
    {
        return DB::table('tempat_vaksin')
            ->join('kecamatan', 'kecamatan.id_kecamatan', '=', 'tempat_vaksin.id_kecamatan')
            ->get();
    }

    public function DataKecamatan()
    {
        return DB::table('kecamatan')->get();
    }

    public function DataJadwal()
    {
        return DB::table('jadwal_vaksin')->get();
    }


    public function KecamatanById($id_kecamatan)
    {
        return DB::table('kecamatan')
            ->where('id_kecamatan', $id_kecamatan)
            ->first();
    }

    public function DataVaksinbyKecamatan($id_kecamatan)
    {
        return DB::table('tempat_vaksin')
            ->join('kecamatan', 'kecamatan.id_kecamatan', '=', 'tempat_vaksin.id_kecamatan')
            ->where('tempat_vaksin.id_kecamatan', $id_kecamatan)
            ->get();
    }

    public function TempatVaksin()
    {
        return DB::table('tempat_vaksin')
            ->join('kecamatan', 'kecamatan.id_kecamatan', '=', 'tempat_vaksin.id_kecamatan')
            ->get();
    }

    public function Jadwal7hari()
    {
        return DB::table('jadwal_vaksin')
            ->join('tempat_vaksin', 'jadwal_vaksin.id_tempatVaksin', '=', 'tempat_vaksin.id_tempatVaksin')
            ->whereBetween('tanggal', [Carbon::now()->subDay(), Carbon::now()->addDays(7)])
            ->orderby('tanggal', 'ASC')
            ->get();
    }

    public function JadwalByTempatVaksin($id_tempatVaksin)
    {
        return DB::table('jadwal_vaksin')
            ->join('tempat_vaksin', 'jadwal_vaksin.id_tempatVaksin', '=', 'tempat_vaksin.id_tempatVaksin')
            ->where('jadwal_vaksin.id_tempatVaksin', $id_tempatVaksin)
            ->where('tanggal', '>=', Carbon::now())
            ->orderby('tanggal', 'ASC')
            ->get();
    }

    public function CariDataVaksin($search)
    {
        return DB::table('tempat_vaksin')
            ->join('kecamatan', 'kecamatan.id_kecamatan', '=', 'tempat_vaksin.id_kecamatan')
            ->where(function ($query) use ($search) {
                $query->orWhere('tempat_vaksin.nama_tempatVaksin', 'like', '%' . $search . '%')
                    ->orWhere('tempat_vaksin.alamat', 'like', '%' . $search . '%')
                    ->orWhere('tempat_vaksin.fasilitas', 'like', '%' . $search . '%')
                    ->orWhere('kecamatan.nama_kecamatan', 'like', '%' . $search . '%');
            })
            ->get();
    }

    public function DataVaksinById($id_tempatVaksin)
    {
        return DB::table('tempat_vaksin')
            ->join('kecamatan', 'kecamatan.id_kecamatan', '=', 'tempat_vaksin.id_kecamatan')
            ->where('id_tempatVaksin', $id_tempatVaksin)
            ->first();
    }

    public function AllDataTipe()
    {
        return DB::table('tipe_vaksin')
            ->get();
    }
    public function AllDataPenerima()
    {
        return DB::table('penerima_vaksin')
            ->get();
    }

    public function jumlahPenerimaKecTotal($id_kecamatan){
        return DB::table('jumlah_penerima')
        ->join('tempat_vaksin', 'jumlah_penerima.id_tempatVaksin', '=', 'tempat_vaksin.id_tempatVaksin')
        ->join('kecamatan', 'kecamatan.id_kecamatan', '=', 'tempat_vaksin.id_kecamatan')
        ->where('tempat_vaksin.id_kecamatan', $id_kecamatan)
        ->get();
    }

    public function jumlahPenerimaKecbyTgl($id_kecamatan){
        return DB::table('jumlah_penerima')
        ->join('tempat_vaksin', 'jumlah_penerima.id_tempatVaksin', '=', 'tempat_vaksin.id_tempatVaksin')
        ->join('kecamatan', 'kecamatan.id_kecamatan', '=', 'tempat_vaksin.id_kecamatan')
        ->where('tempat_vaksin.id_kecamatan', $id_kecamatan)
        ->where('tanggal', Carbon::now()->subDay())
        ->get();
    }

    public function jumlahPenerimaKecbyPenerima($id_kecamatan){
        return DB::table('jumlah_penerima')
        ->selectRaw('sum(jumlah) as total, nama_penerima')
        ->join('penerima_vaksin', 'jumlah_penerima.id_penerima', '=', 'penerima_vaksin.id_penerima')
        ->join('tempat_vaksin', 'jumlah_penerima.id_tempatVaksin', '=', 'tempat_vaksin.id_tempatVaksin')
        ->join('kecamatan', 'kecamatan.id_kecamatan', '=', 'tempat_vaksin.id_kecamatan')
        ->where('tempat_vaksin.id_kecamatan', $id_kecamatan)
        ->groupBy('nama_penerima')
        ->get();
    }

    public function jumlahPenerimaKecbyDosis($id_kecamatan){
        return DB::table('jumlah_penerima')
        ->selectRaw('sum(jumlah) as total, nama_tipe')
        ->join('tipe_vaksin', 'jumlah_penerima.id_tipe', '=', 'tipe_vaksin.id_tipe')
        ->join('tempat_vaksin', 'jumlah_penerima.id_tempatVaksin', '=', 'tempat_vaksin.id_tempatVaksin')
        ->join('kecamatan', 'kecamatan.id_kecamatan', '=', 'tempat_vaksin.id_kecamatan')
        ->where('tempat_vaksin.id_kecamatan', $id_kecamatan)
        ->orderby('jumlah_penerima.id_tipe', 'ASC')
        ->groupBy('nama_tipe')
        ->get();
    }

    public function jumlahPenerimaTempatTotal($id_tempatVaksin){
        return DB::table('jumlah_penerima')
        ->where('id_tempatVaksin', $id_tempatVaksin)
        ->get();
    }

    public function jumlahPenerimaTempatbyPenerima($id_tempatVaksin){
        return DB::table('jumlah_penerima')
        ->selectRaw('sum(jumlah) as total, nama_penerima')
        ->join('penerima_vaksin', 'jumlah_penerima.id_penerima', '=', 'penerima_vaksin.id_penerima')
        ->where('id_tempatVaksin', $id_tempatVaksin)
        ->groupBy('nama_penerima')
        ->get();
    }

    public function jumlahPenerimaTempatbyDosis($id_tempatVaksin){
        return DB::table('jumlah_penerima')
        ->selectRaw('sum(jumlah) as total, nama_tipe')
        ->join('tipe_vaksin', 'jumlah_penerima.id_tipe', '=', 'tipe_vaksin.id_tipe')
        ->where('id_tempatVaksin', $id_tempatVaksin)
        ->orderby('jumlah_penerima.id_tipe', 'ASC')
        ->groupBy('nama_tipe')
        ->get();
    }

    public function jumlahPenerimaTempatbyTgl($id_tempatVaksin){
        return DB::table('jumlah_penerima')
        ->where('id_tempatVaksin', $id_tempatVaksin)
        ->where('tanggal', Carbon::now()->subDay())
        ->get();
    }
}
