<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Pemilihan Kursi</title>
  <style>
    .seat {
      width: 40px;
      height: 40px;
      margin: 5px;
      display: inline-block;
      background-color: lightgreen;
      border: 1px solid #ccc;
      text-align: center;
      line-height: 40px;
      font-family: Arial, sans-serif;
      cursor: pointer;
    }
    .occupied {
      background-color: red;
      cursor: not-allowed;
    }
  </style>
</head>
<body>
  <h2>Pilih Kursi</h2>
  <div id="seatMap">
    <?php
      require_once('Database Connection file/mysqli_connect.php');
      $selectedSchedulesId = isset($_GET['selectedSchedulesId']) ? $_GET['selectedSchedulesId'] : null;
      $seatClass = isset($_GET['selectedClass']) ? $_GET['selectedClass'] : null;
      $seatClassSafe = mysqli_real_escape_string($koneksi, $seatClass);
      $query_status = "SELECT seats.*
        FROM seats
        JOIN aircrafts ON seats.id_aircraft = aircrafts.id
        JOIN airlines ON aircrafts.id_airline = airlines.id
        JOIN routes ON routes.id_airline = airlines.id
        RIGHT JOIN schedules ON schedules.id_routes = routes.id
        WHERE airlines.id = routes.id_airline
          AND schedules.id = $selectedSchedulesId
          AND seats.tipe_kelas = '$seatClassSafe'";
    
      // Contoh data kursi dari database
      $seats = [];

      $result = mysqli_query($koneksi, $query_status);

      if ($result) {
       while ($row = mysqli_fetch_assoc($result)) {
           $kode_seat = $row['kode_seat'];
           $status = $row['status'];
   
           // Jika status kursi sudah 'booked', ubah status di dalam array
           if ($status === 'booked') {
               $seats[] = ['seatNumber' => $kode_seat, 'status' => 'booked'];
           } else {
               $seatClass = isset($_GET['selectedClass']) ? $_GET['selectedClass'] : null;
               $selectedSchedulesId = isset($_GET['selectedSchedulesId']) ? $_GET['selectedSchedulesId'] : null;
   
               $seats[] = ['seatNumber' => $kode_seat, 'status' => 'available'];
           }
       }
   } else {
       echo "Error: " . $query_status . "<br>" . mysqli_error($koneksi);
   }

      foreach ($seats as $seat) {
        echo '<div class="seat';
        if ($seat['status'] === 'booked') {
          echo ' occupied" title="Kursi sudah dipesan">';
        } else {
         // echo '" onclick="selectSeat(\'' . $seat['seatNumber'] . '\')">';

          $seatClass = isset($_GET['selectedClass']) ? $_GET['selectedClass'] : null;
          $selectedSchedulesId = isset($_GET['selectedSchedulesId']) ? $_GET['selectedSchedulesId'] : null;
          echo '" onclick="selectSeat(\'' . $seat['seatNumber'] . '\', ' . $selectedSchedulesId . ', \'' . $seatClass . '\')">'; 

          
        }
        echo $seat['seatNumber'] . '</div>';
      }
    ?>
  </div>
  <script>
    // Fungsi untuk memilih kursi
      
    function selectSeat(seatNumber, schedulesId, seatClass) {
     if (confirm('Booking kursi ' + seatNumber + '?')) {
         window.location.href = "seat.php?selectedSchedulesId=" + schedulesId + "&selectedClass=" + seatClass + "&seatNumber=" + seatNumber;
     } else {
         // Tambahkan logika lain jika diperlukan
     }
    }


  </script>
</body>
</html>
