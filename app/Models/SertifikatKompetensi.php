<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SertifikatKompetensi extends Model
{
    protected $table = 'sertifikat_kompetensi';

    protected $primaryKey = 'id_sertifikat';

    public $timestamps = false;

    protected $fillable = [
        'id_pengguna',
        'nama_sertifikat',
        'penerbit',
        'tanggal_terbit',
        'tanggal_kadaluarsa',
        'file_url',
    ];

    protected function casts(): array
    {
        return [
            'tanggal_terbit' => 'date',
            'tanggal_kadaluarsa' => 'date',
        ];
    }

    public function pengguna()
    {
        return $this->belongsTo(Pengguna::class, 'id_pengguna', 'id_pengguna');
    }
}
