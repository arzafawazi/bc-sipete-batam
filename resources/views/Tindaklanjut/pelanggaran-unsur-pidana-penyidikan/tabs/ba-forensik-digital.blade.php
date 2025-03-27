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

   <h5 class="fw-bold text-center text-black">BERITA ACARA PEROLEHAN DATA ELEKTRONIK</h5>


   <!-- Main Form -->
   <div class="card p-1">
     <div class="card-body">
       <div class="row">
         <div class="col-lg-12">
           <div class="container-fluid px-0 px-sm-3">

           <div class="mb-3 row align-items-center">
                <div class="input-group flex-wrap">
                <span class="input-group-text">BA.PEROLEHAN -</span>
                <input type="text" class="form-control" value="{{ old('no_ba_perolehan', isset($unsurpenyidikan) ? $unsurpenyidikan->no_ba_perolehan : $no_ref) }}" name="no_ba_perolehan" readonly>
                <span class="input-group-text">/PPNS/</span>
                <input type="date" class="form-control" name="no_ba_perolehan" value="{{ old('no_ba_perolehan', isset($unsurpenyidikan) ? $unsurpenyidikan->no_ba_perolehan : '') }}">
                </div>
            </div>

             <p class="text-black">
               &nbsp;&nbsp;&nbsp; Pada hari ini ……(6)……. tanggal ……..(7)…….. bulan ………(8)……… tahun
                …….(9)…….., kami selaku Ahli Forensik Digital yang ditugaskan berdasarkan Surat Perintah
                Forensik Digital nomor SPFD- ………(10)……….. tanggal ………..(11)………. yang diminta
                oleh Penyidik ……….(12)……… melalui Surat/Nota Dinas* nomor ………..(13)………. tanggal
                ………(14)……….. hal …………………………….(15)………………………….. dalam rangka
                penyidikan tindak pidana di bidang ……….(16)……… yang dilakukan oleh :
             </p>


              <div class="mb-3 row">
               <label class="col-md-3 col-sm-12 col-form-label">Nama</label>
               <div class="col-md-1 col-sm-1 text-center mt-1 d-none d-sm-block">:</div>
               <div class="col-md-8 col-sm-11">
                 <input type="text" class="form-control">
               </div>
             </div>

             <div class="mb-3 row">
               <label class="col-md-3 col-sm-12 col-form-label">Jenis Kelamin</label>
               <div class="col-md-1 col-sm-1 text-center mt-1 d-none d-sm-block">:</div>
               <div class="col-md-8 col-sm-11">
                 <input type="text" class="form-control">
               </div>
             </div>

              <div class="mb-3 row">
               <label class="col-md-3 col-sm-12 col-form-label">Tempat / Tanggal Lahir</label>
               <div class="col-md-1 col-sm-1 text-center mt-1 d-none d-sm-block">:</div>
               <div class="col-md-8 col-sm-11">
                 <input type="text" class="form-control">
               </div>
             </div>

             <div class="mb-3 row">
               <label class="col-md-3 col-sm-12 col-form-label">NIK</label>
               <div class="col-md-1 col-sm-1 text-center mt-1 d-none d-sm-block">:</div>
               <div class="col-md-8 col-sm-11">
                 <input type="text" class="form-control">
               </div>
             </div>

             <div class="mb-3 row">
               <label class="col-md-3 col-sm-12 col-form-label">Pekerjaan</label>
               <div class="col-md-1 col-sm-1 text-center mt-1 d-none d-sm-block">:</div>
               <div class="col-md-8 col-sm-11">
                 <input type="text" class="form-control">
               </div>
             </div>

             <div class="mb-3 row">
               <label class="col-md-3 col-sm-12 col-form-label">Alamat</label>
               <div class="col-md-1 col-sm-1 text-center mt-1 d-none d-sm-block">:</div>
               <div class="col-md-8 col-sm-11">
                 <input type="text" class="form-control">
               </div>
             </div>

             <p class="text-black">
               telah melakukan perolehan Data Elektronik dengan rincian sebagaimana terlampir yang diduga
                data atau informasi tersebut berhubungan dengan kegiatan Penyidikan yang sedang dilakukan.
             </p>

            <br><br>
             <p class="text-black">
             --------Sehubungan dengan terjadinya tindak pidana di bidang …….(34)……. yaitu
                ..(36)………, diduga melanggar …………....……..……(35)…………………..………………
             </p>

             <p class="text-black">
             Demikian Berita Acara Perolehan Data Elektronik ini dibuat dengan sebenar-benarnya.
            </p>

             <div class="mb-3 row">
              <label class="col-md-3 col-sm-12 col-form-label fw-bold text-md-start">Penyidik Yang Meminta Bantuan Uji Forensik Digital</label>
              <div class="col-md-1 col-sm-1 text-center mt-1 d-none d-sm-block">:</div>
              <div class="col-md-8 col-sm-11">
                <select class="form-control form-select select2" name="penyidik_uji_forensik">
                  <option value="" selected disabled>- Pilih -</option>
                  @foreach ($users as $user)
                    <option value="{{ $user->id_admin }}" {{ old('penyidik_uji_forensik', isset($unsurpenyidikan) ? $unsurpenyidikan->penyidik_uji_forensik : '') == $user->id_admin ? 'selected' : '' }}>
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
