@extends('main.layouts.main')

@section('content')
<section id="content" class="pt-12 w-full h-full">
  <div class="w-full flex flex-col items-center p-2.5 gap-5">
    <span class="text-xl font-black uppercase">Peraturan & Tata Cara</span>
    <div class="w-full flex flex-col items-center gap-4">
      <div class="w-full flex items-center justify-start p-2.5 border-b border-b-black font-bold text-sm">
        <span>Peraturan Umum</span>
      </div>
      <div class="w-full flex flex-col gap-2">
        <div class="bg-[#26577C] px-2.5 py-4 w-full flex flex-col gap-2 rounded-md">
          <span class="text-[#FF5D00] font-bold text-xs">DILARANG KERAS MEMBERIKAN KETERANGAN PALSU</span>
          <span class="text-justify text-white font-bold text-xs">Siswa tidak diperbolehkan memalsukan surat izin. Surat izin yang disampaikan kepada sekolah harus jujur dan sah. Pemalsuan surat izin akan dianggap pelanggaran serius dan akan mengakibatkan konsekuensi, seperti penundaan, tindakan disiplin, atau tindakan hukum sesuai dengan kebijakan sekolah dan peraturan yang berlaku. Semua surat izin harus disampaikan dengan kejujuran dan integritas.</span>
        </div>
        <div class="bg-[#26577C] px-2.5 py-4 w-full flex flex-col gap-2 rounded-md">
          <span class="text-[#FF5D00] font-bold text-xs">DURASI IZIN</span>
          <span class="text-justify text-white font-bold text-xs">Siswa yang diberikan izin harus tiba kembali ke sekolah sesuai dengan jam masuk yang berlaku. Keterlambatan dapat mengakibatkan izin tidak sah dan konsekuensi yang sesuai.</span>
        </div>
        <div class="bg-[#26577C] px-2.5 py-4 w-full flex flex-col gap-2 rounded-md">
          <span class="text-[#FF5D00] font-bold text-xs">ALASAN YANG LOGIS</span>
          <span class="text-justify text-white font-bold text-xs">Hanya alasan-alasan yang diakui oleh kebijakan sekolah yang dapat menjadi dasar perizinan sekolah, seperti sakit, acara keluarga yang penting, atau tugas ekstrakurikuler sekolah.</span>
        </div>
        <div class="bg-[#26577C] px-2.5 py-4 w-full flex flex-col gap-2 rounded-md">
          <span class="text-[#FF5D00] font-bold text-xs">PERSETUJUAN DARI GURU</span>
          <span class="text-justify text-white font-bold text-xs">Setiap surat izin harus disetujui oleh guru yang bersangkutan sebelum dinyatakan sah. Hal ini untuk memastikan bahwa perizinan tidak akan mengganggu proses pembelajaran dan kegiatan sekolah.</span>
        </div>
      </div>
    </div>
    <div class="w-full flex flex-col items-center gap-4">
      <div class="w-full flex items-center justify-start p-2.5 border-b border-b-black font-bold text-sm">
        <span>Tata Cara</span>
      </div>
      <div class="w-full flex flex-col gap-2">
        <div class="bg-[#26577C] px-2.5 py-4 w-full flex flex-col gap-2 rounded-md">
          <span class="text-[#FF5D00] font-bold text-xs">ISI FORM YANG TERSEDIA</span>
          <span class="text-justify text-white font-bold text-xs">Setiap surat izin harus disetujui oleh guru yang bersangkutan dan kepala sekolah sebelum dinyatakan sah. Hal ini untuk memastikan bahwa perizinan tidak akan mengganggu proses pembelajaran dan kegiatan sekolah.</span>
        </div>
        <div class="bg-[#26577C] px-2.5 py-4 w-full flex flex-col gap-2 rounded-md">
          <span class="text-[#FF5D00] font-bold text-xs">MEMINTA IZIN KE GURU UNTUK MENYETUJUI IZIN</span>
          <span class="text-justify text-white font-bold text-xs">Setiap surat izin harus disetujui oleh guru yang bersangkutansebelum dinyatakan sah. Hal ini untuk memastikan bahwa perizinan tidak akan mengganggu proses pembelajaran dan kegiatan sekolah.</span>
        </div>
        <div class="bg-[#26577C] px-2.5 py-4 w-full flex flex-col gap-2 rounded-md">
          <span class="text-[#FF5D00] font-bold text-xs">JIKA IZIN DI SETUJUI MURID BOLEH MELANJUTKAN PERIZINANNYA</span>
          <span class="text-justify text-white font-bold text-xs">Setiap surat izin harus disetujui oleh guru yang bersangkutansebelum dinyatakan sah. Hal ini untuk memastikan bahwa perizinan tidak akan mengganggu proses pembelajaran dan kegiatan sekolah.</span>
        </div>
      </div>
    </div>
  </div>
</section>
@endsection