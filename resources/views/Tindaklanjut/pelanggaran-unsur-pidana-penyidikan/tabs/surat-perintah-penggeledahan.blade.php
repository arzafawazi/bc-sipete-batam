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

  <h5 class="fw-bold text-center">SURAT PERINTAH PENGGELEDAHAN RUMAH/BANGUNAN
  </h5>

  <div class="mb-3 row align-items-center">
    <div class="input-group flex-wrap">
      <span class="input-group-text">NO : SPPR- </span>
      <input type="text" class="form-control" value="{{ old('no_sppr', isset($unsurpenyidikan) ? $unsurpenyidikan->no_sppr : $no_ref) }}" name="no_sppr" readonly>
      <span class="input-group-text">/PPNS/</span>
      <input type="date" class="form-control" name="tgl_sppr" value="{{ old('tgl_sppr', isset($unsurpenyidikan) ? $unsurpenyidikan->tgl_sppr : '') }}">
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
                  <li class="mb-1 ps-1"> Dalam keadaan mendesak untuk kepentingan Penyidikan tindak
                    pidana, perlu untuk melakukan tindakan penggeledahan terhadap
                    rumah/bangunan yang diduga keras melakukan tindak pidana
                    berdasarkan bukti permulaan yang cukup.</li>
                  </ol>
              </div>
            </div>

              <div class="mb-3 row">
                <label class="col-md-3 col-sm-12 col-form-label fw-bold text-md-start">DASAR</label>
                <div class="col-md-1 col-sm-1 text-center mt-1 d-none d-sm-block">:</div>
                <div class="col-md-8 col-sm-11">
                    <ol class="ps-3 text-black" start="1" style="line-height: 1.5;">
                    <li class="mb-1 ps-1">Pasal 1 butir 17, Pasal 5 ayat (1) huruf b angka 1, Pasal 7 ayat (1) huruf d, Pasal 11, Pasal 32, Pasal 33, Pasal 34, Pasal 36, Pasal 125, Pasal 126, dan Pasal 127 Undang-Undang Nomor 8 Tahun 1981 tentang Hukum Acara Pidana;</li>
                    <li class="mb-1 ps-1">Pasal 112 ayat (2) huruf i Undang-Undang Nomor 17 Tahun 2006 jo. Pasal 63 ayat (2) huruf g Undang-Undang Nomor 39 Tahun 2007;</li>
                    <li class="mb-1 ps-1">Peraturan Pemerintah Nomor 55 Tahun 1996 tentang Penyidikan Tindak Pidana di Bidang Kepabeanan dan Cukai;</li>
                    <li class="mb-1 ps-1">LK Nomor : LK-.........(4)......... tanggal ............(5)............;</li>
                    <li class="mb-1 ps-1">Surat Perintah Tugas Penyidikan (SPTP) Nomor : SPTP-.........(6)......... tanggal ...........(7)...........</li>
                    </ol>
                </div>
                </div>


            <div class="mb-3 row">
              <label class="col-md-3 col-sm-12 col-form-label fw-bold text-md-start">KEPADA</label>
              <div class="col-md-1 col-sm-1 text-center mt-1 d-none d-sm-block">:</div>
              <div class="col-md-8 col-sm-11">
                {{-- <select class="form-control form-select select2" id="tim_geledah" name="tim_geledah[]" multiple>
                  @foreach ($users as $user)
                    <option value="{{ $user->id_admin }}" {{ in_array($user->id_admin, json_decode(old('tim_geledah', isset($unsurpenyidikan) ? $unsurpenyidikan->tim_geledah : '[]'))) ? 'selected' : '' }}>
                      {{ $user->name }} | {{ $user->pangkat }} | {{ $user->jabatan }}
                    </option>
                  @endforeach
                </select> --}}
              </div>
            </div>



            <div class="mb-3 row">
                <label class="col-md-3 col-sm-12 col-form-label fw-bold text-md-start">U N T U K</label>
                <div class="col-md-1 col-sm-1 text-center mt-1 d-none d-sm-block">:</div>
                <div class="col-md-8 col-sm-11">
                    <ol class="ps-3 text-black" start="1" style="line-height: 1.5;">
                    <li class="mb-1 ps-1">Melakukan penggeledahan Rumah/Bangunan dari Sdri. ...........(11).......... yang terletak di .............(12)..........., guna melakukan:
                        <ol class="ps-3" type="a">
                        <li>Pemeriksaan dan/atau</li>
                        <li>Penyitaan dan/atau</li>
                        <li>Penangkapan</li>
                        </ol>
                        Sehubungan dengan terjadinya tindak pidana di bidang ..............(13)............ yaitu .................(14)................, diduga melanggar Pasal ...........(15).......... Undang-Undang ..........(16)..........</li>
                    <li class="mb-1 ps-1">Setelah melaksanakan Surat Perintah ini agar membuat Berita Acara Penggeledahan.</li>
                    <li class="mb-1 ps-1">Surat Perintah ini berlaku sejak tanggal .............(17).................. sampai dengan selesai.</li>
                    </ol>
                </div>
                </div>


            <div class="mb-3 row">
              <label class="col-md-3 col-sm-12 col-form-label fw-bold text-md-start">PEJABAT YANG MENERBITKAN SURAT PERINTAH</label>
              <div class="col-md-1 col-sm-1 text-center mt-1 d-none d-sm-block">:</div>
              <div class="col-md-8 col-sm-11">
                <select class="form-control form-select select2" name="pejabat_terbit_sppr">
                  <option value="" selected disabled>- Pilih -</option>
                  @foreach ($users as $user)
                    <option value="{{ $user->id_admin }}" {{ old('pejabat_terbit_sppr', isset($unsurpenyidikan) ? $unsurpenyidikan->pejabat_terbit_sppr : '') == $user->id_admin ? 'selected' : '' }}>
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
