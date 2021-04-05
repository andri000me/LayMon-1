-- --------------------------------------------------------
-- Database LayMon
-- Version 1.0
-- --------------------------------------------------------
-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3373
-- Server version: 10.4.17-MariaDB
-- PHP Version: 7.3.25
-- --------------------------------------------------------

--
-- Table structure for table `ci_sessions`
--
DROP TABLE IF EXISTS `ci_sessions`;
CREATE TABLE IF NOT EXISTS `ci_sessions` (
	`id` varchar(128) NOT NULL,
	`ip_address` varchar(45) NOT NULL,
	`timestamp` int(10) unsigned DEFAULT 0 NOT NULL,
	`data` blob NOT NULL,
	KEY `ci_sessions_timestamp` (`timestamp`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Table structure for table `tb_user`
--
DROP TABLE IF EXISTS `tb_user`;
CREATE TABLE `tb_user` (
  `id_user` bigint(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `username_user` varchar(20) NOT NULL,
  `password_user` varchar(60) NOT NULL,
  `level_user` ENUM('Admin','Supir','Pelanggan') NOT NULL DEFAULT 'Pelanggan',
  `tglbuat_user` datetime NOT NULL DEFAULT NOW()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `tb_user` (`id_user`,`username_user`, `password_user`, `level_user`, `tglbuat_user`) VALUES
(1,'denny', '$2y$10$KP0GKFO6R8Qdman9..HfmevKUvIpYosQZejuJ1eVwFL.VrBzbZCnK', 'Admin', NOW()),
(2,'dadang', '$2y$10$RgLFDkqre3RyQp/omp3szev2rpnLcf8BeaWd30HdLfghDmTQFqFuO', 'Supir', NOW()),
(3,'zarshop', '$2y$10$kbOleNVtOH9zv3Z0ufpuT.dNTnqagboyIB/VW8Ue6Dv.3qaVtZpYq', 'Pelanggan', NOW()),
(4,'dodong', '$2y$10$wODYfaXb08Oj4exoN8/bCeM86K0fi105VWJawU/tUGYweBhSlw4kO', 'Supir', NOW()),
(5,'zorshap', '$2y$10$kacJj5mQ8yugG75OwSu2k.buF5wRYCZzcHkNYUzgVFbaFmayrpnD6', 'Pelanggan', NOW());

--
-- Table structure for table `tb_supir`
--
DROP TABLE IF EXISTS `tb_supir`;
CREATE TABLE `tb_supir` (
  `id_supir` bigint(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `id_user` bigint(11) NOT NULL DEFAULT 0,
  `nama_supir` varchar(70) NOT NULL,
  `nohp_supir` varchar(13) NOT NULL,
  `alamat_supir` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `tb_supir` (`id_supir`,`id_user`, `nama_supir`, `nohp_supir`, `alamat_supir`) VALUES
(1,2, 'Dadang Kipas', '087845621321', 'Jln. Flamboyan Nusa No 15'),
(2,4, 'Dodong Karim', '085445621321', 'Jln. Kencana Mas No 14');

--
-- Table structure for table `tb_pelanggan`
--
DROP TABLE IF EXISTS `tb_pelanggan`;
CREATE TABLE `tb_pelanggan` (
  `id_pelanggan` bigint(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `id_user` bigint(11) NOT NULL DEFAULT 0,
  `nama_pelanggan` varchar(70) NOT NULL,
  `nohp_pelanggan` varchar(13) NOT NULL,
  `alamat_pelanggan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `tb_pelanggan` (`id_pelanggan`,`id_user`, `nama_pelanggan`, `nohp_pelanggan`, `alamat_pelanggan`) VALUES
(1,3, 'PT. Zaruko Store', '085241821321', 'Jln. Merdeka Barat No 12'),
(2,5, 'PT. Zoruka Sharp', '081241821321', 'Jln. Merdeka Timur No 13');

--
-- Table structure for table `tb_mobil`
--
DROP TABLE IF EXISTS `tb_mobil`;
CREATE TABLE `tb_mobil` (
  `id_mobil` bigint(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `nopol_mobil` varchar(10) NOT NULL,
  `merk_mobil` varchar(70) NOT NULL,
  `kapasitas_mobil` ENUM('Besar','Sedang','Kecil') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `tb_mobil` (`id_mobil`,`nopol_mobil`, `merk_mobil`, `kapasitas_mobil`) VALUES
(1,'B 7895 SH', 'Mitsubishi', 'Besar'),
(2,'A 5925 OS', 'Mercedes Benz', 'Sedang'),
(3,'A 5735 VE', 'Isuzu', 'Kecil');

--
-- Table structure for table `tb_monitoring`
--
DROP TABLE IF EXISTS `tb_monitoring`;
CREATE TABLE `tb_monitoring` (
  `id_mon` bigint(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `kodejalan_mon` varchar(13) NOT NULL,
  `id_mobil` bigint(11) NOT NULL DEFAULT 0,
  `id_supir` bigint(11) NOT NULL DEFAULT 0,
  `id_pelanggan` bigint(11) NOT NULL DEFAULT 0,
  `start_mon` varchar(50) NOT NULL,
  `end_mon` varchar(50) NOT NULL,
  `status_mon` ENUM('Created','Approved','Progress','Arrived','Confirmed','Completed') NOT NULL,
  `tglbuat_user` datetime NOT NULL DEFAULT NOW()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `tb_monitoring` (`id_mon`,`kodejalan_mon`, `id_mobil`, `id_supir`, `id_pelanggan`, `start_mon`, `end_mon`, `status_mon`, `tglbuat_user`) VALUES
(1,'SJ00001/01/21', 1, 1, 2, '-6.2814669004211225,106.53495758217373', '-6.395774453370429,106.8506481888934', 'Completed', NOW()),
(2,'SJ00001/02/21', 2, 2, 1, '-6.2814669004211225,106.53495758217373', '-6.174889937373512,106.82197098544648', 'Confirmed', NOW()),
(3,'SJ00001/03/21', 3, 1, 2, '-6.2814669004211225,106.53495758217373', '-6.395774453370429,106.8506481888934', 'Arrived', NOW()),
(4,'SJ00002/03/21', 1, 2, 2, '-6.2814669004211225,106.53495758217373', '-6.395774453370429,106.8506481888934', 'Progress', NOW()),
(5,'SJ00003/03/21', 2, 1, 1, '-6.2814669004211225,106.53495758217373', '-6.174889937373512,106.82197098544648', 'Approved', NOW()),
(6,'SJ00004/03/21', 3, 2, 2, '-6.2814669004211225,106.53495758217373', '-6.395774453370429,106.8506481888934', 'Created', NOW()),
(7,'SJ00005/03/21', 1, 1, 1, '-6.2814669004211225,106.53495758217373', '-6.174889937373512,106.82197098544648', 'Created', NOW());

--
-- Table structure for table `tb_timeline`
--
DROP TABLE IF EXISTS `tb_timeline`;
CREATE TABLE `tb_timeline` (
  `id_timeline` bigint(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `id_mon` bigint(11) NOT NULL,
  `currentloc_timeline` varchar(50) NOT NULL,
  `tglcrloc_timeline` datetime NOT NULL DEFAULT NOW()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

ALTER TABLE `ci_sessions` ADD PRIMARY KEY (`id`, `ip_address`);
ALTER TABLE `tb_user` ADD UNIQUE (`username_user`),ADD INDEX(`level_user`);
ALTER TABLE `tb_supir` ADD UNIQUE (`id_user`),ADD UNIQUE (`nohp_supir`);
ALTER TABLE `tb_pelanggan` ADD UNIQUE (`id_user`),ADD UNIQUE (`nohp_pelanggan`);
ALTER TABLE `tb_mobil` ADD UNIQUE (`nopol_mobil`),ADD INDEX(`kapasitas_mobil`);
ALTER TABLE `tb_monitoring` ADD UNIQUE (`kodejalan_mon`),ADD INDEX(`id_supir`),ADD INDEX(`id_pelanggan`),ADD INDEX(`id_mobil`),ADD INDEX(`status_mon`),ADD INDEX(`tglbuat_user`);
ALTER TABLE `tb_timeline` ADD INDEX(`id_mon`),ADD INDEX(`currentloc_timeline`),ADD INDEX(`tglcrloc_timeline`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tb_monitoring`
--
ALTER TABLE `tb_monitoring`
  ADD CONSTRAINT `tb_monitoring_ibfk_1` FOREIGN KEY (`id_pelanggan`) REFERENCES `tb_pelanggan` (`id_pelanggan`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tb_monitoring_ibfk_2` FOREIGN KEY (`id_supir`) REFERENCES `tb_supir` (`id_supir`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tb_monitoring_ibfk_3` FOREIGN KEY (`id_mobil`) REFERENCES `tb_mobil` (`id_mobil`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tb_pelanggan`
--
ALTER TABLE `tb_pelanggan`
  ADD CONSTRAINT `tb_pelanggan_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `tb_user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tb_supir`
--
ALTER TABLE `tb_supir`
  ADD CONSTRAINT `tb_supir_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `tb_user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tb_timeline`
--
ALTER TABLE `tb_timeline`
  ADD CONSTRAINT `tb_timeline_ibfk_1` FOREIGN KEY (`id_mon`) REFERENCES `tb_monitoring` (`id_mon`) ON DELETE CASCADE ON UPDATE CASCADE;