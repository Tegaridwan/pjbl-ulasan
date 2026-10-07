<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Penjual - {{ $penjual->Nama_Penjual }}</title>
</head>
<body>
    <h2>Detail Penjual: <strong>{{ $penjual->Nama_Penjual }}</strong></h2>

    <p><strong>Deskripsi:</strong> {{ $penjual->Deskripsi ?? 'Tidak ada deskripsi.' }}</p>

    <p><strong>Alamat:</strong> {{ $penjual->Alamat_Penjual ?? 'Tidak ada alamat.' }}</p>

    <p><strong>Kontak:</strong> {{ $penjual->No_Telp_Penjual ?? 'Tidak ada kontak.' }}</p>

    <!-- Tombol untuk memberikan ulasan -->
    <a href="{{ route('ulasan.create', $penjual->Id_Penjual) }}" 
       style="display: inline-block; padding: 8px 12px; background-color: #0d6efd; color: white; text-decoration: none; border-radius: 4px;">
       Beri Ulasan
    </a>

    <!-- Tombol kembali ke dashboard -->
    <a href="{{ route('dashboard') }}" 
       style="display: inline-block; padding: 8px 12px; background-color: #6c757d; color: white; text-decoration: none; border-radius: 4px; margin-left: 10px;">
       Kembali ke Dashboard
    </a>
</body>
