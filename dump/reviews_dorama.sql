-- phpMyAdmin SQL Dump
-- version 2.9.1.1
-- http://www.phpmyadmin.net
-- 
-- Host: localhost
-- Generation Time: May 05, 2007 at 10:41 AM
-- Server version: 5.0.27
-- PHP Version: 5.2.0
-- 
-- Database: `official`
-- 

-- --------------------------------------------------------

-- 
-- Table structure for table `reviews_dorama`
-- 

CREATE TABLE `reviews_dorama` (
  `id_doramareviews` bigint(20) NOT NULL,
  `waktu_upload_doramareviews` datetime NOT NULL,
  `judul_doramareviews` tinytext collate latin1_general_ci NOT NULL,
  `image_doramareviews` text collate latin1_general_ci NOT NULL,
  `isi_doramareviews` longtext collate latin1_general_ci NOT NULL,
  PRIMARY KEY  (`id_doramareviews`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- 
-- Dumping data for table `reviews_dorama`
-- 

INSERT INTO `reviews_dorama` VALUES (1, '2007-05-05 09:34:07', 'My Boss My Hero', '', 'stupid son of a yakuza leader who tends for better life <em>de gozaru <img src="/genshiken/FCKeditor/editor/images/smiley/msn/regular_smile.gif" alt="" /></em>');
