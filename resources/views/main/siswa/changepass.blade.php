@extends('main.layouts.main')

@section('content')
<section id="content" class="pt-12 w-full h-full">
  <form action="" method="" class="w-full flex flex-col items-center p-2.5 gap-5">
    <span class="text-2xl font-bold">Change Password</span>
    <div class="w-full flex flex-col gap-2">
      <span class="text-sm font-bold">Input Password Baru</span>
      <input type="text" name="nis" class="bg-[#8B8B8B] text-[#ABABAB] placeholder:text-[#ABABAB] outline-none p-2.5 rounded-md" placeholder="00332" disabled/>
      <span class="text-red-600 text-sm">Error Message</span>
    </div>
    <div class="w-full flex flex-col gap-2">
      <span class="text-sm font-bold">Konfirmasi Password Baru</span>
      <input type="text" name="nis" class="bg-[#8B8B8B] text-[#ABABAB] placeholder:text-[#ABABAB] outline-none p-2.5 rounded-md" placeholder="00332" disabled/>
      <span class="text-red-600 text-sm">Error Message</span>
    </div>
    <button type="submit" class="w-full bg-[#26577C] font-bold text-white py-2 rounded-full">Change</button>
  </form>
</section>
@endsection