<?php

namespace App\Livewire\Superadmin;

use App\Models\RefGolongan;
use App\Models\RefKategori;
use App\Models\RefRegulasi;
use Illuminate\Support\Facades\View;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Layout;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

class SuperadminManajemenRefKategori extends Component
{
    use WithPagination;

    #[Layout('layouts.admin')]

    public $search = '';
    public $filterGolongan = '';
    public $filterRegulasi = '';
    public $perPage = 10;

    public $isModalOpen = false;
    public $isEditMode = false;

    public $kategoriId;
    public $namaKategori = '';
    public $cabang = '';
    public $jenis = '';
    public $bobot = '';
    public $golongansId = '';
    public $regulasisId = '';

    protected $queryString = [
        'search' => ['except' => ''],
        'filterGolongan' => ['except' => ''],
        'filterRegulasi' => ['except' => ''],
    ];

    protected function rules()
    {
        $bobot = $this->normalizeNullableValue($this->bobot);

        return [
            'namaKategori' => [
                'required',
                'string',
                'max:255',
                Rule::unique('ref_kategoris', 'nama_kategori')
                    ->ignore($this->kategoriId)
                    ->where(function ($query) use ($bobot) {
                        $query->where('golongans_id', $this->golongansId)
                            ->where('regulasis_id', $this->regulasisId)
                            ->where('cabang', $this->cabang)
                            ->where('jenis', $this->jenis);

                        if ($bobot === null) {
                            $query->whereNull('bobot');
                        } else {
                            $query->where('bobot', $bobot);
                        }
                    }),
            ],
            'cabang' => ['required', Rule::in($this->cabangOptions())],
            'jenis' => ['required', Rule::in($this->jenisOptions())],
            'bobot' => ['nullable', 'string', 'max:255'],
            'golongansId' => ['required', 'exists:ref_golongans,id'],
            'regulasisId' => ['required', 'exists:ref_regulasis,id'],
        ];
    }

    protected $messages = [
        'namaKategori.required' => 'Nama kategori wajib diisi.',
        'namaKategori.unique' => 'Ref kategori dengan kombinasi data tersebut sudah ada.',
        'cabang.required' => 'Cabang wajib dipilih.',
        'jenis.required' => 'Jenis wajib dipilih.',
        'golongansId.required' => 'Golongan wajib dipilih.',
        'golongansId.exists' => 'Golongan tidak valid.',
        'regulasisId.required' => 'Regulasi wajib dipilih.',
        'regulasisId.exists' => 'Regulasi tidak valid.',
    ];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingFilterGolongan()
    {
        $this->resetPage();
    }

    public function updatingFilterRegulasi()
    {
        $this->resetPage();
    }

    public function updatingPerPage()
    {
        $this->resetPage();
    }

    public function openCreateModal()
    {
        $this->resetForm();
        $this->isEditMode = false;
        $this->isModalOpen = true;
    }

    public function openEditModal($id)
    {
        $kategori = RefKategori::findOrFail($id);

        $this->resetForm();
        $this->kategoriId = $kategori->id;
        $this->namaKategori = $kategori->nama_kategori;
        $this->cabang = $kategori->cabang;
        $this->jenis = $kategori->jenis;
        $this->bobot = $kategori->bobot ?? '';
        $this->golongansId = (string) $kategori->golongans_id;
        $this->regulasisId = (string) $kategori->regulasis_id;
        $this->isEditMode = true;
        $this->isModalOpen = true;
    }

    public function saveKategori()
    {
        $payload = $this->validatedPayload();

        if ($this->isEditMode) {
            $kategori = RefKategori::findOrFail($this->kategoriId);
            $kategori->update($payload);

            $message = 'Berhasil mengupdate ref kategori ' . $kategori->nama_kategori;
        } else {
            $kategori = RefKategori::create($payload);

            $message = 'Berhasil menambahkan ref kategori ' . $kategori->nama_kategori;
        }

        $this->closeModal();

        $this->dispatch('swal-notif', [
            'title' => 'Success',
            'text' => $message,
            'icon' => 'success',
        ]);
    }

    public function closeModal()
    {
        $this->isModalOpen = false;
        $this->resetForm();
    }

    public function confirmDelete($id)
    {
        $this->kategoriId = $id;
        $kategori = RefKategori::findOrFail($id);

        $this->dispatch('swal-delete', [
            'title' => 'Warning',
            'text' => 'Apakah Kamu Yakin Ingin Menghapus ref kategori ' . $kategori->nama_kategori . '?',
            'icon' => 'warning',
            'dispatchOn' => 'deleteKategori',
        ]);
    }

    #[On('deleteKategori')]
    public function deleteKategori()
    {
        $kategori = RefKategori::withCount(['kejuaraanKategori', 'atlets'])->findOrFail($this->kategoriId);

        if ($kategori->kejuaraan_kategori_count > 0 || $kategori->atlets_count > 0) {
            $this->dispatch('swal-notif', [
                'title' => 'Warning',
                'text' => 'Ref kategori ' . $kategori->nama_kategori . ' masih dipakai dan tidak dapat dihapus.',
                'icon' => 'warning',
            ]);

            $this->kategoriId = null;

            return;
        }

        $namaKategori = $kategori->nama_kategori;
        $kategori->delete();

        $this->dispatch('swal-notif', [
            'title' => 'Success',
            'text' => 'Berhasil menghapus ref kategori ' . $namaKategori,
            'icon' => 'success',
        ]);

        $this->kategoriId = null;
        $this->resetPageAfterDeletion();
    }

    public function cabangOptions()
    {
        return ['tanding', 'tunggal', 'ganda', 'beregu', 'solo'];
    }

    public function jenisOptions()
    {
        return ['prestasi', 'pemasalan'];
    }

    public function render()
    {
        View::share('superadminRefKategori', 'active');

        $golongans = RefGolongan::query()->orderBy('nama')->get(['id', 'nama']);
        $regulasis = RefRegulasi::query()->orderBy('nama')->get(['id', 'nama']);

        $kategoris = RefKategori::query()
            ->with(['refGolongan:id,nama', 'refRegulasi:id,nama'])
            ->withCount(['kejuaraanKategori', 'atlets'])
            ->when($this->search, function ($query) {
                $query->where(function ($nestedQuery) {
                    $nestedQuery->where('nama_kategori', 'like', '%' . $this->search . '%')
                        ->orWhere('cabang', 'like', '%' . $this->search . '%')
                        ->orWhere('jenis', 'like', '%' . $this->search . '%')
                        ->orWhere('bobot', 'like', '%' . $this->search . '%');
                });
            })
            ->when($this->filterGolongan, function ($query) {
                $query->where('golongans_id', $this->filterGolongan);
            })
            ->when($this->filterRegulasi, function ($query) {
                $query->where('regulasis_id', $this->filterRegulasi);
            })
            ->orderBy('nama_kategori')
            ->paginate($this->perPage);

        return view('livewire.superadmin.superadmin-manajemen-ref-kategori', [
            'kategoris' => $kategoris,
            'golongans' => $golongans,
            'regulasis' => $regulasis,
            'cabangOptions' => $this->cabangOptions(),
            'jenisOptions' => $this->jenisOptions(),
        ]);
    }

    protected function validatedPayload()
    {
        $this->normalizeForm();
        $this->validate();

        return [
            'nama_kategori' => $this->namaKategori,
            'cabang' => $this->cabang,
            'jenis' => $this->jenis,
            'bobot' => $this->normalizeNullableValue($this->bobot),
            'golongans_id' => (int) $this->golongansId,
            'regulasis_id' => (int) $this->regulasisId,
        ];
    }

    protected function normalizeForm()
    {
        $this->namaKategori = trim((string) $this->namaKategori);
        $this->cabang = trim((string) $this->cabang);
        $this->jenis = trim((string) $this->jenis);
        $this->bobot = $this->normalizeNullableValue($this->bobot) ?? '';
        $this->golongansId = $this->golongansId === null ? '' : (string) $this->golongansId;
        $this->regulasisId = $this->regulasisId === null ? '' : (string) $this->regulasisId;
    }

    protected function normalizeNullableValue($value)
    {
        if ($value === null) {
            return null;
        }

        $value = trim((string) $value);

        return $value === '' ? null : $value;
    }

    protected function resetForm()
    {
        $this->resetErrorBag();
        $this->resetValidation();

        $this->kategoriId = null;
        $this->namaKategori = '';
        $this->cabang = '';
        $this->jenis = '';
        $this->bobot = '';
        $this->golongansId = '';
        $this->regulasisId = '';
        $this->isEditMode = false;
    }

    protected function resetPageAfterDeletion()
    {
        if ($this->getPage() > 1 && ! RefKategori::query()
            ->when($this->search, function ($query) {
                $query->where(function ($nestedQuery) {
                    $nestedQuery->where('nama_kategori', 'like', '%' . $this->search . '%')
                        ->orWhere('cabang', 'like', '%' . $this->search . '%')
                        ->orWhere('jenis', 'like', '%' . $this->search . '%')
                        ->orWhere('bobot', 'like', '%' . $this->search . '%');
                });
            })
            ->when($this->filterGolongan, function ($query) {
                $query->where('golongans_id', $this->filterGolongan);
            })
            ->when($this->filterRegulasi, function ($query) {
                $query->where('regulasis_id', $this->filterRegulasi);
            })
            ->forPage($this->getPage(), $this->perPage)
            ->exists()) {
            $this->previousPage();
        }
    }
}