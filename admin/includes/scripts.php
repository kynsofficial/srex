<!-- Core JS -->
<!-- build:js assets/vendor/js/core.js -->
<script src="<?php echo $settings['site_url']; ?>assets/vendor/libs/jquery/jquery.js"></script>
<script src="<?php echo $settings['site_url']; ?>assets/vendor/libs/popper/popper.js"></script>
<script src="<?php echo $settings['site_url']; ?>assets/vendor/js/bootstrap.js"></script>
<script src="<?php echo $settings['site_url']; ?>assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>

<script src="<?php echo $settings['site_url']; ?>assets/vendor/libs/hammer/hammer.js"></script>
<script src="<?php echo $settings['site_url']; ?>assets/vendor/libs/i18n/i18n.js"></script>
<script src="<?php echo $settings['site_url']; ?>assets/vendor/libs/typeahead-js/typeahead.js"></script>

<script src="<?php echo $settings['site_url']; ?>assets/vendor/js/menu.js"></script>
<!-- endbuild -->

<!-- Vendors JS -->

<!-- Flat Picker -->
<script src="<?php echo $settings['site_url']; ?>assets/vendor/libs/moment/moment.js"></script>
<script src="<?php echo $settings['site_url']; ?>assets/vendor/libs/flatpickr/flatpickr.js"></script>

<script src="<?php echo $settings['site_url']; ?>assets/vendor/libs/select2/select2.js"></script>
<script src="<?php echo $settings['site_url']; ?>assets/vendor/libs/bootstrap-select/bootstrap-select.js"></script>
<script src="<?php echo $settings['site_url']; ?>assets/vendor/libs/bloodhound/bloodhound.js"></script>
<script src="<?php echo $settings['site_url']; ?>assets/vendor/libs/formvalidation/dist/js/FormValidation.min.js"></script>
<script src="<?php echo $settings['site_url']; ?>assets/vendor/libs/formvalidation/dist/js/plugins/Bootstrap5.min.js"></script>
<script src="<?php echo $settings['site_url']; ?>assets/vendor/libs/formvalidation/dist/js/plugins/AutoFocus.min.js"></script>

<!-- Main JS -->
<script src="<?php echo $settings['site_url']; ?>assets/js/main.js"></script>
<script src="<?php echo $settings['site_url']; ?>assets/js/ui-modals.js"></script>

<!-- Page JS -->
<script src="<?php echo $settings['site_url']; ?>assets/js/dashboards-ecommerce.js"></script>
<script src="<?php echo $settings['site_url']; ?>assets/js/pages-profile.js"></script>
<script src="<?php echo $settings['site_url']; ?>assets/js/forms-selects.js"></script>
<script src="<?php echo $settings['site_url']; ?>assets/js/forms-typeahead.js"></script>
<script src="<?php echo $settings['site_url']; ?>assets/vendor/libs/bootstrap-maxlength/bootstrap-maxlength.js"></script>
<script src="<?php echo $settings['site_url']; ?>assets/js/tables-datatables-basic.js"></script>
<script src="<?php echo $settings['site_url']; ?>assets/js/offcanvas-add-payment.js"></script>
<script src="<?php echo $settings['site_url']; ?>assets/js/offcanvas-send-invoice.js"></script>
<script src="<?php echo $settings['site_url']; ?>assets/vendor/libs/cleavejs/cleave.js"></script>
<script src="<?php echo $settings['site_url']; ?>assets/vendor/libs/cleavejs/cleave-phone.js"></script>
<!-- <script src="<?php echo $settings['site_url']; ?>assets/vendor/libs/apex-charts/apexcharts.js"></script> -->
<script src="<?php echo $settings['site_url']; ?>assets/vendor/libs/datatables.net/jquery.dataTables.js"></script>
<script src="<?php echo $settings['site_url']; ?>assets/vendor/libs/datatables.net-bs4/dataTables.bootstrap4.js"></script>
<!-- <script src="<?php echo $settings['site_url']; ?>assets/js/dataTables.select.min.js"></script>
<script src="<?php echo $settings['site_url']; ?>assets/vendor/libs/jszip/jszip.js"></script>
<script src="<?php echo $settings['site_url']; ?>assets/vendor/libs/pdfmake/pdfmake.js"></script>
<script src="<?php echo $settings['site_url']; ?>assets/vendor/libs/datatables-buttons/buttons.html5.js"></script>
<script src="<?php echo $settings['site_url']; ?>assets/vendor/libs/datatables-buttons/buttons.print.js"></script> -->
<script src="<?php echo $settings['site_url']; ?>assets/js/app-chat.js"></script>
<script src="<?php echo $settings['site_url']; ?>assets/vendor/libs/quill/katex.js"></script>
<script src="<?php echo $settings['site_url']; ?>assets/vendor/libs/quill/quill.js"></script>
<script src="<?php echo $settings['site_url']; ?>assets/js/forms-editors.js"></script>
<script>
  $(function () {
    <?php for ($i=1; $i <= 100; $i++) {
      echo '
      $("#example'.$i.'").DataTable({
        "paging": true,
        "lengthChange": true,
        "searching": true,
        "ordering": false,
        "info": true,
        "autoWidth": false,
        "responsive": true,
      });
      ';
    } ?>
  });
</script>
