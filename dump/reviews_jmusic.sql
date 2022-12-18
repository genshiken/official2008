-- phpMyAdmin SQL Dump
-- version 2.9.1.1
-- http://www.phpmyadmin.net
-- 
-- Host: localhost
-- Generation Time: May 08, 2007 at 01:59 PM
-- Server version: 5.0.27
-- PHP Version: 5.2.0
-- 
-- Database: `official`
-- 

-- --------------------------------------------------------

-- 
-- Table structure for table `reviews_jmusic`
-- 

CREATE TABLE `reviews_jmusic` (
  `id_jmusicreviews` bigint(20) NOT NULL,
  `waktu_upload_jmusicreviews` datetime NOT NULL,
  `judul_jmusicreviews` tinytext collate latin1_general_ci NOT NULL,
  `artist_jmusicreviews` tinytext collate latin1_general_ci NOT NULL,
  `album_jmusicreviews` tinytext collate latin1_general_ci NOT NULL,
  `ost_jmusicreviews` tinytext collate latin1_general_ci NOT NULL,
  `isi_jmusicreviews` longtext collate latin1_general_ci NOT NULL,
  PRIMARY KEY  (`id_jmusicreviews`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- 
-- Dumping data for table `reviews_jmusic`
-- 

INSERT INTO `reviews_jmusic` VALUES (1, '2007-05-08 12:55:23', 'Yoru Wo Kakeru', 'Spitz', 'Mikazuki Rock', 'Honey & Clover Anime', 'Toga nai tsuyogari uso de nurikatameta heya<br />\r\nnukedeshite miageta yozora <br />\r\nyojireta kanaami wo itsumono youni tobikoete <br />\r\nkatai hodou wo kaketeyuku <br />\r\n<br />\r\nnigenai bokura wa hosoiito de tsunagatte iru <br />\r\nyoku aru akai yatsu janaku<br />\r\nochi atta basho wa ooki na kimo sawameki yande<br />\r\nfutari no kokyuu no oto dake ga shinmiteiku<br />\r\n<br />\r\nkimi to asobu daremo inai shigaichi<br />\r\nme to mega autabi warau <br />\r\nyoru wo kaketeiku ima wa utanaide<br />\r\ntooku no akari no hou eh kaketeiku <br />\r\n<br />\r\nkabe no rakugaki itsushika tomatta tokei ga<br />\r\neien no jiyuu wo ataeru<br />\r\nkorogatta senaka tsumetai KONKURIITO no kanji<br />\r\namakute nigai bero no saki mouichido<br />\r\n<br />\r\ndetarame ni egaita barairo no souzou zu<br />\r\nnishi ni inazuma hikaru<br />\r\nyoru wo kaketeiku ima wa utanaide <br />\r\nhorobi no sadame yabutte kaketeiku<br />\r\n<br />\r\nkimi to asobu daremo inai shigaichi<br />\r\nme to mega autabi warau<br />\r\nyoru wo kaketeiku ima wa utanaide<br />\r\ntooku no akari no hou eh kaketeiku');
INSERT INTO `reviews_jmusic` VALUES (2, '2007-05-08 12:57:15', 'Mahou No Kotoba', 'Spitz', 'Mahou No Kotoba', 'Honey & Clover Live Action', 'afure souna kimochi muri yari kakushite<br />\r\nkyou mo mata tooku bakkari mite ita<br />\r\nkimi to katariatta kudaranai ARE KORE<br />\r\ndakishimete dou ni ka ikiteru kedo<br />\r\n<br />\r\nmahou no KOTOBA futari dake ni wa wakaru<br />\r\nyume miru toka sonna hima mo nai koto goro<br />\r\nomoidashite okashikute ureshikute<br />\r\nmata aeru yo yakusoku shinakute mo<br />\r\n<br />\r\nnaoreru you ni nete naki nagara mezamete<br />\r\nhitogomi no naka de BOSO BOSO utau<br />\r\nkimi wa nani shiteru? egao ga mitai zo<br />\r\nfurikabutte wagamama sora ni nageta<br />\r\n<br />\r\nmahou no KOTOBA kuchi ni sureba mijikaku<br />\r\ndakedo kouka wa sugoi mono ga aru tte koto de<br />\r\ndaremo shiranai BARE te mo iroasenai<br />\r\nsono ato no SUTO-RI- wake aeru hi made<br />\r\n<br />\r\nhana wa utsukushiku TOGE mo utsukushiku<br />\r\nnekko mo utsukushii hazusa<br />\r\n<br />\r\nmahou no KOTOBA futari dake ni wa wakaru<br />\r\nyume miru toka sonna hima nai kono goro<br />\r\nomoidashite okashikute ureshikute<br />\r\nmata aeru yo yakusoku shinakute mo<br />\r\naeru yo aeru yo..');
INSERT INTO `reviews_jmusic` VALUES (3, '2007-05-08 12:58:03', 'Sakana', 'Spitz', 'Iroiro Goromo & Super Best', 'Honey & Clover Anime', 'kazarazu ni kimi no subete to mazariaesou sa ima sara ne<br />\r\nkoibito to yoberu jikan wo hoshisuna hitotsu ni tojikometa<br />\r\n<br />\r\nkotoba ja naku RIZUMU wa tsuzuku<br />\r\nfutari ga mada deau mae kara no<br />\r\n<br />\r\nkurikaesu nami no koe tsumetai hi to samayou<br />\r\nfurueru kata wo daite doko ni mo modoranai<br />\r\n<br />\r\n&quot;kitto mada owaranai yo&quot; to sakana ni narenai sakana toka<br />\r\nikutsumo no tsukuribanashi de kokoro no ichibu wo uruoshite<br />\r\n<br />\r\nkono umi wa bokura no umi sa<br />\r\nkakusareta sekai to tsunagu<br />\r\n<br />\r\nnamariiro ni kagayaku<br />\r\nkono umi wa...<br />\r\nkakusareta...<br />\r\nkotoba ja naku...<br />\r\nfutari ga mada deau mae kara no<br />\r\nKONKURIITO ni shimikomu tsumetai hi to samayou<br />\r\nfurueru kata wo daite doko ni mo modoranai');
INSERT INTO `reviews_jmusic` VALUES (4, '2007-05-08 12:58:31', 'Y', 'Spitz', 'Hachimitsu', 'Honey & Clover Anime', 'Chiisana koe de <br />\r\nBoku wo yobu yami e to <br />\r\nTe wo nobasu<br />\r\nShizuka de <br />\r\nNagai yoru<br />\r\nNarasarete ita <br />\r\nOki zari no toki kara<br />\r\nHai agari mujaki ni <br />\r\nHohonda <br />\r\n<br />\r\nKimi ni au mou ichido<br />\r\n<br />\r\nTsuyogaru POOZU ga <br />\r\nYoku niteta futari wa<br />\r\nHajiki ai <br />\r\nSono ato <br />\r\nHiki atta<br />\r\nUmareta koro to <br />\r\nKawaranai kokoro de<br />\r\nSawattara <br />\r\nSubete ga <br />\r\nKiesou na <br />\r\n<br />\r\nKimi wo mitsumete ita<br />\r\n<br />\r\nYagate kimi wa tori ni naru <br />\r\nBOROBORO no yakusoku <br />\r\nMune ni idaite<br />\r\n<br />\r\nKanashii koto mo aru <br />\r\nDakedo yume wa tsudzuku <br />\r\nMe wo fusenaide<br />\r\n<br />\r\nMai oriru yoake made<br />\r\n<br />\r\nYagate kimi wa tori ni naru <br />\r\nBOROBORO no yakusoku <br />\r\nMune ni idaite<br />\r\n<br />\r\nKaze ni yureru mugi <br />\r\nYasashii hi no omoide <br />\r\nKamishimenagara<br />\r\n<br />\r\nTsukihagi no MIRAAJU <br />\r\nTaisetsu na yakusoku <br />\r\nMune ni idaite<br />\r\n<br />\r\nKanashii koto mo aru <br />\r\nDakedo yume wa tsudzuku <br />\r\nMe wo fusenaide<br />\r\n<br />\r\nMai oriru yoake made');
