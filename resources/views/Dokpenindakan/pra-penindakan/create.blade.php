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
                    <ul class="nav nav-pills nav-justified flex-nowrap overflow-auto" style="white-space: nowrap;" role="tablist">
                      <li class="nav-item">
                        <a class="nav-link active" id="navtabs2-home-tab" data-bs-toggle="tab" href="#navtabs2-home" role="tab" aria-controls="navtabs2-home" aria-selected="true">
                          <span class="d-block d-sm-none">(LI)</span>
                          <span class="d-none d-sm-block">Laporan Informasi (LI)</span>
                        </a>
                      </li>
                      <li class="nav-item" id="navtabs2-profile-tab-item">
                        <a class="nav-link" id="navtabs2-profile-tab" data-bs-toggle="tab" href="#navtabs2-profile" role="tab" aria-controls="navtabs2-profile" aria-selected="false">
                          <span class="d-block d-sm-none">LAP</span>
                          <span class="d-none d-sm-block">Lembar Analisis Pra Penindakan (LAP)</span>
                        </a>
                      </li>
                      <li class="nav-item" id="navtabs2-messages-tab-item" style="display: none;">
                        <a class="nav-link" id="navtabs2-messages-tab" data-bs-toggle="tab" href="#navtabs2-messages" role="tab" aria-controls="navtabs2-messages" aria-selected="false">
                          <span class="d-block d-sm-none">NPI</span>
                          <span class="d-none d-sm-block">Nota Pengembalian Informasi (NPI)</span>
                        </a>
                      </li>
                      <li class="nav-item" id="navtabs2-mpp-tab-item" style="display: none;">
                        <a class="nav-link" id="navtabs2-mpp-tab" data-bs-toggle="tab" href="#navtabs2-mpp" role="tab" aria-controls="navtabs2-mpp" aria-selected="false">
                          <span class="d-block d-sm-none">MPP</span>
                          <span class="d-none d-sm-block">Memo Pelimpahan Penindakan (MPP)</span>
                        </a>
                      </li>
                      <li class="nav-item" id="navtabs2-settings-tab-item" style="display: none;">
                        <a class="nav-link" id="navtabs2-settings-tab" data-bs-toggle="tab" href="#navtabs2-settings" role="tab" aria-controls="navtabs2-settings" aria-selected="false">
                          <span class="d-block d-sm-none">SP</span>
                          <span class="d-none d-sm-block">Surat Perintah</span>
                        </a>
                      </li>
                    </ul>
                  </div>




                  <div class="tab-content p-3 text-muted">

                    <div class="tab-pane active" id="navtabs2-home" role="tabpanel">
                      <div class="row">
                        <div class="col-lg-6">
                          <h6><b>Data Referensi Dokumen Intelijen</b></h6>
                          <hr>
                          <div class="row">
                            <input type="hidden" id="id_pra_penindakan" name="id_pra_penindakan" value="">
                            <input type="hidden" class="form-control bg-primary text-white" name="id_pengawasan_ref" value="{{ $no_laporan }}" readonly>
                            <div class="col-md-6 mb-3">
                              <label>No. Surat Perintah</label>
                              <input type="text" class="form-control bg-primary text-white" value="{{ $laporan->no_st }}" readonly>
                            </div>
                            <div class="col-md-6 mb-3">
                              <label>Tgl. Surat Perintah</label>
                              <input type="text" class="form-control bg-primary text-white" value="{{ $laporan->tgl_st }}" readonly>
                            </div>
                          </div>

                          <h6><b>A. Data Laporan Informasi (LI)</b></h6>
                          <hr>
                          <div class="row">
                            <div class="col-md-6 mb-3">
                              <label>No. LI</label>
                              <input type="text" class="form-control bg-primary text-white" name="no_li" value="{{ old('no_li', $no_ref->no_li) }}" readonly>
                            </div>
                            <div class="col-md-6 mb-3">
                              <label>Tgl. LI</label>
                              <input type="date" class="form-control bg-primary text-white" placeholder="yyyy-mm-dd" id="tgl_li" name="tgl_li">
                            </div>

                            <div class="col-md-12 mb-3">
                              <label>Isi Informasi</label>
                              <textarea class="form-control" rows="3" placeholder="Isi Informasi" id="isi_informasi" name="isi_informasi"></textarea>
                            </div>
                            <div class="col-md-12 mb-3">
                              <label>Catatan</label>
                              <textarea class="form-control" rows="3" placeholder="Catatan" id="catatan" name="catatan"></textarea>
                            </div>
                          </div>
                        </div>

                        <div class="col-lg-6">
                          <h6><b>B. Pilih Pejabat</b></h6>
                          <hr>
                          <div class="col-lg-12 mb-3">
                            <label for="id_pejabat_li_1">Pejabat Pelaksana Penindakan</label>
                            <select class="form-control form-select select2" id="id_pejabat_li_1" name="id_pejabat_li_1">
                              <option value="" selected disabled>- Pilih -</option>
                              @foreach ($users as $user)
                                <option value="{{ $user->id_admin }}">{{ $user->name }}</option>
                              @endforeach
                            </select>
                          </div>
                          <div class="col-lg-12 mb-3">
                            <label for="id_pejabat_li_2">Pejabat Penerbit Laporan Informasi</label>
                            <select class="form-control form-select select2" id="id_pejabat_li_2" name="id_pejabat_li_2">
                              <option value="" selected disabled>- Pilih -</option>
                              @foreach ($users as $user)
                                <option value="{{ $user->id_admin }}">{{ $user->name }}</option>
                              @endforeach
                            </select>
                          </div>

                          <div class="col-lg-12 mb-3">
                            <label for="id_pejabat_li_3">Pengampu Pejabat Penerbit Lembar Informasi</label>
                            <select class="form-control form-select select2" id="id_pejabat_li_3" name="id_pejabat_li_3">
                              <option value="" selected disabled>- Pilih -</option>
                              @foreach ($users as $user)
                                <option value="{{ $user->id_admin }}">{{ $user->name }}</option>
                              @endforeach
                            </select>
                          </div>

                        </div>
                      </div>
                    </div>


                    <div class="tab-pane " id="navtabs2-mpp" role="tabpanel">
                      <div class="row">
                        <div class="col-lg-6">
                          <h6><b>A. Memo Pelimpahan Penindakan (MPP) </b></h6>
                          <hr>
                          <div class="row">
                            <div class="col-md-6 mb-3">
                              <label>No. MPP</label>
                              <input type="text" class="form-control bg-primary text-white" name="no_mpp" value="{{ old('no_mpp', $no_ref->no_mpp) }}" readonly>
                            </div>
                            <div class="col-md-6 mb-3">
                              <label>Tgl. MPP</label>
                              <input type="date" class="form-control bg-primary text-white" placeholder="yyyy-mm-dd" id="tgl_mpp" name="tgl_mpp">
                            </div>
                            <div class="col-md-12 mb-3">
                              <label>Yang Terhormat</label>
                              <input type="text" class="form-control" placeholder="Kepada YTH." name="yth_mpp">
                            </div>

                            <h6><b>B. Diduga Dilakukan Oleh </b></h6>
                            <hr>
                            <div class="col-md-12 mb-3">
                              <label>Nama</label>
                              <input type="text" class="form-control" placeholder="Nama Yang Diduga Melakukan Pelanggaran" name="nama_mpp">
                            </div>

                            <div class="col-md-12 mb-3">
                              <label>No Identitas</label>
                              <input type="text" class="form-control" placeholder="Nomor Identitas Pelaku" name="noiden_mpp">
                            </div>

                            <div class="col-md-12 mb-3">
                              <label>Keterangan lainnya</label>
                              <textarea class="form-control" rows="3" placeholder="Keterangan Lainnya" name="keterangan_mpp"></textarea>
                            </div>

                          </div>
                        </div>

                        <div class="col-lg-6">
                          <h6><b>C. Proses Penindakan</b></h6>
                          <hr>
                          <div class="card-body">
                            <div class="accordion accordion-flush" id="accordionFlushExample">
                              <div class="accordion-item">
                                <h2 class="accordion-header">
                                  <button class="accordion-button btn bg-light fw-medium collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapsebgh" aria-expanded="false" aria-controls="flush-collapsebgh">
                                    Proses Penindakan
                                  </button>
                                </h2>
                                <div id="flush-collapsebgh" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
                                  <div class="accordion-body bg-light">

                                    <div class="row mb-3 form-group">
                                      <label class="col-sm-4 col-form-label">
                                        Dugaan Pelanggaran
                                      </label>
                                      <div class="col-sm-8">
                                        <select class="form-control form-select select2" name="dugaan_pelanggaran_mpp">
                                          <option value="" selected disabled>- Pilih -</option>
                                          @foreach ($jenis_pelanggaran as $pelanggaran)
                                            <option value="{{ $pelanggaran->alasan_penindakan }} ({{ $pelanggaran->jenis_pelanggaran }})" {{ isset($laporan) && $laporan->jenis_pelanggaran_lpt == $pelanggaran->alasan_penindakan ? 'selected' : '' }}>
                                              {{ $pelanggaran->alasan_penindakan }} ({{ $pelanggaran->jenis_pelanggaran }})
                                            </option>
                                          @endforeach
                                        </select>
                                      </div>

                                    </div>

                                    <div class="row mb-3 form-group">
                                      <label class="col-sm-4 col-form-label">
                                        Modus Pelanggaran
                                      </label>
                                      <div class="col-sm-8">
                                        <select class="form-control form-select select2" name="modus_pelanggaran_mpp">
                                          <option value="" selected disabled>- Pilih -</option>
                                          @foreach ($uraian_modus as $modus)
                                            <option value="{{ $modus->uraian_modus }}" {{ isset($laporan) && $laporan->modus_pelanggaran_lpt == $modus->uraian_modus ? 'selected' : '' }}>
                                              {{ $modus->uraian_modus }}
                                            </option>
                                          @endforeach
                                        </select>
                                      </div>
                                    </div>

                                    <div class="row mb-3 form-group">
                                      <label class="col-sm-4 col-form-label">
                                        Locus Pelanggaran
                                      </label>
                                      <div class="col-sm-8">
                                        <select class="form-control form-select select2" name="locus_pelanggaran_mpp">
                                          <option value="" selected disabled>- Pilih -</option>
                                          @foreach ($tempat as $locus)
                                            <option value="{{ $locus->locus }}" {{ isset($laporan) && $laporan->perkiraan_tempat_pelanggaran_lpt == $locus->locus ? 'selected' : '' }}>
                                              {{ $locus->locus }}
                                            </option>
                                          @endforeach
                                        </select>
                                      </div>
                                    </div>

                                    <div class="row mb-3 form-group">
                                      <label class="col-sm-4 col-form-label">
                                        Tempus Pelanggaran
                                      </label>
                                      <div class="col-sm-8">
                                        <input type="text" class="form-control" name="tempus_pelanggaran_mpp" id="datetime-datepicker" placeholder="Tempus Pelanggaran"
                                          value="{{ isset($laporan) ? $laporan->perkiraan_waktu_pelanggaran_lpt : '' }}">
                                      </div>
                                    </div>

                                  </div>
                                </div>
                              </div>
                            </div>

                            <div class="accordion accordion-flush" id="accordionFlushExample">
                              <div class="accordion-item">
                                <h2 class="accordion-header">
                                  <button class="accordion-button btn bg-light fw-medium collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapsepoi" aria-expanded="false" aria-controls="flush-collapsepoi">
                                    Komoditi Barang
                                  </button>
                                </h2>
                                <div id="flush-collapsepoi" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
                                  <div class="accordion-body bg-light">

                                    <div class="row mb-3 form-group">
                                      <label class="col-sm-4 col-form-label">
                                        Komoditi Barang
                                      </label>
                                      <div class="col-sm-8">
                                        <input type="text" class="form-control form-input" name="komoditi_mpp" placeholder="Uraian Komoditi Barang">
                                      </div>
                                    </div>

                                    <div class="row mb-3 form-group">
                                      <label class="col-sm-4 col-form-label">
                                        Jumlah Komoditi Barang
                                      </label>
                                      <div class="col-sm-8">
                                        <input type="text" class="form-control form-input" name="jumlah_barang_mpp" placeholder="Jumlah Komoditi Barang">
                                      </div>
                                    </div>

                                    <div class="row mb-3 form-group">
                                      <label class="col-sm-4 col-form-label">
                                        Jenis Pengangkut
                                      </label>
                                      <div class="col-sm-8">
                                        <input type="text" class="form-control form-input" placeholder="Jenis Pengangkut" name="jenis_pengangkut_mpp">
                                      </div>
                                    </div>

                                    <div class="row mb-3 form-group">
                                      <label class="col-sm-4 col-form-label">
                                        No Registrasi
                                      </label>
                                      <div class="col-sm-8">
                                        <input type="text" class="form-control form-input" placeholder="No Registrasi" name="noreg_mpp">
                                      </div>
                                    </div>

                                    <div class="row mb-3 form-group">
                                      <label class="col-sm-4 col-form-label">
                                        Peti Kemasan
                                      </label>
                                      <div class="col-sm-8">
                                        <input type="text" class="form-control form-input" placeholder="Peti Kemasan/Kemasan" name="kemasan_mpp">
                                      </div>
                                    </div>

                                    <div class="row mb-3 form-group">
                                      <label class="col-sm-4 col-form-label">
                                        Ukuran
                                      </label>
                                      <div class="col-sm-8">
                                        <input type="text" class="form-control form-input" placeholder="Ukuran Kontainer (Jika Ada)" name="ukuran_mpp">
                                      </div>
                                    </div>

                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>


                          <div class="col-md-12 mb-3">
                            <label>Dokumen Terkait</label>
                            <textarea class="form-control" name="dokterkait_mpp" rows="3" placeholder="diisi uraian dokumen yang diduga terkait Pelanggaran (jenis dokumen, nomor, tanggal)."></textarea>
                          </div>

                          <div class="col-md-12 mb-3">
                            <label>Uraian Instruksi</label>
                            <textarea class="form-control" name="uraian_mpp" rows="3" placeholder="diisi uraian instruksi Memo Pelimpahan Penindakan (MPP) misalnya melakukan operasi penindakan berupa penghentian, pemeriksaan, Penegahan dan penyegelan."></textarea>
                          </div>

                          <div class="col-lg-12 mb-3">
                            <label>Pejabat Penerbit MPP</label>
                            <select class="form-control form-select select2" name="id_pejabat_mpp">
                              <option value="" selected disabled>- Pilih -</option>
                              @foreach ($users as $user)
                                <option value="{{ $user->id_admin }}">{{ $user->name }}</option>
                              @endforeach
                            </select>
                          </div>

                        </div>
                      </div>
                    </div>



                    <div class="tab-pane" id="navtabs2-profile" role="tabpanel">
                      <div class="row">
                        <div class="col-lg-6">
                          <h6><b>A. Data Laporan Lembar Analisis Pra Penindakan (LAP)</b></h6>
                          <hr>
                          <div class="row">
                            <div class="row">

                              <div class="col-md-6 mb-3">
                                <label>No. LAP</label>
                                <input type="text" class="form-control bg-primary text-white" name="no_lap" value="{{ old('no_lap', $no_ref->no_lap) }}" readonly>
                              </div>
                              <div class="col-md-6 mb-3">
                                <label>Tgl. LAP</label>
                                <input type="date" class="form-control bg-primary text-white" name="tgl_lap">
                              </div>
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
                                            <option value="TIDAK">TIDAK DIKETAHUI</option>
                                            <option value="YA">DIKETAHUI</option>
                                          </select>
                                        </div>
                                      </div>

                                      <div class="row mb-3 form-group">
                                        <label class="col-sm-4 col-form-label">Keterangan Pelaku</label>
                                        <div class="col-sm-8">
                                          <textarea type="text" class="form-control form-input" name="keterangan_pelaku" placeholder="Keterangan pelaku" row="2">{{ isset($laporan) ? $laporan->perkiraan_pelaku_pelanggaran_lpt : '' }}</textarea>
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
                                          <select id="dugaan_pelanggaran" class="form-select" name="dugaan_pelanggaran">
                                            <option value="TIDAK">TIDAK DIKETAHUI</option>
                                            <option value="YA">DIKETAHUI</option>
                                          </select>
                                        </div>
                                      </div>

                                      <div class="row mb-3 form-group">
                                        <label class="col-sm-4 col-form-label">Keterangan Dugaan Pelanggaran</label>
                                        <div class="col-sm-8">
                                          <select class="form-control form-select select2" name="keterangan_dugaan_pelanggaran">
                                            <option value="" selected disabled>- Pilih -</option>
                                            <option value="-">-</option>
                                            @foreach ($jenis_pelanggaran as $pelanggaran)
                                              <option value="{{ $pelanggaran->alasan_penindakan }} ({{ $pelanggaran->jenis_pelanggaran }})"
                                                {{ isset($laporan) && $laporan->jenis_pelanggaran_lpt == $pelanggaran->alasan_penindakan ? 'selected' : '' }}>
                                                {{ $pelanggaran->alasan_penindakan }} ({{ $pelanggaran->jenis_pelanggaran }})
                                              </option>
                                            @endforeach
                                          </select>
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
                                          <select id="locus" class="form-select" name="locus">
                                            <option value="TIDAK">TIDAK DIKETAHUI</option>
                                            <option value="YA">DIKETAHUI</option>
                                          </select>
                                        </div>
                                      </div>

                                      <!-- Form Inputs -->
                                      <div class="row mb-3 form-group">
                                        <label class="col-sm-4 col-form-label">Keterangan Locus</label>
                                        <div class="col-sm-8">
                                          <select class="form-control form-select select2" name="keterangan_locus">
                                            <option value="" selected disabled>- Pilih -</option>
                                            <option value="-">-</option>
                                            @foreach ($tempat as $locus)
                                              <option value="{{ $locus->locus }}" {{ isset($laporan) && $laporan->perkiraan_tempat_pelanggaran_lpt == $locus->locus ? 'selected' : '' }}>
                                                {{ $locus->locus }}
                                              </option>
                                            @endforeach
                                          </select>
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
                                            <option value="TIDAK">TIDAK DIKETAHUI</option>
                                            <option value="YA">DIKETAHUI</option>
                                          </select>
                                        </div>
                                      </div>


                                      <div class="row mb-3 form-group">
                                        <div class="col-sm-6">
                                          <label class="col-form-label">Keterangan Tempus</label>
                                          <input type="text" class="form-control" name="keterangan_tempus" id="datetime-datepicker" placeholder="Mulainya Pra Penindakan">
                                        </div>
                                        <div class="col-sm-6">
                                          <label class="col-form-label">Berakhirnya Tempus</label>
                                          <input type="text" class="form-control" name="berakhirnya_tempus" id="datetime-datepicker" placeholder="Berakhirnya Pra Penindakan">
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
                                          <select id="prosedural" class="form-select" name="prosedural">
                                            <option value="Bukan">Bukan</option>
                                            <option value="Kewenangan DJBC">Kewenangan DJBC</option>
                                          </select>
                                        </div>
                                      </div>


                                      <div class="row mb-3 form-group">
                                        <label class="col-sm-4 col-form-label">Keterangan Prosedural</label>
                                        <div class="col-sm-8">
                                          <textarea type="text" class="form-control form-input" name="ket_prosedural" placeholder="Keterangan Prosedural" row="2"></textarea>
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
                                          <textarea type="text" class="form-control form-input" name="ket_sdm" placeholder="Keterangan SDM" row="2"></textarea>
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
                                          <textarea type="text" class="form-control form-input" name="ket_sarana_prasarana" placeholder="Keterangan Sarana Prasarana" row="2"></textarea>
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
                                          <textarea type="text" class="form-control form-input" name="ket_anggaran" placeholder="Keterangan Anggaran" row="2"></textarea>
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
                            <textarea type="text" class="form-control form-input" name="kesimpulan_lap" placeholder="Kesimpulan" rows="2"></textarea>
                          </div>
                          <h6><b>C. Pilih Pejabat LAP</b></h6>
                          <hr>
                          <!-- Select Pejabat 1 -->
                          <div class="col-lg-12 mb-3">
                            <label for="id_pejabat_lap_1">Pejabat LAP 1</label>
                            <select class="form-control form-select select2 " id="id_pejabat_lap_1" name="id_pejabat_lap_1">
                              <option value="" selected disabled>- Pilih -</option>
                              @foreach ($users as $user)
                                <option value="{{ $user->id_admin }}">{{ $user->name }}</option>
                              @endforeach
                            </select>
                          </div>
                          <!-- Select Pejabat 2 -->
                          <div class="col-lg-12 mb-3">
                            <label for="id_pejabat_lap_2">Pejabat LAP 2</label>
                            <select class="form-control form-select select2" id="id_pejabat_lap_2" name="id_pejabat_lap_2">
                              <option value="" selected disabled>- Pilih -</option>
                              @foreach ($users as $user)
                                <option value="{{ $user->id_admin }}">{{ $user->name }}</option>
                              @endforeach
                            </select>
                          </div>
                          <!-- Select Pejabat 3 -->
                          <div class="col-lg-12 mb-3">
                            <label for="id_pejabat_lap_3">Pejabat LAP 3</label>
                            <select class="form-control form-select select2" id="id_pejabat_lap_3" name="id_pejabat_lap_3">
                              <option value="" selected disabled>- Pilih -</option>
                              @foreach ($users as $user)
                                <option value="{{ $user->id_admin }}">{{ $user->name }}</option>
                              @endforeach
                            </select>
                          </div>


                          <div class="card-body">
                            <div class="accordion accordion-flush" id="accordionFlushExample">
                              <div class="accordion-item">
                                <h2 class="accordion-header">
                                  <button class="accordion-button btn bg-light fw-medium" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseUnified" aria-expanded="true" aria-controls="flush-collapseUnified">
                                    Pilihan Operasi atau Patroli
                                  </button>
                                </h2>

                                <div id="flush-collapseUnified" class="accordion-collapse collapse show" data-bs-parent="#accordionFlushExample">
                                  <div class="accordion-body bg-light">
                                    <div class="row mb-3">
                                      <label for="pilihan_kegiatan" class="col-sm-4 col-form-label">Pilih Kegiatan</label>
                                      <div class="col-sm-8">
                                        <select id="pilihan_kegiatan" class="form-select" name="pilihan_kegiatan">
                                          <option value="">-- Pilih Kegiatan --</option>
                                          <option value="penindakan">Layak Dilakukan Operasi Penindakan</option>
                                          <option value="patroli">Layak Dilakukan Patroli</option>
                                          <option value="tidak_layak">Tidak Layak Dilakukan Operasi atau Patroli</option>
                                        </select>

                                      </div>
                                    </div>

                                    <!-- Bagian Layak Dilakukan Operasi Penindakan -->
                                    <div id="penindakan_section" class="d-none">
                                      <div class="row mb-3">
                                        <label class="col-sm-4 col-form-label">Skema Penindakan</label>
                                        <div class="col-sm-8">
                                          <select id="skema_penindakan" class="form-select" name="skem_layak_penindakan">
                                            <option value="MANDIRI">MANDIRI</option>
                                            <option value="PELIMPAHAN">PELIMPAHAN</option>
                                            <option value="BERSAMA">BERSAMA</option>
                                            <option value="DENGAN INSTANSI LAIN">DENGAN INSTANSI LAIN</option>
                                          </select>
                                        </div>
                                      </div>
                                      <div class="row mb-3">
                                        <label class="col-sm-4 col-form-label">Keterangan Skema Penindakan</label>
                                        <div class="col-sm-8">
                                          <textarea class="form-control" name="ket_layak_penindakan" placeholder="Keterangan Skema Penindakan" rows="2"></textarea>
                                        </div>
                                      </div>
                                    </div>

                                    <!-- Bagian Layak Dilakukan Patroli -->
                                    <div id="patroli_section" class="d-none">
                                      <div class="row mb-3">
                                        <label class="col-sm-4 col-form-label">Skema Patroli</label>
                                        <div class="col-sm-8">
                                          <select id="skema_patroli" class="form-select" name="skem_layak_patroli">
                                            <option value="MANDIRI">MANDIRI</option>
                                            <option value="PERBANTUAN">PERBANTUAN</option>
                                            <option value="TERKOORDINASI">TERKOORDINASI</option>
                                            <option value="DENGAN INSTANSI LAIN">DENGAN INSTANSI LAIN</option>
                                            <option value="LAINNYA">LAINNYA</option>
                                          </select>
                                        </div>
                                      </div>
                                      <div class="row mb-3">
                                        <label class="col-sm-4 col-form-label">Keterangan Skema Patroli</label>
                                        <div class="col-sm-8">
                                          <textarea class="form-control" name="ket_layak_patroli" placeholder="Keterangan Skema Patroli" rows="2"></textarea>
                                        </div>
                                      </div>
                                    </div>

                                    <!-- Bagian Tidak Layak -->
                                    <div id="tidak_layak_section" class="d-none">
                                      <div class="row mb-3">
                                        <label class="col-sm-4 col-form-label">Keterangan Tidak Layak</label>
                                        <div class="col-sm-8">
                                          <textarea class="form-control" name="ket_tidak_layak" placeholder="Keterangan Tidak Layak" rows="2"></textarea>
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
                    </div><!-- end tab pane -->

                    <div class="tab-pane" id="navtabs2-messages" role="tabpanel">
                      <div class="row">
                        <!-- Left Column (Data Laporan Informasi) -->
                        <div class="col-lg-6">
                          <h6><b>A. Nota Pengembalian Informasi</b></h6>
                          <hr>
                          <div class="row">
                            <div class="row">
                              <div class="col-md-6 mb-3">
                                <label>No. NPI</label>
                                <input type="text" class="form-control bg-primary text-white" name="no_npi" value="{{ old('no_npi', $no_ref->no_npi) }}" readonly>
                              </div>
                              <div class="col-md-6 mb-3">
                                <label>Tgl. NPI</label>
                                <input type="date" class="form-control bg-primary text-white" name="tgl_npi">
                              </div>
                            </div>
                            <div class="col-md-12 mb-3">
                              <label>Sumber Informasi</label>
                              <input type="text" class="form-control" placeholder="Sumber Informasi" id="sumber_informasi_npi" name="sumber_npi">
                            </div>
                            <div class="col-md-12 mb-3">
                              <label>Kategori Penindakan</label>
                              <select class="form-control form-select select2" name="kategori_npi">
                                <option value="" selected disabled>- Pilih -</option>
                                @foreach ($kapen as $kategori)
                                  <option value="{{ $kategori->jenis_penindakan }}">{{ $kategori->jenis_penindakan }}</option>
                                @endforeach
                              </select>
                            </div>
                            <div class="col-md-12 mb-3">
                              <label>Unit Penebit Informasi</label>
                              <textarea class="form-control" rows="2" placeholder="Unit Penerbit Informasi" id="unit_penerbit_informasi" name="unit_penerbit_npi"></textarea>
                            </div>
                            <div class="col-md-12 mb-3">
                              <label>Alasan</label>
                              <textarea class="form-control" rows="2" placeholder="Alasan Tidak Dapat Dilakukan Penindakan Lebih Lanjut" id="alasan_penindakan_npi" name="alasan_npi"></textarea>
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
                            <select class="form-control form-select select2" id="id_pejabat_npi" name="id_pejabat_npi">
                              <option value="" selected disabled>- Pilih -</option>
                              @foreach ($users as $user)
                                <option value="{{ $user->id_admin }}">{{ $user->name }}</option>
                              @endforeach
                            </select>
                          </div>
                        </div>
                      </div>
                    </div><!-- end tab pane -->


                    <div class="tab-pane" id="navtabs2-settings" role="tabpanel">
                      <div class="row">
                        <!-- Left Column (Data Laporan Informasi) -->
                        <div class="col-lg-6">
                          <h6><b>A. Data Surat Perintah</b></h6>
                          <hr>
                          <div class="row">

                            <div class="col-md-6 mb-3">
                              <label>No. Print</label>
                              <input type="text" value="{{ old('no_sprint', $no_ref->no_sprint) }}" class="form-control bg-primary text-white" placeholder="Masukkan Nomor Perintah" name="no_print" readonly>
                            </div>

                            <div class="col-md-6 mb-3">
                              <label>tgl. Print</label>
                              <input type="date" class="form-control bg-primary text-white" name="tgl_print">
                            </div>

                            <div class="col-lg-12 mb-3">
                              <label>Penentuan Skema Penindakan</label>
                              <select class="form-control form-select select2" name="skema_penindakan_perintah">
                                <option value="" selected disabled>- Pilih -</option>
                                <option value="MANDIRI">Mandiri</option>
                                <option value="Perbantuan">Perbantuan</option>
                                <option value="Perbantuan/Bersama Instansi Lain">Perbantuan/Bersama Instansi Lain</option>
                              </select>
                            </div>

                            <div class="col-lg-12 mb-3">
                              <label>Dilakukannya Patroli</label>
                              <select class="form-control form-select select2" name="dilakukannya_patroli">
                                <option value="" selected disabled>- Pilih -</option>
                                <option value="YA">YA</option>
                                <option value="TIDAK">TIDAK</option>
                              </select>
                            </div>

                            <div class="col-md-12 mb-3">
                              <label class="d-flex align-items-center">
                                Pertimbangan Surat Perintah
                                <button type="button" class="btn p-0 ms-1 text-primary" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip"
                                  data-bs-title="Diisi dengan mengapit #isi# disetiap point, dan enter untuk baris baru untuk point baru">
                                  <i data-feather="alert-circle" style="width: 18px; height: 18px;"></i>
                                </button>
                              </label>
                              <textarea class="form-control" rows="2" placeholder="Pertimbangan Diterbitkannya Surat Perintah" id="pertimbangan_surat_perintah" name="ket_perundang"></textarea>
                            </div>


                            <div class="col-md-12 mb-3">
                              <label class="d-flex align-items-center">
                                Dasar Hukum
                                <button type="button" class="btn p-0 ms-1 text-primary" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip"
                                  data-bs-title="Diisi dengan mengapit #isi# disetiap point, dan enter untuk baris baru untuk point baru">
                                  <i data-feather="alert-circle" style="width: 18px; height: 18px;"></i>
                                </button>
                              </label>
                              <textarea class="form-control" rows="2" placeholder="Dasar Hukum Yang Mendasari Diterbitkannya Surat Perintah" id="dasar_sp" name="dasar_sp"></textarea>
                            </div>


                          </div>
                        </div>

                        <div class="col-lg-6">
                          <h6><b>B. Pilih Pejabat</b></h6>
                          <hr>

                          <div class="col-lg-12 mb-3">
                            <label for="id_pejabat_sp_1">Pejabat Yang Diberi Perintah</label>
                            <select class="form-control form-select select2" id="id_pejabat_sp_1" name="id_pejabat_sp_1[]" multiple>
                              @foreach ($users as $user)
                                <option value="{{ $user->id_admin }}">{{ $user->name }}</option>
                              @endforeach
                            </select>
                          </div>

                          <div class="col-md-12 mb-3">
                            <label class="d-flex align-items-center" for="perintah">
                              Perintah
                              <button type="button" class="btn p-0 ms-1 text-primary" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip"
                                data-bs-title="Diisi dengan mengapit #isi# disetiap point, dan enter untuk baris baru untuk point baru">
                                <i data-feather="alert-circle" style="width: 18px; height: 18px;"></i>
                              </button>
                            </label>
                            <textarea class="form-control" rows="2" placeholder="Perintah Yang Diberikan Kepada Pejabat Bea dan Cukai" id="perintah_sp" name="perintah_sp"></textarea>
                          </div>


                          <div class="col-md-12 mb-3">
                            <label for="wilayah">Wilayah</label>
                            <input type="text" class="form-control" placeholder="Wilayah" name="wilayah">
                          </div>


                          <div class="row">

                            <div class="col-md-6 mb-3">
                              <label>Tanggal Mulai Berlaku</label>
                              <input type="date" class="form-control" name="tanggal_mulai_print">
                            </div>

                            <div class="col-md-6 mb-3">
                              <label>Tanggal Berakhir</label>
                              <input type="date" class="form-control" id="tanggal_berakhir_print" name="tanggal_berakhir_print">
                            </div>

                          </div>






                          <div class="col-md-12 mb-3">
                            <label for="ketentuan_baju">Ketentuan</label>
                            <select class="form-control" id="ketentuan_baju" name="ketentuan_baju">
                              <option value="" selected disabled>- Pilih -</option>
                              <option value="Berpakaian PDH">Berpakaian PDH</option>
                              <option value="Berpakaian Non PDH">Berpakaian Non PDH</option>
                              <option value="Berpakaian PDL">Berpakaian PDL</option>
                            </select>
                          </div>


                          <div class="col-md-12 mb-3">
                            <label class="d-flex align-items-center" for="ketentuan_lain">
                              Ketentuan Lain
                              <button type="button" class="btn p-0 ms-1 text-primary" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip"
                                data-bs-title="Diisi dengan mengapit #isi# disetiap point, dan enter untuk baris baru untuk point baru">
                                <i data-feather="alert-circle" style="width: 18px; height: 18px;"></i>
                              </button>
                            </label>
                            <textarea class="form-control" rows="2" placeholder="Ketentuan Lain" id="ketentuan_lain" name="ketentuan_lain"></textarea>
                          </div>



                          <div class="col-md-12 mb-3">
                            <label>Pelaksana Harian</label>
                            <select class="form-control form-select select2" id="plh" name="plh">
                              <option value="" selected disabled>- Pilih -</option>
                              <option value="Plh">Pelaksana Harian</option>
                              <option value="">Tidak Ada Pelaksana Harian</option>
                            </select>
                          </div>


                          <div class="col-md-12 mb-3">
                            <label for="id_pejabat_sp_2">Pejabat Yang Menandatangani</label>
                            <select class="form-control form-select select2" id="id_pejabat_sp_2" name="id_pejabat_sp_2">
                              <option value="" selected disabled>- Pilih -</option>
                              @foreach ($users as $user)
                                <option value="{{ $user->id_admin }}">{{ $user->name }}</option>
                              @endforeach
                            </select>
                          </div>


                        </div>
                      </div>



                    </div><!-- end tab pane -->
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
      const selectSkema = document.getElementById("skema_penindakan");

      function updateTabs() {
        const selectedKegiatan = selectKegiatan.value;
        const selectedSkema = selectSkema.value;

        document.getElementById("penindakan_section").classList.add("d-none");
        document.getElementById("patroli_section").classList.add("d-none");
        document.getElementById("tidak_layak_section").classList.add("d-none");

        if (selectedKegiatan === "penindakan") {
          document.getElementById("penindakan_section").classList.remove("d-none");
        } else if (selectedKegiatan === "patroli") {
          document.getElementById("patroli_section").classList.remove("d-none");
        } else if (selectedKegiatan === "tidak_layak") {
          document.getElementById("tidak_layak_section").classList.remove("d-none");
        }

        const tabsConfig = [{
            id: "navtabs2-messages-tab-item",
            linkId: "navtabs2-messages-tab",
            condition: selectedKegiatan === "tidak_layak",
          },
          {
            id: "navtabs2-mpp-tab-item",
            linkId: "navtabs2-mpp-tab",
            condition: (selectedKegiatan === "penindakan" || selectedKegiatan === "patroli") &&
              selectedSkema === "PELIMPAHAN",
          },
          {
            id: "navtabs2-settings-tab-item",
            linkId: "navtabs2-settings-tab",
            condition: selectedKegiatan === "penindakan" || selectedKegiatan === "patroli",
          },
        ];

        tabsConfig.forEach(({
          id,
          linkId,
          condition
        }) => {
          const tabElement = document.getElementById(id);
          const tabLinkElement = document.getElementById(linkId);

          if (condition) {
            tabElement.style.display = "block";

            if (tabLinkElement) {
              tabLinkElement.classList.add("highlight");
              setTimeout(() => tabLinkElement.classList.remove("highlight"), 1000);
            }
          } else {
            tabElement.style.display = "none";
          }
        });
      }

      selectKegiatan.addEventListener("change", updateTabs);
      selectSkema.addEventListener("change", updateTabs);

      document.getElementById("penindakan_section").classList.add("d-none");
      document.getElementById("patroli_section").classList.add("d-none");
      document.getElementById("tidak_layak_section").classList.add("d-none");
      ["navtabs2-messages", "navtabs2-mpp", "navtabs2-settings"].forEach((id) => {
        const tabElement = document.getElementById(id);
        tabElement.classList.remove("active", "show");
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
