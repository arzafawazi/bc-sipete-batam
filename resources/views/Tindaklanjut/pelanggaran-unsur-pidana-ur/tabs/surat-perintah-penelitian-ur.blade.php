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

    <h5 class="fw-bold text-center text-black">SURAT PERINTAH PENELTIAN</h5>


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
                                    <li class="mb-1 ps-1"> Bahwa dengan adanya Laporan Pelanggaran dugaan pelanggaran
                                        dibidang Cukai pada Undang-Undang Nomor ..............</li>
                                    <li class="mb-1 ps-1">Bahwa untuk maksud tersebut perlu dikeluarkan Surat Perintah
                                        Penelitian</li>
                                </ol>
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label class="col-md-3 col-sm-12 col-form-label fw-bold text-md-start">DASAR</label>
                            <div class="col-md-1 col-sm-1 text-center mt-1 d-none d-sm-block">:</div>
                            <div class="col-md-8 col-sm-11">
                                <ol class="ps-3 text-black" start="1" style="line-height: 1.5;">
                                    <li class="mb-1 ps-1">
                                        Undang-Undang Nomor 11 Tahun 1995 tentang Cukai sebagaimana telah beberapa kali
                                        diubah terakhir dengan Undang-Undang Nomor 7 Tahun 2021 tentang Harmonisasi
                                        Peraturan Perpajakan;
                                    </li>
                                    <li class="mb-1 ps-1">
                                        Peraturan Menteri Keuangan Nomor 183/PMK.01/2020 tentang Perubahan Atas
                                        Peraturan Menteri Keuangan Nomor 188/PMK.01/2016 tentang Organisasi dan Tata
                                        Kerja Instansi Vertikal Direktorat Jenderal Bea dan Cukai;
                                    </li>
                                    <li class="mb-1 ps-1">
                                        Peraturan Menteri Keuangan Nomor 237/PMK.04/2022 tentang Penelitian Dugaan
                                        Pelanggaran di Bidang Cukai;
                                    </li>
                                    <li class="mb-1 ps-1">
                                        Laporan Pelanggaran Nomor: LP-..../KPU.206/.... tanggal ....;
                                    </li>

                                </ol>
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label class="col-md-3 col-sm-12 col-form-label fw-bold text-md-start">Tersangka</label>
                            <div class="col-md-1 col-sm-1 text-center mt-1 d-none d-sm-block">:</div>
                            <div class="col-md-8 col-sm-11">
                                <div id="form-tersangka-penelitian">
                                    <div id="dynamic-form-tersangka-penelitian">
                                        @if (count($tersangkaData) > 0)
                                            @foreach ($tersangkaData as $index => $tersangka)
                                                @php
                                                    $perintahPenelitianTersangka = $penelitianTersangka[$index] ?? null;
                                                @endphp
                                                <div class="entry-tersangka text-black">
                                                    <hr>
                                                    <div class="row mb-3">
                                                        <div class="col-md-12">
                                                            <div class="input-group">
                                                                <span class="input-group-text">NO : SPLIT-</span>
                                                                <input type="text" class="form-control"
                                                                    name="no_split_tersangka[]"
                                                                    value="{{ old('no_split_tersangka.' . $index, $perintahPenelitianTersangka['no_split'] ?? '') }}">
                                                                <span class="input-group-text">/PPNS/</span>
                                                                <input type="date" class="form-control"
                                                                    name="tgl_split_tersangka[]"
                                                                    value="{{ old('tgl_split_tersangka.' . $index, $perintahPenelitianTersangka['tgl_split'] ?? '') }}">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row mb-3">
                                                        <div class="col-md-4 d-flex align-items-center">Nama Lengkap
                                                        </div>
                                                        <div class="col-md-1 text-center">:</div>
                                                        <div class="col-md-7">
                                                            <input type="text" name="penelitian_nama_tersangka[]"
                                                                class="form-control border-0 py-1"
                                                                value="{{ $tersangka['nama'] ?? '' }}" readonly>
                                                        </div>
                                                    </div>
                                                    <div class="row mb-3">
                                                        <div class="col-md-4 d-flex align-items-center">Tempat /Tanggal
                                                            Lahir</div>
                                                        <div class="col-md-1 text-center">:</div>
                                                        <div class="col-md-7">
                                                            <input type="text" class="form-control border-0 py-1"
                                                                value="{{ $tersangka['ttl'] ?? '' }}" readonly>
                                                        </div>
                                                    </div>
                                                    <!-- Rest of the form fields remain the same -->
                                                    <div class="row mb-3">
                                                        <div class="col-md-4 d-flex align-items-center">Agama</div>
                                                        <div class="col-md-1 text-center">:</div>
                                                        <div class="col-md-7">
                                                            <input type="text" class="form-control border-0 py-1"
                                                                value="{{ $tersangka['agama'] ?? '' }}" readonly>
                                                        </div>
                                                    </div>
                                                    <div class="row mb-3">
                                                        <div class="col-md-4 d-flex align-items-center">Jenis Kelamin
                                                        </div>
                                                        <div class="col-md-1 text-center">:</div>
                                                        <div class="col-md-7">
                                                            <input type="text" class="form-control border-0 py-1"
                                                                value="{{ $tersangka['jenis_kelamin'] ?? '' }}"
                                                                readonly>
                                                        </div>
                                                    </div>
                                                    <div class="row mb-3">
                                                        <div class="col-md-4 d-flex align-items-center">Kewarganegaraan
                                                        </div>
                                                        <div class="col-md-1 text-center">:</div>
                                                        <div class="col-md-7">
                                                            <input type="text" class="form-control border-0 py-1"
                                                                value="{{ $tersangka['kewarganegaraan'] ?? '' }}"
                                                                readonly>
                                                        </div>
                                                    </div>
                                                    <div class="row mb-3">
                                                        <div class="col-md-4 d-flex align-items-center">Pekerjaan Saat
                                                            Ini</div>
                                                        <div class="col-md-1 text-center">:</div>
                                                        <div class="col-md-7">
                                                            <input type="text" class="form-control border-0 py-1"
                                                                value="{{ $tersangka['pekerjaan'] ?? '' }}" readonly>
                                                        </div>
                                                    </div>
                                                    <div class="row mb-3">
                                                        <div class="col-md-4 d-flex align-items-center">Alamat Sesuai
                                                            Identitas</div>
                                                        <div class="col-md-1 text-center">:</div>
                                                        <div class="col-md-7">
                                                            <input type="text" class="form-control border-0 py-1"
                                                                value="{{ $tersangka['alamat'] ?? '' }}" readonly>
                                                        </div>
                                                    </div>
                                                    <div class="row mb-3">
                                                        <div class="col-md-4 d-flex align-items-center">Jenis/Nomor
                                                            Identitas</div>
                                                        <div class="col-md-1 text-center">:</div>
                                                        <div class="col-md-7">
                                                            <div class="input-group">
                                                                <input type="text" class="form-control py-1"
                                                                    placeholder="Jenis Identitas"
                                                                    value="{{ $tersangka['jenis_identitas'] ?? '' }}"
                                                                    readonly>
                                                                <input type="text" class="form-control py-1"
                                                                    placeholder="Nomor Identitas"
                                                                    value="{{ $tersangka['nomor_identitas'] ?? '' }}"
                                                                    readonly>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row mb-3">
                                                        <div class="col-md-4 d-flex align-items-center">Pendidikan
                                                            Terakhir</div>
                                                        <div class="col-md-1 text-center">:</div>
                                                        <div class="col-md-7">
                                                            <input type="text" class="form-control border-0 py-1"
                                                                value="{{ $tersangka['pendidikan'] ?? '' }}" readonly>
                                                        </div>
                                                    </div>
                                                    <div class="row mb-3">
                                                        <label class="col-md-4 d-flex align-items-center">Dugaan
                                                            Pelanggaran</label>
                                                        <div
                                                            class="col-md-1 text-center d-flex align-items-center justify-content-center">
                                                            :</div>
                                                        <div class="col-md-7">
                                                            <textarea name="dugaan_pelanggaran_tersangka[]" class="form-control" rows="5"
                                                                placeholder="Dugaan Pelanggaran Tersangka">{{ old('dugaan_pelanggaran_tersangka.0', $dugaan_pelanggaran_tersangka) }}</textarea>


                                                        </div>
                                                    </div>
                                                    <div class="row mb-3">
                                                        <div class="col-md-12">
                                                            @php
                                                                $selectedPejabat = json_decode(
                                                                    $perintahPenelitianTersangka[
                                                                        'pejabat_penelitian'
                                                                    ] ?? '[]',
                                                                    true,
                                                                );
                                                            @endphp
                                                            <div class="input-group flex-column">
                                                                <span
                                                                    class="input-group-text text-white bg-primary justify-content-center text-center w-100 rounded">
                                                                    D I P E R I N T A H K A N
                                                                </span>
                                                                <select class="form-select select2 w-100 mt-1"
                                                                    name="pejabat_penelitian[{{ $index }}][]"
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
                                                        <div class="col-md-4 text-black d-flex align-items-center">
                                                            Pejabat Penerbit Surat Perintah Penelitian
                                                        </div>
                                                        <div
                                                            class="col-md-1 text-center d-flex align-items-center justify-content-center">
                                                            :</div>
                                                        <div class="col-md-7">
                                                            <select class="form-control py-1 form-select select2"
                                                                name="pejabat_penerbit_surat_penelitian_tersangka[]">
                                                                <option value="" disabled
                                                                    {{ old('pejabat_penerbit_surat_penelitian_tersangka.' . $index, $perintahPenelitianTersangka['pejabat_penerbit'] ?? '') == '' ? 'selected' : '' }}>
                                                                    - Pilih -</option>

                                                                @foreach ($users as $user)
                                                                    <option value="{{ $user->id_admin }}"
                                                                        {{ old('pejabat_penerbit_surat_penelitian_tersangka.' . $index, $perintahPenelitianTersangka['pejabat_penerbit'] ?? '') == $user->id_admin ? 'selected' : '' }}>
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
                                                                name="status_plh_split[]">
                                                                <option value="" disabled
                                                                    {{ old('status_plh_split.' . $index, $perintahPenelitianTersangka['status_plh_split'] ?? '') == '' ? 'selected' : '' }}>
                                                                    - Pilih -
                                                                </option>
                                                                <option value="Plh."
                                                                    {{ old('status_plh_split.' . $index, $perintahPenelitianTersangka['status_plh_split'] ?? '') == 'Plh.' ? 'selected' : '' }}>
                                                                    Plh.
                                                                </option>
                                                                <option value=""
                                                                    {{ old('status_plh_split.' . $index, $perintahPenelitianTersangka['status_plh_split'] ?? '') == '' ? 'selected' : '' }}>
                                                                    Tidak Plh.
                                                                </option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="row mb-3">
                                                        <div class="col-md-4 text-black d-flex align-items-center">
                                                            Status Menyanggupi
                                                        </div>
                                                        <div
                                                            class="col-md-1 text-center d-flex align-items-center justify-content-center">
                                                            :
                                                        </div>
                                                        <div class="col-md-7">
                                                            <select class="form-control py-1 form-select select2"
                                                                name="status_sanggup_split[]">
                                                                <option value="" disabled
                                                                    {{ old('status_sanggup_split.' . $index, $perintahPenelitianTersangka['status_sanggup_split'] ?? '') == '' ? 'selected' : '' }}>
                                                                    - Pilih -
                                                                </option>
                                                                <option value="Menyanggupi UR"
                                                                    {{ old('status_sanggup_split.' . $index, $perintahPenelitianTersangka['status_sanggup_split'] ?? '') == 'Menyanggupi UR' ? 'selected' : '' }}>
                                                                    Menyanggupi UR
                                                                </option>
                                                                <option value="Tidak Menyanggupi UR"
                                                                    {{ old('status_sanggup_split.' . $index, $perintahPenelitianTersangka['status_sanggup_split'] ?? '') == 'Tidak Menyanggupi UR' ? 'selected' : '' }}>
                                                                    Tidak Menyanggupi UR
                                                                </option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <hr>
                                    </div>
                                    @endforeach
                                @else
                                    <div class="alert alert-info">
                                        Tidak ada data tersangka yang tersedia.
                                    </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label class="col-md-3 col-sm-12 col-form-label fw-bold text-md-start">U N T U K</label>
                        <div class="col-md-1 col-sm-1 text-center mt-1 d-none d-sm-block">:</div>
                        <div class="col-md-8 col-sm-11">
                            <ol class="ps-3 text-black" start="1" style="line-height: 1.5;">
                                <li class="mb-2 ps-1">
                                    Melakukan tugas penelitian dugaan pelanggaran di bidang Cukai pada Undang-Undang
                                    Nomor 39 Tahun 2007 tentang Perubahan Atas Undang-Undang Nomor 11 Tahun 1995
                                    tentang Cukai yang diduga dilakukan oleh:
                                    <br><br>
                                    <table class="table table-borderless table-sm w-auto">
                                        <tr>
                                            <td>Nama Lengkap</td>
                                            <td>:</td>
                                            <td><strong>..........</strong></td>
                                        </tr>
                                        <tr>
                                            <td>Tempat / Tanggal Lahir</td>
                                            <td>:</td>
                                            <td>..........</td>
                                        </tr>
                                        <tr>
                                            <td>Agama</td>
                                            <td>:</td>
                                            <td>..........</td>
                                        </tr>
                                        <tr>
                                            <td>Jenis kelamin</td>
                                            <td>:</td>
                                            <td>..........</td>
                                        </tr>
                                        <tr>
                                            <td>Kewarganegaraan</td>
                                            <td>:</td>
                                            <td>..........</td>
                                        </tr>
                                        <tr>
                                            <td>Pekerjaan saat ini</td>
                                            <td>:</td>
                                            <td>..........</td>
                                        </tr>
                                        <tr>
                                            <td>Alamat sesuai Identitas</td>
                                            <td>:</td>
                                            <td>..........
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Jenis/ Nomor Identitas</td>
                                            <td>:</td>
                                            <td>..........</td>
                                        </tr>
                                    </table>
                                </li>
                                <li class="mb-1 ps-1">
                                    Setelah melaksanakan Surat Perintah ini agar melaporkan kepada yang memberi
                                    perintah.
                                </li>
                            </ol>
                        </div>
                    </div>


                    <p class="text-black">Demikian Surat perintah ini dibuat untuk dilaksanakan dengan penuh
                        tanggung jawab</p>


                </div>
            </div>
        </div>
    </div>
</div>
</div>
