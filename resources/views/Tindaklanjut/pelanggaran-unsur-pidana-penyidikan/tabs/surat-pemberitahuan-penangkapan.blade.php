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
            <input type="text" class="form-control" name="no_pdp" value="{{ old('no_pdp', isset($unsurpenyidikan) ? $unsurpenyidikan->no_pdp : $no_ref->no_pdp) }}" readonly>
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
          <input type="text" class="form-control" placeholder="Yth." name="yth_pdp" value="{{ old('yth_pdp', $unsurpenyidikan->yth_pdp ?? '') }}">
        </div>
      </div>

      <div class="row mb-3">
        <div class="col-md-3 fw-bold">Di</div>
        <div class="col-md-1 text-center">:</div>
        <div class="col-md-8">
          <input type="text" class="form-control" placeholder="Di" name="di_pdp" value="{{ old('di_pdp', $unsurpenyidikan->di_pdp ?? '') }}">
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
