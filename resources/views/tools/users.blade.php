@extends('layouts.vertical', ['title' => 'Management User'])

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

    <div class="py-3 d-flex align-items-sm-center flex-sm-row flex-column">
        <div class="flex-grow-1">
            {{-- <h4 class="fs-18 fw-semibold m-0">Data Tables</h4> --}}
        </div>

       
    </div>

<div class="row">
        <div class="col-12">
            <div class="card">
               <div class="card-header d-flex justify-content-between align-items-center">
    <h5 class="card-title mb-0">Management User</h5>
    <a href="{{ route('users.create') }}" class="btn btn-primary">Tambah Data User</a>
</div>
    <div class="card-body table-responsive">
    @if (session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

@if (session('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        {{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

@if ($errors->any())
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Periksa kembali:</strong>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

    <table id="fixed-header-datatable" class="table table-striped dt-responsive nowrap table-striped w-100">
    <thead>
        <tr>
            <th>No</th>
            <th>ID Petugas</th>
            <th>Username</th>
            <th>Nama Petugas</th>
            <th>NIP</th>
            <th>Otoritas</th>
            <th>Status</th>
            <th>Action</th> 
        </tr>
    </thead>
    <tbody>
    @if($users->isEmpty())
    <tr>
        <td colspan="8" class="text-center">Tidak ada data pengguna.</td>
    </tr>
    @else
        @foreach($users as $index => $user)
        <tr>
            <td>{{ $index + 1 }}</td>
            <td>{{ $user->id_admin }}</td>
            <td>{{ $user->name }}</td>
            <td>{{ $user->nama_admin }}</td>
            <td>{{ $user->nip }}</td>
            <td>{{ $user->otoritas }}</td>
            <td>
    <div class="form-check form-switch mb-2">
        <input class="form-check-input status-toggle" type="checkbox" role="switch" id="flexSwitchCheck{{ $user->id }}" data-id="{{ $user->id }}" {{ $user->status === 'AKTIF' ? 'checked' : '' }}>
    </div>
</td>


            <td>
                <a href="{{ route('users.edit', $user->id_admin) }}" class="btn btn-warning btn-sm">Edit</a>
                <form action="{{ route('users.destroy', $user->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this user?')">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
        @endif
    </tbody>
</table>

                </div>
            </div>
        </div>
    </div>

    <!-- Fixed Header Datatable -->
    
</div> <!-- container-fluid -->

<script>
    document.addEventListener("DOMContentLoaded", function () {
        const toggles = document.querySelectorAll(".status-toggle");

        toggles.forEach(toggle => {
            toggle.addEventListener("change", function () {
                const userId = this.getAttribute("data-id");
                const newStatus = this.checked ? 'AKTIF' : 'NON-AKTIF';

                fetch(`/tools/users/toggle-status/${userId}`, {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": "{{ csrf_token() }}" // CSRF token untuk keamanan
                    },
                    body: JSON.stringify({ status: newStatus })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        alert(`Status berhasil diubah menjadi ${newStatus}`);
                    } else {
                        alert("Terjadi kesalahan, silakan coba lagi.");
                    }
                })
                .catch(error => console.error("Error:", error));
            });
        });
    });
</script>



@endsection

@section('script')
    @vite([ 'resources/js/pages/datatable.init.js'])
@endsection