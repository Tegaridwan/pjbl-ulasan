<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Pembeli</title>
</head>
<body style="font-family: sans-serif; padding: 20px;">

    <nav style="margin-bottom: 20px;">
        <a href="{{ route('register') }}">Register Penjual</a> | 
        <a href="{{ route('login') }}">Login Penjual</a>
    </nav>

    <h2>Dashboard Pembeli</h2>
    <h3>Daftar Penjual</h3>

    <div style="display: flex; gap: 15px; flex-wrap: wrap;">
        @forelse($penjualList as $p)
            <div style="border: 1px solid #ccc; padding: 15px; border-radius: 8px; width: 240px; background-color: #f9f9f9;">
                <h4 style="margin-top: 0;">{{ $p->Nama_Penjual }}</h4>
                <p style="color: #555;">{{ $p->Deskripsi ?? 'Tidak ada deskripsi.' }}</p>
                <p style="font-size: 13px; color: #777;">📍 {{ $p->Alamat_Penjual }}</p>

                <div style="margin-top: 10px;">
                    <a href="{{ route('penjual.detail', $p->Id_Penjual) }}" 
                       style="display: inline-block; padding: 6px 10px; background-color: #6c757d; color: white; text-decoration: none; border-radius: 4px; font-size: 14px;">
                       Detail
                    </a>

                    <a href="{{ route('ulasan.create', $p->Id_Penjual) }}" 
                       style="display: inline-block; padding: 6px 10px; background-color: #0d6efd; color: white; text-decoration: none; border-radius: 4px; font-size: 14px; margin-left: 5px;">
                       Ulas
                    </a>
                </div>
            </div>
        @empty
            <p>Belum ada data penjual terdaftar.</p>
        @endforelse
    </div>

</body>
</html>