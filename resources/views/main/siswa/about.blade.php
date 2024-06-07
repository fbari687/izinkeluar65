@extends('main.layouts.main')

@section('content')
<section id="content" class="pt-12 w-full h-full">
  <div class="w-full flex flex-col items-center p-2.5 gap-5">
    <span class="text-xl font-black uppercase">Peraturan & Tata Cara</span>
    <div class="w-full flex flex-col items-center gap-4">
      <div class="w-full flex items-center justify-start p-2.5 border-b border-b-black font-bold text-sm">
        <span>About Us</span>
      </div>
      <div class="w-full flex flex-col gap-2">
        <div class="bg-white px-2.5 py-4 w-full flex flex-col gap-2 rounded-md">
          <span class="text-[#FF5D00] font-black text-xs">FORM PERIZINAN SMKN 65 JAKARTA</span>
          <span class="text-justify text-black font-bold text-xs">DEVELOPER : BARI, FIKRI, FIAN</span>
        </div>
      </div>
    </div>
    <div class="w-full flex flex-col items-center gap-4">
      <div class="w-full flex items-center justify-start p-2.5 border-b border-b-black font-bold text-sm">
        <span>Contact</span>
      </div>
      <div class="w-full flex flex-col gap-2">
        <a href="" class="bg-[#26577C] px-2.5 py-4 w-full flex items-center justify-between gap-2 rounded-md">
          <span class="text-[#FF5D00] font-bold text-xs">UI UX</span>
          <span class="text-justify text-white font-bold text-xs">Fikri Aidhil</span>
        </a>
        <a href="" class="bg-[#26577C] px-2.5 py-4 w-full flex items-center justify-between gap-2 rounded-md">
          <span class="text-[#FF5D00] font-bold text-xs">Front End</span>
          <span class="text-justify text-white font-bold text-xs">Fathul Bari</span>
        </a>
        <a href="" class="bg-[#26577C] px-2.5 py-4 w-full flex items-center justify-between gap-2 rounded-md">
          <span class="text-[#FF5D00] font-bold text-xs">Back End</span>
          <span class="text-justify text-white font-bold text-xs">Fian Kurniawan</span>
        </a>
        
      </div>
    </div>
  </div>
</section>
@endsection