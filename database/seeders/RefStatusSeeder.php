<?php

namespace Database\Seeders;

use App\Models\RefStatus;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RefStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $statusUmums = ['menunggu verifikasi'=>'awaiting verification', 'terverifikasi'=>'verified','perbaikan'=>'rejected','ditolak'=>'rejected'];
        foreach($statusUmums as $status_id => $status_en){
            RefStatus::create([
                'nama' => $status_id,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]);
        }
    }
}
