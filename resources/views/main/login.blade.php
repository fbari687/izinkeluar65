@extends('main.layouts.main')

@section('content')
<section id="content" class="w-screen h-screen flex items-center justify-center flex-col gap-2">
    <img src="{{ asset('img/LOGOSMKN65YANGKETENGAH.png') }}" alt="" class="w-1/2 lg:w-1/5">
    <span class="text-sm font-extrabold text-center">WELCOME TO PERMISSION FORM SMKN 65 JAKARTA</span>
    <span class="text-2xl font-bold">LOGIN FORM</span>
    <form action="/login" method="POST" class="w-full flex flex-col items-center px-4 gap-2">
        @csrf
        <input type="text" placeholder="USERNAME" name="username" required class="w-full lg:w-1/2 bg-[#DFDFDF] p-2.5 rounded-full">
        <div class="w-full lg:w-1/2 bg-[#DFDFDF] p-2.5 rounded-full flex justify-between">
            <input type="password" placeholder="PASSWORD" name="password" id="" required class="w-full bg-transparent outline-none">
            <button type="button" id="togglePassword"><i class="fa-solid fa-eye"></i></button>
        </div>
        @if (session()->has('failed'))
        <span class="text-red-500 text-sm font-bold">{{ session('failed') }}</span>
        @endif
        <button type="submit" class="text-white bg-[#E55604] px-5 py-2.5 rounded-full font-bold">LOGIN</button>
    </form>
</section>
@endsection

@section('script')
<script>
    const togglePassword = document.getElementById('togglePassword');

togglePassword.addEventListener('click', function() {
    const inputPassword = this.previousElementSibling;
    if (inputPassword.type === "password") {
        inputPassword.type = "text";
        this.firstElementChild.classList.replace("fa-eye", "fa-eye-slash")
    } else {
        inputPassword.type = "password"
        this.firstElementChild.classList.replace("fa-eye-slash", "fa-eye")
    }
});
</script>
@endsection