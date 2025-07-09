@extends('layouts.auth', ['title' => 'Login'])
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('css/login.css') }}">
<meta name="csrf-token" content="{{ csrf_token() }}">

@section('content')
    <div class="full-screen">
        <!-- Left Side - Mascot Animation -->
        <div class="left-side">
            <video autoplay loop muted playsinline>
                <source src="{{ asset('videos/bea-cukai.mp4') }}" type="video/mp4">
                Browser Anda tidak mendukung video.
            </video>
        </div>

        <!-- Right Side - Login Form -->
        <div class="right-side">
            <div class="login-card">
                <div class="logo-section">
                    <div class="logo-badge">
                        <img src="{{ asset('images/bea.png') }}" alt="logo" height="120" class="mb-3" />
                    </div>
                    <h1 class="brand-title">KPU BEA CUKAI TIPE B BATAM</h1>
                    <h2 class="brand-subtitle">SIPETE</h2>
                    <p class="welcome-text">Silahkan masukkan kredensial Anda</p>
                </div>

                <!-- Alert Container untuk pesan AJAX -->
                <div id="alertContainer"></div>

                <form id="loginForm">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}"">
                    
                    <div class="form-group">
                        <label for="name" class="form-label">Nama</label>
                        <div class="input-wrapper">
                            <i class="fas fa-user input-icon"></i>
                            <input type="text" id="name" name="name" class="form-control"
                                placeholder="Masukkan Nama Anda" required autocomplete="name">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="password" class="form-label">Password</label>
                        <div class="input-wrapper password-wrapper">
                            <i class="fas fa-lock input-icon"></i>

                            <input type="password" id="password" name="password" class="form-control"
                                placeholder="Masukkan password Anda" required autocomplete="current-password">

                            <!-- Tombol Toggle -->
                            <button type="button" class="toggle-password" id="togglePassword" aria-label="Toggle Password">
                                <i id="eyeIcon" data-feather="eye-off"></i>
                            </button>
                        </div>
                    </div>

                    <button type="submit" class="btn-login" id="loginBtn">
                        <span class="btn-text">Login</span>
                        <span class="btn-loading">
                            <div class="spinner"></div>
                        </span>
                    </button>
                </form>
            </div>
        </div>
    </div>

    <script src="https://unpkg.com/feather-icons"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            feather.replace();

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            const passwordField = document.getElementById('password');
            const toggleButton = document.getElementById('togglePassword');
            let isVisible = false;

            toggleButton.addEventListener('click', function() {
                isVisible = !isVisible;
                passwordField.type = isVisible ? 'text' : 'password';
                const newIcon = isVisible ? 'eye' : 'eye-off';
                const eyeIcon = document.getElementById('eyeIcon');
                eyeIcon.outerHTML = `<i id="eyeIcon" data-feather="${newIcon}"></i>`;
                feather.replace();
            });

            $('#loginForm').on('submit', function(e) {
                e.preventDefault();
                
                const loginBtn = $('#loginBtn');
                const btnText = $('.btn-text');
                const btnLoading = $('.btn-loading');
                const alertContainer = $('#alertContainer');
                
                alertContainer.empty();
                
                loginBtn.prop('disabled', true);
                btnText.hide();
                btnLoading.show();
                
                const formData = $('#loginForm').serialize();
                
                $.ajax({
                    url: '{{ route("login") }}',
                    type: 'POST',
                    data: formData,
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'Accept': 'application/json'
                    },
                    beforeSend: function() {
                        {{-- console.log('Sending login request...'); --}}
                        {{-- console.log('Form data:', formData); --}}
                    },
                    success: function(response) {
                        {{-- console.log('Success response:', response); --}}
                        showAlert('success', 'Login berhasil! Mengalihkan...');
                        
                        setTimeout(function() {
                            window.location.href = response.redirect || '{{ url("/home") }}';
                        }, 1500);
                    },
                    error: function(xhr, status, error) {
                        {{-- console.log('Error status:', status); --}}
                        {{-- console.log('Error response:', xhr.responseText); --}}
                        {{-- console.log('XHR object:', xhr); --}}
                        
                        resetButton();
                        
                        if (xhr.status === 422) {
                            const errors = xhr.responseJSON ? xhr.responseJSON.errors : {};
                            let errorMessage = '';
                            
                            Object.keys(errors).forEach(function(key) {
                                errors[key].forEach(function(error) {
                                    errorMessage += '<p class="mb-1">' + error + '</p>';
                                });
                            });
                            
                            showAlert('danger', errorMessage || 'Validation error occurred');
                        } else if (xhr.status === 429) {
                            showAlert('danger', 'Terlalu banyak percobaan login. Silakan coba lagi nanti.');
                        } else if (xhr.status === 302) {
                            console.log('Redirect detected - login successful');
                            showAlert('success', 'Login berhasil! Mengalihkan...');
                            setTimeout(function() {
                                window.location.href = '{{ url("/home") }}';
                            }, 1500);
                        } else {
                            showAlert('danger', 'Terjadi kesalahan: ' + (xhr.responseJSON?.message || error || 'Unknown error'));
                        }
                    },
                    complete: function() {
                        {{-- console.log('Request completed'); --}}
                    }
                });
            });
            
            function resetButton() {
                const loginBtn = $('#loginBtn');
                const btnText = $('.btn-text');
                const btnLoading = $('.btn-loading');
                
                loginBtn.prop('disabled', false);
                btnText.show();
                btnLoading.hide();
            }
            
            function showAlert(type, message) {
                const alertClass = type === 'success' ? 'alert-success' : 'alert-danger';
                const alertHtml = `
                    <div class="alert ${alertClass} alert-dismissible fade show" role="alert">
                        ${message}
                        <button type="button" class="btn-close" onclick="this.parentElement.remove()" aria-label="Close">&times;</button>
                    </div>
                `;
                $('#alertContainer').html(alertHtml);
            }
        });
    </script>

@endsection