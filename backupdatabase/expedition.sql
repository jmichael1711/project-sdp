-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 06, 2020 at 04:37 PM
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
  `waktu_berangkat` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `bon_muats`
--

INSERT INTO `bon_muats` (`id`, `kendaraan_id`, `kurir_non_customer_id`, `total_muatan`, `kantor_asal_id`, `kantor_tujuan_id`, `user_created`, `user_updated`, `created_at`, `updated_at`, `is_deleted`, `waktu_berangkat`) VALUES
('B00000001030220', 'KE000001', 'KN000001', '15.0', 'KA000001', 'KA000002', '', 'P0000001', '0000-00-00 00:00:00', '2020-04-03 17:54:57', 0, NULL),
('B00000002030220', 'KE000001', 'KN000002', '0.0', 'KA000001', 'KA000001', '', 'P0000001', '2020-03-25 09:15:43', '2020-04-03 10:30:57', 0, NULL),
('B00000003030220', 'KE000001', 'KN000002', '0.0', 'KA000001', 'KA000001', '', 'P0000001', '0000-00-00 00:00:00', '2020-04-02 16:02:43', 0, NULL),
('B00000003030420', 'KE000002', 'KN000001', '0.0', 'KA000001', 'KA000002', 'P0000001', 'P0000001', '2020-04-03 21:32:52', '2020-04-03 21:32:52', 0, NULL);

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
  `password` varchar(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `d_pengiriman_customers`
--

INSERT INTO `d_pengiriman_customers` (`resi_id`, `pengiriman_customer_id`, `telah_sampai`, `created_at`, `updated_at`, `is_deleted`, `user_created`, `user_updated`, `password`) VALUES
('R0000001', 'P00000001030420', 0, '2020-04-05 22:53:51', '2020-04-05 22:53:51', 0, 'P0000001', 'P0000001', NULL),
('R0000002', 'P00000001030420', 1, '2020-04-05 22:16:55', '2020-04-05 22:27:52', 0, 'P0000001', 'P0000001', NULL),
('resi1', 'pcus1', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', '', NULL),
('resi1', 'pcus2', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', '', NULL),
('resi2', 'pcus1', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', '', NULL);

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

--
-- Dumping data for table `kantors`
--

INSERT INTO `kantors` (`id`, `alamat`, `no_telp`, `kota`, `is_warehouse`, `created_at`, `updated_at`, `is_deleted`, `longitude`, `latitude`, `user_created`, `user_updated`) VALUES
('KA000001', 'dgjdh', '23141512', 'SURABAYA', 0, '0000-00-00 00:00:00', '2020-04-02 15:24:32', 0, '1.00000', '1.00000', '', 'P0000001'),
('KA000002', 'ASDF', '12345678', 'SIDOARJO', 0, '2020-03-06 15:44:30', '2020-03-06 15:44:33', 0, '0.00000', '0.00000', ' ', ' ');

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
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `tahun_pembelian` decimal(4,0) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0,
  `posisi_di_kantor_1` tinyint(1) NOT NULL,
  `user_created` varchar(8) NOT NULL,
  `user_updated` varchar(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kendaraans`
--

INSERT INTO `kendaraans` (`id`, `kantor_1_id`, `kantor_2_id`, `nopol`, `status`, `tahun_pembelian`, `created_at`, `updated_at`, `is_deleted`, `posisi_di_kantor_1`, `user_created`, `user_updated`) VALUES
('KE000001', 'KA000001', 'KA000001', 'L 1234 AB', 0, '0', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, '', ''),
('KE000002', 'KA000001', 'KA000002', 'L 7894 AB', 0, '18', '2020-04-03 21:17:56', '2020-04-03 21:17:56', 0, 1, 'P0000001', 'P0000001'),
('KE223900', 'KA000001', 'KA000002', 'L 4321 BA', 0, '0', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, '', '');

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
  `status` decimal(1,0) NOT NULL,
  `nopol` varchar(9) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0,
  `user_created` varchar(8) NOT NULL,
  `user_updated` varchar(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kurir_customers`
--

INSERT INTO `kurir_customers` (`id`, `kantor_id`, `nama`, `jenis_kelamin`, `no_telp`, `alamat`, `status`, `nopol`, `password`, `created_at`, `updated_at`, `is_deleted`, `user_created`, `user_updated`) VALUES
('KC000000', 'KA000002', 'ENRICHO', 'l', '789456', 'baratang jaya', '1', 'l 4569 ab', '123', '2020-04-03 12:28:16', '2020-04-03 12:28:16', 0, 'P0000001', 'P0000001');

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
  `status` decimal(1,0) NOT NULL,
  `password` varchar(255) NOT NULL,
  `posisi_di_kantor_1` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0,
  `user_created` varchar(8) NOT NULL,
  `user_updated` varchar(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kurir_non_customers`
--

INSERT INTO `kurir_non_customers` (`id`, `kantor_1_id`, `kantor_2_id`, `nama`, `jenis_kelamin`, `no_telp`, `alamat`, `status`, `password`, `posisi_di_kantor_1`, `created_at`, `updated_at`, `is_deleted`, `user_created`, `user_updated`) VALUES
('KN000001', 'KA000001', 'KA000002', 'agus', 'L', '', '', '0', '', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', ''),
('KN000002', 'KA000001', 'KA000001', 'BAMBANG', 'L', '', '', '0', '', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', ''),
('KN000003', 'KA000002', 'KA000002', 'a', 'L', '', '', '0', '', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', ''),
('KN000004', 'KA000001', 'KA000002', 'BUDI', 'L', '', '', '0', '', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', ''),
('KN000005', 'KA000001', 'KA000002', 'ADI', 'L', '', '', '0', '', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', '');

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

--
-- Dumping data for table `pegawais`
--

INSERT INTO `pegawais` (`id`, `kantor_id`, `nama`, `alamat`, `no_telp`, `jenis_kelamin`, `jabatan`, `password`, `created_at`, `updated_at`, `is_deleted`, `user_created`, `user_updated`) VALUES
('PE000000', 'KA000002', 'ENRICHO', 'BARATANG JAYA', '789456', 'W', 'pegawai', '123', '2020-04-03 03:57:47', '2020-04-05 20:28:39', 0, 'P0000001', 'P0000001');

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
  `waktu_berangkat` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pengiriman_customers`
--

INSERT INTO `pengiriman_customers` (`id`, `kurir_customer_id`, `total_muatan`, `menuju_penerima`, `kantor_id`, `created_at`, `updated_at`, `is_deleted`, `user_created`, `user_updated`, `waktu_berangkat`) VALUES
('P00000000030420', 'KC000000', '0.0', 0, 'KA000002', '2020-04-03 12:28:19', '2020-04-05 15:16:29', 0, 'P0000001', 'P0000001', NULL),
('P00000001030420', 'KC000000', '15.0', 1, 'KA000002', '2020-04-03 21:33:16', '2020-04-05 22:53:51', 0, 'P0000001', 'P0000001', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `pesanans`
--

DROP TABLE IF EXISTS `pesanans`;
CREATE TABLE `pesanans` (
  `id` varchar(15) NOT NULL,
  `resi_id` varchar(15) DEFAULT NULL,
  `kurir_customer_id` varchar(8) DEFAULT NULL,
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
  `status` decimal(1,0) NOT NULL DEFAULT 0,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0,
  `waktu_berangkat_kurir` datetime DEFAULT NULL,
  `user_created` varchar(8) DEFAULT NULL,
  `user_updated` varchar(8) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pesanans`
--

INSERT INTO `pesanans` (`id`, `resi_id`, `kurir_customer_id`, `berat_barang`, `alamat_asal`, `alamat_tujuan`, `kota_asal`, `kota_tujuan`, `nama_pengirim`, `nama_penerima`, `lebar`, `panjang`, `tinggi`, `no_telp_pengirim`, `no_telp_penerima`, `keterangan`, `is_fragile`, `email_pengirim`, `email_penerima`, `status`, `created_at`, `updated_at`, `is_deleted`, `waktu_berangkat_kurir`, `user_created`, `user_updated`) VALUES
('O0000001131320', 'R0000001', 'KC000001', '10.000', 'NGAGEL', 'JUANDA', 'SURABAYA', 'SIDOARJO', 'WG', 'ENRICHO', '1', '1', '1', '123456789000', '11123456789', NULL, 1, '', '', '0', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', '', ''),
('O0000002131320', 'R0000002', 'KC000001', '5.000', 'SAN DIEGO ', 'SAN DORA', 'SURABAYA', 'SIDOARJO', 'JM', 'HW', '1', '2', '1', '110123456789', '123456789110', NULL, 0, '', '', '0', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', '', ''),
('O0000003131320', 'R0000003', 'KC000001', '5.000', 'KEDUNGDORO', 'KEDUNGTARIK', 'SURABAYA', 'SIDOARJO', 'WH', 'JE', '0', '0', '0', '0', '0', NULL, 0, '', '', '0', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `resis`
--

DROP TABLE IF EXISTS `resis`;
CREATE TABLE `resis` (
  `id` varchar(15) NOT NULL,
  `pesanan_id` varchar(15) NOT NULL,
  `pegawai_id` varchar(8) NOT NULL,
  `harga` decimal(8,0) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0,
  `status` decimal(1,0) NOT NULL DEFAULT 0,
  `user_created` varchar(8) NOT NULL,
  `user_updated` varchar(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `resis`
--

INSERT INTO `resis` (`id`, `pesanan_id`, `pegawai_id`, `harga`, `created_at`, `updated_at`, `is_deleted`, `status`, `user_created`, `user_updated`) VALUES
('R0000001', '', '', '1', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '0', '', ''),
('R0000002', '', '', '0', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '0', '', ''),
('R0000003', 'O0000003131320', '', '0', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '0', '', '');

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
  `user_updated` varchar(8) NOT NULL DEFAULT 'Default'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `surat_jalans`
--

INSERT INTO `surat_jalans` (`bon_muat_id`, `resi_id`, `telah_sampai`, `created_at`, `updated_at`, `is_deleted`, `user_created`, `user_updated`) VALUES
('B00000001030220', 'R0000001', 1, '2020-03-18 18:04:12', '2020-04-05 22:36:18', 0, '', 'P0000001'),
('B00000001030220', 'R0000002', 1, '2020-03-18 17:23:52', '2020-04-03 17:54:57', 0, 'P0000001', 'P0000001');

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
-- Indexes for table `pesanans`
--
ALTER TABLE `pesanans`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `resis`
--
ALTER TABLE `resis`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `surat_jalans`
--
ALTER TABLE `surat_jalans`
  ADD PRIMARY KEY (`bon_muat_id`,`resi_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
