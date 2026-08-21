<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class IDP extends Model
{
    protected $table = 'daftar_idp';

    protected $primaryKey = 'id_daftar_idp';

    public $timestamps = false;

    protected $fillable = [
        'id_bawahan',
        'id_atasan',
        'business_area',
        'periode_idp',
    ];

    public function bawahan()
    {
        return $this->belongsTo(Pengguna::class, 'id_bawahan', 'id_pengguna');
    }

    public function atasan()
    {
        return $this->belongsTo(Pengguna::class, 'id_atasan', 'id_pengguna');
    }

    public function monitoring()
    {
        return $this->hasOne(MonitoringIDP::class, 'id_daftar_idp', 'id_daftar_idp');
    }

    public function evaluasi()
    {
        return $this->hasMany(EvaluasiIDP::class, 'id_daftar_idp', 'id_daftar_idp');
    }

    public function rencanaPengembangan()
    {
        return $this->hasMany(RencanaPengembanganIDP::class, 'id_daftar_idp', 'id_daftar_idp');
    }
}
