-- phpMyAdmin SQL Dump
-- version 2.11.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 11, 2013 at 03:00 PM
-- Server version: 5.0.45
-- PHP Version: 5.2.5

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

--
-- Database: `payroll`
--

-- --------------------------------------------------------

--
-- Table structure for table `absensi`
--

CREATE TABLE IF NOT EXISTS `absensi` (
  `id` int(11) NOT NULL auto_increment,
  `staff_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `hari_masuk` int(11) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `absensi`
--

INSERT INTO `absensi` (`id`, `staff_id`, `date`, `hari_masuk`) VALUES
(1, 1, '2013-04-10', 24),
(2, 2, '2013-04-10', 24),
(3, 7, '2013-04-10', 8);

-- --------------------------------------------------------

--
-- Table structure for table `assets`
--

CREATE TABLE IF NOT EXISTS `assets` (
  `asset_id` int(11) NOT NULL auto_increment,
  `asset_name` varchar(30) NOT NULL,
  `asset_status` tinyint(1) NOT NULL,
  `staff_id` int(11) NOT NULL,
  `date` datetime NOT NULL,
  PRIMARY KEY  (`asset_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `assets`
--

INSERT INTO `assets` (`asset_id`, `asset_name`, `asset_status`, `staff_id`, `date`) VALUES
(1, 'Table Office', 1, 1, '2013-09-09 00:00:00'),
(2, 'Motor Honda Supra RX', 1, 1, '2013-01-10 00:00:00'),
(3, 'Kursi', 1, 2, '2013-01-10 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `asset_details`
--

CREATE TABLE IF NOT EXISTS `asset_details` (
  `assetd_id` int(11) NOT NULL auto_increment,
  `asset_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `staff_id` int(11) NOT NULL,
  `descriptions` text NOT NULL,
  `assetd_status` tinyint(1) NOT NULL,
  PRIMARY KEY  (`assetd_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `asset_details`
--

INSERT INTO `asset_details` (`assetd_id`, `asset_id`, `date`, `staff_id`, `descriptions`, `assetd_status`) VALUES
(3, 3, '0000-00-00', 1, 'dscription dscription dscription dscription dscription ', 1),
(4, 3, '0000-00-00', 1, 'dasfsd fsd fsdf ', 0);

-- --------------------------------------------------------

--
-- Table structure for table `branches`
--

CREATE TABLE IF NOT EXISTS `branches` (
  `branch_id` int(11) NOT NULL auto_increment,
  `branch_name` varchar(50) NOT NULL,
  PRIMARY KEY  (`branch_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `branches`
--

INSERT INTO `branches` (`branch_id`, `branch_name`) VALUES
(1, 'Bandung'),
(4, 'Bali'),
(10, 'Jakarta');

-- --------------------------------------------------------

--
-- Table structure for table `components`
--

CREATE TABLE IF NOT EXISTS `components` (
  `comp_id` int(11) NOT NULL auto_increment,
  `comp_name` varchar(20) NOT NULL,
  `comp_type` varchar(8) NOT NULL COMMENT 'kalau Opsi daily ketika input gaji maka opsi amount_daily muncul, misalnya uang makan',
  PRIMARY KEY  (`comp_id`)
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
  `dept_id` int(11) NOT NULL auto_increment,
  `dept_name` varchar(50) NOT NULL,
  PRIMARY KEY  (`dept_id`)
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
  `edu_id` int(11) NOT NULL auto_increment,
  `staff_id` int(11) NOT NULL,
  `edu_year` int(4) NOT NULL,
  `edu_gelar` varchar(10) NOT NULL,
  `edu_name` varchar(30) NOT NULL,
  PRIMARY KEY  (`edu_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `educations`
--

INSERT INTO `educations` (`edu_id`, `staff_id`, `edu_year`, `edu_gelar`, `edu_name`) VALUES
(5, 1, 2010, 'S1', 'Sarjana Informasi'),
(6, 1, 2011, 'S2', 'Teknik Informatika'),
(7, 2, 2010, 's1', 'Sarjana Informasi'),
(8, 1, 2005, '-', 'SMA Margahayu'),
(9, 1, 2000, '-', 'SMP Negri 1');

-- --------------------------------------------------------

--
-- Table structure for table `employees_status`
--

CREATE TABLE IF NOT EXISTS `employees_status` (
  `sk_id` int(11) NOT NULL auto_increment,
  `sk_name` varchar(10) NOT NULL,
  PRIMARY KEY  (`sk_id`)
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
  `staff_fam_id` int(11) NOT NULL auto_increment,
  `staff_fam_staff_id` int(11) NOT NULL,
  `staff_fam_order` varchar(20) NOT NULL,
  `staff_fam_name` varchar(30) NOT NULL,
  `staff_fam_birthdate` date NOT NULL,
  `staff_fam_birthplace` varchar(30) NOT NULL,
  `staff_fam_sex` varchar(10) NOT NULL,
  `staff_fam_relation` varchar(10) NOT NULL,
  PRIMARY KEY  (`staff_fam_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=15 ;

--
-- Dumping data for table `families`
--

INSERT INTO `families` (`staff_fam_id`, `staff_fam_staff_id`, `staff_fam_order`, `staff_fam_name`, `staff_fam_birthdate`, `staff_fam_birthplace`, `staff_fam_sex`, `staff_fam_relation`) VALUES
(5, 1, 'Kandung', 'Selly', '2013-01-10', 'Bandung', 'Perempuan', 'Anak 1'),
(9, 2, 'Kandung', 'Asep Surya Jaya Abadi', '0000-00-00', 'Surabaya', 'Laki', 'Anak 1'),
(10, 7, 'Orang tua', 'Dariel', '2013-03-21', 'Ciamis', 'Male', 'Bapak'),
(11, 7, 'Orang tua', 'Dewi', '2013-03-26', 'Cikuda', 'Female', 'Ibu'),
(12, 7, 'Sodara', 'Sabrina', '2013-03-28', 'New York', 'Female', 'Saudara'),
(13, 3, 'Father', 'Dariel', '2003-04-01', 'Ciamis', 'Male', 'Father'),
(14, 7, 'Father', 'Iwan', '2013-04-24', 'Banten', 'Male', 'Ayah');

-- --------------------------------------------------------

--
-- Table structure for table `fiscals`
--

CREATE TABLE IF NOT EXISTS `fiscals` (
  `date` varchar(6) NOT NULL default '000000',
  `status` varchar(5) NOT NULL default 'open'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `fiscals`
--


-- --------------------------------------------------------

--
-- Table structure for table `maritals_status`
--

CREATE TABLE IF NOT EXISTS `maritals_status` (
  `sn_id` int(11) NOT NULL auto_increment,
  `sn_name` varchar(8) NOT NULL,
  PRIMARY KEY  (`sn_id`)
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
  `medic_id` int(11) NOT NULL auto_increment,
  `staff_id` int(11) NOT NULL,
  `medic_date` date NOT NULL,
  `medic_description` text NOT NULL,
  PRIMARY KEY  (`medic_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `medical_histories`
--

INSERT INTO `medical_histories` (`medic_id`, `staff_id`, `medic_date`, `medic_description`) VALUES
(2, 0, '2013-12-12', 'Flue wae'),
(3, 2, '2010-01-01', 'Flur'),
(4, 6, '2013-03-07', 'wahahah'),
(5, 6, '2013-03-29', 'Enak aja luh'),
(6, 6, '2013-03-28', 'gue cape tau!'),
(7, 7, '2013-03-25', 'Tipes'),
(8, 7, '2013-03-25', 'Maag');

-- --------------------------------------------------------

--
-- Table structure for table `salaries`
--

CREATE TABLE IF NOT EXISTS `salaries` (
  `salary_id` int(11) NOT NULL auto_increment,
  `salary_periode` date NOT NULL,
  `salary_staffid` int(11) NOT NULL,
  PRIMARY KEY  (`salary_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `salaries`
--

INSERT INTO `salaries` (`salary_id`, `salary_periode`, `salary_staffid`) VALUES
(2, '2010-01-01', 3);

-- --------------------------------------------------------

--
-- Table structure for table `salary_components_a`
--

CREATE TABLE IF NOT EXISTS `salary_components_a` (
  `gaji_id` int(11) NOT NULL auto_increment,
  `staff_id` int(11) NOT NULL,
  `gaji_component_id` int(11) NOT NULL,
  `gaji_daily_value` decimal(10,0) NOT NULL,
  `gaji_amount_value` decimal(10,0) NOT NULL,
  PRIMARY KEY  (`gaji_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `salary_components_a`
--

INSERT INTO `salary_components_a` (`gaji_id`, `staff_id`, `gaji_component_id`, `gaji_daily_value`, `gaji_amount_value`) VALUES
(1, 7, 4, '0', '1000000'),
(2, 7, 5, '0', '500000');

-- --------------------------------------------------------

--
-- Table structure for table `salary_components_b`
--

CREATE TABLE IF NOT EXISTS `salary_components_b` (
  `gaji_id` int(11) NOT NULL auto_increment,
  `staff_id` int(11) NOT NULL,
  `gaji_component_id` int(11) NOT NULL,
  `gaji_daily_value` decimal(10,0) NOT NULL,
  `gaji_amount_value` decimal(10,0) NOT NULL,
  PRIMARY KEY  (`gaji_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `salary_components_b`
--


-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE IF NOT EXISTS `settings` (
  `id` int(11) NOT NULL auto_increment,
  `company_name` varchar(255) NOT NULL,
  `address` text NOT NULL,
  `phone` varchar(255) NOT NULL,
  `fax` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `no_npwp` varchar(255) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `company_name`, `address`, `phone`, `fax`, `email`, `city`, `no_npwp`) VALUES
(1, 'Rama Tours', '234 St. Washington', '+622 000 111 222', '+622 222 111 333', 'ramatours@hrd.ramatour.com', 'Bandung', '34.345.567.78.789.09');

-- --------------------------------------------------------

--
-- Table structure for table `staffs`
--

CREATE TABLE IF NOT EXISTS `staffs` (
  `staff_id` int(11) NOT NULL auto_increment,
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
  `staff_password` varchar(255) NOT NULL,
  PRIMARY KEY  (`staff_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `staffs`
--

INSERT INTO `staffs` (`staff_id`, `staff_nik`, `staff_kode_absen`, `staff_name`, `staff_address`, `staff_email`, `staff_email_alternatif`, `staff_phone_home`, `staff_phone_hp`, `staff_status_pajak`, `staff_status_nikah`, `staff_status_karyawan`, `staff_cabang`, `staff_departement`, `staff_jabatan`, `staff_photo`, `staff_birthdate`, `staff_birthplace`, `staff_sex`, `staff_password`) VALUES
(1, 6305280, '3101', 'Budi Setiawan', 'Jl. RE. Martadinata No. 15', 'budi@gmail.com', 'budi@gmail.com', '541000000', '082116914774', 'K1', 'Married', 'Tetap', 'Bandung', 'Transportation', 'Supervisor', '-', '1985-03-13', 'Bandung', '0', ''),
(2, 6305281, '3102', 'Puteri Berlianty', 'Komp. Margahayu Kencana Blok I 1 No. 19', 'jasmine@gmail.com', 'jasmine@gmail.com', '541000000', '08512121212', 'K2', 'Single', 'Tetap', 'Bandung', 'Accounting', 'Manager', '', '2011-03-21', 'Bandung', '0', ''),
(7, 9876, '3103', 'Kunyun', 'Pharmindo', 'kunyun@gmail.com', '', '1234567879', '12345678', 'TK', 'Single', 'Tetap', '1', 'Transportation', 'Staff', '', '2010-05-31', 'Bandung', 'Laki', 'd8578edf8458ce06fbc5bb76a58c5ca4');

-- --------------------------------------------------------

--
-- Table structure for table `sub_salaries`
--

CREATE TABLE IF NOT EXISTS `sub_salaries` (
  `sub_id` int(11) NOT NULL auto_increment,
  `salary_id` int(11) NOT NULL,
  `salary_periode` date NOT NULL,
  `salary_component_id` int(11) NOT NULL,
  `salary_daily_value` decimal(10,0) NOT NULL,
  `salary_amount_value` decimal(10,0) NOT NULL,
  PRIMARY KEY  (`sub_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `sub_salaries`
--

INSERT INTO `sub_salaries` (`sub_id`, `salary_id`, `salary_periode`, `salary_component_id`, `salary_daily_value`, `salary_amount_value`) VALUES
(1, 2, '2013-01-01', 2013, '9000', '1500000'),
(6, 2, '2010-01-01', 4, '0', '2350000');

-- --------------------------------------------------------

--
-- Table structure for table `taxes_employees`
--

CREATE TABLE IF NOT EXISTS `taxes_employees` (
  `sp_id` int(11) NOT NULL auto_increment,
  `sp_status` varchar(3) NOT NULL,
  `sp_ptkp` int(11) NOT NULL,
  `sp_note` varchar(255) NOT NULL,
  PRIMARY KEY  (`sp_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `taxes_employees`
--

INSERT INTO `taxes_employees` (`sp_id`, `sp_status`, `sp_ptkp`, `sp_note`) VALUES
(1, 'TK', 100000000, 'Test note'),
(2, 'K0', 1380000, ''),
(3, 'K1', 200, ''),
(4, 'K2', 300, ''),
(5, 'K3', 400, '');

-- --------------------------------------------------------

--
-- Table structure for table `titles`
--

CREATE TABLE IF NOT EXISTS `titles` (
  `title_id` int(11) NOT NULL auto_increment,
  `title_name` varchar(20) NOT NULL,
  PRIMARY KEY  (`title_id`)
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
  `id` int(11) NOT NULL auto_increment,
  `staff_id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `avatar` varchar(255) NOT NULL,
  `role_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `staff_id`, `username`, `password`, `avatar`, `role_id`, `created_at`, `updated_at`) VALUES
(1, 1, 'admin', 'd8578edf8458ce06fbc5bb76a58c5ca4', '-', 4, '2013-03-13 08:26:00', '2013-03-13 08:26:00'),
(2, 1, 'budi', 'd8578edf8458ce06fbc5bb76a58c5ca4', '', 6, '2013-03-19 08:57:32', '2013-03-19 08:57:32');

-- --------------------------------------------------------

--
-- Table structure for table `user_roled`
--

CREATE TABLE IF NOT EXISTS `user_roled` (
  `roled_id` int(11) NOT NULL auto_increment,
  `role_id` int(11) NOT NULL,
  `roled_module` varchar(20) NOT NULL,
  `roled_add` tinyint(1) NOT NULL,
  `roled_edit` tinyint(1) NOT NULL,
  `roled_delete` tinyint(1) NOT NULL,
  `roled_approval` tinyint(1) NOT NULL,
  `roled_select` tinyint(1) NOT NULL,
  PRIMARY KEY  (`roled_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=62 ;

--
-- Dumping data for table `user_roled`
--

INSERT INTO `user_roled` (`roled_id`, `role_id`, `roled_module`, `roled_add`, `roled_edit`, `roled_delete`, `roled_approval`, `roled_select`) VALUES
(1, 4, 'Branch', 1, 1, 1, 1, 1),
(2, 4, 'Departement', 1, 1, 1, 1, 1),
(3, 4, 'Tax_Employee', 1, 1, 1, 1, 1),
(4, 4, 'Employee_Status', 1, 1, 1, 1, 1),
(5, 4, 'Marital_Status', 1, 1, 1, 1, 1),
(6, 4, 'Title', 1, 1, 1, 1, 1),
(7, 4, 'Component', 1, 1, 1, 1, 1),
(8, 4, 'Salary', 1, 1, 1, 1, 1),
(9, 4, 'Staff', 1, 1, 1, 1, 1),
(10, 4, 'Assets', 1, 1, 1, 1, 1),
(11, 4, 'Users', 1, 1, 1, 1, 1),
(12, 4, 'Role_Details', 1, 1, 1, 1, 1),
(13, 4, 'Work_Histories', 1, 1, 1, 1, 1),
(14, 4, 'Families', 1, 1, 1, 1, 1),
(15, 4, 'Educations', 1, 1, 1, 1, 1),
(16, 4, 'Medical_Histories', 1, 1, 1, 1, 1),
(17, 4, 'Salary_Components', 1, 1, 1, 1, 1),
(18, 5, 'Branch', 1, 1, 1, 1, 1),
(19, 5, 'Departement', 1, 1, 1, 1, 1),
(20, 5, 'Tax_Employee', 1, 1, 1, 1, 1),
(21, 5, 'Employee_Status', 1, 1, 1, 1, 1),
(22, 5, 'Marital_Status', 1, 1, 1, 1, 1),
(23, 5, 'Title', 1, 1, 1, 1, 1),
(24, 5, 'Component', 1, 1, 1, 1, 1),
(25, 5, 'Salary', 1, 1, 1, 1, 1),
(26, 5, 'Staff', 1, 1, 1, 1, 1),
(27, 5, 'Assets', 1, 1, 1, 1, 1),
(28, 5, 'Users', 1, 1, 1, 1, 1),
(29, 5, 'Role_Details', 1, 1, 1, 1, 1),
(30, 5, 'Work_Histories', 1, 1, 1, 1, 1),
(31, 5, 'Families', 1, 1, 1, 1, 1),
(32, 5, 'Educations', 1, 1, 1, 1, 1),
(33, 5, 'Medical_Histories', 1, 1, 1, 1, 1),
(34, 5, 'Salary_Components', 1, 1, 1, 1, 1),
(35, 6, 'Branch', 0, 0, 0, 0, 1),
(36, 6, 'Departement', 0, 0, 0, 0, 1),
(37, 6, 'Tax_Employee', 0, 0, 0, 0, 1),
(38, 6, 'Employee_Status', 0, 0, 0, 0, 1),
(39, 6, 'Marital_Status', 0, 0, 0, 0, 1),
(40, 6, 'Title', 0, 0, 0, 0, 1),
(41, 6, 'Component', 0, 0, 0, 0, 1),
(42, 6, 'Staff', 0, 0, 0, 0, 1),
(43, 6, 'Assets', 0, 0, 0, 0, 1),
(44, 6, 'Work_Histories', 0, 0, 0, 0, 1),
(45, 6, 'Families', 0, 0, 0, 0, 1),
(46, 6, 'Educations', 0, 0, 0, 0, 1),
(47, 6, 'Medical_Histories', 0, 0, 0, 0, 1),
(48, 7, 'Branch', 0, 0, 0, 0, 1),
(49, 7, 'Departement', 0, 0, 0, 0, 1),
(50, 7, 'Tax_Employee', 0, 0, 0, 0, 1),
(51, 7, 'Employee_Status', 0, 0, 0, 0, 1),
(52, 7, 'Marital_Status', 0, 0, 0, 0, 1),
(53, 7, 'Title', 0, 0, 0, 0, 1),
(54, 7, 'Component', 0, 0, 0, 0, 1),
(55, 7, 'Salary', 0, 0, 0, 0, 1),
(56, 7, 'Staff', 0, 0, 0, 0, 1),
(57, 7, 'Assets', 0, 0, 0, 0, 1),
(58, 7, 'Work_Histories', 0, 0, 0, 0, 1),
(59, 7, 'Families', 0, 0, 0, 0, 1),
(60, 7, 'Educations', 0, 0, 0, 0, 1),
(61, 7, 'Medical_Histories', 0, 0, 0, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `user_roles`
--

CREATE TABLE IF NOT EXISTS `user_roles` (
  `role_id` int(11) NOT NULL auto_increment,
  `role_name` varchar(255) NOT NULL,
  PRIMARY KEY  (`role_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `user_roles`
--

INSERT INTO `user_roles` (`role_id`, `role_name`) VALUES
(4, 'Administrator'),
(5, 'Superuser'),
(6, 'Guest'),
(7, 'Staff');

-- --------------------------------------------------------

--
-- Table structure for table `work_histories`
--

CREATE TABLE IF NOT EXISTS `work_histories` (
  `history_id` int(11) NOT NULL auto_increment,
  `staff_id` int(11) NOT NULL,
  `history_date` date NOT NULL,
  `history_description` text NOT NULL,
  PRIMARY KEY  (`history_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=15 ;

--
-- Dumping data for table `work_histories`
--

INSERT INTO `work_histories` (`history_id`, `staff_id`, `history_date`, `history_description`) VALUES
(10, 2, '2013-09-09', 'Web Developer'),
(11, 1, '2000-03-21', 'EDP Bank BRI'),
(12, 1, '2010-03-21', 'General Manager PT. LEN'),
(13, 1, '2012-03-21', 'Manager Marketing Garuda Travel'),
(14, 3, '2013-04-03', 'IT Manager at PT.Waybe Home Appliance');
