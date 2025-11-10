<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Portal Absen - Pamenwas</title>
    <link rel="icon" href="{{ asset('images/Logo.png') }}">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- SweetAlert2 for alerts -->
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">

</head>

<body class="antialiased min-h-screen bg-gradient-to-br from-white via-white to-[#3870A5]">

    <!-- Alert -->
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

    <!-- Sidebar -->
    <aside class="fixed h-screen w-16 flex flex-col justify-center bg-[#041938] p-3 top-0 left-0 shadow-lg">
        <div class="flex flex-col gap-2">
            <a href="{{ route('pamenwas') }}" class="flex justify-center">
                <button class="w-10 h-10 text-center bg-white p-2 rounded-lg shadow">
                    <ion-icon name="timer" class="w-5 h-5 text-[#041938]"></ion-icon>
                </button>
            </a>
            <a href="{{ route('pamenwas.rekap') }}" class="flex justify-center">
                <button class="w-10 h-10 text-center bg-white p-2 rounded-lg shadow">
                    <ion-icon name="document-outline" class="w-5 h-5 text-[#041938]"></ion-icon>
                </button>
            </a>
        </div>
        <div class="mt-auto flex justify-center gap-2">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="w-10 h-10 text-center bg-white p-2 rounded-lg shadow">
                    <ion-icon name="lock-closed-outline" class="w-5 h-5 text-[#041938]"></ion-icon>
                </button>
            </form>
        </div>
    </aside>

    <!-- Main Content -->
    <main class="ml-20 p-8">
        <h1 class="text-center text-4xl font-bold mt-10">PAMENWAS</h1>
        <p class="text-center text-xl text-gray-600">
            <?php
            $hari = ['Sun' => 'Minggu', 'Mon' => 'Senin', 'Tue' => 'Selasa', 'Wed' => 'Rabu', 'Thu' => 'Kamis', 'Fri' => 'Jumat', 'Sat' => 'Sabtu'];
            $bulan = ['January' => 'Januari', 'February' => 'Februari', 'March' => 'Maret', 'April' => 'April', 'May' => 'Mei', 'June' => 'Juni', 'July' => 'Juli', 'August' => 'Agustus', 'September' => 'September', 'October' => 'Oktober', 'November' => 'November', 'December' => 'Desember'];
            $hariIni = date('D', strtotime('today'));
            $bulanIni = date('F', strtotime('today'));
            echo $hari[$hariIni] . ', ' . date('d ', strtotime('today')) . $bulan[$bulanIni] . date(' Y', strtotime('today'));
            ?>
        </p>

        <div class="flex justify-center mt-10">
            <div class="w-full flex flex-col lg:flex-row gap-4">
                <!-- Statistik Kehadiran -->
                <div class="w-full lg:w-7/12 pr-4">
                    <div class="bg-white rounded-lg shadow-md p-6 mb-6">
                        <div class="flex justify-between items-center mb-4">
                            <h2 class="text-xl font-semibold">Statistik Kehadiran Semua Satker</h2>
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                            <div class="bg-blue-100 rounded-lg p-4">
                                <h3 class="text-lg font-semibold text-blue-700">Total Personil</h3>
                                <p class="text-3xl font-bold text-blue-700">{{ $totalPersonil }}</p>
                            </div>
                            <div class="bg-green-100 rounded-lg p-4">
                                <h3 class="text-lg font-semibold text-green-700">Total Hadir</h3>
                                <p class="text-3xl font-bold text-green-700">{{ isset($totalHadir) ? $totalHadir : 0 }}</p>
                            </div>
                            <div class="bg-red-100 rounded-lg p-4">
                                <h3 class="text-lg font-semibold text-red-700">Total Tidak Hadir</h3>
                                <p class="text-3xl font-bold text-red-700">{{ isset($totalTidakHadir) ? $totalTidakHadir : 0 }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Satker Lists -->
                    <div class="bg-white rounded-lg shadow-md p-6 mb-6">
                        <div class="flex justify-between items-center mb-4">
                            <h2 class="text-xl font-semibold">Daftar Satuan Kerja</h2>
                        </div>
                        <table id="satkerTable" class="min-w-full divide-y divide-gray-200 hover striped bordered">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Satuan Kerja
                                    </th>
                                    <th scope="col" class="relative px-6 py-3">
                                        <span class="sr-only">Aksi</span>
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach ($satkers as $option)
                                <tr class="hover:bg-gray-100 transition duration-200 ease-in-out">
                                    <td class="px-6 py-4 whitespace-nowrap border-r border-gray-200">
                                        {{ $option->satker_name }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium border-l border-gray-200">
                                        <a href="{{ route('pamenwas.riwayat', ['id' => $option->satker_id]) }}" class="text-blue-600 hover:text-blue-900">Lihat Riwayat</a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Daftar Tidak Hadir -->
                <div class="w-full lg:w-5/12 px-4 py-6">
                    <div class="bg-white rounded-lg shadow-md p-6 relative">
                        <h2 class="text-2xl font-semibold mb-6">Daftar Tidak Hadir Hari Ini</h2>
                        <a href="{{ route('pamenwas.riwayat.semua') }}" class="absolute top-6 right-6">
                            <button
                                class="inline-flex items-center justify-center whitespace-nowrap rounded-md text-sm font-medium transition-colors focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring disabled:pointer-events-none disabled:opacity-70 bg-blue-500 text-white shadow hover:bg-blue-400 h-10 px-7 py-2">Lihat
                                Riwayat</button>
                        </a>
                        <div class="overflow-x-auto">
                            <table class="min-w-full bg-white border">
                                <thead>
                                    <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                                        <th class="py-3 px-6 text-left">Satker</th>
                                        <th class="py-3 px-6 text-left">Nama</th>
                                        <th class="py-3 px-6 text-left">Keterangan</th>
                                    </tr>
                                </thead>
                                <tbody class="text-gray-600 text-sm font-light">
                                    @foreach ($absensi_leave as $item)
                                        <tr class="hover:bg-gray-100 transition duration-200 ease-in-out">
                                            <td class="py-3 px-6 border-b border-gray-200">{{ $item->satker_name }}</td>
                                            <td class="py-3 px-6 border-b border-gray-200">{{ $item->anggota_name }}</td>
                                            <td class="py-3 px-6 border-b border-gray-200">{{ $item->absen_note }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="mt-6">
                            {{ $absensi_leave->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">

    <script>
        $(document).ready(function() {
            var table = $('#satkerTable').DataTable({
                "language": {
                    "search": "Cari:"
                }
            });
        });
    </script>

    <!-- Ionicons -->
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>

    <!-- Toggle Dropdowns -->
    <script>
        function toggleDropdown(id) {
            const element = document.getElementById(id);
            if (element.classList.contains('hidden')) {
                element.classList.remove('hidden');
            } else {
                element.classList.add('hidden');
            }
        }
    </script>
</body>

</html>
