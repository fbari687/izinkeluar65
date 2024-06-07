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
        <span class="text-2xl">{{ $siswa->kelas->nama_kelas }}</span>
      </div>
      <a href="/siswa/form" class="w-full bg-[#26577C] text-center p-2.5 text-white font-bold rounded-md">+ Form Perizinan</a>
      @if (!$perizinans || $perizinans->isEmpty())
        <span class="text-black font-bold text-lg">Belum Melakukan Perizinan</span>
      @endif
      @foreach ($perizinans as $perizinan)
      <a href="/siswa/{{ $perizinan->id }}/detail" class="bg-[#4A4A4A] p-2.5 w-full flex flex-col gap-2 rounded-md transition duration-150 hover:bg-[#292929]">
        <div class="w-full flex justify-between items-center">
          <span class="text-[#FAFF01] font-bold uppercase">MEMINTA PERIZINAN</span>
          <span class="text-white font-bold">NO.{{ $perizinan->id }}</span>
        </div>
        <span class="text-white font-bold text-sm">ALASAN</span>
        <span class="text-justify font-bold text-xs text-[#8B8B8B]">{{ $perizinan->alasan }}</span>
        <span class="self-center text-white font-bold text-sm">JAM PELAJARAN</span>
        @php
          $filteredKeterangans = $perizinanGurus->where('perizinan_siswa_id', $perizinan->id)
              ->where('keterangan_perizinan_id', '<=', 10)
              ->sortBy('keterangan_perizinan_id');
      @endphp

      @if ($filteredKeterangans->count() > 0)
          <span class="self-center text-white font-bold text-sm">{{ $filteredKeterangans->first()->keterangan_perizinan_id }} - {{ $filteredKeterangans->last()->keterangan_perizinan_id }}</span>
      @endif

        <span class=" text-white font-bold text-sm">STATUS: <span class="{{ $perizinan->status_perizinan_id == 3 ? 'text-green-500' : 'text-[#FAFF01]' }} uppercase">{{ $perizinan->statusPerizinan->nama }}</span></span>
      </a>
      @endforeach
      {{-- <div class="w-full bg-black p-2.5 rounded-md">
        <a href="/siswa/riwayat" class="w-full flex items-center justify-between">
          <div class="flex flex-col text-white font-bold">
            <span>Riwayat Izin</span>
            <span>10</span>
          </div>
          <div class="flex flex-col text-white text-xs font-bold">
            <span>*Click to see detail</span>
          </div>
        </a>
      </div> --}}
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