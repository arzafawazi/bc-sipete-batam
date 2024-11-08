@yield('css')
@vite(['resources/scss/app.scss', 'resources/scss/icons.scss'])
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
<style>
                        /* Menyesuaikan Select2 dengan bootstrap */
.select2-container .select2-selection--single {
    height: calc(2.25rem + 2px) !important;  /* Sesuaikan dengan tinggi input Bootstrap */
    padding: .375rem .75rem;  /* Sesuaikan padding dengan input di Bootstrap */
    border-radius: .375rem;   /* Sesuaikan border-radius dengan input Bootstrap */
    border: 1px solid #ced4da;  /* Sesuaikan border dengan input Bootstrap */
}

.select2-container .select2-selection--multiple {
    height: auto;
    padding: .375rem .75rem;
    border-radius: .375rem;
    border: 1px solid #ced4da;
}

.select2-container .select2-selection--single .select2-selection__rendered {
    line-height: 1.5;  /* Menyesuaikan jarak teks dengan input */
}

.select2-container--bootstrap-5 .select2-selection--single {
    background-color: #ffffff;  /* Pastikan background tetap putih */
}

.select2-container--bootstrap-5 .select2-dropdown {
    background-color: #ffffff;  /* Sesuaikan dengan dropdown */
    border: 1px solid #ced4da;
    border-radius: .375rem;
    box-shadow: 0 0.5rem 1rem rgba(0,0,0,.15);
}

/* Pastikan dropdown memiliki lebar 100% */
.select2-container--bootstrap-5 .select2-dropdown {
    width: 100% !important;
}

                        </style>
