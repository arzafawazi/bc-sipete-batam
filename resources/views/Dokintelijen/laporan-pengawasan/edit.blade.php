@extends('layouts.vertical', ['title' => 'Rekam Laporan Pengawasan'])

@section('css')
    @vite(['node_modules/datatables.net-bs5/css/dataTables.bootstrap5.min.css', 'node_modules/datatables.net-buttons-bs5/css/buttons.bootstrap5.min.css', 'node_modules/datatables.net-keytable-bs5/css/keyTable.bootstrap5.min.css', 'node_modules/datatables.net-responsive-bs5/css/responsive.bootstrap5.min.css', 'node_modules/datatables.net-select-bs5/css/select.bootstrap5.min.css'])
@endsection

@section('content')
    <div class="container-fluid ">
        <form action="{{ route('laporan-pengawasan.update', ['laporan_pengawasan' => $pengawasan->id]) }}"
            enctype="multipart/form-data" method="POST">
            @csrf
            @method('PUT')
            <!-- Card Container -->
            <div class="card mb-3 mt-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="card-title mb-0">
                        <i data-feather="book" style="width: 20px; height: 20px;" class="me-1"></i>
                        Form Laporan Pengawasan Intelijen
                    </h5>
                    <!-- Tombol Kembali -->
                    <button type="button" class="btn btn-danger btn-sm" onclick="window.history.back()">
                        <i data-feather="log-out"></i> Kembali
                    </button>
                </div>





                <div class="card-body">
                    <div class="row">
                        <!-- Left Column (Sections A and B) -->
                        <div class="col-xl-12">
                            <div class="card">

                                <div class="tabs-container" id="tabs-container">
                                    <ul class="nav nav-pills nav-justified flex-nowrap overflow-auto bg-light p-2 rounded shadow-sm"
                                        style="white-space: nowrap;" role="tablist">
                                        <li class="nav-item">
                                            <a class="nav-link active" id="st1-tab" data-bs-toggle="tab" href="#st1"
                                                role="tab" aria-controls="st1" aria-selected="true">
                                                <span class="d-block d-sm-none">(ST-I)</span>
                                                <span class="d-none d-sm-block">(ST-I)</span>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="lpti-tab" data-bs-toggle="tab" href="#lpti"
                                                role="tab" aria-controls="lpti" aria-selected="false">
                                                <span class="d-block d-sm-none">LPT-I</span>
                                                <span class="d-none d-sm-block">LPT-I</span>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="lppi-tab" data-bs-toggle="tab" href="#lppi"
                                                role="tab" aria-controls="lppi" aria-selected="false">
                                                <span class="d-block d-sm-none">LPPI-I</span>
                                                <span class="d-none d-sm-block">LPPI-I</span>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="lkai-tab" data-bs-toggle="tab" href="#lkai"
                                                role="tab" aria-controls="lkai" aria-selected="false">
                                                <span class="d-block d-sm-none">LKAI</span>
                                                <span class="d-none d-sm-block">LKAI</span>
                                            </a>
                                        </li>
                                        <li class="nav-item" id="nhi-tab-item" style="display: none;">
                                            <a class="nav-link" id="nhi-tab" data-bs-toggle="tab" href="#nhi"
                                                role="tab" aria-controls="nhi" aria-selected="false">
                                                <span class="d-block d-sm-none">NHI/NHI-HKI</span>
                                                <span class="d-none d-sm-block">NHI/NHI-HKI</span>
                                            </a>
                                        </li>
                                        <li class="nav-item" id="ni-tab-item" style="display: none;">
                                            <a class="nav-link" id="ni-tab" data-bs-toggle="tab" href="#ni"
                                                role="tab" aria-controls="ni" aria-selected="false">
                                                <span class="d-block d-sm-none">NI</span>
                                                <span class="d-none d-sm-block">NI</span>
                                            </a>
                                        </li>
                                        <li class="nav-item" id="nota-dinas-tab-item" style="display: none;">
                                            <a class="nav-link" id="nota-dinas-tab" data-bs-toggle="tab"
                                                href="#nota-dinas-content" role="tab" aria-controls="nota-dinas-content"
                                                aria-selected="false">
                                                <span class="d-block d-sm-none">Nota Dinas</span>
                                                <span class="d-none d-sm-block">Nota Dinas</span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>

                                <div class="tab-content p-3 text-muted">
                                    <div class="tab-pane fade show active" id="st1" role="tabpanel"
                                        aria-labelledby="st1-tab">
                                        <div class="container mt-4">
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

                                            <hr class="border border-dark border-2 bg-dark">

                                            <div class="text-center mb-4">
                                                <h5 class="fw-bold">Surat Tugas</h5>
                                                <div class="input-group flex-wrap">
                                                    <span class="input-group-text">NO : Surat Tugas-</span>
                                                    <input type="text" class="form-control" name="no_st">
                                                    <input type="date" class="form-control" name="tgl_st">
                                                </div>
                                            </div>

                                            <!-- Main Form -->
                                            <div class="card">
                                                <p class="fw-bold">
                                                    Dalam rangka pelaksanaan Undang-Undang Nomor 10 Tahun 1995 tentang
                                                    Kepabeanan
                                                    jo. Undang-Undang Nomor 17 Tahun 2006 dan Undang-Undang Nomor 11 Tahun
                                                    1995 tentang
                                                    Cukai jo. Undang-Undang Nomor 7 Tahun 2021, kami pejabat yang bertanda
                                                    tangan di bawah
                                                    ini memberi tugas kepada:
                                                </p>
                                                <div class="card-body">
                                                    <div class="row">
                                                        <!-- Left Column -->
                                                        <div class="col-lg-6 ">

                                                            <hr class="mb-4">

                                                            <div class="row">


                                                                <div class="col-12 mb-3">
                                                                    <label class="form-label fw-semibold">Pengendali
                                                                        Operasi</label>
                                                                    <select class="form-control form-select select2"
                                                                        id="pengendali_operasi"
                                                                        name="pengendali_operasi_st">
                                                                        <option value="" disabled
                                                                            {{ old('pengendali_operasi_st', $pengawasan->pengendali_operasi_st) == '' ? 'selected' : '' }}>
                                                                            - Pilih -</option>
                                                                        @foreach ($users as $user)
                                                                            <option value="{{ $user->id_admin }}"
                                                                                {{ old('pengendali_operasi_st', $pengawasan->pengendali_operasi_st) == $user->id_admin ? 'selected' : '' }}>
                                                                                {{ $user->name }}
                                                                            </option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>


                                                                <div class="col-12 mb-3">
                                                                    <label class="form-label fw-semibold">Tim
                                                                        Operasi</label>
                                                                    <select class="form-control form-select select2"
                                                                        id="tim_operasi" name="tim_operasi_st[]" multiple>
                                                                        @foreach ($users as $user)
                                                                            <option value="{{ $user->id_admin }}"
                                                                                {{ in_array($user->id_admin, old('tim_operasi_st', json_decode($pengawasan->tim_operasi_st ?? '[]'))) ? 'selected' : '' }}>
                                                                                {{ $user->name }}
                                                                            </option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>



                                                                <div class="col-12 mb-3">
                                                                    <label class="form-label fw-semibold">Tim Dukungan
                                                                        Operasi</label>
                                                                    <select class="form-control form-select select2"
                                                                        id="tim_dukungan_operasi"
                                                                        name="tim_dukungan_operasi_st[]" multiple>
                                                                        @foreach ($users as $user)
                                                                            <option value="{{ $user->id_admin }}"
                                                                                {{ in_array($user->id_admin, old('tim_dukungan_operasi_st', json_decode($pengawasan->tim_dukungan_operasi_st ?? '[]', true))) ? 'selected' : '' }}>
                                                                                {{ $user->name }}
                                                                            </option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>

                                                            </div>
                                                            <hr class="mb-4">
                                                        </div>

                                                        <div class="card mb-3">
                                                            <div class="card-body">
                                                                <h6 class="fw-bold">Untuk melaksanakan tugas sebagai
                                                                    berikut:</h6>
                                                                <ol class="ps-3" start="2"
                                                                    style="line-height: 1.5;">
                                                                    <li class="mb-1">Melakukan penggalangan informan
                                                                        dalam hal diperlukan dalam proses pengumpulan dan
                                                                        pendalaman informasi.</li>
                                                                    <li class="mb-1">Melakukan tindakan pengamanan
                                                                        pertama apabila ditemukan adanya indikasi
                                                                        pelanggaran di bidang kepabeanan dan/atau cukai.
                                                                    </li>
                                                                    <li class="mb-1">Melakukan tindakan lainnya dan
                                                                        mengambil langkah-langkah sesuai peraturan
                                                                        perundangan guna mengamankan hak-hak negara, apabila
                                                                        dalam pelaksanaan tugas ditemukan adanya pelanggaran
                                                                        ketentuan dan/atau
                                                                        tindak pidana di bidang kepabeanan dan/atau cukai.
                                                                    </li>
                                                                    <li class="mb-1">Melakukan koordinasi dengan pihak
                                                                        eksternal atau Bidang Penindakan dan Penyidikan pada
                                                                        Kantor Wilayah (Kanwil) DJBC setempat apabila
                                                                        dipandang perlu.</li>
                                                                    <li class="mb-1">Membuat laporan pelaksanaan tugas.
                                                                    </li>
                                                                    <li class="mb-1">Melakukan tugas dan kewajiban sesuai
                                                                        dengan tugas pokok dan fungsinya masing-masing serta
                                                                        dilaksanakan dengan penuh rasa tanggung jawab.</li>
                                                                </ol>
                                                            </div>
                                                        </div>


                                                        <div class="mb-3">
                                                            <label
                                                                class="form-label fw-semibold d-flex align-items-center">
                                                                Melaksanakan Tugas
                                                                <button type="button" class="btn p-0 ms-1 text-primary"
                                                                    data-bs-toggle="tooltip" data-bs-placement="top"
                                                                    data-bs-custom-class="custom-tooltip"
                                                                    title="1.Isi Bagian Nomor 1 Pada inputan ini">
                                                                    <i data-feather="alert-circle"
                                                                        style="width: 18px; height: 18px;"></i>
                                                                </button>
                                                            </label>
                                                            <textarea class="form-control" name="melaksanakan_tugas_st" id="melaksanakan_tugas_st" rows="3"
                                                                placeholder="1.Isi Bagian Nomor 1 Pada inputan ini">{{ old('melaksanakan_tugas_st', $pengawasan->melaksanakan_tugas_st) }}</textarea>

                                                        </div>

                                                        <div class="card mb-3">
                                                            <div class="card-body">
                                                                <!-- Wilayah Penugasan -->
                                                                <div class="mb-3 row align-items-center">
                                                                    <label
                                                                        class="col-md-3 col-form-label fw-semibold text-md-start">Wilayah
                                                                        Penugasan :</label>
                                                                    <div class="col-md-8">
                                                                        <input type="text" class="form-control"
                                                                            name="wilayah_penugasan_st"
                                                                            placeholder="Wilayah Pengawasan KPU Bea dan Cukai Tipe B Batam"
                                                                            value="{{ old('wilayah_penugasan_st', $pengawasan->wilayah_penugasan_st) }}">

                                                                    </div>
                                                                </div>

                                                                <!-- Periode Penugasan (Tanggal Dimulai & Tanggal Berakhir dalam satu baris) -->
                                                                <div class="mb-3 row align-items-center">
                                                                    <label
                                                                        class="col-md-3 col-form-label fw-semibold text-md-start">
                                                                        Periode Penugasan :
                                                                    </label>
                                                                    <div class="col-md-4">
                                                                        <input type="date" class="form-control"
                                                                            name="tanggal_dimulai_st"
                                                                            value="{{ old('tanggal_dimulai_st', $pengawasan->tanggal_dimulai_st) }}">
                                                                    </div>
                                                                    <div class="col-md-1 text-center fw-semibold">s.d</div>
                                                                    <div class="col-md-4">
                                                                        <input type="date" class="form-control"
                                                                            name="tanggal_berakhir_st"
                                                                            value="{{ old('tanggal_berakhir_st', $pengawasan->tanggal_berakhir_st) }}">
                                                                    </div>
                                                                </div>


                                                                <!-- Ketentuan -->
                                                                <div class="mb-3 row">
                                                                    <label
                                                                        class="col-md-3 col-form-label fw-bold text-md-start">Ketentuan
                                                                        :</label>
                                                                    <div class="col-md-8">
                                                                        <ol class="mb-0 ps-3" start="1"
                                                                            style="line-height: 1.5;">
                                                                            <li class="mb-1">Surat Tugas ini bersifat
                                                                                rahasia dan terbatas untuk pihak yang
                                                                                berkepentingan;</li>
                                                                            <li class="mb-1">Sifat kegiatan intelijen
                                                                                tertutup/terbuka;</li>
                                                                            <li class="mb-1">Berpakaian PDH/non-PDH;</li>
                                                                            <li class="mb-1">Dapat dilengkapi dengan
                                                                                senjata api dinas.</li>
                                                                        </ol>
                                                                    </div>
                                                                </div>

                                                                <h6 class="fw-bold">&nbsp;&nbsp;&nbsp;Biaya yang digunakan
                                                                    untuk pelaksanaan surat tugas ini dibebankan pada DIPA
                                                                    ................ dan/atau DOKPPN.</h6>
                                                                <br>
                                                                <div class="mb-3 row align-items-center">
                                                                    <label
                                                                        class="col-md-3 col-form-label fw-semibold text-md-start">Nama
                                                                        Kantor Atau Unit :</label>
                                                                    <div class="col-md-8">
                                                                        <input type="text" class="form-control"
                                                                            name="nama_kantor_st"
                                                                            placeholder="Isi Titik-titik bagian atas untuk nomor kantor pada bagian ini"
                                                                            value="{{ old('nama_kantor_st', $pengawasan->nama_kantor_st) }}">

                                                                    </div>
                                                                </div>

                                                                <!-- Penerbit Surat Tugas -->
                                                                <div class="mb-3 row align-items-center">
                                                                    <label
                                                                        class="col-md-3 col-form-label fw-semibold text-md-start">Penerbit
                                                                        Surat Tugas :</label>
                                                                    <div class="col-md-8">
                                                                        <select class="form-control form-select select2"
                                                                            id="penerbit_surat_tugas" name="penerbit_st">
                                                                            <option value="" disabled
                                                                                {{ old('penerbit_st', $pengawasan->penerbit_st) == '' ? 'selected' : '' }}>
                                                                                - Pilih -</option>
                                                                            @foreach ($users as $user)
                                                                                <option value="{{ $user->id_admin }}"
                                                                                    {{ old('penerbit_st', $pengawasan->penerbit_st) == $user->id_admin ? 'selected' : '' }}>
                                                                                    {{ $user->name }}
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


                                    <div class="tab-pane" id="lpti" role="tabpanel">
                                        <div class="container-fluid my-4">
                                            <div class="card">
                                                <div class="card-body">
                                                    <div class="row mb-4 align-items-center">
                                                        <div class="col-2 text-center">
                                                            <img src="/images/logocop.png" alt="Logo"
                                                                class="img-fluid" style="max-height:170px;">
                                                        </div>
                                                        <div class="col-10 text-center">
                                                            <h5 class="mb-0">KEMENTERIAN KEUANGAN REPUBLIK INDONESIA</h5>
                                                            <p class="small mb-0">DIREKTORAT JENDERAL BEA DAN CUKAI</p>
                                                            <p class="small mb-0">KANTOR PELAYANAN UTAMA BEA DAN CUKAI TIPE
                                                                B BATAM
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

                                                    <div class="text-center mb-4">
                                                        <h5 class="fw-bold">LAPORAN PELAKSANAAN TUGAS</h5>
                                                        <div class="input-group flex-wrap">
                                                            <span class="input-group-text">NO : LPT-</span>
                                                            <input type="text" class="form-control" name="no_lpt"
                                                                value="{{ old('no_lpt', $pengawasan->no_lpt) }}" readonly>
                                                            <span class="input-group-text">/KPU.2061/</span>
                                                            <input type="date" class="form-control" name="tgl_lpt"
                                                                value="{{ old('tgl_lpt', $pengawasan->tgl_lpt) }}">
                                                        </div>
                                                    </div>


                                                    <!-- Main Content -->
                                                    <div class="row">
                                                        <!-- Left Section: Data LPT -->
                                                        <div class="col-12">
                                                            <div class="mb-4">
                                                                <h6 class="fw-bold border-bottom pb-2">I. Dasar</h6>
                                                                <div class="ms-3 mb-3">
                                                                    <div class="row mb-2">
                                                                        <div class="col-md-3">
                                                                            <label class="form-label">Surat Tugas
                                                                                nomor</label>
                                                                        </div>
                                                                        <div class="col-md-9">
                                                                            <input type="text" class="form-control"
                                                                                placeholder="Nomor Surat Tugas Sudah Mengikuti Bagian Sebelumnya"
                                                                                readonly>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="card mb-3">
                                                                <div class="card-body">
                                                                    <h6 class="fw-bold border-bottom pb-2">II. Tugas</h6>
                                                                    <div class="ms-3">
                                                                        <div class="form-group mb-3">
                                                                            <textarea class="form-control" name="uraian_tugas_lpt" id="uraian_tugas_lpt" rows="6"
                                                                                placeholder="1.(Nomor Satu Diisi Pada Bagian Ini)">{{ old('uraian_tugas_lpt', $pengawasan->uraian_tugas_lpt) }}</textarea>

                                                                        </div>
                                                                    </div>
                                                                    <ol class="ps-3" start="2"
                                                                        style="line-height: 1.5;">
                                                                        <li class="mb-1">Melakukan penggalangan informan
                                                                            dalam hal diperlukan dalam proses pengumpulan
                                                                            dan
                                                                            pendalaman informasi.</li>
                                                                        <li class="mb-1">Melakukan tindakan pengamanan
                                                                            pertama apabila ditemukan adanya indikasi
                                                                            pelanggaran di bidang kepabeanan dan/atau cukai.
                                                                        </li>
                                                                        <li class="mb-1">Melakukan tindakan lainnya dan
                                                                            mengambil langkah-langkah sesuai peraturan
                                                                            perundangan guna mengamankan hak-hak negara,
                                                                            apabila
                                                                            dalam pelaksanaan tugas ditemukan adanya
                                                                            pelanggaran
                                                                            ketentuan dan/atau
                                                                            tindak pidana di bidang kepabeanan dan/atau
                                                                            cukai.
                                                                        </li>
                                                                        <li class="mb-1">Melakukan koordinasi dengan
                                                                            pihak
                                                                            eksternal atau Bidang Penindakan dan Penyidikan
                                                                            pada
                                                                            Kantor Wilayah (Kanwil) DJBC setempat apabila
                                                                            dipandang perlu.</li>
                                                                        <li class="mb-1">Membuat laporan pelaksanaan
                                                                            tugas.
                                                                        </li>
                                                                        <li class="mb-1">Melakukan tugas dan kewajiban
                                                                            sesuai
                                                                            dengan tugas pokok dan fungsinya masing-masing
                                                                            serta
                                                                            dilaksanakan dengan penuh rasa tanggung jawab.
                                                                        </li>
                                                                    </ol>
                                                                </div>
                                                            </div>

                                                            <div class="mb-4">
                                                                <h6 class="fw-bold border-bottom pb-2">III. Wilayah
                                                                    Penugasan</h6>
                                                                <div class="ms-3">
                                                                    <div class="form-group mb-3">
                                                                        <input type="text" class="form-control"
                                                                            name="wilayah_penugasan_lpt"
                                                                            value="{{ old('wilayah_penugasan_lpt', $pengawasan->wilayah_penugasan_lpt) }}"
                                                                            placeholder="Wilayah Penugasan">
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="mb-4">
                                                                <h6 class="fw-bold border-bottom pb-2">IV. Periode
                                                                    Penugasan</h6>
                                                                <div class="ms-3">
                                                                    <div class="form-group mb-3">
                                                                        <input type="text" id="date-range-picker"
                                                                            name="uraian_periode_penugasan_lpt"
                                                                            class="form-control"
                                                                            value="{{ old('uraian_periode_penugasan_lpt', $pengawasan->uraian_periode_penugasan_lpt) }}"
                                                                            placeholder="Periode Penugasan">
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="mb-4">
                                                                <h6 class="fw-bold border-bottom pb-2">V. Uraian
                                                                    Pelaksanaan Tugas</h6>
                                                                <div class="ms-3">
                                                                    <!-- 1. Kegiatan Pengumpulan dan Penilaian Informasi -->
                                                                    <div class="mb-3">
                                                                        <h6 class="fw-bold">1. Kegiatan Pengumpulan dan
                                                                            Penilaian Informasi</h6>
                                                                        <div class="ms-3">
                                                                            <div class="row mb-2">
                                                                                <div class="col-md-4">
                                                                                    <label class="form-label">a. Tempat
                                                                                        Pengumpulan Informasi</label>
                                                                                </div>
                                                                                <div class="col-md-8">
                                                                                    <input type="text"
                                                                                        class="form-control"
                                                                                        name="tempat_pengumpulan_informasi_lpt"
                                                                                        placeholder="Tempat Pengumpulan Informasi"
                                                                                        value="{{ old('tempat_pengumpulan_informasi_lpt', $pengawasan->tempat_pengumpulan_informasi_lpt) }}">
                                                                                </div>
                                                                            </div>
                                                                            <div class="row mb-2">
                                                                                <div class="col-md-4">
                                                                                    <label class="form-label">b. Sumber
                                                                                        Informasi</label>
                                                                                </div>
                                                                                <div class="col-md-8">
                                                                                    <input type="text"
                                                                                        class="form-control"
                                                                                        name="sumber_informasi_lpt"
                                                                                        placeholder="Sumber Informasi"
                                                                                        value="{{ old('sumber_informasi_lpt', $pengawasan->sumber_informasi_lpt) }}">
                                                                                </div>
                                                                            </div>
                                                                            <div class="row mb-2">
                                                                                <div class="col-md-4">
                                                                                    <label class="form-label">c. Metode
                                                                                        Pengumpulan Informasi</label>
                                                                                </div>
                                                                                <div class="col-md-8">
                                                                                    <input type="text"
                                                                                        class="form-control"
                                                                                        name="metode_pengumpulan_informasi_lpt"
                                                                                        placeholder="Metode Pengumpulan Informasi"
                                                                                        value="{{ old('metode_pengumpulan_informasi_lpt', $pengawasan->metode_pengumpulan_informasi_lpt) }}">

                                                                                </div>
                                                                            </div>
                                                                            <div class="row mb-2">
                                                                                <div class="col-md-4">
                                                                                    <label class="form-label">d.
                                                                                        Ikhtisar Informasi
                                                                                        <button type="button"
                                                                                            class="btn p-0 ms-1 text-primary"
                                                                                            data-bs-toggle="tooltip"
                                                                                            data-bs-placement="top"
                                                                                            data-bs-custom-class="custom-tooltip"
                                                                                            data-bs-title="Diisi dengan mengapit #isi# disetiap point, dan enter untuk baris baru untuk point baru">
                                                                                            <i data-feather="alert-circle"
                                                                                                style="width: 18px; height: 18px;"></i>
                                                                                        </button></label>
                                                                                </div>
                                                                                <div class="col-md-8">
                                                                                    <textarea class="form-control" name="ikhtisar_informasi_lpt" rows="3" placeholder="Ikhtisar Informasi">{{ old('ikhtisar_informasi_lpt', $pengawasan->ikhtisar_informasi_lpt) }}</textarea>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                    <!-- 2. Kegiatan Analisis Intelijen -->
                                                                    <div class="mb-3">
                                                                        <h6 class="fw-bold">2. Kegiatan Analisis
                                                                            Intelijen</h6>
                                                                        <div class="ms-3">
                                                                            <div class="row mb-2">
                                                                                <div class="col-md-4">
                                                                                    <label class="form-label">a. Jenis
                                                                                        Dokumen Kepabeanan</label>
                                                                                </div>
                                                                                <div class="col-md-8">
                                                                                    <select class="form-select select2"
                                                                                        name="jenis_dok_kepabeanan_lpt">
                                                                                        <option value="" disabled>-
                                                                                            Pilih -</option>
                                                                                        @foreach ($jenis_dok as $dok)
                                                                                            <option
                                                                                                value="{{ $dok->jenis_dok }}"
                                                                                                {{ old('jenis_dok_kepabeanan_lpt', $pengawasan->jenis_dok_kepabeanan_lpt) == $dok->jenis_dok ? 'selected' : '' }}>
                                                                                                {{ $dok->jenis_dok }}
                                                                                            </option>
                                                                                        @endforeach
                                                                                    </select>

                                                                                </div>
                                                                            </div>
                                                                            <div class="row mb-2">
                                                                                <div class="col-md-4">
                                                                                    <label class="form-label">b. Nomor
                                                                                        dan Tanggal Dokumen
                                                                                        Kepabeanan</label>
                                                                                </div>
                                                                                <div class="col-md-8">
                                                                                    <input type="text"
                                                                                        class="form-control"
                                                                                        name="no_tgl_dok_kepabeanan_lpt"
                                                                                        placeholder="Nomor dan Tanggal Dokumen Kepabeanan"
                                                                                        value="{{ old('no_tgl_dok_kepabeanan_lpt', $pengawasan->no_tgl_dok_kepabeanan_lpt) }}">
                                                                                </div>
                                                                            </div>
                                                                            <div class="row mb-2">
                                                                                <div class="col-md-4">
                                                                                    <label class="form-label">c. Metode
                                                                                        Analisis Intelijen</label>
                                                                                </div>
                                                                                <div class="col-md-8">
                                                                                    <input type="text"
                                                                                        class="form-control"
                                                                                        name="metode_analisis_intelijen_lpt"
                                                                                        placeholder="Metode Analisis Intelijen"
                                                                                        value="{{ old('metode_analisis_intelijen_lpt', $pengawasan->metode_analisis_intelijen_lpt) }}">
                                                                                </div>
                                                                            </div>
                                                                            <div class="row mb-2">
                                                                                <div class="col-md-4">
                                                                                    <label class="form-label">d.
                                                                                        Ikhtisar Hasil Analisis
                                                                                        Intelijen</label>
                                                                                </div>
                                                                                <div class="col-md-8">
                                                                                    <input type="text"
                                                                                        class="form-control"
                                                                                        name="ikhtisar_hasil_analisis_intelijen_lpt"
                                                                                        placeholder="Ikhtisar Hasil Analisis Intelijen"
                                                                                        value="{{ old('ikhtisar_hasil_analisis_intelijen_lpt', $pengawasan->ikhtisar_hasil_analisis_intelijen_lpt) }}">
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                    <!-- 3. Indikasi Pelanggaran -->
                                                                    <div class="mb-3">
                                                                        <h6 class="fw-bold">3. Indikasi Pelanggaran
                                                                        </h6>
                                                                        <div class="ms-3">
                                                                            <div class="row mb-2">
                                                                                <div class="col-md-4">
                                                                                    <label class="form-label">a. Jenis
                                                                                        Pelanggaran</label>
                                                                                </div>
                                                                                <div class="col-md-8">
                                                                                    <select class="form-select select2"
                                                                                        name="jenis_pelanggaran_lpt">
                                                                                        <option value="" disabled>-
                                                                                            Pilih -</option>
                                                                                        <option
                                                                                            value="Pelanggaran di bidang Kepabeanan"
                                                                                            {{ old('jenis_pelanggaran_lpt', $pengawasan->jenis_pelanggaran_lpt) == 'Pelanggaran di bidang Kepabeanan' ? 'selected' : '' }}>
                                                                                            Pelanggaran di bidang Kepabeanan
                                                                                        </option>
                                                                                        <option
                                                                                            value="Pelanggaran di bidang Cukai"
                                                                                            {{ old('jenis_pelanggaran_lpt', $pengawasan->jenis_pelanggaran_lpt) == 'Pelanggaran di bidang Cukai' ? 'selected' : '' }}>
                                                                                            Pelanggaran di bidang Cukai
                                                                                        </option>
                                                                                        <option
                                                                                            value="Pelanggaran di bidang Kepabeanan dan Cukai"
                                                                                            {{ old('jenis_pelanggaran_lpt', $pengawasan->jenis_pelanggaran_lpt) == 'Pelanggaran di bidang Kepabeanan dan Cukai' ? 'selected' : '' }}>
                                                                                            Pelanggaran di bidang Kepabeanan
                                                                                            dan Cukai
                                                                                        </option>
                                                                                    </select>

                                                                                </div>
                                                                            </div>
                                                                            <div class="row mb-2">
                                                                                <div class="col-md-4">
                                                                                    <label class="form-label">b. Modus
                                                                                        Pelanggaran</label>
                                                                                </div>
                                                                                <div class="col-md-8">
                                                                                    <select class="form-select select2"
                                                                                        name="modus_pelanggaran_lpt">
                                                                                        <option value="" disabled>-
                                                                                            Pilih -</option>
                                                                                        @foreach ($uraian_modus as $modus)
                                                                                            <option
                                                                                                value="{{ $modus->uraian_modus }}"
                                                                                                {{ old('modus_pelanggaran_lpt', $pengawasan->modus_pelanggaran_lpt) == $modus->uraian_modus ? 'selected' : '' }}>
                                                                                                {{ $modus->uraian_modus }}
                                                                                            </option>
                                                                                        @endforeach
                                                                                    </select>

                                                                                </div>
                                                                            </div>
                                                                            <div class="row mb-2">
                                                                                <div class="col-md-4">
                                                                                    <label class="form-label">c.
                                                                                        Perkiraan Tempat
                                                                                        Pelanggaran</label>
                                                                                </div>
                                                                                <div class="col-md-8">
                                                                                    <select class="form-select select2"
                                                                                        name="perkiraan_tempat_pelanggaran_lpt">
                                                                                        <option value="" disabled>-
                                                                                            Pilih -</option>
                                                                                        @foreach ($tempat as $locus)
                                                                                            <option
                                                                                                value="{{ $locus->locus }}"
                                                                                                {{ old('perkiraan_tempat_pelanggaran_lpt', $pengawasan->perkiraan_tempat_pelanggaran_lpt) == $locus->locus ? 'selected' : '' }}>
                                                                                                {{ $locus->locus }}
                                                                                            </option>
                                                                                        @endforeach
                                                                                    </select>

                                                                                </div>
                                                                            </div>
                                                                            <div class="row mb-2">
                                                                                <div class="col-md-4">
                                                                                    <label class="form-label">d.
                                                                                        Perkiraan Waktu
                                                                                        Pelanggaran</label>
                                                                                </div>
                                                                                <div class="col-md-8">
                                                                                    <input type="text"
                                                                                        class="form-control"
                                                                                        name="perkiraan_waktu_pelanggaran_lpt"
                                                                                        id="datetime-datepicker"
                                                                                        placeholder="Perkiraan Waktu Pelanggaran"
                                                                                        value="{{ old('perkiraan_waktu_pelanggaran_lpt', $pengawasan->perkiraan_waktu_pelanggaran_lpt) }}">

                                                                                </div>
                                                                            </div>
                                                                            <div class="row mb-2">
                                                                                <div class="col-md-4">
                                                                                    <label class="form-label">e.
                                                                                        Perkiraan Pelaku
                                                                                        Pelanggaran</label>
                                                                                </div>
                                                                                <div class="col-md-8">
                                                                                    <input type="text"
                                                                                        class="form-control"
                                                                                        name="perkiraan_pelaku_pelanggaran_lpt"
                                                                                        placeholder="Perkiraan Pelaku Pelanggaran"
                                                                                        value="{{ old('perkiraan_pelaku_pelanggaran_lpt', $pengawasan->perkiraan_pelaku_pelanggaran_lpt) }}">

                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                    <!-- 4. Dokumentasi Kegiatan Intelijen -->
                                                                    <div class="mb-3">
                                                                        <h6 class="fw-bold">4. Dokumentasi Kegiatan
                                                                            Intelijen</h6>
                                                                        <div class="ms-3">
                                                                            <div class="row mb-2">
                                                                                <div class="col-md-4">
                                                                                    <label class="form-label">a.
                                                                                        Foto</label>
                                                                                </div>
                                                                                <div class="col-md-8">
                                                                                    <input type="file"
                                                                                        class="form-control form-input"
                                                                                        value="{{ old('dokumentasi_foto_lpt', $pengawasan->dokumentasi_foto_lpt) }}"
                                                                                        name="dokumentasi_foto_lpt[]"
                                                                                        multiple>
                                                                                    @if ($pengawasan->dokumentasi_foto_lpt)
                                                                                        <div>
                                                                                            <button type="button"
                                                                                                class="btn btn-primary btn-sm mt-2"
                                                                                                data-bs-toggle="modal"
                                                                                                data-bs-target="#fotoModal"
                                                                                                onclick="setMediaModal('{{ $pengawasan->dokumentasi_foto_lpt }}', 'foto')">
                                                                                                <i data-feather="image"
                                                                                                    style="width: 16px; height: 16px;"class="me-1"></i>
                                                                                                Lihat Foto
                                                                                            </button>
                                                                                        </div>
                                                                                    @endif
                                                                                </div>
                                                                            </div>
                                                                            <div class="modal fade" id="fotoModal"
                                                                                tabindex="-1"
                                                                                aria-labelledby="fotoModalLabel"
                                                                                aria-hidden="true">
                                                                                <div class="modal-dialog modal-lg">
                                                                                    <div class="modal-content">
                                                                                        <div class="modal-header">
                                                                                            <h5 class="modal-title"
                                                                                                id="fotoModalLabel">
                                                                                                Dokumentasi
                                                                                                Foto</h5>
                                                                                            <button type="button"
                                                                                                class="btn-close"
                                                                                                data-bs-dismiss="modal"
                                                                                                aria-label="Close"></button>
                                                                                        </div>
                                                                                        <div class="modal-body"
                                                                                            id="fotoModalBody"
                                                                                            align="center">
                                                                                            <!-- Foto akan ditambahkan secara dinamis disini -->
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="row mb-2">
                                                                                <div class="col-md-4">
                                                                                    <label class="form-label">b.
                                                                                        Rekaman Audio
                                                                                        <button type="button"
                                                                                            class="btn p-0 ms-1 text-primary"
                                                                                            data-bs-toggle="tooltip"
                                                                                            data-bs-placement="top"
                                                                                            data-bs-custom-class="custom-tooltip"
                                                                                            data-bs-title="Diisi dengan link google drive atau penyimpanan apapun yang mengarah ke Rekaman Audio Yang Telah Dikumpulkan">
                                                                                            <i data-feather="alert-circle"
                                                                                                style="width: 18px; height: 18px;"></i>
                                                                                        </button>
                                                                                    </label>
                                                                                </div>
                                                                                <div class="col-md-8">
                                                                                    <input type="text"
                                                                                        class="form-control"
                                                                                        name="dokumentasi_audio_lpt"
                                                                                        placeholder="Masukkan Link Audio"
                                                                                        value="{{ old('dokumentasi_audio_lpt', $pengawasan->dokumentasi_audio_lpt) }}">

                                                                                </div>
                                                                            </div>
                                                                            <div class="row mb-2">
                                                                                <div class="col-md-4">
                                                                                    <label class="form-label">c.
                                                                                        Rekaman Video
                                                                                        <button type="button"
                                                                                            class="btn p-0 ms-1 text-primary"
                                                                                            data-bs-toggle="tooltip"
                                                                                            data-bs-placement="top"
                                                                                            data-bs-custom-class="custom-tooltip"
                                                                                            data-bs-title="Diisi dengan link google drive atau penyimpanan apapun yang mengarah ke Rekaman Video Yang Telah Dikumpulkan">
                                                                                            <i data-feather="alert-circle"
                                                                                                style="width: 18px; height: 18px;"></i>
                                                                                        </button>
                                                                                    </label>
                                                                                </div>
                                                                                <div class="col-md-8">
                                                                                    <input type="text"
                                                                                        class="form-control"
                                                                                        name="dokumentasi_video_lpt"
                                                                                        placeholder="Masukkan Link Video"
                                                                                        value="{{ old('dokumentasi_video_lpt', $pengawasan->dokumentasi_video_lpt) }}">

                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                    <!-- 5. Informasi Lainnya yang berkaitan -->
                                                                    <div class="mb-3">
                                                                        <h6 class="fw-bold">5. Informasi Lainnya yang
                                                                            berkaitan
                                                                        </h6>
                                                                        <div class="ms-3">
                                                                            <div class="form-group mb-3">
                                                                                <textarea class="form-control" name="info_lainnya_lpt" rows="3"
                                                                                    placeholder="Informasi Lainnya yang Berkaitan">{{ old('info_lainnya_lpt', $pengawasan->info_lainnya_lpt) }}</textarea>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="mb-4">
                                                                <h6 class="fw-bold border-bottom pb-2">VI. Kesimpulan
                                                                    <button type="button"
                                                                        class="btn p-0 ms-1 text-primary"
                                                                        data-bs-toggle="tooltip" data-bs-placement="top"
                                                                        data-bs-custom-class="custom-tooltip"
                                                                        data-bs-title="Diisi dengan mengapit #isi# disetiap point, dan enter untuk baris baru untuk point baru">
                                                                        <i data-feather="alert-circle"
                                                                            style="width: 18px; height: 18px;"></i>
                                                                    </button>
                                                                </h6>
                                                                <div class="ms-3">
                                                                    <div class="form-group mb-3">
                                                                        <textarea class="form-control" name="kesimpulan_lpt" rows="3" placeholder="Kesimpulan">{{ old('kesimpulan_lpt', $pengawasan->kesimpulan_lpt) }}</textarea>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="mb-4">
                                                                <h6 class="fw-bold border-bottom pb-2">VII. Rekomendasi
                                                                    <button type="button"
                                                                        class="btn p-0 ms-1 text-primary"
                                                                        data-bs-toggle="tooltip" data-bs-placement="top"
                                                                        data-bs-custom-class="custom-tooltip"
                                                                        data-bs-title="Diisi dengan mengapit #isi# disetiap point, dan enter untuk baris baru untuk point baru">
                                                                        <i data-feather="alert-circle"
                                                                            style="width: 18px; height: 18px;"></i>
                                                                    </button>
                                                                </h6>
                                                                <div class="ms-3">
                                                                    <div class="form-group mb-3">
                                                                        <textarea class="form-control" name="rekomendasi_lpt" rows="3" placeholder="Rekomendasi">{{ old('rekomendasi_lpt', $pengawasan->rekomendasi_lpt) }}</textarea>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="mb-4">
                                                                <div class="row">
                                                                    <div class="col-md-6">
                                                                        <div class="mb-3">
                                                                            <label class="form-label fw-bold">Ketua Tim
                                                                                Pelaksanaan Tugas</label>
                                                                            <select class="form-select select2"
                                                                                id="ketua_tim" name="ketua_tim_lpt">
                                                                                <option value="" selected disabled>-
                                                                                    Pilih -</option>
                                                                                @foreach ($users as $user)
                                                                                    <option value="{{ $user->id_admin }}"
                                                                                        {{ old('ketua_tim_lpt', $pengawasan->ketua_tim_lpt) == $user->id_admin ? 'selected' : '' }}>
                                                                                        {{ $user->name }}
                                                                                    </option>
                                                                                @endforeach
                                                                            </select>

                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div class="mb-3">
                                                                            <label class="form-label fw-bold">Pegawai
                                                                                Pembuat Laporan</label>
                                                                            <select class="form-select select2"
                                                                                name="pegawai_pembuat_lpt">
                                                                                <option value="" selected disabled>-
                                                                                    Pilih -</option>
                                                                                @foreach ($users as $user)
                                                                                    <option value="{{ $user->id_admin }}"
                                                                                        {{ old('pegawai_pembuat_lpt', $pengawasan->pegawai_pembuat_lpt) == $user->id_admin ? 'selected' : '' }}>
                                                                                        {{ $user->name }}
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
                                    </div><!-- end tab pane -->

                                    <div class="tab-pane" id="lppi" role="tabpanel">
                                        <div class="container mt-4 mb-5">
                                            <div class="card">
                                                <div class="card-body">
                                                    <!-- Header -->
                                                    <div class="row mb-4 align-items-center">
                                                        <div class="col-2 text-center">
                                                            <img src="/images/logocop.png" alt="Logo"
                                                                class="img-fluid" style="max-height:170px;">
                                                        </div>
                                                        <div class="col-10 text-center">
                                                            <h5 class="mb-0">KEMENTERIAN KEUANGAN REPUBLIK INDONESIA</h5>
                                                            <p class="small mb-0">DIREKTORAT JENDERAL BEA DAN CUKAI</p>
                                                            <p class="small mb-0">KANTOR PELAYANAN UTAMA BEA DAN CUKAI TIPE
                                                                B BATAM
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

                                                    <!-- Form Title -->
                                                    <div class="row">
                                                        <div class="col-12 text-center mb-4">
                                                            <h5 class="mb-0"><u>LEMBAR PENGUMPULAN DAN PENILAIAN
                                                                    INFORMASI</u></h5>
                                                        </div>
                                                    </div>

                                                    <!-- Nomor dan Tanggal -->
                                                    <div class="text-center mb-4">
                                                        <div class="input-group flex-wrap">
                                                            <span class="input-group-text">NO : LPPI-</span>
                                                            <input type="text" class="form-control" id="no_lppi"
                                                                name="no_lppi"
                                                                value="{{ old('no_lppi', $no_ref->no_lppi) }}" readonly>
                                                            <span class="input-group-text">/KPU.2061/</span>
                                                            <input type="date" class="form-control" id="tgl_lppi"
                                                                name="tgl_lppi">
                                                        </div>
                                                    </div>

                                                    <!-- Divider -->
                                                    <div class="row mb-2">
                                                        <div class="col-12">
                                                            <h6 class="bg-light p-2"><b>SUMBER DATA ATAU INFORMASI
                                                                </b></h6>
                                                        </div>
                                                    </div>

                                                    <!-- Sumber Data -->
                                                    <div class="row mb-3">
                                                        {{-- INTERNAL --}}
                                                        <div class="col-md-6">
                                                            <div class="card">
                                                                <div class="card-header">
                                                                    <div class="form-check">
                                                                        <input class="form-check-input" type="checkbox"
                                                                            id="internal_check"
                                                                            onchange="toggleInternal()"
                                                                            {{ old('internal_lppi', $pengawasan->internal_lppi) == 'YA' ? 'checked' : '' }}>
                                                                        <label class="form-check-label fw-bold"
                                                                            for="internal_check">
                                                                            Internal
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                                <div class="card-body" id="internal_form"
                                                                    style="display: {{ old('internal_lppi', $pengawasan->internal_lppi) == 'YA' ? 'block' : 'none' }};">
                                                                    <div class="mb-2 row">
                                                                        <label
                                                                            class="col-sm-4 col-form-label">Media</label>
                                                                        <div class="col-sm-8">
                                                                            <input type="text" class="form-control"
                                                                                placeholder="........"
                                                                                name="media_internal_lppi"
                                                                                value="{{ old('media_internal_lppi', $pengawasan->media_internal_lppi) }}">
                                                                        </div>
                                                                    </div>
                                                                    <div class="mb-2 row">
                                                                        <label class="col-sm-4 col-form-label">Tanggal
                                                                            terima</label>
                                                                        <div class="col-sm-8">
                                                                            <input type="date" class="form-control"
                                                                                name="tanggal_terima_internal_lppi"
                                                                                value="{{ old('tanggal_terima_internal_lppi', $pengawasan->tanggal_terima_internal_lppi) }}">
                                                                        </div>
                                                                    </div>
                                                                    <div class="mb-2 row">
                                                                        <label class="col-sm-4 col-form-label">No.
                                                                            Dokumen</label>
                                                                        <div class="col-sm-8">
                                                                            <input type="text" class="form-control"
                                                                                name="no_dokumen_internal_lppi"
                                                                                value="{{ old('no_dokumen_internal_lppi', $pengawasan->no_dokumen_internal_lppi) }}">
                                                                        </div>
                                                                    </div>
                                                                    <div class="mb-2 row">
                                                                        <label
                                                                            class="col-sm-4 col-form-label">Tanggal</label>
                                                                        <div class="col-sm-8">
                                                                            <input type="date" class="form-control"
                                                                                name="tanggal_dokumen_internal_lppi"
                                                                                value="{{ old('tanggal_dokumen_internal_lppi', $pengawasan->tanggal_dokumen_internal_lppi) }}">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        {{-- EKSTERNAL --}}
                                                        <div class="col-md-6">
                                                            <div class="card">
                                                                <div class="card-header">
                                                                    <div class="form-check">
                                                                        <input class="form-check-input" type="checkbox"
                                                                            id="eksternal_check"
                                                                            onchange="toggleEksternal()"
                                                                            {{ old('eksternal_lppi', $pengawasan->eksternal_lppi) == 'YA' ? 'checked' : '' }}>
                                                                        <label class="form-check-label fw-bold"
                                                                            for="eksternal_check">
                                                                            Eksternal
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                                <div class="card-body" id="eksternal_form"
                                                                    style="display: {{ old('eksternal_lppi', $pengawasan->eksternal_lppi) == 'YA' ? 'block' : 'none' }};">
                                                                    <div class="mb-2 row">
                                                                        <label
                                                                            class="col-sm-4 col-form-label">Media</label>
                                                                        <div class="col-sm-8">
                                                                            <input type="text" class="form-control"
                                                                                placeholder="........"
                                                                                name="media_eksternal_lppi"
                                                                                value="{{ old('media_eksternal_lppi', $pengawasan->media_eksternal_lppi) }}">
                                                                        </div>
                                                                    </div>
                                                                    <div class="mb-2 row">
                                                                        <label class="col-sm-4 col-form-label">Tanggal
                                                                            terima</label>
                                                                        <div class="col-sm-8">
                                                                            <input type="date" class="form-control"
                                                                                name="tanggal_terima_eksternal_lppi"
                                                                                value="{{ old('tanggal_terima_eksternal_lppi', $pengawasan->tanggal_terima_eksternal_lppi) }}">
                                                                        </div>
                                                                    </div>
                                                                    <div class="mb-2 row">
                                                                        <label class="col-sm-4 col-form-label">No.
                                                                            Dokumen</label>
                                                                        <div class="col-sm-8">
                                                                            <input type="text" class="form-control"
                                                                                name="no_dokumen_eksternal_lppi"
                                                                                value="{{ old('no_dokumen_eksternal_lppi', $pengawasan->no_dokumen_eksternal_lppi) }}">
                                                                        </div>
                                                                    </div>
                                                                    <div class="mb-2 row">
                                                                        <label
                                                                            class="col-sm-4 col-form-label">Tanggal</label>
                                                                        <div class="col-sm-8">
                                                                            <input type="date" class="form-control"
                                                                                name="tanggal_dokumen_eksternal_lppi"
                                                                                value="{{ old('tanggal_dokumen_eksternal_lppi', $pengawasan->tanggal_dokumen_eksternal_lppi) }}">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <input type="hidden" id="internal" name="internal_lppi"
                                                        value="{{ old('internal_lppi', $pengawasan->internal_lppi ?? 'TIDAK') }}">
                                                    <input type="hidden" id="eksternal" name="eksternal_lppi"
                                                        value="{{ old('eksternal_lppi', $pengawasan->eksternal_lppi ?? 'TIDAK') }}">


                                                    <!-- Tabel Ikhtisar -->
                                                    <div class="row mb-2">
                                                        <div class="col-12">
                                                            <h6 class="bg-light p-2"><b>IKHTISAR DATA ATAU
                                                                    INFORMASI</b></h6>
                                                        </div>
                                                    </div>

                                                    @php
                                                        $ikhtisar = json_decode($pengawasan->ikhtisar, true) ?? [];
                                                    @endphp

                                                    <div class="row mb-3">
                                                        <div class="col-12">
                                                            <div class="table-responsive">
                                                                <table class="table table-bordered">
                                                                    <thead class="table-light">
                                                                        <tr class="text-center">
                                                                            <th style="width: 5%">NO.</th>
                                                                            <th style="width: 55%">IKHTISAR DATA ATAU
                                                                                INFORMASI</th>
                                                                            <th style="width: 20%">SUMBER</th>
                                                                            <th style="width: 20%">VALIDITAS</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody id="ikhtisar-container">
                                                                        @foreach ($ikhtisar as $index => $item)
                                                                            <tr id="ikhtisar-row-{{ $index }}">
                                                                                <td class="text-center">
                                                                                    {{ $index + 1 }}.</td>
                                                                                <td>
                                                                                    <textarea class="form-control" rows="2" name="ikhtisar[{{ $index }}][ikhtisar]"
                                                                                        placeholder="Ikhtisar">{{ $item['ikhtisar'] ?? '' }}</textarea>
                                                                                </td>
                                                                                <td>
                                                                                    <input type="text"
                                                                                        class="form-control"
                                                                                        name="ikhtisar[{{ $index }}][sumber]"
                                                                                        placeholder="Sumber"
                                                                                        value="{{ $item['sumber'] ?? '' }}">
                                                                                </td>
                                                                                <td>
                                                                                    <div class="d-flex">
                                                                                        <input type="text"
                                                                                            class="form-control"
                                                                                            name="ikhtisar[{{ $index }}][validitas]"
                                                                                            placeholder="Validitas"
                                                                                            value="{{ $item['validitas'] ?? '' }}">
                                                                                        <button type="button"
                                                                                            class="btn btn-danger btn-sm ms-1"
                                                                                            onclick="document.getElementById('ikhtisar-row-{{ $index }}').remove()">
                                                                                            <i class="bi bi-trash"></i>
                                                                                            Hapus
                                                                                        </button>
                                                                                    </div>
                                                                                </td>
                                                                            </tr>
                                                                        @endforeach
                                                                    </tbody>
                                                                </table>
                                                                <div class="d-flex justify-content-end">
                                                                    <button type="button" class="btn btn-sm btn-primary"
                                                                        onclick="tambahIkhtisar()">Tambah Ikhtisar</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <!-- Petugas Data dan Informasi -->
                                                    <div class="row mb-3">
                                                        <div class="col-6">
                                                            <div class="card">
                                                                <div class="card-body">
                                                                    <div class="mb-2 row">
                                                                        <label class="col-sm-4 col-form-label">Penerima
                                                                            Data atau Informasi</label>
                                                                        <div class="col-sm-8">
                                                                            <select
                                                                                class="form-control form-select select2"
                                                                                id="penerima_informasi_lppi"
                                                                                name="penerima_informasi_lppi">
                                                                                <option value="" disabled
                                                                                    {{ old('penerima_informasi_lppi', $pengawasan->penerima_informasi_lppi) == '' ? 'selected' : '' }}>
                                                                                    - Pilih -
                                                                                </option>
                                                                                @foreach ($users as $user)
                                                                                    <option value="{{ $user->id_admin }}"
                                                                                        {{ old('penerima_informasi_lppi', $pengawasan->penerima_informasi_lppi) == $user->id_admin ? 'selected' : '' }}>
                                                                                        {{ $user->name }}
                                                                                    </option>
                                                                                @endforeach
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-6">
                                                            <div class="card">
                                                                <div class="card-body">
                                                                    <div class="mb-2 row">
                                                                        <label class="col-sm-4 col-form-label">Penilai
                                                                            Data atau Informasi</label>
                                                                        <div class="col-sm-8">
                                                                            <select
                                                                                class="form-control form-select select2"
                                                                                id="penilai_informasi_lppi"
                                                                                name="penilai_informasi_lppi">
                                                                                <option value="" disabled
                                                                                    {{ old('penilai_informasi_lppi', $pengawasan->penilai_informasi_lppi) == '' ? 'selected' : '' }}>
                                                                                    - Pilih -
                                                                                </option>
                                                                                @foreach ($users as $user)
                                                                                    <option value="{{ $user->id_admin }}"
                                                                                        {{ old('penilai_informasi_lppi', $pengawasan->penilai_informasi_lppi) == $user->id_admin ? 'selected' : '' }}>
                                                                                        {{ $user->name }}
                                                                                    </option>
                                                                                @endforeach
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <!-- Kesimpulan -->
                                                    <div class="row mb-2">
                                                        <div class="col-12">
                                                            <h6 class="bg-light p-2"><b>KESIMPULAN</b></h6>
                                                        </div>
                                                    </div>

                                                    <div class="row mb-3">
                                                        <div class="col-12">
                                                            <textarea class="form-control" rows="3" placeholder="........" name="kesimpulan_lppi">{{ old('kesimpulan_lppi', $pengawasan->kesimpulan_lppi) }}</textarea>
                                                        </div>
                                                    </div>

                                                    <!-- Disposisi -->
                                                    <div class="row mb-3">
                                                        <div class="col-6">
                                                            <div class="mb-3">
                                                                <label class="form-label">Disposisi Kepada:</label>
                                                                <select class="form-control form-select select2"
                                                                    id="pegawai_lppi" name="pegawai_lppi">
                                                                    <option value="" disabled
                                                                        {{ old('pegawai_lppi', $pengawasan->pegawai_lppi) == '' ? 'selected' : '' }}>
                                                                        - Pilih -
                                                                    </option>
                                                                    @foreach ($users as $user)
                                                                        <option value="{{ $user->id_admin }}"
                                                                            {{ old('pegawai_lppi', $pengawasan->pegawai_lppi) == $user->id_admin ? 'selected' : '' }}>
                                                                            {{ $user->name }}
                                                                        </option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-6">
                                                            <div class="mb-3">
                                                                <label class="form-label">Tanggal Disposisi:</label>
                                                                <input type="date" class="form-control"
                                                                    name="tanggal_disposisi_lppi"
                                                                    value="{{ old('tanggal_disposisi_lppi', $pengawasan->tanggal_disposisi_lppi) }}">
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <!-- Tindak Lanjut -->
                                                    <div class="row mb-2">
                                                        <div class="col-12">
                                                            <h6 class="bg-light p-2"><b>TINDAK LANJUT:</b></h6>
                                                        </div>
                                                    </div>

                                                    <div class="row mb-3">
                                                        <div class="col-12">
                                                            <div class="form-check form-check-inline">
                                                                <input class="form-check-input" type="radio"
                                                                    name="tindak_lanjut_lppi" id="analisis"
                                                                    value="Analisis"
                                                                    {{ old('tindak_lanjut_lppi', $pengawasan->tindak_lanjut_lppi) == 'Analisis' ? 'checked' : '' }}>
                                                                <label class="form-check-label"
                                                                    for="analisis">Analisis</label>
                                                            </div>
                                                            <div class="form-check form-check-inline">
                                                                <input class="form-check-input" type="radio"
                                                                    name="tindak_lanjut_lppi" id="arsip"
                                                                    value="Arsip"
                                                                    {{ old('tindak_lanjut_lppi', $pengawasan->tindak_lanjut_lppi) == 'Arsip' ? 'checked' : '' }}>
                                                                <label class="form-check-label"
                                                                    for="arsip">Arsip</label>
                                                            </div>
                                                        </div>
                                                    </div>


                                                    <!-- Catatan -->
                                                    <div class="row mb-2">
                                                        <div class="col-12">
                                                            <h6 class="bg-light p-2"><b>CATATAN</b></h6>
                                                        </div>
                                                    </div>

                                                    <div class="row mb-4">
                                                        <div class="col-12">
                                                            <textarea class="form-control" rows="3" placeholder="........" name="catatan_lppi">{{ old('catatan_lppi', $pengawasan->catatan_lppi) }}</textarea>
                                                        </div>
                                                    </div>

                                                    <!-- Tanda Tangan -->
                                                    <div class="row mb-3">
                                                        <div class="col-6"></div>
                                                        <div class="col-6">
                                                            <div class="mb-3">
                                                                <label class="form-label">Pejabat Pengawas:</label>
                                                                <select class="form-control form-select select2"
                                                                    id="pejabat_lppi" name="pejabat_lppi">
                                                                    <option value="" disabled
                                                                        {{ old('pejabat_lppi', $pengawasan->pejabat_lppi) == '' ? 'selected' : '' }}>
                                                                        - Pilih -
                                                                    </option>
                                                                    @foreach ($users as $user)
                                                                        <option value="{{ $user->id_admin }}"
                                                                            {{ old('pejabat_lppi', $pengawasan->pejabat_lppi) == $user->id_admin ? 'selected' : '' }}>
                                                                            {{ $user->name }}
                                                                        </option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div><!-- end tab pane -->

                                    <div class="tab-pane" id="lkai" role="tabpanel">
                                        <div class="container my-4">
                                            <!-- Kop Surat -->
                                            <div class="row mb-4 align-items-center">
                                                <div class="col-2 text-center">
                                                    <img src="/images/logocop.png" alt="Logo" class="img-fluid"
                                                        style="max-height:170px;">
                                                </div>
                                                <div class="col-10 text-center">
                                                    <h5 class="mb-0">KEMENTERIAN KEUANGAN REPUBLIK INDONESIA</h5>
                                                    <p class="small mb-0">DIREKTORAT JENDERAL BEA DAN CUKAI</p>
                                                    <p class="small mb-0">KANTOR PELAYANAN UTAMA BEA DAN CUKAI TIPE
                                                        B BATAM
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

                                            <!-- Judul Dokumen -->
                                            <div class="row mb-3">
                                                <div class="col-12 text-center">
                                                    <h5 class="fw-bold text-decoration-underline">LEMBAR KERJA ANALISIS
                                                        INTELIJEN</h5>
                                                </div>
                                            </div>

                                            <!-- Nomor dan Tanggal -->
                                            <div class="text-center mb-4">
                                                <div class="input-group flex-wrap">
                                                    <span class="input-group-text">NO : LKAI-</span>
                                                    <input type="text" class="form-control" id="no_lkai"
                                                        name="no_lkai"
                                                        value="{{ old('no_lkai', $pengawasan->no_lkai) }}" readonly>
                                                    <span class="input-group-text">/KPU.2061/</span>
                                                    <input type="date" class="form-control" id="tgl_lkai"
                                                        name="tgl_lkai"
                                                        value="{{ old('tgl_lkai', $pengawasan->tgl_lkai) }}">
                                                </div>
                                            </div>


                                            <!-- Dokumen Sumber -->
                                            <div class="row mb-3">
                                                <div class="col-12">
                                                    <label class="fw-bold">DOKUMEN SUMBER:</label>
                                                </div>
                                            </div>

                                            <!-- LPPI -->
                                            <div class="row mb-3">
                                                <div class="col-1">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" id="lppi_check"
                                                            onchange="toggleLppiInputs(this)"
                                                            {{ old('no_lppi', $pengawasan->no_lppi) ? 'checked' : '' }}>
                                                        <label class="form-check-label" for="lppi_check">LPPI</label>
                                                    </div>
                                                </div>
                                                <div class="col-3">
                                                    <label>Nomor:</label>
                                                    <input type="text" id="no_lppi_disabled" name="no_lppi"
                                                        class="form-control form-input" placeholder="LPPI-(..)/.."
                                                        value="{{ old('no_lppi', $pengawasan->no_lppi) }}"
                                                        {{ old('no_lppi', $pengawasan->no_lppi) ? '' : 'disabled' }}>
                                                </div>
                                                <div class="col-3">
                                                    <label>Tanggal:</label>
                                                    <input type="date" id="tgl_lppi_disabled" name="tgl_lppi"
                                                        class="form-control form-input"
                                                        value="{{ old('tgl_lppi', $pengawasan->tgl_lppi) }}"
                                                        {{ old('tgl_lppi', $pengawasan->tgl_lppi) ? '' : 'disabled' }}>
                                                </div>
                                            </div>


                                            <!-- NHI -->
                                            <div class="row mb-3">
                                                <div class="col-1">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" id="nhi_check"
                                                            onchange="toggleNhiInputs(this)"
                                                            {{ old('no_npi', $pengawasan->no_npi) ? 'checked' : '' }}>
                                                        <label class="form-check-label" for="nhi_check">NPI</label>
                                                    </div>
                                                </div>
                                                <div class="col-3">
                                                    <label>Nomor:</label>
                                                    <input type="text" id="no_npi_disabled" name="no_npi"
                                                        class="form-control form-input" placeholder="NPI-(..)/.."
                                                        value="{{ old('no_npi', $pengawasan->no_npi) }}"
                                                        {{ old('no_npi', $pengawasan->no_npi) ? '' : 'disabled' }}>
                                                </div>
                                                <div class="col-3">
                                                    <label>Tanggal:</label>
                                                    <input type="date" id="tgl_npi_disabled" name="tgl_npi"
                                                        class="form-control form-input"
                                                        value="{{ old('tgl_npi', $pengawasan->tgl_npi) }}"
                                                        {{ old('tgl_npi', $pengawasan->tgl_npi) ? '' : 'disabled' }}>
                                                </div>
                                            </div>


                                            <!-- Ikhtisar Data -->
                                            <div class="row mb-3 mt-4">
                                                <div class="col-12">
                                                    <div class="card">
                                                        <div class="card-header text-black text-center fw-bold">
                                                            IKHTISAR DATA ATAU INFORMASI
                                                            <button type="button" class="btn p-0 ms-1 text-primary"
                                                                data-bs-toggle="tooltip" data-bs-placement="top"
                                                                data-bs-custom-class="custom-tooltip"
                                                                data-bs-title="Diisi dengan mengapit #isi# disetiap point, dan enter untuk baris baru untuk point baru">
                                                                <i data-feather="alert-circle"
                                                                    style="width: 18px; height: 18px;"></i>
                                                            </button>
                                                        </div>
                                                        <div class="card-body">
                                                            <textarea class="form-control" rows="5" id="ikhtisar_data_lkai" name="ikhtisar_data_lkai"
                                                                placeholder="Isi Ikhtisar Data Atau Informasi Pada Bagian ini">{{ old('ikhtisar_data_lkai', $pengawasan->ikhtisar_data_lkai) }}</textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Prosedur -->
                                            <div class="row mb-3">
                                                <div class="col-12">
                                                    <div class="card">
                                                        <div class="card-header text-black text-center fw-bold">
                                                            PROSEDUR
                                                            <button type="button" class="btn p-0 ms-1 text-primary"
                                                                data-bs-toggle="tooltip" data-bs-placement="top"
                                                                data-bs-custom-class="custom-tooltip"
                                                                data-bs-title="Diisi dengan mengapit #isi# disetiap point, dan enter untuk baris baru untuk point baru">
                                                                <i data-feather="alert-circle"
                                                                    style="width: 18px; height: 18px;"></i>
                                                            </button>
                                                        </div>
                                                        <div class="card-body">
                                                            <textarea class="form-control" rows="5" id="prosedur_analisis_lkai" name="prosedur_analisis_lkai"
                                                                placeholder="Isi Bagian Prosedur Pada Bagian Ini">{{ old('prosedur_analisis_lkai', $pengawasan->prosedur_analisis_lkai) }}</textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Hasil Analisis -->
                                            <div class="row mb-3">
                                                <div class="col-12">
                                                    <div class="card">
                                                        <div class="card-header text-black text-center fw-bold">
                                                            HASIL ANALISIS
                                                            <button type="button" class="btn p-0 ms-1 text-primary"
                                                                data-bs-toggle="tooltip" data-bs-placement="top"
                                                                data-bs-custom-class="custom-tooltip"
                                                                data-bs-title="Diisi dengan mengapit #isi# disetiap point, dan enter untuk baris baru untuk point baru">
                                                                <i data-feather="alert-circle"
                                                                    style="width: 18px; height: 18px;"></i>
                                                            </button>
                                                        </div>
                                                        <div class="card-body">
                                                            <textarea class="form-control" rows="5" id="hasil_analisis_lkai" name="hasil_analisis_lkai"
                                                                placeholder="Isi Bagian Hasil Analisis Pada Bagian Ini">{{ old('hasil_analisis_lkai', $pengawasan->hasil_analisis_lkai) }}</textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Kesimpulan -->
                                            <div class="row mb-3">
                                                <div class="col-12">
                                                    <div class="card">
                                                        <div class="card-header text-black text-center fw-bold">
                                                            KESIMPULAN
                                                        </div>
                                                        <div class="card-body">
                                                            <textarea class="form-control" rows="3" id="kesimpulan" name="kesimpulan_lkai"
                                                                placeholder="Isi Kesimpulan Dibagian ini">{{ old('kesimpulan_lkai', $pengawasan->kesimpulan_lkai) }}</textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Rekomendasi -->
                                            <div class="row mb-3">
                                                <div class="col-12">
                                                    <label class="fw-bold">REKOMENDASI :</label>
                                                </div>
                                            </div>

                                            <!-- Checkbox Rekomendasi -->
                                            <div class="row mb-3">
                                                <div class="col-3">
                                                    <div class="form-check">
                                                        <input class="form-check-input section-select" type="checkbox"
                                                            id="nhi-select" name="nhi" value="YA"
                                                            {{ old('nhi', $pengawasan->nhi) == 'YA' ? 'checked' : '' }}>
                                                        <label class="form-check-label" for="nhi-select">NHI</label>
                                                    </div>
                                                </div>
                                                <div class="col-3">
                                                    <div class="form-check">
                                                        <input class="form-check-input section-select" type="checkbox"
                                                            id="ni-select" name="ni" value="YA"
                                                            {{ old('ni', $pengawasan->ni) == 'YA' ? 'checked' : '' }}>
                                                        <label class="form-check-label" for="ni-select">NI</label>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Rekomendasi Lainnya -->
                                            <div class="row mb-3">
                                                <div class="col-3">
                                                    <div class="form-check">
                                                        <input class="form-check-input section-select" type="checkbox"
                                                            id="rekomendasi_lainnya" name="rekomendasi_lainnya"
                                                            value="YA"
                                                            {{ old('rekomendasi_lainnya', $pengawasan->rekomendasi_lainnya) == 'YA' ? 'checked' : '' }}
                                                            onchange="toggleRekomendasiLainnya(this)">
                                                        <label class="form-check-label"
                                                            for="rekomendasi_lainnya">Rekomendasi Lainnya:</label>
                                                    </div>
                                                </div>
                                                <div class="col-9">
                                                    <textarea class="form-control" id="isi_rekomendasi_lainnya" name="isi_rekomendasi_lainnya" rows="3"
                                                        {{ old('rekomendasi_lainnya', $pengawasan->rekomendasi_lainnya) == 'YA' ? '' : 'disabled' }}>{{ old('isi_rekomendasi_lainnya', $pengawasan->isi_rekomendasi_lainnya) }}</textarea>
                                                </div>
                                            </div>

                                            <!-- Informasi Lainnya -->
                                            <div class="row mb-3">
                                                <div class="col-3">
                                                    <div class="form-check">
                                                        <input class="form-check-input section-select" type="checkbox"
                                                            id="informasi_lainnya" name="informasi_lainnya"
                                                            value="YA"
                                                            {{ old('informasi_lainnya', $pengawasan->informasi_lainnya) == 'YA' ? 'checked' : '' }}
                                                            onchange="toggleInformasiLainnya(this)">
                                                        <label class="form-check-label"
                                                            for="informasi_lainnya">Informasi Lainnya:</label>
                                                    </div>
                                                </div>
                                                <div class="col-9">
                                                    <textarea class="form-control" id="isi_informasi_lainnya" name="isi_informasi_lainnya" rows="3"
                                                        {{ old('informasi_lainnya', $pengawasan->informasi_lainnya) == 'YA' ? '' : 'disabled' }}>{{ old('isi_informasi_lainnya', $pengawasan->isi_informasi_lainnya) }}</textarea>
                                                </div>
                                            </div>


                                            <!-- Tujuan -->
                                            <div class="row mb-3">
                                                <div class="col-2">
                                                    <label class="fw-bold">TUJUAN</label>
                                                </div>
                                                <div class="col-10">
                                                    <input type="text" class="form-control" name="tujuan_lkai"
                                                        placeholder="Tujuan"
                                                        value="{{ old('tujuan_lkai', $pengawasan->tujuan_lkai) }}">
                                                </div>
                                            </div>

                                            <!-- Analis -->
                                            <div class="row mb-5">
                                                <div class="col-12">
                                                    <label class="fw-bold">Analis</label>
                                                </div>
                                                <div class="col-12 mt-4">
                                                    <select class="form-control form-select select2"
                                                        id="id_pegawai_analisis" name="id_pegawai_analisis_lkai">
                                                        <option value="" disabled>- Pilih -</option>
                                                        @foreach ($users as $user)
                                                            <option value="{{ $user->id_admin }}"
                                                                {{ old('id_pegawai_analisis_lkai', $pengawasan->id_pegawai_analisis_lkai) == $user->id_admin ? 'selected' : '' }}>
                                                                {{ $user->name }} | {{ $user->jabatan }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>

                                            <!-- Keputusan Pertama -->
                                            <div class="row mb-3">
                                                <div class="col-12">
                                                    <label class="fw-bold">Keputusan Pertama:</label>
                                                    <select id="keputusan_pertama" class="form-select"
                                                        name="keputusan_pertama_lkai"
                                                        onchange="toggleKeputusanPertama(this)">
                                                        <option value="TIDAK"
                                                            {{ old('keputusan_pertama_lkai', $pengawasan->keputusan_pertama_lkai) == 'TIDAK' ? 'selected' : '' }}>
                                                            Tidak Setuju</option>
                                                        <option value="YA"
                                                            {{ old('keputusan_pertama_lkai', $pengawasan->keputusan_pertama_lkai) == 'YA' ? 'selected' : '' }}>
                                                            Setuju</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div id="keputusanPertamaInputs"
                                                style="display: {{ old('keputusan_pertama_lkai', $pengawasan->keputusan_pertama_lkai) == 'YA' ? 'block' : 'none' }};">
                                                <div class="row mb-3">
                                                    <div class="col-12">
                                                        <label>Pejabat Pengawas:</label>
                                                        <select class="form-control form-input form-select select2"
                                                            id="id_pejabat_pengawas_lkai"
                                                            name="id_pejabat_pengawas_lkai"
                                                            {{ old('keputusan_pertama_lkai', $pengawasan->keputusan_pertama_lkai) == 'YA' ? '' : 'disabled' }}>
                                                            <option value="" disabled>- Pilih -</option>
                                                            @foreach ($users as $user)
                                                                <option value="{{ $user->id_admin }}"
                                                                    {{ old('id_pejabat_pengawas_lkai', $pengawasan->id_pejabat_pengawas_lkai) == $user->id_admin ? 'selected' : '' }}>
                                                                    {{ $user->name }} | {{ $user->jabatan }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="row mb-3">
                                                    <div class="col-12">
                                                        <label>Catatan:</label>
                                                        <textarea class="form-control" rows="2" placeholder="Catatan" id="catatan"
                                                            name="catatan_keputusan_1_lkai">{{ old('catatan_keputusan_1_lkai', $pengawasan->catatan_keputusan_1_lkai) }}</textarea>
                                                    </div>
                                                </div>
                                                <div class="row mb-3">
                                                    <div class="col-12">
                                                        <label>Hasil Analisis Diterima Tanggal:</label>
                                                        <input type="date" class="form-control"
                                                            name="hasil_analisis_diterima_tanggal_1_lkai"
                                                            value="{{ old('hasil_analisis_diterima_tanggal_1_lkai', $pengawasan->hasil_analisis_diterima_tanggal_1_lkai) }}">
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Keputusan Kedua -->
                                            <div class="row mb-3">
                                                <div class="col-12">
                                                    <label class="fw-bold">Keputusan Kedua:</label>
                                                    <select id="keputusan_kedua" class="form-select"
                                                        name="keputusan_kedua_lkai"
                                                        onchange="toggleKeputusanKedua(this)">
                                                        <option value="TIDAK"
                                                            {{ old('keputusan_kedua_lkai', $pengawasan->keputusan_kedua_lkai) == 'TIDAK' ? 'selected' : '' }}>
                                                            Tidak Setuju</option>
                                                        <option value="YA"
                                                            {{ old('keputusan_kedua_lkai', $pengawasan->keputusan_kedua_lkai) == 'YA' ? 'selected' : '' }}>
                                                            Setuju</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div id="keputusanKeduaInputs"
                                                style="display: {{ old('keputusan_kedua_lkai', $pengawasan->keputusan_kedua_lkai) == 'YA' ? 'block' : 'none' }};">
                                                <div class="row mb-3">
                                                    <div class="col-12">
                                                        <label>Pejabat Administrator:</label>
                                                        <select class="form-control form-input form-select select2"
                                                            id="id_pejabat_administrator_lkai"
                                                            name="id_pejabat_administrator_lkai"
                                                            {{ old('keputusan_kedua_lkai', $pengawasan->keputusan_kedua_lkai) == 'YA' ? '' : 'disabled' }}>
                                                            <option value="" disabled>- Pilih -</option>
                                                            @foreach ($users as $user)
                                                                <option value="{{ $user->id_admin }}"
                                                                    {{ old('id_pejabat_administrator_lkai', $pengawasan->id_pejabat_administrator_lkai) == $user->id_admin ? 'selected' : '' }}>
                                                                    {{ $user->name }} | {{ $user->jabatan }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="row mb-3">
                                                    <div class="col-12">
                                                        <label>Catatan:</label>
                                                        <textarea class="form-control" rows="2" placeholder="Catatan" id="catatan"
                                                            name="catatan_keputusan_2_lkai">{{ old('catatan_keputusan_2_lkai', $pengawasan->catatan_keputusan_2_lkai) }}</textarea>
                                                    </div>
                                                </div>
                                                <div class="row mb-3">
                                                    <div class="col-12">
                                                        <label>Hasil Analisis Diterima Tanggal:</label>
                                                        <input type="date" class="form-control"
                                                            name="hasil_analisis_diterima_tanggal_2_lkai"
                                                            value="{{ old('hasil_analisis_diterima_tanggal_2_lkai', $pengawasan->hasil_analisis_diterima_tanggal_2_lkai) }}">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div><!-- end tab pane -->

                                    <div class="tab-pane" id="nhi" role="tabpanel">
                                        <div class="container mt-4 mb-5">
                                            <!-- Header -->
                                            <div class="row mb-4 align-items-center">
                                                <div class="col-2 text-center">
                                                    <img src="/images/logocop.png" alt="Logo" class="img-fluid"
                                                        style="max-height:170px;">
                                                </div>
                                                <div class="col-10 text-center">
                                                    <h5 class="mb-0">KEMENTERIAN KEUANGAN REPUBLIK INDONESIA</h5>
                                                    <p class="small mb-0">DIREKTORAT JENDERAL BEA DAN CUKAI</p>
                                                    <p class="small mb-0">KANTOR PELAYANAN UTAMA BEA DAN CUKAI TIPE
                                                        B BATAM
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

                                            <!-- Title -->
                                            <div class="row mb-4">
                                                <div class="col-12 text-center">
                                                    <h5 class="fw-bold text-decoration-underline">NOTA HASIL INTELIJEN
                                                    </h5>
                                                </div>
                                            </div>

                                            <!-- Main Form -->
                                            <div class="row">
                                                <!-- Left Side -->
                                                <div class="col-md-6">
                                                    <div class="mb-3 row">
                                                        <label class="col-md-3 col-form-label">Nomor</label>
                                                        <div class="col-md-9">
                                                            <div class="input-group">
                                                                <select class="form-select w-25" id="tipe_nhi"
                                                                    name="tipe_nhi">
                                                                    <option value="NHI"
                                                                        {{ old('tipe_nhi', $pengawasan->tipe_nhi) == 'NHI' ? 'selected' : '' }}>
                                                                        NHI</option>
                                                                    <option value="NHI-HKI"
                                                                        {{ old('tipe_nhi', $pengawasan->tipe_nhi) == 'NHI-HKI' ? 'selected' : '' }}>
                                                                        NHI-HKI</option>
                                                                </select>
                                                                <span class="input-group-text">-</span>
                                                                <input type="text" class="form-control nhi-input"
                                                                    id="no_nhi" name="no_nhi"
                                                                    value="{{ old('no_nhi', $pengawasan->no_nhi) }}"
                                                                    placeholder="Nomor NHI"
                                                                    style="{{ old('tipe_nhi', $pengawasan->tipe_nhi) == 'NHI' ? 'display: block;' : 'display: none;' }}">
                                                                <input type="text" class="form-control nhi-hki-input"
                                                                    id="no_nhi_hki" name="no_nhi_hki"
                                                                    value="{{ old('no_nhi_hki', $pengawasan->no_nhi_hki) }}"
                                                                    placeholder="Nomor NHI-HKI"
                                                                    style="{{ old('tipe_nhi', $pengawasan->tipe_nhi) == 'NHI-HKI' ? 'display: block;' : 'display: none;' }}">
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="mb-3 row">
                                                        <label class="col-md-3 col-form-label">Tanggal</label>
                                                        <div class="col-md-9">
                                                            <input type="text" class="form-control nhi-input"
                                                                id="tgl_nhi" name="tgl_nhi"
                                                                value="{{ old('tgl_nhi', $pengawasan->tgl_nhi ?? '') }}"
                                                                style="{{ old('tipe_nhi', $pengawasan->tipe_nhi) == 'NHI' ? 'display: block;' : 'display: none;' }}">
                                                            <input type="text" class="form-control nhi-hki-input"
                                                                id="tgl_nhi_hki" name="tgl_nhi_hki"
                                                                value="{{ old('tgl_nhi_hki', $pengawasan->tgl_nhi_hki ?? '') }}"
                                                                style="{{ old('tipe_nhi', $pengawasan->tipe_nhi) == 'NHI-HKI' ? 'display: block;' : 'display: none;' }}">
                                                        </div>
                                                    </div>

                                                    <div class="mb-3 row">
                                                        <label class="col-md-3 col-form-label">Sifat</label>
                                                        <div class="col-md-9">
                                                            <select class="form-control" id="sifat_nhi"
                                                                name="sifat_nhi">
                                                                <option value="" disabled
                                                                    {{ old('sifat_nhi', $pengawasan->sifat_nhi) ? '' : 'selected' }}>
                                                                    - Pilih -</option>
                                                                <option value="Segera"
                                                                    {{ old('sifat_nhi', $pengawasan->sifat_nhi) == 'Segera' ? 'selected' : '' }}>
                                                                    Segera</option>
                                                                <option value="Sangat Segera"
                                                                    {{ old('sifat_nhi', $pengawasan->sifat_nhi) == 'Sangat Segera' ? 'selected' : '' }}>
                                                                    Sangat Segera</option>
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <div class="mb-3 row">
                                                        <label class="col-md-3 col-form-label">Klasifikasi</label>
                                                        <div class="col-md-9">
                                                            <select class="form-control" id="klasifikasi_nhi"
                                                                name="klasifikasi_nhi">
                                                                <option value="" disabled
                                                                    {{ old('klasifikasi_nhi', $pengawasan->klasifikasi_nhi) ? '' : 'selected' }}>
                                                                    - Pilih -</option>
                                                                <option value="Rahasia"
                                                                    {{ old('klasifikasi_nhi', $pengawasan->klasifikasi_nhi) == 'Rahasia' ? 'selected' : '' }}>
                                                                    Rahasia</option>
                                                                <option value="Sangat Rahasia"
                                                                    {{ old('klasifikasi_nhi', $pengawasan->klasifikasi_nhi) == 'Sangat Rahasia' ? 'selected' : '' }}>
                                                                    Sangat Rahasia</option>
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <div class="mb-3 row">
                                                        <label class="col-md-3 col-form-label">Kepada</label>
                                                        <div class="col-md-9">
                                                            <select class="form-control form-select select2"
                                                                id="id_penerima_nhi" name="id_penerima_nhi">
                                                                <option value="" disabled
                                                                    {{ old('id_penerima_nhi', $pengawasan->id_penerima_nhi) ? '' : 'selected' }}>
                                                                    - Pilih -</option>
                                                                @foreach ($users as $user)
                                                                    <option value="{{ $user->id_admin }}"
                                                                        {{ old('id_penerima_nhi', $pengawasan->id_penerima_nhi) == $user->id_admin ? 'selected' : '' }}>
                                                                        {{ $user->name }} | {{ $user->jabatan }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <div class="mb-3 row">
                                                        <label class="col-md-3 col-form-label">Deskripsi</label>
                                                        <div class="col-md-9">
                                                            <select class="form-control" id="deskripsi"
                                                                name="deskripsi">
                                                                <option value="diperintahkan"
                                                                    {{ old('deskripsi', $pengawasan->deskripsi) == 'diperintahkan' ? 'selected' : '' }}>
                                                                    Diperintahkan</option>
                                                                <option value="direkomendasikan"
                                                                    {{ old('deskripsi', $pengawasan->deskripsi) == 'direkomendasikan' ? 'selected' : '' }}>
                                                                    Direkomendasikan</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- Right Side - Referensi -->
                                                <div class="col-md-6">
                                                    <div class="card">
                                                        <div class="card-header bg-light">
                                                            <h6 class="mb-0">Referensi</h6>
                                                        </div>
                                                        <div class="card-body">
                                                            <div class="mb-3 row">
                                                                <label class="col-md-3 col-form-label">Nomor LKAI</label>
                                                                <div class="col-md-9">
                                                                    <input type="text" class="form-control"
                                                                        value="{{ $pengawasan->no_lkai ?? '' }}"
                                                                        placeholder="Mengikuti Nomor LKAI sebelumnya"
                                                                        readonly>
                                                                </div>
                                                            </div>
                                                            <div class="mb-3 row">
                                                                <label class="col-md-3 col-form-label">Tanggal
                                                                    LKAI</label>
                                                                <div class="col-md-9">
                                                                    <input type="date" class="form-control"
                                                                        value="{{ $pengawasan->tgl_lkai ?? '' }}"
                                                                        placeholder="Mengikuti Tanggal LKAI Sebelumnya"
                                                                        readonly>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Information Section -->
                                            <div class="row mt-4">
                                                <div class="col-12">
                                                    <p>Sehubungan dengan hasil analisis intelijen yang mengindikasikan
                                                        adanya Pelanggaran kepabeanan dan/atau cukai, <span
                                                            id="deskripsi-text">diperintahkan</span> kepada Saudara untuk
                                                        melakukan penindakan terhadap barang/Sarana Pengangkut dengan
                                                        informasi sebagai berikut:</p>
                                                </div>
                                            </div>

                                            <!-- Sections A-F -->
                                            <div class="row mt-3">
                                                <div class="col-12">
                                                    <div class="card mb-3">
                                                        <div class="card-header bg-light">
                                                            <h6 class="mb-0">A. Tempat</h6>
                                                        </div>
                                                        <div class="card-body">
                                                            <div class="mb-3 row">
                                                                <label class="col-md-3 col-form-label">Nama Tempat</label>
                                                                <div class="col-md-9">
                                                                    <input type="text" class="form-control"
                                                                        name="nama_tempat_nhi" placeholder="Nama Tempat"
                                                                        value="{{ old('nama_tempat_nhi', $pengawasan->nama_tempat_nhi ?? '') }}">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="card mb-3">
                                                        <div class="card-header bg-light">
                                                            <h6 class="mb-0">B. Tanggal/Waktu</h6>
                                                        </div>
                                                        <div class="card-body">
                                                            <div class="mb-3 row">
                                                                <label
                                                                    class="col-md-3 col-form-label">Tanggal/Waktu</label>
                                                                <div class="col-md-9">
                                                                    <input type="date" class="form-control"
                                                                        name="tgl_waktu_nhi"
                                                                        value="{{ old('tgl_waktu_nhi', $pengawasan->tgl_waktu_nhi ?? '') }}">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="card mb-3">
                                                        <div class="card-header bg-light">
                                                            <h6 class="mb-0">C. Kantor Bea dan Cukai</h6>
                                                        </div>
                                                        <div class="card-body">
                                                            <div class="mb-3 row">
                                                                <label class="col-md-3 col-form-label">Kantor Bea dan
                                                                    Cukai</label>
                                                                <div class="col-md-9">
                                                                    <input type="text" class="form-control"
                                                                        name="kantor_bc_nhi"
                                                                        placeholder="Kantor Bea dan Cukai"
                                                                        value="{{ old('kantor_bc_nhi', $pengawasan->kantor_bc_nhi ?? 'Kantor Pelayanan Utama Bea dan Cukai Tipe B Batam') }}">
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="card mb-3">
                                                            <div class="card-header bg-light">
                                                                <h6 class="mb-0">D. Kegiatan atas Barang Impor/Ekspor
                                                                </h6>
                                                            </div>
                                                            <div class="card-body">
                                                                <div class="mb-3 row">
                                                                    <label class="col-md-3 col-form-label">1. Nama/No.
                                                                        Dokumen
                                                                        Kepabeanan</label>
                                                                    <div class="col-md-9">
                                                                        <input type="text" class="form-control"
                                                                            name="nama_no_dokumen_kepabeanan_nhi"
                                                                            placeholder="Nama/No. Dokumen Kepabeanan"
                                                                            value="{{ old('nama_no_dokumen_kepabeanan_nhi', $pengawasan->nama_no_dokumen_kepabeanan_nhi ?? '') }}">

                                                                    </div>
                                                                </div>
                                                                <div class="mb-3 row">
                                                                    <label class="col-md-3 col-form-label">2. Eks/Untuk
                                                                        Kapal/Pesawat/Alat Angkut/Lainnya</label>
                                                                    <div class="col-md-9">
                                                                        <input type="text" class="form-control"
                                                                            name="kapal_pesawat_nhi"
                                                                            placeholder="Eks/Untuk Kapal/Pesawat/Alat Angkut/Lainnya"
                                                                            value="{{ old('kapal_pesawat_nhi', $pengawasan->kapal_pesawat_nhi ?? '') }}">

                                                                    </div>
                                                                </div>
                                                                <div class="mb-3 row">
                                                                    <label class="col-md-3 col-form-label">Nomor
                                                                        voyage/Flight/Nomor Polisi</label>
                                                                    <div class="col-md-9">
                                                                        <input type="text" class="form-control"
                                                                            name="no_polisi_nhi"
                                                                            placeholder="Nomor voyage/Flight/Nomor Polisi"
                                                                            value="{{ old('no_polisi_nhi', $pengawasan->no_polisi_nhi ?? '') }}">

                                                                    </div>
                                                                </div>
                                                                <div class="mb-3 row">
                                                                    <label class="col-md-3 col-form-label">3. No.
                                                                        BL/AWB</label>
                                                                    <div class="col-md-9">
                                                                        <input type="text" class="form-control"
                                                                            name="no_bl_awb_nhi"
                                                                            placeholder="No. BL/AWB"
                                                                            value="{{ old('no_bl_awb_nhi', $pengawasan->no_bl_awb_nhi ?? '') }}">

                                                                    </div>
                                                                </div>
                                                                <div class="mb-3 row">
                                                                    <label class="col-md-3 col-form-label">4. No.
                                                                        kontainer/Merek Koli</label>
                                                                    <div class="col-md-9">
                                                                        <input type="text" class="form-control"
                                                                            name="no_kontainer_merk_koli_nhi"
                                                                            placeholder="No. kontainer/Merek Koli"
                                                                            value="{{ old('no_kontainer_merk_koli_nhi', $pengawasan->no_kontainer_merk_koli_nhi ?? '') }}">

                                                                    </div>
                                                                </div>
                                                                <div class="mb-3 row">
                                                                    <label class="col-md-3 col-form-label">5.
                                                                        Importir/Eksportir/PPJK</label>
                                                                    <div class="col-md-9">
                                                                        <input type="text" class="form-control"
                                                                            name="importir_eksportir_nhi"
                                                                            placeholder="Importir/Eksportir/PPJK"
                                                                            value="{{ old('importir_eksportir_nhi', $pengawasan->importir_eksportir_nhi ?? '') }}">
                                                                    </div>
                                                                </div>
                                                                <div class="mb-3 row">
                                                                    <label class="col-md-3 col-form-label">6. NPWP</label>
                                                                    <div class="col-md-9">
                                                                        <input type="text" class="form-control"
                                                                            name="npwp_nhi" placeholder="NPWP"
                                                                            value="{{ old('npwp_nhi', $pengawasan->npwp_nhi ?? '') }}">
                                                                    </div>
                                                                </div>
                                                                <div class="mb-3 row">
                                                                    <label class="col-md-3 col-form-label">7. Jenis/Jumlah
                                                                        barang</label>
                                                                    <div class="col-md-9">
                                                                        <input type="text" class="form-control"
                                                                            name="jenis_jumlah_barang_nhi"
                                                                            placeholder="Jenis/Jumlah barang"
                                                                            value="{{ old('jenis_jumlah_barang_nhi', $pengawasan->jenis_jumlah_barang_nhi ?? '') }}">
                                                                    </div>
                                                                </div>
                                                                <div class="mb-3 row">
                                                                    <label class="col-md-3 col-form-label">8. Data
                                                                        Lainnya</label>
                                                                    <div class="col-md-9">
                                                                        <input type="text" class="form-control"
                                                                            name="data_lainnya_a"
                                                                            placeholder="Data Lainnya"
                                                                            value="{{ old('data_lainnya_a', $pengawasan->data_lainnya_a ?? '') }}">
                                                                    </div>
                                                                </div>

                                                            </div>
                                                        </div>

                                                        <div class="card mb-3">
                                                            <div class="card-header bg-light">
                                                                <h6 class="mb-0">E. Kegiatan atas Barang Kena Cukai</h6>
                                                            </div>
                                                            <div class="card-body">
                                                                <div class="mb-3 row">
                                                                    <label class="col-md-3 col-form-label">1. Eks
                                                                        Pabrik/Tempat Penyimpanan/Tempat Penimbunan</label>
                                                                    <div class="col-md-9">
                                                                        <input type="text" class="form-control"
                                                                            name="eks_pabrik"
                                                                            placeholder="Eks Pabrik/Tempat Penyimpanan/Tempat Penimbunan"
                                                                            value="{{ old('eks_pabrik', $pengawasan->eks_pabrik ?? '') }}">
                                                                    </div>
                                                                </div>
                                                                <div class="mb-3 row">
                                                                    <label class="col-md-3 col-form-label">2.
                                                                        Penyalur</label>
                                                                    <div class="col-md-9">
                                                                        <input type="text" class="form-control"
                                                                            name="penyalur" placeholder="Penyalur"
                                                                            value="{{ old('penyalur', $pengawasan->penyalur ?? '') }}">
                                                                    </div>
                                                                </div>
                                                                <div class="mb-3 row">
                                                                    <label class="col-md-3 col-form-label">3. Tempat
                                                                        Penjualan Eceran</label>
                                                                    <div class="col-md-9">
                                                                        <input type="text" class="form-control"
                                                                            name="tempat_penjualan_eceran"
                                                                            placeholder="Tempat Penjualan Eceran"
                                                                            value="{{ old('tempat_penjualan_eceran', $pengawasan->tempat_penjualan_eceran ?? '') }}">
                                                                    </div>
                                                                </div>
                                                                <div class="mb-3 row">
                                                                    <label class="col-md-3 col-form-label">4.
                                                                        NPPBKC</label>
                                                                    <div class="col-md-9">
                                                                        <input type="text" class="form-control"
                                                                            name="nppbkc" placeholder="NPPBKC"
                                                                            value="{{ old('nppbkc', $pengawasan->nppbkc ?? '') }}">
                                                                    </div>
                                                                </div>
                                                                <div class="mb-3 row">
                                                                    <label class="col-md-3 col-form-label">5. Eks/Untuk
                                                                        Kapal/Pesawat/Alat Angkut/Lainnya</label>
                                                                    <div class="col-md-9">
                                                                        <input type="text" class="form-control"
                                                                            name="kapal_pesawat_b"
                                                                            placeholder="Eks/Untuk Kapal/Pesawat/Alat Angkut/Lainnya"
                                                                            value="{{ old('kapal_pesawat_b', $pengawasan->kapal_pesawat_b ?? '') }}">
                                                                    </div>
                                                                </div>
                                                                <div class="mb-3 row">
                                                                    <label class="col-md-3 col-form-label">Nomor
                                                                        voyage/Flight/Nomor Polisi</label>
                                                                    <div class="col-md-9">
                                                                        <input type="text" class="form-control"
                                                                            name="no_polisi_b"
                                                                            placeholder="Nomor voyage/Flight/Nomor Polisi"
                                                                            value="{{ old('no_polisi_b', $pengawasan->no_polisi_b ?? '') }}">
                                                                    </div>
                                                                </div>
                                                                <div class="mb-3 row">
                                                                    <label class="col-md-3 col-form-label">6. Jenis/Jumlah
                                                                        barang</label>
                                                                    <div class="col-md-9">
                                                                        <input type="text" class="form-control"
                                                                            name="jenis_jumlah_barang_b"
                                                                            placeholder="Jenis/Jumlah barang"
                                                                            value="{{ old('jenis_jumlah_barang_b', $pengawasan->jenis_jumlah_barang_b ?? '') }}">
                                                                    </div>
                                                                </div>
                                                                <div class="mb-3 row">
                                                                    <label class="col-md-3 col-form-label">7. Data
                                                                        Lainnya</label>
                                                                    <div class="col-md-9">
                                                                        <input type="text" class="form-control"
                                                                            name="data_lainnya_b"
                                                                            placeholder="Data Lainnya"
                                                                            value="{{ old('data_lainnya_b', $pengawasan->data_lainnya_b ?? '') }}">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>


                                                        <div class="card mb-3">
                                                            <div class="card-header bg-light">
                                                                <h6 class="mb-0">F. Kegiatan atas Barang Tertentu</h6>
                                                            </div>
                                                            <div class="card-body">
                                                                <div class="mb-3 row">
                                                                    <label class="col-md-3 col-form-label">1. Nama/No.
                                                                        Dokumen</label>
                                                                    <div class="col-md-9">
                                                                        <input type="text" class="form-control"
                                                                            name="nama_no_dok"
                                                                            placeholder="Nama/No. Dokumen"
                                                                            value="{{ old('nama_no_dok', $pengawasan->nama_no_dok ?? '') }}">
                                                                    </div>
                                                                </div>
                                                                <div class="mb-3 row">
                                                                    <label class="col-md-3 col-form-label">2. Eks/Untuk
                                                                        Kapal/Pesawat/Alat Angkut/Lainnya</label>
                                                                    <div class="col-md-9">
                                                                        <input type="text" class="form-control"
                                                                            name="kapal_pesawat_c"
                                                                            placeholder="Eks/Untuk Kapal/Pesawat/Alat Angkut/Lainnya"
                                                                            value="{{ old('kapal_pesawat_c', $pengawasan->kapal_pesawat_c ?? '') }}">
                                                                    </div>
                                                                </div>
                                                                <div class="mb-3 row">
                                                                    <label class="col-md-3 col-form-label">Nomor
                                                                        voyage/Flight/Nomor Polisi</label>
                                                                    <div class="col-md-9">
                                                                        <input type="text" class="form-control"
                                                                            name="no_polisi_c"
                                                                            placeholder="Nomor voyage/Flight/Nomor Polisi"
                                                                            value="{{ old('no_polisi_c', $pengawasan->no_polisi_c ?? '') }}">
                                                                    </div>
                                                                </div>
                                                                <div class="mb-3 row">
                                                                    <label class="col-md-3 col-form-label">3. No.
                                                                        BL/AWB</label>
                                                                    <div class="col-md-9">
                                                                        <input type="text" class="form-control"
                                                                            name="no_bl_awb_b" placeholder="No. BL/AWB"
                                                                            value="{{ old('no_bl_awb_b', $pengawasan->no_bl_awb_b ?? '') }}">
                                                                    </div>
                                                                </div>
                                                                <div class="mb-3 row">
                                                                    <label class="col-md-3 col-form-label">4. No.
                                                                        kontainer/Merek Koli</label>
                                                                    <div class="col-md-9">
                                                                        <input type="text" class="form-control"
                                                                            name="no_kontainer_merek_koli_b"
                                                                            placeholder="No. kontainer/Merek Koli"
                                                                            value="{{ old('no_kontainer_merek_koli_b', $pengawasan->no_kontainer_merek_koli_b ?? '') }}">
                                                                    </div>
                                                                </div>
                                                                <div class="mb-3 row">
                                                                    <label class="col-md-3 col-form-label">5. Orang
                                                                        Pribadi/Badan Hukum</label>
                                                                    <div class="col-md-9">
                                                                        <input type="text" class="form-control"
                                                                            name="orang_pribadi_badan_hukum_nhi"
                                                                            placeholder="Orang Pribadi/Badan Hukum"
                                                                            value="{{ old('orang_pribadi_badan_hukum_nhi', $pengawasan->orang_pribadi_badan_hukum_nhi ?? '') }}">
                                                                    </div>
                                                                </div>
                                                                <div class="mb-3 row">
                                                                    <label class="col-md-3 col-form-label">6. Jenis/Jumlah
                                                                        barang</label>
                                                                    <div class="col-md-9">
                                                                        <input type="text" class="form-control"
                                                                            name="jenis_jumlah_barang_c"
                                                                            placeholder="Jenis/Jumlah barang"
                                                                            value="{{ old('jenis_jumlah_barang_c', $pengawasan->jenis_jumlah_barang_c ?? '') }}">
                                                                    </div>
                                                                </div>
                                                                <div class="mb-3 row">
                                                                    <label class="col-md-3 col-form-label">7. Data
                                                                        Lainnya</label>
                                                                    <div class="col-md-9">
                                                                        <input type="text" class="form-control"
                                                                            name="data_lainnya_c"
                                                                            placeholder="Data Lainnya"
                                                                            value="{{ old('data_lainnya_c', $pengawasan->data_lainnya_c ?? '') }}">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>

                                                <!-- Indikasi -->
                                                <div class="row mt-3">
                                                    <div class="col-12">
                                                        <div class="card">
                                                            <div class="card-header bg-light">
                                                                <h6 class="mb-0">Indikasi</h6>
                                                            </div>
                                                            <div class="card-body">
                                                                <div class="mb-3">
                                                                    <textarea class="form-control" rows="4" placeholder="Indikasi" id="indikasi" name="indikasi_nhi">{{ old('indikasi_nhi', $pengawasan->indikasi_nhi ?? '') }}</textarea>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- Closing and Signatures -->
                                                <div class="row mt-4">
                                                    <div class="col-12">
                                                        <p>Demikian disampaikan agar pelaksanaan Nota Hasil Intelijen ini
                                                            dilaporkan pada kesempatan pertama.</p>
                                                    </div>
                                                </div>

                                                <div class="row mt-4">
                                                    <div class="col-6">
                                                        <!-- Left empty for formatting -->
                                                    </div>
                                                    <div class="col-6 text-center">
                                                        <p>Pejabat Penerbit NHI</p>
                                                        <div class="mb-3">
                                                            <select class="form-control form-select select2"
                                                                id="id_pejabat_penerbit_nhi"
                                                                name="id_pejabat_penerbit_nhi">
                                                                <option value="" disabled
                                                                    {{ empty(old('id_pejabat_penerbit_nhi', $pengawasan->id_pejabat_penerbit_nhi ?? '')) ? 'selected' : '' }}>
                                                                    - Pilih -</option>
                                                                @foreach ($users as $user)
                                                                    <option value="{{ $user->id_admin }}"
                                                                        {{ old('id_pejabat_penerbit_nhi', $pengawasan->id_pejabat_penerbit_nhi ?? '') == $user->id_admin ? 'selected' : '' }}>
                                                                        {{ $user->name }} | {{ $user->jabatan }}
                                                                    </option>
                                                                @endforeach
                                                            </select>

                                                        </div>
                                                        <p>.....................................</p>
                                                        <p>*) coret yang tidak perlu</p>
                                                    </div>
                                                </div>


                                            </div>
                                        </div>
                                    </div>

                                    <div class="tab-pane" id="ni" role="tabpanel">
                                        <div class="container mt-4 mb-5">
                                            <div class="row mb-4 align-items-center">
                                                <div class="col-2 text-center">
                                                    <img src="/images/logocop.png" alt="Logo" class="img-fluid"
                                                        style="max-height:170px;">
                                                </div>
                                                <div class="col-10 text-center">
                                                    <h5 class="mb-0">KEMENTERIAN KEUANGAN REPUBLIK INDONESIA</h5>
                                                    <p class="small mb-0">DIREKTORAT JENDERAL BEA DAN CUKAI</p>
                                                    <p class="small mb-0">KANTOR PELAYANAN UTAMA BEA DAN CUKAI TIPE
                                                        B BATAM
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

                                            <div class="row justify-content-center">
                                                <div class="col-10">
                                                    <div class="text-center mb-4">
                                                        <h5 class="fw-bold border-bottom border-dark pb-2">NOTA
                                                            INFORMASI
                                                        </h5>
                                                    </div>
                                                    <div class="row mb-4">
                                                        <div class="col-md-6">
                                                            <div class="row mb-2">
                                                                <label class="col-4 col-form-label">Nomor</label>
                                                                <div class="col-8">
                                                                    <div class="input-group">
                                                                        <span class="input-group-text">NI-</span>
                                                                        <input type="text" class="form-control"
                                                                            id="no_ni" name="no_ni"
                                                                            placeholder="NI-"
                                                                            value="{{ old('no_ni', $pengawasan->no_ni) }}">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row mb-2">
                                                                <label class="col-4 col-form-label">Tanggal</label>
                                                                <div class="col-8">
                                                                    <input type="date" class="form-control"
                                                                        id="tgl_ni" name="tgl_ni"
                                                                        value="{{ old('tgl_ni', $pengawasan->tgl_ni) }}">
                                                                </div>
                                                            </div>
                                                            <div class="row mb-2">
                                                                <label class="col-4 col-form-label">Sifat</label>
                                                                <div class="col-8">
                                                                    <select class="form-select" id="sifat_ni"
                                                                        name="sifat_ni">
                                                                        <option value="" disabled
                                                                            {{ old('sifat_ni', $pengawasan->sifat_ni) == '' ? 'selected' : '' }}>
                                                                            - Pilih -</option>
                                                                        <option value="Segera"
                                                                            {{ old('sifat_ni', $pengawasan->sifat_ni) == 'Segera' ? 'selected' : '' }}>
                                                                            Segera</option>
                                                                        <option value="Sangat Segera"
                                                                            {{ old('sifat_ni', $pengawasan->sifat_ni) == 'Sangat Segera' ? 'selected' : '' }}>
                                                                            Sangat Segera</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="row mb-2">
                                                                <label class="col-4 col-form-label">Klasifikasi</label>
                                                                <div class="col-8">
                                                                    <select class="form-select" id="klasifikasi_ni"
                                                                        name="klasifikasi_ni">
                                                                        <option value="" disabled
                                                                            {{ old('klasifikasi_ni', $pengawasan->klasifikasi_ni) == '' ? 'selected' : '' }}>
                                                                            - Pilih -</option>
                                                                        <option value="Rahasia"
                                                                            {{ old('klasifikasi_ni', $pengawasan->klasifikasi_ni) == 'Rahasia' ? 'selected' : '' }}>
                                                                            Rahasia</option>
                                                                        <option value="Sangat Rahasia"
                                                                            {{ old('klasifikasi_ni', $pengawasan->klasifikasi_ni) == 'Sangat Rahasia' ? 'selected' : '' }}>
                                                                            Sangat Rahasia</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="row mb-2">
                                                                <label class="col-4 col-form-label">Referensi</label>
                                                            </div>
                                                            <div class="row mb-2">
                                                                <label class="col-4 col-form-label">Nomor LKAI</label>
                                                                <div class="col-8">
                                                                    <input type="text" class="form-control"
                                                                        value="{{ $pengawasan->no_lkai ?? '' }}"
                                                                        placeholder="Mengikuti Nomor LKAI sebelumnya"
                                                                        readonly>
                                                                </div>
                                                            </div>
                                                            <div class="row mb-2">
                                                                <label class="col-4 col-form-label">Tanggal LKAI</label>
                                                                <div class="col-8">
                                                                    <input type="date" class="form-control"
                                                                        value="{{ $pengawasan->tgl_lkai ?? '' }}"
                                                                        placeholder="Mengikuti Tanggal LKAI Sebelumnya"
                                                                        readonly>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>


                                                    <div class="row mb-4">
                                                        <div class="col-12">
                                                            <p class="mb-2 fst-italic">
                                                                Sehubungan dengan hasil analisis intelijen yang
                                                                mengindikasikan adanya pelanggaran ketentuan dan/atau diduga
                                                                adanya barang, disampaikan informasi agar dapat dilakukan
                                                                penelitian mendalam tentang informasi sebagai berikut:
                                                            </p>

                                                            <div class="mb-3">
                                                                <label class="form-label fw-bold">A.</label>
                                                                <div class="row">
                                                                    <div class="col-11 offset-1">
                                                                        <input type="text" class="form-control"
                                                                            name="komoditi_ni" id="komoditi_ni"
                                                                            placeholder="Isi Komoditi"
                                                                            value="{{ old('komoditi_ni', $pengawasan->komoditi_ni) }}">
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="mb-3">
                                                                <label class="form-label fw-bold">B.</label>
                                                                <div class="row">
                                                                    <div class="col-11 offset-1">
                                                                        <input type="text" class="form-control mb-2"
                                                                            name="kantor_ni" id="kantor_ni"
                                                                            placeholder="Isi Kantor Tujuan"
                                                                            value="{{ old('kantor_ni', $pengawasan->kantor_ni) }}">
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="mb-3">
                                                                <label class="form-label fw-bold">C.</label>
                                                                <div class="row">
                                                                    <div class="col-11 offset-1">
                                                                        <input type="text" class="form-control mb-2"
                                                                            name="ppjk_ni" id="ppjk_ni"
                                                                            placeholder="Nama PPJK/Ekspedisi"
                                                                            value="{{ old('ppjk_ni', $pengawasan->ppjk_ni) }}">
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-11 offset-1">
                                                                        <input type="text" class="form-control mb-2"
                                                                            name="nodok_ni" id="nodok_ni"
                                                                            placeholder="No. Dokumen"
                                                                            value="{{ old('nodok_ni', $pengawasan->nodok_ni) }}">
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="mb-3">
                                                                <label class="form-label fw-bold">D.
                                                                    Pengirim/Penerima</label>
                                                                <div class="row mb-2">
                                                                    <div class="col-md-6">
                                                                        <div class="input-group">
                                                                            <span class="input-group-text"
                                                                                style="width: 120px;">Nama Pengirim</span>
                                                                            <input type="text" class="form-control"
                                                                                name="nama_pengirim_ni"
                                                                                id="nama_pengirim_ni"
                                                                                placeholder="Nama Pengirim"
                                                                                value="{{ old('nama_pengirim_ni', $pengawasan->nama_pengirim_ni) }}">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div class="input-group">
                                                                            <span class="input-group-text"
                                                                                style="width: 120px;">Nomor
                                                                                Pengirim</span>
                                                                            <input type="text" class="form-control"
                                                                                name="nomor_pengirim_ni"
                                                                                id="nomor_pengirim_ni"
                                                                                placeholder="Nomor Pengirim"
                                                                                value="{{ old('nomor_pengirim_ni', $pengawasan->nomor_pengirim_ni) }}">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-md-6">
                                                                        <div class="input-group">
                                                                            <span class="input-group-text"
                                                                                style="width: 120px;">Nama Penerima</span>
                                                                            <input type="text" class="form-control"
                                                                                name="nama_penerima_ni"
                                                                                id="nama_penerima_ni"
                                                                                placeholder="Nama Penerima"
                                                                                value="{{ old('nama_penerima_ni', $pengawasan->nama_penerima_ni) }}">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div class="input-group">
                                                                            <span class="input-group-text"
                                                                                style="width: 120px;">Nomor
                                                                                Penerima</span>
                                                                            <input type="text" class="form-control"
                                                                                name="nomor_penerima_ni"
                                                                                id="nomor_penerima_ni"
                                                                                placeholder="Nomor Penerima"
                                                                                value="{{ old('nomor_penerima_ni', $pengawasan->nomor_penerima_ni) }}">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="mb-3">
                                                                <label class="form-label fw-bold">E. Detail Barang</label>
                                                                <div class="row mb-2">
                                                                    <div class="col-md-6">
                                                                        <div class="input-group">
                                                                            <span class="input-group-text"
                                                                                style="width: 120px;">Asal Barang</span>
                                                                            <input type="text" class="form-control"
                                                                                name="asal_barang_ni"
                                                                                id="asal_barang_ni"
                                                                                placeholder="Asal Barang"
                                                                                value="{{ old('asal_barang_ni', $pengawasan->asal_barang_ni) }}">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div class="input-group">
                                                                            <span class="input-group-text"
                                                                                style="width: 120px;">Tujuan Barang</span>
                                                                            <input type="text" class="form-control"
                                                                                name="tujuan_barang_ni"
                                                                                id="tujuan_barang_ni"
                                                                                placeholder="Tujuan Barang"
                                                                                value="{{ old('tujuan_barang_ni', $pengawasan->tujuan_barang_ni) }}">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="row mb-2">
                                                                    <div class="col-md-6">
                                                                        <div class="input-group">
                                                                            <span class="input-group-text"
                                                                                style="width: 120px;">Berat Barang</span>
                                                                            <input type="text" class="form-control"
                                                                                name="berat_barang_ni"
                                                                                id="berat_barang_ni"
                                                                                placeholder="Berat Barang"
                                                                                value="{{ old('berat_barang_ni', $pengawasan->berat_barang_ni) }}">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div class="input-group">
                                                                            <span class="input-group-text"
                                                                                style="width: 120px;">Komoditi
                                                                                Atensi</span>
                                                                            <input type="text" class="form-control"
                                                                                name="komoditi_atensi_ni"
                                                                                id="komoditi_atensi_ni"
                                                                                placeholder="Komoditi Atensi"
                                                                                value="{{ old('komoditi_atensi_ni', $pengawasan->komoditi_atensi_ni) }}">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="row mb-2">
                                                                    <div class="col-md-6">
                                                                        <div class="input-group">
                                                                            <span class="input-group-text"
                                                                                style="width: 120px;">Pemberitahuan</span>
                                                                            <input type="text" class="form-control"
                                                                                name="pemberitahuan_barang_ni"
                                                                                id="pemberitahuan_barang_ni"
                                                                                placeholder="Pemberitahuan Barang"
                                                                                value="{{ old('pemberitahuan_barang_ni', $pengawasan->pemberitahuan_barang_ni) }}">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div class="input-group">
                                                                            <span class="input-group-text"
                                                                                style="width: 120px;">Sarana Angkut</span>
                                                                            <input type="text" class="form-control"
                                                                                name="sarkut_ni" id="sarkut_ni"
                                                                                placeholder="Nama Sarana Pengangkut"
                                                                                value="{{ old('sarkut_ni', $pengawasan->sarkut_ni) }}">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-md-6">
                                                                        <div class="input-group">
                                                                            <span class="input-group-text"
                                                                                style="width: 120px;">Estimasi Tiba</span>
                                                                            <input type="datetime-local"
                                                                                class="form-control"
                                                                                name="estimasi_tiba_ni"
                                                                                id="datetime-datepicker"
                                                                                value="{{ old('estimasi_tiba_ni', \Carbon\Carbon::parse($pengawasan->estimasi_tiba_ni)->format('Y-m-d\TH:i')) }}">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>


                                                    <div class="row mb-4">
                                                        <div class="col-12">
                                                            <p class="mb-3">Demikian disampaikan atas perhatian
                                                                Bapak/Ibu/Saudara *) diucapkan terima kasih untuk
                                                                mendapat
                                                                perhatian.</p>
                                                        </div>
                                                    </div>

                                                    <div class="row mb-4">
                                                        <div class="col-6">
                                                            <p class="form-text">Tembusan : .....(12)......</p>
                                                            <p class="form-text">*) coret yang tidak perlu</p>
                                                        </div>
                                                        <div class="col-6 text-center">
                                                            <p>................(9)...............</p>
                                                            <br><br><br>
                                                            <p>................(10).............</p>
                                                            <p>................(11).............</p>
                                                        </div>
                                                    </div>

                                                    <div class="row mb-4">
                                                        <div class="col-12">
                                                            <h6 class="fw-bold">Pejabat Penerima dan Penerbit</h6>
                                                            <hr>
                                                            <div class="row mb-3">
                                                                <div class="col-md-6">
                                                                    <label class="form-label">Pejabat Penerima
                                                                        NI</label>
                                                                    <select class="form-control form-select select2"
                                                                        id="id_pejabat_penerima_ni"
                                                                        name="id_pejabat_penerima_ni">
                                                                        <option value="" disabled
                                                                            {{ old('id_pejabat_penerima_ni', $pengawasan->id_pejabat_penerima_ni) == '' ? 'selected' : '' }}>
                                                                            - Pilih -
                                                                        </option>
                                                                        @foreach ($users as $user)
                                                                            <option value="{{ $user->id_admin }}"
                                                                                {{ old('id_pejabat_penerima_ni', $pengawasan->id_pejabat_penerima_ni) == $user->id_admin ? 'selected' : '' }}>
                                                                                {{ $user->name }} |
                                                                                {{ $user->jabatan }}
                                                                            </option>
                                                                        @endforeach
                                                                    </select>

                                                                </div>
                                                                <div class="col-md-6">
                                                                    <label class="form-label">Pejabat Penerbit
                                                                        NI</label>
                                                                    <select class="form-control form-select select2"
                                                                        id="id_pejabat_penerbit_ni"
                                                                        name="id_pejabat_penerbit_ni">
                                                                        <option value="" selected disabled>-
                                                                            Pilih -
                                                                        </option>
                                                                        @foreach ($users as $user)
                                                                            <option value="{{ $user->id_admin }}"
                                                                                {{ old('id_pejabat_penerbit_ni') == $user->id_admin ? 'selected' : '' }}>
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

                                    <div class="tab-pane" id="nota-dinas-content" role="tabpanel">
                                        <div class="row mb-4 align-items-center">
                                            <div class="col-2 text-center">
                                                <img src="/images/logocop.png" alt="Logo" class="img-fluid"
                                                    style="max-height:170px;">
                                            </div>
                                            <div class="col-10 text-center">
                                                <h5 class="mb-0">KEMENTERIAN KEUANGAN REPUBLIK INDONESIA</h5>
                                                <p class="small mb-0">DIREKTORAT JENDERAL BEA DAN CUKAI</p>
                                                <p class="small mb-0">KANTOR PELAYANAN UTAMA BEA DAN CUKAI TIPE B
                                                    BATAM
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


                                        <div class="mb-3">
                                            <label for="notaDinasFile" class="form-label">Upload Surat Nota
                                                Dinas</label>
                                            <input type="file" class="form-control" id="notaDinasFile"
                                                name="nota_dinas_file">

                                            @if (!empty($pengawasan->nota_dinas_file))
                                                <small class="text-muted mt-2 d-block">
                                                    File saat ini: <a
                                                        href="{{ asset('storage/' . $pengawasan->nota_dinas_file) }}"
                                                        target="_blank">Lihat File</a>
                                                </small>
                                            @endif
                                        </div>

                                    </div>




                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer d-flex justify-content-end">
                        <button type="submit" class="btn btn-success btn-sm me-2">
                            <i data-feather="save"></i> Simpan Data
                        </button>
                    </div>
                </div>
            </div>

    </div>
    </form>
    </div>


    <script>
        function toggleInternal() {
            const checkbox = document.getElementById('internal_check');
            const form = document.getElementById('internal_form');
            const hiddenInput = document.getElementById('internal');

            if (checkbox.checked) {
                form.style.display = 'block';
                hiddenInput.value = 'YA';
            } else {
                form.style.display = 'none';
                hiddenInput.value = 'TIDAK';
            }
        }

        function toggleEksternal() {
            const checkbox = document.getElementById('eksternal_check');
            const form = document.getElementById('eksternal_form');
            const hiddenInput = document.getElementById('eksternal');

            if (checkbox.checked) {
                form.style.display = 'block';
                hiddenInput.value = 'YA';
            } else {
                form.style.display = 'none';
                hiddenInput.value = 'TIDAK';
            }
        }

        document.addEventListener('DOMContentLoaded', function() {
            toggleInternal();
            toggleEksternal();
        });
    </script>

    <script>
        let ikhtisarCount = {{ count($ikhtisar) }};

        function tambahIkhtisar() {
            ikhtisarCount++;
            const container = document.getElementById('ikhtisar-container');
            const rowCount = container.getElementsByTagName('tr').length + 1;

            const newRow = document.createElement('tr');
            newRow.setAttribute('id', `ikhtisar-row-${ikhtisarCount}`);

            newRow.innerHTML = `
            <td class="text-center">${rowCount}.</td>
            <td><textarea class="form-control" rows="2" name="ikhtisar[${ikhtisarCount}][ikhtisar]" placeholder="Ikhtisar"></textarea></td>
            <td><input type="text" class="form-control" name="ikhtisar[${ikhtisarCount}][sumber]" placeholder="Sumber"></td>
            <td>
                <div class="d-flex">
                    <input type="text" class="form-control" name="ikhtisar[${ikhtisarCount}][validitas]" placeholder="Validitas">
                    <button type="button" class="btn btn-danger btn-sm ms-1" onclick="document.getElementById('ikhtisar-row-${ikhtisarCount}').remove()">
                        <i class="bi bi-trash"></i> Hapus
                    </button>
                </div>
            </td>
        `;

            container.appendChild(newRow);
        }
    </script>


    <script>
        function syncLppiValues() {
            const inputSource = document.getElementById('no_lppi');
            const inputSource2 = document.getElementById('tgl_lppi');
            const inputTarget = document.getElementById('no_lppi_disabled');
            const inputTarget2 = document.getElementById('tgl_lppi_disabled');

            if (inputSource && inputTarget) {
                inputTarget.value = inputSource.value;
            }
            if (inputSource2 && inputTarget2) {
                inputTarget2.value = inputSource2.value;
            }

        }


        function toggleLppiInputs(checkbox) {
            const noLppiInput = document.getElementById('no_lppi_disabled');
            const tglLppiInput = document.getElementById('tgl_lppi_disabled');

            if (!noLppiInput || !tglLppiInput) return;

            const isEnabled = checkbox.checked;

            noLppiInput.disabled = !isEnabled;
            tglLppiInput.disabled = !isEnabled;

            if (isEnabled) {
                syncLppiValues();
            } else {
                noLppiInput.value = '';
                tglLppiInput.value = '';
            }
        }


        // 🔁 Real-time update jika sumber input berubah
        function attachInputListeners() {
            const noLppi = document.getElementById('no_lppi');
            const tglLppi = document.getElementById('tgl_lppi');

            if (noLppi) noLppi.addEventListener('input', syncLppiValues);
            if (tglLppi) tglLppi.addEventListener('input', syncLppiValues);
        }

        // 🚀 Init saat halaman siap
        document.addEventListener("DOMContentLoaded", function() {
            const lppiCheck = document.getElementById('lppi_check');

            if (lppiCheck) {
                lppiCheck.addEventListener('change', function() {
                    toggleLppiInputs(this);
                });
                toggleLppiInputs(lppiCheck); // initial state
            }


            attachInputListeners(); // listen for real-time typing
        });
    </script>

    <script>
        function toggleRekomendasiLainnya(checkbox) {
            document.getElementById('isi_rekomendasi_lainnya').disabled = !checkbox.checked;
        }

        function toggleInformasiLainnya(checkbox) {
            document.getElementById('isi_informasi_lainnya').disabled = !checkbox.checked;
        }

        function handleSelection(selectedCheckbox) {
            const allCheckboxes = document.querySelectorAll('.section-select');
            allCheckboxes.forEach(checkbox => {
                if (checkbox !== selectedCheckbox) {
                    checkbox.disabled = selectedCheckbox.checked;
                    checkbox.classList.toggle('text-muted', checkbox.disabled);
                }
            });
        }

        document.addEventListener('DOMContentLoaded', () => {
            const checkboxes = [{
                    id: "nhi-select",
                    tab: "nhi-tab-item"
                },
                {
                    id: "ni-select",
                    tab: "ni-tab-item"
                },
                {
                    id: "rekomendasi_lainnya",
                    tab: "nota-dinas-tab-item"
                },
            ];

            checkboxes.forEach(({
                id,
                tab
            }) => {
                const checkboxElement = document.getElementById(id);
                const tabElement = document.getElementById(tab);

                const handleTabVisibility = () => {
                    if (checkboxElement && tabElement) {
                        if (checkboxElement.checked) {
                            tabElement.style.display = "block";
                            tabElement.classList.add("fade-in", "active");

                            const tabContainer = document.querySelector(".tabs-container");
                            if (tabContainer) {
                                const offsetTop = tabContainer.offsetTop;
                                window.scrollTo({
                                    top: offsetTop - 70,
                                    behavior: "smooth"
                                });
                            }

                            const tabLink = tabElement.querySelector(".nav-link");
                            if (tabLink) {
                                tabLink.classList.add("highlight");
                                setTimeout(() => tabLink.classList.remove("highlight"), 1000);
                            }
                        } else {
                            tabElement.style.display = "none";
                            tabElement.classList.remove("active");
                        }
                    }
                };

                checkboxElement?.addEventListener("change", () => {
                    handleTabVisibility();
                    handleSelection(checkboxElement);
                });

                // Initial state on load
                handleTabVisibility();
                if (checkboxElement?.checked) {
                    handleSelection(checkboxElement);
                }
            });

            // Untuk handle textarea saat edit
            toggleRekomendasiLainnya(document.getElementById("rekomendasi_lainnya"));
            toggleInformasiLainnya(document.getElementById("informasi_lainnya"));
        });
    </script>


    <script>
        function toggleKeputusanPertama(select) {
            const inputsDiv = document.getElementById('keputusanPertamaInputs');
            const pejabatSelect = document.getElementById('id_pejabat_pengawas_lkai');
            if (select.value === 'YA') {
                inputsDiv.style.display = 'block';
                pejabatSelect.disabled = false;
            } else {
                inputsDiv.style.display = 'none';
                pejabatSelect.disabled = true;
            }
        }

        // Inisialisasi toggle saat halaman load
        document.addEventListener('DOMContentLoaded', function() {
            const keputusanSelect = document.getElementById('keputusan_pertama');
            toggleKeputusanPertama(keputusanSelect);
        });
    </script>

    <script>
        function toggleKeputusanKedua(select) {
            const inputsDiv = document.getElementById('keputusanKeduaInputs');
            const pejabatSelect = document.getElementById('id_pejabat_administrator_lkai');
            if (select.value === 'YA') {
                inputsDiv.style.display = 'block';
                pejabatSelect.disabled = false;
            } else {
                inputsDiv.style.display = 'none';
                pejabatSelect.disabled = true;
            }
        }

        document.addEventListener('DOMContentLoaded', function() {
            const keputusanSelect = document.getElementById('keputusan_kedua');
            toggleKeputusanKedua(keputusanSelect);
        });
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


    <style>
        .nav-link.highlight {
            color: #287F71 !important;
            transition: background-color 0.5s ease;
        }
    </style>

    <script>
        function toggleNhiFields(tipe) {
            document.querySelectorAll('.nhi-input').forEach(el => el.style.display = 'none');
            document.querySelectorAll('.nhi-hki-input').forEach(el => el.style.display = 'none');

            if (tipe === 'NHI') {
                document.querySelectorAll('.nhi-input').forEach(el => el.style.display = 'block');
            } else if (tipe === 'NHI-HKI') {
                document.querySelectorAll('.nhi-hki-input').forEach(el => el.style.display = 'block');
            }
        }

        document.getElementById('tipe_nhi').addEventListener('change', function() {
            toggleNhiFields(this.value);
        });

        document.getElementById('deskripsi').addEventListener('change', function() {
            document.getElementById('deskripsi-text').textContent = this.value === 'diperintahkan' ?
                'diperintahkan' : 'direkomendasikan';
        });

        document.querySelector('form').addEventListener('submit', function(event) {
            const tipe = document.getElementById('tipe_nhi').value;

            if (tipe === 'NHI') {
                document.querySelectorAll('.nhi-hki-input input').forEach(input => input.value = '');
            } else if (tipe === 'NHI-HKI') {
                document.querySelectorAll('.nhi-input input').forEach(input => input.value = '');
            }
        });

        window.addEventListener('DOMContentLoaded', function() {
            const tipe = document.getElementById('tipe_nhi').value;
            toggleNhiFields(tipe);
        });
    </script>

    <script>
        function setMediaModal(fileUrls, type) {
            if (type === 'foto') {
                const modalBody = document.getElementById('fotoModalBody');
                modalBody.innerHTML = '';

                if (typeof fileUrls === 'string') {
                    fileUrls = JSON.parse(fileUrls);
                }

                fileUrls.forEach(function(fotoUrl) {
                    const img = document.createElement('img');
                    img.src = `{{ asset('storage/') }}/${fotoUrl}`;
                    img.className = 'img-fluid w-100 mb-2';
                    img.alt = 'Foto Laporan Pengawasan';


                    modalBody.appendChild(img);
                });
            } else if (type === 'audio') {
                document.getElementById('audioModalPlayer').src = fileUrls;
            } else if (type === 'video') {
                document.getElementById('videoModalPlayer').src = fileUrls;
            }
        }
    </script>



    <style>
        .aa {
            background-color: #e9ecef !important;
            color: #6c757d !important;
        }
    </style>
@endsection

@section('script')
    @vite(['resources/js/pages/datatable.init.js'])
@endsection
