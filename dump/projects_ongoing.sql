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
-- Table structure for table `projects_ongoing`
-- 

CREATE TABLE `projects_ongoing` (
  `id_ongoing_projects` bigint(20) NOT NULL,
  `waktu_upload_ongoing_projects` datetime NOT NULL,
  `judul_ongoing_projects` tinytext collate latin1_general_ci NOT NULL,
  `image_ongoing_projects` text collate latin1_general_ci NOT NULL,
  `isi_ongoing_projects` longtext collate latin1_general_ci NOT NULL,
  PRIMARY KEY  (`id_ongoing_projects`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- 
-- Dumping data for table `projects_ongoing`
-- 

INSERT INTO `projects_ongoing` VALUES (1, '2007-03-31 08:46:36', 'Busou Renkin', '', 'I haven''t read this manga...');
