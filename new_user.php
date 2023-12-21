<html>
	<head>
		<title>
			Create New User Account
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
    			margin: 0px 135px
			}
		</style>
		<link rel="stylesheet" type="text/css" href="css/style.css"/>
		<link rel="stylesheet" href="font-awesome-4.7.0\css\font-awesome.min.css">
	</head>
	<body>
		<img class="logo" src="images/shutterstock_22.jpg"/> 
		<h1 id="title">
			IRCTC Airways		</h1>
		<div>
			<ul>
				<li><a href="home_page.php"><i class="fa fa-home" aria-hidden="true"></i> Home</a></li>
				<li><a href="login_page.php"><i class="fa fa-ticket" aria-hidden="true"></i> Book Tickets</a></li>
				<li><a href="home_page.php"><i class="fa fa-plane" aria-hidden="true"></i> About Us</a></li>
				<li><a href="home_page.php"><i class="fa fa-phone" aria-hidden="true"></i> Contact Us</a></li>
				<li><a href="login_page.php"><i class="fa fa-sign-in" aria-hidden="true"></i> Login</a></li>
			</ul>
		</div>
		<br>
		<form class="center_form" action="new_user_form_handler.php" method="POST" id="new_user_from">
			<h2><i class="fa fa-user-plus" aria-hidden="true"></i> CREATE NEW USER ACCOUNT</h2>
			<br>
			<table cellpadding='10'>
				<strong>ENTER LOGIN DETAILS</strong>
				<tr>
					<td>Nama Lengkap </td>
					<td><input type="text" name="nama" required><br></td>
				</tr>
				<tr>
					<td>Username  </td>
					<td><input type="text" name="username" required><br></td>
				</tr>
				<tr>
					<td>Password  </td>
					<td><input type="password" name="password" required><br></td>
				</tr>
				<tr>
					<td>Email</td>
					<td><input type="text" name="email" required><br></td>
				</tr>
				<tr>
					<td>nik</td>
					<td><input type="text" name="nik" required><br></td>
				</tr>
				<tr>
					<td>tanggal lahir</td>
					<td><input type="date" name="tgl_lahir" required><br></td>
				</tr>
				<tr>
					<td>No Telepon</td>
					<td><input type="text" name="no_telpon" required><br></td>
				</tr>
				<td>
				<label>Gender</label>
            <input type="radio" name="gender" value="L"><label> L</label>
            <input type="radio" name="gender" value="P"><label> P</label><br>
		</tr>
			</table>
			<input type="submit" value="Register" name="register-button">
		</form>
		<a href="login_page.php" class="text-center">Sudah Punya Akun? Silakan Login</a>
	</body>
</html>