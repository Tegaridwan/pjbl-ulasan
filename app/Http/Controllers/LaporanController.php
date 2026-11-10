<?php

namespace App\Http\Controllers;
use openspout\openspout;
use App\Models\ulasan;
use Illuminate\Http\Request;

class LaporanController extends Controller
{
    public function exportExcel(){
        $data = ulasan::all();$pdf = Pdf::loadView('nama_folder.view_pdf',
        ['data' => $data]);return $pdf->download('laporan-pjbl.pdf');
    }
}