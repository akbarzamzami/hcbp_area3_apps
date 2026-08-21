@extends('layouts.app', ['title' => 'Penetapan IDP - Atasan'])

@section('content')
@if(session('success'))
<script>Swal.fire({icon:'success',text:@json(session('success'))});</script>
@endif
<div class="bg-white border border-slate-200 rounded-2xl overflow-hidden">
  <div class="px-6 py-5 border-b border-slate-200">
    <h1 class="text-xl font-bold">Penetapan IDP</h1>
    <p class="text-sm text-slate-500 mt-1">Usulan kompetensi bawahan yang menunggu persetujuan.</p>
  </div>
  <div class="overflow-x-auto">
    <table class="w-full min-w-[900px] text-sm">
      <thead class="bg-slate-50 text-slate-700">
        <tr>
          <th class="px-4 py-3 text-left">No</th>
          <th class="px-4 py-3 text-left">Bawahan</th>
          <th class="px-4 py-3 text-left">NIP</th>
          <th class="px-4 py-3 text-left">Kompetensi</th>
          <th class="px-4 py-3 text-left">Status</th>
          <th class="px-4 py-3 text-center">Aksi</th>
        </tr>
      </thead>
      <tbody class="divide-y divide-slate-100">
        @forelse($rencana->groupBy('id_daftar_idp') as $group)
          @foreach($group as $groupIndex => $item)
          <tr class="hover:bg-slate-50">
            @if($groupIndex === 0)
            <td class="px-4 py-3 align-top" rowspan="{{ $group->count() }}">{{ $loop->parent->iteration }}</td>
            <td class="px-4 py-3 font-medium align-top" rowspan="{{ $group->count() }}">{{ $item->daftarIdp->bawahan->nama ?? '-' }}</td>
            <td class="px-4 py-3 align-top" rowspan="{{ $group->count() }}">{{ $item->daftarIdp->bawahan->nip ?? '-' }}</td>
            @endif
            <td class="px-4 py-3"><span class="font-medium">{{ $item->kompetensi->kode_kompetensi }}</span><br><span class="text-xs text-slate-500">{{ $item->kompetensi->nama_kompetensi }}</span></td>
            <td class="px-4 py-3"><span class="rounded bg-yellow-100 px-2 py-1 text-xs font-medium text-yellow-700">Diajukan</span></td>
            <td class="px-4 py-3 text-center">
              <button type="button" class="rounded-lg border border-[#31599b] px-3 py-1.5 text-xs font-semibold text-[#31599b] hover:bg-blue-50" data-id="{{ $item->id_rencana }}" data-name="{{ $item->daftarIdp->bawahan->nama ?? '-' }}" data-kode="{{ $item->kompetensi->kode_kompetensi }}" data-kompetensi="{{ $item->kompetensi->nama_kompetensi }}" data-p10="{{ $item->pembelajaran_10_persen }}" data-s20="{{ $item->social_learning_20_persen }}" data-a70="{{ $item->action_learning_70_persen }}" onclick="openReview(this)">Review</button>
            </td>
          </tr>
          @endforeach
        @empty
        <tr><td colspan="6" class="px-4 py-10 text-center text-slate-400">Tidak ada usulan yang menunggu persetujuan.</td></tr>
        @endforelse
      </tbody>
    </table>
  </div>
</div>

<div id="reviewModal" data-modal class="hidden fixed inset-0 z-[100] items-center justify-center overflow-y-auto bg-slate-900/50 p-4 backdrop-blur-sm">
  <form id="reviewForm" method="POST" class="my-auto max-h-[calc(100vh-2rem)] w-full max-w-3xl overflow-y-auto rounded-2xl bg-white shadow-xl">
    @csrf
    @method('PUT')
    <div class="flex items-center justify-between border-b border-slate-200 px-6 py-4">
      <div><h2 class="text-lg font-bold">Review Usulan IDP</h2><p id="reviewEmployee" class="text-sm text-slate-500"></p></div>
      <button type="button" class="text-2xl text-slate-400" onclick="closeReview()">&times;</button>
    </div>
    <div class="p-6 space-y-5">
      <div class="rounded-lg bg-slate-50 p-4"><p class="text-xs text-slate-500">Kompetensi</p><p id="reviewCompetency" class="font-semibold"></p></div>
      <div class="grid grid-cols-1 gap-4 md:grid-cols-3 text-sm">
        <div><p class="font-semibold">10% Pembelajaran</p><p id="reviewP10" class="mt-1 text-slate-600 whitespace-pre-line"></p></div>
        <div><p class="font-semibold">20% Social Learning</p><p id="reviewS20" class="mt-1 text-slate-600 whitespace-pre-line"></p></div>
        <div><p class="font-semibold">70% Action Learning</p><p id="reviewA70" class="mt-1 text-slate-600 whitespace-pre-line"></p></div>
      </div>
      <label class="block text-sm font-medium">Feedback Atasan<textarea name="feedback_atasan" required rows="4" class="mt-1 w-full rounded-lg border-slate-300" placeholder="Tulis arahan atau feedback"></textarea></label>
      <input id="reviewStatus" type="hidden" name="status" value="" />
    </div>
    <div class="flex justify-end gap-3 border-t border-slate-200 px-6 py-4">
      <button type="button" class="px-4 py-2 text-sm font-semibold text-slate-600" onclick="closeReview()">Batal</button>
      <button type="button" class="rounded-lg border border-amber-500 px-4 py-2 text-sm font-semibold text-amber-700" onclick="submitReview('Revisi')">Minta Revisi</button>
      <button type="button" class="rounded-lg bg-emerald-600 px-4 py-2 text-sm font-semibold text-white" onclick="submitReview('Disetujui')">Setujui</button>
    </div>
  </form>
</div>

<script>
  const reviewModal = document.querySelector('#reviewModal');
  const reviewForm = document.querySelector('#reviewForm');
  function openReview(button) {
    const data = button.dataset;
    reviewForm.action = `{{ url('/atasan/idp/penetapan') }}/${data.id}`;
    document.querySelector('#reviewEmployee').textContent = data.name;
    document.querySelector('#reviewCompetency').textContent = `${data.kode} — ${data.kompetensi}`;
    document.querySelector('#reviewP10').textContent = data.p10 || '-';
    document.querySelector('#reviewS20').textContent = data.s20 || '-';
    document.querySelector('#reviewA70').textContent = data.a70 || '-';
    reviewForm.querySelector('textarea').value = '';
    reviewModal.classList.replace('hidden', 'flex');
  }
  function closeReview() { reviewModal.classList.replace('flex', 'hidden'); }
  function submitReview(status) {
    if (!reviewForm.checkValidity()) { reviewForm.reportValidity(); return; }
    document.querySelector('#reviewStatus').value = status;
    Swal.fire({icon:'question',text:status === 'Disetujui' ? 'Setujui usulan ini?' : 'Kirim usulan untuk revisi?',showCancelButton:true,confirmButtonText:'Ya',cancelButtonText:'Batal'}).then((result) => { if (result.isConfirmed) reviewForm.submit(); });
  }
</script>
@endsection
