<?php

namespace App\Http\Controllers;

use App\Models\EvaluasiIDP;
use App\Models\IDP;
use App\Models\Jabatan;
use App\Models\Pengguna;
use App\Models\RencanaPengembanganIDP;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class IdpController extends Controller
{
    public function daftar()
    {
        $rows = IDP::query()
            ->with(['bawahan.jabatan', 'atasan.jabatan'])
            ->orderBy('id_daftar_idp')
            ->get();

        return view('admin-master.idp.daftar', compact('rows'));
    }

    public function daftarArea()
    {
        $user = auth()->user();
        $rows = IDP::query()
            ->whereHas('bawahan', fn ($q) => $q->where('unit_induk', $user->unit_induk))
            ->with(['bawahan.jabatan', 'atasan.jabatan'])
            ->orderBy('id_daftar_idp')
            ->get();

        return view('admin-area.idp.daftar', compact('rows'));
    }

    public function daftarAtasan()
    {
        $rows = IDP::query()
            ->where('id_atasan', auth()->id())
            ->with(['bawahan.jabatan', 'atasan.jabatan'])
            ->orderBy('id_daftar_idp')
            ->get();

        $jabatan = Jabatan::orderBy('sebutan_jabatan')->get();

        return view('atasan.idp.daftar', compact('rows', 'jabatan'));
    }

    public function daftarBawahan()
    {
        $rows = IDP::query()
            ->where('id_bawahan', auth()->id())
            ->with(['bawahan.jabatan.kompetensi', 'atasan.jabatan', 'monitoring', 'rencanaPengembangan.kompetensi'])
            ->orderBy('id_daftar_idp')
            ->get();

        return view('bawahan.idp.daftar', compact('rows'));
    }

    public function storeRencanaBawahan(Request $request, IDP $idp)
    {
        abort_unless($idp->id_bawahan === auth()->id(), 403);

        $data = $request->validate([
            'submit_action' => ['required', 'in:simpan,kirim'],
            'kompetensi' => ['required', 'array', 'max:5'],
            'kompetensi.*.id_kompetensi' => ['nullable', 'exists:kompetensi,id_kompetensi'],
            'kompetensi.*.pembelajaran_10_persen' => ['nullable', 'string'],
            'kompetensi.*.social_learning_20_persen' => ['nullable', 'string'],
            'kompetensi.*.action_learning_70_persen' => ['nullable', 'string'],
        ]);

        $data['kompetensi'] = array_values(array_filter(
            $data['kompetensi'],
            fn ($row) => ! empty($row['id_kompetensi'])
        ));

        if (count($data['kompetensi']) < 3) {
            return back()->withErrors(['kompetensi' => 'Pilih minimal 3 kompetensi teknis.'])->withInput();
        }

        if (count(array_unique(array_column($data['kompetensi'], 'id_kompetensi'))) !== count($data['kompetensi'])) {
            return back()->withErrors(['kompetensi' => 'Kompetensi tidak boleh dipilih lebih dari sekali.'])->withInput();
        }

        $allowedIds = auth()->user()->jabatan?->kompetensi()->pluck('kompetensi.id_kompetensi')->all() ?? [];

        foreach ($data['kompetensi'] as $row) {
            abort_unless(in_array((int) $row['id_kompetensi'], $allowedIds, true), 403);

            RencanaPengembanganIDP::updateOrCreate(
                ['id_daftar_idp' => $idp->id_daftar_idp, 'id_kompetensi' => $row['id_kompetensi']],
                [
                    'pembelajaran_10_persen' => $row['pembelajaran_10_persen'] ?? null,
                    'social_learning_20_persen' => $row['social_learning_20_persen'] ?? null,
                    'action_learning_70_persen' => $row['action_learning_70_persen'] ?? null,
                    'status' => $data['submit_action'] === 'kirim' ? 'Diajukan' : 'Draft',
                ]
            );
        }

        return back()->with('success', $data['submit_action'] === 'kirim' ? 'Rencana IDP dikirim ke atasan.' : 'Rencana IDP disimpan.');
    }

    public function evaluasiBawahan()
    {
        $evaluasi = EvaluasiIDP::whereHas('daftarIdp', fn ($q) => $q->where('id_bawahan', auth()->id()))
            ->with(['daftarIdp.atasan'])
            ->latest('tanggal_evaluasi')
            ->get();

        return view('bawahan.idp.evaluasi', compact('evaluasi'));
    }

    public function pemantauan()
    {
        $rows = IDP::query()
            ->with(['bawahan', 'atasan', 'monitoring'])
            ->orderBy('id_daftar_idp')
            ->get();

        return view('admin-master.idp.pemantauan', compact('rows'));
    }

    public function pemantauanArea()
    {
        $user = auth()->user();
        $rows = IDP::query()
            ->whereHas('bawahan', fn ($q) => $q->where('unit_induk', $user->unit_induk))
            ->with(['bawahan', 'atasan', 'monitoring'])
            ->orderBy('id_daftar_idp')
            ->get();

        return view('admin-area.idp.pemantauan', compact('rows'));
    }

    public function penetapanAtasan()
    {
        $rencana = RencanaPengembanganIDP::where('status', 'Diajukan')
            ->whereHas('daftarIdp', fn ($q) => $q->where('id_atasan', auth()->id()))
            ->with(['kompetensi', 'daftarIdp.bawahan'])
            ->get();

        return view('atasan.idp.penetapan', compact('rencana'));
    }

    public function reviewRencanaAtasan(Request $request, RencanaPengembanganIDP $rencana)
    {
        abort_unless($rencana->daftarIdp()->where('id_atasan', auth()->id())->exists(), 403);

        $data = $request->validate([
            'status' => ['required', 'in:Disetujui,Revisi'],
            'feedback_atasan' => ['required', 'string'],
        ]);

        $rencana->update($data);

        return back()->with('success', 'Rencana IDP berhasil ditinjau.');
    }

    public function pemantauanAtasan()
    {
        $rows = IDP::query()
            ->where('id_atasan', auth()->id())
            ->with(['bawahan', 'atasan', 'monitoring'])
            ->orderBy('id_daftar_idp')
            ->get();

        return view('atasan.idp.pemantauan', compact('rows'));
    }

    public function storeAtasan(Request $request)
    {
        $data = $request->validate([
            'nama' => ['required', 'string', 'max:150'],
            'nip' => ['required', 'string', 'max:50', 'unique:pengguna,nip'],
            'id_jabatan' => ['nullable', 'exists:jabatan,id_jabatan'],
            'username' => ['required', 'string', 'max:100', 'unique:pengguna,username'],
            'password' => ['required', 'string', 'min:6'],
            'business_area' => ['nullable', 'string', 'max:100'],
            'periode_idp' => ['required', 'in:Batch-1,Batch-2'],
        ]);

        $bawahan = Pengguna::create([
            'nama' => $data['nama'],
            'nip' => $data['nip'],
            'id_jabatan' => $data['id_jabatan'],
            'username' => $data['username'],
            'password_hash' => Hash::make($data['password']),
            'role' => 'bawahan',
            'unit_induk' => auth()->user()->unit_induk,
            'status_aktif' => true,
        ]);

        IDP::create([
            'id_bawahan' => $bawahan->id_pengguna,
            'id_atasan' => auth()->id(),
            'business_area' => $data['business_area'],
            'periode_idp' => $data['periode_idp'],
        ]);

        return back()->with('success', 'Bawahan berhasil ditambahkan.');
    }

    public function updateAtasan(Request $request, IDP $idp)
    {
        abort_unless($idp->id_atasan === auth()->id(), 403);

        $data = $request->validate([
            'nama' => ['required', 'string', 'max:150'],
            'nip' => ['required', 'string', 'max:50', 'unique:pengguna,nip,'.$idp->id_bawahan.',id_pengguna'],
            'id_jabatan' => ['nullable', 'exists:jabatan,id_jabatan'],
            'username' => ['required', 'string', 'max:100', 'unique:pengguna,username,'.$idp->id_bawahan.',id_pengguna'],
            'password' => ['nullable', 'string', 'min:6'],
            'business_area' => ['nullable', 'string', 'max:100'],
            'periode_idp' => ['required', 'in:Batch-1,Batch-2'],
        ]);

        $bawahan = Pengguna::findOrFail($idp->id_bawahan);
        $bawahan->fill([
            'nama' => $data['nama'],
            'nip' => $data['nip'],
            'id_jabatan' => $data['id_jabatan'],
            'username' => $data['username'],
        ]);

        if (! empty($data['password'])) {
            $bawahan->password_hash = Hash::make($data['password']);
        }

        $bawahan->save();
        $idp->update([
            'business_area' => $data['business_area'],
            'periode_idp' => $data['periode_idp'],
        ]);

        return back()->with('success', 'Bawahan berhasil diperbarui.');
    }

    public function destroyAtasan(IDP $idp)
    {
        abort_unless($idp->id_atasan === auth()->id(), 403);
        Pengguna::whereKey($idp->id_bawahan)->delete();

        return back()->with('success', 'Bawahan berhasil dihapus.');
    }

    public function updatePemantauanAtasan(Request $request, IDP $idp)
    {
        $data = $request->validate([
            'status_perencanaan' => ['required', 'in:Diajukan,Revisi,Disetujui,Berjalan,Selesai'],
            'pembelajaran_10_persen' => ['nullable', 'string'],
            'social_learning_20_persen' => ['nullable', 'string'],
            'experimental_learning_70_persen' => ['nullable', 'string'],
            'progress_percent' => ['nullable', 'integer', 'min:0', 'max:100'],
        ]);

        DB::table('monitoring_idp')->updateOrInsert(
            ['id_daftar_idp' => $idp->id_daftar_idp],
            array_merge($data, ['updated_at' => now()])
        );

        return back()->with('success', 'Pemantauan berhasil diperbarui.');
    }

    public function pemantauanBawahan()
    {
        $rows = IDP::query()
            ->where('id_bawahan', auth()->id())
            ->with(['bawahan', 'atasan', 'monitoring'])
            ->orderBy('id_daftar_idp')
            ->get();

        return view('bawahan.idp.pemantauan', compact('rows'));
    }

    public function updatePemantauan(Request $request, IDP $idp)
    {
        $data = $request->validate([
            'status_perencanaan' => ['required', 'in:Belum direncanakan,Menunggu persetujuan,Disetujui'],
            'pembelajaran_10_persen' => ['nullable', 'string'],
            'social_learning_20_persen' => ['nullable', 'string'],
            'experimental_learning_70_persen' => ['nullable', 'string'],
        ]);

        DB::table('monitoring_idp')->updateOrInsert(
            ['id_bawahan' => $idp->id_bawahan],
            $data
        );

        return back()->with('success', 'Data pemantauan berhasil diperbarui.');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nama_bawahan' => ['required', 'string', 'max:150'],
            'nip_bawahan' => ['required', 'string', 'max:50'],
            'jabatan_bawahan' => ['required', 'string', 'max:150'],
            'nama_atasan' => ['required', 'string', 'max:150'],
            'nip_atasan' => ['required', 'string', 'max:50'],
            'jabatan_atasan' => ['required', 'string', 'max:150'],
            'business_area' => ['nullable', 'string', 'max:100'],
            'unit_induk' => ['required', 'in:UID S2JB,UID LAMPUNG,UIP SUMBAGSEL,UIW BABEL'],
            'periode_idp' => ['required', 'in:Batch-1,Batch-2'],
        ]);

        IDP::create($data);

        return back()->with('success', 'Data IDP berhasil ditambahkan.');
    }

    public function update(Request $request, IDP $idp)
    {
        $data = $request->validate([
            'nama_bawahan' => ['required', 'string', 'max:150'],
            'nip_bawahan' => ['required', 'string', 'max:50'],
            'jabatan_bawahan' => ['required', 'string', 'max:150'],
            'nama_atasan' => ['required', 'string', 'max:150'],
            'nip_atasan' => ['required', 'string', 'max:50'],
            'jabatan_atasan' => ['required', 'string', 'max:150'],
            'business_area' => ['nullable', 'string', 'max:100'],
            'unit_induk' => ['required', 'in:UID S2JB,UID LAMPUNG,UIP SUMBAGSEL,UIW BABEL'],
            'periode_idp' => ['required', 'in:Batch-1,Batch-2'],
        ]);

        $idp->update($data);

        return back()->with('success', 'Data IDP berhasil diperbarui.');
    }

    public function destroy(IDP $idp)
    {
        $idp->delete();

        return back()->with('success', 'Data IDP berhasil dihapus.');
    }
}
