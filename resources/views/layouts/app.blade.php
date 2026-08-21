<!doctype html>
<html lang="id">
  <head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>{{ $title ?? 'HCBP Area 3 Apps' }}</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link
      href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap"
      rel="stylesheet"
    />
    <link
      href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap"
      rel="stylesheet"
    />
    <style>
      body {
        font-family: "Plus Jakarta Sans", sans-serif;
        background-color: #f8fafc;
        color: #0a192f;
      }
      .material-symbols-outlined {
        font-variation-settings:
          "FILL" 0,
          "wght" 400,
          "GRAD" 0,
          "opsz" 24;
      }
      .material-symbols-outlined.filled {
        font-variation-settings: "FILL" 1;
      }
      ::-webkit-scrollbar {
        width: 6px;
      }
      ::-webkit-scrollbar-track {
        background: transparent;
      }
      ::-webkit-scrollbar-thumb {
        background: #cbd5e1;
        border-radius: 4px;
      }
      ::-webkit-scrollbar-thumb:hover {
        background: #94a3b8;
      }
      table {
        border-collapse: collapse;
      }
      th,
      td {
        border: 1px solid #cbd5e1;
      }
    </style>
  </head>
  <body class="flex h-screen overflow-hidden antialiased">
    <aside class="w-[300px] flex-shrink-0 flex flex-col h-full bg-white border-r border-slate-200 hidden md:flex">
      <div class="px-6 pt-7 pb-4">
        <h2 class="text-[22px] font-bold tracking-tight text-[#0a192f]">HCBP Area 3 Apps</h2>
        <p class="text-xs text-slate-400 mt-1">{{ ucfirst(str_replace('_', ' ', auth()->user()->role)) }}</p>
      </div>
      <nav class="px-4 space-y-1 flex-1">
        @if(auth()->user()->role === 'admin_master')
          <a class="flex items-center gap-3 px-4 py-3 rounded-xl font-semibold {{ request()->routeIs('admin-master.dashboard') ? 'bg-slate-100' : '' }}" href="{{ route('admin-master.dashboard') }}">
            <span class="material-symbols-outlined filled text-[20px]">dashboard</span>
            <span class="text-[15px]">Dashboard</span>
          </a>
          <details class="open:group" @if(($activeSection ?? '') === 'idp') open @endif>
            <summary class="flex items-center justify-between gap-3 px-4 py-3 text-[#0a192f]/80 hover:bg-slate-50 rounded-xl transition-colors cursor-pointer group">
              <div class="flex items-center gap-3">
                <span class="material-symbols-outlined text-[20px]">people</span>
                <span class="text-[15px] leading-tight">IDP<br /><span class="text-[11px] font-normal text-slate-400">(Individual Development Plan)</span></span>
              </div>
              <span class="material-symbols-outlined text-[16px] text-slate-300 group-open:rotate-90">chevron_right</span>
            </summary>
            <nav class="pl-10 space-y-1 mt-1">
              <a class="flex items-center gap-3 px-4 py-2.5 text-[14px] {{ ($activePage ?? '') === 'daftar' ? 'font-semibold text-[#0a192f] bg-slate-50' : 'text-[#0a192f]/70' }} hover:bg-slate-50 rounded-lg transition-colors" href="{{ route('admin-master.idp.daftar') }}">Daftar IDP</a>
              <a class="flex items-center gap-3 px-4 py-2.5 text-[14px] {{ ($activePage ?? '') === 'penetapan' ? 'font-semibold text-[#0a192f] bg-slate-50' : 'text-[#0a192f]/70' }} hover:bg-slate-50 rounded-lg transition-colors" href="{{ route('admin-master.idp.penetapan') }}">Penetapan IDP</a>
              <a class="flex items-center gap-3 px-4 py-2.5 text-[14px] {{ ($activePage ?? '') === 'pemantauan' ? 'font-semibold text-[#0a192f] bg-slate-50' : 'text-[#0a192f]/70' }} hover:bg-slate-50 rounded-lg transition-colors" href="{{ route('admin-master.idp.pemantauan') }}">Pemantauan IDP</a>
              <a class="flex items-center gap-3 px-4 py-2.5 text-[14px] {{ ($activePage ?? '') === 'evaluasi' ? 'font-semibold text-[#0a192f] bg-slate-50' : 'text-[#0a192f]/70' }} hover:bg-slate-50 rounded-lg transition-colors" href="{{ route('admin-master.idp.evaluasi') }}">Evaluasi IDP</a>
            </nav>
          </details>
          <a class="flex items-center justify-between gap-3 px-4 py-3 text-[#0a192f]/80 hover:bg-slate-50 rounded-xl transition-colors group" href="{{ route('admin-master.sertifikat') }}">
            <div class="flex items-center gap-3">
              <span class="material-symbols-outlined text-[20px]">workspace_premium</span>
              <span class="text-[15px]">Sertifikat Kompetensi</span>
            </div>
            <span class="material-symbols-outlined text-[16px] text-slate-300">chevron_right</span>
          </a>
          <a class="flex items-center justify-between gap-3 px-4 py-3 text-[#0a192f]/80 hover:bg-slate-50 rounded-xl transition-colors group" href="{{ route('admin-master.setting-role') }}">
            <div class="flex items-center gap-3">
              <span class="material-symbols-outlined text-[20px]">settings_account_box</span>
              <span class="text-[15px]">Setting Role</span>
            </div>
            <span class="material-symbols-outlined text-[16px] text-slate-300">chevron_right</span>
          </a>
          <a class="flex items-center justify-between gap-3 px-4 py-3 text-[#0a192f]/80 hover:bg-slate-50 rounded-xl transition-colors group" href="{{ route('admin-master.km-content') }}">
            <div class="flex items-center gap-3">
              <span class="material-symbols-outlined text-[20px]">assignment</span>
              <span class="text-[15px]">Detail KM HCBP Area 3</span>
            </div>
            <span class="material-symbols-outlined text-[16px] text-slate-300">chevron_right</span>
          </a>
        @elseif(auth()->user()->role === 'admin_area')
          <a class="flex items-center gap-3 px-4 py-3 rounded-xl font-semibold {{ request()->routeIs('admin-area.dashboard') ? 'bg-slate-100' : '' }}" href="{{ route('admin-area.dashboard') }}">
            <span class="material-symbols-outlined filled text-[20px]">dashboard</span>
            <span class="text-[15px]">Dashboard</span>
          </a>
          <details class="open:group" @if(($activeSection ?? '') === 'idp') open @endif>
            <summary class="flex items-center justify-between gap-3 px-4 py-3 text-[#0a192f]/80 hover:bg-slate-50 rounded-xl transition-colors cursor-pointer group">
              <div class="flex items-center gap-3">
                <span class="material-symbols-outlined text-[20px]">people</span>
                <span class="text-[15px] leading-tight">IDP<br /><span class="text-[11px] font-normal text-slate-400">(Individual Development Plan)</span></span>
              </div>
              <span class="material-symbols-outlined text-[16px] text-slate-300 group-open:rotate-90">chevron_right</span>
            </summary>
            <nav class="pl-10 space-y-1 mt-1">
              <a class="flex items-center gap-3 px-4 py-2.5 text-[14px] {{ ($activePage ?? '') === 'daftar' ? 'font-semibold text-[#0a192f] bg-slate-50' : 'text-[#0a192f]/70' }} hover:bg-slate-50 rounded-lg transition-colors" href="{{ route('admin-area.idp.daftar') }}">Daftar IDP</a>
              <a class="flex items-center gap-3 px-4 py-2.5 text-[14px] {{ ($activePage ?? '') === 'penetapan' ? 'font-semibold text-[#0a192f] bg-slate-50' : 'text-[#0a192f]/70' }} hover:bg-slate-50 rounded-lg transition-colors" href="{{ route('admin-area.idp.penetapan') }}">Penetapan IDP</a>
              <a class="flex items-center gap-3 px-4 py-2.5 text-[14px] {{ ($activePage ?? '') === 'pemantauan' ? 'font-semibold text-[#0a192f] bg-slate-50' : 'text-[#0a192f]/70' }} hover:bg-slate-50 rounded-lg transition-colors" href="{{ route('admin-area.idp.pemantauan') }}">Pemantauan IDP</a>
              <a class="flex items-center gap-3 px-4 py-2.5 text-[14px] {{ ($activePage ?? '') === 'evaluasi' ? 'font-semibold text-[#0a192f] bg-slate-50' : 'text-[#0a192f]/70' }} hover:bg-slate-50 rounded-lg transition-colors" href="{{ route('admin-area.idp.evaluasi') }}">Evaluasi IDP</a>
            </nav>
          </details>
          <a class="flex items-center justify-between gap-3 px-4 py-3 text-[#0a192f]/80 hover:bg-slate-50 rounded-xl transition-colors group" href="{{ route('admin-area.sertifikat') }}">
            <div class="flex items-center gap-3">
              <span class="material-symbols-outlined text-[20px]">workspace_premium</span>
              <span class="text-[15px]">Sertifikat Kompetensi</span>
            </div>
            <span class="material-symbols-outlined text-[16px] text-slate-300">chevron_right</span>
          </a>
        @elseif(auth()->user()->role === 'atasan')
          <details class="open:group" @if(($activeSection ?? '') === 'idp') open @endif>
            <summary class="flex items-center justify-between gap-3 px-4 py-3 text-[#0a192f]/80 hover:bg-slate-50 rounded-xl transition-colors cursor-pointer group">
              <div class="flex items-center gap-3">
                <span class="material-symbols-outlined text-[20px]">people</span>
                <span class="text-[15px] leading-tight">IDP<br /><span class="text-[11px] font-normal text-slate-400">(Individual Development Plan)</span></span>
              </div>
              <span class="material-symbols-outlined text-[16px] text-slate-300 group-open:rotate-90">chevron_right</span>
            </summary>
            <nav class="pl-10 space-y-1 mt-1">
              <a class="flex items-center gap-3 px-4 py-2.5 text-[14px] {{ ($activePage ?? '') === 'daftar' ? 'font-semibold text-[#0a192f] bg-slate-50' : 'text-[#0a192f]/70' }} hover:bg-slate-50 rounded-lg transition-colors" href="{{ route('atasan.idp.daftar') }}">Daftar IDP</a>
              <a class="flex items-center gap-3 px-4 py-2.5 text-[14px] {{ ($activePage ?? '') === 'penetapan' ? 'font-semibold text-[#0a192f] bg-slate-50' : 'text-[#0a192f]/70' }} hover:bg-slate-50 rounded-lg transition-colors" href="{{ route('atasan.idp.penetapan') }}">Penetapan IDP</a>
              <a class="flex items-center gap-3 px-4 py-2.5 text-[14px] {{ ($activePage ?? '') === 'pemantauan' ? 'font-semibold text-[#0a192f] bg-slate-50' : 'text-[#0a192f]/70' }} hover:bg-slate-50 rounded-lg transition-colors" href="{{ route('atasan.idp.pemantauan') }}">Pemantauan IDP</a>
              <a class="flex items-center gap-3 px-4 py-2.5 text-[14px] {{ ($activePage ?? '') === 'evaluasi' ? 'font-semibold text-[#0a192f] bg-slate-50' : 'text-[#0a192f]/70' }} hover:bg-slate-50 rounded-lg transition-colors" href="{{ route('atasan.idp.evaluasi') }}">Evaluasi IDP</a>
            </nav>
          </details>
        @elseif(auth()->user()->role === 'bawahan')
          <a class="flex items-center gap-3 px-4 py-3 rounded-xl font-semibold {{ request()->routeIs('bawahan.dashboard') ? 'bg-slate-100' : '' }}" href="{{ route('bawahan.dashboard') }}">
            <span class="material-symbols-outlined filled text-[20px]">dashboard</span>
            <span class="text-[15px]">Dashboard</span>
          </a>
          <details class="open:group" @if(($activeSection ?? '') === 'idp') open @endif>
            <summary class="flex items-center justify-between gap-3 px-4 py-3 text-[#0a192f]/80 hover:bg-slate-50 rounded-xl transition-colors cursor-pointer group">
              <div class="flex items-center gap-3">
                <span class="material-symbols-outlined text-[20px]">people</span>
                <span class="text-[15px] leading-tight">IDP Saya<br /><span class="text-[11px] font-normal text-slate-400">(Individual Development Plan)</span></span>
              </div>
              <span class="material-symbols-outlined text-[16px] text-slate-300 group-open:rotate-90">chevron_right</span>
            </summary>
            <nav class="pl-10 space-y-1 mt-1">
              <a class="flex items-center gap-3 px-4 py-2.5 text-[14px] {{ ($activePage ?? '') === 'daftar' ? 'font-semibold text-[#0a192f] bg-slate-50' : 'text-[#0a192f]/70' }} hover:bg-slate-50 rounded-lg transition-colors" href="{{ route('bawahan.idp.daftar') }}">IDP Saya</a>
              <a class="flex items-center gap-3 px-4 py-2.5 text-[14px] {{ ($activePage ?? '') === 'penetapan' ? 'font-semibold text-[#0a192f] bg-slate-50' : 'text-[#0a192f]/70' }} hover:bg-slate-50 rounded-lg transition-colors" href="{{ route('bawahan.idp.penetapan') }}">Penetapan IDP</a>
              <a class="flex items-center gap-3 px-4 py-2.5 text-[14px] {{ ($activePage ?? '') === 'pemantauan' ? 'font-semibold text-[#0a192f] bg-slate-50' : 'text-[#0a192f]/70' }} hover:bg-slate-50 rounded-lg transition-colors" href="{{ route('bawahan.idp.pemantauan') }}">Pemantauan IDP</a>
              <a class="flex items-center gap-3 px-4 py-2.5 text-[14px] {{ ($activePage ?? '') === 'evaluasi' ? 'font-semibold text-[#0a192f] bg-slate-50' : 'text-[#0a192f]/70' }} hover:bg-slate-50 rounded-lg transition-colors" href="{{ route('bawahan.idp.evaluasi') }}">Evaluasi IDP</a>
            </nav>
          </details>
          <a class="flex items-center justify-between gap-3 px-4 py-3 text-[#0a192f]/80 hover:bg-slate-50 rounded-xl transition-colors group" href="{{ route('bawahan.sertifikat') }}">
            <div class="flex items-center gap-3">
              <span class="material-symbols-outlined text-[20px]">workspace_premium</span>
              <span class="text-[15px]">Sertifikat Saya</span>
            </div>
            <span class="material-symbols-outlined text-[16px] text-slate-300">chevron_right</span>
          </a>
        @endif
      </nav>
      <div class="p-4 border-t border-slate-200">
        <form method="POST" action="{{ route('logout') }}">
          @csrf
          <button type="submit" class="flex items-center gap-3 px-4 py-3 w-full text-red-600 hover:bg-red-50 rounded-xl transition-colors">
            <span class="material-symbols-outlined text-[20px]">logout</span>
            <span class="text-[15px]">Logout</span>
          </button>
        </form>
      </div>
    </aside>
    <main class="flex-1 flex flex-col h-full overflow-hidden bg-[#f8fafc]">
      <header class="w-full sticky top-0 bg-white border-b border-slate-200 z-50">
        <div class="flex justify-between items-center px-8 py-3 h-[76px]">
          <div class="flex items-center gap-4">
            <img class="h-8 object-contain" src="https://lh3.googleusercontent.com/aida-public/AB6AXuDDJt_RfDkCMKLoLuYjQYLtTeeZYuMTa2O1KK74i5Y2zWE68LgCQAKwqGFqHHhfiQePnhQf2MTWfLY50j31fy9aKDzdxmSiIxp1rJbnnwdz65t9mKZhBVde2SYu6uD6hj8jouvTIUOkOwQxLOevjpCk0qvGOJmaWk3erhh5QYxh0L6FtUponS26HFWe7F1nlZ1WRrun_MbHApoyLmNMNTrqBLM3updUiayESWApj6UscQr3ETxOGjQz5dNgPjItkfwFshA" alt="Danantara Indonesia logo" />
            <div class="w-px h-7 bg-slate-200"></div>
            <img class="h-8 object-contain" src="https://lh3.googleusercontent.com/aida-public/AB6AXuD6Ys1h54zAgVQsAoiFwQp7pADnJ2Iq1noBOyG4UdPkF5XPbDbBsQwdPZ4BVXO1fgZxQ0kUPVkYqYgkFiZ6qcpo_vtUXO9da5gXTv6VhZznC-8Bwrx4HVm0UwDHBoe7ZuyJ1r01CYAgTuFwuJakEcYRMWYJ5IIiv5IMfogO5YeCdUyjVloAgqQzWVcRX7DMfGcKAmm4U5vYT3Qi1EsljRZOIS2FbXuYmh33c7UCaYufYGs-7Jvgz0UZv2OnZYvy08P3OCU" alt="PLN logo" />
          </div>
          <div class="flex items-center gap-4">
            <button class="relative p-2 rounded-full hover:bg-slate-100 transition-colors text-slate-500" type="button">
              <span class="material-symbols-outlined">notifications</span>
              <span class="absolute -top-0.5 -right-0.5 w-4 h-4 bg-red-500 rounded-full border-2 border-white text-[9px] text-white flex items-center justify-center font-bold">3</span>
            </button>
            <div class="flex items-center gap-3 cursor-pointer hover:bg-slate-50 p-1 pr-3 rounded-full transition-colors">
              <div class="w-9 h-9 rounded-full bg-gradient-to-br from-indigo-500 to-purple-600 text-white flex items-center justify-center text-sm font-semibold">{{ strtoupper(substr(auth()->user()->nama, 0, 2)) }}</div>
              <div class="hidden md:flex flex-col">
                <span class="text-[13px] font-semibold text-[#0a192f] leading-tight">Halo, {{ auth()->user()->nama }}</span>
                <span class="text-[11px] text-slate-400 leading-tight">{{ ucfirst(str_replace('_', ' ', auth()->user()->role)) }}</span>
              </div>
              <span class="material-symbols-outlined text-slate-400 text-[18px] ml-1">expand_more</span>
            </div>
          </div>
        </div>
      </header>
<div class="relative flex-1 overflow-y-auto px-8 py-6 space-y-6">
         @yield('content')
       </div>
    </main>
    <script>
      const modals = Array.from(document.querySelectorAll('[data-modal]'));
      const mountModal = (modal) => {
        if (modal.parentElement === document.body) return;
        document.body.appendChild(modal);
      };
      modals.forEach((modal) => {
        mountModal(modal);
        modal.addEventListener('click', (event) => {
          if (event.target === modal) modal.classList.replace('flex', 'hidden');
        });
      });
      document.addEventListener('keydown', (event) => {
        if (event.key !== 'Escape') return;
        modals.forEach((modal) => modal.classList.replace('flex', 'hidden'));
      });
      document.addEventListener('submit', (event) => {
        const form = event.target;
        if (form.dataset.confirmed || form.action.endsWith('/logout')) return;
        event.preventDefault();
        if (!form.checkValidity()) {
          form.reportValidity();
          return;
        }
        Swal.fire({
          icon: 'question',
          text: form.querySelector('input[name="_method"][value="PUT"]') ? 'Simpan perubahan?' : 'Simpan data?',
          showCancelButton: true,
          confirmButtonText: 'Ya, simpan',
          cancelButtonText: 'Batal',
        }).then((result) => {
          if (result.isConfirmed) {
            form.dataset.confirmed = '1';
            form.submit();
          }
        });
      });
    </script>
  </body>
</html>
