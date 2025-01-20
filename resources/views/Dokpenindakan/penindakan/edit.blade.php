@extends('layouts.vertical', ['title' => 'Edit Form Penindakan'])

@section('css')
  @vite(['node_modules/datatables.net-bs5/css/dataTables.bootstrap5.min.css', 'node_modules/datatables.net-buttons-bs5/css/buttons.bootstrap5.min.css', 'node_modules/datatables.net-keytable-bs5/css/keyTable.bootstrap5.min.css', 'node_modules/datatables.net-responsive-bs5/css/responsive.bootstrap5.min.css', 'node_modules/datatables.net-select-bs5/css/select.bootstrap5.min.css'])
@endsection


@section('content')
  <div class="container-fluid">
    <div class="card mb-3 mt-4">
      <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="card-title mb-0">
          <i data-feather="book" style="width: 20px; height: 20px;" class="me-1"></i>
          Form Edit Penindakan
        </h5>
        <button type="button" class="btn btn-danger btn-sm" onclick="window.history.back()">
          <i data-feather="log-out"></i> Kembali
        </button>
      </div>

      <div class="card-body">
        <form action="{{ route('penindakan.update', ['penindakan' => $penindakans->id]) }}" method="POST">
          @csrf
          @method('PUT')
          <div class="card">

            <div class="row">
              <div class="col-md-3">
                <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">

                  <a class="nav-link mb-2 active" id="penindakan-tab" data-bs-toggle="pill" href="#penindakan" role="tab" aria-controls="penindakan" aria-selected="true">
                    <span class="d-block d-sm-none">Data Penindakan</span>
                    <span class="d-none d-sm-block">Data Penindakan</span>
                  </a>

                  <a class="nav-link mb-2" id="ba-henti-tab" data-bs-toggle="pill" href="#ba-henti" role="tab" aria-controls="ba-henti" aria-selected="false">
                    <span class="d-block d-sm-none">Penghentian</span>
                    <span class="d-none d-sm-block">Penghentian</span>
                  </a>
                  <a class="nav-link mb-2" id="ba-riksa-tab" data-bs-toggle="pill" href="#ba-riksa" role="tab" aria-controls="ba-riksa" aria-selected="false">
                    <span class="d-block d-sm-none">Pemeriksaan</span>
                    <span class="d-none d-sm-block">Pemeriksaan</span>
                  </a>
                  <a class="nav-link mb-2" id="ba-sarkut-tab" data-bs-toggle="pill" href="#ba-sarkut" role="tab" aria-controls="ba-sarkut" aria-selected="false">
                    <span class="d-block d-sm-none">(B.A Sarkut)</span>
                    <span class="d-none d-sm-block">B.A Sarkut</span>
                  </a>
                  <a class="nav-link mb-2" id="ba-contoh-tab" data-bs-toggle="pill" href="#ba-contoh" role="tab" aria-controls="ba-contoh" aria-selected="false">
                    <span class="d-block d-sm-none">(B.A Contoh)</span>
                    <span class="d-none d-sm-block">B.A Contoh</span>
                  </a>
                  <a class="nav-link mb-2" id="ba-dok-tab" data-bs-toggle="pill" href="#ba-dok" role="tab" aria-controls="ba-dok" aria-selected="false">
                    <span class="d-block d-sm-none">(B.A DOK)</span>
                    <span class="d-none d-sm-block">B.A Dokumentasi</span>
                  </a>
                  <a class="nav-link" id="ba-tegah-tab" data-bs-toggle="pill" href="#ba-tegah" role="tab" aria-controls="ba-tegah" aria-selected="false">
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
                  </a>
                </div>

              </div>

              <div class="col-md-9">
                <div class="overflow-auto" style="max-height: 408px;  padding: 10px;">
                  <div class="tab-content p-0 text-muted mt-md-0" id="v-pills-tabContent">


                    <div class="tab-pane fade show active" id="penindakan" role="tabpanel" aria-labelledby="penindakan-tab">
                      <div class="tab-pane" id="sbp" role="tabpanel">
                        <div class="row">
                          <div class="col-lg-6">
                            <h6><b>Data Referensi</b></h6>
                            <hr>
                            <div class="row">
                              <div class="col-md-12 mb-3">
                                <label>Opsi Penindakan</label>
                                <input type="text" class="form-control bg-primary text-white" value="{{ old('opsi_penindakan', $penindakans->opsi_penindakan) }}" readonly>
                              </div>
                              <div class="col-md-6 mb-3">
                                <label>No. Surat Perintah</label>
                                <input type="text" class="form-control bg-primary text-white" value="{{ $laporan->no_print }}" readonly>
                              </div>

                              <div class="col-md-6 mb-3">
                                <label>Tgl. Surat Perintah</label>
                                <input type="text" class="form-control bg-prima bg-primary text-white" value="{{ $laporan->tgl_print }}" readonly>
                              </div>

                              <h6><b>A. Data Awal</b></h6>
                              <hr>

                              <!-- No. SBP / Tgl. SBP -->
                              <div class="col-md-6 mb-3">
                                <label>No. SBP</label>
                                <input type="text" class="form-control bg-primary text-white" name="no_sbp" id="no_sbp" value="{{ old('no_sbp', $penindakans->no_sbp) }}" readonly>
                              </div>
                              <div class="col-md-6 mb-3">
                                <label>Tgl. SBP</label>
                                <input type="date" class="form-control bg-primary text-white" value="{{ old('tgl_sbp', $penindakans->tgl_sbp) }}" placeholder="yyyy-mm-dd" id="tgl_sbp" name="tgl_sbp">
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

                              <h6><b>B. Data Petugas</b></h6>
                              <hr>

                              <div class="col-md-6 mb-3">
                                <label>Pejabat 1 Penindakan</label>
                                <select class="form-select select2" name="id_petugas_1_sbp" disabled>
                                  <option value="" disabled {{ old('id_petugas_1_sbp', $penindakans->id_petugas_1_sbp) == '' ? 'selected' : '' }}>- Pilih -</option>
                                  @foreach ($users as $user)
                                    <option value="{{ $user->id_admin }}" {{ old('id_petugas_1_sbp', $penindakans->id_petugas_1_sbp) == $user->id_admin ? 'selected' : '' }}>{{ $user->name }}</option>
                                  @endforeach
                                </select>
                              </div>

                              <div class="col-md-6 mb-3">
                                <label>Pejabat 2 Penindakan</label>
                                <select class="form-select select2" name="id_petugas_2_sbp">
                                  <option value="" disabled {{ old('id_petugas_2_sbp', $penindakans->id_petugas_2_sbp) == '' ? 'selected' : '' }}>- Pilih -</option>
                                  @foreach ($users as $user)
                                    <option value="{{ $user->id_admin }}" {{ old('id_petugas_2_sbp', $penindakans->id_petugas_2_sbp) == $user->id_admin ? 'selected' : '' }}>{{ $user->name }}</option>
                                  @endforeach
                                </select>
                              </div>

                              <div class="col-md-6 mb-3">
                                <label>Pejabat 3 Penindakan</label>
                                <select class="form-select select2" name="id_petugas_3_sbp">
                                  <option value="" disabled {{ old('id_petugas_3_sbp', $penindakans->id_petugas_3_sbp) == '' ? 'selected' : '' }}>- Pilih -</option>
                                  @foreach ($users as $user)
                                    <option value="{{ $user->id_admin }}" {{ old('id_petugas_3_sbp', $penindakans->id_petugas_3_sbp) == $user->id_admin ? 'selected' : '' }}>{{ $user->name }}</option>
                                  @endforeach
                                </select>
                              </div>

                              <div class="col-md-6 mb-3">
                                <label>Pejabat 4 Penindakan</label>
                                <select class="form-select select2" name="id_petugas_4_sbp">
                                  <option value="" disabled {{ old('id_petugas_4_sbp', $penindakans->id_petugas_4_sbp) == '' ? 'selected' : '' }}>- Pilih -</option>
                                  @foreach ($users as $user)
                                    <option value="{{ $user->id_admin }}" {{ old('id_petugas_4_sbp', $penindakans->id_petugas_4_sbp) == $user->id_admin ? 'selected' : '' }}>{{ $user->name }}</option>
                                  @endforeach
                                </select>
                              </div>


                              <h6><b>C. Data Saksi</b></h6>
                              <hr>

                              <div class="col-md-6 mb-3">
                                <label>Nama Saksi</label>
                                <input type="text" class="form-control" placeholder="Nama Saksi" name="nama_saksi" value="{{ old('nama_saksi', $penindakans->nama_saksi) }}">
                              </div>
                              <div class="col-md-6 mb-3">
                                <label>Pekerjaan Saksi</label>
                                <input type="text" class="form-control" placeholder="Pekerjaan Saksi" name="pekerjaan_saksi" value="{{ old('pekerjaan_saksi', $penindakans->pekerjaan_saksi) }}">
                              </div>
                              <div class="col-md-6 mb-3">
                                <label>Kontak Saksi (NO.HP)</label>
                                <input type="text" class="form-control" placeholder="Kontak Saksi (NO.HP)" name="kontak_saksi" value="{{ old('kontak_saksi', $penindakans->kontak_saksi) }}">
                              </div>
                              <div class="col-md-6 mb-3">
                                <label>No. Identitas Saksi</label>
                                <input type="text" class="form-control" placeholder="No. Identitas Saksi" name="no_identitas_saksi" value="{{ old('no_identitas_saksi', $penindakans->no_identitas_saksi) }}">
                              </div>
                              <div class="col-md-12 mb-3">
                                <label>Jenis Identitas Saksi</label>
                                <input type="text" class="form-control" placeholder="KTP/SIM/DLL" name="jenis_iden_saksi" value="{{ old('jenis_iden_saksi', $penindakans->jenis_iden_saksi) }}">
                              </div>
                              <div class="col-md-12 mb-3">
                                <label>Alamat Saksi</label>
                                <input type="text" class="form-control" placeholder="Alamat Saksi" name="alamat_saksi" value="{{ old('alamat_saksi', $penindakans->alamat_saksi) }}">
                              </div>
                              <div class="col-md-6 mb-3">
                                <label>Jenis Kelamin</label>
                                <select class="form-control form-input select2" name="jk_saksi">
                                  <option value="" disabled {{ old('jk_saksi', $penindakans->jk_saksi) == '' ? 'selected' : '' }}>Pilih Jenis Kelamin</option>
                                  <option value="Laki-laki" {{ old('jk_saksi', $penindakans->jk_saksi) == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                                  <option value="Perempuan" {{ old('jk_saksi', $penindakans->jk_saksi) == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                                </select>
                              </div>
                              <div class="col-md-6 mb-3">
                                <label>Tempat Tanggal Lahir</label>
                                <input type="text" class="form-control" placeholder="Tempat Tanggal Lahir" name="ttl_saksi" value="{{ old('ttl_saksi', $penindakans->ttl_saksi) }}">
                              </div>
                              <div class="mb-3 form-group">
                                <label>Kewarganegaraan</label>
                                <div class="col-sm-12">
                                  <select class="form-control form-input select2" name="kewarganegaraan_saksi">
                                    <option value="" disabled {{ old('kewarganegaraan_saksi', $penindakans->kewarganegaraan_saksi) == '' ? 'selected' : '' }}>- Pilih Kewarganegaraan -</option>
                                    @foreach ($nama_negara as $benua => $negara)
                                      <optgroup label="{{ $benua }}">
                                        @foreach ($negara as $item)
                                          <option value="{{ $item->UrEdi }}" {{ old('kewarganegaraan_saksi', $penindakans->kewarganegaraan_saksi) == $item->UrEdi ? 'selected' : '' }}>
                                            {{ $item->UrEdi }}
                                          </option>
                                        @endforeach
                                      </optgroup>
                                    @endforeach
                                  </select>
                                </div>
                              </div>

                              <div class="col-md-6 mb-3">
                                <label>Umur</label>
                                <input type="number" class="form-control" placeholder="Umur" name="umur_saksi" value="{{ old('umur_saksi', $penindakans->umur_saksi) }}">
                              </div>
                              <div class="col-md-6 mb-3">
                                <label>NPWP</label>
                                <input type="text" class="form-control" placeholder="NPWP" name="npwp_saksi" value="{{ old('npwp_saksi', $penindakans->npwp_saksi) }}">
                              </div>
                              <div class="col-md-12 mb-3">
                                <label>Nomor Rekening</label>
                                <input type="text" class="form-control" placeholder="Nomor Rekening" name="norek_saksi" value="{{ old('norek_saksi', $penindakans->norek_saksi) }}">
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

                          </div>



                          <!-- Right Column (Sections C, D, and E) -->
                          <div class="col-lg-6">
                            <!-- C. Informasi Pelapor dan Hasil Penindakan -->
                            <h6><b>E. Data Penindakan</b></h6>
                            <hr>
                            <div class="row">
                              <div class="col-md-12 mb-3">
                                <label>Lokasi Penindakan</label>
                                <input type="text" class="form-control" name="lokasi_penindakan" placeholder="Lokasi Penindakan" value="{{ old('lokasi_penindakan', $penindakans->lokasi_penindakan) }}">
                              </div>

                              <div class="col-md-12 mb-3">
                                <label>Uraian Penindakan</label>
                                <textarea class="form-control" placeholder="Uraian Penindakan" name="uraian_penindakan" rows="8">{{ old('uraian_penindakan', $penindakans->uraian_penindakan) }}</textarea>
                              </div>

                              <div class="col-md-12 mb-3">
                                <label>Alasan Penindakan</label>
                                <select class="form-control select2" name="alasan_penindakan" id="alasan_penindakan">
                                  <option value="" disabled>-Pilih Alasan Penindakan-</option>
                                  @foreach ($jenisPelanggaran->unique('alasan_penindakan') as $jenis)
                                    <option value="{{ $jenis->alasan_penindakan }} ({{ $jenis->jenis_pelanggaran }})" data-jenis="{{ $jenis->jenis_pelanggaran }}"
                                      {{ old('alasan_penindakan', $penindakans->alasan_penindakan) == $jenis->alasan_penindakan . ' (' . $jenis->jenis_pelanggaran . ')' ? 'selected' : '' }}>
                                      {{ $jenis->alasan_penindakan }}
                                    </option>
                                  @endforeach
                                </select>
                              </div>

                              <div class="col-md-12 mb-3">
                                <label>Jenis Pelanggaran</label>
                                <textarea class="form-control form-input bg-primary text-white" id="jenis_pelanggaran" rows="8" disabled>{{ old('jenis_pelanggaran', $penindakans->jenis_pelanggaran) }}</textarea>
                              </div>


                              <div class="col-md-12 mb-3">
                                <label>Tanggal Mulai & Waktu Mulai</label>
                                <input type="text" class="form-control" name="tgl_mulai" id="datetime-datepicker" placeholder="Tanggal Mulai & Waktu Mulai" value="{{ old('tgl_mulai', $penindakans->tgl_mulai) }}">
                              </div>

                              <div class="col-md-12 mb-3">
                                <label>Tanggal Selesai & Waktu Selesai</label>
                                <input type="text" class="form-control" name="tgl_selesai" id="datetime-datepicker" placeholder="Tanggal Selesai & Waktu Selesai" value="{{ old('tgl_selesai', $penindakans->tgl_selesai) }}">
                              </div>

                              <div class="col-md-12 mb-3">
                                <label>Hal Yang Terjadi</label>
                                <textarea class="form-control" placeholder="Hal Yang Terjadi" name="hal_yang_terjadi" rows="11">{{ old('hal_yang_terjadi', $penindakans->hal_yang_terjadi) }}</textarea>
                              </div>
                            </div>




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
                                          <option value="TIDAK" {{ old('data_sarkut', $penindakans->data_sarkut) == 'TIDAK' ? 'selected' : '' }}>TIDAK</option>
                                          <option value="YA" {{ old('data_sarkut', $penindakans->data_sarkut) == 'YA' ? 'selected' : '' }}>YA</option>
                                        </select>
                                      </div>
                                    </div>

                                    <!-- Form Inputs -->
                                    <div class="row mb-3 form-group">
                                      <label class="col-sm-4 col-form-label">Nama dan Jenis Sarkut</label>
                                      <div class="col-sm-8">
                                        <input type="text" class="form-control form-input" name="nama_jenis_sarkut" value="{{ old('nama_jenis_sarkut', $penindakans->nama_jenis_sarkut) }}" placeholder="Nama Dan Jenis Sarkut"
                                          {{ $penindakans->data_sarkut == 'YA' ? '' : 'disabled' }}>
                                      </div>
                                    </div>
                                    <div class="row mb-3 form-group">
                                      <label class="col-sm-4 col-form-label">No. Voy/ Penerbangan/ Trayek</label>
                                      <div class="col-sm-8">
                                        <input type="text" class="form-control form-input" name="no_flight" value="{{ old('no_flight', $penindakans->no_flight) }}" placeholder="No. Voy/ Penerbangan/ Trayek"
                                          {{ $penindakans->data_sarkut == 'YA' ? '' : 'disabled' }}>
                                      </div>
                                    </div>
                                    <div class="row mb-3 form-group">
                                      <label class="col-sm-4 col-form-label">Ukuran/ Kapasitas Muatan</label>
                                      <div class="col-sm-8">
                                        <input type="text" class="form-control form-input" name="kapasitas_muatan" value="{{ old('kapasitas_muatan', $penindakans->kapasitas_muatan) }}" placeholder="Ukuran/ Kapasitas Muatan"
                                          {{ $penindakans->data_sarkut == 'YA' ? '' : 'disabled' }}>
                                      </div>
                                    </div>
                                    <div class="row mb-3 form-group">
                                      <label class="col-sm-4 col-form-label">Nahkoda/ Pilot/ Pengemudi</label>
                                      <div class="col-sm-8">
                                        <input type="text" class="form-control form-input" name="pengemudi" value="{{ old('pengemudi', $penindakans->pengemudi) }}" placeholder="Nahkoda/ Pilot/ Pengemudi"
                                          {{ $penindakans->data_sarkut == 'YA' ? '' : 'disabled' }}>
                                      </div>
                                    </div>
                                    <div class="row mb-3 form-group">
                                      <label class="col-sm-4 col-form-label">No. Identitas Nahkoda/ Pilot/ Pengemudi</label>
                                      <div class="col-sm-8">
                                        <input type="text" class="form-control form-input" name="no_identitas_pengemudi" value="{{ old('no_identitas_pengemudi', $penindakans->no_identitas_pengemudi) }}"
                                          placeholder="No. Identitas Nahkoda/ Pilot/ Pengemudi" {{ $penindakans->data_sarkut == 'YA' ? '' : 'disabled' }}>
                                      </div>
                                    </div>
                                    <div class="row mb-3 form-group">
                                      <label class="col-sm-4 col-form-label">Bendera</label>
                                      <div class="col-sm-8">
                                        <input type="text" class="form-control form-input" name="bendera" value="{{ old('bendera', $penindakans->bendera) }}" placeholder="Bendera" {{ $penindakans->data_sarkut == 'YA' ? '' : 'disabled' }}>
                                      </div>
                                    </div>
                                    <div class="row mb-3 form-group">
                                      <label class="col-sm-4 col-form-label">Nomor Registrasi/ Polisi</label>
                                      <div class="col-sm-8">
                                        <input type="text" class="form-control form-input" name="no_polisi" value="{{ old('no_polisi', $penindakans->no_polisi) }}" placeholder="Nomor Registrasi/ Polisi"
                                          {{ $penindakans->data_sarkut == 'YA' ? '' : 'disabled' }}>
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
                                        <select id="data_barang" name="data_barang" class="form-select" onchange="toggleForm(this.value, 'flush-collapseTwo')">
                                          <option value="TIDAK" {{ old('data_barang', $penindakans->data_barang) == 'TIDAK' ? 'selected' : '' }}>TIDAK</option>
                                          <option value="YA" {{ old('data_barang', $penindakans->data_barang) == 'YA' ? 'selected' : '' }}>YA</option>
                                        </select>
                                      </div>
                                    </div>

                                    <!-- Form Inputs -->
                                    <div class="row mb-3 form-group">
                                      <label class="col-sm-4 col-form-label">Jumlah/Jenis/Ukuran/Nomor</label>
                                      <div class="col-sm-8">
                                        <textarea class="form-control form-input" placeholder="Jumlah/Jenis/Ukuran/Nomor" name="jumlah_jenis_ukuran_no" rows="3" {{ $penindakans->data_barang == 'YA' ? '' : 'disabled' }}>{{ old('jumlah_jenis_ukuran_no', $penindakans->jumlah_jenis_ukuran_no) }}</textarea>
                                      </div>
                                    </div>


                                    <div class="row mb-3 form-group">
                                      <label class="col-sm-4 col-form-label">Peti Kemasan / Kemasan</label>
                                      <div class="col-sm-8">
                                        <select class="form-control form-input select2" name="id_kemasan" {{ $penindakans->data_barang == 'YA' ? '' : 'disabled' }}>
                                          <option value="" disabled selected>- Pilih -</option>
                                          @foreach ($kemasans as $kemasan)
                                            <option value="{{ $kemasan->id_kemasan }}" {{ old('id_kemasan', $penindakans->id_kemasan) == $kemasan->id_kemasan ? 'selected' : '' }}>{{ $kemasan->nama_kemasan }}</option>
                                          @endforeach
                                        </select>
                                      </div>
                                    </div>

                                    <div class="row mb-3 form-group">
                                      <label class="col-sm-4 col-form-label">Jumlah Barang</label>
                                      <div class="col-sm-8">
                                        <input type="text" class="form-control form-input" placeholder="Jumlah Barang" name="jumlah_barang" value="{{ old('jumlah_barang', $penindakans->jumlah_barang) }}"
                                          {{ $penindakans->data_barang == 'YA' ? '' : 'disabled' }}>
                                      </div>
                                    </div>
                                    <div class="row mb-3 form-group">
                                      <label class="col-sm-4 col-form-label">Uraian Barang</label>
                                      <div class="col-sm-8">
                                        <textarea class="form-control form-input" placeholder="Uraian Barang" name="jenis_barang" rows="2" {{ $penindakans->data_barang == 'YA' ? '' : 'disabled' }}>{{ old('jenis_barang', $penindakans->jenis_barang) }}</textarea>
                                      </div>
                                    </div>

                                    <div class="row mb-3 form-group">
                                      <label class="col-sm-4 col-form-label">Jenis/Nomor dan Tgl. Dokumen</label>
                                      <div class="col-sm-4">
                                        <input type="text" class="form-control form-input" name="jenis_no_tgl_dok" placeholder="-" value="{{ old('jenis_no_tgl_dok', $penindakans->jenis_no_tgl_dok) }}"
                                          {{ $penindakans->data_barang == 'YA' ? '' : 'disabled' }}>
                                      </div>
                                      <div class="col-sm-4">
                                        <input type="date" class="form-control form-input" name="tgl_dokumen" value="{{ old('tgl_dokumen', $penindakans->tgl_dokumen) }}" {{ $penindakans->data_barang == 'YA' ? '' : 'disabled' }}>
                                      </div>
                                    </div>

                                    <div class="row mb-3 form-group">
                                      <label class="col-sm-4 col-form-label">Pemilik/Importir/Eksportir/Kuasa</label>
                                      <div class="col-sm-8">
                                        <input type="text" class="form-control form-input" name="pemilik" placeholder="Pemilik/Importir/Eksportir/Kuasa" value="{{ old('pemilik', $penindakans->pemilik) }}"
                                          {{ $penindakans->data_barang == 'YA' ? '' : 'disabled' }}>
                                      </div>
                                    </div>
                                    <div class="row mb-3 form-group">
                                      <label class="col-sm-4 col-form-label">No. Identitas Pemilik/Importir/Eksportir/Kuasa</label>
                                      <div class="col-sm-8">
                                        <input type="text" class="form-control form-input" name="no_identitas_pemilik" placeholder="No. Identitas Pemilik/Importir/Eksportir/Kuasa"
                                          value="{{ old('no_identitas_pemilik', $penindakans->no_identitas_pemilik) }}" {{ $penindakans->data_barang == 'YA' ? '' : 'disabled' }}>
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
                                        <select id="data_bangunan" name="data_bangunan" class="form-select" onchange="toggleForm(this.value, 'flush-collapseThree')">
                                          <option value="TIDAK" {{ old('data_bangunan', $penindakans->data_bangunan) == 'TIDAK' ? 'selected' : '' }}>TIDAK</option>
                                          <option value="YA" {{ old('data_bangunan', $penindakans->data_bangunan) == 'YA' ? 'selected' : '' }}>YA</option>
                                        </select>
                                      </div>
                                    </div>

                                    {{-- form input --}}
                                    <div class="row mb-3 form-group">
                                      <label class="col-sm-4 col-form-label">Alamat Bangunan/Tempat</label>
                                      <div class="col-sm-8">
                                        <textarea class="form-control form-input" placeholder="Alamat Bangunan/ Tempat" name="alamat_bangunan" rows="2" {{ $penindakans->data_bangunan == 'YA' ? '' : 'disabled' }}>{{ old('alamat_bangunan', $penindakans->alamat_bangunan) }}</textarea>
                                      </div>
                                    </div>

                                    <div class="row mb-3 form-group">
                                      <label class="col-sm-4 col-form-label">No Reg Bangunan | NPPBKC | DLL</label>
                                      <div class="col-sm-8">
                                        <input type="text" class="form-control form-input" placeholder="No Reg Bangunan | NPPBKC | DLL" name="no_bangunan" value="{{ old('no_bangunan', $penindakans->no_bangunan) }}"
                                          {{ $penindakans->data_bangunan == 'YA' ? '' : 'disabled' }}>
                                      </div>
                                    </div>

                                    <div class="row mb-3 form-group">
                                      <label class="col-sm-4 col-form-label">Nama Pemilik | Yang Menguasai</label>
                                      <div class="col-sm-8">
                                        <input type="text" class="form-control form-input" placeholder="Nama Pemilik | Yang Menguasai" name="nama_pemilik_bangunan" value="{{ old('nama_pemilik_bangunan', $penindakans->nama_pemilik_bangunan) }}"
                                          {{ $penindakans->data_bangunan == 'YA' ? '' : 'disabled' }}>
                                      </div>
                                    </div>

                                    <div class="row mb-3 form-group">
                                      <label class="col-sm-4 col-form-label">No. Identitas Pemilik | Yang Menguasai</label>
                                      <div class="col-sm-8">
                                        <input type="text" class="form-control form-input" placeholder="No. Identitas Pemilik | Yang Menguasai" name="no_identitas_pemilik_bangunan"
                                          value="{{ old('no_identitas_pemilik_bangunan', $penindakans->no_identitas_pemilik_bangunan) }}" {{ $penindakans->data_bangunan == 'YA' ? '' : 'disabled' }}>
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
                      </div>
                    </div>


                    <div class="tab-pane fade" id="ba-henti" role="tabpanel" aria-labelledby="ba-henti-tab">
                      <div class="accordion accordion-flush" id="accordionFlushExample">

                        <!-- B.A Dokumentasi -->
                        <div class="accordion-item border rounded">
                          <div class="d-flex justify-content-between align-items-center p-3 bg-light">
                            <span class="fw-bold">B.A henti</span>
                            <div class="form-check form-switch mb-0">
                              <input class="form-check-input status-toggle" type="checkbox" role="switch" id="flexSwitchCheck1055" data-id="flush-collapse1055" name="ba_henti" value="{{ old('ba_henti', $penindakans->ba_henti) }}"
                                {{ old('ba_henti', $penindakans->ba_henti) == 'YA' ? 'checked' : '' }} aria-expanded="false" aria-controls="flush-collapse1055">
                              <label class="form-check-label" for="flexSwitchCheck1055" id="switch-label-1055">
                                {{ old('ba_henti', $penindakans->ba_henti) == 'YA' ? 'YA' : 'TIDAK' }}
                              </label>

                            </div>
                          </div>
                          <hr class="my-0">
                        </div>


                      </div>
                    </div>


                    <div class="tab-pane" id="ba-riksa" role="tabpanel" aria-labelledby="ba-riksa-tab">
                      <div class="accordion accordion-flush" id="accordionFlushExample">

                        <!-- B.A Riksa -->
                        <div class="accordion-item border rounded">
                          <div class="d-flex justify-content-between align-items-center p-3 bg-light">
                            <span class="fw-bold">B.A Riksa</span>
                            <div class="form-check form-switch mb-0">
                              <input class="form-check-input status-toggle" type="checkbox" role="switch" id="flexSwitchCheck1" data-id="flush-collapse1" name="ba_riksa" value="{{ old('ba_riksa', $penindakans->ba_riksa) }}"
                                {{ old('ba_riksa', $penindakans->ba_riksa) == 'YA' ? 'checked' : '' }} aria-expanded="false" aria-controls="flush-collapse1">
                              <label class="form-check-label" for="flexSwitchCheck1" id="switch-label-1">
                                {{ old('ba_riksa', $penindakans->ba_riksa) == 'YA' ? 'YA' : 'TIDAK' }}
                              </label>
                            </div>
                          </div>
                          <hr class="my-0">
                          <div id="flush-collapse1" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
                            <div class="accordion-body bg-light">
                              <div class="row">
                                <!-- Left Column (Data Laporan Informasi) -->
                                <div class="col-lg-6">
                                  <h6><b>A. Data B.A Riksa</b></h6>
                                  <hr>
                                  <div class="row">
                                    <div class="row">
                                      <div class="col-md-6 mb-3">
                                        <label>No. B.A Riksa</label>
                                        <input type="text" class="form-control bg-primary text-white" value="{{ old('no_ba_riksa', $penindakans->no_ba_riksa) }}" placeholder="No. B.A Riksa" name="no_ba_riksa" readonly>
                                      </div>

                                      <div class="col-md-6 mb-3">
                                        <label>Tgl. B.A Riksa</label>
                                        <input type="date" class="form-control bg-primary text-white" name="tgl_ba_riksa" value="{{ old('tgl_ba_riksa', $penindakans->tgl_ba_riksa) }}">
                                      </div>
                                    </div>


                                    <h6><b>B. Data Pemeriksaan</b></h6>
                                    <hr>

                                    <div class="mb-3 form-group">
                                      <label>Lokasi Pemeriksaan</label>
                                      <div class="col-sm-12">
                                        <textarea class="form-control form-input" placeholder="Lokasi Pemeriksaan" name="lokasi_pemeriksaan" rows="3">{{ old('lokasi_pemeriksaan', $penindakans->lokasi_pemeriksaan) }}</textarea>
                                      </div>
                                    </div>

                                  </div>
                                </div>

                                <!-- Right Column (Pejabat Selection) -->
                                <div class="col-lg-6">
                                  <h6><b>C. Data Lainnya</b></h6>
                                  <hr>

                                  <div class="mb-3 form-group">
                                    <label>Rincian Hasil Pemeriksaan</label>
                                    <div class="col-sm-12">
                                      <textarea class="form-control form-input" placeholder="Rincian Hasil Pemeriksaan" name="rincian_hasil_pemeriksaan" rows="9">{{ old('rincian_hasil_pemeriksaan', $penindakans->rincian_hasil_pemeriksaan) }}</textarea>
                                    </div>
                                  </div>

                                </div>
                              </div>

                            </div>
                          </div>
                        </div>

                        <div class="accordion-item border rounded mt-2">
                          <div class="d-flex justify-content-between align-items-center p-3 bg-light">
                            <span class="fw-bold">B.A Riksa Badan</span>
                            <div class="form-check form-switch mb-0">
                              <input class="form-check-input status-toggle" type="checkbox" role="switch" id="flexSwitchCheck2" data-id="flush-collapse2" name="ba_riksa_badan" value="{{ old('ba_riksa_badan', $penindakans->ba_riksa_badan) }}"
                                {{ old('ba_riksa_badan', $penindakans->ba_riksa_badan) == 'YA' ? 'checked' : '' }} aria-expanded="false" aria-controls="flush-collapse2">
                              <label class="form-check-label" for="flexSwitchCheck2" id="switch-label-2">
                                {{ old('ba_riksa_badan', $penindakans->ba_riksa_badan) == 'YA' ? 'YA' : 'TIDAK' }}
                              </label>
                            </div>
                          </div>
                          <hr class="my-0">
                          <div id="flush-collapse2" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
                            <div class="accordion-body bg-light">
                              <div class="row">
                                <!-- Left Column (Data Laporan Informasi) -->
                                <div class="col-lg-6">
                                  <h6><b>A. Data B.A Riksa Badan</b></h6>
                                  <hr>
                                  <div class="row">
                                    <div class="col-md-6 mb-3">
                                      <label>No. B.A Riksa Badan</label>
                                      <input type="text" class="form-control bg-primary text-white" value="{{ old('no_ba_riksa_badan', $penindakans->no_ba_riksa_badan) }}" placeholder="No. B.A Riksa" name="no_ba_riksa_badan" readonly>
                                    </div>

                                    <div class="col-md-6 mb-3">
                                      <label>Tgl. B.A Riksa Badan</label>
                                      <input type="date" class="form-control bg-primary text-white" value="{{ old('tgl_ba_riksa_badan', $penindakans->tgl_ba_riksa_badan) }}" name="tgl_ba_riksa_badan">
                                    </div>
                                  </div>

                                  <div class="mb-3 form-group">
                                    <label>
                                      Lokasi pemeriksaan Badan
                                    </label>
                                    <div class="col-sm-12">
                                      <input type="text" class="form-control" placeholder="Lokasi pemeriksaan Badan" name="lokasi_pemeriksaan_badan" value="{{ old('lokasi_pemeriksaan_badan', $penindakans->lokasi_pemeriksaan_badan ?? '') }}">
                                    </div>
                                  </div>

                                  <div class="mb-3 form-group">
                                    <label>
                                      Uraian pakaian yang dibuka/pemeriksaan medis
                                    </label>
                                    <div class="col-sm-12">
                                      <textarea class="form-control form-input" placeholder="Uraian pakaian yang dibuka/pemeriksaan medis" name="rincian_pemeriksaan_badan" rows="3">{{ old('rincian_pemeriksaan_badan', $penindakans->rincian_pemeriksaan_badan ?? '') }}</textarea>
                                    </div>
                                  </div>
                                </div>




                                <!-- Right Column (Pejabat Selection) -->
                                <div class="col-lg-6">

                                  <div class="mb-3 form-group">
                                    <label>
                                      Hasil pemeriksaan kedapatan
                                    </label>
                                    <div class="col-sm-12">
                                      <textarea class="form-control form-input" placeholder="Hasil pemeriksaan kedapatan" name="hasil_pemeriksaan_badan" rows="13">{{ old('hasil_pemeriksaan_badan', $penindakans->hasil_pemeriksaan_badan ?? '') }}</textarea>
                                    </div>
                                  </div>

                                  {{-- <div class="row mb-3 form-group">
                                    <label class="col-sm-4 col-form-label">
                                      Nama Saksi
                                    </label>
                                    <div class="col-sm-8">
                                      <input type="text" class="form-control" placeholder="Nama Saksi" name="nama_saksi_ba_riksa_badan" value="{{ old('nama_saksi_ba_riksa_badan', $penindakans->nama_saksi_ba_riksa_badan ?? '') }}">
                                    </div>
                                  </div> --}}


                                </div>

                                <h6><b>B. Data Pemeriksaan Badan</b></h6>
                                <hr>

                                <div class="accordion accordion-flush" id="accordionFlushExample">
                                  <div class="accordion-item">
                                    <h2 class="accordion-header">
                                      <button class="accordion-button btn fw-medium collapsed border-0 hover:bg-gray-100 transition-all duration-200 rounded-top-3" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseopmn">
                                        Pemeriksaan Badan
                                      </button>
                                    </h2>
                                    <div id="flush-collapseopmn" class="accordion-collapse collapse">
                                      <div class="accordion-body bg-white border-start border-4 border-primary shadow-sm rounded-bottom-3">

                                        <div class="row mb-3 form-group">
                                          <label class="col-sm-4 col-form-label">
                                            Nama
                                          </label>
                                          <div class="col-sm-8">
                                            <textarea class="form-control form-input" placeholder="Diisi nama orang yang terhadapnya dilakukan pemeriksaan badan" name="nama" rows="3">{{ old('nama', $penindakans->nama) }}</textarea>
                                          </div>
                                        </div>

                                        <div class="row mb-3 form-group">
                                          <label class="col-sm-4 col-form-label">
                                            Tempat dan Tanggal Lahir
                                          </label>
                                          <div class="col-sm-8">
                                            <input type="text" class="form-control" placeholder="Tempat dan Tanggal Lahir" name="TTL" value="{{ old('TTL', $penindakans->TTL) }}">
                                          </div>
                                        </div>

                                        <div class="row mb-3 form-group">
                                          <label class="col-sm-4 col-form-label">
                                            Jenis Kelamin
                                          </label>
                                          <div class="col-sm-8">
                                            <select class="form-control form-select select2" name="jenis_kelamin">
                                              <option value="" selected disabled>- Pilih -</option>
                                              <option value="Laki-Laki" {{ old('jenis_kelamin', $penindakans->jenis_kelamin) == 'Laki-Laki' ? 'selected' : '' }}>Laki-Laki</option>
                                              <option value="Perempuan" {{ old('jenis_kelamin', $penindakans->jenis_kelamin) == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                                            </select>
                                          </div>
                                        </div>

                                        <div class="row mb-3 form-group">
                                          <label class="col-sm-4 col-form-label">
                                            Kewarganegaraan
                                          </label>
                                          <div class="col-sm-8">
                                            <input type="text" class="form-control" placeholder="Kewarganegaraan" name="kewarganegaraan" value="{{ old('kewarganegaraan', $penindakans->kewarganegaraan) }}">
                                          </div>
                                        </div>

                                        <div class="row mb-3 form-group">
                                          <label class="col-sm-4 col-form-label">
                                            Alamat Tempat Tinggal
                                          </label>
                                          <div class="col-sm-8">
                                            <textarea class="form-control form-input" placeholder="Alamat Tempat Tinggal" name="alamat_tempat_tinggal" rows="3">{{ old('alamat_tempat_tinggal', $penindakans->alamat_tempat_tinggal) }}</textarea>
                                          </div>
                                        </div>

                                        <div class="row mb-3 form-group">
                                          <label class="col-sm-4 col-form-label">
                                            Alamat KTP/Paspor
                                          </label>
                                          <div class="col-sm-8">
                                            <textarea class="form-control form-input" placeholder="Alamat KTP/Paspor" name="alamat_ktp" rows="3">{{ old('alamat_ktp', $penindakans->alamat_ktp) }}</textarea>
                                          </div>
                                        </div>

                                        <div class="row mb-3 form-group">
                                          <label class="col-sm-4 col-form-label">
                                            Nomor KTP/Paspor
                                          </label>
                                          <div class="col-sm-8">
                                            <input type="text" class="form-control" placeholder="Nomor KTP/Paspor" name="nomor_ktp" value="{{ old('nomor_ktp', $penindakans->nomor_ktp) }}">
                                          </div>
                                        </div>

                                        <div class="row mb-3 form-group">
                                          <label class="col-sm-4 col-form-label">
                                            Tempat/Pejabat yang Mengeluarkan KTP/Paspor
                                          </label>
                                          <div class="col-sm-8">
                                            <textarea class="form-control form-input" placeholder="Diisi nama tempat/pejabat yang mengeluarkan KTP/Paspor orang yang terhadapnya dilakukan pemeriksaan badan." name="tempat_pejabat" rows="3">{{ old('tempat_pejabat', $penindakans->tempat_pejabat) }}</textarea>
                                          </div>
                                        </div>

                                        <div class="row mb-3 form-group">
                                          <label class="col-sm-4 col-form-label">
                                            Datang Dari
                                          </label>
                                          <div class="col-sm-8">
                                            <input type="text" class="form-control" placeholder="Datang Dari" name="datang_dari" value="{{ old('datang_dari', $penindakans->datang_dari) }}">
                                          </div>
                                        </div>

                                        <div class="row mb-3 form-group">
                                          <label class="col-sm-4 col-form-label">
                                            Tempat tujuan
                                          </label>
                                          <div class="col-sm-8">
                                            <input type="text" class="form-control" placeholder="Tujuan" name="tempat_tujuan" value="{{ old('tempat_tujuan', $penindakans->tempat_tujuan) }}">
                                          </div>
                                        </div>

                                        <div class="row mb-3 form-group">
                                          <label class="col-sm-4 col-form-label">
                                            Nama/Identitas orang yang bepergian dengannya
                                          </label>
                                          <div class="col-sm-8">
                                            <textarea class="form-control form-input" placeholder="Diisi nama/identitas orang yang ikut bepergian dan memiliki relasi dengan orang yang terhadapnya dilakukan pemeriksaan badan." name="nama_orang_bersamanya" rows="3">{{ old('nama_orang_bersamanya', $penindakans->nama_orang_bersamanya) }}</textarea>
                                          </div>
                                        </div>

                                        <div class="row mb-3 form-group">
                                          <label class="col-sm-4 col-form-label">
                                            Jenis/Nomor dan Tgl Dokumen barang yang dibawa
                                          </label>
                                          <div class="col-sm-8">
                                            <textarea class="form-control form-input" placeholder="Diisi jenis/nomor dan tanggal dokumen yang dibawa orang yang terhadapnya dilakukan pemeriksaan badan" name="jenis_dokumen" rows="3">{{ old('jenis_dokumen', $penindakans->jenis_dokumen) }}</textarea>
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

                        <!-- SOC -->
                        <div class="accordion-item border rounded mt-2">
                          <div class="d-flex justify-content-between align-items-center p-3 bg-light">
                            <span class="fw-bold">SOC</span>
                            <div class="form-check form-switch mb-0">
                              <input class="form-check-input status-toggle" type="checkbox" role="switch" id="flexSwitchCheck3" data-id="flush-collapse3" name="soc" value="{{ old('soc', $penindakans->soc) }}"
                                {{ old('soc', $penindakans->soc) == 'YA' ? 'checked' : '' }} aria-expanded="false" aria-controls="flush-collapse3">
                              <label class="form-check-label" for="flexSwitchCheck3" id="switch-label-3">
                                {{ old('soc', $penindakans->soc) == 'YA' ? 'YA' : 'TIDAK' }}
                              </label>
                            </div>


                          </div>
                          <hr class="my-0">
                          <div id="flush-collapse3" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
                            <div class="accordion-body bg-light">
                              Isi dari soc
                            </div>
                          </div>
                        </div>

                        <!-- DOC -->
                        <div class="accordion-item border rounded mt-2">
                          <div class="d-flex justify-content-between align-items-center p-3 bg-light">
                            <span class="fw-bold">DOC</span>
                            <div class="form-check form-switch mb-0">
                              <input class="form-check-input status-toggle" type="checkbox" role="switch" id="flexSwitchCheck4" data-id="flush-collapse4" name="doc" value="{{ old('doc', $penindakans->doc) }}"
                                {{ old('doc', $penindakans->doc) == 'YA' ? 'checked' : '' }} aria-expanded="false" aria-controls="flush-collapse4">
                              <label class="form-check-label" for="flexSwitchCheck4" id="switch-label-4">
                                {{ old('doc', $penindakans->doc) == 'YA' ? 'YA' : 'TIDAK' }}
                              </label>
                            </div>
                          </div>

                          <hr class="my-0">
                          <div id="flush-collapse4" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
                            <div class="accordion-body bg-light">
                              Isi dari doc
                            </div>
                          </div>
                        </div>

                      </div>
                    </div>


                    <div class="tab-pane fade" id="ba-sarkut" role="tabpanel" aria-labelledby="ba-sarkut-tab">

                      <div class="accordion accordion-flush" id="accordionFlushExample">

                        <!-- B.A Riksa -->
                        <div class="accordion-item border rounded">
                          <div class="d-flex justify-content-between align-items-center p-3 bg-light">
                            <span class="fw-bold">B.A Sarkut</span>
                            <div class="form-check form-switch mb-0">
                              <input class="form-check-input status-toggle" type="checkbox" role="switch" id="flexSwitchCheck10" data-id="flush-collapse10" name="ba_sarkut" value="{{ old('ba_sarkut', $penindakans->ba_sarkut) }}"
                                {{ old('ba_sarkut', $penindakans->ba_sarkut) == 'YA' ? 'checked' : '' }} aria-expanded="false" aria-controls="flush-collapse10">
                              <label class="form-check-label" for="flexSwitchCheck10" id="switch-label-10">
                                {{ old('ba_sarkut', $penindakans->ba_sarkut) == 'YA' ? 'YA' : 'TIDAK' }}
                              </label>
                            </div>

                          </div>
                          <hr class="my-0">
                          <div id="flush-collapse10" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
                            <div class="accordion-body bg-light">
                              <div class="row">
                                <!-- Left Column (Data Laporan Informasi) -->
                                <div class="col-lg-6">
                                  <h6><b>A. Data B.A Sarkut</b></h6>
                                  <hr>
                                  <div class="row">
                                    <div class="col-md-6 mb-3">
                                      <label>No. B.A Sarkut</label>
                                      <input type="text" class="form-control bg-primary text-white" value="{{ old('no_ba_sarkut', $penindakans->no_ba_sarkut ?? '') }}" placeholder="No. B.A Sarkut" name="no_ba_sarkut" readonly>
                                    </div>

                                    <div class="col-md-6 mb-3">
                                      <label>Tgl. B.A Sarkut</label>
                                      <input type="date" class="form-control bg-primary text-white" name="tgl_ba_sarkut" value="{{ old('tgl_ba_sarkut', $penindakans->tgl_ba_sarkut ?? '') }}">
                                    </div>

                                    <h6><b>B. Data Pembawaan</b></h6>
                                    <hr>

                                    <div class="mb-3 form-group">
                                      <label>Dari</label>
                                      <div class="col-sm-12">
                                        <input type="text" class="form-control form-input" name="dibawa_dari" placeholder="Tempat sarkut mulai dibawa" value="{{ old('dibawa_dari', $penindakans->dibawa_dari ?? '') }}">
                                      </div>
                                    </div>

                                    <div class="mb-3 form-group">
                                      <label>Tujuan</label>
                                      <div class="col-sm-12">
                                        <input type="text" class="form-control form-input" name="tujuan" placeholder="Tempat tujuan sarkut" value="{{ old('tujuan', $penindakans->tujuan ?? '') }}">
                                      </div>
                                    </div>

                                    <div class="mb-3 form-group">
                                      <label>Alasan</label>
                                      <div class="col-sm-12">
                                        <textarea class="form-control form-input" placeholder="Diisi pertimbangan dan alasan sarana pengangkut/barang dibawa" name="alasan" rows="3">{{ old('alasan', $penindakans->alasan ?? '') }}</textarea>
                                      </div>
                                    </div>


                                  </div>
                                </div>

                                <!-- Right Column (Pejabat Selection) -->
                                <div class="col-lg-6">
                                  <h6><b>C. Data Lainnya</b></h6>
                                  <hr>

                                  <div class="mb-3 form-group">
                                    <label>Waktu Berangkat</label>
                                    <div class="col-sm-12">
                                      <input type="text" class="form-control" name="waktu_berangkat" id="datetime-datepicker" placeholder="Waktu Keberangkatan" value="{{ old('waktu_berangkat', $penindakans->waktu_berangkat ?? '') }}">
                                    </div>
                                  </div>

                                  <div class="mb-3 form-group">
                                    <label>Waktu Tiba</label>
                                    <div class="col-sm-12">
                                      <input type="text" class="form-control" name="waktu_tiba" id="datetime-datepicker" placeholder="Waktu Tiba" value="{{ old('waktu_tiba', $penindakans->waktu_tiba ?? '') }}">
                                    </div>
                                  </div>




                                </div>
                              </div>

                            </div>
                          </div>
                        </div>


                      </div>

                    </div>

                    <div class="tab-pane fade " id="ba-contoh" role="tabpanel" aria-labelledby="ba-contoh-tab">

                      <div class="accordion accordion-flush" id="accordionFlushExample">

                        <!-- B.A Riksa -->
                        <div class="accordion-item border rounded">
                          <div class="d-flex justify-content-between align-items-center p-3 bg-light">
                            <span class="fw-bold">B.A Contoh</span>
                            <div class="form-check form-switch mb-0">
                              <input class="form-check-input status-toggle" type="checkbox" role="switch" id="flexSwitchCheck101" data-id="flush-collapse101" name="ba_contoh" value="{{ old('ba_contoh', $penindakans->ba_contoh) }}"
                                {{ old('ba_contoh', $penindakans->ba_contoh ?? '') == 'YA' ? 'checked' : '' }} aria-expanded="false" aria-controls="flush-collapse101">
                              <label class="form-check-label" for="flexSwitchCheck101" id="switch-label-101">
                                {{ old('ba_contoh', $penindakans->ba_contoh ?? '') == 'YA' ? 'YA' : 'TIDAK' }}
                              </label>
                            </div>

                          </div>
                          <hr class="my-0">
                          <div id="flush-collapse101" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
                            <div class="accordion-body bg-light">
                              <!-- Left Column (Data Laporan Informasi) -->

                              <h6><b>A. Data B.A Contoh</b></h6>
                              <hr>
                              <div class="row">
                                <div class="col-md-6 mb-3">
                                  <label>No. B.A Contoh</label>
                                  <input type="text" class="form-control bg-primary text-white" value="{{ old('no_ba_contoh', $penindakans->no_ba_contoh) }}" placeholder="No. B.A Contoh" name="no_ba_contoh" readonly>
                                </div>

                                <div class="col-md-6 mb-3">
                                  <label>Tgl. B.A Contoh</label>
                                  <input type="date" class="form-control bg-primary text-white" value="{{ old('tgl_ba_contoh', $penindakans->tgl_ba_contoh) }}" name="tgl_ba_contoh">
                                </div>
                              </div>

                              <h6><b>B. Data Pengambilan Barang Contoh</b></h6>
                              <hr>

                              <div class="card-body">
                                <div class="accordion accordion-flush" id="accordionFlushExample">


                                  <div class="accordion-item">
                                    <h2 class="accordion-header">
                                      <button class="accordion-button btn fw-medium collapsed border-0 hover:bg-gray-100 transition-all duration-200 rounded-top-3" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapserrte">
                                        Barang
                                      </button>
                                    </h2>
                                    <div id="flush-collapserrte" class="accordion-collapse collapse">
                                      <div class="accordion-body bg-white border-start border-4 border-primary shadow-sm rounded-bottom-3">

                                        <div class="row mb-3 form-group">
                                          <label class="col-sm-4 col-form-label">Jumlah dan Jenis Barang</label>
                                          <div class="col-sm-8">
                                            <textarea class="form-control form-input" placeholder="Jumlah dan Jenis Barang Contoh" name="jumlah_jenis_barang_contoh" rows="3">{{ old('jumlah_jenis_barang_contoh', $penindakans->jumlah_jenis_barang_contoh) }}</textarea>
                                          </div>
                                        </div>

                                        <div class="row mb-3 form-group">
                                          <label class="col-sm-4 col-form-label">Lokasi</label>
                                          <div class="col-sm-8">
                                            <input type="text" class="form-control form-input" value="{{ old('lokasi_barcon', $penindakans->lokasi_barcon) }}" placeholder="Lokasi Pengambilan Barang Contoh" name="lokasi_barcon">
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


                      </div>

                    </div>

                    <div class="tab-pane fade " id="ba-dok" role="tabpanel" aria-labelledby="ba-dok-tab">
                      <div class="accordion accordion-flush" id="accordionFlushExample">

                        <!-- B.A Dokumentasi -->
                        <div class="accordion-item border rounded">
                          <div class="d-flex justify-content-between align-items-center p-3 bg-light">
                            <span class="fw-bold">B.A Dokumentasi</span>
                            <div class="form-check form-switch mb-0">
                              <input class="form-check-input status-toggle" type="checkbox" role="switch" id="flexSwitchCheck102n" data-id="flush-collapse102n" name="ba_dok" value="{{ old('ba_dok', $penindakans->ba_dok) }}"
                                {{ old('ba_dok', $penindakans->ba_dok ?? '') == 'YA' ? 'checked' : '' }} aria-expanded="false" aria-controls="flush-collapse102n">
                              <label class="form-check-label" for="flexSwitchCheck102n" id="switch-label-102n">
                                {{ old('ba_dok', $penindakans->ba_dok ?? '') == 'YA' ? 'YA' : 'TIDAK' }}
                              </label>
                            </div>

                          </div>
                          <hr class="my-0">
                          <div id="flush-collapse102n" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
                            <div class="accordion-body bg-light">

                              <h6><b>A. Data B.A Dokumentasi</b></h6>
                              <hr>
                              <div class="row">
                                <div class="col-md-6 mb-3">
                                  <label>No. B.A Dokumentasi</label>
                                  <input type="text" class="form-control bg-primary text-white" value="{{ old('no_ba_dok', $penindakans->no_ba_dok) }}" placeholder="No. B.A Dokumentasi" name="no_ba_dok" readonly>
                                </div>

                                <div class="col-md-6 mb-3">
                                  <label>Tgl. B.A Dokumentasi</label>
                                  <input type="date" class="form-control bg-primary text-white" name="tgl_ba_dok" value="{{ old('tgl_ba_dok', $penindakans->tgl_ba_dok) }}">
                                </div>
                              </div>

                              <div class="mb-3 form-group">
                                <label>Lokasi</label>
                                <div class="col-sm-12">
                                  <textarea class="form-control form-input" placeholder="Lokasi Dokumentasi Barang" name="lokasi_ba_dok" rows="3">{{ old('lokasi_ba_dok', $penindakans->lokasi_ba_dok) }}</textarea>
                                </div>
                              </div>

                            </div>
                          </div>
                        </div>
                      </div>
                    </div>

                    <div class="tab-pane fade" id="ba-tegah" role="tabpanel" aria-labelledby="ba-tegah-tab">
                      <div class="accordion accordion-flush" id="accordionFlushExample">

                        <!-- B.A Dokumentasi -->
                        <div class="accordion-item border rounded">
                          <div class="d-flex justify-content-between align-items-center p-3 bg-light">
                            <span class="fw-bold">B.A Tegah</span>
                            <div class="form-check form-switch mb-0">
                              <input class="form-check-input status-toggle" type="checkbox" role="switch" id="flexSwitchCheck1059" data-id="flush-collapse1059" name="ba_tegah" value="{{ old('ba_tegah', $penindakans->ba_tegah) }}"
                                {{ old('ba_tegah', $penindakans->ba_tegah ?? '') == 'YA' ? 'checked' : '' }} aria-expanded="false" aria-controls="flush-collapse1059">
                              <label class="form-check-label" for="flexSwitchCheck1059" id="switch-label-1059">
                                {{ old('ba_tegah', $penindakans->ba_tegah ?? '') == 'YA' ? 'YA' : 'TIDAK' }}
                              </label>
                            </div>

                          </div>
                          <hr class="my-0">
                          <div id="flush-collapse1059" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
                            <div class="accordion-body bg-light">

                              <h6><b>A. Data B.A Tegah</b></h6>
                              <hr>
                              <div class="row">
                                <div class="col-md-6 mb-3">
                                  <label>No. B.A Tegah</label>
                                  <input type="text" class="form-control bg-primary text-white" value="{{ old('no_ba_tegah', $penindakans->no_ba_tegah) }}" placeholder="No. B.A Tegah" name="no_ba_tegah" readonly>
                                </div>

                                <div class="col-md-6 mb-3">
                                  <label>Tgl. B.A Tegah</label>
                                  <input type="date" class="form-control bg-primary text-white" value="{{ old('tgl_ba_tegah', $penindakans->tgl_ba_tegah) }}" name="tgl_ba_tegah">
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>

                    <div class="tab-pane fade" id="ba-segel" role="tabpanel" aria-labelledby="ba-segel-tab">
                      <div class="accordion accordion-flush" id="accordionFlushExample">

                        <!-- B.A Dokumentasi -->
                        <div class="accordion-item border rounded">
                          <div class="d-flex justify-content-between align-items-center p-3 bg-light">
                            <span class="fw-bold">B.A Segel</span>
                            <div class="form-check form-switch mb-0">
                              <input class="form-check-input status-toggle" type="checkbox" role="switch" id="flexSwitchCheck1032" data-id="flush-collapse1032" name="ba_segel" value="{{ old('ba_segel', $penindakans->ba_segel) }}"
                                {{ old('ba_segel', $penindakans->ba_segel ?? '') == 'YA' ? 'checked' : '' }} aria-expanded="false" aria-controls="flush-collapse1032">
                              <label class="form-check-label" for="flexSwitchCheck1032" id="switch-label-1032">
                                {{ old('ba_segel', $penindakans->ba_segel ?? '') == 'YA' ? 'YA' : 'TIDAK' }}
                              </label>
                            </div>

                          </div>
                          <hr class="my-0">
                          <div id="flush-collapse1032" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
                            <div class="accordion-body bg-light">
                              <h6><b>A. Data B.A Segel</b></h6>
                              <hr>
                              <div class="row">
                                <div class="col-md-6 mb-3">
                                  <label>No. B.A Segel</label>
                                  <input type="text" class="form-control bg-primary text-white" value="{{ old('no_ba_segel', $penindakans->no_ba_segel) }}" placeholder="No. B.A Segel" name="no_ba_segel" readonly>
                                </div>

                                <div class="col-md-6 mb-3">
                                  <label>Tgl. B.A Segel</label>
                                  <input type="date" class="form-control bg-primary text-white" value="{{ old('tgl_ba_segel', $penindakans->tgl_ba_segel) }}" name="tgl_ba_segel">
                                </div>
                              </div>

                              <div class="col-lg-12 mb-3">
                                <label>Jenis Segel</label>
                                <select class="form-control form-select select2" name="jenis_segel_ba_segel">
                                  <option value="" selected disabled>- Pilih -</option>
                                  @foreach ($segels as $segel)
                                    <option value="{{ $segel->jenis_segel }}" {{ old('jenis_segel_ba_segel', $penindakans->jenis_segel_ba_segel) == $segel->jenis_segel ? 'selected' : '' }}>
                                      {{ $segel->jenis_segel }}
                                    </option>
                                  @endforeach
                                </select>
                              </div>

                              <div class="row">
                                <div class="col-md-6 mb-3">
                                  <label>Jumlah Segel</label>
                                  <input type="text" class="form-control" value="{{ old('jumlah_segel_ba_segel', $penindakans->jumlah_segel_ba_segel) }}" placeholder="Jumlah Segel" name="jumlah_segel_ba_segel">
                                </div>

                                <div class="col-md-6 mb-3">
                                  <label>Nomor Segel</label>
                                  <input type="text" class="form-control" value="{{ old('nomor_segel_ba_segel', $penindakans->nomor_segel_ba_segel) }}" placeholder="Nomor Segel" name="nomor_segel_ba_segel">
                                </div>
                              </div>

                              <div class="col-md-12 mb-3">
                                <label>Peletakan Segel</label>
                                <textarea class="form-control form-input" placeholder="Peletakan Segel" name="peletakan_segel_ba_segel" rows="3">{{ old('peletakan_segel_ba_segel', $penindakans->peletakan_segel_ba_segel) }}</textarea>
                              </div>
                            </div>
                          </div>
                        </div>


                      </div>
                    </div>


                    <div class="tab-pane fade" id="ba-titip" role="tabpanel" aria-labelledby="ba-titip-tab">
                      <div class="accordion accordion-flush" id="accordionFlushExample">

                        <!-- B.A Dokumentasi -->
                        <div class="accordion-item border rounded">
                          <div class="d-flex justify-content-between align-items-center p-3 bg-light">
                            <span class="fw-bold">B.A Titip</span>
                            <div class="form-check form-switch mb-0">
                              <input class="form-check-input status-toggle" type="checkbox" role="switch" id="flexSwitchCheck1011" data-id="flush-collapse1011" name="ba_titip" value="{{ old('ba_titip', $penindakans->ba_titip) }}"
                                {{ old('ba_titip', $penindakans->ba_titip ?? '') == 'YA' ? 'checked' : '' }} aria-expanded="false" aria-controls="flush-collapse1011">
                              <label class="form-check-label" for="flexSwitchCheck1011" id="switch-label-1011">
                                {{ old('ba_titip', $penindakans->ba_titip ?? '') == 'YA' ? 'YA' : 'TIDAK' }}
                              </label>
                            </div>

                          </div>
                          <hr class="my-0">
                          <div id="flush-collapse1011" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
                            <div class="accordion-body bg-light">

                              <h6><b>A. Data B.A Titip</b></h6>
                              <hr>
                              <div class="row">
                                <div class="col-md-6 mb-3">
                                  <label>No. B.A Titip</label>
                                  <input type="text" class="form-control bg-primary text-white" value="{{ old('no_ba_titip', $penindakans->no_ba_titip) }}" placeholder="No. B.A Titip" name="no_ba_titip" readonly>
                                </div>

                                <div class="col-md-6 mb-3">
                                  <label>Tgl. B.A Titip</label>
                                  <input type="date" class="form-control bg-primary text-white" name="tgl_ba_titip" value="{{ old('tgl_ba_titip', $penindakans->tgl_ba_titip) }}">
                                </div>
                              </div>

                              <h6><b>B. Data Penitipan</b></h6>
                              <hr>

                              <div class="card-body">
                                <div class="accordion accordion-flush" id="accordionFlushExample">
                                  <div class="accordion-item">
                                    <h2 class="accordion-header">
                                      <button class="accordion-button btn fw-medium collapsed border-0 hover:bg-gray-100 transition-all duration-200 rounded-top-3" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapserrtez">
                                        Penitipan
                                      </button>
                                    </h2>
                                    <div id="flush-collapserrtez" class="accordion-collapse collapse">
                                      <div class="accordion-body bg-white border-start border-4 border-primary shadow-sm rounded-bottom-3">

                                        <div class="row mb-3 form-group">
                                          <label class="col-sm-4 col-form-label">Lokasi Penitipan</label>
                                          <div class="col-sm-8">
                                            <textarea class="form-control form-input" placeholder="Lokasi Penitipan" name="lokasi_penitipan_ba_titip" rows="3">{{ old('lokasi_penitipan_ba_titip', $penindakans->lokasi_penitipan_ba_titip) }}</textarea>
                                          </div>
                                        </div>

                                        <div class="row mb-3 form-group">
                                          <label class="col-sm-4 col-form-label">Nama Yang Dititipkan</label>
                                          <div class="col-sm-8">
                                            <input type="text" class="form-control form-input" placeholder="Nama Yang Dititipkan" name="nama_ba_titip" value="{{ old('nama_ba_titip', $penindakans->nama_ba_titip) }}">
                                          </div>
                                        </div>

                                        <div class="row mb-3 form-group">
                                          <label class="col-sm-4 col-form-label">Alamat yang dtitipkan</label>
                                          <div class="col-sm-8">
                                            <textarea class="form-control form-input" placeholder="Alamat yang dtitipkan" name="alamat_ba_titip" rows="3">{{ old('alamat_ba_titip', $penindakans->alamat_ba_titip) }}</textarea>
                                          </div>
                                        </div>

                                        <div class="row mb-3 form-group">
                                          <label class="col-sm-4 col-form-label">Jabatan yang dtitipkan</label>
                                          <div class="col-sm-8">
                                            <input type="text" class="form-control form-input" placeholder="Jabatan yang dtitipkan" name="jabatan_ba_titip" value="{{ old('jabatan_ba_titip', $penindakans->jabatan_ba_titip) }}">
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
                      </div>


                    </div>


                    <div class="tab-pane fade" id="bpc" role="tabpanel" aria-labelledby="bpc-tab">
                      <div class="accordion accordion-flush" id="accordionFlushExample">

                        <!-- B.A Dokumentasi -->
                        <div class="accordion-item border rounded">
                          <div class="d-flex justify-content-between align-items-center p-3 bg-light">
                            <span class="fw-bold">Blokir Pita Cukai</span>
                            <div class="form-check form-switch mb-0">
                              <input class="form-check-input status-toggle" type="checkbox" role="switch" id="flexSwitchCheck1022" data-id="flush-collapse1022" name="bpc" value="{{ old('bpc', $penindakans->bpc) }}"
                                aria-expanded="false" aria-controls="flush-collapse1022" {{ old('bpc', $penindakans->bpc) == 'TIDAK' ? '' : 'checked' }}>
                              <label class="form-check-label" for="flexSwitchCheck1022" id="switch-label-1022">
                                {{ old('bpc', $penindakans->bpc) == 'TIDAK' ? 'TIDAK' : 'YA' }}
                              </label>
                            </div>

                          </div>
                          <hr class="my-0">
                        </div>

                      </div>
                    </div>

                    <div class="tab-pane fade" id="tolak1" role="tabpanel" aria-labelledby="tolak1">
                      <div class="accordion accordion-flush" id="accordionFlushExample">

                        <!-- B.A Dokumentasi -->
                        <div class="accordion-item border rounded">
                          <div class="d-flex justify-content-between align-items-center p-3 bg-light">
                            <span class="fw-bold">B.A Tolak Pertama</span>
                            <div class="form-check form-switch mb-0">
                              <input class="form-check-input status-toggle" type="checkbox" role="switch" id="flexSwitchCheck10114" data-id="flush-collapse10114" name="ba_tolak_1"
                                value="{{ old('ba_tolak_1', $penindakans->ba_tolak_1) }}" {{ old('ba_tolak_1', $penindakans->ba_tolak_1 ?? '') == 'YA' ? 'checked' : '' }} aria-expanded="false" aria-controls="flush-collapse10114">
                              <label class="form-check-label" for="flexSwitchCheck10114" id="switch-label-10114">
                                {{ old('ba_tolak_1', $penindakans->ba_tolak_1 ?? '') == 'YA' ? 'YA' : 'TIDAK' }}
                              </label>
                            </div>

                          </div>
                          <hr class="my-0">
                          <div id="flush-collapse10114" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
                            <div class="accordion-body bg-light">
                              <div class="row">
                                <!-- Left Column (Data Laporan Informasi) -->
                                <div class="col-lg-6">
                                  <h6><b>A. Data B.A Tolak Pertama</b></h6>
                                  <hr>
                                  <div class="row">
                                    <div class="col-md-6 mb-3">
                                      <label>No. B.A Tolak 1</label>
                                      <input type="text" class="form-control bg-primary text-white" value="{{ old('no_ba_tolak_1', $penindakans->no_ba_tolak_1) }}" placeholder="No. B.A Tolak Pertama" name="no_ba_tolak_1" readonly>
                                    </div>

                                    <div class="col-md-6 mb-3">
                                      <label>Tgl. B.A Tolak 1</label>
                                      <input type="date" class="form-control bg-primary text-white" name="tgl_ba_tolak_1" value="{{ old('tgl_ba_tolak_1', $penindakans->tgl_ba_tolak_1) }}">
                                    </div>


                                    <div class="col-md-12 mb-3">
                                      <label>Nama Orang Yang Menolak</label>
                                      <input type="text" class="form-control form-input" placeholder="Nama Orang Yang Menolak" name="nama_ba_tolak1" value="{{ old('nama_ba_tolak1', $penindakans->nama_ba_tolak1) }}">
                                    </div>

                                    <div class="col-md-12 mb-3">
                                      <label>Tempat Tanggal Lahir</label>
                                      <input type="text" class="form-control form-input" placeholder="Tempat Tanggal Lahir" name="ttl_ba_tolak1" value="{{ old('ttl_ba_tolak1', $penindakans->ttl_ba_tolak1) }}">
                                    </div>

                                    <div class="col-md-12 mb-3">
                                      <label>Jenis Kelamin</label>
                                      <select class="form-control form-select select2" name="jk_ba_tolak1">
                                        <option value="" selected disabled>- Pilih -</option>
                                        <option value="Laki-laki" {{ old('jk_ba_tolak1', $penindakans->jk_ba_tolak1) == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                                        <option value="Perempuan" {{ old('jk_ba_tolak1', $penindakans->jk_ba_tolak1) == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                                      </select>
                                    </div>



                                    <div class="col-md-12 mb-3">
                                      <label>Alamat</label>
                                      <textarea class="form-control form-input" placeholder="Alamat" name="alamat_ba_tolak1" rows="3">{{ old('alamat_ba_tolak1', $penindakans->alamat_ba_tolak1) }}</textarea>
                                    </div>


                                    <div class="col-md-12 mb-3">
                                      <label>Kewarganegaraan</label>
                                      <select class="form-control form-select select2" name="kewarganegaraan_ba_tolak1">
                                        <option value="" disabled {{ old('kewarganegaraan_ba_tolak1', $penindakans->kewarganegaraan_ba_tolak1) === null ? 'selected' : '' }}>
                                          Pilih Kewarganegaraan
                                        </option>
                                        @foreach ($nama_negara as $benua => $negara)
                                          <optgroup label="{{ $benua }}">
                                            @foreach ($negara as $item)
                                              <option value="{{ $item->UrEdi }}" {{ old('kewarganegaraan_ba_tolak1', $penindakans->kewarganegaraan_ba_tolak1) === $item->UrEdi ? 'selected' : '' }}>
                                                {{ $item->UrEdi }}
                                              </option>
                                            @endforeach
                                          </optgroup>
                                        @endforeach
                                      </select>
                                    </div>


                                    <div class="col-md-12 mb-3">
                                      <label>Pekerjaan</label>
                                      <input type="text" class="form-control form-input" placeholder="Pekerjaan" name="pekerjaan_ba_tolak1" value="{{ old('pekerjaan_ba_tolak1', $penindakans->pekerjaan_ba_tolak1) }}">
                                    </div>


                                  </div>
                                </div>


                                <!-- Right Column (Pejabat Selection) -->
                                <div class="col-lg-6">



                                  <div class="row mb-3 form-group">
                                    <label class="col-sm-3 col-form-label">Alasan Tolak Pertama</label>
                                    <div class="col-sm-9">
                                      <textarea class="form-control form-input" placeholder="Alasan Tolak Pertama" name="alasan_tolak_1" rows="5">{{ old('alasan_tolak_1', $penindakans->alasan_tolak_1) }}</textarea>
                                    </div>
                                  </div>

                                </div>

                              </div>

                            </div>
                          </div>
                        </div>


                      </div>
                    </div>


                    <div class="tab-pane fade" id="tolak2" role="tabpanel" aria-labelledby="tolak2">
                      <div class="accordion accordion-flush" id="accordionFlushExample">

                        <!-- B.A Dokumentasi -->
                        <div class="accordion-item border rounded">
                          <div class="d-flex justify-content-between align-items-center p-3 bg-light">
                            <span class="fw-bold">B.A Tolak Kedua</span>
                            <div class="form-check form-switch mb-0">
                              <input class="form-check-input status-toggle" type="checkbox" role="switch" id="flexSwitchCheck101145" data-id="flush-collapse101145" name="ba_tolak_2"
                                value="{{ old('ba_tolak_2', $penindakans->ba_tolak_2) }}" {{ old('ba_tolak_2', $penindakans->ba_tolak_2 ?? '') == 'YA' ? 'checked' : '' }} aria-expanded="false" aria-controls="flush-collapse101145">
                              <label class="form-check-label" for="flexSwitchCheck101145" id="switch-label-101145">
                                {{ old('ba_tolak_2', $penindakans->ba_tolak_2 ?? '') == 'YA' ? 'YA' : 'TIDAK' }}
                              </label>
                            </div>

                          </div>
                          <hr class="my-0">
                          <div id="flush-collapse101145" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
                            <div class="accordion-body bg-light">
                              <div class="row">
                                <!-- Left Column (Data Laporan Informasi) -->
                                <div class="col-lg-6">
                                  <h6><b>A. Data B.A Tolak Kedua</b></h6>
                                  <hr>
                                  <div class="row">
                                    <div class="col-md-6 mb-3">
                                      <label>No. B.A Tolak 2</label>
                                      <input type="text" class="form-control bg-primary text-white" value="{{ old('no_ba_tolak_2', $penindakans->no_ba_tolak_2) }}" placeholder="No. B.A Tolak Kedua" name="no_ba_tolak_2" readonly>
                                    </div>

                                    <div class="col-md-6 mb-3">
                                      <label>Tgl. B.A Tolak 2</label>
                                      <input type="date" class="form-control bg-primary text-white" name="tgl_ba_tolak_2" value="{{ old('tgl_ba_tolak_2', $penindakans->tgl_ba_tolak_2) }}">
                                    </div>


                                    <div class="col-md-12 mb-3">
                                      <label>Nama Saksi</label>
                                      <input type="text" class="form-control form-input" placeholder="Saksi yang menyaksikan penolakan tanda tangan" name="saksi_ba_tolak2"
                                        value="{{ old('saksi_ba_tolak2', $penindakans->saksi_ba_tolak2) }}">
                                    </div>


                                  </div>
                                </div>


                                <!-- Right Column (Pejabat Selection) -->
                                <div class="col-lg-6">



                                  <div class="row mb-3 form-group">
                                    <label class="col-sm-3 col-form-label">Alasan Tolak Kedua</label>
                                    <div class="col-sm-9">
                                      <textarea class="form-control form-input" placeholder="Alasan Tolak Kedua" name="alasan_tolak_2" rows="5">{{ old('alasan_tolak_2', $penindakans->alasan_tolak_2) }}</textarea>
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
    document.addEventListener('DOMContentLoaded', function() {
      const switches = document.querySelectorAll('.status-toggle');

      switches.forEach((switchElement) => {
        const label = switchElement.nextElementSibling;
        const targetAccordion = document.getElementById(switchElement.dataset.id);

        const isChecked = switchElement.value === 'YA';
        switchElement.checked = isChecked;
        label.textContent = isChecked ? 'YA' : 'TIDAK';

        if (targetAccordion) {
          if (isChecked) {
            targetAccordion.classList.add('show');
          } else {
            targetAccordion.classList.remove('show');
          }
        }

        switchElement.addEventListener('change', function() {
          const isNowChecked = this.checked;
          this.value = isNowChecked ? 'YA' : 'TIDAK';
          label.textContent = isNowChecked ? 'YA' : 'TIDAK';

          if (targetAccordion) {
            if (isNowChecked) {
              targetAccordion.classList.add('show');
            } else {
              targetAccordion.classList.remove('show');
            }
          } else {
            console.warn(`Accordion dengan ID "${switchElement.dataset.id}" tidak ditemukan.`);
          }
        });
      });
    });
  </script>




  <script>
    document.addEventListener('DOMContentLoaded', function() {
      $('#alasan_penindakan').select2();

      const existingJenisPelanggaran = document.querySelector('#alasan_penindakan option:checked')?.getAttribute('data-jenis');
      if (existingJenisPelanggaran) {
        document.getElementById("jenis_pelanggaran").value = existingJenisPelanggaran;
      }

      $('#alasan_penindakan').on('select2:select', function(e) {
        const selectedOption = e.params.data.element;
        const jenisPelanggaran = selectedOption.getAttribute("data-jenis");

        console.log("Jenis Pelanggaran Terpilih:", jenisPelanggaran);

        document.getElementById("jenis_pelanggaran").value = jenisPelanggaran || "Jenis pelanggaran tidak tersedia";
      });
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
