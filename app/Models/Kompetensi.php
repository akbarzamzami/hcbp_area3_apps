<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kompetensi extends Model
{
    protected $table = 'kompetensi';
    protected $primaryKey = 'id_kompetensi';
    public $timestamps = false;

    public function jabatans()
    {
        return $this->belongsToMany(Jabatan::class, 'jabatan_kompetensi', 'id_kompetensi', 'id_jabatan');
    }
}
