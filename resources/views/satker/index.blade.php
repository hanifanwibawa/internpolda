<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Portal Absen - Dashboard</title>
    <link rel="icon" href="{{ asset('images/Logo.png') }}">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

    <script src="https://cdn.tailwindcss.com"></script>

    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body class="antialiased min-h-screen bg-gradient-to-br from-white via-white to-[#3870A5]">
    {{-- Alert --}}
    @if (session('success'))
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil!',
                    text: '{{ session('success') }}',
                });
            });
        </script>
    @endif
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

    <aside class="h-svh fixed flex flex-col justify-center bg-[#041938] p-3 left-0 top-0">
        <div class="flex flex-col justify-center gap-2">
            <a href="{{ route('satker') }}">
                <button class="w-10 h-10 text-center bg-white p-2 rounded-lg">
                    <ion-icon name="timer" class="w-5 h-5"></ion-icon>
                </button>
            </a>
            <a href="{{ route('satker.anggota') }}">
                <button class="w-10 h-10 text-center bg-white p-2 rounded-lg">
                    <ion-icon name="people-outline" class="w-5 h-5"></ion-icon>
                </button>
            </a>
            <a href="{{ route('satker.riwayat') }}">
                <button class="w-10 h-10 text-center bg-white p-2 rounded-lg">
                    <ion-icon name="time-outline" class="w-5 h-5"></ion-icon>
                </button>
            </a>
        </div>
        <div class="mt-auto flex justify-center gap-2">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="w-10 h-10 text-center bg-white p-2 rounded-lg">
                    <ion-icon name="lock-closed-outline" class="w-5 h-5"></ion-icon>
                </button>
            </form>
        </div>
    </aside>

    <main class="pl-32 pr-16">
        <div class="col-span-2">
            <h1 class="text-2xl font-bold mt-10 mb-7">👋 Selamat Datang, {{ $nama_satker }}</h1>
            <div class="flex gap-5">
                <div class="bg-[#041938] text-white font-semibold rounded-xl p-6 shadow-lg flex items-center hover:scale-105 transition-transform duration-200 ease-in-out h-20 flex-1">
                    <h1 class="text-xl">Jumlah Anggota </h1>
                    <h1 class="text-4xl ml-3"> {{ $total_anggota }}</h1>
                </div>
                <a href="{{ route('satker.anggota') }}" class="hover:scale-105 transition-transform duration-200 ease-in-out w-1/4 h-35">
                    <div class="relative overflow-hidden bg-gradient-to-br from-[#fafcff] to-[#6EDFF833] rounded-xl shadow p-5">
                        <h1 class="text-1xl font-bold">Tambah Anggota</h1>
                        <h3>Quick Action</h3>
                        <img src="{{ asset('images/Vector1.png') }}" alt="vector" class="absolute right-0 bottom-0 w-10">
                    </div>
                </a>
                <a href="{{ route('satker.anggota') }}" class="hover:scale-105 transition-transform duration-200 ease-in-out w-1/4 h-35">
                    <div class="relative overflow-hidden bg-gradient-to-br from-[#fafcff] to-[#6EDFF833] rounded-xl shadow p-5">
                        <h1 class="text-1xl font-bold">Pindah Anggota</h1>
                        <h3>Quick Action</h3>
                        <img src="{{ asset('images/Vector2.png') }}" alt="vector" class="absolute right-0 bottom-0 w-10">
                    </div>
                </a>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                <div class="w-full bg-[#F5F9FF] rounded-xl border shadow p-5 my-5">
                    <h1 class="text-2xl font-bold">Daftar Anggota</h1>
                    <h3>Menampilkan @if ($total_anggota < 10)
                            {{ $total_anggota }}
                        @else
                            10
                        @endif dari {{ $total_anggota }} anggota</h3>
                    <div class="relative overflow-x-auto shadow-md sm:rounded-lg mt-5">
                        <table class="w-full text-xs text-left rtl:text-right text-gray-500">
                            <thead>
                                <tr class="text-xs text-gray-700 uppercase bg-stone-200">
                                    <th scope="col" class="px-2 py-1">Nama</th>
                                    <th scope="col" class="px-2 py-1">Kontak</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($anggotas as $data)
                                    <tr class="bg-stone-100 border-b">
                                        <td class="text-left px-2 py-1">
                                            {{ $data->anggota_name }}
                                        </td>
                                        <td class="text-ellipsis px-2 py-1">
                                            {{ $data->anggota_contact }}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="w-full bg-[#F5F9FF] rounded-xl border shadow p-5 my-5">
                    <h1 class="text-2xl font-bold">Riwayat</h1>
                    <h3>Minggu Terakhir</h3>
                    <div class="relative overflow-x-auto sm:rounded-lg mt-5">
                        <table class="w-full text-xs text-left rtl:text-right text-gray-500">
                            <thead class="text-xs text-gray-700 uppercase bg-stone-200">
                                <tr class="h-10">
                                    <th scope="col" class="px-2 py-1">Tanggal</th>
                                    <th scope="col" class="px-2 py-1">Rekap Absensi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($absensis as $data)
                                    <tr class="bg-white border-b">
                                        <td class="text-left px-2 py-1">
                                            {{ \Carbon\Carbon::parse($data->absensi_date)->translatedFormat('j F Y') }}
                                        </td>
                                        <td class="px-2 py-1">
                                            <b>{{ $data->absensi_total - $data->absensi_leave }}</b> Masuk <b>{{ $data->absensi_leave }}</b> Izin
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>


</body>

</html>
