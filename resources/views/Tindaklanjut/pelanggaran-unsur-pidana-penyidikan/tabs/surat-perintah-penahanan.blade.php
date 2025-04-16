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

    <h5 class="fw-bold text-center"><u>SURAT PERINTAH PENAHANAN</u></h5>


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
                                    Bahwa berdasarkan hasil pemeriksaan diperoleh bukti yang cukup
                                    Tersangka diduga keras melakukan tindak pidana yang dapat
                                    dikenakan penahanan dan Tersangka dikhawatirkan akan melarikan
                                    diri, merusak atau menghilangkan barang bukti dan atau mengulangi
                                    tindak pidana maka perlu dilakukan penahanan.
                                </p>
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label class="col-md-3 col-sm-12 col-form-label fw-bold text-md-start">DASAR</label>
                            <div class="col-md-1 col-sm-1 text-center mt-1 d-none d-sm-block">:</div>
                            <div class="col-md-8 col-sm-11">
                                <ol class="ps-3 text-black" start="1" style="line-height: 1.5;">
                                    <li class="mb-1 ps-1">Undang-Undang Nomor 8 Tahun 1981 tentang Hukum Acara Pidana;
                                    </li>
                                    <li class="mb-1 ps-1">Undang-Undang No. 10 Tahun 1995 tentang Kepabeanan sebagaimana
                                        telah diubah dengan Undang-Undang No. 17 Tahun 2006;</li>
                                    <li class="mb-1 ps-1">Undang-Undang No. 11 Tahun 1995 tentang Cukai sebagaimana
                                        telah diubah dengan Undang-Undang No. 39 Tahun 2007;</li>
                                    <li class="mb-1 ps-1">Peraturan Pemerintah Nomor 27 Tahun 1983 tentang Pelaksanaan
                                        Kitab Undang-Undang Hukum Acara Pidana sebagaimana telah diubah beberapa kali
                                        terakhir dengan Peraturan Pemerintah Nomor 92 Tahun 2015 tentang Perubahan Kedua
                                        atas Peraturan Pemerintah Nomor 27 Tahun 1983 tentang Pelaksanaan Kitab
                                        Undang-Undang Hukum Acara Pidana;</li>
                                    <li class="mb-1 ps-1">Peraturan Pemerintah Nomor 55 Tahun 1996 tentang Penyidikan
                                        Tindak Pidana di Bidang Kepabeanan dan Cukai;</li>
                                    <li class="mb-1 ps-1">Peraturan Menteri Keuangan Nomor ...(6)... tentang Organisasi
                                        dan Tata Kerja Kementerian Keuangan/Organisasi dan Tata Kerja Instansi Vertikal
                                        Direktorat Jenderal Bea dan Cukai*);</li>
                                    <li class="mb-1 ps-1">Laporan Kejadian Nomor : ………..(6)…..…….. tanggal …...…(7)………
                                    </li>
                                    <li class="mb-1 ps-1">Surat Perintah Tugas Penyidikan Nomor: ……..(8)………. tanggal
                                        ………(9)…..…..</li>
                                </ol>
                            </div>
                        </div>



                        <div class="mb-3 row">
                            <label class="col-md-3 col-sm-12 col-form-label fw-bold text-md-start">Data
                                Tersangka</label>
                            <div class="col-md-1 col-sm-1 text-center mt-1 d-none d-sm-block">:</div>
                            <div class="col-md-8 col-sm-11">
                                <div id="form-tersangka-penahanan">
                                    <div id="dynamic-form-tersangka-penahanan">
                                        @foreach ($tersangkaData as $index => $tersangka)
                                            @php
                                                $suratPenahananTersangka = $penahananTersangka[$index] ?? null;
                                            @endphp
                                            <div class="entry-tersangka text-black">
                                                <hr>
                                                <div class="row mb-3">
                                                    <div class="col-md-12">
                                                        <div class="input-group">
                                                            <span class="input-group-text">NO : SPP-</span>
                                                            <input type="text" class="form-control"
                                                                name="no_spp_penahanan_tersangka[]"
                                                                value="{{ old('no_spp_penahanan_tersangka.' . $index, $suratPenahananTersangka['no_spp_penahanan'] ?? '') }}">
                                                            <span class="input-group-text">/PPNS/</span>
                                                            <input type="date" class="form-control"
                                                                name="tgl_spp_penahanan_tersangka[]"
                                                                value="{{ old('tgl_spp_penahanan_tersangka.' . $index, $suratPenahananTersangka['tgl_spp_penahanan'] ?? '') }}">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row mb-3">
                                                    <div class="col-md-12">
                                                        @php
                                                            $selectedPejabat = json_decode(
                                                                $suratPenahananTersangka['pejabat_penahanan'] ?? '[]',
                                                                true,
                                                            );
                                                        @endphp
                                                        <div class="input-group flex-column">
                                                            <span
                                                                class="input-group-text text-white bg-primary justify-content-center text-center w-100 rounded">
                                                                D I P E R I N T A H K A N
                                                            </span>
                                                            <select class="form-select select2 w-100 mt-1"
                                                                name="pejabat_penahanan[{{ $index }}][]"
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
                                                            name="penahanan_nama_tersangka[]"
                                                            class="form-control border-0 py-1"
                                                            value="{{ $tersangka['nama'] ?? '' }}" readonly></div>
                                                </div>
                                                <div class="row mb-3">
                                                    <label class="col-md-4 d-flex align-items-center">Tempat Tersangka
                                                        Ditahan</label>
                                                    <div class="col-md-1 text-center mt-1 d-none d-sm-block">:</div>
                                                    <div class="col-md-7">
                                                        <textarea name="tempat_penahanan_tersangka[]" class="form-control" rows="5"
                                                            placeholder="Diisi Tempat Tersangka Ditahan">{{ $suratPenahananTersangka['tempat_penahanan'] ?? '' }}</textarea>
                                                    </div>
                                                </div>
                                                <div class="row mb-3">
                                                    <div class="col-md-4 d-flex align-items-center">Lama Ditahan
                                                        Tersangka
                                                    </div>
                                                    <div class="col-md-1 text-center">:</div>
                                                    <div class="col-md-7"><input type="text" class="form-control"
                                                            name="lama_ditahan_tersangka[]" placeholder="20 (dua puluh)"
                                                            value="{{ old('lama_ditahan_tersangka.' . $index, $suratPenahananTersangka['lama_ditahan'] ?? '') }}">
                                                    </div>
                                                </div>
                                                <div class="row mb-3">
                                                    <div class="col-md-4 text-black d-flex align-items-center">
                                                        Waktu Penahanan Tersangka
                                                    </div>
                                                    <div
                                                        class="col-md-1 text-center d-flex align-items-center justify-content-center">
                                                        :</div>
                                                    <div class="col-md-7">
                                                        <input type="text" class="form-control"
                                                            id="date-range-picker" name="waktu_penahanan_tersangka[]"
                                                            value="{{ old('waktu_penahanan_tersangka.' . $index, $suratPenahananTersangka['waktu_penahanan'] ?? '') }}">
                                                    </div>
                                                </div>
                                                <div class="row mb-3">
                                                    <div class="col-md-4 text-black d-flex align-items-center">
                                                        Pejabat Penerbit Surat Perintah Penahanan
                                                    </div>
                                                    <div
                                                        class="col-md-1 text-center d-flex align-items-center justify-content-center">
                                                        :</div>
                                                    <div class="col-md-7">
                                                        <select class="form-control py-1 form-select select2"
                                                            name="pejabat_penerbit_surat_penahanan_tersangka[]">
                                                            <option value="" disabled
                                                                {{ old('pejabat_penerbit_surat_penahanan_tersangka.' . $index, $suratPenahananTersangka['pejabat_penerbit'] ?? '') == '' ? 'selected' : '' }}>
                                                                - Pilih -</option>

                                                            @foreach ($users as $user)
                                                                <option value="{{ $user->id_admin }}"
                                                                    {{ old('pejabat_penerbit_surat_penahanan_tersangka.' . $index, $suratPenahananTersangka['pejabat_penerbit'] ?? '') == $user->id_admin ? 'selected' : '' }}>
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
                                                            name="status_plh_spp_penahanan[]">
                                                            <option value="" disabled
                                                                {{ old('status_plh_spp_penahanan.' . $index, $suratPenahananTersangka['status_plh_spp_penahanan'] ?? '') == '' ? 'selected' : '' }}>
                                                                - Pilih -
                                                            </option>
                                                            <option value="Plh."
                                                                {{ old('status_plh_spp_penahanan.' . $index, $suratPenahananTersangka['status_plh_spp_penahanan'] ?? '') == 'Plh.' ? 'selected' : '' }}>
                                                                Plh.
                                                            </option>
                                                            <option value=""
                                                                {{ old('status_plh_spp_penahanan.' . $index, $suratPenahananTersangka['status_plh_spp_penahanan'] ?? '') == '' ? 'selected' : '' }}>
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
                                                            name="pejabat_penerima_surat_penahanan_tersangka[]">
                                                            <option value="" disabled
                                                                {{ old('pejabat_penerima_surat_penahanan_tersangka.' . $index, $suratPenahananTersangka['pejabat_penerima'] ?? '') == '' ? 'selected' : '' }}>
                                                                - Pilih -</option>

                                                            @foreach ($users as $user)
                                                                <option value="{{ $user->id_admin }}"
                                                                    {{ old('pejabat_penerima_surat_penahanan_tersangka.' . $index, $suratPenahananTersangka['pejabat_penerima'] ?? '') == $user->id_admin ? 'selected' : '' }}>
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
                                                            name="pejabat_menyerahkan_surat_penahanan_tersangka[]">
                                                            <option value="" disabled
                                                                {{ old('pejabat_menyerahkan_surat_penahanan_tersangka.' . $index, $suratPenahananTersangka['pejabat_penerima'] ?? '') == '' ? 'selected' : '' }}>
                                                                - Pilih -</option>

                                                            @foreach ($users as $user)
                                                                <option value="{{ $user->id_admin }}"
                                                                    {{ old('pejabat_menyerahkan_surat_penahanan_tersangka.' . $index, $suratPenahananTersangka['pejabat_menyerahkan'] ?? '') == $user->id_admin ? 'selected' : '' }}>
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

                        <p class="text-black">
                            Karena diduga keras telah melakukan tindak pidana di bidang ............(23).......... yaitu
                            ……………………………………..……(24).....…………..……………………, diduga melanggar
                            Pasal ..……(25)......... Undang-Undang
                            .................................(26).......................................
                        </p>

                        <p class="text-black">
                            Penahanan dilakukan di ……………(27)…………… selama …..(28)….. hari terhitung mulai tanggal
                            ………(29)……….. sampai dengan …………(30)…………
                        </p>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
