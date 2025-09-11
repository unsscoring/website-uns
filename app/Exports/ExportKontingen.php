<?php

namespace App\Exports;

use App\Models\Kejuaraan;
use App\Models\Kontingen;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class ExportKontingen implements FromView, ShouldAutoSize, WithStyles, WithColumnWidths, WithEvents
{
    protected $data, $kejuaraan_id;
    public function styles(Worksheet $sheet)
    {
        return [
            1 => ['font' => ['bold' => true]],
            2 => ['font' => ['bold' => true]],
            4 => ['font' => ['bold' => true]],
        ];
    }
    public function columnWidths(): array
    {
        return [
        ];
    }
    public function __construct($id)
    {
        $this->kejuaraan_id = $id;
    }
    public function view(): View
    {
        $kontingens = Kontingen::where('kejuaraans_id', $this->kejuaraan_id)
            ->withCount(['atlets as jumlah_atlet'])
            ->withCount(['atlets as jumlah_terverifikasi' => function ($query) {
                $query->whereHas('refStatus', function ($q) {
                    $q->where('nama', 'terverifikasi');
                });
            }])
            ->get();
        $this->data = $kontingens->count();
        return view('excel.export-kontingen', [
            'kontingens' => $kontingens,
            'kejuaraan' => Kejuaraan::find($this->kejuaraan_id)
        ]);
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function(AfterSheet $event) {
                $sheet = $event->sheet;

                // Hitung jumlah baris dan kolom (misal data dimulai dari A1)
                $rowCount = $this->data + 4; // +1 untuk header
                $columnEnd = 'G'; // ganti sesuai kolom terakhir

                // Range penuh yang ingin diberi border
                $cellRange = 'A4:' . $columnEnd . $rowCount;

                // Tambahkan border
                $sheet->getStyle($cellRange)->applyFromArray([
                    'borders' => [
                        'allBorders' => [
                            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                            'color' => ['argb' => 'FF000000'], // warna hitam
                        ],
                    ],
                ]);
            }
        ];
    }

}
