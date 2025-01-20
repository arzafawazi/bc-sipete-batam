@extends('layouts.vertical', ['title' => 'Rekam Form Penindakan'])

@section('css')
  @vite(['node_modules/datatables.net-bs5/css/dataTables.bootstrap5.min.css', 'node_modules/datatables.net-buttons-bs5/css/buttons.bootstrap5.min.css', 'node_modules/datatables.net-keytable-bs5/css/keyTable.bootstrap5.min.css', 'node_modules/datatables.net-responsive-bs5/css/responsive.bootstrap5.min.css', 'node_modules/datatables.net-select-bs5/css/select.bootstrap5.min.css'])
@endsection


@section('content')
  <div class="container-fluid">
    <div class="card mb-3 mt-4">
      <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="card-title mb-0">
          <i data-feather="book" style="width: 20px; height: 20px;" class="me-1"></i>
          Form Penindakan
        </h5>
        <button type="button" class="btn btn-danger btn-sm" onclick="window.history.back()">
          <i data-feather="log-out"></i> Kembali
        </button>
      </div>

      <div class="card-body">
        <form action="{{ route('penindakan.store') }}" method="POST">
          @csrf

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
                              <input type="hidden" id="id_penindakan" name="id_penindakan" value="">
                              <input type="hidden" name="id_pra_penindakan_ref" value="{{ $laporan->id_pra_penindakan }}">
                              <div class="col-md-12 mb-3">
                                <label>Opsi Penindakan</label>
                                <input type="text" class="form-control bg-primary text-white" name="opsi_penindakan" value="{{ $kategori }}" readonly>
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

                              <h6><b>B. Data Petugas</b></h6>
                              <hr>

                              <div class="col-md-6 mb-3">
                                <label>Pejabat 1 Penindakan</label>
                                <select class="form-select select2" name="id_petugas_1_sbp" id="id_petugas_1_sbp" readonly>
                                  @foreach ($users as $user)
                                    <option value="{{ $user->id_admin }}" {{ old('id_petugas_1_sbp', $loggedInUserId) == $user->id_admin ? 'selected' : '' }} {{ $loggedInUserId != $user->id_admin ? 'disabled' : '' }}>
                                      {{ $user->name }}
                                    </option>
                                  @endforeach
                                </select>
                              </div>

                              <div class="col-md-6 mb-3">
                                <label>Pejabat 2 Penindakan</label>
                                <select class="form-select select2" name="id_petugas_2_sbp">
                                  <option value="" disabled selected>- Pilih -</option>
                                  @foreach ($users as $user)
                                    <option value="{{ $user->id_admin }}">{{ $user->name }}</option>
                                  @endforeach
                                </select>
                              </div>

                              <div class="col-md-6 mb-3">
                                <label>Pejabat 3 Penindakan</label>
                                <select class="form-select select2" name="id_petugas_3_sbp">
                                  <option value="" disabled selected>- Pilih -</option>
                                  @foreach ($users as $user)
                                    <option value="{{ $user->id_admin }}">{{ $user->name }}</option>
                                  @endforeach
                                </select>
                              </div>

                              <div class="col-md-6 mb-3">
                                <label>Pejabat 4 Penindakan</label>
                                <select class="form-select select2" name="id_petugas_4_sbp">
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
                                <input type="text" class="form-control" id="nama_saksi" placeholder="Nama Saksi" name="nama_saksi">
                              </div>

                              <div class="col-md-6 mb-3">
                                <label>Pekerjaan Saksi</label>
                                <input type="text" class="form-control" placeholder="Pekerjaan Saksi" name="pekerjaan_saksi">
                              </div>
                              <div class="col-md-6 mb-3">
                                <label>Kontak Saksi (NO.HP)</label>
                                <input type="text" class="form-control" placeholder="Kontak Saksi (NO.HP)" name="kontak_saksi">
                              </div>
                              <div class="col-md-6 mb-3">
                                <label>No. Identitas Saksi</label>
                                <input type="text" class="form-control" id="no_identitas_saksi" placeholder="No. Identitas Saksi" name="no_identitas_saksi">
                              </div>
                              <div class="col-md-12 mb-3">
                                <label>Jenis Identitas Saksi</label>
                                <input type="text" class="form-control" placeholder="KTP/SIM/DLL" name="jenis_iden_saksi">
                              </div>
                              <div class="col-md-12 mb-3">
                                <label>Alamat Saksi</label>
                                <input type="text" class="form-control" placeholder="Alamat Saksi" name="alamat_saksi">
                              </div>
                              <div class="col-md-6 mb-3">
                                <label>Jenis Kelamin</label>
                                <select class="form-control" name="jk_saksi">
                                  <option value="" selected disabled>Pilih Jenis Kelamin</option>
                                  <option value="Laki-laki">Laki-laki</option>
                                  <option value="Perempuan">Perempuan</option>
                                </select>
                              </div>
                              <div class="col-md-6 mb-3">
                                <label>Tempat Tanggal Lahir</label>
                                <input type="text" class="form-control" placeholder="Tempat Tanggal Lahir" name="ttl_saksi">
                              </div>
                              <div class="mb-3 form-group">
                                <label>Kewarganegaraan</label>
                                <div class="col-sm-12">
                                  <select class="form-control form-input select2" name="kewarganegaraan_saksi">
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
                              </div>
                              <div class="col-md-6 mb-3">
                                <label>Umur</label>
                                <input type="number" class="form-control" placeholder="Umur" name="umur_saksi">
                              </div>
                              <div class="col-md-6 mb-3">
                                <label>NPWP</label>
                                <input type="text" class="form-control" placeholder="NPWP" name="npwp_saksi">
                              </div>
                              <div class="col-md-12 mb-3">
                                <label>Nomor Rekening</label>
                                <input type="text" class="form-control" placeholder="Nomor Rekening" name="norek_saksi">
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
                                <input type="text" class="form-control" name="lokasi_penindakan" placeholder="Lokasi Penindakan">
                              </div>
                              <div class="col-md-12 mb-3">
                                <label>Uraian Penindakan</label>
                                <textarea class="form-control" placeholder="Uraian Penindakan" name="uraian_penindakan" rows="8"></textarea>
                              </div>

                              <div class="col-md-12 mb-3">
                                <label>Alasan Penindakan</label>
                                <select class="form-control  select2" name="alasan_penindakan" id="alasan_penindakan">
                                  <option value="" disabled selected>Pilih Alasan Penindakan</option>
                                  @foreach ($jenisPelanggaran->unique('alasan_penindakan') as $jenis)
                                    <option value="{{ $jenis->alasan_penindakan }} ({{ $jenis->jenis_pelanggaran }})" data-jenis="{{ $jenis->jenis_pelanggaran }}">
                                      {{ $jenis->alasan_penindakan }}
                                    </option>
                                  @endforeach
                                </select>
                              </div>

                              <div class="col-md-12 mb-3">
                                <label>Jenis Pelanggaran</label>
                                <textarea class="form-control form-input bg-primary text-white" rows="8" id="jenis_pelanggaran" disabled></textarea>
                              </div>


                              <div class="col-md-12 mb-3">
                                <label>Tanggal Mulai & Waktu Mulai</label>
                                <input type="text" class="form-control" name="tgl_mulai" id="datetime-datepicker" placeholder="Tanggal Mulai & Waktu Mulai">
                              </div>

                              <div class="col-md-12 mb-3">
                                <label>Tanggal Selesai & Waktu Selesai</label>
                                <input type="text" class="form-control" name="tgl_selesai" id="datetime-datepicker" placeholder="Tanggal Selesai & Waktu Selesai">
                              </div>

                              <div class="col-md-12 mb-3">
                                <label>Hal Yang Terjadi</label>
                                <textarea class="form-control" placeholder="Hal Yang Terjadi" name="hal_yang_terjadi" rows="11"></textarea>
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
                                        <input type="text" class="form-control form-input" name="pengemudi" id="pengemudi" placeholder="Nahkoda/ Pilot/ Pengemudi" disabled>
                                      </div>
                                    </div>
                                    <div class="row mb-3 form-group">
                                      <label class="col-sm-4 col-form-label">No. Identitas Nahkoda/ Pilot/ Pengemudi</label>
                                      <div class="col-sm-8">
                                        <input type="text" class="form-control form-input" name="no_identitas_pengemudi" id="no_identitas_pengemudi" placeholder="No. Identitas Nahkoda/ Pilot/ Pengemudi" disabled>
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
                                        <textarea class="form-control form-input" placeholder="Jumlah/Jenis/Ukuran/Nomor" name="jumlah_jenis_ukuran_no" rows="3" disabled></textarea>
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
                                      <label class="col-sm-4 col-form-label">Uraian Barang</label>
                                      <div class="col-sm-8">
                                        <textarea class="form-control form-input" placeholder="Uraian Barang" name="jenis_barang" rows="2" disabled></textarea>
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
                      </div>
                    </div>


                    <div class="tab-pane fade" id="ba-henti" role="tabpanel" aria-labelledby="ba-henti-tab">
                      <div class="accordion accordion-flush" id="accordionFlushExample">

                        <!-- B.A Dokumentasi -->
                        <div class="accordion-item border rounded">
                          <div class="d-flex justify-content-between align-items-center p-3 bg-light">
                            <span class="fw-bold">B.A henti</span>
                            <div class="form-check form-switch mb-0">
                              <input class="form-check-input status-toggle" type="checkbox" role="switch" id="flexSwitchCheck1055" data-id="flush-collapse1055" name="ba_henti" value="TIDAK" aria-expanded="false"
                                aria-controls="flush-collapse1055">
                              <label class="form-check-label" for="flexSwitchCheck1055" id="switch-label-1055">TIDAK</label>
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
                              <input class="form-check-input status-toggle" type="checkbox" role="switch" id="flexSwitchCheck1" data-id="flush-collapse1" name="ba_riksa" value="TIDAK" aria-expanded="false" aria-controls="flush-collapse1">
                              <label class="form-check-label" for="flexSwitchCheck1" id="switch-label-1">TIDAK</label>
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
                                    <div class="col-md-6 mb-3">
                                      <label>No. B.A Riksa</label>
                                      <input type="text" class="form-control bg-primary text-white" value="{{ old('no_ba_riksa', $no_ref->no_ba_riksa) }}" placeholder="No. B.A Riksa" name="no_ba_riksa" readonly>
                                    </div>

                                    <div class="col-md-6 mb-3">
                                      <label>Tgl. B.A Riksa</label>
                                      <input type="date" class="form-control bg-primary text-white" name="tgl_ba_riksa">
                                    </div>

                                    <h6><b>B. Data Pemeriksaan</b></h6>
                                    <hr>

                                    <div class=" mb-3 form-group">
                                      <label>Lokasi Pemeriksaan</label>
                                      <div class="col-sm-12">
                                        <textarea class="form-control form-input" placeholder="Lokasi Pemeriksaan" name="lokasi_pemeriksaan" rows="3"></textarea>
                                      </div>
                                    </div>


                                  </div>
                                </div>

                                <!-- Right Column (Pejabat Selection) -->
                                <div class="col-lg-6">
                                  <h6><b>C. Data lainnya</b></h6>
                                  <hr>

                                  <div class="mb-3 form-group">
                                    <label>Rincian Hasil Pemeriksaan</label>
                                    <div class="col-sm-12">
                                      <textarea class="form-control form-input" placeholder="Rincian Hasil Pemeriksaan" name="rincian_hasil_pemeriksaan" rows="9"></textarea>
                                    </div>
                                  </div>


                                </div>
                              </div>
                            </div>
                          </div>
                        </div>

                        <!-- B.A Riksa Badan -->
                        <div class="accordion-item border rounded mt-2">
                          <div class="d-flex justify-content-between align-items-center p-3 bg-light">
                            <span class="fw-bold">B.A Riksa Badan</span>
                            <div class="form-check form-switch mb-0">
                              <input class="form-check-input status-toggle" type="checkbox" role="switch" id="flexSwitchCheck2" data-id="flush-collapse2" name="ba_riksa_badan" value="TIDAK" aria-expanded="false"
                                aria-controls="flush-collapse2">
                              <label class="form-check-label" for="flexSwitchCheck2" id="switch-label-2">TIDAK</label>
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
                                      <input type="text" class="form-control bg-primary text-white" value="{{ old('no_ba_riksa_badan', $no_ref->no_ba_riksa_badan) }}" placeholder="No. B.A Riksa" name="no_ba_riksa" readonly>
                                    </div>

                                    <div class="col-md-6 mb-3">
                                      <label>Tgl. B.A Riksa Badan</label>
                                      <input type="date" class="form-control bg-primary text-white" name="tgl_ba_riksa_badan">
                                    </div>

                                    <div class="mb-3 form-group">
                                      <label>
                                        Lokasi pemeriksaan Badan
                                      </label>
                                      <div class="col-sm-12">
                                        <input type="text" class="form-control" placeholder="Lokasi pemeriksaan Badan" name="lokasi_pemeriksaan_badan">
                                      </div>
                                    </div>


                                    <div class="mb-3 form-group">
                                      <label>
                                        Uraian pakaian yang dibuka/pemeriksaan medis
                                      </label>
                                      <div class="col-sm-12">
                                        <textarea class="form-control form-input" placeholder="Uraian pakaian yang dibuka/pemeriksaan medis" name="rincian_pemeriksaan_badan" rows="3"></textarea>
                                      </div>
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
                                      <textarea class="form-control form-input" placeholder="Hasil pemeriksaan kedapatan" name="hasil_pemeriksaan_badan" rows="13"></textarea>
                                    </div>
                                  </div>

                                  {{-- <div class="row mb-3 form-group">
                                    <label class="col-sm-4 col-form-label">
                                      Nama Saksi
                                    </label>
                                    <div class="col-sm-8">
                                      <input type="text" class="form-control" placeholder="Nama Saksi" name="nama_saksi_ba_riksa_badan">
                                    </div>
                                  </div> --}}



                                </div>


                                <h6><b>B. Data Pemeriksaan Badan</b></h6>
                                <hr>

                                <div class="card-body">
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
                                              <textarea class="form-control form-input" placeholder="Diisi nama orang yang terhadapnya dilakukan pemeriksaan badan" name="nama" rows="3"></textarea>
                                            </div>
                                          </div>

                                          <div class="row mb-3 form-group">
                                            <label class="col-sm-4 col-form-label">
                                              Tempat dan Tanggal Lahir
                                            </label>
                                            <div class="col-sm-8">
                                              <input type="text" class="form-control" placeholder="Tempat dan Tanggal Lahir" name="TTL">
                                            </div>
                                          </div>


                                          <div class="row mb-3 form-group">
                                            <label class="col-sm-4 col-form-label">
                                              Jenis Kelamin
                                            </label>
                                            <div class="col-sm-8">
                                              <select class="form-control form-select select2" name="jenis_kelamin">
                                                <option value="" selected disabled>- Pilih -</option>
                                                <option value="Laki-Laki">Laki-Laki</option>
                                                <option value="Perempuan">Perempuan</option>
                                              </select>
                                            </div>
                                          </div>

                                          <div class="row mb-3 form-group">
                                            <label class="col-sm-4 col-form-label">
                                              Kewarganegaraan
                                            </label>
                                            <div class="col-sm-8">
                                              <input type="text" class="form-control" placeholder="Kewarganegaraan" name="kewarganegaraan">
                                            </div>
                                          </div>

                                          <div class="row mb-3 form-group">
                                            <label class="col-sm-4 col-form-label">
                                              Alamat Tempat Tinggal
                                            </label>
                                            <div class="col-sm-8">
                                              <textarea class="form-control form-input" placeholder="Alamat Tempat Tinggal" name="alamat_tempat_tinggal" rows="3"></textarea>
                                            </div>
                                          </div>

                                          <div class="row mb-3 form-group">
                                            <label class="col-sm-4 col-form-label">
                                              Alamat KTP/Paspor
                                            </label>
                                            <div class="col-sm-8">
                                              <textarea class="form-control form-input" placeholder="Alamat KTP/Paspor" name="alamat_ktp" rows="3"></textarea>
                                            </div>
                                          </div>

                                          <div class="row mb-3 form-group">
                                            <label class="col-sm-4 col-form-label">
                                              Nomor KTP/Paspor
                                            </label>
                                            <div class="col-sm-8">
                                              <input type="text" class="form-control" placeholder="Nomor KTP/Pasporraan" name="nomor_ktp">
                                            </div>
                                          </div>

                                          <div class="row mb-3 form-group">
                                            <label class="col-sm-4 col-form-label">
                                              Tempat/Pejabat yang Mengeluarkan KTP/Paspor
                                            </label>
                                            <div class="col-sm-8">
                                              <textarea class="form-control form-input" placeholder="Diisi nama tempat/pejabat yang mengeluarkan KTP/Paspor orang yang terhadapnya dilakukan pemeriksaan badan." name="tempat_pejabat" rows="3"></textarea>
                                            </div>
                                          </div>

                                          <div class="row mb-3 form-group">
                                            <label class="col-sm-4 col-form-label">
                                              Datang Dari
                                            </label>
                                            <div class="col-sm-8">
                                              <input type="text" class="form-control" placeholder="Datang Dari" name="datang_dari">
                                            </div>
                                          </div>

                                          <div class="row mb-3 form-group">
                                            <label class="col-sm-4 col-form-label">
                                              Tempat tujuan
                                            </label>
                                            <div class="col-sm-8">
                                              <input type="text" class="form-control" placeholder="Datang Dari" name="tempat_tujuan">
                                            </div>
                                          </div>

                                          <div class="row mb-3 form-group">
                                            <label class="col-sm-4 col-form-label">
                                              Nama/Identitas orang yang
                                              bepergian dengannya
                                            </label>
                                            <div class="col-sm-8">
                                              <textarea class="form-control form-input" placeholder="Diisi nama/identitas orang yang ikut bepergian dan memiliki relasi dengan orang yang terhadapnya dilakukan pemeriksaan badan." name="nama_orang_bersamanya" rows="3"></textarea>
                                            </div>
                                          </div>

                                          <div class="row mb-3 form-group">
                                            <label class="col-sm-4 col-form-label">
                                              Jenis/Nomor dan Tgl Dokumen barang yang dibawa
                                            </label>
                                            <div class="col-sm-8">
                                              <textarea class="form-control form-input" placeholder="Diisi jenis/nomor dan tanggal dokumen yang dibawa orang yang terhadapnya dilakukan pemeriksaan badan" name="jenis_dokumen" rows="3"></textarea>
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

                        <!-- SOC -->
                        <div class="accordion-item border rounded mt-2">
                          <div class="d-flex justify-content-between align-items-center p-3 bg-light">
                            <span class="fw-bold">SOC</span>
                            <div class="form-check form-switch mb-0">
                              <input class="form-check-input status-toggle" type="checkbox" role="switch" id="flexSwitchCheck3" data-id="flush-collapse3" name="soc" value="TIDAK" aria-expanded="false" aria-controls="flush-collapse3">
                              <label class="form-check-label" for="flexSwitchCheck3" id="switch-label-3">TIDAK</label>
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
                              <input class="form-check-input status-toggle" type="checkbox" role="switch" id="flexSwitchCheck4" data-id="flush-collapse4" name="doc" value="doc" aria-expanded="false" aria-controls="flush-collapse4">
                              <label class="form-check-label" for="flexSwitchCheck4" id="switch-label-4">TIDAK</label>
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
                              <input class="form-check-input status-toggle" type="checkbox" role="switch" id="flexSwitchCheck10" data-id="flush-collapse10" name="ba_sarkut" value="TIDAK" aria-expanded="false"
                                aria-controls="flush-collapse10">
                              <label class="form-check-label" for="flexSwitchCheck10" id="switch-label-10">TIDAK</label>
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
                                      <input type="text" class="form-control bg-primary text-white" value="{{ old('no_ba_sarkut', $no_ref->no_ba_sarkut) }}" placeholder="No. B.A Sarkut" name="no_ba_sarkut" readonly>
                                    </div>

                                    <div class="col-md-6 mb-3">
                                      <label>Tgl. B.A Sarkut</label>
                                      <input type="date" class="form-control bg-primary text-white" name="tgl_ba_sarkut">
                                    </div>

                                    <h6><b>B. Data Pemeriksaan</b></h6>
                                    <hr>

                                    <div class="mb-3 form-group">
                                      <label>Dari</label>
                                      <div class="col-sm-12">
                                        <input type="text" class="form-control form-input" name="dibawa_dari" placeholder="Tempat sarkut mulai dibawa">
                                      </div>
                                    </div>

                                    <div class="mb-3 form-group">
                                      <label>Tujuan</label>
                                      <div class="col-sm-12">
                                        <input type="text" class="form-control form-input" name="tujuan" placeholder="Tempat tujuan sarkut">
                                      </div>
                                    </div>

                                    <div class="mb-3 form-group">
                                      <label>Alasan</label>
                                      <div class="col-sm-12">
                                        <textarea class="form-control form-input" placeholder="Diisi pertimbangan dan alasan sarana pengangkut/barang dibawa" name="alasan" rows="3"></textarea>
                                      </div>
                                    </div>


                                  </div>
                                </div>

                                <!-- Right Column (Pejabat Selection) -->
                                <div class="col-lg-6">

                                  <div class="mb-3 form-group">
                                    <label>Waktu Berangkat</label>
                                    <div class="col-sm-12">
                                      <input type="text" class="form-control" name="waktu_berangkat" id="datetime-datepicker" placeholder="Waktu Keberangkatan">
                                    </div>
                                  </div>

                                  <div class="mb-3 form-group">
                                    <label>Waktu Tiba</label>
                                    <div class="col-sm-12">
                                      <input type="text" class="form-control" name="waktu_tiba" id="datetime-datepicker" placeholder="Waktu Tiba">
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
                              <input class="form-check-input status-toggle" type="checkbox" role="switch" id="flexSwitchCheck101" data-id="flush-collapse101" name="ba_contoh" value="TIDAK" aria-expanded="false"
                                aria-controls="flush-collapse101">
                              <label class="form-check-label" for="flexSwitchCheck101" id="switch-label-101">TIDAK</label>
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
                                  <input type="text" class="form-control bg-primary text-white" value="{{ old('no_ba_contoh', $no_ref->no_ba_contoh) }}" placeholder="No. B.A Contoh" name="no_ba_contoh" readonly>
                                </div>

                                <div class="col-md-6 mb-3">
                                  <label>Tgl. B.A Contoh</label>
                                  <input type="date" class="form-control bg-primary text-white" name="tgl_ba_contoh">
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
                                            <textarea class="form-control form-input" placeholder="Jumlah dan Jenis Barang Contoh" name="jumlah_jenis_barang_contoh" rows="3"></textarea>
                                          </div>
                                        </div>

                                        <div class="row mb-3 form-group">
                                          <label class="col-sm-4 col-form-label">Lokasi</label>
                                          <div class="col-sm-8">
                                            <input type="text" class="form-control form-input" placeholder="Lokasi Pengambilan Barang Contoh" name="lokasi_barcon">
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
                              <input class="form-check-input status-toggle" type="checkbox" role="switch" id="flexSwitchCheck102n" data-id="flush-collapse102n" name="ba_dok" value="TIDAK" aria-expanded="false"
                                aria-controls="flush-collapse102n">
                              <label class="form-check-label" for="flexSwitchCheck102n" id="switch-label-102n">TIDAK</label>
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
                                  <input type="text" class="form-control bg-primary text-white" value="{{ old('no_ba_dok', $no_ref->no_ba_dok) }}" placeholder="No. B.A Dokumentasi" name="no_ba_dok" readonly>
                                </div>

                                <div class="col-md-6 mb-3">
                                  <label>Tgl. B.A Dokumentasi</label>
                                  <input type="date" class="form-control bg-primary text-white" name="tgl_ba_dok">
                                </div>
                              </div>

                              <div class="mb-3 form-group">
                                <label>Lokasi</label>
                                <div class="col-sm-12">
                                  <textarea class="form-control form-input" placeholder="Lokasi Dokumentasi Barang" name="lokasi_ba_dok" rows="3"></textarea>
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
                              <input class="form-check-input status-toggle" type="checkbox" role="switch" id="flexSwitchCheck1059" data-id="flush-collapse1059" name="ba_tegah" value="TIDAK" aria-expanded="false"
                                aria-controls="flush-collapse1059">
                              <label class="form-check-label" for="flexSwitchCheck1059" id="switch-label-1059">TIDAK</label>
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
                                  <input type="text" class="form-control bg-primary text-white" value="{{ old('no_ba_tegah', $no_ref->no_ba_tegah) }}" placeholder="No. B.A Tegah" name="no_ba_tegah" readonly>
                                </div>

                                <div class="col-md-6 mb-3">
                                  <label>Tgl. B.A Tegah</label>
                                  <input type="date" class="form-control bg-primary text-white" name="tgl_ba_tegah">
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
                              <input class="form-check-input status-toggle" type="checkbox" role="switch" id="flexSwitchCheck1032" data-id="flush-collapse1032" name="ba_segel" value="TIDAK" aria-expanded="false"
                                aria-controls="flush-collapse1032">
                              <label class="form-check-label" for="flexSwitchCheck1032" id="switch-label-1032">TIDAK</label>
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
                                  <input type="text" class="form-control bg-primary text-white" value="{{ old('no_ba_segel', $no_ref->no_ba_segel) }}" placeholder="No. B.A Segel" name="no_ba_segel" readonly>
                                </div>

                                <div class="col-md-6 mb-3">
                                  <label>Tgl. B.A Segel</label>
                                  <input type="date" class="form-control bg-primary text-white" name="tgl_ba_segel">
                                </div>
                              </div>


                              <div class="col-lg-12 mb-3">
                                <label>Jenis Segel</label>
                                <select class="form-control form-select select2" name="jenis_segel_ba_segel">
                                  <option value="" selected disabled>- Pilih -</option>
                                  @foreach ($segels as $segel)
                                    <option value="{{ $segel->jenis_segel }}">{{ $segel->jenis_segel }}
                                    </option>
                                  @endforeach
                                </select>
                              </div>

                              <div class="row">
                                <div class="col-md-6 mb-3">
                                  <label>Jumlah Segel</label>
                                  <input type="text" class="form-control" placeholder="Jumlah Segel" name="jumlah_segel_ba_segel">
                                </div>


                                <div class="col-md-6 mb-3">
                                  <label>Nomor Segel</label>
                                  <input type="text" class="form-control" placeholder="Nomor Segel" name="nomor_segel_ba_segel">
                                </div>

                              </div>

                              <div class="col-md-12 mb-3">
                                <label>Peletakan Segel</label>
                                <textarea class="form-control form-input" placeholder="Peletakan Segel" name="peletakan_segel_ba_segel" rows="3"></textarea>
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
                              <input class="form-check-input status-toggle" type="checkbox" role="switch" id="flexSwitchCheck1011" data-id="flush-collapse1011" name="ba_titip" value="TIDAK" aria-expanded="false"
                                aria-controls="flush-collapse1011">
                              <label class="form-check-label" for="flexSwitchCheck1011" id="switch-label-1011">TIDAK</label>
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
                                  <input type="text" class="form-control bg-primary text-white" value="{{ old('no_ba_titip', $no_ref->no_ba_titip) }}" placeholder="No. B.A Titip" name="no_ba_titip" readonly>
                                </div>

                                <div class="col-md-6 mb-3">
                                  <label>Tgl. B.A Tegah</label>
                                  <input type="date" class="form-control bg-primary text-white" name="tgl_ba_titip">
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
                                            <textarea class="form-control form-input" placeholder="Lokasi Penitipan" name="lokasi_penitipan_ba_titip" rows="3"></textarea>
                                          </div>
                                        </div>

                                        <div class="row mb-3 form-group">
                                          <label class="col-sm-4 col-form-label">Nama Yang Dititipkan</label>
                                          <div class="col-sm-8">
                                            <input type="text" class="form-control form-input" placeholder="Nama Yang Dititipkan" name="nama_ba_titip">
                                          </div>
                                        </div>

                                        <div class="row mb-3 form-group">
                                          <label class="col-sm-4 col-form-label">Alamat yang dtitipkan</label>
                                          <div class="col-sm-8">
                                            <textarea class="form-control form-input" placeholder="Alamat yang dtitipkan" name="alamat_ba_titip" rows="3"></textarea>
                                          </div>
                                        </div>

                                        <div class="row mb-3 form-group">
                                          <label class="col-sm-4 col-form-label">Jabatan yang dtitipkan</label>
                                          <div class="col-sm-8">
                                            <input type="text" class="form-control form-input" placeholder="Jabatan yang dtitipkan" name="jabatan_ba_titip">
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
                              <input class="form-check-input status-toggle" type="checkbox" role="switch" id="flexSwitchCheck1022" data-id="flush-collapse1022" name="bpc" value="TIDAK" aria-expanded="false"
                                aria-controls="flush-collapse1022">
                              <label class="form-check-label" for="flexSwitchCheck1022" id="switch-label-1022">TIDAK</label>
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
                              <input class="form-check-input status-toggle" type="checkbox" role="switch" id="flexSwitchCheck10114" data-id="flush-collapse10114" name="ba_tolak_1" value="YA" aria-expanded="false"
                                aria-controls="flush-collapse10114">
                              <label class="form-check-label" for="flexSwitchCheck10114" id="switch-label-10114">
                                TIDAK
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
                                      <input type="text" class="form-control bg-primary text-white" placeholder="No. B.A Tolak Pertama" value="{{ old('no_ba_tolak_1', $no_ref->no_ba_tolak_1) }}" name="no_ba_tolak_1" readonly>
                                    </div>

                                    <div class="col-md-6 mb-3">
                                      <label>Tgl. B.A Tolak 1</label>
                                      <input type="date" class="form-control bg-primary text-white" name="tgl_ba_tolak_1">
                                    </div>

                                    <div class="col-md-12 mb-3">
                                      <label>Nama Orang Yang Menolak</label>
                                      <input type="text" class="form-control form-input" placeholder="Nama Orang Yang Menolak" name="nama_ba_tolak1">
                                    </div>

                                    <div class="col-md-12 mb-3">
                                      <label>Tempat Tanggal Lahir</label>
                                      <input type="text" class="form-control form-input" placeholder="Tempat Tanggal Lahir" name="ttl_ba_tolak1">
                                    </div>

                                    <div class="col-md-12 mb-3">
                                      <label>Jenis Kelamin</label>
                                      <select class="form-control form-select select2" name="jk_ba_tolak1">
                                        <option value="" selected disabled>- Pilih -</option>
                                        <option value="Laki-laki">Laki-laki</option>
                                        <option value="Perempuan">Perempuan</option>
                                      </select>
                                    </div>

                                    <div class="col-md-12 mb-3">
                                      <label>Alamat</label>
                                      <textarea class="form-control form-input" placeholder="Alamat" name="alamat_ba_tolak1" rows="3"></textarea>
                                    </div>

                                    <div class="col-md-12 mb-3">
                                      <label>Kewarganegaraan</label>
                                      <select class="form-control form-select select2" name="kewarganegaraan_ba_tolak1">
                                        <option value="" selected disabled>Pilih Kewarganegaraan</option>
                                        @foreach ($nama_negara as $benua => $negara)
                                          <optgroup label="{{ $benua }}">
                                            @foreach ($negara as $item)
                                              <option value="{{ $item->UrEdi }}">{{ $item->UrEdi }}</option>
                                            @endforeach
                                          </optgroup>
                                        @endforeach
                                      </select>
                                    </div>

                                    <div class="col-md-12 mb-3">
                                      <label>Pekerjaan</label>
                                      <input type="text" class="form-control form-input" placeholder="Pekerjaan" name="pekerjaan_ba_tolak1">
                                    </div>

                                  </div>
                                </div>

                                <!-- Right Column (Pejabat Selection) -->
                                <div class="col-lg-6">



                                  <div class="row mb-3 form-group">
                                    <label class="col-sm-3 col-form-label">Alasan Tolak Pertama</label>
                                    <div class="col-sm-9">
                                      <textarea class="form-control form-input" placeholder="Alasan Tolak Pertama" name="alasan_tolak_1" rows="5"></textarea>
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
                              <input class="form-check-input status-toggle" type="checkbox" role="switch" id="flexSwitchCheck101145" data-id="flush-collapse101145" name="ba_tolak_2" value="YA">
                              <label class="form-check-label" for="flexSwitchCheck101145" id="switch-label-101145">
                                TIDAK
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
                                      <input type="text" class="form-control bg-primary text-white" value="{{ old('no_ba_tolak_2', $no_ref->no_ba_tolak_2) }}" placeholder="No. B.A Tolak Kedua" name="no_ba_tolak_2">
                                    </div>

                                    <div class="col-md-6 mb-3">
                                      <label>Tgl. B.A Tolak 2</label>
                                      <input type="date" class="form-control bg-primary text-white" name="tgl_ba_tolak_2">
                                    </div>

                                    <div class="col-md-12 mb-3">
                                      <label>Nama Saksi</label>
                                      <input type="text" class="form-control form-input" placeholder="Saksi yang menyaksikan penolakan tanda tangan" name="saksi_ba_tolak2">
                                    </div>

                                  </div>
                                </div>

                                <!-- Right Column (Pejabat Selection) -->
                                <div class="col-lg-6">



                                  <div class="row mb-3 form-group">
                                    <label class="col-sm-3 col-form-label">Alasan Tolak Kedua</label>
                                    <div class="col-sm-9">
                                      <textarea class="form-control form-input" placeholder="Alasan Tolak Kedua" name="alasan_tolak_2" rows="5"></textarea>
                                    </div>
                                  </div>

                                </div>

                              </div>

                            </div>
                          </div>
                        </div>

                      </div>
                    </div>



                    {{-- <div class="tab-pane fade" id="sbp" role="tabpanel" aria-labelledby="sbp-tab">
                      <div class="row align-items-center mb-3">
                        <div class="col-sm-8">

                        </div>
                      </div>
                    </div> --}}

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
      const namaSaksiInput = document.getElementById('nama_saksi');
      const noIdentitasSaksiInput = document.getElementById('no_identitas_saksi');
      const pengemudiInput = document.getElementById('pengemudi');
      const noIdentitasPengemudiInput = document.getElementById('no_identitas_pengemudi');

      namaSaksiInput.addEventListener('input', function() {
        pengemudiInput.value = this.value;
      });

      noIdentitasSaksiInput.addEventListener('input', function() {
        noIdentitasPengemudiInput.value = this.value;
      });
    });
  </script>

  <script>
    document.addEventListener('DOMContentLoaded', function() {
      const select = document.getElementById('id_petugas_1_sbp');
      const currentValue = select.value;

      select.addEventListener('change', function(e) {
        if (this.value !== currentValue) {
          alert('Anda tidak dapat mengubah akun login!');
          this.value = currentValue;
        }
      });
    });
  </script>

  <script>
    document.addEventListener('DOMContentLoaded', function() {
      const switches = document.querySelectorAll('.status-toggle');

      switches.forEach(switchElement => {
        switchElement.addEventListener('change', function() {
          const accordionId = this.getAttribute('data-id');
          const accordionContent = document.getElementById(accordionId);

          this.value = this.checked ? 'YA' : 'TIDAK';

          if (accordionContent) {
            if (this.checked) {
              accordionContent.classList.add('show');
            } else {
              accordionContent.classList.remove('show');
            }
          } else {
            console.warn(`Accordion dengan ID "${accordionId}" tidak ditemukan.`);
          }
        });
      });
    });
  </script>

  <script>
    const switches = document.querySelectorAll('.status-toggle');

    switches.forEach((switchElement, index) => {
      const label = switchElement.nextElementSibling;

      switchElement.addEventListener('change', function() {
        label.textContent = this.checked ? 'YA' : 'TIDAK';
      });
    });
  </script>

  <script>
    function generateUniqueID() {
      const timestamp = Date.now();
      const randomNum = Math.floor(Math.random() * 1000000);
      return `id_penindakan_${timestamp}_${randomNum}`;
    }

    document.getElementById('id_penindakan').value = generateUniqueID();
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
