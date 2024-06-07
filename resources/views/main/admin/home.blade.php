@extends('main.layouts.main')

@section('content')
  <section id="content" class="pt-12 w-full h-full">
    <div class="w-full flex flex-col items-center p-2.5 gap-5">
      <img src="{{ asset('img/LOGOSMKN65YANGKETENGAH.png') }}" alt="" class="w-1/2 lg:w-1/4 xl:w-1/6">
      <div class="flex flex-col w-full items-center gap-1 text-base lg:text-2xl font-black">
        <span class="text-[#E55604]">HELLO</span>
        <span class="">{{ auth()->user()->nama }}</span>
      </div>
      <div class="w-full grid grid-cols-1 lg:grid-cols-3 gap-4">
        <div class="bg-[#26577C] flex flex-col items-start justify-center text-white text-lg font-bold uppercase p-6 rounded-md">
          <span>Total Guru</span>
          <span>10</span>
        </div>
        <div class="bg-[#26577C] flex flex-col items-start justify-center text-white text-lg font-bold uppercase p-6 rounded-md">
          <span>Total Siswa</span>
          <span>10</span>
        </div>
        <div class="bg-[#26577C] flex flex-col items-start justify-center text-white text-lg font-bold uppercase p-6 rounded-md">
          <span>Total Perizinan</span>
          <span>10</span>
        </div>
      </div>
      <div class="w-full bg-[#4A4A4A] flex items-center justify-start px-6 py-1 text-white uppercase font-bold text-lg rounded-md">
        <span>Izin Terbaru</span>
      </div>
    </div>
  </section>
@endsection