@extends('layouts.app', ['title' => 'Setting Role - Admin Master'])

@section('content')
@if(session('success'))
<script>Swal.fire({icon:'success',text:@json(session('success'))});</script>
@endif
<div class="bg-white border border-slate-200 rounded-2xl p-6">
  <div class="flex items-center justify-between mb-4">
    <h1 class="text-xl font-bold">Setting Role</h1>
    <button id="addButton" class="rounded-lg bg-[#31599b] px-4 py-2 text-sm font-semibold text-white hover:bg-[#27487d]" type="button">Tambah Pengguna</button>
  </div>
  <div class="overflow-x-auto">
    <table class="w-full text-sm">
      <thead class="bg-slate-50">
        <tr>
          <th class="px-4 py-3 text-left">No</th>
          <th class="px-4 py-3 text-left">Nama</th>
          <th class="px-4 py-3 text-left">NIP</th>
          <th class="px-4 py-3 text-left">Username</th>
          <th class="px-4 py-3 text-left">Jabatan</th>
          <th class="px-4 py-3 text-left">Role</th>
          <th class="px-4 py-3 text-left">Unit Induk</th>
          <th class="px-4 py-3 text-left">Status</th>
          <th class="px-4 py-3 text-left">Aksi</th>
        </tr>
      </thead>
      <tbody>
        @forelse($pengguna as $i => $p)
        <tr class="hover:bg-slate-50">
          <td class="px-4 py-3">{{ $i + 1 }}</td>
          <td class="px-4 py-3">{{ $p->nama }}</td>
          <td class="px-4 py-3">{{ $p->nip }}</td>
          <td class="px-4 py-3">{{ $p->username }}</td>
          <td class="px-4 py-3">{{ $p->jabatan->sebutan_jabatan ?? '-' }}</td>
          <td class="px-4 py-3">
            <span class="px-2 py-1 rounded text-xs font-medium {{ $p->role === 'admin_master' ? 'bg-purple-100 text-purple-700' : ($p->role === 'admin_area' ? 'bg-blue-100 text-blue-700' : ($p->role === 'atasan' ? 'bg-green-100 text-green-700' : 'bg-gray-100 text-gray-700')) }}">
              {{ ucfirst(str_replace('_', ' ', $p->role)) }}
            </span>
          </td>
          <td class="px-4 py-3">{{ $p->unit_induk ?? '-' }}</td>
          <td class="px-4 py-3">
            <span class="px-2 py-1 rounded text-xs font-medium {{ $p->status_aktif ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
              {{ $p->status_aktif ? 'Aktif' : 'Nonaktif' }}
            </span>
          </td>
          <td class="px-4 py-3">
            <button class="text-blue-600 hover:underline mr-2" data-id="{{ $p->id_pengguna }}" data-nama="{{ $p->nama }}" data-nip="{{ $p->nip }}" data-jabatan="{{ $p->id_jabatan }}" data-username="{{ $p->username }}" data-role="{{ $p->role }}" data-unit="{{ $p->unit_induk }}" data-status="{{ $p->status_aktif }}" onclick="editUser(this)">Edit</button>
            <form id="delete-{{ $p->id_pengguna }}" class="inline" action="{{ route('admin-master.setting-role.destroy', $p->id_pengguna) }}" method="POST" style="display: none;">
              @csrf
              @method('DELETE')
            </form>
            <button class="text-red-600 hover:underline" onclick="deleteUser('{{ $p->id_pengguna }}')">Hapus</button>
          </td>
        </tr>
        @empty
        <tr><td colspan="8" class="px-4 py-8 text-center text-slate-400">Tidak ada data</td></tr>
        @endforelse
      </tbody>
    </table>
  </div>
</div>

<div id="addModal" data-modal class="hidden fixed inset-0 z-[100] items-center justify-center overflow-y-auto bg-slate-900/50 p-4 backdrop-blur-sm">
  <form id="addForm" action="{{ route('admin-master.setting-role.store') }}" method="POST" class="my-auto max-h-[calc(100vh-2rem)] w-full max-w-lg overflow-y-auto rounded-2xl bg-white p-6 shadow-xl">
    @csrf
    <div class="mb-5 flex items-center justify-between">
      <h2 class="text-xl font-bold">Tambah Pengguna</h2>
      <button type="button" class="text-2xl text-slate-400" data-close>&times;</button>
    </div>
    <div class="space-y-4">
      <label class="block text-sm font-medium">Nama<input name="nama" required class="mt-1 w-full rounded-lg border-slate-300" type="text" /></label>
      <label class="block text-sm font-medium">NIP<input name="nip" required class="mt-1 w-full rounded-lg border-slate-300" type="text" /></label>
      <label class="block text-sm font-medium">Jabatan
        <select name="id_jabatan" class="mt-1 w-full rounded-lg border-slate-300">
          <option value="">Pilih Jabatan</option>
          @foreach($jabatan as $item)
          <option value="{{ $item->id_jabatan }}">{{ $item->sebutan_jabatan }} — {{ $item->job_code }}</option>
          @endforeach
        </select>
      </label>
      <label class="block text-sm font-medium">Username<input name="username" required class="mt-1 w-full rounded-lg border-slate-300" type="text" /></label>
      <label class="block text-sm font-medium">Password<input name="password" required class="mt-1 w-full rounded-lg border-slate-300" type="password" /></label>
      <label class="block text-sm font-medium">Role
        <select name="role" required class="mt-1 w-full rounded-lg border-slate-300">
          <option value="">Pilih Role</option>
          <option value="admin_master">Admin Master</option>
          <option value="admin_area">Admin Area</option>
          <option value="atasan">Atasan</option>
          <option value="bawahan">Bawahan</option>
        </select>
      </label>
      <label class="block text-sm font-medium">Unit Induk
        <select name="unit_induk" class="mt-1 w-full rounded-lg border-slate-300">
          <option value="">Pilih Unit Induk</option>
          <option value="UID S2JB">UID S2JB</option>
          <option value="UID LAMPUNG">UID LAMPUNG</option>
          <option value="UIP SUMBAGSEL">UIP SUMBAGSEL</option>
          <option value="UIW BABEL">UIW BABEL</option>
        </select>
      </label>
      <label class="block text-sm font-medium">Status
        <select name="status_aktif" required class="mt-1 w-full rounded-lg border-slate-300">
          <option value="1">Aktif</option>
          <option value="0">Nonaktif</option>
        </select>
      </label>
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
    <div class="mb-5 flex items-center justify-between">
      <h2 class="text-xl font-bold">Edit Pengguna</h2>
      <button type="button" class="text-2xl text-slate-400" data-close-edit>&times;</button>
    </div>
    <div class="space-y-4">
      <label class="block text-sm font-medium">Nama<input id="editNama" name="nama" required class="mt-1 w-full rounded-lg border-slate-300" type="text" /></label>
      <label class="block text-sm font-medium">NIP<input id="editNip" name="nip" required class="mt-1 w-full rounded-lg border-slate-300" type="text" /></label>
      <label class="block text-sm font-medium">Jabatan
        <select id="editJabatan" name="id_jabatan" class="mt-1 w-full rounded-lg border-slate-300">
          <option value="">Pilih Jabatan</option>
          @foreach($jabatan as $item)
          <option value="{{ $item->id_jabatan }}">{{ $item->sebutan_jabatan }} — {{ $item->job_code }}</option>
          @endforeach
        </select>
      </label>
      <label class="block text-sm font-medium">Username<input id="editUsername" name="username" required class="mt-1 w-full rounded-lg border-slate-300" type="text" /></label>
      <label class="block text-sm font-medium">Password <span class="text-xs text-slate-400">(kosongkan jika tidak diubah)</span><input id="editPassword" name="password" class="mt-1 w-full rounded-lg border-slate-300" type="password" /></label>
      <label class="block text-sm font-medium">Role
        <select id="editRole" name="role" required class="mt-1 w-full rounded-lg border-slate-300">
          <option value="admin_master">Admin Master</option>
          <option value="admin_area">Admin Area</option>
          <option value="atasan">Atasan</option>
          <option value="bawahan">Bawahan</option>
        </select>
      </label>
      <label class="block text-sm font-medium">Unit Induk
        <select id="editUnit" name="unit_induk" class="mt-1 w-full rounded-lg border-slate-300">
          <option value="">Pilih Unit Induk</option>
          <option value="UID S2JB">UID S2JB</option>
          <option value="UID LAMPUNG">UID LAMPUNG</option>
          <option value="UIP SUMBAGSEL">UIP SUMBAGSEL</option>
          <option value="UIW BABEL">UIW BABEL</option>
        </select>
      </label>
      <label class="block text-sm font-medium">Status
        <select id="editStatus" name="status_aktif" required class="mt-1 w-full rounded-lg border-slate-300">
          <option value="1">Aktif</option>
          <option value="0">Nonaktif</option>
        </select>
      </label>
    </div>
    <div class="mt-6 flex justify-end gap-3">
      <button type="button" data-close-edit class="px-4 py-2 text-sm font-semibold text-slate-600">Batal</button>
      <button type="submit" class="rounded-lg bg-[#31599b] px-4 py-2 text-sm font-semibold text-white">Update</button>
    </div>
  </form>
</div>

<script>
  const addModal = document.querySelector('#addModal');
  const editModal = document.querySelector('#editModal');
  const editForm = document.querySelector('#editForm');

  document.querySelector('#addButton').onclick = () => addModal.classList.replace('hidden', 'flex');
  document.querySelectorAll('[data-close]').forEach((btn) => btn.onclick = () => addModal.classList.replace('flex', 'hidden'));
  document.querySelectorAll('[data-close-edit]').forEach((btn) => btn.onclick = () => editModal.classList.replace('flex', 'hidden'));

  function editUser(button) {
    const data = button.dataset;
    editForm.action = `{{ url('/admin-master/setting-role') }}/${data.id}`;
    document.querySelector('#editNama').value = data.nama;
    document.querySelector('#editNip').value = data.nip;
    document.querySelector('#editJabatan').value = data.jabatan || '';
    document.querySelector('#editUsername').value = data.username;
    document.querySelector('#editRole').value = data.role;
    document.querySelector('#editUnit').value = data.unit || '';
    document.querySelector('#editStatus').value = data.status;
    document.querySelector('#editPassword').value = '';
    editModal.classList.replace('hidden', 'flex');
  }

  function deleteUser(id) {
    Swal.fire({
      icon: 'warning',
      text: 'Hapus pengguna ini?',
      showCancelButton: true,
      confirmButtonText: 'Hapus',
      cancelButtonText: 'Batal',
    }).then((result) => {
      if (result.isConfirmed) {
        document.getElementById('delete-' + id).submit();
      }
    });
  }
</script>
@endsection
