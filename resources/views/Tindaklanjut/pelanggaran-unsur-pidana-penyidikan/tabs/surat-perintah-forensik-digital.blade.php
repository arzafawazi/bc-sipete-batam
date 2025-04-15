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

    <h5 class="fw-bold text-center"><u>SURAT PERINTAH FORENSIK DIGITAL</u></h5>


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
                                    <li class="mb-1 ps-1">Dalam rangka memperoleh data dan/atau infromasi untuk
                                        kepentingan
                                        pengumpulan alat bukti pada proses Penyidikan tindak pidana, perlu
                                        melakukan forensik digital.
                                    </li>
                                </ol>
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label class="col-md-3 col-sm-12 col-form-label fw-bold text-md-start">DASAR</label>
                            <div class="col-md-1 col-sm-1 text-center mt-1 d-none d-sm-block">:</div>
                            <div class="col-md-8 col-sm-11">
                                <ol class="ps-3 text-black" start="1" style="line-height: 1.5;">
                                    <li class="mb-1 ps-1">Pasal 7 ayat (1) Undang-Undang Nomor 8 tahun 1981 tentang
                                        Hukum Acara Pidana;</li>
                                    <li class="mb-1 ps-1">Pasal 112 ayat (2) Undang-Undang Nomor 10 tahun 1995 tentang
                                        Kepabeanan sebagaimana telah diubah dengan Undang-Undang Nomor 17 Tahun 2006;
                                    </li>
                                    <li class="mb-1 ps-1">Pasal 63 ayat (2) Undang-Undang Nomor 11 tahun 1995 tentang
                                        Cukai sebagaimana telah diubah dengan Undang-Undang Nomor 39 tahun 2007;</li>
                                    <li class="mb-1 ps-1">Peraturan Pemerintah Nomor 55 tahun 1996 tentang Penyidikan
                                        Tindak Pidana di Bidang Kepabeanan dan Cukai;</li>
                                    <li class="mb-1 ps-1">Peraturan Menteri Keuangan Nomor ...(6)... tentang Organisasi
                                        dan Tata Kerja Kementerian Keuangan/Organisasi dan Tata Kerja Instansi Vertikal
                                        Direktorat Jenderal Bea dan Cukai*);</li>
                                    <li class="mb-1 ps-1">LK Nomor : LK- ...........(7)........ tanggal ………(8)……..;</li>
                                    <li class="mb-1 ps-1">Surat Perintah Tugas Penyidikan (SPTP) Nomor : SPTP-
                                        ...........(9)........... tanggal ……....(10)....……;</li>
                                    <li class="mb-1 ps-1">Surat Perintah Penyitaan Nomor : SPP- …………(11)…………. tanggal
                                        …………..(12)…………..</li>
                                </ol>
                            </div>
                        </div>


                        <div class="mb-3 row">
                            <label class="col-md-3 col-sm-12 col-form-label fw-bold text-md-start">Data Tersangka</label>
                            <div class="col-md-1 col-sm-1 text-center mt-1 d-none d-sm-block">:</div>
                            <div class="col-md-8 col-sm-11">
                                <div id="form-tersangka-forensik">
                                    <div id="dynamic-form-tersangka-forensik">
                                        @foreach ($tersangkaData as $index => $tersangka)
                                            @php
                                                $digitalForensikTersangka = $forensikTersangka[$index] ?? null;
                                            @endphp
                                            <div class="entry-tersangka text-black">
                                                <hr>
                                                <div class="row mb-3">
                                                    <div class="col-md-12">
                                                        <div class="input-group">
                                                            <span class="input-group-text">NO : SPFD-</span>
                                                            <input type="text" class="form-control"
                                                                name="no_spfd_tersangka[]"
                                                                value="{{ old('no_spfd_tersangka.' . $index, $digitalForensikTersangka['no_spfd'] ?? '') }}">
                                                            <span class="input-group-text">/PPNS/</span>
                                                            <input type="date" class="form-control"
                                                                name="tgl_spfd_tersangka[]"
                                                                value="{{ old('tgl_spfd_tersangka.' . $index, $digitalForensikTersangka['tgl_spfd'] ?? '') }}">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row mb-3">
                                                    <div class="col-md-4 d-flex align-items-center">Nama Lengkap
                                                        Tersangka
                                                    </div>
                                                    <div class="col-md-1 text-center">:</div>
                                                    <div class="col-md-7"><input type="text"
                                                            name="forensik_nama_tersangka[]"
                                                            class="form-control border-0 py-1"
                                                            value="{{ $tersangka['nama'] ?? '' }}" readonly></div>
                                                </div>
                                                <div class="row mb-3">
                                                    <div class="col-md-12">
                                                        @php
                                                            $selectedPejabat = json_decode(
                                                                $digitalForensikTersangka['pejabat_forensik'] ?? '[]',
                                                                true,
                                                            );
                                                        @endphp
                                                        <div class="input-group flex-column">
                                                            <span
                                                                class="input-group-text text-white bg-primary justify-content-center text-center w-100 rounded">
                                                                D I P E R I N T A H K A N
                                                            </span>
                                                            <select class="form-select select2 w-100 mt-1"
                                                                name="pejabat_forensik[{{ $index }}][]"
                                                                multiple>
                                                                @foreach ($users as $user)
                                                                    <option value="{{ $user->id_admin }}"
                                                                        @if (in_array($user->id_admin, $selectedPejabat)) selected @endif>
                                                                        {{ $user->name }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row mb-3">
                                                    <div class="col-md-4 d-flex align-items-center">Diisi
                                                    </div>
                                                    <div
                                                        class="col-md-1 text-center d-flex align-items-center justify-content-center">
                                                        :</div>
                                                    <div class="col-md-7">
                                                        <textarea name="rincian_data_bukti[]" class="form-control" rows="5"
                                                            placeholder="Diisi barang bukti yang dilakukan forensik digital
                                                        ">{{ $digitalForensikTersangka['rincian_data_bukti'] ?? '' }}</textarea>
                                                    </div>
                                                </div>
                                                <div class="row mb-3">
                                                    <div class="col-md-4 text-black d-flex align-items-center">
                                                        Waktu Berlaku Surat Perintah Forensik Digital
                                                    </div>
                                                    <div
                                                        class="col-md-1 text-center d-flex align-items-center justify-content-center">
                                                        :</div>
                                                    <div class="col-md-7">
                                                        <input type="text" class="form-control" id="date-range-picker"
                                                            name="waktu_surat_forensik_tersangka[]"
                                                            value="{{ old('waktu_surat_forensik_tersangka.' . $index, $digitalForensikTersangka['waktu_berlaku_forensik'] ?? '') }}">
                                                    </div>
                                                </div>
                                                <div class="row mb-3">
                                                    <div class="col-md-4 text-black d-flex align-items-center">
                                                        Penyidik Penerbit Surat Perintah Forensik Digital
                                                    </div>
                                                    <div
                                                        class="col-md-1 text-center d-flex align-items-center justify-content-center">
                                                        :</div>
                                                    <div class="col-md-7">
                                                        <select class="form-control py-1 form-select select2"
                                                            name="pejabat_penerbit_surat_forensik_tersangka[]">
                                                            <option value="" disabled
                                                                {{ old('pejabat_penerbit_surat_forensik_tersangka.' . $index, $digitalForensikTersangka['pejabat_penerbit'] ?? '') == '' ? 'selected' : '' }}>
                                                                - Pilih -</option>

                                                            @foreach ($users as $user)
                                                                <option value="{{ $user->id_admin }}"
                                                                    {{ old('pejabat_penerbit_surat_forensik_tersangka.' . $index, $digitalForensikTersangka['pejabat_penerbit'] ?? '') == $user->id_admin ? 'selected' : '' }}>
                                                                    {{ $user->name }} | {{ $user->pangkat }} |
                                                                    {{ $user->jabatan }}
                                                                </option>
                                                            @endforeach
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

                        <div class="mb-3 row">
                            <label class="col-md-3 col-sm-12 col-form-label fw-bold text-md-start">U N T U K</label>
                            <div class="col-md-1 col-sm-1 text-center mt-1 d-none d-sm-block">:</div>
                            <div class="col-md-8 col-sm-11">
                                <ol class="ps-3 text-black" start="1" style="line-height: 1.5;">
                                    <li class="mb-1 ps-1">Melakukan forensik digital terhadap:
                                        <div class="ps-3" style="line-height: 1.5;">
                                            ………………………………….(19)……………………………………..
                                        </div>
                                        Sehubungan dengan terjadinya tindak pidana di bidang .........(20)..........
                                        yaitu ………(21)………..., diduga melanggar ……..(22)……................
                                    </li>
                                    <li class="mb-1 ps-1">Setelah melaksanakan surat perintah ini agar membuat Berita
                                        Acara Forensik Digital.</li>
                                    <li class="mb-1 ps-1">Surat Perintah ini mulai berlaku sejak tanggal
                                        .......(23)...... sampai dengan tanggal ………(24).……..</li>
                                </ol>
                            </div>
                        </div>



                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
