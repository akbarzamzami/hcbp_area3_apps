<?php

namespace App\Http\Controllers;

use App\Models\SertifikatKompetensi;
use App\Models\Pengguna;
use Illuminate\Http\Request;

class SertifikatController extends Controller
{
    public function index()
    {
        $sertifikat = SertifikatKompetensi::with('pengguna')->get();
        return view('admin-master.sertifikat', compact('sertifikat'));
    }

    public function indexArea()
    {
        $user = auth()->user();
        $sertifikat = SertifikatKompetensi::whereHas('pengguna', function ($q) use ($user) {
            $q->where('unit_induk', $user->unit_induk);
        })->with('pengguna')->get();
        return view('admin-area.sertifikat', compact('sertifikat'));
    }

    public function indexBawahan()
    {
        $sertifikat = SertifikatKompetensi::where('id_pengguna', auth()->id())->get();
        return view('bawahan.sertifikat', compact('sertifikat'));
    }
}
