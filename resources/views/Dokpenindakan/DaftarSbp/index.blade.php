@extends('layouts.vertical', ['title' => 'Daftar Sbp'])

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
            <h5 class="card-title mb-0">DAFTAR DOKUMEN SURAT BUKTI PENINDAKAN (SBP)</h5>
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
                        <label>No. Passpor:</label>
                        <input type="text" class="form-control" name="passport_number" placeholder="Keyword">
                    </div>
                    
                    <!-- Nama Penumpang -->
                    <div class="col-md-4 mb-3">
                        <label>Nama Penumpang:</label>
                        <input type="text" class="form-control" name="passenger_name" placeholder="Keyword">
                    </div>
                    
                    <!-- Nomor Dokumen -->
                    <div class="col-md-4 mb-3">
                        <label>Nomor Dokumen:</label>
                        <input type="text" class="form-control" name="document_number" placeholder="Keyword">
                    </div>
                    
                    <!-- Komoditi -->
                    <div class="col-md-4 mb-3">
                        <label>Komoditi:</label>
                        <select class="form-control" name="commodity">
                            <option value="">Semua Komoditi</option>
                            <option value="Komoditi1">Komoditi 1</option>
                            <option value="Komoditi2">Komoditi 2</option>
                            <!-- Add other options as needed -->
                        </select>
                    </div>
                    
                    <!-- Lokasi Pemeriksaan -->
                    <div class="col-md-4 mb-3">
                        <label>Lokasi Pemeriksaan:</label>
                        <select class="form-control" name="inspection_location">
                            <option value="">Pilih</option>
                            <option value="Lokasi1">Lokasi 1</option>
                            <option value="Lokasi2">Lokasi 2</option>
                            <!-- Add other options as needed -->
                        </select>
                    </div>
                    
                    <!-- Buttons -->
                    <div class="col-12 d-flex justify-content-center flex-wrap gap-2">
    <button type="submit" class="btn btn-primary btn-sm">
        <i data-feather="search" style="width: 16px; height: 16px;" class="me-1"></i> Cari Dokumen
    </button>
    <button type="button" class="btn btn-secondary btn-sm" onclick="location.reload();">
        <i data-feather="refresh-cw" style="width: 16px; height: 16px;" class="me-1"></i> Refresh
    </button>
    {{-- <a href="{{ route('DaftarSbp.create') }}" class="tp-link">
    <button type="button" class="btn btn-success btn-sm">
        <i data-feather="plus" style="width: 16px; height: 16px;" class="me-1"></i> Rekam Data SBP
    </button>
</a> --}}
    <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#laporanInfoModal">
    <i data-feather="plus" style="width: 16px; height: 16px;" class="me-1"></i> Rekam Data Penindakan
</button>
    <button type="button" class="btn btn-info btn-sm">
        <i data-feather="file-text" style="width: 16px; height: 16px;" class="me-1"></i> Export to Excel
    </button>
</div>



                </div>
            </form>
        </div>
    </div>

    <div class="modal fade" id="laporanInfoModal" tabindex="-1" aria-labelledby="laporanInfoModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="laporanInfoModalLabel">Pilih Nomor Surat Perintah</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Tabel atau daftar nomor laporan informasi -->
                <table id="fixed-header-datatable" class="table table-striped dt-responsive nowrap table-striped w-100">
                    <thead>
                        <tr>
                            <th>Nomor Surat Perintah</th>
                            <th>Tanggal Surat Perintah</th>
                            <th>Pilih</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($laporanInformasi as $laporan)
                        <tr>
                            <td>{{ $laporan->no_print }}</td>
                            <td>{{ $laporan->tanggal_mulai_print }}</td>
                            <td>
                                <button type="button" class="btn btn-primary pilih-laporan" data-nomor="{{ $laporan->no_print }}">
                                    Pilih
                                </button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
    
    <!-- Table Section -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body table-responsive">
                     <table id="fixed-header-datatable" class="table table-striped dt-responsive nowrap table-striped w-100">
                        <thead>
                            <tr align="center">
                                <th>No</th>
                                <th>No Penindakan</th>
                                <th>Tanggal Penindakan</th>
                                <th>Opsi</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach ($penindakans as $index => $penindakan  )
                            <tr align="center">
                            <td>{{$index + 1}}</td>
                            <td>{{$penindakan->no_sbp}}</td>
                            <td>{{$penindakan->tgl_sbp}}</td>
                             <td>
                                        <a href="" class="btn btn-primary btn-sm">
                                            <i data-feather="edit" style="width: 16px; height: 16px;" class="me-1"></i> Edit
                                        </a>
                                        <a href="{{ route('DaftarSbp.print', $penindakan->id) }}" class="btn btn-info btn-sm">
                                            <i data-feather="printer" style="width: 16px; height: 16px;" class="me-1"></i> Print
                                        </a>
                                        <form action="{{ route('DaftarSbp.destroy', $penindakan->id) }}" method="POST" style="display:inline;">
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

<script>
    document.addEventListener("DOMContentLoaded", function() {
        document.addEventListener('click', function(event) {
            if (event.target.classList.contains('pilih-laporan')) {
                let nomorLaporan = event.target.getAttribute('data-nomor');
                let url = `/Dokpenindakan/DaftarSbp/create?nomor_laporan=${encodeURIComponent(nomorLaporan)}`;
                window.location.href = url;
            }
        });
    });
</script>






@endsection

@section('script')
    @vite([ 'resources/js/pages/datatable.init.js'])
@endsection