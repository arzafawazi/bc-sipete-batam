 @extends('layouts.vertical', ['title' => 'Edit Berita Acara Cacah Amunis'])

 @section('css')
     @vite(['node_modules/datatables.net-bs5/css/dataTables.bootstrap5.min.css', 'node_modules/datatables.net-buttons-bs5/css/buttons.bootstrap5.min.css', 'node_modules/datatables.net-keytable-bs5/css/keyTable.bootstrap5.min.css', 'node_modules/datatables.net-responsive-bs5/css/responsive.bootstrap5.min.css', 'node_modules/datatables.net-select-bs5/css/select.bootstrap5.min.css'])
 @endsection
 @section('content')
     <div class="container-fluid">
         <form action="{{ route('ba-cacah-amunisi.update', ['ba_cacah_amunisi' => $cacahamunisi->id]) }}" method="POST"
             enctype="multipart/form-data">
             <div class="card mb-3 mt-4">
                 <div class="card-header d-flex justify-content-between align-items-center">
                     <h5 class="card-title mb-0">
                         <i data-feather="book" style="width: 20px; height: 20px;" class="me-1"></i>
                         Form Edit Data Pelanggaran Usur Pidana Penyidikan
                     </h5>
                     <a href="{{ route('ba-cacah-amunisi.index') }}" class="btn btn-danger btn-sm">
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
                                                 <a class="nav-link active" id="navtabs2-ba-cacah-amunisi-tab"
                                                     data-bs-toggle="tab" href="#navtabs2-ba-cacah-amunisi" role="tab"
                                                     aria-controls="navtabs2-ba-cacah-amunisi" aria-selected="true">
                                                     <span class="d-block d-sm-none">(BA CACAH AMUNISI)</span>
                                                     <span class="d-none d-sm-block">BERITA ACARA CACAH AMUNISI</span>
                                                 </a>
                                             </li>
                                         </ul>
                                     </div>

                                     <div class="tab-content p-3 text-muted">

                                         <div class="tab-pane active" id="navtabs2-ba-cacah-amunisi" role="tabpanel">
                                             <div class="container-fluid mt-4">
                                                 <!-- Header with Logo -->
                                                 <div class="row mb-4 align-items-center text-black">
                                                     <div class="col-md-2 col-sm-12 text-center mb-3 mb-md-0">
                                                         <img src="/images/logocop.png" alt="Logo" class="img-fluid"
                                                             style="max-height:170px;">
                                                     </div>
                                                     <div class="col-md-10 col-sm-12 text-center">
                                                         <h5 class="mb-0">KEMENTERIAN KEUANGAN REPUBLIK INDONESIA</h5>
                                                         <p class="small mb-0">DIREKTORAT JENDERAL BEA DAN CUKAI</p>
                                                         <p class="small mb-0">KANTOR PELAYANAN UTAMA BEA DAN CUKAI TIPE B
                                                             BATAM</p>
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

                                                 <h5 class="fw-bold text-center text-black"><u>BERITA ACARA
                                                         PEMAKAIAN AMUNISI UNTUK LATIHAN MENEMBAK
                                                     </u></h5>

                                                 <div class="mb-3 row align-items-center">
                                                     <div class="input-group flex-wrap">
                                                         <span class="input-group-text">NO : BA-</span>
                                                         <input type="text" class="form-control"
                                                             value="{{ old('no_ba_cacah_amunisi', $cacahamunisi->no_ba_cacah_amunisi) }}"
                                                             name="no_ba_cacah_amunisi" readonly>
                                                         <span class="input-group-text">/PPNS/</span>
                                                         <input type="date" class="form-control"
                                                             name="tgl_ba_cacah_amunisi"
                                                             value="{{ old('tgl_ba_cacah_amunisi', $cacahamunisi->tgl_ba_cacah_amunisi) }}">
                                                     </div>
                                                 </div>

                                                 <!-- Main Form -->
                                                 <div class="card p-1">
                                                     <div class="card-body">
                                                         <div class="row">
                                                             <div class="col-lg-12">
                                                                 <div class="container-fluid px-0 px-sm-3">

                                                                     <p class="fw-bold">
                                                                         &nbsp;&nbsp;&nbsp; Pada hari ........ tanggal
                                                                         ........ bulan ........ tahun ........, Saya
                                                                         :
                                                                     </p>

                                                                     <div class="fw-bold text-center">
                                                                         <select class="form-control form-select select2"
                                                                             name="pejabat_cacah_amunisi">
                                                                             <option value="" disabled
                                                                                 {{ old('pejabat_cacah_amunisi', $cacahamunisi->pejabat_cacah_amunisi) == '' ? 'selected' : '' }}>
                                                                                 - Pilih -
                                                                             </option>
                                                                             @foreach ($users as $user)
                                                                                 <option value="{{ $user->id_admin }}"
                                                                                     {{ old('pejabat_cacah_amunisi', $cacahamunisi->pejabat_cacah_amunisi) == $user->id_admin ? 'selected' : '' }}>
                                                                                     {{ $user->name }} |
                                                                                     {{ $user->jabatan }}
                                                                                 </option>
                                                                             @endforeach
                                                                         </select>
                                                                     </div>
                                                                     <br>

                                                                     <div class="fw-bold text-center mt-3">
                                                                         <textarea class="form-control" name="memberikan_izin_senjata" rows="3" placeholder="memberikan izin.....">{{ old('memberikan_izin_senjata', $cacahamunisi->memberikan_izin_senjata) }}</textarea>
                                                                     </div>

                                                                     <br>

                                                                     <p class="text-black">Demikian Berita Acara ini dibuat
                                                                         dengan sebenarnya, kemudian ditutup dan
                                                                         ditandatangani di.........pada hari dan tanggal
                                                                         tersebut di atas.</p>

                                                                     <div class="fw-bold text-center mt-3">
                                                                         <textarea class="form-control" placeholder="ditandatangani di" name="ditandatangani_cacah_amunisi" rows="3">{{ old('ditandatangani_cacah_amunisi', $cacahamunisi->ditandatangani_cacah_amunisi) }}</textarea>
                                                                     </div>

                                                                     <br>


                                                                     <div class="mb-3 row">
                                                                         <label class="col-md-3 col-form-label">Pejabat
                                                                             Saksi</label>
                                                                         <div class="col-md-1 text-center mt-1">:</div>
                                                                         <div class="col-md-8">
                                                                             <select
                                                                                 class="form-control form-select select2"
                                                                                 name="pejabat_saksi_cacah_amunisi">
                                                                                 <option value="" disabled
                                                                                     {{ old('pejabat_saksi_cacah_amunisi', $cacahamunisi->pejabat_saksi_cacah_amunisi) == '' ? 'selected' : '' }}>
                                                                                     - Pilih -
                                                                                 </option>
                                                                                 @foreach ($users as $user)
                                                                                     <option value="{{ $user->id_admin }}"
                                                                                         {{ old('pejabat_saksi_cacah_amunisi', $cacahamunisi->pejabat_saksi_cacah_amunisi) == $user->id_admin ? 'selected' : '' }}>
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
                                                 <i data-feather="save"></i> Simpan Data Pelanggaran Ketentuan Lain
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
 @endsection

 @section('script')
     @vite(['resources/js/pages/datatable.init.js'])
 @endsection
