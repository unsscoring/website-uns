<?php

namespace Database\Seeders;

use App\Models\RefGolongan;
use App\Models\RefKategori;
use App\Models\RefRegulasi;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RefKategoriV4Seeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $refKategorisIpsi = [
            'pra usia dini' => [
                'pemasalan' => [
                    'tanding' => [
                        'FBAPA' => 'kelas bebas atas putra',
                        'FBAPI' => 'kelas bebas atas putri',
                    ]
                ],
            ],
            'usia dini II B' => [
                'pemasalan' => [
                    'seni' => [
                        'TTPA' => 'tunggal putra',
                        'TTPI' => 'tunggal putri',
                        'TTGA' => 'ganda putra',
                        'TTGI' => 'ganda putri',
                        'TTGA1' => 'beregu putra',
                        'TTGI2' => 'beregu putri',
                    ],
                ],
            ],
        ];

        // Tanding
        $regulasiIpsi = RefRegulasi::where('nama', 'IPSI 2022')->first();
        foreach ($refKategorisIpsi as $golongan => $jeniss) {
            $refGolongan = RefGolongan::where('nama', $golongan)->first();
            foreach ($jeniss as $jenis => $cabangs) {
                foreach ($cabangs as $cabang => $kategoris) {
                    foreach ($kategoris as $kode => $kategori) {
                        try {
                            RefKategori::updateOrCreate(
                                [
                                    'nama_kategori' => $kategori,
                                    'golongans_id' => $refGolongan->id,
                                    'regulasis_id' => $regulasiIpsi->id,
                                    'jenis' => $jenis,
                                    'cabang' => $cabang,
                                ],
                            );
                        } catch (\Throwable $th) {
                            dd($th->getMessage());
                        }
                    }
                }
            }
        }
    }
}
