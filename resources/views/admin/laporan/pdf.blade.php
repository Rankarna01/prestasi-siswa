<!DOCTYPE html>
<html>
<head>
    <title>Laporan Data Prestasi</title>
    <style>
        body { font-family: sans-serif; font-size: 12px; color: #333; }
        .header { text-align: center; margin-bottom: 20px; border-bottom: 2px solid #000; padding-bottom: 10px; }
        .header h2 { margin: 0; padding: 0; }
        .header p { margin: 5px 0 0 0; color: #666; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background-color: #f4f4f4; text-transform: uppercase; font-size: 10px; }
        .text-center { text-align: center; }
    </style>
</head>
<body>

    <div class="header">
        <h2>LAPORAN DATA PRESTASI SISWA</h2>
        <p>Dicetak pada: {{ date('d F Y H:i') }}</p>
    </div>

    <table>
        <thead>
            <tr>
                <th width="3%">No</th>
                <th width="15%">Nama Siswa</th>
                <th width="10%">Kelas</th>
                <th width="20%">Nama Lomba</th>
                <th width="12%">Kategori</th>
                <th width="12%">Tingkat</th>
                <th width="10%">Tanggal</th>
                <th width="10%">Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach($prestasis as $index => $item)
            <tr>
                <td class="text-center">{{ $index + 1 }}</td>
                <td>{{ $item->siswa->nama }}</td>
                <td class="text-center">{{ $item->siswa->kelas->nama_kelas ?? 'Alumni' }}</td>
                <td>{{ $item->nama_lomba }}</td>
                <td>{{ $item->kategori->nama_kategori }}</td>
                <td>{{ $item->tingkat->nama_tingkat }}</td>
                <td class="text-center">{{ $item->tanggal->format('d/m/Y') }}</td>
                <td class="text-center">{{ ucfirst($item->status) }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

</body>
</html>