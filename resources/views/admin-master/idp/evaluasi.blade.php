@php($pageTitle = 'Evaluasi IDP')
@php($activeSection = 'idp')
@php($activePage = 'evaluasi')

@extends('layouts.app', ['title' => $pageTitle])

@section('content')
<div class="relative overflow-hidden rounded-2xl bg-white border border-slate-200 h-[220px] flex items-center">
  <div class="absolute inset-0 z-0">
    <div class="w-full h-full" style="background-image:url('https://lh3.googleusercontent.com/aida-public/AB6AXuCjz6BR9t1xAm_4yTRtjUFCuOHqIkeE5EKFN9IU8hG8k_u3B7psxquSS6Suk591TY9q_Y27C-c3_8Z_HW-o9T4mcs-BSs8NcCHUUxWxaIBP5fVyRf74hO-H-p4ikb76omJMmeg7ue3VDxPp1T-0X1MDCB76X944-1OQyLGojPYj3yPCpw1wjdFvEbWlt83s8VQfKiYaIR8j8f1RfVnP8NMKIKcRo4783TuNbljKJLkY62hs9DzkeU81TZVA3E9SyXdF3Ck'); background-size:cover; background-position:center right;"></div>
    <div class="absolute inset-0 bg-gradient-to-r from-white via-white/85 to-transparent"></div>
  </div>
  <div class="relative z-10 px-8 max-w-xl">
    <h1 class="text-[27px] font-bold text-[#0a192f] mb-2 leading-tight">Evaluasi IDP</h1>
    <p class="text-slate-500 text-[15px]">Evaluasi hasil pengembangan pegawai.</p>
  </div>
</div>
<div class="bg-white border border-slate-200 rounded-2xl overflow-hidden">
  <div class="px-6 py-5 border-b border-slate-200 flex items-center justify-between">
    <h2 class="text-lg font-bold">Hasil Evaluasi IDP</h2><button id="inputButton" class="bg-[#31599b] hover:bg-[#27487d] text-white px-4 py-2 rounded-lg text-sm font-semibold" type="button">+ Input Data</button>
  </div>
  <div class="overflow-x-auto">
    <table class="min-w-[1900px] w-full text-center text-xs">
      <thead class="bg-[#31599b] text-white">
        <tr>
          <th class="px-4 py-4 font-semibold">No</th>
          <th class="px-4 py-4 font-semibold">Nama Karyawan</th>
          <th class="px-4 py-4 font-semibold">Unit Induk</th>
          <th class="px-4 py-4 font-semibold">Bidang / Unit</th>
          <th class="px-4 py-4 font-semibold">Tanggal Mulai</th>
          <th class="px-4 py-4 font-semibold">Adaptation Check (Tingkat)</th>
          <th class="px-4 py-4 font-semibold">Adaptation Check (Nilai)</th>
          <th class="px-4 py-4 font-semibold">KOMPETENSI</th>
          <th class="px-4 py-4 font-semibold">Mid Term Check</th>
          <th class="px-4 py-4 font-semibold">Catatan Atasan</th>
          <th class="px-4 py-4 font-semibold">Final Evaluation</th>
          <th class="px-4 py-4 font-semibold">Final Autonomy Level</th>
          <th class="px-4 py-4 font-semibold">Rekomendasi Keputusan Akhir</th>
          <th class="px-4 py-4 font-semibold">Catatan Atasan</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td class="px-4 py-4" rowspan="3">1</td>
          <td class="px-4 py-4" rowspan="3">Budi Santoso</td>
          <td class="px-4 py-4" rowspan="3">Human Capital</td>
          <td class="px-4 py-4" rowspan="3"></td>
          <td class="px-4 py-4" rowspan="3">2026-08-01</td>
          <td class="px-4 py-4">Sangat Tidak Nyaman</td>
          <td class="px-4 py-4">1,2</td>
          <td class="px-4 py-4">ANA</td>
          <td class="px-4 py-4 bg-orange-100">Level 1 (Directive Autonomy)</td>
          <td class="px-4 py-4"></td>
          <td class="px-4 py-4 bg-orange-100">Level 1 (Directive Autonomy)</td>
          <td class="px-4 py-4">Level 1 (Directive Autonomy)</td>
          <td class="px-4 py-4">Mandiri Penuh / IDP Selesai</td>
          <td class="px-4 py-4"></td>
        </tr>
        <tr>
          <td class="px-4 py-4"></td>
          <td class="px-4 py-4"></td>
          <td class="px-4 py-4">CLE</td>
          <td class="px-4 py-4 bg-yellow-100">Level 2 (Guided Autonomy)</td>
          <td class="px-4 py-4"></td>
          <td class="px-4 py-4 bg-yellow-100">Level 2 (Guided Autonomy)</td>
          <td class="px-4 py-4">Level 2 (Guided Autonomy)</td>
          <td class="px-4 py-4"></td>
          <td class="px-4 py-4"></td>
        </tr>
        <tr>
          <td class="px-4 py-4"></td>
          <td class="px-4 py-4"></td>
          <td class="px-4 py-4">DIL</td>
          <td class="px-4 py-4 bg-green-100">Level 3 (Full Autonomy)</td>
          <td class="px-4 py-4"></td>
          <td class="px-4 py-4 bg-green-100">Level 3 (Full Autonomy)</td>
          <td class="px-4 py-4">Level 3 (Full Autonomy)</td>
          <td class="px-4 py-4"></td>
          <td class="px-4 py-4"></td>
        </tr>
      </tbody>
    </table>
  </div>
</div>
<script>
  document.querySelector('#inputButton').onclick = () => Swal.fire({icon:'info',text:'Input evaluasi belum tersedia.'});
</script>
@endsection