<?php
// Koneksi ke database (gantilah dengan informasi koneksi Anda)
$host = "localhost";
$username = "root";
$password = "";
$database = "penerbangannn";

$koneksi = mysqli_connect($host, $username, $password, $database);

// Cek koneksi
if (!$koneksi) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

// ID jadwal yang dipilih
session_start();
$seatNumber = isset($_GET['seatNumber']) ? $_GET['seatNumber'] : null;
$seatClass = isset($_GET['selectedClass']) ? $_GET['selectedClass'] : null;
$selectedSchedulesId = isset($_GET['selectedSchedulesId']) ? $_GET['selectedSchedulesId'] : null;
$seats = [];
$seatClassSafe = mysqli_real_escape_string($koneksi, $seatClass);
// Periksa apakah $selectedSchedulesId tidak null sebelum menjalankan query
if ($selectedSchedulesId !== null) {
    // Query untuk menampilkan kursi
    
    $query_insert = "INSERT INTO seats (id_seat,kode_seat, status, tipe_kelas) VALUES ('','$seatNumber','terisi','$seatClass')"; 
    $result_insert = mysqli_query($koneksi, $query_insert);
    $query = "SELECT seats.*
              FROM seats
              JOIN aircrafts ON seats.id_aircraft = aircrafts.id
              JOIN airlines ON aircrafts.id_airline = airlines.id
              JOIN routes ON routes.id_airline = airlines.id
              RIGHT JOIN schedules ON schedules.id_routes = routes.id
              WHERE airlines.id = routes.id_airline
                AND schedules.id = $selectedSchedulesId
                AND seats.tipe_kelas = '$seatClassSafe'";

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
