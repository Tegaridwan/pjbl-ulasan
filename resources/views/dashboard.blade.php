<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ulasan</title>
</head>
<body>
    <nav>
        <ul>
            <li><a href="{{ route('register') }}">Register</a></li>
            <li><a href="{{ route('login') }}">Login</a></li>
        </ul>
    </nav>
    <h2>Dashboard Pembeli</h2>

    <h3>Daftar Penjual</h3>

    <div style="display: flex; gap: 15px; flex-wrap: wrap;">
        @forelse($penjualList as $p)
            <div style="border: 1px solid #ccc; padding: 15px; border-radius: 8px; width: 220px;">
                <h4>{{ $p->Nama_Penjual }}</h4>
                <p>{{ $p->Deskripsi ?? 'Tidak ada deskripsi.' }}</p>
                
                <!-- Tombol Ulas mengarahkan ke form ulasan spesifik penjual -->
                <a href="{{ route('penjual.detail', $p->Id_Penjual) }}" 
                   style="display: inline-block; padding: 8px 12px; background-color: #0d6efd; color: white; text-decoration: none; border-radius: 4px;">
                   Detail
                </a>
            </div>
        @empty
            <p>Belum ada data penjual terdaftar.</p>
        @endforelse
    </div>
</body>
</html>