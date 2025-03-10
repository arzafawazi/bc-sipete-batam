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

   <h5 class="fw-bold text-center text-black"><u>LAPORAN KEJADIAN TINDAK PIDANA</u></h5>

   <div class="mb-3 row align-items-center">
     <div class="input-group flex-wrap">
       <span class="input-group-text">NO : LK-</span>
       <input type="text" class="form-control" value="{{ old('no_lk', isset($unsurpenyidikan) ? $unsurpenyidikan->no_lk : $no_ref) }}" name="no_lk" readonly>
       <span class="input-group-text">/PPNS/</span>
       <input type="date" class="form-control" name="tgl_lk" value="{{ old('tgl_lk', isset($unsurpenyidikan) ? $unsurpenyidikan->tgl_lk : '') }}">
     </div>
   </div>

   <!-- Main Form -->
   <div class="card p-1">
     <div class="card-body">
       <div class="row">
         <div class="col-lg-12">
           <div class="container-fluid px-0 px-sm-3">

             <p class="fw-bold">
               &nbsp;&nbsp;&nbsp; Pada hari ........ tanggal ........ bulan ........ tahun ........, Saya :
             </p>

             <div class="fw-bold text-center">
               <select class="form-control form-select select2" name="pejabat_lk">
                 <option value="" selected disabled>- Pilih -</option>
                 @foreach ($users as $user)
                   <option value="{{ $user->id_admin }}" {{ old('pejabat_lk', isset($unsurpenyidikan) ? $unsurpenyidikan->pejabat_lk : '') == $user->id_admin ? 'selected' : '' }}>
                     {{ $user->name }} | {{ $user->pangkat }} | {{ $user->jabatan }}
                   </option>
                 @endforeach
               </select>
             </div>

             <br>

             <p class="fw-bold">
               &nbsp;&nbsp;&nbsp; Berdasarkan ........ melaporkan terdapat bukti permulaan yang cukup adanya
               dugaan tindak pidana ........ (kepabeanan, cukai, dan/atau Tindak Pidana
               Pencucian Uang)
             </p>

             <div class="fw-bold text-center mt-3 mb-3">
               <select name="berdasarkan_lk" class="form-control form-select select2">
                 <option value="" selected disabled>- Pilih -</option>
                 <option value="hasil Penelitian Pendahuluan" {{ old('berdasarkan_lk', isset($unsurpenyidikan) ? $unsurpenyidikan->berdasarkan_lk : '') == 'hasil Penelitian Pendahuluan' ? 'selected' : '' }}>
                   Hasil Penelitian Pendahuluan
                 </option>
                 <option value="Laporan Hasil Penelitian" {{ old('berdasarkan_lk', isset($unsurpenyidikan) ? $unsurpenyidikan->berdasarkan_lk : '') == 'Laporan Hasil Penelitian' ? 'selected' : '' }}>
                   Laporan Hasil Penelitian
                 </option>
               </select>
             </div>

             <div class="fw-bold text-center">
               <textarea class="form-control" name="uraian_laporan_lk" rows="3" placeholder="melaporkan terdapat bukti permulaan yang cukup adanya dugaan tindak pidana ........">{{ old('uraian_laporan_lk', isset($unsurpenyidikan) ? $unsurpenyidikan->uraian_laporan_lk : '') }}</textarea>
             </div>

             <div class="fw-bold text-center mt-3 mb-3">
               <textarea class="form-control" name="dugaan_tindak_pidana_lk" rows="3" placeholder="Pilih Satu jenis Tindak Pidana (Kepabeanan/Cukai/Tindak Pidana lain yang menurut Undang-Undang menjadi kewenangan Penyidik Direktorat Jenderal Bea dan Cukai)">{{ old('dugaan_tindak_pidana_lk', isset($unsurpenyidikan) ? $unsurpenyidikan->dugaan_tindak_pidana_lk : '') }}</textarea>
             </div>

             <div class="mb-3 row">
               <label class="col-md-3 col-sm-12 col-form-label">Tempat Kejadian</label>
               <div class="col-md-1 col-sm-1 text-center mt-1 d-none d-sm-block">:</div>
               <div class="col-md-8 col-sm-11">
                 <textarea class="form-control" placeholder="Diisi tempat terjadinya dugaan Tindak Pidana (Diisi lengkap dan detail)" rows="3" name="tempat_kejadian_lk">{{ old('tempat_kejadian_lk', isset($unsurpenyidikan) ? $unsurpenyidikan->tempat_kejadian_lk : '') }}</textarea>
               </div>
             </div>

             <div class="mb-3 row">
               <label class="col-md-3 col-sm-12 col-form-label">Waktu Kejadian</label>
               <div class="col-md-1 col-sm-1 text-center mt-1 d-none d-sm-block">:</div>
               <div class="col-md-8 col-sm-11">
                 <textarea class="form-control" placeholder="Diisi waktu terjadinya dugaan Tindak Pidana (Diisi lengkap dan detail)" rows="3" name="waktu_kejadian_lk">{{ old('waktu_kejadian_lk', isset($unsurpenyidikan) ? $unsurpenyidikan->waktu_kejadian_lk : '') }}</textarea>
               </div>
             </div>

             <div class="mb-3 row">
               <label class="col-md-3 col-sm-12 col-form-label">Uraian Kejadian</label>
               <div class="col-md-1 col-sm-1 text-center mt-1 d-none d-sm-block">:</div>
               <div class="col-md-8 col-sm-11">
                 <textarea class="form-control" name="uraian_kejadian_lk" placeholder="Diisi uraian kejadian dugaan Tindak Pidana" rows="5">{{ old('uraian_kejadian_lk', isset($unsurpenyidikan) ? $unsurpenyidikan->uraian_kejadian_lk : '') }}</textarea>
               </div>
             </div>


             <div class="mb-3 row">
               <label class="col-md-3 col-sm-12 col-form-label">Pasal yang dilanggar</label>
               <div class="col-md-1 col-sm-1 text-center mt-1 d-none d-sm-block">:</div>
               <div class="col-md-8 col-sm-11">
                 <textarea class="form-control border-0 text-black" rows="3" readonly>{{ old('dugaan_pelanggaran_lpp', $penyidikan->dugaan_pelanggaran_lpp) }}</textarea>
               </div>
             </div>

             <p class="fw-bold">
               Kejadian tersebut saya laporkan kepada Kepala Bidang Penindakan dan Penyidikan
               KPU Bea dan Cukai Tipe B Batam untuk penanganan lebih lanjut.
             </p>

             <p class="fw-bold">
               Demikian laporan terjadinya tindak pidana ini saya buat dengan sebenarnya
               dengan mengingat sumpah jabatan.
             </p>

           </div>
         </div>
       </div>
     </div>
   </div>
 </div>
