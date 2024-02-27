<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'nip',
        'email',
        'id_roles',
        'username',
        'password',
        'salary',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function str_roles() {
        return $this->belongsTo(Role::class, 'id_roles', 'id');
    }

public function absensiKaryawan()
{
    return $this->hasMany(AbsensiKaryawan::class, 'id_karyawan', 'nip');
}

public function getTotalMasukAttribute()
{
    $month = now()->month;
    $monthName = now()->format('F');
    $totalMasuk = $this->absensiKaryawan()->where('keterangan', 'Masuk')->whereMonth('tanggal_masuk', $month)->count();

    return ['month' => $monthName, 'total_masuk' => $totalMasuk];
}


public function getTotalIzinAttribute()
{
    return $this->absensiKaryawan()->where('keterangan', 'Izin')->whereMonth('tanggal_masuk', now()->month)->count();
}

public function getMonthNameAttribute()
{
    $monthName = now()->format('F');
    return $this->absensiKaryawan()->where('keterangan', 'Masuk')->whereMonth('tanggal_masuk', now()->month)->count();
}

public function count_day() {
    return $this->absensiKaryawan()->where('keterangan', 'Masuk')->count();
}

}
