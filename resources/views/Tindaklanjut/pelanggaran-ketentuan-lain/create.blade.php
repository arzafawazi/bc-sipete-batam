@extends('layouts.vertical', ['title' => 'Rekam Pelanggaran Ketentuan Lain'])

@section('css')
  @vite(['node_modules/datatables.net-bs5/css/dataTables.bootstrap5.min.css', 'node_modules/datatables.net-buttons-bs5/css/buttons.bootstrap5.min.css', 'node_modules/datatables.net-keytable-bs5/css/keyTable.bootstrap5.min.css', 'node_modules/datatables.net-responsive-bs5/css/responsive.bootstrap5.min.css', 'node_modules/datatables.net-select-bs5/css/select.bootstrap5.min.css'])
@endsection
@section('content')
  <div class="container-fluid">
    <form action="{{ route('pelanggaran-ketentuan-lain.store') }}" method="POST">
      @csrf
      <div class="card mb-3 mt-4">
        <div class="card-header d-flex justify-content-between align-items-center">
          <h5 class="card-title mb-0">
            <i data-feather="book" style="width: 20px; height: 20px;" class="me-1"></i>
            Form Rekam Data Pelanggaran Ketentuan Lain
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
                    <ul class="nav nav-pills nav-justified flex-nowrap " style="white-space: nowrap;" role="tablist">
                      <li class="nav-item">
                        <a class="nav-link active" id="navtabs2-bast-instansi-lain-tab" data-bs-toggle="tab" href="#navtabs2-bast-instansi-lain" role="tab" aria-controls="navtabs2-bast-instansi-lain" aria-selected="true">
                          <span class="d-block d-sm-none">(BAST INSTANSI)</span>
                          <span class="d-none d-sm-block">BAST KE INSTANSI LAIN</span>
                        </a>
                      </li>
                    </ul>
                  </div>

                  <input type="hidden" id="id_pelanggaran_ketentuan_lain" name="id_pelanggaran_ketentuan_lain" value="">
                  <input type="hidden" name="id_penyidikan_ref" value="{{ $id_penyidikan }}" readonly>


                  <div class="tab-content p-3 text-muted">

                    <div class="tab-pane active" id="navtabs2-bast-instansi-lain" role="tabpanel">
                      <div class="container mt-4">
                        <!-- Header with Logo -->
                        <div class="row mb-4 align-items-center">
                          <div class="col-2 text-center">
                            <img src="/images/logocop.png" alt="Logo" class="img-fluid" style="max-height:170px;">
                          </div>
                          <div class="col-10 text-center">
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


                        <div class="mb-3 row align-items-center">
                          <div class="input-group">
                            <span class="input-group-text">NO : BAST-</span>
                            <input type="text" class="form-control" value="{{ old('no_bast_instansi_lain_pkl', $no_ref->no_bast_instansi_lain_pkl) }}" name="no_bast_instansi_lain_pkl" readonly>
                            <span class="input-group-text">/KPU.02/BD.06/</span>
                            <input type="date" class="form-control" name="tgl_bast_instansi_lain_pkl">
                          </div>
                        </div>


                        <!-- Main Form -->
                        <div class="card p-4">
                          <p class="fw-bold">
                            &nbsp;&nbsp;&nbsp;Pada hari ini ................... Saya/Kami* yang bertanda tangan di bawah bertindak untuk/ atas nama Kantor Pelayanan Utama Bea dan Cukai Tipe B Batam
                            Telah menyerahkan:
                          </p>
                          <div class="card-body">
                            <div class="row">
                              <div class="col-lg-12">
                                <div class="container">

                                  <!-- Sarana Pengangkut -->
                                  <h5 class="fw-bold">1. Sarana Pengangkut</h5>
                                  <div class="mb-3 row">
                                    <label class="col-md-3 col-form-label">Nama dan Jenis Sarkut</label>
                                    <div class=" col-md-1 text-center mt-1">:</div>
                                    <div class="col-md-8">
                                      <input type="text" class="form-control border-0 border-0" value="{{ old('nama_jenis_sarkut', $sbpData->nama_jenis_sarkut) }}" readonly>
                                    </div>
                                  </div>
                                  <div class="mb-3 row">
                                    <label class="col-md-3 col-form-label">Ukuran/ Kapasitas Muatan</label>
                                    <div class=" col-md-1 text-center mt-1">:</div>
                                    <div class="col-md-8">
                                      <input type="text" class="form-control border-0" value="{{ old('kapasitas_muatan', $sbpData->kapasitas_muatan) }}" readonly>
                                    </div>
                                  </div>
                                  <div class="mb-4 row">
                                    <label class="col-md-3 col-form-label">No Reg./ No. Polisi</label>
                                    <div class=" col-md-1 text-center mt-1">:</div>
                                    <div class="col-md-8">
                                      <input type="text" class="form-control border-0" value="{{ old('no_polisi', $sbpData->no_polisi) }}" readonly>
                                    </div>
                                  </div>

                                  <!-- Barang -->
                                  <h5 class="fw-bold">2. Barang</h5>
                                  <div class="mb-3 row">
                                    <label class="col-md-3 col-form-label">Jumlah/Jenis Barang</label>
                                    <div class=" col-md-1 text-center mt-1">:</div>
                                    <div class="col-md-4">
                                      <input type="text" class="form-control border-0" value="{{ old('jumlah_barang', $sbpData->jumlah_barang) }}" readonly>
                                    </div>
                                    <div class="col-md-4">
                                      <input type="text" class="form-control border-0" value="{{ old('jenis_barang', $sbpData->jenis_barang) }}" readonly>
                                    </div>
                                  </div>
                                  <div class="mb-4 row">
                                    <label class="col-md-3 col-form-label">Jenis/No dan Tgl Dokumen</label>
                                    <div class=" col-md-1 text-center mt-1">:</div>
                                    <div class="col-md-4">
                                      <input type="text" class="form-control border-0" value="{{ old('jenis_no_tgl_dok', $sbpData->jenis_no_tgl_dok) }}" readonly>
                                    </div>
                                    <div class="col-md-4">
                                      <input type="date" class="form-control border-0" value="{{ old('tgl_dokumen', $sbpData->tgl_dokumen) }}" readonly>
                                    </div>
                                  </div>

                                  <!-- Orang -->
                                  <h5 class="fw-bold">3. Orang</h5>
                                  <div class="mb-3 row">
                                    <label class="col-md-3 col-form-label">Nama</label>
                                    <div class=" col-md-1 text-center mt-1">:</div>
                                    <div class="col-md-8">
                                      <input type="text" class="form-control border-0" value="{{ old('nama_saksi', $sbpData->nama_saksi) }}" readonly>
                                    </div>
                                  </div>
                                  <div class="mb-3 row">
                                    <label class="col-md-3 col-form-label">Tanggal Lahir</label>
                                    <div class=" col-md-1 text-center mt-1">:</div>
                                    <div class="col-md-8">
                                      <input type="text" class="form-control border-0" value="{{ old('ttl_saksi', $sbpData->ttl_saksi) }}" readonly>
                                    </div>
                                  </div>
                                  <div class="mb-3 row">
                                    <label class="col-md-3 col-form-label">Kewarganegaraan</label>
                                    <div class=" col-md-1 text-center mt-1">:</div>
                                    <div class="col-md-8">
                                      <input type="text" class="form-control border-0" value="{{ old('kewarganegaraan_saksi', $sbpData->kewarganegaraan_saksi) }}" readonly>
                                    </div>
                                  </div>
                                  <div class="mb-3 row">
                                    <label class="col-md-3 col-form-label">No. Identitas</label>
                                    <div class=" col-md-1 text-center mt-1">:</div>
                                    <div class="col-md-8">
                                      <input type="text" class="form-control border-0" value="{{ old('no_identitas_saksi', $sbpData->no_identitas_saksi) }}" readonly>
                                    </div>
                                  </div>


                                  <h5 class="fw-bold">Diserahkan Kepada</h5>

                                  <div class="mb-3 row">
                                    <label class="col-md-3 col-form-label">Nama</label>
                                    <div class=" col-md-1 text-center mt-1">:</div>
                                    <div class="col-md-8">
                                      <input type="text" class="form-control" placeholder="Nama Orang Yang Padanya Dilakukan Serah Terima" name="nama_bast_instansi_pkl">
                                    </div>
                                  </div>

                                  <div class="mb-3 row">
                                    <label class="col-md-3 col-form-label">Jenis Identitas</label>
                                    <div class=" col-md-1 text-center mt-1">:</div>
                                    <div class="col-md-8">
                                      <input type="text" class="form-control" placeholder="Jenis Identitas Yang Padanya Dilakukan Serah Terima" name="jenis_iden_bast_instansi_pkl">
                                    </div>
                                  </div>

                                  <div class="mb-3 row">
                                    <label class="col-md-3 col-form-label">NRP/Identitas</label>
                                    <div class=" col-md-1 text-center mt-1">:</div>
                                    <div class="col-md-8">
                                      <input type="text" class="form-control" placeholder="Nomor Identitas Yang Padanya Dilakukan Serah Terima" name="iden_bast_instansi_pkl">
                                    </div>
                                  </div>


                                  <div class="mb-3 row">
                                    <label class="col-md-3 col-form-label">Menerima penyerahan untuk/atas nama</label>
                                    <div class=" col-md-1 text-center mt-1">:</div>
                                    <div class="col-md-8">
                                      <input type="text" class="form-control" placeholder="Menerima penyerahan untuk/atas nama" name="atas_nama_bast_instansi_pkl">
                                    </div>
                                  </div>

                                  <div class="mb-3 row">
                                    <label class="col-md-3 col-form-label">Penyerahan dilaksanakan dalam rangka</label>
                                    <div class=" col-md-1 text-center mt-1">:</div>
                                    <div class="col-md-8">
                                      <textarea class="form-control" rows="3" placeholder="Penyerahan dilaksanakan dalam rangka" name="dilaksanakan_dalam_rangka_bast_instansi_pkl"></textarea>
                                    </div>
                                  </div>

                                  <p class="fw-bold">
                                    Demikian Berita Acara ini dibuat dengan sebenarnya.
                                  </p>

                                  <div class="mb-3 row">
                                    <label class="col-md-3 col-form-label">Pejabat Yang Menyerahkan</label>
                                    <div class=" col-md-1 text-center mt-1">:</div>
                                    <div class="col-md-8">
                                      <select class="form-control form-select select2" name="pejabat_menyerahkan_bast_instansi_pkl">
                                        <option value="" selected disabled>- Pilih -</option>
                                        @foreach ($users as $user)
                                          <option value="{{ $user->id_admin }}">{{ $user->name }} | {{ $user->jabatan }}</option>
                                        @endforeach
                                      </select>
                                    </div>
                                  </div>

                                  <div class="mb-3 row">
                                    <label class="col-md-3 col-form-label">Saksi Pertama</label>
                                    <div class=" col-md-1 text-center mt-1">:</div>
                                    <div class="col-md-8">
                                      <select class="form-control form-select select2" name="saksi_pertama_bast_instansi_pkl">
                                        <option value="" selected disabled>- Pilih -</option>
                                        @foreach ($users as $user)
                                          <option value="{{ $user->id_admin }}">{{ $user->name }} | {{ $user->jabatan }}</option>
                                        @endforeach
                                      </select>
                                    </div>
                                  </div>


                                  <div class="mb-3 row">
                                    <label class="col-md-3 col-form-label">Saksi Kedua</label>
                                    <div class=" col-md-1 text-center mt-1">:</div>
                                    <div class="col-md-8">
                                      <select class="form-control form-select select2" name="saksi_kedua_bast_instansi_pkl">
                                        <option value="" selected disabled>- Pilih -</option>
                                        @foreach ($users as $user)
                                          <option value="{{ $user->id_admin }}">{{ $user->name }} | {{ $user->jabatan }}</option>
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
  </style>


  <script>
    function generateUniqueID() {
      const timestamp = Date.now();
      const randomNum = Math.floor(Math.random() * 1000000);
      return `id_pelanggaran_ketentuan_lain_${timestamp}_${randomNum}`;
    }

    document.getElementById('id_pelanggaran_ketentuan_lain').value = generateUniqueID();
  </script>
@endsection

@section('script')
  @vite(['resources/js/pages/datatable.init.js'])
@endsection
