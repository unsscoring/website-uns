<?php

namespace App\Livewire\Manajer\ManajerKejuaraan;

use App\Models\Kejuaraan;
use App\Models\Kontingen;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithFileUploads;

class ManajerKejuaraanPembayaran extends Component
{
    use WithFileUploads;
    #[Layout('layouts.admin')]
    public $kejuaraan, $atletId, $atlets, $kontingen;
    public $user, $jumlah_tagihan, $jumlah_bayar, $tanggal, $bukti_pembayaran, $fileUrl, $pembayaran;
    public $tagihan_details = [], $isSubmitting = false;
    public function mount(Kejuaraan $kejuaraan)
    {
        $this->kejuaraan = $kejuaraan;
        $this->user = auth()->user();
        $this->kontingen = Kontingen::where('users_id', $this->user->id)
            ->where('kejuaraans_id', $kejuaraan->id)
            ->first();
        $this->jumlah_tagihan = 0;
        $this->jumlah_bayar = 0;
        $this->tanggal = Carbon::now()->format('Y-m-d');
        $this->pembayaran = $this->user->pembayaran;
        $this->jumlah_bayar = $this->pembayaran ? $this->pembayaran->jumlah_bayar : 0;
        $this->tanggal = $this->pembayaran ? Carbon::parse($this->pembayaran->tanggal)->format('Y-m-d') : Carbon::now()->format('Y-m-d');
        // $this->statusPembayaran = $this->pembayaran ? $this->pembayaran->status : 0;
        $expiration = Carbon::now()->addMinutes(5); // URL berlaku selama 5 menit
        $this->fileUrl = $this->pembayaran ? Storage::disk('s3')->temporaryUrl($this->pembayaran->file_path, $expiration) : null;
        $tanding = $this->kontingen->atlets->filter(function ($atlet) {
            return strtolower($atlet->refKategori->cabang ?? '') === 'tanding';
        })->count();
        $tunggal = $this->kontingen->atlets->filter(function ($atlet) {
            return stripos($atlet->refKategori->nama_kategori ?? '', 'tunggal') !== false;
        })->count();

        $ganda = $this->kontingen->atlets->filter(function ($atlet) {
            return stripos($atlet->refKategori->nama_kategori ?? '', 'ganda') !== false;
        })->count();

        $beregu = $this->kontingen->atlets->filter(function ($atlet) {
            return stripos($atlet->refKategori->nama_kategori ?? '', 'beregu') !== false;
        })->count();

        $solokreatif = $this->kontingen->atlets->filter(function ($atlet) {
            return stripos($atlet->refKategori->nama_kategori ?? '', 'solo kreatif') !== false;
        })->count();

        $this->tagihan_details = array_filter([
            'tanding' => ['jumlah' => $tanding, 'harga' => 300000],
            'tunggal' => ['jumlah' => $tunggal, 'harga' => 300000],
            'ganda' => ['jumlah' => (int) ceil($ganda / 2), 'harga' => 500000],
            'beregu' => ['jumlah' => ceil($beregu / 3), 'harga' => 600000],
            'solo kreatif' => ['jumlah' => ceil($solokreatif / 1), 'harga' => 300000],
        ], function ($item) {
            return $item['jumlah'] > 0;
        });
        $this->jumlah_tagihan = array_reduce($this->tagihan_details, function ($carry, $item) {
            return $carry + ($item['jumlah'] * $item['harga']);
        }, 0);
    }
    public function render()
    {
        return view('livewire.manajer.manajer-kejuaraan.manajer-kejuaraan-pembayaran')->layoutData(['manajerKejuaraan' => 'active']);
    }
}
