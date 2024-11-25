@extends('layouts.vertical', ['title' => 'Rekam Laporan Pengawasan'])

@section('css')
  @vite(['node_modules/datatables.net-bs5/css/dataTables.bootstrap5.min.css', 'node_modules/datatables.net-buttons-bs5/css/buttons.bootstrap5.min.css', 'node_modules/datatables.net-keytable-bs5/css/keyTable.bootstrap5.min.css', 'node_modules/datatables.net-responsive-bs5/css/responsive.bootstrap5.min.css', 'node_modules/datatables.net-select-bs5/css/select.bootstrap5.min.css'])
@endsection

@section('content')
  <div class="container-fluid ">
    <form action="{{ route('laporan-pengawasan.update', ['laporan_pengawasan' => $pengawasan->id]) }}" enctype="multipart/form-data" method="POST">
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
                          <input type="hidden" value="PENGAWASAN" name="id_pengawasan">
                          <div class="col-md-6 mb-3">
                            <label>No. Surat Tugas</label>
                            <input type="text" class="form-control bg-primary text-white" name="no_st" value="{{ old('no_st', $pengawasan->no_st) }}" readonly>
                          </div>
                          <div class="col-md-6 mb-3">
                            <label>Tgl. Surat Tugas</label>
                            <input type="date" class="form-control" placeholder="yyyy-mm-dd" id="tgl_st" name="tgl_st" value="{{ old('tgl_st', $pengawasan->tgl_st) }}">
                          </div>
                          <div class="col-lg-12 mb-3">
                            <label for="pengendali_operasi">Pengendali Operasi</label>
                            <select class="form-control form-select select2" id="pengendali_operasi" name="pengendali_operasi_st">
                              <option value="" selected disabled>- Pilih -</option>
                              @foreach ($users as $user)
                                <option value="{{ $user->id_admin }}" {{ old('pengendali_operasi_st', $pengawasan->pengendali_operasi_st) == $user->id_admin ? 'selected' : '' }}>
                                  {{ $user->name }}
                                </option>
                                </option>
                              @endforeach
                            </select>
                          </div>
                          <div class="col-lg-12 mb-3">
                            <label for="tim_operasi">Tim Operasi</label>
                            <select class="form-control form-select select2 " id="tim_operasi" name="tim_operasi_st[]" multiple>
                              {{-- <option value="" selected disabled>- Pilih -</option> --}}
                              @foreach ($users as $user)
                                <option value="{{ $user->id_admin }}" {{ in_array($user->id_admin, json_decode($pengawasan->tim_operasi_st)) ? 'selected' : '' }}>
                                  {{ $user->name }}
                                </option>
                              @endforeach
                            </select>
                          </div>
                          <div class="col-lg-12 mb-3">
                            <label for="tim_dukungan_operasi">Tim Dukungan Operasi</label>
                            <select class="form-control form-select select2 " id="tim_dukungan_operasi" name="tim_dukungan_operasi_st[]" multiple>
                              {{-- <option value="" selected disabled>- Pilih -</option> --}}
                              @foreach ($users as $user)
                                <option value="{{ $user->id_admin }}" {{ in_array($user->id_admin, json_decode($pengawasan->tim_dukungan_operasi_st)) ? 'selected' : '' }}>
                                  {{ $user->name }}
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
                          <textarea class="form-control form-input" placeholder="Di Isi Uraian Tugas" name="melaksanakan_tugas_st" rows="2">{{ old('melaksanakan_tugas_st', $pengawasan->melaksanakan_tugas_st) }}</textarea>
                        </div>

                        <div class="col-lg-12 mb-3">
                          <label for="wilayah_penugasan">Wilayah Penugasan</label>
                          <input type="text" class="form-control form-input" placeholder="Isi Wilayah Penugasan" value="{{ old('wilayah_penugasan_st', $pengawasan->wilayah_penugasan_st) }}" name="wilayah_penugasan_st">
                        </div>
                        <div class="row">
                          <div class="col-lg-6 mb-3">
                            <label for="tanggal_dimulai_tugas">Tanggal Dimulai</label>
                            <input type="date" class="form-control form-input" placeholder="yyyy-mm-dd" value="{{ old('tanggal_dimulai_st', $pengawasan->tanggal_dimulai_st) }}" name="tanggal_dimulai_st">
                          </div>
                          <div class="col-lg-6 mb-3">
                            <label for="tanggal_berakhir_tugas">Tanggal Berakhir</label>
                            <input type="date" class="form-control form-input" placeholder="yyyy-mm-dd" value="{{ old('tanggal_berakhir_st', $pengawasan->tanggal_berakhir_st) }}" name="tanggal_berakhir_st">
                          </div>
                        </div>
                        <div class="col-lg-12 mb-3">
                          <label for="nama_kantor">Nama Kantor Atau Unit</label>
                          <input type="text" class="form-control form-input" placeholder="Nama Kantor Atau Unit" value="{{ old('nama_kantor_st', $pengawasan->nama_kantor_st) }}" name="nama_kantor_st">
                        </div>

                        <div class="col-lg-12 mb-3">
                          <label for="tim_operasi">Penerbit Surat Tugas</label>
                          <select class="form-control form-select select2 " id="penerbit_surat_tugas" name="penerbit_st">
                            <option value="" selected disabled>- Pilih -</option>
                            @foreach ($users as $user)
                              <option value="{{ $user->id_admin }}" {{ old('penerbit_st', $pengawasan->penerbit_st) == $user->id_admin ? 'selected' : '' }}>
                                {{ $user->name }}
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
                              <input type="text" class="form-control bg-primary text-white" name="no_lpt" value="{{ old('no_lpt', $pengawasan->no_lpt) }}" readonly>
                            </div>
                            <div class="col-md-6 mb-3">
                              <label>Surat Tugas Nomor</label>
                              <input type="text" class="form-control bg-primary text-white" value="{{ old('no_st', $pengawasan->no_st) }}" readonly>{{-- ngambil dari no_st --}}
                            </div>
                          </div>
                          <!-- Media Informasi / Isi Informasi / Catatan -->
                          <div class="col-md-12 mb-3">
                            <label>Uraian Tugas</label>
                            <textarea class="form-control" name="uraian_tugas_lpt" rows="3">{{ old('uraian_tugas_lpt', $pengawasan->uraian_tugas_lpt) }}</textarea>
                          </div>

                          <div class="col-md-12 mb-3">
                            <label>Wilayah Penugasan</label>
                            <input type="text" class="form-control" name="wilayah_penugasan_lpt" value="{{ old('wilayah_penugasan_lpt', $pengawasan->wilayah_penugasan_lpt) }}" placeholder="Wilayah Penugasan">
                          </div>

                          <div class="col-md-12 mb-3">
                            <label>Uraian Periode Penugasan</label>
                            <input type="text" id="date-range-picker" name="uraian_periode_penugasan_lpt" value="{{ old('uraian_periode_penugasan_lpt', $pengawasan->uraian_periode_penugasan_lpt) }}" class="form-control"
                              placeholder="Pilih Uraian Periode Penugasan">
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
                                      <input type="text" class="form-control form-input" name="tempat_pengumpulan_informasi_lpt" value="{{ old('tempat_pengumpulan_informasi_lpt', $pengawasan->tempat_pengumpulan_informasi_lpt) }}"
                                        placeholder="Tempat Pengumpulan Informasi">
                                    </div>
                                  </div>

                                  <div class="row mb-3 form-group">
                                    <label class="col-sm-4 col-form-label">
                                      b. Sumber Informasi
                                    </label>
                                    <div class="col-sm-8">
                                      <input type="text" class="form-control form-input" name="sumber_informasi_lpt" value="{{ old('sumber_informasi_lpt', $pengawasan->sumber_informasi_lpt) }}" placeholder="Sumber Informasi">
                                    </div>
                                  </div>

                                  <div class="row mb-3 form-group">
                                    <label class="col-sm-4 col-form-label">
                                      c. Metode Pengumpulan Informasi
                                    </label>
                                    <div class="col-sm-8">
                                      <input type="text" class="form-control form-input" name="metode_pengumpulan_informasi_lpt" value="{{ old('metode_pengumpulan_informasi_lpt', $pengawasan->metode_pengumpulan_informasi_lpt) }}"
                                        placeholder="Metode Pengumpulan Informasi">
                                    </div>
                                  </div>

                                  <div class="row mb-3 form-group">
                                    <label class="col-sm-4 col-form-label">
                                      d. Ikhtisar Informasi
                                    </label>
                                    <div class="col-sm-8">
                                      <input type="text" class="form-control" placeholder="Ikhtisar Informasi" value="{{ old('ikhtisar_informasi_lpt', $pengawasan->ikhtisar_informasi_lpt) }}" name="ikhtisar_informasi_lpt">
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
                                      <input type="text" class="form-control form-input" value="{{ old('jenis_dok_kepabeanan_lpt', $pengawasan->jenis_dok_kepabeanan_lpt) }}" name="jenis_dok_kepabeanan_lpt"
                                        placeholder="Jenis Dokumen Kepabeanan">
                                    </div>
                                  </div>

                                  <div class="row mb-3 form-group">
                                    <label class="col-sm-4 col-form-label">b. Nomor dan Tanggal Dokumen Kepabeanan </label>
                                    <div class="col-sm-8">
                                      <input type="text" class="form-control form-input" value="{{ old('no_tgl_dok_kepabeanan_lpt', $pengawasan->no_tgl_dok_kepabeanan_lpt) }}" name="no_tgl_dok_kepabeanan_lpt"
                                        placeholder="Nomor dan Tanggal Dokumen Kepabeanan">
                                    </div>
                                  </div>

                                  <div class="row mb-3 form-group">
                                    <label class="col-sm-4 col-form-label">c. Metode Analisis Intelijen </label>
                                    <div class="col-sm-8">
                                      <input type="text" class="form-control form-input" value="{{ old('metode_analisis_intelijen_lpt', $pengawasan->metode_analisis_intelijen_lpt) }}" name="metode_analisis_intelijen_lpt"
                                        placeholder="Metode Analisis Intelijen">
                                    </div>
                                  </div>

                                  <div class="row mb-3 form-group">
                                    <label class="col-sm-4 col-form-label">d. Ikhtisar Hasil Analisis Intelijen </label>
                                    <div class="col-sm-8">
                                      <input type="text" class="form-control" placeholder="Ikhtisar Hasil Analisis Intelijen" value="{{ old('ikhtisar_hasil_analisis_intelijen', $pengawasan->ikhtisar_hasil_analisis_intelijen) }}"
                                        name="ikhtisar_hasil_analisis_intelijen_lpt">
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
                                        <input type="text" class="form-control form-input" value="{{ old('jenis_pelanggaran_lpt', $pengawasan->jenis_pelanggaran_lpt) }}" name="jenis_pelanggaran_lpt" placeholder="Jenis Pelanggaran">
                                      </div>
                                    </div>

                                    <div class="row mb-3 form-group">
                                      <label class="col-sm-4 col-form-label">b. Modus Pelanggaran </label>
                                      <div class="col-sm-8">
                                        <input type="text" class="form-control form-input" name="modus_pelanggaran_lpt" value="{{ old('modus_pelanggaran_lpt', $pengawasan->modus_pelanggaran_lpt) }}" placeholder="Modus Pelanggaran">
                                      </div>
                                    </div>

                                    <div class="row mb-3 form-group">
                                      <label class="col-sm-4 col-form-label">c. Perkiraan Tempat Pelanggaran </label>
                                      <div class="col-sm-8">
                                        <input type="text" class="form-control form-input" name="perkiraan_tempat_pelanggaran_lpt" value="{{ old('perkiraan_tempat_pelanggaran_lpt', $pengawasan->perkiraan_tempat_pelanggaran_lpt) }}"
                                          placeholder="Perkiraan Tempat Pelanggaran">
                                      </div>
                                    </div>

                                    <div class="row mb-3 form-group">
                                      <label class="col-sm-4 col-form-label">d. Perkiraan Waktu Pelanggaran</label>
                                      <div class="col-sm-8">
                                        <input type="time" class="form-control form-input" name="perkiraan_waktu_pelanggaran_lpt" value="{{ old('perkiraan_waktu_pelanggaran_lpt', $pengawasan->perkiraan_waktu_pelanggaran_lpt) }}"
                                          placeholder="Perkiraan Waktu Pelanggaran">
                                      </div>
                                    </div>

                                    <div class="row mb-3 form-group">
                                      <label class="col-sm-4 col-form-label">e. Perkiraan Pelaku Pelanggaran </label>
                                      <div class="col-sm-8">
                                        <input type="text" class="form-control form-input" name="perkiraan_pelaku_pelanggaran_lpt" value="{{ old('perkiraan_pelaku_pelanggaran_lpt', $pengawasan->perkiraan_pelaku_pelanggaran_lpt) }}"
                                          placeholder="Perkiraan Pelaku Pelanggaran">
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
                                      <label class="col-sm-4 col-form-label">Dokumentasi Foto</label>
                                      <div class="col-sm-8">

                                        <input type="file" class="form-control form-input" value="{{ old('dokumentasi_foto_lpt', $pengawasan->dokumentasi_foto_lpt) }}" name="dokumentasi_foto_lpt[]" multiple>
                                        @if ($pengawasan->dokumentasi_foto_lpt)
                                          <div>
                                            <button type="button" class="btn btn-primary btn-sm mt-2" data-bs-toggle="modal" data-bs-target="#fotoModal" onclick="setMediaModal('{{ $pengawasan->dokumentasi_foto_lpt }}', 'foto')">
                                              <i data-feather="image" style="width: 16px; height: 16px;" class="me-1"></i> Lihat Foto
                                            </button>
                                          </div>
                                        @endif
                                      </div>
                                    </div>

                                    <div class="modal fade" id="fotoModal" tabindex="-1" aria-labelledby="fotoModalLabel" aria-hidden="true">
                                      <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                          <div class="modal-header">
                                            <h5 class="modal-title" id="fotoModalLabel">Dokumentasi Foto</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                          </div>
                                          <div class="modal-body" id="fotoModalBody" align="center">
                                            <!-- Foto akan ditambahkan secara dinamis disini -->
                                          </div>
                                        </div>
                                      </div>
                                    </div>

                                     <div class="row mb-3 form-group">
                                      <label class="col-sm-4 col-form-label">Dokumentasi Audio</label>
                                      <div class="col-sm-8">
                                      <input id="rekaman-audio" name="dokumentasi_audio_lpt" value="{{old('dokumentasi_audio_lpt', $pengawasan->dokumentasi_audio_lpt)}}" class="form-control" placeholder="Masukkan Link Audio">
                                      </div>
                                    </div>

                                    <div class="row mb-3 form-group">
                                      <label class="col-sm-4 col-form-label">Rekaman Video</label>
                                      <div class="col-sm-8">
                                        <input id="rekaman-video" name="dokumentasi_video_lpt" value="{{old('dokumentasi_video_lpt', $pengawasan->dokumentasi_video_lpt)}}" class="form-control" placeholder="Masukkan Link Video">
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
                                      <textarea class="form-control" name="info_lainnya_lpt" rows="3">{{ old('info_lainnya_lpt', $pengawasan->info_lainnya_lpt) }}</textarea>
                                    </div>

                                    <div class="row mb-3 form-group">
                                      <label for="Kesimpulan">Kesimpulan</label>
                                      <textarea class="form-control" name="kesimpulan_lpt" rows="3"> {{ old('kesimpulan_lpt', $pengawasan->kesimpulan_lpt) }}</textarea>
                                    </div>

                                    <div class="row mb-3 form-group">
                                      <label for="Rekomendasi">Rekomendasi</label>
                                      <textarea class="form-control" name="rekomendasi_lpt" rows="3"> {{ old('rekomendasi_lpt', $pengawasan->rekomendasi_lpt) }}</textarea>
                                    </div>


                                  </div>
                                </div>
                              </div>

                              <div class="col-lg-12 mb-3 mt-3">
                                <label for="ketua_tim">Ketua Tim Pelaksanaan Tugas</label>
                                <select class="form-control form-select select2" id="ketua_tim" name="ketua_tim_lpt">
                                  <option value="" selected disabled>- Pilih -</option>
                                  @foreach ($users as $user)
                                    <option value="{{ $user->id_admin }}" {{ old('ketua_tim_lpt', $pengawasan->ketua_tim_lpt) == $user->id_admin ? 'selected' : '' }}>
                                      {{ $user->name }}
                                    </option>
                                  @endforeach
                                </select>
                              </div>

                              <div class="col-lg-12 mb-3">
                                <label for="pegawai_pembuat_laporan">Pegawai Pembuat Laporan</label>
                                <select class="form-control form-select select2" id="pegawai_pembuat" name="pegawai_pembuat_lpt">
                                  <option value="" selected disabled>- Pilih -</option>
                                  @foreach ($users as $user)
                                    <option value="{{ $user->id_admin }}" {{ old('pegawai_pembuat_lpt', $pengawasan->pegawai_pembuat_lpt) == $user->id_admin ? 'selected' : '' }}>
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

                  <div class="tab-pane" id="lppi" role="tabpanel">
                    <div class="row">
                      <div class="col-lg-6">
                        <h6><b>A. Lembar Pengumpulan Dan Penilaian Informasi</b></h6>
                        <hr>
                        <div class="row">
                          <div class="col-md-6 mb-3">
                            <label>No. LPPI</label>
                            <input type="text" class="form-control bg-primary text-white" value="{{ old('no_lppi', $pengawasan->no_lppi) }}" placeholder="No. LPPI" value="{{ old('no_lppi', $no_ref->no_lppi) }}" id="no_lppi" name="no_lppi"
                              disabled>
                          </div>
                          <div class="col-md-6 mb-3">
                            <label>Tgl. LPPI</label>
                            <input type="date" class="form-control" id="tgl_lppi" value="{{ old('tgl_lpi', $pengawasan->tgl_lpi) }}" name="tgl_lppi">
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
                                      <label class="col-sm-4 col-form-label">ISI DATA</label>
                                      <div class="col-sm-8">
                                        <select id="internal" class="form-select" name="internal_lppi"> <!-- Ubah ID di sini -->
                                          <option value="" selected disabled>- Pilih -</option>
                                          <option value="TIDAK" {{ old('internal_lppi', $pengawasan->internal_lppi) == 'TIDAK' ? 'selected' : '' }}>TIDAK</option>
                                          <option value="YA" {{ old('internal_lppi', $pengawasan->internal_lppi) == 'YA' ? 'selected' : '' }}>YA</option>
                                        </select>
                                      </div>
                                    </div>


                                    <!-- Form Inputs -->

                                    <div class="row mb-3 form-group">
                                      <label class="col-sm-4 col-form-label">
                                        Media
                                      </label>
                                      <div class="col-sm-8">
                                        <input type="text" class="form-control form-input" value="{{ old('media_internal_lppi'), $pengawasan->media_internal_lppi }}" name="media_internal_lppi" placeholder="Media Internal">
                                      </div>
                                    </div>

                                    <div class="row mb-3 form-group">
                                      <label class="col-sm-4 col-form-label">
                                        Tanggal Terima
                                      </label>
                                      <div class="col-sm-8">
                                        <input type="date" class="form-control" value="{{ old('tanggal_terima_internal_lppi', $pengawasan->tanggal_terima_internal_lppi) }}" name="tanggal_terima_internal_lppi">
                                      </div>
                                    </div>

                                    <div class="row mb-3 form-group">
                                      <label class="col-sm-4 col-form-label">
                                        No. Dokumen
                                      </label>
                                      <div class="col-sm-8">
                                        <input type="text" class="form-control" value="{{ old('no_dokumen_internal_lppi', $pengawasan->no_dokumen_internal_lppi) }}" placeholder="No. Dokumen" name="no_dokumen_internal_lppi">
                                      </div>
                                    </div>

                                    <div class="row mb-3 form-group">
                                      <label class="col-sm-4 col-form-label">
                                        Tanggal Dokumen
                                      </label>
                                      <div class="col-sm-8">
                                        <input type="date" class="form-control" value="{{ old('tanggal_dokumen_internal_lppi', $pengawasan->tanggal_dokumen_internal_lppi) }}" name="tanggal_dokumen_internal_lppi">
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
                                        <select id="eksternal" class="form-select" name="eksternal_lppi"> <!-- Ubah ID di sini -->
                                          <option value="" selected disabled>- Pilih -</option>
                                          <option value="TIDAK" {{ old('eksternal_lppi', $pengawasan->eksternal_lppi) == 'TIDAK' ? 'selected' : '' }}>TIDAK</option>
                                          <option value="YA" {{ old('eksternal_lppi', $pengawasan->eksternal_lppi) == 'YA' ? 'selected' : '' }}>YA</option>
                                        </select>
                                      </div>
                                    </div>

                                    <!-- Form Inputs -->
                                    <div class="row mb-3 form-group">
                                      <label class="col-sm-4 col-form-label">Media</label>
                                      <div class="col-sm-8">
                                        <input type="text" class="form-control form-input" name="media_eksternal_lppi" value="{{ old('media_eksternal_lppi', $pengawasan->media_eksternal_lppi) }}" placeholder="Media Eksternal">
                                      </div>
                                    </div>

                                    <div class="row mb-3 form-group">
                                      <label class="col-sm-4 col-form-label">Tanggal Terima</label>
                                      <div class="col-sm-8">
                                        <input type="date" class="form-control" name="tanggal_terima_eksternal_lppi" value="{{ old('tanggal_terima_eksternal_lppi', $pengawasan->tanggal_terima_eksternal_lppi) }}">
                                      </div>
                                    </div>

                                    <div class="row mb-3 form-group">
                                      <label class="col-sm-4 col-form-label">No. Dokumen </label>
                                      <div class="col-sm-8">
                                        <input type="text" class="form-control form-input" name="no_dokumen_eksternal_lppi" value="{{ old('no_dokumen_eksternal_lppi', $pengawasan->no_dokumen_eksternal_lppi) }}" placeholder="No. Dokumen">
                                      </div>
                                    </div>

                                    <div class="row mb-3 form-group">
                                      <label class="col-sm-4 col-form-label">Tanggal Dokumen</label>
                                      <div class="col-sm-8">
                                        <input type="date" class="form-control" value="{{ old('tanggal_dokumen_eksternal_lppi', $pengawasan->tanggal_dokumen_eksternal_lppi) }}" name="tanggal_dokumen_eksternal_lppi">
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
                          <textarea class="form-control" rows="3" placeholder="Kesimpulan Lembar Pengumpulan Dan Penilaian Informasi" id="kesimpulan" name="kesimpulan_lppi"> {{ old('kesimpulan_lppi', $pengawasan->kesimpulan_lppi) }}</textarea>
                        </div>

                        <div class="row">
                          <div class="col-lg-6 mb-3">
                            <label for="pegawai_lppi">Pegawai Yang Menerima Disposisi</label>
                            <select class="form-control form-select select2" id="pegawai_lppi" name="pegawai_lppi">
                              <option value="" selected disabled>- Pilih -</option>
                              @foreach ($users as $user)
                                <option value="{{ $user->id_admin }}" {{ old('pegawai_lppi', $pengawasan->pegawai_lppi) == $user->id_admin ? 'selected' : '' }}>
                                  {{ $user->name }}
                                </option>
                              @endforeach
                            </select>
                          </div>



                          <div class="col-md-6 mb-3">
                            <label>Tanggal Disposisi</label>
                            <input type="date" class="form-control" value="{{ old('tanggal_disposisi_lppi', $pengawasan->tanggal_disposisi_lppi) }}" id="tanggal_disposisi" name="tanggal_disposisi_lppi">
                          </div>
                        </div>

                        <div class="col-md-12 mb-3">
                          <label class="col-sm-4 col-form-label">Tindak Lanjut</label>
                          <select class="form-select" name="tindak_lanjut_lppi"> <!-- Ubah ID di sini -->
                            <option value="" selected disabled>- Pilih -</option>
                            <option value="TIDAK" {{ old('tindak_lanjut_lppi', $pengawasan->tindak_lanjut_lppi) == 'TIDAK' ? 'selected' : '' }}>TIDAK</option>
                            <option value="YA" {{ old('tindak_lanjut_lppi', $pengawasan->tindak_lanjut_lppi) == 'YA' ? 'selected' : '' }}>YA</option>
                          </select>
                        </div>

                        <div class="col-md-12 mb-3">
                          <label>Catatan</label>
                          <textarea class="form-control" rows="3" value="{{ old('catatan_lppi', $pengawasan->catatan_lppi) }}" placeholder="Catatan Lembar Pengumpulan Dan Penilaian Informasi" id="catatan" name="catatan_lppi"></textarea>
                        </div>

                        <div class="col-lg-12 mb-3">
                          <label for="pejabat_lppi">Pejabat Pengawas</label>
                          <select class="form-control form-select select2" id="pejabat_lppi" name="pejabat_lppi">
                            <option value="" selected disabled>- Pilih -</option>
                            @foreach ($users as $user)
                              <option value="{{ $user->id_admin }}" {{ old('pejabat_lppi', $pengawasan->pejabat_lppi) == $user->id_admin ? 'selected' : '' }}>
                                {{ $user->name }}
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
                            <input type="text" name="no_lkai" value="{{ old('no_lkai', $pengawasan->no_lkai) }}" class="form-control bg-primary text-white" disabled>
                          </div>
                          <div class="col-md-6 mb-3">
                            <label>tgl. LKAI</label>
                            <input type="date" class="form-control bg-primary text-white" value="{{ old('tgl_lkai', $pengawasan->tgl_lkai) }}" name="tgl_lkai">
                          </div>
                          <div class="card-body">
                            <div class="accordion accordion-flush" id="accordionFlushExample">
                              <div class="accordion-item">
                                <h2 class="accordion-header">
                                  <button class="accordion-button btn bg-light fw-medium collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseAA" aria-expanded="false" aria-controls="flush-collapseAA">
                                    LPPI
                                  </button>
                                </h2>
                                <div id="flush-collapseAA" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
                                  <div class="accordion-body bg-light">

                                    <div class="row mb-3">
                                      <label class="col-sm-4 col-form-label">Sumber LPPI</label>
                                      <div class="col-sm-8">
                                        <select class="form-select" name="sumber_lppi"> <!-- Ubah ID di sini -->
                                          <option value="" selected disabled>- Pilih -</option>
                                          <option value="TIDAK" {{ old('sumber_lppi', $pengawasan->sumber_lppi) == 'TIDAK' ? 'selected' : '' }}>TIDAK</option>
                                          <option value="YA" {{ old('sumber_lppi', $pengawasan->sumber_lppi) == 'YA' ? 'selected' : '' }}>YA</option>
                                        </select>
                                      </div>
                                    </div>

                                    <div class="row mb-3 form-group">
                                      <label class="col-sm-4 col-form-label">No. LPPI </label>
                                      <div class="col-sm-8">
                                        <input type="text" class="form-control form-input bg-primary text-white" placeholder="NO LPPI" id="no_lppi_disabled" disable>
                                      </div>
                                    </div>

                                    <div class="row mb-3 form-group">
                                      <label class="col-sm-4 col-form-label">Tanggal LPPI</label>
                                      <div class="col-sm-8">
                                        <input type="date" id="tgl_lppi_disabled" class="form-control bg-primary text-white" disabled>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </div>

                              {{-- <div class="accordion-item">
                                <h2 class="accordion-header">
                                  <button class="accordion-button btn bg-light fw-medium collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseBB" aria-expanded="false" aria-controls="flush-collapseBB">
                                    NPI
                                  </button>
                                </h2>
                                <div id="flush-collapseBB" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
                                  <div class="accordion-body bg-light">

                                    <div class="row mb-3">
                                      <label class="col-sm-4 col-form-label">Sumber NPI</label>
                                      <div class="col-sm-8">
                                        <select class="form-select" name="sumber_npi"> <!-- Ubah ID di sini -->
                                          <option value="TIDAK">TIDAK</option>
                                          <option value="YA">Ya</option>
                                        </select>
                                      </div>
                                    </div>

                                    <div class="row mb-3 form-group">
                                      <label class="col-sm-4 col-form-label">No. NPI </label>
                                      <div class="col-sm-8">
                                        <input type="text" class="form-control form-input bg-primary text-white" placeholder="NO NPI">
                                      </div>
                                    </div>

                                    <div class="row mb-3 form-group">
                                      <label class="col-sm-4 col-form-label">Tanggal LPPI</label>
                                      <div class="col-sm-8">
                                        <input type="date" class="form-control bg-primary text-white">
                                      </div>
                                    </div>

                                  </div>
                                </div>
                              </div> --}}

                            </div>

                          </div>
                          <h6><b>B. Ikhtisar Data Informasi</b></h6>
                          <hr>
                          <div class="col-md-12 mb-3">
                            <label>Ikhtisar Data Atau Informasi</label>
                            <textarea class="form-control" row="2" placeholder="Ikhtisar Data Atau Informasi" id="ikhtisar_data_lkai" name="ikhtisar_data_lkai">{{ old('ikhtisar_data_lkai', $pengawasan->ikhtisar_data_lkai) }}</textarea>
                          </div>


                          <div class="col-md-12 mb-3">
                            <label>Prosedur Analisis</label>
                            <textarea class="form-control" row="2" placeholder="Prosedur Analisis" id="prosedur_analisis_lkai" name="prosedur_analisis_lkai">{{ old('prosedur_analisis_lkai', $pengawasan->prosedur_analisis_lkai) }}</textarea>
                          </div>

                          <div class="col-md-12 mb-3">
                            <label>Hasil Analisis</label>
                            <textarea class="form-control" row="2" placeholder="Hasil Analisis" id="hasl_analisis" name="hasil_analisis_lkai">{{ old('hasil_analisis_lkai', $pengawasan->hasil_analisis_lkai) }}</textarea>
                          </div>

                          <div class="col-md-12 mb-3">
                            <label>Kesimpulan</label>
                            <textarea class="form-control" row="2" placeholder="Kesimpulan" id="kesimpulan" name="kesimpulan_lkai">{{ old('kesimpulan_lkai', $pengawasan->kesimpulan_lkai) }}</textarea>
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
                              <option value="TIDAK" {{ old('nhi', $pengawasan->nhi) == 'TIDAK' ? 'selected' : '' }}>TIDAK</option>
                              <option value="YA" {{ old('nhi', $pengawasan->nhi) == 'YA' ? 'selected' : '' }}>YA</option>
                            </select>
                          </div>
                          <div class="col-sm-6">
                            <label for="ni-select">NI</label>
                            <select id="ni-select" class="form-select" name="ni">
                              <option value="TIDAK" {{ old('ni', $pengawasan->ni) == 'TIDAK' ? 'selected' : '' }}>TIDAK</option>
                              <option value="YA" {{ old('ni', $pengawasan->ni) == 'YA' ? 'selected' : '' }}>YA</option>
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
                                          <option value="TIDAK" {{ old('rekomendasi_lainnya', $pengawasan->rekomendasi_lainnya) == 'TIDAK' ? 'selected' : '' }}>TIDAK</option>
                                          <option value="YA" {{ old('rekomendasi_lainnya', $pengawasan->rekomendasi_lainnya) == 'YA' ? 'selected' : '' }}>YA</option>
                                        </select>
                                      </div>
                                    </div>


                                    <!-- Form Inputs -->

                                    <div class="row mb-3 form-group">
                                      <label class="col-sm-4 col-form-label">
                                        Isi Rekomendasi Lainnya
                                      </label>
                                      <div class="col-sm-8">
                                        <textarea class="form-control" row="2" placeholder="Isi Rekomendasi Lainnya" id="isi_rekomendasi_lainnya" name="isi_rekomendasi_lainnya">{{ old('isi_rekomendasi_lainnya', $pengawasan->isi_rekomendasi_lainnya) }}</textarea>
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
                                          <option value="TIDAK" {{ old('informasi_lainnya', $pengawasan->informasi_lainnya) == 'TIDAK' ? 'selected' : '' }}>TIDAK</option>
                                          <option value="YA" {{ old('informasi_lainnya', $pengawasan->informasi_lainnya) == 'YA' ? 'selected' : '' }}>YA</option>
                                        </select>
                                      </div>
                                    </div>

                                    <!-- Form Inputs -->
                                    <div class="row mb-3 form-group">
                                      <label class="col-sm-4 col-form-label">Isi Informasi Lainnya</label>
                                      <div class="col-sm-8">
                                        <textarea class="form-control" row="2" placeholder="Isi Informasi Lainnya" id="isi_informasi_lainnya" name="isi_informasi_lainnya"> {{ old('isi_informasi_lainnya', $pengawasan->isi_informasi_lainnya) }}  </textarea>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>

                          <div class="col-md-12 mb-3">
                            <label>Tujuan</label>
                            <input type="text" class="form-control" value="{{ old('tujuan_lkai', $pengawasan->tujuan_lkai) }}" placeholder="Tujuan" name="tujuan_lkai">
                          </div>

                          <div class="col-md-12 mb-3">
                            <label>Pegawai Yang Melakukan Analisis</label>
                            <select class="form-control form-select select2" id="id_pegawai_analisis" name="id_pegawai_analisis_lkai">
                              <option value="" selected disabled>- Pilih -</option>
                              @foreach ($users as $user)
                                <option value="{{ $user->id_admin }}" {{ old('id_pegawai_analisis', $pengawasan->id_pegawai_analisis_lkai) == $user->id_admin ? 'selected' : '' }}>
                                  {{ $user->name }} | {{ $user->jabatan }}
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
                                        <select id="keputusan_pertama" class="form-select" name="keputusan_pertama_lkai"> <!-- Ubah ID di sini -->
                                          <option value="TIDAK" {{ old('keputusan_pertama', $pengawasan->keputusan_pertama_lkai) == 'TIDAK' ? 'selected' : '' }}>TIDAK</option>
                                          <option value="YA" {{ old('keputusan_pertama', $pengawasan->keputusan_pertama_lkai) == 'YA' ? 'selected' : '' }}>YA</option>
                                        </select>
                                      </div>
                                    </div>

                                    <!-- Form Inputs -->
                                    <div class="row mb-3 form-group">
                                      <label class="col-sm-4 col-form-label">
                                        Pejabat Pengawas
                                      </label>
                                      <div class="col-sm-8">
                                        <select class="form-control form-select select2" id="id_pejabat_pengawas_lkai" name="id_pejabat_pengawas_lkai">
                                          <option value="" selected disabled>- Pilih -</option>
                                          @foreach ($users as $user)
                                            <option value="{{ $user->id_admin }}" {{ old('id_pejabat_pengawas', $pengawasan->id_pejabat_pengawas_lkai) == $user->id_admin ? 'selected' : '' }}>
                                              {{ $user->name }} | {{ $user->jabatan }}
                                            </option>
                                          @endforeach
                                        </select>
                                      </div>
                                    </div>

                                    <div class="row mb-3 form-group">
                                      <label class="col-sm-4 col-form-label">Catatan</label>
                                      <div class="col-sm-8">
                                        <textarea class="form-control" row="2" placeholder="Catatan" id="catatan" name="catatan_keputusan_1_lkai">{{ old('catatan_keputusan_1_lkai', $pengawasan->catatan_keputusan_1_lkai) }}</textarea>
                                      </div>
                                    </div>

                                    <div class="row mb-3 form-group">
                                      <label class="col-sm-4 col-form-label">Hasil Analisis Diterima Tanggal</label>
                                      <div class="col-sm-8">
                                        <input type="date" class="form-control" value="{{ old('hasil_analisis_diterima_tanggal_1_lkai', $pengawasan->hasil_analisis_diterima_tanggal_1_lkai) }}" name="hasil_analisis_diterima_tanggal_1_lkai">
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
                                        <select id="keputusan_kedua" class="form-select" name="keputusan_kedua_lkai"> <!-- Ubah ID di sini -->
                                          <option value="TIDAK" {{ old('keputusan_kedua', $pengawasan->keputusan_kedua_lkai) == 'TIDAK' ? 'selected' : '' }}>TIDAK</option>
                                          <option value="YA" {{ old('keputusan_kedua', $pengawasan->keputusan_kedua_lkai) == 'YA' ? 'selected' : '' }}>YA</option>
                                        </select>
                                      </div>
                                    </div>

                                    <!-- Form Inputs -->
                                    <div class="row mb-3 form-group">
                                      <label class="col-sm-4 col-form-label">
                                        Pejabat Administrator
                                      </label>
                                      <div class="col-sm-8">
                                        <select class="form-control form-select select2" id="id_pejabat_administrator_lkai" name="id_pejabat_administrator_lkai">
                                          <option value="" selected disabled>- Pilih -</option>
                                          @foreach ($users as $user)
                                            <option value="{{ $user->id_admin }}" {{ old('id_pejabat_administrator', $pengawasan->id_pejabat_administrator_lkai) == $user->id_admin ? 'selected' : '' }}>
                                              {{ $user->name }} | {{ $user->jabatan }}
                                            </option>
                                          @endforeach
                                        </select>
                                      </div>
                                    </div>

                                    <div class="row mb-3 form-group">
                                      <label class="col-sm-4 col-form-label">Catatan</label>
                                      <div class="col-sm-8">
                                        <textarea class="form-control" row="2" placeholder="Catatan" id="catatan" name="catatan_keputusan_2_lkai">{{ old('catatan_keputusan_2_lkai', $pengawasan->catatan_keputusan_2_lkai) }}</textarea>
                                      </div>
                                    </div>

                                    <div class="row mb-3 form-group">
                                      <label class="col-sm-4 col-form-label">Hasil Analisis Diterima Tanggal</label>
                                      <div class="col-sm-8">
                                        <input type="date" class="form-control" value="{{ old('hasil_analisis_diterima_tanggal_2_lkai', $pengawasan->hasil_analisis_diterima_tanggal_2_lkai) }}" name="hasil_analisis_diterima_tanggal_2_lkai">
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
                            <input type="text" class="form-control" value="{{ old('no_nhi', $pengawasan->no_nhi) }}" placeholder="No. NHI" id="no_nhi" name="no_nhi">
                          </div>
                          <div class="col-md-6 mb-3">
                            <label>Tanggal NHI</label>
                            <input type="date" class="form-control" value="{{ old('tgl_nhi', $pengawasan->tgl_nhi) }}" id="tgl_nhi" name="tgl_nhi">
                          </div>
                          <div class="col-md-6 mb-3">
                            <label>Sifat NHI</label>
                            <select class="form-control" id="sifat_nhi" name="sifat_nhi">
                              <option value="" selected disabled>- Pilih -</option>
                              <option value="Segera" {{ old('sifat_nhi', $pengawasan->sifat_nhi) == 'Segera' ? 'selected' : '' }}>Segera</option>
                              <option value="Sangat Segera" {{ old('sifat_nhi', $pengawasan->sifat_nhi) == 'Sangat Segera' ? 'selected' : '' }}>Sangat Segera</option>
                            </select>
                          </div>
                          <div class="col-md-6 mb-3">
                            <label>Klasifikasi NHI</label>
                            <select class="form-control" id="klasifikasi_nhi" name="klasifikasi_nhi">
                              <option value="" selected disabled>- Pilih -</option>
                              <option value="Biasa" {{ old('klasifikasi_nhi', $pengawasan->klasifikasi_nhi) == 'Biasa' ? 'selected' : '' }}>Biasa</option>
                              <option value="Rahasia" {{ old('klasifikasi_nhi', $pengawasan->klasifikasi_nhi) == 'Rahasia' ? 'selected' : '' }}>Rahasia</option>
                            </select>
                          </div>
                          <h6><b>B. Referensi</b></h6>
                          <hr>
                          <div class="col-md-6 mb-3">
                            <label>No. LKAI</label>
                            <input type="text" class="form-control" value="{{ old('no_lkai', $pengawasan->no_lkai) }}" placeholder="No. LKAI" value="">
                          </div>

                          <div class="col-md-6 mb-3">
                            <label>Tgl. LKAI</label>
                            <input type="date" class="form-control" value="{{ old('tgl_lkai', $pengawasan->tgl_lkai) }}" placeholder="Tanggal LKAI" value=}}">
                          </div>

                          <div class="col-md-12 mb-3">
                            <label>Jabatan Penerima NHI</label>
                            <select class="form-control form-select select2" id="id_penerima_nhi" name="id_penerima_nhi">
                              <option value="" selected disabled>- Pilih -</option>
                              @foreach ($users as $user)
                                <option value="{{ $user->id_admin }}" {{ old('id_penerima_nhi', $pengawasan->id_penerima_nhi) == $user->id_admin ? 'selected' : '' }}>
                                  {{ $user->name }} | {{ $user->jabatan }}
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
                                      <input type="text" class="form-control form-input" value="{{ old('nama_tempat_nhi', $pengawasan->nama_tempat_nhi) }}" name="nama_tempat_nhi" placeholder="Nama Tempat">
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
                                      <input type="date" class="form-control" value="{{ old('tgl_waktu_nhi', $pengawasan->tgl_waktu_nhi) }}" name="tgl_waktu_nhi">
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
                                      <input type="text" class="form-control form-input" name="kantor_bc_nhi" value="{{ old('kantor_bc_nhi', $pengawasan->kantor_bc_nhi) }}" placeholder="Kantor Bea dan Cukai">
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
                                      <input type="text" class="form-control form-input" name="nama_no_dokumen_kepabeanan_nhi" value="{{ old('nama_no_dokumen_kepabeanan_nhi', $pengawasan->nama_no_dokumen_kepabeanan_nhi) }}"
                                        placeholder="nama_no_dokumen_kepabeanan">
                                    </div>
                                  </div>

                                  <div class="row mb-3 form-group">
                                    <label class="col-sm-4 col-form-label">2. Eks/Untuk Kapal/Pesawat/Alat Angkut/Lainnya</label>
                                    <div class="col-sm-8">
                                      <input type="text" class="form-control form-input" value="{{ old('kapal_pesawat_nhi', $pengawasan->kapal_pesawat_nhi) }}" name="kapal_pesawat_nhi"
                                        placeholder="Eks/Untuk Kapal/Pesawat/Alat Angkut/Lainnya">
                                    </div>
                                  </div>

                                  <div class="row mb-3 form-group">
                                    <label class="col-sm-4 col-form-label">No.Polisi</label>
                                    <div class="col-sm-8">
                                      <input type="text" class="form-control form-input" value="{{ old('no_polisi_nhi', $pengawasan->no_polisi_nhi) }}" name="no_polisi_nhi" placeholder="No Polisi">
                                    </div>
                                  </div>

                                  <div class="row mb-3 form-group">
                                    <label class="col-sm-4 col-form-label">3. No. BL/AWB</label>
                                    <div class="col-sm-8">
                                      <input type="text" class="form-control form-input" value="{{ old('no_bl_awb_nhi', $pengawasan->no_bl_awb_nhi) }}" name="no_bl_awb_nhi" placeholder="No. BL/AWB">
                                    </div>
                                  </div>

                                  <div class="row mb-3 form-group">
                                    <label class="col-sm-4 col-form-label">4. No. kontainer/Merek Koli</label>
                                    <div class="col-sm-8">
                                      <input type="text" class="form-control form-input" value="{{ old('no_kontainer_merk_koli_nhi', $pengawasan->no_kontainer_merk_koli_nhi) }}" name="no_kontainer_merk_koli_nhi"
                                        placeholder="No. kontainer/Merek Koli">
                                    </div>
                                  </div>

                                  <div class="row mb-3 form-group">
                                    <label class="col-sm-4 col-form-label">5. Importir/Eksportir/PPJK</label>
                                    <div class="col-sm-8">
                                      <input type="text" class="form-control form-input" value="{{ old('importir_eksportir_nhi', $pengawasan->importir_eksportir_nhi) }}" name="importir_eksportir_nhi"
                                        placeholder="Importir/Eksportir/PPJK">
                                    </div>
                                  </div>

                                  <div class="row mb-3 form-group">
                                    <label class="col-sm-4 col-form-label">6. NPWP</label>
                                    <div class="col-sm-8">
                                      <input type="text" class="form-control form-input" value="{{ old('npwp_nhi', $pengawasan->npwp_nhi) }}" name="npwp_nhi" placeholder="NPWP">
                                    </div>
                                  </div>

                                  <div class="row mb-3 form-group">
                                    <label class="col-sm-4 col-form-label">7. Jenis/Jumlah barang</label>
                                    <div class="col-sm-8">
                                      <input type="text" class="form-control form-input" value="{{ old('jenis_jumlah_barang_nhi', $pengawasan->jenis_jumlah_barang_nhi) }}" name="jenis_jumlah_barang_nhi" placeholder="Jenis/Jumlah barang">
                                    </div>
                                  </div>

                                  <div class="row mb-3 form-group">
                                    <label class="col-sm-4 col-form-label">8. Data Lainnya</label>
                                    <div class="col-sm-8">
                                      <input type="text" class="form-control form-input" value="{{ old('data_lainnya_a', $pengawasan->data_lainnya_a) }}" name="data_lainnya_a" placeholder="Data Lainnya">
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
                                      <input type="text" class="form-control form-input" value="{{ old('eks_pabrik', $pengawasan->eks_pabrik) }}" name="eks_pabrik" placeholder="Eks Pabrik/Tempat Penyimpanan/Tempat Penimbunan">
                                    </div>
                                  </div>

                                  <div class="row mb-3 form-group">
                                    <label class="col-sm-4 col-form-label">2. Penyalur</label>
                                    <div class="col-sm-8">
                                      <input type="text" class="form-control form-input" value="{{ old('penyalur', $pengawasan->penyalur) }}" name="penyalur" placeholder="penyalur">
                                    </div>
                                  </div>

                                  <div class="row mb-3 form-group">
                                    <label class="col-sm-4 col-form-label">3. Tempat Penjualan Eceran</label>
                                    <div class="col-sm-8">
                                      <input type="text" class="form-control form-input" value="{{ old('tempat_penjualan_eceran', $pengawasan->tempat_penjualan_eceran) }}" name="tempat_penjualan_eceran"
                                        placeholder="Tempat Penjualan Eceran">
                                    </div>
                                  </div>

                                  <div class="row mb-3 form-group">
                                    <label class="col-sm-4 col-form-label">4. NPPBKC</label>
                                    <div class="col-sm-8">
                                      <input type="text" class="form-control form-input" value="{{ old('nppbkc', $pengawasan->nppbkc) }}" name="nppbkc" placeholder="NPPBKC">
                                    </div>
                                  </div>

                                  <div class="row mb-3 form-group">
                                    <label class="col-sm-4 col-form-label">5. Eks/Untuk Kapal/Pesawat/Alat Angkut/Lainnya</label>
                                    <div class="col-sm-8">
                                      <input type="text" class="form-control form-input" value="{{ old('kapal_pesawat_b', $pengawasan->kapal_pesawat_b) }}" name="kapal_pesawat_b" placeholder="Eks/Untuk Kapal/Pesawat/Alat Angkut/Lainnya">
                                    </div>
                                  </div>

                                  <div class="row mb-3 form-group">
                                    <label class="col-sm-4 col-form-label">No. Polisi</label>
                                    <div class="col-sm-8">
                                      <input type="text" class="form-control form-input" value="{{ old('no_polisi_b', $pengawasan->no_polisi_b) }}" name="no_polisi_b" placeholder="no_polisi">
                                    </div>
                                  </div>

                                  <div class="row mb-3 form-group">
                                    <label class="col-sm-4 col-form-label">6. Jenis/Jumlah barang</label>
                                    <div class="col-sm-8">
                                      <input type="text" class="form-control form-input" value="{{ old('jenis_jumlah_barang_b', $pengawasan->jenis_jumlah_barang_b) }}" name="jenis_jumlah_barang_b" placeholder="Jenis/Jumlah barang">
                                    </div>
                                  </div>

                                  <div class="row mb-3 form-group">
                                    <label class="col-sm-4 col-form-label">8. Data Lainnya</label>
                                    <div class="col-sm-8">
                                      <input type="text" class="form-control form-input" value="{{ old('data_lainnya_b', $pengawasan->data_lainnya_b) }}" name="data_lainnya_b" placeholder="Data Lainnya">
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
                                      <input type="text" class="form-control form-input" value="{{ old('nama_no_dok', $pengawasan->nama_no_dok) }}" name="nama_no_dok" placeholder="Nama/No. Dokumen">
                                    </div>
                                  </div>

                                  <div class="row mb-3 form-group">
                                    <label class="col-sm-4 col-form-label">2. Eks/Untuk Kapal/Pesawat/Alat Angkut/Lainnya</label>
                                    <div class="col-sm-8">
                                      <input type="text" class="form-control form-input" value="{{ old('kapal_pesawat_c', $pengawasan->kapal_pesawat_c) }}" name="kapal_pesawat_c" placeholder="Eks/Untuk Kapal/Pesawat/Alat Angkut/Lainnya">
                                    </div>
                                  </div>

                                  <div class="row mb-3 form-group">
                                    <label class="col-sm-4 col-form-label">No. Polisi</label>
                                    <div class="col-sm-8">
                                      <input type="text" class="form-control form-input" value="{{ old('no_polisi_c', $pengawasan->no_polisi_c) }}" name="no_polisi_c" placeholder="No Polisi">
                                    </div>
                                  </div>

                                  <div class="row mb-3 form-group">
                                    <label class="col-sm-4 col-form-label">3. No. BL/AWB</label>
                                    <div class="col-sm-8">
                                      <input type="text" class="form-control form-input" value="{{ old('no_bl_awb_b', $pengawasan->no_bl_awb_b) }}" name="no_bl_awb_b" placeholder="No. BL/AWB">
                                    </div>
                                  </div>

                                  <div class="row mb-3 form-group">
                                    <label class="col-sm-4 col-form-label">4. No. kontainer/Merek Koli</label>
                                    <div class="col-sm-8">
                                      <input type="text" class="form-control form-input" value="{{ old('no_kontainer_merek_koli_b', $pengawasan->no_kontainer_merek_koli_b) }}" name="no_kontainer_merek_koli_b"
                                        placeholder="No. kontainer/Merek Koli">
                                    </div>
                                  </div>


                                  <div class="row mb-3 form-group">
                                    <label class="col-sm-4 col-form-label">5. Orang Pribadi/Badan Hukum</label>
                                    <div class="col-sm-8">
                                      <input type="text" class="form-control form-input" value="{{ old('orang_pribadi_badan_hukum_nhi', $pengawasan->orang_pribadi_badan_hukum_nhi) }}" name="orang_pribadi_badan_hukum_nhi"
                                        placeholder="Orang Pribadi/Badan Hukum">
                                    </div>
                                  </div>

                                  <div class="row mb-3 form-group">
                                    <label class="col-sm-4 col-form-label">6. Jenis/Jumlah barang</label>
                                    <div class="col-sm-8">
                                      <input type="text" class="form-control form-input" value="{{ old('jenis_jumlah_barang_c', $pengawasan->jenis_jumlah_barang_c) }}" name="jenis_jumlah_barang_c" placeholder="Jenis/Jumlah barang">
                                    </div>
                                  </div>

                                  <div class="row mb-3 form-group">
                                    <label class="col-sm-4 col-form-label">8. Data Lainnya</label>
                                    <div class="col-sm-8">
                                      <input type="text" class="form-control form-input" value="{{ old('data_lainnya_c', $pengawasan->data_lainnya_c) }}" name="data_lainnya_c" placeholder="Data Lainnya">
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>

                          </div>
                        </div>

                        <div class="col-md-12 mb-3">
                          <label>Indikasi</label>
                          <textarea class="form-control" rows="4" placeholder="Indikasi" id="indikasi" name="indikasi_nhi"> {{ old('indikasi_nhi', $pengawasan->indikasi_nhi) }}</textarea>
                        </div>

                        <div class="col-lg-12 mb-3">
                          <label>Pejabat Penerbit NHI</label>
                          <select class="form-control form-select select2" id="id_pejabat_penerbit_nhi" name="id_pejabat_penerbit_nhi">
                            <option value="" selected disabled>- Pilih -</option>
                            @foreach ($users as $user)
                              <option value="{{ $user->id_admin }}" {{ old('id_pejabat_penerbit_nhi', $pengawasan->id_pejabat_penerbit_nhi) == $user->id_admin ? 'selected' : '' }}>
                                {{ $user->name }} | {{ $user->jabatan }}
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
                            <input type="text" class="form-control" value="{{ old('no_ni', $pengawasan->no_ni) }}" placeholder="No. NI" id="no_ni" name="no_ni">
                          </div>

                          <div class="col-md-6 mb-3">
                            <label>Tgl. NI</label>
                            <input type="date" class="form-control" value="{{ old('tgl_ni', $pengawasan->tgl_ni) }}" id="tgl_ni" name="tgl_ni">
                          </div>

                          <div class="col-md-6 mb-3">
                            <label>Sifat NI</label>
                            <select class="form-control" id="sifat_ni" name="sifat_ni">
                              <option value="" selected disabled>- Pilih -</option>
                              <option value="Segera" {{ old('sifat_ni', $pengawasan->sifat_ni) == 'Segera' ? 'selected' : '' }}>Segera</option>
                              <option value="Sangat Segera" {{ old('sifat_ni', $pengawasan->sifat_ni) == 'Sangat Segera' ? 'selected' : '' }}>Sangat Segera</option>
                            </select>
                          </div>

                          <div class="col-md-6 mb-3">
                            <label>Klasifikasi NI</label>
                            <select class="form-control" id="klasifikasi_ni" name="klasifikasi_ni">
                              <option value="" selected disabled>- Pilih -</option>
                              <option value="Rahasia" {{ old('klasifikasi_ni', $pengawasan->klasifikasi_ni) == 'Rahasia' ? 'selected' : '' }}>Rahasia</option>
                              <option value="Sangat Rahasia" {{ old('klasifikasi_ni', $pengawasan->klasifikasi_ni) == 'Sangat Rahasia' ? 'selected' : '' }}>Sangat Rahasia</option>
                            </select>
                          </div>

                          <h6><b>B. Referensi</b></h6>
                          <hr>

                          <div class="col-md-6 mb-3">
                            <label>No. LKAI</label>
                            <input type="text" class="form-control" value="{{ old('no_lkai', $pengawasan->no_lkai) }}" placeholder="No. LKAI">
                          </div>

                          <div class="col-md-6 mb-3">
                            <label>Tgl. LKAI</label>
                            <input type="text" class="form-control" value="{{ old('tgl_lkai', $pengawasan->tgl_lkai) }}" placeholder="Tanggal LKAI">
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
                          <select class="form-control form-select select2" id="id_pejabat_penerima_ni" name="id_pejabat_penerima_ni">
                            <option value="" selected disabled>- Pilih -</option>
                            @foreach ($users as $user)
                              <option value="{{ $user->id_admin }}" {{ old('id_pejabat_penerima_ni', $pengawasan->id_pejabat_penerima_ni) == $user->id_admin ? 'selected' : '' }}>
                                {{ $user->name }} | {{ $user->jabatan }}
                              </option>
                            @endforeach
                          </select>
                        </div>

                        <div class="col-lg-12 mb-3">
                          <label>Uraian Informasi</label>
                          <textarea class="form-control" rows="3" placeholder="uraian informasi tentang indikasi Pelanggaran kepabeanan atau cukai" id="uraian_informasi_ni" name="uraian_informasi_ni">{{ old('uraian_informasi_ni', $pengawasan->uraian_informasi_ni) }}</textarea>
                        </div>


                        <div class="col-lg-12 mb-3">
                          <label>Pejabat Penerbit NI</label>
                          <select class="form-control form-select select2" id="id_pejabat_penerbit_ni" name="id_pejabat_penerbit_ni">
                            <option value="" selected disabled>- Pilih -</option>
                            @foreach ($users as $user)
                              <option value="{{ $user->id_admin }}" {{ old('id_pejabat_penerbit_ni', $pengawasan->id_pejabat_penerbit_ni) == $user->id_admin ? 'selected' : '' }}>
                                {{ $user->name }} | {{ $user->jabatan }}
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
    const inputSource = document.getElementById('no_lppi');
    const inputSource2 = document.getElementById('tgl_lppi');
    const inputTarget = document.getElementById('no_lppi_disabled');
    const inputTarget2 = document.getElementById('tgl_lppi_disabled');

    function syncValue1() {
      inputTarget.value = inputSource.value;
    }

    function syncValue2() {
      inputTarget2.value = inputSource2.value;
    }

    syncValue1();
    syncValue2();

    inputSource.addEventListener('input', syncValue1);
    inputSource2.addEventListener('input', syncValue2);
  </script>

  <script>
    // Fungsi untuk menampilkan media dalam modal
    function setMediaModal(fileUrls, type) {
      if (type === 'foto') {
        // Clear the modal content before appending new images
        const modalBody = document.getElementById('fotoModalBody');
        modalBody.innerHTML = ''; // Reset modal content

        // Check if fileUrls is a JSON string, then parse it
        if (typeof fileUrls === 'string') {
          fileUrls = JSON.parse(fileUrls); // Parse the JSON string if it's a string
        }

        // Loop through each image URL and append it to the modal
        fileUrls.forEach(function(fotoUrl) {
          // Create a new image element for each URL
          const img = document.createElement('img');
          img.src = `{{ asset('storage/') }}/${fotoUrl}`; // Generate the correct path
          img.className = 'img-fluid w-100 mb-2'; // Add classes for styling
          img.alt = 'Foto Laporan Pengawasan';

          // Append the image to the modal body
          modalBody.appendChild(img);
        });
      } else if (type === 'audio') {
        document.getElementById('audioModalPlayer').src = fileUrls;
      } else if (type === 'video') {
        document.getElementById('videoModalPlayer').src = fileUrls;
      }
    }
  </script>
@endsection

@section('script')
  @vite(['resources/js/pages/datatable.init.js'])
@endsection
