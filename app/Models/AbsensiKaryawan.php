<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AbsensiKaryawan extends Model
{
    use HasFactory;

    public $table = "tbl_absensi";
    protected $guarded = ['id'];

    protected $fillable = [
        'id_karyawan',
        'tanggal_masuk',
        'keterangan'
    ];
    protected $dates = [
        'created_at',
        'updated_at'
    ];


}
