<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payroll extends Model
{
    use HasFactory;
    public $table = 'tbl_payroll';
    protected $guarded =['id'];
    protected $fillable = [
        'nip_pegawai',
        'tidak_masuk',
        'telat',
        'pph',
        'total_potongan',
        'total_salary'
    ];

    protected $dates = [
        'created_at',
        'updated_at'
    ];

    public function payroll_name() {
        return $this->belongsTo(User::class, 'nip_pegawai', 'nip');
    }

}
