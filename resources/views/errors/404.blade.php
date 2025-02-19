@extends('layouts.error', ['title' => 'Error 404'])

@section('content')
  <div class="col-md-5 mx-auto">
    <div class="card p-3 mb-0">
      <div class="card-body">
        <div class="text-center">

          <div class="maintenance-img">
            <img src="/images/svg/404-error.svg" class="img-fluid" alt="coming-soon">
          </div>

          <div class="">
            <h3 class="mt-5 fw-semibold text-dark text-capitalize">Ups!, Halaman Tidak Ditemukan</h3>
            <p class="text-dark">Halaman yang Anda coba akses ini tidak ada. <br> Coba kembali ke beranda.</p>
          </div>

          <a class="btn btn-primary mt-3 me-1" href="/">Kembali</a>
        </div>
      </div>
    </div>
  </div>
@endsection
