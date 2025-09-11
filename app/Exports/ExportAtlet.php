<?php

namespace App\Exports;

use App\Models\Atlet;
use App\Models\Kejuaraan;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class ExportAtlet implements FromView, ShouldAutoSize, WithStyles, WithColumnWidths, WithEvents, WithColumnFormatting
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
    public function __construct($id)
    {
        $this->kejuaraan_id = $id;
    }
    public function columnWidths(): array
    {
        return [];
    }
    public function view(): View
    {
        $id = $this->kejuaraan_id;
        $atlets = Atlet::with([
            'refKategori',
            'refStatus',
            'kontingen' => function ($q) use ($id) {
                $q->where('kejuaraans_id', $id);
            }
        ])
            ->whereHas('kontingen', function ($q) use ($id) {
                $q->where('kejuaraans_id', $id);
            })
            ->get();

        $this->data = $atlets->count();
        return view('excel.export-atlet', [
            'atlets' => $atlets,
            'kejuaraan' => Kejuaraan::find($this->kejuaraan_id)
        ]);
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $sheet = $event->sheet;

                // Hitung jumlah baris dan kolom (misal data dimulai dari A1)
                $rowCount = $this->data + 4; // +1 untuk header
                $columnEnd = 'L'; // ganti sesuai kolom terakhir

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
    public function columnFormats(): array
    {
        return [
            'F' => NumberFormat::FORMAT_TEXT,
        ];
    }
}
