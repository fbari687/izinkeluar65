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
            @if ($BanyakKelas->isEmpty())
                <div class="w-full flex-col text-center font-bold text-xl mt-2">
                    <h2>Belum Ada Kelas</h2>
                </div>
            @else
                <div class="w-full flex-col">
                    <div class="py-2 font-bold text-xl">List Kelas</div>
                    <div class="w-full p-4 grid grid-cols-8 gap-8">
                        @foreach ($BanyakKelas as $kelas)
                            <a href="/admin/jadwal/{{ $kelas->id }}"
                                class="font-bold text-black border-2 shadow-xl text-center py-4 rounded-full transition-all duration-150 bg-white hover:shadow-2xl">{{ $kelas->nama_kelas }}</a>
                        @endforeach
                    </div>
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
