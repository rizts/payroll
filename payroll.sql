-- phpMyAdmin SQL Dump
-- version 3.4.10.1deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 18, 2013 at 06:22 PM
-- Server version: 5.5.28
-- PHP Version: 5.3.10-1ubuntu3.5

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `payroll`
--

-- --------------------------------------------------------

--
-- Table structure for table `assets`
--

CREATE TABLE IF NOT EXISTS `assets` (
  `asset_id` int(11) NOT NULL AUTO_INCREMENT,
  `asset_name` varchar(30) NOT NULL,
  `asset_status` tinyint(1) NOT NULL,
  `staff_id` int(11) NOT NULL,
  `date` datetime NOT NULL,
  PRIMARY KEY (`asset_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `assets`
--

INSERT INTO `assets` (`asset_id`, `asset_name`, `asset_status`, `staff_id`, `date`) VALUES
(5, 'Handphone', 1, 1, '2013-03-14 00:00:00'),
(6, 'Rumah', 1, 2, '0000-00-00 00:00:00'),
(7, 'Motor', 1, 3, '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `asset_details`
--

CREATE TABLE IF NOT EXISTS `asset_details` (
  `assetd_id` int(11) NOT NULL AUTO_INCREMENT,
  `asset_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `staff_id` int(11) NOT NULL,
  `descriptions` text NOT NULL,
  `assetd_status` tinyint(1) NOT NULL,
  PRIMARY KEY (`assetd_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `asset_details`
--

INSERT INTO `asset_details` (`assetd_id`, `asset_id`, `date`, `staff_id`, `descriptions`, `assetd_status`) VALUES
(3, 3, '0000-00-00', 1, 'dscription dscription dscription dscription dscription ', 1),
(4, 3, '0000-00-00', 1, 'dasfsd fsd fsdf ', 0),
(5, 6, '2013-03-14', 2, '2013-03-14', 1),
(6, 5, '2013-03-20', 3, 'motor mio', 1),
(7, 5, '2013-03-01', 4, 'sdsdfs', 1);

-- --------------------------------------------------------

--
-- Table structure for table `branches`
--

CREATE TABLE IF NOT EXISTS `branches` (
  `branch_id` int(11) NOT NULL AUTO_INCREMENT,
  `branch_name` varchar(50) NOT NULL,
  PRIMARY KEY (`branch_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=21 ;

--
-- Dumping data for table `branches`
--

INSERT INTO `branches` (`branch_id`, `branch_name`) VALUES
(1, 'Bandung'),
(10, 'Jakarta'),
(11, 'Surabaya'),
(12, 'Makasar'),
(13, 'Manado'),
(14, 'Ambon'),
(15, 'Aceh'),
(16, 'Medan'),
(17, 'Yogyakarta'),
(18, 'Pangandaran'),
(19, 'Bali'),
(20, 'Garut');

-- --------------------------------------------------------

--
-- Table structure for table `components`
--

CREATE TABLE IF NOT EXISTS `components` (
  `comp_id` int(11) NOT NULL AUTO_INCREMENT,
  `comp_name` varchar(20) NOT NULL,
  `comp_type` varchar(8) NOT NULL COMMENT 'kalau Opsi daily ketika input gaji maka opsi amount_daily muncul, misalnya uang makan',
  PRIMARY KEY (`comp_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `components`
--

INSERT INTO `components` (`comp_id`, `comp_name`, `comp_type`) VALUES
(4, 'Gaji Pokok', 'Monthly'),
(5, 'Tunjangan Jabatan', 'Monthly'),
(6, 'Uang Makan', 'Daily'),
(7, 'THR', 'Yearly');

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE IF NOT EXISTS `departments` (
  `dept_id` int(11) NOT NULL AUTO_INCREMENT,
  `dept_name` varchar(50) NOT NULL,
  PRIMARY KEY (`dept_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`dept_id`, `dept_name`) VALUES
(1, 'Accounting'),
(2, 'Marketing'),
(3, 'Reservation'),
(4, 'Operation'),
(5, 'Ticketing'),
(6, 'Transportation');

-- --------------------------------------------------------

--
-- Table structure for table `educations`
--

CREATE TABLE IF NOT EXISTS `educations` (
  `edu_id` int(11) NOT NULL AUTO_INCREMENT,
  `staff_id` int(11) NOT NULL,
  `edu_year` int(4) NOT NULL,
  `edu_gelar` varchar(10) NOT NULL,
  `edu_name` varchar(30) NOT NULL,
  PRIMARY KEY (`edu_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `educations`
--

INSERT INTO `educations` (`edu_id`, `staff_id`, `edu_year`, `edu_gelar`, `edu_name`) VALUES
(5, 1, 2010, 'S1', 'Sarjana Informasi'),
(7, 2, 2010, 's1', 'Sarjana Informasi'),
(8, 1, 2010, 'D3', 'Teknik Informatika'),
(9, 1, 2007, 'D1', 'Aplikasi Perkantoran');

-- --------------------------------------------------------

--
-- Table structure for table `employees_status`
--

CREATE TABLE IF NOT EXISTS `employees_status` (
  `sk_id` int(11) NOT NULL AUTO_INCREMENT,
  `sk_name` varchar(10) NOT NULL,
  PRIMARY KEY (`sk_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `employees_status`
--

INSERT INTO `employees_status` (`sk_id`, `sk_name`) VALUES
(1, 'Kontrak'),
(2, 'Tetap'),
(4, 'Freelance');

-- --------------------------------------------------------

--
-- Table structure for table `families`
--

CREATE TABLE IF NOT EXISTS `families` (
  `staff_fam_id` int(11) NOT NULL AUTO_INCREMENT,
  `staff_fam_staff_id` int(11) NOT NULL,
  `staff_fam_order` varchar(20) NOT NULL,
  `staff_fam_name` varchar(30) NOT NULL,
  `staff_fam_birthdate` date NOT NULL,
  `staff_fam_birthplace` varchar(30) NOT NULL,
  `staff_fam_sex` varchar(10) NOT NULL,
  `staff_fam_relation` varchar(10) NOT NULL,
  PRIMARY KEY (`staff_fam_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Dumping data for table `families`
--

INSERT INTO `families` (`staff_fam_id`, `staff_fam_staff_id`, `staff_fam_order`, `staff_fam_name`, `staff_fam_birthdate`, `staff_fam_birthplace`, `staff_fam_sex`, `staff_fam_relation`) VALUES
(5, 1, 'AK', 'Jasmine Zahirra Bintang Laksan', '2011-07-05', 'Bandung', 'Perempuan', 'Anak 1'),
(9, 2, 'Kandung', 'Asep Surya Jaya Abadi', '0000-00-00', 'Surabaya', 'Laki', 'Anak 1'),
(10, 4, 'sdfs', 'klkl', '0000-00-00', ';lk', 'Perempuan', 'Anak 4'),
(11, 3, 'Kandung', 'Serly', '0000-00-00', 'Bandung', 'Perempuan', 'Anak 3'),
(12, 1, 'IS', 'Rissa Mulanita', '1985-09-04', 'Bandung', 'Perempuan', 'Istri');

-- --------------------------------------------------------

--
-- Table structure for table `fiscals`
--

CREATE TABLE IF NOT EXISTS `fiscals` (
  `date` varchar(6) NOT NULL DEFAULT '000000',
  `status` varchar(5) NOT NULL DEFAULT 'open'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `maritals_status`
--

CREATE TABLE IF NOT EXISTS `maritals_status` (
  `sn_id` int(11) NOT NULL AUTO_INCREMENT,
  `sn_name` varchar(8) NOT NULL,
  PRIMARY KEY (`sn_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `maritals_status`
--

INSERT INTO `maritals_status` (`sn_id`, `sn_name`) VALUES
(1, 'Single'),
(2, 'Married'),
(4, 'Divorce');

-- --------------------------------------------------------

--
-- Table structure for table `medical_histories`
--

CREATE TABLE IF NOT EXISTS `medical_histories` (
  `medic_id` int(11) NOT NULL AUTO_INCREMENT,
  `staff_id` int(11) NOT NULL,
  `medic_date` date NOT NULL,
  `medic_description` text NOT NULL,
  PRIMARY KEY (`medic_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `medical_histories`
--

INSERT INTO `medical_histories` (`medic_id`, `staff_id`, `medic_date`, `medic_description`) VALUES
(2, 0, '2013-12-12', 'Flue wae'),
(5, 4, '2013-03-14', 'sdsdf');

-- --------------------------------------------------------

--
-- Table structure for table `salaries`
--

CREATE TABLE IF NOT EXISTS `salaries` (
  `salary_id` int(11) NOT NULL AUTO_INCREMENT,
  `salary_periode` date NOT NULL,
  `salary_staffid` int(11) NOT NULL,
  PRIMARY KEY (`salary_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `salaries`
--

INSERT INTO `salaries` (`salary_id`, `salary_periode`, `salary_staffid`) VALUES
(2, '2010-01-01', 1),
(3, '2013-03-03', 2);

-- --------------------------------------------------------

--
-- Table structure for table `salary_components`
--

CREATE TABLE IF NOT EXISTS `salary_components` (
  `gaji_id` int(11) NOT NULL AUTO_INCREMENT,
  `staff_id` int(11) NOT NULL,
  `gaji_component_id` int(11) NOT NULL,
  `gaji_daily_value` decimal(10,0) NOT NULL,
  `gaji_amount_value` decimal(10,0) NOT NULL,
  PRIMARY KEY (`gaji_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `salary_components`
--

INSERT INTO `salary_components` (`gaji_id`, `staff_id`, `gaji_component_id`, `gaji_daily_value`, `gaji_amount_value`) VALUES
(6, 1, 6, 1000089, 10067),
(7, 2, 4, 190, 1900000),
(8, 1, 7, 9000, 90000),
(9, 2, 6, 787878, 3343),
(10, 4, 6, 12000, 15000);

-- --------------------------------------------------------

--
-- Table structure for table `staffs`
--

CREATE TABLE IF NOT EXISTS `staffs` (
  `staff_id` int(11) NOT NULL AUTO_INCREMENT,
  `staff_nik` int(10) NOT NULL,
  `staff_kode_absen` varchar(5) NOT NULL,
  `staff_name` varchar(50) NOT NULL,
  `staff_address` text NOT NULL,
  `staff_email` varchar(30) NOT NULL,
  `staff_email_alternatif` varchar(30) NOT NULL,
  `staff_phone_home` varchar(20) NOT NULL,
  `staff_phone_hp` varchar(20) NOT NULL,
  `staff_status_pajak` varchar(10) NOT NULL,
  `staff_status_nikah` varchar(10) NOT NULL,
  `staff_status_karyawan` varchar(10) NOT NULL,
  `staff_cabang` varchar(20) NOT NULL,
  `staff_departement` varchar(20) NOT NULL,
  `staff_jabatan` varchar(20) NOT NULL,
  `staff_photo` varchar(30) NOT NULL,
  `staff_birthdate` datetime NOT NULL,
  `staff_birthplace` varchar(20) NOT NULL,
  `staff_sex` varchar(10) NOT NULL,
  `staff_password` varchar(255) NOT NULL,
  PRIMARY KEY (`staff_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `staffs`
--

INSERT INTO `staffs` (`staff_id`, `staff_nik`, `staff_kode_absen`, `staff_name`, `staff_address`, `staff_email`, `staff_email_alternatif`, `staff_phone_home`, `staff_phone_hp`, `staff_status_pajak`, `staff_status_nikah`, `staff_status_karyawan`, `staff_cabang`, `staff_departement`, `staff_jabatan`, `staff_photo`, `staff_birthdate`, `staff_birthplace`, `staff_sex`, `staff_password`) VALUES
(1, 6305280, 'JK', 'Dikdik Tasdik Laksana', 'Komp. Margahayu Kencana Blok I 1 No.9', 'dikdik.zahirra@gmail.com', 'dikdik.zahirra@gmail.com', '5410908', '082116914224', 'K1', 'Married', 'Tetap', 'Bandung', 'Transportation', 'Supervisor', '', '2013-03-13 00:00:00', 'Bandung', '0', 'd8578edf8458ce06fbc5bb76a58c5ca4'),
(2, 6305281, 'JK - ', 'Jasmine Zahirra', 'Komp. Margahayu Kencana Blok I 1 No. 19', 'jasmine@gmail.com', 'jasmine@gmail.com', '909090909090', '090909090909', 'K2', 'Single', 'Tetap', 'Bandung', 'Accounting', 'Manager', '', '2013-03-12 00:00:00', 'Bandung', '0', ''),
(3, 6305285, 'JK', 'Dariel ', 'Cibiru', 'dari@yahoo.com', 'dari@yahoo.com', '08123998389', '08509090909', 'K1', 'Married', 'Tetap', 'Bandung', 'Ticketing', 'Manager', '-', '1986-03-01 00:00:00', 'Bandung', '0', 'd41d8cd98f00b204e9800998ecf8427e'),
(4, 6305283, '90', 'Asep Sumpena', 'Bandung', 'asep@gmail.com', 'asep@gmail.com', '(022) 8989899', '08523456778', 'K3', 'Single', 'Kontrak', '', 'Accounting', 'Staff', '-', '1987-04-11 00:00:00', 'Bali', '0', 'd41d8cd98f00b204e9800998ecf8427e'),
(7, 6305282, 'JK', 'Jaka Suseno', 'Jl. kalapa Gading Barat No. 12', 'jaka@gmai.com', 'jak@gmail.com', '08123998389', '082116914774', 'K1', 'Single', 'Tetap', 'Bandung', 'Marketing', 'General Manager', '', '2013-03-26 00:00:00', 'Bandung', '0', 'd41d8cd98f00b204e9800998ecf8427e');

-- --------------------------------------------------------

--
-- Table structure for table `sub_salaries`
--

CREATE TABLE IF NOT EXISTS `sub_salaries` (
  `sub_id` int(11) NOT NULL AUTO_INCREMENT,
  `salary_id` int(11) NOT NULL,
  `salary_periode` date NOT NULL,
  `salary_component_id` int(11) NOT NULL,
  `salary_daily_value` decimal(10,0) NOT NULL,
  `salary_amount_value` decimal(10,0) NOT NULL,
  PRIMARY KEY (`sub_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `sub_salaries`
--

INSERT INTO `sub_salaries` (`sub_id`, `salary_id`, `salary_periode`, `salary_component_id`, `salary_daily_value`, `salary_amount_value`) VALUES
(6, 2, '2010-01-01', 4, 0, 1500000);

-- --------------------------------------------------------

--
-- Table structure for table `taxes_employees`
--

CREATE TABLE IF NOT EXISTS `taxes_employees` (
  `sp_id` int(11) NOT NULL AUTO_INCREMENT,
  `sp_status` varchar(3) NOT NULL,
  `sp_ptkp` int(11) NOT NULL,
  PRIMARY KEY (`sp_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `taxes_employees`
--

INSERT INTO `taxes_employees` (`sp_id`, `sp_status`, `sp_ptkp`) VALUES
(1, 'TK7', 50089),
(3, 'K1', 15000),
(4, 'K2', 300),
(5, 'K3', 400);

-- --------------------------------------------------------

--
-- Table structure for table `titles`
--

CREATE TABLE IF NOT EXISTS `titles` (
  `title_id` int(11) NOT NULL AUTO_INCREMENT,
  `title_name` varchar(20) NOT NULL,
  PRIMARY KEY (`title_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `titles`
--

INSERT INTO `titles` (`title_id`, `title_name`) VALUES
(1, 'Manager'),
(2, 'General Manager'),
(3, 'Supervisor'),
(5, 'Staff');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `staff_id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `avatar` varchar(255) NOT NULL,
  `role_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `staff_id`, `username`, `password`, `avatar`, `role_id`, `created_at`, `updated_at`) VALUES
(1, 1, 'admin', 'd8578edf8458ce06fbc5bb76a58c5ca4', '-', 1, '2013-03-13 08:26:00', '2013-03-13 08:26:00'),
(2, 2, 'jasmine', '25d55ad283aa400af464c76d713c07ad', '', 3, '2013-03-18 09:03:58', '2013-03-18 09:03:58');

-- --------------------------------------------------------

--
-- Table structure for table `user_roled`
--

CREATE TABLE IF NOT EXISTS `user_roled` (
  `roled_id` int(11) NOT NULL AUTO_INCREMENT,
  `role_id` int(11) NOT NULL,
  `roled_module` varchar(20) NOT NULL,
  `roled_add` tinyint(1) NOT NULL,
  `roled_edit` tinyint(1) NOT NULL,
  `roled_delete` tinyint(1) NOT NULL,
  `roled_approval` tinyint(1) NOT NULL,
  `roled_select` tinyint(1) NOT NULL,
  PRIMARY KEY (`roled_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=106 ;

--
-- Dumping data for table `user_roled`
--

INSERT INTO `user_roled` (`roled_id`, `role_id`, `roled_module`, `roled_add`, `roled_edit`, `roled_delete`, `roled_approval`, `roled_select`) VALUES
(40, 1, 'Branch', 1, 1, 1, 1, 1),
(41, 1, 'Departement', 1, 1, 1, 1, 1),
(42, 1, 'Tax_Employee', 0, 1, 0, 1, 0),
(43, 1, 'Employee_Status', 0, 1, 0, 1, 0),
(44, 1, 'Marital_Status', 1, 1, 0, 1, 0),
(45, 1, 'Title', 1, 1, 0, 1, 0),
(46, 1, 'Component', 1, 1, 0, 1, 0),
(47, 1, 'Salary', 1, 1, 0, 1, 0),
(48, 1, 'Staff', 1, 1, 0, 1, 0),
(49, 1, 'Assets', 1, 1, 0, 1, 0),
(50, 1, 'Users', 1, 1, 0, 1, 0),
(51, 1, 'Role_Details', 1, 1, 0, 1, 0),
(82, 3, 'Branch', 1, 0, 0, 0, 1),
(83, 3, 'Departement', 1, 0, 0, 0, 1),
(84, 3, 'Tax_Employee', 1, 0, 0, 0, 1),
(85, 3, 'Employee_Status', 1, 0, 0, 0, 1),
(86, 3, 'Marital_Status', 1, 1, 0, 0, 1),
(87, 3, 'Title', 1, 0, 1, 0, 1),
(88, 3, 'Component', 1, 0, 0, 0, 1),
(89, 3, 'Salary', 1, 0, 0, 0, 1),
(90, 3, 'Staff', 1, 0, 0, 0, 1),
(91, 3, 'Assets', 1, 0, 0, 0, 1),
(92, 3, 'Users', 0, 0, 0, 0, 0),
(93, 3, 'Role_Details', 0, 0, 0, 0, 0),
(94, 2, 'Branch', 1, 1, 1, 1, 1),
(95, 2, 'Departement', 1, 1, 1, 1, 1),
(96, 2, 'Tax_Employee', 1, 1, 1, 1, 1),
(97, 2, 'Employee_Status', 1, 1, 1, 1, 1),
(98, 2, 'Marital_Status', 1, 1, 1, 1, 1),
(99, 2, 'Title', 1, 1, 1, 1, 1),
(100, 2, 'Component', 1, 1, 1, 1, 1),
(101, 2, 'Salary', 1, 1, 1, 1, 1),
(102, 2, 'Staff', 1, 1, 1, 1, 1),
(103, 2, 'Assets', 1, 1, 1, 1, 1),
(104, 2, 'Users', 1, 1, 1, 1, 1),
(105, 2, 'Role_Details', 1, 1, 1, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `user_roles`
--

CREATE TABLE IF NOT EXISTS `user_roles` (
  `role_id` int(11) NOT NULL AUTO_INCREMENT,
  `role_name` varchar(255) NOT NULL,
  PRIMARY KEY (`role_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `user_roles`
--

INSERT INTO `user_roles` (`role_id`, `role_name`) VALUES
(1, 'Administrator'),
(2, 'Superuser'),
(3, 'Guest');

-- --------------------------------------------------------

--
-- Table structure for table `work_histories`
--

CREATE TABLE IF NOT EXISTS `work_histories` (
  `history_id` int(11) NOT NULL AUTO_INCREMENT,
  `staff_id` int(11) NOT NULL,
  `history_date` date NOT NULL,
  `history_description` text NOT NULL,
  PRIMARY KEY (`history_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=20 ;

--
-- Dumping data for table `work_histories`
--

INSERT INTO `work_histories` (`history_id`, `staff_id`, `history_date`, `history_description`) VALUES
(10, 2, '2013-09-09', 'Web Developer'),
(11, 1, '2011-11-23', 'PT. Intermedia eTrade'),
(12, 1, '2013-03-13', '41Studio'),
(13, 1, '2012-05-01', 'PD. BPR KAB BANDUNG'),
(15, 4, '2013-03-05', 'Bank BCA'),
(16, 4, '2013-03-13', 'Travel Line'),
(17, 4, '2013-03-26', 'Travel Media Prima'),
(18, 4, '2013-03-17', 'Garuda Airlines'),
(19, 1, '2013-03-21', 'Pixcel Design Agency');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
