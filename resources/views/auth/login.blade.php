<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Portal Absen - Login</title>
    <link rel="icon" href="{{ asset('images/Logo.png') }}">

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

    <script src="https://cdn.tailwindcss.com"></script>

    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body class="antialiased h-screen flex flex-col justify-center bg-gradient-to-br from-white via-white to-[#3870A5]">
    <div class="grid grid-cols-1 md:grid-cols-2 place-items-center gap-3">
        <div class="w-full">
            @if (session('error'))
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    Swal.fire({
                        icon: 'error',
                        title: 'Kesalahan!',
                        text: '{{ session('error') }}',
                    });
                });
            </script>
        @endif
            <form method="POST" action="{{ route('login.auth') }}" class="flex flex-col justify-center items-center gap-5 hidden md:flex">
                @csrf
                <div class="max-w-md w-full h-full bg-white shadow-2xl rounded-xl p-7">
                    <h1 class="text-center text-2xl font-bold mb-5">Login</h1>
                    <div class="mb-3">
                        <label for="user_name" class="block text-sm font-medium text-gray-700">Username</label>
                        <input type="text" name="user_name" id="user_name"
                            class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    </div>
                    <div class="mb-3">
                        <label for="user_password" class="block text-sm font-medium text-gray-700">Password</label>
                        <input type="password" name="user_password" id="user_password"
                            class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    </div>
                    <div class="mb-3">
                        <button type="submit"
                            class="mt-3 w-full py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            Log in
                        </button>
                    </div>
                </div>
            </form>
        </div>
        <div class="flex flex-col justify-center items-center gap-5 hidden md:flex">
            <h1 class="uppercase text-center text-2xl font-bold">Portal Absensi Apel Pagi</h1>
            <img src="{{ asset('images/Logo.png') }}" alt="">
        </div>
    </div>
</body>

</html>
