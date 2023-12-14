</div>
<script src="<?= base_url() ?>assets/js/index_admin.js"></script>
<script src="<?= base_url() ?>assets/js/modal_admin.js"></script>
<script src="<?= base_url('assets/js/alert_admin.js') ?>"></script>
<script src="<?= base_url('assets/js/navbar_admin.js') ?>"></script>
<script src="<?= base_url() ?>assets/js/kalender_admin.js"></script>
<script>
     $(document).ready(function() {
          $('#datatable').DataTable({
               "lengthChange": false,
          });
          $('#datatable2').DataTable({
               "lengthChange": false,
          });
          $('#datatable3').DataTable({
               "lengthChange": false,
          });
          $('#datatable4').DataTable({
               "lengthChange": false,
          });
          $('#datatable5').DataTable({
               "lengthChange": false,
          });
     });
</script>
<script>
     window.setTimeout(function() {
          $(".alert").fadeTo(500, 0).slideUp(500, function() {
               $(this).remove();
          });
     }, 3000)
</script>
</body>

</html>