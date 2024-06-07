@extends('main.layouts.main')

@section('content')
<section id="content" class="pt-12 w-full h-full mx-auto">
  <form action="/admin/siswa" method="POST" class="w-full flex flex-col items-center p-5 gap-2">
    @csrf
    <span class="w-full text-2xl font-bold">Tambah Data Siswa</span>
    <div class="w-full flex flex-col gap-y-1">
      <span class="font-bold text-lg">Nama Murid :</span>
      <input type="text" class="w-full px-2 py-1.5 border-2 text-black rounded-md" name="nama" placeholder="Nama Murid" value="{{ old('nama') }}">
      @error('nama')
      <span class="text-red-500 text-sm px-2 font-semibold">{{ $message }}</span>
      @enderror
    </div>
    <div class="w-full flex flex-col gap-y-1">
      <span class="font-bold text-lg">NIS :</span>
      <input type="text" class="w-full px-2 py-1.5 border-2 text-black rounded-md" name="nis" placeholder="NIS" value="{{ old('nis') }}">
      @error('nis')
      <span class="text-red-500 text-sm px-2 font-semibold">{{ $message }}</span>
      @enderror
    </div>
    <div class="w-full flex flex-col gap-y-1">
      <span class="font-bold text-lg">Kelas :</span>
      <select data-te-select-init data-te-select-filter="true" name="kelas_id">
        @foreach ($BanyakKelas as $kelas)
        <option value="{{ $kelas->id }}" {{ $kelas->id == old('kelas_id') ? 'selected' : '' }}>{{ $kelas->nama_kelas }}</option>
        @endforeach
      </select>
      @error('kelas_id')
      <span class="text-red-500 text-sm px-2 font-semibold">{{ $message }}</span>
      @enderror
    </div>
    <div class="w-full flex flex-col gap-y-1">
      <span class="font-bold text-lg">Username :</span>
      <input type="text" class="w-full px-2 py-1.5 border-2 text-black rounded-md" name="username" placeholder="Username" value="{{ old('username') }}">
      @error('username')
      <span class="text-red-500 text-sm px-2 font-semibold">{{ $message }}</span>
      @enderror
    </div>
    <div class="w-full flex flex-col gap-y-1">
      <span class="font-bold text-lg">Password :</span>
      <div class="w-full flex px-2 py-1.5 border-2 text-black rounded-md">
        <input type="password" name="password" class="bg-transparent outline-none w-full" placeholder="Password">
        <button type="button" id="showPassword"><i class="fa-solid fa-eye"></i></button>
      </div>
      @error('password')
      <span class="text-red-500 text-sm px-2 font-semibold">{{ $message }}</span>
      @enderror
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