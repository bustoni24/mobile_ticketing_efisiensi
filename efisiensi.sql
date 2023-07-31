-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 25, 2022 at 12:38 AM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `efisiensi`
--

-- --------------------------------------------------------

--
-- Table structure for table `barang`
--

CREATE TABLE `barang` (
  `id` int(11) NOT NULL,
  `id_barang` varchar(10) NOT NULL,
  `parts_number` varchar(30) NOT NULL,
  `nama_barang` varchar(128) NOT NULL,
  `satuan` varchar(11) DEFAULT NULL,
  `spesifikasi` varchar(25) DEFAULT NULL,
  `rak_penyimpanan` varchar(60) DEFAULT NULL,
  `total_stok` int(11) NOT NULL DEFAULT 0,
  `created_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `barang`
--

INSERT INTO `barang` (`id`, `id_barang`, `parts_number`, `nama_barang`, `satuan`, `spesifikasi`, `rak_penyimpanan`, `total_stok`, `created_date`) VALUES
(2, 'B.001', '4111EOK77', 'GASKET KIT ENGINE', 'pcs', 'C', 'C.001.001', 11, '2022-05-18 18:15:14'),
(3, 'B.003', '156071731L', 'ELEMENT OIL FILTER R260', 'pcs', 'A', 'A.001.001', 46, '2022-05-18 18:17:02');

-- --------------------------------------------------------

--
-- Table structure for table `depo`
--

CREATE TABLE `depo` (
  `id` int(11) NOT NULL,
  `name` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `depo`
--

INSERT INTO `depo` (`id`, `name`) VALUES
(1, 'Gudang Kebumen'),
(2, 'Depo Yogyakarta'),
(3, 'Depo Cilacap'),
(4, 'Depo Purwokerto');

-- --------------------------------------------------------

--
-- Table structure for table `form_sebelum_mengemudi`
--

CREATE TABLE `form_sebelum_mengemudi` (
  `id` int(11) NOT NULL,
  `id_sdm` int(11) NOT NULL,
  `nomor_lambung` varchar(20) NOT NULL,
  `dokumen_tersedia` tinyint(1) DEFAULT NULL,
  `dokumen_catatan` varchar(128) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `deskripsi` mediumtext DEFAULT NULL,
  `tanggal` text NOT NULL,
  `created_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `group_auth`
--

CREATE TABLE `group_auth` (
  `id` int(11) NOT NULL,
  `className` varchar(256) NOT NULL,
  `action` text DEFAULT NULL,
  `group_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `group_auth`
--

INSERT INTO `group_auth` (`id`, `className`, `action`, `group_id`) VALUES
(1, 'user', 'admin,create,update,delete,view,profil', 1),
(216, 'groupAuth', 'admin,create,update,delete,view', 1),
(217, 'menu', 'admin,create,update,delete,view', 1),
(218, 'user', 'administrator,create,update,view,profil,delete', 2),
(219, 'remajaPutri', 'admin,create,update,delete,view', 2);

-- --------------------------------------------------------

--
-- Table structure for table `jenis_servis`
--

CREATE TABLE `jenis_servis` (
  `id` int(11) NOT NULL,
  `id_servis` varchar(11) NOT NULL,
  `jenis_servis` varchar(128) NOT NULL,
  `sparepart` tinyint(4) NOT NULL DEFAULT 0,
  `id_barang` int(11) DEFAULT NULL,
  `created_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `jenis_servis`
--

INSERT INTO `jenis_servis` (`id`, `id_servis`, `jenis_servis`, `sparepart`, `id_barang`, `created_date`) VALUES
(1, 'SER.001', 'Tes servis', 1, 2, '2022-05-18 20:11:24'),
(2, 'SER.002', 'Tes servis2', 0, NULL, '2022-05-18 20:12:01');

-- --------------------------------------------------------

--
-- Table structure for table `kendaraan`
--

CREATE TABLE `kendaraan` (
  `id` int(11) NOT NULL,
  `id_kendaraan` varchar(10) NOT NULL,
  `nomor_kendaraan` varchar(15) NOT NULL,
  `nomor_lambung` varchar(20) NOT NULL,
  `nomor_rangka` varchar(11) NOT NULL,
  `nomor_mesin` varchar(11) NOT NULL,
  `berat` varchar(11) NOT NULL,
  `kapasitas_seat` int(11) NOT NULL,
  `jenis_kendaraan` varchar(60) DEFAULT NULL,
  `tahun_pembuatan` varchar(5) DEFAULT NULL,
  `jumlah_jarak_tempuh` varchar(11) DEFAULT NULL,
  `no_stnk` varchar(60) DEFAULT NULL,
  `lampiran_stnk` varchar(256) DEFAULT NULL,
  `masa_berlaku_stnk` date DEFAULT NULL,
  `jatuh_tempo_tahunan` date DEFAULT NULL,
  `nomor_kir` varchar(60) DEFAULT NULL,
  `lampiran_kir` varchar(256) DEFAULT NULL,
  `masa_berlaku_kir` date DEFAULT NULL,
  `kps` varchar(60) DEFAULT NULL,
  `lampiran_kps` varchar(256) DEFAULT NULL,
  `jenis_trayek` varchar(60) DEFAULT NULL,
  `rute_trayek` varchar(128) DEFAULT NULL,
  `unit` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kendaraan`
--

INSERT INTO `kendaraan` (`id`, `id_kendaraan`, `nomor_kendaraan`, `nomor_lambung`, `nomor_rangka`, `nomor_mesin`, `berat`, `kapasitas_seat`, `jenis_kendaraan`, `tahun_pembuatan`, `jumlah_jarak_tempuh`, `no_stnk`, `lampiran_stnk`, `masa_berlaku_stnk`, `jatuh_tempo_tahunan`, `nomor_kir`, `lampiran_kir`, `masa_berlaku_kir`, `kps`, `lampiran_kps`, `jenis_trayek`, `rute_trayek`, `unit`) VALUES
(1, 'EV.001', 'abc123', 'cbe213', '6543211', '34re24', '5000', 45, 'Hino Rk8 R260', '2005', '37000', '214214', 'kendaraan_202205120717231_b0752g9l.png', '2022-05-12', '2022-05-12', '65363463', 'kendaraan_202205120717241_WhatsApp-Image-2022-04-14-at-11.04.36-AM.jpeg', '2022-05-12', '23523ewtw', 'kendaraan_202205120717241_Test.pdf', 'AKAP', 'Cilacap - Semarang', 'Pool Cilacap');

-- --------------------------------------------------------

--
-- Table structure for table `level`
--

CREATE TABLE `level` (
  `id` int(11) NOT NULL,
  `nama` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `level`
--

INSERT INTO `level` (`id`, `nama`) VALUES
(1, 'Superadmin'),
(2, 'Admin'),
(3, 'Operator');

-- --------------------------------------------------------

--
-- Table structure for table `reorder_point`
--

CREATE TABLE `reorder_point` (
  `id` int(11) NOT NULL,
  `id_depo` int(11) NOT NULL,
  `id_barang` int(11) NOT NULL,
  `point` int(11) NOT NULL,
  `created_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `reorder_point`
--

INSERT INTO `reorder_point` (`id`, `id_depo`, `id_barang`, `point`, `created_date`) VALUES
(21, 1, 2, 3, '2022-05-18 18:15:14'),
(22, 2, 2, 1, '2022-05-18 18:15:14'),
(23, 3, 2, 1, '2022-05-18 18:15:14'),
(24, 4, 2, 1, '2022-05-18 18:15:14'),
(25, 1, 3, 15, '2022-05-18 18:17:02'),
(26, 2, 3, 5, '2022-05-18 18:17:02'),
(27, 3, 3, 5, '2022-05-18 18:17:02'),
(28, 4, 3, 5, '2022-05-18 18:17:02');

-- --------------------------------------------------------

--
-- Table structure for table `sdm`
--

CREATE TABLE `sdm` (
  `id` int(11) NOT NULL,
  `id_sdm` varchar(10) NOT NULL,
  `nama` varchar(128) NOT NULL,
  `tempat_lahir` varchar(60) DEFAULT NULL,
  `tgl_lahir` date DEFAULT NULL,
  `alamat` text DEFAULT NULL,
  `no_telepon` varchar(15) DEFAULT NULL,
  `jabatan` varchar(30) DEFAULT NULL,
  `sertifikat_kompetensi` varchar(256) DEFAULT NULL,
  `jenis_sim` varchar(5) DEFAULT NULL,
  `lampiran_sim` varchar(256) DEFAULT NULL,
  `masa_berlaku_sim` date DEFAULT NULL,
  `username` varchar(128) NOT NULL,
  `password` varchar(256) NOT NULL,
  `temp_password` varchar(128) DEFAULT NULL,
  `unit` varchar(30) NOT NULL,
  `level` int(11) NOT NULL,
  `active` tinyint(4) NOT NULL DEFAULT 1,
  `created_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sdm`
--

INSERT INTO `sdm` (`id`, `id_sdm`, `nama`, `tempat_lahir`, `tgl_lahir`, `alamat`, `no_telepon`, `jabatan`, `sertifikat_kompetensi`, `jenis_sim`, `lampiran_sim`, `masa_berlaku_sim`, `username`, `password`, `temp_password`, `unit`, `level`, `active`, `created_date`) VALUES
(1, 'SDM.001', 'Testing', 'Sleman', '1989-07-07', 'Jalan Cibuk Tegal', '08123456789', 'Mekanik', 'sdm_202205100730251_mpdf.pdf', 'SIM A', 'sdm_202205100730251_WhatsApp-Image-2022-04-14-at-11.04.36-AM.jpeg', '2025-08-09', 'testing@testing.com', '827ccb0eea8a706c4c34a16891f84e7b', '12345', 'Pool Yogyakarta', 2, 1, '2022-05-10 18:43:27');

-- --------------------------------------------------------

--
-- Table structure for table `setting`
--

CREATE TABLE `setting` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `keterangan` text DEFAULT NULL,
  `value` varchar(256) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `setting`
--

INSERT INTO `setting` (`id`, `name`, `keterangan`, `value`) VALUES
(4, 'WA', 'sosmed', '6281393048819'),
(7, 'LIMIT_HARI', 'batas minimal waktu pendaftaran keberangkatan', '3'),
(9, 'VERIFICATION_TIMER', 'timer verifikasi email daam menit', '60'),
(10, 'PERCENT_CAPACITY', 'prosentase kapasitas', '60');

-- --------------------------------------------------------

--
-- Table structure for table `stok_terkini`
--

CREATE TABLE `stok_terkini` (
  `id` int(11) NOT NULL,
  `id_depo` int(11) NOT NULL,
  `id_barang` int(11) NOT NULL,
  `stok` int(11) NOT NULL,
  `created_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `stok_terkini`
--

INSERT INTO `stok_terkini` (`id`, `id_depo`, `id_barang`, `stok`, `created_date`) VALUES
(21, 1, 2, 5, '2022-05-18 18:15:14'),
(22, 2, 2, 2, '2022-05-18 18:15:14'),
(23, 3, 2, 2, '2022-05-18 18:15:14'),
(24, 4, 2, 2, '2022-05-18 18:15:14'),
(25, 1, 3, 20, '2022-05-18 18:17:03'),
(26, 2, 3, 10, '2022-05-18 18:17:03'),
(27, 3, 3, 7, '2022-05-18 18:17:03'),
(28, 4, 3, 9, '2022-05-18 18:17:03');

-- --------------------------------------------------------

--
-- Table structure for table `supplier`
--

CREATE TABLE `supplier` (
  `id` int(11) NOT NULL,
  `id_supplier` varchar(11) NOT NULL,
  `nama_supplier` varchar(128) NOT NULL,
  `alamat` text DEFAULT NULL,
  `nomor_telepon` varchar(15) DEFAULT NULL,
  `email` varchar(60) DEFAULT NULL,
  `no_rekening` varchar(60) DEFAULT NULL,
  `nama_bank` varchar(60) DEFAULT NULL,
  `atas_nama` varchar(60) DEFAULT NULL,
  `npwp` varchar(30) DEFAULT NULL,
  `created_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `unit`
--

CREATE TABLE `unit` (
  `id` int(11) NOT NULL,
  `id_unit` varchar(11) NOT NULL,
  `nama_unit` varchar(128) NOT NULL,
  `created_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `unit`
--

INSERT INTO `unit` (`id`, `id_unit`, `nama_unit`, `created_date`) VALUES
(1, 'U.001', 'Pool Kebumen', '2022-05-17 20:35:07'),
(2, 'U.002', 'Pool Cilacap', '2022-05-21 17:07:23'),
(3, 'U.003', 'Pool Yogyakarta', '2022-05-21 17:07:33'),
(4, 'U.004', 'Pool Semarang', '2022-05-21 17:07:43'),
(5, 'U.005', 'Bengkel Kebumen', '2022-05-21 17:07:56');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(128) NOT NULL,
  `password` varchar(256) DEFAULT NULL,
  `password_temp` varchar(12) DEFAULT NULL,
  `nama` varchar(128) NOT NULL,
  `alamat` varchar(256) NOT NULL,
  `latitude` varchar(128) DEFAULT NULL,
  `longitude` varchar(128) DEFAULT NULL,
  `no_hp` varchar(16) NOT NULL,
  `photo` varchar(256) DEFAULT NULL,
  `nip` varchar(128) DEFAULT NULL,
  `instansi` varchar(128) DEFAULT NULL,
  `kode_verifikasi` varchar(7) DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `updated_date` datetime DEFAULT NULL,
  `email_verified` tinyint(4) NOT NULL DEFAULT 0,
  `phone_verified` tinyint(4) NOT NULL DEFAULT 0,
  `level_akses` int(11) NOT NULL,
  `firebase_token_android` varchar(256) DEFAULT NULL,
  `active` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `password_temp`, `nama`, `alamat`, `latitude`, `longitude`, `no_hp`, `photo`, `nip`, `instansi`, `kode_verifikasi`, `created_date`, `updated_date`, `email_verified`, `phone_verified`, `level_akses`, `firebase_token_android`, `active`) VALUES
(1, 'superadmin', '65a807b6fe463e1907cbad64dc804990', NULL, 'bustoni', '-', NULL, NULL, '08512356789', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 1, NULL, 1),
(3, 'admin', 'c33367701511b4f6020ec61ded352059', NULL, 'Admin', '-', NULL, NULL, '000', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 2, NULL, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `depo`
--
ALTER TABLE `depo`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `form_sebelum_mengemudi`
--
ALTER TABLE `form_sebelum_mengemudi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_sdm` (`id_sdm`);

--
-- Indexes for table `group_auth`
--
ALTER TABLE `group_auth`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `jenis_servis`
--
ALTER TABLE `jenis_servis`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kendaraan`
--
ALTER TABLE `kendaraan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `level`
--
ALTER TABLE `level`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reorder_point`
--
ALTER TABLE `reorder_point`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_depo` (`id_depo`),
  ADD KEY `id_barang` (`id_barang`);

--
-- Indexes for table `sdm`
--
ALTER TABLE `sdm`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `setting`
--
ALTER TABLE `setting`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stok_terkini`
--
ALTER TABLE `stok_terkini`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_depo` (`id_depo`),
  ADD KEY `id_barang` (`id_barang`);

--
-- Indexes for table `supplier`
--
ALTER TABLE `supplier`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `unit`
--
ALTER TABLE `unit`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `level_akses` (`level_akses`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `barang`
--
ALTER TABLE `barang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `depo`
--
ALTER TABLE `depo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `form_sebelum_mengemudi`
--
ALTER TABLE `form_sebelum_mengemudi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `group_auth`
--
ALTER TABLE `group_auth`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=222;

--
-- AUTO_INCREMENT for table `jenis_servis`
--
ALTER TABLE `jenis_servis`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `kendaraan`
--
ALTER TABLE `kendaraan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `level`
--
ALTER TABLE `level`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `reorder_point`
--
ALTER TABLE `reorder_point`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `sdm`
--
ALTER TABLE `sdm`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `setting`
--
ALTER TABLE `setting`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `stok_terkini`
--
ALTER TABLE `stok_terkini`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `supplier`
--
ALTER TABLE `supplier`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `unit`
--
ALTER TABLE `unit`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
