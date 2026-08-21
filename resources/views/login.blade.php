<!doctype html>
<html lang="en" style="">

<head>
  <meta charset="utf-8" />
  <meta content="width=device-width, initial-scale=1.0" name="viewport" />
  <title>HCBP Area 3 Apps - Login</title>
  <link href="https://fonts.googleapis.com" rel="preconnect" />
  <link crossorigin="" href="https://fonts.gstatic.com" rel="preconnect" />
  <link
    href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap"
    rel="stylesheet" />
  <link
    href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap"
    rel="stylesheet" />
  <link
    href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap"
    rel="stylesheet" />
  <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
  <script id="tailwind-config">
    tailwind.config = {
      darkMode: "class",
      theme: {
        extend: {
          colors: {
            "tertiary-fixed": "#acedff",
            "on-surface": "#1b1b1d",
            "inverse-surface": "#303032",
            "outline-variant": "#c5c6cd",
            surface: "#fbf9fb",
            "surface-container-low": "#f5f3f5",
            "on-tertiary-container": "#0090a9",
            error: "#ba1a1a",
            "surface-container-lowest": "#ffffff",
            "inverse-on-surface": "#f2f0f2",
            "error-container": "#ffdad6",
            "on-primary-fixed-variant": "#39475f",
            "on-primary": "#ffffff",
            "on-primary-container": "#76849f",
            "surface-container": "#efedef",
            "primary-fixed-dim": "#b9c7e4",
            background: "#fbf9fb",
            "surface-variant": "#e4e2e4",
            "on-secondary-fixed-variant": "#005321",
            "on-secondary-fixed": "#002109",
            "on-error-container": "#93000a",
            "secondary-fixed": "#6bff8f",
            "on-secondary-container": "#007432",
            "tertiary-fixed-dim": "#4cd7f6",
            "secondary-fixed-dim": "#4ae176",
            "on-tertiary-fixed": "#001f26",
            "surface-tint": "#515f78",
            secondary: "#006e2f",
            "primary-container": "#0d1c32",
            "surface-dim": "#dbd9db",
            "secondary-container": "#6bff8f",
            "on-error": "#ffffff",
            tertiary: "#000000",
            "surface-bright": "#fbf9fb",
            "on-tertiary": "#ffffff",
            "on-secondary": "#ffffff",
            "inverse-primary": "#b9c7e4",
            "primary-fixed": "#d6e3ff",
            "surface-container-highest": "#e4e2e4",
            "on-tertiary-fixed-variant": "#004e5c",
            outline: "#75777e",
            primary: "#000000",
            "surface-container-high": "#eae7ea",
            "on-primary-fixed": "#0d1c32",
            "on-background": "#1b1b1d",
            "tertiary-container": "#001f26",
            "on-surface-variant": "#44474d",
          },
          borderRadius: {
            DEFAULT: "0.25rem",
            lg: "0.5rem",
            xl: "0.75rem",
            full: "9999px",
          },
          spacing: {
            gutter: "24px",
            xxl: "48px",
            xl: "32px",
            "margin-desktop": "40px",
            "margin-mobile": "16px",
            xs: "4px",
            md: "16px",
            lg: "24px",
            sm: "8px",
            base: "4px",
          },
          fontFamily: {
            "label-md": ["Plus Jakarta Sans"],
            "label-sm": ["Plus Jakarta Sans"],
            "headline-md": ["Plus Jakarta Sans"],
            "headline-lg": ["Plus Jakarta Sans"],
            "display-lg": ["Plus Jakarta Sans"],
            "body-lg": ["Plus Jakarta Sans"],
            "body-md": ["Plus Jakarta Sans"],
            "headline-lg-mobile": ["Plus Jakarta Sans"],
          },
          fontSize: {
            "label-md": ["14px", {
              lineHeight: "20px",
              letterSpacing: "0.01em",
              fontWeight: "600"
            }],
            "label-sm": ["12px", {
              lineHeight: "16px",
              fontWeight: "500"
            }],
            "headline-md": ["24px", {
              lineHeight: "32px",
              fontWeight: "600"
            }],
            "headline-lg": ["32px", {
              lineHeight: "40px",
              letterSpacing: "-0.01em",
              fontWeight: "700"
            }],
            "display-lg": ["48px", {
              lineHeight: "60px",
              letterSpacing: "-0.02em",
              fontWeight: "700"
            }],
            "body-lg": ["18px", {
              lineHeight: "28px",
              fontWeight: "400"
            }],
            "body-md": ["16px", {
              lineHeight: "24px",
              fontWeight: "400"
            }],
            "headline-lg-mobile": ["24px", {
              lineHeight: "32px",
              fontWeight: "700"
            }],
          },
        },
      },
    };
  </script>
  <style>
    .material-symbols-outlined {
      font-variation-settings: "FILL" 0, "wght" 400, "GRAD" 0, "opsz" 24;
    }
  </style>
</head>

<body class="bg-surface-container-low min-h-screen flex flex-col relative overflow-x-hidden">
  <header class="w-full flex justify-between items-center px-margin-mobile md:px-margin-desktop py-lg z-20 relative">
    <div class="flex items-center gap-md">
      <img class="h-24 md:h-27 w-auto object-contain" src="https://lh3.googleusercontent.com/aida-public/AB6AXuChlbJGsd6iy22SElkS62y9C2mEYlz6VOAhDSWY2d6Fpj43kQhzBiYbBuJW801slNt1aF27pvhWPDsS8LhuzzJqsZhQCIBTmZMuBIlX41uEwcDIXEchkG1N7D1p2YJ4kCKjm5DtKlBLzXaMizBm846DqunvMIDgT1jVIXiPXRuH0gpgKEV-agSx80yN7jCkqPBONzmuoMFiMiTn477RMyOSaWLwb-pODEgQfkotzK4cE9u-YJyvTu8McuUekDs0OkyZUEA" alt="Danantara Indonesia" />
      <div class="w-[1px] h-12 md:h-14 bg-outline-variant"></div>
      <img class="h-12 md:h-14 w-auto object-contain" src="https://lh3.googleusercontent.com/aida-public/AB6AXuDzYvvk2etW1R5GwI1vnWgbOfDpWB8it5GS2m4X8TR2ndGdRlSID7gdx8ULcDEbEdIa9lZJNRJpjF4J3v90w90dhgjYHP53s856_khFomKFjjAsDXOMb1EWe7Vhaf8GK7-Q1ASjLYdYj3plDfYuBA5BlBOzafJ2rMHpI-9JJrKVneyMGiT1QyAVU9xAuJqiXsvU2NM9HiN3x8YsqUdjPgyLWNqSxRa31tjSa4mxGCQmw_7VzVXlJdRocBcYkcH0C4fm-Hs" alt="PLN" />
    </div>
    <div class="font-headline-md text-headline-md text-primary font-bold hidden md:block">HCBP Area 3 Apps</div>
  </header>
  <main class="flex-grow flex items-center justify-center px-margin-mobile md:px-margin-desktop z-20 relative pb-32 md:pb-48">
    <div class="max-w-7xl w-full grid grid-cols-1 md:grid-cols-2 gap-xxl items-center">
      <div class="flex flex-col gap-lg pr-0 md:pr-xl">
        <h1 class="font-display-lg text-display-lg text-primary md:leading-tight">Wujudkan pengalaman kerja yang lebih baik</h1>
        <div class="h-1 w-32 bg-gradient-to-r from-tertiary-fixed-dim to-secondary-fixed rounded-full"></div>
        <p class="font-body-lg text-body-lg text-on-surface-variant max-w-lg">Platform digital terintegrasi untuk mendukung transformasi dan kinerja unggul insan PLN.</p>
      </div>
      <div class="flex justify-center md:justify-center w-full">
        <div class="bg-surface-container-lowest w-full max-w-[420px] rounded-xl border border-surface-variant p-xl shadow-[0px_8px_30px_rgba(10,25,47,0.08)] transition-all duration-700 ease-out transform translate-y-4 opacity-0 hover:scale-[1.01] hover:shadow-xl">
          <h2 class="font-headline-lg text-headline-lg text-primary mb-xl">Login</h2>
          <form class="flex flex-col gap-lg" method="POST" action="{{ route('login.post') }}">
            @csrf
            @if($errors->any())
              <div class="bg-error-container text-on-error-container p-md rounded-lg font-body-md">
                {{ $errors->first() }}
              </div>
            @endif
            <div class="flex flex-col gap-sm">
              <label class="font-label-md text-label-md text-on-surface">Username</label>
              <div class="relative flex items-center">
                <span class="material-symbols-outlined absolute left-md text-outline" data-icon="person">person</span>
                <input name="username" class="w-full pl-12 pr-md py-3 rounded-lg border border-outline-variant bg-surface-container-lowest text-on-surface font-body-md text-body-md focus:outline-none focus:border-tertiary-fixed-dim focus:ring-1 focus:ring-tertiary-fixed-dim transition-shadow @error('username') border-error @enderror" placeholder="Masukkan username" type="text" value="{{ old('username') }}" required />
              </div>
              @error('username')
                <span class="text-error font-label-sm text-label-sm">{{ $message }}</span>
              @enderror
            </div>
            <div class="flex flex-col gap-sm">
              <label class="font-label-md text-label-md text-on-surface">Password</label>
              <div class="relative flex items-center">
                <span class="material-symbols-outlined absolute left-md text-outline" data-icon="lock">lock</span>
                <input name="password" class="w-full pl-12 pr-12 py-3 rounded-lg border border-outline-variant bg-surface-container-lowest text-on-surface font-body-md text-body-md focus:outline-none focus:border-tertiary-fixed-dim focus:ring-1 focus:ring-tertiary-fixed-dim transition-shadow" placeholder="Masukkan password" type="password" required />
                <button class="absolute right-md text-outline hover:text-primary transition-colors flex items-center justify-center hover:scale-[1.02] hover:brightness-110" type="button" onclick="togglePassword(this)">
                  <span class="material-symbols-outlined" data-icon="visibility">visibility</span>
                </button>
              </div>
            </div>
            <div class="flex justify-end">
              <a class="font-label-sm text-label-sm text-tertiary-fixed-dim hover:text-tertiary-fixed hover:underline transition-colors hover:text-primary" href="#">Lupa Password?</a>
            </div>
            <button class="w-full mt-sm py-3 rounded-lg font-label-md text-label-md text-on-primary shadow-sm hover:opacity-90 active:scale-[0.98] transition-all flex items-center justify-center gap-sm hover:scale-[1.02] hover:brightness-110" style="background-color: rgb(34, 197, 94)" type="submit">Login</button>
          </form>
        </div>
      </div>
    </div>
  </main>
  <div class="absolute bottom-0 left-0 w-full z-10 pointer-events-none">
    <img class="w-full h-auto min-h-[150px] object-cover object-bottom" src="https://lh3.googleusercontent.com/aida-public/AB6AXuAc_-Z1e9d4l74Z74pPhGHSZQnVKUsgcWk3ypls-W1qZhhZM1M9O7PmTkrvxMeoYkWRL6PXbaAOn2h9bmMv_uHNFrPQNJJBqSKMycuoP7wCt-mE06BFKiwfYmCP0zKgy1GYKpv9eUG2R_0Wg1l2rzUc1mCSpf2wP5KZ2zpMFH80ONjxoMjXW8_6veSk-4bw6nRBaDrGf9cZhxhCLzYRKVcFyCozJaUG8U91YXRZ9WOfFToMf949mQ2Ok6OkSDAEseeRlmU" />
    <div class="absolute bottom-md md:bottom-lg left-0 w-full text-center px-margin-mobile">
      <p class="font-label-sm text-label-sm text-white/90 uppercase tracking-widest drop-shadow-md">transformasi hc 2.0 | unleashing energy and beyond</p>
    </div>
  </div>
   <script>
    document.addEventListener("DOMContentLoaded", () => {
      const card = document.querySelector("main .grid > div:nth-child(2) > div");
      if (card) {
        setTimeout(() => {
          card.classList.remove("translate-y-4", "opacity-0");
          card.classList.add("translate-y-0", "opacity-100");
        }, 100);
      }
    });

    function togglePassword(button) {
      const passwordInput = button.parentElement.querySelector('input');
      const icon = button.querySelector('.material-symbols-outlined');
      
      if (passwordInput.type === 'password') {
        passwordInput.type = 'text';
        icon.textContent = 'visibility_off';
      } else {
        passwordInput.type = 'password';
        icon.textContent = 'visibility';
      }
    }
  </script>
</body>

</html>