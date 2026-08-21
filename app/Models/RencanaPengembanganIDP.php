<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RencanaPengembanganIDP extends Model
{
    protected $table = 'rencana_pengembangan_idp';
    protected $primaryKey = 'id_rencana';

    protected $fillable = [
        'id_daftar_idp',
        'id_kompetensi',
        'pembelajaran_10_persen',
        'social_learning_20_persen',
        'action_learning_70_persen',
        'status',
        'feedback_atasan',
    ];

    public function kompetensi()
    {
        return $this->belongsTo(Kompetensi::class, 'id_kompetensi', 'id_kompetensi');
    }

    public function daftarIdp()
    {
        return $this->belongsTo(IDP::class, 'id_daftar_idp', 'id_daftar_idp');
    }
}
