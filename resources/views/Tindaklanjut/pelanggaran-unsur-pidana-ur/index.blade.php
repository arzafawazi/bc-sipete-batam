@extends('layouts.vertical', ['title' => 'Pelanggaran Unsur Pidana Penyidikan'])

@section('css')
    @vite(['node_modules/datatables.net-bs5/css/dataTables.bootstrap5.min.css', 'node_modules/datatables.net-buttons-bs5/css/buttons.bootstrap5.min.css', 'node_modules/datatables.net-keytable-bs5/css/keyTable.bootstrap5.min.css', 'node_modules/datatables.net-responsive-bs5/css/responsive.bootstrap5.min.css', 'node_modules/datatables.net-select-bs5/css/select.bootstrap5.min.css'])
@endsection

@section('content')
    <div class="container-fluid">
        <!-- Search Form Section -->
        <div class="card mb-3 mt-4">
            <div class="card-header">
                <h5 class="card-title mb-0">Laporan Pelanggaran Unsur Pidana Penyidikan Bagian UR (Ultimum Remedium)</h5>
            </div>
            <div class="card-body">
                <form method="GET">
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label>Periode:</label>
                            <div class="input-group">
                                <input type="date" class="form-control" name="start_date">
                                <span class="input-group-text">s.d</span>
                                <input type="date" class="form-control" name="end_date">
                            </div>
                        </div>

                        <div class="col-md-4 mb-3">
                            <label>No. Pelanggaran Unsur Pidana Penyidikan UR:</label>
                            <input type="text" class="form-control" name="passport_number" placeholder="Keyword">
                        </div>

                        <div class="col-md-4 mb-3">
                            <label>Tgl. Pelanggaran Unsur Pidana Penyidikan UR:</label>
                            <input type="text" class="form-control" name="passenger_name" placeholder="Keyword">
                        </div>

                        <div class="col-md-4 mb-3">
                            <label>Nomor BDN:</label>
                            <input type="text" class="form-control" name="document_number" placeholder="Keyword">
                        </div>

                        <div class="col-md-4 mb-3">
                            <label>Skema Penindakan:</label>
                            <select class="form-control" name="commodity">
                                <option value="">Semua Skema Penindakan</option>
                                <option value="BERSAMA">Penindakan Bersama</option>
                                <option value="MANDIRI">Penindakan Mandiri</option>
                            </select>
                        </div>

                        <div class="col-md-4 mb-3">
                            <label>Lokasi Pemeriksaan:</label>
                            <select class="form-control" name="inspection_location">
                                <option value="">Pilih</option>
                                <option value="Lokasi1">Lokasi 1</option>
                                <option value="Lokasi2">Lokasi 2</option>
                            </select>
                        </div>

                        <div class="col-12 d-flex justify-content-center flex-wrap gap-2">
                            <button type="submit" class="btn btn-primary btn-sm">
                                <i data-feather="search" style="width: 16px; height: 16px;" class="me-1"></i> Cari Dokumen
                            </button>
                            <button type="button" class="btn btn-secondary btn-sm" onclick="location.reload();">
                                <i data-feather="refresh-cw" style="width: 16px; height: 16px;" class="me-1"></i> Refresh
                            </button>

                            <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal"
                                data-bs-target="#laporanInfoModal">
                                <i data-feather="plus" style="width: 16px; height: 16px;" class="me-1"></i> Rekam Data
                                Pelanggaran Unsur Pidana Penyidikan UR
                            </button>

                            <button type="button" class="btn btn-info btn-sm">
                                <i data-feather="file-text" style="width: 16px; height: 16px;" class="me-1"></i> Export to
                                Excel
                            </button>
                        </div>

                    </div>
                </form>
            </div>
        </div>

        <div class="modal fade" id="laporanInfoModal" tabindex="-1" aria-labelledby="laporanInfoModalLabel"
            aria-hidden="true">

            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="laporanInfoModalLabel">Pilih Nomor Surat Laporan Hasil Penelitian Atau
                            Unsur Pidana Penyidikan</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body table-responsive">
                        <!-- Tabel atau daftar nomor laporan informasi -->
                        <table id="datatable" class="table table-bordered dt-responsive table-responsive nowrap">
                            <thead>
                                <tr align="center">
                                    <th>Nomor LHP Penyidikan</th>
                                    <th>Tanggal LHP Penyidikan</th>
                                    <th>Nomor LK</th>
                                    <th>Tanggal LK</th>
                                    <th>Pilih</th>
                                </tr>
                            </thead>

                            <tbody>
                                {{-- Baris dari penyidikan --}}
                                @foreach ($penyidikan as $p)
                                    <tr align="center">
                                        <td class="pt-3">{{ $p->no_lhp_penyidikan }}</td>
                                        <td class="pt-3">{{ $p->tgl_lhp_penyidikan }}</td>
                                        <td class="pt-3">-</td>
                                        <td class="pt-3">-</td>
                                        <td>
                                            <button type="button" class="btn btn-primary pilih-laporan"
                                                data-id="{{ $p->id_penyidikan }}" data-tipe="penyidikan">
                                                Pilih
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach

                                {{-- Baris dari unsur pidana penyidikan --}}
                                @foreach ($unsurPidanaPenyidikan as $u)
                                    <tr align="center">
                                        <td class="pt-3">-</td>
                                        <td class="pt-3">-</td>
                                        <td class="pt-3">{{ $u->no_lk }}</td>
                                        <td class="pt-3">{{ $u->tgl_lk }}</td>
                                        <td>
                                            <button type="button" class="btn btn-success pilih-laporan"
                                                data-id="{{ $u->id_pelanggaran_unsur_pidana_penyidikan }}"
                                                data-tipe="unsurpidana">
                                                Pilih
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>

                        </table>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>

        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Periksa kembali:</strong>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <!-- Table Section -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body table-responsive">
                        <table id="fixed-header-datatable" class="table table-hover align-middle border-separate"
                            style="border-spacing: 0 8px;">
                            <thead>
                                <tr class="bg-light">
                                    <th class="text-center px-3 py-3" style="width: 5%">No</th>
                                    <th class="text-center px-3 py-3" style="width: 20%">Status</th>
                                    <th class="text-center px-3 py-3" style="width: 20%">Opsi</th>
                                </tr>
                            </thead>
                            <tbody align="center">
                                @foreach ($unsurpidana as $index => $unsurpidana)
                                    <tr class="shadow-sm">
                                        <td class="text-center fw-medium">{{ $index + 1 }}.</td>
                                        <td class="fw-medium">
                                            @php
                                                $fromUnsur = !empty($unsurpidana->id_pelanggaran_unsur_pidana_penyidikan_ref);
                                                $fromPenyidikan = !empty($unsurpidana->id_penyidikan_ref);
                                            @endphp

                                            @if ($fromUnsur && $fromPenyidikan)
                                                Berasal dari keduanya
                                            @elseif ($fromUnsur)
                                                Berasal dari unsur pidana penyidikan
                                            @elseif ($fromPenyidikan)
                                                Berasal dari Penyidikan
                                            @else
                                                Tidak diketahui
                                            @endif
                                        </td>
                                        <td>
                                            <div class="d-flex gap-1 justify-content-center">
                                                <a href="{{ route('unsur-pidana-ur.edit', ['unsur_pidana_ur' => $unsurpidana->id]) }}"
                                                    class="btn btn-soft-success btn-icon btn-sm rounded-pill">
                                                    <i data-feather="edit" class="icon-sm"></i> Edit
                                                </a>
                                                <form action="{{ route('unsur-pidana-ur.destroy', $unsurpidana->id) }}"
                                                    method="POST" class="d-inline delete-form">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                        class="btn btn-soft-danger btn-icon btn-sm rounded-pill"
                                                        onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?');">
                                                        <i data-feather="trash" class="icon-sm"></i> Delete
                                                    </button>
                                                </form>
                                                <a href="{{ route('tes.print', $unsurpidana->id) }}"
                                                    class="btn btn-soft-info btn-icon btn-sm rounded-pill">
                                                    <i data-feather="printer" class="icon-sm"></i> Print
                                                </a>
                                            </div>

                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <!-- container-fluid -->

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            document.addEventListener('click', function(event) {
                if (event.target.classList.contains('pilih-laporan')) {
                    const id = event.target.getAttribute('data-id');
                    const tipe = event.target.getAttribute('data-tipe');

                    let url = '';
                    if (tipe === 'penyidikan') {
                        url =
                            `/Tindaklanjut/unsur-pidana-ur/create?id_penyidikan=${encodeURIComponent(id)}`;
                    } else if (tipe === 'unsurpidana') {
                        url =
                            `/Tindaklanjut/unsur-pidana-ur/create?id_pelanggaran_unsur_pidana_penyidikan=${encodeURIComponent(id)}`;
                    }

                    window.location.href = url;
                }
            });
        });
    </script>




@endsection

@section('script')
    @vite(['resources/js/pages/datatable.init.js'])
@endsection
