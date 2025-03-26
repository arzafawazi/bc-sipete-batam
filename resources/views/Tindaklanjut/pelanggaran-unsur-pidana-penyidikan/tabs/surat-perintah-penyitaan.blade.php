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

  <h5 class="fw-bold text-center"><u>SURAT PERINTAH PENYITAAN</u>
  </h5>

  <div class="mb-3 row align-items-center">
    <div class="input-group flex-wrap">
      <span class="input-group-text">NO : SPP- </span>
      <input type="text" class="form-control" value="{{ old('no_spp', isset($unsurpenyidikan) ? $unsurpenyidikan->no_spp : $no_ref) }}"  readonly>
      <span class="input-group-text">/PPNS/</span>
      <input type="date" class="form-control"  value="{{ old('tgl_spp', isset($unsurpenyidikan) ? $unsurpenyidikan->tgl_spp : '') }}">
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
                  <li class="mb-1 ps-1">Dalam keadaan mendesak untuk kepentingan Penyidikan, perlu
                    dilakukan penyitaan barang bukti.
                    </li>
                  </ol>
              </div>
            </div>

             <div class="mb-3 row">
            <label class="col-md-3 col-sm-12 col-form-label fw-bold text-md-start">DASAR</label>
            <div class="col-md-1 col-sm-1 text-center mt-1 d-none d-sm-block">:</div>
            <div class="col-md-8 col-sm-11">
                <ol class="ps-3 text-black" start="1" style="line-height: 1.5;">
                    <li class="mb-1 ps-1">Pasal 38 ayat (2) Undang-Undang Nomor 8 Tahun 1981 tentang Hukum Acara Pidana;</li>
                    <li class="mb-1 ps-1">Pasal 112 ayat (2) Undang-Undang Nomor 10 Tahun 1995 tentang Kepabeanan sebagaimana telah diubah dengan Undang-Undang Nomor 17 Tahun 2006;</li>
                    <li class="mb-1 ps-1">Pasal 63 ayat (2) Undang-Undang Nomor 11 Tahun 1995 tentang Cukai sebagaimana telah diubah dengan Undang-Undang Nomor 39 Tahun 2007;</li>
                    <li class="mb-1 ps-1">Laporan Kejadian Nomor LK-…….….(6)……….. tanggal ……….…(7)…………;</li>
                    <li class="mb-1 ps-1">Surat Perintah Tugas Penyidikan (SPTP) Nomor : SPTP-..........(8)......... tanggal ………(9)………….</li>
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
                        <li class="mb-1 ps-1">Melakukan penyitaan Barang Bukti dugaan tindak pidana di bidang ........(16)........ yaitu …………(17)…….… melanggar …….(18)………, berupa:
                            <ul class="ps-3">
                                <li>……………………………(19)………………………………………</li>
                                <li>………………………………………………………………………….</li>
                            </ul>
                        </li>
                        <li class="mb-1 ps-1">Setelah melaksanakan Surat Perintah ini agar membuat Berita Acara Penyitaan.</li>
                        <li class="mb-1 ps-1">Melaksanakan perintah ini dengan seksama dan dengan penuh rasa tanggung jawab.</li>
                        <li class="mb-1 ps-1">Surat Perintah ini berlaku dari tanggal .............(20)..................</li>
                    </ol>
                </div>
            </div>



            <div class="mb-3 row">
              <label class="col-md-3 col-sm-12 col-form-label fw-bold text-md-start">PEJABAT YANG MENERBITKAN SURAT PERINTAH</label>
              <div class="col-md-1 col-sm-1 text-center mt-1 d-none d-sm-block">:</div>
              <div class="col-md-8 col-sm-11">
                <select class="form-control form-select select2" name="pejabat_terbit_spp">
                  <option value="" selected disabled>- Pilih -</option>
                  @foreach ($users as $user)
                    <option value="{{ $user->id_admin }}" {{ old('pejabat_terbit_spp', isset($unsurpenyidikan) ? $unsurpenyidikan->pejabat_terbit_spp : '') == $user->id_admin ? 'selected' : '' }}>
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
