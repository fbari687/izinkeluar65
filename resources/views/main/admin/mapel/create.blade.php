@extends('main.layouts.main')

@section('content')
<section id="content" class="pt-12 w-full h-full mx-auto">
  <form action="/admin/mapel" method="post" class="w-full flex flex-col items-center p-5 gap-2">
    @csrf
    <span class="w-full text-2xl font-bold">Tambah Data Mapel</span>
    <div class="w-full flex flex-col gap-y-1">
      <span class="font-bold text-lg">Nama Mata Pelajaran :</span>
      <input type="text" class="w-full px-2 py-1.5 border-2 text-black rounded-md" name="nama_mapel" placeholder="Nama Mata Pelajaran" value="{{ old('nama_mapel') }}">
      @error('nama_mapel')
        <span class="text-red-500 text-sm px-2 font-semibold">{{ $message }}</span>
      @enderror
    </div>
    <div class="w-full flex flex-col gap-y-1">
      <span class="font-bold text-lg">Guru Pengajar :</span>
      <select data-te-select-init multiple data-te-select-filter="true" class="bg-[#ddd]" name="pengajars[]">
        @foreach ($BanyakGuru as $guru)
        <option value="{{ $guru->user_id }}" {{ in_array($guru->user_id, old('pengajars', [])) ? 'selected' : '' }}>{{ $guru->user->nama }}</option>
        @endforeach
      </select>
      <label data-te-select-label-ref>Pengajar</label>
      @error('pengajars')
      <span class="text-red-500 text-sm px-2 font-semibold">{{ $message }}</span>
      @enderror
    </div>
    <div class="w-full flex flex-col gap-y-1">
      <span class="font-bold text-lg">Jurusan :</span>
      <select data-te-select-init multiple data-te-select-filter="true" name="jurusans[]">
        @foreach ($BanyakJurusan as $jurusan)
        <option value="{{ $jurusan->id }}" {{ in_array($jurusan->id, old('jurusans', [])) ? 'selected' : '' }}>{{ $jurusan->nama_jurusan }}</option>
        @endforeach
      </select>
      <label data-te-select-label-ref>Jurusan</label>
      @error('jurusans')
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

@endsection