@extends('layouts.app', ['title' => 'Pemantauan IDP - Admin Area'])

@section('content')
<div class="bg-white border border-slate-200 rounded-2xl p-6">
  <h1 class="text-xl font-bold mb-4">Pemantauan IDP - Pegawai Area {{ auth()->user()->unit_induk }}</h1>
  <div class="overflow-x-auto">
    <table class="w-full text-sm">
      <thead class="bg-slate-50">
        <tr>
          <th class="px-4 py-3 text-left">No</th>
          <th class="px-4 py-3 text-left">Nama Bawahan</th>
          <th class="px-4 py-3 text-left">Status</th>
          <th class="px-4 py-3 text-left">Progress</th>
          <th class="px-4 py-3 text-left">Pembelajaran 10%</th>
          <th class="px-4 py-3 text-left">Social 20%</th>
          <th class="px-4 py-3 text-left">Experimental 70%</th>
        </tr>
      </thead>
      <tbody>
        @forelse($rows as $i => $row)
        <tr class="hover:bg-slate-50">
          <td class="px-4 py-3">{{ $i + 1 }}</td>
          <td class="px-4 py-3">{{ $row->bawahan->nama ?? '-' }}</td>
          <td class="px-4 py-3">
            <span class="px-2 py-1 rounded text-xs font-medium {{ ($row->monitoring->status_perencanaan ?? '') === 'Disetujui' ? 'bg-green-100 text-green-700' : 'bg-yellow-100 text-yellow-700' }}">
              {{ $row->monitoring->status_perencanaan ?? 'Belum ada' }}
            </span>
          </td>
          <td class="px-4 py-3">{{ $row->monitoring->progress_percent ?? 0 }}%</td>
          <td class="px-4 py-3">{{ $row->monitoring->pembelajaran_10_persen ?? '-' }}</td>
          <td class="px-4 py-3">{{ $row->monitoring->social_learning_20_persen ?? '-' }}</td>
          <td class="px-4 py-3">{{ $row->monitoring->experimental_learning_70_persen ?? '-' }}</td>
        </tr>
        @empty
        <tr><td colspan="7" class="px-4 py-8 text-center text-slate-400">Tidak ada data</td></tr>
        @endforelse
      </tbody>
    </table>
  </div>
</div>
@endsection
