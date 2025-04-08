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

     <h5 class="fw-bold text-center text-black">BERITA ACARA PENGGELEDAHAN<br>(RUMAH/SARANA PENGANGKUT/BADAN)</h5>


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
                             Pangkat .………(9)…………. Jabatan Penyidik pada ..……..(10)….………. , sesuai dengan :
                         <ol class="ps-3 text-black" start="1" style="line-height: 1.5;">
                             <li class="mb-1 ps-1">Surat Perintah Penggeledahan
                                 No...............(11).........tanggal................(12).........................</li>
                             <li class="mb-1 ps-1">Laporan Kejadian No.
                                 ..................................(13)................. tanggal
                                 ......(14).........................</li>
                             <li class="mb-1 ps-1">Izin Penggeledahan Pengadilan Negeri No........(15)........ tanggal
                                 .........(16).........................</li>
                             <li class="mb-1 ps-1">
                                 ....................................................................(17).....................................................................
                             </li>
                         </ol>
                         </p>


                         <p class="text-black">
                             Telah melakukan penggeledahan terhadap sebuah rumah tinggal / tempat tertutup lainnya /
                             sarana pengangkut berupa / badan di
                             ….............................(18)..................................................
                             (Jl. No. RT, Kelurahan) / (Nama Sarana Pengangkut, Nomor Polisi/Register) / (Lokasi),
                             ---------
                             dengan / tanpa izin tersangka / penghuni rumah / pemilik sarana pengangkut / pengemudi /
                             nahkoda / pilot
                             ---------------------------------------------------------------------------------------------------------
                         </p>

                         <p class="text-black"><b>Data Tersangka</b></p>
                         @foreach ($tersangkaData as $index => $tersangka)
                             <hr>

                             <div class="mb-3 row">
                                 <label class="col-md-3 col-sm-12 col-form-label">Waktu BA Geledah</label>
                                 <div class="col-md-1 text-center mt-1 d-none d-sm-block">:</div>
                                 <div class="col-md-8 col-sm-11">
                                     <input type="text" class="form-control datetime-datepicker"
                                         name="waktu_ba_geledah[]"
                                         value="{{ old('waktu_ba_geledah.' . $index, $saksiSumpah['waktu_geledah'] ?? '') }}">
                                 </div>
                             </div>


                             <div class="mb-3 row">
                                 <label class="col-md-3 col-sm-12 col-form-label">Pejabat Penerbit BA
                                     Penggeledahan</label>
                                 <div class="col-md-1 text-center mt-1 d-none d-sm-block">:</div>
                                 <div class="col-md-8 col-sm-11">
                                     <select class="form-control py-1 form-select select2"
                                         name="pejabat_penerbit_surat_penggeledahan_tersangka_ba[]">
                                         <option value="" disabled
                                             {{ old('pejabat_penerbit_surat_penggeledahan_tersangka_ba.' . $index, $geledahTersangka['pejabat_penerbit_ba'] ?? '') == '' ? 'selected' : '' }}>
                                             - Pilih -</option>

                                         @foreach ($users as $user)
                                             <option value="{{ $user->id_admin }}"
                                                 {{ old('pejabat_penerbit_surat_penggeledahan_tersangka_ba.' . $index, $geledahTersangka['pejabat_penerbit_ba'] ?? '') == $user->id_admin ? 'selected' : '' }}>
                                                 {{ $user->name }} | {{ $user->pangkat }} |
                                                 {{ $user->jabatan }}
                                             </option>
                                         @endforeach
                                     </select>
                                 </div>
                             </div>

                             <div class="mb-3 row">
                                 <label class="col-md-3 col-sm-12 col-form-label">Izin Penggeledahan Pengadilan Negeri
                                     No</label>
                                 <div class="col-md-1 text-center mt-1 d-none d-sm-block">:</div>
                                 <div class="col-md-8 col-sm-11">
                                     <input type="text" name="ba_penggeledahan_izin_pengadilan[]"
                                         class="form-control py-1" value="{{ $tersangka['izin_pengadilan'] ?? '' }}">
                                 </div>
                             </div>

                             <div class="mb-3 row">
                                 <label class="col-md-3 col-sm-12 col-form-label">Izin Lainnya</label>
                                 <div class="col-md-1 text-center mt-1 d-none d-sm-block">:</div>
                                 <div class="col-md-8 col-sm-11">
                                     <input type="text" name="ba_penggeledahan_izin_lain[]" class="form-control py-1"
                                         value="{{ $tersangka['izin_lainnya'] ?? '' }}">
                                 </div>
                             </div>

                             <div class="mb-3 row">
                                 <label class="col-md-3 col-sm-12 col-form-label">Diisi</label>
                                 <div class="col-md-1 text-center mt-1 d-none d-sm-block">:</div>
                                 <div class="col-md-8 col-sm-12">
                                     <textarea name="diisi_ba_penggeledahan[]" class="form-control" rows="5"
                                         placeholder="Diisi (Jl. No. RT, kelurahan) / (nama sarana pengangkut,nomor polisi/register) / (lokasi)">{{ $tersangka['isi_ba_geledah'] ?? '' }}</textarea>
                                 </div>
                             </div>


                              <div class="mb-3 row">
                                 <label class="col-md-3 col-sm-12 col-form-label">Diisi</label>
                                 <div class="col-md-1 text-center mt-1 d-none d-sm-block">:</div>
                                 <div class="col-md-8 col-sm-12">
                                     <textarea name="diisi_identitas_ba_penggeledahan[]" class="form-control" rows="5"
                                         placeholder="Diisi Nama Tersangka/penghuni rumah/pemilik sarana pengangkut/pengemudi/nahkoda/pilot">{{ $tersangka['isi_ba_geledah_identitas'] ?? '' }}</textarea>
                                 </div>
                             </div>


                             <div class="mb-3 row">
                                 <label class="col-md-3 col-sm-12 col-form-label">Nama</label>
                                 <div class="col-md-1 text-center mt-1 d-none d-sm-block">:</div>
                                 <div class="col-md-8 col-sm-11">
                                     <input type="text" name="ba_penggeledahan_nama_tersangka[]"
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
                                     <input type="text" name="saksi1_geledah_nama[]" class="form-control py-1" value="{{ old('saksi1_geledah_nama.' . $index, $saksiSumpah['saksi_pertama_nama'] ?? '') }}">
                                 </div>
                             </div>
                             <div class="row mb-1">
                                 <div class="col-md-3 col-sm-12 col-form-label">&nbsp;&nbsp;&nbsp;Alamat</div>
                                 <div class="col-md-1 text-center">:</div>
                                 <div class="col-md-8 col-sm-12">
                                     <input type="text" name="saksi1_geledah_alamat[]" class="form-control py-1" value="{{ old('saksi1_geledah_alamat.' . $index, $saksiSumpah['saksi_pertama_alamat'] ?? '') }}">
                                 </div>
                             </div>
                             <div class="row mb-2">
                                 <div class="col-md-3 col-sm-12 col-form-label">&nbsp;&nbsp;&nbsp;Pekerjaan</div>
                                 <div class="col-md-1 text-center">:</div>
                                 <div class="col-md-8 col-sm-12">
                                     <input type="text" name="saksi1_geledah_pekerjaan[]"
                                         class="form-control py-1" value="{{ old('saksi1_geledah_pekerjaan.' . $index, $saksiSumpah['saksi_pertama_pekerjaan'] ?? '') }}">
                                 </div>
                             </div>

                             {{-- Saksi 2 --}}
                             <div class="row mb-1">
                                 <div class="col-md-3 col-sm-12 col-form-label">2. Nama</div>
                                 <div class="col-md-1 text-center">:</div>
                                 <div class="col-md-8 col-sm-12">
                                     <input type="text" name="saksi2_geledah_nama[]" class="form-control py-1" value="{{ old('saksi2_geledah_nama.' . $index, $saksiSumpah['saksi_kedua_nama'] ?? '') }}"> 
                                 </div>
                             </div>
                             <div class="row mb-1">
                                 <div class="col-md-3 col-sm-12 col-form-label">&nbsp;&nbsp;&nbsp;Alamat</div>
                                 <div class="col-md-1 text-center">:</div>
                                 <div class="col-md-8 col-sm-12">
                                     <input type="text" name="saksi2_geledah_alamat[]" class="form-control py-1" value="{{ old('saksi2_geledah_alamat.' . $index, $saksiSumpah['saksi_kedua_alamat'] ?? '') }}">
                                 </div>
                             </div>
                             <div class="row mb-2">
                                 <div class="col-md-3 col-sm-12 col-form-label">&nbsp;&nbsp;&nbsp;Pekerjaan</div>
                                 <div class="col-md-1 text-center">:</div>
                                 <div class="col-md-8 col-sm-12">
                                     <input type="text" name="saksi2_geledah_pekerjaan[]"
                                         class="form-control py-1" value="{{ old('saksi2_geledah_nama.' . $index, $saksiSumpah['saksi_kedua_pekerjaan'] ?? '') }}">
                                 </div>
                             </div>


                             {{-- Uraian singkat --}}
                             <div class="mb-3 row">
                                 <label class="col-md-3 col-sm-12 col-form-label">Uraian singkat jalannya penggeledahan
                                     dan hasilnya</label>
                                 <div class="col-md-1 text-center mt-1 d-none d-sm-block">:</div>
                                 <div class="col-md-8 col-sm-12">
                                     <textarea name="uraian_penggeledahan[]" class="form-control" rows="5"
                                         placeholder="Masukkan uraian singkat...">{{ $tersangka['uraian_penggeledahan'] ?? '' }}</textarea>
                                 </div>
                             </div>
                             <hr>
                         @endforeach
                     </div>
                 </div>
             </div>
         </div>
     </div>
 </div>
