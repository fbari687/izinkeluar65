@extends('main.layouts.main')

@section('content')
  <section id="content" class="pt-12 w-full h-full">
    <a href="/guru" class="w-fit px-4 py-6 flex items-center justify-start self-start"><i class="fa-solid fa-arrow-left-long fa-2xl"></i></a>
    <form action="/guru/{{ $perizinanSiswa->id }}/izin" method="POST" class="w-full h-full flex flex-col gap-5 px-3 py-3">
      @csrf
      <span class="w-full text-xl font-black tracking-wide uppercase">Detail Izin</span>
      <div class="w-full flex flex-col gap-3">
        <div class="w-full flex items-center justify-between p-2.5 font-black text-sm uppercase">
          <span>Nama :</span>
          <span>{{ $perizinanSiswa->siswa->nama }}</span>
        </div>
        <div class="w-full flex items-center justify-between p-2.5 font-black text-sm uppercase">
          <span>NIS :</span>
          <span>{{ $perizinanSiswa->siswa->detailSiswa->nis }}</span>
        </div>
        <div class="w-full flex items-center justify-between p-2.5 font-black text-sm uppercase">
          <span>Kelas :</span>
          <span>{{ $perizinanSiswa->siswa->detailSiswa->kelas->nama_kelas }}</span>
        </div>
        <div class="w-full flex gap-1 items-center justify-between p-2.5 font-black text-sm uppercase">
          <span>Tanggal :</span>
          <span class="text-sm text-justify">{{ $perizinanSiswa->tanggal }}</span>
        </div>
        <div class="w-full flex gap-1 items-center justify-between p-2.5 font-black text-sm uppercase">
          <span>Jam Pelajaran :</span>
          <span class="text-sm text-justify">
            @php
              $filteredKeterangans = $perizinanSiswa->perizinanGuru->where('perizinan_siswa_id', $perizinanSiswa->id)
                ->where('keterangan_perizinan_id', '<=', 10)
                ->sortBy('keterangan_perizinan_id');
            @endphp
            {{ $filteredKeterangans->first()->keterangan_perizinan_id }} - {{ $filteredKeterangans->last()->keterangan_perizinan_id }}
            {{-- @foreach ($perizinanSiswa->perizinanGuru->where('keterangan_perizinan_id', '<', 11) as $jamIzinGuru)
            @endforeach --}}
          </span>
        </div>
        <div class="w-full flex flex-col gap-1 items-start justify-start p-2.5 font-black text-sm uppercase">
          <span>Alasan :</span>
          <span class="text-xs text-justify">{{ $perizinanSiswa->alasan }}</span>
        </div>
        @if ($perizinanGurus->contains('keterangan_perizinan_id', '<', 11))
        <div class="font-black">Sebagai Pengajar pada Jampel Yang bersanguktan</div>
        <div class="w-full flex flex-col rounded-lg overflow-hidden">
          <div class="w-full flex bg-[#959595] text-white font-bold">
            <div class="w-2/12 text-center border-[0.5px] border-black p-2">Jam</div>
            <div class="w-6/12 text-center border-[0.5px] border-black p-2">Mata Pelajaran</div>
            <div class="w-6/12 text-center border-[0.5px] border-black p-2">Nama Guru</div>
          </div>
          @foreach($perizinanGurus->where('keterangan_perizinan', '<', 11)->sortBy('keterangan_perizinan_id') as $perizinan)
          <div class="w-full flex bg-[rgb(73,73,73)] text-white font-bold text-sm">
            @if ($perizinan->keterangan_perizinan_id < 11)
            <div class="w-2/12 text-center border-[0.2px] border-black p-2">{{ $perizinan->keteranganPerizinan->name }}</div>
            <div class="w-6/12 text-center border-[0.2px] border-black p-2 ">
              @foreach ($perizinan->guru->jadwalPelajarans as $mapelGuru)
              @if ($perizinan->keterangan_perizinan_id == $mapelGuru->jam_pelajaran && $mapelGuru->hari == $day)
              <span>{{ $mapelGuru->mataPelajaran->nama_mapel }}</span>
              <input type="hidden" hidden name="keterangan_perizinan_id[]" value="{{ $perizinan->keterangan_perizinan_id }}">
              @endif
              @endforeach
            </div>
            <div class="w-6/12 text-center border-[0.2px] border-black p-2">
              <span>{{ $perizinan->guru->nama }}</span>
            </div>
            @endif
          </div>
          @endforeach
        </div>
        @endif
        @if ($perizinanGurus->contains('keterangan_perizinan_id', 11))
        <div class="font-black">Sebagai Guru Piket</div>
        <div class="w-full flex flex-col rounded-lg overflow-hidden">
          <div class="w-full flex bg-[#959595] text-white font-bold">
            <div class="w-full text-center border-[0.5px] border-black p-2">Guru Piket</div>
          </div>
          @foreach($perizinanGurus as $perizinan)
          <div class="w-full flex bg-[rgb(73,73,73)] text-white font-bold text-sm">
            @if ($perizinan->keterangan_perizinan_id == 11)
            <div class="w-full text-center border-[0.2px] border-black p-2">{{ $perizinan->guru->nama }}</div>
            <input type="hidden" hidden name="keterangan_perizinan_id[]" value="{{ $perizinan->keterangan_perizinan_id }}">
            @endif
          </div>
          @endforeach
        </div>
        @endif
        @if ($perizinanGurus->contains('keterangan_perizinan_id', 12))
        <div class="font-black">Sebagai Wali Kelas</div>
        <div class="w-full flex flex-col rounded-lg overflow-hidden">
          <div class="w-full flex bg-[#959595] text-white font-bold">
            <div class="w-full text-center border-[0.5px] border-black p-2">Wali Kelas</div>
          </div>
          @foreach($perizinanGurus as $perizinan)
          <div class="w-full flex bg-[rgb(73,73,73)] text-white font-bold text-sm">
            @if ($perizinan->keterangan_perizinan_id == 12)
            <div class="w-full text-center border-[0.2px] border-black p-2">{{ $perizinan->guru->nama }}</div>
            <input type="hidden" hidden name="keterangan_perizinan_id[]" value="{{ $perizinan->keterangan_perizinan_id }}">
            @endif
          </div>
          @endforeach
        </div>
        @endif
      </div>
        <button type="submit" id="izinkan" class="w-full bg-[#26577C] font-bold text-white py-2 rounded-full">Izinkan</button>
    {{-- <a href="/" class="w-full text-center bg-[#FE3232] font-bold text-white py-2 rounded-full">Tidak Izinkan</a> --}}
    {{-- <div id="confirmNotif" class="hidden absolute w-screen h-full top-0 left-0 z-50 bg-dark-transparent">
      <div class="w-full h-full flex items-center justify-center">
        <div class="w-4/5 xl:w-1/3 p-2.5 bg-white text-black flex flex-col items-center rounded-md gap-y-8">
          <span class="font-bold text-lg">Apakah Anda Yakin?</span>
          <div class="w-full grid grid-cols-2 gap-2 items-center justify-around">
            <div id="tidakBtn" class="bg-red-500 text-white py-1 text-center cursor-pointer">Tidak</div>
            <button type="submit" class="bg-green-500 text-white py-1 text-center">Ya</button>
          </div>
        </div>
      </div>
    </div> --}}
    </form>
  </section>

  
@endsection

@section('script')
  <script>
    let izinkanBtn = document.getElementById("izinkan");
    let tidakBtn = document.getElementById("tidakBtn");
    let confirmNotif = document.getElementById("confirmNotif");

    izinkanBtn.addEventListener('click', function() {
      confirmNotif.classList.remove('hidden');
    })

    tidakBtn.addEventListener('click', function() {
      confirmNotif.classList.add('hidden');
    })
  </script>
@endsection