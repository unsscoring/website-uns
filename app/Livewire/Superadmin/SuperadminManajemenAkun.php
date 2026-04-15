<?php

namespace App\Livewire\Superadmin;

use App\Models\Kejuaraan;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Attributes\Layout;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;
use Spatie\Permission\Models\Role;

class SuperadminManajemenAkun extends Component
{
    use WithPagination;

    #[Layout('layouts.admin')]
    
    // Search & Filter
    public $search = '';
    public $filterRole = '';
    public $perPage = 10;

    // Modal States
    public $isCreateModalOpen = false;
    public $isEditModalOpen = false;
    public $isDetailModalOpen = false;
    public $isPasswordModalOpen = false;

    // Form Fields
    public $userId;
    public $name;
    public $email;
    public $password;
    public $password_confirmation;
    public $selectedRole;
    public $selectedKejuaraans = [];

    // Detail View
    public $selectedUser;
    public $userKontingens = [];
    public $userKejuaraans = [];

    protected $queryString = [
        'search' => ['except' => ''],
        'filterRole' => ['except' => ''],
    ];

    protected function rules()
    {
        $rules = [
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'selectedRole' => 'required|exists:roles,name',
        ];

        if ($this->isCreateModalOpen) {
            $rules['email'] .= '|unique:users,email';
            $rules['password'] = 'required|string|min:8|confirmed';
        } else if ($this->isEditModalOpen) {
            $rules['email'] .= '|unique:users,email,' . $this->userId;
        }

        if ($this->selectedRole === 'admin') {
            $rules['selectedKejuaraans'] = 'required|array|min:1';
            $rules['selectedKejuaraans.*'] = 'exists:kejuaraans,id';
        }

        return $rules;
    }

    protected $messages = [
        'name.required' => 'Nama wajib diisi.',
        'email.required' => 'Email wajib diisi.',
        'email.email' => 'Format email tidak valid.',
        'email.unique' => 'Email sudah digunakan.',
        'password.required' => 'Password wajib diisi.',
        'password.min' => 'Password minimal 8 karakter.',
        'password.confirmed' => 'Konfirmasi password tidak cocok.',
        'selectedRole.required' => 'Role wajib dipilih.',
        'selectedKejuaraans.required' => 'Pilih minimal satu kejuaraan untuk admin.',
        'selectedKejuaraans.min' => 'Pilih minimal satu kejuaraan untuk admin.',
    ];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingFilterRole()
    {
        $this->resetPage();
    }

    public function updatingPerPage()
    {
        $this->resetPage();
    }

    public function render()
    {
        $roles = Role::pluck('name')->toArray();
        $kejuaraans = Kejuaraan::select('id', 'nama_kejuaraan')->orderBy('nama_kejuaraan')->get();

        $users = User::query()
            ->when($this->search, function ($query) {
                $query->where(function ($q) {
                    $q->where('name', 'like', '%' . $this->search . '%')
                      ->orWhere('email', 'like', '%' . $this->search . '%');
                });
            })
            ->when($this->filterRole, function ($query) {
                $query->whereHas('roles', function ($q) {
                    $q->where('name', $this->filterRole);
                });
            })
            ->with(['roles', 'kejuaraans:kejuaraans.id,kejuaraans.nama_kejuaraan'])
            ->latest()
            ->paginate($this->perPage);

        return view('livewire.superadmin.superadmin-manajemen-akun', [
            'users' => $users,
            'roles' => $roles,
            'kejuaraans' => $kejuaraans,
        ])->layoutData(['superadminManajemenAkun' => 'active']);
    }

    // Create User
    public function openCreateModal()
    {
        $this->resetForm();
        $this->isCreateModalOpen = true;
    }

    public function createUser()
    {
        $this->validate();

        $user = User::create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => Hash::make($this->password),
        ]);

        $user->assignRole($this->selectedRole);

        // Sync kejuaraan assignments for admin role
        if ($this->selectedRole === 'admin') {
            $user->kejuaraans()->sync($this->selectedKejuaraans);
        }

        $this->isCreateModalOpen = false;
        $this->resetForm();

        $this->dispatch('swal-notif', [
            'title' => 'Success',
            'text' => 'Berhasil menambahkan akun ' . $user->name,
            'icon' => 'success'
        ]);
    }

    // Edit User
    public function openEditModal($id)
    {
        $this->resetForm();
        $user = User::with(['roles', 'kejuaraans'])->findOrFail($id);
        
        $this->userId = $user->id;
        $this->name = $user->name;
        $this->email = $user->email;
        $this->selectedRole = $user->roles->first()?->name ?? '';
        $this->selectedKejuaraans = $user->kejuaraans->pluck('id')->toArray();
        
        $this->isEditModalOpen = true;
    }

    public function updateUser()
    {
        $this->validate();

        $user = User::findOrFail($this->userId);
        $user->update([
            'name' => $this->name,
            'email' => $this->email,
        ]);

        // Sync role
        $user->syncRoles([$this->selectedRole]);

        // Sync kejuaraan assignments for admin role, clear for other roles
        if ($this->selectedRole === 'admin') {
            $user->kejuaraans()->sync($this->selectedKejuaraans);
        } else {
            $user->kejuaraans()->detach();
        }

        $this->isEditModalOpen = false;
        $this->resetForm();

        $this->dispatch('swal-notif', [
            'title' => 'Success',
            'text' => 'Berhasil mengupdate akun ' . $user->name,
            'icon' => 'success'
        ]);
    }

    // Delete User
    public function confirmDelete($id)
    {
        $this->userId = $id;
        $user = User::find($id);

        $this->dispatch('swal-delete', [
            'title' => 'Warning',
            'text' => 'Apakah Kamu Yakin Ingin Menghapus akun ' . $user->name . '?',
            'icon' => 'warning',
            'dispatchOn' => 'deleteUser'
        ]);
    }

    #[On('deleteUser')]
    public function deleteUser()
    {
        $user = User::find($this->userId);
        
        if ($user) {
            $nama = $user->name;
            
            // Hapus relasi
            $user->kontingens()->delete();
            $user->kejuaraans()->detach();
            $user->roles()->detach();
            $user->delete();

            $this->dispatch('swal-notif', [
                'title' => 'Success',
                'text' => 'Berhasil menghapus akun ' . $nama,
                'icon' => 'success'
            ]);
        }
    }

    // Change Password
    public function openPasswordModal($id)
    {
        $this->resetForm();
        $this->userId = $id;
        $this->isPasswordModalOpen = true;
    }

    public function updatePassword()
    {
        $this->validate([
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = User::findOrFail($this->userId);
        $user->update([
            'password' => Hash::make($this->password),
        ]);

        $this->isPasswordModalOpen = false;
        $this->resetForm();

        $this->dispatch('swal-notif', [
            'title' => 'Success',
            'text' => 'Berhasil mengubah password akun ' . $user->name,
            'icon' => 'success'
        ]);
    }

    // View Detail (Kontingen & Kejuaraan)
    public function openDetailModal($id)
    {
        $this->selectedUser = User::with(['roles', 'kejuaraans'])->findOrFail($id);
        
        // Lazy load kontingen dengan pagination-like limit untuk performa
        $this->userKontingens = $this->selectedUser->kontingens()
            ->with(['kejuaraan:id,nama_kejuaraan', 'statusPembayaran:id,nama'])
            ->latest('kontingens.created_at')
            ->limit(50)
            ->get();
        
        // Lazy load kejuaraan yang diikuti
        $this->userKejuaraans = $this->selectedUser->kejuaraans()
            ->select('kejuaraans.id', 'kejuaraans.nama_kejuaraan', 'kejuaraans.penyelenggara', 'kejuaraans.active')
            ->latest('kejuaraans.created_at')
            ->limit(50)
            ->get();

        $this->isDetailModalOpen = true;
    }

    public function closeDetailModal()
    {
        $this->isDetailModalOpen = false;
        $this->selectedUser = null;
        $this->userKontingens = [];
        $this->userKejuaraans = [];
    }

    // Helper Methods
    public function resetForm()
    {
        $this->userId = null;
        $this->name = '';
        $this->email = '';
        $this->password = '';
        $this->password_confirmation = '';
        $this->selectedRole = '';
        $this->selectedKejuaraans = [];
        $this->resetValidation();
    }

    public function closeModals()
    {
        $this->isCreateModalOpen = false;
        $this->isEditModalOpen = false;
        $this->isDetailModalOpen = false;
        $this->isPasswordModalOpen = false;
        $this->resetForm();
    }
}
