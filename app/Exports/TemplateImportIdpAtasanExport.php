<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromArray;

class TemplateImportIdpAtasanExport implements FromArray
{
    public function array(): array
    {
        return [
            ['nip', 'nama', 'job_code', 'username', 'password', 'business_area', 'periode_idp'],
            ['DUMMY-005', 'Nama Pegawai', '20007677', 'pegawai_baru', 'password123', 'UID S2JB', 'Batch-1'],
        ];
    }
}
