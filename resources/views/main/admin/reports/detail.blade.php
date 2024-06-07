@extends('main.layouts.main')

@section('content')
    <section id="content" class="pt-12 w-full h-full mx-auto">
        <div class="w-full flex flex-col items-center p-2.5 gap-5">
            <a href="/admin/reports"
                class="bg-orange-600 shadow-lg text-white flex items-center gap-2 px-3 py-0.5 rounded-md self-start">
                <i class="fa-solid fa-caret-left"></i>
                <span>BACK</span>
            </a>
            <div class="font-bold text-2xl self-start">Detail</div>
            <div class="w-full flex flex-col items-center gap-2">
                <div class="w-full flex items-center gap-2 px-3 font-bold text-xl">
                    <span>Nama : </span>
                    <span>{{ $perizinanSiswa->siswa->nama }}</span>
                </div>
                <div class="w-full flex items-center gap-2 px-3 font-bold text-xl">
                    <span>NIS : </span>
                    <span>{{ $perizinanSiswa->siswa->detailSiswa->nis }}</span>
                </div>
                <div class="w-full flex items-center gap-2 px-3 font-bold text-xl">
                    <span>Kelas : </span>
                    <span>{{ $perizinanSiswa->siswa->detailSiswa->kelas->nama_kelas }}</span>
                </div>
                <div class="w-full flex items-center gap-2 px-3 font-bold text-xl">
                    <span>Guru Piket : </span>
                    <span>
                        @foreach ($perizinanSiswa->perizinanGuru as $perizinan)
                            @if ($perizinan->keterangan_perizinan_id == 11)
                                {{ $perizinan->guru->nama }}
                            @endif
                        @endforeach
                    </span>
                </div>
                <div class="w-full flex items-center gap-2 px-3 font-bold text-xl">
                    <span>Wali Kelas : </span>
                    <span>
                        @foreach ($perizinanSiswa->perizinanGuru as $perizinan)
                            @if ($perizinan->keterangan_perizinan_id == 12)
                                {{ $perizinan->guru->nama }}
                            @endif
                        @endforeach
                    </span>
                </div>
                <div class="w-full flex flex-col gap-2 px-3 font-bold text-xl">
                    <span class="">Alasan : </span>
                    <span>{{ $perizinanSiswa->alasan }}</span>
                </div>
                <div class="w-full flex flex-col rounded-lg overflow-hidden">
                    <div class="w-full flex bg-[#959595] text-white font-bold">
                        <div class="w-2/12 text-center border-[0.5px] border-black p-2">Jam</div>
                        <div class="w-3/12 text-center border-[0.5px] border-black p-2">Mata Pelajaran</div>
                        <div class="w-4/12 text-center border-[0.5px] border-black p-2">Nama Guru</div>
                        <div class="w-3/12 text-center border-[0.5px] border-black p-2">Status</div>
                    </div>
                    @foreach ($perizinanSiswa->perizinanGuru->sortBy('keterangan_perizinan_id') as $perizinan)
                        @if ($perizinan->keterangan_perizinan_id < 11)
                            <div class="w-full flex bg-[rgb(73,73,73)] text-white font-bold text-sm">
                                <div class="w-2/12 text-center border-[0.2px] border-black p-2">
                                    {{ $perizinan->keterangan_perizinan_id }}</div>
                                <div class="w-3/12 text-center border-[0.2px] border-black p-2 ">
                                    @foreach ($perizinan->guru->jadwalPelajarans as $mapelGuru)
                                        @if ($perizinan->keterangan_perizinan_id == $mapelGuru->jam_pelajaran && $mapelGuru->hari == $day)
                                            <span>{{ $mapelGuru->mataPelajaran->nama_mapel }}</span>
                                            <input type="hidden" hidden name="keterangan_perizinan_id[]"
                                                value="{{ $perizinan->keterangan_perizinan_id }}">
                                        @endif
                                    @endforeach
                                </div>
                                <div class="w-4/12 text-center border-[0.2px] border-black p-2">
                                    <span>{{ $perizinan->guru->nama }}</span>
                                </div>
                                <div class="w-3/12 text-center border-[0.2px] border-black p-2">
                                    <span>{{ $perizinan->statusPerizinan->nama }}</span>
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>
                @if ($perizinanSiswa->perizinanGuru->contains('keterangan_perizinan_id', 11))
                    <div class="w-full flex flex-col rounded-lg overflow-hidden">
                        <div class="w-full flex bg-[#959595] text-white font-bold">
                            <div class="w-9/12 text-center border-[0.5px] border-black p-2">Guru Piket</div>
                            <div class="w-3/12 text-center border-[0.5px] border-black p-2">Status</div>
                        </div>
                        @foreach ($perizinanSiswa->perizinanGuru as $perizinan)
                            <div class="w-full flex bg-[rgb(73,73,73)] text-white font-bold text-sm">
                                @if ($perizinan->keterangan_perizinan_id == 11)
                                    <div class="w-9/12 text-center border-[0.2px] border-black p-2">
                                        {{ $perizinan->guru->nama }}</div>
                                    <div class="w-3/12 text-center border-[0.2px] border-black p-2">
                                        {{ $perizinan->statusPerizinan->nama }}</div>
                                    <input type="hidden" hidden name="keterangan_perizinan_id[]"
                                        value="{{ $perizinan->keterangan_perizinan_id }}">
                                @endif
                            </div>
                        @endforeach
                    </div>
                @endif
                @if ($perizinanSiswa->perizinanGuru->contains('keterangan_perizinan_id', 12))
                    <div class="w-full flex flex-col rounded-lg overflow-hidden">
                        <div class="w-full flex bg-[#959595] text-white font-bold">
                            <div class="w-9/12 text-center border-[0.5px] border-black p-2">Wali Kelas</div>
                            <div class="w-3/12 text-center border-[0.5px] border-black p-2">Status</div>
                        </div>
                        @foreach ($perizinanSiswa->perizinanGuru as $perizinan)
                            <div class="w-full flex bg-[rgb(73,73,73)] text-white font-bold text-sm">
                                @if ($perizinan->keterangan_perizinan_id == 12)
                                    <div class="w-9/12 text-center border-[0.2px] border-black p-2">
                                        {{ $perizinan->guru->nama }}</div>
                                    <div class="w-3/12 text-center border-[0.5px] border-black p-2">
                                        {{ $perizinan->statusPerizinan->nama }}</div>
                                    <input type="hidden" hidden name="keterangan_perizinan_id[]"
                                        value="{{ $perizinan->keterangan_perizinan_id }}">
                                @endif
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    </section>
@endsection

@section('script')
    <script>
        const deleteBtn = document.querySelectorAll('.deleteBtn');
        const tidakBtn = document.querySelectorAll('.tidakBtn');

        deleteBtn.forEach(e => {
            e.addEventListener('click', function() {
                this.nextElementSibling.classList.remove('hidden');
            })
        });

        tidakBtn.forEach(e => {
            e.addEventListener('click', function() {
                this.parentElement.parentElement.parentElement.parentElement.classList.add('hidden');
            })
        });
    </script>
@endsection
