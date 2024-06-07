@extends('main.layouts.main')

@section('content')
<section id="content" class="pt-12 w-full h-full">
  <div class="w-full flex flex-col items-center p-2.5 gap-5">
    <span class="text-2xl font-bold uppercase">Riwayat Izin</span>
    <div class="w-full flex items-center justify-between p-2.5 border-b border-b-black font-bold text-sm">
      <span>Urutkan</span>
      <span>Total Izin : {{ count($banyakPerizinanSiswa) }}</span>
    </div>
    <div class="w-full flex flex-col gap-2">
      @foreach ($banyakPerizinanSiswa as $perizinanSiswa)
      <a href="/guru/riwayat/{{ $perizinanSiswa->id }}" class="bg-[#4A4A4A] p-2.5 w-full flex flex-col gap-2 rounded-md transition duration-150 hover:bg-[#292929]">
        <div class="w-full flex justify-start items-center text-white font-bold text-xs">
          <span class="uppercase">Tanggal : {{ $perizinanSiswa->tanggal }}</span>
        </div>
        <div class="w-full flex justify-start items-center text-white font-bold text-xs">
          <span class="uppercase">Nama : {{ $perizinanSiswa->siswa->nama }}</span>
        </div>
        <div class="w-full flex justify-start items-center text-white font-bold text-xs">
          <span class="uppercase">Kelas : {{ $perizinanSiswa->siswa->detailSiswa->kelas->nama_kelas }}</span>
        </div>
        <span class="text-white font-bold text-xs">ALASAN</span>
        <span class="text-justify font-bold text-xs text-[#8B8B8B]">{{ $perizinanSiswa->alasan }}</span>
        <span class="self-center text-white font-bold text-sm">JAM PELAJARAN</span>
        <span class="self-center text-white font-bold text-sm">@php
          $filteredKeterangans = $perizinanSiswa->perizinanGuru->where('perizinan_siswa_id', $perizinanSiswa->id)
            ->where('keterangan_perizinan_id', '<=', 10)
            ->sortBy('keterangan_perizinan_id');
        @endphp
        {{ $filteredKeterangans->first()->keterangan_perizinan_id }} - {{ $filteredKeterangans->last()->keterangan_perizinan_id }}</span>
        <span class=" text-white font-bold text-sm">STATUS: <span class="{{ $perizinanSiswa->status_perizinan_id == 3 ? 'text-green-500' : 'text-[#FAFF01]' }} uppercase">Sudah Anda Izinkan</span></span>
        </a>
      @endforeach
    </div>
  </div>
</section>
@endsection