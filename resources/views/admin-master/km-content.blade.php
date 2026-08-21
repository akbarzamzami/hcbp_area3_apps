@extends('layouts.app', ['title' => 'Detail KM HCBP Area 3 - Admin Master'])

@section('content')
<div class="bg-white border border-slate-200 rounded-2xl p-6">
  <h1 class="text-xl font-bold mb-4">Detail KM HCBP Area 3</h1>
  @forelse($contents as $content)
  <div class="border border-slate-200 rounded-xl p-4 mb-4">
    <h3 class="font-semibold text-lg mb-2">{{ $content->judul }}</h3>
    <p class="text-slate-600">{{ $content->konten }}</p>
    <p class="text-xs text-slate-400 mt-2">Terakhir diupdate: {{ $content->updated_at?->format('d/m/Y H:i') ?? '-' }}</p>
  </div>
  @empty
  <p class="text-slate-400 text-center py-8">Tidak ada konten</p>
  @endforelse
</div>
@endsection
