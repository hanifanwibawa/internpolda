<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Portal Absen - Riwayat</title>
    <link rel="icon" href="{{ asset('images/Logo.png') }}">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="antialiased bg-gradient-to-br from-white via-white to-[#3870A5]">
    <aside class="h-svh fixed flex flex-col justify-center bg-[#041938] p-3 left-0 top-0">
        <div class="flex flex-col justify-center gap-2">
            <a href="{{ route('pamenwas') }}">
                <button class="w-10 h-10 text-center bg-white p-2 rounded-lg">
                    <ion-icon name="timer" class="w-5 h-5"></ion-icon>
                </button>
            </a>
            <a href="{{ route('pamenwas.rekap') }}">
                <button class="w-10 h-10 text-center bg-white p-2 rounded-lg">
                    <ion-icon name="document-outline" class="w-5 h-5"></ion-icon>
                </button>
            </a>
        </div>
        <div class="mt-auto flex justify-center gap-2">
            <a href="/">
                <button class="w-10 h-10 text-center bg-white p-2 rounded-lg">
                    <ion-icon name="lock-closed-outline" class="w-5 h-5"></ion-icon>
                </button>
            </a>
        </div>
    </aside>

    <main class="pl-32 grid grid-cols-3 gap-10">
        <div class="col-span-2">
            <h1 class="text-2xl font-bold mt-10">🕓 Riwayat Kehadiran {{ $nama_satker }}</h1>
            <div class="w-full bg-[#F5F9FF] rounded-xl border shadow p-10 my-5">
                <h1 class="text-2xl font-bold">Daftar Riwayat</h1>
                <div class="flex justify-between mb-5   ">
                    <h3></h3>
                    <form action="" method="get" class="flex justify-between items-center gap-2.5">
                        @csrf
                        <input type="date"
                            value="{{ $startDate ? date_format($startDate, 'Y-m-d') : '' }}"
                            name="start_date"
                            required
                            class="flex h-9 w-full rounded-md border bg-transparent px-3 py-1 text-sm shadow-sm transition-colors file:border-0 file:bg-transparent file:text-sm file:font-medium placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring disabled:cursor-not-allowed disabled:opacity-50">
                        -
                        <input type="date"
                            name="end_date"
                            required
                            value="{{ $endDate ? date_format($endDate, 'Y-m-d') : Date('Y-m-d') }}"
                            max="{{ Date('Y-m-d') }}"
                            class="flex h-9 w-full rounded-md border bg-transparent px-3 py-1 text-sm shadow-sm transition-colors file:border-0 file:bg-transparent file:text-sm file:font-medium placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring disabled:cursor-not-allowed disabled:opacity-50">
                        <button
                            type="submit"
                            class="inline-flex items-center justify-center whitespace-nowrap rounded-md text-sm font-medium transition-colors focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring disabled:pointer-events-none disabled:opacity-50 bg-[#041938] text-white shadow hover:bg-primary/90 h-9 px-4 py-2">Pilih</button>
                    </form>
                </div>

                <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                    <table class="w-full text-sm text-left rtl:text-right text-gray-500">
                        <thead class="text-xs text-gray-700 uppercase bg-stone-200">
                            <tr>
                                <th scope="col" class="px-6 py-3">
                                    Tanggal
                                </th>
                                <th scope="col" class="px-6 py-3 text-right">
                                    Jumlah Anggota Yang Mengikuti Apel
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($absensi as $data)
                                <tr class="bg-stone-100 border-b" onclick="showDetail({{$data->absensi_id}})">
                                    <td class="text-left px-6 py-4">
                                        {{ \Carbon\Carbon::parse($data->absensi_date)->translatedFormat('j F Y \P\a\d\a\ \J\a\m\ H:i') }}
                                    </td>
                                    <td class="text-right px-6 py-4">
                                        {{ $data->absensi_total - $data->absensi_leave }}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="bg-white border h-svh px-5">
            <div class="hidden" id="detail-riwayat">
                <div class="mb-2">
                    <h1 class="text-3xl text-center font-bold mt-10">Detail Riwayat Tidak Hadir</h1>
                    <h6 class="text-right text-sm px-2">Total: <span id="total">0</span></h6>
                </div>
                <div class="relative overflow-x-auto sm:rounded-lg border mb-7">
                    <table class="w-full text-sm text-left rtl:text-right text-gray-500">
                        <tbody id="listOfTidakHadir">
                        </tbody>
                    </table>
                </div>
                <div class="flex justify-end">
                    <button
                        type="button"
                        onclick="closeDetail()"
                        class="inline-flex items-center justify-center whitespace-nowrap rounded-md text-sm font-medium transition-colors focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring disabled:pointer-events-none disabled:opacity-50 bg-white shadow hover:bg-primary/90 h-9 px-4 py-2">Kembali</button>
                </div>
            </div>
        </div>
    </main>

    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script>
        function closeDetail() {
            $('#detail-riwayat').removeClass('hidden').addClass('hidden');
        }
        function showDetail(id) {
            $('#detail-riwayat').removeClass('hidden');
            $('#listOfTidakHadir').empty();
            $.ajax({
                url: '/pamenwas/riwayat_detail',
                method: 'GET',
                data: { absensi_id: id },
                success: function(response) {
                    $('#total').text(response.riwayat.length)
                    response.riwayat.forEach(function(data) {
                        $('#listOfTidakHadir').append(`
                        <tr class="bg-stone-100 border-b">
                            <td class="text-left px-6 py-4 capitalize">
                                ${data.anggota_name}
                            </td>
                            <td class="text-right px-6 py-4 capitalize">
                                ${data.absen_status } - ${data.absen_note}
                            </td>
                        </tr>
                        `);
                    });
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });
        }

    </script>
</body>

</html>
