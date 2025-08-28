<?php

namespace Database\Seeders;

use App\Models\RefRegulasi;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RefRegulasiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $regulasis = ['IPSI 2022', 'TAPAK SUCI'];

        foreach($regulasis as $regulasi){
            RefRegulasi::updateOrCreate([
                'nama' => $regulasi,
            ],
            [
                'updated_at'=>now()
            ]);
        }
    }
}
