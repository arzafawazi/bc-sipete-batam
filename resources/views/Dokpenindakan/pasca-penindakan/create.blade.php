@extends('layouts.vertical', ['title' => 'Rekam Form Pasca Penindakan'])

@section('css')
    @vite(['node_modules/datatables.net-bs5/css/dataTables.bootstrap5.min.css', 'node_modules/datatables.net-buttons-bs5/css/buttons.bootstrap5.min.css', 'node_modules/datatables.net-keytable-bs5/css/keyTable.bootstrap5.min.css', 'node_modules/datatables.net-responsive-bs5/css/responsive.bootstrap5.min.css', 'node_modules/datatables.net-select-bs5/css/select.bootstrap5.min.css'])
@endsection


@section('content')
    <div class="container-fluid">
        <form action="{{ route('pasca-penindakan.store') }}" method="POST">
            @csrf
            <div class="card mb-3 mt-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="card-title mb-0">
                        <i data-feather="book" style="width: 20px; height: 20px;" class="me-1"></i>
                        Form Pasca Penindakan
                    </h5>
                    <button type="button" class="btn btn-danger btn-sm" onclick="window.history.back()">
                        <i data-feather="log-out"></i> Kembali
                    </button>
                </div>

                <div class="card-body">
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="card">
                                <div class="tabs-container" id="tabs-container">
                                    <ul class="nav nav-pills nav-justified flex-nowrap overflow-auto bg-light p-2 rounded shadow-sm"
                                        style="white-space: nowrap;" role="tablist">
                                        <li class="nav-item me-2">
                                            <a class="nav-link active" id="lphp-tab" data-bs-toggle="pill" href="#lphp"
                                                role="tab" aria-controls="lphp" aria-selected="true">
                                                <span class="d-block d-sm-none">(LPHP)</span>
                                                <span class="d-none d-sm-block">Laporan Penentuan Hasil Penindakan
                                                    (LPHP)</span>
                                            </a>
                                        </li>
                                        <li class="nav-item me-2">
                                            <a class="nav-link" id="bast-pemilik-tab" data-bs-toggle="pill"
                                                href="#bast-pemilik" role="tab" aria-controls="bast-pemilik"
                                                aria-selected="false">
                                                <span class="d-block d-sm-none">(BAST Pemilik)</span>
                                                <span class="d-none d-sm-block">BAST Pemilik</span>
                                            </a>
                                        </li>
                                        <li class="nav-item me-2">
                                            <a class="nav-link" id="bast-instansi-tab" data-bs-toggle="pill"
                                                href="#bast-instansi" role="tab" aria-controls="bast-instansi"
                                                aria-selected="false">
                                                <span class="d-block d-sm-none">(BAST Instansi)</span>
                                                <span class="d-none d-sm-block">BAST Instansi</span>
                                            </a>
                                        </li>
                                        <li class="nav-item me-2">
                                            <a class="nav-link" id="lp-tab" data-bs-toggle="pill" href="#lp"
                                                role="tab" aria-controls="lp" aria-selected="false">
                                                <span class="d-block d-sm-none">(LP)</span>
                                                <span class="d-none d-sm-block">Laporan Pelanggaran (LP)</span>
                                            </a>
                                        </li>
                                        <li class="nav-item me-2">
                                            <a class="nav-link" id="bast-penyidik-tab" data-bs-toggle="pill"
                                                href="#bast-penyidik" role="tab" aria-controls="bast-penyidik"
                                                aria-selected="false">
                                                <span class="d-block d-sm-none">BAST Penyidik</span>
                                                <span class="d-none d-sm-block">BAST Penyidik</span>
                                            </a>
                                        </li>
                                        <li class="nav-item me-2">
                                            <a class="nav-link" id="lpt-tab" data-bs-toggle="pill" href="#lpt"
                                                role="tab" aria-controls="lpt" aria-selected="false">
                                                <span class="d-block d-sm-none">(LPT)</span>
                                                <span class="d-none d-sm-block">Laporan Pelaksana Tugas (LPT)</span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>

                                <div class="tab-content p-0 text-muted mt-md-3" id="v-pills-tabContent">

                                    <div class="tab-pane fade show active" id="lphp" role="tabpanel"
                                        aria-labelledby="lphp-tab">
                                        <div class="container mt-4">
                                            <!-- Header dengan Logo -->
                                            <div class="row mb-4 align-items-center">
                                                <div class="col-2 text-center">
                                                    <img src="/images/logocop.png" alt="Logo" class="img-fluid"
                                                        style="max-height:170px;">
                                                </div>
                                                <div class="col-10 text-center">
                                                    <h5 class="mb-0">KEMENTERIAN KEUANGAN REPUBLIK
                                                        INDONESIA
                                                    </h5>
                                                    <p class="small mb-0">DIREKTORAT JENDERAL BEA DAN CUKAI
                                                    </p>
                                                    <p class="small mb-0">KANTOR PELAYANAN UTAMA BEA DAN
                                                        CUKAI
                                                        TIPE B BATAM
                                                    </p>
                                                    <p class="small mb-0">
                                                        JALAN KUDA LAUT, BATU AMPAR, BATAM, KEPULAUAN RIAU
                                                        29432;
                                                        TELEPON (0778) 458118, 458263; FAKSIMILE (0778)
                                                        458149;
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

                                            <p class="mb-2">
                                                <span class="text-danger">*</span> Isian dengan keterangan
                                                <span class="text-danger">"terisi otomatis"</span> di atas
                                                berasal dari data sebelumnya yang telah diinput melalui Data
                                                Penindakan.
                                            </p>


                                            <!-- Nomor dan Tanggal -->
                                            <div class="text-center mb-4">
                                                <h5 class="fw-bold">LAPORAN DAN PENENTUAN HASIL PENINDAKAN</h5>
                                                <div class="input-group flex-wrap">
                                                    <span class="input-group-text">NOMOR : LPHP-</span>
                                                    <input type="text" class="form-control" name="no_lphp"
                                                        id="no_lphp" value="{{ old('no_lphp', $no_ref->no_lphp) }}"
                                                        readonly>
                                                    <span class="input-group-text">/KPU.02/BD.06/</span>
                                                    <input type="date" class="form-control" name="tgl_lphp">
                                                </div>
                                            </div>

                                            <input type="hidden" id="id_pasca_penindakan" name="id_pasca_penindakan"
                                                value="">
                                            <input type="hidden" name="id_penindakan_ref"
                                                value="{{ old('id_penindakan', $penindakan->id_penindakan) }}">


                                            <!-- Nomor SBP -->
                                            <div class="mb-4">
                                                <div class="row mb-2 align-items-center">
                                                    <div class="col-md-2">
                                                        <label class="form-label fw-bold">1. Nomor SBP</label>
                                                    </div>
                                                    <div class="col-md-1 text-center">:</div>
                                                    <div class="col-md-3">
                                                        <input type="text"
                                                            class="form-control border-0 border-bottom border-dark"
                                                            placeholder="Isi Nomor SBP"
                                                            value="{{ old('no_sbp', $penindakan->no_sbp) }}" readonly>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <label class="form-label">Tanggal</label>
                                                    </div>
                                                    <div class="col-md-1 text-center">:</div>
                                                    <div class="col-md-3">
                                                        <input type="date"
                                                            class="form-control border-0 border-bottom border-dark"
                                                            value="{{ old('tgl_sbp', $penindakan->tgl_sbp) }}" readonly>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Dugaan Pelanggaran -->
                                            <div class="mb-4">
                                                <div class="row mb-2 align-items-center">
                                                    <div class="col-md-3">
                                                        <label class="form-label fw-bold">2. Dugaan Pelanggaran</label>
                                                    </div>
                                                    <div class="col-md-1 text-center">:</div>
                                                    <div class="col-md-8">
                                                        <div class="accordion accordion-flush" id="accordionFlushExample">
                                                            <div class="accordion-item">
                                                                <h2 class="accordion-header">
                                                                    <button
                                                                        class="accordion-button btn bg-light fw-medium collapsed"
                                                                        type="button" data-bs-toggle="collapse"
                                                                        data-bs-target="#flush-collapseOne"
                                                                        aria-expanded="false"
                                                                        aria-controls="flush-collapseOne">
                                                                        Terjadinya Dugaan Pelanggaran ?
                                                                    </button>
                                                                </h2>
                                                                <div id="flush-collapseOne"
                                                                    class="accordion-collapse collapse"
                                                                    data-bs-parent="#accordionFlushExample">
                                                                    <div class="accordion-body bg-light">

                                                                        <div class="row mb-3">
                                                                            <label for="data_sarkut"
                                                                                class="col-sm-4 col-form-label">ISI
                                                                                DATA</label>
                                                                            <div class="col-sm-8">
                                                                                <select id="dugaan_pelanggaran"
                                                                                    name="dugaan_pelanggaran"
                                                                                    class="form-control form-select select2"
                                                                                    onchange="toggleForm(this.value, 'flush-collapseOne'); toggleTabs(this.value);">
                                                                                    <option value="" selected
                                                                                        disabled>-
                                                                                        Pilih -</option>
                                                                                    <option value="TIDAK">TIDAK</option>
                                                                                    <option value="YA">YA</option>
                                                                                </select>
                                                                            </div>
                                                                        </div>

                                                                        <!-- Form Inputs -->
                                                                        <div class="col-lg-12 mb-3">
                                                                            <label class="col-sm-10 col-form-label">Dugaan
                                                                                Pelanggaran</label>
                                                                            <select
                                                                                class="form-control form-input form-select select2"
                                                                                name="dugaan_pelanggaran_lphp" disabled>
                                                                                <option value="" selected disabled>-
                                                                                    Pilih -</option>
                                                                                @foreach ($jenisPelanggaran as $pelanggaran)
                                                                                    <option
                                                                                        value="{{ $pelanggaran->alasan_penindakan }} ({{ $pelanggaran->jenis_pelanggaran }})">
                                                                                        {{ $pelanggaran->alasan_penindakan }}
                                                                                        ({{ $pelanggaran->jenis_pelanggaran }})
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

                                            <!-- Kegiatan Penindakan -->
                                            <div class="mb-4">
                                                <div class="row mb-2 align-items-center">
                                                    <div class="col-md-3">
                                                        <label class="form-label fw-bold">3. Kegiatan Penindakan</label>
                                                    </div>
                                                    <div class="col-md-1 text-center">:</div>
                                                    <div class="col-md-8">
                                                        <input type="text"
                                                            class="form-control border-0 border-bottom border-dark"
                                                            readonly value="terisi otomatis">
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Jenis -->
                                            <div class="mb-4">
                                                <div class="row mb-2 align-items-center">
                                                    <div class="col-md-3">
                                                        <label class="form-label fw-bold">A. Sarana Pengangkut</label>
                                                    </div>
                                                </div>
                                                <div class="row mb-2 align-items-center">
                                                    <div class="col-md-1 ms-4">
                                                        <label class="form-label">Jenis</label>
                                                    </div>
                                                    <div class="col-md-1 text-center">:</div>
                                                    <div class="col-md-3">
                                                        <input type="text"
                                                            class="form-control border-0 border-bottom border-dark"
                                                            readonly value="terisi otomatis">
                                                    </div>
                                                    <div class="col-md-2">
                                                        <label class="form-label">No. Register</label>
                                                    </div>
                                                    <div class="col-md-1 text-center">:</div>
                                                    <div class="col-md-3">
                                                        <input type="text"
                                                            class="form-control border-0 border-bottom border-dark"
                                                            readonly value="terisi otomatis">
                                                    </div>
                                                </div>
                                                <div class="row mb-2 align-items-center">
                                                    <div class="col-md-1 ms-4">
                                                        <label class="form-label">Nomor Peti Kemas</label>
                                                    </div>
                                                    <div class="col-md-1 text-center">:</div>
                                                    <div class="col-md-3">
                                                        <input type="text"
                                                            class="form-control border-0 border-bottom border-dark"
                                                            readonly value="terisi otomatis">
                                                    </div>
                                                    <div class="col-md-2">
                                                        <label class="form-label">ukuran</label>
                                                    </div>
                                                    <div class="col-md-1 text-center">:</div>
                                                    <div class="col-md-3">
                                                        <input type="text"
                                                            class="form-control border-0 border-bottom border-dark"
                                                            readonly value="terisi otomatis">
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Komoditi/Jenis -->
                                            <div class="mb-4">
                                                <div class="row mb-2 align-items-center">
                                                    <div class="col-md-3">
                                                        <label class="form-label fw-bold">b. Barang</label>
                                                    </div>
                                                </div>
                                                <div class="row mb-2 align-items-center">
                                                    <div class="col-md-1 ms-4">
                                                        <label class="form-label">Komoditas/Jenis</label>
                                                    </div>
                                                    <div class="col-md-1 text-center">:</div>
                                                    <div class="col-md-8">
                                                        <input type="text"
                                                            class="form-control border-0 border-bottom border-dark"
                                                            readonly value="terisi otomatis">
                                                    </div>
                                                </div>
                                                <div class="row mb-2 align-items-center">
                                                    <div class="col-md-1 ms-4">
                                                        <label class="form-label">Jumlah</label>
                                                    </div>
                                                    <div class="col-md-1 text-center">:</div>
                                                    <div class="col-md-8">
                                                        <input type="text"
                                                            class="form-control border-0 border-bottom border-dark"
                                                            readonly value="terisi otomatis">
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Bangunan/Tempat -->
                                            <div class="mb-4">
                                                <div class="row mb-2 align-items-center">
                                                    <div class="col-md-3">
                                                        <label class="form-label fw-bold">c. Bangunan/Tempat</label>
                                                    </div>
                                                </div>
                                                <div class="row mb-2 align-items-center">
                                                    <div class="col-md-1 ms-4">
                                                        <label class="form-label">Alamat</label>
                                                    </div>
                                                    <div class="col-md-1 text-center">:</div>
                                                    <div class="col-md-8">
                                                        <input type="text"
                                                            class="form-control border-0 border-bottom border-dark"
                                                            readonly value="terisi otomatis">
                                                    </div>
                                                </div>
                                                <div class="row mb-2 align-items-center">
                                                    <div class="col-md-1 ms-4">
                                                        <label class="form-label">No Reg Bangunan/NPPBKC/dll;</label>
                                                    </div>
                                                    <div class="col-md-1 text-center">:</div>
                                                    <div class="col-md-8">
                                                        <input type="text"
                                                            class="form-control border-0 border-bottom border-dark"
                                                            readonly value="terisi otomatis">
                                                    </div>
                                                </div>
                                                <div class="row mb-2 align-items-center">
                                                    <div class="col-md-1 ms-4">
                                                        <label class="form-label">Pemilik/Kuasa</label>
                                                    </div>
                                                    <div class="col-md-1 text-center">:</div>
                                                    <div class="col-md-8">
                                                        <input type="text"
                                                            class="form-control border-0 border-bottom border-dark"
                                                            readonly value="terisi otomatis">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="mb-4">
                                                <div class="row mb-2 align-items-center">
                                                    <div class="col-md-3">
                                                        <label class="form-label fw-bold">D. Orang</label>
                                                    </div>
                                                </div>
                                                <div class="row mb-2 align-items-center">
                                                    <div class="col-md-1 ms-4">
                                                        <label class="form-label">Nama</label>
                                                    </div>
                                                    <div class="col-md-1 text-center">:</div>
                                                    <div class="col-md-3">
                                                        <input type="text"
                                                            class="form-control border-0 border-bottom border-dark"
                                                            readonly value="terisi otomatis">
                                                    </div>
                                                    <div class="col-md-2">
                                                        <label class="form-label">Tanggal Lahir</label>
                                                    </div>
                                                    <div class="col-md-1 text-center">:</div>
                                                    <div class="col-md-3">
                                                        <input type="text"
                                                            class="form-control border-0 border-bottom border-dark"
                                                            readonly value="terisi otomatis">
                                                    </div>
                                                </div>
                                                <div class="row mb-2 align-items-center">
                                                    <div class="col-md-1 ms-4">
                                                        <label class="form-label">Jenis Kelamin</label>
                                                    </div>
                                                    <div class="col-md-1 text-center">:</div>
                                                    <div class="col-md-3">
                                                        <input type="text"
                                                            class="form-control border-0 border-bottom border-dark"
                                                            placeholder="Jenis Kelamin" readonly value="terisi otomatis">
                                                    </div>
                                                    <div class="col-md-2">
                                                        <label class="form-label">No Identitas</label>
                                                    </div>
                                                    <div class="col-md-1 text-center">:</div>
                                                    <div class="col-md-3">
                                                        <input type="text"
                                                            class="form-control border-0 border-bottom border-dark"
                                                            placeholder="No Identitas" readonly value="terisi otomatis">
                                                    </div>
                                                </div>
                                                <div class="row mb-2 align-items-center">
                                                    <div class="col-md-1 ms-4">
                                                        <label class="form-label">Alamat</label>
                                                    </div>
                                                    <div class="col-md-1 text-center">:</div>
                                                    <div class="col-md-3">
                                                        <input type="text"
                                                            class="form-control border-0 border-bottom border-dark"
                                                            placeholder="Alamat" readonly value="terisi otomatis">
                                                    </div>
                                                    <div class="col-md-2">
                                                        <label class="form-label">Warga Negara</label>
                                                    </div>
                                                    <div class="col-md-1 text-center">:</div>
                                                    <div class="col-md-3">
                                                        <input type="text"
                                                            class="form-control border-0 border-bottom border-dark"
                                                            placeholder="Warga Negara" readonly value="terisi otomatis">
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Analisis Hasil Penindakan -->
                                            <div class="mb-4">
                                                <div class="row mb-2 align-items-center">
                                                    <div class="col-md-6">
                                                        <label class="form-label fw-bold">4. Analisis Hasil Penindakan
                                                            <button type="button" class="btn p-0 ms-1 text-primary"
                                                                data-bs-toggle="tooltip" data-bs-placement="top"
                                                                data-bs-custom-class="custom-tooltip"
                                                                data-bs-title="Diisi dengan mengapit #isi# disetiap point, dan enter untuk baris baru untuk point baru">
                                                                <i data-feather="alert-circle"
                                                                    style="width: 18px; height: 18px;"></i>
                                                            </button>
                                                        </label>
                                                    </div>
                                                    <div class="col-md-23">
                                                        <textarea class="form-control border-0 border-bottom border-dark" rows="3"
                                                            placeholder="Analisis Hasil Penindakan" name="analisis_hasil_penindakan_lphp"></textarea>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Signature sections -->
                                            <div class="row mt-5">
                                                <div class="col-md-6">
                                                    <div class="text-center">

                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="text-center">
                                                        <p>(<input type="text"
                                                                class="form-control d-inline border-0 border-bottom border-dark text-center"
                                                                style="width: 150px;" value="terisi otomatis" readonly>)
                                                        </p>
                                                        <div style="height: 80px;"></div>
                                                        <p>(<input type="text"
                                                                class="form-control d-inline border-0 border-bottom border-dark text-center"
                                                                style="width: 150px;" value="terisi otomatis" readonly>)
                                                        </p>
                                                        <p>NIP. <input type="text"
                                                                class="form-control d-inline border-0 border-bottom border-dark"
                                                                style="width: 120px;" value="terisi otomatis" readonly>
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row mt-5">
                                                <div class="col-md-6">
                                                    <div class="text-center">
                                                        <p>(<input type="text"
                                                                class="form-control d-inline border-0 border-bottom border-dark text-center"
                                                                style="width: 150px;" value="terisi otomatis" readonly>)
                                                        </p>
                                                        <div style="height: 80px;"></div>
                                                        <p>(<input type="text"
                                                                class="form-control d-inline border-0 border-bottom border-dark text-center"
                                                                style="width: 150px;" value="terisi otomatis" readonly>)
                                                        </p>
                                                        <p>NIP. <input type="text"
                                                                class="form-control d-inline border-0 border-bottom border-dark"
                                                                style="width: 120px;" value="terisi otomatis" readonly>
                                                        </p>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="text-center">
                                                        <p>(<input type="text"
                                                                class="form-control d-inline border-0 border-bottom border-dark text-center"
                                                                style="width: 150px;" value="terisi otomatis" readonly>)
                                                        </p>
                                                        <div style="height: 80px;"></div>
                                                        <p>(<input type="text"
                                                                class="form-control d-inline border-0 border-bottom border-dark text-center"
                                                                style="width: 150px;" value="terisi otomatis" readonly>)
                                                        </p>
                                                        <p>NIP. <input type="text"
                                                                class="form-control d-inline border-0 border-bottom border-dark"
                                                                style="width: 120px;" value="terisi otomatis" readonly>
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>


                                            <div class="mb-4 mt-2">
                                                <div class="row mb-2 align-items-center">
                                                    <div class="col-md-6">
                                                        <label class="form-label fw-bold">Catatan
                                                            {{-- <button type="button" class="btn p-0 ms-1 text-primary"
                                                                data-bs-toggle="tooltip" data-bs-placement="top"
                                                                data-bs-custom-class="custom-tooltip"
                                                                data-bs-title="Diisi dengan mengapit #isi# disetiap point, dan enter untuk baris baru untuk point baru">
                                                                <i data-feather="alert-circle"
                                                                    style="width: 18px; height: 18px;"></i>
                                                            </button> --}}
                                                        </label>
                                                    </div>
                                                    <div class="col-md-23">
                                                        <textarea class="form-control border-0 border-bottom border-dark" rows="3" placeholder="Catatan LPHP"
                                                            name="catatan_lphp"></textarea>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-lg-12 mb-3">
                                                <label>Kepala Bidang Penindakan</label>
                                                <select class="form-control form-select select2"
                                                    name="kepala_bidang_penindakan_display" id="kepala_bidang_penindakan"
                                                    disabled>
                                                    @foreach ($users as $user)
                                                        @if ($user->jabatan == 'Kepala Bidang Penindakan dan Penyidikan' && $user->status == 'AKTIF')
                                                            <option value="{{ $user->id_admin }}" selected>
                                                                {{ $user->name }} | {{ $user->jabatan }}
                                                            </option>
                                                        @else
                                                            <option value="{{ $user->id_admin }}">
                                                                {{ $user->name }} | {{ $user->jabatan }}
                                                            </option>
                                                        @endif
                                                    @endforeach
                                                </select>
                                                <input type="hidden" name="kepala_bidang_penindakan"
                                                    value="{{ old('kepala_bidang_penindakan', $pascapenindakan->kepala_bidang_penindakan ?? ($users->where('jabatan', 'Kepala Bidang Penindakan dan Penyidikan')->where('status', 'AKTIF')->first()->id_admin ?? '')) }}">
                                            </div>


                                            <div class="col-lg-12 mb-3">
                                                <label>Kepala Seksi Penindakan</label>
                                                <select class="form-control form-select select2"
                                                    name="id_kepala_seksi_penindakan">
                                                    <option value="" selected disabled>- Pilih -</option>
                                                    @foreach ($users as $user)
                                                        <option value="{{ $user->id_admin }}">
                                                            {{ $user->name }} | {{ $user->jabatan }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <!-- Keterangan -->
                                            <div class="mt-4">
                                                <p><small>*Coret yang tidak perlu</small></p>
                                                <div class="text-center">
                                                </div>
                                            </div>

                                        </div>
                                    </div>

                                    <div class="tab-pane fade" id="bast-pemilik" role="tabpanel"
                                        aria-labelledby="bast-pemilik-tab">
                                        <div class="container mt-4">
                                            <div class="row mb-4 align-items-center">
                                                <div class="col-2 text-center">
                                                    <img src="/images/logocop.png" alt="Logo" class="img-fluid"
                                                        style="max-height:170px;">
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

                                            <div class="text-center mb-4">
                                                <h5 class="fw-bold">BERITA ACARA SERAH TERIMA
                                                </h5>
                                                <div class="input-group flex-wrap">
                                                    <span class="input-group-text">NOMOR : BA-</span>
                                                    <input type="text" class="form-control" name="no_bast_pemilik"
                                                        value="{{ old('no_bast_pemilik', $no_ref->no_bast_pemilik) }}"
                                                        readonly>
                                                    <span class="input-group-text">/KPU.206/</span>
                                                    <input type="date" class="form-control" name="tgl_bast_pemilik">
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
                                                    bertempat di Kantor Pelayanan Utama Bea dan Cukai Tipe B Batam, saya
                                                    :
                                                </p>
                                            </div>

                                            <div class="mb-4">
                                                <div class="col-lg-12 mb-3 d-flex justify-content-center">
                                                    <div style="width: 600px; text: center;">
                                                        <select class="form-control form-select select2 text-center"
                                                            name="id_pejabat_1_bast_pemilik">
                                                            <option value="" selected disabled>- Pilih -</option>
                                                            @foreach ($users as $user)
                                                                <option value="{{ $user->id_admin }}">
                                                                    {{ $user->name }} | {{ $user->jabatan }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>

                                                <textarea class="form-control" rows="7" placeholder="Keterangan Berita Acara Serah Terima Pemilik"
                                                    name="ket_ba_pemilik">{{ old('ket_ba_pemilik', $defaultKeterangan) }}</textarea>

                                                <p>Barang sebagaimana dimaksud telah diserahkan dalam keadaan baik dan
                                                    lengkap Kepada :</p>
                                            </div>


                                            <!-- B. Barang -->
                                            <div class="mb-4">

                                                <div class="row mb-2">
                                                    <div class="col-md-4">
                                                        <label class="form-label">
                                                            Nama
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
                                                        <label class="form-label">Pekerjaan</label>
                                                    </div>
                                                    <div class="col-md-1 text-center">:</div>
                                                    <div class="col-md-7">
                                                        <input type="text" readonly value="terisi otomatis"
                                                            class="form-control border-0 border-bottom border-dark">
                                                    </div>
                                                </div>

                                                <div class="row mb-2">
                                                    <div class="col-md-4">
                                                        <label class="form-label">Alamat</label>
                                                    </div>
                                                    <div class="col-md-1 text-center">:</div>
                                                    <div class="col-md-7">
                                                        <input type="text" readonly value="terisi otomatis"
                                                            class="form-control border-0 border-bottom border-dark">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="mb-4">

                                                <p>Serah terima ini dilakukan di Gudang Importir dengan disaksikan oleh
                                                    :
                                                </p>


                                                <div class="d-flex align-items-center mb-2">
                                                    <span class="me-1">Pejabat Pertama</span>
                                                    <span class="me-2">:</span>
                                                    <select class="form-control form-select select2"
                                                        name="id_pejabat_2_bast_pemilik">
                                                        <option value="" selected disabled>- Pilih -</option>
                                                        @foreach ($users as $user)
                                                            <option value="{{ $user->id_admin }}">{{ $user->name }}
                                                                |
                                                                {{ $user->jabatan }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>

                                                <div class="d-flex align-items-center mb-2">
                                                    <span class="me-1">Pejabat Kedua</span>
                                                    <span class="me-2">:</span>
                                                    <select class="form-control form-select select2"
                                                        name="id_pejabat_3_bast_pemilik">
                                                        <option value="" selected disabled>- Pilih -</option>
                                                        @foreach ($users as $user)
                                                            <option value="{{ $user->id_admin }}">{{ $user->name }}
                                                                |
                                                                {{ $user->jabatan }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>


                                            <p class="fw-bold">Demikian Berita Acara Serah Terima ini dibuat dengan
                                                sebenarnya atas kekuatan sumpah jabatan, kemudian ditutup dan
                                                ditandatangani
                                                di Batam pada hari dan tanggal seperti tersebut diatas.</p>

                                            <!-- Tanda Tangan -->
                                            <div class="row mt-5">
                                                <div class="col-md-6">
                                                    <div class="text-center">
                                                        <p>Yang menerima,</p>
                                                        <div style="height: 80px;"></div>
                                                        <p>(<input type="text"
                                                                class="form-control d-inline border-0 border-bottom border-dark text-center"
                                                                style="width: 150px;" value="terisi otomatis" readonly>)
                                                        </p>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="text-center">
                                                        <p>Yang Menyerahkan,</p>
                                                        <div style="height: 80px;"></div>
                                                        <p>(<input type="text"
                                                                class="form-control d-inline border-0 border-bottom border-dark text-center"
                                                                style="width: 150px;" value="terisi otomatis" readonly>)
                                                        </p>
                                                        <p>NIP. <input type="text"
                                                                class="form-control d-inline border-0 border-bottom border-dark"
                                                                style="width: 120px;" value="terisi otomatis" readonly>
                                                        </p>
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
                                                                style="width: 150px;" value="terisi otomatis" readonly>)
                                                        </p>
                                                        <p>NIP. <input type="text"
                                                                class="form-control d-inline border-0 border-bottom border-dark"
                                                                style="width: 120px;" value="terisi otomatis" readonly>
                                                        </p>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="text-center">
                                                        <p>Saksi,</p>
                                                        <div style="height: 80px;"></div>
                                                        <p>(<input type="text"
                                                                class="form-control d-inline border-0 border-bottom border-dark text-center"
                                                                style="width: 150px;" value="terisi otomatis" readonly>)
                                                        </p>
                                                        <p>NIP. <input type="text"
                                                                class="form-control d-inline border-0 border-bottom border-dark"
                                                                style="width: 120px;" value="terisi otomatis" readonly>
                                                        </p>
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

                                    <div class="tab-pane fade" id="bast-instansi" role="tabpanel"
                                        aria-labelledby="bast-instansi-tab">
                                        <div class="container mt-4">
                                            <!-- Header dengan Logo -->
                                            <div class="row mb-4 align-items-center">
                                                <div class="col-2 text-center">
                                                    <img src="/images/logocop.png" alt="Logo" class="img-fluid"
                                                        style="max-height:170px;">
                                                </div>
                                                <div class="col-10 text-center">
                                                    <h5 class="mb-0">KEMENTERIAN KEUANGAN REPUBLIK
                                                        INDONESIA
                                                    </h5>
                                                    <p class="small mb-0">DIREKTORAT JENDERAL BEA DAN CUKAI
                                                    </p>
                                                    <p class="small mb-0">KANTOR PELAYANAN UTAMA BEA DAN
                                                        CUKAI
                                                        TIPE B BATAM
                                                    </p>
                                                    <p class="small mb-0">
                                                        JALAN KUDA LAUT, BATU AMPAR, BATAM, KEPULAUAN RIAU
                                                        29432;
                                                        TELEPON (0778) 458118, 458263; FAKSIMILE (0778)
                                                        458149;
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
                                                <h5 class="fw-bold">BERITA ACARA SERAH TERIMA</h5>
                                                <div class="input-group flex-wrap">
                                                    <span class="input-group-text">NOMOR : BA-</span>
                                                    <input type="text" class="form-control" name="no_bast_instansi"
                                                        id="no_bast_instansi"
                                                        value="{{ old('no_bast_instansi', $no_ref->no_bast_instansi) }}"
                                                        readonly>
                                                    <span class="input-group-text">/KPU.02/BD.06/</span>
                                                    <input type="date" class="form-control" name="tgl_bast_instansi">
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
                                                </p>

                                                <p>Saya/Kami* yang bertanda tangan di bawah bertindak untuk/
                                                    atas nama Kantor Pelayanan Utama Bea dan Cukai Tipe B
                                                    Batam
                                                    Telah menyerahkan:
                                                </p>
                                            </div>

                                            <!-- 1. Sarana Pengangkut -->
                                            <div class="mb-4">
                                                <h6 class="fw-bold">1. Sarana Pengangkut</h6>

                                                <div class="row mb-2">
                                                    <div class="col-md-4">
                                                        <label class="form-label">-Nama dan Jenis
                                                            Sarkut</label>
                                                    </div>
                                                    <div class="col-md-1 text-center">:</div>
                                                    <div class="col-md-7">
                                                        <input type="text" readonly value="terisi otomatis"
                                                            class="form-control border-0 border-bottom border-dark">
                                                    </div>
                                                </div>

                                                <div class="row mb-2">
                                                    <div class="col-md-4">
                                                        <label class="form-label">-Ukuran/ Kapasitas
                                                            Muatan</label>
                                                    </div>
                                                    <div class="col-md-1 text-center">:</div>
                                                    <div class="col-md-7">
                                                        <input type="text" readonly value="terisi otomatis"
                                                            class="form-control border-0 border-bottom border-dark">
                                                    </div>
                                                </div>

                                                <div class="row mb-2">
                                                    <div class="col-md-4">
                                                        <label class="form-label">-No Reg/
                                                            No.Polisi</label>
                                                    </div>
                                                    <div class="col-md-1 text-center">:</div>
                                                    <div class="col-md-7">
                                                        <input type="text" readonly value="terisi otomatis"
                                                            class="form-control border-0 border-bottom border-dark">
                                                    </div>
                                                </div>
                                            </div>


                                            <!-- 2. Barang -->
                                            <div class="mb-4">
                                                <h6 class="fw-bold">B. Barang</h6>

                                                <div class="row mb-2">
                                                    <div class="col-md-4">
                                                        <label class="form-label">-Jumlah/Jenis
                                                            Barang</label>
                                                    </div>
                                                    <div class="col-md-1 text-center">:</div>
                                                    <div class="col-md-7">
                                                        <input type="text" readonly value="terisi otomatis"
                                                            class="form-control border-0 border-bottom border-dark">
                                                    </div>
                                                </div>

                                                <div class="row mb-2">
                                                    <div class="col-md-4">
                                                        <label class="form-label">-Jenis/ No dan Tgl
                                                            Dokumen</label>
                                                    </div>
                                                    <div class="col-md-1 text-center">:</div>
                                                    <div class="col-md-7">
                                                        <input type="text" readonly value="terisi otomatis"
                                                            class="form-control border-0 border-bottom border-dark">
                                                    </div>
                                                </div>

                                            </div>


                                            <!-- 3. Orang dan tempat -->
                                            <div class="mb-4">
                                                <h6 class="fw-bold">3. Orang </h6>

                                                <div class="row mb-2">
                                                    <div class="col-md-4">
                                                        <label class="form-label">-Nama</label>
                                                    </div>
                                                    <div class="col-md-1 text-center">:</div>
                                                    <div class="col-md-7">
                                                        <input type="text" readonly value="terisi otomatis"
                                                            class="form-control border-0 border-bottom border-dark">
                                                    </div>
                                                </div>

                                                <div class="row mb-2">
                                                    <div class="col-md-4">
                                                        <label class="form-label">-Tanggal Lahir
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
                                                        <label class="form-label">-Kewarganegaraan
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
                                                        <label class="form-label">-No. Identitas</label>
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
                                                <p>
                                                    Diserahkan Kepada :
                                                </p>

                                                <div class="d-flex align-items-center mb-2">
                                                    <span class="me-1">Nama</span>
                                                    <span class="me-2">:</span>
                                                    <input type="text" name="nama_penerima_bast_instansi"
                                                        class="form-control border-0 border-bottom border-dark flex-grow-1">
                                                </div>

                                                <div class="d-flex align-items-center mb-2">
                                                    <span class="me-1">Jenis Identitas</span>
                                                    <span class="me-2">:</span>
                                                    <input type="text" name="jenis_iden_bast_instansi"
                                                        class="form-control border-0 border-bottom border-dark flex-grow-1">
                                                </div>

                                                <div class="d-flex align-items-center mb-2">
                                                    <span class="me-1">Nomor Identitas</span>
                                                    <span class="me-2">:</span>
                                                    <input type="text" name="identitas_bast_instansi"
                                                        class="form-control border-0 border-bottom border-dark flex-grow-1">
                                                </div>

                                                <div class="d-flex align-items-center mb-2">
                                                    <span class="me-1">Menerima penyerahan untuk/atas
                                                        nama</span>
                                                    <span class="me-2">:</span>
                                                    <input type="text" name="atas_nama_bast_instansi"
                                                        class="form-control border-0 border-bottom border-dark flex-grow-1">
                                                </div>

                                                <div class="d-flex align-items-center mb-2">
                                                    <span class="me-1">Penyerahan dilaksanakan dalam
                                                        rangka</span>
                                                    <span class="me-2">:</span>
                                                    <input type="text" name="penyerahan_bast_instansi"
                                                        class="form-control border-0 border-bottom border-dark flex-grow-1">
                                                </div>
                                            </div>


                                            <p class="fw-bold">Demikian Berita Acara ini dibuat dengan
                                                sebenarnya.</p>

                                            <!-- Tanda Tangan -->
                                            <div class="row mt-5">
                                                <div class="col-md-6">
                                                    <div class="text-center">
                                                        <p>Yang Menerima,</p>
                                                        <div style="height: 80px;"></div>
                                                        <p>(<input type="text"
                                                                class="form-control d-inline border-0 border-bottom border-dark text-center"
                                                                style="width: 150px;" value="terisi otomatis" readonly>)
                                                        </p>
                                                        <p>NRP/Identitas. <input type="text"
                                                                class="form-control d-inline border-0 border-bottom border-dark"
                                                                style="width: 120px;" value="terisi otomatis" readonly>
                                                        </p>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="text-center">
                                                        <p>Yang Menyerahkan,</p>
                                                        <div style="height: 80px;"></div>
                                                        <select class="form-control form-select select2"
                                                            name="id_pejabat_1_bast_instansi">
                                                            <option value="" selected disabled>- Pilih -</option>
                                                            @foreach ($users as $user)
                                                                <option value="{{ $user->id_admin }}">
                                                                    {{ $user->name }}
                                                                    |
                                                                    {{ $user->jabatan }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row mt-5">
                                                <div class="col-md-6">
                                                    <div class="text-center">
                                                        <p>Saksi,</p>
                                                        <div style="height: 80px;"></div>
                                                        <select class="form-control form-select select2"
                                                            name="id_pejabat_2_bast_instansi">
                                                            <option value="" selected disabled>- Pilih -</option>
                                                            @foreach ($users as $user)
                                                                <option value="{{ $user->id_admin }}">
                                                                    {{ $user->name }}
                                                                    |
                                                                    {{ $user->jabatan }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                        </p>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="text-center">
                                                        <p>Saksi,</p>
                                                        <div style="height: 80px;"></div>
                                                        <select class="form-control form-select select2"
                                                            name="id_pejabat_3_bast_instansi">
                                                            <option value="" selected disabled>- Pilih -</option>
                                                            @foreach ($users as $user)
                                                                <option value="{{ $user->id_admin }}">
                                                                    {{ $user->name }}
                                                                    |
                                                                    {{ $user->jabatan }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                        </p>
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


                                    <div class="tab-pane fade" id="lp" role="tabpanel" aria-labelledby="lp-tab">
                                        <div class="container mt-4">
                                            <!-- Header dengan Logo -->
                                            <div class="row mb-4 align-items-center">
                                                <div class="col-2 text-center">
                                                    <img src="/images/logocop.png" alt="Logo" class="img-fluid"
                                                        style="max-height:170px;">
                                                </div>
                                                <div class="col-10 text-center">
                                                    <h5 class="mb-0">KEMENTERIAN KEUANGAN REPUBLIK
                                                        INDONESIA
                                                    </h5>
                                                    <p class="small mb-0">DIREKTORAT JENDERAL BEA DAN CUKAI
                                                    </p>
                                                    <p class="small mb-0">KANTOR PELAYANAN UTAMA BEA DAN
                                                        CUKAI
                                                        TIPE B BATAM
                                                    </p>
                                                    <p class="small mb-0">
                                                        JALAN KUDA LAUT, BATU AMPAR, BATAM, KEPULAUAN RIAU
                                                        29432;
                                                        TELEPON (0778) 458118, 458263; FAKSIMILE (0778)
                                                        458149;
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

                                            <p class="mb-2">
                                                <span class="text-danger">*</span> Isian dengan keterangan
                                                <span class="text-danger">"terisi otomatis"</span> di atas
                                                berasal dari data sebelumnya yang telah diinput melalui Data
                                                Penindakan.
                                            </p>


                                            <!-- Nomor dan Tanggal -->
                                            <div class="text-center mb-4">
                                                <h5 class="fw-bold">LAPORAN PELANGGARAN</h5>
                                                <div class="input-group flex-wrap">
                                                    <span class="input-group-text">NOMOR : LP-</span>
                                                    <input type="text" class="form-control" name="no_lp"
                                                        id="no_lp" value="{{ old('no_lp', $no_ref->no_lp) }}"
                                                        readonly>
                                                    <span class="input-group-text">/KPU.02/</span>
                                                    <input type="date" class="form-control" name="tgl_lp">
                                                </div>
                                            </div>

                                            <!-- Nomor LPHP -->
                                            <div class="mb-4">
                                                <div class="row mb-2 align-items-center">
                                                    <div class="col-md-2">
                                                        <label class="form-label fw-bold">1. LPHP</label>
                                                    </div>
                                                    <div class="col-md-1 text-center">:</div>
                                                    <div class="col-md-3">
                                                        <input type="text"
                                                            class="form-control border-0 border-bottom border-dark"
                                                            readonly value="terisi otomatis">
                                                    </div>
                                                    <div class="col-md-2">
                                                        <label class="form-label">Tanggal</label>
                                                    </div>
                                                    <div class="col-md-1 text-center">:</div>
                                                    <div class="col-md-3">
                                                        <input type="text"
                                                            class="form-control border-0 border-bottom border-dark"
                                                            readonly value="terisi otomatis">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="mb-4">
                                                <div class="row mb-2 align-items-center">
                                                    <div class="col-md-2">
                                                        <label class="form-label fw-bold">2. SB Penindakan</label>
                                                    </div>
                                                    <div class="col-md-1 text-center">:</div>
                                                    <div class="col-md-3">
                                                        <input type="text"
                                                            class="form-control border-0 border-bottom border-dark"
                                                            readonly value="terisi otomatis">
                                                    </div>
                                                    <div class="col-md-2">
                                                        <label class="form-label">Tanggal</label>
                                                    </div>
                                                    <div class="col-md-1 text-center">:</div>
                                                    <div class="col-md-3">
                                                        <input type="text"
                                                            class="form-control border-0 border-bottom border-dark"
                                                            readonly value="terisi otomatis">
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Uraian Penindakan -->
                                            <div class="mb-4">
                                                <!-- Baris 1: Uraian Penindakan -->
                                                <div class="row align-items-center mb-3">
                                                    <div class="col-md-3 d-flex">
                                                        <span class="me-2 fw-bold">3.</span>
                                                        <label class="form-label fw-bold mb-0">Uraian Penindakan</label>
                                                    </div>
                                                    <div class="col-md-1 text-center">:</div>
                                                    <div class="col-md-8">
                                                        <textarea class="form-control border-0 border-bottom border-dark" rows="3"
                                                            placeholder="Uraian Penindakan Pada Laporan Pelanggaran" name="uraian_penindakan_lp"></textarea>
                                                    </div>
                                                </div>

                                                <!-- Baris 2: Dugaan Pelanggaran -->
                                                <div class="row align-items-center mb-3">
                                                    <div class="col-md-3">
                                                        <label class="form-label fw-bold mb-0">Dugaan Pelanggaran</label>
                                                    </div>
                                                    <div class="col-md-1 text-center">:</div>
                                                    <div class="col-md-8">
                                                        <input type="text"
                                                            class="form-control border-0 border-bottom border-dark"
                                                            readonly value="terisi otomatis">
                                                    </div>
                                                </div>

                                                <!-- Baris 3: Uraian Modus -->
                                                <div class="row align-items-center mb-3">
                                                    <div class="col-md-3">
                                                        <label class="form-label fw-bold mb-0">
                                                            Uraian Modus
                                                            <button type="button" class="btn p-0 ms-1 text-primary"
                                                                data-bs-toggle="tooltip" data-bs-placement="top"
                                                                data-bs-custom-class="custom-tooltip"
                                                                data-bs-title="Diisi dengan mengapit #isi# disetiap point, dan enter untuk baris baru untuk point baru">
                                                                <i data-feather="alert-circle"
                                                                    style="width: 18px; height: 18px;"></i>
                                                            </button>
                                                        </label>
                                                    </div>
                                                    <div class="col-md-1 text-center">:</div>
                                                    <div class="col-md-8">
                                                        <textarea class="form-control border-0 border-bottom border-dark" rows="3" placeholder="Uraian Modus" name="uraian_modus_lp"></textarea>
                                                    </div>
                                                </div>

                                                <!-- Baris 4: Locus -->
                                                <div class="row align-items-center mb-3">
                                                    <div class="col-md-3">
                                                        <label class="form-label fw-bold mb-0">Locus</label>
                                                    </div>
                                                    <div class="col-md-1 text-center">:</div>
                                                    <div class="col-md-8">
                                                        <select class="form-control form-select select2" name="locus_lp">
                                                            <option value="" selected disabled>- Pilih -</option>
                                                            @foreach ($locus as $tempat)
                                                                <option value="{{ $tempat->locus }}">{{ $tempat->locus }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>

                                                <!-- Baris 5: Tempus -->
                                                <div class="row align-items-center mb-3">
                                                    <div class="col-md-3">
                                                        <label class="form-label fw-bold mb-0">Tempus</label>
                                                    </div>
                                                    <div class="col-md-1 text-center">:</div>
                                                    <div class="col-md-8">
                                                        <input type="text" class="form-control border-0 border-bottom border-dark" name="tempus_lp"
                                                            id="datetime-datepicker" placeholder="Tempus">
                                                    </div>
                                                </div>
                                            </div>



                                            <div class="mb-4">
                                                <div class="col-md-3 d-flex">
                                                        <span class="me-2 fw-bold">4.</span>
                                                        <label class="form-label fw-bold mb-0">Diduga dilakukan oleh</label>
                                                    </div>
                                                <div class="row mb-2 align-items-center">
                                                    <div class="col-md-1 ms-4">
                                                        <label class="form-label">Nama</label>
                                                    </div>
                                                    <div class="col-md-1 text-center">:</div>
                                                    <div class="col-md-3">
                                                        <input type="text"
                                                            class="form-control border-0 border-bottom border-dark"
                                                            readonly value="terisi otomatis">
                                                    </div>
                                                    <div class="col-md-2">
                                                        <label class="form-label">Tanggal Lahir</label>
                                                    </div>
                                                    <div class="col-md-1 text-center">:</div>
                                                    <div class="col-md-3">
                                                        <input type="text"
                                                            class="form-control border-0 border-bottom border-dark"
                                                            readonly value="terisi otomatis">
                                                    </div>
                                                </div>
                                                <div class="row mb-2 align-items-center">
                                                    <div class="col-md-1 ms-4">
                                                        <label class="form-label">Nomor Identitas</label>
                                                    </div>
                                                    <div class="col-md-1 text-center">:</div>
                                                    <div class="col-md-3">
                                                        <input type="text"
                                                            class="form-control border-0 border-bottom border-dark"
                                                            placeholder="Jenis Kelamin" readonly value="terisi otomatis">
                                                    </div>
                                                    <div class="col-md-2">
                                                        <label class="form-label">Jenis Kelamin</label>
                                                    </div>
                                                    <div class="col-md-1 text-center">:</div>
                                                    <div class="col-md-3">
                                                        <input type="text"
                                                            class="form-control border-0 border-bottom border-dark"
                                                            placeholder="No Identitas" readonly value="terisi otomatis">
                                                    </div>
                                                </div>
                                                <div class="row mb-2 align-items-center">
                                                    <div class="col-md-1 ms-4">
                                                        <label class="form-label">Alamat</label>
                                                    </div>
                                                    <div class="col-md-1 text-center">:</div>
                                                    <div class="col-md-3">
                                                        <input type="text"
                                                            class="form-control border-0 border-bottom border-dark"
                                                            placeholder="Alamat" readonly value="terisi otomatis">
                                                    </div>
                                                </div>
                                            </div>


                                            <div class="mb-4">
                                                <div class="row align-items-center mb-3">
                                                    <div class="col-md-3 d-flex">
                                                        <span class="me-2 fw-bold">5.</span>
                                                        <label class="form-label fw-bold mb-0">Barang Hasil Penindakan</label>
                                                    </div>
                                                    <div class="col-md-1 text-center">:</div>
                                                    <div class="col-md-8">
                                                    </div>
                                                </div>

                                                <div class="row align-items-center mb-3">
                                                    <div class="col-md-3">
                                                        <label class="form-label fw-bold mb-0">Komoditi/jenis barang</label>
                                                    </div>
                                                    <div class="col-md-1 text-center">:</div>
                                                    <div class="col-md-8">
                                                        <input type="text"
                                                            class="form-control border-0 border-bottom border-dark"
                                                            readonly value="terisi otomatis">
                                                    </div>
                                                </div>

                                                <div class="row align-items-center mb-3">
                                                    <div class="col-md-3">
                                                        <label class="form-label fw-bold mb-0">Jumlah Barang</label>
                                                    </div>
                                                    <div class="col-md-1 text-center">:</div>
                                                    <div class="col-md-8">
                                                    <input type="text"
                                                            class="form-control border-0 border-bottom border-dark"
                                                            readonly value="terisi otomatis">
                                                    </div>
                                                </div>

                                                <!-- Baris 5: Tempus -->
                                                <div class="row align-items-center mb-3">
                                                    <div class="col-md-3">
                                                        <label class="form-label fw-bold mb-0">Barang lain yang terkait</label>
                                                    </div>
                                                    <div class="col-md-1 text-center">:</div>
                                                    <div class="col-md-8">
                                                          <textarea class="form-control border-0 border-bottom border-dark" rows="3" placeholder="Barang Lain Yang Terkait" name="barang_lain_lp"></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="tab-pane fade" id="bast-penyidik" role="tabpanel"
                                        aria-labelledby="bast-penyidik-tab">
                                        <div class="container mt-4">
                                            <!-- Header dengan Logo -->
                                            <div class="row mb-4 align-items-center">
                                                <div class="col-2 text-center">
                                                    <img src="/images/logocop.png" alt="Logo" class="img-fluid"
                                                        style="max-height:170px;">
                                                </div>
                                                <div class="col-10 text-center">
                                                    <h5 class="mb-0">KEMENTERIAN KEUANGAN REPUBLIK
                                                        INDONESIA
                                                    </h5>
                                                    <p class="small mb-0">DIREKTORAT JENDERAL BEA DAN CUKAI
                                                    </p>
                                                    <p class="small mb-0">KANTOR PELAYANAN UTAMA BEA DAN
                                                        CUKAI
                                                        TIPE B BATAM
                                                    </p>
                                                    <p class="small mb-0">
                                                        JALAN KUDA LAUT, BATU AMPAR, BATAM, KEPULAUAN RIAU
                                                        29432;
                                                        TELEPON (0778) 458118, 458263; FAKSIMILE (0778)
                                                        458149;
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
                                                <h5 class="fw-bold">BERITA ACARA SERAH TERIMA</h5>
                                                <div class="input-group flex-wrap">
                                                    <span class="input-group-text">NOMOR : BA-</span>
                                                    <input type="text" class="form-control" name="no_bast_penyidik"
                                                        id="no_bast_penyidik"
                                                        value="{{ old('no_bast_penyidik', $no_ref->no_bast_penyidik) }}"
                                                        readonly>
                                                    <span class="input-group-text">/KPU.02/BD.06/</span>
                                                    <input type="date" class="form-control"
                                                        name="tgl_bast_penyidik">
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
                                                </p>

                                                <p>Saya/Kami* yang bertanda tangan di bawah bertindak untuk/
                                                    atas nama Kantor Pelayanan Utama Bea dan Cukai Tipe B
                                                    Batam
                                                    Telah menyerahkan:
                                                </p>
                                            </div>

                                            <!-- 1. Sarana Pengangkut -->
                                            <div class="mb-4">
                                                <h6 class="fw-bold">1. Sarana Pengangkut</h6>

                                                <div class="row mb-2">
                                                    <div class="col-md-4">
                                                        <label class="form-label">-Nama dan Jenis
                                                            Sarkut</label>
                                                    </div>
                                                    <div class="col-md-1 text-center">:</div>
                                                    <div class="col-md-7">
                                                        <input type="text" readonly value="terisi otomatis"
                                                            class="form-control border-0 border-bottom border-dark">
                                                    </div>
                                                </div>

                                                <div class="row mb-2">
                                                    <div class="col-md-4">
                                                        <label class="form-label">-Ukuran/ Kapasitas
                                                            Muatan</label>
                                                    </div>
                                                    <div class="col-md-1 text-center">:</div>
                                                    <div class="col-md-7">
                                                        <input type="text" readonly value="terisi otomatis"
                                                            class="form-control border-0 border-bottom border-dark">
                                                    </div>
                                                </div>

                                                <div class="row mb-2">
                                                    <div class="col-md-4">
                                                        <label class="form-label">-No Reg/
                                                            No.Polisi</label>
                                                    </div>
                                                    <div class="col-md-1 text-center">:</div>
                                                    <div class="col-md-7">
                                                        <input type="text" readonly value="terisi otomatis"
                                                            class="form-control border-0 border-bottom border-dark">
                                                    </div>
                                                </div>
                                            </div>


                                            <!-- 2. Barang -->
                                            <div class="mb-4">
                                                <h6 class="fw-bold">B. Barang</h6>

                                                <div class="row mb-2">
                                                    <div class="col-md-4">
                                                        <label class="form-label">-Jumlah/Jenis
                                                            Barang</label>
                                                    </div>
                                                    <div class="col-md-1 text-center">:</div>
                                                    <div class="col-md-7">
                                                        <input type="text" readonly value="terisi otomatis"
                                                            class="form-control border-0 border-bottom border-dark">
                                                    </div>
                                                </div>

                                                <div class="row mb-2">
                                                    <div class="col-md-4">
                                                        <label class="form-label">-Jenis/ No dan Tgl
                                                            Dokumen</label>
                                                    </div>
                                                    <div class="col-md-1 text-center">:</div>
                                                    <div class="col-md-7">
                                                        <input type="text" readonly value="terisi otomatis"
                                                            class="form-control border-0 border-bottom border-dark">
                                                    </div>
                                                </div>

                                            </div>


                                            <!-- 3. Orang dan tempat -->
                                            <div class="mb-4">
                                                <h6 class="fw-bold">3. Orang </h6>

                                                <div class="row mb-2">
                                                    <div class="col-md-4">
                                                        <label class="form-label">-Nama</label>
                                                    </div>
                                                    <div class="col-md-1 text-center">:</div>
                                                    <div class="col-md-7">
                                                        <input type="text" readonly value="terisi otomatis"
                                                            class="form-control border-0 border-bottom border-dark">
                                                    </div>
                                                </div>

                                                <div class="row mb-2">
                                                    <div class="col-md-4">
                                                        <label class="form-label">-Tanggal Lahir
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
                                                        <label class="form-label">-Kewarganegaraan
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
                                                        <label class="form-label">-No. Identitas</label>
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

                                                <p>
                                                    Diserahkan Kepada :
                                                </p>

                                                <div class="d-flex align-items-center mb-2">
                                                    <span class="me-1">Pejabat</span>
                                                    <span class="me-2">:</span>
                                                    <select class="form-control form-select select2"
                                                        name="id_pejabat_2_bast_penyidik">
                                                        <option value="" selected disabled>- Pilih -</option>
                                                        @foreach ($users as $user)
                                                            <option value="{{ $user->id_admin }}">{{ $user->name }}
                                                                |
                                                                {{ $user->jabatan }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>


                                            <p class="fw-bold">Demikian Berita Acara ini dibuat dengan
                                                sebenarnya.</p>

                                            <!-- Tanda Tangan -->
                                            <div class="row mt-5">
                                                <div class="col-md-6">
                                                    <div class="text-center">
                                                        <p>Yang Menerima,</p>
                                                        <div style="height: 80px;"></div>
                                                        <p>(<input type="text"
                                                                class="form-control d-inline border-0 border-bottom border-dark text-center"
                                                                style="width: 150px;" value="terisi otomatis" readonly>)
                                                        </p>
                                                        <p>NIP<input type="text"
                                                                class="form-control d-inline border-0 border-bottom border-dark"
                                                                style="width: 120px;" value="terisi otomatis" readonly>
                                                        </p>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="text-center">
                                                        <p>Yang Menyerahkan,</p>
                                                        <div style="height: 80px;"></div>
                                                        <select class="form-control form-select select2"
                                                            name="id_pejabat_1_bast_penyidik">
                                                            <option value="" selected disabled>- Pilih -</option>
                                                            @foreach ($users as $user)
                                                                <option value="{{ $user->id_admin }}">
                                                                    {{ $user->name }}
                                                                    |
                                                                    {{ $user->jabatan }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row mt-5">
                                                <div class="col-md-6">
                                                    <div class="text-center">
                                                        <p>Mengetahui,</p>
                                                        <div style="height: 80px;"></div>
                                                        <p>(<input type="text"
                                                                class="form-control d-inline border-0 border-bottom border-dark text-center"
                                                                style="width: 150px;" value="terisi otomatis" readonly>)
                                                        </p>
                                                        <p>NIP. <input type="text"
                                                                class="form-control d-inline border-0 border-bottom border-dark"
                                                                style="width: 120px;" value="terisi otomatis" readonly>
                                                        </p>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="text-center">
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

                                    <div class="tab-pane fade" id="lpt" role="tabpanel" aria-labelledby="lpt-tab">
                                        <div class="container mt-4">
                                            <!-- Header dengan Logo -->
                                            <div class="row mb-4 align-items-center">
                                                <div class="col-2 text-center">
                                                    <img src="/images/logocop.png" alt="Logo" class="img-fluid"
                                                        style="max-height:170px;">
                                                </div>
                                                <div class="col-10 text-center">
                                                    <h5 class="mb-0">KEMENTERIAN KEUANGAN REPUBLIK
                                                        INDONESIA
                                                    </h5>
                                                    <p class="small mb-0">DIREKTORAT JENDERAL BEA DAN CUKAI
                                                    </p>
                                                    <p class="small mb-0">KANTOR PELAYANAN UTAMA BEA DAN
                                                        CUKAI
                                                        TIPE B BATAM
                                                    </p>
                                                    <p class="small mb-0">
                                                        JALAN KUDA LAUT, BATU AMPAR, BATAM, KEPULAUAN RIAU
                                                        29432;
                                                        TELEPON (0778) 458118, 458263; FAKSIMILE (0778)
                                                        458149;
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

                                            <p class="mb-2">
                                                <span class="text-danger">*</span> Isian dengan keterangan
                                                <span class="text-danger">"terisi otomatis"</span> di atas
                                                berasal dari data sebelumnya yang telah diinput melalui Data
                                                Penindakan.
                                            </p>


                                            <!-- Nomor dan Tanggal -->
                                            <div class="text-center mb-4">
                                                <h5 class="fw-bold">LAPORAN PELAKSANAAN TUGAS</h5>
                                                <div class="input-group flex-wrap">
                                                    <span class="input-group-text">NOMOR : LPT-</span>
                                                    <input type="text" class="form-control" name="no_lpt"
                                                        id="no_lpt" value="{{ old('no_lpt', $no_ref->no_lpt) }}"
                                                        readonly>
                                                    <span class="input-group-text">/KPU.206/</span>
                                                    <input type="date" class="form-control" name="tgl_lpt">
                                                </div>
                                            </div>


                                            <div class="mb-4 mt-2">
                                                <div class="row mb-2 align-items-center">
                                                    <div class="col-md-3 d-flex">
                                                        <span class="me-2 fw-bold">I.</span>
                                                        <label class="form-label fw-bold mb-0">DASAR</label>
                                                    </div>
                                                    <div class="col-md-23">
                                                         <input type="text"
                                                            class="form-control border-0 border-bottom border-dark"
                                                            readonly value="terisi otomatis">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="mb-4 mt-2">
                                                <div class="row mb-2 align-items-center">
                                                    <div class="col-md-3 d-flex">
                                                        <span class="me-2 fw-bold">II.</span>
                                                        <label class="form-label fw-bold mb-0">WAKTU PELAKSANAAN TUGAS</label>
                                                    </div>
                                                    <div class="col-md-23">
                                                         <div class="row mb-2 align-items-center">
                                                    <div class="col-md-3">
                                                        <input type="text"
                                                            class="form-control border-0 border-bottom border-dark"
                                                            name="waktu_pelaksanaan_tugas_lpt"
                                                            id="datetime-datepicker">
                                                    </div>
                                                    <div class="col-md-3">
                                                        <input type="text"
                                                            class="form-control border-0 border-bottom border-dark"
                                                            name="waktu_selesai_tugas_lpt"
                                                            id="datetime-datepicker">
                                                    </div>
                                                </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="mb-4 mt-2">
                                                <div class="row mb-2 align-items-center">
                                                    <div class="col-md-3 d-flex">
                                                        <span class="me-2 fw-bold">III.</span>
                                                        <label class="form-label fw-bold mb-0">WILAYAH TUGAS</label>
                                                    </div>
                                                    <div class="col-md-23">
                                                         <input type="text"
                                                            class="form-control border-0 border-bottom border-dark"
                                                            name="wilayah_tugas_lpt" placeholder="Wilayah Tugas">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="mb-4 mt-2">
                                                <div class="row mb-2 align-items-center">
                                                    <div class="col-md-3 d-flex">
                                                        <span class="me-2 fw-bold">IV.</span>
                                                        <label class="form-label fw-bold mb-0">PELAKSANA TUGAS</label>
                                                    </div>
                                                    <div class="col-md-23">
                                                         <div class="row mb-2 align-items-center">
                                                    <div class="col-md-1 ms-4">
                                                        <label class="form-label">1. Nama Pelaksana Tugas</label>
                                                    </div>
                                                    <div class="col-md-1 text-center">:</div>
                                                    <div class="col-md-3">
                                                        <input type="text"
                                                            class="form-control border-0 border-bottom border-dark"
                                                            readonly value="terisi otomatis">
                                                    </div>
                                                    <div class="col-md-2">
                                                        <label class="form-label">NIP Pelaksana Tugas</label>
                                                    </div>
                                                    <div class="col-md-1 text-center">:</div>
                                                    <div class="col-md-3">
                                                        <input type="text"
                                                            class="form-control border-0 border-bottom border-dark"
                                                            readonly value="terisi otomatis">
                                                    </div>
                                                </div>

                                                 <div class="row mb-2 align-items-center">
                                                    <div class="col-md-1 ms-4">
                                                        <label class="form-label">2. Nama Pelaksana Tugas</label>
                                                    </div>
                                                    <div class="col-md-1 text-center">:</div>
                                                    <div class="col-md-3">
                                                        <input type="text"
                                                            class="form-control border-0 border-bottom border-dark"
                                                            readonly value="terisi otomatis">
                                                    </div>
                                                    <div class="col-md-2">
                                                        <label class="form-label">NIP Pelaksana Tugas</label>
                                                    </div>
                                                    <div class="col-md-1 text-center">:</div>
                                                    <div class="col-md-3">
                                                        <input type="text"
                                                            class="form-control border-0 border-bottom border-dark"
                                                            readonly value="terisi otomatis">
                                                    </div>
                                                </div>
                                                    </div>
                                                </div>
                                            </div>


                                            <div class="mb-4 mt-2">
                                                <div class="row mb-2 align-items-center">
                                                    <div class="col-md-3 d-flex">
                                                        <span class="me-2 fw-bold">V.</span>
                                                        <label class="form-label fw-bold mb-0">URAIAN PELAKSANAAN TUGAS</label>
                                                    </div>
                                                    <div class="col-md-23">
                                                        <textarea class="form-control border-0 border-bottom border-dark" rows="3"
                                                            placeholder="Uraian Pelaksanaan Tugas" name="uraian_lpt"></textarea>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="mb-4 mt-2">
                                                <div class="row mb-2 align-items-center">
                                                    <div class="col-md-3 d-flex">
                                                        <span class="me-2 fw-bold">VI.</span>
                                                        <label class="form-label fw-bold mb-0">TINDAK LANJUT</label>
                                                    </div>
                                                    <div class="col-md-23">
                                                        <textarea class="form-control border-0 border-bottom border-dark" rows="3"
                                                            placeholder="Tindak Lanjut" name="tindak_lanjut_lpt"></textarea>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="mb-4 mt-2">
                                                <div class="row mb-2 align-items-center">
                                                    <div class="col-md-3 d-flex">
                                                        <span class="me-2 fw-bold">VII.</span>
                                                        <label class="form-label fw-bold mb-0">Kesimpulan</label>
                                                    </div>
                                                    <div class="col-md-23">
                                                        <textarea class="form-control border-0 border-bottom border-dark" rows="3"
                                                            placeholder="Kesimpulan Laporan Pelaksanaan Tugas" name="kesimpulan_lpt"></textarea>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row mt-5">
                                                <div class="col-md-6">
                                                    <div class="text-center">

                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="text-center">
                                                        <p>(<input type="text"
                                                                class="form-control d-inline border-0 border-bottom border-dark text-center"
                                                                style="width: 150px;" value="terisi otomatis" readonly>)
                                                        </p>
                                                        <div style="height: 80px;"></div>
                                                        <p>(<input type="text"
                                                                class="form-control d-inline border-0 border-bottom border-dark text-center"
                                                                style="width: 150px;" value="terisi otomatis" readonly>)
                                                        </p>
                                                        <p>NIP. <input type="text"
                                                                class="form-control d-inline border-0 border-bottom border-dark"
                                                                style="width: 120px;" value="terisi otomatis" readonly>
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row mt-5">
                                                <div class="col-md-6">
                                                    <div class="text-center">
                                                        <p>(<input type="text"
                                                                class="form-control d-inline border-0 border-bottom border-dark text-center"
                                                                style="width: 150px;" value="terisi otomatis" readonly>)
                                                        </p>
                                                        <div style="height: 80px;"></div>
                                                        <p>(<input type="text"
                                                                class="form-control d-inline border-0 border-bottom border-dark text-center"
                                                                style="width: 150px;" value="terisi otomatis" readonly>)
                                                        </p>
                                                        <p>NIP. <input type="text"
                                                                class="form-control d-inline border-0 border-bottom border-dark"
                                                                style="width: 120px;" value="terisi otomatis" readonly>
                                                        </p>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="text-center">
                                                        <p>(<input type="text"
                                                                class="form-control d-inline border-0 border-bottom border-dark text-center"
                                                                style="width: 150px;" value="terisi otomatis" readonly>)
                                                        </p>
                                                        <div style="height: 80px;"></div>
                                                        <p>(<input type="text"
                                                                class="form-control d-inline border-0 border-bottom border-dark text-center"
                                                                style="width: 150px;" value="terisi otomatis" readonly>)
                                                        </p>
                                                        <p>NIP. <input type="text"
                                                                class="form-control d-inline border-0 border-bottom border-dark"
                                                                style="width: 120px;" value="terisi otomatis" readonly>
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>


                                            <div class="mb-4 mt-2">
                                                <div class="row mb-2 align-items-center">
                                                    <div class="col-md-3 d-flex">
                                                        <label class="form-label fw-bold mb-0">Catatan</label>
                                                    </div>
                                                    <div class="col-md-23">
                                                        <textarea class="form-control border-0 border-bottom border-dark" rows="3"
                                                            placeholder="Catatan Laporan Pelaksanaan Tugas" name="catatan_lpt"></textarea>
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
                </div>
        </form>
    </div>
    </div>


    <script>
        function generateUniqueID() {
            const timestamp = Date.now();
            const randomNum = Math.floor(Math.random() * 1000000);
            return `id_pasca_penindakan_${timestamp}_${randomNum}`;
        }

        document.getElementById('id_pasca_penindakan').value = generateUniqueID();
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
            } else if (selectedValue === 'TIDAK') {
                inputs.forEach(input => {
                    input.setAttribute('disabled', 'disabled');
                    input.classList.remove('enabled');
                    input.classList.add('disabled');
                });
            }
        }

        function toggleTabs(selectedValue) {
            const tabsToShow = selectedValue === "YA" ? ["bast-instansi-tab", "lp-tab", "bast-penyidik-tab", "lpt-tab"] :
                selectedValue === "TIDAK" ? ["bast-pemilik-tab"] : [];

            const allTabs = ["bast-pemilik-tab", "bast-instansi-tab", "lp-tab", "bast-penyidik-tab", "lpt-tab"];

            allTabs.forEach(tabId => {
                const tabLink = document.getElementById(tabId);
                const tabItem = tabLink.closest(".nav-item");

                tabItem.classList.add("tab-hidden");
                tabLink.classList.remove("tab-highlight");
            });

            tabsToShow.forEach(tabId => {
                const tabLink = document.getElementById(tabId);
                const tabItem = tabLink.closest(".nav-item");

                tabItem.classList.remove("tab-hidden");
                tabLink.classList.add("tab-highlight");

                setTimeout(() => {
                    tabLink.classList.remove("tab-highlight");
                }, 2000);
            });
        }


        document.addEventListener("DOMContentLoaded", () => {
            const selectElement = document.getElementById("dugaan_pelanggaran");
            toggleForm(selectElement.value, 'flush-collapseOne');
            toggleTabs(selectElement.value);
        });
    </script>

    <style>
        .tab-highlight {
            animation: tabFlash 1s infinite;
        }

        @keyframes tabFlash {

            0%,
            100% {

                color: #287F71;
            }

            50% {
                color: #287F71;
            }
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

        .tab-hidden {
            visibility: hidden !important;
            position: absolute !important;
            width: 0 !important;
            padding: 0 !important;
            margin: 0 !important;
            overflow: hidden !important;
        }

        .nav-item {
            transition: all 0.3s ease;
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var selectElement = $('#data_free_entry');
            var noFreeEntry = document.getElementById('no_free_entry');
            var tglFreeEntry = document.getElementById('tgl_free_entry');

            selectElement.select2();

            selectElement.on('change', function() {
                if (selectElement.val() === 'YA') {
                    noFreeEntry.style.display = 'block';
                    tglFreeEntry.style.display = 'block';
                } else {
                    noFreeEntry.style.display = 'none';
                    tglFreeEntry.style.display = 'none';
                }
            });
        });
    </script>
@endsection
@section('script')
    @vite(['resources/js/pages/datatable.init.js'])
@endsection
