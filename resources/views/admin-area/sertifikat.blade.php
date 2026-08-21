@extends('layouts.app', ['title' => 'Sertifikat Kompetensi - Admin Area'])

@section('content')
<div class="bg-white border border-slate-200 rounded-2xl p-6">
  <h1 class="text-xl font-bold mb-4">Sertifikat Kompetensi - Pegawai Area {{ auth()->user()->unit_induk }}</h1>
  <div class="overflow-x-auto">
    <table class="w-full text-sm">
      <thead class="bg-slate-50">
        <tr>
          <th class="px-4 py-3 text-left">No</th>
          <th class="px-4 py-3 text-left">Nama Pegawai</th>
          <th class="px-4 py-3 text-left">Nama Sertifikat</th>
          <th class="px-4 py-3 text-left">Penerbit</th>
          <th class="px-4 py-3 text-left">Tanggal Terbit</th>
          <th class="px-4 py-3 text-left">Kadaluarsa</th>
        </tr>
      </thead>
      <tbody>
        @forelse($sertifikat as $i => $s)
        <tr class="hover:bg-slate-50">
          <td class="px-4 py-3">{{ $i + 1 }}</td>
          <td class="px-4 py-3">{{ $s->pengguna->nama ?? '-' }}</td>
          <td class="px-4 py-3">{{ $s->nama_sertifikat }}</td>
          <td class="px-4 py-3">{{ $s->penerbit ?? '-' }}</td>
          <td class="px-4 py-3">{{ $s->tanggal_terbit?->format('d/m/Y') ?? '-' }}</td>
          <td class="px-4 py-3">{{ $s->tanggal_kadaluarsa?->format('d/m/Y') ?? '-' }}</td>
        </tr>
        @empty
        <tr><td colspan="6" class="px-4 py-8 text-center text-slate-400">Tidak ada data</td></tr>
        @endforelse
      </tbody>
    </table>
  </div>
</div>
@endsection
