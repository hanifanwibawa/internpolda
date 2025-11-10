<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @media print {
            button {
                display: none;
            }

            body {
                font-family: Arial, sans-serif;
            }

            table {
                width: 100%;
                border-collapse: collapse;
            }

            th,
            td {
                border: 1px solid #000;
                padding: 8px;
            }

            th {
                background-color: #f2f2f2;
            }

            @page {
                size: auto;
                /* auto is the initial value */
                margin-left: 0.5in;
                margin-right: 0.5in;
                margin-top: 0.3in;
                margin-bottom: 0.3in;
            }

            body {
                margin: 1.6cm;
            }
        }
    </style>
</head>

<body>
    <div>
        <h1>Rekap Absensi</h1>

        <p>Periode: {{ date_format($startDate, 'd M Y') }} - {{ date_format($endDate, 'd M Y') }}</p>

        <table>
            <thead>
                <tr>
                    <th>Satker</th>
                    <th>Tanggal Absen</th>
                    <th>Total Absensi</th>
                    <th>Total Tidak Hadir</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($absensi as $data)
                    <tr>
                        <td class="text-left px-6 py-4">
                            {{ $data->satker_name }}
                        </td>
                        <td class="text-left px-6 py-4">
                            {{ \Carbon\Carbon::parse($data->absensi_date)->translatedFormat('j F Y \P\a\d\a\ \J\a\m\ H:i') }}
                        </td>
                        <td class="text-right px-6 py-4">
                            {{ $data->absensi_total - $data->absensi_leave }}
                        </td>
                        <td style="text-align: right">
                            {{ $data->absensi_leave }}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            window.print();
        });
    </script>
</body>
