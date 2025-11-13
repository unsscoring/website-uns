<?php

namespace App\Livewire\Superadmin\SuperadminKejuaraanUpdate;

use App\Models\Kejuaraan;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\WithFileUploads;
use Illuminate\Support\Str;

class SuperadminKejuaraanUpdateInformasi extends Component
{
    use WithFileUploads;
    #[Layout('layouts.admin')]
    public $kejuaraan;
    public $nama_kejuaraan, $slug, $penyelenggara, $mode_kejuaraan, $link_kejuaraan, $swo, $deskripsi, $open_pendaftaran, $active, $poster, $no_rek, $nama_rek, $nama_bank, $link_grup_wa, $nik, $pendaftaran_awal, $pendaftaran_akhir, $tm_lokasi, $tm_waktu, $pelaksanaan_lokasi, $pelaksanaan_awal, $pelaksanaan_akhir, $cp1_nama, $cp1_no, $cp2_nama, $cp2_no, $cp3_nama, $cp3_no;
    public $isSubmitting = false, $posterUrl;
    public function mount(Kejuaraan $kejuaraan)
    {
        $this->kejuaraan = $kejuaraan;
        $this->mode_kejuaraan = $kejuaraan->link_kejuaraan ? 'eksternal' : 'normal';
        $this->nama_kejuaraan = $kejuaraan->nama_kejuaraan;
        $this->slug = $kejuaraan->slug;
        $this->penyelenggara = $kejuaraan->penyelenggara;
        $this->link_kejuaraan = $kejuaraan->link_kejuaraan;
        $this->swo = $kejuaraan->swo;
        $this->deskripsi = $kejuaraan->deskripsi;
        $this->open_pendaftaran = $kejuaraan->open_pendaftaran;
        $this->active = $kejuaraan->active;
        $this->no_rek = $kejuaraan->no_rek;
        $this->nama_rek = $kejuaraan->nama_rek;
        $this->nama_bank = $kejuaraan->nama_bank;
        $this->link_grup_wa = $kejuaraan->link_grup_wa;
        $this->pendaftaran_awal = $kejuaraan->pendaftaran_awal ? Carbon::parse($kejuaraan->pendaftaran_awal)->format('Y-m-d') : null;
        $this->pendaftaran_akhir = $kejuaraan->pendaftaran_akhir ? Carbon::parse($kejuaraan->pendaftaran_akhir)->format('Y-m-d') : null;
        $this->tm_lokasi = $kejuaraan->tm_lokasi;
        $this->tm_waktu = $kejuaraan->tm_waktu ? Carbon::parse($kejuaraan->tm_waktu)->format('Y-m-d') : null;
        $this->pelaksanaan_lokasi = $kejuaraan->pelaksanaan_lokasi;
        $this->pelaksanaan_awal = $kejuaraan->pelaksanaan_awal ? Carbon::parse($kejuaraan->pelaksanaan_awal)->format('Y-m-d') : null;
        $this->pelaksanaan_akhir = $kejuaraan->pelaksanaan_akhir ? Carbon::parse($kejuaraan->pelaksanaan_akhir)->format('Y-m-d') : null;
        $this->cp1_nama = $kejuaraan->cp1_nama;
        $this->cp1_no = $kejuaraan->cp1_no;
        $this->cp2_nama = $kejuaraan->cp2_nama;
        $this->cp2_no = $kejuaraan->cp2_no;
        $this->cp3_nama = $kejuaraan->cp3_nama;
        $this->cp3_no = $kejuaraan->cp3_no;

        $expiration = Carbon::now()->addMinutes(5); // URL berlaku selama 5 menit
        $this->posterUrl = $this->kejuaraan->poster ? Storage::disk('s3')->temporaryUrl($this->kejuaraan->poster, $expiration) : null;
    }

    public function render()
    {
        return view('livewire.superadmin.superadmin-kejuaraan-update.superadmin-kejuaraan-update-informasi')->layoutData(['superadminKejuaraan' => 'active']);
    }

    public function ubahNamaKejuaraan()
    {
        $this->slug = Str::slug($this->nama_kejuaraan);
    }
    public function updateInformasi()
    {
        $this->isSubmitting = true;
        if ($this->mode_kejuaraan == 'eksternal') {
            try {
                $this->validate([
                    'nama_kejuaraan' => 'required|string|max:255',
                    'slug' => 'required|string|max:255|unique:kejuaraans, $slug,' . $this->kejuaraan->id,
                    'penyelenggara' => 'required|string|max:255',
                    'link_kejuaraan' => 'required|string|max:255',
                ]);
            } catch (\Throwable $th) {
                $this->dispatch('swal', [
                    'title' => 'Warning!',
                    'text' => $th->getMessage(),
                    'icon' => 'warning',
                ]);
                $this->validate([
                    'nama_kejuaraan' => 'required|string|max:255',
                    'slug' => 'required|string|max:255|unique:kejuaraans, $slug,' . $this->kejuaraan->id,
                    'penyelenggara' => 'required|string|max:255',
                    'link_kejuaraan' => 'required|string|max:255',
                ]);
            }
            $this->kejuaraan->update([
                'nama_kejuaraan' => $this->nama_kejuaraan,
                'slug' => $this->slug,
                'penyelenggara' => $this->penyelenggara,
                'link_kejuaraan' => $this->link_kejuaraan,
                'swo' => $this->swo,
            ]);
        } else {
            try {
                $this->validate([
                    'nama_kejuaraan' => 'required|string|max:255',
                    'slug' => 'required|string|max:255|unique:kejuaraans, $slug,' . $this->kejuaraan->id,
                    'penyelenggara' => 'required|string|max:255',
                    'deskripsi' => 'nullable|string',
                    'open_pendaftaran' => 'required|boolean',
                    'active' => 'required|boolean',
                    'no_rek' => 'nullable|string|max:255',
                    'nama_rek' => 'nullable|string|max:255',
                    'nama_bank' => 'nullable|string|max:255',
                    'link_grup_wa' => 'nullable|string|max:255',
                    'pendaftaran_awal' => 'nullable|date',
                    'pendaftaran_akhir' => 'nullable|date|after_or_equal:pendaftaran_awal',
                    'tm_lokasi' => 'nullable|string|max:255',
                    'tm_waktu' => 'nullable|date',
                    'pelaksanaan_lokasi' => 'nullable|string|max:255',
                    'pelaksanaan_awal' => 'nullable|date',
                    'pelaksanaan_akhir' => 'nullable|date|after_or_equal:pelaksanaan_awal',
                    'cp1_nama' => 'nullable|string|max:255',
                    'cp1_no' => 'nullable|string|max:20',
                    'cp2_nama' => 'nullable|string|max:255',
                    'cp2_no' => 'nullable|string|max:20',
                    'cp3_nama' => 'nullable|string|max:255',
                    'cp3_no' => 'nullable|string|max:20',
                ]);
            } catch (\Throwable $th) {
                $this->dispatch('swal', [
                    'title' => 'Warning!',
                    'text' => $th->getMessage(),
                    'icon' => 'warning',
                ]);
                $this->validate([
                    'nama_kejuaraan' => 'required|string|max:255',
                    'slug' => 'required|string|max:255|unique:kejuaraans,slug,' . $this->kejuaraan->id,
                    'penyelenggara' => 'required|string|max:255',
                    'deskripsi' => 'nullable|string',
                    'open_pendaftaran' => 'required|boolean',
                    'active' => 'required|boolean',
                    'no_rek' => 'nullable|string|max:255',
                    'nama_rek' => 'nullable|string|max:255',
                    'nama_bank' => 'nullable|string|max:255',
                    'link_grup_wa' => 'nullable|string|max:255',
                    'pendaftaran_awal' => 'nullable|date',
                    'pendaftaran_akhir' => 'nullable|date|after_or_equal:pendaftaran_awal',
                    'tm_lokasi' => 'nullable|string|max:255',
                    'tm_waktu' => 'nullable|date',
                    'pelaksanaan_lokasi' => 'nullable|string|max:255',
                    'pelaksanaan_awal' => 'nullable|date',
                    'pelaksanaan_akhir' => 'nullable|date|after_or_equal:pelaksanaan_awal',
                    'cp1_nama' => 'nullable|string|max:255',
                    'cp1_no' => 'nullable|string|max:20',
                    'cp2_nama' => 'nullable|string|max:255',
                    'cp2_no' => 'nullable|string|max:20',
                    'cp3_nama' => 'nullable|string|max:255',
                    'cp3_no' => 'nullable|string|max:20',
                ]);
                $this->kejuaraan->update([
                    'nama_kejuaraan' => $this->nama_kejuaraan,
                    'slug' => $this->slug,
                    'penyelenggara' => $this->penyelenggara,
                    'deskripsi' => $this->deskripsi,
                    'open_pendaftaran' => $this->open_pendaftaran,
                    'active' => $this->active,
                    'no_rek' => $this->no_rek,
                    'swo' => $this->swo,
                    'nama_rek' => $this->nama_rek,
                    'nama_bank' => $this->nama_bank,
                    'link_grup_wa' => $this->link_grup_wa,
                    'pendaftaran_awal' => $this->pendaftaran_awal,
                    'pendaftaran_akhir' => $this->pendaftaran_akhir,
                    'tm_lokasi' => $this->tm_lokasi,
                    'tm_waktu' => $this->tm_waktu,
                    'pelaksanaan_lokasi' => $this->pelaksanaan_lokasi,
                    'pelaksanaan_awal' => $this->pelaksanaan_awal,
                    'pelaksanaan_akhir' => $this->pelaksanaan_akhir,
                    'cp1_nama' => $this->cp1_nama,
                    'cp1_no' => $this->cp1_no,
                    'cp2_nama' => $this->cp2_nama,
                    'cp2_no' => $this->cp2_no,
                    'cp3_nama' => $this->cp3_nama,
                    'cp3_no' => $this->cp3_no,
                ]);
            }
        }

        $this->isSubmitting = false;

        $this->dispatch('swal', [
            'title' => 'Berhasil!',
            'text' => 'Data berhasil disimpan.',
            'icon' => 'success',
            'redirect' => '/superadmin/kejuaraan-update/' . $this->kejuaraan->id . '/informasi',
        ]);
    }

    public function updatePoster()
    {
        $this->isSubmitting = true;
        try {
            $this->validate([
                'poster' => 'required|image|max:2048', // Maksimal 2MB
            ]);
        } catch (\Throwable $th) {
            $this->dispatch('swal', [
                'title' => 'Warning!',
                'text' => $th->getMessage(),
                'icon' => 'warning',
            ]);
            $this->validate([
                'poster' => 'required|image|max:2048', // Maksimal 2MB
            ]);
        }
        if ($this->poster) {
            $ekstensi = $this->poster->getClientOriginalExtension();
            $file_path = 'kejuaraan/poster';
            $file_name = Carbon::now()->timestamp . '.' . $ekstensi;
            Storage::disk('s3')->putFileAs($file_path, $this->poster, $file_name);
            $buktiPath = $file_path . '/' . $file_name;
            $this->kejuaraan->update([
                'poster' => $buktiPath,
            ]);
        }
        $this->isSubmitting = false;
        $this->dispatch('swal', [
            'title' => 'Berhasil!',
            'text' => 'Data berhasil disimpan.',
            'icon' => 'success',
            'redirect' => '/superadmin/kejuaraan-update/' . $this->kejuaraan->id . '/informasi',
        ]);
    }
}
