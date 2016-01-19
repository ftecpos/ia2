-- MySQL dump 10.13  Distrib 5.5.9, for Win32 (x86)
--
-- Host: localhost    Database: test_dez
-- ------------------------------------------------------
-- Server version	5.5.8-log

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
-- Current Database: `test_dez`
--

CREATE DATABASE /*!32312 IF NOT EXISTS*/ `test_dez` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `test_dez`;

--
-- Table structure for table `cdb_access`
--

DROP TABLE IF EXISTS `cdb_access`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cdb_access` (
  `uid` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `fid` smallint(6) unsigned NOT NULL DEFAULT '0',
  `allowview` tinyint(1) NOT NULL DEFAULT '0',
  `allowpost` tinyint(1) NOT NULL DEFAULT '0',
  `allowreply` tinyint(1) NOT NULL DEFAULT '0',
  `allowgetattach` tinyint(1) NOT NULL DEFAULT '0',
  `allowpostattach` tinyint(1) NOT NULL DEFAULT '0',
  `adminuser` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `dateline` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`uid`,`fid`),
  KEY `listorder` (`fid`,`dateline`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cdb_access`
--

LOCK TABLES `cdb_access` WRITE;
/*!40000 ALTER TABLE `cdb_access` DISABLE KEYS */;
/*!40000 ALTER TABLE `cdb_access` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cdb_activities`
--

DROP TABLE IF EXISTS `cdb_activities`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cdb_activities` (
  `tid` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `uid` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `cost` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `starttimefrom` int(10) unsigned NOT NULL DEFAULT '0',
  `starttimeto` int(10) unsigned NOT NULL DEFAULT '0',
  `place` char(40) NOT NULL DEFAULT '',
  `class` char(20) NOT NULL DEFAULT '',
  `gender` tinyint(1) NOT NULL DEFAULT '0',
  `number` smallint(5) unsigned NOT NULL DEFAULT '0',
  `expiration` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`tid`),
  KEY `uid` (`uid`,`starttimefrom`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cdb_activities`
--

LOCK TABLES `cdb_activities` WRITE;
/*!40000 ALTER TABLE `cdb_activities` DISABLE KEYS */;
/*!40000 ALTER TABLE `cdb_activities` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cdb_activityapplies`
--

DROP TABLE IF EXISTS `cdb_activityapplies`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cdb_activityapplies` (
  `applyid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `tid` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `username` char(15) NOT NULL DEFAULT '',
  `uid` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `message` char(200) NOT NULL DEFAULT '',
  `verified` tinyint(1) NOT NULL DEFAULT '0',
  `dateline` int(10) unsigned NOT NULL DEFAULT '0',
  `payment` mediumint(8) NOT NULL DEFAULT '0',
  `contact` char(200) NOT NULL,
  PRIMARY KEY (`applyid`),
  KEY `uid` (`uid`),
  KEY `tid` (`tid`),
  KEY `dateline` (`tid`,`dateline`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cdb_activityapplies`
--

LOCK TABLES `cdb_activityapplies` WRITE;
/*!40000 ALTER TABLE `cdb_activityapplies` DISABLE KEYS */;
/*!40000 ALTER TABLE `cdb_activityapplies` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cdb_addons`
--

DROP TABLE IF EXISTS `cdb_addons`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cdb_addons` (
  `key` varchar(255) NOT NULL DEFAULT '',
  `title` varchar(255) NOT NULL DEFAULT '',
  `sitename` varchar(255) NOT NULL DEFAULT '',
  `siteurl` varchar(255) NOT NULL DEFAULT '',
  `description` varchar(255) NOT NULL DEFAULT '',
  `contact` varchar(255) NOT NULL DEFAULT '',
  `logo` varchar(255) NOT NULL DEFAULT '',
  `system` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`key`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cdb_addons`
--

LOCK TABLES `cdb_addons` WRITE;
/*!40000 ALTER TABLE `cdb_addons` DISABLE KEYS */;
INSERT INTO `cdb_addons` VALUES ('25z5wh0o00','Comsenz','Comsenz','http://www.comsenz.com','Comsenz官方網站推薦的論壇模板與插件','ts@comsenz.com','http://www.comsenz.com/addon/logo.gif',1),('R051uc9D1i','DPS','DPS','http://bbs.7dps.com','提供 Discuz! 插件與風格，享受一鍵安裝/升級/卸載帶來的快感，還提供少量風格。','http://bbs.7dps.com/thread-1646-1-1.html','http://api.7dps.com/addons/logo.gif',0);
/*!40000 ALTER TABLE `cdb_addons` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cdb_adminactions`
--

DROP TABLE IF EXISTS `cdb_adminactions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cdb_adminactions` (
  `admingid` smallint(6) unsigned NOT NULL DEFAULT '0',
  `disabledactions` text NOT NULL,
  PRIMARY KEY (`admingid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cdb_adminactions`
--

LOCK TABLES `cdb_adminactions` WRITE;
/*!40000 ALTER TABLE `cdb_adminactions` DISABLE KEYS */;
INSERT INTO `cdb_adminactions` VALUES (18,'a:1:{i:0;s:9:\"_readonly\";}');
/*!40000 ALTER TABLE `cdb_adminactions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cdb_admincustom`
--

DROP TABLE IF EXISTS `cdb_admincustom`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cdb_admincustom` (
  `id` smallint(6) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `url` varchar(255) NOT NULL,
  `sort` tinyint(1) NOT NULL DEFAULT '0',
  `displayorder` tinyint(3) NOT NULL,
  `clicks` smallint(6) unsigned NOT NULL DEFAULT '1',
  `uid` mediumint(8) unsigned NOT NULL,
  `dateline` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `uid` (`uid`),
  KEY `displayorder` (`displayorder`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cdb_admincustom`
--

LOCK TABLES `cdb_admincustom` WRITE;
/*!40000 ALTER TABLE `cdb_admincustom` DISABLE KEYS */;
/*!40000 ALTER TABLE `cdb_admincustom` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cdb_admingroups`
--

DROP TABLE IF EXISTS `cdb_admingroups`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cdb_admingroups` (
  `admingid` smallint(6) unsigned NOT NULL DEFAULT '0',
  `alloweditpost` tinyint(1) NOT NULL DEFAULT '0',
  `alloweditpoll` tinyint(1) NOT NULL DEFAULT '0',
  `allowstickthread` tinyint(1) NOT NULL DEFAULT '0',
  `allowmodpost` tinyint(1) NOT NULL DEFAULT '0',
  `allowdelpost` tinyint(1) NOT NULL DEFAULT '0',
  `allowmassprune` tinyint(1) NOT NULL DEFAULT '0',
  `allowrefund` tinyint(1) NOT NULL DEFAULT '0',
  `allowcensorword` tinyint(1) NOT NULL DEFAULT '0',
  `allowviewip` tinyint(1) NOT NULL DEFAULT '0',
  `allowbanip` tinyint(1) NOT NULL DEFAULT '0',
  `allowedituser` tinyint(1) NOT NULL DEFAULT '0',
  `allowmoduser` tinyint(1) NOT NULL DEFAULT '0',
  `allowbanuser` tinyint(1) NOT NULL DEFAULT '0',
  `allowpostannounce` tinyint(1) NOT NULL DEFAULT '0',
  `allowviewlog` tinyint(1) NOT NULL DEFAULT '0',
  `allowbanpost` tinyint(1) NOT NULL DEFAULT '0',
  `disablepostctrl` tinyint(1) NOT NULL DEFAULT '0',
  `supe_allowpushthread` tinyint(1) NOT NULL DEFAULT '0',
  `allowhighlightthread` tinyint(1) NOT NULL DEFAULT '0',
  `allowdigestthread` tinyint(1) NOT NULL DEFAULT '0',
  `allowrecommendthread` tinyint(1) NOT NULL DEFAULT '0',
  `allowbumpthread` tinyint(1) NOT NULL DEFAULT '0',
  `allowclosethread` tinyint(1) NOT NULL DEFAULT '0',
  `allowmovethread` tinyint(1) NOT NULL DEFAULT '0',
  `allowedittypethread` tinyint(1) NOT NULL DEFAULT '0',
  `allowstampthread` tinyint(1) NOT NULL DEFAULT '0',
  `allowcopythread` tinyint(1) NOT NULL DEFAULT '0',
  `allowmergethread` tinyint(1) NOT NULL DEFAULT '0',
  `allowsplitthread` tinyint(1) NOT NULL DEFAULT '0',
  `allowrepairthread` tinyint(1) NOT NULL DEFAULT '0',
  `allowwarnpost` tinyint(1) NOT NULL DEFAULT '0',
  `allowviewreport` tinyint(1) NOT NULL DEFAULT '0',
  `alloweditforum` tinyint(1) NOT NULL DEFAULT '0',
  `allowremovereward` tinyint(1) NOT NULL DEFAULT '0',
  `allowedittrade` tinyint(1) NOT NULL DEFAULT '0',
  `alloweditactivity` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`admingid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cdb_admingroups`
--

LOCK TABLES `cdb_admingroups` WRITE;
/*!40000 ALTER TABLE `cdb_admingroups` DISABLE KEYS */;
INSERT INTO `cdb_admingroups` VALUES (1,1,1,3,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,3,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1),(2,1,0,2,1,1,1,1,1,1,1,1,1,1,1,1,1,1,0,1,3,1,1,1,1,1,1,1,1,1,1,1,1,1,1,0,0),(3,1,0,1,1,1,0,0,0,1,0,0,1,1,0,1,1,1,0,1,3,1,1,1,1,1,1,1,1,1,1,1,1,1,1,0,0),(16,0,0,1,0,0,0,0,0,0,0,0,0,0,0,0,1,0,0,1,1,1,1,1,0,0,1,0,0,0,0,1,1,0,0,0,0),(17,1,0,2,1,0,0,1,0,1,0,0,0,0,1,1,1,1,0,1,3,1,1,1,1,1,1,1,1,1,1,1,1,1,1,0,0),(18,0,0,0,0,0,0,0,0,1,0,0,0,0,0,0,0,1,1,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0),(19,0,0,0,1,0,0,0,0,1,1,0,1,1,0,0,0,1,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0);
/*!40000 ALTER TABLE `cdb_admingroups` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cdb_adminnotes`
--

DROP TABLE IF EXISTS `cdb_adminnotes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cdb_adminnotes` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `admin` varchar(15) NOT NULL DEFAULT '',
  `access` tinyint(3) NOT NULL DEFAULT '0',
  `adminid` tinyint(3) NOT NULL DEFAULT '0',
  `dateline` int(10) unsigned NOT NULL DEFAULT '0',
  `expiration` int(10) unsigned NOT NULL DEFAULT '0',
  `message` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cdb_adminnotes`
--

LOCK TABLES `cdb_adminnotes` WRITE;
/*!40000 ALTER TABLE `cdb_adminnotes` DISABLE KEYS */;
/*!40000 ALTER TABLE `cdb_adminnotes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cdb_adminsessions`
--

DROP TABLE IF EXISTS `cdb_adminsessions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cdb_adminsessions` (
  `uid` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `adminid` smallint(6) unsigned NOT NULL DEFAULT '0',
  `panel` tinyint(1) NOT NULL DEFAULT '0',
  `ip` varchar(15) NOT NULL DEFAULT '',
  `dateline` int(10) unsigned NOT NULL DEFAULT '0',
  `errorcount` tinyint(1) NOT NULL DEFAULT '0',
  `storage` mediumtext NOT NULL,
  PRIMARY KEY (`uid`,`panel`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cdb_adminsessions`
--

LOCK TABLES `cdb_adminsessions` WRITE;
/*!40000 ALTER TABLE `cdb_adminsessions` DISABLE KEYS */;
/*!40000 ALTER TABLE `cdb_adminsessions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cdb_advertisements`
--

DROP TABLE IF EXISTS `cdb_advertisements`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cdb_advertisements` (
  `advid` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `available` tinyint(1) NOT NULL DEFAULT '0',
  `type` varchar(50) NOT NULL DEFAULT '0',
  `displayorder` tinyint(3) NOT NULL DEFAULT '0',
  `title` varchar(255) NOT NULL DEFAULT '',
  `targets` text NOT NULL,
  `parameters` text NOT NULL,
  `code` text NOT NULL,
  `starttime` int(10) unsigned NOT NULL DEFAULT '0',
  `endtime` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`advid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cdb_advertisements`
--

LOCK TABLES `cdb_advertisements` WRITE;
/*!40000 ALTER TABLE `cdb_advertisements` DISABLE KEYS */;
/*!40000 ALTER TABLE `cdb_advertisements` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cdb_announcements`
--

DROP TABLE IF EXISTS `cdb_announcements`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cdb_announcements` (
  `id` smallint(6) unsigned NOT NULL AUTO_INCREMENT,
  `author` varchar(15) NOT NULL DEFAULT '',
  `subject` varchar(255) NOT NULL DEFAULT '',
  `type` tinyint(1) NOT NULL DEFAULT '0',
  `displayorder` tinyint(3) NOT NULL DEFAULT '0',
  `starttime` int(10) unsigned NOT NULL DEFAULT '0',
  `endtime` int(10) unsigned NOT NULL DEFAULT '0',
  `message` text NOT NULL,
  `groups` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `timespan` (`starttime`,`endtime`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cdb_announcements`
--

LOCK TABLES `cdb_announcements` WRITE;
/*!40000 ALTER TABLE `cdb_announcements` DISABLE KEYS */;
/*!40000 ALTER TABLE `cdb_announcements` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cdb_attachmentfields`
--

DROP TABLE IF EXISTS `cdb_attachmentfields`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cdb_attachmentfields` (
  `aid` mediumint(8) unsigned NOT NULL,
  `tid` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `pid` int(10) unsigned NOT NULL DEFAULT '0',
  `uid` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `description` varchar(255) NOT NULL,
  PRIMARY KEY (`aid`),
  KEY `tid` (`tid`),
  KEY `pid` (`pid`,`aid`),
  KEY `uid` (`uid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cdb_attachmentfields`
--

LOCK TABLES `cdb_attachmentfields` WRITE;
/*!40000 ALTER TABLE `cdb_attachmentfields` DISABLE KEYS */;
/*!40000 ALTER TABLE `cdb_attachmentfields` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cdb_attachments`
--

DROP TABLE IF EXISTS `cdb_attachments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cdb_attachments` (
  `aid` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `tid` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `pid` int(10) unsigned NOT NULL DEFAULT '0',
  `width` smallint(6) unsigned NOT NULL DEFAULT '0',
  `dateline` int(10) unsigned NOT NULL DEFAULT '0',
  `readperm` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `price` smallint(6) unsigned NOT NULL DEFAULT '0',
  `filename` char(100) NOT NULL DEFAULT '',
  `filetype` char(50) NOT NULL DEFAULT '',
  `filesize` int(10) unsigned NOT NULL DEFAULT '0',
  `attachment` char(100) NOT NULL DEFAULT '',
  `downloads` mediumint(8) NOT NULL DEFAULT '0',
  `isimage` tinyint(1) NOT NULL DEFAULT '0',
  `uid` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `thumb` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `remote` tinyint(1) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`aid`),
  KEY `tid` (`tid`),
  KEY `pid` (`pid`,`aid`),
  KEY `uid` (`uid`),
  KEY `dateline` (`dateline`,`isimage`,`downloads`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cdb_attachments`
--

LOCK TABLES `cdb_attachments` WRITE;
/*!40000 ALTER TABLE `cdb_attachments` DISABLE KEYS */;
/*!40000 ALTER TABLE `cdb_attachments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cdb_attachpaymentlog`
--

DROP TABLE IF EXISTS `cdb_attachpaymentlog`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cdb_attachpaymentlog` (
  `uid` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `aid` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `authorid` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `dateline` int(10) unsigned NOT NULL DEFAULT '0',
  `amount` int(10) unsigned NOT NULL DEFAULT '0',
  `netamount` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`aid`,`uid`),
  KEY `uid` (`uid`),
  KEY `authorid` (`authorid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cdb_attachpaymentlog`
--

LOCK TABLES `cdb_attachpaymentlog` WRITE;
/*!40000 ALTER TABLE `cdb_attachpaymentlog` DISABLE KEYS */;
/*!40000 ALTER TABLE `cdb_attachpaymentlog` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cdb_attachtypes`
--

DROP TABLE IF EXISTS `cdb_attachtypes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cdb_attachtypes` (
  `id` smallint(6) unsigned NOT NULL AUTO_INCREMENT,
  `extension` char(12) NOT NULL DEFAULT '',
  `maxsize` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cdb_attachtypes`
--

LOCK TABLES `cdb_attachtypes` WRITE;
/*!40000 ALTER TABLE `cdb_attachtypes` DISABLE KEYS */;
/*!40000 ALTER TABLE `cdb_attachtypes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cdb_banned`
--

DROP TABLE IF EXISTS `cdb_banned`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cdb_banned` (
  `id` smallint(6) unsigned NOT NULL AUTO_INCREMENT,
  `ip1` smallint(3) NOT NULL DEFAULT '0',
  `ip2` smallint(3) NOT NULL DEFAULT '0',
  `ip3` smallint(3) NOT NULL DEFAULT '0',
  `ip4` smallint(3) NOT NULL DEFAULT '0',
  `admin` varchar(15) NOT NULL DEFAULT '',
  `dateline` int(10) unsigned NOT NULL DEFAULT '0',
  `expiration` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cdb_banned`
--

LOCK TABLES `cdb_banned` WRITE;
/*!40000 ALTER TABLE `cdb_banned` DISABLE KEYS */;
/*!40000 ALTER TABLE `cdb_banned` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cdb_bbcodes`
--

DROP TABLE IF EXISTS `cdb_bbcodes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cdb_bbcodes` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `available` tinyint(1) NOT NULL DEFAULT '0',
  `tag` varchar(100) NOT NULL DEFAULT '',
  `icon` varchar(255) NOT NULL,
  `replacement` text NOT NULL,
  `example` varchar(255) NOT NULL DEFAULT '',
  `explanation` text NOT NULL,
  `params` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `prompt` text NOT NULL,
  `nest` tinyint(3) unsigned NOT NULL DEFAULT '1',
  `displayorder` tinyint(3) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cdb_bbcodes`
--

LOCK TABLES `cdb_bbcodes` WRITE;
/*!40000 ALTER TABLE `cdb_bbcodes` DISABLE KEYS */;
INSERT INTO `cdb_bbcodes` VALUES (1,0,'fly','bb_fly.gif','<marquee width=\"90%\" behavior=\"alternate\" scrollamount=\"3\">{1}</marquee>','[fly]This is sample text[/fly]','使內容橫向滾動，這個效果類似 HTML 的 marquee 標籤，注意：這個效果只在 Internet Explorer 瀏覽器下有效。',1,'請輸入滾動顯示的文字:',1,19),(2,1,'qq','bb_qq.gif','<a href=\"http://wpa.qq.com/msgrd?V=1&Uin={1}&amp;Site=[Discuz!]&amp;Menu=yes\" target=\"_blank\"><img src=\"http://wpa.qq.com/pa?p=1:{1}:1\" border=\"0\"></a>','[qq]688888[/qq]','顯示 QQ 在線狀態，點這個圖標可以和他（她）聊天',1,'請輸入顯示在線狀態 QQ 號碼:',1,21),(3,0,'sup','bb_sup.gif','<sup>{1}</sup>','X[sup]2[/sup]','上標',1,'請輸入上標文字：',1,22),(4,0,'sub','bb_sub.gif','<sub>{1}</sub>','X[sub]2[/sub]','下標',1,'請輸入下標文字：',1,23);
/*!40000 ALTER TABLE `cdb_bbcodes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cdb_caches`
--

DROP TABLE IF EXISTS `cdb_caches`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cdb_caches` (
  `cachename` varchar(32) NOT NULL,
  `type` tinyint(3) unsigned NOT NULL,
  `dateline` int(10) unsigned NOT NULL,
  `expiration` int(10) unsigned NOT NULL,
  `data` mediumtext NOT NULL,
  PRIMARY KEY (`cachename`),
  KEY `expiration` (`type`,`expiration`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cdb_caches`
--

LOCK TABLES `cdb_caches` WRITE;
/*!40000 ALTER TABLE `cdb_caches` DISABLE KEYS */;
INSERT INTO `cdb_caches` VALUES ('settings',1,1310993153,0,'$_DCACHE[\'settings\'] = array (\n  \'accessemail\' => \'\',\n  \'activitytype\' => \'朋友聚會\r\n出外郊遊\r\n自駕出行\r\n公益活動\r\n線上活動\',\n  \'adminipaccess\' => \'\',\n  \'admode\' => \'1\',\n  \'archiverstatus\' => \'1\',\n  \'attachbanperiods\' => \'\',\n  \'attachdir\' => \'C:/wamp/www/upload/bbs/./attachments\',\n  \'attachexpire\' => \'\',\n  \'attachimgpost\' => \'1\',\n  \'attachrefcheck\' => \'0\',\n  \'attachsave\' => \'3\',\n  \'attachurl\' => \'attachments\',\n  \'authkey\' => \'6182c8e2F3NS3juS\',\n  \'authoronleft\' => \'0\',\n  \'avatarmethod\' => \'0\',\n  \'baidusitemap\' => \'1\',\n  \'baidusitemap_life\' => \'12\',\n  \'bannedmessages\' => \'1\',\n  \'bbclosed\' => \'\',\n  \'bbname\' => \'Discuz! Board\',\n  \'bdaystatus\' => \'0\',\n  \'boardlicensed\' => \'0\',\n  \'cacheindexlife\' => \'0\',\n  \'cachethreaddir\' => \'forumdata/threadcaches\',\n  \'cachethreadlife\' => \'0\',\n  \'censoremail\' => \'\',\n  \'censoruser\' => \'\',\n  \'creditnotice\' => \'1\',\n  \'creditsformula\' => \'$member[\\\'extcredits1\\\']\',\n  \'creditsformulaexp\' => \'\',\n  \'creditspolicy\' => \n  array (\n    \'post\' => \n    array (\n    ),\n    \'reply\' => \n    array (\n    ),\n    \'digest\' => \n    array (\n      1 => 10,\n    ),\n    \'postattach\' => \n    array (\n    ),\n    \'getattach\' => \n    array (\n    ),\n    \'sendpm\' => \n    array (\n    ),\n    \'search\' => \n    array (\n    ),\n    \'promotion_visit\' => \n    array (\n    ),\n    \'promotion_register\' => \n    array (\n    ),\n    \'tradefinished\' => \n    array (\n    ),\n    \'votepoll\' => \n    array (\n    ),\n    \'lowerlimit\' => \n    array (\n    ),\n  ),\n  \'creditstax\' => \'0.2\',\n  \'creditstrans\' => \'2\',\n  \'dateconvert\' => \'1\',\n  \'dateformat\' => \'Y-n-j\',\n  \'debug\' => \'1\',\n  \'delayviewcount\' => \'0\',\n  \'deletereason\' => \'\',\n  \'disallowfloat\' => \'newthread|reply\',\n  \'doublee\' => \'1\',\n  \'dupkarmarate\' => \'0\',\n  \'dzfeed_limit\' => \n  array (\n    \'thread_replies\' => \n    array (\n      0 => \'100\',\n      1 => \'1000\',\n      2 => \'2000\',\n      3 => \'10000\',\n    ),\n    \'thread_views\' => \n    array (\n      0 => \'500\',\n      1 => \'5000\',\n      2 => \'10000\',\n    ),\n    \'thread_rate\' => \n    array (\n      0 => \'50\',\n      1 => \'200\',\n      2 => \'500\',\n    ),\n    \'post_rate\' => \n    array (\n      0 => \'20\',\n      1 => \'100\',\n      2 => \'300\',\n    ),\n    \'user_usergroup\' => \n    array (\n      0 => \'12\',\n      1 => \'13\',\n      2 => \'14\',\n      3 => \'15\',\n    ),\n    \'user_credit\' => \n    array (\n      0 => \'1000\',\n      1 => \'10000\',\n      2 => \'100000\',\n    ),\n    \'user_threads\' => \n    array (\n      0 => \'100\',\n      1 => \'500\',\n      2 => \'1000\',\n      3 => \'5000\',\n      4 => \'10000\',\n    ),\n    \'user_posts\' => \n    array (\n      0 => \'500\',\n      1 => \'1000\',\n      2 => \'5000\',\n      3 => \'10000\',\n    ),\n    \'user_digest\' => \n    array (\n      0 => \'50\',\n      1 => \'100\',\n      2 => \'500\',\n      3 => \'1000\',\n    ),\n  ),\n  \'ec_account\' => \'\',\n  \'ec_credit\' => \n  array (\n    \'maxcreditspermonth\' => 6,\n    \'rank\' => \n    array (\n      1 => 4,\n      2 => 11,\n      3 => 41,\n      4 => 91,\n      5 => 151,\n      6 => 251,\n      7 => 501,\n      8 => 1001,\n      9 => 2001,\n      10 => 5001,\n      11 => 10001,\n      12 => 20001,\n      13 => 50001,\n      14 => 100001,\n      15 => 200001,\n    ),\n  ),\n  \'ec_maxcredits\' => \'1000\',\n  \'ec_maxcreditspermonth\' => \'0\',\n  \'ec_mincredits\' => \'0\',\n  \'ec_ratio\' => \'0\',\n  \'ec_tenpay_bargainor\' => \'\',\n  \'ec_tenpay_key\' => \'\',\n  \'editedby\' => \'1\',\n  \'editoroptions\' => \'1\',\n  \'edittimelimit\' => \'\',\n  \'exchangemincredits\' => \'100\',\n  \'extcredits\' => \n  array (\n    1 => \n    array (\n      \'title\' => \'威望\',\n      \'showinthread\' => \'\',\n      \'img\' => \'\',\n    ),\n    2 => \n    array (\n      \'title\' => \'金錢\',\n      \'showinthread\' => \'\',\n      \'img\' => \'\',\n    ),\n  ),\n  \'fastpost\' => \'1\',\n  \'floodctrl\' => \'15\',\n  \'forumjump\' => \'0\',\n  \'forumlinkstatus\' => \'1\',\n  \'frameon\' => \'0\',\n  \'framewidth\' => \'180\',\n  \'ftp\' => \n  array (\n    \'on\' => \'0\',\n    \'ssl\' => \'0\',\n    \'host\' => \'\',\n    \'port\' => \'21\',\n    \'username\' => \'\',\n    \'password\' => \'\',\n    \'attachdir\' => \'.\',\n    \'attachurl\' => \'\',\n    \'hideurl\' => \'0\',\n    \'timeout\' => \'0\',\n    \'connid\' => 0,\n  ),\n  \'globalstick\' => \'1\',\n  \'google\' => \'1\',\n  \'gzipcompress\' => \'0\',\n  \'heatthread\' => \n  array (\n    \'reply\' => 5,\n    \'recommend\' => 3,\n    \'hottopic\' => \'50,100,200\',\n    \'iconlevels\' => \n    array (\n    ),\n  ),\n  \'hideprivate\' => \'1\',\n  \'historyposts\' => \'1	1\',\n  \'hottopic\' => \'10\',\n  \'icp\' => \'\',\n  \'imagelib\' => \'0\',\n  \'indexhot\' => false,\n  \'indexname\' => \'index.php\',\n  \'indextype\' => \'classics\',\n  \'infosidestatus\' => false,\n  \'initcredits\' => \'0,0,0,0,0,0,0,0,0\',\n  \'ipaccess\' => \'\',\n  \'jscachelife\' => \'1800\',\n  \'jsdateformat\' => \'\',\n  \'jspath\' => \'forumdata/cache/\',\n  \'jsrefdomains\' => \'\',\n  \'jsstatus\' => \'0\',\n  \'karmaratelimit\' => \'0\',\n  \'loadctrl\' => \'0\',\n  \'losslessdel\' => \'365\',\n  \'magicdiscount\' => \'85\',\n  \'magicmarket\' => \'1\',\n  \'magicstatus\' => \'1\',\n  \'mail\' => \'a:10:{s:8:\"mailsend\";s:1:\"1\";s:6:\"server\";s:13:\"smtp.21cn.com\";s:4:\"port\";s:2:\"25\";s:4:\"auth\";s:1:\"1\";s:4:\"from\";s:26:\"Discuz <username@21cn.com>\";s:13:\"auth_username\";s:17:\"username@21cn.com\";s:13:\"auth_password\";s:8:\"password\";s:13:\"maildelimiter\";s:1:\"0\";s:12:\"mailusername\";s:1:\"1\";s:15:\"sendmail_silent\";s:1:\"1\";}\',\n  \'maxavatarpixel\' => \'120\',\n  \'maxavatarsize\' => \'20000\',\n  \'maxbdays\' => \'0\',\n  \'maxchargespan\' => \'0\',\n  \'maxfavorites\' => \'100\',\n  \'maxincperthread\' => \'0\',\n  \'maxmagicprice\' => \'50\',\n  \'maxmodworksmonths\' => \'3\',\n  \'maxonlinelist\' => \'0\',\n  \'maxpolloptions\' => \'10\',\n  \'maxpostsize\' => \'10000\',\n  \'maxsearchresults\' => \'500\',\n  \'maxsigrows\' => \'100\',\n  \'maxsmilies\' => \'10\',\n  \'maxspm\' => \'0\',\n  \'membermaxpages\' => \'100\',\n  \'memberperpage\' => \'25\',\n  \'memliststatus\' => \'1\',\n  \'minpostsize\' => \'10\',\n  \'moddisplay\' => \'flat\',\n  \'modratelimit\' => \'0\',\n  \'modworkstatus\' => \'1\',\n  \'msgforward\' => \'a:3:{s:11:\"refreshtime\";i:3;s:5:\"quick\";i:1;s:8:\"messages\";a:13:{i:0;s:19:\"thread_poll_succeed\";i:1;s:19:\"thread_rate_succeed\";i:2;s:23:\"usergroups_join_succeed\";i:3;s:23:\"usergroups_exit_succeed\";i:4;s:25:\"usergroups_update_succeed\";i:5;s:20:\"buddy_update_succeed\";i:6;s:17:\"post_edit_succeed\";i:7;s:18:\"post_reply_succeed\";i:8;s:24:\"post_edit_delete_succeed\";i:9;s:22:\"post_newthread_succeed\";i:10;s:13:\"admin_succeed\";i:11;s:17:\"pm_delete_succeed\";i:12;s:15:\"search_redirect\";}}\',\n  \'msn\' => \n  array (\n    \'on\' => 0,\n    \'domain\' => \'discuz.org\',\n  ),\n  \'newbiespan\' => \'0\',\n  \'newbietasks\' => \n  array (\n  ),\n  \'newbietaskupdate\' => \'\',\n  \'nocacheheaders\' => \'0\',\n  \'oltimespan\' => \'10\',\n  \'onlinehold\' => 900,\n  \'onlinerecord\' => \'1	1040034649\',\n  \'outextcredits\' => \n  array (\n    \'|\' => \n    array (\n      \'title\' => NULL,\n      \'unit\' => NULL,\n      \'ratiosrc\' => \n      array (\n        \'\' => NULL,\n      ),\n      \'ratiodesc\' => \n      array (\n        \'\' => NULL,\n      ),\n      \'creditsrc\' => \n      array (\n        \'\' => NULL,\n      ),\n    ),\n  ),\n  \'postbanperiods\' => \'\',\n  \'postmodperiods\' => \'\',\n  \'postperpage\' => \'10\',\n  \'pvfrequence\' => \'60\',\n  \'pwdsafety\' => \'\',\n  \'qihoo\' => \n  array (\n  ),\n  \'ratelogrecord\' => \'5\',\n  \'recommendthread\' => \n  array (\n    \'allow\' => 0,\n  ),\n  \'regctrl\' => \'0\',\n  \'regfloodctrl\' => \'0\',\n  \'reglinkname\' => \'註冊\',\n  \'regname\' => \'register.php\',\n  \'regstatus\' => \'1\',\n  \'regverify\' => \'0\',\n  \'relatedtag\' => false,\n  \'reportpost\' => \'1\',\n  \'rewritecompatible\' => \'\',\n  \'rewritestatus\' => \'0\',\n  \'rssstatus\' => \'1\',\n  \'rssttl\' => \'60\',\n  \'runwizard\' => \'1\',\n  \'searchbanperiods\' => \'\',\n  \'searchctrl\' => \'30\',\n  \'seccodedata\' => \n  array (\n    \'minposts\' => \'\',\n    \'loginfailedcount\' => 0,\n    \'width\' => 150,\n    \'height\' => 60,\n    \'type\' => \'0\',\n    \'background\' => \'1\',\n    \'adulterate\' => \'1\',\n    \'ttf\' => \'0\',\n    \'angle\' => \'0\',\n    \'color\' => \'1\',\n    \'size\' => \'0\',\n    \'shadow\' => \'1\',\n    \'animator\' => \'0\',\n  ),\n  \'seccodestatus\' => \'0\',\n  \'seclevel\' => \'1\',\n  \'secqaa\' => \n  array (\n    \'status\' => \n    array (\n      1 => \'0\',\n      2 => \'0\',\n      3 => \'0\',\n    ),\n  ),\n  \'seodescription\' => \'\',\n  \'seohead\' => \'\',\n  \'seokeywords\' => \'\',\n  \'seotitle\' => \'\',\n  \'showemail\' => \'\',\n  \'showimages\' => \'1\',\n  \'showsettings\' => \'7\',\n  \'sigviewcond\' => \'0\',\n  \'sitemessage\' => \n  array (\n    \'time\' => 0,\n    \'register\' => \'\',\n    \'login\' => \'\',\n    \'newthread\' => \'\',\n    \'reply\' => \'\',\n  ),\n  \'sitename\' => \'Comsenz Inc.\',\n  \'siteurl\' => \'http://www.comsenz.com/\',\n  \'smcols\' => \'8\',\n  \'smrows\' => \'5\',\n  \'smthumb\' => \'20\',\n  \'spacedata\' => \n  array (\n    \'cachelife\' => \'900\',\n    \'limitmythreads\' => \'5\',\n    \'limitmyreplies\' => \'5\',\n    \'limitmyrewards\' => \'5\',\n    \'limitmytrades\' => \'5\',\n    \'limitmyvideos\' => \'0\',\n    \'limitmyblogs\' => \'8\',\n    \'limitmyfriends\' => \'0\',\n    \'limitmyfavforums\' => \'5\',\n    \'limitmyfavthreads\' => \'0\',\n    \'textlength\' => \'300\',\n  ),\n  \'spacestatus\' => \'1\',\n  \'starthreshold\' => \'2\',\n  \'statcode\' => \'\',\n  \'statscachelife\' => \'180\',\n  \'statstatus\' => \'\',\n  \'styleid\' => \'1\',\n  \'stylejump\' => \'1\',\n  \'subforumsindex\' => \'\',\n  \'swfupload\' => \'1\',\n  \'tagstatus\' => \'1\',\n  \'taskon\' => \'0\',\n  \'threadmaxpages\' => \'1000\',\n  \'threadsticky\' => \n  array (\n    0 => \'全局置頂\',\n    1 => \'分類置頂\',\n    2 => \'本版置頂\',\n  ),\n  \'thumbheight\' => \'300\',\n  \'thumbquality\' => \'100\',\n  \'thumbstatus\' => \'0\',\n  \'thumbwidth\' => \'400\',\n  \'timeformat\' => \'H:i\',\n  \'timeoffset\' => \'8\',\n  \'topicperpage\' => \'20\',\n  \'tradetypes\' => \n  array (\n  ),\n  \'transfermincredits\' => \'1000\',\n  \'transsidstatus\' => \'0\',\n  \'uc\' => \n  array (\n    \'addfeed\' => 1,\n  ),\n  \'ucactivation\' => \'1\',\n  \'upgradeurl\' => \'http://localhost/develop/dzhead/develop/upgrade.php\',\n  \'userdateformat\' => \n  array (\n    0 => \'Y-n-j\',\n    1 => \'Y/n/j\',\n    2 => \'j-n-Y\',\n    3 => \'j/n/Y\',\n  ),\n  \'userstatusby\' => \'1\',\n  \'viewthreadtags\' => \'100\',\n  \'visitbanperiods\' => \'\',\n  \'visitedforums\' => \'10\',\n  \'vtonlinestatus\' => \'1\',\n  \'wapcharset\' => \'2\',\n  \'wapdateformat\' => \'n/j\',\n  \'wapmps\' => \'500\',\n  \'wapppp\' => \'5\',\n  \'wapregister\' => \'0\',\n  \'wapstatus\' => \'0\',\n  \'waptpp\' => \'10\',\n  \'warningexpiration\' => \'3\',\n  \'warninglimit\' => \'3\',\n  \'watermarkminheight\' => \'0\',\n  \'watermarkminwidth\' => \'0\',\n  \'watermarkquality\' => \'80\',\n  \'watermarkstatus\' => \'0\',\n  \'watermarktext\' => \n  array (\n  ),\n  \'watermarktrans\' => \'65\',\n  \'watermarktype\' => \'0\',\n  \'welcomemsgtitle\' => \'{username}，您好，感謝您的註冊，請閱讀以下內容。\',\n  \'whosonlinestatus\' => \'1\',\n  \'whosonline_contract\' => \'0\',\n  \'zoomstatus\' => \'1\',\n  \'ratelogon\' => \'0\',\n  \'forumseparator\' => \'1\',\n  \'allowattachurl\' => \'0\',\n  \'allowviewuserthread\' => \'\',\n  \'tasktypes\' => \'a:3:{s:9:\"promotion\";a:2:{s:4:\"name\";s:18:\"論壇推廣任務\";s:7:\"version\";s:3:\"1.0\";}s:4:\"gift\";a:2:{s:4:\"name\";s:15:\"紅包類任務\";s:7:\"version\";s:3:\"1.0\";}s:6:\"avatar\";a:2:{s:4:\"name\";s:15:\"頭像類任務\";s:7:\"version\";s:3:\"1.0\";}}\',\n  \'version\' => \'7.2\',\n  \'totalmembers\' => \'1\',\n  \'lastmember\' => \'admin\',\n  \'cachethreadon\' => 0,\n  \'cronnextrun\' => \'1310996753\',\n  \'styles\' => \n  array (\n    1 => \'默認風格\',\n  ),\n  \'stylejumpstatus\' => false,\n  \'globaladvs\' => \n  array (\n  ),\n  \'redirectadvs\' => \n  array (\n  ),\n  \'invitecredit\' => \'\',\n  \'creditnames\' => \'1|威望|,2|金錢|\',\n  \'creditstransextra\' => \n  array (\n    1 => \'2\',\n    2 => \'2\',\n    3 => \'2\',\n    4 => \'2\',\n    5 => \'2\',\n  ),\n  \'exchangestatus\' => false,\n  \'transferstatus\' => true,\n  \'imagemaxwidth\' => NULL,\n  \'promptpmids\' => \n  array (\n    0 => \'4\',\n    1 => \'5\',\n    2 => \'6\',\n  ),\n  \'promptkeys\' => \n  array (\n    1 => \'pm\',\n    2 => \'announcepm\',\n    4 => \'systempm\',\n    5 => \'friend\',\n    6 => \'threads\',\n  ),\n  \'prompts\' => \n  array (\n    \'pm\' => \n    array (\n      \'name\' => \'私人消息\',\n      \'script\' => \'pm.php?filter=newpm\',\n      \'id\' => \'1\',\n      \'new\' => 0,\n    ),\n    \'announcepm\' => \n    array (\n      \'name\' => \'公共消息\',\n      \'script\' => \'pm.php?filter=announcepm\',\n      \'id\' => \'2\',\n      \'new\' => 0,\n    ),\n    \'systempm\' => \n    array (\n      \'name\' => \'系統消息\',\n      \'script\' => \'\',\n      \'id\' => \'4\',\n      \'new\' => 0,\n    ),\n    \'friend\' => \n    array (\n      \'name\' => \'好友消息\',\n      \'script\' => \'\',\n      \'id\' => \'5\',\n      \'new\' => 0,\n    ),\n    \'threads\' => \n    array (\n      \'name\' => \'帖子消息\',\n      \'script\' => \'\',\n      \'id\' => \'6\',\n      \'new\' => 0,\n    ),\n  ),\n  \'announcepm\' => \'0\',\n  \'specialicon\' => \n  array (\n  ),\n  \'threadplugins\' => \n  array (\n  ),\n  \'hookscript\' => \n  array (\n  ),\n  \'pluginlinks\' => \n  array (\n  ),\n  \'templatelangs\' => \n  array (\n  ),\n  \'pluginlangs\' => \n  array (\n  ),\n  \'plugins\' => \n  array (\n    \'available\' => \n    array (\n    ),\n  ),\n  \'my_status\' => 0,\n  \'tradeopen\' => 1,\n  \'hooks\' => \n  array (\n  ),\n  \'navmns\' => \n  array (\n    0 => \'index\',\n    1 => \'index\',\n    2 => \'search\',\n    3 => \'faq\',\n  ),\n  \'subnavs\' => \n  array (\n  ),\n  \'navs\' => \n  array (\n    1 => \n    array (\n      \'nav\' => \'<li class=\"menu_1\"><a href=\"index.php\" hidefocus=\"true\" id=\"mn_index\">論壇</a></li>\',\n      \'level\' => \'0\',\n    ),\n    2 => \n    array (\n      \'nav\' => \'<li class=\"menu_2\"><a href=\"search.php\" hidefocus=\"true\" id=\"mn_search\">搜索</a></li>\',\n      \'level\' => \'0\',\n    ),\n    3 => \n    array (\n      \'nav\' => \'\',\n      \'level\' => \'0\',\n    ),\n    4 => \n    array (\n      \'nav\' => \'<li class=\"menu_4\"><a href=\"faq.php\" hidefocus=\"true\" id=\"mn_faq\">幫助</a></li>\',\n      \'level\' => \'0\',\n    ),\n    5 => \n    array (\n      \'nav\' => \'<li class=\"menu_5\"><a href=\"misc.php?action=nav\" hidefocus=\"true\" onclick=\"showWindow(\\\'nav\\\', this.href);return false;\">導航</a></li>\',\n      \'level\' => \'0\',\n    ),\n  ),\n  \'allowsynlogin\' => 1,\n  \'ucappopen\' => \n  array (\n    \'UCHOME\' => 1,\n  ),\n  \'ucapp\' => \n  array (\n  ),\n  \'uchomeurl\' => \'http://127.0.0.1/upload/home\',\n  \'homeshow\' => \'0\',\n  \'medalstatus\' => 0,\n  \'dlang\' => \n  array (\n    \'nextpage\' => \'下一頁\',\n    \'date\' => \n    array (\n      0 => \'前\',\n      1 => \'天\',\n      2 => \'昨天\',\n      3 => \'前天\',\n      4 => \'小時\',\n      5 => \'半\',\n      6 => \'分鐘\',\n      7 => \'秒\',\n      8 => \'剛才\',\n    ),\n  ),\n);\n\n'),('forums',1,1310993153,0,'$_DCACHE[\'forums\'] = array (\n  1 => \n  array (\n    \'fid\' => \'1\',\n    \'type\' => \'group\',\n    \'name\' => \'Discuz!\',\n    \'fup\' => \'0\',\n    \'viewperm\' => \'\',\n    \'orderby\' => \'lastpost\',\n    \'ascdesc\' => \'DESC\',\n    \'status\' => \'1\',\n    \'extra\' => \n    array (\n    ),\n  ),\n  2 => \n  array (\n    \'fid\' => \'2\',\n    \'type\' => \'forum\',\n    \'name\' => \'默認版塊\',\n    \'fup\' => \'1\',\n    \'viewperm\' => \'\',\n    \'orderby\' => \'lastpost\',\n    \'ascdesc\' => \'DESC\',\n    \'users\' => NULL,\n    \'status\' => \'1\',\n    \'extra\' => \n    array (\n    ),\n  ),\n);\n\n'),('icons',1,1310993153,0,'$_DCACHE[\'icons\'] = array (\n  65 => \'icon1.gif\',\n  66 => \'icon2.gif\',\n  67 => \'icon3.gif\',\n  68 => \'icon4.gif\',\n  69 => \'icon5.gif\',\n  70 => \'icon6.gif\',\n  71 => \'icon7.gif\',\n  72 => \'icon8.gif\',\n  73 => \'icon9.gif\',\n  74 => \'icon10.gif\',\n  75 => \'icon11.gif\',\n  76 => \'icon12.gif\',\n  77 => \'icon13.gif\',\n  78 => \'icon14.gif\',\n  79 => \'icon15.gif\',\n  80 => \'icon16.gif\',\n);\n\n'),('stamps',1,1310993153,0,'$_DCACHE[\'stamps\'] = array (\n  0 => \n  array (\n    \'url\' => \'001.gif\',\n    \'text\' => \'精華\',\n  ),\n  1 => \n  array (\n    \'url\' => \'002.gif\',\n    \'text\' => \'熱帖\',\n  ),\n  2 => \n  array (\n    \'url\' => \'003.gif\',\n    \'text\' => \'美圖\',\n  ),\n  3 => \n  array (\n    \'url\' => \'004.gif\',\n    \'text\' => \'優秀\',\n  ),\n  4 => \n  array (\n    \'url\' => \'005.gif\',\n    \'text\' => \'置頂\',\n  ),\n  5 => \n  array (\n    \'url\' => \'006.gif\',\n    \'text\' => \'推薦\',\n  ),\n  6 => \n  array (\n    \'url\' => \'007.gif\',\n    \'text\' => \'原創\',\n  ),\n  7 => \n  array (\n    \'url\' => \'008.gif\',\n    \'text\' => \'版主推薦\',\n  ),\n  8 => \n  array (\n    \'url\' => \'009.gif\',\n    \'text\' => \'爆料\',\n  ),\n);\n\n'),('ranks',1,1310993153,0,'$_DCACHE[\'ranks\'] = array (\n);\n\n'),('usergroups',1,1310993153,0,'$_DCACHE[\'usergroups\'] = array (\n  1 => \n  array (\n    \'type\' => \'system\',\n    \'grouptitle\' => \'管理員\',\n    \'stars\' => \'9\',\n    \'groupavatar\' => \'\',\n    \'readaccess\' => \'200\',\n    \'allowcusbbcode\' => \'1\',\n    \'allowgetattach\' => \'1\',\n    \'edittimelimit\' => \'0\',\n    \'userstatusby\' => 1,\n  ),\n  18 => \n  array (\n    \'type\' => \'special\',\n    \'grouptitle\' => \'信息監察員\',\n    \'stars\' => \'9\',\n    \'groupavatar\' => \'\',\n    \'readaccess\' => \'200\',\n    \'allowcusbbcode\' => \'1\',\n    \'allowgetattach\' => \'1\',\n    \'edittimelimit\' => \'0\',\n    \'userstatusby\' => 1,\n  ),\n  17 => \n  array (\n    \'type\' => \'special\',\n    \'grouptitle\' => \'網站編輯\',\n    \'stars\' => \'8\',\n    \'groupavatar\' => \'\',\n    \'readaccess\' => \'150\',\n    \'allowcusbbcode\' => \'1\',\n    \'allowgetattach\' => \'1\',\n    \'edittimelimit\' => \'0\',\n    \'userstatusby\' => 1,\n  ),\n  16 => \n  array (\n    \'type\' => \'special\',\n    \'grouptitle\' => \'實習版主\',\n    \'stars\' => \'7\',\n    \'groupavatar\' => \'\',\n    \'readaccess\' => \'100\',\n    \'allowcusbbcode\' => \'1\',\n    \'allowgetattach\' => \'1\',\n    \'edittimelimit\' => \'0\',\n    \'userstatusby\' => 1,\n  ),\n  19 => \n  array (\n    \'type\' => \'special\',\n    \'grouptitle\' => \'審核員\',\n    \'stars\' => \'7\',\n    \'groupavatar\' => \'\',\n    \'readaccess\' => \'100\',\n    \'allowcusbbcode\' => \'1\',\n    \'allowgetattach\' => \'1\',\n    \'edittimelimit\' => \'0\',\n    \'userstatusby\' => 1,\n  ),\n  9 => \n  array (\n    \'type\' => \'member\',\n    \'grouptitle\' => \'乞丐\',\n    \'creditshigher\' => \'-9999999\',\n    \'creditslower\' => \'0\',\n    \'stars\' => \'0\',\n    \'groupavatar\' => \'\',\n    \'readaccess\' => \'0\',\n    \'allowcusbbcode\' => \'0\',\n    \'allowgetattach\' => \'0\',\n    \'edittimelimit\' => \'0\',\n    \'userstatusby\' => 1,\n  ),\n  8 => \n  array (\n    \'type\' => \'system\',\n    \'grouptitle\' => \'等待驗證會員\',\n    \'stars\' => \'0\',\n    \'groupavatar\' => \'\',\n    \'readaccess\' => \'0\',\n    \'allowcusbbcode\' => \'0\',\n    \'allowgetattach\' => \'0\',\n    \'edittimelimit\' => \'0\',\n    \'userstatusby\' => 1,\n  ),\n  7 => \n  array (\n    \'type\' => \'system\',\n    \'grouptitle\' => \'遊客\',\n    \'stars\' => \'0\',\n    \'groupavatar\' => \'\',\n    \'readaccess\' => \'1\',\n    \'allowcusbbcode\' => \'0\',\n    \'allowgetattach\' => \'0\',\n    \'edittimelimit\' => \'0\',\n    \'userstatusby\' => 1,\n  ),\n  6 => \n  array (\n    \'type\' => \'system\',\n    \'grouptitle\' => \'禁止 IP\',\n    \'stars\' => \'0\',\n    \'groupavatar\' => \'\',\n    \'readaccess\' => \'0\',\n    \'allowcusbbcode\' => \'0\',\n    \'allowgetattach\' => \'0\',\n    \'edittimelimit\' => \'0\',\n    \'userstatusby\' => 1,\n  ),\n  5 => \n  array (\n    \'type\' => \'system\',\n    \'grouptitle\' => \'禁止訪問\',\n    \'stars\' => \'0\',\n    \'groupavatar\' => \'\',\n    \'readaccess\' => \'0\',\n    \'allowcusbbcode\' => \'0\',\n    \'allowgetattach\' => \'0\',\n    \'edittimelimit\' => \'0\',\n    \'userstatusby\' => 1,\n  ),\n  2 => \n  array (\n    \'type\' => \'system\',\n    \'grouptitle\' => \'超級版主\',\n    \'stars\' => \'8\',\n    \'groupavatar\' => \'\',\n    \'readaccess\' => \'150\',\n    \'allowcusbbcode\' => \'1\',\n    \'allowgetattach\' => \'1\',\n    \'edittimelimit\' => \'0\',\n    \'userstatusby\' => 1,\n  ),\n  3 => \n  array (\n    \'type\' => \'system\',\n    \'grouptitle\' => \'版主\',\n    \'stars\' => \'7\',\n    \'groupavatar\' => \'\',\n    \'readaccess\' => \'100\',\n    \'allowcusbbcode\' => \'1\',\n    \'allowgetattach\' => \'1\',\n    \'edittimelimit\' => \'0\',\n    \'userstatusby\' => 1,\n  ),\n  4 => \n  array (\n    \'type\' => \'system\',\n    \'grouptitle\' => \'禁止發言\',\n    \'stars\' => \'0\',\n    \'groupavatar\' => \'\',\n    \'readaccess\' => \'0\',\n    \'allowcusbbcode\' => \'0\',\n    \'allowgetattach\' => \'0\',\n    \'edittimelimit\' => \'0\',\n    \'userstatusby\' => 1,\n  ),\n  10 => \n  array (\n    \'type\' => \'member\',\n    \'grouptitle\' => \'新手上路\',\n    \'creditshigher\' => \'0\',\n    \'creditslower\' => \'50\',\n    \'stars\' => \'1\',\n    \'groupavatar\' => \'\',\n    \'readaccess\' => \'10\',\n    \'allowcusbbcode\' => \'0\',\n    \'allowgetattach\' => \'1\',\n    \'edittimelimit\' => \'0\',\n    \'userstatusby\' => 1,\n  ),\n  11 => \n  array (\n    \'type\' => \'member\',\n    \'grouptitle\' => \'註冊會員\',\n    \'creditshigher\' => \'50\',\n    \'creditslower\' => \'200\',\n    \'stars\' => \'2\',\n    \'groupavatar\' => \'\',\n    \'readaccess\' => \'20\',\n    \'allowcusbbcode\' => \'0\',\n    \'allowgetattach\' => \'1\',\n    \'edittimelimit\' => \'0\',\n    \'userstatusby\' => 1,\n  ),\n  12 => \n  array (\n    \'type\' => \'member\',\n    \'grouptitle\' => \'中級會員\',\n    \'creditshigher\' => \'200\',\n    \'creditslower\' => \'500\',\n    \'stars\' => \'3\',\n    \'groupavatar\' => \'\',\n    \'readaccess\' => \'30\',\n    \'allowcusbbcode\' => \'1\',\n    \'allowgetattach\' => \'1\',\n    \'edittimelimit\' => \'0\',\n    \'userstatusby\' => 1,\n  ),\n  13 => \n  array (\n    \'type\' => \'member\',\n    \'grouptitle\' => \'高級會員\',\n    \'creditshigher\' => \'500\',\n    \'creditslower\' => \'1000\',\n    \'stars\' => \'4\',\n    \'groupavatar\' => \'\',\n    \'readaccess\' => \'50\',\n    \'allowcusbbcode\' => \'1\',\n    \'allowgetattach\' => \'1\',\n    \'edittimelimit\' => \'0\',\n    \'userstatusby\' => 1,\n  ),\n  14 => \n  array (\n    \'type\' => \'member\',\n    \'grouptitle\' => \'金牌會員\',\n    \'creditshigher\' => \'1000\',\n    \'creditslower\' => \'3000\',\n    \'stars\' => \'6\',\n    \'groupavatar\' => \'\',\n    \'readaccess\' => \'70\',\n    \'allowcusbbcode\' => \'1\',\n    \'allowgetattach\' => \'1\',\n    \'edittimelimit\' => \'0\',\n    \'userstatusby\' => 1,\n  ),\n  15 => \n  array (\n    \'type\' => \'member\',\n    \'grouptitle\' => \'論壇元老\',\n    \'creditshigher\' => \'3000\',\n    \'creditslower\' => \'9999999\',\n    \'stars\' => \'8\',\n    \'groupavatar\' => \'\',\n    \'readaccess\' => \'90\',\n    \'allowcusbbcode\' => \'1\',\n    \'allowgetattach\' => \'1\',\n    \'edittimelimit\' => \'0\',\n    \'userstatusby\' => 1,\n  ),\n);\n\n'),('request',1,1310993153,0,'$_DCACHE[\'request\'] = array (\n  \'邊欄模塊_版塊樹形列表\' => \n  array (\n    \'url\' => \'function=module&module=forumtree.inc.php&settings=N%3B&jscharset=0&cachelife=864000\',\n    \'type\' => \'5\',\n  ),\n  \'邊欄模塊_版主排行\' => \n  array (\n    \'url\' => \'function=module&module=modlist.inc.php&settings=N%3B&jscharset=0&cachelife=3600\',\n    \'type\' => \'5\',\n  ),\n  \'聚合模塊_版塊列表\' => \n  array (\n    \'url\' => \'function=module&module=rowcombine.inc.php&settings=a%3A1%3A%7Bs%3A4%3A%22data%22%3Bs%3A84%3A%22%E9%82%8A%E6%AC%84%E6%A8%A1%E5%A1%8A_%E7%89%88%E5%A1%8A%E6%8E%92%E8%A1%8C%2C%E7%89%88%E5%A1%8A%E6%8E%92%E8%A1%8C%0D%0A%E9%82%8A%E6%AC%84%E6%A8%A1%E5%A1%8A_%E7%89%88%E5%A1%8A%E6%A8%B9%E5%BD%A2%E5%88%97%E8%A1%A8%2C%E7%89%88%E5%A1%8A%E5%88%97%E8%A1%A8%22%3B%7D&jscharset=0&cachelife=864000&\',\n    \'type\' => \'5\',\n  ),\n  \'邊欄模塊_版塊排行\' => \n  array (\n    \'url\' => \'function=forums&startrow=0&items=0&newwindow=1&orderby=posts&jscharset=0&cachelife=43200&jstemplate=%3Cdiv%20class%3D%5C%22sidebox%5C%22%3E%0D%0A%3Ch4%3E%E7%89%88%E5%A1%8A%E6%8E%92%E8%A1%8C%3C%2Fh4%3E%0D%0A%3Cul%20class%3D%5C%22textinfolist%5C%22%3E%0D%0A%5Bnode%5D%3Cli%3E%3Cimg%20style%3D%5C%22vertical-align%3Amiddle%5C%22%20src%3D%5C%22images%2Fdefault%2Ftree_file.gif%5C%22%20%2F%3E%20%7Bforumname%7D%28%7Bposts%7D%29%3C%2Fli%3E%5B%2Fnode%5D%0D%0A%3C%2Ful%3E%0D%0A%3C%2Fdiv%3E&\',\n    \'type\' => \'1\',\n  ),\n  \'聚合模塊_熱門主題\' => \n  array (\n    \'url\' => \'function=module&module=rowcombine.inc.php&settings=a%3A2%3A%7Bs%3A5%3A%22title%22%3Bs%3A12%3A%22%E7%86%B1%E9%96%80%E4%B8%BB%E9%A1%8C%22%3Bs%3A4%3A%22data%22%3Bs%3A112%3A%22%E9%82%8A%E6%AC%84%E6%A8%A1%E5%A1%8A_%E7%86%B1%E9%96%80%E4%B8%BB%E9%A1%8C_%E4%BB%8A%E6%97%A5%2C%E6%97%A5%0D%0A%E9%82%8A%E6%AC%84%E6%A8%A1%E5%A1%8A_%E7%86%B1%E9%96%80%E4%B8%BB%E9%A1%8C_%E6%9C%AC%E5%91%A8%2C%E5%91%A8%0D%0A%E9%82%8A%E6%AC%84%E6%A8%A1%E5%A1%8A_%E7%86%B1%E9%96%80%E4%B8%BB%E9%A1%8C_%E6%9C%AC%E6%9C%88%2C%E6%9C%88%22%3B%7D&jscharset=0&cachelife=1800&\',\n    \'type\' => \'5\',\n  ),\n  \'邊欄模塊_熱門主題_本月\' => \n  array (\n    \'url\' => \'function=threads&sidestatus=0&maxlength=20&fnamelength=0&messagelength=&startrow=0&picpre=images%2Fcommon%2Fslisticon.gif&items=5&tag=&tids=&special=0&rewardstatus=&digest=0&stick=0&recommend=0&newwindow=1&threadtype=0&highlight=0&orderby=hourviews&hours=720&jscharset=0&cachelife=86400&jstemplate=%3Cdiv%20class%3D%5C%22sidebox%5C%22%3E%0D%0A%3Ch4%3E%E6%9C%AC%E6%9C%88%E7%86%B1%E9%96%80%3C%2Fh4%3E%0D%0A%3Cul%20class%3D%5C%22textinfolist%5C%22%3E%0D%0A%5Bnode%5D%3Cli%3E%7Bprefix%7D%7Bsubject%7D%3C%2Fli%3E%5B%2Fnode%5D%0D%0A%3C%2Ful%3E%0D%0A%3C%2Fdiv%3E&\',\n    \'type\' => \'0\',\n  ),\n  \'聚合模塊_會員排行\' => \n  array (\n    \'url\' => \'function=module&module=rowcombine.inc.php&settings=a%3A2%3A%7Bs%3A5%3A%22title%22%3Bs%3A12%3A%22%E6%9C%83%E5%93%A1%E6%8E%92%E8%A1%8C%22%3Bs%3A4%3A%22data%22%3Bs%3A112%3A%22%E9%82%8A%E6%AC%84%E6%A8%A1%E5%A1%8A_%E6%9C%83%E5%93%A1%E6%8E%92%E8%A1%8C_%E4%BB%8A%E6%97%A5%2C%E6%97%A5%0D%0A%E9%82%8A%E6%AC%84%E6%A8%A1%E5%A1%8A_%E6%9C%83%E5%93%A1%E6%8E%92%E8%A1%8C_%E6%9C%AC%E5%91%A8%2C%E5%91%A8%0D%0A%E9%82%8A%E6%AC%84%E6%A8%A1%E5%A1%8A_%E6%9C%83%E5%93%A1%E6%8E%92%E8%A1%8C_%E6%9C%AC%E6%9C%88%2C%E6%9C%88%22%3B%7D&jscharset=0&cachelife=3600&\',\n    \'type\' => \'5\',\n  ),\n  \'邊欄模塊_推薦主題\' => \n  array (\n    \'url\' => \'function=threads&sidestatus=0&maxlength=20&fnamelength=0&messagelength=&startrow=0&picpre=images%2Fcommon%2Fslisticon.gif&items=5&tag=&tids=&special=0&rewardstatus=&digest=0&stick=0&recommend=1&newwindow=1&threadtype=0&highlight=0&orderby=lastpost&hours=48&jscharset=0&cachelife=3600&jstemplate=%3Cdiv%20class%3D%5C%22sidebox%5C%22%3E%0D%0A%3Ch4%3E%E6%8E%A8%E8%96%A6%E4%B8%BB%E9%A1%8C%3C%2Fh4%3E%0D%0A%3Cul%20class%3D%5C%22textinfolist%5C%22%3E%0D%0A%5Bnode%5D%3Cli%3E%7Bprefix%7D%7Bsubject%7D%3C%2Fli%3E%5B%2Fnode%5D%0D%0A%3C%2Ful%3E%0D%0A%3C%2Fdiv%3E&\',\n    \'type\' => \'0\',\n  ),\n  \'邊欄模塊_最新圖片\' => \n  array (\n    \'url\' => \'function=images&sidestatus=0&isimage=1&threadmethod=1&maxwidth=140&maxheight=140&startrow=0&items=5&orderby=dateline&hours=0&digest=0&newwindow=1&jscharset=0&jstemplate=%3Cdiv%20%20class%3D%5C%22sidebox%5C%22%3E%0D%0A%3Ch4%3E%E6%9C%80%E6%96%B0%E5%9C%96%E7%89%87%3C%2Fh4%3E%0D%0A%3Cscript%20type%3D%5C%22text%2Fjavascript%5C%22%3E%0D%0Avar%20slideSpeed%20%3D%202500%3B%0D%0Avar%20slideImgsize%20%3D%20%5B140%2C140%5D%3B%0D%0Avar%20slideTextBar%20%3D%200%3B%0D%0Avar%20slideBorderColor%20%3D%20%5C%27%23C8DCEC%5C%27%3B%0D%0Avar%20slideBgColor%20%3D%20%5C%27%23FFF%5C%27%3B%0D%0Avar%20slideImgs%20%3D%20new%20Array%28%29%3B%0D%0Avar%20slideImgLinks%20%3D%20new%20Array%28%29%3B%0D%0Avar%20slideImgTexts%20%3D%20new%20Array%28%29%3B%0D%0Avar%20slideSwitchBar%20%3D%201%3B%0D%0Avar%20slideSwitchColor%20%3D%20%5C%27black%5C%27%3B%0D%0Avar%20slideSwitchbgColor%20%3D%20%5C%27white%5C%27%3B%0D%0Avar%20slideSwitchHiColor%20%3D%20%5C%27%23C8DCEC%5C%27%3B%0D%0A%5Bnode%5D%0D%0AslideImgs%5B%7Border%7D%5D%20%3D%20%5C%22%7Bimgfile%7D%5C%22%3B%0D%0AslideImgLinks%5B%7Border%7D%5D%20%3D%20%5C%22%7Blink%7D%5C%22%3B%0D%0AslideImgTexts%5B%7Border%7D%5D%20%3D%20%5C%22%7Bsubject%7D%5C%22%3B%0D%0A%5B%2Fnode%5D%0D%0A%3C%2Fscript%3E%0D%0A%3Cscript%20language%3D%5C%22javascript%5C%22%20type%3D%5C%22text%2Fjavascript%5C%22%20src%3D%5C%22include%2Fjs%2Fslide.js%5C%22%3E%3C%2Fscript%3E%0D%0A%3C%2Fdiv%3E&\',\n    \'type\' => \'4\',\n  ),\n  \'邊欄模塊_最新主題\' => \n  array (\n    \'url\' => \'function=threads&sidestatus=0&maxlength=20&fnamelength=0&messagelength=&startrow=0&picpre=images%2Fcommon%2Fslisticon.gif&items=5&tag=&tids=&special=0&rewardstatus=&digest=0&stick=0&recommend=0&newwindow=1&threadtype=0&highlight=0&orderby=dateline&hours=0&jscharset=0&jstemplate=%3Cdiv%20class%3D%5C%22sidebox%5C%22%3E%0D%0A%3Ch4%3E%E6%9C%80%E6%96%B0%E4%B8%BB%E9%A1%8C%3C%2Fh4%3E%0D%0A%3Cul%20class%3D%5C%22textinfolist%5C%22%3E%0D%0A%5Bnode%5D%3Cli%3E%7Bprefix%7D%7Bsubject%7D%3C%2Fli%3E%5B%2Fnode%5D%0D%0A%3C%2Ful%3E%0D%0A%3C%2Fdiv%3E&\',\n    \'type\' => \'0\',\n  ),\n  \'邊欄模塊_活躍會員\' => \n  array (\n    \'url\' => \'function=memberrank&startrow=0&items=12&newwindow=1&extcredit=1&orderby=posts&hours=0&jscharset=0&cachelife=43200&jstemplate=%3Cdiv%20class%3D%5C%22sidebox%5C%22%3E%0D%0A%3Ch4%3E%E6%B4%BB%E8%BA%8D%E6%9C%83%E5%93%A1%3C%2Fh4%3E%0D%0A%3Cul%20class%3D%5C%22avt_list%20s_clear%5C%22%3E%0D%0A%5Bnode%5D%3Cli%3E%7Bavatarsmall%7D%3C%2Fli%3E%5B%2Fnode%5D%0D%0A%3C%2Ful%3E%0D%0A%3C%2Fdiv%3E&\',\n    \'type\' => \'2\',\n  ),\n  \'邊欄模塊_熱門主題_本版\' => \n  array (\n    \'url\' => \'function=threads&sidestatus=1&maxlength=20&fnamelength=0&messagelength=&startrow=0&picpre=images%2Fcommon%2Fslisticon.gif&items=5&tag=&tids=&special=0&rewardstatus=&digest=0&stick=0&recommend=0&newwindow=1&threadtype=0&highlight=0&orderby=replies&hours=0&jscharset=0&cachelife=1800&jstemplate=%3Cdiv%20class%3D%5C%22sidebox%5C%22%3E%0D%0A%3Ch4%3E%E6%9C%AC%E7%89%88%E7%86%B1%E9%96%80%E4%B8%BB%E9%A1%8C%3C%2Fh4%3E%0D%0A%3Cul%20class%3D%5C%22textinfolist%5C%22%3E%0D%0A%5Bnode%5D%3Cli%3E%7Bprefix%7D%7Bsubject%7D%3C%2Fli%3E%5B%2Fnode%5D%0D%0A%3C%2Ful%3E%0D%0A%3C%2Fdiv%3E&\',\n    \'type\' => \'0\',\n  ),\n  \'邊欄模塊_熱門主題_今日\' => \n  array (\n    \'url\' => \'function=threads&sidestatus=0&maxlength=20&fnamelength=0&messagelength=&startrow=0&picpre=images%2Fcommon%2Fslisticon.gif&items=5&tag=&tids=&special=0&rewardstatus=&digest=0&stick=0&recommend=0&newwindow=1&threadtype=0&highlight=0&orderby=hourviews&hours=24&jscharset=0&cachelife=1800&jstemplate=%3Cdiv%20class%3D%5C%22sidebox%5C%22%3E%0D%0A%3Ch4%3E%E4%BB%8A%E6%97%A5%E7%86%B1%E9%96%80%3C%2Fh4%3E%0D%0A%3Cul%20class%3D%5C%22textinfolist%5C%22%3E%0D%0A%5Bnode%5D%3Cli%3E%7Bprefix%7D%7Bsubject%7D%3C%2Fli%3E%5B%2Fnode%5D%0D%0A%3C%2Ful%3E%0D%0A%3C%2Fdiv%3E&\',\n    \'type\' => \'0\',\n  ),\n  \'邊欄模塊_最新回復\' => \n  array (\n    \'url\' => \'function=threads&sidestatus=0&maxlength=20&fnamelength=0&messagelength=&startrow=0&picpre=images%2Fcommon%2Fslisticon.gif&items=5&tag=&tids=&special=0&rewardstatus=&digest=0&stick=0&recommend=0&newwindow=1&threadtype=0&highlight=0&orderby=lastpost&hours=0&jscharset=0&jstemplate=%3Cdiv%20class%3D%5C%22sidebox%5C%22%3E%0D%0A%3Ch4%3E%E6%9C%80%E6%96%B0%E5%9B%9E%E5%BE%A9%3C%2Fh4%3E%0D%0A%3Cul%20class%3D%5C%22textinfolist%5C%22%3E%0D%0A%5Bnode%5D%3Cli%3E%7Bprefix%7D%7Bsubject%7D%3C%2Fli%3E%5B%2Fnode%5D%0D%0A%3C%2Ful%3E%0D%0A%3C%2Fdiv%3E&\',\n    \'type\' => \'0\',\n  ),\n  \'邊欄模塊_最新圖片_本版\' => \n  array (\n    \'url\' => \'function=images&sidestatus=1&isimage=1&threadmethod=1&maxwidth=140&maxheight=140&startrow=0&items=5&orderby=dateline&hours=0&digest=0&newwindow=1&jscharset=0&jstemplate=%3Cdiv%20%20class%3D%5C%22sidebox%5C%22%3E%0D%0A%3Ch4%3E%E6%9C%80%E6%96%B0%E5%9C%96%E7%89%87%3C%2Fh4%3E%0D%0A%3Cscript%20type%3D%5C%22text%2Fjavascript%5C%22%3E%0D%0Avar%20slideSpeed%20%3D%202500%3B%0D%0Avar%20slideImgsize%20%3D%20%5B140%2C140%5D%3B%0D%0Avar%20slideTextBar%20%3D%200%3B%0D%0Avar%20slideBorderColor%20%3D%20%5C%27%23C8DCEC%5C%27%3B%0D%0Avar%20slideBgColor%20%3D%20%5C%27%23FFF%5C%27%3B%0D%0Avar%20slideImgs%20%3D%20new%20Array%28%29%3B%0D%0Avar%20slideImgLinks%20%3D%20new%20Array%28%29%3B%0D%0Avar%20slideImgTexts%20%3D%20new%20Array%28%29%3B%0D%0Avar%20slideSwitchBar%20%3D%201%3B%0D%0Avar%20slideSwitchColor%20%3D%20%5C%27black%5C%27%3B%0D%0Avar%20slideSwitchbgColor%20%3D%20%5C%27white%5C%27%3B%0D%0Avar%20slideSwitchHiColor%20%3D%20%5C%27%23C8DCEC%5C%27%3B%0D%0A%5Bnode%5D%0D%0AslideImgs%5B%7Border%7D%5D%20%3D%20%5C%22%7Bimgfile%7D%5C%22%3B%0D%0AslideImgLinks%5B%7Border%7D%5D%20%3D%20%5C%22%7Blink%7D%5C%22%3B%0D%0AslideImgTexts%5B%7Border%7D%5D%20%3D%20%5C%22%7Bsubject%7D%5C%22%3B%0D%0A%5B%2Fnode%5D%0D%0A%3C%2Fscript%3E%0D%0A%3Cscript%20language%3D%5C%22javascript%5C%22%20type%3D%5C%22text%2Fjavascript%5C%22%20src%3D%5C%22include%2Fjs%2Fslide.js%5C%22%3E%3C%2Fscript%3E%0D%0A%3C%2Fdiv%3E&\',\n    \'type\' => \'4\',\n  ),\n  \'邊欄模塊_標籤\' => \n  array (\n    \'url\' => \'function=module&module=tag.inc.php&settings=a%3A1%3A%7Bs%3A5%3A%22limit%22%3Bs%3A2%3A%2220%22%3B%7D&jscharset=0&cachelife=900&\',\n    \'type\' => \'5\',\n  ),\n  \'邊欄模塊_會員排行_本月\' => \n  array (\n    \'url\' => \'function=memberrank&startrow=0&items=5&newwindow=1&extcredit=1&orderby=hourposts&hours=720&jscharset=0&cachelife=86400&jstemplate=%3Cdiv%20class%3D%5C%22sidebox%5C%22%3E%0D%0A%3Ch4%3E%E6%9C%AC%E6%9C%88%E6%8E%92%E8%A1%8C%3C%2Fh4%3E%0D%0A%5Bnode%5D%3Cdiv%20class%3D%5C%22s_clear%5C%22%20style%3D%5C%22margin-bottom%3A%205px%3B%5C%22%3E%3Cdiv%20style%3D%5C%22margin-right%3A%2010px%3B%20float%3A%20left%3B%5C%22%3E%7Bavatarsmall%7D%3C%2Fdiv%3E%3Cp%3E%7Bmember%7D%3C%2Fp%3E%3Cp%3E%E7%99%BC%E5%B8%96%20%7Bvalue%7D%20%E7%AF%87%3C%2Fp%3E%3C%2Fdiv%3E%5B%2Fnode%5D%0D%0A%3C%2Fdiv%3E&\',\n    \'type\' => \'2\',\n  ),\n  \'邊欄模塊_會員排行_本周\' => \n  array (\n    \'url\' => \'function=memberrank&startrow=0&items=5&newwindow=1&extcredit=1&orderby=hourposts&hours=168&jscharset=0&cachelife=43200&jstemplate=%3Cdiv%20class%3D%5C%22sidebox%5C%22%3E%0D%0A%3Ch4%3E%E6%9C%AC%E5%91%A8%E6%8E%92%E8%A1%8C%3C%2Fh4%3E%0D%0A%5Bnode%5D%3Cdiv%20class%3D%5C%22s_clear%5C%22%20style%3D%5C%22margin-bottom%3A%205px%3B%5C%22%3E%3Cdiv%20style%3D%5C%22margin-right%3A%2010px%3B%20float%3A%20left%3B%5C%22%3E%7Bavatarsmall%7D%3C%2Fdiv%3E%3Cp%3E%7Bmember%7D%3C%2Fp%3E%3Cp%3E%E7%99%BC%E5%B8%96%20%7Bvalue%7D%20%E7%AF%87%3C%2Fp%3E%3C%2Fdiv%3E%5B%2Fnode%5D%0D%0A%3C%2Fdiv%3E&\',\n    \'type\' => \'2\',\n  ),\n  \'邊欄方案_主題列表頁默認\' => \n  array (\n    \'url\' => \'function=side&jscharset=&jstemplate=%5Bmodule%5D%E9%82%8A%E6%AC%84%E6%A8%A1%E5%A1%8A_%E6%88%91%E7%9A%84%E5%8A%A9%E6%89%8B%5B%2Fmodule%5D%3Chr%20class%3D%22shadowline%22%2F%3E%5Bmodule%5D%E9%82%8A%E6%AC%84%E6%A8%A1%E5%A1%8A_%E7%86%B1%E9%96%80%E4%B8%BB%E9%A1%8C_%E6%9C%AC%E7%89%88%5B%2Fmodule%5D%3Chr%20class%3D%22shadowline%22%2F%3E%5Bmodule%5D%E9%82%8A%E6%AC%84%E6%A8%A1%E5%A1%8A_%E7%89%88%E5%A1%8A%E6%8E%92%E8%A1%8C%5B%2Fmodule%5D&\',\n    \'type\' => \'-2\',\n  ),\n  \'邊欄方案_首頁默認\' => \n  array (\n    \'url\' => \'function=side&jscharset=&jstemplate=%5Bmodule%5D%E9%82%8A%E6%AC%84%E6%A8%A1%E5%A1%8A_%E6%88%91%E7%9A%84%E5%8A%A9%E6%89%8B%5B%2Fmodule%5D%3Chr%20class%3D%22shadowline%22%2F%3E%5Bmodule%5D%E8%81%9A%E5%90%88%E6%A8%A1%E5%A1%8A_%E6%96%B0%E5%B8%96%5B%2Fmodule%5D%3Chr%20class%3D%22shadowline%22%2F%3E%5Bmodule%5D%E8%81%9A%E5%90%88%E6%A8%A1%E5%A1%8A_%E7%86%B1%E9%96%80%E4%B8%BB%E9%A1%8C%5B%2Fmodule%5D%3Chr%20class%3D%22shadowline%22%2F%3E%5Bmodule%5D%E9%82%8A%E6%AC%84%E6%A8%A1%E5%A1%8A_%E6%B4%BB%E8%BA%8D%E6%9C%83%E5%93%A1%5B%2Fmodule%5D&\',\n    \'type\' => \'-2\',\n  ),\n  \'聚合模塊_新帖\' => \n  array (\n    \'url\' => \'function=module&module=rowcombine.inc.php&settings=a%3A2%3A%7Bs%3A5%3A%22title%22%3Bs%3A12%3A%22%E6%9C%80%E6%96%B0%E5%B8%96%E5%AD%90%22%3Bs%3A4%3A%22data%22%3Bs%3A66%3A%22%E9%82%8A%E6%AC%84%E6%A8%A1%E5%A1%8A_%E6%9C%80%E6%96%B0%E4%B8%BB%E9%A1%8C%2C%E4%B8%BB%E9%A1%8C%0D%0A%E9%82%8A%E6%AC%84%E6%A8%A1%E5%A1%8A_%E6%9C%80%E6%96%B0%E5%9B%9E%E5%BE%A9%2C%E5%9B%9E%E5%BE%A9%22%3B%7D&jscharset=0&\',\n    \'type\' => \'5\',\n  ),\n  \'邊欄模塊_熱門主題_本周\' => \n  array (\n    \'url\' => \'function=threads&sidestatus=0&maxlength=20&fnamelength=0&messagelength=&startrow=0&picpre=images%2Fcommon%2Fslisticon.gif&items=5&tag=&tids=&special=0&rewardstatus=&digest=0&stick=0&recommend=0&newwindow=1&threadtype=0&highlight=0&orderby=hourviews&hours=168&jscharset=0&cachelife=43200&jstemplate=%3Cdiv%20class%3D%5C%22sidebox%5C%22%3E%0D%0A%3Ch4%3E%E6%9C%AC%E5%91%A8%E7%86%B1%E9%96%80%3C%2Fh4%3E%0D%0A%3Cul%20class%3D%5C%22textinfolist%5C%22%3E%0D%0A%5Bnode%5D%3Cli%3E%7Bprefix%7D%7Bsubject%7D%3C%2Fli%3E%5B%2Fnode%5D%0D%0A%3C%2Ful%3E%0D%0A%3C%2Fdiv%3E&\',\n    \'type\' => \'0\',\n  ),\n  \'邊欄模塊_會員排行_今日\' => \n  array (\n    \'url\' => \'function=memberrank&startrow=0&items=5&newwindow=1&extcredit=1&orderby=hourposts&hours=24&jscharset=0&cachelife=3600&jstemplate=%3Cdiv%20class%3D%5C%22sidebox%5C%22%3E%0D%0A%3Ch4%3E%E4%BB%8A%E6%97%A5%E6%8E%92%E8%A1%8C%3C%2Fh4%3E%0D%0A%5Bnode%5D%3Cdiv%20class%3D%5C%22s_clear%5C%22%20style%3D%5C%22margin-bottom%3A%205px%3B%5C%22%3E%3Cdiv%20style%3D%5C%22margin-right%3A%2010px%3B%20float%3A%20left%3B%5C%22%3E%7Bavatarsmall%7D%3C%2Fdiv%3E%3Cp%3E%7Bmember%7D%3C%2Fp%3E%3Cp%3E%E7%99%BC%E5%B8%96%20%7Bvalue%7D%20%E7%AF%87%3C%2Fp%3E%3C%2Fdiv%3E%5B%2Fnode%5D%0D%0A%3C%2Fdiv%3E&\',\n    \'type\' => \'2\',\n  ),\n  \'邊欄模塊_論壇之星\' => \n  array (\n    \'url\' => \'function=memberrank&startrow=0&items=3&newwindow=1&extcredit=1&orderby=hourposts&hours=168&jscharset=0&cachelife=43200&jstemplate=%3Cdiv%20class%3D%5C%22sidebox%20s_clear%5C%22%3E%0D%0A%3Ch4%3E%E6%9C%AC%E5%91%A8%E4%B9%8B%E6%98%9F%3C%2Fh4%3E%0D%0A%5Bnode%5D%0D%0A%5Bshow%3D1%5D%3Cdiv%20style%3D%5C%22clear%3Aboth%5C%22%3E%3Cdiv%20style%3D%5C%22float%3Aleft%3B%20margin-right%3A%2016px%3B%5C%22%3E%7Bavatarsmall%7D%3C%2Fdiv%3E%5B%2Fshow%5D%7Bmember%7D%20%5Bshow%3D1%5D%3Cbr%20%2F%3E%E7%99%BC%E5%B8%96%20%7Bvalue%7D%20%E7%AF%87%3C%2Fdiv%3E%3Cdiv%20style%3D%5C%22clear%3Aboth%3Bmargin-top%3A2px%5C%22%20%2F%3E%3C%2Fdiv%3E%5B%2Fshow%5D%0D%0A%5B%2Fnode%5D%0D%0A%3C%2Fdiv%3E&\',\n    \'type\' => \'2\',\n  ),\n  \'邊欄模塊_我的助手\' => \n  array (\n    \'url\' => \'function=module&module=assistant.inc.php&settings=N%3B&jscharset=0&cachelife=0\',\n    \'type\' => \'5\',\n  ),\n  \'邊欄模塊_Google搜索\' => \n  array (\n    \'url\' => \'function=module&module=google.inc.php&settings=a%3A2%3A%7Bs%3A4%3A%22lang%22%3Bs%3A0%3A%22%22%3Bs%3A7%3A%22default%22%3Bs%3A1%3A%221%22%3B%7D&jscharset=0&cachelife=864000&\',\n    \'type\' => \'5\',\n  ),\n  \'UCHome_最新動態\' => \n  array (\n    \'url\' => \'function=module&module=feed.inc.php&settings=a%3A6%3A%7Bs%3A5%3A%22title%22%3Bs%3A12%3A%22%E6%9C%80%E6%96%B0%E5%8B%95%E6%85%8B%22%3Bs%3A4%3A%22uids%22%3Bs%3A0%3A%22%22%3Bs%3A6%3A%22friend%22%3Bs%3A1%3A%220%22%3Bs%3A5%3A%22start%22%3Bs%3A1%3A%220%22%3Bs%3A5%3A%22limit%22%3Bs%3A2%3A%2210%22%3Bs%3A8%3A%22template%22%3Bs%3A54%3A%22%3Cdiv%20style%3D%5C%22padding-left%3A2px%5C%22%3E%7Btitle_template%7D%3C%2Fdiv%3E%22%3B%7D&jscharset=0&cachelife=0&\',\n    \'type\' => \'5\',\n  ),\n  \'UCHome_最新更新空間\' => \n  array (\n    \'url\' => \'function=module&module=space.inc.php&settings=a%3A17%3A%7Bs%3A5%3A%22title%22%3Bs%3A18%3A%22%E6%9C%80%E6%96%B0%E6%9B%B4%E6%96%B0%E7%A9%BA%E9%96%93%22%3Bs%3A3%3A%22uid%22%3Bs%3A0%3A%22%22%3Bs%3A14%3A%22startfriendnum%22%3Bs%3A0%3A%22%22%3Bs%3A12%3A%22endfriendnum%22%3Bs%3A0%3A%22%22%3Bs%3A12%3A%22startviewnum%22%3Bs%3A0%3A%22%22%3Bs%3A10%3A%22endviewnum%22%3Bs%3A0%3A%22%22%3Bs%3A11%3A%22startcredit%22%3Bs%3A0%3A%22%22%3Bs%3A9%3A%22endcredit%22%3Bs%3A0%3A%22%22%3Bs%3A6%3A%22avatar%22%3Bs%3A2%3A%22-1%22%3Bs%3A10%3A%22namestatus%22%3Bs%3A2%3A%22-1%22%3Bs%3A8%3A%22dateline%22%3Bs%3A1%3A%220%22%3Bs%3A10%3A%22updatetime%22%3Bs%3A1%3A%220%22%3Bs%3A5%3A%22order%22%3Bs%3A10%3A%22updatetime%22%3Bs%3A2%3A%22sc%22%3Bs%3A4%3A%22DESC%22%3Bs%3A5%3A%22start%22%3Bs%3A1%3A%220%22%3Bs%3A5%3A%22limit%22%3Bs%3A2%3A%2210%22%3Bs%3A8%3A%22template%22%3Bs%3A267%3A%22%3Ctable%3E%0D%0A%3Ctr%3E%0D%0A%3Ctd%20width%3D%5C%2250%5C%22%20rowspan%3D%5C%222%5C%22%3E%3Ca%20href%3D%5C%22%7Buserlink%7D%5C%22%20target%3D%5C%22_blank%5C%22%3E%3Cimg%20src%3D%5C%22%7Bphoto%7D%5C%22%20%2F%3E%3C%2Fa%3E%3C%2Ftd%3E%0D%0A%3Ctd%3E%3Ca%20href%3D%5C%22%7Buserlink%7D%5C%22%20%20target%3D%5C%22_blank%5C%22%20style%3D%5C%22text-decoration%3Anone%3B%5C%22%3E%7Busername%7D%3C%2Fa%3E%3C%2Ftd%3E%0D%0A%3C%2Ftr%3E%0D%0A%3Ctr%3E%3Ctd%3E%7Bupdatetime%7D%3C%2Ftd%3E%3C%2Ftr%3E%0D%0A%3C%2Ftable%3E%22%3B%7D&jscharset=0&cachelife=0&\',\n    \'type\' => \'5\',\n  ),\n  \'UCHome_最新記錄\' => \n  array (\n    \'url\' => \'function=module&module=doing.inc.php&settings=a%3A6%3A%7Bs%3A5%3A%22title%22%3Bs%3A12%3A%22%E6%9C%80%E6%96%B0%E8%A8%98%E9%8C%84%22%3Bs%3A3%3A%22uid%22%3Bs%3A0%3A%22%22%3Bs%3A4%3A%22mood%22%3Bs%3A1%3A%220%22%3Bs%3A5%3A%22start%22%3Bs%3A1%3A%220%22%3Bs%3A5%3A%22limit%22%3Bs%3A2%3A%2210%22%3Bs%3A8%3A%22template%22%3Bs%3A361%3A%22%0D%0A%3Cdiv%20style%3D%5C%22padding%3A0%200%205px%200%3B%5C%22%3E%0D%0A%3Ca%20href%3D%5C%22%7Buserlink%7D%5C%22%20target%3D%5C%22_blank%5C%22%3E%3Cimg%20src%3D%5C%22%7Bphoto%7D%5C%22%20width%3D%5C%2218%5C%22%20height%3D%5C%2218%5C%22%20align%3D%5C%22absmiddle%5C%22%3E%3C%2Fa%3E%20%3Ca%20href%3D%5C%22%7Buserlink%7D%5C%22%20%20target%3D%5C%22_blank%5C%22%3E%7Busername%7D%3C%2Fa%3E%EF%BC%9A%0D%0A%3C%2Fdiv%3E%0D%0A%3Cdiv%20style%3D%5C%22padding%3A0%200%205px%2020px%3B%5C%22%3E%0D%0A%3Ca%20href%3D%5C%22%7Blink%7D%5C%22%20style%3D%5C%22color%3A%23333%3Btext-decoration%3Anone%3B%5C%22%20target%3D%5C%22_blank%5C%22%3E%7Bmessage%7D%3C%2Fa%3E%0D%0A%3C%2Fdiv%3E%22%3B%7D&jscharset=0&cachelife=0&\',\n    \'type\' => \'5\',\n  ),\n  \'UCHome_競價排名\' => \n  array (\n    \'url\' => \'function=module&module=html.inc.php&settings=a%3A3%3A%7Bs%3A4%3A%22type%22%3Bs%3A1%3A%220%22%3Bs%3A4%3A%22code%22%3Bs%3A27%3A%22%3Cdiv%20id%3D%5C%22sidefeed%5C%22%3E%3C%2Fdiv%3E%22%3Bs%3A4%3A%22side%22%3Bs%3A1%3A%220%22%3B%7D&jscharset=0&cachelife=864000&\',\n    \'type\' => \'5\',\n  ),\n);\n\n'),('medals',1,1310993153,0,'$_DCACHE[\'medals\'] = array (\n);\n\n'),('magics',1,1310993153,0,'$_DCACHE[\'magics\'] = array (\n  1 => \n  array (\n    \'identifier\' => \'CCK\',\n    \'available\' => \'1\',\n    \'name\' => \'變色卡\',\n    \'description\' => \'可以變換主題的顏色,並保存24小時\',\n    \'weight\' => \'20\',\n    \'price\' => \'10\',\n    \'type\' => \'1\',\n  ),\n  2 => \n  array (\n    \'identifier\' => \'MOK\',\n    \'available\' => \'1\',\n    \'name\' => \'金錢卡\',\n    \'description\' => \'可以隨機獲得一些金幣\',\n    \'weight\' => \'30\',\n    \'price\' => \'10\',\n    \'type\' => \'3\',\n  ),\n  3 => \n  array (\n    \'identifier\' => \'SEK\',\n    \'available\' => \'1\',\n    \'name\' => \'IP卡\',\n    \'description\' => \'可以查看帖子作者的IP\',\n    \'weight\' => \'30\',\n    \'price\' => \'15\',\n    \'type\' => \'1\',\n  ),\n  4 => \n  array (\n    \'identifier\' => \'UPK\',\n    \'available\' => \'1\',\n    \'name\' => \'提升卡\',\n    \'description\' => \'可以提升某個主題\',\n    \'weight\' => \'30\',\n    \'price\' => \'10\',\n    \'type\' => \'1\',\n  ),\n  5 => \n  array (\n    \'identifier\' => \'TOK\',\n    \'available\' => \'1\',\n    \'name\' => \'置頂卡\',\n    \'description\' => \'可以將主題置頂24小時\',\n    \'weight\' => \'40\',\n    \'price\' => \'20\',\n    \'type\' => \'1\',\n  ),\n  6 => \n  array (\n    \'identifier\' => \'REK\',\n    \'available\' => \'1\',\n    \'name\' => \'悔悟卡\',\n    \'description\' => \'可以刪除自己的帖子\',\n    \'weight\' => \'30\',\n    \'price\' => \'10\',\n    \'type\' => \'1\',\n  ),\n  7 => \n  array (\n    \'identifier\' => \'RTK\',\n    \'available\' => \'1\',\n    \'name\' => \'狗仔卡\',\n    \'description\' => \'查看某個用戶是否在線\',\n    \'weight\' => \'30\',\n    \'price\' => \'15\',\n    \'type\' => \'2\',\n  ),\n  8 => \n  array (\n    \'identifier\' => \'CLK\',\n    \'available\' => \'1\',\n    \'name\' => \'沉默卡\',\n    \'description\' => \'24小時內不能回復\',\n    \'weight\' => \'30\',\n    \'price\' => \'15\',\n    \'type\' => \'1\',\n  ),\n  9 => \n  array (\n    \'identifier\' => \'OPK\',\n    \'available\' => \'1\',\n    \'name\' => \'喧囂卡\',\n    \'description\' => \'使貼子可以回復\',\n    \'weight\' => \'30\',\n    \'price\' => \'15\',\n    \'type\' => \'1\',\n  ),\n  10 => \n  array (\n    \'identifier\' => \'YSK\',\n    \'available\' => \'1\',\n    \'name\' => \'隱身卡\',\n    \'description\' => \'可以將自己的帖子匿名\',\n    \'weight\' => \'30\',\n    \'price\' => \'20\',\n    \'type\' => \'1\',\n  ),\n  11 => \n  array (\n    \'identifier\' => \'CBK\',\n    \'available\' => \'1\',\n    \'name\' => \'恢復卡\',\n    \'description\' => \'將匿名恢復為正常顯示的用戶名,匿名終結者\',\n    \'weight\' => \'20\',\n    \'price\' => \'15\',\n    \'type\' => \'1\',\n  ),\n  12 => \n  array (\n    \'identifier\' => \'MVK\',\n    \'available\' => \'1\',\n    \'name\' => \'移動卡\',\n    \'description\' => \'可將自已的帖子移動到其他版面（隱含、特殊限定版面除外）\',\n    \'weight\' => \'50\',\n    \'price\' => \'50\',\n    \'type\' => \'1\',\n  ),\n);\n\n'),('modreasons',1,1310993153,0,'$_DCACHE[\'modreasons\'] = array (\n  0 => \'廣告/SPAM\',\n  1 => \'惡意灌水\',\n  2 => \'違規內容\',\n  3 => \'文不對題\',\n  4 => \'重複發帖\',\n  5 => \'\',\n  6 => \'我很贊同\',\n  7 => \'精品文章\',\n  8 => \'原創內容\',\n);\n\n'),('stamptypeid',1,1310993153,0,'$_DCACHE[\'stamptypeid\'] = array (\n);\n\n'),('advs_archiver',1,1310993153,0,'$_DCACHE[\'advs\'] = array (\n);\n\n'),('advs_register',1,1310993153,0,'$_DCACHE[\'advs\'] = array (\n);\n\n'),('ipctrl',1,1310993153,0,'$_DCACHE[\'ipctrl\'] = array (\n  \'ipregctrl\' => \'\',\n  \'ipverifywhite\' => \'\',\n);\n\n'),('faqs',1,1310993153,0,'$_DCACHE[\'faqs\'] = array (\n  \'login\' => \n  array (\n    \'fpid\' => \'1\',\n    \'id\' => \'3\',\n    \'keyword\' => \'登錄幫助\',\n  ),\n  \'discuzcode\' => \n  array (\n    \'fpid\' => \'5\',\n    \'id\' => \'18\',\n    \'keyword\' => \'Discuz!代碼\',\n  ),\n  \'smilies\' => \n  array (\n    \'fpid\' => \'5\',\n    \'id\' => \'32\',\n    \'keyword\' => \'表情\',\n  ),\n);\n\n'),('secqaa',1,1310993153,0,'$_DCACHE[\'secqaa\'] = array (\n  1 => NULL,\n  2 => NULL,\n  3 => NULL,\n  4 => NULL,\n  5 => NULL,\n  6 => NULL,\n  7 => NULL,\n  8 => NULL,\n  9 => NULL,\n);\n\n'),('censor',1,1310993153,0,'$_DCACHE[\'censor\'] = array (\n  \'filter\' => \n  array (\n  ),\n  \'banned\' => \'\',\n  \'mod\' => \'\',\n);\n\n'),('ipbanned',1,1310993153,0,'$_DCACHE[\'ipbanned\'] = array (\n);\n\n'),('smilies_js',1,1310993153,0,'$_DCACHE[\'smilies_js\'] = array (\n);\n\n'),('forumstick',1,1310993153,0,'$_DCACHE[\'forumstick\'] = array (\n);\n\n'),('announcements',1,1310993153,0,'$_DCACHE[\'announcements\'] = array (\n);\n\n'),('onlinelist',1,1310993153,0,'$_DCACHE[\'onlinelist\'] = array (\n  \'legend\' => \'<img src=\"images/common/online_admin.gif\" /> 管理員 &nbsp; &nbsp; &nbsp; <img src=\"images/common/online_supermod.gif\" /> 超級版主 &nbsp; &nbsp; &nbsp; <img src=\"images/common/online_moderator.gif\" /> 版主 &nbsp; &nbsp; &nbsp; <img src=\"images/common/online_member.gif\" /> 會員 &nbsp; &nbsp; &nbsp; \',\n  1 => \'online_admin.gif\',\n  2 => \'online_supermod.gif\',\n  3 => \'online_moderator.gif\',\n  0 => \'online_member.gif\',\n);\n\n'),('forumlinks',1,1310993153,0,'$_DCACHE[\'forumlinks\'] = array (\n  0 => \'<li><div class=\"forumlogo\"><img src=\"images/logo.gif\" border=\"0\" alt=\"Discuz! 官方論壇\" /></div><div class=\"forumcontent\"><h5><a href=\"http://www.discuz.net\" target=\"_blank\">Discuz! 官方論壇</a></h5><p>提供最新 Discuz! 產品新聞、軟件下載與技術交流</p></div>\',\n  1 => \'\',\n  2 => \'\',\n);\n\n'),('advs_index',1,1310993153,0,'$_DCACHE[\'advs\'] = array (\n);\n\n'),('heats',1,1310993153,0,'$_DCACHE[\'heats\'] = array (\n  \'expiration\' => 0,\n);\n\n'),('smilies',1,1310993153,0,'$_DCACHE[\'smilies\'] = array (\n  \'searcharray\' => \n  array (\n    13 => \'/\\\\:loveliness\\\\:/\',\n    23 => \'/\\\\:handshake/\',\n    20 => \'/\\\\:victory\\\\:/\',\n    28 => \'/\\\\{\\\\:2_28\\\\:\\\\}/\',\n    60 => \'/\\\\{\\\\:3_60\\\\:\\\\}/\',\n    37 => \'/\\\\{\\\\:2_37\\\\:\\\\}/\',\n    46 => \'/\\\\{\\\\:3_46\\\\:\\\\}/\',\n    55 => \'/\\\\{\\\\:3_55\\\\:\\\\}/\',\n    32 => \'/\\\\{\\\\:2_32\\\\:\\\\}/\',\n    64 => \'/\\\\{\\\\:3_64\\\\:\\\\}/\',\n    41 => \'/\\\\{\\\\:3_41\\\\:\\\\}/\',\n    18 => \'/\\\\:sleepy\\\\:/\',\n    50 => \'/\\\\{\\\\:3_50\\\\:\\\\}/\',\n    27 => \'/\\\\{\\\\:2_27\\\\:\\\\}/\',\n    59 => \'/\\\\{\\\\:3_59\\\\:\\\\}/\',\n    36 => \'/\\\\{\\\\:2_36\\\\:\\\\}/\',\n    45 => \'/\\\\{\\\\:3_45\\\\:\\\\}/\',\n    54 => \'/\\\\{\\\\:3_54\\\\:\\\\}/\',\n    31 => \'/\\\\{\\\\:2_31\\\\:\\\\}/\',\n    63 => \'/\\\\{\\\\:3_63\\\\:\\\\}/\',\n    40 => \'/\\\\{\\\\:2_40\\\\:\\\\}/\',\n    17 => \'/\\\\:shutup\\\\:/\',\n    49 => \'/\\\\{\\\\:3_49\\\\:\\\\}/\',\n    26 => \'/\\\\{\\\\:2_26\\\\:\\\\}/\',\n    58 => \'/\\\\{\\\\:3_58\\\\:\\\\}/\',\n    35 => \'/\\\\{\\\\:2_35\\\\:\\\\}/\',\n    44 => \'/\\\\{\\\\:3_44\\\\:\\\\}/\',\n    53 => \'/\\\\{\\\\:3_53\\\\:\\\\}/\',\n    30 => \'/\\\\{\\\\:2_30\\\\:\\\\}/\',\n    62 => \'/\\\\{\\\\:3_62\\\\:\\\\}/\',\n    39 => \'/\\\\{\\\\:2_39\\\\:\\\\}/\',\n    48 => \'/\\\\{\\\\:3_48\\\\:\\\\}/\',\n    25 => \'/\\\\{\\\\:2_25\\\\:\\\\}/\',\n    57 => \'/\\\\{\\\\:3_57\\\\:\\\\}/\',\n    34 => \'/\\\\{\\\\:2_34\\\\:\\\\}/\',\n    43 => \'/\\\\{\\\\:3_43\\\\:\\\\}/\',\n    52 => \'/\\\\{\\\\:3_52\\\\:\\\\}/\',\n    29 => \'/\\\\{\\\\:2_29\\\\:\\\\}/\',\n    61 => \'/\\\\{\\\\:3_61\\\\:\\\\}/\',\n    38 => \'/\\\\{\\\\:2_38\\\\:\\\\}/\',\n    47 => \'/\\\\{\\\\:3_47\\\\:\\\\}/\',\n    56 => \'/\\\\{\\\\:3_56\\\\:\\\\}/\',\n    33 => \'/\\\\{\\\\:2_33\\\\:\\\\}/\',\n    42 => \'/\\\\{\\\\:3_42\\\\:\\\\}/\',\n    51 => \'/\\\\{\\\\:3_51\\\\:\\\\}/\',\n    16 => \'/\\\\:dizzy\\\\:/\',\n    15 => \'/\\\\:curse\\\\:/\',\n    14 => \'/\\\\:funk\\\\:/\',\n    22 => \'/\\\\:kiss\\\\:/\',\n    21 => \'/\\\\:time\\\\:/\',\n    24 => \'/\\\\:call\\\\:/\',\n    19 => \'/\\\\:hug\\\\:/\',\n    12 => \'/\\\\:lol/\',\n    4 => \'/\\\\:\\\'\\\\(/\',\n    5 => \'/\\\\:@/\',\n    9 => \'/;P/\',\n    8 => \'/\\\\:\\\\$/\',\n    3 => \'/\\\\:D/\',\n    7 => \'/\\\\:P/\',\n    2 => \'/\\\\:\\\\(/\',\n    11 => \'/\\\\:Q/\',\n    6 => \'/\\\\:o/\',\n    1 => \'/\\\\:\\\\)/\',\n    10 => \'/\\\\:L/\',\n  ),\n  \'replacearray\' => \n  array (\n    13 => \'loveliness.gif\',\n    23 => \'handshake.gif\',\n    20 => \'victory.gif\',\n    28 => \'04.gif\',\n    60 => \'20.gif\',\n    37 => \'13.gif\',\n    46 => \'06.gif\',\n    55 => \'15.gif\',\n    32 => \'08.gif\',\n    64 => \'24.gif\',\n    41 => \'01.gif\',\n    18 => \'sleepy.gif\',\n    50 => \'10.gif\',\n    27 => \'03.gif\',\n    59 => \'19.gif\',\n    36 => \'12.gif\',\n    45 => \'05.gif\',\n    54 => \'14.gif\',\n    31 => \'07.gif\',\n    63 => \'23.gif\',\n    40 => \'16.gif\',\n    17 => \'shutup.gif\',\n    49 => \'09.gif\',\n    26 => \'02.gif\',\n    58 => \'18.gif\',\n    35 => \'11.gif\',\n    44 => \'04.gif\',\n    53 => \'13.gif\',\n    30 => \'06.gif\',\n    62 => \'22.gif\',\n    39 => \'15.gif\',\n    48 => \'08.gif\',\n    25 => \'01.gif\',\n    57 => \'17.gif\',\n    34 => \'10.gif\',\n    43 => \'03.gif\',\n    52 => \'12.gif\',\n    29 => \'05.gif\',\n    61 => \'21.gif\',\n    38 => \'14.gif\',\n    47 => \'07.gif\',\n    56 => \'16.gif\',\n    33 => \'09.gif\',\n    42 => \'02.gif\',\n    51 => \'11.gif\',\n    16 => \'dizzy.gif\',\n    15 => \'curse.gif\',\n    14 => \'funk.gif\',\n    22 => \'kiss.gif\',\n    21 => \'time.gif\',\n    24 => \'call.gif\',\n    19 => \'hug.gif\',\n    12 => \'lol.gif\',\n    4 => \'cry.gif\',\n    5 => \'huffy.gif\',\n    9 => \'titter.gif\',\n    8 => \'shy.gif\',\n    3 => \'biggrin.gif\',\n    7 => \'tongue.gif\',\n    2 => \'sad.gif\',\n    11 => \'mad.gif\',\n    6 => \'shocked.gif\',\n    1 => \'smile.gif\',\n    10 => \'sweat.gif\',\n  ),\n  \'typearray\' => \n  array (\n    13 => \'1\',\n    23 => \'1\',\n    20 => \'1\',\n    28 => \'2\',\n    60 => \'3\',\n    37 => \'2\',\n    46 => \'3\',\n    55 => \'3\',\n    32 => \'2\',\n    64 => \'3\',\n    41 => \'3\',\n    18 => \'1\',\n    50 => \'3\',\n    27 => \'2\',\n    59 => \'3\',\n    36 => \'2\',\n    45 => \'3\',\n    54 => \'3\',\n    31 => \'2\',\n    63 => \'3\',\n    40 => \'2\',\n    17 => \'1\',\n    49 => \'3\',\n    26 => \'2\',\n    58 => \'3\',\n    35 => \'2\',\n    44 => \'3\',\n    53 => \'3\',\n    30 => \'2\',\n    62 => \'3\',\n    39 => \'2\',\n    48 => \'3\',\n    25 => \'2\',\n    57 => \'3\',\n    34 => \'2\',\n    43 => \'3\',\n    52 => \'3\',\n    29 => \'2\',\n    61 => \'3\',\n    38 => \'2\',\n    47 => \'3\',\n    56 => \'3\',\n    33 => \'2\',\n    42 => \'3\',\n    51 => \'3\',\n    16 => \'1\',\n    15 => \'1\',\n    14 => \'1\',\n    22 => \'1\',\n    21 => \'1\',\n    24 => \'1\',\n    19 => \'1\',\n    12 => \'1\',\n    4 => \'1\',\n    5 => \'1\',\n    9 => \'1\',\n    8 => \'1\',\n    3 => \'1\',\n    7 => \'1\',\n    2 => \'1\',\n    11 => \'1\',\n    6 => \'1\',\n    1 => \'1\',\n    10 => \'1\',\n  ),\n);\n\n'),('announcements_forum',1,1310993153,0,'$_DCACHE[\'announcements_forum\'] = array (\n);\n\n'),('globalstick',1,1310993153,0,'$_DCACHE[\'globalstick\'] = array (\n  \'global\' => \n  array (\n    \'tids\' => 0,\n    \'count\' => 0,\n  ),\n);\n\n'),('advs_forumdisplay',1,1310993153,0,'$_DCACHE[\'advs\'] = array (\n);\n\n'),('smileytypes',1,1310993153,0,'$_DCACHE[\'smileytypes\'] = array (\n  1 => \n  array (\n    \'name\' => \'默認\',\n    \'directory\' => \'default\',\n  ),\n  2 => \n  array (\n    \'name\' => \'酷猴\',\n    \'directory\' => \'coolmonkey\',\n  ),\n  3 => \n  array (\n    \'name\' => \'呆呆男\',\n    \'directory\' => \'grapeman\',\n  ),\n);\n\n'),('bbcodes',1,1310993153,0,'$_DCACHE[\'bbcodes\'] = array (\n  \'searcharray\' => \n  array (\n    0 => \'/\\\\[qq]([^\"\\\\[]+?)\\\\[\\\\/qq\\\\]/is\',\n  ),\n  \'replacearray\' => \n  array (\n    0 => \'<a href=\"http://wpa.qq.com/msgrd?V=1&Uin=\\\\1&amp;Site=[Discuz!]&amp;Menu=yes\" target=\"_blank\"><img src=\"http://wpa.qq.com/pa?p=1:\\\\1:1\" border=\"0\"></a>\',\n  ),\n);\n\n'),('advs_viewthread',1,1310993153,0,'$_DCACHE[\'advs\'] = array (\n);\n\n'),('tags_viewthread',1,1310993153,0,'$_DCACHE[\'tags\'] = array (\n  1 => \'[\\\'\\\']\',\n  0 => \'[\\\'\\\']\',\n  2 => \'0\',\n);\n\n'),('custominfo',1,1310993153,0,'$_DCACHE[\'custominfo\'] = array (\n  \'customauthorinfo\' => \n  array (\n    2 => \'<dt>UID</dt><dd>$post[uid]&nbsp;</dd><dt>帖子</dt><dd>$post[posts]&nbsp;</dd><dt>精華</dt><dd>$post[digestposts]&nbsp;</dd><dt>積分</dt><dd>$post[credits]&nbsp;</dd><dt>閱讀權限</dt><dd>$post[readaccess]&nbsp;</dd>\".($post[location] ? \"<dt>來自</dt><dd>$post[location]&nbsp;</dd>\" : \"\").\"<dt>在線時間</dt><dd>$post[oltime] 小時&nbsp;</dd><dt>註冊時間</dt><dd>$post[regdate]&nbsp;</dd><dt>最後登錄</dt><dd>$post[lastdate]&nbsp;</dd>\',\n    1 => NULL,\n  ),\n  \'fieldsadd\' => \'\',\n  \'profilefields\' => \n  array (\n  ),\n  \'postno\' => \n  array (\n    0 => \'<sup>#</sup>\',\n  ),\n);\n\n'),('groupicon',1,1310993153,0,'$_DCACHE[\'groupicon\'] = array (\n  1 => \'images/common/online_admin.gif\',\n  2 => \'images/common/online_supermod.gif\',\n  3 => \'images/common/online_moderator.gif\',\n  0 => \'images/common/online_member.gif\',\n);\n\n'),('focus',1,1310993153,0,'$_DCACHE[\'focus\'] = array (\n  \'title\' => NULL,\n  \'data\' => \n  array (\n  ),\n);\n\n'),('bbcodes_display',1,1310993153,0,'$_DCACHE[\'bbcodes_display\'] = array (\n);\n\n'),('smileycodes',1,1310993153,0,'$_DCACHE[\'smileycodes\'] = array (\n  1 => \':)\',\n  2 => \':(\',\n  3 => \':D\',\n  4 => \':\\\'(\',\n  5 => \':@\',\n  6 => \':o\',\n  7 => \':P\',\n  8 => \':$\',\n  9 => \';P\',\n  10 => \':L\',\n  11 => \':Q\',\n  12 => \':lol\',\n  13 => \':loveliness:\',\n  14 => \':funk:\',\n  15 => \':curse:\',\n  16 => \':dizzy:\',\n  17 => \':shutup:\',\n  18 => \':sleepy:\',\n  19 => \':hug:\',\n  20 => \':victory:\',\n  21 => \':time:\',\n  22 => \':kiss:\',\n  23 => \':handshake\',\n  24 => \':call:\',\n  25 => \'{:2_25:}\',\n  26 => \'{:2_26:}\',\n  27 => \'{:2_27:}\',\n  28 => \'{:2_28:}\',\n  29 => \'{:2_29:}\',\n  30 => \'{:2_30:}\',\n  31 => \'{:2_31:}\',\n  32 => \'{:2_32:}\',\n  33 => \'{:2_33:}\',\n  34 => \'{:2_34:}\',\n  35 => \'{:2_35:}\',\n  36 => \'{:2_36:}\',\n  37 => \'{:2_37:}\',\n  38 => \'{:2_38:}\',\n  39 => \'{:2_39:}\',\n  40 => \'{:2_40:}\',\n  41 => \'{:3_41:}\',\n  42 => \'{:3_42:}\',\n  43 => \'{:3_43:}\',\n  44 => \'{:3_44:}\',\n  45 => \'{:3_45:}\',\n  46 => \'{:3_46:}\',\n  47 => \'{:3_47:}\',\n  48 => \'{:3_48:}\',\n  49 => \'{:3_49:}\',\n  50 => \'{:3_50:}\',\n  51 => \'{:3_51:}\',\n  52 => \'{:3_52:}\',\n  53 => \'{:3_53:}\',\n  54 => \'{:3_54:}\',\n  55 => \'{:3_55:}\',\n  56 => \'{:3_56:}\',\n  57 => \'{:3_57:}\',\n  58 => \'{:3_58:}\',\n  59 => \'{:3_59:}\',\n  60 => \'{:3_60:}\',\n  61 => \'{:3_61:}\',\n  62 => \'{:3_62:}\',\n  63 => \'{:3_63:}\',\n  64 => \'{:3_64:}\',\n);\n\n'),('domainwhitelist',1,1310993153,0,'$_DCACHE[\'domainwhitelist\'] = array (\n);\n\n'),('fields_required',1,1310993153,0,'$_DCACHE[\'fields_required\'] = array (\n);\n\n'),('fields_optional',1,1310993153,0,'$_DCACHE[\'fields_optional\'] = array (\n);\n\n');
/*!40000 ALTER TABLE `cdb_caches` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cdb_creditslog`
--

DROP TABLE IF EXISTS `cdb_creditslog`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cdb_creditslog` (
  `uid` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `fromto` char(15) NOT NULL DEFAULT '',
  `sendcredits` tinyint(1) NOT NULL DEFAULT '0',
  `receivecredits` tinyint(1) NOT NULL DEFAULT '0',
  `send` int(10) unsigned NOT NULL DEFAULT '0',
  `receive` int(10) unsigned NOT NULL DEFAULT '0',
  `dateline` int(10) unsigned NOT NULL DEFAULT '0',
  `operation` char(3) NOT NULL DEFAULT '',
  KEY `uid` (`uid`,`dateline`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cdb_creditslog`
--

LOCK TABLES `cdb_creditslog` WRITE;
/*!40000 ALTER TABLE `cdb_creditslog` DISABLE KEYS */;
/*!40000 ALTER TABLE `cdb_creditslog` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cdb_crons`
--

DROP TABLE IF EXISTS `cdb_crons`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cdb_crons` (
  `cronid` smallint(6) unsigned NOT NULL AUTO_INCREMENT,
  `available` tinyint(1) NOT NULL DEFAULT '0',
  `type` enum('user','system') NOT NULL DEFAULT 'user',
  `name` char(50) NOT NULL DEFAULT '',
  `filename` char(50) NOT NULL DEFAULT '',
  `lastrun` int(10) unsigned NOT NULL DEFAULT '0',
  `nextrun` int(10) unsigned NOT NULL DEFAULT '0',
  `weekday` tinyint(1) NOT NULL DEFAULT '0',
  `day` tinyint(2) NOT NULL DEFAULT '0',
  `hour` tinyint(2) NOT NULL DEFAULT '0',
  `minute` char(36) NOT NULL DEFAULT '',
  PRIMARY KEY (`cronid`),
  KEY `nextrun` (`available`,`nextrun`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cdb_crons`
--

LOCK TABLES `cdb_crons` WRITE;
/*!40000 ALTER TABLE `cdb_crons` DISABLE KEYS */;
INSERT INTO `cdb_crons` VALUES (1,1,'system','清空今日發帖數','todayposts_daily.inc.php',1311012211,1311091200,-1,-1,0,'0'),(2,1,'system','清空本月在線時間','onlinetime_monthly.inc.php',0,1310996753,-1,1,0,'0'),(3,1,'system','每日數據清理','cleanup_daily.inc.php',0,1310996753,-1,-1,5,'30'),(4,1,'system','生日統計與郵件祝福','birthdays_daily.inc.php',0,1310996753,-1,-1,0,'0'),(5,1,'system','主題回復通知','announcements_daily.inc.php',0,1310996753,-1,-1,0,'0'),(6,1,'system','每日公告清理','threadexpiries_hourly.inc.php',0,1310996753,-1,-1,5,'0'),(7,1,'system','限時操作清理','promotions_hourly.inc.php',0,1310996753,-1,-1,0,'00'),(8,1,'system','論壇推廣清理','cleanup_monthly.inc.php',0,1310996753,-1,1,6,'00'),(9,1,'system','每月主題清理','magics_daily.inc.php',0,1310996753,-1,-1,0,'0'),(10,1,'system','每日 X-Space更新用戶','secqaa_daily.inc.php',0,1310996753,-1,-1,6,'0'),(11,1,'system','每週主題更新','tags_daily.inc.php',0,1310996753,5,-1,5,'0'),(12,1,'system','每日勳章更新','medals_daily.inc.php',0,1310996753,-1,-1,0,'0');
/*!40000 ALTER TABLE `cdb_crons` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cdb_debateposts`
--

DROP TABLE IF EXISTS `cdb_debateposts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cdb_debateposts` (
  `pid` int(10) unsigned NOT NULL DEFAULT '0',
  `stand` tinyint(1) NOT NULL DEFAULT '0',
  `tid` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `uid` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `dateline` int(10) unsigned NOT NULL DEFAULT '0',
  `voters` mediumint(10) unsigned NOT NULL DEFAULT '0',
  `voterids` text NOT NULL,
  PRIMARY KEY (`pid`),
  KEY `pid` (`pid`,`stand`),
  KEY `tid` (`tid`,`uid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cdb_debateposts`
--

LOCK TABLES `cdb_debateposts` WRITE;
/*!40000 ALTER TABLE `cdb_debateposts` DISABLE KEYS */;
/*!40000 ALTER TABLE `cdb_debateposts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cdb_debates`
--

DROP TABLE IF EXISTS `cdb_debates`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cdb_debates` (
  `tid` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `uid` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `starttime` int(10) unsigned NOT NULL DEFAULT '0',
  `endtime` int(10) unsigned NOT NULL DEFAULT '0',
  `affirmdebaters` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `negadebaters` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `affirmvotes` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `negavotes` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `umpire` varchar(15) NOT NULL DEFAULT '',
  `winner` tinyint(1) NOT NULL DEFAULT '0',
  `bestdebater` varchar(50) NOT NULL DEFAULT '',
  `affirmpoint` text NOT NULL,
  `negapoint` text NOT NULL,
  `umpirepoint` text NOT NULL,
  `affirmvoterids` text NOT NULL,
  `negavoterids` text NOT NULL,
  `affirmreplies` mediumint(8) unsigned NOT NULL,
  `negareplies` mediumint(8) unsigned NOT NULL,
  PRIMARY KEY (`tid`),
  KEY `uid` (`uid`,`starttime`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cdb_debates`
--

LOCK TABLES `cdb_debates` WRITE;
/*!40000 ALTER TABLE `cdb_debates` DISABLE KEYS */;
/*!40000 ALTER TABLE `cdb_debates` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cdb_failedlogins`
--

DROP TABLE IF EXISTS `cdb_failedlogins`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cdb_failedlogins` (
  `ip` char(15) NOT NULL DEFAULT '',
  `count` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `lastupdate` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`ip`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cdb_failedlogins`
--

LOCK TABLES `cdb_failedlogins` WRITE;
/*!40000 ALTER TABLE `cdb_failedlogins` DISABLE KEYS */;
/*!40000 ALTER TABLE `cdb_failedlogins` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cdb_faqs`
--

DROP TABLE IF EXISTS `cdb_faqs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cdb_faqs` (
  `id` smallint(6) NOT NULL AUTO_INCREMENT,
  `fpid` smallint(6) unsigned NOT NULL DEFAULT '0',
  `displayorder` tinyint(3) NOT NULL DEFAULT '0',
  `identifier` varchar(20) NOT NULL,
  `keyword` varchar(50) NOT NULL,
  `title` varchar(50) NOT NULL,
  `message` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `displayplay` (`displayorder`)
) ENGINE=MyISAM AUTO_INCREMENT=35 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cdb_faqs`
--

LOCK TABLES `cdb_faqs` WRITE;
/*!40000 ALTER TABLE `cdb_faqs` DISABLE KEYS */;
INSERT INTO `cdb_faqs` VALUES (1,0,1,'','','用戶須知',''),(2,1,1,'','','我必須要註冊嗎？','這取決於管理員如何設置 Discuz! 論壇的用戶組權限選項，您甚至有可能必須在註冊成正式用戶後後才能瀏覽帖子。當然，在通常情況下，您至少應該是正式用戶才能發新帖和回復已有帖子。請 <a href=\"register.php\" target=\"_blank\">點擊這裡</a> 免費註冊成為我們的新用戶！\r\n<br /><br />強烈建議您註冊，這樣會得到很多以遊客身份無法實現的功能。'),(3,1,2,'login','登錄幫助','我如何登錄論壇？','如果您已經註冊成為該論壇的會員，哪麼您只要通過訪問頁面右上的<a href=\"logging.php?action=login\" target=\"_blank\">登錄</a>，進入登陸界面填寫正確的用戶名和密碼（如果您設有安全提問，請選擇正確的安全提問並輸入對應的答案），點擊「提交」即可完成登陸如果您還未註冊請點擊這裡。<br /><br />\r\n如果需要保持登錄，請選擇相應的 Cookie 時間，在此時間範圍內您可以不必輸入密碼而保持上次的登錄狀態。'),(4,1,3,'','','忘記我的登錄密碼，怎麼辦？','當您忘記了用戶登錄的密碼，您可以通過註冊時填寫的電子郵箱重新設置一個新的密碼。點擊登錄頁面中的 <a href=\"member.php?action=lostpasswd\" target=\"_blank\">取回密碼</a>，按照要求填寫您的個人信息，系統將自動發送重置密碼的郵件到您註冊時填寫的 Email 信箱中。如果您的 Email 已失效或無法收到信件，請與論壇管理員聯繫。'),(5,0,2,'','','帖子相關操作',''),(6,0,3,'','','基本功能操作',''),(7,0,4,'','','其他相關問題',''),(8,1,4,'','','我如何使用個性化頭像','在<a href=\"memcp.php\" target=\"_blank\">控制面板</a>中的「編輯個人資料」，有一個「頭像」的選項，可以使用論壇自帶的頭像或者自定義的頭像。'),(9,1,5,'','','我如何修改登錄密碼','在<a href=\"memcp.php\" target=\"_blank\">控制面板</a>中的「編輯個人資料」，填寫「原密碼」，「新密碼」，「確認新密碼」。點擊「提交」，即可修改。'),(10,1,6,'','','我如何使用個性化簽名和暱稱','在<a href=\"memcp.php\" target=\"_blank\">控制面板</a>中的「編輯個人資料」，有一個「暱稱」和「個人簽名」的選項，可以在此設置。'),(11,5,1,'','','我如何發表新主題','在論壇版塊中，點「新帖」，如果有權限，您可以看到有「投票，懸賞，活動，交易」，點擊即可進入功能齊全的發帖界面。\r\n<br /><br />注意：一般論壇都設置為高級別的用戶組才能發佈這四類特殊主題。如發佈普通主題，直接點擊「新帖」，當然您也可以使用版塊下面的「快速發帖」發表新帖(如果此選項打開)。一般論壇都設置為需要登錄後才能發帖。'),(12,5,2,'','','我如何發表回復','回復有分三種：第一、貼子最下方的快速回復； 第二、在您想回復的樓層點擊右下方「回復」； 第三、完整回復頁面，點擊本頁「新帖」旁邊的「回復」。'),(13,5,3,'','','我如何編輯自己的帖子','在帖子的右下角，有編輯，回復，報告等選項，點擊編輯，就可以對帖子進行編輯。'),(14,5,4,'','','我如何出售購買主題','<li>出售主題：\r\n當您進入發貼界面後，如果您所在的用戶組有發買賣貼的權限，在「售價(金錢)」後面填寫主題的價格，這樣其他用戶在查看這個帖子的時候就需要進入交費的過程才可以查看帖子。</li>\r\n<li>購買主題：\r\n瀏覽你準備購買的帖子，在帖子的相關信息的下面有[查看付款記錄] [購買主題] [返回上一頁] \r\n等鏈接，點擊「購買主題」進行購買。</li>'),(15,5,5,'','','我如何出售購買附件','<li>上傳附件一欄有個售價的輸入框，填入出售價格即可實現需要支付才可下載附件的功能。</li>\r\n<li>點擊帖子中[購買附件]按鈕或點擊附件的下載鏈接會跳轉至附件購買頁面，確認付款的相關信息後點提交按鈕，即可得到附件的下載權限。只需購買一次，就有該附件的永遠下載權限。</li>'),(16,5,6,'','','我如何上傳附件','<li>發表新主題的時候上傳附件，步驟為：寫完帖子標題和內容後點上傳附件右方的瀏覽，然後在本地選擇要上傳附件的具體文件名，最後點擊發表話題。</li>\r\n<li>發表回復的時候上傳附件，步驟為：寫完回復樓主的內容，然後點上傳附件右方的瀏覽，找到需要上傳的附件，點擊發表回復。</li>'),(17,5,7,'','','我如何實現發帖時圖文混排效果','<li>發表新主題的時候點擊上傳附件左側的「[插入]」鏈接把附件標記插入到帖子中適當的位置即可。</li>'),(18,5,8,'discuzcode','Discuz!代碼','我如何使用Discuz!代碼','<table width=\"99%\" cellpadding=\"2\" cellspacing=\"2\">\r\n  <tr>\r\n    <th width=\"50%\">Discuz!代碼</th>\r\n    <th width=\"402\">效果</th>\r\n  </tr>\r\n  <tr>\r\n    <td>[b]粗體文字 Abc[/b]</td>\r\n    <td><strong>粗體文字 Abc</strong></td>\r\n  </tr>\r\n  <tr>\r\n    <td>[i]斜體文字 Abc[/i]</td>\r\n    <td><em>斜體文字 Abc</em></td>\r\n  </tr>\r\n  <tr>\r\n    <td>[u]下劃線文字 Abc[/u]</td>\r\n    <td><u>下劃線文字 Abc</u></td>\r\n  </tr>\r\n  <tr>\r\n    <td>[color=red]紅顏色[/color]</td>\r\n    <td><font color=\"red\">紅顏色</font></td>\r\n  </tr>\r\n  <tr>\r\n    <td>[size=3]文字大小為 3[/size] </td>\r\n    <td><font size=\"3\">文字大小為 3</font></td>\r\n  </tr>\r\n  <tr>\r\n    <td>[font=仿宋]字體為仿宋[/font] </td>\r\n    <td><font face=\"仿宋\">字體為仿宋</font></td>\r\n  </tr>\r\n  <tr>\r\n    <td>[align=Center]內容居中[/align] </td>\r\n    <td><div align=\"center\">內容居中</div></td>\r\n  </tr>\r\n  <tr>\r\n    <td>[url]http://www.comsenz.com[/url]</td>\r\n    <td><a href=\"http://www.comsenz.com\" target=\"_blank\">http://www.comsenz.com</a>（超級鏈接）</td>\r\n  </tr>\r\n  <tr>\r\n    <td>[url=http://www.Discuz.net]Discuz! 論壇[/url]</td>\r\n    <td><a href=\"http://www.Discuz.net\" target=\"_blank\">Discuz! 論壇</a>（超級鏈接）</td>\r\n  </tr>\r\n  <tr>\r\n    <td>[email]myname@mydomain.com[/email]</td>\r\n    <td><a href=\"mailto:myname@mydomain.com\">myname@mydomain.com</a>（E-mail鏈接）</td>\r\n  </tr>\r\n  <tr>\r\n    <td>[email=support@discuz.net]Discuz! 技術支持[/email]</td>\r\n    <td><a href=\"mailto:support@discuz.net\">Discuz! 技術支持（E-mail鏈接）</a></td>\r\n  </tr>\r\n  <tr>\r\n    <td>[quote]Discuz! Board 是由康盛創想（北京）科技有限公司開發的論壇軟件[/quote] </td>\r\n    <td><div style=\"font-size: 12px\"><br /><br /><div class=\"quote\"><h5>引用:</h5><blockquote>原帖由 <i>admin</i> 於 2006-12-26 08:45 發表<br />Discuz! Board 是由康盛創想（北京）科技有限公司開發的論壇軟件</blockquote></div></td>\r\n  </tr>\r\n   <tr>\r\n    <td>[code]Discuz! Board 是由康盛創想（北京）科技有限公司開發的論壇軟件[/code] </td>\r\n    <td><div style=\"font-size: 12px\"><br /><br /><div class=\"blockcode\"><h5>代碼:</h5><code id=\"code0\">Discuz! Board 是由康盛創想（北京）科技有限公司開發的論壇軟件</code></div></td>\r\n  </tr>\r\n  <tr>\r\n    <td>[hide]隱藏內容 Abc[/hide]</td>\r\n    <td>效果:只有當瀏覽者回復本帖時，才顯示其中的內容，否則顯示為「<b>**** 隱藏信息 跟帖後才能顯示 *****</b>」</td>\r\n  </tr>\r\n  <tr>\r\n    <td>[hide=20]隱藏內容 Abc[/hide]</td>\r\n    <td>效果:只有當瀏覽者積分高於 20 點時，才顯示其中的內容，否則顯示為「<b>**** 隱藏信息 積分高於 20 點才能顯示 ****</b>」</td>\r\n  </tr>\r\n  <tr>\r\n    <td>[list][*]列表項 #1[*]列表項 #2[*]列表項 #3[/list]</td>\r\n    <td><ul>\r\n      <li>列表項 ＃1</li>\r\n      <li>列表項 ＃2</li>\r\n      <li>列表項 ＃3 </li>\r\n    </ul></td>\r\n  </tr>\r\n  <tr>\r\n    <td>[img]http://www.discuz.net/images/default/logo.gif[/img] </td>\r\n    <td>帖子內顯示為：<img src=\"http://www.discuz.net/images/default/logo.gif\" /></td>\r\n  </tr>\r\n  <tr>\r\n    <td>[img=88,31]http://www.discuz.net/images/logo.gif[/img] </td>\r\n    <td>帖子內顯示為：<img src=\"http://www.discuz.net/images/logo.gif\" /></td>\r\n  </tr> <tr>\r\n    <td>[media=400,300,1]多媒體 URL[/media]</td>\r\n    <td>帖子內嵌入多媒體，寬 400 高 300 自動播放</td>\r\n  </tr>\r\n <tr>\r\n    <td>[fly]飛行的效果[/fly]</td>\r\n    <td><marquee scrollamount=\"3\" behavior=\"alternate\" width=\"90%\">飛行的效果</marquee></td>\r\n  </tr>\r\n  <tr>\r\n    <td>[flash]Flash網頁地址 [/flash] </td>\r\n    <td>帖子內嵌入 Flash 動畫</td>\r\n  </tr>\r\n  <tr>\r\n    <td>[qq]123456789[/qq]</td>\r\n    <td>在帖子內顯示 QQ 在線狀態，點這個圖標可以和他（她）聊天</td>\r\n  </tr>\r\n  <tr>\r\n    <td>X[sup]2[/sup]</td>\r\n    <td>X<sup>2</sup></td>\r\n  </tr>\r\n  <tr>\r\n    <td>X[sub]2[/sub]</td>\r\n    <td>X<sub>2</sub></td>\r\n  </tr>\r\n  \r\n</table>'),(19,6,1,'','','我如何使用短消息功能','您登錄後，點擊導航欄上的短消息按鈕，即可進入短消息管理。\r\n點擊[發送短消息]按鈕，在\"發送到\"後輸入收信人的用戶名，填寫完標題和內容，點提交(或按 Ctrl+Enter 發送)即可發出短消息。\r\n<br /><br />如果要保存到發件箱，以在提交前勾選\"保存到發件箱中\"前的復選框。\r\n<ul>\r\n<li>點擊收件箱可打開您的收件箱查看收到的短消息。</li>\r\n<li>點擊發件箱可查看保存在發件箱裡的短消息。 </li>\r\n<li>點擊已發送來查看對方是否已經閱讀您的短消息。 </li>\r\n<li>點擊搜索短消息就可通過關鍵字，發信人，收信人，搜索範圍，排序類型等一系列條件設定來找到您需要查找的短消息。 </li>\r\n<li>點擊導出短消息可以將自己的短消息導出htm文件保存在自己的電腦裡。 </li>\r\n<li>點擊忽略列表可以設定忽略人員，當這些被添加的忽略用戶給您發送短消息時將不予接收。</li>\r\n</ul>'),(20,6,2,'','','我如何向好友群發短消息','登錄論壇後，點擊短消息，然後點發送短消息，如果有好友的話，好友群發後麵點擊全選，可以給所有的好友群發短消息。'),(21,6,3,'','','我如何查看論壇會員數據','點擊導航欄上面的會員，然後顯示的是此論壇的會員數據。註：需要論壇管理員開啟允許你查看會員資料才可看到。'),(22,6,4,'','','我如何使用搜索','點擊導航欄上面的搜索，輸入搜索的關鍵字並選擇一個範圍，就可以檢索到您有權限訪問論壇中的相關的帖子。'),(23,6,5,'','','我如何使用「我的」功能','<li>會員必須首先<a href=\"logging.php?action=login\" target=\"_blank\">登錄</a>，沒有用戶名的請先<a href=\"register.php\" target=\"_blank\">註冊</a>；</li>\r\n<li>登錄之後在論壇的左上方會出現一個「我的」的超級鏈接，點擊這個鏈接之後就可進入到有關於您的信息。</li>'),(24,7,1,'','','我如何向管理員報告帖子','打開一個帖子，在帖子的右下角可以看到：「編輯」、「引用」、「報告」、「評分」、「回復」等等幾個按鈕，點擊其中的「報告」按鈕進入報告頁面，填寫好「我的意見」，單擊「報告」按鈕即可完成報告某個帖子的操作。'),(25,7,2,'','','我如何「打印」，「推薦」，「訂閱」，「收藏」帖子','當你瀏覽一個帖子時，在它的右上角可以看到：「打印」、「推薦」、「訂閱」、「收藏」，點擊相對應的文字連接即可完成相關的操作。'),(26,7,3,'','','我如何設置論壇好友','設置論壇好友有3種簡單的方法。\r\n<ul>\r\n<li>當您瀏覽帖子的時候可以點擊「發表時間」右側的「加為好友」設置論壇好友。</li>\r\n<li>當您瀏覽某用戶的個人資料時，可以點擊頭像下方的「加為好友」設置論壇好友。</li>\r\n<li>您也可以在控制面板中的好友列表增加您的論壇好友。</li>\r\n<ul>'),(27,7,4,'','','我如何使用RSS訂閱','在論壇的首頁和進入版塊的頁面的右上角就會出現一個rss訂閱的小圖標<img src=\"images/common/xml.gif\" border=\"0\">，鼠標點擊之後將出現本站點的rss地址，你可以將此rss地址放入到你的rss閱讀器中進行訂閱。'),(28,7,5,'','','我如何清除Cookies','cookie是由瀏覽器保存在系統內的，在論壇的右下角提供有\"清除 Cookies\"的功能，點擊後即可幫您清除系統內存儲的Cookies。 <br /><br />\r\n以下介紹3種常用瀏覽器的Cookies清除方法(註：此方法為清除全部的Cookies,請謹慎使用)\r\n<ul>\r\n<li>Internet Explorer: 工具（選項）內的Internet選項→常規選項卡內，IE6直接可以看到刪除Cookies的按鈕點擊即可，IE7為「瀏 覽歷史記錄」選項內的刪除點擊即可清空Cookies。對於Maxthon,騰訊TT等IE核心瀏覽器一樣適用。 </li>\r\n<li>FireFox:工具→選項→隱私→Cookies→顯示Cookie裡可以對Cookie進行對應的刪除操作。 </li>\r\n<li>Opera:工具→首選項→高級→Cookies→管理Cookies即可對Cookies進行刪除的操作。</li>\r\n</ul>'),(29,7,6,'','','我如何聯繫管理員','您可以通過論壇底部右下角的「聯繫我們」鏈接快速的發送郵件與我們聯繫。也可以通過管理團隊中的用戶資料發送短消息給我們。'),(30,7,7,'','','我如何開通個人空間','如果您有權限開通「我的個人空間」，當用戶登錄論壇以後在論壇首頁，用戶名的右方點擊開通我的個人空間，進入個人空間的申請頁面。'),(31,7,8,'','','我如何將自己的主題加入個人空間','如果您有權限開通「我的個人空間」，在您發表的主題上方點擊「加入個人空間」，您發表的主題以及回復都會加入到您空間的日誌裡。'),(32,5,9,'smilies','表情','我如何使用表情代碼','表情是一些用字符表示的表情符號，如果打開表情功能，Discuz! 會把一些符號轉換成小圖像，顯示在帖子中，更加美觀明瞭。目前支持下面這些表情：<br /><br />\r\n<table cellspacing=\"0\" cellpadding=\"4\" width=\"30%\" align=\"center\">\r\n<tr><th width=\"25%\" align=\"center\">表情符號</td>\r\n<th width=\"75%\" align=\"center\">對應圖像</td>\r\n</tr>\r\n<tr>\r\n<td width=\"25%\" align=\"center\">:)</td>\r\n<td width=\"75%\" align=\"center\"><img src=\"images/smilies/default/smile.gif\" alt=\"\" /></td>\r\n</tr>\r\n<tr>\r\n<td width=\"25%\" align=\"center\">:(</td>\r\n<td width=\"75%\" align=\"center\"><img src=\"images/smilies/default/sad.gif\" alt=\"\" /></td>\r\n</tr>\r\n<tr>\r\n<td width=\"25%\" align=\"center\">:D</td>\r\n<td width=\"75%\" align=\"center\"><img src=\"images/smilies/default/biggrin.gif\" alt=\"\" /></td>\r\n</tr>\r\n<tr>\r\n<td width=\"25%\" align=\"center\">:\\\'(</td>\r\n<td width=\"75%\" align=\"center\"><img src=\"images/smilies/default/cry.gif\" alt=\"\" /></td>\r\n</tr>\r\n<tr>\r\n<td width=\"25%\" align=\"center\">:@</td>\r\n<td width=\"75%\" align=\"center\"><img src=\"images/smilies/default/huffy.gif\" alt=\"\" /></td>\r\n</tr>\r\n<tr>\r\n<td width=\"25%\" align=\"center\">:o</td>\r\n<td width=\"75%\" align=\"center\"><img src=\"images/smilies/default/shocked.gif\" alt=\"\" /></td>\r\n</tr>\r\n<tr>\r\n<td width=\"25%\" align=\"center\">:P</td>\r\n<td width=\"75%\" align=\"center\"><img src=\"images/smilies/default/tongue.gif\" alt=\"\" /></td>\r\n</tr>\r\n<tr>\r\n<td width=\"25%\" align=\"center\">:$</td>\r\n<td width=\"75%\" align=\"center\"><img src=\"images/smilies/default/shy.gif\" alt=\"\" /></td>\r\n</tr>\r\n<tr>\r\n<td width=\"25%\" align=\"center\">;P</td>\r\n<td width=\"75%\" align=\"center\"><img src=\"images/smilies/default/titter.gif\" alt=\"\" /></td>\r\n</tr>\r\n<tr>\r\n<td width=\"25%\" align=\"center\">:L</td>\r\n<td width=\"75%\" align=\"center\"><img src=\"images/smilies/default/sweat.gif\" alt=\"\" /></td>\r\n</tr>\r\n<tr>\r\n<td width=\"25%\" align=\"center\">:Q</td>\r\n<td width=\"75%\" align=\"center\"><img src=\"images/smilies/default/mad.gif\" alt=\"\" /></td>\r\n</tr>\r\n<tr>\r\n<td width=\"25%\" align=\"center\">:lol</td>\r\n<td width=\"75%\" align=\"center\"><img src=\"images/smilies/default/lol.gif\" alt=\"\" /></td>\r\n</tr>\r\n<tr>\r\n<td width=\"25%\" align=\"center\">:hug:</td>\r\n<td width=\"75%\" align=\"center\"><img src=\"images/smilies/default/hug.gif\" alt=\"\" /></td>\r\n</tr>\r\n<tr>\r\n<td width=\"25%\" align=\"center\">:victory:</td>\r\n<td width=\"75%\" align=\"center\"><img src=\"images/smilies/default/victory.gif\" alt=\"\" /></td>\r\n</tr>\r\n<tr>\r\n<td width=\"25%\" align=\"center\">:time:</td>\r\n<td width=\"75%\" align=\"center\"><img src=\"images/smilies/default/time.gif\" alt=\"\" /></td>\r\n</tr>\r\n<tr>\r\n<td width=\"25%\" align=\"center\">:kiss:</td>\r\n<td width=\"75%\" align=\"center\"><img src=\"images/smilies/default/kiss.gif\" alt=\"\" /></td>\r\n</tr>\r\n<tr>\r\n<td width=\"25%\" align=\"center\">:handshake</td>\r\n<td width=\"75%\" align=\"center\"><img src=\"images/smilies/default/handshake.gif\" alt=\"\" /></td>\r\n</tr>\r\n<tr>\r\n<td width=\"25%\" align=\"center\">:call:</td>\r\n<td width=\"75%\" align=\"center\"><img src=\"images/smilies/default/call.gif\" alt=\"\" /></td>\r\n</tr>\r\n</table>\r\n</div></div>\r\n<br />'),(33,0,5,'','','論壇高級功能使用',''),(34,33,0,'forwardmessagelist','','論壇快速跳轉關鍵字列表','Discuz! 支持自定義快速跳轉頁面，當某些操作完成後，可以不顯示提示信息，直接跳轉到新的頁面，從而方便用戶進行下一步操作，避免等待。 在實際使用當中，您根據需要，把關鍵字添加到快速跳轉設置裡面(後台 -- 基本設置 --  界面與顯示方式 -- [<a href=\"admincp.php?action=settings&operation=styles&frames=yes\" target=\"_blank\">提示信息跳轉設置</a> ])，讓某些信息不顯示而實現快速跳轉。以下是 Discuz! 當中的一些常用信息的關鍵字:\r\n</br></br>\r\n\r\n<table width=\"99%\" cellpadding=\"2\" cellspacing=\"2\">\r\n  <tr>\r\n    <td width=\"50%\">關鍵字</td>\r\n    <td width=\"50%\">提示信息頁面或者作用</td>\r\n  </tr>\r\n  <tr>\r\n    <td>login_succeed</td>\r\n    <td>登錄成功</td>\r\n  </tr>\r\n  <tr>\r\n    <td>logout_succeed</td>\r\n    <td>退出登錄成功</td>\r\n  </tr>\r\n    <tr>\r\n    <td>thread_poll_succeed</td>\r\n    <td>投票成功</td>\r\n  </tr>\r\n    <tr>\r\n    <td>thread_rate_succeed</td>\r\n    <td>評分成功</td>\r\n  </tr>\r\n    <tr>\r\n    <td>register_succeed</td>\r\n    <td>註冊成功</td>\r\n  </tr>\r\n    <tr>\r\n    <td>usergroups_join_succeed</td>\r\n    <td>加入擴展組成功</td>\r\n  </tr>\r\n    <tr>\r\n    <td height=\"22\">usergroups_exit_succeed</td>\r\n    <td>退出擴展組成功</td>\r\n  </tr>\r\n  <tr>\r\n    <td>usergroups_update_succeed</td>\r\n    <td>更新擴展組成功</td>\r\n  </tr>\r\n    <tr>\r\n    <td>buddy_update_succeed</td>\r\n    <td>好友更新成功</td>\r\n  </tr>\r\n    <tr>\r\n    <td>post_edit_succeed</td>\r\n    <td>編輯帖子成功</td>\r\n  </tr>\r\n    <tr>\r\n    <td>post_edit_delete_succeed</td>\r\n    <td>刪除帖子成功</td>\r\n  </tr>\r\n    <tr>\r\n    <td>post_reply_succeed</td>\r\n    <td>回復成功</td>\r\n  </tr>\r\n    <tr>\r\n    <td>post_newthread_succeed</td>\r\n    <td>發表新主題成功</td>\r\n  </tr>\r\n    <tr>\r\n    <td>post_reply_blog_succeed</td>\r\n    <td>文集評論發表成功</td>\r\n  </tr>\r\n    <tr>\r\n    <td>post_newthread_blog_succeed</td>\r\n    <td>blog 發表成功</td>\r\n  </tr>\r\n    <tr>\r\n    <td>profile_avatar_succeed</td>\r\n    <td>頭像設置成功</td>\r\n  </tr>\r\n    <tr>\r\n    <td>profile_succeed</td>\r\n    <td>個人資料更新成功</td>\r\n  </tr>\r\n    <tr>\r\n    <td>pm_send_succeed</td>\r\n    <td>短消息發送成功</td>\r\n  </tr>\r\n  </tr>\r\n    <tr>\r\n    <td>pm_delete_succeed</td>\r\n    <td>短消息刪除成功</td>\r\n  </tr>\r\n  </tr>\r\n    <tr>\r\n    <td>pm_ignore_succeed</td>\r\n    <td>短消息忽略列表更新</td>\r\n  </tr>\r\n    <tr>\r\n    <td>admin_succeed</td>\r\n    <td>管理操作成功〔注意：設置此關鍵字後，所有管理操作完畢都將直接跳轉〕</td>\r\n  </tr>\r\n    <tr>\r\n    <td>admin_succeed_next&nbsp;</td>\r\n    <td>管理成功並將跳轉到下一個管理動作</td>\r\n  </tr> \r\n    <tr>\r\n    <td>search_redirect</td>\r\n    <td>搜索完成，進入搜索結果列表</td>\r\n  </tr>\r\n</table>');
/*!40000 ALTER TABLE `cdb_faqs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cdb_favoriteforums`
--

DROP TABLE IF EXISTS `cdb_favoriteforums`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cdb_favoriteforums` (
  `fid` smallint(6) NOT NULL DEFAULT '0',
  `uid` mediumint(8) NOT NULL DEFAULT '0',
  `dateline` int(10) NOT NULL DEFAULT '0',
  `newthreads` mediumint(8) NOT NULL DEFAULT '0',
  PRIMARY KEY (`fid`,`uid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cdb_favoriteforums`
--

LOCK TABLES `cdb_favoriteforums` WRITE;
/*!40000 ALTER TABLE `cdb_favoriteforums` DISABLE KEYS */;
/*!40000 ALTER TABLE `cdb_favoriteforums` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cdb_favorites`
--

DROP TABLE IF EXISTS `cdb_favorites`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cdb_favorites` (
  `uid` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `tid` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `fid` smallint(6) unsigned NOT NULL DEFAULT '0',
  KEY `uid` (`uid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cdb_favorites`
--

LOCK TABLES `cdb_favorites` WRITE;
/*!40000 ALTER TABLE `cdb_favorites` DISABLE KEYS */;
/*!40000 ALTER TABLE `cdb_favorites` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cdb_favoritethreads`
--

DROP TABLE IF EXISTS `cdb_favoritethreads`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cdb_favoritethreads` (
  `tid` mediumint(8) NOT NULL DEFAULT '0',
  `uid` mediumint(8) NOT NULL DEFAULT '0',
  `dateline` int(10) NOT NULL DEFAULT '0',
  `newreplies` smallint(6) NOT NULL DEFAULT '0',
  PRIMARY KEY (`tid`,`uid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cdb_favoritethreads`
--

LOCK TABLES `cdb_favoritethreads` WRITE;
/*!40000 ALTER TABLE `cdb_favoritethreads` DISABLE KEYS */;
/*!40000 ALTER TABLE `cdb_favoritethreads` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cdb_feeds`
--

DROP TABLE IF EXISTS `cdb_feeds`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cdb_feeds` (
  `feed_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `type` varchar(255) NOT NULL DEFAULT 'default',
  `fid` smallint(6) unsigned NOT NULL DEFAULT '0',
  `typeid` smallint(6) unsigned NOT NULL DEFAULT '0',
  `sortid` smallint(6) unsigned NOT NULL DEFAULT '0',
  `appid` varchar(30) NOT NULL DEFAULT '',
  `uid` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `username` varchar(15) NOT NULL DEFAULT '',
  `data` text NOT NULL,
  `template` text NOT NULL,
  `dateline` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`feed_id`),
  KEY `type` (`type`),
  KEY `dateline` (`dateline`),
  KEY `uid` (`uid`),
  KEY `appid` (`appid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cdb_feeds`
--

LOCK TABLES `cdb_feeds` WRITE;
/*!40000 ALTER TABLE `cdb_feeds` DISABLE KEYS */;
/*!40000 ALTER TABLE `cdb_feeds` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cdb_forumfields`
--

DROP TABLE IF EXISTS `cdb_forumfields`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cdb_forumfields` (
  `fid` smallint(6) unsigned NOT NULL DEFAULT '0',
  `description` text NOT NULL,
  `password` varchar(12) NOT NULL DEFAULT '',
  `icon` varchar(255) NOT NULL DEFAULT '',
  `postcredits` varchar(255) NOT NULL DEFAULT '',
  `replycredits` varchar(255) NOT NULL DEFAULT '',
  `getattachcredits` varchar(255) NOT NULL DEFAULT '',
  `postattachcredits` varchar(255) NOT NULL DEFAULT '',
  `digestcredits` varchar(255) NOT NULL DEFAULT '',
  `redirect` varchar(255) NOT NULL DEFAULT '',
  `attachextensions` varchar(255) NOT NULL DEFAULT '',
  `formulaperm` text NOT NULL,
  `moderators` text NOT NULL,
  `rules` text NOT NULL,
  `threadtypes` text NOT NULL,
  `threadsorts` text NOT NULL,
  `viewperm` text NOT NULL,
  `postperm` text NOT NULL,
  `replyperm` text NOT NULL,
  `getattachperm` text NOT NULL,
  `postattachperm` text NOT NULL,
  `keywords` text NOT NULL,
  `supe_pushsetting` text NOT NULL,
  `modrecommend` text NOT NULL,
  `tradetypes` text NOT NULL,
  `typemodels` mediumtext NOT NULL,
  `threadplugin` text NOT NULL,
  `extra` text NOT NULL,
  PRIMARY KEY (`fid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cdb_forumfields`
--

LOCK TABLES `cdb_forumfields` WRITE;
/*!40000 ALTER TABLE `cdb_forumfields` DISABLE KEYS */;
INSERT INTO `cdb_forumfields` VALUES (1,'','','','','','','','','','','','','','','','','','','','','','','','','','',''),(2,'','','','','','','','','','','','','','','','','','','','','','','','','','','');
/*!40000 ALTER TABLE `cdb_forumfields` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cdb_forumlinks`
--

DROP TABLE IF EXISTS `cdb_forumlinks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cdb_forumlinks` (
  `id` smallint(6) unsigned NOT NULL AUTO_INCREMENT,
  `displayorder` tinyint(3) NOT NULL DEFAULT '0',
  `name` varchar(100) NOT NULL DEFAULT '',
  `url` varchar(255) NOT NULL DEFAULT '',
  `description` mediumtext NOT NULL,
  `logo` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cdb_forumlinks`
--

LOCK TABLES `cdb_forumlinks` WRITE;
/*!40000 ALTER TABLE `cdb_forumlinks` DISABLE KEYS */;
INSERT INTO `cdb_forumlinks` VALUES (1,0,'Discuz! 官方論壇','http://www.discuz.net','提供最新 Discuz! 產品新聞、軟件下載與技術交流','images/logo.gif');
/*!40000 ALTER TABLE `cdb_forumlinks` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cdb_forumrecommend`
--

DROP TABLE IF EXISTS `cdb_forumrecommend`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cdb_forumrecommend` (
  `fid` smallint(6) unsigned NOT NULL,
  `tid` mediumint(8) unsigned NOT NULL,
  `typeid` smallint(6) NOT NULL,
  `displayorder` tinyint(1) NOT NULL,
  `subject` char(80) NOT NULL,
  `author` char(15) NOT NULL,
  `authorid` mediumint(8) NOT NULL,
  `moderatorid` mediumint(8) NOT NULL,
  `expiration` int(10) unsigned NOT NULL,
  `position` tinyint(1) NOT NULL DEFAULT '0',
  `highlight` tinyint(1) NOT NULL DEFAULT '0',
  `aid` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `filename` char(100) NOT NULL DEFAULT '',
  PRIMARY KEY (`tid`),
  KEY `displayorder` (`fid`,`displayorder`),
  KEY `position` (`position`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cdb_forumrecommend`
--

LOCK TABLES `cdb_forumrecommend` WRITE;
/*!40000 ALTER TABLE `cdb_forumrecommend` DISABLE KEYS */;
/*!40000 ALTER TABLE `cdb_forumrecommend` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cdb_forums`
--

DROP TABLE IF EXISTS `cdb_forums`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cdb_forums` (
  `fid` smallint(6) unsigned NOT NULL AUTO_INCREMENT,
  `fup` smallint(6) unsigned NOT NULL DEFAULT '0',
  `type` enum('group','forum','sub') NOT NULL DEFAULT 'forum',
  `name` char(50) NOT NULL DEFAULT '',
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `displayorder` smallint(6) NOT NULL DEFAULT '0',
  `styleid` smallint(6) unsigned NOT NULL DEFAULT '0',
  `threads` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `posts` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `todayposts` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `lastpost` char(110) NOT NULL DEFAULT '',
  `allowsmilies` tinyint(1) NOT NULL DEFAULT '0',
  `allowhtml` tinyint(1) NOT NULL DEFAULT '0',
  `allowbbcode` tinyint(1) NOT NULL DEFAULT '0',
  `allowimgcode` tinyint(1) NOT NULL DEFAULT '0',
  `allowmediacode` tinyint(1) NOT NULL DEFAULT '0',
  `allowanonymous` tinyint(1) NOT NULL DEFAULT '0',
  `allowshare` tinyint(1) NOT NULL DEFAULT '0',
  `allowpostspecial` smallint(6) unsigned NOT NULL DEFAULT '0',
  `allowspecialonly` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `alloweditrules` tinyint(1) NOT NULL DEFAULT '0',
  `allowfeed` tinyint(1) NOT NULL DEFAULT '1',
  `recyclebin` tinyint(1) NOT NULL DEFAULT '0',
  `modnewposts` tinyint(1) NOT NULL DEFAULT '0',
  `jammer` tinyint(1) NOT NULL DEFAULT '0',
  `disablewatermark` tinyint(1) NOT NULL DEFAULT '0',
  `inheritedmod` tinyint(1) NOT NULL DEFAULT '0',
  `autoclose` smallint(6) NOT NULL DEFAULT '0',
  `forumcolumns` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `threadcaches` tinyint(1) NOT NULL DEFAULT '0',
  `alloweditpost` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `simple` tinyint(1) unsigned NOT NULL,
  `modworks` tinyint(1) unsigned NOT NULL,
  `allowtag` tinyint(1) NOT NULL DEFAULT '1',
  `allowglobalstick` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`fid`),
  KEY `forum` (`status`,`type`,`displayorder`),
  KEY `fup` (`fup`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cdb_forums`
--

LOCK TABLES `cdb_forums` WRITE;
/*!40000 ALTER TABLE `cdb_forums` DISABLE KEYS */;
INSERT INTO `cdb_forums` VALUES (1,0,'group','Discuz!',1,0,0,0,0,0,'',0,0,1,1,1,0,1,63,0,0,1,0,0,0,0,0,0,0,0,1,0,0,1,1),(2,1,'forum','默認版塊',1,0,0,0,0,0,'',1,0,1,1,1,0,1,63,0,0,1,0,0,0,0,0,0,0,0,1,0,0,1,1);
/*!40000 ALTER TABLE `cdb_forums` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cdb_imagetypes`
--

DROP TABLE IF EXISTS `cdb_imagetypes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cdb_imagetypes` (
  `typeid` smallint(6) unsigned NOT NULL AUTO_INCREMENT,
  `available` tinyint(1) NOT NULL DEFAULT '0',
  `name` char(20) NOT NULL,
  `type` enum('smiley','icon','avatar') NOT NULL DEFAULT 'smiley',
  `displayorder` tinyint(3) NOT NULL DEFAULT '0',
  `directory` char(100) NOT NULL,
  PRIMARY KEY (`typeid`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cdb_imagetypes`
--

LOCK TABLES `cdb_imagetypes` WRITE;
/*!40000 ALTER TABLE `cdb_imagetypes` DISABLE KEYS */;
INSERT INTO `cdb_imagetypes` VALUES (1,1,'默認','smiley',1,'default'),(2,1,'酷猴','smiley',2,'coolmonkey'),(3,1,'呆呆男','smiley',3,'grapeman');
/*!40000 ALTER TABLE `cdb_imagetypes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cdb_invites`
--

DROP TABLE IF EXISTS `cdb_invites`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cdb_invites` (
  `uid` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `dateline` int(10) unsigned NOT NULL DEFAULT '0',
  `expiration` int(10) unsigned NOT NULL DEFAULT '0',
  `inviteip` char(15) NOT NULL,
  `invitecode` char(16) NOT NULL,
  `reguid` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `regdateline` int(10) unsigned NOT NULL DEFAULT '0',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  KEY `uid` (`uid`,`status`),
  KEY `invitecode` (`invitecode`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cdb_invites`
--

LOCK TABLES `cdb_invites` WRITE;
/*!40000 ALTER TABLE `cdb_invites` DISABLE KEYS */;
/*!40000 ALTER TABLE `cdb_invites` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cdb_itempool`
--

DROP TABLE IF EXISTS `cdb_itempool`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cdb_itempool` (
  `id` smallint(6) unsigned NOT NULL AUTO_INCREMENT,
  `type` tinyint(1) unsigned NOT NULL,
  `question` text NOT NULL,
  `answer` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cdb_itempool`
--

LOCK TABLES `cdb_itempool` WRITE;
/*!40000 ALTER TABLE `cdb_itempool` DISABLE KEYS */;
/*!40000 ALTER TABLE `cdb_itempool` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cdb_magiclog`
--

DROP TABLE IF EXISTS `cdb_magiclog`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cdb_magiclog` (
  `uid` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `magicid` smallint(6) unsigned NOT NULL DEFAULT '0',
  `action` tinyint(1) NOT NULL DEFAULT '0',
  `dateline` int(10) unsigned NOT NULL DEFAULT '0',
  `amount` smallint(6) unsigned NOT NULL DEFAULT '0',
  `price` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `targettid` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `targetpid` int(10) unsigned NOT NULL DEFAULT '0',
  `targetuid` mediumint(8) unsigned NOT NULL DEFAULT '0',
  KEY `uid` (`uid`,`dateline`),
  KEY `targetuid` (`targetuid`,`dateline`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cdb_magiclog`
--

LOCK TABLES `cdb_magiclog` WRITE;
/*!40000 ALTER TABLE `cdb_magiclog` DISABLE KEYS */;
/*!40000 ALTER TABLE `cdb_magiclog` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cdb_magicmarket`
--

DROP TABLE IF EXISTS `cdb_magicmarket`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cdb_magicmarket` (
  `mid` smallint(6) unsigned NOT NULL AUTO_INCREMENT,
  `magicid` smallint(6) unsigned NOT NULL DEFAULT '0',
  `uid` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `username` char(15) NOT NULL,
  `price` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `num` smallint(6) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`mid`),
  KEY `num` (`magicid`,`num`),
  KEY `price` (`magicid`,`price`),
  KEY `uid` (`uid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cdb_magicmarket`
--

LOCK TABLES `cdb_magicmarket` WRITE;
/*!40000 ALTER TABLE `cdb_magicmarket` DISABLE KEYS */;
/*!40000 ALTER TABLE `cdb_magicmarket` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cdb_magics`
--

DROP TABLE IF EXISTS `cdb_magics`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cdb_magics` (
  `magicid` smallint(6) unsigned NOT NULL AUTO_INCREMENT,
  `available` tinyint(1) NOT NULL DEFAULT '0',
  `type` tinyint(3) NOT NULL DEFAULT '0',
  `name` varchar(50) NOT NULL,
  `identifier` varchar(40) NOT NULL,
  `description` varchar(255) NOT NULL,
  `displayorder` tinyint(3) NOT NULL DEFAULT '0',
  `price` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `num` smallint(6) unsigned NOT NULL DEFAULT '0',
  `salevolume` smallint(6) unsigned NOT NULL DEFAULT '0',
  `supplytype` tinyint(1) NOT NULL DEFAULT '0',
  `supplynum` smallint(6) unsigned NOT NULL DEFAULT '0',
  `weight` tinyint(3) unsigned NOT NULL DEFAULT '1',
  `recommend` tinyint(1) NOT NULL DEFAULT '0',
  `filename` varchar(50) NOT NULL,
  `magicperm` text NOT NULL,
  PRIMARY KEY (`magicid`),
  UNIQUE KEY `identifier` (`identifier`),
  KEY `displayorder` (`available`,`displayorder`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cdb_magics`
--

LOCK TABLES `cdb_magics` WRITE;
/*!40000 ALTER TABLE `cdb_magics` DISABLE KEYS */;
INSERT INTO `cdb_magics` VALUES (1,1,1,'變色卡','CCK','可以變換主題的顏色,並保存24小時',0,10,999,0,0,0,20,0,'magic_color.inc.php',''),(2,1,3,'金錢卡','MOK','可以隨機獲得一些金幣',0,10,999,0,0,0,30,0,'magic_money.inc.php',''),(3,1,1,'IP卡','SEK','可以查看帖子作者的IP',0,15,999,0,0,0,30,0,'magic_see.inc.php',''),(4,1,1,'提升卡','UPK','可以提升某個主題',0,10,999,0,0,0,30,0,'magic_up.inc.php',''),(5,1,1,'置頂卡','TOK','可以將主題置頂24小時',0,20,999,0,0,0,40,0,'magic_top.inc.php',''),(6,1,1,'悔悟卡','REK','可以刪除自己的帖子',0,10,999,0,0,0,30,0,'magic_del.inc.php',''),(7,1,2,'狗仔卡','RTK','查看某個用戶是否在線',0,15,999,0,0,0,30,0,'magic_reporter.inc.php',''),(8,1,1,'沉默卡','CLK','24小時內不能回復',0,15,999,0,0,0,30,0,'magic_close.inc.php',''),(9,1,1,'喧囂卡','OPK','使貼子可以回復',0,15,999,0,0,0,30,0,'magic_open.inc.php',''),(10,1,1,'隱身卡','YSK','可以將自己的帖子匿名',0,20,999,0,0,0,30,0,'magic_hidden.inc.php',''),(11,1,1,'恢復卡','CBK','將匿名恢復為正常顯示的用戶名,匿名終結者',0,15,999,0,0,0,20,0,'magic_renew.inc.php',''),(12,1,1,'移動卡','MVK','可將自已的帖子移動到其他版面（隱含、特殊限定版面除外）',0,50,989,0,0,0,50,0,'magic_move.inc.php','');
/*!40000 ALTER TABLE `cdb_magics` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cdb_medallog`
--

DROP TABLE IF EXISTS `cdb_medallog`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cdb_medallog` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `uid` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `medalid` smallint(6) unsigned NOT NULL DEFAULT '0',
  `type` tinyint(1) NOT NULL DEFAULT '0',
  `dateline` int(10) unsigned NOT NULL DEFAULT '0',
  `expiration` int(10) unsigned NOT NULL DEFAULT '0',
  `status` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `type` (`type`),
  KEY `status` (`status`,`expiration`),
  KEY `uid` (`uid`,`medalid`,`type`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cdb_medallog`
--

LOCK TABLES `cdb_medallog` WRITE;
/*!40000 ALTER TABLE `cdb_medallog` DISABLE KEYS */;
/*!40000 ALTER TABLE `cdb_medallog` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cdb_medals`
--

DROP TABLE IF EXISTS `cdb_medals`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cdb_medals` (
  `medalid` smallint(6) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL DEFAULT '',
  `available` tinyint(1) NOT NULL DEFAULT '0',
  `image` varchar(255) NOT NULL DEFAULT '',
  `type` tinyint(1) NOT NULL DEFAULT '0',
  `displayorder` tinyint(3) NOT NULL DEFAULT '0',
  `description` varchar(255) NOT NULL,
  `expiration` smallint(6) unsigned NOT NULL DEFAULT '0',
  `permission` mediumtext NOT NULL,
  PRIMARY KEY (`medalid`),
  KEY `displayorder` (`displayorder`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cdb_medals`
--

LOCK TABLES `cdb_medals` WRITE;
/*!40000 ALTER TABLE `cdb_medals` DISABLE KEYS */;
INSERT INTO `cdb_medals` VALUES (1,'Medal No.1',0,'medal1.gif',0,0,'',0,''),(2,'Medal No.2',0,'medal2.gif',0,0,'',0,''),(3,'Medal No.3',0,'medal3.gif',0,0,'',0,''),(4,'Medal No.4',0,'medal4.gif',0,0,'',0,''),(5,'Medal No.5',0,'medal5.gif',0,0,'',0,''),(6,'Medal No.6',0,'medal6.gif',0,0,'',0,''),(7,'Medal No.7',0,'medal7.gif',0,0,'',0,''),(8,'Medal No.8',0,'medal8.gif',0,0,'',0,''),(9,'Medal No.9',0,'medal9.gif',0,0,'',0,''),(10,'Medal No.10',0,'medal10.gif',0,0,'',0,'');
/*!40000 ALTER TABLE `cdb_medals` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cdb_memberfields`
--

DROP TABLE IF EXISTS `cdb_memberfields`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cdb_memberfields` (
  `uid` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `nickname` varchar(30) NOT NULL DEFAULT '',
  `site` varchar(75) NOT NULL DEFAULT '',
  `alipay` varchar(50) NOT NULL DEFAULT '',
  `icq` varchar(12) NOT NULL DEFAULT '',
  `qq` varchar(12) NOT NULL DEFAULT '',
  `yahoo` varchar(40) NOT NULL DEFAULT '',
  `msn` varchar(100) NOT NULL DEFAULT '',
  `taobao` varchar(40) NOT NULL DEFAULT '',
  `location` varchar(30) NOT NULL DEFAULT '',
  `customstatus` varchar(30) NOT NULL DEFAULT '',
  `medals` text NOT NULL,
  `avatar` varchar(255) NOT NULL DEFAULT '',
  `avatarwidth` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `avatarheight` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `bio` text NOT NULL,
  `sightml` text NOT NULL,
  `ignorepm` text NOT NULL,
  `groupterms` text NOT NULL,
  `authstr` varchar(20) NOT NULL DEFAULT '',
  `spacename` varchar(40) NOT NULL,
  `buyercredit` smallint(6) NOT NULL DEFAULT '0',
  `sellercredit` smallint(6) NOT NULL DEFAULT '0',
  PRIMARY KEY (`uid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cdb_memberfields`
--

LOCK TABLES `cdb_memberfields` WRITE;
/*!40000 ALTER TABLE `cdb_memberfields` DISABLE KEYS */;
INSERT INTO `cdb_memberfields` VALUES (1,'','','','','','','','','','','','',0,0,'','','','','','',0,0);
/*!40000 ALTER TABLE `cdb_memberfields` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cdb_membermagics`
--

DROP TABLE IF EXISTS `cdb_membermagics`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cdb_membermagics` (
  `uid` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `magicid` smallint(6) unsigned NOT NULL DEFAULT '0',
  `num` smallint(6) unsigned NOT NULL DEFAULT '0',
  KEY `uid` (`uid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cdb_membermagics`
--

LOCK TABLES `cdb_membermagics` WRITE;
/*!40000 ALTER TABLE `cdb_membermagics` DISABLE KEYS */;
/*!40000 ALTER TABLE `cdb_membermagics` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cdb_memberrecommend`
--

DROP TABLE IF EXISTS `cdb_memberrecommend`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cdb_memberrecommend` (
  `tid` mediumint(8) unsigned NOT NULL,
  `recommenduid` mediumint(8) unsigned NOT NULL,
  `dateline` int(10) unsigned NOT NULL,
  KEY `tid` (`tid`),
  KEY `uid` (`recommenduid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cdb_memberrecommend`
--

LOCK TABLES `cdb_memberrecommend` WRITE;
/*!40000 ALTER TABLE `cdb_memberrecommend` DISABLE KEYS */;
/*!40000 ALTER TABLE `cdb_memberrecommend` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cdb_members`
--

DROP TABLE IF EXISTS `cdb_members`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cdb_members` (
  `uid` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `username` char(15) NOT NULL DEFAULT '',
  `password` char(32) NOT NULL DEFAULT '',
  `secques` char(8) NOT NULL DEFAULT '',
  `gender` tinyint(1) NOT NULL DEFAULT '0',
  `adminid` tinyint(1) NOT NULL DEFAULT '0',
  `groupid` smallint(6) unsigned NOT NULL DEFAULT '0',
  `groupexpiry` int(10) unsigned NOT NULL DEFAULT '0',
  `extgroupids` char(20) NOT NULL DEFAULT '',
  `regip` char(15) NOT NULL DEFAULT '',
  `regdate` int(10) unsigned NOT NULL DEFAULT '0',
  `lastip` char(15) NOT NULL DEFAULT '',
  `lastvisit` int(10) unsigned NOT NULL DEFAULT '0',
  `lastactivity` int(10) unsigned NOT NULL DEFAULT '0',
  `lastpost` int(10) unsigned NOT NULL DEFAULT '0',
  `posts` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `threads` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `digestposts` smallint(6) unsigned NOT NULL DEFAULT '0',
  `oltime` smallint(6) unsigned NOT NULL DEFAULT '0',
  `pageviews` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `credits` int(10) NOT NULL DEFAULT '0',
  `extcredits1` int(10) NOT NULL DEFAULT '0',
  `extcredits2` int(10) NOT NULL DEFAULT '0',
  `extcredits3` int(10) NOT NULL DEFAULT '0',
  `extcredits4` int(10) NOT NULL DEFAULT '0',
  `extcredits5` int(10) NOT NULL DEFAULT '0',
  `extcredits6` int(10) NOT NULL DEFAULT '0',
  `extcredits7` int(10) NOT NULL DEFAULT '0',
  `extcredits8` int(10) NOT NULL DEFAULT '0',
  `email` char(40) NOT NULL DEFAULT '',
  `bday` date NOT NULL DEFAULT '0000-00-00',
  `sigstatus` tinyint(1) NOT NULL DEFAULT '0',
  `tpp` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `ppp` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `styleid` smallint(6) unsigned NOT NULL DEFAULT '0',
  `dateformat` tinyint(1) NOT NULL DEFAULT '0',
  `timeformat` tinyint(1) NOT NULL DEFAULT '0',
  `pmsound` tinyint(1) NOT NULL DEFAULT '0',
  `showemail` tinyint(1) NOT NULL DEFAULT '0',
  `newsletter` tinyint(1) NOT NULL DEFAULT '0',
  `invisible` tinyint(1) NOT NULL DEFAULT '0',
  `timeoffset` char(4) NOT NULL DEFAULT '',
  `prompt` tinyint(1) NOT NULL DEFAULT '0',
  `accessmasks` tinyint(1) NOT NULL DEFAULT '0',
  `editormode` tinyint(1) unsigned NOT NULL DEFAULT '2',
  `customshow` tinyint(1) unsigned NOT NULL DEFAULT '26',
  `xspacestatus` tinyint(1) NOT NULL DEFAULT '0',
  `customaddfeed` tinyint(1) NOT NULL DEFAULT '0',
  `newbietaskid` smallint(6) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`uid`),
  UNIQUE KEY `username` (`username`),
  KEY `email` (`email`),
  KEY `groupid` (`groupid`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cdb_members`
--

LOCK TABLES `cdb_members` WRITE;
/*!40000 ALTER TABLE `cdb_members` DISABLE KEYS */;
INSERT INTO `cdb_members` VALUES (1,'admin','acd7d906737f8eba2c9ef669ff0e860c','',0,1,1,0,'','hidden',1310993153,'',1310993153,0,1310993153,0,0,0,0,0,0,0,0,0,0,0,0,0,0,'wwkk2001-2009@yahoo.com.hk','0000-00-00',0,0,0,0,0,0,0,1,1,0,'9999',0,0,2,26,0,0,0);
/*!40000 ALTER TABLE `cdb_members` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cdb_memberspaces`
--

DROP TABLE IF EXISTS `cdb_memberspaces`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cdb_memberspaces` (
  `uid` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `style` char(20) NOT NULL,
  `description` char(100) NOT NULL,
  `layout` char(200) NOT NULL,
  `side` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`uid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cdb_memberspaces`
--

LOCK TABLES `cdb_memberspaces` WRITE;
/*!40000 ALTER TABLE `cdb_memberspaces` DISABLE KEYS */;
/*!40000 ALTER TABLE `cdb_memberspaces` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cdb_moderators`
--

DROP TABLE IF EXISTS `cdb_moderators`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cdb_moderators` (
  `uid` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `fid` smallint(6) unsigned NOT NULL DEFAULT '0',
  `displayorder` tinyint(3) NOT NULL DEFAULT '0',
  `inherited` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`uid`,`fid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cdb_moderators`
--

LOCK TABLES `cdb_moderators` WRITE;
/*!40000 ALTER TABLE `cdb_moderators` DISABLE KEYS */;
/*!40000 ALTER TABLE `cdb_moderators` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cdb_modworks`
--

DROP TABLE IF EXISTS `cdb_modworks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cdb_modworks` (
  `uid` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `modaction` char(3) NOT NULL DEFAULT '',
  `dateline` date NOT NULL DEFAULT '2006-01-01',
  `count` smallint(6) unsigned NOT NULL DEFAULT '0',
  `posts` smallint(6) unsigned NOT NULL DEFAULT '0',
  KEY `uid` (`uid`,`dateline`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cdb_modworks`
--

LOCK TABLES `cdb_modworks` WRITE;
/*!40000 ALTER TABLE `cdb_modworks` DISABLE KEYS */;
/*!40000 ALTER TABLE `cdb_modworks` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cdb_mytasks`
--

DROP TABLE IF EXISTS `cdb_mytasks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cdb_mytasks` (
  `uid` mediumint(8) unsigned NOT NULL,
  `username` char(15) NOT NULL DEFAULT '',
  `taskid` smallint(6) unsigned NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `csc` char(255) NOT NULL DEFAULT '',
  `dateline` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`uid`,`taskid`),
  KEY `parter` (`taskid`,`dateline`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cdb_mytasks`
--

LOCK TABLES `cdb_mytasks` WRITE;
/*!40000 ALTER TABLE `cdb_mytasks` DISABLE KEYS */;
/*!40000 ALTER TABLE `cdb_mytasks` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cdb_navs`
--

DROP TABLE IF EXISTS `cdb_navs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cdb_navs` (
  `id` smallint(6) unsigned NOT NULL AUTO_INCREMENT,
  `parentid` smallint(6) unsigned NOT NULL DEFAULT '0',
  `name` char(50) NOT NULL,
  `title` char(255) NOT NULL,
  `url` char(255) NOT NULL,
  `target` tinyint(1) NOT NULL DEFAULT '0',
  `type` tinyint(1) NOT NULL DEFAULT '0',
  `available` tinyint(1) NOT NULL DEFAULT '0',
  `displayorder` tinyint(3) NOT NULL,
  `highlight` tinyint(1) NOT NULL DEFAULT '0',
  `level` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cdb_navs`
--

LOCK TABLES `cdb_navs` WRITE;
/*!40000 ALTER TABLE `cdb_navs` DISABLE KEYS */;
INSERT INTO `cdb_navs` VALUES (1,0,'論壇','','#',0,0,1,1,0,0),(2,0,'搜索','','search.php',0,0,1,2,0,0),(3,0,'插件','','#',0,0,1,4,0,0),(4,0,'幫助','','faq.php',0,0,1,5,0,0),(5,0,'導航','','#',0,0,1,6,0,0);
/*!40000 ALTER TABLE `cdb_navs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cdb_onlinelist`
--

DROP TABLE IF EXISTS `cdb_onlinelist`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cdb_onlinelist` (
  `groupid` smallint(6) unsigned NOT NULL DEFAULT '0',
  `displayorder` tinyint(3) NOT NULL DEFAULT '0',
  `title` varchar(30) NOT NULL DEFAULT '',
  `url` varchar(30) NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cdb_onlinelist`
--

LOCK TABLES `cdb_onlinelist` WRITE;
/*!40000 ALTER TABLE `cdb_onlinelist` DISABLE KEYS */;
INSERT INTO `cdb_onlinelist` VALUES (1,1,'管理員','online_admin.gif'),(2,2,'超級版主','online_supermod.gif'),(3,3,'版主','online_moderator.gif'),(0,4,'會員','online_member.gif');
/*!40000 ALTER TABLE `cdb_onlinelist` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cdb_onlinetime`
--

DROP TABLE IF EXISTS `cdb_onlinetime`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cdb_onlinetime` (
  `uid` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `thismonth` smallint(6) unsigned NOT NULL DEFAULT '0',
  `total` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `lastupdate` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`uid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cdb_onlinetime`
--

LOCK TABLES `cdb_onlinetime` WRITE;
/*!40000 ALTER TABLE `cdb_onlinetime` DISABLE KEYS */;
INSERT INTO `cdb_onlinetime` VALUES (1,10,60,1170601084);
/*!40000 ALTER TABLE `cdb_onlinetime` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cdb_orders`
--

DROP TABLE IF EXISTS `cdb_orders`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cdb_orders` (
  `orderid` char(32) NOT NULL DEFAULT '',
  `status` char(3) NOT NULL DEFAULT '',
  `buyer` char(50) NOT NULL DEFAULT '',
  `admin` char(15) NOT NULL DEFAULT '',
  `uid` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `amount` int(10) unsigned NOT NULL DEFAULT '0',
  `price` float(7,2) unsigned NOT NULL DEFAULT '0.00',
  `submitdate` int(10) unsigned NOT NULL DEFAULT '0',
  `confirmdate` int(10) unsigned NOT NULL DEFAULT '0',
  UNIQUE KEY `orderid` (`orderid`),
  KEY `submitdate` (`submitdate`),
  KEY `uid` (`uid`,`submitdate`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cdb_orders`
--

LOCK TABLES `cdb_orders` WRITE;
/*!40000 ALTER TABLE `cdb_orders` DISABLE KEYS */;
/*!40000 ALTER TABLE `cdb_orders` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cdb_paymentlog`
--

DROP TABLE IF EXISTS `cdb_paymentlog`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cdb_paymentlog` (
  `uid` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `tid` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `authorid` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `dateline` int(10) unsigned NOT NULL DEFAULT '0',
  `amount` int(10) unsigned NOT NULL DEFAULT '0',
  `netamount` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`tid`,`uid`),
  KEY `uid` (`uid`),
  KEY `authorid` (`authorid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cdb_paymentlog`
--

LOCK TABLES `cdb_paymentlog` WRITE;
/*!40000 ALTER TABLE `cdb_paymentlog` DISABLE KEYS */;
/*!40000 ALTER TABLE `cdb_paymentlog` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cdb_pluginhooks`
--

DROP TABLE IF EXISTS `cdb_pluginhooks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cdb_pluginhooks` (
  `pluginhookid` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `pluginid` smallint(6) unsigned NOT NULL DEFAULT '0',
  `available` tinyint(1) NOT NULL DEFAULT '0',
  `title` varchar(255) NOT NULL DEFAULT '',
  `description` mediumtext NOT NULL,
  `code` mediumtext NOT NULL,
  PRIMARY KEY (`pluginhookid`),
  KEY `pluginid` (`pluginid`),
  KEY `available` (`available`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cdb_pluginhooks`
--

LOCK TABLES `cdb_pluginhooks` WRITE;
/*!40000 ALTER TABLE `cdb_pluginhooks` DISABLE KEYS */;
/*!40000 ALTER TABLE `cdb_pluginhooks` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cdb_plugins`
--

DROP TABLE IF EXISTS `cdb_plugins`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cdb_plugins` (
  `pluginid` smallint(6) unsigned NOT NULL AUTO_INCREMENT,
  `available` tinyint(1) NOT NULL DEFAULT '0',
  `adminid` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `name` varchar(40) NOT NULL DEFAULT '',
  `identifier` varchar(40) NOT NULL DEFAULT '',
  `description` varchar(255) NOT NULL DEFAULT '',
  `datatables` varchar(255) NOT NULL DEFAULT '',
  `directory` varchar(100) NOT NULL DEFAULT '',
  `copyright` varchar(100) NOT NULL DEFAULT '',
  `modules` text NOT NULL,
  `version` varchar(20) NOT NULL DEFAULT '',
  PRIMARY KEY (`pluginid`),
  UNIQUE KEY `identifier` (`identifier`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cdb_plugins`
--

LOCK TABLES `cdb_plugins` WRITE;
/*!40000 ALTER TABLE `cdb_plugins` DISABLE KEYS */;
/*!40000 ALTER TABLE `cdb_plugins` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cdb_pluginvars`
--

DROP TABLE IF EXISTS `cdb_pluginvars`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cdb_pluginvars` (
  `pluginvarid` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `pluginid` smallint(6) unsigned NOT NULL DEFAULT '0',
  `displayorder` tinyint(3) NOT NULL DEFAULT '0',
  `title` varchar(100) NOT NULL DEFAULT '',
  `description` varchar(255) NOT NULL DEFAULT '',
  `variable` varchar(40) NOT NULL DEFAULT '',
  `type` varchar(20) NOT NULL DEFAULT 'text',
  `value` text NOT NULL,
  `extra` text NOT NULL,
  PRIMARY KEY (`pluginvarid`),
  KEY `pluginid` (`pluginid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cdb_pluginvars`
--

LOCK TABLES `cdb_pluginvars` WRITE;
/*!40000 ALTER TABLE `cdb_pluginvars` DISABLE KEYS */;
/*!40000 ALTER TABLE `cdb_pluginvars` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cdb_polloptions`
--

DROP TABLE IF EXISTS `cdb_polloptions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cdb_polloptions` (
  `polloptionid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `tid` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `votes` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `displayorder` tinyint(3) NOT NULL DEFAULT '0',
  `polloption` varchar(80) NOT NULL DEFAULT '',
  `voterids` mediumtext NOT NULL,
  PRIMARY KEY (`polloptionid`),
  KEY `tid` (`tid`,`displayorder`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cdb_polloptions`
--

LOCK TABLES `cdb_polloptions` WRITE;
/*!40000 ALTER TABLE `cdb_polloptions` DISABLE KEYS */;
/*!40000 ALTER TABLE `cdb_polloptions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cdb_polls`
--

DROP TABLE IF EXISTS `cdb_polls`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cdb_polls` (
  `tid` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `overt` tinyint(1) NOT NULL DEFAULT '0',
  `multiple` tinyint(1) NOT NULL DEFAULT '0',
  `visible` tinyint(1) NOT NULL DEFAULT '0',
  `maxchoices` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `expiration` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`tid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cdb_polls`
--

LOCK TABLES `cdb_polls` WRITE;
/*!40000 ALTER TABLE `cdb_polls` DISABLE KEYS */;
/*!40000 ALTER TABLE `cdb_polls` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cdb_postposition`
--

DROP TABLE IF EXISTS `cdb_postposition`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cdb_postposition` (
  `tid` int(10) unsigned NOT NULL,
  `position` int(10) unsigned NOT NULL,
  `pid` int(10) unsigned NOT NULL,
  PRIMARY KEY (`tid`,`position`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cdb_postposition`
--

LOCK TABLES `cdb_postposition` WRITE;
/*!40000 ALTER TABLE `cdb_postposition` DISABLE KEYS */;
/*!40000 ALTER TABLE `cdb_postposition` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cdb_posts`
--

DROP TABLE IF EXISTS `cdb_posts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cdb_posts` (
  `pid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `fid` smallint(6) unsigned NOT NULL DEFAULT '0',
  `tid` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `first` tinyint(1) NOT NULL DEFAULT '0',
  `author` varchar(15) NOT NULL DEFAULT '',
  `authorid` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `subject` varchar(80) NOT NULL DEFAULT '',
  `dateline` int(10) unsigned NOT NULL DEFAULT '0',
  `message` mediumtext NOT NULL,
  `useip` varchar(15) NOT NULL DEFAULT '',
  `invisible` tinyint(1) NOT NULL DEFAULT '0',
  `anonymous` tinyint(1) NOT NULL DEFAULT '0',
  `usesig` tinyint(1) NOT NULL DEFAULT '0',
  `htmlon` tinyint(1) NOT NULL DEFAULT '0',
  `bbcodeoff` tinyint(1) NOT NULL DEFAULT '0',
  `smileyoff` tinyint(1) NOT NULL DEFAULT '0',
  `parseurloff` tinyint(1) NOT NULL DEFAULT '0',
  `attachment` tinyint(1) NOT NULL DEFAULT '0',
  `rate` smallint(6) NOT NULL DEFAULT '0',
  `ratetimes` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `status` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`pid`),
  KEY `fid` (`fid`),
  KEY `authorid` (`authorid`),
  KEY `dateline` (`dateline`),
  KEY `invisible` (`invisible`),
  KEY `displayorder` (`tid`,`invisible`,`dateline`),
  KEY `first` (`tid`,`first`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cdb_posts`
--

LOCK TABLES `cdb_posts` WRITE;
/*!40000 ALTER TABLE `cdb_posts` DISABLE KEYS */;
/*!40000 ALTER TABLE `cdb_posts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cdb_profilefields`
--

DROP TABLE IF EXISTS `cdb_profilefields`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cdb_profilefields` (
  `fieldid` smallint(6) unsigned NOT NULL AUTO_INCREMENT,
  `available` tinyint(1) NOT NULL DEFAULT '0',
  `invisible` tinyint(1) NOT NULL DEFAULT '0',
  `title` varchar(50) NOT NULL DEFAULT '',
  `description` varchar(255) NOT NULL DEFAULT '',
  `size` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `displayorder` smallint(6) NOT NULL DEFAULT '0',
  `required` tinyint(1) NOT NULL DEFAULT '0',
  `unchangeable` tinyint(1) NOT NULL DEFAULT '0',
  `showinthread` tinyint(1) NOT NULL DEFAULT '0',
  `selective` tinyint(1) NOT NULL DEFAULT '0',
  `choices` text NOT NULL,
  PRIMARY KEY (`fieldid`),
  KEY `available` (`available`,`required`,`displayorder`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cdb_profilefields`
--

LOCK TABLES `cdb_profilefields` WRITE;
/*!40000 ALTER TABLE `cdb_profilefields` DISABLE KEYS */;
/*!40000 ALTER TABLE `cdb_profilefields` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cdb_projects`
--

DROP TABLE IF EXISTS `cdb_projects`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cdb_projects` (
  `id` smallint(6) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `type` varchar(10) NOT NULL,
  `description` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  PRIMARY KEY (`id`),
  KEY `type` (`type`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cdb_projects`
--

LOCK TABLES `cdb_projects` WRITE;
/*!40000 ALTER TABLE `cdb_projects` DISABLE KEYS */;
INSERT INTO `cdb_projects` VALUES (1,'技術性論壇','extcredit','如果您不希望會員通過灌水、頁面訪問等方式得到積分，而是需要發佈一些技術性的帖子獲得積分。','a:4:{s:10:\"savemethod\";a:2:{i:0;s:1:\"1\";i:1;s:1:\"2\";}s:14:\"creditsformula\";s:49:\"posts*0.5+digestposts*5+extcredits1*2+extcredits2\";s:13:\"creditspolicy\";s:299:\"a:12:{s:4:\"post\";a:0:{}s:5:\"reply\";a:0:{}s:6:\"digest\";a:1:{i:1;i:10;}s:10:\"postattach\";a:0:{}s:9:\"getattach\";a:0:{}s:2:\"pm\";a:0:{}s:6:\"search\";a:0:{}s:15:\"promotion_visit\";a:1:{i:3;i:2;}s:18:\"promotion_register\";a:1:{i:3;i:2;}s:13:\"tradefinished\";a:0:{}s:8:\"votepoll\";a:0:{}s:10:\"lowerlimit\";a:0:{}}\";s:10:\"extcredits\";s:1444:\"a:8:{i:1;a:8:{s:5:\"title\";s:4:\"威望\";s:4:\"unit\";s:0:\"\";s:5:\"ratio\";i:0;s:9:\"available\";s:1:\"1\";s:10:\"lowerlimit\";i:0;s:12:\"showinthread\";N;s:15:\"allowexchangein\";N;s:16:\"allowexchangeout\";N;}i:2;a:8:{s:5:\"title\";s:4:\"金錢\";s:4:\"unit\";s:0:\"\";s:5:\"ratio\";i:0;s:9:\"available\";s:1:\"1\";s:10:\"lowerlimit\";i:0;s:12:\"showinthread\";N;s:15:\"allowexchangein\";N;s:16:\"allowexchangeout\";N;}i:3;a:8:{s:5:\"title\";s:4:\"貢獻\";s:4:\"unit\";s:0:\"\";s:5:\"ratio\";i:0;s:9:\"available\";s:1:\"1\";s:10:\"lowerlimit\";i:0;s:12:\"showinthread\";N;s:15:\"allowexchangein\";N;s:16:\"allowexchangeout\";N;}i:4;a:8:{s:5:\"title\";s:0:\"\";s:4:\"unit\";s:0:\"\";s:5:\"ratio\";i:0;s:9:\"available\";N;s:10:\"lowerlimit\";i:0;s:12:\"showinthread\";N;s:15:\"allowexchangein\";N;s:16:\"allowexchangeout\";N;}i:5;a:8:{s:5:\"title\";s:0:\"\";s:4:\"unit\";s:0:\"\";s:5:\"ratio\";i:0;s:9:\"available\";N;s:10:\"lowerlimit\";i:0;s:12:\"showinthread\";N;s:15:\"allowexchangein\";N;s:16:\"allowexchangeout\";N;}i:6;a:8:{s:5:\"title\";s:0:\"\";s:4:\"unit\";s:0:\"\";s:5:\"ratio\";i:0;s:9:\"available\";N;s:10:\"lowerlimit\";i:0;s:12:\"showinthread\";N;s:15:\"allowexchangein\";N;s:16:\"allowexchangeout\";N;}i:7;a:8:{s:5:\"title\";s:0:\"\";s:4:\"unit\";s:0:\"\";s:5:\"ratio\";i:0;s:9:\"available\";N;s:10:\"lowerlimit\";i:0;s:12:\"showinthread\";N;s:15:\"allowexchangein\";N;s:16:\"allowexchangeout\";N;}i:8;a:8:{s:5:\"title\";s:0:\"\";s:4:\"unit\";s:0:\"\";s:5:\"ratio\";i:0;s:9:\"available\";N;s:10:\"lowerlimit\";i:0;s:12:\"showinthread\";N;s:15:\"allowexchangein\";N;s:16:\"allowexchangeout\";N;}}\";}'),(2,'娛樂性論壇','extcredit','此類型論壇的會員可以通過發佈一些評論、回復等獲得積分，同時擴大論壇的訪問量。更重要的是希望會員發佈一些有價值的娛樂新聞等。','a:4:{s:10:\"savemethod\";a:2:{i:0;s:1:\"1\";i:1;s:1:\"2\";}s:14:\"creditsformula\";s:81:\"posts+digestposts*5+oltime*5+pageviews/1000+extcredits1*2+extcredits2+extcredits3\";s:13:\"creditspolicy\";s:315:\"a:12:{s:4:\"post\";a:1:{i:1;i:1;}s:5:\"reply\";a:1:{i:2;i:1;}s:6:\"digest\";a:1:{i:1;i:10;}s:10:\"postattach\";a:0:{}s:9:\"getattach\";a:0:{}s:2:\"pm\";a:0:{}s:6:\"search\";a:0:{}s:15:\"promotion_visit\";a:1:{i:3;i:2;}s:18:\"promotion_register\";a:1:{i:3;i:2;}s:13:\"tradefinished\";a:0:{}s:8:\"votepoll\";a:0:{}s:10:\"lowerlimit\";a:0:{}}\";s:10:\"extcredits\";s:1036:\"a:8:{i:1;a:6:{s:5:\"title\";s:4:\"威望\";s:4:\"unit\";s:0:\"\";s:5:\"ratio\";i:0;s:9:\"available\";s:1:\"1\";s:10:\"lowerlimit\";i:0;s:12:\"showinthread\";N;}i:2;a:6:{s:5:\"title\";s:4:\"金錢\";s:4:\"unit\";s:0:\"\";s:5:\"ratio\";i:0;s:9:\"available\";s:1:\"1\";s:10:\"lowerlimit\";i:0;s:12:\"showinthread\";N;}i:3;a:6:{s:5:\"title\";s:4:\"貢獻\";s:4:\"unit\";s:0:\"\";s:5:\"ratio\";i:0;s:9:\"available\";s:1:\"1\";s:10:\"lowerlimit\";i:0;s:12:\"showinthread\";N;}i:4;a:6:{s:5:\"title\";s:0:\"\";s:4:\"unit\";s:0:\"\";s:5:\"ratio\";i:0;s:9:\"available\";N;s:10:\"lowerlimit\";i:0;s:12:\"showinthread\";N;}i:5;a:6:{s:5:\"title\";s:0:\"\";s:4:\"unit\";s:0:\"\";s:5:\"ratio\";i:0;s:9:\"available\";N;s:10:\"lowerlimit\";i:0;s:12:\"showinthread\";N;}i:6;a:6:{s:5:\"title\";s:0:\"\";s:4:\"unit\";s:0:\"\";s:5:\"ratio\";i:0;s:9:\"available\";N;s:10:\"lowerlimit\";i:0;s:12:\"showinthread\";N;}i:7;a:6:{s:5:\"title\";s:0:\"\";s:4:\"unit\";s:0:\"\";s:5:\"ratio\";i:0;s:9:\"available\";N;s:10:\"lowerlimit\";i:0;s:12:\"showinthread\";N;}i:8;a:6:{s:5:\"title\";s:0:\"\";s:4:\"unit\";s:0:\"\";s:5:\"ratio\";i:0;s:9:\"available\";N;s:10:\"lowerlimit\";i:0;s:12:\"showinthread\";N;}}\";}'),(3,'動漫、攝影類論壇','extcredit','此類型論壇需要更多的圖片附件發佈給廣大會員，因此增加一項擴展積分：魅力。','a:4:{s:10:\"savemethod\";a:2:{i:0;s:1:\"1\";i:1;s:1:\"2\";}s:14:\"creditsformula\";s:86:\"posts+digestposts*2+pageviews/2000+extcredits1*2+extcredits2+extcredits3+extcredits4*3\";s:13:\"creditspolicy\";s:324:\"a:12:{s:4:\"post\";a:1:{i:2;i:1;}s:5:\"reply\";a:0:{}s:6:\"digest\";a:1:{i:1;i:10;}s:10:\"postattach\";a:1:{i:4;i:3;}s:9:\"getattach\";a:1:{i:2;i:-2;}s:2:\"pm\";a:0:{}s:6:\"search\";a:0:{}s:15:\"promotion_visit\";a:1:{i:3;i:2;}s:18:\"promotion_register\";a:1:{i:3;i:2;}s:13:\"tradefinished\";a:0:{}s:8:\"votepoll\";a:0:{}s:10:\"lowerlimit\";a:0:{}}\";s:10:\"extcredits\";s:1454:\"a:8:{i:1;a:8:{s:5:\"title\";s:4:\"威望\";s:4:\"unit\";s:0:\"\";s:5:\"ratio\";i:0;s:9:\"available\";s:1:\"1\";s:10:\"lowerlimit\";i:0;s:12:\"showinthread\";N;s:15:\"allowexchangein\";N;s:16:\"allowexchangeout\";N;}i:2;a:8:{s:5:\"title\";s:4:\"金錢\";s:4:\"unit\";s:0:\"\";s:5:\"ratio\";i:0;s:9:\"available\";s:1:\"1\";s:10:\"lowerlimit\";i:0;s:12:\"showinthread\";N;s:15:\"allowexchangein\";N;s:16:\"allowexchangeout\";N;}i:3;a:8:{s:5:\"title\";s:4:\"貢獻\";s:4:\"unit\";s:0:\"\";s:5:\"ratio\";i:0;s:9:\"available\";s:1:\"1\";s:10:\"lowerlimit\";i:0;s:12:\"showinthread\";N;s:15:\"allowexchangein\";N;s:16:\"allowexchangeout\";N;}i:4;a:8:{s:5:\"title\";s:4:\"魅力\";s:4:\"unit\";s:0:\"\";s:5:\"ratio\";i:0;s:9:\"available\";s:1:\"1\";s:10:\"lowerlimit\";i:0;s:12:\"showinthread\";N;s:15:\"allowexchangein\";N;s:16:\"allowexchangeout\";N;}i:5;a:8:{s:5:\"title\";s:0:\"\";s:4:\"unit\";s:0:\"\";s:5:\"ratio\";i:0;s:9:\"available\";N;s:10:\"lowerlimit\";i:0;s:12:\"showinthread\";N;s:15:\"allowexchangein\";N;s:16:\"allowexchangeout\";N;}i:6;a:8:{s:5:\"title\";s:0:\"\";s:4:\"unit\";s:0:\"\";s:5:\"ratio\";i:0;s:9:\"available\";N;s:10:\"lowerlimit\";i:0;s:12:\"showinthread\";N;s:15:\"allowexchangein\";N;s:16:\"allowexchangeout\";N;}i:7;a:8:{s:5:\"title\";s:0:\"\";s:4:\"unit\";s:0:\"\";s:5:\"ratio\";i:0;s:9:\"available\";N;s:10:\"lowerlimit\";i:0;s:12:\"showinthread\";N;s:15:\"allowexchangein\";N;s:16:\"allowexchangeout\";N;}i:8;a:8:{s:5:\"title\";s:0:\"\";s:4:\"unit\";s:0:\"\";s:5:\"ratio\";i:0;s:9:\"available\";N;s:10:\"lowerlimit\";i:0;s:12:\"showinthread\";N;s:15:\"allowexchangein\";N;s:16:\"allowexchangeout\";N;}}\";}'),(4,'文章、小說類論壇','extcredit','此類型的論壇更重視會員的原創文章或者是轉發的文章，因此增加一項擴展積分：文采。','a:4:{s:10:\"savemethod\";a:2:{i:0;s:1:\"1\";i:1;s:1:\"2\";}s:14:\"creditsformula\";s:57:\"posts+digestposts*8+extcredits2+extcredits3+extcredits4*2\";s:13:\"creditspolicy\";s:307:\"a:12:{s:4:\"post\";a:1:{i:2;i:1;}s:5:\"reply\";a:0:{}s:6:\"digest\";a:1:{i:4;i:10;}s:10:\"postattach\";a:0:{}s:9:\"getattach\";a:0:{}s:2:\"pm\";a:0:{}s:6:\"search\";a:0:{}s:15:\"promotion_visit\";a:1:{i:3;i:2;}s:18:\"promotion_register\";a:1:{i:3;i:2;}s:13:\"tradefinished\";a:0:{}s:8:\"votepoll\";a:0:{}s:10:\"lowerlimit\";a:0:{}}\";s:10:\"extcredits\";s:1454:\"a:8:{i:1;a:8:{s:5:\"title\";s:4:\"威望\";s:4:\"unit\";s:0:\"\";s:5:\"ratio\";i:0;s:9:\"available\";s:1:\"1\";s:10:\"lowerlimit\";i:0;s:12:\"showinthread\";N;s:15:\"allowexchangein\";N;s:16:\"allowexchangeout\";N;}i:2;a:8:{s:5:\"title\";s:4:\"金錢\";s:4:\"unit\";s:0:\"\";s:5:\"ratio\";i:0;s:9:\"available\";s:1:\"1\";s:10:\"lowerlimit\";i:0;s:12:\"showinthread\";N;s:15:\"allowexchangein\";N;s:16:\"allowexchangeout\";N;}i:3;a:8:{s:5:\"title\";s:4:\"貢獻\";s:4:\"unit\";s:0:\"\";s:5:\"ratio\";i:0;s:9:\"available\";s:1:\"1\";s:10:\"lowerlimit\";i:0;s:12:\"showinthread\";N;s:15:\"allowexchangein\";N;s:16:\"allowexchangeout\";N;}i:4;a:8:{s:5:\"title\";s:4:\"文采\";s:4:\"unit\";s:0:\"\";s:5:\"ratio\";i:0;s:9:\"available\";s:1:\"1\";s:10:\"lowerlimit\";i:0;s:12:\"showinthread\";N;s:15:\"allowexchangein\";N;s:16:\"allowexchangeout\";N;}i:5;a:8:{s:5:\"title\";s:0:\"\";s:4:\"unit\";s:0:\"\";s:5:\"ratio\";i:0;s:9:\"available\";N;s:10:\"lowerlimit\";i:0;s:12:\"showinthread\";N;s:15:\"allowexchangein\";N;s:16:\"allowexchangeout\";N;}i:6;a:8:{s:5:\"title\";s:0:\"\";s:4:\"unit\";s:0:\"\";s:5:\"ratio\";i:0;s:9:\"available\";N;s:10:\"lowerlimit\";i:0;s:12:\"showinthread\";N;s:15:\"allowexchangein\";N;s:16:\"allowexchangeout\";N;}i:7;a:8:{s:5:\"title\";s:0:\"\";s:4:\"unit\";s:0:\"\";s:5:\"ratio\";i:0;s:9:\"available\";N;s:10:\"lowerlimit\";i:0;s:12:\"showinthread\";N;s:15:\"allowexchangein\";N;s:16:\"allowexchangeout\";N;}i:8;a:8:{s:5:\"title\";s:0:\"\";s:4:\"unit\";s:0:\"\";s:5:\"ratio\";i:0;s:9:\"available\";N;s:10:\"lowerlimit\";i:0;s:12:\"showinthread\";N;s:15:\"allowexchangein\";N;s:16:\"allowexchangeout\";N;}}\";}'),(5,'調研性論壇','extcredit','此類型論壇更期望的是得到會員的建議和意見，主要是通過投票的方式體現會員的建議，因此增加一項積分策略為：參加投票，增加一項擴展積分為：積極性。','a:4:{s:10:\"savemethod\";a:2:{i:0;s:1:\"1\";i:1;s:1:\"2\";}s:14:\"creditsformula\";s:63:\"posts*0.5+digestposts*2+extcredits1*2+extcredits3+extcredits4*2\";s:13:\"creditspolicy\";s:306:\"a:12:{s:4:\"post\";a:0:{}s:5:\"reply\";a:0:{}s:6:\"digest\";a:1:{i:1;i:8;}s:10:\"postattach\";a:0:{}s:9:\"getattach\";a:0:{}s:2:\"pm\";a:0:{}s:6:\"search\";a:0:{}s:15:\"promotion_visit\";a:1:{i:3;i:2;}s:18:\"promotion_register\";a:1:{i:3;i:2;}s:13:\"tradefinished\";a:0:{}s:8:\"votepoll\";a:1:{i:4;i:5;}s:10:\"lowerlimit\";a:0:{}}\";s:10:\"extcredits\";s:1456:\"a:8:{i:1;a:8:{s:5:\"title\";s:4:\"威望\";s:4:\"unit\";s:0:\"\";s:5:\"ratio\";i:0;s:9:\"available\";s:1:\"1\";s:10:\"lowerlimit\";i:0;s:12:\"showinthread\";N;s:15:\"allowexchangein\";N;s:16:\"allowexchangeout\";N;}i:2;a:8:{s:5:\"title\";s:4:\"金錢\";s:4:\"unit\";s:0:\"\";s:5:\"ratio\";i:0;s:9:\"available\";s:1:\"1\";s:10:\"lowerlimit\";i:0;s:12:\"showinthread\";N;s:15:\"allowexchangein\";N;s:16:\"allowexchangeout\";N;}i:3;a:8:{s:5:\"title\";s:4:\"貢獻\";s:4:\"unit\";s:0:\"\";s:5:\"ratio\";i:0;s:9:\"available\";s:1:\"1\";s:10:\"lowerlimit\";i:0;s:12:\"showinthread\";N;s:15:\"allowexchangein\";N;s:16:\"allowexchangeout\";N;}i:4;a:8:{s:5:\"title\";s:6:\"積極性\";s:4:\"unit\";s:0:\"\";s:5:\"ratio\";i:0;s:9:\"available\";s:1:\"1\";s:10:\"lowerlimit\";i:0;s:12:\"showinthread\";N;s:15:\"allowexchangein\";N;s:16:\"allowexchangeout\";N;}i:5;a:8:{s:5:\"title\";s:0:\"\";s:4:\"unit\";s:0:\"\";s:5:\"ratio\";i:0;s:9:\"available\";N;s:10:\"lowerlimit\";i:0;s:12:\"showinthread\";N;s:15:\"allowexchangein\";N;s:16:\"allowexchangeout\";N;}i:6;a:8:{s:5:\"title\";s:0:\"\";s:4:\"unit\";s:0:\"\";s:5:\"ratio\";i:0;s:9:\"available\";N;s:10:\"lowerlimit\";i:0;s:12:\"showinthread\";N;s:15:\"allowexchangein\";N;s:16:\"allowexchangeout\";N;}i:7;a:8:{s:5:\"title\";s:0:\"\";s:4:\"unit\";s:0:\"\";s:5:\"ratio\";i:0;s:9:\"available\";N;s:10:\"lowerlimit\";i:0;s:12:\"showinthread\";N;s:15:\"allowexchangein\";N;s:16:\"allowexchangeout\";N;}i:8;a:8:{s:5:\"title\";s:0:\"\";s:4:\"unit\";s:0:\"\";s:5:\"ratio\";i:0;s:9:\"available\";N;s:10:\"lowerlimit\";i:0;s:12:\"showinthread\";N;s:15:\"allowexchangein\";N;s:16:\"allowexchangeout\";N;}}\";}'),(6,'貿易性論壇','extcredit','此類型論壇更注重的是會員之間的交易，因此使用積分策略：交易成功，增加一項擴展積分：誠信度。','a:4:{s:10:\"savemethod\";a:2:{i:0;s:1:\"1\";i:1;s:1:\"2\";}s:14:\"creditsformula\";s:55:\"posts+digestposts+extcredits1*2+extcredits3+extcredits4\";s:13:\"creditspolicy\";s:306:\"a:12:{s:4:\"post\";a:0:{}s:5:\"reply\";a:0:{}s:6:\"digest\";a:1:{i:1;i:5;}s:10:\"postattach\";a:0:{}s:9:\"getattach\";a:0:{}s:2:\"pm\";a:0:{}s:6:\"search\";a:0:{}s:15:\"promotion_visit\";a:1:{i:3;i:2;}s:18:\"promotion_register\";a:1:{i:3;i:2;}s:13:\"tradefinished\";a:1:{i:4;i:6;}s:8:\"votepoll\";a:0:{}s:10:\"lowerlimit\";a:0:{}}\";s:10:\"extcredits\";s:1456:\"a:8:{i:1;a:8:{s:5:\"title\";s:4:\"威望\";s:4:\"unit\";s:0:\"\";s:5:\"ratio\";i:0;s:9:\"available\";s:1:\"1\";s:10:\"lowerlimit\";i:0;s:12:\"showinthread\";N;s:15:\"allowexchangein\";N;s:16:\"allowexchangeout\";N;}i:2;a:8:{s:5:\"title\";s:4:\"金錢\";s:4:\"unit\";s:0:\"\";s:5:\"ratio\";i:0;s:9:\"available\";s:1:\"1\";s:10:\"lowerlimit\";i:0;s:12:\"showinthread\";N;s:15:\"allowexchangein\";N;s:16:\"allowexchangeout\";N;}i:3;a:8:{s:5:\"title\";s:4:\"貢獻\";s:4:\"unit\";s:0:\"\";s:5:\"ratio\";i:0;s:9:\"available\";s:1:\"1\";s:10:\"lowerlimit\";i:0;s:12:\"showinthread\";N;s:15:\"allowexchangein\";N;s:16:\"allowexchangeout\";N;}i:4;a:8:{s:5:\"title\";s:6:\"誠信度\";s:4:\"unit\";s:0:\"\";s:5:\"ratio\";i:0;s:9:\"available\";s:1:\"1\";s:10:\"lowerlimit\";i:0;s:12:\"showinthread\";N;s:15:\"allowexchangein\";N;s:16:\"allowexchangeout\";N;}i:5;a:8:{s:5:\"title\";s:0:\"\";s:4:\"unit\";s:0:\"\";s:5:\"ratio\";i:0;s:9:\"available\";N;s:10:\"lowerlimit\";i:0;s:12:\"showinthread\";N;s:15:\"allowexchangein\";N;s:16:\"allowexchangeout\";N;}i:6;a:8:{s:5:\"title\";s:0:\"\";s:4:\"unit\";s:0:\"\";s:5:\"ratio\";i:0;s:9:\"available\";N;s:10:\"lowerlimit\";i:0;s:12:\"showinthread\";N;s:15:\"allowexchangein\";N;s:16:\"allowexchangeout\";N;}i:7;a:8:{s:5:\"title\";s:0:\"\";s:4:\"unit\";s:0:\"\";s:5:\"ratio\";i:0;s:9:\"available\";N;s:10:\"lowerlimit\";i:0;s:12:\"showinthread\";N;s:15:\"allowexchangein\";N;s:16:\"allowexchangeout\";N;}i:8;a:8:{s:5:\"title\";s:0:\"\";s:4:\"unit\";s:0:\"\";s:5:\"ratio\";i:0;s:9:\"available\";N;s:10:\"lowerlimit\";i:0;s:12:\"showinthread\";N;s:15:\"allowexchangein\";N;s:16:\"allowexchangeout\";N;}}\";}'),(7,'壇內事務類版塊','forum','該板塊設置了不允許其他模塊共享，以及設置了需要很高的權限才能瀏覽該版塊。也適合於保密性高版塊。','a:33:{s:7:\"styleid\";s:1:\"0\";s:12:\"allowsmilies\";s:1:\"1\";s:9:\"allowhtml\";s:1:\"0\";s:11:\"allowbbcode\";s:1:\"1\";s:12:\"allowimgcode\";s:1:\"1\";s:14:\"allowanonymous\";s:1:\"0\";s:10:\"allowshare\";s:1:\"0\";s:16:\"allowpostspecial\";s:1:\"0\";s:14:\"alloweditrules\";s:1:\"1\";s:10:\"recyclebin\";s:1:\"1\";s:11:\"modnewposts\";s:1:\"0\";s:6:\"jammer\";s:1:\"0\";s:16:\"disablewatermark\";s:1:\"0\";s:12:\"inheritedmod\";s:1:\"0\";s:9:\"autoclose\";s:1:\"0\";s:12:\"forumcolumns\";s:1:\"0\";s:12:\"threadcaches\";s:2:\"40\";s:16:\"allowpaytoauthor\";s:1:\"0\";s:13:\"alloweditpost\";s:1:\"1\";s:6:\"simple\";s:1:\"0\";s:11:\"postcredits\";s:0:\"\";s:12:\"replycredits\";s:0:\"\";s:16:\"getattachcredits\";s:0:\"\";s:17:\"postattachcredits\";s:0:\"\";s:13:\"digestcredits\";s:0:\"\";s:16:\"attachextensions\";s:0:\"\";s:11:\"threadtypes\";s:0:\"\";s:8:\"viewperm\";s:7:\"	1	2	3	\";s:8:\"postperm\";s:7:\"	1	2	3	\";s:9:\"replyperm\";s:7:\"	1	2	3	\";s:13:\"getattachperm\";s:7:\"	1	2	3	\";s:14:\"postattachperm\";s:7:\"	1	2	3	\";s:16:\"supe_pushsetting\";s:0:\"\";}'),(8,'技術交流類版塊','forum','該設置開啟了主題緩存係數。其他的權限設置級別較低。','a:33:{s:7:\"styleid\";s:1:\"0\";s:12:\"allowsmilies\";s:1:\"1\";s:9:\"allowhtml\";s:1:\"0\";s:11:\"allowbbcode\";s:1:\"1\";s:12:\"allowimgcode\";s:1:\"1\";s:14:\"allowanonymous\";s:1:\"0\";s:10:\"allowshare\";s:1:\"1\";s:16:\"allowpostspecial\";s:1:\"5\";s:14:\"alloweditrules\";s:1:\"0\";s:10:\"recyclebin\";s:1:\"1\";s:11:\"modnewposts\";s:1:\"0\";s:6:\"jammer\";s:1:\"0\";s:16:\"disablewatermark\";s:1:\"0\";s:12:\"inheritedmod\";s:1:\"0\";s:9:\"autoclose\";s:1:\"0\";s:12:\"forumcolumns\";s:1:\"0\";s:12:\"threadcaches\";s:2:\"40\";s:16:\"allowpaytoauthor\";s:1:\"1\";s:13:\"alloweditpost\";s:1:\"1\";s:6:\"simple\";s:1:\"0\";s:11:\"postcredits\";s:0:\"\";s:12:\"replycredits\";s:0:\"\";s:16:\"getattachcredits\";s:0:\"\";s:17:\"postattachcredits\";s:0:\"\";s:13:\"digestcredits\";s:0:\"\";s:16:\"attachextensions\";s:0:\"\";s:11:\"threadtypes\";s:0:\"\";s:8:\"viewperm\";s:0:\"\";s:8:\"postperm\";s:0:\"\";s:9:\"replyperm\";s:0:\"\";s:13:\"getattachperm\";s:0:\"\";s:14:\"postattachperm\";s:0:\"\";s:16:\"supe_pushsetting\";s:0:\"\";}'),(9,'發佈公告類版塊','forum','該設置開啟了發帖審核，限制了允許發帖的用戶組。','a:33:{s:7:\"styleid\";s:1:\"0\";s:12:\"allowsmilies\";s:1:\"1\";s:9:\"allowhtml\";s:1:\"0\";s:11:\"allowbbcode\";s:1:\"1\";s:12:\"allowimgcode\";s:1:\"1\";s:14:\"allowanonymous\";s:1:\"0\";s:10:\"allowshare\";s:1:\"1\";s:16:\"allowpostspecial\";s:1:\"1\";s:14:\"alloweditrules\";s:1:\"0\";s:10:\"recyclebin\";s:1:\"1\";s:11:\"modnewposts\";s:1:\"1\";s:6:\"jammer\";s:1:\"1\";s:16:\"disablewatermark\";s:1:\"0\";s:12:\"inheritedmod\";s:1:\"0\";s:9:\"autoclose\";s:1:\"0\";s:12:\"forumcolumns\";s:1:\"0\";s:12:\"threadcaches\";s:1:\"0\";s:16:\"allowpaytoauthor\";s:1:\"1\";s:13:\"alloweditpost\";s:1:\"0\";s:6:\"simple\";s:1:\"0\";s:11:\"postcredits\";s:0:\"\";s:12:\"replycredits\";s:0:\"\";s:16:\"getattachcredits\";s:0:\"\";s:17:\"postattachcredits\";s:0:\"\";s:13:\"digestcredits\";s:0:\"\";s:16:\"attachextensions\";s:0:\"\";s:11:\"threadtypes\";s:0:\"\";s:8:\"viewperm\";s:0:\"\";s:8:\"postperm\";s:7:\"	1	2	3	\";s:9:\"replyperm\";s:0:\"\";s:13:\"getattachperm\";s:0:\"\";s:14:\"postattachperm\";s:0:\"\";s:16:\"supe_pushsetting\";s:0:\"\";}'),(10,'發起活動類版塊','forum','該類型設置裡發起主題一個月之後會自動關閉主題。','a:33:{s:7:\"styleid\";s:1:\"0\";s:12:\"allowsmilies\";s:1:\"1\";s:9:\"allowhtml\";s:1:\"0\";s:11:\"allowbbcode\";s:1:\"1\";s:12:\"allowimgcode\";s:1:\"1\";s:14:\"allowanonymous\";s:1:\"0\";s:10:\"allowshare\";s:1:\"1\";s:16:\"allowpostspecial\";s:1:\"9\";s:14:\"alloweditrules\";s:1:\"0\";s:10:\"recyclebin\";s:1:\"1\";s:11:\"modnewposts\";s:1:\"0\";s:6:\"jammer\";s:1:\"0\";s:16:\"disablewatermark\";s:1:\"0\";s:12:\"inheritedmod\";s:1:\"1\";s:9:\"autoclose\";s:2:\"30\";s:12:\"forumcolumns\";s:1:\"0\";s:12:\"threadcaches\";s:2:\"40\";s:16:\"allowpaytoauthor\";s:1:\"1\";s:13:\"alloweditpost\";s:1:\"0\";s:6:\"simple\";s:1:\"0\";s:11:\"postcredits\";s:0:\"\";s:12:\"replycredits\";s:0:\"\";s:16:\"getattachcredits\";s:0:\"\";s:17:\"postattachcredits\";s:0:\"\";s:13:\"digestcredits\";s:0:\"\";s:16:\"attachextensions\";s:0:\"\";s:11:\"threadtypes\";s:0:\"\";s:8:\"viewperm\";s:0:\"\";s:8:\"postperm\";s:22:\"	1	2	3	11	12	13	14	15	\";s:9:\"replyperm\";s:0:\"\";s:13:\"getattachperm\";s:0:\"\";s:14:\"postattachperm\";s:0:\"\";s:16:\"supe_pushsetting\";s:0:\"\";}'),(11,'娛樂灌水類版塊','forum','該設置了主題緩存係數，開啟了所有的特殊主題按鈕。','a:33:{s:7:\"styleid\";s:1:\"0\";s:12:\"allowsmilies\";s:1:\"1\";s:9:\"allowhtml\";s:1:\"0\";s:11:\"allowbbcode\";s:1:\"1\";s:12:\"allowimgcode\";s:1:\"1\";s:14:\"allowanonymous\";s:1:\"0\";s:10:\"allowshare\";s:1:\"1\";s:16:\"allowpostspecial\";s:2:\"15\";s:14:\"alloweditrules\";s:1:\"0\";s:10:\"recyclebin\";s:1:\"1\";s:11:\"modnewposts\";s:1:\"0\";s:6:\"jammer\";s:1:\"0\";s:16:\"disablewatermark\";s:1:\"0\";s:12:\"inheritedmod\";s:1:\"0\";s:9:\"autoclose\";s:1:\"0\";s:12:\"forumcolumns\";s:1:\"0\";s:12:\"threadcaches\";s:2:\"40\";s:16:\"allowpaytoauthor\";s:1:\"1\";s:13:\"alloweditpost\";s:1:\"1\";s:6:\"simple\";s:1:\"0\";s:11:\"postcredits\";s:0:\"\";s:12:\"replycredits\";s:0:\"\";s:16:\"getattachcredits\";s:0:\"\";s:17:\"postattachcredits\";s:0:\"\";s:13:\"digestcredits\";s:0:\"\";s:16:\"attachextensions\";s:0:\"\";s:11:\"threadtypes\";s:0:\"\";s:8:\"viewperm\";s:0:\"\";s:8:\"postperm\";s:0:\"\";s:9:\"replyperm\";s:0:\"\";s:13:\"getattachperm\";s:0:\"\";s:14:\"postattachperm\";s:0:\"\";s:16:\"supe_pushsetting\";s:0:\"\";}');
/*!40000 ALTER TABLE `cdb_projects` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cdb_promotions`
--

DROP TABLE IF EXISTS `cdb_promotions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cdb_promotions` (
  `ip` char(15) NOT NULL DEFAULT '',
  `uid` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `username` char(15) NOT NULL DEFAULT '',
  PRIMARY KEY (`ip`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cdb_promotions`
--

LOCK TABLES `cdb_promotions` WRITE;
/*!40000 ALTER TABLE `cdb_promotions` DISABLE KEYS */;
/*!40000 ALTER TABLE `cdb_promotions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cdb_prompt`
--

DROP TABLE IF EXISTS `cdb_prompt`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cdb_prompt` (
  `uid` mediumint(8) unsigned NOT NULL,
  `typeid` smallint(6) unsigned NOT NULL,
  `number` smallint(6) unsigned NOT NULL,
  PRIMARY KEY (`uid`,`typeid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cdb_prompt`
--

LOCK TABLES `cdb_prompt` WRITE;
/*!40000 ALTER TABLE `cdb_prompt` DISABLE KEYS */;
/*!40000 ALTER TABLE `cdb_prompt` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cdb_promptmsgs`
--

DROP TABLE IF EXISTS `cdb_promptmsgs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cdb_promptmsgs` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `typeid` smallint(6) unsigned NOT NULL DEFAULT '0',
  `uid` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `extraid` int(10) unsigned NOT NULL DEFAULT '0',
  `new` tinyint(1) NOT NULL DEFAULT '0',
  `dateline` int(10) unsigned NOT NULL DEFAULT '0',
  `message` text NOT NULL,
  `actor` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `uid` (`uid`,`typeid`),
  KEY `new` (`new`),
  KEY `dateline` (`dateline`),
  KEY `extraid` (`extraid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cdb_promptmsgs`
--

LOCK TABLES `cdb_promptmsgs` WRITE;
/*!40000 ALTER TABLE `cdb_promptmsgs` DISABLE KEYS */;
/*!40000 ALTER TABLE `cdb_promptmsgs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cdb_prompttype`
--

DROP TABLE IF EXISTS `cdb_prompttype`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cdb_prompttype` (
  `id` smallint(6) unsigned NOT NULL AUTO_INCREMENT,
  `key` varchar(255) NOT NULL DEFAULT '',
  `name` varchar(255) NOT NULL DEFAULT '',
  `script` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  UNIQUE KEY `key` (`key`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cdb_prompttype`
--

LOCK TABLES `cdb_prompttype` WRITE;
/*!40000 ALTER TABLE `cdb_prompttype` DISABLE KEYS */;
INSERT INTO `cdb_prompttype` VALUES (1,'pm','私人消息','pm.php?filter=newpm'),(2,'announcepm','公共消息','pm.php?filter=announcepm'),(3,'task','論壇任務','task.php?item=doing'),(4,'systempm','系統消息',''),(5,'friend','好友消息',''),(6,'threads','帖子消息','');
/*!40000 ALTER TABLE `cdb_prompttype` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cdb_ranks`
--

DROP TABLE IF EXISTS `cdb_ranks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cdb_ranks` (
  `rankid` smallint(6) unsigned NOT NULL AUTO_INCREMENT,
  `ranktitle` varchar(30) NOT NULL DEFAULT '',
  `postshigher` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `stars` tinyint(3) NOT NULL DEFAULT '0',
  `color` varchar(7) NOT NULL DEFAULT '',
  PRIMARY KEY (`rankid`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cdb_ranks`
--

LOCK TABLES `cdb_ranks` WRITE;
/*!40000 ALTER TABLE `cdb_ranks` DISABLE KEYS */;
INSERT INTO `cdb_ranks` VALUES (1,'新生入學',0,1,''),(2,'小試牛刀',50,2,''),(3,'實習記者',300,5,''),(4,'自由撰稿人',1000,4,''),(5,'特聘作家',3000,5,'');
/*!40000 ALTER TABLE `cdb_ranks` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cdb_ratelog`
--

DROP TABLE IF EXISTS `cdb_ratelog`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cdb_ratelog` (
  `pid` int(10) unsigned NOT NULL DEFAULT '0',
  `uid` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `username` char(15) NOT NULL DEFAULT '',
  `extcredits` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `dateline` int(10) unsigned NOT NULL DEFAULT '0',
  `score` smallint(6) NOT NULL DEFAULT '0',
  `reason` char(40) NOT NULL DEFAULT '',
  KEY `pid` (`pid`,`dateline`),
  KEY `dateline` (`dateline`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cdb_ratelog`
--

LOCK TABLES `cdb_ratelog` WRITE;
/*!40000 ALTER TABLE `cdb_ratelog` DISABLE KEYS */;
/*!40000 ALTER TABLE `cdb_ratelog` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cdb_regips`
--

DROP TABLE IF EXISTS `cdb_regips`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cdb_regips` (
  `ip` char(15) NOT NULL DEFAULT '',
  `dateline` int(10) unsigned NOT NULL DEFAULT '0',
  `count` smallint(6) NOT NULL DEFAULT '0',
  KEY `ip` (`ip`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cdb_regips`
--

LOCK TABLES `cdb_regips` WRITE;
/*!40000 ALTER TABLE `cdb_regips` DISABLE KEYS */;
/*!40000 ALTER TABLE `cdb_regips` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cdb_relatedthreads`
--

DROP TABLE IF EXISTS `cdb_relatedthreads`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cdb_relatedthreads` (
  `tid` mediumint(8) NOT NULL DEFAULT '0',
  `type` enum('general','trade') NOT NULL DEFAULT 'general',
  `expiration` int(10) NOT NULL DEFAULT '0',
  `keywords` varchar(255) NOT NULL DEFAULT '',
  `relatedthreads` text NOT NULL,
  PRIMARY KEY (`tid`,`type`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cdb_relatedthreads`
--

LOCK TABLES `cdb_relatedthreads` WRITE;
/*!40000 ALTER TABLE `cdb_relatedthreads` DISABLE KEYS */;
/*!40000 ALTER TABLE `cdb_relatedthreads` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cdb_reportlog`
--

DROP TABLE IF EXISTS `cdb_reportlog`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cdb_reportlog` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `fid` smallint(6) unsigned NOT NULL,
  `pid` int(10) unsigned NOT NULL,
  `uid` mediumint(8) unsigned NOT NULL,
  `username` char(15) NOT NULL,
  `status` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `type` tinyint(1) NOT NULL,
  `reason` char(40) NOT NULL,
  `dateline` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `pid` (`pid`,`uid`),
  KEY `dateline` (`fid`,`dateline`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cdb_reportlog`
--

LOCK TABLES `cdb_reportlog` WRITE;
/*!40000 ALTER TABLE `cdb_reportlog` DISABLE KEYS */;
/*!40000 ALTER TABLE `cdb_reportlog` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cdb_request`
--

DROP TABLE IF EXISTS `cdb_request`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cdb_request` (
  `variable` varchar(32) NOT NULL DEFAULT '',
  `value` mediumtext NOT NULL,
  `type` tinyint(1) NOT NULL,
  `system` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`variable`),
  KEY `type` (`type`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cdb_request`
--

LOCK TABLES `cdb_request` WRITE;
/*!40000 ALTER TABLE `cdb_request` DISABLE KEYS */;
INSERT INTO `cdb_request` VALUES ('邊欄模塊_版塊樹形列表','a:4:{s:3:\"url\";s:83:\"function=module&module=forumtree.inc.php&settings=N%3B&jscharset=0&cachelife=864000\";s:9:\"parameter\";a:3:{s:6:\"module\";s:17:\"forumtree.inc.php\";s:9:\"cachelife\";s:6:\"864000\";s:9:\"jscharset\";s:1:\"0\";}s:7:\"comment\";s:30:\"邊欄版塊樹形列表模塊\";s:4:\"type\";s:1:\"5\";}',5,0),('邊欄模塊_版主排行','a:4:{s:3:\"url\";s:79:\"function=module&module=modlist.inc.php&settings=N%3B&jscharset=0&cachelife=3600\";s:9:\"parameter\";a:3:{s:6:\"module\";s:15:\"modlist.inc.php\";s:9:\"cachelife\";s:4:\"3600\";s:9:\"jscharset\";s:1:\"0\";}s:7:\"comment\";s:24:\"邊欄版主排行模塊\";s:4:\"type\";s:1:\"5\";}',5,0),('聚合模塊_版塊列表','a:4:{s:3:\"url\";s:382:\"function=module&module=rowcombine.inc.php&settings=a%3A1%3A%7Bs%3A4%3A%22data%22%3Bs%3A84%3A%22%E9%82%8A%E6%AC%84%E6%A8%A1%E5%A1%8A_%E7%89%88%E5%A1%8A%E6%8E%92%E8%A1%8C%2C%E7%89%88%E5%A1%8A%E6%8E%92%E8%A1%8C%0D%0A%E9%82%8A%E6%AC%84%E6%A8%A1%E5%A1%8A_%E7%89%88%E5%A1%8A%E6%A8%B9%E5%BD%A2%E5%88%97%E8%A1%A8%2C%E7%89%88%E5%A1%8A%E5%88%97%E8%A1%A8%22%3B%7D&jscharset=0&cachelife=864000&\";s:9:\"parameter\";a:4:{s:6:\"module\";s:18:\"rowcombine.inc.php\";s:9:\"cachelife\";s:6:\"864000\";s:8:\"settings\";a:1:{s:4:\"data\";s:84:\"邊欄模塊_版塊排行,版塊排行\r\n邊欄模塊_版塊樹形列表,版塊列表\";}s:9:\"jscharset\";s:1:\"0\";}s:7:\"comment\";s:39:\"熱門版塊、版塊樹形聚合模塊\";s:4:\"type\";s:1:\"5\";}',5,0),('邊欄模塊_版塊排行','a:4:{s:3:\"url\";s:482:\"function=forums&startrow=0&items=0&newwindow=1&orderby=posts&jscharset=0&cachelife=43200&jstemplate=%3Cdiv%20class%3D%5C%22sidebox%5C%22%3E%0D%0A%3Ch4%3E%E7%89%88%E5%A1%8A%E6%8E%92%E8%A1%8C%3C%2Fh4%3E%0D%0A%3Cul%20class%3D%5C%22textinfolist%5C%22%3E%0D%0A%5Bnode%5D%3Cli%3E%3Cimg%20style%3D%5C%22vertical-align%3Amiddle%5C%22%20src%3D%5C%22images%2Fdefault%2Ftree_file.gif%5C%22%20%2F%3E%20%7Bforumname%7D%28%7Bposts%7D%29%3C%2Fli%3E%5B%2Fnode%5D%0D%0A%3C%2Ful%3E%0D%0A%3C%2Fdiv%3E&\";s:9:\"parameter\";a:7:{s:10:\"jstemplate\";s:211:\"<div class=\\\"sidebox\\\">\r\n<h4>版塊排行</h4>\r\n<ul class=\\\"textinfolist\\\">\r\n[node]<li><img style=\\\"vertical-align:middle\\\" src=\\\"images/default/tree_file.gif\\\" /> {forumname}({posts})</li>[/node]\r\n</ul>\r\n</div>\";s:9:\"cachelife\";s:5:\"43200\";s:8:\"startrow\";s:1:\"0\";s:5:\"items\";s:1:\"0\";s:9:\"newwindow\";i:1;s:7:\"orderby\";s:5:\"posts\";s:9:\"jscharset\";s:1:\"0\";}s:7:\"comment\";s:24:\"邊欄版塊排行模塊\";s:4:\"type\";s:1:\"1\";}',1,0),('聚合模塊_熱門主題','a:4:{s:3:\"url\";s:533:\"function=module&module=rowcombine.inc.php&settings=a%3A2%3A%7Bs%3A5%3A%22title%22%3Bs%3A12%3A%22%E7%86%B1%E9%96%80%E4%B8%BB%E9%A1%8C%22%3Bs%3A4%3A%22data%22%3Bs%3A112%3A%22%E9%82%8A%E6%AC%84%E6%A8%A1%E5%A1%8A_%E7%86%B1%E9%96%80%E4%B8%BB%E9%A1%8C_%E4%BB%8A%E6%97%A5%2C%E6%97%A5%0D%0A%E9%82%8A%E6%AC%84%E6%A8%A1%E5%A1%8A_%E7%86%B1%E9%96%80%E4%B8%BB%E9%A1%8C_%E6%9C%AC%E5%91%A8%2C%E5%91%A8%0D%0A%E9%82%8A%E6%AC%84%E6%A8%A1%E5%A1%8A_%E7%86%B1%E9%96%80%E4%B8%BB%E9%A1%8C_%E6%9C%AC%E6%9C%88%2C%E6%9C%88%22%3B%7D&jscharset=0&cachelife=1800&\";s:9:\"parameter\";a:4:{s:6:\"module\";s:18:\"rowcombine.inc.php\";s:9:\"cachelife\";s:4:\"1800\";s:8:\"settings\";a:2:{s:5:\"title\";s:12:\"熱門主題\";s:4:\"data\";s:112:\"邊欄模塊_熱門主題_今日,日\r\n邊欄模塊_熱門主題_本周,周\r\n邊欄模塊_熱門主題_本月,月\";}s:9:\"jscharset\";s:1:\"0\";}s:7:\"comment\";s:48:\"今日、本周、本月熱門主題聚合模塊\";s:4:\"type\";s:1:\"5\";}',5,0),('邊欄模塊_熱門主題_本月','a:4:{s:3:\"url\";s:556:\"function=threads&sidestatus=0&maxlength=20&fnamelength=0&messagelength=&startrow=0&picpre=images%2Fcommon%2Fslisticon.gif&items=5&tag=&tids=&special=0&rewardstatus=&digest=0&stick=0&recommend=0&newwindow=1&threadtype=0&highlight=0&orderby=hourviews&hours=720&jscharset=0&cachelife=86400&jstemplate=%3Cdiv%20class%3D%5C%22sidebox%5C%22%3E%0D%0A%3Ch4%3E%E6%9C%AC%E6%9C%88%E7%86%B1%E9%96%80%3C%2Fh4%3E%0D%0A%3Cul%20class%3D%5C%22textinfolist%5C%22%3E%0D%0A%5Bnode%5D%3Cli%3E%7Bprefix%7D%7Bsubject%7D%3C%2Fli%3E%5B%2Fnode%5D%0D%0A%3C%2Ful%3E%0D%0A%3C%2Fdiv%3E&\";s:9:\"parameter\";a:19:{s:10:\"jstemplate\";s:131:\"<div class=\\\"sidebox\\\">\r\n<h4>本月熱門</h4>\r\n<ul class=\\\"textinfolist\\\">\r\n[node]<li>{prefix}{subject}</li>[/node]\r\n</ul>\r\n</div>\";s:9:\"cachelife\";s:5:\"86400\";s:10:\"sidestatus\";s:1:\"0\";s:8:\"startrow\";s:1:\"0\";s:5:\"items\";s:1:\"5\";s:9:\"maxlength\";s:2:\"20\";s:11:\"fnamelength\";s:1:\"0\";s:13:\"messagelength\";s:0:\"\";s:6:\"picpre\";s:27:\"images/common/slisticon.gif\";s:4:\"tids\";s:0:\"\";s:7:\"keyword\";s:0:\"\";s:3:\"tag\";s:0:\"\";s:10:\"threadtype\";s:1:\"0\";s:9:\"highlight\";s:1:\"0\";s:9:\"recommend\";s:1:\"0\";s:9:\"newwindow\";i:1;s:7:\"orderby\";s:9:\"hourviews\";s:5:\"hours\";s:3:\"720\";s:9:\"jscharset\";s:1:\"0\";}s:7:\"comment\";s:30:\"邊欄本月熱門主題模塊\";s:4:\"type\";s:1:\"0\";}',0,0),('聚合模塊_會員排行','a:4:{s:3:\"url\";s:533:\"function=module&module=rowcombine.inc.php&settings=a%3A2%3A%7Bs%3A5%3A%22title%22%3Bs%3A12%3A%22%E6%9C%83%E5%93%A1%E6%8E%92%E8%A1%8C%22%3Bs%3A4%3A%22data%22%3Bs%3A112%3A%22%E9%82%8A%E6%AC%84%E6%A8%A1%E5%A1%8A_%E6%9C%83%E5%93%A1%E6%8E%92%E8%A1%8C_%E4%BB%8A%E6%97%A5%2C%E6%97%A5%0D%0A%E9%82%8A%E6%AC%84%E6%A8%A1%E5%A1%8A_%E6%9C%83%E5%93%A1%E6%8E%92%E8%A1%8C_%E6%9C%AC%E5%91%A8%2C%E5%91%A8%0D%0A%E9%82%8A%E6%AC%84%E6%A8%A1%E5%A1%8A_%E6%9C%83%E5%93%A1%E6%8E%92%E8%A1%8C_%E6%9C%AC%E6%9C%88%2C%E6%9C%88%22%3B%7D&jscharset=0&cachelife=3600&\";s:9:\"parameter\";a:4:{s:6:\"module\";s:18:\"rowcombine.inc.php\";s:9:\"cachelife\";s:4:\"3600\";s:8:\"settings\";a:2:{s:5:\"title\";s:12:\"會員排行\";s:4:\"data\";s:112:\"邊欄模塊_會員排行_今日,日\r\n邊欄模塊_會員排行_本周,周\r\n邊欄模塊_會員排行_本月,月\";}s:9:\"jscharset\";s:1:\"0\";}s:7:\"comment\";s:48:\"今日、本周、本月會員排行聚合模塊\";s:4:\"type\";s:1:\"5\";}',5,0),('邊欄模塊_推薦主題','a:4:{s:3:\"url\";s:553:\"function=threads&sidestatus=0&maxlength=20&fnamelength=0&messagelength=&startrow=0&picpre=images%2Fcommon%2Fslisticon.gif&items=5&tag=&tids=&special=0&rewardstatus=&digest=0&stick=0&recommend=1&newwindow=1&threadtype=0&highlight=0&orderby=lastpost&hours=48&jscharset=0&cachelife=3600&jstemplate=%3Cdiv%20class%3D%5C%22sidebox%5C%22%3E%0D%0A%3Ch4%3E%E6%8E%A8%E8%96%A6%E4%B8%BB%E9%A1%8C%3C%2Fh4%3E%0D%0A%3Cul%20class%3D%5C%22textinfolist%5C%22%3E%0D%0A%5Bnode%5D%3Cli%3E%7Bprefix%7D%7Bsubject%7D%3C%2Fli%3E%5B%2Fnode%5D%0D%0A%3C%2Ful%3E%0D%0A%3C%2Fdiv%3E&\";s:9:\"parameter\";a:19:{s:10:\"jstemplate\";s:131:\"<div class=\\\"sidebox\\\">\r\n<h4>推薦主題</h4>\r\n<ul class=\\\"textinfolist\\\">\r\n[node]<li>{prefix}{subject}</li>[/node]\r\n</ul>\r\n</div>\";s:9:\"cachelife\";s:4:\"3600\";s:10:\"sidestatus\";s:1:\"0\";s:8:\"startrow\";s:1:\"0\";s:5:\"items\";s:1:\"5\";s:9:\"maxlength\";s:2:\"20\";s:11:\"fnamelength\";s:1:\"0\";s:13:\"messagelength\";s:0:\"\";s:6:\"picpre\";s:27:\"images/common/slisticon.gif\";s:4:\"tids\";s:0:\"\";s:7:\"keyword\";s:0:\"\";s:3:\"tag\";s:0:\"\";s:10:\"threadtype\";s:1:\"0\";s:9:\"highlight\";s:1:\"0\";s:9:\"recommend\";s:1:\"1\";s:9:\"newwindow\";i:1;s:7:\"orderby\";s:8:\"lastpost\";s:5:\"hours\";s:2:\"48\";s:9:\"jscharset\";s:1:\"0\";}s:7:\"comment\";s:24:\"邊欄推薦主題模塊\";s:4:\"type\";s:1:\"0\";}',0,0),('邊欄模塊_最新圖片','a:4:{s:3:\"url\";s:1385:\"function=images&sidestatus=0&isimage=1&threadmethod=1&maxwidth=140&maxheight=140&startrow=0&items=5&orderby=dateline&hours=0&digest=0&newwindow=1&jscharset=0&jstemplate=%3Cdiv%20%20class%3D%5C%22sidebox%5C%22%3E%0D%0A%3Ch4%3E%E6%9C%80%E6%96%B0%E5%9C%96%E7%89%87%3C%2Fh4%3E%0D%0A%3Cscript%20type%3D%5C%22text%2Fjavascript%5C%22%3E%0D%0Avar%20slideSpeed%20%3D%202500%3B%0D%0Avar%20slideImgsize%20%3D%20%5B140%2C140%5D%3B%0D%0Avar%20slideTextBar%20%3D%200%3B%0D%0Avar%20slideBorderColor%20%3D%20%5C%27%23C8DCEC%5C%27%3B%0D%0Avar%20slideBgColor%20%3D%20%5C%27%23FFF%5C%27%3B%0D%0Avar%20slideImgs%20%3D%20new%20Array%28%29%3B%0D%0Avar%20slideImgLinks%20%3D%20new%20Array%28%29%3B%0D%0Avar%20slideImgTexts%20%3D%20new%20Array%28%29%3B%0D%0Avar%20slideSwitchBar%20%3D%201%3B%0D%0Avar%20slideSwitchColor%20%3D%20%5C%27black%5C%27%3B%0D%0Avar%20slideSwitchbgColor%20%3D%20%5C%27white%5C%27%3B%0D%0Avar%20slideSwitchHiColor%20%3D%20%5C%27%23C8DCEC%5C%27%3B%0D%0A%5Bnode%5D%0D%0AslideImgs%5B%7Border%7D%5D%20%3D%20%5C%22%7Bimgfile%7D%5C%22%3B%0D%0AslideImgLinks%5B%7Border%7D%5D%20%3D%20%5C%22%7Blink%7D%5C%22%3B%0D%0AslideImgTexts%5B%7Border%7D%5D%20%3D%20%5C%22%7Bsubject%7D%5C%22%3B%0D%0A%5B%2Fnode%5D%0D%0A%3C%2Fscript%3E%0D%0A%3Cscript%20language%3D%5C%22javascript%5C%22%20type%3D%5C%22text%2Fjavascript%5C%22%20src%3D%5C%22include%2Fjs%2Fslide.js%5C%22%3E%3C%2Fscript%3E%0D%0A%3C%2Fdiv%3E&\";s:9:\"parameter\";a:13:{s:10:\"jstemplate\";s:709:\"<div  class=\\\"sidebox\\\">\r\n<h4>最新圖片</h4>\r\n<script type=\\\"text/javascript\\\">\r\nvar slideSpeed = 2500;\r\nvar slideImgsize = [140,140];\r\nvar slideTextBar = 0;\r\nvar slideBorderColor = \\\'#C8DCEC\\\';\r\nvar slideBgColor = \\\'#FFF\\\';\r\nvar slideImgs = new Array();\r\nvar slideImgLinks = new Array();\r\nvar slideImgTexts = new Array();\r\nvar slideSwitchBar = 1;\r\nvar slideSwitchColor = \\\'black\\\';\r\nvar slideSwitchbgColor = \\\'white\\\';\r\nvar slideSwitchHiColor = \\\'#C8DCEC\\\';\r\n[node]\r\nslideImgs[{order}] = \\\"{imgfile}\\\";\r\nslideImgLinks[{order}] = \\\"{link}\\\";\r\nslideImgTexts[{order}] = \\\"{subject}\\\";\r\n[/node]\r\n</script>\r\n<script language=\\\"javascript\\\" type=\\\"text/javascript\\\" src=\\\"include/js/slide.js\\\"></script>\r\n</div>\";s:9:\"cachelife\";s:0:\"\";s:10:\"sidestatus\";s:1:\"0\";s:8:\"startrow\";s:1:\"0\";s:5:\"items\";s:1:\"5\";s:7:\"isimage\";s:1:\"1\";s:8:\"maxwidth\";s:3:\"140\";s:9:\"maxheight\";s:3:\"140\";s:12:\"threadmethod\";s:1:\"1\";s:9:\"newwindow\";i:1;s:7:\"orderby\";s:8:\"dateline\";s:5:\"hours\";s:0:\"\";s:9:\"jscharset\";s:1:\"0\";}s:7:\"comment\";s:30:\"邊欄最新圖片展示模塊\";s:4:\"type\";s:1:\"4\";}',4,0),('邊欄模塊_最新主題','a:4:{s:3:\"url\";s:537:\"function=threads&sidestatus=0&maxlength=20&fnamelength=0&messagelength=&startrow=0&picpre=images%2Fcommon%2Fslisticon.gif&items=5&tag=&tids=&special=0&rewardstatus=&digest=0&stick=0&recommend=0&newwindow=1&threadtype=0&highlight=0&orderby=dateline&hours=0&jscharset=0&jstemplate=%3Cdiv%20class%3D%5C%22sidebox%5C%22%3E%0D%0A%3Ch4%3E%E6%9C%80%E6%96%B0%E4%B8%BB%E9%A1%8C%3C%2Fh4%3E%0D%0A%3Cul%20class%3D%5C%22textinfolist%5C%22%3E%0D%0A%5Bnode%5D%3Cli%3E%7Bprefix%7D%7Bsubject%7D%3C%2Fli%3E%5B%2Fnode%5D%0D%0A%3C%2Ful%3E%0D%0A%3C%2Fdiv%3E&\";s:9:\"parameter\";a:19:{s:10:\"jstemplate\";s:131:\"<div class=\\\"sidebox\\\">\r\n<h4>最新主題</h4>\r\n<ul class=\\\"textinfolist\\\">\r\n[node]<li>{prefix}{subject}</li>[/node]\r\n</ul>\r\n</div>\";s:9:\"cachelife\";s:0:\"\";s:10:\"sidestatus\";s:1:\"0\";s:8:\"startrow\";s:1:\"0\";s:5:\"items\";s:1:\"5\";s:9:\"maxlength\";s:2:\"20\";s:11:\"fnamelength\";s:1:\"0\";s:13:\"messagelength\";s:0:\"\";s:6:\"picpre\";s:27:\"images/common/slisticon.gif\";s:4:\"tids\";s:0:\"\";s:7:\"keyword\";s:0:\"\";s:3:\"tag\";s:0:\"\";s:10:\"threadtype\";s:1:\"0\";s:9:\"highlight\";s:1:\"0\";s:9:\"recommend\";s:1:\"0\";s:9:\"newwindow\";i:1;s:7:\"orderby\";s:8:\"dateline\";s:5:\"hours\";s:0:\"\";s:9:\"jscharset\";s:1:\"0\";}s:7:\"comment\";s:24:\"邊欄最新主題模塊\";s:4:\"type\";s:1:\"0\";}',0,0),('邊欄模塊_活躍會員','a:4:{s:3:\"url\";s:381:\"function=memberrank&startrow=0&items=12&newwindow=1&extcredit=1&orderby=posts&hours=0&jscharset=0&cachelife=43200&jstemplate=%3Cdiv%20class%3D%5C%22sidebox%5C%22%3E%0D%0A%3Ch4%3E%E6%B4%BB%E8%BA%8D%E6%9C%83%E5%93%A1%3C%2Fh4%3E%0D%0A%3Cul%20class%3D%5C%22avt_list%20s_clear%5C%22%3E%0D%0A%5Bnode%5D%3Cli%3E%7Bavatarsmall%7D%3C%2Fli%3E%5B%2Fnode%5D%0D%0A%3C%2Ful%3E%0D%0A%3C%2Fdiv%3E&\";s:9:\"parameter\";a:9:{s:10:\"jstemplate\";s:131:\"<div class=\\\"sidebox\\\">\r\n<h4>活躍會員</h4>\r\n<ul class=\\\"avt_list s_clear\\\">\r\n[node]<li>{avatarsmall}</li>[/node]\r\n</ul>\r\n</div>\";s:9:\"cachelife\";s:5:\"43200\";s:8:\"startrow\";s:1:\"0\";s:5:\"items\";s:2:\"12\";s:9:\"newwindow\";i:1;s:9:\"extcredit\";s:1:\"1\";s:7:\"orderby\";s:5:\"posts\";s:5:\"hours\";s:0:\"\";s:9:\"jscharset\";s:1:\"0\";}s:7:\"comment\";s:24:\"邊欄活躍會員模塊\";s:4:\"type\";s:1:\"2\";}',2,0),('邊欄模塊_熱門主題_本版','a:4:{s:3:\"url\";s:569:\"function=threads&sidestatus=1&maxlength=20&fnamelength=0&messagelength=&startrow=0&picpre=images%2Fcommon%2Fslisticon.gif&items=5&tag=&tids=&special=0&rewardstatus=&digest=0&stick=0&recommend=0&newwindow=1&threadtype=0&highlight=0&orderby=replies&hours=0&jscharset=0&cachelife=1800&jstemplate=%3Cdiv%20class%3D%5C%22sidebox%5C%22%3E%0D%0A%3Ch4%3E%E6%9C%AC%E7%89%88%E7%86%B1%E9%96%80%E4%B8%BB%E9%A1%8C%3C%2Fh4%3E%0D%0A%3Cul%20class%3D%5C%22textinfolist%5C%22%3E%0D%0A%5Bnode%5D%3Cli%3E%7Bprefix%7D%7Bsubject%7D%3C%2Fli%3E%5B%2Fnode%5D%0D%0A%3C%2Ful%3E%0D%0A%3C%2Fdiv%3E&\";s:9:\"parameter\";a:19:{s:10:\"jstemplate\";s:137:\"<div class=\\\"sidebox\\\">\r\n<h4>本版熱門主題</h4>\r\n<ul class=\\\"textinfolist\\\">\r\n[node]<li>{prefix}{subject}</li>[/node]\r\n</ul>\r\n</div>\";s:9:\"cachelife\";s:4:\"1800\";s:10:\"sidestatus\";s:1:\"1\";s:8:\"startrow\";s:1:\"0\";s:5:\"items\";s:1:\"5\";s:9:\"maxlength\";s:2:\"20\";s:11:\"fnamelength\";s:1:\"0\";s:13:\"messagelength\";s:0:\"\";s:6:\"picpre\";s:27:\"images/common/slisticon.gif\";s:4:\"tids\";s:0:\"\";s:7:\"keyword\";s:0:\"\";s:3:\"tag\";s:0:\"\";s:10:\"threadtype\";s:1:\"0\";s:9:\"highlight\";s:1:\"0\";s:9:\"recommend\";s:1:\"0\";s:9:\"newwindow\";i:1;s:7:\"orderby\";s:7:\"replies\";s:5:\"hours\";s:0:\"\";s:9:\"jscharset\";s:1:\"0\";}s:7:\"comment\";s:30:\"邊欄本版熱門主題模塊\";s:4:\"type\";s:1:\"0\";}',0,0),('邊欄模塊_熱門主題_今日','a:4:{s:3:\"url\";s:554:\"function=threads&sidestatus=0&maxlength=20&fnamelength=0&messagelength=&startrow=0&picpre=images%2Fcommon%2Fslisticon.gif&items=5&tag=&tids=&special=0&rewardstatus=&digest=0&stick=0&recommend=0&newwindow=1&threadtype=0&highlight=0&orderby=hourviews&hours=24&jscharset=0&cachelife=1800&jstemplate=%3Cdiv%20class%3D%5C%22sidebox%5C%22%3E%0D%0A%3Ch4%3E%E4%BB%8A%E6%97%A5%E7%86%B1%E9%96%80%3C%2Fh4%3E%0D%0A%3Cul%20class%3D%5C%22textinfolist%5C%22%3E%0D%0A%5Bnode%5D%3Cli%3E%7Bprefix%7D%7Bsubject%7D%3C%2Fli%3E%5B%2Fnode%5D%0D%0A%3C%2Ful%3E%0D%0A%3C%2Fdiv%3E&\";s:9:\"parameter\";a:19:{s:10:\"jstemplate\";s:131:\"<div class=\\\"sidebox\\\">\r\n<h4>今日熱門</h4>\r\n<ul class=\\\"textinfolist\\\">\r\n[node]<li>{prefix}{subject}</li>[/node]\r\n</ul>\r\n</div>\";s:9:\"cachelife\";s:4:\"1800\";s:10:\"sidestatus\";s:1:\"0\";s:8:\"startrow\";s:1:\"0\";s:5:\"items\";s:1:\"5\";s:9:\"maxlength\";s:2:\"20\";s:11:\"fnamelength\";s:1:\"0\";s:13:\"messagelength\";s:0:\"\";s:6:\"picpre\";s:27:\"images/common/slisticon.gif\";s:4:\"tids\";s:0:\"\";s:7:\"keyword\";s:0:\"\";s:3:\"tag\";s:0:\"\";s:10:\"threadtype\";s:1:\"0\";s:9:\"highlight\";s:1:\"0\";s:9:\"recommend\";s:1:\"0\";s:9:\"newwindow\";i:1;s:7:\"orderby\";s:9:\"hourviews\";s:5:\"hours\";s:2:\"24\";s:9:\"jscharset\";s:1:\"0\";}s:7:\"comment\";s:30:\"邊欄今日熱門主題模塊\";s:4:\"type\";s:1:\"0\";}',0,0),('邊欄模塊_最新回復','a:4:{s:3:\"url\";s:537:\"function=threads&sidestatus=0&maxlength=20&fnamelength=0&messagelength=&startrow=0&picpre=images%2Fcommon%2Fslisticon.gif&items=5&tag=&tids=&special=0&rewardstatus=&digest=0&stick=0&recommend=0&newwindow=1&threadtype=0&highlight=0&orderby=lastpost&hours=0&jscharset=0&jstemplate=%3Cdiv%20class%3D%5C%22sidebox%5C%22%3E%0D%0A%3Ch4%3E%E6%9C%80%E6%96%B0%E5%9B%9E%E5%BE%A9%3C%2Fh4%3E%0D%0A%3Cul%20class%3D%5C%22textinfolist%5C%22%3E%0D%0A%5Bnode%5D%3Cli%3E%7Bprefix%7D%7Bsubject%7D%3C%2Fli%3E%5B%2Fnode%5D%0D%0A%3C%2Ful%3E%0D%0A%3C%2Fdiv%3E&\";s:9:\"parameter\";a:19:{s:10:\"jstemplate\";s:131:\"<div class=\\\"sidebox\\\">\r\n<h4>最新回復</h4>\r\n<ul class=\\\"textinfolist\\\">\r\n[node]<li>{prefix}{subject}</li>[/node]\r\n</ul>\r\n</div>\";s:9:\"cachelife\";s:0:\"\";s:10:\"sidestatus\";s:1:\"0\";s:8:\"startrow\";s:1:\"0\";s:5:\"items\";s:1:\"5\";s:9:\"maxlength\";s:2:\"20\";s:11:\"fnamelength\";s:1:\"0\";s:13:\"messagelength\";s:0:\"\";s:6:\"picpre\";s:27:\"images/common/slisticon.gif\";s:4:\"tids\";s:0:\"\";s:7:\"keyword\";s:0:\"\";s:3:\"tag\";s:0:\"\";s:10:\"threadtype\";s:1:\"0\";s:9:\"highlight\";s:1:\"0\";s:9:\"recommend\";s:1:\"0\";s:9:\"newwindow\";i:1;s:7:\"orderby\";s:8:\"lastpost\";s:5:\"hours\";s:0:\"\";s:9:\"jscharset\";s:1:\"0\";}s:7:\"comment\";s:24:\"邊欄最新回復模塊\";s:4:\"type\";s:1:\"0\";}',0,0),('邊欄模塊_最新圖片_本版','a:4:{s:3:\"url\";s:1385:\"function=images&sidestatus=1&isimage=1&threadmethod=1&maxwidth=140&maxheight=140&startrow=0&items=5&orderby=dateline&hours=0&digest=0&newwindow=1&jscharset=0&jstemplate=%3Cdiv%20%20class%3D%5C%22sidebox%5C%22%3E%0D%0A%3Ch4%3E%E6%9C%80%E6%96%B0%E5%9C%96%E7%89%87%3C%2Fh4%3E%0D%0A%3Cscript%20type%3D%5C%22text%2Fjavascript%5C%22%3E%0D%0Avar%20slideSpeed%20%3D%202500%3B%0D%0Avar%20slideImgsize%20%3D%20%5B140%2C140%5D%3B%0D%0Avar%20slideTextBar%20%3D%200%3B%0D%0Avar%20slideBorderColor%20%3D%20%5C%27%23C8DCEC%5C%27%3B%0D%0Avar%20slideBgColor%20%3D%20%5C%27%23FFF%5C%27%3B%0D%0Avar%20slideImgs%20%3D%20new%20Array%28%29%3B%0D%0Avar%20slideImgLinks%20%3D%20new%20Array%28%29%3B%0D%0Avar%20slideImgTexts%20%3D%20new%20Array%28%29%3B%0D%0Avar%20slideSwitchBar%20%3D%201%3B%0D%0Avar%20slideSwitchColor%20%3D%20%5C%27black%5C%27%3B%0D%0Avar%20slideSwitchbgColor%20%3D%20%5C%27white%5C%27%3B%0D%0Avar%20slideSwitchHiColor%20%3D%20%5C%27%23C8DCEC%5C%27%3B%0D%0A%5Bnode%5D%0D%0AslideImgs%5B%7Border%7D%5D%20%3D%20%5C%22%7Bimgfile%7D%5C%22%3B%0D%0AslideImgLinks%5B%7Border%7D%5D%20%3D%20%5C%22%7Blink%7D%5C%22%3B%0D%0AslideImgTexts%5B%7Border%7D%5D%20%3D%20%5C%22%7Bsubject%7D%5C%22%3B%0D%0A%5B%2Fnode%5D%0D%0A%3C%2Fscript%3E%0D%0A%3Cscript%20language%3D%5C%22javascript%5C%22%20type%3D%5C%22text%2Fjavascript%5C%22%20src%3D%5C%22include%2Fjs%2Fslide.js%5C%22%3E%3C%2Fscript%3E%0D%0A%3C%2Fdiv%3E&\";s:9:\"parameter\";a:13:{s:10:\"jstemplate\";s:709:\"<div  class=\\\"sidebox\\\">\r\n<h4>最新圖片</h4>\r\n<script type=\\\"text/javascript\\\">\r\nvar slideSpeed = 2500;\r\nvar slideImgsize = [140,140];\r\nvar slideTextBar = 0;\r\nvar slideBorderColor = \\\'#C8DCEC\\\';\r\nvar slideBgColor = \\\'#FFF\\\';\r\nvar slideImgs = new Array();\r\nvar slideImgLinks = new Array();\r\nvar slideImgTexts = new Array();\r\nvar slideSwitchBar = 1;\r\nvar slideSwitchColor = \\\'black\\\';\r\nvar slideSwitchbgColor = \\\'white\\\';\r\nvar slideSwitchHiColor = \\\'#C8DCEC\\\';\r\n[node]\r\nslideImgs[{order}] = \\\"{imgfile}\\\";\r\nslideImgLinks[{order}] = \\\"{link}\\\";\r\nslideImgTexts[{order}] = \\\"{subject}\\\";\r\n[/node]\r\n</script>\r\n<script language=\\\"javascript\\\" type=\\\"text/javascript\\\" src=\\\"include/js/slide.js\\\"></script>\r\n</div>\";s:9:\"cachelife\";s:0:\"\";s:10:\"sidestatus\";s:1:\"1\";s:8:\"startrow\";s:1:\"0\";s:5:\"items\";s:1:\"5\";s:7:\"isimage\";s:1:\"1\";s:8:\"maxwidth\";s:3:\"140\";s:9:\"maxheight\";s:3:\"140\";s:12:\"threadmethod\";s:1:\"1\";s:9:\"newwindow\";i:1;s:7:\"orderby\";s:8:\"dateline\";s:5:\"hours\";s:0:\"\";s:9:\"jscharset\";s:1:\"0\";}s:7:\"comment\";s:36:\"邊欄本版最新圖片展示模塊\";s:4:\"type\";s:1:\"4\";}',4,0),('邊欄模塊_標籤','a:4:{s:3:\"url\";s:126:\"function=module&module=tag.inc.php&settings=a%3A1%3A%7Bs%3A5%3A%22limit%22%3Bs%3A2%3A%2220%22%3B%7D&jscharset=0&cachelife=900&\";s:9:\"parameter\";a:4:{s:6:\"module\";s:11:\"tag.inc.php\";s:9:\"cachelife\";s:3:\"900\";s:8:\"settings\";a:1:{s:5:\"limit\";s:2:\"20\";}s:9:\"jscharset\";s:1:\"0\";}s:7:\"comment\";s:18:\"邊欄標籤模塊\";s:4:\"type\";s:1:\"5\";}',5,0),('邊欄模塊_會員排行_本月','a:4:{s:3:\"url\";s:574:\"function=memberrank&startrow=0&items=5&newwindow=1&extcredit=1&orderby=hourposts&hours=720&jscharset=0&cachelife=86400&jstemplate=%3Cdiv%20class%3D%5C%22sidebox%5C%22%3E%0D%0A%3Ch4%3E%E6%9C%AC%E6%9C%88%E6%8E%92%E8%A1%8C%3C%2Fh4%3E%0D%0A%5Bnode%5D%3Cdiv%20class%3D%5C%22s_clear%5C%22%20style%3D%5C%22margin-bottom%3A%205px%3B%5C%22%3E%3Cdiv%20style%3D%5C%22margin-right%3A%2010px%3B%20float%3A%20left%3B%5C%22%3E%7Bavatarsmall%7D%3C%2Fdiv%3E%3Cp%3E%7Bmember%7D%3C%2Fp%3E%3Cp%3E%E7%99%BC%E5%B8%96%20%7Bvalue%7D%20%E7%AF%87%3C%2Fp%3E%3C%2Fdiv%3E%5B%2Fnode%5D%0D%0A%3C%2Fdiv%3E&\";s:9:\"parameter\";a:9:{s:10:\"jstemplate\";s:235:\"<div class=\\\"sidebox\\\">\r\n<h4>本月排行</h4>\r\n[node]<div class=\\\"s_clear\\\" style=\\\"margin-bottom: 5px;\\\"><div style=\\\"margin-right: 10px; float: left;\\\">{avatarsmall}</div><p>{member}</p><p>發帖 {value} 篇</p></div>[/node]\r\n</div>\";s:9:\"cachelife\";s:5:\"86400\";s:8:\"startrow\";s:1:\"0\";s:5:\"items\";s:1:\"5\";s:9:\"newwindow\";i:1;s:9:\"extcredit\";s:1:\"1\";s:7:\"orderby\";s:9:\"hourposts\";s:5:\"hours\";s:3:\"720\";s:9:\"jscharset\";s:1:\"0\";}s:7:\"comment\";s:36:\"邊欄會員本月發帖排行模塊\";s:4:\"type\";s:1:\"2\";}',2,0),('邊欄模塊_會員排行_本周','a:4:{s:3:\"url\";s:574:\"function=memberrank&startrow=0&items=5&newwindow=1&extcredit=1&orderby=hourposts&hours=168&jscharset=0&cachelife=43200&jstemplate=%3Cdiv%20class%3D%5C%22sidebox%5C%22%3E%0D%0A%3Ch4%3E%E6%9C%AC%E5%91%A8%E6%8E%92%E8%A1%8C%3C%2Fh4%3E%0D%0A%5Bnode%5D%3Cdiv%20class%3D%5C%22s_clear%5C%22%20style%3D%5C%22margin-bottom%3A%205px%3B%5C%22%3E%3Cdiv%20style%3D%5C%22margin-right%3A%2010px%3B%20float%3A%20left%3B%5C%22%3E%7Bavatarsmall%7D%3C%2Fdiv%3E%3Cp%3E%7Bmember%7D%3C%2Fp%3E%3Cp%3E%E7%99%BC%E5%B8%96%20%7Bvalue%7D%20%E7%AF%87%3C%2Fp%3E%3C%2Fdiv%3E%5B%2Fnode%5D%0D%0A%3C%2Fdiv%3E&\";s:9:\"parameter\";a:9:{s:10:\"jstemplate\";s:235:\"<div class=\\\"sidebox\\\">\r\n<h4>本周排行</h4>\r\n[node]<div class=\\\"s_clear\\\" style=\\\"margin-bottom: 5px;\\\"><div style=\\\"margin-right: 10px; float: left;\\\">{avatarsmall}</div><p>{member}</p><p>發帖 {value} 篇</p></div>[/node]\r\n</div>\";s:9:\"cachelife\";s:5:\"43200\";s:8:\"startrow\";s:1:\"0\";s:5:\"items\";s:1:\"5\";s:9:\"newwindow\";i:1;s:9:\"extcredit\";s:1:\"1\";s:7:\"orderby\";s:9:\"hourposts\";s:5:\"hours\";s:3:\"168\";s:9:\"jscharset\";s:1:\"0\";}s:7:\"comment\";s:36:\"邊欄會員本周發帖排行模塊\";s:4:\"type\";s:1:\"2\";}',2,0),('邊欄方案_主題列表頁默認','a:4:{s:3:\"url\";s:432:\"function=side&jscharset=&jstemplate=%5Bmodule%5D%E9%82%8A%E6%AC%84%E6%A8%A1%E5%A1%8A_%E6%88%91%E7%9A%84%E5%8A%A9%E6%89%8B%5B%2Fmodule%5D%3Chr%20class%3D%22shadowline%22%2F%3E%5Bmodule%5D%E9%82%8A%E6%AC%84%E6%A8%A1%E5%A1%8A_%E7%86%B1%E9%96%80%E4%B8%BB%E9%A1%8C_%E6%9C%AC%E7%89%88%5B%2Fmodule%5D%3Chr%20class%3D%22shadowline%22%2F%3E%5Bmodule%5D%E9%82%8A%E6%AC%84%E6%A8%A1%E5%A1%8A_%E7%89%88%E5%A1%8A%E6%8E%92%E8%A1%8C%5B%2Fmodule%5D&\";s:9:\"parameter\";a:3:{s:12:\"selectmodule\";a:3:{i:1;s:25:\"邊欄模塊_我的助手\";i:2;s:32:\"邊欄模塊_熱門主題_本版\";i:3;s:25:\"邊欄模塊_版塊排行\";}s:9:\"cachelife\";i:0;s:10:\"jstemplate\";s:181:\"[module]邊欄模塊_我的助手[/module]<hr class=\"shadowline\"/>[module]邊欄模塊_熱門主題_本版[/module]<hr class=\"shadowline\"/>[module]邊欄模塊_版塊排行[/module]\";}s:7:\"comment\";N;s:4:\"type\";s:2:\"-2\";}',-2,0),('邊欄方案_首頁默認','a:4:{s:3:\"url\";s:533:\"function=side&jscharset=&jstemplate=%5Bmodule%5D%E9%82%8A%E6%AC%84%E6%A8%A1%E5%A1%8A_%E6%88%91%E7%9A%84%E5%8A%A9%E6%89%8B%5B%2Fmodule%5D%3Chr%20class%3D%22shadowline%22%2F%3E%5Bmodule%5D%E8%81%9A%E5%90%88%E6%A8%A1%E5%A1%8A_%E6%96%B0%E5%B8%96%5B%2Fmodule%5D%3Chr%20class%3D%22shadowline%22%2F%3E%5Bmodule%5D%E8%81%9A%E5%90%88%E6%A8%A1%E5%A1%8A_%E7%86%B1%E9%96%80%E4%B8%BB%E9%A1%8C%5B%2Fmodule%5D%3Chr%20class%3D%22shadowline%22%2F%3E%5Bmodule%5D%E9%82%8A%E6%AC%84%E6%A8%A1%E5%A1%8A_%E6%B4%BB%E8%BA%8D%E6%9C%83%E5%93%A1%5B%2Fmodule%5D&\";s:9:\"parameter\";a:3:{s:12:\"selectmodule\";a:4:{i:1;s:25:\"邊欄模塊_我的助手\";i:2;s:19:\"聚合模塊_新帖\";i:3;s:25:\"聚合模塊_熱門主題\";i:4;s:25:\"邊欄模塊_活躍會員\";}s:9:\"cachelife\";i:0;s:10:\"jstemplate\";s:234:\"[module]邊欄模塊_我的助手[/module]<hr class=\"shadowline\"/>[module]聚合模塊_新帖[/module]<hr class=\"shadowline\"/>[module]聚合模塊_熱門主題[/module]<hr class=\"shadowline\"/>[module]邊欄模塊_活躍會員[/module]\";}s:7:\"comment\";N;s:4:\"type\";s:2:\"-2\";}',-2,0),('聚合模塊_新帖','a:4:{s:3:\"url\";s:387:\"function=module&module=rowcombine.inc.php&settings=a%3A2%3A%7Bs%3A5%3A%22title%22%3Bs%3A12%3A%22%E6%9C%80%E6%96%B0%E5%B8%96%E5%AD%90%22%3Bs%3A4%3A%22data%22%3Bs%3A66%3A%22%E9%82%8A%E6%AC%84%E6%A8%A1%E5%A1%8A_%E6%9C%80%E6%96%B0%E4%B8%BB%E9%A1%8C%2C%E4%B8%BB%E9%A1%8C%0D%0A%E9%82%8A%E6%AC%84%E6%A8%A1%E5%A1%8A_%E6%9C%80%E6%96%B0%E5%9B%9E%E5%BE%A9%2C%E5%9B%9E%E5%BE%A9%22%3B%7D&jscharset=0&\";s:9:\"parameter\";a:4:{s:6:\"module\";s:18:\"rowcombine.inc.php\";s:9:\"cachelife\";s:0:\"\";s:8:\"settings\";a:2:{s:5:\"title\";s:12:\"最新帖子\";s:4:\"data\";s:66:\"邊欄模塊_最新主題,主題\r\n邊欄模塊_最新回復,回復\";}s:9:\"jscharset\";s:1:\"0\";}s:7:\"comment\";s:39:\"最新主題、最新回復聚合模塊\";s:4:\"type\";s:1:\"5\";}',5,0),('邊欄模塊_熱門主題_本周','a:4:{s:3:\"url\";s:556:\"function=threads&sidestatus=0&maxlength=20&fnamelength=0&messagelength=&startrow=0&picpre=images%2Fcommon%2Fslisticon.gif&items=5&tag=&tids=&special=0&rewardstatus=&digest=0&stick=0&recommend=0&newwindow=1&threadtype=0&highlight=0&orderby=hourviews&hours=168&jscharset=0&cachelife=43200&jstemplate=%3Cdiv%20class%3D%5C%22sidebox%5C%22%3E%0D%0A%3Ch4%3E%E6%9C%AC%E5%91%A8%E7%86%B1%E9%96%80%3C%2Fh4%3E%0D%0A%3Cul%20class%3D%5C%22textinfolist%5C%22%3E%0D%0A%5Bnode%5D%3Cli%3E%7Bprefix%7D%7Bsubject%7D%3C%2Fli%3E%5B%2Fnode%5D%0D%0A%3C%2Ful%3E%0D%0A%3C%2Fdiv%3E&\";s:9:\"parameter\";a:19:{s:10:\"jstemplate\";s:131:\"<div class=\\\"sidebox\\\">\r\n<h4>本周熱門</h4>\r\n<ul class=\\\"textinfolist\\\">\r\n[node]<li>{prefix}{subject}</li>[/node]\r\n</ul>\r\n</div>\";s:9:\"cachelife\";s:5:\"43200\";s:10:\"sidestatus\";s:1:\"0\";s:8:\"startrow\";s:1:\"0\";s:5:\"items\";s:1:\"5\";s:9:\"maxlength\";s:2:\"20\";s:11:\"fnamelength\";s:1:\"0\";s:13:\"messagelength\";s:0:\"\";s:6:\"picpre\";s:27:\"images/common/slisticon.gif\";s:4:\"tids\";s:0:\"\";s:7:\"keyword\";s:0:\"\";s:3:\"tag\";s:0:\"\";s:10:\"threadtype\";s:1:\"0\";s:9:\"highlight\";s:1:\"0\";s:9:\"recommend\";s:1:\"0\";s:9:\"newwindow\";i:1;s:7:\"orderby\";s:9:\"hourviews\";s:5:\"hours\";s:3:\"168\";s:9:\"jscharset\";s:1:\"0\";}s:7:\"comment\";s:30:\"邊欄本周熱門主題模塊\";s:4:\"type\";s:1:\"0\";}',0,0),('邊欄模塊_會員排行_今日','a:4:{s:3:\"url\";s:572:\"function=memberrank&startrow=0&items=5&newwindow=1&extcredit=1&orderby=hourposts&hours=24&jscharset=0&cachelife=3600&jstemplate=%3Cdiv%20class%3D%5C%22sidebox%5C%22%3E%0D%0A%3Ch4%3E%E4%BB%8A%E6%97%A5%E6%8E%92%E8%A1%8C%3C%2Fh4%3E%0D%0A%5Bnode%5D%3Cdiv%20class%3D%5C%22s_clear%5C%22%20style%3D%5C%22margin-bottom%3A%205px%3B%5C%22%3E%3Cdiv%20style%3D%5C%22margin-right%3A%2010px%3B%20float%3A%20left%3B%5C%22%3E%7Bavatarsmall%7D%3C%2Fdiv%3E%3Cp%3E%7Bmember%7D%3C%2Fp%3E%3Cp%3E%E7%99%BC%E5%B8%96%20%7Bvalue%7D%20%E7%AF%87%3C%2Fp%3E%3C%2Fdiv%3E%5B%2Fnode%5D%0D%0A%3C%2Fdiv%3E&\";s:9:\"parameter\";a:9:{s:10:\"jstemplate\";s:235:\"<div class=\\\"sidebox\\\">\r\n<h4>今日排行</h4>\r\n[node]<div class=\\\"s_clear\\\" style=\\\"margin-bottom: 5px;\\\"><div style=\\\"margin-right: 10px; float: left;\\\">{avatarsmall}</div><p>{member}</p><p>發帖 {value} 篇</p></div>[/node]\r\n</div>\";s:9:\"cachelife\";s:4:\"3600\";s:8:\"startrow\";s:1:\"0\";s:5:\"items\";s:1:\"5\";s:9:\"newwindow\";i:1;s:9:\"extcredit\";s:1:\"1\";s:7:\"orderby\";s:9:\"hourposts\";s:5:\"hours\";s:2:\"24\";s:9:\"jscharset\";s:1:\"0\";}s:7:\"comment\";s:36:\"邊欄會員今日發帖排行模塊\";s:4:\"type\";s:1:\"2\";}',2,0),('邊欄模塊_論壇之星','a:4:{s:3:\"url\";s:668:\"function=memberrank&startrow=0&items=3&newwindow=1&extcredit=1&orderby=hourposts&hours=168&jscharset=0&cachelife=43200&jstemplate=%3Cdiv%20class%3D%5C%22sidebox%20s_clear%5C%22%3E%0D%0A%3Ch4%3E%E6%9C%AC%E5%91%A8%E4%B9%8B%E6%98%9F%3C%2Fh4%3E%0D%0A%5Bnode%5D%0D%0A%5Bshow%3D1%5D%3Cdiv%20style%3D%5C%22clear%3Aboth%5C%22%3E%3Cdiv%20style%3D%5C%22float%3Aleft%3B%20margin-right%3A%2016px%3B%5C%22%3E%7Bavatarsmall%7D%3C%2Fdiv%3E%5B%2Fshow%5D%7Bmember%7D%20%5Bshow%3D1%5D%3Cbr%20%2F%3E%E7%99%BC%E5%B8%96%20%7Bvalue%7D%20%E7%AF%87%3C%2Fdiv%3E%3Cdiv%20style%3D%5C%22clear%3Aboth%3Bmargin-top%3A2px%5C%22%20%2F%3E%3C%2Fdiv%3E%5B%2Fshow%5D%0D%0A%5B%2Fnode%5D%0D%0A%3C%2Fdiv%3E&\";s:9:\"parameter\";a:9:{s:10:\"jstemplate\";s:291:\"<div class=\\\"sidebox s_clear\\\">\r\n<h4>本周之星</h4>\r\n[node]\r\n[show=1]<div style=\\\"clear:both\\\"><div style=\\\"float:left; margin-right: 16px;\\\">{avatarsmall}</div>[/show]{member} [show=1]<br />發帖 {value} 篇</div><div style=\\\"clear:both;margin-top:2px\\\" /></div>[/show]\r\n[/node]\r\n</div>\";s:9:\"cachelife\";s:5:\"43200\";s:8:\"startrow\";s:1:\"0\";s:5:\"items\";s:1:\"3\";s:9:\"newwindow\";i:1;s:9:\"extcredit\";s:1:\"1\";s:7:\"orderby\";s:9:\"hourposts\";s:5:\"hours\";s:3:\"168\";s:9:\"jscharset\";s:1:\"0\";}s:7:\"comment\";s:24:\"邊欄論壇之星模塊\";s:4:\"type\";s:1:\"2\";}',2,0),('邊欄模塊_我的助手','a:4:{s:3:\"url\";s:78:\"function=module&module=assistant.inc.php&settings=N%3B&jscharset=0&cachelife=0\";s:9:\"parameter\";a:3:{s:6:\"module\";s:17:\"assistant.inc.php\";s:9:\"cachelife\";s:1:\"0\";s:9:\"jscharset\";s:1:\"0\";}s:7:\"comment\";s:24:\"邊欄我的助手模塊\";s:4:\"type\";s:1:\"5\";}',5,0),('邊欄模塊_Google搜索','a:4:{s:3:\"url\";s:171:\"function=module&module=google.inc.php&settings=a%3A2%3A%7Bs%3A4%3A%22lang%22%3Bs%3A0%3A%22%22%3Bs%3A7%3A%22default%22%3Bs%3A1%3A%221%22%3B%7D&jscharset=0&cachelife=864000&\";s:9:\"parameter\";a:4:{s:6:\"module\";s:14:\"google.inc.php\";s:9:\"cachelife\";s:6:\"864000\";s:8:\"settings\";a:2:{s:4:\"lang\";s:0:\"\";s:7:\"default\";s:1:\"1\";}s:9:\"jscharset\";s:1:\"0\";}s:7:\"comment\";s:26:\"邊欄 Google 搜索模塊\";s:4:\"type\";s:1:\"5\";}',5,0),('UCHome_最新動態','a:4:{s:3:\"url\";s:445:\"function=module&module=feed.inc.php&settings=a%3A6%3A%7Bs%3A5%3A%22title%22%3Bs%3A12%3A%22%E6%9C%80%E6%96%B0%E5%8B%95%E6%85%8B%22%3Bs%3A4%3A%22uids%22%3Bs%3A0%3A%22%22%3Bs%3A6%3A%22friend%22%3Bs%3A1%3A%220%22%3Bs%3A5%3A%22start%22%3Bs%3A1%3A%220%22%3Bs%3A5%3A%22limit%22%3Bs%3A2%3A%2210%22%3Bs%3A8%3A%22template%22%3Bs%3A54%3A%22%3Cdiv%20style%3D%5C%22padding-left%3A2px%5C%22%3E%7Btitle_template%7D%3C%2Fdiv%3E%22%3B%7D&jscharset=0&cachelife=0&\";s:9:\"parameter\";a:4:{s:6:\"module\";s:12:\"feed.inc.php\";s:9:\"cachelife\";s:1:\"0\";s:8:\"settings\";a:6:{s:5:\"title\";s:12:\"最新動態\";s:4:\"uids\";s:0:\"\";s:6:\"friend\";s:1:\"0\";s:5:\"start\";s:1:\"0\";s:5:\"limit\";s:2:\"10\";s:8:\"template\";s:54:\"<div style=\\\"padding-left:2px\\\">{title_template}</div>\";}s:9:\"jscharset\";s:1:\"0\";}s:7:\"comment\";s:27:\"獲取UCHome的最新動態\";s:4:\"type\";s:1:\"5\";}',5,0),('UCHome_最新更新空間','a:4:{s:3:\"url\";s:1388:\"function=module&module=space.inc.php&settings=a%3A17%3A%7Bs%3A5%3A%22title%22%3Bs%3A18%3A%22%E6%9C%80%E6%96%B0%E6%9B%B4%E6%96%B0%E7%A9%BA%E9%96%93%22%3Bs%3A3%3A%22uid%22%3Bs%3A0%3A%22%22%3Bs%3A14%3A%22startfriendnum%22%3Bs%3A0%3A%22%22%3Bs%3A12%3A%22endfriendnum%22%3Bs%3A0%3A%22%22%3Bs%3A12%3A%22startviewnum%22%3Bs%3A0%3A%22%22%3Bs%3A10%3A%22endviewnum%22%3Bs%3A0%3A%22%22%3Bs%3A11%3A%22startcredit%22%3Bs%3A0%3A%22%22%3Bs%3A9%3A%22endcredit%22%3Bs%3A0%3A%22%22%3Bs%3A6%3A%22avatar%22%3Bs%3A2%3A%22-1%22%3Bs%3A10%3A%22namestatus%22%3Bs%3A2%3A%22-1%22%3Bs%3A8%3A%22dateline%22%3Bs%3A1%3A%220%22%3Bs%3A10%3A%22updatetime%22%3Bs%3A1%3A%220%22%3Bs%3A5%3A%22order%22%3Bs%3A10%3A%22updatetime%22%3Bs%3A2%3A%22sc%22%3Bs%3A4%3A%22DESC%22%3Bs%3A5%3A%22start%22%3Bs%3A1%3A%220%22%3Bs%3A5%3A%22limit%22%3Bs%3A2%3A%2210%22%3Bs%3A8%3A%22template%22%3Bs%3A267%3A%22%3Ctable%3E%0D%0A%3Ctr%3E%0D%0A%3Ctd%20width%3D%5C%2250%5C%22%20rowspan%3D%5C%222%5C%22%3E%3Ca%20href%3D%5C%22%7Buserlink%7D%5C%22%20target%3D%5C%22_blank%5C%22%3E%3Cimg%20src%3D%5C%22%7Bphoto%7D%5C%22%20%2F%3E%3C%2Fa%3E%3C%2Ftd%3E%0D%0A%3Ctd%3E%3Ca%20href%3D%5C%22%7Buserlink%7D%5C%22%20%20target%3D%5C%22_blank%5C%22%20style%3D%5C%22text-decoration%3Anone%3B%5C%22%3E%7Busername%7D%3C%2Fa%3E%3C%2Ftd%3E%0D%0A%3C%2Ftr%3E%0D%0A%3Ctr%3E%3Ctd%3E%7Bupdatetime%7D%3C%2Ftd%3E%3C%2Ftr%3E%0D%0A%3C%2Ftable%3E%22%3B%7D&jscharset=0&cachelife=0&\";s:9:\"parameter\";a:4:{s:6:\"module\";s:13:\"space.inc.php\";s:9:\"cachelife\";s:1:\"0\";s:8:\"settings\";a:17:{s:5:\"title\";s:18:\"最新更新空間\";s:3:\"uid\";s:0:\"\";s:14:\"startfriendnum\";s:0:\"\";s:12:\"endfriendnum\";s:0:\"\";s:12:\"startviewnum\";s:0:\"\";s:10:\"endviewnum\";s:0:\"\";s:11:\"startcredit\";s:0:\"\";s:9:\"endcredit\";s:0:\"\";s:6:\"avatar\";s:2:\"-1\";s:10:\"namestatus\";s:2:\"-1\";s:8:\"dateline\";s:1:\"0\";s:10:\"updatetime\";s:1:\"0\";s:5:\"order\";s:10:\"updatetime\";s:2:\"sc\";s:4:\"DESC\";s:5:\"start\";s:1:\"0\";s:5:\"limit\";s:2:\"10\";s:8:\"template\";s:267:\"<table>\r\n<tr>\r\n<td width=\\\"50\\\" rowspan=\\\"2\\\"><a href=\\\"{userlink}\\\" target=\\\"_blank\\\"><img src=\\\"{photo}\\\" /></a></td>\r\n<td><a href=\\\"{userlink}\\\"  target=\\\"_blank\\\" style=\\\"text-decoration:none;\\\">{username}</a></td>\r\n</tr>\r\n<tr><td>{updatetime}</td></tr>\r\n</table>\";}s:9:\"jscharset\";s:1:\"0\";}s:7:\"comment\";s:36:\"獲取UCHome最新更新會員空間\";s:4:\"type\";s:1:\"5\";}',5,0),('UCHome_最新記錄','a:4:{s:3:\"url\";s:1021:\"function=module&module=doing.inc.php&settings=a%3A6%3A%7Bs%3A5%3A%22title%22%3Bs%3A12%3A%22%E6%9C%80%E6%96%B0%E8%A8%98%E9%8C%84%22%3Bs%3A3%3A%22uid%22%3Bs%3A0%3A%22%22%3Bs%3A4%3A%22mood%22%3Bs%3A1%3A%220%22%3Bs%3A5%3A%22start%22%3Bs%3A1%3A%220%22%3Bs%3A5%3A%22limit%22%3Bs%3A2%3A%2210%22%3Bs%3A8%3A%22template%22%3Bs%3A361%3A%22%0D%0A%3Cdiv%20style%3D%5C%22padding%3A0%200%205px%200%3B%5C%22%3E%0D%0A%3Ca%20href%3D%5C%22%7Buserlink%7D%5C%22%20target%3D%5C%22_blank%5C%22%3E%3Cimg%20src%3D%5C%22%7Bphoto%7D%5C%22%20width%3D%5C%2218%5C%22%20height%3D%5C%2218%5C%22%20align%3D%5C%22absmiddle%5C%22%3E%3C%2Fa%3E%20%3Ca%20href%3D%5C%22%7Buserlink%7D%5C%22%20%20target%3D%5C%22_blank%5C%22%3E%7Busername%7D%3C%2Fa%3E%EF%BC%9A%0D%0A%3C%2Fdiv%3E%0D%0A%3Cdiv%20style%3D%5C%22padding%3A0%200%205px%2020px%3B%5C%22%3E%0D%0A%3Ca%20href%3D%5C%22%7Blink%7D%5C%22%20style%3D%5C%22color%3A%23333%3Btext-decoration%3Anone%3B%5C%22%20target%3D%5C%22_blank%5C%22%3E%7Bmessage%7D%3C%2Fa%3E%0D%0A%3C%2Fdiv%3E%22%3B%7D&jscharset=0&cachelife=0&\";s:9:\"parameter\";a:4:{s:6:\"module\";s:13:\"doing.inc.php\";s:9:\"cachelife\";s:1:\"0\";s:8:\"settings\";a:6:{s:5:\"title\";s:12:\"最新記錄\";s:3:\"uid\";s:0:\"\";s:4:\"mood\";s:1:\"0\";s:5:\"start\";s:1:\"0\";s:5:\"limit\";s:2:\"10\";s:8:\"template\";s:361:\"\r\n<div style=\\\"padding:0 0 5px 0;\\\">\r\n<a href=\\\"{userlink}\\\" target=\\\"_blank\\\"><img src=\\\"{photo}\\\" width=\\\"18\\\" height=\\\"18\\\" align=\\\"absmiddle\\\"></a> <a href=\\\"{userlink}\\\"  target=\\\"_blank\\\">{username}</a>：\r\n</div>\r\n<div style=\\\"padding:0 0 5px 20px;\\\">\r\n<a href=\\\"{link}\\\" style=\\\"color:#333;text-decoration:none;\\\" target=\\\"_blank\\\">{message}</a>\r\n</div>\";}s:9:\"jscharset\";s:1:\"0\";}s:7:\"comment\";s:27:\"獲取UCHome的最新記錄\";s:4:\"type\";s:1:\"5\";}',5,0),('UCHome_競價排名','a:4:{s:3:\"url\";s:255:\"function=module&module=html.inc.php&settings=a%3A3%3A%7Bs%3A4%3A%22type%22%3Bs%3A1%3A%220%22%3Bs%3A4%3A%22code%22%3Bs%3A27%3A%22%3Cdiv%20id%3D%5C%22sidefeed%5C%22%3E%3C%2Fdiv%3E%22%3Bs%3A4%3A%22side%22%3Bs%3A1%3A%220%22%3B%7D&jscharset=0&cachelife=864000&\";s:9:\"parameter\";a:4:{s:6:\"module\";s:12:\"html.inc.php\";s:9:\"cachelife\";s:6:\"864000\";s:8:\"settings\";a:3:{s:4:\"type\";s:1:\"0\";s:4:\"code\";s:27:\"<div id=\\\"sidefeed\\\"></div>\";s:4:\"side\";s:1:\"0\";}s:9:\"jscharset\";s:1:\"0\";}s:7:\"comment\";s:33:\"獲取UCHome的競價排名信息\";s:4:\"type\";s:1:\"5\";}',5,0);
/*!40000 ALTER TABLE `cdb_request` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cdb_rewardlog`
--

DROP TABLE IF EXISTS `cdb_rewardlog`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cdb_rewardlog` (
  `tid` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `authorid` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `answererid` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `dateline` int(10) unsigned DEFAULT '0',
  `netamount` int(10) unsigned NOT NULL DEFAULT '0',
  KEY `userid` (`authorid`,`answererid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cdb_rewardlog`
--

LOCK TABLES `cdb_rewardlog` WRITE;
/*!40000 ALTER TABLE `cdb_rewardlog` DISABLE KEYS */;
/*!40000 ALTER TABLE `cdb_rewardlog` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cdb_rsscaches`
--

DROP TABLE IF EXISTS `cdb_rsscaches`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cdb_rsscaches` (
  `lastupdate` int(10) unsigned NOT NULL DEFAULT '0',
  `fid` smallint(6) unsigned NOT NULL DEFAULT '0',
  `tid` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `dateline` int(10) unsigned NOT NULL DEFAULT '0',
  `forum` char(50) NOT NULL DEFAULT '',
  `author` char(15) NOT NULL DEFAULT '',
  `subject` char(80) NOT NULL DEFAULT '',
  `description` char(255) NOT NULL DEFAULT '',
  UNIQUE KEY `tid` (`tid`),
  KEY `fid` (`fid`,`dateline`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cdb_rsscaches`
--

LOCK TABLES `cdb_rsscaches` WRITE;
/*!40000 ALTER TABLE `cdb_rsscaches` DISABLE KEYS */;
/*!40000 ALTER TABLE `cdb_rsscaches` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cdb_searchindex`
--

DROP TABLE IF EXISTS `cdb_searchindex`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cdb_searchindex` (
  `searchid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `keywords` varchar(255) NOT NULL DEFAULT '',
  `searchstring` text NOT NULL,
  `useip` varchar(15) NOT NULL DEFAULT '',
  `uid` mediumint(10) unsigned NOT NULL DEFAULT '0',
  `dateline` int(10) unsigned NOT NULL DEFAULT '0',
  `expiration` int(10) unsigned NOT NULL DEFAULT '0',
  `threadsortid` smallint(6) unsigned NOT NULL DEFAULT '0',
  `threads` smallint(6) unsigned NOT NULL DEFAULT '0',
  `tids` text NOT NULL,
  PRIMARY KEY (`searchid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cdb_searchindex`
--

LOCK TABLES `cdb_searchindex` WRITE;
/*!40000 ALTER TABLE `cdb_searchindex` DISABLE KEYS */;
/*!40000 ALTER TABLE `cdb_searchindex` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cdb_sessions`
--

DROP TABLE IF EXISTS `cdb_sessions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cdb_sessions` (
  `sid` char(6) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL DEFAULT '',
  `ip1` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `ip2` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `ip3` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `ip4` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `uid` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `username` char(15) NOT NULL DEFAULT '',
  `groupid` smallint(6) unsigned NOT NULL DEFAULT '0',
  `styleid` smallint(6) unsigned NOT NULL DEFAULT '0',
  `invisible` tinyint(1) NOT NULL DEFAULT '0',
  `action` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `lastactivity` int(10) unsigned NOT NULL DEFAULT '0',
  `lastolupdate` int(10) unsigned NOT NULL DEFAULT '0',
  `pageviews` smallint(6) unsigned NOT NULL DEFAULT '0',
  `seccode` mediumint(6) unsigned NOT NULL DEFAULT '0',
  `fid` smallint(6) unsigned NOT NULL DEFAULT '0',
  `tid` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `bloguid` mediumint(8) unsigned NOT NULL DEFAULT '0',
  UNIQUE KEY `sid` (`sid`),
  KEY `uid` (`uid`),
  KEY `bloguid` (`bloguid`)
) ENGINE=MEMORY DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cdb_sessions`
--

LOCK TABLES `cdb_sessions` WRITE;
/*!40000 ALTER TABLE `cdb_sessions` DISABLE KEYS */;
/*!40000 ALTER TABLE `cdb_sessions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cdb_settings`
--

DROP TABLE IF EXISTS `cdb_settings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cdb_settings` (
  `variable` varchar(32) NOT NULL DEFAULT '',
  `value` text NOT NULL,
  PRIMARY KEY (`variable`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cdb_settings`
--

LOCK TABLES `cdb_settings` WRITE;
/*!40000 ALTER TABLE `cdb_settings` DISABLE KEYS */;
INSERT INTO `cdb_settings` VALUES ('accessemail',''),('activitytype','朋友聚會\r\n出外郊遊\r\n自駕出行\r\n公益活動\r\n線上活動'),('adminipaccess',''),('admode','1'),('allowthreadplugin',''),('archiverstatus','1'),('attachbanperiods',''),('attachdir','./attachments'),('attachexpire',''),('attachimgpost','1'),('attachrefcheck','0'),('attachsave','3'),('attachurl','attachments'),('authkey','6182c8e2F3NS3juS'),('authoronleft','0'),('avatarmethod','0'),('backupdir','4e941d'),('baidusitemap','1'),('baidusitemap_life','12'),('bannedmessages','1'),('bbclosed',''),('bbname','Discuz! Board'),('bbrules','0'),('bbrulestxt',''),('bdaystatus','0'),('boardlicensed','0'),('cacheindexlife','0'),('cachethreaddir','forumdata/threadcaches'),('cachethreadlife','0'),('censoremail',''),('censoruser',''),('closedreason',''),('creditnotice','1'),('creditsformula','extcredits1'),('creditsformulaexp',''),('creditsnotify',''),('creditspolicy','a:12:{s:4:\"post\";a:0:{}s:5:\"reply\";a:0:{}s:6:\"digest\";a:1:{i:1;i:10;}s:10:\"postattach\";a:0:{}s:9:\"getattach\";a:0:{}s:6:\"sendpm\";a:0:{}s:6:\"search\";a:0:{}s:15:\"promotion_visit\";a:0:{}s:18:\"promotion_register\";a:0:{}s:13:\"tradefinished\";a:0:{}s:8:\"votepoll\";a:0:{}s:10:\"lowerlimit\";a:0:{}}'),('creditstax','0.2'),('creditstrans','2'),('customauthorinfo','a:1:{i:0;a:9:{s:3:\"uid\";a:1:{s:4:\"menu\";s:1:\"1\";}s:5:\"posts\";a:1:{s:4:\"menu\";s:1:\"1\";}s:6:\"digest\";a:1:{s:4:\"menu\";s:1:\"1\";}s:7:\"credits\";a:1:{s:4:\"menu\";s:1:\"1\";}s:8:\"readperm\";a:1:{s:4:\"menu\";s:1:\"1\";}s:8:\"location\";a:1:{s:4:\"menu\";s:1:\"1\";}s:6:\"oltime\";a:1:{s:4:\"menu\";s:1:\"1\";}s:7:\"regtime\";a:1:{s:4:\"menu\";s:1:\"1\";}s:8:\"lastdate\";a:1:{s:4:\"menu\";s:1:\"1\";}}}'),('custombackup',''),('dateconvert','1'),('dateformat','Y-n-j'),('debug','1'),('delayviewcount','0'),('deletereason',''),('disallowfloat','a:2:{i:3;s:9:\"newthread\";i:4;s:5:\"reply\";}'),('domainwhitelist',''),('doublee','1'),('dupkarmarate','0'),('dzfeed_limit','a:9:{s:14:\"thread_replies\";a:4:{i:0;s:3:\"100\";i:1;s:4:\"1000\";i:2;s:4:\"2000\";i:3;s:5:\"10000\";}s:12:\"thread_views\";a:3:{i:0;s:3:\"500\";i:1;s:4:\"5000\";i:2;s:5:\"10000\";}s:11:\"thread_rate\";a:3:{i:0;s:2:\"50\";i:1;s:3:\"200\";i:2;s:3:\"500\";}s:9:\"post_rate\";a:3:{i:0;s:2:\"20\";i:1;s:3:\"100\";i:2;s:3:\"300\";}s:14:\"user_usergroup\";a:4:{i:0;s:2:\"12\";i:1;s:2:\"13\";i:2;s:2:\"14\";i:3;s:2:\"15\";}s:11:\"user_credit\";a:3:{i:0;s:4:\"1000\";i:1;s:5:\"10000\";i:2;s:6:\"100000\";}s:12:\"user_threads\";a:5:{i:0;s:3:\"100\";i:1;s:3:\"500\";i:2;s:4:\"1000\";i:3;s:4:\"5000\";i:4;s:5:\"10000\";}s:10:\"user_posts\";a:4:{i:0;s:3:\"500\";i:1;s:4:\"1000\";i:2;s:4:\"5000\";i:3;s:5:\"10000\";}s:11:\"user_digest\";a:4:{i:0;s:2:\"50\";i:1;s:3:\"100\";i:2;s:3:\"500\";i:3;s:4:\"1000\";}}'),('ec_account',''),('ec_contract',''),('ec_credit','a:2:{s:18:\"maxcreditspermonth\";i:6;s:4:\"rank\";a:15:{i:1;i:4;i:2;i:11;i:3;i:41;i:4;i:91;i:5;i:151;i:6;i:251;i:7;i:501;i:8;i:1001;i:9;i:2001;i:10;i:5001;i:11;i:10001;i:12;i:20001;i:13;i:50001;i:14;i:100001;i:15;i:200001;}}'),('ec_maxcredits','1000'),('ec_maxcreditspermonth','0'),('ec_mincredits','0'),('ec_ratio','0'),('ec_tenpay_bargainor',''),('ec_tenpay_key',''),('editedby','1'),('editoroptions','1'),('edittimelimit',''),('exchangemincredits','100'),('extcredits','a:2:{i:1;a:3:{s:5:\"title\";s:6:\"威望\";s:12:\"showinthread\";s:0:\"\";s:9:\"available\";i:1;}i:2;a:3:{s:5:\"title\";s:6:\"金錢\";s:12:\"showinthread\";s:0:\"\";s:9:\"available\";i:1;}}'),('fastpost','1'),('floodctrl','15'),('forumjump','0'),('forumlinkstatus','1'),('frameon','0'),('framewidth','180'),('ftp','a:10:{s:2:\"on\";s:1:\"0\";s:3:\"ssl\";s:1:\"0\";s:4:\"host\";s:0:\"\";s:4:\"port\";s:2:\"21\";s:8:\"username\";s:0:\"\";s:8:\"password\";s:0:\"\";s:9:\"attachdir\";s:1:\".\";s:9:\"attachurl\";s:0:\"\";s:7:\"hideurl\";s:1:\"0\";s:7:\"timeout\";s:1:\"0\";}'),('globalstick','1'),('google','1'),('gzipcompress','0'),('heatthread','a:3:{s:5:\"reply\";i:5;s:9:\"recommend\";i:3;s:8:\"hottopic\";s:10:\"50,100,200\";}'),('hideprivate','1'),('historyposts','0	1'),('hottopic','10'),('icp',''),('imageimpath',''),('imagelib','0'),('indexhot',''),('indexname','index.php'),('indextype','classics'),('infosidestatus','0'),('initcredits','0,0,0,0,0,0,0,0,0'),('inviteconfig',''),('ipaccess',''),('ipregctrl',''),('jscachelife','1800'),('jsdateformat',''),('jspath','forumdata/cache/'),('jsrefdomains',''),('jsstatus','0'),('jswizard',''),('karmaratelimit','0'),('loadctrl','0'),('losslessdel','365'),('magicdiscount','85'),('magicmarket','1'),('magicstatus','1'),('mail','a:10:{s:8:\"mailsend\";s:1:\"1\";s:6:\"server\";s:13:\"smtp.21cn.com\";s:4:\"port\";s:2:\"25\";s:4:\"auth\";s:1:\"1\";s:4:\"from\";s:26:\"Discuz <username@21cn.com>\";s:13:\"auth_username\";s:17:\"username@21cn.com\";s:13:\"auth_password\";s:8:\"password\";s:13:\"maildelimiter\";s:1:\"0\";s:12:\"mailusername\";s:1:\"1\";s:15:\"sendmail_silent\";s:1:\"1\";}'),('maxavatarpixel','120'),('maxavatarsize','20000'),('maxbdays','0'),('maxchargespan','0'),('maxfavorites','100'),('maxincperthread','0'),('maxmagicprice','50'),('maxmodworksmonths','3'),('maxonlinelist','0'),('maxonlines','5000'),('maxpolloptions','10'),('maxpostsize','10000'),('maxsearchresults','500'),('maxsigrows','100'),('maxsmilies','10'),('maxspm','0'),('membermaxpages','100'),('memberperpage','25'),('memliststatus','1'),('minpostsize','10'),('moddisplay','flat'),('modratelimit','0'),('modreasons','廣告/SPAM\r\n惡意灌水\r\n違規內容\r\n文不對題\r\n重複發帖\r\n\r\n我很贊同\r\n精品文章\r\n原創內容'),('modworkstatus','1'),('msgforward','a:3:{s:11:\"refreshtime\";i:3;s:5:\"quick\";i:1;s:8:\"messages\";a:13:{i:0;s:19:\"thread_poll_succeed\";i:1;s:19:\"thread_rate_succeed\";i:2;s:23:\"usergroups_join_succeed\";i:3;s:23:\"usergroups_exit_succeed\";i:4;s:25:\"usergroups_update_succeed\";i:5;s:20:\"buddy_update_succeed\";i:6;s:17:\"post_edit_succeed\";i:7;s:18:\"post_reply_succeed\";i:8;s:24:\"post_edit_delete_succeed\";i:9;s:22:\"post_newthread_succeed\";i:10;s:13:\"admin_succeed\";i:11;s:17:\"pm_delete_succeed\";i:12;s:15:\"search_redirect\";}}'),('msn',''),('newbiespan','0'),('newbietasks',''),('newbietaskupdate',''),('newsletter',''),('nocacheheaders','0'),('oltimespan','10'),('onlinehold','15'),('onlinerecord','1	1040034649'),('outextcredits',''),('postbanperiods',''),('postmodperiods',''),('postno','#'),('postnocustom',''),('postperpage','10'),('pvfrequence','60'),('pwdsafety',''),('qihoo','a:9:{s:6:\"status\";i:0;s:9:\"searchbox\";i:6;s:7:\"summary\";i:1;s:6:\"jammer\";i:1;s:9:\"maxtopics\";i:10;s:8:\"keywords\";s:0:\"\";s:10:\"adminemail\";s:0:\"\";s:8:\"validity\";i:1;s:14:\"relatedthreads\";a:6:{s:6:\"bbsnum\";i:0;s:6:\"webnum\";i:0;s:4:\"type\";a:3:{s:4:\"blog\";s:4:\"blog\";s:4:\"news\";s:4:\"news\";s:3:\"bbs\";s:3:\"bbs\";}s:6:\"banurl\";s:0:\"\";s:8:\"position\";i:1;s:8:\"validity\";i:1;}}'),('ratelogrecord','5'),('recommendthread',''),('regctrl','0'),('regfloodctrl','0'),('reglinkname','註冊'),('regname','register.php'),('regstatus','1'),('regverify','0'),('relatedtag',''),('reportpost','1'),('rewritecompatible',''),('rewritestatus','0'),('rssstatus','1'),('rssttl','60'),('runwizard','1'),('searchbanperiods',''),('searchctrl','30'),('seccodedata','a:13:{s:8:\"minposts\";s:0:\"\";s:16:\"loginfailedcount\";i:0;s:5:\"width\";i:150;s:6:\"height\";i:60;s:4:\"type\";s:1:\"0\";s:10:\"background\";s:1:\"1\";s:10:\"adulterate\";s:1:\"1\";s:3:\"ttf\";s:1:\"0\";s:5:\"angle\";s:1:\"0\";s:5:\"color\";s:1:\"1\";s:4:\"size\";s:1:\"0\";s:6:\"shadow\";s:1:\"1\";s:8:\"animator\";s:1:\"0\";}'),('seccodestatus','0'),('seclevel','1'),('secqaa','a:2:{s:8:\"minposts\";s:1:\"1\";s:6:\"status\";i:0;}'),('seodescription',''),('seohead',''),('seokeywords',''),('seotitle',''),('showemail',''),('showimages','1'),('showsettings','7'),('sigviewcond','0'),('sitemessage',''),('sitename','Comsenz Inc.'),('siteuniqueid','LHSMjr8a9eGN1plD'),('siteurl','http://www.comsenz.com/'),('smcols','8'),('smrows','5'),('smthumb','20'),('spacedata','a:11:{s:9:\"cachelife\";s:3:\"900\";s:14:\"limitmythreads\";s:1:\"5\";s:14:\"limitmyreplies\";s:1:\"5\";s:14:\"limitmyrewards\";s:1:\"5\";s:13:\"limitmytrades\";s:1:\"5\";s:13:\"limitmyvideos\";s:1:\"0\";s:12:\"limitmyblogs\";s:1:\"8\";s:14:\"limitmyfriends\";s:1:\"0\";s:16:\"limitmyfavforums\";s:1:\"5\";s:17:\"limitmyfavthreads\";s:1:\"0\";s:10:\"textlength\";s:3:\"300\";}'),('spacestatus','1'),('starthreshold','2'),('statcode',''),('statscachelife','180'),('statstatus',''),('styleid','1'),('stylejump','1'),('subforumsindex',''),('swfupload','1'),('tagstatus','1'),('taskon','0'),('threadmaxpages','1000'),('threadsticky','全局置頂,分類置頂,本版置頂'),('thumbheight','300'),('thumbquality','100'),('thumbstatus','0'),('thumbwidth','400'),('timeformat','H:i'),('timeoffset','8'),('topicperpage','20'),('tradetypes',''),('transfermincredits','1000'),('transsidstatus','0'),('uc','a:1:{s:7:\"addfeed\";i:1;}'),('ucactivation','1'),('upgradeurl','http://localhost/develop/dzhead/develop/upgrade.php'),('userdateformat','Y-n-j\r\nY/n/j\r\nj-n-Y\r\nj/n/Y'),('userstatusby','1'),('viewthreadtags','100'),('visitbanperiods',''),('visitedforums','10'),('vtonlinestatus','1'),('wapcharset','2'),('wapdateformat','n/j'),('wapmps','500'),('wapppp','5'),('wapregister','0'),('wapstatus','0'),('waptpp','10'),('warningexpiration','3'),('warninglimit','3'),('watermarkminheight','0'),('watermarkminwidth','0'),('watermarkquality','80'),('watermarkstatus','0'),('watermarktext',''),('watermarktrans','65'),('watermarktype','0'),('welcomemsg','1'),('welcomemsgtitle','{username}，您好，感謝您的註冊，請閱讀以下內容。'),('welcomemsgtxt','尊敬的{username}，您已經註冊成為{sitename}的會員，請您在發表言論時，遵守當地法律法規。\r\n如果您有什麼疑問可以聯繫管理員，Email: {adminemail}。\r\n\r\n\r\n{bbname}\r\n{time}'),('whosonlinestatus','1'),('whosonline_contract','0'),('zoomstatus','1'),('ratelogon','0'),('forumseparator','1'),('allowattachurl','0'),('allowviewuserthread',''),('ipverifywhite',''),('tasktypes','a:3:{s:9:\"promotion\";a:2:{s:4:\"name\";s:18:\"論壇推廣任務\";s:7:\"version\";s:3:\"1.0\";}s:4:\"gift\";a:2:{s:4:\"name\";s:15:\"紅包類任務\";s:7:\"version\";s:3:\"1.0\";}s:6:\"avatar\";a:2:{s:4:\"name\";s:15:\"頭像類任務\";s:7:\"version\";s:3:\"1.0\";}}');
/*!40000 ALTER TABLE `cdb_settings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cdb_smilies`
--

DROP TABLE IF EXISTS `cdb_smilies`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cdb_smilies` (
  `id` smallint(6) unsigned NOT NULL AUTO_INCREMENT,
  `typeid` smallint(6) unsigned NOT NULL,
  `displayorder` tinyint(3) NOT NULL DEFAULT '0',
  `type` enum('smiley','icon','stamp') NOT NULL DEFAULT 'smiley',
  `code` varchar(30) NOT NULL DEFAULT '',
  `url` varchar(30) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=90 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cdb_smilies`
--

LOCK TABLES `cdb_smilies` WRITE;
/*!40000 ALTER TABLE `cdb_smilies` DISABLE KEYS */;
INSERT INTO `cdb_smilies` VALUES (1,1,1,'smiley',':)','smile.gif'),(2,1,2,'smiley',':(','sad.gif'),(3,1,3,'smiley',':D','biggrin.gif'),(4,1,4,'smiley',':\'(','cry.gif'),(5,1,5,'smiley',':@','huffy.gif'),(6,1,6,'smiley',':o','shocked.gif'),(7,1,7,'smiley',':P','tongue.gif'),(8,1,8,'smiley',':$','shy.gif'),(9,1,9,'smiley',';P','titter.gif'),(10,1,10,'smiley',':L','sweat.gif'),(11,1,11,'smiley',':Q','mad.gif'),(12,1,12,'smiley',':lol','lol.gif'),(13,1,13,'smiley',':loveliness:','loveliness.gif'),(14,1,14,'smiley',':funk:','funk.gif'),(15,1,15,'smiley',':curse:','curse.gif'),(16,1,16,'smiley',':dizzy:','dizzy.gif'),(17,1,17,'smiley',':shutup:','shutup.gif'),(18,1,18,'smiley',':sleepy:','sleepy.gif'),(19,1,19,'smiley',':hug:','hug.gif'),(20,1,20,'smiley',':victory:','victory.gif'),(21,1,21,'smiley',':time:','time.gif'),(22,1,22,'smiley',':kiss:','kiss.gif'),(23,1,23,'smiley',':handshake','handshake.gif'),(24,1,24,'smiley',':call:','call.gif'),(25,2,1,'smiley','{:2_25:}','01.gif'),(26,2,2,'smiley','{:2_26:}','02.gif'),(27,2,3,'smiley','{:2_27:}','03.gif'),(28,2,4,'smiley','{:2_28:}','04.gif'),(29,2,5,'smiley','{:2_29:}','05.gif'),(30,2,6,'smiley','{:2_30:}','06.gif'),(31,2,7,'smiley','{:2_31:}','07.gif'),(32,2,8,'smiley','{:2_32:}','08.gif'),(33,2,9,'smiley','{:2_33:}','09.gif'),(34,2,10,'smiley','{:2_34:}','10.gif'),(35,2,11,'smiley','{:2_35:}','11.gif'),(36,2,12,'smiley','{:2_36:}','12.gif'),(37,2,13,'smiley','{:2_37:}','13.gif'),(38,2,14,'smiley','{:2_38:}','14.gif'),(39,2,15,'smiley','{:2_39:}','15.gif'),(40,2,16,'smiley','{:2_40:}','16.gif'),(41,3,1,'smiley','{:3_41:}','01.gif'),(42,3,2,'smiley','{:3_42:}','02.gif'),(43,3,3,'smiley','{:3_43:}','03.gif'),(44,3,4,'smiley','{:3_44:}','04.gif'),(45,3,5,'smiley','{:3_45:}','05.gif'),(46,3,6,'smiley','{:3_46:}','06.gif'),(47,3,7,'smiley','{:3_47:}','07.gif'),(48,3,8,'smiley','{:3_48:}','08.gif'),(49,3,9,'smiley','{:3_49:}','09.gif'),(50,3,10,'smiley','{:3_50:}','10.gif'),(51,3,11,'smiley','{:3_51:}','11.gif'),(52,3,12,'smiley','{:3_52:}','12.gif'),(53,3,13,'smiley','{:3_53:}','13.gif'),(54,3,14,'smiley','{:3_54:}','14.gif'),(55,3,15,'smiley','{:3_55:}','15.gif'),(56,3,16,'smiley','{:3_56:}','16.gif'),(57,3,17,'smiley','{:3_57:}','17.gif'),(58,3,18,'smiley','{:3_58:}','18.gif'),(59,3,19,'smiley','{:3_59:}','19.gif'),(60,3,20,'smiley','{:3_60:}','20.gif'),(61,3,21,'smiley','{:3_61:}','21.gif'),(62,3,22,'smiley','{:3_62:}','22.gif'),(63,3,23,'smiley','{:3_63:}','23.gif'),(64,3,24,'smiley','{:3_64:}','24.gif'),(65,0,1,'icon','','icon1.gif'),(66,0,2,'icon','','icon2.gif'),(67,0,3,'icon','','icon3.gif'),(68,0,4,'icon','','icon4.gif'),(69,0,5,'icon','','icon5.gif'),(70,0,6,'icon','','icon6.gif'),(71,0,7,'icon','','icon7.gif'),(72,0,8,'icon','','icon8.gif'),(73,0,9,'icon','','icon9.gif'),(74,0,10,'icon','','icon10.gif'),(75,0,11,'icon','','icon11.gif'),(76,0,12,'icon','','icon12.gif'),(77,0,13,'icon','','icon13.gif'),(78,0,14,'icon','','icon14.gif'),(79,0,15,'icon','','icon15.gif'),(80,0,16,'icon','','icon16.gif'),(81,0,0,'stamp','精華','001.gif'),(82,0,1,'stamp','熱帖','002.gif'),(83,0,2,'stamp','美圖','003.gif'),(84,0,3,'stamp','優秀','004.gif'),(85,0,4,'stamp','置頂','005.gif'),(86,0,5,'stamp','推薦','006.gif'),(87,0,6,'stamp','原創','007.gif'),(88,0,7,'stamp','版主推薦','008.gif'),(89,0,8,'stamp','爆料','009.gif');
/*!40000 ALTER TABLE `cdb_smilies` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cdb_spacecaches`
--

DROP TABLE IF EXISTS `cdb_spacecaches`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cdb_spacecaches` (
  `uid` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `variable` varchar(20) NOT NULL,
  `value` text NOT NULL,
  `expiration` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`uid`,`variable`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cdb_spacecaches`
--

LOCK TABLES `cdb_spacecaches` WRITE;
/*!40000 ALTER TABLE `cdb_spacecaches` DISABLE KEYS */;
/*!40000 ALTER TABLE `cdb_spacecaches` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cdb_stats`
--

DROP TABLE IF EXISTS `cdb_stats`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cdb_stats` (
  `type` char(10) NOT NULL DEFAULT '',
  `variable` char(10) NOT NULL DEFAULT '',
  `count` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`type`,`variable`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cdb_stats`
--

LOCK TABLES `cdb_stats` WRITE;
/*!40000 ALTER TABLE `cdb_stats` DISABLE KEYS */;
INSERT INTO `cdb_stats` VALUES ('total','hits',1),('total','members',0),('total','guests',1),('os','Windows',1),('os','Mac',0),('os','Linux',0),('os','FreeBSD',0),('os','SunOS',0),('os','OS/2',0),('os','AIX',0),('os','Spiders',0),('os','Other',0),('browser','MSIE',1),('browser','Netscape',0),('browser','Mozilla',0),('browser','Lynx',0),('browser','Opera',0),('browser','Konqueror',0),('browser','Other',0),('week','0',0),('week','1',1),('week','2',0),('week','3',0),('week','4',0),('week','5',0),('week','6',0),('hour','00',0),('hour','01',0),('hour','02',0),('hour','03',0),('hour','04',0),('hour','05',0),('hour','06',0),('hour','07',0),('hour','08',0),('hour','09',0),('hour','10',1),('hour','11',0),('hour','12',0),('hour','13',0),('hour','14',0),('hour','15',0),('hour','16',0),('hour','17',0),('hour','18',0),('hour','19',0),('hour','20',0),('hour','21',0),('hour','22',0),('hour','23',0),('browser','Firefox',0),('browser','Safari',0);
/*!40000 ALTER TABLE `cdb_stats` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cdb_statvars`
--

DROP TABLE IF EXISTS `cdb_statvars`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cdb_statvars` (
  `type` varchar(20) NOT NULL DEFAULT '',
  `variable` varchar(20) NOT NULL DEFAULT '',
  `value` mediumtext NOT NULL,
  PRIMARY KEY (`type`,`variable`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cdb_statvars`
--

LOCK TABLES `cdb_statvars` WRITE;
/*!40000 ALTER TABLE `cdb_statvars` DISABLE KEYS */;
/*!40000 ALTER TABLE `cdb_statvars` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cdb_styles`
--

DROP TABLE IF EXISTS `cdb_styles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cdb_styles` (
  `styleid` smallint(6) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL DEFAULT '',
  `available` tinyint(1) NOT NULL DEFAULT '1',
  `templateid` smallint(6) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`styleid`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cdb_styles`
--

LOCK TABLES `cdb_styles` WRITE;
/*!40000 ALTER TABLE `cdb_styles` DISABLE KEYS */;
INSERT INTO `cdb_styles` VALUES (1,'默認風格',1,1);
/*!40000 ALTER TABLE `cdb_styles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cdb_stylevars`
--

DROP TABLE IF EXISTS `cdb_stylevars`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cdb_stylevars` (
  `stylevarid` smallint(6) unsigned NOT NULL AUTO_INCREMENT,
  `styleid` smallint(6) unsigned NOT NULL DEFAULT '0',
  `variable` text NOT NULL,
  `substitute` text NOT NULL,
  PRIMARY KEY (`stylevarid`),
  KEY `styleid` (`styleid`)
) ENGINE=MyISAM AUTO_INCREMENT=48 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cdb_stylevars`
--

LOCK TABLES `cdb_stylevars` WRITE;
/*!40000 ALTER TABLE `cdb_stylevars` DISABLE KEYS */;
INSERT INTO `cdb_stylevars` VALUES (1,1,'stypeid','1'),(2,1,'available',''),(3,1,'boardimg','logo.gif'),(4,1,'imgdir',''),(5,1,'styleimgdir',''),(6,1,'font','Verdana, Helvetica, Arial, sans-serif'),(7,1,'fontsize','12px'),(8,1,'smfont','Verdana, Helvetica, Arial, sans-serif'),(9,1,'smfontsize','0.83em'),(10,1,'tabletext','#444'),(11,1,'midtext','#666'),(12,1,'lighttext','#999'),(13,1,'link','#000'),(14,1,'highlightlink','#09C'),(15,1,'noticetext','#F60'),(16,1,'msgfontsize','14px'),(17,1,'msgbigsize','16px'),(18,1,'bgcolor','#0D2345 bodybg.gif repeat-x 0 90px'),(19,1,'sidebgcolor','#FFF sidebg.gif repeat-y 100% 0'),(20,1,'headerborder','1px'),(21,1,'headerbordercolor','#00B2E8'),(22,1,'headerbgcolor','#00A2D2 header.gif repeat-x 0 100%'),(23,1,'headertext','#97F2FF'),(24,1,'footertext','#8691A2'),(25,1,'menuborder','#B0E4EF'),(26,1,'menubgcolor','#EBF4FD mtabbg.gif repeat-x 0 100%'),(27,1,'menutext','#666'),(28,1,'menuhover','#1E4B7E'),(29,1,'menuhovertext','#C3D3E4'),(30,1,'wrapwidth','960px'),(31,1,'wrapbg','#FFF'),(32,1,'wrapborder','0'),(33,1,'wrapbordercolor',''),(34,1,'contentwidth','600px'),(35,1,'contentseparate','#D3E8F2'),(36,1,'inputborder','#CCC'),(37,1,'inputborderdarkcolor','#999'),(38,1,'inputbg','#FFF'),(39,1,'commonborder','#E6E7E1'),(40,1,'commonbg','#F7F7F7'),(41,1,'specialborder','#E3EDF5'),(42,1,'specialbg','#EBF2F8'),(43,1,'interleavecolor','#F5F5F5'),(44,1,'dropmenuborder','#7FCAE2'),(45,1,'dropmenubgcolor','#FEFEFE'),(46,1,'floatmaskbgcolor','#7FCAE2'),(47,1,'floatbgcolor','#F1F5FA');
/*!40000 ALTER TABLE `cdb_stylevars` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cdb_tags`
--

DROP TABLE IF EXISTS `cdb_tags`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cdb_tags` (
  `tagname` char(20) NOT NULL,
  `closed` tinyint(1) NOT NULL DEFAULT '0',
  `total` mediumint(8) unsigned NOT NULL,
  PRIMARY KEY (`tagname`),
  KEY `total` (`total`),
  KEY `closed` (`closed`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cdb_tags`
--

LOCK TABLES `cdb_tags` WRITE;
/*!40000 ALTER TABLE `cdb_tags` DISABLE KEYS */;
/*!40000 ALTER TABLE `cdb_tags` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cdb_tasks`
--

DROP TABLE IF EXISTS `cdb_tasks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cdb_tasks` (
  `taskid` smallint(6) unsigned NOT NULL AUTO_INCREMENT,
  `relatedtaskid` smallint(6) unsigned NOT NULL DEFAULT '0',
  `newbietask` tinyint(1) NOT NULL DEFAULT '0',
  `available` tinyint(1) NOT NULL DEFAULT '0',
  `name` varchar(50) NOT NULL DEFAULT '',
  `description` text NOT NULL,
  `icon` varchar(150) NOT NULL DEFAULT '',
  `applicants` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `achievers` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `tasklimits` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `applyperm` text NOT NULL,
  `scriptname` varchar(50) NOT NULL DEFAULT '',
  `starttime` int(10) unsigned NOT NULL DEFAULT '0',
  `endtime` int(10) unsigned NOT NULL DEFAULT '0',
  `period` int(10) unsigned NOT NULL DEFAULT '0',
  `reward` enum('credit','magic','medal','invite','group') NOT NULL DEFAULT 'credit',
  `prize` varchar(15) NOT NULL DEFAULT '',
  `bonus` int(10) NOT NULL DEFAULT '0',
  `displayorder` smallint(6) NOT NULL DEFAULT '0',
  `version` varchar(15) NOT NULL DEFAULT '',
  PRIMARY KEY (`taskid`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cdb_tasks`
--

LOCK TABLES `cdb_tasks` WRITE;
/*!40000 ALTER TABLE `cdb_tasks` DISABLE KEYS */;
INSERT INTO `cdb_tasks` VALUES (1,0,1,0,'回帖是一種美德','學習回帖，看帖回帖是一種美德，BS看帖不回帖的','',0,0,0,'all','newbie_post_reply',0,0,0,'credit','2',10,-1,''),(2,0,1,0,'我的第一次','學會發主題帖，成為社區的焦點','',0,0,0,'all','newbie_post_newthread',0,0,0,'credit','2',10,-1,''),(3,0,1,0,'與眾不同','修改個人資料，讓你和別人與眾不同','',0,0,0,'all','newbie_modifyprofile',0,0,0,'credit','2',10,-1,''),(4,0,1,0,'我型我秀','上傳頭像，讓大家認識一個全新的你','',0,0,0,'all','newbie_uploadavatar',0,0,0,'credit','2',10,-1,''),(5,0,1,0,'聯絡感情','給其他用戶發個發短消息，大家聯絡一下感情','',0,0,0,'all','newbie_sendpm',0,0,0,'credit','2',10,-1,''),(6,0,1,0,'一個好漢三個幫','出來混的，沒幾個好友怎麼行，加個好友吧','',0,0,0,'all','newbie_addbuddy',0,0,0,'credit','2',10,-1,''),(7,0,1,0,'信息時代','信息時代最缺的什麼？搜索','',0,0,0,'all','newbie_search',0,0,0,'credit','2',10,-1,'');
/*!40000 ALTER TABLE `cdb_tasks` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cdb_taskvars`
--

DROP TABLE IF EXISTS `cdb_taskvars`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cdb_taskvars` (
  `taskvarid` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `taskid` smallint(6) unsigned NOT NULL DEFAULT '0',
  `sort` enum('apply','complete','setting') NOT NULL DEFAULT 'complete',
  `name` varchar(100) NOT NULL DEFAULT '',
  `description` varchar(255) NOT NULL DEFAULT '',
  `variable` varchar(40) NOT NULL DEFAULT '',
  `type` varchar(20) NOT NULL DEFAULT 'text',
  `value` text NOT NULL,
  `extra` text NOT NULL,
  PRIMARY KEY (`taskvarid`),
  KEY `taskid` (`taskid`)
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cdb_taskvars`
--

LOCK TABLES `cdb_taskvars` WRITE;
/*!40000 ALTER TABLE `cdb_taskvars` DISABLE KEYS */;
INSERT INTO `cdb_taskvars` VALUES (1,1,'complete','回復指定主題','設置會員只有回復該主題才能完成任務，請填寫主題的 tid(比如一個主題的地址是 http://localhost/viewthread.php?tid=8 那麼該主題的 tid 就是 8)，留空為不限制','threadid','text','0',''),(2,1,'setting','','','entrance','text','viewthread',''),(3,2,'complete','在指定版塊發表新主題','設置會員必須在某個版塊發表至少一篇新主題才能完成任務','forumid','text','',''),(4,2,'setting','','','entrance','text','forumdisplay',''),(5,3,'complete','完善個人資料','申請任務後只要把自己的個人資料填寫完整即可完成任務','','','',''),(6,3,'setting','','','entrance','text','memcp',''),(7,4,'complete','上傳頭像','申請任務後只要成功上傳頭像即可完成任務','','','',''),(8,4,'setting','','','entrance','text','memcp',''),(9,5,'complete','給指定會員發送短消息','只有給該會員成功發送短消息才能完成任務，請填寫該會員的用戶名','authorid','text','',''),(10,5,'setting','','','entrance','text','space',''),(11,6,'complete','將指定會員加為好友','只有將該會員加為好友才能完成任務，請填寫該會員的用戶名','authorid','text','',''),(12,6,'setting','','','entrance','text','space',''),(13,7,'complete','學會搜索','申請任務後只要成功使用論壇搜索功能即可完成任務','','','',''),(14,7,'setting','','','entrance','text','search','');
/*!40000 ALTER TABLE `cdb_taskvars` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cdb_templates`
--

DROP TABLE IF EXISTS `cdb_templates`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cdb_templates` (
  `templateid` smallint(6) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(30) NOT NULL DEFAULT '',
  `directory` varchar(100) NOT NULL DEFAULT '',
  `copyright` varchar(100) NOT NULL DEFAULT '',
  PRIMARY KEY (`templateid`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cdb_templates`
--

LOCK TABLES `cdb_templates` WRITE;
/*!40000 ALTER TABLE `cdb_templates` DISABLE KEYS */;
INSERT INTO `cdb_templates` VALUES (1,'默認模板套系','./templates/default','康盛創想（北京）科技有限公司');
/*!40000 ALTER TABLE `cdb_templates` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cdb_threads`
--

DROP TABLE IF EXISTS `cdb_threads`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cdb_threads` (
  `tid` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `fid` smallint(6) unsigned NOT NULL DEFAULT '0',
  `iconid` smallint(6) unsigned NOT NULL DEFAULT '0',
  `typeid` smallint(6) unsigned NOT NULL DEFAULT '0',
  `sortid` smallint(6) unsigned NOT NULL DEFAULT '0',
  `readperm` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `price` smallint(6) NOT NULL DEFAULT '0',
  `author` char(15) NOT NULL DEFAULT '',
  `authorid` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `subject` char(80) NOT NULL DEFAULT '',
  `dateline` int(10) unsigned NOT NULL DEFAULT '0',
  `lastpost` int(10) unsigned NOT NULL DEFAULT '0',
  `lastposter` char(15) NOT NULL DEFAULT '',
  `views` int(10) unsigned NOT NULL DEFAULT '0',
  `replies` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `displayorder` tinyint(1) NOT NULL DEFAULT '0',
  `highlight` tinyint(1) NOT NULL DEFAULT '0',
  `digest` tinyint(1) NOT NULL DEFAULT '0',
  `rate` tinyint(1) NOT NULL DEFAULT '0',
  `special` tinyint(1) NOT NULL DEFAULT '0',
  `attachment` tinyint(1) NOT NULL DEFAULT '0',
  `moderated` tinyint(1) NOT NULL DEFAULT '0',
  `closed` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `itemid` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `supe_pushstatus` tinyint(1) NOT NULL DEFAULT '0',
  `recommends` smallint(6) NOT NULL,
  `recommend_add` smallint(6) NOT NULL,
  `recommend_sub` smallint(6) NOT NULL,
  `heats` int(10) unsigned NOT NULL DEFAULT '0',
  `status` smallint(6) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`tid`),
  KEY `digest` (`digest`),
  KEY `sortid` (`sortid`),
  KEY `displayorder` (`fid`,`displayorder`,`lastpost`),
  KEY `typeid` (`fid`,`typeid`,`displayorder`,`lastpost`),
  KEY `recommends` (`recommends`),
  KEY `heats` (`heats`),
  KEY `authorid` (`authorid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cdb_threads`
--

LOCK TABLES `cdb_threads` WRITE;
/*!40000 ALTER TABLE `cdb_threads` DISABLE KEYS */;
/*!40000 ALTER TABLE `cdb_threads` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cdb_threadsmod`
--

DROP TABLE IF EXISTS `cdb_threadsmod`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cdb_threadsmod` (
  `tid` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `uid` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `username` char(15) NOT NULL DEFAULT '',
  `dateline` int(10) unsigned NOT NULL DEFAULT '0',
  `expiration` int(10) unsigned NOT NULL DEFAULT '0',
  `action` char(5) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `magicid` smallint(6) unsigned NOT NULL,
  `stamp` tinyint(3) NOT NULL,
  KEY `tid` (`tid`,`dateline`),
  KEY `expiration` (`expiration`,`status`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cdb_threadsmod`
--

LOCK TABLES `cdb_threadsmod` WRITE;
/*!40000 ALTER TABLE `cdb_threadsmod` DISABLE KEYS */;
/*!40000 ALTER TABLE `cdb_threadsmod` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cdb_threadtags`
--

DROP TABLE IF EXISTS `cdb_threadtags`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cdb_threadtags` (
  `tagname` char(20) NOT NULL,
  `tid` int(10) unsigned NOT NULL,
  KEY `tagname` (`tagname`),
  KEY `tid` (`tid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cdb_threadtags`
--

LOCK TABLES `cdb_threadtags` WRITE;
/*!40000 ALTER TABLE `cdb_threadtags` DISABLE KEYS */;
/*!40000 ALTER TABLE `cdb_threadtags` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cdb_threadtypes`
--

DROP TABLE IF EXISTS `cdb_threadtypes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cdb_threadtypes` (
  `typeid` smallint(6) unsigned NOT NULL AUTO_INCREMENT,
  `displayorder` smallint(6) NOT NULL DEFAULT '0',
  `name` varchar(255) NOT NULL DEFAULT '',
  `description` varchar(255) NOT NULL DEFAULT '',
  `special` smallint(6) NOT NULL DEFAULT '0',
  `modelid` smallint(6) unsigned NOT NULL DEFAULT '0',
  `expiration` tinyint(1) NOT NULL DEFAULT '0',
  `template` text NOT NULL,
  `stemplate` text NOT NULL,
  PRIMARY KEY (`typeid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cdb_threadtypes`
--

LOCK TABLES `cdb_threadtypes` WRITE;
/*!40000 ALTER TABLE `cdb_threadtypes` DISABLE KEYS */;
/*!40000 ALTER TABLE `cdb_threadtypes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cdb_tradecomments`
--

DROP TABLE IF EXISTS `cdb_tradecomments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cdb_tradecomments` (
  `id` mediumint(8) NOT NULL AUTO_INCREMENT,
  `orderid` char(32) NOT NULL,
  `pid` int(10) unsigned NOT NULL,
  `type` tinyint(1) NOT NULL,
  `raterid` mediumint(8) unsigned NOT NULL,
  `rater` char(15) NOT NULL,
  `rateeid` mediumint(8) unsigned NOT NULL,
  `ratee` char(15) NOT NULL,
  `message` char(200) NOT NULL,
  `explanation` char(200) NOT NULL,
  `score` tinyint(1) NOT NULL,
  `dateline` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `raterid` (`raterid`,`type`,`dateline`),
  KEY `rateeid` (`rateeid`,`type`,`dateline`),
  KEY `orderid` (`orderid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cdb_tradecomments`
--

LOCK TABLES `cdb_tradecomments` WRITE;
/*!40000 ALTER TABLE `cdb_tradecomments` DISABLE KEYS */;
/*!40000 ALTER TABLE `cdb_tradecomments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cdb_tradelog`
--

DROP TABLE IF EXISTS `cdb_tradelog`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cdb_tradelog` (
  `tid` mediumint(8) unsigned NOT NULL,
  `pid` int(10) unsigned NOT NULL,
  `orderid` varchar(32) NOT NULL,
  `tradeno` varchar(32) NOT NULL,
  `subject` varchar(100) NOT NULL,
  `price` decimal(8,2) NOT NULL,
  `quality` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `itemtype` tinyint(1) NOT NULL DEFAULT '0',
  `number` smallint(5) unsigned NOT NULL DEFAULT '0',
  `tax` decimal(6,2) unsigned NOT NULL DEFAULT '0.00',
  `locus` varchar(100) NOT NULL,
  `sellerid` mediumint(8) unsigned NOT NULL,
  `seller` varchar(15) NOT NULL,
  `selleraccount` varchar(50) NOT NULL,
  `buyerid` mediumint(8) unsigned NOT NULL,
  `buyer` varchar(15) NOT NULL,
  `buyercontact` varchar(50) NOT NULL,
  `buyercredits` smallint(5) unsigned NOT NULL DEFAULT '0',
  `buyermsg` varchar(200) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `lastupdate` int(10) unsigned NOT NULL DEFAULT '0',
  `offline` tinyint(1) NOT NULL DEFAULT '0',
  `buyername` varchar(50) NOT NULL,
  `buyerzip` varchar(10) NOT NULL,
  `buyerphone` varchar(20) NOT NULL,
  `buyermobile` varchar(20) NOT NULL,
  `transport` tinyint(1) NOT NULL DEFAULT '0',
  `transportfee` smallint(6) unsigned NOT NULL DEFAULT '0',
  `baseprice` decimal(8,2) NOT NULL,
  `discount` tinyint(1) NOT NULL DEFAULT '0',
  `ratestatus` tinyint(1) NOT NULL DEFAULT '0',
  `message` text NOT NULL,
  `credit` int(10) unsigned NOT NULL DEFAULT '0',
  `basecredit` int(10) unsigned NOT NULL DEFAULT '0',
  UNIQUE KEY `orderid` (`orderid`),
  KEY `sellerid` (`sellerid`),
  KEY `buyerid` (`buyerid`),
  KEY `status` (`status`),
  KEY `buyerlog` (`buyerid`,`status`,`lastupdate`),
  KEY `sellerlog` (`sellerid`,`status`,`lastupdate`),
  KEY `tid` (`tid`,`pid`),
  KEY `pid` (`pid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cdb_tradelog`
--

LOCK TABLES `cdb_tradelog` WRITE;
/*!40000 ALTER TABLE `cdb_tradelog` DISABLE KEYS */;
/*!40000 ALTER TABLE `cdb_tradelog` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cdb_tradeoptionvars`
--

DROP TABLE IF EXISTS `cdb_tradeoptionvars`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cdb_tradeoptionvars` (
  `sortid` smallint(6) unsigned NOT NULL DEFAULT '0',
  `pid` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `optionid` smallint(6) unsigned NOT NULL DEFAULT '0',
  `value` mediumtext NOT NULL,
  KEY `sortid` (`sortid`),
  KEY `pid` (`pid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cdb_tradeoptionvars`
--

LOCK TABLES `cdb_tradeoptionvars` WRITE;
/*!40000 ALTER TABLE `cdb_tradeoptionvars` DISABLE KEYS */;
/*!40000 ALTER TABLE `cdb_tradeoptionvars` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cdb_trades`
--

DROP TABLE IF EXISTS `cdb_trades`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cdb_trades` (
  `tid` mediumint(8) unsigned NOT NULL,
  `pid` int(10) unsigned NOT NULL,
  `typeid` smallint(6) unsigned NOT NULL,
  `sellerid` mediumint(8) unsigned NOT NULL,
  `seller` char(15) NOT NULL,
  `account` char(50) NOT NULL,
  `subject` char(100) NOT NULL,
  `price` decimal(8,2) NOT NULL,
  `amount` smallint(6) unsigned NOT NULL DEFAULT '1',
  `quality` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `locus` char(20) NOT NULL,
  `transport` tinyint(1) NOT NULL DEFAULT '0',
  `ordinaryfee` smallint(4) unsigned NOT NULL DEFAULT '0',
  `expressfee` smallint(4) unsigned NOT NULL DEFAULT '0',
  `emsfee` smallint(4) unsigned NOT NULL DEFAULT '0',
  `itemtype` tinyint(1) NOT NULL DEFAULT '0',
  `dateline` int(10) unsigned NOT NULL DEFAULT '0',
  `expiration` int(10) unsigned NOT NULL DEFAULT '0',
  `lastbuyer` char(15) NOT NULL,
  `lastupdate` int(10) unsigned NOT NULL DEFAULT '0',
  `totalitems` smallint(5) unsigned NOT NULL DEFAULT '0',
  `tradesum` decimal(8,2) NOT NULL DEFAULT '0.00',
  `closed` tinyint(1) NOT NULL DEFAULT '0',
  `aid` mediumint(8) unsigned NOT NULL,
  `displayorder` tinyint(1) NOT NULL,
  `costprice` decimal(8,2) NOT NULL,
  `credit` int(10) unsigned NOT NULL DEFAULT '0',
  `costcredit` int(10) unsigned NOT NULL DEFAULT '0',
  `credittradesum` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`tid`,`pid`),
  KEY `sellerid` (`sellerid`),
  KEY `totalitems` (`totalitems`),
  KEY `tradesum` (`tradesum`),
  KEY `displayorder` (`tid`,`displayorder`),
  KEY `sellertrades` (`sellerid`,`tradesum`,`totalitems`),
  KEY `typeid` (`typeid`),
  KEY `credittradesum` (`credittradesum`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cdb_trades`
--

LOCK TABLES `cdb_trades` WRITE;
/*!40000 ALTER TABLE `cdb_trades` DISABLE KEYS */;
/*!40000 ALTER TABLE `cdb_trades` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cdb_typemodels`
--

DROP TABLE IF EXISTS `cdb_typemodels`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cdb_typemodels` (
  `id` smallint(6) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `displayorder` tinyint(3) NOT NULL DEFAULT '0',
  `type` tinyint(1) NOT NULL DEFAULT '0',
  `options` mediumtext NOT NULL,
  `customoptions` mediumtext NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=101 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cdb_typemodels`
--

LOCK TABLES `cdb_typemodels` WRITE;
/*!40000 ALTER TABLE `cdb_typemodels` DISABLE KEYS */;
INSERT INTO `cdb_typemodels` VALUES (1,'房屋交易信息',0,1,'7	10	13	65	66	68',''),(2,'車票交易信息',0,1,'55	56	58	67	7	13	68',''),(3,'興趣交友信息',0,1,'8	9	31',''),(4,'公司招聘信息',0,1,'34	48	54	51	47	46	44	45	52	53','');
/*!40000 ALTER TABLE `cdb_typemodels` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cdb_typeoptions`
--

DROP TABLE IF EXISTS `cdb_typeoptions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cdb_typeoptions` (
  `optionid` smallint(6) unsigned NOT NULL AUTO_INCREMENT,
  `classid` smallint(6) unsigned NOT NULL DEFAULT '0',
  `displayorder` tinyint(3) NOT NULL DEFAULT '0',
  `title` varchar(100) NOT NULL DEFAULT '',
  `description` varchar(255) NOT NULL DEFAULT '',
  `identifier` varchar(40) NOT NULL DEFAULT '',
  `type` varchar(20) NOT NULL DEFAULT '',
  `unit` varchar(40) NOT NULL,
  `rules` mediumtext NOT NULL,
  PRIMARY KEY (`optionid`),
  KEY `classid` (`classid`)
) ENGINE=MyISAM AUTO_INCREMENT=3001 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cdb_typeoptions`
--

LOCK TABLES `cdb_typeoptions` WRITE;
/*!40000 ALTER TABLE `cdb_typeoptions` DISABLE KEYS */;
INSERT INTO `cdb_typeoptions` VALUES (1,0,0,'通用類','','','','',''),(2,0,0,'房產類','','','','',''),(3,0,0,'交友類','','','','',''),(4,0,0,'求職招聘類','','','','',''),(5,0,0,'交易類','','','','',''),(6,0,0,'互聯網類','','','','',''),(7,1,0,'姓名','','name','text','',''),(9,1,0,'年齡','','age','number','',''),(10,1,0,'地址','','address','text','',''),(11,1,0,'QQ','','qq','number','',''),(12,1,0,'郵箱','','mail','email','',''),(13,1,0,'電話','','phone','text','',''),(14,5,0,'培訓費用','','teach_pay','text','',''),(15,5,0,'培訓時間','','teach_time','text','',''),(20,2,0,'樓層','','floor','number','',''),(21,2,0,'交通狀況','','traf','textarea','',''),(22,2,0,'地圖','','images','image','',''),(24,2,0,'價格','','price','text','',''),(26,5,0,'培訓名稱','','teach_name','text','',''),(28,3,0,'身高','','heighth','number','',''),(29,3,0,'體重','','weighth','number','',''),(33,1,0,'照片','','photo','image','',''),(35,5,0,'服務方式','','service_type','text','',''),(36,5,0,'服務時間','','service_time','text','',''),(37,5,0,'服務費用','','service_pay','text','',''),(39,6,0,'網址','','site_url','url','',''),(40,6,0,'電子郵件','','site_mail','email','',''),(42,6,0,'網站名稱','','site_name','text','',''),(46,4,0,'職位','','recr_intend','text','',''),(47,4,0,'工作地點','','recr_palce','text','',''),(49,4,0,'有效期至','','recr_end','calendar','',''),(51,4,0,'公司名稱','','recr_com','text','',''),(52,4,0,'年齡要求','','recr_age','text','',''),(54,4,0,'專業','','recr_abli','text','',''),(55,5,0,'始發','','leaves','text','',''),(56,5,0,'終點','','boundfor','text','',''),(57,6,0,'Alexa排名','','site_top','number','',''),(58,5,0,'車次/航班','','train_no','text','',''),(59,5,0,'數量','','trade_num','number','',''),(60,5,0,'價格','','trade_price','text','',''),(61,5,0,'有效期至','','trade_end','calendar','',''),(63,1,0,'詳細描述','','detail_content','textarea','',''),(64,1,0,'籍貫','','born_place','text','',''),(65,2,0,'租金','','money','text','',''),(66,2,0,'面積','','acreage','text','',''),(67,5,0,'發車時間','','time','calendar','','N;'),(68,1,0,'所在地','','now_place','text','',''),(8,1,2,'性別','','gender','radio','','a:3:{s:8:\"required\";s:1:\"0\";s:12:\"unchangeable\";s:1:\"0\";s:7:\"choices\";s:12:\"1=男\r\n2=女\";}'),(16,2,0,'房屋類型','','property','select','','a:1:{s:7:\"choices\";s:64:\"1=寫字樓\r\n2=公寓\r\n3=小區\r\n4=平房\r\n5=別墅\r\n6=地下室\";}'),(17,2,0,'座向','','face','radio','','a:3:{s:8:\"required\";s:1:\"0\";s:12:\"unchangeable\";s:1:\"0\";s:7:\"choices\";s:38:\"1=南向\r\n2=北向\r\n3=西向\r\n4=東向\";}'),(18,2,0,'裝修情況','','makes','radio','','a:3:{s:8:\"required\";s:1:\"0\";s:12:\"unchangeable\";s:1:\"0\";s:7:\"choices\";s:40:\"1=無裝修\r\n2=簡單裝修\r\n3=精裝修\";}'),(19,2,0,'居室','','mode','select','','a:1:{s:7:\"choices\";s:57:\"1=獨居\r\n2=兩居室\r\n3=三居室\r\n4=四居室\r\n5=別墅\";}'),(23,2,0,'屋內設施','','equipment','checkbox','','a:3:{s:8:\"required\";s:1:\"0\";s:12:\"unchangeable\";s:1:\"0\";s:7:\"choices\";s:167:\"1=水電\r\n2=寬帶\r\n3=管道氣\r\n4=有線電視\r\n5=電梯\r\n6=電話\r\n7=冰箱\r\n8=洗衣機\r\n9=熱水器\r\n10=空調\r\n11=暖氣\r\n12=微波爐\r\n13=油煙機\r\n14=飲水機\";}'),(25,2,0,'是否中介','','bool','radio','','a:3:{s:8:\"required\";s:1:\"0\";s:12:\"unchangeable\";s:1:\"0\";s:7:\"choices\";s:12:\"1=是\r\n2=否\";}'),(27,3,0,'星座','','Horoscope','select','','a:1:{s:7:\"choices\";s:157:\"1=白羊座\r\n2=金牛座\r\n3=雙子座\r\n4=巨蟹座\r\n5=獅子座\r\n6=處女座\r\n7=天秤座\r\n8=天蠍座\r\n9=射手座\r\n10=摩羯座\r\n11=水瓶座\r\n12=雙魚座\";}'),(30,3,0,'婚姻狀況','','marrige','radio','','a:1:{s:7:\"choices\";s:18:\"1=已婚\r\n2=未婚\";}'),(31,3,0,'愛好','','hobby','checkbox','','a:1:{s:7:\"choices\";s:242:\"1=美食\r\n2=唱歌\r\n3=跳舞\r\n4=電影\r\n5=音樂\r\n6=戲劇\r\n7=聊天\r\n8=拍托\r\n9=電腦\r\n10=網絡\r\n11=遊戲\r\n12=繪畫\r\n13=書法\r\n14=雕塑\r\n15=異性\r\n16=閱讀\r\n17=運動\r\n18=旅遊\r\n19=八卦\r\n20=購物\r\n21=賺錢\r\n22=汽車\r\n23=攝影\";}'),(32,3,0,'收入範圍','','salary','select','','a:3:{s:8:\"required\";s:1:\"0\";s:12:\"unchangeable\";s:1:\"0\";s:7:\"choices\";s:109:\"1=保密\r\n2=800元以上\r\n3=1500元以上\r\n4=2000元以上\r\n5=3000元以上\r\n6=5000元以上\r\n7=8000元以上\";}'),(34,1,0,'學歷','','education','radio','','a:3:{s:8:\"required\";s:1:\"0\";s:12:\"unchangeable\";s:1:\"0\";s:7:\"choices\";s:91:\"1=文盲\r\n2=小學\r\n3=初中\r\n4=高中\r\n5=中專\r\n6=大專\r\n7=本科\r\n8=研究生\r\n9=博士\";}'),(38,5,0,'席別','','seats','select','','a:1:{s:7:\"choices\";s:48:\"1=站票\r\n2=硬座\r\n3=軟座\r\n4=硬臥\r\n5=軟臥\";}'),(44,4,0,'是否應屆','','recr_term','radio','','a:3:{s:8:\"required\";s:1:\"0\";s:12:\"unchangeable\";s:1:\"0\";s:7:\"choices\";s:21:\"1=應屆\r\n2=非應屆\";}'),(48,4,0,'薪金','','recr_salary','select','','a:1:{s:7:\"choices\";s:114:\"1=面議\r\n2=1000以下\r\n3=1000~1500\r\n4=1500~2000\r\n5=2000~3000\r\n6=3000~4000\r\n7=4000~6000\r\n8=6000~8000\r\n9=8000以上\";}'),(50,4,0,'工作性質','','recr_work','radio','','a:3:{s:8:\"required\";s:1:\"0\";s:12:\"unchangeable\";s:1:\"0\";s:7:\"choices\";s:18:\"1=全職\r\n2=兼職\";}'),(53,4,0,'性別要求','','recr_sex','checkbox','','a:3:{s:8:\"required\";s:1:\"0\";s:12:\"unchangeable\";s:1:\"0\";s:7:\"choices\";s:12:\"1=男\r\n2=女\";}'),(62,5,0,'付款方式','','pay_type','checkbox','','a:3:{s:8:\"required\";s:1:\"0\";s:12:\"unchangeable\";s:1:\"0\";s:7:\"choices\";s:41:\"1=電匯\r\n2=支付寶\r\n3=現金\r\n4=其他\";}');
/*!40000 ALTER TABLE `cdb_typeoptions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cdb_typeoptionvars`
--

DROP TABLE IF EXISTS `cdb_typeoptionvars`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cdb_typeoptionvars` (
  `sortid` smallint(6) unsigned NOT NULL DEFAULT '0',
  `tid` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `optionid` smallint(6) unsigned NOT NULL DEFAULT '0',
  `expiration` int(10) unsigned NOT NULL DEFAULT '0',
  `value` mediumtext NOT NULL,
  KEY `sortid` (`sortid`),
  KEY `tid` (`tid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cdb_typeoptionvars`
--

LOCK TABLES `cdb_typeoptionvars` WRITE;
/*!40000 ALTER TABLE `cdb_typeoptionvars` DISABLE KEYS */;
/*!40000 ALTER TABLE `cdb_typeoptionvars` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cdb_typevars`
--

DROP TABLE IF EXISTS `cdb_typevars`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cdb_typevars` (
  `sortid` smallint(6) NOT NULL DEFAULT '0',
  `optionid` smallint(6) NOT NULL DEFAULT '0',
  `available` tinyint(1) NOT NULL DEFAULT '0',
  `required` tinyint(1) NOT NULL DEFAULT '0',
  `unchangeable` tinyint(1) NOT NULL DEFAULT '0',
  `search` tinyint(1) NOT NULL DEFAULT '0',
  `displayorder` tinyint(3) NOT NULL DEFAULT '0',
  `subjectshow` tinyint(1) NOT NULL DEFAULT '0',
  UNIQUE KEY `optionid` (`sortid`,`optionid`),
  KEY `sortid` (`sortid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cdb_typevars`
--

LOCK TABLES `cdb_typevars` WRITE;
/*!40000 ALTER TABLE `cdb_typevars` DISABLE KEYS */;
/*!40000 ALTER TABLE `cdb_typevars` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cdb_usergroups`
--

DROP TABLE IF EXISTS `cdb_usergroups`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cdb_usergroups` (
  `groupid` smallint(6) unsigned NOT NULL AUTO_INCREMENT,
  `radminid` tinyint(3) NOT NULL DEFAULT '0',
  `type` enum('system','special','member') NOT NULL DEFAULT 'member',
  `system` char(8) NOT NULL DEFAULT 'private',
  `grouptitle` char(30) NOT NULL DEFAULT '',
  `creditshigher` int(10) NOT NULL DEFAULT '0',
  `creditslower` int(10) NOT NULL DEFAULT '0',
  `stars` tinyint(3) NOT NULL DEFAULT '0',
  `color` char(7) NOT NULL DEFAULT '',
  `groupavatar` char(60) NOT NULL DEFAULT '',
  `readaccess` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `allowvisit` tinyint(1) NOT NULL DEFAULT '0',
  `allowpost` tinyint(1) NOT NULL DEFAULT '0',
  `allowreply` tinyint(1) NOT NULL DEFAULT '0',
  `allowpostpoll` tinyint(1) NOT NULL DEFAULT '0',
  `allowpostreward` tinyint(1) NOT NULL DEFAULT '0',
  `allowposttrade` tinyint(1) NOT NULL DEFAULT '0',
  `allowpostactivity` tinyint(1) NOT NULL DEFAULT '0',
  `allowdirectpost` tinyint(1) NOT NULL DEFAULT '0',
  `allowgetattach` tinyint(1) NOT NULL DEFAULT '0',
  `allowpostattach` tinyint(1) NOT NULL DEFAULT '0',
  `allowvote` tinyint(1) NOT NULL DEFAULT '0',
  `allowmultigroups` tinyint(1) NOT NULL DEFAULT '0',
  `allowsearch` tinyint(1) NOT NULL DEFAULT '0',
  `allowcstatus` tinyint(1) NOT NULL DEFAULT '0',
  `allowuseblog` tinyint(1) NOT NULL DEFAULT '0',
  `allowinvisible` tinyint(1) NOT NULL DEFAULT '0',
  `allowtransfer` tinyint(1) NOT NULL DEFAULT '0',
  `allowsetreadperm` tinyint(1) NOT NULL DEFAULT '0',
  `allowsetattachperm` tinyint(1) NOT NULL DEFAULT '0',
  `allowhidecode` tinyint(1) NOT NULL DEFAULT '0',
  `allowhtml` tinyint(1) NOT NULL DEFAULT '0',
  `allowcusbbcode` tinyint(1) NOT NULL DEFAULT '0',
  `allowanonymous` tinyint(1) NOT NULL DEFAULT '0',
  `allownickname` tinyint(1) NOT NULL DEFAULT '0',
  `allowsigbbcode` tinyint(1) NOT NULL DEFAULT '0',
  `allowsigimgcode` tinyint(1) NOT NULL DEFAULT '0',
  `allowviewpro` tinyint(1) NOT NULL DEFAULT '0',
  `allowviewstats` tinyint(1) NOT NULL DEFAULT '0',
  `disableperiodctrl` tinyint(1) NOT NULL DEFAULT '0',
  `reasonpm` tinyint(1) NOT NULL DEFAULT '0',
  `maxprice` smallint(6) unsigned NOT NULL DEFAULT '0',
  `maxsigsize` smallint(6) unsigned NOT NULL DEFAULT '0',
  `maxattachsize` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `maxsizeperday` int(10) unsigned NOT NULL DEFAULT '0',
  `maxpostsperhour` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `attachextensions` char(100) NOT NULL DEFAULT '',
  `raterange` char(150) NOT NULL DEFAULT '',
  `mintradeprice` smallint(6) unsigned NOT NULL DEFAULT '1',
  `maxtradeprice` smallint(6) unsigned NOT NULL DEFAULT '0',
  `minrewardprice` smallint(6) NOT NULL DEFAULT '1',
  `maxrewardprice` smallint(6) NOT NULL DEFAULT '0',
  `magicsdiscount` tinyint(1) NOT NULL,
  `allowmagics` tinyint(1) unsigned NOT NULL,
  `maxmagicsweight` smallint(6) unsigned NOT NULL,
  `allowbiobbcode` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `allowbioimgcode` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `maxbiosize` smallint(6) unsigned NOT NULL DEFAULT '0',
  `allowinvite` tinyint(1) NOT NULL DEFAULT '0',
  `allowmailinvite` tinyint(1) NOT NULL DEFAULT '0',
  `maxinvitenum` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `inviteprice` smallint(6) unsigned NOT NULL DEFAULT '0',
  `maxinviteday` smallint(6) unsigned NOT NULL DEFAULT '0',
  `allowpostdebate` tinyint(1) NOT NULL DEFAULT '0',
  `tradestick` tinyint(1) unsigned NOT NULL,
  `exempt` tinyint(1) unsigned NOT NULL,
  `allowsendpm` tinyint(1) NOT NULL DEFAULT '1',
  `maxattachnum` smallint(6) NOT NULL DEFAULT '0',
  `allowposturl` tinyint(1) NOT NULL DEFAULT '3',
  `allowrecommend` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `edittimelimit` smallint(6) unsigned NOT NULL DEFAULT '0',
  `allowpostrushreply` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`groupid`),
  KEY `creditsrange` (`creditshigher`,`creditslower`)
) ENGINE=MyISAM AUTO_INCREMENT=20 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cdb_usergroups`
--

LOCK TABLES `cdb_usergroups` WRITE;
/*!40000 ALTER TABLE `cdb_usergroups` DISABLE KEYS */;
INSERT INTO `cdb_usergroups` VALUES (1,1,'system','private','管理員',0,0,9,'','',200,1,1,1,1,1,1,1,3,1,1,1,1,2,1,1,1,1,1,1,1,0,1,1,1,1,1,1,1,1,0,30,500,2048000,0,0,'','1	-30	30	500',1,0,1,0,0,2,200,2,2,0,0,0,0,0,0,1,5,255,1,0,3,1,0,1),(2,2,'system','private','超級版主',0,0,8,'','',150,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,0,1,0,1,1,1,1,1,1,0,20,300,2048000,0,0,'chm, pdf, zip, rar, tar, gz, bzip2, gif, jpg, jpeg, png','1	-15	15	50',1,0,1,0,0,2,180,2,2,0,0,0,0,0,0,1,5,255,1,0,3,1,0,0),(3,3,'system','private','版主',0,0,7,'','',100,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,0,1,1,1,1,0,1,0,1,1,1,1,1,1,0,10,200,2048000,0,0,'chm, pdf, zip, rar, tar, gz, bzip2, gif, jpg, jpeg, png','1	-10	10	30',1,0,1,0,0,2,160,2,2,0,0,0,0,0,0,1,5,224,1,0,3,1,0,0),(4,0,'system','private','禁止發言',0,0,0,'','',0,1,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,'','',1,0,1,0,1,0,0,0,0,0,0,0,0,0,0,0,5,0,1,0,3,1,0,0),(5,0,'system','private','禁止訪問',0,0,0,'','',0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,'','',1,0,1,0,1,0,0,0,0,0,0,0,0,0,0,0,5,0,1,0,3,1,0,0),(6,0,'system','private','禁止 IP',0,0,0,'','',0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,'','',1,0,1,0,1,0,0,0,0,0,0,0,0,0,0,0,5,0,1,0,3,1,0,0),(7,0,'system','private','遊客',0,0,0,'','',1,1,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,'gif,jpg,jpeg,png','',1,0,1,0,1,0,0,0,0,0,0,0,0,0,0,0,5,0,1,0,3,1,0,0),(8,0,'system','private','等待驗證會員',0,0,0,'','',0,1,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,1,0,0,0,0,0,0,50,0,0,0,'','',1,0,1,0,1,0,0,0,0,0,0,0,0,0,0,0,5,0,1,0,3,1,0,0),(9,0,'member','private','乞丐',-9999999,0,0,'','',0,1,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,1,0,0,0,0,0,0,0,0,'chm,pdf,zip,rar,tar,gz,bzip2,gif,jpg,jpeg,png','',1,0,1,0,1,0,0,0,0,0,0,0,0,0,0,0,5,0,1,0,3,1,0,0),(10,0,'member','private','新手上路',0,50,1,'','',10,1,1,1,0,0,1,0,0,1,1,0,0,1,0,0,0,0,0,0,0,0,0,0,0,1,0,1,0,0,0,0,80,1024000,0,0,'chm, pdf, zip, rar, tar, gz, bzip2, gif, jpg, jpeg, png','',1,0,1,0,0,1,40,1,1,0,0,0,0,0,0,1,5,0,1,0,3,1,0,0),(11,0,'member','private','註冊會員',50,200,2,'','',20,1,1,1,1,1,1,1,0,1,1,1,0,1,0,0,0,0,0,0,0,0,0,0,0,1,0,1,1,0,0,0,100,1024000,0,0,'chm, pdf, zip, rar, tar, gz, bzip2, gif, jpg, jpeg, png','',1,0,1,0,0,1,60,1,1,0,0,0,0,0,0,1,5,0,1,0,3,1,0,0),(12,0,'member','private','中級會員',200,500,3,'','',30,1,1,1,1,1,1,1,0,1,1,1,0,1,0,0,0,0,0,0,0,0,1,0,0,1,0,1,1,0,0,0,150,1024000,0,0,'chm, pdf, zip, rar, tar, gz, bzip2, gif, jpg, jpeg, png','',1,0,1,0,0,1,80,1,1,0,0,0,0,0,0,1,5,0,1,0,3,1,0,0),(13,0,'member','private','高級會員',500,1000,4,'','',50,1,1,1,1,1,1,1,0,1,1,1,1,1,1,0,0,0,0,0,0,0,1,0,1,1,0,1,1,0,0,0,200,2048000,0,0,'chm, pdf, zip, rar, tar, gz, bzip2, gif, jpg, jpeg, png','1	-10	10	30',1,0,1,0,0,2,100,2,2,0,0,0,0,0,0,1,5,0,1,0,3,1,0,0),(14,0,'member','private','金牌會員',1000,3000,6,'','',70,1,1,1,1,1,1,1,0,1,1,1,1,1,1,0,0,0,1,1,0,0,1,0,1,1,1,1,1,0,0,0,300,2048000,0,0,'chm, pdf, zip, rar, tar, gz, bzip2, gif, jpg, jpeg, png','1	-15	15	40',1,0,1,0,0,2,120,2,2,0,0,0,0,0,0,1,5,0,1,0,3,1,0,0),(15,0,'member','private','論壇元老',3000,9999999,8,'','',90,1,1,1,1,1,1,1,0,1,1,1,1,1,1,0,1,0,1,1,0,0,1,1,1,1,1,1,1,0,0,0,500,2048000,0,0,'chm, pdf, zip, rar, tar, gz, bzip2, gif, jpg, jpeg, png','1	-20	20	50',1,0,1,0,0,2,140,2,2,0,0,0,0,0,0,1,5,0,1,0,3,1,0,0),(16,3,'special','private','實習版主',0,0,7,'','',100,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,0,1,1,1,1,0,1,0,1,1,1,1,1,1,0,10,200,2048000,0,0,'chm, pdf, zip, rar, tar, gz, bzip2, gif, jpg, jpeg, png','1 -10 10 30',1,0,1,0,0,2,160,1,1,0,0,0,0,0,10,1,5,188,1,0,3,0,0,0),(17,2,'special','private','網站編輯',0,0,8,'','',150,1,1,1,1,1,1,1,3,1,1,1,1,1,1,1,1,1,1,1,1,0,1,0,1,1,1,1,1,1,0,20,300,2048000,0,0,'chm, pdf, zip, rar, tar, gz, bzip2, gif, jpg, jpeg, png','1 -15 15 50',1,0,1,0,0,2,180,1,1,0,0,0,0,0,10,1,5,255,1,0,3,0,0,0),(18,1,'special','private','信息監察員',0,0,9,'','',200,1,1,1,1,1,1,1,3,1,1,1,1,2,0,1,1,1,1,1,1,1,1,1,1,1,1,1,1,0,0,30,500,0,0,1,'','1 -30 30 400 2 -30 30 400 3 -30 30 4000',1,0,1,0,0,2,200,1,1,0,1,1,0,1,10,1,5,255,1,0,3,3,0,0),(19,3,'special','private','審核員',0,0,7,'','',100,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,0,1,1,1,1,0,1,0,1,1,1,1,1,1,0,10,200,2048000,0,0,'chm, pdf, zip, rar, tar, gz, bzip2, gif, jpg, jpeg, png','1 -10 10 30',1,0,1,0,0,2,160,1,1,0,0,0,0,0,10,1,5,188,1,0,3,0,0,0);
/*!40000 ALTER TABLE `cdb_usergroups` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cdb_validating`
--

DROP TABLE IF EXISTS `cdb_validating`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cdb_validating` (
  `uid` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `submitdate` int(10) unsigned NOT NULL DEFAULT '0',
  `moddate` int(10) unsigned NOT NULL DEFAULT '0',
  `admin` varchar(15) NOT NULL DEFAULT '',
  `submittimes` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `message` text NOT NULL,
  `remark` text NOT NULL,
  PRIMARY KEY (`uid`),
  KEY `status` (`status`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cdb_validating`
--

LOCK TABLES `cdb_validating` WRITE;
/*!40000 ALTER TABLE `cdb_validating` DISABLE KEYS */;
/*!40000 ALTER TABLE `cdb_validating` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cdb_warnings`
--

DROP TABLE IF EXISTS `cdb_warnings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cdb_warnings` (
  `wid` smallint(6) unsigned NOT NULL AUTO_INCREMENT,
  `pid` int(10) unsigned NOT NULL,
  `operatorid` mediumint(8) unsigned NOT NULL,
  `operator` char(15) NOT NULL,
  `authorid` mediumint(8) unsigned NOT NULL,
  `author` char(15) NOT NULL,
  `dateline` int(10) unsigned NOT NULL,
  `reason` char(40) NOT NULL,
  PRIMARY KEY (`wid`),
  UNIQUE KEY `pid` (`pid`),
  KEY `authorid` (`authorid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cdb_warnings`
--

LOCK TABLES `cdb_warnings` WRITE;
/*!40000 ALTER TABLE `cdb_warnings` DISABLE KEYS */;
/*!40000 ALTER TABLE `cdb_warnings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cdb_words`
--

DROP TABLE IF EXISTS `cdb_words`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cdb_words` (
  `id` smallint(6) unsigned NOT NULL AUTO_INCREMENT,
  `admin` varchar(15) NOT NULL DEFAULT '',
  `find` varchar(255) NOT NULL DEFAULT '',
  `replacement` varchar(255) NOT NULL DEFAULT '',
  `extra` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cdb_words`
--

LOCK TABLES `cdb_words` WRITE;
/*!40000 ALTER TABLE `cdb_words` DISABLE KEYS */;
/*!40000 ALTER TABLE `cdb_words` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `uc_admins`
--

DROP TABLE IF EXISTS `uc_admins`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `uc_admins` (
  `uid` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `username` char(15) NOT NULL DEFAULT '',
  `allowadminsetting` tinyint(1) NOT NULL DEFAULT '0',
  `allowadminapp` tinyint(1) NOT NULL DEFAULT '0',
  `allowadminuser` tinyint(1) NOT NULL DEFAULT '0',
  `allowadminbadword` tinyint(1) NOT NULL DEFAULT '0',
  `allowadmintag` tinyint(1) NOT NULL DEFAULT '0',
  `allowadminpm` tinyint(1) NOT NULL DEFAULT '0',
  `allowadmincredits` tinyint(1) NOT NULL DEFAULT '0',
  `allowadmindomain` tinyint(1) NOT NULL DEFAULT '0',
  `allowadmindb` tinyint(1) NOT NULL DEFAULT '0',
  `allowadminnote` tinyint(1) NOT NULL DEFAULT '0',
  `allowadmincache` tinyint(1) NOT NULL DEFAULT '0',
  `allowadminlog` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`uid`),
  UNIQUE KEY `username` (`username`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `uc_admins`
--

LOCK TABLES `uc_admins` WRITE;
/*!40000 ALTER TABLE `uc_admins` DISABLE KEYS */;
/*!40000 ALTER TABLE `uc_admins` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `uc_applications`
--

DROP TABLE IF EXISTS `uc_applications`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `uc_applications` (
  `appid` smallint(6) unsigned NOT NULL AUTO_INCREMENT,
  `type` char(16) NOT NULL DEFAULT '',
  `name` char(20) NOT NULL DEFAULT '',
  `url` char(255) NOT NULL DEFAULT '',
  `authkey` char(255) NOT NULL DEFAULT '',
  `ip` char(15) NOT NULL DEFAULT '',
  `viewprourl` char(255) NOT NULL,
  `apifilename` char(30) NOT NULL DEFAULT 'uc.php',
  `charset` char(8) NOT NULL DEFAULT '',
  `dbcharset` char(8) NOT NULL DEFAULT '',
  `synlogin` tinyint(1) NOT NULL DEFAULT '0',
  `recvnote` tinyint(1) DEFAULT '0',
  `extra` mediumtext NOT NULL,
  `tagtemplates` mediumtext NOT NULL,
  PRIMARY KEY (`appid`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `uc_applications`
--

LOCK TABLES `uc_applications` WRITE;
/*!40000 ALTER TABLE `uc_applications` DISABLE KEYS */;
INSERT INTO `uc_applications` VALUES (1,'UCHOME','個人家園','http://127.0.0.1/upload/home','Peu258SbJfk6Idb9d8J50ay28cl1A3Od44x16aW7zab8Dbb66frbf5la6c40T3b8','','','uc.php','utf-8','utf8',1,1,'','<?xml version=\"1.0\" encoding=\"ISO-8859-1\"?>\r\n<root>\r\n	<item id=\"template\"><![CDATA[<a href=\"{url}\" target=\"_blank\">{subject}</a>]]></item>\r\n	<item id=\"fields\">\r\n		<item id=\"subject\"><![CDATA[日誌標題]]></item>\r\n		<item id=\"uid\"><![CDATA[用戶 ID]]></item>\r\n		<item id=\"username\"><![CDATA[用戶名]]></item>\r\n		<item id=\"dateline\"><![CDATA[日期]]></item>\r\n		<item id=\"spaceurl\"><![CDATA[空間地址]]></item>\r\n		<item id=\"url\"><![CDATA[日誌地址]]></item>\r\n	</item>\r\n</root>'),(2,'DISCUZ','Discuz!','http://127.0.0.1/upload/bbs','Afg5834aa9Vajfy7D7F2fci693Bc4fae55YcWetb72OcM47dR9W7869bf2xbmfP4','','','uc.php','utf-8','utf8',1,1,'','<?xml version=\"1.0\" encoding=\"ISO-8859-1\"?>\r\n<root>\r\n	<item id=\"template\"><![CDATA[<a href=\"{url}\" target=\"_blank\">{subject}</a>]]></item>\r\n	<item id=\"fields\">\r\n		<item id=\"subject\"><![CDATA[標題]]></item>\r\n		<item id=\"uid\"><![CDATA[用戶 ID]]></item>\r\n		<item id=\"username\"><![CDATA[發帖者]]></item>\r\n		<item id=\"dateline\"><![CDATA[日期]]></item>\r\n		<item id=\"url\"><![CDATA[主題地址]]></item>\r\n	</item>\r\n</root>');
/*!40000 ALTER TABLE `uc_applications` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `uc_badwords`
--

DROP TABLE IF EXISTS `uc_badwords`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `uc_badwords` (
  `id` smallint(6) unsigned NOT NULL AUTO_INCREMENT,
  `admin` varchar(15) NOT NULL DEFAULT '',
  `find` varchar(255) NOT NULL DEFAULT '',
  `replacement` varchar(255) NOT NULL DEFAULT '',
  `findpattern` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  UNIQUE KEY `find` (`find`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `uc_badwords`
--

LOCK TABLES `uc_badwords` WRITE;
/*!40000 ALTER TABLE `uc_badwords` DISABLE KEYS */;
/*!40000 ALTER TABLE `uc_badwords` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `uc_domains`
--

DROP TABLE IF EXISTS `uc_domains`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `uc_domains` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `domain` char(40) NOT NULL DEFAULT '',
  `ip` char(15) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `uc_domains`
--

LOCK TABLES `uc_domains` WRITE;
/*!40000 ALTER TABLE `uc_domains` DISABLE KEYS */;
/*!40000 ALTER TABLE `uc_domains` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `uc_failedlogins`
--

DROP TABLE IF EXISTS `uc_failedlogins`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `uc_failedlogins` (
  `ip` char(15) NOT NULL DEFAULT '',
  `count` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `lastupdate` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`ip`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `uc_failedlogins`
--

LOCK TABLES `uc_failedlogins` WRITE;
/*!40000 ALTER TABLE `uc_failedlogins` DISABLE KEYS */;
/*!40000 ALTER TABLE `uc_failedlogins` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `uc_feeds`
--

DROP TABLE IF EXISTS `uc_feeds`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `uc_feeds` (
  `feedid` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `appid` varchar(30) NOT NULL DEFAULT '',
  `icon` varchar(30) NOT NULL DEFAULT '',
  `uid` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `username` varchar(15) NOT NULL DEFAULT '',
  `dateline` int(10) unsigned NOT NULL DEFAULT '0',
  `hash_template` varchar(32) NOT NULL DEFAULT '',
  `hash_data` varchar(32) NOT NULL DEFAULT '',
  `title_template` text NOT NULL,
  `title_data` text NOT NULL,
  `body_template` text NOT NULL,
  `body_data` text NOT NULL,
  `body_general` text NOT NULL,
  `image_1` varchar(255) NOT NULL DEFAULT '',
  `image_1_link` varchar(255) NOT NULL DEFAULT '',
  `image_2` varchar(255) NOT NULL DEFAULT '',
  `image_2_link` varchar(255) NOT NULL DEFAULT '',
  `image_3` varchar(255) NOT NULL DEFAULT '',
  `image_3_link` varchar(255) NOT NULL DEFAULT '',
  `image_4` varchar(255) NOT NULL DEFAULT '',
  `image_4_link` varchar(255) NOT NULL DEFAULT '',
  `target_ids` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`feedid`),
  KEY `uid` (`uid`,`dateline`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `uc_feeds`
--

LOCK TABLES `uc_feeds` WRITE;
/*!40000 ALTER TABLE `uc_feeds` DISABLE KEYS */;
/*!40000 ALTER TABLE `uc_feeds` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `uc_friends`
--

DROP TABLE IF EXISTS `uc_friends`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `uc_friends` (
  `uid` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `friendid` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `direction` tinyint(1) NOT NULL DEFAULT '0',
  `version` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `delstatus` tinyint(1) NOT NULL DEFAULT '0',
  `comment` char(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`version`),
  KEY `uid` (`uid`),
  KEY `friendid` (`friendid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `uc_friends`
--

LOCK TABLES `uc_friends` WRITE;
/*!40000 ALTER TABLE `uc_friends` DISABLE KEYS */;
/*!40000 ALTER TABLE `uc_friends` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `uc_mailqueue`
--

DROP TABLE IF EXISTS `uc_mailqueue`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `uc_mailqueue` (
  `mailid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `touid` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `tomail` varchar(32) NOT NULL,
  `frommail` varchar(100) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `charset` varchar(15) NOT NULL,
  `htmlon` tinyint(1) NOT NULL DEFAULT '0',
  `level` tinyint(1) NOT NULL DEFAULT '1',
  `dateline` int(10) unsigned NOT NULL DEFAULT '0',
  `failures` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `appid` smallint(6) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`mailid`),
  KEY `appid` (`appid`),
  KEY `level` (`level`,`failures`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `uc_mailqueue`
--

LOCK TABLES `uc_mailqueue` WRITE;
/*!40000 ALTER TABLE `uc_mailqueue` DISABLE KEYS */;
/*!40000 ALTER TABLE `uc_mailqueue` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `uc_memberfields`
--

DROP TABLE IF EXISTS `uc_memberfields`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `uc_memberfields` (
  `uid` mediumint(8) unsigned NOT NULL,
  `blacklist` text NOT NULL,
  PRIMARY KEY (`uid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `uc_memberfields`
--

LOCK TABLES `uc_memberfields` WRITE;
/*!40000 ALTER TABLE `uc_memberfields` DISABLE KEYS */;
INSERT INTO `uc_memberfields` VALUES (1,'');
/*!40000 ALTER TABLE `uc_memberfields` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `uc_members`
--

DROP TABLE IF EXISTS `uc_members`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `uc_members` (
  `uid` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `username` char(15) NOT NULL DEFAULT '',
  `password` char(32) NOT NULL DEFAULT '',
  `email` char(32) NOT NULL DEFAULT '',
  `myid` char(30) NOT NULL DEFAULT '',
  `myidkey` char(16) NOT NULL DEFAULT '',
  `regip` char(15) NOT NULL DEFAULT '',
  `regdate` int(10) unsigned NOT NULL DEFAULT '0',
  `lastloginip` int(10) NOT NULL DEFAULT '0',
  `lastlogintime` int(10) unsigned NOT NULL DEFAULT '0',
  `salt` char(6) NOT NULL,
  `secques` char(8) NOT NULL DEFAULT '',
  PRIMARY KEY (`uid`),
  UNIQUE KEY `username` (`username`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `uc_members`
--

LOCK TABLES `uc_members` WRITE;
/*!40000 ALTER TABLE `uc_members` DISABLE KEYS */;
INSERT INTO `uc_members` VALUES (1,'admin','bcaff8234a815a8fffa465ffe3079c36','webmastor@yourdomain.com','','','127.0.0.1',1310993149,0,0,'d6ae03','');
/*!40000 ALTER TABLE `uc_members` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `uc_mergemembers`
--

DROP TABLE IF EXISTS `uc_mergemembers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `uc_mergemembers` (
  `appid` smallint(6) unsigned NOT NULL,
  `username` char(15) NOT NULL,
  PRIMARY KEY (`appid`,`username`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `uc_mergemembers`
--

LOCK TABLES `uc_mergemembers` WRITE;
/*!40000 ALTER TABLE `uc_mergemembers` DISABLE KEYS */;
/*!40000 ALTER TABLE `uc_mergemembers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `uc_newpm`
--

DROP TABLE IF EXISTS `uc_newpm`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `uc_newpm` (
  `uid` mediumint(8) unsigned NOT NULL,
  PRIMARY KEY (`uid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `uc_newpm`
--

LOCK TABLES `uc_newpm` WRITE;
/*!40000 ALTER TABLE `uc_newpm` DISABLE KEYS */;
/*!40000 ALTER TABLE `uc_newpm` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `uc_notelist`
--

DROP TABLE IF EXISTS `uc_notelist`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `uc_notelist` (
  `noteid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `operation` char(32) NOT NULL,
  `closed` tinyint(4) NOT NULL DEFAULT '0',
  `totalnum` smallint(6) unsigned NOT NULL DEFAULT '0',
  `succeednum` smallint(6) unsigned NOT NULL DEFAULT '0',
  `getdata` mediumtext NOT NULL,
  `postdata` mediumtext NOT NULL,
  `dateline` int(10) unsigned NOT NULL DEFAULT '0',
  `pri` tinyint(3) NOT NULL DEFAULT '0',
  `app1` tinyint(4) NOT NULL,
  `app2` tinyint(4) NOT NULL,
  PRIMARY KEY (`noteid`),
  KEY `closed` (`closed`,`pri`,`noteid`),
  KEY `dateline` (`dateline`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `uc_notelist`
--

LOCK TABLES `uc_notelist` WRITE;
/*!40000 ALTER TABLE `uc_notelist` DISABLE KEYS */;
INSERT INTO `uc_notelist` VALUES (1,'updateapps',1,0,0,'','<?xml version=\"1.0\" encoding=\"ISO-8859-1\"?>\r\n<root>\r\n	<item id=\"1\">\r\n		<item id=\"appid\"><![CDATA[1]]></item>\r\n		<item id=\"type\"><![CDATA[UCHOME]]></item>\r\n		<item id=\"name\"><![CDATA[個人家園]]></item>\r\n		<item id=\"url\"><![CDATA[http://127.0.0.1/upload/home]]></item>\r\n		<item id=\"ip\"><![CDATA[]]></item>\r\n		<item id=\"charset\"><![CDATA[utf-8]]></item>\r\n		<item id=\"synlogin\"><![CDATA[1]]></item>\r\n		<item id=\"extra\"><![CDATA[]]></item>\r\n	</item>\r\n	<item id=\"UC_API\"><![CDATA[http://127.0.0.1/upload/ucenter]]></item>\r\n</root>',0,0,0,0),(2,'updateapps',1,1,1,'','<?xml version=\"1.0\" encoding=\"ISO-8859-1\"?>\r\n<root>\r\n	<item id=\"1\">\r\n		<item id=\"appid\"><![CDATA[1]]></item>\r\n		<item id=\"type\"><![CDATA[UCHOME]]></item>\r\n		<item id=\"name\"><![CDATA[個人家園]]></item>\r\n		<item id=\"url\"><![CDATA[http://127.0.0.1/upload/home]]></item>\r\n		<item id=\"ip\"><![CDATA[]]></item>\r\n		<item id=\"charset\"><![CDATA[utf-8]]></item>\r\n		<item id=\"synlogin\"><![CDATA[1]]></item>\r\n		<item id=\"extra\"><![CDATA[]]></item>\r\n	</item>\r\n	<item id=\"2\">\r\n		<item id=\"appid\"><![CDATA[2]]></item>\r\n		<item id=\"type\"><![CDATA[DISCUZ]]></item>\r\n		<item id=\"name\"><![CDATA[Discuz!]]></item>\r\n		<item id=\"url\"><![CDATA[http://127.0.0.1/upload/bbs]]></item>\r\n		<item id=\"ip\"><![CDATA[]]></item>\r\n		<item id=\"charset\"><![CDATA[utf-8]]></item>\r\n		<item id=\"synlogin\"><![CDATA[1]]></item>\r\n		<item id=\"extra\"><![CDATA[]]></item>\r\n	</item>\r\n	<item id=\"UC_API\"><![CDATA[http://127.0.0.1/upload/ucenter]]></item>\r\n</root>',1310993149,0,1,0);
/*!40000 ALTER TABLE `uc_notelist` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `uc_pms`
--

DROP TABLE IF EXISTS `uc_pms`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `uc_pms` (
  `pmid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `msgfrom` varchar(15) NOT NULL DEFAULT '',
  `msgfromid` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `msgtoid` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `folder` enum('inbox','outbox') NOT NULL DEFAULT 'inbox',
  `new` tinyint(1) NOT NULL DEFAULT '0',
  `subject` varchar(75) NOT NULL DEFAULT '',
  `dateline` int(10) unsigned NOT NULL DEFAULT '0',
  `message` text NOT NULL,
  `delstatus` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `related` int(10) unsigned NOT NULL DEFAULT '0',
  `fromappid` smallint(6) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`pmid`),
  KEY `msgtoid` (`msgtoid`,`folder`,`dateline`),
  KEY `msgfromid` (`msgfromid`,`folder`,`dateline`),
  KEY `related` (`related`),
  KEY `getnum` (`msgtoid`,`folder`,`delstatus`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `uc_pms`
--

LOCK TABLES `uc_pms` WRITE;
/*!40000 ALTER TABLE `uc_pms` DISABLE KEYS */;
/*!40000 ALTER TABLE `uc_pms` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `uc_protectedmembers`
--

DROP TABLE IF EXISTS `uc_protectedmembers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `uc_protectedmembers` (
  `uid` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `username` char(15) NOT NULL DEFAULT '',
  `appid` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `dateline` int(10) unsigned NOT NULL DEFAULT '0',
  `admin` char(15) NOT NULL DEFAULT '0',
  UNIQUE KEY `username` (`username`,`appid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `uc_protectedmembers`
--

LOCK TABLES `uc_protectedmembers` WRITE;
/*!40000 ALTER TABLE `uc_protectedmembers` DISABLE KEYS */;
INSERT INTO `uc_protectedmembers` VALUES (1,'admin',1,1310993149,'admin'),(1,'admin',0,1310993149,'');
/*!40000 ALTER TABLE `uc_protectedmembers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `uc_settings`
--

DROP TABLE IF EXISTS `uc_settings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `uc_settings` (
  `k` varchar(32) NOT NULL DEFAULT '',
  `v` text NOT NULL,
  PRIMARY KEY (`k`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `uc_settings`
--

LOCK TABLES `uc_settings` WRITE;
/*!40000 ALTER TABLE `uc_settings` DISABLE KEYS */;
INSERT INTO `uc_settings` VALUES ('accessemail',''),('censoremail',''),('censorusername',''),('dateformat','y-n-j'),('doublee','1'),('nextnotetime','0'),('timeoffset','28800'),('pmlimit1day','100'),('pmfloodctrl','15'),('pmcenter','1'),('sendpmseccode','1'),('pmsendregdays','0'),('maildefault','username@21cn.com'),('mailsend','1'),('mailserver','smtp.21cn.com'),('mailport','25'),('mailauth','1'),('mailfrom','UCenter <username@21cn.com>'),('mailauth_username','username@21cn.com'),('mailauth_password','password'),('maildelimiter','0'),('mailusername','1'),('mailsilent','1'),('version','1.5.0');
/*!40000 ALTER TABLE `uc_settings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `uc_sqlcache`
--

DROP TABLE IF EXISTS `uc_sqlcache`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `uc_sqlcache` (
  `sqlid` char(6) NOT NULL DEFAULT '',
  `data` char(100) NOT NULL,
  `expiry` int(10) unsigned NOT NULL,
  PRIMARY KEY (`sqlid`),
  KEY `expiry` (`expiry`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `uc_sqlcache`
--

LOCK TABLES `uc_sqlcache` WRITE;
/*!40000 ALTER TABLE `uc_sqlcache` DISABLE KEYS */;
/*!40000 ALTER TABLE `uc_sqlcache` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `uc_tags`
--

DROP TABLE IF EXISTS `uc_tags`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `uc_tags` (
  `tagname` char(20) NOT NULL,
  `appid` smallint(6) unsigned NOT NULL DEFAULT '0',
  `data` mediumtext,
  `expiration` int(10) unsigned NOT NULL,
  KEY `tagname` (`tagname`,`appid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `uc_tags`
--

LOCK TABLES `uc_tags` WRITE;
/*!40000 ALTER TABLE `uc_tags` DISABLE KEYS */;
/*!40000 ALTER TABLE `uc_tags` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `uc_vars`
--

DROP TABLE IF EXISTS `uc_vars`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `uc_vars` (
  `name` char(32) NOT NULL DEFAULT '',
  `value` char(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`name`)
) ENGINE=MEMORY DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `uc_vars`
--

LOCK TABLES `uc_vars` WRITE;
/*!40000 ALTER TABLE `uc_vars` DISABLE KEYS */;
/*!40000 ALTER TABLE `uc_vars` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `uchome_ad`
--

DROP TABLE IF EXISTS `uchome_ad`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `uchome_ad` (
  `adid` smallint(6) unsigned NOT NULL AUTO_INCREMENT,
  `available` tinyint(1) NOT NULL DEFAULT '1',
  `title` varchar(50) NOT NULL DEFAULT '',
  `pagetype` varchar(20) NOT NULL DEFAULT '',
  `adcode` text NOT NULL,
  `system` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`adid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `uchome_ad`
--

LOCK TABLES `uchome_ad` WRITE;
/*!40000 ALTER TABLE `uchome_ad` DISABLE KEYS */;
/*!40000 ALTER TABLE `uchome_ad` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `uchome_adminsession`
--

DROP TABLE IF EXISTS `uchome_adminsession`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `uchome_adminsession` (
  `uid` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `ip` char(15) NOT NULL DEFAULT '',
  `dateline` int(10) unsigned NOT NULL DEFAULT '0',
  `errorcount` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`uid`)
) ENGINE=MEMORY DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `uchome_adminsession`
--

LOCK TABLES `uchome_adminsession` WRITE;
/*!40000 ALTER TABLE `uchome_adminsession` DISABLE KEYS */;
/*!40000 ALTER TABLE `uchome_adminsession` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `uchome_album`
--

DROP TABLE IF EXISTS `uchome_album`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `uchome_album` (
  `albumid` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `albumname` varchar(50) NOT NULL DEFAULT '',
  `uid` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `username` varchar(15) NOT NULL DEFAULT '',
  `dateline` int(10) unsigned NOT NULL DEFAULT '0',
  `updatetime` int(10) unsigned NOT NULL DEFAULT '0',
  `picnum` smallint(6) unsigned NOT NULL DEFAULT '0',
  `pic` varchar(60) NOT NULL DEFAULT '',
  `picflag` tinyint(1) NOT NULL DEFAULT '0',
  `friend` tinyint(1) NOT NULL DEFAULT '0',
  `password` varchar(10) NOT NULL DEFAULT '',
  `target_ids` text NOT NULL,
  PRIMARY KEY (`albumid`),
  KEY `uid` (`uid`,`updatetime`),
  KEY `updatetime` (`updatetime`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `uchome_album`
--

LOCK TABLES `uchome_album` WRITE;
/*!40000 ALTER TABLE `uchome_album` DISABLE KEYS */;
/*!40000 ALTER TABLE `uchome_album` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `uchome_appcreditlog`
--

DROP TABLE IF EXISTS `uchome_appcreditlog`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `uchome_appcreditlog` (
  `logid` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `uid` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `appid` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `appname` varchar(60) NOT NULL DEFAULT '',
  `type` tinyint(1) NOT NULL DEFAULT '0',
  `credit` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `note` text NOT NULL,
  `dateline` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`logid`),
  KEY `uid` (`uid`,`dateline`),
  KEY `appid` (`appid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `uchome_appcreditlog`
--

LOCK TABLES `uchome_appcreditlog` WRITE;
/*!40000 ALTER TABLE `uchome_appcreditlog` DISABLE KEYS */;
/*!40000 ALTER TABLE `uchome_appcreditlog` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `uchome_blacklist`
--

DROP TABLE IF EXISTS `uchome_blacklist`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `uchome_blacklist` (
  `uid` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `buid` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `dateline` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`uid`,`buid`),
  KEY `uid` (`uid`,`dateline`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `uchome_blacklist`
--

LOCK TABLES `uchome_blacklist` WRITE;
/*!40000 ALTER TABLE `uchome_blacklist` DISABLE KEYS */;
/*!40000 ALTER TABLE `uchome_blacklist` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `uchome_block`
--

DROP TABLE IF EXISTS `uchome_block`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `uchome_block` (
  `bid` smallint(6) unsigned NOT NULL AUTO_INCREMENT,
  `blockname` varchar(40) NOT NULL DEFAULT '',
  `blocksql` text NOT NULL,
  `cachename` varchar(30) NOT NULL DEFAULT '',
  `cachetime` smallint(6) unsigned NOT NULL DEFAULT '0',
  `startnum` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `num` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `perpage` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `htmlcode` text NOT NULL,
  PRIMARY KEY (`bid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `uchome_block`
--

LOCK TABLES `uchome_block` WRITE;
/*!40000 ALTER TABLE `uchome_block` DISABLE KEYS */;
/*!40000 ALTER TABLE `uchome_block` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `uchome_blog`
--

DROP TABLE IF EXISTS `uchome_blog`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `uchome_blog` (
  `blogid` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `topicid` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `uid` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `username` char(15) NOT NULL DEFAULT '',
  `subject` char(80) NOT NULL DEFAULT '',
  `classid` smallint(6) unsigned NOT NULL DEFAULT '0',
  `viewnum` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `replynum` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `hot` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `dateline` int(10) unsigned NOT NULL DEFAULT '0',
  `pic` char(120) NOT NULL DEFAULT '',
  `picflag` tinyint(1) NOT NULL DEFAULT '0',
  `noreply` tinyint(1) NOT NULL DEFAULT '0',
  `friend` tinyint(1) NOT NULL DEFAULT '0',
  `password` char(10) NOT NULL DEFAULT '',
  `click_1` smallint(6) unsigned NOT NULL DEFAULT '0',
  `click_2` smallint(6) unsigned NOT NULL DEFAULT '0',
  `click_3` smallint(6) unsigned NOT NULL DEFAULT '0',
  `click_4` smallint(6) unsigned NOT NULL DEFAULT '0',
  `click_5` smallint(6) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`blogid`),
  KEY `uid` (`uid`,`dateline`),
  KEY `topicid` (`topicid`,`dateline`),
  KEY `dateline` (`dateline`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `uchome_blog`
--

LOCK TABLES `uchome_blog` WRITE;
/*!40000 ALTER TABLE `uchome_blog` DISABLE KEYS */;
/*!40000 ALTER TABLE `uchome_blog` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `uchome_blogfield`
--

DROP TABLE IF EXISTS `uchome_blogfield`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `uchome_blogfield` (
  `blogid` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `uid` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `tag` varchar(255) NOT NULL DEFAULT '',
  `message` mediumtext NOT NULL,
  `postip` varchar(20) NOT NULL DEFAULT '',
  `related` text NOT NULL,
  `relatedtime` int(10) unsigned NOT NULL DEFAULT '0',
  `target_ids` text NOT NULL,
  `hotuser` text NOT NULL,
  `magiccolor` tinyint(6) NOT NULL DEFAULT '0',
  `magicpaper` tinyint(6) NOT NULL DEFAULT '0',
  `magiccall` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`blogid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `uchome_blogfield`
--

LOCK TABLES `uchome_blogfield` WRITE;
/*!40000 ALTER TABLE `uchome_blogfield` DISABLE KEYS */;
/*!40000 ALTER TABLE `uchome_blogfield` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `uchome_cache`
--

DROP TABLE IF EXISTS `uchome_cache`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `uchome_cache` (
  `cachekey` varchar(16) NOT NULL DEFAULT '',
  `value` mediumtext NOT NULL,
  `mtime` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`cachekey`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `uchome_cache`
--

LOCK TABLES `uchome_cache` WRITE;
/*!40000 ALTER TABLE `uchome_cache` DISABLE KEYS */;
/*!40000 ALTER TABLE `uchome_cache` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `uchome_class`
--

DROP TABLE IF EXISTS `uchome_class`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `uchome_class` (
  `classid` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `classname` char(40) NOT NULL DEFAULT '',
  `uid` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `dateline` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`classid`),
  KEY `uid` (`uid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `uchome_class`
--

LOCK TABLES `uchome_class` WRITE;
/*!40000 ALTER TABLE `uchome_class` DISABLE KEYS */;
/*!40000 ALTER TABLE `uchome_class` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `uchome_click`
--

DROP TABLE IF EXISTS `uchome_click`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `uchome_click` (
  `clickid` smallint(6) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL DEFAULT '',
  `icon` varchar(100) NOT NULL DEFAULT '',
  `idtype` varchar(15) NOT NULL DEFAULT '',
  `displayorder` tinyint(6) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`clickid`),
  KEY `idtype` (`idtype`,`displayorder`)
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `uchome_click`
--

LOCK TABLES `uchome_click` WRITE;
/*!40000 ALTER TABLE `uchome_click` DISABLE KEYS */;
INSERT INTO `uchome_click` VALUES (1,'路過','luguo.gif','blogid',0),(2,'雷人','leiren.gif','blogid',0),(3,'握手','woshou.gif','blogid',0),(4,'鮮花','xianhua.gif','blogid',0),(5,'雞蛋','jidan.gif','blogid',0),(6,'漂亮','piaoliang.gif','picid',0),(7,'酷斃','kubi.gif','picid',0),(8,'雷人','leiren.gif','picid',0),(9,'鮮花','xianhua.gif','picid',0),(10,'雞蛋','jidan.gif','picid',0),(11,'搞笑','gaoxiao.gif','tid',0),(12,'迷惑','mihuo.gif','tid',0),(13,'雷人','leiren.gif','tid',0),(14,'鮮花','xianhua.gif','tid',0),(15,'雞蛋','jidan.gif','tid',0);
/*!40000 ALTER TABLE `uchome_click` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `uchome_clickuser`
--

DROP TABLE IF EXISTS `uchome_clickuser`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `uchome_clickuser` (
  `uid` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `username` varchar(15) NOT NULL DEFAULT '',
  `id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `idtype` varchar(15) NOT NULL DEFAULT '',
  `clickid` smallint(6) unsigned NOT NULL DEFAULT '0',
  `dateline` int(10) unsigned NOT NULL DEFAULT '0',
  KEY `id` (`id`,`idtype`,`dateline`),
  KEY `uid` (`uid`,`idtype`,`dateline`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `uchome_clickuser`
--

LOCK TABLES `uchome_clickuser` WRITE;
/*!40000 ALTER TABLE `uchome_clickuser` DISABLE KEYS */;
/*!40000 ALTER TABLE `uchome_clickuser` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `uchome_comment`
--

DROP TABLE IF EXISTS `uchome_comment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `uchome_comment` (
  `cid` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `uid` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `idtype` varchar(20) NOT NULL DEFAULT '',
  `authorid` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `author` varchar(15) NOT NULL DEFAULT '',
  `ip` varchar(20) NOT NULL DEFAULT '',
  `dateline` int(10) unsigned NOT NULL DEFAULT '0',
  `message` text NOT NULL,
  `magicflicker` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`cid`),
  KEY `authorid` (`authorid`,`idtype`),
  KEY `id` (`id`,`idtype`,`dateline`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `uchome_comment`
--

LOCK TABLES `uchome_comment` WRITE;
/*!40000 ALTER TABLE `uchome_comment` DISABLE KEYS */;
/*!40000 ALTER TABLE `uchome_comment` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `uchome_config`
--

DROP TABLE IF EXISTS `uchome_config`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `uchome_config` (
  `var` varchar(30) NOT NULL DEFAULT '',
  `datavalue` text NOT NULL,
  PRIMARY KEY (`var`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `uchome_config`
--

LOCK TABLES `uchome_config` WRITE;
/*!40000 ALTER TABLE `uchome_config` DISABLE KEYS */;
INSERT INTO `uchome_config` VALUES ('sitename','我的空間'),('template','default'),('adminemail','webmaster@127.0.0.1'),('onlinehold','1800'),('timeoffset','8'),('maxpage','100'),('starcredit','100'),('starlevelnum','5'),('cachemode','database'),('cachegrade','0'),('allowcache','1'),('allowdomain','0'),('allowrewrite','0'),('allowwatermark','0'),('allowftp','0'),('holddomain','www|*blog*|*space*|x'),('mtagminnum','5'),('feedday','7'),('feedmaxnum','100'),('feedfilternum','10'),('importnum','100'),('maxreward','10'),('singlesent','50'),('groupnum','8'),('closeregister','0'),('closeinvite','0'),('close','0'),('networkpublic','1'),('networkpage','1'),('seccode_register','1'),('uc_tagrelated','1'),('manualmoderator','1'),('linkguide','1'),('showall','1'),('sendmailday','0'),('realname','0'),('namecheck','0'),('namechange','0'),('name_allowviewspace','1'),('name_allowfriend','1'),('name_allowpoke','1'),('name_allowdoing','1'),('name_allowblog','0'),('name_allowalbum','0'),('name_allowthread','0'),('name_allowshare','0'),('name_allowcomment','0'),('name_allowpost','0'),('showallfriendnum','10'),('feedtargetblank','1'),('feedread','1'),('feedhotnum','3'),('feedhotday','2'),('feedhotmin','3'),('feedhiddenicon','friend,profile,task,wall'),('uc_tagrelatedtime','86400'),('privacy','a:2:{s:4:\"view\";a:12:{s:5:\"index\";i:0;s:7:\"profile\";i:0;s:6:\"friend\";i:0;s:4:\"wall\";i:0;s:4:\"feed\";i:0;s:4:\"mtag\";i:0;s:5:\"event\";i:0;s:5:\"doing\";i:0;s:4:\"blog\";i:0;s:5:\"album\";i:0;s:5:\"share\";i:0;s:4:\"poll\";i:0;}s:4:\"feed\";a:21:{s:5:\"doing\";i:1;s:4:\"blog\";i:1;s:6:\"upload\";i:1;s:5:\"share\";i:1;s:4:\"poll\";i:1;s:8:\"joinpoll\";i:1;s:6:\"thread\";i:1;s:4:\"post\";i:1;s:4:\"mtag\";i:1;s:5:\"event\";i:1;s:4:\"join\";i:1;s:6:\"friend\";i:1;s:7:\"comment\";i:1;s:4:\"show\";i:1;s:9:\"spaceopen\";i:1;s:6:\"credit\";i:1;s:6:\"invite\";i:1;s:4:\"task\";i:1;s:7:\"profile\";i:1;s:5:\"album\";i:1;s:5:\"click\";i:1;}}'),('cronnextrun','1310993149'),('my_status','0'),('uniqueemail','1'),('updatestat','1'),('my_showgift','1'),('topcachetime','60'),('newspacenum','3');
/*!40000 ALTER TABLE `uchome_config` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `uchome_creditlog`
--

DROP TABLE IF EXISTS `uchome_creditlog`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `uchome_creditlog` (
  `clid` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `uid` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `rid` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `total` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `cyclenum` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `credit` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `experience` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `starttime` int(10) unsigned NOT NULL DEFAULT '0',
  `info` text NOT NULL,
  `user` text NOT NULL,
  `app` text NOT NULL,
  `dateline` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`clid`),
  KEY `uid` (`uid`,`rid`),
  KEY `dateline` (`dateline`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `uchome_creditlog`
--

LOCK TABLES `uchome_creditlog` WRITE;
/*!40000 ALTER TABLE `uchome_creditlog` DISABLE KEYS */;
INSERT INTO `uchome_creditlog` VALUES (1,1,1,1,1,10,0,0,'','','',1310993149),(2,1,10,1,1,15,15,0,'','','',1310993149);
/*!40000 ALTER TABLE `uchome_creditlog` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `uchome_creditrule`
--

DROP TABLE IF EXISTS `uchome_creditrule`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `uchome_creditrule` (
  `rid` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `rulename` char(20) NOT NULL DEFAULT '',
  `action` char(20) NOT NULL DEFAULT '',
  `cycletype` tinyint(1) NOT NULL DEFAULT '0',
  `cycletime` int(10) NOT NULL DEFAULT '0',
  `rewardnum` tinyint(2) NOT NULL DEFAULT '1',
  `rewardtype` tinyint(1) NOT NULL DEFAULT '1',
  `norepeat` tinyint(1) NOT NULL DEFAULT '0',
  `credit` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `experience` mediumint(8) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`rid`),
  KEY `action` (`action`)
) ENGINE=MyISAM AUTO_INCREMENT=48 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `uchome_creditrule`
--

LOCK TABLES `uchome_creditrule` WRITE;
/*!40000 ALTER TABLE `uchome_creditrule` DISABLE KEYS */;
INSERT INTO `uchome_creditrule` VALUES (1,'開通空間','register',0,0,1,1,0,10,0),(2,'實名認證','realname',0,0,1,1,0,20,20),(3,'郵箱認證','realemail',0,0,1,1,0,40,40),(4,'成功邀請好友','invitefriend',4,0,20,1,0,10,10),(5,'設置頭像','setavatar',0,0,1,1,0,15,15),(6,'視頻認證','videophoto',0,0,1,1,0,40,40),(7,'成功舉報','report',4,0,0,1,0,2,2),(8,'更新心情','updatemood',1,0,3,1,0,3,3),(9,'熱點信息','hotinfo',4,0,0,1,0,10,10),(10,'每天登陸','daylogin',1,0,1,1,0,15,15),(11,'訪問別人空間','visit',1,0,10,1,2,1,1),(12,'打招呼','poke',1,0,10,1,2,1,1),(13,'留言','guestbook',1,0,20,1,2,2,2),(14,'被留言','getguestbook',1,0,5,1,2,1,0),(15,'發表記錄','doing',1,0,5,1,0,1,1),(16,'發表日誌','publishblog',1,0,3,1,0,5,5),(17,'上傳圖片','uploadimage',1,0,10,1,0,2,2),(18,'拍大頭貼','camera',1,0,5,1,0,3,3),(19,'發表話題','publishthread',1,0,5,1,0,5,5),(20,'回復話題','replythread',1,0,10,1,1,1,1),(21,'創建投票','createpoll',1,0,5,1,0,2,2),(22,'參與投票','joinpoll',1,0,10,1,1,1,1),(23,'發起活動','createevent',1,0,1,1,0,3,3),(24,'參與活動','joinevent',1,0,1,1,1,1,1),(25,'推薦活動','recommendevent',4,0,0,1,0,10,10),(26,'發起分享','createshare',1,0,3,1,0,2,2),(27,'評論','comment',1,0,40,1,1,1,1),(28,'被評論','getcomment',1,0,20,1,1,1,0),(29,'安裝應用','installapp',4,0,0,1,3,5,5),(30,'使用應用','useapp',1,0,10,1,3,1,1),(31,'信息表態','click',1,0,10,1,1,1,1),(32,'修改實名','editrealname',0,0,1,0,0,5,0),(33,'更改郵箱認證','editrealemail',0,0,1,0,0,5,0),(34,'頭像被刪除','delavatar',0,0,1,0,0,10,10),(35,'獲取邀請碼','invitecode',0,0,1,0,0,0,0),(36,'搜索一次','search',0,0,1,0,0,1,0),(37,'日誌導入','blogimport',0,0,1,0,0,10,0),(38,'修改域名','modifydomain',0,0,1,0,0,5,0),(39,'日誌被刪除','delblog',0,0,1,0,0,10,10),(40,'記錄被刪除','deldoing',0,0,1,0,0,2,2),(41,'圖片被刪除','delimage',0,0,1,0,0,4,4),(42,'投票被刪除','delpoll',0,0,1,0,0,4,4),(43,'話題被刪除','delthread',0,0,1,0,0,4,4),(44,'活動被刪除','delevent',0,0,1,0,0,6,6),(45,'分享被刪除','delshare',0,0,1,0,0,4,4),(46,'留言被刪除','delguestbook',0,0,1,0,0,4,4),(47,'評論被刪除','delcomment',0,0,1,0,0,2,2);
/*!40000 ALTER TABLE `uchome_creditrule` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `uchome_cron`
--

DROP TABLE IF EXISTS `uchome_cron`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `uchome_cron` (
  `cronid` smallint(6) unsigned NOT NULL AUTO_INCREMENT,
  `available` tinyint(1) NOT NULL DEFAULT '0',
  `type` enum('user','system') NOT NULL DEFAULT 'user',
  `name` char(50) NOT NULL DEFAULT '',
  `filename` char(50) NOT NULL DEFAULT '',
  `lastrun` int(10) unsigned NOT NULL DEFAULT '0',
  `nextrun` int(10) unsigned NOT NULL DEFAULT '0',
  `weekday` tinyint(1) NOT NULL DEFAULT '0',
  `day` tinyint(2) NOT NULL DEFAULT '0',
  `hour` tinyint(2) NOT NULL DEFAULT '0',
  `minute` char(36) NOT NULL DEFAULT '',
  PRIMARY KEY (`cronid`),
  KEY `nextrun` (`available`,`nextrun`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `uchome_cron`
--

LOCK TABLES `uchome_cron` WRITE;
/*!40000 ALTER TABLE `uchome_cron` DISABLE KEYS */;
INSERT INTO `uchome_cron` VALUES (1,1,'system','更新瀏覽數統計','log.php',1310993149,1310993149,-1,-1,-1,'0	5	10	15	20	25	30	35	40	45	50	55'),(2,1,'system','清理過期feed','cleanfeed.php',1310993149,1310993149,-1,-1,3,'4'),(3,1,'system','清理個人通知','cleannotification.php',1310993149,1310993149,-1,-1,5,'6'),(4,1,'system','同步UC的feed','getfeed.php',1310993149,1310993149,-1,-1,-1,'2	7	12	17	22	27	32	37	42	47	52'),(5,1,'system','清理腳印和最新訪客','cleantrace.php',1310993149,1310993149,-1,-1,2,'3');
/*!40000 ALTER TABLE `uchome_cron` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `uchome_data`
--

DROP TABLE IF EXISTS `uchome_data`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `uchome_data` (
  `var` varchar(20) NOT NULL DEFAULT '',
  `datavalue` text NOT NULL,
  `dateline` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`var`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `uchome_data`
--

LOCK TABLES `uchome_data` WRITE;
/*!40000 ALTER TABLE `uchome_data` DISABLE KEYS */;
INSERT INTO `uchome_data` VALUES ('mail','a:3:{s:8:\"mailsend\";s:1:\"1\";s:13:\"maildelimiter\";s:1:\"0\";s:12:\"mailusername\";s:1:\"1\";}',1310993149),('setting','a:4:{s:10:\"thumbwidth\";s:3:\"100\";s:11:\"thumbheight\";s:3:\"100\";s:12:\"watermarkpos\";s:1:\"4\";s:14:\"watermarktrans\";s:2:\"75\";}',1310993149),('network','a:5:{s:4:\"blog\";a:2:{s:4:\"hot1\";s:1:\"3\";s:5:\"cache\";s:3:\"600\";}s:3:\"pic\";a:2:{s:4:\"hot1\";s:1:\"3\";s:5:\"cache\";s:3:\"700\";}s:6:\"thread\";a:2:{s:4:\"hot1\";s:1:\"3\";s:5:\"cache\";s:3:\"800\";}s:5:\"event\";a:1:{s:5:\"cache\";s:3:\"900\";}s:4:\"poll\";a:1:{s:5:\"cache\";s:3:\"500\";}}',1310993149),('newspacelist','a:1:{i:0;a:6:{s:3:\"uid\";s:1:\"1\";s:8:\"username\";s:5:\"admin\";s:4:\"name\";s:0:\"\";s:10:\"namestatus\";s:1:\"0\";s:11:\"videostatus\";s:1:\"0\";s:8:\"dateline\";s:10:\"1310993149\";}}',1310993149);
/*!40000 ALTER TABLE `uchome_data` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `uchome_docomment`
--

DROP TABLE IF EXISTS `uchome_docomment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `uchome_docomment` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `upid` int(10) unsigned NOT NULL DEFAULT '0',
  `doid` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `uid` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `username` varchar(15) NOT NULL DEFAULT '',
  `dateline` int(10) unsigned NOT NULL DEFAULT '0',
  `message` text NOT NULL,
  `ip` varchar(20) NOT NULL DEFAULT '',
  `grade` smallint(6) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `doid` (`doid`,`dateline`),
  KEY `dateline` (`dateline`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `uchome_docomment`
--

LOCK TABLES `uchome_docomment` WRITE;
/*!40000 ALTER TABLE `uchome_docomment` DISABLE KEYS */;
/*!40000 ALTER TABLE `uchome_docomment` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `uchome_doing`
--

DROP TABLE IF EXISTS `uchome_doing`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `uchome_doing` (
  `doid` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `uid` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `username` varchar(15) NOT NULL DEFAULT '',
  `from` varchar(20) NOT NULL DEFAULT '',
  `dateline` int(10) unsigned NOT NULL DEFAULT '0',
  `message` text NOT NULL,
  `ip` varchar(20) NOT NULL DEFAULT '',
  `replynum` int(10) unsigned NOT NULL DEFAULT '0',
  `mood` smallint(6) NOT NULL DEFAULT '0',
  PRIMARY KEY (`doid`),
  KEY `uid` (`uid`,`dateline`),
  KEY `dateline` (`dateline`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `uchome_doing`
--

LOCK TABLES `uchome_doing` WRITE;
/*!40000 ALTER TABLE `uchome_doing` DISABLE KEYS */;
/*!40000 ALTER TABLE `uchome_doing` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `uchome_event`
--

DROP TABLE IF EXISTS `uchome_event`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `uchome_event` (
  `eventid` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `topicid` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `uid` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `username` varchar(15) NOT NULL DEFAULT '',
  `dateline` int(10) unsigned NOT NULL DEFAULT '0',
  `title` varchar(80) NOT NULL DEFAULT '',
  `classid` smallint(6) unsigned NOT NULL DEFAULT '0',
  `province` varchar(20) NOT NULL DEFAULT '',
  `city` varchar(20) NOT NULL DEFAULT '',
  `location` varchar(80) NOT NULL DEFAULT '',
  `poster` varchar(60) NOT NULL DEFAULT '',
  `thumb` tinyint(1) NOT NULL DEFAULT '0',
  `remote` tinyint(1) NOT NULL DEFAULT '0',
  `deadline` int(10) unsigned NOT NULL DEFAULT '0',
  `starttime` int(10) unsigned NOT NULL DEFAULT '0',
  `endtime` int(10) unsigned NOT NULL DEFAULT '0',
  `public` tinyint(3) NOT NULL DEFAULT '0',
  `membernum` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `follownum` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `viewnum` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `grade` tinyint(3) NOT NULL DEFAULT '0',
  `recommendtime` int(10) unsigned NOT NULL DEFAULT '0',
  `tagid` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `picnum` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `threadnum` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `updatetime` int(10) unsigned NOT NULL DEFAULT '0',
  `hot` mediumint(8) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`eventid`),
  KEY `grade` (`grade`,`recommendtime`),
  KEY `membernum` (`membernum`),
  KEY `uid` (`uid`,`eventid`),
  KEY `tagid` (`tagid`,`eventid`),
  KEY `topicid` (`topicid`,`dateline`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `uchome_event`
--

LOCK TABLES `uchome_event` WRITE;
/*!40000 ALTER TABLE `uchome_event` DISABLE KEYS */;
/*!40000 ALTER TABLE `uchome_event` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `uchome_eventclass`
--

DROP TABLE IF EXISTS `uchome_eventclass`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `uchome_eventclass` (
  `classid` smallint(6) unsigned NOT NULL AUTO_INCREMENT,
  `classname` varchar(80) NOT NULL DEFAULT '',
  `poster` tinyint(1) NOT NULL DEFAULT '0',
  `template` text NOT NULL,
  `displayorder` mediumint(8) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`classid`),
  UNIQUE KEY `classname` (`classname`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `uchome_eventclass`
--

LOCK TABLES `uchome_eventclass` WRITE;
/*!40000 ALTER TABLE `uchome_eventclass` DISABLE KEYS */;
INSERT INTO `uchome_eventclass` VALUES (1,'生活/聚會',0,'費用說明：\r\n集合地點：\r\n著裝要求：\r\n聯繫方式：\r\n注意事項：',1),(2,'出行/旅遊',0,'路線說明:\r\n費用說明:\r\n裝備要求:\r\n交通工具:\r\n集合地點:\r\n聯繫方式:\r\n注意事項:',2),(3,'比賽/運動',0,'費用說明：\r\n集合地點：\r\n著裝要求：\r\n場地介紹：\r\n聯繫方式：\r\n注意事項：',4),(4,'電影/演出',0,'劇情介紹：\r\n費用說明：\r\n集合地點：\r\n聯繫方式：\r\n注意事項：',3),(5,'教育/講座',0,'主辦單位：\r\n活動主題：\r\n費用說明：\r\n集合地點：\r\n聯繫方式：\r\n注意事項：',5),(6,'其它',0,'',6);
/*!40000 ALTER TABLE `uchome_eventclass` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `uchome_eventfield`
--

DROP TABLE IF EXISTS `uchome_eventfield`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `uchome_eventfield` (
  `eventid` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `detail` text NOT NULL,
  `template` varchar(255) NOT NULL DEFAULT '',
  `limitnum` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `verify` tinyint(1) NOT NULL DEFAULT '0',
  `allowpic` tinyint(1) NOT NULL DEFAULT '0',
  `allowpost` tinyint(1) NOT NULL DEFAULT '0',
  `allowinvite` tinyint(1) NOT NULL DEFAULT '0',
  `allowfellow` tinyint(1) NOT NULL DEFAULT '0',
  `hotuser` text NOT NULL,
  PRIMARY KEY (`eventid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `uchome_eventfield`
--

LOCK TABLES `uchome_eventfield` WRITE;
/*!40000 ALTER TABLE `uchome_eventfield` DISABLE KEYS */;
/*!40000 ALTER TABLE `uchome_eventfield` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `uchome_eventinvite`
--

DROP TABLE IF EXISTS `uchome_eventinvite`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `uchome_eventinvite` (
  `eventid` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `uid` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `username` varchar(15) NOT NULL DEFAULT '',
  `touid` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `tousername` char(15) NOT NULL DEFAULT '',
  `dateline` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`eventid`,`touid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `uchome_eventinvite`
--

LOCK TABLES `uchome_eventinvite` WRITE;
/*!40000 ALTER TABLE `uchome_eventinvite` DISABLE KEYS */;
/*!40000 ALTER TABLE `uchome_eventinvite` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `uchome_eventpic`
--

DROP TABLE IF EXISTS `uchome_eventpic`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `uchome_eventpic` (
  `picid` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `eventid` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `uid` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `username` char(15) NOT NULL DEFAULT '',
  `dateline` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`picid`),
  KEY `eventid` (`eventid`,`picid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `uchome_eventpic`
--

LOCK TABLES `uchome_eventpic` WRITE;
/*!40000 ALTER TABLE `uchome_eventpic` DISABLE KEYS */;
/*!40000 ALTER TABLE `uchome_eventpic` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `uchome_feed`
--

DROP TABLE IF EXISTS `uchome_feed`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `uchome_feed` (
  `feedid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `appid` smallint(6) unsigned NOT NULL DEFAULT '0',
  `icon` varchar(30) NOT NULL DEFAULT '',
  `uid` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `username` varchar(15) NOT NULL DEFAULT '',
  `dateline` int(10) unsigned NOT NULL DEFAULT '0',
  `friend` tinyint(1) NOT NULL DEFAULT '0',
  `hash_template` varchar(32) NOT NULL DEFAULT '',
  `hash_data` varchar(32) NOT NULL DEFAULT '',
  `title_template` text NOT NULL,
  `title_data` text NOT NULL,
  `body_template` text NOT NULL,
  `body_data` text NOT NULL,
  `body_general` text NOT NULL,
  `image_1` varchar(255) NOT NULL DEFAULT '',
  `image_1_link` varchar(255) NOT NULL DEFAULT '',
  `image_2` varchar(255) NOT NULL DEFAULT '',
  `image_2_link` varchar(255) NOT NULL DEFAULT '',
  `image_3` varchar(255) NOT NULL DEFAULT '',
  `image_3_link` varchar(255) NOT NULL DEFAULT '',
  `image_4` varchar(255) NOT NULL DEFAULT '',
  `image_4_link` varchar(255) NOT NULL DEFAULT '',
  `target_ids` text NOT NULL,
  `id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `idtype` varchar(15) NOT NULL DEFAULT '',
  `hot` mediumint(8) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`feedid`),
  KEY `uid` (`uid`,`dateline`),
  KEY `dateline` (`dateline`),
  KEY `hot` (`hot`),
  KEY `id` (`id`,`idtype`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `uchome_feed`
--

LOCK TABLES `uchome_feed` WRITE;
/*!40000 ALTER TABLE `uchome_feed` DISABLE KEYS */;
INSERT INTO `uchome_feed` VALUES (1,1,'profile',1,'admin',1310993149,0,'b06c13ad3346d55dccfa3c9f614fa624','2e4c5967b222c0fa0c5c932eb7948aab','{actor} 開通了自己的個人主頁','a:0:{}','','a:0:{}','','','','','','','','','','',0,'',0);
/*!40000 ALTER TABLE `uchome_feed` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `uchome_friend`
--

DROP TABLE IF EXISTS `uchome_friend`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `uchome_friend` (
  `uid` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `fuid` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `fusername` varchar(15) NOT NULL DEFAULT '',
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `gid` smallint(6) unsigned NOT NULL DEFAULT '0',
  `note` varchar(50) NOT NULL DEFAULT '',
  `num` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `dateline` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`uid`,`fuid`),
  KEY `fuid` (`fuid`),
  KEY `status` (`uid`,`status`,`num`,`dateline`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `uchome_friend`
--

LOCK TABLES `uchome_friend` WRITE;
/*!40000 ALTER TABLE `uchome_friend` DISABLE KEYS */;
/*!40000 ALTER TABLE `uchome_friend` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `uchome_friendguide`
--

DROP TABLE IF EXISTS `uchome_friendguide`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `uchome_friendguide` (
  `uid` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `fuid` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `fusername` char(15) NOT NULL DEFAULT '',
  `num` smallint(6) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`uid`,`fuid`),
  KEY `uid` (`uid`,`num`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `uchome_friendguide`
--

LOCK TABLES `uchome_friendguide` WRITE;
/*!40000 ALTER TABLE `uchome_friendguide` DISABLE KEYS */;
/*!40000 ALTER TABLE `uchome_friendguide` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `uchome_friendlog`
--

DROP TABLE IF EXISTS `uchome_friendlog`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `uchome_friendlog` (
  `uid` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `fuid` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `action` varchar(10) NOT NULL DEFAULT '',
  `dateline` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`uid`,`fuid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `uchome_friendlog`
--

LOCK TABLES `uchome_friendlog` WRITE;
/*!40000 ALTER TABLE `uchome_friendlog` DISABLE KEYS */;
/*!40000 ALTER TABLE `uchome_friendlog` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `uchome_invite`
--

DROP TABLE IF EXISTS `uchome_invite`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `uchome_invite` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `uid` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `code` varchar(20) NOT NULL DEFAULT '',
  `fuid` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `fusername` varchar(15) NOT NULL DEFAULT '',
  `type` tinyint(1) NOT NULL DEFAULT '0',
  `email` varchar(100) NOT NULL DEFAULT '',
  `appid` mediumint(8) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `uid` (`uid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `uchome_invite`
--

LOCK TABLES `uchome_invite` WRITE;
/*!40000 ALTER TABLE `uchome_invite` DISABLE KEYS */;
/*!40000 ALTER TABLE `uchome_invite` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `uchome_log`
--

DROP TABLE IF EXISTS `uchome_log`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `uchome_log` (
  `logid` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `idtype` char(20) NOT NULL DEFAULT '',
  PRIMARY KEY (`logid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `uchome_log`
--

LOCK TABLES `uchome_log` WRITE;
/*!40000 ALTER TABLE `uchome_log` DISABLE KEYS */;
/*!40000 ALTER TABLE `uchome_log` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `uchome_magic`
--

DROP TABLE IF EXISTS `uchome_magic`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `uchome_magic` (
  `mid` varchar(15) NOT NULL DEFAULT '',
  `name` varchar(30) NOT NULL DEFAULT '',
  `description` text NOT NULL,
  `forbiddengid` text NOT NULL,
  `charge` smallint(6) unsigned NOT NULL DEFAULT '0',
  `experience` smallint(6) unsigned NOT NULL DEFAULT '0',
  `provideperoid` int(10) unsigned NOT NULL DEFAULT '0',
  `providecount` smallint(6) unsigned NOT NULL DEFAULT '0',
  `useperoid` int(10) unsigned NOT NULL DEFAULT '0',
  `usecount` smallint(6) unsigned NOT NULL DEFAULT '0',
  `displayorder` smallint(6) unsigned NOT NULL DEFAULT '0',
  `custom` text NOT NULL,
  `close` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`mid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `uchome_magic`
--

LOCK TABLES `uchome_magic` WRITE;
/*!40000 ALTER TABLE `uchome_magic` DISABLE KEYS */;
INSERT INTO `uchome_magic` VALUES ('invisible','隱身草','讓自己隱身登錄，不顯示在線，24小時內有效','',50,5,86400,10,86400,1,0,'',0),('friendnum','好友增容卡','在允許添加的最多好友數限制外，增加10個好友名額','',30,3,86400,999,0,1,0,'',0),('attachsize','附件增容卡','使用一次，可以給自己增加 10M 的附件空間','',30,3,86400,999,0,1,0,'',0),('thunder','雷鳴之聲','發佈一條全站信息，讓大家知道自己上線了','',500,5,86400,5,86400,1,0,'',0),('updateline','救生圈','把指定對象的發佈時間更新為當前時間','',200,5,86400,999,0,1,0,'',0),('downdateline','時空機','把指定對象的發佈時間修改為過去的時間','',250,5,86400,999,0,1,0,'',0),('color','彩色燈','把指定對象的標題變成彩色的','',50,5,86400,999,0,1,0,'',0),('hot','熱點燈','把指定對象的熱度增加站點推薦的熱點值','',50,5,86400,999,0,1,0,'',0),('visit','互訪卡','隨機選擇10個好友，向其打招呼、留言或訪問空間','',20,2,86400,999,0,1,0,'',0),('icon','彩虹蛋','給指定對象的標題前面增加圖標（最多8個圖標）','',20,2,86400,999,0,1,0,'',0),('flicker','彩虹炫','讓評論、留言的文字閃爍起來','',30,3,86400,999,0,1,0,'',0),('gift','紅包卡','在自己的空間埋下積分紅包送給來訪者','',20,2,86400,999,0,1,0,'',0),('superstar','超級明星','在個人主頁，給自己的頭像增加超級明星標識','',30,3,86400,999,0,1,0,'',0),('viewmagiclog','八卦鏡','查看指定用戶最近使用的道具記錄','',100,5,86400,999,0,1,0,'',0),('viewmagic','透視鏡','查看指定用戶當前持有的道具','',100,5,86400,999,0,1,0,'',0),('viewvisitor','偷窺鏡','查看指定用戶最近訪問過的10個空間','',100,5,86400,999,0,1,0,'',0),('call','點名卡','發通知給自己的好友，讓他們來查看指定的對象','',50,5,86400,999,0,1,0,'',0),('coupon','代金券','購買道具時折換一定量的積分','',0,0,0,0,0,1,0,'',0),('frame','相框','給自己的照片添上相框','',30,3,86400,999,0,1,0,'',0),('bgimage','信紙','給指定的對象添加信紙背景','',30,3,86400,999,0,1,0,'',0),('doodle','塗鴉板','允許在留言、評論等操作時使用塗鴉板','',30,3,86400,999,0,1,0,'',0),('anonymous','匿名卡','在指定的地方，讓自己的名字顯示為匿名','',50,5,86400,999,0,1,0,'',0),('reveal','照妖鏡','可以查看一次匿名用戶的真實身份','',100,5,86400,999,0,1,0,'',0),('license','道具轉讓許可證','使用許可證，將道具贈送給指定好友','',10,1,3600,999,0,1,0,'',0),('detector','探測器','探測埋了紅包的空間','',10,1,86400,999,0,1,0,'',0);
/*!40000 ALTER TABLE `uchome_magic` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `uchome_magicinlog`
--

DROP TABLE IF EXISTS `uchome_magicinlog`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `uchome_magicinlog` (
  `logid` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `uid` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `username` varchar(15) NOT NULL DEFAULT '',
  `mid` varchar(15) NOT NULL DEFAULT '',
  `count` smallint(6) unsigned NOT NULL DEFAULT '0',
  `type` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `fromid` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `credit` smallint(6) unsigned NOT NULL DEFAULT '0',
  `dateline` int(10) NOT NULL DEFAULT '0',
  PRIMARY KEY (`logid`),
  KEY `uid` (`uid`,`dateline`),
  KEY `type` (`type`,`fromid`,`dateline`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `uchome_magicinlog`
--

LOCK TABLES `uchome_magicinlog` WRITE;
/*!40000 ALTER TABLE `uchome_magicinlog` DISABLE KEYS */;
/*!40000 ALTER TABLE `uchome_magicinlog` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `uchome_magicstore`
--

DROP TABLE IF EXISTS `uchome_magicstore`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `uchome_magicstore` (
  `mid` varchar(15) NOT NULL DEFAULT '',
  `storage` smallint(6) unsigned NOT NULL DEFAULT '0',
  `lastprovide` int(10) unsigned NOT NULL DEFAULT '0',
  `sellcount` int(8) unsigned NOT NULL DEFAULT '0',
  `sellcredit` int(8) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`mid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `uchome_magicstore`
--

LOCK TABLES `uchome_magicstore` WRITE;
/*!40000 ALTER TABLE `uchome_magicstore` DISABLE KEYS */;
/*!40000 ALTER TABLE `uchome_magicstore` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `uchome_magicuselog`
--

DROP TABLE IF EXISTS `uchome_magicuselog`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `uchome_magicuselog` (
  `logid` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `uid` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `username` varchar(15) NOT NULL DEFAULT '',
  `mid` varchar(15) NOT NULL DEFAULT '',
  `id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `idtype` varchar(20) NOT NULL DEFAULT '',
  `count` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `data` text NOT NULL,
  `dateline` int(10) unsigned NOT NULL DEFAULT '0',
  `expire` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`logid`),
  KEY `uid` (`uid`,`mid`),
  KEY `id` (`id`,`idtype`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `uchome_magicuselog`
--

LOCK TABLES `uchome_magicuselog` WRITE;
/*!40000 ALTER TABLE `uchome_magicuselog` DISABLE KEYS */;
/*!40000 ALTER TABLE `uchome_magicuselog` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `uchome_mailcron`
--

DROP TABLE IF EXISTS `uchome_mailcron`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `uchome_mailcron` (
  `cid` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `touid` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `email` varchar(100) NOT NULL DEFAULT '',
  `sendtime` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`cid`),
  KEY `sendtime` (`sendtime`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `uchome_mailcron`
--

LOCK TABLES `uchome_mailcron` WRITE;
/*!40000 ALTER TABLE `uchome_mailcron` DISABLE KEYS */;
/*!40000 ALTER TABLE `uchome_mailcron` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `uchome_mailqueue`
--

DROP TABLE IF EXISTS `uchome_mailqueue`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `uchome_mailqueue` (
  `qid` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `cid` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `subject` text NOT NULL,
  `message` text NOT NULL,
  `dateline` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`qid`),
  KEY `mcid` (`cid`,`dateline`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `uchome_mailqueue`
--

LOCK TABLES `uchome_mailqueue` WRITE;
/*!40000 ALTER TABLE `uchome_mailqueue` DISABLE KEYS */;
/*!40000 ALTER TABLE `uchome_mailqueue` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `uchome_member`
--

DROP TABLE IF EXISTS `uchome_member`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `uchome_member` (
  `uid` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `username` char(15) NOT NULL DEFAULT '',
  `password` char(32) NOT NULL DEFAULT '',
  PRIMARY KEY (`uid`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `uchome_member`
--

LOCK TABLES `uchome_member` WRITE;
/*!40000 ALTER TABLE `uchome_member` DISABLE KEYS */;
INSERT INTO `uchome_member` VALUES (1,'admin','acf7d2ddaac98f6f6a6d4a59884027bf');
/*!40000 ALTER TABLE `uchome_member` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `uchome_mtag`
--

DROP TABLE IF EXISTS `uchome_mtag`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `uchome_mtag` (
  `tagid` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `tagname` varchar(40) NOT NULL DEFAULT '',
  `fieldid` smallint(6) NOT NULL DEFAULT '0',
  `membernum` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `threadnum` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `postnum` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `close` tinyint(1) NOT NULL DEFAULT '0',
  `announcement` text NOT NULL,
  `pic` varchar(150) NOT NULL DEFAULT '',
  `closeapply` tinyint(1) NOT NULL DEFAULT '0',
  `joinperm` tinyint(1) NOT NULL DEFAULT '0',
  `viewperm` tinyint(1) NOT NULL DEFAULT '0',
  `threadperm` tinyint(1) NOT NULL DEFAULT '0',
  `postperm` tinyint(1) NOT NULL DEFAULT '0',
  `recommend` tinyint(1) NOT NULL DEFAULT '0',
  `moderator` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`tagid`),
  KEY `tagname` (`tagname`),
  KEY `threadnum` (`threadnum`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `uchome_mtag`
--

LOCK TABLES `uchome_mtag` WRITE;
/*!40000 ALTER TABLE `uchome_mtag` DISABLE KEYS */;
/*!40000 ALTER TABLE `uchome_mtag` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `uchome_mtaginvite`
--

DROP TABLE IF EXISTS `uchome_mtaginvite`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `uchome_mtaginvite` (
  `uid` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `tagid` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `fromuid` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `fromusername` char(15) NOT NULL DEFAULT '',
  `dateline` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`uid`,`tagid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `uchome_mtaginvite`
--

LOCK TABLES `uchome_mtaginvite` WRITE;
/*!40000 ALTER TABLE `uchome_mtaginvite` DISABLE KEYS */;
/*!40000 ALTER TABLE `uchome_mtaginvite` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `uchome_myapp`
--

DROP TABLE IF EXISTS `uchome_myapp`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `uchome_myapp` (
  `appid` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `appname` varchar(60) NOT NULL DEFAULT '',
  `narrow` tinyint(1) NOT NULL DEFAULT '0',
  `flag` tinyint(1) NOT NULL DEFAULT '0',
  `version` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `displaymethod` tinyint(1) NOT NULL DEFAULT '0',
  `displayorder` smallint(6) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`appid`),
  KEY `flag` (`flag`,`displayorder`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `uchome_myapp`
--

LOCK TABLES `uchome_myapp` WRITE;
/*!40000 ALTER TABLE `uchome_myapp` DISABLE KEYS */;
/*!40000 ALTER TABLE `uchome_myapp` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `uchome_myinvite`
--

DROP TABLE IF EXISTS `uchome_myinvite`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `uchome_myinvite` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `typename` varchar(100) NOT NULL DEFAULT '',
  `appid` mediumint(8) NOT NULL DEFAULT '0',
  `type` tinyint(1) NOT NULL DEFAULT '0',
  `fromuid` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `touid` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `myml` text NOT NULL,
  `dateline` int(10) unsigned NOT NULL DEFAULT '0',
  `hash` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `hash` (`hash`),
  KEY `uid` (`touid`,`dateline`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `uchome_myinvite`
--

LOCK TABLES `uchome_myinvite` WRITE;
/*!40000 ALTER TABLE `uchome_myinvite` DISABLE KEYS */;
/*!40000 ALTER TABLE `uchome_myinvite` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `uchome_notification`
--

DROP TABLE IF EXISTS `uchome_notification`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `uchome_notification` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `uid` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `type` varchar(20) NOT NULL DEFAULT '',
  `new` tinyint(1) NOT NULL DEFAULT '0',
  `authorid` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `author` varchar(15) NOT NULL DEFAULT '',
  `note` text NOT NULL,
  `dateline` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `uid` (`uid`,`new`,`dateline`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `uchome_notification`
--

LOCK TABLES `uchome_notification` WRITE;
/*!40000 ALTER TABLE `uchome_notification` DISABLE KEYS */;
/*!40000 ALTER TABLE `uchome_notification` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `uchome_pic`
--

DROP TABLE IF EXISTS `uchome_pic`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `uchome_pic` (
  `picid` mediumint(8) NOT NULL AUTO_INCREMENT,
  `albumid` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `topicid` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `uid` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `username` varchar(15) NOT NULL DEFAULT '',
  `dateline` int(10) unsigned NOT NULL DEFAULT '0',
  `postip` varchar(20) NOT NULL DEFAULT '',
  `filename` varchar(100) NOT NULL DEFAULT '',
  `title` varchar(255) NOT NULL DEFAULT '',
  `type` varchar(20) NOT NULL DEFAULT '',
  `size` int(10) unsigned NOT NULL DEFAULT '0',
  `filepath` varchar(60) NOT NULL DEFAULT '',
  `thumb` tinyint(1) NOT NULL DEFAULT '0',
  `remote` tinyint(1) NOT NULL DEFAULT '0',
  `hot` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `click_6` smallint(6) unsigned NOT NULL DEFAULT '0',
  `click_7` smallint(6) unsigned NOT NULL DEFAULT '0',
  `click_8` smallint(6) unsigned NOT NULL DEFAULT '0',
  `click_9` smallint(6) unsigned NOT NULL DEFAULT '0',
  `click_10` smallint(6) unsigned NOT NULL DEFAULT '0',
  `magicframe` tinyint(6) NOT NULL DEFAULT '0',
  PRIMARY KEY (`picid`),
  KEY `albumid` (`albumid`,`dateline`),
  KEY `topicid` (`topicid`,`dateline`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `uchome_pic`
--

LOCK TABLES `uchome_pic` WRITE;
/*!40000 ALTER TABLE `uchome_pic` DISABLE KEYS */;
/*!40000 ALTER TABLE `uchome_pic` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `uchome_picfield`
--

DROP TABLE IF EXISTS `uchome_picfield`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `uchome_picfield` (
  `picid` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `hotuser` text NOT NULL,
  PRIMARY KEY (`picid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `uchome_picfield`
--

LOCK TABLES `uchome_picfield` WRITE;
/*!40000 ALTER TABLE `uchome_picfield` DISABLE KEYS */;
/*!40000 ALTER TABLE `uchome_picfield` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `uchome_poke`
--

DROP TABLE IF EXISTS `uchome_poke`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `uchome_poke` (
  `uid` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `fromuid` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `fromusername` varchar(15) NOT NULL DEFAULT '',
  `note` varchar(255) NOT NULL DEFAULT '',
  `dateline` int(10) unsigned NOT NULL DEFAULT '0',
  `iconid` smallint(6) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`uid`,`fromuid`),
  KEY `uid` (`uid`,`dateline`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `uchome_poke`
--

LOCK TABLES `uchome_poke` WRITE;
/*!40000 ALTER TABLE `uchome_poke` DISABLE KEYS */;
/*!40000 ALTER TABLE `uchome_poke` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `uchome_poll`
--

DROP TABLE IF EXISTS `uchome_poll`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `uchome_poll` (
  `pid` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `topicid` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `uid` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `username` char(15) NOT NULL DEFAULT '',
  `subject` char(80) NOT NULL DEFAULT '',
  `voternum` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `replynum` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `multiple` tinyint(1) NOT NULL DEFAULT '0',
  `maxchoice` tinyint(3) NOT NULL DEFAULT '0',
  `sex` tinyint(1) NOT NULL DEFAULT '0',
  `noreply` tinyint(1) NOT NULL DEFAULT '0',
  `credit` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `percredit` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `expiration` int(10) unsigned NOT NULL DEFAULT '0',
  `lastvote` int(10) unsigned NOT NULL DEFAULT '0',
  `dateline` int(10) unsigned NOT NULL DEFAULT '0',
  `hot` mediumint(8) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`pid`),
  KEY `uid` (`uid`,`dateline`),
  KEY `topicid` (`topicid`,`dateline`),
  KEY `voternum` (`voternum`),
  KEY `dateline` (`dateline`),
  KEY `lastvote` (`lastvote`),
  KEY `hot` (`hot`),
  KEY `percredit` (`percredit`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `uchome_poll`
--

LOCK TABLES `uchome_poll` WRITE;
/*!40000 ALTER TABLE `uchome_poll` DISABLE KEYS */;
/*!40000 ALTER TABLE `uchome_poll` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `uchome_pollfield`
--

DROP TABLE IF EXISTS `uchome_pollfield`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `uchome_pollfield` (
  `pid` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `notify` tinyint(1) NOT NULL DEFAULT '0',
  `message` text NOT NULL,
  `summary` text NOT NULL,
  `option` text NOT NULL,
  `invite` text NOT NULL,
  `hotuser` text NOT NULL,
  PRIMARY KEY (`pid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `uchome_pollfield`
--

LOCK TABLES `uchome_pollfield` WRITE;
/*!40000 ALTER TABLE `uchome_pollfield` DISABLE KEYS */;
/*!40000 ALTER TABLE `uchome_pollfield` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `uchome_polloption`
--

DROP TABLE IF EXISTS `uchome_polloption`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `uchome_polloption` (
  `oid` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `pid` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `votenum` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `option` varchar(100) NOT NULL DEFAULT '',
  PRIMARY KEY (`oid`),
  KEY `pid` (`pid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `uchome_polloption`
--

LOCK TABLES `uchome_polloption` WRITE;
/*!40000 ALTER TABLE `uchome_polloption` DISABLE KEYS */;
/*!40000 ALTER TABLE `uchome_polloption` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `uchome_polluser`
--

DROP TABLE IF EXISTS `uchome_polluser`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `uchome_polluser` (
  `uid` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `username` varchar(15) NOT NULL DEFAULT '',
  `pid` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `option` text NOT NULL,
  `dateline` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`uid`,`pid`),
  KEY `pid` (`pid`,`dateline`),
  KEY `uid` (`uid`,`dateline`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `uchome_polluser`
--

LOCK TABLES `uchome_polluser` WRITE;
/*!40000 ALTER TABLE `uchome_polluser` DISABLE KEYS */;
/*!40000 ALTER TABLE `uchome_polluser` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `uchome_post`
--

DROP TABLE IF EXISTS `uchome_post`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `uchome_post` (
  `pid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `tagid` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `tid` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `uid` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `username` varchar(15) NOT NULL DEFAULT '',
  `ip` varchar(20) NOT NULL DEFAULT '',
  `dateline` int(10) unsigned NOT NULL DEFAULT '0',
  `message` text NOT NULL,
  `pic` varchar(255) NOT NULL DEFAULT '',
  `isthread` tinyint(1) NOT NULL DEFAULT '0',
  `hotuser` text NOT NULL,
  PRIMARY KEY (`pid`),
  KEY `tid` (`tid`,`dateline`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `uchome_post`
--

LOCK TABLES `uchome_post` WRITE;
/*!40000 ALTER TABLE `uchome_post` DISABLE KEYS */;
/*!40000 ALTER TABLE `uchome_post` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `uchome_profield`
--

DROP TABLE IF EXISTS `uchome_profield`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `uchome_profield` (
  `fieldid` smallint(6) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(80) NOT NULL DEFAULT '',
  `note` varchar(255) NOT NULL DEFAULT '',
  `formtype` varchar(20) NOT NULL DEFAULT '0',
  `inputnum` smallint(3) unsigned NOT NULL DEFAULT '0',
  `choice` text NOT NULL,
  `mtagminnum` smallint(6) unsigned NOT NULL DEFAULT '0',
  `manualmoderator` tinyint(1) NOT NULL DEFAULT '0',
  `manualmember` tinyint(1) NOT NULL DEFAULT '0',
  `displayorder` tinyint(3) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`fieldid`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `uchome_profield`
--

LOCK TABLES `uchome_profield` WRITE;
/*!40000 ALTER TABLE `uchome_profield` DISABLE KEYS */;
INSERT INTO `uchome_profield` VALUES (1,'自由聯盟','','text',100,'',0,0,1,0),(2,'地區聯盟','','text',100,'',0,0,1,0),(3,'興趣聯盟','','text',100,'',0,0,1,0);
/*!40000 ALTER TABLE `uchome_profield` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `uchome_profilefield`
--

DROP TABLE IF EXISTS `uchome_profilefield`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `uchome_profilefield` (
  `fieldid` smallint(6) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(80) NOT NULL DEFAULT '',
  `note` varchar(255) NOT NULL DEFAULT '',
  `formtype` varchar(20) NOT NULL DEFAULT '0',
  `maxsize` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `required` tinyint(1) NOT NULL DEFAULT '0',
  `invisible` tinyint(1) NOT NULL DEFAULT '0',
  `allowsearch` tinyint(1) NOT NULL DEFAULT '0',
  `choice` text NOT NULL,
  `displayorder` tinyint(3) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`fieldid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `uchome_profilefield`
--

LOCK TABLES `uchome_profilefield` WRITE;
/*!40000 ALTER TABLE `uchome_profilefield` DISABLE KEYS */;
/*!40000 ALTER TABLE `uchome_profilefield` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `uchome_report`
--

DROP TABLE IF EXISTS `uchome_report`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `uchome_report` (
  `rid` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `idtype` varchar(15) NOT NULL DEFAULT '',
  `new` tinyint(1) NOT NULL DEFAULT '0',
  `num` smallint(6) unsigned NOT NULL DEFAULT '0',
  `dateline` int(10) unsigned NOT NULL DEFAULT '0',
  `reason` text NOT NULL,
  `uids` text NOT NULL,
  PRIMARY KEY (`rid`),
  KEY `id` (`id`,`idtype`,`num`,`dateline`),
  KEY `new` (`new`,`dateline`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `uchome_report`
--

LOCK TABLES `uchome_report` WRITE;
/*!40000 ALTER TABLE `uchome_report` DISABLE KEYS */;
/*!40000 ALTER TABLE `uchome_report` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `uchome_session`
--

DROP TABLE IF EXISTS `uchome_session`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `uchome_session` (
  `uid` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `username` char(15) NOT NULL DEFAULT '',
  `password` char(32) NOT NULL DEFAULT '',
  `lastactivity` int(10) unsigned NOT NULL DEFAULT '0',
  `ip` int(10) unsigned NOT NULL DEFAULT '0',
  `magichidden` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`uid`),
  KEY `lastactivity` (`lastactivity`),
  KEY `ip` (`ip`)
) ENGINE=MEMORY DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `uchome_session`
--

LOCK TABLES `uchome_session` WRITE;
/*!40000 ALTER TABLE `uchome_session` DISABLE KEYS */;
/*!40000 ALTER TABLE `uchome_session` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `uchome_share`
--

DROP TABLE IF EXISTS `uchome_share`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `uchome_share` (
  `sid` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `topicid` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `type` varchar(30) NOT NULL DEFAULT '',
  `uid` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `username` varchar(15) NOT NULL DEFAULT '',
  `dateline` int(10) unsigned NOT NULL DEFAULT '0',
  `title_template` text NOT NULL,
  `body_template` text NOT NULL,
  `body_data` text NOT NULL,
  `body_general` text NOT NULL,
  `image` varchar(255) NOT NULL DEFAULT '',
  `image_link` varchar(255) NOT NULL DEFAULT '',
  `hot` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `hotuser` text NOT NULL,
  PRIMARY KEY (`sid`),
  KEY `uid` (`uid`,`dateline`),
  KEY `topicid` (`topicid`,`dateline`),
  KEY `hot` (`hot`),
  KEY `dateline` (`dateline`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `uchome_share`
--

LOCK TABLES `uchome_share` WRITE;
/*!40000 ALTER TABLE `uchome_share` DISABLE KEYS */;
/*!40000 ALTER TABLE `uchome_share` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `uchome_show`
--

DROP TABLE IF EXISTS `uchome_show`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `uchome_show` (
  `uid` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `username` varchar(15) NOT NULL DEFAULT '',
  `credit` int(10) unsigned NOT NULL DEFAULT '0',
  `note` varchar(100) NOT NULL DEFAULT '',
  PRIMARY KEY (`uid`),
  KEY `credit` (`credit`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `uchome_show`
--

LOCK TABLES `uchome_show` WRITE;
/*!40000 ALTER TABLE `uchome_show` DISABLE KEYS */;
/*!40000 ALTER TABLE `uchome_show` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `uchome_space`
--

DROP TABLE IF EXISTS `uchome_space`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `uchome_space` (
  `uid` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `groupid` smallint(6) unsigned NOT NULL DEFAULT '0',
  `credit` int(10) NOT NULL DEFAULT '0',
  `experience` int(10) NOT NULL DEFAULT '0',
  `username` char(15) NOT NULL DEFAULT '',
  `name` char(20) NOT NULL DEFAULT '',
  `namestatus` tinyint(1) NOT NULL DEFAULT '0',
  `videostatus` tinyint(1) NOT NULL DEFAULT '0',
  `domain` char(15) NOT NULL DEFAULT '',
  `friendnum` int(10) unsigned NOT NULL DEFAULT '0',
  `viewnum` int(10) unsigned NOT NULL DEFAULT '0',
  `notenum` int(10) unsigned NOT NULL DEFAULT '0',
  `addfriendnum` smallint(6) unsigned NOT NULL DEFAULT '0',
  `mtaginvitenum` smallint(6) unsigned NOT NULL DEFAULT '0',
  `eventinvitenum` smallint(6) unsigned NOT NULL DEFAULT '0',
  `myinvitenum` smallint(6) unsigned NOT NULL DEFAULT '0',
  `pokenum` smallint(6) unsigned NOT NULL DEFAULT '0',
  `doingnum` smallint(6) unsigned NOT NULL DEFAULT '0',
  `blognum` smallint(6) unsigned NOT NULL DEFAULT '0',
  `albumnum` smallint(6) unsigned NOT NULL DEFAULT '0',
  `threadnum` smallint(6) unsigned NOT NULL DEFAULT '0',
  `pollnum` smallint(6) unsigned NOT NULL DEFAULT '0',
  `eventnum` smallint(6) unsigned NOT NULL DEFAULT '0',
  `sharenum` smallint(6) unsigned NOT NULL DEFAULT '0',
  `dateline` int(10) unsigned NOT NULL DEFAULT '0',
  `updatetime` int(10) unsigned NOT NULL DEFAULT '0',
  `lastsearch` int(10) unsigned NOT NULL DEFAULT '0',
  `lastpost` int(10) unsigned NOT NULL DEFAULT '0',
  `lastlogin` int(10) unsigned NOT NULL DEFAULT '0',
  `lastsend` int(10) unsigned NOT NULL DEFAULT '0',
  `attachsize` int(10) unsigned NOT NULL DEFAULT '0',
  `addsize` int(10) unsigned NOT NULL DEFAULT '0',
  `addfriend` smallint(6) unsigned NOT NULL DEFAULT '0',
  `flag` tinyint(1) NOT NULL DEFAULT '0',
  `newpm` smallint(6) unsigned NOT NULL DEFAULT '0',
  `avatar` tinyint(1) NOT NULL DEFAULT '0',
  `regip` char(15) NOT NULL DEFAULT '',
  `ip` int(10) unsigned NOT NULL DEFAULT '0',
  `mood` smallint(6) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`uid`),
  KEY `username` (`username`),
  KEY `domain` (`domain`),
  KEY `ip` (`ip`),
  KEY `updatetime` (`updatetime`),
  KEY `mood` (`mood`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `uchome_space`
--

LOCK TABLES `uchome_space` WRITE;
/*!40000 ALTER TABLE `uchome_space` DISABLE KEYS */;
INSERT INTO `uchome_space` VALUES (1,1,25,15,'admin','',0,0,'',0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,1310993149,0,0,0,1310993149,0,0,0,0,1,0,0,'127.0.0.1',127000000,0);
/*!40000 ALTER TABLE `uchome_space` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `uchome_spacefield`
--

DROP TABLE IF EXISTS `uchome_spacefield`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `uchome_spacefield` (
  `uid` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `sex` tinyint(1) NOT NULL DEFAULT '0',
  `email` varchar(100) NOT NULL DEFAULT '',
  `newemail` varchar(100) NOT NULL DEFAULT '',
  `emailcheck` tinyint(1) NOT NULL DEFAULT '0',
  `mobile` varchar(40) NOT NULL DEFAULT '',
  `qq` varchar(20) NOT NULL DEFAULT '',
  `msn` varchar(80) NOT NULL DEFAULT '',
  `msnrobot` varchar(15) NOT NULL DEFAULT '',
  `msncstatus` tinyint(1) NOT NULL DEFAULT '0',
  `videopic` varchar(32) NOT NULL DEFAULT '',
  `birthyear` smallint(6) unsigned NOT NULL DEFAULT '0',
  `birthmonth` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `birthday` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `blood` varchar(5) NOT NULL DEFAULT '',
  `marry` tinyint(1) NOT NULL DEFAULT '0',
  `birthprovince` varchar(20) NOT NULL DEFAULT '',
  `birthcity` varchar(20) NOT NULL DEFAULT '',
  `resideprovince` varchar(20) NOT NULL DEFAULT '',
  `residecity` varchar(20) NOT NULL DEFAULT '',
  `note` text NOT NULL,
  `spacenote` text NOT NULL,
  `authstr` varchar(20) NOT NULL DEFAULT '',
  `theme` varchar(20) NOT NULL DEFAULT '',
  `nocss` tinyint(1) NOT NULL DEFAULT '0',
  `menunum` smallint(6) unsigned NOT NULL DEFAULT '0',
  `css` text NOT NULL,
  `privacy` text NOT NULL,
  `friend` mediumtext NOT NULL,
  `feedfriend` mediumtext NOT NULL,
  `sendmail` text NOT NULL,
  `magicstar` tinyint(1) NOT NULL DEFAULT '0',
  `magicexpire` int(10) unsigned NOT NULL DEFAULT '0',
  `timeoffset` varchar(20) NOT NULL DEFAULT '',
  PRIMARY KEY (`uid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `uchome_spacefield`
--

LOCK TABLES `uchome_spacefield` WRITE;
/*!40000 ALTER TABLE `uchome_spacefield` DISABLE KEYS */;
INSERT INTO `uchome_spacefield` VALUES (1,0,'','',0,'','','','',0,'',0,0,0,'',0,'','','','','','','','',0,0,'','','','','',0,0,'');
/*!40000 ALTER TABLE `uchome_spacefield` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `uchome_spaceinfo`
--

DROP TABLE IF EXISTS `uchome_spaceinfo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `uchome_spaceinfo` (
  `infoid` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `uid` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `type` varchar(20) NOT NULL DEFAULT '',
  `subtype` varchar(20) NOT NULL DEFAULT '',
  `title` text NOT NULL,
  `subtitle` varchar(255) NOT NULL DEFAULT '',
  `friend` tinyint(1) NOT NULL DEFAULT '0',
  `startyear` smallint(6) unsigned NOT NULL DEFAULT '0',
  `endyear` smallint(6) unsigned NOT NULL DEFAULT '0',
  `startmonth` smallint(6) unsigned NOT NULL DEFAULT '0',
  `endmonth` smallint(6) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`infoid`),
  KEY `uid` (`uid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `uchome_spaceinfo`
--

LOCK TABLES `uchome_spaceinfo` WRITE;
/*!40000 ALTER TABLE `uchome_spaceinfo` DISABLE KEYS */;
/*!40000 ALTER TABLE `uchome_spaceinfo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `uchome_spacelog`
--

DROP TABLE IF EXISTS `uchome_spacelog`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `uchome_spacelog` (
  `uid` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `username` char(15) NOT NULL DEFAULT '',
  `opuid` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `opusername` char(15) NOT NULL DEFAULT '',
  `flag` tinyint(1) NOT NULL DEFAULT '0',
  `expiration` int(10) unsigned NOT NULL DEFAULT '0',
  `dateline` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`uid`),
  KEY `flag` (`flag`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `uchome_spacelog`
--

LOCK TABLES `uchome_spacelog` WRITE;
/*!40000 ALTER TABLE `uchome_spacelog` DISABLE KEYS */;
/*!40000 ALTER TABLE `uchome_spacelog` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `uchome_stat`
--

DROP TABLE IF EXISTS `uchome_stat`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `uchome_stat` (
  `daytime` int(10) unsigned NOT NULL DEFAULT '0',
  `login` smallint(6) unsigned NOT NULL DEFAULT '0',
  `register` smallint(6) unsigned NOT NULL DEFAULT '0',
  `invite` smallint(6) unsigned NOT NULL DEFAULT '0',
  `appinvite` smallint(6) unsigned NOT NULL DEFAULT '0',
  `doing` smallint(6) unsigned NOT NULL DEFAULT '0',
  `blog` smallint(6) unsigned NOT NULL DEFAULT '0',
  `pic` smallint(6) unsigned NOT NULL DEFAULT '0',
  `poll` smallint(6) unsigned NOT NULL DEFAULT '0',
  `event` smallint(6) unsigned NOT NULL DEFAULT '0',
  `share` smallint(6) unsigned NOT NULL DEFAULT '0',
  `thread` smallint(6) unsigned NOT NULL DEFAULT '0',
  `docomment` smallint(6) unsigned NOT NULL DEFAULT '0',
  `blogcomment` smallint(6) unsigned NOT NULL DEFAULT '0',
  `piccomment` smallint(6) unsigned NOT NULL DEFAULT '0',
  `pollcomment` smallint(6) unsigned NOT NULL DEFAULT '0',
  `pollvote` smallint(6) unsigned NOT NULL DEFAULT '0',
  `eventcomment` smallint(6) unsigned NOT NULL DEFAULT '0',
  `eventjoin` smallint(6) unsigned NOT NULL DEFAULT '0',
  `sharecomment` smallint(6) unsigned NOT NULL DEFAULT '0',
  `post` smallint(6) unsigned NOT NULL DEFAULT '0',
  `wall` smallint(6) unsigned NOT NULL DEFAULT '0',
  `poke` smallint(6) unsigned NOT NULL DEFAULT '0',
  `click` smallint(6) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`daytime`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `uchome_stat`
--

LOCK TABLES `uchome_stat` WRITE;
/*!40000 ALTER TABLE `uchome_stat` DISABLE KEYS */;
INSERT INTO `uchome_stat` VALUES (20110718,1,1,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0);
/*!40000 ALTER TABLE `uchome_stat` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `uchome_statuser`
--

DROP TABLE IF EXISTS `uchome_statuser`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `uchome_statuser` (
  `uid` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `daytime` int(10) unsigned NOT NULL DEFAULT '0',
  `type` char(20) NOT NULL DEFAULT '',
  KEY `uid` (`uid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `uchome_statuser`
--

LOCK TABLES `uchome_statuser` WRITE;
/*!40000 ALTER TABLE `uchome_statuser` DISABLE KEYS */;
INSERT INTO `uchome_statuser` VALUES (1,0,'login');
/*!40000 ALTER TABLE `uchome_statuser` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `uchome_tag`
--

DROP TABLE IF EXISTS `uchome_tag`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `uchome_tag` (
  `tagid` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `tagname` char(30) NOT NULL DEFAULT '',
  `uid` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `dateline` int(10) unsigned NOT NULL DEFAULT '0',
  `blognum` smallint(6) unsigned NOT NULL DEFAULT '0',
  `close` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`tagid`),
  KEY `tagname` (`tagname`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `uchome_tag`
--

LOCK TABLES `uchome_tag` WRITE;
/*!40000 ALTER TABLE `uchome_tag` DISABLE KEYS */;
/*!40000 ALTER TABLE `uchome_tag` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `uchome_tagblog`
--

DROP TABLE IF EXISTS `uchome_tagblog`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `uchome_tagblog` (
  `tagid` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `blogid` mediumint(8) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`tagid`,`blogid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `uchome_tagblog`
--

LOCK TABLES `uchome_tagblog` WRITE;
/*!40000 ALTER TABLE `uchome_tagblog` DISABLE KEYS */;
/*!40000 ALTER TABLE `uchome_tagblog` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `uchome_tagspace`
--

DROP TABLE IF EXISTS `uchome_tagspace`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `uchome_tagspace` (
  `tagid` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `uid` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `username` char(15) NOT NULL DEFAULT '',
  `grade` smallint(6) NOT NULL DEFAULT '0',
  PRIMARY KEY (`tagid`,`uid`),
  KEY `grade` (`tagid`,`grade`),
  KEY `uid` (`uid`,`grade`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `uchome_tagspace`
--

LOCK TABLES `uchome_tagspace` WRITE;
/*!40000 ALTER TABLE `uchome_tagspace` DISABLE KEYS */;
/*!40000 ALTER TABLE `uchome_tagspace` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `uchome_task`
--

DROP TABLE IF EXISTS `uchome_task`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `uchome_task` (
  `taskid` smallint(6) unsigned NOT NULL AUTO_INCREMENT,
  `available` tinyint(1) NOT NULL DEFAULT '0',
  `name` varchar(50) NOT NULL DEFAULT '',
  `note` text NOT NULL,
  `num` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `maxnum` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `image` varchar(150) NOT NULL DEFAULT '',
  `filename` varchar(50) NOT NULL DEFAULT '',
  `starttime` int(10) unsigned NOT NULL DEFAULT '0',
  `endtime` int(10) unsigned NOT NULL DEFAULT '0',
  `nexttime` int(10) unsigned NOT NULL DEFAULT '0',
  `nexttype` varchar(20) NOT NULL DEFAULT '',
  `credit` smallint(6) NOT NULL DEFAULT '0',
  `displayorder` smallint(6) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`taskid`),
  KEY `displayorder` (`displayorder`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `uchome_task`
--

LOCK TABLES `uchome_task` WRITE;
/*!40000 ALTER TABLE `uchome_task` DISABLE KEYS */;
INSERT INTO `uchome_task` VALUES (1,1,'更新一下自己的頭像','頭像就是你在這裡的個人形象。<br>設置自己的頭像後，會讓更多的朋友記住您。',0,0,'image/task/avatar.gif','avatar.php',0,0,0,'',20,1),(2,1,'將個人資料補充完整','把自己的個人資料填寫完整吧。<br>這樣您會被更多的朋友找到的，系統也會幫您找到朋友。',0,0,'image/task/profile.gif','profile.php',0,0,0,'2',20,0),(3,1,'發表自己的第一篇日誌','現在，就寫下自己的第一篇日誌吧。<br>與大家一起分享自己的生活感悟。',0,0,'image/task/blog.gif','blog.php',0,0,0,'',5,3),(4,1,'尋找並添加五位好友','有了好友，您發的日誌、圖片等會被好友及時看到並傳播出去；<br>您也會在首頁方便及時的看到好友的最新動態。',0,0,'image/task/friend.gif','friend.php',0,0,0,'',50,4),(5,1,'驗證激活自己的郵箱','填寫自己真實的郵箱地址並驗證通過。<br>您可以在忘記密碼的時候使用該郵箱取回自己的密碼；<br>還可以及時接受站內的好友通知等等。',0,0,'image/task/email.gif','email.php',0,0,0,'',10,5),(6,1,'邀請10個新朋友加入','邀請一下自己的QQ好友或者郵箱聯繫人，讓親朋好友一起來加入我們吧。',0,0,'image/task/friend.gif','invite.php',0,0,0,'',100,6),(7,1,'領取每日訪問大禮包','每天登錄訪問自己的主頁，就可領取大禮包。',0,0,'image/task/gift.gif','gift.php',0,0,0,'day',5,99);
/*!40000 ALTER TABLE `uchome_task` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `uchome_thread`
--

DROP TABLE IF EXISTS `uchome_thread`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `uchome_thread` (
  `tid` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `topicid` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `tagid` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `eventid` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `subject` char(80) NOT NULL DEFAULT '',
  `magiccolor` tinyint(6) unsigned NOT NULL DEFAULT '0',
  `magicegg` tinyint(6) unsigned NOT NULL DEFAULT '0',
  `uid` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `username` char(15) NOT NULL DEFAULT '',
  `dateline` int(10) unsigned NOT NULL DEFAULT '0',
  `viewnum` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `replynum` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `lastpost` int(10) unsigned NOT NULL DEFAULT '0',
  `lastauthor` char(15) NOT NULL DEFAULT '',
  `lastauthorid` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `displayorder` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `digest` tinyint(1) NOT NULL DEFAULT '0',
  `hot` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `click_11` smallint(6) unsigned NOT NULL DEFAULT '0',
  `click_12` smallint(6) unsigned NOT NULL DEFAULT '0',
  `click_13` smallint(6) unsigned NOT NULL DEFAULT '0',
  `click_14` smallint(6) unsigned NOT NULL DEFAULT '0',
  `click_15` smallint(6) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`tid`),
  KEY `tagid` (`tagid`,`displayorder`,`lastpost`),
  KEY `uid` (`uid`,`lastpost`),
  KEY `lastpost` (`lastpost`),
  KEY `topicid` (`topicid`,`dateline`),
  KEY `eventid` (`eventid`,`lastpost`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `uchome_thread`
--

LOCK TABLES `uchome_thread` WRITE;
/*!40000 ALTER TABLE `uchome_thread` DISABLE KEYS */;
/*!40000 ALTER TABLE `uchome_thread` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `uchome_topic`
--

DROP TABLE IF EXISTS `uchome_topic`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `uchome_topic` (
  `topicid` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `uid` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `username` varchar(15) NOT NULL DEFAULT '',
  `subject` varchar(80) NOT NULL DEFAULT '',
  `message` mediumtext NOT NULL,
  `jointype` varchar(255) NOT NULL DEFAULT '',
  `joingid` varchar(255) NOT NULL DEFAULT '',
  `pic` varchar(100) NOT NULL DEFAULT '',
  `thumb` tinyint(1) NOT NULL DEFAULT '0',
  `remote` tinyint(1) NOT NULL DEFAULT '0',
  `joinnum` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `lastpost` int(10) unsigned NOT NULL DEFAULT '0',
  `dateline` int(10) unsigned NOT NULL DEFAULT '0',
  `endtime` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`topicid`),
  KEY `lastpost` (`lastpost`),
  KEY `joinnum` (`joinnum`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `uchome_topic`
--

LOCK TABLES `uchome_topic` WRITE;
/*!40000 ALTER TABLE `uchome_topic` DISABLE KEYS */;
/*!40000 ALTER TABLE `uchome_topic` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `uchome_topicuser`
--

DROP TABLE IF EXISTS `uchome_topicuser`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `uchome_topicuser` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `uid` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `topicid` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `username` varchar(15) NOT NULL DEFAULT '',
  `dateline` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `uid` (`uid`,`dateline`),
  KEY `topicid` (`topicid`,`dateline`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `uchome_topicuser`
--

LOCK TABLES `uchome_topicuser` WRITE;
/*!40000 ALTER TABLE `uchome_topicuser` DISABLE KEYS */;
/*!40000 ALTER TABLE `uchome_topicuser` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `uchome_userapp`
--

DROP TABLE IF EXISTS `uchome_userapp`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `uchome_userapp` (
  `uid` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `appid` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `appname` varchar(60) NOT NULL DEFAULT '',
  `privacy` tinyint(1) NOT NULL DEFAULT '0',
  `allowsidenav` tinyint(1) NOT NULL DEFAULT '0',
  `allowfeed` tinyint(1) NOT NULL DEFAULT '0',
  `allowprofilelink` tinyint(1) NOT NULL DEFAULT '0',
  `narrow` tinyint(1) NOT NULL DEFAULT '0',
  `menuorder` smallint(6) NOT NULL DEFAULT '0',
  `displayorder` smallint(6) NOT NULL DEFAULT '0',
  KEY `uid` (`uid`,`appid`),
  KEY `menuorder` (`uid`,`menuorder`),
  KEY `displayorder` (`uid`,`displayorder`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `uchome_userapp`
--

LOCK TABLES `uchome_userapp` WRITE;
/*!40000 ALTER TABLE `uchome_userapp` DISABLE KEYS */;
/*!40000 ALTER TABLE `uchome_userapp` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `uchome_userappfield`
--

DROP TABLE IF EXISTS `uchome_userappfield`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `uchome_userappfield` (
  `uid` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `appid` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `profilelink` text NOT NULL,
  `myml` text NOT NULL,
  KEY `uid` (`uid`,`appid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `uchome_userappfield`
--

LOCK TABLES `uchome_userappfield` WRITE;
/*!40000 ALTER TABLE `uchome_userappfield` DISABLE KEYS */;
/*!40000 ALTER TABLE `uchome_userappfield` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `uchome_userevent`
--

DROP TABLE IF EXISTS `uchome_userevent`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `uchome_userevent` (
  `eventid` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `uid` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `username` varchar(15) NOT NULL DEFAULT '',
  `dateline` int(10) unsigned NOT NULL DEFAULT '0',
  `status` tinyint(4) NOT NULL DEFAULT '0',
  `fellow` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `template` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`eventid`,`uid`),
  KEY `uid` (`uid`,`dateline`),
  KEY `eventid` (`eventid`,`status`,`dateline`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `uchome_userevent`
--

LOCK TABLES `uchome_userevent` WRITE;
/*!40000 ALTER TABLE `uchome_userevent` DISABLE KEYS */;
/*!40000 ALTER TABLE `uchome_userevent` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `uchome_usergroup`
--

DROP TABLE IF EXISTS `uchome_usergroup`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `uchome_usergroup` (
  `gid` smallint(6) unsigned NOT NULL AUTO_INCREMENT,
  `grouptitle` varchar(20) NOT NULL DEFAULT '',
  `system` tinyint(1) NOT NULL DEFAULT '0',
  `banvisit` tinyint(1) NOT NULL DEFAULT '0',
  `explower` int(10) NOT NULL DEFAULT '0',
  `maxfriendnum` smallint(6) unsigned NOT NULL DEFAULT '0',
  `maxattachsize` int(10) unsigned NOT NULL DEFAULT '0',
  `allowhtml` tinyint(1) NOT NULL DEFAULT '0',
  `allowcomment` tinyint(1) NOT NULL DEFAULT '0',
  `searchinterval` smallint(6) unsigned NOT NULL DEFAULT '0',
  `searchignore` tinyint(1) NOT NULL DEFAULT '0',
  `postinterval` smallint(6) unsigned NOT NULL DEFAULT '0',
  `spamignore` tinyint(1) NOT NULL DEFAULT '0',
  `videophotoignore` tinyint(1) NOT NULL DEFAULT '0',
  `allowblog` tinyint(1) NOT NULL DEFAULT '0',
  `allowdoing` tinyint(1) NOT NULL DEFAULT '0',
  `allowupload` tinyint(1) NOT NULL DEFAULT '0',
  `allowshare` tinyint(1) NOT NULL DEFAULT '0',
  `allowmtag` tinyint(1) NOT NULL DEFAULT '0',
  `allowthread` tinyint(1) NOT NULL DEFAULT '0',
  `allowpost` tinyint(1) NOT NULL DEFAULT '0',
  `allowcss` tinyint(1) NOT NULL DEFAULT '0',
  `allowpoke` tinyint(1) NOT NULL DEFAULT '0',
  `allowfriend` tinyint(1) NOT NULL DEFAULT '0',
  `allowpoll` tinyint(1) NOT NULL DEFAULT '0',
  `allowclick` tinyint(1) NOT NULL DEFAULT '0',
  `allowevent` tinyint(1) NOT NULL DEFAULT '0',
  `allowmagic` tinyint(1) NOT NULL DEFAULT '0',
  `allowpm` tinyint(1) NOT NULL DEFAULT '0',
  `allowviewvideopic` tinyint(1) NOT NULL DEFAULT '0',
  `allowmyop` tinyint(1) NOT NULL DEFAULT '0',
  `allowtopic` tinyint(1) NOT NULL DEFAULT '0',
  `allowstat` tinyint(1) NOT NULL DEFAULT '0',
  `magicdiscount` tinyint(1) NOT NULL DEFAULT '0',
  `verifyevent` tinyint(1) NOT NULL DEFAULT '0',
  `edittrail` tinyint(1) NOT NULL DEFAULT '0',
  `domainlength` smallint(6) unsigned NOT NULL DEFAULT '0',
  `closeignore` tinyint(1) NOT NULL DEFAULT '0',
  `seccode` tinyint(1) NOT NULL DEFAULT '0',
  `color` varchar(10) NOT NULL DEFAULT '',
  `icon` varchar(100) NOT NULL DEFAULT '',
  `manageconfig` tinyint(1) NOT NULL DEFAULT '0',
  `managenetwork` tinyint(1) NOT NULL DEFAULT '0',
  `manageprofilefield` tinyint(1) NOT NULL DEFAULT '0',
  `manageprofield` tinyint(1) NOT NULL DEFAULT '0',
  `manageusergroup` tinyint(1) NOT NULL DEFAULT '0',
  `managefeed` tinyint(1) NOT NULL DEFAULT '0',
  `manageshare` tinyint(1) NOT NULL DEFAULT '0',
  `managedoing` tinyint(1) NOT NULL DEFAULT '0',
  `manageblog` tinyint(1) NOT NULL DEFAULT '0',
  `managetag` tinyint(1) NOT NULL DEFAULT '0',
  `managetagtpl` tinyint(1) NOT NULL DEFAULT '0',
  `managealbum` tinyint(1) NOT NULL DEFAULT '0',
  `managecomment` tinyint(1) NOT NULL DEFAULT '0',
  `managemtag` tinyint(1) NOT NULL DEFAULT '0',
  `managethread` tinyint(1) NOT NULL DEFAULT '0',
  `manageevent` tinyint(1) NOT NULL DEFAULT '0',
  `manageeventclass` tinyint(1) NOT NULL DEFAULT '0',
  `managecensor` tinyint(1) NOT NULL DEFAULT '0',
  `managead` tinyint(1) NOT NULL DEFAULT '0',
  `managesitefeed` tinyint(1) NOT NULL DEFAULT '0',
  `managebackup` tinyint(1) NOT NULL DEFAULT '0',
  `manageblock` tinyint(1) NOT NULL DEFAULT '0',
  `managetemplate` tinyint(1) NOT NULL DEFAULT '0',
  `managestat` tinyint(1) NOT NULL DEFAULT '0',
  `managecache` tinyint(1) NOT NULL DEFAULT '0',
  `managecredit` tinyint(1) NOT NULL DEFAULT '0',
  `managecron` tinyint(1) NOT NULL DEFAULT '0',
  `managename` tinyint(1) NOT NULL DEFAULT '0',
  `manageapp` tinyint(1) NOT NULL DEFAULT '0',
  `managetask` tinyint(1) NOT NULL DEFAULT '0',
  `managereport` tinyint(1) NOT NULL DEFAULT '0',
  `managepoll` tinyint(1) NOT NULL DEFAULT '0',
  `manageclick` tinyint(1) NOT NULL DEFAULT '0',
  `managemagic` tinyint(1) NOT NULL DEFAULT '0',
  `managemagiclog` tinyint(1) NOT NULL DEFAULT '0',
  `managebatch` tinyint(1) NOT NULL DEFAULT '0',
  `managedelspace` tinyint(1) NOT NULL DEFAULT '0',
  `managetopic` tinyint(1) NOT NULL DEFAULT '0',
  `manageip` tinyint(1) NOT NULL DEFAULT '0',
  `managehotuser` tinyint(1) NOT NULL DEFAULT '0',
  `managedefaultuser` tinyint(1) NOT NULL DEFAULT '0',
  `managespacegroup` tinyint(1) NOT NULL DEFAULT '0',
  `managespaceinfo` tinyint(1) NOT NULL DEFAULT '0',
  `managespacecredit` tinyint(1) NOT NULL DEFAULT '0',
  `managespacenote` tinyint(1) NOT NULL DEFAULT '0',
  `managevideophoto` tinyint(1) NOT NULL DEFAULT '0',
  `managelog` tinyint(1) NOT NULL DEFAULT '0',
  `magicaward` text NOT NULL,
  PRIMARY KEY (`gid`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `uchome_usergroup`
--

LOCK TABLES `uchome_usergroup` WRITE;
/*!40000 ALTER TABLE `uchome_usergroup` DISABLE KEYS */;
INSERT INTO `uchome_usergroup` VALUES (1,'站點管理員',-1,0,0,0,0,1,1,0,1,0,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,0,0,0,1,1,0,'red','image/group/admin.gif',1,1,1,1,1,1,1,1,1,1,0,1,1,1,1,1,1,1,1,0,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,''),(2,'信息管理員',-1,0,0,0,0,1,1,0,1,0,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,0,0,0,3,1,0,'blue','image/group/infor.gif',0,0,0,0,0,1,1,1,1,1,0,1,1,1,1,1,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,1,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,''),(3,'貴賓VIP',1,0,0,0,0,1,1,0,1,0,1,0,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,0,0,0,0,0,3,0,0,'green','image/group/vip.gif',0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,''),(4,'受限會員',0,0,-999999999,10,10,0,0,600,0,300,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,1,0,0,0,1,'','',0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,''),(5,'普通會員',0,0,0,100,20,0,1,60,0,60,0,0,1,1,1,1,1,1,1,0,1,1,1,1,1,1,1,0,1,0,0,0,0,0,0,0,0,'','',0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,''),(6,'中級會員',0,0,100,200,50,0,1,30,0,30,0,0,1,1,1,1,1,1,1,0,1,1,1,1,1,1,1,0,1,0,0,0,0,0,5,0,0,'','',0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,''),(7,'高級會員',0,0,1000,300,100,1,1,10,1,10,0,0,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,0,1,0,0,0,0,0,3,0,0,'','',0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,''),(8,'禁止發言',-1,0,0,1,1,0,0,9999,0,9999,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,1,0,99,0,1,'','',0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,''),(9,'禁止訪問',-1,1,0,1,1,0,0,9999,0,9999,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,1,0,99,0,1,'','',0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,'');
/*!40000 ALTER TABLE `uchome_usergroup` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `uchome_userlog`
--

DROP TABLE IF EXISTS `uchome_userlog`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `uchome_userlog` (
  `uid` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `action` char(10) NOT NULL DEFAULT '',
  `type` tinyint(1) NOT NULL DEFAULT '0',
  `dateline` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`uid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `uchome_userlog`
--

LOCK TABLES `uchome_userlog` WRITE;
/*!40000 ALTER TABLE `uchome_userlog` DISABLE KEYS */;
/*!40000 ALTER TABLE `uchome_userlog` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `uchome_usermagic`
--

DROP TABLE IF EXISTS `uchome_usermagic`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `uchome_usermagic` (
  `uid` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `username` char(15) NOT NULL DEFAULT '',
  `mid` varchar(15) NOT NULL DEFAULT '',
  `count` smallint(6) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`uid`,`mid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `uchome_usermagic`
--

LOCK TABLES `uchome_usermagic` WRITE;
/*!40000 ALTER TABLE `uchome_usermagic` DISABLE KEYS */;
/*!40000 ALTER TABLE `uchome_usermagic` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `uchome_usertask`
--

DROP TABLE IF EXISTS `uchome_usertask`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `uchome_usertask` (
  `uid` mediumint(8) unsigned NOT NULL,
  `username` char(15) NOT NULL DEFAULT '',
  `taskid` smallint(6) unsigned NOT NULL DEFAULT '0',
  `credit` smallint(6) NOT NULL DEFAULT '0',
  `dateline` int(10) unsigned NOT NULL DEFAULT '0',
  `isignore` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`uid`,`taskid`),
  KEY `isignore` (`isignore`,`dateline`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `uchome_usertask`
--

LOCK TABLES `uchome_usertask` WRITE;
/*!40000 ALTER TABLE `uchome_usertask` DISABLE KEYS */;
/*!40000 ALTER TABLE `uchome_usertask` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `uchome_visitor`
--

DROP TABLE IF EXISTS `uchome_visitor`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `uchome_visitor` (
  `uid` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `vuid` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `vusername` char(15) NOT NULL DEFAULT '',
  `dateline` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`uid`,`vuid`),
  KEY `dateline` (`uid`,`dateline`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `uchome_visitor`
--

LOCK TABLES `uchome_visitor` WRITE;
/*!40000 ALTER TABLE `uchome_visitor` DISABLE KEYS */;
/*!40000 ALTER TABLE `uchome_visitor` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2011-10-02 17:54:02
