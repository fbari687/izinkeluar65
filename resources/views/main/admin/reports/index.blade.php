@extends('main.layouts.main')

@section('content')
    <section id="content" class="pt-12 w-full h-full mx-auto">
        <div class="w-full flex flex-col items-center p-2.5 gap-5">
            {{-- <div class="w-full flex items-center">
                <div class="w-6/12 flex gap-4">
                    <div class="w-2/4 border bg-[#ddd] px-2 py-1 flex items-center gap-2">
                        <i class="fa-solid fa-magnifying-glass"></i>
                        <input type="text" class="outline-none w-full bg-transparent text-black" placeholder="Search">
                    </div>
                    <div class="flex items-center gap-2 text-black px-2">
                        <select data-te-select-init data-te-select-placeholder="Filter">
                            <option value="1">Terbaru</option>
                            <option value="2">Terlama</option>
                        </select>
                    </div>
                </div>
            </div> --}}
            <div class="w-full flex-col">
                <div class="py-2 font-bold text-xl">Laporan</div>
                <div class="w-full flex uppercase items-center">
                    <div class="w-1/12 border-2 border-gray-500 text-center font-bold py-2">No</div>
                    <div class="w-3/12 border-2 border-gray-500 text-center font-bold py-2">Nama</div>
                    <div class="w-1/12 border-2 border-gray-500 text-center font-bold py-2">NIS</div>
                    <div class="w-2/12 border-2 border-gray-500 text-center font-bold py-2">Tanggal</div>
                    <div class="w-2/12 border-2 border-gray-500 text-center font-bold py-2">Kelas</div>
                    <div class="w-1/12 border-2 border-gray-500 text-center font-bold py-2">Jam</div>
                    <div class="w-2/12 border-2 border-gray-500 text-center font-bold py-2">Action</div>
                    <div class="w-1/12 border-2 border-gray-500 text-center font-bold py-2">Action</div>
                </div>
                @foreach ($BanyakPerizinanSiswa as $perizinanSiswa)
                    <div class="w-full flex items-center {{ $loop->iteration % 2 == 0 ? 'bg-[#ddd]' : 'bg-white' }}">
                        <div class="w-1/12 text-center font-bold py-2">{{ $loop->iteration }}</div>
                        <div class="w-3/12 text-center font-bold py-2">{{ $perizinanSiswa->siswa->nama }}</div>
                        <div class="w-1/12 text-center font-bold py-2">{{ $perizinanSiswa->siswa->detailSiswa->nis }}</div>
                        <div class="w-2/12 text-center font-bold py-2">{{ $perizinanSiswa->tanggal }}</div>
                        <div class="w-2/12 text-center font-bold py-2">
                            {{ $perizinanSiswa->siswa->detailSiswa->kelas->nama_kelas }}</div>
                        <div class="w-1/12 text-center font-bold py-2"><span
                                class="self-center text-black font-bold text-sm">@php
                                    $filteredKeterangans = $perizinanSiswa->perizinanGuru
                                        ->where('perizinan_siswa_id', $perizinanSiswa->id)
                                        ->where('keterangan_perizinan_id', '<=', 10)
                                        ->sortBy('keterangan_perizinan_id');
                                @endphp
                                {{ $filteredKeterangans->first()->keterangan_perizinan_id }} -
                                {{ $filteredKeterangans->last()->keterangan_perizinan_id }}</span></div>
                        <div class="w-2/12 text-center font-bold py-2 grid grid-cols-1 px-2 gap-1">
                            <div
                                class="{{ $perizinanSiswa->status_perizinan_id == 3 ? 'bg-green-500' : 'bg-red-600' }} text-white rounded-md py-1 prevent-select cursor-default">
                                {{ $perizinanSiswa->statusPerizinan->nama }}
                            </div>
                        </div>
                        <div class="w-1/12 text-center font-bold py-2 px-2 grid grid-cols-1 gap-1">
                            <a href="/admin/reports/{{ $perizinanSiswa->id }}" data-te-toggle="tooltip"
                                title="Lihat Detail" class="bg-[#26577C] text-white rounded-md"><i
                                    class="fa-solid fa-info  py-2"></i></a>
                        </div>
                    </div>
                @endforeach
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
