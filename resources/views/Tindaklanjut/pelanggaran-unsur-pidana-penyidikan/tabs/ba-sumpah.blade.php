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

    <h5 class="fw-bold text-center">Berita Acara Sumpah
    </h5>

    <!-- Main Form -->
    <div class="card p-1">
        <div class="card-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="container-fluid px-0 px-sm-3">


                        <div class="mb-3 row">
                            <label class="col-md-3 col-sm-12 col-form-label fw-bold text-md-start">Masukkan data BA SUMPAH</label>
                            <div class="col-md-1 col-sm-1 text-center mt-1 d-none d-sm-block">:</div>
                            <div class="col-md-8 col-sm-11">

                                <div class="mb-3">
                                    <label class="fw-bold">Pilih Kategori:</label>
                                     <select class="form-select select2" id="kategoriBaSumpah">
                                        <option value="" selected disabled>Pilih</option>
                                        <option value="saksi">Saksi (PILIH BAGIAN INI UNTUK MENGISI DATA-DATA SAKSI)</option>
                                        <option value="ahli">Ahli (PILIH BAGIAN INI UNTUK MENGISI DATA-DATA BA SUMPAH)</option>
                                    </select>
                                </div>

                                <div id="form-saksi-ba-sumpah" style="display: none;">
                                    <h5 class="fw-bold text-primary">Kumpulan Data Saksi</h5>
                                    <div id="dynamic-form-saksi-ba-sumpah">
                                        @foreach($saksiData as $index => $saksi)
                                        @php
                                        $saksiSumpah = $baSumpahSaksi[$index] ?? null;
                                        $ahliSumpah = $baSumpahAhli[$index] ?? null;
                                        @endphp
                                        <div class="entry-saksi text-black">
                                            <hr>
                                            <div class="row mb-3">
                                                <div class="col-md-4 d-flex align-items-center">Nama Lengkap</div>
                                                <div class="col-md-1 text-center">:</div>
                                                <div class="col-md-7"><input type="text" name="ba_sumpah_nama_saksi[]" class="form-control border-0 py-1" value="{{ $saksi['nama'] ?? '' }}" readonly></div>
                                            </div>
                                            <div class="row mb-3">
                                                <div class="col-md-4 d-flex align-items-center">Tempat /Tanggal Lahir</div>
                                                <div class="col-md-1 text-center">:</div>
                                                <div class="col-md-7"><input type="text" class="form-control border-0 py-1" value="{{ $saksi['ttl'] ?? '' }}" readonly></div>
                                            </div>
                                            <div class="row mb-3">
                                                <div class="col-md-4 d-flex align-items-center">Jenis Kelamin</div>
                                                <div class="col-md-1 text-center">:</div>
                                                <div class="col-md-7">
                                                   <input type="text" class="form-control border-0 py-1" value="{{ $saksi['jenis_kelamin'] ?? '' }}" readonly>
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <div class="col-md-4 d-flex align-items-center">Kewarganegaraan</div>
                                                <div class="col-md-1 text-center">:</div>
                                                <div class="col-md-7">
                                                    <input type="text" class="form-control border-0 py-1" value="{{ $saksi['kewarganegaraan'] ?? '' }}" readonly>
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <div class="col-md-4 d-flex align-items-center">Agama</div>
                                                <div class="col-md-1 text-center">:</div>
                                                <div class="col-md-7"><input type="text" class="form-control border-0 py-1" value="{{ $saksi['agama'] ?? '' }}" readonly></div>
                                            </div>
                                            <div class="row mb-3">
                                                <div class="col-md-4 d-flex align-items-center">Pekerjaan</div>
                                                <div class="col-md-1 text-center">:</div>
                                                <div class="col-md-7"><input type="text" class="form-control border-0 py-1"  value="{{ $saksi['pekerjaan'] ?? '' }}" readonly></div>
                                            </div>
                                            <div class="row mb-3">
                                                <div class="col-md-4 d-flex align-items-center">Alamat Tempat Tinggal</div>
                                                <div class="col-md-1 text-center">:</div>
                                                <div class="col-md-7"><input type="text" class="form-control border-0 py-1"  value="{{ $saksi['alamat'] ?? '' }}" readonly></div>
                                            </div>

                                            <div class="row mb-3">
                                                <div class="col-md-4 text-black d-flex align-items-center">Waktu Pengambilan Sumpah</div>
                                                <div class="col-md-1 text-center d-flex align-items-center justify-content-center">:</div>
                                                <div class="col-md-7">
                                                    <input type="text" class="form-control datetime-datepicker"
                                                        name="waktu_sumpah_saksi[]"
                                                        value="{{ old('waktu_sumpah_saksi.' . $index, $saksiSumpah['waktu_sumpah'] ?? '') }}">
                                                </div>
                                            </div>

                                            <div class="row mb-3">
                                                <div class="col-md-4 text-black d-flex align-items-center">Saksi Pertama</div>
                                                <div class="col-md-1 text-center d-flex align-items-center justify-content-center">:</div>
                                                <div class="col-md-7">
                                                    <select class="form-control py-1 form-select select2" name="saksi_pertama_ba_sumpah_saksi[]">
                                                        <option value="" selected disabled>- Pilih -</option>
                                                        @foreach ($users as $user)
                                                            <option value="{{ $user->id_admin }}" 
                                                                {{ old('saksi_pertama_ba_sumpah_saksi.' . $index, $saksiSumpah['saksi_pertama'] ?? '') == $user->id_admin ? 'selected' : '' }}>
                                                                {{ $user->name }} | {{ $user->pangkat }} | {{ $user->jabatan }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="row mb-3">
                                                <div class="col-md-4 text-black d-flex align-items-center">Saksi Kedua</div>
                                                <div class="col-md-1 text-center d-flex align-items-center justify-content-center">:</div>
                                                <div class="col-md-7">
                                                    <select class="form-control py-1 form-select select2" name="saksi_kedua_ba_sumpah_saksi[]">
                                                        <option value="" selected disabled>- Pilih -</option>
                                                        @foreach ($users as $user)
                                                            <option value="{{ $user->id_admin }}" 
                                                                {{ old('saksi_kedua_ba_sumpah_saksi.' . $index, $saksiSumpah['saksi_kedua'] ?? '') == $user->id_admin ? 'selected' : '' }}>
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

                                    <div id="form-ahli-ba-sumpah" style="display: none;">
                                        <h5 class="fw-bold text-primary">Kumpulan Data Ahli</h5>
                                        <div id="dynamic-form-ahli-ba-sumpah">
                                            @foreach($ahliData as $index => $ahli)
                                            <div class="entry-ahli text-black">
                                                <hr>
                                                <div class="row mb-3">
                                                    <div class="col-md-4 d-flex align-items-center">Nama Lengkap</div>
                                                    <div class="col-md-1 text-center">:</div>
                                                    <div class="col-md-7"><input type="text" class="form-control border-0 py-1" name="ba_sumpah_nama_ahli[]"  value="{{ $ahli['nama'] ?? '' }}" readonly></div>
                                                </div>
                                                <div class="row mb-3">
                                                    <div class="col-md-4 d-flex align-items-center">Tempat /Tanggal Lahir</div>
                                                    <div class="col-md-1 text-center">:</div>
                                                    <div class="col-md-7"><input type="text" class="form-control border-0 py-1"  value="{{ $ahli['ttl'] ?? '' }}" readonly></div>
                                                </div>
                                                <div class="row mb-3">
                                                    <div class="col-md-4 d-flex align-items-center">Agama</div>
                                                    <div class="col-md-1 text-center">:</div>
                                                    <div class="col-md-7"><input type="text" class="form-control border-0 py-1"  value="{{ $ahli['agama'] ?? '' }}" readonly></div>
                                                </div>
                                                <div class="row mb-3">
                                                    <div class="col-md-4 d-flex align-items-center">Jenis Kelamin</div>
                                                    <div class="col-md-1 text-center">:</div>
                                                    <div class="col-md-7">
                                                        <input type="text" class="form-control border-0 py-1" value="{{ $ahli['jenis_kelamin'] ?? '' }}" readonly>
                                                    </div>
                                                </div>
                                                <div class="row mb-3">
                                                    <div class="col-md-4 d-flex align-items-center">Pekerjaan</div>
                                                    <div class="col-md-1 text-center">:</div>
                                                    <div class="col-md-7"><input type="text" class="form-control border-0 py-1"  value="{{ $ahli['pekerjaan'] ?? '' }}" readonly></div>
                                                </div>
                                                <div class="row mb-3">
                                                    <div class="col-md-4 d-flex align-items-center">Alamat Domisili</div>
                                                    <div class="col-md-1 text-center">:</div>
                                                    <div class="col-md-7"><input type="text" class="form-control border-0 py-1"  value="{{ $ahli['alamat_domisili'] ?? '' }}" readonly></div>
                                                </div>
                                                <div class="row mb-3">
                                                    <div class="col-md-4 d-flex align-items-center">Alamat Kantor</div>
                                                    <div class="col-md-1 text-center">:</div>
                                                    <div class="col-md-7"><input type="text" class="form-control border-0 py-1"  value="{{ $ahli['alamat_kantor'] ?? '' }}" readonly></div>
                                                </div>

                                                <div class="row mb-3">
                                                <div class="col-md-4 text-black d-flex align-items-center">Waktu Pengambilan Sumpah</div>
                                                <div class="col-md-1 text-center d-flex align-items-center justify-content-center">:</div>
                                                <div class="col-md-7">
                                                    <input type="text" class="form-control datetime-datepicker"
                                                        name="waktu_sumpah_ahli[]"
                                                        value="{{ old('waktu_sumpah_ahli.' . $index, $saksiSumpah['waktu_sumpah'] ?? '') }}">
                                                </div>
                                            </div>

                                            <div class="row mb-3">
                                                <div class="col-md-4 text-black d-flex align-items-center">Saksi Pertama</div>
                                                <div class="col-md-1 text-center d-flex align-items-center justify-content-center">:</div>
                                                <div class="col-md-7">
                                                    <select class="form-control py-1 form-select select2" name="saksi_pertama_ba_sumpah_ahli[]">
                                                        <option value="" selected disabled>- Pilih -</option>
                                                        @foreach ($users as $user)
                                                            <option value="{{ $user->id_admin }}" 
                                                                {{ old('saksi_pertama_ba_sumpah_ahli.' . $index, $ahliSumpah['saksi_pertama'] ?? '') == $user->id_admin ? 'selected' : '' }}>
                                                                {{ $user->name }} | {{ $user->pangkat }} | {{ $user->jabatan }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="row mb-3">
                                                <div class="col-md-4 text-black d-flex align-items-center">Saksi Kedua</div>
                                                <div class="col-md-1 text-center d-flex align-items-center justify-content-center">:</div>
                                                <div class="col-md-7">
                                                    <select class="form-control py-1 form-select select2" name="saksi_kedua_ba_sumpah_ahli[]">
                                                        <option value="" selected disabled>- Pilih -</option>
                                                        @foreach ($users as $user)
                                                            <option value="{{ $user->id_admin }}" 
                                                                {{ old('saksi_kedua_ba_sumpah_ahli.' . $index, $ahliSumpah['saksi_kedua'] ?? '') == $user->id_admin ? 'selected' : '' }}>
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
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener("DOMContentLoaded", function () {
    if ($.fn.select2 && !$('#kategoriBaSumpah').hasClass("select2-hidden-accessible")) {
        $('#kategoriBaSumpah').select2();
    }

    $('#kategoriBaSumpah').off('select2:select').on('select2:select', function (e) {
        let selectedValue = $(this).val();

        $("#form-saksi-ba-sumpah, #form-tersangka-ba-sumpah, #form-ahli-ba-sumpah").hide();

        if (selectedValue === "saksi") {
            $("#form-saksi-ba-sumpah").show();
        } else if (selectedValue === "tersangka") {
            $("#form-tersangka-ba-sumpah, #form-tersangka-ba-sumpah").show();
        } else if (selectedValue === "ahli") {
            $("#form-ahli-ba-sumpah, #form-ahli-ba-sumpah").show();
        }
    });
});

document.addEventListener("DOMContentLoaded", function () {
    document.querySelectorAll(".datetime-datepicker").forEach(function (element) {
        flatpickr(element, {
            enableTime: true,
            dateFormat: "Y-m-d H:i",
            time_24hr: true
        });
    });
});


</script>

  
