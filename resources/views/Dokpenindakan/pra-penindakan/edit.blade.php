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
            <i data-feather="book" style="width: 20px; height: 20px;" class="me-1"></i> Form Edit Laporan Informasi (LI)
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
                    <ul class="nav nav-pills nav-justified flex-nowrap overflow-auto" style="white-space: nowrap;" role="tablist">
                      <li class="nav-item">
                        <a class="nav-link active" id="navtabs2-home-tab" data-bs-toggle="tab" href="#navtabs2-home" role="tab" aria-controls="navtabs2-home" aria-selected="true">
                          <span class="d-block d-sm-none">(LI)</span>
                          <span class="d-none d-sm-block">Laporan Informasi (LI)</span>
                        </a>
                      </li>
                      <li class="nav-item" id="navtabs2-messages-tab-item" style="display: none;">
                        <a class="nav-link" id="navtabs2-messages-tab" data-bs-toggle="tab" href="#navtabs2-messages" role="tab" aria-controls="navtabs2-messages" aria-selected="false">
                          <span class="d-block d-sm-none">NPI</span>
                          <span class="d-none d-sm-block">Nota Pengembalian Informasi (NPI)</span>
                        </a>
                      </li>
                      <li class="nav-item" id="navtabs2-profile-tab-item" style="display: none;">
                        <a class="nav-link" id="navtabs2-profile-tab" data-bs-toggle="tab" href="#navtabs2-profile" role="tab" aria-controls="navtabs2-profile" aria-selected="false">
                          <span class="d-block d-sm-none">LAP</span>
                          <span class="d-none d-sm-block">Lembar Analisis Pra Penindakan (LAP)</span>
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
                        <!-- Left Column (Data Laporan Informasi) -->
                        <div class="col-lg-6">
                          {{-- <input type="hidden" id="id_pra_penindakan" name="id_pra_penindakan" value="">
                          <input type="hidden" class="form-control bg-primary text-white" name="id_pengawasan_ref" value="{{ $no_laporan }}" readonly> --}}
                          <h6><b>A. Data Laporan Informasi (LI)</b></h6>
                          <hr>
                          <div class="row">
                            <div class="col-md-6 mb-3">
                              <label>No. LI</label>
                              <input type="text" class="form-control bg-primary text-white" name="no_li" value="{{ old('no_li', $praPenindakan->no_li) }}" readonly>
                            </div>
                            <div class="col-md-6 mb-3">
                              <label>Tgl. LI</label>
                              <input type="date" class="form-control bg-primary text-white" placeholder="yyyy-mm-dd" id="tgl_li" name="tgl_li" value="{{ old('tgl_li', $praPenindakan->tgl_li) }}">
                            </div>
                            <div class="col-md-12 mb-3">
                              <label>Isi Informasi</label>
                              <textarea class="form-control" rows="3" placeholder="Isi Informasi" id="isi_informasi" name="isi_informasi">{{ old('isi_informasi', $praPenindakan->isi_informasi) }}</textarea>
                            </div>
                            <div class="col-md-12 mb-3">
                              <label>Catatan</label>
                              <textarea class="form-control" rows="3" placeholder="Catatan" id="catatan" name="catatan">{{ old('catatan', $praPenindakan->catatan) }}</textarea>
                            </div>

                          </div>
                        </div>

                        <!-- Right Column (Pejabat Selection) -->
                        <div class="col-lg-6">
                          <h6><b>B. Pilih Pejabat</b></h6>
                          <hr>
                          <div class="col-lg-12 mb-3">
                            <label for="id_pejabat_li_1">Pejabat Pelaksana Penindakan</label>
                            <select class="form-control form-select select2" id="id_pejabat_li_1" name="id_pejabat_li_1">
                              <option value="" disabled>- Pilih -</option>
                              @foreach ($users as $user)
                                <option value="{{ $user->id_admin }}" {{ old('id_pejabat_li_1', $praPenindakan->id_pejabat_li_1) == $user->id_admin ? 'selected' : '' }}>
                                  {{ $user->name }}
                                </option>
                              @endforeach
                            </select>
                          </div>
                          <!-- Select Pejabat 2 -->
                          <div class="col-lg-12 mb-3">
                            <label for="id_pejabat_li_2">Pejabat Penerbit Laporan Informasi</label>
                            <select class="form-control form-select select2" id="id_pejabat_li_2" name="id_pejabat_li_2">
                              <option value="" disabled>- Pilih -</option>
                              @foreach ($users as $user)
                                <option value="{{ $user->id_admin }}" {{ old('id_pejabat_li_2', $praPenindakan->id_pejabat_li_2) == $user->id_admin ? 'selected' : '' }}>
                                  {{ $user->name }}
                                </option>
                              @endforeach
                            </select>
                          </div>
                          <!-- Select Pejabat 3 -->
                          <div class="col-lg-12 mb-3">
                            <label for="id_pejabat_li_3">Pengampu Pejabat Penerbit Lembar Informasi</label>
                            <select class="form-control form-select select2" id="id_pejabat_li_3" name="id_pejabat_li_3">
                              <option value="" disabled>- Pilih -</option>
                              @foreach ($users as $user)
                                <option value="{{ $user->id_admin }}" {{ old('id_pejabat_li_3', $praPenindakan->id_pejabat_li_3) == $user->id_admin ? 'selected' : '' }}>
                                  {{ $user->name }}
                                </option>
                              @endforeach
                            </select>
                          </div>

                          <div class="col-lg-12 mb-3">
                            <label>Tindak Lanjut Atau Tidak Ditindak Lanjut</label>
                            <select id="tindak_lanjut_li" class="form-control form-select" name="tindak_lanjut_li">
                              <option value="" disabled>- Pilih -</option>
                              <option value="Tidak Lanjut" {{ old('tindak_lanjut_li', $praPenindakan->tindak_lanjut_li) == 'Tidak Lanjut' ? 'selected' : '' }}>Tidak Bisa Ditindak Lanjut</option>
                              <option value="Lanjut" {{ old('tindak_lanjut_li', $praPenindakan->tindak_lanjut_li) == 'Lanjut' ? 'selected' : '' }}>Tindak Lanjut</option>
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
                              <input type="text" class="form-control bg-primary text-white" name="no_mpp" value="{{ old('no_mpp', $praPenindakan->no_mpp) }}" readonly>
                            </div>
                            <div class="col-md-6 mb-3">
                              <label>Tgl. MPP</label>
                              <input type="date" class="form-control bg-primary text-white" placeholder="yyyy-mm-dd" id="tgl_mpp" name="tgl_mpp" value="{{ old('tgl_mpp', $praPenindakan->tgl_mpp) }}">
                            </div>
                            <div class="col-md-12 mb-3">
                              <label>Yang Terhormat</label>
                              <input type="text" class="form-control" placeholder="Kepada YTH." name="yth_mpp" value="{{ old('yth_mpp', $praPenindakan->yth_mpp) }}">
                            </div>

                            <h6><b>B. Diduga Dilakukan Oleh </b></h6>
                            <hr>
                            <div class="col-md-12 mb-3">
                              <label>Nama</label>
                              <input type="text" class="form-control" placeholder="Nama Yang Diduga Melakukan Pelanggaran" name="nama_mpp" value="{{ old('nama_mpp', $praPenindakan->nama_mpp) }}">
                            </div>

                            <div class="col-md-12 mb-3">
                              <label>No Identitas</label>
                              <input type="text" class="form-control" placeholder="Nomor Identitas Pelaku" name="noiden_mpp" value="{{ old('noiden_mpp', $praPenindakan->noiden_mpp) }}">
                            </div>

                            <div class="col-md-12 mb-3">
                              <label>Keterangan lainnya</label>
                              <textarea class="form-control" rows="3" placeholder="Keterangan Lainnya" name="keterangan_mpp"> {{ old('keterangan_mpp', $praPenindakan->keterangan_mpp) }}</textarea>
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
                                            <option value="{{ $pelanggaran->alasan_penindakan }} ({{ $pelanggaran->jenis_pelanggaran }})"
                                              {{ ($praPenindakan->dugaan_pelanggaran_mpp ?? $laporan->jenis_pelanggaran_lpt . ' (' . $laporan->jenis_pelanggaran . ')') == $pelanggaran->alasan_penindakan . ' (' . $pelanggaran->jenis_pelanggaran . ')' ? 'selected' : '' }}>
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
                                            <option value="{{ $modus->uraian_modus }}" {{ ($praPenindakan->modus_pelanggaran_mpp ?? $laporan->modus_pelanggaran_lpt) == $modus->uraian_modus ? 'selected' : '' }}>
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
                                            <option value="{{ $locus->locus }}" {{ ($praPenindakan->locus_pelanggaran_mpp ?? $laporan->perkiraan_tempat_pelanggaran_lpt) == $locus->locus ? 'selected' : '' }}>
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
                                          value="{{ $praPenindakan->tempus_pelanggaran_mpp ?? $laporan->perkiraan_waktu_pelanggaran_lpt }}">
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
                                        <input type="text" class="form-control form-input" name="komoditi_mpp" placeholder="Uraian Komoditi Barang" value="{{ old('komoditi_mpp', $praPenindakan->komoditi_mpp) }}">
                                      </div>
                                    </div>

                                    <div class="row mb-3 form-group">
                                      <label class="col-sm-4 col-form-label">
                                        Jumlah Komoditi Barang
                                      </label>
                                      <div class="col-sm-8">
                                        <input type="text" class="form-control form-input" name="jumlah_barang_mpp" placeholder="Jumlah Komoditi Barang" value="{{ old('jumlah_barang_mpp', $praPenindakan->jumlah_barang_mpp) }}">
                                      </div>
                                    </div>

                                    <div class="row mb-3 form-group">
                                      <label class="col-sm-4 col-form-label">
                                        Jenis Pengangkut
                                      </label>
                                      <div class="col-sm-8">
                                        <input type="text" class="form-control form-input" placeholder="Jenis Pengangkut" name="jenis_pengangkut_mpp" value="{{ old('jenis_pengangkut_mpp', $praPenindakan->jenis_pengangkut_mpp) }}">
                                      </div>
                                    </div>

                                    <div class="row mb-3 form-group">
                                      <label class="col-sm-4 col-form-label">
                                        No Registrasi
                                      </label>
                                      <div class="col-sm-8">
                                        <input type="text" class="form-control form-input" placeholder="No Registrasi" name="noreg_mpp" value="{{ old('noreg_mpp', $praPenindakan->noreg_mpp) }}">
                                      </div>
                                    </div>

                                    <div class="row mb-3 form-group">
                                      <label class="col-sm-4 col-form-label">
                                        Peti Kemasan
                                      </label>
                                      <div class="col-sm-8">
                                        <input type="text" class="form-control form-input" placeholder="Peti Kemasan/Kemasan" name="kemasan_mpp" value="{{ old('kemasan_mpp', $praPenindakan->kemasan_mpp) }}">
                                      </div>
                                    </div>

                                    <div class="row mb-3 form-group">
                                      <label class="col-sm-4 col-form-label">
                                        Ukuran
                                      </label>
                                      <div class="col-sm-8">
                                        <input type="text" class="form-control form-input" placeholder="Ukuran Kontainer (Jika Ada)" name="ukuran_mpp" value="{{ old('ukuran_mpp', $praPenindakan->ukuran_mpp) }}">
                                      </div>
                                    </div>

                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>

                          <div class="col-md-12 mb-3">
                            <label>Dokumen Terkait</label>
                            <textarea class="form-control" name="dokterkait_mpp" rows="3" placeholder="diisi uraian dokumen yang diduga terkait Pelanggaran (jenis dokumen, nomor, tanggal).">{{ old('dokterkait_mpp', $praPenindakan->dokterkait_mpp) }}</textarea>
                          </div>

                          <div class="col-md-12 mb-3">
                            <label>Uraian Instruksi</label>
                            <textarea class="form-control" name="uraian_mpp" rows="3" placeholder="diisi uraian instruksi Memo Pelimpahan Penindakan (MPP) misalnya melakukan operasi penindakan berupa penghentian, pemeriksaan, Penegahan dan penyegelan.">{{ old('uraian_mpp', $praPenindakan->uraian_mpp) }}</textarea>
                          </div>

                          <div class="col-lg-12 mb-3">
                            <label>Pejabat Penerbit MPP</label>
                            <select class="form-control form-select select2" name="id_pejabat_mpp">
                              <option value="" disabled>- Pilih -</option>
                              @foreach ($users as $user)
                                <option value="{{ $user->id_admin }}" {{ old('id_pejabat_mpp', $praPenindakan->id_pejabat_mpp) == $user->id_admin ? 'selected' : '' }}>{{ $user->name }}</option>
                              @endforeach
                            </select>
                          </div>

                        </div>
                      </div>
                    </div>



                    <div class="tab-pane" id="navtabs2-profile" role="tabpanel">
                      <div class="row">
                        <!-- Left Column (Data Laporan Informasi) -->
                        <div class="col-lg-6">
                          <h6><b>A. Data Laporan Lembar Analisis Pra Penindakan (LAP)</b></h6>
                          <hr>
                          <div class="row">
                            <!-- No. LI / Tgl. LI -->
                            <div class="row">
                              <div class="col-md-6 mb-3">
                                <label>No. LAP</label>
                                <input type="text" class="form-control bg-primary text-white" name="no_lap" value="{{ old('no_lap', $praPenindakan->no_lap) }}" readonly>
                              </div>
                              <div class="col-md-6 mb-3">
                                <label>Tgl. LAP</label>
                                <input type="date" class="form-control bg-primary text-white" name="tgl_lap" value="{{ old('tgl_lap', $praPenindakan->tgl_lap) }}">
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
                                            <option value="" disabled>- Pilih -</option>
                                            <option value="TIDAK" {{ old('pelaku', $praPenindakan->pelaku) == 'TIDAK' ? 'selected' : '' }}>TIDAK</option>
                                            <option value="YA" {{ old('pelaku', $praPenindakan->pelaku) == 'YA' ? 'selected' : '' }}>YA</option>
                                          </select>
                                        </div>
                                      </div>

                                      <!-- Form Inputs -->
                                      <div class="row mb-3 form-group">
                                        <label class="col-sm-4 col-form-label">Keterangan Pelaku</label>
                                        <div class="col-sm-8">
                                          <textarea class="form-control form-input" name="keterangan_pelaku" placeholder="Keterangan pelaku" rows="2">{{ old('keterangan_pelaku', $praPenindakan->keterangan_pelaku) }}</textarea>
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
                                            <option value="TIDAK" {{ old('dugaan_pelanggaran', $praPenindakan->dugaan_pelanggaran) == 'TIDAK' ? 'selected' : '' }}>TIDAK</option>
                                            <option value="YA" {{ old('dugaan_pelanggaran', $praPenindakan->dugaan_pelanggaran) == 'YA' ? 'selected' : '' }}>YA</option>
                                          </select>
                                        </div>
                                      </div>

                                      <!-- Form Inputs -->
                                      <div class="row mb-3 form-group">
                                        <label class="col-sm-4 col-form-label">Keterangan Dugaan Pelanggaran</label>
                                        <div class="col-sm-8">
                                          <select class="form-control form-select select2" name="keterangan_dugaan_pelanggaran">
                                            <option value="" selected disabled>- Pilih -</option>
                                            @foreach ($jenis_pelanggaran as $pelanggaran)
                                              <option value="{{ $pelanggaran->alasan_penindakan }} ({{ $pelanggaran->jenis_pelanggaran }})"
                                                {{ $praPenindakan->keterangan_dugaan_pelanggaran == $pelanggaran->alasan_penindakan . ' (' . $pelanggaran->jenis_pelanggaran . ')' ? 'selected' : '' }}>
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
                                          <select id="locus" class="form-select" name="locus"> <!-- Ubah ID di sini -->
                                            <option value="TIDAK" {{ old('locus', $praPenindakan->locus) == 'TIDAK' ? 'selected' : '' }}>TIDAK</option>
                                            <option value="YA" {{ old('locus', $praPenindakan->locus) == 'YA' ? 'selected' : '' }}>YA</option>
                                          </select>
                                        </div>
                                      </div>

                                      <!-- Form Inputs -->
                                      <div class="row mb-3 form-group">
                                        <label class="col-sm-4 col-form-label">Keterangan Locus</label>
                                        <div class="col-sm-8">
                                          <select class="form-control form-select select2" name="keterangan_locus">
                                            <option value="" selected disabled>- Pilih -</option>
                                            @foreach ($tempat as $locus)
                                              <option value="{{ $locus->locus }}" {{ ($praPenindakan->keterangan_locus ?? $laporan->perkiraan_tempat_pelanggaran_lpt) == $locus->locus ? 'selected' : '' }}>
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
                                            <option value="TIDAK" {{ old('tempus', $praPenindakan->tempus) == 'TIDAK' ? 'selected' : '' }}>TIDAK</option>
                                            <option value="YA" {{ old('tempus', $praPenindakan->tempus) == 'YA' ? 'selected' : '' }}>YA</option>
                                          </select>
                                        </div>
                                      </div>


                                      <div class="row mb-3 form-group">
                                        <label class="col-sm-4 col-form-label">Keterangan Tempus</label>
                                        <div class="col-sm-8">
                                          <textarea class="form-control form-input" name="keterangan_tempus" placeholder="Keterangan Tempus" row="2"> {{ old('keterangan_tempus', $praPenindakan->keterangan_tempus) }}</textarea>
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
                                            <option value="Bukan" {{ old('prosedural', $praPenindakan->prosedural) == 'Bukan' ? 'selected' : '' }}>Bukan</option>
                                            <option value="Kewenangan DJBC" {{ old('prosedural', $praPenindakan->prosedural) == 'Kewenangan DJBC' ? 'selected' : '' }}>Kewenangan DJBC</option>
                                          </select>
                                        </div>
                                      </div>


                                      <div class="row mb-3 form-group">
                                        <label class="col-sm-4 col-form-label">Keterangan Prosedural</label>
                                        <div class="col-sm-8">
                                          <textarea class="form-control form-input" name="ket_prosedural" placeholder="Keterangan Prosedural" row="2"> {{ old('ket_prosedural', $praPenindakan->ket_prosedural) }}</textarea>
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
                                            <option value="TIDAK" {{ old('sdm', $praPenindakan->sdm) == 'TIDAK' ? 'selected' : '' }}>TIDAK</option>
                                            <option value="TERSEDIA" {{ old('sdm', $praPenindakan->sdm) == 'TERSEDIA' ? 'selected' : '' }}>TERSEDIA</option>
                                          </select>
                                        </div>
                                      </div>


                                      <div class="row mb-3 form-group">
                                        <label class="col-sm-4 col-form-label">Keterangan SDM</label>
                                        <div class="col-sm-8">
                                          <textarea class="form-control form-input" name="ket_sdm" placeholder="Keterangan SDM" row="2"> {{ old('ket_sdm', $praPenindakan->ket_sdm) }}</textarea>
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
                                            <option value="TIDAK" {{ old('sarana_prasarana', $praPenindakan->sarana_prasarana) == 'TIDAK' ? 'selected' : '' }}>TIDAK</option>
                                            <option value="TERSEDIA" {{ old('sarana_prasarana', $praPenindakan->sarana_prasarana) == 'TERSEDIA' ? 'selected' : '' }}>TERSEDIA</option>
                                          </select>
                                        </div>
                                      </div>


                                      <div class="row mb-3 form-group">
                                        <label class="col-sm-4 col-form-label">Keterangan Sarana Prasarana</label>
                                        <div class="col-sm-8">
                                          <textarea class="form-control form-input" name="ket_sarana_prasarana" placeholder="Keterangan Sarana Prasarana" row="2"> {{ old('ket_sarana_prasarana', $praPenindakan->ket_sarana_prasarana) }}</textarea>
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
                                            <option value="TIDAK" {{ old('anggaran', $praPenindakan->anggaran) == 'TIDAK' ? 'selected' : '' }}>TIDAK</option>
                                            <option value="TERSEDIA" {{ old('anggaran', $praPenindakan->anggaran) == 'TERSEDIA' ? 'selected' : '' }}>TERSEDIA</option>
                                          </select>
                                        </div>
                                      </div>


                                      <div class="row mb-3 form-group">
                                        <label class="col-sm-4 col-form-label">Keterangan Anggaran</label>
                                        <div class="col-sm-8">
                                          <textarea type="text" class="form-control form-input" name="ket_anggaran" placeholder="Keterangan Anggaran" row="2"> {{ old('ket_anggaran', $praPenindakan->ket_anggaran) }}</textarea>
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
                                            <option value="TIDAK" {{ old('layak_penindakan', $praPenindakan->layak_penindakan) == 'TIDAK' ? 'selected' : '' }}>TIDAK</option>
                                            <option value="YA" {{ old('layak_penindakan', $praPenindakan->layak_penindakan) == 'YA' ? 'selected' : '' }}>YA</option>
                                          </select>
                                        </div>
                                      </div>

                                      <div class="row mb-3 form-group">
                                        <label class="col-sm-4 col-form-label">Skema Penindakan</label>
                                        <div class="col-sm-8">
                                          <select id="skema_penindakan" class="form-select" name="skem_layak_penindakan"> <!-- Ubah ID di sini -->
                                            <option value="MANDIRI" {{ old('skem_layak_penindakan', $praPenindakan->skem_layak_penindakan) == 'MANDIRI' ? 'selected' : '' }}>MANDIRI</option>
                                            <option value="PELIMPAHAN" {{ old('skem_layak_penindakan', $praPenindakan->skem_layak_penindakan) == 'PELIMPAHAN' ? 'selected' : '' }}>PELIMPAHAN</option>
                                            <option value="BERSAMA" {{ old('skem_layak_penindakan', $praPenindakan->skem_layak_penindakan) == 'BERSAMA' ? 'selected' : '' }}>BERSAMA</option>
                                            <option value="DENGAN INSTANSI LAIN" {{ old('skem_layak_penindakan', $praPenindakan->skem_layak_penindakan) == 'DENGAN INSTANSI LAIN' ? 'selected' : '' }}>DENGAN INSTANSI LAIN</option>
                                            <option value="LAINNYA" {{ old('skem_layak_penindakan', $praPenindakan->skem_layak_penindakan) == 'LAINNYA' ? 'selected' : '' }}>LAINNYA</option>
                                          </select>

                                        </div>
                                      </div>


                                      <div class="row mb-3 form-group">
                                        <label class="col-sm-4 col-form-label">Keterangan Skema Penindakan </label>
                                        <div class="col-sm-8">
                                          <textarea class="form-control form-input" name="ket_layak_penindakan" placeholder="Keterangan Skema Penindakan " row="2"> {{ old('ket_layak_penindakan', $praPenindakan->ket_layak_penindakan) }}</textarea>
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
                                            <option value="TIDAK" {{ old('layak_patroli', $praPenindakan->layak_patroli) == 'TIDAK' ? 'selected' : '' }}>TIDAK</option>
                                            <option value="YA" {{ old('layak_patroli', $praPenindakan->layak_patroli) == 'YA' ? 'selected' : '' }}>YA</option>
                                          </select>
                                        </div>
                                      </div>

                                      <div class="row mb-3 form-group">
                                        <label class="col-sm-4 col-form-label">Skema Penindakan Patroli</label>
                                        <div class="col-sm-8">
                                          <select id="skema_penindakan-patroli" class="form-select" name="skem_layak_patroli"> <!-- Ubah ID di sini -->
                                            <option value="MANDIRI" {{ old('skem_layak_patroli', $praPenindakan->skem_layak_patroli) == 'MANDIRI' ? 'selected' : '' }}>MANDIRI</option>
                                            <option value="PELIMPAHAN" {{ old('skem_layak_patroli', $praPenindakan->skem_layak_patroli) == 'PELIMPAHAN' ? 'selected' : '' }}>PELIMPAHAN</option>
                                            <option value="BERSAMA" {{ old('skem_layak_patroli', $praPenindakan->skem_layak_patroli) == 'BERSAMA' ? 'selected' : '' }}>BERSAMA</option>
                                            <option value="DENGAN INSTANSI LAIN" {{ old('skem_layak_patroli', $praPenindakan->skem_layak_patroli) == 'DENGAN INSTANSI LAIN' ? 'selected' : '' }}>DENGAN INSTANSI LAIN</option>
                                            <option value="LAINNYA" {{ old('skem_layak_patroli', $praPenindakan->skem_layak_patroli) == 'LAINNYA' ? 'selected' : '' }}>LAINNYA</option>
                                          </select>

                                        </div>
                                      </div>


                                      <div class="row mb-3 form-group">
                                        <label class="col-sm-4 col-form-label">Keterangan Skema Patroli </label>
                                        <div class="col-sm-8">
                                          <textarea class="form-control form-input" name="ket_layak_patroli" placeholder="Keterangan Skema Patroli" row="2"> {{ old('ket_layak_patroli', $praPenindakan->ket_layak_patroli) }}</textarea>
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
                                            <option value="TIDAK" {{ old('tidak_layak', $praPenindakan->tidak_layak) == 'TIDAK' ? 'selected' : '' }}>TIDAK</option>
                                            <option value="YA" {{ old('tidak_layak', $praPenindakan->tidak_layak) == 'YA' ? 'selected' : '' }}>YA</option>
                                          </select>
                                        </div>
                                      </div>



                                      <div class="row mb-3 form-group">
                                        <label class="col-sm-4 col-form-label">Keterangan Tidak Layak Melakukan Operasi Penindakan atau Patroli </label>
                                        <div class="col-sm-8">
                                          <textarea class="form-control form-input" name="ket_tidak_layak" placeholder="Keterangan Tidak Layak" row="2"> {{ old('ket_tidak_layak', $praPenindakan->ket_tidak_layak) }}</textarea>
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
                            <textarea class="form-control form-input" name="kesimpulan_lap" placeholder="Kesimpulan" row="2"> {{ old('kesimpulan_lap', $praPenindakan->kesimpulan_lap) }}</textarea>
                          </div>
                          <h6><b>C. Pilih Pejabat LAP</b></h6>
                          <hr>
                          <!-- Select Pejabat 1 -->
                          <div class="col-lg-12 mb-3">
                            <label for="id_pejabat_lap_1">Pejabat LAP 1</label>
                            <select class="form-control" id="id_pejabat_lap_1" name="id_pejabat_lap_1">
                              <option value="" disabled>- Pilih -</option>
                              @foreach ($users as $user)
                                <option value="{{ $user->id_admin }}" {{ old('id_pejabat_lap_1', $praPenindakan->id_pejabat_lap_1) == $user->id_admin ? 'selected' : '' }}>
                                  {{ $user->name }}
                                </option>
                              @endforeach
                            </select>

                          </div>
                          <!-- Select Pejabat 2 -->
                          <div class="col-lg-12 mb-3">
                            <label for="id_pejabat_lap_2">Pejabat LAP 2</label>
                            <select class="form-control" id="id_pejabat_lap_2" name="id_pejabat_lap_2">
                              <option value="" selected disabled>- Pilih -</option>
                              @foreach ($users as $user)
                                <option value="{{ $user->id_admin }}" {{ old('id_pejabat_lap_2', $praPenindakan->id_pejabat_lap_2) == $user->id_admin ? 'selected' : '' }}>
                                  {{ $user->name }}
                                </option>
                              @endforeach
                            </select>
                          </div>

                          <!-- Select Pejabat 3 -->
                          <div class="col-lg-12 mb-3">
                            <label for="id_pejabat_lap_3">Pejabat LAP 3</label>
                            <select class="form-control" id="id_pejabat_lap_3" name="id_pejabat_lap_3">
                              <option value="" selected disabled>- Pilih -</option>
                              @foreach ($users as $user)
                                <option value="{{ $user->id_admin }}" {{ old('id_pejabat_lap_3', $praPenindakan->id_pejabat_lap_3) == $user->id_admin ? 'selected' : '' }}>
                                  {{ $user->name }}
                                </option>
                              @endforeach
                            </select>
                          </div>

                        </div>
                      </div>
                    </div><!-- end tab pane -->

                    <div class="tab-pane" id="navtabs2-messages" role="tabpanel">
                      <div class="row">
                        <div class="col-lg-6">
                          <h6><b>A. Nota Pengembalian Informasi</b></h6>
                          <hr>
                          <div class="row">
                            <div class="row">
                              <div class="col-md-6 mb-3">
                                <label>No. NPI</label>
                                <input type="text" class="form-control bg-primary text-white" name="no_npi" value="{{ old('no_npi', $praPenindakan->no_npi) }}" readonly>
                              </div>
                              <div class="col-md-6 mb-3">
                                <label>Tgl. NPI</label>
                                <input type="date" class="form-control bg-primary text-white" name="tgl_npi" value="{{ old('tgl_npi', $praPenindakan->tgl_npi) }}">
                              </div>
                            </div>
                            <div class="col-md-12 mb-3">
                              <label>Sumber Informasi</label>
                              <input type="text" class="form-control" placeholder="Sumber Informasi" id="sumber_informasi_npi" name="sumber_npi" value="{{ old('sumber_npi', $praPenindakan->sumber_npi) }}">
                            </div>
                            <div class="col-md-12 mb-3">
                              <label>Kategori Penindakan</label>
                              <select class="form-control form-select select2" name="kategori_npi" required>
                                <option value="" disabled>- Pilih -</option>
                                @foreach ($kapen as $kategori)
                                  <option value="{{ $kategori->jenis_penindakan }}" {{ old('kategori_npi', $praPenindakan->kategori_npi) == $kategori->jenis_penindakan ? 'selected' : '' }}>
                                    {{ $kategori->jenis_penindakan }}
                                  </option>
                                @endforeach
                              </select>
                            </div>

                            <div class="col-md-12 mb-3">
                              <label>Unit Penebit Informasi</label>
                              <textarea class="form-control" rows="2" placeholder="Unit Penerbit Informasi" id="unit_penerbit_informasi" name="unit_penerbit_npi"> {{ old('unit_penerbit_npi', $praPenindakan->unit_penerbit_npi) }}</textarea>
                            </div>
                            <div class="col-md-12 mb-3">
                              <label>Alasan</label>
                              <textarea class="form-control" rows="2" placeholder="Alasan Tidak Dapat Dilakukan Penindakan Lebih Lanjut" id="alasan_penindakan_npi" name="alasan_npi"> {{ old('alasan_npi', $praPenindakan->alasan_npi) }}</textarea>
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
                                <option value="{{ $user->id_admin }}" {{ old('id_pejabat_npi', $praPenindakan->id_pejabat_npi) == $user->id_admin ? 'selected' : '' }}>
                                  {{ $user->name }}
                                </option>
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

                            <div class="row">
                              <div class="col-md-6 mb-3">
                                <label>No. Print</label>
                                <input type="text" class="form-control bg-primary text-white" name="no_print" value="{{ old('no_print', $praPenindakan->no_print) }}" readonly>
                              </div>

                              <div class="col-md-6 mb-3">
                                <label>Tgl. Print</label>
                                <input type="date" class="form-control bg-primary text-white" name="tgl_print" value="{{ old('tgl_print', $praPenindakan->tgl_print) }}">
                              </div>
                            </div>

                            <div class="col-lg-12 mb-3">
                              <label>Penentuan Skema Penindakan</label>
                              <select class="form-control form-select select2" name="skema_penindakan_perintah">
                                <option value="" disabled>- Pilih -</option>
                                <option value="MANDIRI" {{ old('skema_penindakan_perintah', $praPenindakan->skema_penindakan_perintah) == 'MANDIRI' ? 'selected' : '' }}>Mandiri</option>
                                <option value="Perbantuan" {{ old('skema_penindakan_perintah', $praPenindakan->skema_penindakan_perintah) == 'Perbantuan' ? 'selected' : '' }}>Perbantuan</option>
                                <option value="Perbantuan/Bersama Instansi Lain" {{ old('skema_penindakan_perintah', $praPenindakan->skema_penindakan_perintah) == 'Perbantuan/Bersama Instansi Lain' ? 'selected' : '' }}>
                                  Perbantuan/Bersama Instansi Lain
                                </option>
                              </select>
                            </div>

                            <div class="col-lg-12 mb-3">
                              <label>Dilakukannya Patroli</label>
                              <select class="form-control form-select select2" name="dilakukannya_patroli">
                                <option value="" disabled>- Pilih -</option>
                                <option value="YA" {{ old('dilakukannya_patroli', $praPenindakan->dilakukannya_patroli) == 'YA' ? 'selected' : '' }}>YA</option>
                                <option value="TIDAK" {{ old('dilakukannya_patroli', $praPenindakan->dilakukannya_patroli) == 'TIDAK' ? 'selected' : '' }}>TIDAK</option>
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
                              <textarea class="form-control" rows="2" placeholder="Pertimbangan Diterbitkannya Surat Perintah" id="pertimbangan_surat_perintah" name="ket_perundang">{{ old('ket_perundang', $praPenindakan->ket_perundang) }}</textarea>
                            </div>

                            <div class="col-md-12 mb-3">
                              <label class="d-flex align-items-center">
                                Dasar Hukum
                                <button type="button" class="btn p-0 ms-1 text-primary" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip"
                                  data-bs-title="Diisi dengan mengapit #isi# disetiap point, dan enter untuk baris baru untuk point baru">
                                  <i data-feather="alert-circle" style="width: 18px; height: 18px;"></i>
                                </button>
                              </label>
                              <textarea class="form-control" rows="2" placeholder="Dasar Hukum Yang Mendasari Diterbitkannya Surat Perintah" id="dasar_sp" name="dasar_sp">{{ old('dasar_sp', $praPenindakan->dasar_sp) }}</textarea>
                            </div>


                          </div>
                        </div>

                        <div class="col-lg-6">
                          <h6><b>B. Pilih Pejabat</b></h6>
                          <hr>

                          <div class="col-lg-12 mb-3">
                            <label for="id_pejabat_sp_1">Pejabat Yang Diberi Perintah</label>
                            <select class="form-control form-select select2" id="id_pejabat_sp_1" name="id_pejabat_sp_1[]" multiple>
                              @php
                                $selectedPejabat = json_decode($praPenindakan->id_pejabat_sp_1, true) ?? [];
                              @endphp
                              @foreach ($users as $user)
                                <option value="{{ $user->id_admin }}" {{ in_array($user->id_admin, $selectedPejabat) ? 'selected' : '' }}>
                                  {{ $user->name }}
                                </option>
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
                            <textarea class="form-control" rows="2" placeholder="Perintah Yang Diberikan Kepada Pejabat Bea dan Cukai" id="perintah_sp" name="perintah_sp">{{ old('perintah_sp', $praPenindakan->perintah_sp) }}</textarea>
                          </div>


                          <div class="col-md-12 mb-3">
                            <label for="wilayah">Wilayah</label>
                            <input type="text" placeholder="Wilayah" class="form-control" value="{{ old('wilayah', $praPenindakan->wilayah) }}" name="wilayah">
                          </div>


                          <div class="row">
                            <div class="col-md-6 mb-3">
                              <label>Tanggal Mulai Berlaku</label>
                              <input type="date" class="form-control" name="tanggal_mulai_print" value="{{ old('tanggal_mulai_print', $praPenindakan->tanggal_mulai_print) }}">
                            </div>

                            <div class="col-md-6 mb-3">
                              <label>Tanggal Berakhir</label>
                              <input type="date" class="form-control" id="tanggal_berakhir_print" value="{{ old('tanggal_berakhir_print', $praPenindakan->tanggal_berakhir_print) }}" name="tanggal_berakhir_print">
                            </div>
                          </div>






                          <div class="col-md-12 mb-3">
                            <label for="ketentuan_baju">Ketentuan</label>
                            <select class="form-control" id="ketentuan_baju" name="ketentuan_baju">
                              <option value="" selected disabled>- Pilih -</option>
                              <option value="Berpakaian PDH" {{ old('ketentuan_baju', $praPenindakan->ketentuan_baju) == 'Berpakaian PDH' ? 'selected' : '' }}>Berpakaian PDH</option>
                              <option value="Berpakaian Non PDH" {{ old('ketentuan_baju', $praPenindakan->ketentuan_baju) == 'Berpakaian Non PDH' ? 'selected' : '' }}>Berpakaian Non PDH</option>
                              <option value="Berpakaian PDL" {{ old('ketentuan_baju', $praPenindakan->ketentuan_baju) == 'Berpakaian PDL' ? 'selected' : '' }}>Berpakaian PDL</option>
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
                            <textarea class="form-control" rows="2" placeholder="Ketentuan Lain" id="ketentuan_lain" name="ketentuan_lain">{{ old('ketentuan_lain', $praPenindakan->ketentuan_lain) }}</textarea>
                          </div>


                          <div class="col-md-12 mb-3">
                            <label for="plh">Pelaksana Harian</label>
                            <select class="form-control form-select select2" id="plh" name="plh">
                              <option value="" disabled>- Pilih -</option>
                              <option value="Plh" {{ old('plh', $praPenindakan->plh) == 'Plh' ? 'selected' : '' }}>Pelaksana Harian</option>
                              <option value="" {{ old('plh', $praPenindakan->plh) == '' ? 'selected' : '' }}>Tidak Ada Pelaksana Harian</option>
                            </select>
                          </div>




                          <div class="col-md-12 mb-3">
                            <label for="id_pejabat_sp_2">Pejabat Yang Menandatangani</label>
                            <select class="form-control form-select select2" id="id_pejabat_sp_2" name="id_pejabat_sp_2">
                              <option value="" selected disabled>- Pilih -</option>
                              @foreach ($users as $user)
                                <option value="{{ $user->id_admin }}" {{ old('id_pejabat_sp_2', $praPenindakan->id_pejabat_sp_2) == $user->id_admin ? 'selected' : '' }}>
                                  {{ $user->name }}
                                </option>
                              @endforeach
                            </select>

                          </div>


                        </div>
                      </div>


                    </div>

                    <div class="card-footer d-flex justify-content-end">
                      <button type="submit" class="btn btn-success btn-sm d-flex align-items-center">
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
      const tabsConfig = [{
        selectId: "tindak_lanjut_li",
        tabs: [{
            id: "navtabs2-messages-tab-item",
            linkId: "navtabs2-messages-tab",
            condition: (value) => value === "Tidak Lanjut"
          },
          {
            id: "navtabs2-profile-tab-item",
            linkId: "navtabs2-profile-tab",
            condition: (value) => value === "Lanjut"
          },
          {
            id: "navtabs2-mpp-tab-item",
            linkId: "navtabs2-mpp-tab",
            condition: (value) => value === "Lanjut"
          },
          {
            id: "navtabs2-settings-tab-item",
            linkId: "navtabs2-settings-tab",
            condition: (value) => value === "Lanjut"
          },
        ]
      }];

      tabsConfig.forEach(({
        selectId,
        tabs
      }) => {
        const selectElement = document.getElementById(selectId);

        const updateTabs = (selectedValue) => {
          tabs.forEach(({
            id,
            linkId,
            condition
          }) => {
            const tabElement = document.getElementById(id);
            const tabLinkElement = document.getElementById(linkId);

            if (condition(selectedValue)) {
              tabElement.style.display = "block";
              const tabContainer = document.querySelector(".tabs-container");
              if (tabContainer) {
                const offsetTop = tabContainer.offsetTop;
                window.scrollTo({
                  top: offsetTop - 70,
                  behavior: "smooth",
                });
              }

              tabLinkElement.classList.add("highlight");
              setTimeout(() => tabLinkElement.classList.remove("highlight"), 1000);
            } else {
              tabElement.style.display = "none";
            }
          });
        };

        const initialValue = selectElement.value;
        tabs.forEach(({
          id
        }) => {
          const tabElement = document.getElementById(id);
          tabElement.style.display = "none";
        });
        updateTabs(initialValue);
        selectElement.addEventListener("change", function() {
          const selectedValue = selectElement.value;
          updateTabs(selectedValue);
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
