-- phpMyAdmin SQL Dump
-- version 5.1.1deb5ubuntu1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Waktu pembuatan: 28 Des 2022 pada 21.15
-- Versi server: 10.6.11-MariaDB-0ubuntu0.22.04.1
-- Versi PHP: 8.1.13

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
-- Struktur dari tabel `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(222) NOT NULL,
  `password` varchar(222) NOT NULL,
  `create_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `update_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `role` int(11) DEFAULT NULL,
  `nama` varchar(222) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`, `create_at`, `update_at`, `role`, `nama`) VALUES
(2, 'admin', '$2y$10$rBpY.AyIUjwvJkCA9AwnGuWFdRd8v0Gd2TDVUeMNJGBbK6i1uKbRy', '2022-12-16 17:00:00', '2022-12-16 17:00:00', 6, 'Admin'),
(4, 'admin1', '$2y$10$srTdov6KE2GN/EcSlBdY4.iHBUy6cR2g9MFhZJsYCME6/K59mD.bS', '2022-12-26 17:00:00', '2022-12-26 17:00:00', 6, 'admin1');

-- --------------------------------------------------------

--
-- Struktur dari tabel `jenis_usaha`
--

CREATE TABLE `jenis_usaha` (
  `id` int(11) NOT NULL,
  `jenis` varchar(222) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `jenis_usaha`
--

INSERT INTO `jenis_usaha` (`id`, `jenis`) VALUES
(1, 'pendidikan'),
(2, 'entertaiment'),
(3, 'Kesehatan'),
(5, 'lainya');

-- --------------------------------------------------------

--
-- Struktur dari tabel `jurusan`
--

CREATE TABLE `jurusan` (
  `id` int(222) NOT NULL,
  `jurusan` varchar(222) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `jurusan`
--

INSERT INTO `jurusan` (`id`, `jurusan`) VALUES
(35, 'TEKNIK KOMPUTER DAN JARINGAN');

-- --------------------------------------------------------

--
-- Struktur dari tabel `jurusan_sekolah`
--

CREATE TABLE `jurusan_sekolah` (
  `sekolah` int(11) NOT NULL,
  `jurusan` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `jurusan_sekolah`
--

INSERT INTO `jurusan_sekolah` (`sekolah`, `jurusan`) VALUES
(41, 35),
(41, 35),
(41, 35),
(41, 35),
(41, 35),
(41, 35),
(41, 35);

-- --------------------------------------------------------

--
-- Struktur dari tabel `kategori`
--

CREATE TABLE `kategori` (
  `id` int(11) NOT NULL,
  `kategori` varchar(222) NOT NULL,
  `foto` varchar(222) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `kategori`
--

INSERT INTO `kategori` (`id`, `kategori`, `foto`) VALUES
(15, 'INFORMATIKA', 'df53ca268240ca76670c8566ee54568a1373224024.png'),
(16, 'MULTIMEDIA', '2e5bc8831f7ae6a29530e7f1bbf2de9c1444031239.png'),
(17, 'SPORTS', '088495f30901580ddd5171531cd26649715888653.png'),
(18, 'EDUCATION', 'd0bb80aabb8619b6e35113f02e72752b215734949.png'),
(19, 'MUSIC', 'b052e360817fdeecf8082a9496892e7f184777399.png');

-- --------------------------------------------------------

--
-- Struktur dari tabel `lowongan_magang`
--

CREATE TABLE `lowongan_magang` (
  `id` int(11) NOT NULL,
  `id_magang` int(11) NOT NULL,
  `pencariMagang` int(11) NOT NULL,
  `start_on` date DEFAULT NULL,
  `finish_on` date DEFAULT NULL,
  `status` enum('acc','pending') DEFAULT 'pending',
  `penyediaMagang` int(11) NOT NULL,
  `tanggal_lamar` date DEFAULT curdate()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `lowongan_magang`
--

INSERT INTO `lowongan_magang` (`id`, `id_magang`, `pencariMagang`, `start_on`, `finish_on`, `status`, `penyediaMagang`, `tanggal_lamar`) VALUES
(80, 172, 162, '2022-12-25', '2023-06-25', 'acc', 94, '2022-12-25');

-- --------------------------------------------------------

--
-- Struktur dari tabel `magang`
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
-- Dumping data untuk tabel `magang`
--

INSERT INTO `magang` (`id`, `posisi_magang`, `status`, `penyedia`, `lama_magang`, `jumlah_maksimal`, `jumlah_saatini`, `create_at`, `deskripsi`, `kategori`, `salary`) VALUES
(172, 'BACKEND ENGGINER', 'sebagian', 94, 6, 2, 1, '2022-12-25 12:15:47', 'membutuhkan backend engginer yang akan membantu tugas dari backend engginer senior\r\n', 15, 200000),
(173, 'FRONTEND ENGGINER', 'sebagian', 94, 2, 2, 1, '2022-12-27 09:52:45', 'Kami membutuhkan frontend engginer intern untuk membantu task dari Frontend engginer di perusahaan kami', 16, 200000),
(175, 'UI UX', 'kosong', 94, 2, 1, 0, '2022-12-28 04:16:23', 'Membutuhkan UiUX designer dengan kemampuan figma , dan tools lainya\r\n', 16, 20000),
(176, 'IT SUPPORT', 'kosong', 95, 6, 1, 0, '2022-12-28 04:19:45', 'membutuhkan intern dengan posisi it support yang bisa membantu pekerja it yang lainya', 15, 100000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `otp`
--

CREATE TABLE `otp` (
  `otp` int(12) NOT NULL,
  `pencari_magang` int(11) NOT NULL,
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `otp`
--

INSERT INTO `otp` (`otp`, `pencari_magang`, `id`) VALUES
(6367, 159, 14),
(2131, 162, 17);

-- --------------------------------------------------------

--
-- Struktur dari tabel `pencari_magang`
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
-- Dumping data untuk tabel `pencari_magang`
--

INSERT INTO `pencari_magang` (`id`, `username`, `password`, `email`, `id_sekolah`, `no_telp`, `agama`, `tanggal_lahir`, `token`, `cv`, `resume`, `status`, `status_magang`, `role`, `crate_add`, `update_add`, `foto`, `nama`, `expired_token`, `tentang_saya`, `deskripsi_sekolah`, `jenis_kelamin`, `jurusan`, `id_penghargaan`, `surat_lamaran`) VALUES
(159, 'Fira', '$2y$10$Dqfo25OiAq6U2LfCAN6Qoen3HRIDnfnQYD.E2VUjdengcfZLuG5Xq', 'mohammadtajutzamzami07@gmail.com', NULL, NULL, NULL, '2022-12-24', 'c3c76fb5fa5a89ffaebb', NULL, NULL, 'aktif', 'tidak_magang', 3, '2022-12-28 05:07:52', '0000-00-00 00:00:00', '1672204072851328a19580eea28c056b0fbc05f116c42eb.jpg', 'Fira putri', '2022-12-24 02:28:09', NULL, NULL, 'P', NULL, NULL, NULL),
(160, 'Jemi', '$2y$10$fviXYMWFJfnzr3hC3FgjEOPYLwvWew3rjcu5v7OT6u51xgDcjWXmi', 'mohammadtajutzamzami07@gmail.com', NULL, NULL, NULL, '2022-12-25', 'b4158b5171b66734767a', NULL, NULL, 'aktif', 'tidak_magang', 3, '2022-12-25 12:49:23', '0000-00-00 00:00:00', NULL, 'jemi jemoy', '2022-12-24 22:07:39', NULL, NULL, 'L', NULL, NULL, NULL),
(161, 'Jemoy', '$2y$10$9bCrS.rkZQS/1P6rXEll9uB.K9sR8Y4tEkvp028TShnNlDA3w7JQ6', 'mohammadtajutzamzami07@gmail.com', NULL, NULL, NULL, '2022-12-25', '49aac5ef8aebfeae1baf', NULL, NULL, 'aktif', 'tidak_magang', 3, '2022-12-27 09:58:30', '0000-00-00 00:00:00', NULL, 'fira moy', '2022-12-24 22:12:27', NULL, NULL, 'P', NULL, NULL, NULL),
(162, 'Firasayang', '$2y$10$Wj0PJ3d7IUlYKrPTAgk8zOU0sUTEmu7pUGAvCXwn37fNmceVfbq7G', 'safiraput66@gmail.com', 41, '85607185972', NULL, '2022-12-25', '2119de238d4494de3a1c', '16736312920394496aaf170fd04d130aa63e3030d3f7a20.pdf', NULL, 'aktif', 'tidak_magang', 3, '2022-12-25 12:39:50', '0000-00-00 00:00:00', '16719594052768348069f1a6f5a053fc807201c04ee4a2e.jpg', 'fira rahasia', '2022-12-24 22:15:47', 'Safira putri ', 'ok', 'P', 35, 33, 'saya ingin melamar di backend engginer polije'),
(163, 'User', '$2y$10$QuaYWy.0BT8GXASfMHXo4uR3cKCSbqYGQLZf74vCo.wGrIHTYk54u', 'mohammadtajutzamzami07@gmail.com', 41, NULL, 'Islam', '2022-12-28', 'cecc0434d796cb2feeae', '16739055232316896aaf170fd04d130aa63e3030d3f7a20.pdf', NULL, 'aktif', 'tidak_magang', 3, '2022-12-28 13:24:31', '0000-00-00 00:00:00', '1672233501241162ffa91f744fa94bca9a39d8b1dca4920.jpeg', 'Zam zami', '2022-12-28 06:16:53', 'Nama saya mohammae tajut zam zami', 'Saya sekolah di jurusan tkj', 'L', 35, 34, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `penghargaan`
--

CREATE TABLE `penghargaan` (
  `id_penghargaan` int(11) NOT NULL,
  `judul` varchar(222) NOT NULL,
  `file` varchar(222) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `penghargaan`
--

INSERT INTO `penghargaan` (`id_penghargaan`, `judul`, `file`) VALUES
(33, 'backend engginer', '167363135621387be630aac680f6bed2bd660a2bee3acef.pdf'),
(34, 'Sertifikat mobile', '167390565217622be630aac680f6bed2bd660a2bee3acef.pdf');

-- --------------------------------------------------------

--
-- Struktur dari tabel `penyedia_magang`
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
  `foto` varchar(222) DEFAULT NULL,
  `expired_token` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `penyedia_magang`
--

INSERT INTO `penyedia_magang` (`id`, `nama_perusahaan`, `alamat_perusahaan`, `email`, `no_telp`, `password`, `username`, `token`, `role`, `jenis_usaha`, `status`, `create_at`, `update_at`, `foto`, `expired_token`) VALUES
(94, 'Politeknik Negeri Jember', 'Jawa timur Jember', 'mohammadtajutzamzami07@gmail.com', '085607185972', '$2y$10$Gmu/eUAdoYpav.hXCs7kzOrmjiATJof3ImQ6VI6aWaxLW6TAxdXZ2', 'polije', '0cc9d00b3cd233c6245502f3532a1f56', 5, 1, 'aktif', '2022-12-21 12:13:57', '2022-12-21 05:07:36', 'f55094c163547b9a0eff4cd2dd5db25243af3.png', '2022-12-21 05:12:36'),
(95, 'POLITEKNIK NEGERI MALANG', 'Jawa timur Jember', 'safiraput66@gmail.com', '085607185972', '$2y$10$JNg9FytkSOlqbu9r/ffZ4OjA23VJbQY98Wf8vE4sFtrtk1vakNwwS', 'POLINEMA', '766d5b5217722172c50a311ba6e4c8f3', 5, 5, 'aktif', '2022-12-28 04:18:08', '2022-12-21 05:44:18', 'e75acdc5f897562ed5964ed3aef9757ee073c.png', '2022-12-21 05:49:18'),
(96, 'Politeknik  banyuwangi', 'banyuwangi , jawa timur', 'mohammadtajutzamzami07@gmail.com', '085607185972', '$2y$10$Xysg23JA1SsuR1/sLzq/jOcEo1YwkDl1c3nXBfcdd.WaaV4CKL2hi', 'poliwangi', '4131df7bc27c1b979ca442156e8a9fd1', 5, 1, 'aktif', '2022-12-27 09:56:58', '2022-12-21 12:50:55', NULL, '2022-12-21 12:55:55'),
(97, 'zam zami', 'Jawa timur Jember', 'mohammadtajutzamzami07@gmail.com', '085607185972', '$2y$10$BrqpG6Clx2Hl361UTkM6WeCbj2DS5A2FOu27A4vh4q4f3Vpojb3F2', 'Unses', '1329c10872317f6bf6d0397de9bfd66e', 5, 1, 'tidak-aktif', '2022-12-27 09:57:04', '2022-12-27 02:44:20', '5ca3a3f9b35aaa9adb5d6f875663694808c6e.png', '2022-12-27 02:49:20');

-- --------------------------------------------------------

--
-- Struktur dari tabel `role`
--

CREATE TABLE `role` (
  `id` int(11) NOT NULL,
  `role` varchar(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `role`
--

INSERT INTO `role` (`id`, `role`) VALUES
(3, 'magang'),
(5, 'company'),
(6, 'admin');

-- --------------------------------------------------------

--
-- Struktur dari tabel `sekolah`
--

CREATE TABLE `sekolah` (
  `id` int(11) NOT NULL,
  `nama_sekolah` varchar(222) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `sekolah`
--

INSERT INTO `sekolah` (`id`, `nama_sekolah`) VALUES
(41, 'SMKN 1 TEGALSARI');

-- --------------------------------------------------------

--
-- Struktur dari tabel `skill`
--

CREATE TABLE `skill` (
  `skill` varchar(222) NOT NULL,
  `pencari_magang` int(11) NOT NULL,
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `skill`
--

INSERT INTO `skill` (`skill`, `pencari_magang`, `id`) VALUES
('java', 162, 155),
('oop', 162, 156),
('test', 162, 157),
('keyboard', 162, 158),
('Menguasai java', 163, 159),
('Menguasai spring boot', 163, 160);

-- --------------------------------------------------------

--
-- Struktur dari tabel `syarat`
--

CREATE TABLE `syarat` (
  `id_syarat` int(11) NOT NULL,
  `syarat` varchar(222) NOT NULL,
  `id_magang` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `syarat`
--

INSERT INTO `syarat` (`id_syarat`, `syarat`, `id_magang`) VALUES
(1478, 'Menguasai java  ', 172),
(1479, ' Menguasai Spring boot', 172),
(1480, 'Menguasai html ', 173),
(1481, ' menguasai css ', 173),
(1482, ' menguasai javascript ', 173),
(1483, ' menguasai react sebagai framework', 173),
(1486, 'Bisa mengoprasikan figma', 175),
(1487, 'mengtahui dasar2 ilmu komputer ', 176),
(1488, ' mau belajar', 176);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD KEY `role` (`role`);

--
-- Indeks untuk tabel `jenis_usaha`
--
ALTER TABLE `jenis_usaha`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `jurusan`
--
ALTER TABLE `jurusan`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `jurusan` (`jurusan`);

--
-- Indeks untuk tabel `jurusan_sekolah`
--
ALTER TABLE `jurusan_sekolah`
  ADD KEY `sekolah` (`sekolah`),
  ADD KEY `jurusan` (`jurusan`);

--
-- Indeks untuk tabel `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `lowongan_magang`
--
ALTER TABLE `lowongan_magang`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_magang` (`id_magang`),
  ADD KEY `pencariMagang` (`pencariMagang`),
  ADD KEY `penyediaMagang` (`penyediaMagang`);

--
-- Indeks untuk tabel `magang`
--
ALTER TABLE `magang`
  ADD PRIMARY KEY (`id`),
  ADD KEY `penyedia` (`penyedia`),
  ADD KEY `kategori` (`kategori`);

--
-- Indeks untuk tabel `otp`
--
ALTER TABLE `otp`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pencari_magang` (`pencari_magang`);

--
-- Indeks untuk tabel `pencari_magang`
--
ALTER TABLE `pencari_magang`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `id_penghargaan` (`id_penghargaan`),
  ADD KEY `role` (`role`),
  ADD KEY `id_sekolah` (`id_sekolah`),
  ADD KEY `jurusan` (`jurusan`);

--
-- Indeks untuk tabel `penghargaan`
--
ALTER TABLE `penghargaan`
  ADD PRIMARY KEY (`id_penghargaan`);

--
-- Indeks untuk tabel `penyedia_magang`
--
ALTER TABLE `penyedia_magang`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD KEY `role` (`role`),
  ADD KEY `jenis_usaha` (`jenis_usaha`);

--
-- Indeks untuk tabel `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `sekolah`
--
ALTER TABLE `sekolah`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `skill`
--
ALTER TABLE `skill`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pencari_magang` (`pencari_magang`);

--
-- Indeks untuk tabel `syarat`
--
ALTER TABLE `syarat`
  ADD PRIMARY KEY (`id_syarat`),
  ADD KEY `id_magang` (`id_magang`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `jenis_usaha`
--
ALTER TABLE `jenis_usaha`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `jurusan`
--
ALTER TABLE `jurusan`
  MODIFY `id` int(222) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT untuk tabel `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT untuk tabel `lowongan_magang`
--
ALTER TABLE `lowongan_magang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=82;

--
-- AUTO_INCREMENT untuk tabel `magang`
--
ALTER TABLE `magang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=177;

--
-- AUTO_INCREMENT untuk tabel `otp`
--
ALTER TABLE `otp`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT untuk tabel `pencari_magang`
--
ALTER TABLE `pencari_magang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=164;

--
-- AUTO_INCREMENT untuk tabel `penghargaan`
--
ALTER TABLE `penghargaan`
  MODIFY `id_penghargaan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT untuk tabel `penyedia_magang`
--
ALTER TABLE `penyedia_magang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=98;

--
-- AUTO_INCREMENT untuk tabel `role`
--
ALTER TABLE `role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `sekolah`
--
ALTER TABLE `sekolah`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT untuk tabel `skill`
--
ALTER TABLE `skill`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=161;

--
-- AUTO_INCREMENT untuk tabel `syarat`
--
ALTER TABLE `syarat`
  MODIFY `id_syarat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1489;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `admin`
--
ALTER TABLE `admin`
  ADD CONSTRAINT `admin_ibfk_1` FOREIGN KEY (`role`) REFERENCES `role` (`id`);

--
-- Ketidakleluasaan untuk tabel `jurusan_sekolah`
--
ALTER TABLE `jurusan_sekolah`
  ADD CONSTRAINT `jurusan_sekolah_ibfk_1` FOREIGN KEY (`sekolah`) REFERENCES `sekolah` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `jurusan_sekolah_ibfk_2` FOREIGN KEY (`jurusan`) REFERENCES `jurusan` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `lowongan_magang`
--
ALTER TABLE `lowongan_magang`
  ADD CONSTRAINT `lowongan_magang_ibfk_1` FOREIGN KEY (`id_magang`) REFERENCES `magang` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `lowongan_magang_ibfk_2` FOREIGN KEY (`pencariMagang`) REFERENCES `pencari_magang` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `lowongan_magang_ibfk_3` FOREIGN KEY (`penyediaMagang`) REFERENCES `penyedia_magang` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `magang`
--
ALTER TABLE `magang`
  ADD CONSTRAINT `magang_ibfk_1` FOREIGN KEY (`penyedia`) REFERENCES `penyedia_magang` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `magang_ibfk_2` FOREIGN KEY (`kategori`) REFERENCES `kategori` (`id`) ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `otp`
--
ALTER TABLE `otp`
  ADD CONSTRAINT `otp_ibfk_1` FOREIGN KEY (`pencari_magang`) REFERENCES `pencari_magang` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `pencari_magang`
--
ALTER TABLE `pencari_magang`
  ADD CONSTRAINT `pencari_magang_ibfk_1` FOREIGN KEY (`role`) REFERENCES `role` (`id`),
  ADD CONSTRAINT `pencari_magang_ibfk_2` FOREIGN KEY (`id_sekolah`) REFERENCES `sekolah` (`id`),
  ADD CONSTRAINT `pencari_magang_ibfk_3` FOREIGN KEY (`jurusan`) REFERENCES `jurusan` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `pencari_magang_ibfk_4` FOREIGN KEY (`id_penghargaan`) REFERENCES `penghargaan` (`id_penghargaan`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `penyedia_magang`
--
ALTER TABLE `penyedia_magang`
  ADD CONSTRAINT `penyedia_magang_ibfk_3` FOREIGN KEY (`role`) REFERENCES `role` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `penyedia_magang_ibfk_4` FOREIGN KEY (`jenis_usaha`) REFERENCES `jenis_usaha` (`id`);

--
-- Ketidakleluasaan untuk tabel `skill`
--
ALTER TABLE `skill`
  ADD CONSTRAINT `skill_ibfk_1` FOREIGN KEY (`pencari_magang`) REFERENCES `pencari_magang` (`id`);

--
-- Ketidakleluasaan untuk tabel `syarat`
--
ALTER TABLE `syarat`
  ADD CONSTRAINT `syarat_ibfk_1` FOREIGN KEY (`id_magang`) REFERENCES `magang` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
