<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        if (DB::table('pengguna')->exists()) {
            return;
        }

        $jabatanAtasan = DB::table('jabatan')->where('sebutan_jabatan', 'like', '%Manager%')->value('id_jabatan');
        $jabatanBawahan = DB::table('jabatan')->where('sebutan_jabatan', 'like', '%Officer%')->value('id_jabatan');

        $users = [
            ['nama' => 'Admin Master', 'nip' => 'DUMMY-001', 'id_jabatan' => null, 'username' => 'admin', 'password_hash' => Hash::make('admin123'), 'role' => 'admin_master', 'unit_induk' => null, 'status_aktif' => true],
            ['nama' => 'Admin Area S2JB', 'nip' => 'DUMMY-002', 'id_jabatan' => $jabatanAtasan, 'username' => 'area_s2jb', 'password_hash' => Hash::make('area123'), 'role' => 'admin_area', 'unit_induk' => 'UID S2JB', 'status_aktif' => true],
            ['nama' => 'Manager IDP S2JB', 'nip' => 'DUMMY-003', 'id_jabatan' => $jabatanAtasan, 'username' => 'manager_s2jb', 'password_hash' => Hash::make('manager123'), 'role' => 'atasan', 'unit_induk' => 'UID S2JB', 'status_aktif' => true],
            ['nama' => 'Pegawai IDP S2JB', 'nip' => 'DUMMY-004', 'id_jabatan' => $jabatanBawahan, 'username' => 'staff_s2jb', 'password_hash' => Hash::make('staff123'), 'role' => 'bawahan', 'unit_induk' => 'UID S2JB', 'status_aktif' => true],
        ];

        DB::table('pengguna')->insert($users);
        $ids = DB::table('pengguna')->pluck('id_pengguna', 'username');

        $idpId = DB::table('daftar_idp')->insertGetId([
            'id_bawahan' => $ids['staff_s2jb'],
            'id_atasan' => $ids['manager_s2jb'],
            'business_area' => 'UID S2JB',
            'periode_idp' => 'Batch-1',
        ]);

        DB::table('monitoring_idp')->insert([
            'id_daftar_idp' => $idpId,
            'status_perencanaan' => 'Diajukan',
            'progress_percent' => 0,
        ]);

        DB::table('km_content')->insert([
            'judul' => 'Knowledge Management HCBP Area 3',
            'konten' => 'Konten dummy tanpa mengubah data master kompetensi.',
        ]);
    }
}
