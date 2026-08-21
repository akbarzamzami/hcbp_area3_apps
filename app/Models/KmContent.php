<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KmContent extends Model
{
    protected $table = 'km_content';

    protected $primaryKey = 'id_konten';

    public $timestamps = false;

    protected $fillable = [
        'judul',
        'konten',
        'updated_at',
    ];

    protected function casts(): array
    {
        return [
            'updated_at' => 'datetime',
        ];
    }
}
