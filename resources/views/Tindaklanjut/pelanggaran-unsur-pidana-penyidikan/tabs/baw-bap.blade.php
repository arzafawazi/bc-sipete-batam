@php
$saksiData = json_decode($unsurpenyidikan->data_saksi ?? '[]', true);
$tersangkaData = json_decode($unsurpenyidikan->data_tersangka ?? '[]', true);
$ahliData = json_decode($unsurpenyidikan->data_ahli ?? '[]', true);
@endphp
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

    <h5 class="fw-bold text-center">BAP DAN BAW
    </h5>


    <!-- Main Form -->
    <div class="card p-1">
        <div class="card-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="container-fluid px-0 px-sm-3">


                        <div class="mb-3 row">
                            <label class="col-md-3 col-sm-12 col-form-label fw-bold text-md-start">Upload Dokumen Berita Wawancara dan Berita Acara Pemeriksaan</label>
                            <div class="col-md-1 col-sm-1 text-center mt-1 d-none d-sm-block">:</div>
                            <div class="col-md-8 col-sm-11">

                                <div class="mb-3">
                                    <label class="fw-bold">Pilih Kategori:</label>
                                     <select class="form-select select2" id="kategoriBawBap">
                                        <option value="" selected disabled>Pilih</option>
                                        <option value="saksi">Saksi (PILIH BAGIAN INI UNTUK MENGISI DATA-DATA SAKSI)</option>
                                        <option value="tersangka">Tersangka (PILIH BAGIAN INI UNTUK MENGISI DATA-DATA TERSANGKA)</option>
                                        <option value="ahli">Ahli (PILIH BAGIAN INI UNTUK MENGISI DATA-DATA Ahli)</option>
                                    </select>
                                </div>

                                <div id="form-saksi-baw-bap" style="display: none;">
                                    <h5 class="fw-bold text-primary">Kumpulan Data Saksi</h5>
                                    <div id="dynamic-form-saksi-baw-bap">
                                        @foreach($saksiData as $index => $saksi)
                                        <div class="entry-saksi text-black">
                                            <hr>
                                            <div class="row mb-3">
                                                <div class="col-md-4 d-flex align-items-center">Nama Lengkap</div>
                                                <div class="col-md-1 text-center">:</div>
                                                <div class="col-md-7"><input type="text" name="baw_bap_nama_saksi[]" class="form-control border-0 py-1" value="{{ $saksi['nama'] ?? '' }}" readonly></div>
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
                                                    <div class="col-md-4 d-flex align-items-center">Upload BAW</div>
                                                    <div class="col-md-1 text-center">:</div>
                                                    <div class="col-md-7">
                                                        <input type="file" class="form-control" name="baw_saksi[]" accept=".pdf,.doc,.docx">
                                                        @php
                                                            $berkasBAW = null;
                                                            // Cari berkas berdasarkan nama
                                                            foreach($berkasBawBapSaksi as $berkas) {
                                                                if($berkas['nama'] == $saksi['nama'] && !empty($berkas['berkas_baw'])) {
                                                                    $berkasBAW = $berkas['berkas_baw'];
                                                                    break;
                                                                }
                                                            }
                                                        @endphp
                                                        
                                                        
                                                        @if($berkasBAW)
                                                            <div class="mt-2">
                                                                <a href="{{ asset('storage/'.$berkasBAW) }}" target="_blank" class="btn btn-sm btn-info">
                                                                    <i class="fas fa-eye"></i> Lihat Berkas BAW
                                                                </a>
                                                            </div>
                                                        @endif
                                                    </div>
                                                </div>

                                            <div class="row mb-3">
                                                <div class="col-md-4 d-flex align-items-center">Upload BAP</div>
                                                <div class="col-md-1 text-center">:</div>
                                                <div class="col-md-7">
                                                    <input type="file" class="form-control" name="bap_saksi[]" accept=".pdf,.doc,.docx">
                                                    @php
                                                        $berkasBAP = null;
                                                        // Cari berkas berdasarkan nama
                                                        foreach($berkasBawBapSaksi as $berkas) {
                                                            if($berkas['nama'] == $saksi['nama'] && !empty($berkas['berkas_bap'])) {
                                                                $berkasBAP = $berkas['berkas_bap'];
                                                                break;
                                                            }
                                                        }
                                                    @endphp
                                                    
                                                    @if($berkasBAP)
                                                        <div class="mt-2">
                                                            <a href="{{ asset('storage/'.$berkasBAP) }}" target="_blank" class="btn btn-sm btn-info">
                                                                <i class="fas fa-eye"></i> Lihat Berkas BAP
                                                            </a>
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>

                                            <hr>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>

                                    <div id="form-tersangka-baw-bap" style="display: none;">
                                        <h5 class="fw-bold text-primary">Kumpulan Data Tersangka</h5>
                                        <div id="dynamic-form-tersangka-baw-bap">
                                            @foreach($tersangkaData as $index => $tersangka)
                                            <div class="entry-tersangka text-black">
                                                <hr>
                                                <div class="row mb-3">
                                                    <div class="col-md-4 d-flex align-items-center">Nama Lengkap</div>
                                                    <div class="col-md-1 text-center">:</div>
                                                    <div class="col-md-7"><input type="text" name="baw_bap_nama_tersangka[]"  class="form-control border-0 py-1"  value="{{ $tersangka['nama'] ?? '' }}" readonly></div>
                                                </div>
                                                <div class="row mb-3">
                                                    <div class="col-md-4 d-flex align-items-center">Tempat /Tanggal Lahir</div>
                                                    <div class="col-md-1 text-center">:</div>
                                                    <div class="col-md-7"><input type="text" class="form-control border-0 py-1"  value="{{ $tersangka['ttl'] ?? '' }}" readonly></div>
                                                </div>
                                                <div class="row mb-3">
                                                    <div class="col-md-4 d-flex align-items-center">Agama</div>
                                                    <div class="col-md-1 text-center">:</div>
                                                    <div class="col-md-7"><input type="text" class="form-control border-0 py-1"  value="{{ $tersangka['agama'] ?? '' }}" readonly></div>
                                                </div>
                                                <div class="row mb-3">
                                                    <div class="col-md-4 d-flex align-items-center">Jenis Kelamin</div>
                                                    <div class="col-md-1 text-center">:</div>
                                                    <div class="col-md-7">
                                                        <input type="text" class="form-control border-0 py-1" value="{{ $tersangka['jenis_kelamin'] ?? '' }}" readonly>
                                                    </div>
                                                </div>
                                                <div class="row mb-3">
                                                    <div class="col-md-4 d-flex align-items-center">Kewarganegaraan</div>
                                                    <div class="col-md-1 text-center">:</div>
                                                    <div class="col-md-7">
                                                        <input type="text" class="form-control border-0 py-1"  value="{{ $tersangka['kewarganegaraan'] ?? '' }}" readonly>
                                                    </div>
                                                </div>
                                                <div class="row mb-3">
                                                    <div class="col-md-4 d-flex align-items-center">Pekerjaan Saat Ini</div>
                                                    <div class="col-md-1 text-center">:</div>
                                                    <div class="col-md-7"><input type="text" class="form-control border-0 py-1"  value="{{ $tersangka['pekerjaan'] ?? '' }}" readonly></div>
                                                </div>
                                                <div class="row mb-3">
                                                    <div class="col-md-4 d-flex align-items-center">Alamat Sesuai Identitas</div>
                                                    <div class="col-md-1 text-center">:</div>
                                                    <div class="col-md-7"><input type="text" class="form-control border-0 py-1"  value="{{ $tersangka['alamat'] ?? '' }}" readonly></div>
                                                </div>
                                                <div class="row mb-3">
                                                    <div class="col-md-4 d-flex align-items-center">Jenis/Nomor Identitas</div>
                                                    <div class="col-md-1 text-center">:</div>
                                                    <div class="col-md-7">
                                                        <div class="input-group">
                                                            <input type="text" class="form-control  py-1"  placeholder="Jenis Identitas" value="{{ $tersangka['jenis_identitas'] ?? '' }}" readonly>
                                                            <input type="text" class="form-control  py-1"  placeholder="Nomor Identitas" value="{{ $tersangka['nomor_identitas'] ?? '' }}" readonly>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row mb-3">
                                                    <div class="col-md-4 d-flex align-items-center">Pendidikan Terakhir</div>
                                                    <div class="col-md-1 text-center">:</div>
                                                    <div class="col-md-7"><input type="text" class="form-control border-0 py-1"  value="{{ $tersangka['pendidikan'] ?? '' }}" readonly></div>
                                                </div>

                                                <div class="row mb-3">
                                                    <div class="col-md-4 d-flex align-items-center">Upload BAW</div>
                                                    <div class="col-md-1 text-center">:</div>
                                                    <div class="col-md-7">
                                                        <input type="file" class="form-control" name="baw_tersangka[]" accept=".pdf,.doc,.docx">
                                                        @php
                                                            $berkasBAW = null;
                                                            // Cari berkas berdasarkan nama
                                                            foreach($berkasBawBapTersangka as $berkas) {
                                                                if($berkas['nama'] == $tersangka['nama'] && !empty($berkas['berkas_baw'])) {
                                                                    $berkasBAW = $berkas['berkas_baw'];
                                                                    break;
                                                                }
                                                            }
                                                        @endphp
                                                        
                                                        @if($berkasBAW)
                                                            <div class="mt-2">
                                                                <a href="{{ asset('storage/'.$berkasBAW) }}" target="_blank" class="btn btn-sm btn-info">
                                                                    <i class="fas fa-eye"></i> Lihat Berkas BAW
                                                                </a>
                                                            </div>
                                                        @endif
                                                    </div>
                                                </div>

                                                <div class="row mb-3">
                                                        <div class="col-md-4 d-flex align-items-center">Upload BAP</div>
                                                        <div class="col-md-1 text-center">:</div>
                                                        <div class="col-md-7">
                                                            <input type="file" class="form-control" name="bap_tersangka[]" accept=".pdf,.doc,.docx">
                                                            @php
                                                                $berkasBAP = null;
                                                                // Cari berkas berdasarkan nama
                                                                foreach($berkasBawBapTersangka as $berkas) {
                                                                    if($berkas['nama'] == $tersangka['nama'] && !empty($berkas['berkas_bap'])) {
                                                                        $berkasBAP = $berkas['berkas_bap'];
                                                                        break;
                                                                    }
                                                                }
                                                            @endphp
                                                            
                                                            @if($berkasBAP)
                                                                <div class="mt-2">
                                                                    <a href="{{ asset('storage/'.$berkasBAP) }}" target="_blank" class="btn btn-sm btn-info">
                                                                        <i class="fas fa-eye"></i> Lihat Berkas BAP
                                                                    </a>
                                                                </div>
                                                            @endif
                                                        </div>
                                                    </div>
                                                <hr>
                                            </div>
                                            @endforeach
                                        </div>
                                    </div>

                                    <div id="form-ahli-baw-bap" style="display: none;">
                                        <h5 class="fw-bold text-primary">Kumpulan Data Tersangka</h5>
                                        <div id="dynamic-form-ahli-baw-bap">
                                            @foreach($ahliData as $index => $ahli)
                                            <div class="entry-ahli text-black">
                                                <hr>
                                                <div class="row mb-3">
                                                    <div class="col-md-4 d-flex align-items-center">Nama Lengkap</div>
                                                    <div class="col-md-1 text-center">:</div>
                                                    <div class="col-md-7"><input type="text" name="baw_bap_nama_ahli[]"  class="form-control border-0 py-1"  value="{{ $ahli['nama'] ?? '' }}" readonly></div>
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
                                                    <div class="col-md-4 d-flex align-items-center">Pekerjaan Saat Ini</div>
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
                                                    <div class="col-md-4 d-flex align-items-center">Upload BAW</div>
                                                    <div class="col-md-1 text-center">:</div>
                                                    <div class="col-md-7">
                                                        <input type="file" class="form-control" name="baw_ahli[]" accept=".pdf,.doc,.docx">
                                                        @php
                                                            $berkasBAW = null;
                                                            // Cari berkas berdasarkan nama
                                                            foreach($berkasBawBapAhli as $berkas) {
                                                                if($berkas['nama'] == $ahli['nama'] && !empty($berkas['berkas_baw'])) {
                                                                    $berkasBAW = $berkas['berkas_baw'];
                                                                    break;
                                                                }
                                                            }
                                                        @endphp
                                                        
                                                        @if($berkasBAW)
                                                            <div class="mt-2">
                                                                <a href="{{ asset('storage/'.$berkasBAW) }}" target="_blank" class="btn btn-sm btn-info">
                                                                    <i class="fas fa-eye"></i> Lihat Berkas BAW
                                                                </a>
                                                            </div>
                                                        @endif
                                                    </div>
                                                </div>

                                                <div class="row mb-3">
                                                        <div class="col-md-4 d-flex align-items-center">Upload BAP</div>
                                                        <div class="col-md-1 text-center">:</div>
                                                        <div class="col-md-7">
                                                            <input type="file" class="form-control" name="bap_ahli[]" accept=".pdf,.doc,.docx">
                                                            @php
                                                                $berkasBAP = null;
                                                                // Cari berkas berdasarkan nama
                                                                foreach($berkasBawBapAhli as $berkas) {
                                                                    if($berkas['nama'] == $ahli['nama'] && !empty($berkas['berkas_bap'])) {
                                                                        $berkasBAP = $berkas['berkas_bap'];
                                                                        break;
                                                                    }
                                                                }
                                                            @endphp
                                                            
                                                            @if($berkasBAP)
                                                                <div class="mt-2">
                                                                    <a href="{{ asset('storage/'.$berkasBAP) }}" target="_blank" class="btn btn-sm btn-info">
                                                                        <i class="fas fa-eye"></i> Lihat Berkas BAP
                                                                    </a>
                                                                </div>
                                                            @endif
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
    if ($.fn.select2 && !$('#kategoriBawBap').hasClass("select2-hidden-accessible")) {
        $('#kategoriBawBap').select2();
    }

    $('#kategoriBawBap').off('select2:select').on('select2:select', function (e) {
        let selectedValue = $(this).val();

        $("#form-saksi-baw-bap, #form-tersangka-baw-bap, #form-ahli-baw-bap ").hide();

        if (selectedValue === "saksi") {
            $("#form-saksi-baw-bap").show();
        } else if (selectedValue === "tersangka") {
            $("#form-tersangka-baw-bap-saksi, #form-tersangka-baw-bap").show();
        } else if (selectedValue === "ahli") {
            $("#form-ahli-baw-bap-, #form-ahli-baw-bap").show();
        }
    });
});
</script>



