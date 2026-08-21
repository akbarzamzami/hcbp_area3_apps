@extends('layouts.app', ['title' => 'Pemantauan IDP - Atasan'])

@section('content')
@if(session('success'))
<script>Swal.fire({icon:'success',text:@json(session('success'))});</script>
@endif
<div class="bg-white border border-slate-200 rounded-2xl p-6">
  <h1 class="text-xl font-bold mb-4">Pemantauan IDP - Bawahan Saya</h1>
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
          <th class="px-4 py-3 text-left">Aksi</th>
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
          <td class="px-4 py-3">
            <button class="text-blue-600 hover:underline" data-id="{{ $row->id_daftar_idp }}" data-status="{{ $row->monitoring->status_perencanaan ?? 'Diajukan' }}" data-progress="{{ $row->monitoring->progress_percent ?? 0 }}" data-pembelajaran="{{ $row->monitoring->pembelajaran_10_persen ?? '' }}" data-social="{{ $row->monitoring->social_learning_20_persen ?? '' }}" data-experimental="{{ $row->monitoring->experimental_learning_70_persen ?? '' }}" onclick="editPemantauan(this)">Update</button>
          </td>
        </tr>
        @empty
        <tr><td colspan="8" class="px-4 py-8 text-center text-slate-400">Tidak ada data</td></tr>
        @endforelse
      </tbody>
    </table>
  </div>
</div>

<div id="editModal" data-modal class="hidden fixed inset-0 z-[100] items-center justify-center overflow-y-auto bg-slate-900/50 p-4 backdrop-blur-sm">
  <form id="editForm" method="POST" class="my-auto max-h-[calc(100vh-2rem)] w-full max-w-2xl overflow-y-auto rounded-2xl bg-white p-6 shadow-xl">
    @csrf
    @method('PUT')
    <div class="mb-5 flex items-center justify-between">
      <h2 class="text-xl font-bold">Update Pemantauan IDP</h2>
      <button type="button" class="text-2xl text-slate-400" onclick="closePemantauan()">&times;</button>
    </div>
    <div class="grid gap-4 md:grid-cols-2">
      <label class="text-sm font-medium">Status Perencanaan
        <select id="statusPerencanaan" name="status_perencanaan" required class="mt-1 w-full rounded-lg border-slate-300">
          <option value="Diajukan">Diajukan</option>
          <option value="Revisi">Revisi</option>
          <option value="Disetujui">Disetujui</option>
          <option value="Berjalan">Berjalan</option>
          <option value="Selesai">Selesai</option>
        </select>
      </label>
      <label class="text-sm font-medium">Progress (%)<input id="progressPercent" name="progress_percent" min="0" max="100" required class="mt-1 w-full rounded-lg border-slate-300" type="number" /></label>
      <label class="text-sm font-medium">10% Pembelajaran<textarea id="pembelajaran" name="pembelajaran_10_persen" class="mt-1 w-full rounded-lg border-slate-300"></textarea></label>
      <label class="text-sm font-medium">20% Social Learning<textarea id="social" name="social_learning_20_persen" class="mt-1 w-full rounded-lg border-slate-300"></textarea></label>
      <label class="text-sm font-medium md:col-span-2">70% Experimental Learning<textarea id="experimental" name="experimental_learning_70_persen" class="mt-1 w-full rounded-lg border-slate-300"></textarea></label>
    </div>
    <div class="mt-6 flex justify-end gap-3">
      <button type="button" class="px-4 py-2 text-sm font-semibold text-slate-600" onclick="closePemantauan()">Batal</button>
      <button type="submit" class="rounded-lg bg-[#31599b] px-4 py-2 text-sm font-semibold text-white">Simpan</button>
    </div>
  </form>
</div>
<script>
  const editModal = document.querySelector('#editModal');
  const editForm = document.querySelector('#editForm');
  function editPemantauan(button) {
    const data = button.dataset;
    editForm.action = `{{ url('/atasan/idp/pemantauan') }}/${data.id}`;
    document.querySelector('#statusPerencanaan').value = data.status;
    document.querySelector('#progressPercent').value = data.progress;
    document.querySelector('#pembelajaran').value = data.pembelajaran;
    document.querySelector('#social').value = data.social;
    document.querySelector('#experimental').value = data.experimental;
    editModal.classList.replace('hidden', 'flex');
  }
  function closePemantauan() { editModal.classList.replace('flex', 'hidden'); }
</script>
@endsection
