@extends('layouts.vertical', ['title' => 'Rekam Laporan Pengawasan'])

@section('css')
    @vite([
        'node_modules/datatables.net-bs5/css/dataTables.bootstrap5.min.css',
        'node_modules/datatables.net-buttons-bs5/css/buttons.bootstrap5.min.css',
        'node_modules/datatables.net-keytable-bs5/css/keyTable.bootstrap5.min.css',
        'node_modules/datatables.net-responsive-bs5/css/responsive.bootstrap5.min.css',
        'node_modules/datatables.net-select-bs5/css/select.bootstrap5.min.css'
     ])
@endsection

@section('content')
<div class="container-fluid">
<form action="{{ route('laporan-pengawasan.store') }}" method="POST">
@csrf
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

                <ul class="nav nav-pills nav-justified flex-nowrap overflow-auto" style="white-space: nowrap;" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="st1-tab" data-bs-toggle="tab" href="#st1" role="tab" aria-controls="st1" aria-selected="true">
                    <span class="d-block d-sm-none">(ST-I)</span>
                    <span class="d-none d-sm-block">(ST-I)</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="lpti-tab" data-bs-toggle="tab" href="#lpti" role="tab" aria-controls="lpti" aria-selected="false">
                    <span class="d-block d-sm-none">LPT-I</span>
                    <span class="d-none d-sm-block">LPT-I</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="lppi-tab" data-bs-toggle="tab" href="#lppi" role="tab" aria-controls="lppi" aria-selected="false">
                    <span class="d-block d-sm-none">LPPI-I</span>
                    <span class="d-none d-sm-block">LPPI-I</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="lkai-tab" data-bs-toggle="tab" href="#lkai" role="tab" aria-controls="lkai" aria-selected="false">
                    <span class="d-block d-sm-none">LKAI</span>
                    <span class="d-none d-sm-block">LKAI</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="nhi-tab" data-bs-toggle="tab" href="#nhi" role="tab" aria-controls="nhi" aria-selected="false">
                    <span class="d-block d-sm-none">NHI/NHI-HKI/NHI-N</span>
                    <span class="d-none d-sm-block">NHI/NHI-HKI/NHI-N</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="ni-tab" data-bs-toggle="tab" href="#ni" role="tab" aria-controls="ni" aria-selected="false">
                    <span class="d-block d-sm-none">NI</span>
                    <span class="d-none d-sm-block">NI</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="recommendations-tab" data-bs-toggle="tab" href="#recommendations" role="tab" aria-controls="recommendations" aria-selected="false">
                    <span class="d-block d-sm-none">Rekomendasi Lainnya</span>
                    <span class="d-none d-sm-block">Rekomendasi Lainnya</span>
                </a>
            </li>
        </ul>


<div class="tab-content p-3 text-muted">
   <div class="tab-pane fade show active" id="st1" role="tabpanel" aria-labelledby="st1-tab">
        <div class="row">
            <div class="col-lg-6">
                <h6><b>A. Data Laporan Informasi (LI)</b></h6>
                <hr>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label>No. Surat Tugas</label>
                        <input type="text" class="form-control bg-primary text-white" name="no_st" value="" readonly>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label>Tgl. Surat Tugas</label>
                        <input type="date" class="form-control" placeholder="yyyy-mm-dd" id="tgl_st" name="tgl_st" required>
                    </div>
                    <!-- Media Informasi / Isi Informasi / Catatan -->
                   <div class="col-lg-12 mb-3">
                    <label for="pengendali_operasi">Pengendali Operasi</label>
                    <select class="form-control form-select select2" id="pengendali_operasi" name="pengendali_operasi" required>
                        <option value="" selected disabled>- Pilih -</option>
                        @foreach ($users as $user)
                                    <option value="{{ $user->id_admin }}">{{ $user->name }}</option>
                        @endforeach      
                    </select>
                </div>
                   <div class="col-lg-12 mb-3">
                    <label for="tim_operasi">Tim Operasi</label>
                    <select class="form-control form-select select2 " id="tim_operasi" name="tim_operasi[]" multiple required>
                        {{-- <option value="" selected disabled>- Pilih -</option> --}}
                        @foreach ($users as $user)
                            <option value="{{ $user->id_admin }}">{{ $user->name }}</option>
                        @endforeach      
                    </select>
                </div>
                <div class="col-lg-12 mb-3">
                    <label for="tim_dukungan_oeprasi">Tim Dukungan Operasi</label>
                    <select class="form-control form-select select2 " id="tim_dukungan_oeprasi" name="tim_dukungan_oeprasi[]" multiple required>
                        {{-- <option value="" selected disabled>- Pilih -</option> --}}
                        @foreach ($users as $user)
                            <option value="{{ $user->id_admin }}">{{ $user->name }}</option>
                        @endforeach      
                    </select>
                </div>
                </div>
            </div>
            
            <!-- Right Column (Pejabat Selection) -->
            <div class="col-lg-6">
                <h6><b>B. Penugasan</b></h6>
                <hr>
                
                <div class="col-lg-12 mb-3">
                    <label for="melaksanakan_tugas">Melaksanakan Tugas</label>
                    <textarea class="form-control form-input" placeholder="Di Isi Uraian Tugas" name="Melaksanakan Tugas" rows="2"></textarea>
                </div>
                
                <div class="col-lg-12 mb-3">
                    <label for="wilayah_penugasan">Wilayah Penugasan</label>
                    <input type="text" class="form-control form-input" placeholder="Isi Wilayah Penugasan" name="wilayah_penugasan">
                </div>
                <div class="row">
                <div class="col-lg-6 mb-3">
                    <label for="tanggal_dimulai_tugas">Tanggal Dimulai</label>
                    <input type="date" class="form-control form-input" placeholder="yyyy-mm-dd" name="tanggal_dimulai_tugas">
                </div>
                <div class="col-lg-6 mb-3">
                    <label for="tanggal_berakhir_tugas">Tanggal Berakhir</label>
                    <input type="date" class="form-control form-input" placeholder="yyyy-mm-dd" name="tanggal_berakhir_tugas">
                </div>
                </div>
                <div class="col-lg-12 mb-3">
                    <label for="nama_kantor">Nama Kantor Atau Unit</label>
                    <input type="text" class="form-control form-input" placeholder="Nama Kantor Atau Unit" name="nama_kantor">
                </div>

                <div class="col-lg-12 mb-3">
                    <label for="tim_operasi">Penerbit Surat Tugas</label>
                    <select class="form-control form-select select2 " id="penerbit_surat_tugas" name="penerbit_surat_tugas" required>
                        <option value="" selected disabled>- Pilih -</option>
                        @foreach ($users as $user)
                            <option value="{{ $user->id_admin }}">{{ $user->name }}</option>
                        @endforeach      
                    </select>
                </div>
            </div>
        </div>
    </div>


                        <div class="tab-pane" id="lpti" role="tabpanel">
                           <div class="row">
            <!-- Left Column (Data Laporan Informasi) -->
            <div class="col-lg-6">
                <h6><b>A. Data Laporan Lembar Analisis Pra Penindakan (LAP)</b></h6>
                <hr>
                <div class="row">
                    <!-- No. LI / Tgl. LI -->
                    <div class="row">
                    <div class="col-md-6 mb-3">
                        <label>No. Urut LAP</label>
                        <input type="text" class="form-control bg-primary text-white" name="no_urut_lap" value="" readonly>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label>No. LAP</label>
                        <input type="text" class="form-control bg-primary text-white" name="no_lap" value="" readonly>
                    </div>
                    </div>
                    <!-- Media Informasi / Isi Informasi / Catatan -->
                    <div class="col-md-12 mb-3">
                        <label>Sumber LAP</label>
                        <input type="text" class="form-control" placeholder="Sumber LAP" id="sumber_lap" name="sumber_lap" required>
                    </div>
                        <h6><b>B. Uraian Penindakan dan Kelayakan Operasional</b></h6>
                <hr>
                    <div class="card-body">
                    <div class="accordion accordion-flush" id="accordionFlushExample">
    <div class="accordion-item">
        <h2 class="accordion-header">
            <button class="accordion-button btn bg-light fw-medium collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                A. Pelaku
            </button>
        </h2>
       <div id="flush-collapseOne" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
    <div class="accordion-body bg-light">
        <div class="row mb-3">
            <label for="saranaSelect" class="col-sm-4 col-form-label">ISI DATA</label>
            <div class="col-sm-8">
                <select id="pelaku" class="form-select" name="pelaku">
                    <option value="TIDAK">TIDAK</option>
                    <option value="YA">YA</option>
                </select>
            </div>
        </div>

        <!-- Form Inputs -->
        <div class="row mb-3 form-group">
            <label class="col-sm-4 col-form-label">Keterangan Pelaku</label>
            <div class="col-sm-8">
                <textarea type="text" class="form-control form-input" name="keterangan_pelaku" placeholder="Keterangan pelaku" row="2" ></textarea>
            </div>
        </div>
    </div>
</div>  
    </div>

    <div class="accordion-item">
    <h2 class="accordion-header">
        <button class="accordion-button btn bg-light fw-medium collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseTwo" aria-expanded="false" aria-controls="flush-collapseTwo">
            B. Dugaan Pelanggaran
        </button>
    </h2>
    <div id="flush-collapseTwo" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
        <div class="accordion-body bg-light">
            <div class="row mb-3">
                <label for="dugaan_pelanggaran" class="col-sm-4 col-form-label">ISI DATA</label>
                <div class="col-sm-8">
                    <select id="dugaan_pelanggaran" class="form-select" name="dugaan_pelanggaran"> <!-- Ubah ID di sini -->
                        <option value="TIDAK">TIDAK</option>
                        <option value="YA">YA</option>
                    </select>
                </div>
            </div>

            <!-- Form Inputs -->
        <div class="row mb-3 form-group">
            <label class="col-sm-4 col-form-label">Keterangan Dugaan Pelanggaran</label>
            <div class="col-sm-8">
                <textarea type="text" class="form-control form-input" name="keterangan_dugaan_pelanggaran" placeholder="Keterangan Dugaan Pelanggaran" row="2" ></textarea>
            </div>
        </div>
        </div>
    </div>
</div>

    <div class="accordion-item">
        <h2 class="accordion-header">
            <button class="accordion-button btn bg-light fw-medium collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseThree" aria-expanded="false" aria-controls="flush-collapseThree">
                C. Locus
            </button>
        </h2>
        <div id="flush-collapseThree" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
            <div class="accordion-body bg-light">
            <div class="row mb-3">
                <label for="locus" class="col-sm-4 col-form-label">ISI DATA</label>
                <div class="col-sm-8">
                    <select id="locus" class="form-select" name="locus"> <!-- Ubah ID di sini -->
                        <option value="TIDAK">TIDAK</option>
                        <option value="YA">YA</option>
                    </select>
                </div>
            </div>

           <!-- Form Inputs -->
        <div class="row mb-3 form-group">
            <label class="col-sm-4 col-form-label">Keterangan Locus</label>
            <div class="col-sm-8">
                <textarea type="text" class="form-control form-input" name="keterangan_locus" placeholder="Keterangan Locus" row="2" ></textarea>
            </div>
        </div>
            </div>
        </div>
    </div>
    <div class="accordion-item">
        <h2 class="accordion-header">
            <button class="accordion-button btn bg-light fw-medium collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseFour" aria-expanded="false" aria-controls="flush-collapseFour">
                D. Tempus
            </button>
        </h2>
        <div id="flush-collapseFour" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
            <div class="accordion-body bg-light">
              <div class="row mb-3">
                <label for="tempus" class="col-sm-4 col-form-label">ISI DATA</label>
                <div class="col-sm-8">
                    <select id="tempus" class="form-select" name="tempus"> <!-- Ubah ID di sini -->
                        <option value="TIDAK">TIDAK</option>
                        <option value="YA">YA</option>
                    </select>
                </div>
            </div>

            
            <div class="row mb-3 form-group">
            <label class="col-sm-4 col-form-label">Keterangan Tempus</label>
            <div class="col-sm-8">
                <textarea type="text" class="form-control form-input" name="keterangan_tempus" placeholder="Keterangan Tempus" row="2" ></textarea>
            </div>
        </div>
            </div>
        </div>
    </div>

    <div class="accordion-item">
        <h2 class="accordion-header">
            <button class="accordion-button btn bg-light fw-medium collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseFive" aria-expanded="false" aria-controls="flush-collapseFive">
                E. Prosedural
            </button>
        </h2>
        <div id="flush-collapseFive" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
            <div class="accordion-body bg-light">
              <div class="row mb-3">
                <label for="prosedural" class="col-sm-4 col-form-label">ISI DATA</label>
                <div class="col-sm-8">
                    <select id="prosedural" class="form-select" name="prosedural"> <!-- Ubah ID di sini -->
                        <option value="Bukan">Bukan</option>
                        <option value="Kewenangan DJBC">Kewenangan DJBC</option>
                    </select>
                </div>
            </div>

            
            <div class="row mb-3 form-group">
            <label class="col-sm-4 col-form-label">Keterangan Prosedural</label>
            <div class="col-sm-8">
                <textarea type="text" class="form-control form-input" name="ket_prosedural" placeholder="Keterangan Prosedural" row="2" ></textarea>
            </div>
        </div>
            </div>
        </div>
    </div>

    <div class="accordion-item">
        <h2 class="accordion-header">
            <button class="accordion-button btn bg-light fw-medium collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseSix" aria-expanded="false" aria-controls="flush-collapseSix">
                F. SDM
            </button>
        </h2>
        <div id="flush-collapseSix" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
            <div class="accordion-body bg-light">
              <div class="row mb-3">
                <label for="sdm" class="col-sm-4 col-form-label">ISI DATA</label>
                <div class="col-sm-8">
                    <select id="sdm" class="form-select" name="sdm"> <!-- Ubah ID di sini -->
                        <option value="TIDAK">TIDAK</option>
                        <option value="TERSEDIA">TERSEDIA</option>
                    </select>
                </div>
            </div>

            
            <div class="row mb-3 form-group">
            <label class="col-sm-4 col-form-label">Keterangan SDM</label>
            <div class="col-sm-8">
                <textarea type="text" class="form-control form-input" name="ket_sdm" placeholder="Keterangan SDM" row="2" ></textarea>
            </div>
        </div>
            </div>
        </div>
    </div>

    <div class="accordion-item">
        <h2 class="accordion-header">
            <button class="accordion-button btn bg-light fw-medium collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseSeven" aria-expanded="false" aria-controls="flush-collapseSeven">
                G. Sarana Prasarana
            </button>
        </h2>
        <div id="flush-collapseSeven" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
            <div class="accordion-body bg-light">
              <div class="row mb-3">
                <label for="sarana_prasarana" class="col-sm-4 col-form-label">ISI DATA</label>
                <div class="col-sm-8">
                    <select id="sarana_prasarana" class="form-select" name="sarana_prasarana"> <!-- Ubah ID di sini -->
                        <option value="TIDAK">TIDAK</option>
                        <option value="TERSEDIA">TERSEDIA</option>
                    </select>
                </div>
            </div>

            
            <div class="row mb-3 form-group">
            <label class="col-sm-4 col-form-label">Keterangan Sarana Prasarana</label>
            <div class="col-sm-8">
                <textarea type="text" class="form-control form-input" name="ket_sarana_prasarana" placeholder="Keterangan Sarana Prasarana" row="2" ></textarea>
            </div>
        </div>
            </div>
        </div>
    </div>

     <div class="accordion-item">
        <h2 class="accordion-header">
            <button class="accordion-button btn bg-light fw-medium collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseEight" aria-expanded="false" aria-controls="flush-collapseEight">
                H. Anggaran
            </button>
        </h2>
        <div id="flush-collapseEight" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
            <div class="accordion-body bg-light">
              <div class="row mb-3">
                <label for="anggaran" class="col-sm-4 col-form-label">ISI DATA</label>
                <div class="col-sm-8">
                    <select id="anggaran" class="form-select" name="anggaran"> <!-- Ubah ID di sini -->
                        <option value="TIDAK">TIDAK</option>
                        <option value="TERSEDIA">TERSEDIA</option>
                    </select>
                </div>
            </div>

            
            <div class="row mb-3 form-group">
            <label class="col-sm-4 col-form-label">Keterangan Anggaran</label>
            <div class="col-sm-8">
                <textarea type="text" class="form-control form-input" name="ket_anggaran" placeholder="Keterangan Anggaran" row="2" ></textarea>
            </div>
        </div>
            </div>
        </div>
    </div>

     <div class="accordion-item">
        <h2 class="accordion-header">
            <button class="accordion-button btn bg-light fw-medium collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseNine" aria-expanded="false" aria-controls="flush-collapseNine">
                I. Layak Dilakukan Operasi Penindakan 
            </button>
        </h2>
        <div id="flush-collapseNine" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
            <div class="accordion-body bg-light">
              <div class="row mb-3">
                <label for="layak_dilakukan_operasi_penindakan" class="col-sm-4 col-form-label">ISI DATA</label>
                <div class="col-sm-8">
                    <select id="layak_dilakukan_operasi_penindakan" class="form-select" name="layak_penindakan"> <!-- Ubah ID di sini -->
                        <option value="TIDAK">TIDAK</option>
                        <option value="YA">YA</option>
                    </select>
                </div>
            </div>

            <div class="row mb-3 form-group">
            <label class="col-sm-4 col-form-label">Skema Penindakan</label>
            <div class="col-sm-8">
            <select id="skema_penindakan" class="form-select" name="skem_layak_penindakan"> <!-- Ubah ID di sini -->
                        <option value="MANDIRI">MANDIRI</option>
                        <option value="PELIMPAHAN">PELIMPAHAN</option>
                        <option value="BERSAMA">BERSAMA</option>
                        <option value="DENGAN INSTANSI LAIN">DENGAN INSTANSI LAIN</option>
                        <option value="LAINNYA">LAINNYA</option>
                    </select>
              
               </div>
        </div>

            
            <div class="row mb-3 form-group">
            <label class="col-sm-4 col-form-label">Keterangan Skema Penindakan </label>
            <div class="col-sm-8">
                <textarea type="text" class="form-control form-input" name="ket_layak_penindakan" placeholder="Keterangan Skema Penindakan " row="2" ></textarea>
            </div>
        </div>

        

            </div>
        </div>
    </div>

    <div class="accordion-item">
        <h2 class="accordion-header">
            <button class="accordion-button btn bg-light fw-medium collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseTen" aria-expanded="false" aria-controls="flush-collapseTen">
                J. Layak Dilakukan Patroli
            </button>
        </h2>
        <div id="flush-collapseTen" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
            <div class="accordion-body bg-light">
              <div class="row mb-3">
                <label for="layak_dilakukan_patroli" class="col-sm-4 col-form-label">ISI DATA</label>
                <div class="col-sm-8">
                    <select id="layak_dilakukan_patroli" class="form-select" name="layak_patroli"> <!-- Ubah ID di sini -->
                        <option value="TIDAK">TIDAK</option>
                        <option value="YA">YA</option>
                    </select>
                </div>
            </div>

            <div class="row mb-3 form-group">
            <label class="col-sm-4 col-form-label">Skema Penindakan Patroli</label>
            <div class="col-sm-8">
            <select id="skema_penindakan-patroli" class="form-select" name="skem_layak_patroli"> <!-- Ubah ID di sini -->
                        <option value="MANDIRI">MANDIRI</option>
                        <option value="PELIMPAHAN">PELIMPAHAN</option>
                        <option value="BERSAMA">BERSAMA</option>
                        <option value="DENGAN INSTANSI LAIN">DENGAN INSTANSI LAIN</option>
                        <option value="LAINNYA">LAINNYA</option>
                    </select>
              
               </div>
        </div>

            
            <div class="row mb-3 form-group">
            <label class="col-sm-4 col-form-label">Keterangan Skema Patroli </label>
            <div class="col-sm-8">
                <textarea type="text" class="form-control form-input" name="ket_layak_patroli" placeholder="Keterangan Skema Patroli" row="2" ></textarea>
            </div>
        </div>

        

            </div>
        </div>
    </div>

    <div class="accordion-item">
        <h2 class="accordion-header">
            <button class="accordion-button btn bg-light fw-medium collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseEleven" aria-expanded="false" aria-controls="flush-collapseEleven">
                K. Tidak Layak Dilakukan Operasi Penindakan atau Patroli
            </button>
        </h2>
        <div id="flush-collapseEleven" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
            <div class="accordion-body bg-light">
              <div class="row mb-3">
                <label for="tidak_layak_dilakukan" class="col-sm-4 col-form-label">ISI DATA</label>
                <div class="col-sm-8">
                    <select id="tidak_layak_dilakukan" class="form-select" name="tidak_layak"> <!-- Ubah ID di sini -->
                        <option value="TIDAK">TIDAK</option>
                        <option value="YA">YA</option>
                    </select>
                </div>
            </div>


            
            <div class="row mb-3 form-group">
            <label class="col-sm-4 col-form-label">Keterangan Tidak Layak Melakukan Operasi Penindakan atau Patroli </label>
            <div class="col-sm-8">
                <textarea type="text" class="form-control form-input" name="ket_tidak_layak" placeholder="Keterangan Tidak Layak" row="2" ></textarea>
            </div>
        </div>

        

            </div>
        </div>
    </div>

    </div>
</div>
                </div>
                </div>
            
            
            <!-- Right Column (Pejabat Selection) -->
            <div class="col-lg-6">
              <div class="col-lg-12 mb-3">
                    <label for="kesimpulan">Kesimpulan</label>
                    <textarea type="text" class="form-control form-input" name="kesimpulan_lap" placeholder="Kesimpulan" rows="2" ></textarea>
                </div>
                <h6><b>C. Pilih Pejabat LAP</b></h6>
                <hr>
                <!-- Select Pejabat 1 -->
                <div class="col-lg-12 mb-3">
                    <label for="id_pejabat_lap_1">Pejabat LAP 1</label>
                    <select class="form-control form-select select2 " id="id_pejabat_lap_1" name="id_pejabat_lap_1" required>
                        <option value="" selected disabled>- Pilih -</option>
                        @foreach ($users as $user)
                                    <option value="{{ $user->id_admin }}">{{ $user->name }}</option>
                        @endforeach      
                    </select>
                </div>
                <!-- Select Pejabat 2 -->
                <div class="col-lg-12 mb-3">
                    <label for="id_pejabat_lap_2">Pejabat LAP 2</label>
                    <select class="form-control form-select select2" id="id_pejabat_lap_2" name="id_pejabat_lap_2" required>
                        <option value="" selected disabled>- Pilih -</option>
                        @foreach ($users as $user)
                                    <option value="{{ $user->id_admin }}">{{ $user->name }}</option>
                                @endforeach
                    </select>
                </div>
                <!-- Select Pejabat 3 -->
                <div class="col-lg-12 mb-3">
                    <label for="id_pejabat_lap_3">Pejabat LAP 3</label>
                    <select class="form-control form-select select2" id="id_pejabat_lap_3" name="id_pejabat_lap_3" required>
                        <option value="" selected disabled>- Pilih -</option>
                        @foreach ($users as $user)
                                    <option value="{{ $user->id_admin }}">{{ $user->name }}</option>
                                @endforeach
                    </select>
                </div>
            </div>
        </div>
                        </div><!-- end tab pane -->

                        <div class="tab-pane" id="lppi" role="tabpanel">
                           <div class="row">
            <!-- Left Column (Data Laporan Informasi) -->
            <div class="col-lg-6">
                <h6><b>A. Nota Pengembalian Informasi</b></h6>
                <hr>
                <div class="row">
                    <div class="col-md-12 mb-3">
                        <label>No. NPI</label>
                        <input type="text" class="form-control bg-primary text-white" name="no_npi" value="" readonly>
                    </div>
                    <div class="col-md-12 mb-3">
                        <label>Sumber Informasi</label>
                        <input type="text" class="form-control" placeholder="Sumber Informasi" id="sumber_informasi_npi" name="sumber_npi" required>
                    </div>
                    <div class="col-md-12 mb-3">
                        <label>Unit Penebit Informasi</label>
                        <textarea class="form-control" rows="2" placeholder="Unit Penerbit Informasi" id="unit_penerbit_informasi" name="unit_penerbit_npi" required></textarea>
                    </div>
                    <div class="col-md-12 mb-3">
                        <label>Alasan</label>
                        <textarea class="form-control" rows="2" placeholder="Alasan Tidak Dapat Dilakukan Penindakan Lebih Lanjut" id="alasan_penindakan_npi" name="alasan_npi" required></textarea>
                    </div>
                </div>
            </div>
            
            <!-- Right Column (Pejabat Selection) -->
            <div class="col-lg-6">
                <h6><b>B. Pilih Pejabat</b></h6>
                <hr>
                <!-- Select Pejabat 1 -->
                <div class="col-lg-12 mb-3">
                    <label for="id_pejabat_npi">Pejabat</label>
                    <select class="form-control form-select select2" id="id_pejabat_npi" name="id_pejabat_npi" required>
                        <option value="" selected disabled>- Pilih -</option>
                        @foreach ($users as $user)
                                    <option value="{{ $user->id_admin }}">{{ $user->name }}</option>
                        @endforeach      
                    </select>
                </div>
            </div>
        </div>
                        </div><!-- end tab pane -->


        <div class="tab-pane" id="lkai" role="tabpanel">
                            <div class="row">
            <!-- Left Column (Data Laporan Informasi) -->
            <div class="col-lg-6">
                <h6><b>A. Data Surat Perintah</b></h6>
                <hr>
                <div class="row">
                    <!-- No. LI / Tgl. LI -->
                    <div class="col-md-6 mb-3">
                        <label>No. Print</label>
                        <input type="text" class="form-control bg-primary text-white" placeholder="Masukkan Nomor Perintah" name="no_print" >
                    </div>
                    <div class="col-md-6 mb-3">
                        <label>tgl. Print</label>
                        <input type="date" class="form-control bg-primary text-white" name="tgl_print" >
                    </div>
                    <!-- Media Informasi / Isi Informasi / Catatan -->
                    <div class="col-md-12 mb-3">
                        <label>Pertimbangan Surat Perintah</label>
                        <textarea  class="form-control" row="2" placeholder="Pertimbangan Diterbitkannya Surat Perintah" id="pertimbangan_surat_perintah" name="ket_perundang" required></textarea>
                    </div>
                    <div class="col-md-12 mb-3">
                        <label>Dasar Hukum </label>
                        <textarea class="form-control" rows="2" placeholder="Dasar Hukum Yang Mendasari Diterbitkannya Surat Perintah" id="dasar_sp" name="dasar_sp" required></textarea>
                    </div>
                </div>
            </div>
            
            <!-- Right Column (Pejabat Selection) -->
            <div class="col-lg-6">
                <h6><b>B. Pilih Pejabat</b></h6>
                <hr>
                <!-- Select Pejabat 1 -->
                <div class="col-lg-12 mb-3">
    <label for="id_pejabat_sp_1">Pejabat Yang Diberi Perintah</label>
    <select class="form-control form-select select2" id="id_pejabat_sp_1" name="id_pejabat_sp_1"  required>
        <option value="" selected disabled>- Pilih -</option>
        @foreach ($users as $user)
            <option value="{{ $user->id_admin }}">{{ $user->name }}</option>
        @endforeach      
    </select>
</div>
                <!-- Select Pejabat 2 -->
                <div class="col-md-12 mb-3">
                    <label for="perintah">Perintah</label>
                     <textarea  class="form-control" row="2" placeholder="Perintah Yang Diberikan Kepada Pejabat Bea dan Cukai" id="perintah_sp" name="perintah_sp" required></textarea>
                </div>
                <!-- Select Pejabat 3 -->
                <div class="col-md-12 mb-3">
                    <label for="wilayah">Wilayah</label>
                     <input type="text" class="form-control" name="wilayah">
                </div>

              
                <div class="row">
    <div class="col-md-6 mb-3">
        <label>Tanggal Mulai Berlaku</label>
        <input type="date" class="form-control" name="tanggal_mulai_print" required>
    </div>
    <div class="col-md-6 mb-3">
        <label>Tanggal Berakhir</label>
        <input type="date" class="form-control" id="tanggal_berakhir_print" name="tanggal_berakhir_print" required>
    </div>
</div>

                

               


                <div class="col-md-12 mb-3">
                    <label for="ketentuan_baju">Ketentuan</label>
                     <select class="form-control" id="ketentuan_baju" name="ketentuan_baju" required>
                        <option value="" selected disabled>- Pilih -</option>
                        <option value="Berpakaian PDH">Berpakaian PDH</option>
                        <option value="Berpakaian Non PDH">Berpakaian Non PDH</option>
                        <option value="Berpakaian PDL">Berpakaian PDL</option>
                    </select>
                    </div>


                    <div class="col-md-12 mb-3">
                    <label for="ketentuan_lain">Ketentuan Lain</label>
                       <textarea  class="form-control" row="2" placeholder="Ketentuan Lain" id="ketentuan_lain" name="ketentuan_lain" required></textarea>
                    </div>


                    {{-- <div class="col-md-12 mb-3">
                    <label for="plh">Pelaksana Harian</label>
                    <select class="form-control" id="plh" name="plh" required>
                        <option value="" selected disabled>- Pilih -</option>
                        <option value="Plh">Pelaksana Harian</option>
                        <option value="">Tidak Ada Pelaksana Harian</option>
                          
                    </select>
                </div> --}}


                    <div class="col-md-12 mb-3">
                    <label for="id_pejabat_sp_2">Pejabat Yang Menandatangani</label>
                    <select class="form-control form-select select2" id="id_pejabat_sp_2" name="id_pejabat_sp_2" required>
                        <option value="" selected disabled>- Pilih -</option>
                        @foreach ($users as $user)
                                    <option value="{{ $user->id_admin }}">{{ $user->name }}</option>
                        @endforeach      
                    </select>
                </div>


            </div>
        </div>

    

{{-- <div class="card-footer d-flex justify-content-end">
            
           <button type="submit" class="btn btn-success btn-sm me-2">
                <i data-feather="save"></i> Simpan Data LI
            </button>
        </div> --}}

                        </div><!-- end tab pane -->

                         <div class="tab-pane" id="nhi" role="tabpanel">
                           <div class="row">
            <!-- Left Column (Data Laporan Informasi) -->
            <div class="col-lg-6">
                <h6><b>A. Nota Pengembalian Informasi</b></h6>
                <hr>
                <div class="row">
                    <div class="col-md-12 mb-3">
                        <label>No. NPI</label>
                        <input type="text" class="form-control bg-primary text-white" name="no_npi" value="" readonly>
                    </div>
                    <div class="col-md-12 mb-3">
                        <label>Sumber Informasi</label>
                        <input type="text" class="form-control" placeholder="Sumber Informasi" id="sumber_informasi_npi" name="sumber_npi" required>
                    </div>
                    <div class="col-md-12 mb-3">
                        <label>Unit Penebit Informasi</label>
                        <textarea class="form-control" rows="2" placeholder="Unit Penerbit Informasi" id="unit_penerbit_informasi" name="unit_penerbit_npi" required></textarea>
                    </div>
                    <div class="col-md-12 mb-3">
                        <label>Alasan</label>
                        <textarea class="form-control" rows="2" placeholder="Alasan Tidak Dapat Dilakukan Penindakan Lebih Lanjut" id="alasan_penindakan_npi" name="alasan_npi" required></textarea>
                    </div>
                </div>
            </div>
            
            <!-- Right Column (Pejabat Selection) -->
            <div class="col-lg-6">
                <h6><b>B. Pilih Pejabat</b></h6>
                <hr>
                <!-- Select Pejabat 1 -->
                <div class="col-lg-12 mb-3">
                    <label for="id_pejabat_npi">Pejabat</label>
                    <select class="form-control form-select select2" id="id_pejabat_npi" name="id_pejabat_npi" required>
                        <option value="" selected disabled>- Pilih -</option>
                        @foreach ($users as $user)
                                    <option value="{{ $user->id_admin }}">{{ $user->name }}</option>
                        @endforeach      
                    </select>
                </div>
            </div>
        </div>
                        </div>

                         <div class="tab-pane" id="ni" role="tabpanel">
                           <div class="row">
            <!-- Left Column (Data Laporan Informasi) -->
            <div class="col-lg-6">
                <h6><b>A. Nota Pengembalian Informasi</b></h6>
                <hr>
                <div class="row">
                    <div class="col-md-12 mb-3">
                        <label>No. NPI</label>
                        <input type="text" class="form-control bg-primary text-white" name="no_npi" value="" readonly>
                    </div>
                    <div class="col-md-12 mb-3">
                        <label>Sumber Informasi</label>
                        <input type="text" class="form-control" placeholder="Sumber Informasi" id="sumber_informasi_npi" name="sumber_npi" required>
                    </div>
                    <div class="col-md-12 mb-3">
                        <label>Unit Penebit Informasi</label>
                        <textarea class="form-control" rows="2" placeholder="Unit Penerbit Informasi" id="unit_penerbit_informasi" name="unit_penerbit_npi" required></textarea>
                    </div>
                    <div class="col-md-12 mb-3">
                        <label>Alasan</label>
                        <textarea class="form-control" rows="2" placeholder="Alasan Tidak Dapat Dilakukan Penindakan Lebih Lanjut" id="alasan_penindakan_npi" name="alasan_npi" required></textarea>
                    </div>
                </div>
            </div>
            
            <!-- Right Column (Pejabat Selection) -->
            <div class="col-lg-6">
                <h6><b>B. Pilih Pejabat</b></h6>
                <hr>
                <!-- Select Pejabat 1 -->
                <div class="col-lg-12 mb-3">
                    <label for="id_pejabat_npi">Pejabat</label>
                    <select class="form-control form-select select2" id="id_pejabat_npi" name="id_pejabat_npi" required>
                        <option value="" selected disabled>- Pilih -</option>
                        @foreach ($users as $user)
                                    <option value="{{ $user->id_admin }}">{{ $user->name }}</option>
                        @endforeach      
                    </select>
                </div>
            </div>
        </div>
                        </div>

                         <div class="tab-pane" id="recommendations" role="tabpanel">
                           <div class="row">
            <!-- Left Column (Data Laporan Informasi) -->
            <div class="col-lg-6">
                <h6><b>A. Nota Pengembalian Informasi</b></h6>
                <hr>
                <div class="row">
                    <div class="col-md-12 mb-3">
                        <label>No. NPI</label>
                        <input type="text" class="form-control bg-primary text-white" name="no_npi" value="" readonly>
                    </div>
                    <div class="col-md-12 mb-3">
                        <label>Sumber Informasi</label>
                        <input type="text" class="form-control" placeholder="Sumber Informasi" id="sumber_informasi_npi" name="sumber_npi" required>
                    </div>
                    <div class="col-md-12 mb-3">
                        <label>Unit Penebit Informasi</label>
                        <textarea class="form-control" rows="2" placeholder="Unit Penerbit Informasi" id="unit_penerbit_informasi" name="unit_penerbit_npi" required></textarea>
                    </div>
                    <div class="col-md-12 mb-3">
                        <label>Alasan</label>
                        <textarea class="form-control" rows="2" placeholder="Alasan Tidak Dapat Dilakukan Penindakan Lebih Lanjut" id="alasan_penindakan_npi" name="alasan_npi" required></textarea>
                    </div>
                </div>
            </div>
            
            <!-- Right Column (Pejabat Selection) -->
            <div class="col-lg-6">
                <h6><b>B. Pilih Pejabat</b></h6>
                <hr>
                <!-- Select Pejabat 1 -->
                <div class="col-lg-12 mb-3">
                    <label for="id_pejabat_npi">Pejabat</label>
                    <select class="form-control form-select select2" id="id_pejabat_npi" name="id_pejabat_npi" required>
                        <option value="" selected disabled>- Pilih -</option>
                        @foreach ($users as $user)
                                    <option value="{{ $user->id_admin }}">{{ $user->name }}</option>
                        @endforeach      
                    </select>
                </div>
            </div>
        </div>
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
    @vite([ 'resources/js/pages/datatable.init.js'])
@endsection