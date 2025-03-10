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

   <h5 class="fw-bold text-center"><u>SURAT PANGGILAN</u></h5>

   <div class="mb-3 row align-items-center">
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
                 <p class="ps-3 text-black" style="line-height: 1.5;">
                   Untuk kepentingan Penyidikan tindak pidana perlu untuk melakukan tindakan pemanggilan terhadap seseorang yang diduga keras
                   melakukan tindakan pidana berdasarkan bukti permulaan yang cukup.
                 </p>
               </div>
             </div>

             <div class="mb-3 row">
               <label class="col-md-3 col-sm-12 col-form-label fw-bold text-md-start">DASAR</label>
               <div class="col-md-1 col-sm-1 text-center mt-1 d-none d-sm-block">:</div>
               <div class="col-md-8 col-sm-11">
                 <ol class="ps-3 text-black" start="1" style="line-height: 1.5;">
                   <li class="mb-1 ps-1">Pasal 7 ayat (1) huruf g, pasal 11, pasal 112 ayat (1) dan ayat (2) dan pasal 113 KUHAP;</li>
                   <li class="mb-1 ps-1">Pasal 112 ayat (1), ayat (2) huruf b dan huruf e Undang-Undang No. 10 tahun 1995 tentang Kepabeanan sebagaimana telah diubah dengan Undang-Undang No. 17 tahun 2006;</li>
                   <li class="mb-1 ps-1">Pasal 63 ayat (2) huruf c Undang-Undang No. 11 tahun 1995 tentang Cukai sebagaimana telah diubah dengan Undang-Undang No. 39 tahun 2007;</li>
                   <li class="mb-1 ps-1">Peraturan Pemerintah Nomor 55 Tahun 1996 tentang Penyidikan Tindak Pidana di Bidang Kepabeanan dan Cukai;</li>
                   <li class="mb-1 ps-1">Laporan Kejadian Tindak Pidana Nomor : LK- ...........(6)........ tanggal ………(7)……..</li>
                   <li class="mb-1 ps-1">Surat Perintah Tugas Penyidikan Nomor: SPTP- ...........(8)........... tanggal ……....(9)....……</li>
                 </ol>
               </div>
             </div>

             <h5 class="fw-bold text-center">MEMANGGIL</h5>

             <div class="mb-3 row">
               <div class="col-md-3 col-sm-12  text-md-start text-white">KEPADA</div>
               <div class="col-md-1 col-sm-1 text-center mt-1 d-none d-sm-block text-white">:</div>
               <div class="col-md-8 col-sm-11">

                 <div class="mb-3">
                   <label class="fw-bold">Pilih Kategori:</label>
                   <select class="form-select select2" id="kategori">
                     <option value="" selected disabled>Pilih</option>
                     <option value="saksi">Saksi (PILIH BAGIAN INI UNTUK MENGISI DATA-DATA SAKSI)</option>
                     <option value="tersangka">Tersangka (PILIH BAGIAN INI UNTUK MENGISI DATA-DATA TERSANGKA)</option>
                   </select>
                 </div>

                 <!-- Container untuk Saksi -->
                 <div id="form-saksi" style="display: none;">
                   <h5 class="fw-bold text-primary">Kumpulan Data Saksi</h5>
                   <div id="dynamic-form-saksi">
                     <div class="entry-saksi text-black">
                       <div class="row mb-3">
                         <div class="col-md-12">
                           <div class="input-group">
                             <span class="input-group-text">NO : SP-</span>
                             <input type="text" class="form-control" name="no_sp1_saksi[]">
                             <span class="input-group-text">/PPNS/</span>
                             <input type="date" class="form-control" name="tgl_sp1_saksi[]">
                           </div>
                         </div>
                       </div>
                       <div class="row mb-3">
                         <div class="col-md-4 d-flex align-items-center">Nama Lengkap</div>
                         <div class="col-md-1 text-center">:</div>
                         <div class="col-md-7"><input type="text" class="form-control py-1" name="saksi_nama[]"></div>
                       </div>
                       <div class="row mb-3">
                         <div class="col-md-4 d-flex align-items-center">Tempat /Tanggal Lahir</div>
                         <div class="col-md-1 text-center">:</div>
                         <div class="col-md-7"><input type="text" class="form-control py-1" name="saksi_ttl[]"></div>
                       </div>
                       <div class="row mb-3">
                         <div class="col-md-4 d-flex align-items-center">Jenis Kelamin</div>
                         <div class="col-md-1 text-center">:</div>
                         <div class="col-md-7">
                           <select class="form-select py-1 select2" name="saksi_kelamin[]">
                             <option value="" selected disabled>Pilih</option>
                             <option value="Laki-laki">Laki-laki</option>
                             <option value="Perempuan">Perempuan</option>
                           </select>
                         </div>
                       </div>
                       <div class="row mb-3">
                         <div class="col-md-4 d-flex align-items-center">Kewarganegaraan</div>
                         <div class="col-md-1 text-center">:</div>
                         <div class="col-md-7">
                           <select class="form-select select2 form-control py-1" name="saksi_kewarganegaraan[]">
                             <option value="" disabled selected>- Pilih Kewarganegaraan -</option>
                             @foreach ($nama_negara as $benua => $negara)
                               <optgroup label="{{ $benua }}">
                                 @foreach ($negara as $item)
                                   <option value="{{ $item->UrEdi }}">{{ $item->UrEdi }}</option>
                                 @endforeach
                               </optgroup>
                             @endforeach
                           </select>
                         </div>
                       </div>
                       <div class="row mb-3">
                         <div class="col-md-4 d-flex align-items-center">Agama</div>
                         <div class="col-md-1 text-center">:</div>
                         <div class="col-md-7"><input type="text" class="form-control py-1" name="saksi_agama[]"></div>
                       </div>
                       <div class="row mb-3">
                         <div class="col-md-4 d-flex align-items-center">Pekerjaan</div>
                         <div class="col-md-1 text-center">:</div>
                         <div class="col-md-7"><input type="text" class="form-control py-1" name="saksi_pekerjaan[]"></div>
                       </div>
                       <div class="row mb-3">
                         <div class="col-md-4 d-flex align-items-center">Alamat Tempat Tinggal</div>
                         <div class="col-md-1 text-center">:</div>
                         <div class="col-md-7"><input type="text" class="form-control py-1" name="saksi_alamat[]"></div>
                       </div>
                       <div class="row mb-3">
                         <div class="col-md-4 d-flex align-items-center">Surat Panggilan Kedua</div>
                         <div class="col-md-1 text-center">:</div>
                         <div class="col-md-7">
                           <select class="form-select py-1 select2" name="surat_panggilan_2_saksi[]">
                             <option value="" selected disabled>Pilih</option>
                             <option value="Ya">Ya</option>
                             <option value="Tidak">Tidak</option>
                           </select>
                         </div>
                       </div>
                       <div class="row mb-3">
                         <div class="col-md-12">
                           <div class="input-group">
                             <span class="input-group-text">NO : SP-</span>
                             <input type="text" class="form-control" name="no_sp2_saksi[]">
                             <span class="input-group-text">/PPNS/</span>
                             <input type="date" class="form-control" name="tgl_sp2_saksi[]">
                           </div>
                         </div>
                       </div>
                       <div class="row mb-3">
                         <div class="col-md-4 d-flex align-items-center">Surat Perintah Membawa</div>
                         <div class="col-md-1 text-center">:</div>
                         <div class="col-md-7">
                           <select class="form-select py-1 select2" name="surat_perintah_membawa_saksi[]">
                             <option value="" selected disabled>Pilih</option>
                             <option value="Ya">Ya</option>
                             <option value="Tidak">Tidak</option>
                           </select>
                         </div>
                       </div>
                       <div class="row mb-3">
                         <div class="col-md-12">
                           <div class="input-group">
                             <span class="input-group-text">NO : SPM-</span>
                             <input type="text" class="form-control" name="no_spm_saksi[]">
                             <span class="input-group-text">/PPNS/</span>
                             <input type="date" class="form-control" name="tgl_spm_saksi[]">
                           </div>
                         </div>
                       </div>
                       <div class="row mb-3">
                         <div class="col-md-4 text-black d-flex align-items-center">SP I Menghadap Kepada</div>
                         <div class="col-md-1 text-center d-flex align-items-center justify-content-center">:</div>
                         <div class="col-md-7">
                           <select class="form-control py-1 form-select select2" name="pejabat_saksi_sp1[]">
                             @foreach ($users as $user)
                               <option value="{{ $user->id_admin }}" {{ in_array($user->id_admin, old('pejabat_saksi', $unsurpenyidikan->pejabat_saksi ?? [])) ? 'selected' : '' }}>
                                 {{ $user->name }} | {{ $user->pangkat }} | {{ $user->jabatan }}
                               </option>
                             @endforeach
                           </select>
                         </div>
                       </div>
                       <div class="row mb-3">
                         <div class="col-md-4 text-black d-flex align-items-center">SP II Menghadap Kepada</div>
                         <div class="col-md-1 text-center d-flex align-items-center justify-content-center">:</div>
                         <div class="col-md-7">
                           <select class="form-control py-1 form-select select2" name="pejabat_saksi_sp2[]">
                             @foreach ($users as $user)
                               <option value="{{ $user->id_admin }}" {{ in_array($user->id_admin, old('pejabat_saksi', $unsurpenyidikan->pejabat_saksi ?? [])) ? 'selected' : '' }}>
                                 {{ $user->name }} | {{ $user->pangkat }} | {{ $user->jabatan }}
                               </option>
                             @endforeach
                           </select>
                         </div>
                       </div>
                       <div class="row mb-3">
                         <div class="col-md-4 d-flex align-items-center">Status Surat Panggilan I</div>
                         <div class="col-md-1 text-center">:</div>
                         <div class="col-md-7">
                           <select class="form-select py-1 select2" name="status_surat_panggilan_1_saksi[]">
                             <option value="" selected disabled>Pilih</option>
                             <option value="Hadir">Hadir</option>
                             <option value="Mangkir">Mangkir</option>
                           </select>
                         </div>
                       </div>
                       <div class="row mb-3">
                         <div class="col-md-4 d-flex align-items-center">Status Surat Panggilan II</div>
                         <div class="col-md-1 text-center">:</div>
                         <div class="col-md-7">
                           <select class="form-select py-1 select2" name="status_surat_panggilan_2_saksi[]">
                             <option value="" selected disabled>Pilih</option>
                             <option value="Hadir">Hadir</option>
                             <option value="Mangkir">Mangkir</option>
                           </select>
                         </div>
                       </div>
                       <hr>
                     </div>
                   </div>
                   <div class="d-flex justify-content-end mt-2">
                     <button type="button" class="btn btn-primary me-2" id="add-saksi"><i data-feather="plus"></i></button>
                     <button type="button" class="btn btn-danger" id="remove-saksi" style="display: none;"><i data-feather="trash-2"></i></button>
                   </div>
                 </div>

                 <!-- Container untuk Tersangka -->
                 <div id="form-tersangka" style="display: none;">
                   <h5 class="fw-bold text-danger">Kumpulan Data Tersangka</h5>
                   <!-- Data yang selalu terlihat -->
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

                   <!-- Data yang disembunyikan -->
                   <div id="data-lengkap" style="display: none;">
                     <div class="row mb-3">
                       <div class="col-md-4 text-black d-flex align-items-center">Jenis Kelamin</div>
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
                   </div>

                   <!-- Tombol Lihat Selengkapnya -->
                   <div class="text-end">
                     <button id="toggleButton" class="btn btn-link text-primary">Lihat Selengkapnya</button>
                   </div>

                   <div id="dynamic-form-tersangka">
                     <div class="entry-tersangka text-black">
                       <hr>
                       <div class="row mb-3">
                         <div class="col-md-12">
                           <div class="input-group">
                             <span class="input-group-text">NO : SP-</span>
                             <input type="text" class="form-control" name="no_sp1_tersangka[]">
                             <span class="input-group-text">/PPNS/</span>
                             <input type="date" class="form-control" name="tgl_sp1_tersangka[]">
                           </div>
                         </div>
                       </div>
                       <div class="row mb-3">
                         <div class="col-md-4 d-flex align-items-center">Nama Lengkap</div>
                         <div class="col-md-1 text-center">:</div>
                         <div class="col-md-7"><input type="text" class="form-control py-1" name="tersangka_nama[]"></div>
                       </div>
                       <div class="row mb-3">
                         <div class="col-md-4 d-flex align-items-center">Tempat /Tanggal Lahir</div>
                         <div class="col-md-1 text-center">:</div>
                         <div class="col-md-7"><input type="text" class="form-control py-1" name="tersangka_ttl[]"></div>
                       </div>
                       <div class="row mb-3">
                         <div class="col-md-4 d-flex align-items-center">Agama</div>
                         <div class="col-md-1 text-center">:</div>
                         <div class="col-md-7"><input type="text" class="form-control py-1" name="tersangka_agama[]"></div>
                       </div>
                       <div class="row mb-3">
                         <div class="col-md-4 d-flex align-items-center">Jenis Kelamin</div>
                         <div class="col-md-1 text-center">:</div>
                         <div class="col-md-7">
                           <select class="form-select py-1 select2" name="tersangka_kelamin[]">
                             <option value="" selected disabled>Pilih</option>
                             <option value="Laki-laki">Laki-laki</option>
                             <option value="Perempuan">Perempuan</option>
                           </select>
                         </div>
                       </div>
                       <div class="row mb-3">
                         <div class="col-md-4 d-flex align-items-center">Kewarganegaraan</div>
                         <div class="col-md-1 text-center">:</div>
                         <div class="col-md-7">
                           <select class="form-select select2 form-control py-1" name="tersangka_kewarganegaraan[]">
                             <option value="" disabled selected>- Pilih Kewarganegaraan -</option>
                             @foreach ($nama_negara as $benua => $negara)
                               <optgroup label="{{ $benua }}">
                                 @foreach ($negara as $item)
                                   <option value="{{ $item->UrEdi }}">{{ $item->UrEdi }}</option>
                                 @endforeach
                               </optgroup>
                             @endforeach
                           </select>
                         </div>
                       </div>
                       <div class="row mb-3">
                         <div class="col-md-4 d-flex align-items-center">Pekerjaan Saat Ini</div>
                         <div class="col-md-1 text-center">:</div>
                         <div class="col-md-7"><input type="text" class="form-control py-1" name="tersangka_pekerjaan[]"></div>
                       </div>
                       <div class="row mb-3">
                         <div class="col-md-4 d-flex align-items-center">Alamat Sesuai Identitas</div>
                         <div class="col-md-1 text-center">:</div>
                         <div class="col-md-7"><input type="text" class="form-control py-1" name="tersangka_alamat[]"></div>
                       </div>
                       <div class="row mb-3">
                         <div class="col-md-4 d-flex align-items-center">Jenis/Nomor Identitas</div>
                         <div class="col-md-1 text-center">:</div>
                         <div class="col-md-7">
                           <div class="input-group">
                             <input type="text" class="form-control py-1" name="tersangka_jenis_identitas[]" placeholder="Jenis Identitas">
                             <input type="text" class="form-control py-1" name="tersangka_nomor_identitas[]" placeholder="Nomor Identitas">
                           </div>
                         </div>
                       </div>
                       <div class="row mb-3">
                         <div class="col-md-4 d-flex align-items-center">Pendidikan Terakhir</div>
                         <div class="col-md-1 text-center">:</div>
                         <div class="col-md-7"><input type="text" class="form-control py-1" name="tersangka_pendidikan[]"></div>
                       </div>
                       <div class="row mb-3">
                         <div class="col-md-12">
                           <div class="input-group">
                             <span class="input-group-text">NO : SP-</span>
                             <input type="text" class="form-control" placeholder="Nomor Surat Panggilan II" name="no_sp2_tersangka[]">
                             <span class="input-group-text">/PPNS/</span>
                             <input type="date" class="form-control" placeholder="Tanggal Surat Panggilan II" name="tgl_sp2_tersangka[]">
                           </div>
                         </div>
                       </div>
                       <div class="row mb-3">
                         <div class="col-md-12">
                           <div class="input-group">
                             <span class="input-group-text">NO : SPM-</span>
                             <input type="text" class="form-control" placeholder="Nomor Surat Perintah Membawa" name="no_spm_tersangka[]">
                             <span class="input-group-text">/PPNS/</span>
                             <input type="date" class="form-control" placeholder="Tanggal Surat Perintah Membawa" name="tgl_spm_tersangka[]">
                           </div>
                         </div>
                       </div>
                       <div class="row mb-3">
                         <div class="col-md-4 text-black d-flex align-items-center">Menghadap Kepada</div>
                         <div class="col-md-1 text-center d-flex align-items-center justify-content-center">:</div>
                         <div class="col-md-7">
                           <select class="form-control form-select py-1 select2" name="pejabat_tersangka[]">
                             @foreach ($users as $user)
                               <option value="{{ $user->id_admin }}" {{ in_array($user->id_admin, old('pejabat_tersangka', $unsurpenyidikan->pejabat_tersangka ?? [])) ? 'selected' : '' }}>
                                 {{ $user->name }} | {{ $user->pangkat }} | {{ $user->jabatan }}
                               </option>
                             @endforeach
                           </select>
                         </div>
                       </div>
                       <div class="row mb-3">
                         <div class="col-md-4 d-flex align-items-center">Status Surat Panggilan II</div>
                         <div class="col-md-1 text-center">:</div>
                         <div class="col-md-7">
                           <select class="form-select py-1 select2" name="status_surat_panggilan_2_saksi[]">
                             <option value="" selected disabled>Pilih</option>
                             <option value="Hadir">Hadir</option>
                             <option value="Mangkir">Mangkir</option>
                           </select>
                         </div>
                       </div>
                       <hr>
                     </div>
                   </div>

                   <div class="d-flex justify-content-end mt-2">
                     <button type="button" class="btn btn-primary me-2" id="add-tersangka"><i data-feather="plus"></i></button>
                     <button type="button" class="btn btn-danger" id="remove-tersangka" style="display: none;"><i data-feather="trash-2"></i></button>
                   </div>
                 </div>



               </div>
             </div>

             <div class="mb-3 row text-black">
               <label class="col-md-3 col-sm-12 col-form-label fw-bold text-md-start">UNTUK</label>
               <div class="col-md-1 col-sm-1 text-center mt-1 d-none d-sm-block">:</div>
               <div class="col-md-8 col-sm-11">

                 <p class="mb-1 ps-1">Menghadap Kepada. ….......(13)…….…...
                   Hari / Tanggal : ………(14)………...
                   Tempat : ………(15)………...
                   Waktu : ………(16)………...
                   Untuk didengar keteranganya sebagai ………(17)………..., atas
                   dugaan tindak Tindak Pidana di bidang ………(18)………., yaitu
                   ………..(19)………….
                 </p>



                 <div class="row mb-3">
                   <div class="col-md-4 text-black d-flex align-items-center">Hari / Tanggal</div>
                   <div class="col-md-1 text-center d-flex align-items-center justify-content-center">:</div>
                   <div class="col-md-7">
                     <input type="text" class="form-control" name="tgl_panggilan1" id="datetime-datepicker" placeholder="Diisi hari, beserta tanggal Saksi / Tersangka menghadap"
                       value="{{ old('tgl_panggilan1', isset($unsurpenyidikan) ? $unsurpenyidikan->tgl_panggilan1 : '') }}">
                   </div>
                 </div>

                 <div class="row mb-3">
                   <div class="col-md-4 text-black d-flex align-items-center">Tempat</div>
                   <div class="col-md-1 text-center d-flex align-items-center justify-content-center">:</div>
                   <div class="col-md-7">
                     <textarea class="form-control" name="tempat_panggilan1" rows="3" placeholder="Diisi tempat Saksi / Tersangka menghadap">{{ old('tempat_panggilan1', isset($unsurpenyidikan) ? $unsurpenyidikan->tempat_panggilan1 : 'di ruang Seksi Penyidikan, Bidang Penindakan dan Penyidikan, Kantor Pelayanan Utama Bea dan Cukai Tipe B Batam, Jln. Kuda Laut, Batu Ampar, Kota Batam') }}</textarea>
                   </div>
                 </div>


                 <div class="row mb-3">
                   <div class="col-md-4 text-black d-flex align-items-center">Penerbit Surat Panggilan</div>
                   <div class="col-md-1 text-center d-flex align-items-center justify-content-center">:</div>
                   <div class="col-md-7">
                     <select class="form-control form-select select2" name="penerbit_sp1">
                       <option value="" disabled {{ empty(old('penerbit_sp1')) && empty($unsurpenyidikan->penerbit_sp1) ? 'selected' : '' }}>- Pilih -</option>
                       @foreach ($users as $user)
                         <option value="{{ $user->id_admin }}" {{ old('penerbit_sp1', $unsurpenyidikan->penerbit_sp1 ?? '') == $user->id_admin ? 'selected' : '' }}>
                           {{ $user->name }} | {{ $user->pangkat }} | {{ $user->jabatan }}
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
   </div>
 </div>

 <script>
   document.addEventListener("DOMContentLoaded", function() {
     // Inisialisasi Select2 awal
     initializeSelect2();

     let kategoriSelect = $('#kategori').select2();
     kategoriSelect.on("change", function() {
       let selected = this.value;
       document.getElementById("form-saksi").style.display = (selected === "saksi") ? "block" : "none";
       document.getElementById("form-tersangka").style.display = (selected === "tersangka") ? "block" : "none";
     });

     kategoriSelect.trigger("change");
   });

   // Fungsi untuk inisialisasi Select2 pada semua elemen yang belum diinisialisasi
   function initializeSelect2() {
     $('.select2:not(.select2-hidden-accessible)').select2();
   }

   function updateRemoveButtonVisibility(formType) {
     let entries = document.querySelectorAll(`#dynamic-form-${formType} .entry-${formType}`);
     document.getElementById(`remove-${formType}`).style.display = entries.length > 1 ? "block" : "none";
   }

   function addEntry(formType) {
     // Simpan referensi ke container
     let formContainer = document.getElementById(`dynamic-form-${formType}`);

     // Hancurkan semua Select2 sebelum kloning untuk menghindari duplikasi
     let originalEntry = document.querySelector(`.entry-${formType}`);
     $(originalEntry).find('.select2-hidden-accessible').each(function() {
       $(this).select2('destroy');
     });

     // Kloning elemen asli
     let newEntry = originalEntry.cloneNode(true);

     // Reinisialisasi Select2 pada elemen asli
     $(originalEntry).find('.select2').each(function() {
       $(this).select2();
     });

     // Reset nilai pada elemen baru
     newEntry.querySelectorAll("input, select").forEach(input => {
       input.value = "";
       // Hapus ID untuk menghindari konflik
       if (input.id) {
         input.removeAttribute('id');
       }
     });

     // Hapus elemen UI Select2 yang mungkin terkloning
     newEntry.querySelectorAll(".select2-container").forEach(el => el.remove());

     // Tambahkan elemen baru ke DOM
     formContainer.appendChild(newEntry);

     // Inisialisasi Select2 pada semua elemen baru
     $(newEntry).find('.select2').each(function() {
       $(this).select2();
     });

     updateRemoveButtonVisibility(formType);
   }

   function removeEntry(formType) {
     let entries = document.querySelectorAll(`#dynamic-form-${formType} .entry-${formType}`);
     if (entries.length > 1) {
       // Dapatkan entri terakhir
       let lastEntry = entries[entries.length - 1];

       // Hancurkan instance Select2 sebelum menghapus
       $(lastEntry).find('.select2-hidden-accessible').each(function() {
         $(this).select2('destroy');
       });

       lastEntry.remove();
       updateRemoveButtonVisibility(formType);
     }
   }

   document.getElementById("add-saksi").addEventListener("click", function() {
     addEntry("saksi");
   });

   document.getElementById("remove-saksi").addEventListener("click", function() {
     removeEntry("saksi");
   });

   document.getElementById("add-tersangka").addEventListener("click", function() {
     addEntry("tersangka");
   });

   document.getElementById("remove-tersangka").addEventListener("click", function() {
     removeEntry("tersangka");
   });

   updateRemoveButtonVisibility("saksi");
   updateRemoveButtonVisibility("tersangka");
   feather.replace();
 </script>

 <!-- JavaScript -->
 <script>
   document.getElementById('toggleButton').addEventListener('click', function() {
     event.preventDefault(); // Mencegah aksi default
     var dataLengkap = document.getElementById('data-lengkap');
     if (dataLengkap.style.display === 'none') {
       dataLengkap.style.display = 'block';
       this.textContent = 'Lihat Lebih Sedikit';
     } else {
       dataLengkap.style.display = 'none';
       this.textContent = 'Lihat Selengkapnya';
     }
   });
 </script>

 {{-- action untuk bagian saksi --}}
