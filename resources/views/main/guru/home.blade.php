@extends('main.layouts.main')

@section('content')
@if (session()->has('success'))  
<div class="w-[50vw] absolute right-0 top-24 bg-green-600 flex items-center lg:w-[20vw] xl:w-[15vw] py-4 px-3 text-white text-sm gap-2" id="successNotif">
  <div class=""><i class="fa-solid fa-circle-check fa-2xl"></i></div>
  <span>{{ session('success') }}</span>
  <button type="button" class="font-bold" id="closeNotifBtn">&#10005;</button>
</div>
@endif
  <section id="content" class="pt-12 w-full h-full">
    <div class="w-full flex flex-col items-center p-2.5 gap-5">
      <img src="{{ asset('img/LOGOSMKN65YANGKETENGAH.png') }}" alt="" class="w-1/2 lg:w-1/4 xl:w-1/6">
      <div class="flex flex-col w-full items-center gap-1 text-base font-black">
        <span class="text-[#E55604]">HELLO</span>
        <span class="text-2xl">{{ auth()->user()->nama }}</span>
      </div>
      <form action="" class="w-full bg-[#B0B0B0] flex justify-between items-center py-1 px-6 text-white gap-2 rounded-full overflow-hidden">
        @csrf
        <input type="text" placeholder="Search.." class="outline-none h-full w-full bg-transparent text-white text-base p-1.5 font-bold placeholder:text-gray-100">
        <button type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
      </form>
      @foreach ($PerizinanSiswas as $perizinan)
      <a href="/guru/izin/{{ $perizinan->siswa_id }}" class="bg-[#4A4A4A] p-2.5 w-full flex flex-col gap-2 rounded-md transition duration-150 hover:bg-[#292929]">
        <div class="w-full flex justify-between items-center">
          <span class="text-[#EBFF00] font-bold uppercase">Meminta Izin Keluar</span>
          <span class="text-white font-bold text-xs flex flex-col gap-1">
            <span>Click To See Detail</span>
          </span>
        </div>
        <span class="text-[#63FF2D] font-bold text-sm">{{ $perizinan->siswa->nama }}</span>
        <span class="text-white font-bold text-sm uppercase">Kelas: <span class="text-[#EBFF00]">{{ $perizinan->siswa->detailSiswa->kelas->nama_kelas }}</span></span>
        <span class="text-white font-bold text-sm uppercase">Alasan: </span>
        <span class="text-[#EBFF00] text-sm">{{ $perizinan->alasan }}</span>
      </a>
      @endforeach
    </div>
  </section>
@endsection

@section('script')

<script>
  const closeNotifBtn = document.getElementById('closeNotifBtn');
  if (typeof(closeNotifBtn) != 'undefined' && closeNotifBtn != null)
  {
    closeNotifBtn.addEventListener('click', function() {
      this.parentElement.remove();
    });
  }
</script>

@endsection