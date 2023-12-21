<html>
	<head>
		<title>Login Handler</title>
	</head>
	<body>
		<?php
			session_start();
include ('Database Connection file/mysqli_connect.php');

//Cek Login, terdaftar atau tidak
if(isset($_POST['login-button'])){
    $username = $_POST['username'];
    $password = $_POST['password'];

    //cocokin dengan database, ada atau ngga datanya
    $cek_users = mysqli_query($koneksi, "SELECT * FROM users WHERE username='$username' AND password='$password'");
    //hitung jumlah data
    $data = mysqli_fetch_array($cek_users);

    if($data > 0){
      $_SESSION['login'] = 'True';
      $_SESSION['name'] = $data['name'];
      $_SESSION['username'] = $data['username'];
      $cek = mysqli_fetch_assoc($cek_users);
      echo "<script> alert('Login Berhasil!');window.location = 'customer_homepage';</script>;";
    } else {
      echo "<script>window.location='login.php?pesan=gagal';</script>";
    }
}
		?>
	</body>
</html>