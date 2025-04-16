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

     <h5 class="fw-bold text-center text-black">BERITA ACARA PENAHANAN</h5>


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

                         <br>

                         <p class="text-black">
                             --------- Pada hari ini, ……(3)….. tanggal ……(4)……. bulan ……(5)...... tahun …………(6)………….,
                             saya:
                             <br>---------------------------------------------------------------------------------------
                             <br>------------------------------------- .............(7)...............
                             ----------------------------------------
                             <br>Pangkat / Gol : ........(8)........, Jabatan : Penyidik ........(9).........,
                             bersama-sama dengan:
                             <br>---------------------------------------------------------------------------------------
                             <br>1.
                             ...........(10)............/.........(11)......../Penyidik.............(12)............---------------------------------
                             <br>2. ...........(13)............/.........(14)......../Penyidik
                             .............(15)........... --------------------------------
                             <br><br><strong>Berdasarkan:</strong>
                             <br>---------------------------------------------------------------------------------------
                             <br>1. Surat Perintah Penahanan Nomor : ………….….(16)……….…. tanggal ……(17)……….
                             <br>2. Laporan Kejadian Nomor : ………....(18)..………………. tanggal ……...……(19)……….
                             <br>3. Pasal ……(20)……… Undang-Undang Nomor ………………(21)…………………………
                         </p>


                         <p class="text-black">
                             telah melakukan penahanan terhadap:
                             --------------------------------------------------------------------
                         </p>


                         <p class="text-black"><b>Data Tersangka Penahanan</b></p>
                         @foreach ($tersangkaData as $index => $tersangka)
                             @php
                                 $BaTahanTersangka = $BaPenahananTersangka[$index] ?? null;
                             @endphp
                             <hr>

                             <div class="mb-3 row">
                                 <label class="col-md-3 col-sm-12 col-form-label">Waktu BA Penahanan</label>
                                 <div class="col-md-1 text-center mt-1 d-none d-sm-block">:</div>
                                 <div class="col-md-8 col-sm-11">
                                     <input type="text" class="form-control datetime-datepicker"
                                         name="waktu_ba_penahanan[]"
                                         value="{{ old('waktu_ba_penahanan.' . $index, $BaTahanTersangka['waktu_penahanan'] ?? '') }}">
                                 </div>
                             </div>


                             <div class="mb-3 row">
                                 <label class="col-md-3 col-sm-12 col-form-label">Pejabat Pertama</label>
                                 <div class="col-md-1 text-center mt-1 d-none d-sm-block">:</div>
                                 <div class="col-md-8 col-sm-11">
                                     <select class="form-control py-1 form-select select2" name="pejabat_pertama_penahanan[]">
                                         <option value="" disabled
                                             {{ old('pejabat_pertama_penahanan.' . $index, $BaTahanTersangka['pejabat_pertama_penahanan'] ?? '') == '' ? 'selected' : '' }}>
                                             - Pilih -</option>
                                         @foreach ($users as $user)
                                             <option value="{{ $user->id_admin }}"
                                                 {{ old('pejabat_pertama_penahanan.' . $index, $BaTahanTersangka['pejabat_pertama_penahanan'] ?? '') == $user->id_admin ? 'selected' : '' }}>
                                                 {{ $user->name }} | {{ $user->pangkat }} | {{ $user->jabatan }}
                                             </option>
                                         @endforeach
                                     </select>
                                 </div>
                             </div>


                             <div class="mb-3 row">
                                 <label class="col-md-3 col-sm-12 col-form-label">Pejabat Kedua</label>
                                 <div class="col-md-1 text-center mt-1 d-none d-sm-block">:</div>
                                 <div class="col-md-8 col-sm-11">
                                     <select class="form-control py-1 form-select select2" name="pejabat_kedua_penahanan[]">
                                         <option value="" disabled
                                             {{ old('pejabat_kedua_penahanan.' . $index, $BaTahanTersangka['pejabat_kedua_penahanan'] ?? '') == '' ? 'selected' : '' }}>
                                             - Pilih -</option>
                                         @foreach ($users as $user)
                                             <option value="{{ $user->id_admin }}"
                                                 {{ old('pejabat_kedua_penahanan.' . $index, $BaTahanTersangka['pejabat_kedua_penahanan'] ?? '') == $user->id_admin ? 'selected' : '' }}>
                                                 {{ $user->name }} | {{ $user->pangkat }} | {{ $user->jabatan }}
                                             </option>
                                         @endforeach
                                     </select>
                                 </div>
                             </div>

                             <div class="mb-3 row">
                                 <label class="col-md-3 col-sm-12 col-form-label">Nama</label>
                                 <div class="col-md-1 text-center mt-1 d-none d-sm-block">:</div>
                                 <div class="col-md-8 col-sm-11">
                                     <input type="text" name="ba_penahanan_nama_tersangka[]"
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
                             <hr>
                         @endforeach


                         <p class="text-black">
                             Karena diduga keras telah melakukan tindak pidana .......(31)....... yaitu
                             <br>……………………………………………(32)………………………………………….…………...,
                             <br>melanggar pasal …………………….... (33) …………………………….
                             <br><br>
                             Keadaan kesehatan/fisik dan mental Tersangka sebelum dimasukkan ke dalam ruangan tahanan
                             sehat jasmani dan rohani.
                             <br><br>
                             ------------------ Sidik jari : .................(34)...................
                             <br>------------------ Pemotretan : .................(35)...................
                             <br>------------------ Barang-barang titipan berupa :
                             .................(36)...................
                             <br><br>
                             Demikian Berita Acara Penahanan ini dibuat dengan sebenarnya atas kekuatan sumpah jabatan,
                             kemudian ditutup dan ditandatangani di .......(37)....... pada hari dan tanggal tersebut di
                             atas.
                         </p>


                     </div>
                 </div>
             </div>
         </div>
     </div>
 </div>
