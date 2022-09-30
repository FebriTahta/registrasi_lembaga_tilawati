<!-- Footer -->
<footer class="content-footer footer bg-footer-theme">
    <div class="container-xxl d-flex flex-wrap justify-content-between py-2 flex-md-row flex-column">
      <div class="mb-2 mb-md-0">
        ©
        <script>
          document.write(new Date().getFullYear());
        </script>
        -
        <a href="#"class="footer-link fw-bolder">TILAWATI PUSAT</a>
      </div>
      <div>
        <a
          href="#"
          class="footer-link me-4"
          >DOKUMENTASI</a
        >
      </div>
    </div>
  </footer>
  <!-- / Footer -->

  <div class="content-backdrop fade"></div>
</div>
<!-- Content wrapper -->
</div>
<!-- / Layout page -->
</div>

<!-- Overlay -->
<div class="layout-overlay layout-menu-toggle"></div>
</div>
<!-- / Layout wrapper -->

{{-- <div class="buy-now">
<a
href="https://themeselection.com/products/sneat-bootstrap-html-admin-template/"
target="_blank"
class="btn btn-danger btn-buy-now"
>Upgrade to Pro</a
>
</div> --}}

<!-- Core JS -->
<!-- build:js assets/vendor/js/core.js -->
<script src=" {{asset('assets/vendor/libs/jquery/jquery.js')}}"></script>
<script src=" {{asset('assets/vendor/libs/popper/popper.js')}}"></script>
<script src=" {{asset('assets/vendor/js/bootstrap.js')}}"></script>
<script src=" {{asset('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js')}}"></script>

<script src=" {{asset('assets/vendor/js/menu.js')}}"></script>
<!-- endbuild -->

<!-- Vendors JS -->
<script src=" {{asset('assets/vendor/libs/apex-charts/apexcharts.js')}}"></script>

<!-- Main JS -->
<script src=" {{asset('assets/js/main.js')}}"></script>

<!-- Page JS -->
<script src=" {{asset('assets/js/dashboards-analytics.js')}}"></script>

<!-- Place this tag in your head or just before your close body tag. -->
<script async defer src="https://buttons.github.io/buttons.js"></script>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.2.0/sweetalert2.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.2.0/sweetalert2.all.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
@yield('script')

</body>
</html>
