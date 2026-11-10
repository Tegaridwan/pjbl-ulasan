<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use OpenSpout\Common\Entity\Row;
use OpenSpout\Writer\XLSX\Writer;
use Throwable;

class LaporanController extends Controller
{
    public function exportExcel()
    {
        $penjual = Auth::user()->penjual;
        abort_if($penjual === null, 404, 'Toko tidak ditemukan.');

        $filePath = tempnam(sys_get_temp_dir(), 'laporan-ulasan-');
        if ($filePath === false) {
            throw new \RuntimeException('Tidak dapat membuat file sementara untuk laporan Excel.');
        }

        $tanggalLaporan = Carbon::now();
        $bulanIndonesia = [
            1 => 'januari',
            2 => 'februari',
            3 => 'maret',
            4 => 'april',
            5 => 'mei',
            6 => 'juni',
            7 => 'juli',
            8 => 'agustus',
            9 => 'september',
            10 => 'oktober',
            11 => 'november',
            12 => 'desember',
        ];
        $fileName = 'laporan-rata-rata-ulasan-'.$bulanIndonesia[$tanggalLaporan->month].'.xlsx';

        try {
            $writer = new Writer;
            $writer->openToFile($filePath);
            $writer->addRow(Row::fromValues(['Nama Pengulas', 'Tanggal', 'Jam', 'Rating']));

            $jumlahUlasan = 0;
            $totalRating = 0;

            $penjual->ulasan()
                ->whereYear('created_at', $tanggalLaporan->year)
                ->whereMonth('created_at', $tanggalLaporan->month)
                ->select(['Id_Ulasan', 'Nama_Pembeli', 'Rating', 'created_at'])
                ->chunkById(1000, function ($ulasanList) use ($writer, &$jumlahUlasan, &$totalRating) {
                    foreach ($ulasanList as $ulasan) {
                        $writer->addRow(Row::fromValues([
                            $ulasan->Nama_Pembeli,
                            $ulasan->created_at?->format('d/m/Y') ?? '-',
                            $ulasan->created_at?->format('H:i') ?? '-',
                            $ulasan->Rating,
                        ]));

                        $jumlahUlasan++;
                        $totalRating += $ulasan->Rating;
                    }
                }, 'Id_Ulasan');

            $writer->addRow(Row::fromValues([]));
            $writer->addRow(Row::fromValues([
                '',
                '',
                'Rata-rata Rating',
                $jumlahUlasan > 0 ? round($totalRating / $jumlahUlasan, 2) : '-',
            ]));

            $writer->close();
        } catch (Throwable $exception) {
            if (isset($writer)) {
                $writer->close();
            }

            if (is_file($filePath)) {
                unlink($filePath);
            }

            throw $exception;
        }

        return response()->download($filePath, $fileName, [
            'Content-Type' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
        ])
            ->deleteFileAfterSend(true);
    }
}
