@extends('layouts.vertical', ['title' => 'Set Nomor Dokumen Penindakan'])

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
    <!-- Search Form Section -->
    <div class="card mb-3 mt-4">
        <div class="card-header">
            <h5 class="card-title mb-0"><i data-feather="settings" height="20" widht="20"></i>&nbsp;Set Nomor Dokumen Penindakan</h5>
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
    </div>
         

    


{{-- Menampilkan pesan error per input --}}
{{-- @foreach ($errors->all() as $error)
    <div class="alert alert-danger">{{ $error }}</div>
@endforeach --}}

    
    <!-- Table Section -->
    <div class="row">
    <form action="{{ route('tools.setNomorDokumen.update', $no_ref->id) }}" method="POST">
    @csrf
    @method('PUT')
        <div class="col-12">
            <div class="card">
                <div class="card-body table-responsive">
                   <table id="fixed-header-datatable" class="table table-striped table-bordered">
    <thead>
        <tr>
            <th>No. Dokumen</th>
            <th>Input</th>
        </tr>
    </thead>
    <tbody>
    <tr>
        <td>No. Dokumen SBP</td>
        <td>
            <input type="text" class="form-control form-control-sm bg-primary text-white" id="no_sbp" name="no_sbp" value="{{ old('no_sbp', $no_ref->no_sbp) }}" style="width: 100px;">
        </td>
    </tr>
    <tr>
        <td>No. Dokumen SBP-NPP</td>
        <td>
            <input type="text" class="form-control form-control-sm bg-primary text-white" id="no_sbp_npp" name="no_sbp_npp" value="{{ old('no_sbp_npp', $no_ref->no_sbp_npp) }}" style="width: 100px;">
        </td>
    </tr>
    <tr>
        <td>No. Dokumen BA Segel</td>
        <td>
            <input type="text" class="form-control form-control-sm bg-primary text-white" id="no_ba_segel" name="no_ba_segel" value="{{ old('no_ba_segel', $no_ref->no_ba_segel) }}" style="width: 100px;">
        </td>
    </tr>
    <tr>
        <td>No. Dokumen BA Segel-NPP</td>
        <td>
            <input type="text" class="form-control form-control-sm bg-primary text-white" id="no_ba_segel_npp" name="no_ba_segel_npp" value="{{ old('no_ba_segel_npp', $no_ref->no_ba_segel_npp) }}" style="width: 100px;">
        </td>
    </tr>
    <tr>
        <td>No. Dokumen BA Serah</td>
        <td>
            <input type="text" class="form-control form-control-sm bg-primary text-white" id="no_ba_serah" name="no_ba_serah" value="{{ old('no_ba_serah', $no_ref->no_ba_serah) }}" style="width: 100px;">
        </td>
    </tr>
    <tr>
        <td>No. Dokumen BA Serah-NPP</td>
        <td>
            <input type="text" class="form-control form-control-sm bg-primary text-white" id="no_ba_serah_npp" name="no_ba_serah_npp" value="{{ old('no_ba_serah_npp', $no_ref->no_ba_serah_npp) }}" style="width: 100px;">
        </td>
    </tr>
    <tr>
        <td>No. Dokumen BA Musnah</td>
        <td>
            <input type="text" class="form-control form-control-sm bg-primary text-white" id="no_ba_musnah" name="no_ba_musnah" value="{{ old('no_ba_musnah', $no_ref->no_ba_musnah) }}" style="width: 100px;">
        </td>
    </tr>
    <tr>
        <td>No. Dokumen BA Musnah-NPP</td>
        <td>
            <input type="text" class="form-control form-control-sm bg-primary text-white" id="no_ba_musnah_npp" name="no_ba_musnah_npp" value="{{ old('no_ba_musnah_npp', $no_ref->no_ba_musnah_npp) }}" style="width: 100px;">
        </td>
    </tr>
    <tr>
        <td>No. Dokumen BA tegah</td>
        <td>
            <input type="text" class="form-control form-control-sm bg-primary text-white" id="no_ba_tegah" name="no_ba_tegah" value="{{ old('no_ba_tegah', $no_ref->no_ba_tegah) }}" style="width: 100px;">
        </td>
    </tr>
    <tr>
        <td>No. Dokumen BA tegah-NPP</td>
        <td>
            <input type="text" class="form-control form-control-sm bg-primary text-white" id="no_ba_tegah_npp" name="no_ba_tegah_npp" value="{{ old('no_ba_tegah_npp', $no_ref->no_ba_tegah_npp) }}" style="width: 100px;">
        </td>
    </tr>
    <tr>
        <td>No. Dokumen BA Buka Segel</td>
        <td>
            <input type="text" class="form-control form-control-sm bg-primary text-white" id="no_ba_buka_segel" name="no_ba_buka_segel" value="{{ old('no_ba_buka_segel', $no_ref->no_ba_buka_segel) }}" style="width: 100px;">
        </td>
    </tr>
    <tr>
        <td>No. Dokumen LPTP</td>
        <td>
            <input type="text" class="form-control form-control-sm bg-primary text-white" id="no_lptp" name="no_lptp" value="{{ old('no_lptp', $no_ref->no_lptp) }}" style="width: 100px;">
        </td>
    </tr>
    <tr>
        <td>No. Dokumen LPTP-NPP</td>
        <td>
            <input type="text" class="form-control form-control-sm bg-primary text-white" id="no_lptp_npp" name="no_lptp_npp" value="{{ old('no_lptp_npp', $no_ref->no_lptp_npp) }}" style="width: 100px;">
        </td>
    </tr>
    <tr>
        <td>No. Dokumen LPP</td>
        <td>
            <input type="text" class="form-control form-control-sm bg-primary text-white" id="no_lpp" name="no_lpp" value="{{ old('no_lpp', $no_ref->no_lpp) }}" style="width: 100px;">
        </td>
    </tr>
    <tr>
        <td>No. Dokumen LPP-NPP</td>
        <td>
            <input type="text" class="form-control form-control-sm bg-primary text-white" id="no_lpp_npp" name="no_lpp_npp" value="{{ old('no_lpp_npp', $no_ref->no_lpp_npp) }}" style="width: 100px;">
        </td>
    </tr>
    <tr>
        <td>No. Dokumen SP Cacah</td>
        <td>
            <input type="text" class="form-control form-control-sm bg-primary text-white" id="no_sp_cacah" name="no_sp_cacah" value="{{ old('no_sp_cacah', $no_ref->no_sp_cacah) }}" style="width: 100px;">
        </td>
    </tr>
    <tr>
        <td>No. Dokumen BA Cacah</td>
        <td>
            <input type="text" class="form-control form-control-sm bg-primary text-white" id="no_ba_cacah" name="no_ba_cacah" value="{{ old('no_ba_cacah', $no_ref->no_ba_cacah) }}" style="width: 100px;">
        </td>
    </tr>
    <tr>
        <td>No. Dokumen Pelekatan</td>
        <td>
            <input type="text" class="form-control form-control-sm bg-primary text-white" id="no_pelekatan" name="no_pelekatan" value="{{ old('no_pelekatan', $no_ref->no_pelekatan) }}" style="width: 100px;">
        </td>
    </tr>
    <tr>
        <td>No. Dokumen Pelepasan</td>
        <td>
            <input type="text" class="form-control form-control-sm bg-primary text-white" id="no_pelepasan" name="no_pelepasan" value="{{ old('no_pelepasan', $no_ref->no_pelepasan) }}" style="width: 100px;">
        </td>
    </tr>
    <tr>
        <td>No. Dokumen BAPP</td>
        <td>
            <input type="text" class="form-control form-control-sm bg-primary text-white" id="no_bapp" name="no_bapp" value="{{ old('no_bapp', $no_ref->no_bapp) }}" style="width: 100px;">
        </td>
    </tr>
    <tr>
        <td>No. Dokumen PPBS</td>
        <td>
            <input type="text" class="form-control form-control-sm bg-primary text-white" id="no_ppbs" name="no_ppbs" value="{{ old('no_ppbs', $no_ref->no_ppbs) }}" style="width: 100px;">
        </td>
    </tr>
    <tr>
        <td>No. Menu</td>
        <td>
            <input type="text" class="form-control form-control-sm bg-primary text-white" id="no_menu" name="no_menu" value="{{ old('no_menu', $no_ref->no_menu) }}" style="width: 100px;">
        </td>
    </tr>
    <tr>
        <td>No. Dokumen  BAPBC</td>
        <td>
            <input type="text" class="form-control form-control-sm bg-primary text-white" id="no_bapbc" name="no_bapbc" value="{{ old('no_bapbc', $no_ref->no_bapbc) }}" style="width: 100px;">
        </td>
    </tr>
    <tr>
        <td>No. Patroli</td>
        <td>
            <input type="text" class="form-control form-control-sm bg-primary text-white" id="no_patroli" name="no_patroli" value="{{ old('no_patroli', $no_ref->no_patroli) }}" style="width: 100px;">
        </td>
    </tr>
    <tr>
        <td>No. BCL12</td>
        <td>
            <input type="text" class="form-control form-control-sm bg-primary text-white" id="no_bcl12" name="no_bcl12" value="{{ old('no_bcl12', $no_ref->no_bcl12) }}" style="width: 100px;">
        </td>
    </tr>
    <tr>
        <td>No. Dokumen BA RIKSA</td>
        <td>
            <input type="text" class="form-control form-control-sm bg-primary text-white" id="no_ba_riksa" name="no_ba_riksa" value="{{ old('no_ba_riksa', $no_ref->no_ba_riksa) }}" style="width: 100px;">
        </td>
    </tr>
</tbody>

    <tr>
            <td colspan="2" style="text-align: right;">
                <button type="submit" name="update_nomor" id="update_nomor" class="btn btn-sm btn-success">
                    <i data-feather="file" height="15" width="15"></i> Simpan Perubahan
                </button>
            </td>
        </tr>
</table>
  



                </div>
            </div>
        </div>
    </div>
    {{-- </form> --}}
</div>
</form>
 <!-- container-fluid -->



@endsection

@section('script')
    @vite([ 'resources/js/pages/datatable.init.js'])
@endsection