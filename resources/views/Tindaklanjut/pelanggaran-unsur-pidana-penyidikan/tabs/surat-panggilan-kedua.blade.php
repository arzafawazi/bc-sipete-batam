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
     <div class="input-group flex-wrap">
       <span class="input-group-text">NO : SP- </span>
       <input type="text" class="form-control" name="no_sp2" value="{{ old('no_sp2', isset($unsurpenyidikan) ? $unsurpenyidikan->no_sp2 : $no_ref->no_sp2) }}" readonly>
       <span class="input-group-text">/PPNS/</span>
       <input type="date" class="form-control" name="tgl_sp2" value="{{ old('tgl_sp2', isset($unsurpenyidikan) ? $unsurpenyidikan->tgl_sp2 : '') }}">
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
                 <div class="row mb-3 pt-3">
                   <div class="col-md-4 text-black d-flex align-items-center">Nama</div>
                   <div class="col-md-1 text-center d-flex align-items-center justify-content-center">:</div>
                   <div class="col-md-7">
                     <input type="text" class="form-control py-1 border-0" value="{{ old('nama_saksi', $sbpData->nama_saksi) }}" readonly>
                   </div>
                 </div>


                 <div class="row mb-3">
                   <div class="col-md-4 text-black d-flex align-items-center">Alamat</div>
                   <div class="col-md-1 text-center d-flex align-items-center justify-content-center">:</div>
                   <div class="col-md-7">
                     <input type="text" class="form-control py-1 border-0" value="{{ old('alamat_saksi', $sbpData->alamat_saksi) }}" readonly>
                   </div>
                 </div>

                 <div class="row mb-3">
                   <div class="col-md-4 text-black d-flex align-items-center">Pekerjaan</div>
                   <div class="col-md-1 text-center d-flex align-items-center justify-content-center">:</div>
                   <div class="col-md-7">
                     <input type="text" class="form-control py-1 border-0" value="{{ old('pekerjaan_saksi', $sbpData->pekerjaan_saksi) }}" readonly>
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


               </div>
             </div>
           </div>
         </div>
       </div>
     </div>
   </div>
 </div>
