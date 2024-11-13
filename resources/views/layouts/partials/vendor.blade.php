<!-- Vendor -->
<script src="assets/libs/jquery/jquery.min.js"></script> 
<!-- <script src="assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script> -->
<!-- <script src="assets/libs/simplebar/simplebar.min.js"></script> -->
<!-- <script src="assets/libs/node-waves/waves.min.js"></script> -->
<!-- <script src="assets/libs/waypoints/lib/jquery.waypoints.min.js"></script> -->
<!-- <script src="assets/libs/jquery.counterup/jquery.counterup.min.js"></script> -->
<!-- <script src="assets/libs/feather-icons/feather.min.js"></script> -->


@yield('script')
@vite(['resources/js/app.js'])
<script type="module" src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script> <!-- jQuery -->
<script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script> <!-- Select2 -->
<script src="https://unpkg.com/feather-icons"></script>
<script>
    window.addEventListener('load', function() {
        document.body.style.opacity = '1';
    });
</script>
@yield('script-bottom')
