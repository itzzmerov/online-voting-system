<?php include 'includes/session.php'; ?>
<?php include 'includes/header.php'; ?>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <?php include 'includes/navbar.php'; ?>
  <?php include 'includes/menubar.php'; ?>

  <div class="content-wrapper">
    <section class="content-header">
      <h1>
        Manage Ballot Position
      </h1>
    </section>
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
        <div class="col-xs-10 col-xs-offset-1" id="content">
        </div>
      </div>
      
    </section>

    
  </div>
</div>

<?php include 'includes/scripts.php'; ?>

<script>
  $(function(){
    fetch();

    $(document).on('click', '.reset', function(e){
      e.preventDefault();
      var desc = $(this).data('desc');
      $('.'+desc).iCheck('uncheck');
    });

    $(document).on('click', '.moveup', function(e){
      e.preventDefault();
      var id = $(this).data('id');
      $('#'+id).animate({
        'marginTop' : "-300px"
      });
      $.ajax({
        type: 'POST',
        url: 'ballot_up.php',
        data:{id:id},
        dataType: 'json',
        success: function(response){
          if(!response.error){
            fetch();
          }
        }
      });
    });

    $(document).on('click', '.movedown', function(e){
      e.preventDefault();
      var id = $(this).data('id');
      $('#'+id).animate({
        'marginTop' : "+300px"
      });
      $.ajax({
        type: 'POST',
        url: 'ballot_down.php',
        data:{id:id},
        dataType: 'json',
        success: function(response){
          if(!response.error){
            fetch();
          }
        }
      });
    });

  });

  function fetch(){
    $.ajax({
      type: 'POST',
      url: 'ballot_fetch.php',
      dataType: 'json',
      success: function(response){
        $('#content').html(response).iCheck({checkboxClass: 'icheckbox_flat-green',radioClass: 'iradio_flat-green'});
      }
    });
  }
</script>
</body>
</html>
