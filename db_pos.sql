-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 15 Mar 2018 pada 09.05
-- Versi Server: 10.1.8-MariaDB
-- PHP Version: 5.6.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_pos`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `apps_access_level`
--

CREATE TABLE `apps_access_level` (
  `access_level_id` int(11) NOT NULL,
  `module_id` int(11) NOT NULL,
  `jabatan_id` int(11) NOT NULL,
  `create_act` tinyint(4) NOT NULL,
  `read_act` tinyint(4) NOT NULL,
  `update_act` tinyint(4) NOT NULL,
  `delete_act` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `apps_active_login`
--

CREATE TABLE `apps_active_login` (
  `active_login_id` int(11) NOT NULL,
  `login_link_1` longtext NOT NULL,
  `login_link_2` longtext NOT NULL,
  `is_active` tinyint(4) NOT NULL,
  `info` text NOT NULL,
  `created` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `apps_active_login`
--

INSERT INTO `apps_active_login` (`active_login_id`, `login_link_1`, `login_link_2`, `is_active`, `info`, `created`) VALUES
(1, 'login/v1/', '', 1, 'Login Versi 1', '2017-12-26'),
(2, 'login/v1/', 'login/v1/loket/', 1, 'Login Loket', '2017-12-26');

-- --------------------------------------------------------

--
-- Struktur dari tabel `apps_jabatan`
--

CREATE TABLE `apps_jabatan` (
  `jabatan_id` int(11) NOT NULL,
  `jabatan_name` text NOT NULL,
  `access_module` text NOT NULL,
  `active_login_id` int(11) DEFAULT '1',
  `created` datetime NOT NULL,
  `created_by` varchar(25) DEFAULT NULL,
  `is_deleted` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `apps_jabatan`
--

INSERT INTO `apps_jabatan` (`jabatan_id`, `jabatan_name`, `access_module`, `active_login_id`, `created`, `created_by`, `is_deleted`) VALUES
(1, 'Design', '', 2, '0000-00-00 00:00:00', '', 0),
(2, 'Ready To Print', '', 2, '0000-00-00 00:00:00', '', 0),
(3, 'Supervisor', '', 2, '2017-12-01 09:45:24', NULL, 0),
(4, 'Manager', '', 2, '2017-12-01 09:49:45', NULL, 0),
(5, 'Produksi 1', '', 2, '2018-01-03 19:37:37', 'ajeng95', 0),
(6, 'Kasir', '', 2, '2018-01-07 09:33:16', 'ajeng95', 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `apps_login`
--

CREATE TABLE `apps_login` (
  `login_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `shift_id` int(11) NOT NULL,
  `no_loket` int(11) NOT NULL,
  `store_id` int(11) NOT NULL,
  `login_date` date NOT NULL,
  `login_time` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `apps_login`
--

INSERT INTO `apps_login` (`login_id`, `user_id`, `shift_id`, `no_loket`, `store_id`, `login_date`, `login_time`) VALUES
(1, 1, 0, 12, 1, '2017-12-11', '03:48:06'),
(2, 1, 1, 2, 1, '2017-12-11', '03:49:49'),
(3, 1, 1, 1, 1, '2017-12-11', '03:51:07'),
(4, 1, 1, 12, 1, '2017-12-11', '04:17:25'),
(5, 1, 1, 10, 1, '2017-12-11', '16:58:02'),
(6, 1, 1, 10, 1, '2017-12-12', '04:30:13'),
(7, 1, 1, 10, 1, '2017-12-12', '12:19:43'),
(8, 1, 1, 10, 1, '2017-12-12', '12:19:43'),
(9, 1, 1, 10, 1, '2017-12-12', '12:20:39'),
(10, 1, 1, 10, 1, '2017-12-12', '14:45:22'),
(11, 1, 1, 1, 1, '2017-12-12', '16:01:48'),
(12, 1, 1, 10, 1, '2017-12-12', '16:02:07'),
(13, 1, 1, 10, 1, '2017-12-13', '05:15:01'),
(14, 1, 1, 10, 1, '2017-12-14', '06:57:52'),
(15, 1, 1, 10, 1, '2017-12-14', '13:22:51'),
(16, 1, 1, 11, 1, '2017-12-15', '04:13:30'),
(17, 1, 1, 12, 1, '2017-12-15', '08:12:25'),
(18, 1, 1, 10, 1, '2017-12-16', '16:20:11'),
(19, 1, 1, 10, 1, '2017-12-16', '16:20:11'),
(20, 1, 1, 10, 1, '2017-12-17', '05:36:57'),
(21, 1, 1, 10, 1, '2017-12-17', '19:23:54'),
(22, 1, 1, 12, 1, '2017-12-18', '04:37:58'),
(23, 1, 1, 10, 1, '2017-12-18', '11:18:43'),
(24, 1, 1, 10, 1, '2017-12-19', '06:47:20'),
(25, 1, 1, 11, 1, '2017-12-19', '09:23:16'),
(26, 1, 1, 10, 1, '2017-12-19', '11:02:24'),
(27, 1, 1, 11, 1, '2017-12-19', '13:04:35'),
(28, 1, 1, 10, 1, '2017-12-19', '14:54:57'),
(29, 1, 1, 12, 1, '2017-12-20', '04:41:55'),
(30, 1, 1, 12, 1, '2017-12-21', '04:30:52'),
(31, 1, 1, 11, 1, '2017-12-21', '16:38:15'),
(32, 1, 1, 11, 1, '2017-12-21', '19:56:27'),
(33, 1, 1, 12, 1, '2017-12-23', '17:15:49'),
(34, 1, 1, 10, 1, '2017-12-24', '13:46:49'),
(35, 1, 1, 10, 1, '2017-12-25', '06:19:10'),
(36, 1, 1, 10, 1, '2017-12-25', '09:52:50'),
(37, 1, 1, 10, 1, '2017-12-25', '15:45:23'),
(38, 1, 1, 0, 1, '2017-12-26', '09:21:43'),
(39, 1, 1, 0, 1, '2017-12-26', '09:21:45'),
(40, 1, 1, 0, 1, '2017-12-26', '09:21:51'),
(41, 1, 1, 0, 1, '2017-12-26', '09:22:57'),
(42, 1, 1, 0, 1, '2017-12-26', '09:23:56'),
(43, 1, 1, 0, 1, '2017-12-26', '09:26:25'),
(44, 1, 1, 0, 1, '2017-12-26', '09:26:34'),
(45, 1, 1, 0, 1, '2017-12-26', '09:28:45'),
(46, 1, 1, 0, 1, '2017-12-26', '09:29:47'),
(47, 1, 1, 0, 1, '2017-12-26', '09:30:27'),
(48, 1, 1, 0, 1, '2017-12-26', '09:30:33'),
(49, 1, 1, 0, 1, '2017-12-26', '09:30:48'),
(50, 1, 1, 0, 1, '2017-12-26', '09:31:52'),
(51, 1, 1, 0, 1, '2017-12-26', '09:34:08'),
(52, 1, 1, 0, 1, '2017-12-26', '09:34:10'),
(53, 1, 1, 0, 1, '2017-12-26', '09:34:10'),
(54, 1, 1, 0, 1, '2017-12-26', '09:35:01'),
(55, 1, 1, 0, 1, '2017-12-26', '09:43:26'),
(56, 1, 1, 0, 1, '2017-12-26', '09:49:41'),
(57, 1, 1, 0, 1, '2017-12-26', '09:54:24'),
(58, 1, 1, 0, 1, '2017-12-26', '09:55:23'),
(59, 1, 1, 0, 1, '2017-12-26', '09:56:43'),
(60, 1, 1, 0, 1, '2017-12-26', '09:57:20'),
(61, 1, 1, 0, 1, '2017-12-26', '09:59:34'),
(62, 1, 1, 0, 1, '2017-12-26', '10:01:03'),
(63, 1, 1, 0, 1, '2017-12-26', '10:02:51'),
(64, 1, 1, 0, 1, '2017-12-26', '10:03:19'),
(65, 1, 1, 0, 1, '2017-12-26', '10:03:39'),
(66, 1, 1, 0, 1, '2017-12-26', '10:05:05'),
(67, 1, 1, 0, 1, '2017-12-26', '10:07:53'),
(68, 1, 1, 0, 1, '2017-12-26', '10:12:38'),
(69, 1, 1, 0, 1, '2017-12-26', '10:13:26'),
(70, 1, 1, 0, 1, '2017-12-26', '10:13:57'),
(71, 1, 1, 0, 1, '2017-12-26', '10:14:42'),
(72, 1, 1, 0, 1, '2017-12-26', '10:15:32'),
(73, 1, 1, 0, 1, '2017-12-26', '10:20:02'),
(74, 1, 1, 0, 1, '2017-12-26', '10:22:05'),
(75, 1, 1, 0, 1, '2017-12-26', '10:23:07'),
(76, 1, 1, 0, 1, '2017-12-26', '10:23:59'),
(77, 1, 1, 0, 1, '2017-12-26', '10:24:34'),
(78, 1, 1, 0, 1, '2017-12-26', '10:26:20'),
(79, 1, 1, 0, 1, '2017-12-26', '10:27:26'),
(80, 1, 1, 0, 1, '2017-12-26', '10:28:26'),
(81, 1, 1, 0, 1, '2017-12-26', '10:30:10'),
(82, 1, 1, 0, 1, '2017-12-26', '10:30:20'),
(83, 1, 1, 0, 1, '2017-12-26', '10:30:59'),
(84, 1, 0, 0, 1, '2017-12-26', '11:02:08'),
(85, 1, 0, 0, 1, '2017-12-26', '11:04:04'),
(86, 1, 0, 0, 1, '2017-12-26', '11:04:29'),
(87, 1, 0, 0, 1, '2017-12-26', '11:05:18'),
(88, 4, 3, 10, 2, '2018-01-13', '01:55:11'),
(89, 4, 3, 10, 2, '2018-01-13', '01:55:11'),
(90, 4, 3, 10, 2, '2018-01-13', '01:55:11'),
(91, 4, 3, 10, 2, '2018-01-13', '01:55:11'),
(92, 4, 3, 10, 2, '2018-01-13', '01:55:11'),
(93, 4, 3, 10, 2, '2018-01-13', '01:55:11'),
(94, 4, 3, 10, 2, '2018-01-13', '01:55:11'),
(95, 4, 3, 10, 2, '2018-01-13', '01:55:11'),
(96, 4, 3, 10, 2, '2018-01-13', '01:55:11'),
(97, 1, 0, 0, 1, '2017-12-26', '11:53:47'),
(98, 4, 3, 10, 2, '2018-01-13', '01:55:11'),
(99, 4, 3, 10, 2, '2018-01-13', '01:55:11'),
(100, 4, 3, 10, 2, '2018-01-13', '01:55:11'),
(101, 4, 3, 10, 2, '2018-01-13', '01:55:11'),
(102, 4, 3, 10, 2, '2018-01-13', '01:55:11'),
(103, 4, 3, 10, 2, '2018-01-13', '01:55:11'),
(104, 4, 3, 10, 2, '2018-01-13', '01:55:11'),
(105, 4, 3, 10, 2, '2018-01-13', '01:55:11'),
(106, 4, 3, 10, 2, '2018-01-13', '01:55:11'),
(107, 4, 3, 10, 2, '2018-01-13', '01:55:11'),
(108, 4, 3, 10, 2, '2018-01-13', '01:55:11'),
(109, 4, 3, 10, 2, '2018-01-13', '01:55:11'),
(110, 4, 3, 10, 2, '2018-01-13', '01:55:11'),
(111, 4, 3, 10, 2, '2018-01-13', '01:55:11'),
(112, 4, 3, 10, 2, '2018-01-13', '01:55:11'),
(113, 1, 0, 0, 1, '2018-01-04', '18:23:39'),
(114, 4, 3, 10, 2, '2018-01-13', '01:55:11'),
(115, 4, 3, 10, 2, '2018-01-13', '01:55:11'),
(116, 4, 3, 10, 2, '2018-01-13', '01:55:11'),
(117, 4, 3, 10, 2, '2018-01-13', '01:55:11'),
(118, 4, 3, 10, 2, '2018-01-13', '01:55:11'),
(119, 4, 3, 10, 2, '2018-01-13', '01:55:11'),
(120, 4, 3, 10, 2, '2018-01-13', '01:55:11'),
(121, 4, 3, 10, 2, '2018-01-13', '01:55:11'),
(122, 4, 3, 10, 2, '2018-01-13', '01:55:11'),
(123, 4, 3, 10, 2, '2018-01-13', '01:55:11'),
(124, 4, 3, 10, 2, '2018-01-13', '01:55:11'),
(125, 4, 3, 10, 2, '2018-01-13', '01:55:11'),
(126, 4, 3, 10, 2, '2018-01-13', '01:55:11'),
(127, 4, 3, 10, 2, '2018-01-13', '01:55:11'),
(128, 4, 3, 10, 2, '2018-01-13', '01:55:11'),
(129, 4, 3, 10, 2, '2018-01-13', '01:55:11'),
(130, 4, 3, 10, 2, '2018-01-13', '01:55:11'),
(131, 1, 0, 0, 1, '2018-01-13', '22:06:45'),
(132, 8, 0, 0, 1, '2018-01-17', '14:19:32'),
(133, 8, 0, 0, 1, '2018-01-17', '14:20:09'),
(134, 8, 0, 0, 1, '2018-01-17', '18:17:14'),
(135, 4, 0, 0, 1, '2018-01-17', '19:27:33'),
(136, 7, 0, 0, 1, '2018-01-18', '14:41:22'),
(137, 8, 0, 0, 1, '2018-01-18', '17:11:43'),
(138, 8, 0, 0, 1, '2018-01-19', '03:37:36'),
(139, 8, 0, 0, 1, '2018-01-19', '13:04:21'),
(140, 4, 0, 0, 1, '2018-01-19', '13:10:15'),
(141, 7, 0, 0, 1, '2018-01-19', '13:10:45'),
(142, 7, 0, 0, 1, '2018-01-19', '13:27:21'),
(143, 4, 0, 0, 1, '2018-01-19', '13:41:59'),
(144, 8, 0, 0, 1, '2018-01-20', '12:17:46'),
(145, 8, 0, 0, 1, '2018-01-20', '12:42:35'),
(146, 8, 0, 0, 1, '2018-01-20', '13:46:55'),
(147, 8, 0, 0, 1, '2018-01-20', '17:33:55'),
(148, 8, 0, 0, 1, '2018-01-21', '09:36:32'),
(149, 8, 0, 0, 1, '2018-01-22', '20:44:27'),
(150, 4, 0, 0, 1, '2018-01-23', '02:21:17'),
(151, 8, 0, 0, 1, '2018-01-23', '02:21:32'),
(152, 4, 0, 0, 1, '2018-01-23', '02:22:25');

-- --------------------------------------------------------

--
-- Struktur dari tabel `apps_master_queue`
--

CREATE TABLE `apps_master_queue` (
  `m_queue_id` int(11) NOT NULL,
  `queue_name` varchar(50) NOT NULL,
  `jabatan_id` int(11) NOT NULL,
  `first_word` varchar(2) NOT NULL,
  `is_deleted` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `apps_master_queue`
--

INSERT INTO `apps_master_queue` (`m_queue_id`, `queue_name`, `jabatan_id`, `first_word`, `is_deleted`) VALUES
(1, 'Design', 1, 'A', 0),
(2, 'Ready To Print', 2, 'B', 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `apps_module`
--

CREATE TABLE `apps_module` (
  `module_id` int(11) NOT NULL,
  `module_role_name` varchar(25) NOT NULL,
  `module_name` enum('master','sales','inventory','login','produce','queue','app_system','report') NOT NULL,
  `module_class` varchar(15) NOT NULL,
  `module_type` enum('do_read','do_create','do_update','do_delete') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `apps_module`
--

INSERT INTO `apps_module` (`module_id`, `module_role_name`, `module_name`, `module_class`, `module_type`) VALUES
(1, 'Menu Master', 'master', 'master', 'do_read'),
(2, 'Category Product', 'master', 'category', 'do_read'),
(3, 'Master Pengguna', 'master', 'user', 'do_read'),
(4, 'Master Unit', 'master', 'unit', 'do_read'),
(5, 'Master Printer', 'master', 'printer', 'do_read'),
(6, 'Master Produk', 'master', 'item', 'do_read'),
(7, 'Master Cabang', 'master', 'store', 'do_read'),
(8, 'Master Shift', 'master', 'shift', 'do_read'),
(9, 'Master Jabatan', 'master', 'jabatan', 'do_read'),
(10, 'Master Bank', 'master', 'bank', 'do_read'),
(11, 'Master Payment', 'master', 'payment', 'do_read'),
(12, 'Master Supplier', 'master', 'supplier', 'do_read'),
(13, 'Menu Modul Penjualan', 'sales', 'sales', 'do_read'),
(14, 'Menu Billing Penjualan', 'sales', 'billing', 'do_read'),
(15, 'Menu List Order', 'sales', 'billing', 'do_read'),
(16, 'Menu Piutang', 'sales', 'billing', 'do_read'),
(17, 'Menu Daftar Lunas', 'sales', 'billing', 'do_read'),
(18, 'Menu Retur Penjualan', 'sales', 'billing', 'do_read'),
(19, 'Menu Inventory', 'inventory', 'stock', 'do_read'),
(20, 'Lihat Stock', 'inventory', 'stock', 'do_read'),
(21, 'Menu Pergerakan Stock', 'inventory', 'stock', 'do_read'),
(22, 'Manage Stock Keluar', 'inventory', 'stock', 'do_read'),
(23, 'Manage Stock Masuk', 'inventory', 'stock', 'do_read'),
(24, 'Menu Antrian', 'queue', 'queue', 'do_read'),
(25, 'Display Antrian Pelanggan', 'queue', 'queue', 'do_read'),
(26, 'Print Antrian Pelanggan', 'queue', 'queue', 'do_read'),
(27, 'Menu Panggil Antrian', 'queue', 'queue', 'do_read'),
(28, 'Menu Produksi', 'produce', 'spk', 'do_read'),
(29, 'Menu Proses SPK', 'produce', 'spk', 'do_read'),
(30, 'Menu System', 'app_system', 'app_system', 'do_read'),
(31, 'Pengaturan System', 'app_system', 'setting', 'do_read'),
(32, 'Tombol Bayar Transaksi', 'sales', 'billing', 'do_update'),
(33, 'Menu Laporan', 'report', 'report', 'do_read'),
(34, 'Laporan Penjualan', 'report', 'sales', 'do_read'),
(35, 'Proses SPK', 'produce', 'spk', 'do_update');

-- --------------------------------------------------------

--
-- Struktur dari tabel `apps_printer`
--

CREATE TABLE `apps_printer` (
  `printer_id` int(11) NOT NULL,
  `printer_name` varchar(25) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `created_by` varchar(25) DEFAULT NULL,
  `is_deleted` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `apps_printer`
--

INSERT INTO `apps_printer` (`printer_id`, `printer_name`, `created`, `created_by`, `is_deleted`) VALUES
(1, 'Develop', '2017-12-21 09:15:19', 'agus94', 0),
(2, 'Canon', '2017-12-21 09:15:22', 'agus94', 0),
(3, 'Epson', '2017-12-02 16:18:36', NULL, 1),
(4, 'R17', '2017-12-21 21:47:09', 'agus94', 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `apps_queue`
--

CREATE TABLE `apps_queue` (
  `queue_id` int(11) NOT NULL,
  `m_queue_id` int(11) NOT NULL,
  `queue_number` varchar(10) NOT NULL,
  `is_done` int(11) NOT NULL,
  `date_created` date NOT NULL,
  `store_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `apps_queue`
--

INSERT INTO `apps_queue` (`queue_id`, `m_queue_id`, `queue_number`, `is_done`, `date_created`, `store_id`) VALUES
(378, 2, 'B 1', 1, '2018-01-19', 1),
(379, 2, 'B 2', 1, '2018-01-19', 1),
(380, 1, 'A 1', 1, '2018-01-19', 1),
(381, 2, 'B 3', 1, '2018-01-19', 1),
(382, 2, 'B 4', 1, '2018-01-19', 1),
(383, 1, 'A 2', 1, '2018-01-19', 1),
(384, 2, 'B 5', 1, '2018-01-19', 1),
(385, 2, 'B 6', 1, '2018-01-19', 1),
(386, 1, 'A 3', 1, '2018-01-19', 1),
(387, 2, 'B 7', 1, '2018-01-19', 1),
(388, 1, 'A 4', 1, '2018-01-19', 1),
(389, 1, 'A 5', 1, '2018-01-19', 1),
(390, 2, 'B 8', 1, '2018-01-19', 1),
(391, 1, 'A 6', 1, '2018-01-19', 1),
(392, 2, 'B 9', 1, '2018-01-19', 1),
(393, 1, 'A 7', 1, '2018-01-19', 1),
(394, 1, 'A 7', 1, '2018-01-19', 1),
(395, 1, 'A 7', 1, '2018-01-19', 1),
(396, 1, 'A 7', 1, '2018-01-19', 1),
(397, 2, 'B 10', 1, '2018-01-19', 1),
(398, 2, 'B 11', 1, '2018-01-19', 1),
(399, 2, 'B 12', 1, '2018-01-19', 1),
(400, 1, 'A 8', 1, '2018-01-19', 1),
(401, 1, 'A 9', 1, '2018-01-19', 1),
(402, 1, 'A 10', 1, '2018-01-19', 1),
(403, 1, 'A 1', 1, '2018-01-21', 1),
(404, 1, 'A 2', 1, '2018-01-21', 1),
(405, 2, 'B 1', 1, '2018-01-21', 1),
(406, 2, 'B 2', 0, '2018-01-21', 1),
(407, 1, 'A 1', 1, '2018-01-23', 1),
(408, 1, 'A 2', 0, '2018-01-23', 1),
(409, 1, 'A 3', 0, '2018-01-23', 1),
(410, 2, 'B 1', 0, '2018-01-23', 1),
(411, 2, 'B 2', 0, '2018-01-23', 1),
(412, 1, 'A 4', 0, '2018-01-23', 1),
(413, 1, 'A 5', 0, '2018-01-23', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `apps_role_access`
--

CREATE TABLE `apps_role_access` (
  `role_access_id` int(11) NOT NULL,
  `module_id` int(11) NOT NULL,
  `jabatan_id` int(11) NOT NULL,
  `is_active` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `apps_role_access`
--

INSERT INTO `apps_role_access` (`role_access_id`, `module_id`, `jabatan_id`, `is_active`) VALUES
(165, 24, 1, 1),
(166, 25, 1, 1),
(167, 26, 1, 1),
(168, 27, 1, 1),
(169, 24, 2, 1),
(170, 25, 2, 1),
(171, 26, 2, 1),
(172, 27, 2, 1),
(173, 28, 2, 1),
(174, 29, 2, 1),
(196, 13, 1, 1),
(197, 14, 1, 1),
(198, 17, 1, 1),
(199, 1, 4, 1),
(200, 2, 4, 1),
(201, 3, 4, 1),
(202, 4, 4, 1),
(203, 5, 4, 1),
(204, 6, 4, 1),
(205, 7, 4, 1),
(206, 8, 4, 1),
(207, 9, 4, 1),
(208, 10, 4, 1),
(209, 11, 4, 1),
(210, 12, 4, 1),
(211, 13, 4, 1),
(212, 14, 4, 1),
(213, 15, 4, 1),
(214, 16, 4, 1),
(215, 17, 4, 1),
(216, 18, 4, 1),
(217, 19, 4, 1),
(218, 20, 4, 1),
(219, 21, 4, 1),
(220, 22, 4, 1),
(221, 23, 4, 1),
(222, 24, 4, 1),
(223, 25, 4, 1),
(224, 26, 4, 1),
(225, 27, 4, 1),
(228, 30, 4, 1),
(229, 31, 4, 1),
(230, 32, 4, 1),
(231, 1, 3, 1),
(232, 2, 3, 1),
(233, 3, 3, 1),
(234, 4, 3, 1),
(235, 5, 3, 1),
(236, 6, 3, 1),
(237, 7, 3, 1),
(238, 8, 3, 1),
(239, 9, 3, 1),
(240, 10, 3, 1),
(241, 11, 3, 1),
(242, 12, 3, 1),
(243, 13, 3, 1),
(244, 14, 3, 1),
(245, 15, 3, 1),
(246, 16, 3, 1),
(247, 17, 3, 1),
(248, 18, 3, 1),
(249, 19, 3, 1),
(250, 20, 3, 1),
(251, 21, 3, 1),
(252, 22, 3, 1),
(253, 23, 3, 1),
(254, 24, 3, 1),
(255, 25, 3, 1),
(256, 26, 3, 1),
(257, 27, 3, 1),
(258, 28, 3, 1),
(259, 29, 3, 1),
(260, 30, 3, 1),
(261, 31, 3, 1),
(262, 32, 3, 1),
(263, 33, 4, 1),
(264, 34, 4, 1),
(273, 28, 4, 1),
(274, 29, 4, 1),
(275, 35, 4, 1),
(276, 13, 6, 1),
(277, 14, 6, 1),
(278, 15, 6, 1),
(279, 16, 6, 1),
(280, 17, 6, 1),
(281, 18, 6, 1),
(282, 32, 6, 1),
(283, 33, 6, 1),
(284, 34, 6, 1),
(285, 28, 1, 1),
(286, 29, 1, 1),
(287, 28, 5, 1),
(288, 29, 5, 1),
(289, 35, 5, 1),
(290, 13, 2, 1),
(291, 14, 2, 1),
(292, 15, 2, 1),
(293, 17, 2, 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `apps_shift`
--

CREATE TABLE `apps_shift` (
  `shift_id` int(11) NOT NULL,
  `shift_name` text NOT NULL,
  `created_by` varchar(25) DEFAULT NULL,
  `created` datetime NOT NULL,
  `is_deleted` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `apps_shift`
--

INSERT INTO `apps_shift` (`shift_id`, `shift_name`, `created_by`, `created`, `is_deleted`) VALUES
(1, 'Pagi', 'Agus', '2017-12-01 00:00:00', 0),
(2, 'Siang Malam', NULL, '2017-12-01 09:28:41', 0),
(3, 'Sore', NULL, '2017-12-01 09:21:09', 0),
(4, 'malam', NULL, '2017-12-01 09:29:15', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `apps_users`
--

CREATE TABLE `apps_users` (
  `user_id` int(11) NOT NULL,
  `store_id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `first_name` text NOT NULL,
  `last_name` text NOT NULL,
  `email` varchar(25) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `address` longtext NOT NULL,
  `status` enum('online','offline') NOT NULL DEFAULT 'offline',
  `avatar` varchar(50) NOT NULL,
  `is_active` tinyint(4) NOT NULL,
  `is_deleted` tinyint(4) NOT NULL,
  `created` datetime NOT NULL,
  `created_by` varchar(25) DEFAULT NULL,
  `jabatan_id` int(11) NOT NULL,
  `shift_id` int(11) NOT NULL,
  `no_loket` int(11) NOT NULL,
  `socket_id` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `apps_users`
--

INSERT INTO `apps_users` (`user_id`, `store_id`, `role_id`, `username`, `password`, `first_name`, `last_name`, `email`, `phone`, `address`, `status`, `avatar`, `is_active`, `is_deleted`, `created`, `created_by`, `jabatan_id`, `shift_id`, `no_loket`, `socket_id`) VALUES
(1, 1, 1, 'design', 'design', 'Agus Setiadi', '', 'sydoels@gmail.com', '081919835585', 'Jalan Raya Bojong Nanagka', 'offline', 'avatar-1.jpg', 0, 0, '0000-00-00 00:00:00', 'Administrator', 1, 1, 8, 'EloBr9ANR9c6KxhcAAAA'),
(3, 2, 0, 'ajeng94', 'kasir', 'Ajeng', '', '', '', '', 'offline', 'avatar-2.jpg', 0, 1, '0000-00-00 00:00:00', '', 2, 2, 0, ''),
(4, 1, 0, 'kasir', 'kasir', 'Novi', '', '', '', '', 'offline', 'avatar-2.jpg', 0, 0, '2017-12-01 08:35:20', '', 6, 1, 12, 'TMgf95rjnjItN9TdAAA7'),
(5, 0, 0, '', '', '', '', '', '', '', 'offline', 'avatar-3.jpg', 0, 1, '0000-00-00 00:00:00', NULL, 0, 0, 12, ''),
(6, 0, 0, '', '', '', '', '', '', '', 'offline', 'avatar-4.jpg', 0, 1, '0000-00-00 00:00:00', NULL, 0, 1, 2, ''),
(7, 1, 0, 'spv', 'spv', 'Jamal', '', '', '', '', 'offline', 'avatar-5.jpg', 0, 0, '2018-01-07 09:33:01', 'ajeng95', 3, 1, 3, 'AmKlAUdNnfFiQdcjAAAu'),
(8, 1, 0, 'manager', 'manager', 'Sasmito', '', '', '', '', 'offline', 'avatar-6.jpg', 0, 0, '2018-01-07 09:34:05', 'ajeng95', 4, 1, 12, 'oVLV9tbUeUnbt8LbAAAD'),
(9, 1, 0, 'rtp', 'rtp', 'Nabila', '', '', '', '', 'offline', 'male.jpg', 0, 0, '2018-01-19 13:28:15', 'spv', 2, 1, 4, 'y3g7MwVKgAg9tYVrAAAN'),
(10, 1, 0, 'design1', 'design1', 'Angga', '', '', '', '', 'offline', 'male.jpg', 0, 0, '2018-01-23 02:42:07', 'manager', 1, 1, 6, 'agI5iVQCBdj-52SuAAA2'),
(11, 1, 0, 'produksi', 'produksi', 'Sakti', '', '', '', '', 'offline', 'male.jpg', 0, 0, '2018-01-23 02:42:43', 'manager', 5, 1, 6, 'y59Q8sphZt7w4DohAAAo');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pos_bank`
--

CREATE TABLE `pos_bank` (
  `bank_id` int(11) NOT NULL,
  `bank_name` text NOT NULL,
  `created` datetime NOT NULL,
  `created_by` varchar(25) DEFAULT NULL,
  `is_deleted` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `pos_bank`
--

INSERT INTO `pos_bank` (`bank_id`, `bank_name`, `created`, `created_by`, `is_deleted`) VALUES
(1, 'BRI', '2018-01-03 17:27:01', 'ajeng95', 0),
(2, 'BRI Syariah', '2017-12-01 11:07:25', NULL, 1),
(3, 'BCA', '2017-12-15 09:20:51', 'agus94', 0),
(4, 'Mandiri Debit Card', '2017-12-14 12:12:03', 'agus94', 1),
(5, 'BCA Debit Card', '2017-12-14 12:13:28', 'agus94', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `pos_billing`
--

CREATE TABLE `pos_billing` (
  `billing_id` int(11) NOT NULL,
  `billing_no` varchar(50) NOT NULL,
  `store_id` int(11) DEFAULT NULL,
  `shift_id` int(11) DEFAULT NULL,
  `customer_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `billing_status` enum('temp','pending','done','success','cancel') NOT NULL,
  `paid_off` tinyint(4) NOT NULL,
  `total_paid` int(11) NOT NULL,
  `total_hpp` int(11) NOT NULL,
  `total_cash` int(11) NOT NULL,
  `credit_card_total` int(11) NOT NULL,
  `credit_card_bank` int(11) DEFAULT NULL,
  `credit_card_trx` varchar(100) NOT NULL,
  `debit_card_total` int(11) NOT NULL,
  `debit_card_bank` int(11) DEFAULT NULL,
  `debit_card_trx` varchar(100) NOT NULL,
  `total_billing` int(11) NOT NULL,
  `total_return` int(11) NOT NULL,
  `less_paid` int(11) NOT NULL,
  `total_pembulatan` int(11) NOT NULL,
  `tax_percent` int(11) NOT NULL,
  `tax_total` int(11) NOT NULL,
  `discount_percent_bill` int(11) NOT NULL,
  `discount_price_bill` int(11) NOT NULL,
  `discount_total` int(11) NOT NULL,
  `biaya_lain` int(11) NOT NULL,
  `grand_total` int(11) NOT NULL,
  `billing_notes` longtext,
  `payment_date` date NOT NULL,
  `payment_time` time NOT NULL,
  `created_by` text,
  `date_created` date NOT NULL,
  `time_created` time NOT NULL,
  `updated_by` varchar(50) NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `pos_billing`
--

INSERT INTO `pos_billing` (`billing_id`, `billing_no`, `store_id`, `shift_id`, `customer_id`, `user_id`, `phone`, `billing_status`, `paid_off`, `total_paid`, `total_hpp`, `total_cash`, `credit_card_total`, `credit_card_bank`, `credit_card_trx`, `debit_card_total`, `debit_card_bank`, `debit_card_trx`, `total_billing`, `total_return`, `less_paid`, `total_pembulatan`, `tax_percent`, `tax_total`, `discount_percent_bill`, `discount_price_bill`, `discount_total`, `biaya_lain`, `grand_total`, `billing_notes`, `payment_date`, `payment_time`, `created_by`, `date_created`, `time_created`, `updated_by`, `updated_at`) VALUES
(1, 'INV/18/03/08/1', NULL, NULL, 62, 8, NULL, 'temp', 0, 0, 20000, 0, 0, NULL, '', 0, NULL, '', 26000, 0, 0, 0, 0, 1300, 0, 0, 0, 0, 27300, NULL, '0000-00-00', '00:00:00', 'Sasmito', '2018-03-08', '21:44:01', '', '0000-00-00 00:00:00'),
(2, 'INV/18/03/08/2', NULL, NULL, 0, 8, NULL, 'pending', 0, 0, 30000, 0, 0, NULL, '', 0, NULL, '', 41000, 0, 0, 0, 0, 0, 0, 0, 0, 0, 41000, NULL, '0000-00-00', '00:00:00', 'Sasmito', '2018-03-08', '21:45:57', '', '0000-00-00 00:00:00'),
(3, 'INV/18/03/08/3', NULL, NULL, 62, 8, NULL, 'pending', 0, 950, 93000, 950, 0, 0, '', 0, 0, '', 115000, 0, 128000, 0, 0, 15450, 0, 0, 1500, 0, 128950, '', '2018-03-08', '21:55:19', 'Sasmito', '2018-03-08', '21:46:24', 'Sasmito', '2018-03-08 21:55:19'),
(4, 'INV/18/03/08/4', NULL, NULL, 0, 8, NULL, 'done', 0, 40000, 23000, 40000, 0, 0, '', 0, 0, '', 31500, 9150, 0, 0, 0, 0, 0, 0, 650, 0, 30850, '', '2018-03-08', '22:17:19', 'Sasmito', '2018-03-08', '22:16:51', 'Sasmito', '2018-03-08 22:17:19');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pos_billing_detail`
--

CREATE TABLE `pos_billing_detail` (
  `billing_detail_id` int(11) NOT NULL,
  `billing_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `unit_id` int(11) NOT NULL,
  `store_id` int(11) DEFAULT NULL,
  `shift_id` int(11) DEFAULT NULL,
  `order_qty` int(11) NOT NULL,
  `item_price` int(11) NOT NULL,
  `item_price_hpp` int(11) NOT NULL,
  `item_total_hpp` int(11) NOT NULL,
  `discount_percent` int(11) NOT NULL,
  `discount_price` int(11) NOT NULL,
  `discount_total` int(11) NOT NULL,
  `tax_percent` int(11) NOT NULL,
  `tax_price` int(11) NOT NULL,
  `tax_total` int(11) NOT NULL,
  `ket` text NOT NULL,
  `created_by` varchar(25) DEFAULT NULL,
  `date_created` date NOT NULL,
  `time_created` time NOT NULL,
  `is_deleted` tinyint(4) NOT NULL,
  `subtotal` int(11) NOT NULL,
  `total` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `pos_billing_detail`
--

INSERT INTO `pos_billing_detail` (`billing_detail_id`, `billing_id`, `item_id`, `unit_id`, `store_id`, `shift_id`, `order_qty`, `item_price`, `item_price_hpp`, `item_total_hpp`, `discount_percent`, `discount_price`, `discount_total`, `tax_percent`, `tax_price`, `tax_total`, `ket`, `created_by`, `date_created`, `time_created`, `is_deleted`, `subtotal`, `total`) VALUES
(403, 1, 6, 1, NULL, NULL, 2, 6500, 5000, 10000, 0, 0, 0, 10, 0, 1300, '', 'Sasmito', '2018-03-02', '23:18:12', 0, 13000, 14300),
(404, 2, 6, 1, NULL, NULL, 4, 6500, 5000, 20000, 0, 0, 0, 0, 0, 0, '', 'Sasmito', '2018-03-02', '23:26:17', 0, 26000, 26000),
(405, 3, 6, 1, NULL, NULL, 2, 6500, 5000, 10000, 0, 0, 0, 15, 0, 1950, '', 'Sasmito', '2018-03-02', '23:28:30', 0, 13000, 14950),
(406, 3, 7, 2, NULL, NULL, 5, 15000, 10000, 50000, 0, 0, 0, 15, 0, 11250, '', 'Sasmito', '2018-03-02', '23:30:51', 0, 75000, 86250),
(407, 3, 9, 6, NULL, NULL, 1, 15000, 25000, 25000, 10, 1500, 1500, 15, 2250, 2250, '', 'Sasmito', '2018-03-02', '23:33:30', 0, 15000, 15750),
(408, 4, 6, 1, NULL, NULL, 2, 6500, 5000, 10000, 0, 0, 0, 0, 0, 0, '', 'Sasmito', '2018-03-02', '23:41:41', 0, 13000, 13000),
(410, 4, 6, 1, NULL, NULL, 1, 6500, 5000, 5000, 10, 650, 650, 0, 0, 0, '', 'Sasmito', '2018-03-02', '23:42:34', 0, 6500, 5850),
(411, 5, 6, 1, NULL, NULL, 2, 6500, 5000, 10000, 0, 0, 0, 0, 0, 0, '', 'Sasmito', '2018-03-02', '23:46:23', 0, 13000, 13000),
(412, 5, 7, 2, NULL, NULL, 3, 15000, 10000, 30000, 0, 0, 0, 0, 0, 0, '', 'Sasmito', '2018-03-02', '23:46:30', 0, 45000, 45000),
(413, 5, 9, 6, NULL, NULL, 1, 15000, 25000, 25000, 0, 0, 0, 0, 0, 0, '', 'Sasmito', '2018-03-02', '23:46:38', 0, 15000, 15000),
(414, 5, 7, 2, NULL, NULL, 1, 15000, 10000, 10000, 10, 1500, 1500, 0, 0, 0, '', 'Sasmito', '2018-03-02', '23:47:13', 0, 15000, 13500),
(415, 6, 6, 1, NULL, NULL, 1, 6500, 5000, 5000, 0, 0, 0, 0, 0, 0, '', 'Sasmito', '2018-03-02', '23:52:10', 0, 6500, 6500),
(416, 6, 8, 3, NULL, NULL, 1, 12000, 8000, 8000, 10, 1200, 1200, 0, 0, 0, '', 'Sasmito', '2018-03-02', '23:52:20', 0, 12000, 10800),
(417, 7, 6, 1, NULL, NULL, 1, 6500, 5000, 5000, 0, 0, 0, 10, 0, 650, '', 'Sasmito', '2018-03-02', '23:56:46', 0, 6500, 7150),
(418, 7, 8, 3, NULL, NULL, 1, 12000, 8000, 8000, 0, 0, 0, 10, 0, 1200, '', 'Sasmito', '2018-03-02', '23:56:51', 0, 12000, 13200),
(419, 8, 6, 1, NULL, NULL, 1, 6500, 5000, 5000, 0, 0, 0, 0, 0, 0, '', 'Sasmito', '2018-03-03', '00:38:26', 0, 6500, 6500),
(420, 9, 6, 1, NULL, NULL, 1, 6500, 5000, 5000, 10, 650, 650, 0, 0, 0, '', 'Sasmito', '2018-03-03', '00:38:35', 0, 6500, 5850),
(421, 10, 6, 1, NULL, NULL, 1, 6500, 5000, 5000, 0, 0, 0, 0, 0, 0, '', 'Sasmito', '2018-03-03', '00:40:50', 0, 6500, 6500),
(422, 11, 6, 1, NULL, NULL, 1, 6500, 5000, 5000, 10, 650, 650, 0, 0, 0, '', 'Sasmito', '2018-03-03', '00:41:01', 0, 6500, 5850),
(423, 12, 6, 1, NULL, NULL, 1, 6500, 5000, 5000, 10, 650, 650, 0, 0, 0, '', 'Sasmito', '2018-03-03', '00:41:48', 0, 6500, 5850),
(424, 13, 6, 1, NULL, NULL, 1, 6500, 5000, 5000, 0, 0, 0, 0, 0, 0, '', 'Sasmito', '2018-03-03', '00:42:45', 0, 6500, 6500),
(425, 14, 6, 1, NULL, NULL, 1, 6500, 5000, 5000, 10, 650, 650, 0, 0, 0, '', 'Sasmito', '2018-03-03', '00:42:52', 0, 6500, 5850),
(426, 15, 6, 1, NULL, NULL, 1, 6500, 5000, 5000, 10, 650, 0, 0, 0, 0, '', 'Sasmito', '2018-03-03', '00:43:27', 0, 6500, 5850),
(427, 20, 6, 1, NULL, NULL, 1, 6500, 5000, 5000, 10, 650, 650, 0, 0, 0, '', 'Sasmito', '2018-03-03', '00:48:58', 0, 6500, 5850),
(428, 21, 6, 1, NULL, NULL, 1, 6500, 5000, 5000, 10, 650, 650, 100, 0, 6500, '', 'Sasmito', '2018-03-03', '00:53:30', 0, 6500, 12350),
(429, 22, 7, 2, NULL, NULL, 1, 15000, 10000, 10000, 10, 1500, 1500, 0, 0, 0, '', 'Sasmito', '2018-03-03', '00:55:49', 0, 15000, 13500),
(430, 23, 7, 2, NULL, NULL, 1, 15000, 10000, 10000, 0, 0, 0, 0, 0, 0, '', 'Sasmito', '2018-03-03', '00:56:33', 0, 15000, 15000),
(431, 24, 6, 1, NULL, NULL, 1, 6500, 5000, 5000, 0, 0, 0, 0, 0, 0, '', 'Sasmito', '2018-03-03', '00:56:56', 0, 6500, 6500),
(438, 27, 6, 1, NULL, NULL, 2, 6500, 5000, 10000, 0, 0, 0, 0, 0, 0, '', 'Sasmito', '2018-03-03', '01:17:53', 0, 13000, 13000),
(439, 27, 6, 1, NULL, NULL, 1, 6500, 5000, 5000, 10, 650, 650, 0, 0, 0, '', 'Sasmito', '2018-03-03', '01:18:03', 0, 6500, 5850),
(443, 28, 8, 3, NULL, NULL, 1, 12000, 8000, 8000, 0, 0, 0, 10, 0, 1200, '', 'Sasmito', '2018-03-03', '01:20:12', 0, 12000, 13200),
(445, 29, 6, 1, NULL, NULL, 2, 6500, 5000, 10000, 0, 0, 0, 0, 0, 0, '', 'Sasmito', '2018-03-03', '01:25:06', 0, 13000, 13000),
(446, 29, 9, 6, NULL, NULL, 2, 15000, 25000, 50000, 0, 0, 0, 0, 1500, 0, '', 'Sasmito', '2018-03-03', '01:25:22', 0, 30000, 30000),
(447, 31, 6, 1, NULL, NULL, 2, 6500, 5000, 10000, 0, 0, 0, 0, 0, 0, '', 'Sasmito', '2018-03-03', '19:17:15', 0, 13000, 13000),
(448, 32, 7, 2, NULL, NULL, 1, 15000, 10000, 10000, 0, 0, 0, 0, 0, 0, '', 'Sasmito', '2018-03-03', '19:19:03', 0, 15000, 15000),
(449, 33, 6, 1, NULL, NULL, 1, 6500, 5000, 5000, 0, 0, 0, 0, 0, 0, '', 'Sasmito', '2018-03-03', '19:26:07', 0, 6500, 6500),
(450, 34, 6, 1, NULL, NULL, 2, 6500, 5000, 10000, 0, 0, 0, 0, 0, 0, '', 'Sasmito', '2018-03-03', '19:37:31', 0, 13000, 13000),
(451, 34, 9, 6, NULL, NULL, 1, 15000, 25000, 25000, 10, 1500, 1500, 0, 0, 0, '', 'Sasmito', '2018-03-03', '19:37:43', 0, 15000, 13500),
(452, 35, 6, 1, NULL, NULL, 1, 6500, 5000, 5000, 0, 0, 0, 0, 0, 0, '', 'Sasmito', '2018-03-03', '19:38:03', 0, 6500, 6500),
(453, 35, 9, 6, NULL, NULL, 2, 15000, 25000, 50000, 10, 1500, 3000, 0, 0, 0, '', 'Sasmito', '2018-03-03', '19:38:12', 0, 30000, 27000),
(454, 35, 8, 3, NULL, NULL, 4, 12000, 8000, 32000, 0, 0, 0, 0, 0, 0, '', 'Sasmito', '2018-03-03', '19:38:33', 0, 48000, 48000),
(455, 36, 6, 1, NULL, NULL, 2, 6500, 5000, 10000, 0, 0, 0, 0, 0, 0, '', 'Sasmito', '2018-03-03', '19:40:55', 0, 13000, 13000),
(456, 37, 6, 1, NULL, NULL, 2, 6500, 5000, 10000, 0, 0, 0, 0, 0, 0, '', 'Sasmito', '2018-03-03', '19:41:51', 0, 13000, 13000),
(457, 37, 9, 6, NULL, NULL, 3, 15000, 25000, 75000, 10, 1500, 4500, 0, 0, 0, '', 'Sasmito', '2018-03-03', '19:41:59', 0, 45000, 40500),
(458, 38, 6, 1, NULL, NULL, 2, 6500, 5000, 10000, 0, 0, 0, 0, 0, 0, '', 'Sasmito', '2018-03-03', '19:44:49', 0, 13000, 13000),
(459, 38, 9, 6, NULL, NULL, 1, 15000, 25000, 25000, 10, 1500, 1500, 0, 0, 0, '', 'Sasmito', '2018-03-03', '19:44:56', 0, 15000, 13500),
(460, 39, 6, 1, NULL, NULL, 2, 6500, 5000, 10000, 0, 0, 0, 0, 0, 0, '', 'Sasmito', '2018-03-03', '19:45:49', 0, 13000, 13000),
(461, 39, 9, 6, NULL, NULL, 1, 15000, 25000, 25000, 10, 1500, 1500, 0, 0, 0, '', 'Sasmito', '2018-03-03', '19:45:55', 0, 15000, 13500),
(462, 40, 7, 2, NULL, NULL, 1, 15000, 10000, 10000, 0, 0, 0, 0, 0, 0, '', 'Sasmito', '2018-03-04', '09:21:52', 0, 15000, 15000),
(463, 41, 6, 1, NULL, NULL, 2, 6500, 5000, 10000, 0, 0, 0, 10, 0, 1300, '', 'Sasmito', '2018-03-04', '09:56:20', 0, 13000, 14300),
(464, 42, 7, 2, NULL, NULL, 1, 15000, 10000, 10000, 0, 0, 0, 0, 0, 0, '', 'Sasmito', '2018-03-04', '09:58:14', 0, 15000, 15000),
(465, 43, 7, 2, NULL, NULL, 2, 15000, 10000, 20000, 0, 0, 0, 0, 0, 0, '', 'Sasmito', '2018-03-04', '12:24:14', 0, 30000, 30000),
(466, 44, 7, 2, NULL, NULL, 2, 15000, 10000, 20000, 0, 0, 0, 0, 0, 0, '', 'Sasmito', '2018-03-04', '12:28:00', 0, 30000, 30000),
(467, 45, 6, 1, NULL, NULL, 2, 6500, 5000, 10000, 0, 0, 0, 0, 0, 0, '', 'Sasmito', '2018-03-04', '12:29:25', 0, 13000, 13000),
(468, 46, 6, 1, NULL, NULL, 2, 6500, 5000, 10000, 0, 0, 0, 0, 0, 0, '', 'Sasmito', '2018-03-04', '12:31:15', 0, 13000, 13000),
(469, 47, 6, 1, NULL, NULL, 2, 6500, 5000, 10000, 0, 0, 0, 0, 0, 0, '', 'Sasmito', '2018-03-04', '12:34:10', 0, 13000, 13000),
(470, 48, 6, 1, NULL, NULL, 2, 6500, 5000, 15000, 0, 0, 0, 0, 0, 0, '', 'Sasmito', '2018-03-04', '12:35:13', 0, 13000, 13000),
(472, 49, 8, 3, NULL, NULL, 4, 12000, 8000, 32000, 0, 0, 0, 10, 1200, 4800, '', 'Sasmito', '2018-03-04', '12:36:51', 0, 48000, 52800),
(473, 50, 6, 1, NULL, NULL, 1, 6500, 5000, 5000, 15, 975, 975, 0, 0, 0, '', 'Sasmito', '2018-03-04', '14:26:33', 0, 6500, 5525),
(474, 51, 6, 1, NULL, NULL, 4, 6500, 5000, 20000, 15, 975, 3900, 0, 0, 0, '', 'Sasmito', '2018-03-04', '14:53:08', 0, 26000, 22100),
(475, 52, 6, 1, NULL, NULL, 1, 6500, 5000, 5000, 10, 650, 650, 0, 0, 0, '', 'Sasmito', '2018-03-04', '15:14:04', 0, 6500, 5850),
(477, 54, 6, 1, NULL, NULL, 4, 6500, 5000, 10000, 10, 700, 2800, 0, 0, 0, '', 'Sasmito', '2018-03-04', '15:17:51', 0, 26000, 23200),
(478, 54, 6, 1, NULL, NULL, 1, 6500, 5000, 5000, 0, 0, 0, 0, 0, 0, '', 'Sasmito', '2018-03-04', '15:22:01', 0, 6500, 6500),
(482, 55, 8, 3, NULL, NULL, 1, 12000, 8000, 8000, 0, 0, 0, 0, 0, 0, '', 'Sasmito', '2018-03-04', '15:29:14', 0, 12000, 12000),
(483, 56, 7, 2, NULL, NULL, 2, 15000, 10000, 20000, 50, 7500, 15000, 0, 0, 0, '', 'Sasmito', '2018-03-04', '15:35:39', 0, 30000, 15000),
(484, 57, 6, 1, NULL, NULL, 1, 6500, 5000, 5000, 0, 0, 0, 0, 0, 0, '', 'Sasmito', '2018-03-04', '15:47:32', 0, 6500, 6500),
(485, 58, 6, 1, NULL, NULL, 1, 6500, 5000, 5000, 0, 0, 0, 0, 0, 0, '', 'Sasmito', '2018-03-04', '15:52:46', 0, 6500, 6500),
(486, 59, 8, 3, NULL, NULL, 1, 12000, 8000, 8000, 0, 0, 0, 0, 0, 0, '', 'Sasmito', '2018-03-04', '15:53:43', 0, 12000, 12000),
(487, 60, 6, 1, NULL, NULL, 2, 6500, 5000, 10000, 0, 0, 0, 0, 0, 0, '', 'Sasmito', '2018-03-04', '15:54:09', 0, 13000, 13000),
(488, 61, 6, 1, NULL, NULL, 2, 6500, 5000, 10000, 0, 0, 0, 10, 0, 1300, '', 'Sasmito', '2018-03-04', '16:02:51', 0, 13000, 14300),
(489, 61, 9, 6, NULL, NULL, 1, 15000, 25000, 25000, 0, 0, 0, 10, 0, 1500, '', 'Sasmito', '2018-03-04', '16:02:56', 0, 15000, 16500),
(490, 62, 6, 1, NULL, NULL, 4, 6500, 5000, 20000, 0, 0, 0, 0, 0, 0, '', 'Sasmito', '2018-03-04', '16:08:12', 0, 26000, 26000),
(491, 63, 6, 1, NULL, NULL, 4, 6500, 5000, 20000, 0, 0, 0, 0, 0, 0, '', 'Sasmito', '2018-03-04', '16:09:54', 0, 26000, 26000),
(492, 64, 6, 1, NULL, NULL, 2, 6500, 5000, 10000, 0, 0, 0, 0, 0, 0, '', 'Sasmito', '2018-03-04', '16:22:25', 0, 13000, 13000),
(493, 65, 7, 2, NULL, NULL, 2, 15000, 10000, 20000, 0, 0, 0, 0, 0, 0, '', 'Sasmito', '2018-03-04', '16:23:20', 0, 30000, 30000),
(494, 66, 7, 2, NULL, NULL, 2, 15000, 10000, 20000, 0, 0, 0, 0, 0, 0, '', 'Sasmito', '2018-03-04', '16:25:01', 0, 30000, 30000),
(495, 67, 6, 1, NULL, NULL, 4, 6500, 5000, 20000, 0, 0, 0, 0, 0, 0, '', 'Sasmito', '2018-03-04', '16:27:46', 0, 26000, 26000),
(496, 68, 6, 1, NULL, NULL, 2, 6500, 5000, 10000, 0, 0, 0, 0, 0, 0, '', 'Sasmito', '2018-03-04', '16:31:52', 0, 13000, 13000),
(498, 68, 9, 6, NULL, NULL, 1, 15000, 25000, 25000, 10, 1500, 1500, 0, 0, 0, '', 'Sasmito', '2018-03-04', '16:40:51', 0, 15000, 13500),
(499, 69, 7, 2, NULL, NULL, 3, 15000, 10000, 30000, 10, 1500, 4500, 0, 1500, 0, '', 'Sasmito', '2018-03-04', '19:01:04', 0, 45000, 40500),
(500, 69, 7, 2, NULL, NULL, 2, 15000, 10000, 20000, 0, 0, 0, 0, 1500, 0, '', 'Sasmito', '2018-03-04', '19:02:48', 0, 30000, 30000),
(501, 70, 7, 2, NULL, NULL, 2, 15000, 10000, 20000, 0, 0, 0, 0, 0, 0, '', 'Sasmito', '2018-03-04', '19:07:41', 0, 30000, 30000),
(502, 71, 6, 1, NULL, NULL, 4, 6500, 5000, 20000, 0, 0, 0, 15, 0, 3900, '', 'Sasmito', '2018-03-05', '07:15:51', 0, 26000, 29900),
(503, 71, 9, 6, NULL, NULL, 2, 15000, 25000, 50000, 0, 0, 0, 15, 0, 4500, '', 'Sasmito', '2018-03-05', '07:16:26', 0, 30000, 34500),
(504, 71, 7, 2, NULL, NULL, 1, 15000, 10000, 10000, 6, 1000, 1000, 15, 0, 2250, '', 'Sasmito', '2018-03-05', '07:16:55', 0, 15000, 16250),
(505, 72, 7, 2, NULL, NULL, 1, 15000, 10000, 10000, 0, 0, 0, 0, 0, 0, '', 'Sasmito', '2018-03-05', '15:39:31', 0, 15000, 15000),
(506, 73, 6, 1, NULL, NULL, 2, 6500, 5000, 10000, 0, 0, 0, 0, 0, 0, '', 'Sasmito', '2018-03-05', '15:44:21', 0, 13000, 13000),
(507, 74, 8, 3, NULL, NULL, 2, 12000, 8000, 16000, 0, 0, 0, 0, 0, 0, '', 'Sasmito', '2018-03-05', '15:45:34', 0, 24000, 24000),
(508, 75, 6, 1, NULL, NULL, 1, 6500, 5000, 5000, 0, 0, 0, 0, 0, 0, '', 'Sasmito', '2018-03-05', '15:47:17', 0, 6500, 6500),
(509, 76, 8, 3, NULL, NULL, 2, 12000, 8000, 16000, 0, 0, 0, 0, 0, 0, '', 'Sasmito', '2018-03-05', '15:47:58', 0, 24000, 24000),
(510, 77, 7, 2, NULL, NULL, 2, 15000, 10000, 20000, 0, 0, 0, 0, 0, 0, '', 'Sasmito', '2018-03-05', '15:48:59', 0, 30000, 30000),
(511, 78, 8, 3, NULL, NULL, 2, 12000, 8000, 16000, 0, 0, 0, 0, 0, 0, '', 'Sasmito', '2018-03-05', '15:54:58', 0, 24000, 24000),
(512, 79, 6, 1, NULL, NULL, 2, 6500, 5000, 10000, 0, 0, 0, 0, 0, 0, '', 'Sasmito', '2018-03-05', '15:56:36', 0, 13000, 13000),
(513, 80, 7, 2, NULL, NULL, 1, 15000, 10000, 10000, 0, 0, 0, 0, 0, 0, '', 'Sasmito', '2018-03-05', '15:57:58', 0, 15000, 15000),
(514, 81, 7, 2, NULL, NULL, 2, 15000, 10000, 20000, 0, 0, 0, 0, 0, 0, '', 'Sasmito', '2018-03-05', '15:58:42', 0, 30000, 30000),
(515, 82, 7, 2, NULL, NULL, 1, 15000, 10000, 10000, 0, 0, 0, 0, 0, 0, '', 'Sasmito', '2018-03-05', '16:04:13', 0, 15000, 15000),
(516, 83, 8, 3, NULL, NULL, 1, 12000, 8000, 8000, 0, 0, 0, 0, 0, 0, '', 'Sasmito', '2018-03-05', '16:06:38', 0, 12000, 12000),
(517, 84, 7, 2, NULL, NULL, 3, 15000, 10000, 30000, 0, 0, 0, 0, 0, 0, '', 'Sasmito', '2018-03-05', '16:10:05', 0, 45000, 45000),
(518, 85, 7, 2, NULL, NULL, 2, 15000, 10000, 20000, 0, 0, 0, 0, 0, 0, '', 'Sasmito', '2018-03-05', '16:11:14', 0, 30000, 30000),
(519, 86, 7, 2, NULL, NULL, 4, 15000, 10000, 40000, 0, 0, 0, 0, 0, 0, '', 'Sasmito', '2018-03-05', '17:23:44', 0, 60000, 60000),
(520, 87, 7, 2, NULL, NULL, 1, 15000, 10000, 10000, 0, 0, 0, 0, 0, 0, '', 'Sasmito', '2018-03-05', '17:24:30', 0, 15000, 15000),
(521, 88, 6, 1, NULL, NULL, 2, 6500, 5000, 10000, 0, 0, 0, 0, 0, 0, '', 'Sasmito', '2018-03-05', '17:25:25', 0, 13000, 13000),
(522, 89, 8, 3, NULL, NULL, 6, 12000, 8000, 48000, 0, 0, 0, 0, 0, 0, '', 'Sasmito', '2018-03-05', '17:25:53', 0, 72000, 72000),
(523, 89, 9, 6, NULL, NULL, 1, 15000, 25000, 25000, 33, 5000, 5000, 0, 0, 0, '', 'Sasmito', '2018-03-05', '17:26:03', 0, 15000, 10000),
(524, 90, 6, 1, NULL, NULL, 1, 6500, 5000, 5000, 0, 0, 0, 0, 0, 0, '', 'Sasmito', '2018-03-05', '17:30:51', 0, 6500, 6500),
(525, 91, 7, 2, NULL, NULL, 1, 15000, 10000, 10000, 0, 0, 0, 0, 0, 0, '', 'Sasmito', '2018-03-05', '17:32:56', 0, 15000, 15000),
(526, 92, 6, 1, NULL, NULL, 1, 6500, 5000, 5000, 0, 0, 0, 0, 0, 0, '', 'Sasmito', '2018-03-05', '17:35:20', 0, 6500, 6500),
(527, 93, 8, 3, NULL, NULL, 1, 12000, 8000, 8000, 0, 0, 0, 0, 0, 0, '', 'Sasmito', '2018-03-05', '17:36:00', 0, 12000, 12000),
(528, 94, 7, 2, NULL, NULL, 2, 15000, 10000, 20000, 0, 0, 0, 0, 0, 0, '', 'Sasmito', '2018-03-05', '17:36:48', 0, 30000, 30000),
(529, 95, 7, 2, NULL, NULL, 1, 15000, 10000, 10000, 0, 0, 0, 0, 0, 0, '', 'Sasmito', '2018-03-05', '17:38:46', 0, 15000, 15000),
(530, 96, 8, 3, NULL, NULL, 2, 12000, 8000, 16000, 0, 0, 0, 0, 0, 0, '', 'Sasmito', '2018-03-05', '17:39:03', 0, 24000, 24000),
(531, 97, 7, 2, NULL, NULL, 1, 15000, 10000, 10000, 0, 0, 0, 0, 0, 0, '', 'Sasmito', '2018-03-05', '17:40:37', 0, 15000, 15000),
(532, 98, 6, 1, NULL, NULL, 2, 6500, 5000, 10000, 0, 0, 0, 0, 0, 0, '', 'Sasmito', '2018-03-05', '17:41:18', 0, 13000, 13000),
(533, 99, 6, 1, NULL, NULL, 1, 6500, 5000, 5000, 0, 0, 0, 0, 0, 0, '', 'Sasmito', '2018-03-05', '17:48:50', 0, 6500, 6500),
(534, 100, 8, 3, NULL, NULL, 1, 12000, 8000, 8000, 0, 0, 0, 0, 0, 0, '', 'Sasmito', '2018-03-05', '17:49:42', 0, 12000, 12000),
(535, 101, 7, 2, NULL, NULL, 1, 15000, 10000, 10000, 0, 0, 0, 0, 0, 0, '', 'Sasmito', '2018-03-05', '17:52:00', 0, 15000, 15000),
(536, 102, 6, 1, NULL, NULL, 1, 6500, 5000, 5000, 0, 0, 0, 0, 0, 0, '', 'Sasmito', '2018-03-05', '17:54:19', 0, 6500, 6500),
(537, 103, 7, 2, NULL, NULL, 2, 15000, 10000, 20000, 0, 0, 0, 0, 0, 0, '', 'Sasmito', '2018-03-05', '17:55:40', 0, 30000, 30000),
(538, 104, 6, 1, NULL, NULL, 1, 6500, 5000, 5000, 0, 0, 0, 0, 0, 0, '', 'Sasmito', '2018-03-05', '17:57:31', 0, 6500, 6500),
(539, 105, 6, 1, NULL, NULL, 2, 6500, 5000, 10000, 0, 0, 0, 0, 0, 0, '', 'Sasmito', '2018-03-05', '17:58:08', 0, 13000, 13000),
(540, 106, 9, 6, NULL, NULL, 1, 15000, 25000, 25000, 0, 0, 0, 0, 0, 0, '', 'Sasmito', '2018-03-05', '17:58:48', 0, 15000, 15000),
(541, 107, 7, 2, NULL, NULL, 1, 15000, 10000, 10000, 0, 0, 0, 0, 0, 0, '', 'Sasmito', '2018-03-05', '17:59:27', 0, 15000, 15000),
(542, 108, 7, 2, NULL, NULL, 1, 15000, 10000, 10000, 0, 0, 0, 0, 0, 0, '', 'Sasmito', '2018-03-05', '18:00:47', 0, 15000, 15000),
(543, 109, 7, 2, NULL, NULL, 1, 15000, 10000, 10000, 0, 0, 0, 0, 0, 0, '', 'Sasmito', '2018-03-05', '18:01:28', 0, 15000, 15000),
(544, 110, 7, 2, NULL, NULL, 1, 15000, 10000, 10000, 0, 0, 0, 0, 0, 0, '', 'Sasmito', '2018-03-05', '18:03:30', 0, 15000, 15000),
(545, 111, 7, 2, NULL, NULL, 1, 15000, 10000, 10000, 0, 0, 0, 0, 0, 0, '', 'Sasmito', '2018-03-05', '18:03:57', 0, 15000, 15000),
(546, 112, 7, 2, NULL, NULL, 1, 15000, 10000, 10000, 0, 0, 0, 0, 0, 0, '', 'Sasmito', '2018-03-05', '18:06:29', 0, 15000, 15000),
(547, 113, 7, 2, NULL, NULL, 1, 15000, 10000, 10000, 0, 0, 0, 0, 0, 0, '', 'Sasmito', '2018-03-05', '18:07:11', 0, 15000, 15000),
(548, 114, 7, 2, NULL, NULL, 1, 15000, 10000, 10000, 0, 0, 0, 0, 0, 0, '', 'Sasmito', '2018-03-05', '20:59:49', 0, 15000, 15000),
(549, 114, 9, 6, NULL, NULL, 1, 15000, 25000, 25000, 0, 0, 0, 0, 0, 0, '', 'Sasmito', '2018-03-05', '20:59:54', 0, 15000, 15000),
(550, 115, 6, 1, NULL, NULL, 1, 6500, 5000, 5000, 0, 0, 0, 0, 0, 0, '', 'Sasmito', '2018-03-05', '21:03:00', 0, 6500, 6500),
(551, 115, 9, 6, NULL, NULL, 1, 15000, 25000, 25000, 0, 0, 0, 0, 0, 0, '', 'Sasmito', '2018-03-05', '21:03:05', 0, 15000, 15000),
(552, 116, 7, 2, NULL, NULL, 2, 15000, 10000, 20000, 0, 0, 0, 0, 0, 0, '', 'Sasmito', '2018-03-05', '22:11:20', 0, 30000, 30000),
(553, 116, 8, 3, NULL, NULL, 1, 12000, 8000, 8000, 0, 0, 0, 0, 0, 0, '', 'Sasmito', '2018-03-05', '22:11:25', 0, 12000, 12000),
(554, 117, 6, 1, NULL, NULL, 1, 6500, 5000, 5000, 0, 0, 0, 0, 0, 0, '', 'Sasmito', '2018-03-05', '22:11:49', 0, 6500, 6500),
(555, 118, 7, 2, NULL, NULL, 1, 15000, 10000, 10000, 0, 0, 0, 0, 0, 0, '', 'Sasmito', '2018-03-08', '21:13:08', 0, 15000, 15000),
(556, 1, 6, 1, NULL, NULL, 2, 6500, 5000, 10000, 0, 0, 0, 0, 0, 0, '', 'Sasmito', '2018-03-08', '21:44:01', 0, 13000, 13000),
(557, 2, 7, 2, NULL, NULL, 1, 15000, 10000, 10000, 0, 0, 0, 0, 0, 0, '', 'Sasmito', '2018-03-08', '21:45:57', 0, 15000, 15000),
(558, 3, 8, 3, NULL, NULL, 1, 12000, 8000, 8000, 0, 0, 0, 0, 0, 0, '', 'Sasmito', '2018-03-08', '21:46:24', 0, 12000, 12000),
(559, 4, 8, 3, NULL, NULL, 1, 12000, 8000, 8000, 0, 0, 0, 0, 0, 0, '', 'Sasmito', '2018-03-08', '22:16:51', 0, 12000, 12000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `pos_category`
--

CREATE TABLE `pos_category` (
  `category_id` int(11) NOT NULL,
  `category_name` text NOT NULL,
  `created` datetime NOT NULL,
  `created_by` varchar(25) DEFAULT NULL,
  `is_deleted` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `pos_category`
--

INSERT INTO `pos_category` (`category_id`, `category_name`, `created`, `created_by`, `is_deleted`) VALUES
(1, 'Fotocopy', '2017-12-02 12:21:23', NULL, 0),
(2, 'Print', '2017-12-02 12:21:51', NULL, 0),
(3, 'Jilid', '2017-12-02 12:54:29', NULL, 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `pos_customer`
--

CREATE TABLE `pos_customer` (
  `customer_id` int(11) NOT NULL,
  `customer_code` varchar(15) NOT NULL,
  `customer_name` text NOT NULL,
  `customer_phone` varchar(50) NOT NULL,
  `customer_address` longtext NOT NULL,
  `created_by` varchar(25) NOT NULL,
  `created` date NOT NULL,
  `is_deleted` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `pos_customer`
--

INSERT INTO `pos_customer` (`customer_id`, `customer_code`, `customer_name`, `customer_phone`, `customer_address`, `created_by`, `created`, `is_deleted`) VALUES
(61, 'PLG-1', 'Adib Amrullah', '081919835585', '', 'Amirah', '2018-02-22', 0),
(62, 'PLG-62', 'Wawan', '081919835585', 'Kalisari', 'Amirah', '2018-02-22', 0),
(63, 'PLG-63', 'Irpan', '0819198458585', '', 'Amirah', '2018-02-22', 0),
(64, 'PLG-64', 'Agus Setiadi', '1234', '', '', '2018-02-22', 0),
(65, 'PLG-65', 'Agus Setiadi', '081919835585', '', '', '2018-02-23', 0),
(66, 'PLG-66', 'afrizal', '087874476491', '', 'Amirah', '2018-02-24', 0),
(67, 'PLG-67', 'Gunawan', '08567088052', '', 'Amirah', '2018-02-24', 0),
(68, 'PLG-68', 'gofar', '08567998491', '', 'Amirah', '2018-02-24', 0),
(69, 'PLG-69', 'ismail', '089695056606', '', 'Amirah', '2018-02-24', 0),
(70, 'PLG-70', 'wahyudi', '08571109207', '', 'Amirah', '2018-02-24', 0),
(71, 'PLG-71', 'asep muyana', '085780166713`', '', 'Amirah', '2018-02-24', 0),
(72, 'PLG-72', 'Muslim', '087887343645', '', 'Amirah', '2018-02-24', 0),
(73, 'PLG-73', 'Jono', '08787343645', '', 'Amirah', '2018-02-24', 0),
(74, 'PLG-74', 'ahmad ridwan', '085695150737', '', 'Amirah', '2018-02-24', 0),
(75, 'PLG-75', 'Didik Kustanto', '081919835585', 'as', 'Amirah', '2018-02-24', 0),
(76, 'PLG-76', 'puncak', '', '', 'Amirah', '2018-02-25', 0),
(77, 'PLG-77', 'Rospati', '', '', 'Amirah', '2018-02-25', 0),
(78, 'PLG-78', 'Emin ', '', '', 'Amirah', '2018-02-25', 0),
(79, 'PLG-79', 'Bu Sadono', '', '', 'Amirah', '2018-02-25', 0),
(80, 'PLG-80', 'Lasmari', '', '', 'Amirah', '2018-02-25', 0),
(81, 'PLG-81', 'Heriyano', '', 'Kranggan', 'Amirah', '2018-02-25', 0),
(82, 'PLG-82', 'Salim', '', 'Cieungsi', 'Amirah', '2018-02-25', 0),
(83, 'PLG-83', 'Winarto', '', 'GBJ', 'Amirah', '2018-02-25', 0),
(84, 'PLG-84', 'Mulyadi', '', '', 'Amirah', '2018-02-25', 0),
(85, 'PLG-85', 'Saipul Bakri', '', '', 'Amirah', '2018-02-25', 0),
(86, 'PLG-86', 'Nanang', '', 'Pondok Cabe', 'Amirah', '2018-02-25', 0),
(87, 'PLG-87', 'Jani', '', '', 'Amirah', '2018-02-25', 0),
(88, 'PLG-88', 'Bibit Calas', '', '', 'Amirah', '2018-02-25', 0),
(89, 'PLG-89', 'Hasan', '', 'Jakarta', 'Amirah', '2018-02-25', 0),
(90, 'PLG-90', 'Lilis', '', 'PPHB', 'Amirah', '2018-02-25', 0),
(91, 'PLG-91', 'Sugimin', '', '', 'Amirah', '2018-02-25', 0),
(92, 'PLG-92', 'Erna', '', '', 'Amirah', '2018-02-25', 0),
(93, 'PLG-93', 'Akhyar', '', '', 'Amirah', '2018-02-25', 0),
(94, 'PLG-94', 'Ibu Anni', '', '', 'Amirah', '2018-02-25', 0),
(95, 'PLG-95', 'Bpk Setiawan', '', '', 'Amirah', '2018-02-25', 0),
(96, 'PLG-96', 'Uus', '', '', 'Amirah', '2018-02-25', 0),
(97, 'PLG-97', 'Iwan Maulana', '', '', 'Amirah', '2018-02-25', 0),
(98, 'PLG-98', 'Memet', '', '', 'Amirah', '2018-02-25', 0),
(99, 'PLG-99', 'Sudarto', '', '', 'Amirah', '2018-02-25', 0),
(100, 'PLG-100', 'Mulyadi', '', '', 'Amirah', '2018-02-25', 0),
(101, 'PLG-101', 'Santo', '', 'Depok', 'Amirah', '2018-02-25', 0),
(102, 'PLG-102', 'Mull', '', '', 'Amirah', '2018-02-25', 0),
(103, 'PLG-103', 'Arif', '', 'PPHI', 'Amirah', '2018-02-25', 0),
(104, 'PLG-104', 'yudi', '', 'Cileungsi\r\n', 'Amirah', '2018-02-25', 0),
(105, 'PLG-105', 'Supandi', '', '', 'Amirah', '2018-02-25', 0),
(106, 'PLG-106', 'Abdul Hamid', '', '', 'Amirah', '2018-02-25', 0),
(107, 'PLG-107', 'Fajar', '', '', 'Amirah', '2018-02-25', 0),
(108, 'PLG-108', 'Eva', '', '', 'Amirah', '2018-02-25', 0),
(109, 'PLG-109', 'ebun', '', '', 'Amirah', '2018-02-25', 0),
(110, 'PLG-110', 'Afhar', '', '', 'Amirah', '2018-02-25', 0),
(111, 'PLG-111', 'Tanpa Nama', '', '', 'Amirah', '2018-02-25', 0),
(112, 'PLG-112', 'kampleh', 'zsd', 'zsd\r\n', 'Sasmito', '2018-03-02', 0),
(113, 'PLG-113', 'asas', 'as', 'sd', 'Sasmito', '2018-03-02', 0),
(114, 'PLG-114', 'ddd', 'dd', 'dd', 'Sasmito', '2018-03-02', 0),
(115, 'PLG-115', 'xdf', 'xdf', 'xdfxdf', 'Sasmito', '2018-03-02', 0),
(116, 'PLG-116', 'Kampleh', '081919835585', '', 'Sasmito', '2018-03-02', 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `pos_item`
--

CREATE TABLE `pos_item` (
  `item_id` int(11) NOT NULL,
  `unit_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `item_code` varchar(25) NOT NULL,
  `item_name` text NOT NULL,
  `item_desc` longtext NOT NULL,
  `item_image` varchar(25) NOT NULL,
  `item_price` int(11) NOT NULL,
  `item_hpp` int(11) NOT NULL,
  `is_deleted` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `pos_item`
--

INSERT INTO `pos_item` (`item_id`, `unit_id`, `category_id`, `item_code`, `item_name`, `item_desc`, `item_image`, `item_price`, `item_hpp`, `is_deleted`) VALUES
(1, 1, 0, '1234', 'Sabun Colek', '', '', 4, 55, 1),
(2, 2, 0, 'df', 'Jilid Spiral', '', '', 40, 60, 1),
(3, 1, 0, '123', '3', '', '', 23, 12, 1),
(4, 1, 0, '', '4', '', '', 30, 50, 1),
(5, 2, 0, '', 'kacang goreng', '', '', 40, 60, 1),
(6, 1, 1, '', 'AC 210', '', '', 6500, 5000, 0),
(7, 2, 3, '', 'Softcover', '', '', 15000, 10000, 0),
(8, 3, 2, '', 'Flexy Cina', '', '', 12000, 8000, 0),
(9, 6, 3, '', 'Jilid Hard Cover', '', '', 15000, 25000, 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `pos_paid_detail`
--

CREATE TABLE `pos_paid_detail` (
  `paid_detail_id` int(11) NOT NULL,
  `billing_id` int(11) DEFAULT NULL,
  `payment_id` int(11) NOT NULL,
  `bank_id` int(11) NOT NULL,
  `paid_detail_total` int(11) NOT NULL,
  `trx_info` varchar(50) NOT NULL,
  `date_trx` date NOT NULL,
  `time_trx` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `pos_paid_detail`
--

INSERT INTO `pos_paid_detail` (`paid_detail_id`, `billing_id`, `payment_id`, `bank_id`, `paid_detail_total`, `trx_info`, `date_trx`, `time_trx`) VALUES
(1, 0, 1, 0, 1000, 'Cash', '2017-12-25', '22:13:47'),
(2, 0, 2, 3, 3000, '12345', '2017-12-25', '22:13:47'),
(3, 0, 3, 3, 5000, '123', '2017-12-25', '22:13:47'),
(4, 0, 4, 1, 2000, '1234', '2017-12-25', '22:13:47'),
(5, 45, 1, 0, 9000, 'Cash', '2017-12-25', '22:18:03'),
(6, 45, 1, 0, 10000, 'Cash', '2017-12-25', '22:26:17'),
(7, 45, 2, 3, 3000, '1234', '2017-12-25', '22:26:17'),
(8, 45, 3, 1, 5000, '12345', '2017-12-25', '22:26:17'),
(9, 45, 4, 1, 2000, '123', '2017-12-25', '22:26:17'),
(10, 50, 1, 0, 50000, 'Cash', '2017-12-26', '23:26:16'),
(11, 51, 4, 0, 20000, '', '2017-12-26', '23:26:42'),
(12, 52, 1, 0, 10000, 'Cash', '2017-12-26', '23:39:23'),
(13, 53, 4, 1, 20000, '', '2017-12-26', '23:43:45'),
(14, 53, 1, 0, 10000, 'Cash', '2017-12-26', '23:44:14'),
(15, 52, 1, 0, 20000, 'Cash', '2017-12-27', '02:37:30'),
(16, 56, 4, 1, 10000, '1234', '2018-01-03', '21:47:19'),
(17, 56, 1, 0, 2000, 'Cash', '2018-01-03', '22:14:18'),
(18, 56, 4, 0, 3000, '', '2018-01-03', '22:14:18'),
(19, 57, 4, 1, 4999, '', '2018-01-03', '23:18:42'),
(20, 58, 4, 1, 9000, '', '2018-01-03', '23:19:26'),
(21, 57, 1, 0, 11000, 'Cash', '2018-01-03', '23:19:45'),
(22, 58, 1, 0, 7000, 'Cash', '2018-01-03', '23:20:06'),
(23, 59, 1, 0, 4000, 'Cash', '2018-01-03', '23:28:27'),
(24, 60, 1, 0, 70000, 'Cash', '2018-01-03', '23:30:14'),
(25, 59, 4, 0, 10000, '', '2018-01-04', '21:59:14'),
(26, 64, 1, 0, 10000, 'Cash', '2018-01-06', '16:59:21'),
(27, 68, 4, 1, 30000, '', '2018-01-07', '15:02:14'),
(28, 72, 1, 0, 20000, 'Cash', '2018-01-08', '16:27:04'),
(29, 72, 1, 0, 10000, 'Cash', '2018-01-08', '16:27:43'),
(30, 83, 1, 0, 12000, 'Cash', '2018-01-17', '21:18:27'),
(31, 83, 1, 0, 12, 'Cash', '2018-01-17', '21:22:20'),
(32, 83, 1, 0, 12, 'Cash', '2018-01-17', '21:23:28'),
(33, 83, 1, 0, 12, 'Cash', '2018-01-17', '21:47:34'),
(34, 83, 1, 0, 12, 'Cash', '2018-01-17', '21:47:48'),
(35, 83, 1, 0, 12, 'Cash', '2018-01-17', '21:48:13'),
(36, 83, 1, 0, 12, 'Cash', '2018-01-17', '21:49:16'),
(37, 83, 1, 0, 10000, 'Cash', '2018-01-17', '21:57:00'),
(38, 83, 1, 0, 10000, 'Cash', '2018-01-17', '21:57:33'),
(39, 83, 1, 0, 1000, 'Cash', '2018-01-17', '21:59:39'),
(40, 83, 1, 0, 12, 'Cash', '2018-01-17', '22:01:54'),
(41, 83, 1, 0, 1000, 'Cash', '2018-01-17', '22:02:36'),
(42, 83, 1, 0, 1200, 'Cash', '2018-01-17', '22:04:15'),
(43, 83, 1, 0, 12, 'Cash', '2018-01-17', '22:04:39'),
(44, 84, 4, 3, 10000, '12424344', '2018-01-17', '22:33:21'),
(45, 85, 1, 0, 1, 'Cash', '2018-01-17', '22:48:05'),
(46, 85, 1, 0, 12000, 'Cash', '2018-01-17', '22:51:19'),
(47, 86, 1, 0, 10000, 'Cash', '2018-01-17', '22:52:35'),
(48, 87, 1, 0, 7000, 'Cash', '2018-01-17', '23:04:38'),
(49, 81, 1, 0, 13000, 'Cash', '2018-01-18', '00:17:38'),
(50, 81, 1, 0, 130000, 'Cash', '2018-01-18', '00:23:17'),
(51, 89, 1, 0, 30000, 'Cash', '2018-01-18', '01:32:42'),
(52, 91, 1, 0, 10000, 'Cash', '2018-01-18', '01:35:53'),
(53, 92, 1, 0, 14, 'Cash', '2018-01-18', '01:46:26'),
(54, 92, 1, 0, 1, 'Cash', '2018-01-18', '01:49:56'),
(55, 92, 1, 0, 16000, 'Cash', '2018-01-18', '01:50:14'),
(56, 92, 1, 0, 12, 'Cash', '2018-01-18', '01:52:25'),
(57, 92, 1, 0, 12, 'Cash', '2018-01-18', '01:53:56'),
(58, 92, 1, 0, 12, 'Cash', '2018-01-18', '01:54:27'),
(59, 92, 1, 0, 2, 'Cash', '2018-01-18', '01:54:58'),
(60, 92, 1, 0, 12, 'Cash', '2018-01-18', '01:55:44'),
(61, 92, 1, 0, 12, 'Cash', '2018-01-18', '01:56:00'),
(62, 92, 1, 0, 12, 'Cash', '2018-01-18', '01:56:27'),
(63, 92, 1, 0, 12, 'Cash', '2018-01-18', '01:57:30'),
(64, 92, 1, 0, 12, 'Cash', '2018-01-18', '01:59:48'),
(65, 92, 2, 0, 12, '', '2018-01-18', '01:59:48'),
(66, 92, 1, 0, 12, 'Cash', '2018-01-18', '02:01:37'),
(67, 92, 1, 0, 12, 'Cash', '2018-01-18', '02:02:03'),
(68, 92, 1, 0, 12, 'Cash', '2018-01-18', '02:02:54'),
(69, 92, 1, 0, 15000, 'Cash', '2018-01-18', '02:11:06'),
(70, 94, 1, 0, 10000, 'Cash', '2018-01-21', '02:36:49'),
(71, 94, 1, 0, 50000, 'Cash', '2018-01-21', '02:38:29'),
(72, 93, 4, 1, 30000, '1sdxdfxf', '2018-01-21', '17:00:24'),
(73, 92, 1, 0, 40000, 'Cash', '2018-01-21', '17:00:58'),
(74, 98, 1, 0, 90000, 'Cash', '2018-01-23', '12:50:25'),
(75, 99, 1, 0, 200000, 'Cash', '2018-01-23', '12:55:43');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pos_payment`
--

CREATE TABLE `pos_payment` (
  `payment_id` int(11) NOT NULL,
  `payment_name` text NOT NULL,
  `created` datetime NOT NULL,
  `created_by` varchar(25) DEFAULT NULL,
  `is_deleted` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `pos_payment`
--

INSERT INTO `pos_payment` (`payment_id`, `payment_name`, `created`, `created_by`, `is_deleted`) VALUES
(1, 'Cash', '2017-12-01 11:23:26', NULL, 0),
(2, 'Credit Card', '2017-12-25 00:00:00', '', 0),
(3, 'Debit Card', '2017-12-14 12:09:46', 'agus94', 0),
(4, 'Transfer', '2017-12-25 15:55:01', 'agus94', 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `pos_piutang`
--

CREATE TABLE `pos_piutang` (
  `piutang_id` int(11) NOT NULL,
  `billing_id` int(11) DEFAULT NULL,
  `customer_name` text,
  `paid_status` enum('progress','done') NOT NULL,
  `total` int(11) NOT NULL,
  `sisa` int(11) NOT NULL,
  `paid` int(11) NOT NULL,
  `piutang_info` longtext,
  `created` datetime DEFAULT NULL,
  `created_by` text,
  `store_id` int(11) DEFAULT NULL,
  `shift_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `pos_piutang`
--

INSERT INTO `pos_piutang` (`piutang_id`, `billing_id`, `customer_name`, `paid_status`, `total`, `sisa`, `paid`, `piutang_info`, `created`, `created_by`, `store_id`, `shift_id`) VALUES
(1, 35, '0', 'progress', 6500, 3500, 3000, NULL, '0000-00-00 00:00:00', '', 0, 0),
(2, 36, 'kamplehh', 'progress', 30000, 10000, 20000, NULL, '0000-00-00 00:00:00', '', 0, 0),
(3, 37, 'ggh', 'done', 30000, 15000, 15000, 'Lunas', NULL, NULL, 1, 1),
(4, 38, 'kam', 'done', 30000, 10000, 10000, 'Lunas', '2017-12-24 23:42:43', 'Agus Setiadi', 1, 1),
(5, 40, 'kam', 'done', 66500, 26500, 30000, 'Lunas', '2017-12-25 16:12:37', 'Agus Setiadi', 1, 1),
(6, 41, 'asddf', 'done', 30000, 10000, 20000, 'Lunas', '2017-12-25 16:22:01', 'Agus Setiadi', 1, 1),
(7, 42, 'sd', 'done', 6500, 5500, 5500, 'Lunas', '2017-12-25 16:25:57', 'Agus Setiadi', 1, 1),
(8, 43, 'asdf', 'done', 180000, 80000, 80000, 'Lunas', '2017-12-25 16:28:10', 'Agus Setiadi', 1, 1),
(9, 45, 'asdf', 'done', 29000, 20000, 20000, 'Lunas', '2017-12-25 22:18:03', 'Agus Setiadi', 1, 1),
(10, 52, 'aaaa', 'done', 15000, 5000, 20000, 'Lunas', '2017-12-26 23:39:23', 'Ajeng hidayanti SI', 2, 0),
(11, 53, 'kampleh', 'done', 30000, 10000, 10000, 'Lunas', '2017-12-26 23:43:45', 'Ajeng hidayanti SI', 2, 1),
(12, 56, '', 'done', 15000, 5000, 5000, 'Lunas', '2018-01-03 21:47:19', 'Ajeng hidayanti SI', 2, 1),
(13, 57, '', 'done', 15900, 10901, 11000, 'Lunas', '2018-01-03 23:18:42', 'Ajeng hidayanti SI', 2, 1),
(14, 58, 'nnm', 'done', 15000, 6000, 7000, 'Lunas', '2018-01-03 23:19:26', 'Ajeng hidayanti SI', 2, 1),
(15, 59, '', 'done', 12000, 8000, 10000, 'Lunas', '2018-01-03 23:28:27', 'Ajeng hidayanti SI', 2, 1),
(16, 64, 'kampleh', 'progress', 15000, 5000, 10000, NULL, '2018-01-06 16:59:21', 'Ajeng hidayanti SI', 2, 1),
(17, 72, 'Ana', 'done', 30000, 10000, 10000, 'Lunas', '2018-01-08 16:27:04', 'Ajeng hidayanti SI', 2, 1),
(18, 83, '', 'progress', 12000, 11988, 12, NULL, '2018-01-17 21:22:20', 'Sasmito', 1, NULL),
(19, 83, '', 'progress', 12000, 11988, 12, NULL, '2018-01-17 21:23:28', 'Sasmito', 1, NULL),
(20, 83, '', 'progress', 12000, 11988, 12, NULL, '2018-01-17 21:47:34', 'Sasmito', 1, NULL),
(21, 83, '', 'progress', 12000, 11988, 12, NULL, '2018-01-17 21:47:48', 'Sasmito', 1, NULL),
(22, 83, '', 'progress', 12000, 11988, 12, NULL, '2018-01-17 21:48:13', 'Sasmito', 1, NULL),
(23, 83, '', 'progress', 12000, 11988, 12, NULL, '2018-01-17 21:49:16', 'Sasmito', 1, NULL),
(24, 83, '', 'progress', 12000, 2000, 10000, NULL, '2018-01-17 21:57:00', 'Sasmito', 1, NULL),
(25, 83, '', 'progress', 12000, 2000, 10000, NULL, '2018-01-17 21:57:33', 'Sasmito', 1, NULL),
(26, 83, '', 'progress', 12000, 11000, 1000, NULL, '2018-01-17 21:59:39', 'Sasmito', 1, NULL),
(27, 83, '', 'progress', 12000, 11988, 12, NULL, '2018-01-17 22:01:54', 'Sasmito', 1, NULL),
(28, 83, '', 'progress', 12000, 11000, 1000, NULL, '2018-01-17 22:02:36', 'Sasmito', 1, NULL),
(29, 83, '', 'progress', 12000, 10800, 1200, NULL, '2018-01-17 22:04:15', 'Sasmito', 1, NULL),
(30, 83, '', 'progress', 12000, 11988, 12, NULL, '2018-01-17 22:04:39', 'Sasmito', 1, NULL),
(31, 84, 'kampleh', 'progress', 15000, 5000, 10000, NULL, '2018-01-17 22:33:21', 'Sasmito', 1, NULL),
(32, 85, 'ana', 'progress', 11700, 11699, 1, NULL, '2018-01-17 22:48:05', 'Sasmito', 1, NULL),
(33, 86, '', 'progress', 15000, 5000, 10000, NULL, '2018-01-17 22:52:35', 'Sasmito', 1, NULL),
(34, 89, 'Kamleh Adi', 'progress', 49000, 19000, 30000, NULL, '2018-01-18 01:32:42', 'Sasmito', 1, 3),
(35, 91, 'as', 'progress', 12000, 2000, 10000, NULL, '2018-01-18 01:35:53', 'Sasmito', 1, 3),
(36, 92, '', 'progress', 15000, 14986, 14, NULL, '2018-01-18 01:46:26', 'Sasmito', 1, 3),
(37, 92, '', 'progress', 15000, 14999, 1, NULL, '2018-01-18 01:49:56', 'Sasmito', 1, 3),
(38, 92, '', 'progress', 15000, 14988, 12, NULL, '2018-01-18 01:52:24', 'Sasmito', 1, 3),
(39, 92, '', 'progress', 15000, 14988, 12, NULL, '2018-01-18 01:53:56', 'Sasmito', 1, 3),
(40, 92, '', 'progress', 15000, 14988, 12, NULL, '2018-01-18 01:54:27', 'Sasmito', 1, 3),
(41, 92, '', 'progress', 15000, 14998, 2, NULL, '2018-01-18 01:54:58', 'Sasmito', 1, 3),
(42, 92, '', 'progress', 15000, 14988, 12, NULL, '2018-01-18 01:55:44', 'Sasmito', 1, 3),
(43, 92, '', 'progress', 15000, 14988, 12, NULL, '2018-01-18 01:56:00', 'Sasmito', 1, 3),
(44, 92, '', 'progress', 15000, 14988, 12, NULL, '2018-01-18 01:56:26', 'Sasmito', 1, 3),
(45, 92, '', 'progress', 15000, 14988, 12, NULL, '2018-01-18 01:57:30', 'Sasmito', 1, 3),
(46, 92, '', 'progress', 15000, 14976, 24, NULL, '2018-01-18 01:59:48', 'Sasmito', 1, 3),
(47, 92, '', 'progress', 15000, 14988, 12, NULL, '2018-01-18 02:01:37', 'Sasmito', 1, 3),
(48, 92, '', 'done', 15000, 14988, 40000, 'Lunas', '2018-01-18 02:02:03', 'Sasmito', 1, 3),
(49, 92, '', 'done', 15000, 14988, 15000, 'Lunas', '2018-01-18 02:02:54', 'Sasmito', 1, 3),
(50, 94, 'Agus', 'done', 47550, 37550, 50000, 'Lunas', '2018-01-21 02:36:49', 'Sasmito', 1, NULL),
(51, 98, '', 'progress', 195450, 105450, 90000, NULL, '2018-01-23 12:50:25', 'Novi', 1, 1),
(52, 99, 'Nabila', 'progress', 302500, 102500, 200000, NULL, '2018-01-23 12:55:43', 'Novi', 1, 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `pos_po`
--

CREATE TABLE `pos_po` (
  `po_id` int(11) NOT NULL,
  `po_number` varchar(50) NOT NULL,
  `supplier_id` int(11) NOT NULL,
  `supplier_invoice` varchar(50) NOT NULL,
  `po_subtotal` int(11) NOT NULL,
  `po_discount` int(11) NOT NULL,
  `po_total_price` int(11) NOT NULL,
  `po_date` date NOT NULL,
  `po_time` time NOT NULL,
  `po_payment` enum('cash','credit') NOT NULL,
  `created` datetime NOT NULL,
  `created_by` varchar(25) NOT NULL,
  `is_deleted` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `pos_po_detail`
--

CREATE TABLE `pos_po_detail` (
  `po_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `store_id` int(11) NOT NULL,
  `pod_qty` int(11) NOT NULL,
  `pod_receive_qty` int(11) NOT NULL,
  `unit_id` int(11) NOT NULL,
  `is_deleted` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `pos_retur`
--

CREATE TABLE `pos_retur` (
  `retur_id` int(11) NOT NULL,
  `no_trx` varchar(50) NOT NULL,
  `store_id` int(11) NOT NULL,
  `shift_id` int(11) NOT NULL,
  `customer_name` text NOT NULL,
  `phone` varchar(25) NOT NULL,
  `date_retur` date NOT NULL,
  `time_retur` time NOT NULL,
  `info` longtext NOT NULL,
  `created_by` text NOT NULL,
  `subtotal` int(11) NOT NULL,
  `total` int(11) NOT NULL,
  `tunai` int(11) NOT NULL,
  `rtr_status` enum('temp','done','canceled') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `pos_retur`
--

INSERT INTO `pos_retur` (`retur_id`, `no_trx`, `store_id`, `shift_id`, `customer_name`, `phone`, `date_retur`, `time_retur`, `info`, `created_by`, `subtotal`, `total`, `tunai`, `rtr_status`) VALUES
(1, 'TRX00891', 1, 0, 'Agus Setiadi', '081991918', '2018-01-20', '21:45:03', '', 'Sasmito', 13000, 13000, 25000, 'done'),
(2, 'RTR2', 1, 0, '', '', '2018-01-20', '21:54:15', '', 'Sasmito', 15000, 15000, 0, 'temp'),
(3, 'RTR3', 1, 0, '', '', '2018-01-20', '21:59:30', '', 'Sasmito', 12000, 12000, 0, 'temp'),
(4, 'RTR4', 1, 0, '', '', '2018-01-20', '22:01:24', '', 'Sasmito', 30000, 30000, 0, 'temp'),
(5, 'RTR5', 1, 0, '', '', '2018-01-20', '22:02:08', '', 'Sasmito', 15000, 15000, 0, 'temp');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pos_retur_detail`
--

CREATE TABLE `pos_retur_detail` (
  `retur_detail_id` int(11) NOT NULL,
  `retur_id` int(11) NOT NULL,
  `store_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `unit_id` int(11) NOT NULL,
  `printer_id` int(11) NOT NULL,
  `ukuran` text NOT NULL,
  `retur_qty` int(11) NOT NULL,
  `item_price` int(11) NOT NULL,
  `item_price_hpp` int(11) NOT NULL,
  `created_by` text NOT NULL,
  `date_created` date NOT NULL,
  `time_created` time NOT NULL,
  `subtotal` int(11) NOT NULL,
  `total` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `pos_retur_detail`
--

INSERT INTO `pos_retur_detail` (`retur_detail_id`, `retur_id`, `store_id`, `item_id`, `unit_id`, `printer_id`, `ukuran`, `retur_qty`, `item_price`, `item_price_hpp`, `created_by`, `date_created`, `time_created`, `subtotal`, `total`) VALUES
(140, 1, 0, 6, 1, 1, '', 2, 6500, 5000, 'Sasmito', '2018-01-20', '21:45:03', 13000, 13000),
(142, 2, 0, 9, 6, 1, '', 1, 15000, 25000, 'Sasmito', '2018-01-20', '21:54:15', 15000, 15000),
(143, 3, 0, 8, 3, 0, '', 1, 12000, 8000, 'Sasmito', '2018-01-20', '21:59:30', 12000, 12000),
(144, 4, 0, 9, 6, 1, '', 1, 15000, 25000, 'Sasmito', '2018-01-20', '22:01:24', 15000, 15000),
(145, 4, 0, 9, 6, 2, '', 1, 15000, 25000, 'Sasmito', '2018-01-20', '22:01:53', 15000, 15000),
(146, 5, 0, 9, 6, 1, '', 1, 15000, 25000, 'Sasmito', '2018-01-20', '22:02:08', 15000, 15000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `pos_spk`
--

CREATE TABLE `pos_spk` (
  `spk_id` int(11) NOT NULL,
  `billing_id` int(11) NOT NULL,
  `jabatan_id` int(11) NOT NULL,
  `date_in` datetime NOT NULL,
  `process_date` datetime NOT NULL,
  `process_by` varchar(50) NOT NULL,
  `status` enum('pending','done') NOT NULL,
  `store_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `pos_spk`
--

INSERT INTO `pos_spk` (`spk_id`, `billing_id`, `jabatan_id`, `date_in`, `process_date`, `process_by`, `status`, `store_id`) VALUES
(9, 60, 8, '2018-01-04 02:18:04', '0000-00-00 00:00:00', '', 'done', 2),
(10, 59, 5, '2018-01-04 02:19:12', '0000-00-00 00:00:00', '', 'done', 2),
(11, 59, 4, '2018-01-04 02:19:13', '0000-00-00 00:00:00', '', 'done', 2),
(12, 58, 5, '2018-01-04 02:20:15', '0000-00-00 00:00:00', '', 'done', 2),
(13, 59, 5, '2018-01-04 02:20:22', '0000-00-00 00:00:00', '', 'done', 2),
(14, 60, 5, '2018-01-04 16:11:10', '0000-00-00 00:00:00', '', 'done', 2),
(15, 57, 5, '2018-01-04 16:11:17', '0000-00-00 00:00:00', '', 'done', 2),
(16, 53, 5, '2018-01-04 22:04:06', '0000-00-00 00:00:00', '', 'done', 2),
(17, 45, 5, '2018-01-04 22:05:13', '0000-00-00 00:00:00', '', 'done', 2),
(18, 44, 5, '2018-01-04 22:05:32', '0000-00-00 00:00:00', '', 'done', 2),
(19, 1, 5, '2018-01-04 22:06:19', '0000-00-00 00:00:00', '', 'done', 2),
(20, 72, 4, '2018-01-08 16:35:22', '0000-00-00 00:00:00', '', 'done', 2),
(21, 91, 4, '2018-01-18 01:44:37', '0000-00-00 00:00:00', '', 'done', 1),
(22, 92, 4, '2018-01-19 09:38:31', '0000-00-00 00:00:00', '', 'done', 2),
(23, 94, 5, '2018-01-21 17:01:47', '0000-00-00 00:00:00', '', 'done', 1),
(24, 93, 5, '2018-01-21 17:01:53', '0000-00-00 00:00:00', '', 'done', 1),
(25, 89, 5, '2018-01-21 17:01:58', '0000-00-00 00:00:00', '', 'pending', 1),
(26, 87, 5, '2018-01-21 17:03:59', '0000-00-00 00:00:00', '', 'pending', 1),
(27, 86, 4, '2018-01-21 17:57:42', '0000-00-00 00:00:00', '', 'pending', 1),
(28, 94, 4, '2018-01-21 17:57:50', '0000-00-00 00:00:00', '', 'pending', 1),
(29, 89, 4, '2018-01-21 17:57:55', '0000-00-00 00:00:00', '', 'pending', 1),
(30, 98, 5, '2018-01-23 12:51:39', '0000-00-00 00:00:00', '', 'done', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `pos_stock`
--

CREATE TABLE `pos_stock` (
  `stock_id` int(11) NOT NULL,
  `ref_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `store_id` int(11) NOT NULL,
  `trx_hpp` int(11) NOT NULL,
  `trx_nominal` int(11) NOT NULL,
  `trx_date` date NOT NULL,
  `trx_time` time NOT NULL,
  `trx_qty` int(11) NOT NULL,
  `unit_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `pos_stock`
--

INSERT INTO `pos_stock` (`stock_id`, `ref_id`, `item_id`, `store_id`, `trx_hpp`, `trx_nominal`, `trx_date`, `trx_time`, `trx_qty`, `unit_id`) VALUES
(122, 1, 6, 1, 5000, 6500, '2017-12-24', '04:24:14', 5, 1),
(123, 1, 9, 1, 25000, 15000, '2017-12-24', '04:24:14', 2, 6),
(124, 1, 8, 1, 8000, 12000, '2017-12-24', '04:25:48', 1, 3),
(125, 1234, 7, 1, 10000, 15000, '2017-12-24', '04:27:19', 4, 2),
(126, 64, 7, 1, 10000, 15000, '2017-12-24', '04:32:01', 12, 2),
(127, 65, 7, 1, 10000, 15000, '2017-12-24', '19:53:09', 4, 2),
(128, 65, 6, 1, 5000, 3000, '2017-12-24', '19:53:09', 25, 1),
(129, 66, 6, 1, 5000, 6500, '2017-12-24', '19:56:25', 4, 1),
(130, 67, 6, 1, 5000, 0, '2017-12-24', '13:57:58', 500, 1),
(132, 68, 6, 1, 5000, 0, '2017-12-24', '13:59:43', 500, 1),
(133, 69, 7, 1, 10000, 0, '2017-12-24', '14:06:18', 1, 2),
(134, 70, 6, 1, 5000, 0, '2017-12-24', '14:16:54', 1, 1),
(135, 70, 8, 1, 8000, 0, '2017-12-24', '14:17:05', 2, 3),
(136, 71, 6, 1, 5000, 0, '2017-12-24', '14:19:25', 1, 1),
(137, 72, 8, 1, 8000, 0, '2017-12-24', '14:21:02', 15, 3),
(138, 72, 9, 1, 25000, 0, '2017-12-24', '14:21:13', 59, 6),
(139, 73, 8, 1, 8000, 0, '2017-12-24', '14:22:55', 5, 3),
(140, 73, 9, 1, 25000, 0, '2017-12-24', '14:23:04', 5, 6),
(141, 74, 8, 1, 8000, 0, '2017-12-24', '14:25:35', 3, 3),
(142, 75, 8, 1, 8000, 0, '2017-12-24', '16:44:43', 1, 3),
(143, 76, 7, 1, 10000, 0, '2017-12-24', '16:45:48', 1, 2),
(144, 77, 6, 1, 5000, 6500, '2017-12-24', '23:28:33', 1, 1),
(145, 78, 6, 1, 5000, 6500, '2017-12-24', '23:28:49', 1, 1),
(146, 79, 7, 1, 10000, 15000, '2017-12-24', '23:30:19', 2, 2),
(147, 80, 7, 1, 10000, 15000, '2017-12-24', '23:40:30', 2, 2),
(148, 81, 9, 1, 25000, 15000, '2017-12-24', '23:42:43', 2, 6),
(149, 82, 9, 1, 25000, 0, '2017-12-24', '17:46:32', 1, 6),
(150, 83, 7, 1, 10000, 12000, '2017-12-25', '16:09:29', 2, 2),
(151, 83, 7, 1, 10000, 15000, '2017-12-25', '16:09:29', 2, 2),
(152, 84, 6, 1, 5000, 6500, '2017-12-25', '16:12:37', 1, 1),
(153, 84, 9, 1, 25000, 15000, '2017-12-25', '16:12:37', 4, 6),
(154, 85, 7, 1, 10000, 15000, '2017-12-25', '16:22:01', 2, 2),
(155, 86, 6, 1, 5000, 6500, '2017-12-25', '16:25:57', 1, 1),
(156, 87, 7, 1, 10000, 15000, '2017-12-25', '16:28:10', 12, 2),
(157, 88, 6, 1, 5000, 6500, '2017-12-25', '22:13:47', 1, 1),
(158, 89, 6, 1, 5000, 6500, '2017-12-25', '22:18:03', 4, 1),
(159, 90, 6, 1, 5000, 0, '2017-12-25', '17:35:21', 1, 1),
(160, 91, 7, 2, 10000, 15000, '2017-12-26', '23:26:16', 2, 2),
(161, 92, 7, 2, 10000, 15000, '2017-12-26', '23:26:42', 1, 2),
(162, 93, 8, 2, 8000, 0, '2017-12-26', '17:31:35', 1, 3),
(163, 94, 7, 2, 10000, 15000, '2017-12-26', '23:39:23', 1, 2),
(164, 95, 9, 2, 25000, 15000, '2017-12-26', '23:43:45', 2, 6),
(165, 96, 7, 2, 10000, 15000, '2018-01-03', '21:47:19', 1, 2),
(166, 97, 6, 2, 5000, 0, '2018-01-03', '16:03:39', 1, 1),
(167, 97, 8, 2, 8000, 0, '2018-01-03', '16:03:45', 1, 3),
(168, 97, 8, 2, 8000, 0, '2018-01-03', '16:03:53', 1, 3),
(169, 98, 7, 2, 10000, 15000, '2018-01-03', '23:18:42', 1, 2),
(170, 99, 7, 2, 10000, 15000, '2018-01-03', '23:19:26', 1, 2),
(171, 100, 8, 2, 8000, 12000, '2018-01-03', '23:28:27', 1, 3),
(172, 101, 9, 2, 25000, 15000, '2018-01-03', '23:30:14', 4, 6),
(173, 102, 6, 2, 5000, 0, '2018-01-04', '15:53:09', 1, 1),
(174, 102, 6, 2, 5000, 0, '2018-01-04', '15:53:15', 1, 1),
(175, 103, 7, 2, 10000, 0, '2018-01-06', '10:47:46', 1, 2),
(176, 104, 9, 2, 25000, 15000, '2018-01-06', '16:59:21', 1, 6),
(177, 105, 7, 2, 10000, 15000, '2018-01-07', '15:02:14', 1, 2),
(178, 105, 6, 2, 5000, 6500, '2018-01-07', '15:02:14', 1, 1),
(179, 106, 7, 2, 10000, 15000, '2018-01-08', '16:27:04', 2, 2),
(180, 107, 7, 2, 10000, 0, '2018-01-08', '10:30:06', 20, 2),
(181, 108, 8, 1, 8000, 12000, '2018-01-17', '21:18:27', 1, 3),
(182, 109, 9, 1, 25000, 15000, '2018-01-17', '22:33:21', 1, 6),
(183, 110, 6, 1, 5000, 6500, '2018-01-17', '22:48:05', 2, 1),
(184, 111, 9, 1, 25000, 15000, '2018-01-17', '22:52:35', 1, 6),
(185, 112, 6, 1, 5000, 6500, '2018-01-17', '23:04:38', 1, 1),
(186, 113, 6, 1, 5000, 6500, '2018-01-18', '00:17:38', 2, 1),
(187, 114, 6, 1, 5000, 6500, '2018-01-18', '01:32:42', 2, 1),
(188, 114, 8, 1, 8000, 12000, '2018-01-18', '01:32:42', 3, 3),
(189, 115, 8, 1, 8000, 12000, '2018-01-18', '01:35:53', 1, 3),
(190, 116, 7, 1, 10000, 15000, '2018-01-18', '01:46:26', 1, 2),
(191, 117, 6, 1, 5000, 0, '2018-01-17', '21:52:34', 1, 1),
(192, 118, 6, 1, 5000, 6500, '2018-01-21', '02:36:49', 3, 1),
(193, 118, 9, 1, 25000, 15000, '2018-01-21', '02:36:49', 2, 6),
(194, 119, 7, 1, 10000, 15000, '2018-01-21', '17:00:24', 1, 2),
(195, 120, 6, 1, 5000, 0, '2018-01-21', '11:06:07', 5, 1),
(196, 120, 8, 1, 8000, 0, '2018-01-21', '11:06:13', 5, 3),
(197, 121, 6, 1, 5000, 0, '2018-01-21', '11:25:28', 1, 1),
(198, 121, 9, 1, 25000, 0, '2018-01-21', '11:25:33', 2, 6),
(199, 122, 6, 1, 5000, 6500, '2018-01-23', '12:50:25', 10, 1),
(200, 122, 7, 1, 10000, 15000, '2018-01-23', '12:50:25', 10, 2),
(201, 123, 6, 1, 5000, 6500, '2018-01-23', '12:55:43', 5, 1),
(202, 123, 7, 1, 10000, 15000, '2018-01-23', '12:55:43', 18, 2);

-- --------------------------------------------------------

--
-- Struktur dari tabel `pos_stock_flow`
--

CREATE TABLE `pos_stock_flow` (
  `ref_id` int(11) NOT NULL,
  `ref_data` varchar(50) NOT NULL,
  `store_id` int(11) NOT NULL,
  `trx_type` enum('in','out') DEFAULT NULL,
  `date_input` date NOT NULL,
  `time_input` time NOT NULL,
  `created_by` varchar(25) NOT NULL,
  `date_modified` date NOT NULL,
  `time_modified` time NOT NULL,
  `is_temp` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `pos_stock_flow`
--

INSERT INTO `pos_stock_flow` (`ref_id`, `ref_data`, `store_id`, `trx_type`, `date_input`, `time_input`, `created_by`, `date_modified`, `time_modified`, `is_temp`) VALUES
(61, 'OT1514064254', 1, 'out', '2017-12-24', '04:24:14', 'Agus Setiadi', '0000-00-00', '00:00:00', 0),
(62, 'OT1514064348', 1, 'out', '2017-12-24', '04:25:48', 'Agus Setiadi', '0000-00-00', '00:00:00', 0),
(63, 'OT1514064439', 1, 'out', '2017-12-24', '04:27:19', 'Agus Setiadi', '0000-00-00', '00:00:00', 0),
(64, 'OT1514064721', 1, 'out', '2017-12-24', '04:32:01', 'Agus Setiadi', '0000-00-00', '00:00:00', 0),
(65, 'OT1514119989', 1, 'out', '2017-12-24', '19:53:09', 'Agus Setiadi', '0000-00-00', '00:00:00', 0),
(66, '17/12/24/33', 1, 'out', '2017-12-24', '19:56:25', 'Agus Setiadi', '0000-00-00', '00:00:00', 0),
(67, '', 0, NULL, '2017-12-24', '13:57:58', 'Agus Setiadi', '0000-00-00', '00:00:00', 1),
(68, 'IN1514120388', 1, 'in', '2017-12-24', '13:58:49', 'Agus Setiadi', '2017-12-24', '13:59:48', 0),
(69, '', 0, NULL, '2017-12-24', '14:06:18', 'Agus Setiadi', '0000-00-00', '00:00:00', 1),
(70, 'OT1514121434', 1, 'out', '2017-12-24', '14:16:54', 'Agus Setiadi', '2017-12-24', '14:17:14', 0),
(71, '', 1, 'in', '2017-12-24', '14:19:25', 'Agus Setiadi', '2017-12-24', '14:19:35', 0),
(72, 'IN1514121662', 1, 'in', '2017-12-24', '14:21:02', 'Agus Setiadi', '2017-12-24', '14:21:18', 0),
(73, 'OK12345', 1, 'in', '2017-12-24', '14:22:55', 'Agus Setiadi', '2017-12-24', '14:23:07', 0),
(74, 'OKT123', 1, 'out', '2017-12-24', '14:25:35', 'Agus Setiadi', '2017-12-24', '14:25:39', 0),
(75, 'OT1514130283', 1, 'out', '2017-12-24', '16:44:43', 'Agus Setiadi', '2017-12-24', '16:45:07', 0),
(76, 'OT1514130348', 1, 'out', '2017-12-24', '16:45:48', 'Agus Setiadi', '2017-12-24', '16:45:52', 0),
(77, '17/12/24/35', 1, 'out', '2017-12-24', '23:28:33', 'Agus Setiadi', '0000-00-00', '00:00:00', 0),
(78, '17/12/24/35', 1, 'out', '2017-12-24', '23:28:49', 'Agus Setiadi', '0000-00-00', '00:00:00', 0),
(79, '17/12/24/36', 1, 'out', '2017-12-24', '23:30:19', 'Agus Setiadi', '0000-00-00', '00:00:00', 0),
(80, '17/12/24/37', 1, 'out', '2017-12-24', '23:40:30', 'Agus Setiadi', '0000-00-00', '00:00:00', 0),
(81, '17/12/24/38', 1, 'out', '2017-12-24', '23:42:43', 'Agus Setiadi', '0000-00-00', '00:00:00', 0),
(82, 'OT1514133992', 1, 'out', '2017-12-24', '17:46:32', 'Agus Setiadi', '2017-12-24', '17:46:40', 0),
(83, '17/12/25/39', 1, 'out', '2017-12-25', '16:09:29', 'Agus Setiadi', '0000-00-00', '00:00:00', 0),
(84, '17/12/25/40', 1, 'out', '2017-12-25', '16:12:37', 'Agus Setiadi', '0000-00-00', '00:00:00', 0),
(85, '17/12/25/41', 1, 'out', '2017-12-25', '16:22:01', 'Agus Setiadi', '0000-00-00', '00:00:00', 0),
(86, '17/12/25/42', 1, 'out', '2017-12-25', '16:25:57', 'Agus Setiadi', '0000-00-00', '00:00:00', 0),
(87, '17/12/25/43', 1, 'out', '2017-12-25', '16:28:10', 'Agus Setiadi', '0000-00-00', '00:00:00', 0),
(88, '17/12/25/44', 1, 'out', '2017-12-25', '22:13:47', 'Agus Setiadi', '0000-00-00', '00:00:00', 0),
(89, '17/12/25/45', 1, 'out', '2017-12-25', '22:18:03', 'Agus Setiadi', '0000-00-00', '00:00:00', 0),
(90, 'IN1514219721', 1, 'in', '2017-12-25', '17:35:21', 'Agus Setiadi', '2017-12-25', '17:35:23', 0),
(91, '17/12/26/50', 2, 'out', '2017-12-26', '23:26:16', 'Ajeng hidayanti SI', '0000-00-00', '00:00:00', 0),
(92, '17/12/26/51', 2, 'out', '2017-12-26', '23:26:42', 'Ajeng hidayanti SI', '0000-00-00', '00:00:00', 0),
(93, 'OT1514305895', 2, 'out', '2017-12-26', '17:31:35', 'Ajeng hidayanti SI', '2017-12-26', '17:31:38', 0),
(94, '17/12/26/52', 2, 'out', '2017-12-26', '23:39:23', 'Ajeng hidayanti SI', '0000-00-00', '00:00:00', 0),
(95, '17/12/26/53', 2, 'out', '2017-12-26', '23:43:45', 'Ajeng hidayanti SI', '0000-00-00', '00:00:00', 0),
(96, '18/01/03/56', 2, 'out', '2018-01-03', '21:47:19', 'Ajeng hidayanti SI', '0000-00-00', '00:00:00', 0),
(97, 'OT1514991819', 2, 'out', '2018-01-03', '16:03:39', 'Ajeng hidayanti SI', '2018-01-03', '16:03:57', 0),
(98, '18/01/03/57', 2, 'out', '2018-01-03', '23:18:42', 'Ajeng hidayanti SI', '0000-00-00', '00:00:00', 0),
(99, '18/01/03/58', 2, 'out', '2018-01-03', '23:19:26', 'Ajeng hidayanti SI', '0000-00-00', '00:00:00', 0),
(100, '18/01/03/59', 2, 'out', '2018-01-03', '23:28:27', 'Ajeng hidayanti SI', '0000-00-00', '00:00:00', 0),
(101, '18/01/03/60', 2, 'out', '2018-01-03', '23:30:14', 'Ajeng hidayanti SI', '0000-00-00', '00:00:00', 0),
(102, 'OT1515077589', 2, 'out', '2018-01-04', '15:53:09', 'Ajeng hidayanti SI', '2018-01-04', '15:53:35', 0),
(103, 'OT1515232066', 2, 'out', '2018-01-06', '10:47:46', 'Ajeng hidayanti SI', '2018-01-06', '10:47:50', 0),
(104, '18/01/06/64', 2, 'out', '2018-01-06', '16:59:21', 'Ajeng hidayanti SI', '0000-00-00', '00:00:00', 0),
(105, '18/01/07/68', 2, 'out', '2018-01-07', '15:02:14', 'Ajeng hidayanti SI', '0000-00-00', '00:00:00', 0),
(106, '18/01/08/72', 2, 'out', '2018-01-08', '16:27:04', 'Ajeng hidayanti SI', '0000-00-00', '00:00:00', 0),
(107, '1234', 2, 'in', '2018-01-08', '10:30:06', 'Ajeng hidayanti SI', '2018-01-08', '10:30:08', 0),
(108, 'TRX83/2018/01/17', 1, 'out', '2018-01-17', '21:18:27', 'Sasmito', '0000-00-00', '00:00:00', 0),
(109, 'TRX84/2018/01/17', 1, 'out', '2018-01-17', '22:33:21', 'Sasmito', '0000-00-00', '00:00:00', 0),
(110, 'TRX85/2018/01/17', 1, 'out', '2018-01-17', '22:48:05', 'Sasmito', '0000-00-00', '00:00:00', 0),
(111, 'TRX86/2018/01/17', 1, 'out', '2018-01-17', '22:52:35', 'Sasmito', '0000-00-00', '00:00:00', 0),
(112, 'TRX87/2018/01/17', 1, 'out', '2018-01-17', '23:04:38', 'Sasmito', '0000-00-00', '00:00:00', 0),
(113, 'TRX81/2018/01/17', 1, 'out', '2018-01-18', '00:17:38', 'Sasmito', '0000-00-00', '00:00:00', 0),
(114, 'TRX89/2018/01/18', 1, 'out', '2018-01-18', '01:32:42', 'Sasmito', '0000-00-00', '00:00:00', 0),
(115, 'TRX91/2018/01/18', 1, 'out', '2018-01-18', '01:35:53', 'Sasmito', '0000-00-00', '00:00:00', 0),
(116, 'TRX92/2018/01/18', 1, 'out', '2018-01-18', '01:46:26', 'Sasmito', '0000-00-00', '00:00:00', 0),
(117, 'OT1516222354', 0, NULL, '2018-01-17', '21:52:34', 'Sasmito', '0000-00-00', '00:00:00', 1),
(118, 'TRX94/2018/01/21', 1, 'out', '2018-01-21', '02:36:49', 'Sasmito', '0000-00-00', '00:00:00', 0),
(119, 'TRX93/2018/01/20', 1, 'out', '2018-01-21', '17:00:24', 'Sasmito', '0000-00-00', '00:00:00', 0),
(120, 'OT1516529167', 1, 'out', '2018-01-21', '11:06:07', 'Sasmito', '2018-01-21', '11:06:36', 0),
(121, 'IN1516530328', 0, NULL, '2018-01-21', '11:25:28', 'Sasmito', '0000-00-00', '00:00:00', 1),
(122, 'TRX98/2018/01/23', 1, 'out', '2018-01-23', '12:50:25', 'Novi', '0000-00-00', '00:00:00', 0),
(123, 'TRX99/2018/01/23', 1, 'out', '2018-01-23', '12:55:43', 'Novi', '0000-00-00', '00:00:00', 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `pos_stock_rekap`
--

CREATE TABLE `pos_stock_rekap` (
  `sr_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `total_stock` int(11) NOT NULL,
  `total_stock_in` int(11) NOT NULL,
  `total_stock_out` int(11) NOT NULL,
  `store_id` int(11) NOT NULL,
  `trx_date` date DEFAULT NULL,
  `unit_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `pos_stock_rekap`
--

INSERT INTO `pos_stock_rekap` (`sr_id`, `item_id`, `total_stock`, `total_stock_in`, `total_stock_out`, `store_id`, `trx_date`, `unit_id`) VALUES
(8, 6, -1, 0, 0, 1, '2017-12-18', 0),
(9, 9, -1, 0, 0, 1, '2017-12-18', 0),
(10, 9, -13, 0, 0, 1, '2017-12-19', 6),
(11, 8, -2, 0, 0, 1, '2017-12-19', 3),
(12, 7, -14, 0, 8, 1, '2017-12-20', 2),
(13, 6, -10, 0, 8, 1, '2017-12-20', 1),
(14, 9, -15, 0, 0, 1, '2017-12-20', 6),
(15, 8, -10, 0, 8, 1, '2017-12-20', 3),
(16, 6, -11, 0, 1, 1, NULL, NULL),
(17, 8, -14, 0, 4, 1, NULL, NULL),
(18, 6, -12, 0, 1, 1, NULL, 1),
(19, 8, -18, 0, 4, 1, NULL, 3),
(20, 6, -14, 0, 2, 1, '2017-12-21', 1),
(21, 8, -24, 0, 6, 1, '2017-12-21', 3),
(22, 7, 61, 0, 225, 1, '2017-12-21', 2),
(23, 9, -17, 0, 2, 1, '2017-12-21', 6),
(24, 7, 100, 44, 15, 1, '2017-12-22', 2),
(25, 6, -29, 0, 115, 1, '2017-12-22', 1),
(27, 7, 120, 20, 0, 1, '2017-12-23', 2),
(28, 8, -4, 20, 0, 1, '2017-12-23', 3),
(29, 7, 90, 0, 30, 1, '2017-12-24', 2),
(30, 6, -33, 0, 4, 1, '2017-12-23', 1),
(31, 8, 2, 20, 14, 1, '2017-12-24', 3),
(32, 9, 31, 64, 16, 1, '2017-12-24', 6),
(33, 6, 430, 501, 38, 1, '2017-12-24', 1),
(34, 7, 72, 0, 18, 1, '2017-12-25', 2),
(35, 6, 424, 1, 7, 1, '2017-12-25', 1),
(36, 9, 27, 0, 4, 1, '2017-12-25', 6),
(37, 7, -4, 0, 4, 2, '2017-12-26', 2),
(38, 8, -1, 0, 1, 2, '2017-12-26', 3),
(39, 9, -2, 0, 2, 2, '2017-12-26', 6),
(40, 7, -7, 0, 3, 2, '2018-01-03', 2),
(42, 8, -4, 0, 3, 2, '2018-01-03', 3),
(43, 9, -6, 0, 4, 2, '2018-01-03', 6),
(45, 7, -8, 0, 1, 2, '2018-01-06', 2),
(46, 9, -7, 0, 1, 2, '2018-01-06', 6),
(47, 7, -9, 0, 1, 2, '2018-01-07', 2),
(49, 7, 9, 20, 2, 2, '2018-01-08', 2),
(50, 8, 1, 0, 1, 1, '2018-01-17', 3),
(51, 9, 25, 0, 2, 1, '2018-01-17', 6),
(52, 6, 421, 0, 3, 1, '2018-01-17', 1),
(53, 6, 417, 0, 4, 1, '2018-01-18', 1),
(54, 8, -3, 0, 4, 1, '2018-01-18', 3),
(55, 7, 71, 0, 1, 1, '2018-01-18', 2),
(56, 6, 409, 0, 8, 1, '2018-01-21', 1),
(57, 9, 23, 0, 2, 1, '2018-01-21', 6),
(58, 7, 70, 0, 1, 1, '2018-01-21', 2),
(59, 8, -8, 0, 5, 1, '2018-01-21', 3),
(60, 6, 394, 0, 15, 1, '2018-01-23', 1),
(61, 7, 42, 0, 28, 1, '2018-01-23', 2);

-- --------------------------------------------------------

--
-- Struktur dari tabel `pos_store`
--

CREATE TABLE `pos_store` (
  `store_id` int(11) NOT NULL,
  `store_name` varchar(25) NOT NULL,
  `store_contact` longtext NOT NULL,
  `store_address` longtext NOT NULL,
  `is_main` text NOT NULL,
  `is_deleted` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `pos_store`
--

INSERT INTO `pos_store` (`store_id`, `store_name`, `store_contact`, `store_address`, `is_main`, `is_deleted`) VALUES
(1, 'ARH', '081919835585', 'Jl Raya Kartini', 'Pusat', 0),
(2, 'Bojong Sari', '081919835585', 'Jl. Raya Bojong Sari', 'Cabang', 0),
(3, 'sd', 'sd', 'xgxfdg', 'Cabang', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `pos_supplier`
--

CREATE TABLE `pos_supplier` (
  `supplier_id` int(11) NOT NULL,
  `supplier_name` text,
  `supplier_contact` longtext,
  `supplier_address` longtext,
  `supplier_phone` varchar(15) DEFAULT NULL,
  `supplier_fax` varchar(15) DEFAULT NULL,
  `created_by` text,
  `created` datetime DEFAULT NULL,
  `is_deleted` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `pos_supplier`
--

INSERT INTO `pos_supplier` (`supplier_id`, `supplier_name`, `supplier_contact`, `supplier_address`, `supplier_phone`, `supplier_fax`, `created_by`, `created`, `is_deleted`) VALUES
(1, 'PT. Asaba', '0818323', 'zdz', '13234', 'zd', 'ajeng95', '2018-01-07 09:31:17', 0),
(2, 'zdf', 'zdf', 'JalanRaya Bojong Nangka\r\n', 'zdf', 'xdf', NULL, '2017-12-01 16:13:07', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `pos_supplier_item`
--

CREATE TABLE `pos_supplier_item` (
  `si_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `unit_id` int(11) NOT NULL,
  `supplier_id` int(11) NOT NULL,
  `si_item_price` int(11) NOT NULL,
  `si_item_hpp` int(11) NOT NULL,
  `created_by` text NOT NULL,
  `created` datetime NOT NULL,
  `is_deleted` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `pos_unit`
--

CREATE TABLE `pos_unit` (
  `unit_id` int(11) NOT NULL,
  `unit_name` text NOT NULL,
  `created_by` text NOT NULL,
  `created` datetime NOT NULL,
  `is_deleted` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `pos_unit`
--

INSERT INTO `pos_unit` (`unit_id`, `unit_name`, `created_by`, `created`, `is_deleted`) VALUES
(1, 'Pcs', 'Administrator', '2017-11-30 17:34:30', 1),
(2, 'Lembar', 'Administrator', '2017-12-02 12:57:18', 0),
(3, 'Meter', 'Administrator', '2017-12-02 12:57:13', 0),
(4, 'buku', 'Administrator', '2017-11-30 17:44:54', 1),
(5, 'assd', 'Administrator', '2017-11-30 17:35:50', 1),
(6, 'Buku', 'Administrator', '2017-12-02 12:57:09', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `apps_access_level`
--
ALTER TABLE `apps_access_level`
  ADD PRIMARY KEY (`access_level_id`);

--
-- Indexes for table `apps_active_login`
--
ALTER TABLE `apps_active_login`
  ADD PRIMARY KEY (`active_login_id`);

--
-- Indexes for table `apps_jabatan`
--
ALTER TABLE `apps_jabatan`
  ADD PRIMARY KEY (`jabatan_id`);

--
-- Indexes for table `apps_login`
--
ALTER TABLE `apps_login`
  ADD PRIMARY KEY (`login_id`);

--
-- Indexes for table `apps_master_queue`
--
ALTER TABLE `apps_master_queue`
  ADD PRIMARY KEY (`m_queue_id`);

--
-- Indexes for table `apps_module`
--
ALTER TABLE `apps_module`
  ADD PRIMARY KEY (`module_id`);

--
-- Indexes for table `apps_printer`
--
ALTER TABLE `apps_printer`
  ADD PRIMARY KEY (`printer_id`);

--
-- Indexes for table `apps_queue`
--
ALTER TABLE `apps_queue`
  ADD PRIMARY KEY (`queue_id`);

--
-- Indexes for table `apps_role_access`
--
ALTER TABLE `apps_role_access`
  ADD PRIMARY KEY (`role_access_id`);

--
-- Indexes for table `apps_shift`
--
ALTER TABLE `apps_shift`
  ADD PRIMARY KEY (`shift_id`);

--
-- Indexes for table `apps_users`
--
ALTER TABLE `apps_users`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `pos_bank`
--
ALTER TABLE `pos_bank`
  ADD PRIMARY KEY (`bank_id`);

--
-- Indexes for table `pos_billing`
--
ALTER TABLE `pos_billing`
  ADD PRIMARY KEY (`billing_id`);

--
-- Indexes for table `pos_billing_detail`
--
ALTER TABLE `pos_billing_detail`
  ADD PRIMARY KEY (`billing_detail_id`);

--
-- Indexes for table `pos_category`
--
ALTER TABLE `pos_category`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `pos_customer`
--
ALTER TABLE `pos_customer`
  ADD PRIMARY KEY (`customer_id`);

--
-- Indexes for table `pos_item`
--
ALTER TABLE `pos_item`
  ADD PRIMARY KEY (`item_id`);

--
-- Indexes for table `pos_paid_detail`
--
ALTER TABLE `pos_paid_detail`
  ADD PRIMARY KEY (`paid_detail_id`);

--
-- Indexes for table `pos_payment`
--
ALTER TABLE `pos_payment`
  ADD PRIMARY KEY (`payment_id`);

--
-- Indexes for table `pos_piutang`
--
ALTER TABLE `pos_piutang`
  ADD PRIMARY KEY (`piutang_id`);

--
-- Indexes for table `pos_po`
--
ALTER TABLE `pos_po`
  ADD PRIMARY KEY (`po_id`);

--
-- Indexes for table `pos_po_detail`
--
ALTER TABLE `pos_po_detail`
  ADD PRIMARY KEY (`po_id`);

--
-- Indexes for table `pos_retur`
--
ALTER TABLE `pos_retur`
  ADD PRIMARY KEY (`retur_id`);

--
-- Indexes for table `pos_retur_detail`
--
ALTER TABLE `pos_retur_detail`
  ADD PRIMARY KEY (`retur_detail_id`);

--
-- Indexes for table `pos_spk`
--
ALTER TABLE `pos_spk`
  ADD PRIMARY KEY (`spk_id`);

--
-- Indexes for table `pos_stock`
--
ALTER TABLE `pos_stock`
  ADD PRIMARY KEY (`stock_id`);

--
-- Indexes for table `pos_stock_flow`
--
ALTER TABLE `pos_stock_flow`
  ADD PRIMARY KEY (`ref_id`);

--
-- Indexes for table `pos_stock_rekap`
--
ALTER TABLE `pos_stock_rekap`
  ADD PRIMARY KEY (`sr_id`);

--
-- Indexes for table `pos_store`
--
ALTER TABLE `pos_store`
  ADD PRIMARY KEY (`store_id`);

--
-- Indexes for table `pos_supplier`
--
ALTER TABLE `pos_supplier`
  ADD PRIMARY KEY (`supplier_id`);

--
-- Indexes for table `pos_supplier_item`
--
ALTER TABLE `pos_supplier_item`
  ADD PRIMARY KEY (`si_id`);

--
-- Indexes for table `pos_unit`
--
ALTER TABLE `pos_unit`
  ADD PRIMARY KEY (`unit_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `apps_access_level`
--
ALTER TABLE `apps_access_level`
  MODIFY `access_level_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `apps_active_login`
--
ALTER TABLE `apps_active_login`
  MODIFY `active_login_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `apps_jabatan`
--
ALTER TABLE `apps_jabatan`
  MODIFY `jabatan_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `apps_login`
--
ALTER TABLE `apps_login`
  MODIFY `login_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=153;
--
-- AUTO_INCREMENT for table `apps_master_queue`
--
ALTER TABLE `apps_master_queue`
  MODIFY `m_queue_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `apps_module`
--
ALTER TABLE `apps_module`
  MODIFY `module_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;
--
-- AUTO_INCREMENT for table `apps_printer`
--
ALTER TABLE `apps_printer`
  MODIFY `printer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `apps_queue`
--
ALTER TABLE `apps_queue`
  MODIFY `queue_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=414;
--
-- AUTO_INCREMENT for table `apps_role_access`
--
ALTER TABLE `apps_role_access`
  MODIFY `role_access_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=294;
--
-- AUTO_INCREMENT for table `apps_shift`
--
ALTER TABLE `apps_shift`
  MODIFY `shift_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `apps_users`
--
ALTER TABLE `apps_users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `pos_bank`
--
ALTER TABLE `pos_bank`
  MODIFY `bank_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `pos_billing`
--
ALTER TABLE `pos_billing`
  MODIFY `billing_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `pos_billing_detail`
--
ALTER TABLE `pos_billing_detail`
  MODIFY `billing_detail_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=560;
--
-- AUTO_INCREMENT for table `pos_category`
--
ALTER TABLE `pos_category`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `pos_customer`
--
ALTER TABLE `pos_customer`
  MODIFY `customer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=117;
--
-- AUTO_INCREMENT for table `pos_item`
--
ALTER TABLE `pos_item`
  MODIFY `item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `pos_paid_detail`
--
ALTER TABLE `pos_paid_detail`
  MODIFY `paid_detail_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=76;
--
-- AUTO_INCREMENT for table `pos_payment`
--
ALTER TABLE `pos_payment`
  MODIFY `payment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `pos_piutang`
--
ALTER TABLE `pos_piutang`
  MODIFY `piutang_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;
--
-- AUTO_INCREMENT for table `pos_po`
--
ALTER TABLE `pos_po`
  MODIFY `po_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `pos_po_detail`
--
ALTER TABLE `pos_po_detail`
  MODIFY `po_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `pos_retur`
--
ALTER TABLE `pos_retur`
  MODIFY `retur_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `pos_retur_detail`
--
ALTER TABLE `pos_retur_detail`
  MODIFY `retur_detail_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=147;
--
-- AUTO_INCREMENT for table `pos_spk`
--
ALTER TABLE `pos_spk`
  MODIFY `spk_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;
--
-- AUTO_INCREMENT for table `pos_stock`
--
ALTER TABLE `pos_stock`
  MODIFY `stock_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=203;
--
-- AUTO_INCREMENT for table `pos_stock_flow`
--
ALTER TABLE `pos_stock_flow`
  MODIFY `ref_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=124;
--
-- AUTO_INCREMENT for table `pos_stock_rekap`
--
ALTER TABLE `pos_stock_rekap`
  MODIFY `sr_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;
--
-- AUTO_INCREMENT for table `pos_store`
--
ALTER TABLE `pos_store`
  MODIFY `store_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `pos_supplier`
--
ALTER TABLE `pos_supplier`
  MODIFY `supplier_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `pos_supplier_item`
--
ALTER TABLE `pos_supplier_item`
  MODIFY `si_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `pos_unit`
--
ALTER TABLE `pos_unit`
  MODIFY `unit_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
