<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Ulasan Toko</title>
</head>
<body style="font-family: sans-serif; padding: 20px;">

    <!-- NAVBAR PENJUAL -->
    <nav style="background-color: #333; padding: 10px 20px; border-radius: 6px; margin-bottom: 20px; display: flex; align-items: center; justify-content: space-between;">
        <div style="display: flex; gap: 15px;">
            <a href="{{ route('homePenjual') }}" style="color: white; text-decoration: none;">Dashboard</a>
            <a href="{{ route('penjual.edit') }}" style="color: white; text-decoration: none;">Profil & Edit Toko</a>
            <a href="{{ route('penjual.ulasan') }}" style="color: white; text-decoration: none; font-weight: bold;">Lihat Ulasan</a>
        </div>
        
        <form action="{{ route('auth.logout') }}" method="POST" style="margin: 0;">
            @csrf
            <button type="submit" style="background-color: #dc3545; color: white; border: none; padding: 6px 12px; border-radius: 4px; cursor: pointer;">Logout</button>
        </form>
    </nav>

    <h2>Daftar Ulasan Pembeli</h2>

    <div style="max-width: 600px;">
        @forelse($penjual->ulasan ?? [] as $u)
            <div style="border: 1px solid #ddd; padding: 12px; margin-bottom: 12px; border-radius: 6px; background-color: #f9f9f9;">
                <div style="display: flex; justify-content: space-between;">
                    <strong>{{ $u->Nama_Pembeli }}</strong>
                    <span style="color: #f39c12; font-weight: bold;">Rating: {{ $u->Rating }}/5 ⭐</span>
                </div>
                <p style="margin: 8px 0;">{{ $u->Ulasan }}</p>
                <small style="color: #777;">{{ $u->created_at ? $u->created_at->format('d M Y, H:i') : '' }}</small>
            </div>
        @empty
            <p style="color: #666;">Belum ada ulasan yang masuk untuk toko Anda.</p>
        @endforelse
    </div>

</body>
</html>