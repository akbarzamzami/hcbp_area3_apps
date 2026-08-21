@extends('layouts.app', ['title' => 'Evaluasi IDP - Bawahan'])

@section('content')
<div class="bg-white border border-slate-200 rounded-2xl p-6">
  <h1 class="text-xl font-bold mb-4">Hasil Evaluasi</h1>
  <div class="space-y-4">
    @forelse($evaluasi as $item)
    <div class="border border-slate-200 rounded-xl p-4">
      <div class="flex items-center justify-between">
        <h2 class="font-semibold">{{ $item->daftarIdp->atasan->nama ?? '-' }}</h2>
        <span class="text-sm text-slate-500">{{ $item->tanggal_evaluasi?->format('d/m/Y') }}</span>
      </div>
      <p class="mt-2 text-sm"><strong>Skor:</strong> {{ $item->skor }}</p>
      <p class="mt-2 text-sm"><strong>Feedback:</strong> {{ $item->feedback }}</p>
    </div>
    @empty
    <p class="text-slate-400">Belum ada feedback.</p>
    @endforelse
  </div>
</div>
@endsection
