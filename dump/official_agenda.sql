-- phpMyAdmin SQL Dump
-- version 2.9.1.1
-- http://www.phpmyadmin.net
-- 
-- Host: localhost
-- Generation Time: May 08, 2007 at 12:09 PM
-- Server version: 5.0.27
-- PHP Version: 5.2.0
-- 
-- Database: `official`
-- 

-- --------------------------------------------------------

-- 
-- Table structure for table `official_agenda`
-- 

CREATE TABLE `official_agenda` (
  `id_official_agenda` bigint(20) NOT NULL,
  `waktu_upload_official_agenda` datetime NOT NULL,
  `judul_official_agenda` tinytext collate latin1_general_ci NOT NULL,
  `isi_official_agenda` longtext collate latin1_general_ci NOT NULL,
  PRIMARY KEY  (`id_official_agenda`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- 
-- Dumping data for table `official_agenda`
-- 

INSERT INTO `official_agenda` VALUES (1, '2007-05-07 21:26:30', 'Persiapan Pergantian Kepengurusan', 'ayo...kudeta-kan kami! pengen tenang nih...dengan hikikomori <img src="/genshiken/FCKeditor/editor/images/smiley/msn/cry_smile.gif" alt="" />');
