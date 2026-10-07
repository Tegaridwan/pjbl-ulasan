<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Data Toko</title>
</head>
<body style="font-family: sans-serif; padding: 20px;">

    <!-- NAVBAR PENJUAL -->
    <nav style="background-color: #333; padding: 10px 20px; border-radius: 6px; margin-bottom: 20px; display: flex; align-items: center; justify-content: space-between;">
        <div style="display: flex; gap: 15px;">
            <a href="{{ route('homePenjual') }}" style="color: white; text-decoration: none;">Dashboard</a>
            <a href="{{ route('penjual.edit') }}" style="color: white; text-decoration: none; font-weight: bold;">Profil & Edit Toko</a>
            <a href="{{ route('penjual.ulasan') }}" style="color: white; text-decoration: none;">Lihat Ulasan</a>
        </div>
        
        <form action="{{ route('auth.logout') }}" method="POST" style="margin: 0;">
            @csrf
            <button type="submit" style="background-color: #dc3545; color: white; border: none; padding: 6px 12px; border-radius: 4px; cursor: pointer;">Logout</button>
        </form>
    </nav>

    <h2>Form Profil / Edit Data Toko</h2>

    @if ($errors->any())
        <div style="color: red; margin-bottom: 15px;">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('penjual.edit') }}" method="POST" style="max-width: 500px;">
        @csrf
        
        <div style="margin-bottom: 10px;">
            <label for="Nama_Penjual">Nama Toko/Penjual:</label><br>
            <input type="text" id="Nama_Penjual" name="Nama_Penjual" value="{{ old('Nama_Penjual', $penjual->Nama_Penjual ?? '') }}" required style="width: 100%; padding: 8px;">
        </div>

        <div style="margin-bottom: 10px;">
            <label for="Deskripsi">Deskripsi Toko:</label><br>
            <textarea id="Deskripsi" name="Deskripsi" rows="3" style="width: 100%; padding: 8px;">{{ old('Deskripsi', $penjual->Deskripsi ?? '') }}</textarea>
        </div>

        <div style="margin-bottom: 10px;">
            <label for="Alamat_Penjual">Alamat:</label><br>
            <input type="text" id="Alamat_Penjual" name="Alamat_Penjual" value="{{ old('Alamat_Penjual', $penjual->Alamat_Penjual ?? '') }}" required style="width: 100%; padding: 8px;">
        </div>

        <div style="margin-bottom: 10px;">
            <label for="No_Telp_Penjual">No Telepon:</label><br>
            <input type="text" id="No_Telp_Penjual" name="No_Telp_Penjual" value="{{ old('No_Telp_Penjual', $penjual->No_Telp_Penjual ?? '') }}" required style="width: 100%; padding: 8px;">
        </div>

        <button type="submit" style="padding: 10px 20px; background-color: #0d6efd; color: white; border: none; cursor: pointer; border-radius: 4px;">
            Simpan Perubahan
        </button>
        <a href="{{ route('homePenjual') }}" style="margin-left: 10px; text-decoration: none; color: #6c757d;">Batal</a>
    </form>

</body>
</html>