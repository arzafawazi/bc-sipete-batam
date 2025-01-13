@extends('layouts.vertical', ['title' => 'Rekam Form Pasca Penindakan'])

@section('css')
  @vite(['node_modules/datatables.net-bs5/css/dataTables.bootstrap5.min.css', 'node_modules/datatables.net-buttons-bs5/css/buttons.bootstrap5.min.css', 'node_modules/datatables.net-keytable-bs5/css/keyTable.bootstrap5.min.css', 'node_modules/datatables.net-responsive-bs5/css/responsive.bootstrap5.min.css', 'node_modules/datatables.net-select-bs5/css/select.bootstrap5.min.css'])
@endsection


@section('content')
  <div class="container-fluid">
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
        <form action="{{ route('pasca-penindakan.store') }}" method="POST">
          @csrf

          <div class="card">

            <div class="row">
              <div class="col-md-3">
                <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                  <a class="nav-link mb-2 active" id="lphp-tab" data-bs-toggle="pill" href="#lphp" role="tab" aria-controls="lphp" aria-selected="true">
                    <span class="d-block d-sm-none">(LPHP)</span>
                    <span class="d-none d-sm-block">Laporan Penentuan Hasil Penindakan (LPHP)</span>
                  </a>
                  <a class="nav-link mb-2" id="bast-pemilik-tab" data-bs-toggle="pill" href="#bast-pemilik" role="tab" aria-controls="bast-pemilik" aria-selected="false">
                    <span class="d-block d-sm-none">(BAST Pemilik)</span>
                    <span class="d-none d-sm-block">BAST Pemilik</span>
                  </a>
                  <a class="nav-link mb-2" id="bast-instansi-tab" data-bs-toggle="pill" href="#bast-instansi" role="tab" aria-controls="bast-instansi" aria-selected="false">
                    <span class="d-block d-sm-none">(BAST Instansi)</span>
                    <span class="d-none d-sm-block">BAST Instansi</span>
                  </a>
                  <a class="nav-link mb-2" id="lp-tab" data-bs-toggle="pill" href="#lp" role="tab" aria-controls="lp" aria-selected="false">
                    <span class="d-block d-sm-none">(LP)</span>
                    <span class="d-none d-sm-block">Laporan Pelanggaran (LP)</span>
                  </a>
                  <a class="nav-link mb-2" id="bast-penyidik-tab" data-bs-toggle="pill" href="#bast-penyidik" role="tab" aria-controls="bast-penyidik" aria-selected="false">
                    <span class="d-block d-sm-none">BAST Penyidik</span>
                    <span class="d-none d-sm-block">BAST Penyidik</span>
                  </a>
                  <a class="nav-link mb-2" id="ba-dok-tab" data-bs-toggle="pill" href="#ba-dok" role="tab" aria-controls="ba-dok" aria-selected="false">
                    <span class="d-block d-sm-none">(LPT)</span>
                    <span class="d-none d-sm-block">Laporan Pelaksana Tugas (LPT)</span>
                  </a>
                  {{-- <a class="nav-link" id="ba-tegah-tab" data-bs-toggle="pill" href="#ba-tegah" role="tab" aria-controls="ba-tegah" aria-selected="false">
                    <span class="d-block d-sm-none">(B.A Tegah)</span>
                    <span class="d-none d-sm-block">B.A Tegah</span>
                  </a>
                  <a class="nav-link" id="ba-segel-tab" data-bs-toggle="pill" href="#ba-segel" role="tab" aria-controls="ba-segel" aria-selected="false">
                    <span class="d-block d-sm-none">(B.A Segel)</span>
                    <span class="d-none d-sm-block">B.A Segel</span>
                  </a>
                  <a class="nav-link" id="ba-titip-tab" data-bs-toggle="pill" href="#ba-titip" role="tab" aria-controls="ba-titip" aria-selected="false">
                    <span class="d-block d-sm-none">(B.A Titip)</span>
                    <span class="d-none d-sm-block">B.A Titip</span>
                  </a>
                  <a class="nav-link" id="bpc-tab-content" data-bs-toggle="pill" href="#bpc" role="tab" aria-controls="bpc" aria-selected="false">
                    <span class="d-block d-sm-none">(BPC)</span>
                    <span class="d-none d-sm-block">Blokir Pita Cukai</span>
                  </a>
                  <a class="nav-link" id="tolak1-tab-content" data-bs-toggle="pill" href="#tolak1" role="tab" aria-controls="tolak1" aria-selected="false">
                    <span class="d-block d-sm-none">(B.A Tolak 1)</span>
                    <span class="d-none d-sm-block">B.A Tolak Pertama</span>
                  </a>
                  <a class="nav-link" id="tolak2-tab-content" data-bs-toggle="pill" href="#tolak2" role="tab" aria-controls="tolak2" aria-selected="false">
                    <span class="d-block d-sm-none">(B.A Tolak 2)</span>
                    <span class="d-none d-sm-block">B.A Tolak Kedua</span>
                  </a> --}}
                </div>

              </div>

              <div class="col-md-9">
                <div class="overflow-auto" style="max-height: 408px;  padding: 10px;">
                  <div class="tab-content p-0 text-muted mt-md-0" id="v-pills-tabContent">


                    <div class="tab-pane fade show active" id="lphp" role="tabpanel" aria-labelledby="lphp-tab">
                      <div class="tab-pane" id="lphp" role="tabpanel">
                        <div class="row">
                          <div class="col-lg-6">
                            <h6><b>Data Referensi</b></h6>
                            <hr>
                            <div class="row">
                              <input type="hidden" id="id_pasca_penindakan" name="id_pasca_penindakan" value="">
                              <input type="hidden" name="id_penindakan_ref" value="{{ old('id_penindakan', $penindakan->id_penindakan) }}">
                              <div class="col-md-6 mb-3">
                                <label>No. SBP</label>
                                <input type="text" class="form-control bg-primary text-white" value="{{ old('no_sbp', $penindakan->no_sbp) }}" readonly>
                              </div>

                              <div class="col-md-6 mb-3">
                                <label>Tgl. SBP</label>
                                <input type="text" class="form-control bg-prima bg-primary text-white" value="{{ old('tgl_sbp', $penindakan->tgl_sbp) }}" readonly>
                              </div>

                              <h6><b>A. Data Awal</b></h6>
                              <hr>

                              <div class="col-md-6 mb-3">
                                <label>No. LPHP</label>
                                <input type="text" class="form-control bg-primary text-white" name="no_lphp" value="{{ old('no_lphp', $no_ref->no_lphp) }}" readonly>
                              </div>
                              <div class="col-md-6 mb-3">
                                <label>Tgl. LPHP</label>
                                <input type="date" class="form-control bg-primary text-white" placeholder="yyyy-mm-dd" name="tgl_lphp">
                              </div>

                              <div class="col-lg-12 mb-3">
                                <label>Kepala Bidang Penindakan</label>
                                <select class="form-control form-select select2" name="kepala_bidang_penindakan_display" id="kepala_bidang_penindakan" disabled>
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
                                <select class="form-control form-select select2" name="id_kepala_seksi_penindakan">
                                  <option value="" selected disabled>- Pilih -</option>
                                  @foreach ($users as $user)
                                    <option value="{{ $user->id_admin }}">{{ $user->name }} | {{ $user->jabatan }}
                                    </option>
                                  @endforeach
                                </select>
                              </div>

                            </div>

                          </div>

                          <div class="col-lg-6">
                            <h6><b>B. Data Lainnya</b></h6>
                            <hr>

                            <div class="col-md-12 mb-3">
                              <label class="d-flex align-items-center">
                                Catatan
                                {{-- <button type="button" class="btn p-0 ms-1 text-primary" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip"
                                  data-bs-title="Diisi dengan mengapit #isi# disetiap point, dan enter untuk baris baru untuk point baru">
                                  <i data-feather="alert-circle" style="width: 18px; height: 18px;"></i>
                                </button> --}}
                              </label>
                              <textarea class="form-control" rows="14" placeholder="Catatan" name="catatan_lphp"></textarea>
                            </div>
                          </div>

                          <div class="col-md-12 mb-3">
                            <label class="d-flex align-items-center">
                              Analisis Hasil Penindakan
                              <button type="button" class="btn p-0 ms-1 text-primary" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip"
                                data-bs-title="Diisi dengan mengapit #isi# disetiap point, dan enter untuk baris baru untuk point baru">
                                <i data-feather="alert-circle" style="width: 18px; height: 18px;"></i>
                              </button>
                            </label>
                            <textarea class="form-control" rows="5" placeholder="Analisis Hasil Penindakan" name="analisis_hasil_penindakan_lphp"></textarea>
                          </div>

                          <div class="card-body">
                            <div class="accordion accordion-flush" id="accordionFlushExample">
                              <div class="accordion-item">
                                <h2 class="accordion-header">
                                  <button class="accordion-button btn bg-light fw-medium collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                                    A. Terjadinya Dugaan Pelanggaran ?
                                  </button>
                                </h2>
                                <div id="flush-collapseOne" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
                                  <div class="accordion-body bg-light">

                                    <div class="row mb-3">
                                      <label for="data_sarkut" class="col-sm-4 col-form-label">ISI DATA</label>
                                      <div class="col-sm-8">
                                        <select id="dugaan_pelanggaran" name="dugaan_pelanggaran" class="form-control form-select select2" onchange="toggleForm(this.value, 'flush-collapseOne'); toggleTabs(this.value);">
                                          <option value="" selected disabled>- Pilih -</option>
                                          <option value="TIDAK">TIDAK</option>
                                          <option value="YA">YA</option>
                                        </select>
                                      </div>
                                    </div>

                                    <!-- Form Inputs -->
                                    <div class="col-lg-12 mb-3">
                                      <label class="col-sm-10 col-form-label">Dugaan Pelanggaran</label>
                                      <select class="form-control form-input form-select select2" name="dugaan_pelanggaran_lphp" disabled>
                                        <option value="" selected disabled>- Pilih -</option>
                                        @foreach ($jenisPelanggaran as $pelanggaran)
                                          <option value="{{ $pelanggaran->alasan_penindakan }} ({{ $pelanggaran->jenis_pelanggaran }})">{{ $pelanggaran->alasan_penindakan }} ({{ $pelanggaran->jenis_pelanggaran }})
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


                    <div class="tab-pane fade" id="bast-pemilik" role="tabpanel" aria-labelledby="bast-pemilik-tab">
                      <div class="row">
                        <div class="col-lg-6">

                          <h6><b>A. Data Awal</b></h6>
                          <hr>

                          <div class="row">
                            <div class="col-md-6 mb-3">
                              <label>No. BAST Pemilik</label>
                              <input type="text" class="form-control bg-primary text-white" name="no_bast_pemilik" value="{{ old('no_bast_pemilik', $no_ref->no_bast_pemilik) }}" readonly>
                            </div>
                            <div class="col-md-6 mb-3">
                              <label>Tgl. BAST Pemilik</label>
                              <input type="date" class="form-control bg-primary text-white" placeholder="yyyy-mm-dd" name="tgl_bast_pemilik">
                            </div>

                          </div>

                        </div>



                        <!-- Right Column (Sections C, D, and E) -->
                        <div class="col-lg-6">
                          <h6><b>B. Data Lainnya</b></h6>
                          <hr>

                          <div class="col-lg-12 mb-3">
                            <label>Pejabat Yang Menyerahkan</label>
                            <select class="form-control form-select select2" name="id_pejabat_1_bast_pemilik">
                              <option value="" selected disabled>- Pilih -</option>
                              @foreach ($users as $user)
                                <option value="{{ $user->id_admin }}">{{ $user->name }} | {{ $user->jabatan }}
                                </option>
                              @endforeach
                            </select>
                          </div>

                          <div class="col-lg-12 mb-3">
                            <label>Pejabat 1 Yang Menyaksikan </label>
                            <select class="form-control form-select select2" name="id_pejabat_2_bast_pemilik">
                              <option value="" selected disabled>- Pilih -</option>
                              @foreach ($users as $user)
                                <option value="{{ $user->id_admin }}">{{ $user->name }} | {{ $user->jabatan }}
                                </option>
                              @endforeach
                            </select>
                          </div>

                          <div class="col-lg-12 mb-3">
                            <label>Pejabat 2 Yang Menyaksikan </label>
                            <select class="form-control form-select select2" name="id_pejabat_3_bast_pemilik">
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

                    <div class="tab-pane fade" id="bast-instansi" role="tabpanel" aria-labelledby="bast-instansi-tab">
                      <div class="row">
                        <div class="col-lg-6">

                          <h6><b>A. Data Awal</b></h6>
                          <hr>

                          <div class="row">
                            <div class="col-md-6 mb-3">
                              <label>No. BAST Instansi</label>
                              <input type="text" class="form-control bg-primary text-white" name="no_bast_instansi" value="{{ old('no_bast_instansi', $no_ref->no_bast_instansi) }}" readonly>
                            </div>
                            <div class="col-md-6 mb-3">
                              <label>Tgl. BAST Instansi</label>
                              <input type="date" class="form-control bg-primary text-white" placeholder="yyyy-mm-dd" name="tgl_bast_instansi">
                            </div>

                            <div class="col-lg-12 mb-3">
                              <label>Pejabat Yang Menyerahkan</label>
                              <select class="form-control form-select select2" name="id_pejabat_1_bast_instansi">
                                <option value="" selected disabled>- Pilih -</option>
                                @foreach ($users as $user)
                                  <option value="{{ $user->id_admin }}">{{ $user->name }} | {{ $user->jabatan }}
                                  </option>
                                @endforeach
                              </select>
                            </div>



                          </div>

                        </div>



                        <!-- Right Column (Sections C, D, and E) -->
                        <div class="col-lg-6">
                          <h6><b>B. Data Lainnya</b></h6>
                          <hr>


                          <div class="col-lg-12 mb-3">
                            <label>Pejabat 1 Yang Menyaksikan </label>
                            <select class="form-control form-select select2" name="id_pejabat_2_bast_instansi">
                              <option value="" selected disabled>- Pilih -</option>
                              @foreach ($users as $user)
                                <option value="{{ $user->id_admin }}">{{ $user->name }} | {{ $user->jabatan }}
                                </option>
                              @endforeach
                            </select>
                          </div>

                          <div class="col-lg-12 mb-3">
                            <label>Pejabat 2 Yang Menyaksikan </label>
                            <select class="form-control form-select select2" name="id_pejabat_3_bast_instansi">
                              <option value="" selected disabled>- Pilih -</option>
                              @foreach ($users as $user)
                                <option value="{{ $user->id_admin }}">{{ $user->name }} | {{ $user->jabatan }}
                                </option>
                              @endforeach
                            </select>
                          </div>

                        </div>

                        <div class="card-body">
                          <div class="accordion accordion-flush" id="accordionFlushExample">
                            <div class="accordion-item">
                              <h2 class="accordion-header">
                                <button class="accordion-button btn bg-light fw-medium collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOnet" aria-expanded="false" aria-controls="flush-collapseOnet">
                                  A. Diserahkan Kepada
                                </button>
                              </h2>
                              <div id="flush-collapseOnet" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
                                <div class="accordion-body bg-light">


                                  <!-- Form Inputs -->
                                  <div class="col-md-12 mb-3">
                                    <label>Nama Penerima</label>
                                    <input type="text" class="form-control form-input" placeholder="Nama Penerima" name="nama_penerima_bast_instansi">
                                  </div>

                                  <div class="col-lg-12 mb-3">
                                    <label>Jenis Identitas Penerima</label>
                                    <input type="text" class="form-control form-input" placeholder="Jenis Identitas" name="jenis_iden_bast_instansi">
                                  </div>

                                  <div class="col-md-12 mb-3">
                                    <label>NRP/Identitas</label>
                                    <input type="text" class="form-control form-input" placeholder="NRP/Identitas" name="identitas_bast_instansi">
                                  </div>

                                  <div class="col-md-12 mb-3">
                                    <label>Menerima penyerahan untuk/atas nama</label>
                                    <input type="text" class="form-control form-input" value="Kantor Pelayanan Utama Bea dan Cukai Tipe B Batam" name="atas_nama_bast_instansi">
                                  </div>

                                  <div class="col-md-12 mb-3">
                                    <label>Penyerahan dilaksanakan dalam rangka</label>
                                    <textarea class="form-control" rows="4" placeholder="Penyerahan dilaksanakan dalam rangka" name="penyerahan_bast_instansi"></textarea>
                                  </div>


                                </div>
                              </div>
                            </div>

                          </div>
                        </div>
                      </div>
                    </div>


                    <div class="tab-pane fade" id="lp" role="tabpanel" aria-labelledby="lp-tab">
                      <div class="tab-pane" id="lp" role="tabpanel">
                        <div class="row">
                          <div class="col-lg-6">
                            <h6><b>A. Data Awal</b></h6>
                            <hr>
                            <div class="row">
                              <div class="col-md-6 mb-3">
                                <label>No. LP</label>
                                <input type="text" class="form-control bg-primary text-white" name="no_lp" value="{{ old('no_lp', $no_ref->no_lp) }}" readonly>
                              </div>
                              <div class="col-md-6 mb-3">
                                <label>Tgl. LP</label>
                                <input type="date" class="form-control bg-primary text-white" placeholder="yyyy-mm-dd" name="tgl_lp">
                              </div>
                            </div>

                            <div class="col-md-12 mb-3">
                              <label class="d-flex align-items-center">
                                Uraian Penindakan
                                <button type="button" class="btn p-0 ms-1 text-primary" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip"
                                  data-bs-title="Diisi dengan mengapit #isi# disetiap point, dan enter untuk baris baru untuk point baru">
                                  <i data-feather="alert-circle" style="width: 18px; height: 18px;"></i>
                                </button>
                              </label>
                              <textarea class="form-control" rows="3" placeholder="Uraian Penindakan" name="uraian_penindakan_lp"></textarea>
                            </div>

                            <div class="row">

                              <div class="col-lg-12 mb-3">
                                <label>Locus</label>
                                <select class="form-control form-select select2" name="locus_lp">
                                  <option value="" selected disabled>- Pilih -</option>
                                  @foreach ($locus as $tempat)
                                    <option value="{{ $tempat->locus }}">{{ $tempat->locus }}
                                    </option>
                                  @endforeach
                                </select>
                              </div>

                              <div class="col-md-12 mb-3">
                                <label>Tempus</label>
                                <input type="text" class="form-control" name="tempus_lp" id="datetime-datepicker" placeholder="Tempus">
                              </div>
                            </div>

                          </div>



                          <!-- Right Column (Sections C, D, and E) -->
                          <div class="col-lg-6">
                            <!-- C. Informasi Pelapor dan Hasil Penindakan -->
                            <h6><b>B. Data Lainnya</b></h6>
                            <hr>

                            <div class="col-md-12 mb-3">
                              <label class="d-flex align-items-center">
                                Uraian Modus
                                <button type="button" class="btn p-0 ms-1 text-primary" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip"
                                  data-bs-title="Diisi dengan mengapit #isi# disetiap point, dan enter untuk baris baru untuk point baru">
                                  <i data-feather="alert-circle" style="width: 18px; height: 18px;"></i>
                                </button>
                              </label>
                              <textarea class="form-control" rows="3" placeholder="Uraian Modus" name="uraian_modus_lp"></textarea>
                            </div>

                            <div class="col-md-12 mb-3">
                              <label class="d-flex align-items-center">
                                Barang Lain Yang Terkait
                              </label>
                              <textarea class="form-control" rows="3" placeholder="Barang Lain Yang Terkait" name="barang_lain_lp"></textarea>
                            </div>

                          </div>
                        </div>
                      </div>
                    </div>

                    <div class="tab-pane fade" id="bast-penyidik" role="tabpanel" aria-labelledby="bast-penyidik-tab">
                      <div class="row">
                        <div class="col-lg-6">

                          <h6><b>A. Data Awal</b></h6>
                          <hr>

                          <div class="row">
                            <div class="col-md-6 mb-3">
                              <label>No. BAST Penyidik</label>
                              <input type="text" class="form-control bg-primary text-white" name="no_bast_penyidik" value="{{ old('no_bast_penyidik', $no_ref->no_bast_penyidik) }}" readonly>
                            </div>
                            <div class="col-md-6 mb-3">
                              <label>Tgl. BAST Penyidik</label>
                              <input type="date" class="form-control bg-primary text-white" placeholder="yyyy-mm-dd" name="tgl_bast_penyidik">
                            </div>

                            <div class="col-lg-12 mb-3">
                              <label>Pejabat Yang Menyerahkan</label>
                              <select class="form-control form-select select2" name="id_pejabat_1_bast_penyidik">
                                <option value="" selected disabled>- Pilih -</option>
                                @foreach ($users as $user)
                                  <option value="{{ $user->id_admin }}">{{ $user->name }} | {{ $user->jabatan }}
                                  </option>
                                @endforeach
                              </select>
                            </div>

                          </div>

                        </div>



                        <!-- Right Column (Sections C, D, and E) -->
                        <div class="col-lg-6">
                          <h6><b>B. Data Lainnya</b></h6>
                          <hr>


                          <div class="col-lg-12 mb-3">
                            <label>Pejabat Yang Menerima</label>
                            <select class="form-control form-select select2" name="id_pejabat_2_bast_penyidik">
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

                    <div class="tab-pane fade" id="ba-dok" role="tabpanel" aria-labelledby="ba-dok-tab">
                      <div class="tab-pane" id="ba-dok" role="tabpanel">
                        <div class="row">
                          <div class="col-lg-6">
                            <h6><b>Data Referensi</b></h6>
                            <hr>
                            <div class="row">
                              <div class="col-md-12 mb-3">
                                <label>Kategori Penindakan</label>
                                <input type="text" class="form-control bg-primary text-white" value="{{ old('opsi_penindakan', $penindakan->opsi_penindakan) }}" readonly>
                              </div>

                              <div class="col-md-12 mb-3">
                                <label>Referensi Free Entry</label>
                                <select class="form-control form-select select2" name="data_free_entry" id="data_free_entry">
                                  <option value="" selected disabled>- Pilih -</option>
                                  <option value="YA">Free Entry</option>
                                  <option value="Tidak">Bukan Free Entry</option>
                                </select>
                              </div>

                              <div class="col-md-12 mb-3" id="no_free_entry" style="display: none;">
                                <label>Format Free Entry</label>
                                <input type="text" class="form-control bg-primary text-white" name="format_free_entry">
                              </div>

                              <div class="col-md-12 mb-3" id="tgl_free_entry" style="display: none;">
                                <label>Tgl. Surat Referensi LPT</label>
                                <input type="date" class="form-control bg-primary text-white" placeholder="yyyy-mm-dd" name="tgl_free_entry">
                              </div>



                            </div>

                            <script>
                              document.addEventListener('DOMContentLoaded', function() {
                                var selectElement = $('#data_free_entry'); // Select element using jQuery for select2
                                var noFreeEntry = document.getElementById('no_free_entry');
                                var tglFreeEntry = document.getElementById('tgl_free_entry');

                                // Initialize select2 on the select element
                                selectElement.select2();

                                // Use on change for select2 instead of the standard event
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

                            <h6><b>A. Data Awal</b></h6>
                            <hr>
                            <div class="row">
                              <div class="col-md-6 mb-3">
                                <label>No. LPT</label>
                                <input type="text" class="form-control bg-primary text-white" name="no_lpt_penindakan" value="{{ old('no_lpt_penindakan', $no_ref->no_lpt_penindakan) }}" readonly>
                              </div>
                              <div class="col-md-6 mb-3">
                                <label>Tgl. LPT</label>
                                <input type="date" class="form-control bg-primary text-white" placeholder="yyyy-mm-dd" name="tgl_lpt">
                              </div>
                            </div>

                            <div class="row">
                              <div class="col-md-6 mb-3">
                                <div class="form-group">
                                  <label class="col-form-label">Waktu Mulai Tugas</label>
                                  <input type="text" class="form-control" name="waktu_pelaksanaan_tugas_lpt" id="datetime-datepicker" placeholder="Waktu Pelaksanaan Tugas">
                                </div>
                              </div>

                              <div class="col-md-6 mb-3">
                                <div class="form-group">
                                  <label class="col-form-label">Waktu Selesai Tugas</label>
                                  <input type="text" class="form-control" name="waktu_selesai_tugas_lpt" id="datetime-datepicker" placeholder="Waktu Selesai Tugas">
                                </div>
                              </div>
                            </div>

                            <div class="col-md-12 mb-3">
                              <label class="d-flex align-items-center">Uraian Pelaksanaan Tugas</label>
                              <textarea class="form-control" rows="4" placeholder="Uraian Pelaksanaan Tugas" name="uraian_lpt"></textarea>
                            </div>

                            <div class="col-md-12 mb-3">
                              <label>Wilayah Tugas</label>
                              <input type="text" class="form-control" placeholder="Wilayah Tugas" name="wilayah_tugas_lpt">
                            </div>
                          </div>



                          <!-- Right Column (Sections C, D, and E) -->
                          <div class="col-lg-6">
                            <!-- C. Informasi Pelapor dan Hasil Penindakan -->
                            <h6><b>B. Data Lainnya</b></h6>
                            <hr>

                            <div class="col-md-12 mb-3">
                              <label class="d-flex align-items-center">
                                Tindak Lanjut
                              </label>
                              <textarea class="form-control" rows="4" placeholder="Tindak Lanjut" name="tindak_lanjut_lpt"></textarea>
                            </div>

                            <div class="col-md-12 mb-3">
                              <label class="d-flex align-items-center">
                                Kesimpulan
                              </label>
                              <textarea class="form-control" rows="4" placeholder="Kesimpulan Laporan Pelaksana Tugas" name="kesimpulan_lpt"></textarea>
                            </div>

                            <div class="col-md-12 mb-3">
                              <label class="d-flex align-items-center">
                                Catatan
                              </label>
                              <textarea class="form-control" rows="4" placeholder="Catatan" name="catatan_lpt"></textarea>
                            </div>

                            <div class="col-lg-12 mb-3">
                              <label>Pelaksana Harian</label>
                              <select class="form-control form-select select2" name="plh">
                                <option value="" selected disabled>- Pilih -</option>
                                <option value="Plh">Pelaksana Harian</option>
                                <option value="">Tidak Pelaksana Harian</option>
                              </select>
                            </div>


                          </div>
                        </div>
                      </div>
                    </div>


                  </div>

                </div><!-- end col -->
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
    function generateUniqueID() {
      const timestamp = Date.now();
      const randomNum = Math.floor(Math.random() * 1000000);
      return `id_penindakan_${timestamp}_${randomNum}`;
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
      const tabsToShow = selectedValue === "YA" ? ["bast-instansi-tab", "lp-tab", "bast-penyidik-tab", "ba-dok-tab"] :
        selectedValue === "TIDAK" ? ["bast-pemilik-tab"] : [];


      const allTabs = ["bast-pemilik-tab", "bast-instansi-tab", "lp-tab", "bast-penyidik-tab", "ba-dok-tab"];
      allTabs.forEach(tabId => {
        const tab = document.getElementById(tabId);
        tab.style.display = "none";
        tab.classList.remove("tab-highlight");
      });

      tabsToShow.forEach(tabId => {
        const tab = document.getElementById(tabId);
        tab.style.display = "block";
        tab.classList.add("tab-highlight");

        setTimeout(() => {
          tab.classList.remove("tab-highlight");
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
  </style>
@endsection
@section('script')
  @vite(['resources/js/pages/datatable.init.js'])
@endsection
