-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 20, 2023 at 04:58 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `penerbangannn`
--

-- --------------------------------------------------------

--
-- Table structure for table `aircrafts`
--

CREATE TABLE `aircrafts` (
  `id` int(11) NOT NULL,
  `status_pesawat` enum('Penuh','Tersedia') DEFAULT NULL,
  `jenis_pesawat` varchar(20) DEFAULT NULL,
  `kode_pesawat` varchar(20) NOT NULL,
  `id_airline` int(11) DEFAULT NULL,
  `kursi_ekonomi` int(11) NOT NULL,
  `kursi_bisnis` int(11) NOT NULL,
  `kursi_firstclass` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `aircrafts`
--

INSERT INTO `aircrafts` (`id`, `status_pesawat`, `jenis_pesawat`, `kode_pesawat`, `id_airline`, `kursi_ekonomi`, `kursi_bisnis`, `kursi_firstclass`) VALUES
(1, NULL, 'Boeing', '720B', 1, 30, 20, 10),
(2, NULL, 'Airbus', 'A321neo', 2, 0, 0, 0),
(3, NULL, 'Embraer', 'RJ140', 3, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `airlines`
--

CREATE TABLE `airlines` (
  `id` int(11) NOT NULL,
  `kode_airline` varchar(20) NOT NULL,
  `nama_airline` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `airlines`
--

INSERT INTO `airlines` (`id`, `kode_airline`, `nama_airline`) VALUES
(1, '168', 'Garuda Indonesia'),
(2, '938', 'Batik Air'),
(3, '610', 'Lion Air');

-- --------------------------------------------------------

--
-- Table structure for table `airports`
--

CREATE TABLE `airports` (
  `id` int(11) NOT NULL,
  `nama_bandara` varchar(255) NOT NULL,
  `lokasi` varchar(50) DEFAULT NULL,
  `kode_airport` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `airports`
--

INSERT INTO `airports` (`id`, `nama_bandara`, `lokasi`, `kode_airport`) VALUES
(1, 'Soekarno Hatta', 'Tangerang', 'CGK'),
(2, 'Ngurah Rai', 'Denpasar', 'DPS'),
(3, 'Juanda', 'Surabaya', 'SUB');

-- --------------------------------------------------------

--
-- Table structure for table `gates`
--

CREATE TABLE `gates` (
  `id` int(11) NOT NULL,
  `kode_gate` varchar(20) NOT NULL,
  `id_airport` int(11) DEFAULT NULL,
  `id_airline` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `gates`
--

INSERT INTO `gates` (`id`, `kode_gate`, `id_airport`, `id_airline`) VALUES
(19, '1A1B', 1, 1),
(20, '1A2B', 1, 2),
(21, '1A3C', 1, 3),
(22, '2A1D', 2, 1),
(23, '2A2E', 2, 2),
(24, '2A3F', 2, 3),
(25, '3A4G', 3, 1),
(26, '3A4H', 3, 2),
(27, '3A5I', 3, 3);

-- --------------------------------------------------------

--
-- Table structure for table `routes`
--

CREATE TABLE `routes` (
  `id` int(11) NOT NULL,
  `id_bandara_asal` int(11) NOT NULL,
  `id_bandara_tujuan` int(11) NOT NULL,
  `id_airline` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `routes`
--

INSERT INTO `routes` (`id`, `id_bandara_asal`, `id_bandara_tujuan`, `id_airline`) VALUES
(1, 1, 2, 1),
(2, 1, 2, 2),
(3, 1, 2, 3),
(4, 2, 3, 1),
(5, 2, 3, 2),
(6, 2, 3, 3),
(7, 3, 1, 1),
(8, 3, 1, 2),
(9, 3, 1, 3);

-- --------------------------------------------------------

--
-- Table structure for table `schedules`
--

CREATE TABLE `schedules` (
  `id` int(11) NOT NULL,
  `time_start` datetime NOT NULL,
  `time_end` datetime NOT NULL,
  `class` enum('Ekonomi','Bisnis','FirstClass') DEFAULT NULL,
  `id_routes` int(11) NOT NULL,
  `harga` int(11) NOT NULL,
  `kode_schedule` varchar(25) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `schedules`
--

INSERT INTO `schedules` (`id`, `time_start`, `time_end`, `class`, `id_routes`, `harga`, `kode_schedule`) VALUES
(1, '2023-12-29 08:00:00', '2023-12-29 10:00:00', 'Ekonomi', 1, 500000, '1ABC1'),
(2, '2023-12-29 08:00:00', '2023-12-29 10:00:00', 'Ekonomi', 2, 600000, '2ABC2'),
(3, '2023-12-29 08:00:00', '2023-12-29 10:00:00', 'Ekonomi', 3, 700000, '3ABC3'),
(4, '2023-12-11 08:00:00', '2023-12-11 10:00:00', 'Bisnis', 1, 700000, '4ABC4'),
(5, '2023-12-11 08:00:00', '2023-12-11 10:00:00', 'Bisnis', 2, 800000, '5ABC5'),
(6, '2023-12-11 08:00:00', '2023-12-11 10:00:00', 'Bisnis', 3, 900000, '6ABC6'),
(7, '2023-12-11 08:00:00', '2023-12-11 10:00:00', 'FirstClass', 1, 900000, NULL),
(8, '2023-12-11 08:00:00', '2023-12-11 10:00:00', 'FirstClass', 2, 1000000, '8ABC8'),
(9, '2023-12-11 08:00:00', '2023-12-11 10:00:00', 'FirstClass', 3, 1100000, '9ABC9'),
(10, '2023-12-11 13:00:00', '2023-12-11 16:00:00', 'Ekonomi', 4, 550000, '10ABC10'),
(11, '2023-12-11 13:00:00', '2023-12-11 16:00:00', 'Ekonomi', 5, 650000, '11ABC11'),
(12, '2023-12-11 13:00:00', '2023-12-11 16:00:00', 'Ekonomi', 6, 750000, '12ABC12'),
(13, '2023-12-11 13:00:00', '2023-12-11 16:00:00', 'Bisnis', 4, 750000, '13ABC13'),
(14, '2023-12-11 13:00:00', '2023-12-11 16:00:00', 'Bisnis', 5, 850000, '14ABC14'),
(15, '2023-12-11 13:00:00', '2023-12-11 16:00:00', 'Bisnis', 6, 950000, '15ABC15'),
(16, '2023-12-11 13:00:00', '2023-12-11 16:00:00', 'FirstClass', 4, 950000, '16ABC16'),
(17, '2023-12-11 13:00:00', '2023-12-11 16:00:00', 'FirstClass', 5, 1500000, '17ABC17'),
(18, '2023-12-11 13:00:00', '2023-12-11 16:00:00', 'FirstClass', 6, 1150000, '18ABC18'),
(19, '2023-12-11 10:00:00', '2023-12-11 12:00:00', 'Ekonomi', 7, 450000, '19ABC19'),
(20, '2023-12-11 10:00:00', '2023-12-11 12:00:00', 'Ekonomi', 8, 550000, '20ABC20'),
(21, '2023-12-11 10:00:00', '2023-12-11 12:00:00', 'Ekonomi', 9, 650000, '21ABC21'),
(22, '2023-12-11 10:00:00', '2023-12-11 12:00:00', 'Bisnis', 7, 650000, '22ABC22'),
(23, '2023-12-11 10:00:00', '2023-12-11 12:00:00', 'Bisnis', 8, 750000, '23ABC23'),
(24, '2023-12-30 10:00:00', '2023-12-11 12:00:00', 'Bisnis', 9, 850000, '24ABC24'),
(25, '2023-12-11 10:00:00', '2023-12-11 12:00:00', 'FirstClass', 7, 850000, '25ABC25'),
(26, '2023-12-29 10:00:00', '2023-12-29 12:00:00', 'FirstClass', 8, 9500000, '26ABC261'),
(27, '2023-12-29 00:00:00', '2023-12-29 12:00:00', 'Ekonomi', 9, 110000, '27ABC27');

-- --------------------------------------------------------

--
-- Table structure for table `seats`
--

CREATE TABLE `seats` (
  `id_seat` int(11) NOT NULL,
  `kode_seat` varchar(20) DEFAULT NULL,
  `status` enum('Tersedia','Terisi') DEFAULT NULL,
  `id_aircraft` int(11) DEFAULT NULL,
  `tipe_kelas` enum('Ekonomi','Bisnis','FirstClass') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `seats`
--

INSERT INTO `seats` (`id_seat`, `kode_seat`, `status`, `id_aircraft`, `tipe_kelas`) VALUES
(1, '1A', '', 1, 'Ekonomi'),
(2, '1B', NULL, 1, 'Bisnis'),
(3, '1C', NULL, 1, 'FirstClass'),
(4, '2A', NULL, 2, 'Ekonomi'),
(5, '2B', NULL, 2, 'Bisnis'),
(6, '2C', NULL, 2, 'FirstClass'),
(7, '3A', NULL, 3, 'Ekonomi'),
(8, '3B', NULL, 3, 'Bisnis'),
(9, '3C', NULL, 3, 'FirstClass');

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `id` int(11) NOT NULL,
  `status_booking` enum('Booked','NotBooked') DEFAULT NULL,
  `status_pembayaran` enum('Success','Failed','OnProcess') DEFAULT NULL,
  `id_schedule` int(11) DEFAULT NULL,
  `id_user` int(11) DEFAULT NULL,
  `id_seat` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`id`, `status_booking`, `status_pembayaran`, `id_schedule`, `id_user`, `id_seat`) VALUES
(1, NULL, 'Success', 1, 1, 1),
(2, NULL, 'Success', 14, 2, 4),
(3, NULL, 'Success', 27, 3, 9);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id_user` int(11) NOT NULL,
  `username` varchar(255) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `nama` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `nik` varchar(255) DEFAULT NULL,
  `tgl_lahir` date DEFAULT NULL,
  `no_telpon` varchar(15) DEFAULT NULL,
  `gender` enum('L','P') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id_user`, `username`, `password`, `nama`, `email`, `nik`, `tgl_lahir`, `no_telpon`, `gender`) VALUES
(1, 'miaam', '12345678', 'Mia Amalia', 'miaam860@gmail.com', '3202055920010001', '2003-10-19', '085559702615', 'P'),
(2, 'enii1', '11223344', 'Siti Nuraeni', 'enii123@gmail.com', '3404012311568901', '2004-02-02', '082295233362', 'P'),
(3, 'urell', '11122233', 'Aurell Nur Jasmine', 'ur.jasminee@gmail.com', '7312208911226432', '2003-10-25', '08558532507', 'P'),
(14, 'perdi', '123', 'perdi', 'perdi@gmail.com', '32178965421', '2023-12-18', '08769', 'L'),
(16, 'ena', 'ena', 'ena', 'ena@gmail.com', '321876', '2023-12-19', '86538', 'P'),
(18, 'sacgit', 'Nabil12*', 'Gita', 'ariantiaprianisagita@gmail.com', '1234567890', '2023-12-19', '088901157137', 'P');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `aircrafts`
--
ALTER TABLE `aircrafts`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `kode_pesawat` (`kode_pesawat`),
  ADD KEY `id_airline` (`id_airline`);

--
-- Indexes for table `airlines`
--
ALTER TABLE `airlines`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `kode_airline` (`kode_airline`);

--
-- Indexes for table `airports`
--
ALTER TABLE `airports`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `kode_airport` (`kode_airport`);

--
-- Indexes for table `gates`
--
ALTER TABLE `gates`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `kode_gate` (`kode_gate`),
  ADD KEY `id_airline` (`id_airline`),
  ADD KEY `id_airport` (`id_airport`);

--
-- Indexes for table `routes`
--
ALTER TABLE `routes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_bandara_asal` (`id_bandara_asal`),
  ADD KEY `id_bandara_tujuan` (`id_bandara_tujuan`),
  ADD KEY `id_airline` (`id_airline`);

--
-- Indexes for table `schedules`
--
ALTER TABLE `schedules`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `kode_schedule` (`kode_schedule`),
  ADD UNIQUE KEY `kode_schedule_2` (`kode_schedule`),
  ADD KEY `id_routes` (`id_routes`);

--
-- Indexes for table `seats`
--
ALTER TABLE `seats`
  ADD PRIMARY KEY (`id_seat`),
  ADD UNIQUE KEY `kode_seat` (`kode_seat`),
  ADD KEY `id_aircraft` (`id_aircraft`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `id_schedule` (`id_schedule`),
  ADD KEY `id_seat` (`id_seat`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `no_telpon` (`no_telpon`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `aircrafts`
--
ALTER TABLE `aircrafts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `airlines`
--
ALTER TABLE `airlines`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `airports`
--
ALTER TABLE `airports`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `gates`
--
ALTER TABLE `gates`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `routes`
--
ALTER TABLE `routes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `schedules`
--
ALTER TABLE `schedules`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `seats`
--
ALTER TABLE `seats`
  MODIFY `id_seat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=94;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `aircrafts`
--
ALTER TABLE `aircrafts`
  ADD CONSTRAINT `aircrafts_ibfk_1` FOREIGN KEY (`id_airline`) REFERENCES `airlines` (`id`);

--
-- Constraints for table `gates`
--
ALTER TABLE `gates`
  ADD CONSTRAINT `gates_ibfk_1` FOREIGN KEY (`id_airline`) REFERENCES `airlines` (`id`),
  ADD CONSTRAINT `gates_ibfk_2` FOREIGN KEY (`id_airport`) REFERENCES `airports` (`id`);

--
-- Constraints for table `routes`
--
ALTER TABLE `routes`
  ADD CONSTRAINT `routes_ibfk_1` FOREIGN KEY (`id_bandara_asal`) REFERENCES `airports` (`id`),
  ADD CONSTRAINT `routes_ibfk_2` FOREIGN KEY (`id_bandara_tujuan`) REFERENCES `airports` (`id`),
  ADD CONSTRAINT `routes_ibfk_3` FOREIGN KEY (`id_airline`) REFERENCES `airlines` (`id`);

--
-- Constraints for table `schedules`
--
ALTER TABLE `schedules`
  ADD CONSTRAINT `schedules_ibfk_1` FOREIGN KEY (`id_routes`) REFERENCES `routes` (`id`);

--
-- Constraints for table `seats`
--
ALTER TABLE `seats`
  ADD CONSTRAINT `seats_ibfk_1` FOREIGN KEY (`id_aircraft`) REFERENCES `aircrafts` (`id`);

--
-- Constraints for table `transactions`
--
ALTER TABLE `transactions`
  ADD CONSTRAINT `id_seat` FOREIGN KEY (`id_seat`) REFERENCES `seats` (`id_seat`),
  ADD CONSTRAINT `transactions_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`),
  ADD CONSTRAINT `transactions_ibfk_2` FOREIGN KEY (`id_schedule`) REFERENCES `schedules` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
