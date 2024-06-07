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
            <div class="w-full flex items-center">
                <div class="w-6/12 flex gap-4">
                    <form action="" class="w-2/4 border bg-[#ddd] px-2 py-1 flex items-center gap-2">
                        <i class="fa-solid fa-magnifying-glass"></i>
                        <input type="text" class="outline-none w-full bg-transparent text-black"
                            placeholder="Search By Nama Matpel" name="search">
                    </form>
                    <a href="/admin/mapel/create" class="flex items-center gap-2 bg-[#26577C] text-white px-2">
                        <span>ADD</span>
                        <i class="fa-solid fa-plus"></i>
                    </a>
                    <a href="{{ Request::url() }}" class="flex font-bold items-center gap-2 bg-orange-500 text-white px-2">
                        <span>REFRESH</span>
                    </a>
                </div>
            </div>
            @if ($BanyakMapel->isEmpty())
                <div class="w-full flex-col text-center font-bold text-xl mt-2">
                    <h2>Belum Ada Mapel</h2>
                </div>
            @else
                <div class="w-full flex-col">
                    <div class="py-2 font-bold text-xl">Mata Pelajaran</div>
                    <div class="w-full flex uppercase items-center">
                        <div class="w-1/12 border-2 border-gray-500 text-center font-bold py-2">No</div>
                        <div class="w-3/12 border-2 border-gray-500 text-center font-bold py-2">NAMA MATPEL</div>
                        <div class="w-3/12 border-2 border-gray-500 text-center font-bold py-2">Pengajar</div>
                        <div class="w-3/12 border-2 border-gray-500 text-center font-bold py-2">Jurusan</div>
                        <div class="w-2/12 border-2 border-gray-500 text-center font-bold py-2">Action</div>
                    </div>
                    @foreach ($BanyakMapel as $mapel)
                        <div class="w-full flex items-center {{ $loop->iteration % 2 == 1 ? 'bg-[#ddd]' : 'bg-white' }}">
                            <div class="w-1/12 text-center font-bold py-2">{{ $loop->iteration }}</div>
                            <div class="w-3/12 text-center font-bold py-2">{{ $mapel->nama_mapel }}</div>
                            <div class="w-3/12 text-center font-bold py-2 flex flex-col gap-1 text-black items-center">
                                @foreach ($mapel->pengajars as $pengajar)
                                    <span>{{ $pengajar->nama }}</span>
                                @endforeach
                            </div>
                            <div class="w-3/12 text-center font-bold py-2 flex flex-col gap-1 text-black items-center">
                                @foreach ($mapel->jurusans as $jurusan)
                                    <span>{{ $jurusan->nama_jurusan }}</span>
                                @endforeach
                            </div>
                            <div class="w-2/12 text-center font-bold py-2 grid grid-cols-2 gap-1">
                                <a href="/admin/mapel/{{ $mapel->id }}/edit"
                                    class="bg-[#26577C] text-white rounded-md"><i
                                        class="fa-solid fa-pen-to-square py-2"></i></a>
                                <button type="button" class="bg-[#FE3232] text-white rounded-md deleteBtn"><i
                                        class="fa-solid fa-trash py-2"></i></button>
                                <form action="/admin/mapel/{{ $mapel->id }}" method="POST"
                                    class="hidden absolute w-screen h-screen top-0 left-0 z-30 bg-dark-transparent">
                                    @csrf
                                    @method('delete')
                                    <div class="w-full h-full flex items-center justify-center">
                                        <div
                                            class="w-2/5 p-2.5 bg-white text-black flex flex-col items-center rounded-md gap-y-8">
                                            <span class="font-semibold text-lg">Apakah Anda Yakin Ingin Menghapus Mapel
                                                <span class="font-bold">{{ $mapel->nama_mapel }}</span></span>
                                            <div class="w-full grid grid-cols-2 gap-2 items-center justify-around">
                                                <div class="bg-red-500 text-white py-1 text-center tidakBtn cursor-pointer">
                                                    Tidak</div>
                                                <button type="submit"
                                                    class="bg-green-500 text-white py-1 text-center">Ya</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
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
