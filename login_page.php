<?php
	session_start();
	include ('Database Connection file/mysqli_connect.php');
	
	//Cek Login, terdaftar atau tidak
	if(isset($_POST['login-button'])){
		$username = $_POST['username'];
		$password = $_POST['password'];
	
		//cocokin dengan database, ada atau ngga datanya
		$cek_users = mysqli_query($dbc, "SELECT * FROM users WHERE username='$username' AND password='$password'");
		//hitung jumlah data
		$data = mysqli_fetch_array($cek_users);
	
		if($data > 0){
		  $_SESSION['login'] = 'True';
		  $_SESSION['name'] = $data['name'];
		  $_SESSION['username'] = $data['username'];
		  $cek = mysqli_fetch_assoc($cek_users);
		  echo "<script> alert('Login Berhasil!');window.location = 'customer_homepage.php';</script>;";
		} else {
		  echo "<script>window.location='login_page.php?pesan=gagal';</script>";
		}
	}
?>

<html>
	<head>
		<title>
			Account Login
		</title>
		<style>
			input {
    			border: 1.5px solid #030337;
    			border-radius: 4px;
    			padding: 7px 30px;
			}
			input[type=submit] {
				background-color: #030337;
				color: white;
    			border-radius: 4px;
    			padding: 7px 45px;
    			margin: 0px 60px
			}
		</style>
		<link rel="stylesheet" type="text/css" href="css/style.css"/>
		<link rel="stylesheet" href="font-awesome-4.7.0\css\font-awesome.min.css">
	</head>
	<body>
  <img class="logo" src="images/irctc.jpg"/>
		<h1 id="title">
			IRCTC Airways	</h1>
		<div>
			<ul>
				<li><a href="home_page.php"><i class="fa fa-home" aria-hidden="true"></i> Home</a></li>
				<li><a href="home_page.php"><i class="fa fa-plane" aria-hidden="true"></i> About Us</a></li>
				<li><a href="home_page.php"><i class="fa fa-phone" aria-hidden="true"></i> Contact Us</a></li>
				<li><a href="login_page.php"><i class="fa fa-sign-in" aria-hidden="true"></i> Login</a></li>
			</ul>
		</div>
		<br>
		<br>
		<br>
		<form class="float_form" style="padding-left: 40px"  method="POST">
			<fieldset>
				<legend>Login Details:-</legend>
				<strong>Username:</strong><br>
				<input type="text" name="username" placeholder="Enter your username" required><br><br>
				<strong>Password:</strong><br>
				<input type="password" name="password" placeholder="Enter your password" required><br><br>
				<?php
					if(isset($_GET['msg']) && $_GET['msg']=='failed')
					{
						echo "<br>
						<strong style='color:red'>Invalid Username/Password</strong>
						<br><br>";
					}
				?>
				<input type="submit" name="login-button" value="Login">
			</fieldset>
			<br>
			<a href="new_user.php"><i class="fa fa-user-plus" aria-hidden="true"></i> Create New User Account?</a>
		</form>
	</body>
</html>