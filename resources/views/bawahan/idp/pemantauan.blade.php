@extends('layouts.app', ['title' => 'Pemantauan IDP - Bawahan'])

@section('content')
<div class="bg-white border border-slate-200 rounded-2xl p-6">
  <h1 class="text-xl font-bold mb-4">Pemantauan IDP Saya</h1>
  <div class="overflow-x-auto">
    <table class="w-full text-sm">
      <thead class="bg-slate-50">
        <tr>
          <th class="px-4 py-3 text-left">No</th>
          <th class="px-4 py-3 text-left">Periode</th>
          <th class="px-4 py-3 text-left">Status</th>
          <th class="px-4 py-3 text-left">Progress</th>
          <th class="px-4 py-3 text-left">Aksi</th>
        </tr>
      </thead>
      <tbody>
        @forelse($rows as $i => $row)
        <tr class="hover:bg-slate-50">
          <td class="px-4 py-3">{{ $i + 1 }}</td>
          <td class="px-4 py-3">{{ $row->periode_idp }}</td>
          <td class="px-4 py-3">
            <span class="px-2 py-1 rounded text-xs font-medium {{ ($row->monitoring->status_perencanaan ?? '') === 'Disetujui' ? 'bg-green-100 text-green-700' : 'bg-yellow-100 text-yellow-700' }}">
              {{ $row->monitoring->status_perencanaan ?? 'Belum ada' }}
            </span>
          </td>
          <td class="px-4 py-3">{{ $row->monitoring->progress_percent ?? 0 }}%</td>
          <td class="px-4 py-3">
            <button class="text-blue-600 hover:underline text-xs" onclick="document.getElementById('detail-{{ $row->id_daftar_idp }}').classList.toggle('hidden')">Detail</button>
          </td>
        </tr>
        <tr id="detail-{{ $row->id_daftar_idp }}" class="hidden bg-slate-50">
          <td colspan="5" class="px-4 py-4">
            <div class="grid grid-cols-3 gap-4 text-sm">
              <div><strong>Pembelajaran 10%:</strong><br>{{ $row->monitoring->pembelajaran_10_persen ?? '-' }}</div>
              <div><strong>Social Learning 20%:</strong><br>{{ $row->monitoring->social_learning_20_persen ?? '-' }}</div>
              <div><strong>Experimental 70%:</strong><br>{{ $row->monitoring->experimental_learning_70_persen ?? '-' }}</div>
            </div>
          </td>
        </tr>
        @empty
        <tr><td colspan="5" class="px-4 py-8 text-center text-slate-400">Tidak ada data</td></tr>
        @endforelse
      </tbody>
    </table>
  </div>
</div>
@endsection
