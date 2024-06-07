@extends('main.layouts.main')

@section('content')
<section id="content" class="pt-12 w-full h-full mx-auto">
  <form action="/admin/kelas" method="POST" class="w-full flex flex-col items-center p-5 gap-2">
    @csrf
    <span class="w-full text-2xl font-bold">Tambah Data Kelas</span>
    <div class="w-full flex flex-col gap-y-1">
      <span class="font-bold text-lg">Nama Kelas :</span>
      <input type="text" class="w-full px-2 py-1.5 border-2 text-black rounded-md" name="nama_kelas" placeholder="Nama Kelas" value="{{ old('nama_kelas') }}">
      @error('nama_kelas')
      <span class="text-red-500 text-sm px-2 font-semibold">{{ $message }}</span>
      @enderror
    </div>
    <div class="w-full flex flex-col gap-y-1">
      <span class="font-bold text-lg">Jurusan :</span>
      <select data-te-select-init name="jurusan_id">
        @foreach ($BanyakJurusan as $jurusan)
        <option value="{{ $jurusan->id }}" {{ $jurusan->id == old('jurusan_id') ? 'selected' : '' }}>{{ $jurusan->nama_jurusan }}</option>
        @endforeach
      </select>
      @error('jurusan_id')
      <span class="text-red-500 text-sm px-2 font-semibold">{{ $message }}</span>
      @enderror
    </div>
    <div class="w-full flex flex-col gap-y-1">
      <span class="font-bold text-lg">Tingkatan Kelas :</span>
      <select data-te-select-init name="tingkatan_kelas">
        @for ($i = 10; $i <= 13; $i++)
          <option value="{{ $i }}" {{ $i == old('tingkatan_kelas') ? 'selected' : '' }}>{{ $i }}</option>
        @endfor
      </select>
      @error('tingkatan_kelas')
      <span class="text-red-500 text-sm px-2 font-semibold">{{ $message }}</span>
      @enderror
    </div>
    <div class="w-full flex flex-col gap-y-1">
      <span class="font-bold text-lg">Wali Kelas :</span>
      <select data-te-select-init data-te-select-filter="true" name="wali_kelas_id">
        @foreach ($BanyakGuru as $guru)
        <option value="{{ $guru->user->id }}" {{ $guru->user->id == old('wali_kelas_id') ? 'selected' : '' }}>{{ $guru->user->nama }}</option>
        @endforeach
      </select>
      @error('wali_kelas_id')
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