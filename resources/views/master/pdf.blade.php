<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">

    <style>
        body {
            font-family: sans-serif;
            font-size: 12px;
            margin: 20px;
        }
        h2 {
            margin-bottom: 5px;
        }
        p {
            margin: 0 0 10px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }
        th, td {
            border: 1px solid #dcdcdc;
            padding: 6px;
            text-align: left;
        }
        th {
            background: #f3f3f3;
            font-weight: bold;
        }
    </style>
</head>
<body>

    <h2>Laporan Items</h2>
    <p>Tanggal Cetak: <b>{{ now()->format('d/m/Y H:i') }}</b></p>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Item</th>
                <th>Brand</th>
                <th>Kategori</th>
                <th>Toko</th>
                <th>Harga</th>
                <th>Ongkir</th>
                <th>Tanggal</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($items as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->nama }}</td>
                    <td>{{ $item->brand->name ?? '-' }}</td>
                    <td>{{ $item->kategori->nama ?? '-' }}</td>
                    <td>{{ $item->toko->nama ?? '-' }}</td>
                    <td>Rp {{ number_format($item->harga, 0, ',', '.') }}</td>
                    <td>Rp {{ number_format($item->ongkir, 0, ',', '.') }}</td>
                    <td>
                        {{ $item->tanggal ? \Carbon\Carbon::parse($item->tanggal)->format('d/m/Y') : '-' }}
                    </td>

                </tr>
            @endforeach
        </tbody>
    </table>

</body>
</html>
