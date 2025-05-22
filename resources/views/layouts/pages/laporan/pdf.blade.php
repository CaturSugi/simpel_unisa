<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Laporan PDF</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
        }
        .header {
            text-align: center;
            margin-bottom: 10px;
        }
        .header h1, .header h2 {
            margin: 0;
            padding: 0;
        }
        .header h1 {
            font-size: 20px;
            text-transform: uppercase;
        }
        .header h2 {
            font-size: 16px;
            font-weight: normal;
            margin-top: 4px;
        }
        .header p {
            margin: 5px 0;
            font-size: 14px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }
        th, td {
            border: 1px solid black;
            padding: 6px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        .total-row {
            font-weight: bold;
            background-color: #e6e6e6;
        }
        .section-title {
            margin-top: 25px;
            font-weight: bold;
        }
    </style>
</head>
<body>

    <div class="header">
        <h1>Universitas 'Aisyiyah Yogyakarta</h1>
        <h2>Laporan Pengelolaan Sampah</h2>
        <p>
            Periode: 
            {{ request('start_date') ? \Carbon\Carbon::parse(request('start_date'))->format('d M Y') : 'Awal' }} 
            s.d. 
            {{ request('end_date') ? \Carbon\Carbon::parse(request('end_date'))->format('d M Y') : 'Akhir' }}
        </p>
    </div>

    {{-- TABEL UTAMA --}}
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Tanggal</th>
                <th>Kategori</th>
                <th>Gedung</th>
                <th>Berat (kg)</th>
            </tr>
        </thead>
        <tbody>
            @forelse($trashes as $index => $trash)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ \Carbon\Carbon::parse($trash->created_at)->format('d-m-Y') }}</td>
                <td>{{ $trash->category->name ?? '-' }}</td>
                <td>{{ $trash->building->name ?? '-' }}</td>
                <td>{{ number_format($trash->weight, 2, ',', '.') }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="5" style="text-align: center;">Tidak ada data tersedia.</td>
            </tr>
            @endforelse
        </tbody>
        <tfoot>
            <tr class="total-row">
                <td colspan="4" style="text-align:right;">Total Berat Sampah</td>
                <td>{{ number_format($trashes->sum('weight'), 2, ',', '.') }} kg</td>
            </tr>
        </tfoot>
    </table>

    {{-- TOTAL BERAT PER KATEGORI --}}
    <p class="section-title">Total Berat Sampah Berdasarkan Jenis Sampah:</p>
    <table>
        <thead>
            <tr>
                <th>Jenis Sampah</th>
                <th>Total Berat (kg)</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($categories as $category)
                @php
                    $totalByCategory = $trashes->where('category_id', $category->id)->sum('weight');
                @endphp
                <tr>
                    <td>{{ $category->name }}</td>
                    <td>{{ number_format($totalByCategory, 2, ',', '.') }} kg</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{-- TOTAL BERAT PER GEDUNG --}}
    <p class="section-title">Total Berat Sampah Berdasarkan Gedung:</p>
    <table>
        <thead>
            <tr>
                <th>Gedung</th>
                <th>Total Berat (kg)</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($buildings as $building)
                @php
                    $totalByBuilding = $trashes->where('building_id', $building->id)->sum('weight');
                @endphp
                <tr>
                    <td>{{ $building->name }}</td>
                    <td>{{ number_format($totalByBuilding, 2, ',', '.') }} kg</td>
                </tr>
            @endforeach
        </tbody>
    </table>

</body>
</html>
