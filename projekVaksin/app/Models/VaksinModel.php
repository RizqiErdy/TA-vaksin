<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class VaksinModel extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'nama_tempatVaksin',
        'alamat',
        'fasilitas',
        'posisi',
        'foto',
        'id_kecamatan',
    ];

    public function AllData()
    {
        return DB::table('tempat_vaksin')
            ->join('kecamatan', 'kecamatan.id_kecamatan', '=', 'tempat_vaksin.id_kecamatan')
            ->get();
    }

    public function addData($request)
    {
        DB::table('tempat_vaksin')->insert($request);
    }

    public function TempatVaksinById($id_tempatvaksin)
    {
        return DB::table('tempat_vaksin')
            ->join('kecamatan', 'kecamatan.id_kecamatan', '=', 'tempat_vaksin.id_kecamatan')
            ->where('id_tempatVaksin', $id_tempatvaksin)
            ->first();
    }

    public function UpdateTempatVaksin($id_tempatvaksin, $data)
    {
        DB::table('tempat_vaksin')
            ->where('id_tempatVaksin', $id_tempatvaksin)
            ->update($data);
    }

    public function DeleteVaksin($id_vaksin)
    {
        DB::table('tempat_vaksin')
            ->where('id_tempatVaksin', $id_vaksin)
            ->delete();
    }
}
