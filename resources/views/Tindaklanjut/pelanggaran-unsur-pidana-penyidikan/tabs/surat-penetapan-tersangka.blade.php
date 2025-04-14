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

    <h5 class="fw-bold text-center"><u>SURAT PENETAPAN TERSANGKA</u></h5>


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
                                <ol class="ps-3 text-black" start="1" style="line-height: 1.5;">
                                    <li class="mb-1 ps-1">Setelah membaca hasil Gelar Perkara tanggal ......(6)........;
                                    </li>
                                    <li class="mb-1 ps-1">Bahwa telah diperoleh bukti yang cukup guna menentukan
                                        Tersangka dalam Penyidikan dugaan tindak pidana di ......(7).........</li>
                                </ol>
                            </div>
                        </div>


                        <div class="mb-3 row">
                            <label class="col-md-3 col-sm-12 col-form-label fw-bold text-md-start">DASAR</label>
                            <div class="col-md-1 col-sm-1 text-center mt-1 d-none d-sm-block">:</div>
                            <div class="col-md-8 col-sm-11">
                                <ol class="ps-3 text-black" start="1" style="line-height: 1.5;">
                                    <li class="mb-1 ps-1">Undang-Undang Nomor 8 tahun 1981 tentang Hukum Acara Pidana;
                                    </li>
                                    <li class="mb-1 ps-1">Undang-Undang Nomor 10 tahun 1995 tentang Kepabeanan
                                        sebagaimana telah diubah dengan Undang-Undang Nomor 17 Tahun 2006;</li>
                                    <li class="mb-1 ps-1">Undang-Undang Nomor 11 tahun 1995 tentang Cukai sebagaimana
                                        telah diubah dengan Undang-Undang Nomor 39 tahun 2007;</li>
                                    <li class="mb-1 ps-1">Peraturan Pemerintah Nomor 55 tahun 1996 tentang Penyidikan
                                        Tindak Pidana di Bidang Kepabeanan dan Cukai;</li>
                                    <li class="mb-1 ps-1">Peraturan Menteri Keuangan Nomor ...........(8)........
                                        tentang Organisasi dan Tata Kerja Kementerian Keuangan/Organisasi dan Tata Kerja
                                        Instansi Vertikal Direktorat Jenderal Bea dan Cukai*);</li>
                                    <li class="mb-1 ps-1">Peraturan Direktur Jenderal Bea dan Cukai Nomor
                                        ...........(9)........ tentang Tata Laksana Penyidikan;</li>
                                    <li class="mb-1 ps-1">Laporan Kejadian Tindak Pidana Nomor : LK-
                                        ...........(10)........ tanggal ………(11)……..;</li>
                                    <li class="mb-1 ps-1">Surat Perintah Tugas Penyidikan Nomor : SPTP-
                                        ...........(12)........... tanggal ……....(13)....……;</li>
                                </ol>
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label class="col-md-3 col-sm-12 col-form-label fw-bold text-md-start">Menetapkan
                                Tersangka</label>
                            <div class="col-md-1 col-sm-1 text-center mt-1 d-none d-sm-block">:</div>
                            <div class="col-md-8 col-sm-11">
                                <div id="form-tersangka-penetapan">
                                    <div id="dynamic-form-tersangka-penetapan">
                                        @foreach ($tersangkaData as $index => $tersangka)
                                            @php
                                                $SuratPenetapanTersangka = $penetapanTersangka[$index] ?? null;
                                            @endphp
                                            <div class="entry-tersangka text-black">
                                                <hr>
                                                <div class="row mb-3">
                                                    <div class="col-md-12">
                                                        <div class="input-group">
                                                            <span class="input-group-text">NO : S.TAPTSK-</span>
                                                            <input type="text" class="form-control"
                                                                name="no_staptsk_tersangka[]"
                                                                value="{{ old('no_staptsk_tersangka.' . $index, $SuratPenetapanTersangka['no_staptsk'] ?? '') }}">
                                                            <span class="input-group-text">/PPNS/</span>
                                                            <input type="date" class="form-control"
                                                                name="tgl_staptsk_tersangka[]"
                                                                value="{{ old('tgl_staptsk_tersangka.' . $index, $SuratPenetapanTersangka['tgl_staptsk'] ?? '') }}">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row mb-3">
                                                    <div class="col-md-4 d-flex align-items-center">Nama Lengkap
                                                        Tersangka
                                                    </div>
                                                    <div class="col-md-1 text-center">:</div>
                                                    <div class="col-md-7"><input type="text"
                                                            name="penetapan_nama_tersangka[]"
                                                            class="form-control border-0 py-1"
                                                            value="{{ $tersangka['nama'] ?? '' }}" readonly></div>
                                                </div>
                                                <div class="row mb-3">
                                                    <div class="col-md-4 text-black d-flex align-items-center">
                                                        Pejabat Penerbit Surat Penetapan Tersangka
                                                    </div>
                                                    <div
                                                        class="col-md-1 text-center d-flex align-items-center justify-content-center">
                                                        :</div>
                                                    <div class="col-md-7">
                                                        <select class="form-control py-1 form-select select2"
                                                            name="pejabat_penerbit_surat_penetapan_tersangka[]">
                                                            <option value="" disabled
                                                                {{ old('pejabat_penerbit_surat_penetapan_tersangka.' . $index, $SuratPenetapanTersangka['pejabat_penerbit'] ?? '') == '' ? 'selected' : '' }}>
                                                                - Pilih -</option>

                                                            @foreach ($users as $user)
                                                                <option value="{{ $user->id_admin }}"
                                                                    {{ old('pejabat_penerbit_surat_penetapan_tersangka.' . $index, $SuratPenetapanTersangka['pejabat_penerbit'] ?? '') == $user->id_admin ? 'selected' : '' }}>
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
                                                            name="status_plh[]">
                                                            <option value="" disabled selected
                                                                {{ old('status_plh.' . $index, $SuratPenetapanTersangka['status_plh'] ?? '') == '' ? 'selected' : '' }}>
                                                                - Pilih -
                                                            </option>
                                                            <option value="Plh."
                                                                {{ old('status_plh.' . $index, $SuratPenetapanTersangka['status_plh'] ?? '') == 'Plh.' ? 'selected' : '' }}>
                                                                Plh.
                                                            </option>
                                                            <option value=""
                                                                {{ old('status_plh.' . $index, $SuratPenetapanTersangka['status_plh'] ?? '') == '' ? 'selected' : '' }}>
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


                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
