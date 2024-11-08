@extends('layouts.vertical', ['title' => 'Rekam Sbp'])

@section('css')
    @vite([
        'node_modules/datatables.net-bs5/css/dataTables.bootstrap5.min.css',
        'node_modules/datatables.net-buttons-bs5/css/buttons.bootstrap5.min.css',
        'node_modules/datatables.net-keytable-bs5/css/keyTable.bootstrap5.min.css',
        'node_modules/datatables.net-responsive-bs5/css/responsive.bootstrap5.min.css',
        'node_modules/datatables.net-select-bs5/css/select.bootstrap5.min.css'
     ])
@endsection

@section('content')
<div class="container-fluid">
    <!-- Card Container -->
    <div class="card mb-3 mt-4">
        <div class="card-header d-flex justify-content-between align-items-center">
    <h5 class="card-title mb-0">
        <i data-feather="book" style="width: 20px; height: 20px;" class="me-1"></i>
        Form Surat Bukti Penindakan (SBP)
    </h5>
    <!-- Tombol Kembali -->
    <button type="button" class="btn btn-danger btn-sm" onclick="window.history.back()">
        <i data-feather="log-out"></i> Kembali
    </button>
</div>

        
        <div class="card-body">
        <form action="{{ route('DaftarSbp.store') }}" method="POST">
          @csrf
            <div class="row">
                <!-- Left Column (Sections A and B) -->
                <div class="col-lg-6">
                    <!-- A. Informasi Header -->
                    <h6>A. Data Awal</h6>
                    <hr>
    <div class="row">

     
    <div class="col-md-6 mb-3">
            <label>No. Laporan Informasi</label>
            <input type="text" class="form-control bg-primary text-white" name="no_li" id="no_li" value="{{ $nomor_laporan }}" readonly>
        </div>

        <input type="hidden" name="id_sbp" id="id_sbp">

      <div class="col-md-6 mb-3">
            <label>Tgl. Laporan Informasi</label>
            <input type="text" class="form-control bg-primary text-white" value="{{ $laporan->tgl_li }}" readonly>
        </div>  


    <!-- No. SBP / Tgl. SBP -->
        <div class="col-md-6 mb-3">
            <label>No. SBP</label>
            <input type="text" class="form-control bg-primary text-white" name="no_sbp" id="no_sbp" value="{{ old('no_sbp', $no_ref->no_sbp) }}" readonly>
        </div>
        <div class="col-md-6 mb-3">
            <label>Tgl. SBP</label>
            <input type="date" class="form-control" placeholder="yyyy-mm-dd" id="tgl_sbp" name="tgl_sbp" required>
        </div>




        {{-- <!-- Jenis Barang -->
        <div class="col-md-6 mb-3">
            <label>Jenis Barang</label>
            <select class="form-control" id="jenis_barang" name="jenis_barang" required
            style="background-color:#4cc2af; color:white;">
             <option value="">- Pilih -</option>
            <option value="PENUMPANG">Barang Penumpang</option>
            <option value="CARGO">Barang Kiriman/Cargo</option>
            </select>
        </div> --}}
        
        {{-- <!-- Skema Penindakan -->
        <div class="col-md-6 mb-3">
            <label>Skema Penindakan</label>
            <select class="form-control"style="background-color:#4cc2af; color:white;"
            id="skema_penindakan" name="skema_penindakan" required>
                <option value="">- Pilih -</option>
                <option value="MANDIRI">Mandiri</option>
                <option value="BERSAMA">Bersama</option>
            </select>
        </div> --}}
        
        <!-- Nomor Surat Perintah -->
        <div class="col-md-6 mb-3">
            <label>Nomor Surat Perintah</label>
            <input type="text" class="form-control" placeholder="No. Surat (lengkap)" id="no_print" name="no_print" required>
        </div>
        
        <!-- Tgl. Surat Perintah -->
        <div class="col-md-6 mb-3">
            <label>Tgl. Surat Perintah</label>
            <input type="date" class="form-control" placeholder="yyyy-mm-dd" id="tanggal_print" name="tanggal_print" required>
        </div>

        <h6>B. Data Petugas</h6>
                    <hr>

        <div class="col-md-6 mb-3">
                            <label>Petugas I</label>
                            <select class="form-select select2"  name="id_petugas_1_sbp">
                                <option value="" disabled selected>- Pilih -</option>
                                @foreach ($users as $user)
                                    <option value="{{ $user->id_admin }}">{{ $user->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label>Petugas II</label>
                            <select class="form-select select2"  name="id_petugas_2_sbp">
                                <option value="" disabled selected>- Pilih -</option>
                                @foreach ($users as $user)
                                    <option value="{{ $user->id_admin }}">{{ $user->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        


            

                 <h6>C. Data Saksi</h6>
                    <hr>     

                    <div class="col-md-6 mb-3">
            <label>Nama Saksi</label>
            <input type="text" class="form-control" placeholder="Nama Saksi" name="nama_saksi" required>
        </div>  
        <div class="col-md-6 mb-3">
            <label>Alamat Saksi</label>
            <input type="text" class="form-control" placeholder="Alamat Saksi" name="alamat_saksi" required>
        </div>
        <div class="col-md-6 mb-3">
            <label>Pekerjaan Saksi</label>
            <input type="text" class="form-control" placeholder="Pekerjaan Saksi" name="pekerjaan_saksi" required>
        </div>
        <div class="col-md-6 mb-3">
            <label>No.Identitas Saksi</label>
            <input type="text" class="form-control" placeholder="No.Identitas Saksi" name="no_identitas_saksi" required>
        </div>
        <div class="col-md-6 mb-3">
            <label>Kontak Saksi (NO.HP)</label>
            <input type="text" class="form-control" placeholder="Kontak Saksi (NO.HP)" name="kontak_saksi" required>
        </div>

      

          


        
<!-- Perintah Yang Dilaksanakan (Switch Checkboxes) -->
{{-- <div class="col-md-12 mb-3">
    <label>Perintah Yang Dilaksanakan</label>
    <div class="row">
        <!-- Column 1 -->
        <div class="col-md-6">
            <div class="form-check form-switch mb-2">
                <input class="form-check-input" type="checkbox" role="switch" id="penghentian">
                <label class="form-check-label" for="penghentian">Penghentian</label>
            </div>
            <div class="form-check form-switch mb-2">
                <input class="form-check-input" type="checkbox" role="switch" id="pemeriksaan">
                <label class="form-check-label" for="pemeriksaan">Pemeriksaan</label>
            </div>
            <div class="form-check form-switch mb-2">
                <input class="form-check-input" type="checkbox" role="switch" id="pencegahan">
                <label class="form-check-label" for="pencegahan">Pencegahan</label>
            </div>
        </div>
        
        <!-- Column 2 -->
        <div class="col-md-6">
            <div class="form-check form-switch mb-2">
                <input class="form-check-input" type="checkbox" role="switch" id="penyegelan" >
                <label class="form-check-label" for="penyegelan">Penyegelan</label>
            </div>
            <div class="form-check form-switch mb-2">
                <input class="form-check-input" type="checkbox" role="switch" id="pembongkaran">
                <label class="form-check-label" for="pembongkaran">Penghentian pembongkaran</label>
            </div>
            <div class="form-check form-switch mb-2">
                <input class="form-check-input" type="checkbox" role="switch" id="bidangHKI">
                <label class="form-check-label" for="bidangHKI">Penegahan di bidang HKI</label>
            </div>
        </div>
    </div>
</div> --}}


        
        {{-- <!-- Nomor Identitas/ MAWB -->
        <div class="col-md-6 mb-3">
            <label>Nomor Identitas/ MAWB</label>
            <input type="text" class="form-control" placeholder="Nomor Identitas/ MAWB" id="no_passpor" name="no_passpor" required>
        </div>
        
        <!-- Nama Penumpang/ Pemilik -->
        <div class="col-md-6 mb-3">
            <label>Nama Penumpang/ Pemilik</label>
            <input type="text" class="form-control" placeholder="Nama Penumpang/ Pemilik">
        </div>
        
        <!-- Alamat E-mail/No. Hp -->
        <div class="col-md-6 mb-3">
            <label>Alamat E-mail/No. Hp</label>
            <input type="email" class="form-control" placeholder="Alamat Email">
        </div>
        <div class="col-md-6 mb-3">
            <label>&nbsp;</label>
            <input type="tel" class="form-control" placeholder="Nomor Hp">
        </div>
        
        <!-- Alamat -->
        <div class="col-md-12 mb-3">
            <label>Alamat</label>
            <textarea class="form-control" placeholder="Alamat"></textarea>
        </div>
        
        <!-- Pekerjaan -->
        <div class="col-md-12 mb-3">
            <label>Pekerjaan</label>
            <input type="text" class="form-control" placeholder="Pekerjaan">
        </div>

        <div class="col-md-12 mb-3">
            <label>Selaku</label>
            <select class="form-select">
                <option>- Pilih -</option>
                <!-- Add options here -->
            </select>
        </div>

        <div class="col-md-6 mb-3">
            <label>No. Flight</label>
            <input type="text" class="form-control" placeholder="259" readonly>
        </div>
        <div class="col-md-6 mb-3">
            <label>Nama Flight</label>
            <input type="text" class="form-control">
        </div> --}}
    </div>

                    <!-- D. Objek Penindakan -->
                    <h6>D. Objek Penindakan</h6>
                    <hr>
                    <div class="card-body">
                    <div class="accordion accordion-flush" id="accordionFlushExample">
    <div class="accordion-item">
        <h2 class="accordion-header">
            <button class="accordion-button btn bg-light fw-medium collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                A. Sarana Pengangkut
            </button>
        </h2>
       <div id="flush-collapseOne" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
    <div class="accordion-body bg-light">
        <div class="row mb-3">
            <label for="data_sarkut" class="col-sm-4 col-form-label">ISI DATA</label>
            <div class="col-sm-8">
                <select id="data_sarkut" name="data_sarkut" class="form-select"  onchange="toggleForm(this.value, 'flush-collapseOne')">
                    <option value="TIDAK">TIDAK</option>
                    <option value="YA">YA</option>
                </select>
            </div>
        </div>

        <!-- Form Inputs -->
        <div class="row mb-3 form-group">
            <label class="col-sm-4 col-form-label">Nama dan Jenis Sarkut</label>
            <div class="col-sm-8">
                <input type="text" class="form-control form-input" name="nama_jenis_sarkut" placeholder="Nama Dan Jenis Sarkut" disabled>
            </div>
        </div>
         <div class="row mb-3 form-group">
            <label class="col-sm-4 col-form-label">No. Voy/ Penerbangan/ Trayek</label>
           <div class="col-sm-8">
                <input type="text" class="form-control form-input" name="no_flight" placeholder="No. Voy/ Penerbangan/ Trayek" disabled>
            </div>
        </div>
        <div class="row mb-3 form-group">
            <label class="col-sm-4 col-form-label">Ukuran/ Kapasitas Muatan</label>
            <div class="col-sm-8">
                <input type="text" class="form-control form-input" name="kapasitas_muatan" placeholder="Ukuran/ Kapasitas Muatan" disabled>
            </div>
        </div>
         <div class="row mb-3 form-group">
            <label class="col-sm-4 col-form-label">Nahkoda/ Pilot/ Pengemudi</label>
           <div class="col-sm-8">
                <input type="text" class="form-control form-input" name="pengemudi" placeholder="Nahkoda/ Pilot/ Pengemudi" disabled>
            </div>
        </div>
        <div class="row mb-3 form-group">
            <label class="col-sm-4 col-form-label">No. Identitas Nahkoda/ Pilot/ Pengemudi</label>
           <div class="col-sm-8">
                <input type="text" class="form-control form-input" name="no_identitas_pengemudi" placeholder="No. Identitas Nahkoda/ Pilot/ Pengemudi" disabled>
            </div>
        </div>
        <div class="row mb-3 form-group">
            <label class="col-sm-4 col-form-label">Bendera</label>
            <div class="col-sm-8">
                <input type="text" class="form-control form-input" name="bendera" placeholder="Bendera" disabled>
            </div>
        </div>
        <div class="row mb-3 form-group">
            <label class="col-sm-4 col-form-label">Nomor Registrasi/ Polisi</label>
            <div class="col-sm-8">
                <input type="text" class="form-control form-input" name="no_polisi" placeholder="Nomor Registrasi/ Polisi" disabled>
            </div>
        </div>
    </div>
</div>  
    </div>
    <div class="accordion-item">
    <h2 class="accordion-header">
        <button class="accordion-button btn bg-light fw-medium collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseTwo" aria-expanded="false" aria-controls="flush-collapseTwo">
            B. Data Barang
        </button>
    </h2>
    <div id="flush-collapseTwo" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
        <div class="accordion-body bg-light">
            <div class="row mb-3">
                <label for="data_barang" class="col-sm-4 col-form-label">ISI DATA</label>
                <div class="col-sm-8">
                    <select id="data_barang" name="data_barang" class="form-select" onchange="toggleForm(this.value, 'flush-collapseTwo')"> <!-- Ubah ID di sini -->
                        <option value="TIDAK">TIDAK</option>
                        <option value="YA">YA</option>
                    </select>
                </div>
            </div>

            <!-- Form Inputs -->
            <div class="row mb-3 form-group">
                <label class="col-sm-4 col-form-label">Jumlah/Jenis/Ukuran/Nomor</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control form-input" placeholder="Jumlah/Jenis/Ukuran/Nomor" name="jumlah_jenis_barang" disabled>
                </div>
            </div>
            <div class="row mb-3 form-group">
                <label class="col-sm-4 col-form-label">Peti Kemasan / Kemasan</label>
                <div class="col-sm-8">
                            <select class="form-control form-input" name="id_kemasan" disabled>
                                <option value="" disabled selected>- Pilih -</option>
                                @foreach ($kemasans as $kemasan)
                                    <option value="{{ $kemasan->id_kemasan }}">{{ $kemasan->nama_kemasan }}</option>
                                @endforeach
                            </select>
                            </div>
            </div>
            {{-- <div class="row mb-3 form-group">
                <label class="col-sm-4 col-form-label">Jenis dan Jumlah Kemasan</label>
                <div class="col-sm-4">
                    <input type="text" class="form-control form-input" placeholder="-" disabled>
                </div>
                <div class="col-sm-4">
                    <input type="text" class="form-control form-input" placeholder="-" disabled>
                </div>
            </div> --}}
            <div class="row mb-3 form-group">
                <label class="col-sm-4 col-form-label">Jumlah Barang</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control form-input" placeholder="Jumlah Barang" name="jumlah_barang" disabled>
                </div>
            </div>
            <div class="row mb-3 form-group">
                <label class="col-sm-4 col-form-label">Jenis Barang</label>
                <div class="col-sm-8">
                    <textarea class="form-control form-input" placeholder="Jenis Barang" name="jenis_barang" rows="2" disabled></textarea>
                </div>
            </div>
            <div class="row mb-3 form-group">
                <label class="col-sm-4 col-form-label">Jenis/Nomor dan Tgl. Dokumen</label>
                <div class="col-sm-4">
                    <input type="text" class="form-control form-input" name="jenis_no_tgl_dok" placeholder="-" disabled>
                </div>
                <div class="col-sm-4">
                    <input type="date" class="form-control form-input" name="jenis_no_tgl_dok" placeholder="-" disabled>
                </div>
            </div>
            <div class="row mb-3 form-group">
                <label class="col-sm-4 col-form-label">Pemilik/Importir/Eksportir/Kuasa</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control form-input" name="pemilik" placeholder="Pemilik/Importir/Eksportir/ Kuasa" name="pemilik_importir" disabled>
                </div>
            </div>
            <div class="row mb-3 form-group">
                <label class="col-sm-4 col-form-label">No. Identitas Pemilik/Importir/Eksportir/Kuasa</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control form-input" name="no_identitas_pemilik" placeholder="No. Identitas Pemilik/Importir/Eksportir/Kuasa" name="no_identitas_pemilik_importir" disabled>
                </div>
            </div>
        </div>
    </div>
</div>

    <div class="accordion-item">
        <h2 class="accordion-header">
            <button class="accordion-button btn bg-light fw-medium collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseThree" aria-expanded="false" aria-controls="flush-collapseThree">
                C. Data Bangunan / Tempat
            </button>
        </h2>
        <div id="flush-collapseThree" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
            <div class="accordion-body bg-light">
            <div class="row mb-3">
                <label for="data_bangunan" class="col-sm-4 col-form-label">ISI DATA</label>
                <div class="col-sm-8">
                    <select id="data_bangunan" name="data_bangunan" class="form-select" onchange="toggleForm(this.value, 'flush-collapseThree')"> <!-- Ubah ID di sini -->
                        <option value="TIDAK">TIDAK</option>
                        <option value="YA">YA</option>
                    </select>
                </div>
            </div>

            {{-- form input --}}
            <div class="row mb-3 form-group">
                <label class="col-sm-4 col-form-label">Alamat Bangunan/Tempat</label>
                <div class="col-sm-8">
                    <textarea class="form-control form-input" placeholder="Alamat Bangunan/ Tempat" name="alamat_bangunan" rows="2" disabled></textarea>
                </div>
            </div>

            <div class="row mb-3 form-group">
                <label class="col-sm-4 col-form-label">No Reg Bangunan | NPPBKC | DLL</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control form-input" placeholder="No Reg Bangunan | NPPBKC | DLL" name="no_bangunan" disabled>
                </div>
            </div>

            <div class="row mb-3 form-group">
                <label class="col-sm-4 col-form-label">Nama Pemilik | Yang Menguasai</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control form-input" placeholder="Nama Pemilik | Yang Menguasai" name="nama_pemilik_bangunan" disabled>
                </div>
            </div>

              <div class="row mb-3 form-group">
                <label class="col-sm-4 col-form-label">No. Identitas Pemilik | Yang Menguasai</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control form-input" placeholder="No. Identitas Pemilik | Yang Menguasai" name="no_identitas_pemilik_bangunan" disabled>
                </div>
            </div>
            </div>
        </div>
    </div>
    {{-- <div class="accordion-item">
        <h2 class="accordion-header">
            <button class="accordion-button btn bg-light fw-medium collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseFour" aria-expanded="false" aria-controls="flush-collapseFour">
                D. Badan
            </button>
        </h2>
        <div id="flush-collapseFour" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
            <div class="accordion-body bg-light">
              <div class="row mb-3">
                <label for="badanSelect" class="col-sm-4 col-form-label">ISI DATA</label>
                <div class="col-sm-8">
                    <select id="badanSelect" class="form-select" onchange="toggleForm(this.value, 'flush-collapseFour')"> <!-- Ubah ID di sini -->
                        <option value="TIDAK">TIDAK</option>
                        <option value="YA">YA</option>
                    </select>
                </div>
            </div>

            
            <div class="row mb-3 form-group">
                <label class="col-sm-4 col-form-label">Nama</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control form-input" placeholder="-" disabled>
                </div>
            </div>

            <div class="row mb-3 form-group">
                <label class="col-sm-4 col-form-label">Tgl. Lahir | Kewarganegaraan</label>
                <div class="col-sm-4">
                    <input type="date" class="form-control form-input" placeholder="-" disabled>
                </div>
                <div class="col-sm-4">
                    <input type="text" class="form-control form-input" placeholder="-" disabled>
                </div>
            </div>

             <div class="row mb-3 form-group">
                <label class="col-sm-4 col-form-label">Alamat</label>
                <div class="col-sm-8">
                    <textarea class="form-control form-input" placeholder="-" rows="2" disabled></textarea>
                </div>
            </div>
            
            <div class="row mb-3 form-group">
                <label class="col-sm-4 col-form-label">Nomor Identitas</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control form-input" placeholder="-" disabled>
                </div>
            </div>

            </div>
        </div>
    </div> --}}

    </div>
</div>

                </div>

                <!-- Right Column (Sections C, D, and E) -->
                <div class="col-lg-6">
                    <!-- C. Informasi Pelapor dan Hasil Penindakan -->
                    <h6>E. Data Penindakan</h6>
                    <hr>
                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <label>Lokasi Penindakan</label>
                            <input type="text" class="form-control" name="lokasi_penindakan" placeholder="Lokasi Penindakan" >
                        </div>
                        <div class="col-md-12 mb-3">
                            <label>Uraian Penindakan</label>
                            <textarea  class="form-control" placeholder="Uraian Penindakan" name="uraian_penindakan" rows="2" ></textarea>
                        </div>

                     <div class="col-md-12 mb-3">
    <label>Alasan Penindakan</label>
    <select class="form-control  select2" name="id_penindakan" id="alasan_penindakan">
        <option value="" disabled selected>Pilih Alasan Penindakan</option>
        @foreach ($jenisPelanggaran->unique('alasan_penindakan') as $jenis)
            <option value="{{ $jenis->id_jenis_pelanggaran }}" data-jenis="{{ $jenis->jenis_pelanggaran }}">
                {{ $jenis->alasan_penindakan }}
            </option>
        @endforeach
    </select>
</div>

<div class="col-md-12 mb-3">
    <label>Jenis Pelanggaran</label>
    <textarea class="form-control form-input bg-primary text-white"  id="jenis_pelanggaran" disabled></textarea>
</div>


                        <div class="col-md-6 mb-3">
                        <label>Tanggal Mulai</label>
                        <input type="date" class="form-control" placeholder="Tanggal" name="tgl_mulai" />
                        </div>

                        <div class="col-md-6 mb-3">
                            <label>Jam Mulai</label>
                             <input type="time" class="form-control" placeholder="Jam" name="jam_mulai" />
                            </div>
                        
                   <div class="col-md-6 mb-3">
                        <label>Tanggal Berakhir</label>
                        <input type="date" class="form-control" placeholder="Tanggal" name="tgl_selesai" />
                        </div>
                        <div class="col-md-6 mb-3">
                            <label>Jam Berakhir</label>
                             <input type="time" class="form-control" placeholder="Jam" name="jam_selesai" />
                            </div>

                    <div class="col-md-12 mb-3">
                            <label>Hal Yang Terjadi</label>
                           <textarea class="form-control" placeholder="Hal Yang Terjadi" name="hal_yang_terjadi" rows="2"></textarea>
                        </div>
                        </div>

                   <div class="col-lg-12">
    <!-- D. Dokumen Pendukung -->
    <h6>F. Dokumen Pendukung</h6>
    <hr>
   <div class="card-body">
                    <div class="accordion accordion-flush" id="accordionFlushExample">

    <div class="accordion-item">
    <h2 class="accordion-header">
        <button class="accordion-button btn bg-light fw-medium collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapse1" aria-expanded="false" aria-controls="flush-collapse1">
            B. B.A Tegah
        </button>
    </h2>
    <div id="flush-collapse1" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
        <div class="accordion-body bg-light">
            <div class="row mb-3">
                <label for="ba_tegah" class="col-sm-4 col-form-label">ISI DATA</label>
                <div class="col-sm-8">
     <select id="ba_tegah" class="form-select" name="ba_tegah" onchange="toggleBA(this, 'no_ba_tegah', '{{ old('no_ba_tegah', $no_ref->no_ba_tegah) }}')">
            <option value="TIDAK">TIDAK</option>
            <option value="YA">YA</option>
        </select>
</div>
            </div>

            <!-- Form Inputs -->
            <div class="row mb-3 form-group">
    <label class="col-sm-4 col-form-label">No. BA Tegah</label>
    <div class="col-sm-8">
        <input type="text" class="form-control form-input bg-primary text-white" name="no_ba_tegah" id="no_ba_tegah" value="-" disabled>
    </div>
</div>

<div class="row mb-3 form-group">
    <label class="col-sm-4 col-form-label">BAST Barang</label>
    <div class="col-sm-8">
    <select id="bast_barang" class="form-select" name="bast_barang" onchange="toggleBA(this, 'no_ba_bast_barang', '{{ old('no_ba_bast_barang', $no_ref->no_ba_bast_barang) }}')">
            <option value="TIDAK">TIDAK</option>
            <option value="YA">YA</option>
        </select>
       </div>
</div>

<div class="row mb-3 form-group">
    <label class="col-sm-4 col-form-label">No. BA BAST Barang</label>
    <div class="col-sm-8">
        <input type="text" class="form-control form-input bg-primary text-white" name="no_ba_bast_barang" id="no_ba_bast_barang" value="-" disabled>
    </div>
</div>

<div class="row mb-3 form-group">
    <label class="col-sm-4 col-form-label">Menyerahkan Atas Nama</label>
    <div class="col-sm-8">
        <input type="text" class="form-control " name="menyerahkan_atas_nama" id="menyerahkan_atas_nama"  >
    </div>
</div>

<div class="row mb-3 form-group">
    <label class="col-sm-4 col-form-label">Nama Penerima</label>
    <div class="col-sm-8">
        <input type="text" class="form-control" name="nama_penerima" id="nama_penerima"  >
    </div>
</div>

<div class="row mb-3 form-group">
    <label class="col-sm-4 col-form-label">NIP/Identitas Penerima</label>
    <div class="col-sm-8">
        <input type="text" class="form-control" name="identitas_penerima" id="identitas_penerima">
    </div>
</div>

<div class="row mb-3 form-group">
    <label class="col-sm-4 col-form-label">Menerima Untuk/Atas Nama</label>
    <div class="col-sm-8">
        <input type="text" class="form-control" name="atas_nama" id="atas_nama">
    </div>
</div>

<div class="row mb-3 form-group">
    <label class="col-sm-4 col-form-label">Dalam Rangka</label>
    <div class="col-sm-8">
        <input type="text" class="form-control" name="dalam_rangka" id="dalam_rangka">
    </div>
</div>
           
        </div>
    </div>
</div>

    <div class="accordion-item">
    <h2 class="accordion-header">
        <button class="accordion-button btn bg-light fw-medium collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapse2" aria-expanded="false" aria-controls="flush-collapse2">
            B. B.A RIKSA
        </button>
    </h2>
    <div id="flush-collapse2" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
        <div class="accordion-body bg-light">
            <div class="row mb-3">
                <label for="ba_riksa" class="col-sm-4 col-form-label">ISI DATA</label>
                <div class="col-sm-8">
                    <select id="ba_riksa" class="form-select" name="ba_riksa" onchange="toggleBA(this, 'no_ba_riksa', '{{ old('no_ba_riksa', $no_ref->no_ba_riksa) }}')">
            <option value="TIDAK">TIDAK</option>
            <option value="YA">YA</option>
        </select>
                </div>
            </div>

            <div class="row mb-3 form-group">
    <label class="col-sm-4 col-form-label">No. BA Riksa</label>
    <div class="col-sm-8">
        <input type="text" class="form-control form-input bg-primary text-white" name="no_ba_riksa" id="no_ba_riksa" value="-" disabled>
    </div>
</div>

            <!-- Form Inputs -->
            <div class="row mb-3 form-group">
                <label class="col-sm-4 col-form-label">Lokasi Pemeriksaan</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control form-input" placeholder="Lokasi Pemeriksaan" name="lokasi_pemeriksaan" disabled>
                </div>
            </div>

            <div class="row mb-3 form-group">
                <label class="col-sm-4 col-form-label">Jumlah Lampiran Pemeriksaan</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control form-input" placeholder="Jumlah Lampiran Pemeriksaan" name="jumlah_lampiran_pemeriksaan" disabled>
                </div>
            </div>

            <div class="row mb-3 form-group">
                <label class="col-sm-4 col-form-label">Rincian Hasil Pemeriksaan</label>
                <div class="col-sm-8">
                    <textarea class="form-control form-input" placeholder="Rincian Hasil Pemeriksaan" row="2" name="rincian_hasil_pemeriksaan" disabled></textarea>
                </div>
            </div>
            
           
        </div>
    </div>
</div>

    <div class="accordion-item">
        <h2 class="accordion-header">
            <button class="accordion-button btn bg-light fw-medium collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapse3" aria-expanded="false" aria-controls="flush-collapse3">
                C. B.A SEGEL
            </button>
        </h2>
        <div id="flush-collapse3" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
            <div class="accordion-body bg-light">
            <div class="row mb-3">
                <label for="ba_segel" class="col-sm-4 col-form-label">ISI DATA</label>
                <div class="col-sm-8">
                    <select id="ba_segel" class="form-select" name="ba_segel" onchange="toggleBA(this, 'no_ba_segel', '{{ old('no_ba_segel', $no_ref->no_ba_segel) }}')">
            <option value="TIDAK">TIDAK</option>
            <option value="YA">YA</option>
        </select>
                </div>
            </div>

            <div class="row mb-3 form-group">
    <label class="col-sm-4 col-form-label">No. BA Segel</label>
    <div class="col-sm-8">
        <input type="text" class="form-control form-input bg-primary text-white" name="no_ba_segel" id="no_ba_segel" value="-" disabled>
    </div>
</div>

            {{-- form input --}}
            <div class="row mb-3 form-group">
                <label class="col-sm-4 col-form-label">Jenis Segel</label>
                <div class="col-sm-8">
                  <select class="form-control form-input" name="id_segel" disabled>
                                <option value=""> - Pilih -</option>
                                @foreach ($segels as $segel)
                                    <option value="{{ $segel->id_segel }}">{{ $segel->jenis_segel }}</option>
                                @endforeach
                            </select>
                            </div>
            </div>

            <div class="row mb-3 form-group">
                <label class="col-sm-4 col-form-label">Jumlah Segel</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control form-input" placeholder="Jumlah Segel" name="jumlah_segel" disabled>
                </div>
            </div>

            

              <div class="row mb-3 form-group">
                <label class="col-sm-4 col-form-label">Peletakan Segel</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control form-input" placeholder="Peletakan Segel" name="peletakan_segel" disabled>
                </div>
            </div>

            </div>
        </div>
    </div>
    <div class="accordion-item">
        <h2 class="accordion-header">
            <button class="accordion-button btn bg-light fw-medium collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseFour" aria-expanded="false" aria-controls="flush-collapseFour">
                D. Badan
            </button>
        </h2>
        <div id="flush-collapseFour" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
            <div class="accordion-body bg-light">
              <div class="row mb-3">
                <label for="badanSelect" class="col-sm-4 col-form-label">ISI DATA</label>
                <div class="col-sm-8">
                    <select id="badanSelect" class="form-select" onchange="toggleForm(this.value, 'flush-collapseFour')"> <!-- Ubah ID di sini -->
                        <option value="TIDAK">TIDAK</option>
                        <option value="YA">YA</option>
                    </select>
                </div>
            </div>

            
            <div class="row mb-3 form-group">
                <label class="col-sm-4 col-form-label">Nama</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control form-input" placeholder="-" disabled>
                </div>
            </div>

            <div class="row mb-3 form-group">
                <label class="col-sm-4 col-form-label">Tgl. Lahir | Kewarganegaraan</label>
                <div class="col-sm-4">
                    <input type="date" class="form-control form-input" placeholder="-" disabled>
                </div>
                <div class="col-sm-4">
                    <input type="text" class="form-control form-input" placeholder="-" disabled>
                </div>
            </div>

             <div class="row mb-3 form-group">
                <label class="col-sm-4 col-form-label">Alamat</label>
                <div class="col-sm-8">
                    <textarea class="form-control form-input" placeholder="-" rows="2" disabled></textarea>
                </div>
            </div>
            
            <div class="row mb-3 form-group">
                <label class="col-sm-4 col-form-label">Nomor Identitas</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control form-input" placeholder="-" disabled>
                </div>
            </div>

            </div>
        </div>
    </div>

    </div>
</div>

</div>


{{-- <!-- E. Penggunaan Penangguhan/Pelekatan Segel -->
<h6>E. Penggunaan/ Penempatan/ Peletakan Segel</h6>
<hr>
<div class="row">
    <div class="col-md-6 mb-3">
        <label>Jumlah/Jenis Segel</label>
        <input type="number" class="form-control" value="0">
    </div>
    <div class="col-md-6 mb-3">
        <label>&nbsp;</label>
        <input type="text" class="form-control" value="KERTAS" readonly>
    </div>
    <div class="col-md-12 mb-3">
        <label>Penempatan/Peletakan Segel</label>
        <select class="form-select">
            <option selected>- Pilih -</option>
        </select>
    </div>
</div> --}}

                    <div class="card-footer d-flex justify-content-end">
            <button type="submit" class="btn btn-success btn-sm me-2">
                <i data-feather="save"></i> Simpan Data SBP
            </button>
        </div>
                </div>
            </div>
        </div>

        
        
    </div>
    </form>
</div>

<script>
    feather.replace();
</script>

<script>
document.addEventListener("DOMContentLoaded", function() {
    $('#alasan_penindakan').select2();

    $('#alasan_penindakan').on('select2:select', function(e) {
        const selectedOption = e.params.data.element;  // Elemen option yang terpilih
        const jenisPelanggaran = selectedOption.getAttribute("data-jenis"); // Ambil data-jenis

        console.log("Jenis Pelanggaran Terpilih:", jenisPelanggaran);

        document.getElementById("jenis_pelanggaran").value = jenisPelanggaran || "Jenis pelanggaran tidak tersedia";
    });
});
</script>


<style>
    .form-input:disabled {
        background-color: #f0f0f0; 
        color: #888888; 
        cursor: not-allowed;
    }

    .form-input.enabled {
        background-color: #ffffff;
        color: #000000; 
    }

    
    .form-group.disabled label {
        color: #888888; 
    }
</style>

<script>
document.querySelector('select[name="jenis_segel"]').addEventListener('change', function() {
    const idSegel = this.value;
    if (idSegel) {
        fetch(`/getNomorSegel/${idSegel}`)
            .then(response => response.json())
            .then(data => {
                document.querySelector('input[name="nomor_segel"]').value = data.nomor_segel;
                document.querySelector('input[name="nomor_segel"]').disabled = false;
            })
            .catch(error => console.error('Error:', error));
    } else {
        document.querySelector('input[name="nomor_segel"]').value = '';
        document.querySelector('input[name="nomor_segel"]').disabled = true;
    }
});

</script>


<script>
    document.addEventListener("DOMContentLoaded", function() {
        let tahun = new Date().getFullYear();
        let random_number = Math.floor(Math.random() * 9000000) + 1000000;  // Hasil antara 1000 dan 9999
     let id_sbp = tahun.toString() + random_number;  // Pastikan tahun adalah string

       
        document.getElementById('id_sbp').value = id_sbp;
    });
</script>

    <script>
        function toggleForm(selectedValue, sectionId) {
        const section = document.getElementById(sectionId);
        const inputs = section.querySelectorAll('.form-input');

        if (selectedValue === 'YA') {
            inputs.forEach(input => {
                input.removeAttribute('disabled');
                input.classList.add('enabled'); 
                input.classList.remove('disabled'); 
            });
        } else {
            inputs.forEach(input => {
                input.setAttribute('disabled', 'disabled'); 
                input.classList.remove('enabled'); 
                input.classList.add('disabled'); 
            });
        }
    }

    </script>

{{-- <script>
    function toggleBA(select) {
        const inputField = document.getElementById('no_ba_tegah');
        const originalValue = "{{ old('no_ba_tegah', $no_ref->no_ba_tegah) }}"; // Value asli

        if (select.value === "YA") {
            inputField.value = originalValue;
            inputField.disabled = true;
        } else {
            inputField.value = "-";
            inputField.disabled = true;
        }
    }

    // Inisialisasi saat halaman dimuat
    document.addEventListener("DOMContentLoaded", function() {
        toggleBA(document.getElementById("ba_tegah"));
    });
</script> --}}

<script>
    function toggleBA(select, baInputId, originalValue) {
        const baInputField = document.getElementById(baInputId);
        const additionalInputs = document.querySelectorAll('.form-input:not([id^="no_ba"])'); // Select additional inputs, excluding no_ba_ fields

        // Set value for BA inputs (remain disabled)
        if (select.value === "YA") {
            baInputField.value = originalValue;
        } else {
            baInputField.value = "-";
        }

        // Toggle additional input fields based on dropdown selection
        {{-- additionalInputs.forEach(input => {
            if (select.value === "YA") {
                input.removeAttribute('disabled'); // Enable additional inputs
            } else {
                input.setAttribute('disabled'); // Disable additional inputs
            }
        }); --}}
    }

    // Initialize states on page load
    document.addEventListener("DOMContentLoaded", function() {
        toggleBA(document.getElementById("ba_tegah"), 'no_ba_tegah', '{{ old('no_ba_tegah', $no_ref->no_ba_tegah) }}');
        toggleBA(document.getElementById("ba_riksa"), 'no_ba_riksa', '{{ old('no_ba_riksa', $no_ref->no_ba_riksa) }}');
        toggleBA(document.getElementById("ba_segel"), 'no_ba_segel', '{{ old('no_ba_segel', $no_ref->no_ba_segel) }}');
        toggleBA(document.getElementById("bast_barang"), 'no_bast_barang', '{{ old('no_bast_barang', $no_ref->no_bast_barang) }}');
    });
</script>


 



@endsection

@section('script')
    @vite([ 'resources/js/pages/datatable.init.js'])
@endsection