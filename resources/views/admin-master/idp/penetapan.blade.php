@php($pageTitle = 'Penetapan IDP')
@php($heroTitle = 'Penetapan IDP')
@php($heroSubtitle = 'Tetapkan rencana pengembangan pegawai.')
@php($cardTitle = 'Penetapan IDP')
@php($activeSection = 'idp')
@php($activePage = 'penetapan')

@extends('layouts.app', ['title' => $pageTitle])

@section('content')
<div class="relative overflow-hidden rounded-2xl bg-white border border-slate-200 h-[220px] flex items-center">
  <div class="absolute inset-0 z-0">
    <div class="w-full h-full" style="background-image: url(&quot;https://lh3.googleusercontent.com/aida-public/AB6AXuCjz6BR9t1xAm_4yTRtjUFCuOHqIkeE5EKFN9IU8hG8k_u3B7psxquSS6Suk591TY9q_Y27C-c3_8Z_HW-o9T4mcs-BSs8NcCHUUxWxaIBP5fVyRf74hO-H-p4ikb76omJMmeg7ue3VDxPp1T-0X1MDCB76X944-1OQyLGojPYj3yPCpw1wjdFvEbWlt83s8VQfKiYaIR8j8f1RfVnP8NMKIKcRo4783TuNbljKJLkY62hs9DzkeU81TZVA3E9SyXdF3Ck&quot;); background-size: cover; background-position: center right;"></div>
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
  </div>
  <div class="overflow-x-auto">
    <table class="min-w-[1900px] w-full text-left text-xs">
      <thead class="text-white">
        <tr class="bg-[#31599b]">
          <th class="px-4 py-4 font-semibold" rowspan="2">No</th>
          <th class="px-4 py-4 font-semibold" rowspan="2">Nama Pegawai</th>
          <th class="px-4 py-4 font-semibold" rowspan="2">Jabatan</th>
          <th class="px-4 py-4 font-semibold" rowspan="2">Unit Induk</th>
          <th class="px-4 py-4 font-semibold" colspan="3">Kompetensi Target</th>
          <th class="px-4 py-4 font-semibold" rowspan="2">Rencana IDP</th>
          <th class="px-4 py-4 font-semibold" rowspan="2">Aksi</th>
        </tr>
        <tr class="bg-[#31599b]">
          <th class="px-4 py-4 font-semibold">KOMPETENSI INTI</th>
          <th class="px-4 py-4 font-semibold">KOMPETENSI FUNGSIONAL</th>
          <th class="px-4 py-4 font-semibold">KOMPETENSI LAIN</th>
        </tr>
      </thead>
      <tbody class="divide-y divide-slate-100">
        <tr>
          <td class="px-4 py-4">1</td>
          <td class="px-4 py-4 font-medium">Budi Santoso</td>
          <td class="px-4 py-4">Human Capital Analyst</td>
          <td class="px-4 py-4">UID S2JB</td>
          <td class="px-4 py-4">Komunikasi</td>
          <td class="px-4 py-4">Analisis Data</td>
          <td class="px-4 py-4">Manajemen Waktu</td>
          <td class="px-4 py-4">
            <ul class="list-disc pl-5 space-y-1">
              <li>Ikuti pelatihan komunikasi</li>
              <li>Buat laporan analisis data</li>
              <li>Gunakan tools manajemen waktu</li>
            </ul>
          </td>
          <td class="px-4 py-4">
            <button class="text-[#31599b] font-semibold text-sm">Edit</button>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
  <div class="border-t border-slate-200 px-6 py-4 text-xs text-slate-500">
    <p>Data penetapan Individual Development Plan.</p>
  </div>
</div>
@endsection