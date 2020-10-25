-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 20, 2020 at 06:09 AM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.2.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mybank`
--

-- --------------------------------------------------------

--
-- Table structure for table `nasabah`
--

CREATE TABLE `nasabah` (
  `id_nasabah` int(11) NOT NULL,
  `nama` varchar(128) NOT NULL,
  `jenis_kelamin` varchar(12) NOT NULL,
  `alamat` varchar(128) NOT NULL,
  `telepon` varchar(20) NOT NULL,
  `email` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `nasabah`
--

INSERT INTO `nasabah` (`id_nasabah`, `nama`, `jenis_kelamin`, `alamat`, `telepon`, `email`) VALUES
(1, 'User', 'Laki-laki', 'Bekonang', '1234567890', 'user@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `pengaduan`
--

CREATE TABLE `pengaduan` (
  `id` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `jenis_kelamin` varchar(10) NOT NULL,
  `alamat` varchar(128) NOT NULL,
  `telepon` varchar(20) NOT NULL,
  `email` varchar(128) NOT NULL,
  `jenis` varchar(20) NOT NULL,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pengaduan`
--

INSERT INTO `pengaduan` (`id`, `nama`, `jenis_kelamin`, `alamat`, `telepon`, `email`, `jenis`, `status`) VALUES
(1, 'User', 'Laki-laki', 'Bekonang', '1234567890', 'user@gmail.com', 'Pembukaan Rekening', 1),
(2, 'User', 'Laki-laki', 'Bekonang', '1234567890', 'user@gmail.com', 'Penutupan Rekening', 0),
(3, 'User', 'Note Set', 'Note Set', 'Note Set', 'user@gmail.com', 'Penghapusan Akun', 0),
(4, 'User 1', 'Perempuan', 'Solo', '1234567890', 'other-user@gmail.com', 'Pembukaan Rekening', 0),
(5, 'User 1', 'Not Set', 'Not Set', 'Not Set', 'other-user@gmail.com', 'Penghapusan Akun', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tabungan`
--

CREATE TABLE `tabungan` (
  `id_tabungan` int(11) NOT NULL,
  `id_nasabah` text NOT NULL,
  `tanggal` date NOT NULL,
  `setoran` text NOT NULL,
  `penarikan` text NOT NULL,
  `saldo` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tabungan`
--

INSERT INTO `tabungan` (`id_tabungan`, `id_nasabah`, `tanggal`, `setoran`, `penarikan`, `saldo`) VALUES
(1, '1', '2020-10-20', '0', '0', '0'),
(2, '1', '2020-10-20', '100000', '0', '100000'),
(3, '1', '2020-10-20', '0', '50000', '50000');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `name` varchar(128) NOT NULL,
  `email` varchar(128) NOT NULL,
  `image` varchar(128) NOT NULL,
  `password` varchar(256) NOT NULL,
  `role_id` int(11) NOT NULL,
  `is_active` int(11) NOT NULL,
  `date_created` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `name`, `email`, `image`, `password`, `role_id`, `is_active`, `date_created`) VALUES
(1, 'Yusuf Bahtiar', 'administrator@gmail.com', 'tenor.gif', '$2y$10$ou.RH9G5wUyYGiFqTnM4LuhZI.Gut1W1sM7J9R2up5xo2PaMEbAV6', 1, 1, 1587030576),
(2, 'Operator', 'operator@gmail.com', 'default.jpg', '$2y$10$o2KIfi2OE3UhG1Itiqo1QucIriMQigpEXLogOY3DTmX.qgWfwqLby', 3, 1, 1587031399),
(8, 'User', 'user@gmail.com', 'default.jpg', '$2y$10$WiDX9h7lToAVoyk3CqKztuppHGOOqVYYhQvxI4a0Q0Ru2VMeKXBsu', 2, 1, 1602322568);

-- --------------------------------------------------------

--
-- Table structure for table `user_access_menu`
--

CREATE TABLE `user_access_menu` (
  `id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  `menu_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_access_menu`
--

INSERT INTO `user_access_menu` (`id`, `role_id`, `menu_id`) VALUES
(1, 1, 1),
(2, 1, 2),
(3, 2, 2),
(4, 1, 3),
(5, 1, 4),
(7, 3, 2),
(8, 3, 4),
(10, 2, 5),
(17, 0, 5),
(25, 1, 5);

-- --------------------------------------------------------

--
-- Table structure for table `user_menu`
--

CREATE TABLE `user_menu` (
  `id` int(11) NOT NULL,
  `menu` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_menu`
--

INSERT INTO `user_menu` (`id`, `menu`) VALUES
(1, 'Admin'),
(2, 'User'),
(3, 'Menu'),
(4, 'Apps'),
(5, 'Tabunganku'),
(6, 'SiPITUNG+');

-- --------------------------------------------------------

--
-- Table structure for table `user_role`
--

CREATE TABLE `user_role` (
  `id` int(11) NOT NULL,
  `role` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_role`
--

INSERT INTO `user_role` (`id`, `role`) VALUES
(1, 'Administrator'),
(2, 'Member'),
(3, 'Operator');

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_sub_menu`
--

INSERT INTO `user_sub_menu` (`id`, `menu_id`, `title`, `url`, `icon`, `is_active`) VALUES
(1, 1, 'Dashboard', 'admin', 'fas fa-fw fa-tachometer-alt', 1),
(2, 2, 'My Profile', 'user', 'fas fa-fw fa-user', 1),
(3, 2, 'Edit Profile', 'user/edit', 'fas fa-fw fa-user-edit', 0),
(4, 3, 'Menu Management', 'menu', 'fas fa-fw fa-folder', 1),
(5, 3, 'Submenu Management', 'menu/submenu', 'fas fa-fw fa-folder-open', 1),
(7, 1, 'Role', 'admin/role', 'fas fa-fw fa-user-shield', 1),
(8, 2, 'Change Password', 'user/changepassword', 'fas fa-fw fa-key', 0),
(9, 4, 'Nasabah', 'apps', 'fas fa-fw fa-balance-scale-right', 1),
(12, 4, 'Tabungan', 'apps/tabungan', 'fas fa-fw fa-coins', 1),
(13, 1, 'test', 'coba', 'fas fa-fw fa-user', 0),
(14, 4, 'Portal', 'apps/info', 'fas fa-fw fa-id-card', 1),
(15, 5, 'Promo', 'tabunganku/home', 'fas fa-fw fa-theater-masks', 0),
(16, 5, 'Home', 'tabunganku', 'fas fa-fw fa-home', 1),
(17, 5, 'Customer Service', 'tabunganku/cs', 'fas fa-fw fa-users-cog', 1),
(18, 1, 'Pengaduan', 'admin/pengaduan', 'fas fa-fw fa-user-md', 1),
(19, 6, 'Promosi', 'tools', 'fas fa-fw fa-theater-masks', 0);

-- --------------------------------------------------------

--
-- Table structure for table `user_token`
--

CREATE TABLE `user_token` (
  `id` int(11) NOT NULL,
  `token` varchar(128) NOT NULL,
  `date_created` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `nasabah`
--
ALTER TABLE `nasabah`
  ADD PRIMARY KEY (`id_nasabah`);

--
-- Indexes for table `pengaduan`
--
ALTER TABLE `pengaduan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tabungan`
--
ALTER TABLE `tabungan`
  ADD PRIMARY KEY (`id_tabungan`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
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
-- Indexes for table `user_token`
--
ALTER TABLE `user_token`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `nasabah`
--
ALTER TABLE `nasabah`
  MODIFY `id_nasabah` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `pengaduan`
--
ALTER TABLE `pengaduan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tabungan`
--
ALTER TABLE `tabungan`
  MODIFY `id_tabungan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `user_access_menu`
--
ALTER TABLE `user_access_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `user_menu`
--
ALTER TABLE `user_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `user_role`
--
ALTER TABLE `user_role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `user_sub_menu`
--
ALTER TABLE `user_sub_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `user_token`
--
ALTER TABLE `user_token`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
