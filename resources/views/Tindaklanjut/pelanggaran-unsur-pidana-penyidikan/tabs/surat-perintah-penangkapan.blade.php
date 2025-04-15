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

    <h5 class="fw-bold text-center"><u>SURAT PERINTAH PENANGKAPAN</u></h5>



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
                                <p class="ps-3 text-black">
                                    Untuk kepentingan Penyidikan tindak pidana perlu untuk
                                    melakukan tindakan penangkapan terhadap seseorang yang
                                    diduga keras melakukan tindakan pidana berdasarkan bukti
                                    permulaan yang cukup.
                                </p>
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label class="col-md-3 col-sm-12 col-form-label fw-bold text-md-start">DASAR</label>
                            <div class="col-md-1 col-sm-1 text-center mt-1 d-none d-sm-block">:</div>
                            <div class="col-md-8 col-sm-11">
                                <ol class="ps-3 text-black" start="1" style="line-height: 1.5;">
                                    <li class="mb-1 ps-1">Pasal 7 ayat (2), Pasal 16 ayat (2), dan Pasal 19
                                        Undang-Undang Nomor 8 Tahun 1981 tentang Hukum Acara Pidana;</li>
                                    <li class="mb-1 ps-1">Pasal 112 ayat (2) huruf d Undang-Undang Nomor 10 tahun 1995
                                        tentang Kepabeanan sebagaimana telah diubah dengan Undang-Undang Nomor 17 tahun
                                        2006;</li>
                                    <li class="mb-1 ps-1">Pasal 63 ayat (2) huruf c Undang-Undang Nomor 11 tahun 1995
                                        tentang Cukai sebagaimana telah diubah dengan Undang-Undang Nomor 39 tahun 2007;
                                    </li>
                                    <li class="mb-1 ps-1">Peraturan Pemerintah Nomor 55 Tahun 1996 tentang Penyidikan
                                        Tindak Pidana di Bidang Kepabeanan dan Cukai;</li>
                                    <li class="mb-1 ps-1">Laporan Kejadian Tindak Pidana Nomor : LK-
                                        ...........(6)........ tanggal ………(7)……..</li>
                                    <li class="mb-1 ps-1">Surat Perintah Tugas Penyidikan Nomor: SPTP-
                                        ...........(8)........... tanggal ……....(9)....……</li>
                                </ol>
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label class="col-md-3 col-sm-12 col-form-label fw-bold text-md-start">Data
                                Tersangka</label>
                            <div class="col-md-1 col-sm-1 text-center mt-1 d-none d-sm-block">:</div>
                            <div class="col-md-8 col-sm-11">
                                <div id="form-tersangka-penangkapan">
                                    <div id="dynamic-form-tersangka-penangkapan">
                                        @foreach ($tersangkaData as $index => $tersangka)
                                            @php
                                                $suratPenangkapanTersangka = $penangkapanTersangka[$index] ?? null;
                                            @endphp
                                            <div class="entry-tersangka text-black">
                                                <hr>
                                                <div class="row mb-3">
                                                    <div class="col-md-12">
                                                        <div class="input-group">
                                                            <span class="input-group-text">NO : SPP-</span>
                                                            <input type="text" class="form-control"
                                                                name="no_spp_penangkapan_tersangka[]"
                                                                value="{{ old('no_spp_penangkapan_tersangka.' . $index, $suratPenangkapanTersangka['no_spp_penangkapan'] ?? '') }}">
                                                            <span class="input-group-text">/PPNS/</span>
                                                            <input type="date" class="form-control"
                                                                name="tgl_spp_penangkapan_tersangka[]"
                                                                value="{{ old('tgl_spp_penangkapan_tersangka.' . $index, $suratPenangkapanTersangka['tgl_spp_penangkapan'] ?? '') }}">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row mb-3">
                                                    <div class="col-md-12">
                                                        @php
                                                            $selectedPejabat = json_decode(
                                                                $suratPenangkapanTersangka['pejabat_penangkapan'] ??
                                                                    '[]',
                                                                true,
                                                            );
                                                        @endphp
                                                        <div class="input-group flex-column">
                                                            <span
                                                                class="input-group-text text-white bg-primary justify-content-center text-center w-100 rounded">
                                                                D I P E R I N T A H K A N
                                                            </span>
                                                            <select class="form-select select2 w-100 mt-1"
                                                                name="pejabat_penangkapan[{{ $index }}][]"
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
                                                    <div class="col-md-4 d-flex align-items-center">Nama Lengkap
                                                        Tersangka
                                                    </div>
                                                    <div class="col-md-1 text-center">:</div>
                                                    <div class="col-md-7"><input type="text"
                                                            name="penangkapan_nama_tersangka[]"
                                                            class="form-control border-0 py-1"
                                                            value="{{ $tersangka['nama'] ?? '' }}" readonly></div>
                                                </div>
                                                <div class="row mb-3">
                                                    <div class="col-md-4 text-black d-flex align-items-center">
                                                        Pejabat Penerbit Surat Perintah Penangkapan
                                                    </div>
                                                    <div
                                                        class="col-md-1 text-center d-flex align-items-center justify-content-center">
                                                        :</div>
                                                    <div class="col-md-7">
                                                        <select class="form-control py-1 form-select select2"
                                                            name="pejabat_penerbit_surat_penangkapan_tersangka[]">
                                                            <option value="" disabled
                                                                {{ old('pejabat_penerbit_surat_penangkapan_tersangka.' . $index, $suratPenangkapanTersangka['pejabat_penerbit'] ?? '') == '' ? 'selected' : '' }}>
                                                                - Pilih -</option>

                                                            @foreach ($users as $user)
                                                                <option value="{{ $user->id_admin }}"
                                                                    {{ old('pejabat_penerbit_surat_penangkapan_tersangka.' . $index, $suratPenangkapanTersangka['pejabat_penerbit'] ?? '') == $user->id_admin ? 'selected' : '' }}>
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
                                                            name="status_plh_spp[]">
                                                            <option value="" disabled selected
                                                                {{ old('status_plh_spp.' . $index, $SuratPenetapanTersangka['status_plh_spp'] ?? '') == '' ? 'selected' : '' }}>
                                                                - Pilih -
                                                            </option>
                                                            <option value="Plh."
                                                                {{ old('status_plh_spp.' . $index, $SuratPenetapanTersangka['status_plh_spp'] ?? '') == 'Plh.' ? 'selected' : '' }}>
                                                                Plh.
                                                            </option>
                                                            <option value=""
                                                                {{ old('status_plh_spp.' . $index, $SuratPenetapanTersangka['status_plh_spp'] ?? '') == '' ? 'selected' : '' }}>
                                                                Tidak Plh.
                                                            </option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="row mb-3">
                                                    <div class="col-md-4 text-black d-flex align-items-center">
                                                        Pejabat Yang Menerima
                                                    </div>
                                                    <div
                                                        class="col-md-1 text-center d-flex align-items-center justify-content-center">
                                                        :</div>
                                                    <div class="col-md-7">
                                                        <select class="form-control py-1 form-select select2"
                                                            name="pejabat_penerima_surat_penangkapan_tersangka[]">
                                                            <option value="" disabled
                                                                {{ old('pejabat_penerima_surat_penangkapan_tersangka.' . $index, $suratPenangkapanTersangka['pejabat_penerima'] ?? '') == '' ? 'selected' : '' }}>
                                                                - Pilih -</option>

                                                            @foreach ($users as $user)
                                                                <option value="{{ $user->id_admin }}"
                                                                    {{ old('pejabat_penerima_surat_penangkapan_tersangka.' . $index, $suratPenangkapanTersangka['pejabat_penerima'] ?? '') == $user->id_admin ? 'selected' : '' }}>
                                                                    {{ $user->name }} | {{ $user->pangkat }} |
                                                                    {{ $user->jabatan }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="row mb-3">
                                                    <div class="col-md-4 text-black d-flex align-items-center">
                                                        Pejabat Yang Menyerahkan
                                                    </div>
                                                    <div
                                                        class="col-md-1 text-center d-flex align-items-center justify-content-center">
                                                        :</div>
                                                    <div class="col-md-7">
                                                        <select class="form-control py-1 form-select select2"
                                                            name="pejabat_menyerahkan_surat_penangkapan_tersangka[]">
                                                            <option value="" disabled
                                                                {{ old('pejabat_menyerahkan_surat_penangkapan_tersangka.' . $index, $suratPenangkapanTersangka['pejabat_penerima'] ?? '') == '' ? 'selected' : '' }}>
                                                                - Pilih -</option>

                                                            @foreach ($users as $user)
                                                                <option value="{{ $user->id_admin }}"
                                                                    {{ old('pejabat_menyerahkan_surat_penangkapan_tersangka.' . $index, $suratPenangkapanTersangka['pejabat_menyerahkan'] ?? '') == $user->id_admin ? 'selected' : '' }}>
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
                                <ol class="ps-3 text-black" start="3" style="line-height: 1.5;">
                                    <li class="mb-1 ps-1">Melakukan penangkapan terhadap:
                                        <div class="ps-3" style="line-height: 1.5;">
                                            Nama : ……………………..(16)…..........…………………<br>
                                            Jenis Kelamin : ……………………..(17)…..........…………………<br>
                                            Tempat/Tanggal Lahir : ……………………..(18)…..........…………………<br>
                                            Pekerjaan : ……………………..(19)…..........…………………<br>
                                            Kewarganegaraan : ……………………..(20)…..........…………………<br>
                                            Alamat : ……………………..(21)…..........…………………<br>
                                        </div>
                                        Karena diduga keras telah melakukan tindak pidana ………(22)………...,
                                        yaitu ………(23)………..., melanggar ………(24)………................
                                    </li>
                                    <li class="mb-1 ps-1">Setelah melaksanakan surat perintah ini agar membuat Berita
                                        Acara Penangkapan.</li>
                                    <li class="mb-1 ps-1">Surat Perintah ini mulai berlaku sejak tanggal
                                        .......(25)...... s.d. selesai.</li>
                                </ol>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
