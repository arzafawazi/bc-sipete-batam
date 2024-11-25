@extends('layouts.vertical', ['title' => 'Laporan Intelijen'])

@section('css')
  @vite(['node_modules/datatables.net-bs5/css/dataTables.bootstrap5.min.css', 'node_modules/datatables.net-buttons-bs5/css/buttons.bootstrap5.min.css', 'node_modules/datatables.net-keytable-bs5/css/keyTable.bootstrap5.min.css', 'node_modules/datatables.net-responsive-bs5/css/responsive.bootstrap5.min.css', 'node_modules/datatables.net-select-bs5/css/select.bootstrap5.min.css'])
@endsection

@section('content')
  <div class="container-fluid">
    <!-- Search Form Section -->
    <div class="card mb-3 mt-4">
      <div class="card-header">
        <h5 class="card-title mb-0">Laporan Pengawasan Intelijen</h5>
      </div>
      <div class="card-body">
        <form method="GET">
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
              <a href="{{ route('laporan-pengawasan.create') }}" class="tp-link">
                <button type="button" class="btn btn-success btn-sm">
                  <i data-feather="plus" style="width: 16px; height: 16px;" class="me-1"></i> Rekam Data Laporan Pengawasan Intelijen
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
            <div class="table-responsive">
              <table id="fixed-header-datatable" class="table table-hover align-middle border-separate" style="border-spacing: 0 8px;">
                <thead>
                  <tr class="bg-light">
                    <th class="text-center px-3 py-3" style="width: 5%">No</th>
                    <th class="px-3 py-3" style="width: 15%">No. Surat Tugas</th>
                    <th class="px-3 py-3" style="width: 15%">Tgl. Surat Tugas</th>
                    <th class="text-center px-3 py-3" style="width: 35%">Status</th>
                    <th class="text-center px-3 py-3" style="width: 40%">Opsi</th>
                  </tr>
                </thead>
                <tbody align="center">
                  @foreach ($laporanpengawasan as $index => $laporanpengawasan)
                    <tr class="shadow-sm">
                      <td class="text-center fw-medium">{{ $index + 1 }}</td>
                      <td class="fw-medium">{{ $laporanpengawasan->no_st }}</td>
                      <td>{{ $laporanpengawasan->tgl_st }}</td>

                      <td class="px-3 py-2">
                        <div class="d-flex flex-column align-items-center gap-2">
                          <div class="d-flex gap-2 justify-content-center flex-wrap">
                            <span
                              class="badge rounded-pill px-3 py-2 d-inline-flex align-items-center
                @if ($laporanpengawasan->status_lpt == 'LPT-1 belum diisi') bg-danger-subtle text-danger border border-danger
                @elseif ($laporanpengawasan->status_lpt == 'LPT-1 lengkap') 
                    bg-success-subtle text-success border border-success
                @else 
                    bg-warning-subtle text-warning border border-warning @endif">
                              <i
                                class="bi @if ($laporanpengawasan->status_lpt == 'LPT-1 belum diisi') bi-x-circle-fill
                    @elseif ($laporanpengawasan->status_lpt == 'LPT-1 lengkap') 
                        bi-check-circle-fill
                    @else 
                        bi-exclamation-circle-fill @endif me-1">
                              </i>
                              {{ $laporanpengawasan->status_lpt }}
                            </span>

                            <span
                              class="badge rounded-pill px-3 py-2 d-inline-flex align-items-center
                @if ($laporanpengawasan->status_lppi == 'LPP-I belum diisi') bg-danger-subtle text-danger border border-danger
                @elseif ($laporanpengawasan->status_lppi == 'LPP-I lengkap') 
                    bg-success-subtle text-success border border-success
                @else 
                    bg-warning-subtle text-warning border border-warning @endif">
                              <i
                                class="bi @if ($laporanpengawasan->status_lppi == 'LPP-I belum diisi') bi-x-circle-fill
                    @elseif ($laporanpengawasan->status_lppi == 'LPP-I lengkap') 
                        bi-check-circle-fill
                    @else 
                        bi-exclamation-circle-fill @endif me-1">
                              </i>
                              {{ $laporanpengawasan->status_lppi }}
                            </span>
                          </div>

                          <span
                            class="badge rounded-pill px-3 py-2 d-inline-flex align-items-center
                @if ($laporanpengawasan->status_lkai == 'LKA-I belum diisi') bg-danger-subtle text-danger border border-danger
                @elseif ($laporanpengawasan->status_lkai == 'LKA-I lengkap') 
                    bg-success-subtle text-success border border-success
                @else 
                    bg-warning-subtle text-warning border border-warning @endif">
                            <i
                              class="bi @if ($laporanpengawasan->status_lkai == 'LKA-I belum diisi') bi-x-circle-fill
                    @elseif ($laporanpengawasan->status_lkai == 'LKA-I lengkap') 
                        bi-check-circle-fill
                    @else 
                        bi-exclamation-circle-fill @endif me-1">
                            </i>
                            {{ $laporanpengawasan->status_lkai }}
                          </span>
                        </div>
                      </td>

                      <td>
                        <div class="d-flex gap-1 justify-content-center">
                          <a href="{{ route('laporan-pengawasan.edit', ['laporan_pengawasan' => $laporanpengawasan->id]) }}" class="btn btn-soft-success btn-icon btn-sm rounded-pill">
                            <i data-feather="edit" class="icon-sm"></i> Edit
                          </a>
                          <form action="{{ route('laporan-pengawasan.destroy', $laporanpengawasan->id) }}" method="POST" class="d-inline delete-form">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-soft-danger btn-icon btn-sm rounded-pill" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?');">
                              <i data-feather="trash" class="icon-sm"></i>Hapus
                            </button>
                          </form>
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
  </div>
  <!-- container-fluid -->



@endsection

@section('script')
  @vite(['resources/js/pages/datatable.init.js'])
@endsection
