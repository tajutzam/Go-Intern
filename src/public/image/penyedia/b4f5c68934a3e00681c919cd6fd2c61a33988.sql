-- phpMyAdmin SQL Dump
-- version 5.1.1deb5ubuntu1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Dec 08, 2022 at 03:05 PM
-- Server version: 10.6.11-MariaDB-0ubuntu0.22.04.1
-- PHP Version: 8.1.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `gointern_db_test`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(222) NOT NULL,
  `password` varchar(222) NOT NULL,
  `email` varchar(222) NOT NULL,
  `token` varchar(222) DEFAULT NULL,
  `status` enum('aktif','tidak-aktif') DEFAULT 'aktif',
  `create_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `update_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `role` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jenis_usaha`
--

CREATE TABLE `jenis_usaha` (
  `id` int(11) NOT NULL,
  `jenis` varchar(222) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `jenis_usaha`
--

INSERT INTO `jenis_usaha` (`id`, `jenis`) VALUES
(1, 'pendidikan baru'),
(2, 'entertaiment');

-- --------------------------------------------------------

--
-- Table structure for table `jurusan`
--

CREATE TABLE `jurusan` (
  `id` int(222) NOT NULL,
  `jurusan` varchar(222) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `jurusan`
--

INSERT INTO `jurusan` (`id`, `jurusan`) VALUES
(10, ' Keperawatan'),
(20, ' Tata Rias dan Kecantikan'),
(25, ' Teknik Kendaraan Ringan'),
(2, 'Administrasi Perkantoran'),
(3, 'Akuntansi'),
(4, 'Analis Kimia'),
(5, 'Animasi'),
(6, 'Bisnis dan Pemasaran'),
(7, 'Broadcasting'),
(8, 'Desain Grafis / Multimedia'),
(9, 'Farmasi'),
(11, 'Kesehatan Gigi'),
(28, 'Manajemen Logistik'),
(12, 'Pariwisata'),
(13, 'Pekerjaan Sosial'),
(14, 'Pelayaran'),
(15, 'Perbankan dan Keuangan Syariah'),
(16, 'Perhotelan'),
(17, 'Rekayasa Perangkat Lunak'),
(18, 'Tata Boga'),
(19, 'Tata Busana atau Fashion Design'),
(21, 'Teknik Bisnis Sepeda Motor'),
(22, 'Teknik Elektronika Industri'),
(23, 'Teknik Furnitur'),
(24, 'Teknik Gambar Bangunan'),
(31, 'Teknik Instalasi Tenaga Listrik'),
(1, 'Teknik komputer dan jaringan'),
(26, 'Teknik Komputer Jaringan'),
(27, 'Teknik Konstruksi Batu dan Beton'),
(29, 'Teknik Otomotif'),
(30, 'Teknologi Pengolahan Hasil Pertanian');

-- --------------------------------------------------------

--
-- Table structure for table `jurusan_sekolah`
--

CREATE TABLE `jurusan_sekolah` (
  `sekolah` int(11) NOT NULL,
  `jurusan` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `jurusan_sekolah`
--

INSERT INTO `jurusan_sekolah` (`sekolah`, `jurusan`) VALUES
(27, 3),
(27, 4),
(27, 10),
(28, 29),
(28, 10),
(32, 29),
(29, 30),
(27, 10),
(31, 10),
(27, 10),
(27, 10),
(27, 3),
(34, 20),
(28, 10),
(35, 20),
(35, 10),
(28, 28),
(28, 1),
(28, 26),
(29, 10),
(29, 10),
(29, 10),
(29, 10),
(29, 10),
(29, 10),
(36, 10),
(36, 10),
(28, 1),
(28, 1),
(28, 1),
(37, 1),
(37, 10),
(27, 10),
(27, 10),
(35, 29),
(28, 1),
(27, 20),
(27, 20),
(27, 10);

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

CREATE TABLE `kategori` (
  `id` int(11) NOT NULL,
  `kategori` varchar(222) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kategori`
--

INSERT INTO `kategori` (`id`, `kategori`) VALUES
(1, 'Tenologi'),
(2, 'Akutansi\r\n'),
(3, 'Informatika'),
(4, 'Data Sains'),
(5, 'Teknik Komputer'),
(6, 'Teknik Mesin'),
(7, 'Kecantikan');

-- --------------------------------------------------------

--
-- Table structure for table `lokasi`
--

CREATE TABLE `lokasi` (
  `id` int(11) NOT NULL,
  `provinsi` varchar(64) NOT NULL,
  `kabupaten` varchar(64) NOT NULL,
  `kecamatan` varchar(222) NOT NULL,
  `jalan` varchar(222) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `lokasi`
--

INSERT INTO `lokasi` (`id`, `provinsi`, `kabupaten`, `kecamatan`, `jalan`) VALUES
(1, 'jawa timur', 'banyuwangi', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `lowongan_magang`
--

CREATE TABLE `lowongan_magang` (
  `id` int(11) NOT NULL,
  `id_magang` int(11) NOT NULL,
  `pencariMagang` int(11) NOT NULL,
  `start_on` date DEFAULT NULL,
  `finish_on` date DEFAULT NULL,
  `status` enum('acc','pending') DEFAULT 'pending',
  `penyediaMagang` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `lowongan_magang`
--

INSERT INTO `lowongan_magang` (`id`, `id_magang`, `pencariMagang`, `start_on`, `finish_on`, `status`, `penyediaMagang`) VALUES
(51, 143, 146, '2022-12-07', '2023-02-07', 'acc', 87),
(54, 145, 150, '2022-12-07', '2023-02-07', 'acc', 87),
(55, 145, 147, '2022-12-07', '2023-02-07', 'acc', 87),
(56, 143, 150, NULL, NULL, 'pending', 87);

-- --------------------------------------------------------

--
-- Table structure for table `magang`
--

CREATE TABLE `magang` (
  `id` int(11) NOT NULL,
  `posisi_magang` varchar(222) NOT NULL,
  `status` enum('kosong','sebagian','penuh') DEFAULT 'kosong',
  `penyedia` int(11) DEFAULT NULL,
  `lama_magang` int(222) NOT NULL,
  `jumlah_maksimal` int(11) NOT NULL,
  `jumlah_saatini` int(11) NOT NULL,
  `create_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `deskripsi` varchar(222) NOT NULL,
  `kategori` int(11) NOT NULL,
  `salary` int(222) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `magang`
--

INSERT INTO `magang` (`id`, `posisi_magang`, `status`, `penyedia`, `lama_magang`, `jumlah_maksimal`, `jumlah_saatini`, `create_at`, `deskripsi`, `kategori`, `salary`) VALUES
(143, 'Backend engginer', 'sebagian', 87, 2, 2, 1, '2022-12-06 22:32:41', 'a', 1, 3),
(145, 'Frontend engginer', 'sebagian', 87, 2, 2, 2, '2022-12-08 07:27:51', 'asd', 1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `pencari_magang`
--

CREATE TABLE `pencari_magang` (
  `id` int(11) NOT NULL,
  `username` varchar(222) NOT NULL,
  `password` varchar(222) NOT NULL,
  `email` varchar(222) NOT NULL,
  `id_sekolah` int(11) DEFAULT NULL,
  `no_telp` varchar(12) DEFAULT NULL,
  `agama` varchar(12) DEFAULT NULL,
  `tanggal_lahir` date DEFAULT NULL,
  `token` varchar(222) DEFAULT NULL,
  `cv` varchar(222) DEFAULT NULL,
  `resume` varchar(222) DEFAULT NULL,
  `status` enum('aktif','tidak_aktif') NOT NULL DEFAULT 'tidak_aktif',
  `status_magang` enum('magang','tidak_magang') NOT NULL DEFAULT 'tidak_magang',
  `role` int(11) NOT NULL,
  `crate_add` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `update_add` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `foto` varchar(222) DEFAULT NULL,
  `nama` varchar(222) NOT NULL,
  `expired_token` timestamp NULL DEFAULT NULL,
  `tentang_saya` varchar(222) DEFAULT NULL,
  `deskripsi_sekolah` text DEFAULT NULL,
  `jenis_kelamin` enum('P','L') DEFAULT NULL,
  `jurusan` int(222) DEFAULT NULL,
  `id_penghargaan` int(11) DEFAULT NULL,
  `surat_lamaran` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pencari_magang`
--

INSERT INTO `pencari_magang` (`id`, `username`, `password`, `email`, `id_sekolah`, `no_telp`, `agama`, `tanggal_lahir`, `token`, `cv`, `resume`, `status`, `status_magang`, `role`, `crate_add`, `update_add`, `foto`, `nama`, `expired_token`, `tentang_saya`, `deskripsi_sekolah`, `jenis_kelamin`, `jurusan`, `id_penghargaan`, `surat_lamaran`) VALUES
(146, 'Firasayang', '$2y$10$2QcL0mofeStleyyTtsFvn.IfGqfoqx6pyRgs.zoTUDPuum7Txwf.a', 'safiraput66@gmail.com', 35, '85607185972', '', '2022-12-05', 'da720001813210e828a7', '167184485002969be630aac680f6bed2bd660a2bee3acef.pdf', NULL, 'aktif', 'tidak_magang', 3, '2022-12-04 17:46:47', '0000-00-00 00:00:00', '1670174782393885d83faf47b7399ddd55431eb9aa96696.jpg', 'Safira putri Sayang', '2022-12-04 17:23:44', 'Nama saya : Mohammad tajut zam zami', 'selama saya sekolah, saya pandai dalam berbahasa jngris', 'P', 29, 26, 'jbubug'),
(147, 'Jemi', '$2y$10$QDNgmEcM.bU2Ar1ZVdmc4.ftY8IWNpF9k31G5olurviTeYsj.SPZm', 'mohammadtajutzamzami07@gmail.com', 28, '85607185972', NULL, '2022-12-05', 'b5a8d828d6847b51ed30', '167190895989629db6e0775eab249523209674bd5d05bb3.pdf', NULL, 'aktif', 'tidak_magang', 3, '2022-12-07 02:44:43', '0000-00-00 00:00:00', NULL, 'zam zami', '2022-12-05 11:16:14', 'saya adalah zam', 'saya sekolah di tkj', 'L', 1, 27, 'saya mau magang'),
(148, 'Syifa', '$2y$10$EQG3IDiKoSxGc2SfAJc4Re8YgYfI2s2DAKagiI0mLegk5NIjVXA5S', 'hiphopjunior242@gmail.com', 27, '085607185972', NULL, '2022-12-05', '88600f1da647a27084f9', '167191644131418e5e6cae7cf37ec217c2618522cf1a943.pdf', NULL, 'aktif', 'tidak_magang', 3, '2022-12-05 13:17:26', '0000-00-00 00:00:00', '1670246172896946c1f815f372f5612fcbadb9d612839b8.jpg', 'syifa salwa', '2022-12-05 13:02:12', 'gelas dan laptop', 'sekolah', 'P', 20, 28, 'lamar aku'),
(149, 'Firachah', '$2y$10$wE3QPNEDKmsgzrSyzVUAp.0bYm.Zw2TH5vLnt3zmBdy.TYsG7rNm.', 'mohammadtajutzamzami07@gmail.com', 27, '85607185975', NULL, '2022-12-05', 'c1b1e5adc940a4fc0c04', '167191657692197db6e0775eab249523209674bd5d05bb3.pdf', NULL, 'aktif', 'tidak_magang', 3, '2022-12-05 13:32:33', '0000-00-00 00:00:00', NULL, 'Fira chan', '2022-12-05 13:23:01', 'iya saysng ita', 'tas', 'P', 20, 29, 'vjvsjsb'),
(150, 'Bachtiar', '$2y$10$eHOU.MjKwE9NiU50sYXhnOatPovF551A9h2ah532P8hQuCO76tFvO', 'mohammadtajutzamzami07@gmail.com', 27, '85607185972', NULL, '2022-12-07', '661bc880dd86d0358763', '167204888954943be630aac680f6bed2bd660a2bee3acef.pdf', NULL, 'aktif', 'tidak_magang', 3, '2022-12-07 02:39:20', '0000-00-00 00:00:00', NULL, 'bachtiar arya', '2022-12-07 02:05:52', 'sabaisbsisbsh', 'skks', 'L', 10, 30, 'vsvsh');

-- --------------------------------------------------------

--
-- Table structure for table `penghargaan`
--

CREATE TABLE `penghargaan` (
  `id_penghargaan` int(11) NOT NULL,
  `judul` varchar(222) NOT NULL,
  `file` varchar(222) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `penghargaan`
--

INSERT INTO `penghargaan` (`id_penghargaan`, `judul`, `file`) VALUES
(26, 'penghargaan says', '167184468300683db6e0775eab249523209674bd5d05bb3.pdf'),
(27, 'mobile', '167190902496519be630aac680f6bed2bd660a2bee3acef.pdf'),
(28, 'membaca', '167191647463148be630aac680f6bed2bd660a2bee3acef.pdf'),
(29, 'membaca', '167191660936830be630aac680f6bed2bd660a2bee3acef.pdf'),
(30, 'penghargaan says', '167204892787393be630aac680f6bed2bd660a2bee3acef.pdf');

-- --------------------------------------------------------

--
-- Table structure for table `penyedia_magang`
--

CREATE TABLE `penyedia_magang` (
  `id` int(11) NOT NULL,
  `nama_perusahaan` varchar(222) NOT NULL,
  `alamat_perusahaan` varchar(255) DEFAULT NULL,
  `email` varchar(222) NOT NULL,
  `no_telp` varchar(12) NOT NULL,
  `password` varchar(222) NOT NULL,
  `username` varchar(222) NOT NULL,
  `token` varchar(222) DEFAULT NULL,
  `role` int(11) NOT NULL,
  `jenis_usaha` int(11) DEFAULT NULL,
  `status` enum('aktif','tidak-aktif') DEFAULT NULL,
  `create_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `update_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `lokasi` int(11) DEFAULT NULL,
  `foto` varchar(222) DEFAULT NULL,
  `expired_token` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `penyedia_magang`
--

INSERT INTO `penyedia_magang` (`id`, `nama_perusahaan`, `alamat_perusahaan`, `email`, `no_telp`, `password`, `username`, `token`, `role`, `jenis_usaha`, `status`, `create_at`, `update_at`, `lokasi`, `foto`, `expired_token`) VALUES
(87, 'Zam Tester', 'jawa timur , kabupaten banyuwangi kecamatan gambiran', 'mohammadtajutzamzami07@gmail.com', '08123123', '$2y$10$yGMQPuJWlw1ftXYzJ2Ly.e44gqC5yvSgO.oyuHr1ZkfBFqOIvWL0e', 'Zam Baru', '0c5d17d620000f042d420f04174d53ca', 5, 1, 'aktif', '2022-12-08 07:00:34', '2022-11-16 10:28:52', NULL, '1ddb3d9ce2e7ed105de5a2ae642f08baaa2b7.png', '2022-11-16 17:33:52'),
(88, 'asd asd', 'dsdads', 'mohammadtajutzamzami07@gmail.com', '231231', '$2y$10$lq0Uombmft35cRsTOperfugaF2.sNLXSQnnEpByydUuCh6JSEU3jK', 'Zamnew', '2b1661044d70bbf92e3005da1acc5af9', 5, 2, 'tidak-aktif', '2022-11-16 18:30:50', '2022-11-16 11:30:50', NULL, NULL, '2022-11-16 18:35:50'),
(90, 'asd asd', 'adsa', 'mohammadtajutzamzami07@gmail.com', '0131231', '$2y$10$7VnaZwMe9tcwwCXVVX9Ecuj.mQUo/pOlidtnuJDuh654nWZAuvI8C', 'Zam', 'afbc59758249db71ce1c3fcc34c79504', 5, 1, 'aktif', '2022-12-07 03:30:37', '2022-11-16 11:31:55', NULL, NULL, '2022-11-16 18:36:55');

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE `role` (
  `id` int(11) NOT NULL,
  `role` varchar(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`id`, `role`) VALUES
(3, 'magang'),
(5, 'company'),
(6, 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `sekolah`
--

CREATE TABLE `sekolah` (
  `id` int(11) NOT NULL,
  `nama_sekolah` varchar(222) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sekolah`
--

INSERT INTO `sekolah` (`id`, `nama_sekolah`) VALUES
(27, 'SMKN TEGALDLOMO BARU'),
(28, 'SMKN 1 TEGALSARI'),
(29, 'SMK TEST'),
(30, 'Sma 1 '),
(31, 'Sma 2'),
(32, 'SMKN TEGALDLOMO BARUqeqwe'),
(33, 'MOUSE'),
(34, 'apa sehhh'),
(35, 'Smkn 2 Semarang'),
(36, ' Sekolah oke'),
(37, 'SMKN DUA');

-- --------------------------------------------------------

--
-- Table structure for table `skill`
--

CREATE TABLE `skill` (
  `skill` varchar(222) NOT NULL,
  `pencari_magang` int(11) NOT NULL,
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `skill`
--

INSERT INTO `skill` (`skill`, `pencari_magang`, `id`) VALUES
('Java spring boot', 146, 135),
('java oop', 146, 136),
('html', 146, 137),
('css', 146, 138),
('bermain ml', 147, 139),
('kipas', 148, 140),
('skilku', 149, 141),
('java', 150, 142);

-- --------------------------------------------------------

--
-- Table structure for table `syarat`
--

CREATE TABLE `syarat` (
  `id_syarat` int(11) NOT NULL,
  `syarat` varchar(222) NOT NULL,
  `id_magang` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `syarat`
--

INSERT INTO `syarat` (`id_syarat`, `syarat`, `id_magang`) VALUES
(1438, 's ', 143),
(1439, ' s', 143),
(1442, 'java ', 145),
(1443, ' php', 145);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`),
  ADD KEY `role` (`role`);

--
-- Indexes for table `jenis_usaha`
--
ALTER TABLE `jenis_usaha`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jurusan`
--
ALTER TABLE `jurusan`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `jurusan` (`jurusan`);

--
-- Indexes for table `jurusan_sekolah`
--
ALTER TABLE `jurusan_sekolah`
  ADD KEY `sekolah` (`sekolah`),
  ADD KEY `jurusan` (`jurusan`);

--
-- Indexes for table `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lokasi`
--
ALTER TABLE `lokasi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lowongan_magang`
--
ALTER TABLE `lowongan_magang`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_magang` (`id_magang`),
  ADD KEY `pencariMagang` (`pencariMagang`),
  ADD KEY `penyediaMagang` (`penyediaMagang`);

--
-- Indexes for table `magang`
--
ALTER TABLE `magang`
  ADD PRIMARY KEY (`id`),
  ADD KEY `penyedia` (`penyedia`),
  ADD KEY `kategori` (`kategori`);

--
-- Indexes for table `pencari_magang`
--
ALTER TABLE `pencari_magang`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `id_penghargaan` (`id_penghargaan`),
  ADD KEY `role` (`role`),
  ADD KEY `id_sekolah` (`id_sekolah`),
  ADD KEY `jurusan` (`jurusan`);

--
-- Indexes for table `penghargaan`
--
ALTER TABLE `penghargaan`
  ADD PRIMARY KEY (`id_penghargaan`);

--
-- Indexes for table `penyedia_magang`
--
ALTER TABLE `penyedia_magang`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD KEY `role` (`role`),
  ADD KEY `jenis_usaha` (`jenis_usaha`),
  ADD KEY `lokasi` (`lokasi`);

--
-- Indexes for table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sekolah`
--
ALTER TABLE `sekolah`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `skill`
--
ALTER TABLE `skill`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pencari_magang` (`pencari_magang`);

--
-- Indexes for table `syarat`
--
ALTER TABLE `syarat`
  ADD PRIMARY KEY (`id_syarat`),
  ADD KEY `id_magang` (`id_magang`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jenis_usaha`
--
ALTER TABLE `jenis_usaha`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `jurusan`
--
ALTER TABLE `jurusan`
  MODIFY `id` int(222) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `lokasi`
--
ALTER TABLE `lokasi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `lowongan_magang`
--
ALTER TABLE `lowongan_magang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT for table `magang`
--
ALTER TABLE `magang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=146;

--
-- AUTO_INCREMENT for table `pencari_magang`
--
ALTER TABLE `pencari_magang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=151;

--
-- AUTO_INCREMENT for table `penghargaan`
--
ALTER TABLE `penghargaan`
  MODIFY `id_penghargaan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `penyedia_magang`
--
ALTER TABLE `penyedia_magang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=92;

--
-- AUTO_INCREMENT for table `role`
--
ALTER TABLE `role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `sekolah`
--
ALTER TABLE `sekolah`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `skill`
--
ALTER TABLE `skill`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=143;

--
-- AUTO_INCREMENT for table `syarat`
--
ALTER TABLE `syarat`
  MODIFY `id_syarat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1444;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `admin`
--
ALTER TABLE `admin`
  ADD CONSTRAINT `admin_ibfk_1` FOREIGN KEY (`role`) REFERENCES `role` (`id`);

--
-- Constraints for table `jurusan_sekolah`
--
ALTER TABLE `jurusan_sekolah`
  ADD CONSTRAINT `jurusan_sekolah_ibfk_1` FOREIGN KEY (`sekolah`) REFERENCES `sekolah` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `jurusan_sekolah_ibfk_2` FOREIGN KEY (`jurusan`) REFERENCES `jurusan` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `lowongan_magang`
--
ALTER TABLE `lowongan_magang`
  ADD CONSTRAINT `lowongan_magang_ibfk_1` FOREIGN KEY (`id_magang`) REFERENCES `magang` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `lowongan_magang_ibfk_2` FOREIGN KEY (`pencariMagang`) REFERENCES `pencari_magang` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `lowongan_magang_ibfk_3` FOREIGN KEY (`penyediaMagang`) REFERENCES `penyedia_magang` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `magang`
--
ALTER TABLE `magang`
  ADD CONSTRAINT `magang_ibfk_1` FOREIGN KEY (`penyedia`) REFERENCES `penyedia_magang` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `magang_ibfk_2` FOREIGN KEY (`kategori`) REFERENCES `kategori` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `pencari_magang`
--
ALTER TABLE `pencari_magang`
  ADD CONSTRAINT `pencari_magang_ibfk_1` FOREIGN KEY (`role`) REFERENCES `role` (`id`),
  ADD CONSTRAINT `pencari_magang_ibfk_2` FOREIGN KEY (`id_sekolah`) REFERENCES `sekolah` (`id`),
  ADD CONSTRAINT `pencari_magang_ibfk_3` FOREIGN KEY (`jurusan`) REFERENCES `jurusan` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `pencari_magang_ibfk_4` FOREIGN KEY (`id_penghargaan`) REFERENCES `penghargaan` (`id_penghargaan`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `penyedia_magang`
--
ALTER TABLE `penyedia_magang`
  ADD CONSTRAINT `penyedia_magang_ibfk_3` FOREIGN KEY (`role`) REFERENCES `role` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `penyedia_magang_ibfk_4` FOREIGN KEY (`jenis_usaha`) REFERENCES `jenis_usaha` (`id`),
  ADD CONSTRAINT `penyedia_magang_ibfk_5` FOREIGN KEY (`lokasi`) REFERENCES `lokasi` (`id`);

--
-- Constraints for table `skill`
--
ALTER TABLE `skill`
  ADD CONSTRAINT `skill_ibfk_1` FOREIGN KEY (`pencari_magang`) REFERENCES `pencari_magang` (`id`);

--
-- Constraints for table `syarat`
--
ALTER TABLE `syarat`
  ADD CONSTRAINT `syarat_ibfk_1` FOREIGN KEY (`id_magang`) REFERENCES `magang` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
