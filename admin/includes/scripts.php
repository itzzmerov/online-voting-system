<script src="../bower_components/jquery/dist/jquery.min.js"></script>
<script src="../bower_components/jquery-ui/jquery-ui.min.js"></script>
<script src="../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="../bower_components/moment/moment.js"></script>
<script src="../bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="../bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<script src="../bower_components/chart.js/Chart.js"></script>
<script src="../bower_components/chart.js/Chart.HorizontalBar.js"></script>
<script src="../bower_components/moment/min/moment.min.js"></script>
<script src="../bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>
<script src="../bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<script src="../bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<script src="../bower_components/fastclick/lib/fastclick.js"></script>

<script src="../plugins/iCheck/icheck.min.js"></script>
<script src="../plugins/timepicker/bootstrap-timepicker.min.js"></script>

<script src="../assets/js/adminlte.min.js"></script>

<script>
  $(function(){
    var url = window.location;

    $('ul.sidebar-menu a').filter(function() {
        return this.href == url;
    }).parent().addClass('active');

    $('ul.treeview-menu a').filter(function() {
        return this.href == url;
    }).parentsUntil(".sidebar-menu > .treeview-menu").addClass('active');

  });
</script>

<script>
  $(function () {
    $('#example1').DataTable()
    $('#example2').DataTable({
      'paging'      : true,
      'lengthChange': false,
      'searching'   : false,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : false
    });
  });
</script>

<script>
  $(function(){
    $('#datepicker_add').datepicker({
      autoclose: true,
      format: 'yyyy-mm-dd'
    });
    $('#datepicker_edit').datepicker({
      autoclose: true,
      format: 'yyyy-mm-dd'
    }); 
  });
</script>


