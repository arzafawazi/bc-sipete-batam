@extends('layouts.vertical', ['title' => 'B.A Pembukaan Segel'])

@section('css')
  @vite(['node_modules/datatables.net-bs5/css/dataTables.bootstrap5.min.css', 'node_modules/datatables.net-buttons-bs5/css/buttons.bootstrap5.min.css', 'node_modules/datatables.net-keytable-bs5/css/keyTable.bootstrap5.min.css', 'node_modules/datatables.net-responsive-bs5/css/responsive.bootstrap5.min.css', 'node_modules/datatables.net-select-bs5/css/select.bootstrap5.min.css'])
@endsection

@section('content')
  <div class="container-fluid">
    <!-- Search Form Section -->
    <div class="card mb-3 mt-4">
      <div class="card-header">
        <h5 class="card-title mb-0">Berita Acara Pembukaan Segel</h5>
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
              <label>No. B.A Buka Segel</label>
              <input type="text" class="form-control" name="passport_number" placeholder="Keyword">
            </div>

            <div class="col-md-4 mb-3">
              <label>Tgl. B.A Buka Segel:</label>
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
              <label>Lokasi B.A Buka Segel:</label>
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

              <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#laporanInfoModal">
                <i data-feather="plus" style="width: 16px; height: 16px;" class="me-1"></i> Rekam Data B.A Buka Segel
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
            <h5 class="modal-title" id="laporanInfoModalLabel">Pilih Nomor Surat Laporan Hasil Penelitian</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body table-responsive">
            <!-- Tabel atau daftar nomor laporan informasi -->
            <table id="datatable" class="table table-bordered dt-responsive table-responsive nowrap">
              <thead>
                <tr align="center">
                  <th style="width: 20%;">Nomor LHP Penyidikan</th>
                  <th style="width: 20%;">Tanggal LHP Penyidikan</th>
                  <th style="width: 20%;">Nomor SBP</th>
                  <th style="width: 20%;">Tanggal SBP</th>
                  <th style="width: 20%;">Pilih</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($penyidikan as $penyidikan)
                  <tr align="center">
                    <td class="pt-3">{{ $penyidikan->no_lhp_penyidikan }}</td>
                    <td class="pt-3">{{ $penyidikan->tgl_lhp_penyidikan }}</td>
                    <td class="pt-3">
                      @foreach ($sbpData as $sbp)
                        <div>{{ $sbp->no_sbp }}</div>
                      @endforeach
                    </td>
                    <td class="pt-3">
                      @foreach ($sbpData as $sbp)
                        <div>{{ $sbp->tgl_sbp }}</div>
                      @endforeach
                    </td>
                    <td>
                      <button type="button" class="btn btn-primary pilih-laporan" data-nomor="{{ $penyidikan->id_penyidikan }}">
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
            <table id="fixed-header-datatable" class="table table-hover align-middle border-separate" style="border-spacing: 0 8px;">
              <thead>
                <tr class="bg-light">
                  <th class="text-center px-3 py-3" style="width: 5%">No</th>
                  <th class="px-3 text-center py-3" style="width: 15%">Tanggal Pelanggaran Ketentuan Lain</th>
                  <th class="text-center px-3 py-3" style="width: 20%">Opsi</th>
                </tr>
              </thead>
              <tbody align="center">
                @foreach ($pelanggaranlain as $index => $pelanggaranlain)
                  <tr class="shadow-sm">
                    <td class="text-center fw-medium">{{ $index + 1 }}.</td>
                    <td class="fw-medium">{{ $pelanggaranlain->tgl_bast_instansi_lain_pkl }}</td>
                    <td>
                      <div class="d-flex gap-1 justify-content-center">
                        <a href="{{ route('pelanggaran-ketentuan-lain.edit', ['pelanggaran_ketentuan_lain' => $pelanggaranlain->id]) }}" class="btn btn-soft-success btn-icon btn-sm rounded-pill">
                          <i data-feather="edit" class="icon-sm"></i> Edit
                        </a>
                        <form action="{{ route('pelanggaran-ketentuan-lain.destroy', $pelanggaranlain->id) }}" method="POST" class="d-inline delete-form">
                          @csrf
                          @method('DELETE')
                          <button type="submit" class="btn btn-soft-danger btn-icon btn-sm rounded-pill" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?');">
                            <i data-feather="trash" class="icon-sm"></i> Delete
                          </button>
                        </form>
                        <a href="{{ route('surat-bast-instansi-lain-pkl.print', $pelanggaranlain->id) }}" class="btn btn-soft-info btn-icon btn-sm rounded-pill">
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

  <script>
    document.addEventListener("DOMContentLoaded", function() {
      document.addEventListener('click', function(event) {
        if (event.target.classList.contains('pilih-laporan')) {
          let nomorLaporan = event.target.getAttribute('data-nomor');
          let buttonLabel = event.target.getAttribute('data-label'); // Ambil label tombol dari data-label
          let url = `/Tindaklanjut/pelanggaran-ketentuan-lain/create?id_penyidikan=${encodeURIComponent(nomorLaporan)}`;
          window.location.href = url;
        }
      });
    });
  </script>




@endsection

@section('script')
  @vite(['resources/js/pages/datatable.init.js'])
@endsection
