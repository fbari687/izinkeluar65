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
    <section id="content" class="pt-12 w-full h-full mx-auto">
        <div class="w-full flex flex-col items-center p-2.5 gap-5">
            <span class="text-2xl font-bold">Profile / Edit Profile</span>
            <div class="w-48 h-48 rounded-full bg-white p-0.5 overflow-hidden">
                <div style="background-image: url({{ asset('/storage/' . auth()->user()->profile_picture) }})"
                    class="w-full h-full rounded-full bg-cover bg-center"></div>
            </div>
            <form action="/profile/{{ auth()->user()->id }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="text" hidden value="{{ auth()->user()->profile_picture }}" name="oldImage">
                <label
                    class="flex flex-col items-center gap-1 text-sm font-bond text-white bg-[#26577C] p-2 rounded-md cursor-pointer"
                    for="image">
                    + Tambah/Edit Foto
                </label>
                <input type="file" hidden name="profile_picture" id="image" class="hidden">
            </form>
            <div class="w-full flex flex-col gap-2">
                <span class="text-sm font-bold">Nama</span>
                <div class="bg-[#8B8B8B] text-gray-200 placeholder:text-[#ABABAB] outline-none p-2.5 rounded-md">
                    {{ auth()->user()->nama }}</div>
            </div>
            <a href="/profile/changepass"
                class="w-full text-center bg-orange-primary font-bold text-white py-2 rounded-full">Ubah Password</a>
        </div>
    </section>
@endsection

@section('script')
    <script>
        const changeImage = document.getElementById('image');

        changeImage.addEventListener('change', function() {
            this.parentElement.submit();
        })

        const closeNotifBtn = document.getElementById('closeNotifBtn');
        if (typeof(closeNotifBtn) != 'undefined' && closeNotifBtn != null) {
            closeNotifBtn.addEventListener('click', function() {
                this.parentElement.remove();
            });
        }
    </script>
@endsection
