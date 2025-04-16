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
    <div class="card p-3">
        <div class="card-body">

            <hr class="border border-dark border-2 bg-dark">

            <!-- Rujukan -->
            <h6 class="text-black">1. RUJUKAN:</h6>
            <ol class="ps-3 text-black" type="a" style="line-height: 1.5;">
                <li class="mb-1 ps-1">Pasal 109 Undang-Undang Nomor 8 Tahun 1981 tentang Hukum Acara Pidana;</li>
                <li class="mb-1 ps-1">Pasal 112 Undang-Undang Nomor 10 Tahun 1995 tentang Kepabeanan sebagaimana telah
                    diubah dengan Undang-Undang Nomor 17 Tahun 2006;</li>
                <li class="mb-1 ps-1">Pasal 63 Undang-Undang Nomor 11 Tahun 1995 tentang Cukai sebagaimana telah diubah
                    dengan Undang-Undang Nomor 39 Tahun 2007;</li>
                <li class="mb-1 ps-1">Pasal 5 Peraturan Pemerintah Nomor 55 Tahun 1996 tentang Penyidikan Tindak Pidana
                    Kepabeanan dan Cukai;</li>
                <li class="mb-1 ps-1">Laporan Kejadian Tindak Pidana Nomor …(11)…;</li>
                <li class="mb-1 ps-1">Surat Perintah Tugas Penyidikan Nomor …(12)…;</li>
                <li class="mb-1 ps-1">Surat Pemberitahuan Dimulainya Penyidikan nomor …(13)…;*)</li>
            </ol>


            <hr class="border border-dark border-2 bg-dark">

            <h6 class="text-black" style="line-height: 1.5;">2. Dengan ini Kami memberitahukan bahwa pada
                hari……...(15)….…., tanggal
                ………..(16)………, bulan ………(17)……….., tahun ………….(18)…......., telah dimulai
                Penyidikan Tindak Pidana …………………..……..(19)…………..…………….,
                yaitu…………………………....……(20)………………………………………………………………
                …………………………………………………………………………………… Sebagaimana
                dimaksud dalam Pasal ......…(21)……, Undang-Undang
                ……………..……(22)………………………., yang diduga dilakukan oleh:
            </h6>

            <div class="mb-3 row">
                <label class="col-md-3 col-sm-12 col-form-label fw-bold text-md-start">Data
                    Tersangka</label>
                <div class="col-md-1 col-sm-1 text-center mt-1 d-none d-sm-block">:</div>
                <div class="col-md-8 col-sm-11">
                    <div id="form-tersangka-penangkapan-pemberitahuan">
                        <div id="dynamic-form-tersangka-penangkapan-pemberitahuan">
                            @foreach ($tersangkaData as $index => $tersangka)
                                @php
                                    $suratPenangkapanPemberitahuanTersangka =
                                        $penangkapanPemberitahuanTersangka[$index] ?? null;
                                @endphp
                                <div class="entry-tersangka text-black">
                                    <hr>
                                    <div class="row mb-3">
                                        <div class="col-md-12">
                                            <div class="input-group">
                                                <span class="input-group-text">NO : S-</span>
                                                <input type="text" class="form-control"
                                                    name="no_spp_penangkapan_pemberitahuan_tersangka[]"
                                                    value="{{ old('no_spp_penangkapan_pemberitahuan_tersangka.' . $index, $suratPenangkapanPemberitahuanTersangka['no_spp_penangkapan_pemberitahuan'] ?? '') }}">
                                                <span class="input-group-text">/PPNS/</span>
                                                <input type="date" class="form-control"
                                                    name="tgl_spp_penangkapan_pemberitahuan_tersangka[]"
                                                    value="{{ old('tgl_spp_penangkapan_pemberitahuan_tersangka.' . $index, $suratPenangkapanPemberitahuanTersangka['tgl_spp_penangkapan_pemberitahuan'] ?? '') }}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-md-4 d-flex align-items-center">Lampiran
                                        </div>
                                        <div class="col-md-1 text-center">:</div>
                                        <div class="col-md-7">
                                            <input type="text" class="form-control border-0 py-1" value="Satu Berkas"
                                                readonly>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-md-4 d-flex align-items-center">Hal
                                        </div>
                                        <div class="col-md-1 text-center">:</div>
                                        <div class="col-md-7">
                                            <input type="text" class="form-control border-0 py-1"
                                                value="Pemberitahuan Penangkapan Tersangka" readonly>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-md-4 d-flex align-items-center">Nama Lengkap
                                            Tersangka
                                        </div>
                                        <div class="col-md-1 text-center">:</div>
                                        <div class="col-md-7"><input type="text"
                                                name="penangkapan_pemberitahuan_nama_tersangka[]"
                                                class="form-control border-0 py-1"
                                                value="{{ $tersangka['nama'] ?? '' }}" readonly></div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-md-4 text-black d-flex align-items-center">
                                            Pejabat Penerbit Surat Pemberitahuan Penangkapan
                                        </div>
                                        <div
                                            class="col-md-1 text-center d-flex align-items-center justify-content-center">
                                            :</div>
                                        <div class="col-md-7">
                                            <select class="form-control py-1 form-select select2"
                                                name="pejabat_penerbit_surat_penangkapan_pemberitahuan_tersangka[]">
                                                <option value="" disabled
                                                    {{ old('pejabat_penerbit_surat_penangkapan_pemberitahuan_tersangka.' . $index, $suratPenangkapanPemberitahuanTersangka['pejabat_penerbit'] ?? '') == '' ? 'selected' : '' }}>
                                                    - Pilih -</option>

                                                @foreach ($users as $user)
                                                    <option value="{{ $user->id_admin }}"
                                                        {{ old('pejabat_penerbit_surat_penangkapan_pemberitahuan_tersangka.' . $index, $suratPenangkapanPemberitahuanTersangka['pejabat_penerbit'] ?? '') == $user->id_admin ? 'selected' : '' }}>
                                                        {{ $user->name }} | {{ $user->pangkat }} |
                                                        {{ $user->jabatan }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-md-4 text-black d-flex align-items-center">
                                            Status Plh. Pejabat Penerbit
                                        </div>
                                        <div
                                            class="col-md-1 text-center d-flex align-items-center justify-content-center">
                                            :
                                        </div>
                                        <div class="col-md-7">
                                            <select class="form-control py-1 form-select select2"
                                                name="status_plh_spp_pemberitahuan[]">
                                                <option value="" disabled
                                                    {{ old('status_plh_spp_pemberitahuan.' . $index, $suratPenangkapanPemberitahuanTersangka['status_plh_spp_pemberitahuan'] ?? '') == '' ? 'selected' : '' }}>
                                                    - Pilih -
                                                </option>
                                                <option value="Plh."
                                                    {{ old('status_plh_spp_pemberitahuan.' . $index, $suratPenangkapanPemberitahuanTersangka['status_plh_spp_pemberitahuan'] ?? '') == 'Plh.' ? 'selected' : '' }}>
                                                    Plh.
                                                </option>
                                                <option value=""
                                                    {{ old('status_plh_spp_pemberitahuan.' . $index, $suratPenangkapanPemberitahuanTersangka['status_plh_spp_pemberitahuan'] ?? '') == '' ? 'selected' : '' }}>
                                                    Tidak Plh.
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                    <hr>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>


            <hr class="border border-dark border-2 bg-dark">

            <h6 class="text-black">3. Demikian untuk menjadi maklum.</h6>

        </div>
    </div>
</div>
