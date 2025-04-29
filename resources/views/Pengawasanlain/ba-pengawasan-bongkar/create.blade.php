@extends('layouts.vertical', ['title' => 'Rekam B.A Pengawasan Bongkar'])

@section('css')
    @vite(['node_modules/datatables.net-bs5/css/dataTables.bootstrap5.min.css', 'node_modules/datatables.net-buttons-bs5/css/buttons.bootstrap5.min.css', 'node_modules/datatables.net-keytable-bs5/css/keyTable.bootstrap5.min.css', 'node_modules/datatables.net-responsive-bs5/css/responsive.bootstrap5.min.css', 'node_modules/datatables.net-select-bs5/css/select.bootstrap5.min.css'])
@endsection
@section('content')
    <div class="container-fluid">
        <form action="{{ route('ba-pengawasan-bongkar.store') }}" method="POST">
            @csrf
            <div class="card mb-3 mt-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="card-title mb-0">
                        <i data-feather="book" style="width: 20px; height: 20px;" class="me-1"></i>
                        Form Rekam Data B.A Pengawasan Bongkar
                    </h5>
                    <a href="{{ route('ba-pengawasan-bongkar.index') }}" class="btn btn-danger btn-sm">
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
                                                <a class="nav-link active" id="navtabs2-ba-pengawasan-bongkar-tab"
                                                    data-bs-toggle="tab" href="#navtabs2-ba-pengawasan-bongkar"
                                                    role="tab" aria-controls="navtabs2-ba-pengawasan-bongkar"
                                                    aria-selected="true">
                                                    <span class="d-block d-sm-none">(B.A PENGAWASAN BONGKAR)</span>
                                                    <span class="d-none d-sm-block">BERITA ACARA PENGAWASAN BONGKAR</span>
                                                </a>
                                            </li>
                                            <li class="nav-item-penyidikan">
                                                <a class="nav-link " id="navtabs2-lpt-tab" data-bs-toggle="tab"
                                                    href="#navtabs2-lpt" role="tab" aria-controls="navtabs2-lpt"
                                                    aria-selected="false">
                                                    <span class="d-block d-sm-none">(LPT)</span>
                                                    <span class="d-none d-sm-block">LAPORAN PELAKSANAAN TUGAS</span>
                                                </a>
                                            </li>
                                            <li class="nav-item-penyidikan">
                                                <a class="nav-link " id="navtabs2-lpp-tab" data-bs-toggle="tab"
                                                    href="#navtabs2-lpp" role="tab" aria-controls="navtabs2-lpp"
                                                    aria-selected="false">
                                                    <span class="d-block d-sm-none">LPP</span>
                                                    <span class="d-none d-sm-block">LAPORAN PENGAWASAN PEMBONGKARAN</span>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>



                                    <div class="tab-content p-3 text-muted">
                                        <input type="hidden" id="id_ba_bongkar" name="id_ba_bongkar" value="">
                                        <input type="hidden" name="id_penyidikan_ref" value="{{ $id_penyidikan }}"
                                            readonly>

                                        <div class="tab-pane active" id="navtabs2-ba-pengawasan-bongkar" role="tabpanel">
                                            <div class="container mt-4">
                                                <!-- Header -->
                                                <div class="text-center">
                                                    <p class="mb-0 fw-bold">KEMENTERIAN KEUANGAN REPUBLIK INDONESIA</p>
                                                    <p class="mb-0 fw-bold">DIREKTORAT JENDERAL BEA DAN CUKAI</p>
                                                    <p class="mb-0 fw-bold text-decoration-underline">KANTOR PELAYANAN UTAMA
                                                        BEA DAN CUKAI TIPE B BATAM</p>
                                                </div>

                                                <!-- Judul Form -->
                                                <div class="text-center mt-4">
                                                    <h5 class="fw-bold text-decoration-underline">BERITA ACARA PENGAWASAN
                                                        PEMBONGKARAN BARANG DI LUAR KAWASAN PABEAN</h5>
                                                </div>

                                                <!-- Nomor Pendaftaran dan Tanggal -->
                                                <div class="row mt-3">
                                                    <div class="col-6">
                                                        <div class="input-group">
                                                            <span
                                                                class="input-group-text text-black bg-white border-0">NOMOR
                                                                PENDAFTARAN:</span>
                                                            <input type="text"
                                                                class="form-control form-control-sm border-0 border-bottom border-dark"
                                                                name="no_pendaftaran_ba_bongkar" />
                                                        </div>
                                                    </div>
                                                    <div class="col-6">
                                                        <div class="input-group">
                                                            <span
                                                                class="input-group-text text-black bg-white border-0">TANGGAL:</span>
                                                            <input type="date"
                                                                class="form-control form-control-sm border-0 border-bottom border-dark"
                                                                name="tgl_pendaftaran_ba_bongkar" />
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- Keterangan -->
                                                <div class="mt-4">
                                                    <p class="text-black">Terhadap barang dengan data sebagai berikut:</p>
                                                </div>

                                                <!-- Form Fields -->
                                                <div class="mt-3">
                                                    <!-- 1. Nomor/Tanggal BC 1.1 -->
                                                    <div class="row mb-2 align-items-center text-black">
                                                        <div class="col-5">
                                                            <span>1. Nomor / Tanggal BC 1.1</span>
                                                        </div>
                                                        <div class="col-1 text-center">:</div>
                                                        <div class="col-6">
                                                            <input type="text"
                                                                class="form-control form-control-sm border-0 border-bottom border-dark"
                                                                name="nomor_tanggal_bc_ba_bongkar" />
                                                        </div>
                                                    </div>

                                                    <!-- 2. Nama Sarana / GT -->
                                                    <div class="row mb-2 text-black align-items-center">
                                                        <div class="col-5">
                                                            <span>2. Nama Sarana / GT</span>
                                                        </div>
                                                        <div class="col-1 text-center">:</div>
                                                        <div class="col-6">
                                                            <input type="text"
                                                                class="form-control form-control-sm border-0 border-bottom border-dark"
                                                                name="nama_sarana_ba_bongkar" />
                                                        </div>
                                                    </div>

                                                    <!-- 3. Tanggal Realisasi Kedatangan -->
                                                    <div class="row mb-2 align-items-center text-black">
                                                        <div class="col-5">
                                                            <span>3. Tanggal Realisasi Kedatangan</span>
                                                        </div>
                                                        <div class="col-1 text-center">:</div>
                                                        <div class="col-6">
                                                            <input type="text"
                                                                class="form-control form-control-sm border-0 border-bottom border-dark"
                                                                name="tanggal_realisasi_ba_bongkar" />
                                                        </div>
                                                    </div>

                                                    <!-- 4. Lokasi Pembongkaran -->
                                                    <div class="row mb-2 align-items-center text-black">
                                                        <div class="col-5">
                                                            <span>4. Lokasi Pembongkaran</span>
                                                        </div>
                                                        <div class="col-1 text-center">:</div>
                                                        <div class="col-6">
                                                            <input type="text"
                                                                class="form-control form-control-sm border-0 border-bottom border-dark"
                                                                name="lokasi_pembongkaran" />
                                                        </div>
                                                    </div>

                                                    <!-- 5. Tanggal / Waktu Pembongkaran -->
                                                    <div class="row mb-2 align-items-center text-black">
                                                        <div class="col-5">
                                                            <span>5. Tanggal / Waktu Pembongkaran</span>
                                                        </div>
                                                        <div class="col-1 text-center">:</div>
                                                        <div class="col-6"></div>
                                                    </div>

                                                    <!-- Sub 5 a. Jam / Tgl dimulai -->
                                                    <div class="row mb-2 align-items-center text-black">
                                                        <div class="col-5 ps-5">
                                                            <span>a. Jam / Tgl dimulai Pembongkaran</span>
                                                        </div>
                                                        <div class="col-1 text-center">:</div>
                                                        <div class="col-6">
                                                            <input type="text"
                                                                class="form-control form-control-sm border-0 border-bottom border-dark"
                                                                name="jam_tgl_mulai_ba_bongkar" />
                                                        </div>
                                                    </div>

                                                    <!-- Sub 5 b. Jam / Tgl selesai -->
                                                    <div class="row mb-2 align-items-center text-black">
                                                        <div class="col-5 ps-5">
                                                            <span>b. Jam / Tgl selesai Pembongkaran</span>
                                                        </div>
                                                        <div class="col-1 text-center">:</div>
                                                        <div class="col-6">
                                                            <input type="text"
                                                                class="form-control form-control-sm border-0 border-bottom border-dark"
                                                                name="jam_tgl_selesai_ba_bongkar" />
                                                        </div>
                                                    </div>

                                                    <!-- 6. Foto -->
                                                    <div class="row mb-2 align-items-center text-black">
                                                        <div class="col-5">
                                                            <span>6. Foto</span>
                                                        </div>
                                                        <div class="col-1 text-center">:</div>
                                                        <div class="col-6">
                                                            <div class="d-flex align-items-center">
                                                                <label class="me-2 mb-0">Upload Foto*</label>
                                                                <input type="file" name="foto_ba_bongkar"
                                                                    accept="image/*"
                                                                    class="form-control form-control-sm border-0 border-bottom border-dark w-75" />
                                                            </div>
                                                        </div>
                                                    </div>


                                                    <!-- 7. Nomor / Tgl Bill of Lading -->
                                                    <div class="row mb-2 align-items-center text-black">
                                                        <div class="col-5">
                                                            <span>7. Nomor / Tgl Bill of Lading</span>
                                                        </div>
                                                        <div class="col-1 text-center">:</div>
                                                        <div class="col-6">
                                                            <input type="text"
                                                                class="form-control form-control-sm border-0 border-bottom border-dark"
                                                                name="nomor_tgl_bill_of_lading_ba_bongkar" />
                                                        </div>
                                                    </div>

                                                    <!-- 8. Jumlah barang dibongkar -->
                                                    <div class="row mb-2 align-items-center text-black">
                                                        <div class="col-5">
                                                            <span>8. Jumlah barang dibongkar</span>
                                                        </div>
                                                        <div class="col-1 text-center">:</div>
                                                        <div class="col-6">
                                                            <input type="text"
                                                                class="form-control form-control-sm border-0 border-bottom border-dark"
                                                                name="jumlah_barang_dibongkar_ba_bongkar" />
                                                        </div>
                                                    </div>

                                                    <!-- 9. Dokumen Pelengkap -->
                                                    <div class="row mb-2 align-items-center text-black">
                                                        <div class="col-5">
                                                            <span>9. Dokumen Pelengkap</span>
                                                        </div>
                                                        <div class="col-1 text-center">:</div>
                                                        <div class="col-6">
                                                            <input type="text"
                                                                class="form-control form-control-sm border-0 border-bottom border-dark"
                                                                name="dokumen_pelengkap_ba_bongkar" />
                                                        </div>
                                                    </div>

                                                    <!-- 10. Kendala Pengawasan -->
                                                    <div class="row mb-2 align-items-center text-black">
                                                        <div class="col-5">
                                                            <span>10. Kendala Pengawasan</span>
                                                        </div>
                                                        <div class="col-1 text-center">:</div>
                                                        <div class="col-6"></div>
                                                    </div>

                                                    <!-- Sub 10 a. -->
                                                    <div class="row mb-2 align-items-center text-black">
                                                        <div class="col-5 ps-5">
                                                            <span>a. Barang tidak ada ditempat</span>
                                                        </div>
                                                        <div class="col-1 text-center">:</div>
                                                        <div class="col-6">
                                                            <input type="text"
                                                                class="form-control form-control-sm border-0 border-bottom border-dark"
                                                                name="barang_tidak_ada_ditempat_ba_bongkar" />
                                                        </div>
                                                    </div>

                                                    <!-- Sub 10 b. -->
                                                    <div class="row mb-2 align-items-center text-black">
                                                        <div class="col-5 ps-5">
                                                            <span>b. Barang sudah dibongkar</span>
                                                        </div>
                                                        <div class="col-1 text-center">:</div>
                                                        <div class="col-6">
                                                            <input type="text"
                                                                class="form-control form-control-sm border-0 border-bottom border-dark"
                                                                name="barang_sudah_dibongkar_ba_bongkar" />
                                                        </div>
                                                    </div>

                                                    <!-- Sub 10 c. -->
                                                    <div class="row mb-2 align-items-center text-black">
                                                        <div class="col-5 ps-5">
                                                            <span>c. Lain-lain</span>
                                                        </div>
                                                        <div class="col-1 text-center">:</div>
                                                        <div class="col-6">
                                                            <input type="text"
                                                                class="form-control form-control-sm border-0 border-bottom border-dark"
                                                                name="lain_ba_bongkar" />
                                                        </div>
                                                    </div>

                                                    <!-- 11. Keterangan -->
                                                    <div class="row mb-2 align-items-center text-black">
                                                        <div class="col-5">
                                                            <span>11. Keterangan</span>
                                                        </div>
                                                        <div class="col-1 text-center">:</div>
                                                        <div class="col-6">
                                                            <input type="text"
                                                                class="form-control form-control-sm border-0 border-bottom border-dark"
                                                                name="keterangan_ba_bongkar" />
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- Signature Section -->
                                                <div class="row mt-5 text-black">
                                                    <div class="col-6">
                                                        <p class="mb-0">Mengetahui,</p>
                                                        <p>Agen Pengangkut/Kuasanya*,</p>
                                                        <div class="mt-5"></div>
                                                        <div class="d-flex justify-content-start mb-3">
                                                            <div style="width: 70%;">
                                                                <input type="text"
                                                                    class="form-control form-control-sm border-0 border-bottom border-dark"
                                                                    name="agen_ba_bongkar" />
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-6">
                                                        <label for="pejabat_pemeriksa_barang" class="form-label">Pejabat
                                                            Pemeriksa Barang</label>
                                                        <select class="form-control form-select select2"
                                                            name="pejabat_pemeriksa_barang" id="pejabat_pemeriksa_barang">
                                                            <option value="" selected disabled>- Pilih -</option>
                                                            @foreach ($users as $user)
                                                                <option value="{{ $user->id_admin }}">
                                                                    {{ $user->name }} | {{ $user->jabatan }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>

                                                </div>

                                                <!-- Footer -->
                                                <div class="mt-3">
                                                    <p class="text-start text-black small">*Coret yang tidak perlu.</p>
                                                </div>
                                            </div>

                                        </div>


                                        <div class="tab-pane fade" id="navtabs2-lpt" role="tabpanel">
                                            <div class="container mt-4">
                                                <!-- Header dengan Logo dan Teks -->
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

                                                <!-- Judul Form -->
                                                <div class="text-center mt-4 mb-4">
                                                    <h5 class="fw-bold">LAPORAN PELAKSANAAN TUGAS</h5>
                                                </div>

                                                <!-- Form Fields -->
                                                <div class="mt-3">
                                                    <!-- Surat Tugas No -->
                                                    <div class="row mb-2 align-items-center">
                                                        <div class="col-3">
                                                            <span>Surat Tugas No</span>
                                                        </div>
                                                        <div class="col-9">
                                                            <input type="text"
                                                                class="form-control form-control-sm border-0 border-bottom border-dark"
                                                                name="surat_tugas_nomor_ba_bongkar_lpt"
                                                                value="{{ $data['formatPrint'] ?? '' }}">
                                                        </div>

                                                    </div>

                                                    <!-- Petugas -->
                                                    <div class="row mb-2 align-items-center">
                                                        <div class="col-3">
                                                            <span>Petugas</span>
                                                        </div>
                                                        <div class="col-9">
                                                            <select class="form-control form-select select2"
                                                                name="petugas_ba_bongkar_lpt">
                                                                <option value="" selected disabled>- Pilih -</option>
                                                                @foreach ($users as $user)
                                                                    <option value="{{ $user->id_admin }}">
                                                                        {{ $user->name }} | {{ $user->jabatan }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>


                                                    <!-- Hari / Tanggal Pemeriksaan -->
                                                    <div class="row mb-2 align-items-center">
                                                        <div class="col-3">
                                                            <span>Hari / Tanggal Pemeriksaan</span>
                                                        </div>
                                                        <div class="col-9">
                                                            <input type="date"
                                                                class="form-control form-control-sm border-0 border-bottom border-dark"
                                                                name="hari_tanggal_pemeriksaan_ba_bongkar_lpt" />
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- KETERANGAN Section -->
                                                <div class="mt-4">
                                                    <div class="text-center mb-2">
                                                        <span class="fw-bold">KETERANGAN</span>
                                                    </div>
                                                    <div class="border border-dark p-2" style="height: 300px;">
                                                        <!-- Area untuk keterangan/catatan -->
                                                        <textarea name="keterangan_ba_bongkar_lpt" class="form-control border-0 h-100" style="resize: none;"
                                                            placeholder="Tulis keterangan di sini..."></textarea>
                                                    </div>
                                                </div>


                                                <!-- Signature Section -->
                                                <div class="row mt-4">
                                                    <div class="col-12 text-end">
                                                        <p>Petugas</p>
                                                        <div class="mt-5"></div>
                                                        <p class="mb-0">................................</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="tab-pane fade" id="navtabs2-lpp" role="tabpanel">
                                            <div class="container mt-4">
                                                <!-- Header dengan Logo dan Teks -->
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

                                                <!-- Judul Form -->
                                                <div class="text-center mt-3 mb-3">
                                                    <h5 class="fw-bold text-decoration-underline">LAPORAN PENGAWASAN
                                                        PEMBONGKARAN</h5>
                                                    <p class="text-end">BCL 1.2</p>
                                                </div>

                                                <!-- Form Fields -->
                                                <div class="mt-3">
                                                    <!-- Lokasi -->
                                                    <div class="row mb-2 align-items-center">
                                                        <div class="col-3">
                                                            <span>Lokasi</span>
                                                        </div>
                                                        <div class="col-9">
                                                            <input type="text"
                                                                class="form-control form-control-sm border-0 border-bottom border-dark" name="lokasi_lpp_ba_bongkar" />
                                                        </div>
                                                    </div>

                                                    <!-- Tanggal Pengawasan -->
                                                    <div class="row mb-2 align-items-center">
                                                        <div class="col-3">
                                                            <span>Tanggal Pengawasan</span>
                                                        </div>
                                                        <div class="col-9">
                                                            <input type="date"
                                                                class="form-control form-control-sm border-0 border-bottom border-dark" name="tanggal_pengawasan_lpp_ba_bongkar">
                                                        </div>
                                                    </div>

                                                    <!-- Waktu Pengawasan -->
                                                    <div class="row mb-2 align-items-center">
                                                        <div class="col-3">
                                                            <span>Waktu Pengawasan</span>
                                                        </div>
                                                        <div class="col-9">
                                                            <input type="time"
                                                                class="form-control form-control-sm border-0 border-bottom border-dark" name="waktu_pengawasan_lpp_ba_bongkar" />
                                                        </div>
                                                    </div>

                                                    <!-- Nama Sarana Pengangkut -->
                                                    <div class="row mb-2 align-items-center">
                                                        <div class="col-3">
                                                            <span>Nama Sarana Pengangkut</span>
                                                        </div>
                                                        <div class="col-9">
                                                            <input type="text"
                                                                class="form-control form-control-sm border-0 border-bottom border-dark" name="nama_sarkut_lpp_ba_bongkar" />
                                                        </div>
                                                    </div>

                                                    <!-- No Voyage / Flight -->
                                                    <div class="row mb-2 align-items-center">
                                                        <div class="col-3">
                                                            <span>No Voyage / Flight</span>
                                                        </div>
                                                        <div class="col-9">
                                                            <input type="text"
                                                                class="form-control form-control-sm border-0 border-bottom border-dark"
                                                                name="no_flight_lpp_ba_bongkar">
                                                        </div>
                                                    </div>

                                                    <!-- Nama Pengangkut -->
                                                    <div class="row mb-2 align-items-center">
                                                        <div class="col-3">
                                                            <span>Nama Pengangkut</span>
                                                        </div>
                                                        <div class="col-9">
                                                            <input type="text"
                                                                class="form-control form-control-sm border-0 border-bottom border-dark" name="nama_pengangkut_lpp_ba_bongkar" />
                                                        </div>
                                                    </div>

                                                    <!-- Pelabuhan Asal -->
                                                    <div class="row mb-2 align-items-center">
                                                        <div class="col-3">
                                                            <span>Pelabuhan Asal</span>
                                                        </div>
                                                        <div class="col-9">
                                                            <input type="text"
                                                                class="form-control form-control-sm border-0 border-bottom border-dark" name="pelabuhan_asal_lpp_ba_bongkar" />
                                                        </div>
                                                    </div>

                                                    <!-- Tanggal Kedatangan -->
                                                    <div class="row mb-2 align-items-center">
                                                        <div class="col-3">
                                                            <span>Tanggal Kedatangan</span>
                                                        </div>
                                                        <div class="col-9">
                                                            <input type="date"
                                                                class="form-control form-control-sm border-0 border-bottom border-dark" name="tanggal_kedatangan_lpp_ba_bongkar" />
                                                        </div>
                                                    </div>

                                                    <!-- Nomor / Tanggal BC 1.1 -->
                                                    <div class="row mb-2 align-items-center">
                                                        <div class="col-3">
                                                            <span>Nomor / Tanggal BC 1.1</span>
                                                        </div>
                                                        <div class="col-9">
                                                            <input type="text"
                                                                class="form-control form-control-sm border-0 border-bottom border-dark" name="nomor_tanggal_bc_lpp_ba_bongkar" />
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- Table -->
                                                <div class="col-12 mt-5">
                                                    <div class="card">
                                                        <div
                                                            class="card-body table-responsive shadow p-3 mb-5 bg-white rounded">
                                                            <button type="button"
                                                                class="btn btn-soft-info btn-icon btn-sm rounded-pill"
                                                                data-bs-toggle="modal"
                                                                data-bs-target=".bs-example-modal-lg">
                                                                <i data-feather="plus-circle" class="icon-sm"></i> Tambah
                                                                Data
                                                            </button>
                                                            <table class="table table-hover align-middle border-separate"
                                                                style="border-spacing: 0 8px;">
                                                                <thead>
                                                                    <tr class="bg-light">
                                                                        <th class="text-center px-3 py-3"
                                                                            style="width: 5%">No</th>
                                                                        <th class="px-3 text-center py-3"
                                                                            style="width: 20%">Jenis Kemasan</th>
                                                                        <th class="px-3 text-center py-3"
                                                                            style="width: 15%">Jumlah Kemasan</th>
                                                                        <th class="px-3 text-center py-3"
                                                                            style="width: 15%">Dilaporkan</th>
                                                                        <th class="px-3 text-center py-3"
                                                                            style="width: 15%">Dibongkar</th>
                                                                        <th class="px-3 text-center py-3"
                                                                            style="width: 15%">Selisih</th>
                                                                        <th class="px-3 text-center py-3"
                                                                            style="width: 15%">Keterangan</th>
                                                                        <th class="text-center px-3 py-3"
                                                                            style="width: 15%">Opsi</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody align="center" id="tableBody">
                                                                    <!-- Data akan ditampilkan di sini -->
                                                                </tbody>
                                                            </table>

                                                            <!-- Modal Form Input -->
                                                            <div class="modal fade bs-example-modal-lg" tabindex="-1"
                                                                role="dialog" aria-labelledby="myLargeModalLabel"
                                                                aria-hidden="true">
                                                                <div class="modal-dialog modal-dialog-centered modal-lg">
                                                                    <div class="modal-content">
                                                                        <!-- Modal Header -->
                                                                        <div
                                                                            class="modal-header bg-primary text-white border-bottom-0">
                                                                            <i data-feather="package"
                                                                                class="icon-lg"></i>&nbsp;&nbsp;
                                                                            <h5 class="modal-title"
                                                                                id="exampleModalLabel">Tambah Data Kemasan
                                                                            </h5>
                                                                            <button type="button"
                                                                                class="btn-close btn-close-white"
                                                                                data-bs-dismiss="modal"
                                                                                aria-label="Close"></button>
                                                                        </div>

                                                                        <!-- Modal Body -->
                                                                        <div class="modal-body p-4"
                                                                            style="max-height: 65vh; overflow-y: auto;">
                                                                            <form id="kemasanForm">
                                                                                <h6><b>Data Kemasan</b></h6>
                                                                                <hr>
                                                                                <div class="mb-3">
                                                                                    <label class="form-label fw-bold">Jenis
                                                                                        Kemasan</label>
                                                                                    <input type="text"
                                                                                        class="form-control"
                                                                                        name="jenis_kemasan"
                                                                                        id="jenis_kemasan"
                                                                                        placeholder="Masukkan jenis kemasan">
                                                                                </div>
                                                                                <div class="mb-3">
                                                                                    <label
                                                                                        class="form-label fw-bold">Jumlah
                                                                                        Kemasan</label>
                                                                                    <input type="number"
                                                                                        class="form-control"
                                                                                        name="jumlah_kemasan"
                                                                                        id="jumlah_kemasan"
                                                                                        placeholder="Masukkan jumlah kemasan">
                                                                                </div>
                                                                                <div class="mb-3">
                                                                                    <label
                                                                                        class="form-label fw-bold">Dilaporkan</label>
                                                                                    <input type="number"
                                                                                        class="form-control"
                                                                                        name="dilaporkan" id="dilaporkan"
                                                                                        placeholder="Masukkan jumlah yang dilaporkan">
                                                                                </div>
                                                                                <div class="mb-3">
                                                                                    <label
                                                                                        class="form-label fw-bold">Dibongkar</label>
                                                                                    <input type="number"
                                                                                        class="form-control"
                                                                                        name="dibongkar" id="dibongkar"
                                                                                        placeholder="Masukkan jumlah yang dibongkar">
                                                                                </div>
                                                                                <div class="mb-3">
                                                                                    <label
                                                                                        class="form-label fw-bold">Selisih</label>
                                                                                    <input type="number"
                                                                                        class="form-control"
                                                                                        name="selisih" id="selisih"
                                                                                        readonly>
                                                                                </div>
                                                                                <div class="mb-3">
                                                                                    <label
                                                                                        class="form-label fw-bold">Keterangan</label>
                                                                                    <textarea class="form-control" name="keterangan" id="keterangan" rows="3"
                                                                                        placeholder="Masukkan keterangan tambahan"></textarea>
                                                                                </div>
                                                                            </form>
                                                                        </div>


                                                                        <!-- Modal Footer -->
                                                                        <div class="modal-footer border-top-0 bg-light">
                                                                            <button type="button"
                                                                                class="btn btn-outline-danger"
                                                                                data-bs-dismiss="modal">Tutup</button>
                                                                            <button type="button"
                                                                                class="btn btn-outline-primary"
                                                                                id="btnSimpan">
                                                                                <span id="buttonText">Simpan</span>
                                                                                <span id="buttonSpinner"
                                                                                    class="spinner-border spinner-border-sm d-none"
                                                                                    role="status"
                                                                                    aria-hidden="true"></span>
                                                                            </button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="modal fade" id="editKemasanModal" tabindex="-1"
                                                    role="dialog" aria-labelledby="editKemasanModalLabel"
                                                    aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered modal-lg">
                                                        <div class="modal-content">
                                                            <!-- Modal Header -->
                                                            <div
                                                                class="modal-header bg-primary text-white border-bottom-0">
                                                                <i data-feather="edit" class="icon-lg"></i>&nbsp;&nbsp;
                                                                <h5 class="modal-title" id="editKemasanModalLabel">Edit
                                                                    Data Kemasan</h5>
                                                                <button type="button" class="btn-close btn-close-white"
                                                                    data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>

                                                            <!-- Modal Body -->
                                                            <div class="modal-body p-4"
                                                                style="max-height: 65vh; overflow-y: auto;">
                                                                <form id="editKemasanForm">
                                                                    <input type="hidden" id="edit_id_ba_bongkar"
                                                                        name="edit_id_ba_bongkar">
                                                                    <h6><b>Data Kemasan</b></h6>
                                                                    <hr>
                                                                    <div class="mb-3">
                                                                        <label class="form-label fw-bold">Jenis
                                                                            Kemasan</label>
                                                                        <input type="text" class="form-control"
                                                                            name="edit_jenis_kemasan"
                                                                            id="edit_jenis_kemasan"
                                                                            placeholder="Masukkan jenis kemasan">
                                                                    </div>
                                                                    <div class="mb-3">
                                                                        <label class="form-label fw-bold">Jumlah
                                                                            Kemasan</label>
                                                                        <input type="number" class="form-control"
                                                                            name="edit_jumlah_kemasan"
                                                                            id="edit_jumlah_kemasan"
                                                                            placeholder="Masukkan jumlah kemasan">
                                                                    </div>
                                                                    <div class="mb-3">
                                                                        <label
                                                                            class="form-label fw-bold">Dilaporkan</label>
                                                                        <input type="number" class="form-control"
                                                                            name="edit_dilaporkan" id="edit_dilaporkan"
                                                                            placeholder="Masukkan jumlah yang dilaporkan"
                                                                            onchange="hitungSelisihEdit()">
                                                                    </div>
                                                                    <div class="mb-3">
                                                                        <label class="form-label fw-bold">Dibongkar</label>
                                                                        <input type="number" class="form-control"
                                                                            name="edit_dibongkar" id="edit_dibongkar"
                                                                            placeholder="Masukkan jumlah yang dibongkar"
                                                                            onchange="hitungSelisihEdit()">
                                                                    </div>
                                                                    <div class="mb-3">
                                                                        <label class="form-label fw-bold">Selisih</label>
                                                                        <input type="number" class="form-control"
                                                                            name="edit_selisih" id="edit_selisih"
                                                                            readonly>
                                                                    </div>
                                                                    <div class="mb-3">
                                                                        <label
                                                                            class="form-label fw-bold">Keterangan</label>
                                                                        <textarea class="form-control" name="edit_keterangan" id="edit_keterangan" rows="3"
                                                                            placeholder="Masukkan keterangan tambahan"></textarea>
                                                                    </div>
                                                                </form>
                                                            </div>

                                                            <!-- Modal Footer -->
                                                            <div class="modal-footer border-top-0 bg-light">
                                                                <button type="button" class="btn btn-outline-danger"
                                                                    data-bs-dismiss="modal">Tutup</button>
                                                                <button type="button" class="btn btn-outline-primary"
                                                                    id="updateKemasanBtn">
                                                                    <span id="updateButtonText">Update</span>
                                                                    <span id="updateButtonSpinner"
                                                                        class="spinner-border spinner-border-sm d-none"
                                                                        role="status" aria-hidden="true"></span>
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- Signature Section -->
                                                <div class="row mt-4">
                                                    <div class="col-6">
                                                        <p class="mb-0 small">* Waktu Berlaku</p>
                                                        <p class="mb-0 small">* Waktu Aktual</p>
                                                        <p class="mb-0 small">* Coret yang tidak perlu</p>
                                                    </div>
                                                    <div class="col-6 text-center">
                                                        <p class="mb-0">Batam, tanggal ................................
                                                        </p>
                                                        <p class="mb-0">Pejabat yang mengawasi pembongkaran dan
                                                            pemindahan</p>
                                                        <div class="mt-5"></div>
                                                        <p class="mb-0">Tanda Tangan : ................................
                                                        </p>
                                                        <p class="mb-0">Nama : ................................</p>
                                                        <p class="mb-0">NIP : ................................</p>
                                                        <div class="mt-3">
                                                            <label for="pejabat_mengawasi_bongkar" class="form-label">Pilih
                                                                Pejabat</label>
                                                            <select class="form-control form-select select2"
                                                                name="pejabat_mengawasi_bongkar"
                                                                id="pejabat_mengawasi_bongkar">
                                                                <option value="" selected disabled>- Pilih Pejabat -
                                                                </option>
                                                                @foreach ($users as $user)
                                                                    <option value="{{ $user->id_admin }}">
                                                                        {{ $user->name }} | {{ $user->jabatan }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>

                                        </div>


                                        <div class="card-footer d-flex justify-content-end">
                                            <button type="submit" class="btn btn-success btn-sm me-2">
                                                <i data-feather="save"></i> Simpan Data Pengawasan Bongkar
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

    <script>
        // Fungsi untuk menghasilkan ID unik
        function generateUniqueID() {
            const timestamp = Date.now();
            const randomNum = Math.floor(Math.random() * 1000000);
            return `id_ba_bongkar${timestamp}_${randomNum}`;
        }

        document.addEventListener('DOMContentLoaded', function() {
            // Inisialisasi Feather Icons
            feather.replace();

            // Ambil input ID Kemasan
            const idBaBongkarInput = document.getElementById('id_ba_bongkar');
            if (idBaBongkarInput) {
                idBaBongkarInput.value = generateUniqueID(); // Jika ID Kemasan tidak ada, buat ID baru
            }

            // Hitung selisih otomatis ketika nilai dibongkar atau dilaporkan berubah
            document.getElementById('dilaporkan').addEventListener('input', hitungSelisih);
            document.getElementById('dibongkar').addEventListener('input', hitungSelisih);

            // Ambil tombol simpan dan elemen-elemen lainnya
            const btnSimpan = document.getElementById('btnSimpan');
            const buttonText = document.getElementById('buttonText');
            const buttonSpinner = document.getElementById('buttonSpinner');

            // Ketika tombol simpan diklik
            $('#btnSimpan').on('click', function(e) {
                e.preventDefault();

                // Nonaktifkan tombol dan tampilkan animasi loading
                btnSimpan.disabled = true;
                buttonSpinner.classList.remove('d-none');
                buttonText.textContent = 'Tunggu...';

                // Ambil data dari form
                var formData = {
                    'id_ba_bongkar': idBaBongkarInput ? idBaBongkarInput.value : '',
                    'jenis_kemasan': $('#jenis_kemasan').val(),
                    'jumlah_kemasan': $('#jumlah_kemasan').val(),
                    'dilaporkan': $('#dilaporkan').val(),
                    'dibongkar': $('#dibongkar').val(),
                    'selisih': $('#selisih').val(),
                    'keterangan': $('#keterangan').val()
                };

                // Kirim data ke server menggunakan AJAX
                $.ajax({
                    url: '/Pengawasanlain/kemasan', // Ganti dengan route yang sesuai untuk menyimpan data
                    type: 'POST',
                    data: formData,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        console.log('Data berhasil dikirim:', response);
                        alert('Data berhasil disimpan!');

                        // Reset data input form setelah berhasil disimpan
                        $('#jenis_kemasan').val('');
                        $('#jumlah_kemasan').val('');
                        $('#dilaporkan').val('');
                        $('#dibongkar').val('');
                        $('#selisih').val('');
                        $('#keterangan').val('');

                        // Tutup modal
                        $('.bs-example-modal-lg').modal('hide');

                        // Panggil fungsi untuk update tabel real-time
                        loadData(idBaBongkarInput.value); // Panggil dengan id_ba_bongkar
                    },
                    error: function(xhr, status, error) {
                        console.error('Kesalahan:', error);
                        alert('Terjadi kesalahan saat mengirim data.');
                    },
                    complete: function() {
                        // Aktifkan kembali tombol dan sembunyikan animasi loading
                        btnSimpan.disabled = false;
                        buttonSpinner.classList.add('d-none');
                        buttonText.textContent = 'Simpan';
                    }
                });
            });

            // Event listener untuk tombol edit
            document.addEventListener('click', function(e) {
                if (e.target.closest('.edit-btn')) {
                    e.preventDefault();
                    const itemId = e.target.closest('.edit-btn').getAttribute('data-id');

                    if (!itemId) {
                        alert('ID item tidak ditemukan');
                        return;
                    }

                    console.log('Edit button clicked, item ID:', itemId);

                    // Fetch item details for editing
                    $.ajax({
                        url: `/Pengawasanlain/kemasan/${itemId}/edit`,
                        type: 'GET',
                        success: function(response) {

                            console.log('Response type:', typeof response);
                            console.log('Full response:', response);

                            // Pengecekan response valid
                            if (!response || typeof response !== 'object') {
                                console.error('Invalid response received');
                                alert('Data yang diterima tidak valid');
                                return;
                            }
                            // Populate hidden ID field
                            $('#edit_id_ba_bongkar').val(response.id);

                            // Populate form fields
                            $('#edit_jenis_kemasan').val(response.jenis_kemasan);
                            $('#edit_jumlah_kemasan').val(response.jumlah_kemasan);
                            $('#edit_dilaporkan').val(response.dilaporkan);
                            $('#edit_dibongkar').val(response.dibongkar);
                            $('#edit_selisih').val(response.selisih);
                            $('#edit_keterangan').val(response.keterangan);

                            // Show the edit modal
                            var editModal = new bootstrap.Modal(document.getElementById(
                                'editKemasanModal'));
                            editModal.show();
                        },
                        error: function(xhr, status, error) {
                            console.error('Error fetching item details:', error);
                            alert('Gagal mengambil data untuk diedit.');
                        }
                    });
                }
            });

            // Update button event
            $('#updateKemasanBtn').on('click', function() {
                const itemId = $('#edit_id_ba_bongkar').val();

                if (!itemId) {
                    alert('ID tidak valid');
                    return;
                }

                const formData = {
                    'id_ba_bongkar': $('#id_ba_bongkar').val(),
                    'jenis_kemasan': $('#edit_jenis_kemasan').val(),
                    'jumlah_kemasan': $('#edit_jumlah_kemasan').val(),
                    'dilaporkan': $('#edit_dilaporkan').val(),
                    'dibongkar': $('#edit_dibongkar').val(),
                    'selisih': $('#edit_selisih').val(),
                    'keterangan': $('#edit_keterangan').val()
                };

                // Show loading spinner
                const updateButton = $(this);
                const buttonSpinner = $('#updateButtonSpinner');
                updateButton.prop('disabled', true);
                buttonSpinner.removeClass('d-none');

                // Get kemasan ID
                const idBaBongkar = $('#id_ba_bongkar').val();

                $.ajax({
                    url: `/Pengawasanlain/kemasan/${itemId}`,
                    type: 'PUT',
                    data: formData,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        if (response.success) {
                            alert('Data berhasil diupdate!');

                            // Close modal
                            $('#editKemasanModal').modal('hide');

                            // Reload data
                            loadData(idBaBongkar);
                        } else {
                            alert('Gagal mengupdate data.');
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('Error:', error);
                        alert('Terjadi kesalahan saat mengupdate data.');
                    },
                    complete: function() {
                        // Restore button state
                        updateButton.prop('disabled', false);
                        buttonSpinner.addClass('d-none');
                    }
                });
            });

            // Event listener untuk tombol delete
            document.addEventListener('click', function(e) {
                if (e.target.closest('.delete-btn')) {
                    e.preventDefault();
                    const itemId = e.target.closest('.delete-btn').getAttribute('data-id');
                    // Get the kemasan ID from a more reliable source
                    const idBaBongkar = document.getElementById('id_ba_bongkar').value;

                    if (confirm('Apakah Anda yakin ingin menghapus data ini?')) {
                        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute(
                            'content');

                        fetch(`/Pengawasanlain/kemasan/${itemId}`, {
                                method: 'DELETE',
                                headers: {
                                    'X-CSRF-TOKEN': csrfToken,
                                    'Content-Type': 'application/json',
                                }
                            })
                            .then(response => response.json())
                            .then(data => {
                                if (data.success) {
                                    alert('Data berhasil dihapus!');
                                    // Pass the kemasan ID here
                                    loadData(idBaBongkar);
                                } else {
                                    alert('Terjadi kesalahan saat menghapus data.');
                                }
                            })
                            .catch(error => {
                                console.error('Kesalahan:', error);
                                alert('Terjadi kesalahan saat menghapus data.');
                            });
                    }
                }
            });

            // Memuat data awal jika ada
            const idBaBongkar = idBaBongkarInput ? idBaBongkarInput.value : '';
            loadData(idBaBongkar);
        });

        // Fungsi untuk menghitung selisih
        function hitungSelisih() {
            const dilaporkan = parseInt(document.getElementById('dilaporkan').value) || 0;
            const dibongkar = parseInt(document.getElementById('dibongkar').value) || 0;
            const selisih = dilaporkan - dibongkar;
            document.getElementById('selisih').value = selisih;
        }

        // Fungsi untuk menghitung selisih dalam form edit
        function hitungSelisihEdit() {
            const dilaporkan = parseInt(document.getElementById('edit_dilaporkan').value) || 0;
            const dibongkar = parseInt(document.getElementById('edit_dibongkar').value) || 0;
            // Pastikan ini sudah ada di event listener DOMContentLoaded Anda
            document.getElementById('edit_dilaporkan').addEventListener('input', hitungSelisihEdit);
            document.getElementById('edit_dibongkar').addEventListener('input', hitungSelisihEdit);
            const selisih = dilaporkan - dibongkar;
            document.getElementById('edit_selisih').value = selisih;
        }

        // Fungsi untuk memuat data tabel secara real-time
        function loadData(idBaBongkar) {
            $.ajax({
                url: '/Pengawasanlain/kemasan', // Ganti dengan route yang sesuai untuk mengambil data
                type: 'GET',
                data: {
                    'id_ba_bongkar': idBaBongkar
                }, // Kirimkan id_ba_bongkar ke server
                success: function(response) {
                    $('#tableBody').empty();

                    if (response.data && response.data.length > 0) {
                        response.data.forEach(function(item, index) {
                            $('#tableBody').append(`
                    <tr class="shadow-sm">
                        <td class="text-center fw-medium">${index + 1}</td>
                        <td class="fw-medium">${item.jenis_kemasan || '-'}</td>
                        <td class="fw-medium">${item.jumlah_kemasan || '-'}</td>
                        <td class="fw-medium">${item.dilaporkan || '-'}</td>
                        <td class="fw-medium">${item.dibongkar || '-'}</td>
                        <td class="fw-medium">${item.selisih || '-'}</td>
                        <td class="fw-medium">${item.keterangan || '-'}</td>
                        <td>
                            <div class="d-flex gap-1 justify-content-center">
                                <a href="#" class="btn btn-soft-success btn-icon btn-sm rounded-pill edit-btn" data-id="${item.id}">
                                    <i data-feather="edit" class="icon-sm"></i> Edit
                                </a>
                                <button type="button" class="btn btn-soft-danger btn-icon btn-sm rounded-pill delete-btn" data-id="${item.id}">
                                    <i data-feather="trash" class="icon-sm"></i> Delete
                                </button>
                            </div>
                        </td>
                    </tr>
                    `);
                        });
                        // Reinitialize Feather Icons untuk ikon-ikon baru
                        feather.replace();
                    } else {
                        $('#tableBody').append(
                            '<tr><td colspan="8" class="text-center">Data tidak ditemukan</td></tr>');
                    }
                },
                error: function(xhr, status, error) {
                    console.error('Kesalahan:', error);
                    alert('Terjadi kesalahan saat memuat data.');
                }
            });
        }
    </script>


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
@endsection

@section('script')
    @vite(['resources/js/pages/datatable.init.js'])
@endsection
