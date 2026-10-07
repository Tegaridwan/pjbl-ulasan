<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Penjual</title>
</head>
<body>
    <h2>Home Penjual</h2>

    <!-- Tampilkan Notifikasi Sukses Jika Ada -->
    @if(session('success'))
        <div style="color: green; margin-bottom: 15px;">
            {{ session('success') }}
        </div>
    @endif

    <!-- Tampilkan Error Validasi Jika Ada -->
    @if ($errors->any())
        <div style="color: red; margin-bottom: 15px;">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif



    @if($penjual)
        <div style="border: 1px solid #ddd; padding: 20px; border-radius: 8px; margin-bottom: 20px; max-width: 500px; background-color: #f9f9f9;">
            <h3 style="margin-top: 0;">Informasi Toko Anda</h3>
            <p style="margin: 5px 0;"><strong>Nama Toko:</strong> {{ $penjual->Nama_Penjual }}</p>
            <p style="margin: 5px 0;"><strong>Deskripsi:</strong> {{ $penjual->Deskripsi }}</p>
            <p style="margin: 5px 0;"><strong>Alamat:</strong> {{ $penjual->Alamat_Penjual }}</p>
            <p style="margin: 5px 0;"><strong>No Telepon:</strong> {{ $penjual->No_Telp_Penjual }}</p>
        </div>
        
        <button type="button" onclick="document.getElementById('form-penjual').style.display='block'" style="margin-bottom: 15px; padding: 5px 10px; cursor: pointer;">Edit Data Toko</button>
    @else
        <h3>Lengkapi Data Toko Anda</h3>
    @endif

    <div id="form-penjual" @if($penjual) style="display: none;" @else style="display: block;" @endif>
        <form action="{{ route('penjual.store') }}" method="POST" style="margin-bottom: 30px; max-width: 500px;">
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

            <button type="submit" style="padding: 8px 15px; background-color: blue; color: white; border: none; cursor: pointer;">Simpan Data Penjual</button>
        </form>
    </div>

    <hr>
    
    <form action="{{ route('auth.logout') }}" method="POST">
        @csrf
        <button type="submit" style="margin-top: 20px;">Logout</button>
    </form>
</body>
</html>
