@extends('layouts.vertical', ['title' => 'Rekam Pra-penindakan'])

@section('css')
    @vite(['node_modules/datatables.net-bs5/css/dataTables.bootstrap5.min.css', 'node_modules/datatables.net-buttons-bs5/css/buttons.bootstrap5.min.css', 'node_modules/datatables.net-keytable-bs5/css/keyTable.bootstrap5.min.css', 'node_modules/datatables.net-responsive-bs5/css/responsive.bootstrap5.min.css', 'node_modules/datatables.net-select-bs5/css/select.bootstrap5.min.css'])
@endsection
@section('content')
    <div class="container-fluid">
        <form action="{{ route('pra-penindakan.store') }}" method="POST">
            @csrf
            <div class="card mb-3 mt-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="card-title mb-0">
                        <i data-feather="book" style="width: 20px; height: 20px;" class="me-1"></i>
                        Form Rekam Data Pra-Penindakan
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
                                            <input type="hidden" id="id_pra_penindakan" name="id_pra_penindakan"
                                                value="">
                                            <input type="hidden" class="form-control bg-primary text-white"
                                                name="id_pengawasan_ref" value="{{ $no_laporan }}" readonly>
                                            <div class="text-center mb-4">
                                                <h5 class="fw-bold">Laporan Informasi</h5>
                                                <div class="input-group flex-wrap">
                                                    <span class="input-group-text">NO : LI-</span>
                                                    <input type="text" class="form-control" name="no_li"
                                                        id="no_li" value="{{ old('no_li', $no_ref->no_li) }}"
                                                        readonly>
                                                    <input type="date" class="form-control" name="tgl_li">
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
                                                                        placeholder="Isi Sumber Media Informasi">
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
                                                                    <textarea class="form-control" rows="6" id="isi_informasi" name="isi_informasi" placeholder="Isi Informasi"></textarea>
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
                                                                    <textarea class="form-control" rows="4" id="catatan" name="catatan" placeholder="Isi Catatan"></textarea>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row mb-5">
                                                <div class="col-6">
                                                    <!-- Left side - blank -->
                                                </div>
                                                <div class="col-6 text-center">
                                                    <p>Batam,.........................</p>
                                                    <hr>
                                                    <select class="form-select select2 mb-3" id="id_pejabat_li_1"
                                                        name="id_pejabat_li_1">
                                                        <option value="" selected disabled>- Pilih Pejabat Pelaksana
                                                            Penindakan -</option>
                                                        @foreach ($users as $user)
                                                            <option value="{{ $user->id_admin }}">{{ $user->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="row mb-3">
                                                <div class="col-6 text-center">
                                                    <select class="form-select select2 mb-3" id="id_pejabat_li_2"
                                                        name="id_pejabat_li_2">
                                                        <option value="" selected disabled>- Pilih Pejabat Penerbit
                                                            Laporan Informasi -</option>
                                                        @foreach ($users as $user)
                                                            <option value="{{ $user->id_admin }}">{{ $user->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-6 text-center">
                                                    <select class="form-select select2 mb-3" id="id_pejabat_li_3"
                                                        name="id_pejabat_li_3">
                                                        <option value="" selected disabled>- Pilih Pengampu Pejabat
                                                            Penerbit Lembar Informasi -</option>
                                                        @foreach ($users as $user)
                                                            <option value="{{ $user->id_admin }}">{{ $user->name }}
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
                                                                    name="no_lap"
                                                                    value="{{ old('no_lap', $no_ref->no_lap) }}" readonly>
                                                                <input type="date" class="form-control"
                                                                    name="tgl_lap">
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-3 text-start">Sumber Informasi</div>
                                                            <div class="col-md-9 text-start">
                                                                <input type="text" class="form-control"
                                                                    placeholder="NHI/LI-1/Info lain">
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
                                                                            name="pelaku" id="pelaku_ya" value="YA">
                                                                        <label class="form-check-label"
                                                                            for="pelaku_ya">Diketahui</label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-2">
                                                                    <div class="form-check form-check-inline">
                                                                        <input class="form-check-input" type="radio"
                                                                            name="pelaku" id="pelaku_tidak"
                                                                            value="TIDAK" checked>
                                                                        <label class="form-check-label"
                                                                            for="pelaku_tidak">Tidak Diketahui</label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-8">
                                                                    <textarea type="text" class="form-control form-input" name="keterangan_pelaku" placeholder="Keterangan pelaku"
                                                                        rows="1">{{ $laporan->perkiraan_pelaku_pelanggaran_lpt }}</textarea>
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
                                                                            value="YA">
                                                                        <label class="form-check-label"
                                                                            for="dugaan_ya">Diketahui</label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-2">
                                                                    <div class="form-check form-check-inline">
                                                                        <input class="form-check-input" type="radio"
                                                                            name="dugaan_pelanggaran" id="dugaan_tidak"
                                                                            value="TIDAK" checked>
                                                                        <label class="form-check-label"
                                                                            for="dugaan_tidak">Tidak Diketahui</label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-8">
                                                                    <input type="text" class="form-control"
                                                                        name="keterangan_dugaan_pelanggaran"
                                                                        value="{{ $laporan->jenis_pelanggaran_lpt }}"
                                                                        placeholder=" Keterangan Dugaan Pelanggaran">
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
                                                                            name="locus" id="locus_ya" value="YA">
                                                                        <label class="form-check-label"
                                                                            for="locus_ya">Diketahui</label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-2">
                                                                    <div class="form-check form-check-inline">
                                                                        <input class="form-check-input" type="radio"
                                                                            name="locus" id="locus_tidak"
                                                                            value="TIDAK" checked>
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
                                                                                {{ $laporan->perkiraan_tempat_pelanggaran_lpt == $locus->locus ? 'selected' : '' }}>
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
                                                                            name="tempus" id="tempus_ya" value="YA">
                                                                        <label class="form-check-label"
                                                                            for="tempus_ya">Diketahui</label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-2">
                                                                    <div class="form-check form-check-inline">
                                                                        <input class="form-check-input" type="radio"
                                                                            name="tempus" id="tempus_tidak"
                                                                            value="TIDAK" checked>
                                                                        <label class="form-check-label"
                                                                            for="tempus_tidak">Tidak Diketahui</label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <input type="text" class="form-control"
                                                                        name="keterangan_tempus" id="datetime-datepicker"
                                                                        placeholder="Mulainya Pra Penindakan">
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <input type="text" class="form-control"
                                                                        name="berakhirnya_tempus" id="datetime-datepicker"
                                                                        placeholder="Berakhirnya Pra Penindakan">
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
                                                                            value="Kewenangan DJBC">
                                                                        <label class="form-check-label"
                                                                            for="prosedural_djbc">Kewenangan DJBC</label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class="form-check form-check-inline">
                                                                        <input class="form-check-input" type="radio"
                                                                            name="prosedural" id="prosedural_bukan"
                                                                            value="Bukan" checked>
                                                                        <label class="form-check-label"
                                                                            for="prosedural_bukan">Bukan</label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <textarea type="text" class="form-control form-input" name="ket_prosedural" placeholder="Keterangan Prosedural"
                                                                        rows="1"></textarea>
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
                                                                            value="TERSEDIA">
                                                                        <label class="form-check-label"
                                                                            for="sdm_tersedia">Tersedia</label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class="form-check form-check-inline">
                                                                        <input class="form-check-input" type="radio"
                                                                            name="sdm" id="sdm_tidak" value="TIDAK"
                                                                            checked>
                                                                        <label class="form-check-label"
                                                                            for="sdm_tidak">Tidak</label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <textarea type="text" class="form-control form-input" name="ket_sdm" placeholder="Keterangan SDM"
                                                                        rows="1"></textarea>
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
                                                                            value="TERSEDIA">
                                                                        <label class="form-check-label"
                                                                            for="sarana_tersedia">Tersedia</label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class="form-check form-check-inline">
                                                                        <input class="form-check-input" type="radio"
                                                                            name="sarana_prasarana" id="sarana_tidak"
                                                                            value="TIDAK" checked>
                                                                        <label class="form-check-label"
                                                                            for="sarana_tidak">Tidak</label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <textarea type="text" class="form-control form-input" name="ket_sarana_prasarana"
                                                                        placeholder="Keterangan Sarana Prasarana" rows="1"></textarea>
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
                                                                            value="TERSEDIA">
                                                                        <label class="form-check-label"
                                                                            for="anggaran_tersedia">Tersedia</label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class="form-check form-check-inline">
                                                                        <input class="form-check-input" type="radio"
                                                                            name="anggaran" id="anggaran_tidak"
                                                                            value="TIDAK" checked>
                                                                        <label class="form-check-label"
                                                                            for="anggaran_tidak">Tidak</label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <textarea type="text" class="form-control form-input" name="ket_anggaran" placeholder="Keterangan Anggaran"
                                                                        rows="1"></textarea>
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
                                                                        <option value="penindakan">Layak Dilakukan Operasi
                                                                            Penindakan</option>
                                                                        <option value="patroli">Layak Dilakukan Patroli
                                                                        </option>
                                                                        <option value="tidak_layak">Tidak Layak Dilakukan
                                                                            Operasi atau Patroli</option>
                                                                    </select>
                                                                </div>
                                                            </div>

                                                            <!-- Bagian Layak Dilakukan Operasi Penindakan -->
                                                            <div id="penindakan_section" class="d-none">
                                                                <div class="row mb-3">
                                                                    <div class="col-md-3">
                                                                        <label class="form-label">Skema Penindakan:</label>
                                                                    </div>
                                                                    <div class="col-md-9">
                                                                        <select id="skema_penindakan"
                                                                            class="form-select mb-2"
                                                                            name="skem_layak_penindakan">
                                                                            <option value="MANDIRI">MANDIRI</option>
                                                                            <option value="PELIMPAHAN">PELIMPAHAN</option>
                                                                            <option value="BERSAMA">BERSAMA</option>
                                                                            <option value="DENGAN INSTANSI LAIN">DENGAN
                                                                                INSTANSI LAIN</option>
                                                                        </select>
                                                                        <textarea class="form-control" name="ket_layak_penindakan" placeholder="Keterangan Skema Penindakan" rows="1"></textarea>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <!-- Bagian Layak Dilakukan Patroli -->
                                                            <div id="patroli_section" class="d-none">
                                                                <div class="row mb-3">
                                                                    <div class="col-md-3">
                                                                        <label class="form-label">Skema Patroli:</label>
                                                                    </div>
                                                                    <div class="col-md-9">
                                                                        <select id="skema_patroli"
                                                                            class="form-select mb-2"
                                                                            name="skem_layak_patroli">
                                                                            <option value="MANDIRI">MANDIRI</option>
                                                                            <option value="PERBANTUAN">PERBANTUAN</option>
                                                                            <option value="TERKOORDINASI">TERKOORDINASI
                                                                            </option>
                                                                            <option value="DENGAN INSTANSI LAIN">DENGAN
                                                                                INSTANSI LAIN</option>
                                                                            <option value="LAINNYA">LAINNYA</option>
                                                                        </select>
                                                                        <textarea class="form-control" name="ket_layak_patroli" placeholder="Keterangan Skema Patroli" rows="1"></textarea>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <!-- Bagian Tidak Layak -->
                                                            <div id="tidak_layak_section" class="d-none">
                                                                <div class="row mb-3">
                                                                    <div class="col-md-3">
                                                                        <label class="form-label">Keterangan:</label>
                                                                    </div>
                                                                    <div class="col-md-9">
                                                                        <textarea class="form-control" name="ket_tidak_layak" placeholder="Keterangan Tidak Layak" rows="1"></textarea>
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
                                                                    <select id="kesimpulan_lap" name="kesimpulan_lap"
                                                                        class="form-control form-input"
                                                                        style="width: 100%">
                                                                        <option></option>
                                                                    </select>
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
                                                        <option value="" selected disabled>- Pilih Pejabat Pelaksana
                                                            Penindakan Penyusun LAP-</option>
                                                        @foreach ($users as $user)
                                                            <option value="{{ $user->id_admin }}">{{ $user->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="row mb-3">
                                                <div class="col-6 text-center">
                                                    <select class="form-select select2 mb-3" id="id_pejabat_lap_2"
                                                        name="id_pejabat_lap_2">
                                                        <option value="" selected disabled>- Pilih Pejabat Penerbit
                                                            LAP -</option>
                                                        @foreach ($users as $user)
                                                            <option value="{{ $user->id_admin }}">{{ $user->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-6 text-center">
                                                    <select class="form-select select2 mb-3" id="id_pejabat_lap_3"
                                                        name="id_pejabat_lap_3">
                                                        <option value="" selected disabled>- Pilih Pengampu Pejabat
                                                            Penerbit LAP -</option>
                                                        @foreach ($users as $user)
                                                            <option value="{{ $user->id_admin }}">{{ $user->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
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
                                                <p class="mb-0">Nomor : MPP - <input type="text"
                                                        class="border-0 border-bottom text-center" style="width: 150px;"
                                                        name="no_mpp" value="{{ old('no_mpp', $no_ref->no_mpp) }}"
                                                        readonly>KPU.206/<input type="date"
                                                        class="border-0 border-bottom text-center" style="width: 150px;"
                                                        name="tgl_mpp"></p>
                                            </div>

                                            <!-- Form Isian -->
                                            <!-- Kepada -->
                                            <div class="row mb-3">
                                                <div class="col-12 mb-1">Kepada :</div>
                                                <div class="col-12">
                                                    <div class="d-flex align-items-center">
                                                        <label for="yth_mpp" class="form-label mb-0 me-2">Yth.</label>
                                                        <input type="text" class="form-control border-0 border-bottom"
                                                            id="yth_mpp" name="yth_mpp"
                                                            placeholder="................................................................................">
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
                                                                        <option value="" selected disabled>- Pilih -
                                                                        </option>
                                                                        @foreach ($jenis_pelanggaran as $pelanggaran)
                                                                            <option
                                                                                value="{{ $pelanggaran->alasan_penindakan }} ({{ $pelanggaran->jenis_pelanggaran }})"
                                                                                {{ old('dugaan_pelanggaran_mpp') == $pelanggaran->alasan_penindakan . ' (' . $pelanggaran->jenis_pelanggaran . ')' ? 'selected' : '' }}>
                                                                                {{ $pelanggaran->alasan_penindakan }}
                                                                                ({{ $pelanggaran->jenis_pelanggaran }})
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
                                                                        <option value="" disabled
                                                                            {{ old('modus_pelanggaran_lpt', $laporan->modus_pelanggaran_lpt) ? '' : 'selected' }}>
                                                                            - Pilih -</option>
                                                                        @foreach ($uraian_modus as $modus)
                                                                            <option value="{{ $modus->uraian_modus }}"
                                                                                {{ old('modus_pelanggaran_lpt', $laporan->modus_pelanggaran_lpt) == $modus->uraian_modus ? 'selected' : '' }}>
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
                                                                        <option value="" disabled
                                                                            {{ old('locus_pelanggaran_mpp', $laporan->perkiraan_tempat_pelanggaran_lpt) ? '' : 'selected' }}>
                                                                            - Pilih -</option>
                                                                        @foreach ($tempat as $locus)
                                                                            <option value="{{ $locus->locus }}"
                                                                                {{ old('locus_pelanggaran_mpp', $laporan->perkiraan_tempat_pelanggaran_lpt) == $locus->locus ? 'selected' : '' }}>
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
                                                                        value="{{ old('perkiraan_waktu_pelanggaran_lpt', $laporan->perkiraan_waktu_pelanggaran_lpt) }}">
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
                                                                        value="{{ old('perkiraan_pelaku_pelanggaran_lpt', $laporan->perkiraan_pelaku_pelanggaran_lpt) }}">
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td></td>
                                                                <td>No Identitas</td>
                                                                <td>:</td>
                                                                <td colspan="4">
                                                                    <input type="text"
                                                                        class="form-control border-0 border-bottom"
                                                                        name="noiden_mpp">
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td></td>
                                                                <td>Keterangan lainnya</td>
                                                                <td>:</td>
                                                                <td colspan="4">
                                                                    <textarea class="form-control border-0 border-bottom" name="keterangan_mpp" rows="1"></textarea>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>6</td>
                                                                <td>Komoditi Barang</td>
                                                                <td>:</td>
                                                                <td>
                                                                    <input type="text"
                                                                        class="form-control border-0 border-bottom"
                                                                        name="komoditi_mpp">
                                                                </td>
                                                                <td>Jumlah</td>
                                                                <td>:</td>
                                                                <td>
                                                                    <input type="text"
                                                                        class="form-control border-0 border-bottom"
                                                                        name="jumlah_barang_mpp">
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>7</td>
                                                                <td>Jenis Pengangkut</td>
                                                                <td>:</td>
                                                                <td>
                                                                    <input type="text"
                                                                        class="form-control border-0 border-bottom"
                                                                        name="jenis_pengangkut_mpp">
                                                                </td>
                                                                <td>No Regis</td>
                                                                <td>:</td>
                                                                <td>
                                                                    <input type="text"
                                                                        class="form-control border-0 border-bottom"
                                                                        name="noreg_mpp">
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>8</td>
                                                                <td>Peti Kemas/Kemasan</td>
                                                                <td>:</td>
                                                                <td>
                                                                    <input type="text"
                                                                        class="form-control border-0 border-bottom"
                                                                        name="kemasan_mpp">
                                                                </td>
                                                                <td>Ukuran</td>
                                                                <td>:</td>
                                                                <td>
                                                                    <input type="text"
                                                                        class="form-control border-0 border-bottom"
                                                                        name="ukuran_mpp">
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>9</td>
                                                                <td>Dokumen Terkait</td>
                                                                <td>:</td>
                                                                <td colspan="4">
                                                                    <textarea class="form-control border-0 border-bottom" name="dokterkait_mpp" rows="1"></textarea>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>10</td>
                                                                <td>Uraian Instruksi</td>
                                                                <td>:</td>
                                                                <td colspan="4">
                                                                    <textarea class="form-control border-0 border-bottom" name="uraian_mpp" rows="2"></textarea>
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>

                                            <!-- Penutup Surat -->
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
                                                        <option value="" selected disabled>- Pilih Pejabat Penerbit
                                                            MPP-</option>
                                                        @foreach ($users as $user)
                                                            <option value="{{ $user->id_admin }}">{{ $user->name }}
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
                                                    <hr>

                                                    <div class="row justify-content-center">
                                                        <div class="col-md-10">
                                                            <div class="text-center mb-4">
                                                                <h5 class="mb-0 fw-bold text-decoration-underline">NOTA
                                                                    PENGEMBALIAN INFORMASI</h5>
                                                                <p class="mb-0">Nomor : <input type="text"
                                                                        class="border-0 border-bottom text-center"
                                                                        style="width: 150px;" name="no_npi"
                                                                        value="{{ old('no_npi', $no_ref->no_npi) }}"
                                                                        readonly>KPU.206/<input type="date"
                                                                        class="border-0 border-bottom text-center"
                                                                        style="width: 150px;" name="tgl_npi"></p>
                                                            </div>

                                                            <div class="mb-3">
                                                                <div class="row">
                                                                    <div class="col-md-12">
                                                                        <p>Sumber informasi NHI/Informasi lain Nomor :
                                                                            <input type="text"
                                                                                class="border-0 border-bottom"
                                                                                style="width: 120px;"
                                                                                id="sumber_informasi_npi"
                                                                                name="sumber_npi">
                                                                        </p>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="mb-3">
                                                                <p class="text-justify">Bersama ini diberitahukan bahwa
                                                                    berdasarkan Analisis Prapenindakan yang telah dilakukan
                                                                    terhadap informasi dari Unit <input type="text"
                                                                        class="border-0 border-bottom"
                                                                        style="width: 150px;" id="unit_penerbit_informasi"
                                                                        name="unit_penerbit_npi">, dapat kami sampaikan
                                                                    atas informasi tersebut <span
                                                                        class="fw-bold fst-italic">tidak/belum*</span>
                                                                    dapat dilakukan Penindakan lebih lanjut dengan alasan
                                                                    sebagai berikut:</p>
                                                            </div>

                                                            <div class="mb-4">
                                                                <select class="form-select mb-2 select2"
                                                                    name="kategori_npi">
                                                                    <option value="" selected disabled>- Pilih
                                                                        Kategori Penindakan -</option>
                                                                    @foreach ($kapen as $kategori)
                                                                        <option value="{{ $kategori->jenis_penindakan }}">
                                                                            {{ $kategori->jenis_penindakan }}
                                                                        </option>
                                                                    @endforeach
                                                                </select>
                                                                <textarea class="form-control" rows="3" id="alasan_penindakan_npi" name="alasan_npi"
                                                                    placeholder="Alasan Tidak Dapat Dilakukan Penindakan Lebih Lanjut"></textarea>
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
                                                                        <option value="" selected disabled>- Pilih
                                                                            Pejabat -</option>
                                                                        @foreach ($users as $user)
                                                                            <option value="{{ $user->id_admin }}">
                                                                                {{ $user->name }}</option>
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


                                        <div class="container my-4 tab-pane" id="navtabs2-settings" role="tabpanel">
                                            <!-- Header Surat -->
                                            <div class="row mb-4 align-items-center">
                                                <div class="col-2 text-center">
                                                    <img src="/images/logocop.png" alt="Logo" class="img-fluid"
                                                        style="max-height:170px;">
                                                </div>
                                                <div class="col-10 text-center">
                                                    <h5 class="mb-0 fw-bold">KEMENTERIAN KEUANGAN REPUBLIK
                                                        INDONESIA</h5>
                                                    <p class="small mb-0">DIREKTORAT JENDERAL BEA DAN CUKAI</p>
                                                    <p class="small mb-0">KANTOR PELAYANAN UTAMA BEA DAN CUKAI TIPE
                                                        B BATAM</p>
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

                                            <div class="border-top border-dark border-1 mb-3"></div>

                                            <!-- Pilihan Tipe Surat -->
                                            <div class="mb-3">
                                                <label class="form-label">Tipe Surat Perintah</label>
                                                <select class="form-control form-select select2"
                                                    id="tipe_surat_perintah_pra_penindakan"
                                                    name="tipe_surat_perintah_pra_penindakan">
                                                    <option value="" selected disabled>- Pilih -</option>
                                                    <option value="Surat Perintah NHI">Surat Perintah NHI</option>
                                                    <option value="Surat Perintah OC">Surat Perintah OC</option>
                                                    <option value="Surat Perintah Patroli Laut">Surat Perintah Patroli Laut
                                                    </option>
                                                    <option value="Surat Perintah Bulanan">Surat Perintah Bulanan</option>
                                                </select>
                                            </div>

                                            <!-- Judul Surat -->
                                            <div class="row mb-4">
                                                <div class="col-12 text-center">
                                                    <h5 class="fw-bold">SURAT PERINTAH</h5>
                                                    <div class="d-flex justify-content-center align-items-center">
                                                        <span>Nomor PRIN- </span>
                                                        <input type="text" class="form-control form-control-sm mx-2"
                                                            style="width: 50px;" name="no_print" value="001" readonly>
                                                        <span>/</span>
                                                        <span>KPU.206</span>
                                                        <span>/</span>
                                                        <input type="date" class="form-control form-control-sm mx-2"
                                                            style="width: 110px;" name="tgl_print">
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Isi Surat -->
                                            <!-- Bagian Menimbang -->
                                            <div class="row">
                                                <div class="col-2 fw-bold">Menimbang</div>
                                                <div class="col-1 text-center">:</div>
                                                <div class="col-9">
                                                    <div id="content-menimbang" class="content-section">
                                                        <p class="text-muted">Pilih tipe surat perintah untuk melihat
                                                            konten</p>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Bagian Dasar -->
                                            <div class="row mt-3">
                                                <div class="col-2 fw-bold">Dasar</div>
                                                <div class="col-1 text-center">:</div>
                                                <div class="col-9">
                                                    <div id="content-dasar" class="content-section">
                                                        <p class="text-muted">Pilih tipe surat perintah untuk melihat
                                                            konten</p>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row mt-4 text-center">
                                                <div class="col-12">
                                                    <h6 class="fw-bold">Memberi Perintah:</h6>
                                                </div>
                                            </div>

                                            <!-- Bagian Kepada (Tidak berubah) -->
                                            <div class="row mt-3">
                                                <div class="col-2 fw-bold">Kepada</div>
                                                <div class="col-1 text-center">:</div>
                                                <div class="col-9">
                                                    <div class="mb-3">
                                                        <select class="form-select select2" id="id_pejabat_sp_1"
                                                            name="id_pejabat_sp_1[]" multiple>
                                                            @foreach ($users as $user)
                                                                <option value="{{ $user->id_admin }}">
                                                                    {{ $user->name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Bagian Untuk -->
                                            <div class="row mt-3">
                                                <div class="col-2 fw-bold">Untuk</div>
                                                <div class="col-1 text-center">:</div>
                                                <div class="col-9">
                                                    <div id="content-untuk" class="content-section">
                                                        <p class="text-muted">Pilih tipe surat perintah untuk melihat
                                                            konten</p>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Bagian Wilayah (Tidak berubah) -->
                                            <div class="row mt-3">
                                                <div class="col-2 fw-bold">Wilayah</div>
                                                <div class="col-1 text-center">:</div>
                                                <div class="col-9">
                                                    <input type="text" class="form-control" name="wilayah"
                                                        placeholder="Wilayah">
                                                </div>
                                            </div>

                                            <!-- Bagian Waktu (Tidak berubah) -->
                                            <div class="row mt-3">
                                                <div class="col-2 fw-bold">Waktu</div>
                                                <div class="col-1 text-center">:</div>
                                                <div class="col-9">
                                                    <div class="d-flex align-items-center">
                                                        <span>Berlaku mulai tanggal</span>
                                                        <input type="date" class="form-control mx-2"
                                                            name="tanggal_mulai_print" style="width: 170px;">
                                                        <span>s.d</span>
                                                        <input type="date" class="form-control mx-2"
                                                            id="tanggal_berakhir_print" name="tanggal_berakhir_print"
                                                            style="width: 170px;">
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Bagian Ketentuan -->
                                            <div class="row mt-3">
                                                <div class="col-2 fw-bold">Ketentuan</div>
                                                <div class="col-1 text-center">:</div>
                                                <div class="col-9">
                                                    <div id="content-ketentuan" class="content-section">
                                                        <p class="text-muted">Pilih tipe surat perintah untuk melihat
                                                            konten</p>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Bagian Tambahan di bawah Ketentuan -->
                                            <div class="row mt-3">
                                                <div class="col-12">
                                                    <div id="content-tambahan" class="content-section">
                                                        <p class="text-muted">Pilih tipe surat perintah untuk melihat
                                                            konten</p>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Bagian Penandatangan (Tidak berubah) -->
                                            <div class="row mt-4">
                                                <div class="col-6"></div>
                                                <div class="col-6 text-center">
                                                    <div class="d-flex flex-column">
                                                        <div>
                                                            <select class="form-control form-select mb-2" id="plh"
                                                                name="plh">
                                                                <option value="" selected disabled>- Pilih Plh -
                                                                </option>
                                                                <option value="Plh">Pelaksana Harian</option>
                                                                <option value="">Tidak Ada Pelaksana Harian</option>
                                                            </select>
                                                        </div>
                                                        <select class="form-control form-select mb-3" id="id_pejabat_sp_2"
                                                            name="id_pejabat_sp_2">
                                                            <option value="" selected disabled>- Pilih Pejabat Yang
                                                                Menandatangani -</option>
                                                            <option value="1">Kepala Kantor</option>
                                                            <option value="2">Wakil Kepala Kantor</option>
                                                        </select>
                                                        <p class="mb-0">NIP. ..............................</p>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Bagian Tembusan (Tidak berubah) -->
                                            <div class="row mt-4">
                                                <div class="col-12">
                                                    <p class="fw-bold">Tembusan:</p>
                                                    <p>..............................</p>
                                                </div>
                                            </div>

                                            <!-- Form Pengaturan Tambahan (Tidak berubah) -->
                                            <div class="row mt-5 pt-5 border-top">
                                                <div class="col-lg-6">
                                                    <h6><b>Data Input Tambahan</b></h6>
                                                    <div class="mb-3">
                                                        <label class="form-label">Penentuan Skema Penindakan</label>
                                                        <select class="form-control form-select"
                                                            name="skema_penindakan_perintah">
                                                            <option value="" selected disabled>- Pilih -</option>
                                                            <option value="MANDIRI">Mandiri</option>
                                                            <option value="Perbantuan">Perbantuan</option>
                                                            <option value="Perbantuan/Bersama Instansi Lain">
                                                                Perbantuan/Bersama Instansi Lain</option>
                                                        </select>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label">Dilakukannya Patroli</label>
                                                        <select class="form-control form-select"
                                                            name="dilakukannya_patroli">
                                                            <option value="" selected disabled>- Pilih -</option>
                                                            <option value="YA">YA</option>
                                                            <option value="TIDAK">TIDAK</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="card-footer d-flex justify-content-end">
                                            <button type="submit" class="btn btn-success btn-sm me-2">
                                                <i data-feather="save"></i> Simpan Data LI
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
        document.addEventListener("DOMContentLoaded", function() {
            const selectKegiatan = document.getElementById("pilihan_kegiatan");
            const skemaPenindakan = document.getElementById("skema_penindakan");
            const skemaPatroli = document.getElementById("skema_patroli");

            function updateTabs() {
                const kegiatan = selectKegiatan.value;
                const skemaP = skemaPenindakan.value;
                const skemaPat = skemaPatroli.value;

                // Sembunyikan semua section dulu
                document.getElementById("penindakan_section").classList.add("d-none");
                document.getElementById("patroli_section").classList.add("d-none");
                document.getElementById("tidak_layak_section").classList.add("d-none");

                if (kegiatan === "penindakan") {
                    document.getElementById("penindakan_section").classList.remove("d-none");
                } else if (kegiatan === "patroli") {
                    document.getElementById("patroli_section").classList.remove("d-none");
                } else if (kegiatan === "tidak_layak") {
                    document.getElementById("tidak_layak_section").classList.remove("d-none");
                }

                // Atur tab
                const tabsConfig = [{
                        id: "navtabs2-messages-tab-item",
                        linkId: "navtabs2-messages-tab",
                        condition: kegiatan === "tidak_layak",
                    },
                    {
                        id: "navtabs2-mpp-tab-item",
                        linkId: "navtabs2-mpp-tab",
                        condition: (kegiatan === "penindakan" && skemaP === "PELIMPAHAN") ||
                            (kegiatan === "patroli" && skemaPat === "PELIMPAHAN"),
                    },
                    {
                        id: "navtabs2-settings-tab-item",
                        linkId: "navtabs2-settings-tab",
                        condition: kegiatan === "penindakan" || kegiatan === "patroli",
                    },
                ];

                tabsConfig.forEach(({
                    id,
                    linkId,
                    condition
                }) => {
                    const tabElement = document.getElementById(id);
                    const tabLinkElement = document.getElementById(linkId);

                    if (tabElement) {
                        tabElement.style.display = condition ? "block" : "none";

                        if (tabLinkElement && condition) {
                            tabLinkElement.classList.add("highlight");
                            setTimeout(() => tabLinkElement.classList.remove("highlight"), 1000);
                        }
                    }
                });
            }

            selectKegiatan.addEventListener("change", updateTabs);
            skemaPenindakan.addEventListener("change", updateTabs);
            skemaPatroli.addEventListener("change", updateTabs);

            // Reset semua section dan tab saat load
            document.getElementById("penindakan_section").classList.add("d-none");
            document.getElementById("patroli_section").classList.add("d-none");
            document.getElementById("tidak_layak_section").classList.add("d-none");

            ["navtabs2-messages", "navtabs2-mpp", "navtabs2-settings"].forEach((id) => {
                const tabElement = document.getElementById(id);
                if (tabElement) tabElement.classList.remove("active", "show");
            });

            updateTabs();
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

    {{-- <script>
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
    </script> --}}

    <script>
        // Definisikan data konten di luar event listener
        const kontenSurat = {
            'Surat Perintah NHI': {
                menimbang: `
                Guna mengamankan hak-hak negara dan agar dipatuhinya ketentuan
                perundang-undangan yang berlaku, dipandang perlu untuk menugaskan
                pegawai.
        `,
                dasar: `
            <ol>
            <li>Undang-Undang Nomor 10 Tahun 1995 tentang Kepabeanan (Lembar Negara Tahun 1995 Nomor 75, Tambahan Lembaran Negara Republik Indonesia Nomor 3612);</li>
            <li>Peraturan Pemerintah Nomor 21 Tahun 1996 tentang Penindakan di Bidang Kepabeanan (Lembaran Negara Tahun 1996 Nomor 36, Tambahan Lembaran Negara Republik Indonesia Nomor 3626);</li>
            <li>Keputusan Menteri Keuangan Republik Indonesia Nomor: 30/KMK.05/1997 tentang Tata Laksana Penindakan di Bidang Kepabeanan;</li>
            <li>Keputusan Direktur Jenderal Bea dan Cukai Nomor: KEP-08/BC/1997 tanggal 30 Januari 1997 tentang Penghentian, Pemeriksaan dan Penegahan Sarana Pengangkut dan Barang Diatasnya serta Penghentian Pembongkaran dan Penegahan Barang;</li>
            <li>Keputusan Menteri Keuangan Republik Indonesia Nomor: 759/KMK.01/1993 tanggal 3 Agustus 1993 tentang Organisasi dan Tata Kerja Direktorat Jenderal Bea dan Cukai;</li>
            <li>Instruksi Menteri Keuangan Republik Indonesia Nomor INS01/MK/III/2/1976 tentang Pemberantasan Penyelundupan;</li>
            </ol>

        `,
                untuk: `
                <ol>
  <li>
    Melakukan pembukaan segel tindak pengamanan, melakukan penegahan dan penyegelan terhadap party barang dengan data sebagai berikut:
    <table class="table-borderless" style="margin-left: 10px; margin-top: 8px; width: 100%;">
      <tr>
        <td style="width: 30%; vertical-align: top;"><strong>Nama Perusahaan</strong></td>
        <td style="width: 2%; vertical-align: top;">:</td>
        <td>
          <input type="text" name="nama_perusahaan" class="form-control" placeholder="Masukkan nama perusahaan" required>
        </td>
      </tr>
      <tr>
        <td style="vertical-align: top;"><strong>Jenis/ No dan Tgl. Dokumen</strong></td>
        <td style="vertical-align: top;">:</td>
        <td>
          <input type="text" name="jenis_dokumen" class="form-control" placeholder="Contoh: PPFTZ-01 Nomor 660733 Tanggal 18 Oktober 2024" required>
        </td>
      </tr>
      <tr>
        <td style="vertical-align: top;"><strong>Jumlah dan Jenis Barang</strong></td>
        <td style="vertical-align: top;">:</td>
        <td>
          <textarea name="jumlah_jenis_barang" class="form-control" rows="4" placeholder="Contoh:
- 668 Vacuum Sealer Merek Harvest Keeper;
- 4800 Sarung Tangan/Smooth Nitrile Gloves merek Growers Edge;
- 1152 Paper/Ink Ribbon set merek Mitsubishi Electric (item 4)." required></textarea>
        </td>
      </tr>
      <tr>
        <td style="vertical-align: top;"><strong>Tempat/ Lokasi Penindakan</strong></td>
        <td style="vertical-align: top;">:</td>
        <td>
          <input type="text" name="lokasi_penindakan" class="form-control" placeholder="Masukkan lokasi penindakan" required>
        </td>
      </tr>
    </table>
  </li>
  <li style="margin-top: 10px;">
    Mengambil tindakan yang diperlukan dalam upaya pengamanan hak-hak negara dan pencegahan pelanggaran ketentuan perundang-undangan yang berlaku.
  </li>
</ol>
        `,
                ketentuan: `
            <ol>
            <li>Menggunakan sarana peralatan pemeriksaan fisik;</li>
            <li>Berpakaian PDH/Non PDH;</li>
            <li>Membuat laporan selambat-lambatnya 3 (tiga) hari sejak selesainya pelaksanaan tugas.</li>
            </ol>
        `,
                tambahan: `
            <p class="hidden"></p>
        `
            },
            'Surat Perintah OC': {
                menimbang: `
            <ol type="a">
            <li>Bahwa adanya indikasi terjadinya pelanggaran di bidang cukai yang berkaitan pada wilayah kerja dan/atau daerah wewenang Kantor Pelayanan Utama Bea dan Cukai Tipe B Batam, dipandang perlu memperpanjang periode Tim Operasi Pengawasan di bidang Cukai (Gempur II) Tahun 2024;</li>
            <li>Bahwa dalam rangka optimalisasi penerimaan di bidang cukai, diperlukan peningkatan pengawasan terhadap barang kena cukai, sehingga dipandang perlu segera melakukan langkah-langkah dan upaya nyata untuk melakukan penindakan terhadap pelanggaran ketentuan di bidang cukai;</li>
            <li>Bahwa peningkatan pengawasan bertujuan untuk meningkatkan kepatuhan pengusahaan barang kena cukai dan menekan peredaran barang kena cukai ilegal, sehingga memberikan situasi kondusif terhadap peredaran barang kena cukai yang telah memenuhi ketentuan di bidang cukai;</li>
            <li>Bahwa untuk menjaga rutinitas pelaksanaan operasi pengawasan yang telah dilakukan sebelumnya, dipandang perlu untuk melanjutkan dan meningkatkan operasi pengawasan di bidang cukai terhadap seluruh barang kena cukai;</li>
            <li>Bahwa berdasarkan pertimbangan sebagaimana dimaksud dalam huruf a, b, c, dan d di atas, perlu diterbitkan Surat Perintah Kepala Kantor Pelayanan Utama Bea dan Cukai Tipe B Batam untuk melakukan operasi pengawasan di bidang cukai tahun 2024 dengan call sign “Gempur II”;</li>
            </ol>
        `,
                dasar: `
            <ol>
                <li>Undang-Undang Nomor 11 Tahun 1995 tentang Cukai (Lembaran
                Negara Republik Indonesia Tahun 1996 Nomor 76, Tambahan
                Lembaran Negara Republik Indonesia Nomor 3613) sebagaimana telah
                dirubah dengan Undang-Undang Nomor 39 Tahun 2007 tentang
                Perubahan atas Undang-Undang Nomor 11 Tahun 1995 tentang Cukai
                (Lembaran Negara Republik Indonesia Tahun 2007 Nomor 105,
                Tambahan Lembaran Negara Nomor 4755) dan Peraturan-Peraturan
                Pelaksanaannya;</li>
            </ol>
        `,
                untuk: `
                        <ol>
            <li>Melakukan pengawasan secara mendalam terhadap kegiatan produksi, pengangkutan, dan peredaran Barang Kena Cukai (BKC) di wilayah administrasi pengawasan Kantor Pelayanan Utama Bea dan Cukai Tipe B Batam, baik yang berasal dari produksi dalam negeri maupun impor guna mencegah terjadinya pelanggaran di bidang cukai, yaitu:
                <ol type="a">
                <li>Pabrik, Tempat Penyimpanan atau tempat lainnya yang digunakan untuk menyimpan BKC atau barang lainnya terkait dengan BKC yang belum dilunasi cukainya, tempat usaha importir, gudang penyalur atau tempat penjualan eceran BKC tanpa NPPBKC;</li>
                <li>Produksi, distribusi dan peredaran BKC yang pelunasannya dengan pelekatan pita cukai dengan modus pelanggaran:
                    <ol type="1">
                    <li>tanpa dilekati pita cukai;</li>
                    <li>dilekati pita cukai palsu;</li>
                    <li>dilekati pita cukai bekas pakai;</li>
                    <li>dilekati pita cukai yang bukan haknya; atau</li>
                    <li>dilekati pita cukai yang tidak sesuai peruntukannya;</li>
                    </ol>
                </li>
                <li>Peredaran/perdagangan pita cukai secara illegal;</li>
                <li>Pelanggaran lainnya di bidang cukai;</li>
                </ol>
            </li>
            <li>Melakukan pengawasan secara mendalam terhadap seluruh kegiatan administrasi dan sistem pelayanan cukai, serta kegiatan-kegiatan lainnya yang terkait dengan pelayanan di bidang cukai;</li>
            <li>Melakukan penindakan di bidang cukai terhadap orang, sarana pengangkut, barang, bangunan, tempat penimbunan dan tempat lainnya serta hal-hal yang terkait dengan pelanggaran ketentuan dan/atau tindak pidana di bidang cukai;</li>
            <li>Melakukan tindakan lainnya dan mengambil langkah-langkah sesuai peraturan perundangan yang berlaku guna mengamankan hak-hak negara, apabila dalam pelaksanaan tugas ditemukan adanya dugaan pelanggaran ketentuan dan/atau tindak pidana di bidang cukai;</li>
            <li>Melakukan koordinasi antar unit pengawasan pada satuan kerja vertikal DJBC yang meliputi Kantor Wilayah DJBC, Kantor Wilayah DJBC Khusus, KPU BC, KPPBC Tipe Madya Pabean/ Madya Pabean A/ Madya Pabean B/ Madya Pabean C dan/atau KPPBC Tipe Madya Cukai setempat apabila dipandang perlu dalam melakukan semua kegiatan tersebut di atas;</li>
            <li>Melakukan pembinaan dan bimbingan (asistensi) serta penyuluhan atau sosialisasi terkait ketentuan peraturan perundang-undangan di bidang cukai;</li>
            <li>Melaksanakan tugas ini dengan penuh rasa tanggung jawab dan melaporkan pelaksanaannya kepada Kepala Bidang Penindakan dan Penyidikan KPU BC Tipe B Batam secara periodik atau sewaktu-waktu apabila diperlukan.</li>
            </ol>
        `,
                ketentuan: `
            <ol>
                <li>Menggunakan sarana peralatan pemeriksaan fisik;</li>
                <li>Berpakaian PDH/ Non PDH;</li>
                <li>Membuat laporan selambat-lambatnya 3 (tiga) hari sejak selesainya pelaksanaan tugas.</li>
            </ol>
        `,
                tambahan: `
            <p style="text-align: justify;">
            &nbsp;&nbsp;&nbsp;Biaya yang digunakan untuk pelaksanaan operasi pengawasan ini dibebankan pada DIPA Kantor Pelayanan Utama Bea dan Cukai Tipe B Batam.
            </p>
            <p style="text-align: justify;">
            &nbsp;&nbsp;&nbsp;Kepada pihak berwajib/berwenang/terkait, sesuai dengan ketentuan dalam Pasal 34 Undang-Undang Nomor 39 Tahun 2007 tentang perubahan atas Undang-Undang Nomor 11 Tahun 1995 tentang Cukai, diminta bantuan seperlunya demi kelancaran pelaksanaan tugas tersebut.
            </p>
            <p style="text-align: justify; margin-top: 1em;">
            <em><strong>&nbsp;&nbsp;&nbsp;KPU BC Batam senantiasa berkomitmen menjaga kepentingan negara secara profesional,</strong> 
            bersinergi dengan seluruh pemangku kepentingan dengan 
            <span style="font-style: italic; font-weight: bold;">integritas</span>, 
            <span style="font-style: italic; font-weight: bold;">responsif</span> melayani, dan 
            <span style="font-style: italic; font-weight: bold;">berkinerja cemerlang</span>.
            </em>
            </p>

        `
            },
            'Surat Perintah Patroli Laut': {
                menimbang: `
            <ol type="a">
                <li>untuk mengamankan hak-hak negara dan agar dipatuhinya ketentuan perundang-undangan yang berlaku; dan </li>
                <li>Buntuk melaksanakan kegiatan pencegahan dan penindakan pelanggaran di bidang kepabeanan dan cukai, perlu melaksanakan Patroli Laut Bea dan Cukai;</li>
            </ol>
        `,
                dasar: `
            <ol>
            <li>Undang-Undang Nomor 10 Tahun 1995 tentang Kepabeanan (Lembaran Negara RI Tahun 1995 Nomor 75, Tambahan Lembaran Negara Nomor 3612) sebagaimana telah dirubah dengan Undang-Undang Nomor 17 Tahun 2006 tentang Perubahan atas Undang-Undang Nomor 10 Tahun 1995 tentang Kepabeanan (Lembaran Negara RI Tahun 2006 Nomor 93) dan Peraturan-Peraturan Pelaksanaannya;</li>
            <li>Undang-Undang Nomor 11 Tahun 1995 tentang Cukai (Lembaran Negara Republik Indonesia Tahun 1996 Nomor 76, Tambahan Lembaran Negara Nomor 3613) sebagaimana telah dirubah dengan Undang-Undang Nomor 39 Tahun 2007 tentang Perubahan atas Undang-Undang Nomor 11 Tahun 1995 tentang Cukai (Lembaran Negara Republik Indonesia Tahun 2007 Nomor 105, Tambahan Lembaran Negara Nomor 4755) dan Peraturan-Peraturan pelaksanaannya;</li>
            <li>Peraturan Pemerintah Nomor 21 Tahun 1996 tentang Penindakan Di Bidang Kepabeanan (Lembaran Negara Tahun 1996 Nomor 36, Tambahan Lembaran Negara Republik Indonesia Nomor 3626);</li>
            <li>Peraturan Pemerintah Nomor 49 Tahun 2009 tentang Tata Cara Penindakan di Bidang Cukai (Lembaran Negara Republik Indonesia Tahun 2009 Nomor 114, Tambahan Lembaran Negara Republik Indonesia Nomor 5040);</li>
            <li>Keputusan Menteri Keuangan Republik Indonesia Nomor: 30/KMK.05/1997 tentang Tata Laksana Penindakan Di Bidang Kepabeanan;</li>
            <li>Peraturan Menteri Keuangan Nomor 238/PMK.04/2009 tentang Tata Cara Penghentian, Pemeriksaan, Penegahan, Penyegelan, Tindakan Berupa Tidak Melayani Pemesanan Pita Cukai Atau Tanda Pelunasan Cukai Lainnya dan Bentuk Surat Perintah Penindakan;</li>
            <li>Peraturan Menteri Keuangan Nomor 179/PMK.04/2019 tentang Patroli Laut Direktorat Jenderal Bea dan Cukai Dalam Rangka Penindakan di Bidang Kepabeanan dan Cukai;</li>
            <li>Peraturan Direktur Jenderal Bea dan Cukai Nomor PER-21/BC/2023 tentang Petunjuk Pelaksanaan Patroli Laut Direktorat Jenderal Bea dan Cukai;</li>
            <li>Peraturan Direktur Jenderal Bea dan Cukai Nomor PER-8/BC/2024 tentang Tata Laksana Pengawasan Di Bidang Kepabeanan dan Cukai;</li>
        </ol>

        `,
                untuk: `
            <p>Melaksanakan Patroli Laut Bea dan Cukai</p>
        `,
                ketentuan: `
            <ol>
            <li>Berpakaian PDH / PDL / Pakaian dengan atribut Bea dan Cukai.</li>
            <li>Melaksanakan apel keberangkatan kapal patroli sesuai Peraturan Direktur Jenderal Bea dan Cukai Nomor PER-12/BC/2021.</li>
            <li>Pengendali Operasi adalah Kepala Bidang Penindakan dan Penyidikan KPUBC Tipe B Batam.</li>
            <li>Pengendali Taktis adalah Kepala Seksi Penindakan KPUBC Tipe B Batam.</li>
            <li>Rute ditentukan oleh Pengendali Taktis.</li>
            <li>Navigasi dan tata tertib di atas kapal tanggung jawab Nakhoda.</li>
            <li>Petugas dilengkapi dengan Senjata Api Dinas, penggunaan sesuai dengan ketentuan mengenai penggunaan Senjata Api Dinas di Lingkungan Direktorat Jenderal Bea dan Cukai.</li>
            <li>Penggunaan Senjata Mesin Berat (SMB) 12.7 mm oleh petugas sesuai dengan aturan yang berlaku.</li>
            <li>Mengutamakan keselamatan awak kapal dan kapal patroli.</li>
            <li>Memberi bantuan pencarian dan penyelamatan / Search and Rescue (SAR) jika dibutuhkan.</li>
            <li>Penjagaan di atas kapal secara terus menerus, diatur oleh Kopat / Nakhoda.</li>
            <li>Log book diisi secara tertib.</li>
            <li>Melapor kepada Kepala KWBC / KPUBC / KPPBC setempat apabila kapal patrol sandar dalam wilayah kerjanya.</li>
            <li>Radio kapal agar stand by selama 24 jam dan Radio Operator melaporkan posisi setiap 2 jam sekali atau pada kesempatan pertama.</li>
            <li>Agar perintah ini dilaksanakan dengan penuh rasa tanggung jawab.</li>
            <li>Segala biaya kebutuhan patroli dan pegawai PSO BC Batam dibebankan pada DIPA satuan kerja PSO Bea dan Cukai Tipe B Batam 2024.</li>
        </ol>
        `,
                tambahan: `
            <p style="text-align: justify;">
            &nbsp;&nbsp;&nbsp;Kepada yang berwajib/berwenang/terkait, sesuai dengan ketentuan dalam Pasal 76
            Undang-Undang Nomor 17 Tahun 2006 tentang Perubahan atas Undang-Undang Nomor 10
            Tahun 1995 tentang Kepabeanan dan Pasal 34 Undang-Undang Nomor 39 Tahun 2007 tentang
            Perubahan atas Undang-Undang Nomor 11 Tahun 1995 tentang Cukai, diminta bantuan
            seperlunya.
            </p>
            <p style="text-align: justify; margin-top: 1em;">
            <em><strong>&nbsp;&nbsp;&nbsp;KPU BC Batam senantiasa berkomitmen menjaga kepentingan negara secara profesional,</strong> 
            bersinergi dengan seluruh pemangku kepentingan dengan 
            <span style="font-style: italic; font-weight: bold;">integritas</span>, 
            <span style="font-style: italic; font-weight: bold;">responsif</span> melayani, dan 
            <span style="font-style: italic; font-weight: bold;">berkinerja cemerlang</span>.
            </em>
            </p>
        `
            },
            'Surat Perintah Bulanan': {
                menimbang: `
            Bahwa dalam rangka menjalankan tugas dan fungsi pengawasan pada
            Kantor Pelayanan Utama Bea dan Cukai Tipe B Batam dipandang perlu
            untuk mengatur penempatan dan penugasan (pemeriksa dan pelaksana)
            Seksi Penindakan Bidang Penindakan dan Penyidikan di wilayah kerja
            Kantor Pelayanan Utama Bea dan Cukai Tipe B Batam beserta ketentuan
            kerja lembur, pemakaian seragam, dan ketentuan lainnya sebagaimana
            tersebut dalam lampiran Surat Perintah ini;
        `,
                dasar: `
            <ol>
            <li>Undang – Undang Nomor 10 tahun 1995 tentang Kepabeanan (Lembar Tahun 1995 Nomor 75, Tambahan Lembaran Negara Republik Indonesia Nomor 3612) sebagaimana telah dirubah dengan Undang-Undang Nomor 17 Tahun 2006 tentang Perubahan atas Undang-Undang Nomor 10 Tahun 1995 tentang Kepabeanan (Lembaran Negara RI Tahun 2006 Nomor 93); sebagaimana telah diubah dengan Undang – Undang Nomor 17 Tahun 2006 dan peraturan pelaksanaanya;</li>
            <li>Undang-Undang Nomor 11 Tahun 1995 tentang Cukai (Lembaran Negara Republik Indonesia Tahun 1996 Nomor 76, Tambahan Lembaran Negara Republik Indonesia Nomor 3613) sebagaimana telah dirubah dengan Undang-Undang Nomor 39 Tahun 2007 tentang Perubahan atas Undang-Undang Nomor 11 Tahun 1995 tentang Cukai (Lembaran Negara Republik Indonesia Tahun 2007 Nomor 105, Tambahan Lembaran Negara Nomor 4755) dan Peraturan-Peraturan Pelaksanaannya;</li>
            <li>Peraturan Pemerintah Nomor 21 Tahun 1996 tentang Penindakan di Bidang Kepabeanan (Lembaran Negara Tahun 1996 Nomor 36, Tambahan Lembaran Negara Republik Indonesia Nomor 3626);</li>
            <li>Peraturan Pemerintah Nomor 49 Tahun 2009 tentang Penindakan di Bidang Cukai (Lembaran Negara Republik Indonesia Tahun 2009 Nomor 114, Tambahan Lembaran Negara Republik Indonesia Nomor 35040);</li>
            <li>Peraturan Pemerintah Nomor 41 Tahun 2021 tentang Penyelenggaraan Kawasan Perdagangan Bebas dan Pelabuhan Bebas (Lembaran Negara Republik Indonesia Tahun 2021 Nomor 51, Tambahan Lembaran Negara Republik Indonesia Nomor 6653);</li>
            <li>Peraturan Menteri Keuangan Nomor 34/PMK.04/2021 tentang Pemasukan dan Pengeluaran Barang Ke dan Dari Kawasan yang Telah Ditetapkan Sebagai Kawasan Perdagangan Bebas dan Pelabuhan Bebas;</li>
            <li>Peraturan Direktur Jenderal Bea dan Cukai nomor PER-8/BC/2024 tentang Tata Laksana Pengawasan di Bidang Kepabeanan dan Cukai;</li>
        </ol>
        `,
                untuk: `
            <ol>
            <li>Melakukan pemantauan dan pengawasan terhadap kegiatan kepabeanan dan/atau cukai serta kegiatan-kegiatan lainnya yang terkait dengan kegiatan kepabeanan dan/atau cukai di wilayah Kantor Pelayanan Utama Bea dan Cukai Tipe B Batam;</li>
            <li>Melakukan penindakan di Bidang Kepabeanan dan/atau Cukai sesuai peraturan terhadap pelanggaran ketentuan dan/atau tindak pidana di bidang kepabeanan dan/atau cukai;</li>
            <li>Melakukan tindakan lainnya dan mengambil langkah – langkah sesuai peraturan perundangan guna mengamankan hak - hak negara, apabila dalam pelaksanaan tugas ditemukan adanya pelanggaran ketentuan dan/atau tindak pidana di bidang kepabeanan dan/atau cukai;</li>
            <li>Melakukan pemeriksaan terhadap sarana pengangkut (boatzoeking), meneliti dokumen kapal, melakukan tindakan sesuai ketentuan peraturan perundang-undangan yang berlaku;</li>
            <li>Menjalankan pemeriksaan secara tertib /teratur dan waspada terhadap kemungkinan pemasukan/pengeluaran barang-barang larangan (senjata api, narkoba, uang palsu, dll);</li>
            <li>Melakukan pengawasan pembongkaran barang dari sarana pengangkut dan melaporkan hasilnya pada form BCL 1.2;</li>
            <li>Membuat laporan pelaksanaan tugas secara periodik atau sewaktu-waktu;</li>
            <li>Melaksanakan perintah ini dengan penuh rasa tanggung jawab.</li>
        </ol>
        `,
                ketentuan: `
            <ol>
            <li>Menggunakan sarana peralatan pemeriksaan fisik;</li>
            <li>Berpakaian PDH/ Non PDH;</li>
            <li>Membuat laporan pelaksanaan tugas kepaad Pejabat Penerbit Surat Perintah setelah selesai pelaksanaan tugas.</li>
            </ol>
        `,
                tambahan: `
            <p style="text-align: justify;">
            &nbsp;&nbsp;&nbsp;Biaya yang digunakan untuk pelaksanaan operasi pengawasan ini dibebankan pada DIPA Kantor Pelayanan Utama Bea dan Cukai Tipe B Batam.
            </p>
            <p style="text-align: justify;">
            &nbsp;&nbsp;&nbsp;Kepada pihak berwajib/berwenang/terkait, sesuai dengan ketentuan dalam Pasal 34 Undang-Undang Nomor 39 Tahun 2007 tentang perubahan atas Undang-Undang Nomor 11 Tahun 1995 tentang Cukai, diminta bantuan seperlunya demi kelancaran pelaksanaan tugas tersebut.
            </p>
            <p style="text-align: justify; margin-top: 1em;">
            <em><strong>&nbsp;&nbsp;&nbsp;KPU BC Batam senantiasa berkomitmen menjaga kepentingan negara secara profesional,</strong> 
            bersinergi dengan seluruh pemangku kepentingan dengan 
            <span style="font-style: italic; font-weight: bold;">integritas</span>, 
            <span style="font-style: italic; font-weight: bold;">responsif</span> melayani, dan 
            <span style="font-style: italic; font-weight: bold;">berkinerja cemerlang</span>.
            </em>
            </p>
        `
            }
        };

        // Fungsi untuk mengubah konten berdasarkan tipe surat
        function updateKontenSurat() {
            const selectElement = document.getElementById('tipe_surat_perintah_pra_penindakan');
            const tipe = selectElement.value;

            //console.log('Tipe surat dipilih:', tipe); // Untuk debugging

            if (tipe && kontenSurat[tipe]) {
                // Update konten yang berubah
                const menimbangEl = document.getElementById('content-menimbang');
                const dasarEl = document.getElementById('content-dasar');
                const untukEl = document.getElementById('content-untuk');
                const ketentuanEl = document.getElementById('content-ketentuan');
                const tambahanEl = document.getElementById('content-tambahan');

                if (menimbangEl) menimbangEl.innerHTML = kontenSurat[tipe].menimbang;
                if (dasarEl) dasarEl.innerHTML = kontenSurat[tipe].dasar;
                if (untukEl) untukEl.innerHTML = kontenSurat[tipe].untuk;
                if (ketentuanEl) ketentuanEl.innerHTML = kontenSurat[tipe].ketentuan;
                if (tambahanEl) tambahanEl.innerHTML = kontenSurat[tipe].tambahan;

                // console.log('Konten berhasil diupdate'); // Untuk debugging
            } else {
                // Reset ke konten default jika tidak ada pilihan
                const defaultText = '<p class="text-muted">Pilih tipe surat perintah untuk melihat konten</p>';

                const menimbangEl = document.getElementById('content-menimbang');
                const dasarEl = document.getElementById('content-dasar');
                const untukEl = document.getElementById('content-untuk');
                const ketentuanEl = document.getElementById('content-ketentuan');
                const tambahanEl = document.getElementById('content-tambahan');

                if (menimbangEl) menimbangEl.innerHTML = defaultText;
                if (dasarEl) dasarEl.innerHTML = defaultText;
                if (untukEl) untukEl.innerHTML = defaultText;
                if (ketentuanEl) ketentuanEl.innerHTML = defaultText;
                if (tambahanEl) tambahanEl.innerHTML = defaultText;

                //  console.log('Konten direset ke default'); // Untuk debugging
            }
        }

        // Event listener ketika DOM sudah siap
        document.addEventListener('DOMContentLoaded', function() {
            //console.log('DOM Content Loaded'); // Untuk debugging

            // PERBAIKAN UNTUK SELECT2 - METODE 1: Menggunakan jQuery dan event select2:select
            if (typeof $ !== 'undefined') {
                // Jika jQuery tersedia, gunakan event khusus Select2
                $('#tipe_surat_perintah_pra_penindakan').on('select2:select', function(e) {
                    //console.log('Select2 event triggered'); // Untuk debugging
                    updateKontenSurat();
                });

                // Alternatif: gunakan event change dengan jQuery
                $('#tipe_surat_perintah_pra_penindakan').on('change', function() {
                    //console.log('jQuery change event triggered'); // Untuk debugging
                    updateKontenSurat();
                });

                //console.log('Event listener Select2 berhasil ditambahkan dengan jQuery');
            } else {
                // PERBAIKAN UNTUK SELECT2 - METODE 2: Fallback tanpa jQuery
                // Gunakan MutationObserver untuk mendeteksi perubahan DOM
                const tipeSuratSelect = document.getElementById('tipe_surat_perintah_pra_penindakan');

                if (tipeSuratSelect) {
                    // Event listener biasa (untuk fallback)
                    tipeSuratSelect.addEventListener('change', updateKontenSurat);

                    // MutationObserver untuk mendeteksi perubahan value (untuk Select2)
                    const observer = new MutationObserver(function(mutations) {
                        mutations.forEach(function(mutation) {
                            if (mutation.type === 'attributes' && mutation.attributeName ===
                                'value') {
                                console.log('Value changed detected by MutationObserver');
                                updateKontenSurat();
                            }
                        });
                    });

                    // Mulai observasi
                    observer.observe(tipeSuratSelect, {
                        attributes: true,
                        attributeFilter: ['value']
                    });

                    // Tambahan: Polling untuk memastikan perubahan terdeteksi
                    let lastValue = tipeSuratSelect.value;
                    setInterval(function() {
                        if (tipeSuratSelect.value !== lastValue) {
                            //console.log('Value change detected by polling');
                            lastValue = tipeSuratSelect.value;
                            updateKontenSurat();
                        }
                    }, 500); // Cek setiap 500ms

                    // console.log('Event listener dan MutationObserver berhasil ditambahkan');
                } else {
                    // console.error('Element dengan ID tipe_surat_perintah_pra_penindakan tidak ditemukan!');
                }
            }
        });

        // PERBAIKAN UNTUK SELECT2 - METODE 3: Callback setelah Select2 diinisialisasi
        // Tambahkan ini setelah inisialisasi Select2 di kode Anda
        function initSelect2Callback() {
            if (typeof $ !== 'undefined') {
                // Pastikan Select2 sudah terinisialisasi
                setTimeout(function() {
                    $('#tipe_surat_perintah_pra_penindakan').on('select2:select', function(e) {
                        console.log('Select2 callback event triggered');
                        updateKontenSurat();
                    });
                }, 100);
            }
        }

        // Panggil fungsi ini setelah Select2 diinisialisasi
        // Contoh: setelah $('.select2').select2();
        // initSelect2Callback();
    </script>


    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const radioDJBC = document.getElementById('prosedural_djbc');
            const radioBukan = document.getElementById('prosedural_bukan');
            const textarea = document.querySelector('textarea[name="ket_prosedural"]');

            // Fungsi untuk update isi textarea
            function updateTextarea() {
                if (radioDJBC.checked) {
                    textarea.value = 'Dalam wilayah pengawasan KPU BC Tipe B Batam';
                } else {
                    textarea.value = '';
                }
            }

            // Pasang event listener pada kedua radio button
            radioDJBC.addEventListener('change', updateTextarea);
            radioBukan.addEventListener('change', updateTextarea);

            // Jalankan sekali saat awal load
            updateTextarea();
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
        function generateUniqueID() {
            const timestamp = Date.now();
            const randomNum = Math.floor(Math.random() * 1000000);
            return `id_pra_penindakan_${timestamp}_${randomNum}`;
        }

        document.getElementById('id_pra_penindakan').value = generateUniqueID();
    </script>
@endsection

@section('script')
    @vite(['resources/js/pages/datatable.init.js'])
@endsection
