<?php

namespace App\Http\Controllers;

use App\Models\Jabatan;
use App\Models\Pengguna;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class SettingRoleController extends Controller
{
    public function index()
    {
        $pengguna = Pengguna::with('jabatan')->get();
        $jabatan = Jabatan::orderBy('sebutan_jabatan')->get();

        return view('admin-master.setting-role', compact('pengguna', 'jabatan'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nama' => ['required', 'string', 'max:150'],
            'nip' => ['required', 'string', 'max:50', 'unique:pengguna,nip'],
            'id_jabatan' => ['nullable', 'exists:jabatan,id_jabatan'],
            'username' => ['required', 'string', 'max:100', 'unique:pengguna,username'],
            'password' => ['required', 'string', 'min:6'],
            'role' => ['required', 'in:admin_master,admin_area,atasan,bawahan'],
            'unit_induk' => ['nullable', 'in:UID S2JB,UID LAMPUNG,UIP SUMBAGSEL,UIW BABEL'],
            'status_aktif' => ['required', 'boolean'],
        ]);

        $data['password_hash'] = Hash::make($data['password']);
        unset($data['password']);

        Pengguna::create($data);

        return back()->with('success', 'Pengguna berhasil ditambahkan.');
    }

    public function update(Request $request, Pengguna $pengguna)
    {
        $data = $request->validate([
            'nama' => ['required', 'string', 'max:150'],
            'nip' => ['required', 'string', 'max:50', 'unique:pengguna,nip,'.$pengguna->id_pengguna.',id_pengguna'],
            'id_jabatan' => ['nullable', 'exists:jabatan,id_jabatan'],
            'username' => ['required', 'string', 'max:100', 'unique:pengguna,username,'.$pengguna->id_pengguna.',id_pengguna'],
            'password' => ['nullable', 'string', 'min:6'],
            'role' => ['required', 'in:admin_master,admin_area,atasan,bawahan'],
            'unit_induk' => ['nullable', 'in:UID S2JB,UID LAMPUNG,UIP SUMBAGSEL,UIW BABEL'],
            'status_aktif' => ['required', 'boolean'],
        ]);

        if (! empty($data['password'])) {
            $data['password_hash'] = Hash::make($data['password']);
        }
        unset($data['password']);

        $pengguna->update($data);

        return back()->with('success', 'Pengguna berhasil diperbarui.');
    }

    public function destroy(Pengguna $pengguna)
    {
        $pengguna->delete();

        return back()->with('success', 'Pengguna berhasil dihapus.');
    }
}
