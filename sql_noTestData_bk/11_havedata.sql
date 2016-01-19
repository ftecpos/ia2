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
-- Table structure for table `asscessories`
--

DROP TABLE IF EXISTS `asscessories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `asscessories` (
  `asscessories_no` int(10) NOT NULL AUTO_INCREMENT,
  `asscessories_id` varchar(10) DEFAULT NULL,
  `assName` varchar(50) DEFAULT NULL,
  `asscessoriesType_no` smallint(5) DEFAULT NULL,
  `barcode` varchar(13) DEFAULT NULL,
  `color` varchar(10) DEFAULT NULL,
  `manufacturer` varchar(10) DEFAULT NULL,
  `state` varchar(10) DEFAULT NULL,
  `oprice` decimal(7,1) DEFAULT NULL,
  `sprice` decimal(7,1) DEFAULT NULL,
  `productState_no` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`asscessories_no`),
  KEY `ass_fk_assType` (`asscessoriesType_no`),
  KEY `ass_fk_prodState` (`productState_no`),
  CONSTRAINT `ass_fk_assType` FOREIGN KEY (`asscessoriesType_no`) REFERENCES `asscessoriestype` (`asscessoriesType_no`) ON DELETE NO ACTION ON UPDATE CASCADE,
  CONSTRAINT `ass_fk_prodState` FOREIGN KEY (`productState_no`) REFERENCES `productstate` (`productState_no`) ON DELETE NO ACTION ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `asscessories`
--

LOCK TABLES `asscessories` WRITE;
/*!40000 ALTER TABLE `asscessories` DISABLE KEYS */;
INSERT INTO `asscessories` VALUES (1,'id1','ABC SSEE 保護貼 ',1,'3633633666969','red','man1',NULL,30.0,20.0,2),(2,'id_2','GGFG DDS 保護貼',1,'3633633666968','yellow','man2',NULL,30.0,20.0,2),(3,'id2','test',2,'3633633666888','test','man3',NULL,50.0,20.0,2),(4,'id4','test1',3,NULL,'test','man3',NULL,1.0,2.0,2),(5,'id5','test2',4,NULL,'test','man3',NULL,1.0,2.0,2),(6,'id6','test3',5,NULL,'test','man3',NULL,1.0,2.0,2),(7,'id7','test4',1,NULL,'test','man3',NULL,1.0,2.0,2),(8,'id8','test5',2,NULL,'test','man3',NULL,1.0,2.0,2),(9,'id9','test6',3,NULL,'test','man3',NULL,1.0,2.0,2),(10,'id10','test7',4,NULL,'test','man3',NULL,1.0,2.0,2),(11,'id11','test8',1,NULL,'test','man3',NULL,1.0,2.0,1),(12,'id12','test9',2,NULL,'test','man3',NULL,1.0,2.0,2),(13,'id13','test10',3,NULL,'test','man3',NULL,1.0,2.0,2),(14,'id14','test11',4,NULL,'test','man3',NULL,1.0,2.0,1),(15,'id15','test12',1,'','test','man3',NULL,1.0,0.8,2),(16,'id16','test13',2,NULL,'test','man3',NULL,1.0,2.0,2),(17,'id17','test14',3,NULL,'test','man3',NULL,1.0,2.0,1),(18,'id18','test15',1,'122253145','N/A','man3',NULL,120.0,110.0,2);
/*!40000 ALTER TABLE `asscessories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `asscessoriestype`
--

DROP TABLE IF EXISTS `asscessoriestype`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `asscessoriestype` (
  `asscessoriesType_no` smallint(5) NOT NULL AUTO_INCREMENT,
  `typeName` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`asscessoriesType_no`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `asscessoriestype`
--

LOCK TABLES `asscessoriestype` WRITE;
/*!40000 ALTER TABLE `asscessoriestype` DISABLE KEYS */;
INSERT INTO `asscessoriestype` VALUES (1,'保護貼'),(2,'機殼'),(3,'充電器'),(4,'耳機'),(5,'其他 Other'),(6,'test4'),(7,'test5'),(8,'test6'),(9,'test_N'),(10,'test7');
/*!40000 ALTER TABLE `asscessoriestype` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `customer`
--

DROP TABLE IF EXISTS `customer`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `customer` (
  `customer_no` int(10) NOT NULL,
  `customer_id` varchar(10) DEFAULT NULL,
  `name` varchar(45) DEFAULT NULL,
  `addr` varchar(255) DEFAULT NULL,
  `phone` varchar(15) DEFAULT NULL,
  `period` int(15) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `fax` varchar(15) DEFAULT NULL,
  `remark` text,
  PRIMARY KEY (`customer_no`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `customer`
--

LOCK TABLES `customer` WRITE;
/*!40000 ALTER TABLE `customer` DISABLE KEYS */;
INSERT INTO `customer` VALUES (0,'ABC112','test1 test','dslfkdjsfldksjf','25836925',0,'','','');
/*!40000 ALTER TABLE `customer` ENABLE KEYS */;
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
  `customer_no` int(10) DEFAULT NULL,
  `staff_no` int(10) DEFAULT NULL,
  `retailShop_no` smallint(4) DEFAULT NULL,
  `invoiceState_no` int(10) DEFAULT NULL,
  `createBy` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`invoice_no`),
  KEY `invoice_fk_inType` (`invoiceType_no`),
  KEY `invoice_fk_cust` (`customer_no`),
  KEY `invoice_fk_staff` (`staff_no`),
  KEY `invoice_fk_rs` (`retailShop_no`),
  CONSTRAINT `invoice_fk_cust` FOREIGN KEY (`customer_no`) REFERENCES `customer` (`customer_no`) ON DELETE NO ACTION ON UPDATE CASCADE,
  CONSTRAINT `invoice_fk_inType` FOREIGN KEY (`invoiceType_no`) REFERENCES `invoicetype` (`invoiceType_no`) ON DELETE NO ACTION ON UPDATE CASCADE,
  CONSTRAINT `invoice_fk_rs` FOREIGN KEY (`retailShop_no`) REFERENCES `retailshop` (`retailShop_no`) ON DELETE NO ACTION ON UPDATE CASCADE,
  CONSTRAINT `invoice_fk_staff` FOREIGN KEY (`staff_no`) REFERENCES `staff` (`staff_no`) ON DELETE NO ACTION ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `invoice`
--

LOCK TABLES `invoice` WRITE;
/*!40000 ALTER TABLE `invoice` DISABLE KEYS */;
INSERT INTO `invoice` VALUES (1,'2011-10-05 14:13:49',60.0,'N/A',1,NULL,1,1,4,'root'),(2,'2011-10-05 14:13:53',20.0,'1',2,NULL,1,1,3,'root'),(3,'2011-10-05 14:13:53',20.0,'1',2,NULL,1,1,3,'root'),(4,'2011-10-05 14:22:13',20.0,'1',2,NULL,1,1,3,'root'),(5,'2011-10-05 14:22:41',180.0,'N/A',1,NULL,1,1,4,'root'),(6,'2011-10-05 14:22:44',20.0,'5',2,NULL,1,1,3,'root'),(7,'2011-10-05 14:22:44',20.0,'5',2,NULL,1,1,3,'root'),(8,'2011-10-05 14:22:47',20.0,'5',2,NULL,1,1,3,'root'),(9,'2011-10-05 14:30:23',20.0,'5',2,NULL,1,1,3,'root'),(10,'2011-10-05 14:31:42',20.0,'5',2,NULL,1,1,3,'root'),(11,'2011-10-05 14:55:10',20.0,'5',2,NULL,1,1,3,'root'),(12,'2011-10-05 14:55:14',20.0,'5',2,NULL,1,1,3,'root'),(13,'2011-10-05 18:32:30',0.0,'',2,NULL,1,1,3,'root'),(14,'2011-10-05 18:32:33',0.0,'',2,NULL,1,1,3,'root'),(15,'2011-10-06 06:10:49',0.0,'',2,NULL,1,1,3,'root'),(16,'2011-10-06 06:12:16',0.0,'',2,NULL,1,1,3,'root'),(17,'2011-10-06 06:45:11',0.0,'',2,NULL,1,1,3,'root'),(18,'2011-10-06 09:01:16',20.0,'N/A',1,NULL,1,1,1,'root'),(19,'2011-10-06 09:05:34',0.0,'',2,NULL,1,1,3,'root'),(20,'2011-10-06 16:00:10',0.0,'',2,NULL,1,1,3,'root'),(21,'2011-10-06 16:10:01',0.0,'',2,NULL,1,1,3,'root'),(22,'2011-10-06 21:02:21',0.0,'',2,NULL,1,1,3,'root'),(23,'2011-10-07 09:25:57',0.0,'',2,NULL,1,1,3,'root'),(24,'2011-10-07 09:31:58',0.0,'',2,NULL,1,1,3,'root'),(25,'2011-10-07 17:03:58',0.0,'',2,NULL,1,1,3,'root'),(26,'2011-10-08 16:50:59',20.0,'N/A',1,NULL,1,1,2,'root'),(27,'2011-10-08 17:42:20',320.0,'N/A',1,NULL,1,1,2,'root'),(28,'2011-10-08 17:50:21',40.0,'N/A',1,NULL,1,1,2,'root'),(29,'2011-10-09 22:04:43',40.0,'N/A',1,NULL,1,1,1,'root');
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
  `product_no` varchar(13) DEFAULT NULL,
  `qty` smallint(5) DEFAULT NULL,
  `discount` int(10) DEFAULT NULL,
  `price` decimal(7,1) DEFAULT NULL,
  `invoice_no` int(10) DEFAULT NULL,
  `IMEI` varchar(15) DEFAULT NULL,
  `asscessories_no` int(10) DEFAULT NULL,
  `modifyBy` varchar(4) DEFAULT NULL,
  `pastIDV` int(10) DEFAULT NULL,
  PRIMARY KEY (`invoiceDetail_no`),
  KEY `ind_fk_invoice` (`invoice_no`),
  KEY `ind_fk_ass` (`asscessories_no`),
  KEY `ind_fk_phone` (`IMEI`),
  CONSTRAINT `ind_fk_ass` FOREIGN KEY (`asscessories_no`) REFERENCES `asscessories` (`asscessories_no`) ON DELETE NO ACTION ON UPDATE CASCADE,
  CONSTRAINT `ind_fk_invoice` FOREIGN KEY (`invoice_no`) REFERENCES `invoice` (`invoice_no`) ON DELETE NO ACTION ON UPDATE CASCADE,
  CONSTRAINT `ind_fk_phone` FOREIGN KEY (`IMEI`) REFERENCES `phone` (`IMEI`) ON DELETE NO ACTION ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=57 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `invoicedetail`
--

LOCK TABLES `invoicedetail` WRITE;
/*!40000 ALTER TABLE `invoicedetail` DISABLE KEYS */;
INSERT INTO `invoicedetail` VALUES (1,'3633633666969',1,0,20.0,1,NULL,NULL,'1',2),(2,'3633633666969',1,0,20.0,1,NULL,NULL,'1',3),(3,'3633633666969',1,0,20.0,1,NULL,NULL,'1',4),(4,'3633633666969',1,0,20.0,2,NULL,NULL,'1',1),(5,'3633633666969',1,0,20.0,3,NULL,NULL,'1',2),(6,'3633633666969',1,0,20.0,4,NULL,NULL,'1',3),(7,'3633633666969',1,0,20.0,5,NULL,NULL,'1',9),(8,'3633633666969',1,0,20.0,5,NULL,NULL,'1',8),(9,'3633633666969',1,0,20.0,5,NULL,NULL,'1',7),(10,'3633633666969',1,0,20.0,5,NULL,NULL,'1',6),(11,'3633633666969',1,0,20.0,5,NULL,NULL,'1',10),(12,'3633633666969',1,0,20.0,5,NULL,NULL,'1',11),(13,'3633633666969',1,0,20.0,5,NULL,NULL,'1',12),(14,'3633633666969',1,0,20.0,5,NULL,NULL,'1',NULL),(15,'3633633666969',1,0,20.0,5,NULL,NULL,'1',NULL),(16,'3633633666969',1,0,20.0,6,NULL,NULL,'1',10),(17,'3633633666969',1,0,20.0,7,NULL,NULL,'1',9),(18,'3633633666969',1,0,20.0,8,NULL,NULL,'1',8),(19,'3633633666969',1,0,20.0,9,NULL,NULL,'1',7),(20,'3633633666969',1,0,20.0,10,NULL,NULL,'1',11),(21,'3633633666969',1,0,20.0,11,NULL,NULL,'1',12),(22,'3633633666969',1,0,20.0,12,NULL,NULL,'1',13),(23,'',0,0,0.0,13,NULL,NULL,'1',0),(24,'',0,0,0.0,14,NULL,NULL,'1',0),(25,'',0,0,0.0,15,NULL,NULL,'1',0),(26,'',0,0,0.0,16,NULL,NULL,'1',0),(27,'',0,0,0.0,17,NULL,NULL,'1',0),(28,'3633633666969',1,0,20.0,18,NULL,NULL,'1',NULL),(29,'',0,0,0.0,19,NULL,NULL,'1',0),(30,'',0,0,0.0,20,NULL,NULL,'1',0),(31,'',0,0,0.0,21,NULL,NULL,'1',0),(32,'',0,0,0.0,22,NULL,NULL,'1',0),(33,'',0,0,0.0,23,NULL,NULL,'1',0),(34,'',0,0,0.0,24,NULL,NULL,'1',0),(35,'',0,0,0.0,25,NULL,NULL,'1',0),(36,'3633633666969',1,0,20.0,26,NULL,NULL,'1',NULL),(37,'3633633666968',1,0,20.0,27,NULL,NULL,'1',NULL),(38,'3633633666969',1,0,20.0,27,NULL,NULL,'1',NULL),(39,'3633633666968',1,0,20.0,27,NULL,NULL,'1',NULL),(40,'3633633666969',1,0,20.0,27,NULL,NULL,'1',NULL),(41,'3633633666969',1,0,20.0,27,NULL,NULL,'1',NULL),(42,'3633633666969',1,0,20.0,27,NULL,NULL,'1',NULL),(43,'3633633666969',1,0,20.0,27,NULL,NULL,'1',NULL),(44,'3633633666968',1,0,20.0,27,NULL,NULL,'1',NULL),(45,'3633633666969',1,0,20.0,27,NULL,NULL,'1',NULL),(46,'3633633666968',1,0,20.0,27,NULL,NULL,'1',NULL),(47,'3633633666968',1,0,20.0,27,NULL,NULL,'1',NULL),(48,'3633633666968',1,0,20.0,27,NULL,NULL,'1',NULL),(49,'3633633666969',1,0,20.0,27,NULL,NULL,'1',NULL),(50,'3633633666968',1,0,20.0,27,NULL,NULL,'1',NULL),(51,'3633633666969',1,0,20.0,27,NULL,NULL,'1',NULL),(52,'3633633666969',1,0,20.0,27,NULL,NULL,'1',NULL),(53,'3633633666969',1,0,20.0,28,NULL,NULL,'1',NULL),(54,'3633633666968',1,0,20.0,28,NULL,NULL,'1',NULL),(55,'3633633666969',1,0,20.0,29,NULL,NULL,'1',NULL),(56,'3633633666968',1,0,20.0,29,NULL,NULL,'1',NULL);
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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `invoicestate`
--

LOCK TABLES `invoicestate` WRITE;
/*!40000 ALTER TABLE `invoicestate` DISABLE KEYS */;
INSERT INTO `invoicestate` VALUES (1,'完結 - 銷售單'),(2,'單據無效'),(3,'完結 - 退貨單'),(4,'完結 - 銷售單(有退貨)');
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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `payment`
--

LOCK TABLES `payment` WRITE;
/*!40000 ALTER TABLE `payment` DISABLE KEYS */;
INSERT INTO `payment` VALUES (1,'現金'),(2,'EPS'),(3,'信用卡'),(4,'八達通');
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
INSERT INTO `payment_has_invoice` VALUES (1,1,60.0),(5,1,180.0),(18,1,20.0),(26,1,20.0),(27,1,320.0),(28,1,40.0),(29,3,1.0),(29,3,1.0),(29,3,1.0),(29,3,1.0),(29,3,1.0),(29,3,1.0),(29,3,1.0),(29,3,1.0),(29,3,1.0),(29,3,1.0),(29,3,1.0),(29,3,1.0),(29,3,1.0),(29,3,1.0),(29,3,1.0),(29,3,1.0),(29,3,1.0),(29,3,1.0),(29,3,1.0),(29,3,1.0),(29,3,1.0),(29,3,1.0),(29,3,1.0),(29,3,1.0),(29,3,1.0),(29,3,1.0),(29,3,1.0),(29,3,1.0),(29,3,1.0),(29,3,1.0),(29,3,1.0),(29,3,1.0),(29,3,1.0),(29,3,1.0),(29,3,1.0),(29,3,1.0),(29,3,1.0),(29,3,1.0),(29,3,1.0),(29,3,1.0);
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
  `phone_no` int(10) NOT NULL,
  `IMEI` varchar(15) NOT NULL,
  `phoneType_no` smallint(5) DEFAULT NULL,
  `retailShop_no` smallint(4) DEFAULT NULL,
  `productState_no` tinyint(1) DEFAULT NULL,
  `poDetail_no` int(10) DEFAULT NULL,
  PRIMARY KEY (`IMEI`,`phone_no`),
  KEY `phone_fk_pt` (`phoneType_no`),
  KEY `phone_fk_retailShop` (`retailShop_no`),
  KEY `phone_fk_pod` (`poDetail_no`),
  KEY `phone_fk_prodState` (`productState_no`),
  CONSTRAINT `phone_fk_prodState` FOREIGN KEY (`productState_no`) REFERENCES `productstate` (`productState_no`) ON DELETE NO ACTION ON UPDATE CASCADE,
  CONSTRAINT `phone_fk_pt` FOREIGN KEY (`phoneType_no`) REFERENCES `phonetype` (`phoneType_no`) ON DELETE NO ACTION ON UPDATE CASCADE,
  CONSTRAINT `phone_fk_retailShop` FOREIGN KEY (`retailShop_no`) REFERENCES `retailshop` (`retailShop_no`) ON DELETE NO ACTION ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `phone`
--

LOCK TABLES `phone` WRITE;
/*!40000 ALTER TABLE `phone` DISABLE KEYS */;
INSERT INTO `phone` VALUES (0,'0',NULL,NULL,NULL,NULL);
/*!40000 ALTER TABLE `phone` ENABLE KEYS */;
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
  `oprice` int(10) DEFAULT NULL,
  `sprice` int(10) DEFAULT NULL,
  `productState_no` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`phoneType_no`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `phonetype`
--

LOCK TABLES `phonetype` WRITE;
/*!40000 ALTER TABLE `phonetype` DISABLE KEYS */;
INSERT INTO `phonetype` VALUES (1,'SAMSUNG','white','GALAXY NOTE','TD001',4998,4998,2),(2,'APPLE','white','IPHONE 4S','TD002',4898,4898,2),(3,'SAMSUNG','white','GALAXY S II','TD003',4200,4200,2),(4,'APPLE','N/A','I PHONE 4','TD004',4998,4800,1),(5,'APPLE','N/A','I PHONE 5 ','TD005',5000,5000,1);
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
  PRIMARY KEY (`po_no`),
  KEY `po_fk_staff` (`staff_no`),
  KEY `po_fk_retailShop` (`retailShop_no`),
  KEY `po_fk_poState` (`poState_no`),
  KEY `po_fk_sp` (`supplier_no`),
  CONSTRAINT `po_fk_poState` FOREIGN KEY (`poState_no`) REFERENCES `postate` (`poState_no`) ON DELETE NO ACTION ON UPDATE CASCADE,
  CONSTRAINT `po_fk_retailShop` FOREIGN KEY (`retailShop_no`) REFERENCES `retailshop` (`retailShop_no`) ON DELETE NO ACTION ON UPDATE CASCADE,
  CONSTRAINT `po_fk_sp` FOREIGN KEY (`supplier_no`) REFERENCES `supplier` (`supplier_no`) ON DELETE NO ACTION ON UPDATE CASCADE,
  CONSTRAINT `po_fk_staff` FOREIGN KEY (`staff_no`) REFERENCES `staff` (`staff_no`) ON DELETE NO ACTION ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `po`
--

LOCK TABLES `po` WRITE;
/*!40000 ALTER TABLE `po` DISABLE KEYS */;
INSERT INTO `po` VALUES (1,'2011-08-07 00:00:00',1,1,1,1);
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
  `cost` int(10) DEFAULT NULL,
  `po_no` int(10) DEFAULT NULL,
  `phonetype_no` smallint(5) DEFAULT NULL,
  `asscessories_no` int(10) DEFAULT NULL,
  PRIMARY KEY (`poDetail_no`),
  KEY `pod_fk_po` (`po_no`),
  KEY `pod_fk_ass` (`asscessories_no`),
  CONSTRAINT `pod_fk_ass` FOREIGN KEY (`asscessories_no`) REFERENCES `asscessories` (`asscessories_no`) ON DELETE NO ACTION ON UPDATE CASCADE,
  CONSTRAINT `pod_fk_po` FOREIGN KEY (`po_no`) REFERENCES `po` (`po_no`) ON DELETE NO ACTION ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `podetail`
--

LOCK TABLES `podetail` WRITE;
/*!40000 ALTER TABLE `podetail` DISABLE KEYS */;
INSERT INTO `podetail` VALUES (3,30,10,1,NULL,1);
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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `postate`
--

LOCK TABLES `postate` WRITE;
/*!40000 ALTER TABLE `postate` DISABLE KEYS */;
INSERT INTO `postate` VALUES (1,'開啟'),(2,'未完成'),(3,'完結');
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
  `retail_id` varchar(10) DEFAULT NULL,
  `addr` varchar(255) DEFAULT NULL,
  `phone` varchar(15) DEFAULT NULL,
  `fax` varchar(15) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `location` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`retailShop_no`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `retailshop`
--

LOCK TABLES `retailshop` WRITE;
/*!40000 ALTER TABLE `retailshop` DISABLE KEYS */;
INSERT INTO `retailshop` VALUES (1,'FFF000','n/a','21213654','21213655','n/a','MK'),(2,'FFF001','n/a','n/a','n/a','n/a','SK'),(3,'FFF002','灣仔菲林明道17號','23153153','24756748','FFF002@gmail.com','灣仔'),(4,'FFF003','灣仔菲林明道18號','23153153','24756748','FFF003@gmail.com','灣仔'),(5,'FFF004','灣仔菲林明道19號','23153153','24756748','FFF004@gmail.com','灣仔'),(6,'FFF005','灣仔菲林明道20號','23153153','24756748','FFF005@gmail.com','灣仔'),(7,'FFF006','灣仔菲林明道21號','23153153','24756748','FFF006@gmail.com','灣仔'),(8,'FFF007','灣仔菲林明道22號','23153153','24756748','FFF008@gmail.com','灣仔'),(9,'FFF008','灣仔菲林明道17號','23153153','24756748','FFF008@gmail.com','灣仔'),(10,'FFF009','灣仔菲林明道17號','23153153','24756748','FFF009@gmail.com','灣仔'),(11,'FFF0010','灣仔菲林明道17號','23153153','24756748','FFF0010@gmail.com','灣仔');
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
  `asscessories_no` int(10) NOT NULL,
  `qty` smallint(6) DEFAULT NULL,
  KEY `rsa_fk_retailShop` (`retailShop_no`),
  KEY `rsa_fk_ass` (`asscessories_no`),
  CONSTRAINT `rsa_fk_ass` FOREIGN KEY (`asscessories_no`) REFERENCES `asscessories` (`asscessories_no`) ON DELETE NO ACTION ON UPDATE CASCADE,
  CONSTRAINT `rsa_fk_retailShop` FOREIGN KEY (`retailShop_no`) REFERENCES `retailshop` (`retailShop_no`) ON DELETE NO ACTION ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `retailshop_ass`
--

LOCK TABLES `retailshop_ass` WRITE;
/*!40000 ALTER TABLE `retailshop_ass` DISABLE KEYS */;
INSERT INTO `retailshop_ass` VALUES (1,1,10),(1,2,20);
/*!40000 ALTER TABLE `retailshop_ass` ENABLE KEYS */;
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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `staff`
--

LOCK TABLES `staff` WRITE;
/*!40000 ALTER TABLE `staff` DISABLE KEYS */;
INSERT INTO `staff` VALUES (1,NULL,'rootpass','root',NULL,1,1);
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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `stafftype`
--

LOCK TABLES `stafftype` WRITE;
/*!40000 ALTER TABLE `stafftype` DISABLE KEYS */;
INSERT INTO `stafftype` VALUES (1,'管理員',1),(2,'超級使用者',NULL);
/*!40000 ALTER TABLE `stafftype` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `stockin`
--

DROP TABLE IF EXISTS `stockin`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `stockin` (
  `stockin_no` int(10) NOT NULL,
  `po_no` int(10) DEFAULT NULL,
  `staff_no` int(10) DEFAULT NULL,
  `date` datetime DEFAULT NULL,
  PRIMARY KEY (`stockin_no`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `stockin`
--

LOCK TABLES `stockin` WRITE;
/*!40000 ALTER TABLE `stockin` DISABLE KEYS */;
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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `supplier`
--

LOCK TABLES `supplier` WRITE;
/*!40000 ALTER TABLE `supplier` DISABLE KEYS */;
INSERT INTO `supplier` VALUES (1,NULL,'TCF company','n/a','n/a','n/a','n/a',NULL,NULL);
/*!40000 ALTER TABLE `supplier` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `transdetail`
--

DROP TABLE IF EXISTS `transdetail`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `transdetail` (
  `transDetail_no` int(10) NOT NULL,
  `product_no` bigint(13) DEFAULT NULL,
  `qty` smallint(5) DEFAULT NULL,
  `price` int(10) DEFAULT NULL,
  `asscessories_no` int(10) DEFAULT NULL,
  `IMEI` varchar(15) DEFAULT NULL,
  `transfer_no` int(10) DEFAULT NULL,
  PRIMARY KEY (`transDetail_no`),
  KEY `td_fk_trans` (`transfer_no`),
  KEY `td_fk_ass` (`asscessories_no`),
  KEY `td_fk_phone` (`IMEI`),
  CONSTRAINT `td_fk_ass` FOREIGN KEY (`asscessories_no`) REFERENCES `asscessories` (`asscessories_no`) ON DELETE NO ACTION ON UPDATE CASCADE,
  CONSTRAINT `td_fk_phone` FOREIGN KEY (`IMEI`) REFERENCES `phone` (`IMEI`) ON DELETE NO ACTION ON UPDATE CASCADE,
  CONSTRAINT `td_fk_trans` FOREIGN KEY (`transfer_no`) REFERENCES `transfer` (`transfer_no`) ON DELETE NO ACTION ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `transdetail`
--

LOCK TABLES `transdetail` WRITE;
/*!40000 ALTER TABLE `transdetail` DISABLE KEYS */;
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
  `invoice_no` int(10) DEFAULT NULL,
  `staff_no` int(10) DEFAULT NULL,
  `transState_no` smallint(4) DEFAULT NULL,
  PRIMARY KEY (`transfer_no`),
  KEY `trans_fk_transState` (`transState_no`),
  KEY `trans_fk_staff` (`staff_no`),
  CONSTRAINT `trans_fk_staff` FOREIGN KEY (`staff_no`) REFERENCES `staff` (`staff_no`) ON DELETE NO ACTION ON UPDATE CASCADE,
  CONSTRAINT `trans_fk_transState` FOREIGN KEY (`transState_no`) REFERENCES `transstate` (`transState_no`) ON DELETE NO ACTION ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `transfer`
--

LOCK TABLES `transfer` WRITE;
/*!40000 ALTER TABLE `transfer` DISABLE KEYS */;
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `transstate`
--

LOCK TABLES `transstate` WRITE;
/*!40000 ALTER TABLE `transstate` DISABLE KEYS */;
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

-- Dump completed on 2011-10-10  9:46:16
