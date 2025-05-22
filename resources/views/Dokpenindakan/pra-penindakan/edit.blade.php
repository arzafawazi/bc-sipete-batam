@extends('layouts.vertical', ['title' => 'Edit Pra-penindakan'])

@section('css')
    @vite(['node_modules/datatables.net-bs5/css/dataTables.bootstrap5.min.css', 'node_modules/datatables.net-buttons-bs5/css/buttons.bootstrap5.min.css', 'node_modules/datatables.net-keytable-bs5/css/keyTable.bootstrap5.min.css', 'node_modules/datatables.net-responsive-bs5/css/responsive.bootstrap5.min.css', 'node_modules/datatables.net-select-bs5/css/select.bootstrap5.min.css'])
@endsection
@section('content')
    <div class="container-fluid">
        <form action="{{ route('pra-penindakan.update', ['pra_penindakan' => $praPenindakan->id]) }}" method="POST">
            @csrf
            @method('PUT')
            <!-- Card Container -->
            <div class="card mb-3 mt-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="card-title mb-0">
                        <i data-feather="book" style="width: 20px; height: 20px;" class="me-1"></i> Form Edit Laporan
                        Informasi (LI)
                    </h5>
                    <a href="{{ url()->previous() }}" class="btn btn-danger btn-sm">
                        <i data-feather="log-out" class="me-1"></i> Kembali
                    </a>
                </div>


                <div class="card-body">
                    <div class="row">
                        <!-- Left Column (Sections A and B) -->
                        <div class="col-xl-12">
                            <div class="card">

                                <div class="card-body">
                                    <div class="tabs-container" id="tabs-container">
                                        <ul class="nav nav-pills nav-justified flex-nowrap overflow-auto"
                                            style="white-space: nowrap;" role="tablist">
                                            <li class="nav-item">
                                                <a class="nav-link active" id="navtabs2-home-tab" data-bs-toggle="tab"
                                                    href="#navtabs2-home" role="tab" aria-controls="navtabs2-home"
                                                    aria-selected="true">
                                                    <span class="d-block d-sm-none">(LI)</span>
                                                    <span class="d-none d-sm-block">Laporan Informasi (LI)</span>
                                                </a>
                                            </li>
                                            <li class="nav-item" id="navtabs2-profile-tab-item">
                                                <a class="nav-link" id="navtabs2-profile-tab" data-bs-toggle="tab"
                                                    href="#navtabs2-profile" role="tab" aria-controls="navtabs2-profile"
                                                    aria-selected="false">
                                                    <span class="d-block d-sm-none">LAP</span>
                                                    <span class="d-none d-sm-block">Lembar Analisis Pra Penindakan
                                                        (LAP)</span>
                                                </a>
                                            </li>
                                            <li class="nav-item" id="navtabs2-messages-tab-item" style="display: none;">
                                                <a class="nav-link" id="navtabs2-messages-tab" data-bs-toggle="tab"
                                                    href="#navtabs2-messages" role="tab"
                                                    aria-controls="navtabs2-messages" aria-selected="false">
                                                    <span class="d-block d-sm-none">NPI</span>
                                                    <span class="d-none d-sm-block">Nota Pengembalian Informasi (NPI)</span>
                                                </a>
                                            </li>
                                            <li class="nav-item" id="navtabs2-mpp-tab-item" style="display: none;">
                                                <a class="nav-link" id="navtabs2-mpp-tab" data-bs-toggle="tab"
                                                    href="#navtabs2-mpp" role="tab" aria-controls="navtabs2-mpp"
                                                    aria-selected="false">
                                                    <span class="d-block d-sm-none">MPP</span>
                                                    <span class="d-none d-sm-block">Memo Pelimpahan Penindakan (MPP)</span>
                                                </a>
                                            </li>
                                            <li class="nav-item" id="navtabs2-settings-tab-item" style="display: none;">
                                                <a class="nav-link" id="navtabs2-settings-tab" data-bs-toggle="tab"
                                                    href="#navtabs2-settings" role="tab"
                                                    aria-controls="navtabs2-settings" aria-selected="false">
                                                    <span class="d-block d-sm-none">SP</span>
                                                    <span class="d-none d-sm-block">Surat Perintah</span>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>

                                    <div class="tab-content p-3 text-muted">

                                        <div class="container mt-4 tab-pane active" id="navtabs2-home" role="tabpanel">
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

                                            <div class="text-center mb-4">
                                                <h5 class="fw-bold">Laporan Informasi</h5>
                                                <div class="input-group flex-wrap">
                                                    <span class="input-group-text">NO : LI-</span>
                                                    <input type="text" class="form-control" name="no_li"
                                                        id="no_li" value="{{ old('no_li', $praPenindakan->no_li) }}"
                                                        readonly>
                                                    <input type="date" class="form-control" name="tgl_li"
                                                        value="{{ old('tgl_li', $praPenindakan->tgl_li) }}">
                                                </div>
                                            </div>

                                            <div class="row mb-4">
                                                <div class="col-12">
                                                    <div class="row mb-2">
                                                        <div class="col-3">
                                                            <label class="fw-bold">SUMBER MEDIA INFORMASI</label>
                                                        </div>
                                                        <div class="col-9">
                                                            <div class="d-flex align-items-center">
                                                                <div class="flex-shrink-0">:</div>
                                                                <div class="flex-grow-1 ms-2">
                                                                    <input type="text" class="form-control"
                                                                        id="media_informasi" name="media_informasi"
                                                                        placeholder="Isi Sumber Media Informasi"
                                                                        value="{{ old('media_informasi', $praPenindakan->media_informasi) }}">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="row mb-2">
                                                        <div class="col-3">
                                                            <label class="fw-bold">ISI INFORMASI</label>
                                                        </div>
                                                        <div class="col-9">
                                                            <div class="d-flex align-items-center">
                                                                <div class="flex-shrink-0">:</div>
                                                                <div class="flex-grow-1 ms-2">
                                                                    <textarea class="form-control" rows="6" id="isi_informasi" name="isi_informasi" placeholder="Isi Informasi">{{ old('isi_informasi', $praPenindakan->isi_informasi) }}</textarea>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="row mb-4">
                                                        <div class="col-3">
                                                            <label class="fw-bold">CATATAN</label>
                                                        </div>
                                                        <div class="col-9">
                                                            <div class="d-flex align-items-center">
                                                                <div class="flex-shrink-0">:</div>
                                                                <div class="flex-grow-1 ms-2">
                                                                    <textarea class="form-control" rows="4" id="catatan" name="catatan" placeholder="Isi Catatan">{{ old('catatan', $praPenindakan->catatan) }}</textarea>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row mb-5">
                                                <div class="col-6">
                                                </div>
                                                <div class="col-6 text-center">
                                                    <p>Batam,.........................</p>
                                                    <hr>
                                                    <select class="form-select select2 mb-3" id="id_pejabat_li_1"
                                                        name="id_pejabat_li_1">
                                                        <option value="" disabled selected>- Pilih Pejabat Pelaksana
                                                            Penindakan -</option>
                                                        @foreach ($users as $user)
                                                            <option value="{{ $user->id_admin }}"
                                                                {{ old('id_pejabat_li_1', $praPenindakan->id_pejabat_li_1) == $user->id_admin ? 'selected' : '' }}>
                                                                {{ $user->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="row mb-3">
                                                <div class="col-6 text-center">
                                                    <select class="form-select select2 mb-3" id="id_pejabat_li_2"
                                                        name="id_pejabat_li_2">
                                                        <option value="" disabled selected>- Pilih Pejabat Penerbit
                                                            Laporan Informasi -</option>
                                                        @foreach ($users as $user)
                                                            <option value="{{ $user->id_admin }}"
                                                                {{ old('id_pejabat_li_2', $praPenindakan->id_pejabat_li_2) == $user->id_admin ? 'selected' : '' }}>
                                                                {{ $user->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-6 text-center">
                                                    <select class="form-select select2 mb-3" id="id_pejabat_li_3"
                                                        name="id_pejabat_li_3">
                                                        <option value="" disabled selected>- Pilih Pengampu Pejabat
                                                            Penerbit Lembar Informasi -</option>
                                                        @foreach ($users as $user)
                                                            <option value="{{ $user->id_admin }}"
                                                                {{ old('id_pejabat_li_3', $praPenindakan->id_pejabat_li_3) == $user->id_admin ? 'selected' : '' }}>
                                                                {{ $user->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="row mb-5">
                                                <div class="col-12">
                                                    <p class="fw-bold">Tembusan :
                                                        .............................................................................................................................................................................................
                                                    </p>
                                                </div>
                                            </div>

                                        </div>


                                        <div class="container mt-4 tab-pane" id="navtabs2-mpp" role="tabpanel">
                                            <!-- Header Surat -->
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

                                            <div class="text-center mb-4">
                                                <h5 class="mb-0 fw-bold text-decoration-underline">MEMO PELIMPAHAN
                                                    PENINDAKAN</h5>
                                                <p class="mb-0">Nomor : MPP -
                                                    <input type="text" class="border-0 border-bottom text-center"
                                                        style="width: 150px;" name="no_mpp"
                                                        value="{{ old('no_mpp', $praPenindakan->no_mpp) }}" readonly>
                                                    KPU.206/
                                                    <input type="date" class="border-0 border-bottom text-center"
                                                        style="width: 150px;" name="tgl_mpp"
                                                        value="{{ old('tgl_mpp', $praPenindakan->tgl_mpp) }}">
                                                </p>
                                            </div>

                                            <!-- Kepada -->
                                            <div class="row mb-3">
                                                <div class="col-12 mb-1">Kepada :</div>
                                                <div class="col-12">
                                                    <div class="d-flex align-items-center">
                                                        <label for="yth_mpp" class="form-label mb-0 me-2">Yth.</label>
                                                        <input type="text" class="form-control border-0 border-bottom"
                                                            id="yth_mpp" name="yth_mpp"
                                                            value="{{ old('yth_mpp', $praPenindakan->yth_mpp) }}">
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Text Pengantar -->
                                            <div class="row mb-3">
                                                <div class="col-12">
                                                    <p class="text-justify">
                                                        Sehubungan dengan analisis prapendidikan yang telah dilakukan,
                                                        dengan mempertimbangkan eksistensi penindakan, dengan ini kami
                                                        meringatkan kepada Saudara proses penindakan:
                                                    </p>
                                                </div>
                                            </div>

                                            <!-- Data Informasi -->
                                            <div class="row">
                                                <div class="col-12">
                                                    <table class="table table-borderless">
                                                        <tbody>
                                                            <tr>
                                                                <td>1</td>
                                                                <td>Dugaan Pelanggaran</td>
                                                                <td>:</td>
                                                                <td colspan="4">
                                                                    <select
                                                                        class="form-select border-0 border-bottom select2"
                                                                        name="dugaan_pelanggaran_mpp" required>
                                                                        <option value="" disabled>- Pilih -</option>
                                                                        @foreach ($jenis_pelanggaran as $pelanggaran)
                                                                            @php
                                                                                $val =
                                                                                    $pelanggaran->alasan_penindakan .
                                                                                    ' (' .
                                                                                    $pelanggaran->jenis_pelanggaran .
                                                                                    ')';
                                                                            @endphp
                                                                            <option value="{{ $val }}"
                                                                                {{ old('dugaan_pelanggaran_mpp', $praPenindakan->dugaan_pelanggaran_mpp) == $val ? 'selected' : '' }}>
                                                                                {{ $val }}
                                                                            </option>
                                                                        @endforeach
                                                                    </select>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>2</td>
                                                                <td>Modus Pelanggaran</td>
                                                                <td>:</td>
                                                                <td colspan="4">
                                                                    <select class="form-control form-select select2"
                                                                        name="modus_pelanggaran_mpp" required>
                                                                        <option value="" disabled>- Pilih -</option>
                                                                        @foreach ($uraian_modus as $modus)
                                                                            <option value="{{ $modus->uraian_modus }}"
                                                                                {{ old('modus_pelanggaran_mpp', $praPenindakan->modus_pelanggaran_mpp) == $modus->uraian_modus ? 'selected' : '' }}>
                                                                                {{ $modus->uraian_modus }}
                                                                            </option>
                                                                        @endforeach
                                                                    </select>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>3</td>
                                                                <td>Locus Pelanggaran</td>
                                                                <td>:</td>
                                                                <td colspan="4">
                                                                    <select class="form-control form-select select2"
                                                                        name="locus_pelanggaran_mpp" required>
                                                                        <option value="" disabled>- Pilih -</option>
                                                                        @foreach ($tempat as $locus)
                                                                            <option value="{{ $locus->locus }}"
                                                                                {{ old('locus_pelanggaran_mpp', $praPenindakan->locus_pelanggaran_mpp) == $locus->locus ? 'selected' : '' }}>
                                                                                {{ $locus->locus }}
                                                                            </option>
                                                                        @endforeach
                                                                    </select>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>4</td>
                                                                <td>Tempus Pelanggaran</td>
                                                                <td>:</td>
                                                                <td colspan="4">
                                                                    <input type="text"
                                                                        class="form-control border-0 border-bottom"
                                                                        name="tempus_pelanggaran_mpp"
                                                                        id="datetime-datepicker"
                                                                        value="{{ old('tempus_pelanggaran_mpp', $praPenindakan->tempus_pelanggaran_mpp) }}">
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>5</td>
                                                                <td>Diduga Dilakukan Oleh</td>
                                                                <td>:</td>
                                                                <td colspan="4"></td>
                                                            </tr>
                                                            <tr>
                                                                <td></td>
                                                                <td>Nama</td>
                                                                <td>:</td>
                                                                <td colspan="4">
                                                                    <input type="text"
                                                                        class="form-control border-0 border-bottom"
                                                                        name="nama_mpp"
                                                                        value="{{ old('nama_mpp', $praPenindakan->nama_mpp) }}">
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td></td>
                                                                <td>No Identitas</td>
                                                                <td>:</td>
                                                                <td colspan="4">
                                                                    <input type="text"
                                                                        class="form-control border-0 border-bottom"
                                                                        name="noiden_mpp"
                                                                        value="{{ old('noiden_mpp', $praPenindakan->noiden_mpp) }}">
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td></td>
                                                                <td>Keterangan lainnya</td>
                                                                <td>:</td>
                                                                <td colspan="4">
                                                                    <textarea class="form-control border-0 border-bottom" name="keterangan_mpp" rows="1">{{ old('keterangan_mpp', $praPenindakan->keterangan_mpp) }}</textarea>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>6</td>
                                                                <td>Komoditi Barang</td>
                                                                <td>:</td>
                                                                <td>
                                                                    <input type="text"
                                                                        class="form-control border-0 border-bottom"
                                                                        name="komoditi_mpp"
                                                                        value="{{ old('komoditi_mpp', $praPenindakan->komoditi_mpp) }}">
                                                                </td>
                                                                <td>Jumlah</td>
                                                                <td>:</td>
                                                                <td>
                                                                    <input type="text"
                                                                        class="form-control border-0 border-bottom"
                                                                        name="jumlah_barang_mpp"
                                                                        value="{{ old('jumlah_barang_mpp', $praPenindakan->jumlah_barang_mpp) }}">
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>7</td>
                                                                <td>Jenis Pengangkut</td>
                                                                <td>:</td>
                                                                <td>
                                                                    <input type="text"
                                                                        class="form-control border-0 border-bottom"
                                                                        name="jenis_pengangkut_mpp"
                                                                        value="{{ old('jenis_pengangkut_mpp', $praPenindakan->jenis_pengangkut_mpp) }}">
                                                                </td>
                                                                <td>No Regis</td>
                                                                <td>:</td>
                                                                <td>
                                                                    <input type="text"
                                                                        class="form-control border-0 border-bottom"
                                                                        name="noreg_mpp"
                                                                        value="{{ old('noreg_mpp', $praPenindakan->noreg_mpp) }}">
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>8</td>
                                                                <td>Peti Kemas/Kemasan</td>
                                                                <td>:</td>
                                                                <td>
                                                                    <input type="text"
                                                                        class="form-control border-0 border-bottom"
                                                                        name="kemasan_mpp"
                                                                        value="{{ old('kemasan_mpp', $praPenindakan->kemasan_mpp) }}">
                                                                </td>
                                                                <td>Ukuran</td>
                                                                <td>:</td>
                                                                <td>
                                                                    <input type="text"
                                                                        class="form-control border-0 border-bottom"
                                                                        name="ukuran_mpp"
                                                                        value="{{ old('ukuran_mpp', $praPenindakan->ukuran_mpp) }}">
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>9</td>
                                                                <td>Dokumen Terkait</td>
                                                                <td>:</td>
                                                                <td colspan="4">
                                                                    <textarea class="form-control border-0 border-bottom" name="dokterkait_mpp" rows="1">{{ old('dokterkait_mpp', $praPenindakan->dokterkait_mpp) }}</textarea>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>10</td>
                                                                <td>Uraian Instruksi</td>
                                                                <td>:</td>
                                                                <td colspan="4">
                                                                    <textarea class="form-control border-0 border-bottom" name="uraian_mpp" rows="2">{{ old('uraian_mpp', $praPenindakan->uraian_mpp) }}</textarea>
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>

                                            <!-- Penutup -->
                                            <div class="row mt-4">
                                                <div class="col-12">
                                                    <p>Demikian untuk dilaksanakan dengan penuh tanggung jawab.</p>
                                                </div>
                                            </div>

                                            <!-- Tanda Tangan -->
                                            <div class="row mt-5">
                                                <div class="col-6"></div>
                                                <div class="col-6 text-center">
                                                    <p>................................., (21)</p>
                                                    <p>................................., (22)</p>
                                                    <select class="form-select select2 mb-3" id="id_pejabat_mpp"
                                                        name="id_pejabat_mpp">
                                                        <option value="" disabled>- Pilih Pejabat Penerbit MPP-
                                                        </option>
                                                        @foreach ($users as $user)
                                                            <option value="{{ $user->id_admin }}"
                                                                {{ old('id_pejabat_mpp', $praPenindakan->id_pejabat_mpp) == $user->id_admin ? 'selected' : '' }}>
                                                                {{ $user->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                    <p>................................., (23)</p>
                                                    <p>NIP. ............................, (24)</p>
                                                </div>
                                            </div>

                                            <!-- Tembusan -->
                                            <div class="row mt-4">
                                                <div class="col-12">
                                                    <p>Tembusan:</p>
                                                    <p>1. ..................</p>
                                                </div>
                                            </div>
                                        </div>




                                        <div class="container mt-4 mb-5 tab-pane" id="navtabs2-profile" role="tabpanel">

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

                                            <div class="text-center mb-4">
                                                <h5 class="border-bottom border-dark pb-2"><strong>LEMBAR ANALISIS
                                                        PRA PENINDAKAN</strong></h5>
                                                <div class="row justify-content-center">
                                                    <div class="col-md-8">
                                                        <div class="row mb-2">
                                                            <div class="col-md-3 text-start">Nomor LAP</div>
                                                            <div class="col-md-9 text-start input-group flex-wrap">
                                                                <input type="text"
                                                                    class="form-control bg-primary text-white"
                                                                    name="no_lap" value="{{ $praPenindakan->no_lap }}"
                                                                    readonly>
                                                                <input type="date" class="form-control" name="tgl_lap"
                                                                    value="{{ $praPenindakan->tgl_lap }}">
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-3 text-start">Sumber Informasi</div>
                                                            <div class="col-md-9 text-start">
                                                                <input type="text" class="form-control"
                                                                    placeholder="NHI/LI-1/Info lain"
                                                                    value="{{ $praPenindakan->sumber_informasi }}">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <table class="table-borderless"
                                                style="border-collapse: separate; border-spacing: 0 15px;table-layout: fixed; width: 100%;">
                                                <tbody>
                                                    <!-- BARIS 1: PELAKU -->
                                                    <tr>
                                                        <td width="5%" class="align-middle text-center">1.</td>
                                                        <td width="15%" class="align-middle">Pelaku</td>
                                                        <td width="80%">
                                                            <div class="row mb-2">
                                                                <div class="col-md-2">
                                                                    <div class="form-check form-check-inline">
                                                                        <input class="form-check-input" type="radio"
                                                                            name="pelaku" id="pelaku_ya" value="YA"
                                                                            {{ $praPenindakan->pelaku == 'YA' ? 'checked' : '' }}>
                                                                        <label class="form-check-label"
                                                                            for="pelaku_ya">Diketahui</label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-2">
                                                                    <div class="form-check form-check-inline">
                                                                        <input class="form-check-input" type="radio"
                                                                            name="pelaku" id="pelaku_tidak"
                                                                            value="TIDAK"
                                                                            {{ $praPenindakan->pelaku == 'TIDAK' ? 'checked' : '' }}>
                                                                        <label class="form-check-label"
                                                                            for="pelaku_tidak">Tidak Diketahui</label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-8">
                                                                    <textarea type="text" class="form-control form-input" name="keterangan_pelaku" placeholder="Keterangan pelaku"
                                                                        rows="1">{{ $praPenindakan->keterangan_pelaku }}</textarea>
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>

                                                    <!-- BARIS 2: DUGAAN PELANGGARAN -->
                                                    <tr>
                                                        <td class="align-middle text-center">2.</td>
                                                        <td class="align-middle">Dugaan Pelanggaran</td>
                                                        <td>
                                                            <div class="row mb-2">
                                                                <div class="col-md-2">
                                                                    <div class="form-check form-check-inline">
                                                                        <input class="form-check-input" type="radio"
                                                                            name="dugaan_pelanggaran" id="dugaan_ya"
                                                                            value="YA"
                                                                            {{ $praPenindakan->dugaan_pelanggaran == 'YA' ? 'checked' : '' }}>
                                                                        <label class="form-check-label"
                                                                            for="dugaan_ya">Diketahui</label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-2">
                                                                    <div class="form-check form-check-inline">
                                                                        <input class="form-check-input" type="radio"
                                                                            name="dugaan_pelanggaran" id="dugaan_tidak"
                                                                            value="TIDAK"
                                                                            {{ $praPenindakan->dugaan_pelanggaran == 'TIDAK' ? 'checked' : '' }}>
                                                                        <label class="form-check-label"
                                                                            for="dugaan_tidak">Tidak Diketahui</label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-8">
                                                                    <select class="form-control form-select select2"
                                                                        name="keterangan_dugaan_pelanggaran" required>
                                                                        <option value="" disabled>- Pilih -</option>
                                                                        @foreach ($jenis_pelanggaran as $pelanggaran)
                                                                            <option
                                                                                value="{{ $pelanggaran->alasan_penindakan }} ({{ $pelanggaran->jenis_pelanggaran }})"
                                                                                {{ $praPenindakan->keterangan_dugaan_pelanggaran == $pelanggaran->alasan_penindakan . ' (' . $pelanggaran->jenis_pelanggaran . ')' ? 'selected' : '' }}>
                                                                                {{ $pelanggaran->alasan_penindakan }}
                                                                                ({{ $pelanggaran->jenis_pelanggaran }})
                                                                            </option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>

                                                    <!-- BARIS 3: LOCUS -->
                                                    <tr>
                                                        <td class="align-middle text-center">3.</td>
                                                        <td class="align-middle">Locus</td>
                                                        <td>
                                                            <div class="row mb-2">
                                                                <div class="col-md-2">
                                                                    <div class="form-check form-check-inline">
                                                                        <input class="form-check-input" type="radio"
                                                                            name="locus" id="locus_ya" value="YA"
                                                                            {{ $praPenindakan->locus == 'YA' ? 'checked' : '' }}>
                                                                        <label class="form-check-label"
                                                                            for="locus_ya">Diketahui</label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-2">
                                                                    <div class="form-check form-check-inline">
                                                                        <input class="form-check-input" type="radio"
                                                                            name="locus" id="locus_tidak"
                                                                            value="TIDAK"
                                                                            {{ $praPenindakan->locus == 'TIDAK' ? 'checked' : '' }}>
                                                                        <label class="form-check-label"
                                                                            for="locus_tidak">Tidak Diketahui</label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-8">
                                                                    <select class="form-control form-select select2"
                                                                        name="keterangan_locus" required>
                                                                        <option value="" disabled>- Pilih -</option>
                                                                        @foreach ($tempat as $locus)
                                                                            <option value="{{ $locus->locus }}"
                                                                                {{ $praPenindakan->keterangan_locus == $locus->locus ? 'selected' : '' }}>
                                                                                {{ $locus->locus }}
                                                                            </option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>

                                                    <!-- BARIS 4: TEMPUS -->
                                                    <tr>
                                                        <td class="align-middle text-center">4.</td>
                                                        <td class="align-middle">Tempus</td>
                                                        <td>
                                                            <div class="row mb-2">
                                                                <div class="col-md-2">
                                                                    <div class="form-check form-check-inline">
                                                                        <input class="form-check-input" type="radio"
                                                                            name="tempus" id="tempus_ya" value="YA"
                                                                            {{ $praPenindakan->tempus == 'YA' ? 'checked' : '' }}>
                                                                        <label class="form-check-label"
                                                                            for="tempus_ya">Diketahui</label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-2">
                                                                    <div class="form-check form-check-inline">
                                                                        <input class="form-check-input" type="radio"
                                                                            name="tempus" id="tempus_tidak"
                                                                            value="TIDAK"
                                                                            {{ $praPenindakan->tempus == 'TIDAK' ? 'checked' : '' }}>
                                                                        <label class="form-check-label"
                                                                            for="tempus_tidak">Tidak Diketahui</label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <input type="text" class="form-control"
                                                                        name="keterangan_tempus" id="datetime-datepicker"
                                                                        placeholder="Mulainya Pra Penindakan"
                                                                        value="{{ $praPenindakan->keterangan_tempus }}">
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <input type="text" class="form-control"
                                                                        name="berakhirnya_tempus" id="datetime-datepicker"
                                                                        placeholder="Berakhirnya Pra Penindakan"
                                                                        value="{{ $praPenindakan->berakhirnya_tempus }}">
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>


                                                    <tr>
                                                        <td class="align-middle text-center"></td>
                                                        <td class="align-middle" colspan="2">
                                                        </td>
                                                    </tr>

                                                    <!-- BARIS 6: PROSEDURAL -->
                                                    <tr>
                                                        <td class="align-middle text-center"></td>
                                                        <td class="align-middle">Prosedural</td>
                                                        <td>
                                                            <div class="row mb-2">
                                                                <div class="col-md-6">
                                                                    <div class="form-check form-check-inline">
                                                                        <input class="form-check-input" type="radio"
                                                                            name="prosedural" id="prosedural_djbc"
                                                                            value="Kewenangan DJBC"
                                                                            {{ $praPenindakan->prosedural == 'Kewenangan DJBC' ? 'checked' : '' }}>
                                                                        <label class="form-check-label"
                                                                            for="prosedural_djbc">Kewenangan DJBC</label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class="form-check form-check-inline">
                                                                        <input class="form-check-input" type="radio"
                                                                            name="prosedural" id="prosedural_bukan"
                                                                            value="Bukan"
                                                                            {{ $praPenindakan->prosedural == 'Bukan' ? 'checked' : '' }}>
                                                                        <label class="form-check-label"
                                                                            for="prosedural_bukan">Bukan</label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <textarea type="text" class="form-control form-input" name="ket_prosedural" placeholder="Keterangan Prosedural"
                                                                        rows="1">{{ $praPenindakan->ket_prosedural }}</textarea>
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>

                                                    <!-- BARIS 7: SDM -->
                                                    <tr>
                                                        <td class="align-middle text-center"></td>
                                                        <td class="align-middle">SDM</td>
                                                        <td>
                                                            <div class="row mb-2">
                                                                <div class="col-md-6">
                                                                    <div class="form-check form-check-inline">
                                                                        <input class="form-check-input" type="radio"
                                                                            name="sdm" id="sdm_tersedia"
                                                                            value="TERSEDIA"
                                                                            {{ $praPenindakan->sdm == 'TERSEDIA' ? 'checked' : '' }}>
                                                                        <label class="form-check-label"
                                                                            for="sdm_tersedia">Tersedia</label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class="form-check form-check-inline">
                                                                        <input class="form-check-input" type="radio"
                                                                            name="sdm" id="sdm_tidak" value="TIDAK"
                                                                            {{ $praPenindakan->sdm == 'TIDAK' ? 'checked' : '' }}>
                                                                        <label class="form-check-label"
                                                                            for="sdm_tidak">Tidak</label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <textarea type="text" class="form-control form-input" name="ket_sdm" placeholder="Keterangan SDM"
                                                                        rows="1">{{ $praPenindakan->ket_sdm }}</textarea>
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>

                                                    <!-- BARIS 8: SARANA PRASARANA -->
                                                    <tr>
                                                        <td class="align-middle text-center"></td>
                                                        <td class="align-middle">Sarana Prasarana</td>
                                                        <td>
                                                            <div class="row mb-2">
                                                                <div class="col-md-6">
                                                                    <div class="form-check form-check-inline">
                                                                        <input class="form-check-input" type="radio"
                                                                            name="sarana_prasarana" id="sarana_tersedia"
                                                                            value="TERSEDIA"
                                                                            {{ $praPenindakan->sarana_prasarana == 'TERSEDIA' ? 'checked' : '' }}>
                                                                        <label class="form-check-label"
                                                                            for="sarana_tersedia">Tersedia</label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class="form-check form-check-inline">
                                                                        <input class="form-check-input" type="radio"
                                                                            name="sarana_prasarana" id="sarana_tidak"
                                                                            value="TIDAK"
                                                                            {{ $praPenindakan->sarana_prasarana == 'TIDAK' ? 'checked' : '' }}>
                                                                        <label class="form-check-label"
                                                                            for="sarana_tidak">Tidak</label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <textarea type="text" class="form-control form-input" name="ket_sarana_prasarana"
                                                                        placeholder="Keterangan Sarana Prasarana" rows="1">{{ $praPenindakan->ket_sarana_prasarana }}</textarea>
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>

                                                    <!-- BARIS 9: ANGGARAN -->
                                                    <tr>
                                                        <td class="align-middle text-center"></td>
                                                        <td class="align-middle">Anggaran</td>
                                                        <td>
                                                            <div class="row mb-2">
                                                                <div class="col-md-6">
                                                                    <div class="form-check form-check-inline">
                                                                        <input class="form-check-input" type="radio"
                                                                            name="anggaran" id="anggaran_tersedia"
                                                                            value="TERSEDIA"
                                                                            {{ $praPenindakan->anggaran == 'TERSEDIA' ? 'checked' : '' }}>
                                                                        <label class="form-check-label"
                                                                            for="anggaran_tersedia">Tersedia</label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class="form-check form-check-inline">
                                                                        <input class="form-check-input" type="radio"
                                                                            name="anggaran" id="anggaran_tidak"
                                                                            value="TIDAK"
                                                                            {{ $praPenindakan->anggaran == 'TIDAK' ? 'checked' : '' }}>
                                                                        <label class="form-check-label"
                                                                            for="anggaran_tidak">Tidak</label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <textarea type="text" class="form-control form-input" name="ket_anggaran" placeholder="Keterangan Anggaran"
                                                                        rows="1">{{ $praPenindakan->ket_anggaran }}</textarea>
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>

                                                    <!-- BARIS 10: PILIHAN KEGIATAN -->
                                                    <tr>
                                                        <td class="align-middle text-center"></td>
                                                        <td class="align-middle">Kelayakan Operasional</td>
                                                        <td>
                                                            <div class="row mb-3">
                                                                <div class="col-md-12">
                                                                    <select id="pilihan_kegiatan" class="form-select mb-2"
                                                                        name="pilihan_kegiatan">
                                                                        <option value="">-- Pilih Kegiatan --
                                                                        </option>
                                                                        <option value="penindakan"
                                                                            {{ $praPenindakan->pilihan_kegiatan == 'penindakan' ? 'selected' : '' }}>
                                                                            Layak Dilakukan Operasi Penindakan</option>
                                                                        <option value="patroli"
                                                                            {{ $praPenindakan->pilihan_kegiatan == 'patroli' ? 'selected' : '' }}>
                                                                            Layak Dilakukan Patroli</option>
                                                                        <option value="tidak_layak"
                                                                            {{ $praPenindakan->pilihan_kegiatan == 'tidak_layak' ? 'selected' : '' }}>
                                                                            Tidak Layak Dilakukan Operasi atau Patroli
                                                                        </option>
                                                                    </select>
                                                                </div>
                                                            </div>

                                                            <!-- Bagian Layak Dilakukan Operasi Penindakan -->
                                                            <div id="penindakan_section"
                                                                class="{{ $praPenindakan->pilihan_kegiatan == 'penindakan' ? '' : 'd-none' }}">
                                                                <div class="row mb-3">
                                                                    <div class="col-md-3">
                                                                        <label class="form-label">Skema Penindakan:</label>
                                                                    </div>
                                                                    <div class="col-md-9">
                                                                        <select id="skema_penindakan"
                                                                            class="form-select mb-2"
                                                                            name="skem_layak_penindakan">
                                                                            <option value="MANDIRI"
                                                                                {{ $praPenindakan->skem_layak_penindakan == 'MANDIRI' ? 'selected' : '' }}>
                                                                                MANDIRI</option>
                                                                            <option value="PELIMPAHAN"
                                                                                {{ $praPenindakan->skem_layak_penindakan == 'PELIMPAHAN' ? 'selected' : '' }}>
                                                                                PELIMPAHAN</option>
                                                                            <option value="BERSAMA"
                                                                                {{ $praPenindakan->skem_layak_penindakan == 'BERSAMA' ? 'selected' : '' }}>
                                                                                BERSAMA</option>
                                                                            <option value="DENGAN INSTANSI LAIN"
                                                                                {{ $praPenindakan->skem_layak_penindakan == 'DENGAN INSTANSI LAIN' ? 'selected' : '' }}>
                                                                                DENGAN INSTANSI LAIN</option>
                                                                        </select>
                                                                        <textarea class="form-control" name="ket_layak_penindakan" placeholder="Keterangan Skema Penindakan" rows="1">{{ $praPenindakan->ket_layak_penindakan }}</textarea>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <!-- Bagian Layak Dilakukan Patroli -->
                                                            <div id="patroli_section"
                                                                class="{{ $praPenindakan->pilihan_kegiatan == 'patroli' ? '' : 'd-none' }}">
                                                                <div class="row mb-3">
                                                                    <div class="col-md-3">
                                                                        <label class="form-label">Skema Patroli:</label>
                                                                    </div>
                                                                    <div class="col-md-9">
                                                                        <select id="skema_patroli"
                                                                            class="form-select mb-2"
                                                                            name="skem_layak_patroli">
                                                                            <option value="MANDIRI"
                                                                                {{ $praPenindakan->skem_layak_patroli == 'MANDIRI' ? 'selected' : '' }}>
                                                                                MANDIRI</option>
                                                                            <option value="PERBANTUAN"
                                                                                {{ $praPenindakan->skem_layak_patroli == 'PERBANTUAN' ? 'selected' : '' }}>
                                                                                PERBANTUAN</option>
                                                                            <option value="TERKOORDINASI"
                                                                                {{ $praPenindakan->skem_layak_patroli == 'TERKOORDINASI' ? 'selected' : '' }}>
                                                                                TERKOORDINASI</option>
                                                                            <option value="DENGAN INSTANSI LAIN"
                                                                                {{ $praPenindakan->skem_layak_patroli == 'DENGAN INSTANSI LAIN' ? 'selected' : '' }}>
                                                                                DENGAN INSTANSI LAIN</option>
                                                                            <option value="LAINNYA"
                                                                                {{ $praPenindakan->skem_layak_patroli == 'LAINNYA' ? 'selected' : '' }}>
                                                                                LAINNYA</option>
                                                                        </select>
                                                                        <textarea class="form-control" name="ket_layak_patroli" placeholder="Keterangan Skema Patroli" rows="1">{{ $praPenindakan->ket_layak_patroli }}</textarea>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <!-- Bagian Tidak Layak -->
                                                            <div id="tidak_layak_section"
                                                                class="{{ $praPenindakan->pilihan_kegiatan == 'tidak_layak' ? '' : 'd-none' }}">
                                                                <div class="row mb-3">
                                                                    <div class="col-md-3">
                                                                        <label class="form-label">Keterangan:</label>
                                                                    </div>
                                                                    <div class="col-md-9">
                                                                        <textarea class="form-control" name="ket_tidak_layak" placeholder="Keterangan Tidak Layak" rows="1">{{ $praPenindakan->ket_tidak_layak }}</textarea>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>

                                                    <!-- BARIS 11: KESIMPULAN -->
                                                    <tr>
                                                        <td class="align-middle" colspan="3">
                                                            <div class="row mb-2">
                                                                <div class="col-md-2">
                                                                    <label class="form-label">Kesimpulan :</label>
                                                                </div>
                                                                <div class="col-md-10">
                                                                    <textarea type="text" class="form-control form-input" name="kesimpulan_lap" placeholder="Kesimpulan"
                                                                        rows="2">{{ $praPenindakan->kesimpulan_lap }}</textarea>
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>

                                            <div class="row mb-5">
                                                <div class="col-6">
                                                    <!-- Left side - blank -->
                                                </div>
                                                <div class="col-6 text-center">
                                                    <p>Batam,.........................</p>
                                                    <hr>
                                                    <select class="form-select select2 mb-3" id="id_pejabat_lap_1"
                                                        name="id_pejabat_lap_1">
                                                        <option value="" disabled>- Pilih Pejabat Pelaksana
                                                            Penindakan Penyusun LAP-</option>
                                                        @foreach ($users as $user)
                                                            <option value="{{ $user->id_admin }}"
                                                                {{ $praPenindakan->id_pejabat_lap_1 == $user->id_admin ? 'selected' : '' }}>
                                                                {{ $user->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="row mb-3">
                                                <div class="col-6 text-center">
                                                    <select class="form-select select2 mb-3" id="id_pejabat_lap_2"
                                                        name="id_pejabat_lap_2">
                                                        <option value="" disabled>- Pilih Pejabat Penerbit LAP -
                                                        </option>
                                                        @foreach ($users as $user)
                                                            <option value="{{ $user->id_admin }}"
                                                                {{ $praPenindakan->id_pejabat_lap_2 == $user->id_admin ? 'selected' : '' }}>
                                                                {{ $user->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-6 text-center">
                                                    <select class="form-select select2 mb-3" id="id_pejabat_lap_3"
                                                        name="id_pejabat_lap_3">
                                                        <option value="" disabled>- Pilih Pengampu Pejabat Penerbit
                                                            LAP -</option>
                                                        @foreach ($users as $user)
                                                            <option value="{{ $user->id_admin }}"
                                                                {{ $praPenindakan->id_pejabat_lap_3 == $user->id_admin ? 'selected' : '' }}>
                                                                {{ $user->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>

                                        </div>

                                        <div class="container mt-4 mb-5 tab-pane" id="navtabs2-messages" role="tabpanel">
                                            <div class="card">
                                                <div class="card-body">
                                                    <div class="row mb-4 align-items-center">
                                                        <div class="col-2 text-center">
                                                            <img src="/images/logocop.png" alt="Logo"
                                                                class="img-fluid" style="max-height:170px;">
                                                        </div>
                                                        <div class="col-10 text-center">
                                                            <h5 class="mb-0 fw-bold">KEMENTERIAN KEUANGAN REPUBLIK
                                                                INDONESIA</h5>
                                                            <p class="small mb-0">DIREKTORAT JENDERAL BEA DAN CUKAI</p>
                                                            <p class="small mb-0">KANTOR PELAYANAN UTAMA BEA DAN CUKAI TIPE
                                                                B BATAM</p>
                                                            <p class="small mb-0">
                                                                JALAN KUDA LAUT, BATU AMPAR, BATAM, KEPULAUAN RIAU 29432;
                                                                TELEPON (0778) 458118, 458263;
                                                                FAKSIMILE (0778) 458149;
                                                            </p>
                                                            <p class="small mb-0">
                                                                LAMAN WWW.BCBATAM.BEACUKAI.GO.ID; PUSAT KONTAK LAYANAN
                                                                1500225;
                                                                SUREL BCBPBATAM@CUSTOMS.GO.ID, KPBC.BATAM@KEMENKEU.GO.ID
                                                            </p>
                                                        </div>
                                                    </div>
                                                    <hr>

                                                    <div class="row justify-content-center">
                                                        <div class="col-md-10">
                                                            <div class="text-center mb-4">
                                                                <h5 class="mb-0 fw-bold text-decoration-underline">NOTA
                                                                    PENGEMBALIAN INFORMASI</h5>
                                                                <p class="mb-0">Nomor :
                                                                    <input type="text"
                                                                        class="border-0 border-bottom text-center"
                                                                        style="width: 150px;" name="no_npi"
                                                                        value="{{ old('no_npi', $praPenindakan->no_npi) }}"
                                                                        readonly>
                                                                    KPU.206/
                                                                    <input type="date"
                                                                        class="border-0 border-bottom text-center"
                                                                        style="width: 150px;" name="tgl_npi"
                                                                        value="{{ old('tgl_npi', $praPenindakan->tgl_npi) }}">
                                                                </p>
                                                            </div>

                                                            <div class="mb-3">
                                                                <div class="row">
                                                                    <div class="col-md-12">
                                                                        <p>Sumber informasi NHI/Informasi lain Nomor :
                                                                            <input type="text"
                                                                                class="border-0 border-bottom"
                                                                                style="width: 120px;"
                                                                                id="sumber_informasi_npi"
                                                                                name="sumber_npi"
                                                                                value="{{ old('sumber_npi', $praPenindakan->sumber_npi) }}">
                                                                        </p>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="mb-3">
                                                                <p class="text-justify">Bersama ini diberitahukan bahwa
                                                                    berdasarkan Analisis Prapenindakan yang telah dilakukan
                                                                    terhadap informasi dari Unit
                                                                    <input type="text" class="border-0 border-bottom"
                                                                        style="width: 150px;" id="unit_penerbit_informasi"
                                                                        name="unit_penerbit_npi"
                                                                        value="{{ old('unit_penerbit_npi', $praPenindakan->unit_penerbit_npi) }}">,
                                                                    dapat kami sampaikan atas informasi tersebut
                                                                    <span class="fw-bold fst-italic">tidak/belum*</span>
                                                                    dapat dilakukan Penindakan lebih lanjut dengan alasan
                                                                    sebagai berikut:
                                                                </p>
                                                            </div>

                                                            <div class="mb-4">
                                                                <select class="form-select mb-2 select2"
                                                                    name="kategori_npi">
                                                                    <option value="" disabled>- Pilih Kategori
                                                                        Penindakan -</option>
                                                                    @foreach ($kapen as $kategori)
                                                                        <option value="{{ $kategori->jenis_penindakan }}"
                                                                            {{ old('kategori_npi', $praPenindakan->kategori_npi) == $kategori->jenis_penindakan ? 'selected' : '' }}>
                                                                            {{ $kategori->jenis_penindakan }}
                                                                        </option>
                                                                    @endforeach
                                                                </select>
                                                                <textarea class="form-control" rows="3" id="alasan_penindakan_npi" name="alasan_npi"
                                                                    placeholder="Alasan Tidak Dapat Dilakukan Penindakan Lebih Lanjut">{{ old('alasan_npi', $praPenindakan->alasan_npi) }}</textarea>
                                                            </div>

                                                            <div class="mb-3">
                                                                <p>Demikian disampaikan, atas perhatiannya diucapkan terima
                                                                    kasih.</p>
                                                            </div>

                                                            <div class="row mb-5">
                                                                <div class="col-md-6"></div>
                                                                <div class="col-md-6 text-center">
                                                                    <p class="mb-5 mt-3">................................
                                                                    </p>
                                                                    <select class="form-select mb-1" id="id_pejabat_npi"
                                                                        name="id_pejabat_npi">
                                                                        <option value="" disabled>- Pilih Pejabat -
                                                                        </option>
                                                                        @foreach ($users as $user)
                                                                            <option value="{{ $user->id_admin }}"
                                                                                {{ old('id_pejabat_npi', $praPenindakan->id_pejabat_npi) == $user->id_admin ? 'selected' : '' }}>
                                                                                {{ $user->name }}
                                                                            </option>
                                                                        @endforeach
                                                                    </select>
                                                                    <p class="mt-1">NIP. ................................
                                                                    </p>
                                                                </div>
                                                            </div>

                                                            <div class="mt-3 text-start">
                                                                <p class="small fst-italic">*Coret yang tidak perlu</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>



                                        <!-- Bagian Edit Surat Perintah -->
                                        <div class="container my-4 tab-pane" id="navtabs2-settings" role="tabpanel">
                                            <!-- Header Surat -->
                                            <div class="row mb-4 align-items-center">
                                                <div class="col-2 text-center">
                                                    <img src="/images/logocop.png" alt="Logo" class="img-fluid"
                                                        style="max-height:170px;">
                                                </div>
                                                <div class="col-10 text-center">
                                                    <h5 class="mb-0 fw-bold">KEMENTERIAN KEUANGAN REPUBLIK INDONESIA</h5>
                                                    <p class="small mb-0">DIREKTORAT JENDERAL BEA DAN CUKAI</p>
                                                    <p class="small mb-0">KANTOR PELAYANAN UTAMA BEA DAN CUKAI TIPE B BATAM
                                                    </p>
                                                    <p class="small mb-0">JALAN KUDA LAUT, BATU AMPAR, BATAM, KEPULAUAN
                                                        RIAU 29432; TELEPON (0778) 458118, 458263; FAKSIMILE (0778) 458149;
                                                    </p>
                                                    <p class="small mb-0">LAMAN WWW.BCBATAM.BEACUKAI.GO.ID; PUSAT KONTAK
                                                        LAYANAN 1500225; SUREL BCBPBATAM@CUSTOMS.GO.ID,
                                                        KPBC.BATAM@KEMENKEU.GO.ID</p>
                                                </div>
                                            </div>

                                            <div class="border-top border-dark border-1 mb-3"></div>

                                            <!-- Judul Surat -->
                                            <div class="row mb-4">
                                                <div class="col-12 text-center">
                                                    <h5 class="fw-bold">SURAT PERINTAH</h5>
                                                    <div class="d-flex justify-content-center">
                                                        <span>Nomor PRIN- </span>
                                                        <input type="text" class="form-control form-control-sm mx-2"
                                                            style="width: 50px;"
                                                            value="{{ old('no_print', $praPenindakan->no_print) }}"
                                                            name="no_print" readonly>
                                                        <span>/</span>
                                                        <span>KPU.206</span>
                                                        <span>/</span>
                                                        <input type="date" class="form-control form-control-sm mx-2"
                                                            style="width: 110px;" name="tgl_print"
                                                            value="{{ old('tgl_print', $praPenindakan->tgl_print) }}">
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Isi Surat -->
                                            <div class="row">
                                                <div class="col-2 fw-bold">Menimbang</div>
                                                <div class="col-1 text-center">:</div>
                                                <div class="col-9">
                                                    <div class="d-flex">
                                                        <span>a.</span>
                                                        <div class="ms-2">
                                                            Bahwa guna mengamankan hak-hak negara dan agar dipatuhinya
                                                            ketentuan perundang-undangan yang berlaku;
                                                            <textarea class="form-control mt-2" rows="2" id="pertimbangan_surat_perintah" name="ket_perundang"
                                                                placeholder="Pertimbangan Diterbitkannya Surat Perintah">{{ old('ket_perundang', $praPenindakan->ket_perundang) }}</textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row mt-3">
                                                <div class="col-2 fw-bold">Dasar</div>
                                                <div class="col-1 text-center">:</div>
                                                <div class="col-9">
                                                    <ol>
                                                        <li>
                                                            <textarea class="form-control mt-1" rows="2" id="dasar_sp" name="dasar_sp"
                                                                placeholder="Dasar Hukum Yang Mendasari Diterbitkannya Surat Perintah">{{ old('dasar_sp', $praPenindakan->dasar_sp) }}</textarea>
                                                        </li>
                                                    </ol>
                                                </div>
                                            </div>

                                            <div class="row mt-4 text-center">
                                                <div class="col-12">
                                                    <h6 class="fw-bold">Memberi Perintah:</h6>
                                                </div>
                                            </div>

                                            <div class="row mt-3">
                                                <div class="col-2 fw-bold">Kepada</div>
                                                <div class="col-1 text-center">:</div>
                                                <div class="col-9">
                                                    <div class="mb-3">
                                                        <select class="form-select select2" id="id_pejabat_sp_1"
                                                            name="id_pejabat_sp_1[]" multiple>
                                                            @foreach ($users as $user)
                                                                <option value="{{ $user->id_admin }}"
                                                                    @if (in_array($user->id_admin, old('id_pejabat_sp_1', json_decode($praPenindakan->id_pejabat_sp_1 ?? '[]', true)))) selected @endif>
                                                                    {{ $user->name }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row mt-3">
                                                <div class="col-2 fw-bold">Untuk</div>
                                                <div class="col-1 text-center">:</div>
                                                <div class="col-9">
                                                    <textarea class="form-control" rows="2" id="perintah_sp" name="perintah_sp"
                                                        placeholder="Perintah Yang Diberikan Kepada Pejabat Bea dan Cukai">{{ old('perintah_sp', $praPenindakan->perintah_sp) }}</textarea>
                                                </div>
                                            </div>

                                            <div class="row mt-3">
                                                <div class="col-2 fw-bold">Wilayah</div>
                                                <div class="col-1 text-center">:</div>
                                                <div class="col-9">
                                                    <input type="text" class="form-control" name="wilayah"
                                                        value="{{ old('wilayah', $praPenindakan->wilayah) }}"
                                                        placeholder="Wilayah">
                                                </div>
                                            </div>

                                            <div class="row mt-3">
                                                <div class="col-2 fw-bold">Waktu</div>
                                                <div class="col-1 text-center">:</div>
                                                <div class="col-9">
                                                    <div class="d-flex align-items-center">
                                                        <span>Berlaku mulai tanggal</span>
                                                        <input type="date" class="form-control mx-2"
                                                            name="tanggal_mulai_print" style="width: 170px;"
                                                            value="{{ old('tanggal_mulai_print', $praPenindakan->tanggal_mulai_print) }}">
                                                        <span>s.d</span>
                                                        <input type="date" class="form-control mx-2"
                                                            id="tanggal_berakhir_print" name="tanggal_berakhir_print"
                                                            style="width: 170px;"
                                                            value="{{ old('tanggal_berakhir_print', $praPenindakan->tanggal_berakhir_print) }}">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row mt-3">
                                                <div class="col-2 fw-bold">Ketentuan</div>
                                                <div class="col-1 text-center">:</div>
                                                <div class="col-9">
                                                    <select class="form-control" id="ketentuan_baju"
                                                        name="ketentuan_baju">
                                                        <option value="" disabled>- Pilih -</option>
                                                        <option value="Berpakaian PDH"
                                                            {{ old('ketentuan_baju', $praPenindakan->ketentuan_baju) == 'Berpakaian PDH' ? 'selected' : '' }}>
                                                            Berpakaian PDH</option>
                                                        <option value="Berpakaian Non PDH"
                                                            {{ old('ketentuan_baju', $praPenindakan->ketentuan_baju) == 'Berpakaian Non PDH' ? 'selected' : '' }}>
                                                            Berpakaian Non PDH</option>
                                                        <option value="Berpakaian PDL"
                                                            {{ old('ketentuan_baju', $praPenindakan->ketentuan_baju) == 'Berpakaian PDL' ? 'selected' : '' }}>
                                                            Berpakaian PDL</option>
                                                    </select>
                                                    <textarea class="form-control mt-2" rows="2" id="ketentuan_lain" name="ketentuan_lain"
                                                        placeholder="Ketentuan Lain">{{ old('ketentuan_lain', $praPenindakan->ketentuan_lain) }}</textarea>
                                                </div>
                                            </div>

                                            <div class="row mt-3">
                                                <div class="col-12">
                                                    <p class="small">Kepada yang bersangkutan ... agar memberikan bantuan
                                                        sepenuhnya.</p>
                                                </div>
                                            </div>

                                            <div class="row mt-4">
                                                <div class="col-6"></div>
                                                <div class="col-6 text-center">
                                                    <div class="d-flex flex-column">
                                                        <div>
                                                            <select class="form-control form-select mb-2" id="plh"
                                                                name="plh">
                                                                <option value="" disabled>- Pilih Plh -</option>
                                                                <option value="Plh"
                                                                    {{ old('plh', $praPenindakan->plh) == 'Plh' ? 'selected' : '' }}>
                                                                    Pelaksana Harian</option>
                                                                <option value=""
                                                                    {{ old('plh', $praPenindakan->plh) == '' ? 'selected' : '' }}>
                                                                    Tidak Ada Pelaksana Harian</option>
                                                            </select>
                                                        </div>
                                                        <select class="form-control form-select mb-3" id="id_pejabat_sp_2"
                                                            name="id_pejabat_sp_2">
                                                            <option value="" selected disabled>- Pilih Pejabat Yang
                                                                Menandatangani -</option>
                                                            @foreach ($users as $user)
                                                                <option value="{{ $user->id_admin }}"
                                                                    {{ old('id_pejabat_sp_2', $praPenindakan->id_pejabat_sp_2) == $user->id_admin ? 'selected' : '' }}>
                                                                    {{ $user->name }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                        <p class="mb-0">NIP. ..............................</p>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row mt-4">
                                                <div class="col-12">
                                                    <p class="fw-bold">Tembusan:</p>
                                                    <p>..............................</p>
                                                </div>
                                            </div>

                                            <!-- Form Pengaturan Tambahan -->
                                            <div class="row mt-5 pt-5 border-top">
                                                <div class="col-lg-6">
                                                    <h6><b>Data Input Tambahan</b></h6>
                                                    <div class="mb-3">
                                                        <label>Penentuan Skema Penindakan</label>
                                                        <select class="form-control form-select"
                                                            name="skema_penindakan_perintah">
                                                            <option value="" disabled>- Pilih -</option>
                                                            <option value="MANDIRI"
                                                                {{ old('skema_penindakan_perintah', $praPenindakan->skema_penindakan_perintah) == 'MANDIRI' ? 'selected' : '' }}>
                                                                Mandiri</option>
                                                            <option value="Perbantuan"
                                                                {{ old('skema_penindakan_perintah', $praPenindakan->skema_penindakan_perintah) == 'Perbantuan' ? 'selected' : '' }}>
                                                                Perbantuan</option>
                                                            <option value="Perbantuan/Bersama Instansi Lain"
                                                                {{ old('skema_penindakan_perintah', $praPenindakan->skema_penindakan_perintah) == 'Perbantuan/Bersama Instansi Lain' ? 'selected' : '' }}>
                                                                Perbantuan/Bersama Instansi Lain</option>
                                                        </select>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label>Dilakukannya Patroli</label>
                                                        <select class="form-control form-select"
                                                            name="dilakukannya_patroli">
                                                            <option value="" disabled>- Pilih -</option>
                                                            <option value="YA"
                                                                {{ old('dilakukannya_patroli', $praPenindakan->dilakukannya_patroli) == 'YA' ? 'selected' : '' }}>
                                                                YA</option>
                                                            <option value="TIDAK"
                                                                {{ old('dilakukannya_patroli', $praPenindakan->dilakukannya_patroli) == 'TIDAK' ? 'selected' : '' }}>
                                                                TIDAK</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>


                                        <div class="card-footer d-flex justify-content-end">
                                            <button type="submit"
                                                class="btn btn-success btn-sm d-flex align-items-center">
                                                <i data-feather="save" class="me-1"></i> Simpan Data LI
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
        feather.replace();
    </script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const selectElement = document.getElementById("pilihan_kegiatan");
            const skemaPenindakanElement = document.getElementById("skema_penindakan");

            function updateSectionsAndTabs() {
                const selectedValue = selectElement.value;
                const skemaPenindakanValue = skemaPenindakanElement ? skemaPenindakanElement.value : null;

                // Sembunyikan semua section
                document.getElementById("penindakan_section").classList.add("d-none");
                document.getElementById("patroli_section").classList.add("d-none");
                document.getElementById("tidak_layak_section").classList.add("d-none");

                // Tampilkan section sesuai pilihan
                if (selectedValue === "penindakan") {
                    document.getElementById("penindakan_section").classList.remove("d-none");
                } else if (selectedValue === "patroli") {
                    document.getElementById("patroli_section").classList.remove("d-none");
                } else if (selectedValue === "tidak_layak") {
                    document.getElementById("tidak_layak_section").classList.remove("d-none");
                }

                // Konfigurasi tab yang tampil
                const tabsConfig = [{
                        id: "navtabs2-messages-tab-item",
                        linkId: "navtabs2-messages-tab",
                        condition: selectedValue === "tidak_layak",
                    },
                    {
                        id: "navtabs2-mpp-tab-item",
                        linkId: "navtabs2-mpp-tab",
                        condition: selectedValue === "penindakan" && skemaPenindakanValue === "PELIMPAHAN",
                    },
                    {
                        id: "navtabs2-settings-tab-item",
                        linkId: "navtabs2-settings-tab",
                        condition: selectedValue === "penindakan" || selectedValue === "patroli",
                    },
                ];

                // Update visibilitas tab
                tabsConfig.forEach(({
                    id,
                    linkId,
                    condition
                }) => {
                    const tabElement = document.getElementById(id);
                    const tabLinkElement = document.getElementById(linkId);

                    if (tabElement) {
                        tabElement.style.display = condition ? "block" : "none";

                        if (condition && tabLinkElement) {
                            tabLinkElement.classList.add("highlight");
                            setTimeout(() => tabLinkElement.classList.remove("highlight"), 1000);
                        }
                    }
                });
            }

            // Ambil nilai lama atau dari model Laravel (untuk edit)
            const oldPilihanKegiatan = '{{ old('pilihan_kegiatan', $praPenindakan->pilihan_kegiatan ?? '') }}';
            const oldSkemaPenindakan =
                '{{ old('skem_layak_penindakan', $praPenindakan->skem_layak_penindakan ?? '') }}';

            // Tunggu sebentar untuk memastikan elemen terisi dengan benar
            setTimeout(() => {
                if (selectElement) selectElement.value = oldPilihanKegiatan;
                if (skemaPenindakanElement) skemaPenindakanElement.value = oldSkemaPenindakan;

                updateSectionsAndTabs();
            }, 100);

            // Event listener saat user mengubah pilihan
            if (selectElement) {
                selectElement.addEventListener("change", updateSectionsAndTabs);
            }

            if (skemaPenindakanElement) {
                skemaPenindakanElement.addEventListener("change", updateSectionsAndTabs);
            }
        });
    </script>





    <style>
        .nav-link.highlight {
            color: #287F71 !important;
            transition: background-color 0.5s ease;
        }
    </style>

    {{-- <script>
    // Convert Laravel data into a JavaScript-friendly format
    const jenisPelanggaranData = @json($jenisPelanggaran->groupBy('alasan_penindakan'));

    document.getElementById('alasan_penindakan').addEventListener('change', function() {
        const selectedAlasan = this.value;
        const jenisPelanggaranInput = document.getElementById('jenis_pelanggaran');

        // Auto-fill the corresponding Jenis Pelanggaran
        if (jenisPelanggaranData[selectedAlasan]) {
            // Assuming each alasan_penindakan only has one jenis_pelanggaran
            const jenisPelanggaran = jenisPelanggaranData[selectedAlasan][0].jenis_pelanggaran;
            jenisPelanggaranInput.value = jenisPelanggaran;
        } else {
            // Clear the field if no matching jenis_pelanggaran is found
            jenisPelanggaranInput.value = '';
        }
    });
</script> --}}


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
@endsection

@section('script')
    @vite(['resources/js/pages/datatable.init.js'])
@endsection
