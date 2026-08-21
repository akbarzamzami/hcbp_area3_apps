<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EvaluasiIDP extends Model
{
    protected $table = 'evaluasi_idp';

    protected $primaryKey = 'id_evaluasi';

    public $timestamps = false;

    protected $fillable = [
        'id_daftar_idp',
        'dievaluasi_oleh',
        'skor',
        'feedback',
        'tanggal_evaluasi',
    ];

    protected function casts(): array
    {
        return [
            'tanggal_evaluasi' => 'date',
        ];
    }

    public function daftarIdp()
    {
        return $this->belongsTo(IDP::class, 'id_daftar_idp', 'id_daftar_idp');
    }

    public function evaluator()
    {
        return $this->belongsTo(Pengguna::class, 'dievaluasi_oleh', 'id_pengguna');
    }
}
