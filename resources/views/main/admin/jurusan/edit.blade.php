@extends('main.layouts.main')

@section('content')
<section id="content" class="pt-12 w-full h-full mx-auto">
  <form action="/admin/jurusan/{{ $jurusan->id }}" method="POST" class="w-full flex flex-col items-center p-5 gap-2">
    @csrf
    @method('put')
    <span class="w-full text-2xl font-bold">Edit Data Jurusan</span>
    <div class="w-full flex flex-col gap-y-1">
      <span class="font-bold text-lg">Nama Jurusan :</span>
      <input type="text" class="w-full px-2 py-1.5 border-2 text-black rounded-md" name="nama_jurusan" placeholder="Nama Jurusan" value="{{ old('nama_jurusan', $jurusan->nama_jurusan) }}">
      @error('nama_jurusan')
      <span class="text-red-500 text-sm px-2 font-semibold">{{ $message }}</span>
      @enderror
    </div>
    <div class="w-full flex flex-col gap-y-1">
      <span class="font-bold text-lg">Kaprodi :</span>
      <select data-te-select-init data-te-select-filter="true" name="kaprodi_id">
        @foreach ($BanyakGuru as $guru)
          <option value="{{ $guru->user->id }}" {{ $guru->user->id == old('kaprodi_id', $jurusan->kaprodi_id) ? 'selected' : '' }}>{{ $guru->user->nama }}</option>
        @endforeach
      </select>
      @error('kaprodi_id')
      <span class="text-red-500 text-sm px-2 font-semibold">{{ $message }}</span>
      @enderror
    </div>
    <button type="submit" class="bg-[#26577C] text-white w-full py-1 font-bold text-lg flex items-center justify-center gap-2 rounded-md shadow-lg">
      <span>Edit</span>
      <i class="fa-solid fa-pen-to-square"></i>
    </button>
  </form>
</section>
@endsection

@section('script')

@endsection