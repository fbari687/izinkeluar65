@extends('main.layouts.main')

@section('content')
    @if (session()->has('success'))
        <div class="w-[50vw] absolute right-0 top-24 bg-green-600 flex items-center lg:w-[20vw] xl:w-[15vw] py-4 px-3 text-white text-sm gap-2"
            id="successNotif">
            <div class=""><i class="fa-solid fa-circle-check fa-2xl"></i></div>
            <span>{{ session('success') }}</span>
            <button type="button" class="font-bold" id="closeNotifBtn">&#10005;</button>
        </div>
    @endif
    @if ($BanyakJadwal->isEmpty())
        <section class="pt-12 w-full h-full flex flex-col items-center">
            <a href="/siswa" class="w-fit px-4 py-6 flex items-center justify-start self-start"><i
                    class="fa-solid fa-arrow-left-long fa-2xl"></i></a>
            <h1 class="mt-12 font-bold text-xl text-center w-full">Tidak Ada Jadwal Hari Ini</h1>
        </section>
    @else
        <section id="content" class="pt-12 w-full h-full">
            <a href="/siswa" class="w-fit px-4 py-6 flex items-center justify-start self-start"><i
                    class="fa-solid fa-arrow-left-long fa-2xl"></i></a>
            <form action="/siswa/form" method="POST" class="w-full flex flex-col px-2.5 py-8 gap-3">
                @csrf
                <span class="self-start font-bold text-xl">PERMISSION FORM</span>
                <div class="w-full flex flex-col gap-2">
                    <span class="text-sm font-bold">Nama</span>
                    <input type="hidden" name="siswa_id" readonly class="hidden" hidden value="{{ auth()->user()->id }}" />
                    <input type="text" readonly
                        class="bg-[#8B8B8B] text-gray-100 placeholder:text-gray-100 outline-none p-2.5 rounded-md prevent-select"
                        placeholder="Nama" value="{{ auth()->user()->nama }}" />
                </div>
                <input type="date" hidden class="hidden" name="tanggal" value="{{ $tanggalSekarang }}">
                <div class="w-full flex flex-col gap-2">
                    <span class="text-sm font-bold">NIS</span>
                    <input type="text"
                        class="bg-[#8B8B8B] text-gray-100 placeholder:text-[#ABABAB] outline-none p-2.5 rounded-md"
                        placeholder="nis" readonly value="{{ $siswa->nis }}" />
                </div>
                <div class="w-full flex flex-col gap-2">
                    <span class="text-sm font-bold">Kelas</span>
                    <input type="text"
                        class="bg-[#8B8B8B] text-gray-100 placeholder:text-[#ABABAB] outline-none p-2.5 rounded-md"
                        placeholder="kelas" readonly value="{{ $siswa->kelas->nama_kelas }}" />
                </div>
                <div class="w-full flex flex-col gap-2">
                    <span class="text-sm font-bold">Nama Wali Kelas</span>
                    <input type="hidden" name="keterangan_perizinan_id[]" hidden value="12">
                    <input type="hidden" name="guru_id[]" hidden value="{{ $siswa->kelas->waliKelas->id }}">
                    <input type="text"
                        class="bg-[#8B8B8B] text-gray-100 placeholder:text-[#ABABAB] outline-none p-2.5 rounded-md"
                        placeholder="wali kelas" readonly value="{{ $siswa->kelas->waliKelas->nama }}" />
                </div>
                <div class="w-full flex flex-col rounded-lg overflow-hidden">
                    <div class="w-full flex bg-[#959595] text-white font-bold">
                        <div class="w-2/12 text-center border-[0.5px] border-black p-2">Jam</div>
                        <div class="w-4/12 text-center border-[0.5px] border-black p-2">Mata Pelajaran</div>
                        <div class="w-4/12 text-center border-[0.5px] border-black p-2">Nama Guru</div>
                        <div class="w-2/12 text-center border-[0.5px] border-black p-2">Izin</div>
                    </div>
                    @foreach ($BanyakJadwal as $jadwal)
                        <div class="w-full flex bg-[#494949] text-white font-bold text-sm">
                            <div class="w-2/12 text-center border-[0.5px] border-black p-2">{{ $jadwal->jam_pelajaran }}
                            </div>
                            <div
                                class="w-4/12 text-center border-[0.5px] border-black p-2 flex items-center justify-center">
                                <span>{{ $jadwal->mataPelajaran->nama_mapel }}</span>
                            </div>
                            <div
                                class="w-4/12 text-center border-[0.5px] border-black p-2 flex items-center justify-center">
                                <span>{{ $jadwal->guru->nama }}</span>
                            </div>
                            <div
                                class="w-2/12 text-center border-[0.5px] border-black p-2 flex items-center justify-center">
                                <input type="hidden" hidden name="keterangan_perizinan_id[]"
                                    value="{{ $jadwal->jam_pelajaran }}" disabled>
                                <input type="hidden" hidden name="guru_id[]" value="{{ $jadwal->guru->id }}" disabled>
                                <input type="checkbox" class="aspect-square max-w-[18px] h-[90%] cursor-pointer"
                                    onchange="berubahStatus(this)">
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="w-full flex bg-[#494949] text-white font-bold">
                    <div class="w-full text-center border-[0.5px] border-black p-2">
                        <input type="hidden" name="keterangan_perizinan_id[]" hidden value="11">
                        <select name="guru_id[]" id="piket" required
                            class="w-full bg-[#494949] text-white outline-none">
                            <option value="0" selected disabled class="text-white bg-[#494949]">Input Guru Piket
                            </option>
                            @foreach ($BanyakGuruPiket as $guru)
                                <option value="{{ $guru->user_id }}">{{ $guru->user->nama }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <textarea name="alasan" id="alasan" rows="8" placeholder="Alasan"
                    class="w-full bg-[#d5d5d5] border p-2 rounded-lg"></textarea>
                <span class="text-xs font-bold text-red-600">*SEBAIKNYA ANDA PAHAMI <a href="/peraturan"
                        class="underline text-blue-600">PERATURAN</a> DARI FORM PERIZINAN INI</span>
                <span class="text-xs font-bold text-red-600">*SILAHKAN UNTUK MEMINTA PERSETUJUAN KE GURU</span>
                <span class="text-xs font-bold text-red-600">*TERDAPAT KONSEKUENSI JIKA MURID MENYALAHGUNAKAN PERIZINAN
                    INI</span>
                <button type="submit" class="w-full bg-[#26577C] font-bold text-white py-2 rounded-full">Submit</button>
                <a href="/"
                    class="w-full text-center bg-[#FE3232] font-bold text-white py-2 rounded-full">Cancel</a>
            </form>
        </section>
    @endif
@endsection

@section('script')
    <script>
        function berubahStatus(checkbox) {
            // Temukan dua input sibling
            let keteranganInput = checkbox.parentElement.querySelector('input[name="keterangan_perizinan_id[]"]');
            let guruIdInput = checkbox.parentElement.querySelector('input[name="guru_id[]"]');

            // Periksa status checkbox
            if (checkbox.checked) {
                // Checkbox dicentang, nonaktifkan kedua input sibling
                keteranganInput.disabled = false;
                guruIdInput.disabled = false;
            } else {
                // Checkbox tidak dicentang, aktifkan kedua input sibling
                keteranganInput.disabled = true;
                guruIdInput.disabled = true;
            }
        }
    </script>
@endsection
