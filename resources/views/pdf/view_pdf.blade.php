<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Ulasan - {{ $penjual->Nama_Penjual }}</title>
</head>
<body>
    <h1>Laporan Ulasan Pelanggan</h1>
    <p>
        <strong>{{ $penjual->Nama_Penjual }}</strong><br>
        {{ $penjual->Alamat_Penjual }}
    </p>
    <p>Dicetak pada {{ now()->format('d-m-Y H:i') }}</p>

    <table border="1" cellpadding="5" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>Nama Pembeli</th>
                <th>Rating</th>
                <th>Ulasan</th>
                <th>Balasan Penjual</th>
                <th>Tanggal</th>
            </tr>
        </thead>
        <tbody>
            @forelse($data as $ulasan)
                <tr>
                    <td>{{ $ulasan->Nama_Pembeli }}</td>
                    <td>{{ $ulasan->Rating }}/5</td>
                    <td>{{ $ulasan->Ulasan }}</td>
                    <td>{{ $ulasan->respon?->Respon ?? 'Belum dibalas' }}</td>
                    <td>{{ $ulasan->created_at?->format('d-m-Y H:i') ?? '-' }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="5">Belum ada ulasan untuk toko ini.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</body>
</html>
