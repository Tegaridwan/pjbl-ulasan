<?php

namespace App\Http\Controllers;

use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;

class LaporanController extends Controller
{
    public function exportPdf()
    {
        $penjual = Auth::user()->penjual;
        abort_if($penjual === null, 404, 'Toko tidak ditemukan.');

        $data = $penjual->ulasan()
            ->with('respon')
            ->latest()
            ->get();

        $pdf = Pdf::loadView('pdf.view_pdf', compact('data', 'penjual'));

        return $pdf->download('laporan-pjbl.pdf');
    }
}
