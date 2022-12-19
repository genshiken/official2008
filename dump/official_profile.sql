-- phpMyAdmin SQL Dump
-- version 2.9.1.1
-- http://www.phpmyadmin.net
-- 
-- Host: localhost
-- Generation Time: May 05, 2007 at 10:40 AM
-- Server version: 5.0.27
-- PHP Version: 5.2.0
-- 
-- Database: `official`
-- 

-- --------------------------------------------------------

-- 
-- Table structure for table `official_profile`
-- 

CREATE TABLE `official_profile` (
  `id_official_profile` bigint(20) NOT NULL,
  `waktu_upload_official_profile` datetime NOT NULL,
  `isi_official_profile` longtext collate latin1_general_ci NOT NULL,
  PRIMARY KEY  (`id_official_profile`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- 
-- Dumping data for table `official_profile`
-- 

INSERT INTO `official_profile` VALUES (1, '2007-05-05 07:56:10', '<p><font size="2" face="Verdana">Genshiken Profile : what is genshiken?</font></p>\r\n<ul>\r\n    <li><font size="2" face="Verdana">Modern Visual Culture?</font></li>\r\n    <li><font size="2" face="Verdana">Vision?</font></li>\r\n    <li><font size="2" face="Verdana">Future Plans?</font></li>\r\n    <li><font size="2" face="Verdana">Activities?</font></li>\r\n    <li><font size="2" face="Verdana">ITokuB?</font></li>\r\n    <li><font size="2" face="Verdana">Haro! Haro! ?</font></li>\r\n    <li><font size="2" face="Verdana">etc...more...more...more</font></li>\r\n</ul>');
