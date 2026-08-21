<?php

namespace App\Http\Controllers;

use App\Models\EvaluasiIDP;
use App\Models\IDP;
use Illuminate\Http\Request;

class EvaluasiController extends Controller
{
    public function evaluasiAtasan()
    {
        $rows = IDP::where('id_atasan', auth()->id())->with('bawahan')->get();
        $evaluasi = EvaluasiIDP::whereHas('daftarIdp', fn ($q) => $q->where('id_atasan', auth()->id()))
            ->with(['daftarIdp.bawahan'])
            ->latest('tanggal_evaluasi')
            ->get();

        return view('atasan.idp.evaluasi', compact('rows', 'evaluasi'));
    }

    public function storeEvaluasi(Request $request, IDP $idp)
    {
        $data = $request->validate([
            'skor' => ['required', 'integer', 'min:0', 'max:100'],
            'feedback' => ['required', 'string'],
        ]);

        EvaluasiIDP::create([
            'id_daftar_idp' => $idp->id_daftar_idp,
            'dievaluasi_oleh' => auth()->id(),
            'skor' => $data['skor'],
            'feedback' => $data['feedback'],
            'tanggal_evaluasi' => now(),
        ]);

        return back()->with('success', 'Evaluasi berhasil disimpan.');
    }
}
