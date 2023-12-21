<?php
// Koneksi ke database (gantilah dengan informasi koneksi Anda)
require_once('Database Connection file/mysqli_connect.php');
// ID jadwal yang dipilih
session_start();
$seatNumber = isset($_GET['seatNumber']) ? $_GET['seatNumber'] : null;
$seatClass = isset($_GET['selectedClass']) ? $_GET['selectedClass'] : null;
$selectedSchedulesId = isset($_GET['selectedSchedulesId']) ? $_GET['selectedSchedulesId'] : null;
$seats = [];
$seatClassSafe = mysqli_real_escape_string($koneksi, $seatClass);
// Periksa apakah $selectedSchedulesId tidak null sebelum menjalankan query
if ($selectedSchedulesId !== null) {
    // Query untuk UPDATE kursi
    $query_update = "UPDATE seats SET status = 'booked', tipe_kelas = '$seatClass' WHERE kode_seat = '$seatNumber'";
    $result_insert = mysqli_query($koneksi, $query_update);
    if(!$result_insert){
      echo "Gagal memilih kursi";
    }
    $query = "SELECT seats.*
              FROM seats
              JOIN aircrafts ON seats.id_aircraft = aircrafts.id
              JOIN airlines ON aircrafts.id_airline = airlines.id
              JOIN routes ON routes.id_airline = airlines.id
              RIGHT JOIN schedules ON schedules.id_routes = routes.id
              WHERE airlines.id = routes.id_airline
                AND schedules.id = $selectedSchedulesId
                AND seats.tipe_kelas = '$seatClassSafe'
                AND seats.kode_seat='$seatNumber'";

    $result = mysqli_query($koneksi, $query);

    // Periksa apakah query berhasil dijalankan
    if ($result) {
        while ($row = mysqli_fetch_assoc($result)) {
            
            $seat = [
                'kode_seat' => $row['kode_seat'], 
                'status' => $row['status'], 
            ];
            // Tambahkan data kursi ke dalam array
            $seats[] = $seat;
        }
    } else {
        echo "Error: " . $query . "<br>" . mysqli_error($koneksi);
    }
} else {
    echo "Error: selectedSchedulesId is null";
}


mysqli_close($koneksi);


foreach ($seats as $seat) {
    echo "Nomor Kursi: " . $seat['kode_seat'] . "<br>";
    echo "Status: " . $seat['status'] . "<br>";
    echo "<hr>";
}
?>
