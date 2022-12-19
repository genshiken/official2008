-- phpMyAdmin SQL Dump
-- version 2.9.1.1
-- http://www.phpmyadmin.net
-- 
-- Host: localhost
-- Generation Time: May 08, 2007 at 11:34 AM
-- Server version: 5.0.27
-- PHP Version: 5.2.0
-- 
-- Database: `official`
-- 

-- --------------------------------------------------------

-- 
-- Table structure for table `reviews_anime`
-- 

CREATE TABLE `reviews_anime` (
  `id_animereviews` bigint(20) NOT NULL,
  `waktu_upload_animereviews` datetime NOT NULL,
  `judul_animereviews` tinytext collate latin1_general_ci NOT NULL,
  `image_animereviews` text collate latin1_general_ci NOT NULL,
  `isi_animereviews` longtext collate latin1_general_ci NOT NULL,
  PRIMARY KEY  (`id_animereviews`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- 
-- Dumping data for table `reviews_anime`
-- 

INSERT INTO `reviews_anime` VALUES (1, '2007-03-30 22:07:24', 'judul 1', '', 'isi 1');
INSERT INTO `reviews_anime` VALUES (2, '2007-03-30 22:07:45', 'judul 2', '', 'isi 2');
INSERT INTO `reviews_anime` VALUES (3, '2007-03-30 22:08:04', 'judul 3', '', 'isi 3');
INSERT INTO `reviews_anime` VALUES (4, '2007-03-30 22:09:25', 'judul 4', '', 'isi 4');
INSERT INTO `reviews_anime` VALUES (5, '2007-03-30 22:09:54', 'judul 5', '001 - Hoshi no Koe.jpg', 'isi 5');
INSERT INTO `reviews_anime` VALUES (7, '2007-03-31 08:20:54', 'judul 7', '', 'isi 7');
INSERT INTO `reviews_anime` VALUES (8, '2007-03-31 08:21:19', 'judul 8', '', 'isi 8');
INSERT INTO `reviews_anime` VALUES (9, '2007-03-31 08:22:10', 'judul 9', '', 'isi 9');
INSERT INTO `reviews_anime` VALUES (10, '2007-03-31 08:22:24', 'judul 10', '', 'isi 10');
INSERT INTO `reviews_anime` VALUES (11, '2007-03-31 08:22:41', 'judul 11', '', 'isi 11');
INSERT INTO `reviews_anime` VALUES (12, '2007-03-31 08:24:00', 'judul 12', '', 'isi 12');
INSERT INTO `reviews_anime` VALUES (13, '2007-03-31 08:24:14', 'judul 13', '', 'isi 13');
INSERT INTO `reviews_anime` VALUES (14, '2007-03-31 08:24:28', 'judul 14', '', 'isi 14');
INSERT INTO `reviews_anime` VALUES (15, '2007-03-31 08:24:43', 'judul 15', '', 'isi 15');
INSERT INTO `reviews_anime` VALUES (16, '2007-03-31 08:24:56', 'judul 16', '', 'isi 16');
INSERT INTO `reviews_anime` VALUES (18, '2007-03-31 08:52:12', 'judul 18', 'Archer 004.JPG', 'isi 18');
INSERT INTO `reviews_anime` VALUES (19, '2007-03-31 08:52:26', 'Kumo no Mukou, Yakusoku no Basho (Beyond The Clouds, The Place Promised In Our Early Days)', '002 - Kumo no Mukou, Yakusoku no Basho.jpg', 'this anime is so inspiring...!!!');
INSERT INTO `reviews_anime` VALUES (20, '2007-03-31 08:52:42', 'Byousoku 5cm (Speed of 5cm per Second)', 'Byousoku.png', 'It''s about Takaki & Akari, a childhood friends...perhaps more than friends...');
INSERT INTO `reviews_anime` VALUES (21, '2007-03-31 08:52:55', 'Hoshi no Koe (Voices of A Distant Star)', '001 - Hoshi no Koe.jpg', '2064 on the Earth, Noboru is reading a textbook for highschool''s entrance exam. He gets a e-mail from Mikako by a cellular phone. She says she is on Mars now. She saw many natural environments and Tarsian''s ruins on Mars.<br>\r\n<br>\r\nNoboru talks with his classmates. Next day, there is a conference with a teacher to talk about a plan after junior high. Noboru''s classmate says that he hates the conference and he is envious of Mikako''s position, a pilot of Tracer. Noboru keeps silence because he knows Mikako''s task is so hard, but, on the other hand, he feels his life is bound. Noboru is a little envious of Mikako too at the back of mind.<br>\r\n<br>\r\nOn his way home, he sees a small space ship. He reminds he saw a space ship Lysithea together with Mikako when she was on the Earth yet.<br>\r\n<br>\r\nIn a rainy day, Mikako and Noboru hide from the rain at a bus stop. They chat about Tarsian, draw a wired sketch of Tarsian by joke, and laugh. The rain stops, and they see a formation of Tracers is flying away. Mikako says: "I am going to onboard that."<br>\r\n<br>\r\nIn the next day, Noboru is in conference with a teacher. The teacher confirms that Noboru wants to go to only Jouhoku highschool and don''t take entrance exams to safety schools. Next, they talk about Mikako for a while. The teacher says that he doesn''t know well but Mikako was selected as a member of UN Space Force many years before. Many other members join UNSF more early, as soon as they can, but she has kept to go to school up to the limit. Noboru remembers that all students who belong to his generation had gone through a test when he was an infant. The teacher says Mikako might be selected to the member from that.<br>\r\n<br>\r\nNoboru sends a e-mail to Mikako. He reports about the snow which falls recently, his mundane daily life, and "Go to the same highschool with me, do you?" While that, Mikako is in air combat training as a pilot. She maneuvers a Tracer, shoots missiles, and destroy a target. After the training, Mikako read the e-mail from Noboru. And, she replies: "Yes..."<br>\r\n<br>\r\nHowever, In the spring of the next year, Noboru becomes a highschool student alone.\r\n');
INSERT INTO `reviews_anime` VALUES (22, '2007-04-16 23:08:16', 'Kannazuki no Miko', 'Kannazuki no Miko 007.jpg', '<strong>Kannazuki </strong><em>no </em><u>Miko<br />\r\n</u>A story about....');
INSERT INTO `reviews_anime` VALUES (23, '2007-05-04 22:27:46', 'Azumanga Daioh', 'Azumanga Daioh01038.jpg', 'Azumanga Daioh is a fake anime with good plot and storyline...The characters are Tomo, Osaka (ups...Kasuga <em>desu~</em>), Sakaki, Chiyo, Yumi, Kagura');
INSERT INTO `reviews_anime` VALUES (24, '2007-05-08 10:17:46', '5 cm', '', 'reverse of 5 cm');
