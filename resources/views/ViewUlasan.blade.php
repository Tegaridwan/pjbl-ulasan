@extends('layouts.penjual')
@section('title', 'Ulasan Pelanggan')

@section('isi')
@php $ulasanList = $penjual?->ulasan ?? collect(); @endphp

<h1 class="text-3xl font-bold mb-1.5">Ulasan Pelanggan</h1>
<p class="text-sm text-[#6b7385] mb-7">Semua ulasan yang masuk ke toko.</p>

<div class="border border-[#dde1ea] rounded-[40px] p-7 bg-white">
    <div class="overflow-x-auto">
        <table class="w-full text-sm">
            <thead>
                <tr>
                    <th class="text-left px-3 py-2.5">Nama Pembeli</th>
                    <th class="text-left px-3 py-2.5">Rating</th>
                    <th class="text-left px-3 py-2.5">Komentar</th>
                    <th class="text-right px-3 py-2.5">Tanggal</th>
                    <th class="text-left px-3 py-2.5">Respon Penjual</th>
                </tr>
            </thead>
            <tbody>
            @forelse($ulasanList->sortByDesc('created_at') as $u)
                <tr>
                    <td class="px-3 py-5 border-t border-[#dde1ea]">{{ $u->Nama_Pembeli }}</td>
                    <td class="px-3 py-5 border-t border-[#dde1ea] text-[#f5a623]">{{ str_repeat('★', $u->Rating) }}</td>
                    <td class="px-3 py-5 border-t border-[#dde1ea]">{{ $u->Ulasan }}</td>
                    <td class="px-3 py-5 border-t border-[#dde1ea] text-right text-[#6b7385]">{{ $u->created_at?->format('d M Y, H:i') }}</td>

                    <td class="px-3 py-5 border-t border-[#dde1ea]">
                        @if($u->respon)
                            <div class="mb-2 p-2.5 rounded-lg bg-[#f0f5ff] text-[#2878eb] text-xs">
                                <span class="font-semibold block mb-0.5">Respon Toko:</span>
                                <span class="text-[#333]">{{ $u->respon }}</span>
                            </div>
                        @else
                            <span class="text-xs text-[#9aa0ac] italic block mb-1.5">Belum direspon</span>
                        @endif

                        <button type="button" 
                                class="px-3 py-1.5 rounded-lg text-xs font-semibold cursor-pointer transition-colors {{ $u->respon ? 'bg-[#eef2f6] text-[#4b5563] hover:bg-[#dde3ea]' : 'bg-[#2878eb] text-white hover:bg-[#1f62c4]' }}"
                                onclick="openResponModal({{ $u->Id_Ulasan }}, '{{ addslashes($u->respon ?? '') }}')">
                            {{ $u->respon ? 'Edit Respon' : '+ Balas Ulasan' }}
                        </button>
                    </td>
                </tr>
            @empty
                <tr><td colspan="5" class="py-8 text-center text-[#6b7385]">Belum ada ulasan yang masuk untuk toko Anda.</td></tr>
            @endforelse
            </tbody>
        </table>
    </div>
</div>

<script>
    function openResponModal(idUlasan, existingRespon) {
        const respon = prompt('Masukkan respon untuk ulasan ini:', existingRespon || '');
        if (respon !== null) {
            // Kirim data ke server menggunakan fetch atau AJAX
            fetch(`/ulasan/${idUlasan}/respon`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ respon })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert('Respon berhasil disimpan.');
                    location.reload();
                } else {
                    alert('Terjadi kesalahan saat menyimpan respon.');
                }
            });
        }
    }

</script>
@endsection