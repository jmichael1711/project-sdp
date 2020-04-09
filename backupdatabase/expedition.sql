-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 09, 2020 at 01:02 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `expedition`
--
CREATE DATABASE IF NOT EXISTS `expedition` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `expedition`;

-- --------------------------------------------------------

--
-- Table structure for table `bon_muats`
--

DROP TABLE IF EXISTS `bon_muats`;
CREATE TABLE `bon_muats` (
  `id` varchar(15) NOT NULL,
  `kendaraan_id` varchar(8) NOT NULL,
  `kurir_non_customer_id` varchar(8) NOT NULL,
  `total_muatan` decimal(5,1) NOT NULL DEFAULT 0.0,
  `kantor_asal_id` varchar(8) NOT NULL,
  `kantor_tujuan_id` varchar(8) NOT NULL,
  `user_created` varchar(8) NOT NULL,
  `user_updated` varchar(8) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0,
  `waktu_berangkat` datetime DEFAULT NULL,
  `waktu_sampai` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `d_pengiriman_customers`
--

DROP TABLE IF EXISTS `d_pengiriman_customers`;
CREATE TABLE `d_pengiriman_customers` (
  `resi_id` varchar(15) NOT NULL,
  `pengiriman_customer_id` varchar(15) NOT NULL,
  `telah_sampai` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0,
  `user_created` varchar(8) NOT NULL,
  `user_updated` varchar(8) NOT NULL DEFAULT 'Default',
  `password` varchar(4) DEFAULT NULL,
  `waktu_sampai_cust` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `kantors`
--

DROP TABLE IF EXISTS `kantors`;
CREATE TABLE `kantors` (
  `id` varchar(8) NOT NULL,
  `alamat` varchar(1024) NOT NULL,
  `no_telp` varchar(12) NOT NULL,
  `kota` varchar(255) NOT NULL,
  `is_warehouse` tinyint(1) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0,
  `longitude` decimal(8,5) NOT NULL,
  `latitude` decimal(8,5) NOT NULL,
  `user_created` varchar(8) NOT NULL,
  `user_updated` varchar(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `kendaraans`
--

DROP TABLE IF EXISTS `kendaraans`;
CREATE TABLE `kendaraans` (
  `id` varchar(8) NOT NULL,
  `kantor_1_id` varchar(8) NOT NULL,
  `kantor_2_id` varchar(8) NOT NULL,
  `nopol` varchar(9) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `tahun_pembelian` decimal(4,0) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0,
  `posisi_di_kantor_1` tinyint(1) NOT NULL,
  `user_created` varchar(8) NOT NULL,
  `user_updated` varchar(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `kotas`
--

DROP TABLE IF EXISTS `kotas`;
CREATE TABLE `kotas` (
  `nama` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `user_created` varchar(8) NOT NULL,
  `user_updated` varchar(8) NOT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kotas`
--

INSERT INTO `kotas` (`nama`, `created_at`, `updated_at`, `user_created`, `user_updated`, `is_deleted`) VALUES
('BANGKALAN', '2020-04-03 14:31:25', '2020-04-03 14:31:25', 'P0000001', 'P0000001', 0),
('BANYUWANGI', '2020-04-03 14:31:25', '2020-04-03 14:31:25', 'P0000001', 'P0000001', 0),
('BATU', '2020-04-03 14:31:25', '2020-04-03 14:31:25', 'P0000001', 'P0000001', 0),
('BLITAR', '2020-04-03 14:31:25', '2020-04-03 14:31:25', 'P0000001', 'P0000001', 0),
('BOJONEGORO', '2020-04-03 14:31:25', '2020-04-03 14:31:25', 'P0000001', 'P0000001', 0),
('BONDOWOSO', '2020-04-03 14:31:25', '2020-04-03 14:31:25', 'P0000001', 'P0000001', 0),
('GRESIK', '2020-04-03 14:31:25', '2020-04-03 14:31:25', 'P0000001', 'P0000001', 0),
('JEMBER', '2020-04-03 14:31:25', '2020-04-03 14:31:25', 'P0000001', 'P0000001', 0),
('JOMBANG', '2020-04-03 14:31:25', '2020-04-03 14:31:25', 'P0000001', 'P0000001', 0),
('KEDIRI', '2020-04-03 14:31:25', '2020-04-03 14:31:25', 'P0000001', 'P0000001', 0),
('LAMONGAN', '2020-04-03 14:31:25', '2020-04-03 14:31:25', 'P0000001', 'P0000001', 0),
('LUMAJANG', '2020-04-03 14:31:25', '2020-04-03 14:31:25', 'P0000001', 'P0000001', 0),
('MADIUN', '2020-04-03 14:31:25', '2020-04-03 14:31:25', 'P0000001', 'P0000001', 0),
('MAGETAN', '2020-04-03 14:31:25', '2020-04-03 14:31:25', 'P0000001', 'P0000001', 0),
('MALANG', '2020-04-03 14:31:25', '2020-04-03 14:31:25', 'P0000001', 'P0000001', 0),
('MOJOKERTO', '2020-04-03 14:31:25', '2020-04-03 14:31:25', 'P0000001', 'P0000001', 0),
('NGANJUK', '2020-04-03 14:31:25', '2020-04-03 14:31:25', 'P0000001', 'P0000001', 0),
('NGAWI', '2020-04-03 14:31:25', '2020-04-03 14:31:25', 'P0000001', 'P0000001', 0),
('PACITAN', '2020-04-03 14:31:25', '2020-04-03 14:31:25', 'P0000001', 'P0000001', 0),
('PAMEKASAN', '2020-04-03 14:31:25', '2020-04-03 14:31:25', 'P0000001', 'P0000001', 0),
('PASURUAN', '2020-04-03 14:31:25', '2020-04-03 14:31:25', 'P0000001', 'P0000001', 0),
('PONOROGO', '2020-04-03 14:31:25', '2020-04-03 14:31:25', 'P0000001', 'P0000001', 0),
('PROBOLINGGO', '2020-04-03 14:31:25', '2020-04-03 14:31:25', 'P0000001', 'P0000001', 0),
('SAMPANG', '2020-04-03 14:31:25', '2020-04-03 14:31:25', 'P0000001', 'P0000001', 0),
('SIDOARJO', '2020-04-03 14:31:25', '2020-04-03 14:31:25', 'P0000001', 'P0000001', 0),
('SITUBONDO', '2020-04-03 14:31:25', '2020-04-03 14:31:25', 'P0000001', 'P0000001', 0),
('SUMENEP', '2020-04-03 14:31:25', '2020-04-03 14:31:25', 'P0000001', 'P0000001', 0),
('SURABAYA', '2020-04-03 14:31:25', '2020-04-03 14:31:25', 'P0000001', 'P0000001', 0),
('TRENGGALEK', '2020-04-03 14:31:25', '2020-04-03 14:31:25', 'P0000001', 'P0000001', 0),
('TUBAN', '2020-04-03 14:31:25', '2020-04-03 14:31:25', 'P0000001', 'P0000001', 0),
('TULUNGAGUNG', '2020-04-03 14:31:25', '2020-04-03 14:31:25', 'P0000001', 'P0000001', 0);

-- --------------------------------------------------------

--
-- Table structure for table `kurir_customers`
--

DROP TABLE IF EXISTS `kurir_customers`;
CREATE TABLE `kurir_customers` (
  `id` varchar(8) NOT NULL,
  `kantor_id` varchar(8) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `jenis_kelamin` varchar(1) NOT NULL,
  `no_telp` varchar(12) NOT NULL,
  `alamat` varchar(1024) NOT NULL,
  `status` decimal(1,0) NOT NULL DEFAULT 1,
  `nopol` varchar(9) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0,
  `user_created` varchar(8) NOT NULL,
  `user_updated` varchar(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `kurir_non_customers`
--

DROP TABLE IF EXISTS `kurir_non_customers`;
CREATE TABLE `kurir_non_customers` (
  `id` varchar(8) NOT NULL,
  `kantor_1_id` varchar(8) NOT NULL,
  `kantor_2_id` varchar(8) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `jenis_kelamin` varchar(1) NOT NULL,
  `no_telp` varchar(12) NOT NULL,
  `alamat` varchar(1024) NOT NULL,
  `status` decimal(1,0) NOT NULL DEFAULT 1,
  `password` varchar(255) NOT NULL,
  `posisi_di_kantor_1` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0,
  `user_created` varchar(8) NOT NULL,
  `user_updated` varchar(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `pegawais`
--

DROP TABLE IF EXISTS `pegawais`;
CREATE TABLE `pegawais` (
  `id` varchar(8) NOT NULL,
  `kantor_id` varchar(8) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `alamat` varchar(1024) NOT NULL,
  `no_telp` varchar(12) NOT NULL,
  `jenis_kelamin` varchar(1) NOT NULL,
  `jabatan` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0,
  `user_created` varchar(8) NOT NULL,
  `user_updated` varchar(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `pengiriman_customers`
--

DROP TABLE IF EXISTS `pengiriman_customers`;
CREATE TABLE `pengiriman_customers` (
  `id` varchar(15) NOT NULL,
  `kurir_customer_id` varchar(8) DEFAULT NULL,
  `total_muatan` decimal(5,1) NOT NULL DEFAULT 0.0,
  `menuju_penerima` tinyint(1) NOT NULL,
  `kantor_id` varchar(8) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0,
  `user_created` varchar(8) NOT NULL,
  `user_updated` varchar(8) NOT NULL,
  `waktu_berangkat` datetime DEFAULT NULL,
  `waktu_sampai_kantor` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `resis`
--
DROP TABLE IF EXISTS `pesanans`;
DROP TABLE IF EXISTS `resis`;
CREATE TABLE `resis` (
  `id` varchar(15) NOT NULL,
  `pegawai_id` varchar(8) NOT NULL,
  `kurir_customer_id` varchar(8) DEFAULT NULL,
  `harga` decimal(8,0) NOT NULL,
  `verifikasi` tinyint(1) DEFAULT NULL,
  `status_perjalanan` varchar(20) DEFAULT NULL,
  `berat_barang` decimal(5,3) NOT NULL,
  `alamat_asal` varchar(255) NOT NULL,
  `alamat_tujuan` varchar(255) NOT NULL,
  `kota_asal` varchar(255) NOT NULL,
  `kota_tujuan` varchar(255) NOT NULL,
  `nama_pengirim` varchar(255) NOT NULL,
  `nama_penerima` varchar(255) NOT NULL,
  `lebar` decimal(3,0) NOT NULL,
  `panjang` decimal(3,0) NOT NULL,
  `tinggi` decimal(3,0) NOT NULL,
  `no_telp_pengirim` varchar(20) NOT NULL,
  `no_telp_penerima` varchar(20) NOT NULL,
  `keterangan` varchar(255) DEFAULT NULL,
  `is_fragile` tinyint(1) NOT NULL,
  `email_pengirim` varchar(255) NOT NULL,
  `email_penerima` varchar(255) NOT NULL,
  `waktu_berangkat_kurir` datetime DEFAULT NULL,
  `longitude_pengirim` decimal(8,5) DEFAULT NULL,
  `latitude_pengirim` decimal(8,5) DEFAULT NULL,
  `kode_pos_pengirim` int(5) DEFAULT NULL,
  `kode_pos_penerima` int(5) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0,
  `user_created` varchar(8) NOT NULL,
  `user_updated` varchar(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `sejarahs`
--

DROP TABLE IF EXISTS `sejarahs`;
CREATE TABLE `sejarahs` (
  `id` int(11) NOT NULL,
  `resi_id` varchar(8) NOT NULL,
  `keterangan` varchar(500) DEFAULT NULL,
  `waktu` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `surat_jalans`
--

DROP TABLE IF EXISTS `surat_jalans`;
CREATE TABLE `surat_jalans` (
  `bon_muat_id` varchar(15) NOT NULL,
  `resi_id` varchar(15) NOT NULL,
  `telah_sampai` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0,
  `user_created` varchar(8) NOT NULL,
  `user_updated` varchar(8) NOT NULL DEFAULT 'Default',
  `waktu_sampai` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bon_muats`
--
ALTER TABLE `bon_muats`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `d_pengiriman_customers`
--
ALTER TABLE `d_pengiriman_customers`
  ADD PRIMARY KEY (`resi_id`,`pengiriman_customer_id`);

--
-- Indexes for table `kantors`
--
ALTER TABLE `kantors`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kendaraans`
--
ALTER TABLE `kendaraans`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kotas`
--
ALTER TABLE `kotas`
  ADD PRIMARY KEY (`nama`);

--
-- Indexes for table `kurir_customers`
--
ALTER TABLE `kurir_customers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kurir_non_customers`
--
ALTER TABLE `kurir_non_customers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pegawais`
--
ALTER TABLE `pegawais`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pengiriman_customers`
--
ALTER TABLE `pengiriman_customers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sejarahs`
--
ALTER TABLE `sejarahs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `surat_jalans`
--
ALTER TABLE `surat_jalans`
  ADD PRIMARY KEY (`bon_muat_id`,`resi_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `sejarahs`
--
ALTER TABLE `sejarahs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
