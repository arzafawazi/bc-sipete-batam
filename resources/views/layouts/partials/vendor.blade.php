{{-- <script src="assets/libs/jquery/jquery.min.js"></script> 
 <script src="assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script> 
 <script src="assets/libs/simplebar/simplebar.min.js"></script> 
 <script src="assets/libs/node-waves/waves.min.js"></script> 
 <script src="assets/libs/waypoints/lib/jquery.waypoints.min.js"></script> 
 <script src="assets/libs/jquery.counterup/jquery.counterup.min.js"></script> 
 <script src="assets/libs/feather-icons/feather.min.js"></script>  --}}




@yield('script')
@vite(['resources/js/app.js'])
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js"></script>
<script type="module" src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>
<script src="https://unpkg.com/feather-icons"></script>
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script src="https://cdn.jsdelivr.net/npm/flatpickr/dist/l10n/id.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@yaireo/tagify"></script>
<script src="https://cdn.jsdelivr.net/npm/@yaireo/tagify/dist/tagify.polyfills.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/2.2.1/js/dataTables.min.js"></script>
<script src="{{ asset('js/custom.js') }}"></script>
@yield('script-bottom')
