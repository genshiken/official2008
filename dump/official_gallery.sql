-- phpMyAdmin SQL Dump
-- version 2.9.1.1
-- http://www.phpmyadmin.net
-- 
-- Host: localhost
-- Generation Time: May 05, 2007 at 10:39 AM
-- Server version: 5.0.27
-- PHP Version: 5.2.0
-- 
-- Database: `official`
-- 

-- --------------------------------------------------------

-- 
-- Table structure for table `official_gallery`
-- 

CREATE TABLE `official_gallery` (
  `id_official_gallery` bigint(20) NOT NULL,
  `waktu_upload_official_gallery` datetime NOT NULL,
  `judul_official_gallery` tinytext collate latin1_general_ci NOT NULL,
  `image_official_gallery` text collate latin1_general_ci NOT NULL,
  `isi_official_gallery` longtext collate latin1_general_ci NOT NULL,
  PRIMARY KEY  (`id_official_gallery`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- 
-- Dumping data for table `official_gallery`
-- 

INSERT INTO `official_gallery` VALUES (2, '2007-05-03 07:33:11', 'Shitteiru?', 'CIMG1851.JPG', 'badge');
INSERT INTO `official_gallery` VALUES (1, '2007-05-02 21:12:05', 'Shitteiru?', 'CIMG1849.JPG', 'In the next day, Noboru is in conference with a teacher. The teacher confirms that Noboru wants to go to only Jouhoku highschool');
INSERT INTO `official_gallery` VALUES (3, '2007-05-03 09:40:30', 'Shitteiru?', 'CIMG1852.JPG', 'Member of Genshiken ITB, blah blah blah blah blah blah blah blah blah blah blah blah blah blah blah blah blah blah blah blah blah blah blah blah blah blah blah blah blah blah blah blah blah blah blah blah blah blah blah blah blah blah blah blah blah blah blah blah blah blah blah blah blah blah blah blah blah blah blah blah blah blah blah blah blah blah blah blah blah blah blah blah blah blah blah blah blah blah blah blah blah blah blah blah blah blah blah blah blah blah blah blah blah blah blah blah blah blah blah blah blah blah blah blah blah blah blah blah blah blah blah blah blah blah blah blah blah blah blah blah blah blah blah blah blah blah blah blah blah blah blah blah blah blah blah blah blah blah blah blah blah blah blah blah blah blah blah blah blah blah blah blah blah blah blah blah blah blah blah blah blah blah blah blah blah blah blah blah blah blah blah blah blah blah blah blah blah blah blah blah blah blah blah blah blah blah blah blah blah blah blah blah blah blah blah blah blah blah blah blah blah blah blah blah blah blah blah blah blah blah blah blah blah blah blah blah blah blah blah blah blah blah blah blah blah blah blah blah blah blah blah blah blah blah blah blah blah');
INSERT INTO `official_gallery` VALUES (4, '2007-05-03 19:06:53', 'Shitteiru?', 'CIMG1853.JPG', '<p>Full Member of Genshiken ITB</p>');
