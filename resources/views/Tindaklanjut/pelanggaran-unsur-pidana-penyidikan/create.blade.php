@extends('layouts.vertical', ['title' => 'Rekam Pelanggaran Unsur Pidana Penyidikan'])

@section('css')
  @vite(['node_modules/datatables.net-bs5/css/dataTables.bootstrap5.min.css', 'node_modules/datatables.net-buttons-bs5/css/buttons.bootstrap5.min.css', 'node_modules/datatables.net-keytable-bs5/css/keyTable.bootstrap5.min.css', 'node_modules/datatables.net-responsive-bs5/css/responsive.bootstrap5.min.css', 'node_modules/datatables.net-select-bs5/css/select.bootstrap5.min.css'])
@endsection
@section('content')
  <div class="container-fluid">
    <form action="{{ route('unsur-pidana-penyidikan.store') }}" method="POST">
      @csrf
      <div class="card mb-3 mt-4">
        <div class="card-header d-flex justify-content-between align-items-center">
          <h5 class="card-title mb-0">
            <i data-feather="book" style="width: 20px; height: 20px;" class="me-1"></i>
            Form Rekam Data Pelanggaran Usur Pidana Penyidikan
          </h5>
          <a href="{{ route('unsur-pidana-penyidikan.index') }}" class="btn btn-danger btn-sm">
        <i data-feather="log-out"></i> Kembali
        </a>
        </div>

        <div class="card-body">
          <div class="row">
            <div class="col-xl-12">
              <div class="card">
                <div class="card-body">
                  <div class="tabs-container" id="tabs-container">
                    <div class="mb-3 position-relative">
                      <input type="text" id="searchTab" class="form-control ps-5 rounded-pill shadow-custom border-0" placeholder="Cari Surat...........">
                      <i data-feather="search" class="search-iconnnnnn"></i>
                    </div>
                    <ul class="nav nav-pills nav-justified flex-nowrap overflow-auto" style="white-space: nowrap;" role="tablist">
                      <li class="nav-item-penyidikan">
                        <a class="nav-link active" id="navtabs2-lk-tab" data-bs-toggle="tab" href="#navtabs2-lk" role="tab" aria-controls="navtabs2-lk" aria-selected="true">
                          <span class="d-block d-sm-none">(LK)</span>
                          <span class="d-none d-sm-block">LAPORAN KEJADIAN TINDAK PIDANA</span>
                        </a>
                      </li>
                      <li class="nav-item-penyidikan">
                        <a class="nav-link " id="navtabs2-sptp-tab" data-bs-toggle="tab" href="#navtabs2-sptp" role="tab" aria-controls="navtabs2-sptp" aria-selected="false">
                          <span class="d-block d-sm-none">(SPTP)</span>
                          <span class="d-none d-sm-block">SURAT PERINTAH TUGAS PENYIDIKAN</span>
                        </a>
                      </li>
                      <li class="nav-item-penyidikan">
                        <a class="nav-link " id="navtabs2-spdp-tab" data-bs-toggle="tab" href="#navtabs2-spdp" role="tab" aria-controls="navtabs2-spdp" aria-selected="false">
                          <span class="d-block d-sm-none">(SPDP)</span>
                          <span class="d-none d-sm-block">SURAT PEMBERITAHUAN DIMULAINYA PENYIDIKAN</span>
                        </a>
                      </li>
                      <li class="nav-item-penyidikan">
                        <a class="nav-link " id="navtabs2-sp1-tab" data-bs-toggle="tab" href="#navtabs2-sp1" role="tab" aria-controls="navtabs2-sp1" aria-selected="false">
                          <span class="d-block d-sm-none">(SP-I, SP-II, SPM)</span>
                          <span class="d-none d-sm-block">SURAT PANGGILAN I,II, SURAT PERINTAH MEMBAWA</span>
                        </a>
                      </li>
                    </ul>
                  </div>



                  <div class="tab-content p-3 text-muted">
                  <input type="hidden" id="id_pelanggaran_unsur_pidana_penyidikan" name="id_pelanggaran_unsur_pidana_penyidikan" value="">
                  <input type="hidden" name="id_penyidikan_ref" value="{{ $id_penyidikan }}" readonly>

                    <div class="tab-pane active" id="navtabs2-lk" role="tabpanel">
                      @include('Tindaklanjut.pelanggaran-unsur-pidana-penyidikan.tabs.laporan-kejadian-tindak-pidana', ['no_ref' => $no_ref])
                    </div>


                    <div class="tab-pane" id="navtabs2-sptp" role="tabpanel">
                      @include('Tindaklanjut.pelanggaran-unsur-pidana-penyidikan.tabs.surat-perintah-tugas-penyidikan', ['no_ref' => $no_ref])
                    </div>


                    <div class="tab-pane" id="navtabs2-spdp" role="tabpanel">
                      @include('Tindaklanjut.pelanggaran-unsur-pidana-penyidikan.tabs.surat-pemberitahuan-dimulainya-penyidikan', ['no_ref' => $no_ref])
                    </div>

                    <div class="tab-pane" id="navtabs2-sp1" role="tabpanel">
                      @include('Tindaklanjut.pelanggaran-unsur-pidana-penyidikan.tabs.surat-panggilan-pertama', [
                          'no_ref' => $no_ref,
                          'nama_negara' => $nama_negara,
                          'sbpData' => $sbpData,
                      ])
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
    document.getElementById("searchTab").addEventListener("keyup", function() {
      let filter = this.value.toLowerCase();
      let tabs = document.querySelectorAll(".nav-item-penyidikan");

      tabs.forEach(tab => {
        let tabText = tab.textContent.toLowerCase();
        if (tabText.includes(filter)) {
          tab.style.display = "";
        } else {
          tab.style.display = "none";
        }
      });
    });

    feather.replace();
  </script>

  <style>
    #searchTab {
      width: 60%;
      max-width: 400px;
    }


    .search-iconnnnnn {
      position: absolute;
      left: 20px;
      top: 50%;
      transform: translateY(-50%);
      color: #6c757d;
    }

    .shadow-custom {
      box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.15);
      transition: box-shadow 0.3s ease-in-out;
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
