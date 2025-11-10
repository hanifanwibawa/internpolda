<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Portal Absen - Danton</title>
    <link rel="icon" href="{{ asset('images/Logo.png') }}">

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body class="antialiased max-h-screen h-screen bg-gradient-to-br from-white via-white to-[#3870A5]">
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

    <aside class="h-screen fixed flex flex-col justify-center bg-[#041938] p-3 left-0 top-0">
        <div class="flex flex-col justify-center gap-2">
            <a href="{{ route('danton') }}">
                <button class="w-10 h-10 text-center bg-white p-2 rounded-lg">
                    <ion-icon name="timer" class="w-5 h-5"></ion-icon>
                </button>
            </a>
            <a href="{{ route('danton.riwayat') }}">
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
        <form action="{{ route('danton.store') }}" method="post">
            @csrf
            <input type="hidden" name="satker_id" value="{{ $anggotas[0]->satker_id }}">
            <h1 class="text-center text-3xl font-bold mt-10 mb-5">Data Danton <b>{{ $nama_satker }}</b></h1>

            <div class="w-full max-w-7xl bg-white rounded-xl border border-gray-200 shadow-lg p-8 my-10">
                <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                    <div class="p-7 bg-blue-50 rounded-lg shadow-lg transition-transform transform hover:-translate-y-1">
                        <h1 class="text-xl font-semibold text-center mb-5 border-b-2 border-gray-300 pb-2">Hari/Tanggal</h1>
                        <input name="absensi_date" type="datetime-local" id="absensi_date"
                            class="flex h-12 w-full rounded-md border border-gray-300 bg-white px-3 py-2 text-sm shadow-sm transition-colors focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                            required>
                    </div>
                    <div class="p-7 bg-blue-50 rounded-lg shadow-lg transition-transform transform hover:-translate-y-1 flex flex-col items-center">
                        <h1 class="uppercase text-xl font-semibold text-center mb-5 border-b-2 border-gray-300 pb-2">Total Anggota</h1>
                        <input value="{{ $anggotas->count() }}" name="absensi_total" readonly id="absensi_total" type="text"
                            class="flex h-12 w-full rounded-md border border-gray-300 bg-[#041938] text-white px-3 py-2 text-sm shadow-sm transition-colors focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-center">
                    </div>
                    <div class="p-7 bg-blue-50 rounded-lg shadow-lg transition-transform transform hover:-translate-y-1 flex flex-col items-center">
                        <h1 class="uppercase text-xl font-semibold text-center mb-5 border-b-2 border-gray-300 pb-2">Total Izin</h1>
                        <input value="0" name="absensi_leave" readonly id="absensi_leave" type="text"
                            class="flex h-12 w-full rounded-md border border-gray-300 bg-[#041938] text-white px-3 py-2 text-sm shadow-sm transition-colors focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-center">
                    </div>
                    <div class="p-7 bg-blue-50 rounded-lg shadow-lg transition-transform transform hover:-translate-y-1 flex flex-col items-center">
                        <h1 class="uppercase text-xl font-semibold text-center mb-5 border-b-2 border-gray-300 pb-2">Total Hadir</h1>
                        <input value="{{ $anggotas->count() }}" name="absensi_hadir" readonly id="absensi_hadir" type="text"
                            class="flex h-12 w-full rounded-md border border-gray-300 bg-[#041938] text-white px-3 py-2 text-sm shadow-sm transition-colors focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-center">
                    </div>
                </div>
            </div>

            <div class="w-full bg-white rounded-xl border shadow p-3 my-10">
                <div class="w-full flex justify-between items-center p-8">
                    <h1></h1>
                    <a href="#" class="flex items-center gap-1" onclick="openModal()">
                        <button type="button" class="w-7 h-7 p-1 text-white rounded-full bg-[#041938]">
                            <ion-icon name="add" class="text-xl"></ion-icon>
                        </button>
                        Input Anggota Tidak Hadir
                    </a>
                </div>

                <div class="relative overflow-x-auto border rounded-lg mb-14">
                    <table class="w-full text-sm text-left rtl:text-right text-gray-500">
                        <thead class="text-xs text-gray-200 uppercase bg-gray-800">
                            <tr>
                                <th scope="col" class="text-center px-6 py-3">Nama Anggota</th>
                                <th scope="col" class="text-center px-6 py-3">Status</th>
                                <th scope="col" class="text-center px-6 py-3">Keterangan</th>
                                <th scope="col" class="text-center px-6 py-3">Aksi</th>
                            </tr>
                        </thead>
                        <tbody id="listOfAnggota"></tbody>
                    </table>
                </div>
                <div class="flex justify-center mb-3">
                    <button type="button" onclick="showConfirmModal()"
                        class="inline-flex items-center justify-center whitespace-nowrap rounded-md text-sm font-medium transition-colors focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring disabled:pointer-events-none disabled:opacity-50 bg-[#041938] text-white shadow hover:bg-primary/90 h-9 px-4 py-2">
                        Kirim Data ke pamenwas
                    </button>
                </div>
            </div>

            <!-- Modal Konfirmasi -->
            <div id="confirmModal" class="fixed inset-0 hidden z-50 bg-blue-900 bg-opacity-75 flex justify-center items-center">
                <div class="bg-white rounded-lg shadow-lg p-8 w-150">
                    <h2 class="text-xl font-semibold mb-6 text-center">Konfirmasi Data</h2>
                    <div class="grid grid-cols-4 gap-4">
                        <div class="p-6 bg-blue-300 rounded-lg text-center">
                            <h3 class="font-semibold text-blue-900">Tanggal</h3>
                            <p id="confirmTanggal" class="text-blue-800"></p>
                        </div>
                        <div class="p-6 bg-green-300 rounded-lg text-center">
                            <h3 class="font-semibold text-green-900">Total Anggota</h3>
                            <p id="confirmTotalAnggota" class="text-green-800"></p>
                        </div>
                        <div class="p-6 bg-yellow-300 rounded-lg text-center">
                            <h3 class="font-semibold text-yellow-900">Total Hadir</h3>
                            <p id="confirmHadir" class="text-yellow-800"></p>
                        </div>
                        <div class="p-6 bg-red-300 rounded-lg text-center">
                            <h3 class="font-semibold text-red-900">Total Izin</h3>
                            <p id="confirmIzin" class="text-red-800"></p>
                        </div>
                    </div>
                    <div class="mt-8 flex justify-end">
                        <button type="button" onclick="closeConfirmModal()" class="bg-gray-500 text-white rounded px-4 py-2 mr-2">Batal</button>
                        <button type="submit" class="bg-blue-500 text-white rounded px-4 py-2">Konfirmasi</button>
                    </div>
                </div>
            </div>

        </form>

    </main>

    <!-- Modal -->
    <div id="anggotaModal" class="fixed inset-0 hidden z-50 bg-gray-800 bg-opacity-75 flex justify-center items-center">
        <div class="bg-white rounded-lg shadow-lg w-11/12 max-w-2xl p-6">
            <h2 class="text-xl font-semibold mb-4">Pilih Anggota Tidak Hadir</h2>
            <div class="overflow-y-auto max-h-80">
                <ul id="anggotaList" class="space-y-2">
                    <!-- List of anggota will be appended here dynamically -->
                </ul>
            </div>
            <div class="mt-4 flex justify-end">
                <button onclick="closeModal()" class="bg-gray-500 text-white rounded px-4 py-2 mr-2">Tutup</button>
                <button onclick="addSelectedAnggota()" class="bg-blue-500 text-white rounded px-4 py-2">Tambahkan</button>
            </div>
        </div>
    </div>



    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var inputTanggal = document.getElementById('absensi_date');
            var now = new Date();
            var year = now.getFullYear();
            var month = (now.getMonth() + 1).toString().padStart(2, '0');
            var day = now.getDate().toString().padStart(2, '0');
            var hours = now.getHours().toString().padStart(2, '0');
            var minutes = now.getMinutes().toString().padStart(2, '0');
            var formattedDateTime = `${year}-${month}-${day}T${hours}:${minutes}`;
            inputTanggal.value = formattedDateTime;

            const listOfAnggota = document.getElementById('listOfAnggota');
            listOfAnggota.addEventListener('click', function(event) {
                if (event.target.classList.contains('remove-btn')) {
                    const row = event.target.closest('tr');
                    row.remove();
                    updateAbsensiCount();
                }
            });
        });

        function openModal() {
            document.getElementById('anggotaModal').classList.remove('hidden');
            loadAnggotaList();
        }

        function closeModal() {
            document.getElementById('anggotaModal').classList.add('hidden');
        }

        function loadAnggotaList() {
            const anggotas = @json($anggotas); // Assumes $anggotas is a list of anggota data from your backend
            const anggotaList = document.getElementById('anggotaList');
            const listOfAnggota = document.getElementById('listOfAnggota');
            const existingAnggotaIds = [...listOfAnggota.querySelectorAll('tr')].map(tr => tr.querySelector('td:first-child').innerText);

            anggotaList.innerHTML = '';
            anggotas.forEach((anggota, index) => {
                if (!existingAnggotaIds.includes(anggota.anggota_name)) {
                    const li = document.createElement('li');
                    li.className = 'flex justify-between items-center bg-gray-100 p-2 rounded shadow-lg my-2';
                    li.innerHTML = `
                                    <span class="text-lg font-semibold">${anggota.anggota_name}</span>
                                    <input type="checkbox" id="anggota_${index}" value="${anggota.anggota_id}" class="form-checkbox h-5 w-5 text-blue-600" />
                                `;
                    anggotaList.appendChild(li);
                }
            });
        }

        function updateAbsensiCount() {
            const listOfAnggota = document.getElementById('listOfAnggota');
            const absensiLeave = document.getElementById('absensi_leave');
            const absensiHadir = document.getElementById('absensi_hadir');
            const absensiTotal = parseInt(document.getElementById('absensi_total').value);

            const totalIzin = listOfAnggota.querySelectorAll('tr').length;
            absensiLeave.value = totalIzin;
            absensiHadir.value = absensiTotal - totalIzin;
        }

        function addSelectedAnggota() {
            const checkboxes = document.querySelectorAll('#anggotaList input[type="checkbox"]:checked');
            const listOfAnggota = document.getElementById('listOfAnggota');
            checkboxes.forEach(checkbox => {
                const anggotaId = checkbox.value;
                const anggotaNama = checkbox.parentElement.querySelector('span').innerText;
                const tr = document.createElement('tr');
                tr.className = 'border-b border-gray-200 hover:bg-gray-100';
                tr.innerHTML = `
                    <input type="hidden" name="anggota_id[]" value="${anggotaId}" />
                    <td class="px-6 py-3 text-lg font-semibold">${anggotaNama}</td>
                    <td class="px-6 py-3">
                        <select name="absen_status[]" class="flex h-10 w-full rounded-md border border-gray-300 bg-white px-3 py-2 text-sm shadow-sm transition-colors focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                            <option>Izin</option>
                            <option>Sakit</option>
                            <option>Dinas</option>
                            <option>Tanpa Keterangan</option>
                        </select>
                    </td>
                    <td class="px-6 py-3">
                        <input type="text" name="absen_note[]" class="flex h-10 w-full rounded-md border border-gray-300 bg-white px-3 py-2 text-sm shadow-sm transition-colors focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500" />
                    </td>
                    <td class="text-center px-6 py-3">
                        <button type="button" class="remove-btn bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">Hapus</button>
                    </td>
                `;
                listOfAnggota.appendChild(tr);
            });
            closeModal();
            updateAbsensiCount();
        }

        function showConfirmModal() {
            const confirmTanggal = document.getElementById('confirmTanggal');
            const confirmTotalAnggota = document.getElementById('confirmTotalAnggota');
            const confirmHadir = document.getElementById('confirmHadir');
            const confirmIzin = document.getElementById('confirmIzin');

            const tanggal = document.getElementById('absensi_date').value;
            const totalAnggota = document.getElementById('absensi_total').value;
            const hadir = document.getElementById('absensi_hadir').value;
            const izin = document.getElementById('absensi_leave').value;

            confirmTanggal.textContent = tanggal;
            confirmTotalAnggota.textContent = totalAnggota;
            confirmHadir.textContent = hadir;
            confirmIzin.textContent = izin;

            document.getElementById('confirmModal').classList.remove('hidden');
        }

        function closeConfirmModal() {
            document.getElementById('confirmModal').classList.add('hidden');
        }
    </script>
</body>

</html>
