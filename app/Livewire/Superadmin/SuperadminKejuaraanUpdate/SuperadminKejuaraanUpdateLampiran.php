<?php

namespace App\Livewire\Superadmin\SuperadminKejuaraanUpdate;

use App\Models\Kejuaraan;
use App\Models\KejuaraanBerkas;
use App\Models\KejuaraanUnduhan;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\Layout;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\WithFileUploads;

class SuperadminKejuaraanUpdateLampiran extends Component
{
    use WithFileUploads;
    #[Layout('layouts.admin')]
    public $kejuaraan, $kejuaraanUnduhans, $kejuaraanBerkass, $unduhanId;
    public $no, $nama, $fileUpload, $required, $mimes;
    public $isSubmitting = false, $isModalOpen = false, $modalStatus;
    public function mount(Kejuaraan $kejuaraan)
    {
        $this->kejuaraan = $kejuaraan;
        $this->kejuaraanUnduhans = $kejuaraan->kejuaraanUnduhans;
        $this->kejuaraanBerkass = $kejuaraan->kejuaraanBerkass;
    }

    public function render()
    {
        return view('livewire.superadmin.superadmin-kejuaraan-update.superadmin-kejuaraan-update-lampiran')->layoutData(['superadminKejuaraan' => 'active']);
    }

    public function openModalTambahUnduhan()
    {
        $this->modalStatus = 'unduhan';
        $this->isModalOpen = true;
        $this->resetFields();
    }

    public function openModalTambahLampiran()
    {
        $this->modalStatus = 'lampiran';
        $this->isModalOpen = true;
        $this->resetFields();
    }

    public function closeModal()
    {
        $this->isModalOpen = false;
        $this->resetFields();
    }

    public function resetFields()
    {
        $this->nama = null;
        $this->fileUpload = null;
    }

    public function createUnduhan()
    {
        try {
            $this->validate([
                'no' => 'required|integer',
                'nama' => 'required|string|max:255',
                'fileUpload' => 'required|file|max:5120', // Maksimal 5MB
            ]);
        } catch (\Throwable $th) {
            $this->dispatch('swal', [
                'title' => 'Warning!',
                'text' => $th->getMessage(),
                'icon' => 'warning',
            ]);
            $this->validate([
                'no' => 'required|integer',
                'nama' => 'required|string|max:255',
                'fileUpload' => 'required|file|max:5120', // Maksimal 5MB
            ]);
        }

        $this->isSubmitting = true;

        if ($this->fileUpload) {
            $ekstensi = $this->fileUpload->getClientOriginalExtension();
            $file_path = 'kejuaraan/unduhan';
            $file_name = Carbon::now()->timestamp . '.' . $ekstensi;
            Storage::disk('s3')->putFileAs($file_path, $this->fileUpload, $file_name);
            $buktiPath = $file_path . '/' . $file_name;
        }

        KejuaraanUnduhan::create([
            'kejuaraans_id' => $this->kejuaraan->id,
            'no' => $this->no,
            'nama' => $this->nama,
            'path_file' => $buktiPath,
        ]);
        $this->isSubmitting = false;
        $this->closeModal();
        $this->kejuaraanUnduhans = $this->kejuaraan->kejuaraanUnduhans; // Refresh daftar unduhan
        
        $this->dispatch('swal', [
            'title' => 'Berhasil!',
            'text' => 'Data berhasil disimpan.',
            'icon' => 'success',
        ]);
    }

    public function confirmDeleteUnduhan($id)
    {
        $this->unduhanId = $id;
        $unduhan = KejuaraanUnduhan::find($id);

        $this->dispatch('swal-delete', [
            'title' => 'Warning',
            'text' => 'Apakah Kamu Yakin Ingin Menghapus ' . $unduhan->nama,
            'icon' => 'warning',
            'dispatchOn' => 'deleteUnduhan',
        ]);
    }

    #[On('deleteUnduhan')]
    public function deleteUnduhan()
    {
        $unduhan = KejuaraanUnduhan::find($this->unduhanId);
        $nama = $unduhan->nama;
        $unduhan->delete();

        $this->dispatch('swal-notif', [
            'title' => 'Success',
            'text' => 'Berhasil menghapus ' . $nama,
            'icon' => 'success'
        ]);
        $this->unduhanId = null;
        $this->kejuaraanUnduhans = $this->kejuaraan->kejuaraanUnduhans; // Refresh daftar unduhan
    }
    
    public function createBerkas()
    {
        try {
            $this->validate([
                'no' => 'required|integer',
                'nama' => 'required|string|max:255',
                'required' => 'required|in:0,1',
                'mimes' => 'required|string',
            ]);
        } catch (\Throwable $th) {
            $this->dispatch('swal', [
                'title' => 'Warning!',
                'text' => $th->getMessage(),
                'icon' => 'warning',
            ]);
            $this->validate([
                'no' => 'required|integer',
                'nama' => 'required|string|max:255',
                'required' => 'required|in:0,1',
                'mimes' => 'required|string',
            ]);
        }

        $this->isSubmitting = true;

        KejuaraanBerkas::create([
            'kejuaraans_id' => $this->kejuaraan->id,
            'no' => $this->no,
            'nama' => $this->nama,
            'required' => $this->required,
            'mimes' => $this->mimes,
        ]);
        $this->isSubmitting = false;
        $this->closeModal();
        $this->kejuaraanBerkass = $this->kejuaraan->kejuaraanBerkass; // Refresh daftar unduhan
        
        $this->dispatch('swal', [
            'title' => 'Berhasil!',
            'text' => 'Data berhasil disimpan.',
            'icon' => 'success',
        ]);
    }

    public function confirmDeleteBerkas($id)
    {
        $this->unduhanId = $id;
        $unduhan = KejuaraanBerkas::find($id);

        $this->dispatch('swal-delete', [
            'title' => 'Warning',
            'text' => 'Apakah Kamu Yakin Ingin Menghapus ' . $unduhan->nama,
            'icon' => 'warning',
            'dispatchOn' => 'deleteBerkas',
        ]);
    }

    #[On('deleteBerkas')]
    public function deleteBerkas()
    {
        $unduhan = KejuaraanBerkas::find($this->unduhanId);
        $nama = $unduhan->nama;
        $unduhan->delete();

        $this->dispatch('swal-notif', [
            'title' => 'Success',
            'text' => 'Berhasil menghapus ' . $nama,
            'icon' => 'success'
        ]);
        $this->unduhanId = null;
        $this->kejuaraanBerkass = $this->kejuaraan->kejuaraanBerkass; // Refresh daftar unduhan
    }
}
