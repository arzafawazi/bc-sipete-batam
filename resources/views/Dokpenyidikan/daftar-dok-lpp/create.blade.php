@extends('layouts.vertical', ['title' => 'Rekam Form Penyidikan'])

@section('css')
  @vite(['node_modules/datatables.net-bs5/css/dataTables.bootstrap5.min.css', 'node_modules/datatables.net-buttons-bs5/css/buttons.bootstrap5.min.css', 'node_modules/datatables.net-keytable-bs5/css/keyTable.bootstrap5.min.css', 'node_modules/datatables.net-responsive-bs5/css/responsive.bootstrap5.min.css', 'node_modules/datatables.net-select-bs5/css/select.bootstrap5.min.css'])
@endsection


@section('content')
  <div class="container-fluid">
    <div class="card mb-3 mt-4">
      <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="card-title mb-0">
          <i data-feather="book" style="width: 20px; height: 20px;" class="me-1"></i>
          Form Penyidikan
        </h5>
        <button type="button" class="btn btn-danger btn-sm" onclick="window.history.back()">
          <i data-feather="log-out"></i> Kembali
        </button>
      </div>

      <div class="card-body">
        <form action="{{ route('daftar-dok-lpp.store') }}" method="POST">
          @csrf

          <div class="card">

            <div class="row">
              <div class="col-md-3">
                <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                  <a class="nav-link mb-2 active" id="lpp-tab" data-bs-toggle="pill" href="#lpp" role="tab" aria-controls="lpp" aria-selected="true">
                    <span class="d-block d-sm-none">LPP</span>
                    <span class="d-none d-sm-block">LEMBAR PENERIMAAN PERKARA (LPP)</span>
                  </a>
                  <a class="nav-link mb-2" id="lpf-tab" data-bs-toggle="pill" href="#lpf" role="tab" aria-controls="lpf" aria-selected="false">
                    <span class="d-block d-sm-none">LPF</span>
                    <span class="d-none d-sm-block">LEMBAR PENELITIAN FORMAL (LPF)</span>
                  </a>
                  <a class="nav-link mb-2" id="pdp-tab" data-bs-toggle="pill" href="#pdp" role="tab" aria-controls="pdp" aria-selected="false">
                    <span class="d-block d-sm-none">PDP</span>
                    <span class="d-none d-sm-block">Penelitian Dugaan Pelanggaran (PDP)</span>
                  </a>
                  <a class="nav-link mb-2" id="lhp-tab" data-bs-toggle="pill" href="#lhp" role="tab" aria-controls="lhp" aria-selected="false">
                    <span class="d-block d-sm-none">LHP</span>
                    <span class="d-none d-sm-block">Lembar Hasil Penelitian (LHP)</span>
                  </a>
                </div>
              </div>

              <div class="col-md-9">
                <div class="overflow-auto" style="max-height: 408px;  padding: 10px;">
                  <div class="tab-content p-0 text-muted mt-md-0" id="v-pills-tabContent">


                    <div class="tab-pane fade show active" id="lpp" role="tabpanel" aria-labelledby="lpp-tab">
                      <div class="row">
                        <div class="col-lg-6">
                          <h6><b>Data Referensi</b></h6>
                          <hr>
                          <div class="row">
                            <input type="hidden" id="id_penyidikan" name="id_penyidikan" value="">
                            <input type="hidden" name="id_pasca_penindakan_ref" value="{{ old('id_pasca_penindakan_ref', $pascapenindakan->id_pasca_penindakan_ref) }}">

                            <div class="col-md-12 mb-3">
                              <label>Tipe Penyidikan</label>
                              <input type="text" class="form-control bg-primary text-white" value="{{ $tipe_penyidikan }}" readonly>
                            </div>

                            <div class="col-md-6 mb-3">
                              <label>No. SBP</label>
                              <input type="text" class="form-control bg-primary text-white" value="{{ old('no_sbp', $sbpData->no_sbp) }}" readonly>
                            </div>

                            <div class="col-md-6 mb-3">
                              <label>Tgl. SBP</label>
                              <input type="text" class="form-control bg-primary text-white" value="{{ old('tgl_sbp', $sbpData->tgl_sbp) }}" readonly>
                            </div>

                            <div class="col-md-6 mb-3">
                              <label>No. LP</label>
                              <input type="text" class="form-control bg-primary text-white" value="{{ old('no_lp', $pascapenindakan->no_lp) }}" readonly>
                            </div>

                            <div class="col-md-6 mb-3">
                              <label>Tgl. LP</label>
                              <input type="text" class="form-control bg-primary text-white" value="{{ old('tgl_lp', $pascapenindakan->tgl_lp) }}" readonly>
                            </div>

                            <h6><b>A. Data Awal</b></h6>
                            <hr>

                            <div class="col-md-6 mb-3">
                              <label>No. LPP</label>
                              <input type="text" class="form-control bg-primary text-white" name="no_lpp" value="{{ old('no_lpp', $no_ref->no_lpp) }}" readonly>
                            </div>
                            <div class="col-md-6 mb-3">
                              <label>Tgl. LPP</label>
                              <input type="date" class="form-control bg-primary text-white" name="tgl_lpp">
                            </div>

                            <div class="col-lg-12 mb-3">
                              <label>Pejabat 1 Penyidikan</label>
                              <select class="form-control form-select select2" name="id_1_pejabat_penyidik">
                                <option value="" selected disabled>- Pilih -</option>
                                @foreach ($users as $user)
                                  <option value="{{ $user->id_admin }}">{{ $user->name }} | {{ $user->jabatan }}</option>
                                @endforeach
                              </select>
                            </div>

                            <div class="col-lg-12 mb-3">
                              <label>Kepala Seksi Penyidikan</label>
                              <select class="form-control form-select select2" name="id_2_pejabat_penyidik">
                                <option value="" selected disabled>- Pilih -</option>
                                @foreach ($users as $user)
                                  <option value="{{ $user->id_admin }}">{{ $user->name }} | {{ $user->jabatan }}</option>
                                @endforeach
                              </select>
                            </div>
                          </div>
                        </div>

                        <div class="col-lg-6">
                          <h6><b>B. Data Lainnya</b></h6>
                          <hr>

                          <div class="col-md-12 mb-3">
                            <label>Asal Perkara</label>
                            <textarea class="form-control" rows="3" placeholder="Diisi asal perkara (nama unit/instansi yang menyerahkan perkara)" name="asal_perkara_lpp"></textarea>
                          </div>

                          <div class="col-md-12 mb-3">
                            <label>Jenis Penindakan</label>
                            <textarea class="form-control" rows="3" placeholder="Diisi jenis penindakan (penghentian sarana pengangkut/ pemeriksaan barang/penyegelan/Penegahan/penangkapan)." name="jenis_penindakan_lpp"></textarea>
                          </div>

                          <div class="col-md-12 mb-3">
                            <label>Jenis Perkara</label>
                            <textarea class="form-control" rows="3" placeholder="Diisi jenis perkara (impor umum/impor fasilitas/impor BKC/ cukai HT/cukai EA/cukai MMEA/ekspor/pengangkutan barang tertentu/ barang penumpang)." name="jenis_perkara_lpp"></textarea>
                          </div>

                          <div class="col-md-12 mb-3">
                            <label>Status Penangkapan</label>
                            <select name="status_pelanggaran_lpp" class="form-control form-select select2">
                              <option value="" selected disabled>- Pilih -</option>
                              <option value="Tertangkap Tangan">Tertangkap Tangan</option>
                              <option value="Tidak Tertangkap Tangan">Tidak Tertangkap Tangan</option>
                            </select>
                          </div>

                          <div class="col-lg-12 mb-3">
                            <label>Kepala Bidang Penindakan</label>
                            <select class="form-control form-select select2" name="kepala_bidang_penindakan_display" id="kepala_bidang_penindakan" disabled>
                              @foreach ($users as $user)
                                @if ($user->jabatan == 'Kepala Bidang Penindakan dan Penyidikan' && $user->status == 'AKTIF')
                                  <option value="{{ $user->id_admin }}" selected>{{ $user->name }} | {{ $user->jabatan }}</option>
                                @else
                                  <option value="{{ $user->id_admin }}">{{ $user->name }} | {{ $user->jabatan }}</option>
                                @endif
                              @endforeach
                            </select>
                            <input type="hidden" name="kepala_bidang_penindakan_lpp"
                              value="{{ old('kepala_bidang_penindakan', $pascapenindakan->kepala_bidang_penindakan ?? ($users->where('jabatan', 'Kepala Bidang Penindakan dan Penyidikan')->where('status', 'AKTIF')->first()->id_admin ?? '')) }}">
                          </div>
                        </div>
                      </div>

                      <div class="col-md-12 mb-3">
                        <label>Modus Operandi</label>
                        <textarea class="form-control" rows="3" placeholder="Modus Operandi" name="modus_operandi_lpp"></textarea>
                      </div>

                      <div class="card-body">
                        <div class="accordion accordion-flush" id="accordionFlushExample">
                          <div class="accordion-item">
                            <h2 class="accordion-header">
                              <button class="accordion-button btn bg-light fw-medium collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                                A. Barang Hasil Penindakan
                              </button>
                            </h2>
                            <div id="flush-collapseOne" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
                              <div class="accordion-body bg-light">
                                <div class="col-md-12 mb-3">
                                  <label>Jumlah Koli / jenis koli</label>
                                  <input type="text" class="form-control" placeholder="Jumlah Koli / jenis koli" name="jumlah_koli_lpp">
                                </div>

                                <div class="col-md-12 mb-3">
                                  <label>No Container / ukuran</label>
                                  <input type="text" class="form-control" placeholder="No Container / ukuran" name="no_container_lpp">
                                </div>

                                <div class="col-md-12 mb-3">
                                  <label>Keterangan Uraian Barang</label>
                                  <input type="text" class="form-control" placeholder="Keterangan Uraian" name="ket_uraian_bar_lpp">
                                </div>

                                <div class="col-md-12 mb-3">
                                  <label>Detail Uraian Barang</label>
                                  <textarea class="form-control" rows="3" placeholder="Detail Uraian Barang" name="detail_uraian_barang_lpp"></textarea>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>

                      <div class="col-md-12 mb-3">
                        <label>Catatan Atasan Pembuat LPP</label>
                        <textarea class="form-control" rows="3" placeholder="Catatan atasan pembuat LPP" name="catatan_lpp"></textarea>
                      </div>
                    </div>




                    <div class="tab-pane fade" id="lpf" role="tabpanel" aria-labelledby="lpf-tab">
                      <div class="row">

                        <h6><b>A. Data Awal</b></h6>
                        <hr>

                        <div class="row">
                          <div class="col-md-6 mb-3">
                            <label>No. LPF</label>
                            <input type="text" class="form-control bg-primary text-white" name="no_lpf" value="{{ old('no_lpf', $no_ref->no_lpf) }}" readonly>
                          </div>

                          <div class="col-md-6 mb-3">
                            <label>Tgl. LPF</label>
                            <input type="date" class="form-control bg-primary text-white" placeholder="yyyy-mm-dd" name="tgl_lpf">
                          </div>

                        </div>

                        <!-- Right Column (Sections C, D, and E) -->

                        <h6><b>B. Data Lainnya</b></h6>
                        <hr>

                        <div class="card-body">
                          <div class="accordion accordion-flush" id="accordionFlushExample">
                            <div class="accordion-item">
                              <h2 class="accordion-header">
                                <button class="accordion-button btn bg-light fw-medium collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOnes" aria-expanded="false" aria-controls="flush-collapseOnes">
                                  A. Barang Hasil Penindakan
                                </button>
                              </h2>
                              <div id="flush-collapseOnes" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
                                <div class="accordion-body bg-light">

                                  <!-- Form Inputs -->
                                  <div class="col-md-12 mb-3">
                                    <label>Merk Barang</label>
                                    <input type="text" class="form-control" placeholder="Merek Barang" name="merek_barang_lpf">
                                  </div>

                                  <div class="col-md-12 mb-3">
                                    <label>Kondisi Barang</label>
                                    <input type="text" class="form-control" placeholder="Kondisi Barang" name="kondisi_barang_lpf">
                                  </div>

                                  <div class="col-md-12 mb-3">
                                    <label>Tipe Barang</label>
                                    <input type="text" class="form-control" placeholder="Tipe Barang" name="tipe_barang_lpf">
                                  </div>

                                  <div class="col-md-12 mb-3">
                                    <label class="d-flex align-items-center">
                                      Spesifikasi Lain
                                      {{-- <button type="button" class="btn p-0 ms-1 text-primary" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip"
                                  data-bs-title="Diisi dengan mengapit #isi# disetiap point, dan enter untuk baris baru untuk point baru">
                                  <i data-feather="alert-circle" style="width: 18px; height: 18px;"></i>
                                </button> --}}
                                    </label>
                                    <textarea class="form-control" rows="3" placeholder="Spesifikasi Lain" name="spesifikasi_barang_lpf"></textarea>
                                  </div>


                                  <div class="col-md-12 mb-3">
                                    <label>Kantor Pendaftaran Dokumen</label>
                                    <input type="text" class="form-control" placeholder="Kantor Pendaftaran Dokumen" name="kantor_pendaftaran_lpf">
                                  </div>

                                </div>
                              </div>
                            </div>

                          </div>
                        </div>

                        <div class="col-md-12 mb-3">
                          <label class="d-flex align-items-center">
                            Kesimpulan
                            {{-- <button type="button" class="btn p-0 ms-1 text-primary" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip"
                                  data-bs-title="Diisi dengan mengapit #isi# disetiap point, dan enter untuk baris baru untuk point baru">
                                  <i data-feather="alert-circle" style="width: 18px; height: 18px;"></i>
                                </button> --}}
                          </label>
                          <textarea class="form-control" rows="3" placeholder="Kesimpulan LPF" name="kesimpulan_lpf"></textarea>
                        </div>

                        <div class="col-md-12 mb-3">
                          <label class="d-flex align-items-center">
                            Usulan
                            {{-- <button type="button" class="btn p-0 ms-1 text-primary" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip"
                                  data-bs-title="Diisi dengan mengapit #isi# disetiap point, dan enter untuk baris baru untuk point baru">
                                  <i data-feather="alert-circle" style="width: 18px; height: 18px;"></i>
                                </button> --}}
                          </label>
                          <textarea class="form-control" rows="3" placeholder="Usulan LPF" name="usulan_lpf"></textarea>
                        </div>

                        <div class="col-md-12 mb-3">
                          <label class="d-flex align-items-center">
                            Catatan/disposisi atasan
                            {{-- <button type="button" class="btn p-0 ms-1 text-primary" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip"
                                  data-bs-title="Diisi dengan mengapit #isi# disetiap point, dan enter untuk baris baru untuk point baru">
                                  <i data-feather="alert-circle" style="width: 18px; height: 18px;"></i>
                                </button> --}}
                          </label>
                          <textarea class="form-control" rows="3" placeholder="Catatan/disposisi atasan" name="catatan_lpf"></textarea>
                        </div>


                      </div>
                    </div>





                    <div class="tab-pane fade" id="pdp" role="tabpanel" aria-labelledby="pdp-tab">
                      <div class="row">

                        <div class="card-body">
                          <div class="accordion accordion-flush" id="accordionFlushExample">
                            <div class="accordion-item">
                              <h2 class="accordion-header">
                                <button class="accordion-button btn bg-light fw-medium collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOnets" aria-expanded="false" aria-controls="flush-collapseOnets">
                                  A. Surat Perintah Penelitian (SPLIT)
                                </button>
                              </h2>
                              <div id="flush-collapseOnets" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
                                <div class="accordion-body bg-light">

                                  <h6><b>A. Data Awal</b></h6>
                                  <hr>
                                  <div class="row">
                                    <div class="col-md-6 mb-3">
                                      <label>No. SPLIT</label>
                                      <input type="text" class="form-control bg-primary text-white" name="no_split" value="{{ old('no_split', $no_ref->no_split) }}" readonly>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                      <label>Tgl. SPLIT</label>
                                      <input type="date" class="form-control bg-primary text-white" placeholder="yyyy-mm-dd" name="tgl_split">
                                    </div>
                                  </div>

                                  <h3 class="text-center text-uppercase fw-bold border-bottom border-dark border-3 pb-2 mb-4 mx-auto" style="letter-spacing: 4px; max-width: 600px;">
                                    <span class="d-inline-block py-2">D I P E R I N T A H K A N</span>
                                  </h3>
                                  <div class="col-lg-12 mb-3">
                                    <label>Pejabat Yang Melakukan Penelitian</label>
                                    <select class="form-control form-select select2" name="pejabat_penelitian[]" multiple>
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



                        <div class="accordion accordion-flush" id="accordionFlushExample">
                          <div class="accordion-item">
                            <h2 class="accordion-header">
                              <button class="accordion-button btn bg-light fw-medium collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOnetsa" aria-expanded="false" aria-controls="flush-collapseOnetsa">
                                B. Berita Acara Wawancara (BAW)
                              </button>
                            </h2>
                            <div id="flush-collapseOnetsa" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
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


                        <div class="card-body">
                          <div class="accordion accordion-flush" id="accordionFlushExample">
                            <div class="accordion-item">
                              <h2 class="accordion-header">
                                <button class="accordion-button btn bg-light fw-medium collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOnetsv" aria-expanded="false" aria-controls="flush-collapseOnetsv">
                                  C. SURAT PERINTAH PENCACAHAN BARANG HASIL PENINDAKAN
                                </button>
                              </h2>
                              <div id="flush-collapseOnetsv" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
                                <div class="accordion-body bg-light">

                                  <h6><b>A. Data Awal</b></h6>
                                  <hr>
                                  <div class="row">
                                    <div class="col-md-6 mb-3">
                                      <label>No. Print Cacah</label>
                                      <input type="text" class="form-control bg-primary text-white" name="no_print_cacah" value="{{ old('no_print_cacah', $no_ref->no_print_cacah) }}" readonly>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                      <label>Tgl. Print Cacah</label>
                                      <input type="date" class="form-control bg-primary text-white" placeholder="yyyy-mm-dd" name="tgl_print_cacah">
                                    </div>
                                  </div>

                                  <h3 class="text-center text-uppercase fw-bold border-bottom border-dark border-3 pb-2 mb-4 mx-auto" style="letter-spacing: 4px; max-width: 600px;">
                                    <span class="d-inline-block py-2">D I P E R I N T A H K A N</span>
                                  </h3>

                                  <div class="col-lg-12 mb-3">
                                    <label>Pejabat Yang Melakukan Pencacahan</label>
                                    <select class="form-control form-select select2" name="pejabat_print_cacah[]" multiple>
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




                        <div class="accordion accordion-flush" id="accordionFlushExample">
                          <div class="accordion-item">
                            <h2 class="accordion-header">
                              <button class="accordion-button btn bg-light fw-medium collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOnetsaz" aria-expanded="false" aria-controls="flush-collapseOnetsaz">
                                D. Berita Acara Cacah (B.A Cacah)
                              </button>
                            </h2>
                            <div id="flush-collapseOnetsaz" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
                              <div class="accordion-body bg-light">

                                <h6><b>A. Data Awal</b></h6>
                                <hr>
                                <div class="row">
                                  <div class="col-md-6 mb-3">
                                    <label>No. B.A Cacah</label>
                                    <input type="text" class="form-control bg-primary text-white" name="no_ba_cacah" value="{{ old('no_ba_cacah', $no_ref->no_ba_cacah) }}" readonly>
                                  </div>
                                  <div class="col-md-6 mb-3">
                                    <label>Tgl. B.A Cacah</label>
                                    <input type="date" class="form-control bg-primary text-white" placeholder="yyyy-mm-dd" name="tgl_ba_cacah">
                                  </div>
                                </div>



                              </div>
                            </div>
                          </div>
                        </div>


                      </div>
                    </div>

                    <div class="tab-pane fade" id="lhp" role="tabpanel" aria-labelledby="lhp-tab">
                      <div class="row">

                        <h6><b>A. Data Awal</b></h6>
                        <hr>

                        <div class="row">
                          <div class="col-md-6 mb-3">
                            <label>No. LHP</label>
                            <input type="text" class="form-control bg-primary text-white" name="no_lhp_penyidikan" value="{{ old('no_lhp_penyidikan', $no_ref->no_lhp_penyidikan) }}" readonly>
                          </div>

                          <div class="col-md-6 mb-3">
                            <label>Tgl. LHP</label>
                            <input type="date" class="form-control bg-primary text-white" placeholder="yyyy-mm-dd" name="tgl_lhp_penyidikan">
                          </div>

                        </div>

                        <!-- Right Column (Sections C, D, and E) -->
                        <h6><b>B. Data Lainnya</b></h6>
                        <hr>

                        <div class="card-body">
                          <div class="accordion accordion-flush" id="accordionFlushExample">
                            <div class="accordion-item">
                              <h2 class="accordion-header">
                                <button class="accordion-button btn bg-light fw-medium collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOnes" aria-expanded="false" aria-controls="flush-collapseOnes">
                                  A. Barang Hasil Penindakan
                                </button>
                              </h2>
                              <div id="flush-collapseOnes" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
                                <div class="accordion-body bg-light">

                                  <!-- Form Inputs -->
                                  <div class="col-md-12 mb-3">
                                    <label>Merk Barang</label>
                                    <input type="text" class="form-control" placeholder="Merek Barang" name="merek_barang_lpf">
                                  </div>

                                  <div class="col-md-12 mb-3">
                                    <label>Kondisi Barang</label>
                                    <input type="text" class="form-control" placeholder="Kondisi Barang" name="kondisi_barang_lpf">
                                  </div>

                                  <div class="col-md-12 mb-3">
                                    <label>Tipe Barang</label>
                                    <input type="text" class="form-control" placeholder="Tipe Barang" name="tipe_barang_lpf">
                                  </div>

                                  <div class="col-md-12 mb-3">
                                    <label class="d-flex align-items-center">
                                      Spesifikasi Lain
                                      {{-- <button type="button" class="btn p-0 ms-1 text-primary" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip"
                                  data-bs-title="Diisi dengan mengapit #isi# disetiap point, dan enter untuk baris baru untuk point baru">
                                  <i data-feather="alert-circle" style="width: 18px; height: 18px;"></i>
                                </button> --}}
                                    </label>
                                    <textarea class="form-control" rows="3" placeholder="Spesifikasi Lain" name="spesifikasi_barang_lpf"></textarea>
                                  </div>


                                  <div class="col-md-12 mb-3">
                                    <label>Kantor Pendaftaran Dokumen</label>
                                    <input type="text" class="form-control" placeholder="Kantor Pendaftaran Dokumen" name="kantor_pendaftaran_lpf">
                                  </div>

                                </div>
                              </div>
                            </div>

                          </div>
                        </div>

                        <div class="col-md-12 mb-3">
                          <label class="d-flex align-items-center">
                            Kesimpulan
                            {{-- <button type="button" class="btn p-0 ms-1 text-primary" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip"
                                  data-bs-title="Diisi dengan mengapit #isi# disetiap point, dan enter untuk baris baru untuk point baru">
                                  <i data-feather="alert-circle" style="width: 18px; height: 18px;"></i>
                                </button> --}}
                          </label>
                          <textarea class="form-control" rows="3" placeholder="Kesimpulan LPF" name="kesimpulan_lpf"></textarea>
                        </div>

                        <div class="col-md-12 mb-3">
                          <label class="d-flex align-items-center">
                            Usulan
                            {{-- <button type="button" class="btn p-0 ms-1 text-primary" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip"
                                  data-bs-title="Diisi dengan mengapit #isi# disetiap point, dan enter untuk baris baru untuk point baru">
                                  <i data-feather="alert-circle" style="width: 18px; height: 18px;"></i>
                                </button> --}}
                          </label>
                          <textarea class="form-control" rows="3" placeholder="Usulan LPF" name="usulan_lpf"></textarea>
                        </div>

                        <div class="col-md-12 mb-3">
                          <label class="d-flex align-items-center">
                            Catatan/disposisi atasan
                            {{-- <button type="button" class="btn p-0 ms-1 text-primary" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip"
                                  data-bs-title="Diisi dengan mengapit #isi# disetiap point, dan enter untuk baris baru untuk point baru">
                                  <i data-feather="alert-circle" style="width: 18px; height: 18px;"></i>
                                </button> --}}
                          </label>
                          <textarea class="form-control" rows="3" placeholder="Catatan/disposisi atasan" name="catatan_lpf"></textarea>
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
