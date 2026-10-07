<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Penjual - {{ $penjual->Nama_Penjual }}</title>
</head>
<body style="font-family: sans-serif; padding: 20px;">

    <h2>Detail Penjual: <strong>{{ $penjual->Nama_Penjual }}</strong></h2>

    <p><strong>Deskripsi:</strong> {{ $penjual->Deskripsi ?? 'Tidak ada deskripsi.' }}</p>
    <p><strong>Alamat:</strong> {{ $penjual->Alamat_Penjual ?? 'Tidak ada alamat.' }}</p>
    <p><strong>Kontak:</strong> {{ $penjual->No_Telp_Penjual ?? 'Tidak ada kontak.' }}</p>

    <div style="margin: 20px 0;">
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
    </div>

    <hr style="margin: 20px 0;">

    <!-- SECTION DAFTAR ULASAN -->
    <h3>Daftar Ulasan ({{ $penjual->ulasan->count() }})</h3>

    <div id="reviewList" style="max-width: 600px;">
        @forelse($penjual->ulasan as $index => $u)
            <!-- Jika ulasan ke-4 dan seterusnya (index >= 3), sembunyikan dulu -->
            <div class="review-item {{ $index >= 3 ? 'extra-review' : '' }}" 
                 style="border: 1px solid #ddd; padding: 12px; margin-bottom: 12px; border-radius: 6px; background-color: #f9f9f9; {{ $index >= 3 ? 'display: none;' : '' }}">
                
                <div style="display: flex; justify-content: space-between; align-items: center;">
                    <strong>{{ $u->Nama_Pembeli }}</strong>
                    <span style="color: #f39c12; font-weight: bold;">
                        @for($i = 1; $i <= 5; $i++)
                            {{ $i <= $u->Rating ? '★' : '☆' }}
                        @endfor
                        ({{ $u->Rating }}/5)
                    </span>
                </div>

                <p style="margin: 8px 0; color: #333;">{{ $u->Ulasan }}</p>

                @if($u->created_at)
                    <small style="color: #888;">{{ $u->created_at->format('d M Y, H:i') }}</small>
                @endif
            </div>
        @empty
            <p style="color: #666; italic;">Belum ada ulasan untuk penjual ini.</p>
        @endforelse
    </div>

    <!-- TOMBOL SELENGKAPNYA (Hanya muncul jika ulasan lebih dari 3) -->
    @if($penjual->ulasan->count() > 3)
        <button id="toggleReviewBtn" onclick="toggleReviews()" 
                style="padding: 8px 16px; background-color: #f8f9fa; border: 1px solid #ccc; border-radius: 4px; cursor: pointer; margin-top: 10px; font-weight: bold;">
            Lihat Selengkapnya ({{ $penjual->ulasan->count() - 3 }} ulasan lagi)
        </button>

        <script>
            function toggleReviews() {
                const extraReviews = document.querySelectorAll('.extra-review');
                const btn = document.getElementById('toggleReviewBtn');
                
                let isHidden = extraReviews[0].style.display === 'none';
                
                extraReviews.forEach(card => {
                    card.style.display = isHidden ? 'block' : 'none';
                });
                
                btn.innerText = isHidden 
                    ? 'Tampilkan Lebih Sedikit' 
                    : 'Lihat Selengkapnya ({{ $penjual->ulasan->count() - 3 }} ulasan lagi)';
            }
        </script>
    @endif

</body>
</html>