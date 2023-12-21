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
    $host = "localhost";
    $username = "root";
    $password = "";
    $database = "penerbangannn";
    
    $koneksi = mysqli_connect($host, $username, $password, $database);
    
      $query = "SELECT kode_seat, status FROM seats ";
      $query_status = "SELECT kode_seat, status FROM seats";
    
      // Contoh data kursi dari database
      $seats = [
        ['seatNumber' => '4A', 'status' => 'available'],
        ['seatNumber' => '4B', 'status' => 'available'],
        ['seatNumber' => '4C', 'status' => 'available'],
        // ... tambahkan data kursi lainnya dari database
      ];

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
