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
               &nbsp;&nbsp;&nbsp; Pada hari ........ tanggal ........ bulan ........ tahun ........, Saya :
             </p>

             <div class="fw-bold text-center">
               <select class="form-control form-select select2" name="pejabat_penggeledahan">
                 <option value="" selected disabled>- Pilih -</option>
                 @foreach ($users as $user)
                   <option value="{{ $user->id_admin }}" {{ old('pejabat_penggeledahan', isset($unsurpenyidikan) ? $unsurpenyidikan->pejabat_penggeledahan : '') == $user->id_admin ? 'selected' : '' }}>
                     {{ $user->name }} | {{ $user->pangkat }} | {{ $user->jabatan }}
                   </option>
                 @endforeach
               </select>
             </div>

             <br>

             <p class="text-black">
               Pangkat .………(9)…………. Jabatan Penyidik pada ..……..(10)….………. , sesuai dengan :
                    <ol class="ps-3 text-black" start="1" style="line-height: 1.5;">
                    <li class="mb-1 ps-1">Surat Perintah Penggeledahan No...............(11).........tanggal................(12).........................</li>
                    <li class="mb-1 ps-1">Laporan Kejadian No. ..................................(13)................. tanggal ......(14).........................</li>
                    <li class="mb-1 ps-1">Izin Penggeledahan Pengadilan Negeri No........(15)........ tanggal .........(16).........................</li>
                    <li class="mb-1 ps-1">....................................................................(17).....................................................................</li>
                </ol>
             </p>


             <p class="text-black">
               Telah melakukan penggeledahan terhadap sebuah rumah tinggal / tempat tertutup lainnya /
                sarana pengangkut berupa / badan di ….............................(18)..................................................
                (Jl. No. RT, Kelurahan) / (Nama Sarana Pengangkut, Nomor Polisi/Register) / (Lokasi), ---------
                dengan / tanpa izin tersangka / penghuni rumah / pemilik sarana pengangkut / pengemudi /
                nahkoda / pilot ---------------------------------------------------------------------------------------------------------
             </p>


              <div class="mb-3 row">
               <label class="col-md-3 col-sm-12 col-form-label">Nama</label>
               <div class="col-md-1 col-sm-1 text-center mt-1 d-none d-sm-block">:</div>
               <div class="col-md-8 col-sm-11">
                 <input type="text" class="form-control">
               </div>
             </div>

             <div class="mb-3 row">
               <label class="col-md-3 col-sm-12 col-form-label">Tempat/Tanggal Lahir </label>
               <div class="col-md-1 col-sm-1 text-center mt-1 d-none d-sm-block">:</div>
               <div class="col-md-8 col-sm-11">
                 <input type="text" class="form-control">
               </div>
             </div>

              <div class="mb-3 row">
               <label class="col-md-3 col-sm-12 col-form-label">Tempat/Tanggal Lahir </label>
               <div class="col-md-1 col-sm-1 text-center mt-1 d-none d-sm-block">:</div>
               <div class="col-md-8 col-sm-11">
                 <input type="text" class="form-control">
               </div>
             </div>

             <p class="text-black">
               Uraian singkat jalannya penggeledahan dan hasilnya : ----------------------------------------------------
                ....................................................................(32)...........................................................................
                ---------------------------- Demikian Berita Acara Penggeledahan ini dibuat dengan sebenarnya
                atas kekuatan sumpah jabatan, kemudian ditutup dan ditandatangani di...............(33)...............
                pada tanggal tersebut di atas. -------------------------------------------------------------------------------------
             </p>

           </div>
         </div>
       </div>
     </div>
   </div>
 </div>
