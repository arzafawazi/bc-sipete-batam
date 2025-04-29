@extends('layouts.vertical', ['title' => 'Edit User'])

@section('css')
    @vite([
        'node_modules/datatables.net-bs5/css/dataTables.bootstrap5.min.css',
        'node_modules/datatables.net-buttons-bs5/css/buttons.bootstrap5.min.css',
        'node_modules/datatables.net-keytable-bs5/css/keyTable.bootstrap5.min.css',
        'node_modules/datatables.net-responsive-bs5/css/responsive.bootstrap5.min.css',
        'node_modules/datatables.net-select-bs5/css/select.bootstrap5.min.css'
    ])
@endsection

@section('content')
<div class="container-fluid">
    <!-- Card Container -->
    <div class="card mb-3 mt-4">
        <div class="card-header">
            <h5 class="card-title mb-0">
                <i data-feather="user" style="width: 20px; height: 20px;" class="me-1"></i>Form Edit User
            </h5>
        </div>

        <form action="{{ route('users.update', $user->id_admin) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="bg-primary text-white p-2 mb-3">1. DETIL PENGGUNA</div>
                        <div class="row mb-3">
                            <label class="col-md-3 col-form-label">Nama Petugas</label>
                            <div class="col-md-9">
                                <input type="text" class="form-control bg-light" name="nama_admin" value="{{ old('nama_admin', $user->nama_admin) }}" required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-md-3 col-form-label">NIP</label>
                            <div class="col-md-9">
                                <input type="text" class="form-control bg-light" name="nip" value="{{ old('nip', $user->nip) }}" required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-md-3 col-form-label">Pangkat</label>
                            <div class="col-md-9">
                                <input type="text" class="form-control bg-light" name="pangkat" value="{{ old('pangkat', $user->pangkat) }}">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-md-3 col-form-label">Jabatan</label>
                            <div class="col-md-9">
                                <input type="text" class="form-control bg-light" name="jabatan" value="{{ old('jabatan', $user->jabatan) }}">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-md-3 col-form-label">Otoritas</label>
                            <div class="col-md-9">
                                <select class="form-select bg-light" name="otoritas" required>
                                    <option value="" disabled>Pilih Otoritas</option>
                                    <option value="ANALIS" {{ $user->otoritas == 'ANALIS' ? 'selected' : '' }}>ANALIS</option>
                                    <option value="KA. KANTOR" {{ $user->otoritas == 'KA. KANTOR' ? 'selected' : '' }}>KA. KANTOR</option>
                                    <option value="KA. SEKSI" {{ $user->otoritas == 'KA. SEKSI' ? 'selected' : '' }}>KA. SEKSI</option>
                                    <option value="KA. I" {{ $user->otoritas == 'KA. I' ? 'selected' : '' }}>KA. I</option>
                                    <option value="KASUBSI" {{ $user->otoritas == 'KASUBSI' ? 'selected' : '' }}>KASUBSI</option>
                                    <option value="PEMERIKSA" {{ $user->otoritas == 'PEMERIKSA' ? 'selected' : '' }}>PEMERIKSA</option>
                                    <option value="PABEAN" {{ $user->otoritas == 'PABEAN' ? 'selected' : '' }}>PABEAN</option>
                                    <option value="ADMIN" {{ $user->otoritas == 'ADMIN' ? 'selected' : '' }}>ADMIN</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="bg-primary text-white p-2 mb-3">2. DETIL AKUN</div>
                        <div class="row mb-3">
                            <label class="col-md-3 col-form-label">Username</label>
                            <div class="col-md-9">
                                <input type="text" class="form-control bg-light" name="name" value="{{ old('name', $user->name) }}" required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-md-3 col-form-label">Password</label>
                            <div class="col-md-9">
                                <input type="password" class="form-control bg-light" id="password" oninput="validatePasswords()" value="{{ old('name', $user->password) }}">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-md-3 col-form-label">Konfirmasi Password</label>
                            <div class="col-md-9">
                                <input type="password" class="form-control bg-light" id="password_confirmation" oninput="validatePasswords()" value="{{ old('password', $user->password) }}">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-9 offset-md-3">
                                <div id="password-message" class="alert alert-danger" style="display: none;"></div>
                            </div>
                        </div>
                    </div>
                </div>

                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                @if (session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="bg-primary text-white p-2 mb-3 text-center">3. HAK AKSES MENU</div>
                <div class="card-body table-responsive">
                    <table class="table table-striped dt-responsive nowrap table-striped w-100">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Menu Utama</th>
                                <th>Hak Akses</th>
                                <th>Sub Menu</th>
                            </tr>
                        </thead>
                  @foreach ($menuItems as $index => $menu)
    <tr>
        <td>{{ $index + 1 }}</td>
        <td>{{ $menu->uraian_menu }}</td>
        <td>
            <select name="akses[{{ $menu->kode }}]" class="form-select" onchange="toggleSubMenu('{{ $menu->kode }}', this.value)">
                <option value="NO" {{ isset($accessStatus[$menu->kode]) && $accessStatus[$menu->kode] == 'NO' ? 'selected' : '' }}>NO</option>
                <option value="YES" {{ isset($accessStatus[$menu->kode]) && $accessStatus[$menu->kode] == 'YES' ? 'selected' : '' }}>YES</option>
            </select>
        </td>
        <td>
            @if($menu->sub->isNotEmpty())
                <div id="sub-menu-{{ $menu->kode }}" class="sub-menu" style="{{ isset($accessStatus[$menu->kode]) && $accessStatus[$menu->kode] == 'YES' ? 'display: block;' : 'display: none;' }}">
                    <table class="table">
                        <tbody>
                            @foreach ($menu->sub as $subMenu)
                                <tr>
                                    <td>{{ $subMenu->uraian_menu }}</td>
                                    <td class="w-50">
                                        <select name="akses[{{ $subMenu->kode }}]" class="form-select w-100">
                                            <option value="NO" {{ isset($accessStatus[$subMenu->kode]) && $accessStatus[$subMenu->kode] == 'NO' ? 'selected' : '' }}>NO</option>
                                            <option value="YES" {{ isset($accessStatus[$subMenu->kode]) && $accessStatus[$subMenu->kode] == 'YES' ? 'selected' : '' }}>YES</option>
                                        </select>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </td>
    </tr>
@endforeach
                    </table>
                </div>
                <div class="d-flex justify-content-between align-items-center mt-3">
                <div>
                    <a href="{{ url()->previous() }}" class="btn btn-danger">
                        <i data-feather="arrow-left" height="20" width="20"></i>&nbsp; Kembali
                    </a>
                </div>
                <div>
                    <button type="submit" class="btn btn-primary">
                    <i data-feather="file" height="20" width="20"></i> &nbsp;Simpan Perubahan</button>
                </div>
            </div>
            </div>
        </form>
    </div>
</div>
<!-- container-fluid -->

<script>
function validatePasswords() {
    // Ambil nilai dari input password dan konfirmasi password
    var password = document.getElementById("password").value;
    var confirmPassword = document.getElementById("password_confirmation").value;
    var messageElement = document.getElementById("password-message");

    // Periksa apakah password dan konfirmasi password cocok
    if (password !== confirmPassword) {
        // Jika tidak cocok, tampilkan pesan kesalahan
        messageElement.textContent = "Passwords do not match.";
        messageElement.style.display = "block"; // Tampilkan pesan
    } else {
        // Jika cocok, sembunyikan pesan kesalahan
        messageElement.style.display = "none"; // Sembunyikan pesan
    }
}
</script>

<script>
function toggleSubMenu(menuKode, selectedValue) {
    const subMenu = document.getElementById(`sub-menu-${menuKode}`);
    if (selectedValue === 'YES') {
        subMenu.style.display = 'block'; // Show submenu
    } else {
        subMenu.style.display = 'none'; // Hide submenu
    }
}
</script>

@endsection
