-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 12, 2023 at 12:57 PM
-- Server version: 10.4.20-MariaDB
-- PHP Version: 8.0.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `datacetakkartu`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`) VALUES
(1, 'admin', 'admin12345');

-- --------------------------------------------------------

--
-- Table structure for table `input_data`
--

CREATE TABLE `input_data` (
  `no` int(11) NOT NULL,
  `kantor_cabang` varchar(100) NOT NULL,
  `kabupaten_kota` varchar(100) NOT NULL,
  `tanggal_cetak` date NOT NULL,
  `nomor_kartu` int(16) NOT NULL,
  `nama_peserta` varchar(100) NOT NULL,
  `jenis_cetak` varchar(100) NOT NULL,
  `jumlah_cetak` int(11) NOT NULL,
  `penerima` varchar(100) NOT NULL,
  `hubungan` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `input_data`
--

INSERT INTO `input_data` (`no`, `kantor_cabang`, `kabupaten_kota`, `tanggal_cetak`, `nomor_kartu`, `nama_peserta`, `jenis_cetak`, `jumlah_cetak`, `penerima`, `hubungan`) VALUES
(1, '1001', 'Kab. Bone Bolango', '2023-06-12', 2147483647, 'Joshua Robert Mandagi', 'Pencetakan Kartu Peserta dan Anggota Keluarga Baru', 1, 'Gregorius Van Der Sart', 'Orang Tua'),
(2, '1006', 'Kota Tomohon', '2023-06-05', 2147483647, 'Armin Linguardyk', 'Penggantian Kartu Salah', 1, 'Leo Rodrigues', 'Anak'),
(3, '1001', 'Kab. Bone Bolango', '2023-06-09', 2147483647, 'Laura Noun', 'Penggantian Kartu Salah', 1, 'Rizka Ayundra', 'Orang Tua');

-- --------------------------------------------------------

--
-- Table structure for table `kabupaten_kota`
--

CREATE TABLE `kabupaten_kota` (
  `id_kabupaten_kota` int(100) NOT NULL,
  `kabupaten_kota` varchar(100) NOT NULL,
  `id_kantor_cabang` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kabupaten_kota`
--

INSERT INTO `kabupaten_kota` (`id_kabupaten_kota`, `kabupaten_kota`, `id_kantor_cabang`) VALUES
(2001, 'Kab. Bone Bolango', 1001),
(2002, 'Kab. Gorontalo Utara', 1001),
(2003, 'Kota Gorontalo', 1001),
(2004, 'Kab. Gorontalo', 1001),
(2005, 'Kab. Boalemo', 1001),
(2006, 'Kab. Pahuwato', 1001),
(2007, 'Kab. Banggai', 1002),
(2008, 'Kab. Banggai Kepulauan', 1002),
(2009, 'Kab. Morowali', 1002),
(2010, 'Kab. Tojo Una Una', 1002),
(2011, 'Kab. Morowali Utara', 1002),
(2012, 'Kab. Banggai Laut', 1002),
(2013, 'Kab. Kep. Siau Tagulandang Biaro', 1003),
(2014, 'Kota Bitung', 1003),
(2015, 'Kab. Kepulauan Sangihe', 1003),
(2016, 'Kab. Kepulauan Talaud', 1003),
(2017, 'Kota Manado', 1003),
(2018, 'Kab. Minahasa Utara', 1003),
(2019, 'Kab. Sigi', 1004),
(2020, 'Kab. Toli Toli', 1004),
(2021, 'Kab. Poso', 1004),
(2022, 'Kab. Donggala', 1004),
(2023, 'Kab. Buol', 1004),
(2024, 'Kota Palu', 1004),
(2025, 'Kab. Parigi Moutong', 1004),
(2026, 'Kab. Halmahera Tengah', 1005),
(2027, 'Kota Tidore Kepulauan', 1005),
(2028, 'Kab. Halmahera Utara', 1005),
(2029, 'Kab. Halmahera Timur', 1005),
(2030, 'Kab. Halmahera Barat', 1005),
(2031, 'Kota Ternate', 1005),
(2032, 'Kab. Pulau Taliabu', 1005),
(2033, 'Kab. Pulau Morotai', 1005),
(2034, 'Kab. Halmahera Selatan', 1005),
(2035, 'Kab. Kepulauan Sula', 1005),
(2036, 'Kab. Bolaang Mongondow Selatan', 1006),
(2037, 'Kota Tomohon', 1006),
(2038, 'Kab. Bolaang Mongondow Timur', 1006),
(2039, 'Kab. Bolaang Mongondow', 1006),
(2040, 'Kab. Minahasa Selatan', 1006),
(2041, 'Kota Kotamobagu', 1006),
(2042, 'Kab. Bolaang Mongondow Utara', 1006),
(2043, 'Kab. Minahasa Tenggara', 1006),
(2044, 'Kab. Minahasa', 1006);

-- --------------------------------------------------------

--
-- Table structure for table `kantor_cabang`
--

CREATE TABLE `kantor_cabang` (
  `id_kantor_cabang` int(11) NOT NULL,
  `kantor_cabang` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kantor_cabang`
--

INSERT INTO `kantor_cabang` (`id_kantor_cabang`, `kantor_cabang`) VALUES
(1001, 'Gorontalo'),
(1002, 'Luwuk'),
(1003, 'Manado'),
(1004, 'Palu'),
(1005, 'Ternate'),
(1006, 'Tondano');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `input_data`
--
ALTER TABLE `input_data`
  ADD PRIMARY KEY (`no`);

--
-- Indexes for table `kantor_cabang`
--
ALTER TABLE `kantor_cabang`
  ADD PRIMARY KEY (`id_kantor_cabang`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `input_data`
--
ALTER TABLE `input_data`
  MODIFY `no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `kantor_cabang`
--
ALTER TABLE `kantor_cabang`
  MODIFY `id_kantor_cabang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1007;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
