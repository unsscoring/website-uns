<?php

namespace App\Livewire\Superadmin\SuperadminKejuaraanUpdate;

use App\Models\Kejuaraan;
use App\Models\KejuaraanKategori;
use App\Models\RefGolongan;
use App\Models\RefKategori;
use App\Models\RefRegulasi;
use Livewire\Attributes\Layout;
use Livewire\Attributes\On;
use Livewire\Component;

class SuperadminKejuaraanUpdateKategori extends Component
{
    #[Layout('layouts.admin')]
    public $kejuaraan, $kejuaraanKategoris, $refKategoris = [], $kategorisId, $kategoriSelected, $bulkKategorisId = [], $regulasisId, $golongansId, $refGolongans, $refRegulasis;
    public $multiAtlet, $swp, $bobot;
    public $isSubmitting = false, $isModalOpen = false, $modalStatus;
    public function mount(Kejuaraan $kejuaraan)
    {
        $this->kejuaraan = $kejuaraan;
        // use the relationship method to get a query builder and order by the correct column
        $this->kejuaraanKategoris = $kejuaraan->kejuaraanKategoris()
            ->with('refKategori')
            ->with('refKategori.refGolongan')
            ->with('refKategori.refRegulasi')
            ->orderBy('ref_kategoris_id')
            ->get();

        $this->refGolongans = RefGolongan::get();
        $this->refRegulasis = RefRegulasi::get();
    }

    public function openModalTambahKategoriBulk()
    {
        $this->isModalOpen = true;
        $this->resetFields();
        $this->modalStatus = 'bulkKategori';
    }

    public function openModalTambahKategori()
    {
        $this->isModalOpen = true;
        $this->resetFields();
        $this->modalStatus = 'kategori';
    }

    public function openModalUpdateKategori($id)
    {
        $kategori = KejuaraanKategori::find($id);
        $this->kategoriSelected = $kategori;
        $this->multiAtlet = $kategori->multi_atlet;
        $this->swp = $kategori->swp;
        $this->bobot = $kategori->bobot;
        $this->golongansId = $kategori->refKategori->golongans_id;
        $this->regulasisId = $kategori->refKategori->regulasis_id;
        $this->kategorisId = $kategori->ref_kategoris_id;
        $this->isModalOpen = true;
        $this->modalStatus = 'updateKategori';
    }

    public function closeModal()
    {
        $this->isModalOpen = false;
        $this->resetFields();
    }

    public function resetFields()
    {
        $this->kategorisId = null;
        $this->bulkKategorisId = [];
        $this->regulasisId = null;
        $this->golongansId = null;
        $this->multiAtlet = null;
        $this->swp = null;
        $this->bobot = null;
        $this->modalStatus = null;
    }

    public function createBulkKategori()
    {
        $this->isSubmitting = true;
        try {
            $this->validate([
                'swp' => 'required|integer|min:0',
                'multiAtlet' => 'required|in:0,1',
            ]);
        } catch (\Throwable $th) {
            $this->dispatch('swal', [
                'title' => 'Warning!',
                'text' => $th->getMessage(),
                'icon' => 'warning',
            ]);
            $this->validate([
                'swp' => 'required|integer|min:0',
                'multiAtlet' => 'required|in:0,1',
            ]);
        }
        // bulk insert to avoid N queries
        $rows = [];
        foreach ($this->bulkKategorisId as $kategoriId) {
            $rows[] = [
            'kejuaraans_id'    => $this->kejuaraan->id,
            'ref_kategoris_id' => $kategoriId,
            'multi_atlet'      => $this->multiAtlet,
            'swp'              => $this->swp
            ];
        }

        if (!empty($rows)) {
            KejuaraanKategori::insert($rows);
        }
        $this->kejuaraanKategoris = $this->kejuaraan->kejuaraanKategoris;
        $this->closeModal();
        $this->resetFields();
        $this->dispatch('swal', [
            'title' => 'Berhasil!',
            'text' => 'Data berhasil disimpan.',
            'icon' => 'success',
        ]);
        $this->isSubmitting = false;
    }

    public function createKategori()
    {
        $this->isSubmitting = true;
        try {
            $this->validate([
                'swp' => 'required|integer|min:0',
                'multiAtlet' => 'required|in:0,1',
            ]);
        } catch (\Throwable $th) {
            $this->dispatch('swal', [
                'title' => 'Warning!',
                'text' => $th->getMessage(),
                'icon' => 'warning',
            ]);
            $this->validate([
                'swp' => 'required|integer|min:0',
                'multiAtlet' => 'required|in:0,1',
            ]);
        }

        KejuaraanKategori::create([
            'kejuaraans_id'    => $this->kejuaraan->id,
            'ref_kategoris_id' => $this->kategorisId,
            'multi_atlet'      => $this->multiAtlet,
            'swp'              => $this->swp,
            'bobot'            => $this->bobot,
        ]);

        $this->kejuaraanKategoris = $this->kejuaraan->kejuaraanKategoris;
        $this->closeModal();
        $this->resetFields();
        $this->dispatch('swal', [
            'title' => 'Berhasil!',
            'text' => 'Data berhasil disimpan.',
            'icon' => 'success',
        ]);
        $this->isSubmitting = false;
    }

    public function updateKategori()
    {
        $this->isSubmitting = true;
        try {
            $this->validate([
                'swp' => 'required|integer|min:0',
                'multiAtlet' => 'required|in:0,1',
            ]);
        } catch (\Throwable $th) {
            $this->dispatch('swal', [
                'title' => 'Warning!',
                'text' => $th->getMessage(),
                'icon' => 'warning',
            ]);
            $this->validate([
                'swp' => 'required|integer|min:0',
                'multiAtlet' => 'required|in:0,1',
            ]);
        }

        $this->kategoriSelected->update([
            'multi_atlet'      => $this->multiAtlet,
            'swp'              => $this->swp,
            'bobot'            => $this->bobot,
        ]);

        $this->kejuaraanKategoris = $this->kejuaraan->kejuaraanKategoris;
        $this->closeModal();
        $this->resetFields();
        $this->dispatch('swal', [
            'title' => 'Berhasil!',
            'text' => 'Data berhasil disimpan.',
            'icon' => 'success',
        ]);
        $this->isSubmitting = false;
    }

    public function confirmDeleteKategori($id)
    {
        $this->kategorisId = $id;
        $kategori = KejuaraanKategori::find($id);
        
        $this->dispatch('swal-delete', [
            'title' => 'Warning',
            'text' => 'Apakah Kamu Yakin Ingin Menghapus ' . $kategori->refKategori->nama_kategori,
            'icon' => 'warning',
            'dispatchOn' => 'deleteKategori',
        ]);
    }

    #[On('deleteKategori')]
    public function deleteKategori()
    {
        $kategori = KejuaraanKategori::find($this->kategorisId);
        $nama = $kategori->nama_kategori;
        $kategori->delete();

        $this->dispatch('swal-notif', [
            'title' => 'Success',
            'text' => 'Berhasil menghapus ' . $nama,
            'icon' => 'success'
        ]);
        $this->kategorisId = null;
        $this->kejuaraanKategoris = $this->kejuaraan->kejuaraanKategoris;
    }

    public function loadRefKategoris()
    {
        $this->bulkKategorisId = [];
        $kejuaraan = $this->kejuaraan;
        $this->refKategoris = [];
        $this->refKategoris = RefKategori::where([['golongans_id', $this->golongansId], ['regulasis_id', $this->regulasisId]])->with(['refGolongan', 'refRegulasi'])
            ->whereDoesntHave('kejuaraanKategori', function ($query) use ($kejuaraan) {
                $query->where('kejuaraans_id', $kejuaraan->id);
            })
            ->get()
            ->map(function ($kategori) {
                return [
                    'id' => $kategori->id,
                    'nama_kategori' => $kategori->nama_kategori,
                    'golongan' => $kategori->refGolongan->nama ?? null,
                    'regulasi' => $kategori->refRegulasi->nama ?? null,
                ];
            })
            ->toArray();
    }

    public function render()
    {
        return view('livewire.superadmin.superadmin-kejuaraan-update.superadmin-kejuaraan-update-kategori')->layoutData(['superadminKejuaraan' => 'active']);
    }
}
