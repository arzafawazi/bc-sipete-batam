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
                            <input type="text" id="id_penyidikan" name="id_penyidikan" value="">
                            <input type="text" name="id_pasca_penindakan_ref" value="{{ old('id_pasca_penindakan', $pascapenindakan->id_pasca_penindakan) }}">

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

                      <div class="col-lg-12 mb-3">
                        <label class="col-sm-10 col-form-label">Dugaan Pelanggaran</label>
                        <select class="form-control form-input form-select select2" name="dugaan_pelanggaran_lpp">
                          <option value="" selected disabled>- Pilih -</option>
                          @foreach ($jenisPelanggaran as $pelanggaran)
                            <option value="{{ $pelanggaran->alasan_penindakan }} ({{ $pelanggaran->jenis_pelanggaran }})">{{ $pelanggaran->alasan_penindakan }} ({{ $pelanggaran->jenis_pelanggaran }})
                            </option>
                          @endforeach
                        </select>
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
                                  <label>Komoditi</label>
                                  <input type="text" class="form-control" placeholder="Komoditi" name="komoditi_lpp">
                                </div>

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
                                  </label>
                                  <textarea class="form-control" rows="3" placeholder="Spesifikasi Lain" name="spesifikasi_barang_lpf"></textarea>
                                </div>


                                <div class="col-md-12 mb-3">
                                  <label>Kantor Pendaftaran Dokumen</label>
                                  <input type="text" class="form-control" placeholder="Kantor Pendaftaran Dokumen" name="kantor_pendaftaran_lpf">
                                </div>



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

                                <div class="col-md-6 mb-3">
                                  <label>Tgl. Berita Acara Wawancara</label>
                                  <input type="date" class="form-control bg-primary text-white" placeholder="yyyy-mm-dd" name="tgl_baw">
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


                        <div class="col-12 mt-5">
                          <div class="card">
                            <div class="card-body table-responsive shadow p-3 mb-5 bg-white rounded">
                              <button type="button" class="btn btn-soft-info btn-icon btn-sm rounded-pill" data-bs-toggle="modal" data-bs-target=".bs-example-modal-lg">
                                <i data-feather="plus-circle" class="icon-sm"></i> Tambah Data Barang
                              </button>
                              <table class="table table-hover align-middle border-separate" style="border-spacing: 0 8px;">
                                <thead>
                                  <tr class="bg-light">
                                    <th class="text-center px-3 py-3" style="width: 5%">No</th>
                                    <th class="px-3 text-center py-3" style="width: 25%">Kategori Barang</th>
                                    <th class="px-3 text-center py-3" style="width: 25%">Uraian Barang</th>
                                    <th class="px-3 text-center py-3" style="width: 15%">Jumlah</th>
                                    <th class="px-3 text-center py-3" style="width: 15%">Satuan</th>
                                    <th class="px-3 text-center py-3" style="width: 15%">Spesifikasi(merk/tipe/ukr)</th>
                                    <th class="px-3 text-center py-3" style="width: 15%">Negara</th>
                                    <th class="px-3 text-center py-3" style="width: 15%">Kondisi</th>
                                    <th class="text-center px-3 py-3" style="width: 20%">Lartas</th>
                                    <th class="text-center px-3 py-3" style="width: 20%">Keterangan</th>
                                    <th class="text-center px-3 py-3" style="width: 20%">Opsi</th>
                                  </tr>
                                </thead>
                                <tbody align="center" id="tableBody">
                                </tbody>
                                <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                  <div class="modal-dialog modal-dialog-centered modal-lg">
                                    <div class="modal-content">
                                      <!-- Modal Header -->
                                      <div class="modal-header bg-primary text-white border-bottom-0">
                                        <i data-feather="package" class="icon-lg"></i>&nbsp;&nbsp;
                                        <h5 class="modal-title" id="exampleModalLabel">Detail Barang</h5>
                                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                                      </div>

                                      <!-- Modal Body -->
                                      <div class="modal-body p-4" style="max-height: 65vh; overflow-y: auto;">
                                        <form>
                                          <!-- Always visible fields -->
                                          <div class="row mb-4">
                                            <div class="col-md-6">
                                              <label for="kategori-barang" class="form-label fw-bold">Kategori Barang</label>
                                              <select class="form-select form-input select2" id="kategori-barang" name="kategori_barang">
                                                <option value="">-- Pilih Kategori Barang --</option>
                                                <option value="pabean">Barang Pabean</option>
                                                <option value="cukai">Barang Kena Cukai</option>
                                                <option value="pabean_cukai">Barang Pabean dan Barang Kena Cukai</option>
                                              </select>
                                            </div>
                                          </div>

                                          <!-- Default Fields -->
                                          <div class="default-fields mb-4">
                                            <div class="mb-3">
                                              <label for="kode-komoditi" class="form-label fw-bold">Kode Komoditi</label>
                                              <input type="text" class="form-control" name="kode_komoditi" id="kode-komoditi" placeholder="Kode Komoditi">
                                            </div>
                                            <div class="mb-3">
                                              <label for="jenis-barang" class="form-label fw-bold">Jenis Barang / Uraian Barang</label>
                                              <textarea class="form-control" name="jenis_barang" id="jenis-barang" rows="3" placeholder="Jenis Barang/Uraian Barang"></textarea>
                                            </div>
                                          </div>

                                          <!-- Pabean Fields -->
                                          <div id="pabean-fields" class="d-none">
                                            <h6><b>Ciri Khusus Barang Pabean</b></h6>
                                            <hr>
                                            <div class="row">
                                              <div class="col-md-6 mb-3">
                                                <label for="merk-pabean" class="form-label fw-bold">Merk</label>
                                                <input type="text" class="form-control" name="merk_pabean" id="merk-pabean" placeholder="Masukkan Merk Barang">
                                              </div>
                                              <div class="col-md-6 mb-3">
                                                <label for="tipe-pabean" class="form-label fw-bold">Tipe</label>
                                                <input type="text" class="form-control"name="tipe_pabean" id="tipe-pabean" placeholder="Masukkan Tipe Barang">
                                              </div>
                                            </div>
                                            <div class="col-md-12 mb-3">
                                              <label for="ukuran-kapasitas" class="form-label fw-bold">Ukuran/Kapasitas</label>
                                              <input type="text" class="form-control" name="ukuran_kapasitas" id="ukuran-kapasitas" placeholder="Masukkan Ukuran/Kapasitas">
                                            </div>
                                            <div class="row">
                                              <div class="col-md-6 mb-3">
                                                <label for="jumlah" class="form-label fw-bold">Jumlah</label>
                                                <input type="number" class="form-control" name="jumlah" id="jumlah" placeholder="Masukkan Jumlah">
                                              </div>
                                              <div class="col-md-6 mb-3">
                                                <label for="satuan" class="form-label fw-bold">Satuan</label>
                                                <input type="text" class="form-control" name="satuan" id="satuan" placeholder="Masukkan Satuan">
                                              </div>
                                            </div>
                                            <div class="row">
                                              <div class="col-md-6 mb-3">
                                                <label for="negara-asal" class="form-label fw-bold">Negara Asal</label>
                                                <select class="form-select select2" placeholder="Masukkan Negara Asal" id="negara-asal" name="negara_asal">
                                                  <option value="" disabled selected>- Pilih Kewarganegaraan -</option>
                                                  @foreach ($nama_negara as $benua => $negara)
                                                    <optgroup label="{{ $benua }}">
                                                      @foreach ($negara as $item)
                                                        <option value="{{ $item->UrEdi }}">{{ $item->UrEdi }}</option>
                                                      @endforeach
                                                    </optgroup>
                                                  @endforeach
                                                </select>
                                              </div>
                                              <div class="col-md-6 mb-3">
                                                <label for="kondisi-pabean" class="form-label fw-bold">Kondisi</label>
                                                <input type="text" class="form-control" name="kondisi_pabean" id="kondisi-pabean" placeholder="Masukkan Kondisi Barang">
                                              </div>
                                            </div>
                                          </div>

                                          <!-- Cukai Fields -->
                                          <div id="cukai-fields" class="d-none">
                                            <h6><b>Ciri Khusus Barang Kena Cukai</b></h6>
                                            <hr>
                                            <div class="row">
                                              <div class="col-md-6 mb-3">
                                                <label for="merk-cukai" class="form-label fw-bold">Merk</label>
                                                <input type="text" name="merk_cukai" class="form-control" id="merk-cukai" placeholder="Merk Barang">
                                              </div>
                                              <div class="col-md-6 mb-3">
                                                <label for="tipe-cukai" class="form-label fw-bold">Tipe</label>
                                                <input type="text" class="form-control" name="tipe_cukai" id="tipe-cukai" placeholder="Tipe Barang">
                                              </div>
                                              <div class="col-md-6 mb-3">
                                                <label for="kadar-cukai" class="form-label fw-bold">Kadar</label>
                                                <input type="text" class="form-control" name="kadar_cukai" id="kadar-cukai" placeholder="Kadar Barang">
                                              </div>
                                              <div class="col-md-6 mb-3">
                                                <label for="subyek-cukai" class="form-label fw-bold">Subyek Cukai</label>
                                                <input type="text" class="form-control" name="subyek_cukai" id="subyek-cukai" placeholder="Subyek Cukai">
                                              </div>
                                              <div class="col-md-6 mb-3">
                                                <label class="form-label fw-bold">Tahun</label>
                                                <input type="text" class="form-control" name="tahun" id="tahun" placeholder="Masukkan Tahun">
                                              </div>
                                              <div class="col-md-6 mb-3">
                                                <label class="form-label fw-bold">Gol.</label>
                                                <input type="text" class="form-control" name="gol" id="gol" placeholder="Golongan">
                                              </div>
                                              <div class="col-md-6 mb-3">
                                                <label class="form-label fw-bold">Tarif</label>
                                                <input type="text" class="form-control" name="tarif" id="tarif" placeholder="Tarif">
                                              </div>
                                              <div class="col-md-6 mb-3">
                                                <label class="form-label fw-bold">Vol. (ml)</label>
                                                <input type="text" class="form-control" name="vol" id="vol" placeholder="Volume">
                                              </div>
                                            </div>
                                            <div class="col-md-12 mb-3">
                                              <label class="form-label fw-bold">Kondisi</label>
                                              <input type="text" class="form-control" name="kondisi_cukai" id="kondisi-cukai" placeholder="Kondisi Barang">
                                            </div>
                                          </div>

                                          <div class="mb-3">
                                            <label for="keterangan" class="form-label fw-bold">Keterangan</label>
                                            <textarea class="form-control" id="keterangan" name="keterangan" rows="3" placeholder="Tambahkan keterangan"></textarea>
                                          </div>

                                          <div class="mb-3">
                                            <label class="form-label fw-bold">Pilih Kategori Lartas</label>
                                            <select class="form-select select2" name="kategori_lartas" id="kategori-lartas" placeholder="Pilih Kategori Lartas">
                                              <option value="" selected disabled>- Pilih Kategori Lartas -</option>
                                              @foreach ($lartas as $lartas)
                                                <option value="{{ $lartas->jenis_barang }} ({{ $lartas->no_aturan }})">{{ $lartas->jenis_barang }} ({{ $lartas->no_aturan }})
                                                </option>
                                              @endforeach
                                            </select>
                                          </div>

                                        </form>

                                      </div>

                                      <!-- Modal Footer -->
                                      <div class="modal-footer border-top-0 bg-light">
                                        <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">Tutup</button>
                                        <button type="button" class="btn btn-outline-primary" id="formBarang">
                                          <span id="buttonText">Simpan</span>
                                          <span id="buttonSpinner" class="spinner-border spinner-border-sm d-none" role="status" aria-hidden="true"></span>
                                        </button>

                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </table>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>


                    <div class="modal fade" id="editBarangModal" tabindex="-1" role="dialog" aria-labelledby="editBarangModalLabel" aria-hidden="true">
                      <div class="modal-dialog modal-dialog-centered modal-lg">
                        <div class="modal-content">
                          <!-- Modal Header -->
                          <div class="modal-header bg-primary text-white border-bottom-0">
                            <i data-feather="package" class="icon-lg"></i>&nbsp;&nbsp;
                            <h5 class="modal-title" id="editBarangModalLabel">Edit Barang</h5>
                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                          </div>

                          <!-- Modal Body -->
                          <div class="modal-body p-4" style="max-height: 65vh; overflow-y: auto;">
                            <form id="editBarangForm">


                              <!-- Always visible fields -->
                              <div class="row mb-4">
                                <div class="col-md-6">
                                  <label for="edit-kategori-barang" class="form-label fw-bold">Kategori Barang</label>
                                  <select class="form-select form-input select2" id="edit-kategori-barang" name="kategori_barang">
                                    <option value="">-- Pilih Kategori Barang --</option>
                                    <option value="pabean">Barang Pabean</option>
                                    <option value="cukai">Barang Kena Cukai</option>
                                    <option value="pabean_cukai">Barang Pabean dan Barang Kena Cukai</option>
                                  </select>
                                </div>
                              </div>

                              <!-- Default Fields -->
                              <div class="default-fields mb-4">
                                <div class="mb-3">
                                  <label for="edit-kode-komoditi" class="form-label fw-bold">Kode Komoditi</label>
                                  <input type="text" class="form-control" name="kode_komoditi" id="edit-kode-komoditi" placeholder="Kode Komoditi">
                                </div>
                                <div class="mb-3">
                                  <label for="edit-jenis-barang" class="form-label fw-bold">Jenis Barang / Uraian Barang</label>
                                  <textarea class="form-control" name="jenis_barang" id="edit-jenis-barang" rows="3" placeholder="Jenis Barang/Uraian Barang"></textarea>
                                </div>
                              </div>

                              <!-- Pabean Fields -->
                              <div id="edit-pabean-fields" class="d-none">
                                <h6><b>Ciri Khusus Barang Pabean</b></h6>
                                <hr>
                                <div class="row">
                                  <div class="col-md-6 mb-3">
                                    <label for="edit-merk-pabean" class="form-label fw-bold">Merk</label>
                                    <input type="text" class="form-control" name="merk_pabean" id="edit-merk-pabean" placeholder="Masukkan Merk Barang">
                                  </div>
                                  <div class="col-md-6 mb-3">
                                    <label for="edit-tipe-pabean" class="form-label fw-bold">Tipe</label>
                                    <input type="text" class="form-control" name="tipe_pabean" id="edit-tipe-pabean" placeholder="Masukkan Tipe Barang">
                                  </div>
                                </div>
                                <div class="col-md-12 mb-3">
                                  <label for="edit-ukuran-kapasitas" class="form-label fw-bold">Ukuran/Kapasitas</label>
                                  <input type="text" class="form-control" name="ukuran_kapasitas" id="edit-ukuran-kapasitas" placeholder="Masukkan Ukuran/Kapasitas">
                                </div>
                                <div class="row">
                                  <div class="col-md-6 mb-3">
                                    <label for="edit-jumlah" class="form-label fw-bold">Jumlah</label>
                                    <input type="number" class="form-control" name="jumlah" id="edit-jumlah" placeholder="Masukkan Jumlah">
                                  </div>
                                  <div class="col-md-6 mb-3">
                                    <label for="edit-satuan" class="form-label fw-bold">Satuan</label>
                                    <input type="text" class="form-control" name="satuan" id="edit-satuan" placeholder="Masukkan Satuan">
                                  </div>
                                </div>
                                <div class="row">
                                  <div class="col-md-6 mb-3">
                                    <label for="edit-negara-asal" class="form-label fw-bold">Negara Asal</label>
                                    <select class="form-select select2" id="edit-negara-asal" name="negara_asal">
                                      <option value="" disabled selected>- Pilih Kewarganegaraan -</option>
                                      @foreach ($nama_negara as $benua => $negara)
                                        <optgroup label="{{ $benua }}">
                                          @foreach ($negara as $item)
                                            <option value="{{ $item->UrEdi }}">{{ $item->UrEdi }}</option>
                                          @endforeach
                                        </optgroup>
                                      @endforeach
                                    </select>
                                  </div>
                                  <div class="col-md-6 mb-3">
                                    <label for="edit-kondisi-pabean" class="form-label fw-bold">Kondisi</label>
                                    <input type="text" class="form-control" name="kondisi_pabean" id="edit-kondisi-pabean" placeholder="Masukkan Kondisi Barang">
                                  </div>
                                </div>
                              </div>

                              <!-- Cukai Fields -->
                              <div id="edit-cukai-fields" class="d-none">
                                <h6><b>Ciri Khusus Barang Kena Cukai</b></h6>
                                <hr>
                                <div class="row">
                                  <div class="col-md-6 mb-3">
                                    <label for="edit-merk-cukai" class="form-label fw-bold">Merk</label>
                                    <input type="text" name="merk_cukai" class="form-control" id="edit-merk-cukai" placeholder="Merk Barang">
                                  </div>
                                  <div class="col-md-6 mb-3">
                                    <label for="edit-tipe-cukai" class="form-label fw-bold">Tipe</label>
                                    <input type="text" class="form-control" name="tipe_cukai" id="edit-tipe-cukai" placeholder="Tipe Barang">
                                  </div>
                                  <div class="col-md-6 mb-3">
                                    <label for="edit-kadar-cukai" class="form-label fw-bold">Kadar</label>
                                    <input type="text" class="form-control" name="kadar_cukai" id="edit-kadar-cukai" placeholder="Kadar Barang">
                                  </div>
                                  <div class="col-md-6 mb-3">
                                    <label for="edit-subyek-cukai" class="form-label fw-bold">Subyek Cukai</label>
                                    <input type="text" class="form-control" name="subyek_cukai" id="edit-subyek-cukai" placeholder="Subyek Cukai">
                                  </div>
                                </div>
                              </div>

                              <div class="mb-3">
                                <label for="edit-keterangan" class="form-label fw-bold">Keterangan</label>
                                <textarea class="form-control" id="edit-keterangan" name="keterangan" rows="3" placeholder="Tambahkan keterangan"></textarea>
                              </div>

                              <div class="mb-3">
                                <label class="form-label fw-bold">Pilih Kategori Lartas</label>
                                <select class="form-select select2" name="kategori_lartas" id="edit-kategori-lartas" placeholder="Pilih Kategori Lartas">
                                  <option value="" selected disabled>- Pilih Kategori Lartas -</option>
                                  @foreach ($lartas as $item)
                                    @if (is_object($item))
                                      <option value="{{ $item->jenis_barang }} ({{ $item->no_aturan }})">
                                        {{ $item->jenis_barang }} ({{ $item->no_aturan }})
                                      </option>
                                    @else
                                      <option disabled>Data tidak valid</option>
                                    @endif
                                  @endforeach
                                </select>
                              </div>

                            </form>
                          </div>


                          <!-- Modal Footer -->
                          <div class="modal-footer border-top-0 bg-light">
                            <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">Tutup</button>
                            <button type="button" class="btn btn-outline-primary" id="updateBarangBtn">
                              Update
                              <span id="updateButtonSpinner" class="spinner-border spinner-border-sm d-none" role="status" aria-hidden="true"></span>
                            </button>
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
    // Fungsi untuk menghasilkan ID unik
    function generateUniqueID() {
      const timestamp = Date.now();
      const randomNum = Math.floor(Math.random() * 1000000);
      return `id_penyidikan_${timestamp}_${randomNum}`;
    }

    document.addEventListener('DOMContentLoaded', function() {
      // Ambil input ID Penyidikan
      const idPenyidikanInput = document.getElementById('id_penyidikan');
      if (idPenyidikanInput) {
        idPenyidikanInput.value = generateUniqueID(); // Jika ID Penyidikan tidak ada, buat ID baru
      }

      // Ambil tombol formBarang dan elemen-elemen lainnya
      const formBarangButton = document.getElementById('formBarang');
      const buttonText = formBarangButton.querySelector('#buttonText');
      const buttonSpinner = formBarangButton.querySelector('#buttonSpinner');

      // Ketika tombol formBarang diklik
      $('#formBarang').on('click', function(e) {
        e.preventDefault();

        // Nonaktifkan tombol dan tampilkan animasi loading
        formBarangButton.disabled = true;
        buttonSpinner.classList.remove('d-none');
        buttonText.textContent = 'Tunggu...';

        // Ambil data dari form
        var formData = {
          'id_penyidikan': idPenyidikanInput ? idPenyidikanInput.value : '', // Ambil id_penyidikan dari input
          'kategori_barang': $('#kategori-barang').val(),
          'kode_komoditi': $('#kode-komoditi').val(),
          'jenis_barang': $('#jenis-barang').val(),
          'merk_pabean': $('#merk-pabean').val(),
          'tipe_pabean': $('#tipe-pabean').val(),
          'ukuran_kapasitas': $('#ukuran-kapasitas').val(),
          'jumlah': $('#jumlah').val(),
          'satuan': $('#satuan').val(),
          'negara_asal': $('#negara-asal').val(),
          'kondisi_pabean': $('#kondisi-pabean').val(),
          'merk_cukai': $('#merk-cukai').val(),
          'tipe_cukai': $('#tipe-cukai').val(),
          'kadar_cukai': $('#kadar-cukai').val(),
          'subyek_cukai': $('#subyek-cukai').val(),
          'tahun': $('#tahun').val(),
          'gol': $('#gol').val(),
          'vol': $('#vol').val(),
          'kondisi_cukai': $('#kondisi-cukai').val(),
          'keterangan': $('#keterangan').val(),
          'kategori_lartas': $('#kategori-lartas').val(),
        };

        // Kirim data ke server menggunakan AJAX
        $.ajax({
          url: '/Dokpenyidikan/barang', // Ganti dengan route yang sesuai untuk menyimpan data
          type: 'POST',
          data: formData,
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
          success: function(response) {
            console.log('Data berhasil dikirim:', response);
            alert('Data berhasil disimpan!');

            // Reset data input form setelah berhasil disimpan
            $('#kategori-barang').val('').trigger('change'); // Reset Select2
            $('#kode-komoditi').val('');
            $('#jenis-barang').val('');
            $('#merk-pabean').val('');
            $('#tipe-pabean').val('');
            $('#ukuran-kapasitas').val('');
            $('#jumlah').val('');
            $('#satuan').val('');
            $('#negara-asal').val('').trigger('change'); // Reset Select2
            $('#kondisi-pabean').val('');
            $('#merk-cukai').val('');
            $('#tipe-cukai').val('');
            $('#kadar-cukai').val('');
            $('#subyek-cukai').val('');
            $('#tahun').val('');
            $('#gol').val('');
            $('#vol').val('');
            $('#kondisi-cukai').val('');
            $('#keterangan').val('');
            $('#kategori-lartas').val('').trigger('change');

            // Panggil fungsi untuk update tabel real-time
            loadData(idPenyidikanInput.value); // Panggil dengan id_penyidikan
          },
          error: function(xhr, status, error) {
            console.error('Kesalahan:', error);
            alert('Terjadi kesalahan saat mengirim data.');
          },
          complete: function() {
            // Aktifkan kembali tombol dan sembunyikan animasi loading
            formBarangButton.disabled = false;
            buttonSpinner.classList.add('d-none');
            buttonText.textContent = 'Simpan';
          }
        });
      });
    });

    document.addEventListener('DOMContentLoaded', function() {
      // Dynamic field display based on category
      $('#edit-kategori-barang').on('change', function() {
        const kategori = $(this).val();
        $('#edit-pabean-fields, #edit-cukai-fields').addClass('d-none');

        if (kategori === 'pabean') {
          $('#edit-pabean-fields').removeClass('d-none');
        } else if (kategori === 'cukai') {
          $('#edit-cukai-fields').removeClass('d-none');
        } else if (kategori === 'pabean_cukai') {
          $('#edit-pabean-fields, #edit-cukai-fields').removeClass('d-none');
        }
      });

      // Edit button event delegation
      document.addEventListener('click', function(e) {
        if (e.target.closest('.edit-btn')) {
          e.preventDefault();
          const itemId = e.target.closest('.edit-btn').getAttribute('data-id');

          // Fetch item details for editing
          $.ajax({
            url: `/Dokpenyidikan/barang/${itemId}/edit`,
            type: 'GET',
            success: function(response) {
              // Populate hidden ID field
              $('#barang-id').val(response.id);

              // Populate kategori barang and trigger change to show/hide fields
              $('#edit-kategori-barang').val(response.kategori_barang).trigger('change');

              // Populate default fields
              $('#edit-kode-komoditi').val(response.kode_komoditi);
              $('#edit-jenis-barang').val(response.jenis_barang);

              // Populate Pabean fields
              $('#edit-merk-pabean').val(response.merk_pabean);
              $('#edit-tipe-pabean').val(response.tipe_pabean);
              $('#edit-ukuran-kapasitas').val(response.ukuran_kapasitas);
              $('#edit-jumlah').val(response.jumlah);
              $('#edit-satuan').val(response.satuan);

              // Special handling for Kategori Lartas dropdown
              const editKategoriLartas = $('#edit-kategori-lartas');
              editKategoriLartas.find('option').each(function() {
                if ($(this).val() === response.kategori_lartas) {
                  editKategoriLartas.val(response.kategori_lartas).trigger('change');
                }
              });

              // Special handling for Negara Asal dropdown
              const editNegaraAsal = $('#edit-negara-asal');
              editNegaraAsal.find('option').each(function() {
                if ($(this).val() === response.negara_asal) {
                  editNegaraAsal.val(response.negara_asal).trigger('change');
                }
              });

              $('#edit-kondisi-pabean').val(response.kondisi_pabean);

              // Populate Cukai fields
              $('#edit-merk-cukai').val(response.merk_cukai);
              $('#edit-tipe-cukai').val(response.tipe_cukai);
              $('#edit-kadar-cukai').val(response.kadar_cukai);
              $('#edit-subyek-cukai').val(response.subyek_cukai);

              // Populate other fields
              $('#edit-keterangan').val(response.keterangan);

              // Show the modal
              var editModal = new bootstrap.Modal(document.getElementById('editBarangModal'));
              editModal.show();
            },
            error: function(xhr, status, error) {
              console.error('Error fetching item details:', error);
              alert('Gagal mengambil data untuk diedit.');
            }
          });
        }
      });

      // Update button event
      $('#updateBarangBtn').on('click', function() {
        const itemId = $('#barang-id').val();
        const formData = {
          'id_penyidikan': $('#id_penyidikan').val(),
          'kategori_barang': $('#edit-kategori-barang').val(),
          'kode_komoditi': $('#edit-kode-komoditi').val(),
          'jenis_barang': $('#edit-jenis-barang').val(),
          'merk_pabean': $('#edit-merk-pabean').val(),
          'tipe_pabean': $('#edit-tipe-pabean').val(),
          'ukuran_kapasitas': $('#edit-ukuran-kapasitas').val(),
          'jumlah': $('#edit-jumlah').val(),
          'satuan': $('#edit-satuan').val(),
          'negara_asal': $('#edit-negara-asal').val(),
          'kondisi_pabean': $('#edit-kondisi-pabean').val(),
          'merk_cukai': $('#edit-merk-cukai').val(),
          'tipe_cukai': $('#edit-tipe-cukai').val(),
          'kadar_cukai': $('#edit-kadar-cukai').val(),
          'subyek_cukai': $('#edit-subyek-cukai').val(),
          'keterangan': $('#edit-keterangan').val(),
          'kategori_lartas': $('#edit-kategori-lartas').val()
        };

        // Show loading spinner
        const updateButton = $(this);
        const buttonSpinner = $('#updateButtonSpinner');
        updateButton.prop('disabled', true);
        buttonSpinner.removeClass('d-none');

        // Get investigation ID
        const idPenyidikan = $('#id_penyidikan').val();

        $.ajax({
          url: `/Dokpenyidikan/barang/${itemId}`,
          type: 'PUT',
          data: formData,
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
          success: function(response) {
            if (response.success) {
              alert('Data berhasil diupdate!');

              // Close modal
              $('#editBarangModal').modal('hide');

              // Reload data
              loadData(idPenyidikan);
            } else {
              alert('Gagal mengupdate data.');
            }
          },
          error: function(xhr, status, error) {
            console.error('Error:', error);
            alert('Terjadi kesalahan saat mengupdate data.');
          },
          complete: function() {
            // Restore button state
            updateButton.prop('disabled', false);
            buttonSpinner.addClass('d-none');
          }
        });
      });
    });

    document.addEventListener('click', function(e) {
      if (e.target && e.target.matches('.delete-btn')) {
        const form = e.target.closest('form');
        const itemId = form.getAttribute('data-id');
        // Get the investigation ID from a more reliable source
        const idPenyidikan = document.getElementById('id_penyidikan').value;

        if (confirm('Apakah Anda yakin ingin menghapus data ini?')) {
          const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

          fetch(`/Dokpenyidikan/barang/${itemId}`, {
              method: 'DELETE',
              headers: {
                'X-CSRF-TOKEN': csrfToken,
                'Content-Type': 'application/json',
              }
            })
            .then(response => response.json())
            .then(data => {
              if (data.success) {
                alert('Data berhasil dihapus!');
                // Pass the investigation ID here
                loadData(idPenyidikan);
              } else {
                alert('Terjadi kesalahan saat menghapus data.');
              }
            })
            .catch(error => {
              console.error('Kesalahan:', error);
              alert('Terjadi kesalahan saat menghapus data.');
            });
        }
      }
    });


    // Fungsi untuk memuat data tabel secara real-time
    function loadData(idPenyidikan) {
      $.ajax({
        url: '/Dokpenyidikan/barang', // Ganti dengan route yang sesuai untuk mengambil data
        type: 'GET',
        data: {
          'id_penyidikan': idPenyidikan
        }, // Kirimkan id_penyidikan ke server
        success: function(response) {
          $('#tableBody').empty();

          if (response.data && response.data.length > 0) {
            response.data.forEach(function(item, index) {
              let fieldMerkTipeUkuran, fieldKondisi;

              if (item.kategori_barang === 'pabean') {
                fieldMerkTipeUkuran = `${item.merk_pabean}/${item.tipe_pabean}/${item.ukuran_kapasitas}`;
                fieldKondisi = `${item.kondisi_pabean}`;
              } else if (item.kategori_barang === 'cukai') {
                fieldMerkTipeUkuran = `${item.merk_cukai},${item.tipe_cukai},${item.kadar_cukai}`;
                fieldKondisi = `${item.kondisi_cukai}`;
              } else {
                fieldMerkTipeUkuran = '-';
                fieldKondisi = '-';
              }

              $('#tableBody').append(`
  <tr class="shadow-sm">
      <td class="text-center fw-medium">${index + 1}</td>
         <td class="fw-medium">${item.kategori_barang || '-'}</td>
                <td class="fw-medium">${item.jenis_barang || '-'}</td>
                <td class="fw-medium">${item.jumlah || '-'}</td>
                <td class="fw-medium">${item.satuan || '-'}</td>
      <td class="fw-medium">${fieldMerkTipeUkuran}</td>
    <td class="fw-medium">${item.negara_asal || '-'}</td>
      <td class="fw-medium">${fieldKondisi}</td>
       <td class="fw-medium">${item.kategori_lartas || '-'}</td>
                <td class="fw-medium">${item.keterangan || '-'}</td>
      <td>
          <div class="d-flex gap-1 justify-content-center">
              <a href="#" class="btn btn-soft-success btn-icon btn-sm rounded-pill edit-btn" data-id="${item.id}">
                  <i data-feather="edit" class="icon-sm"></i> Edit
              </a>
           <form action="/Dokpenyidikan/barang/${item.id}" method="POST" class="d-inline delete-form" data-id="${item.id}">
   @csrf
   @method('DELETE')
   <button type="button" class="btn btn-soft-danger btn-icon btn-sm rounded-pill delete-btn">
       <i data-feather="trash" class="icon-sm"></i> Delete
   </button>
</form>



          </div>
      </td>
  </tr>
`);

            });
          } else {
            $('#tableBody').append('<tr><td colspan="10" class="text-center">Data tidak ditemukan</td></tr>');
          }

        },
        error: function(xhr, status, error) {
          console.error('Kesalahan:', error);
          alert('Terjadi kesalahan saat memuat data.');
        }
      });
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

  <script>
    document.addEventListener('DOMContentLoaded', function() {
      $('.bs-example-modal-lg').on('shown.bs.modal', function() {
        $('.select2').select2({
          dropdownParent: $('.bs-example-modal-lg'),
          width: '100%',
          allowClear: true,
        });
      });
    });
  </script>

  <script>
    document.addEventListener('DOMContentLoaded', function() {
      const pabeanFields = document.getElementById('pabean-fields');
      const cukaiFields = document.getElementById('cukai-fields');

      $('#kategori-barang').on('change', function(e) {
        const value = $(this).val();

        pabeanFields.classList.add('d-none');
        cukaiFields.classList.add('d-none');

        if (value === 'pabean') {
          pabeanFields.classList.remove('d-none');
        } else if (value === 'cukai') {
          cukaiFields.classList.remove('d-none');
        } else if (value === 'pabean_cukai') {
          pabeanFields.classList.remove('d-none');
          cukaiFields.classList.remove('d-none');
        }
      });
    });
  </script>
@endsection
@section('script')
  @vite(['resources/js/pages/datatable.init.js'])
@endsection
