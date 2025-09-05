<?php

namespace App\Livewire\Guest;

use App\Models\Kejuaraan;
use App\Models\KejuaraanKategori;
use App\Models\KejuaraanUnduhan;
use App\Models\RefKategori;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\Layout;
use Livewire\Component;

class KejuaraanDetail extends Component
{
    #[Layout('layouts.guest')]
    public $kejuaraan, $kejuaraanKategoris;
    public function mount($slug)
    {
        $kejuaraan = Kejuaraan::where('slug', $slug)->firstOrFail();
        $this->kejuaraan = $kejuaraan;
        $this->kejuaraanKategoris = KejuaraanKategori::where('kejuaraans_id', $kejuaraan->id)->with(['refKategori', 'refKategori.refGolongan', 'refKategori.refRegulasi'])
            ->get()
            ->groupBy(function ($item) {
                return $item->refkategori->refRegulasi->nama ?? 'Tanpa Regulasi';
            })
            ->map(function ($group) {
                return $group->groupBy(function ($item) {
                    return $item->refkategori->refGolongan->nama ?? 'Tanpa Golongan';
                });
            })
            ->toArray();;

    }
    public function render()
    {
        return view('livewire.guest.kejuaraan-detail');
    }

    public function downloadFile($id)
    {
        $kejuaraanUnduhan = KejuaraanUnduhan::where('id', $id)->first();
        return Storage::disk('s3')->download($kejuaraanUnduhan->path_file);
    }
}
