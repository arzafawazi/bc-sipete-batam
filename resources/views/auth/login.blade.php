@extends('layouts.auth', ['title' => 'Login'])
<style>
body {
    background-image: url("{{ asset('images/background/background.png') }}");
    background-size: cover; 
    background-position: center;
    background-repeat: no-repeat;
    background-attachment: fixed;
    overflow: hidden;
    margin: 0;
    padding: 0;
}
</style>

@section('content')



@section('content')
<div class="d-flex align-items-center justify-content-center min-vh-100">
    <div class="col-12 col-sm-8 col-md-6 col-lg-4">
        <div class="card shadow-lg border-0">
            <div class="card-body p-4 p-md-5">
                <div class="text-center mb-4">
                    <img src="{{ asset('images/beacukai.png') }}" alt="logo" height="150" class="mb-3" />
                    <h3 class="text-dark fs-4 fw-bold">KPU BEA CUKAI TIPE B BATAM</h3>
                    <h3 class="text-dark fs-4 fw-bold"><i>SIPETE</i></h3>
                    <p class="text-muted mb-0">Silahkan Login</p>
                </div>
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    {{-- Display validation errors --}}
                    @if ($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            @foreach ($errors->all() as $error)
                                <p class="mb-1">{{ $error }}</p>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            @endforeach
                        </div>
                    @endif

                    {{-- Username field --}}
                    <div class="mb-3">
                        <label for="name" class="form-label">Username</label>
                        <input type="text" name="name" id="name" class="form-control" required placeholder="Masukkan username">
                    </div>

                    {{-- Password field --}}
                    <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <div class="input-group">
                        <input type="password" name="password" id="password" class="form-control" required placeholder="Masukkan password">
                        <button class="btn btn-primary" type="button" id="togglePassword">
                            <i data-feather="eye-off" id="eyeIcon"></i> <!-- Ikon mata terbuka dari Feather -->
                        </button>
                    </div>
                </div>

<!-- Pastikan Anda memuat Bootstrap dan Icon Library untuk menggunakan icon -->


                    {{-- Login button --}}
                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary">Login</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>

document.getElementById('togglePassword').addEventListener('click', function () {
    const passwordField = document.getElementById('password');
    const passwordType = passwordField.type === 'password' ? 'text' : 'password';
    passwordField.type = passwordType;

    
    const icon = document.getElementById('eyeIcon');
    if (passwordType === 'password') {
        icon.setAttribute('data-feather', 'eye-off');
    } else {
        icon.setAttribute('data-feather', 'eye'); 
    }

    
    feather.replace(); 
});
</script>
@endsection

