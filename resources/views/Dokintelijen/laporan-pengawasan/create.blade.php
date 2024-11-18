@extends('layouts.vertical', ['title' => 'Rekam Laporan Pengawasan'])

@section('css')
  @vite(['node_modules/datatables.net-bs5/css/dataTables.bootstrap5.min.css', 'node_modules/datatables.net-buttons-bs5/css/buttons.bootstrap5.min.css', 'node_modules/datatables.net-keytable-bs5/css/keyTable.bootstrap5.min.css', 'node_modules/datatables.net-responsive-bs5/css/responsive.bootstrap5.min.css', 'node_modules/datatables.net-select-bs5/css/select.bootstrap5.min.css'])
@endsection

@section('content')
  <div class="container-fluid ">
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

                <div class="tabs-container" id="tabs-container">
                  <ul class="nav nav-pills nav-justified flex-nowrap overflow-auto bg-light p-2 rounded shadow-sm" style="white-space: nowrap;" role="tablist">
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
                    <li class="nav-item" id="nhi-tab-item" style="display: none;">
                      <a class="nav-link" id="nhi-tab" data-bs-toggle="tab" href="#nhi" role="tab" aria-controls="nhi" aria-selected="false">
                        <span class="d-block d-sm-none">NHI/NHI-HKI</span>
                        <span class="d-none d-sm-block">NHI/NHI-HKI</span>
                      </a>
                    </li>
                    <li class="nav-item" id="ni-tab-item" style="display: none;">
                      <a class="nav-link" id="ni-tab" data-bs-toggle="tab" href="#ni" role="tab" aria-controls="ni" aria-selected="false">
                        <span class="d-block d-sm-none">NI</span>
                        <span class="d-none d-sm-block">NI</span>
                      </a>
                    </li>
                  </ul>
                </div>






                <div class="tab-content p-3 text-muted">
                  <div class="tab-pane fade show active" id="st1" role="tabpanel" aria-labelledby="st1-tab">
                    <div class="row">
                      <div class="col-lg-6">
                        <h6><b>A. Data Laporan Surat Tugas(ST-1)</b></h6>
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
                          <div class="col-lg-12 mb-3">
                            <label for="pengendali_operasi">Pengendali Operasi</label>
                            <select class="form-control form-select select2" id="pengendali_operasi" name="pengendali_operasi" required>
                              <option value="" selected disabled>- Pilih -</option>
                              @foreach ($users as $user)
                                <option value="{{ $user->id_admin }}">{{ $user->name }}
                                </option>
                              @endforeach
                            </select>
                          </div>
                          <div class="col-lg-12 mb-3">
                            <label for="tim_operasi">Tim Operasi</label>
                            <select class="form-control form-select select2 " id="tim_operasi" name="tim_operasi[]" multiple required>
                              {{-- <option value="" selected disabled>- Pilih -</option> --}}
                              @foreach ($users as $user)
                                <option value="{{ $user->id_admin }}">{{ $user->name }}
                                </option>
                              @endforeach
                            </select>
                          </div>
                          <div class="col-lg-12 mb-3">
                            <label for="tim_dukungan_operasi">Tim Dukungan Operasi</label>
                            <select class="form-control form-select select2 " id="tim_dukungan_operasi" name="tim_dukungan_operasi[]" multiple required>
                              {{-- <option value="" selected disabled>- Pilih -</option> --}}
                              @foreach ($users as $user)
                                <option value="{{ $user->id_admin }}">{{ $user->name }}
                                </option>
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
                              <option value="{{ $user->id_admin }}">{{ $user->name }}
                              </option>
                            @endforeach
                          </select>
                        </div>
                      </div>
                    </div>
                  </div>


                  <div class="tab-pane" id="lpti" role="tabpanel">
                    <div class="row">
                      <div class="col-lg-6">
                        <h6><b>A. Data Laporan Pelaksanaan Tugas (LPT-1)</b></h6>
                        <hr>
                        <div class="row">
                          <div class="row">
                            <div class="col-md-6 mb-3">
                              <label>No. LPT</label>
                              <input type="text" class="form-control bg-primary text-white" name="no_lpt" value="" readonly>
                            </div>
                            <div class="col-md-6 mb-3">
                              <label>Surat Tugas Nomor</label>
                              <input type="text" class="form-control bg-primary text-white" name="surat_tugas_nomor" value="" readonly>
                            </div>
                          </div>
                          <!-- Media Informasi / Isi Informasi / Catatan -->
                          <div class="col-md-12 mb-3">
                            <label>Uraian Tugas</label>
                            <textarea class="form-control" name="uraian_tugas" rows="3"></textarea>
                          </div>

                          <div class="col-md-12 mb-3">
                            <label>Wilayah Penugasan</label>
                            <input type="text" class="form-control" name="wilayah_penugasan_lpt" placeholder="Wilayah Penugasan">
                          </div>

                          <div class="col-md-12 mb-3">
                            <label>Uraian Periode Penugasan</label>
                            <textarea class="form-control" name="uraian_periode_penugasan" rows="3"></textarea>
                          </div>
                        </div>
                      </div>


                      <!-- Right Column (Pejabat Selection) -->
                      <div class="col-lg-6">
                        <h6><b>B. Uraian Pelaksanaan Tugas</b></h6>
                        <hr>
                        <div class="card-body">
                          <div class="accordion accordion-flush" id="accordionFlushExample">
                            <div class="accordion-item">
                              <h2 class="accordion-header">
                                <button class="accordion-button btn bg-light fw-medium collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                                  1. Kegiatan Pengumpulan dan Penilaian Informasi
                                </button>
                              </h2>
                              <div id="flush-collapseOne" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
                                <div class="accordion-body bg-light">
                                  <!-- Form Inputs -->

                                  <div class="row mb-3 form-group">
                                    <label class="col-sm-4 col-form-label">
                                      a. Tempat Pengumpulan Informasi
                                    </label>
                                    <div class="col-sm-8">
                                      <input type="text" class="form-control form-input" name="tempat_pengumpulan_informasi" placeholder="Tempat Pengumpulan Informasi">
                                    </div>
                                  </div>

                                  <div class="row mb-3 form-group">
                                    <label class="col-sm-4 col-form-label">
                                      b. Sumber Informasi
                                    </label>
                                    <div class="col-sm-8">
                                      <input type="text" class="form-control form-input" name="sumber_informasi" placeholder="Sumber Informasi">
                                    </div>
                                  </div>

                                  <div class="row mb-3 form-group">
                                    <label class="col-sm-4 col-form-label">
                                      c. Metode Pengumpulan Informasi
                                    </label>
                                    <div class="col-sm-8">
                                      <input type="text" class="form-control form-input" name="metode_pengumpulan_informasi" placeholder="Metode Pengumpulan Informasi">
                                    </div>
                                  </div>

                                  <div class="row mb-3 form-group">
                                    <label class="col-sm-4 col-form-label">
                                      d. Ikhtisar Informasi
                                    </label>
                                    <div class="col-sm-8">
                                      <input type="text" class="form-control" placeholder="Ikhtisar Informasi" name="ikhtisar_informasi">
                                    </div>
                                  </div>

                                </div>
                              </div>
                            </div>

                            <div class="accordion-item">
                              <h2 class="accordion-header">
                                <button class="accordion-button btn bg-light fw-medium collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseTwo" aria-expanded="false" aria-controls="flush-collapseTwo">
                                  2. Kegiatan Analisis Intelijen
                                </button>
                              </h2>
                              <div id="flush-collapseTwo" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
                                <div class="accordion-body bg-light">

                                  <!-- Form Inputs -->
                                  <div class="row mb-3 form-group">
                                    <label class="col-sm-4 col-form-label">a. Jenis Dokumen Kepabeanan </label>
                                    <div class="col-sm-8">
                                      <input type="text" class="form-control form-input" name="jenis_dokumen_kepabeanan" placeholder="Jenis Dokumen Kepabeanan">
                                    </div>
                                  </div>

                                  <div class="row mb-3 form-group">
                                    <label class="col-sm-4 col-form-label">b. Nomor dan Tanggal Dokumen Kepabeanan </label>
                                    <div class="col-sm-8">
                                      <input type="text" class="form-control form-input" name="nomor_tanggal_dokumen_kepabeanan" placeholder="Nomor dan Tanggal Dokumen Kepabeanan">
                                    </div>
                                  </div>

                                  <div class="row mb-3 form-group">
                                    <label class="col-sm-4 col-form-label">c. Metode Analisis Intelijen </label>
                                    <div class="col-sm-8">
                                      <input type="text" class="form-control form-input" name="metode_analisis_intelijen" placeholder="Metode Analisis Intelijen">
                                    </div>
                                  </div>

                                  <div class="row mb-3 form-group">
                                    <label class="col-sm-4 col-form-label">d. Ikhtisar Hasil Analisis Intelijen </label>
                                    <div class="col-sm-8">
                                      <input type="text" class="form-control" placeholder="Ikhtisar Hasil Analisis Intelijen" name="ikhtisar_hasil_analisis_intelijen">
                                    </div>
                                  </div>

                                </div>
                              </div>

                              <div class="accordion-item">
                                <h2 class="accordion-header">
                                  <button class="accordion-button btn bg-light fw-medium collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseThree" aria-expanded="false" aria-controls="flush-collapseThree">
                                    3. Indikasi Pelanggaran
                                  </button>
                                </h2>
                                <div id="flush-collapseThree" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
                                  <div class="accordion-body bg-light">

                                    <!-- Form Inputs -->
                                    <div class="row mb-3 form-group">
                                      <label class="col-sm-4 col-form-label">a. Jenis Pelanggaran </label>
                                      <div class="col-sm-8">
                                        <input type="text" class="form-control form-input" name="jenis_pelanggaran" placeholder="Jenis Pelanggaran">
                                      </div>
                                    </div>

                                    <div class="row mb-3 form-group">
                                      <label class="col-sm-4 col-form-label">b. Modus Pelanggaran </label>
                                      <div class="col-sm-8">
                                        <input type="text" class="form-control form-input" name="modus_pelanggaran" placeholder="Modus Pelanggaran">
                                      </div>
                                    </div>

                                    <div class="row mb-3 form-group">
                                      <label class="col-sm-4 col-form-label">c. Perkiraan Tempat Pelanggaran </label>
                                      <div class="col-sm-8">
                                        <input type="text" class="form-control form-input" name="perkiraan_tempat_pelanggaran" placeholder="Perkiraan Tempat Pelanggaran">
                                      </div>
                                    </div>

                                    <div class="row mb-3 form-group">
                                      <label class="col-sm-4 col-form-label">d. Perkiraan Waktu Pelanggaran</label>
                                      <div class="col-sm-8">
                                        <input type="time" class="form-control form-input" name="perkiraan_waktu_pelanggaran" placeholder="Perkiraan Waktu Pelanggaran">
                                      </div>
                                    </div>

                                    <div class="row mb-3 form-group">
                                      <label class="col-sm-4 col-form-label">e. Perkiraan Pelaku Pelanggaran </label>
                                      <div class="col-sm-8">
                                        <input type="text" class="form-control form-input" name="perkiraan_pelaku_pelanggaran" placeholder="Perkiraan Pelaku Pelanggaran">
                                      </div>
                                    </div>

                                  </div>
                                </div>
                              </div>

                              <div class="accordion-item">
                                <h2 class="accordion-header">
                                  <button class="accordion-button btn bg-light fw-medium collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseFour" aria-expanded="false" aria-controls="flush-collapseFour">
                                    4. Dokumentasi Kegiatan Intelijen
                                  </button>
                                </h2>
                                <div id="flush-collapseFour" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
                                  <div class="accordion-body bg-light">



                                    <div class="row mb-3 form-group">
                                      <label class="col-sm-4 col-form-label">Dokumentasi foto</label>
                                      <div class="col-sm-8">
                                        <input type="file" class="form-control form-input" name="dokumentasi_foto">
                                      </div>
                                    </div>

                                    <div class="row mb-3 form-group">
                                      <label class="col-sm-4 col-form-label">Dokumentasi Audio</label>
                                      <div class="col-sm-8">
                                        <input type="file" class="form-control form-input" name="dokumentasi_audio">
                                      </div>
                                    </div>

                                    <div class="row mb-3 form-group">
                                      <label class="col-sm-4 col-form-label">Dokumentasi Audio</label>
                                      <div class="col-sm-8">
                                        <input type="file" class="form-control form-input" name="dokumentasi_audio">
                                      </div>
                                    </div>

                                  </div>
                                </div>
                              </div>


                              <div class="accordion-item">
                                <h2 class="accordion-header">
                                  <button class="accordion-button btn bg-light fw-medium collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseFive" aria-expanded="false" aria-controls="flush-collapseFive">
                                    5. Informasi Lainnya yang berkaitan
                                  </button>
                                </h2>
                                <div id="flush-collapseFive" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
                                  <div class="accordion-body bg-light">

                                    <div class="row mb-3 form-group">
                                      <label for="informasi_lainnya">Informasi Lainnya yang Berkaitan</label>
                                      <textarea class="form-control" name="info_lainnya" rows="3"></textarea>
                                    </div>

                                    <div class="row mb-3 form-group">
                                      <label for="Kesimpulan">Kesimpulan</label>
                                      <textarea class="form-control" name="Kesimpulan" rows="3"></textarea>
                                    </div>

                                    <div class="row mb-3 form-group">
                                      <label for="Rekomendasi">Rekomendasi</label>
                                      <textarea class="form-control" name="Rekomendasi" rows="3"></textarea>
                                    </div>

                                  </div>
                                </div>
                              </div>

                              <div class="col-lg-12 mb-3 mt-3">
                                <label for="ketua_tim">Ketua Tim Pelaksanaan Tugas</label>
                                <select class="form-control form-select select2" id="ketua_tim" name="ketua_tim" required>
                                  <option value="" selected disabled>- Pilih -</option>
                                  @foreach ($users as $user)
                                    <option value="{{ $user->id_admin }}">{{ $user->name }}
                                    </option>
                                  @endforeach
                                </select>
                              </div>

                              <div class="col-lg-12 mb-3">
                                <label for="pegawai_pembuat_laporan">Pegawai Pembuat Laporan</label>
                                <select class="form-control form-select select2" id="pegawai_pembuat" name="pegawai_pembuat" required>
                                  <option value="" selected disabled>- Pilih -</option>
                                  @foreach ($users as $user)
                                    <option value="{{ $user->id_admin }}">{{ $user->name }}
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

                  <div class="tab-pane" id="lppi" role="tabpanel">
                    <div class="row">
                      <div class="col-lg-6">
                        <h6><b>A. Lembar Pengumpulan Dan Penilaian Informasi</b></h6>
                        <hr>
                        <div class="row">
                          <div class="col-md-6 mb-3">
                            <label>No. LPPI</label>
                            <input type="text" class="form-control bg-primary text-white" placeholder="No. LPPI" id="no_lppi" name="no_lppi" required>
                          </div>
                          <div class="col-md-6 mb-3">
                            <label>Tgl. LPPI</label>
                            <input type="date" class="form-control" id="tgl_lppi" name="tgl_lppi" required>
                          </div>

                          <h6><b>B. Sumber Data Atau Informasi</b></h6>
                          <div class="card-body">
                            <div class="accordion accordion-flush" id="accordionFlushExample">
                              <div class="accordion-item">
                                <h2 class="accordion-header">
                                  <button class="accordion-button btn bg-light fw-medium collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                                    1. Internal
                                  </button>
                                </h2>
                                <div id="flush-collapseOne" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
                                  <div class="accordion-body bg-light">

                                    <div class="row mb-3">
                                      <label for="internal" class="col-sm-4 col-form-label">ISI DATA</label>
                                      <div class="col-sm-8">
                                        <select id="internal" class="form-select" name="internal"> <!-- Ubah ID di sini -->
                                          <option value="TIDAK">TIDAK</option>
                                          <option value="YA">Ya</option>
                                        </select>
                                      </div>
                                    </div>


                                    <!-- Form Inputs -->

                                    <div class="row mb-3 form-group">
                                      <label class="col-sm-4 col-form-label">
                                        Media
                                      </label>
                                      <div class="col-sm-8">
                                        <input type="text" class="form-control form-input" name="media_internal" placeholder="Media Internal">
                                      </div>
                                    </div>

                                    <div class="row mb-3 form-group">
                                      <label class="col-sm-4 col-form-label">
                                        Tanggal Terima
                                      </label>
                                      <div class="col-sm-8">
                                        <input type="date" class="form-control" name="tanggal_terima_internal">
                                      </div>
                                    </div>

                                    <div class="row mb-3 form-group">
                                      <label class="col-sm-4 col-form-label">
                                        No. Dokumen
                                      </label>
                                      <div class="col-sm-8">
                                        <input type="text" class="form-control" placeholder="No. Dokumen" name="no_dokumen_internal">
                                      </div>
                                    </div>

                                    <div class="row mb-3 form-group">
                                      <label class="col-sm-4 col-form-label">
                                        Tanggal Dokumen
                                      </label>
                                      <div class="col-sm-8">
                                        <input type="date" class="form-control" name="tanggal_dokumen_internal">
                                      </div>
                                    </div>

                                  </div>
                                </div>
                              </div>

                              <div class="accordion-item">
                                <h2 class="accordion-header">
                                  <button class="accordion-button btn bg-light fw-medium collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseTwo" aria-expanded="false" aria-controls="flush-collapseTwo">
                                    2. Eksternal
                                  </button>
                                </h2>
                                <div id="flush-collapseTwo" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
                                  <div class="accordion-body bg-light">

                                    <div class="row mb-3">
                                      <label for="eksternal" class="col-sm-4 col-form-label">ISI DATA</label>
                                      <div class="col-sm-8">
                                        <select id="eksternal" class="form-select" name="eksternal"> <!-- Ubah ID di sini -->
                                          <option value="TIDAK">TIDAK</option>
                                          <option value="YA">Ya</option>
                                        </select>
                                      </div>
                                    </div>

                                    <!-- Form Inputs -->
                                    <div class="row mb-3 form-group">
                                      <label class="col-sm-4 col-form-label">Media</label>
                                      <div class="col-sm-8">
                                        <input type="text" class="form-control form-input" name="media_eksternal" placeholder="Media Eksternal">
                                      </div>
                                    </div>

                                    <div class="row mb-3 form-group">
                                      <label class="col-sm-4 col-form-label">Tanggal Terima</label>
                                      <div class="col-sm-8">
                                        <input type="date" class="form-control" name="tanggal_terima_eksternal">
                                      </div>
                                    </div>

                                    <div class="row mb-3 form-group">
                                      <label class="col-sm-4 col-form-label">No. Dokumen </label>
                                      <div class="col-sm-8">
                                        <input type="text" class="form-control form-input" name="metode_analisis_intelijen" placeholder="Metode Analisis Intelijen">
                                      </div>
                                    </div>

                                    <div class="row mb-3 form-group">
                                      <label class="col-sm-4 col-form-label">Tanggal Dokumen</label>
                                      <div class="col-sm-8">
                                        <input type="date" class="form-control" name="tanggal_dokumen_eksternal">
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </div>

                            </div>

                          </div>
                          <h6><b>C. Ikhtisar Data</b>&nbsp;&nbsp;&nbsp;<button type="button" class="btn btn-info" onclick="tambahIkhtisar()">+</button></h6>
                          <hr>
                          <div class="container my-4">
                            <div id="ikhtisar-container" class="col-lg-12 ">
                              <!-- Baris input pertama akan ditambahkan di sini -->
                            </div>
                          </div>

                        </div>
                      </div>

                      <!-- Right Column (Pejabat Selection) -->
                      <div class="col-lg-6">
                        <h6><b>D. Kesimpulan</b></h6>
                        <hr>

                        <div class="col-md-12 mb-3">
                          <label>Kesimpulan</label>
                          <textarea class="form-control" rows="3" placeholder="Kesimpulan Lembar Pengumpulan Dan Penilaian Informasi" id="kesimpulan" name="kesimpulan_lppi" required></textarea>
                        </div>

                        <div class="row">
                          <div class="col-lg-6 mb-3">
                            <label for="pegawai_lppi">Pegawai Yang Menerima Disposisi</label>
                            <select class="form-control form-select select2" id="pegawai_lppi" name="pegawai_lppi" required>
                              <option value="" selected disabled>- Pilih -</option>
                              @foreach ($users as $user)
                                <option value="{{ $user->id_admin }}">{{ $user->name }}
                                </option>
                              @endforeach
                            </select>
                          </div>



                          <div class="col-md-6 mb-3">
                            <label>Tanggal Disposisi</label>
                            <input type="date" class="form-control" id="tanggal_disposisi" name="tanggal_disposisi" required>
                          </div>
                        </div>

                        <div class="col-md-12 mb-3">
                          <label for="tindak_lanjut" class="col-sm-4 col-form-label">Tindak Lanjut</label>
                          <select id="eksternal" class="form-select" name="eksternal"> <!-- Ubah ID di sini -->
                            <option value="Analisis">Analisis</option>
                            <option value="Arsip">Arsip</option>
                          </select>
                        </div>

                        <div class="col-md-12 mb-3">
                          <label>Catatan</label>
                          <textarea class="form-control" rows="3" placeholder="Catatan Lembar Pengumpulan Dan Penilaian Informasi" id="catatan" name="catatan_lppi" required></textarea>
                        </div>

                        <div class="col-lg-12 mb-3">
                          <label for="pejabat_lppi">Pejabat Pengawas</label>
                          <select class="form-control form-select select2" id="pejabat_lppi" name="pejabat_lppi" required>
                            <option value="" selected disabled>- Pilih -</option>
                            @foreach ($users as $user)
                              <option value="{{ $user->id_admin }}">{{ $user->name }}
                              </option>
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
                        <h6><b>A. Data Lembar Kerja Hasil intelijen</b></h6>
                        <hr>
                        <div class="row">
                          <!-- No. LI / Tgl. LI -->
                          <div class="col-md-6 mb-3">
                            <label>No. LKAI</label>
                            <input type="text" class="form-control bg-primary text-white" placeholder="Nomor LKAI">
                          </div>
                          <div class="col-md-6 mb-3">
                            <label>tgl. LKAI</label>
                            <input type="date" class="form-control bg-primary text-white" name="tgl_lkai">
                          </div>
                          <!-- Media Informasi / Isi Informasi / Catatan -->
                          <div class="col-md-6 mb-3">
                            <label>LPPI</label>
                            <textarea class="form-control" row="2" placeholder="Pertimbangan Diterbitkannya Surat Perintah" id="pertimbangan_surat_perintah" name="ket_perundang" required></textarea>
                          </div>
                          <div class="col-md-6 mb-3">
                            <label>NPI</label>
                            <textarea class="form-control" rows="2" placeholder="Dasar Hukum Yang Mendasari Diterbitkannya Surat Perintah" id="dasar_sp" name="dasar_sp" required></textarea>
                          </div>
                          <h6><b>B. Ikhtisar Data Informasi</b></h6>
                          <hr>
                          <div class="col-md-12 mb-3">
                            <label>Ikhtisar Data Atau Informasi</label>
                            <textarea class="form-control" row="2" placeholder="Ikhtisar Data Atau Informasi" id="ikhtisar_data_lkai" name="ikhtisar_data_lkai" required></textarea>
                          </div>


                          <div class="col-md-12 mb-3">
                            <label>Prosedur Analisis</label>
                            <textarea class="form-control" row="2" placeholder="Prosedur Analisis" id="prosedur_analisis_lkai" name="prosedur_analisis_lkai" required></textarea>
                          </div>

                          <div class="col-md-12 mb-3">
                            <label>Hasil Analisis</label>
                            <textarea class="form-control" row="2" placeholder="Hasil Analisis" id="hasl_analisis" name="hasil_analisis" required></textarea>
                          </div>

                          <div class="col-md-12 mb-3">
                            <label>Kesimpulan</label>
                            <textarea class="form-control" row="2" placeholder="Kesimpulan" id="kesimpulan" name="kesimpulan_lkai" required></textarea>
                          </div>
                        </div>
                      </div>

                      <!-- Right Column (Pejabat Selection) -->
                      <div class="col-lg-6">
                        <h6><b>C. Rekomendasi</b></h6>
                        <hr>
                        <div class="row">
                          <div class="col-sm-6">
                            <label for="nhi-select">NHI/NHI-HKI/NHI-N</label>
                            <select id="nhi-select" class="form-select" name="nhi">
                              <option value="TIDAK">TIDAK</option>
                              <option value="YA">YA</option>
                            </select>
                          </div>
                          <div class="col-sm-6">
                            <label for="ni-select">NI</label>
                            <select id="ni-select" class="form-select" name="ni">
                              <option value="TIDAK">TIDAK</option>
                              <option value="YA">YA</option>
                            </select>
                          </div>

                          <div class="card-body">
                            <div class="accordion accordion-flush" id="accordionFlushExample">
                              <div class="accordion-item">
                                <h2 class="accordion-header">
                                  <button class="accordion-button btn bg-light fw-medium collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                                    Rekomendasi Lainnya
                                  </button>
                                </h2>
                                <div id="flush-collapseOne" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
                                  <div class="accordion-body bg-light">

                                    <div class="row mb-3">
                                      <label class="col-sm-4 col-form-label">ISI DATA</label>
                                      <div class="col-sm-8">
                                        <select id="rekomendasi_lainnya" class="form-select" name="rekomendasi_lainnya"> <!-- Ubah ID di sini -->
                                          <option value="TIDAK">TIDAK</option>
                                          <option value="YA">Ya</option>
                                        </select>
                                      </div>
                                    </div>


                                    <!-- Form Inputs -->

                                    <div class="row mb-3 form-group">
                                      <label class="col-sm-4 col-form-label">
                                        Isi Rekomendasi Lainnya
                                      </label>
                                      <div class="col-sm-8">
                                        <textarea class="form-control" row="2" placeholder="Isi Rekomendasi Lainnya" id="isi_rekomendasi_lainnya" name="isi_rekomendasi_lainnya" required></textarea>
                                      </div>
                                    </div>

                                  </div>
                                </div>
                              </div>

                              <div class="accordion-item">
                                <h2 class="accordion-header">
                                  <button class="accordion-button btn bg-light fw-medium collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseTwo" aria-expanded="false" aria-controls="flush-collapseTwo">
                                    Informasi Lainnya
                                  </button>
                                </h2>
                                <div id="flush-collapseTwo" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
                                  <div class="accordion-body bg-light">

                                    <div class="row mb-3">
                                      <label class="col-sm-4 col-form-label">ISI DATA</label>
                                      <div class="col-sm-8">
                                        <select id="informasi_lainnya" class="form-select" name="informasi_lainnya"> <!-- Ubah ID di sini -->
                                          <option value="TIDAK">TIDAK</option>
                                          <option value="YA">Ya</option>
                                        </select>
                                      </div>
                                    </div>

                                    <!-- Form Inputs -->
                                    <div class="row mb-3 form-group">
                                      <label class="col-sm-4 col-form-label">Isi Informasi Lainnya</label>
                                      <div class="col-sm-8">
                                        <textarea class="form-control" row="2" placeholder="Isi Informasi Lainnya" id="isi_informasi_lainnya" name="isi_informasi_lainnya" required></textarea>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>

                          <div class="col-md-12 mb-3">
                            <label>Tujuan</label>
                            <input type="text" class="form-control" placeholder="Tujuan">
                          </div>

                          <div class="col-md-12 mb-3">
                            <label>Pegawai Yang Melakukan Analisis</label>
                            <select class="form-control form-select select2" id="id_pegawai_analisis" name="id_pegawai_analisis" required>
                              <option value="" selected disabled>- Pilih -</option>
                              @foreach ($users as $user)
                                <option value="{{ $user->id_admin }}">{{ $user->name }} | {{ $user->jabatan }}
                                </option>
                              @endforeach
                            </select>
                          </div>

                          <div class="card-body">
                            <div class="accordion accordion-flush" id="accordionFlushExample">
                              <div class="accordion-item">
                                <h2 class="accordion-header">
                                  <button class="accordion-button btn bg-light fw-medium collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseEleven" aria-expanded="false" aria-controls="flush-collapseEleven">
                                    Keputusan Pertama
                                  </button>
                                </h2>
                                <div id="flush-collapseEleven" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
                                  <div class="accordion-body bg-light">

                                    <div class="row mb-3">
                                      <label class="col-sm-4 col-form-label">Keputusan Pertama</label>
                                      <div class="col-sm-8">
                                        <select id="keputusan_pertama" class="form-select" name="keputusan_pertama"> <!-- Ubah ID di sini -->
                                          <option value="TIDAK">Tidak Setuju</option>
                                          <option value="YA">Setuju</option>
                                        </select>
                                      </div>
                                    </div>

                                    <!-- Form Inputs -->
                                    <div class="row mb-3 form-group">
                                      <label class="col-sm-4 col-form-label">
                                        Pejabat Pengawas
                                      </label>
                                      <div class="col-sm-8">
                                        <select class="form-control form-select select2" id="id_pejabat_pengawas_lkai" name="id_pejabat_pengawas_lkai" required>
                                          <option value="" selected disabled>- Pilih -</option>
                                          @foreach ($users as $user)
                                            <option value="{{ $user->id_admin }}">{{ $user->name }} | {{ $user->jabatan }}
                                            </option>
                                          @endforeach
                                        </select>
                                      </div>
                                    </div>

                                    <div class="row mb-3 form-group">
                                      <label class="col-sm-4 col-form-label">Catatan</label>
                                      <div class="col-sm-8">
                                        <textarea class="form-control" row="2" placeholder="Catatan" id="catatan" name="catatan_keputusan_1" required></textarea>
                                      </div>
                                    </div>

                                    <div class="row mb-3 form-group">
                                      <label class="col-sm-4 col-form-label">Hasil Analisis Diterima Tanggal</label>
                                      <div class="col-sm-8">
                                        <input type="date" class="form-control" name="hasil_analisis_diterima_tanggal_1">
                                      </div>
                                    </div>

                                  </div>
                                </div>
                              </div>

                              <div class="accordion-item">
                                <h2 class="accordion-header">
                                  <button class="accordion-button btn bg-light fw-medium collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseTwelve" aria-expanded="false" aria-controls="flush-collapseTwelve">
                                    Keputusan Kedua
                                  </button>
                                </h2>
                                <div id="flush-collapseTwelve" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
                                  <div class="accordion-body bg-light">



                                    <div class="row mb-3">
                                      <label class="col-sm-4 col-form-label">Keputusan Kedua</label>
                                      <div class="col-sm-8">
                                        <select id="keputusan_kedua" class="form-select" name="keputusan_kedua"> <!-- Ubah ID di sini -->
                                          <option value="TIDAK">Tidak Setuju</option>
                                          <option value="YA">Setuju</option>
                                        </select>
                                      </div>
                                    </div>

                                    <!-- Form Inputs -->
                                    <div class="row mb-3 form-group">
                                      <label class="col-sm-4 col-form-label">
                                        Pejabat Administrator
                                      </label>
                                      <div class="col-sm-8">
                                        <select class="form-control form-select select2" id="id_pejabat_administrator_lkai" name="id_pejabat_administrator_lkai" required>
                                          <option value="" selected disabled>- Pilih -</option>
                                          @foreach ($users as $user)
                                            <option value="{{ $user->id_admin }}">{{ $user->name }} | {{ $user->jabatan }}
                                            </option>
                                          @endforeach
                                        </select>
                                      </div>
                                    </div>

                                    <div class="row mb-3 form-group">
                                      <label class="col-sm-4 col-form-label">Catatan</label>
                                      <div class="col-sm-8">
                                        <textarea class="form-control" row="2" placeholder="Catatan" id="catatan" name="catatan_keputusan_2" required></textarea>
                                      </div>
                                    </div>

                                    <div class="row mb-3 form-group">
                                      <label class="col-sm-4 col-form-label">Hasil Analisis Diterima Tanggal</label>
                                      <div class="col-sm-8">
                                        <input type="date" class="form-control" name="hasil_analisis_diterima_tanggal_2">
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
                        <h6><b>A. Data Nota Hasil Intelijen</b></h6>
                        <hr>
                        <div class="row">
                          <div class="col-md-6 mb-3">
                            <label>No. NHI</label>
                            <input type="text" class="form-control" placeholder="No. NHI" id="no_nhi" name="no_nhi" required>
                          </div>
                          <div class="col-md-6 mb-3">
                            <label>Tanggal NHI</label>
                            <input type="date" class="form-control" id="tgl_nhi" name="tgl_nhi" required>
                          </div>
                          <div class="col-md-6 mb-3">
                            <label>Sifat NHI</label>
                            <select class="form-control" id="sifat_nhi" name="sifat_nhi" required>
                              <option value="" selected disabled>- Pilih -</option>
                              <option value="Segera">Segera</option>
                              <option value="Sangat Segera">Sangat Segera</option>
                            </select>
                          </div>
                          <div class="col-md-6 mb-3">
                            <label>Klasifikasi NHI</label>
                            <select class="form-control" id="klasifikasi_nhi" name="klasifikasi_nhi" required>
                              <option value="" selected disabled>- Pilih -</option>
                              <option value="Rahasia">Rahasia</option>
                              <option value="Sangat Rahasia">Sangat Rahasia</option>
                            </select>
                          </div>
                          <h6><b>B. Referensi</b></h6>
                          <hr>
                          <div class="col-md-6 mb-3">
                            <label>No. LKAI</label>
                            <input type="text" class="form-control" placeholder="No. LKAI" required>
                          </div>

                          <div class="col-md-6 mb-3">
                            <label>Tgl. LKAI</label>
                            <input type="date" class="form-control" required>
                          </div>

                          <div class="col-md-12 mb-3">
                            <label>Jabatan Penerima NHI</label>
                            <select class="form-control form-select select2" id="id_penerima_nhi" name="id_penerima_nhi" required>
                              <option value="" selected disabled>- Pilih -</option>
                              @foreach ($users as $user)
                                <option value="{{ $user->id_admin }}">{{ $user->name }} | {{ $user->jabatan }}
                                </option>
                              @endforeach
                            </select>
                          </div>


                        </div>
                      </div>

                      <!-- Right Column (Pejabat Selection) -->
                      <div class="col-lg-6">
                        <h6><b>B. Informasi NHI</b></h6>
                        <div class="card-body">
                          <div class="accordion accordion-flush" id="accordionFlushExample">

                            <div class="accordion-item">
                              <h2 class="accordion-header">
                                <button class="accordion-button btn bg-light fw-medium collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                                  A. Tempat
                                </button>
                              </h2>

                              <div id="flush-collapseOne" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
                                <div class="accordion-body bg-light">
                                  <div class="row mb-3 form-group">
                                    <label class="col-sm-4 col-form-label">
                                      Nama Tempat
                                    </label>
                                    <div class="col-sm-8">
                                      <input type="text" class="form-control form-input" name="nama_tempat_nhi" placeholder="Nama Tempat">
                                    </div>
                                  </div>
                                </div>
                              </div>

                            </div>

                            <div class="accordion-item">
                              <h2 class="accordion-header">
                                <button class="accordion-button btn bg-light fw-medium collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseTwo" aria-expanded="false" aria-controls="flush-collapseTwo">
                                  B. Tanggal/Waktu
                                </button>
                              </h2>
                              <div id="flush-collapseTwo" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
                                <div class="accordion-body bg-light">


                                  <div class="row mb-3 form-group">
                                    <label class="col-sm-4 col-form-label">Tanggal/Waktu</label>
                                    <div class="col-sm-8">
                                      <input type="date" class="form-control" name="tgl_waktu_nhi">
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>

                            <div class="accordion-item">
                              <h2 class="accordion-header">
                                <button class="accordion-button btn bg-light fw-medium collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseThree" aria-expanded="false" aria-controls="flush-collapseThree">
                                  C. Kantor Bea dan Cukai
                                </button>
                              </h2>
                              <div id="flush-collapseThree" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
                                <div class="accordion-body bg-light">

                                  <div class="row mb-3 form-group">
                                    <label class="col-sm-4 col-form-label">Kantor Bea dan Cukai</label>
                                    <div class="col-sm-8">
                                      <input type="text" class="form-control form-input" name="kantor_bc_nhi" placeholder="Kantor Bea dan Cukai">
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>

                            <div class="accordion-item">
                              <h2 class="accordion-header">
                                <button class="accordion-button btn bg-light fw-medium collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseFour" aria-expanded="false" aria-controls="flush-collapseFour">
                                  D. Kegiatan atas Barang Impor /Ekspor
                                </button>
                              </h2>
                              <div id="flush-collapseFour" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
                                <div class="accordion-body bg-light">

                                  <div class="row mb-3 form-group">
                                    <label class="col-sm-4 col-form-label">1. Nama/No. Dokumen Kepabeanan</label>
                                    <div class="col-sm-8">
                                      <input type="text" class="form-control form-input" name="nama_no_dokumen_kepabeanan" placeholder="nama_no_dokumen_kepabeanan">
                                    </div>
                                  </div>

                                  <div class="row mb-3 form-group">
                                    <label class="col-sm-4 col-form-label">2. Eks/Untuk Kapal/Pesawat/Alat Angkut/Lainnya</label>
                                    <div class="col-sm-8">
                                      <input type="text" class="form-control form-input" name="kapal_pesawat" placeholder="Eks/Untuk Kapal/Pesawat/Alat Angkut/Lainnya">
                                    </div>
                                  </div>

                                  <div class="row mb-3 form-group">
                                    <label class="col-sm-4 col-form-label">No.Polisi</label>
                                    <div class="col-sm-8">
                                      <input type="text" class="form-control form-input" name="no_polisi" placeholder="No Polisi">
                                    </div>
                                  </div>

                                  <div class="row mb-3 form-group">
                                    <label class="col-sm-4 col-form-label">3. No. BL/AWB</label>
                                    <div class="col-sm-8">
                                      <input type="text" class="form-control form-input" name="no_bl_awb" placeholder="No. BL/AWB">
                                    </div>
                                  </div>

                                  <div class="row mb-3 form-group">
                                    <label class="col-sm-4 col-form-label">4. No. kontainer/Merek Koli</label>
                                    <div class="col-sm-8">
                                      <input type="text" class="form-control form-input" name="no_kontainer_merk_koli" placeholder="No. kontainer/Merek Koli">
                                    </div>
                                  </div>

                                  <div class="row mb-3 form-group">
                                    <label class="col-sm-4 col-form-label">5. Importir/Eksportir/PPJK</label>
                                    <div class="col-sm-8">
                                      <input type="text" class="form-control form-input" name="importir_eksportir" placeholder="Importir/Eksportir/PPJK">
                                    </div>
                                  </div>

                                  <div class="row mb-3 form-group">
                                    <label class="col-sm-4 col-form-label">6. NPWP</label>
                                    <div class="col-sm-8">
                                      <input type="text" class="form-control form-input" name="npwp" placeholder="NPWP">
                                    </div>
                                  </div>

                                  <div class="row mb-3 form-group">
                                    <label class="col-sm-4 col-form-label">7. Jenis/Jumlah barang</label>
                                    <div class="col-sm-8">
                                      <input type="text" class="form-control form-input" name="jenis_jumlah_barang" placeholder="Jenis/Jumlah barang">
                                    </div>
                                  </div>

                                  <div class="row mb-3 form-group">
                                    <label class="col-sm-4 col-form-label">8. Data Lainnya</label>
                                    <div class="col-sm-8">
                                      <input type="text" class="form-control form-input" name="data_lainnya_a" placeholder="Data Lainnya">
                                    </div>
                                  </div>



                                </div>
                              </div>
                            </div>


                            <div class="accordion-item">
                              <h2 class="accordion-header">
                                <button class="accordion-button btn bg-light fw-medium collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseFive" aria-expanded="false" aria-controls="flush-collapseFive">
                                  E. Kegiatan atas Barang Kena Cukai
                                </button>
                              </h2>
                              <div id="flush-collapseFive" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
                                <div class="accordion-body bg-light">

                                  <div class="row mb-3 form-group">
                                    <label class="col-sm-4 col-form-label">1. Eks Pabrik/Tempat Penyimpanan/Tempat Penimbunan</label>
                                    <div class="col-sm-8">
                                      <input type="text" class="form-control form-input" name="eks_pabrik" placeholder="Eks Pabrik/Tempat Penyimpanan/Tempat Penimbunan">
                                    </div>
                                  </div>

                                  <div class="row mb-3 form-group">
                                    <label class="col-sm-4 col-form-label">2. Penyalur</label>
                                    <div class="col-sm-8">
                                      <input type="text" class="form-control form-input" name="penyalur" placeholder="penyalur">
                                    </div>
                                  </div>

                                  <div class="row mb-3 form-group">
                                    <label class="col-sm-4 col-form-label">3. Tempat Penjualan Eceran</label>
                                    <div class="col-sm-8">
                                      <input type="text" class="form-control form-input" name="tempat_penjualan_eceran" placeholder="Tempat Penjualan Eceran">
                                    </div>
                                  </div>

                                  <div class="row mb-3 form-group">
                                    <label class="col-sm-4 col-form-label">4. NPPBKC</label>
                                    <div class="col-sm-8">
                                      <input type="text" class="form-control form-input" name="nppbkc" placeholder="NPPBKC">
                                    </div>
                                  </div>

                                  <div class="row mb-3 form-group">
                                    <label class="col-sm-4 col-form-label">5. Eks/Untuk Kapal/Pesawat/Alat Angkut/Lainnya</label>
                                    <div class="col-sm-8">
                                      <input type="text" class="form-control form-input" name="kapal_pesawat_b" placeholder="Eks/Untuk Kapal/Pesawat/Alat Angkut/Lainnya">
                                    </div>
                                  </div>

                                  <div class="row mb-3 form-group">
                                    <label class="col-sm-4 col-form-label">No. Polisi</label>
                                    <div class="col-sm-8">
                                      <input type="text" class="form-control form-input" name="no_polisi" placeholder="no_polisi">
                                    </div>
                                  </div>

                                  <div class="row mb-3 form-group">
                                    <label class="col-sm-4 col-form-label">6. Jenis/Jumlah barang</label>
                                    <div class="col-sm-8">
                                      <input type="text" class="form-control form-input" name="jenis_jumlah_barang_b" placeholder="Jenis/Jumlah barang">
                                    </div>
                                  </div>

                                  <div class="row mb-3 form-group">
                                    <label class="col-sm-4 col-form-label">8. Data Lainnya</label>
                                    <div class="col-sm-8">
                                      <input type="text" class="form-control form-input" name="data_lainnya_b" placeholder="Data Lainnya">
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>


                            <div class="accordion-item">
                              <h2 class="accordion-header">
                                <button class="accordion-button btn bg-light fw-medium collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseSix" aria-expanded="false" aria-controls="flush-collapseSix">
                                  F. Kegiatan atas Barang Tertentu
                                </button>
                              </h2>
                              <div id="flush-collapseSix" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
                                <div class="accordion-body bg-light">

                                  <div class="row mb-3 form-group">
                                    <label class="col-sm-4 col-form-label">1. Nama/No. Dokumen</label>
                                    <div class="col-sm-8">
                                      <input type="text" class="form-control form-input" name="nama_no_dok" placeholder="Nama/No. Dokumen">
                                    </div>
                                  </div>

                                  <div class="row mb-3 form-group">
                                    <label class="col-sm-4 col-form-label">2. Eks/Untuk Kapal/Pesawat/Alat Angkut/Lainnya</label>
                                    <div class="col-sm-8">
                                      <input type="text" class="form-control form-input" name="kapal_pesawat_c" placeholder="Eks/Untuk Kapal/Pesawat/Alat Angkut/Lainnya">
                                    </div>
                                  </div>

                                  <div class="row mb-3 form-group">
                                    <label class="col-sm-4 col-form-label">No. Polisi</label>
                                    <div class="col-sm-8">
                                      <input type="text" class="form-control form-input" name="no_polisi_c" placeholder="No Polisi">
                                    </div>
                                  </div>

                                  <div class="row mb-3 form-group">
                                    <label class="col-sm-4 col-form-label">3. No. BL/AWB</label>
                                    <div class="col-sm-8">
                                      <input type="text" class="form-control form-input" name="no_bl_awb_b" placeholder="No. BL/AWB">
                                    </div>
                                  </div>

                                  <div class="row mb-3 form-group">
                                    <label class="col-sm-4 col-form-label">4. No. kontainer/Merek Koli</label>
                                    <div class="col-sm-8">
                                      <input type="text" class="form-control form-input" name="no_kontainer_merek_koli_b" placeholder="No. kontainer/Merek Koli">
                                    </div>
                                  </div>


                                  <div class="row mb-3 form-group">
                                    <label class="col-sm-4 col-form-label">5. Orang Pribadi/Badan Hukum</label>
                                    <div class="col-sm-8">
                                      <input type="text" class="form-control form-input" name="orang_pribadi_badan_hukum" placeholder="Orang Pribadi/Badan Hukum">
                                    </div>
                                  </div>

                                  <div class="row mb-3 form-group">
                                    <label class="col-sm-4 col-form-label">6. Jenis/Jumlah barang</label>
                                    <div class="col-sm-8">
                                      <input type="text" class="form-control form-input" name="jenis_jumlah_barang_c" placeholder="Jenis/Jumlah barang">
                                    </div>
                                  </div>

                                  <div class="row mb-3 form-group">
                                    <label class="col-sm-4 col-form-label">8. Data Lainnya</label>
                                    <div class="col-sm-8">
                                      <input type="text" class="form-control form-input" name="data_lainnya_c" placeholder="Data Lainnya">
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>

                          </div>
                        </div>

                        <div class="col-md-12 mb-3">
                          <label>Indikasi</label>
                          <textarea class="form-control" rows="4" placeholder="Indikasi" id="indikasi" name="indikasi" required></textarea>
                        </div>

                        <div class="col-lg-12 mb-3">
                          <label>Pejabat Penerbit NHI</label>
                          <select class="form-control form-select select2" id="id_pejabat_penerbit_nhi" name="id_pejabat_penerbit_nhi" required>
                            <option value="" selected disabled>- Pilih -</option>
                            @foreach ($users as $user)
                              <option value="{{ $user->id_admin }}">{{ $user->name }}
                              </option>
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
                        <h6><b>A. Data Nota Informasi</b></h6>
                        <hr>
                        <div class="row">
                          <div class="col-md-6 mb-3">
                            <label>No. NI</label>
                            <input type="text" class="form-control" placeholder="No. NI" id="no_ni" name="no_ni" required>
                          </div>
                          <div class="col-md-6 mb-3">
                            <label>Tgl. NI</label>
                            <input type="date" class="form-control" id="tgl_ni" name="tgl_ni" required>
                          </div>
                          <div class="col-md-6 mb-3">
                            <label>Sifat NI</label>
                            <select class="form-control" id="sifat_ni" name="sifat_ni" required>
                              <option value="" selected disabled>- Pilih -</option>
                              <option value="Segera">Segera</option>
                              <option value="Sangat Segera">Sangat Segera</option>
                            </select>
                          </div>
                          <div class="col-md-6 mb-3">
                            <label>Klasifikasi NI</label>
                            <select class="form-control" id="klasifikasi_ni" name="klasifikasi_ni" required>
                              <option value="" selected disabled>- Pilih -</option>
                              <option value="Rahasia">Rahasia</option>
                              <option value="Sangat Rahasia">Sangat Rahasia</option>
                          </div>
                          <h6><b>B. Referensi</b></h6>
                          <hr>

                          <div class="col-md-6 mb-3">
                            <label>No. LKAI</label>
                            <input type="text" class="form-control" placeholder="No. LKAI" required>
                          </div>

                          <div class="col-md-6 mb-3">
                            <label>Tgl. LKAI</label>
                            <input type="text" class="form-control" placeholder="Tanggal LKAI" required>
                          </div>

                        </div>
                      </div>

                      <!-- Right Column (Pejabat Selection) -->
                      <div class="col-lg-6">
                        <h6><b>C. Pejabat Penerima NI</b></h6>
                        <hr>
                        <!-- Select Pejabat 1 -->
                        <div class="col-lg-12 mb-3">
                          <label for="id_pejabat_penerima_ni">Pejabat Penerima NI</label>
                          <select class="form-control form-select select2" id="id_pejabat_penerima_ni" name="id_pejabat_penerima_ni" required>
                            <option value="" selected disabled>- Pilih -</option>
                            @foreach ($users as $user)
                              <option value="{{ $user->id_admin }}">{{ $user->name }} | {{ $user->jabatan }}
                              </option>
                            @endforeach
                          </select>
                        </div>

                        <div class="col-lg-12 mb-3">
                          <label>Uraian Informasi</label>
                          <textarea class="form-control" rows="3" placeholder="uraian informasi tentang indikasi Pelanggaran kepabeanan atau cukai" id="uraian_informasi_ni" name="uraian_informasi_ni" required></textarea>
                        </div>


                        <div class="col-lg-12 mb-3">
                          <label>Pejabat Penerbit NI</label>
                          <select class="form-control form-select select2" id="id_pejabat_penerbit_ni" name="id_pejabat_penerbit_ni" required>
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
    document.addEventListener("DOMContentLoaded", function() {
      const selects = [{
          id: "nhi-select",
          tab: "nhi-tab-item"
        },
        {
          id: "ni-select",
          tab: "ni-tab-item"
        },
        {
          id: "recommendations-select",
          tab: "recommendations-tab-item"
        },
        {
          id: "info-select",
          tab: "informations-tab-item"
        },
      ];

      selects.forEach(({
        id,
        tab
      }) => {
        const selectElement = document.getElementById(id);
        const tabElement = document.getElementById(tab);

        selectElement.addEventListener("change", function() {
          if (selectElement.value === "YA") {
            tabElement.style.display = "block";
            tabElement.classList.add("fade-in", "active");

            const tabContainer = document.querySelector(".tabs-container");
            const offsetTop = tabContainer.offsetTop;
            window.scrollTo({
              top: offsetTop - 70,
              behavior: "smooth",
            });

            const tabLink = tabElement.querySelector(".nav-link");
            tabLink.classList.add("highlight");
            setTimeout(() => tabLink.classList.remove("highlight"), 1000);
          } else {
            tabElement.style.display = "none";
            tabElement.classList.remove("active");
          }
        });
      });
    });
  </script>

  <style>
    .nav-link.highlight {
      color: #287F71 !important;
      transition: background-color 0.5s ease;
    }
  </style>


  <script>
    let ikhtisarCount = 0;

    function tambahIkhtisar() {
      ikhtisarCount++;

      const row = document.createElement('div');
      row.classList.add('row', 'align-items-center', 'mb-2');
      row.setAttribute('id', `ikhtisar-row-${ikhtisarCount}`);

      const colIkhtisar = document.createElement('div');
      colIkhtisar.classList.add('col-md-12', 'mb-2');
      const inputIkhtisar = document.createElement('textarea');
      inputIkhtisar.type = 'text';
      inputIkhtisar.classList.add('form-control');
      inputIkhtisar.placeholder = 'Ikhtisar';
      inputIkhtisar.name = 'ikhtisar[]';
      colIkhtisar.appendChild(inputIkhtisar);

      const colSumber = document.createElement('div');
      colSumber.classList.add('col-md-6', 'mb-2');
      const inputSumber = document.createElement('input');
      inputSumber.type = 'text';
      inputSumber.classList.add('form-control');
      inputSumber.placeholder = 'Sumber';
      inputSumber.name = 'sumber[]';
      colSumber.appendChild(inputSumber);

      const colValiditas = document.createElement('div');
      colValiditas.classList.add('col-md-6', 'mb-2');
      const inputValiditas = document.createElement('input');
      inputValiditas.type = 'text';
      inputValiditas.classList.add('form-control');
      inputValiditas.placeholder = 'Validitas';
      inputValiditas.name = 'validitas[]';
      colValiditas.appendChild(inputValiditas);

      const colRemove = document.createElement('div');
      colRemove.classList.add('col-md-12', 'mb-2');
      const btnRemove = document.createElement('button');
      btnRemove.type = 'button';
      btnRemove.classList.add('btn', 'btn-danger', 'w-100');
      btnRemove.innerText = 'Hapus';
      btnRemove.onclick = () => row.remove();
      colRemove.appendChild(btnRemove);

      row.appendChild(colIkhtisar);
      row.appendChild(colSumber);
      row.appendChild(colValiditas);
      row.appendChild(colRemove);

      document.getElementById('ikhtisar-container').appendChild(row);
      feather.replace();
    }
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
@endsection

@section('script')
  @vite(['resources/js/pages/datatable.init.js'])
@endsection
