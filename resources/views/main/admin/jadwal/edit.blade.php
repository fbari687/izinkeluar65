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
        <form action="/admin/jadwal" method="POST" class="w-full flex flex-col items-center p-2.5 gap-5">
            @csrf
            <div class="w-full flex-col">
                <div class="py-2 font-semibold text-xl">Jadwal Pelajaran Kelas <span
                        class="font-bold">{{ $kelas->nama_kelas }}</span></div>
                <div class="py-2 font-semibold text-xl">{{ $hari }}</div>
            </div>
            <div class="w-full self-start border border-gray-700 flex flex-col">
                <input type="hidden" hidden name="hari" value="{{ $hari }}">
                <input type="hidden" hidden name="kelas_id" value="{{ $kelas->id }}">
                <div class="w-full flex">
                    <div class="w-1/3 flex border border-gray-700 text-center items-center justify-center p-2 font-bold">Jam
                        Ke</div>
                    <div class="w-1/3 flex border border-gray-700 text-center items-center justify-center p-2 font-bold">
                        Mata Pelajaran</div>
                    <div class="w-1/3 flex border border-gray-700 text-center items-center justify-center p-2 font-bold">
                        Guru</div>
                </div>
                @for ($i = 1; $i <= 10; $i++)
                    <div class="w-full flex">
                        <div class="w-1/3 flex border text-center items-center justify-center p-2 font-bold">
                            {{ $i }}</div>
                        <div class="w-1/3 flex border text-center items-center justify-center py-2 px-3 font-bold">
                            @php
                                $selectedMapelId = isset($BanyakJadwal[$i - 1])
                                    ? $BanyakJadwal[$i - 1]->mata_pelajaran_id
                                    : null;
                            @endphp
                            <select data-te-select-init data-te-select-filter="true" name="mata_pelajaran_id[]"
                                onchange="fetchGuru(this)" required>
                                <option value="" disable hidden>Pilih Mapel</option>
                                @foreach ($BanyakMapel as $mapel)
                                    <option value="{{ $mapel->id }}"
                                        {{ $mapel->id == old('mata_pelajaran_id', $selectedMapelId) ? 'selected' : '' }}>
                                        {{ $mapel->nama_mapel }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="w-1/3 flex border text-center items-center justify-center p-2 font-bold">
                            @php
                                $selectedGuruId = isset($BanyakJadwal[$i - 1]) ? $BanyakJadwal[$i - 1]->guru_id : null;
                            @endphp
                            <select data-te-select-init data-te-select-filter="true" id="guru_id" name="guru_id[]"
                                required>
                                <option value="" disable hidden>Pilih Mapel Terlebih Dulu</option>
                                @foreach ($BanyakGuru as $guru)
                                    @if (in_array($selectedMapelId, $guru->mataPelajarans->pluck('id')->toArray()))
                                        <option value="{{ $guru->id }}"
                                            {{ $guru->id == old('guru_id', $selectedGuruId) ? 'selected' : '' }}>
                                            {{ $guru->nama }}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                    </div>
                @endfor
            </div>
            <div class="text-red-500 font-bold self-start">*Harus Diisi Semua</div>
            <button type="submit" class="bg-orange-primary text-white px-3 py-1 text-lg rounded-full">Save</button>
        </form>
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

        function fetchGuru(selectElement) {
            let selectedMataPelajaranId = selectElement.value;
            let guruSelect = selectElement.parentElement.parentElement.nextElementSibling.firstElementChild
                .firstElementChild.nextElementSibling;
            // console.log(selectElement.parentElement.parentElement.nextElementSibling.firstElementChild.firstElementChild.nextElementSibling);

            // Ganti URL API sesuai dengan kebutuhan Anda
            const apiUrl = `/admin/jadwal/getguru?uid=${selectedMataPelajaranId}`;

            fetch(apiUrl)
                .then(response => response.json())
                .then(response => {
                    let teachers = response.data;
                    let guruOption = '';
                    teachers.forEach(teacher => {
                        guruOption += `<option value="${teacher.id}">${teacher.nama}</option>`
                    });
                    guruSelect.innerHTML = guruOption;
                })
        }
    </script>
@endsection
