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
-- Table structure for table `officials`
-- 

CREATE TABLE `officials` (
  `id_officials` bigint(20) NOT NULL,
  `waktu_upload_officials` datetime NOT NULL,
  `generasi_officials` bigint(20) NOT NULL,
  `tahun_kepengurusan_officials` tinytext collate latin1_general_ci NOT NULL,
  `image_officials` text collate latin1_general_ci NOT NULL,
  `isi_officials` longtext collate latin1_general_ci NOT NULL,
  PRIMARY KEY  (`id_officials`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- 
-- Dumping data for table `officials`
-- 

INSERT INTO `officials` VALUES (1, '2007-04-21 12:14:35', 1, ' - / 2006', '', 'Ketua&nbsp;&nbsp;  : Wawan<br />\r\nBendahara&nbsp;&nbsp;  : Emil');
INSERT INTO `officials` VALUES (2, '2007-04-21 12:29:22', 2, '2006 / 2007', 'CIMG0551.JPG', '<p>Pengurus Genshiken periode 2006/2007 :</p>\r\n<table width="100%" cellspacing="1" cellpadding="1" border="0" align="" summary="">\r\n    <tbody>\r\n        <tr>\r\n            <td><font size="2" face="Verdana">Dewan Penasihat :</font></td>\r\n        </tr>\r\n        <tr align="justify">\r\n            <td>\r\n            <ul>\r\n                <li><font size="2" face="Verdana">Estuda</font></li>\r\n                <li><font size="2" face="Verdana">Emil</font></li>\r\n                <li><font size="2" face="Verdana">Hendro</font></li>\r\n                <li><font size="2" face="Verdana">etc...</font></li>\r\n            </ul>\r\n            </td>\r\n        </tr>\r\n    </tbody>\r\n</table>\r\n<table width="100%" cellspacing="1" cellpadding="1" border="0" align="left" summary="">\r\n    <tbody>\r\n        <tr>\r\n            <td width="150"><font size="2" face="Verdana">Ketua</font></td>\r\n            <td><font size="2" face="Verdana">:</font></td>\r\n            <td><font size="2" face="Verdana">Diky Ramdhani</font></td>\r\n        </tr>\r\n        <tr>\r\n            <td width="150"><font size="2" face="Verdana">Sekretaris</font></td>\r\n            <td><font size="2" face="Verdana">:</font></td>\r\n            <td><font size="2" face="Verdana">Bayu Nur Baya</font></td>\r\n        </tr>\r\n        <tr>\r\n            <td width="150"><font size="2" face="Verdana">Bendahara</font></td>\r\n            <td><font size="2" face="Verdana">:</font></td>\r\n            <td><font size="2" face="Verdana">Benny Elian</font></td>\r\n        </tr>\r\n        <tr>\r\n            <td width="150"><font size="2" face="Verdana">ITokuB Club Leader</font></td>\r\n            <td><font size="2" face="Verdana">:</font></td>\r\n            <td><font size="2" face="Verdana">Muhammad Ikhsan Sani</font></td>\r\n        </tr>\r\n        <tr>\r\n            <td width="150"><font size="2" face="Verdana">Haro-Haro Club Leader<br />\r\n            </font></td>\r\n            <td><font size="2" face="Verdana">: <br />\r\n            </font></td>\r\n            <td><font size="2" face="Verdana">Hendro<br />\r\n            </font></td>\r\n        </tr>\r\n        <tr>\r\n            <td valign="top"><font size="2" face="Verdana">&nbsp;...etc</font></td>\r\n            <td valign="top">&nbsp;</td>\r\n            <td valign="top">&nbsp;</td>\r\n        </tr>\r\n        <tr>\r\n            <td valign="top">&nbsp;</td>\r\n            <td valign="top">&nbsp;</td>\r\n            <td valign="top">&nbsp;</td>\r\n        </tr>\r\n    </tbody>\r\n</table>');
