@extends('main.layouts.main')

@section('content')
<section id="content" class="pt-12 w-full h-full mx-auto">
  <form action="/admin/guru" method="POST" class="w-full flex flex-col items-center p-5 gap-2">
    @csrf
    <span class="w-full text-2xl font-bold">Tambah Data Guru</span>
    <div class="w-full flex flex-col gap-y-1">
      <span class="font-bold text-lg">Nama Guru :</span>
      <input type="text" class="w-full px-2 py-1.5 bg-[#ddd] text-black rounded-md" name="nama" placeholder="Nama Guru" value="{{ old('nama') }}">
      @error('nama')
      <span class="text-red-500 text-sm px-2 font-semibold">{{ $message }}</span>
      @enderror
    </div>
    <div class="w-full flex flex-col gap-y-1">
      <span class="font-bold text-lg">Username :</span>
      <input type="text" class="w-full px-2 py-1.5 bg-[#ddd] text-black rounded-md" name="username" placeholder="Username" value="{{ old('username') }}">
      @error('username')
      <span class="text-red-500 text-sm px-2 font-semibold">{{ $message }}</span>
      @enderror
    </div>
    <div class="w-full flex flex-col gap-y-1">
      <span class="font-bold text-lg">Password :</span>
      <div class="w-full flex bg-[#ddd] px-2 py-1.5 rounded-md">
        <input type="password" class="bg-transparent outline-none w-full" placeholder="Password" name="password">
        <button type="button" id="showPassword"><i class="fa-solid fa-eye"></i></button>
      </div>
    </div>
    <div class="w-full flex flex-col gap-y-1">
      <span class="font-bold text-lg">Tugas Guru :</span>
      <div class="w-full flex flex-col px-2 py-1.5">
        <div class="w-full flex gap-2">
          <input type="checkbox" name="wali_kelas" id="wali_kelas" class="accent-black" value="1">
          <label for="wali_kelas" class="cursor-pointer prevent-select">Wali Kelas</label>
        </div>
        <div class="w-full flex gap-2">
          <input type="checkbox" name="piket" id="piket" class="accent-black" value="1">
          <label for="piket" class="cursor-pointer prevent-select">Guru Piket</label>
        </div>
        <div class="w-full flex gap-2">
          <input type="checkbox" name="mapel" id="mapel" class="accent-black" value="1">
          <label for="mapel" class="cursor-pointer prevent-select">Guru Mapel</label>
        </div>
        <div class="w-full flex gap-2">
          <input type="checkbox" name="kaprodi" id="kaprodi" class="accent-black" value="1">
          <label for="kaprodi" class="cursor-pointer prevent-select">Kaprodi</label>
        </div>
      </div>
    </div>
    <button type="submit" class="bg-[#26577C] text-white w-full py-1 font-bold text-lg flex items-center justify-center gap-2 rounded-md shadow-lg">
      <span>Tambah</span>
      <i class="fa-solid fa-plus"></i>
    </button>
  </form>
</section>
@endsection

@section('script')

<script>
  const showPasswordBtn = document.getElementById('showPassword');

  showPasswordBtn.addEventListener('click', function() {
    if(this.previousElementSibling.type == "password") {
      this.previousElementSibling.type = "text";
      this.firstElementChild.classList.replace('fa-eye', 'fa-eye-slash');
    }
    else {
      this.previousElementSibling.type = "password";
      this.firstElementChild.classList.replace('fa-eye-slash', 'fa-eye');
    }
  })
</script>

@endsection