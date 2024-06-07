<div class="lg:hidden">
  <button type="button" id="open-sidebar"><i class="fa-solid fa-bars fa-xl text-white"></i></button>
  <div class="absolute lg:fixed lg:left-0 lg:w-[20vw] h-screen w-[55vw] bg-white top-0 -left-[1920px] rounded-r-md border-2 transition-all duration-150">
    <button type="button" class="p-4 lg:hidden" id="close-sidebar"><i class="fa-solid fa-circle-arrow-left fa-2xl"></i></button>
    <div class="w-full flex flex-col px-2 py-2 gap-4 lg:mt-12 uppercase">
      <a href="/siswa" class="w-full px-4 py-1 text-sm font-bold rounded-md shadow-lg {{ Request::is('siswa') ? "bg-orange-primary text-white" : "bg-white text-orange-primary border" }}">Home</a>
      <a href="/siswa/profile" class="w-full px-4 py-1 text-sm font-bold rounded-md shadow-lg {{ Request::is('siswa/profile') ? "bg-orange-primary text-white" : "bg-white text-orange-primary border" }}">Profil</a>
      <a href="/siswa/riwayat" class="w-full px-4 py-1 text-sm font-bold rounded-md shadow-lg {{ Request::is('siswa/riwayat') ? "bg-orange-primary text-white" : "bg-white text-orange-primary border" }}">Riwayat</a>
      <a href="/peraturan" class="w-full px-4 py-1 text-sm font-bold rounded-md shadow-lg {{ Request::is('peraturan') ? "bg-orange-primary text-white" : "bg-white text-orange-primary border" }}">Peraturan / Tata Cara</a>
      <a href="/about" class="w-full px-4 py-1 text-sm font-bold rounded-md shadow-lg {{ Request::is('about') ? "bg-orange-primary text-white" : "bg-white text-orange-primary border" }}">About</a>
      <a href="/logout" class="w-full bg-red-600 px-4 py-1 shadow-lg text-white text-sm font-bold rounded-md text-center">Log Out</a>
    </div>
  </div>
</div>