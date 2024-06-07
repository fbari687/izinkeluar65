<div class="hidden lg:block lg:w-3/12 xl:w-2/12 bg-white relative">
  <div class="fixed top-0 w-3/12 xl:w-2/12 h-screen shadow-sidebar">
    <div class="w-full flex flex-col px-2 py-2 gap-4 lg:mt-12 uppercase">
      <a href="/siswa" class="w-full px-4 py-1 text-sm font-bold rounded-md shadow-lg {{ Request::is('siswa') ? "bg-orange-primary text-white" : "bg-white text-orange-primary border" }}">Home</a>
      <a href="/siswa/profile" class="w-full px-4 py-1 text-sm font-bold rounded-md shadow-lg {{ Request::is('siswa/profile') ? "bg-orange-primary text-white" : "bg-white text-orange-primary border" }}">Profil</a>
      <a href="/siswa/riwayat" class="w-full px-4 py-1 text-sm font-bold rounded-md shadow-lg {{ Request::is('siswa/riwayat') ? "bg-orange-primary text-white" : "bg-white text-orange-primary border" }}">Riwayat</a>
      <a href="/peraturan" class="w-full px-4 py-1 text-sm font-bold rounded-md shadow-lg {{ Request::is('peraturan') ? "bg-orange-primary text-white" : "bg-white text-orange-primary border" }}">Peraturan / Tata Cara</a>
      <a href="/about" class="w-full px-4 py-1 text-sm font-bold rounded-md shadow-lg {{ Request::is('about') ? "bg-orange-primary text-white" : "bg-white text-orange-primary border" }}">About</a>
      <a href="/logout" class="w-full bg-red-600 px-4 py-1 text-white text-sm font-bold shadow-lg rounded-md text-center">Log Out</a>
    </div>
  </div>
</div>