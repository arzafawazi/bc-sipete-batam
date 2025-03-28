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

    <h5 class="fw-bold text-center text-black">SURAT PERINTAH PENGGELEDAHAN</h5>


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
                                    <li class="mb-1 ps-1"> Dalam keadaan mendesak untuk kepentingan Penyidikan tindak
                                        pidana, perlu untuk melakukan tindakan penggeledahan terhadap
                                        rumah/bangunan yang diduga keras melakukan tindak pidana
                                        berdasarkan bukti permulaan yang cukup.</li>
                                </ol>
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label class="col-md-3 col-sm-12 col-form-label fw-bold text-md-start">DASAR</label>
                            <div class="col-md-1 col-sm-1 text-center mt-1 d-none d-sm-block">:</div>
                            <div class="col-md-8 col-sm-11">
                                <ol class="ps-3 text-black" start="1" style="line-height: 1.5;">
                                    <li class="mb-1 ps-1">Pasal 1 butir 17, Pasal 5 ayat (1) huruf b angka 1, Pasal 7
                                        ayat (1) huruf d, Pasal 11, Pasal 32, Pasal 33, Pasal 34, Pasal 36, Pasal 125,
                                        Pasal 126, dan Pasal 127 Undang-Undang Nomor 8 Tahun 1981 tentang Hukum Acara
                                        Pidana;</li>
                                    <li class="mb-1 ps-1">Pasal 112 ayat (2) huruf i Undang-Undang Nomor 17 Tahun 2006
                                        jo. Pasal 63 ayat (2) huruf g Undang-Undang Nomor 39 Tahun 2007;</li>
                                    <li class="mb-1 ps-1">Peraturan Pemerintah Nomor 55 Tahun 1996 tentang Penyidikan
                                        Tindak Pidana di Bidang Kepabeanan dan Cukai;</li>
                                    <li class="mb-1 ps-1">LK Nomor : LK-.........(4)......... tanggal
                                        ............(5)............;</li>
                                    <li class="mb-1 ps-1">Surat Perintah Tugas Penyidikan (SPTP) Nomor :
                                        SPTP-.........(6)......... tanggal ...........(7)...........</li>
                                </ol>
                            </div>
                        </div>

                        <div class="mb-3 row">
                         <label class="col-md-3 col-sm-12 col-form-label fw-bold text-md-start">Tersangka</label>
                            <div class="col-md-1 col-sm-1 text-center mt-1 d-none d-sm-block">:</div>
                            <div class="col-md-8 col-sm-11">
                            <div id="form-tersangka-penggeledahan">
                                <div id="dynamic-form-tersangka-penggeledahan">
                                    @foreach ($tersangkaData as $index => $tersangka)
                                        <div class="entry-tersangka text-black">
                                            <hr>
                                            <div class="row mb-3">
                                                 <div class="col-md-12">
                                                     <div class="input-group">
                                                         <span class="input-group-text">NO : SPPR-</span>
                                                         <input type="text" class="form-control" name="no_sppr_tersangka[]">
                                                         <span class="input-group-text">/PPNS/</span>
                                                         <input type="date" class="form-control" name="tgl_sppr_tersangka[]">
                                                     </div>
                                                 </div>
                                             </div>
                                            <div class="row mb-3">
                                                <div class="col-md-4 d-flex align-items-center">Nama Lengkap</div>
                                                <div class="col-md-1 text-center">:</div>
                                                <div class="col-md-7"><input type="text"
                                                        name="penggeledahan_nama_tersangka[]"
                                                        class="form-control border-0 py-1"
                                                        value="{{ $tersangka['nama'] ?? '' }}" readonly></div>
                                            </div>
                                            <div class="row mb-3">
                                                <div class="col-md-4 d-flex align-items-center">Tempat /Tanggal Lahir
                                                </div>
                                                <div class="col-md-1 text-center">:</div>
                                                <div class="col-md-7"><input type="text"
                                                        class="form-control border-0 py-1"
                                                        value="{{ $tersangka['ttl'] ?? '' }}" readonly></div>
                                            </div>
                                            <div class="row mb-3">
                                                <div class="col-md-4 d-flex align-items-center">Agama</div>
                                                <div class="col-md-1 text-center">:</div>
                                                <div class="col-md-7"><input type="text"
                                                        class="form-control border-0 py-1"
                                                        value="{{ $tersangka['agama'] ?? '' }}" readonly></div>
                                            </div>
                                            <div class="row mb-3">
                                                <div class="col-md-4 d-flex align-items-center">Jenis Kelamin</div>
                                                <div class="col-md-1 text-center">:</div>
                                                <div class="col-md-7">
                                                    <input type="text" class="form-control border-0 py-1"
                                                        value="{{ $tersangka['jenis_kelamin'] ?? '' }}" readonly>
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <div class="col-md-4 d-flex align-items-center">Kewarganegaraan</div>
                                                <div class="col-md-1 text-center">:</div>
                                                <div class="col-md-7">
                                                    <input type="text" class="form-control border-0 py-1"
                                                        value="{{ $tersangka['kewarganegaraan'] ?? '' }}" readonly>
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <div class="col-md-4 d-flex align-items-center">Pekerjaan Saat Ini</div>
                                                <div class="col-md-1 text-center">:</div>
                                                <div class="col-md-7"><input type="text"
                                                        class="form-control border-0 py-1"
                                                        value="{{ $tersangka['pekerjaan'] ?? '' }}" readonly></div>
                                            </div>
                                            <div class="row mb-3">
                                                <div class="col-md-4 d-flex align-items-center">Alamat Sesuai Identitas
                                                </div>
                                                <div class="col-md-1 text-center">:</div>
                                                <div class="col-md-7"><input type="text"
                                                        class="form-control border-0 py-1"
                                                        value="{{ $tersangka['alamat'] ?? '' }}" readonly></div>
                                            </div>
                                            <div class="row mb-3">
                                                <div class="col-md-4 d-flex align-items-center">Jenis/Nomor Identitas
                                                </div>
                                                <div class="col-md-1 text-center">:</div>
                                                <div class="col-md-7">
                                                    <div class="input-group">
                                                        <input type="text" class="form-control  py-1"
                                                            placeholder="Jenis Identitas"
                                                            value="{{ $tersangka['jenis_identitas'] ?? '' }}" readonly>
                                                        <input type="text" class="form-control  py-1"
                                                            placeholder="Nomor Identitas"
                                                            value="{{ $tersangka['nomor_identitas'] ?? '' }}"
                                                            readonly>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <div class="col-md-4 d-flex align-items-center">Pendidikan Terakhir
                                                </div>
                                                <div class="col-md-1 text-center">:</div>
                                                <div class="col-md-7"><input type="text"
                                                        class="form-control border-0 py-1"
                                                        value="{{ $tersangka['pendidikan'] ?? '' }}" readonly></div>
                                            </div>
                                            <div class="row mb-3">
                                                 <div class="col-md-12">
                                                     <div class="input-group flex-column">
                                                         <span class="input-group-text text-white bg-primary justify-content-center text-center w-100 rounded">
                                                             D I P E R I N T A H K A N
                                                         </span>
                                                         <select class="form-select select2 w-100 mt-1"
                                                            name="pejabat_geledah[{{ $index }}][]" multiple>
                                                            @foreach ($users as $user)
                                                                <option value="{{ $user->id_admin }}">{{ $user->name }}</option>
                                                            @endforeach
                                                        </select>

                                                     </div>
                                                 </div>
                                             </div>
                                            <div class="row mb-3">
                                                <div class="col-md-4 text-black d-flex align-items-center">Waktu Berlaku Surat Perintah</div>
                                                <div class="col-md-1 text-center d-flex align-items-center justify-content-center">:</div>
                                                <div class="col-md-7">
                                                    <input type="text" class="form-control datetime-datepicker"
                                                        name="waktu_surat_penggeledahan_tersangka[]"
                                                        value="{{ old('waktu_surat_penggeledahan_tersangka.' . $index, $tersangkaPenggeledahan['waktu_berlaku_penggeledahan'] ?? '') }}">
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <div class="col-md-4 text-black d-flex align-items-center">Penyidik Penerbit Surat Perintah Penggeledahan</div>
                                                <div class="col-md-1 text-center d-flex align-items-center justify-content-center">:</div>
                                                <div class="col-md-7">
                                                    <select class="form-control py-1 form-select select2" name="pejabat_penerbit_surat_penggeledahan_tersangka[]">
                                                        <option value="" selected disabled>- Pilih -</option>
                                                        @foreach ($users as $user)
                                                            <option value="{{ $user->id_admin }}" 
                                                                {{ old('pejabat_penerbit_surat_penggeledahan_tersangka.' . $index, $saksiSumpah['pejabat_penerbit'] ?? '') == $user->id_admin ? 'selected' : '' }}>
                                                                {{ $user->name }} | {{ $user->pangkat }} | {{ $user->jabatan }}
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
                                    <li class="mb-1 ps-1">Melakukan penggeledahan Rumah/Bangunan dari Sdri.
                                        ...........(11).......... yang terletak di .............(12)..........., guna
                                        melakukan:
                                        <ol class="ps-3" type="a">
                                            <li>Pemeriksaan dan/atau</li>
                                            <li>Penyitaan dan/atau</li>
                                            <li>Penangkapan</li>
                                        </ol>
                                        Sehubungan dengan terjadinya tindak pidana di bidang
                                        ..............(13)............ yaitu .................(14)................,
                                        diduga melanggar Pasal ...........(15).......... Undang-Undang
                                        ..........(16)..........
                                    </li>
                                    <li class="mb-1 ps-1">Setelah melaksanakan Surat Perintah ini agar membuat Berita
                                        Acara Penggeledahan.</li>
                                    <li class="mb-1 ps-1">Surat Perintah ini berlaku sejak tanggal
                                        .............(17).................. sampai dengan selesai.</li>
                                </ol>
                            </div>
                        </div>


                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
