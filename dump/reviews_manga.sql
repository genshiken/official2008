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
-- Table structure for table `reviews_manga`
-- 

CREATE TABLE `reviews_manga` (
  `id_mangareviews` bigint(20) NOT NULL,
  `waktu_upload_mangareviews` datetime NOT NULL,
  `judul_mangareviews` tinytext collate latin1_general_ci NOT NULL,
  `image_mangareviews` text collate latin1_general_ci NOT NULL,
  `isi_mangareviews` longtext collate latin1_general_ci NOT NULL,
  PRIMARY KEY  (`id_mangareviews`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- 
-- Dumping data for table `reviews_manga`
-- 

INSERT INTO `reviews_manga` VALUES (1, '2007-05-05 09:16:13', 'Busou Renkin', '', 'uhh..oh..haven''t read it yet <img src="/genshiken/FCKeditor/editor/images/smiley/msn/cry_smile.gif" alt="" />');
