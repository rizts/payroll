-- phpMyAdmin SQL Dump
-- version 3.4.10.1deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 04, 2013 at 03:49 PM
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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `assets`
--

INSERT INTO `assets` (`asset_id`, `asset_name`, `asset_status`, `staff_id`, `date`) VALUES
(1, 'Table Office', 1, 1, '2013-09-09 00:00:00'),
(2, 'Motor Honda Supra RX', 1, 1, '2013-01-10 00:00:00');

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `branches`
--

CREATE TABLE IF NOT EXISTS `branches` (
  `branch_id` int(11) NOT NULL AUTO_INCREMENT,
  `branch_name` varchar(50) NOT NULL,
  PRIMARY KEY (`branch_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `branches`
--

INSERT INTO `branches` (`branch_id`, `branch_name`) VALUES
(1, 'Bandung'),
(4, 'Bali Tah'),
(10, 'Jakarta');

-- --------------------------------------------------------

--
-- Table structure for table `component`
--

CREATE TABLE IF NOT EXISTS `component` (
  `comp_id` int(11) NOT NULL AUTO_INCREMENT,
  `comp_name` varchar(20) NOT NULL,
  `comp_type` varchar(8) NOT NULL COMMENT 'kalau Opsi daily ketika input gaji maka opsi amount_daily muncul, misalnya uang makan',
  PRIMARY KEY (`comp_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `component`
--

INSERT INTO `component` (`comp_id`, `comp_name`, `comp_type`) VALUES
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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `educations`
--

INSERT INTO `educations` (`edu_id`, `staff_id`, `edu_year`, `edu_gelar`, `edu_name`) VALUES
(5, 1, 2010, 'S1', 'Sarjana Informasi'),
(6, 1, 2011, 'S2', 'Teknik Informatika'),
(7, 2, 2010, 's1', 'Sarjana Informasi');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `families`
--

INSERT INTO `families` (`staff_fam_id`, `staff_fam_staff_id`, `staff_fam_order`, `staff_fam_name`, `staff_fam_birthdate`, `staff_fam_birthplace`, `staff_fam_sex`, `staff_fam_relation`) VALUES
(5, 1, 'Kandung', 'Jasmine Zahirra BL', '2013-01-10', 'Bandung', 'Perempuan', 'Anak 1'),
(9, 2, 'Kandung', 'Asep Surya Jaya Abadi', '0000-00-00', 'Surabaya', 'Laki', 'Anak 1');

-- --------------------------------------------------------

--
-- Table structure for table `fiscal`
--

CREATE TABLE IF NOT EXISTS `fiscal` (
  `date` date NOT NULL,
  `status` varchar(5) NOT NULL
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
(3, 2, '2010-01-01', 'Flur');

-- --------------------------------------------------------

--
-- Table structure for table `salary`
--

CREATE TABLE IF NOT EXISTS `salary` (
  `salary_id` int(11) NOT NULL AUTO_INCREMENT,
  `salary_periode` date NOT NULL,
  `salary_staffid` int(11) NOT NULL,
  PRIMARY KEY (`salary_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `salary_component`
--

CREATE TABLE IF NOT EXISTS `salary_component` (
  `gaji_id` int(11) NOT NULL AUTO_INCREMENT,
  `gaji_component_id` int(11) NOT NULL,
  `gaji_daily_value` decimal(10,0) NOT NULL,
  `gaji_amount_value` decimal(10,0) NOT NULL,
  PRIMARY KEY (`gaji_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `salary_component`
--

INSERT INTO `salary_component` (`gaji_id`, `gaji_component_id`, `gaji_daily_value`, `gaji_amount_value`) VALUES
(1, 1, 1200090, 67676);

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
  `staff_birthdate` date NOT NULL,
  `staff_birthplace` varchar(20) NOT NULL,
  `staff_sex` varchar(10) NOT NULL,
  PRIMARY KEY (`staff_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `staffs`
--

INSERT INTO `staffs` (`staff_id`, `staff_nik`, `staff_kode_absen`, `staff_name`, `staff_address`, `staff_email`, `staff_email_alternatif`, `staff_phone_home`, `staff_phone_hp`, `staff_status_pajak`, `staff_status_nikah`, `staff_status_karyawan`, `staff_cabang`, `staff_departement`, `staff_jabatan`, `staff_photo`, `staff_birthdate`, `staff_birthplace`, `staff_sex`) VALUES
(1, 6305280, 'JK', 'Dikdik Tasdik Laksana', 'Komp. Margahayu Kencana Blok I 1 No.9', 'dikdik.zahirra@gmail.com', 'dikdik.zahirra@gmail.com', '082116914224', '5410000', 'K1', 'Married', 'Tetap', 'Bandung', 'Transportation', 'Supervisor', '-', '0000-00-00', 'Bandung', '0'),
(2, 6305281, 'JK - ', 'Jasmine Zahirra', 'Komp. Margahayu Kencana Blok I 1 No. 9', 'jasmine@gmail.com', 'jasmine@gmail.com', '909090909090', '090909090909', 'K2', 'Single', 'Tetap', 'Bandung', 'Accounting', 'Manager', '909090990', '2011-05-05', 'Bandung', '0');

-- --------------------------------------------------------

--
-- Table structure for table `sub_gaji`
--

CREATE TABLE IF NOT EXISTS `sub_gaji` (
  `salary_id` int(11) NOT NULL,
  `salary_period` date NOT NULL,
  `salary_component_id` int(11) NOT NULL,
  `salary_daily_value` decimal(10,0) NOT NULL,
  `salary_amount_value` decimal(10,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
(1, 'TK', 0),
(2, 'K0', 0),
(3, 'K1', 0),
(4, 'K2', 0),
(5, 'K3', 0);

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
-- Table structure for table `work_histories`
--

CREATE TABLE IF NOT EXISTS `work_histories` (
  `history_id` int(11) NOT NULL AUTO_INCREMENT,
  `staff_id` int(11) NOT NULL,
  `history_date` date NOT NULL,
  `history_description` text NOT NULL,
  PRIMARY KEY (`history_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `work_histories`
--

INSERT INTO `work_histories` (`history_id`, `staff_id`, `history_date`, `history_description`) VALUES
(10, 2, '2013-09-09', 'Web Developer');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
