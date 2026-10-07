<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Beri Ulasan - {{ $penjual->Nama_Penjual }}</title>
</head>
<body>

    <h2>Beri Ulasan Untuk: <strong>{{ $penjual->Nama_Penjual }}</strong></h2>

    @if(session('success'))
        <div style="color: green; padding: 10px; border: 1px solid green; margin-bottom: 15px;">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('ulasan.store') }}" method="POST" style="max-width: 400px;">
        @csrf

        <!-- ID Penjual dikirim secara otomatis tanpa dropdown -->
        <input type="hidden" name="Id_Penjual" value="{{ $penjual->Id_Penjual }}">

        <div style="margin-bottom: 10px;">
            <label for="Nama_Pembeli">Nama Anda:</label><br>
            <input type="text" id="Nama_Pembeli" name="Nama_Pembeli" style="width: 100%; padding: 8px;" required>
        </div>

        <div style="margin-bottom: 10px;">
            <label for="Rating">Rating:</label><br>
            <select id="Rating" name="Rating" style="width: 100%; padding: 8px;" required>
                <option value="5">⭐⭐⭐⭐⭐ (5 - Sangat Puas)</option>
                <option value="4">⭐⭐⭐⭐ (4 - Puas)</option>
                <option value="3">⭐⭐⭐ (3 - Cukup)</option>
                <option value="2">⭐⭐ (2 - Kurang)</option>
                <option value="1">⭐ (1 - Sangat Buruk)</option>
            </select>
        </div>

        <div style="margin-bottom: 10px;">
            <label for="Ulasan">Ulasan / Komentar:</label><br>
            <textarea id="Ulasan" name="Ulasan" rows="4" style="width: 100%; padding: 8px;" required></textarea>
        </div>

        <button type="submit" style="padding: 10px 20px; background-color: #0d6efd; color: white; border: none; cursor: pointer;">
            Kirim Ulasan
        </button>
        <a href="{{ route('dashboard') }}" style="margin-left: 10px;">Kembali</a>
    </form>

</body>
</html>