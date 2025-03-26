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

  <h5 class="fw-bold text-center"><u>SURAT PERINTAH PEMOTRETAN DAN/ATAU PEREKAMAN<br>MELALUI MEDIA AUDIOVISUAL</u>
  </h5>

  <div class="mb-3 row align-items-center">
    <div class="input-group flex-wrap">
      <span class="input-group-text">NO : SPPP- </span>
      <input type="text" class="form-control" value="{{ old('no_sppp', isset($unsurpenyidikan) ? $unsurpenyidikan->no_sppp : $no_ref) }}" readonly>
      <span class="input-group-text">/PPNS/</span>
      <input type="date" class="form-control" value="{{ old('tgl_sppp', isset($unsurpenyidikan) ? $unsurpenyidikan->tgl_sppp : '') }}">
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
                  <li class="mb-1 ps-1">Untuk kepentingan Penyidikan tindak pidana, perlu untuk memotret
                    dan/atau merekam melalui media audiovisual yang diduga keras
                    berhubungan dengan tindak pidana berdasarkan bukti permulaan yang
                    cukup.
                    .</li>
                  </ol>
              </div>
            </div>

              <div class="mb-3 row">
            <label class="col-md-3 col-sm-12 col-form-label fw-bold text-md-start">DASAR</label>
            <div class="col-md-1 col-sm-1 text-center mt-1 d-none d-sm-block">:</div>
            <div class="col-md-8 col-sm-11">
                <ol class="ps-3 text-black" start="1" style="line-height: 1.5;">
                    <li class="mb-1 ps-1">Pasal 7 ayat (1) Undang-Undang Nomor 8 tahun 1981 tentang Hukum Acara Pidana;</li>
                    <li class="mb-1 ps-1">Pasal 112 ayat (2) Undang-Undang Nomor 10 tahun 1995 tentang Kepabeanan sebagaimana telah diubah dengan Undang-Undang Nomor 17 Tahun 2006;</li>
                    <li class="mb-1 ps-1">Pasal 63 ayat (2) Undang-Undang Nomor 11 tahun 1995 tentang Cukai sebagaimana telah diubah dengan Undang-Undang Nomor 39 tahun 2007;</li>
                    <li class="mb-1 ps-1">Peraturan Pemerintah Nomor 55 tahun 1996 tentang Penyidikan Tindak Pidana di Bidang Kepabeanan dan Cukai;</li>
                    <li class="mb-1 ps-1">Peraturan Menteri Keuangan Nomor ...(6)... tentang Organisasi dan Tata Kerja Kementerian Keuangan/Organisasi dan Tata Kerja Instansi Vertikal Direktorat Jenderal Bea dan Cukai*);</li>
                    <li class="mb-1 ps-1">LK Nomor : LK- ...........(7)........ tanggal ………(8)……..;</li>
                    <li class="mb-1 ps-1">Surat Perintah Tugas Penyidikan (SPTP) Nomor : SPTP- ...........(9)........... tanggal ……....(10)....……;</li>
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
                <label class="col-md-3 col-sm-12 col-form-label fw-bold text-md-start">UNTUK</label>
                <div class="col-md-1 col-sm-1 text-center mt-1 d-none d-sm-block">:</div>
                <div class="col-md-8 col-sm-11">
                    <ol class="ps-3 text-black" start="1" style="line-height: 1.5;">
                        <li class="mb-1 ps-1">Memotret dan/atau merekam melalui media audiovisual terhadap orang/barang/sarana pengangkut* sebagai berikut:
                            <br>…………………………….(17)…………………………………………..
                            <br>Sehubungan dengan terjadinya tindak pidana di bidang ………(18)……..., yaitu ………(19)………..., diduga melanggar ……..(20)……................
                        </li>
                        <li class="mb-1 ps-1">Setelah melaksanakan surat perintah ini agar membuat Berita Acara Pemotretan dan/atau Perekaman melalui Media Audiovisual.</li>
                        <li class="mb-1 ps-1">Surat Perintah ini mulai berlaku sejak tanggal ………(21)…… sampai dengan tanggal ………(22)…….</li>
                    </ol>
                </div>
            </div>



            <div class="mb-3 row">
              <label class="col-md-3 col-sm-12 col-form-label fw-bold text-md-start">PEJABAT YANG MENERBITKAN SPPP</label>
              <div class="col-md-1 col-sm-1 text-center mt-1 d-none d-sm-block">:</div>
              <div class="col-md-8 col-sm-11">
                <select class="form-control form-select select2" name="pejabat_terbit_sppp">
                  <option value="" selected disabled>- Pilih -</option>
                  @foreach ($users as $user)
                    <option value="{{ $user->id_admin }}" {{ old('pejabat_terbit_sppp', isset($unsurpenyidikan) ? $unsurpenyidikan->pejabat_terbit_sppp : '') == $user->id_admin ? 'selected' : '' }}>
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
