<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MonitoringIDP extends Model
{
    protected $table = 'monitoring_idp';

    protected $primaryKey = 'id_monitoring';

    public $timestamps = false;

    protected $fillable = [
        'id_daftar_idp',
        'status_perencanaan',
        'pembelajaran_10_persen',
        'social_learning_20_persen',
        'experimental_learning_70_persen',
        'progress_percent',
        'disetujui_oleh',
        'tanggal_disetujui',
        'updated_at',
    ];

    protected function casts(): array
    {
        return [
            'tanggal_disetujui' => 'datetime',
            'updated_at' => 'datetime',
        ];
    }

    public function daftarIdp()
    {
        return $this->belongsTo(IDP::class, 'id_daftar_idp', 'id_daftar_idp');
    }

    public function disetujuiOleh()
    {
        return $this->belongsTo(Pengguna::class, 'disetujui_oleh', 'id_pengguna');
    }
}
