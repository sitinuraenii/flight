<?php
	session_start();
  
  if (isset($_GET['selectedSchedulesId'])) {
    $_SESSION['selectedSchedulesId'] = $_GET['selectedSchedulesId'];
  } else {
    // Set nilai default atau tampilkan pesan kesalahan jika diperlukan
    $_SESSION['selectedSchedulesId'] = null;
    // atau redirect ke halaman lain, sesuai kebutuhan aplikasi Anda
  }
?>
<html>
	<head>
		<title>
			View Available Flights
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
    			margin: 0px 390px
			}
			table {
			 border-collapse: collapse; 
			}
			tr/*:nth-child(3)*/ {
			 border: solid thin;
			}
		</style>
		<link rel="stylesheet" type="text/css" href="css/style.css"/>
		<link rel="stylesheet" href="font-awesome-4.7.0\css\font-awesome.min.css">
	</head>
	<body>
		<img class="logo" src="images/shutterstock_22.jpg"/> 
		<h1 id="title">
		AIRLINES
		</h1>
		<div>
			<ul>
				<li><a href="home_page.php"><i class="fa fa-home" aria-hidden="true"></i> Home</a></li>
				<li><a href="customer_homepage.php"><i class="fa fa-desktop" aria-hidden="true"></i> Dashboard</a></li>
				<li><a href="home_page.php"><i class="fa fa-plane" aria-hidden="true"></i> About Us</a></li>
				<li><a href="home_page.php"><i class="fa fa-phone" aria-hidden="true"></i> Contact Us</a></li>
				<li><a href="logout_handler.php"><i class="fa fa-sign-out" aria-hidden="true"></i> Logout</a></li>
			</ul>
		</div>
		<h2>AVAILABLE FLIGHTS</h2>
		<?php
			if(isset($_POST['Search']))
			{
				$data_missing=array();
				if(empty($_POST['asal']))
					{
						$data_missing[]='asal';
					}
				else
					{
						$nama_bandara=$_POST['asal'];
					}

				if(empty($_POST['tujuan']))
					{
						$data_missing[]='tujuan';
					}
				else
					{
						$nama_bandara=$_POST['tujuan'];
					}


				if(empty($_POST['time_start']))
					{
						$data_missing[]='time_start';
					}
				else
					{
						$time_start=trim($_POST['time_start']);
					}

				if(empty($_POST['class']))
					{
						$data_missing[]='class';
					}
				else
          {
            $class=trim($_POST['class']);
          }

				// print_r($data_missing);
				if(empty($data_missing))
				{
					$count=1;
					$_SESSION['count']=$count;
					require_once('Database Connection file/mysqli_connect.php');

            $bandara_asal = $_POST['asal'];
            // print('asal'.$bandara_asal);
            $bandara_tujuan = $_POST['tujuan'];
            // print('tujutan'.$bandara_tujuan);
            $time_start = $_POST['time_start']." ";
            // print('time'.$time_start);
            $class = $_POST['class'];
   

            $query = "SELECT 
                schedules.id AS 'id_schedules', 
                airports_asal.nama_bandara AS 'bandara_asal', 
                airports_tujuan.nama_bandara AS 'bandara_tujuan', 
                schedules.time_start AS 'waktu_keberangkatan', 
                schedules.time_end AS 'waktu_kedatangan', 
                schedules.class AS 'kelas', 
                schedules.harga AS 'harga', 
                airlines.nama_airline AS 'maskapai' 
            FROM schedules 
            LEFT JOIN routes ON routes.id = schedules.id_routes 
            LEFT JOIN airports AS airports_asal ON airports_asal.id = routes.id_bandara_asal 
            LEFT JOIN airports AS airports_tujuan ON airports_tujuan.id = routes.id_bandara_tujuan 
            LEFT JOIN airlines ON airlines.id = routes.id_airline 
            WHERE routes.id_bandara_asal = '$bandara_asal'
                AND routes.id_bandara_tujuan = '$bandara_tujuan'
                AND DATE(schedules.time_start) = DATE('$time_start')
                AND schedules.class = '$class'
            ORDER BY schedules.time_start";
            $result = mysqli_query($dbc, $query);

            

            if ($result) {
              echo '<table border="1">
              <tr>
                  <th>Bandara Asal</th>
                  <th>Bandara Tujuan</th>
                  <th>Waktu Keberangkatan</th>
                  <th>Waktu Kedatangan</th>
                  <th>Kelas</th>
                  <th>Harga</th>
                  <th>Maskapai</th>
                  <th>Aksi</th>
              </tr>';

              while ($row = mysqli_fetch_assoc($result)) {
                echo '<tr>';
                echo '<td>' . $row['bandara_asal'] . '</td>';
                echo '<td>' . $row['bandara_tujuan'] . '</td>';
                echo '<td>' . $row['waktu_keberangkatan'] . '</td>';
                echo '<td>' . $row['waktu_kedatangan'] . '</td>';
                echo '<td>' . $row['kelas'] . '</td>';
                echo '<td>' . $row['harga'] . '</td>';
                echo '<td>' . $row['maskapai'] . '</td>';
				//echo "<script>window.location='pilih_seat.php';</script>";
                echo '<td><a href="pilih_seat.php ?selectedSchedulesId=' . $row['id_schedules'] . '&selectedClass=' . $row['kelas'] . '">Booked</a></td>';
                echo '</tr>';
              }
              echo '</table>';
            } else {
              echo "Tidak ada penerbangan yang tersedia. Error: " . mysqli_error($dbc);
           }

				}
			}
			else
			{
				print('masuk3');
				echo "Search request not received";
			}
		?>
	</body>
</html>