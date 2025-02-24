@extends('layouts.vertical', ['title' => 'Rekam Pelanggaran Administrasi'])

@section('css')
  @vite(['node_modules/datatables.net-bs5/css/dataTables.bootstrap5.min.css', 'node_modules/datatables.net-buttons-bs5/css/buttons.bootstrap5.min.css', 'node_modules/datatables.net-keytable-bs5/css/keyTable.bootstrap5.min.css', 'node_modules/datatables.net-responsive-bs5/css/responsive.bootstrap5.min.css', 'node_modules/datatables.net-select-bs5/css/select.bootstrap5.min.css'])
@endsection
@section('content')
  <div class="container-fluid">
    <form action="{{ route('pelanggaran-administrasi.store') }}" method="POST" enctype="multipart/form-data">
      @csrf
      <div class="card mb-3 mt-4">
        <div class="card-header d-flex justify-content-between align-items-center">
          <h5 class="card-title mb-0">
            <i data-feather="book" style="width: 20px; height: 20px;" class="me-1"></i>
            Form Rekam Data Pelanggaran Administrasi
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
                    <ul class="nav nav-pills nav-justified flex-nowrap" style="white-space: nowrap;" role="tablist">
                      <li class="nav-item">
                        <a class="nav-link active" id="navtabs2-ppftz-tab" data-bs-toggle="tab" href="#navtabs2-ppftz" role="tab" aria-controls="navtabs2-ppftz" aria-selected="true">
                          <span class="d-block d-sm-none">Pelanggaran Administrasi</span>
                          <span class="d-none d-sm-block">Pelanggaran Administrasi</span>
                        </a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" id="navtabs2-bast-pemilik-tab" data-bs-toggle="tab" href="#navtabs2-bast-pemilik" role="tab" aria-controls="navtabs2-bast-pemilik" aria-selected="false">
                          <span class="d-block d-sm-none">Bast Pemilik</span>
                          <span class="d-none d-sm-block">Bast Pemilik</span>
                        </a>
                      </li>
                    </ul>
                  </div>


                  <div class="tab-content p-3 text-muted">


                    <div class="tab-pane active" id="navtabs2-ppftz" role="tabpanel">
                      <div class="container mt-4">
                        <!-- Header with Logo -->
                        <div class="row mb-4 align-items-center text-black">
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

                        <input type="hidden" id="id_pelanggaran_administrasi" name="id_pelanggaran_administrasi" value="">
                        <input type="hidden" name="id_penyidikan_ref" value="{{ $id_penyidikan }}" readonly>

                        <div class="container">
                          <div class="row justify-content-center">
                            <!-- Kolom pertama -->
                            <label for="tgl_pelanggaran_administrasi">Tanggal Pelanggaran Administrasi</label>
                            <div class="mb-3 col-sm-13">
                              <input type="date" class="form-control" name="tgl_pelanggaran_administrasi" id="tgl_pelanggaran_administrasi">
                            </div>
                          </div>
                        </div>

                        <!-- Main Form -->
                        <div class="card p-4">
                          <div class="card-body">
                            <div class="row">
                              <div class="col-lg-12">
                                <div class="container">


                                  <h5 class="fw-bold">Barang Yang Terkena Pelanggaran Administrasi</h5>

                                  <div class="mb-3 row">
                                    <label class="col-md-3 col-form-label">Nama Barang</label>
                                    <div class="col-md-1 text-center mt-1">:</div>
                                    <div class="col-md-8">
                                      <div class="border rounded p-2" style="max-height: 200px; overflow-y: auto;">
                                        <table id="fixed-header-datatable" class="table table-hover align-middle border-separate">
                                          <thead>
                                            <tr>
                                              <th>Pilih</th>
                                              <th>Kode Komoditi</th>
                                              <th>Jenis Barang</th>
                                            </tr>
                                          </thead>
                                          <tbody>
                                            @foreach ($barang as $barang)
                                              <tr>
                                                <td>
                                                  <input class="form-check-input" type="checkbox" name="id_barang_pelanggaran_administrasi[]" value="{{ $barang->id }}" id="barang_{{ $barang->id }}">
                                                </td>
                                                <td>{{ $barang->kode_komoditi }}</td>
                                                <td>{{ $barang->jenis_barang }}</td>
                                              </tr>
                                            @endforeach
                                          </tbody>
                                        </table>
                                      </div>
                                    </div>
                                  </div>


                                  <div class="mb-3 row">
                                    <label class="col-md-3 col-form-label">Jenis Pelanggaran</label>
                                    <div class="col-md-1 text-center mt-1"> :</div>
                                    <div class="col-md-8">
                                      <select class="form-control form-select select2" name="jenis_pelanggaran_administrasi" id="jenis_pelanggaran">
                                        <option value="" selected disabled>- Pilih -</option>
                                        <option value="Pembuatan Dokumen PPFTZ-01">Pembuatan Dokumen PPFTZ-01</option>
                                        <option value="Barang Yang Dikuasai Negara (BDN)">Barang Yang Dikuasai Negara (BDN)</option>
                                        <option value="Re-Ekspor/Pembatalan Dokumen">Re-Ekspor/Pembatalan Dokumen</option>
                                        <option value="Sanksi Administrasi SPSA">Sanksi Administrasi SPSA</option>
                                        <option value="Pemenuhan Dokumen lartas">Pemenuhan Dokumen Lartas</option>
                                      </select>
                                    </div>
                                  </div>

                                  <div id="upload-ppftz-container" style="display: none;">
                                    <div class="mb-3 row">
                                      <label class="col-md-3 col-form-label">Permohonan Pembuatan Dokumen Kepabeanan</label>
                                      <div class="col-md-1 text-center mt-1"> :</div>
                                      <div class="col-md-8">
                                        <input type="file" class="form-control" name="permohonan_dokumen_kepabeanan_ppftz">
                                      </div>
                                    </div>
                                    <div class="mb-3 row">
                                      <label class="col-md-3 col-form-label">Bukti Penerimaan Negara</label>
                                      <div class="col-md-1 text-center mt-1"> :</div>
                                      <div class="col-md-8">
                                        <input type="file" class="form-control" name="bukti_penerimaan_negara_ppftz">
                                      </div>
                                    </div>
                                    <div class="mb-3 row">
                                      <label class="col-md-3 col-form-label">Dokumen PPFTZ</label>
                                      <div class="col-md-1 text-center mt-1"> :</div>
                                      <div class="col-md-8">
                                        <input type="file" class="form-control" name="dokumen_ppftz">
                                      </div>
                                    </div>
                                  </div>

                                  <div id="upload-bdn-container" style="display: none;">
                                    <div class="mb-3 row">
                                      <label class="col-md-3 col-form-label">Keputusan BDN</label>
                                      <div class="col-md-1 text-center mt-1"> :</div>
                                      <div class="col-md-8">
                                        <input type="file" class="form-control" name="keputusan_bdn">
                                      </div>
                                    </div>
                                    <div class="mb-3 row">
                                      <label class="col-md-3 col-form-label">BAST BDN Ke TPP</label>
                                      <div class="col-md-1 text-center mt-1"> :</div>
                                      <div class="col-md-8">
                                        <input type="file" class="form-control" name="bast_bdn">
                                      </div>
                                    </div>
                                  </div>

                                  <div id="upload-reekspor-container" style="display: none;">
                                    <div class="mb-3 row">
                                      <label class="col-md-3 col-form-label">Surat Permohonan Reekspor</label>
                                      <div class="col-md-1 text-center mt-1"> :</div>
                                      <div class="col-md-8">
                                        <input type="file" class="form-control" name="surat_permohonan_reekspor">
                                      </div>
                                    </div>
                                    <div class="mb-3 row">
                                      <label class="col-md-3 col-form-label">Dokumen PPFTZ</label>
                                      <div class="col-md-1 text-center mt-1"> :</div>
                                      <div class="col-md-8">
                                        <input type="file" class="form-control" name="dokumen_ppftz_reekspor">
                                      </div>
                                    </div>
                                    <div class="mb-3 row">
                                      <label class="col-md-3 col-form-label">Penelitian Dokumen</label>
                                      <div class="col-md-1 text-center mt-1"> :</div>
                                      <div class="col-md-8">
                                        <input type="file" class="form-control" name="penelitian_dokumen_reekspor">
                                      </div>
                                    </div>
                                  </div>

                                  <div id="upload-spsa-container" style="display: none;">
                                    <div class="mb-3 row">
                                      <label class="col-md-3 col-form-label">Pemberitahuan Penerbitan SPSA</label>
                                      <div class="col-md-1 text-center mt-1"> :</div>
                                      <div class="col-md-8">
                                        <input type="file" class="form-control" name="penerbitan_spsa">
                                      </div>
                                    </div>
                                    <div class="mb-3 row">
                                      <label class="col-md-3 col-form-label">Surat SPSA</label>
                                      <div class="col-md-1 text-center mt-1"> :</div>
                                      <div class="col-md-8">
                                        <input type="file" class="form-control" name="surat_spsa">
                                      </div>
                                    </div>
                                    <div class="mb-3 row">
                                      <label class="col-md-3 col-form-label">Surat Billing DJBC</label>
                                      <div class="col-md-1 text-center mt-1"> :</div>
                                      <div class="col-md-8">
                                        <input type="file" class="form-control" name="billing_djbc_spsa">
                                      </div>
                                    </div>
                                    <div class="mb-3 row">
                                      <label class="col-md-3 col-form-label">Bukti Transaksi</label>
                                      <div class="col-md-1 text-center mt-1"> :</div>
                                      <div class="col-md-8">
                                        <input type="file" class="form-control" name="bukti_transaksi_spsa">
                                      </div>
                                    </div>
                                  </div>


                                  <div id="upload-lartas-container" style="display: none;">
                                    <div class="mb-3 row">
                                      <label class="col-md-3 col-form-label">Dokumen Lartas Dari Instansi Lain</label>
                                      <div class="col-md-1 text-center mt-1"> :</div>
                                      <div class="col-md-8">
                                        <input type="file" class="form-control" name="dokumen_lartas">
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


                    <div class="tab-pane" id="navtabs2-bast-pemilik" role="tabpanel">
                      <div class="container mt-4">
                        <!-- Header with Logo -->
                        <div class="row mb-4 align-items-center text-black">
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

                        <h5 class="fw-bold text-center">Berita Acara Serah Terima</h5>

                        <div class="container">
                          <div class="row justify-content-center">
                            <!-- Kolom pertama -->
                            <label for="tgl_pelanggaran_administrasi">Tanggal Berita Acara Serah terima</label>
                            <div class="mb-3 col-sm-13">
                              <input type="date" class="form-control" name="tgl_bast_pemilik">
                            </div>
                          </div>
                        </div>

                        <div class="card p-4">
                          <p class="fw-bold">
                            &nbsp;&nbsp;&nbsp;Pada hari ini ...................................... bertempat di Kantor Pelayanan Utama Bea dan Cukai Tipe B Batam, saya :
                          </p>
                          <div class="fw-bold text-center">
                            <select class="form-control form-select select2" name="pejabat_bast_1">
                              <option value="" selected disabled>- Pilih -</option>
                              @foreach ($users as $user)
                                <option value="{{ $user->id_admin }}">{{ $user->name }} | {{ $user->jabatan }}</option>
                              @endforeach
                            </select>
                          </div>
                          <br>
                          <p class="fw-bold">
                            &nbsp;&nbsp;&nbsp;pada Kantor Pelayanan Utama Bea dan Cukai Tipe B Batam, ......................................
                          </p>
                          <div class="text-center">
                            <textarea class="form-control" rows="5" placeholder="Keterangan Berita Acara Serah Terima" name="ket_ba_pemilik_tl"></textarea>
                          </div>
                          <br>
                          <p class="fw-bold">
                            &nbsp;&nbsp;&nbsp;Barang sebagaimana dimaksud telah diserahkan dalam keadaan baik dan lengkap kepada :
                          </p>

                          <div class="mb-3 row">
                            <label class="col-md-3 col-form-label">Nama</label>
                            <div class="col-md-1 text-center mt-1">:</div>
                            <div class="col-md-8">
                              <input type="text" class="form-control border-0" value="{{ old('nama_saksi', $sbpData->nama_saksi) }}" readonly>
                            </div>
                          </div>
                          <div class="mb-3 row">
                            <label class="col-md-3 col-form-label">Pekerjaan</label>
                            <div class="col-md-1 text-center mt-1">:</div>
                            <div class="col-md-8">
                              <input type="text" class="form-control border-0" value="{{ old('pekerjaan_saksi', $sbpData->pekerjaan_saksi) }}" readonly>
                            </div>
                          </div>
                          <div class="mb-3 row">
                            <label class="col-md-3 col-form-label">Alamat</label>
                            <div class="col-md-1 text-center mt-1">:</div>
                            <div class="col-md-8">
                              <input type="text" class="form-control border-0" value="{{ old('alamat_saksi', $sbpData->alamat_saksi) }}" readonly>
                            </div>
                          </div>
                          <p class="fw-bold">
                            &nbsp;&nbsp;&nbsp; Serah terima ini dilakukan di Gudang Importir dengan disaksikan oleh :
                          </p>
                          <div class="mb-3 row">
                            <label class="col-md-3 col-form-label">Saksi Pertama</label>
                            <div class="col-md-1 text-center mt-1">:</div>
                            <div class="col-md-8">
                              <select class="form-control form-select select2" name="pejabat_bast_2">
                                <option value="" selected disabled>- Pilih -</option>
                                @foreach ($users as $user)
                                  <option value="{{ $user->id_admin }}">{{ $user->name }} | {{ $user->jabatan }}</option>
                                @endforeach
                              </select>
                            </div>
                          </div>
                          <div class="mb-3 row">
                            <label class="col-md-3 col-form-label">Saksi Kedua</label>
                            <div class="col-md-1 text-center mt-1">:</div>
                            <div class="col-md-8">
                              <select class="form-control form-select select2" name="pejabat_bast_3">
                                <option value="" selected disabled>- Pilih -</option>
                                @foreach ($users as $user)
                                  <option value="{{ $user->id_admin }}">{{ $user->name }} | {{ $user->jabatan }}</option>
                                @endforeach
                              </select>
                            </div>
                          </div>
                          <p class="fw-bold">
                            &nbsp;&nbsp;&nbsp; Demikian Berita Acara Serah Terima ini dibuat dengan sebenarnya atas kekuatan sumpah jabatan, kemudian ditutup dan ditandatangani di Batam pada hari dan tanggal seperti tersebut diatas.
                          </p>


                        </div>
                      </div>
                    </div>



                    <div class="card-footer d-flex justify-content-end">
                      <button type="submit" class="btn btn-primary btn-sm me-2">
                        <i data-feather="save"></i> Simpan Data Pelanggaran Administrasi
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
    function generateUniqueID() {
      const timestamp = Date.now();
      const randomNum = Math.floor(Math.random() * 1000000);
      return `id_pelanggaran_administrasi_${timestamp}_${randomNum}`;
    }

    document.getElementById('id_pelanggaran_administrasi').value = generateUniqueID();
  </script>


  <script>
    document.addEventListener("DOMContentLoaded", function() {
      let jenisPelanggaran = document.getElementById("jenis_pelanggaran");
      let uploadPpftzContainer = document.getElementById("upload-ppftz-container");
      let uploadBdnContainer = document.getElementById("upload-bdn-container");
      let uploadReeksporContainer = document.getElementById("upload-reekspor-container");
      let uploadSpsaContainer = document.getElementById("upload-spsa-container");
      let uploadLartasContainer = document.getElementById("upload-lartas-container");

      function toggleUploadContainer(value) {
        if (value === "Pembuatan Dokumen PPFTZ-01") {
          uploadPpftzContainer.style.display = "block";
          uploadBdnContainer.style.display = "none";
          uploadReeksporContainer.style.display = "none";
          uploadSpsaContainer.style.display = "none";
          uploadLartasContainer.style.display = "none";
        } else if (value === "Barang Yang Dikuasai Negara (BDN)") {
          uploadPpftzContainer.style.display = "none";
          uploadBdnContainer.style.display = "block";
          uploadReeksporContainer.style.display = "none";
          uploadSpsaContainer.style.display = "none";
          uploadLartasContainer.style.display = "none";
        } else if (value === "Re-Ekspor/Pembatalan Dokumen") {
          uploadPpftzContainer.style.display = "none";
          uploadBdnContainer.style.display = "none";
          uploadReeksporContainer.style.display = "block";
          uploadSpsaContainer.style.display = "none";
          uploadLartasContainer.style.display = "none";
        } else if (value === "Sanksi Administrasi SPSA") {
          uploadPpftzContainer.style.display = "none";
          uploadBdnContainer.style.display = "none";
          uploadReeksporContainer.style.display = "none";
          uploadSpsaContainer.style.display = "block";
          uploadLartasContainer.style.display = "none";
        } else if (value === "Pemenuhan Dokumen lartas") {
          uploadPpftzContainer.style.display = "none";
          uploadBdnContainer.style.display = "none";
          uploadReeksporContainer.style.display = "none";
          uploadSpsaContainer.style.display = "none";
          uploadLartasContainer.style.display = "block";
        } else {
          uploadPpftzContainer.style.display = "none";
          uploadBdnContainer.style.display = "none";
          uploadReeksporContainer.style.display = "none";
          uploadSpsaContainer.style.display = "none";
          uploadLartasContainer.style.display = "none";
        }
      }

      jenisPelanggaran.addEventListener("change", function() {
        toggleUploadContainer(this.value);
      });

      $(jenisPelanggaran).on("select2:select", function(e) {
        toggleUploadContainer(e.params.data.id);
      });
    });
  </script>

  <script>
    document.addEventListener('DOMContentLoaded', function() {
      const bastPemilikTab = document.getElementById('navtabs2-bast-pemilik-tab');
      const jenisSelect = document.getElementById('jenis_pelanggaran');

      const showTabValues = [
        'Pembuatan Dokumen PPFTZ-01',
        'Re-Ekspor/Pembatalan Dokumen',
        'Sanksi Administrasi SPSA',
        'Pemenuhan Dokumen lartas'
      ];

      handleTabVisibility();

      $('#jenis_pelanggaran').on('change', function() {
        handleTabVisibility();
      });

      function handleTabVisibility() {
        const selectedValue = $('#jenis_pelanggaran').val();

        if (showTabValues.includes(selectedValue)) {
          $(bastPemilikTab).closest('li').show();
        } else {
          $(bastPemilikTab).closest('li').hide();

          if ($(bastPemilikTab).hasClass('active')) {
            const firstVisibleTab = $('.nav-link:visible').first();
            if (firstVisibleTab.length) {
              firstVisibleTab.tab('show');
            }
          }
        }
      }
    });
  </script>

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
@endsection

@section('script')
  @vite(['resources/js/pages/datatable.init.js'])
@endsection
