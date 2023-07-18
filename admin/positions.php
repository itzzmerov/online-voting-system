<?php include 'includes/session.php'; ?>
<?php include 'includes/header.php'; ?>
<body class="hold-transition skin-blue sidebar-mini">
  <div class="wrapper">

    <?php include 'includes/navbar.php'; ?>
    <?php include 'includes/menubar.php'; ?>

    <div class="content-wrapper">
      <section class="content-header">
        <h1>
          Manage Positions
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
          <div class="col-xs-12">
            <div class="box">
              <div class="box-header with-border">
                <a href="#addnew" data-toggle="modal" class="btn btn-primary btn-sm btn-flat"><i class="fa fa-plus"></i> New</a>
              </div>
              <div class="box-body">
                <table id="example1" class="table table-bordered">
                  <thead>
                    <th class="hidden"></th>
                    <th>Description</th>
                    <th>Maximum Vote</th>
                    <th>Actions</th>
                  </thead>
                  <tbody>
                    <?php
                      $sql = "SELECT * FROM positions ORDER BY priority ASC";
                      $query = $conn->query($sql);
                      while($row = $query->fetch_assoc()){
                        echo "
                          <tr>
                            <td class='hidden'></td>
                            <td>".$row['description']."</td>
                            <td>".$row['max_vote']."</td>
                            <td>
                              <button class='btn btn-success btn-sm edit btn-flat' data-id='".$row['id']."'><i class='fa fa-edit'></i> Edit</button>
                              <button class='btn btn-danger btn-sm delete btn-flat' data-id='".$row['id']."'><i class='fa fa-trash'></i> Delete</button>
                            </td>
                          </tr>
                        ";
                      }
                    ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </section>   
    </div>
    <?php include 'includes/positions_modal.php'; ?>
  </div>
  <?php include 'includes/scripts.php'; ?>
  <script>
  $(function(){
    $(document).on('click', '.edit', function(e){
      e.preventDefault();
      $('#edit').modal('show');
      var id = $(this).data('id');
      getRow(id);
    });

    $(document).on('click', '.delete', function(e){
      e.preventDefault();
      $('#delete').modal('show');
      var id = $(this).data('id');
      getRow(id);
    });

  });

  function getRow(id){
    $.ajax({
      type: 'POST',
      url: 'positions_row.php',
      data: {id:id},
      dataType: 'json',
      success: function(response){
        $('.id').val(response.id);
        $('#edit_description').val(response.description);
        $('#edit_max_vote').val(response.max_vote);
        $('.description').html(response.description);
      }
    });
  }
  </script>
</body>
</html>
