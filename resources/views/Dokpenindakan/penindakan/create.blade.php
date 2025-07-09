@extends('layouts.vertical', ['title' => 'Rekam Form Penindakan'])

@section('css')
    @vite(['node_modules/datatables.net-bs5/css/dataTables.bootstrap5.min.css', 'node_modules/datatables.net-buttons-bs5/css/buttons.bootstrap5.min.css', 'node_modules/datatables.net-keytable-bs5/css/keyTable.bootstrap5.min.css', 'node_modules/datatables.net-responsive-bs5/css/responsive.bootstrap5.min.css', 'node_modules/datatables.net-select-bs5/css/select.bootstrap5.min.css'])
@endsection


@section('content')
    <div class="container-fluid">
        <div class="card mb-3 mt-4">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="card-title mb-0">
                    <i data-feather="book" style="width: 20px; height: 20px;" class="me-1"></i>
                    Form Penindakan
                </h5>
                <button type="button" class="btn btn-danger btn-sm" onclick="window.history.back()">
                    <i data-feather="log-out"></i> Kembali
                </button>
            </div>

            <div class="card-body">
                <form action="{{ route('penindakan.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="card">
                        <div class="row">
                            <div class="tabs-container" id="tabs-container">
                            <div class="mb-3 position-relative">
                                <input type="text" id="searchTab" class="form-control ps-5 rounded-pill shadow-custom border-0" placeholder="Cari Surat...........">
                                <i data-feather="search" class="search-iconnnnnn"></i>
                                </div>
                                <ul class="nav nav-pills nav-justified flex-nowrap overflow-auto mb-3"
                                    style="white-space: nowrap;" role="tablist">
                                    <li class="nav-item nav-item-penindakan">
                                        <a class="nav-link active" id="penindakan-tab" data-bs-toggle="pill"
                                            href="#penindakan" role="tab" aria-controls="penindakan"
                                            aria-selected="true">
                                            <span class="d-block d-sm-none">Data Penindakan</span>
                                            <span class="d-none d-sm-block">Data Penindakan</span>
                                        </a>
                                    </li>
                                    <li class="nav-item nav-item-penindakan">
                                        <a class="nav-link" id="ba-henti-tab" data-bs-toggle="pill" href="#ba-henti"
                                            role="tab" aria-controls="ba-henti" aria-selected="false">
                                            <span class="d-block d-sm-none">Penghentian</span>
                                            <span class="d-none d-sm-block">Penghentian</span>
                                        </a>
                                    </li>

                                    <li class="nav-item nav-item-penindakan">
                                        <a class="nav-link" id="ba-riksa-tab" data-bs-toggle="pill" href="#ba-riksa"
                                            role="tab" aria-controls="ba-riksa" aria-selected="false">
                                            <span class="d-block d-sm-none">Pemeriksaan</span>
                                            <span class="d-none d-sm-block">Pemeriksaan</span>
                                        </a>
                                    </li>

                                    <li class="nav-item nav-item-penindakan">
                                        <a class="nav-link" id="ba-sarkut-tab" data-bs-toggle="pill" href="#ba-sarkut"
                                            role="tab" aria-controls="ba-sarkut" aria-selected="false">
                                            <span class="d-block d-sm-none">(B.A Sarkut)</span>
                                            <span class="d-none d-sm-block">B.A Sarkut</span>
                                        </a>
                                    </li>

                                    <li class="nav-item nav-item-penindakan">
                                        <a class="nav-link" id="ba-contoh-tab" data-bs-toggle="pill" href="#ba-contoh"
                                            role="tab" aria-controls="ba-contoh" aria-selected="false">
                                            <span class="d-block d-sm-none">(B.A Contoh)</span>
                                            <span class="d-none d-sm-block">B.A Contoh</span>
                                        </a>
                                    </li>

                                    <li class="nav-item nav-item-penindakan">
                                        <a class="nav-link" id="ba-dok-tab" data-bs-toggle="pill" href="#ba-dok"
                                            role="tab" aria-controls="ba-dok" aria-selected="false">
                                            <span class="d-block d-sm-none">(B.A DOK)</span>
                                            <span class="d-none d-sm-block">B.A Dokumentasi</span>
                                        </a>
                                    </li>

                                    <li class="nav-item nav-item-penindakan">
                                        <a class="nav-link" id="ba-tegah-tab" data-bs-toggle="pill" href="#ba-tegah"
                                            role="tab" aria-controls="ba-tegah" aria-selected="false">
                                            <span class="d-block d-sm-none">(B.A Tegah)</span>
                                            <span class="d-none d-sm-block">B.A Tegah</span>
                                        </a>
                                    </li>

                                    <li class="nav-item nav-item-penindakan">
                                        <a class="nav-link" id="ba-segel-tab" data-bs-toggle="pill" href="#ba-segel"
                                            role="tab" aria-controls="ba-segel" aria-selected="false">
                                            <span class="d-block d-sm-none">(B.A Segel)</span>
                                            <span class="d-none d-sm-block">B.A Segel</span>
                                        </a>
                                    </li>

                                    <li class="nav-item nav-item-penindakan">
                                        <a class="nav-link" id="ba-titip-tab" data-bs-toggle="pill" href="#ba-titip"
                                            role="tab" aria-controls="ba-titip" aria-selected="false">
                                            <span class="d-block d-sm-none">(B.A Titip)</span>
                                            <span class="d-none d-sm-block">B.A Titip</span>
                                        </a>
                                    </li>

                                    <li class="nav-item nav-item-penindakan">
                                        <a class="nav-link" id="bpc-tab" data-bs-toggle="pill" href="#bpc"
                                            role="tab" aria-controls="bpc" aria-selected="false">
                                            <span class="d-block d-sm-none">(BPC)</span>
                                            <span class="d-none d-sm-block">Blokir Pita Cukai</span>
                                        </a>
                                    </li>

                                    <li class="nav-item nav-item-penindakan">
                                        <a class="nav-link" id="tolak1-tab" data-bs-toggle="pill" href="#tolak1"
                                            role="tab" aria-controls="tolak1" aria-selected="false">
                                            <span class="d-block d-sm-none">(B.A Tolak 1)</span>
                                            <span class="d-none d-sm-block">B.A Tolak Pertama</span>
                                        </a>
                                    </li>

                                    <li class="nav-item nav-item-penindakan">
                                        <a class="nav-link" id="tolak2-tab" data-bs-toggle="pill" href="#tolak2"
                                            role="tab" aria-controls="tolak2" aria-selected="false">
                                            <span class="d-block d-sm-none">(B.A Tolak 2)</span>
                                            <span class="d-none d-sm-block">B.A Tolak Kedua</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>

                            <!-- Tab Content -->
                            <div class="tab-content p-0 text-muted mt-md-0" id="v-pills-tabContent">

                                <div class="container-fluid p-4 tab-pane fade show active text-black" id="penindakan"
                                    role="tabpanel">
                                    <!-- Header -->
                                    <div class="row mb-4 align-items-center">
                                        <div class="col-2 text-center">
                                            <img src="/images/logocop.png" alt="Logo" class="img-fluid"
                                                style="max-height:170px;">
                                        </div>
                                        <div class="col-10 text-center">
                                            <h5 class="mb-0">KEMENTERIAN KEUANGAN REPUBLIK INDONESIA</h5>
                                            <p class="small mb-0">DIREKTORAT JENDERAL BEA DAN CUKAI</p>
                                            <p class="small mb-0">KANTOR PELAYANAN UTAMA BEA DAN CUKAI TIPE B BATAM
                                            </p>
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

                                    <hr class="border-dark border-2">

                                    <!-- Title -->
                                    <div class="text-center mb-4">
                                        <h5 class="fw-bold">Surat Bukti Penindakan</h5>
                                        <div class="input-group flex-wrap">
                                            <span class="input-group-text">NO : SBP-</span>
                                            <input type="text" class="form-control" name="no_sbp" id="no_sbp"
                                                value="{{ old('no_sbp', $no_ref->no_sbp) }}" readonly>
                                            <input type="date" class="form-control" name="tgl_sbp">
                                        </div>
                                    </div>

                                    <!-- Hidden Fields -->
                                    <input type="hidden" id="id_penindakan" name="id_penindakan" value="">
                                    <input type="hidden" name="id_pra_penindakan_ref" value="">

                                    <!-- Section 1: Data Referensi -->
                                    <div class="form-section">
                                        <div class="section-header">1. Data Referensi</div>
                                        <div class="p-3">
                                            <div class="row field-row">
                                                <div class="col-md-12">
                                                    <label class="fw-bold">Opsi Penindakan:</label>
                                                    <input type="text" class="form-control bg-primary text-white"
                                                        name="opsi_penindakan" value="{{ $kategori }}" readonly>
                                                </div>
                                            </div>
                                            <div class="row field-row">
                                                <div class="col-md-6">
                                                    <label class="fw-bold">No. Surat Perintah:</label>
                                                    <input type="text" value="{{ $laporan->no_print }}"
                                                        class="form-control bg-primary text-white" readonly>
                                                </div>
                                                <div class="col-md-6">
                                                    <label class="fw-bold">Tgl. Surat Perintah:</label>
                                                    <input type="date" value="{{ $laporan->tgl_print }}"
                                                        class="form-control bg-primary text-white" readonly>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Section 2: Data Petugas -->
                                    <div class="form-section">
                                        <div class="section-header">2. Data Petugas Penindakan</div>
                                        <div class="p-3">
                                            <div class="row field-row">
                                                <div class="col-md-6">
                                                    <label class="fw-bold">Pejabat 1 Penindakan:</label>
                                                    <select class="form-select select2" name="id_petugas_1_sbp"
                                                        id="id_petugas_1_sbp" readonly>
                                                        @foreach ($users as $user)
                                                            <option value="{{ $user->id_admin }}"
                                                                {{ old('id_petugas_1_sbp', $loggedInUserId) == $user->id_admin ? 'selected' : '' }}
                                                                {{ $loggedInUserId != $user->id_admin ? 'disabled' : '' }}>
                                                                {{ $user->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-md-6">
                                                    <label class="fw-bold">Pejabat 2 Penindakan:</label>
                                                    <select class="form-select select2" name="id_petugas_2_sbp">
                                                        <option value="" disabled selected>- Pilih -</option>
                                                        @foreach ($users as $user)
                                                            <option value="{{ $user->id_admin }}">{{ $user->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="row field-row">
                                                <div class="col-md-6">
                                                    <label class="fw-bold">Pejabat 3 Penindakan:</label>
                                                    <select class="form-select select2" name="id_petugas_3_sbp">
                                                        <option value="" disabled selected>- Pilih -</option>
                                                        @foreach ($users as $user)
                                                            <option value="{{ $user->id_admin }}">{{ $user->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-md-6">
                                                    <label class="fw-bold">Pejabat 4 Penindakan:</label>
                                                    <select class="form-select select2" name="id_petugas_4_sbp">
                                                        <option value="" disabled selected>- Pilih -</option>
                                                        @foreach ($users as $user)
                                                            <option value="{{ $user->id_admin }}">{{ $user->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Section 3: Data Lokasi dan Waktu -->
                                    <div class="form-section">
                                        <div class="section-header">3. Lokasi Penindakan</div>
                                        <div class="p-3">
                                            <div class="field-row">
                                                <label class="fw-bold">Lokasi Penindakan:</label>
                                                <select id="lokasi_penindakan" name="lokasi_penindakan"
                                                class="form-control form-input mt-2"
                                                style="width: 100%">
                                                <option></option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Section 4: Waktu Penindakan -->
                                    <div class="form-section">
                                        <div class="section-header">4. Waktu Penindakan</div>
                                        <div class="p-3">
                                            <div class="row field-row">
                                                <div class="col-md-6">
                                                    <label class="fw-bold">Tanggal & Waktu Mulai:</label>
                                                    <input type="text" class="form-control" name="tgl_mulai"
                                                        id="datetime-datepicker" placeholder="dd/mm/yyyy HH:mm">
                                                </div>
                                                <div class="col-md-6">
                                                    <label class="fw-bold">Tanggal & Waktu Selesai:</label>
                                                    <input type="text" class="form-control" id="datetime-datepicker"
                                                        name="tgl_selesai" placeholder="dd/mm/yyyy HH:mm">
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Section 5: Alasan Penindakan -->
                                    <div class="form-section">
                                        <div class="section-header">5. Alasan Penindakan</div>
                                        <div class="p-3">
                                            <div class="field-row">
                                                <label class="fw-bold">Alasan Penindakan:</label>
                                                <select class="form-control  select2" name="alasan_penindakan"
                                                    id="alasan_penindakan">
                                                    <option value="" disabled selected>Pilih Alasan Penindakan
                                                    </option>
                                                    @foreach ($jenisPelanggaran->unique('alasan_penindakan') as $jenis)
                                                        <option
                                                            value="{{ $jenis->alasan_penindakan }} ({{ $jenis->jenis_pelanggaran }})"
                                                            data-jenis="{{ $jenis->jenis_pelanggaran }}">
                                                            {{ $jenis->alasan_penindakan }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="field-row mt-3">
                                                <label class="fw-bold">Jenis Pelanggaran:</label>
                                                <textarea class="form-control bg-light mt-2" rows="3" id="jenis_pelanggaran" readonly></textarea>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Section 6: Uraian Penindakan -->
                                    <div class="form-section">
                                        <div class="section-header">6. Uraian Penindakan</div>
                                        <div class="p-3">
                                            <textarea class="form-control" name="uraian_penindakan" rows="5"
                                                placeholder="Uraian lengkap penindakan yang dilakukan"></textarea>
                                        </div>
                                    </div>


                                    <!-- Section 7: Hal Yang Terjadi -->
                                    <div class="form-section">
                                        <div class="section-header">7. Kesimpulan Penindakan</div>
                                        <div class="p-3">
                                             <select id="kesimpulan" name="kesimpulan"
                                                class="form-control form-input mt-2"
                                                style="width: 100%">
                                                <option></option>
                                                </select>
                                        </div>
                                    </div>

                                    <!-- Section 8: Data Saksi -->
                                    <div class="form-section">
                                        <div class="section-header">8. Data Saksi</div>
                                        <div class="p-3">
                                            <div class="row field-row">
                                                <div class="col-md-6">
                                                    <label class="fw-bold">Nama Saksi:</label>
                                                    <input type="text" class="form-control" id="nama_saksi"
                                                        name="nama_saksi" placeholder="Nama lengkap saksi">
                                                </div>
                                                <div class="col-md-6">
                                                    <label class="fw-bold">Pekerjaan:</label>
                                                    <input type="text" class="form-control" name="pekerjaan_saksi"
                                                        placeholder="Pekerjaan saksi">
                                                </div>
                                            </div>
                                            <div class="row field-row">
                                                <div class="col-md-6">
                                                    <label class="fw-bold">No. Identitas:</label>
                                                    <input type="text" class="form-control" id="no_identitas_saksi"
                                                        name="no_identitas_saksi" placeholder="Nomor KTP/SIM/Paspor">
                                                </div>
                                                <div class="col-md-6">
                                                    <label class="fw-bold">Jenis Identitas:</label>
                                                    <input type="text" class="form-control" name="jenis_iden_saksi"
                                                        placeholder="KTP/SIM/Paspor">
                                                </div>
                                            </div>
                                            <div class="row field-row">
                                                <div class="col-md-12">
                                                    <label class="fw-bold">Alamat:</label>
                                                    <input type="text" class="form-control" name="alamat_saksi"
                                                        placeholder="Alamat lengkap saksi">
                                                </div>
                                            </div>
                                            <div class="row field-row">
                                                <div class="col-md-4">
                                                    <label class="fw-bold">Jenis Kelamin:</label>
                                                    <select class="form-control select2" name="jk_saksi">
                                                        <option value="">Pilih</option>
                                                        <option value="Laki-laki">Laki-laki</option>
                                                        <option value="Perempuan">Perempuan</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-4">
                                                    <label class="fw-bold">Tempat, Tanggal Lahir:</label>
                                                    <input type="text" class="form-control" name="ttl_saksi"
                                                        placeholder="Jakarta, 01 Januari 1990">
                                                </div>
                                                <div class="col-md-4">
                                                    <label class="fw-bold">Umur:</label>
                                                    <input type="number" class="form-control" name="umur_saksi"
                                                        placeholder="Tahun">
                                                </div>
                                            </div>
                                            <div class="row field-row">
                                                <div class="col-md-6">
                                                    <label class="fw-bold">Kewarganegaraan:</label>
                                                    <select class="form-control form-input select2"
                                                        name="kewarganegaraan_saksi">
                                                        <option value="" disabled selected>- Pilih Kewarganegaraan -
                                                        </option>
                                                        @foreach ($nama_negara as $benua => $negara)
                                                            <optgroup label="{{ $benua }}">
                                                                @foreach ($negara as $item)
                                                                    <option value="{{ $item->UrEdi }}">
                                                                        {{ $item->UrEdi }}</option>
                                                                @endforeach
                                                            </optgroup>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-md-6">
                                                    <label class="fw-bold">No. HP:</label>
                                                    <input type="text" class="form-control" name="kontak_saksi"
                                                        placeholder="08xxxxxxxxxx">
                                                </div>
                                            </div>
                                            <div class="row field-row">
                                                <div class="col-md-6">
                                                    <label class="fw-bold">NPWP:</label>
                                                    <input type="text" class="form-control" name="npwp_saksi"
                                                        placeholder="XX.XXX.XXX.X-XXX.XXX">
                                                </div>
                                                <div class="col-md-6">
                                                    <label class="fw-bold">Nomor Rekening:</label>
                                                    <input type="text" class="form-control" name="norek_saksi"
                                                        placeholder="Nomor rekening bank">
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Section 9: Objek Penindakan -->
                                    <div class="container py-4">
                                        <div class="card shadow-sm">
                                            <div class="card-header bg-primary text-white">
                                                <h5 class="mb-0 fw-bold">9. Objek Penindakan</h5>
                                            </div>
                                            <div class="card-body">
                                                <div class="accordion accordion-flush" id="objekPenindakanAccordion">

                                                    <!-- A. Sarana Pengangkut -->
                                                    <div class="accordion-item">
                                                        <h2 class="accordion-header">
                                                            <button class="accordion-button collapsed fw-semibold bg-light"
                                                                type="button" data-bs-toggle="collapse"
                                                                data-bs-target="#accordionSarana" aria-expanded="false"
                                                                aria-controls="accordionSarana">
                                                                A. Sarana Pengangkut
                                                            </button>
                                                        </h2>
                                                        <div id="accordionSarana" class="accordion-collapse collapse"
                                                            data-bs-parent="#objekPenindakanAccordion">
                                                            <div class="accordion-body bg-light">
                                                                <!-- Toggle Data -->
                                                                <div class="row mb-4">
                                                                    <label for="data_sarkut"
                                                                        class="col-sm-3 col-form-label fw-bold">Isi
                                                                        Data:</label>
                                                                    <div class="col-sm-4">
                                                                        <select id="data_sarkut" name="data_sarkut"
                                                                            class="form-select"
                                                                            onchange="toggleForm(this.value, 'sarana-fields')">
                                                                            <option value="TIDAK">TIDAK</option>
                                                                            <option value="YA">YA</option>
                                                                        </select>
                                                                    </div>
                                                                </div>

                                                                <!-- Form Fields -->
                                                                <div id="sarana-fields">
                                                                    <div class="row mb-3">
                                                                        <div class="col-md-6">
                                                                            <label
                                                                                class="form-label fw-semibold">Nama/Jenis
                                                                                Sarana</label>
                                                                            <input type="text"
                                                                                class="form-control form-input"
                                                                                name="nama_jenis_sarkut"
                                                                                placeholder="Masukkan nama/jenis sarana"
                                                                                disabled>
                                                                        </div>
                                                                        <div class="col-md-6">
                                                                            <label class="form-label fw-semibold">Jenis
                                                                                Sarana</label>
                                                                            <input type="text"
                                                                                class="form-control form-input"
                                                                                name="jenis_sarkut"
                                                                                placeholder="Masukkan jenis sarana"
                                                                                disabled>
                                                                        </div>
                                                                    </div>

                                                                    <div class="row mb-3">
                                                                        <div class="col-md-6">
                                                                            <label class="form-label fw-semibold">No.
                                                                                Voy/Penerbangan/Trayek</label>
                                                                            <input type="text"
                                                                                class="form-control form-input"
                                                                                name="no_flight"
                                                                                placeholder="Masukkan nomor voyage/penerbangan/trayek"
                                                                                disabled>
                                                                        </div>
                                                                        <div class="col-md-6">
                                                                            <label
                                                                                class="form-label fw-semibold">Ukuran/Kapasitas</label>
                                                                            <input type="text"
                                                                                class="form-control form-input"
                                                                                name="kapasitas_muatan"
                                                                                placeholder="Masukkan ukuran/kapasitas muatan"
                                                                                disabled>
                                                                        </div>
                                                                    </div>

                                                                    <div class="row mb-3">
                                                                        <div class="col-md-6">
                                                                            <label
                                                                                class="form-label fw-semibold">Nahkoda/Pilot/Pengemudi</label>
                                                                            <input type="text"
                                                                                class="form-control form-input"
                                                                                name="pengemudi" id="pengemudi"
                                                                                placeholder="Masukkan nama nahkoda/pilot/pengemudi"
                                                                                disabled>
                                                                        </div>
                                                                        <div class="col-md-6">
                                                                            <label class="form-label fw-semibold">No.
                                                                                Identitas</label>
                                                                            <input type="text"
                                                                                class="form-control form-input"
                                                                                name="no_identitas_pengemudi"
                                                                                id="no_identitas_pengemudi"
                                                                                placeholder="Masukkan nomor identitas"
                                                                                disabled>
                                                                        </div>
                                                                    </div>

                                                                    <div class="row mb-3">
                                                                        <div class="col-md-6">
                                                                            <label
                                                                                class="form-label fw-semibold">Bendera</label>
                                                                            <input type="text"
                                                                                class="form-control form-input"
                                                                                name="bendera"
                                                                                placeholder="Masukkan bendera" disabled>
                                                                        </div>
                                                                        <div class="col-md-6">
                                                                            <label class="form-label fw-semibold">No.
                                                                                Registrasi/Polisi</label>
                                                                            <input type="text"
                                                                                class="form-control form-input"
                                                                                name="no_polisi"
                                                                                placeholder="Masukkan nomor registrasi/polisi"
                                                                                disabled>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <!-- B. Data Barang -->
                                                    <div class="accordion-item">
                                                        <h2 class="accordion-header">
                                                            <button class="accordion-button collapsed fw-semibold bg-light"
                                                                type="button" data-bs-toggle="collapse"
                                                                data-bs-target="#accordionBarang" aria-expanded="false"
                                                                aria-controls="accordionBarang">
                                                                B. Data Barang
                                                            </button>
                                                        </h2>
                                                        <div id="accordionBarang" class="accordion-collapse collapse"
                                                            data-bs-parent="#objekPenindakanAccordion">
                                                            <div class="accordion-body bg-light">
                                                                <!-- Toggle Data -->
                                                                <div class="row mb-4">
                                                                    <label for="data_barang"
                                                                        class="col-sm-3 col-form-label fw-bold">Isi
                                                                        Data:</label>
                                                                    <div class="col-sm-4">
                                                                        <select id="data_barang" name="data_barang"
                                                                            class="form-select"
                                                                            onchange="toggleForm(this.value, 'barang-fields')">
                                                                            <option value="TIDAK">TIDAK</option>
                                                                            <option value="YA">YA</option>
                                                                        </select>
                                                                    </div>
                                                                </div>

                                                                <!-- Form Fields -->
                                                                <div id="barang-fields">
                                                                    <div class="mb-3">
                                                                        <label
                                                                            class="form-label fw-semibold">Jumlah/Jenis/Ukuran/Nomor</label>
                                                                        <textarea class="form-control form-input" name="jumlah_jenis_ukuran_no" rows="3"
                                                                            placeholder="Masukkan jumlah, jenis, ukuran, dan nomor barang" disabled></textarea>
                                                                    </div>

                                                                    <div class="row mb-3">
                                                                        <div class="col-md-6">
                                                                            <label
                                                                                class="form-label fw-semibold">Kemasan</label>
                                                                            <select class="form-control form-input select2"
                                                                                name="id_kemasan" disabled>
                                                                                <option value="" disabled selected>-
                                                                                    Pilih -</option>
                                                                                @foreach ($kemasans as $kemasan)
                                                                                    <option
                                                                                        value="{{ $kemasan->id_kemasan }}">
                                                                                        {{ $kemasan->nama_kemasan }}
                                                                                    </option>
                                                                                @endforeach
                                                                            </select>
                                                                        </div>
                                                                        <div class="col-md-6">
                                                                            <label class="form-label fw-semibold">Jumlah
                                                                                Barang</label>
                                                                            <input type="number"
                                                                                class="form-control form-input"
                                                                                name="jumlah_barang"
                                                                                placeholder="Masukkan jumlah barang"
                                                                                disabled>
                                                                        </div>
                                                                    </div>

                                                                    <div class="mb-3">
                                                                        <label class="form-label fw-semibold">Uraian
                                                                            Barang</label>
                                                                        <textarea class="form-control form-input" name="jenis_barang" rows="2"
                                                                            placeholder="Masukkan uraian detail barang" disabled></textarea>
                                                                    </div>

                                                                    <div class="row mb-3">
                                                                        <div class="col-md-6">
                                                                            <label class="form-label fw-semibold">Jenis/No.
                                                                                Dokumen</label>
                                                                            <input type="text"
                                                                                class="form-control form-input"
                                                                                name="jenis_no_tgl_dok"
                                                                                placeholder="Masukkan jenis/nomor dokumen"
                                                                                disabled>
                                                                        </div>
                                                                        <div class="col-md-6">
                                                                            <label class="form-label fw-semibold">Tgl.
                                                                                Dokumen</label>
                                                                            <input type="date"
                                                                                class="form-control form-input"
                                                                                name="tgl_dokumen" disabled>
                                                                        </div>
                                                                    </div>

                                                                    <div class="row mb-3">
                                                                        <div class="col-md-6">
                                                                            <label class="form-label fw-semibold">Masa
                                                                                Berlaku Dokumen</label>
                                                                            <input type="date"
                                                                                class="form-control form-input"
                                                                                name="masa_berlaku_dokumen" disabled>
                                                                        </div>
                                                                    </div>

                                                                    <div class="row mb-3">
                                                                        <div class="col-md-6">
                                                                            <label
                                                                                class="form-label fw-semibold">Pemilik/Importir/Eksportir</label>
                                                                            <input type="text"
                                                                                class="form-control form-input"
                                                                                name="pemilik" id="pemilik"
                                                                                placeholder="Masukkan nama pemilik/importir/eksportir"
                                                                                disabled>
                                                                        </div>
                                                                        <div class="col-md-6">
                                                                            <label class="form-label fw-semibold">No.
                                                                                Identitas</label>
                                                                            <input type="text"
                                                                                class="form-control form-input"
                                                                                name="no_identitas_pemilik"
                                                                                id="no_identitas_pemilik"
                                                                                placeholder="Masukkan nomor identitas"
                                                                                disabled>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <!-- C. Data Bangunan/Tempat -->
                                                    <div class="accordion-item">
                                                        <h2 class="accordion-header">
                                                            <button class="accordion-button collapsed fw-semibold bg-light"
                                                                type="button" data-bs-toggle="collapse"
                                                                data-bs-target="#accordionBangunan" aria-expanded="false"
                                                                aria-controls="accordionBangunan">
                                                                C. Data Bangunan/Tempat
                                                            </button>
                                                        </h2>
                                                        <div id="accordionBangunan" class="accordion-collapse collapse"
                                                            data-bs-parent="#objekPenindakanAccordion">
                                                            <div class="accordion-body bg-light">
                                                                <!-- Toggle Data -->
                                                                <div class="row mb-4">
                                                                    <label for="data_bangunan"
                                                                        class="col-sm-3 col-form-label fw-bold">Isi
                                                                        Data:</label>
                                                                    <div class="col-sm-4">
                                                                        <select id="data_bangunan" name="data_bangunan"
                                                                            class="form-select"
                                                                            onchange="toggleForm(this.value, 'bangunan-fields')">
                                                                            <option value="TIDAK">TIDAK</option>
                                                                            <option value="YA">YA</option>
                                                                        </select>
                                                                    </div>
                                                                </div>

                                                                <!-- Form Fields -->
                                                                <div id="bangunan-fields">
                                                                    <div class="mb-3">
                                                                        <label class="form-label fw-semibold">Alamat
                                                                            Bangunan/Tempat</label>
                                                                        <textarea class="form-control form-input" name="alamat_bangunan" rows="2"
                                                                            placeholder="Masukkan alamat lengkap bangunan/tempat" disabled></textarea>
                                                                    </div>

                                                                    <div class="mb-3">
                                                                        <label class="form-label fw-semibold">No. Reg
                                                                            Bangunan/NPPBKC</label>
                                                                        <input type="text"
                                                                            class="form-control form-input"
                                                                            name="no_bangunan"
                                                                            placeholder="Masukkan nomor registrasi bangunan/NPPBKC"
                                                                            disabled>
                                                                    </div>

                                                                    <div class="row mb-3">
                                                                        <div class="col-md-6">
                                                                            <label class="form-label fw-semibold">Nama
                                                                                Pemilik/Yang Menguasai</label>
                                                                            <input type="text"
                                                                                class="form-control form-input"
                                                                                name="nama_pemilik_bangunan"
                                                                                id="nama_pemilik_bangunan"
                                                                                placeholder="Masukkan nama pemilik/yang menguasai"
                                                                                disabled>
                                                                        </div>
                                                                        <div class="col-md-6">
                                                                            <label class="form-label fw-semibold">No.
                                                                                Identitas</label>
                                                                            <input type="text"
                                                                                class="form-control form-input"
                                                                                name="no_identitas_pemilik_bangunan"
                                                                                id="no_identitas_pemilik_bangunan"
                                                                                placeholder="Masukkan nomor identitas"
                                                                                disabled>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Section 10: Keterangan -->
                                    {{-- <div class="form-section">
                                        <div class="section-header">10. Keterangan</div>
                                        <div class="p-3">
                                            <div style="min-height: 100px; border: 1px solid #ddd; padding: 10px;">
                                                <p class="text-muted small mb-0">Keterangan tambahan dapat ditulis di
                                                    sini...</p>
                                            </div>
                                        </div>
                                    </div> --}}

                                    <!-- Signature Section -->
                                    <div class="row mt-5">
                                        <div class="col-md-6">
                                            <div class="text-center">
                                                <p class="fw-bold mb-1">Pemilik/Kuasa/Saksi*)</p>
                                                <div class="signature-area border-bottom mb-2"></div>
                                                <p class="small">NIP. (...........................)</p>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="text-center">
                                                <p class="fw-bold mb-1">Pejabat yang melakukan penindakan</p>
                                                <div class="signature-area border-bottom mb-2"></div>
                                                <p class="small">NIP. (...........................)</p>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Footer Note -->
                                    <div class="mt-4 p-3 bg-light border">
                                        <p class="small mb-0">
                                            <strong>Catatan:</strong> Yang dimaksud dengan "barang yang dikuasai negara"
                                            adalah barang yang untuk
                                            sementara waktu penguasaannya berada pada negara sampai dapat ditentukan
                                            status barang yang sebenarnya. Perubahan status ini dimaksudkan agar pejabat
                                            bea dan cukai dapat memproses barang tersebut secara administrasi sampai
                                            dapat dibuktikan bahwa telah terjadi kesalahan atau sama sekali tidak terjadi
                                            kesalahan.</strong>.
                                        </p>
                                    </div>
                                </div>



                                <div class="tab-pane fade" id="ba-henti" role="tabpanel"
                                    aria-labelledby="ba-henti-tab">
                                    <div class="accordion accordion-flush" id="accordionFlushExample">
                                        <!-- B.A Dokumentasi -->
                                        <div class="accordion-item border rounded">
                                            <div class="d-flex justify-content-between align-items-center p-3 bg-light">
                                                <span class="fw-bold">B.A henti</span>
                                                <div class="form-check form-switch mb-0">
                                                    <input class="form-check-input status-toggle" type="checkbox"
                                                        role="switch" id="flexSwitchCheck1055"
                                                        data-id="flush-collapse1055" name="ba_henti" value="TIDAK"
                                                        aria-expanded="false" aria-controls="flush-collapse1055">
                                                    <label class="form-check-label" for="flexSwitchCheck1055"
                                                        id="switch-label-1055">TIDAK</label>
                                                </div>
                                            </div>
                                            <hr class="my-0">
                                        </div>
                                    </div>
                                </div>


                                <div class="tab-pane" id="ba-riksa" role="tabpanel" aria-labelledby="ba-riksa-tab">
                                    <div class="accordion accordion-flush" id="accordionFlushExample">

                                        <!-- B.A Riksa -->
                                        <div class="accordion-item border rounded">
                                            <div class="d-flex justify-content-between align-items-center p-3 bg-light">
                                                <span class="fw-bold">B.A Riksa</span>
                                                <div class="form-check form-switch mb-0">
                                                    <input class="form-check-input status-toggle" type="checkbox"
                                                        role="switch" id="flexSwitchCheck1" data-id="flush-collapse1"
                                                        name="ba_riksa" value="TIDAK" aria-expanded="false"
                                                        aria-controls="flush-collapse1">
                                                    <label class="form-check-label" for="flexSwitchCheck1"
                                                        id="switch-label-1">TIDAK</label>
                                                </div>
                                            </div>
                                            <hr class="my-0">
                                            <div id="flush-collapse1" class="accordion-collapse collapse text-black"
                                                data-bs-parent="#accordionFlushExample">
                                                <div class="accordion-body">
                                                    <div class="container mt-4">
                                                        <!-- Header dengan Logo -->
                                                        <div class="row mb-4 align-items-center">
                                                            <div class="col-2 text-center">
                                                                <img src="/images/logocop.png" alt="Logo"
                                                                    class="img-fluid" style="max-height:170px;">
                                                            </div>
                                                            <div class="col-10 text-center">
                                                                <h5 class="mb-0">KEMENTERIAN KEUANGAN REPUBLIK INDONESIA
                                                                </h5>
                                                                <p class="small mb-0">DIREKTORAT JENDERAL BEA DAN CUKAI</p>
                                                                <p class="small mb-0">KANTOR PELAYANAN UTAMA BEA DAN CUKAI
                                                                    TIPE B BATAM
                                                                </p>
                                                                <p class="small mb-0">
                                                                    JALAN KUDA LAUT, BATU AMPAR, BATAM, KEPULAUAN RIAU
                                                                    29432;
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

                                                        <hr class="border border-dark border-2">


                                                        <!-- Nomor dan Tanggal -->
                                                        <div class="text-center mb-4">
                                                            <h5 class="fw-bold">BERITA ACARA PEMERIKSAAN</h5>
                                                            <div class="input-group flex-wrap">
                                                                <span class="input-group-text">NOMOR : BA-</span>
                                                                <input type="text" class="form-control"
                                                                    name="no_ba_riksa" id="no_ba_riksa"
                                                                    value="{{ old('no_ba_riksa', $no_ref->no_ba_riksa) }}"
                                                                    readonly>
                                                                <span class="input-group-text">/Riksa/KPU.206/</span>
                                                                <input type="date" class="form-control"
                                                                    name="tgl_ba_riksa">
                                                            </div>
                                                        </div>

                                                        <p class="mb-2">
                                                            <span class="text-danger">*</span> Isian dengan keterangan
                                                            <span class="text-danger">"terisi otomatis"</span> di atas
                                                            berasal dari data sebelumnya yang telah diinput melalui Data
                                                            Penindakan.
                                                        </p>



                                                        <!-- Pembukaan -->
                                                        <div class="mb-4">
                                                            <p>
                                                                Pada hari ini
                                                                <input type="text" readonly value="terisi otomatis"
                                                                    class="form-control d-inline border-0 border-bottom border-dark"
                                                                    style="width: 100px;">
                                                                tanggal
                                                                <input type="text" readonly value="terisi otomatis"
                                                                    class="form-control d-inline border-0 border-bottom border-dark"
                                                                    style="width: 80px;">
                                                                bulan
                                                                <input type="text" readonly value="terisi otomatis"
                                                                    class="form-control d-inline border-0 border-bottom border-dark"
                                                                    style="width: 80px;">
                                                                tahun
                                                                <input type="text" readonly value="terisi otomatis"
                                                                    class="form-control d-inline border-0 border-bottom border-dark"
                                                                    style="width: 80px;">
                                                                Berdasarkan Surat Perintah :
                                                                <input type="text" readonly value="terisi otomatis"
                                                                    class="form-control d-inline border-0 border-bottom border-dark"
                                                                    style="width: 100px;">
                                                                Nomor
                                                                <input type="text" readonly value="terisi otomatis"
                                                                    class="form-control d-inline border-0 border-bottom border-dark"
                                                                    style="width: 150px;">
                                                                tanggal
                                                                <input type="text" readonly value="terisi otomatis"
                                                                    class="form-control d-inline border-0 border-bottom border-dark"
                                                                    style="width: 100px;">
                                                            </p>




                                                            <p>Kami yang bertanda tangan di bawah ini telah melakukan
                                                                pemeriksaan terhadap:</p>
                                                        </div>

                                                        <!-- A. Sarana Pengangkut -->
                                                        <div class="mb-4">
                                                            <h6 class="fw-bold">A. Sarana Pengangkut</h6>

                                                            <div class="row mb-2">
                                                                <div class="col-md-4">
                                                                    <label class="form-label">Nama dan Jenis Sarkut</label>
                                                                </div>
                                                                <div class="col-md-1 text-center">:</div>
                                                                <div class="col-md-7">
                                                                    <input type="text" readonly value="terisi otomatis"
                                                                        class="form-control border-0 border-bottom border-dark">
                                                                </div>
                                                            </div>

                                                            <div class="row mb-2">
                                                                <div class="col-md-4">
                                                                    <label class="form-label">No Reg./No. Polisi</label>
                                                                </div>
                                                                <div class="col-md-1 text-center">:</div>
                                                                <div class="col-md-7">
                                                                    <input type="text" readonly value="terisi otomatis"
                                                                        class="form-control border-0 border-bottom border-dark">
                                                                </div>
                                                            </div>

                                                            <div class="row mb-2">
                                                                <div class="col-md-4">
                                                                    <label class="form-label">Bendera</label>
                                                                </div>
                                                                <div class="col-md-1 text-center">:</div>
                                                                <div class="col-md-7">
                                                                    <input type="text" readonly value="terisi otomatis"
                                                                        class="form-control border-0 border-bottom border-dark">
                                                                </div>
                                                            </div>

                                                            <div class="row mb-2">
                                                                <div class="col-md-4">
                                                                    <label class="form-label">Nakhoda/Pilot/Pengemudi<span
                                                                            class="text-danger">*</span></label>
                                                                </div>
                                                                <div class="col-md-1 text-center">:</div>
                                                                <div class="col-md-7">
                                                                    <input type="text" readonly value="terisi otomatis"
                                                                        class="form-control border-0 border-bottom border-dark">
                                                                </div>
                                                            </div>

                                                            <div class="row mb-2">
                                                                <div class="col-md-4">
                                                                    <label class="form-label">No. Identitas</label>
                                                                </div>
                                                                <div class="col-md-1 text-center">:</div>
                                                                <div class="col-md-7">
                                                                    <input type="text" readonly value="terisi otomatis"
                                                                        class="form-control border-0 border-bottom border-dark">
                                                                </div>
                                                            </div>
                                                        </div>


                                                        <!-- B. Barang -->
                                                        <div class="mb-4">
                                                            <h6 class="fw-bold">B. Barang</h6>

                                                            <div class="row mb-2">
                                                                <div class="col-md-4">
                                                                    <label class="form-label">Jumlah/Jenis/No Peti
                                                                        Kemas/Kemasan</label>
                                                                </div>
                                                                <div class="col-md-1 text-center">:</div>
                                                                <div class="col-md-7">
                                                                    <input type="text" readonly value="terisi otomatis"
                                                                        class="form-control border-0 border-bottom border-dark">
                                                                </div>
                                                            </div>

                                                            <div class="row mb-2">
                                                                <div class="col-md-4">
                                                                    <label class="form-label">Surat Muatan</label>
                                                                </div>
                                                                <div class="col-md-1 text-center">:</div>
                                                                <div class="col-md-7">
                                                                    <input type="text" readonly value="terisi otomatis"
                                                                        class="form-control border-0 border-bottom border-dark">
                                                                </div>
                                                            </div>

                                                            <div class="row mb-2">
                                                                <div class="col-md-4">
                                                                    <label class="form-label">Jenis/No dan Tgl
                                                                        Dokumen</label>
                                                                </div>
                                                                <div class="col-md-1 text-center">:</div>
                                                                <div class="col-md-7">
                                                                    <input type="text" readonly value="terisi otomatis"
                                                                        class="form-control border-0 border-bottom border-dark">
                                                                </div>
                                                            </div>

                                                            <div class="row mb-2">
                                                                <div class="col-md-4">
                                                                    <label class="form-label">
                                                                        Pemilik/Importir/Eksportir/Kuasa<span
                                                                            class="text-danger">*</span>
                                                                    </label>
                                                                </div>
                                                                <div class="col-md-1 text-center">:</div>
                                                                <div class="col-md-7">
                                                                    <input type="text" readonly value="terisi otomatis"
                                                                        class="form-control border-0 border-bottom border-dark">
                                                                </div>
                                                            </div>

                                                            <div class="row mb-2">
                                                                <div class="col-md-4">
                                                                    <label class="form-label">No. Identitas</label>
                                                                </div>
                                                                <div class="col-md-1 text-center">:</div>
                                                                <div class="col-md-7">
                                                                    <input type="text" readonly value="terisi otomatis"
                                                                        class="form-control border-0 border-bottom border-dark">
                                                                </div>
                                                            </div>
                                                        </div>


                                                        <!-- C. Orang dan tempat -->
                                                        <div class="mb-4">
                                                            <h6 class="fw-bold">C. Orang dan Tempat</h6>

                                                            <div class="row mb-2">
                                                                <div class="col-md-4">
                                                                    <label class="form-label">Alamat
                                                                        Bangunan/Tempat</label>
                                                                </div>
                                                                <div class="col-md-1 text-center">:</div>
                                                                <div class="col-md-7">
                                                                    <input type="text" readonly value="terisi otomatis"
                                                                        class="form-control border-0 border-bottom border-dark">
                                                                </div>
                                                            </div>

                                                            <div class="row mb-2">
                                                                <div class="col-md-4">
                                                                    <label class="form-label">No Reg Bangunan/NPPBKC/NPWP
                                                                        <span class="text-danger">*</span>
                                                                    </label>
                                                                </div>
                                                                <div class="col-md-1 text-center">:</div>
                                                                <div class="col-md-7">
                                                                    <input type="text" readonly value="terisi otomatis"
                                                                        class="form-control border-0 border-bottom border-dark">
                                                                </div>
                                                            </div>

                                                            <div class="row mb-2">
                                                                <div class="col-md-4">
                                                                    <label class="form-label">Nama Pemilik/Yang Menguasai
                                                                        <span class="text-danger">*</span>
                                                                    </label>
                                                                </div>
                                                                <div class="col-md-1 text-center">:</div>
                                                                <div class="col-md-7">
                                                                    <input type="text" readonly value="terisi otomatis"
                                                                        class="form-control border-0 border-bottom border-dark">
                                                                </div>
                                                            </div>

                                                            <div class="row mb-2">
                                                                <div class="col-md-4">
                                                                    <label class="form-label">No. Identitas</label>
                                                                </div>
                                                                <div class="col-md-1 text-center">:</div>
                                                                <div class="col-md-7">
                                                                    <input type="text" readonly value="terisi otomatis"
                                                                        class="form-control border-0 border-bottom border-dark">
                                                                </div>
                                                            </div>
                                                        </div>


                                                        <!-- Lokasi Pemeriksaan -->
                                                        <div class="mb-4">
                                                            <div class="d-flex align-items-center mb-2">
                                                                <span class="me-1">Lokasi Pemeriksaan</span>
                                                                <span class="me-2">:</span>
                                                                <input type="text" name="lokasi_pemeriksaan"
                                                                    placeholder="Diisi Tempat Lokasi Pemeriksaan"
                                                                    class="form-control border-0 border-bottom border-dark flex-grow-1">
                                                            </div>

                                                            <p>Hasil Pemeriksaan sesuai Laporan hasil
                                                                pemeriksaan/penanganan/penembakan/sebagaimana terlampir.</p>

                                                            <p>
                                                                Dengan diketahui oleh
                                                                pengangkut/pemilik/penguasa/instansi/ketua lingkungan/
                                                                <span class="text-danger">*</span>
                                                            </p>

                                                            <div class="d-flex align-items-center mb-2">
                                                                <span class="me-1">Nama</span>
                                                                <span class="me-2">:</span>
                                                                <input type="text" readonly value="terisi otomatis"
                                                                    class="form-control border-0 border-bottom border-dark flex-grow-1">
                                                            </div>

                                                            <div class="d-flex align-items-center mb-2">
                                                                <span class="me-1">Alamat</span>
                                                                <span class="me-2">:</span>
                                                                <input type="text" readonly value="terisi otomatis"
                                                                    class="form-control border-0 border-bottom border-dark flex-grow-1">
                                                            </div>

                                                            <div class="d-flex align-items-center mb-2">
                                                                <span class="me-1">Pekerjaan</span>
                                                                <span class="me-2">:</span>
                                                                <input type="text" readonly value="terisi otomatis"
                                                                    class="form-control border-0 border-bottom border-dark flex-grow-1">
                                                            </div>

                                                            <div class="d-flex align-items-center mb-2">
                                                                <span class="me-1">Identitas (KTP/SIM/Passport)</span>
                                                                <span class="me-2">:</span>
                                                                <input type="text" readonly value="terisi otomatis"
                                                                    class="form-control border-0 border-bottom border-dark flex-grow-1">
                                                            </div>
                                                        </div>


                                                        <p class="fw-bold">Demikian Berita Acara ini dibuat dengan
                                                            sebenarnya.</p>

                                                        <!-- Tanda Tangan -->
                                                        <div class="row mt-5">
                                                            <div class="col-md-6">
                                                                <div class="text-center">
                                                                    <p>Pemilik/Kuasanya/Saksi*,</p>
                                                                    <div style="height: 80px;"></div>
                                                                    <p>(<input type="text"
                                                                            class="form-control d-inline border-0 border-bottom border-dark text-center"
                                                                            style="width: 150px;" value="terisi otomatis"
                                                                            readonly>)</p>
                                                                    <p>NIP. <input type="text"
                                                                            class="form-control d-inline border-0 border-bottom border-dark"
                                                                            style="width: 120px;" value="terisi otomatis"
                                                                            readonly></p>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="text-center">
                                                                    <p>Pejabat yang melakukan pemeriksaan,</p>
                                                                    <div style="height: 80px;"></div>
                                                                    <p>(<input type="text"
                                                                            class="form-control d-inline border-0 border-bottom border-dark text-center"
                                                                            style="width: 150px;" value="terisi otomatis"
                                                                            readonly>)</p>
                                                                    <p>NIP. <input type="text"
                                                                            class="form-control d-inline border-0 border-bottom border-dark"
                                                                            style="width: 120px;" value="terisi otomatis"
                                                                            readonly></p>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <!-- Keterangan -->
                                                        <div class="mt-4">
                                                            <p><small>*Coret yang tidak perlu</small></p>
                                                            <div class="text-center">
                                                            </div>
                                                        </div>

                                                        <hr class="my-5">

                                                        <!-- LAMPIRAN BERITA ACARA PEMERIKSAAN -->
                                                        <div class="mt-5">
                                                            <div class="text-center mb-4">
                                                                <p>Lampiran Berita Acara Pemeriksaan</p>
                                                                <p>Nomor : BA - <input type="text"
                                                                        class="form-control d-inline border-0 border-bottom border-dark"
                                                                        style="width: 100px;" value="terisi otomatis"
                                                                        readonly></p>
                                                                <p>Tanggal : <input type="text"
                                                                        class="form-control d-inline border-0 border-bottom border-dark"
                                                                        style="width: 100px;" value="terisi otomatis"
                                                                        readonly></p>
                                                            </div>

                                                            <div class="text-center mb-4">
                                                                <h5 class="fw-bold text-decoration-underline">LAPORAN HASIL
                                                                    PEMERIKSAAN</h5>
                                                            </div>

                                                            <p>Hasil pemeriksaan kedapatan :</p>
                                                            <div class="mb-4">
                                                                <textarea class="form-control border-0" name="rincian_hasil_pemeriksaan" rows="5"
                                                                    style="border-bottom: 1px solid black !important; resize: none;" placeholder="Diisi Hasil Rincian Pemeriksaan"></textarea>
                                                            </div>

                                                            <div class="card-body table-responsive mb-4">
                                                                <h3>Barang Pemberitahuan</h3>
                                                                <table id="pemberitahuan_table"
                                                                    class="table table-hover align-middle border-separate"
                                                                    style="border-spacing: 0 8px;">
                                                                    <thead>
                                                                        <tr class="bg-light">
                                                                            <th>Uraian Barang</th>
                                                                            <th>Jml</th>
                                                                            <th>Kondisi</th>
                                                                            <th><button type="button"
                                                                                    class="bg-primary text-white btn btn-outline-light px-3 py-1 rounded shadow-sm transition"
                                                                                    style="transition: all 0.2s ease-in-out;"
                                                                                    onmouseover="this.classList.add('shadow'); this.style.transform='scale(1.05)'"
                                                                                    onmouseout="this.classList.remove('shadow'); this.style.transform='scale(1)'"
                                                                                    onclick="addRow('pemberitahuan')">+</button>
                                                                            </th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody></tbody>
                                                                </table>

                                                                <h3>Barang Kedapatan</h3>
                                                                <table id="kedapatan_table"
                                                                    class="table table-hover align-middle border-separate"
                                                                    style="border-spacing: 0 8px;">
                                                                    <thead>
                                                                        <tr class="bg-light">
                                                                            <th>Uraian Barang</th>
                                                                            <th>Jml</th>
                                                                            <th>Kondisi</th>
                                                                            <th><button type="button"
                                                                                    class="bg-primary text-white btn btn-outline-light px-3 py-1 rounded shadow-sm transition"
                                                                                    style="transition: all 0.2s ease-in-out;"
                                                                                    onmouseover="this.classList.add('shadow'); this.style.transform='scale(1.05)'"
                                                                                    onmouseout="this.classList.remove('shadow'); this.style.transform='scale(1)'"
                                                                                    onclick="addRow('kedapatan')">+</button>
                                                                            </th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody></tbody>
                                                                </table>
                                                            </div>

                                                            <input type="hidden" name="hasil_pemeriksaan_barang"
                                                                id="hasil_pemeriksaan_barang">

                                                            <div class="mb-4">
                                                                <textarea class="form-control border-0" name="keterangan_hasil_pemeriksaan" rows="2"
                                                                    style="border-bottom: 1px solid black !important; resize: none;"
                                                                    placeholder="Diisi Keterangan Dari Barang Hasil Pemberitahuan Dan Barang Kedapatan"></textarea>
                                                            </div>

                                                            <div class="mb-4">
                                                                <textarea class="form-control border-0" name="kesimpulan_hasil_pemeriksaan" rows="2"
                                                                    style="border-bottom: 1px solid black !important; resize: none;"
                                                                    placeholder="Diisi Kesimpulan Dari Barang Hasil Pemberitahuan Dan Barang Kedapatan"></textarea>
                                                            </div>

                                                            <!-- Bagian Dokumentasi Pemeriksaan -->
                                                            <div class="card-body table-responsive mb-4">
                                                                <h3>Dokumentasi Pemeriksaan</h3>

                                                                <div id="image-preview-container" class="row g-3 mb-3">
                                                                </div>

                                                                <div class="row g-2 mb-3">
                                                                    <!-- Input Gambar -->
                                                                    <div class="col-md-4">
                                                                        <input type="file" class="form-control"
                                                                            id="image-upload" accept="image/*">
                                                                    </div>

                                                                    <!-- Input Caption -->
                                                                    <div class="col-md-6">
                                                                        <input type="text" class="form-control"
                                                                            id="image-caption" placeholder="Caption">
                                                                    </div>

                                                                    <!-- Tombol Tambah -->
                                                                    <div class="col-md-2 d-grid">
                                                                        <button type="button"
                                                                            class="btn btn-primary shadow-sm"
                                                                            onclick="addImage()">Tambah</button>
                                                                    </div>
                                                                </div>

                                                                <!-- Tempat menyimpan field tersembunyi caption dan file -->
                                                                <div id="hidden-fields" class="d-none"></div>
                                                            </div>




                                                            <!-- Tanda Tangan Laporan -->
                                                            <div class="row mt-5">
                                                                <div class="col-md-6">
                                                                    <div class="text-center">
                                                                        <p>Pemilik/Kuasanya/Saksi*,</p>
                                                                        <div style="height: 80px;"></div>
                                                                        <p>(<input type="text"
                                                                                class="form-control d-inline border-0 border-bottom border-dark text-center"
                                                                                style="width: 150px;"
                                                                                value="terisi otomatis" readonly>)</p>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class="text-center">
                                                                        <p>Pejabat yang melakukan pemeriksaan,</p>
                                                                        <div style="height: 80px;"></div>
                                                                        <p>(<input type="text"
                                                                                class="form-control d-inline border-0 border-bottom border-dark text-center"
                                                                                style="width: 150px;"
                                                                                value="terisi otomatis" readonly>)</p>
                                                                        <p>NIP. <input type="text"
                                                                                class="form-control d-inline border-0 border-bottom border-dark"
                                                                                style="width: 120px;"
                                                                                value="terisi otomatis" readonly> </p>
                                                                    </div>
                                                                </div>
                                                            </div>


                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- B.A Riksa Badan -->
                                        <div class="accordion-item border rounded mt-2">
                                            <div class="d-flex justify-content-between align-items-center p-3 bg-light">
                                                <span class="fw-bold">B.A Riksa Badan</span>
                                                <div class="form-check form-switch mb-0">
                                                    <input class="form-check-input status-toggle" type="checkbox"
                                                        role="switch" id="flexSwitchCheck2" data-id="flush-collapse2"
                                                        name="ba_riksa_badan" value="TIDAK" aria-expanded="false"
                                                        aria-controls="flush-collapse2">
                                                    <label class="form-check-label" for="flexSwitchCheck2"
                                                        id="switch-label-2">TIDAK</label>
                                                </div>
                                            </div>
                                            <hr class="my-0">
                                            <div id="flush-collapse2" class="accordion-collapse collapse text-black"
                                                data-bs-parent="#accordionFlushExample">
                                                <div class="accordion-body">
                                                    <div class="container mt-4">
                                                        <!-- Header dengan Logo -->
                                                        <div class="row mb-4 align-items-center">
                                                            <div class="col-2 text-center">
                                                                <img src="/images/logocop.png" alt="Logo"
                                                                    class="img-fluid" style="max-height:170px;">
                                                            </div>
                                                            <div class="col-10 text-center">
                                                                <h5 class="mb-0">KEMENTERIAN KEUANGAN REPUBLIK INDONESIA
                                                                </h5>
                                                                <p class="small mb-0">DIREKTORAT JENDERAL BEA DAN CUKAI
                                                                </p>
                                                                <p class="small mb-0">KANTOR PELAYANAN UTAMA BEA DAN CUKAI
                                                                    TIPE B BATAM
                                                                </p>
                                                                <p class="small mb-0">
                                                                    JALAN KUDA LAUT, BATU AMPAR, BATAM, KEPULAUAN RIAU
                                                                    29432;
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

                                                        <hr class="border border-dark border-2">


                                                        <!-- Nomor dan Tanggal -->
                                                        <div class="text-center mb-4">
                                                            <h5 class="fw-bold"><u>BERITA ACARA PEMERIKSAAN BADAN</u></h5>
                                                            <div class="input-group flex-wrap">
                                                                <span class="input-group-text">NOMOR : BA-</span>
                                                                <input type="text" class="form-control"
                                                                    name="no_ba_riksa_badan" id="no_ba_riksa_badan"
                                                                    value="{{ old('no_ba_riksa_badan', $no_ref->no_ba_riksa_badan) }}"
                                                                    readonly>
                                                                <span class="input-group-text">/Badan/KPU.206/</span>
                                                                <input type="date" class="form-control"
                                                                    name="tgl_ba_riksa_badan">
                                                            </div>
                                                        </div>

                                                        <p class="mb-2">
                                                            <span class="text-danger">*</span> Isian dengan keterangan
                                                            <span class="text-danger">"terisi otomatis"</span> di atas
                                                            berasal dari data sebelumnya yang telah diinput melalui Data
                                                            Penindakan.
                                                        </p>



                                                        <!-- Pembukaan -->
                                                        <div class="mb-4">
                                                            <p>
                                                                Pada hari ini
                                                                <input type="text" readonly value="terisi otomatis"
                                                                    class="form-control d-inline border-0 border-bottom border-dark"
                                                                    style="width: 100px;">
                                                                tanggal
                                                                <input type="text" readonly value="terisi otomatis"
                                                                    class="form-control d-inline border-0 border-bottom border-dark"
                                                                    style="width: 80px;">
                                                                bulan
                                                                <input type="text" readonly value="terisi otomatis"
                                                                    class="form-control d-inline border-0 border-bottom border-dark"
                                                                    style="width: 80px;">
                                                                tahun
                                                                <input type="text" readonly value="terisi otomatis"
                                                                    class="form-control d-inline border-0 border-bottom border-dark"
                                                                    style="width: 80px;">
                                                                Berdasarkan Surat Perintah :
                                                                <input type="text" readonly value="terisi otomatis"
                                                                    class="form-control d-inline border-0 border-bottom border-dark"
                                                                    style="width: 100px;">
                                                                Nomor
                                                                <input type="text" readonly value="terisi otomatis"
                                                                    class="form-control d-inline border-0 border-bottom border-dark"
                                                                    style="width: 150px;">
                                                                tanggal
                                                                <input type="text" readonly value="terisi otomatis"
                                                                    class="form-control d-inline border-0 border-bottom border-dark"
                                                                    style="width: 100px;">
                                                            </p>

                                                            <p>Kami yang bertanda tangan di bawah ini telah melakukan
                                                                pemeriksaan Badan terhadap:</p>
                                                        </div>

                                                        <!-- A. Sarana Pengangkut -->
                                                        <div class="mb-4">
                                                            <div class="row mb-2">
                                                                <div class="col-md-4">
                                                                    <label class="form-label">Nama</label>
                                                                </div>
                                                                <div class="col-md-1 text-center">:</div>
                                                                <div class="col-md-7">
                                                                    <textarea class="form-control border-0 border-bottom border-dark" name="nama" rows="2"
                                                                        placeholder="Diisi nama orang yang terhadapnya dilakukan pemeriksaan badan"></textarea>
                                                                </div>
                                                            </div>

                                                            <div class="row mb-2">
                                                                <div class="col-md-4">
                                                                    <label class="form-label">Tempat dan Tanggal
                                                                        Lahir</label>
                                                                </div>
                                                                <div class="col-md-1 text-center">:</div>
                                                                <div class="col-md-7">
                                                                    <input type="text"
                                                                        class="form-control border-0 border-bottom border-dark"
                                                                        placeholder="Tempat dan Tanggal Lahir"
                                                                        name="TTL">
                                                                </div>
                                                            </div>

                                                            <div class="row mb-2">
                                                                <div class="col-md-4">
                                                                    <label class="form-label">Jenis Kelamin</label>
                                                                </div>
                                                                <div class="col-md-1 text-center">:</div>
                                                                <div class="col-md-7">
                                                                    <select
                                                                        class="form-control border-0 border-bottom border-dark"
                                                                        name="jenis_kelamin">
                                                                        <option value="" selected disabled>- Pilih -
                                                                        </option>
                                                                        <option value="Laki-Laki">Laki-Laki</option>
                                                                        <option value="Perempuan">Perempuan</option>
                                                                    </select>
                                                                </div>
                                                            </div>

                                                            <div class="row mb-2">
                                                                <div class="col-md-4">
                                                                    <label class="form-label">Kewarganegaraan</label>
                                                                </div>
                                                                <div class="col-md-1 text-center">:</div>
                                                                <div class="col-md-7">
                                                                    <input type="text"
                                                                        class="form-control border-0 border-bottom border-dark"
                                                                        placeholder="Kewarganegaraan"
                                                                        name="kewarganegaraan">
                                                                </div>
                                                            </div>

                                                            <div class="row mb-2">
                                                                <div class="col-md-4">
                                                                    <label class="form-label">Alamat Tempat
                                                                        Tinggal</label>
                                                                </div>
                                                                <div class="col-md-1 text-center">:</div>
                                                                <div class="col-md-7">
                                                                    <textarea class="form-control border-0 border-bottom border-dark" name="alamat_tempat_tinggal" rows="2"
                                                                        placeholder="Alamat Tempat Tinggal"></textarea>
                                                                </div>
                                                            </div>

                                                            <div class="row mb-2">
                                                                <div class="col-md-4">
                                                                    <label class="form-label">Alamat KTP/Paspor</label>
                                                                </div>
                                                                <div class="col-md-1 text-center">:</div>
                                                                <div class="col-md-7">
                                                                    <textarea class="form-control border-0 border-bottom border-dark" name="alamat_ktp" rows="2"
                                                                        placeholder="Alamat KTP/Paspor"></textarea>
                                                                </div>
                                                            </div>

                                                            <div class="row mb-2">
                                                                <div class="col-md-4">
                                                                    <label class="form-label">Nomor KTP/Paspor</label>
                                                                </div>
                                                                <div class="col-md-1 text-center">:</div>
                                                                <div class="col-md-7">
                                                                    <input type="text"
                                                                        class="form-control border-0 border-bottom border-dark"
                                                                        placeholder="Nomor KTP/Paspor" name="nomor_ktp">
                                                                </div>
                                                            </div>

                                                            <div class="row mb-2">
                                                                <div class="col-md-4">
                                                                    <label class="form-label">Tempat/Pejabat yang
                                                                        Mengeluarkan KTP/Paspor</label>
                                                                </div>
                                                                <div class="col-md-1 text-center">:</div>
                                                                <div class="col-md-7">
                                                                    <textarea class="form-control border-0 border-bottom border-dark" name="tempat_pejabat" rows="2"
                                                                        placeholder="Nama tempat/pejabat yang mengeluarkan KTP/Paspor"></textarea>
                                                                </div>
                                                            </div>

                                                            <div class="row mb-2">
                                                                <div class="col-md-4">
                                                                    <label class="form-label">Datang Dari</label>
                                                                </div>
                                                                <div class="col-md-1 text-center">:</div>
                                                                <div class="col-md-7">
                                                                    <input type="text"
                                                                        class="form-control border-0 border-bottom border-dark"
                                                                        placeholder="Datang Dari" name="datang_dari">
                                                                </div>
                                                            </div>

                                                            <div class="row mb-2">
                                                                <div class="col-md-4">
                                                                    <label class="form-label">Tempat Tujuan</label>
                                                                </div>
                                                                <div class="col-md-1 text-center">:</div>
                                                                <div class="col-md-7">
                                                                    <input type="text"
                                                                        class="form-control border-0 border-bottom border-dark"
                                                                        placeholder="Tempat Tujuan"
                                                                        name="tempat_tujuan">
                                                                </div>
                                                            </div>

                                                            <div class="row mb-2">
                                                                <div class="col-md-4">
                                                                    <label class="form-label">Nama/Identitas orang yang
                                                                        bepergian dengannya</label>
                                                                </div>
                                                                <div class="col-md-1 text-center">:</div>
                                                                <div class="col-md-7">
                                                                    <textarea class="form-control border-0 border-bottom border-dark" name="nama_orang_bersamanya" rows="2"
                                                                        placeholder="Nama/identitas orang yang ikut bepergian"></textarea>
                                                                </div>
                                                            </div>

                                                            <div class="row mb-2">
                                                                <div class="col-md-4">
                                                                    <label class="form-label">Jenis/Nomor dan Tgl Dokumen
                                                                        barang yang dibawa</label>
                                                                </div>
                                                                <div class="col-md-1 text-center">:</div>
                                                                <div class="col-md-7">
                                                                    <textarea class="form-control border-0 border-bottom border-dark" name="jenis_dokumen" rows="2"
                                                                        placeholder="Jenis/Nomor dan tanggal dokumen"></textarea>
                                                                </div>
                                                            </div>
                                                        </div>



                                                        <!-- Lokasi Pemeriksaan -->
                                                        <div class="mb-4">
                                                            <div class="d-flex align-items-center mb-2">
                                                                <span class="me-1">Lokasi Pemeriksaan</span>
                                                                <span class="me-2">:</span>
                                                                <input type="text" name="lokasi_pemeriksaan_badan"
                                                                    placeholder="Diisi Tempat Lokasi Pemeriksaan Badan"
                                                                    class="form-control border-0 border-bottom border-dark flex-grow-1">
                                                            </div>

                                                            <p>Dalam pemeriksaan yang bersangkutan diminta membuka/tidak
                                                                membuka pakaian/pemeriksaan medis*.
                                                                Uraian pakaian yang dibuka/pemeriksaan medis*:</p>

                                                            <div class="mb-4">
                                                                <textarea class="form-control border-0" name="rincian_pemeriksaan_badan" rows="3"
                                                                    style="border-bottom: 1px solid black !important; resize: none;"
                                                                    placeholder="Diisi Uraian pakaian yang dibuka/pemeriksaan medis"></textarea>
                                                            </div>

                                                            <p>
                                                                Hasil pemeriksaan kedapatan sebagai berikut:
                                                            </p>

                                                            <div class="mb-4">
                                                                <textarea class="form-control border-0" name="hasil_pemeriksaan_badan" rows="3"
                                                                    style="border-bottom: 1px solid black !important; resize: none;"
                                                                    placeholder="Diisi UrHasil pemeriksaan kedapatan"></textarea>
                                                            </div>

                                                        </div>


                                                        <p class="fw-bold">Demikian Berita Acara ini dibuat dengan
                                                            sebenarnya.</p>

                                                        <!-- Tanda Tangan -->
                                                        <div class="row mt-5">
                                                            <div class="col-md-6">
                                                                <div class="text-center">
                                                                    <p>Orang Yang Diperiksa,</p>
                                                                    <div style="height: 80px;"></div>
                                                                    <p>(<input type="text"
                                                                            class="form-control d-inline border-0 border-bottom border-dark text-center"
                                                                            style="width: 150px;"
                                                                            value="terisi otomatis" readonly>)</p>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="text-center">
                                                                    <p>Pejabat yang melakukan pemeriksaan,</p>
                                                                    <div style="height: 80px;"></div>
                                                                    <p>(<input type="text"
                                                                            class="form-control d-inline border-0 border-bottom border-dark text-center"
                                                                            style="width: 150px;"
                                                                            value="terisi otomatis" readonly>)</p>
                                                                    <p>NIP. <input type="text"
                                                                            class="form-control d-inline border-0 border-bottom border-dark"
                                                                            style="width: 120px;"
                                                                            value="terisi otomatis" readonly></p>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="row mt-5">
                                                            <div class="col-md-6">
                                                                <div class="text-center">
                                                                    <p>Saksi,</p>
                                                                    <div style="height: 80px;"></div>
                                                                    <p>(<input type="text"
                                                                            class="form-control d-inline border-0 border-bottom border-dark text-center"
                                                                            style="width: 150px;"
                                                                            value="terisi otomatis" readonly>)</p>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="text-center">
                                                                    <div style="height: 80px;"></div>
                                                                    <p>(<input type="text"
                                                                            class="form-control d-inline border-0 border-bottom border-dark text-center"
                                                                            style="width: 150px;"
                                                                            value="terisi otomatis" readonly>)</p>
                                                                    <p>NIP. <input type="text"
                                                                            class="form-control d-inline border-0 border-bottom border-dark"
                                                                            style="width: 120px;"
                                                                            value="terisi otomatis" readonly></p>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <!-- Keterangan -->
                                                        <div class="mt-4">
                                                            <p><small>*Coret yang tidak perlu</small></p>
                                                            <div class="text-center">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- SOC -->
                                        <div class="accordion-item border rounded mt-2">
                                            <div class="d-flex justify-content-between align-items-center p-3 bg-light">
                                                <span class="fw-bold">SOC</span>
                                                <div class="form-check form-switch mb-0">
                                                    <input class="form-check-input status-toggle" type="checkbox"
                                                        role="switch" id="flexSwitchCheck3" data-id="flush-collapse3"
                                                        name="soc" value="TIDAK" aria-expanded="false"
                                                        aria-controls="flush-collapse3">
                                                    <label class="form-check-label" for="flexSwitchCheck3"
                                                        id="switch-label-3">TIDAK</label>
                                                </div>
                                            </div>
                                            <hr class="my-0">
                                            <div id="flush-collapse3" class="accordion-collapse collapse"
                                                data-bs-parent="#accordionFlushExample">
                                                <div class="accordion-body bg-light">
                                                    Isi dari soc
                                                </div>
                                            </div>
                                        </div>

                                        <!-- DOC -->
                                        <div class="accordion-item border rounded mt-2">
                                            <div class="d-flex justify-content-between align-items-center p-3 bg-light">
                                                <span class="fw-bold">DOC</span>
                                                <div class="form-check form-switch mb-0">
                                                    <input class="form-check-input status-toggle" type="checkbox"
                                                        role="switch" id="flexSwitchCheck4" data-id="flush-collapse4"
                                                        name="doc" value="doc" aria-expanded="false"
                                                        aria-controls="flush-collapse4">
                                                    <label class="form-check-label" for="flexSwitchCheck4"
                                                        id="switch-label-4">TIDAK</label>
                                                </div>
                                            </div>
                                            <hr class="my-0">
                                            <div id="flush-collapse4" class="accordion-collapse collapse"
                                                data-bs-parent="#accordionFlushExample">
                                                <div class="accordion-body bg-light">
                                                    Isi dari doc
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>

                                <div class="tab-pane fade" id="ba-sarkut" role="tabpanel"
                                    aria-labelledby="ba-sarkut-tab">

                                    <div class="accordion accordion-flush" id="accordionFlushExample">


                                        <div class="accordion-item border rounded">
                                            <div class="d-flex justify-content-between align-items-center p-3 bg-light">
                                                <span class="fw-bold">B.A Sarkut</span>
                                                <div class="form-check form-switch mb-0">
                                                    <input class="form-check-input status-toggle" type="checkbox"
                                                        role="switch" id="flexSwitchCheck10"
                                                        data-id="flush-collapse10" name="ba_sarkut" value="TIDAK"
                                                        aria-expanded="false" aria-controls="flush-collapse10">
                                                    <label class="form-check-label" for="flexSwitchCheck10"
                                                        id="switch-label-10">TIDAK</label>
                                                </div>
                                            </div>
                                            <hr class="my-0">
                                            <div id="flush-collapse10" class="accordion-collapse collapse text-black"
                                                data-bs-parent="#accordionFlushExample">
                                                <div class="accordion-body">
                                                    <div class="container mt-4">
                                                        <!-- Header dengan Logo -->
                                                        <div class="row mb-4 align-items-center">
                                                            <div class="col-2 text-center">
                                                                <img src="/images/logocop.png" alt="Logo"
                                                                    class="img-fluid" style="max-height:170px;">
                                                            </div>
                                                            <div class="col-10 text-center">
                                                                <h5 class="mb-0">KEMENTERIAN KEUANGAN REPUBLIK INDONESIA
                                                                </h5>
                                                                <p class="small mb-0">DIREKTORAT JENDERAL BEA DAN CUKAI
                                                                </p>
                                                                <p class="small mb-0">KANTOR PELAYANAN UTAMA BEA DAN CUKAI
                                                                    TIPE B BATAM
                                                                </p>
                                                                <p class="small mb-0">
                                                                    JALAN KUDA LAUT, BATU AMPAR, BATAM, KEPULAUAN RIAU
                                                                    29432;
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

                                                        <hr class="border border-dark border-2">


                                                        <!-- Nomor dan Tanggal -->
                                                        <div class="text-center mb-4">
                                                            <h5 class="fw-bold"><u>BERITA ACARA MEMBAWA SARANA
                                                                    PENGANGKUT/BARANG*</u></h5>
                                                            <div class="input-group flex-wrap">
                                                                <span class="input-group-text">NOMOR : BA-</span>
                                                                <input type="text" class="form-control"
                                                                    name="no_ba_sarkut" id="no_ba_sarkut"
                                                                    value="{{ old('no_ba_sarkut', $no_ref->no_ba_sarkut) }}"
                                                                    readonly>
                                                                <span class="input-group-text">/Sarkut/KPU.206/</span>
                                                                <input type="date" class="form-control"
                                                                    name="tgl_ba_sarkut">
                                                            </div>
                                                        </div>

                                                        <p class="mb-2">
                                                            <span class="text-danger">*</span> Isian dengan keterangan
                                                            <span class="text-danger">"terisi otomatis"</span> di atas
                                                            berasal dari data sebelumnya yang telah diinput melalui Data
                                                            Penindakan.
                                                        </p>



                                                        <!-- Pembukaan -->
                                                        <div class="mb-4">
                                                            <p>
                                                                Pada hari ini
                                                                <input type="text" readonly value="terisi otomatis"
                                                                    class="form-control d-inline border-0 border-bottom border-dark"
                                                                    style="width: 100px;">
                                                                tanggal
                                                                <input type="text" readonly value="terisi otomatis"
                                                                    class="form-control d-inline border-0 border-bottom border-dark"
                                                                    style="width: 80px;">
                                                                bulan
                                                                <input type="text" readonly value="terisi otomatis"
                                                                    class="form-control d-inline border-0 border-bottom border-dark"
                                                                    style="width: 80px;">
                                                                tahun
                                                                <input type="text" readonly value="terisi otomatis"
                                                                    class="form-control d-inline border-0 border-bottom border-dark"
                                                                    style="width: 80px;">
                                                                Berdasarkan Surat Perintah :
                                                                <input type="text" readonly value="terisi otomatis"
                                                                    class="form-control d-inline border-0 border-bottom border-dark"
                                                                    style="width: 100px;">
                                                                Nomor
                                                                <input type="text" readonly value="terisi otomatis"
                                                                    class="form-control d-inline border-0 border-bottom border-dark"
                                                                    style="width: 150px;">
                                                                tanggal
                                                                <input type="text" readonly value="terisi otomatis"
                                                                    class="form-control d-inline border-0 border-bottom border-dark"
                                                                    style="width: 100px;">
                                                            </p>




                                                            <p>Kami yang bertanda tangan di bawah ini telah membawa:</p>
                                                        </div>

                                                        <!-- A. Sarana Pengangkut -->
                                                        <div class="mb-4">
                                                            <h6 class="fw-bold">A. Sarana Pengangkut</h6>

                                                            <div class="row mb-2">
                                                                <div class="col-md-4">
                                                                    <label class="form-label">Nama dan Jenis
                                                                        Sarkut</label>
                                                                </div>
                                                                <div class="col-md-1 text-center">:</div>
                                                                <div class="col-md-7">
                                                                    <input type="text" readonly
                                                                        value="terisi otomatis"
                                                                        class="form-control border-0 border-bottom border-dark">
                                                                </div>
                                                            </div>

                                                            <div class="row mb-2">
                                                                <div class="col-md-4">
                                                                    <label class="form-label">No Reg./No. Polisi</label>
                                                                </div>
                                                                <div class="col-md-1 text-center">:</div>
                                                                <div class="col-md-7">
                                                                    <input type="text" readonly
                                                                        value="terisi otomatis"
                                                                        class="form-control border-0 border-bottom border-dark">
                                                                </div>
                                                            </div>

                                                            <div class="row mb-2">
                                                                <div class="col-md-4">
                                                                    <label class="form-label">Bendera</label>
                                                                </div>
                                                                <div class="col-md-1 text-center">:</div>
                                                                <div class="col-md-7">
                                                                    <input type="text" readonly
                                                                        value="terisi otomatis"
                                                                        class="form-control border-0 border-bottom border-dark">
                                                                </div>
                                                            </div>

                                                            <div class="row mb-2">
                                                                <div class="col-md-4">
                                                                    <label class="form-label">Nakhoda/Pilot/Pengemudi<span
                                                                            class="text-danger">*</span></label>
                                                                </div>
                                                                <div class="col-md-1 text-center">:</div>
                                                                <div class="col-md-7">
                                                                    <input type="text" readonly
                                                                        value="terisi otomatis"
                                                                        class="form-control border-0 border-bottom border-dark">
                                                                </div>
                                                            </div>

                                                            <div class="row mb-2">
                                                                <div class="col-md-4">
                                                                    <label class="form-label">No. Identitas</label>
                                                                </div>
                                                                <div class="col-md-1 text-center">:</div>
                                                                <div class="col-md-7">
                                                                    <input type="text" readonly
                                                                        value="terisi otomatis"
                                                                        class="form-control border-0 border-bottom border-dark">
                                                                </div>
                                                            </div>
                                                        </div>


                                                        <!-- B. Barang -->
                                                        <div class="mb-4">
                                                            <h6 class="fw-bold">B. Barang</h6>

                                                            <div class="row mb-2">
                                                                <div class="col-md-4">
                                                                    <label class="form-label">Jumlah/Jenis/No Peti
                                                                        Kemas/Kemasan</label>
                                                                </div>
                                                                <div class="col-md-1 text-center">:</div>
                                                                <div class="col-md-7">
                                                                    <input type="text" readonly
                                                                        value="terisi otomatis"
                                                                        class="form-control border-0 border-bottom border-dark">
                                                                </div>
                                                            </div>

                                                            <div class="row mb-2">
                                                                <div class="col-md-4">
                                                                    <label class="form-label">Jumlah/Jenis Barang</label>
                                                                </div>
                                                                <div class="col-md-1 text-center">:</div>
                                                                <div class="col-md-7">
                                                                    <input type="text" readonly
                                                                        value="terisi otomatis"
                                                                        class="form-control border-0 border-bottom border-dark">
                                                                </div>
                                                            </div>

                                                            <div class="row mb-2">
                                                                <div class="col-md-4">
                                                                    <label class="form-label">Jenis/No dan Tgl
                                                                        Dokumen</label>
                                                                </div>
                                                                <div class="col-md-1 text-center">:</div>
                                                                <div class="col-md-7">
                                                                    <input type="text" readonly
                                                                        value="terisi otomatis"
                                                                        class="form-control border-0 border-bottom border-dark">
                                                                </div>
                                                            </div>

                                                            <div class="row mb-2">
                                                                <div class="col-md-4">
                                                                    <label class="form-label">
                                                                        Pemilik/Importir/Eksportir/Kuasa<span
                                                                            class="text-danger">*</span>
                                                                    </label>
                                                                </div>
                                                                <div class="col-md-1 text-center">:</div>
                                                                <div class="col-md-7">
                                                                    <input type="text" readonly
                                                                        value="terisi otomatis"
                                                                        class="form-control border-0 border-bottom border-dark">
                                                                </div>
                                                            </div>

                                                            <div class="row mb-2">
                                                                <div class="col-md-4">
                                                                    <label class="form-label">No. Identitas</label>
                                                                </div>
                                                                <div class="col-md-1 text-center">:</div>
                                                                <div class="col-md-7">
                                                                    <input type="text" readonly
                                                                        value="terisi otomatis"
                                                                        class="form-control border-0 border-bottom border-dark">
                                                                </div>
                                                            </div>

                                                            <div class="row mb-2">
                                                                <div class="col-md-4">
                                                                    <label class="form-label">Dari</label>
                                                                </div>
                                                                <div class="col-md-1 text-center">:</div>
                                                                <div class="col-md-7">
                                                                    <input type="text" name="dibawa_dari"
                                                                        placeholder="Diisi dengan tempat sarkut mulai dibawa"
                                                                        class="form-control border-0 border-bottom border-dark">
                                                                </div>
                                                            </div>

                                                            <div class="row mb-2">
                                                                <div class="col-md-4">
                                                                    <label class="form-label">Ke/tujuan</label>
                                                                </div>
                                                                <div class="col-md-1 text-center">:</div>
                                                                <div class="col-md-7">
                                                                    <input type="text" name="tujuan"
                                                                        placeholder="Diisi dengan tempat tujuan sarkut"
                                                                        class="form-control border-0 border-bottom border-dark">
                                                                </div>
                                                            </div>

                                                            <div class="row mb-2">
                                                                <div class="col-md-4">
                                                                    <label class="form-label">Alasan</label>
                                                                </div>
                                                                <div class="col-md-1 text-center">:</div>
                                                                <div class="col-md-7">
                                                                    <textarea class="form-control border-0" placeholder="Diisi pertimbangan dan alasan sarana pengangkut/barang dibawa"
                                                                        name="alasan" rows="3" style="border-bottom: 1px solid black !important; resize: none;"></textarea>
                                                                </div>
                                                            </div>

                                                            <div class="row mb-2">
                                                                <div class="col-md-4">
                                                                    <label class="form-label">Waktu Berangkat</label>
                                                                </div>
                                                                <div class="col-md-1 text-center">:</div>
                                                                <div class="col-md-7">
                                                                    <input type="text" name="waktu_berangkat"
                                                                        id="datetime-datepicker"
                                                                        placeholder="Diisi Waktu Keberangkatan"
                                                                        class="form-control border-0 border-bottom border-dark">
                                                                </div>
                                                            </div>

                                                            <div class="row mb-2">
                                                                <div class="col-md-4">
                                                                    <label class="form-label">Waktu Tiba</label>
                                                                </div>
                                                                <div class="col-md-1 text-center">:</div>
                                                                <div class="col-md-7">
                                                                    <input type="text" name="waktu_tiba"
                                                                        id="datetime-datepicker"
                                                                        placeholder="Waktu Tiba"
                                                                        class="form-control border-0 border-bottom border-dark">
                                                                </div>
                                                            </div>
                                                        </div>


                                                        <p class="fw-bold">Demikian Berita Acara ini dibuat dengan
                                                            sebenarnya.</p>

                                                        <!-- Tanda Tangan -->
                                                        <div class="row mt-5">
                                                            <div class="col-md-6">
                                                                <div class="text-center">
                                                                    <p>Pemilik/Kuasanya/Saksi*,</p>
                                                                    <div style="height: 80px;"></div>
                                                                    <p>(<input type="text"
                                                                            class="form-control d-inline border-0 border-bottom border-dark text-center"
                                                                            style="width: 150px;"
                                                                            value="terisi otomatis" readonly>)</p>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="text-center">
                                                                    <p>Pejabat yang melakukan pemeriksaan,</p>
                                                                    <div style="height: 80px;"></div>
                                                                    <p>(<input type="text"
                                                                            class="form-control d-inline border-0 border-bottom border-dark text-center"
                                                                            style="width: 150px;"
                                                                            value="terisi otomatis" readonly>)</p>
                                                                    <p>NIP. <input type="text"
                                                                            class="form-control d-inline border-0 border-bottom border-dark"
                                                                            style="width: 120px;"
                                                                            value="terisi otomatis" readonly></p>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <!-- Keterangan -->
                                                        <div class="mt-4">
                                                            <p><small>*Coret yang tidak perlu</small></p>
                                                            <div class="text-center">
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="tab-pane fade " id="ba-contoh" role="tabpanel"
                                    aria-labelledby="ba-contoh-tab">

                                    <div class="accordion accordion-flush" id="accordionFlushExample">

                                        <!-- B.A Contoh -->
                                        <div class="accordion-item border rounded">
                                            <div class="d-flex justify-content-between align-items-center p-3 bg-light">
                                                <span class="fw-bold">B.A Contoh</span>
                                                <div class="form-check form-switch mb-0">
                                                    <input class="form-check-input status-toggle" type="checkbox"
                                                        role="switch" id="flexSwitchCheck101"
                                                        data-id="flush-collapse101" name="ba_contoh" value="TIDAK"
                                                        aria-expanded="false" aria-controls="flush-collapse101">
                                                    <label class="form-check-label" for="flexSwitchCheck101"
                                                        id="switch-label-101">TIDAK</label>
                                                </div>
                                            </div>
                                            <hr class="my-0">
                                            <div id="flush-collapse101" class="accordion-collapse collapse text-black"
                                                data-bs-parent="#accordionFlushExample">
                                                <div class="accordion-body">
                                                    <div class="container mt-4">
                                                        <!-- Header dengan Logo -->
                                                        <div class="row mb-4 align-items-center">
                                                            <div class="col-2 text-center">
                                                                <img src="/images/logocop.png" alt="Logo"
                                                                    class="img-fluid" style="max-height:170px;">
                                                            </div>
                                                            <div class="col-10 text-center">
                                                                <h5 class="mb-0">KEMENTERIAN KEUANGAN REPUBLIK INDONESIA
                                                                </h5>
                                                                <p class="small mb-0">DIREKTORAT JENDERAL BEA DAN CUKAI
                                                                </p>
                                                                <p class="small mb-0">KANTOR PELAYANAN UTAMA BEA DAN CUKAI
                                                                    TIPE B BATAM
                                                                </p>
                                                                <p class="small mb-0">
                                                                    JALAN KUDA LAUT, BATU AMPAR, BATAM, KEPULAUAN RIAU
                                                                    29432;
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

                                                        <hr class="border border-dark border-2">


                                                        <!-- Nomor dan Tanggal -->
                                                        <div class="text-center mb-4">
                                                            <h5 class="fw-bold">BERITA ACARA PENGAMBILAN CONTOH BARANG
                                                            </h5>
                                                            <div class="input-group flex-wrap">
                                                                <span class="input-group-text">NOMOR : BA-</span>
                                                                <input type="text" class="form-control"
                                                                    name="no_ba_contoh" id="no_ba_contoh"
                                                                    value="{{ old('no_ba_contoh', $no_ref->no_ba_contoh) }}"
                                                                    readonly>
                                                                <span class="input-group-text">/Contoh/KPU.206/</span>
                                                                <input type="date" class="form-control"
                                                                    name="tgl_ba_contoh">
                                                            </div>
                                                        </div>

                                                        <p class="mb-2">
                                                            <span class="text-danger">*</span> Isian dengan keterangan
                                                            <span class="text-danger">"terisi otomatis"</span> di atas
                                                            berasal dari data sebelumnya yang telah diinput melalui Data
                                                            Penindakan.
                                                        </p>



                                                        <!-- Pembukaan -->
                                                        <div class="mb-4">
                                                            <p>
                                                                Pada hari ini
                                                                <input type="text" readonly value="terisi otomatis"
                                                                    class="form-control d-inline border-0 border-bottom border-dark"
                                                                    style="width: 100px;">
                                                                tanggal
                                                                <input type="text" readonly value="terisi otomatis"
                                                                    class="form-control d-inline border-0 border-bottom border-dark"
                                                                    style="width: 80px;">
                                                                bulan
                                                                <input type="text" readonly value="terisi otomatis"
                                                                    class="form-control d-inline border-0 border-bottom border-dark"
                                                                    style="width: 80px;">
                                                                tahun
                                                                <input type="text" readonly value="terisi otomatis"
                                                                    class="form-control d-inline border-0 border-bottom border-dark"
                                                                    style="width: 80px;">
                                                                Berdasarkan Surat Perintah :
                                                                <input type="text" readonly value="terisi otomatis"
                                                                    class="form-control d-inline border-0 border-bottom border-dark"
                                                                    style="width: 100px;">
                                                                Nomor
                                                                <input type="text" readonly value="terisi otomatis"
                                                                    class="form-control d-inline border-0 border-bottom border-dark"
                                                                    style="width: 150px;">
                                                                tanggal
                                                                <input type="text" readonly value="terisi otomatis"
                                                                    class="form-control d-inline border-0 border-bottom border-dark"
                                                                    style="width: 100px;">
                                                            </p>




                                                            <p>Kami yang bertanda tangan di bawah ini telah melakukan
                                                                pengambilan barang contoh atas:</p>
                                                        </div>


                                                        <!-- B. Barang -->
                                                        <div class="mb-4">

                                                            <div class="row mb-2">
                                                                <div class="col-md-4">
                                                                    <label class="form-label">Jumlah Dan Jenis
                                                                        Barang</label>
                                                                </div>
                                                                <div class="col-md-1 text-center">:</div>
                                                                <div class="col-md-7">
                                                                    <textarea class="form-control border-0" placeholder="Jumlah dan Jenis Barang Contoh"
                                                                        name="jumlah_jenis_barang_contoh" rows="3"
                                                                        style="border-bottom: 1px solid black !important; resize: none;"></textarea>
                                                                </div>
                                                            </div>

                                                            <div class="row mb-2">
                                                                <div class="col-md-4">
                                                                    <label class="form-label">
                                                                        Pemilik/Importir/Eksportir/Kuasa<span
                                                                            class="text-danger">*</span>
                                                                    </label>
                                                                </div>
                                                                <div class="col-md-1 text-center">:</div>
                                                                <div class="col-md-7">
                                                                    <input type="text" readonly
                                                                        value="terisi otomatis"
                                                                        class="form-control border-0 border-bottom border-dark">
                                                                </div>
                                                            </div>

                                                            <div class="row mb-2">
                                                                <div class="col-md-4">
                                                                    <label class="form-label">No. Identitas</label>
                                                                </div>
                                                                <div class="col-md-1 text-center">:</div>
                                                                <div class="col-md-7">
                                                                    <input type="text" readonly
                                                                        value="terisi otomatis"
                                                                        class="form-control border-0 border-bottom border-dark">
                                                                </div>
                                                            </div>

                                                            <div class="row mb-2">
                                                                <div class="col-md-4">
                                                                    <label class="form-label">Jenis/Nomor Dan Tgl
                                                                        Dokumen</label>
                                                                </div>
                                                                <div class="col-md-1 text-center">:</div>
                                                                <div class="col-md-7">
                                                                    <input type="text" readonly
                                                                        value="terisi otomatis"
                                                                        class="form-control border-0 border-bottom border-dark">
                                                                </div>
                                                            </div>

                                                            <div class="row mb-2">
                                                                <div class="col-md-4">
                                                                    <label class="form-label">Lokasi</label>
                                                                </div>
                                                                <div class="col-md-1 text-center">:</div>
                                                                <div class="col-md-7">
                                                                    <input type="text"
                                                                        placeholder="Diisi Lokasi Pengambilan Barang Contoh"
                                                                        name="lokasi_barcon"
                                                                        class="form-control border-0 border-bottom border-dark">
                                                                </div>
                                                            </div>
                                                        </div>



                                                        <div class="mb-4">

                                                            <p>Pengambilan contoh disaksikan oleh
                                                                pengangkut/pemilik/importir/eksportir atau kuasanya*:</p>


                                                            <div class="d-flex align-items-center mb-2">
                                                                <span class="me-1">Nama</span>
                                                                <span class="me-2">:</span>
                                                                <input type="text" readonly value="terisi otomatis"
                                                                    class="form-control border-0 border-bottom border-dark flex-grow-1">
                                                            </div>

                                                            <div class="d-flex align-items-center mb-2">
                                                                <span class="me-1">Alamat</span>
                                                                <span class="me-2">:</span>
                                                                <input type="text" readonly value="terisi otomatis"
                                                                    class="form-control border-0 border-bottom border-dark flex-grow-1">
                                                            </div>

                                                            <div class="d-flex align-items-center mb-2">
                                                                <span class="me-1">Pekerjaan</span>
                                                                <span class="me-2">:</span>
                                                                <input type="text" readonly value="terisi otomatis"
                                                                    class="form-control border-0 border-bottom border-dark flex-grow-1">
                                                            </div>

                                                            <div class="d-flex align-items-center mb-2">
                                                                <span class="me-1">Identitas (KTP/SIM/Passport)</span>
                                                                <span class="me-2">:</span>
                                                                <input type="text" readonly value="terisi otomatis"
                                                                    class="form-control border-0 border-bottom border-dark flex-grow-1">
                                                            </div>
                                                        </div>


                                                        <p class="fw-bold">Demikian Berita Acara ini dibuat dengan
                                                            sebenarnya.</p>

                                                        <!-- Tanda Tangan -->
                                                        <div class="row mt-5">
                                                            <div class="col-md-6">
                                                                <div class="text-center">
                                                                    <p>Pemilik/Kuasanya/Saksi*,</p>
                                                                    <div style="height: 80px;"></div>
                                                                    <p>(<input type="text"
                                                                            class="form-control d-inline border-0 border-bottom border-dark text-center"
                                                                            style="width: 150px;"
                                                                            value="terisi otomatis" readonly>)</p>
                                                                    <p>NIP. <input type="text"
                                                                            class="form-control d-inline border-0 border-bottom border-dark"
                                                                            style="width: 120px;"
                                                                            value="terisi otomatis" readonly></p>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="text-center">
                                                                    <p>Pejabat yang melakukan pemeriksaan,</p>
                                                                    <div style="height: 80px;"></div>
                                                                    <p>(<input type="text"
                                                                            class="form-control d-inline border-0 border-bottom border-dark text-center"
                                                                            style="width: 150px;"
                                                                            value="terisi otomatis" readonly>)</p>
                                                                    <p>NIP. <input type="text"
                                                                            class="form-control d-inline border-0 border-bottom border-dark"
                                                                            style="width: 120px;"
                                                                            value="terisi otomatis" readonly></p>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <!-- Keterangan -->
                                                        <div class="mt-4">
                                                            <p><small>*Coret yang tidak perlu</small></p>
                                                            <div class="text-center">
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>


                                    </div>

                                </div>

                                <div class="tab-pane fade " id="ba-dok" role="tabpanel"
                                    aria-labelledby="ba-dok-tab">
                                    <div class="accordion accordion-flush" id="accordionFlushExample">

                                        <!-- B.A Dokumentasi -->
                                        <div class="accordion-item border rounded">
                                            <div class="d-flex justify-content-between align-items-center p-3 bg-light">
                                                <span class="fw-bold">B.A Dokumentasi</span>
                                                <div class="form-check form-switch mb-0">
                                                    <input class="form-check-input status-toggle" type="checkbox"
                                                        role="switch" id="flexSwitchCheck102n"
                                                        data-id="flush-collapse102n" name="ba_dok" value="TIDAK"
                                                        aria-expanded="false" aria-controls="flush-collapse102n">
                                                    <label class="form-check-label" for="flexSwitchCheck102n"
                                                        id="switch-label-102n">TIDAK</label>
                                                </div>
                                            </div>
                                            <hr class="my-0">
                                            <div id="flush-collapse102n" class="accordion-collapse collapse text-black"
                                                data-bs-parent="#accordionFlushExample">
                                                <div class="accordion-body">
                                                    <div class="container mt-4">
                                                        <!-- Header dengan Logo -->
                                                        <div class="row mb-4 align-items-center">
                                                            <div class="col-2 text-center">
                                                                <img src="/images/logocop.png" alt="Logo"
                                                                    class="img-fluid" style="max-height:170px;">
                                                            </div>
                                                            <div class="col-10 text-center">
                                                                <h5 class="mb-0">KEMENTERIAN KEUANGAN REPUBLIK INDONESIA
                                                                </h5>
                                                                <p class="small mb-0">DIREKTORAT JENDERAL BEA DAN CUKAI
                                                                </p>
                                                                <p class="small mb-0">KANTOR PELAYANAN UTAMA BEA DAN CUKAI
                                                                    TIPE B BATAM
                                                                </p>
                                                                <p class="small mb-0">
                                                                    JALAN KUDA LAUT, BATU AMPAR, BATAM, KEPULAUAN RIAU
                                                                    29432;
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

                                                        <hr class="border border-dark border-2">


                                                        <!-- Nomor dan Tanggal -->
                                                        <div class="text-center mb-4">
                                                            <h5 class="fw-bold">BERITA ACARA PENGAMBILAN DOKUMENTASI
                                                                BARANG</h5>
                                                            <div class="input-group flex-wrap">
                                                                <span class="input-group-text">NOMOR : BA-</span>
                                                                <input type="text" class="form-control"
                                                                    name="no_ba_dok" id="no_ba_dok"
                                                                    value="{{ old('no_ba_dok', $no_ref->no_ba_dok) }}"
                                                                    readonly>
                                                                <span
                                                                    class="input-group-text">/Dokumentasi/KPU.206/</span>
                                                                <input type="date" class="form-control"
                                                                    name="tgl_ba_dok">
                                                            </div>
                                                        </div>

                                                        <p class="mb-2">
                                                            <span class="text-danger">*</span> Isian dengan keterangan
                                                            <span class="text-danger">"terisi otomatis"</span> di atas
                                                            berasal dari data sebelumnya yang telah diinput melalui Data
                                                            Penindakan.
                                                        </p>



                                                        <!-- Pembukaan -->
                                                        <div class="mb-4">
                                                            <p>
                                                                Pada hari ini
                                                                <input type="text" readonly value="terisi otomatis"
                                                                    class="form-control d-inline border-0 border-bottom border-dark"
                                                                    style="width: 100px;">
                                                                tanggal
                                                                <input type="text" readonly value="terisi otomatis"
                                                                    class="form-control d-inline border-0 border-bottom border-dark"
                                                                    style="width: 80px;">
                                                                bulan
                                                                <input type="text" readonly value="terisi otomatis"
                                                                    class="form-control d-inline border-0 border-bottom border-dark"
                                                                    style="width: 80px;">
                                                                tahun
                                                                <input type="text" readonly value="terisi otomatis"
                                                                    class="form-control d-inline border-0 border-bottom border-dark"
                                                                    style="width: 80px;">
                                                                Berdasarkan Surat Perintah :
                                                                <input type="text" readonly value="terisi otomatis"
                                                                    class="form-control d-inline border-0 border-bottom border-dark"
                                                                    style="width: 100px;">
                                                                Nomor
                                                                <input type="text" readonly value="terisi otomatis"
                                                                    class="form-control d-inline border-0 border-bottom border-dark"
                                                                    style="width: 150px;">
                                                                tanggal
                                                                <input type="text" readonly value="terisi otomatis"
                                                                    class="form-control d-inline border-0 border-bottom border-dark"
                                                                    style="width: 100px;">
                                                            </p>




                                                            <p>Kami yang bertanda tangan di bawah ini telah melakukan
                                                                pengambilan dokumentasi barang atas :</p>
                                                        </div>


                                                        <!-- B. Barang -->
                                                        <div class="mb-4">

                                                            <div class="row mb-2">
                                                                <div class="col-md-4">
                                                                    <label class="form-label">komoditas/Jenis
                                                                        Barang</label>
                                                                </div>
                                                                <div class="col-md-1 text-center">:</div>
                                                                <div class="col-md-7">
                                                                    <input type="text" readonly
                                                                        value="terisi otomatis"
                                                                        class="form-control border-0 border-bottom border-dark">
                                                                </div>
                                                            </div>

                                                            <div class="row mb-2">
                                                                <div class="col-md-4">
                                                                    <label class="form-label">
                                                                        Pemilik/Importir/Eksportir/Kuasa<span
                                                                            class="text-danger">*</span>
                                                                    </label>
                                                                </div>
                                                                <div class="col-md-1 text-center">:</div>
                                                                <div class="col-md-7">
                                                                    <input type="text" readonly
                                                                        value="terisi otomatis"
                                                                        class="form-control border-0 border-bottom border-dark">
                                                                </div>
                                                            </div>

                                                            <div class="row mb-2">
                                                                <div class="col-md-4">
                                                                    <label class="form-label">No. Identitas</label>
                                                                </div>
                                                                <div class="col-md-1 text-center">:</div>
                                                                <div class="col-md-7">
                                                                    <input type="text" readonly
                                                                        value="terisi otomatis"
                                                                        class="form-control border-0 border-bottom border-dark">
                                                                </div>
                                                            </div>

                                                            <div class="row mb-2">
                                                                <div class="col-md-4">
                                                                    <label class="form-label">Jenis/Nomor Dan Tgl
                                                                        Dokumen</label>
                                                                </div>
                                                                <div class="col-md-1 text-center">:</div>
                                                                <div class="col-md-7">
                                                                    <input type="text" readonly
                                                                        value="terisi otomatis"
                                                                        class="form-control border-0 border-bottom border-dark">
                                                                </div>
                                                            </div>

                                                            <div class="row mb-2">
                                                                <div class="col-md-4">
                                                                    <label class="form-label">Lokasi</label>
                                                                </div>
                                                                <div class="col-md-1 text-center">:</div>
                                                                <div class="col-md-7">
                                                                    <input type="text"
                                                                        placeholder="Lokasi Dokumentasi Barang"
                                                                        name="lokasi_ba_dok"
                                                                        class="form-control border-0 border-bottom border-dark">
                                                                </div>
                                                            </div>
                                                        </div>


                                                        <!-- Lokasi Pemeriksaan -->
                                                        <div class="mb-4">

                                                            <p>Pengambilan dokumentasi disaksikan oleh pengangkut/pemilik/
                                                                atau kuasanya*:</p>


                                                            <div class="d-flex align-items-center mb-2">
                                                                <span class="me-1">Nama</span>
                                                                <span class="me-2">:</span>
                                                                <input type="text" readonly value="terisi otomatis"
                                                                    class="form-control border-0 border-bottom border-dark flex-grow-1">
                                                            </div>

                                                            <div class="d-flex align-items-center mb-2">
                                                                <span class="me-1">Alamat</span>
                                                                <span class="me-2">:</span>
                                                                <input type="text" readonly value="terisi otomatis"
                                                                    class="form-control border-0 border-bottom border-dark flex-grow-1">
                                                            </div>

                                                            <div class="d-flex align-items-center mb-2">
                                                                <span class="me-1">Pekerjaan</span>
                                                                <span class="me-2">:</span>
                                                                <input type="text" readonly value="terisi otomatis"
                                                                    class="form-control border-0 border-bottom border-dark flex-grow-1">
                                                            </div>

                                                            <div class="d-flex align-items-center mb-2">
                                                                <span class="me-1">Identitas (KTP/SIM/Passport)</span>
                                                                <span class="me-2">:</span>
                                                                <input type="text" readonly value="terisi otomatis"
                                                                    class="form-control border-0 border-bottom border-dark flex-grow-1">
                                                            </div>
                                                        </div>


                                                        <p class="fw-bold">Demikian Berita Acara ini dibuat dengan
                                                            sebenarnya.</p>

                                                        <!-- Tanda Tangan -->
                                                        <div class="row mt-5">
                                                            <div class="col-md-6">
                                                                <div class="text-center">
                                                                    <p>Pemilik/Kuasanya/Saksi*,</p>
                                                                    <div style="height: 80px;"></div>
                                                                    <p>(<input type="text"
                                                                            class="form-control d-inline border-0 border-bottom border-dark text-center"
                                                                            style="width: 150px;"
                                                                            value="terisi otomatis" readonly>)</p>
                                                                    <p>NIP. <input type="text"
                                                                            class="form-control d-inline border-0 border-bottom border-dark"
                                                                            style="width: 120px;"
                                                                            value="terisi otomatis" readonly></p>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="text-center">
                                                                    <p>Pejabat yang melakukan pemeriksaan,</p>
                                                                    <div style="height: 80px;"></div>
                                                                    <p>(<input type="text"
                                                                            class="form-control d-inline border-0 border-bottom border-dark text-center"
                                                                            style="width: 150px;"
                                                                            value="terisi otomatis" readonly>)</p>
                                                                    <p>NIP. <input type="text"
                                                                            class="form-control d-inline border-0 border-bottom border-dark"
                                                                            style="width: 120px;"
                                                                            value="terisi otomatis" readonly></p>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <!-- Keterangan -->
                                                        <div class="mt-4">
                                                            <p><small>*Coret yang tidak perlu</small></p>
                                                            <div class="text-center">
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="tab-pane fade" id="ba-tegah" role="tabpanel"
                                    aria-labelledby="ba-tegah-tab">
                                    <div class="accordion accordion-flush" id="accordionFlushExample">

                                        <!-- B.A Dokumentasi -->
                                        <div class="accordion-item border rounded">
                                            <div class="d-flex justify-content-between align-items-center p-3 bg-light">
                                                <span class="fw-bold">B.A Tegah</span>
                                                <div class="form-check form-switch mb-0">
                                                    <input class="form-check-input status-toggle" type="checkbox"
                                                        role="switch" id="flexSwitchCheck1059"
                                                        data-id="flush-collapse1059" name="ba_tegah" value="TIDAK"
                                                        aria-expanded="false" aria-controls="flush-collapse1059">
                                                    <label class="form-check-label" for="flexSwitchCheck1059"
                                                        id="switch-label-1059">TIDAK</label>
                                                </div>
                                            </div>
                                            <hr class="my-0">
                                            <div id="flush-collapse1059" class="accordion-collapse collapse"
                                                data-bs-parent="#accordionFlushExample">
                                                <div class="accordion-body bg-light">
                                                    <h6><b>A. Data B.A Tegah</b></h6>
                                                    <hr>
                                                    <div class="row">
                                                        <div class="col-md-6 mb-3">
                                                            <label>No. B.A Tegah</label>
                                                            <input type="text"
                                                                class="form-control bg-primary text-white"
                                                                value="{{ old('no_ba_tegah', $no_ref->no_ba_tegah) }}"
                                                                placeholder="No. B.A Tegah" name="no_ba_tegah" readonly>
                                                        </div>

                                                        <div class="col-md-6 mb-3">
                                                            <label>Tgl. B.A Tegah</label>
                                                            <input type="date"
                                                                class="form-control bg-primary text-white"
                                                                name="tgl_ba_tegah">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>


                                    </div>
                                </div>

                                <div class="tab-pane fade" id="ba-segel" role="tabpanel"
                                    aria-labelledby="ba-segel-tab">
                                    <div class="accordion accordion-flush" id="accordionFlushExample">

                                        <!-- B.A Dokumentasi -->
                                        <div class="accordion-item border rounded">
                                            <div class="d-flex justify-content-between align-items-center p-3 bg-light">
                                                <span class="fw-bold">B.A Segel</span>
                                                <div class="form-check form-switch mb-0">
                                                    <input class="form-check-input status-toggle" type="checkbox"
                                                        role="switch" id="flexSwitchCheck1032"
                                                        data-id="flush-collapse1032" name="ba_segel" value="TIDAK"
                                                        aria-expanded="false" aria-controls="flush-collapse1032">
                                                    <label class="form-check-label" for="flexSwitchCheck1032"
                                                        id="switch-label-1032">TIDAK</label>
                                                </div>
                                            </div>
                                            <hr class="my-0">
                                            <div id="flush-collapse1032" class="accordion-collapse collapse text-black"
                                                data-bs-parent="#accordionFlushExample">
                                                <div class="accordion-body">
                                                    <div class="container mt-4">
                                                        <!-- Header dengan Logo -->
                                                        <div class="row mb-4 align-items-center">
                                                            <div class="col-2 text-center">
                                                                <img src="/images/logocop.png" alt="Logo"
                                                                    class="img-fluid" style="max-height:170px;">
                                                            </div>
                                                            <div class="col-10 text-center">
                                                                <h5 class="mb-0">KEMENTERIAN KEUANGAN REPUBLIK INDONESIA
                                                                </h5>
                                                                <p class="small mb-0">DIREKTORAT JENDERAL BEA DAN CUKAI
                                                                </p>
                                                                <p class="small mb-0">KANTOR PELAYANAN UTAMA BEA DAN CUKAI
                                                                    TIPE B BATAM
                                                                </p>
                                                                <p class="small mb-0">
                                                                    JALAN KUDA LAUT, BATU AMPAR, BATAM, KEPULAUAN RIAU
                                                                    29432;
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

                                                        <hr class="border border-dark border-2">


                                                        <!-- Nomor dan Tanggal -->
                                                        <div class="text-center mb-4">
                                                            <h5 class="fw-bold">BERITA ACARA PENYEGELAN</h5>
                                                            <div class="input-group flex-wrap">
                                                                <span class="input-group-text">NOMOR : BA-</span>
                                                                <input type="text" class="form-control"
                                                                    name="no_ba_segel" id="no_ba_segel"
                                                                    value="{{ old('no_ba_segel', $no_ref->no_ba_segel) }}"
                                                                    readonly>
                                                                <span class="input-group-text">/Riksa/KPU.206/</span>
                                                                <input type="date" class="form-control"
                                                                    name="tgl_ba_segel">
                                                            </div>
                                                        </div>

                                                        <p class="mb-2">
                                                            <span class="text-danger">*</span> Isian dengan keterangan
                                                            <span class="text-danger">"terisi otomatis"</span> di atas
                                                            berasal dari data sebelumnya yang telah diinput melalui Data
                                                            Penindakan.
                                                        </p>



                                                        <!-- Pembukaan -->
                                                        <div class="mb-4">
                                                            <p>
                                                                Pada hari ini
                                                                <input type="text" readonly value="terisi otomatis"
                                                                    class="form-control d-inline border-0 border-bottom border-dark"
                                                                    style="width: 100px;">
                                                                Berdasarkan Surat Perintah :
                                                                <input type="text" readonly value="terisi otomatis"
                                                                    class="form-control d-inline border-0 border-bottom border-dark"
                                                                    style="width: 100px;">
                                                                tanggal
                                                                <input type="text" readonly value="terisi otomatis"
                                                                    class="form-control d-inline border-0 border-bottom border-dark"
                                                                    style="width: 80px;">
                                                                bulan
                                                                <input type="text" readonly value="terisi otomatis"
                                                                    class="form-control d-inline border-0 border-bottom border-dark"
                                                                    style="width: 80px;">
                                                                tahun
                                                                <input type="text" readonly value="terisi otomatis"
                                                                    class="form-control d-inline border-0 border-bottom border-dark"
                                                                    style="width: 80px;">
                                                                Berdasarkan Surat Perintah :
                                                                <input type="text" readonly value="terisi otomatis"
                                                                    class="form-control d-inline border-0 border-bottom border-dark"
                                                                    style="width: 100px;">
                                                                Nomor
                                                                <input type="text" readonly value="terisi otomatis"
                                                                    class="form-control d-inline border-0 border-bottom border-dark"
                                                                    style="width: 150px;">
                                                                tanggal
                                                                <input type="text" readonly value="terisi otomatis"
                                                                    class="form-control d-inline border-0 border-bottom border-dark"
                                                                    style="width: 100px;">
                                                            </p>




                                                            <p>Kami yang bertanda tangan di bawah ini telah melakukan
                                                                penyegelan atas :</p>
                                                        </div>

                                                        <!-- A. Sarana Pengangkut -->
                                                        <div class="mb-4">
                                                            <h6 class="fw-bold">A. Sarana Pengangkut</h6>

                                                            <div class="row mb-2">
                                                                <div class="col-md-4">
                                                                    <label class="form-label">Nama dan Jenis
                                                                        Sarkut</label>
                                                                </div>
                                                                <div class="col-md-1 text-center">:</div>
                                                                <div class="col-md-7">
                                                                    <input type="text" readonly
                                                                        value="terisi otomatis"
                                                                        class="form-control border-0 border-bottom border-dark">
                                                                </div>
                                                            </div>

                                                            <div class="row mb-2">
                                                                <div class="col-md-4">
                                                                    <label class="form-label">No Reg./No. Polisi</label>
                                                                </div>
                                                                <div class="col-md-1 text-center">:</div>
                                                                <div class="col-md-7">
                                                                    <input type="text" readonly
                                                                        value="terisi otomatis"
                                                                        class="form-control border-0 border-bottom border-dark">
                                                                </div>
                                                            </div>

                                                            <div class="row mb-2">
                                                                <div class="col-md-4">
                                                                    <label class="form-label">Bendera</label>
                                                                </div>
                                                                <div class="col-md-1 text-center">:</div>
                                                                <div class="col-md-7">
                                                                    <input type="text" readonly
                                                                        value="terisi otomatis"
                                                                        class="form-control border-0 border-bottom border-dark">
                                                                </div>
                                                            </div>

                                                            <div class="row mb-2">
                                                                <div class="col-md-4">
                                                                    <label class="form-label">Nakhoda/Pilot/Pengemudi<span
                                                                            class="text-danger">*</span></label>
                                                                </div>
                                                                <div class="col-md-1 text-center">:</div>
                                                                <div class="col-md-7">
                                                                    <input type="text" readonly
                                                                        value="terisi otomatis"
                                                                        class="form-control border-0 border-bottom border-dark">
                                                                </div>
                                                            </div>

                                                            <div class="row mb-2">
                                                                <div class="col-md-4">
                                                                    <label class="form-label">No. Identitas</label>
                                                                </div>
                                                                <div class="col-md-1 text-center">:</div>
                                                                <div class="col-md-7">
                                                                    <input type="text" readonly
                                                                        value="terisi otomatis"
                                                                        class="form-control border-0 border-bottom border-dark">
                                                                </div>
                                                            </div>
                                                        </div>


                                                        <!-- B. Barang -->
                                                        <div class="mb-4">
                                                            <h6 class="fw-bold">B. Barang</h6>

                                                            <div class="row mb-2">
                                                                <div class="col-md-4">
                                                                    <label class="form-label">Jumlah/Jenis/No Peti
                                                                        Kemas/Kemasan</label>
                                                                </div>
                                                                <div class="col-md-1 text-center">:</div>
                                                                <div class="col-md-7">
                                                                    <input type="text" readonly
                                                                        value="terisi otomatis"
                                                                        class="form-control border-0 border-bottom border-dark">
                                                                </div>
                                                            </div>

                                                            <div class="row mb-2">
                                                                <div class="col-md-4">
                                                                    <label class="form-label">Jumlah/Jenis Barang</label>
                                                                </div>
                                                                <div class="col-md-1 text-center">:</div>
                                                                <div class="col-md-7">
                                                                    <input type="text" readonly
                                                                        value="terisi otomatis"
                                                                        class="form-control border-0 border-bottom border-dark">
                                                                </div>
                                                            </div>

                                                            <div class="row mb-2">
                                                                <div class="col-md-4">
                                                                    <label class="form-label">Jenis/No dan Tgl
                                                                        Dokumen</label>
                                                                </div>
                                                                <div class="col-md-1 text-center">:</div>
                                                                <div class="col-md-7">
                                                                    <input type="text" readonly
                                                                        value="terisi otomatis"
                                                                        class="form-control border-0 border-bottom border-dark">
                                                                </div>
                                                            </div>

                                                            <div class="row mb-2">
                                                                <div class="col-md-4">
                                                                    <label class="form-label">
                                                                        Pemilik/Importir/Eksportir/Kuasa<span
                                                                            class="text-danger">*</span>
                                                                    </label>
                                                                </div>
                                                                <div class="col-md-1 text-center">:</div>
                                                                <div class="col-md-7">
                                                                    <input type="text" readonly
                                                                        value="terisi otomatis"
                                                                        class="form-control border-0 border-bottom border-dark">
                                                                </div>
                                                            </div>

                                                            <div class="row mb-2">
                                                                <div class="col-md-4">
                                                                    <label class="form-label">No. Identitas</label>
                                                                </div>
                                                                <div class="col-md-1 text-center">:</div>
                                                                <div class="col-md-7">
                                                                    <input type="text" readonly
                                                                        value="terisi otomatis"
                                                                        class="form-control border-0 border-bottom border-dark">
                                                                </div>
                                                            </div>
                                                        </div>


                                                        <!-- C. Orang dan tempat -->
                                                        <div class="mb-4">
                                                            <h6 class="fw-bold">C. Bangunan Atau Tempat</h6>

                                                            <div class="row mb-2">
                                                                <div class="col-md-4">
                                                                    <label class="form-label">Alamat
                                                                        Bangunan/Tempat</label>
                                                                </div>
                                                                <div class="col-md-1 text-center">:</div>
                                                                <div class="col-md-7">
                                                                    <input type="text" readonly
                                                                        value="terisi otomatis"
                                                                        class="form-control border-0 border-bottom border-dark">
                                                                </div>
                                                            </div>

                                                            <div class="row mb-2">
                                                                <div class="col-md-4">
                                                                    <label class="form-label">No Reg Bangunan/NPPBKC/NPWP
                                                                        <span class="text-danger">*</span>
                                                                    </label>
                                                                </div>
                                                                <div class="col-md-1 text-center">:</div>
                                                                <div class="col-md-7">
                                                                    <input type="text" readonly
                                                                        value="terisi otomatis"
                                                                        class="form-control border-0 border-bottom border-dark">
                                                                </div>
                                                            </div>

                                                            <div class="row mb-2">
                                                                <div class="col-md-4">
                                                                    <label class="form-label">Nama Pemilik/Yang Menguasai
                                                                        <span class="text-danger">*</span>
                                                                    </label>
                                                                </div>
                                                                <div class="col-md-1 text-center">:</div>
                                                                <div class="col-md-7">
                                                                    <input type="text" readonly
                                                                        value="terisi otomatis"
                                                                        class="form-control border-0 border-bottom border-dark">
                                                                </div>
                                                            </div>

                                                            <div class="row mb-2">
                                                                <div class="col-md-4">
                                                                    <label class="form-label">No. Identitas</label>
                                                                </div>
                                                                <div class="col-md-1 text-center">:</div>
                                                                <div class="col-md-7">
                                                                    <input type="text" readonly
                                                                        value="terisi otomatis"
                                                                        class="form-control border-0 border-bottom border-dark">
                                                                </div>
                                                            </div>
                                                        </div>


                                                        <!-- Lokasi Pemeriksaan -->
                                                        <div class="mb-4">

                                                            <div class="mb-4">
                                                                <p>
                                                                    Menggunakan segel/tanda pengaman
                                                                    <select
                                                                        class="form-control d-inline border-0 border-bottom border-dark"
                                                                        name="jenis_segel_ba_segel">
                                                                        <option value="" selected disabled>- Pilih -
                                                                        </option>
                                                                        @foreach ($segels as $segel)
                                                                            <option value="{{ $segel->jenis_segel }}">
                                                                                {{ $segel->jenis_segel }}
                                                                            </option>
                                                                        @endforeach
                                                                    </select>
                                                                    sebanyak
                                                                    <input type="text" placeholder="Jumlah Segel"
                                                                        name="jumlah_segel_ba_segel"
                                                                        class="form-control d-inline border-0 border-bottom border-dark"
                                                                        style="width: 100px;">
                                                                    nomor
                                                                    <input type="text" placeholder="Nomor Segel"
                                                                        name="nomor_segel_ba_segel"
                                                                        class="form-control d-inline border-0 border-bottom border-dark"
                                                                        style="width: 80px;">
                                                                    dengan penempatan/pelekatan segel/tanda pengaman pada :
                                                                    <textarea class="form-control border-0" placeholder="Peletakan Segel" name="peletakan_segel_ba_segel"
                                                                        rows="3" style="border-bottom: 1px solid black !important; resize: none;"></textarea>
                                                                </p>

                                                            </div>

                                                            <p>
                                                                Dengan diketahui oleh
                                                                pengangkut/pemilik/penguasa/instansi/ketua lingkungan/dll
                                                                <span class="text-danger">*</span>
                                                            </p>

                                                            <div class="d-flex align-items-center mb-2">
                                                                <span class="me-1">Nama</span>
                                                                <span class="me-2">:</span>
                                                                <input type="text" readonly value="terisi otomatis"
                                                                    class="form-control border-0 border-bottom border-dark flex-grow-1">
                                                            </div>

                                                            <div class="d-flex align-items-center mb-2">
                                                                <span class="me-1">Alamat</span>
                                                                <span class="me-2">:</span>
                                                                <input type="text" readonly value="terisi otomatis"
                                                                    class="form-control border-0 border-bottom border-dark flex-grow-1">
                                                            </div>

                                                            <div class="d-flex align-items-center mb-2">
                                                                <span class="me-1">Pekerjaan</span>
                                                                <span class="me-2">:</span>
                                                                <input type="text" readonly value="terisi otomatis"
                                                                    class="form-control border-0 border-bottom border-dark flex-grow-1">
                                                            </div>

                                                            <div class="d-flex align-items-center mb-2">
                                                                <span class="me-1">Identitas (KTP/SIM/Passport)</span>
                                                                <span class="me-2">:</span>
                                                                <input type="text" readonly value="terisi otomatis"
                                                                    class="form-control border-0 border-bottom border-dark flex-grow-1">
                                                            </div>
                                                        </div>


                                                        <p class="fw-bold">Demikian Berita Acara ini dibuat dengan
                                                            sebenarnya.</p>

                                                        <!-- Tanda Tangan -->
                                                        <div class="row mt-5">
                                                            <div class="col-md-6">
                                                                <div class="text-center">
                                                                    <p>Pemilik/Kuasanya/Saksi*,</p>
                                                                    <div style="height: 80px;"></div>
                                                                    <p>(<input type="text"
                                                                            class="form-control d-inline border-0 border-bottom border-dark text-center"
                                                                            style="width: 150px;"
                                                                            value="terisi otomatis" readonly>)</p>
                                                                    <p>NIP. <input type="text"
                                                                            class="form-control d-inline border-0 border-bottom border-dark"
                                                                            style="width: 120px;"
                                                                            value="terisi otomatis" readonly></p>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="text-center">
                                                                    <p>Pejabat yang melakukan pemeriksaan,</p>
                                                                    <div style="height: 80px;"></div>
                                                                    <p>(<input type="text"
                                                                            class="form-control d-inline border-0 border-bottom border-dark text-center"
                                                                            style="width: 150px;"
                                                                            value="terisi otomatis" readonly>)</p>
                                                                    <p>NIP. <input type="text"
                                                                            class="form-control d-inline border-0 border-bottom border-dark"
                                                                            style="width: 120px;"
                                                                            value="terisi otomatis" readonly></p>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <!-- Keterangan -->
                                                        <div class="mt-4">
                                                            <p><small>*Coret yang tidak perlu</small></p>
                                                            <div class="text-center">
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <div class="tab-pane fade" id="ba-titip" role="tabpanel"
                                    aria-labelledby="ba-titip-tab">
                                    <div class="accordion accordion-flush" id="accordionFlushExample">

                                        <!-- B.A Dokumentasi -->
                                        <div class="accordion-item border rounded">
                                            <div class="d-flex justify-content-between align-items-center p-3 bg-light">
                                                <span class="fw-bold">B.A Titip</span>
                                                <div class="form-check form-switch mb-0">
                                                    <input class="form-check-input status-toggle" type="checkbox"
                                                        role="switch" id="flexSwitchCheck1011"
                                                        data-id="flush-collapse1011" name="ba_titip" value="TIDAK"
                                                        aria-expanded="false" aria-controls="flush-collapse1011">
                                                    <label class="form-check-label" for="flexSwitchCheck1011"
                                                        id="switch-label-1011">TIDAK</label>
                                                </div>
                                            </div>
                                            <hr class="my-0">
                                            <div id="flush-collapse1011" class="accordion-collapse collapse text-black"
                                                data-bs-parent="#accordionFlushExample">
                                                <div class="accordion-body">
                                                    <div class="container mt-4">
                                                        <!-- Header dengan Logo -->
                                                        <div class="row mb-4 align-items-center">
                                                            <div class="col-2 text-center">
                                                                <img src="/images/logocop.png" alt="Logo"
                                                                    class="img-fluid" style="max-height:170px;">
                                                            </div>
                                                            <div class="col-10 text-center">
                                                                <h5 class="mb-0">KEMENTERIAN KEUANGAN REPUBLIK INDONESIA
                                                                </h5>
                                                                <p class="small mb-0">DIREKTORAT JENDERAL BEA DAN CUKAI
                                                                </p>
                                                                <p class="small mb-0">KANTOR PELAYANAN UTAMA BEA DAN CUKAI
                                                                    TIPE B BATAM
                                                                </p>
                                                                <p class="small mb-0">
                                                                    JALAN KUDA LAUT, BATU AMPAR, BATAM, KEPULAUAN RIAU
                                                                    29432;
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

                                                        <hr class="border border-dark border-2">


                                                        <!-- Nomor dan Tanggal -->
                                                        <div class="text-center mb-4">
                                                            <h5 class="fw-bold">BERITA ACARA PENITIPAN</h5>
                                                            <div class="input-group flex-wrap">
                                                                <span class="input-group-text">NOMOR : BA-</span>
                                                                <input type="text" class="form-control"
                                                                    name="no_ba_titip" id="no_ba_titip"
                                                                    value="{{ old('no_ba_titip', $no_ref->no_ba_titip) }}"
                                                                    readonly>
                                                                <span class="input-group-text">/Titip/KPU.206/</span>
                                                                <input type="date" class="form-control"
                                                                    name="tgl_ba_titip">
                                                            </div>
                                                        </div>

                                                        <p class="mb-2">
                                                            <span class="text-danger">*</span> Isian dengan keterangan
                                                            <span class="text-danger">"terisi otomatis"</span> di atas
                                                            berasal dari data sebelumnya yang telah diinput melalui Data
                                                            Penindakan.
                                                        </p>


                                                        <!-- Pembukaan -->
                                                        <div class="mb-4">
                                                            <p>
                                                                Pada hari ini
                                                                <input type="text" readonly value="terisi otomatis"
                                                                    class="form-control d-inline border-0 border-bottom border-dark"
                                                                    style="width: 100px;">
                                                                Berdasarkan Surat Perintah :
                                                                <input type="text" readonly value="terisi otomatis"
                                                                    class="form-control d-inline border-0 border-bottom border-dark"
                                                                    style="width: 100px;">
                                                                tanggal
                                                                <input type="text" readonly value="terisi otomatis"
                                                                    class="form-control d-inline border-0 border-bottom border-dark"
                                                                    style="width: 80px;">
                                                                bulan
                                                                <input type="text" readonly value="terisi otomatis"
                                                                    class="form-control d-inline border-0 border-bottom border-dark"
                                                                    style="width: 80px;">
                                                                tahun
                                                                <input type="text" readonly value="terisi otomatis"
                                                                    class="form-control d-inline border-0 border-bottom border-dark"
                                                                    style="width: 80px;">
                                                                Berdasarkan Surat Perintah :
                                                                <input type="text" readonly value="terisi otomatis"
                                                                    class="form-control d-inline border-0 border-bottom border-dark"
                                                                    style="width: 100px;">
                                                                Nomor
                                                                <input type="text" readonly value="terisi otomatis"
                                                                    class="form-control d-inline border-0 border-bottom border-dark"
                                                                    style="width: 150px;">
                                                                tanggal
                                                                <input type="text" readonly value="terisi otomatis"
                                                                    class="form-control d-inline border-0 border-bottom border-dark"
                                                                    style="width: 100px;">
                                                            </p>




                                                            <p>Kami yang bertanda tangan di bawah ini telah melakukan
                                                                penitipan terhadap:</p>
                                                        </div>

                                                        <!-- A. Sarana Pengangkut -->
                                                        <div class="mb-4">
                                                            <h6 class="fw-bold">A. Sarana Pengangkut</h6>

                                                            <div class="row mb-2">
                                                                <div class="col-md-4">
                                                                    <label class="form-label">Nama dan Jenis
                                                                        Sarkut</label>
                                                                </div>
                                                                <div class="col-md-1 text-center">:</div>
                                                                <div class="col-md-7">
                                                                    <input type="text" readonly
                                                                        value="terisi otomatis"
                                                                        class="form-control border-0 border-bottom border-dark">
                                                                </div>
                                                            </div>

                                                            <div class="row mb-2">
                                                                <div class="col-md-4">
                                                                    <label class="form-label">No Reg./No. Polisi</label>
                                                                </div>
                                                                <div class="col-md-1 text-center">:</div>
                                                                <div class="col-md-7">
                                                                    <input type="text" readonly
                                                                        value="terisi otomatis"
                                                                        class="form-control border-0 border-bottom border-dark">
                                                                </div>
                                                            </div>

                                                            <div class="row mb-2">
                                                                <div class="col-md-4">
                                                                    <label class="form-label">Bendera</label>
                                                                </div>
                                                                <div class="col-md-1 text-center">:</div>
                                                                <div class="col-md-7">
                                                                    <input type="text" readonly
                                                                        value="terisi otomatis"
                                                                        class="form-control border-0 border-bottom border-dark">
                                                                </div>
                                                            </div>

                                                            <div class="row mb-2">
                                                                <div class="col-md-4">
                                                                    <label class="form-label">Nakhoda/Pilot/Pengemudi<span
                                                                            class="text-danger">*</span></label>
                                                                </div>
                                                                <div class="col-md-1 text-center">:</div>
                                                                <div class="col-md-7">
                                                                    <input type="text" readonly
                                                                        value="terisi otomatis"
                                                                        class="form-control border-0 border-bottom border-dark">
                                                                </div>
                                                            </div>

                                                            <div class="row mb-2">
                                                                <div class="col-md-4">
                                                                    <label class="form-label">No. Identitas</label>
                                                                </div>
                                                                <div class="col-md-1 text-center">:</div>
                                                                <div class="col-md-7">
                                                                    <input type="text" readonly
                                                                        value="terisi otomatis"
                                                                        class="form-control border-0 border-bottom border-dark">
                                                                </div>
                                                            </div>
                                                        </div>


                                                        <!-- B. Barang -->
                                                        <div class="mb-4">
                                                            <h6 class="fw-bold">B. Barang</h6>

                                                            <div class="row mb-2">
                                                                <div class="col-md-4">
                                                                    <label class="form-label">Jumlah/Jenis/No Peti
                                                                        Kemas/Kemasan</label>
                                                                </div>
                                                                <div class="col-md-1 text-center">:</div>
                                                                <div class="col-md-7">
                                                                    <input type="text" readonly
                                                                        value="terisi otomatis"
                                                                        class="form-control border-0 border-bottom border-dark">
                                                                </div>
                                                            </div>

                                                            <div class="row mb-2">
                                                                <div class="col-md-4">
                                                                    <label class="form-label">Surat Muatan</label>
                                                                </div>
                                                                <div class="col-md-1 text-center">:</div>
                                                                <div class="col-md-7">
                                                                    <input type="text" readonly
                                                                        value="terisi otomatis"
                                                                        class="form-control border-0 border-bottom border-dark">
                                                                </div>
                                                            </div>

                                                            <div class="row mb-2">
                                                                <div class="col-md-4">
                                                                    <label class="form-label">Jenis/No dan Tgl
                                                                        Dokumen</label>
                                                                </div>
                                                                <div class="col-md-1 text-center">:</div>
                                                                <div class="col-md-7">
                                                                    <input type="text" readonly
                                                                        value="terisi otomatis"
                                                                        class="form-control border-0 border-bottom border-dark">
                                                                </div>
                                                            </div>

                                                            <div class="row mb-2">
                                                                <div class="col-md-4">
                                                                    <label class="form-label">
                                                                        Pemilik/Importir/Eksportir/Kuasa<span
                                                                            class="text-danger">*</span>
                                                                    </label>
                                                                </div>
                                                                <div class="col-md-1 text-center">:</div>
                                                                <div class="col-md-7">
                                                                    <input type="text" readonly
                                                                        value="terisi otomatis"
                                                                        class="form-control border-0 border-bottom border-dark">
                                                                </div>
                                                            </div>

                                                            <div class="row mb-2">
                                                                <div class="col-md-4">
                                                                    <label class="form-label">No. Identitas</label>
                                                                </div>
                                                                <div class="col-md-1 text-center">:</div>
                                                                <div class="col-md-7">
                                                                    <input type="text" readonly
                                                                        value="terisi otomatis"
                                                                        class="form-control border-0 border-bottom border-dark">
                                                                </div>
                                                            </div>
                                                        </div>


                                                        <!-- C. Orang dan tempat -->
                                                        <div class="mb-4">
                                                            <h6 class="fw-bold">C. Bangunan dan Tempat</h6>

                                                            <div class="row mb-2">
                                                                <div class="col-md-4">
                                                                    <label class="form-label">Alamat
                                                                        Bangunan/Tempat</label>
                                                                </div>
                                                                <div class="col-md-1 text-center">:</div>
                                                                <div class="col-md-7">
                                                                    <input type="text" readonly
                                                                        value="terisi otomatis"
                                                                        class="form-control border-0 border-bottom border-dark">
                                                                </div>
                                                            </div>

                                                            <div class="row mb-2">
                                                                <div class="col-md-4">
                                                                    <label class="form-label">No Reg Bangunan/NPPBKC/NPWP
                                                                        <span class="text-danger">*</span>
                                                                    </label>
                                                                </div>
                                                                <div class="col-md-1 text-center">:</div>
                                                                <div class="col-md-7">
                                                                    <input type="text" readonly
                                                                        value="terisi otomatis"
                                                                        class="form-control border-0 border-bottom border-dark">
                                                                </div>
                                                            </div>

                                                            <div class="row mb-2">
                                                                <div class="col-md-4">
                                                                    <label class="form-label">Nama Pemilik/Yang Menguasai
                                                                        <span class="text-danger">*</span>
                                                                    </label>
                                                                </div>
                                                                <div class="col-md-1 text-center">:</div>
                                                                <div class="col-md-7">
                                                                    <input type="text" readonly
                                                                        value="terisi otomatis"
                                                                        class="form-control border-0 border-bottom border-dark">
                                                                </div>
                                                            </div>

                                                            <div class="row mb-2">
                                                                <div class="col-md-4">
                                                                    <label class="form-label">No. Identitas</label>
                                                                </div>
                                                                <div class="col-md-1 text-center">:</div>
                                                                <div class="col-md-7">
                                                                    <input type="text" readonly
                                                                        value="terisi otomatis"
                                                                        class="form-control border-0 border-bottom border-dark">
                                                                </div>
                                                            </div>
                                                        </div>


                                                        <!-- Lokasi Pemeriksaan -->
                                                        <div class="mb-4">
                                                            <div class="d-flex align-items-center mb-2">
                                                                <span class="me-1">Lokasi Penitipan</span>
                                                                <span class="me-2">:</span>
                                                                <input type="text"
                                                                    placeholder="Diisi dengan Lokasi Penitipan"
                                                                    name="lokasi_penitipan_ba_titip"
                                                                    class="form-control border-0 border-bottom border-dark flex-grow-1">
                                                            </div>

                                                            <p>Dititipkan Kepada pengangkut/pemilik/ atau kuasanya/ketua
                                                                lingkungan /pihak lainnya* :</p>

                                                            <div class="d-flex align-items-center mb-2">
                                                                <span class="me-1">Nama</span>
                                                                <span class="me-2">:</span>
                                                                <input type="text" placeholder="Nama Yang Dititipkan"
                                                                    name="nama_ba_titip"
                                                                    class="form-control border-0 border-bottom border-dark flex-grow-1">
                                                            </div>

                                                            <div class="d-flex align-items-center mb-2">
                                                                <span class="me-1">Alamat</span>
                                                                <span class="me-2">:</span>
                                                                <textarea class="form-control border-0" placeholder="Alamat yang dtitipkan" name="alamat_ba_titip"
                                                                    rows="3" style="border-bottom: 1px solid black !important; resize: none;"></textarea>
                                                            </div>

                                                            <div class="d-flex align-items-center mb-2">
                                                                <span class="me-1">Jabatan</span>
                                                                <span class="me-2">:</span>
                                                                <input type="text"
                                                                    placeholder="Jabatan yang dtitipkan"
                                                                    name="jabatan_ba_titip"
                                                                    class="form-control border-0 border-bottom border-dark flex-grow-1">
                                                            </div>



                                                            <div class="mb-4">
                                                                <p>
                                                                    Sesuai dengan BA Penyegelan Nomor
                                                                    <input type="text" readonly
                                                                        value="terisi otomatis"
                                                                        class="form-control d-inline border-0 border-bottom border-dark"
                                                                        style="width: 100px;">
                                                                    tanggal
                                                                    <input type="text" readonly
                                                                        value="terisi otomatis"
                                                                        class="form-control d-inline border-0 border-bottom border-dark"
                                                                        style="width: 80px;">
                                                                </p>


                                                            </div>

                                                        </div>


                                                        <p class="fw-bold">Demikian Berita Acara ini dibuat dengan
                                                            sebenarnya.</p>

                                                        <!-- Tanda Tangan -->
                                                        <div class="row mt-5">
                                                            <div class="col-md-6">
                                                                <div class="text-center">
                                                                    <p>Orang yang menerima penetapan</p>
                                                                    <div style="height: 80px;"></div>
                                                                    <p>(<input type="text"
                                                                            class="form-control d-inline border-0 border-bottom border-dark text-center"
                                                                            style="width: 150px;"
                                                                            value="terisi otomatis" readonly>)</p>
                                                                    <p>NIP. <input type="text"
                                                                            class="form-control d-inline border-0 border-bottom border-dark"
                                                                            style="width: 120px;"
                                                                            value="terisi otomatis" readonly></p>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="text-center">
                                                                    <p>Pejabat yang melakukan penitipan,</p>
                                                                    <div style="height: 80px;"></div>
                                                                    <p>(<input type="text"
                                                                            class="form-control d-inline border-0 border-bottom border-dark text-center"
                                                                            style="width: 150px;"
                                                                            value="terisi otomatis" readonly>)</p>
                                                                    <p>NIP. <input type="text"
                                                                            class="form-control d-inline border-0 border-bottom border-dark"
                                                                            style="width: 120px;"
                                                                            value="terisi otomatis" readonly></p>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="row mt-5">
                                                            <div class="col-md-6">
                                                                <div class="text-center">
                                                                    <p>Saksi</p>
                                                                    <div style="height: 80px;"></div>
                                                                    <p>(<input type="text"
                                                                            class="form-control d-inline border-0 border-bottom border-dark text-center"
                                                                            style="width: 150px;"
                                                                            value="terisi otomatis" readonly>)</p>
                                                                    <p>NIP. <input type="text"
                                                                            class="form-control d-inline border-0 border-bottom border-dark"
                                                                            style="width: 120px;"
                                                                            value="terisi otomatis" readonly></p>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="text-center">
                                                                    <div style="height: 80px;"></div>
                                                                    <p>(<input type="text"
                                                                            class="form-control d-inline border-0 border-bottom border-dark text-center"
                                                                            style="width: 150px;"
                                                                            value="terisi otomatis" readonly>)</p>
                                                                    <p>NIP. <input type="text"
                                                                            class="form-control d-inline border-0 border-bottom border-dark"
                                                                            style="width: 120px;"
                                                                            value="terisi otomatis" readonly></p>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <!-- Keterangan -->
                                                        <div class="mt-4">
                                                            <p><small>*Coret yang tidak perlu</small></p>
                                                            <div class="text-center">
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="tab-pane fade" id="bpc" role="tabpanel" aria-labelledby="bpc-tab">
                                    <div class="accordion accordion-flush" id="accordionFlushExample">

                                        <!-- B.A Dokumentasi -->
                                        <div class="accordion-item border rounded">
                                            <div class="d-flex justify-content-between align-items-center p-3 bg-light">
                                                <span class="fw-bold">Blokir Pita Cukai</span>
                                                <div class="form-check form-switch mb-0">
                                                    <input class="form-check-input status-toggle" type="checkbox"
                                                        role="switch" id="flexSwitchCheck1022"
                                                        data-id="flush-collapse1022" name="bpc" value="TIDAK"
                                                        aria-expanded="false" aria-controls="flush-collapse1022">
                                                    <label class="form-check-label" for="flexSwitchCheck1022"
                                                        id="switch-label-1022">TIDAK</label>
                                                </div>
                                            </div>
                                            <hr class="my-0">
                                        </div>


                                    </div>
                                </div>

                                <div class="tab-pane fade" id="tolak1" role="tabpanel" aria-labelledby="tolak1">
                                    <div class="accordion accordion-flush" id="accordionFlushExample">

                                        <!-- B.A Tolak Pertama -->
                                        <div class="accordion-item border rounded">
                                            <div class="d-flex justify-content-between align-items-center p-3 bg-light">
                                                <span class="fw-bold">B.A Tolak Pertama </span>
                                                <div class="form-check form-switch mb-0">
                                                    <input class="form-check-input status-toggle" type="checkbox"
                                                        role="switch" id="flexSwitchCheck10114"
                                                        data-id="flush-collapse10114" name="ba_tolak_1" value="TIDAK"
                                                        aria-expanded="false" aria-controls="flush-collapse10114">
                                                    <label class="form-check-label" for="flexSwitchCheck10114"
                                                        id="switch-label-10114">TIDAK</label>
                                                </div>
                                            </div>
                                            <hr class="my-0">
                                            <div id="flush-collapse10114" class="accordion-collapse collapse text-black"
                                                data-bs-parent="#accordionFlushExample">
                                                <div class="accordion-body">
                                                    <div class="container mt-4">
                                                        <!-- Header dengan Logo -->
                                                        <div class="row mb-4 align-items-center">
                                                            <div class="col-2 text-center">
                                                                <img src="/images/logocop.png" alt="Logo"
                                                                    class="img-fluid" style="max-height:170px;">
                                                            </div>
                                                            <div class="col-10 text-center">
                                                                <h5 class="mb-0">KEMENTERIAN KEUANGAN REPUBLIK INDONESIA
                                                                </h5>
                                                                <p class="small mb-0">DIREKTORAT JENDERAL BEA DAN CUKAI
                                                                </p>
                                                                <p class="small mb-0">KANTOR PELAYANAN UTAMA BEA DAN CUKAI
                                                                    TIPE B BATAM
                                                                </p>
                                                                <p class="small mb-0">
                                                                    JALAN KUDA LAUT, BATU AMPAR, BATAM, KEPULAUAN RIAU
                                                                    29432;
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

                                                        <hr class="border border-dark border-2">


                                                        <!-- Nomor dan Tanggal -->
                                                        <div class="text-center mb-4">
                                                            <h5 class="fw-bold">BERITA ACARA PENOLAKAN TANDA TANGAN SURAT
                                                                BUKTI PENINDAKAN</h5>
                                                            <div class="input-group flex-wrap">
                                                                <span class="input-group-text">NOMOR : BA-</span>
                                                                <input type="text" class="form-control"
                                                                    name="no_ba_tolak_1" id="no_ba_tolak_1"
                                                                    value="{{ old('no_ba_tolak_1', $no_ref->no_ba_tolak_1) }}"
                                                                    readonly>
                                                                <span class="input-group-text">/Tolak 1/KPU.206/</span>
                                                                <input type="date" class="form-control"
                                                                    name="tgl_ba_tolak_1">
                                                            </div>
                                                        </div>

                                                        <p class="mb-2">
                                                            <span class="text-danger">*</span> Isian dengan keterangan
                                                            <span class="text-danger">"terisi otomatis"</span> di atas
                                                            berasal dari data sebelumnya yang telah diinput melalui Data
                                                            Penindakan.
                                                        </p>



                                                        <!-- Pembukaan -->
                                                        <div class="mb-4">
                                                            <p>
                                                                Pada hari ini
                                                                <input type="text" readonly value="terisi otomatis"
                                                                    class="form-control d-inline border-0 border-bottom border-dark"
                                                                    style="width: 100px;">
                                                                Berdasarkan surat perintah :
                                                                <input type="text" readonly value="terisi otomatis"
                                                                    class="form-control d-inline border-0 border-bottom border-dark"
                                                                    style="width: 100px;">
                                                                tanggal
                                                                <input type="text" readonly value="terisi otomatis"
                                                                    class="form-control d-inline border-0 border-bottom border-dark"
                                                                    style="width: 80px;">
                                                                bulan
                                                                <input type="text" readonly value="terisi otomatis"
                                                                    class="form-control d-inline border-0 border-bottom border-dark"
                                                                    style="width: 80px;">
                                                                tahun
                                                                <input type="text" readonly value="terisi otomatis"
                                                                    class="form-control d-inline border-0 border-bottom border-dark"
                                                                    style="width: 80px;">
                                                                Berdasarkan Surat Perintah :
                                                                <input type="text" readonly value="terisi otomatis"
                                                                    class="form-control d-inline border-0 border-bottom border-dark"
                                                                    style="width: 100px;">
                                                                Nomor
                                                                <input type="text" readonly value="terisi otomatis"
                                                                    class="form-control d-inline border-0 border-bottom border-dark"
                                                                    style="width: 150px;">
                                                                tanggal
                                                                <input type="text" readonly value="terisi otomatis"
                                                                    class="form-control d-inline border-0 border-bottom border-dark"
                                                                    style="width: 100px;">
                                                            </p>




                                                            <p>Kami yang bertanda tangan di bawah ini menyatakan bahwa
                                                                setelah diberikan Surat Bukti Penindakan <input
                                                                    type="text" readonly value="terisi otomatis"
                                                                    class="form-control d-inline border-0 border-bottom border-dark"
                                                                    style="width: 100px;"> Tanggal <input type="text"
                                                                    readonly value="terisi otomatis"
                                                                    class="form-control d-inline border-0 border-bottom border-dark"
                                                                    style="width: 100px;"></p>
                                                        </div>


                                                        <!-- B. Barang -->
                                                        <div class="mb-4">

                                                            <div class="row mb-2">
                                                                <div class="col-md-4">
                                                                    <label class="form-label">Nama</label>
                                                                </div>
                                                                <div class="col-md-1 text-center">:</div>
                                                                <div class="col-md-7">
                                                                    <input type="text"
                                                                        placeholder="Nama Orang Yang Menolak"
                                                                        name="nama_ba_tolak1"
                                                                        class="form-control border-0 border-bottom border-dark">
                                                                </div>
                                                            </div>

                                                            <div class="row mb-2">
                                                                <div class="col-md-4">
                                                                    <label class="form-label">
                                                                        Tempat/tanggal lahir
                                                                    </label>
                                                                </div>
                                                                <div class="col-md-1 text-center">:</div>
                                                                <div class="col-md-7">
                                                                    <input type="text"
                                                                        placeholder="Tempat Tanggal Lahir"
                                                                        name="ttl_ba_tolak1"
                                                                        class="form-control border-0 border-bottom border-dark">
                                                                </div>
                                                            </div>

                                                            <div class="row mb-2">
                                                                <div class="col-md-4">
                                                                    <label class="form-label">Jenis Kelamin</label>
                                                                </div>
                                                                <div class="col-md-1 text-center">:</div>
                                                                <div class="col-md-7">
                                                                    <select
                                                                        class="form-control border-0 border-bottom border-dark form-select select2"
                                                                        name="jk_ba_tolak1">
                                                                        <option value="" selected disabled>- Pilih -
                                                                        </option>
                                                                        <option value="Laki-laki">
                                                                            Laki-laki</option>
                                                                        <option value="Perempuan">
                                                                            Perempuan</option>
                                                                    </select>
                                                                </div>
                                                            </div>

                                                            <div class="row mb-2">
                                                                <div class="col-md-4">
                                                                    <label class="form-label">Alamat</label>
                                                                </div>
                                                                <div class="col-md-1 text-center">:</div>
                                                                <div class="col-md-7">
                                                                    <textarea class="form-control border-0" placeholder="Alamat" name="alamat_ba_tolak1" rows="3"
                                                                        style="border-bottom: 1px solid black !important; resize: none;"></textarea>
                                                                </div>
                                                            </div>

                                                            <div class="row mb-2">
                                                                <div class="col-md-4">
                                                                    <label class="form-label">Kewarganegaraan</label>
                                                                </div>
                                                                <div class="col-md-1 text-center">:</div>
                                                                <div class="col-md-7">
                                                                    <select
                                                                        class="form-control border-0 border-bottom border-dark form-select select2"
                                                                        name="kewarganegaraan_ba_tolak1">
                                                                        <option value="" disabled
                                                                            {{ old('kewarganegaraan_ba_tolak1') === null ? 'selected' : '' }}>
                                                                            Pilih Kewarganegaraan
                                                                        </option>
                                                                        @foreach ($nama_negara as $benua => $negara)
                                                                            <optgroup label="{{ $benua }}">
                                                                                @foreach ($negara as $item)
                                                                                    <option value="{{ $item->UrEdi }}"
                                                                                        {{ old('kewarganegaraan_ba_tolak1') === $item->UrEdi ? 'selected' : '' }}>
                                                                                        {{ $item->UrEdi }}
                                                                                    </option>
                                                                                @endforeach
                                                                            </optgroup>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                            </div>

                                                            <div class="row mb-2">
                                                                <div class="col-md-4">
                                                                    <label class="form-label">Pekerjaan</label>
                                                                </div>
                                                                <div class="col-md-1 text-center">:</div>
                                                                <div class="col-md-7">
                                                                    <input type="text" placeholder="Pekerjaan"
                                                                        name="pekerjaan_ba_tolak1"
                                                                        class="form-control border-0 border-bottom border-dark">
                                                                </div>
                                                            </div>

                                                            <p>Menolak untuk menandatangani Surat Bukti Penindakan tersebut
                                                                diatas dengan alasan :</p>

                                                            <div class="mb-4">
                                                                <textarea class="form-control border-0" name="alasan_tolak_1" rows="5"
                                                                    style="border-bottom: 1px solid black !important; resize: none;" placeholder="Diisi Alasan Penolakan"></textarea>
                                                            </div>


                                                        </div>



                                                        <p class="fw-bold">Demikian Berita Acara ini dibuat dengan
                                                            sebenarnya.</p>

                                                        <!-- Tanda Tangan -->
                                                        <div class="row mt-5">
                                                            <div class="col-md-6">
                                                                <div class="text-center">
                                                                    <p>Pemilik/Pengangkut/Kuasanya,</p>
                                                                    <div style="height: 80px;"></div>
                                                                    <p>(<input type="text"
                                                                            class="form-control d-inline border-0 border-bottom border-dark text-center"
                                                                            style="width: 150px;"
                                                                            value="terisi otomatis" readonly>)</p>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="text-center">
                                                                    <p>Pejabat yang melakukan pemeriksaan,</p>
                                                                    <div style="height: 80px;"></div>
                                                                    <p>(<input type="text"
                                                                            class="form-control d-inline border-0 border-bottom border-dark text-center"
                                                                            style="width: 150px;"
                                                                            value="terisi otomatis" readonly>)</p>
                                                                    <p>NIP. <input type="text"
                                                                            class="form-control d-inline border-0 border-bottom border-dark"
                                                                            style="width: 120px;"
                                                                            value="terisi otomatis" readonly></p>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <!-- Keterangan -->
                                                        <div class="mt-4">
                                                            <p><small>*Coret yang tidak perlu</small></p>
                                                            <div class="text-center">
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>

                                <div class="tab-pane fade" id="tolak2" role="tabpanel" aria-labelledby="tolak2">
                                    <div class="accordion accordion-flush" id="accordionFlushExample">

                                        <!-- B.A Tolak 2 -->
                                        <div class="accordion-item border rounded">
                                            <div class="d-flex justify-content-between align-items-center p-3 bg-light">
                                                <span class="fw-bold">B.A Tolak Kedua </span>
                                                <div class="form-check form-switch mb-0">
                                                    <input class="form-check-input status-toggle" type="checkbox"
                                                        role="switch" id="flexSwitchCheck101145"
                                                        data-id="flush-collapse101145" name="ba_tolak_1"
                                                        value="TIDAK" aria-expanded="false"
                                                        aria-controls="flush-collapse101145">
                                                    <label class="form-check-label" for="flexSwitchCheck101145"
                                                        id="switch-label-101145">TIDAK</label>
                                                </div>
                                            </div>
                                            <hr class="my-0">
                                            <div id="flush-collapse101145"
                                                class="accordion-collapse collapse text-black"
                                                data-bs-parent="#accordionFlushExample">
                                                <div class="accordion-body">
                                                    <div class="container mt-4">
                                                        <!-- Header dengan Logo -->
                                                        <div class="row mb-4 align-items-center">
                                                            <div class="col-2 text-center">
                                                                <img src="/images/logocop.png" alt="Logo"
                                                                    class="img-fluid" style="max-height:170px;">
                                                            </div>
                                                            <div class="col-10 text-center">
                                                                <h5 class="mb-0">KEMENTERIAN KEUANGAN REPUBLIK INDONESIA
                                                                </h5>
                                                                <p class="small mb-0">DIREKTORAT JENDERAL BEA DAN CUKAI
                                                                </p>
                                                                <p class="small mb-0">KANTOR PELAYANAN UTAMA BEA DAN CUKAI
                                                                    TIPE B BATAM
                                                                </p>
                                                                <p class="small mb-0">
                                                                    JALAN KUDA LAUT, BATU AMPAR, BATAM, KEPULAUAN RIAU
                                                                    29432;
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

                                                        <hr class="border border-dark border-2">


                                                        <!-- Nomor dan Tanggal -->
                                                        <div class="text-center mb-4">
                                                            <h5 class="fw-bold">BERITA ACARA PENOLAKAN TANDA TANGAN
                                                                TERHADAP BERITA ACARA PENOLAKAN TANDA TANGAN SURAT BUKTI
                                                                PENINDAKAN</h5>
                                                            <div class="input-group flex-wrap">
                                                                <span class="input-group-text">NOMOR : BA-</span>
                                                                <input type="text" class="form-control"
                                                                    name="no_ba_tolak_2" id="no_ba_tolak_2"
                                                                    value="{{ old('no_ba_tolak_2', $no_ref->no_ba_tolak_2) }}"
                                                                    readonly>
                                                                <span class="input-group-text">/Tolak 1/KPU.206/</span>
                                                                <input type="date" class="form-control"
                                                                    name="tgl_ba_tolak_2">
                                                            </div>
                                                        </div>

                                                        <p class="mb-2">
                                                            <span class="text-danger">*</span> Isian dengan keterangan
                                                            <span class="text-danger">"terisi otomatis"</span> di atas
                                                            berasal dari data sebelumnya yang telah diinput melalui Data
                                                            Penindakan.
                                                        </p>



                                                        <!-- Pembukaan -->
                                                        <div class="mb-4">
                                                            <p>
                                                                Pada hari ini
                                                                <input type="text" readonly value="terisi otomatis"
                                                                    class="form-control d-inline border-0 border-bottom border-dark"
                                                                    style="width: 100px;">
                                                                Berdasarkan surat perintah :
                                                                <input type="text" readonly value="terisi otomatis"
                                                                    class="form-control d-inline border-0 border-bottom border-dark"
                                                                    style="width: 100px;">
                                                                tanggal
                                                                <input type="text" readonly value="terisi otomatis"
                                                                    class="form-control d-inline border-0 border-bottom border-dark"
                                                                    style="width: 80px;">
                                                                bulan
                                                                <input type="text" readonly value="terisi otomatis"
                                                                    class="form-control d-inline border-0 border-bottom border-dark"
                                                                    style="width: 80px;">
                                                                tahun
                                                                <input type="text" readonly value="terisi otomatis"
                                                                    class="form-control d-inline border-0 border-bottom border-dark"
                                                                    style="width: 80px;">
                                                                Berdasarkan Surat Perintah :
                                                                <input type="text" readonly value="terisi otomatis"
                                                                    class="form-control d-inline border-0 border-bottom border-dark"
                                                                    style="width: 100px;">
                                                                Nomor
                                                                <input type="text" readonly value="terisi otomatis"
                                                                    class="form-control d-inline border-0 border-bottom border-dark"
                                                                    style="width: 150px;">
                                                                tanggal
                                                                <input type="text" readonly value="terisi otomatis"
                                                                    class="form-control d-inline border-0 border-bottom border-dark"
                                                                    style="width: 100px;">
                                                            </p>




                                                            <p>Kami yang bertanda tangan di bawah ini menyatakan bahwa
                                                                setelah diberikan Berita Acara Penolakan Tanda Tangan Surat
                                                                Bukti Penindakan nomor <input type="text" readonly
                                                                    value="terisi otomatis"
                                                                    class="form-control d-inline border-0 border-bottom border-dark"
                                                                    style="width: 100px;"> Tanggal <input type="text"
                                                                    readonly value="terisi otomatis"
                                                                    class="form-control d-inline border-0 border-bottom border-dark"
                                                                    style="width: 100px;"></p>
                                                        </div>


                                                        <div class="mb-4">

                                                            <div class="row mb-2">
                                                                <div class="col-md-4">
                                                                    <label class="form-label">Nama</label>
                                                                </div>
                                                                <div class="col-md-1 text-center">:</div>
                                                                <div class="col-md-7">
                                                                    <input type="text"
                                                                        placeholder="terisi otomatis"
                                                                        class="form-control border-0 border-bottom border-dark" readonly>
                                                                </div>
                                                            </div>

                                                            <div class="row mb-2">
                                                                <div class="col-md-4">
                                                                    <label class="form-label">
                                                                        Tempat/tanggal lahir
                                                                    </label>
                                                                </div>
                                                                <div class="col-md-1 text-center">:</div>
                                                                <div class="col-md-7">
                                                                    <input type="text" readonly
                                                                        value="terisi otomatis"
                                                                        class="form-control border-0 border-bottom border-dark">
                                                                </div>
                                                            </div>

                                                            <div class="row mb-2">
                                                                <div class="col-md-4">
                                                                    <label class="form-label">Jenis Kelamin</label>
                                                                </div>
                                                                <div class="col-md-1 text-center">:</div>
                                                                <div class="col-md-7">
                                                                    <input type="text" readonly
                                                                        value="terisi otomatis"
                                                                        class="form-control border-0 border-bottom border-dark">
                                                                </div>
                                                            </div>

                                                            <div class="row mb-2">
                                                                <div class="col-md-4">
                                                                    <label class="form-label">Alamat</label>
                                                                </div>
                                                                <div class="col-md-1 text-center">:</div>
                                                                <div class="col-md-7">
                                                                    <input type="text" readonly
                                                                        value="terisi otomatis"
                                                                        class="form-control border-0 border-bottom border-dark">
                                                                </div>
                                                            </div>

                                                            <div class="row mb-2">
                                                                <div class="col-md-4">
                                                                    <label class="form-label">Kewarganegaraan</label>
                                                                </div>
                                                                <div class="col-md-1 text-center">:</div>
                                                                <div class="col-md-7">
                                                                    <input type="text" readonly
                                                                        value="terisi otomatis"
                                                                        class="form-control border-0 border-bottom border-dark">
                                                                </div>
                                                            </div>

                                                            <div class="row mb-2">
                                                                <div class="col-md-4">
                                                                    <label class="form-label">Pekerjaan</label>
                                                                </div>
                                                                <div class="col-md-1 text-center">:</div>
                                                                <div class="col-md-7">
                                                                    <input type="text" readonly
                                                                        value="terisi otomatis"
                                                                        class="form-control border-0 border-bottom border-dark">
                                                                </div>
                                                            </div>

                                                            <p>menolak untuk menandatangani Berita Acara Penolakan Tanda
                                                                Tangan Surat Bukti Penindakan tersebut di atas dengan alasan
                                                                :</p>

                                                            <div class="mb-4">
                                                                <textarea class="form-control border-0" name="alasan_tolak_2" rows="5"
                                                                    style="border-bottom: 1px solid black !important; resize: none;" placeholder="Diisi Alasan Penolakan"></textarea>
                                                            </div>

                                                            <p>atau tanpa alasan yang jelas/tidak ada alasan</p>


                                                        </div>



                                                        <p class="fw-bold">Demikian Berita Acara ini dibuat dengan
                                                            sebenarnya.</p>

                                                        <!-- Tanda Tangan -->
                                                        <div class="row mt-5">
                                                            <div class="col-md-6">
                                                                <div class="text-center">
                                                                    <p>Saksi,</p>
                                                                    <div style="height: 80px;"></div>
                                                                    <p>(<input type="text"
                                                                            class="form-control d-inline border-0 border-bottom border-dark text-center" placeholder="Diisi Nama Saksi"
                                                                            style="width: 150px;" name="saksi_ba_tolak2">)</p>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="text-center">
                                                                    <p>Pejabat yang melakukan pemeriksaan,</p>
                                                                    <div style="height: 80px;"></div>
                                                                    <p>(<input type="text"
                                                                            class="form-control d-inline border-0 border-bottom border-dark text-center"
                                                                            style="width: 150px;"
                                                                            value="terisi otomatis" readonly>)</p>
                                                                    <p>NIP. <input type="text"
                                                                            class="form-control d-inline border-0 border-bottom border-dark"
                                                                            style="width: 120px;"
                                                                            value="terisi otomatis" readonly></p>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <!-- Keterangan -->
                                                        <div class="mt-4">
                                                            <p><small>*Coret yang tidak perlu</small></p>
                                                            <div class="text-center">
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div><!-- end row -->
            </div>
            <div class="card-footer d-flex justify-content-end">
                <button type="submit" class="btn btn-primary btn-sm me-2">
                    <i data-feather="save"></i> Simpan Data
                </button>
            </div>
        </div>
        </form>
    </div>
    </div>


    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Input elements from saksi
            const namaSaksiInput = document.getElementById('nama_saksi');
            const noIdentitasSaksiInput = document.getElementById('no_identitas_saksi');
            const ttlSaksiInput = document.querySelector('[name="ttl_saksi"]');
            const jkSaksiSelect = document.querySelector('[name="jk_saksi"]');
            const alamatSaksiInput = document.querySelector('[name="alamat_saksi"]');
            const kewarganegaraanSaksiSelect = document.querySelector('[name="kewarganegaraan_saksi"]');
            const pekerjaanSaksiInput = document.querySelector('[name="pekerjaan_saksi"]');

            // Target elements
            const pengemudiInput = document.getElementById('pengemudi');
            const noIdentitasPengemudiInput = document.getElementById('no_identitas_pengemudi');
            const pemilikInput = document.getElementById('pemilik');
            const noIdentitasPemilikInput = document.getElementById('no_identitas_pemilik');
            const namaPemilikBangunanInput = document.getElementById('nama_pemilik_bangunan');
            const noIdentitasPemilikBangunanInput = document.getElementById('no_identitas_pemilik_bangunan');
            const namaOrangMenolakInput = document.getElementById('nama_orang_menolak');
            const ttlOrangMenolakInput = document.querySelector('[name="ttl_ba_tolak1"]');
            const jkOrangMenolakSelect = document.getElementById('jk_orang_menolak');
            const alamatOrangMenolakInput = document.querySelector('[name="alamat_ba_tolak1"]');
            const kewarganegaraanOrangMenolakSelect = document.getElementById('kewarganegaraan_orang_menolak');
            const pekerjaanOrangMenolakInput = document.querySelector('[name="pekerjaan_ba_tolak1"]');

            // Sync nama saksi to all target name fields
            namaSaksiInput.addEventListener('input', function() {
                if (pengemudiInput) pengemudiInput.value = this.value;
                if (pemilikInput) pemilikInput.value = this.value;
                if (namaPemilikBangunanInput) namaPemilikBangunanInput.value = this.value;
                if (namaOrangMenolakInput) namaOrangMenolakInput.value = this.value;
            });

            // Sync no identitas saksi to all target identity fields
            noIdentitasSaksiInput.addEventListener('input', function() {
                if (noIdentitasPengemudiInput) noIdentitasPengemudiInput.value = this.value;
                if (noIdentitasPemilikInput) noIdentitasPemilikInput.value = this.value;
                if (noIdentitasPemilikBangunanInput) noIdentitasPemilikBangunanInput.value = this.value;
            });

            // Existing field syncs
            if (ttlSaksiInput && ttlOrangMenolakInput) {
                ttlSaksiInput.addEventListener('input', function() {
                    ttlOrangMenolakInput.value = this.value;
                });
            }

            if (alamatSaksiInput && alamatOrangMenolakInput) {
                alamatSaksiInput.addEventListener('input', function() {
                    alamatOrangMenolakInput.value = this.value;
                });
            }

            if (pekerjaanSaksiInput && pekerjaanOrangMenolakInput) {
                pekerjaanSaksiInput.addEventListener('input', function() {
                    pekerjaanOrangMenolakInput.value = this.value;
                });
            }

            // Select2 fields sync
            if (jkSaksiSelect && jkOrangMenolakSelect) {
                $(jkSaksiSelect).on('select2:select', function(e) {
                    const selectedValue = e.params.data.id;
                    $(jkOrangMenolakSelect)
                        .val(selectedValue)
                        .trigger('change.select2');
                });
            }

            if (kewarganegaraanSaksiSelect && kewarganegaraanOrangMenolakSelect) {
                $(kewarganegaraanSaksiSelect).on('select2:select', function(e) {
                    const selectedValue = e.params.data.id;
                    $(kewarganegaraanOrangMenolakSelect)
                        .val(selectedValue)
                        .trigger('change.select2');
                });
            }

            // Initial sync for Select2 fields if needed
            function syncInitialValues() {
                if (jkSaksiSelect && jkOrangMenolakSelect) {
                    const jkValue = $(jkSaksiSelect).val();
                    if (jkValue) {
                        $(jkOrangMenolakSelect)
                            .val(jkValue)
                            .trigger('change.select2');
                    }
                }

                if (kewarganegaraanSaksiSelect && kewarganegaraanOrangMenolakSelect) {
                    const kewarganegaraanValue = $(kewarganegaraanSaksiSelect).val();
                    if (kewarganegaraanValue) {
                        $(kewarganegaraanOrangMenolakSelect)
                            .val(kewarganegaraanValue)
                            .trigger('change.select2');
                    }
                }
            }

            // Run initial sync after a short delay
            setTimeout(syncInitialValues, 100);
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const select = document.getElementById('id_petugas_1_sbp');
            const currentValue = select.value;

            select.addEventListener('change', function(e) {
                if (this.value !== currentValue) {
                    alert('Anda tidak dapat mengubah akun login!');
                    this.value = currentValue;
                }
            });
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const switches = document.querySelectorAll('.status-toggle');

            switches.forEach(switchElement => {
                switchElement.addEventListener('change', function() {
                    const accordionId = this.getAttribute('data-id');
                    const accordionContent = document.getElementById(accordionId);

                    this.value = this.checked ? 'YA' : 'TIDAK';

                    if (accordionContent) {
                        if (this.checked) {
                            accordionContent.classList.add('show');
                        } else {
                            accordionContent.classList.remove('show');
                        }
                    } else {
                        console.warn(`Accordion dengan ID "${accordionId}" tidak ditemukan.`);
                    }
                });
            });
        });
    </script>

    <script>
        const switches = document.querySelectorAll('.status-toggle');

        switches.forEach((switchElement, index) => {
            const label = switchElement.nextElementSibling;

            switchElement.addEventListener('change', function() {
                label.textContent = this.checked ? 'YA' : 'TIDAK';
            });
        });
    </script>

    <script>
        function generateUniqueID() {
            const timestamp = Date.now();
            const randomNum = Math.floor(Math.random() * 1000000);
            return `id_penindakan_${timestamp}_${randomNum}`;
        }

        document.getElementById('id_penindakan').value = generateUniqueID();
    </script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            $('#alasan_penindakan').select2();

            $('#alasan_penindakan').on('select2:select', function(e) {
                const selectedOption = e.params.data.element;
                const jenisPelanggaran = selectedOption.getAttribute("data-jenis");

                console.log("Jenis Pelanggaran Terpilih:", jenisPelanggaran);

                document.getElementById("jenis_pelanggaran").value = jenisPelanggaran ||
                    "Jenis pelanggaran tidak tersedia";
            });
        });
    </script>

    <script>
        document.querySelector('select[name="jenis_segel"]').addEventListener('change', function() {
            const idSegel = this.value;
            if (idSegel) {
                fetch(`/getNomorSegel/${idSegel}`)
                    .then(response => response.json())
                    .then(data => {
                        document.querySelector('input[name="nomor_segel"]').value = data.nomor_segel;
                        document.querySelector('input[name="nomor_segel"]').disabled = false;
                    })
                    .catch(error => console.error('Error:', error));
            } else {
                document.querySelector('input[name="nomor_segel"]').value = '';
                document.querySelector('input[name="nomor_segel"]').disabled = true;
            }
        });
    </script>

    <script>
        function toggleForm(selectedValue, sectionId) {
            const section = document.getElementById(sectionId);
            const inputs = section.querySelectorAll('.form-input');

            if (selectedValue === 'YA') {
                inputs.forEach(input => {
                    input.removeAttribute('disabled');
                    input.classList.add('enabled');
                    input.classList.remove('disabled');
                });
            } else {
                inputs.forEach(input => {
                    input.setAttribute('disabled', 'disabled');
                    input.classList.remove('enabled');
                    input.classList.add('disabled');
                });
            }
        }
    </script>

    <script>
        function addRow(type) {
            const table = document.getElementById(`${type}_table`).querySelector("tbody");
            const row = document.createElement("tr");
            row.innerHTML = `
            <td><input type="text" class="form-control d-inline border-0 border-bottom border-dark"
             name="${type}_uraian_barang[]" /></td>
            <td><input type="number" class="form-control d-inline border-0 border-bottom border-dark"
             name="${type}_jml[]" /></td>
            <td>
            <select name="${type}_kondisi[]" class="form-select select2">
                <option value="Baru">Baru</option>
                <option value="Bekas">Bekas</option>
            </select>
            </td>
            <td><button type="button"
             class="bg-danger text-white btn btn-outline-light px-3 py-1 rounded shadow-sm transition"
             style="transition: all 0.2s ease-in-out;" onmouseover="this.classList.add('shadow'); this.style.transform='scale(1.05)'" onmouseout="this.classList.remove('shadow'); this.style.transform='scale(1)'" onclick="this.parentElement.parentElement.remove()">-</button></td>
        `;
            table.appendChild(row);
        }

        function collectData() {
            const getData = (type) => {
                const uraian = document.getElementsByName(`${type}_uraian_barang[]`);
                const jml = document.getElementsByName(`${type}_jml[]`);
                const kondisi = document.getElementsByName(`${type}_kondisi[]`);

                return Array.from(uraian).map((_, i) => ({
                    uraian_barang: uraian[i].value,
                    jml: parseInt(jml[i].value),
                    kondisi: kondisi[i].value
                }));
            };

            const data = {
                pemberitahuan: getData("pemberitahuan"),
                kedapatan: getData("kedapatan")
            };

            document.getElementById("hasil_pemeriksaan_barang").value = JSON.stringify(data);
        }
    </script>

    <script>
        let imageIndex = 0;

        function addImage() {
            const fileInput = document.getElementById('image-upload');
            const captionInput = document.getElementById('image-caption');

            const file = fileInput.files[0];
            const caption = captionInput.value.trim();

            if (!file || !caption) {
                alert("Silakan pilih gambar dan isi caption.");
                return;
            }

            // Buat preview
            const reader = new FileReader();
            reader.onload = function(e) {
                const previewContainer = document.getElementById('image-preview-container');
                const col = document.createElement('div');
                col.className = 'col-md-3 text-center';
                col.id = `preview-${imageIndex}`;
                col.innerHTML = `
                <img src="${e.target.result}" class="img-fluid rounded mb-2" style="max-height:150px; object-fit:cover;">
                <p class="mb-1"><strong>${caption}</strong></p>
                <button type="button" class="btn btn-danger btn-sm" onclick="removeImage(${imageIndex})">Hapus</button>
            `;
                previewContainer.appendChild(col);
            };
            reader.readAsDataURL(file);

            // Masukkan input file dan caption ke form
            const hiddenFields = document.getElementById('hidden-fields');

            // Buat input file baru (yang asli dan dikenali browser)
            const newFileInput = document.createElement('input');
            newFileInput.type = 'file';
            newFileInput.name = 'dokumentasi_gambar[]';
            newFileInput.style.display = 'none';
            newFileInput.id = `file-${imageIndex}`;

            // Buat DataTransfer dan assign file
            const dt = new DataTransfer();
            dt.items.add(file);
            newFileInput.files = dt.files;
            hiddenFields.appendChild(newFileInput);

            // Buat input caption
            const captionField = document.createElement('input');
            captionField.type = 'hidden';
            captionField.name = 'dokumentasi_caption[]';
            captionField.value = caption;
            captionField.id = `caption-${imageIndex}`;
            hiddenFields.appendChild(captionField);

            // Reset input
            fileInput.value = '';
            captionInput.value = '';

            imageIndex++;
        }

        function removeImage(index) {
            // Hapus preview
            const preview = document.getElementById(`preview-${index}`);
            if (preview) preview.remove();

            // Hapus input tersembunyi
            const caption = document.getElementById(`caption-${index}`);
            if (caption) caption.remove();

            const file = document.getElementById(`file-${index}`);
            if (file) file.remove();
        }
    </script>


    <script>
    document.getElementById("searchTab").addEventListener("keyup", function() {
      let filter = this.value.toLowerCase();
      let tabs = document.querySelectorAll(".nav-item-penindakan");

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


    <style>
        .form-input:disabled {
            background-color: #f0f0f0;
            color: #888888;
            cursor: not-allowed;
        }

        .form-input.enabled {
            background-color: #ffffff;
            color: #000000;
        }


        .form-group.disabled label {
            color: #888888;
        }
    </style>
@endsection
@section('script')
    @vite(['resources/js/pages/datatable.init.js'])
@endsection
