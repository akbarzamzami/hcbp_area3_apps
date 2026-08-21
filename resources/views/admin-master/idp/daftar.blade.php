@php($pageTitle = 'Daftar IDP')
@php($heroTitle = 'Daftar IDP')
@php($heroSubtitle = 'Daftar Individual Development Plan seluruh pegawai.')
@php($cardTitle = 'Daftar IDP Pegawai')
@php($activeSection = 'idp')
@php($activePage = 'daftar')

@extends('layouts.app', ['title' => $pageTitle])

@section('content')
<div class="relative overflow-hidden rounded-2xl bg-white border border-slate-200 h-[220px] flex items-center">
  <div class="absolute inset-0 z-0">
    <div class="w-full h-full" style="background-image: url('https://lh3.googleusercontent.com/aida-public/AB6AXuCjz6BR9t1xAm_4yTRtjUFCuOHqIkeE5EKFN9IU8hG8k_u3B7psxquSS6Suk591TY9q_Y27C-c3_8Z_HW-o9T4mcs-BSs8NcCHUUxWxaIBP5fVyRf74hO-H-p4ikb76omJMmeg7ue3VDxPp1T-0X1MDCB76X944-1OQyLGojPYj3yPCpw1wjdFvEbWlt83s8VQfKiYaIR8j8f1RfVnP8NMKIKcRo4783TuNbljKJLkY62hs9DzkeU81TZVA3E9SyXdF3Ck'); background-size: cover; background-position: center right;"></div>
    <div class="absolute inset-0 bg-gradient-to-r from-white via-white/85 to-transparent"></div>
  </div>
  <div class="relative z-10 px-8 max-w-xl">
    <h1 class="text-[27px] font-bold text-[#0a192f] mb-2 leading-tight">{{ $heroTitle }}</h1>
    <p class="text-slate-500 text-[15px]">{{ $heroSubtitle }}</p>
  </div>
</div>

<div class="bg-white border border-slate-200 rounded-2xl overflow-hidden">
  <div class="flex items-center justify-between gap-4 px-6 py-5 border-b border-slate-200">
    <h2 class="text-lg font-bold">{{ $cardTitle }}</h2>
    <span class="text-xs text-slate-400">View Only - Tidak bisa aksi</span>
  </div>
  <div class="overflow-x-auto">
    <table class="min-w-[1200px] w-full text-left text-xs">
      <thead class="bg-[#31599b] text-white">
        <tr>
          <th class="px-4 py-4 font-semibold">No.</th>
          <th class="px-4 py-4 font-semibold">Nama Bawahan</th>
          <th class="px-4 py-4 font-semibold">NIP</th>
          <th class="px-4 py-4 font-semibold">Jabatan</th>
          <th class="px-4 py-4 font-semibold">Unit Induk</th>
          <th class="px-4 py-4 font-semibold">Nama Atasan</th>
          <th class="px-4 py-4 font-semibold">Periode IDP</th>
        </tr>
      </thead>
      <tbody class="divide-y divide-slate-100">
        @forelse($rows as $index => $row)
        <tr>
          <td class="px-4 py-4">{{ $index + 1 }}</td>
          <td class="px-4 py-4 font-medium">{{ $row->bawahan->nama ?? '-' }}</td>
          <td class="px-4 py-4">{{ $row->bawahan->nip ?? '-' }}</td>
          <td class="px-4 py-4">{{ $row->bawahan->jabatan->sebutan_jabatan ?? '-' }}</td>
          <td class="px-4 py-4">{{ $row->bawahan->unit_induk ?? '-' }}</td>
          <td class="px-4 py-4">{{ $row->atasan->nama ?? '-' }}</td>
          <td class="px-4 py-4">{{ $row->periode_idp }}</td>
        </tr>
        @empty
        <tr>
          <td class="px-4 py-8 text-center text-slate-500" colspan="7">Belum ada data.</td>
        </tr>
        @endforelse
      </tbody>
    </table>
  </div>
</div>
@endsection
