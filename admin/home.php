<?php include 'includes/session.php'; ?>
<?php include 'includes/slugify.php'; ?>
<?php include 'includes/header.php'; ?>
<body class="hold-transition skin-blue sidebar-mini">
  <div class="wrapper">

    <?php include 'includes/navbar.php'; ?>
    <?php include 'includes/menubar.php'; ?>

    <div class="content-wrapper">

      <section class="content">
        <?php
          if(isset($_SESSION['error'])){
            echo "
              <div class='alert alert-danger alert-dismissible'>
                <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                <h4><i class='icon fa fa-warning'></i> Error!</h4>
                ".$_SESSION['error']."
              </div>
            ";
            unset($_SESSION['error']);
          }
          if(isset($_SESSION['success'])){
            echo "
              <div class='alert alert-success alert-dismissible'>
                <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                <h4><i class='icon fa fa-check'></i> Success!</h4>
                ".$_SESSION['success']."
              </div>
            ";
            unset($_SESSION['success']);
          }
        ?>

        <div class="row">
          <div class="col-xs-12">
            <h3>Votes Tally
              <span class="pull-right">
                <a href="print.php" class="btn btn-success btn-sm btn-flat"><span class="glyphicon glyphicon-print"></span> Print</a>
              </span>
            </h3>
          </div>
        </div> <br /><br />

        <?php
          $sql = "SELECT * FROM positions ORDER BY priority ASC";
          $query = $conn->query($sql);
          $inc = 2;
          while($row = $query->fetch_assoc()){
            $inc = ($inc == 2) ? 1 : $inc+1; 
            if($inc == 1) echo "<div class='row'>";
            echo "
              <div class='col-sm-6'>
                <div class='box box-solid'>
                  <div class='box-header with-border'>
                    <h4 class='box-title'><b>".$row['description']."</b></h4>
                  </div>
                  <div class='box-body'>
                    <div class='chart'>
                      <canvas id='".slugify($row['description'])."' style='height:200px'></canvas>
                    </div>
                  </div>
                </div>
              </div>
            ";
            if($inc == 2) echo "</div>";  
          }
          if($inc == 1) echo "<div class='col-sm-6'></div></div>";
        ?>

        </section>
      </div>

  </div>

  <?php include 'includes/scripts.php'; ?>
  <?php
    $sql = "SELECT * FROM positions ORDER BY priority ASC";
    $query = $conn->query($sql);
    while($row = $query->fetch_assoc()){
      $sql = "SELECT * FROM candidates WHERE position_id = '".$row['id']."'";
      $cquery = $conn->query($sql);
      $carray = array();
      $varray = array();
      while($crow = $cquery->fetch_assoc()){
        array_push($carray, $crow['lastname']);
        $sql = "SELECT * FROM votes WHERE candidate_id = '".$crow['id']."'";
        $vquery = $conn->query($sql);
        array_push($varray, $vquery->num_rows);
      }
      $carray = json_encode($carray);
      $varray = json_encode($varray);
      ?>
      <script>
      $(function(){
        var rowid = '<?php echo $row['id']; ?>';
        var description = '<?php echo slugify($row['description']); ?>';
        var barChartCanvas = $('#'+description).get(0).getContext('2d')
        var barChart = new Chart(barChartCanvas)
        var barChartData = {
          labels  : <?php echo $carray; ?>,
          datasets: [
            {
              label               : 'Votes',
              fillColor           : 'rgba(60,141,188,0.9)',
              strokeColor         : 'rgba(60,141,188,0.8)',
              pointColor          : '#3b8bba',
              pointStrokeColor    : 'rgba(60,141,188,1)',
              pointHighlightFill  : '#fff',
              pointHighlightStroke: 'rgba(60,141,188,1)',
              data                : <?php echo $varray; ?>
            }
          ]
        }
        var barChartOptions                  = {
          scaleBeginAtZero        : true,
          scaleShowGridLines      : true,
          scaleGridLineColor      : 'rgba(0,0,0,.05)',
          scaleGridLineWidth      : 1,
          scaleShowHorizontalLines: true,
          scaleShowVerticalLines  : true,
          barShowStroke           : true,
          barStrokeWidth          : 2,
          barValueSpacing         : 5,
          barDatasetSpacing       : 1,
          legendTemplate          : '<ul class="<%=name.toLowerCase()%>-legend"><% for (var i=0; i<datasets.length; i++){%><li><span style="background-color:<%=datasets[i].fillColor%>"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>',
          responsive              : true,
          maintainAspectRatio     : true
        }

        barChartOptions.datasetFill = false
        var myChart = barChart.HorizontalBar(barChartData, barChartOptions)
      });
      </script>
      <?php
    }
  ?>
</body>
</html>
