<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Portal Absen - Satker</title>
    <link rel="icon" href="{{ asset('images/Logo.png') }}">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body {
            font-family: 'Figtree', sans-serif;
        }
    </style>

    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.7/css/dataTables.dataTables.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/3.0.2/css/buttons.dataTables.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.tailwind.min.css">

    <!-- Ionicons -->
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>

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

    <aside class="fixed h-screen w-20 flex flex-col justify-between bg-gray-200 p-3 top-0 left-0 shadow-lg">
        <div class="flex flex-col justify-center gap-4">
            <a href="{{ route('superadmin') }}" class="group">
                <button class="w-10 h-10 flex items-center justify-center bg-gray-300 p-2 rounded-lg hover:bg-gray-400 transition-all duration-200">
                    <ion-icon name="timer" class="w-6 h-6 text-gray-700 group-hover:text-yellow-500 transition-all duration-200"></ion-icon>
                </button>
            </a>
            <a href="{{ route('superadmin.anggota') }}" class="group">
                <button class="w-10 h-10 flex items-center justify-center bg-gray-300 p-2 rounded-lg hover:bg-gray-400 transition-all duration-200">
                    <ion-icon name="people-outline" class="w-6 h-6 text-gray-700 group-hover:text-yellow-500 transition-all duration-200"></ion-icon>
                </button>
            </a>
            <a href="{{ route('superadmin.satker') }}" class="group">
                <button class="w-10 h-10 flex items-center justify-center bg-gray-300 p-2 rounded-lg hover:bg-gray-400 transition-all duration-200">
                    <ion-icon name="shield-checkmark-outline" class="w-6 h-6 text-gray-700 group-hover:text-yellow-500 transition-all duration-200"></ion-icon>
                </button>
            </a>
        </div>
        <div class="flex flex-col items-center gap-4">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="w-10 h-10 flex items-center justify-center bg-gray-300 p-2 rounded-lg hover:bg-gray-400 transition-all duration-200">
                    <ion-icon name="lock-closed-outline" class="w-6 h-6 text-gray-700 group-hover:text-red-500 transition-all duration-200"></ion-icon>
                </button>
            </form>
        </div>
    </aside>

    <main class="ml-20 p-8 transition-all duration-300">
        <section class="bg-white rounded-lg shadow-lg p-8 mt-8">
            <div class="flex justify-between items-center mb-4">
                <h1 class="text-xl font-bold">Database Satker</h1>
            </div>
            <div class="overflow-x-auto">
                <table id="satkerTable" class="display" style="width:100%">
                    <thead>
                        <tr class="bg-gray-100">
                            <th class="border border-gray-300 px-4 py-2">ID Satker</th>
                            <th class="border border-gray-300 px-4 py-2">Nama Satker</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($satkers as $item)
                            <tr>
                                <td class="border border-gray-300 px-4 py-2">{{ $item->satker_id }}</td>
                                <td class="border border-gray-300 px-4 py-2">{{ $item->satker_name }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </section>
    </main>
</body>


<footer>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/2.0.7/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/buttons/3.0.2/js/dataTables.buttons.js"></script>
    <script src="https://cdn.datatables.net/buttons/3.0.2/js/buttons.dataTables.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/3.0.2/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/3.0.2/js/buttons.print.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#satkerTable').DataTable({
                dom: "<'flex flex-wrap justify-between mb-4'<'flex justify-start space-x-2'B><'flex justify-end'f>>" +
                    "<'block'tr>" +
                    "<'flex flex-wrap justify-between mt-4'<'items-center'i><'justify-end'p>>",
                buttons: [
                    'excelHtml5',
                    'pdfHtml5',
                    'print'
                ]
            });
        });
    </script>
</footer>

</html>
