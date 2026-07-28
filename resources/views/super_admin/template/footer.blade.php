  <!-- Footer -->
  <footer class="main-footer" style="border-top: 2px solid #e0e7ff; background:#fff;">
    <div class="float-right d-none d-sm-block">
      <i class="fas fa-shield-alt mr-1" style="color: #3730a3;"></i>
      <strong>Super Admin Panel</strong>
    </div>
    <strong>Copyright &copy; {{ date('Y') }}
      <a href="#" style="color: #3730a3;">E-PPID PT Garam (Persero)</a>
    </strong>
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark"></aside>
</div>
<!-- ./wrapper -->

<!-- jQuery (sudah di-load di header) -->
{{-- <script src="{{ url('/') }}/assets_user/plugins/jquery/jquery.min.js"></script> --}}
<!-- Bootstrap 4 -->
<script src="{{ url('/') }}/assets_user/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- DataTables -->
<script src="{{ url('/') }}/assets_user/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="{{ url('/') }}/assets_user/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="{{ url('/') }}/assets_user/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="{{ url('/') }}/assets_user/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<!-- AdminLTE App -->
<script src="{{ url('/') }}/assets_user/dist/js/adminlte.min.js"></script>
<!-- SweetAlert2 -->
<script src="{{ url('/') }}/assets_user/plugins/sweetalert2/sweetalert2.min.js"></script>
<!-- Toastr -->
<script src="{{ url('/') }}/assets_user/plugins/toastr/toastr.min.js"></script>
<script>
  $(document).ready(function () {
    // Toastr default options
    toastr.options = { positionClass: 'toast-top-right', timeOut: 3500 };
  });
</script>
</body>
</html>
