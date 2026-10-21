@extends('layouts.penjual')
@section('title', 'Ulasan Pelanggan')

@section('isi')
@php $ulasanList = $penjual?->ulasan ?? collect(); @endphp

<h1 class="text-3xl font-bold mb-1.5">Ulasan Pelanggan</h1>
<p class="text-sm text-[#6b7385] mb-7">Semua ulasan yang masuk ke toko.</p>

@if(session('success'))
    <div class="px-4 py-3 rounded-[10px] mb-5 text-sm bg-[#e6f6ed] text-[#22a35a]">{{ session('success') }}</div>
@endif

<div class="border border-[#dde1ea] rounded-[40px] p-7 bg-white">
    <div class="overflow-x-auto">
        <table class="w-full text-sm">
            <thead>
                <tr>
                    <th class="text-left px-3 py-2.5">Nama Pembeli</th>
                    <th class="text-left px-3 py-2.5">Rating</th>
                    <th class="text-left px-3 py-2.5">Komentar</th>
                    <th class="text-right px-3 py-2.5">Tanggal</th>
                    <th class="text-right px-3 py-2.5">Aksi</th>
                </tr>
            </thead>
            <tbody>
            @forelse($ulasanList->sortByDesc('created_at') as $u)
                <tr>
                    <td class="px-3 py-5 border-t border-[#dde1ea]">{{ $u->Nama_Pembeli }}</td>
                    <td class="px-3 py-5 border-t border-[#dde1ea] text-[#f5a623]">{{ str_repeat('★', $u->Rating) }}</td>
                    <td class="px-3 py-5 border-t border-[#dde1ea]">{{ $u->Ulasan }}</td>
                    <td class="px-3 py-5 border-t border-[#dde1ea] text-right text-[#6b7385]">{{ $u->created_at?->format('d M Y, H:i') }}</td>
                    <td class="px-3 py-5 border-t border-[#dde1ea] text-right">
                        <form method="POST" action="{{ route('ulasan.destroy', $u->Id_Ulasan) }}"
                              onsubmit="return confirm('Yakin ingin menghapus ulasan ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="px-3 py-1.5 rounded-lg text-xs font-bold border border-[#e03a3a] text-[#e03a3a] cursor-pointer">Hapus</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="5" class="py-8 text-center text-[#6b7385]">Belum ada ulasan yang masuk untuk toko Anda.</td></tr>
            @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection