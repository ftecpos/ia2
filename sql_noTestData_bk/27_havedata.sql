-- MySQL dump 10.13  Distrib 5.5.9, for Win32 (x86)
--
-- Host: localhost    Database: 3shop
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
-- Current Database: `3shop`
--

CREATE DATABASE /*!32312 IF NOT EXISTS*/ `3shop` /*!40100 DEFAULT CHARACTER SET utf8 */;

USE `3shop`;

--
-- Table structure for table `accessories`
--

DROP TABLE IF EXISTS `accessories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `accessories` (
  `acc_no` int(10) NOT NULL AUTO_INCREMENT,
  `acc_id` varchar(10) DEFAULT NULL,
  `accName` varchar(200) DEFAULT NULL,
  `accType_no` smallint(5) DEFAULT NULL,
  `barcode` varchar(13) DEFAULT NULL,
  `color` varchar(10) DEFAULT NULL,
  `manufacturer` varchar(10) DEFAULT NULL,
  `state` varchar(10) DEFAULT NULL,
  `oprice` decimal(7,1) DEFAULT NULL,
  `sprice` decimal(7,1) DEFAULT NULL,
  `productState_no` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`acc_no`),
  UNIQUE KEY `barcode_UNIQUE` (`barcode`),
  KEY `ass_fk_prodState` (`productState_no`),
  CONSTRAINT `ass_fk_prodState` FOREIGN KEY (`productState_no`) REFERENCES `productstate` (`productState_no`) ON DELETE NO ACTION ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `accessories`
--

LOCK TABLES `accessories` WRITE;
/*!40000 ALTER TABLE `accessories` DISABLE KEYS */;
INSERT INTO `accessories` VALUES (1,'id1','ABC SSEE 保護貼 ',1,'3633633666969','red','man1',NULL,30.0,20.0,2),(2,'id_2','GGFG DDS 保護貼',1,'3633633666968','yellow','man2',NULL,30.0,20.0,2),(3,'2SC0101','DEX Screen Protector for iPhone 4s (Anti-Glare)',1,NULL,'Anti-Glare','DEX',NULL,50.0,20.0,2),(4,'2SC0201','WOD Screen Protector for iPhone 4s (Clear)',1,NULL,'Clear','WOD',NULL,1.0,2.0,2),(5,'2SC0203','WOA Screen Protector for iPhone 4s (Clear)',1,'0','N/A','WOA',NULL,10.0,10.0,2);
/*!40000 ALTER TABLE `accessories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `acctype`
--

DROP TABLE IF EXISTS `acctype`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `acctype` (
  `accType_no` smallint(5) NOT NULL AUTO_INCREMENT,
  `typeName` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`accType_no`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `acctype`
--

LOCK TABLES `acctype` WRITE;
/*!40000 ALTER TABLE `acctype` DISABLE KEYS */;
INSERT INTO `acctype` VALUES (1,'保護貼'),(2,'機殼'),(3,'充電器'),(4,'耳機'),(5,'其他 Other');
/*!40000 ALTER TABLE `acctype` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `customer`
--

DROP TABLE IF EXISTS `customer`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `customer` (
  `customer_no` int(10) NOT NULL AUTO_INCREMENT,
  `customer_id` varchar(10) DEFAULT NULL,
  `name` varchar(45) DEFAULT NULL,
  `addr` varchar(255) DEFAULT NULL,
  `phone` varchar(15) DEFAULT NULL,
  `period` int(15) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `fax` varchar(15) DEFAULT NULL,
  `remark` text,
  PRIMARY KEY (`customer_no`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `customer`
--

LOCK TABLES `customer` WRITE;
/*!40000 ALTER TABLE `customer` DISABLE KEYS */;
INSERT INTO `customer` VALUES (1,'ABC112','test1 test','dslfkdjsfldks','25836925',0,'','12345678',''),(2,'2516','621','651','321',0,'','','');
/*!40000 ALTER TABLE `customer` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `dend`
--

DROP TABLE IF EXISTS `dend`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `dend` (
  `dend_no` int(11) NOT NULL AUTO_INCREMENT,
  `createDate` datetime DEFAULT NULL,
  `retailShop_no` int(10) DEFAULT NULL,
  `createBy` varchar(4) DEFAULT NULL,
  PRIMARY KEY (`dend_no`)
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `dend`
--

LOCK TABLES `dend` WRITE;
/*!40000 ALTER TABLE `dend` DISABLE KEYS */;
INSERT INTO `dend` VALUES (29,'2012-01-04 21:27:45',2,NULL),(30,'2012-01-05 12:07:04',2,'root'),(31,'2012-01-18 03:09:22',1,'root'),(32,'2012-01-18 03:09:23',1,'root'),(33,'2012-01-18 03:09:24',1,'root'),(34,'2012-01-18 03:09:25',1,'root');
/*!40000 ALTER TABLE `dend` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `dend_detail`
--

DROP TABLE IF EXISTS `dend_detail`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `dend_detail` (
  `dend_no` int(10) DEFAULT NULL,
  `coll_price` decimal(7,1) DEFAULT NULL,
  `end_price` decimal(7,1) DEFAULT NULL,
  `payment_no` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `dend_detail`
--

LOCK TABLES `dend_detail` WRITE;
/*!40000 ALTER TABLE `dend_detail` DISABLE KEYS */;
INSERT INTO `dend_detail` VALUES (29,1000.0,1000.0,1),(29,2222.0,2222.0,2),(29,1000.0,1000.0,3),(29,676.0,676.0,4);
/*!40000 ALTER TABLE `dend_detail` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `invoice`
--

DROP TABLE IF EXISTS `invoice`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `invoice` (
  `invoice_no` int(10) NOT NULL AUTO_INCREMENT,
  `createDate` datetime DEFAULT NULL,
  `total` decimal(7,1) DEFAULT NULL,
  `remark` text,
  `invoiceType_no` tinyint(2) DEFAULT NULL,
  `customer_no` varchar(45) DEFAULT NULL,
  `staff_no` int(10) DEFAULT NULL,
  `retailShop_no` smallint(4) DEFAULT NULL,
  `invoiceState_no` int(10) DEFAULT NULL,
  `createBy` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`invoice_no`),
  KEY `invoice_fk_inType` (`invoiceType_no`),
  KEY `invoice_fk_cust` (`customer_no`),
  KEY `invoice_fk_staff` (`staff_no`),
  KEY `invoice_fk_rs` (`retailShop_no`),
  CONSTRAINT `invoice_fk_inType` FOREIGN KEY (`invoiceType_no`) REFERENCES `invoicetype` (`invoiceType_no`) ON DELETE NO ACTION ON UPDATE CASCADE,
  CONSTRAINT `invoice_fk_rs` FOREIGN KEY (`retailShop_no`) REFERENCES `retailshop` (`retailShop_no`) ON DELETE NO ACTION ON UPDATE CASCADE,
  CONSTRAINT `invoice_fk_staff` FOREIGN KEY (`staff_no`) REFERENCES `staff` (`staff_no`) ON DELETE NO ACTION ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `invoice`
--

LOCK TABLES `invoice` WRITE;
/*!40000 ALTER TABLE `invoice` DISABLE KEYS */;
INSERT INTO `invoice` VALUES (23,'2012-01-15 14:15:34',4918.0,'N/A',1,'null',1,1,2,'root'),(24,'2012-01-15 14:40:45',4898.0,'N/A',1,'null',1,1,1,'8000'),(25,'2012-01-15 18:37:43',300.0,'N/A',1,'null',1,2,2,'root'),(26,'2012-01-15 22:34:56',300.0,'N/A',1,'null',1,2,1,'root'),(27,'2012-01-18 06:33:58',20.0,'N/A',1,'null',1,2,2,'root'),(28,'2012-01-18 07:25:01',20.0,'N/A',1,'null',1,2,2,'root'),(29,'2012-01-18 07:26:24',20.0,'N/A',1,'null',1,2,2,'root'),(30,'2012-01-18 07:28:18',20.0,'N/A',1,'null',1,2,2,'root'),(31,'2012-01-18 07:28:32',20.0,'N/A',1,'null',1,2,2,'root'),(32,'2012-01-18 07:28:59',20.0,'N/A',1,'null',1,2,2,'root'),(33,'2012-01-18 07:32:28',20.0,'N/A',1,'null',1,2,2,'root'),(34,'2012-01-18 07:40:31',20.0,'N/A',1,'null',1,2,2,'8000'),(35,'2012-01-18 07:42:28',20.0,'N/A',1,'null',1,2,1,'root'),(36,'2012-01-18 07:42:48',20.0,'N/A',1,'null',1,2,1,'root');
/*!40000 ALTER TABLE `invoice` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `invoicedetail`
--

DROP TABLE IF EXISTS `invoicedetail`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `invoicedetail` (
  `invoiceDetail_no` int(10) NOT NULL AUTO_INCREMENT,
  `product_no` varchar(15) DEFAULT NULL,
  `description` varchar(200) DEFAULT NULL,
  `qty` smallint(5) DEFAULT NULL,
  `discount` int(10) DEFAULT NULL,
  `price` decimal(7,1) DEFAULT NULL,
  `invoice_no` int(10) DEFAULT NULL,
  `goodsType` smallint(1) DEFAULT NULL,
  `modifyBy` varchar(4) DEFAULT NULL,
  `pastIDV` int(10) DEFAULT NULL,
  `modifyDate` datetime DEFAULT NULL,
  `cost` decimal(7,1) DEFAULT NULL,
  PRIMARY KEY (`invoiceDetail_no`),
  KEY `ind_fk_invoice` (`invoice_no`),
  KEY `ind_fk_acc` (`goodsType`),
  CONSTRAINT `ind_fk_invoice` FOREIGN KEY (`invoice_no`) REFERENCES `invoice` (`invoice_no`) ON DELETE NO ACTION ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=63 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `invoicedetail`
--

LOCK TABLES `invoicedetail` WRITE;
/*!40000 ALTER TABLE `invoicedetail` DISABLE KEYS */;
INSERT INTO `invoicedetail` VALUES (46,'2SC0101','DEX Screen Protector for iPhone 4s (Anti-Glar)',1,0,20.0,23,0,'1',NULL,NULL,20.0),(47,'662626662266666','APPLE IPHONE 4S',1,0,4898.0,23,1,'1',NULL,NULL,5000.0),(48,'333444555666777','APPLE IPHONE 4S (white)',1,0,4898.0,24,1,'1',NULL,NULL,5000.0),(49,'2SC0101','DEX Screen Protector for iPhone 4s (Anti-Glare)',10,0,20.0,25,0,'1',NULL,NULL,20.0),(50,'2SC0101','DEX Screen Protector for iPhone 4s (Anti-Glare)',5,0,20.0,25,0,'1',NULL,NULL,20.0),(51,'2SC0101','DEX Screen Protector for iPhone 4s (Anti-Glare)',10,0,20.0,26,0,'1',NULL,NULL,20.0),(52,'2SC0101','DEX Screen Protector for iPhone 4s (Anti-Glare)',5,0,20.0,26,0,'1',NULL,NULL,20.0),(53,'2SC0101','DEX Screen Protector for iPhone 4s (Anti-Glare)',1,0,20.0,27,0,'1',NULL,NULL,20.0),(54,'2SC0101','DEX Screen Protector for iPhone 4s (Anti-Glare)',1,0,20.0,28,0,'1',NULL,NULL,20.0),(55,'2SC0101','DEX Screen Protector for iPhone 4s (Anti-Glare)',1,0,20.0,29,0,'1',NULL,NULL,20.0),(56,'2SC0101','DEX Screen Protector for iPhone 4s (Anti-Glare)',1,0,20.0,30,0,'1',NULL,NULL,20.0),(57,'2SC0101','DEX Screen Protector for iPhone 4s (Anti-Glare)',1,0,20.0,31,0,'1',NULL,NULL,20.0),(58,'2SC0101','DEX Screen Protector for iPhone 4s (Anti-Glare)',1,0,20.0,32,0,'1',NULL,NULL,20.0),(59,'2SC0101','DEX Screen Protector for iPhone 4s (Anti-Glare)',1,0,20.0,33,0,'1',NULL,NULL,20.0),(60,'2SC0101','DEX Screen Protector for iPhone 4s (Anti-Glare)',1,0,20.0,34,0,'1',NULL,NULL,20.0),(61,'2SC0101','DEX Screen Protector for iPhone 4s (Anti-Glare)',1,0,20.0,35,0,'1',NULL,NULL,20.0),(62,'2SC0101','DEX Screen Protector for iPhone 4s (Anti-Glare)',1,0,20.0,36,0,'1',NULL,NULL,20.0);
/*!40000 ALTER TABLE `invoicedetail` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `invoicestate`
--

DROP TABLE IF EXISTS `invoicestate`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `invoicestate` (
  `invoiceState_no` int(10) NOT NULL AUTO_INCREMENT,
  `invoiceStateName` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`invoiceState_no`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `invoicestate`
--

LOCK TABLES `invoicestate` WRITE;
/*!40000 ALTER TABLE `invoicestate` DISABLE KEYS */;
INSERT INTO `invoicestate` VALUES (1,'完結 - 銷售單'),(2,'單據無效'),(3,'完結 - 退貨單'),(4,'完結 - 銷售單(有退貨)'),(7,'6963');
/*!40000 ALTER TABLE `invoicestate` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `invoicetype`
--

DROP TABLE IF EXISTS `invoicetype`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `invoicetype` (
  `invoiceType_no` tinyint(2) NOT NULL AUTO_INCREMENT,
  `typeName` varchar(20) DEFAULT NULL,
  `typeShort` varchar(2) DEFAULT NULL,
  PRIMARY KEY (`invoiceType_no`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `invoicetype`
--

LOCK TABLES `invoicetype` WRITE;
/*!40000 ALTER TABLE `invoicetype` DISABLE KEYS */;
INSERT INTO `invoicetype` VALUES (1,'發票 Invoice','S'),(2,'退貨單 Return','R'),(3,'換貨單 Exchange','X');
/*!40000 ALTER TABLE `invoicetype` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `payment`
--

DROP TABLE IF EXISTS `payment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `payment` (
  `payment_no` smallint(4) NOT NULL AUTO_INCREMENT,
  `paymentName` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`payment_no`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `payment`
--

LOCK TABLES `payment` WRITE;
/*!40000 ALTER TABLE `payment` DISABLE KEYS */;
INSERT INTO `payment` VALUES (1,'現金'),(2,'EPS'),(3,'信用卡'),(4,'八達通'),(5,'Other');
/*!40000 ALTER TABLE `payment` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `payment_has_invoice`
--

DROP TABLE IF EXISTS `payment_has_invoice`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `payment_has_invoice` (
  `invoice_no` int(10) NOT NULL,
  `payment_no` smallint(4) NOT NULL,
  `money` decimal(7,1) DEFAULT NULL,
  KEY `phi_fk_invoice` (`invoice_no`),
  KEY `phi_fk_payment` (`payment_no`),
  CONSTRAINT `phi_fk_invoice` FOREIGN KEY (`invoice_no`) REFERENCES `invoice` (`invoice_no`) ON DELETE NO ACTION ON UPDATE CASCADE,
  CONSTRAINT `phi_fk_payment` FOREIGN KEY (`payment_no`) REFERENCES `payment` (`payment_no`) ON DELETE NO ACTION ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `payment_has_invoice`
--

LOCK TABLES `payment_has_invoice` WRITE;
/*!40000 ALTER TABLE `payment_has_invoice` DISABLE KEYS */;
INSERT INTO `payment_has_invoice` VALUES (23,1,4918.0),(24,1,4898.0),(25,1,300.0),(26,1,300.0),(27,1,20.0),(28,1,20.0),(29,1,20.0),(30,1,20.0),(31,1,20.0),(32,1,20.0),(33,1,20.0),(34,1,20.0),(35,1,20.0),(36,2,20.0);
/*!40000 ALTER TABLE `payment_has_invoice` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `permission`
--

DROP TABLE IF EXISTS `permission`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `permission` (
  `permission_no` int(10) NOT NULL AUTO_INCREMENT,
  `invoice_perm` tinyint(2) DEFAULT NULL,
  `po_perm` tinyint(2) DEFAULT NULL,
  `masterRecord_perm` tinyint(2) DEFAULT NULL,
  `transOrder_perm` tinyint(2) DEFAULT NULL,
  `member_perm` tinyint(2) DEFAULT NULL,
  `stockIn_perm` tinyint(2) DEFAULT NULL,
  PRIMARY KEY (`permission_no`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `permission`
--

LOCK TABLES `permission` WRITE;
/*!40000 ALTER TABLE `permission` DISABLE KEYS */;
INSERT INTO `permission` VALUES (1,1,1,1,1,1,1);
/*!40000 ALTER TABLE `permission` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `phone`
--

DROP TABLE IF EXISTS `phone`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `phone` (
  `phone_no` int(10) NOT NULL AUTO_INCREMENT,
  `IMEI` varchar(15) NOT NULL,
  `phoneType_no` smallint(5) DEFAULT NULL,
  `retailShop_no` smallint(4) DEFAULT NULL,
  `phoneState_no` tinyint(1) DEFAULT NULL,
  `poDetail_no` int(10) DEFAULT NULL,
  `rec_date` datetime DEFAULT NULL,
  `sinno_ref_no` int(11) DEFAULT NULL,
  `iprice` decimal(7,1) DEFAULT NULL,
  PRIMARY KEY (`phone_no`,`IMEI`),
  UNIQUE KEY `IMEI_UNIQUE` (`IMEI`)
) ENGINE=InnoDB AUTO_INCREMENT=115 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `phone`
--

LOCK TABLES `phone` WRITE;
/*!40000 ALTER TABLE `phone` DISABLE KEYS */;
INSERT INTO `phone` VALUES (44,'155555555555555',2,2,2,61,'2011-12-26 21:43:32',6,NULL),(45,'111111111111111',2,9999,1,61,'2011-12-26 21:43:32',6,NULL),(46,'166666666666666',2,2,1,61,'2011-12-26 21:43:32',6,NULL),(47,'100000000000000',2,2,1,61,'2011-12-26 21:43:32',6,NULL),(48,'144444444444444',2,2,1,61,'2011-12-26 21:43:32',6,NULL),(49,'133333333333333',2,2,1,61,'2011-12-26 21:43:32',6,NULL),(50,'122222222222222',2,2,1,61,'2011-12-26 21:43:32',6,NULL),(51,'177777777777777',2,2,1,61,'2011-12-26 21:43:32',6,NULL),(52,'188888888888888',2,2,1,61,'2011-12-26 21:43:32',6,NULL),(53,'199999999999999',2,2,1,61,'2011-12-26 21:43:32',6,NULL),(54,'211111111111111',2,2,1,62,'2011-12-26 21:52:31',7,NULL),(55,'244444444444444',2,2,1,62,'2011-12-26 21:53:19',7,NULL),(56,'233333333333333',2,2,1,62,'2011-12-26 21:53:20',7,NULL),(57,'277777777777777',2,2,1,62,'2011-12-26 21:53:20',7,NULL),(58,'266666666666666',2,2,1,62,'2011-12-26 21:53:20',7,NULL),(59,'255555555555555',2,2,1,62,'2011-12-26 21:53:20',7,NULL),(60,'222222222222222',2,2,1,62,'2011-12-26 21:53:20',7,NULL),(61,'288888888888888',2,2,1,62,'2011-12-26 21:53:20',7,NULL),(62,'299999999999999',2,2,1,62,'2011-12-26 21:53:20',7,NULL),(63,'300000000000000',2,2,1,62,'2011-12-26 21:53:20',7,NULL),(64,'611111111111111',2,2,1,63,'2011-12-26 22:45:01',8,NULL),(65,'622222222222222',2,2,1,63,'2011-12-26 22:45:01',8,NULL),(66,'666666666666666',2,2,1,63,'2011-12-26 22:45:01',8,NULL),(67,'655555555555555',2,2,1,63,'2011-12-26 22:45:01',8,NULL),(68,'677777777777777',2,2,1,63,'2011-12-26 22:45:01',8,NULL),(69,'644444444444444',2,2,1,63,'2011-12-26 22:45:01',8,NULL),(70,'633333333333333',2,2,1,63,'2011-12-26 22:45:01',8,NULL),(71,'688888888888888',2,2,1,63,'2011-12-26 22:45:01',8,NULL),(72,'699999999999999',2,2,1,63,'2011-12-26 22:45:01',8,NULL),(73,'700000000000000',2,2,1,63,'2011-12-26 22:45:01',8,NULL),(74,'165165165165165',2,2,1,64,'2011-12-26 22:46:40',9,NULL),(75,'111111111111119',2,2,1,64,'2011-12-26 23:07:16',9,NULL),(76,'811111111111111',2,1,2,64,'2011-12-27 04:10:24',9,NULL),(77,'984111111111111',2,2,1,64,'2011-12-27 04:10:24',9,NULL),(78,'866666666666666',2,2,1,64,'2011-12-27 04:10:24',9,NULL),(79,'555555555555555',2,2,1,64,'2011-12-27 04:10:25',9,NULL),(80,'123555555555555',2,2,1,64,'2011-12-27 04:10:25',9,NULL),(81,'854444444444444',2,9999,1,64,'2011-12-27 04:10:25',9,NULL),(82,'766666666666666',2,9999,1,64,'2011-12-27 04:10:25',9,NULL),(83,'156666666666666',2,9999,1,64,'2011-12-27 04:10:25',9,NULL),(84,'444444444444444',2,9999,1,67,'2011-12-28 06:48:39',12,NULL),(85,'325555555555555',2,9999,1,67,'2011-12-28 06:48:39',12,NULL),(86,'546666666666666',2,1,1,67,'2011-12-28 06:48:39',12,NULL),(87,'985555555555555',2,1,2,67,'2011-12-28 06:48:40',12,NULL),(88,'984444444444444',2,1,2,67,'2011-12-28 06:48:40',12,NULL),(89,'225952633226232',2,1,2,69,'2011-12-28 07:08:30',14,NULL),(90,'561612312313132',2,1,2,70,'2011-12-28 07:27:51',15,NULL),(91,'651651321321321',2,1,2,70,'2011-12-28 07:27:51',15,NULL),(92,'651651651326451',2,2,1,71,'2011-12-28 11:10:11',16,NULL),(93,'651456354156435',2,1,2,71,'2011-12-28 11:10:11',16,NULL),(94,'333444555666777',2,1,2,72,'2012-01-15 06:04:16',17,5000.0),(95,'666777888999000',2,1,1,73,'2012-01-15 06:07:12',18,5000.0),(96,'111122223333333',2,1,1,83,'2012-01-15 06:24:57',19,5000.0),(97,'951111111111111',2,1,1,105,'2012-01-15 06:30:20',20,4000.0),(98,'156975321321321',2,1,1,105,'2012-01-15 06:39:07',20,4000.0),(99,'111115555555555',2,1,1,105,'2012-01-15 06:44:50',20,4000.0),(100,'951456853247999',2,1,1,105,'2012-01-15 06:45:30',20,4000.0),(101,'651651651651651',2,1,1,105,'2012-01-15 06:45:47',20,4000.0),(102,'231651456165465',2,1,1,105,'2012-01-15 06:45:47',20,4000.0),(103,'888888888888555',2,1,1,74,'2012-01-15 07:15:06',21,5000.0),(104,'662626662266666',2,1,1,77,'2012-01-15 07:21:46',22,5000.0),(105,'626566666666666',2,2,1,79,'2012-01-15 07:22:34',23,5000.0),(106,'516516516515655',2,2,1,87,'2012-01-15 07:23:41',24,5000.0),(107,'651651561561511',2,2,1,99,'2012-01-15 07:24:11',25,5000.0),(108,'511111111155555',2,2,1,75,'2012-01-15 07:25:25',26,5000.0),(109,'165165156111231',2,2,1,76,'2012-01-15 07:28:12',27,5000.0),(110,'151561651651514',1,2,2,106,'2012-01-15 07:52:01',28,6000.0),(111,'165165165165161',2,2,1,105,'2012-01-15 12:16:52',20,4000.0),(112,'194987877878797',2,2,1,105,'2012-01-15 12:17:04',20,4000.0),(113,'665165165165165',2,2,1,105,'2012-01-15 12:17:04',20,4000.0),(114,'198498789494984',2,2,1,105,'2012-01-15 12:17:04',20,4000.0);
/*!40000 ALTER TABLE `phone` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `phonestate`
--

DROP TABLE IF EXISTS `phonestate`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `phonestate` (
  `phoneState_no` int(11) NOT NULL AUTO_INCREMENT,
  `phoneStateName` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`phoneState_no`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `phonestate`
--

LOCK TABLES `phonestate` WRITE;
/*!40000 ALTER TABLE `phonestate` DISABLE KEYS */;
INSERT INTO `phonestate` VALUES (1,'發售'),(2,'售出'),(3,'退回');
/*!40000 ALTER TABLE `phonestate` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `phonetype`
--

DROP TABLE IF EXISTS `phonetype`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `phonetype` (
  `phoneType_no` smallint(5) NOT NULL AUTO_INCREMENT,
  `manufacturer` varchar(50) DEFAULT NULL,
  `color` varchar(10) DEFAULT NULL,
  `phone_name` varchar(20) DEFAULT NULL,
  `phonetype_id` varchar(10) DEFAULT NULL,
  `oprice` decimal(7,1) DEFAULT NULL,
  `sprice` decimal(7,1) DEFAULT NULL,
  `productState_no` tinyint(1) DEFAULT NULL,
  `description` text,
  PRIMARY KEY (`phoneType_no`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `phonetype`
--

LOCK TABLES `phonetype` WRITE;
/*!40000 ALTER TABLE `phonetype` DISABLE KEYS */;
INSERT INTO `phonetype` VALUES (1,'SAMSUNG','white','GALAXY NOTE','TD001',6000.0,4998.0,2,'Network:WCDMA 900/2100MHz GSM 850/900/1800/1900MHz'),(2,'APPLE','white','IPHONE 4S','TD002',6900.0,4898.0,2,NULL),(3,'SAMSUNG','white','GALAXY S II','TD003',7200.0,4200.0,1,NULL),(4,'APPLE','N/A','I PHONE 4','TD004',8990.0,4800.0,1,NULL),(5,'HTC','N/A','EVO','TD005',8900.0,8800.0,2,NULL),(6,'HTC','white','EVO 3D','TD006',9000.0,8890.0,2,NULL),(7,'Nokia','N/A','N8','TD007',5000.0,4600.0,2,NULL),(8,'Motola','BLACK','ATRIX','TD008',6000.0,6000.0,2,NULL),(9,'Nokia','N/A','N8(Walker)','TD009',5600.0,5600.0,2,NULL),(10,'Motola','N/A','A1680','TD010',7000.0,7000.0,1,NULL),(11,'Apple','white','IPHONE 5','TD011',10200.0,10200.0,1,NULL),(12,'HTC','N/A','EVO 2D','TD012',4000.0,4000.0,1,NULL);
/*!40000 ALTER TABLE `phonetype` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `po`
--

DROP TABLE IF EXISTS `po`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `po` (
  `po_no` int(10) NOT NULL AUTO_INCREMENT,
  `createDate` datetime DEFAULT NULL,
  `staff_no` int(10) DEFAULT NULL,
  `retailShop_no` smallint(4) DEFAULT NULL,
  `poState_no` smallint(4) DEFAULT NULL,
  `supplier_no` smallint(6) DEFAULT NULL,
  `modify_by` int(10) DEFAULT NULL,
  `po_desc` text,
  `modify_date` datetime DEFAULT NULL,
  PRIMARY KEY (`po_no`),
  KEY `po_fk_staff` (`staff_no`),
  KEY `po_fk_retailShop` (`retailShop_no`),
  KEY `po_fk_poState` (`poState_no`),
  KEY `po_fk_sp` (`supplier_no`),
  CONSTRAINT `po_fk_poState` FOREIGN KEY (`poState_no`) REFERENCES `postate` (`poState_no`) ON DELETE NO ACTION ON UPDATE CASCADE,
  CONSTRAINT `po_fk_retailShop` FOREIGN KEY (`retailShop_no`) REFERENCES `retailshop` (`retailShop_no`) ON DELETE NO ACTION ON UPDATE CASCADE,
  CONSTRAINT `po_fk_sp` FOREIGN KEY (`supplier_no`) REFERENCES `supplier` (`supplier_no`) ON DELETE NO ACTION ON UPDATE CASCADE,
  CONSTRAINT `po_fk_staff` FOREIGN KEY (`staff_no`) REFERENCES `staff` (`staff_no`) ON DELETE NO ACTION ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=83 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `po`
--

LOCK TABLES `po` WRITE;
/*!40000 ALTER TABLE `po` DISABLE KEYS */;
INSERT INTO `po` VALUES (28,'2011-12-25 03:59:32',1,1,3,3,1,'','2011-12-25 04:00:03'),(29,'2011-12-25 23:07:26',1,1,3,2,1,'','2011-12-25 23:07:48'),(30,'2011-12-26 13:21:54',1,1,3,2,1,'','2011-12-26 13:22:41'),(31,'2011-12-26 14:18:56',1,1,3,7,1,'','2011-12-26 14:21:33'),(32,'2011-12-26 14:23:49',1,1,3,3,1,'','2011-12-26 14:24:54'),(33,'2011-12-26 15:10:48',1,1,3,3,1,'','2011-12-26 15:20:42'),(34,'2011-12-26 15:22:40',1,1,3,5,1,'','2011-12-26 15:23:18'),(35,'2011-12-26 15:23:53',1,1,3,7,1,'','2011-12-26 21:47:13'),(36,'2011-12-26 21:38:29',1,1,3,3,1,'','2011-12-26 21:53:20'),(37,'2011-12-26 22:44:18',1,1,3,3,1,'','2011-12-27 04:10:24'),(38,'2011-12-27 03:43:07',1,1,3,3,1,'','2011-12-27 03:44:17'),(39,'2011-12-27 04:53:58',1,1,3,2,1,'','2011-12-27 04:54:07'),(40,'2011-12-28 06:48:05',1,1,3,2,1,'','2011-12-28 06:48:39'),(41,'2011-12-28 07:07:08',1,1,3,3,1,'','2011-12-28 07:07:26'),(42,'2011-12-28 07:08:16',1,1,3,5,1,'','2011-12-28 07:08:30'),(43,'2011-12-28 07:27:31',1,1,3,3,1,'','2011-12-28 07:27:51'),(44,'2011-12-28 11:09:44',1,1,3,9,1,'','2011-12-28 11:10:12'),(45,'2011-12-29 19:59:26',1,1,1,3,NULL,NULL,NULL),(46,'2011-12-30 05:22:45',1,1,1,3,NULL,NULL,NULL),(47,'2011-12-30 05:43:49',1,1,1,2,NULL,NULL,NULL),(48,'2011-12-30 05:49:07',1,1,1,2,NULL,NULL,NULL),(49,'2011-12-30 13:33:10',1,1,3,7,1,'','2012-01-15 07:28:12'),(50,'2011-12-30 14:28:03',1,1,1,3,NULL,NULL,NULL),(51,'2011-12-30 17:23:41',1,1,1,3,NULL,NULL,NULL),(52,'2011-12-30 17:28:52',1,1,1,2,NULL,NULL,NULL),(53,'2011-12-30 17:37:16',1,1,1,3,NULL,NULL,NULL),(54,'2011-12-30 17:55:43',1,1,1,2,NULL,NULL,NULL),(55,'2011-12-30 17:57:22',1,1,1,2,NULL,NULL,NULL),(56,'2011-12-30 17:58:14',1,1,1,2,NULL,NULL,NULL),(57,'2011-12-30 18:00:18',1,1,1,5,NULL,NULL,NULL),(58,'2011-12-30 18:07:30',1,1,1,2,NULL,NULL,NULL),(59,'2011-12-30 18:19:33',1,1,1,7,NULL,NULL,NULL),(60,'2011-12-30 18:21:05',1,1,1,3,NULL,NULL,NULL),(61,'2011-12-30 19:35:29',1,1,1,2,NULL,NULL,NULL),(62,'2011-12-30 19:35:57',1,1,1,2,NULL,NULL,NULL),(63,'2011-12-30 19:41:57',1,1,1,2,NULL,NULL,NULL),(64,'2011-12-30 19:42:42',1,1,1,2,NULL,NULL,NULL),(65,'2011-12-30 19:43:06',1,1,1,5,NULL,NULL,NULL),(66,'2011-12-30 19:43:48',1,1,1,3,NULL,NULL,NULL),(67,'2011-12-30 19:45:03',1,1,1,3,NULL,NULL,NULL),(68,'2011-12-30 19:45:57',1,1,1,3,NULL,NULL,NULL),(69,'2011-12-30 20:44:16',1,1,1,3,NULL,NULL,NULL),(70,'2011-12-30 20:45:17',1,1,3,9,1,'','2012-01-15 12:31:33'),(71,'2011-12-30 20:45:48',1,1,3,8,1,'','2012-01-15 12:30:46'),(72,'2011-12-31 09:56:49',1,1,1,3,NULL,NULL,NULL),(73,'2011-12-31 10:24:54',1,1,1,3,NULL,NULL,NULL),(74,'2011-12-31 10:28:28',1,1,1,3,NULL,NULL,NULL),(75,'2011-12-31 10:29:15',1,1,1,10,NULL,NULL,NULL),(76,'2011-12-31 10:30:22',1,1,1,9,NULL,NULL,NULL),(77,'2011-12-31 10:31:19',1,1,3,2,1,'','2012-01-15 12:30:32'),(78,'2011-12-31 10:48:54',1,1,1,3,NULL,NULL,NULL),(79,'2012-01-15 06:29:16',1,1,3,1,1,'','2012-01-15 12:17:04'),(80,'2012-01-15 06:32:00',1,1,2,10,1,'','2012-01-15 07:52:01'),(81,'2012-01-15 12:18:04',1,1,3,2,1,'','2012-01-15 12:27:04'),(82,'2012-01-16 20:47:50',1,1,1,3,NULL,NULL,NULL);
/*!40000 ALTER TABLE `po` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `podetail`
--

DROP TABLE IF EXISTS `podetail`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `podetail` (
  `poDetail_no` int(10) NOT NULL AUTO_INCREMENT,
  `qty` smallint(5) DEFAULT NULL,
  `cost` decimal(7,1) DEFAULT NULL,
  `po_no` int(10) DEFAULT NULL,
  `phonetype_no` smallint(5) DEFAULT NULL,
  `acc_no` int(10) DEFAULT NULL,
  PRIMARY KEY (`poDetail_no`),
  KEY `pod_fk_po` (`po_no`),
  KEY `pod_fk_acc` (`acc_no`),
  CONSTRAINT `pod_fk_acc` FOREIGN KEY (`acc_no`) REFERENCES `accessories` (`acc_no`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `pod_fk_po` FOREIGN KEY (`po_no`) REFERENCES `po` (`po_no`) ON DELETE NO ACTION ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=110 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `podetail`
--

LOCK TABLES `podetail` WRITE;
/*!40000 ALTER TABLE `podetail` DISABLE KEYS */;
INSERT INTO `podetail` VALUES (51,50,50.0,28,NULL,3),(52,50,30.0,28,NULL,4),(53,10,20.0,29,NULL,3),(54,10,5.0,29,NULL,4),(55,10,20.0,30,NULL,3),(56,10,20.0,31,NULL,3),(57,10,20.0,32,NULL,3),(58,30,20.0,33,NULL,3),(59,20,20.0,34,NULL,3),(60,20,20.0,35,NULL,3),(61,10,5000.0,36,1,NULL),(62,10,5000.0,36,2,NULL),(63,10,5000.0,37,1,NULL),(64,10,5000.0,37,2,NULL),(65,10,20.0,38,NULL,3),(66,1,20.0,39,NULL,3),(67,5,5000.0,40,2,NULL),(68,1,5000.0,41,2,NULL),(69,1,5000.0,42,2,NULL),(70,2,5000.0,43,2,NULL),(71,2,5000.0,44,2,NULL),(72,1,5000.0,45,2,NULL),(73,1,5000.0,46,2,NULL),(74,1,5000.0,47,2,NULL),(75,1,5000.0,48,2,NULL),(76,1,5000.0,49,2,NULL),(77,1,5000.0,51,2,NULL),(78,1,5000.0,52,2,NULL),(79,1,5000.0,53,2,NULL),(80,1,5000.0,54,2,NULL),(81,1,5000.0,55,2,NULL),(82,1,5000.0,56,2,NULL),(83,1,5000.0,57,2,NULL),(84,1,5000.0,58,2,NULL),(85,1,5000.0,59,2,NULL),(86,1,5000.0,60,2,NULL),(87,1,5000.0,61,2,NULL),(88,1,5000.0,62,2,NULL),(89,1,5000.0,63,2,NULL),(90,1,5000.0,64,2,NULL),(91,1,5000.0,65,2,NULL),(92,1,5000.0,66,2,NULL),(93,1,5000.0,67,2,NULL),(94,1,5000.0,68,2,NULL),(95,1,5000.0,69,2,NULL),(96,10,20.0,70,NULL,3),(97,12,20.0,71,NULL,3),(98,112,20.0,72,NULL,3),(99,1,5000.0,73,2,NULL),(100,1,5000.0,74,2,NULL),(101,1,5000.0,75,2,NULL),(102,1,5000.0,76,2,NULL),(103,12,20.0,77,NULL,3),(104,1,5000.0,78,2,NULL),(105,10,4000.0,79,2,NULL),(106,10,6000.0,80,1,NULL),(107,12,4000.0,80,2,NULL),(108,10,10.0,81,NULL,4),(109,1,10.0,82,NULL,5);
/*!40000 ALTER TABLE `podetail` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `postate`
--

DROP TABLE IF EXISTS `postate`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `postate` (
  `poState_no` smallint(4) NOT NULL AUTO_INCREMENT,
  `stateName` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`poState_no`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `postate`
--

LOCK TABLES `postate` WRITE;
/*!40000 ALTER TABLE `postate` DISABLE KEYS */;
INSERT INTO `postate` VALUES (1,'開啟 -- 等待到貨'),(2,'未完成 -- 貨只收了一部份'),(3,'完結-- 貨全部收到'),(4,'完結-- 強制完結');
/*!40000 ALTER TABLE `postate` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `productstate`
--

DROP TABLE IF EXISTS `productstate`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `productstate` (
  `productState_no` tinyint(1) NOT NULL AUTO_INCREMENT,
  `stateName` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`productState_no`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `productstate`
--

LOCK TABLES `productstate` WRITE;
/*!40000 ALTER TABLE `productstate` DISABLE KEYS */;
INSERT INTO `productstate` VALUES (1,'停售'),(2,'發售');
/*!40000 ALTER TABLE `productstate` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `retailshop`
--

DROP TABLE IF EXISTS `retailshop`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `retailshop` (
  `retailShop_no` smallint(4) NOT NULL AUTO_INCREMENT,
  `retail_id` varchar(15) DEFAULT NULL,
  `addr` varchar(255) DEFAULT NULL,
  `phone` varchar(15) DEFAULT NULL,
  `fax` varchar(15) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `location` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`retailShop_no`)
) ENGINE=InnoDB AUTO_INCREMENT=10000 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `retailshop`
--

LOCK TABLES `retailshop` WRITE;
/*!40000 ALTER TABLE `retailshop` DISABLE KEYS */;
INSERT INTO `retailshop` VALUES (1,'OFFICE','OFFICE','21213654','21213655','OFFICE','NT'),(2,'FTEC01','荃灣青山公路264-298號南豐中心1樓A014號舖','24150962','24138231','bcca@hthk.com','荃灣'),(3,'FTEC15','荃灣沙咀道260 - 276號廣發大廈地下5號舖','24395304','24151191','ftec15@hthk.com','荃灣'),(4,'FTEC20','荃灣大河道22-28號榮安大廈地下 A1舖','24171761','21532706','ftec20@hthk.com','荃灣'),(5,'FTEC02','馬鞍山 新港城中心商場 2樓 2202號舖','26338023','26338026','bccb@hthk.com','馬鞍山'),(6,'FTECS03','馬鞍山馬鞍山廣場3樓3343-363號舖百佳Stall A','26336380','26333162','ftecs03@hthk.com','馬鞍山'),(7,'FTEC10','大埔安慈路昌運中心地下24-25 號舖','26647923','26644505','bcch@hthk.com','大埔'),(8,'FTECS02','大埔安慈路昌運中心1樓54 號舖','21533186','21533187','ftecs02@hthk.com','大埔'),(9,'FTEC17','上水彩園路8號彩園商場中心3樓11號舖','26397728','26717887','ftec17@hthk.com','上水'),(10,'FTEC18','屯門屯門市廣場1期2樓2050, 2051, 2055-2056 號舖','24522075','24501043','ftec18@hthk.com','屯門'),(11,'FTEC13','沙田沙田廣場3樓2A-2B鋪','26963449','26947252','bcck@hthk.com','沙田'),(12,'FTEC23','元朗康景街3-19 號地下E 號舖','24422778','24430300','ftec23@hthk.com','元朗'),(13,'FTEC09','鑽石山荷里活廣場2樓224號舖','23210426','29559681','bccg@hthk.com','鑽石山'),(14,'FTEC12','土瓜灣道78號 定安大廈地下 4 號舖','21421632','21429157','bccj@hthk.com','土瓜灣'),(15,'FTEC21','土瓜灣北帝街105A 號舖','21533276','21533278','ftec21@hthk.com','土瓜灣'),(16,'FTEC16','長沙灣青山道170號宇宙商場G14號舖','31882998','31882908','ftec16@hthk.com','長沙灣'),(17,'FTECS06','尖沙咀彌敦道178號均樂大廈地下178C鋪','21539682','21539683','ftecs06@hthk.com','尖沙咀'),(18,'FTECS08','九龍灣淘大商場2樓S71, 72號舖','21533370','21533371','ftecs08@hthk.com','牛頭角'),(19,'FTEC08','北角英皇道177-191A號利都樓地下B, C號舖','28071631','25109015','bccf@hthk.com','北角'),(20,'FTEC11','柴灣新翠商場1 樓118 號舖','25571995','25572517','bcci@hthk.com','柴灣'),(21,'FTEC22','香港仔南寧街19-23 號香港仔中心一期地下1A 號舖','25188060','25180958','ftec22@hthk.com','香港仔'),(9999,'Transferring',NULL,NULL,NULL,NULL,NULL);
/*!40000 ALTER TABLE `retailshop` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `retailshop_ass`
--

DROP TABLE IF EXISTS `retailshop_ass`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `retailshop_ass` (
  `retailShop_no` smallint(4) NOT NULL,
  `acc_no` int(10) NOT NULL,
  `qty` smallint(6) DEFAULT NULL,
  `poDetail_no` int(10) DEFAULT NULL,
  `po_date` datetime DEFAULT NULL,
  KEY `rsa_fk_retailShop` (`retailShop_no`),
  KEY `rsa_fk_ass` (`acc_no`),
  CONSTRAINT `rsa_fk_acc` FOREIGN KEY (`acc_no`) REFERENCES `accessories` (`acc_no`) ON DELETE NO ACTION ON UPDATE CASCADE,
  CONSTRAINT `rsa_fk_retailShop` FOREIGN KEY (`retailShop_no`) REFERENCES `retailshop` (`retailShop_no`) ON DELETE NO ACTION ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `retailshop_ass`
--

LOCK TABLES `retailshop_ass` WRITE;
/*!40000 ALTER TABLE `retailshop_ass` DISABLE KEYS */;
INSERT INTO `retailshop_ass` VALUES (1,1,0,5,'2011-10-19 12:29:17'),(1,1,9,6,'2011-10-19 12:36:07');
/*!40000 ALTER TABLE `retailshop_ass` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sinno_ref`
--

DROP TABLE IF EXISTS `sinno_ref`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sinno_ref` (
  `sinno_ref_no` int(11) NOT NULL AUTO_INCREMENT,
  `stockin_no` int(11) DEFAULT NULL,
  `pod_no` int(11) DEFAULT NULL,
  `createDate` datetime DEFAULT NULL,
  `createBy` int(11) DEFAULT NULL,
  PRIMARY KEY (`sinno_ref_no`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sinno_ref`
--

LOCK TABLES `sinno_ref` WRITE;
/*!40000 ALTER TABLE `sinno_ref` DISABLE KEYS */;
INSERT INTO `sinno_ref` VALUES (11,1,66,'2011-12-27 04:54:07',1),(15,1,70,'2011-12-28 07:27:51',1),(16,1,71,'2011-12-28 11:10:11',1),(17,1,72,'2012-01-15 06:04:14',1),(18,1,73,'2012-01-15 06:07:11',1),(19,1,83,'2012-01-15 06:24:57',1),(20,1,105,'2012-01-15 06:30:20',1),(21,1,74,'2012-01-15 07:15:06',1),(22,1,77,'2012-01-15 07:21:46',1),(23,1,79,'2012-01-15 07:22:34',1),(24,1,87,'2012-01-15 07:23:41',1),(25,1,99,'2012-01-15 07:24:11',1),(26,1,75,'2012-01-15 07:25:25',1),(27,1,76,'2012-01-15 07:28:12',1),(28,1,106,'2012-01-15 07:52:01',1),(29,1,108,'2012-01-15 12:22:14',1),(30,1,103,'2012-01-15 12:30:32',1),(31,1,97,'2012-01-15 12:30:46',1),(32,1,96,'2012-01-15 12:31:33',1);
/*!40000 ALTER TABLE `sinno_ref` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `staff`
--

DROP TABLE IF EXISTS `staff`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `staff` (
  `staff_no` int(10) NOT NULL AUTO_INCREMENT,
  `staff_id` varchar(4) DEFAULT NULL,
  `pwd` varchar(14) DEFAULT NULL,
  `name` varchar(45) DEFAULT NULL,
  `resign` tinyint(1) DEFAULT NULL,
  `staffType_no` smallint(4) DEFAULT NULL,
  `permission_no` int(10) DEFAULT NULL,
  PRIMARY KEY (`staff_no`),
  KEY `staff_fk_staffType` (`staffType_no`),
  KEY `staff_fk_permission` (`permission_no`),
  CONSTRAINT `staff_fk_permission` FOREIGN KEY (`permission_no`) REFERENCES `permission` (`permission_no`) ON DELETE NO ACTION ON UPDATE CASCADE,
  CONSTRAINT `staff_fk_staffType` FOREIGN KEY (`staffType_no`) REFERENCES `stafftype` (`staffType_no`) ON DELETE NO ACTION ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `staff`
--

LOCK TABLES `staff` WRITE;
/*!40000 ALTER TABLE `staff` DISABLE KEYS */;
INSERT INTO `staff` VALUES (1,'root','222222','root',NULL,2,1),(2,'nu01','111111','新用戶',NULL,3,NULL),(3,'nu03','rootpass','job',NULL,2,1),(4,'nu04','111111','som',NULL,2,NULL),(5,'u2','111111','nu02',NULL,3,NULL),(6,'7777','rootpass','uy3',NULL,5,NULL),(7,'nu02','999999','333',NULL,1,NULL),(8,'t001','222222','test001',NULL,1,NULL),(9,'t002','222222','test002',NULL,5,NULL),(10,'t003','111111','test003',NULL,6,NULL),(11,'003t','111111','003test',NULL,9,NULL),(12,'3322','222222','002test',NULL,8,NULL),(13,'0033','111111','001test',NULL,8,NULL),(14,'000t','111111','000test',NULL,1,NULL);
/*!40000 ALTER TABLE `staff` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `stafftype`
--

DROP TABLE IF EXISTS `stafftype`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `stafftype` (
  `staffType_no` smallint(4) NOT NULL AUTO_INCREMENT,
  `typeName` varchar(10) DEFAULT NULL,
  `permission_no` int(10) DEFAULT NULL,
  PRIMARY KEY (`staffType_no`),
  KEY `st_fk_permission` (`permission_no`),
  CONSTRAINT `st_fk_permission` FOREIGN KEY (`permission_no`) REFERENCES `permission` (`permission_no`) ON DELETE NO ACTION ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `stafftype`
--

LOCK TABLES `stafftype` WRITE;
/*!40000 ALTER TABLE `stafftype` DISABLE KEYS */;
INSERT INTO `stafftype` VALUES (1,'系統管理員',1),(2,'超級使用者',NULL),(3,'wingStaff',NULL),(4,'cleaner',NULL),(5,'管理人',NULL),(6,'for test',NULL),(7,'for test2',NULL),(8,'for test3',NULL),(9,'for test4',NULL),(10,'testtest',NULL),(11,'',NULL),(12,'',NULL),(13,'',NULL);
/*!40000 ALTER TABLE `stafftype` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `stockin`
--

DROP TABLE IF EXISTS `stockin`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `stockin` (
  `stockIn_no` int(10) NOT NULL AUTO_INCREMENT,
  `poDetail_no` int(11) DEFAULT NULL,
  `staff_no` int(10) DEFAULT NULL,
  `acc_no` int(10) DEFAULT NULL COMMENT 'acc= accessories',
  `retailShop_no` smallint(4) DEFAULT NULL,
  `rec_qty` smallint(5) DEFAULT NULL,
  `rec_date` datetime DEFAULT NULL,
  `po_date` datetime DEFAULT NULL,
  `iprice` decimal(7,1) DEFAULT NULL COMMENT 'iprice= cost',
  `ava_bal` smallint(5) DEFAULT NULL COMMENT 'available balance',
  `trans_qty` smallint(5) DEFAULT '0',
  `sinno_ref_no` int(11) DEFAULT NULL,
  PRIMARY KEY (`stockIn_no`)
) ENGINE=InnoDB AUTO_INCREMENT=207 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `stockin`
--

LOCK TABLES `stockin` WRITE;
/*!40000 ALTER TABLE `stockin` DISABLE KEYS */;
INSERT INTO `stockin` VALUES (185,58,1,3,2,10,'2011-12-26 15:11:00','2011-12-26 15:10:48',20.0,0,0,NULL),(186,58,1,3,2,10,'2011-12-26 15:20:19','2011-12-26 15:10:48',15.0,0,0,NULL),(187,58,1,3,2,3,'2011-12-26 15:20:30','2011-12-26 15:10:48',10.0,0,0,NULL),(188,58,1,3,2,7,'2011-12-26 15:20:42','2011-12-26 15:10:48',5.0,0,0,NULL),(189,59,1,3,2,10,'2011-12-26 15:22:51','2011-12-26 15:22:40',20.0,0,0,NULL),(190,59,1,3,2,10,'2011-12-26 15:23:18','2011-12-26 15:22:40',20.0,0,0,NULL),(191,60,1,3,2,10,'2011-12-26 15:24:00','2011-12-26 15:23:53',20.0,3,0,NULL),(192,60,1,3,2,1,'2011-12-26 15:27:34','2011-12-26 15:23:53',20.0,1,0,NULL),(193,60,1,3,1,1,'2011-12-26 19:56:22','2011-12-26 15:23:53',20.0,1,0,4),(194,60,1,3,1,5,'2011-12-26 20:01:32','2011-12-26 15:23:53',20.0,5,0,4),(195,60,1,3,2,1,'2011-12-26 21:45:05','2011-12-26 15:23:53',20.0,1,0,6),(196,60,1,3,2,2,'2011-12-26 21:47:13','2011-12-26 15:23:53',20.0,2,0,4),(197,65,1,3,1,5,'2011-12-27 03:43:16','2011-12-27 03:43:07',20.0,5,0,10),(198,65,1,3,1,5,'2011-12-27 03:44:17','2011-12-27 03:43:07',20.0,5,0,10),(199,66,1,3,1,1,'2011-12-27 04:54:07','2011-12-27 04:53:58',20.0,1,0,11),(200,108,1,4,2,1,'2012-01-15 12:22:14','2012-01-15 12:18:04',10.0,0,0,29),(201,108,1,4,2,1,'2012-01-15 12:26:52','2012-01-15 12:18:04',10.0,0,0,29),(202,108,1,4,2,7,'2012-01-15 12:26:59','2012-01-15 12:18:04',10.0,0,0,29),(203,108,1,4,2,1,'2012-01-15 12:27:04','2012-01-15 12:18:04',10.0,0,0,29),(204,103,1,3,2,12,'2012-01-15 12:30:32','2011-12-31 10:31:19',20.0,12,0,30),(205,97,1,3,2,12,'2012-01-15 12:30:46','2011-12-30 20:45:48',20.0,12,0,31),(206,96,1,3,2,10,'2012-01-15 12:31:33','2011-12-30 20:45:17',20.0,10,0,32);
/*!40000 ALTER TABLE `stockin` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `supplier`
--

DROP TABLE IF EXISTS `supplier`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `supplier` (
  `supplier_no` smallint(6) NOT NULL AUTO_INCREMENT,
  `supplier_id` varchar(10) DEFAULT NULL,
  `supplierName` varchar(100) DEFAULT NULL,
  `addr` varchar(255) DEFAULT NULL,
  `phone` varchar(15) DEFAULT NULL,
  `fax` varchar(15) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `remark` varchar(20) DEFAULT NULL,
  `hide` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`supplier_no`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `supplier`
--

LOCK TABLES `supplier` WRITE;
/*!40000 ALTER TABLE `supplier` DISABLE KEYS */;
INSERT INTO `supplier` VALUES (1,'12233','TCF company','n/a','n/a','n/a','n/a',NULL,NULL),(2,'5555','JustAName','11103032','12345','2222','qrm@yyy',NULL,0),(3,'OSUK005','another','just address','11111111','','ff4@ggg',NULL,1),(5,'NSHK004','NewOne','addr','111111111','','ff2@ff',NULL,0),(7,'OSSP006','Sorry','Please show it','11111111','','ddd@dd',NULL,1),(8,'NSHK001','仁有限公司','九龍, 九龍塘','27068135','','email@email','12 November 2011',0),(9,'OSUK002','Bird Company Limited','Birds','5555555','','flying@home','test',0),(10,'nshk002','new company','new address','12345678','22345678','mail@mail',NULL,0),(11,'nshk003','HK music Ltd.','彌敦道757號,威明商業大廈','12345678','','mail@mail.com',NULL,0),(12,'3333','362262','6  ','33333333','33333333','',NULL,0);
/*!40000 ALTER TABLE `supplier` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `transdetail`
--

DROP TABLE IF EXISTS `transdetail`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `transdetail` (
  `transDetail_no` int(10) NOT NULL AUTO_INCREMENT,
  `trans_qty` smallint(5) DEFAULT NULL,
  `acc_no` int(10) DEFAULT NULL,
  `IMEI` varchar(15) DEFAULT NULL,
  `transfer_no` int(10) DEFAULT NULL,
  `po_date` datetime DEFAULT NULL,
  PRIMARY KEY (`transDetail_no`),
  KEY `td_fk_trans` (`transfer_no`),
  KEY `td_fk_phone` (`IMEI`),
  KEY `td_fk_ass` (`acc_no`),
  KEY `td_fk_acc` (`acc_no`),
  CONSTRAINT `td_fk_acc` FOREIGN KEY (`acc_no`) REFERENCES `accessories` (`acc_no`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `td_fk_trans` FOREIGN KEY (`transfer_no`) REFERENCES `transfer` (`transfer_no`) ON DELETE NO ACTION ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=87 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `transdetail`
--

LOCK TABLES `transdetail` WRITE;
/*!40000 ALTER TABLE `transdetail` DISABLE KEYS */;
INSERT INTO `transdetail` VALUES (73,30,3,NULL,32,'2011-12-25 03:59:32'),(74,20,4,NULL,32,'2011-12-25 03:59:32'),(75,1,NULL,'546666666666666',33,'2011-12-28 06:48:05'),(76,1,NULL,'984111111111111',34,'2011-12-26 22:44:18'),(77,1,NULL,'866666666666666',35,'2011-12-26 22:44:18'),(78,1,NULL,'555555555555555',36,'2011-12-26 22:44:18'),(79,1,NULL,'123555555555555',37,'2011-12-26 22:44:18'),(80,1,NULL,'766666666666666',38,'2011-12-26 22:44:18'),(81,1,NULL,'651651651326451',39,'2011-12-28 11:09:44'),(82,1,NULL,'854444444444444',40,'2011-12-26 22:44:18'),(83,1,NULL,'156666666666666',41,'2011-12-26 22:44:18'),(84,1,NULL,'444444444444444',42,'2011-12-28 06:48:05'),(85,1,NULL,'325555555555555',43,'2011-12-28 06:48:05'),(86,1,NULL,'111111111111111',44,'2011-12-26 21:38:29');
/*!40000 ALTER TABLE `transdetail` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `transfer`
--

DROP TABLE IF EXISTS `transfer`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `transfer` (
  `transfer_no` int(10) NOT NULL AUTO_INCREMENT,
  `transDate` datetime DEFAULT NULL,
  `receiveDate` datetime DEFAULT NULL,
  `fromRetail_no` varchar(5) DEFAULT NULL,
  `toRetail_no` varchar(5) DEFAULT NULL,
  `staff_no` int(10) DEFAULT NULL,
  `transState_no` smallint(4) DEFAULT NULL,
  `tranReson` varchar(30) DEFAULT NULL,
  `confirmBy` varchar(4) DEFAULT NULL,
  PRIMARY KEY (`transfer_no`),
  KEY `trans_fk_transState` (`transState_no`),
  KEY `trans_fk_staff` (`staff_no`),
  CONSTRAINT `trans_fk_staff` FOREIGN KEY (`staff_no`) REFERENCES `staff` (`staff_no`) ON DELETE NO ACTION ON UPDATE CASCADE,
  CONSTRAINT `trans_fk_transState` FOREIGN KEY (`transState_no`) REFERENCES `transstate` (`transState_no`) ON DELETE NO ACTION ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=45 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `transfer`
--

LOCK TABLES `transfer` WRITE;
/*!40000 ALTER TABLE `transfer` DISABLE KEYS */;
INSERT INTO `transfer` VALUES (32,'2011-12-25 04:03:51',NULL,'1','2',1,2,'普通轉貨',NULL),(33,'2011-12-31 08:18:51',NULL,'1','2',1,3,'普通轉貨',NULL),(34,'2011-12-31 10:36:10',NULL,'1','2',1,2,'普通轉貨',NULL),(35,'2011-12-31 10:40:20',NULL,'1','2',1,2,'普通轉貨',NULL),(36,'2011-12-31 10:41:17',NULL,'1','2',1,2,'普通轉貨',NULL),(37,'2011-12-31 10:44:31',NULL,'1','2',1,2,'普通轉貨',NULL),(38,'2011-12-31 10:51:39',NULL,'1','3',1,1,'普通轉貨',NULL),(39,'2011-12-31 11:10:30',NULL,'1','2',1,2,'普通轉貨',NULL),(40,'2011-12-31 11:11:26',NULL,'1','2',1,1,'普通轉貨',NULL),(41,'2011-12-31 11:34:15',NULL,'1','2',1,1,'普通轉貨',NULL),(42,'2011-12-31 11:40:44',NULL,'1','2',1,1,'普通轉貨',NULL),(43,'2011-12-31 11:42:55',NULL,'1','7',1,1,'普通轉貨',NULL),(44,'2012-01-18 03:41:21',NULL,'2','5',1,1,'普通轉貨',NULL);
/*!40000 ALTER TABLE `transfer` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `transstate`
--

DROP TABLE IF EXISTS `transstate`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `transstate` (
  `transState_no` smallint(4) NOT NULL AUTO_INCREMENT,
  `stateName` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`transState_no`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `transstate`
--

LOCK TABLES `transstate` WRITE;
/*!40000 ALTER TABLE `transstate` DISABLE KEYS */;
INSERT INTO `transstate` VALUES (1,'未收貨'),(2,'已收貨'),(3,'無效');
/*!40000 ALTER TABLE `transstate` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2012-01-18  8:47:38
