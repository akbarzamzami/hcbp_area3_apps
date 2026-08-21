@extends('layouts.app', ['title' => 'Daftar IDP - Atasan'])

@section('content')
@if(session('success') || session('warning') || session('error'))
<script>Swal.fire({icon:@json(session('success') ? 'success' : (session('warning') ? 'warning' : 'error')),text:@json(session('success') ?? session('warning') ?? session('error'))});</script>
@endif
<div class="bg-white border border-slate-200 rounded-2xl p-6">
  <div class="flex items-center justify-between mb-4">
    <h1 class="text-xl font-bold">Daftar IDP - Bawahan Saya</h1>
    <div class="flex items-center gap-3">
      <form id="importForm" action="{{ route('atasan.idp.import') }}" method="POST" enctype="multipart/form-data" class="hidden">
        @csrf
        <input id="importFile" name="file" type="file" accept=".xlsx,.xls,.csv" required>
      </form>
      <!-- <a href="{{ route('atasan.idp.template') }}" class="rounded-lg border border-slate-300 px-4 py-2 text-sm font-semibold text-slate-600">Template Excel</a> -->
      <!-- <button id="importButton" type="button" class="rounded-lg border border-[#31599b] px-4 py-2 text-sm font-semibold text-[#31599b]">Import Excel</button> -->
      <button id="importButton" type="button" class="rounded-lg border border-[#31599b] px-4 py-2 text-sm font-semibold text-[#31599b] hover:bg-blue-50">Import Excel</button>
      <button id="templateButton" type="button" class="rounded-lg border border-slate-300 px-4 py-2 text-sm font-semibold text-slate-600 hover:bg-slate-50">Template Excel</button>
      <button id="addButton" class="rounded-lg bg-[#31599b] px-4 py-2 text-sm font-semibold text-white">Tambah Bawahan</button>
    </div>
  </div>
  <div class="overflow-x-auto">
    <table class="w-full text-sm">
      <thead class="bg-slate-50">
        <tr>
          <th class="px-4 py-3 text-left">No</th>
          <th class="px-4 py-3 text-left">Nama Bawahan</th>
          <th class="px-4 py-3 text-left">NIP</th>
          <th class="px-4 py-3 text-left">Jabatan</th>
          <th class="px-4 py-3 text-left">Periode</th>
          <th class="px-4 py-3 text-left">Business Area</th>
          <th class="px-4 py-3 text-left">Aksi</th>
        </tr>
      </thead>
      <tbody>
        @forelse($rows as $i => $row)
        <tr class="hover:bg-slate-50">
          <td class="px-4 py-3">{{ $i + 1 }}</td>
          <td class="px-4 py-3">{{ $row->bawahan->nama ?? '-' }}</td>
          <td class="px-4 py-3">{{ $row->bawahan->nip ?? '-' }}</td>
          <td class="px-4 py-3">{{ $row->bawahan->jabatan->sebutan_jabatan ?? '-' }}</td>
          <td class="px-4 py-3">{{ $row->periode_idp }}</td>
          <td class="px-4 py-3">{{ $row->business_area ?? '-' }}</td>
          <td class="px-4 py-3">
            <button class="text-blue-600 hover:underline mr-2" data-id="{{ $row->id_daftar_idp }}" data-nama="{{ $row->bawahan->nama ?? '' }}" data-nip="{{ $row->bawahan->nip ?? '' }}" data-jabatan="{{ $row->bawahan->id_jabatan ?? '' }}" data-username="{{ $row->bawahan->username ?? '' }}" data-business-area="{{ $row->business_area ?? '' }}" data-periode="{{ $row->periode_idp }}" onclick="editUser(this)">Edit</button>
            <form id="delete-{{ $row->id_daftar_idp }}" class="inline" action="{{ route('atasan.idp.destroy', $row) }}" method="POST" style="display:none;">
              @csrf
              @method('DELETE')
            </form>
            <button class="text-red-600 hover:underline" onclick="deleteUser('{{ $row->id_daftar_idp }}')">Hapus</button>
          </td>
        </tr>
        @empty
        <tr><td colspan="7" class="px-4 py-8 text-center text-slate-400">Tidak ada data</td></tr>
        @endforelse
      </tbody>
    </table>
  </div>
</div>

<div id="addModal" data-modal class="hidden fixed inset-0 z-[100] items-center justify-center overflow-y-auto bg-slate-900/50 p-4 backdrop-blur-sm">
  <form id="addForm" action="{{ route('atasan.idp.store') }}" method="POST" class="my-auto max-h-[calc(100vh-2rem)] w-full max-w-lg overflow-y-auto rounded-2xl bg-white p-6 shadow-xl">
    @csrf
    <div class="grid gap-4">
      <label class="block text-sm font-medium">Nama<input name="nama" class="mt-1 w-full rounded-lg border-slate-300" required></label>
      <label class="block text-sm font-medium">NIP<input name="nip" class="mt-1 w-full rounded-lg border-slate-300" required></label>
      <label class="block text-sm font-medium">Jabatan
        <select name="id_jabatan" class="mt-1 w-full rounded-lg border-slate-300">
          <option value="">Pilih Jabatan</option>
          @foreach($jabatan as $item)
          <option value="{{ $item->id_jabatan }}">{{ $item->sebutan_jabatan }} — {{ $item->job_code }}</option>
          @endforeach
        </select>
      </label>
      <label class="block text-sm font-medium">Username<input name="username" class="mt-1 w-full rounded-lg border-slate-300" required></label>
      <label class="block text-sm font-medium">Password<input name="password" type="password" class="mt-1 w-full rounded-lg border-slate-300" required></label>
      <label class="block text-sm font-medium">Business Area<input name="business_area" class="mt-1 w-full rounded-lg border-slate-300"></label>
      <label class="block text-sm font-medium">Periode<select name="periode_idp" class="mt-1 w-full rounded-lg border-slate-300" required><option>Batch-1</option><option>Batch-2</option></select></label>
    </div>
    <div class="mt-6 flex justify-end gap-3">
      <button type="button" data-close class="px-4 py-2 text-sm font-semibold text-slate-600">Batal</button>
      <button type="submit" class="rounded-lg bg-[#31599b] px-4 py-2 text-sm font-semibold text-white">Simpan</button>
    </div>
  </form>
</div>

<div id="editModal" data-modal class="hidden fixed inset-0 z-[100] items-center justify-center overflow-y-auto bg-slate-900/50 p-4 backdrop-blur-sm">
  <form id="editForm" method="POST" class="my-auto max-h-[calc(100vh-2rem)] w-full max-w-lg overflow-y-auto rounded-2xl bg-white p-6 shadow-xl">
    @csrf
    @method('PUT')
    <div class="grid gap-4">
      <label class="block text-sm font-medium">Nama<input id="editNama" name="nama" class="mt-1 w-full rounded-lg border-slate-300" required></label>
      <label class="block text-sm font-medium">NIP<input id="editNip" name="nip" class="mt-1 w-full rounded-lg border-slate-300" required></label>
      <label class="block text-sm font-medium">Jabatan
        <select id="editJabatan" name="id_jabatan" class="mt-1 w-full rounded-lg border-slate-300">
          <option value="">Pilih Jabatan</option>
          @foreach($jabatan as $item)
          <option value="{{ $item->id_jabatan }}">{{ $item->sebutan_jabatan }} — {{ $item->job_code }}</option>
          @endforeach
        </select>
      </label>
      <label class="block text-sm font-medium">Username<input id="editUsername" name="username" class="mt-1 w-full rounded-lg border-slate-300" required></label>
      <label class="block text-sm font-medium">Password <span class="text-xs text-slate-400">(kosongkan jika tidak diubah)</span><input id="editPassword" name="password" type="password" class="mt-1 w-full rounded-lg border-slate-300"></label>
      <label class="block text-sm font-medium">Business Area<input id="editBusinessArea" name="business_area" class="mt-1 w-full rounded-lg border-slate-300"></label>
      <label class="block text-sm font-medium">Periode<select id="editPeriode" name="periode_idp" class="mt-1 w-full rounded-lg border-slate-300" required><option>Batch-1</option><option>Batch-2</option></select></label>
    </div>
    <div class="mt-6 flex justify-end gap-3">
      <button type="button" data-close-edit class="px-4 py-2 text-sm font-semibold text-slate-600">Batal</button>
      <button type="submit" class="rounded-lg bg-[#31599b] px-4 py-2 text-sm font-semibold text-white">Update</button>
    </div>
  </form>
</div>

<script>
  const importForm = document.querySelector('#importForm');
  const importFile = document.querySelector('#importFile');
  document.querySelector('#importButton').onclick = () => importFile.click();
  importFile.onchange = () => importFile.files.length && importForm.submit();
  const addModal = document.querySelector('#addModal');
  const editModal = document.querySelector('#editModal');
  const editForm = document.querySelector('#editForm');
  document.querySelector('#importButton').onclick = () => Swal.fire({icon:'info',text:'fitur import bawahan belum tersedia.'});
  document.querySelector('#templateButton').onclick = () => Swal.fire({icon:'info',text:'fitur template bawahan belum tersedia.'});
  document.querySelector('#addButton').onclick = () => addModal.classList.replace('hidden', 'flex');
  document.querySelector('[data-close]').onclick = () => addModal.classList.replace('flex', 'hidden');
  document.querySelector('[data-close-edit]').onclick = () => editModal.classList.replace('flex', 'hidden');
  function editUser(button) {
    const data = button.dataset;
    editForm.action = `{{ url('/atasan/idp/daftar') }}/${data.id}`;
    document.querySelector('#editNama').value = data.nama;
    document.querySelector('#editNip').value = data.nip;
    document.querySelector('#editJabatan').value = data.jabatan;
    document.querySelector('#editUsername').value = data.username;
    document.querySelector('#editPassword').value = '';
    document.querySelector('#editBusinessArea').value = data.businessArea;
    document.querySelector('#editPeriode').value = data.periode;
    editModal.classList.replace('hidden', 'flex');
  }
  function deleteUser(id) {
    Swal.fire({
      icon: 'warning',
      text: 'Hapus bawahan ini?',
      showCancelButton: true,
      confirmButtonText: 'Hapus',
      cancelButtonText: 'Batal',
    }).then((result) => {
      if (result.isConfirmed) document.getElementById('delete-' + id).submit();
    });
  }
</script>
@endsection
