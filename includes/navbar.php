<header class="main-header">
  <nav class="navbar navbar-static-top voter-navbar">
    <div class="container">
      <div class="navbar-header">
        <a href="#" class="navbar-brand"><b>e-Vox</b> Voting System</a>
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
          <i class="fa fa-bars"></i>
        </button>
      </div>

      <div class="collapse navbar-collapse pull-left" id="navbar-collapse">
        <ul class="nav navbar-nav">
          <?php
            if(isset($_SESSION['student'])){
              echo "
                <li><a href='index.php'>HOME</a></li>
                <li><a href='transaction.php'>TRANSACTION</a></li>
              ";
            } 
          ?>
        </ul>
      </div>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <li class="user user-menu">
            <a href="#">
              <img src="<?php echo (!empty($voter['photo'])) ? 'images/'.$voter['photo'] : 'images/profile.jpg' ?>" class="user-image" alt="User Image">
              <span class="hidden-xs"><?php echo $voter['firstname'].' '.$voter['lastname']; ?></span>
            </a>
          </li>
          <li><a href="logout.php"><i class="fa fa-sign-out"></i> LOGOUT</a></li>  
        </ul>
      </div>
    </div>
  </nav>
</header>