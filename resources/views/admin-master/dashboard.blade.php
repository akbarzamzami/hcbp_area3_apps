@extends('layouts.app', ['title' => 'HCBP Area 3 Apps - Dashboard'])

@section('content')
<div class="relative overflow-hidden rounded-2xl bg-white border border-slate-200 h-[220px] flex items-center">
  <div class="absolute inset-0 z-0">
    <div class="w-full h-full" style="background-image: url('https://lh3.googleusercontent.com/aida-public/AB6AXuCjz6BR9t1xAm_4yTRtjUFCuOHqIkeE5EKFN9IU8hG8k_u3B7psxquSS6Suk591TY9q_Y27C-c3_8Z_HW-o9T4mcs-BSs8NcCHUUxWxaIBP5fVyRf74hO-H-p4ikb76omJMmeg7ue3VDxPp1T-0X1MDCB76X944-1OQyLGojPYj3yPCpw1wjdFvEbWlt83s8VQfKiYaIR8j8f1RfVnP8NMKIKcRo4783TuNbljKJLkY62hs9DzkeU81TZVA3E9SyXdF3Ck'); background-size: cover; background-position: center right;"></div>
    <div class="absolute inset-0 bg-gradient-to-r from-white via-white/85 to-transparent"></div>
  </div>
  <div class="relative z-10 px-8 max-w-xl">
    <h1 class="text-[27px] font-bold text-[#0a192f] mb-2 leading-tight">Selamat Datang di HCBP AREA 3 APPS</h1>
    <p class="text-slate-500 text-[15px]">Kelola kompetensi, sertifikasi, dan pengembangan SDM secara terintegrasi.</p>
  </div>
</div>
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-5">
  <div class="bg-white border border-[#E9EDF3] rounded-2xl shadow-sm p-5 flex items-center gap-4">
    <div class="w-12 h-12 rounded-full bg-[#0a192f] flex items-center justify-center text-white shrink-0"><span class="material-symbols-outlined">trending_up</span></div>
    <div class="flex-1">
      <p class="text-[12px] text-slate-400 leading-tight">Capaian Kinerja Sem 1 2026</p>
      <h3 class="text-[24px] font-bold text-[#0a192f] leading-tight">86,4%</h3>
      <p class="text-[11px] text-slate-400">Capaian</p>
    </div>
    <div class="text-right shrink-0"><span class="text-[12px] font-bold text-emerald-500">↑ 8,7%</span>
      <p class="text-[10px] text-slate-400 whitespace-nowrap">dari Sem 2 2025</p>
    </div>
  </div>
  <div class="bg-white border border-[#E9EDF3] rounded-2xl shadow-sm p-5 flex items-center gap-4">
    <div class="w-12 h-12 rounded-full bg-emerald-500 flex items-center justify-center text-white shrink-0"><span class="material-symbols-outlined filled">groups</span></div>
    <div class="flex-1">
      <p class="text-[12px] text-slate-400 leading-tight">IDP Talent Home Coming</p>
      <h3 class="text-[24px] font-bold text-[#0a192f] leading-tight">732</h3>
      <p class="text-[11px] text-slate-400">IDP Aktif</p>
    </div>
    <div class="text-right shrink-0"><span class="text-[12px] font-bold text-emerald-500">↑ 12,5%</span>
      <p class="text-[10px] text-slate-400 whitespace-nowrap">dari bulan lalu</p>
    </div>
  </div>
  <div class="bg-white border border-[#E9EDF3] rounded-2xl shadow-sm p-5 flex items-center gap-4">
    <div class="w-12 h-12 rounded-full bg-[#0a192f] flex items-center justify-center text-white shrink-0"><span class="material-symbols-outlined filled">workspace_premium</span></div>
    <div class="flex-1">
      <p class="text-[12px] text-slate-400 leading-tight">Data Jumlah Data Tersertifikat Kompetensi</p>
      <h3 class="text-[24px] font-bold text-[#0a192f] leading-tight">1.245</h3>
      <p class="text-[11px] text-slate-400">Data Tersertifikat</p>
    </div>
    <div class="text-right shrink-0"><span class="text-[12px] font-bold text-emerald-500">↑ 9,3%</span>
      <p class="text-[10px] text-slate-400 whitespace-nowrap">dari bulan lalu</p>
    </div>
  </div>
  <div class="bg-white border border-[#E9EDF3] rounded-2xl shadow-sm p-5 flex items-center gap-4">
    <div class="w-12 h-12 rounded-full bg-teal-500 flex items-center justify-center text-white shrink-0"><span class="material-symbols-outlined filled">badge</span></div>
    <div class="flex-1">
      <p class="text-[12px] text-slate-400 leading-tight">Progres Laporan Budaya</p>
      <h3 class="text-[24px] font-bold text-[#0a192f] leading-tight">10%</h3>
      <p class="text-[11px] text-slate-400">Pegawai</p>
    </div>
    <div class="text-right shrink-0"><span class="text-[12px] font-bold text-emerald-500">↑ 4,6%</span>
      <p class="text-[10px] text-slate-400 whitespace-nowrap">dari bulan lalu</p>
    </div>
  </div>
</div>
@endsection