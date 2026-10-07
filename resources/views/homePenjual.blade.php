<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Penjual</title>
</head>
<body style="font-family: sans-serif; padding: 20px;">

    <!-- NAVBAR PENJUAL -->
    <nav style="background-color: #333; padding: 10px 20px; border-radius: 6px; margin-bottom: 20px; display: flex; align-items: center; justify-content: space-between;">
        <div style="display: flex; gap: 15px;">
            <a href="{{ route('homePenjual') }}" style="color: white; text-decoration: none; font-weight: bold;">Dashboard</a>
            <a href="{{ route('penjual.edit') }}" style="color: white; text-decoration: none;">Profil & Edit Toko</a>
            <a href="{{ route('penjual.ulasan') }}" style="color: white; text-decoration: none;">Lihat Ulasan</a>
        </div>
        
        <form action="{{ route('auth.logout') }}" method="POST" style="margin: 0;">
            @csrf
            <button type="submit" style="background-color: #dc3545; color: white; border: none; padding: 6px 12px; border-radius: 4px; cursor: pointer;">Logout</button>
        </form>
    </nav>

    <h2>Selamat Datang di Home Penjual</h2>

    @if(session('success'))
        <div style="color: green; margin-bottom: 15px; font-weight: bold;">
            {{ session('success') }}
        </div>
    @endif

    @if($penjual)
        <div style="border: 1px solid #ddd; padding: 20px; border-radius: 8px; max-width: 500px; background-color: #f9f9f9;">
            <h3 style="margin-top: 0;">Informasi Toko Anda</h3>
            <p><strong>Nama Toko:</strong> {{ $penjual->Nama_Penjual }}</p>
            <p><strong>Deskripsi:</strong> {{ $penjual->Deskripsi ?? '-' }}</p>
            <p><strong>Alamat:</strong> {{ $penjual->Alamat_Penjual }}</p>
            <p><strong>No Telepon:</strong> {{ $penjual->No_Telp_Penjual }}</p>
            
            <a href="{{ route('penjual.edit') }}" style="display: inline-block; padding: 8px 15px; background-color: #0d6efd; color: white; text-decoration: none; border-radius: 4px; margin-top: 10px;">
                Edit Data Toko
            </a>
        </div>
    @else
        <div style="border: 1px solid #ffc107; padding: 15px; background-color: #fff3cd; border-radius: 6px; max-width: 500px;">
            <h3>Data Toko Belum Lengkap</h3>
            <p>Silakan lengkapi informasi toko Anda terlebih dahulu.</p>
            <a href="{{ route('penjual.edit') }}" style="display: inline-block; padding: 8px 15px; background-color: #198754; color: white; text-decoration: none; border-radius: 4px;">
                Lengkapi Data Sekarang
            </a>
        </div>
    @endif

</body>
</html>