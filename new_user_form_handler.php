<html>
	<head>
		<title>Add New User</title>
	</head>
	<body>
	<?php 
include ('Database Connection file/mysqli_connect.php');
session_start();
 if(isset($_POST['register-button'])){
  $username = $_POST['username'];
  $password = $_POST['password'];
  $nama = $_POST['nama'];
  $email = $_POST['email'];
  $nik = $_POST['nik'];
  $tgl_lahir = $_POST['tgl_lahir'];
  $no_telpon = $_POST['no_telpon'];
  $gender = $_POST['gender'];
  

  $cek_user = mysqli_query($dbc, "SELECT * FROM users WHERE username='$username'");
  $cek_login = mysqli_num_rows($cek_user);

  if($cek_login > 0) {
    echo "<script>window.location='register.php?pesan=gagal';</script>";
  } else {
      $register = mysqli_query($dbc, "INSERT INTO users (username, password, nama, email, nik, tgl_lahir, no_telpon, gender) VALUES ('$username','$password','$nama', '$email', '$nik', '$tgl_lahir', '$no_telpon', '$gender')");
      if($register){
        echo "<script> alert('Registrasi Berhasil, Silakan Login!');window.location = 'login_page.php';</script>;";
      }
    }
  }
?>
	</body>
</html>