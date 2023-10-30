-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 30, 2023 at 05:46 PM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 8.0.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_jne`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `idadmin` int(11) NOT NULL,
  `nama` varchar(32) NOT NULL,
  `user` varchar(32) NOT NULL,
  `pass` varchar(32) NOT NULL,
  `foto` text NOT NULL,
  `wsimpan` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`idadmin`, `nama`, `user`, `pass`, `foto`, `wsimpan`) VALUES
(3, 'ilham', 'ilham', '130300', 'ilham.jpg', '2023-10-30 16:44:38');

-- --------------------------------------------------------

--
-- Table structure for table `bobot`
--

CREATE TABLE `bobot` (
  `C1` float NOT NULL,
  `C2` float NOT NULL,
  `C3` float NOT NULL,
  `C4` float NOT NULL,
  `C5` float NOT NULL,
  `wsimpan` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `bobot`
--

INSERT INTO `bobot` (`C1`, `C2`, `C3`, `C4`, `C5`, `wsimpan`) VALUES
(0.26, 0.23, 0.15, 0.14, 0.22, '2023-06-10 17:23:21');

-- --------------------------------------------------------

--
-- Table structure for table `karyawan`
--

CREATE TABLE `karyawan` (
  `idkaryawan` int(11) NOT NULL,
  `nama` varchar(30) NOT NULL,
  `posisi` varchar(30) NOT NULL,
  `jabatan` varchar(30) NOT NULL,
  `tgljoin` varchar(30) NOT NULL,
  `jk` varchar(15) NOT NULL,
  `wsimpan` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `karyawan`
--

INSERT INTO `karyawan` (`idkaryawan`, `nama`, `posisi`, `jabatan`, `tgljoin`, `jk`, `wsimpan`) VALUES
(2, 'Imbra Fernandes', 'Operasional', 'Staff', '2011-03-24', 'Laki-laki', '2023-06-10 15:59:08'),
(3, 'Siska Dinasari', 'Customer Service', 'Staff', '2008-02-07', 'Perempuan', '2023-06-10 18:36:00'),
(4, 'Ria Gustina', 'Customer Service', 'Staff', '2012-07-16', 'Perempuan', '2023-06-10 18:36:36'),
(5, 'Yoga Burhan Putra', 'Operasional', 'Staff', '2013-01-02', 'Laki-laki', '2023-06-10 18:37:20'),
(6, 'Yona Martavia', 'Accounting', 'Staff', '2015-03-18', 'Perempuan', '2023-06-10 21:16:14'),
(7, 'Anggi putri irman', 'Accounting', 'Staff', '2015-03-06', 'Perempuan', '2023-06-10 21:13:57'),
(8, 'Doni kurniawan', 'Operasional', 'Staff', '2016-05-16', 'Laki-laki', '2023-06-10 21:14:05'),
(9, 'Andri Salno', 'Operasional', 'Staff', '2016-10-05', 'Laki-laki', '2023-06-10 21:16:01'),
(10, 'Danil Caniago', 'Operasional', 'Staff', '2016-12-07', 'Laki-laki', '2023-06-10 21:15:18'),
(11, 'Nadya Edrina', 'Accounting', 'Staff', '2016-12-27', 'Perempuan', '2023-06-10 21:15:50');

-- --------------------------------------------------------

--
-- Table structure for table `penilaian`
--

CREATE TABLE `penilaian` (
  `idnilai` int(11) NOT NULL,
  `idkaryawan` int(11) NOT NULL,
  `nama` varchar(30) NOT NULL,
  `absensi` varchar(10) NOT NULL,
  `totalalfa` varchar(10) NOT NULL,
  `telat` varchar(15) NOT NULL,
  `kerapian` varchar(15) NOT NULL,
  `tanggungjawab` varchar(15) NOT NULL,
  `wsimpan` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `penilaian`
--

INSERT INTO `penilaian` (`idnilai`, `idkaryawan`, `nama`, `absensi`, `totalalfa`, `telat`, `kerapian`, `tanggungjawab`, `wsimpan`) VALUES
(2, 2, 'Imbra Fernandes', '25', '1', '2', 'Cukup Rapi', 'Iya', '2023-06-10 17:41:28'),
(3, 3, 'Siska Dinasari', '24', '2', '1', 'Rapi', 'Iya', '2023-06-10 18:37:59'),
(4, 4, 'Ria Gustina', '26', 'Hadir Semu', '4', 'Cukup Rapi', 'Iya', '2023-06-10 19:11:18'),
(6, 5, 'Yoga Burhan Putra', '23', '3', '3', 'Cukup Rapi', 'Iya', '2023-06-10 18:55:07'),
(7, 6, 'Yona Martavia', '24', '2', '2', 'Rapi', 'Iya', '2023-06-10 21:17:04'),
(8, 7, 'Anggi putri irman', '23', '1', '1', 'Rapi', 'Iya', '2023-06-10 21:22:17'),
(9, 8, 'Doni kurniawan', '24', '3', '3', 'Cukup Rapi', 'Iya', '2023-06-10 21:22:21'),
(10, 9, 'Andri Salno', '26', '3', '3', 'Tidak Rapi', 'Iya', '2023-06-10 21:22:32'),
(11, 10, 'Danil Caniago', '25', '3', '3', 'Cukup Rapi', 'Iya', '2023-06-10 21:22:38'),
(12, 11, 'Nadya Edrina', '26', '3', '3', 'Cukup Rapi', 'Iya', '2023-06-10 21:22:43');

-- --------------------------------------------------------

--
-- Table structure for table `subnilai`
--

CREATE TABLE `subnilai` (
  `idsubnilai` int(11) NOT NULL,
  `idkaryawan` int(11) NOT NULL,
  `nama` varchar(30) NOT NULL,
  `C1` int(11) NOT NULL,
  `C2` int(11) NOT NULL,
  `C3` int(11) NOT NULL,
  `C4` int(11) NOT NULL,
  `C5` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `subnilai`
--

INSERT INTO `subnilai` (`idsubnilai`, `idkaryawan`, `nama`, `C1`, `C2`, `C3`, `C4`, `C5`) VALUES
(2, 2, 'Imbra Fernandes', 70, 85, 80, 80, 90),
(3, 3, 'Siska Dinasari', 70, 80, 80, 90, 90),
(4, 4, 'Ria Gustina', 90, 90, 70, 80, 90),
(6, 5, 'Yoga Burhan Putra', 50, 75, 80, 80, 90),
(7, 6, 'Yona Martavia', 70, 80, 80, 90, 90),
(8, 7, 'Anggi putri irman', 50, 85, 80, 90, 90),
(9, 8, 'Doni kurniawan', 70, 75, 80, 80, 90),
(10, 9, 'Andri Salno', 90, 75, 80, 50, 90),
(11, 10, 'Danil Caniago', 70, 75, 80, 80, 90),
(12, 11, 'Nadya Edrina', 90, 75, 80, 80, 90);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`idadmin`);

--
-- Indexes for table `karyawan`
--
ALTER TABLE `karyawan`
  ADD PRIMARY KEY (`idkaryawan`);

--
-- Indexes for table `penilaian`
--
ALTER TABLE `penilaian`
  ADD PRIMARY KEY (`idnilai`);

--
-- Indexes for table `subnilai`
--
ALTER TABLE `subnilai`
  ADD PRIMARY KEY (`idsubnilai`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `idadmin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `karyawan`
--
ALTER TABLE `karyawan`
  MODIFY `idkaryawan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `penilaian`
--
ALTER TABLE `penilaian`
  MODIFY `idnilai` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `subnilai`
--
ALTER TABLE `subnilai`
  MODIFY `idsubnilai` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
