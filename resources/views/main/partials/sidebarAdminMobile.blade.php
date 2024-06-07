<div class="lg:hidden">
  <button type="button" id="open-sidebar"><i class="fa-solid fa-bars fa-xl text-white"></i></button>
  <div class="absolute lg:fixed lg:left-0 lg:w-[20vw] h-screen w-[55vw] bg-white top-0 -left-[1920px] rounded-r-md border-2 transition-all duration-150">
    <button type="button" class="p-4 lg:hidden" id="close-sidebar"><i class="fa-solid fa-circle-arrow-left fa-2xl"></i></button>
    <div class="w-full flex flex-col px-2 py-2 gap-4 lg:mt-12 uppercase">
      <a href="/admin" class="w-full px-4 py-1 text-sm font-bold rounded-md shadow-lg {{ Request::is('admin') ? "bg-orange-primary text-white" : "bg-white text-orange-primary border" }}">Home</a>
      <a href="/admin/profile" class="w-full px-4 py-1 text-sm font-bold rounded-md shadow-lg {{ Request::is('admin/profile') ? "bg-orange-primary text-white" : "bg-white text-orange-primary border" }}">Profil</a>
      <a href="/admin/siswa" class="w-full px-4 py-1 text-sm font-bold rounded-md shadow-lg {{ Request::is('admin/siswa*') ? "bg-orange-primary text-white" : "bg-white text-orange-primary border" }}">Data Siswa</a>
      <a href="/admin/guru" class="w-full px-4 py-1 text-sm font-bold rounded-md shadow-lg {{ Request::is('admin/guru*') ? "bg-orange-primary text-white" : "bg-white text-orange-primary border" }}">Data Guru</a>
      <a href="/admin/mapel" class="w-full px-4 py-1 text-sm font-bold rounded-md shadow-lg {{ Request::is('admin/mapel*') ? "bg-orange-primary text-white" : "bg-white text-orange-primary border" }}">Data Mapel</a>
      <a href="/admin/jadwal" class="w-full px-4 py-1 text-sm font-bold rounded-md shadow-lg {{ Request::is('admin/jadwal*') ? "bg-orange-primary text-white" : "bg-white text-orange-primary border" }}">Data Jadwal</a>
      <a href="/admin/kelas" class="w-full px-4 py-1 text-sm font-bold rounded-md shadow-lg {{ Request::is('admin/kelas*') ? "bg-orange-primary text-white" : "bg-white text-orange-primary border" }}">Data Kelas</a>
      <a href="/admin/jurusan" class="w-full px-4 py-1 text-sm font-bold rounded-md shadow-lg {{ Request::is('admin/jurusan*') ? "bg-orange-primary text-white" : "bg-white text-orange-primary border" }}">Data Jurusan</a>
      <a href="/admin/reports" class="w-full px-4 py-1 text-sm font-bold rounded-md shadow-lg {{ Request::is('admin/reports*') ? "bg-orange-primary text-white" : "bg-white text-orange-primary border" }}">Laporan Perizinan</a>
      <a href="/logout" class="w-full bg-red-600 px-4 py-1 text-white text-sm font-bold shadow-lg rounded-md text-center">Log Out</a>
    </div>
  </div>
</div>