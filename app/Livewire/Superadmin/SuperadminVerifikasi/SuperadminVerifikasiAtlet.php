<?php

namespace App\Livewire\Superadmin\SuperadminVerifikasi;

use App\Models\Atlet;
use App\Models\Kejuaraan;
use App\Models\Kontingen;
use App\Models\RefGolongan;
use App\Models\RefKategori;
use App\Models\RefStatus;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Layout;
use Livewire\Attributes\On;
use Livewire\Component;

class SuperadminVerifikasiAtlet extends Component
{
    #[Layout('layouts.admin')]
    public $kejuaraan, $user, $atletId, $atlets, $kontingen;
    public $isModalOpen = false;
    public $nama_atlet, $tempat_lahir, $tanggal_lahir, $nik, $gender, $golongan, $kategori, $status, $isSubmitting = false, $modalStatus, $atlet;
    public $golonganSelect = [];
    public $jenisSelect = [];
    public $cabangSelect = [];
    public $kategoriSelect = [];
    public $statusSelect = [];
    public function mount(Kontingen $kontingen)
    {
        $this->authorize('view', $kontingen);
        $this->kontingen = $kontingen;
        $this->kejuaraan = $kontingen->kejuaraan;
        $this->atlets = $this->kontingen->atlets;
        $this->golonganSelect = DB::table('kejuaraan_kategoris')
            ->join('ref_kategoris', 'kejuaraan_kategoris.ref_kategoris_id', '=', 'ref_kategoris.id')
            ->join('ref_golongans', 'ref_kategoris.golongans_id', '=', 'ref_golongans.id')
            ->where('kejuaraan_kategoris.kejuaraans_id', $this->kejuaraan->id)
            ->select('ref_golongans.id', 'ref_golongans.nama')
            ->distinct()
            ->pluck('ref_golongans.nama', 'ref_golongans.id')
            ->toArray();
        $this->statusSelect = RefStatus::pluck('nama', 'id')->toArray();
    }
    public function render()
    {
        return view('livewire.superadmin.superadmin-verifikasi.superadmin-verifikasi-atlet')->layoutData(['superadminVerifikasi' => 'active']);
    }
    public function confirmDeleteAtlet($id)
    {
        $this->atletId = $id;
        $atlet = Atlet::find($id);

        $this->dispatch('swal-delete', [
            'title' => 'Warning',
            'text' => 'Apakah Kamu Yakin Ingin Menghapus ' . $atlet->nama,
            'icon' => 'warning',
            'dispatchOn' => 'deleteAtlet'
        ]);
    }

    #[On('deleteAtlet')]
    public function deleteAtlet()
    {
        $atlet = Atlet::find($this->atletId);
        $nama = $atlet->nama;
        $atlet->delete();

        $this->dispatch('swal-notif', [
            'title' => 'Success',
            'text' => 'Berhasil menghapus ' . $nama,
            'icon' => 'success'
        ]);
        $this->atletId = null;
        $this->atlets = $this->kontingen->atlets;
    }

    public function openModalTambahAtlet()
    {
        $this->modalStatus = 'create';
        $this->isModalOpen = true;
        $this->resetFields();
    }

    public function createAtlet()
    {
        if ($this->isSubmitting) return;

        $this->isSubmitting = true;
        try {
            $this->validate([
                'nama_atlet' => 'required|string|max:255',
                'tempat_lahir' => 'required|string|max:255',
                'tanggal_lahir' => 'required|date',
                'nik' => 'required|string|max:16',
                'gender' => 'required',
                'golongan' => 'required',
                'kategori' => 'required',
            ]);
        } catch (\Throwable $th) {
            $this->dispatch('swal', [
                'title' => 'Warning!',
                'text' => $th->getMessage(),
                'icon' => 'warning',
            ]);
            $this->validate([
                'nama_atlet' => 'required|string|max:255',
                'tempat_lahir' => 'required|string|max:255',
                'tanggal_lahir' => 'required|date',
                'nik' => 'required|string|max:16',
                'gender' => 'required',
                'kategori' => 'required',
            ]);
        }
        Atlet::create([
            'status' => 1,
            'kontingens_id' => $this->kontingen->id,
            'ref_kategoris_id' => $this->kategori,
            'no_pendaftaran' => Atlet::count() + 1,
            'nama' => $this->nama_atlet,
            'tempat_lahir' => $this->tempat_lahir,
            'tanggal_lahir' => $this->tanggal_lahir,
            'usia' => Carbon::parse($this->tanggal_lahir)->age,
            'gender' => $this->gender,
            'nik' => $this->nik,
        ]);
        $this->isSubmitting = false;

        $this->dispatch('swal', [
            'title' => 'Berhasil!',
            'text' => 'Data berhasil disimpan.',
            'icon' => 'success',
        ]);

        $this->atlets = $this->kontingen->atlets;
        $this->resetFields();
        $this->isModalOpen = false;
        $this->isSubmitting = false;
    }

    public function openModalUpdateAtlet($id)
    {
        $this->modalStatus = 'update';
        $this->isModalOpen = true;
        $this->atletId = $id;
        $atlet = Atlet::find($id);
        $this->atlet = $atlet;
        $this->nama_atlet = $atlet->nama;
        $this->tempat_lahir = $atlet->tempat_lahir;
        $this->tanggal_lahir = $atlet->tanggal_lahir ? Carbon::parse($atlet->tanggal_lahir)->format('Y-m-d') : null;
        $this->nik = $atlet->nik;
        $this->gender = $atlet->gender;
        $this->status = $atlet->status;
        $this->golongan = $atlet->refKategori->golongans_id;
        $this->golonganSelected();
        $this->kategori = $atlet->refKategori->id;
    }


    public function updateAtlet()
    {
        if ($this->isSubmitting) return;

        $this->isSubmitting = true;
        try {
            $this->validate([
                'nama_atlet' => 'required|string|max:255',
                'tempat_lahir' => 'required|string|max:255',
                'tanggal_lahir' => 'required|date',
                'nik' => 'required|string|max:16',
                'gender' => 'required',
                'golongan' => 'required',
                'kategori' => 'required',
            ]);
        } catch (\Throwable $th) {
            $this->dispatch('swal', [
                'title' => 'Warning!',
                'text' => $th->getMessage(),
                'icon' => 'warning',
            ]);
            $this->validate([
                'nama_atlet' => 'required|string|max:255',
                'tempat_lahir' => 'required|string|max:255',
                'tanggal_lahir' => 'required|date',
                'nik' => 'required|string|max:16',
                'gender' => 'required',
                'golongan' => 'required',
                'kategori' => 'required',
            ]);
        }

        $this->atlet->update([
            'status' => $this->status,
            'ref_kategoris_id' => $this->kategori,
            'nama' => $this->nama_atlet,
            'tempat_lahir' => $this->tempat_lahir,
            'tanggal_lahir' => $this->tanggal_lahir,
            'usia' => Carbon::parse($this->tanggal_lahir)->age,
            'gender' => $this->gender,
            'nik' => $this->nik,
        ]);
        $this->isSubmitting = false;

        $this->dispatch('swal', [
            'title' => 'Berhasil!',
            'text' => 'Data berhasil disimpan.',
            'icon' => 'success',
        ]);

        $this->atlets = $this->kontingen->atlets;
        $this->resetFields();
        $this->isModalOpen = false;
        $this->isSubmitting = false;
    }

    public function resetFields()
    {
        $this->nama_atlet = '';
        $this->tempat_lahir = '';
        $this->tanggal_lahir = '';
        $this->nik = '';
        $this->kategori = null;
    }

    public function golonganSelected()
    {
        $kejuaraanKategoris = $this->kejuaraan->kejuaraanKategoris->pluck('ref_kategoris_id')->toArray();
        $this->kategoriSelect = RefKategori::whereIn('id', $kejuaraanKategoris)
            ->where('golongans_id', $this->golongan)
            ->get(['id', 'nama_kategori', 'jenis'])
            ->toArray();
    }
}
