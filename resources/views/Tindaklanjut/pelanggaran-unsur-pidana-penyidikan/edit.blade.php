@extends('layouts.vertical', ['title' => 'Edit Pelanggaran Unsur Pidana Penyidikan'])

@section('css')
  @vite(['node_modules/datatables.net-bs5/css/dataTables.bootstrap5.min.css', 'node_modules/datatables.net-buttons-bs5/css/buttons.bootstrap5.min.css', 'node_modules/datatables.net-keytable-bs5/css/keyTable.bootstrap5.min.css', 'node_modules/datatables.net-responsive-bs5/css/responsive.bootstrap5.min.css', 'node_modules/datatables.net-select-bs5/css/select.bootstrap5.min.css'])
@endsection
@section('content')
  <div class="container-fluid">
    <form action="{{ route('unsur-pidana-penyidikan.update', ['unsur_pidana_penyidikan' => $unsurpenyidikan->id]) }}" method="POST" enctype="multipart/form-data">
      @csrf
      @method('PUT')
      <div class="card mb-3 mt-4">
        <div class="card-header d-flex justify-content-between align-items-center">
          <h5 class="card-title mb-0">
            <i data-feather="book" style="width: 20px; height: 20px;" class="me-1"></i>
            Form Edit Data Pelanggaran Usur Pidana Penyidikan
          </h5>
          <button type="button" class="btn btn-danger btn-sm" onclick="window.history.back()">
            <i data-feather="log-out"></i> Kembali
          </button>
        </div>

        <div class="card-body">
          <div class="row">
            <div class="col-xl-12">
              <div class="card">

                <div class="card-body">
                  <div class="tabs-container" id="tabs-container">
                    <ul class="nav nav-pills nav-justified flex-nowrap overflow-auto" style="white-space: nowrap;" role="tablist">
                      <li class="nav-item">
                        <a class="nav-link active" id="navtabs2-lk-tab" data-bs-toggle="tab" href="#navtabs2-lk" role="tab" aria-controls="navtabs2-lk" aria-selected="true">
                          <span class="d-block d-sm-none">(LK)</span>
                          <span class="d-none d-sm-block">LAPORAN KEJADIAN TINDAK PIDANA</span>
                        </a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link " id="navtabs2-sptp-tab" data-bs-toggle="tab" href="#navtabs2-sptp" role="tab" aria-controls="navtabs2-sptp" aria-selected="false">
                          <span class="d-block d-sm-none">(SPTP)</span>
                          <span class="d-none d-sm-block">SURAT PERINTAH TUGAS PENYIDIKAN</span>
                        </a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link " id="navtabs2-spdp-tab" data-bs-toggle="tab" href="#navtabs2-spdp" role="tab" aria-controls="navtabs2-spdp" aria-selected="false">
                          <span class="d-block d-sm-none">(SPDP)</span>
                          <span class="d-none d-sm-block">SURAT PEMBERITAHUAN DIMULAINYA PENYIDIKAN</span>
                        </a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link " id="navtabs2-sp1-tab" data-bs-toggle="tab" href="#navtabs2-sp1" role="tab" aria-controls="navtabs2-sp1" aria-selected="false">
                          <span class="d-block d-sm-none">(SP-I)</span>
                          <span class="d-none d-sm-block">SURAT PANGGILAN I</span>
                        </a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link " id="navtabs2-sp2-tab" data-bs-toggle="tab" href="#navtabs2-sp2" role="tab" aria-controls="navtabs2-sp2" aria-selected="false">
                          <span class="d-block d-sm-none">(SP-II)</span>
                          <span class="d-none d-sm-block">SURAT PANGGILAN II</span>
                        </a>
                      </li>
                      {{-- <li class="nav-item">
                        <a class="nav-link " id="navtabs2-spdp-tab" data-bs-toggle="tab" href="#navtabs2-spdp" role="tab" aria-controls="navtabs2-spdp" aria-selected="false">
                          <span class="d-block d-sm-none">(SPDP)</span>
                          <span class="d-none d-sm-block">SURAT PEMBERITAHUAN DIMULAINYA PENYIDIKAN</span>
                        </a>
                      </li> --}}
                      {{-- <li class="nav-item">
                        <a class="nav-link" id="navtabs2-pemberitahuan-tab" data-bs-toggle="tab" href="#navtabs2-pemberitahuan" role="tab" aria-controls="navtabs2-pemberitahuan" aria-selected="false">
                          <span class="d-block d-sm-none">(PEMBERITAHUAN)</span>
                          <span class="d-none d-sm-block">PEMBERITAHUAN</span>
                        </a>
                      </li> --}}
                    </ul>
                  </div>

                  <div class="tab-content p-3 text-muted">

                    <div class="tab-pane active" id="navtabs2-lk" role="tabpanel">
                      @include('Tindaklanjut.pelanggaran-unsur-pidana-penyidikan.tabs.laporan-kejadian-tindak-pidana', ['unsurpenyidikan' => $unsurpenyidikan])
                    </div>

                    <div class="tab-pane" id="navtabs2-sptp" role="tabpanel">
                      @include('Tindaklanjut.pelanggaran-unsur-pidana-penyidikan.tabs.surat-perintah-tugas-penyidikan', ['unsurpenyidikan' => $unsurpenyidikan])
                    </div>

                    <div class="tab-pane" id="navtabs2-spdp" role="tabpanel">
                      @include('Tindaklanjut.pelanggaran-unsur-pidana-penyidikan.tabs.surat-pemberitahuan-dimulainya-penyidikan', ['unsurpenyidikan' => $unsurpenyidikan])
                    </div>

                    <div class="tab-pane" id="navtabs2-sp1" role="tabpanel">
                      @include('Tindaklanjut.pelanggaran-unsur-pidana-penyidikan.tabs.surat-panggilan-pertama', ['unsurpenyidikan' => $unsurpenyidikan])
                    </div>

                    <div class="tab-pane" id="navtabs2-sp2" role="tabpanel">
                      @include('Tindaklanjut.pelanggaran-unsur-pidana-penyidikan.tabs.surat-panggilan-kedua', ['unsurpenyidikan' => $unsurpenyidikan])
                    </div>

                    <div class="tab-pane" id="navtabs2-spm" role="tabpanel">
                      @include('Tindaklanjut.pelanggaran-unsur-pidana-penyidikan.tabs.surat-perintah-membawa', ['unsurpenyidikan' => $unsurpenyidikan])
                    </div>

                    <div class="card-footer d-flex justify-content-end">
                      <button type="submit" class="btn btn-success btn-sm me-2">
                        <i data-feather="save"></i> Simpan Data Pelanggaran Ketentuan Lain
                      </button>
                    </div>

                  </div>
                </div>
              </div> <!-- end card-->
            </div> <!-- end col -->
          </div>
        </div>



      </div>
    </form>
  </div>


  <style>
    .nav-link.highlight {
      color: #287F71 !important;
      transition: background-color 0.5s ease;
    }

    .fw-bold {
      color: black !important;
    }

    .col-form-label {
      color: black !important;
    }

    input[readonly] {
      color: black !important;
    }
  </style>


  <script>
    function generateUniqueID() {
      const timestamp = Date.now();
      const randomNum = Math.floor(Math.random() * 1000000);
      return `id_pelanggaran_unsur_pidana_penyidikan${timestamp}_${randomNum}`;
    }

    document.getElementById('id_pelanggaran_unsur_pidana_penyidikan').value = generateUniqueID();
  </script>
@endsection

@section('script')
  @vite(['resources/js/pages/datatable.init.js'])
@endsection
