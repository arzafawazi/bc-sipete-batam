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
               &nbsp;&nbsp;&nbsp; Pada hari ini Rabu tanggal Satu bulan Januari tahun Dua Ribu Dua Puluh Lima.
             </p>

              <p class="text-black">
               Berdasarkan :-----------------------------------------------------------------------------------------------------------
               <ol class="ps-3 text-black" start="1" style="line-height: 1.5;">
                <li class="mb-1 ps-1">Laporan Kejadian nomor LK-001/KPU.2064/PPNS/2025 tanggal 01 Januari 2025;</li>
                <li class="mb-1 ps-1">Surat Perintah Tugas Penyidikan nomor SPTP-001/KPU.206/PPNS/2025 tanggal 01 Januari 2025.</li>
            </ol>
             </p>

            <div class="ps-3 text-black" style="line-height: 1.5;">
                <p>Hasil gelar perkara berisi:</p>
                <ol class="ps-3">
                    <li class="mb-1 ps-1">Pemenuhan unsur pasal yang disangkakan, yaitu Pasal 54 dan/atau Pasal 56 Undang-Undang Nomor 39 Tahun 2007 tentang Perubahan Atas Undang-Undang Nomor 11 Tahun 1995 tentang Cukai telah terpenuhi.</li>
                    <li class="mb-1 ps-1">Menetapkan 1 (satu) orang laki-laki sebagai tersangka dengan data sebagai berikut:</li>
                </ol>
                <div class="ps-3">
                    <p><strong>Nama Lengkap:</strong> Asemi Syah Putra bin Izul</p>
                    <p><strong>Tempat / Tanggal Lahir:</strong> Pulau Sarang / 20 Maret 2000</p>
                    <p><strong>Agama:</strong> Islam</p>
                    <p><strong>Jenis Kelamin:</strong> Laki-laki</p>
                    <p><strong>Kewarganegaraan:</strong> Indonesia</p>
                    <p><strong>Pekerjaan sesuai Identitas:</strong> Belum/Tidak Bekerja</p>
                    <p><strong>Alamat sesuai Identitas:</strong> Pulau Sarang RT/RW 002/006, Kelurahan Sekanak Raya, Kecamatan Belakang Padang, Kota Batam, Provinsi Kepulauan Riau</p>
                    <p><strong>Jenis/ Nomor Identitas:</strong> KTP / 2171012003009003</p>
                    <p><strong>Pendidikan Terakhir:</strong> Sekolah Dasar (Tidak Tamat)</p>
                </div>
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
             Kesimpulan : -----------------------------------------------------------------------------------------------------------
                Telah diperoleh bukti yang cukup Sdr. ASEMI SYAH PUTRA bin IZUL ditetapkan sebagai Tersangka. --------------------------------------------------------------------------------------------------------------
                Rencana kegiatan penyidikan : ------------------------------------------------------------------------------------
                Menerbitkan Surat Penetapan Tersangka. ---------------------------------------------------------------------
            </p>

            <p class="text-black">
            Demikian Berita Acara Gelar Perkara ini dibuat dengan sebenarnya atas kekuatan sumpah jabatan, kemudian ditutup dan ditandatangani di Batam pada hari dan tanggal tersebut di atas.
            </p>

             <div class="mb-3 row">
              <label class="col-md-3 col-sm-12 col-form-label fw-bold text-md-start">Penyidik Yang Meminta Bantuan Uji Forensik Digital</label>
              <div class="col-md-1 col-sm-1 text-center mt-1 d-none d-sm-block">:</div>
              <div class="col-md-8 col-sm-11">
                <select class="form-control form-select select2" name="pejabat_gelar_perkara">
                  <option value="" selected disabled>- Pilih -</option>
                  @foreach ($users as $user)
                    <option value="{{ $user->id_admin }}" {{ old('pejabat_gelar_perkara', isset($unsurpenyidikan) ? $unsurpenyidikan->pejabat_gelar_perkara : '') == $user->id_admin ? 'selected' : '' }}>
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
