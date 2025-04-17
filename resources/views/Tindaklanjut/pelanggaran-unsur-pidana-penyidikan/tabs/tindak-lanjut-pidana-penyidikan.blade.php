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

     <!-- Main Form -->
     <div class="card p-1">
         <div class="card-body">
             <div class="row">
                 <div class="col-lg-12">
                     <div class="container-fluid px-0 px-sm-3">

                         @foreach ($tersangkaData as $index => $tersangka)
                             @php
                                 $tindakTersangka = $tindakLanjutTersangka[$index] ?? null;
                             @endphp

                             <p class="text-black"><b>Data Tersangka {{ $index + 1 }}</b></p>
                             <hr>
                             <div class="mb-3 row">
                                 <label class="col-md-3 col-sm-12 col-form-label">Nama</label>
                                 <div class="col-md-1 text-center mt-1 d-none d-sm-block">:</div>
                                 <div class="col-md-8 col-sm-11">
                                     <input type="text" name="ba_tindak_nama_tersangka[]"
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

                             <div class="row mb-3">
                                 <div class="col-md-4 text-black d-flex align-items-center">
                                     Memenuhi Unsur Pidana dan Cukup Bukti
                                 </div>
                                 <div class="col-md-1 text-center d-flex align-items-center justify-content-center">
                                     :
                                 </div>
                                 <div class="col-md-7">
                                     <select class="form-control py-1 form-select select2"
                                         name="memenuhi_unsur_pidana_lanjut[]">
                                         <option value="" disabled
                                             {{ old('memenuhi_unsur_pidana_lanjut.' . $index, $tindakTersangka['memenuhi_unsur_pidana_lanjut'] ?? '') == '' ? 'selected' : '' }}>
                                             - Pilih -
                                         </option>
                                         <option value="Ya"
                                             {{ old('memenuhi_unsur_pidana_lanjut.' . $index, $tindakTersangka['memenuhi_unsur_pidana_lanjut'] ?? '') == 'Ya' ? 'selected' : '' }}>
                                             Ya
                                         </option>
                                         <option value="Tidak"
                                             {{ old('memenuhi_unsur_pidana_lanjut.' . $index, $tindakTersangka['memenuhi_unsur_pidana_lanjut'] ?? '') == 'Tidak' ? 'selected' : '' }}>
                                             Tidak
                                         </option>
                                     </select>
                                 </div>
                             </div>

                             <div class="row mb-3">
                                 <div class="col-md-4 text-black d-flex align-items-center">
                                     Pengembalian Berkas Perkara untuk Dilengkapi (P-19)
                                 </div>
                                 <div class="col-md-1 text-center d-flex align-items-center justify-content-center">
                                     :
                                 </div>
                                 <div class="col-md-7">
                                     <select class="form-control py-1 form-select select2"
                                         name="pengembalian_berkas_p19[]">
                                         <option value="" disabled
                                             {{ old('pengembalian_berkas_p19.' . $index, $tindakTersangka['pengembalian_berkas_p19'] ?? '') == '' ? 'selected' : '' }}>
                                             - Pilih -
                                         </option>
                                         <option value="Ya"
                                             {{ old('pengembalian_berkas_p19.' . $index, $tindakTersangka['pengembalian_berkas_p19'] ?? '') == 'Ya' ? 'selected' : '' }}>
                                             Ya
                                         </option>
                                         <option value="Tidak"
                                             {{ old('pengembalian_berkas_p19.' . $index, $tindakTersangka['pengembalian_berkas_p19'] ?? '') == 'Tidak' ? 'selected' : '' }}>
                                             Tidak
                                         </option>
                                     </select>
                                 </div>
                             </div>

                             <div class="row mb-3">
                                 <div class="col-md-4 text-black d-flex align-items-center">
                                     Penyerahan Berkas Perkara (Tahap 1)
                                 </div>
                                 <div class="col-md-1 text-center d-flex align-items-center justify-content-center">
                                     :
                                 </div>
                                 <div class="col-md-7">
                                     <select class="form-control py-1 form-select select2" name="berkas_tahap_1[]">
                                         <option value="" disabled
                                             {{ old('berkas_tahap_1.' . $index, $tindakTersangka['berkas_tahap_1'] ?? '') == '' ? 'selected' : '' }}>
                                             - Pilih -
                                         </option>
                                         <option value="Ya"
                                             {{ old('berkas_tahap_1.' . $index, $tindakTersangka['berkas_tahap_1'] ?? '') == 'Ya' ? 'selected' : '' }}>
                                             Ya
                                         </option>
                                         <option value="Tidak"
                                             {{ old('berkas_tahap_1.' . $index, $tindakTersangka['berkas_tahap_1'] ?? '') == 'Tidak' ? 'selected' : '' }}>
                                             Tidak
                                         </option>
                                     </select>
                                 </div>
                             </div>

                             <div class="row mb-3">
                                 <div class="col-md-4 text-black d-flex align-items-center">
                                     Penyerahan Berkas Perkara (Tahap 2)
                                 </div>
                                 <div class="col-md-1 text-center d-flex align-items-center justify-content-center">
                                     :
                                 </div>
                                 <div class="col-md-7">
                                     <select class="form-control py-1 form-select select2" name="berkas_tahap_2[]">
                                         <option value="" disabled
                                             {{ old('berkas_tahap_2.' . $index, $tindakTersangka['berkas_tahap_2'] ?? '') == '' ? 'selected' : '' }}>
                                             - Pilih -
                                         </option>
                                         <option value="Ya"
                                             {{ old('berkas_tahap_2.' . $index, $tindakTersangka['berkas_tahap_2'] ?? '') == 'Ya' ? 'selected' : '' }}>
                                             Ya
                                         </option>
                                         <option value="Tidak"
                                             {{ old('berkas_tahap_2.' . $index, $tindakTersangka['berkas_tahap_2'] ?? '') == 'Tidak' ? 'selected' : '' }}>
                                             Tidak
                                         </option>
                                     </select>
                                 </div>
                             </div>


                             <div class="row mb-3">
                                 <div class="col-md-4 text-black d-flex align-items-center">
                                     JPU (Asli)
                                 </div>
                                 <div class="col-md-1 text-center d-flex align-items-center justify-content-center">
                                     :
                                 </div>
                                 <div class="col-md-7">
                                     <select class="form-control py-1 form-select select2" name="jpu_asli[]">
                                         <option value="" disabled
                                             {{ old('jpu_asli.' . $index, $tindakTersangka['jpu_asli'] ?? '') == '' ? 'selected' : '' }}>
                                             - Pilih -
                                         </option>
                                         <option value="Ya"
                                             {{ old('jpu_asli.' . $index, $tindakTersangka['jpu_asli'] ?? '') == 'Ya' ? 'selected' : '' }}>
                                             Ya
                                         </option>
                                         <option value="Tidak"
                                             {{ old('jpu_asli.' . $index, $tindakTersangka['jpu_asli'] ?? '') == 'Tidak' ? 'selected' : '' }}>
                                             Tidak
                                         </option>
                                     </select>
                                 </div>
                             </div>

                             <div class="row mb-3">
                                 <div class="col-md-4 text-black d-flex align-items-center">
                                     Polisi (Tembusan)
                                 </div>
                                 <div class="col-md-1 text-center d-flex align-items-center justify-content-center">
                                     :
                                 </div>
                                 <div class="col-md-7">
                                     <select class="form-control py-1 form-select select2" name="polisi_tembusan[]">
                                         <option value="" disabled
                                             {{ old('polisi_tembusan.' . $index, $tindakTersangka['polisi_tembusan'] ?? '') == '' ? 'selected' : '' }}>
                                             - Pilih -
                                         </option>
                                         <option value="Ya"
                                             {{ old('polisi_tembusan.' . $index, $tindakTersangka['polisi_tembusan'] ?? '') == 'Ya' ? 'selected' : '' }}>
                                             Ya
                                         </option>
                                         <option value="Tidak"
                                             {{ old('polisi_tembusan.' . $index, $tindakTersangka['polisi_tembusan'] ?? '') == 'Tidak' ? 'selected' : '' }}>
                                             Tidak
                                         </option>
                                     </select>
                                 </div>
                             </div>

                             <div class="row mb-3">
                                 <div class="col-md-4 text-black d-flex align-items-center">
                                     Sidang Peradilan
                                 </div>
                                 <div class="col-md-1 text-center d-flex align-items-center justify-content-center">
                                     :
                                 </div>
                                 <div class="col-md-7">
                                     <select class="form-control py-1 form-select select2" name="sidang_peradilan[]">
                                         <option value="" disabled
                                             {{ old('sidang_peradilan.' . $index, $tindakTersangka['sidang_peradilan'] ?? '') == '' ? 'selected' : '' }}>
                                             - Pilih -
                                         </option>
                                         <option value="Ya"
                                             {{ old('sidang_peradilan.' . $index, $tindakTersangka['sidang_peradilan'] ?? '') == 'Ya' ? 'selected' : '' }}>
                                             Ya
                                         </option>
                                         <option value="Tidak"
                                             {{ old('sidang_peradilan.' . $index, $tindakTersangka['sidang_peradilan'] ?? '') == 'Tidak' ? 'selected' : '' }}>
                                             Tidak
                                         </option>
                                     </select>
                                 </div>
                             </div>


                             <div class="row mb-3">
                                 <div class="col-md-4 text-black d-flex align-items-center">
                                     Vonis
                                 </div>
                                 <div class="col-md-1 text-center d-flex align-items-center justify-content-center">
                                     :
                                 </div>
                                 <div class="col-md-7">
                                     <select class="form-control py-1 form-select select2" name="vonis[]">
                                         <option value="" disabled
                                             {{ old('vonis.' . $index, $tindakTersangka['vonis'] ?? '') == '' ? 'selected' : '' }}>
                                             - Pilih -
                                         </option>
                                         <option value="Ya"
                                             {{ old('vonis.' . $index, $tindakTersangka['vonis'] ?? '') == 'Ya' ? 'selected' : '' }}>
                                             Ya
                                         </option>
                                         <option value="Tidak"
                                             {{ old('vonis.' . $index, $tindakTersangka['vonis'] ?? '') == 'Tidak' ? 'selected' : '' }}>
                                             Tidak
                                         </option>
                                     </select>
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
