<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Portal Absen - Anggota</title>
    <link rel="icon" href="{{ asset('images/Logo.png') }}">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

    <script src="https://cdn.tailwindcss.com"></script>

    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Datatable -->
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.7/css/dataTables.dataTables.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/3.0.2/css/buttons.dataTables.css">


</head>

<body class="antialiased max-h-screen h-screen overflow-hidden bg-gradient-to-br from-white via-white to-[#3870A5]">
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
                    <ion-icon name="timer-outline" class="w-5 h-5"></ion-icon>
                </button>
            </a>
            <a href="{{ route('satker.anggota') }}">
                <button class="w-10 h-10 text-center bg-white p-2 rounded-lg">
                    <ion-icon name="people" class="w-5 h-5"></ion-icon>
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

    <main class="pl-32 grid grid-cols-3 gap-10">
        <div class="col-span-2">

            <h1 class="text-2xl font-bold mt-10">💂‍♀️️ Halaman Anggota</h1>
            <div class="w-full bg-[#F5F9FF] rounded-xl border shadow p-10 my-5">
                <h1 class="text-2xl font-bold">Daftar Anggota <b>{{ $nama_satker }}</b></h1>
                <div class="flex justify-between mb-5   ">
                    <h3>Menampilkan {{ count($anggotas) }} data</h3>
                    <div class="flex justify-between items-center gap-2.5">
                        <button onclick="showPindah()"
                            class="inline-flex items-center justify-center whitespace-nowrap rounded-md text-xl font-medium transition-colors focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring disabled:pointer-events-none disabled:opacity-50 bg-white shadow hover:bg-primary/90 h-9 px-2">
                            <ion-icon name="swap-horizontal-outline"></ion-icon>
                        </button>
                        <button onclick="showTambah()"
                            class="inline-flex items-center justify-center whitespace-nowrap rounded-md text-xl font-medium transition-colors focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring disabled:pointer-events-none disabled:opacity-50 bg-white shadow hover:bg-primary/90 h-9 px-2">
                            <ion-icon name="add-outline"></ion-icon>
                        </button>
                    </div>
                </div>

                {{-- Table Anggota --}}
                <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                    <table id="anggotaTable" class="display" style="width:100%">
                        <thead class="text-xs text-gray-700 uppercase bg-stone-200">
                            <tr>
                                <th scope="col" class="p-4"></th>
                                <th scope="col" class="px-6 py-3">Nama Anggota</th>
                                <th scope="col" class="px-6 py-3 text-center">Pangkat</th>
                                <th scope="col" class="px-6 py-3 text-center">NRP</th>
                                <th scope="col" class="px-6 py-3 text-center">Bidang</th>
                                <th scope="col" class="px-6 py-3 text-center">Jenis Kelamin</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($anggotas as $data)
                                <tr class="bg-white border-b hover:bg-gray-100" onclick="showDetail({{ json_encode($data) }})">
                                    <td class="p-4">
                                        <div class="flex items-center">
                                            <button type="button" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500"
                                                onclick="showDetail({{ json_encode($data) }})">
                                                <ion-icon name="information-circle-outline"></ion-icon>
                                            </button>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="text-sm font-medium text-gray-900">
                                            {{ $data->anggota_name }}
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 text-center">
                                        <div class="text-sm text-gray-900">
                                            {{ $data->anggota_pangkat }}
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 text-center">
                                        <div class="text-sm text-gray-900">
                                            {{ $data->anggota_nrp }}
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 text-center">
                                        <div class="text-sm text-gray-900">
                                            {{ $data->anggota_bidang }}
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 text-center">
                                        <div class="text-sm text-gray-900">
                                            {{ $data->anggota_jenis_kelamin }}
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="bg-white border h-svh px-5">

            {{-- Tambah Satker --}}
            <form method="POST" action="{{ route('satker.anggota.store') }}" id="tambah-anggota" class="hidden">
                @csrf
                <input type="hidden" name="satker_id" value="{{ $anggotas[0]->satker_id }}">
                <div class="mb-6">
                    <h1 class="text-3xl font-bold mt-10">✍️ Tambah Anggota</h1>
                </div>
                <div class="space-y-4">
                    <div>
                        <label for="anggota_name" class="block text-sm font-medium text-gray-700">Nama Anggota</label>
                        <input type="text" name="anggota_name" id="anggota_name"
                            class="mt-1 block w-full rounded-md border border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50 pl-3 h-10">
                    </div>
                    <div>
                        <label for="anggota_pangkat" class="block text-sm font-medium text-gray-700">Pangkat</label>
                        <input type="text" name="anggota_pangkat" id="anggota_pangkat"
                            class="mt-1 block w-full rounded-md border border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50 pl-3 h-10">
                    </div>
                    <div>
                        <label for="anggota_nrp" class="block text-sm font-medium text-gray-700">NRP</label>
                        <input type="text" name="anggota_nrp" id="anggota_nrp"
                            class="mt-1 block w-full rounded-md border border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50 pl-3 h-10">
                    </div>
                    <div>
                        <label for="anggota_bidang" class="block text-sm font-medium text-gray-700">Bidang</label>
                        <input type="text" name="anggota_bidang" id="anggota_bidang"
                            class="mt-1 block w-full rounded-md border border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50 pl-3 h-10">
                    </div>
                    <div>
                        <label for="anggota_contact" class="block text-sm font-medium text-gray-700">No. Telepon</label>
                        <input type="text" name="anggota_contact" id="anggota_contact"
                            class="mt-1 block w-full rounded-md border border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50 pl-3 h-10">
                    </div>
                    <div>
                        <label for="anggota_jenis_kelamin" class="block text-sm font-medium text-gray-700">Jenis Kelamin</label>
                        <select name="anggota_jenis_kelamin" id="anggota_jenis_kelamin"
                            class="mt-1 block w-full rounded-md border border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50 pl-3 h-10">
                            <option value="Laki-laki">Laki-laki</option>
                            <option value="Perempuan">Perempuan</option>
                        </select>
                    </div>
                    <div>
                        <label for="anggota_address" class="block text-sm font-medium text-gray-700">Alamat</label>
                        <textarea name="anggota_address" id="anggota_address" cols="30" rows="3"
                            class="mt-1 block w-full rounded-md border border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50 pl-3"></textarea>
                    </div>
                </div>
                <div class="flex justify-end gap-4 mt-6">
                    <button type="button"
                        class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        Batalkan
                    </button>
                    <button type="submit"
                        class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md shadow-sm text-sm font-medium text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        Simpan
                    </button>
                </div>
            </form>

            {{-- Edit Satker --}}
            <form method="post" action="{{ route('satker.anggota.update') }}" id="edit-anggota" class="hidden">
                @csrf
                <input type="hidden" name="anggota_id" id="anggota_id">
                <div class="mb-5">
                    <h1 class="text-3xl font-bold mt-10">✍️ Edit Anggota</h1>
                </div>
                <div class="space-y-4">
                    <div>
                        <label for="anggota_name" class="block text-sm font-medium text-gray-700">Nama Anggota</label>
                        <input type="text" name="anggota_name" id="anggota_name"
                            class="mt-1 block w-full rounded-md border border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50 pl-3 h-10">
                    </div>
                    <div>
                        <label for="anggota_pangkat" class="block text-sm font-medium text-gray-700">Pangkat</label>
                        <input type="text" name="anggota_pangkat" id="anggota_pangkat"
                            class="mt-1 block w-full rounded-md border border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50 pl-3 h-10">
                    </div>
                    <div>
                        <label for="anggota_nrp" class="block text-sm font-medium text-gray-700">NRP</label>
                        <input type="text" name="anggota_nrp" id="anggota_nrp"
                            class="mt-1 block w-full rounded-md border border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50 pl-3 h-10">
                    </div>
                    <div>
                        <label for="anggota_bidang" class="block text-sm font-medium text-gray-700">Bidang</label>
                        <input type="text" name="anggota_bidang" id="anggota_bidang"
                            class="mt-1 block w-full rounded-md border border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50 pl-3 h-10">
                    </div>
                    <div>
                        <label for="anggota_contact" class="block text-sm font-medium text-gray-700">No. Telepon</label>
                        <input type="text" name="anggota_contact" id="anggota_contact"
                            class="mt-1 block w-full rounded-md border border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50 pl-3 h-10">
                    </div>
                    <div>
                        <label for="anggota_jenis_kelamin" class="block text-sm font-medium text-gray-700">Jenis Kelamin</label>
                        <select name="anggota_jenis_kelamin" id="anggota_jenis_kelamin"
                            class="mt-1 block w-full rounded-md border border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50 pl-3 h-10">
                            <option value="Laki-laki">Laki-laki</option>
                            <option value="Perempuan">Perempuan</option>
                        </select>
                    </div>
                    <div>
                        <label for="anggota_address" class="block text-sm font-medium text-gray-700">Alamat</label>
                        <textarea name="anggota_address" id="anggota_address" cols="30" rows="3"
                            class="mt-1 block w-full rounded-md border border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50 pl-3"></textarea>
                    </div>
                </div>
                <div class="flex justify-end gap-2 mt-5">
                    <button
                        class="inline-flex items-center justify-center whitespace-nowrap rounded-md text-sm font-medium transition-colors focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring disabled:pointer-events-none disabled:opacity-50 bg-zinc-900 text-white shadow hover:bg-zinc-900/90 h-9 px-4 py-2">Perbarui</button>
                </div>
            </form>

            {{-- Detail Anggota --}}
            <div id="detail-anggota" class="hidden">
                <div class="mb-5">
                    <h1 class="text-3xl font-bold mt-10">📄 Detail Anggota</h1>
                </div>
                <div class="space-y-4">
                    <div>
                        <label for="anggota_name" class="block text-sm font-medium text-gray-700">Nama Anggota</label>
                        <input type="text" name="anggota_name" id="anggota_name"
                            class="mt-1 block w-full rounded-md border border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50 pl-3 h-10" readonly>
                    </div>
                    <div>
                        <label for="anggota_pangkat" class="block text-sm font-medium text-gray-700">Pangkat</label>
                        <input type="text" name="anggota_pangkat" id="anggota_pangkat"
                            class="mt-1 block w-full rounded-md border border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50 pl-3 h-10" readonly>
                    </div>
                    <div>
                        <label for="anggota_nrp" class="block text-sm font-medium text-gray-700">NRP</label>
                        <input type="text" name="anggota_nrp" id="anggota_nrp"
                            class="mt-1 block w-full rounded-md border border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50 pl-3 h-10" readonly>
                    </div>
                    <div>
                        <label for="anggota_bidang" class="block text-sm font-medium text-gray-700">Bidang</label>
                        <input type="text" name="anggota_bidang" id="anggota_bidang"
                            class="mt-1 block w-full rounded-md border border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50 pl-3 h-10" readonly>
                    </div>
                    <div>
                        <label for="anggota_contact" class="block text-sm font-medium text-gray-700">No. Telepon</label>
                        <input type="text" name="anggota_contact" id="anggota_contact"
                            class="mt-1 block w-full rounded-md border border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50 pl-3 h-10" readonly>
                    </div>
                    <div>
                        <label for="anggota_jenis_kelamin" class="block text-sm font-medium text-gray-700">No. Telepon</label>
                        <input type="text" name="anggota_jenis_kelamin" id="anggota_jenis_kelamin"
                            class="mt-1 block w-full rounded-md border border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50 pl-3 h-10" readonly>
                    </div>
                    <div>
                        <label for="anggota_address" class="block text-sm font-medium text-gray-700">Alamat</label>
                        <textarea name="anggota_address" id="anggota_address" cols="30" rows="3"
                            class="mt-1 block w-full rounded-md border border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50 pl-3" readonly></textarea>
                    </div>
                </div>
                <div class="flex justify-end gap-2 mt-5">
                    <button onclick="showEdit()"
                        class="inline-flex items-center justify-center whitespace-nowrap rounded-md text-sm font-medium transition-colors focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring disabled:pointer-events-none disabled:opacity-50 bg-white shadow hover:bg-primary/90 h-9 px-4 py-2">Edit</button>
                </div>
            </div>

            {{-- Pindah --}}
            <form method="POST" action="{{ route('satker.anggota.pindah') }}" id="pindah-anggota" class="hidden">
                @csrf
                <div class="mb-5">
                    <h1 class="text-3xl font-bold mt-10">🎒 Pindah Anggota</h1>
                </div>
                <div class="space-y-5">
                    <div class="flex justify-between items-center">
                        <h1 class="text-lg font-semibold">List Anggota Yang Dipilih</h1>
                        <button onclick="showPindahModal()" type="button" class="flex items-center justify-center w-10 h-10 bg-white rounded-full border border-neutral-600">
                            <ion-icon name="add-outline" class="text-neutral-600"></ion-icon>
                        </button>
                    </div>
                    <div class="overflow-auto max-h-60">
                        <table class="w-full text-sm text-left border border-gray-200">
                            <tbody id="listOfPindah">
                                <!-- Data anggota yang dipilih akan ditampilkan di sini -->
                            </tbody>
                        </table>
                    </div>
                    <div>
                        <label for="tujuan" class="block">Tujuan Pindah</label>
                        <select name="satker_id" id="edit-tujuan"
                            class="w-full h-9 rounded-lg border border-gray-200 bg-transparent px-3 py-1 text-sm shadow-sm focus:outline-none focus:ring focus:ring-blue-400">
                            @foreach ($satkers as $satker)
                                <option value="{{ $satker->satker_id }}">{{ $satker->satker_name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="flex justify-end mt-5 space-x-4">
                    <button type="submit"
                        class="inline-flex items-center justify-center w-32 h-9 rounded-md text-sm font-medium text-white bg-blue-500 hover:bg-blue-600 focus:outline-none focus:ring focus:ring-blue-400">Pindah</button>
                </div>
            </form>

        </div>
    </main>

    {{-- Modal --}}
    <div id="pindah-modal" class="hidden fixed top-0 left-0 w-screen h-screen inset-0 flex justify-center items-center bg-black/70 z-40">
        <div class="max-w-2xl max-h-[88svh] overflow-hidden p-5 bg-white border rounded-xl">
            <div class="overflow-auto h-[65svh] mb-5">
                <table class="w-full text-sm text-left rtl:text-right text-gray-500">
                    <thead class="text-xs text-gray-700 uppercase bg-stone-200">
                        <tr>
                            <th scope="col" class="p-4">
                                <div class="flex items-center">
                                    <input id="checkbox-all-search" type="checkbox"
                                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                    <label for="checkbox-all-search" class="sr-only">checkbox</label>
                                </div>
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Nama Anggota
                            </th>
                            <th scope="col" class="px-6 py-3">
                                No.Telepon
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Alamat
                            </th>
                            <th scope="col" class="px-6 py-3">
                                L/P
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($anggotas as $data)
                            <tr class="bg-white border-b">
                                <td class="w-4 p-4">
                                    <div class="flex items-center">
                                        <input onclick="addToPindah({{ json_encode($data) }})" id="checkbox-table-search-1" type="checkbox"
                                            class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                        <label for="checkbox-table-search-1" class="sr-only">checkbox</label>
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    {{ $data->anggota_name }}
                                </td>
                                <td class="text-center px-6 py-4">
                                    {{ $data->anggota_contact }}
                                </td>
                                <td class="text-center py-4">
                                    <p class="line-clamp-1">
                                        {{ $data->anggota_address }}
                                    </p>
                                </td>
                                <td class="text-center px-6 py-4">
                                    {{ $data->anggota_jenis_kelamin }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="flex justify-between items-center">
                <h1>Pilih satker yang mau dihapus</h1>
                <button onclick="showPindah()" type="button"
                    class="inline-flex items-center justify-center whitespace-nowrap rounded-md text-sm font-medium transition-colors focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring disabled:pointer-events-none disabled:opacity-50 bg-zinc-900 text-white shadow hover:bg-zinc-900/90 h-9 px-4 py-2">Pilih</button>
            </div>
        </div>
    </div>

    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script>
        const LIST_OF_PINDAH = Array();

        function showTambah() {
            $('#tambah-anggota').removeClass('hidden')
            $('#edit-anggota').removeClass('hidden').addClass('hidden');
            $('#detail-anggota').removeClass('hidden').addClass('hidden');
            $('#pindah-anggota').removeClass('hidden').addClass('hidden');
        }

        function showPindah() {
            $('#tambah-anggota').removeClass('hidden').addClass('hidden');
            $('#edit-anggota').removeClass('hidden').addClass('hidden');
            $('#detail-anggota').removeClass('hidden').addClass('hidden');
            $('#pindah-modal').removeClass('hidden').addClass('hidden');
            $('#pindah-anggota').removeClass('hidden')
        }

        function showDetail(data) {
            $('#tambah-anggota').removeClass('hidden').addClass('hidden');
            $('#edit-anggota').removeClass('hidden').addClass('hidden');
            $('#pindah-anggota').removeClass('hidden').addClass('hidden');
            $('#detail-anggota').removeClass('hidden');

            // Mendapatkan elemen formulir detail
            var detailForm = document.getElementById('detail-anggota');
            // Mengisi formulir detail dengan informasi anggota
            detailForm.querySelector('#anggota_name').value = data.anggota_name;
            detailForm.querySelector('#anggota_pangkat').value = data.anggota_pangkat;
            detailForm.querySelector('#anggota_nrp').value = data.anggota_nrp;
            detailForm.querySelector('#anggota_bidang').value = data.anggota_bidang;
            detailForm.querySelector('#anggota_contact').value = data.anggota_contact;
            detailForm.querySelector('#anggota_address').value = data.anggota_address;
            detailForm.querySelector('#anggota_jenis_kelamin').value = data.anggota_jenis_kelamin;
            // Menampilkan formulir detail
            detailForm.classList.remove('hidden');

            // Mendapatkan elemen formulir detail
            var editanggota = document.getElementById('edit-anggota');
            // Mengisi formulir detail dengan informasi anggota
            editanggota.querySelector('#anggota_id').value = data.anggota_id;
            editanggota.querySelector('#anggota_name').value = data.anggota_name;
            editanggota.querySelector('#anggota_pangkat').value = data.anggota_pangkat;
            editanggota.querySelector('#anggota_nrp').value = data.anggota_nrp;
            editanggota.querySelector('#anggota_bidang').value = data.anggota_bidang;
            editanggota.querySelector('#anggota_contact').value = data.anggota_contact;
            editanggota.querySelector('#anggota_address').value = data.anggota_address;
            editanggota.querySelector('#anggota_jenis_kelamin').value = data.anggota_jenis_kelamin;


        }

        function showEdit(data) {
            $('#tambah-anggota').removeClass('hidden').addClass('hidden');
            $('#detail-anggota').removeClass('hidden').addClass('hidden');
            $('#pindah-anggota').removeClass('hidden').addClass('hidden');
            $('#edit-anggota').removeClass('hidden');
        }

        function showPindahModal() {
            $('#tambah-anggota').removeClass('hidden').addClass('hidden');
            $('#detail-anggota').removeClass('hidden').addClass('hidden');
            $('#edit-anggota').removeClass('hidden').addClass('hidden');
            $('#pindah-anggota').removeClass('hidden');
            $('#pindah-modal').removeClass('hidden');
        }

        function addToPindah(data) {
            var index = -1;
            for (var i = 0; i < LIST_OF_PINDAH.length; i++) {
                if (isEqual(LIST_OF_PINDAH[i], data)) {
                    index = i;
                    break;
                }
            }

            if (index !== -1) {
                LIST_OF_PINDAH.splice(index, 1);
            } else {
                LIST_OF_PINDAH.push(data);
            }

            printPindah();
        }

        function isEqual(obj1, obj2) {
            return JSON.stringify(obj1) === JSON.stringify(obj2);
        }

        function printPindah() {
            $('#listOfPindah').empty();
            for (let i = 0; i < LIST_OF_PINDAH.length; i++) {
                const element = LIST_OF_PINDAH[i];
                $('#listOfPindah').append(`
                <tr class="${i % 2 == 0 ? "bg-stone-100" : "bg-white"} border-b">
                    <td class="text-left px-6 py-4">
                        <input type="hidden" name="anggota_id[]" value="${element.anggota_id}">
                        ${element.anggota_name}
                    </td>
                    <td class="text-right px-6 py-4">
                        ${element.anggota_contact}
                    </td>
                </tr>
                `)
            }
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
            $('#anggotaTable').DataTable({
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
