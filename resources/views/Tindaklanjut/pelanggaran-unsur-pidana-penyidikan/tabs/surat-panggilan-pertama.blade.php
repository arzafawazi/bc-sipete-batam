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
                                             <hr>
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
                                                 <div class="col-md-12">
                                                     <div class="input-group">
                                                         <span class="input-group-text">NO : SP-</span>
                                                         <input type="text" class="form-control" placeholder="Nomor Surat Panggilan II" name="no_sp2_saksi[]">
                                                         <span class="input-group-text">/PPNS/</span>
                                                         <input type="date" class="form-control" placeholder="Tanggal Surat Panggilan II" name="tgl_sp2_saksi[]">
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
                                                 <div class="col-md-4 text-black d-flex align-items-center">Waktu Surat Panggilan I</div>
                                                 <div class="col-md-1 text-center d-flex align-items-center justify-content-center">:</div>
                                                 <div class="col-md-7">
                                                     <input type="text" class="form-control" name="tgl_panggilan_1_saksi[]" id="datetime-datepicker" placeholder="Diisi hari, beserta tanggal Saksi / Tersangka menghadap" value="{{ old('tgl_panggilan1', isset($unsurpenyidikan) ? $unsurpenyidikan->tgl_panggilan1 : '') }}">
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
                                             <div class="row mb-3">
                                                 <div class="col-md-4 text-black d-flex align-items-center">Waktu Surat Panggilan II</div>
                                                 <div class="col-md-1 text-center d-flex align-items-center justify-content-center">:</div>
                                                 <div class="col-md-7">
                                                     <input type="text" class="form-control " name="tgl_panggilan_2_saksi[]" id="datetime-datepicker" class="" placeholder="Diisi hari, beserta tanggal Saksi / Tersangka menghadap" value="{{ old('tgl_panggilan1', isset($unsurpenyidikan) ? $unsurpenyidikan->tgl_panggilan1 : '') }}">
                                                 </div>
                                             </div>
                                             <div class="row mb-3">
                                                 <div class="col-md-12">
                                                     <div class="input-group">
                                                         <span class="input-group-text">NO : SPM-</span>
                                                         <input type="text" class="form-control" placeholder="Nomor Surat Perintah Membawa" name="no_spm_saksi[]">
                                                         <span class="input-group-text">/PPNS/</span>
                                                         <input type="date" class="form-control" placeholder="Tanggal Surat Perintah Membawa" name="tgl_spm_saksi[]">
                                                     </div>
                                                 </div>
                                             </div>
                                             <div class="row mb-3">
                                                 <div class="col-md-12">
                                                     <div class="input-group flex-column">
                                                         <span class="input-group-text text-white bg-primary justify-content-center text-center w-100 rounded">
                                                             D I P E R I N T A H K A N
                                                         </span>
                                                         <select class="form-select select2 w-100 mt-1" id="pejabat_saksi_spm" name="pejabat_saksi_spm[0][]" multiple>
                                                             @foreach ($users as $user)
                                                             <option value="{{ $user->id_admin }}">{{ $user->name }}</option>
                                                             @endforeach
                                                         </select>
                                                     </div>
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
                                                 <div class="col-md-4 text-black d-flex align-items-center">SP I Menghadap Kepada</div>
                                                 <div class="col-md-1 text-center d-flex align-items-center justify-content-center">:</div>
                                                 <div class="col-md-7">
                                                     <select class="form-control py-1 form-select select2" name="pejabat_tersangka_sp1[]">
                                                         @foreach ($users as $user)
                                                         <option value="{{ $user->id_admin }}" {{ in_array($user->id_admin, old('pejabat_tersangka', $unsurpenyidikan->pejabat_tersangka ?? [])) ? 'selected' : '' }}>
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
                                                     <select class="form-control py-1 form-select select2" name="pejabat_tersangka_sp2[]">
                                                         @foreach ($users as $user)
                                                         <option value="{{ $user->id_admin }}" {{ in_array($user->id_admin, old('pejabat_tersangka', $unsurpenyidikan->pejabat_tersangka ?? [])) ? 'selected' : '' }}>
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
                                                     <select class="form-select py-1 select2" name="status_surat_panggilan_1_tersangka[]">
                                                         <option value="" selected disabled>Pilih</option>
                                                         <option value="Hadir">Hadir</option>
                                                         <option value="Mangkir">Mangkir</option>
                                                     </select>
                                                 </div>
                                             </div>
                                             <div class="row mb-3">
                                                 <div class="col-md-4 text-black d-flex align-items-center">Waktu Surat Panggilan I</div>
                                                 <div class="col-md-1 text-center d-flex align-items-center justify-content-center">:</div>
                                                 <div class="col-md-7">
                                                     <input type="text" class="form-control" name="tgl_panggilan_1_tersangka[]" id="datetime-datepicker-1" class="datetime-datepicker" placeholder="Diisi hari, beserta tanggal Saksi / Tersangka menghadap" value="{{ old('tgl_panggilan1', isset($unsurpenyidikan) ? $unsurpenyidikan->tgl_panggilan1 : '') }}">
                                                 </div>
                                             </div>
                                             <div class="row mb-3">
                                                 <div class="col-md-4 d-flex align-items-center">Status Surat Panggilan II</div>
                                                 <div class="col-md-1 text-center">:</div>
                                                 <div class="col-md-7">
                                                     <select class="form-select py-1 select2" name="status_surat_panggilan_2_tersangka[]">
                                                         <option value="" selected disabled>Pilih</option>
                                                         <option value="Hadir">Hadir</option>
                                                         <option value="Mangkir">Mangkir</option>
                                                     </select>
                                                 </div>
                                             </div>
                                             <div class="row mb-3">
                                                 <div class="col-md-4 text-black d-flex align-items-center">Waktu Surat Panggilan II</div>
                                                 <div class="col-md-1 text-center d-flex align-items-center justify-content-center">:</div>
                                                 <div class="col-md-7">
                                                     <input type="text" class="form-control" name="tgl_panggilan_2_tersangka[]" id="datetime-datepicker-2" class="datetime-datepicker" placeholder="Diisi hari, beserta tanggal Saksi / Tersangka menghadap" value="{{ old('tgl_panggilan1', isset($unsurpenyidikan) ? $unsurpenyidikan->tgl_panggilan1 : '') }}">
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
                                                 <div class="col-md-12">
                                                     <div class="input-group flex-column">
                                                         <span class="input-group-text text-white bg-primary justify-content-center text-center w-100 rounded">
                                                             D I P E R I N T A H K A N
                                                         </span>
                                                         <select class="form-select select2 w-100 mt-1" id="pejabat_tersangka_spm" name="pejabat_tersangka_spm[0][]" multiple>
                                                             @foreach ($users as $user)
                                                             <option value="{{ $user->id_admin }}">{{ $user->name }}</option>
                                                             @endforeach
                                                         </select>
                                                     </div>
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
                                     <div class="col-md-4 text-black d-flex align-items-center">Tempat</div>
                                     <div class="col-md-1 text-center d-flex align-items-center justify-content-center">:</div>
                                     <div class="col-md-7">
                                         <textarea class="form-control" name="tempat_panggilan" rows="3" placeholder="Diisi tempat Saksi / Tersangka menghadap">{{ old('tempat_panggilan1', isset($unsurpenyidikan) ? $unsurpenyidikan->tempat_panggilan1 : 'di ruang Seksi Penyidikan, Bidang Penindakan dan Penyidikan, Kantor Pelayanan Utama Bea dan Cukai Tipe B Batam, Jln. Kuda Laut, Batu Ampar, Kota Batam') }}</textarea>
                                     </div>
                                 </div>


                                 {{-- <div class="row mb-3">
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
                         </div> --}}



                     </div>
                 </div>
             </div>
         </div>
     </div>
 </div>
 </div>
 </div>

 {{--
bagian handle untuk change inputan select2 bagian tersangka dan saksi, serta passing data json dari database ke field tersangka --}}

 <script>
     document.addEventListener("DOMContentLoaded", function() {
         // Initialize components
         initializeSelect2();
         initializeFlatpickrForAll();

         // Set up category change handler
         let kategoriSelect = $("#kategori").select2();
         kategoriSelect.on("change", function() {
             let selected = this.value;
             document.getElementById("form-saksi").style.display = selected === "saksi" ? "block" : "none";
             document.getElementById("form-tersangka").style.display = selected === "tersangka" ? "block" : "none";
         });
         kategoriSelect.trigger("change");

         // Initialize forms based on available data
         initializeFormData();

         // Register event handlers for add/remove buttons
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
     });


     // Initialize Select2 for all applicable elements
     function initializeSelect2() {
         $(".select2:not(.select2-hidden-accessible)").select2();
     }

     // Initialize Flatpickr for all date inputs
     function initializeFlatpickrForAll() {
         const dateInputs = document.querySelectorAll('input[name^="tgl_panggilan_"]:not(.flatpickr-initialized)');

         dateInputs.forEach(function(input, index) {
             input.classList.add("flatpickr-initialized");

             if (!input.id || input.id === "datetime-datepicker") {
                 input.id = "datetime-datepicker-" + new Date().getTime() + "-" + index;
             }

             flatpickr("#" + input.id, {
                 dateFormat: "Y-m-d H:i"
                 , enableTime: true
                 , time_24hr: true
                 , locale: "id"
                 , onClose: function(selectedDates) {
                      console.log("Selected date:", selectedDates);
                 }
             , });
         });
     }

     let data_saksi = <?php echo json_encode($saksiData, JSON_PRETTY_PRINT); ?>;
    console.log("Data saksi dari PHP:", data_saksi);
    console.log("Jumlah saksi:", data_saksi.length);


   function initializeFormData() {
     if (typeof data_saksi !== "undefined" && data_saksi.length > 0) {
       let container = document.getElementById("dynamic-form-saksi");
       container.innerHTML = ""; // Kosongkan sebelum mengisi ulang

       data_saksi.forEach((saksi, index) => {
          console.log("Memproses saksi:", saksi);
         let newEntry = generateSaksiEntryHTML(saksi, index === 0, index);
         container.appendChild(newEntry);
       });

       updateRemoveButtonVisibility("saksi");
       initializeSelect2();
       initializeFlatpickrForAll();
     }
   }


   // Helper function to generate HTML for a saksi entry
   function generateSaksiEntryHTML(saksi = {}, isFirst = false, index = 0) {

    let uniqueId = "pejabat_saksi_spm_" + new Date().getTime() + "_" + Math.random().toString(36).substring(2, 8);
     // Create a wrapper div
     let entryDiv = document.createElement('div');
     entryDiv.className = 'entry-saksi text-black';

     entryDiv.innerHTML = `
    <div class="row mb-3">
      <div class="col-md-12">
        <div class="input-group">
          <span class="input-group-text">NO : SP-</span>
          <input type="text" class="form-control" name="no_sp1_saksi[]" value="${saksi.no_sp1 || ''}">
          <span class="input-group-text">/PPNS/</span>
          <input type="date" class="form-control" name="tgl_sp1_saksi[]" value="${saksi.tgl_sp1 || ''}">
        </div>
      </div>
    </div> 
    <div class="row mb-3">
         <div class="col-md-4 d-flex align-items-center">Nama Lengkap</div> 
         <div class="col-md-1 text-center">: </div> 
         <div class="col-md-7"><input type="text" class="form-control py-1" name="saksi_nama[]" value="${saksi.nama || ''}"></div>
    </div>
    <div class="row mb-3">
      <div class="col-md-4 d-flex align-items-center">Tempat /Tanggal Lahir</div>
      <div class="col-md-1 text-center">:</div>
      <div class="col-md-7"><input type="text" class="form-control py-1" name="saksi_ttl[]" value="${saksi.ttl || ''}"></div>
    </div>
    <div class="row mb-3">
      <div class="col-md-4 d-flex align-items-center">Jenis Kelamin</div>
      <div class="col-md-1 text-center">:</div>
      <div class="col-md-7">
        <select class="form-select py-1 select2" name="saksi_kelamin[]">
          <option value="Laki-laki" ${(saksi.jenis_kelamin === "Laki-laki") ? "selected" : ""}>Laki-laki</option>
          <option value="Perempuan" ${(saksi.jenis_kelamin === "Perempuan") ? "selected" : ""}>Perempuan</option>
        </select>
      </div>
    </div>
    <div class="row mb-3">
      <div class="col-md-4 d-flex align-items-center">Kewarganegaraan</div>
      <div class="col-md-1 text-center">:</div>
      <div class="col-md-7">
        <select class="form-select form-control py-1 select2" name="saksi_kewarganegaraan[]" id="saksi_kewarganegaraan">
          <option value="" disabled>- Pilih Kewarganegaraan -</option>
               @foreach ($nama_negara as $benua => $negara)
                  <optgroup label="{{ $benua }}">
                  @foreach ($negara as $item)
    <option value="{{ $item->UrEdi }}" ${saksi.kewarganegaraan === '{{ $item->UrEdi }}' ? 'selected' : ''}>{{ $item->UrEdi }}<option>
                  @endforeach
                  </optgroup>
                  @endforeach
        </select>
          </div>
        </div>
    <div class="row mb-3">
      <div class="col-md-4 d-flex align-items-center">Agama</div>
      <div class="col-md-1 text-center">:</div>
      <div class="col-md-7"><input type="text" class="form-control py-1" name="saksi_agama[]" value="${saksi.agama || ''}"></div>
    </div>
    <div class="row mb-3">
      <div class="col-md-4 d-flex align-items-center">Pekerjaan</div>
      <div class="col-md-1 text-center">:</div>
      <div class="col-md-7"><input type="text" class="form-control py-1" name="saksi_pekerjaan[]" value="${saksi.pekerjaan || ''}"></div>
    </div>
    <div class="row mb-3">
      <div class="col-md-4 d-flex align-items-center">Alamat Tempat Tinggal</div>
      <div class="col-md-1 text-center">:</div>
      <div class="col-md-7"><input type="text" class="form-control py-1" name="saksi_alamat[]" value="${saksi.alamat || ''}"></div>
    </div>
    <div class="row mb-3">
      <div class="col-md-12">
        <div class="input-group">
          <span class="input-group-text">NO : SP-</span>
          <input type="text" class="form-control" placeholder="Nomor Surat Panggilan II" name="no_sp2_saksi[]" value="${saksi.no_sp2 || ''}">
          <span class="input-group-text">/PPNS/</span>
          <input type="date" class="form-control" placeholder="Tanggal Surat Panggilan II" name="tgl_sp2_saksi[]" value="${saksi.tgl_sp2 || ''}">
        </div>
      </div>
    </div>
    <div class="row mb-3">
      <div class="col-md-4 text-black d-flex align-items-center">SP I Menghadap Kepada</div>
      <div class="col-md-1 text-center d-flex align-items-center justify-content-center">:</div>
      <div class="col-md-7">
        <select class="form-select py-1 select2" name="pejabat_saksi_sp1[]" id="pejabat_saksi_sp1">
    <option value="" disabled>- Pilih Pejabat -</option>
    @foreach ($users as $user)
      <option value="{{ $user->id_admin }}" ${saksi.pejabat_sp1 === '{{ $user->id_admin }}' ? 'selected' : ''}>{{ $user->name }}</option>
    @endforeach
  </select>
      </div>
    </div>
    <div class="row mb-3">
      <div class="col-md-4 text-black d-flex align-items-center">SP II Menghadap Kepada</div>
      <div class="col-md-1 text-center d-flex align-items-center justify-content-center">:</div>
      <div class="col-md-7">
         <select class="form-select py-1 select2" name="pejabat_saksi_sp2[]" id="pejabat_saksi_sp2">
    <option value="" disabled>- Pilih Pejabat -</option>
    @foreach ($users as $user)
      <option value="{{ $user->id_admin }}" ${saksi.pejabat_sp2 === '{{ $user->id_admin }}' ? 'selected' : ''}>{{ $user->name }}</option>
    @endforeach
  </select>
      </div>
    </div>
    <div class="row mb-3">
      <div class="col-md-4 d-flex align-items-center">Status Surat Panggilan I</div>
      <div class="col-md-1 text-center">:</div>
      <div class="col-md-7">
        <select class="form-select py-1 select2" name="status_surat_panggilan_1_saksi[]">
          <option value="" disabled>Pilih</option>
          <option value="Hadir" ${saksi.status_surat_panggilan_1 == 'Hadir' ? 'selected' : ''}>Hadir</option>
          <option value="Mangkir" ${saksi.status_surat_panggilan_1 == 'Mangkir' ? 'selected' : ''}>Mangkir</option>
        </select>
      </div>
    </div>
    <div class="row mb-3">
      <div class="col-md-4 text-black d-flex align-items-center">Waktu Surat Panggilan I</div>
      <div class="col-md-1 text-center d-flex align-items-center justify-content-center">:</div>
      <div class="col-md-7">
        <input type="text" class="form-control" name="tgl_panggilan_1_saksi[]" id="datetime-datepicker" 
          placeholder="Diisi hari, beserta tanggal Saksi / Tersangka menghadap" value="${saksi.tgl_panggilan_1 || ''}">
      </div>
    </div>
    <div class="row mb-3">
      <div class="col-md-4 d-flex align-items-center">Status Surat Panggilan II</div>
      <div class="col-md-1 text-center">:</div>
      <div class="col-md-7">
        <select class="form-select py-1 select2" name="status_surat_panggilan_2_saksi[]">
          <option value="" disabled>Pilih</option>
          <option value="Hadir" ${saksi.status_surat_panggilan_2 == 'Hadir' ? 'selected' : ''}>Hadir</option>
          <option value="Mangkir" ${saksi.status_surat_panggilan_2 == 'Mangkir' ? 'selected' : ''}>Mangkir</option>
        </select>
      </div>
    </div>
    <div class="row mb-3">
      <div class="col-md-4 text-black d-flex align-items-center">Waktu Surat Panggilan II</div>
      <div class="col-md-1 text-center d-flex align-items-center justify-content-center">:</div>
      <div class="col-md-7">
        <input type="text" class="form-control" name="tgl_panggilan_2_saksi[]" id="datetime-datepicker" 
          placeholder="Diisi hari, beserta tanggal Saksi / Tersangka menghadap" value="${saksi.tgl_panggilan_2 || ''}">
      </div>
    </div>
    <div class="row mb-3">
      <div class="col-md-12">
        <div class="input-group">
          <span class="input-group-text">NO : SPM-</span>
          <input type="text" class="form-control" placeholder="Nomor Surat Perintah Membawa" name="no_spm_saksi[]" value="${saksi.no_spm || ''}">
          <span class="input-group-text">/PPNS/</span>
          <input type="date" class="form-control" placeholder="Tanggal Surat Perintah Membawa" name="tgl_spm_saksi[]" value="${saksi.tgl_spm || ''}">
        </div>
      </div>
    </div>
<div class="row mb-3">
<div class="col-md-12">
<div class="input-group flex-column">
<span class="input-group-text text-white bg-primary justify-content-center text-center w-100 rounded">D I P E R I N T A H K A N</span>
    <select class="form-select select2 w-100" id="${uniqueId}" name="pejabat_saksi_spm[${index}][]" multiple>
      <option value="" disabled>- Pilih Pejabat -</option>
      @foreach ($users as $user)
        <option value="{{ $user->id_admin }}" ${saksi.pejabat_spm && saksi.pejabat_spm.includes('{{ $user->id_admin }}') ? 'selected' : ''}>{{ $user->name }}</option>
      @endforeach
    </select>
    </div>
  </div>
  </div>
   <button type="button" class="btn btn-danger remove-btn my-2" style='display:none;'>
    <i data-feather="trash-2"></i> Hapus
    </button>

  `;

     let removeBtn = entryDiv.querySelector('.remove-btn');
     if (removeBtn) {
       removeBtn.addEventListener('click', function() {
         entryDiv.remove();
         updateRemoveButtonVisibility("saksi");
       ;});
     }

     return entryDiv;
   }

   document.addEventListener("DOMContentLoaded", function() {
     document.querySelectorAll('.remove-btn').forEach(btn => {
       btn.style.display = 'none';
     });
   });

   function createNewEntry(formType, data = {}, isFirst = false) {
     let originalEntry = document.querySelector(`.entry-${formType}`);

     // Pastikan template entry ada
     if (!originalEntry) {
         console.log(`Elemen .entry-${formType} tidak ditemukan!`);
       return null;
     }

     // Temporarily destroy Select2 for proper cloning
     $(originalEntry).find(".select2-hidden-accessible").each(function() {
       $(this).select2("destroy");
     });

     let newEntry = originalEntry.cloneNode(true);

     // Restore Select2 on original entry
     $(originalEntry).find(".select2").each(function() {
       $(this).select2();
     });

     // If data is provided (edit mode), fill the form fields
     newEntry.querySelectorAll("input, select").forEach((input) => {
       let fieldName = input.name.replace("[]", "");
       input.value = data[fieldName] || "";

       // Prepare date inputs for flatpickr initialization
       if (input.name.startsWith("tgl_panggilan_")) {
         input.classList.remove("flatpickr-initialized");
         input.id = "datetime-datepicker-" + new Date().getTime() + "-" + Math.random().toString(36).substring(2, 8);
       }
     });

     // Clean up any existing flatpickr calendars and select2 containers
     newEntry.querySelectorAll(".flatpickr-calendar").forEach((el) => el.remove());
     newEntry.querySelectorAll(".select2-container").forEach((el) => el.remove());

     // Handle the remove button visibility
     let removeBtn = newEntry.querySelector('.remove-btn');
     if (removeBtn) {
       removeBtn.style.display = isFirst ? "none" : "block";
       removeBtn.addEventListener('click', function() {
         newEntry.remove();
         updateRemoveButtonVisibility(formType);
       });
     } else {
         console.log("Remove button tidak ditemukan dalam newEntry!");
     }

     return newEntry;
   }

   // Update visibility of remove buttons based on number of entries
   function updateRemoveButtonVisibility(formType) {
     let entries = document.querySelectorAll(`#dynamic-form-${formType} .entry-${formType}`);
     let removeButton = document.getElementById(`remove-${formType}`);

     if (removeButton) {
       removeButton.style.display = entries.length > 1 ? "block" : "none";
     }

     // Also update the first entry's remove button (always hide it)
     if (entries.length > 0) {
       entries[0].querySelector(".remove-btn").style.display = "none";
     }
   }

   // Add a new entry to the form
   function addEntry(formType) {
    let formContainer = document.getElementById(`dynamic-form-${formType}`);
     let currentEntries = formContainer.querySelectorAll(`.entry-${formType}`);
    let newIndex = currentEntries.length;
    
    // Buat entri baru
    let newEntry;
    if (formType === "saksi") {
        newEntry = generateSaksiEntryHTML({}, false, newIndex);
    } else if (formType === "tersangka") {
        newEntry = generateTersangkaEntryHTML({}, false, newIndex);
    }
    
    if (newEntry) {
        // Hapus semua instance Select2 yang ada
        $(formContainer).find('.select2-hidden-accessible').select2('destroy');
        
        // Tambahkan entri baru
        formContainer.appendChild(newEntry);
        
        // Event listener untuk tombol hapus
        let removeBtn = newEntry.querySelector('.remove-btn');
        if (removeBtn) {
            removeBtn.addEventListener('click', function() {
                newEntry.remove();
                updateRemoveButtonVisibility(formType);
                // Reinisialisasi select2 setelah menghapus entri
                initializeSelect2ForContainer(formContainer);
            });
        }
        
        // Inisialisasi semua Select2 dalam container
        initializeSelect2ForContainer(formContainer);

        let uniqueId = "pejabat_saksi_spm_" + new Date().getTime() + "_" + Math.random().toString(36).substring(2, 8);

        
        // Inisialisasi Flatpickr
        newEntry.querySelectorAll('input[name^="tgl_panggilan_"]:not(.flatpickr-initialized)').forEach(function(input, index) {
            input.classList.add("flatpickr-initialized");
            if (!input.id || input.id === "datetime-datepicker") {
                input.id = "datetime-datepicker-" + new Date().getTime() + "-" + index;
            }
            flatpickr("#" + input.id, {
                dateFormat: "Y-m-d H:i",
                enableTime: true,
                time_24hr: true,
                locale: "id"
            });
        });
        
        if (typeof feather !== 'undefined') {
            feather.replace();
        }
        
        updateRemoveButtonVisibility(formType);
    }
}

// Fungsi bantuan untuk inisialisasi semua Select2 dalam container
function initializeSelect2ForContainer(container) {
    $(container).find('.select2:not(.select2-hidden-accessible)').each(function() {
        $(this).select2();
    });
}

   // Remove the last entry from the form
   function removeEntry(formType) {
     let entries = document.querySelectorAll(`#dynamic-form-${formType} .entry-${formType}`);
     if (entries.length > 1) {
       let lastEntry = entries[entries.length - 1];

       // Destroy Select2 instances before removing the entry
       $(lastEntry).find(".select2-hidden-accessible").each(function() {
         $(this).select2("destroy");
       });

       lastEntry.remove();
       updateRemoveButtonVisibility(formType);
     }
   }

   // Function to check if a variable exists in the global scope
   function variableExists(variableName) {
     return typeof window[variableName] !== 'undefined';
   }

   // Safety wrapper for global variables that might not exist
   function safeGetGlobalVariable(variableName, defaultValue = null) {
     return variableExists(variableName) ? window[variableName] : defaultValue;
   }

 </script>


 <script>
     let data_tersangka = <?php echo json_encode($tersangkaData, JSON_PRETTY_PRINT); ?>;
 console.log("Data tersangka dari PHP:", data_tersangka);
 console.log("Jumlah tersangka:", data_tersangka ? data_tersangka.length : 0);


function initializeFormDataTersangka() {
  if (typeof data_tersangka !== "undefined" && data_tersangka && data_tersangka.length > 0) {
    let container = document.getElementById("dynamic-form-tersangka");
    container.innerHTML = ""; // Kosongkan sebelum mengisi ulang

    data_tersangka.forEach((tersangka, index) => {
       console.log("Memproses tersangka:", tersangka);
      let newEntry = generateTersangkaEntryHTML(tersangka, index === 0, index);
      container.appendChild(newEntry);
    });

    updateRemoveButtonVisibility("tersangka");
    initializeSelect2();
    initializeFlatpickrForAll();
  }
}


function generateTersangkaEntryHTML(tersangka = {}, isFirst = false, index = 0) {
  // Buat wrapper div
  let entryDiv = document.createElement('div');
  entryDiv.className = 'entry-tersangka text-black';

  let uniqueeId = "pejabat_tersangka_spm_" + new Date().getTime() + "_" + Math.random().toString(36).substring(2, 8);

  entryDiv.innerHTML = `
    <hr>
    <div class="row mb-3">
      <div class="col-md-12">
        <div class="input-group">
          <span class="input-group-text">NO : SP-</span>
          <input type="text" class="form-control" name="no_sp1_tersangka[]" value="${tersangka.no_sp1 || ''}">
          <span class="input-group-text">/PPNS/</span>
          <input type="date" class="form-control" name="tgl_sp1_tersangka[]" value="${tersangka.tgl_sp1 || ''}">
        </div>
      </div>
    </div>
    <div class="row mb-3">
      <div class="col-md-4 d-flex align-items-center">Nama Lengkap</div>
      <div class="col-md-1 text-center">:</div>
      <div class="col-md-7"><input type="text" class="form-control py-1" name="tersangka_nama[]" value="${tersangka.nama || ''}"></div>
    </div>
    <div class="row mb-3">
      <div class="col-md-4 d-flex align-items-center">Tempat /Tanggal Lahir</div>
      <div class="col-md-1 text-center">:</div>
      <div class="col-md-7"><input type="text" class="form-control py-1" name="tersangka_ttl[]" value="${tersangka.ttl || ''}"></div>
    </div>
    <div class="row mb-3">
      <div class="col-md-4 d-flex align-items-center">Agama</div>
      <div class="col-md-1 text-center">:</div>
      <div class="col-md-7"><input type="text" class="form-control py-1" name="tersangka_agama[]" value="${tersangka.agama || ''}"></div>
    </div>
    <div class="row mb-3">
      <div class="col-md-4 d-flex align-items-center">Jenis Kelamin</div>
      <div class="col-md-1 text-center">:</div>
      <div class="col-md-7">
        <select class="form-select py-1 select2" name="tersangka_kelamin[]">
          <option value="" disabled>Pilih</option>
          <option value="Laki-laki" ${(tersangka.jenis_kelamin === "Laki-laki") ? "selected" : ""}>Laki-laki</option>
          <option value="Perempuan" ${(tersangka.jenis_kelamin === "Perempuan") ? "selected" : ""}>Perempuan</option>
        </select>
      </div>
    </div>
    <div class="row mb-3">
      <div class="col-md-4 d-flex align-items-center">Kewarganegaraan</div>
      <div class="col-md-1 text-center">:</div>
      <div class="col-md-7">
        <select class="form-select form-control py-1 select2" name="tersangka_kewarganegaraan[]" id="tersangka_kewarganegaraan">
          <option value="" disabled>- Pilih Kewarganegaraan -</option>
          @foreach ($nama_negara as $benua => $negara)
            <optgroup label="{{ $benua }}">
            @foreach ($negara as $item)
              <option value="{{ $item->UrEdi }}" ${tersangka.kewarganegaraan === '{{ $item->UrEdi }}' ? 'selected' : ''}>{{ $item->UrEdi }}</option>
            @endforeach
            </optgroup>
          @endforeach
        </select>
      </div>
    </div>
    <div class="row mb-3">
      <div class="col-md-4 d-flex align-items-center">Pekerjaan Saat Ini</div>
      <div class="col-md-1 text-center">:</div>
      <div class="col-md-7"><input type="text" class="form-control py-1" name="tersangka_pekerjaan[]" value="${tersangka.pekerjaan || ''}"></div>
    </div>
    <div class="row mb-3">
      <div class="col-md-4 d-flex align-items-center">Alamat Sesuai Identitas</div>
      <div class="col-md-1 text-center">:</div>
      <div class="col-md-7"><input type="text" class="form-control py-1" name="tersangka_alamat[]" value="${tersangka.alamat || ''}"></div>
    </div>
    <div class="row mb-3">
      <div class="col-md-4 d-flex align-items-center">Jenis/Nomor Identitas</div>
      <div class="col-md-1 text-center">:</div>
      <div class="col-md-7">
        <div class="input-group">
          <input type="text" class="form-control py-1" name="tersangka_jenis_identitas[]" placeholder="Jenis Identitas" value="${tersangka.jenis_identitas || ''}">
          <input type="text" class="form-control py-1" name="tersangka_nomor_identitas[]" placeholder="Nomor Identitas" value="${tersangka.nomor_identitas || ''}">
        </div>
      </div>
    </div>
    <div class="row mb-3">
      <div class="col-md-4 d-flex align-items-center">Pendidikan Terakhir</div>
      <div class="col-md-1 text-center">:</div>
      <div class="col-md-7"><input type="text" class="form-control py-1" name="tersangka_pendidikan[]" value="${tersangka.pendidikan || ''}"></div>
    </div>
    <div class="row mb-3">
      <div class="col-md-12">
        <div class="input-group">
          <span class="input-group-text">NO : SP-</span>
          <input type="text" class="form-control" placeholder="Nomor Surat Panggilan II" name="no_sp2_tersangka[]" value="${tersangka.no_sp2 || ''}">
          <span class="input-group-text">/PPNS/</span>
          <input type="date" class="form-control" placeholder="Tanggal Surat Panggilan II" name="tgl_sp2_tersangka[]" value="${tersangka.tgl_sp2 || ''}">
        </div>
      </div>
    </div>
    <div class="row mb-3">
      <div class="col-md-4 text-black d-flex align-items-center">SP I Menghadap Kepada</div>
      <div class="col-md-1 text-center d-flex align-items-center justify-content-center">:</div>
      <div class="col-md-7">
        <select class="form-select py-1 select2" name="pejabat_tersangka_sp1[]" id="pejabat_tersangka_sp1">
          <option value="" disabled>- Pilih Pejabat -</option>
          @foreach ($users as $user)
            <option value="{{ $user->id_admin }}" ${tersangka.pejabat_sp1 === '{{ $user->id_admin }}' ? 'selected' : ''}>{{ $user->name }} | {{ $user->pangkat }} | {{ $user->jabatan }}</option>
          @endforeach
        </select>
      </div>
    </div>
    <div class="row mb-3">
      <div class="col-md-4 text-black d-flex align-items-center">SP II Menghadap Kepada</div>
      <div class="col-md-1 text-center d-flex align-items-center justify-content-center">:</div>
      <div class="col-md-7">
        <select class="form-select py-1 select2" name="pejabat_tersangka_sp2[]" id="pejabat_tersangka_sp2">
          <option value="" disabled>- Pilih Pejabat -</option>
          @foreach ($users as $user)
            <option value="{{ $user->id_admin }}" ${tersangka.pejabat_sp2 === '{{ $user->id_admin }}' ? 'selected' : ''}>{{ $user->name }} | {{ $user->pangkat }} | {{ $user->jabatan }}</option>
          @endforeach
        </select>
      </div>
    </div>
    <div class="row mb-3">
      <div class="col-md-4 d-flex align-items-center">Status Surat Panggilan I</div>
      <div class="col-md-1 text-center">:</div>
      <div class="col-md-7">
        <select class="form-select py-1 select2" name="status_surat_panggilan_1_tersangka[]">
          <option value="" disabled>Pilih</option>
          <option value="Hadir" ${tersangka.status_surat_panggilan_1 == 'Hadir' ? 'selected' : ''}>Hadir</option>
          <option value="Mangkir" ${tersangka.status_surat_panggilan_1 == 'Mangkir' ? 'selected' : ''}>Mangkir</option>
        </select>
      </div>
    </div>
    <div class="row mb-3">
      <div class="col-md-4 text-black d-flex align-items-center">Waktu Surat Panggilan I</div>
      <div class="col-md-1 text-center d-flex align-items-center justify-content-center">:</div>
      <div class="col-md-7">
        <input type="text" class="form-control" name="tgl_panggilan_1_tersangka[]" id="datetime-datepicker" 
          placeholder="Diisi hari, beserta tanggal Saksi / Tersangka menghadap" value="${tersangka.tgl_panggilan_1 || ''}">
      </div>
    </div>
    <div class="row mb-3">
      <div class="col-md-4 d-flex align-items-center">Status Surat Panggilan II</div>
      <div class="col-md-1 text-center">:</div>
      <div class="col-md-7">
        <select class="form-select py-1 select2" name="status_surat_panggilan_2_tersangka[]">
          <option value="" disabled>Pilih</option>
          <option value="Hadir" ${tersangka.status_surat_panggilan_2 == 'Hadir' ? 'selected' : ''}>Hadir</option>
          <option value="Mangkir" ${tersangka.status_surat_panggilan_2 == 'Mangkir' ? 'selected' : ''}>Mangkir</option>
        </select>
      </div>
    </div>
    <div class="row mb-3">
      <div class="col-md-4 text-black d-flex align-items-center">Waktu Surat Panggilan II</div>
      <div class="col-md-1 text-center d-flex align-items-center justify-content-center">:</div>
      <div class="col-md-7">
        <input type="text" class="form-control" name="tgl_panggilan_2_tersangka[]" id="datetime-datepicker" 
          placeholder="Diisi hari, beserta tanggal Saksi / Tersangka menghadap" value="${tersangka.tgl_panggilan_2 || ''}">
      </div>
    </div>
     <div class="row mb-3">
      <div class="col-md-12">
        <div class="input-group">
          <span class="input-group-text">NO : SPM-</span>
          <input type="text" class="form-control" placeholder="Nomor Surat Perintah Membawa" name="no_spm_tersangka[]" value="${tersangka.no_spm || ''}">
          <span class="input-group-text">/PPNS/</span>
          <input type="date" class="form-control" placeholder="Tanggal Surat Perintah Membawa" name="tgl_spm_tersangka[]" value="${tersangka.tgl_spm || ''}">
        </div>
      </div>
    </div>
    <div class="row mb-3">
    <div class="col-md-12">
    <div class="input-group flex-column">
    <span class="input-group-text text-white bg-primary justify-content-center text-center w-100 rounded">D I P E R I N T A H K A N</span>
    <select class="form-select select2 w-100" id="${uniqueeId}" name="pejabat_tersangka_spm[${index}][]" multiple>
      <option value="" disabled>- Pilih Pejabat -</option>
      @foreach ($users as $user)
        <option value="{{ $user->id_admin }}" ${tersangka.pejabat_spm && tersangka.pejabat_spm.includes('{{ $user->id_admin }}') ? 'selected' : ''}>{{ $user->name }}</option>
      @endforeach
    </select>
    </div>
  </div>
  </div>
    <button type="button" class="btn btn-danger remove-btn my-2" style='display:none;'>
      <i data-feather="trash-2"></i> Hapus
    </button>
    <hr>
  `;

  let removeBtn = entryDiv.querySelector('.remove-btn');
  if (removeBtn) {
    removeBtn.addEventListener('click', function() {
      entryDiv.remove();
      updateRemoveButtonVisibility("tersangka");
    });
  }

  return entryDiv;
}

document.addEventListener("DOMContentLoaded", function() {
  initializeFormDataTersangka();
});

  function salinDataSaksiKeTersangka() {
  // Mengambil data saksi berdasarkan ID input yang spesifik
  const namaSaksi = document.getElementById('nama_tersangka_utama').value;
  const ttlSaksi = document.getElementById('ttl_tersangka_utama').value;
  const agamaSaksi = document.getElementById('agama_tersangka_utama').value;
  
  
  const jkSaksi = document.getElementById('jk_tersangka_utama').value;
  const kewarganegaraanSaksi = document.getElementById('kewarganegaraan_tersangka_utama').value;
  const pekerjaanSaksi = document.getElementById('pekerjaan_tersangka_utama').value;
  const alamatSaksi = document.getElementById('alamat_tersangka_utama').value;
  
  // Ambil jenis dan nomor identitas saksi
  const jenisIdentitas = document.getElementById('jenis_iden_tersangka_utama').value;
  const nomorIdentitas = document.getElementById('no_iden_tersangka_utama').value;
  
  const pendidikanSaksi = document.getElementById('pendidikan_tersangka_utama').value;
  
  // Kembalikan display ke keadaan semula
  //dataLengkap.style.display = displayState;
  
  // Cek apakah form tersangka sudah ada
  let container = document.getElementById("dynamic-form-tersangka");
  // Tambahkan pengecekan apakah container ada
  if (!container) {
    console.log("Container dynamic-form-tersangka tidak ditemukan");
    return;
  }
  
  let entries = container.querySelectorAll('.entry-tersangka');
  
  // Jika belum ada tersangka, tambahkan entri baru
  if (entries.length === 0) {
    // Pastikan fungsi addEntryTersangka tersedia
    if (typeof addEntryTersangka === "function") {
      addEntryTersangka();
      entries = container.querySelectorAll('.entry-tersangka');
    } else {
      console.log("Fungsi addEntryTersangka tidak ditemukan");
      return;
    }
  }
  
  // Cek lagi apakah entries sudah ada
  if (entries.length === 0) {
     console.log("Tidak dapat menambahkan entry tersangka");
    return;
  }
  
  // Ambil entri pertama untuk diisi
  const targetEntry = entries[0];
  
  // Fungsi helper untuk mengisi input dengan pengecekan
  function setInputValue(selector, value) {
    const element = targetEntry.querySelector(selector);
    if (element) {
      element.value = value;
    } else {
        console.log(`Element dengan selector ${selector} tidak ditemukan`);
    }
  }
  
  // Isi form tersangka dengan data saksi
  setInputValue('input[name="tersangka_nama[]"]', namaSaksi);
  setInputValue('input[name="tersangka_ttl[]"]', ttlSaksi);
  setInputValue('input[name="tersangka_agama[]"]', agamaSaksi);
  setInputValue('input[name="tersangka_pekerjaan[]"]', pekerjaanSaksi);
  setInputValue('input[name="tersangka_alamat[]"]', alamatSaksi);
  setInputValue('input[name="tersangka_jenis_identitas[]"]', jenisIdentitas);
  setInputValue('input[name="tersangka_nomor_identitas[]"]', nomorIdentitas);
  setInputValue('input[name="tersangka_pendidikan[]"]', pendidikanSaksi);
  
  // Jenis kelamin (select)
  const selectJK = targetEntry.querySelector('select[name="tersangka_kelamin[]"]');
  if (selectJK) {
    for (let option of selectJK.options) {
      if (option.value === jkSaksi) {
        option.selected = true;
        break;
      }
    }
    
    // Update select2 jika menggunakan select2
    if (window.jQuery && jQuery.fn.select2) {
      jQuery(selectJK).trigger('change');
    }
  } else {
      console.log("Select jenis kelamin tidak ditemukan");
  }
  
  const selectKewarganegaraan = targetEntry.querySelector('select[name="tersangka_kewarganegaraan[]"]');
  if (selectKewarganegaraan) {
    // Cari option yang sesuai dengan nilai
    for (let option of selectKewarganegaraan.options) {
      if (option.value === kewarganegaraanSaksi || option.textContent.includes(kewarganegaraanSaksi)) {
        option.selected = true;
        break;
      }
    }
    
    // Update select2 jika menggunakan select2
    if (window.jQuery && jQuery.fn.select2) {
      jQuery(selectKewarganegaraan).trigger('change');
    }
  } else {
      console.log("Select kewarganegaraan tidak ditemukan");
  }
  
   console.log("Data saksi berhasil disalin ke form tersangka");
}

// Perbarui fungsi addEntryTersangka untuk memperbaiki kesalahan variabel formType
function addEntryTersangka() {
  let formContainer = document.getElementById("dynamic-form-tersangka");
  // Perbaiki bagian ini, hapus variabel formType yang tidak didefinisikan
  let currentEntries = formContainer.querySelectorAll('.entry-tersangka');
  let newIndex = currentEntries.length;
  
  // Simpan referensi semua instance Select2 yang sudah ada beserta nilainya
  let existingSelect2 = [];
  if (window.jQuery) {
    $(formContainer).find('.select2-hidden-accessible').each(function() {
      let element = this;
      let value = $(this).val();
      existingSelect2.push({
        element: element,
        value: value
      });
    });
  }
  
  // Buat entri baru
  let newEntry = generateTersangkaEntryHTML();
  
  // Tambahkan entri baru ke container
  formContainer.appendChild(newEntry);
  
  // Inisialisasi ulang semua Select2 yang sudah ada
  if (window.jQuery) {
    existingSelect2.forEach(item => {
      // Pastikan element masih ada di DOM
      if (document.body.contains(item.element)) {
        // Hancurkan dan buat ulang instance Select2
        $(item.element).select2('destroy').select2();
        // Kembalikan nilainya
        $(item.element).val(item.value).trigger('change');
      }
    });
    
    // Inisialisasi Select2 hanya pada elemen di entri baru
    $(newEntry).find('.select2').each(function() {
      if (!$(this).hasClass('select2-hidden-accessible')) {
        $(this).select2();
      }
    });
  }
  
  // Inisialisasi Flatpickr pada input tanggal baru
  if (window.flatpickr) {
    newEntry.querySelectorAll('input[name^="tgl_panggilan_"]:not(.flatpickr-initialized)').forEach(function(input, index) {
      input.classList.add("flatpickr-initialized");
      
      if (!input.id || input.id === "datetime-datepicker") {
        input.id = "datetime-datepicker-" + new Date().getTime() + "-" + index;
      }
      
      flatpickr("#" + input.id, {
        dateFormat: "Y-m-d H:i",
        enableTime: true,
        time_24hr: true,
        locale: "id"
      });
    });
  }
  
  // Tambahkan event listener untuk tombol hapus
  let removeBtn = newEntry.querySelector('.remove-btn');
  if (removeBtn) {
    removeBtn.addEventListener('click', function() {
      newEntry.remove();
      updateRemoveButtonVisibility("tersangka");
    });
  }
  
  // Perbarui ikon Feather
  if (typeof feather !== 'undefined') {
    feather.replace();
  }
  
  updateRemoveButtonVisibility("tersangka");
}

// Modifikasi fungsi yang sudah ada
document.addEventListener("DOMContentLoaded", function() {
  // Pertama inisialisasi form tersangka
  initializeFormDataTersangka();
  
  // Kemudian coba jalankan penyalinan data
  // Beri waktu sedikit untuk memastikan semua elemen sudah siap
  setTimeout(function() {
    try {
      salinDataSaksiKeTersangka();
    } catch (error) {
        console.log("Gagal menyalin data saksi:", error);
    }
  }, 1000); // Tambah delay untuk memastikan semua elemen sudah dirender
});

 </script>


 
