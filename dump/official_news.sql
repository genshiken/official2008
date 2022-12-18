-- phpMyAdmin SQL Dump
-- version 2.9.1.1
-- http://www.phpmyadmin.net
-- 
-- Host: localhost
-- Generation Time: May 14, 2007 at 07:44 PM
-- Server version: 5.0.27
-- PHP Version: 5.2.0
-- 
-- Database: `official`
-- 

-- --------------------------------------------------------

-- 
-- Table structure for table `official_news`
-- 

CREATE TABLE `official_news` (
  `id_official_news` bigint(20) NOT NULL,
  `waktu_upload_official_news` datetime NOT NULL,
  `image_official_news` text collate latin1_general_ci NOT NULL,
  `judul_official_news` tinytext collate latin1_general_ci NOT NULL,
  `isi_official_news` longtext collate latin1_general_ci NOT NULL,
  PRIMARY KEY  (`id_official_news`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- 
-- Dumping data for table `official_news`
-- 

INSERT INTO `official_news` VALUES (1, '2007-05-05 07:14:11', 'Mac Osaka.jpg', 'Ji-U : Visual Modern Goes To Campus', '<p>Ji-U : Visual Modern Goes To Campus (Right! Genshiken is now ON AIR!)<br />\r\nJi-U is a collaboration between Genshiken and RadioKampus. Through this program, we are now available on air every Tuesday from 3.00 pm ''till 5.00 pm. If you''re available at the time, you may listen to us through radio broadcast at KBL or via streaming at radiokampus.ee.itb.ac.is/streaming<br />\r\n</p>');
