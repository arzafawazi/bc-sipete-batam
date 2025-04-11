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

     <h5 class="fw-bold text-center text-black"><u>BERITA ACARA PENGAMBILAN SIDIK JARI</u></h5>


     <!-- Main Form -->
     <div class="card p-1">
         <div class="card-body">
             <div class="row">
                 <div class="col-lg-12">
                     <div class="container-fluid px-0 px-sm-3">

                         <p class="text-black">
                             &nbsp;&nbsp;&nbsp; Pada hari ........ tanggal ........ bulan ........ tahun ........, Saya
                             :
                         </p>

                         <div class="fw-bold text-center">
                             <select class="form-control form-select select2" name="pejabat_sidikjari">
                                 <option value="" selected disabled>- Pilih -</option>
                                 @foreach ($users as $user)
                                     <option value="{{ $user->id_admin }}"
                                         {{ old('pejabat_sidikjari', isset($unsurpenyidikan) ? $unsurpenyidikan->pejabat_sidikjari : '') == $user->id_admin ? 'selected' : '' }}>
                                         {{ $user->name }} | {{ $user->pangkat }} | {{ $user->jabatan }}
                                     </option>
                                 @endforeach
                             </select>
                         </div>

                         <br>

                         <p class="text-black">
                             --- Pada hari ini ….....(3)…….. tanggal ………(4)…........ bulan ……....(5)…........ tahun
                             …….......(6)…........... bertempat di ............(7).........., saya :
                             ------------------------------------------------
                             ---------------------------------------- ………………(8)……………..
                             ----------------------------------------
                             Pangkat : ………(9)…………, Jabatan : Penyidik pada …….......……(10)…………… bersamasama dengan :
                             ----------------------------------------------------------------------------------------------------------
                             ---------------------------------------- ………………(11)……………..
                             ----------------------------------------
                             Pangkat : ………(12)…………, Jabatan : Penyidik pada …….......……(13)……………. ------------<br>
                             Berdasarkan :
                         <ol class="ps-3 text-black" start="1" style="line-height: 1.5;">
                             <li class="mb-1 ps-1">Laporan Kejadian Tindak Pidana Nomor : LK-
                                 ................(14)................. tanggal ...........(15)............</li>
                             <li class="mb-1 ps-1">Surat Perintah Tugas Penyidikan Nomor : SPTP-
                                 ................(16)................. tanggal ...........(17).............</li>
                             <li class="mb-1 ps-1">Surat Perintah Pengambilan Sidik Jari Nomor : SPPSJ-
                                 ...........(18).................. tanggal ………(19)…..…….</li>
                         </ol>
                         </p>



                         <p class="text-black">
                             Telah mengambil sidik jari saksi/tersangka* dengan identitas sebagai berikut:
                         </p>

                         <p class="text-black"><b>Data Tersangka</b></p>
                         @foreach ($tersangkaData as $index => $tersangka)
                             @php
                                 $BaSidikJariTersangka = $BaSidikJariTersangka[$index] ?? null;
                             @endphp
                             <hr>

                             <div class="mb-3 row">
                                 <label class="col-md-3 col-sm-12 col-form-label">Waktu BA Sidik Jari</label>
                                 <div class="col-md-1 text-center mt-1 d-none d-sm-block">:</div>
                                 <div class="col-md-8 col-sm-11">
                                     <input type="text" class="form-control datetime-datepicker"
                                         name="waktu_ba_sidik_jari[]"
                                         value="{{ old('waktu_ba_sidik_jari.' . $index, $BaSidikJariTersangka['waktu_sidik_jari'] ?? '') }}">
                                 </div>
                             </div>


                             <div class="mb-3 row">
                                 <label class="col-md-3 col-sm-12 col-form-label">Pejabat Pertama
                                     Sidik Jari</label>
                                 <div class="col-md-1 text-center mt-1 d-none d-sm-block">:</div>
                                 <div class="col-md-8 col-sm-11">
                                     <select class="form-control py-1 form-select select2"
                                         name="pejabat_pertama_surat_sidikjari_tersangka_ba[]">
                                         <option value="" disabled
                                             {{ old('pejabat_pertama_surat_sidikjari_tersangka_ba.' . $index, $BaSidikJariTersangka['pejabat_pertama_ba'] ?? '') == '' ? 'selected' : '' }}>
                                             - Pilih -</option>

                                         @foreach ($users as $user)
                                             <option value="{{ $user->id_admin }}"
                                                 {{ old('pejabat_pertama_surat_sidikjari_tersangka_ba.' . $index, $BaSidikJariTersangka['pejabat_pertama_ba'] ?? '') == $user->id_admin ? 'selected' : '' }}>
                                                 {{ $user->name }} | {{ $user->pangkat }} |
                                                 {{ $user->jabatan }}
                                             </option>
                                         @endforeach
                                     </select>
                                 </div>
                             </div>

                             <div class="mb-3 row">
                                 <label class="col-md-3 col-sm-12 col-form-label">Pejabat Kedua
                                     Sidik Jari</label>
                                 <div class="col-md-1 text-center mt-1 d-none d-sm-block">:</div>
                                 <div class="col-md-8 col-sm-11">
                                     <select class="form-control py-1 form-select select2"
                                         name="pejabat_kedua_surat_sidikjari_tersangka_ba[]">
                                         <option value="" disabled
                                             {{ old('pejabat_kedua_surat_sidikjari_tersangka_ba.' . $index, $BaSidikJariTersangka['pejabat_kedua_ba'] ?? '') == '' ? 'selected' : '' }}>
                                             - Pilih -</option>

                                         @foreach ($users as $user)
                                             <option value="{{ $user->id_admin }}"
                                                 {{ old('pejabat_kedua_surat_sidikjari_tersangka_ba.' . $index, $BaSidikJariTersangka['pejabat_kedua_ba'] ?? '') == $user->id_admin ? 'selected' : '' }}>
                                                 {{ $user->name }} | {{ $user->pangkat }} |
                                                 {{ $user->jabatan }}
                                             </option>
                                         @endforeach
                                     </select>
                                 </div>
                             </div>



                             <div class="mb-3 row">
                                 <label class="col-md-3 col-sm-12 col-form-label">Nama</label>
                                 <div class="col-md-1 text-center mt-1 d-none d-sm-block">:</div>
                                 <div class="col-md-8 col-sm-11">
                                     <input type="text" name="ba_sidikjari_nama_tersangka[]"
                                         class="form-control border-0 py-1" value="{{ $tersangka['nama'] ?? '' }}"
                                         readonly>
                                 </div>
                             </div>

                             <div class="mb-3 row">
                                 <label class="col-md-3 col-sm-12 col-form-label">Tempat/Tanggal Lahir</label>
                                 <div class="col-md-1 text-center mt-1 d-none d-sm-block">:</div>
                                 <div class="col-md-8 col-sm-11">
                                     <input type="text" class="form-control border-0 py-1"
                                         value="{{ $tersangka['ttl'] ?? '' }}" readonly>
                                 </div>
                             </div>

                             <div class="mb-3 row">
                                 <label class="col-md-3 col-sm-12 col-form-label">Pekerjaan</label>
                                 <div class="col-md-1 text-center mt-1 d-none d-sm-block">:</div>
                                 <div class="col-md-8 col-sm-11">
                                     <input type="text" class="form-control border-0 py-1"
                                         value="{{ $tersangka['pekerjaan'] ?? '' }}" readonly>
                                 </div>
                             </div>

                             <div class="mb-3 row">
                                 <label class="col-md-3 col-sm-12 col-form-label">Alamat</label>
                                 <div class="col-md-1 text-center mt-1 d-none d-sm-block">:</div>
                                 <div class="col-md-8 col-sm-11">
                                     <input type="text" class="form-control border-0 py-1"
                                         value="{{ $tersangka['alamat'] ?? '' }}" readonly>
                                 </div>
                             </div>

                             <div class="mb-3 row">
                                 <label class="col-md-3 col-sm-12 col-form-label">Kewarganegaraan</label>
                                 <div class="col-md-1 text-center mt-1 d-none d-sm-block">:</div>
                                 <div class="col-md-8 col-sm-11">
                                     <input type="text" class="form-control border-0 py-1"
                                         value="{{ $tersangka['kewarganegaraan'] ?? '' }}" readonly>
                                 </div>
                             </div>

                             <div class="mb-3 row">
                                 <label class="col-md-3 col-sm-12 col-form-label">Agama</label>
                                 <div class="col-md-1 text-center mt-1 d-none d-sm-block">:</div>
                                 <div class="col-md-8 col-sm-11">
                                     <input type="text" class="form-control border-0 py-1"
                                         value="{{ $tersangka['agama'] ?? '' }}" readonly>
                                 </div>
                             </div>

                             <div class="mb-3 row">
                                 <label class="col-md-12 fw-bold">Dengan disaksikan oleh:</label>
                             </div>

                             {{-- Saksi 1 --}}
                             <div class="row mb-1">
                                 <div class="col-md-3 col-sm-12 col-form-label">1. Nama</div>
                                 <div class="col-md-1 text-center">:</div>
                                 <div class="col-md-8 col-sm-12">
                                     <input type="text" name="saksi1_sidik_jari_nama[]" class="form-control py-1"
                                         value="{{ old('saksi1_sidik_jari_nama.' . $index, $BaSidikJariTersangka['saksi_pertama_nama'] ?? '') }}">
                                 </div>
                             </div>
                             <div class="row mb-1">
                                 <div class="col-md-3 col-sm-12 col-form-label">&nbsp;&nbsp;&nbsp;Alamat</div>
                                 <div class="col-md-1 text-center">:</div>
                                 <div class="col-md-8 col-sm-12">
                                     <input type="text" name="saksi1_sidik_jari_alamat[]" class="form-control py-1"
                                         value="{{ old('saksi1_sidik_jari_alamat.' . $index, $BaSidikJariTersangka['saksi_pertama_alamat'] ?? '') }}">
                                 </div>
                             </div>
                             <div class="row mb-2">
                                 <div class="col-md-3 col-sm-12 col-form-label">&nbsp;&nbsp;&nbsp;Pekerjaan</div>
                                 <div class="col-md-1 text-center">:</div>
                                 <div class="col-md-8 col-sm-12">
                                     <input type="text" name="saksi1_sidik_jari_pekerjaan[]"
                                         class="form-control py-1"
                                         value="{{ old('saksi1_sidik_jari_pekerjaan.' . $index, $BaSidikJariTersangka['saksi_pertama_pekerjaan'] ?? '') }}">
                                 </div>
                             </div>

                             {{-- Saksi 2 --}}
                             <div class="row mb-1">
                                 <div class="col-md-3 col-sm-12 col-form-label">2. Nama</div>
                                 <div class="col-md-1 text-center">:</div>
                                 <div class="col-md-8 col-sm-12">
                                     <input type="text" name="saksi2_sidik_jari_nama[]" class="form-control py-1"
                                         value="{{ old('saksi2_sidik_jari_nama.' . $index, $BaSidikJariTersangka['saksi_kedua_nama'] ?? '') }}">
                                 </div>
                             </div>
                             <div class="row mb-1">
                                 <div class="col-md-3 col-sm-12 col-form-label">&nbsp;&nbsp;&nbsp;Alamat</div>
                                 <div class="col-md-1 text-center">:</div>
                                 <div class="col-md-8 col-sm-12">
                                     <input type="text" name="saksi2_sidik_jari_alamat[]" class="form-control py-1"
                                         value="{{ old('saksi2_sidik_jari_alamat.' . $index, $BaSidikJariTersangka['saksi_kedua_alamat'] ?? '') }}">
                                 </div>
                             </div>
                             <div class="row mb-2">
                                 <div class="col-md-3 col-sm-12 col-form-label">&nbsp;&nbsp;&nbsp;Pekerjaan</div>
                                 <div class="col-md-1 text-center">:</div>
                                 <div class="col-md-8 col-sm-12">
                                     <input type="text" name="saksi2_sidik_jari_pekerjaan[]"
                                         class="form-control py-1"
                                         value="{{ old('saksi2_sidik_jari_nama.' . $index, $BaSidikJariTersangka['saksi_kedua_pekerjaan'] ?? '') }}">
                                 </div>
                             </div>
                             <hr>
                         @endforeach

                         <p class="text-black">
                             Dengan cara sebagai berikut:
                         </p>

                         <p class="text-black">
                             --------Sehubungan dengan terjadinya tindak pidana di bidang …….(34)……. yaitu
                             ..(36)………, diduga melanggar …………....……..……(35)…………………..………………
                         </p>

                         <p class="text-black">
                             ---- Demikian Berita Acara Pengambilan Sidik Jari ini dibuat dengan sebenarnya atas
                             kekuatan
                             sumpah jabatan, kemudian ditutup dan ditandatangani di
                             ...................(37)................. pada hari
                             dan tanggal tersebut di
                             atas.----------------------------------------------------------------------------------------
                         </p>

                     </div>
                 </div>
             </div>
         </div>
     </div>
 </div>
