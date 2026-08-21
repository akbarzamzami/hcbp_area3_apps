<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Jabatan extends Model
{
    protected $table = 'jabatan';

    protected $primaryKey = 'id_jabatan';

    public $timestamps = false;

    public function kompetensi()
    {
        return $this->belongsToMany(Kompetensi::class, 'jabatan_kompetensi', 'id_jabatan', 'id_kompetensi');
    }
}
