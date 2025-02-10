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
                    <ul class="nav nav-pills nav-justified flex-nowrap overflow-auto" style="white-space: nowrap;" role="tablist">
                      <li class="nav-item">
                        <a class="nav-link active" id="navtabs2-bast-instansi-lain-tab" data-bs-toggle="tab" href="#navtabs2-bast-instansi-lain" role="tab" aria-controls="navtabs2-bast-instansi-lain" aria-selected="true">
                          <span class="d-block d-sm-none">(BAST INSTANSI)</span>
                          <span class="d-none d-sm-block">BAST Ke Instansi Lain</span>
                        </a>
                      </li>
                    </ul>
                  </div>


                  <div class="tab-content p-3 text-muted">

                    <div class="tab-pane active" id="navtabs2-bast-instansi-lain" role="tabpanel">
                      <div class="container mt-4">
                        <!-- Header with Logo -->
                        <div class="row mb-4">
                          <div class="col-12 text-center">
                            <img src="/api/placeholder/80/80" alt="Logo" class="mb-2">
                            <h5 class="text-center mb-0">KEMENTERIAN KEUANGAN REPUBLIK INDONESIA</h5>
                            <p class="text-center small mb-0">DIREKTORAT JENDERAL BEA DAN CUKAI</p>
                            <p class="text-center small">KANTOR WILAYAH DJBC JAWA TIMUR II</p>
                          </div>
                        </div>

                        <div class="mb-3 row align-items-center">
                          <div class="input-group">
                            <span class="input-group-text">NO : BAST-</span>
                            <input type="text" class="form-control" name="input_angka" placeholder="Masukkan angka" required>
                            <span class="input-group-text">/KPU.02/BD.06/</span>
                            <input type="date" class="form-control" name="input_tanggal" required>
                          </div>
                        </div>


                        <!-- Main Form -->
                        <div class="card">
                          <p class="fw-bold">
                            Pada hari ini ................... Saya/Kami* yang bertanda tangan di bawah bertindak untuk/ atas nama Kantor Pelayanan Utama Bea dan Cukai Tipe B Batam
                            Telah menyerahkan:
                          </p>
                          <div class="card-body">
                            <div class="row">
                              <!-- Left Column -->
                              <div class="col-lg-6 ">

                                <hr class="mb-4">

                                <div class="row">

                                  <input type="hidden" id="id_pelanggaran_ketentuan_lain" name="id_pelanggaran_ketentuan_lain" value="">
                                  <input type="hidden" name="id_penyidikan_ref" value="{{ $penyidikan->id_penyidikan }}" readonly>

                                  <div class="col-12 mb-3">
                                    <label class="form-label fw-semibold">Pengendali Operasi</label>
                                    <select class="form-control form-select select2" id="pengendali_operasi" name="pengendali_operasi_st">
                                      <option value="" selected disabled>- Pilih -</option>
                                    </select>
                                  </div>

                                  <div class="col-12 mb-3">
                                    <label class="form-label fw-semibold">Tim Operasi</label>
                                    <select class="form-control form-select select2" id="tim_operasi" name="tim_operasi_st[]" multiple>
                                    </select>
                                  </div>

                                  <div class="col-12 mb-3">
                                    <label class="form-label fw-semibold">Tim Dukungan Operasi</label>
                                    <select class="form-control form-select select2" id="tim_dukungan_operasi" name="tim_dukungan_operasi_st[]" multiple>
                                    </select>
                                  </div>
                                </div>
                                <hr class="mb-4">
                              </div>

                              <div class="card mb-3">
                                <div class="card-body">
                                  <h6 class="fw-bold">Untuk melaksanakan tugas sebagai berikut:</h6>
                                  <ol class="ps-3" start="2" style="line-height: 1.5;">
                                    <li class="mb-1">Melakukan penggalangan informan dalam hal diperlukan dalam proses pengumpulan dan pendalaman informasi.</li>
                                    <li class="mb-1">Melakukan tindakan pengamanan pertama apabila ditemukan adanya indikasi pelanggaran di bidang kepabeanan dan/atau cukai.</li>
                                    <li class="mb-1">Melakukan tindakan lainnya dan mengambil langkah-langkah sesuai peraturan perundangan guna mengamankan hak-hak negara, apabila dalam pelaksanaan tugas ditemukan adanya pelanggaran ketentuan
                                      dan/atau
                                      tindak pidana di bidang kepabeanan dan/atau cukai.</li>
                                    <li class="mb-1">Melakukan koordinasi dengan pihak eksternal atau Bidang Penindakan dan Penyidikan pada Kantor Wilayah (Kanwil) DJBC setempat apabila dipandang perlu.</li>
                                    <li class="mb-1">Membuat laporan pelaksanaan tugas.</li>
                                    <li class="mb-1">Melakukan tugas dan kewajiban sesuai dengan tugas pokok dan fungsinya masing-masing serta dilaksanakan dengan penuh rasa tanggung jawab.</li>
                                  </ol>
                                </div>
                              </div>



                              <div class="mb-3">
                                <label class="form-label fw-semibold d-flex align-items-center">
                                  Melaksanakan Tugas
                                  <button type="button" class="btn btn-link p-0 ms-1" data-bs-toggle="tooltip" data-bs-placement="top" title="1.Isi Bagian Nomor 1 Pada inputan ini">
                                    <i class="bi bi-info-circle"></i>
                                  </button>
                                </label>
                                <textarea class="form-control" name="melaksanakan_tugas_st" rows="3" placeholder="1.Isi Bagian Nomor 1 Pada inputan ini"></textarea>
                              </div>

                              <div class="card mb-3">
                                <div class="card-body">
                                  <!-- Wilayah Penugasan -->
                                  <div class="mb-3 row align-items-center">
                                    <label class="col-md-3 col-form-label fw-semibold text-md-start">Wilayah Penugasan :</label>
                                    <div class="col-md-8">
                                      <input type="text" class="form-control" name="wilayah_penugasan_st" placeholder="Wilayah Pengawasan KPU Bea dan Cukai Tipe B Batam" value="Wilayah Pengawasan KPU Bea dan Cukai Tipe B Batam">
                                    </div>
                                  </div>

                                  <!-- Periode Penugasan (Tanggal Dimulai & Tanggal Berakhir dalam satu baris) -->
                                  <div class="mb-3 row align-items-center">
                                    <label class="col-md-3 col-form-label fw-semibold text-md-start">Periode Penugasan :</label>
                                    <div class="col-md-4">
                                      <input type="date" class="form-control" name="tanggal_dimulai_st">
                                    </div>
                                    <div class="col-md-1 text-center fw-semibold">s.d</div>
                                    <div class="col-md-4">
                                      <input type="date" class="form-control" name="tanggal_berakhir_st">
                                    </div>
                                  </div>

                                  <!-- Ketentuan -->
                                  <div class="mb-3 row">
                                    <label class="col-md-3 col-form-label fw-bold text-md-start">Ketentuan :</label>
                                    <div class="col-md-8">
                                      <ol class="mb-0 ps-3" start="1" style="line-height: 1.5;">
                                        <li class="mb-1">Surat Tugas ini bersifat rahasia dan terbatas untuk pihak yang berkepentingan;</li>
                                        <li class="mb-1">Sifat kegiatan intelijen tertutup/terbuka;</li>
                                        <li class="mb-1">Berpakaian PDH/non-PDH;</li>
                                        <li class="mb-1">Dapat dilengkapi dengan senjata api dinas.</li>
                                      </ol>
                                    </div>
                                  </div>

                                  <h6 class="fw-bold">&nbsp;&nbsp;&nbsp;Biaya yang digunakan untuk pelaksanaan surat tugas ini dibebankan pada DIPA ................ dan/atau DOKPPN.</h6>
                                  <br>
                                  <div class="mb-3 row align-items-center">
                                    <label class="col-md-3 col-form-label fw-semibold text-md-start">Nama Kantor Atau Unit :</label>
                                    <div class="col-md-8">
                                      <input type="text" class="form-control" name="nama_kantor_st" placeholder="Isi Titik-titik bagian atas untuk nomor kantor pada bagian ini">
                                    </div>
                                  </div>

                                  <!-- Penerbit Surat Tugas -->
                                  <div class="mb-3 row align-items-center">
                                    <label class="col-md-3 col-form-label fw-semibold text-md-start">Penerbit Surat Tugas :</label>
                                    <div class="col-md-8">
                                      <select class="form-select" id="penerbit_surat_tugas" name="penerbit_st">
                                        <option value="" selected disabled>- Pilih -</option>
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
      return `id_pelanggaran_ketentuan_lain_${timestamp}_${randomNum}`;
    }

    document.getElementById('id_pelanggaran_ketentuan_lain').value = generateUniqueID();
  </script>
@endsection

@section('script')
  @vite(['resources/js/pages/datatable.init.js'])
@endsection
