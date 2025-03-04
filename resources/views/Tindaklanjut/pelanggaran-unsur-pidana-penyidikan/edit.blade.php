@extends('layouts.vertical', ['title' => 'Edit Pelanggaran Unsur Pidana Penyidikan'])

@section('css')
  @vite(['node_modules/datatables.net-bs5/css/dataTables.bootstrap5.min.css', 'node_modules/datatables.net-buttons-bs5/css/buttons.bootstrap5.min.css', 'node_modules/datatables.net-keytable-bs5/css/keyTable.bootstrap5.min.css', 'node_modules/datatables.net-responsive-bs5/css/responsive.bootstrap5.min.css', 'node_modules/datatables.net-select-bs5/css/select.bootstrap5.min.css'])
@endsection
@section('content')
  <div class="container-fluid">
    <form action="{{ route('unsur-pidana-penyidikan.update', ['unsur_pidana_penyidikan' => $unsurpenyidikan->id]) }}" method="POST" enctype="multipart/form-data">
      @csrf
      @method('PUT')
      <div class="card mb-3 mt-4">
        <div class="card-header d-flex justify-content-between align-items-center">
          <h5 class="card-title mb-0">
            <i data-feather="book" style="width: 20px; height: 20px;" class="me-1"></i>
            Form Edit Data Pelanggaran Usur Pidana Penyidikan
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
                        <a class="nav-link active" id="navtabs2-lk-tab" data-bs-toggle="tab" href="#navtabs2-lk" role="tab" aria-controls="navtabs2-lk" aria-selected="true">
                          <span class="d-block d-sm-none">(LK)</span>
                          <span class="d-none d-sm-block">LAPORAN KEJADIAN TINDAK PIDANA</span>
                        </a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link " id="navtabs2-sptp-tab" data-bs-toggle="tab" href="#navtabs2-sptp" role="tab" aria-controls="navtabs2-sptp" aria-selected="false">
                          <span class="d-block d-sm-none">(SPTP)</span>
                          <span class="d-none d-sm-block">SURAT PERINTAH TUGAS PENYIDIKAN</span>
                        </a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link " id="navtabs2-spdp-tab" data-bs-toggle="tab" href="#navtabs2-spdp" role="tab" aria-controls="navtabs2-spdp" aria-selected="false">
                          <span class="d-block d-sm-none">(SPDP)</span>
                          <span class="d-none d-sm-block">SURAT PEMBERITAHUAN DIMULAINYA PENYIDIKAN</span>
                        </a>
                      </li>
                      {{-- <li class="nav-item">
                        <a class="nav-link " id="navtabs2-spdp-tab" data-bs-toggle="tab" href="#navtabs2-spdp" role="tab" aria-controls="navtabs2-spdp" aria-selected="false">
                          <span class="d-block d-sm-none">(SPDP)</span>
                          <span class="d-none d-sm-block">SURAT PEMBERITAHUAN DIMULAINYA PENYIDIKAN</span>
                        </a>
                      </li> --}}
                      {{-- <li class="nav-item">
                        <a class="nav-link" id="navtabs2-pemberitahuan-tab" data-bs-toggle="tab" href="#navtabs2-pemberitahuan" role="tab" aria-controls="navtabs2-pemberitahuan" aria-selected="false">
                          <span class="d-block d-sm-none">(PEMBERITAHUAN)</span>
                          <span class="d-none d-sm-block">PEMBERITAHUAN</span>
                        </a>
                      </li> --}}
                    </ul>
                  </div>

                  <div class="tab-content p-3 text-muted">

                    <div class="tab-pane active" id="navtabs2-lk" role="tabpanel">
                      <div class="container-fluid mt-4">
                        <!-- Header with Logo -->
                        <div class="row mb-4 align-items-center text-black">
                          <div class="col-md-2 col-sm-12 text-center mb-3 mb-md-0">
                            <img src="/images/logocop.png" alt="Logo" class="img-fluid" style="max-height:170px;">
                          </div>
                          <div class="col-md-10 col-sm-12 text-center">
                            <h5 class="mb-0">KEMENTERIAN KEUANGAN REPUBLIK INDONESIA</h5>
                            <p class="small mb-0">DIREKTORAT JENDERAL BEA DAN CUKAI</p>
                            <p class="small mb-0">KANTOR PELAYANAN UTAMA BEA DAN CUKAI TIPE B BATAM</p>
                            <p class="small mb-0">
                              JALAN KUDA LAUT, BATU AMPAR, BATAM, KEPULAUAN RIAU 29432;
                              TELEPON (0778) 458118, 458263; FAKSIMILE (0778) 458149;
                            </p>
                            <p class="small mb-0">
                              LAMAN WWW.BCBATAM.BEACUKAI.GO.ID;
                              PUSAT KONTAK LAYANAN 1500225;
                              SUREL BCBPBATAM@CUSTOMS.GO.ID,
                              KPBC.BATAM@KEMENKEU.GO.ID
                            </p>
                          </div>
                        </div>

                        <hr class="border border-dark border-2 bg-dark">

                        <h5 class="fw-bold text-black">"PRO JUSTITIA"</h5>

                        <h5 class="fw-bold text-center text-black"><u>LAPORAN KEJADIAN TINDAK PIDANA</u></h5>

                        <div class="mb-3 row align-items-center">
                          <div class="input-group flex-wrap">
                            <span class="input-group-text">NO : LK-</span>
                            <input type="text" class="form-control" value="{{ old('no_lk', $unsurpenyidikan->no_lk) }}" name="no_lk" readonly>
                            <span class="input-group-text">/PPNS/</span>
                            <input type="date" class="form-control" name="tgl_lk" value="{{ old('tgl_lk', $unsurpenyidikan->tgl_lk) }}">
                          </div>
                        </div>

                        <!-- Main Form -->
                        <div class="card p-1">
                          <div class="card-body">
                            <div class="row">
                              <div class="col-lg-12">
                                <div class="container-fluid px-0 px-sm-3">

                                  <p class="fw-bold">
                                    &nbsp;&nbsp;&nbsp; Pada hari ........ tanggal ........ bulan ........ tahun ........, Saya :
                                  </p>

                                  <div class="fw-bold text-center">
                                    <select class="form-control form-select select2" name="pejabat_lk">
                                      <option value="" selected disabled>- Pilih -</option>
                                      @foreach ($users as $user)
                                        <option value="{{ $user->id_admin }}" {{ old('pejabat_lk', $unsurpenyidikan->pejabat_lk) == $user->id_admin ? 'selected' : '' }}>
                                          {{ $user->name }} | {{ $user->pangkat }} | {{ $user->jabatan }}
                                        </option>
                                      @endforeach
                                    </select>
                                  </div>


                                  <br>

                                  <p class="fw-bold">
                                    &nbsp;&nbsp;&nbsp; Berdasarkan ........ melaporkan terdapat bukti permulaan yang cukup adanya
                                    dugaan tindak pidana ........ (kepabeanan, cukai, dan/atau Tindak Pidana
                                    Pencucian Uang)
                                  </p>

                                  <div class="fw-bold text-center mt-3 mb-3">
                                    <select name="berdasarkan_lk" class="form-control form-select select2">
                                      <option value="" selected disabled>- Pilih -</option>
                                      <option value="hasil Penelitian Pendahuluan" {{ old('berdasarkan_lk', $unsurpenyidikan->berdasarkan_lk) == 'hasil Penelitian Pendahuluan' ? 'selected' : '' }}>
                                        Hasil Penelitian Pendahuluan
                                      </option>
                                      <option value="Laporan Hasil Penelitian" {{ old('berdasarkan_lk', $unsurpenyidikan->berdasarkan_lk) == 'Laporan Hasil Penelitian' ? 'selected' : '' }}>
                                        Laporan Hasil Penelitian
                                      </option>
                                    </select>
                                  </div>

                                  <div class="fw-bold text-center">
                                    <textarea class="form-control" name="uraian_laporan_lk" rows="3" placeholder="melaporkan terdapat bukti permulaan yang cukup adanya dugaan tindak pidana ........">{{ old('uraian_laporan_lk', $unsurpenyidikan->uraian_laporan_lk) }}</textarea>
                                  </div>

                                  <div class="fw-bold text-center mt-3 mb-3">
                                    <textarea class="form-control" name="dugaan_tindak_pidana_lk" rows="3"
                                      placeholder="Pilih Satu jenis Tindak Pidana (Kepabeanan/Cukai/Tindak Pidana lain yang menurut Undang-Undang menjadi kewenangan Penyidik Direktorat Jenderal Bea dan Cukai)">{{ old('dugaan_tindak_pidana_lk', $unsurpenyidikan->dugaan_tindak_pidana_lk) }}</textarea>
                                  </div>



                                  <div class="mb-3 row">
                                    <label class="col-md-3 col-sm-12 col-form-label">Tempat Kejadian</label>
                                    <div class="col-md-1 col-sm-1 text-center mt-1 d-none d-sm-block">:</div>
                                    <div class="col-md-8 col-sm-11">
                                      <textarea class="form-control" placeholder="Diisi tempat terjadinya dugaan Tindak Pidana (Diisi lengkap dan detail)" rows="3" name="tempat_kejadian_lk">{{ old('tempat_kejadian_lk', $unsurpenyidikan->tempat_kejadian_lk) }}</textarea>
                                    </div>
                                  </div>

                                  <div class="mb-3 row">
                                    <label class="col-md-3 col-sm-12 col-form-label">Waktu Kejadian</label>
                                    <div class="col-md-1 col-sm-1 text-center mt-1 d-none d-sm-block">:</div>
                                    <div class="col-md-8 col-sm-11">
                                      <textarea class="form-control" placeholder="Diisi waktu terjadinya dugaan Tindak Pidana (Diisi lengkap dan detail)" rows="3" name="waktu_kejadian_lk">{{ old('waktu_kejadian_lk', $unsurpenyidikan->waktu_kejadian_lk) }}</textarea>
                                    </div>
                                  </div>

                                  <div class="mb-3 row">
                                    <label class="col-md-3 col-sm-12 col-form-label">Uraian Kejadian</label>
                                    <div class="col-md-1 col-sm-1 text-center mt-1 d-none d-sm-block">:</div>
                                    <div class="col-md-8 col-sm-11">
                                      <textarea class="form-control" name="uraian_kejadian_lk" placeholder="Diisi uraian kejadian dugaan Tindak Pidana" rows="5">{{ old('uraian_kejadian_lk', $unsurpenyidikan->uraian_kejadian_lk) }}</textarea>
                                    </div>
                                  </div>


                                  <div class="mb-3 row">
                                    <label class="col-md-3 col-sm-12 col-form-label">Pasal yang dilanggar</label>
                                    <div class="col-md-1 col-sm-1 text-center mt-1 d-none d-sm-block">:</div>
                                    <div class="col-md-8 col-sm-11">
                                      <textarea class="form-control border-0 text-black" rows="3" readonly>{{ old('dugaan_pelanggaran_lpp', $penyidikan->dugaan_pelanggaran_lpp) }}</textarea>
                                    </div>
                                  </div>

                                  <p class="fw-bold">
                                    Kejadian tersebut saya laporkan kepada Kepala Bidang Penindakan dan Penyidikan
                                    KPU Bea dan Cukai Tipe B Batam untuk penanganan lebih lanjut.
                                  </p>

                                  <p class="fw-bold">
                                    Demikian laporan terjadinya tindak pidana ini saya buat dengan sebenarnya
                                    dengan mengingat sumpah jabatan.
                                  </p>

                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>


                    <div class="tab-pane" id="navtabs2-sptp" role="tabpanel">
                      <div class="container-fluid mt-4">
                        <!-- Header with Logo -->
                        <div class="row mb-4 align-items-center text-black">
                          <div class="col-md-2 col-sm-12 text-center mb-3 mb-md-0">
                            <img src="/images/logocop.png" alt="Logo" class="img-fluid" style="max-height:170px;">
                          </div>
                          <div class="col-md-10 col-sm-12 text-center">
                            <h5 class="mb-0">KEMENTERIAN KEUANGAN REPUBLIK INDONESIA</h5>
                            <p class="small mb-0">DIREKTORAT JENDERAL BEA DAN CUKAI</p>
                            <p class="small mb-0">KANTOR PELAYANAN UTAMA BEA DAN CUKAI TIPE B BATAM</p>
                            <p class="small mb-0">
                              JALAN KUDA LAUT, BATU AMPAR, BATAM, KEPULAUAN RIAU 29432;
                              TELEPON (0778) 458118, 458263; FAKSIMILE (0778) 458149;
                            </p>
                            <p class="small mb-0">
                              LAMAN WWW.BCBATAM.BEACUKAI.GO.ID;
                              PUSAT KONTAK LAYANAN 1500225;
                              SUREL BCBPBATAM@CUSTOMS.GO.ID,
                              KPBC.BATAM@KEMENKEU.GO.ID
                            </p>
                          </div>
                        </div>

                        <hr class="border border-dark border-2 bg-dark">

                        <h5 class="fw-bold text-black">"PRO JUSTITIA"</h5>

                        <h5 class="fw-bold text-center">SURAT PERINTAH TUGAS PENYIDIKAN
                        </h5>

                        <div class="mb-3 row align-items-center">
                          <div class="input-group flex-wrap">
                            <span class="input-group-text">NO : SPTP- </span>
                            <input type="text" class="form-control" value="{{ old('no_sptp', $unsurpenyidikan->no_sptp) }}" name="no_sptp" readonly>
                            <span class="input-group-text">/PPNS/</span>
                            <input type="date" class="form-control" name="tgl_sptp" value="{{ old('tgl_sptp', $unsurpenyidikan->tgl_sptp) }}">
                          </div>
                        </div>


                        <!-- Main Form -->
                        <div class="card p-1">
                          <div class="card-body">
                            <div class="row">
                              <div class="col-lg-12">
                                <div class="container-fluid px-0 px-sm-3">

                                  <div class="mb-3 row">
                                    <label class="col-md-3 col-sm-12 col-form-label fw-bold text-md-start">DASAR</label>
                                    <div class="col-md-1 col-sm-1 text-center mt-1 d-none d-sm-block">:</div>
                                    <div class="col-md-8 col-sm-11">
                                      <ol class="ps-3 text-black" start="1" style="line-height: 1.5;">
                                        <li class="mb-1 ps-1">Undang-Undang Nomor 8 Tahun 1981 tentang Hukum Acara Pidana;</li>
                                        <li class="mb-1 ps-1">Undang-Undang Nomor 10 Tahun 1995 tentang Kepabeanan sebagaimana telah diubah dengan Undang-Undang Nomor 17 Tahun 2006;</li>
                                        <li class="mb-1 ps-1">Undang-Undang Nomor 11 Tahun 1995 tentang Cukai sebagaimana telah diubah dengan Undang-Undang Nomor 39 Tahun 2007;</li>
                                        <li class="mb-1 ps-1">Peraturan Pemerintah Nomor 27 Tahun 1983 tentang Pelaksanaan Kitab Undang-Undang Hukum Acara Pidana sebagaimana telah diubah beberapa kali terakhir dengan Peraturan Pemerintah Nomor 92
                                          Tahun
                                          2015 tentang Perubahan Kedua atas Peraturan Pemerintah Nomor 27 Tahun 1983 tentang Pelaksanaan Kitab Undang-Undang Hukum Acara Pidana;</li>
                                        <li class="mb-1 ps-1">Peraturan Pemerintah Nomor 55 Tahun 1996 tentang Penyidikan Tindak Pidana di Bidang Kepabeanan dan Cukai;</li>
                                        <li class="mb-1 ps-1">Peraturan Menteri Keuangan Nomor ...(6)... tentang Organisasi dan Tata Kerja Kementerian Keuangan/Organisasi dan Tata Kerja Instansi Vertikal Direktorat Jenderal Bea dan Cukai*);</li>
                                        <li class="mb-1 ps-1">Laporan Kejadian Tindak Pidana Nomor ....(7)....</li>
                                      </ol>
                                    </div>
                                  </div>

                                  <div class="mb-3 row">
                                    <label class="col-md-3 col-sm-12 col-form-label fw-bold text-md-start">PERTIMBANGAN</label>
                                    <div class="col-md-1 col-sm-1 text-center mt-1 d-none d-sm-block">:</div>
                                    <div class="col-md-8 col-sm-11">
                                      <ol class="ps-3 text-black" start="1" style="line-height: 1.5;">
                                        <li class="mb-1 ps-1">Bahwa dengan adanya laporan terjadinya tindak pidana di bidang ….(9)…. maka
                                          dipandang perlu untuk mencari dan mengumpulkan bukti guna membuat terang
                                          tindak pidana yang terjadi dan menemukan Tersangkanya</li>
                                        <li class="mb-1 ps-1">Bahwa untuk maksud tersebut perlu dikeluarkan Surat Perintah Tugas Penyidikan.</li>
                                      </ol>
                                    </div>
                                  </div>

                                  <div class="mb-3 row">
                                    <label class="col-md-3 col-sm-12 col-form-label fw-bold text-md-start">KEPADA</label>
                                    <div class="col-md-1 col-sm-1 text-center mt-1 d-none d-sm-block">:</div>
                                    <div class="col-md-8 col-sm-11">
                                      <select class="form-control form-select select2 " id="tim_penyidik" name="tim_penyidik[]" multiple>
                                        {{-- <option value="" selected disabled>- Pilih -</option> --}}
                                        @foreach ($users as $user)
                                          <option value="{{ $user->id_admin }}" {{ in_array($user->id_admin, json_decode($unsurpenyidikan->tim_penyidik)) ? 'selected' : '' }}>
                                            {{ $user->name }} | {{ $user->pangkat }} | {{ $user->jabatan }}
                                          </option>
                                        @endforeach
                                      </select>
                                    </div>
                                  </div>


                                  <div class="mb-3 row">
                                    <label class="col-md-3 col-sm-12 col-form-label fw-bold text-md-start">UNTUK</label>
                                    <div class="col-md-1 col-sm-1 text-center mt-1 d-none d-sm-block">:</div>
                                    <div class="col-md-8 col-sm-11">
                                      <ol class="ps-3 text-black" start="1" style="line-height: 1.5;">
                                        <li class="mb-1 ps-1">Melakukan tugas Penyidikan terhadap perkara dugaan tindak pidana di bidang ….(12)…, yaitu ….(13)…., diduga melanggar Pasal ….(14)…. Undang-Undang ….(15)…. tentang .... yang diduga dilakukan
                                          oleh tersangka:</li>

                                        <div class="row mb-3 pt-3">
                                          <div class="col-md-4 text-black d-flex align-items-center">Nama Lengkap</div>
                                          <div class="col-md-1 text-center d-flex align-items-center justify-content-center">:</div>
                                          <div class="col-md-7">
                                            <input type="text" class="form-control py-1 border-0" value="{{ old('nama_saksi', $sbpData->nama_saksi) }}" readonly>
                                          </div>
                                        </div>


                                        <div class="row mb-3">
                                          <div class="col-md-4 text-black d-flex align-items-center">Tempat /Tanggal Lahir</div>
                                          <div class="col-md-1 text-center d-flex align-items-center justify-content-center">:</div>
                                          <div class="col-md-7">
                                            <input type="text" class="form-control py-1 border-0" value="{{ old('ttl_saksi', $sbpData->ttl_saksi) }}" readonly>
                                          </div>
                                        </div>

                                        <div class="row mb-3">
                                          <div class="col-md-4 text-black d-flex align-items-center">Agama</div>
                                          <div class="col-md-1 text-center d-flex align-items-center justify-content-center">:</div>
                                          <div class="col-md-7">
                                            <input type="text" class="form-control py-1 border-0" value="{{ old('agama_saksi', $sbpData->agama_saksi) }}" readonly>
                                          </div>
                                        </div>

                                        <div class="row mb-3">
                                          <div class="col-md-4 text-black d-flex align-items-center">Jenis kelamin
                                          </div>
                                          <div class="col-md-1 text-center d-flex align-items-center justify-content-center">:</div>
                                          <div class="col-md-7">
                                            <input type="text" class="form-control py-1 border-0" value="{{ old('jk_saksi', $sbpData->jk_saksi) }}" readonly>
                                          </div>
                                        </div>

                                        <div class="row mb-3">
                                          <div class="col-md-4 text-black d-flex align-items-center">Kewarganegaraan</div>
                                          <div class="col-md-1 text-center d-flex align-items-center justify-content-center">:</div>
                                          <div class="col-md-7">
                                            <input type="text" class="form-control py-1 border-0" value="{{ old('kewarganegaraan_saksi', $sbpData->kewarganegaraan_saksi) }}" readonly>
                                          </div>
                                        </div>

                                        <div class="row mb-3">
                                          <div class="col-md-4 text-black d-flex align-items-center">Pekerjaan saat ini</div>
                                          <div class="col-md-1 text-center d-flex align-items-center justify-content-center">:</div>
                                          <div class="col-md-7">
                                            <input type="text" class="form-control py-1 border-0" value="{{ old('pekerjaan_saksi', $sbpData->pekerjaan_saksi) }}" readonly>
                                          </div>
                                        </div>

                                        <div class="row mb-3">
                                          <div class="col-md-4 text-black d-flex align-items-center">Alamat sesuai Identitas</div>
                                          <div class="col-md-1 text-center d-flex align-items-center justify-content-center">:</div>
                                          <div class="col-md-7">
                                            <input type="text" class="form-control py-1 border-0" value="{{ old('alamat_saksi', $sbpData->alamat_saksi) }}" readonly>
                                          </div>
                                        </div>

                                        <div class="row mb-3">
                                          <div class="col-md-4 text-black d-flex align-items-center">Jenis/ Nomor Identitas</div>
                                          <div class="col-md-1 text-center d-flex align-items-center justify-content-center">:</div>
                                          <div class="col-md-7">
                                            <input type="text" class="form-control py-1 border-0" value="{{ $sbpData->jenis_iden_saksi . ' / ' . $sbpData->no_identitas_saksi }}" readonly>
                                          </div>
                                        </div>


                                        <div class="row mb-3">
                                          <div class="col-md-4 text-black d-flex align-items-center">Pendidikan terakhir</div>
                                          <div class="col-md-1 text-center d-flex align-items-center justify-content-center">:</div>
                                          <div class="col-md-7">
                                            <input type="text" class="form-control py-1 border-0" value="{{ old('pendidikan_terakhir_saksi', $sbpData->pendidikan_terakhir_saksi) }}" readonly>
                                          </div>
                                        </div>

                                        <li class="mb-1 ps-1">Melakukan tugas dengan penuh rasa tanggung jawab dan melaporkan hasilnya.</li>
                                        <li class="mb-1 ps-1">Surat Perintah Penyidikan ini berlaku sejak tanggal dikeluarkan.</li>
                                      </ol>
                                    </div>
                                  </div>

                                  <div class="mb-3 row">
                                    <label class="col-md-3 col-sm-12 col-form-label fw-bold text-md-start">PEJABAT YANG MENERBITKAN SURAT PERINTAH</label>
                                    <div class="col-md-1 col-sm-1 text-center mt-1 d-none d-sm-block">:</div>
                                    <div class="col-md-8 col-sm-11">
                                      <select class="form-control form-select select2" name="pejabat_terbit_sptp">
                                        <option value="" disabled>- Pilih -</option>
                                        @foreach ($users as $user)
                                          <option value="{{ $user->id_admin }}" {{ old('pejabat_terbit_sptp', $unsurpenyidikan->pejabat_terbit_sptp ?? '') == $user->id_admin ? 'selected' : '' }}>
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
                        </div>
                      </div>
                    </div>


                    <div class="tab-pane" id="navtabs2-spdp" role="tabpanel">
                      <div class="container-fluid mt-4">
                        <!-- Header with Logo -->
                        <div class="row mb-4 align-items-center text-black">
                          <div class="col-md-2 col-sm-12 text-center mb-3 mb-md-0">
                            <img src="/images/logocop.png" alt="Logo" class="img-fluid" style="max-height:170px;">
                          </div>
                          <div class="col-md-10 col-sm-12 text-center">
                            <h5 class="mb-0">KEMENTERIAN KEUANGAN REPUBLIK INDONESIA</h5>
                            <p class="small mb-0">DIREKTORAT JENDERAL BEA DAN CUKAI</p>
                            <p class="small mb-0">KANTOR PELAYANAN UTAMA BEA DAN CUKAI TIPE B BATAM</p>
                            <p class="small mb-0">
                              JALAN KUDA LAUT, BATU AMPAR, BATAM, KEPULAUAN RIAU 29432;
                              TELEPON (0778) 458118, 458263; FAKSIMILE (0778) 458149;
                            </p>
                            <p class="small mb-0">
                              LAMAN WWW.BCBATAM.BEACUKAI.GO.ID;
                              PUSAT KONTAK LAYANAN 1500225;
                              SUREL BCBPBATAM@CUSTOMS.GO.ID,
                              KPBC.BATAM@KEMENKEU.GO.ID
                            </p>
                          </div>
                        </div>

                        <hr class="border border-dark border-2 bg-dark">

                        <h5 class="fw-bold text-black">"PRO JUSTITIA"</h5>


                        <!-- Main Form -->
                        <div class="card p-3">
                          <div class="card-body">

                            <div class="row mb-3 align-items-center">
                              <div class="col-md-3 fw-bold">Nomor</div>
                              <div class="col-md-1 text-center">:</div>
                              <div class="col-md-8">
                                <div class="input-group">
                                  <span class="input-group-text">PDP-</span>
                                  <input type="text" class="form-control" value="{{ old('no_pdp', $unsurpenyidikan->no_pdp ?? $no_ref->no_pdp) }}" name="no_pdp" readonly>
                                  <span class="input-group-text">/PPNS/</span>
                                  <input type="date" class="form-control" name="tgl_pdp" value="{{ old('tgl_pdp', $unsurpenyidikan->tgl_pdp ?? '') }}">
                                </div>
                              </div>
                            </div>


                            <div class="row mb-3">
                              <div class="col-md-3 fw-bold">Sifat</div>
                              <div class="col-md-1 text-center">:</div>
                              <div class="col-md-8">Segera</div>
                            </div>

                            <div class="row mb-3">
                              <div class="col-md-3 fw-bold">Lampiran</div>
                              <div class="col-md-1 text-center">:</div>
                              <div class="col-md-8">Satu berkas</div>
                            </div>

                            <div class="row mb-3">
                              <div class="col-md-3 fw-bold">Hal</div>
                              <div class="col-md-1 text-center">:</div>
                              <div class="col-md-8">Pemberitahuan Dimulainya Penyidikan</div>
                            </div>

                            <div class="row mb-3">
                              <div class="col-md-3 fw-bold">Yth.</div>
                              <div class="col-md-1 text-center">:</div>
                              <div class="col-md-8">
                                <input type="text" class="form-control" name="yth_pdp" value="{{ old('yth_pdp', $unsurpenyidikan->yth_pdp ?? '') }}">
                              </div>
                            </div>

                            <div class="row mb-3">
                              <div class="col-md-3 fw-bold">Di</div>
                              <div class="col-md-1 text-center">:</div>
                              <div class="col-md-8">
                                <input type="text" class="form-control" name="di_pdp" value="{{ old('di_pdp', $unsurpenyidikan->di_pdp ?? '') }}">
                              </div>
                            </div>


                            <hr class="border border-dark border-2 bg-dark">

                            <!-- Rujukan -->
                            <h6 class="text-black">1. RUJUKAN:</h6>
                            <ol class="ps-3 text-black" type="a" style="line-height: 1.5;">
                              <li class="mb-1 ps-1">Pasal 109 Undang-Undang Nomor 8 Tahun 1981 tentang Hukum Acara Pidana;</li>
                              <li class="mb-1 ps-1">Pasal 112 Undang-Undang Nomor 10 Tahun 1995 tentang Kepabeanan sebagaimana telah diubah dengan Undang-Undang Nomor 17 Tahun 2006;</li>
                              <li class="mb-1 ps-1">Pasal 63 Undang-Undang Nomor 11 Tahun 1995 tentang Cukai sebagaimana telah diubah dengan Undang-Undang Nomor 39 Tahun 2007;</li>
                              <li class="mb-1 ps-1">Pasal 5 Peraturan Pemerintah Nomor 55 Tahun 1996 tentang Penyidikan Tindak Pidana Kepabeanan dan Cukai;</li>
                              <li class="mb-1 ps-1">Laporan Kejadian Tindak Pidana Nomor …(11)…;</li>
                              <li class="mb-1 ps-1">Surat Perintah Tugas Penyidikan Nomor …(12)…;</li>
                              <li class="mb-1 ps-1">Surat Pemberitahuan Dimulainya Penyidikan nomor …(13)…;*)</li>
                            </ol>


                            <hr class="border border-dark border-2 bg-dark">

                            <h6 class="text-black" style="line-height: 1.5;">2. Dengan ini Kami memberitahukan bahwa pada hari……...(15)….…., tanggal
                              ………..(16)………, bulan ………(17)……….., tahun ………….(18)…......., telah dimulai
                              Penyidikan Tindak Pidana …………………..……..(19)…………..…………….,
                              yaitu…………………………....……(20)………………………………………………………………
                              …………………………………………………………………………………… Sebagaimana
                              dimaksud dalam Pasal ......…(21)……, Undang-Undang
                              ……………..……(22)………………………., yang diduga dilakukan oleh:
                            </h6>

                            <div class="row mb-3 pt-3">
                              <div class="col-md-4 text-black d-flex align-items-center">Nama Lengkap</div>
                              <div class="col-md-1 text-center d-flex align-items-center justify-content-center">:</div>
                              <div class="col-md-7">
                                <input type="text" class="form-control py-1 border-0" value="{{ old('nama_saksi', $sbpData->nama_saksi) }}" readonly>
                              </div>
                            </div>


                            <div class="row mb-3">
                              <div class="col-md-4 text-black d-flex align-items-center">Tempat /Tanggal Lahir</div>
                              <div class="col-md-1 text-center d-flex align-items-center justify-content-center">:</div>
                              <div class="col-md-7">
                                <input type="text" class="form-control py-1 border-0" value="{{ old('ttl_saksi', $sbpData->ttl_saksi) }}" readonly>
                              </div>
                            </div>

                            <div class="row mb-3">
                              <div class="col-md-4 text-black d-flex align-items-center">Agama</div>
                              <div class="col-md-1 text-center d-flex align-items-center justify-content-center">:</div>
                              <div class="col-md-7">
                                <input type="text" class="form-control py-1 border-0" value="{{ old('agama_saksi', $sbpData->agama_saksi) }}" readonly>
                              </div>
                            </div>

                            <div class="row mb-3">
                              <div class="col-md-4 text-black d-flex align-items-center">Jenis kelamin
                              </div>
                              <div class="col-md-1 text-center d-flex align-items-center justify-content-center">:</div>
                              <div class="col-md-7">
                                <input type="text" class="form-control py-1 border-0" value="{{ old('jk_saksi', $sbpData->jk_saksi) }}" readonly>
                              </div>
                            </div>

                            <div class="row mb-3">
                              <div class="col-md-4 text-black d-flex align-items-center">Kewarganegaraan</div>
                              <div class="col-md-1 text-center d-flex align-items-center justify-content-center">:</div>
                              <div class="col-md-7">
                                <input type="text" class="form-control py-1 border-0" value="{{ old('kewarganegaraan_saksi', $sbpData->kewarganegaraan_saksi) }}" readonly>
                              </div>
                            </div>

                            <div class="row mb-3">
                              <div class="col-md-4 text-black d-flex align-items-center">Pekerjaan saat ini</div>
                              <div class="col-md-1 text-center d-flex align-items-center justify-content-center">:</div>
                              <div class="col-md-7">
                                <input type="text" class="form-control py-1 border-0" value="{{ old('pekerjaan_saksi', $sbpData->pekerjaan_saksi) }}" readonly>
                              </div>
                            </div>

                            <div class="row mb-3">
                              <div class="col-md-4 text-black d-flex align-items-center">Alamat sesuai Identitas</div>
                              <div class="col-md-1 text-center d-flex align-items-center justify-content-center">:</div>
                              <div class="col-md-7">
                                <input type="text" class="form-control py-1 border-0" value="{{ old('alamat_saksi', $sbpData->alamat_saksi) }}" readonly>
                              </div>
                            </div>

                            <div class="row mb-3">
                              <div class="col-md-4 text-black d-flex align-items-center">Jenis/ Nomor Identitas</div>
                              <div class="col-md-1 text-center d-flex align-items-center justify-content-center">:</div>
                              <div class="col-md-7">
                                <input type="text" class="form-control py-1 border-0" value="{{ $sbpData->jenis_iden_saksi . ' / ' . $sbpData->no_identitas_saksi }}" readonly>
                              </div>
                            </div>


                            <div class="row mb-3">
                              <div class="col-md-4 text-black d-flex align-items-center">Pendidikan terakhir</div>
                              <div class="col-md-1 text-center d-flex align-items-center justify-content-center">:</div>
                              <div class="col-md-7">
                                <input type="text" class="form-control py-1 border-0" value="{{ old('pendidikan_terakhir_saksi', $sbpData->pendidikan_terakhir_saksi) }}" readonly>
                              </div>
                            </div>


                            <hr class="border border-dark border-2 bg-dark">

                            <h6 class="text-black">3. Demikian untuk menjadi maklum.</h6>

                            <div class="fw-bold text-center">
                              <h6 class="text-black">Kepala Bidang Penindakan dan Penyidikan, selaku Penyidik</h6>
                              <select class="form-control form-select select2" name="kepala_pdp">
                                <option value="" selected disabled>- Pilih -</option>
                                @foreach ($users as $user)
                                  <option value="{{ $user->id_admin }}" {{ old('kepala_pdp', $unsurpenyidikan->kepala_pdp ?? '') == $user->id_admin ? 'selected' : '' }}>
                                    {{ $user->name }} | {{ $user->jabatan }}
                                  </option>
                                @endforeach
                              </select>
                            </div>


                          </div>
                        </div>
                      </div>
                    </div>




                    <div class="card-footer d-flex justify-content-end">
                      <button type="submit" class="btn btn-success btn-sm me-2">
                        <i data-feather="save"></i> Simpan Data Pelanggaran Ketentuan Lain
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


  <style>
    .nav-link.highlight {
      color: #287F71 !important;
      transition: background-color 0.5s ease;
    }

    .fw-bold {
      color: black !important;
    }

    .col-form-label {
      color: black !important;
    }

    input[readonly] {
      color: black !important;
    }
  </style>


  <script>
    function generateUniqueID() {
      const timestamp = Date.now();
      const randomNum = Math.floor(Math.random() * 1000000);
      return `id_pelanggaran_unsur_pidana_penyidikan${timestamp}_${randomNum}`;
    }

    document.getElementById('id_pelanggaran_unsur_pidana_penyidikan').value = generateUniqueID();
  </script>
@endsection

@section('script')
  @vite(['resources/js/pages/datatable.init.js'])
@endsection
