@extends('main.layouts.main')

@section('content')
    @if (session()->has('success'))
        <div class="w-[50vw] absolute right-0 top-24 bg-green-600 flex items-center lg:w-[20vw] xl:w-[15vw] py-4 px-3 text-white text-sm gap-2"
            id="successNotif">
            <div class=""><i class="fa-solid fa-circle-check fa-2xl"></i></div>
            <span>{{ session('success') }} <span class="font-semibold">{{ session('nama') }}</span></span>
            <button type="button" class="font-bold" id="closeNotifBtn">&#10005;</button>
        </div>
    @endif
    <section id="content" class="pt-12 w-full h-full mx-auto">
        <div class="w-full flex flex-col items-center p-2.5 gap-5">
            <div class="w-full flex-col">
                <div class="py-2 font-semibold text-xl">Jadwal Pelajaran Kelas <span
                        class="font-bold">{{ $kelas->nama_kelas }}</span></div>
            </div>
            <div class="w-full flex-col">
                <div class="w-full flex">
                    <div class="w-1/12 border border-gray-700 text-center"></div>
                    @for ($i = 1; $i <= 10; $i++)
                        <div class="w-1/12 border border-gray-700 text-center font-bold">{{ $i }}</div>
                    @endfor
                    <div class="w-1/12 border border-gray-700 text-center font-bold">Action</div>
                </div>
                @foreach ($listHari as $hari)
                    <div class="w-full flex">
                        <div
                            class="w-1/12 border-l border-r border-b border-gray-700 text-center font-bold flex items-center justify-center">
                            {{ $hari }}</div>
                        @php
                            $jadwals = $BanyakJadwal->where('hari', $hari);
                        @endphp
                        @foreach ($jadwals as $jadwal)
                            <div
                                class="w-1/12 border-l border-r border-b border-gray-700 text-center flex items-center justify-center text-sm 2xl:text-base">
                                {{ $jadwal->mataPelajaran->nama_mapel == null ? '' : $jadwal->mataPelajaran->nama_mapel }}
                            </div>
                        @endforeach
                        <div
                            class="w-1/12 border-l border-r border-b border-gray-700 text-center flex items-center justify-center p-1">
                            <a href="/admin/jadwal/{{ $kelas->id }}/{{ $hari }}"
                                class="bg-[#26577C] text-white px-4 py-1 rounded-full"><i
                                    class="fa-solid fa-pen-to-square"></i> Edit</a>
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
        const closeNotifBtn = document.getElementById('closeNotifBtn');
        if (typeof(closeNotifBtn) != 'undefined' && closeNotifBtn != null) {
            closeNotifBtn.addEventListener('click', function() {
                this.parentElement.remove();
            });
        }
    </script>
@endsection
