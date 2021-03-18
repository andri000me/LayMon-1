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
-- Table structure for table `user`
--
DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `id_user` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `username_user` varchar(20) NOT NULL,
  `password_user` varchar(73) NOT NULL,
  `tglbuat_user` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `user` (`id_user`,`username_user`, `password_user`, `tglbuat_user`) VALUES
(1,'denny', '$2y$10$WNEjLV3zNWY1j/kQaoBcYeQq2C9I7wsd96q2IPpwQqhsNUXR7VAle', NOW());

--
-- Indexes for dumped tables
--

ALTER TABLE `ci_sessions` ADD PRIMARY KEY (`id`, `ip_address`);
ALTER TABLE `user` ADD UNIQUE (`username_user`);