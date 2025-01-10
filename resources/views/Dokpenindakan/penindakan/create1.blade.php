@extends('layouts.vertical', ['title' => 'Rekam Form Sbp'])

@section('css')
  @vite(['node_modules/datatables.net-bs5/css/dataTables.bootstrap5.min.css', 'node_modules/datatables.net-buttons-bs5/css/buttons.bootstrap5.min.css', 'node_modules/datatables.net-keytable-bs5/css/keyTable.bootstrap5.min.css', 'node_modules/datatables.net-responsive-bs5/css/responsive.bootstrap5.min.css', 'node_modules/datatables.net-select-bs5/css/select.bootstrap5.min.css'])
@endsection

@section('content')
  <div class="container-fluid">
    <!-- Card Container -->
    <div class="card mb-3 mt-4">
      <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="card-title mb-0">
          <i data-feather="book" style="width: 20px; height: 20px;" class="me-1"></i>
          Form Surat Bukti Penindakan (SBP)
        </h5>
        <!-- Tombol Kembali -->
        <button type="button" class="btn btn-danger btn-sm" onclick="window.history.back()">
          <i data-feather="log-out"></i> Kembali
        </button>
      </div>


      <div class="card-body">
        <form action="{{ route('penindakan.store') }}" method="POST">
          @csrf
          <div class="card-body">
            <div class="tabs-container" id="tabs-container">
              <ul class="nav nav-pills nav-justified flex-nowrap overflow-auto" style="white-space: nowrap;" role="tablist">
                <li class="nav-item">
                  <a class="nav-link active" id="dok-pendukung-tab" data-bs-toggle="tab" href="#dok-pendukung" role="tab" aria-controls="dok-pendukung" aria-selected="true">
                    <span class="d-block d-sm-none">(DOK PENDUKUNG)</span>
                    <span class="d-none d-sm-block">Dokumen Pendukung</span>
                  </a>
                </li>
                {{-- <li class="nav-item" id="ba-henti-tab-item" style="display: none;">
                  <a class="nav-link" id="ba-henti-tab" data-bs-toggle="tab" href="#ba-henti" role="tab" aria-controls="ba-henti" aria-selected="false">
                    <span class="d-block d-sm-none">(B.A HENTI)</span>
                    <span class="d-none d-sm-block">B.A HENTI</span>
                  </a>
                </li> --}}
                <li class="nav-item" id="ba-riksa-tab-item" style="display: none;">
                  <a class="nav-link" id="ba-riksa-tab" data-bs-toggle="tab" href="#ba-riksa" role="tab" aria-controls="ba-riksa" aria-selected="false">
                    <span class="d-block d-sm-none">(B.A RIKSA)</span>
                    <span class="d-none d-sm-block">B.A RIKSA</span>
                  </a>
                </li>
                <li class="nav-item" id="ba-riksa-badan-tab-item" style="display: none;">
                  <a class="nav-link" id="ba-riksa-badan-tab" data-bs-toggle="tab" href="#ba-riksa-badan" role="tab" aria-controls="ba-riksa-badan" aria-selected="false">
                    <span class="d-block d-sm-none">(B.A RIKSA BADAN)</span>
                    <span class="d-none d-sm-block">B.A RIKSA BADAN</span>
                  </a>
                </li>
                <li class="nav-item" id="soc-tab-item" style="display: none;">
                  <a class="nav-link" id="soc-tab" data-bs-toggle="tab" href="#soc" role="tab" aria-controls="soc" aria-selected="false">
                    <span class="d-block d-sm-none">(SOC)</span>
                    <span class="d-none d-sm-block">SOC</span>
                  </a>
                </li>
                <li class="nav-item" id="doc-tab-item" style="display: none;">
                  <a class="nav-link" id="doc-tab" data-bs-toggle="tab" href="#doc" role="tab" aria-controls="doc" aria-selected="false">
                    <span class="d-block d-sm-none">(SOC)</span>
                    <span class="d-none d-sm-block">SOC</span>
                  </a>
                </li>
                <li class="nav-item" id="ba-sarkut-tab-item" style="display: none;">
                  <a class="nav-link" id="ba-sarkut-tab" data-bs-toggle="tab" href="#ba-sarkut" role="tab" aria-controls="ba-sarkut" aria-selected="false">
                    <span class="d-block d-sm-none">(B.A SARKUT)</span>
                    <span class="d-none d-sm-block">B.A SARKUT</span>
                  </a>
                </li>
                <li class="nav-item" id="ba-contoh-tab-item" style="display: none;">
                  <a class="nav-link" id="ba-contoh-tab" data-bs-toggle="tab" href="#ba-contoh" role="tab" aria-controls="ba-contoh" aria-selected="false">
                    <span class="d-block d-sm-none">(B.A CONTOH)</span>
                    <span class="d-none d-sm-block">B.A CONTOH</span>
                  </a>
                </li>
                <li class="nav-item" id="ba-dok-tab-item" style="display: none;">
                  <a class="nav-link" id="ba-dok-tab" data-bs-toggle="tab" href="#ba-dok" role="tab" aria-controls="ba-dok" aria-selected="false">
                    <span class="d-block d-sm-none">(B.A DOK)</span>
                    <span class="d-none d-sm-block">B.A DOKUMENTASI</span>
                  </a>
                </li>
                <li class="nav-item" id="ba-tegah-tab-item" style="display: none;">
                  <a class="nav-link" id="ba-tegah-tab" data-bs-toggle="tab" href="#ba-tegah" role="tab" aria-controls="ba-tegah" aria-selected="false">
                    <span class="d-block d-sm-none">(B.A TEGAH)</span>
                    <span class="d-none d-sm-block">B.A TEGAH</span>
                  </a>
                </li>
                <li class="nav-item" id="ba-segel-tab-item" style="display: none;">
                  <a class="nav-link" id="ba-segel-tab" data-bs-toggle="tab" href="#ba-segel" role="tab" aria-controls="ba-segel" aria-selected="false">
                    <span class="d-block d-sm-none">(B.A SEGEL)</span>
                    <span class="d-none d-sm-block">B.A SEGEL</span>
                  </a>
                </li>
                <li class="nav-item" id="ba-titip-tab-item" style="display: none;">
                  <a class="nav-link" id="ba-titip-tab" data-bs-toggle="tab" href="#ba-titip" role="tab" aria-controls="ba-titip" aria-selected="false">
                    <span class="d-block d-sm-none">(B.A TITIP)</span>
                    <span class="d-none d-sm-block">B.A TITIP</span>
                  </a>
                </li>
                {{-- <li class="nav-item" id="bpc-tab-item" style="display: none;">
                  <a class="nav-link" id="bpc-tab-content" data-bs-toggle="tab" href="#bpc" role="tab" aria-controls="bpc" aria-selected="false">
                    <span class="d-block d-sm-none">(BPC)</span>
                    <span class="d-none d-sm-block">BLOKIR PITA CUKAI</span>
                  </a>
                </li> --}}
                <li class="nav-item">
                  <a class="nav-link" id="sbp-tab" data-bs-toggle="tab" href="#sbp" role="tab" aria-controls="sbp" aria-selected="false">
                    <span class="d-block d-sm-none">(SBP)</span>
                    <span class="d-none d-sm-block">Surat Bukti Penindakan</span>
                  </a>
                </li>
              </ul>
            </div>
          </div>

          <div class="tab-pane fade show active" id="dok-pendukung" role="tabpanel" aria-labelledby="dok-pendukung-tab">
            <div class="row">
              <div class="col-lg-6">
                <h6><b>A. Dokumen Pendukung 1</b></h6>
                <hr>

                <div class="card-body">
                  <div class="accordion accordion-flush" id="accordionFlushExample">

                    <div class="accordion-item">
                      <h2 class="accordion-header">
                        <button class="accordion-button btn bg-light fw-medium collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapserty" aria-expanded="false" aria-controls="flush-collapserty">
                          A. B.A Henti
                        </button>
                      </h2>
                      <div id="flush-collapserty" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
                        <div class="accordion-body bg-light">
                          <div class="row mb-3">
                            <label class="col-sm-4 col-form-label">ISI DATA</label>
                            <div class="col-sm-8">
                              <select id="ba-henti-select" class="form-select" name="ba_henti" onchange="handleSelection(this)">
                                <option value="TIDAK">TIDAK</option>
                                <option value="YA">YA</option>
                              </select>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>

                    <div class="accordion-item">
                      <h2 class="accordion-header">
                        <button class="accordion-button btn bg-light fw-medium collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapse2" aria-expanded="false" aria-controls="flush-collapse2">
                          B. Pemeriksaan
                        </button>
                      </h2>
                      <div id="flush-collapse2" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
                        <div class="accordion-body bg-light">

                          <div class="row mb-3">
                            <label class="col-sm-4 col-form-label">B.A RIKSA</label>
                            <div class="col-sm-8">
                              <select id="ba-riksa-select" class="form-select" name="ba_riksa" onchange="handleSelection(this)">
                                <option value="TIDAK">TIDAK</option>
                                <option value="YA">YA</option>
                              </select>
                            </div>
                          </div>

                          <div class="row mb-3">
                            <label class="col-sm-4 col-form-label">B.A RIKSA BADAN</label>
                            <div class="col-sm-8">
                              <select id="ba-riksa-badan-select" class="form-select" name="ba_riksa_badan" onchange="handleSelection(this)">
                                <option value="TIDAK">TIDAK</option>
                                <option value="YA">YA</option>
                              </select>
                            </div>
                          </div>

                          <div class="row mb-3">
                            <label class="col-sm-4 col-form-label">SOC</label>
                            <div class="col-sm-8">
                              <select id="soc-select" class="form-select" name="soc" onchange="handleSelection(this)">
                                <option value="TIDAK">TIDAK</option>
                                <option value="YA">YA</option>
                              </select>
                            </div>
                          </div>

                          <div class="row mb-3">
                            <label class="col-sm-4 col-form-label">DOC</label>
                            <div class="col-sm-8">
                              <select id="doc-select" class="form-select" name="doc" onchange="handleSelection(this)">
                                <option value="TIDAK">TIDAK</option>
                                <option value="YA">YA</option>
                              </select>
                            </div>
                          </div>

                        </div>
                      </div>
                    </div>

                    <div class="accordion-item">
                      <h2 class="accordion-header">
                        <button class="accordion-button btn bg-light fw-medium collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapsezbv" aria-expanded="false" aria-controls="flush-collapsezbv">
                          C. B.A Sarkut
                        </button>
                      </h2>
                      <div id="flush-collapsezbv" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
                        <div class="accordion-body bg-light">
                          <div class="row mb-3">
                            <label class="col-sm-4 col-form-label">ISI DATA</label>
                            <div class="col-sm-8">
                              <select id="ba-sarkut-select" class="form-select" name="ba_sarkut" onchange="handleSelection(this)">
                                <option value="TIDAK">TIDAK</option>
                                <option value="YA">YA</option>
                              </select>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>

                    <div class="accordion-item">
                      <h2 class="accordion-header">
                        <button class="accordion-button btn bg-light fw-medium collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseopi" aria-expanded="false" aria-controls="flush-collapseopi">
                          D. B.A Contoh
                        </button>
                      </h2>
                      <div id="flush-collapseopi" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
                        <div class="accordion-body bg-light">
                          <div class="row mb-3">
                            <label class="col-sm-4 col-form-label">ISI DATA</label>
                            <div class="col-sm-8">
                              <select id="ba-contoh-select" class="form-select" name="ba_contoh" onchange="handleSelection(this)">
                                <option value="TIDAK">TIDAK</option>
                                <option value="YA">YA</option>
                              </select>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>

                    <div class="accordion-item">
                      <h2 class="accordion-header">
                        <button class="accordion-button btn bg-light fw-medium collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseiyt" aria-expanded="false" aria-controls="flush-collapseiyt">
                          E. B.A Dokumentasi
                        </button>
                      </h2>
                      <div id="flush-collapseiyt" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
                        <div class="accordion-body bg-light">
                          <div class="row mb-3">
                            <label class="col-sm-4 col-form-label">ISI DATA</label>
                            <div class="col-sm-8">
                              <select id="ba-dok-select" class="form-select" name="ba_dokumentasi" onchange="handleSelection(this)">
                                <option value="TIDAK">TIDAK</option>
                                <option value="YA">YA</option>
                              </select>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>





                  </div>
                </div>
              </div>


              <div class="col-lg-6">
                <h6><b>B. Dokumen Pendukung 2</b></h6>
                <hr>



                <div class="card-body">
                  <div class="accordion accordion-flush" id="accordionFlushExample">



                    <div class="accordion-item">
                      <h2 class="accordion-header">
                        <button class="accordion-button btn bg-light fw-medium collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapse1" aria-expanded="false" aria-controls="flush-collapse1">
                          F. B.A Tegah
                        </button>
                      </h2>
                      <div id="flush-collapse1" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
                        <div class="accordion-body bg-light">
                          <div class="row mb-3">
                            <label class="col-sm-4 col-form-label">ISI DATA</label>
                            <div class="col-sm-8">
                              <select id="ba-tegah-select" class="form-select" name="ba_tegah" onchange="handleSelection(this)">
                                <option value="TIDAK">TIDAK</option>
                                <option value="YA">YA</option>
                              </select>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>

                    <div class="accordion-item">
                      <h2 class="accordion-header">
                        <button class="accordion-button btn bg-light fw-medium collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapse3" aria-expanded="false" aria-controls="flush-collapse3">
                          G. B.A SEGEL
                        </button>
                      </h2>
                      <div id="flush-collapse3" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
                        <div class="accordion-body bg-light">
                          <div class="row mb-3">
                            <label class="col-sm-4 col-form-label">ISI DATA</label>
                            <div class="col-sm-8">
                              <select id="ba-segel-select" class="form-select" name="ba_segel" onchange="handleSelection(this)">
                                <option value="TIDAK">TIDAK</option>
                                <option value="YA">YA</option>
                              </select>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>

                    <div class="accordion-item">
                      <h2 class="accordion-header">
                        <button class="accordion-button btn bg-light fw-medium collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapsebfg" aria-expanded="false" aria-controls="flush-collapsebfg">
                          H. B.A Titip
                        </button>
                      </h2>
                      <div id="flush-collapsebfg" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
                        <div class="accordion-body bg-light">
                          <div class="row mb-3">
                            <label class="col-sm-4 col-form-label">ISI DATA</label>
                            <div class="col-sm-8">
                              <select id="ba-titip-select" class="form-select" name="ba_titip" onchange="handleSelection(this)">
                                <option value="TIDAK">TIDAK</option>
                                <option value="YA">YA</option>
                              </select>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>


                    <div class="accordion-item">
                      <h2 class="accordion-header">
                        <button class="accordion-button btn bg-light fw-medium collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseljf" aria-expanded="false" aria-controls="flush-collapseljf">
                          I. Blokir Pita Cukai
                        </button>
                      </h2>
                      <div id="flush-collapseljf" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
                        <div class="accordion-body bg-light">
                          <div class="row mb-3">
                            <label class="col-sm-4 col-form-label">ISI DATA</label>
                            <div class="col-sm-8">
                              <select id="bpc-select" class="form-select" name="blokir_pita_cukai" onchange="handleSelection(this)">
                                <option value="TIDAK">TIDAK</option>
                                <option value="YA">YA</option>
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
          </div>

          <div class="tab-content p-3 text-muted">
            <div class="tab-pane" id="sbp" role="tabpanel">
              <div class="row">
                <div class="col-lg-6">
                  <div class="row">
                    <input type="hidden" id="id_sbp" name="id_sbp" value="">
                    <input type="hidden" name="id_pra_penindakan_ref" value="{{ $laporan->id_pra_penindakan }}">
                    <h6><b>Data Referensi</b></h6>
                    <hr>
                    <div class="col-md-6 mb-3">
                      <label>No. Surat Perintah</label>
                      <input type="text" class="form-control bg-primary text-white" value="{{ $laporan->no_print }}" readonly>
                    </div>

                    <div class="col-md-6 mb-3">
                      <label>Tgl. Surat Perintah</label>
                      <input type="text" class="form-control bg-primary text-white" value="{{ $laporan->tgl_print }}" readonly>
                    </div>

                    <h6><b>A. Data Awal</b></h6>
                    <hr>

                    <!-- No. SBP / Tgl. SBP -->
                    <div class="col-md-6 mb-3">
                      <label>No. SBP</label>
                      <input type="text" class="form-control bg-primary text-white" name="no_sbp" id="no_sbp" value="{{ old('no_sbp', $no_ref->no_sbp) }}" readonly>
                    </div>
                    <div class="col-md-6 mb-3">
                      <label>Tgl. SBP</label>
                      <input type="date" class="form-control bg-primary text-white" placeholder="yyyy-mm-dd" id="tgl_sbp" name="tgl_sbp">
                    </div>




                    <!-- Jenis Barang -->
                    {{-- <div class="col-md-6 mb-3">
                          <label>Jenis Barang</label>
                          <select class="form-control" id="jenis_barang" name="jenis_barang"  
                          style="background-color:#4cc2af; color:white;">
                          <option value="">- Pilih -</option>
                          <option value="PENUMPANG">Barang Penumpang</option>
                          <option value="CARGO">Barang Kiriman/Cargo</option>
                          </select>
                      </div> --}}

                    <!-- Skema Penindakan -->
                    <div class="col-md-12 mb-3">
                      <label>Skema Penindakan</label>
                      <select class="form-control" id="skema_penindakan" name="skema_penindakan">
                        <option value="">- Pilih -</option>
                        <option value="MANDIRI">Mandiri</option>
                        <option value="BERSAMA">Bersama</option>
                      </select>
                    </div>


                    <h6><b>B. Data Petugas</b></h6>
                    <hr>

                    <div class="col-md-6 mb-3">
                      <label>Petugas I</label>
                      <select class="form-select select2" name="id_petugas_1_sbp">
                        <option value="" disabled selected>- Pilih -</option>
                        @foreach ($users as $user)
                          <option value="{{ $user->id_admin }}">{{ $user->name }}</option>
                        @endforeach
                      </select>
                    </div>
                    <div class="col-md-6 mb-3">
                      <label>Petugas II</label>
                      <select class="form-select select2" name="id_petugas_2_sbp">
                        <option value="" disabled selected>- Pilih -</option>
                        @foreach ($users as $user)
                          <option value="{{ $user->id_admin }}">{{ $user->name }}</option>
                        @endforeach
                      </select>
                    </div>






                    <h6><b>C. Data Saksi</b></h6>
                    <hr>

                    <div class="col-md-6 mb-3">
                      <label>Nama Saksi</label>
                      <input type="text" class="form-control" placeholder="Nama Saksi" name="nama_saksi">
                    </div>
                    <div class="col-md-6 mb-3">
                      <label>Alamat Saksi</label>
                      <input type="text" class="form-control" placeholder="Alamat Saksi" name="alamat_saksi">
                    </div>
                    <div class="col-md-6 mb-3">
                      <label>Pekerjaan Saksi</label>
                      <input type="text" class="form-control" placeholder="Pekerjaan Saksi" name="pekerjaan_saksi">
                    </div>
                    <div class="col-md-6 mb-3">
                      <label>No.Identitas Saksi</label>
                      <input type="text" class="form-control" placeholder="No.Identitas Saksi" name="no_identitas_saksi">
                    </div>
                    <div class="col-md-6 mb-3">
                      <label>Kontak Saksi (NO.HP)</label>
                      <input type="text" class="form-control" placeholder="Kontak Saksi (NO.HP)" name="kontak_saksi">
                    </div>







                    <!-- Perintah Yang Dilaksanakan (Switch Checkboxes) -->
                    {{-- <div class="col-md-12 mb-3">
    <label>Perintah Yang Dilaksanakan</label>
    <div class="row">
        <!-- Column 1 -->
        <div class="col-md-6">
            <div class="form-check form-switch mb-2">
                <input class="form-check-input" type="checkbox" role="switch" id="penghentian">
                <label class="form-check-label" for="penghentian">Penghentian</label>
            </div>
            <div class="form-check form-switch mb-2">
                <input class="form-check-input" type="checkbox" role="switch" id="pemeriksaan">
                <label class="form-check-label" for="pemeriksaan">Pemeriksaan</label>
            </div>
            <div class="form-check form-switch mb-2">
                <input class="form-check-input" type="checkbox" role="switch" id="pencegahan">
                <label class="form-check-label" for="pencegahan">Pencegahan</label>
            </div>
        </div>
        
        <!-- Column 2 -->
        <div class="col-md-6">
            <div class="form-check form-switch mb-2">
                <input class="form-check-input" type="checkbox" role="switch" id="penyegelan" >
                <label class="form-check-label" for="penyegelan">Penyegelan</label>
            </div>
            <div class="form-check form-switch mb-2">
                <input class="form-check-input" type="checkbox" role="switch" id="pembongkaran">
                <label class="form-check-label" for="pembongkaran">Penghentian pembongkaran</label>
            </div>
            <div class="form-check form-switch mb-2">
                <input class="form-check-input" type="checkbox" role="switch" id="bidangHKI">
                <label class="form-check-label" for="bidangHKI">Penegahan di bidang HKI</label>
            </div>
        </div>
    </div>
</div> --}}



                    {{-- <!-- Nomor Identitas/ MAWB -->
        <div class="col-md-6 mb-3">
            <label>Nomor Identitas/ MAWB</label>
            <input type="text" class="form-control" placeholder="Nomor Identitas/ MAWB" id="no_passpor" name="no_passpor"  >
        </div>
        
        <!-- Nama Penumpang/ Pemilik -->
        <div class="col-md-6 mb-3">
            <label>Nama Penumpang/ Pemilik</label>
            <input type="text" class="form-control" placeholder="Nama Penumpang/ Pemilik">
        </div>
        
        <!-- Alamat E-mail/No. Hp -->
        <div class="col-md-6 mb-3">
            <label>Alamat E-mail/No. Hp</label>
            <input type="email" class="form-control" placeholder="Alamat Email">
        </div>
        <div class="col-md-6 mb-3">
            <label>&nbsp;</label>
            <input type="tel" class="form-control" placeholder="Nomor Hp">
        </div>
        
        <!-- Alamat -->
        <div class="col-md-12 mb-3">
            <label>Alamat</label>
            <textarea class="form-control" placeholder="Alamat"></textarea>
        </div>
        
        <!-- Pekerjaan -->
        <div class="col-md-12 mb-3">
            <label>Pekerjaan</label>
            <input type="text" class="form-control" placeholder="Pekerjaan">
        </div>

        <div class="col-md-12 mb-3">
            <label>Selaku</label>
            <select class="form-select">
                <option>- Pilih -</option>
                <!-- Add options here -->
            </select>
        </div>

        <div class="col-md-6 mb-3">
            <label>No. Flight</label>
            <input type="text" class="form-control" placeholder="259" readonly>
        </div>
        <div class="col-md-6 mb-3">
            <label>Nama Flight</label>
            <input type="text" class="form-control">
        </div> --}}
                  </div>

                  <!-- D. Objek Penindakan -->
                  <h6><b>D. Objek Penindakan</b></h6>
                  <hr>
                  <div class="card-body">
                    <div class="accordion accordion-flush" id="accordionFlushExample">
                      <div class="accordion-item">
                        <h2 class="accordion-header">
                          <button class="accordion-button btn bg-light fw-medium collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                            A. Sarana Pengangkut
                          </button>
                        </h2>
                        <div id="flush-collapseOne" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
                          <div class="accordion-body bg-light">
                            <div class="row mb-3">
                              <label for="data_sarkut" class="col-sm-4 col-form-label">ISI DATA</label>
                              <div class="col-sm-8">
                                <select id="data_sarkut" name="data_sarkut" class="form-select" onchange="toggleForm(this.value, 'flush-collapseOne')">
                                  <option value="TIDAK">TIDAK</option>
                                  <option value="YA">YA</option>
                                </select>
                              </div>
                            </div>

                            <!-- Form Inputs -->
                            <div class="row mb-3 form-group">
                              <label class="col-sm-4 col-form-label">Nama dan Jenis Sarkut</label>
                              <div class="col-sm-8">
                                <input type="text" class="form-control form-input" name="nama_jenis_sarkut" placeholder="Nama Dan Jenis Sarkut" disabled>
                              </div>
                            </div>
                            <div class="row mb-3 form-group">
                              <label class="col-sm-4 col-form-label">No. Voy/ Penerbangan/ Trayek</label>
                              <div class="col-sm-8">
                                <input type="text" class="form-control form-input" name="no_flight" placeholder="No. Voy/ Penerbangan/ Trayek" disabled>
                              </div>
                            </div>
                            <div class="row mb-3 form-group">
                              <label class="col-sm-4 col-form-label">Ukuran/ Kapasitas Muatan</label>
                              <div class="col-sm-8">
                                <input type="text" class="form-control form-input" name="kapasitas_muatan" placeholder="Ukuran/ Kapasitas Muatan" disabled>
                              </div>
                            </div>
                            <div class="row mb-3 form-group">
                              <label class="col-sm-4 col-form-label">Nahkoda/ Pilot/ Pengemudi</label>
                              <div class="col-sm-8">
                                <input type="text" class="form-control form-input" name="pengemudi" placeholder="Nahkoda/ Pilot/ Pengemudi" disabled>
                              </div>
                            </div>
                            <div class="row mb-3 form-group">
                              <label class="col-sm-4 col-form-label">No. Identitas Nahkoda/ Pilot/ Pengemudi</label>
                              <div class="col-sm-8">
                                <input type="text" class="form-control form-input" name="no_identitas_pengemudi" placeholder="No. Identitas Nahkoda/ Pilot/ Pengemudi" disabled>
                              </div>
                            </div>
                            <div class="row mb-3 form-group">
                              <label class="col-sm-4 col-form-label">Bendera</label>
                              <div class="col-sm-8">
                                <input type="text" class="form-control form-input" name="bendera" placeholder="Bendera" disabled>
                              </div>
                            </div>
                            <div class="row mb-3 form-group">
                              <label class="col-sm-4 col-form-label">Nomor Registrasi/ Polisi</label>
                              <div class="col-sm-8">
                                <input type="text" class="form-control form-input" name="no_polisi" placeholder="Nomor Registrasi/ Polisi" disabled>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="accordion-item">
                        <h2 class="accordion-header">
                          <button class="accordion-button btn bg-light fw-medium collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseTwo" aria-expanded="false" aria-controls="flush-collapseTwo">
                            B. Data Barang
                          </button>
                        </h2>
                        <div id="flush-collapseTwo" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
                          <div class="accordion-body bg-light">
                            <div class="row mb-3">
                              <label for="data_barang" class="col-sm-4 col-form-label">ISI DATA</label>
                              <div class="col-sm-8">
                                <select id="data_barang" name="data_barang" class="form-select" onchange="toggleForm(this.value, 'flush-collapseTwo')"> <!-- Ubah ID di sini -->
                                  <option value="TIDAK">TIDAK</option>
                                  <option value="YA">YA</option>
                                </select>
                              </div>
                            </div>

                            <!-- Form Inputs -->
                            <div class="row mb-3 form-group">
                              <label class="col-sm-4 col-form-label">Jumlah/Jenis/Ukuran/Nomor</label>
                              <div class="col-sm-8">
                                <input type="text" class="form-control form-input" placeholder="Jumlah/Jenis/Ukuran/Nomor" name="jumlah_jenis_ukuran_no" disabled>
                              </div>
                            </div>
                            <div class="row mb-3 form-group">
                              <label class="col-sm-4 col-form-label">Peti Kemasan / Kemasan</label>
                              <div class="col-sm-8">
                                <select class="form-control form-input select2" name="id_kemasan" disabled>
                                  <option value="" disabled selected>- Pilih -</option>
                                  @foreach ($kemasans as $kemasan)
                                    <option value="{{ $kemasan->id_kemasan }}">{{ $kemasan->nama_kemasan }}</option>
                                  @endforeach
                                </select>
                              </div>
                            </div>
                            {{-- <div class="row mb-3 form-group">
                <label class="col-sm-4 col-form-label">Jenis dan Jumlah Kemasan</label>
                <div class="col-sm-4">
                    <input type="text" class="form-control form-input" placeholder="-" disabled>
                </div>
                <div class="col-sm-4">
                    <input type="text" class="form-control form-input" placeholder="-" disabled>
                </div>
            </div> --}}
                            <div class="row mb-3 form-group">
                              <label class="col-sm-4 col-form-label">Jumlah Barang</label>
                              <div class="col-sm-8">
                                <input type="text" class="form-control form-input" placeholder="Jumlah Barang" name="jumlah_barang" disabled>
                              </div>
                            </div>
                            <div class="row mb-3 form-group">
                              <label class="col-sm-4 col-form-label">Jenis Barang</label>
                              <div class="col-sm-8">
                                <textarea class="form-control form-input" placeholder="Jenis Barang" name="jenis_barang" rows="2" disabled></textarea>
                              </div>
                            </div>

                            <div class="row mb-3 form-group">
                              <label class="col-sm-4 col-form-label">Jenis/Nomor dan Tgl. Dokumen</label>
                              <div class="col-sm-4">
                                <input type="text" class="form-control form-input" name="jenis_no_tgl_dok" placeholder="-" disabled>
                              </div>
                              <div class="col-sm-4">
                                <input type="date" class="form-control form-input" name="jenis_no_tgl_dok" placeholder="-" disabled>
                              </div>
                            </div>

                            <div class="row mb-3 form-group">
                              <label class="col-sm-4 col-form-label">Pemilik/Importir/Eksportir/Kuasa</label>
                              <div class="col-sm-8">
                                <input type="text" class="form-control form-input" name="pemilik" placeholder="Pemilik/Importir/Eksportir/ Kuasa" name="pemilik_importir" disabled>
                              </div>
                            </div>
                            <div class="row mb-3 form-group">
                              <label class="col-sm-4 col-form-label">No. Identitas Pemilik/Importir/Eksportir/Kuasa</label>
                              <div class="col-sm-8">
                                <input type="text" class="form-control form-input" name="no_identitas_pemilik" placeholder="No. Identitas Pemilik/Importir/Eksportir/Kuasa" name="no_identitas_pemilik_importir" disabled>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>

                      <div class="accordion-item">
                        <h2 class="accordion-header">
                          <button class="accordion-button btn bg-light fw-medium collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseThree" aria-expanded="false" aria-controls="flush-collapseThree">
                            C. Data Bangunan / Tempat
                          </button>
                        </h2>
                        <div id="flush-collapseThree" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
                          <div class="accordion-body bg-light">
                            <div class="row mb-3">
                              <label for="data_bangunan" class="col-sm-4 col-form-label">ISI DATA</label>
                              <div class="col-sm-8">
                                <select id="data_bangunan" name="data_bangunan" class="form-select" onchange="toggleForm(this.value, 'flush-collapseThree')"> <!-- Ubah ID di sini -->
                                  <option value="TIDAK">TIDAK</option>
                                  <option value="YA">YA</option>
                                </select>
                              </div>
                            </div>

                            {{-- form input --}}
                            <div class="row mb-3 form-group">
                              <label class="col-sm-4 col-form-label">Alamat Bangunan/Tempat</label>
                              <div class="col-sm-8">
                                <textarea class="form-control form-input" placeholder="Alamat Bangunan/ Tempat" name="alamat_bangunan" rows="2" disabled></textarea>
                              </div>
                            </div>

                            <div class="row mb-3 form-group">
                              <label class="col-sm-4 col-form-label">No Reg Bangunan | NPPBKC | DLL</label>
                              <div class="col-sm-8">
                                <input type="text" class="form-control form-input" placeholder="No Reg Bangunan | NPPBKC | DLL" name="no_bangunan" disabled>
                              </div>
                            </div>

                            <div class="row mb-3 form-group">
                              <label class="col-sm-4 col-form-label">Nama Pemilik | Yang Menguasai</label>
                              <div class="col-sm-8">
                                <input type="text" class="form-control form-input" placeholder="Nama Pemilik | Yang Menguasai" name="nama_pemilik_bangunan" disabled>
                              </div>
                            </div>

                            <div class="row mb-3 form-group">
                              <label class="col-sm-4 col-form-label">No. Identitas Pemilik | Yang Menguasai</label>
                              <div class="col-sm-8">
                                <input type="text" class="form-control form-input" placeholder="No. Identitas Pemilik | Yang Menguasai" name="no_identitas_pemilik_bangunan" disabled>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      {{-- <div class="accordion-item">
        <h2 class="accordion-header">
            <button class="accordion-button btn bg-light fw-medium collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseFour" aria-expanded="false" aria-controls="flush-collapseFour">
                D. Badan
            </button>
        </h2>
        <div id="flush-collapseFour" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
            <div class="accordion-body bg-light">
              <div class="row mb-3">
                <label for="badanSelect" class="col-sm-4 col-form-label">ISI DATA</label>
                <div class="col-sm-8">
                    <select id="badanSelect" class="form-select" onchange="toggleForm(this.value, 'flush-collapseFour')"> <!-- Ubah ID di sini -->
                        <option value="TIDAK">TIDAK</option>
                        <option value="YA">YA</option>
                    </select>
                </div>
            </div>

            
            <div class="row mb-3 form-group">
                <label class="col-sm-4 col-form-label">Nama</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control form-input" placeholder="-" disabled>
                </div>
            </div>

            <div class="row mb-3 form-group">
                <label class="col-sm-4 col-form-label">Tgl. Lahir | Kewarganegaraan</label>
                <div class="col-sm-4">
                    <input type="date" class="form-control form-input" placeholder="-" disabled>
                </div>
                <div class="col-sm-4">
                    <input type="text" class="form-control form-input" placeholder="-" disabled>
                </div>
            </div>

             <div class="row mb-3 form-group">
                <label class="col-sm-4 col-form-label">Alamat</label>
                <div class="col-sm-8">
                    <textarea class="form-control form-input" placeholder="-" rows="2" disabled></textarea>
                </div>
            </div>
            
            <div class="row mb-3 form-group">
                <label class="col-sm-4 col-form-label">Nomor Identitas</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control form-input" placeholder="-" disabled>
                </div>
            </div>

            </div>
        </div>
    </div> --}}

                    </div>
                  </div>

                </div>

                <!-- Right Column (Sections C, D, and E) -->
                <div class="col-lg-6">
                  <!-- C. Informasi Pelapor dan Hasil Penindakan -->
                  <h6><b>E. Data Penindakan</b></h6>
                  <hr>
                  <div class="row">
                    <div class="col-md-12 mb-3">
                      <label>Lokasi Penindakan</label>
                      <input type="text" class="form-control" name="lokasi_penindakan" placeholder="Lokasi Penindakan">
                    </div>
                    <div class="col-md-12 mb-3">
                      <label>Uraian Penindakan</label>
                      <textarea class="form-control" placeholder="Uraian Penindakan" name="uraian_penindakan" rows="2"></textarea>
                    </div>

                    <div class="col-md-12 mb-3">
                      <label>Alasan Penindakan</label>
                      <select class="form-control  select2" name="id_penindakan" id="alasan_penindakan">
                        <option value="" disabled selected>Pilih Alasan Penindakan</option>
                        @foreach ($jenisPelanggaran->unique('alasan_penindakan') as $jenis)
                          <option value="{{ $jenis->id_jenis_pelanggaran }}" data-jenis="{{ $jenis->jenis_pelanggaran }}">
                            {{ $jenis->alasan_penindakan }}
                          </option>
                        @endforeach
                      </select>
                    </div>

                    <div class="col-md-12 mb-3">
                      <label>Jenis Pelanggaran</label>
                      <textarea class="form-control form-input bg-primary text-white" id="jenis_pelanggaran" disabled></textarea>
                    </div>


                    <div class="col-md-6 mb-3">
                      <label>Tanggal Mulai</label>
                      <input type="date" class="form-control" placeholder="Tanggal" name="tgl_mulai" />
                    </div>

                    <div class="col-md-6 mb-3">
                      <label>Jam Mulai</label>
                      <input type="time" class="form-control" placeholder="Jam" name="jam_mulai" />
                    </div>

                    <div class="col-md-6 mb-3">
                      <label>Tanggal Berakhir</label>
                      <input type="date" class="form-control" placeholder="Tanggal" name="tgl_selesai" />
                    </div>
                    <div class="col-md-6 mb-3">
                      <label>Jam Berakhir</label>
                      <input type="time" class="form-control" placeholder="Jam" name="jam_selesai" />
                    </div>

                    <div class="col-md-12 mb-3">
                      <label>Hal Yang Terjadi</label>
                      <textarea class="form-control" placeholder="Hal Yang Terjadi" name="hal_yang_terjadi" rows="4"></textarea>
                    </div>
                  </div>



                </div>
              </div>
            </div>


            <div class="tab-pane" id="ba-henti" role="tabpanel">

            </div>


            <div class="tab-pane" id="ba-riksa" role="tabpanel">
              <div class="row">
                <!-- Left Column (Data Laporan Informasi) -->
                <div class="col-lg-6">
                  <h6><b>A. Data B.A Riksa</b></h6>
                  <hr>
                  <div class="row">
                    <div class="col-md-6 mb-3">
                      <label>No. B.A Riksa</label>
                      <input type="text" class="form-control bg-primary text-white" value="{{ old('no_ba_riksa', $no_ref->no_ba_riksa) }}" placeholder="No. B.A Riksa" name="no_ba_riksa" readonly>
                    </div>

                    <div class="col-md-6 mb-3">
                      <label>Tgl. </label>
                      <input type="date" class="form-control bg-primary text-white" name="tgl_ba_riksa">
                    </div>

                    <h6><b>B. Data Pemeriksaan</b></h6>
                    <hr>

                    <div class="col-md-12 mb-3">
                      <textarea class="form-control form-input" placeholder="Nama dan Jenis Sarkut" name="nama_jenis_sarkut_ba_riksa" rows="3"></textarea>
                    </div>

                    <div class="col-md-6 mb-3">
                      <label>No. Register</label>
                      <input type="text" class="form-control bg-primary text-white" placeholder="No register" name="no_register_ba_riksa">
                    </div>





                  </div>
                </div>

                <!-- Right Column (Pejabat Selection) -->
                <div class="col-lg-6">
                  <h6><b>C. Pejabat Penerima NI</b></h6>
                  <hr>
                  <div class="col-lg-12 mb-3">
                    <label for="id_pejabat_penerima_ni">Pejabat Penerima NI</label>
                    <select class="form-control form-select select2" id="id_pejabat_penerima_ni" name="id_pejabat_penerima_ni">
                      <option value="" selected disabled>- Pilih -</option>
                      @foreach ($users as $user)
                        <option value="{{ $user->id_admin }}">{{ $user->name }} | {{ $user->jabatan }}
                        </option>
                      @endforeach
                    </select>
                  </div>

                  <h6><b>D. Uraian Informasi</b></h6>
                  <hr>
                  <div class="card-body">
                    <div class="accordion accordion-flush" id="accordionFlushExample">
                      <div class="accordion-item">
                        <h2 class="accordion-header">
                          <button class="accordion-button btn bg-light fw-medium collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseqwe" aria-expanded="false" aria-controls="flush-collapseqwe">
                            1. Uraian Informasi Pertama
                          </button>
                        </h2>
                        <div id="flush-collapseqwe" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
                          <div class="accordion-body bg-light">


                            <div class="row mb-3 form-group">
                              <label class="col-sm-4 col-form-label">
                                Komoditi
                              </label>
                              <div class="col-sm-8">
                                <input type="text" class="form-control form-input" name="komoditi_ni" placeholder="Isi Komoditi">
                              </div>
                            </div>

                            <div class="row mb-3 form-group">
                              <label class="col-sm-4 col-form-label">
                                Kantor Tujuan
                              </label>
                              <div class="col-sm-8">
                                <input type="text" class="form-control form-input" placeholder="Isi Kantor Tujuan" name="kantor_ni">
                              </div>
                            </div>

                          </div>
                        </div>
                      </div>

                      <div class="accordion-item">
                        <h2 class="accordion-header">
                          <button class="accordion-button btn bg-light fw-medium collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapsebvc" aria-expanded="false" aria-controls="flush-collapsebvc">
                            2. Uraian Informasi Kedua
                          </button>
                        </h2>
                        <div id="flush-collapsebvc" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
                          <div class="accordion-body bg-light">

                            <div class="row mb-3 form-group">
                              <label class="col-sm-4 col-form-label">Nama PPJK/Ekspedisi</label>
                              <div class="col-sm-8">
                                <input type="text" class="form-control form-input" name="ppjk_ni" placeholder="Isi Nama PPJK/Ekspedisi">
                              </div>
                            </div>

                            <div class="row mb-3 form-group">
                              <label class="col-sm-4 col-form-label">No. Dokumen</label>
                              <div class="col-sm-8">
                                <input type="text" class="form-control form-input" name="nodok_ni" placeholder="Isi No. Dokumen">
                              </div>
                            </div>

                            <div class="row mb-3 form-group">
                              <label class="col-sm-4 col-form-label">Nama Pengirim</label>
                              <div class="col-sm-8">
                                <input type="text" class="form-control form-input" name="nama_pengirim_ni" placeholder="Isi Nama Pengirim">
                              </div>
                            </div>

                            <div class="row mb-3 form-group">
                              <label class="col-sm-4 col-form-label">Nomor Pengirim</label>
                              <div class="col-sm-8">
                                <input type="text" class="form-control form-input" name="nomor_pengirim_ni" placeholder="Isi Nomor Pengirim">
                              </div>
                            </div>

                            <div class="row mb-3 form-group">
                              <label class="col-sm-4 col-form-label">Nama Penerima</label>
                              <div class="col-sm-8">
                                <input type="text" class="form-control form-input" name="nama_penerima_ni" placeholder="Isi Nama Penerima">
                              </div>
                            </div>

                            <div class="row mb-3 form-group">
                              <label class="col-sm-4 col-form-label">Nomor Penerima</label>
                              <div class="col-sm-8">
                                <input type="text" class="form-control form-input" name="nomor_penerima_ni" placeholder="Isi Nomor Penerima">
                              </div>
                            </div>

                            <div class="row mb-3 form-group">
                              <label class="col-sm-4 col-form-label">Asal Barang</label>
                              <div class="col-sm-8">
                                <input type="text" class="form-control form-input" name="asal_barang_ni" placeholder="Isi Asal Barang">
                              </div>
                            </div>

                            <div class="row mb-3 form-group">
                              <label class="col-sm-4 col-form-label">Tujuan Barang</label>
                              <div class="col-sm-8">
                                <input type="text" class="form-control form-input" name="tujuan_barang_ni" placeholder="Isi Tujuan Barang">
                              </div>
                            </div>

                            <div class="row mb-3 form-group">
                              <label class="col-sm-4 col-form-label">Berat Barang</label>
                              <div class="col-sm-8">
                                <input type="text" class="form-control form-input" name="berat_barang_ni" placeholder="Isi Berat Barang">
                              </div>
                            </div>

                            <div class="row mb-3 form-group">
                              <label class="col-sm-4 col-form-label">Pemberitahuan Barang</label>
                              <div class="col-sm-8">
                                <input type="text" class="form-control form-input" name="pemberitahuan_barang_ni" placeholder="Isi Pemberitahuan Barang">
                              </div>
                            </div>

                            <div class="row mb-3 form-group">
                              <label class="col-sm-4 col-form-label">Komoditi Atensi</label>
                              <div class="col-sm-8">
                                <input type="text" class="form-control form-input" name="komoditi_atensi_ni" placeholder="Isi Komoditi Atensi">
                              </div>
                            </div>

                            <div class="row mb-3 form-group">
                              <label class="col-sm-4 col-form-label">Nama Sarana Pengangkut</label>
                              <div class="col-sm-8">
                                <input type="text" class="form-control form-input" name="sarkut_ni" placeholder="Isi Nama Sarana Pengangkut">
                              </div>
                            </div>

                            <div class="row mb-3 form-group">
                              <label class="col-sm-4 col-form-label">Estimasi Tiba</label>
                              <div class="col-sm-8">
                                <input type="text" class="form-control" name="estimasi_tiba_ni" id="datetime-datepicker" placeholder="Isi Estimasi Tiba">
                              </div>
                            </div>

                          </div>
                        </div>
                      </div>

                    </div>

                  </div>


                  <div class="col-lg-12 mb-3">
                    <label>Pejabat Penerbit NI</label>
                    <select class="form-control form-select select2" id="id_pejabat_penerbit_ni" name="id_pejabat_penerbit_ni">
                      <option value="" selected disabled>- Pilih -</option>
                      @foreach ($users as $user)
                        <option value="{{ $user->id_admin }}">{{ $user->name }} | {{ $user->jabatan }}
                        </option>
                      @endforeach
                    </select>
                  </div>


                </div>
              </div>
            </div>


            <div class="tab-pane" id="ba-riksa-badan" role="tabpanel">

            </div>


            <div class="tab-pane" id="soc" role="tabpanel">

            </div>


            <div class="tab-pane" id="doc" role="tabpanel">

            </div>

            <div class="tab-pane" id="ba-sarkut" role="tabpanel">
            </div>

            <div class="tab-pane" id="ba-contoh" role="tabpanel">
            </div>

            <div class="tab-pane" id="ba-dok" role="tabpanel">
            </div>

            <div class="tab-pane" id="ba-tegah" role="tabpanel">
            </div>

            <div class="tab-pane" id="ba-segel" role="tabpanel">
            </div>

            <div class="tab-pane" id="ba-titip" role="tabpanel">
            </div>

            <div class="tab-pane" id="bpc" role="tabpanel">
            </div>




          </div>
      </div>
    </div>


    {{-- <!-- E. Penggunaan Penangguhan/Pelekatan Segel -->
<h6>E. Penggunaan/ Penempatan/ Peletakan Segel</h6>
<hr>
<div class="row">
    <div class="col-md-6 mb-3">
        <label>Jumlah/Jenis Segel</label>
        <input type="number" class="form-control" value="0">
    </div>
    <div class="col-md-6 mb-3">
        <label>&nbsp;</label>
        <input type="text" class="form-control" value="KERTAS" readonly>
    </div>
    <div class="col-md-12 mb-3">
        <label>Penempatan/Peletakan Segel</label>
        <select class="form-select">
            <option selected>- Pilih -</option>
        </select>
    </div>
</div> --}}

    <div class="card-footer d-flex justify-content-end">
      <button type="submit" class="btn btn-success btn-sm me-2">
        <i data-feather="save"></i> Simpan Data SBP
      </button>
    </div>
  </div>
  </div>
  </div>


  </div>
  </form>
  </div>
  </div>

  <script>
    {
      selectId: "ba-henti-select",
      tabId: "ba-henti-tab-item"
    }, {
      selectId: "bpc-select",
      tabId: "bpc-tab-item"
    }
  </script>

  <script>
    document.addEventListener("DOMContentLoaded", function() {
      const tabMappings = [{
          selectId: "ba-riksa-select",
          tabId: "ba-riksa-tab-item"
        },
        {
          selectId: "ba-riksa-badan-select",
          tabId: "ba-riksa-badan-tab-item"
        },
        {
          selectId: "soc-select",
          tabId: "soc-tab-item"
        },
        {
          selectId: "doc-select",
          tabId: "doc-tab-item"
        },
        {
          selectId: "ba-sarkut-select",
          tabId: "ba-sarkut-tab-item"
        },
        {
          selectId: "ba-contoh-select",
          tabId: "ba-contoh-tab-item"
        },
        {
          selectId: "ba-dok-select",
          tabId: "ba-dok-tab-item"
        },
        {
          selectId: "ba-tegah-select",
          tabId: "ba-tegah-tab-item"
        },
        {
          selectId: "ba-segel-select",
          tabId: "ba-segel-tab-item"
        },
        {
          selectId: "ba-titip-select",
          tabId: "ba-titip-tab-item"
        }
      ];

      const handleTabVisibility = (selectElement, tabElement) => {
        if (selectElement.value === "YA") {
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
      };

      tabMappings.forEach(({
        selectId,
        tabId
      }) => {
        const selectElement = document.getElementById(selectId);
        const tabElement = document.getElementById(tabId);

        if (selectElement && tabElement) {
          selectElement.addEventListener("change", () => handleTabVisibility(selectElement, tabElement));

          handleTabVisibility(selectElement, tabElement);
        }
      });
    });
  </script>

  <style>
    .nav-link.highlight {
      color: #287F71 !important;
      transition: background-color 0.5s ease;
    }

    .fade-in {
      animation: fadeIn 0.5s;
    }

    @keyframes fadeIn {
      from {
        opacity: 0;
      }

      to {
        opacity: 1;
      }
    }
  </style>

  <script>
    feather.replace();
  </script>

  <script>
    document.addEventListener("DOMContentLoaded", function() {
      $('#alasan_penindakan').select2();

      $('#alasan_penindakan').on('select2:select', function(e) {
        const selectedOption = e.params.data.element;
        const jenisPelanggaran = selectedOption.getAttribute("data-jenis");

        console.log("Jenis Pelanggaran Terpilih:", jenisPelanggaran);

        document.getElementById("jenis_pelanggaran").value = jenisPelanggaran || "Jenis pelanggaran tidak tersedia";
      });
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
    document.addEventListener("DOMContentLoaded", function() {
      let tahun = new Date().getFullYear();
      let random_number = Math.floor(Math.random() * 9000000) + 1000000;
      let id_sbp = tahun.toString() + random_number;

      let inputElement = document.getElementById('id_sbp_test');
      if (inputElement) {
        inputElement.value = id_sbp;
        console.log("Nilai id_sbp yang diset pada input test: ", id_sbp);
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
    function generateUniqueID() {
      const timestamp = Date.now();
      const randomNum = Math.floor(Math.random() * 1000000);
      return `id_sbp_${timestamp}_${randomNum}`;
    }

    document.getElementById('id_sbp').value = generateUniqueID();
  </script>
@endsection

@section('script')
  @vite(['resources/js/pages/datatable.init.js'])
@endsection
