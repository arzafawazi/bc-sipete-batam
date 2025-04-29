 @extends('layouts.vertical', ['title' => 'Edit BAST Senjata Api'])

 @section('css')
     @vite(['node_modules/datatables.net-bs5/css/dataTables.bootstrap5.min.css', 'node_modules/datatables.net-buttons-bs5/css/buttons.bootstrap5.min.css', 'node_modules/datatables.net-keytable-bs5/css/keyTable.bootstrap5.min.css', 'node_modules/datatables.net-responsive-bs5/css/responsive.bootstrap5.min.css', 'node_modules/datatables.net-select-bs5/css/select.bootstrap5.min.css'])
 @endsection
 @section('content')
     <div class="container-fluid">
         <form action="{{ route('bast-senjata-api.update', ['bast_senjata_api' => $senjataapipemasukan->id]) }}"
             method="POST" enctype="multipart/form-data">
             @csrf
             @method('PUT')
             <div class="card mb-3 mt-4">
                 <div class="card-header d-flex justify-content-between align-items-center">
                     <h5 class="card-title mb-0">
                         <i data-feather="book" style="width: 20px; height: 20px;" class="me-1"></i>
                         Form Rekam Data BAST Senjata Api
                     </h5>
                     <a href="{{ route('bast-senjata-api.index') }}" class="btn btn-danger btn-sm">
                         <i data-feather="log-out"></i> Kembali
                     </a>
                 </div>

                 <div class="card-body">
                     <div class="row">
                         <div class="col-xl-12">
                             <div class="card">
                                 <div class="card-body">
                                     <div class="tabs-container" id="tabs-container">
                                         <div class="mb-3 position-relative">
                                             <input type="text" id="searchTab"
                                                 class="form-control ps-5 rounded-pill shadow-custom border-0"
                                                 placeholder="Cari Surat...........">
                                             <i data-feather="search" class="search-iconnnnnn"></i>
                                         </div>
                                         <ul class="nav nav-pills nav-justified flex-nowrap overflow-auto"
                                             style="white-space: nowrap;" role="tablist">
                                             <li class="nav-item-penyidikan">
                                                 <a class="nav-link active" id="navtabs2-bast-senjata-api-tab"
                                                     data-bs-toggle="tab" href="#navtabs2-bast-senjata-api" role="tab"
                                                     aria-controls="navtabs2-bast-senjata-api" aria-selected="true">
                                                     <span class="d-block d-sm-none">(BAST Senjata Api)</span>
                                                     <span class="d-none d-sm-block">BAST Senjata Api</span>
                                                 </a>
                                             </li>
                                         </ul>
                                     </div>

                                     <div class="tab-content p-3 text-muted">

                                         <div class="tab-content p-3 text-muted">
                                             <input type="hidden" id="id_bast_senjata_api"
                                                 value="{{ old('id_bast_senjata_api', $senjataapipemasukan->id_bast_senjata_api) }}">

                                             <div class="tab-pane active" id="navtabs2-bast-senjata-api" role="tabpanel">
                                                 <div class="container-fluid mt-4">
                                                     <!-- Header with Logo -->
                                                     <div class="row mb-4 align-items-center text-black">
                                                         <div class="col-md-2 col-sm-12 text-center mb-3 mb-md-0">
                                                             <img src="/images/logocop.png" alt="Logo" class="img-fluid"
                                                                 style="max-height:170px;">
                                                         </div>
                                                         <div class="col-md-10 col-sm-12 text-center">
                                                             <h5 class="mb-0">KEMENTERIAN KEUANGAN REPUBLIK INDONESIA</h5>
                                                             <p class="small mb-0">DIREKTORAT JENDERAL BEA DAN amunisi</p>
                                                             <p class="small mb-0">KANTOR PELAYANAN UTAMA BEA DAN amunisi
                                                                 TIPE B
                                                                 BATAM</p>
                                                             <p class="small mb-0">
                                                                 JALAN KUDA LAUT, BATU AMPAR, BATAM, KEPULAUAN RIAU 29432;
                                                                 TELEPON (0778) 458118, 458263; FAKSIMILE (0778) 458149;
                                                             </p>
                                                             <p class="small mb-0">
                                                                 LAMAN WWW.BCBATAM.BEAamunisi.GO.ID;
                                                                 PUSAT KONTAK LAYANAN 1500225;
                                                                 SUREL BCBPBATAM@CUSTOMS.GO.ID,
                                                                 KPBC.BATAM@KEMENKEU.GO.ID
                                                             </p>
                                                         </div>
                                                     </div>

                                                     <hr class="border border-dark border-2 bg-dark">

                                                     <h5 class="fw-bold text-black">"PRO JUSTITIA"</h5>

                                                     <h5 class="fw-bold text-center text-black"><u>BERITA ACARA PEMASUKAN
                                                             AMUNISI & SENJATA API DINAS

                                                         </u></h5>

                                                     <div class="mb-3 row align-items-center">
                                                         <div class="input-group flex-wrap">
                                                             <span class="input-group-text">NO : BA-</span>
                                                             <input type="text" class="form-control"
                                                                 value="{{ old('no_bast_senjata_api', $senjataapipemasukan->no_bast_senjata_api) }}"
                                                                 name="no_bast_senjata_api" readonly>
                                                             <span class="input-group-text">/KPU.02/BD.06/</span>
                                                             <input type="date" class="form-control"
                                                                 name="tgl_bast_senjata_api"
                                                                 value="{{ old('tgl_bast_senjata_api', $senjataapipemasukan->tgl_bast_senjata_api) }}">
                                                         </div>
                                                     </div>


                                                     <!-- Main Form -->
                                                     <div class="card p-1">
                                                         <div class="card-body">
                                                             <div class="row">
                                                                 <div class="col-lg-12">
                                                                     <div class="container-fluid px-0 px-sm-3">

                                                                         <p class="fw-bold">
                                                                         <div class="fw-bold text-center">
                                                                             <select
                                                                                 class="form-control form-select select2"
                                                                                 name="pejabat_pertama_bast_senjata_api">
                                                                                 <option value="" disabled
                                                                                     {{ old('pejabat_pertama_bast_senjata_api', $senjataapipemasukan->pejabat_pertama_bast_senjata_api) == '' ? 'selected' : '' }}>
                                                                                     - Pilih -
                                                                                 </option>
                                                                                 @foreach ($users as $user)
                                                                                     <option value="{{ $user->id_admin }}"
                                                                                         {{ old('pejabat_pertama_bast_senjata_api', $senjataapipemasukan->pejabat_pertama_bast_senjata_api) == $user->id_admin ? 'selected' : '' }}>
                                                                                         {{ $user->name }} |
                                                                                         {{ $user->jabatan }}
                                                                                     </option>
                                                                                 @endforeach
                                                                             </select>
                                                                         </div>

                                                                         <br>

                                                                         <div class="fw-bold text-center">
                                                                             <select
                                                                                 class="form-control form-select select2"
                                                                                 name="pejabat_kedua_bast_senjata_api">
                                                                                 <option value="" disabled
                                                                                     {{ old('pejabat_kedua_bast_senjata_api', $senjataapipemasukan->pejabat_kedua_bast_senjata_api) == '' ? 'selected' : '' }}>
                                                                                     - Pilih -
                                                                                 </option>
                                                                                 @foreach ($users as $user)
                                                                                     <option value="{{ $user->id_admin }}"
                                                                                         {{ old('pejabat_kedua_bast_senjata_api', $senjataapipemasukan->pejabat_kedua_bast_senjata_api) == $user->id_admin ? 'selected' : '' }}>
                                                                                         {{ $user->name }} |
                                                                                         {{ $user->jabatan }}
                                                                                     </option>
                                                                                 @endforeach
                                                                             </select>
                                                                         </div>


                                                                         <br>
                                                                         <p class="text-black">Bahwa <b>PIHAK KEDUA</b>
                                                                             telah
                                                                             menyerahkan dan mengembalikan</p>

                                                                         <div class="col-12 mt-5">
                                                                             <div class="card">
                                                                                 <div
                                                                                     class="card-body table-responsive shadow p-3 mb-5 bg-white rounded">
                                                                                     <button type="button"
                                                                                         class="btn btn-soft-info btn-icon btn-sm rounded-pill"
                                                                                         data-bs-toggle="modal"
                                                                                         data-bs-target=".bs-example-modal-lg">
                                                                                         <i data-feather="plus-circle"
                                                                                             class="icon-sm"></i> Tambah
                                                                                         Data
                                                                                     </button>
                                                                                     <table
                                                                                         class="table table-hover align-middle border-separate"
                                                                                         style="border-spacing: 0 8px;">
                                                                                         <thead>
                                                                                             <tr class="bg-light">
                                                                                                 <th class="text-center px-3 py-3"
                                                                                                     style="width: 5%">No
                                                                                                 </th>
                                                                                                 <th class="px-3 text-center py-3"
                                                                                                     style="width: 25%">
                                                                                                     Kategori BAST</th>
                                                                                                 <th class="px-3 text-center py-3"
                                                                                                     style="width: 35%">
                                                                                                     Senjata
                                                                                                     Api</th>
                                                                                                 <th class="px-3 text-center py-3"
                                                                                                     style="width: 15%">
                                                                                                     Jenis
                                                                                                     Amunisi</th>
                                                                                                 <th class="px-3 text-center py-3"
                                                                                                     style="width: 15%">
                                                                                                     kaliber_senjata
                                                                                                     Amunisi</th>
                                                                                                 <th class="px-3 text-center py-3"
                                                                                                     style="width: 15%">
                                                                                                     Jumlah
                                                                                                     Amunisi
                                                                                                 </th>
                                                                                                 <th class="text-center px-3 py-3"
                                                                                                     style="width: 20%">
                                                                                                     Opsi
                                                                                                 </th>
                                                                                             </tr>
                                                                                         </thead>
                                                                                         <tbody align="center"
                                                                                             id="tableBody">
                                                                                         </tbody>
                                                                                         <div class="modal fade bs-example-modal-lg"
                                                                                             tabindex="-1" role="dialog"
                                                                                             aria-labelledby="myLargeModalLabel"
                                                                                             aria-hidden="true">
                                                                                             <div
                                                                                                 class="modal-dialog modal-dialog-centered modal-lg">
                                                                                                 <div
                                                                                                     class="modal-content">
                                                                                                     <!-- Modal Header -->
                                                                                                     <div
                                                                                                         class="modal-header bg-primary text-white border-bottom-0">
                                                                                                         <i data-feather="package"
                                                                                                             class="icon-lg"></i>&nbsp;&nbsp;
                                                                                                         <h5 class="modal-title"
                                                                                                             id="exampleModalLabel">
                                                                                                             Tambah Data
                                                                                                         </h5>
                                                                                                         <button
                                                                                                             type="button"
                                                                                                             class="btn-close btn-close-white"
                                                                                                             data-bs-dismiss="modal"
                                                                                                             aria-label="Close"></button>
                                                                                                     </div>

                                                                                                     <!-- Modal Body -->
                                                                                                     <div class="modal-body p-4"
                                                                                                         style="max-height: 65vh; overflow-y: auto;">
                                                                                                         <form>
                                                                                                             <!-- Always visible fields -->
                                                                                                             <div
                                                                                                                 class="row mb-4">
                                                                                                                 <div
                                                                                                                     class="col-md-6">
                                                                                                                     <label
                                                                                                                         for="kategori-bast"
                                                                                                                         class="form-label fw-bold">Pilih</label>
                                                                                                                     <select
                                                                                                                         class="form-select form-input select2"
                                                                                                                         id="kategori-bast"
                                                                                                                         name="kategori_bast">
                                                                                                                         <option
                                                                                                                             value="">
                                                                                                                             --
                                                                                                                             Pilih
                                                                                                                             Data
                                                                                                                             --
                                                                                                                         </option>
                                                                                                                         <option
                                                                                                                             value="senjata">
                                                                                                                             Senjata
                                                                                                                         </option>
                                                                                                                         <option
                                                                                                                             value="amunisi">
                                                                                                                             Amunisi
                                                                                                                         </option>
                                                                                                                     </select>
                                                                                                                 </div>
                                                                                                             </div>


                                                                                                             <!-- senjata Fields -->
                                                                                                             <div id="senjata-fields"
                                                                                                                 class="d-none">
                                                                                                                 <h6><b>Data
                                                                                                                         Senjata</b>
                                                                                                                 </h6>
                                                                                                                 <hr>
                                                                                                                 <div
                                                                                                                     class="mb-3">
                                                                                                                     <label
                                                                                                                         class="form-label fw-bold">Pilih
                                                                                                                         Senjata
                                                                                                                         Api</label>
                                                                                                                     <select
                                                                                                                         class="form-select select2"
                                                                                                                         name="senjata_api"
                                                                                                                         id="senjata_api"
                                                                                                                         placeholder="Pilih Senjata">
                                                                                                                         <option
                                                                                                                             value=""
                                                                                                                             selected
                                                                                                                             disabled>
                                                                                                                             -
                                                                                                                             Pilih
                                                                                                                             Senjata
                                                                                                                             -
                                                                                                                         </option>
                                                                                                                         @foreach ($senjataapi as $senjata)
                                                                                                                             <option
                                                                                                                                 value="{{ $senjata->jenis_senjata }} | {{ $senjata->nomor_senjata }} | {{ $senjata->kaliber_senjata }} | {{ $senjata->pemilik }}">
                                                                                                                                 {{ $senjata->jenis_senjata }}
                                                                                                                                 |
                                                                                                                                 {{ $senjata->nomor_senjata }}
                                                                                                                                 |
                                                                                                                                 {{ $senjata->kaliber_senjata }}
                                                                                                                                 |
                                                                                                                                 {{ $senjata->pemilik }}
                                                                                                                             </option>
                                                                                                                         @endforeach
                                                                                                                     </select>
                                                                                                                 </div>
                                                                                                             </div>

                                                                                                             <!-- amunisi Fields -->
                                                                                                             <div id="amunisi-fields"
                                                                                                                 class="d-none">
                                                                                                                 <h6><b>Data
                                                                                                                         Amunisi</b>
                                                                                                                 </h6>
                                                                                                                 <hr>
                                                                                                                 <div
                                                                                                                     class="row">
                                                                                                                     <div
                                                                                                                         class="col-md-12 mb-3">
                                                                                                                         <label
                                                                                                                             for="jenis-amunisi"
                                                                                                                             class="form-label fw-bold">Jenis
                                                                                                                             Amunisi</label>
                                                                                                                         <input
                                                                                                                             type="text"
                                                                                                                             name="jenis_amunisi"
                                                                                                                             class="form-control"
                                                                                                                             id="jenis-amunisi"
                                                                                                                             placeholder="Jenis Amunisi">
                                                                                                                     </div>
                                                                                                                 </div>
                                                                                                                 <div
                                                                                                                     class="col-md-12 mb-3">
                                                                                                                     <label
                                                                                                                         class="form-label fw-bold">Kaliber
                                                                                                                         Amunisi</label>
                                                                                                                     <input
                                                                                                                         type="text"
                                                                                                                         class="form-control"
                                                                                                                         name="kaliber_amunisi"
                                                                                                                         id="kaliber-amunisi"
                                                                                                                         placeholder="Kaliber amunisi">
                                                                                                                 </div>
                                                                                                                 <div
                                                                                                                     class="col-md-12 mb-3">
                                                                                                                     <label
                                                                                                                         for="jumlah-amunisi"
                                                                                                                         class="form-label fw-bold">Jumlah
                                                                                                                         Amunisi</label>
                                                                                                                     <input
                                                                                                                         type="text"
                                                                                                                         class="form-control"
                                                                                                                         name="jumlah_amunisi"
                                                                                                                         id="jumlah-amunisi"
                                                                                                                         placeholder="Jumlah Amunisi">
                                                                                                                 </div>
                                                                                                             </div>

                                                                                                         </form>
                                                                                                     </div>

                                                                                                     <!-- Modal Footer -->
                                                                                                     <div
                                                                                                         class="modal-footer border-top-0 bg-light">
                                                                                                         <button
                                                                                                             type="button"
                                                                                                             class="btn btn-outline-danger"
                                                                                                             data-bs-dismiss="modal">Tutup</button>
                                                                                                         <button
                                                                                                             type="button"
                                                                                                             class="btn btn-outline-primary"
                                                                                                             id="formBast">
                                                                                                             <span
                                                                                                                 id="buttonText">Simpan</span>
                                                                                                             <span
                                                                                                                 id="buttonSpinner"
                                                                                                                 class="spinner-border spinner-border-sm d-none"
                                                                                                                 role="status"
                                                                                                                 aria-hidden="true"></span>
                                                                                                         </button>

                                                                                                     </div>
                                                                                                 </div>
                                                                                             </div>
                                                                                         </div>
                                                                                     </table>
                                                                                 </div>
                                                                             </div>
                                                                         </div>

                                                                         <div class="modal fade" id="editBastModal"
                                                                             tabindex="-1" role="dialog"
                                                                             aria-labelledby="editBastModalLabel"
                                                                             aria-hidden="true">
                                                                             <div
                                                                                 class="modal-dialog modal-dialog-centered modal-lg">
                                                                                 <div class="modal-content">
                                                                                     <!-- Modal Header -->
                                                                                     <div
                                                                                         class="modal-header bg-primary text-white border-bottom-0">
                                                                                         <i data-feather="package"
                                                                                             class="icon-lg"></i>&nbsp;&nbsp;
                                                                                         <h5 class="modal-title"
                                                                                             id="editBastModalLabel">Edit
                                                                                             Barang</h5>
                                                                                         <button type="button"
                                                                                             class="btn-close btn-close-white"
                                                                                             data-bs-dismiss="modal"
                                                                                             aria-label="Close"></button>
                                                                                     </div>

                                                                                     <!-- Modal Body -->
                                                                                     <div class="modal-body p-4"
                                                                                         style="max-height: 65vh; overflow-y: auto;">
                                                                                         <form id="editBastForm">
                                                                                             <input type="hidden"
                                                                                                 id="bast-id">
                                                                                             <!-- Always visible fields -->
                                                                                             <div class="row mb-4">
                                                                                                 <div class="col-md-6">
                                                                                                     <label
                                                                                                         for="edit-kategori-bast"
                                                                                                         class="form-label fw-bold">Pilih</label>
                                                                                                     <select
                                                                                                         class="form-select form-input select2"
                                                                                                         id="edit-kategori-bast"
                                                                                                         name="kategori_bast">
                                                                                                         <option
                                                                                                             value="">
                                                                                                             --
                                                                                                             Pilih
                                                                                                             Data
                                                                                                             --
                                                                                                         </option>
                                                                                                         <option
                                                                                                             value="senjata">
                                                                                                             Senjata
                                                                                                         </option>
                                                                                                         <option
                                                                                                             value="amunisi">
                                                                                                             Amunisi
                                                                                                         </option>
                                                                                                     </select>
                                                                                                 </div>
                                                                                             </div>


                                                                                             <!-- senjata Fields -->
                                                                                             <div id="edit-senjata-fields"
                                                                                                 class="d-none">
                                                                                                 <h6><b>Data
                                                                                                         Senjata</b>
                                                                                                 </h6>
                                                                                                 <hr>
                                                                                                 <div class="mb-3">
                                                                                                     <label
                                                                                                         class="form-label fw-bold">Pilih
                                                                                                         Senjata Api</label>
                                                                                                     <select
                                                                                                         class="form-select select2"
                                                                                                         name="senjata_api"
                                                                                                         id="edit_senjata_api"
                                                                                                         placeholder="Pilih Senjata Api">
                                                                                                         <option
                                                                                                             value=""
                                                                                                             selected
                                                                                                             disabled>-
                                                                                                             Pilih Senjata
                                                                                                             Api -
                                                                                                         </option>
                                                                                                         @foreach ($senjataapiedit as $item)
                                                                                                             <option
                                                                                                                 value="{{ $item->jenis_senjata }} | {{ $item->nomor_senjata }} | {{ $item->kaliber_senjata }} | {{ $item->pemilik }}">
                                                                                                                 {{ $item->jenis_senjata }}
                                                                                                                 |
                                                                                                                 {{ $item->nomor_senjata }}
                                                                                                                 |
                                                                                                                 {{ $item->kaliber_senjata }}
                                                                                                                 |
                                                                                                                 {{ $item->pemilik }}
                                                                                                             </option>
                                                                                                         @endforeach
                                                                                                     </select>
                                                                                                 </div>
                                                                                             </div>

                                                                                             <!-- amunisi Fields -->
                                                                                             <div id="edit-amunisi-fields"
                                                                                                 class="d-none">
                                                                                                 <h6><b>Data
                                                                                                         Amunisi</b>
                                                                                                 </h6>
                                                                                                 <hr>
                                                                                                 <div class="row">
                                                                                                     <div
                                                                                                         class="col-md-12 mb-3">
                                                                                                         <label
                                                                                                             for="edit-jenis-amunisi"
                                                                                                             class="form-label fw-bold">Jenis
                                                                                                             Amunisi</label>
                                                                                                         <input
                                                                                                             type="text"
                                                                                                             name="jenis_amunisi"
                                                                                                             class="form-control"
                                                                                                             id="edit-jenis-amunisi"
                                                                                                             placeholder="Jenis Amunisi">
                                                                                                     </div>
                                                                                                 </div>
                                                                                                 <div
                                                                                                     class="col-md-12 mb-3">
                                                                                                     <label
                                                                                                         class="form-label fw-bold">Kaliber
                                                                                                         Amunisi</label>
                                                                                                     <input type="text"
                                                                                                         class="form-control"
                                                                                                         name="kaliber_amunisi"
                                                                                                         id="edit-kaliber-amunisi"
                                                                                                         placeholder="Kaliber amunisi">
                                                                                                 </div>
                                                                                                 <div
                                                                                                     class="col-md-12 mb-3">
                                                                                                     <label
                                                                                                         for="edit-jumlah-amunisi"
                                                                                                         class="form-label fw-bold">Jumlah
                                                                                                         Amunisi</label>
                                                                                                     <input type="text"
                                                                                                         class="form-control"
                                                                                                         name="jumlah_amunisi"
                                                                                                         id="edit-jumlah-amunisi"
                                                                                                         placeholder="Jumlah Amunisi">
                                                                                                 </div>
                                                                                             </div>

                                                                                         </form>
                                                                                     </div>

                                                                                     <!-- Modal Footer -->
                                                                                     <div
                                                                                         class="modal-footer border-top-0 bg-light">
                                                                                         <button type="button"
                                                                                             class="btn btn-outline-danger"
                                                                                             data-bs-dismiss="modal">Tutup</button>
                                                                                         <button type="button"
                                                                                             class="btn btn-outline-primary"
                                                                                             id="updateBastBtn">
                                                                                             Update
                                                                                             <span id="updateButtonSpinner"
                                                                                                 class="spinner-border spinner-border-sm d-none"
                                                                                                 role="status"
                                                                                                 aria-hidden="true"></span>
                                                                                         </button>

                                                                                     </div>
                                                                                 </div>
                                                                             </div>
                                                                         </div>

                                                                         <br>

                                                                         <p class="text-black">kepada PIHAK PERTAMA. PIHAK
                                                                             KEDUA
                                                                             wajib mengisi Loogbook senjata dan amunisi pada
                                                                             kesempatan pertama menerima dan saat
                                                                             mengembalikan
                                                                             senjata dan amunisi tersebut.</p>

                                                                         <br>
                                                                         <p class="text-black">
                                                                             Demikian Berita Acara ini dibuat dengan
                                                                             sebenarnya,
                                                                             kemudian ditutup dan ditandatangani di Banda
                                                                             Aceh
                                                                             pada hari dan tanggal tersebut diatas.
                                                                         </p>

                                                                         <br>
                                                                         <div class="mb-3 row">
                                                                             <label class="col-md-3 col-form-label">Pejabat
                                                                                 Saksi</label>
                                                                             <div class="col-md-1 text-center mt-1">:</div>
                                                                             <div class="col-md-8">
                                                                                 <select
                                                                                     class="form-control form-select select2"
                                                                                     name="pejabat_saksi_bast_senjata_api">
                                                                                     <option value="" disabled
                                                                                         {{ old('pejabat_saksi_bast_senjata_api', $senjataapipemasukan->pejabat_saksi_bast_senjata_api) == '' ? 'selected' : '' }}>
                                                                                         - Pilih -
                                                                                     </option>
                                                                                     @foreach ($users as $user)
                                                                                         <option
                                                                                             value="{{ $user->id_admin }}"
                                                                                             {{ old('pejabat_saksi_bast_senjata_api', $senjataapipemasukan->pejabat_saksi_bast_senjata_api) == $user->id_admin ? 'selected' : '' }}>
                                                                                             {{ $user->name }} |
                                                                                             {{ $user->jabatan }}
                                                                                         </option>
                                                                                     @endforeach
                                                                                 </select>
                                                                             </div>
                                                                         </div>


                                                                     </div>
                                                                 </div>
                                                             </div>
                                                         </div>
                                                     </div>
                                                 </div>
                                             </div>


                                             <div class="card-footer d-flex justify-content-end">
                                                 <button type="submit" class="btn btn-success btn-sm me-2">
                                                     <i data-feather="save"></i> Simpan Data BAST Senjata Api
                                                 </button>
                                             </div>
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
         document.addEventListener('DOMContentLoaded', function() {
             // Ambil input ID Penyidikan
             const idBastSenjataApiInput = document.getElementById('id_bast_senjata_api');
             if (idBastSenjataApiInput) {
                 // Ambil nilai dari $penyidikan->id_penyidikan dan set ke input
                 idBastSenjataApiInput.value = "{{ $senjataapipemasukan->id_bast_senjata_api }}"; // Pastikan ini di-set dengan benar
             }

             const idBastSenjataApi = "{{ $senjataapipemasukan->id_bast_senjata_api }}"; // Pastikan ini di-set dengan benar // Pastikan ini di-set dengan benar

             // Panggil loadData untuk memuat data awal
             loadData(idBastSenjataApi);

             // Ambil tombol formBast dan elemen-elemen lainnya
             const formBastButton = document.getElementById('formBast');
             const buttonText = formBastButton.querySelector('#buttonText');
             const buttonSpinner = formBastButton.querySelector('#buttonSpinner');

             // Ketika tombol formBast diklik
             $('#formBast').on('click', function(e) {
                 e.preventDefault();

                 // Nonaktifkan tombol dan tampilkan animasi loading
                 formBastButton.disabled = true;
                 buttonSpinner.classList.remove('d-none');
                 buttonText.textContent = 'Tunggu...';

                 // Ambil data dari form
                 var formData = {
                     'id_bast_senjata_api': idBastSenjataApiInput ? idBastSenjataApiInput.value : '',
                     'kategori_bast': $('#kategori-bast').val(),
                     'senjata_api': $('#senjata_api').val(),
                     'nama_nip_yang_bertanggung_jawab': $('#nama-nip-yang-bertanggung-jawab').val(),
                     'jenis_amunisi': $('#jenis-amunisi').val(),
                     'jumlah_amunisi': $('#jumlah-amunisi').val(),
                     'kaliber_amunisi': $('#kaliber-amunisi').val(),
                     //'kategori_lartas': $('#kategori-lartas').val(),
                 };

                 // Kirim data ke server menggunakan AJAX
                 $.ajax({
                     url: '/Pengawasanlain/bast', // Ganti dengan route yang sesuai untuk menyimpan data
                     type: 'POST',
                     data: formData,
                     headers: {
                         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                     },
                     success: function(response) {
                         console.log('Data berhasil dikirim:', response);
                         alert('Data berhasil disimpan!');

                         // Reset data input form setelah berhasil disimpan
                         $('#kategori-bast').val('').trigger('change'); // Reset Select2
                         $('#senjata_api').val('').trigger('change'); // Reset Select2
                         $('#nama-nip-yang-bertanggung-jawab').val('');
                         $('#jenis-amunisi').val('');
                         $('#jumlah-amunisi').val('');
                         $('#kaliber-amunisi').val('');
                         // $('#kategori-lartas').val('').trigger('change');

                         // Panggil fungsi untuk update tabel real-time
                         loadData(idBastSenjataApiInput
                             .value); // Panggil dengan id_bast_senjata_api
                     },
                     error: function(xhr, status, error) {
                         console.error('Kesalahan:', error);
                         alert('Terjadi kesalahan saat mengirim data.');
                     },
                     complete: function() {
                         // Aktifkan kembali tombol dan sembunyikan animasi loading
                         formBastButton.disabled = false;
                         buttonSpinner.classList.add('d-none');
                         buttonText.textContent = 'Simpan';
                     }
                 });
             });
         });

         document.addEventListener('DOMContentLoaded', function() {
             // Dynamic field display based on category
             $('#edit-kategori-bast').on('change', function() {
                 const kategori = $(this).val();
                 $('#edit-senjata-fields, #edit-amunisi-fields').addClass('d-none');

                 if (kategori === 'senjata') {
                     $('#edit-senjata-fields').removeClass('d-none');
                 } else if (kategori === 'amunisi') {
                     $('#edit-amunisi-fields').removeClass('d-none');
                 } else if (kategori === 'senjata_amunisi') {
                     $('#edit-senjata-fields, #edit-amunisi-fields').removeClass('d-none');
                 }
             });

             // Edit button event delegation
             document.addEventListener('click', function(e) {
                 if (e.target.closest('.edit-btn')) {
                     e.preventDefault();
                     const itemId = e.target.closest('.edit-btn').getAttribute('data-id');

                     if (!itemId) {
                         alert('ID item tidak ditemukan');
                         return;
                     }

                     // Fetch item details for editing
                     $.ajax({
                         url: `/Pengawasanlain/bast/${itemId}/edit`,
                         type: 'GET',
                         success: function(response) {
                             // Populate hidden ID field
                             $('#bast-id').val(response.id);

                             // Populate kategori bast and trigger change to show/hide fields
                             $('#edit-kategori-bast').val(response.kategori_bast).trigger(
                                 'change');

                             // Populate default fields

                             // Populate senjata fields


                             $('#edit-jenis-amunisi').val(response.jenis_amunisi);
                             $('#edit-jumlah-amunisi').val(response.jumlah_amunisi);
                             $('#edit-kaliber-amunisi').val(response.kaliber_amunisi);

                             const editSenjataApi = $('#edit_senjata_api');
                             editSenjataApi.val(response.senjata_api).trigger(
                                 'change'); // Ensure Select2 updates
                             editSenjataApi.trigger('change');


                             //const editKategoriLartas = $('#edit-kategori-lartas');
                             //editKategoriLartas.val(response.kategori_lartas).trigger('change'); // Ensure Select2 updates
                             // Reinitialize select2 to update its UI
                             //editKategoriLartas.trigger('change');


                             // Populate other fields
                             $('#edit-nama-nip-yang-bertanggung-jawab').val(response
                                 .nama_nip_yang_bertanggung_jawab);



                             // Reinitialize Select2 elements
                             $('.select2').select2();

                             // Show the modal
                             var editModal = new bootstrap.Modal(document.getElementById(
                                 'editBastModal'));
                             editModal.show();
                         },
                         error: function(xhr, status, error) {
                             console.error('Error fetching item details:', error);
                             alert('Gagal mengambil data untuk diedit.');
                         }
                     });
                 }
             });


             // Update button event
             $('#updateBastBtn').on('click', function() {
                 const itemId = $('#bast-id').val();

                 if (!itemId) {
                     alert('ID bagian update tidak valid');
                     return;
                 }
                 const formData = {
                     'id_bast_senjata_api': $('#id_bast_senjata_api').val(),
                     'kategori_bast': $('#edit-kategori-bast').val(),
                     'senjata_api': $('#senjata_api').val(),
                     'nama_nip_yang_bertanggung_jawab': $('#edit-nama-nip-yang-bertanggung-jawab').val(),
                     'jenis_amunisi': $('#edit-jenis-amunisi').val(),
                     'jumlah_amunisi': $('#edit-jumlah-amunisi').val(),
                     'kaliber_amunisi': $('#edit-kaliber-amunisi').val(),
                     //'kategori_lartas': $('#edit-kategori-lartas').val()
                 };

                 // Show loading spinner
                 const updateButton = $(this);
                 const buttonSpinner = $('#updateButtonSpinner');
                 updateButton.prop('disabled', true);
                 buttonSpinner.removeClass('d-none');

                 // Get investigation ID
                 const idBastSenjataApi = $('#id_bast_senjata_api').val();

                 $.ajax({
                     url: `/Pengawasanlain/bast/${itemId}`,
                     type: 'PUT',
                     data: formData,
                     headers: {
                         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                     },
                     success: function(response) {
                         if (response.success) {
                             alert('Data berhasil diupdate!');

                             // Close modal
                             $('#editBastModal').modal('hide');

                             // Reload data
                             loadData(idBastSenjataApi);
                         } else {
                             alert('Gagal mengupdate data.');
                         }
                     },
                     error: function(xhr, status, error) {
                         console.error('Error:', error);
                         alert('Terjadi kesalahan saat mengupdate data.');
                     },
                     complete: function() {
                         // Restore button state
                         updateButton.prop('disabled', false);
                         buttonSpinner.addClass('d-none');
                     }
                 });
             });
         });

         //diatas ini bagian edit

         document.addEventListener('click', function(e) {
             if (e.target && e.target.matches('.delete-btn')) {
                 const form = e.target.closest('form');
                 const itemId = form.getAttribute('data-id');
                 // Get the investigation ID from a more reliable source
                 const idBastSenjataApi = document.getElementById('id_bast_senjata_api').value;

                 if (confirm('Apakah Anda yakin ingin menghapus data ini?')) {
                     const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

                     fetch(`/Pengawasanlain/bast/${itemId}`, {
                             method: 'DELETE',
                             headers: {
                                 'X-CSRF-TOKEN': csrfToken,
                                 'Content-Type': 'application/json',
                             }
                         })
                         .then(response => response.json())
                         .then(data => {
                             if (data.success) {
                                 alert('Data berhasil dihapus!');
                                 // Pass the investigation ID here
                                 loadData(idBastSenjataApi);
                             } else {
                                 alert('Terjadi kesalahan saat menghapus data.');
                             }
                         })
                         .catch(error => {
                             console.error('Kesalahan:', error);
                             alert('Terjadi kesalahan saat menghapus data.');
                         });
                 }
             }
         });


         // Fungsi untuk memuat data tabel secara real-time
         function loadData(idBastSenjataApi) {
             $.ajax({
                 url: '/Pengawasanlain/bast', // Ganti dengan route yang sesuai untuk mengambil data
                 type: 'GET',
                 data: {
                     'id_bast_senjata_api': idBastSenjataApi
                 }, // Kirimkan id_bast_senjata_api ke server
                 success: function(response) {
                     $('#tableBody').empty();

                     if (response.data && response.data.length > 0) {
                         response.data.forEach(function(item, index) {
                             let fieldMerkTipeUkuran, fieldKondisi;


                             $('#tableBody').append(`
  <tr class="shadow-sm">
      <td class="text-center fw-medium">${index + 1}</td>
     <td class="fw-medium">${(item.kategori_bast || '-').slice(0, 20)}${(item.kategori_bast && item.kategori_bast.length > 20 ? '...' : '')}</td>
    <td class="fw-medium">${(item.senjata_api || '-').slice(0, 20)}${(item.senjata_api && item.senjata_api.length > 20 ? '...' : '')}</td>
    <td class="fw-medium">${(item.jenis_amunisi || '-').slice(0, 20)}${(item.jenis_amunisi && item.jenis_amunisi.length > 20 ? '...' : '')}</td>
    <td class="fw-medium">${(item.kaliber_amunisi || '-').slice(0, 20)}${(item.kaliber_amunisi && item.kaliber_amunisi.length > 20 ? '...' : '')}</td>
    <td class="fw-medium">${(item.jumlah_amunisi || '-').slice(0, 20)}${(item.jumlah_amunisi && item.jumlah_amunisi.length > 20 ? '...' : '')}</td>




      <td>
          <div class="d-flex gap-1 justify-content-center">
               <a href="#" class="btn btn-soft-success btn-icon btn-sm rounded-pill edit-btn" data-id="${item.id}">
        <i data-feather="edit" class="icon-sm"></i> Edit
    </a>
           <form action="/Pengawasanlain/bast/${item.id}" method="POST" class="d-inline delete-form" data-id="${item.id}">
   @csrf
   @method('DELETE')
   <button type="button" class="btn btn-soft-danger btn-icon btn-sm rounded-pill delete-btn">
       <i data-feather="trash" class="icon-sm"></i> Delete
   </button>
</form>



          </div>
      </td>
  </tr>
`);


                         });
                     } else {
                         $('#tableBody').append(
                             '<tr><td colspan="10" class="text-center">Data tidak ditemukan</td></tr>');
                     }

                 },
                 error: function(xhr, status, error) {
                     console.error('Kesalahan:', error);
                     alert('Terjadi kesalahan saat memuat data.');
                 }
             });
         }
     </script>


     <style>
         .nav-link.highlight {
             color: #287F71 !important;
             transition: background-color 0.5s ease;
         }

         .fw-bold {
             color: black !important;
         }

         .col-form-label {
             color: black !important;
         }

         input[readonly] {
             color: black !important;
         }
     </style>

     <script>
         document.getElementById("searchTab").addEventListener("keyup", function() {
             let filter = this.value.toLowerCase();
             let tabs = document.querySelectorAll(".nav-item-penyidikan");

             tabs.forEach(tab => {
                 let tabText = tab.textContent.toLowerCase();
                 if (tabText.includes(filter)) {
                     tab.style.display = "";
                 } else {
                     tab.style.display = "none";
                 }
             });
         });

         feather.replace();
     </script>

     <style>
         #searchTab {
             width: 60%;
             max-width: 400px;
         }


         .search-iconnnnnn {
             position: absolute;
             left: 20px;
             top: 50%;
             transform: translateY(-50%);
             color: #6c757d;
         }

         .shadow-custom {
             box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.15);
             transition: box-shadow 0.3s ease-in-out;
         }
     </style>

     <script>
         document.addEventListener('DOMContentLoaded', function() {
             $('.bs-example-modal-lg').on('shown.bs.modal', function() {
                 $('.select2').select2({
                     dropdownParent: $('.bs-example-modal-lg'),
                     width: '100%',
                     allowClear: true,
                 });
             });
         });
     </script>

     <script>
         document.addEventListener('DOMContentLoaded', function() {
             const senjataFields = document.getElementById('senjata-fields');
             const amunisiFields = document.getElementById('amunisi-fields');

             $('#kategori-bast').on('change', function(e) {
                 const value = $(this).val();

                 senjataFields.classList.add('d-none');
                 amunisiFields.classList.add('d-none');

                 if (value === 'senjata') {
                     senjataFields.classList.remove('d-none');
                 } else if (value === 'amunisi') {
                     amunisiFields.classList.remove('d-none');
                 } else if (value === 'senjata_amunisi') {
                     senjataFields.classList.remove('d-none');
                     amunisiFields.classList.remove('d-none');
                 }
             });
         });
     </script>

     <script>
         document.getElementById('closeAccordionBtn').addEventListener('click', function() {
             var collapseElement = document.getElementById('collapseQuestions');
             var accordionCollapse = new bootstrap.Collapse(collapseElement, {
                 toggle: true
             });
         });
     </script>
 @endsection

 @section('script')
     @vite(['resources/js/pages/datatable.init.js'])
 @endsection
