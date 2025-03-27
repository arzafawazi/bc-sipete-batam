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

  <h5 class="fw-bold text-center"><u>SURAT PERINTAH PENAHANAN</u></h5>

  <div class="mb-3 row align-items-center">
    <div class="input-group flex-wrap">
      <span class="input-group-text">NO : SPP- </span>
      <input type="text" class="form-control" value="{{ old('no_spp', isset($unsurpenyidikan) ? $unsurpenyidikan->no_spp : $no_ref) }}" name="no_spp" readonly>
      <span class="input-group-text">/PPNS/</span>
      <input type="date" class="form-control" name="tgl_spp" value="{{ old('tgl_spp', isset($unsurpenyidikan) ? $unsurpenyidikan->tgl_spd : '') }}">
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
                <p class="ps-3 text-black">
                  Bahwa berdasarkan hasil pemeriksaan diperoleh bukti yang cukup
                    Tersangka diduga keras melakukan tindak pidana yang dapat
                    dikenakan penahanan dan Tersangka dikhawatirkan akan melarikan
                    diri, merusak atau menghilangkan barang bukti dan atau mengulangi
                    tindak pidana maka perlu dilakukan penahanan.
                  </p>
              </div>
            </div>

              <div class="mb-3 row">
                <label class="col-md-3 col-sm-12 col-form-label fw-bold text-md-start">DASAR</label>
                <div class="col-md-1 col-sm-1 text-center mt-1 d-none d-sm-block">:</div>
                <div class="col-md-8 col-sm-11">
                    <ol class="ps-3 text-black" start="1" style="line-height: 1.5;">
                        <li class="mb-1 ps-1">Undang-Undang Nomor 8 Tahun 1981 tentang Hukum Acara Pidana;</li>
                        <li class="mb-1 ps-1">Undang-Undang No. 10 Tahun 1995 tentang Kepabeanan sebagaimana telah diubah dengan Undang-Undang No. 17 Tahun 2006;</li>
                        <li class="mb-1 ps-1">Undang-Undang No. 11 Tahun 1995 tentang Cukai sebagaimana telah diubah dengan Undang-Undang No. 39 Tahun 2007;</li>
                        <li class="mb-1 ps-1">Peraturan Pemerintah Nomor 27 Tahun 1983 tentang Pelaksanaan Kitab Undang-Undang Hukum Acara Pidana sebagaimana telah diubah beberapa kali terakhir dengan Peraturan Pemerintah Nomor 92 Tahun 2015 tentang Perubahan Kedua atas Peraturan Pemerintah Nomor 27 Tahun 1983 tentang Pelaksanaan Kitab Undang-Undang Hukum Acara Pidana;</li>
                        <li class="mb-1 ps-1">Peraturan Pemerintah Nomor 55 Tahun 1996 tentang Penyidikan Tindak Pidana di Bidang Kepabeanan dan Cukai;</li>
                        <li class="mb-1 ps-1">Peraturan Menteri Keuangan Nomor ...(6)... tentang Organisasi dan Tata Kerja Kementerian Keuangan/Organisasi dan Tata Kerja Instansi Vertikal Direktorat Jenderal Bea dan Cukai*);</li>
                        <li class="mb-1 ps-1">Laporan Kejadian Nomor : ………..(6)…..…….. tanggal …...…(7)………</li>
                        <li class="mb-1 ps-1">Surat Perintah Tugas Penyidikan Nomor: ……..(8)………. tanggal ………(9)…..…..</li>
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
                    <p class="mb-1 ps-1">Melakukan penahanan Tersangka:</p>
                    <div class="ps-3 text-black" style="line-height: 1.5;">
                        <div class="row mb-1">
                            <div class="col-4 fw-bold">Nama</div>
                            <div class="col-1">:</div>
                            <div class="col-7">……………….…(16)……………………….</div>
                        </div>
                        <div class="row mb-1">
                            <div class="col-4 fw-bold">Jenis Kelamin</div>
                            <div class="col-1">:</div>
                            <div class="col-7">……………….…(17)……………………….</div>
                        </div>
                        <div class="row mb-1">
                            <div class="col-4 fw-bold">Tempat/Tanggal Lahir</div>
                            <div class="col-1">:</div>
                            <div class="col-7">……………….…(18)……………………….</div>
                        </div>
                        <div class="row mb-1">
                            <div class="col-4 fw-bold">Pekerjaan</div>
                            <div class="col-1">:</div>
                            <div class="col-7">……………….…(19)……………………….</div>
                        </div>
                        <div class="row mb-1">
                            <div class="col-4 fw-bold">Kewarganegaraan</div>
                            <div class="col-1">:</div>
                            <div class="col-7">……………….…(20)……………………….</div>
                        </div>
                        <div class="row mb-1">
                            <div class="col-4 fw-bold">Agama</div>
                            <div class="col-1">:</div>
                            <div class="col-7">……………….…(21)……………………….</div>
                        </div>
                        <div class="row mb-1">
                            <div class="col-4 fw-bold">Alamat</div>
                            <div class="col-1">:</div>
                            <div class="col-7">……………….…(22)……………………….</div>
                        </div>
                    </div>
                </div>
            </div>

            <p class="text-black">
            Karena diduga keras telah melakukan tindak pidana di bidang ............(23).......... yaitu
            ……………………………………..……(24).....…………..……………………, diduga melanggar
            Pasal ..……(25)......... Undang-Undang .................................(26).......................................
            </p>

            <p class="text-black">
            Penahanan dilakukan di ……………(27)…………… selama …..(28)….. hari terhitung mulai tanggal
            ………(29)……….. sampai dengan …………(30)…………
            </p>

            <div class="mb-3 row">
              <label class="col-md-3 col-sm-12 col-form-label fw-bold text-md-start">PEJABAT YANG MENERBITKAN SURAT PERINTAH PENAHANAN</label>
              <div class="col-md-1 col-sm-1 text-center mt-1 d-none d-sm-block">:</div>
              <div class="col-md-8 col-sm-11">
                <select class="form-control form-select select2" name="pejabat_terbit_spfd">
                  <option value="" selected disabled>- Pilih -</option>
                  @foreach ($users as $user)
                    <option value="{{ $user->id_admin }}" {{ old('pejabat_terbit_spfd', isset($unsurpenyidikan) ? $unsurpenyidikan->pejabat_terbit_spfd : '') == $user->id_admin ? 'selected' : '' }}>
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
