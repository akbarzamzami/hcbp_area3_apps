@extends('layouts.app', ['title' => 'Evaluasi IDP - Atasan'])

@section('content')
@if(session('success'))
<script>Swal.fire({icon:'success',text:@json(session('success'))});</script>
@endif
<div class="bg-white border border-slate-200 rounded-2xl p-6">
  <h1 class="text-xl font-bold mb-4">Berikan Evaluasi dan Feedback</h1>
  <div class="grid gap-4 md:grid-cols-2">
    @forelse($rows as $row)
    <form action="{{ route('atasan.idp.evaluasi.store', $row) }}" method="POST" class="border border-slate-200 rounded-xl p-4">
      @csrf
      <h2 class="font-semibold">{{ $row->bawahan->nama ?? '-' }}</h2>
      <p class="text-xs text-slate-400 mb-4">{{ $row->bawahan->nip ?? '-' }}</p>
      <label class="block text-sm font-medium">Skor (0-100)<input name="skor" type="number" min="0" max="100" required class="mt-1 w-full rounded-lg border-slate-300" /></label>
      <label class="block text-sm font-medium mt-3">Feedback<textarea name="feedback" required class="mt-1 w-full rounded-lg border-slate-300" rows="3"></textarea></label>
      <button type="submit" class="mt-4 rounded-lg bg-[#31599b] px-4 py-2 text-sm font-semibold text-white">Simpan Evaluasi</button>
    </form>
    @empty
    <p class="text-slate-400">Tidak ada bawahan.</p>
    @endforelse
  </div>
</div>

<div class="bg-white border border-slate-200 rounded-2xl p-6">
  <h2 class="text-xl font-bold mb-4">Riwayat Feedback</h2>
  <div class="overflow-x-auto">
    <table class="w-full text-sm">
      <thead class="bg-slate-50"><tr><th class="px-4 py-3 text-left">Bawahan</th><th class="px-4 py-3 text-left">Skor</th><th class="px-4 py-3 text-left">Feedback</th><th class="px-4 py-3 text-left">Tanggal</th></tr></thead>
      <tbody>
        @forelse($evaluasi as $item)
        <tr><td class="px-4 py-3">{{ $item->daftarIdp->bawahan->nama ?? '-' }}</td><td class="px-4 py-3">{{ $item->skor }}</td><td class="px-4 py-3">{{ $item->feedback }}</td><td class="px-4 py-3">{{ $item->tanggal_evaluasi?->format('d/m/Y') }}</td></tr>
        @empty
        <tr><td colspan="4" class="px-4 py-8 text-center text-slate-400">Belum ada evaluasi.</td></tr>
        @endforelse
      </tbody>
    </table>
  </div>
</div>
@endsection
