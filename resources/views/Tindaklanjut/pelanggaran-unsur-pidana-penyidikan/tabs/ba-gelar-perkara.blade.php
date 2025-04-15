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

     <h5 class="fw-bold text-center text-black">BERITA ACARA GELAR PERKARA</h5>


     <!-- Main Form -->
     <div class="card p-1">
         <div class="card-body">
             <div class="row">
                 <div class="col-lg-12">
                     <div class="container-fluid px-0 px-sm-3">

                         <p class="text-black">
                             &nbsp;&nbsp;&nbsp; Pada hari ini Rabu tanggal Satu bulan Januari tahun Dua Ribu Dua Puluh
                             Lima.
                         </p>

                         <p class="text-black">
                             Berdasarkan
                             :-----------------------------------------------------------------------------------------------------------
                         <ol class="ps-3 text-black" start="1" style="line-height: 1.5;">
                             <li class="mb-1 ps-1">Laporan Kejadian nomor LK-001/KPU.2064/PPNS/2025 tanggal 01 Januari
                                 2025;</li>
                             <li class="mb-1 ps-1">Surat Perintah Tugas Penyidikan nomor SPTP-001/KPU.206/PPNS/2025
                                 tanggal 01 Januari 2025.</li>
                         </ol>
                         </p>

                         <div class="ps-3 text-black" style="line-height: 1.5;">
                             <p>Hasil gelar perkara berisi:</p>
                             <p class="text-black"><b>Data Tersangka</b></p>
                             @foreach ($tersangkaData as $index => $tersangka)
                                 @php
                                     $BaPerkara = $BaGelarPerkara[$index] ?? null;
                                 @endphp
                                 <hr>

                                 <div class="mb-3 row">
                                     <label class="col-md-3 col-sm-12 col-form-label">Waktu BA Gelar Perkara</label>
                                     <div class="col-md-1 text-center mt-1 d-none d-sm-block">:</div>
                                     <div class="col-md-8 col-sm-11">
                                         <input type="text" class="form-control datetime-datepicker"
                                             name="waktu_ba_gelar_perkara[]"
                                             value="{{ old('waktu_ba_gelar_perkara.' . $index, $BaPerkara['waktu_gelar_perkara'] ?? '') }}">
                                     </div>
                                 </div>

                                 <div class="mb-3 row">
                                     <label class="col-md-3 col-sm-12 col-form-label">Hasil Gelar Perkara Berisi</label>
                                     <div class="col-md-1 text-center mt-1 d-none d-sm-block">:</div>
                                     <div class="col-md-8 col-sm-12">
                                         <textarea name="hasil_gelar_perkara[]" class="form-control" rows="5"
                                             placeholder="1. ..........Diisi Hasil Gelar Perkara..........">{{ $BaPerkara['hasil_gelar_perkara'] ?? '' }}</textarea>
                                     </div>
                                 </div>


                                 <div class="mb-3 row">
                                     <label class="col-md-3 col-sm-12 col-form-label">Nama Lengkap</label>
                                     <div class="col-md-1 text-center mt-1 d-none d-sm-block">:</div>
                                     <div class="col-md-8 col-sm-11">
                                         <input type="text" name="ba_gelar_perkara_nama_tersangka[]"
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
                                     <label class="col-md-3 col-sm-12 col-form-label">Agama</label>
                                     <div class="col-md-1 text-center mt-1 d-none d-sm-block">:</div>
                                     <div class="col-md-8 col-sm-11">
                                         <input type="text" class="form-control border-0 py-1"
                                             value="{{ $tersangka['agama'] ?? '' }}" readonly>
                                     </div>
                                 </div>

                                 <div class="mb-3 row">
                                     <label class="col-md-3 col-sm-12 col-form-label">Jenis Kelamin</label>
                                     <div class="col-md-1 text-center mt-1 d-none d-sm-block">:</div>
                                     <div class="col-md-8 col-sm-11">
                                         <input type="text" class="form-control border-0 py-1"
                                             value="{{ $tersangka['jenis_kelamin'] ?? '' }}" readonly>
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
                                     <label class="col-md-3 col-sm-12 col-form-label">Kesimpulan</label>
                                     <div class="col-md-1 text-center mt-1 d-none d-sm-block">:</div>
                                     <div class="col-md-8 col-sm-12">
                                         <textarea name="kesimpulan_gelar_perkara[]" class="form-control" rows="5"
                                             placeholder="Keimspulan gelar Perkara">{{ $BaPerkara['kesimpulan_gelar_perkara'] ?? '' }}</textarea>
                                     </div>
                                 </div>

                                 <div class="mb-3 row">
                                     <label class="col-md-3 col-sm-12 col-form-label">Rencana kegiatan penyidikan
                                     </label>
                                     <div class="col-md-1 text-center mt-1 d-none d-sm-block">:</div>
                                     <div class="col-md-8 col-sm-12">
                                         <textarea name="rencana_kegiatan_penyidikan[]" class="form-control" rows="5"
                                             placeholder="Rencana Kegiatan Penyidikan">{{ $BaPerkara['rencana_kegiatan_penyidikan'] ?? '' }}</textarea>
                                     </div>
                                 </div>

                                 <div class="row mb-3">
                                     <div class="col-md-12">
                                         @php
                                             $selectedPejabat = json_decode(
                                                 $BaPerkara['pejabat_perkara'] ?? '[]',
                                                 true,
                                             );
                                         @endphp
                                         <div class="input-group flex-column">
                                             <span
                                                 class="input-group-text text-white bg-primary justify-content-center text-center w-100 rounded">
                                                 P E J A B A T | G E L A R | P E R K A R A
                                             </span>
                                             <select class="form-select select2 w-100 mt-1"
                                                 name="pejabat_perkara[{{ $index }}][]" multiple>
                                                 @foreach ($users as $user)
                                                     <option value="{{ $user->id_admin }}"
                                                         @if (in_array($user->id_admin, $selectedPejabat)) selected @endif>
                                                         {{ $user->name }}
                                                     </option>
                                                 @endforeach
                                             </select>
                                         </div>
                                     </div>
                                 </div>


                                 <hr>
                             @endforeach
                         </div>



                         <p class="text-black">
                             Karena diduga keras telah melakukan tindak pidana di bidang ...................... .
                         </p>

                         <br>

                         <div class="text-black">
                             <p>Dengan pertimbangan sebagai berikut:</p>
                             <ol class="ps-3">
                                 <li class="mb-1 ps-1">Keterangan saksi-saksi</li>
                                 <li class="mb-1 ps-1">Surat</li>
                                 <li class="mb-1 ps-1">Petunjuk</li>
                             </ol>
                         </div>


                         <p class="text-black">
                             Kesimpulan :
                             -----------------------------------------------------------------------------------------------------------
                             Telah diperoleh bukti yang cukup Sdr. ASEMI SYAH PUTRA bin IZUL ditetapkan sebagai
                             Tersangka.
                             --------------------------------------------------------------------------------------------------------------
                             Rencana kegiatan penyidikan :
                             ------------------------------------------------------------------------------------
                             Menerbitkan Surat Penetapan Tersangka.
                             ---------------------------------------------------------------------
                         </p>

                         <p class="text-black">
                             Demikian Berita Acara Gelar Perkara ini dibuat dengan sebenarnya atas kekuatan sumpah
                             jabatan, kemudian ditutup dan ditandatangani di Batam pada hari dan tanggal tersebut di
                             atas.
                         </p>


                     </div>
                 </div>
             </div>
         </div>
     </div>
 </div>
