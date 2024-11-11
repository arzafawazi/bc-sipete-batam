@extends('layouts.vertical', ['title' => 'Edit Pra-penindakan'])

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
    <form action="{{ route('pra-penindakan.update', ['pra_penindakan' => $praPenindakan->id]) }}" method="POST">
    @csrf
    @method('PUT')
    <!-- Card Container -->
    <div class="card mb-3 mt-4">
        <div class="card-header d-flex justify-content-between align-items-center">
    <h5 class="card-title mb-0">
        <i data-feather="book" style="width: 20px; height: 20px;" class="me-1"></i> Form Edit Laporan Informasi (LI)
    </h5>
    <a href="{{ url()->previous() }}" class="btn btn-danger btn-sm">
        <i data-feather="log-out" class="me-1"></i> Kembali
    </a>
</div>

        
        <div class="card-body">
            <div class="row">
                <!-- Left Column (Sections A and B) -->
                <div class="col-xl-12">
            <div class="card">

                <div class="card-body">
                    <ul class="nav nav-tabs nav-justified" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" data-bs-toggle="tab" href="#navtabs2-home" role="tab">
                                <span class="d-block d-sm-none"><i class="mdi mdi-home-account"></i></span>
                                <span class="d-none d-sm-block">Laporan Informasi (LA)</span>    
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="tab" href="#navtabs2-profile" role="tab">
                                <span class="d-block d-sm-none"><i class="mdi mdi-account-outline"></i></span>
                                <span class="d-none d-sm-block">LAP</span>    
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="tab" href="#navtabs2-messages" role="tab">
                                <span class="d-block d-sm-none"><i class="mdi mdi-email-outline"></i></span>
                                <span class="d-none d-sm-block">Nota Pengembalian Informasi</span>    
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="tab" href="#navtabs2-settings" role="tab">
                                <span class="d-block d-sm-none"><i class="mdi mdi-cog"></i></span>
                                <span class="d-none d-sm-block">Surat Perintah</span>    
                            </a>
                        </li>
                    </ul>

                    <div class="tab-content p-3 text-muted">
    <div class="tab-pane active" id="navtabs2-home" role="tabpanel">
        <div class="row">
            <!-- Left Column (Data Laporan Informasi) -->
            <div class="col-lg-6">
                <h6>A. Data Laporan Informasi (LI)</h6>
                <hr>
                <div class="row">
                    <!-- No. LI / Tgl. LI -->
                    <div class="col-md-6 mb-3">
                        <label>No. LI</label>
                        <input type="text" class="form-control bg-primary text-white" name="no_li" value="{{ old('no_li', $praPenindakan->no_li) }}" readonly>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label>Tgl. LI</label>
                        <input type="date" class="form-control" placeholder="yyyy-mm-dd" id="tgl_li" name="tgl_li" value="{{ old('tgl_li', $praPenindakan->tgl_li) }}" required>
                    </div>
                    <!-- Media Informasi / Isi Informasi / Catatan -->
                    <div class="col-md-12 mb-3">
                        <label>Media Informasi</label>
                        <input type="text" class="form-control" placeholder="Media Informasi" id="media_informasi" name="media_informasi" value="{{ old('media_informasi', $praPenindakan->media_informasi) }}" required>
                    </div>
                   <div class="col-md-12 mb-3">
                     <label>Isi Informasi</label>
                     <textarea class="form-control" rows="2" placeholder="Isi Informasi" id="isi_informasi" name="isi_informasi" required>{{ old('isi_informasi', $praPenindakan->isi_informasi) }}</textarea>
                 </div>
                 <div class="col-md-12 mb-3">
                     <label>Catatan</label>
                     <textarea class="form-control" rows="2" placeholder="Catatan" id="catatan" name="catatan" required>{{ old('catatan', $praPenindakan->catatan) }}</textarea>
                 </div>

                </div>
            </div>
            
            <!-- Right Column (Pejabat Selection) -->
            <div class="col-lg-6">
                <h6>B. Pilih Pejabat</h6>
                <hr>
                <!-- Select Pejabat 1 -->
                <div class="col-lg-12 mb-3">
                  <label for="id_pejabat_li_1">Pejabat 1</label>
                  <select class="form-control" id="id_pejabat_li_1" name="id_pejabat_li_1" required>
                      <option value="" disabled>- Pilih -</option>
                      @foreach ($users as $user)
                          <option value="{{ $user->id_admin }}" {{ (old('id_pejabat_li_1', $praPenindakan->id_pejabat_li_1) == $user->id_admin) ? 'selected' : '' }}>
                              {{ $user->name }}
                          </option>
                      @endforeach      
                  </select>
              </div>
                <!-- Select Pejabat 2 -->
                <div class="col-lg-12 mb-3">
                 <label for="id_pejabat_li_2">Pejabat 2</label>
                 <select class="form-control" id="id_pejabat_li_2" name="id_pejabat_li_2" required>
                     <option value="" disabled>- Pilih -</option>
                     @foreach ($users as $user)
                        <option value="{{ $user->id_admin }}" {{ (old('id_pejabat_li_2', $praPenindakan->id_pejabat_li_2) == $user->id_admin) ? 'selected' : '' }}>
                             {{ $user->name }}
                       </option>
                   @endforeach
              </select>
            </div>
                <!-- Select Pejabat 3 -->
              <div class="col-lg-12 mb-3">
                 <label for="id_pejabat_li_3">Pejabat 3</label>
                 <select class="form-control" id="id_pejabat_li_3" name="id_pejabat_li_3" required>
                     <option value="" disabled>- Pilih -</option>
                     @foreach ($users as $user)
                         <option value="{{ $user->id_admin }}" {{ (old('id_pejabat_li_3', $praPenindakan->id_pejabat_li_3) == $user->id_admin) ? 'selected' : '' }}>
                             {{ $user->name }}
                         </option>
                     @endforeach
                 </select>
             </div>

            </div>
        </div>
    </div>


                        <div class="tab-pane" id="navtabs2-profile" role="tabpanel">
                           <div class="row">
            <!-- Left Column (Data Laporan Informasi) -->
            <div class="col-lg-6">
                <h6>A. Data Laporan Lembar Analisis Pra Penindakan (LAP)</h6>
                <hr>
                <div class="row">
                    <!-- No. LI / Tgl. LI -->
                    <div class="row">
                    <div class="col-md-6 mb-3">
                        <label>No. Urut LAP</label>
                        <input type="text" class="form-control bg-primary text-white" name="no_urut_lap" value="{{ old('no_urut_lap', $praPenindakan->no_urut_lap) }}" readonly>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label>No. LAP</label>
                        <input type="text" class="form-control bg-primary text-white" name="no_lap" value="{{ old('no_lap', $praPenindakan->no_lap) }}" readonly>
                    </div>
                    </div>
                    <!-- Media Informasi / Isi Informasi / Catatan -->
                    <div class="col-md-12 mb-3">
                        <label>Sumber LAP</label>
                        <input type="text" class="form-control" placeholder="Sumber LAP" id="sumber_lap" name="sumber_lap" value="{{ old('sumber_lap', $praPenindakan->sumber_lap) }}" required>
                    </div>
                        <h6>B. Uraian Penindakan dan Kelayakan Operasional</h6>
                <hr>
                    <div class="card-body">
                    <div class="accordion accordion-flush" id="accordionFlushExample">
    <div class="accordion-item">
        <h2 class="accordion-header">
            <button class="accordion-button btn bg-light fw-medium collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                A. Pelaku
            </button>
        </h2>
       <div id="flush-collapseOne" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
    <div class="accordion-body bg-light">
        <div class="row mb-3">
            <label for="saranaSelect" class="col-sm-4 col-form-label">ISI DATA</label>
            <div class="col-sm-8">
                <select id="pelaku" class="form-select" name="pelaku" required>
    <option value="" disabled>- Pilih -</option>
    <option value="TIDAK" {{ (old('pelaku', $praPenindakan->pelaku) == 'TIDAK') ? 'selected' : '' }}>TIDAK</option>
    <option value="YA" {{ (old('pelaku', $praPenindakan->pelaku) == 'YA') ? 'selected' : '' }}>YA</option>
</select>
            </div>
        </div>

        <!-- Form Inputs -->
        <div class="row mb-3 form-group">
            <label class="col-sm-4 col-form-label">Keterangan Pelaku</label>
            <div class="col-sm-8">
              <textarea class="form-control form-input" name="keterangan_pelaku" placeholder="Keterangan pelaku" rows="2" required>{{ old('keterangan_pelaku', $praPenindakan->keterangan_pelaku) }}</textarea>
            </div>
        </div>
    </div>
</div>  
    </div>

    <div class="accordion-item">
    <h2 class="accordion-header">
        <button class="accordion-button btn bg-light fw-medium collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseTwo" aria-expanded="false" aria-controls="flush-collapseTwo">
            B. Dugaan Pelanggaran
        </button>
    </h2>
    <div id="flush-collapseTwo" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
        <div class="accordion-body bg-light">
            <div class="row mb-3">
                <label for="dugaan_pelanggaran" class="col-sm-4 col-form-label">ISI DATA</label>
                <div class="col-sm-8">
                    <select id="dugaan_pelanggaran" class="form-select" name="dugaan_pelanggaran"> <!-- Ubah ID di sini -->
                        <option value="TIDAK" {{ (old('dugaan_pelanggaran', $praPenindakan->dugaan_pelanggaran) == 'TIDAK') ? 'selected' : '' }}>TIDAK</option>
                        <option value="YA" {{ (old('dugaan_pelanggaran', $praPenindakan->dugaan_pelanggaran) == 'YA') ? 'selected' : '' }}>YA</option>
                    </select>
                </div>
            </div>

            <!-- Form Inputs -->
        <div class="row mb-3 form-group">
            <label class="col-sm-4 col-form-label">Keterangan Dugaan Pelanggaran</label>
            <div class="col-sm-8">
                <textarea class="form-control form-input" name="keterangan_dugaan_pelanggaran" placeholder="Keterangan Dugaan Pelanggaran" row="2" > {{ old('keterangan_dugaan_pelanggaran', $praPenindakan->keterangan_dugaan_pelanggaran) }}</textarea>
            </div>
        </div>
        </div>
    </div>
</div>

    <div class="accordion-item">
        <h2 class="accordion-header">
            <button class="accordion-button btn bg-light fw-medium collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseThree" aria-expanded="false" aria-controls="flush-collapseThree">
                C. Locus
            </button>
        </h2>
        <div id="flush-collapseThree" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
            <div class="accordion-body bg-light">
            <div class="row mb-3">
                <label for="locus" class="col-sm-4 col-form-label">ISI DATA</label>
                <div class="col-sm-8">
                    <select id="locus" class="form-select" name="locus"> <!-- Ubah ID di sini -->
                        <option value="TIDAK" {{ (old('locus', $praPenindakan->locus) == 'TIDAK') ? 'selected' : '' }}>TIDAK</option>
                        <option value="YA" {{ (old('locus', $praPenindakan->locus) == 'YA') ? 'selected' : '' }}>YA</option>
                    </select>
                </div>
            </div>

           <!-- Form Inputs -->
        <div class="row mb-3 form-group">
            <label class="col-sm-4 col-form-label">Keterangan Locus</label>
            <div class="col-sm-8">
                <textarea  class="form-control form-input" name="keterangan_locus" placeholder="Keterangan Locus" row="2" > {{ old('keterangan_locus', $praPenindakan->keterangan_locus) }}</textarea>
            </div>
        </div>
            </div>
        </div>
    </div>
    <div class="accordion-item">
        <h2 class="accordion-header">
            <button class="accordion-button btn bg-light fw-medium collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseFour" aria-expanded="false" aria-controls="flush-collapseFour">
                D. Tempus
            </button>
        </h2>
        <div id="flush-collapseFour" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
            <div class="accordion-body bg-light">
              <div class="row mb-3">
                <label for="tempus" class="col-sm-4 col-form-label">ISI DATA</label>
                <div class="col-sm-8">
                    <select id="tempus" class="form-select" name="tempus"> <!-- Ubah ID di sini -->
                        <option value="TIDAK" {{ (old('tempus', $praPenindakan->tempus) == 'TIDAK') ? 'selected' : '' }}>TIDAK</option>
                        <option value="YA" {{ (old('tempus', $praPenindakan->tempus) == 'YA') ? 'selected' : '' }}>YA</option>
                    </select>
                </div>
            </div>

            
            <div class="row mb-3 form-group">
            <label class="col-sm-4 col-form-label">Keterangan Tempus</label>
            <div class="col-sm-8">
                <textarea  class="form-control form-input" name="keterangan_tempus" placeholder="Keterangan Tempus" row="2" > {{ old('keterangan_tempus', $praPenindakan->keterangan_tempus) }}</textarea>
            </div>
        </div>
            </div>
        </div>
    </div>

    <div class="accordion-item">
        <h2 class="accordion-header">
            <button class="accordion-button btn bg-light fw-medium collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseFive" aria-expanded="false" aria-controls="flush-collapseFive">
                E. Prosedural
            </button>
        </h2>
        <div id="flush-collapseFive" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
            <div class="accordion-body bg-light">
              <div class="row mb-3">
                <label for="prosedural" class="col-sm-4 col-form-label">ISI DATA</label>
                <div class="col-sm-8">
                    <select id="prosedural" class="form-select" name="prosedural"> <!-- Ubah ID di sini -->
                        <option value="Bukan" {{ (old('prosedural', $praPenindakan->prosedural) == 'Bukan') ? 'selected' : '' }}>Bukan</option>
                        <option value="Kewenangan DJBC" {{ (old('prosedural', $praPenindakan->prosedural) == 'Kewenangan DJBC') ? 'selected' : '' }}>Kewenangan DJBC</option>
                    </select>
                </div>
            </div>

            
            <div class="row mb-3 form-group">
            <label class="col-sm-4 col-form-label">Keterangan Prosedural</label>
            <div class="col-sm-8">
                <textarea  class="form-control form-input" name="ket_prosedural" placeholder="Keterangan Prosedural" row="2" > {{ old('ket_prosedural', $praPenindakan->ket_prosedural) }}</textarea>
            </div>
        </div>
            </div>
        </div>
    </div>

    <div class="accordion-item">
        <h2 class="accordion-header">
            <button class="accordion-button btn bg-light fw-medium collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseSix" aria-expanded="false" aria-controls="flush-collapseSix">
                F. SDM
            </button>
        </h2>
        <div id="flush-collapseSix" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
            <div class="accordion-body bg-light">
              <div class="row mb-3">
                <label for="sdm" class="col-sm-4 col-form-label">ISI DATA</label>
                <div class="col-sm-8">
                    <select id="sdm" class="form-select" name="sdm"> <!-- Ubah ID di sini -->
                        <option value="TIDAK" {{ (old('sdm', $praPenindakan->sdm) == 'TIDAK') ? 'selected' : '' }}>TIDAK</option>
                        <option value="TERSEDIA" {{ (old('sdm', $praPenindakan->sdm) == 'TERSEDIA') ? 'selected' : '' }}>TERSEDIA</option>
                    </select>
                </div>
            </div>

            
            <div class="row mb-3 form-group">
            <label class="col-sm-4 col-form-label">Keterangan SDM</label>
            <div class="col-sm-8">
                <textarea class="form-control form-input" name="ket_sdm" placeholder="Keterangan SDM" row="2" > {{ old('ket_sdm', $praPenindakan->ket_sdm) }}</textarea>
            </div>
        </div>
            </div>
        </div>
    </div>

    <div class="accordion-item">
        <h2 class="accordion-header">
            <button class="accordion-button btn bg-light fw-medium collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseSeven" aria-expanded="false" aria-controls="flush-collapseSeven">
                G. Sarana Prasarana
            </button>
        </h2>
        <div id="flush-collapseSeven" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
            <div class="accordion-body bg-light">
              <div class="row mb-3">
                <label for="sarana_prasarana" class="col-sm-4 col-form-label">ISI DATA</label>
                <div class="col-sm-8">
                    <select id="sarana_prasarana" class="form-select" name="sarana_prasarana"> <!-- Ubah ID di sini -->
                        <option value="TIDAK" {{ (old('sarana_prasarana', $praPenindakan->sarana_prasarana) == 'TIDAK') ? 'selected' : '' }}>TIDAK</option>
                        <option value="TERSEDIA" {{ (old('sarana_prasarana', $praPenindakan->sarana_prasarana) == 'TERSEDIA') ? 'selected' : '' }}>TERSEDIA</option>
                    </select>
                </div>
            </div>

            
            <div class="row mb-3 form-group">
            <label class="col-sm-4 col-form-label">Keterangan Sarana Prasarana</label>
            <div class="col-sm-8">
                <textarea class="form-control form-input" name="ket_sarana_prasarana" placeholder="Keterangan Sarana Prasarana" row="2" > {{ old('ket_sarana_prasarana', $praPenindakan->ket_sarana_prasarana) }}</textarea>
            </div>
        </div>
            </div>
        </div>
    </div>

     <div class="accordion-item">
        <h2 class="accordion-header">
            <button class="accordion-button btn bg-light fw-medium collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseEight" aria-expanded="false" aria-controls="flush-collapseEight">
                H. Anggaran
            </button>
        </h2>
        <div id="flush-collapseEight" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
            <div class="accordion-body bg-light">
              <div class="row mb-3">
                <label for="anggaran" class="col-sm-4 col-form-label">ISI DATA</label>
                <div class="col-sm-8">
                    <select id="anggaran" class="form-select" name="anggaran"> <!-- Ubah ID di sini -->
                        <option value="TIDAK" {{ (old('anggaran', $praPenindakan->anggaran) == 'TIDAK') ? 'selected' : '' }}>TIDAK</option>
                        <option value="TERSEDIA" {{ (old('anggaran', $praPenindakan->anggaran) == 'TERSEDIA') ? 'selected' : '' }}>TERSEDIA</option>
                    </select>
                </div>
            </div>

            
            <div class="row mb-3 form-group">
            <label class="col-sm-4 col-form-label">Keterangan Anggaran</label>
            <div class="col-sm-8">
                <textarea type="text" class="form-control form-input" name="ket_anggaran" placeholder="Keterangan Anggaran" row="2" > {{ old('ket_anggaran', $praPenindakan->ket_anggaran) }}</textarea>
            </div>
        </div>
            </div>
        </div>
    </div>

     <div class="accordion-item">
        <h2 class="accordion-header">
            <button class="accordion-button btn bg-light fw-medium collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseNine" aria-expanded="false" aria-controls="flush-collapseNine">
                I. Layak Dilakukan Operasi Penindakan 
            </button>
        </h2>
        <div id="flush-collapseNine" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
            <div class="accordion-body bg-light">
              <div class="row mb-3">
                <label for="layak_dilakukan_operasi_penindakan" class="col-sm-4 col-form-label">ISI DATA</label>
                <div class="col-sm-8">
                    <select id="layak_dilakukan_operasi_penindakan" class="form-select" name="layak_penindakan"> <!-- Ubah ID di sini -->
                        <option value="TIDAK" {{ (old('layak_penindakan', $praPenindakan->layak_penindakan) == 'TIDAK') ? 'selected' : '' }}>TIDAK</option>
                        <option value="YA" {{ (old('layak_penindakan', $praPenindakan->layak_penindakan) == 'YA') ? 'selected' : '' }}>YA</option>
                    </select>
                </div>
            </div>

            <div class="row mb-3 form-group">
            <label class="col-sm-4 col-form-label">Skema Penindakan</label>
            <div class="col-sm-8">
            <select id="skema_penindakan" class="form-select" name="skem_layak_penindakan"> <!-- Ubah ID di sini -->
                        <option value="MANDIRI" {{ (old('skem_layak_penindakan', $praPenindakan->skem_layak_penindakan) == 'MANDIRI') ? 'selected' : '' }}>MANDIRI</option>
                        <option value="PELIMPAHAN" {{ (old('skem_layak_penindakan', $praPenindakan->skem_layak_penindakan) == 'PELIMPAHAN') ? 'selected' : '' }}>PELIMPAHAN</option>
                        <option value="BERSAMA" {{ (old('skem_layak_penindakan', $praPenindakan->skem_layak_penindakan) == 'BERSAMA') ? 'selected' : '' }}>BERSAMA</option>
                        <option value="DENGAN INSTANSI LAIN" {{ (old('skem_layak_penindakan', $praPenindakan->skem_layak_penindakan) == 'DENGAN INSTANSI LAIN') ? 'selected' : '' }}>DENGAN INSTANSI LAIN</option>
                        <option value="LAINNYA" {{ (old('skem_layak_penindakan', $praPenindakan->skem_layak_penindakan) == 'LAINNYA') ? 'selected' : '' }}>LAINNYA</option>
                    </select>
              
               </div>
        </div>

            
            <div class="row mb-3 form-group">
            <label class="col-sm-4 col-form-label">Keterangan Skema Penindakan </label>
            <div class="col-sm-8">
                <textarea class="form-control form-input" name="ket_layak_penindakan" placeholder="Keterangan Skema Penindakan " row="2" > {{ old('ket_layak_penindakan', $praPenindakan->ket_layak_penindakan) }}</textarea>
            </div>
        </div>

        

            </div>
        </div>
    </div>

    <div class="accordion-item">
        <h2 class="accordion-header">
            <button class="accordion-button btn bg-light fw-medium collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseTen" aria-expanded="false" aria-controls="flush-collapseTen">
                J. Layak Dilakukan Patroli
            </button>
        </h2>
        <div id="flush-collapseTen" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
            <div class="accordion-body bg-light">
              <div class="row mb-3">
                <label for="layak_dilakukan_patroli" class="col-sm-4 col-form-label">ISI DATA</label>
                <div class="col-sm-8">
                    <select id="layak_dilakukan_patroli" class="form-select" name="layak_patroli"> <!-- Ubah ID di sini -->
                        <option value="TIDAK" {{ (old('layak_patroli', $praPenindakan->layak_patroli) == 'TIDAK') ? 'selected' : '' }}>TIDAK</option>
                        <option value="YA" {{ (old('layak_patroli', $praPenindakan->layak_patroli) == 'YA') ? 'selected' : '' }}>YA</option>
                    </select>
                </div>
            </div>

            <div class="row mb-3 form-group">
            <label class="col-sm-4 col-form-label">Skema Penindakan Patroli</label>
            <div class="col-sm-8">
            <select id="skema_penindakan-patroli" class="form-select" name="skem_layak_patroli"> <!-- Ubah ID di sini -->
                        <option value="MANDIRI" {{ (old('skem_layak_patroli', $praPenindakan->skem_layak_patroli) == 'MANDIRI') ? 'selected' : '' }}>MANDIRI</option>
                        <option value="PELIMPAHAN" {{ (old('skem_layak_patroli', $praPenindakan->skem_layak_patroli) == 'PELIMPAHAN') ? 'selected' : '' }}>PELIMPAHAN</option>
                        <option value="BERSAMA" {{ (old('skem_layak_patroli', $praPenindakan->skem_layak_patroli) == 'BERSAMA') ? 'selected' : '' }}>BERSAMA</option>
                        <option value="DENGAN INSTANSI LAIN" {{ (old('skem_layak_patroli', $praPenindakan->skem_layak_patroli) == 'DENGAN INSTANSI LAIN') ? 'selected' : '' }}>DENGAN INSTANSI LAIN</option>
                        <option value="LAINNYA" {{ (old('skem_layak_patroli', $praPenindakan->skem_layak_patroli) == 'LAINNYA') ? 'selected' : '' }}>LAINNYA</option>
                    </select>
              
               </div>
        </div>

            
            <div class="row mb-3 form-group">
            <label class="col-sm-4 col-form-label">Keterangan Skema Patroli </label>
            <div class="col-sm-8">
                <textarea  class="form-control form-input" name="ket_layak_patroli" placeholder="Keterangan Skema Patroli" row="2" > {{ old('ket_layak_patroli', $praPenindakan->ket_layak_patroli) }}</textarea>
            </div>
        </div>

        

            </div>
        </div>
    </div>

    <div class="accordion-item">
        <h2 class="accordion-header">
            <button class="accordion-button btn bg-light fw-medium collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseEleven" aria-expanded="false" aria-controls="flush-collapseEleven">
                K. Tidak Layak Dilakukan Operasi Penindakan atau Patroli
            </button>
        </h2>
        <div id="flush-collapseEleven" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
            <div class="accordion-body bg-light">
              <div class="row mb-3">
                <label for="tidak_layak_dilakukan" class="col-sm-4 col-form-label">ISI DATA</label>
                <div class="col-sm-8">
                    <select id="tidak_layak_dilakukan" class="form-select" name="tidak_layak"> <!-- Ubah ID di sini -->
                        <option value="TIDAK" {{ (old('tidak_layak', $praPenindakan->tidak_layak) == 'TIDAK') ? 'selected' : '' }}>TIDAK</option>
                        <option value="YA" {{ (old('tidak_layak', $praPenindakan->tidak_layak) == 'YA') ? 'selected' : '' }}>YA</option>
                    </select>
                </div>
            </div>


            
            <div class="row mb-3 form-group">
            <label class="col-sm-4 col-form-label">Keterangan Tidak Layak Melakukan Operasi Penindakan atau Patroli </label>
            <div class="col-sm-8">
                <textarea class="form-control form-input" name="ket_tidak_layak" placeholder="Keterangan Tidak Layak" row="2" > {{ old('ket_tidak_layak', $praPenindakan->ket_tidak_layak) }}</textarea>
            </div>
        </div>

        

            </div>
        </div>
    </div>

    </div>
</div>
                </div>
                </div>
            
            
            <!-- Right Column (Pejabat Selection) -->
            <div class="col-lg-6">
            <div class="col-lg-12 mb-3">
                    <label for="kesimpulan">Kesimpulan</label>
                    <textarea class="form-control form-input" name="kesimpulan_lap" placeholder="Kesimpulan" row="2" > {{ old('kesimpulan_lap', $praPenindakan->kesimpulan_lap) }}</textarea>
                </div>
                <h6>B. Pilih Pejabat LAP</h6>
                <hr>
                <!-- Select Pejabat 1 -->
                <div class="col-lg-12 mb-3">
                    <label for="id_pejabat_lap_1">Pejabat LAP 1</label>
                                    <select class="form-control" id="id_pejabat_lap_1" name="id_pejabat_lap_1" required>
                    <option value="" disabled>- Pilih -</option>
                    @foreach ($users as $user)
                        <option value="{{ $user->id_admin }}" {{ (old('id_pejabat_lap_1', $praPenindakan->id_pejabat_lap_1) == $user->id_admin) ? 'selected' : '' }}>
                            {{ $user->name }}
                        </option>
                    @endforeach
                </select>

                </div>
                <!-- Select Pejabat 2 -->
               <div class="col-lg-12 mb-3">
                <label for="id_pejabat_lap_2">Pejabat LAP 2</label>
                <select class="form-control" id="id_pejabat_lap_2" name="id_pejabat_lap_2" required>
                   <option value="" selected disabled>- Pilih -</option>
                 @foreach ($users as $user)
                       <option value="{{ $user->id_admin }}" {{ (old('id_pejabat_lap_2', $praPenindakan->id_pejabat_lap_2) == $user->id_admin) ? 'selected' : '' }}>
                         {{ $user->name }}
                        </option>
                  @endforeach
             </select>
            </div>

                <!-- Select Pejabat 3 -->
            <div class="col-lg-12 mb-3">
                <label for="id_pejabat_lap_3">Pejabat LAP 3</label>
                <select class="form-control" id="id_pejabat_lap_3" name="id_pejabat_lap_3" required>
                    <option value="" selected disabled>- Pilih -</option>
                    @foreach ($users as $user)
                        <option value="{{ $user->id_admin }}" {{ (old('id_pejabat_lap_3', $praPenindakan->id_pejabat_lap_3) == $user->id_admin) ? 'selected' : '' }}>
                            {{ $user->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            </div>
        </div>
                        </div><!-- end tab pane -->

                        <div class="tab-pane" id="navtabs2-messages" role="tabpanel">
                           <div class="row">
            <!-- Left Column (Data Laporan Informasi) -->
            <div class="col-lg-6">
                <h6>A. Nota Pengembalian Informasi</h6>
                <hr>
                <div class="row">
                    <div class="col-md-12 mb-3">
                        <label>No. NPI</label>
                        <input type="text" class="form-control bg-primary text-white" name="no_npi" value="{{ old('no_npi', $praPenindakan->no_npi) }}" readonly>
                    </div>
                    <div class="col-md-12 mb-3">
                        <label>Sumber Informasi</label>
                        <input type="text" class="form-control" placeholder="Sumber Informasi" id="sumber_informasi_npi" name="sumber_npi" value="{{ old('sumber_npi', $praPenindakan->sumber_npi) }}" required>
                    </div>
                    <div class="col-md-12 mb-3">
                        <label>Unit Penebit Informasi</label>
                        <textarea class="form-control" rows="2" placeholder="Unit Penerbit Informasi" id="unit_penerbit_informasi" name="unit_penerbit_npi" required> {{ old('unit_penerbit_npi', $praPenindakan->unit_penerbit_npi) }}</textarea>
                    </div>
                    <div class="col-md-12 mb-3">
                        <label>Alasan</label>
                        <textarea class="form-control" rows="2" placeholder="Alasan Tidak Dapat Dilakukan Penindakan Lebih Lanjut" id="alasan_penindakan_npi" name="alasan_npi" required> {{ old('alasan_npi', $praPenindakan->alasan_npi) }}</textarea>
                    </div>
                </div>
            </div>
            
            <!-- Right Column (Pejabat Selection) -->
            <div class="col-lg-6">
                <h6>B. Pilih Pejabat</h6>
                <hr>
                <!-- Select Pejabat 1 -->
                <div class="col-lg-12 mb-3">
                    <label for="id_pejabat_npi">Pejabat</label>
                    <select class="form-control" id="id_pejabat_npi" name="id_pejabat_npi" required>
                      <option value="" selected disabled>- Pilih -</option>
                      @foreach ($users as $user)
                          <option value="{{ $user->id_admin }}" {{ (old('id_pejabat_npi', $praPenindakan->id_pejabat_npi) == $user->id_admin) ? 'selected' : '' }}>
                              {{ $user->name }}
                          </option>
                      @endforeach
                  </select>

                </div>
            </div>
        </div>
                        </div><!-- end tab pane -->


                        <div class="tab-pane" id="navtabs2-settings" role="tabpanel">
                            <div class="row">
            <!-- Left Column (Data Laporan Informasi) -->
            <div class="col-lg-6">
                <h6>A. Data Surat Perintah</h6>
                <hr>
                <div class="row">
                    <!-- No. LI / Tgl. LI -->
                    <div class="col-md-12 mb-3">
                        <label>No. Print</label>
                        <input type="text" class="form-control bg-primary text-white" name="no_print" value="{{ old('no_print', $praPenindakan->no_print) }}"  readonly>
                    </div>
                    <!-- Media Informasi / Isi Informasi / Catatan -->
                    <div class="col-md-12 mb-3">
                        <label>Pertimbangan Surat Perintah</label>
                        <textarea  class="form-control" row="2" placeholder="Pertimbangan Diterbitkannya Surat Perintah" id="pertimbangan_surat_perintah" name="ket_perundang" required> {{ old('ket_perundang', $praPenindakan->ket_perundang) }}</textarea>
                    </div>
                    <div class="col-md-12 mb-3">
                        <label>Dasar Hukum </label>
                        <textarea class="form-control" rows="2" placeholder="Dasar Hukum Yang Mendasari Diterbitkannya Surat Perintah" id="dasar_sp" name="dasar_sp" required> {{ old('dasar_sp', $praPenindakan->dasar_sp) }}</textarea>
                    </div>
                </div>
            </div>
            
            <!-- Right Column (Pejabat Selection) -->
            <div class="col-lg-6">
                <h6>B. Pilih Pejabat</h6>
                <hr>
                <!-- Select Pejabat 1 -->
                <div class="col-lg-12 mb-3">
                    <label for="id_pejabat_sp_1">Pejabat Yang Diberi Perintah</label>
                    <select class="form-control" id="id_pejabat_sp_1" name="id_pejabat_sp_1" required>
                      <option value="" selected disabled>- Pilih -</option>
                      @foreach ($users as $user)
                          <option value="{{ $user->id_admin }}" {{ (old('id_pejabat_sp_1', $praPenindakan->id_pejabat_sp_1) == $user->id_admin) ? 'selected' : '' }}>
                              {{ $user->name }}
                          </option>
                      @endforeach
                  </select>

                </div>
                <!-- Select Pejabat 2 -->
                <div class="col-md-12 mb-3">
                    <label for="perintah">Perintah</label>
                     <textarea  class="form-control" row="2" placeholder="Perintah Yang Diberikan Kepada Pejabat Bea dan Cukai" id="perintah_sp" name="perintah_sp" required> {{ old('perintah_sp', $praPenindakan->perintah_sp) }}</textarea>
                </div>
                <!-- Select Pejabat 3 -->
                <div class="col-md-12 mb-3">
                    <label for="wilayah">Wilayah</label>
                     <input type="text" class="form-control" value="{{ old('wilayah', $praPenindakan->wilayah) }}" name="wilayah">
                </div>

              
                <div class="row">
    <div class="col-md-6 mb-3">
        <label>Tanggal Mulai Berlaku</label>
        <input type="date" class="form-control" name="tanggal_mulai_print" value="{{ old('tanggal_mulai_print', $praPenindakan->tanggal_mulai_print) }}" required>
    </div>
    <div class="col-md-6 mb-3">
        <label>Tanggal Berakhir</label>
        <input type="date" class="form-control" id="tanggal_berakhir_print" value="{{ old('tanggal_berakhir_print', $praPenindakan->tanggal_berakhir_print) }}" name="tanggal_berakhir_print" required>
    </div>
</div>

                

               


                <div class="col-md-12 mb-3">
                    <label for="ketentuan_baju">Ketentuan</label>
                     <select class="form-control" id="ketentuan_baju" name="ketentuan_baju" required>
                       <option value="" selected disabled>- Pilih -</option>
                       <option value="Berpakaian PDH" {{ (old('ketentuan_baju', $praPenindakan->ketentuan_baju) == 'Berpakaian PDH') ? 'selected' : '' }}>Berpakaian PDH</option>
                       <option value="Berpakaian Non PDH" {{ (old('ketentuan_baju', $praPenindakan->ketentuan_baju) == 'Berpakaian Non PDH') ? 'selected' : '' }}>Berpakaian Non PDH</option>
                       <option value="Berpakaian PDL" {{ (old('ketentuan_baju', $praPenindakan->ketentuan_baju) == 'Berpakaian PDL') ? 'selected' : '' }}>Berpakaian PDL</option>
                   </select>

                    </div>


                    <div class="col-md-12 mb-3">
                    <label for="ketentuan_lain">Ketentuan Lain</label>
                       <textarea  class="form-control" row="2" placeholder="Ketentuan Lain" id="ketentuan_lain" name="ketentuan_lain" required> {{ old('ketentuan_lain', $praPenindakan->ketentuan_lain) }}</textarea>
                    </div>


                    <div class="col-md-12 mb-3">
                    <label for="id_pejabat_sp_2">Pejabat Yang Menandatangani</label>
                    <select class="form-control" id="id_pejabat_sp_2" name="id_pejabat_sp_2" required>
                    <option value="" selected disabled>- Pilih -</option>
                    @foreach ($users as $user)
                         <option value="{{ $user->id_admin }}" {{ (old('id_pejabat_sp_2', $praPenindakan->id_pejabat_sp_2) == $user->id_admin) ? 'selected' : '' }}>
                             {{ $user->name }}
                        </option>
                     @endforeach
                </select>

                </div>


            </div>
        </div>

<div class="card-footer d-flex justify-content-end">
            
            
    <button type="submit" class="btn btn-success btn-sm d-flex align-items-center">
        <i data-feather="save" class="me-1"></i> Simpan Data SBP
    </button>
        </div>

                        </div><!-- end tab pane -->



                    </div>
                </div>
            </div> <!-- end card-->
        </div> <!-- end col -->
            </div>
        </div>

        
        
    </div>
    </form>
</div>

<script>
    feather.replace();
</script>

{{-- <script>
    // Convert Laravel data into a JavaScript-friendly format
    const jenisPelanggaranData = @json($jenisPelanggaran->groupBy('alasan_penindakan'));

    document.getElementById('alasan_penindakan').addEventListener('change', function() {
        const selectedAlasan = this.value;
        const jenisPelanggaranInput = document.getElementById('jenis_pelanggaran');

        // Auto-fill the corresponding Jenis Pelanggaran
        if (jenisPelanggaranData[selectedAlasan]) {
            // Assuming each alasan_penindakan only has one jenis_pelanggaran
            const jenisPelanggaran = jenisPelanggaranData[selectedAlasan][0].jenis_pelanggaran;
            jenisPelanggaranInput.value = jenisPelanggaran;
        } else {
            // Clear the field if no matching jenis_pelanggaran is found
            jenisPelanggaranInput.value = '';
        }
    });
</script> --}}


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

 



@endsection

@section('script')
    @vite([ 'resources/js/pages/datatable.init.js'])
@endsection