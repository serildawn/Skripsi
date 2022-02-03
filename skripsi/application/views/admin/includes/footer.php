</div>
<footer class="footer">
  <div class=" container-fluid ">

    <div class="copyright" id="copyright">
      &copy; <script>
        document.getElementById('copyright').appendChild(document.createTextNode(new Date().getFullYear()))
      </script>, Designed by <a href="https://www.invisionapp.com" target="_blank">Invision</a>. Coded by <a href="https://www.creative-tim.com" target="_blank">Creative Tim</a>.
    </div>
  </div>
</footer>
</div>
</div>
<!--   Core JS Files   -->
<script src="<?php echo base_url("assets/") ?>js/core/popper.min.js"></script>
<script src="<?php echo base_url("assets/") ?>js/core/bootstrap.min.js"></script>
<script src="<?php echo base_url("assets/") ?>js/plugins/perfect-scrollbar.jquery.min.js"></script>
<!--  Google Maps Plugin    -->
<!-- Chart JS -->
<script src="<?php echo base_url("assets/") ?>js/plugins/chartjs.min.js"></script>
<!--  Notifications Plugin    -->
<script src="<?php echo base_url("assets/") ?>js/plugins/bootstrap-notify.js"></script>
<!-- Control Center for Now Ui Dashboard: parallax effects, scripts for the example pages etc -->
<script src="<?php echo base_url("assets/") ?>js/now-ui-dashboard.min.js?v=1.5.0" type="text/javascript"></script><!-- Now Ui Dashboard DEMO methods, don't include it in your project! -->
<script src="<?php echo base_url("assets/") ?>demo/demo.js"></script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>

<!-- export_file -->
<script src="https://cdn.datatables.net/buttons/1.6.1/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.flash.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.print.min.js"></script>

<script>
  $(document).ready(function() {
    $('.aso-datatable-clean').DataTable();


    $('.aso-datatable-scroll').DataTable({
      "scrollY": "40vh",
      "scrollCollapse": true,
      "paging": false
    });


    const table = $('.aso-datatable-export').DataTable({
      dom: 'Bfrtip',
      buttons: [{
        extend: 'excel',
        text: "Export Excel",
        className: "btn btn-primary btn-sm",
      }, {
        extend: 'print',
        text: "Print",
        className: "btn btn-primary btn-sm",
      }, {
        extend: 'pdfHtml5',
        text: 'Export PDF',
        className: "btn btn-primary btn-sm",
        customize: function(doc) {
          doc.content[1].table.widths =
            Array(doc.content[1].table.body[0].length + 1).join('*').split('');
        }
      }],
      initComplete: function(settings, json) {
        $(".dt-button").removeClass("dt-button");
      },
    });
  });

  var s_url = "<?php echo base_url($this->uri->segment(1)); ?>";
  $('.nav').find('a[href="' + s_url + '"]').parent().addClass('active');
  $('.nav').find('a[href="' + s_url + '"]').parents('.collapse').addClass('show');
</script>
</body>

</html>