@extends('layouts.vertical', ['title' => 'Rekam Pelanggaran Unsur Pidana Penyidikan UR'])

@section('css')
    @vite(['node_modules/datatables.net-bs5/css/dataTables.bootstrap5.min.css', 'node_modules/datatables.net-buttons-bs5/css/buttons.bootstrap5.min.css', 'node_modules/datatables.net-keytable-bs5/css/keyTable.bootstrap5.min.css', 'node_modules/datatables.net-responsive-bs5/css/responsive.bootstrap5.min.css', 'node_modules/datatables.net-select-bs5/css/select.bootstrap5.min.css'])
@endsection
@section('content')
    <div class="container-fluid">
        <form action="{{ route('unsur-pidana-ur.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="card mb-3 mt-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="card-title mb-0">
                        <i data-feather="book" style="width: 20px; height: 20px;" class="me-1"></i>
                        Form Rekam Data Pelanggaran Usur Pidana Penyidikan
                    </h5>
                    <a href="{{ route('unsur-pidana-ur.index') }}" class="btn btn-danger btn-sm">
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
                                            <input type="text" id="searchTab"
                                                class="form-control ps-5 rounded-pill shadow-custom border-0"
                                                placeholder="Cari Surat...........">
                                            <i data-feather="search" class="search-iconnnnnn"></i>
                                        </div>
                                        <ul class="nav nav-pills nav-justified flex-nowrap overflow-auto"
                                            style="white-space: nowrap;" role="tablist">
                                            <li class="nav-item-penyidikan-ur">
                                                <a class="nav-link active" id="navtabs2-sprint-ur-tab" data-bs-toggle="tab"
                                                    href="#navtabs2-sprint-ur" role="tab"
                                                    aria-controls="navtabs2-sprint-ur" aria-selected="true">
                                                    <span class="d-block d-sm-none">(SPRINT UR)</span>
                                                    <span class="d-none d-sm-block">Surat Perintah Penelitian UR</span>
                                                </a>
                                            </li>
                                            <li class="nav-item-penyidikan-ur">
                                                <a class="nav-link " id="navtabs2-upload-form-ur-tab" data-bs-toggle="tab"
                                                    href="#navtabs2-upload-form-ur" role="tab"
                                                    aria-controls="navtabs2-upload-form-ur" aria-selected="false">
                                                    <span class="d-block d-sm-none">(UPLOAD UR)</span>
                                                    <span class="d-none d-sm-block">UPLOAD UR DOCUMENT</span>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>



                                    <div class="tab-content p-3 text-muted">
                                        <input type="hidden" id="id_pelanggaran_unsur_pidana_ur"
                                            name="id_pelanggaran_unsur_pidana_ur" value="">
                                        @if (request()->has('id_penyidikan'))
                                            <input type="hidden" name="id_penyidikan_ref" value="{{ $id_penyidikan }}"
                                                readonly>
                                        @elseif (request()->has('id_pelanggaran_unsur_pidana_penyidikan'))
                                            <input type="hidden" name="id_pelanggaran_unsur_pidana_penyidikan_ref"
                                                value="{{ request()->query('id_pelanggaran_unsur_pidana_penyidikan') }}"
                                                readonly>
                                        @endif


                                        <div class="tab-pane fade show active" id="navtabs2-sprint-ur" role="tabpanel">
                                            @include(
                                                'Tindaklanjut.pelanggaran-unsur-pidana-ur.tabs.surat-perintah-penelitian-ur',
                                                ['no_ref' => $no_ref]
                                            )
                                        </div>

                                        <div class="tab-pane fade" id="navtabs2-upload-form-ur" role="tabpanel">
                                            @include(
                                                'Tindaklanjut.pelanggaran-unsur-pidana-ur.tabs.upload-ur-form',
                                                ['no_ref' => $no_ref]
                                            )
                                        </div>


                                        <div class="card-footer d-flex justify-content-end">
                                            <button type="submit" class="btn btn-success btn-sm me-2">
                                                <i data-feather="save"></i> Simpan Data Unsur Pidana UR
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

        .tab-pane:not(.active) {
            display: none !important;
        }


        .tab-content>.tab-pane {
            display: none;
        }

        .tab-content>.tab-pane.active {
            display: block;
        }
    </style>



    <script>
        document.getElementById("searchTab").addEventListener("keyup", function() {
            let filter = this.value.toLowerCase();
            let tabs = document.querySelectorAll(".nav-item-penyidikan-ur");

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
            return `id_pelanggaran_unsur_pidana_ur${timestamp}_${randomNum}`;
        }

        document.getElementById('id_pelanggaran_unsur_pidana_ur').value = generateUniqueID();
    </script>
@endsection

@section('script')
    @vite(['resources/js/pages/datatable.init.js'])
@endsection
