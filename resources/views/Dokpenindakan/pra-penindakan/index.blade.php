@extends('layouts.vertical', ['title' => 'Laporan Pra Penindakan'])

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
    <!-- Search Form Section -->
    <div class="card mb-3 mt-4">
        <div class="card-header">
            <h5 class="card-title mb-0">PRA-PENINDAKAN</h5>
        </div>
        <div class="card-body">
            <form method="GET" >
                <div class="row">
                    <!-- Periode -->
                    <div class="col-md-4 mb-3">
                        <label>Periode:</label>
                        <div class="input-group">
                            <input type="date" class="form-control" name="start_date">
                            <span class="input-group-text">s.d</span>
                            <input type="date" class="form-control" name="end_date">
                        </div>
                    </div>
                    
                    <!-- No. Passpor -->
                    <div class="col-md-4 mb-3">
                        <label>No. Surat Perintah:</label>
                        <input type="text" class="form-control" name="passport_number" placeholder="Keyword">
                    </div>
                    
                    <!-- Nama Penumpang -->
                    <div class="col-md-4 mb-3">
                        <label>No. NPI:</label>
                        <input type="text" class="form-control" name="passenger_name" placeholder="Keyword">
                    </div>
                    
                    <!-- Nomor Dokumen -->
                    <div class="col-md-4 mb-3">
                        <label>No. Laporan Informasi:</label>
                        <input type="text" class="form-control" name="document_number" placeholder="Keyword">
                    </div>
                    
                    <!-- Komoditi -->
                    <div class="col-md-4 mb-3">
                        <label>Wilayah:</label>
                          <input type="text" class="form-control" name="document_number" placeholder="Keyword">
                    </div>
                    
                    <!-- Lokasi Pemeriksaan -->
                    <div class="col-md-4 mb-3">
                        <label>No. LAP:</label>
                        <input type="text" class="form-control" name="passenger_name" placeholder="Keyword">
                    </div>
                    
                    <!-- Buttons -->
                    <div class="col-12 d-flex justify-content-center flex-wrap gap-2">
    <button type="submit" class="btn btn-primary btn-sm">
        <i data-feather="search" style="width: 16px; height: 16px;" class="me-1"></i> Cari Dokumen
    </button>
    <button type="button" class="btn btn-secondary btn-sm" onclick="location.reload();">
        <i data-feather="refresh-cw" style="width: 16px; height: 16px;" class="me-1"></i> Refresh
    </button>
    <a href="{{ route('pra-penindakan.create') }}" class="tp-link">
    <button type="button" class="btn btn-success btn-sm">
        <i data-feather="plus" style="width: 16px; height: 16px;" class="me-1"></i> Rekam Data Pra-penindakan
    </button>
    </a>
    <button type="button" class="btn btn-info btn-sm">
        <i data-feather="file-text" style="width: 16px; height: 16px;" class="me-1"></i> Export to Excel
    </button>
</div>



                </div>
            </form>
        </div>
    </div>

    
    <!-- Table Section -->
    <div class="row">
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
        <div class="col-12">
            <div class="card">
                <div class="card-body table-responsive">
                    <table id="fixed-header-datatable" class="table table-striped dt-responsive nowrap table-striped w-100">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>No LI</th>
                                <th>Isi Informasi</th>
                                <th>Nomor Urut LAP</th>
                                <th>Nomor LAP</th>
                                <th>Nomor NPI</th>
                                <th>Nomor Perintah</th>
                                <th>Opsi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($praPenindakans as $index => $praPenindakan)
                                <tr align="center">
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $praPenindakan->no_li }}</td>
                                    <td>{{ $praPenindakan->isi_informasi }}</td>
                                    <td>{{ $praPenindakan->no_urut_lap }}</td>
                                    <td>{{ $praPenindakan->no_lap }}</td>
                                    <td>{{ $praPenindakan->no_npi }}</td>
                                    <td>{{ $praPenindakan->no_print }}</td>
                                    <td>
                                        <a href="{{ route('pra-penindakan.edit', ['pra_penindakan' => $praPenindakan->id]) }}" class="btn btn-primary btn-sm">
                                            <i data-feather="edit" style="width: 16px; height: 16px;" class="me-1"></i> Edit
                                        </a>
                                        <a href="{{ route('pra-penindakan.print', $praPenindakan->id) }}" class="btn btn-info btn-sm">
                                            <i data-feather="printer" style="width: 16px; height: 16px;" class="me-1"></i> Print
                                        </a>
                                        <form action="{{ route('pra-penindakan.destroy', $praPenindakan->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?');">
                                            <i data-feather="trash" style="width: 16px; height: 16px;" class="me-1"></i> Delete
                                         </button>
                                    </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
 <!-- container-fluid -->



@endsection

@section('script')
    @vite([ 'resources/js/pages/datatable.init.js'])
@endsection