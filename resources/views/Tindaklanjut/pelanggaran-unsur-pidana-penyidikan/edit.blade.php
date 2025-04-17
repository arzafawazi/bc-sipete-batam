@extends('layouts.vertical', ['title' => 'Edit Pelanggaran Unsur Pidana Penyidikan'])

@section('css')
    @vite(['node_modules/datatables.net-bs5/css/dataTables.bootstrap5.min.css', 'node_modules/datatables.net-buttons-bs5/css/buttons.bootstrap5.min.css', 'node_modules/datatables.net-keytable-bs5/css/keyTable.bootstrap5.min.css', 'node_modules/datatables.net-responsive-bs5/css/responsive.bootstrap5.min.css', 'node_modules/datatables.net-select-bs5/css/select.bootstrap5.min.css'])
@endsection
@section('content')
    <div class="container-fluid">
        <form action="{{ route('unsur-pidana-penyidikan.update', ['unsur_pidana_penyidikan' => $unsurpenyidikan->id]) }}"
            method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="card mb-3 mt-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="card-title mb-0">
                        <i data-feather="book" style="width: 20px; height: 20px;" class="me-1"></i>
                        Form Edit Data Pelanggaran Usur Pidana Penyidikan
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
                                            <input type="text" id="searchTab"
                                                class="form-control ps-5 rounded-pill shadow-custom border-0"
                                                placeholder="Cari Surat...........">
                                            <i data-feather="search" class="search-iconnnnnn"></i>
                                        </div>
                                        <ul class="nav nav-pills nav-justified flex-nowrap overflow-auto"
                                            style="white-space: nowrap;" role="tablist">
                                            <li class="nav-item-penyidikan">
                                                <a class="nav-link active" id="navtabs2-lk-tab" data-bs-toggle="tab"
                                                    href="#navtabs2-lk" role="tab" aria-controls="navtabs2-lk"
                                                    aria-selected="true">
                                                    <span class="d-block d-sm-none">(LK)</span>
                                                    <span class="d-none d-sm-block">LAPORAN KEJADIAN TINDAK PIDANA</span>
                                                </a>
                                            </li>
                                            <li class="nav-item-penyidikan">
                                                <a class="nav-link " id="navtabs2-sptp-tab" data-bs-toggle="tab"
                                                    href="#navtabs2-sptp" role="tab" aria-controls="navtabs2-sptp"
                                                    aria-selected="false">
                                                    <span class="d-block d-sm-none">(SPTP)</span>
                                                    <span class="d-none d-sm-block">SURAT PERINTAH TUGAS PENYIDIKAN</span>
                                                </a>
                                            </li>
                                            <li class="nav-item-penyidikan">
                                                <a class="nav-link " id="navtabs2-spdp-tab" data-bs-toggle="tab"
                                                    href="#navtabs2-spdp" role="tab" aria-controls="navtabs2-spdp"
                                                    aria-selected="false">
                                                    <span class="d-block d-sm-none">(SPDP)</span>
                                                    <span class="d-none d-sm-block">SURAT PEMBERITAHUAN DIMULAINYA
                                                        PENYIDIKAN</span>
                                                </a>
                                            </li>
                                            <li class="nav-item-penyidikan">
                                                <a class="nav-link " id="navtabs2-sp1-tab" data-bs-toggle="tab"
                                                    href="#navtabs2-sp1" role="tab" aria-controls="navtabs2-sp1"
                                                    aria-selected="false">
                                                    <span class="d-block d-sm-none">(SP-I, SP-II, SPM)</span>
                                                    <span class="d-none d-sm-block">SURAT PANGGILAN I, II, SURAT PERINTAH
                                                        MEMBAWA</span>
                                                </a>
                                            </li>
                                            <li class="nav-item-penyidikan">
                                                <a class="nav-link " id="navtabs2-data-ahli-tab" data-bs-toggle="tab"
                                                    href="#navtabs2-data-ahli" role="tab"
                                                    aria-controls="navtabs2-data-ahli" aria-selected="false">
                                                    <span class="d-block d-sm-none">(DATA AHLI)</span>
                                                    <span class="d-none d-sm-block">DATA AHLI</span>
                                                </a>
                                            </li>
                                            <li class="nav-item-penyidikan">
                                                <a class="nav-link " id="navtabs2-baw-bap-tab" data-bs-toggle="tab"
                                                    href="#navtabs2-baw-bap" role="tab" aria-controls="navtabs2-baw-bap"
                                                    aria-selected="false">
                                                    <span class="d-block d-sm-none">(BAW & BAP)</span>
                                                    <span class="d-none d-sm-block">BERITA ACARA WAWANCARA & BERITA ACARA
                                                        PEMERIKSAAN</span>
                                                </a>
                                            </li>
                                            <li class="nav-item-penyidikan">
                                                <a class="nav-link " id="navtabs2-ba-sumpah-tab" data-bs-toggle="tab"
                                                    href="#navtabs2-ba-sumpah" role="tab"
                                                    aria-controls="navtabs2-ba-sumpah" aria-selected="false">
                                                    <span class="d-block d-sm-none">(BA-SUMPAH)</span>
                                                    <span class="d-none d-sm-block">BERITA ACARA SUMPAH</span>
                                                </a>
                                            </li>
                                            <li class="nav-item-penyidikan">
                                                <a class="nav-link " id="navtabs2-sppr-tab" data-bs-toggle="tab"
                                                    href="#navtabs2-sppr" role="tab" aria-controls="navtabs2-sppr"
                                                    aria-selected="false">
                                                    <span class="d-block d-sm-none">(SPPR)</span>
                                                    <span class="d-none d-sm-block">SURAT PERINTAH PENGGELEDAHAN
                                                        RUMAH/BANGUNAN</span>
                                                </a>
                                            </li>
                                            <li class="nav-item-penyidikan">
                                                <a class="nav-link " id="navtabs2-ba-penggeledahan-tab"
                                                    data-bs-toggle="tab" href="#navtabs2-ba-penggeledahan" role="tab"
                                                    aria-controls="navtabs2-ba-penggeledahan" aria-selected="false">
                                                    <span class="d-block d-sm-none">(BA PENGGELEDAHAN)</span>
                                                    <span class="d-none d-sm-block">BERITA ACARA PENGGELEDAHAN</span>
                                                </a>
                                            </li>
                                            <li class="nav-item-penyidikan">
                                                <a class="nav-link " id="navtabs2-spp-tab" data-bs-toggle="tab"
                                                    href="#navtabs2-spp" role="tab" aria-controls="navtabs2-spp"
                                                    aria-selected="false">
                                                    <span class="d-block d-sm-none">(SPP)</span>
                                                    <span class="d-none d-sm-block">SURAT PERINTAH PENYITAAN</span>
                                                </a>
                                            </li>
                                            <li class="nav-item-penyidikan">
                                                <a class="nav-link " id="navtabs2-ba-penyitaan-tab" data-bs-toggle="tab"
                                                    href="#navtabs2-ba-penyitaan" role="tab"
                                                    aria-controls="navtabs2-ba-penyitaan" aria-selected="false">
                                                    <span class="d-block d-sm-none">(BA PENYITAAN)</span>
                                                    <span class="d-none d-sm-block">BERITA ACARA PENYITAAN</span>
                                                </a>
                                            </li>
                                            <li class="nav-item-penyidikan">
                                                <a class="nav-link " id="navtabs2-sppp-tab" data-bs-toggle="tab"
                                                    href="#navtabs2-sppp" role="tab" aria-controls="navtabs2-sppp"
                                                    aria-selected="false">
                                                    <span class="d-block d-sm-none">(SPPP)</span>
                                                    <span class="d-none d-sm-block">SURAT PERINTAH PEMOTRETAN DAN/ATAU
                                                        PEREKAMAN MELALUI MEDIA AUDIOVISUAL
                                                    </span>
                                                </a>
                                            </li>
                                            <li class="nav-item-penyidikan">
                                                <a class="nav-link " id="navtabs2-ba-pemotretan-tab" data-bs-toggle="tab"
                                                    href="#navtabs2-ba-pemotretan" role="tab"
                                                    aria-controls="navtabs2-ba-pemotretan" aria-selected="false">
                                                    <span class="d-block d-sm-none">(BA PEMOTRETAN)</span>
                                                    <span class="d-none d-sm-block">BERITA ACARA PEMOTRETAN</span>
                                                </a>
                                            </li>
                                            <li class="nav-item-penyidikan">
                                                <a class="nav-link " id="navtabs2-sppsj-tab" data-bs-toggle="tab"
                                                    href="#navtabs2-sppsj" role="tab" aria-controls="navtabs2-sppsj"
                                                    aria-selected="false">
                                                    <span class="d-block d-sm-none">(SPPSJ)</span>
                                                    <span class="d-none d-sm-block">SURAT PERINTAH PENGAMBILAN SIDIK JARI
                                                    </span>
                                                </a>
                                            </li>
                                            <li class="nav-item-penyidikan">
                                                <a class="nav-link " id="navtabs2-ba-sidik-jari-tab" data-bs-toggle="tab"
                                                    href="#navtabs2-ba-sidik-jari" role="tab"
                                                    aria-controls="navtabs2-ba-sidik-jari" aria-selected="false">
                                                    <span class="d-block d-sm-none">(BA SIDIK JARI)</span>
                                                    <span class="d-none d-sm-block">BERITA ACARA PENGAMBILAN SIDIK
                                                        JARI</span>
                                                </a>
                                            </li>
                                            <li class="nav-item-penyidikan">
                                                <a class="nav-link " id="navtabs2-spfd-tab" data-bs-toggle="tab"
                                                    href="#navtabs2-spfd" role="tab" aria-controls="navtabs2-spfd"
                                                    aria-selected="false">
                                                    <span class="d-block d-sm-none">(SPFD)</span>
                                                    <span class="d-none d-sm-block">SURAT PERINTAH FORENSIK DIGITAL
                                                    </span>
                                                </a>
                                            </li>
                                            <li class="nav-item-penyidikan">
                                                <a class="nav-link " id="navtabs2-ba-forensik-digital-tab"
                                                    data-bs-toggle="tab" href="#navtabs2-ba-forensik-digital"
                                                    role="tab" aria-controls="navtabs2-ba-forensik-digital"
                                                    aria-selected="false">
                                                    <span class="d-block d-sm-none">(BA FORENSIK DIGITAL)</span>
                                                    <span class="d-none d-sm-block">BERITA ACARA FORENSIK DIGITAL</span>
                                                </a>
                                            </li>
                                            <li class="nav-item-penyidikan">
                                                <a class="nav-link" id="navtabs2-ba-gelar-perkara-tab"
                                                    data-bs-toggle="tab" href="#navtabs2-ba-gelar-perkara" role="tab"
                                                    aria-controls="navtabs2-ba-gelar-perkara" aria-selected="false">
                                                    <span class="d-block d-sm-none">(BA GELAR PERKARA)</span>
                                                    <span class="d-none d-sm-block">BERITA ACARA GELAR PERKARA</span>
                                                </a>
                                            </li>
                                            <li class="nav-item-penyidikan">
                                                <a class="nav-link " id="navtabs2-staptsk-tab" data-bs-toggle="tab"
                                                    href="#navtabs2-staptsk" role="tab"
                                                    aria-controls="navtabs2-staptsk" aria-selected="false">
                                                    <span class="d-block d-sm-none">(S.TAPTSK PENETAPAN)</span>
                                                    <span class="d-none d-sm-block">SURAT PENETAPAN TERSANGKA
                                                    </span>
                                                </a>
                                            </li>
                                            <li class="nav-item-penyidikan">
                                                <a class="nav-link " id="navtabs2-staptsk-pemberitahuan-tab"
                                                    data-bs-toggle="tab" href="#navtabs2-staptsk-pemberitahuan"
                                                    role="tab" aria-controls="navtabs2-staptsk-pemberitahuan"
                                                    aria-selected="false">
                                                    <span class="d-block d-sm-none">(S.TAPTSK PEMBERITAHUAN)</span>
                                                    <span class="d-none d-sm-block">SURAT PEMBERITAHUAN PENETAPAN TERSANGKA
                                                    </span>
                                                </a>
                                            </li>
                                            <li class="nav-item-penyidikan">
                                                <a class="nav-link " id="navtabs2-sppenang-tab" data-bs-toggle="tab"
                                                    href="#navtabs2-sppenang" role="tab"
                                                    aria-controls="navtabs2-sppenang" aria-selected="false">
                                                    <span class="d-block d-sm-none">(SPP PENANGKAPAN)</span>
                                                    <span class="d-none d-sm-block"> SURAT PERINTAH PENANGKAPAN
                                                    </span>
                                                </a>
                                            </li>
                                            <li class="nav-item-penyidikan">
                                                <a class="nav-link " id="navtabs2-ba-penangkapan-tab"
                                                    data-bs-toggle="tab" href="#navtabs2-ba-penangkapan" role="tab"
                                                    aria-controls="navtabs2-ba-penangkapan" aria-selected="false">
                                                    <span class="d-block d-sm-none">(BA PENANGKAPAN)</span>
                                                    <span class="d-none d-sm-block"> BERITA ACARA PENANGKAPAN
                                                    </span>
                                                </a>
                                            </li>
                                            <li class="nav-item-penyidikan">
                                                <a class="nav-link " id="navtabs2-sppenang-pemberitahuan-tab"
                                                    data-bs-toggle="tab" href="#navtabs2-sppenang-pemberitahuan"
                                                    role="tab" aria-controls="navtabs2-sppenang-pemberitahuan"
                                                    aria-selected="false">
                                                    <span class="d-block d-sm-none">(SPP PEMBERITAHUAN)</span>
                                                    <span class="d-none d-sm-block"> SURAT PERINTAH PENANGKAPAN
                                                        PEMBERITAHUAN
                                                    </span>
                                                </a>
                                            </li>
                                            <li class="nav-item-penyidikan">
                                                <a class="nav-link " id="navtabs2-sppenah-tab" data-bs-toggle="tab"
                                                    href="#navtabs2-sppenah" role="tab"
                                                    aria-controls="navtabs2-sppenah" aria-selected="false">
                                                    <span class="d-block d-sm-none">(SPP PENAHANAN)</span>
                                                    <span class="d-none d-sm-block"> SURAT PERINTAH PENAHANAN
                                                    </span>
                                                </a>
                                            </li>
                                            <li class="nav-item-penyidikan">
                                                <a class="nav-link " id="navtabs2-ba-penahanan-tab" data-bs-toggle="tab"
                                                    href="#navtabs2-ba-penahanan" role="tab"
                                                    aria-controls="navtabs2-ba-penahanan" aria-selected="false">
                                                    <span class="d-block d-sm-none">(BA PENAHANAN)</span>
                                                    <span class="d-none d-sm-block"> BERITA ACARA PENAHANAN
                                                    </span>
                                                </a>
                                            </li>
                                            <li class="nav-item-penyidikan">
                                                <a class="nav-link " id="navtabs2-tindak-lanjut-pidana-tab"
                                                    data-bs-toggle="tab" href="#navtabs2-tindak-lanjut-pidana"
                                                    role="tab" aria-controls="navtabs2-tindak-lanjut-pidana"
                                                    aria-selected="false">
                                                    <span class="d-block d-sm-none">(TINDAK LANJUT)</span>
                                                    <span class="d-none d-sm-block"> TINDAK LANJUT UNSUR PIDANA PENYIDIKAN
                                                    </span>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>

                                    <div class="tab-content p-3 text-muted">

                                        <div class="tab-pane active" id="navtabs2-lk" role="tabpanel">
                                            @include(
                                                'Tindaklanjut.pelanggaran-unsur-pidana-penyidikan.tabs.laporan-kejadian-tindak-pidana',
                                                ['unsurpenyidikan' => $unsurpenyidikan]
                                            )
                                        </div>

                                        <div class="tab-pane" id="navtabs2-sptp" role="tabpanel">
                                            @include(
                                                'Tindaklanjut.pelanggaran-unsur-pidana-penyidikan.tabs.surat-perintah-tugas-penyidikan',
                                                ['unsurpenyidikan' => $unsurpenyidikan]
                                            )
                                        </div>

                                        <div class="tab-pane" id="navtabs2-spdp" role="tabpanel">
                                            @include(
                                                'Tindaklanjut.pelanggaran-unsur-pidana-penyidikan.tabs.surat-pemberitahuan-dimulainya-penyidikan',
                                                ['unsurpenyidikan' => $unsurpenyidikan]
                                            )
                                        </div>

                                        <div class="tab-pane" id="navtabs2-sp1" role="tabpanel">
                                            @include(
                                                'Tindaklanjut.pelanggaran-unsur-pidana-penyidikan.tabs.surat-panggilan-pertama',
                                                [
                                                    'no_ref' => $no_ref,
                                                    'nama_negara' => $nama_negara,
                                                    'sbpData' => $sbpData,
                                                    'users' => $users,
                                                ]
                                            )
                                        </div>

                                        <div class="tab-pane" id="navtabs2-baw-bap" role="tabpanel">
                                            @include(
                                                'Tindaklanjut.pelanggaran-unsur-pidana-penyidikan.tabs.baw-bap',
                                                [
                                                    'no_ref' => $no_ref,
                                                    'nama_negara' => $nama_negara,
                                                    'sbpData' => $sbpData,
                                                    'users' => $users,
                                                ]
                                            )
                                        </div>


                                        <div class="tab-pane" id="navtabs2-data-ahli" role="tabpanel">
                                            @include(
                                                'Tindaklanjut.pelanggaran-unsur-pidana-penyidikan.tabs.data-ahli',
                                                [
                                                    'no_ref' => $no_ref,
                                                    'nama_negara' => $nama_negara,
                                                    'sbpData' => $sbpData,
                                                    'users' => $users,
                                                ]
                                            )
                                        </div>

                                        <div class="tab-pane" id="navtabs2-ba-sumpah" role="tabpanel">
                                            @include(
                                                'Tindaklanjut.pelanggaran-unsur-pidana-penyidikan.tabs.ba-sumpah',
                                                [
                                                    'no_ref' => $no_ref,
                                                    'nama_negara' => $nama_negara,
                                                    'sbpData' => $sbpData,
                                                    'users' => $users,
                                                ]
                                            )
                                        </div>


                                        <div class="tab-pane" id="navtabs2-sppr" role="tabpanel">
                                            @include(
                                                'Tindaklanjut.pelanggaran-unsur-pidana-penyidikan.tabs.surat-perintah-penggeledahan',
                                                [
                                                    'sbpData' => $sbpData,
                                                    'users' => $users,
                                                    'no_ref' => $no_ref,
                                                ]
                                            )
                                        </div>

                                        <div class="tab-pane" id="navtabs2-ba-penggeledahan" role="tabpanel">
                                            @include(
                                                'Tindaklanjut.pelanggaran-unsur-pidana-penyidikan.tabs.ba-penggeledahan',
                                                [
                                                    'sbpData' => $sbpData,
                                                    'users' => $users,
                                                    'no_ref' => $no_ref,
                                                ]
                                            )
                                        </div>

                                        <div class="tab-pane" id="navtabs2-spp" role="tabpanel">
                                            @include(
                                                'Tindaklanjut.pelanggaran-unsur-pidana-penyidikan.tabs.surat-perintah-penyitaan',
                                                [
                                                    'sbpData' => $sbpData,
                                                    'users' => $users,
                                                    'no_ref' => $no_ref,
                                                ]
                                            )
                                        </div>

                                        <div class="tab-pane" id="navtabs2-ba-penyitaan" role="tabpanel">
                                            @include(
                                                'Tindaklanjut.pelanggaran-unsur-pidana-penyidikan.tabs.ba-penyitaan',
                                                [
                                                    'sbpData' => $sbpData,
                                                    'users' => $users,
                                                    'no_ref' => $no_ref,
                                                ]
                                            )
                                        </div>

                                        <div class="tab-pane" id="navtabs2-sppp" role="tabpanel">
                                            @include(
                                                'Tindaklanjut.pelanggaran-unsur-pidana-penyidikan.tabs.surat-perintah-pemotretan-perekaman',
                                                [
                                                    'sbpData' => $sbpData,
                                                    'users' => $users,
                                                    'no_ref' => $no_ref,
                                                ]
                                            )
                                        </div>

                                        <div class="tab-pane" id="navtabs2-sppp" role="tabpanel">
                                            @include(
                                                'Tindaklanjut.pelanggaran-unsur-pidana-penyidikan.tabs.surat-perintah-pemotretan-perekaman',
                                                [
                                                    'sbpData' => $sbpData,
                                                    'users' => $users,
                                                    'no_ref' => $no_ref,
                                                ]
                                            )
                                        </div>

                                        <div class="tab-pane" id="navtabs2-ba-pemotretan" role="tabpanel">
                                            @include(
                                                'Tindaklanjut.pelanggaran-unsur-pidana-penyidikan.tabs.ba-pemotretan-perekaman',
                                                [
                                                    'sbpData' => $sbpData,
                                                    'users' => $users,
                                                    'no_ref' => $no_ref,
                                                ]
                                            )
                                        </div>


                                        <div class="tab-pane" id="navtabs2-sppsj" role="tabpanel">
                                            @include(
                                                'Tindaklanjut.pelanggaran-unsur-pidana-penyidikan.tabs.surat-perintah-pengambilan-sidik-jari',
                                                [
                                                    'sbpData' => $sbpData,
                                                    'users' => $users,
                                                    'no_ref' => $no_ref,
                                                ]
                                            )
                                        </div>


                                        <div class="tab-pane" id="navtabs2-ba-sidik-jari" role="tabpanel">
                                            @include(
                                                'Tindaklanjut.pelanggaran-unsur-pidana-penyidikan.tabs.ba-pengambilan-sidik-jari',
                                                [
                                                    'sbpData' => $sbpData,
                                                    'users' => $users,
                                                    'no_ref' => $no_ref,
                                                ]
                                            )
                                        </div>

                                        <div class="tab-pane" id="navtabs2-spfd" role="tabpanel">
                                            @include(
                                                'Tindaklanjut.pelanggaran-unsur-pidana-penyidikan.tabs.surat-perintah-forensik-digital',
                                                [
                                                    'sbpData' => $sbpData,
                                                    'users' => $users,
                                                    'no_ref' => $no_ref,
                                                ]
                                            )
                                        </div>

                                        <div class="tab-pane" id="navtabs2-ba-forensik-digital" role="tabpanel">
                                            @include(
                                                'Tindaklanjut.pelanggaran-unsur-pidana-penyidikan.tabs.ba-forensik-digital',
                                                [
                                                    'sbpData' => $sbpData,
                                                    'users' => $users,
                                                    'no_ref' => $no_ref,
                                                ]
                                            )
                                        </div>

                                        <div class="tab-pane" id="navtabs2-ba-gelar-perkara" role="tabpanel">
                                            @include(
                                                'Tindaklanjut.pelanggaran-unsur-pidana-penyidikan.tabs.ba-gelar-perkara',
                                                [
                                                    'sbpData' => $sbpData,
                                                    'users' => $users,
                                                    'no_ref' => $no_ref,
                                                ]
                                            )
                                        </div>

                                        <div class="tab-pane" id="navtabs2-staptsk" role="tabpanel">
                                            @include(
                                                'Tindaklanjut.pelanggaran-unsur-pidana-penyidikan.tabs.surat-penetapan-tersangka',
                                                [
                                                    'sbpData' => $sbpData,
                                                    'users' => $users,
                                                    'no_ref' => $no_ref,
                                                ]
                                            )
                                        </div>

                                        <div class="tab-pane" id="navtabs2-staptsk-pemberitahuan" role="tabpanel">
                                            @include(
                                                'Tindaklanjut.pelanggaran-unsur-pidana-penyidikan.tabs.surat-pemberitahuan-penetapan-tersangka',
                                                [
                                                    'sbpData' => $sbpData,
                                                    'users' => $users,
                                                    'no_ref' => $no_ref,
                                                ]
                                            )
                                        </div>

                                        <div class="tab-pane" id="navtabs2-sppenang" role="tabpanel">
                                            @include(
                                                'Tindaklanjut.pelanggaran-unsur-pidana-penyidikan.tabs.surat-perintah-penangkapan',
                                                [
                                                    'sbpData' => $sbpData,
                                                    'users' => $users,
                                                    'no_ref' => $no_ref,
                                                ]
                                            )
                                        </div>

                                        <div class="tab-pane" id="navtabs2-ba-penangkapan" role="tabpanel">
                                            @include(
                                                'Tindaklanjut.pelanggaran-unsur-pidana-penyidikan.tabs.ba-penangkapan',
                                                [
                                                    'sbpData' => $sbpData,
                                                    'users' => $users,
                                                    'no_ref' => $no_ref,
                                                ]
                                            )
                                        </div>

                                        <div class="tab-pane" id="navtabs2-sppenang-pemberitahuan" role="tabpanel">
                                            @include(
                                                'Tindaklanjut.pelanggaran-unsur-pidana-penyidikan.tabs.surat-pemberitahuan-penangkapan',
                                                [
                                                    'sbpData' => $sbpData,
                                                    'users' => $users,
                                                    'no_ref' => $no_ref,
                                                ]
                                            )
                                        </div>

                                        <div class="tab-pane" id="navtabs2-sppenah" role="tabpanel">
                                            @include(
                                                'Tindaklanjut.pelanggaran-unsur-pidana-penyidikan.tabs.surat-perintah-penahanan',
                                                [
                                                    'sbpData' => $sbpData,
                                                    'users' => $users,
                                                    'no_ref' => $no_ref,
                                                ]
                                            )
                                        </div>

                                        <div class="tab-pane" id="navtabs2-ba-penahanan" role="tabpanel">
                                            @include(
                                                'Tindaklanjut.pelanggaran-unsur-pidana-penyidikan.tabs.ba-penahanan',
                                                [
                                                    'sbpData' => $sbpData,
                                                    'users' => $users,
                                                    'no_ref' => $no_ref,
                                                ]
                                            )
                                        </div>

                                        <div class="tab-pane" id="navtabs2-tindak-lanjut-pidana" role="tabpanel">
                                            @include(
                                                'Tindaklanjut.pelanggaran-unsur-pidana-penyidikan.tabs.tindak-lanjut-pidana-penyidikan',
                                                [
                                                    'sbpData' => $sbpData,
                                                    'users' => $users,
                                                    'no_ref' => $no_ref,
                                                ]
                                            )
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
