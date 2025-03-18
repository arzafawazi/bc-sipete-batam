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

  <h5 class="fw-bold text-center">SURAT PERINTAH MEMBAWA SAKSI</h5>

  <div class="mb-3 row align-items-center">
    <div class="input-group flex-wrap">
      <span class="input-group-text">NO : SPM-</span>
      <input type="text" class="form-control" value="{{ old('no_spms', isset($unsurpenyidikan) ? $unsurpenyidikan->no_spms : $no_ref) }}" name="no_spms" readonly>
      <span class="input-group-text">/PPNS/</span>
      <input type="date" class="form-control" name="tgl_spms" value="{{ old('spms', isset($unsurpenyidikan) ? $unsurpenyidikan->spms : '') }}">
    </div>
  </div>


  <!-- Main Form -->
  <div class="card p-1">
    <div class="card-body">
      <div class="row">
        <div class="col-lg-12">
          <div class="container-fluid px-0 px-sm-3">

            <div class="mb-3 row">
              <label class="col-md-3 col-sm-12 col-form-label fw-bold text-md-start">PERTIMBANGAN</label>
              <div class="col-md-1 col-sm-1 text-center mt-1 d-none d-sm-block">:</div>
              <div class="col-md-8 col-sm-11">
                <ol class="ps-3 text-black" start="1" style="line-height: 1.5;">
                  <li class="mb-1 ps-1">Untuk kepentingan pemeriksaan dalam rangka Penyidikan tindak pidana, perlu mengambil tindakan hukum membawa SAKSI karena tidak memenuhi Surat Panggilan yang sah untuk kedua kalinya tanpa memberi alasan yang
                    patut dan wajar.</li>
                </ol>
              </div>
            </div>


            <div class="mb-3 row">
              <label class="col-md-3 col-sm-12 col-form-label fw-bold text-md-start">DASAR</label>
              <div class="col-md-1 col-sm-1 text-center mt-1 d-none d-sm-block">:</div>
              <div class="col-md-8 col-sm-11">
                <ol class="ps-3 text-black" start="1" style="line-height: 1.5;">
                  <li class="mb-1 ps-1">Pasal 7 ayat (2) dan pasal 112 ayat (1) dan ayat (2) KUHAP Undang-Undang Nomor 8 Tahun 1981 tentang Hukum Acara Pidana;</li>
                  <li class="mb-1 ps-1">Pasal 112 ayat (2) huruf d Undang-Undang Nomor 10 Tahun 1995 tentang Kepabeanan sebagaimana telah diubah dengan Undang-Undang Nomor 17 Tahun 2006;</li>
                  <li class="mb-1 ps-1">Pasal 63 ayat (2) huruf c Undang-Undang Nomor 11 Tahun 1995 tentang Cukai sebagaimana telah diubah dengan Undang-Undang Nomor 39 Tahun 2007;</li>
                  <li class="mb-1 ps-1">Peraturan Pemerintah Nomor 55 Tahun 1996 tentang Penyidikan Tindak Pidana di Bidang Kepabeanan dan Cukai;</li>
                  <li class="mb-1 ps-1">Surat Panggilan Nomor : ........... </li>
                  <li class="mb-1 ps-1">Surat Panggilan II Nomor : ........... </li>
                </ol>
              </div>
            </div>


            <div class="mb-3 row">
              <label class="col-md-3 col-sm-12 col-form-label fw-bold text-md-start">KEPADA</label>
              <div class="col-md-1 col-sm-1 text-center mt-1 d-none d-sm-block">:</div>
              <div class="col-md-8 col-sm-11">
                <select class="form-control form-select select2" id="tim_membawa" name="tim_membawa[]" multiple>
                  @foreach ($users as $user)
                    <option value="{{ $user->id_admin }}" {{ in_array($user->id_admin, json_decode(old('tim_membawa', $unsurpenyidikan->tim_membawa ?? '[]'), true) ?? []) ? 'selected' : '' }}>
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
                  <li class="mb-1 ps-1">Membawa Saksi</li>

                  <div class="row mb-3 pt-3">
                    <div class="col-md-4 text-black d-flex align-items-center">Nama Lengkap</div>
                    <div class="col-md-1 text-center d-flex align-items-center justify-content-center">:</div>
                    <div class="col-md-7">
                    </div>
                  </div>

                  <div class="row mb-3">
                    <div class="col-md-4 text-black d-flex align-items-center">Tempat /Tanggal Lahir</div>
                    <div class="col-md-1 text-center d-flex align-items-center justify-content-center">:</div>
                    <div class="col-md-7">
                    </div>
                  </div>

                  <div class="row mb-3">
                    <div class="col-md-4 text-black d-flex align-items-center">Jenis kelamin
                    </div>
                    <div class="col-md-1 text-center d-flex align-items-center justify-content-center">:</div>
                    <div class="col-md-7">
                    </div>
                  </div>

                  <div class="row mb-3">
                    <div class="col-md-4 text-black d-flex align-items-center">Kewarganegaraan</div>
                    <div class="col-md-1 text-center d-flex align-items-center justify-content-center">:</div>
                    <div class="col-md-7">
                    </div>
                  </div>

                  <div class="row mb-3">
                    <div class="col-md-4 text-black d-flex align-items-center">Agama</div>
                    <div class="col-md-1 text-center d-flex align-items-center justify-content-center">:</div>
                    <div class="col-md-7">
                    </div>
                  </div>


                  <div class="row mb-3">
                    <div class="col-md-4 text-black d-flex align-items-center">Pekerjaan</div>
                    <div class="col-md-1 text-center d-flex align-items-center justify-content-center">:</div>
                    <div class="col-md-7">
                    </div>
                  </div>

                  <div class="row mb-3">
                    <div class="col-md-4 text-black d-flex align-items-center">Alamat Tempat Tinggal</div>
                    <div class="col-md-1 text-center d-flex align-items-center justify-content-center">:</div>
                    <div class="col-md-7">
                    </div>
                  </div>


                  <p class="mb-1 ps-1">Untuk didengar keterangannya sebagai SAKSI dalam perkara </p>
                  <p class="mb-1 ps-1">tindak pidana di bidang Kepabeanan yaitu …..</p>

                  <li class="mb-1 ps-1">Setelah melaksanakan perintah ini agar segera membuat Berita Acara Membawa Saksi.</li>
                </ol>
              </div>
            </div>

            <div class="mb-3 row">
              <label class="col-md-3 col-sm-12 col-form-label fw-bold text-md-start">PEJABAT YANG MENERBITKAN SURAT PERINTAH MEMBAWA</label>
              <div class="col-md-1 col-sm-1 text-center mt-1 d-none d-sm-block">:</div>
              <div class="col-md-8 col-sm-11">
                <select class="form-control form-select select2" name="pejabat_terbit_spms">
                  <option value="" selected disabled>- Pilih -</option>
                  @foreach ($users as $user)
                    <option value="{{ $user->id_admin }}" {{ old('pejabat_terbit_spms', isset($unsurpenyidikan) ? $unsurpenyidikan->pejabat_terbit_spms : '') == $user->id_admin ? 'selected' : '' }}>
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
