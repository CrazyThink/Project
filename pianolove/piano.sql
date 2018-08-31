-- MySQL dump 10.13  Distrib 5.1.41, for Win32 (ia32)
--
-- Host: localhost    Database: kdhong_db
-- ------------------------------------------------------
-- Server version	5.1.41-community

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `album`
--

DROP TABLE IF EXISTS `album`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `album` (
  `num` int(11) NOT NULL AUTO_INCREMENT,
  `id` char(15) NOT NULL,
  `name` char(10) NOT NULL,
  `nick` char(10) NOT NULL,
  `subject` char(100) NOT NULL,
  `content` text NOT NULL,
  `regist_day` char(20) DEFAULT NULL,
  `hit` int(11) DEFAULT NULL,
  `is_html` char(1) DEFAULT NULL,
  `file_name_0` char(40) DEFAULT NULL,
  `file_name_1` char(40) DEFAULT NULL,
  `file_name_2` char(40) DEFAULT NULL,
  `file_name_3` char(40) DEFAULT NULL,
  `file_name_4` char(40) DEFAULT NULL,
  `file_copied_0` char(30) DEFAULT NULL,
  `file_copied_1` char(30) DEFAULT NULL,
  `file_copied_2` char(30) DEFAULT NULL,
  `file_copied_3` char(30) DEFAULT NULL,
  `file_copied_4` char(30) DEFAULT NULL,
  PRIMARY KEY (`num`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `album`
--

LOCK TABLES `album` WRITE;
/*!40000 ALTER TABLE `album` DISABLE KEYS */;
INSERT INTO `album` VALUES (1,'admin','ê´€ë¦¬ìž','ê´€ë¦¬ìž','ë°•íš¨ì‹  - ëˆˆì˜ ê½ƒ','ê·¸ë ‡ìŠµë‹ˆë‹¤','2017-06-09 (18:37)',4,'','ì œëª© ì—†ìŒ.jpg','','',NULL,NULL,'2017_06_09_18_37_26_0.jpg','','',NULL,NULL),(2,'admin','ê´€ë¦¬ìž','ê´€ë¦¬ìž','ë‚ ì§€ ëª»í•˜ëŠ” ë¹„í–‰ê¸° (ì‹¬íƒœìœ¤ íŽ¸ê³¡)','ã…‡ã…‹','2017-06-09 (18:39)',6,'','ì œëª© ì—†ìŒ.jpg','','',NULL,NULL,'2017_06_09_18_39_46_0.jpg','','',NULL,NULL),(3,'dae','ëŒ€ì™•','ëŒ€ì™•','kakaotalk-JayM','kakaotalk-JayM','2017-06-09 (19:35)',6,'','kakaotalk_JayM_.pdf','','',NULL,NULL,'2017_06_09_19_35_06_0.pdf','','',NULL,NULL);
/*!40000 ALTER TABLE `album` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `album_ripple`
--

DROP TABLE IF EXISTS `album_ripple`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `album_ripple` (
  `num` int(11) NOT NULL AUTO_INCREMENT,
  `parent` int(11) NOT NULL,
  `id` char(15) NOT NULL,
  `name` char(10) NOT NULL,
  `nick` char(10) NOT NULL,
  `content` text NOT NULL,
  `regist_day` char(20) DEFAULT NULL,
  PRIMARY KEY (`num`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `album_ripple`
--

LOCK TABLES `album_ripple` WRITE;
/*!40000 ALTER TABLE `album_ripple` DISABLE KEYS */;
/*!40000 ALTER TABLE `album_ripple` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `faq`
--

DROP TABLE IF EXISTS `faq`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `faq` (
  `num` int(11) NOT NULL AUTO_INCREMENT,
  `id` char(15) NOT NULL,
  `name` char(10) NOT NULL,
  `nick` char(10) NOT NULL,
  `subject` char(100) NOT NULL,
  `content` text NOT NULL,
  `regist_day` char(20) DEFAULT NULL,
  `hit` int(11) DEFAULT NULL,
  `is_html` char(1) DEFAULT NULL,
  `file_name_0` char(40) DEFAULT NULL,
  `file_name_1` char(40) DEFAULT NULL,
  `file_name_2` char(40) DEFAULT NULL,
  `file_name_3` char(40) DEFAULT NULL,
  `file_name_4` char(40) DEFAULT NULL,
  `file_copied_0` char(30) DEFAULT NULL,
  `file_copied_1` char(30) DEFAULT NULL,
  `file_copied_2` char(30) DEFAULT NULL,
  `file_copied_3` char(30) DEFAULT NULL,
  `file_copied_4` char(30) DEFAULT NULL,
  PRIMARY KEY (`num`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `faq`
--

LOCK TABLES `faq` WRITE;
/*!40000 ALTER TABLE `faq` DISABLE KEYS */;
INSERT INTO `faq` VALUES (1,'admin','ê´€ë¦¬ìž','ê´€ë¦¬ìž','í”¼ì‚¬ ì •ê¸°ê³µì—° ì‚¬ì§„ì— ëŒ€í•˜ì—¬','ì§€ë‚œ ì •ê¸°ê³µì—° ì‚¬ì§„ë“¤ì€ ì €í¬ íŽ˜ì´ìŠ¤ë¶ íŽ˜ì´ì§€ì— ëª¨ë‘ ì˜¬ë ¸êµ¬\r\nê°œì¸ì ìœ¼ë¡œ ê°–êµ¬ì‹¶ìœ¼ì‹  ë¶„ë“¤ì€ ë©”ì¼ì£¼ì†Œ ë‚¨ê²¨ì£¼ì…”ìš”!!\r\nê·¸ëƒ¥ ì—¬ê¸°ë‹¤ ëŒ“ê¸€ ë‚¨ê²¨ì£¼ì…”ìš”\r\n\r\n\r\n- ì´ìš°ìš© ì˜¬ë¦¼','2017-06-08 (00:16)',3,'','','','',NULL,NULL,'','','',NULL,NULL),(2,'admin','ê´€ë¦¬ìž','ê´€ë¦¬ìž','ë­í•˜ëŠ” í™ˆíŽ˜ì´ì§€ ì¸ê°€ìš”?','ì—¬ê¸°ëŠ” í•œêµ­ê¸°ìˆ êµìœ¡ëŒ€í•™êµ( ì½”ë¦¬ì•„í… ) \'í”¼ì•„ë…¸ ì‚¬ëž‘\' ë™ì•„ë¦¬ í™ˆíŽ˜ì´ì§€ ìž…ë‹ˆë‹¤.\r\nì—¬ê¸°ì„œ ì‚¬ì§„/ì•…ë³´/ë ˆìŠ¨ ë“±ì„ ì‹ ì²­ë¯¿ ë‹¤ìš´ë¡œë“œí•  ìˆ˜ ìžˆìœ¼ë©°\r\nì„ í›„ë°°ê°„ ì˜ì‚¬ì†Œí†µ ë™ì•„ë¦¬ íšŒì›ê°„ ì¹œëª©ë„ëª¨ë¥¼ ëª©ì ìœ¼ë¡œ í•©ë‹ˆë‹¤!','2017-06-08 (00:17)',2,'','','','',NULL,NULL,'','','',NULL,NULL);
/*!40000 ALTER TABLE `faq` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `faq_ripple`
--

DROP TABLE IF EXISTS `faq_ripple`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `faq_ripple` (
  `num` int(11) NOT NULL AUTO_INCREMENT,
  `parent` int(11) NOT NULL,
  `id` char(15) NOT NULL,
  `name` char(10) NOT NULL,
  `nick` char(10) NOT NULL,
  `content` text NOT NULL,
  `regist_day` char(20) DEFAULT NULL,
  PRIMARY KEY (`num`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `faq_ripple`
--

LOCK TABLES `faq_ripple` WRITE;
/*!40000 ALTER TABLE `faq_ripple` DISABLE KEYS */;
INSERT INTO `faq_ripple` VALUES (1,1,'admin','ê´€ë¦¬ìž','ê´€ë¦¬ìž','ìš°ìš©ì´ëŠ” ê³ ìƒì´ ë§Žë‹¤....','2017-06-08 (00:18)');
/*!40000 ALTER TABLE `faq_ripple` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `free`
--

DROP TABLE IF EXISTS `free`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `free` (
  `num` int(11) NOT NULL AUTO_INCREMENT,
  `id` char(15) NOT NULL,
  `name` char(10) NOT NULL,
  `nick` char(10) NOT NULL,
  `subject` char(100) NOT NULL,
  `content` text NOT NULL,
  `regist_day` char(20) DEFAULT NULL,
  `hit` int(11) DEFAULT NULL,
  `is_html` char(1) DEFAULT NULL,
  `file_name_0` char(40) DEFAULT NULL,
  `file_name_1` char(40) DEFAULT NULL,
  `file_name_2` char(40) DEFAULT NULL,
  `file_name_3` char(40) DEFAULT NULL,
  `file_name_4` char(40) DEFAULT NULL,
  `file_copied_0` char(30) DEFAULT NULL,
  `file_copied_1` char(30) DEFAULT NULL,
  `file_copied_2` char(30) DEFAULT NULL,
  `file_copied_3` char(30) DEFAULT NULL,
  `file_copied_4` char(30) DEFAULT NULL,
  PRIMARY KEY (`num`)
) ENGINE=MyISAM AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `free`
--

LOCK TABLES `free` WRITE;
/*!40000 ALTER TABLE `free` DISABLE KEYS */;
INSERT INTO `free` VALUES (1,'tyrue','ê¹€ë‘í˜„','ê¹€','qrqwq','qfddd111111qwe','2017-05-21 (17:55)',12,'','','','',NULL,NULL,'','','',NULL,NULL),(3,'tyrue','ê¹€ë‘í˜„','ê¹€','asd','asdasddasdasd','2017-05-27 (01:29)',190,'','','','',NULL,NULL,'','','',NULL,NULL),(4,'tyrue','ê¹€ë‘í˜„','ê¹€','ì•ˆë…•í•˜ì„¸ìš”','ë†€ì´í„°ë‹¤ ã…‹ã…‹ã…¡ã…¡ã…¡ã…¡ã…¡ã…¡','2017-06-03 (01:00)',15,'','facebook.jpg','facebook.jpg','',NULL,NULL,'2017_06_03_01_00_08_0.jpg','2017_06_03_01_01_23_1.jpg','',NULL,NULL),(5,'tyrue','ê¹€ë‘í˜„','ê¹€','ìšœêµ˜ìˆ„~','ìšœêµ˜ìˆ„~','2017-06-03 (12:36)',0,'','','','',NULL,NULL,'','','',NULL,NULL),(6,'tyrue','ê¹€ë‘í˜„','ê¹€','í…ŒìŠ¤íŠ¸ì—ìš”','ì•„ ê·¸ëž­','2017-06-03 (12:37)',1,'','','','',NULL,NULL,'','','',NULL,NULL),(7,'tyrue','ê¹€ë‘í˜„','ê¹€','ê·¸ëŸ¬ë‹ˆ?','ìžìœ ê²Œã…Žì‹œíŒŒ','2017-06-03 (12:37)',0,'','','','',NULL,NULL,'','','',NULL,NULL),(8,'tyrue','ê¹€ë‘í˜„','ê¹€','ìžìœ ê²Œì‹œíŒìž…ë‹ˆë‹¤','ã…Žã…Žã…Žã…Ž','2017-06-03 (12:37)',2,'','','','',NULL,NULL,'','','',NULL,NULL),(9,'tyrue','ê¹€ë‘í˜„','ê¹€','í•˜ì´!!','ì•ˆë…• ìžê²Œ!','2017-06-03 (12:37)',1,'','','','',NULL,NULL,'','','',NULL,NULL),(10,'tyrue','ê¹€ë‘í˜„','ê¹€','ìž…ê²Ÿì´ìš”!','ã…Žã…Ž','2017-06-03 (12:37)',1,'','','','',NULL,NULL,'','','',NULL,NULL),(11,'tyrue','ê¹€ë‘í˜„','ê¹€','í‡´ê²Ÿì´ìš”!','ã…Žã…Žã…Ž','2017-06-03 (12:37)',2,'','','','',NULL,NULL,'','','',NULL,NULL),(12,'tyrue','ê¹€ë‘í˜„','ê¹€','ì¶œì„ì²´í¬~~','ã…Žã…Žã…Žã…Ž','2017-06-03 (12:38)',7,'','','','',NULL,NULL,'','','',NULL,NULL),(13,'admin','ê¹€ì„±ì‹','ì„±ì‚­','ì ‘ìˆ˜í–‡ë‹¤','1','2017-06-03 (16:30)',7,'','ì–´ë‚˜ë‹ˆ.jpg','','',NULL,NULL,'2017_06_03_16_30_42_0.jpg','','',NULL,NULL),(14,'dyf','ë‘ë‘','ìšœ','ê°œê¿€ìž¼ì´ë„¤','ã…‹ã…‹ã…‹ã…‹ã…‹ã…‹ã…‹','2017-06-03 (16:36)',3,'','','','',NULL,NULL,'','','',NULL,NULL),(15,'admin','ê¹€ì„±ì‹','ì„±ì‚­','asdsa','&lt;script&gt;\r\n qweqwe\r\n\r\n&lt;script&gt;','2017-06-03 (16:36)',7,'','','','',NULL,NULL,'','','',NULL,NULL),(17,'tyrue','ê¹€ë‘í˜„','ê¹€ë‘','123','123','2017-06-09 (23:39)',0,'','','','',NULL,NULL,'','','',NULL,NULL);
/*!40000 ALTER TABLE `free` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `free_ripple`
--

DROP TABLE IF EXISTS `free_ripple`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `free_ripple` (
  `num` int(11) NOT NULL AUTO_INCREMENT,
  `parent` int(11) NOT NULL,
  `id` char(15) NOT NULL,
  `name` char(10) NOT NULL,
  `nick` char(10) NOT NULL,
  `content` text NOT NULL,
  `regist_day` char(20) DEFAULT NULL,
  PRIMARY KEY (`num`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `free_ripple`
--

LOCK TABLES `free_ripple` WRITE;
/*!40000 ALTER TABLE `free_ripple` DISABLE KEYS */;
INSERT INTO `free_ripple` VALUES (1,3,'tyrue','ê¹€ë‘í˜„','ê¹€','sad','2017-06-02 (16:54)'),(5,4,'tyrue','ê¹€ë‘í˜„','ê¹€','ìšœ~','2017-06-03 (12:36)'),(3,3,'tyrue','ê¹€ë‘í˜„','ê¹€','ã…ã„´ã…‡','2017-06-02 (23:28)'),(7,15,'dyf','ë‘ë‘','ìšœ','ë­ì—¬','2017-06-03 (16:44)');
/*!40000 ALTER TABLE `free_ripple` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `member`
--

DROP TABLE IF EXISTS `member`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `member` (
  `id` char(15) CHARACTER SET latin1 NOT NULL,
  `pass` char(15) CHARACTER SET latin1 NOT NULL,
  `name` char(10) CHARACTER SET latin1 NOT NULL,
  `nick` char(10) CHARACTER SET latin1 NOT NULL,
  `hp` char(20) CHARACTER SET latin1 NOT NULL,
  `email` char(80) CHARACTER SET latin1 DEFAULT NULL,
  `regist_day` char(20) CHARACTER SET latin1 DEFAULT NULL,
  `level` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `member`
--

LOCK TABLES `member` WRITE;
/*!40000 ALTER TABLE `member` DISABLE KEYS */;
INSERT INTO `member` VALUES ('aa11a','aasd','ê¹€ëŒ€ì˜','ê¹€','010-4576-4277','123@naver.com','2017-05-21 (03:07)',9),('tyrue','qwe','ê¹€ë‘í˜„','ê¹€ë‘','010-6684-5530','ddd@naver.com','2017-06-09 (23:37)',9),('limkj7549','qwe','ìž„ê²½ì œ','ê°±','010-9723-8319','limkj7549@koreatech.ac.kr','2017-05-24 (23:35)',9),('admin','eodud','ê´€ë¦¬ìž','ê´€ë¦¬ìž','010-0000-0000','admin@koreatech.ac.kr','2017-06-03 (16:31)',9),('dyf','dyf','ë‘ë‘','ìšœ','123','2@2.com','2017-06-03 (16:35)',9),('admin1','1234','kss','anony','1','112@qwe.com','2017-06-04 (18:40)',9);
/*!40000 ALTER TABLE `member` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `notice`
--

DROP TABLE IF EXISTS `notice`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `notice` (
  `num` int(11) NOT NULL AUTO_INCREMENT,
  `id` char(15) NOT NULL,
  `name` char(10) NOT NULL,
  `nick` char(10) NOT NULL,
  `subject` char(100) NOT NULL,
  `content` text NOT NULL,
  `regist_day` char(20) DEFAULT NULL,
  `hit` int(11) DEFAULT NULL,
  `is_html` char(1) DEFAULT NULL,
  `file_name_0` char(40) DEFAULT NULL,
  `file_name_1` char(40) DEFAULT NULL,
  `file_name_2` char(40) DEFAULT NULL,
  `file_name_3` char(40) DEFAULT NULL,
  `file_name_4` char(40) DEFAULT NULL,
  `file_copied_0` char(30) DEFAULT NULL,
  `file_copied_1` char(30) DEFAULT NULL,
  `file_copied_2` char(30) DEFAULT NULL,
  `file_copied_3` char(30) DEFAULT NULL,
  `file_copied_4` char(30) DEFAULT NULL,
  PRIMARY KEY (`num`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `notice`
--

LOCK TABLES `notice` WRITE;
/*!40000 ALTER TABLE `notice` DISABLE KEYS */;
INSERT INTO `notice` VALUES (1,'admin','ê´€ë¦¬ìž','ê´€ë¦¬ìž','6/1ì¼ ê³µì—°ìž ëª¨ì§‘','6ì›” 1ì¼ì—í•  ì •ê¸°ê³µì—°ë•Œ ê³µì—°ìžë¥¼ ëª¨ì§‘í•©ë‹ˆë‹¤. ê³¡ì€ ìžìœ ë¡­ê²Œ ì„ íƒí•˜ì‹œë©´ ë˜ê³  ê³¡ì´ ì£¼ëŠ” ëŠë‚Œë˜í•œ ì œí•œì´ ì—†ìŠµë‹ˆë‹¤. ì‰¬ìš´ê³¡ì´ë“  ì–´ë ¤ìš´ ê³¡ì´ë“ , ìžì‹ ì´ ì—°ì£¼ë¥¼ ìž˜ í•˜ë˜ ëª»í•˜ë˜ ìƒê´€ì—†ìŠµë‹ˆë‹¤. ì •ê¸°ê³µì—°ì— ì°¸ì—¬í•˜ì‹¤ ë™ì•„ë¦¬ì›ë¶„ë“¤ ê»˜ì„œëŠ” ì €ì—ê²Œ ê³¡ëª…ê³¼ í•¨ê»˜ ê°œì¸í†¡ì„ ì£¼ì‹œë©´ ê°ì‚¬í•˜ê² ìŠµë‹ˆë‹¤.','2017-06-07 (23:47)',0,'','','','',NULL,NULL,'','','',NULL,NULL),(2,'admin','ê´€ë¦¬ìž','ê´€ë¦¬ìž','6/19 ê³¼í•™ìº í”„ ê³µì—°','ì˜¤ëŠ˜ ì €ë… 8ì‹œ ë°˜ë¶€í„° ë‹´í—Œì‹¤í•™ê´€ ë‹´í—Œí™€ì—ì„œ ê³¼í•™ìº í”„ ê³µì—°ì´ ìžˆìŠµë‹ˆë‹¤.\r\nì´ì— ë”°ë¼ ë¦¬í—ˆì„¤ì´ 6ì‹œì— ìžˆëŠ” ê´€ê³„ë¡œ 5ì‹œ40ë¶„ë¶€í„° ë™ë°©ì˜ í”¼ì•„ë…¸ 1ëŒ€ë¥¼ ë°˜ì¶œí•  ì˜ˆì •ì´ì˜¤ë‹ˆ, í”¼ì•„ë…¸ì‚¬ëž‘ êµ¬ì„±ì›ê»˜ì„œëŠ” ì´ ì  ì–‘í•´í•˜ì—¬ì£¼ì‹œê¸¸ ë¶€íƒë“œë¦¬ê² ìŠµë‹ˆë‹¤!','2017-06-07 (23:48)',1,'','','','',NULL,NULL,'','','',NULL,NULL),(3,'admin','ê´€ë¦¬ìž','ê´€ë¦¬ìž','6/24 ë™ì•„ë¦¬ì˜ ë°¤ ê³µì—°','7ì‹œ30ë¶„ë¶€í„° í…”ë™ ì•„ì°¸ ì•žì—ì„œ ë™ì•„ë¦¬ì˜ ë°¤ í–‰ì‚¬ ì‹œìž‘í•©ë‹ˆë‹¤. ìš°ë¦¬ í”¼ì‚¬ë„ ê¹€ì„±ì‹ ë¶€íšŒìž¥ê³¼ ê¹€ë‘í˜„ í•™ìš°ê°€ 9ì‹œ50ë¶„ì— ê³µì—°í•´ìš”~! \r\n\r\në•Œë¬¸ì— ë°¤ 9ì‹œ30ë¶„ë¶€í„° ë™ë°© í”¼ì•„ë…¸ 1ëŒ€ê°€ ë°˜ì¶œë  ì˜ˆì •ì´ì˜¤ë‹ˆ, ì–‘í•´ë¶€íƒë“œë¦½ë‹ˆë‹¤!','2017-06-07 (23:49)',0,'','','','',NULL,NULL,'','','',NULL,NULL),(4,'admin','ê´€ë¦¬ìž','ê´€ë¦¬ìž','6/10 ì¢…ê°•ì´íšŒ ì•ˆë‚´','ì €ë… 7ì‹œë¶€í„° ëŠ¥ìˆ˜ê´€ì—ì„œ í”¼ì•„ë…¸ì‚¬ëž‘ ì •ê¸°ê³µì—° ê²¸ ì¢…ê°•ì´íšŒê°€ ì§„í–‰ë©ë‹ˆë‹¤!\r\n\r\në‹¤ì–‘í•œ ì—°ì£¼ê³¡ê³¼ ìƒí’ˆ, ê²Œìž„ í”„ë¡œê·¸ëž¨ì´ ì¤€ë¹„ë˜ì–´ ìžˆìœ¼ë‹ˆ ë†€ëŸ¬ì˜¤ì…”ì„œ ìƒí’ˆê³¼ í–‰ë³µë“¤ íƒ€ê°€ì„¸ìš”~!\r\n\r\në’¤í’€ì´ë„ ìžˆìŠµë‹ˆë‹¤.\r\në’¤í’€ì´ëŠ” í™”ë•ê°ˆë§¤ê¸°ì—ì„œ ì§„í–‰í•˜ë©°, ë’¤í’€ì´ ì°¸ê°€ë¹„ëŠ” 5000ì› ìž…ë‹ˆë‹¤! \r\n\r\në§Žì€ ê´€ì‹¬ê³¼ í™ë³´, ì‚¬ëž‘, ê·¸ë¦¬ê³  ì°¸ì—¬ë¥¼ ë¶€íƒë“œë¦½ë‹ˆë‹¤!','2017-06-07 (23:49)',0,'','','','',NULL,NULL,'','','',NULL,NULL),(5,'admin','ê´€ë¦¬ìž','ê´€ë¦¬ìž','ì¢…ê°•ì´íšŒ íšŒì˜ (ì°¨ê¸° íšŒìž¥ ë‚´ì •ìž ì¶œì„)','ì•ˆë…•í•˜ì‹­ë‹ˆê¹Œ 17ë…„ 1í•™ê¸° í”¼ì•„ë…¸ì‚¬ëž‘ íšŒìž¥ì§ì„ ìˆ˜í–‰í•œ ì»´í“¨í„°ê³µí•™ë¶€ 14í•™ë²ˆ ìž„ê²½ì œ ìž…ë‹ˆë‹¤. \r\n\r\në‚´ì¼ ì¦‰, 6. 8(ëª©) 18ì‹œ 15ë¶„ë¶€í„° ì•½ 40ì—¬ ë¶„ê°„ í”¼ì•„ë…¸ì‚¬ëž‘ ì¢…ê°•ì´íšŒë¥¼ ì§„í–‰í•  ì˜ˆì •ìž…ë‹ˆë‹¤. \r\n\r\në‚´ì¼ ì¢…ê°•ì´íšŒì—ì„œëŠ” 1í•™ê¸° íšŒìž¥ ìž„ê²½ì œ, ë¶€íšŒìž¥ ê¹€ì„±ì‹, ì´ë¬´ë¶€ìž¥ ì˜¤ì£¼ì˜ í•™ìš°ì™€ 2í•™ê¸° íšŒìž¥ ë‚´ì •ìžê°€ ì¶œì„í•˜ì—¬,\r\n\r\n1. í”¼ì•„ë…¸ì‚¬ëž‘ 1í•™ê¸° í™œë™ë‚´ì—­\r\n2. í”¼ì•„ë…¸ì‚¬ëž‘ 1í•™ê¸° ê²°ì‚°ë‚´ì—­\r\n3. ì§ˆì˜ì‘ë‹µ\r\n4. í”¼ì•„ë…¸ì‚¬ëž‘ 2í•™ê¸° íšŒìž¥ë‚´ì •ìž ì†Œê°œ ë° ì²­ë¬¸íšŒ\r\n\r\n4ê°€ì§€ ì‚¬í•­ì„ ì§„í–‰í•  ì˜ˆì •ì´ë©°,\r\níšŒì‹ì€ ì—†ìŠµë‹ˆë‹¤. \r\nì‹œí—˜ê¸°ê°„ìž„ì„ ê³ ë ¤í•˜ì—¬ ê°„ëžµí•˜ê²Œ ì§„í–‰í•˜ëŠ” ì  ë„“ê²Œ ì–‘í•´í•˜ì—¬ì£¼ì‹œê¸¸ ë¶€íƒë“œë¦¬ë©°, \r\n\r\nì‹œê°„ì´ ìžˆìœ¼ì‹  í”¼ì•„ë…¸ì‚¬ëž‘ êµ¬ì„±ì›ê»˜ì„œëŠ” ì°¸ì„í•˜ì‹œì–´ íˆ¬ëª…í•œ ë™ì•„ë¦¬ ìš´ì˜ë‚´ì—­ì„ í™•ì¸í•˜ì—¬ ì£¼ì‹œê¸° ë°”ëžë‹ˆë‹¤!    \r\n\r\nê°ì‚¬í•©ë‹ˆë‹¤. \r\n\r\ní”¼ì•„ë…¸ì‚¬ëž‘ 17ë…„ 1í•™ê¸° íšŒìž¥ ìž„ê²½ì œ ë“œë¦¼. ','2017-06-07 (23:50)',1,'','','','',NULL,NULL,'','','',NULL,NULL),(6,'admin','ê´€ë¦¬ìž','ê´€ë¦¬ìž','ì¢…ê°•ì´íšŒ ìž¥ì†Œ ê³µì§€','ìž¥ì†ŒëŠ” 4ê³µí•™ê´€ A102 ìž…ë‹ˆë‹¤. ê¶ê¸ˆí•˜ì‹  ì‚¬í•­ì´ ìžˆìœ¼ì‹  í•™ìš°ê»˜ì„œëŠ” \r\n010 9723 8319 íšŒìž¥ ìž„ê²½ì œ,\r\n010 9924 4184 ë¶€íšŒìž¥ ê¹€ì„±ì‹ í•™ìš°ì—ê²Œ ì—°ë½ë¶€íƒë“œë¦½ë‹ˆë‹¤! ','2017-06-07 (23:50)',0,'','','','',NULL,NULL,'','','',NULL,NULL);
/*!40000 ALTER TABLE `notice` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `notice_ripple`
--

DROP TABLE IF EXISTS `notice_ripple`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `notice_ripple` (
  `num` int(11) NOT NULL AUTO_INCREMENT,
  `parent` int(11) NOT NULL,
  `id` char(15) NOT NULL,
  `name` char(10) NOT NULL,
  `nick` char(10) NOT NULL,
  `content` text NOT NULL,
  `regist_day` char(20) DEFAULT NULL,
  PRIMARY KEY (`num`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `notice_ripple`
--

LOCK TABLES `notice_ripple` WRITE;
/*!40000 ALTER TABLE `notice_ripple` DISABLE KEYS */;
/*!40000 ALTER TABLE `notice_ripple` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `photo`
--

DROP TABLE IF EXISTS `photo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `photo` (
  `num` int(11) NOT NULL AUTO_INCREMENT,
  `id` char(15) NOT NULL,
  `nick` char(10) NOT NULL,
  `subject` char(100) NOT NULL,
  `regist_day` char(20) DEFAULT NULL,
  `file_name_0` char(40) DEFAULT NULL,
  `file_copied_0` char(30) DEFAULT NULL,
  PRIMARY KEY (`num`)
) ENGINE=MyISAM AUTO_INCREMENT=21 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `photo`
--

LOCK TABLES `photo` WRITE;
/*!40000 ALTER TABLE `photo` DISABLE KEYS */;
INSERT INTO `photo` VALUES (2,'tyrue','ê¹€','ì •ê¸°ê³µì—°','2017-06-03 (16:03)','photo14.jpg','2017_06_03_16_03_52_0.jpg'),(3,'tyrue','ê¹€','ëŒ€ì²œ í•´ìˆ˜ìš•ìž¥','2017-06-03 (16:04)','photo3.jpg','2017_06_03_16_04_25_0.jpg'),(10,'admin','ê´€ë¦¬ìž','ë³‘ê·œ ã…‹ã…‹ã…‹ã…‹','2017-06-04 (15:54)','photo26.jpg','2017_06_04_15_54_45_0.jpg'),(11,'admin','ê´€ë¦¬ìž','í”¼ìžì— í™˜í˜¸í•˜ëŠ” ê²½ì œ','2017-06-04 (15:55)','photo1.jpg','2017_06_04_15_55_02_0.jpg'),(13,'admin','ê´€ë¦¬ìž','ë‘ë“œë¦¼ ê³µì—°','2017-06-04 (15:58)','photo9.jpg','2017_06_04_15_58_06_0.jpg'),(12,'admin','ê´€ë¦¬ìž','ê²Œìž„ì¤‘??íšŒì˜ì¤‘??','2017-06-04 (15:57)','photo6.jpg','2017_06_04_15_57_48_0.jpg'),(9,'admin','ê´€ë¦¬ìž','ë°©í•˜ì°© ê³µì—°','2017-06-04 (15:54)','photo13.jpg','2017_06_04_15_54_21_0.jpg'),(14,'admin','ê´€ë¦¬ìž','ê³¼í•™ìº í”„ ê³µì—°','2017-06-04 (15:58)','photo28.jpg','2017_06_04_15_58_21_0.jpg'),(15,'admin','ê´€ë¦¬ìž','ëŒ€ì˜ì´ì˜ ë¶ˆì‡¼','2017-06-04 (15:58)','photo25.jpg','2017_06_04_15_58_34_0.jpg'),(16,'admin','ê´€ë¦¬ìž','ì±„ì›ì´ ì¸ìƒìƒ·','2017-06-04 (15:58)','photo27.jpg','2017_06_04_15_58_50_0.jpg'),(17,'admin','ê´€ë¦¬ìž','ê²½ì œ í‘œì • ã…‹ã…‹ã…‹ã…‹ã…‹ã…‹ã…‹ã…‹ã…‹','2017-06-04 (15:59)','photo20.jpg','2017_06_04_15_59_27_0.jpg'),(20,'admin','ê´€ë¦¬ìž','ì½”ë¦¬ì•„í… ê³ ë“ ëž¨ì§€','2017-06-08 (00:27)','KakaoTalk_20161222_011639902.jpg','2017_06_08_00_27_43_0.jpg');
/*!40000 ALTER TABLE `photo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `qna`
--

DROP TABLE IF EXISTS `qna`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `qna` (
  `num` int(11) NOT NULL AUTO_INCREMENT,
  `id` char(15) NOT NULL,
  `name` char(10) NOT NULL,
  `nick` char(10) NOT NULL,
  `subject` char(100) NOT NULL,
  `content` text NOT NULL,
  `regist_day` char(20) DEFAULT NULL,
  `hit` int(11) DEFAULT NULL,
  `is_html` char(1) DEFAULT NULL,
  `file_name_0` char(40) DEFAULT NULL,
  `file_name_1` char(40) DEFAULT NULL,
  `file_name_2` char(40) DEFAULT NULL,
  `file_name_3` char(40) DEFAULT NULL,
  `file_name_4` char(40) DEFAULT NULL,
  `file_copied_0` char(30) DEFAULT NULL,
  `file_copied_1` char(30) DEFAULT NULL,
  `file_copied_2` char(30) DEFAULT NULL,
  `file_copied_3` char(30) DEFAULT NULL,
  `file_copied_4` char(30) DEFAULT NULL,
  PRIMARY KEY (`num`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `qna`
--

LOCK TABLES `qna` WRITE;
/*!40000 ALTER TABLE `qna` DISABLE KEYS */;
INSERT INTO `qna` VALUES (1,'admin','ê´€ë¦¬ìž','ê´€ë¦¬ìž','ì¢…ê°•ì´íšŒ ë’·í’€ì´ ìž¥ì†Œë¥¼ ì¢€ ì•Œë ¤ì£¼ì„¸ìš”','ëª¨ë¥´ê² ìŒ.','2017-06-08 (00:19)',5,'','','','',NULL,NULL,'','','',NULL,NULL),(2,'admin','ê´€ë¦¬ìž','ê´€ë¦¬ìž','ë™ìœ¤ì´í˜• ì†ì€ ì™œë‹¤ì¹˜ì…¨ë‚˜ìš”?','?? ì˜¤ë¥¸íŒ”ì— í‘ì—¼ë£¡ì¸ê°€ìš”','2017-06-08 (00:22)',6,'','','','',NULL,NULL,'','','',NULL,NULL),(3,'admin','ê´€ë¦¬ìž','ê´€ë¦¬ìž','ê¹€ì„±ì‹ ë¶€íšŒìž¥ì€ ì—°ì˜ˆì¸ ëˆ„êµ¬ ë‹®ì•˜ë‚˜ìš”','ì–´ë””ì„œ ë³¸ë“¯í•´ì„œìš” ã…Žã…Ž','2017-06-08 (00:23)',2,'','','','',NULL,NULL,'','','',NULL,NULL),(4,'admin','ê´€ë¦¬ìž','ê´€ë¦¬ìž','ê°€ì˜¨ìŠ¤ì¿¨ ì‹œê°„ì´ ì–´ë–»ê²Œ ë˜ì£ ??','ì¶œìž…ê¸ˆì§€ ì‹œê°„ì¢€ ì•Œë ¤ì£¼ì…ˆ','2017-06-08 (00:24)',2,'','','','',NULL,NULL,'','','',NULL,NULL);
/*!40000 ALTER TABLE `qna` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `qna_ripple`
--

DROP TABLE IF EXISTS `qna_ripple`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `qna_ripple` (
  `num` int(11) NOT NULL AUTO_INCREMENT,
  `parent` int(11) NOT NULL,
  `id` char(15) NOT NULL,
  `name` char(10) NOT NULL,
  `nick` char(10) NOT NULL,
  `content` text NOT NULL,
  `regist_day` char(20) DEFAULT NULL,
  PRIMARY KEY (`num`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `qna_ripple`
--

LOCK TABLES `qna_ripple` WRITE;
/*!40000 ALTER TABLE `qna_ripple` DISABLE KEYS */;
INSERT INTO `qna_ripple` VALUES (1,1,'admin','ê´€ë¦¬ìž','ê´€ë¦¬ìž','í™”ë• ê°ˆë§¤ê¸° ìž…ë‹ˆë‹¤','2017-06-08 (00:21)'),(2,2,'admin','ê´€ë¦¬ìž','ê´€ë¦¬ìž','ìˆ  ë“œì‹œë‹¤ê°€ ë‹¤ì¹˜ì…¨ë‹µë‹ˆë‹¤ ìœ„ë¡œì¢€ í•´ì£¼ì„¸ìš”','2017-06-08 (00:22)'),(3,3,'admin','ê´€ë¦¬ìž','ê´€ë¦¬ìž','ìž„ì‹œì™„ ë‹®ì•˜ìŠµë‹ˆë‹¤..','2017-06-08 (00:23)'),(4,4,'admin','ê´€ë¦¬ìž','ê´€ë¦¬ìž','ë³´í†µ 6:30 ~ 8:00 ìž…ë‹ˆë‹¤','2017-06-08 (00:24)'),(5,1,'admin','ê´€ë¦¬ìž','ê´€ë¦¬ìž','ã…‡ã…‡ã…‡ã…‡ã…‡ã…‡ã…‡ã…‡ã…‡ã…‡','2017-06-08 (00:24)'),(6,2,'admin','ê´€ë¦¬ìž','ê´€ë¦¬ìž','ã…‹ã…‹ã…‹ã…‹ã…‹ã…‹ã…‹ã…‹ã…‹ã…‹ã…‹ã…‹ã…‹ã…‹ã…‹ã…‹ã…‹ã…‹ã…‹ã…‹','2017-06-08 (00:24)'),(7,2,'admin','ê´€ë¦¬ìž','ê´€ë¦¬ìž','ã…‹ã…‹ã…‹ã…‹ã…‹ã…‹ã…‹ã…‹ã…‹ã…‹ã…‹ã…‹','2017-06-08 (00:24)'),(8,2,'admin','ê´€ë¦¬ìž','ê´€ë¦¬ìž','ã…Žã…Žã…Žã…Žã…Žã…Žã…Žã…Žã…Žã…Ž','2017-06-08 (00:24)');
/*!40000 ALTER TABLE `qna_ripple` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `request`
--

DROP TABLE IF EXISTS `request`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `request` (
  `num` int(11) NOT NULL AUTO_INCREMENT,
  `id` char(15) NOT NULL,
  `name` char(10) NOT NULL,
  `nick` char(10) NOT NULL,
  `subject` char(100) NOT NULL,
  `content` text NOT NULL,
  `regist_day` char(20) DEFAULT NULL,
  `hit` int(11) DEFAULT NULL,
  `is_html` char(1) DEFAULT NULL,
  `file_name_0` char(40) DEFAULT NULL,
  `file_name_1` char(40) DEFAULT NULL,
  `file_name_2` char(40) DEFAULT NULL,
  `file_name_3` char(40) DEFAULT NULL,
  `file_name_4` char(40) DEFAULT NULL,
  `file_copied_0` char(30) DEFAULT NULL,
  `file_copied_1` char(30) DEFAULT NULL,
  `file_copied_2` char(30) DEFAULT NULL,
  `file_copied_3` char(30) DEFAULT NULL,
  `file_copied_4` char(30) DEFAULT NULL,
  PRIMARY KEY (`num`)
) ENGINE=MyISAM AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `request`
--

LOCK TABLES `request` WRITE;
/*!40000 ALTER TABLE `request` DISABLE KEYS */;
INSERT INTO `request` VALUES (16,'tyrue','ê¹€ë‘í˜„','ê¹€ë‘','ê²Œì‹œíŒ ê¸°ëŠ¥ ì¶”ê°€ ë¶€íƒë“œë ¤ìš”','ê²Œì‹œíŒ ê¸°ëŠ¥ ì¶”ê°€ ë¶€íƒë“œë ¤ìš”','2017-06-10 (00:21)',0,'','','','',NULL,NULL,'','','',NULL,NULL);
/*!40000 ALTER TABLE `request` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `request_ripple`
--

DROP TABLE IF EXISTS `request_ripple`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `request_ripple` (
  `num` int(11) NOT NULL AUTO_INCREMENT,
  `parent` int(11) NOT NULL,
  `id` char(15) NOT NULL,
  `name` char(10) NOT NULL,
  `nick` char(10) NOT NULL,
  `content` text NOT NULL,
  `regist_day` char(20) DEFAULT NULL,
  PRIMARY KEY (`num`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `request_ripple`
--

LOCK TABLES `request_ripple` WRITE;
/*!40000 ALTER TABLE `request_ripple` DISABLE KEYS */;
INSERT INTO `request_ripple` VALUES (1,3,'admin','ê´€ë¦¬ìž','ê´€ë¦¬ìž','ì§„ì§œìž„','2017-06-08 (00:00)');
/*!40000 ALTER TABLE `request_ripple` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `survey`
--

DROP TABLE IF EXISTS `survey`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `survey` (
  `ans1` int(11) DEFAULT NULL,
  `ans2` int(11) DEFAULT NULL,
  `ans3` int(11) DEFAULT NULL,
  `ans4` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `survey`
--

LOCK TABLES `survey` WRITE;
/*!40000 ALTER TABLE `survey` DISABLE KEYS */;
INSERT INTO `survey` VALUES (5,9,3,2);
/*!40000 ALTER TABLE `survey` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `video`
--

DROP TABLE IF EXISTS `video`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `video` (
  `num` int(11) NOT NULL AUTO_INCREMENT,
  `id` char(15) NOT NULL,
  `nick` char(10) NOT NULL,
  `subject` char(100) NOT NULL,
  `link` char(20) NOT NULL,
  `regist_day` char(20) DEFAULT NULL,
  `file_name_0` char(40) DEFAULT NULL,
  `file_copied_0` char(30) DEFAULT NULL,
  PRIMARY KEY (`num`)
) ENGINE=MyISAM AUTO_INCREMENT=40 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `video`
--

LOCK TABLES `video` WRITE;
/*!40000 ALTER TABLE `video` DISABLE KEYS */;
INSERT INTO `video` VALUES (11,'admin','ê´€ë¦¬ìž','150919 ë‘ë“œë¦¼ ê³µì—° í”¼ì•„ë…¸ì‚¬ëž‘ kì˜¤ì¼€ìŠ¤íŠ¸ë¼ í˜‘ì—° Bon!Bon!','KFFLNcpRi1I','2017-06-04 (18:06)','ì œëª© ì—†ìŒ2.jpg','2017_06_04_18_06_52_0.jpg'),(10,'admin','ê´€ë¦¬ìž','150916 ì°¨ì•”ë™ ìƒˆë§ˆì„ê¸ˆê³  ì•ž ë²„ìŠ¤í‚¹ ë…¹í„´ op.9 no.2','Mocx9_JvMdM','2017-06-04 (18:05)','ì œëª© ì—†ìŒ.jpg','2017_06_04_18_05_22_0.jpg'),(14,'admin','ê´€ë¦¬ìž','2015ë…„ 11ì›” 17ì¼ í”¼ì•„ë…¸ì‚¬ëž‘ 21íšŒ ì •ê¸°ê³µì—°-ë¹—ì†Œë¦¬','ICJLOcTO14U','2017-06-08 (00:39)','ì œëª© ì—†ìŒ.jpg','2017_06_08_00_39_03_0.jpg'),(13,'admin','ê´€ë¦¬ìž','2015ë…„ 11ì›” 17ì¼ í”¼ì•„ë…¸ì‚¬ëž‘ 21íšŒ ì •ê¸°ê³µì—°-Let it go','w2X19FoXRdM','2017-06-08 (00:37)','ì œëª© ì—†ìŒ.jpg','2017_06_08_00_37_55_0.jpg'),(15,'admin','ê´€ë¦¬ìž','2015ë…„ 11ì›” 17ì¼ í”¼ì•„ë…¸ì‚¬ëž‘ 21íšŒ ì •ê¸°ê³µì—°-ê³µì¤‘ì‚°ì±…(í•˜ìš¸ì˜ ì›€ì§ì´ëŠ” ì„± Theme','WsxE3j7IY2Y','2017-06-08 (00:39)','ì œëª© ì—†ìŒ.jpg','2017_06_08_00_39_58_0.jpg'),(18,'admin','ê´€ë¦¬ìž','2015ë…„ 11ì›” 18ì¼ Kì˜¤ì¼€ìŠ¤íŠ¸ë¼ ì •ê¸°ì—°ì£¼ í˜‘ì—°-Isn\'t she lovely','6m9AUTSE7Kg','2017-06-08 (00:42)','ì œëª© ì—†ìŒ.jpg','2017_06_08_00_42_34_0.jpg'),(19,'admin','ê´€ë¦¬ìž','2015ë…„ 11ì›” 27ì¼ ê³ êµìƒ ê³¼í•™ìº í”„-ë¹—ì†Œë¦¬(ìœ¤í•˜)','yPTA9Qo1nKE','2017-06-08 (00:43)','ì œëª© ì—†ìŒ.jpg','2017_06_08_00_43_46_0.jpg'),(20,'admin','ê´€ë¦¬ìž','2015ë…„ 11ì›” 27ì¼ ê³ êµìƒ ê³¼í•™ìº í”„-ì°¸íšŒ(ì£½ìŒì—ê´€í•˜ì—¬ ost)','FdGM4zRYCzo','2017-06-08 (00:44)','ì œëª© ì—†ìŒ.jpg','2017_06_08_00_44_39_0.jpg'),(21,'admin','ê´€ë¦¬ìž','2015ë…„ 11ì›” 27ì¼ ê³ êµìƒ ê³¼í•™ìº í”„-ì•ˆì•„ì¤˜(ì •ì¤€ì¼)','pMUJoBPDtsw','2017-06-08 (00:45)','ì œëª© ì—†ìŒ.jpg','2017_06_08_00_45_25_0.jpg'),(22,'admin','ê´€ë¦¬ìž','2015ë…„ 11ì›” 18ì¼ Kì˜¤ì¼€ìŠ¤íŠ¸ë¼ ì •ê¸°ì—°ì£¼ í˜‘ì—°-Bon! Bon!','Oqa16pnSvnA','2017-06-08 (01:01)','ì œëª© ì—†ìŒ.jpg','2017_06_08_01_01_17_0.jpg'),(25,'admin','ê´€ë¦¬ìž','2016ë…„ 2ì›” 26ì¼ ì‹ ìž…ìƒ ì˜¤ë¦¬ì—”í…Œì´ì…˜-í¬ë¡œì•„í‹°ì•ˆ ëž©ì†Œë””(Croatian Rhapsody)','8lj3_SRtDhk','2017-06-08 (01:03)','ì œëª© ì—†ìŒ.jpg','2017_06_08_01_03_37_0.jpg'),(27,'admin','ê´€ë¦¬ìž','2016ë…„ 5ì›” 3ì¼ ë””ë”¤ì§€ê¸° ì½œë¼ë³´-Heart and soul (ì˜í™” BIG OST)','8zebJWu5Ekc','2017-06-08 (01:05)','ì œëª© ì—†ìŒ.jpg','2017_06_08_01_05_06_0.jpg'),(28,'admin','ê´€ë¦¬ìž','2016ë…„ 5ì›” 3ì¼ ë””ë”¤ì§€ê¸° ì½œë¼ë³´-ë™í™” (ì´ë£¨ë§ˆ, ì‹œí¬ë¦¿ê°€ë“  OST)','Pbeyw8euqio','2017-06-08 (01:06)','ì œëª© ì—†ìŒ.jpg','2017_06_08_01_06_02_0.jpg'),(29,'admin','ê´€ë¦¬ìž','2016ë…„ 5ì›” 11ì¼ í•œë§¥ì œ - summer(Hisaishi Joe)','V67q78YqogY','2017-06-08 (01:07)','ì œëª© ì—†ìŒ.jpg','2017_06_08_01_07_08_0.jpg'),(31,'admin','ê´€ë¦¬ìž','2016ë…„ 5ì›” 11ì¼ í•œë§¥ì œ - ë‚˜ë¥¼ ë– ë‚˜ê°€ë˜(ëª½ë‹ˆ)','w5eQ0Rf1vWY','2017-06-08 (01:10)','ì œëª© ì—†ìŒ.jpg','2017_06_08_01_10_36_0.jpg'),(32,'admin','ê´€ë¦¬ìž','2016ë…„ 5ì›” 31ì¼ ì œ 22íšŒ ì •ê¸°ê³µì—°-Joyfulness','Sk1g0L96Ug0','2017-06-08 (01:11)','ì œëª© ì—†ìŒ.jpg','2017_06_08_01_11_38_0.jpg'),(33,'admin','ê´€ë¦¬ìž','2016ë…„ 5ì›” 31ì¼ ì œ 22íšŒ ì •ê¸°ê³µì—°-Just want to look at you','wt8DQaR687g','2017-06-08 (01:12)','ì œëª© ì—†ìŒ.jpg','2017_06_08_01_12_47_0.jpg'),(34,'admin','ê´€ë¦¬ìž','2016ë…„ 5ì›” 31ì¼ ì œ 22íšŒ ì •ê¸°ê³µì—°-ë‹¬ì—ì„œì˜ í•˜ë£¨','PO0oereohNE','2017-06-08 (01:13)','ì œëª© ì—†ìŒ.jpg','2017_06_08_01_13_51_0.jpg'),(35,'admin','ê´€ë¦¬ìž','2016ë…„ 5ì›” 31ì¼ ì œ 22íšŒ ì •ê¸°ê³µì—°-ìˆœí™˜í•˜ëŠ” ê³„ì ˆ','aftvBbRQzGE','2017-06-08 (01:14)','ì œëª© ì—†ìŒ.jpg','2017_06_08_01_14_55_0.jpg');
/*!40000 ALTER TABLE `video` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2017-06-10  2:23:23
