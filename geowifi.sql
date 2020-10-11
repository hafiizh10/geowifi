-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 08, 2020 at 05:04 PM
-- Server version: 10.4.13-MariaDB
-- PHP Version: 7.4.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `geowifi`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_location`
--

CREATE TABLE `tb_location` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `latitude` varchar(100) NOT NULL,
  `longitude` varchar(100) NOT NULL,
  `address` text NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `foto` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_location`
--

INSERT INTO `tb_location` (`id`, `name`, `latitude`, `longitude`, `address`, `username`, `password`, `foto`) VALUES
(9, 'Bundaran Banjarbaru', '-3.4431342527682376', '114.84773641575775', 'Jl. A Yani Km 24', 'bjb255', 'bjb12345', 'tugu_simpang_empat_5.jpg'),
(10, 'Hotspot Kampus STMIK Banjarbaru', '-3.443099235084203', '114.82263265660781', 'STMIK Banjarbaru, Jl. A Yani', 'stmik123', 'stmik123456', 'unnamed.jpg'),
(11, 'Bandara Syamsudin Noor', '-3.4334839400652974', '114.76017409144907', 'Jl. A Yani Km.24 Angkasa Pura', 'akp22323', 'akp23234', 'bandara.jpg'),
(12, 'Taman Kota Van Der Pijl Banjarbaru', '-3.4423810274766997', '114.83221180782637', 'Jl. Pangeran Suriansyah, Loktabat Utara, Kec. Banjarbaru', 'taman234', 'taman123', 'taman.jpg'),
(13, 'Danau Caramin', '-3.4949512912156284', '114.76295337880704', 'Jalan Guntung Manggis, Landasan Ulin Timur, Landasan Ulin, Banjar Baru', 'danau123', 'danau0382', 'download.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `tb_user`
--

CREATE TABLE `tb_user` (
  `id` int(11) NOT NULL,
  `name` varchar(128) NOT NULL,
  `username` varchar(128) NOT NULL,
  `password` varchar(2556) NOT NULL,
  `jabatan` varchar(20) NOT NULL,
  `image` varchar(128) NOT NULL,
  `role_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_user`
--

INSERT INTO `tb_user` (`id`, `name`, `username`, `password`, `jabatan`, `image`, `role_id`) VALUES
(1, 'Hafiizh Zoelva Khairani', 'zoelva', '$2y$10$.EysfTn8nrVbqIE4f6HUwuxNB6YeCRePau9Fiq1vvIMj2.BuzHcvW', 'Admin', 'Logo_IEA_Kalsel.png', 1),
(2, 'Zoelva Khairani', 'khairani', '$2y$10$r622gMNr6bkCSCaT5Empfu7t1uw3h6JkZ8cohuXQr2L0KOvu3hB7q', 'User', 'default.jpg', 2);

-- --------------------------------------------------------

--
-- Table structure for table `user_access_menu`
--

CREATE TABLE `user_access_menu` (
  `id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  `menu_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_access_menu`
--

INSERT INTO `user_access_menu` (`id`, `role_id`, `menu_id`) VALUES
(1, 1, 1),
(2, 1, 2),
(3, 2, 2),
(4, 1, 3);

-- --------------------------------------------------------

--
-- Table structure for table `user_menu`
--

CREATE TABLE `user_menu` (
  `id` int(11) NOT NULL,
  `menu` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_menu`
--

INSERT INTO `user_menu` (`id`, `menu`) VALUES
(1, 'Admin'),
(2, 'User'),
(3, 'Menu');

-- --------------------------------------------------------

--
-- Table structure for table `user_role`
--

CREATE TABLE `user_role` (
  `id` int(11) NOT NULL,
  `role` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_role`
--

INSERT INTO `user_role` (`id`, `role`) VALUES
(1, 'Admin'),
(2, 'User');

-- --------------------------------------------------------

--
-- Table structure for table `user_sub_menu`
--

CREATE TABLE `user_sub_menu` (
  `id` int(11) NOT NULL,
  `menu_id` int(11) NOT NULL,
  `title` varchar(128) NOT NULL,
  `url` varchar(128) NOT NULL,
  `icon` varchar(128) NOT NULL,
  `is_active` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_sub_menu`
--

INSERT INTO `user_sub_menu` (`id`, `menu_id`, `title`, `url`, `icon`, `is_active`) VALUES
(1, 1, 'Dashboard', 'admin', 'fas fa-fw fa-tachometer-alt', 1),
(2, 2, 'My Profile', 'user', 'fas fa-fw fa-user', 1),
(3, 1, 'Role', 'admin/role', 'fas fa-fw fa-gear', 1),
(4, 3, 'Menu Management', 'menu', 'fas fa-fw fa-folder', 1),
(5, 3, 'Sub Management', 'menu/submenu', 'fas fa-fw fa-folder-open', 1),
(9, 2, 'Edit Profile', 'user/edit', 'fas fa-fw fa-cog', 1),
(10, 2, 'Change Password', 'user/changepassword', 'fas fa-fw fa-key', 1),
(11, 1, 'Add User', 'admin/user', 'fas fa-fw fa-plus-square', 1),
(12, 2, 'Tambah Lokasi WiFi', 'user/location', 'fas fa-fw fa-globe', 1),
(13, 2, 'Lihat Lokasi WiFi', 'user/peta', 'fas fa-fw fa-map-marker', 1),
(14, 2, 'List Lokasi WiFi', 'user/wifi', 'fas fa-fw fa-map', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_location`
--
ALTER TABLE `tb_location`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_user`
--
ALTER TABLE `tb_user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_access_menu`
--
ALTER TABLE `user_access_menu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_menu`
--
ALTER TABLE `user_menu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_role`
--
ALTER TABLE `user_role`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_sub_menu`
--
ALTER TABLE `user_sub_menu`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_location`
--
ALTER TABLE `tb_location`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `tb_user`
--
ALTER TABLE `tb_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `user_access_menu`
--
ALTER TABLE `user_access_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `user_menu`
--
ALTER TABLE `user_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `user_role`
--
ALTER TABLE `user_role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `user_sub_menu`
--
ALTER TABLE `user_sub_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
