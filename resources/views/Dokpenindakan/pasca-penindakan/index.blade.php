@extends('layouts.vertical', ['title' => 'Laporan Penindakan'])

@section('css')
  @vite(['node_modules/datatables.net-bs5/css/dataTables.bootstrap5.min.css', 'node_modules/datatables.net-buttons-bs5/css/buttons.bootstrap5.min.css', 'node_modules/datatables.net-keytable-bs5/css/keyTable.bootstrap5.min.css', 'node_modules/datatables.net-responsive-bs5/css/responsive.bootstrap5.min.css', 'node_modules/datatables.net-select-bs5/css/select.bootstrap5.min.css'])
@endsection

@section('content')
  <div class="container-fluid">
    <!-- Search Form Section -->
    <div class="card mb-3 mt-4">
      <div class="card-header">
        <h5 class="card-title mb-0">Laporan Pasca Penindakan</h5>
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
              <label>No. Surat Penindakan:</label>
              <input type="text" class="form-control" name="passport_number" placeholder="Keyword">
            </div>

            <div class="col-md-4 mb-3">
              <label>Tgl. Penindakan:</label>
              <input type="text" class="form-control" name="passenger_name" placeholder="Keyword">
            </div>

            <div class="col-md-4 mb-3">
              <label>Nomor LPHP:</label>
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
              <label>Lokasi Pemeriksaan:</label>
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
              {{-- <a href="{{ route('DaftarSbp.create') }}" class="tp-link">
    <button type="button" class="btn btn-success btn-sm">
        <i data-feather="plus" style="width: 16px; height: 16px;" class="me-1"></i> Rekam Data SBP
    </button>
</a> --}}
              <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#laporanInfoModal">
                <i data-feather="plus" style="width: 16px; height: 16px;" class="me-1"></i> Rekam Data Pasca Penindakan
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
            <h5 class="modal-title" id="laporanInfoModalLabel">Pilih Nomor Surat Bukti Penindakan</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body table-responsive">
            <!-- Tabel atau daftar nomor laporan informasi -->
            <table id="datatable" class="table table-bordered dt-responsive table-responsive nowrap">
              <thead>
                <tr align="center">
                  <th>Nomor Surat Bukti Penindakan</th>
                  <th>Tanggal Surat Bukti Penindkan</th>
                  <th>Pilih</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($penindakan as $penindakan)
                  <tr align="center">
                    <td>{{ $penindakan->no_sbp }}</td>
                    <td>{{ $penindakan->tgl_sbp }}</td>
                    <td>
                      <button type="button" class="btn btn-primary pilih-laporan" data-nomor="{{ $penindakan->id_penindakan }}">
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
                  <th class="px-3 text-center py-3" style="width: 15%">No LPHP</th>
                  <th class="px-3 text-center py-3" style="width: 15%">Tanggal LPHP</th>
                  <th class="text-center px-3 py-3" style="width: 20%">Opsi</th>
                </tr>
              </thead>
              <tbody align="center">
                @foreach ($pascaPenindakan as $index => $pascapenindakan)
                  <tr class="shadow-sm">
                    <td class="text-center fw-medium">{{ $index + 1 }}.</td>
                    <td class="fw-medium">{{ $pascapenindakan->no_lphp }}</td>
                    <td class="fw-medium">{{ $pascapenindakan->tgl_lphp }}</td>
                    <td>
                      <div class="d-flex gap-1 justify-content-center">
                        <a href="{{ route('pasca-penindakan.edit', ['pasca_penindakan' => $pascapenindakan->id]) }}" class="btn btn-soft-success btn-icon btn-sm rounded-pill">
                          <i data-feather="edit" class="icon-sm"></i> Edit
                        </a>
                        <form action="{{ route('pasca-penindakan.destroy', $pascapenindakan->id) }}" method="POST" class="d-inline delete-form">
                          @csrf
                          @method('DELETE')
                          <button type="submit" class="btn btn-soft-danger btn-icon btn-sm rounded-pill" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?');">
                            <i data-feather="trash" class="icon-sm"></i> Delete
                          </button>
                        </form>
                        <button type="button" class="btn btn-soft-info btn-icon btn-sm rounded-pill" data-bs-toggle="modal" data-bs-target=".bs-example-modal-lg">
                          <i data-feather="printer" class="icon-sm"></i> Print
                        </button>


                      </div>
                    </td>


                    <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                      <div class="modal-dialog modal-dialog-centered modal-lg">
                        <div class="modal-content">
                          <div class="modal-header border-bottom-0 pb-0" style="position: sticky; top: 0; z-index: 1055; background: #fff; height: 70px;">
                            <h5 class="modal-title" id="printModalLabel">Print Dokumen Pasca Penindakan</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                          </div>
                          <div class="modal-body" style="max-height: 65vh; overflow-y: auto;">
                            <div class="container">
                              <div class="row g-3">


                                <div class="col-md-4">
                                  <div class="card print-card border-success shadow-lg">
                                    <div class="card-body text-center">
                                      <div class="print-card-icon text-success mb-3">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                          <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                                          <polyline points="14 2 14 8 20 8"></polyline>
                                          <line x1="16" y1="13" x2="8" y2="13"></line>
                                          <line x1="16" y1="17" x2="8" y2="17"></line>
                                          <polyline points="10 9 9 9 8 9"></polyline>
                                        </svg>
                                      </div>
                                      <h6 class="card-title mb-3">LPHP</h6>
                                      <a href="{{ route('surat-lphp.print', $pascapenindakan->id) }}" class="btn btn-outline-success print-btn">Print</a>
                                    </div>
                                  </div>
                                </div>


                                <div class="col-md-4">
                                  <div class="card print-card border-info shadow-lg">
                                    <div class="card-body text-center">
                                      <div class="print-card-icon text-info mb-3">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                          <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                                          <polyline points="14 2 14 8 20 8"></polyline>
                                          <line x1="16" y1="13" x2="8" y2="13"></line>
                                          <line x1="16" y1="17" x2="8" y2="17"></line>
                                          <polyline points="10 9 9 9 8 9"></polyline>
                                        </svg>
                                      </div>
                                      <h6 class="card-title mb-3">LP</h6>
                                      <a href="{{ route('surat-lp.print', $pascapenindakan->id) }}" class="btn btn-outline-success print-btn">Print</a>
                                    </div>
                                  </div>
                                </div>

                                <div class="col-md-4">
                                  <div class="card print-card border-primary shadow-lg">
                                    <div class="card-body text-center">
                                      <div class="print-card-icon text-primary mb-3">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                          <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                                          <polyline points="14 2 14 8 20 8"></polyline>
                                          <line x1="16" y1="13" x2="8" y2="13"></line>
                                          <line x1="16" y1="17" x2="8" y2="17"></line>
                                          <polyline points="10 9 9 9 8 9"></polyline>
                                        </svg>
                                      </div>
                                      <h6 class="card-title mb-3">NP</h6>
                                      <a href="{{ route('surat-np.print', $pascapenindakan->id) }}" class="btn btn-outline-primary print-btn">Print</a>
                                    </div>
                                  </div>
                                </div>
                              </div>

                              <div class="row g-3">
                                <div class="col-md-4">
                                  <div class="card print-card border-warning shadow-lg">
                                    <div class="card-body text-center">
                                      <div class="print-card-icon text-info mb-3">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                          <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                                          <polyline points="14 2 14 8 20 8"></polyline>
                                          <line x1="16" y1="13" x2="8" y2="13"></line>
                                          <line x1="16" y1="17" x2="8" y2="17"></line>
                                          <polyline points="10 9 9 9 8 9"></polyline>
                                        </svg>
                                      </div>
                                      <h6 class="card-title mb-3">BAST PEMILIK</h6>
                                      <a href="{{ route('surat-bast-pemilik.print', $pascapenindakan->id) }}" class="btn btn-outline-success print-btn">Print</a>
                                    </div>
                                  </div>
                                </div>

                                <div class="col-md-4">
                                  <div class="card print-card border-warning shadow-lg">
                                    <div class="card-body text-center">
                                      <div class="print-card-icon text-warning mb-3">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                          <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                                          <polyline points="14 2 14 8 20 8"></polyline>
                                          <line x1="16" y1="13" x2="8" y2="13"></line>
                                          <line x1="16" y1="17" x2="8" y2="17"></line>
                                          <polyline points="10 9 9 9 8 9"></polyline>
                                        </svg>
                                      </div>
                                      <h6 class="card-title mb-3">BAST INSTANSI</h6>
                                      <a href="{{ route('surat-bast-instansi.print', $pascapenindakan->id) }}" class="btn btn-outline-warning print-btn">Print</a>
                                    </div>
                                  </div>
                                </div>

                                <div class="col-md-4">
                                  <div class="card print-card border-warning shadow-lg">
                                    <div class="card-body text-center">
                                      <div class="print-card-icon text-info mb-3">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                          <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                                          <polyline points="14 2 14 8 20 8"></polyline>
                                          <line x1="16" y1="13" x2="8" y2="13"></line>
                                          <line x1="16" y1="17" x2="8" y2="17"></line>
                                          <polyline points="10 9 9 9 8 9"></polyline>
                                        </svg>
                                      </div>
                                      <h6 class="card-title mb-3">BAST PENYIDIK</h6>
                                      <a href="{{ route('surat-bast-penyidik.print', $pascapenindakan->id) }}" class="btn btn-outline-success print-btn">Print</a>
                                    </div>
                                  </div>
                                </div>
                              </div>

                              <div class="row g-3">
                                <div class="col-md-4">
                                  <div class="card print-card border-danger shadow-lg">
                                    <div class="card-body text-center">
                                      <div class="print-card-icon text-danger mb-3">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                          <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                                          <polyline points="14 2 14 8 20 8"></polyline>
                                          <line x1="16" y1="13" x2="8" y2="13"></line>
                                          <line x1="16" y1="17" x2="8" y2="17"></line>
                                          <polyline points="10 9 9 9 8 9"></polyline>
                                        </svg>
                                      </div>
                                      <h6 class="card-title mb-3">LPT</h6>
                                      <a href="{{ route('surat-lpt.print', $pascapenindakan->id) }}" class="btn btn-outline-danger print-btn">Print</a>
                                    </div>
                                  </div>
                                </div>

                                {{-- <div class="col-md-4">
                                <div class="card print-card border-dark shadow-lg">
                                  <div class="card-body text-center">
                                    <div class="print-card-icon text-dark mb-3">
                                      <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                                        <polyline points="14 2 14 8 20 8"></polyline>
                                        <line x1="16" y1="13" x2="8" y2="13"></line>
                                        <line x1="16" y1="17" x2="8" y2="17"></line>
                                        <polyline points="10 9 9 9 8 9"></polyline>
                                      </svg>
                                    </div>
                                    <h6 class="card-title mb-3">B.A Segel</h6>
                                    <a href="" class="btn btn-outline-dark print-btn">Print</a>
                                  </div>
                                </div>
                              </div> --}}

                                <div class="row g-3">
                                  {{-- <div class="col-md-4">
                                  <div class="card print-card border-danger shadow-lg">
                                    <div class="card-body text-center">
                                      <div class="print-card-icon text-danger mb-3">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                          <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                                          <polyline points="14 2 14 8 20 8"></polyline>
                                          <line x1="16" y1="13" x2="8" y2="13"></line>
                                          <line x1="16" y1="17" x2="8" y2="17"></line>
                                          <polyline points="10 9 9 9 8 9"></polyline>
                                        </svg>
                                      </div>
                                      <h6 class="card-title mb-3">B.A Titip</h6>
                                      <a href="" class="btn btn-outline-danger print-btn">Print</a>
                                    </div>
                                  </div>
                                </div> --}}

                                  {{-- <div class="col-md-4 ">
                                  <div class="card print-card border-secondary shadow-lg">
                                    <div class="card-body text-center">
                                      <div class="print-card-icon mb-3">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                          class="text-primary">
                                          <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                                          <polyline points="14 2 14 8 20 8"></polyline>
                                          <line x1="16" y1="13" x2="8" y2="13"></line>
                                          <line x1="16" y1="17" x2="8" y2="17"></line>
                                          <polyline points="10 9 9 9 8 9"></polyline>
                                        </svg>
                                      </div>
                                      <h6 class="card-title mb-3">SBP</h6>
                                      <a href="" class="btn btn-outline-primary print-btn">Print</a>
                                    </div>
                                  </div>
                                </div> --}}

                                  {{-- <div class="col-md-4">
                                  <div class="card print-card border-danger shadow-lg">
                                    <div class="card-body text-center">
                                      <div class="print-card-icon text-danger mb-3">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                          <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                                          <polyline points="14 2 14 8 20 8"></polyline>
                                          <line x1="16" y1="13" x2="8" y2="13"></line>
                                          <line x1="16" y1="17" x2="8" y2="17"></line>
                                          <polyline points="10 9 9 9 8 9"></polyline>
                                        </svg>
                                      </div>
                                      <h6 class="card-title mb-3">B.A Tolak Pertama</h6>
                                      <a href="" class="btn btn-outline-danger print-btn">Print</a>
                                    </div>
                                  </div>
                                </div> --}}

                                </div>

                                <div class="row g-3 justify-content-center">
                                  {{-- <div class="col-md-4">
                                  <div class="card print-card border-danger shadow-lg">
                                    <div class="card-body text-center">
                                      <div class="print-card-icon text-danger mb-3">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                          <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                                          <polyline points="14 2 14 8 20 8"></polyline>
                                          <line x1="16" y1="13" x2="8" y2="13"></line>
                                          <line x1="16" y1="17" x2="8" y2="17"></line>
                                          <polyline points="10 9 9 9 8 9"></polyline>
                                        </svg>
                                      </div>
                                      <h6 class="card-title mb-3">B.A Tolak Kedua</h6>
                                      <a href="" class="btn btn-outline-danger print-btn">Print</a>
                                    </div>
                                  </div>
                                </div> --}}
                                </div>



                              </div>
                            </div>
                          </div>
                          <div class="modal-footer border-top-0">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                          </div>
                        </div>
                      </div>
                    </div>
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
          let url = `/Dokpenindakan/pasca-penindakan/create?id_penindakan=${encodeURIComponent(nomorLaporan)}`;
          window.location.href = url;
        }
      });
    });
  </script>




@endsection

@section('script')
  @vite(['resources/js/pages/datatable.init.js'])
@endsection
