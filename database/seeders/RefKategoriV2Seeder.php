<?php

namespace Database\Seeders;

use App\Models\RefGolongan;
use App\Models\RefKategori;
use App\Models\RefRegulasi;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RefKategoriV2Seeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $refKategorisIpsi = [
            'usia dini II' => [
                'pemasalan' => [
                    'tanding' => [
                        'FBAPA' => 'kelas bebas bawah putra',
                        'FBAPI' => 'kelas bebas bawah putri',
                    ]
                ],
            ],
            'pra remaja' => [
                'pemasalan' => [
                    'tanding' => [
                        'FBAPA' => 'kelas bebas bawah putra',
                        'FBAPI' => 'kelas bebas bawah putri',
                    ],
                    'seni' => [
                        'TTPA' => 'tunggal putra',
                        'TTPI' => 'tunggal putri',
                        'TTGA' => 'ganda putra',
                        'TTGI' => 'ganda putri',
                    ],
                ],
            ],
            'remaja' => [
                'pemasalan' => [
                    'seni' => [
                        'TTPA' => 'tunggal putra',
                        'TTPI' => 'tunggal putri',
                        'TTGA' => 'ganda putra',
                        'TTGI' => 'ganda putri',
                    ],
                ],
            ],
            'dewasa' => [
                'pemasalan' => [
                    'seni' => [
                        'TTPA' => 'tunggal putra',
                        'TTPI' => 'tunggal putri',
                        'TTGA' => 'ganda putra',
                        'TTGI' => 'ganda putri',
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
