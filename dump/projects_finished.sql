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
-- Table structure for table `projects_finished`
-- 

CREATE TABLE `projects_finished` (
  `id_finished_projects` bigint(20) NOT NULL,
  `waktu_upload_finished_projects` datetime NOT NULL,
  `judul_finished_projects` tinytext collate latin1_general_ci NOT NULL,
  `image_finished_projects` text collate latin1_general_ci NOT NULL,
  `isi_finished_projects` longtext collate latin1_general_ci NOT NULL,
  PRIMARY KEY  (`id_finished_projects`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- 
-- Dumping data for table `projects_finished`
-- 

INSERT INTO `projects_finished` VALUES (1, '2007-03-31 10:10:38', 'Tsuyokiss', '', 'I dunno what kind of anime is this...haven''t watch it...oh well, whatever...');
