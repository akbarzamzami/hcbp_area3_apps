@extends('layouts.app', ['title' => 'HCBP Area 3 Apps - Atasan'])

@section('content')
<div class="bg-white border border-slate-200 rounded-2xl p-8">
  <h1 class="text-2xl font-bold">Dashboard Atasan</h1>
  <p class="mt-2 text-slate-500">Selamat datang, {{ auth()->user()->nama }}.</p>
</div>
@endsection
