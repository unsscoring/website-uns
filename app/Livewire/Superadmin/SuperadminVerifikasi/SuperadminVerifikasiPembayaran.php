<?php

namespace App\Livewire\Superadmin\SuperadminVerifikasi;

use App\Models\Kontingen;
use App\Models\RefStatus;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\WithFileUploads;

class SuperadminVerifikasiPembayaran extends Component
{
    use WithFileUploads;
    #[Layout('layouts.admin')]
    public $kejuaraan, $atletId, $atlets, $kontingen, $refStatusSelect = [];
    public $user, $jumlah_tagihan, $jumlah_bayar, $tanggal, $bukti_pembayaran, $fileUrl, $pembayaran, $status;
    public $tagihan_details = [], $isSubmitting = false;
    public function mount(Kontingen $kontingen)
    {
        $this->kontingen = $kontingen;
        $this->kejuaraan = $kontingen->kejuaraan;
        $this->user = auth()->user();
        $this->jumlah_tagihan = 0;
        $this->jumlah_bayar = 0;
        $this->tanggal = Carbon::now()->format('Y-m-d');
        $this->jumlah_bayar = $this->kontingen->total_pembayaran;
        $this->status = $this->kontingen->status_pembayaran;
        $this->refStatusSelect = RefStatus::get()->pluck('nama','id')->toArray();
        $this->tanggal = $this->kontingen->tanggal_pembayaran ? Carbon::parse($this->kontingen->tanggal_pembayaran)->format('Y-m-d') : Carbon::now()->format('Y-m-d');
        $expiration = Carbon::now()->addMinutes(5); // URL berlaku selama 5 menit
        $this->fileUrl = $this->kontingen->path_pembayaran ? Storage::disk('s3')->temporaryUrl($this->kontingen->path_pembayaran, $expiration) : null;
        $kategoriCounts = $this->kontingen->atlets->groupBy(function ($atlet) {
            return strtolower($atlet->refKategori->nama_kategori ?? '');
        })->map->count();

        $this->tagihan_details = [];

        foreach ($this->kejuaraan->kejuaraanKategoris as $kategori) {
            $nama = strtolower($kategori->refKategori->nama_kategori);
            $jumlah = $kategoriCounts[$nama] ?? 0;

            // logika pembagian jumlah sesuai jenis kategori
            if (stripos($nama, 'ganda') !== false) {
                $jumlah = (int) ceil($jumlah / 2);
            } elseif (stripos($nama, 'beregu') !== false) {
                $jumlah = (int) ceil($jumlah / 3);
            }

            if ($jumlah > 0) {
                $this->tagihan_details[$nama] = [
                    'jumlah' => $jumlah,
                    'harga' => $kategori->swp, // ambil harga dari kejuaraanKategori
                ];
            }
        }

        $this->jumlah_tagihan = array_reduce($this->tagihan_details, function ($carry, $item) {
            return $carry + ($item['jumlah'] * $item['harga']);
        }, 0);
        // Tambahkan SWO hanya sekali jika ada
        if ($this->kejuaraan->swo && $this->kejuaraan->swo > 0) {
            $this->tagihan_details['swo'] = [
                'jumlah' => 1,
                'harga'  => $this->kejuaraan->swo,
            ];
            $this->jumlah_tagihan += $this->kejuaraan->swo;
        }
    }
    public function render()
    {
        return view('livewire.superadmin.superadmin-verifikasi.superadmin-verifikasi-pembayaran')->layoutData(['superadminVerifikasi' => 'active']);
    }
    public function simpanPembayaran()
    {
        if ($this->isSubmitting) return;

        $this->isSubmitting = true;
        try {
            $this->validate([
                'jumlah_bayar' => 'required|numeric|min:0|',
                'tanggal' => 'required|date',
            ]);
            if ($this->pembayaran == null) {
                $this->validate([
                    'bukti_pembayaran' => 'required|image|max:1024', // Maksimal 1MB
                ]);
            } else {
                $this->validate([
                    'bukti_pembayaran' => 'nullable|image|max:1024', // Maksimal 1MB
                ]);
            }
        } catch (\Throwable $th) {
            $this->dispatch('swal', [
                'title' => 'Warning!',
                'text' => $th->getMessage(),
                'icon' => 'warning',
            ]);
            $this->validate([
                'jumlah_bayar' => 'required|numeric|min:0|',
                'tanggal' => 'required|date',
            ]);
            if ($this->pembayaran == null) {
                $this->validate([
                    'bukti_pembayaran' => 'required|image|max:1024', // Maksimal 1MB
                ]);
            } else {
                $this->validate([
                    'bukti_pembayaran' => 'nullable|image|max:1024', // Maksimal 1MB
                ]);
            }
        }

        if ($this->bukti_pembayaran) {
            $ekstensi = $this->bukti_pembayaran->getClientOriginalExtension();
            $file_path = 'kontingen/bukti_bayar';
            $file_name = Carbon::now()->timestamp . '.' . $ekstensi;
            Storage::disk('s3')->putFileAs($file_path, $this->bukti_pembayaran, $file_name);
            $buktiPath = $file_path . '/' . $file_name;
            $this->kontingen->update([
                'path_pembayaran' => $buktiPath,
            ]);
        }

        $this->kontingen->update([
            'total_pembayaran' => $this->jumlah_bayar,
            'tanggal_pembayaran' => $this->tanggal,
            'status_pembayaran' => $this->status, // Status terverifikasi
        ]);

        $this->isSubmitting = false;

        $this->dispatch('swal', [
            'title' => 'Berhasil!',
            'text' => 'Data berhasil disimpan.',
            'icon' => 'success',
        ]);
        $expiration = Carbon::now()->addMinutes(5); // URL berlaku selama 5 menit
        $this->fileUrl = $this->kontingen->path_pembayaran ? Storage::disk('s3')->temporaryUrl($this->kontingen->path_pembayaran, $expiration) : null;
        
    }
}
