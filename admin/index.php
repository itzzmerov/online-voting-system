<?php
  	session_start();
  	if(isset($_SESSION['admin'])){
    	header('location:home.php');
  	}
?>
<?php include 'includes/header.php'; ?>

<body class="hold-transition login-page">
	<div class="login-box">
		<div class="login-logo">
			<b>e-Vox Admin Panel</b>
		</div>
	
		<div class="login-box-body">
			<p class="login-box-msg">Log into your account to manage election!</p>

			<form action="login.php" method="POST">
				<div class="form-group has-feedback">
					<input type="text" class="form-control login-input" name="username" placeholder="Username" required>
				</div>
				<div class="form-group has-feedback">
					<input type="password" class="form-control login-input" name="password" placeholder="Password" required>
				</div>
				<div class="row"> 
					<div class="col-xs-4">
						<button type="submit" class="btn btn-primary btn-block btn-flat login-btn" name="login">LogIn</button>
					</div>
				</div>
			</form>
		</div>
		<?php
			if(isset($_SESSION['error'])){
				echo "
					<div class='callout callout-danger text-center mt20'>
						<p>".$_SESSION['error']."</p> 
					</div>
				";
				unset($_SESSION['error']);
			}
		?>
	</div>
		
	<?php include 'includes/scripts.php' ?>
</body>
</html>