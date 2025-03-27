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

   <h5 class="fw-bold text-center text-black">BERITA ACARA PEMOTRETAN DAN/ATAU PEREKAMAN <br>MELALUI MEDIA AUDIOVISUAL</h5>


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
               --- Pada hari ini ….....(3)…….. tanggal ………(4)…........ bulan ……....(5)…........ tahun
                …….......(6)…........... bertempat di ............(7).........., saya : ------------------------------------------------
                ---------------------------------------- ………………(8)…………….. ----------------------------------------
                Pangkat : ………(9)…………, Jabatan : Penyidik pada …….......……(10)…………… bersamasama dengan : ----------------------------------------------------------------------------------------------------------
                ---------------------------------------- ………………(11)…………….. ----------------------------------------
                Pangkat : ………(12)…………, Jabatan : Penyidik pada …….......……(13)……………. ------------<br>
                Berdasarkan :
                    <ol class="ps-3 text-black" start="1" style="line-height: 1.5;">
                        <li class="mb-1 ps-1">Laporan Kejadian Tindak Pidana Nomor : LK- ................(14)................. tanggal ...........(15)............</li>
                        <li class="mb-1 ps-1">Surat Perintah Tugas Penyidikan Nomor : SPTP- ................(16)................. tanggal ...........(17).............</li>
                        <li class="mb-1 ps-1">Surat Perintah Pemotretan dan/atau Perekaman melalui Media Audiovisual : SPPP- ...........(18).................. tanggal ………(19)…..…….</li>
                    </ol>
             </p>


             <p class="text-black">
               Telah melakukan penggeledahan terhadap sebuah rumah tinggal / tempat tertutup lainnya /
                sarana pengangkut berupa / badan di ….............................(18)..................................................
                (Jl. No. RT, Kelurahan) / (Nama Sarana Pengangkut, Nomor Polisi/Register) / (Lokasi), ---------
                dengan / tanpa izin tersangka / penghuni rumah / pemilik sarana pengangkut / pengemudi /
                nahkoda / pilot ---------------------------------------------------------------------------------------------------------
             </p>

             <p class="text-black">
             Telah memotret dan/atau merekam melalui media audiovisual terhadap orang/barang/sarana
            pengangkut* sebagai berikut :
             </p>

             <p class="text-black">
             Dengan disaksikan oleh : 
             </p>


              <div class="mb-3 row">
               <label class="col-md-3 col-sm-12 col-form-label">Nama</label>
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
               Dengan cara sebagai berikut:
             </p>

             <p class="text-black">
             ---- Demikian Berita Acara Pemotretan dan/atau Perekaman ini dibuat dengan sebenarnya atas
                kekuatan sumpah jabatan, kemudian ditutup dan ditandatangani di ...................(28).................
                pada hari dan tanggal tersebut di atas.---------------------------------------------------------------------------
             </p>

             <div class="mb-3 row">
              <label class="col-md-3 col-sm-12 col-form-label fw-bold text-md-start">Penyidik Yang Melakukan Pemotretan</label>
              <div class="col-md-1 col-sm-1 text-center mt-1 d-none d-sm-block">:</div>
              <div class="col-md-8 col-sm-11">
                <select class="form-control form-select select2" name="pejabat_potret">
                  <option value="" selected disabled>- Pilih -</option>
                  @foreach ($users as $user)
                    <option value="{{ $user->id_admin }}" {{ old('pejabat_potret', isset($unsurpenyidikan) ? $unsurpenyidikan->pejabat_potret : '') == $user->id_admin ? 'selected' : '' }}>
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
