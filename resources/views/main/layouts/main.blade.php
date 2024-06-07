<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Aplikasi Izin Keluar Sekolah</title>
    @vite('resources/css/app.css')
    @vite('resources/js/app.js')
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
</head>
<body class="font-inter">
    <header class="w-screen h-12 bg-[#26577C] px-5 flex items-center justify-between fixed z-30 shadow-lg top-0">
        @if (Request::is('login') || Request::is('siswa/form'))
        <span class="text-white font-semibold text-xl">Aplikasi Izin Keluar Sekolah</span>
        @else
        @if (auth()->check())
        @if (auth()->user()->role_id == 1)
          @include('main.partials.sidebarAdminMobile')
        @elseif (auth()->user()->role_id == 2)
          @include('main.partials.sidebarGuruMobile')
        @elseif (auth()->user()->role_id == 3)
          @include('main.partials.sidebarSiswaMobile')
        @endif
        @endif
      <a href="/" class="h-full hidden gap-1 items-center lg:flex">
        <img src="{{ asset('img/LOGOSMKN65YANGKETENGAH.png') }}" alt="" class="h-5/6">
        <span class="text-white font-bold tracking-wide">SMKN 65</span>
      </a>
      @if (auth()->check())
      @php
        $linkProfile = '';
        
        if (auth()->user()->role_id == 1) {
          $linkProfile = '/admin/profile';
        } 
        else if (auth()->user()->role_id == 2) {
          $linkProfile = '/guru/profile';
        }
        else if (auth()->user()->role_id == 3) {
          $linkProfile = '/siswa/profile';
        }
      @endphp
      <a href="{{ $linkProfile }}" class="bg-orange-primary flex items-center p-1 gap-2">
          <div style="background-image: url({{ asset('/storage/'.auth()->user()->profile_picture) }})" class="p-3.5 rounded-full bg-cover bg-center"></div>
          <span class="font-bold text-white text-sm">{{ auth()->user()->nama }}</span>
      </a>
      @endif
        @endif
    </header>

    

      <section id="container" class="flex gap-1 w-full">
        {{-- <div class="absolute lg:fixed lg:left-0 lg:w-[20vw] h-screen w-[55vw] bg-white top-0 -left-[1920px] rounded-r-md border-2 transition-all duration-150"> --}}
          @if (auth()->check())
          @if (auth()->user()->role_id == 1)
            @include('main.partials.sidebarAdmin')
          @elseif (auth()->user()->role_id == 2)
            @include('main.partials.sidebarGuru')
          @elseif (auth()->user()->role_id == 3)
            @include('main.partials.sidebarSiswa')
          @endif
          @endif
          <div class="w-full lg:w-9/12 xl:w-10/12">
            @yield('content')
          </div>
      </section>

    
    <script src="https://kit.fontawesome.com/e1744d5724.js" crossorigin="anonymous"></script>
    <script>
      let closeSidebar = document.getElementById("close-sidebar");
      let openSidebar = document.getElementById("open-sidebar");

      if (typeof(closeSidebar) != 'undefined' && closeSidebar != null) {
        closeSidebar.addEventListener("click", function() {
          this.parentElement.classList.remove("left-0");
          this.parentElement.classList.add("-left-[1920px]");
        })
      }

      if (typeof(openSidebar) != 'undefined' && openSidebar != null) {
        openSidebar.addEventListener("click", function() {
          this.nextElementSibling.classList.remove("-left-[1920px]");
          this.nextElementSibling.classList.add("left-0");
        })
      }
    </script>
    @yield('script')
</body>
</html>