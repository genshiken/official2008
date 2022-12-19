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
-- Table structure for table `reviews_tokusatsu`
-- 

CREATE TABLE `reviews_tokusatsu` (
  `id_tokusatsureviews` bigint(20) NOT NULL,
  `waktu_upload_tokusatsureviews` datetime NOT NULL,
  `judul_tokusatsureviews` tinytext collate latin1_general_ci NOT NULL,
  `image_tokusatsureviews` text collate latin1_general_ci NOT NULL,
  `isi_tokusatsureviews` longtext collate latin1_general_ci NOT NULL,
  PRIMARY KEY  (`id_tokusatsureviews`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- 
-- Dumping data for table `reviews_tokusatsu`
-- 

INSERT INTO `reviews_tokusatsu` VALUES (1, '2007-05-05 09:25:33', 'The First', '', 'e~to...nani kore?');
