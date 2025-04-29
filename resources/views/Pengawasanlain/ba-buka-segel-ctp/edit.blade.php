@extends('layouts.vertical', ['title' => 'Edit Berita Acara Buka Segel CTP'])

@section('css')
    @vite(['node_modules/datatables.net-bs5/css/dataTables.bootstrap5.min.css', 'node_modules/datatables.net-buttons-bs5/css/buttons.bootstrap5.min.css', 'node_modules/datatables.net-keytable-bs5/css/keyTable.bootstrap5.min.css', 'node_modules/datatables.net-responsive-bs5/css/responsive.bootstrap5.min.css', 'node_modules/datatables.net-select-bs5/css/select.bootstrap5.min.css'])
@endsection
@section('content')
    <div class="container-fluid">
        <form action="{{ route('ba-buka-segel-ctp.update', ['ba_buka_segel_ctp' => $bukasegelctp->id]) }}" method="POST"
            enctype="multipart/form-data">
            <div class="card mb-3 mt-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="card-title mb-0">
                        <i data-feather="book" style="width: 20px; height: 20px;" class="me-1"></i>
                        Form Edit Data B.A Buka Segel CTP
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
                                        <ul class="nav nav-pills nav-justified flex-nowrap " style="white-space: nowrap;"
                                            role="tablist">
                                            <li class="nav-item">
                                                <a class="nav-link active" id="navtabs2-ba-buka-segel-ctp-tab"
                                                    data-bs-toggle="tab" href="#navtabs2-ba-buka-segel-ctp" role="tab"
                                                    aria-controls="navtabs2-ba-buka-segel-ctp" aria-selected="true">
                                                    <span class="d-block d-sm-none">(BA BUKA SEGEL CTP)</span>
                                                    <span class="d-none d-sm-block">BERITA ACARA BUKA SEGEL CTP</span>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>

                                    <div class="tab-content p-3 text-muted">

                                        <div class="tab-pane active" id="navtabs2-ba-buka-segel-ctp" role="tabpanel">
                                            <div class="container mt-4">
                                                <!-- Header with Logo -->
                                                <div class="row mb-4 align-items-center text-black">
                                                    <div class="col-2 text-center">
                                                        <img src="/images/logocop.png" alt="Logo" class="img-fluid"
                                                            style="max-height:170px;">
                                                    </div>
                                                    <div class="col-10 text-center">
                                                        <h5 class="mb-0">KEMENTERIAN KEUANGAN REPUBLIK INDONESIA</h5>
                                                        <p class="small mb-0">DIREKTORAT JENDERAL BEA DAN CUKAI</p>
                                                        <p class="small mb-0">KANTOR PELAYANAN UTAMA BEA DAN CUKAI TIPE B
                                                            BATAM</p>
                                                        <p class="small mb-0">
                                                            JALAN KUDA LAUT, BATU AMPAR, BATAM, KEPULAUAN RIAU 29432;
                                                            TELEPON (0778) 458118, 458263; FAKSIMILE (0778) 458149;
                                                        </p>
                                                        <p class="small mb-0">
                                                            LAMAN WWW.BCBATAM.BEACUKAI.GO.ID;
                                                            PUSAT KONTAK LAYANAN 1500225;
                                                            SUREL BCBPBATAM@CUSTOMS.GO.ID,
                                                            KPBC.BATAM@KEMENKEU.GO.ID
                                                        </p>
                                                    </div>
                                                </div>

                                                <hr class="border border-dark border-2 bg-dark">


                                                <div class="mb-3 row align-items-center">
                                                    <div class="input-group">
                                                        <span class="input-group-text">NO : BA-</span>
                                                        <input type="text" class="form-control"
                                                            value="{{ old('no_ba_buka_segel_ctp', $bukasegelctp->no_ba_buka_segel_ctp) }}"
                                                            name="no_ba_buka_segel_ctp" readonly>
                                                        <span class="input-group-text">/SGL/KPU.02/BD.06/</span>
                                                        <input type="date" class="form-control"
                                                            name="tgl_ba_buka_segel_ctp"
                                                            value="{{ old('tgl_ba_buka_segel_ctp', $bukasegelctp->tgl_ba_buka_segel_ctp) }}">
                                                    </div>
                                                </div>

                                                <!-- Main Form -->
                                                <div class="card p-4">
                                                    <p class="fw-bold">
                                                        &nbsp;&nbsp;&nbsp;Pada hari ini ................... Saya/Kami* yang
                                                        bertanda tangan di bawah bertindak untuk/ atas nama Kantor Pelayanan
                                                        Utama Bea dan Cukai Tipe B Batam
                                                        Telah Melakukan Pembukaan Catatan Tanda Pengaman Atas:
                                                    </p>
                                                    <div class="card-body">
                                                        <div class="row">
                                                            <div class="col-lg-12">
                                                                <div class="container">

                                                                    <!-- Sarana Pengangkut -->
                                                                    <h5 class="fw-bold">1. Sarana Pengangkut</h5>
                                                                    <div class="mb-3 row">
                                                                        <label class="col-md-3 col-form-label">Nama dan
                                                                            Jenis Sarkut</label>
                                                                        <div class=" col-md-1 text-center mt-1">:</div>
                                                                        <div class="col-md-8">
                                                                            <input type="text"
                                                                                class="form-control border-0 border-0"
                                                                                value="{{ old('nama_jenis_sarkut', $sbpData->nama_jenis_sarkut) }}"
                                                                                readonly>
                                                                        </div>
                                                                    </div>
                                                                    <div class="mb-4 row">
                                                                        <label class="col-md-3 col-form-label">No Reg./ No.
                                                                            Polisi</label>
                                                                        <div class=" col-md-1 text-center mt-1">:</div>
                                                                        <div class="col-md-8">
                                                                            <input type="text"
                                                                                class="form-control border-0"
                                                                                value="{{ old('no_polisi', $sbpData->no_polisi) }}"
                                                                                readonly>
                                                                        </div>
                                                                    </div>
                                                                    <div class="mb-3 row">
                                                                        <label
                                                                            class="col-md-3 col-form-label">Bendera</label>
                                                                        <div class=" col-md-1 text-center mt-1">:</div>
                                                                        <div class="col-md-8">
                                                                            <input type="text"
                                                                                class="form-control border-0 border-0"
                                                                                value="{{ old('bendera', $sbpData->bendera) }}"
                                                                                readonly>
                                                                        </div>
                                                                    </div>
                                                                    <div class="mb-3 row">
                                                                        <label
                                                                            class="col-md-3 col-form-label">Nakhoda/Pilot/Pengemudi*</label>
                                                                        <div class=" col-md-1 text-center mt-1">:</div>
                                                                        <div class="col-md-8">
                                                                            <input type="text"
                                                                                class="form-control border-0 border-0"
                                                                                value="{{ old('pengemudi', $sbpData->pengemudi) }}"
                                                                                readonly>
                                                                        </div>
                                                                    </div>
                                                                    <div class="mb-3 row">
                                                                        <label class="col-md-3 col-form-label">Nomor
                                                                            Identitas</label>
                                                                        <div class=" col-md-1 text-center mt-1">:</div>
                                                                        <div class="col-md-8">
                                                                            <input type="text"
                                                                                class="form-control border-0 border-0"
                                                                                value="{{ old('no_identitas_pengemudi', $sbpData->no_identitas_pengemudi) }}"
                                                                                readonly>
                                                                        </div>
                                                                    </div>
                                                                    <div class="mb-3 row">
                                                                        <label class="col-md-3 col-form-label">Ukuran/
                                                                            Kapasitas Muatan</label>
                                                                        <div class=" col-md-1 text-center mt-1">:</div>
                                                                        <div class="col-md-8">
                                                                            <input type="text"
                                                                                class="form-control border-0"
                                                                                value="{{ old('kapasitas_muatan', $sbpData->kapasitas_muatan) }}"
                                                                                readonly>
                                                                        </div>
                                                                    </div>


                                                                    <!-- Barang -->
                                                                    <h5 class="fw-bold">2. Barang</h5>
                                                                    <div class="mb-3 row">
                                                                        <label class="col-md-3 col-form-label">Jumlah/Jenis
                                                                            Barang</label>
                                                                        <div class=" col-md-1 text-center mt-1">:</div>
                                                                        <div class="col-md-4">
                                                                            <input type="text"
                                                                                class="form-control border-0"
                                                                                value="{{ old('jumlah_barang', $sbpData->jumlah_barang) }}"
                                                                                readonly>
                                                                        </div>
                                                                        <div class="col-md-4">
                                                                            <input type="text"
                                                                                class="form-control border-0"
                                                                                value="{{ old('jenis_barang', $sbpData->jenis_barang) }}"
                                                                                readonly>
                                                                        </div>
                                                                    </div>
                                                                    <div class="mb-4 row">
                                                                        <label class="col-md-3 col-form-label">Jenis/No dan
                                                                            Tgl Dokumen</label>
                                                                        <div class=" col-md-1 text-center mt-1">:</div>
                                                                        <div class="col-md-4">
                                                                            <input type="text"
                                                                                class="form-control border-0"
                                                                                value="{{ old('jenis_no_tgl_dok', $sbpData->jenis_no_tgl_dok) }}"
                                                                                readonly>
                                                                        </div>
                                                                        <div class="col-md-4">
                                                                            <input type="date"
                                                                                class="form-control border-0"
                                                                                value="{{ old('tgl_dokumen', $sbpData->tgl_dokumen) }}"
                                                                                readonly>
                                                                        </div>
                                                                    </div>

                                                                    <!-- Orang -->
                                                                    <h5 class="fw-bold">3. Bangunan atau tempat</h5>
                                                                    <div class="mb-3 row">
                                                                        <label class="col-md-3 col-form-label">Alamat
                                                                            Bangunan/Tempat</label>
                                                                        <div class=" col-md-1 text-center mt-1">:</div>
                                                                        <div class="col-md-8">
                                                                            <input type="text"
                                                                                class="form-control border-0"
                                                                                value="{{ old('alamat_bangunan', $sbpData->alamat_bangunan) }}"
                                                                                readonly>
                                                                        </div>
                                                                    </div>
                                                                    <div class="mb-3 row">
                                                                        <label class="col-md-3 col-form-label">No Reg
                                                                            Bangunan/NPPBKC/NPWP*</label>
                                                                        <div class=" col-md-1 text-center mt-1">:</div>
                                                                        <div class="col-md-8">
                                                                            <input type="text"
                                                                                class="form-control border-0"
                                                                                value="{{ old('no_bangunan', $sbpData->no_bangunan) }}"
                                                                                readonly>
                                                                        </div>
                                                                    </div>
                                                                    <div class="mb-3 row">
                                                                        <label class="col-md-3 col-form-label">Nama
                                                                            Pemilik/Yang Menguasai*</label>
                                                                        <div class=" col-md-1 text-center mt-1">:</div>
                                                                        <div class="col-md-8">
                                                                            <input type="text"
                                                                                class="form-control border-0"
                                                                                value="{{ old('nama_pemilik_bangunan', $sbpData->nama_pemilik_bangunan) }}"
                                                                                readonly>
                                                                        </div>
                                                                    </div>
                                                                    <div class="mb-3 row">
                                                                        <label class="col-md-3 col-form-label">No.
                                                                            Identitas</label>
                                                                        <div class=" col-md-1 text-center mt-1">:</div>
                                                                        <div class="col-md-8">
                                                                            <input type="text"
                                                                                class="form-control border-0"
                                                                                value="{{ old('no_identitas_pemilik_bangunan', $sbpData->no_identitas_pemilik_bangunan) }}"
                                                                                readonly>
                                                                        </div>
                                                                    </div>

                                                                    <div class="mb-3 row">
                                                                        <label class="col-md-3 col-form-label">Jenis Tanda
                                                                            Pengaman (Segel)</label>
                                                                        <div class="col-md-1 text-center mt-1">:</div>
                                                                        <div class="col-md-8">
                                                                            <input type="text" class="form-control"
                                                                                name="jenis_segel_buka_ctp"
                                                                                value="{{ old('jenis_segel_buka_ctp', $bukasegelctp->jenis_segel_buka_ctp) }}"
                                                                                placeholder="Jenis Segel">
                                                                        </div>
                                                                    </div>

                                                                    <div class="mb-3 row">
                                                                        <label class="col-md-3 col-form-label">Jumlah
                                                                            Segel</label>
                                                                        <div class="col-md-1 text-center mt-1">:</div>
                                                                        <div class="col-md-8">
                                                                            <input type="number" class="form-control"
                                                                                name="banyak_segel_buka_ctp"
                                                                                value="{{ old('banyak_segel_buka_ctp', $bukasegelctp->banyak_segel_buka_ctp) }}"
                                                                                placeholder="Jumlah Segel">
                                                                        </div>
                                                                    </div>

                                                                    <div class="mb-3 row">
                                                                        <label class="col-md-3 col-form-label">Nomor
                                                                            Segel</label>
                                                                        <div class="col-md-1 text-center mt-1">:</div>
                                                                        <div class="col-md-8">
                                                                            <input type="text" class="form-control"
                                                                                name="nomor_segel_buka_ctp"
                                                                                value="{{ old('nomor_segel_buka_ctp', $bukasegelctp->nomor_segel_buka_ctp) }}"
                                                                                placeholder="Nomor Segel">
                                                                        </div>
                                                                    </div>

                                                                    <div class="mb-3 row">
                                                                        <label class="col-md-3 col-form-label">Peletakan
                                                                            Segel</label>
                                                                        <div class="col-md-1 text-center mt-1">:</div>
                                                                        <div class="col-md-8">
                                                                            <input type="text" class="form-control"
                                                                                name="penempatan_lokasi_buka_ctp"
                                                                                value="{{ old('penempatan_lokasi_buka_ctp', $bukasegelctp->penempatan_lokasi_buka_ctp) }}"
                                                                                placeholder="Lokasi peletakan segel">
                                                                        </div>
                                                                    </div>

                                                                    <hr>

                                                                    <div class="mb-3 row">
                                                                        <label class="col-md-3 col-form-label">Nama</label>
                                                                        <div class="col-md-1 text-center mt-1">:</div>
                                                                        <div class="col-md-8">
                                                                            <input type="text" class="form-control"
                                                                                name="nama_saksi_buka_ctp"
                                                                                value="{{ old('nama_saksi_buka_ctp', $bukasegelctp->nama_saksi_buka_ctp) }}"
                                                                                placeholder="Nama Saksi">
                                                                        </div>
                                                                    </div>

                                                                    <div class="mb-3 row">
                                                                        <label
                                                                            class="col-md-3 col-form-label">Alamat</label>
                                                                        <div class="col-md-1 text-center mt-1">:</div>
                                                                        <div class="col-md-8">
                                                                            <input type="text" class="form-control"
                                                                                name="alamat_saksi_buka_ctp"
                                                                                value="{{ old('alamat_saksi_buka_ctp', $bukasegelctp->alamat_saksi_buka_ctp) }}"
                                                                                placeholder="Alamat Saksi">
                                                                        </div>
                                                                    </div>

                                                                    <div class="mb-3 row">
                                                                        <label
                                                                            class="col-md-3 col-form-label">Pekerjaan</label>
                                                                        <div class="col-md-1 text-center mt-1">:</div>
                                                                        <div class="col-md-8">
                                                                            <input type="text" class="form-control"
                                                                                name="pekerjaan_saksi_buka_ctp"
                                                                                value="{{ old('pekerjaan_saksi_buka_ctp', $bukasegelctp->pekerjaan_saksi_buka_ctp) }}"
                                                                                placeholder="Pekerjaan Saksi">
                                                                        </div>
                                                                    </div>

                                                                    <div class="mb-3 row">
                                                                        <label class="col-md-3 col-form-label">Jenis
                                                                            Identitas</label>
                                                                        <div class="col-md-1 text-center mt-1">:</div>
                                                                        <div class="col-md-8">
                                                                            <input type="text" class="form-control"
                                                                                name="jenis_identitas_saksi_buka_ctp"
                                                                                value="{{ old('jenis_identitas_sa ksi_buka_ctp', $bukasegelctp->jenis_identitas_saksi_buka_ctp) }}"
                                                                                placeholder="Jenis Identitas">
                                                                        </div>
                                                                    </div>

                                                                    <div class="mb-3 row">
                                                                        <label class="col-md-3 col-form-label">Nomor
                                                                            Identitas</label>
                                                                        <div class="col-md-1 text-center mt-1">:</div>
                                                                        <div class="col-md-8">
                                                                            <input type="text" class="form-control"
                                                                                name="no_identitas_saksi_buka_ctp"
                                                                                value="{{ old('no_identitas_saksi_buka_ctp', $bukasegelctp->no_identitas_saksi_buka_ctp) }}"
                                                                                placeholder="Nomor Identitas">
                                                                        </div>
                                                                    </div>


                                                                    <p class="fw-bold">
                                                                        Demikian Berita Acara ini dibuat dengan sebenarnya.
                                                                    </p>

                                                                    <div class="mb-3 row">
                                                                        <label class="col-md-3 col-form-label">Pejabat
                                                                            pertama yang melakukan Buka Segel CTP</label>
                                                                        <div class="col-md-1 text-center mt-1">:</div>
                                                                        <div class="col-md-8">
                                                                            <select
                                                                                class="form-control form-select select2"
                                                                                name="pejabat_pertama_buka_ctp">
                                                                                <option value="" disabled
                                                                                    {{ old('pejabat_pertama_buka_ctp', $bukasegelctp->pejabat_pertama_buka_ctp) == '' ? 'selected' : '' }}>
                                                                                    - Pilih -</option>
                                                                                @foreach ($users as $user)
                                                                                    <option value="{{ $user->id_admin }}"
                                                                                        {{ old('pejabat_pertama_buka_ctp', $bukasegelctp->pejabat_pertama_buka_ctp) == $user->id_admin ? 'selected' : '' }}>
                                                                                        {{ $user->name }} |
                                                                                        {{ $user->jabatan }}
                                                                                    </option>
                                                                                @endforeach
                                                                            </select>
                                                                        </div>
                                                                    </div>

                                                                    <div class="mb-3 row">
                                                                        <label class="col-md-3 col-form-label">Pejabat
                                                                            kedua yang melakukan Buka Segel CTP</label>
                                                                        <div class="col-md-1 text-center mt-1">:</div>
                                                                        <div class="col-md-8">
                                                                            <select
                                                                                class="form-control form-select select2"
                                                                                name="pejabat_kedua_buka_ctp">
                                                                                <option value="" disabled
                                                                                    {{ old('pejabat_kedua_buka_ctp', $bukasegelctp->pejabat_kedua_buka_ctp) == '' ? 'selected' : '' }}>
                                                                                    - Pilih -</option>
                                                                                @foreach ($users as $user)
                                                                                    <option value="{{ $user->id_admin }}"
                                                                                        {{ old('pejabat_kedua_buka_ctp', $bukasegelctp->pejabat_kedua_buka_ctp) == $user->id_admin ? 'selected' : '' }}>
                                                                                        {{ $user->name }} |
                                                                                        {{ $user->jabatan }}
                                                                                    </option>
                                                                                @endforeach
                                                                            </select>
                                                                        </div>
                                                                    </div>

                                                                </div>
                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>



                                        <div class="card-footer d-flex justify-content-end">
                                            <button type="submit" class="btn btn-success btn-sm me-2">
                                                <i data-feather="save"></i> Simpan Data Berita Acara Segel CTP
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
@endsection

@section('script')
    @vite(['resources/js/pages/datatable.init.js'])
@endsection
  
