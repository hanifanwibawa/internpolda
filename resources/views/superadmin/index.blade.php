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
        <div class="grid grid-cols-1 gap-8 mt-10">
            <div class="relative overflow-hidden w-full bg-gradient-to-br from-blue-600 to-blue-800 rounded-xl shadow-lg border p-5 hover:scale-105 transition-transform duration-300 col-span-1">
                <div class="flex flex-col lg:flex-row items-center justify-between">
                    <div class="mb-4 lg:mb-0">
                        <h1 class="text-white font-bold text-2xl">Selamat Datang</h1>
                        <h2 class="text-white" id="current-date"></h2>
                        <p class="text-white mt-2">Dashboard Polda Jateng memberikan akses cepat dan mudah untuk memonitor data anggota, satker, dan user. Selamat bekerja!</p>
                    </div>
                    <div>
                        <ion-icon name="people-outline" class="w-24 h-24 text-white opacity-50"></ion-icon>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <div class="relative overflow-hidden w-full bg-gradient-to-br from-pink-600 to-pink-800 rounded-xl shadow-lg border p-5 hover:scale-105 transition-transform duration-300">
                    <div class="flex items-center justify-between">
                        <div>
                            <h1 class="text-white font-bold text-xl">Jumlah Anggota</h1>
                            <h1 class="text-6xl text-white font-bold">{{ $countAnggota }}</h1>
                        </div>
                        <div>
                            <ion-icon name="shield-checkmark-outline" class="w-16 h-16 text-white opacity-50"></ion-icon>
                        </div>
                    </div>
                </div>
                <div class="relative overflow-hidden w-full bg-gradient-to-br from-green-600 to-green-800 rounded-xl shadow-lg border p-5 hover:scale-105 transition-transform duration-300">
                    <div class="flex items-center justify-between">
                        <div>
                            <h1 class="text-white font-bold text-xl">Jumlah Satker</h1>
                            <h1 class="text-6xl text-white font-bold">{{ $countSatker }}</h1>
                        </div>
                        <div>
                            <ion-icon name="shield-checkmark-outline" class="w-16 h-16 text-white opacity-50"></ion-icon>
                        </div>
                    </div>
                </div>
                <div class="relative overflow-hidden w-full bg-gradient-to-br from-yellow-600 to-yellow-800 rounded-xl shadow-lg border p-5 hover:scale-105 transition-transform duration-300">
                    <div class="flex items-center justify-between">
                        <div>
                            <h1 class="text-white font-bold text-xl">Jumlah User</h1>
                            <h1 class="text-6xl text-white font-bold">{{ $countUser }}</h1>
                        </div>
                        <div>
                            <ion-icon name="person-outline" class="w-16 h-16 text-white opacity-50"></ion-icon>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <section class="bg-white rounded-lg shadow-lg p-8 mt-8">
            <div class="flex justify-between items-center mb-4">
                <h1 class="text-xl font-bold">Manajemen User</h1>
                <button class="px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition duration-200" onclick="toggleModal('addUserModal')">+ Tambah User</button>
            </div>
            <div class="overflow-x-auto">
                <table id="userTable" class="display" style="width:100%">
                    <thead class="bg-gray-200">
                        <tr>
                            <th class="p-2 border">ID</th>
                            <th class="p-2 border">Nama</th>
                            <th class="p-2 border">Satker</th>
                            <th class="p-2 border">Role</th>
                            <th class="p-2 border">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            <tr>
                                <td class="p-2 border">{{ $user->user_id }}</td>
                                <td class="p-2 border">{{ $user->user_name }}</td>
                                <td class="p-2 border">{{ $user->satker_name }}</td>
                                <td class="p-2 border">{{ $user->user_role }}</td>
                                <td class="p-2 border">
                                    <button class="text-yellow-500 hover:text-yellow-600" onclick="toggleModal('changePasswordModal', {{ $user->user_id }})">Ubah Password</button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </section>
    </main>

    <!-- Modal Tambah User -->
    <div id="addUserModal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden">
        <div class="bg-white rounded-lg shadow-lg p-6 w-full max-w-md">
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-xl font-bold">Tambah User</h2>
                <button class="text-gray-400 hover:text-gray-600" onclick="toggleModal('addUserModal')">&times;</button>
            </div>
            <form action="{{ route('superadmin.user.store') }}" method="POST">
                @csrf
                <div class="mb-4">
                    <label for="user_name" class="block text-sm font-medium text-gray-700">Nama</label>
                    <input type="text" name="user_name" id="user_name" required
                        class="mt-1 block w-full px-3 py-2 border rounded-lg shadow-sm focus:ring focus:ring-opacity-50 focus:ring-blue-500 focus:border-blue-500">
                </div>
                <div class="mt-4">
                    <label for="satker_id" class="block text-sm font-medium text-gray-700">Satker</label>
                    <select name="satker_id" id="satker_id" required class="mt-1 p-2 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                        <option value="" disabled selected>Select Satker</option>
                        @foreach ($satkers as $item)
                            <option value="{{ $item->satker_id }}">{{ $item->satker_name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-4">
                    <label for="user_role" class="block text-sm font-medium text-gray-700">Role</label>
                    <select name="user_role" id="user_role" required class="mt-1 p-2 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                        <option value="" disabled selected>Select Role</option>
                        <option value="ADMIN_SATKER">ADMIN SATKER</option>
                        <option value="DANTON">DANTON</option>
                        <option value="PAMENWAS">PAMENWAS</option>
                        <option value="SUPER_ADMIN">SUPER ADMIN</option>
                    </select>
                </div>
                <div class="mb-4">
                    <label for="user_password" class="block text-sm font-medium text-gray-700">Password</label>
                    <input type="password" name="user_password" id="user_password" required
                        class="mt-1 block w-full px-3 py-2 border rounded-lg shadow-sm focus:ring focus:ring-opacity-50 focus:ring-blue-500 focus:border-blue-500">
                </div>
                <div class="flex justify-end">
                    <button type="button" class="px-4 py-2 bg-gray-200 rounded-lg hover:bg-gray-300 transition duration-200 mr-2" onclick="toggleModal('addUserModal')">Batal</button>
                    <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition duration-200">Simpan</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal Ubah Password -->
    <div id="changePasswordModal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden">
        <div class="bg-white rounded-lg shadow-lg p-6 w-full max-w-md">
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-xl font-bold">Ubah Password</h2>
                <button class="text-gray-400 hover:text-gray-600" onclick="toggleModal('changePasswordModal')">&times;</button>
            </div>
            <form action="{{ route('superadmin.user.update') }}" method="POST">
                @csrf
                <input type="hidden" name="user_id" id="change-password-user-id">
                <div class="mb-4">
                    <label for="user_password" class="block text-sm font-medium text-gray-700">Password Baru</label>
                    <input type="password" name="user_password" id="user_password" required
                        class="mt-1 block w-full px-3 py-2 border rounded-lg shadow-sm focus:ring focus:ring-opacity-50 focus:ring-blue-500 focus:border-blue-500">
                </div>
                <div class="flex justify-end">
                    <button type="button" class="px-4 py-2 bg-gray-200 rounded-lg hover:bg-gray-300 transition duration-200 mr-2" onclick="toggleModal('changePasswordModal')">Batal</button>
                    <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition duration-200">Simpan</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Custom Script -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {

            const currentDateElement = document.getElementById('current-date');
            const currentDate = new Date().toLocaleDateString('id-ID', {
                weekday: 'long',
                year: 'numeric',
                month: 'long',
                day: 'numeric'
            });
            currentDateElement.textContent = currentDate;
        });

        function toggleModal(modalId, userId = null) {
            const modal = document.getElementById(modalId);
            if (userId !== null) {
                document.getElementById('change-password-user-id').value = userId;
            }
            modal.classList.toggle('hidden');
        }
    </script>
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
            $('#userTable').DataTable({
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
