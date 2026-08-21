<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Pengguna extends Authenticatable
{
    protected $table = 'pengguna';

    protected $primaryKey = 'id_pengguna';

    public $timestamps = false;

    protected $fillable = [
        'nama',
        'nip',
        'id_jabatan',
        'username',
        'password_hash',
        'role',
        'unit_induk',
        'status_aktif',
    ];

    protected $hidden = [
        'password_hash',
    ];

    public function getAuthPassword()
    {
        return $this->password_hash;
    }

    public function jabatan()
    {
        return $this->belongsTo(Jabatan::class, 'id_jabatan', 'id_jabatan');
    }

    public function idpSebagaiBawahan()
    {
        return $this->hasMany(IDP::class, 'id_bawahan', 'id_pengguna');
    }

    protected function casts(): array
    {
        return [
            'status_aktif' => 'boolean',
        ];
    }
}
