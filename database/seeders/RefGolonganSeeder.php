<?php

namespace Database\Seeders;

use App\Models\RefGolongan;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RefGolonganSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $refGolongans = [
            'pra usia dini' => 'pre early age',
            'macan' => 'tiger',
            'usia dini' => 'early age',
            'usia dini I' => 'early age I',
            'usia dini I A' => 'early age I',
            'usia dini I B' => 'early age I',
            'usia dini II' => 'early age II',
            'usia dini II A' => 'early age II A',
            'usia dini II B' => 'early age II B',
            'pra remaja' => 'pre teens',
            'remaja'=>'teens',
            'dewasa'=>'adult',
            'master'=>'master',
        ];
        foreach($refGolongans as $refGolonganId => $refGolonganEn){
            RefGolongan::updateOrInsert(
                [
                    'nama' => $refGolonganId,
                ],
                [
                    'created_at' => Carbon::now()
                ]
            );
        }
    }
}
