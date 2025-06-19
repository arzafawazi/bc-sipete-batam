@extends('layouts.vertical', ['title' => 'Edit Form Penindakan'])

@section('css')
    @vite(['node_modules/datatables.net-bs5/css/dataTables.bootstrap5.min.css', 'node_modules/datatables.net-buttons-bs5/css/buttons.bootstrap5.min.css', 'node_modules/datatables.net-keytable-bs5/css/keyTable.bootstrap5.min.css', 'node_modules/datatables.net-responsive-bs5/css/responsive.bootstrap5.min.css', 'node_modules/datatables.net-select-bs5/css/select.bootstrap5.min.css'])
@endsection


@section('content')
    <div class="container-fluid">
        <div class="card mb-3 mt-4">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="card-title mb-0">
                    <i data-feather="book" style="width: 20px; height: 20px;" class="me-1"></i>
                    Form Edit Penindakan
                </h5>
                <button type="button" class="btn btn-danger btn-sm" onclick="window.history.back()">
                    <i data-feather="log-out"></i> Kembali
                </button>
            </div>

            <div class="card-body">
                <form action="{{ route('penindakan.update', ['penindakan' => $penindakans->id]) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="card">

                        <div class="row">
                            <div class="tabs-container" id="tabs-container">
                                <ul class="nav nav-pills nav-justified flex-nowrap overflow-auto mb-3"
                                    style="white-space: nowrap;" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" id="penindakan-tab" data-bs-toggle="pill"
                                            href="#penindakan" role="tab" aria-controls="penindakan"
                                            aria-selected="true">
                                            <span class="d-block d-sm-none">Data Penindakan</span>
                                            <span class="d-none d-sm-block">Data Penindakan</span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="ba-henti-tab" data-bs-toggle="pill" href="#ba-henti"
                                            role="tab" aria-controls="ba-henti" aria-selected="false">
                                            <span class="d-block d-sm-none">Penghentian</span>
                                            <span class="d-none d-sm-block">Penghentian</span>
                                        </a>
                                    </li>

                                    <li class="nav-item">
                                        <a class="nav-link" id="ba-riksa-tab" data-bs-toggle="pill" href="#ba-riksa"
                                            role="tab" aria-controls="ba-riksa" aria-selected="false">
                                            <span class="d-block d-sm-none">Pemeriksaan</span>
                                            <span class="d-none d-sm-block">Pemeriksaan</span>
                                        </a>
                                    </li>

                                    <li class="nav-item">
                                        <a class="nav-link" id="ba-sarkut-tab" data-bs-toggle="pill" href="#ba-sarkut"
                                            role="tab" aria-controls="ba-sarkut" aria-selected="false">
                                            <span class="d-block d-sm-none">(B.A Sarkut)</span>
                                            <span class="d-none d-sm-block">B.A Sarkut</span>
                                        </a>
                                    </li>

                                    <li class="nav-item">
                                        <a class="nav-link" id="ba-contoh-tab" data-bs-toggle="pill" href="#ba-contoh"
                                            role="tab" aria-controls="ba-contoh" aria-selected="false">
                                            <span class="d-block d-sm-none">(B.A Contoh)</span>
                                            <span class="d-none d-sm-block">B.A Contoh</span>
                                        </a>
                                    </li>

                                    <li class="nav-item">
                                        <a class="nav-link" id="ba-dok-tab" data-bs-toggle="pill" href="#ba-dok"
                                            role="tab" aria-controls="ba-dok" aria-selected="false">
                                            <span class="d-block d-sm-none">(B.A DOK)</span>
                                            <span class="d-none d-sm-block">B.A Dokumentasi</span>
                                        </a>
                                    </li>

                                    <li class="nav-item">
                                        <a class="nav-link" id="ba-tegah-tab" data-bs-toggle="pill" href="#ba-tegah"
                                            role="tab" aria-controls="ba-tegah" aria-selected="false">
                                            <span class="d-block d-sm-none">(B.A Tegah)</span>
                                            <span class="d-none d-sm-block">B.A Tegah</span>
                                        </a>
                                    </li>

                                    <li class="nav-item">
                                        <a class="nav-link" id="ba-segel-tab" data-bs-toggle="pill" href="#ba-segel"
                                            role="tab" aria-controls="ba-segel" aria-selected="false">
                                            <span class="d-block d-sm-none">(B.A Segel)</span>
                                            <span class="d-none d-sm-block">B.A Segel</span>
                                        </a>
                                    </li>

                                    <li class="nav-item">
                                        <a class="nav-link" id="ba-titip-tab" data-bs-toggle="pill" href="#ba-titip"
                                            role="tab" aria-controls="ba-titip" aria-selected="false">
                                            <span class="d-block d-sm-none">(B.A Titip)</span>
                                            <span class="d-none d-sm-block">B.A Titip</span>
                                        </a>
                                    </li>

                                    <li class="nav-item">
                                        <a class="nav-link" id="bpc-tab" data-bs-toggle="pill" href="#bpc"
                                            role="tab" aria-controls="bpc" aria-selected="false">
                                            <span class="d-block d-sm-none">(BPC)</span>
                                            <span class="d-none d-sm-block">Blokir Pita Cukai</span>
                                        </a>
                                    </li>

                                    <li class="nav-item">
                                        <a class="nav-link" id="tolak1-tab" data-bs-toggle="pill" href="#tolak1"
                                            role="tab" aria-controls="tolak1" aria-selected="false">
                                            <span class="d-block d-sm-none">(B.A Tolak 1)</span>
                                            <span class="d-none d-sm-block">B.A Tolak Pertama</span>
                                        </a>
                                    </li>

                                    <li class="nav-item">
                                        <a class="nav-link" id="tolak2-tab" data-bs-toggle="pill" href="#tolak2"
                                            role="tab" aria-controls="tolak2" aria-selected="false">
                                            <span class="d-block d-sm-none">(B.A Tolak 2)</span>
                                            <span class="d-none d-sm-block">B.A Tolak Kedua</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>


                            <div class="tab-content p-0 text-muted mt-md-0" id="v-pills-tabContent">


                                <div class="container-fluid p-4 tab-pane fade show active text-black" id="penindakan"
                                    role="tabpanel" aria-labelledby="penindakan-tab">
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
                                                value="{{ old('no_sbp', $penindakans->no_sbp) }}" readonly>
                                            <input type="date" class="form-control" name="tgl_sbp"
                                                value="{{ old('tgl_sbp', $penindakans->tgl_sbp) }}">
                                        </div>
                                    </div>



                                    <!-- Section 1: Data Referensi -->
                                    <div class="form-section">
                                        <div class="section-header">1. Data Referensi</div>
                                        <div class="p-3">
                                            <div class="row field-row">
                                                <div class="col-md-12">
                                                    <label class="fw-bold">Opsi Penindakan:</label>
                                                    <input type="text" class="form-control bg-primary text-white"
                                                        name="opsi_penindakan"
                                                        value="{{ old('opsi_penindakan', $penindakans->opsi_penindakan) }}"
                                                        readonly>
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
                                                                {{ old('id_petugas_1_sbp', $penindakans->id_petugas_1_sbp) == $user->id_admin ? 'selected' : '' }}
                                                                {{ old('id_petugas_1_sbp', $penindakans->id_petugas_1_sbp) != $user->id_admin ? 'disabled' : '' }}>
                                                                {{ $user->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-md-6">
                                                    <label class="fw-bold">Pejabat 2 Penindakan:</label>
                                                    <select class="form-select select2" name="id_petugas_2_sbp">
                                                        <option value="" disabled>- Pilih -</option>
                                                        @foreach ($users as $user)
                                                            <option value="{{ $user->id_admin }}"
                                                                {{ old('id_petugas_2_sbp', $penindakans->id_petugas_2_sbp) == $user->id_admin ? 'selected' : '' }}>
                                                                {{ $user->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="row field-row">
                                                <div class="col-md-6">
                                                    <label class="fw-bold">Pejabat 3 Penindakan:</label>
                                                    <select class="form-select select2" name="id_petugas_3_sbp">
                                                        <option value="" disabled>- Pilih -</option>
                                                        @foreach ($users as $user)
                                                            <option value="{{ $user->id_admin }}"
                                                                {{ old('id_petugas_3_sbp', $penindakans->id_petugas_3_sbp) == $user->id_admin ? 'selected' : '' }}>
                                                                {{ $user->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-md-6">
                                                    <label class="fw-bold">Pejabat 4 Penindakan:</label>
                                                    <select class="form-select select2" name="id_petugas_4_sbp">
                                                        <option value="" disabled>- Pilih -</option>
                                                        @foreach ($users as $user)
                                                            <option value="{{ $user->id_admin }}"
                                                                {{ old('id_petugas_4_sbp', $penindakans->id_petugas_4_sbp) == $user->id_admin ? 'selected' : '' }}>
                                                                {{ $user->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                    <!-- Section 3: Data Lokasi dan Waktu -->
                                    <!-- Section 3: Lokasi Penindakan -->
                                    <div class="form-section">
                                        <div class="section-header">3. Lokasi Penindakan</div>
                                        <div class="p-3">
                                            <div class="field-row">
                                                <label class="fw-bold">Lokasi Penindakan:</label>
                                                <input type="text" class="form-control mt-2" name="lokasi_penindakan"
                                                    value="{{ old('lokasi_penindakan', $penindakans->lokasi_penindakan) }}"
                                                    placeholder="Alamat lengkap lokasi penindakan">
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
                                                        id="datetime-datepicker"
                                                        value="{{ old('tgl_mulai', $penindakans->tgl_mulai) }}"
                                                        placeholder="dd/mm/yyyy HH:mm">
                                                </div>
                                                <div class="col-md-6">
                                                    <label class="fw-bold">Tanggal & Waktu Selesai:</label>
                                                    <input type="text" class="form-control" name="tgl_selesai"
                                                        id="datetime-datepicker"
                                                        value="{{ old('tgl_selesai', $penindakans->tgl_selesai) }}"
                                                        placeholder="dd/mm/yyyy HH:mm">
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
                                                <select class="form-control select2" name="alasan_penindakan"
                                                    id="alasan_penindakan">
                                                    <option value="" disabled
                                                        {{ old('alasan_penindakan', $penindakans->alasan_penindakan) ? '' : 'selected' }}>
                                                        Pilih Alasan Penindakan
                                                    </option>
                                                    @foreach ($jenisPelanggaran->unique('alasan_penindakan') as $jenis)
                                                        @php
                                                            $optionValue =
                                                                $jenis->alasan_penindakan .
                                                                ' (' .
                                                                $jenis->jenis_pelanggaran .
                                                                ')';
                                                        @endphp
                                                        <option value="{{ $optionValue }}"
                                                            data-jenis="{{ $jenis->jenis_pelanggaran }}"
                                                            {{ old('alasan_penindakan', $penindakans->alasan_penindakan) == $optionValue ? 'selected' : '' }}>
                                                            {{ $jenis->alasan_penindakan }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="field-row mt-3">
                                                <label class="fw-bold">Jenis Pelanggaran:</label>
                                                <textarea class="form-control bg-light mt-2" rows="3" id="jenis_pelanggaran" readonly>{{ old('jenis_pelanggaran', $penindakans->jenis_pelanggaran) }}</textarea>
                                            </div>
                                        </div>
                                    </div>


                                    <!-- Section 6: Uraian Penindakan -->
                                    <!-- Section 6: Uraian Penindakan -->
                                    <div class="form-section">
                                        <div class="section-header">6. Uraian Penindakan</div>
                                        <div class="p-3">
                                            <textarea class="form-control" name="uraian_penindakan" rows="5"
                                                placeholder="Uraian lengkap penindakan yang dilakukan">{{ old('uraian_penindakan', $penindakans->uraian_penindakan) }}</textarea>
                                        </div>
                                    </div>

                                    <!-- Section 7: Hal Yang Terjadi -->
                                    <div class="form-section">
                                        <div class="section-header">7. Hal Yang Terjadi</div>
                                        <div class="p-3">
                                            <textarea class="form-control" name="hal_yang_terjadi" rows="5"
                                                placeholder="Kronologi kejadian yang ditemukan">{{ old('hal_yang_terjadi', $penindakans->hal_yang_terjadi) }}</textarea>
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
                                                        name="nama_saksi"
                                                        value="{{ old('nama_saksi', $penindakans->nama_saksi) }}"
                                                        placeholder="Nama lengkap saksi">
                                                </div>
                                                <div class="col-md-6">
                                                    <label class="fw-bold">Pekerjaan:</label>
                                                    <input type="text" class="form-control" name="pekerjaan_saksi"
                                                        value="{{ old('pekerjaan_saksi', $penindakans->pekerjaan_saksi) }}"
                                                        placeholder="Pekerjaan saksi">
                                                </div>
                                            </div>

                                            <div class="row field-row">
                                                <div class="col-md-6">
                                                    <label class="fw-bold">No. Identitas:</label>
                                                    <input type="text" class="form-control" id="no_identitas_saksi"
                                                        name="no_identitas_saksi"
                                                        value="{{ old('no_identitas_saksi', $penindakans->no_identitas_saksi) }}"
                                                        placeholder="Nomor KTP/SIM/Paspor">
                                                </div>
                                                <div class="col-md-6">
                                                    <label class="fw-bold">Jenis Identitas:</label>
                                                    <input type="text" class="form-control" name="jenis_iden_saksi"
                                                        value="{{ old('jenis_iden_saksi', $penindakans->jenis_iden_saksi) }}"
                                                        placeholder="KTP/SIM/Paspor">
                                                </div>
                                            </div>

                                            <div class="row field-row">
                                                <div class="col-md-12">
                                                    <label class="fw-bold">Alamat:</label>
                                                    <input type="text" class="form-control" name="alamat_saksi"
                                                        value="{{ old('alamat_saksi', $penindakans->alamat_saksi) }}"
                                                        placeholder="Alamat lengkap saksi">
                                                </div>
                                            </div>

                                            <div class="row field-row">
                                                <div class="col-md-4">
                                                    <label class="fw-bold">Jenis Kelamin:</label>
                                                    <select class="form-control select2" name="jk_saksi">
                                                        <option value="">Pilih</option>
                                                        <option value="Laki-laki"
                                                            {{ old('jk_saksi', $penindakans->jk_saksi) == 'Laki-laki' ? 'selected' : '' }}>
                                                            Laki-laki</option>
                                                        <option value="Perempuan"
                                                            {{ old('jk_saksi', $penindakans->jk_saksi) == 'Perempuan' ? 'selected' : '' }}>
                                                            Perempuan</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-4">
                                                    <label class="fw-bold">Tempat, Tanggal Lahir:</label>
                                                    <input type="text" class="form-control" name="ttl_saksi"
                                                        value="{{ old('ttl_saksi', $penindakans->ttl_saksi) }}"
                                                        placeholder="Jakarta, 01 Januari 1990">
                                                </div>
                                                <div class="col-md-4">
                                                    <label class="fw-bold">Umur:</label>
                                                    <input type="number" class="form-control" name="umur_saksi"
                                                        value="{{ old('umur_saksi', $penindakans->umur_saksi) }}"
                                                        placeholder="Tahun">
                                                </div>
                                            </div>

                                            <div class="row field-row">
                                                <div class="col-md-6">
                                                    <label class="fw-bold">Kewarganegaraan:</label>
                                                    <select class="form-control form-input select2"
                                                        name="kewarganegaraan_saksi">
                                                        <option value="" disabled
                                                            {{ old('kewarganegaraan_saksi', $penindakans->kewarganegaraan_saksi) ? '' : 'selected' }}>
                                                            - Pilih Kewarganegaraan -
                                                        </option>
                                                        @foreach ($nama_negara as $benua => $negara)
                                                            <optgroup label="{{ $benua }}">
                                                                @foreach ($negara as $item)
                                                                    <option value="{{ $item->UrEdi }}"
                                                                        {{ old('kewarganegaraan_saksi', $penindakans->kewarganegaraan_saksi) == $item->UrEdi ? 'selected' : '' }}>
                                                                        {{ $item->UrEdi }}
                                                                    </option>
                                                                @endforeach
                                                            </optgroup>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-md-6">
                                                    <label class="fw-bold">No. HP:</label>
                                                    <input type="text" class="form-control" name="kontak_saksi"
                                                        value="{{ old('kontak_saksi', $penindakans->kontak_saksi) }}"
                                                        placeholder="08xxxxxxxxxx">
                                                </div>
                                            </div>

                                            <div class="row field-row">
                                                <div class="col-md-6">
                                                    <label class="fw-bold">NPWP:</label>
                                                    <input type="text" class="form-control" name="npwp_saksi"
                                                        value="{{ old('npwp_saksi', $penindakans->npwp_saksi) }}"
                                                        placeholder="XX.XXX.XXX.X-XXX.XXX">
                                                </div>
                                                <div class="col-md-6">
                                                    <label class="fw-bold">Nomor Rekening:</label>
                                                    <input type="text" class="form-control" name="norek_saksi"
                                                        value="{{ old('norek_saksi', $penindakans->norek_saksi) }}"
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
                                                                            <option value="TIDAK"
                                                                                {{ old('data_sarkut', $penindakans->data_sarkut) == 'TIDAK' ? 'selected' : '' }}>
                                                                                TIDAK</option>
                                                                            <option value="YA"
                                                                                {{ old('data_sarkut', $penindakans->data_sarkut) == 'YA' ? 'selected' : '' }}>
                                                                                YA</option>
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
                                                                                value="{{ old('nama_jenis_sarkut', $penindakans->nama_jenis_sarkut) }}"
                                                                                placeholder="Nama Sarkut"
                                                                                {{ old('data_sarkut', $penindakans->data_sarkut) == 'YA' ? '' : 'disabled' }}>
                                                                        </div>
                                                                        <div class="col-md-6">
                                                                            <label class="form-label fw-semibold">Jenis
                                                                                Sarana</label>
                                                                            <input type="text"
                                                                                class="form-control form-input"
                                                                                name="jenis_sarkut"
                                                                                value="{{ old('jenis_sarkut', $penindakans->jenis_sarkut) }}"
                                                                                placeholder="Masukkan jenis sarana"
                                                                                {{ old('data_sarkut', $penindakans->data_sarkut) == 'YA' ? '' : 'disabled' }}>
                                                                        </div>
                                                                    </div>

                                                                    <div class="row mb-3">
                                                                        <div class="col-md-6">
                                                                            <label class="form-label fw-semibold">No.
                                                                                Voy/Penerbangan/Trayek</label>
                                                                            <input type="text"
                                                                                class="form-control form-input"
                                                                                name="no_flight"
                                                                                value="{{ old('no_flight', $penindakans->no_flight) }}"
                                                                                placeholder="Masukkan nomor voyage/penerbangan/trayek"
                                                                                {{ old('data_sarkut', $penindakans->data_sarkut) == 'YA' ? '' : 'disabled' }}>
                                                                        </div>
                                                                        <div class="col-md-6">
                                                                            <label
                                                                                class="form-label fw-semibold">Ukuran/Kapasitas</label>
                                                                            <input type="text"
                                                                                class="form-control form-input"
                                                                                name="kapasitas_muatan"
                                                                                value="{{ old('kapasitas_muatan', $penindakans->kapasitas_muatan) }}"
                                                                                placeholder="Masukkan ukuran/kapasitas muatan"
                                                                                {{ old('data_sarkut', $penindakans->data_sarkut) == 'YA' ? '' : 'disabled' }}>
                                                                        </div>
                                                                    </div>

                                                                    <div class="row mb-3">
                                                                        <div class="col-md-6">
                                                                            <label
                                                                                class="form-label fw-semibold">Nahkoda/Pilot/Pengemudi</label>
                                                                            <input type="text"
                                                                                class="form-control form-input"
                                                                                name="pengemudi" id="pengemudi"
                                                                                value="{{ old('pengemudi', $penindakans->pengemudi) }}"
                                                                                placeholder="Masukkan nama nahkoda/pilot/pengemudi"
                                                                                {{ old('data_sarkut', $penindakans->data_sarkut) == 'YA' ? '' : 'disabled' }}>
                                                                        </div>
                                                                        <div class="col-md-6">
                                                                            <label class="form-label fw-semibold">No.
                                                                                Identitas</label>
                                                                            <input type="text"
                                                                                class="form-control form-input"
                                                                                name="no_identitas_pengemudi"
                                                                                id="no_identitas_pengemudi"
                                                                                value="{{ old('no_identitas_pengemudi', $penindakans->no_identitas_pengemudi) }}"
                                                                                placeholder="Masukkan nomor identitas"
                                                                                {{ old('data_sarkut', $penindakans->data_sarkut) == 'YA' ? '' : 'disabled' }}>
                                                                        </div>
                                                                    </div>

                                                                    <div class="row mb-3">
                                                                        <div class="col-md-6">
                                                                            <label
                                                                                class="form-label fw-semibold">Bendera</label>
                                                                            <input type="text"
                                                                                class="form-control form-input"
                                                                                name="bendera"
                                                                                value="{{ old('bendera', $penindakans->bendera) }}"
                                                                                placeholder="Masukkan bendera"
                                                                                {{ old('data_sarkut', $penindakans->data_sarkut) == 'YA' ? '' : 'disabled' }}>
                                                                        </div>
                                                                        <div class="col-md-6">
                                                                            <label class="form-label fw-semibold">No.
                                                                                Registrasi/Polisi</label>
                                                                            <input type="text"
                                                                                class="form-control form-input"
                                                                                name="no_polisi"
                                                                                value="{{ old('no_polisi', $penindakans->no_polisi) }}"
                                                                                placeholder="Masukkan nomor registrasi/polisi"
                                                                                {{ old('data_sarkut', $penindakans->data_sarkut) == 'YA' ? '' : 'disabled' }}>
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
                                                                            <option value="TIDAK"
                                                                                {{ old('data_barang', $penindakans->data_barang) == 'TIDAK' ? 'selected' : '' }}>
                                                                                TIDAK</option>
                                                                            <option value="YA"
                                                                                {{ old('data_barang', $penindakans->data_barang) == 'YA' ? 'selected' : '' }}>
                                                                                YA</option>
                                                                        </select>
                                                                    </div>
                                                                </div>

                                                                <!-- Form Fields -->
                                                                <div id="barang-fields">
                                                                    <div class="mb-3">
                                                                        <label
                                                                            class="form-label fw-semibold">Jumlah/Jenis/Ukuran/Nomor</label>
                                                                        <textarea class="form-control form-input " placeholder="Jumlah/Jenis/Ukuran/Nomor" name="jumlah_jenis_ukuran_no"
                                                                            rows="3" {{ old('data_barang', $penindakans->data_barang) == 'YA' ? '' : 'disabled' }}>{{ old('jumlah_jenis_ukuran_no', $penindakans->jumlah_jenis_ukuran_no) }}</textarea>
                                                                    </div>

                                                                    <div class="row mb-3">
                                                                        <div class="col-md-6">
                                                                            <label
                                                                                class="form-label fw-semibold">Kemasan</label>
                                                                            <select
                                                                                class="form-select form-control form-input"
                                                                                name="id_kemasan"
                                                                                {{ old('data_barang', $penindakans->data_barang) == 'YA' ? '' : 'disabled' }}>
                                                                                <option value="">- Pilih Kemasan -
                                                                                </option>
                                                                                <option value="Kardus"
                                                                                    {{ old('id_kemasan', $penindakans->id_kemasan) == 'Kardus' ? 'selected' : '' }}>
                                                                                    Kardus</option>
                                                                                <option value="Plastik"
                                                                                    {{ old('id_kemasan', $penindakans->id_kemasan) == 'Plastik' ? 'selected' : '' }}>
                                                                                    Plastik</option>
                                                                                <option value="Kayu"
                                                                                    {{ old('id_kemasan', $penindakans->id_kemasan) == 'Kayu' ? 'selected' : '' }}>
                                                                                    Kayu</option>
                                                                                <option value="Metal"
                                                                                    {{ old('id_kemasan', $penindakans->id_kemasan) == 'Metal' ? 'selected' : '' }}>
                                                                                    Metal</option>
                                                                            </select>
                                                                        </div>
                                                                        <div class="col-md-6">
                                                                            <label class="form-label fw-semibold">Jumlah
                                                                                Barang</label>
                                                                            <input type="number"
                                                                                class="form-control form-input"
                                                                                name="jumlah_barang"
                                                                                placeholder="Masukkan jumlah barang"
                                                                                value="{{ old('jumlah_barang', $penindakans->jumlah_barang) }}"
                                                                                {{ old('data_barang', $penindakans->data_barang) == 'YA' ? '' : 'disabled' }}>
                                                                        </div>
                                                                    </div>

                                                                    <div class="mb-3">
                                                                        <label class="form-label fw-semibold">Uraian
                                                                            Barang</label>
                                                                        <textarea class="form-control form-input" name="jenis_barang" rows="2"
                                                                            placeholder="Masukkan uraian detail barang"
                                                                            {{ old('data_barang', $penindakans->data_barang) == 'YA' ? '' : 'disabled' }}>{{ old('jenis_barang', $penindakans->jenis_barang) }}</textarea>
                                                                    </div>

                                                                    <div class="row mb-3">
                                                                        <div class="col-md-6">
                                                                            <label class="form-label fw-semibold">Jenis/No.
                                                                                Dokumen</label>
                                                                            <input type="text"
                                                                                class="form-control form-input"
                                                                                name="jenis_no_tgl_dok"
                                                                                placeholder="Masukkan jenis/nomor dokumen"
                                                                                value="{{ old('jenis_no_tgl_dok', $penindakans->jenis_no_tgl_dok) }}"
                                                                                {{ old('data_barang', $penindakans->data_barang) == 'YA' ? '' : 'disabled' }}>
                                                                        </div>
                                                                        <div class="col-md-6">
                                                                            <label class="form-label fw-semibold">Tgl.
                                                                                Dokumen</label>
                                                                            <input type="date"
                                                                                class="form-control form-input"
                                                                                name="tgl_dokumen"
                                                                                value="{{ old('tgl_dokumen', $penindakans->tgl_dokumen) }}"
                                                                                {{ old('data_barang', $penindakans->data_barang) == 'YA' ? '' : 'disabled' }}>
                                                                        </div>
                                                                    </div>

                                                                    <div class="row mb-3">
                                                                        <div class="col-md-6">
                                                                            <label class="form-label fw-semibold">Masa
                                                                                Berlaku Dokumen</label>
                                                                            <input type="date"
                                                                                class="form-control form-input"
                                                                                name="masa_berlaku_dokumen"
                                                                                value="{{ old('masa_berlaku_dokumen', $penindakans->masa_berlaku_dokumen) }}"
                                                                                {{ old('data_barang', $penindakans->data_barang) == 'YA' ? '' : 'disabled' }}>
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
                                                                                value="{{ old('pemilik', $penindakans->pemilik) }}"
                                                                                {{ old('data_barang', $penindakans->data_barang) == 'YA' ? '' : 'disabled' }}>
                                                                        </div>
                                                                        <div class="col-md-6">
                                                                            <label class="form-label fw-semibold">No.
                                                                                Identitas</label>
                                                                            <input type="text"
                                                                                class="form-control form-input"
                                                                                name="no_identitas_pemilik"
                                                                                id="no_identitas_pemilik"
                                                                                placeholder="Masukkan nomor identitas"
                                                                                value="{{ old('no_identitas_pemilik', $penindakans->no_identitas_pemilik) }}"
                                                                                {{ old('data_barang', $penindakans->data_barang) == 'YA' ? '' : 'disabled' }}>
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
                                                                            <option value="TIDAK"
                                                                                {{ old('data_bangunan', $penindakans->data_bangunan) == 'TIDAK' ? 'selected' : '' }}>
                                                                                TIDAK</option>
                                                                            <option value="YA"
                                                                                {{ old('data_bangunan', $penindakans->data_bangunan) == 'YA' ? 'selected' : '' }}>
                                                                                YA</option>
                                                                        </select>
                                                                    </div>
                                                                </div>

                                                                <!-- Form Fields -->
                                                                <div id="bangunan-fields">
                                                                    <div class="mb-3">
                                                                        <label class="form-label fw-semibold">Alamat
                                                                            Bangunan/Tempat</label>
                                                                        <textarea class="form-control form-input" name="alamat_bangunan" rows="2"
                                                                            placeholder="Masukkan alamat lengkap bangunan/tempat"
                                                                            {{ old('data_bangunan', $penindakans->data_bangunan) == 'YA' ? '' : 'disabled' }}>{{ old('alamat_bangunan', $penindakans->alamat_bangunan) }}</textarea>
                                                                    </div>

                                                                    <div class="mb-3">
                                                                        <label class="form-label fw-semibold">No. Reg
                                                                            Bangunan/NPPBKC</label>
                                                                        <input type="text"
                                                                            class="form-control form-input"
                                                                            name="no_bangunan"
                                                                            placeholder="Masukkan nomor registrasi bangunan/NPPBKC"
                                                                            value="{{ old('no_bangunan', $penindakans->no_bangunan) }}"
                                                                            {{ old('data_bangunan', $penindakans->data_bangunan) == 'YA' ? '' : 'disabled' }}>
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
                                                                                value="{{ old('nama_pemilik_bangunan', $penindakans->nama_pemilik_bangunan) }}"
                                                                                {{ old('data_bangunan', $penindakans->data_bangunan) == 'YA' ? '' : 'disabled' }}>
                                                                        </div>
                                                                        <div class="col-md-6">
                                                                            <label class="form-label fw-semibold">No.
                                                                                Identitas</label>
                                                                            <input type="text"
                                                                                class="form-control form-input"
                                                                                name="no_identitas_pemilik_bangunan"
                                                                                id="no_identitas_pemilik_bangunan"
                                                                                placeholder="Masukkan nomor identitas"
                                                                                value="{{ old('no_identitas_pemilik_bangunan', $penindakans->no_identitas_pemilik_bangunan) }}"
                                                                                {{ old('data_bangunan', $penindakans->data_bangunan) == 'YA' ? '' : 'disabled' }}>
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
                                                        data-id="flush-collapse1055" name="ba_henti"
                                                        value="{{ old('ba_henti', $penindakans->ba_henti) }}"
                                                        {{ old('ba_henti', $penindakans->ba_henti) == 'YA' ? 'checked' : '' }}
                                                        aria-expanded="false" aria-controls="flush-collapse1055">
                                                    <label class="form-check-label" for="flexSwitchCheck1055"
                                                        id="switch-label-1055">
                                                        {{ old('ba_henti', $penindakans->ba_henti) == 'YA' ? 'YA' : 'TIDAK' }}
                                                    </label>

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
                                                        name="ba_riksa"
                                                        value="{{ old('ba_riksa', $penindakans->ba_riksa) }}"
                                                        {{ old('ba_riksa', $penindakans->ba_riksa) == 'YA' ? 'checked' : '' }}
                                                        aria-expanded="false" aria-controls="flush-collapse1">
                                                    <label class="form-check-label" for="flexSwitchCheck1"
                                                        id="switch-label-1">
                                                        {{ old('ba_riksa', $penindakans->ba_riksa) == 'YA' ? 'YA' : 'TIDAK' }}
                                                    </label>
                                                </div>
                                            </div>
                                            <hr class="my-0">
                                            <div id="flush-collapse1" class="accordion-collapse collapse"
                                                data-bs-parent="#accordionFlushExample">
                                                <div class="accordion-body bg-light">
                                                    <div class="row">
                                                        <!-- Left Column (Data Laporan Informasi) -->
                                                        <div class="col-lg-6">
                                                            <h6><b>A. Data B.A Riksa</b></h6>
                                                            <hr>
                                                            <div class="row">
                                                                <div class="row">
                                                                    <div class="col-md-6 mb-3">
                                                                        <label>No. B.A Riksa</label>
                                                                        <input type="text"
                                                                            class="form-control bg-primary text-white"
                                                                            value="{{ old('no_ba_riksa', $penindakans->no_ba_riksa) }}"
                                                                            placeholder="No. B.A Riksa" name="no_ba_riksa"
                                                                            readonly>
                                                                    </div>

                                                                    <div class="col-md-6 mb-3">
                                                                        <label>Tgl. B.A Riksa</label>
                                                                        <input type="date"
                                                                            class="form-control bg-primary text-white"
                                                                            name="tgl_ba_riksa"
                                                                            value="{{ old('tgl_ba_riksa', $penindakans->tgl_ba_riksa) }}">
                                                                    </div>
                                                                </div>


                                                                <h6><b>B. Data Pemeriksaan</b></h6>
                                                                <hr>

                                                                <div class="mb-3 form-group">
                                                                    <label>Lokasi Pemeriksaan</label>
                                                                    <div class="col-sm-12">
                                                                        <textarea class="form-control form-input" placeholder="Lokasi Pemeriksaan" name="lokasi_pemeriksaan" rows="3">{{ old('lokasi_pemeriksaan', $penindakans->lokasi_pemeriksaan) }}</textarea>
                                                                    </div>
                                                                </div>

                                                            </div>
                                                        </div>

                                                        <!-- Right Column (Pejabat Selection) -->
                                                        <div class="col-lg-6">
                                                            <h6><b>C. Data Lainnya</b></h6>
                                                            <hr>

                                                            <div class="mb-3 form-group">
                                                                <label>Rincian Hasil Pemeriksaan</label>
                                                                <div class="col-sm-12">
                                                                    <textarea class="form-control form-input" placeholder="Rincian Hasil Pemeriksaan" name="rincian_hasil_pemeriksaan"
                                                                        rows="9">{{ old('rincian_hasil_pemeriksaan', $penindakans->rincian_hasil_pemeriksaan) }}</textarea>
                                                                </div>
                                                            </div>

                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>

                                        <div class="accordion-item border rounded mt-2">
                                            <div class="d-flex justify-content-between align-items-center p-3 bg-light">
                                                <span class="fw-bold">B.A Riksa Badan</span>
                                                <div class="form-check form-switch mb-0">
                                                    <input class="form-check-input status-toggle" type="checkbox"
                                                        role="switch" id="flexSwitchCheck2" data-id="flush-collapse2"
                                                        name="ba_riksa_badan"
                                                        value="{{ old('ba_riksa_badan', $penindakans->ba_riksa_badan) }}"
                                                        {{ old('ba_riksa_badan', $penindakans->ba_riksa_badan) == 'YA' ? 'checked' : '' }}
                                                        aria-expanded="false" aria-controls="flush-collapse2">
                                                    <label class="form-check-label" for="flexSwitchCheck2"
                                                        id="switch-label-2">
                                                        {{ old('ba_riksa_badan', $penindakans->ba_riksa_badan) == 'YA' ? 'YA' : 'TIDAK' }}
                                                    </label>
                                                </div>
                                            </div>
                                            <hr class="my-0">
                                            <div id="flush-collapse2" class="accordion-collapse collapse"
                                                data-bs-parent="#accordionFlushExample">
                                                <div class="accordion-body bg-light">
                                                    <div class="row">
                                                        <!-- Left Column (Data Laporan Informasi) -->
                                                        <div class="col-lg-6">
                                                            <h6><b>A. Data B.A Riksa Badan</b></h6>
                                                            <hr>
                                                            <div class="row">
                                                                <div class="col-md-6 mb-3">
                                                                    <label>No. B.A Riksa Badan</label>
                                                                    <input type="text"
                                                                        class="form-control bg-primary text-white"
                                                                        value="{{ old('no_ba_riksa_badan', $penindakans->no_ba_riksa_badan) }}"
                                                                        placeholder="No. B.A Riksa"
                                                                        name="no_ba_riksa_badan" readonly>
                                                                </div>

                                                                <div class="col-md-6 mb-3">
                                                                    <label>Tgl. B.A Riksa Badan</label>
                                                                    <input type="date"
                                                                        class="form-control bg-primary text-white"
                                                                        value="{{ old('tgl_ba_riksa_badan', $penindakans->tgl_ba_riksa_badan) }}"
                                                                        name="tgl_ba_riksa_badan">
                                                                </div>
                                                            </div>

                                                            <div class="mb-3 form-group">
                                                                <label>
                                                                    Lokasi pemeriksaan Badan
                                                                </label>
                                                                <div class="col-sm-12">
                                                                    <input type="text" class="form-control"
                                                                        placeholder="Lokasi pemeriksaan Badan"
                                                                        name="lokasi_pemeriksaan_badan"
                                                                        value="{{ old('lokasi_pemeriksaan_badan', $penindakans->lokasi_pemeriksaan_badan ?? '') }}">
                                                                </div>
                                                            </div>

                                                            <div class="mb-3 form-group">
                                                                <label>
                                                                    Uraian pakaian yang dibuka/pemeriksaan medis
                                                                </label>
                                                                <div class="col-sm-12">
                                                                    <textarea class="form-control form-input" placeholder="Uraian pakaian yang dibuka/pemeriksaan medis"
                                                                        name="rincian_pemeriksaan_badan" rows="3">{{ old('rincian_pemeriksaan_badan', $penindakans->rincian_pemeriksaan_badan ?? '') }}</textarea>
                                                                </div>
                                                            </div>
                                                        </div>




                                                        <!-- Right Column (Pejabat Selection) -->
                                                        <div class="col-lg-6">

                                                            <div class="mb-3 form-group">
                                                                <label>
                                                                    Hasil pemeriksaan kedapatan
                                                                </label>
                                                                <div class="col-sm-12">
                                                                    <textarea class="form-control form-input" placeholder="Hasil pemeriksaan kedapatan" name="hasil_pemeriksaan_badan"
                                                                        rows="13">{{ old('hasil_pemeriksaan_badan', $penindakans->hasil_pemeriksaan_badan ?? '') }}</textarea>
                                                                </div>
                                                            </div>

                                                            {{-- <div class="row mb-3 form-group">
                                    <label class="col-sm-4 col-form-label">
                                      Nama Saksi
                                    </label>
                                    <div class="col-sm-8">
                                      <input type="text" class="form-control" placeholder="Nama Saksi" name="nama_saksi_ba_riksa_badan" value="{{ old('nama_saksi_ba_riksa_badan', $penindakans->nama_saksi_ba_riksa_badan ?? '') }}">
                                    </div>
                                  </div> --}}


                                                        </div>

                                                        <h6><b>B. Data Pemeriksaan Badan</b></h6>
                                                        <hr>

                                                        <div class="accordion accordion-flush" id="accordionFlushExample">
                                                            <div class="accordion-item">
                                                                <h2 class="accordion-header">
                                                                    <button
                                                                        class="accordion-button btn fw-medium collapsed border-0 hover:bg-gray-100 transition-all duration-200 rounded-top-3"
                                                                        type="button" data-bs-toggle="collapse"
                                                                        data-bs-target="#flush-collapseopmn">
                                                                        Pemeriksaan Badan
                                                                    </button>
                                                                </h2>
                                                                <div id="flush-collapseopmn"
                                                                    class="accordion-collapse collapse">
                                                                    <div
                                                                        class="accordion-body bg-white border-start border-4 border-primary shadow-sm rounded-bottom-3">

                                                                        <div class="row mb-3 form-group">
                                                                            <label class="col-sm-4 col-form-label">
                                                                                Nama
                                                                            </label>
                                                                            <div class="col-sm-8">
                                                                                <textarea class="form-control form-input" placeholder="Diisi nama orang yang terhadapnya dilakukan pemeriksaan badan"
                                                                                    name="nama" rows="3">{{ old('nama', $penindakans->nama) }}</textarea>
                                                                            </div>
                                                                        </div>

                                                                        <div class="row mb-3 form-group">
                                                                            <label class="col-sm-4 col-form-label">
                                                                                Tempat dan Tanggal Lahir
                                                                            </label>
                                                                            <div class="col-sm-8">
                                                                                <input type="text" class="form-control"
                                                                                    placeholder="Tempat dan Tanggal Lahir"
                                                                                    name="TTL"
                                                                                    value="{{ old('TTL', $penindakans->TTL) }}">
                                                                            </div>
                                                                        </div>

                                                                        <div class="row mb-3 form-group">
                                                                            <label class="col-sm-4 col-form-label">
                                                                                Jenis Kelamin
                                                                            </label>
                                                                            <div class="col-sm-8">
                                                                                <select
                                                                                    class="form-control form-select select2"
                                                                                    name="jenis_kelamin">
                                                                                    <option value="" selected
                                                                                        disabled>- Pilih -</option>
                                                                                    <option value="Laki-Laki"
                                                                                        {{ old('jenis_kelamin', $penindakans->jenis_kelamin) == 'Laki-Laki' ? 'selected' : '' }}>
                                                                                        Laki-Laki</option>
                                                                                    <option value="Perempuan"
                                                                                        {{ old('jenis_kelamin', $penindakans->jenis_kelamin) == 'Perempuan' ? 'selected' : '' }}>
                                                                                        Perempuan</option>
                                                                                </select>
                                                                            </div>
                                                                        </div>

                                                                        <div class="row mb-3 form-group">
                                                                            <label class="col-sm-4 col-form-label">
                                                                                Kewarganegaraan
                                                                            </label>
                                                                            <div class="col-sm-8">
                                                                                <input type="text" class="form-control"
                                                                                    placeholder="Kewarganegaraan"
                                                                                    name="kewarganegaraan"
                                                                                    value="{{ old('kewarganegaraan', $penindakans->kewarganegaraan) }}">
                                                                            </div>
                                                                        </div>

                                                                        <div class="row mb-3 form-group">
                                                                            <label class="col-sm-4 col-form-label">
                                                                                Alamat Tempat Tinggal
                                                                            </label>
                                                                            <div class="col-sm-8">
                                                                                <textarea class="form-control form-input" placeholder="Alamat Tempat Tinggal" name="alamat_tempat_tinggal"
                                                                                    rows="3">{{ old('alamat_tempat_tinggal', $penindakans->alamat_tempat_tinggal) }}</textarea>
                                                                            </div>
                                                                        </div>

                                                                        <div class="row mb-3 form-group">
                                                                            <label class="col-sm-4 col-form-label">
                                                                                Alamat KTP/Paspor
                                                                            </label>
                                                                            <div class="col-sm-8">
                                                                                <textarea class="form-control form-input" placeholder="Alamat KTP/Paspor" name="alamat_ktp" rows="3">{{ old('alamat_ktp', $penindakans->alamat_ktp) }}</textarea>
                                                                            </div>
                                                                        </div>

                                                                        <div class="row mb-3 form-group">
                                                                            <label class="col-sm-4 col-form-label">
                                                                                Nomor KTP/Paspor
                                                                            </label>
                                                                            <div class="col-sm-8">
                                                                                <input type="text" class="form-control"
                                                                                    placeholder="Nomor KTP/Paspor"
                                                                                    name="nomor_ktp"
                                                                                    value="{{ old('nomor_ktp', $penindakans->nomor_ktp) }}">
                                                                            </div>
                                                                        </div>

                                                                        <div class="row mb-3 form-group">
                                                                            <label class="col-sm-4 col-form-label">
                                                                                Tempat/Pejabat yang Mengeluarkan KTP/Paspor
                                                                            </label>
                                                                            <div class="col-sm-8">
                                                                                <textarea class="form-control form-input"
                                                                                    placeholder="Diisi nama tempat/pejabat yang mengeluarkan KTP/Paspor orang yang terhadapnya dilakukan pemeriksaan badan."
                                                                                    name="tempat_pejabat" rows="3">{{ old('tempat_pejabat', $penindakans->tempat_pejabat) }}</textarea>
                                                                            </div>
                                                                        </div>

                                                                        <div class="row mb-3 form-group">
                                                                            <label class="col-sm-4 col-form-label">
                                                                                Datang Dari
                                                                            </label>
                                                                            <div class="col-sm-8">
                                                                                <input type="text" class="form-control"
                                                                                    placeholder="Datang Dari"
                                                                                    name="datang_dari"
                                                                                    value="{{ old('datang_dari', $penindakans->datang_dari) }}">
                                                                            </div>
                                                                        </div>

                                                                        <div class="row mb-3 form-group">
                                                                            <label class="col-sm-4 col-form-label">
                                                                                Tempat tujuan
                                                                            </label>
                                                                            <div class="col-sm-8">
                                                                                <input type="text" class="form-control"
                                                                                    placeholder="Tujuan"
                                                                                    name="tempat_tujuan"
                                                                                    value="{{ old('tempat_tujuan', $penindakans->tempat_tujuan) }}">
                                                                            </div>
                                                                        </div>

                                                                        <div class="row mb-3 form-group">
                                                                            <label class="col-sm-4 col-form-label">
                                                                                Nama/Identitas orang yang bepergian
                                                                                dengannya
                                                                            </label>
                                                                            <div class="col-sm-8">
                                                                                <textarea class="form-control form-input"
                                                                                    placeholder="Diisi nama/identitas orang yang ikut bepergian dan memiliki relasi dengan orang yang terhadapnya dilakukan pemeriksaan badan."
                                                                                    name="nama_orang_bersamanya" rows="3">{{ old('nama_orang_bersamanya', $penindakans->nama_orang_bersamanya) }}</textarea>
                                                                            </div>
                                                                        </div>

                                                                        <div class="row mb-3 form-group">
                                                                            <label class="col-sm-4 col-form-label">
                                                                                Jenis/Nomor dan Tgl Dokumen barang yang
                                                                                dibawa
                                                                            </label>
                                                                            <div class="col-sm-8">
                                                                                <textarea class="form-control form-input"
                                                                                    placeholder="Diisi jenis/nomor dan tanggal dokumen yang dibawa orang yang terhadapnya dilakukan pemeriksaan badan"
                                                                                    name="jenis_dokumen" rows="3">{{ old('jenis_dokumen', $penindakans->jenis_dokumen) }}</textarea>
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

                                        <!-- SOC -->
                                        <div class="accordion-item border rounded mt-2">
                                            <div class="d-flex justify-content-between align-items-center p-3 bg-light">
                                                <span class="fw-bold">SOC</span>
                                                <div class="form-check form-switch mb-0">
                                                    <input class="form-check-input status-toggle" type="checkbox"
                                                        role="switch" id="flexSwitchCheck3" data-id="flush-collapse3"
                                                        name="soc" value="{{ old('soc', $penindakans->soc) }}"
                                                        {{ old('soc', $penindakans->soc) == 'YA' ? 'checked' : '' }}
                                                        aria-expanded="false" aria-controls="flush-collapse3">
                                                    <label class="form-check-label" for="flexSwitchCheck3"
                                                        id="switch-label-3">
                                                        {{ old('soc', $penindakans->soc) == 'YA' ? 'YA' : 'TIDAK' }}
                                                    </label>
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
                                                        name="doc" value="{{ old('doc', $penindakans->doc) }}"
                                                        {{ old('doc', $penindakans->doc) == 'YA' ? 'checked' : '' }}
                                                        aria-expanded="false" aria-controls="flush-collapse4">
                                                    <label class="form-check-label" for="flexSwitchCheck4"
                                                        id="switch-label-4">
                                                        {{ old('doc', $penindakans->doc) == 'YA' ? 'YA' : 'TIDAK' }}
                                                    </label>
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

                                        <!-- B.A Riksa -->
                                        <div class="accordion-item border rounded">
                                            <div class="d-flex justify-content-between align-items-center p-3 bg-light">
                                                <span class="fw-bold">B.A Sarkut</span>
                                                <div class="form-check form-switch mb-0">
                                                    <input class="form-check-input status-toggle" type="checkbox"
                                                        role="switch" id="flexSwitchCheck10" data-id="flush-collapse10"
                                                        name="ba_sarkut"
                                                        value="{{ old('ba_sarkut', $penindakans->ba_sarkut) }}"
                                                        {{ old('ba_sarkut', $penindakans->ba_sarkut) == 'YA' ? 'checked' : '' }}
                                                        aria-expanded="false" aria-controls="flush-collapse10">
                                                    <label class="form-check-label" for="flexSwitchCheck10"
                                                        id="switch-label-10">
                                                        {{ old('ba_sarkut', $penindakans->ba_sarkut) == 'YA' ? 'YA' : 'TIDAK' }}
                                                    </label>
                                                </div>

                                            </div>
                                            <hr class="my-0">
                                            <div id="flush-collapse10" class="accordion-collapse collapse"
                                                data-bs-parent="#accordionFlushExample">
                                                <div class="accordion-body bg-light">
                                                    <div class="row">
                                                        <!-- Left Column (Data Laporan Informasi) -->
                                                        <div class="col-lg-6">
                                                            <h6><b>A. Data B.A Sarkut</b></h6>
                                                            <hr>
                                                            <div class="row">
                                                                <div class="col-md-6 mb-3">
                                                                    <label>No. B.A Sarkut</label>
                                                                    <input type="text"
                                                                        class="form-control bg-primary text-white"
                                                                        value="{{ old('no_ba_sarkut', $penindakans->no_ba_sarkut ?? '') }}"
                                                                        placeholder="No. B.A Sarkut" name="no_ba_sarkut"
                                                                        readonly>
                                                                </div>

                                                                <div class="col-md-6 mb-3">
                                                                    <label>Tgl. B.A Sarkut</label>
                                                                    <input type="date"
                                                                        class="form-control bg-primary text-white"
                                                                        name="tgl_ba_sarkut"
                                                                        value="{{ old('tgl_ba_sarkut', $penindakans->tgl_ba_sarkut ?? '') }}">
                                                                </div>

                                                                <h6><b>B. Data Pembawaan</b></h6>
                                                                <hr>

                                                                <div class="mb-3 form-group">
                                                                    <label>Dari</label>
                                                                    <div class="col-sm-12">
                                                                        <input type="text"
                                                                            class="form-control form-input"
                                                                            name="dibawa_dari"
                                                                            placeholder="Tempat sarkut mulai dibawa"
                                                                            value="{{ old('dibawa_dari', $penindakans->dibawa_dari ?? '') }}">
                                                                    </div>
                                                                </div>

                                                                <div class="mb-3 form-group">
                                                                    <label>Tujuan</label>
                                                                    <div class="col-sm-12">
                                                                        <input type="text"
                                                                            class="form-control form-input" name="tujuan"
                                                                            placeholder="Tempat tujuan sarkut"
                                                                            value="{{ old('tujuan', $penindakans->tujuan ?? '') }}">
                                                                    </div>
                                                                </div>

                                                                <div class="mb-3 form-group">
                                                                    <label>Alasan</label>
                                                                    <div class="col-sm-12">
                                                                        <textarea class="form-control form-input" placeholder="Diisi pertimbangan dan alasan sarana pengangkut/barang dibawa"
                                                                            name="alasan" rows="3">{{ old('alasan', $penindakans->alasan ?? '') }}</textarea>
                                                                    </div>
                                                                </div>


                                                            </div>
                                                        </div>

                                                        <!-- Right Column (Pejabat Selection) -->
                                                        <div class="col-lg-6">
                                                            <h6><b>C. Data Lainnya</b></h6>
                                                            <hr>

                                                            <div class="mb-3 form-group">
                                                                <label>Waktu Berangkat</label>
                                                                <div class="col-sm-12">
                                                                    <input type="text" class="form-control"
                                                                        name="waktu_berangkat" id="datetime-datepicker"
                                                                        placeholder="Waktu Keberangkatan"
                                                                        value="{{ old('waktu_berangkat', $penindakans->waktu_berangkat ?? '') }}">
                                                                </div>
                                                            </div>

                                                            <div class="mb-3 form-group">
                                                                <label>Waktu Tiba</label>
                                                                <div class="col-sm-12">
                                                                    <input type="text" class="form-control"
                                                                        name="waktu_tiba" id="datetime-datepicker"
                                                                        placeholder="Waktu Tiba"
                                                                        value="{{ old('waktu_tiba', $penindakans->waktu_tiba ?? '') }}">
                                                                </div>
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

                                        <!-- B.A Riksa -->
                                        <div class="accordion-item border rounded">
                                            <div class="d-flex justify-content-between align-items-center p-3 bg-light">
                                                <span class="fw-bold">B.A Contoh</span>
                                                <div class="form-check form-switch mb-0">
                                                    <input class="form-check-input status-toggle" type="checkbox"
                                                        role="switch" id="flexSwitchCheck101"
                                                        data-id="flush-collapse101" name="ba_contoh"
                                                        value="{{ old('ba_contoh', $penindakans->ba_contoh) }}"
                                                        {{ old('ba_contoh', $penindakans->ba_contoh ?? '') == 'YA' ? 'checked' : '' }}
                                                        aria-expanded="false" aria-controls="flush-collapse101">
                                                    <label class="form-check-label" for="flexSwitchCheck101"
                                                        id="switch-label-101">
                                                        {{ old('ba_contoh', $penindakans->ba_contoh ?? '') == 'YA' ? 'YA' : 'TIDAK' }}
                                                    </label>
                                                </div>

                                            </div>
                                            <hr class="my-0">
                                            <div id="flush-collapse101" class="accordion-collapse collapse"
                                                data-bs-parent="#accordionFlushExample">
                                                <div class="accordion-body bg-light">
                                                    <!-- Left Column (Data Laporan Informasi) -->

                                                    <h6><b>A. Data B.A Contoh</b></h6>
                                                    <hr>
                                                    <div class="row">
                                                        <div class="col-md-6 mb-3">
                                                            <label>No. B.A Contoh</label>
                                                            <input type="text"
                                                                class="form-control bg-primary text-white"
                                                                value="{{ old('no_ba_contoh', $penindakans->no_ba_contoh) }}"
                                                                placeholder="No. B.A Contoh" name="no_ba_contoh"
                                                                readonly>
                                                        </div>

                                                        <div class="col-md-6 mb-3">
                                                            <label>Tgl. B.A Contoh</label>
                                                            <input type="date"
                                                                class="form-control bg-primary text-white"
                                                                value="{{ old('tgl_ba_contoh', $penindakans->tgl_ba_contoh) }}"
                                                                name="tgl_ba_contoh">
                                                        </div>
                                                    </div>

                                                    <h6><b>B. Data Pengambilan Barang Contoh</b></h6>
                                                    <hr>

                                                    <div class="card-body">
                                                        <div class="accordion accordion-flush"
                                                            id="accordionFlushExample">


                                                            <div class="accordion-item">
                                                                <h2 class="accordion-header">
                                                                    <button
                                                                        class="accordion-button btn fw-medium collapsed border-0 hover:bg-gray-100 transition-all duration-200 rounded-top-3"
                                                                        type="button" data-bs-toggle="collapse"
                                                                        data-bs-target="#flush-collapserrte">
                                                                        Barang
                                                                    </button>
                                                                </h2>
                                                                <div id="flush-collapserrte"
                                                                    class="accordion-collapse collapse">
                                                                    <div
                                                                        class="accordion-body bg-white border-start border-4 border-primary shadow-sm rounded-bottom-3">

                                                                        <div class="row mb-3 form-group">
                                                                            <label class="col-sm-4 col-form-label">Jumlah
                                                                                dan Jenis Barang</label>
                                                                            <div class="col-sm-8">
                                                                                <textarea class="form-control form-input" placeholder="Jumlah dan Jenis Barang Contoh"
                                                                                    name="jumlah_jenis_barang_contoh" rows="3">{{ old('jumlah_jenis_barang_contoh', $penindakans->jumlah_jenis_barang_contoh) }}</textarea>
                                                                            </div>
                                                                        </div>

                                                                        <div class="row mb-3 form-group">
                                                                            <label
                                                                                class="col-sm-4 col-form-label">Lokasi</label>
                                                                            <div class="col-sm-8">
                                                                                <input type="text"
                                                                                    class="form-control form-input"
                                                                                    value="{{ old('lokasi_barcon', $penindakans->lokasi_barcon) }}"
                                                                                    placeholder="Lokasi Pengambilan Barang Contoh"
                                                                                    name="lokasi_barcon">
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
                                                        data-id="flush-collapse102n" name="ba_dok"
                                                        value="{{ old('ba_dok', $penindakans->ba_dok) }}"
                                                        {{ old('ba_dok', $penindakans->ba_dok ?? '') == 'YA' ? 'checked' : '' }}
                                                        aria-expanded="false" aria-controls="flush-collapse102n">
                                                    <label class="form-check-label" for="flexSwitchCheck102n"
                                                        id="switch-label-102n">
                                                        {{ old('ba_dok', $penindakans->ba_dok ?? '') == 'YA' ? 'YA' : 'TIDAK' }}
                                                    </label>
                                                </div>

                                            </div>
                                            <hr class="my-0">
                                            <div id="flush-collapse102n" class="accordion-collapse collapse"
                                                data-bs-parent="#accordionFlushExample">
                                                <div class="accordion-body bg-light">

                                                    <h6><b>A. Data B.A Dokumentasi</b></h6>
                                                    <hr>
                                                    <div class="row">
                                                        <div class="col-md-6 mb-3">
                                                            <label>No. B.A Dokumentasi</label>
                                                            <input type="text"
                                                                class="form-control bg-primary text-white"
                                                                value="{{ old('no_ba_dok', $penindakans->no_ba_dok) }}"
                                                                placeholder="No. B.A Dokumentasi" name="no_ba_dok"
                                                                readonly>
                                                        </div>

                                                        <div class="col-md-6 mb-3">
                                                            <label>Tgl. B.A Dokumentasi</label>
                                                            <input type="date"
                                                                class="form-control bg-primary text-white"
                                                                name="tgl_ba_dok"
                                                                value="{{ old('tgl_ba_dok', $penindakans->tgl_ba_dok) }}">
                                                        </div>
                                                    </div>

                                                    <div class="mb-3 form-group">
                                                        <label>Lokasi</label>
                                                        <div class="col-sm-12">
                                                            <textarea class="form-control form-input" placeholder="Lokasi Dokumentasi Barang" name="lokasi_ba_dok"
                                                                rows="3">{{ old('lokasi_ba_dok', $penindakans->lokasi_ba_dok) }}</textarea>
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
                                                        data-id="flush-collapse1059" name="ba_tegah"
                                                        value="{{ old('ba_tegah', $penindakans->ba_tegah) }}"
                                                        {{ old('ba_tegah', $penindakans->ba_tegah ?? '') == 'YA' ? 'checked' : '' }}
                                                        aria-expanded="false" aria-controls="flush-collapse1059">
                                                    <label class="form-check-label" for="flexSwitchCheck1059"
                                                        id="switch-label-1059">
                                                        {{ old('ba_tegah', $penindakans->ba_tegah ?? '') == 'YA' ? 'YA' : 'TIDAK' }}
                                                    </label>
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
                                                                value="{{ old('no_ba_tegah', $penindakans->no_ba_tegah) }}"
                                                                placeholder="No. B.A Tegah" name="no_ba_tegah" readonly>
                                                        </div>

                                                        <div class="col-md-6 mb-3">
                                                            <label>Tgl. B.A Tegah</label>
                                                            <input type="date"
                                                                class="form-control bg-primary text-white"
                                                                value="{{ old('tgl_ba_tegah', $penindakans->tgl_ba_tegah) }}"
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
                                                        data-id="flush-collapse1032" name="ba_segel"
                                                        value="{{ old('ba_segel', $penindakans->ba_segel) }}"
                                                        {{ old('ba_segel', $penindakans->ba_segel ?? '') == 'YA' ? 'checked' : '' }}
                                                        aria-expanded="false" aria-controls="flush-collapse1032">
                                                    <label class="form-check-label" for="flexSwitchCheck1032"
                                                        id="switch-label-1032">
                                                        {{ old('ba_segel', $penindakans->ba_segel ?? '') == 'YA' ? 'YA' : 'TIDAK' }}
                                                    </label>
                                                </div>

                                            </div>
                                            <hr class="my-0">
                                            <div id="flush-collapse1032" class="accordion-collapse collapse"
                                                data-bs-parent="#accordionFlushExample">
                                                <div class="accordion-body bg-light">
                                                    <h6><b>A. Data B.A Segel</b></h6>
                                                    <hr>
                                                    <div class="row">
                                                        <div class="col-md-6 mb-3">
                                                            <label>No. B.A Segel</label>
                                                            <input type="text"
                                                                class="form-control bg-primary text-white"
                                                                value="{{ old('no_ba_segel', $penindakans->no_ba_segel) }}"
                                                                placeholder="No. B.A Segel" name="no_ba_segel" readonly>
                                                        </div>

                                                        <div class="col-md-6 mb-3">
                                                            <label>Tgl. B.A Segel</label>
                                                            <input type="date"
                                                                class="form-control bg-primary text-white"
                                                                value="{{ old('tgl_ba_segel', $penindakans->tgl_ba_segel) }}"
                                                                name="tgl_ba_segel">
                                                        </div>
                                                    </div>

                                                    <div class="col-lg-12 mb-3">
                                                        <label>Jenis Segel</label>
                                                        <select class="form-control form-select select2"
                                                            name="jenis_segel_ba_segel">
                                                            <option value="" selected disabled>- Pilih -</option>
                                                            @foreach ($segels as $segel)
                                                                <option value="{{ $segel->jenis_segel }}"
                                                                    {{ old('jenis_segel_ba_segel', $penindakans->jenis_segel_ba_segel) == $segel->jenis_segel ? 'selected' : '' }}>
                                                                    {{ $segel->jenis_segel }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>

                                                    <div class="row">
                                                        <div class="col-md-6 mb-3">
                                                            <label>Jumlah Segel</label>
                                                            <input type="text" class="form-control"
                                                                value="{{ old('jumlah_segel_ba_segel', $penindakans->jumlah_segel_ba_segel) }}"
                                                                placeholder="Jumlah Segel" name="jumlah_segel_ba_segel">
                                                        </div>

                                                        <div class="col-md-6 mb-3">
                                                            <label>Nomor Segel</label>
                                                            <input type="text" class="form-control"
                                                                value="{{ old('nomor_segel_ba_segel', $penindakans->nomor_segel_ba_segel) }}"
                                                                placeholder="Nomor Segel" name="nomor_segel_ba_segel">
                                                        </div>
                                                    </div>

                                                    <div class="col-md-12 mb-3">
                                                        <label>Peletakan Segel</label>
                                                        <textarea class="form-control form-input" placeholder="Peletakan Segel" name="peletakan_segel_ba_segel"
                                                            rows="3">{{ old('peletakan_segel_ba_segel', $penindakans->peletakan_segel_ba_segel) }}</textarea>
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
                                                        data-id="flush-collapse1011" name="ba_titip"
                                                        value="{{ old('ba_titip', $penindakans->ba_titip) }}"
                                                        {{ old('ba_titip', $penindakans->ba_titip ?? '') == 'YA' ? 'checked' : '' }}
                                                        aria-expanded="false" aria-controls="flush-collapse1011">
                                                    <label class="form-check-label" for="flexSwitchCheck1011"
                                                        id="switch-label-1011">
                                                        {{ old('ba_titip', $penindakans->ba_titip ?? '') == 'YA' ? 'YA' : 'TIDAK' }}
                                                    </label>
                                                </div>

                                            </div>
                                            <hr class="my-0">
                                            <div id="flush-collapse1011" class="accordion-collapse collapse"
                                                data-bs-parent="#accordionFlushExample">
                                                <div class="accordion-body bg-light">

                                                    <h6><b>A. Data B.A Titip</b></h6>
                                                    <hr>
                                                    <div class="row">
                                                        <div class="col-md-6 mb-3">
                                                            <label>No. B.A Titip</label>
                                                            <input type="text"
                                                                class="form-control bg-primary text-white"
                                                                value="{{ old('no_ba_titip', $penindakans->no_ba_titip) }}"
                                                                placeholder="No. B.A Titip" name="no_ba_titip" readonly>
                                                        </div>

                                                        <div class="col-md-6 mb-3">
                                                            <label>Tgl. B.A Titip</label>
                                                            <input type="date"
                                                                class="form-control bg-primary text-white"
                                                                name="tgl_ba_titip"
                                                                value="{{ old('tgl_ba_titip', $penindakans->tgl_ba_titip) }}">
                                                        </div>
                                                    </div>

                                                    <h6><b>B. Data Penitipan</b></h6>
                                                    <hr>

                                                    <div class="card-body">
                                                        <div class="accordion accordion-flush"
                                                            id="accordionFlushExample">
                                                            <div class="accordion-item">
                                                                <h2 class="accordion-header">
                                                                    <button
                                                                        class="accordion-button btn fw-medium collapsed border-0 hover:bg-gray-100 transition-all duration-200 rounded-top-3"
                                                                        type="button" data-bs-toggle="collapse"
                                                                        data-bs-target="#flush-collapserrtez">
                                                                        Penitipan
                                                                    </button>
                                                                </h2>
                                                                <div id="flush-collapserrtez"
                                                                    class="accordion-collapse collapse">
                                                                    <div
                                                                        class="accordion-body bg-white border-start border-4 border-primary shadow-sm rounded-bottom-3">

                                                                        <div class="row mb-3 form-group">
                                                                            <label class="col-sm-4 col-form-label">Lokasi
                                                                                Penitipan</label>
                                                                            <div class="col-sm-8">
                                                                                <textarea class="form-control form-input" placeholder="Lokasi Penitipan" name="lokasi_penitipan_ba_titip"
                                                                                    rows="3">{{ old('lokasi_penitipan_ba_titip', $penindakans->lokasi_penitipan_ba_titip) }}</textarea>
                                                                            </div>
                                                                        </div>

                                                                        <div class="row mb-3 form-group">
                                                                            <label class="col-sm-4 col-form-label">Nama
                                                                                Yang Dititipkan</label>
                                                                            <div class="col-sm-8">
                                                                                <input type="text"
                                                                                    class="form-control form-input"
                                                                                    placeholder="Nama Yang Dititipkan"
                                                                                    name="nama_ba_titip"
                                                                                    value="{{ old('nama_ba_titip', $penindakans->nama_ba_titip) }}">
                                                                            </div>
                                                                        </div>

                                                                        <div class="row mb-3 form-group">
                                                                            <label class="col-sm-4 col-form-label">Alamat
                                                                                yang dtitipkan</label>
                                                                            <div class="col-sm-8">
                                                                                <textarea class="form-control form-input" placeholder="Alamat yang dtitipkan" name="alamat_ba_titip"
                                                                                    rows="3">{{ old('alamat_ba_titip', $penindakans->alamat_ba_titip) }}</textarea>
                                                                            </div>
                                                                        </div>

                                                                        <div class="row mb-3 form-group">
                                                                            <label class="col-sm-4 col-form-label">Jabatan
                                                                                yang dtitipkan</label>
                                                                            <div class="col-sm-8">
                                                                                <input type="text"
                                                                                    class="form-control form-input"
                                                                                    placeholder="Jabatan yang dtitipkan"
                                                                                    name="jabatan_ba_titip"
                                                                                    value="{{ old('jabatan_ba_titip', $penindakans->jabatan_ba_titip) }}">
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
                                                        data-id="flush-collapse1022" name="bpc"
                                                        value="{{ old('bpc', $penindakans->bpc) }}"
                                                        aria-expanded="false" aria-controls="flush-collapse1022"
                                                        {{ old('bpc', $penindakans->bpc) == 'TIDAK' ? '' : 'checked' }}>
                                                    <label class="form-check-label" for="flexSwitchCheck1022"
                                                        id="switch-label-1022">
                                                        {{ old('bpc', $penindakans->bpc) == 'TIDAK' ? 'TIDAK' : 'YA' }}
                                                    </label>
                                                </div>

                                            </div>
                                            <hr class="my-0">
                                        </div>

                                    </div>
                                </div>

                                <div class="tab-pane fade" id="tolak1" role="tabpanel" aria-labelledby="tolak1">
                                    <div class="accordion accordion-flush" id="accordionFlushExample">

                                        <!-- B.A Dokumentasi -->
                                        <div class="accordion-item border rounded">
                                            <div class="d-flex justify-content-between align-items-center p-3 bg-light">
                                                <span class="fw-bold">B.A Tolak Pertama</span>
                                                <div class="form-check form-switch mb-0">
                                                    <input class="form-check-input status-toggle" type="checkbox"
                                                        role="switch" id="flexSwitchCheck10114"
                                                        data-id="flush-collapse10114" name="ba_tolak_1"
                                                        value="{{ old('ba_tolak_1', $penindakans->ba_tolak_1) }}"
                                                        {{ old('ba_tolak_1', $penindakans->ba_tolak_1 ?? '') == 'YA' ? 'checked' : '' }}
                                                        aria-expanded="false" aria-controls="flush-collapse10114">
                                                    <label class="form-check-label" for="flexSwitchCheck10114"
                                                        id="switch-label-10114">
                                                        {{ old('ba_tolak_1', $penindakans->ba_tolak_1 ?? '') == 'YA' ? 'YA' : 'TIDAK' }}
                                                    </label>
                                                </div>

                                            </div>
                                            <hr class="my-0">
                                            <div id="flush-collapse10114" class="accordion-collapse collapse"
                                                data-bs-parent="#accordionFlushExample">
                                                <div class="accordion-body bg-light">
                                                    <div class="row">
                                                        <!-- Left Column (Data Laporan Informasi) -->
                                                        <div class="col-lg-6">
                                                            <h6><b>A. Data B.A Tolak Pertama</b></h6>
                                                            <hr>
                                                            <div class="row">
                                                                <div class="col-md-6 mb-3">
                                                                    <label>No. B.A Tolak 1</label>
                                                                    <input type="text"
                                                                        class="form-control bg-primary text-white"
                                                                        value="{{ old('no_ba_tolak_1', $penindakans->no_ba_tolak_1) }}"
                                                                        placeholder="No. B.A Tolak Pertama"
                                                                        name="no_ba_tolak_1" readonly>
                                                                </div>

                                                                <div class="col-md-6 mb-3">
                                                                    <label>Tgl. B.A Tolak 1</label>
                                                                    <input type="date"
                                                                        class="form-control bg-primary text-white"
                                                                        name="tgl_ba_tolak_1"
                                                                        value="{{ old('tgl_ba_tolak_1', $penindakans->tgl_ba_tolak_1) }}">
                                                                </div>


                                                                <div class="col-md-12 mb-3">
                                                                    <label>Nama Orang Yang Menolak</label>
                                                                    <input type="text"
                                                                        class="form-control form-input"
                                                                        placeholder="Nama Orang Yang Menolak"
                                                                        name="nama_ba_tolak1"
                                                                        value="{{ old('nama_ba_tolak1', $penindakans->nama_ba_tolak1) }}">
                                                                </div>

                                                                <div class="col-md-12 mb-3">
                                                                    <label>Tempat Tanggal Lahir</label>
                                                                    <input type="text"
                                                                        class="form-control form-input"
                                                                        placeholder="Tempat Tanggal Lahir"
                                                                        name="ttl_ba_tolak1"
                                                                        value="{{ old('ttl_ba_tolak1', $penindakans->ttl_ba_tolak1) }}">
                                                                </div>

                                                                <div class="col-md-12 mb-3">
                                                                    <label>Jenis Kelamin</label>
                                                                    <select class="form-control form-select select2"
                                                                        name="jk_ba_tolak1">
                                                                        <option value="" selected disabled>- Pilih -
                                                                        </option>
                                                                        <option value="Laki-laki"
                                                                            {{ old('jk_ba_tolak1', $penindakans->jk_ba_tolak1) == 'Laki-laki' ? 'selected' : '' }}>
                                                                            Laki-laki</option>
                                                                        <option value="Perempuan"
                                                                            {{ old('jk_ba_tolak1', $penindakans->jk_ba_tolak1) == 'Perempuan' ? 'selected' : '' }}>
                                                                            Perempuan</option>
                                                                    </select>
                                                                </div>



                                                                <div class="col-md-12 mb-3">
                                                                    <label>Alamat</label>
                                                                    <textarea class="form-control form-input" placeholder="Alamat" name="alamat_ba_tolak1" rows="3">{{ old('alamat_ba_tolak1', $penindakans->alamat_ba_tolak1) }}</textarea>
                                                                </div>


                                                                <div class="col-md-12 mb-3">
                                                                    <label>Kewarganegaraan</label>
                                                                    <select class="form-control form-select select2"
                                                                        name="kewarganegaraan_ba_tolak1">
                                                                        <option value="" disabled
                                                                            {{ old('kewarganegaraan_ba_tolak1', $penindakans->kewarganegaraan_ba_tolak1) === null ? 'selected' : '' }}>
                                                                            Pilih Kewarganegaraan
                                                                        </option>
                                                                        @foreach ($nama_negara as $benua => $negara)
                                                                            <optgroup label="{{ $benua }}">
                                                                                @foreach ($negara as $item)
                                                                                    <option value="{{ $item->UrEdi }}"
                                                                                        {{ old('kewarganegaraan_ba_tolak1', $penindakans->kewarganegaraan_ba_tolak1) === $item->UrEdi ? 'selected' : '' }}>
                                                                                        {{ $item->UrEdi }}
                                                                                    </option>
                                                                                @endforeach
                                                                            </optgroup>
                                                                        @endforeach
                                                                    </select>
                                                                </div>


                                                                <div class="col-md-12 mb-3">
                                                                    <label>Pekerjaan</label>
                                                                    <input type="text"
                                                                        class="form-control form-input"
                                                                        placeholder="Pekerjaan"
                                                                        name="pekerjaan_ba_tolak1"
                                                                        value="{{ old('pekerjaan_ba_tolak1', $penindakans->pekerjaan_ba_tolak1) }}">
                                                                </div>


                                                            </div>
                                                        </div>


                                                        <!-- Right Column (Pejabat Selection) -->
                                                        <div class="col-lg-6">



                                                            <div class="row mb-3 form-group">
                                                                <label class="col-sm-3 col-form-label">Alasan Tolak
                                                                    Pertama</label>
                                                                <div class="col-sm-9">
                                                                    <textarea class="form-control form-input" placeholder="Alasan Tolak Pertama" name="alasan_tolak_1"
                                                                        rows="5">{{ old('alasan_tolak_1', $penindakans->alasan_tolak_1) }}</textarea>
                                                                </div>
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

                                        <!-- B.A Dokumentasi -->
                                        <div class="accordion-item border rounded">
                                            <div class="d-flex justify-content-between align-items-center p-3 bg-light">
                                                <span class="fw-bold">B.A Tolak Kedua</span>
                                                <div class="form-check form-switch mb-0">
                                                    <input class="form-check-input status-toggle" type="checkbox"
                                                        role="switch" id="flexSwitchCheck101145"
                                                        data-id="flush-collapse101145" name="ba_tolak_2"
                                                        value="{{ old('ba_tolak_2', $penindakans->ba_tolak_2) }}"
                                                        {{ old('ba_tolak_2', $penindakans->ba_tolak_2 ?? '') == 'YA' ? 'checked' : '' }}
                                                        aria-expanded="false" aria-controls="flush-collapse101145">
                                                    <label class="form-check-label" for="flexSwitchCheck101145"
                                                        id="switch-label-101145">
                                                        {{ old('ba_tolak_2', $penindakans->ba_tolak_2 ?? '') == 'YA' ? 'YA' : 'TIDAK' }}
                                                    </label>
                                                </div>

                                            </div>
                                            <hr class="my-0">
                                            <div id="flush-collapse101145" class="accordion-collapse collapse"
                                                data-bs-parent="#accordionFlushExample">
                                                <div class="accordion-body bg-light">
                                                    <div class="row">
                                                        <!-- Left Column (Data Laporan Informasi) -->
                                                        <div class="col-lg-6">
                                                            <h6><b>A. Data B.A Tolak Kedua</b></h6>
                                                            <hr>
                                                            <div class="row">
                                                                <div class="col-md-6 mb-3">
                                                                    <label>No. B.A Tolak 2</label>
                                                                    <input type="text"
                                                                        class="form-control bg-primary text-white"
                                                                        value="{{ old('no_ba_tolak_2', $penindakans->no_ba_tolak_2) }}"
                                                                        placeholder="No. B.A Tolak Kedua"
                                                                        name="no_ba_tolak_2" readonly>
                                                                </div>

                                                                <div class="col-md-6 mb-3">
                                                                    <label>Tgl. B.A Tolak 2</label>
                                                                    <input type="date"
                                                                        class="form-control bg-primary text-white"
                                                                        name="tgl_ba_tolak_2"
                                                                        value="{{ old('tgl_ba_tolak_2', $penindakans->tgl_ba_tolak_2) }}">
                                                                </div>


                                                                <div class="col-md-12 mb-3">
                                                                    <label>Nama Saksi</label>
                                                                    <input type="text"
                                                                        class="form-control form-input"
                                                                        placeholder="Saksi yang menyaksikan penolakan tanda tangan"
                                                                        name="saksi_ba_tolak2"
                                                                        value="{{ old('saksi_ba_tolak2', $penindakans->saksi_ba_tolak2) }}">
                                                                </div>


                                                            </div>
                                                        </div>


                                                        <!-- Right Column (Pejabat Selection) -->
                                                        <div class="col-lg-6">



                                                            <div class="row mb-3 form-group">
                                                                <label class="col-sm-3 col-form-label">Alasan Tolak
                                                                    Kedua</label>
                                                                <div class="col-sm-9">
                                                                    <textarea class="form-control form-input" placeholder="Alasan Tolak Kedua" name="alasan_tolak_2" rows="5">{{ old('alasan_tolak_2', $penindakans->alasan_tolak_2) }}</textarea>
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
            const switches = document.querySelectorAll('.status-toggle');

            switches.forEach((switchElement) => {
                const label = switchElement.nextElementSibling;
                const targetAccordion = document.getElementById(switchElement.dataset.id);

                const isChecked = switchElement.value === 'YA';
                switchElement.checked = isChecked;
                label.textContent = isChecked ? 'YA' : 'TIDAK';

                if (targetAccordion) {
                    if (isChecked) {
                        targetAccordion.classList.add('show');
                    } else {
                        targetAccordion.classList.remove('show');
                    }
                }

                switchElement.addEventListener('change', function() {
                    const isNowChecked = this.checked;
                    this.value = isNowChecked ? 'YA' : 'TIDAK';
                    label.textContent = isNowChecked ? 'YA' : 'TIDAK';

                    if (targetAccordion) {
                        if (isNowChecked) {
                            targetAccordion.classList.add('show');
                        } else {
                            targetAccordion.classList.remove('show');
                        }
                    } else {
                        console.warn(
                            `Accordion dengan ID "${switchElement.dataset.id}" tidak ditemukan.`
                        );
                    }
                });
            });
        });
    </script>




    <script>
        document.addEventListener('DOMContentLoaded', function() {
            $('#alasan_penindakan').select2();

            const existingJenisPelanggaran = document.querySelector('#alasan_penindakan option:checked')
                ?.getAttribute('data-jenis');
            if (existingJenisPelanggaran) {
                document.getElementById("jenis_pelanggaran").value = existingJenisPelanggaran;
            }

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
