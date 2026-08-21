@extends('layouts.app', ['title' => 'Daftar IDP - Admin Area'])

@section('content')
@if(session('success') || session('warning') || session('error'))
<script>Swal.fire({icon:@json(session('success') ? 'success' : (session('warning') ? 'warning' : 'error')),text:@json(session('success') ?? session('warning') ?? session('error'))});</script>
@endif
<div class="bg-white border border-slate-200 rounded-2xl p-6">
  <div class="flex items-center justify-between mb-4">
    <h1 class="text-xl font-bold">Daftar IDP - Pegawai Area {{ auth()->user()->unit_induk }}</h1>

  </div>
  <div class="overflow-x-auto">
    <table class="w-full text-sm">
      <thead class="bg-slate-50">
        <tr>
          <th class="px-4 py-3 text-left">No</th>
          <th class="px-4 py-3 text-left">Nama Bawahan</th>
          <th class="px-4 py-3 text-left">NIP</th>
          <th class="px-4 py-3 text-left">Jabatan</th>
          <th class="px-4 py-3 text-left">Nama Atasan</th>
          <th class="px-4 py-3 text-left">Periode</th>
        </tr>
      </thead>
      <tbody>
        @forelse($rows as $i => $row)
        <tr class="hover:bg-slate-50">
          <td class="px-4 py-3">{{ $i + 1 }}</td>
          <td class="px-4 py-3">{{ $row->bawahan->nama ?? '-' }}</td>
          <td class="px-4 py-3">{{ $row->bawahan->nip ?? '-' }}</td>
          <td class="px-4 py-3">{{ $row->bawahan->jabatan->sebutan_jabatan ?? '-' }}</td>
          <td class="px-4 py-3">{{ $row->atasan->nama ?? '-' }}</td>
          <td class="px-4 py-3">{{ $row->periode_idp }}</td>
        </tr>
        @empty
        <tr><td colspan="6" class="px-4 py-8 text-center text-slate-400">Tidak ada data</td></tr>
        @endforelse
      </tbody>
    </table>
  </div>
</div>
<script>
  const importForm = document.querySelector('#importForm');
  const importFile = document.querySelector('#importFile');
  document.querySelector('#importButton').onclick = () => importFile.click();
  importFile.onchange = () => importFile.files.length && importForm.submit();
</script>
@endsection
