@extends('layouts.vertical', ['title' => 'B.A Cacah Amunisi'])

@section('css')
    @vite(['node_modules/datatables.net-bs5/css/dataTables.bootstrap5.min.css', 'node_modules/datatables.net-buttons-bs5/css/buttons.bootstrap5.min.css', 'node_modules/datatables.net-keytable-bs5/css/keyTable.bootstrap5.min.css', 'node_modules/datatables.net-responsive-bs5/css/responsive.bootstrap5.min.css', 'node_modules/datatables.net-select-bs5/css/select.bootstrap5.min.css'])
@endsection

@section('content')
    <div class="container-fluid">
        <!-- Search Form Section -->
        <div class="card mb-3 mt-4">
            <div class="card-header">
                <h5 class="card-title mb-0">Berita Acara Cacah Amunisi</h5>
            </div>
            <div class="card-body">
                <form method="GET">
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label>Periode:</label>
                            <div class="input-group">
                                <input type="date" class="form-control" name="start_date">
                                <span class="input-group-text">s.d</span>
                                <input type="date" class="form-control" name="end_date">
                            </div>
                        </div>

                        <div class="col-md-4 mb-3">
                            <label>No. B.A Cacah Amunisi</label>
                            <input type="text" class="form-control" name="passport_number" placeholder="Keyword">
                        </div>

                        <div class="col-md-4 mb-3">
                            <label>Tgl. B.A Cacah Amunisi:</label>
                            <input type="text" class="form-control" name="passenger_name" placeholder="Keyword">
                        </div>

                        <div class="col-md-4 mb-3">
                            <label>Nomor BDN:</label>
                            <input type="text" class="form-control" name="document_number" placeholder="Keyword">
                        </div>

                        <div class="col-md-4 mb-3">
                            <label>Skema Penindakan:</label>
                            <select class="form-control" name="commodity">
                                <option value="">Semua Skema Penindakan</option>
                                <option value="BERSAMA">Penindakan Bersama</option>
                                <option value="MANDIRI">Penindakan Mandiri</option>
                            </select>
                        </div>

                        <div class="col-md-4 mb-3">
                            <label>Lokasi B.A Cacah Amunisi:</label>
                            <select class="form-control" name="inspection_location">
                                <option value="">Pilih</option>
                                <option value="Lokasi1">Lokasi 1</option>
                                <option value="Lokasi2">Lokasi 2</option>
                            </select>
                        </div>

                        <div class="col-12 d-flex justify-content-center flex-wrap gap-2">
                            <button type="submit" class="btn btn-primary btn-sm">
                                <i data-feather="search" style="width: 16px; height: 16px;" class="me-1"></i> Cari Dokumen
                            </button>
                            
                            <button type="button" class="btn btn-secondary btn-sm" onclick="location.reload();">
                                <i data-feather="refresh-cw" style="width: 16px; height: 16px;" class="me-1"></i> Refresh
                            </button>

                            <a href="{{ route('ba-cacah-amunisi.create') }}"
                                class="btn btn-primary btn-sm">
                                <i data-feather="plus" class="icon-sm"></i> Rekam Data B.A
                                Cacah Amunisi
                            </a>

                            <button type="button" class="btn btn-info btn-sm">
                                <i data-feather="file-text" style="width: 16px; height: 16px;" class="me-1"></i> Export to
                                Excel
                            </button>
                        </div>

                    </div>
                </form>
            </div>
        </div>

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

        <!-- Table Section -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body table-responsive">
                        <table id="fixed-header-datatable" class="table table-hover align-middle border-separate"
                            style="border-spacing: 0 8px;">
                            <thead>
                                <tr class="bg-light">
                                    <th class="text-center px-3 py-3" style="width: 5%">No</th>
                                    <th class="px-3 text-center py-3" style="width: 10%">No BA Cacah Amunisi</th>
                                    <th class="px-3 text-center py-3" style="width: 15%">Tanggal Ba Cacah Amunisi</th>
                                    <th class="text-center px-3 py-3" style="width: 20%">Opsi</th>
                                </tr>
                            </thead>
                            <tbody align="center">
                                @foreach ($cacahamunisi as $index => $cacahamunisi)
                                    <tr class="shadow-sm">
                                        <td class="text-center fw-medium">{{ $index + 1 }}.</td>
                                        <td class="fw-medium">{{ $cacahamunisi->no_ba_cacah_amunisi }}</td>
                                        <td class="fw-medium">{{ $cacahamunisi->tgl_ba_cacah_amunisi }}</td>
                                        <td>
                                            <div class="d-flex gap-1 justify-content-center">
                                                <a href="{{ route('ba-cacah-amunisi.edit', ['ba_cacah_amunisi' => $cacahamunisi->id]) }}"
                                                    class="btn btn-soft-success btn-icon btn-sm rounded-pill">
                                                    <i data-feather="edit" class="icon-sm"></i> Edit
                                                </a>
                                                <form action="{{ route('ba-cacah-amunisi.destroy', $cacahamunisi->id) }}"
                                                    method="POST" class="d-inline delete-form">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                        class="btn btn-soft-danger btn-icon btn-sm rounded-pill"
                                                        onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?');">
                                                        <i data-feather="trash" class="icon-sm"></i> Delete
                                                    </button>
                                                </form>
                                                <a href="{{ route('ba-cacah-amunisi.print', $cacahamunisi->id) }}"
                                                    class="btn btn-soft-info btn-icon btn-sm rounded-pill">
                                                    <i data-feather="printer" class="icon-sm"></i> Print
                                                </a>
                                            </div>

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
    @vite(['resources/js/pages/datatable.init.js'])
@endsection
