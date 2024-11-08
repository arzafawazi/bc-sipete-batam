@extends('layouts.vertical', ['title' => 'Tambah User'])

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
            <h5 class="card-title mb-0"> <i data-feather="user" style="width: 20px; height: 20px;" class="me-1"></i>Form Tambah User</h5>
        </div>

         <div class="card-header">
        <div class="row">
            <div class="col-md-6">
            <form action="{{ route('users.store') }}" method="POST">
                @csrf
                <div class="bg-primary text-white p-2 mb-3">1. DETIL PENGGUNA</div>
                <div class="row mb-3">
                    <label class="col-md-3 col-form-label">Nama Petugas</label>
                    <div class="col-md-9">
                        <input type="text" class="form-control bg-light" name="nama_admin">
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-md-3 col-form-label">NIP</label>
                    <div class="col-md-9">
                        <input type="text" class="form-control bg-light" name="nip">
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-md-3 col-form-label">Pangkat</label>
                    <div class="col-md-9">
                        <input type="text" class="form-control bg-light" name="pangkat">
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-md-3 col-form-label">Jabatan</label>
                    <div class="col-md-9">
                        <input type="text" class="form-control bg-light" name="jabatan">
                    </div>
                </div>
                <div class="row mb-3">
    <label class="col-md-3 col-form-label">Otoritas</label>
    <div class="col-md-9">
       <select class="form-select bg-light" name="otoritas">
    <option value="" disabled selected>Pilih Otoritas</option>
    <option value="ANALIS">ANALIS</option>
    <option value="KA. KANTOR">KA. KANTOR</option>
    <option value="KA. SEKSI">KA. SEKSI</option>
    <option value="KA. I">KA. I</option>
    <option value="KASUBSI">KASUBSI</option>
    <option value="PERBEN">PERBEN</option>
    <option value="PABEAN">PABEAN</option>
    <option value="ADMIN">ADMIN</option>
</select>

    </div>
</div>

            </div>
            <div class="col-md-6">
                <div class="bg-primary text-white p-2 mb-3">2. DETIL AKUN</div>
                <div class="row mb-3">
                    <label class="col-md-3 col-form-label">Username</label>
                    <div class="col-md-9">
                        <input type="text" class="form-control bg-light" name="name" >
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-md-3 col-form-label">Password</label>
                    <div class="col-md-9">
                        <input type="text" class="form-control bg-light" name="password" id="password" value="" >
                    </div>
                </div>
            </div>
        </div>
    

    </div>

    @if(session('error'))
    <div class="alert alert-danger">{{ session('error') }}</div>
@endif
@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

    <div class="card-header">
     <div class="col-md-12">
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
            <tbody>
            @foreach ($menus as $index => $menu)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $menu->uraian_menu }}</td>
                <td>
                    <select name="akses[{{ $menu->kode }}]" class="form-select" onchange="toggleSubMenu('{{ $menu->kode }}', this.value)">
                        <option value="NO" selected>NO</option>
                        <option value="YES">YES</option>
                    </select>
                </td>
                <td>
                    @if($menu->sub->isNotEmpty())
                        <div id="sub-menu-{{ $menu->kode }}" class="sub-menu" style="display: none;">
                            <table class="table">
                                <tbody>
                                    @foreach ($menu->sub as $subMenu)
                                    <tr>
                                        <td>{{ $subMenu->uraian_menu }}</td>
                                        <td class="w-50">
                                            <select name="akses[{{ $subMenu->kode }}]" class="form-select w-100">
                                                <option value="NO" selected>NO</option>
                                                <option value="YES">YES</option>
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
            </tbody>
        </table>




<div class="d-flex justify-content-between align-items-center">
        <div>
            <a href="{{ url()->previous() }}" class="btn btn-danger">
                <i data-feather="arrow-left" height="15" width="15"></i> Kembali
            </a>
        </div>
        <div>
            <button type="submit" class="btn btn-primary">
                <i data-feather="check" height="15" width="15"></i> Submit
            </button>
        </div>
</div>
</div>

     </div>
    </div>  
</div>
</div>
</form>
 <!-- container-fluid -->

<script>
        function generateRandomPassword(length) {
            const characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789!@#$%^&*()_+';
            let result = '';
            for (let i = 0; i < length; i++) {
                result += characters.charAt(Math.floor(Math.random() * characters.length));
            }
            return result;
        }

        // Set the password input value to a random password of length 12
        document.getElementById('password').value = generateRandomPassword(12);
    </script>

<script>
    function toggleSubMenu(menuCode, value) {
        var subMenu = document.getElementById('sub-menu-' + menuCode);
        if (value === 'YES') {
            subMenu.style.display = 'block';
        } else {
            subMenu.style.display = 'none';
        }
    }
</script>

@endsection

@section('script')
    @vite([ 'resources/js/pages/datatable.init.js'])
@endsection