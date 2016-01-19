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
  `assName` varchar(50) DEFAULT NULL,
  `asscessoriesType_no` smallint(5) DEFAULT NULL,
  `barcode` bigint(13) DEFAULT NULL,
  `oprice` int(10) DEFAULT NULL,
  `sprice` int(10) DEFAULT NULL,
  `productState_no` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`asscessories_no`),
  KEY `ass_fk_assType` (`asscessoriesType_no`),
  KEY `ass_fk_prodState` (`productState_no`),
  CONSTRAINT `ass_fk_assType` FOREIGN KEY (`asscessoriesType_no`) REFERENCES `asscessoriestype` (`asscessoriesType_no`) ON DELETE NO ACTION ON UPDATE CASCADE,
  CONSTRAINT `ass_fk_prodState` FOREIGN KEY (`productState_no`) REFERENCES `productstate` (`productState_no`) ON DELETE NO ACTION ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `asscessories`
--

LOCK TABLES `asscessories` WRITE;
/*!40000 ALTER TABLE `asscessories` DISABLE KEYS */;
INSERT INTO `asscessories` VALUES (1,'ABC SSEE 保護貼 ',1,3633633666969,NULL,NULL,NULL),(2,'GGFG DDS 保護貼',1,3633633666968,NULL,NULL,NULL);
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
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `asscessoriestype`
--

LOCK TABLES `asscessoriestype` WRITE;
/*!40000 ALTER TABLE `asscessoriestype` DISABLE KEYS */;
INSERT INTO `asscessoriestype` VALUES (1,'保護貼 Screen Protector'),(2,'機殼'),(3,'充電器'),(4,'耳機'),(5,'其他 Other');
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
  PRIMARY KEY (`invoice_no`),
  KEY `invoice_fk_inType` (`invoiceType_no`),
  KEY `invoice_fk_cust` (`customer_no`),
  KEY `invoice_fk_staff` (`staff_no`),
  KEY `invoice_fk_rs` (`retailShop_no`),
  CONSTRAINT `invoice_fk_cust` FOREIGN KEY (`customer_no`) REFERENCES `customer` (`customer_no`) ON DELETE NO ACTION ON UPDATE CASCADE,
  CONSTRAINT `invoice_fk_inType` FOREIGN KEY (`invoiceType_no`) REFERENCES `invoicetype` (`invoiceType_no`) ON DELETE NO ACTION ON UPDATE CASCADE,
  CONSTRAINT `invoice_fk_rs` FOREIGN KEY (`retailShop_no`) REFERENCES `retailshop` (`retailShop_no`) ON DELETE NO ACTION ON UPDATE CASCADE,
  CONSTRAINT `invoice_fk_staff` FOREIGN KEY (`staff_no`) REFERENCES `staff` (`staff_no`) ON DELETE NO ACTION ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `invoice`
--

LOCK TABLES `invoice` WRITE;
/*!40000 ALTER TABLE `invoice` DISABLE KEYS */;
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
  `product_no` bigint(13) DEFAULT NULL,
  `qty` smallint(5) DEFAULT NULL,
  `discount` int(10) DEFAULT NULL,
  `price` int(10) DEFAULT NULL,
  `invoice_no` int(10) DEFAULT NULL,
  `IMEI` varchar(15) DEFAULT NULL,
  `asscessories_no` int(10) DEFAULT NULL,
  `modifyBy` varchar(4) DEFAULT NULL,
  PRIMARY KEY (`invoiceDetail_no`),
  KEY `ind_fk_invoice` (`invoice_no`),
  KEY `ind_fk_ass` (`asscessories_no`),
  KEY `ind_fk_phone` (`IMEI`),
  CONSTRAINT `ind_fk_ass` FOREIGN KEY (`asscessories_no`) REFERENCES `asscessories` (`asscessories_no`) ON DELETE NO ACTION ON UPDATE CASCADE,
  CONSTRAINT `ind_fk_invoice` FOREIGN KEY (`invoice_no`) REFERENCES `invoice` (`invoice_no`) ON DELETE NO ACTION ON UPDATE CASCADE,
  CONSTRAINT `ind_fk_phone` FOREIGN KEY (`IMEI`) REFERENCES `phone` (`IMEI`) ON DELETE NO ACTION ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `invoicedetail`
--

LOCK TABLES `invoicedetail` WRITE;
/*!40000 ALTER TABLE `invoicedetail` DISABLE KEYS */;
/*!40000 ALTER TABLE `invoicedetail` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `invoicestate`
--

DROP TABLE IF EXISTS `invoicestate`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `invoicestate` (
  `invoiceState_no` int(11) NOT NULL AUTO_INCREMENT,
  `invoiceStateName` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`invoiceState_no`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `invoicestate`
--

LOCK TABLES `invoicestate` WRITE;
/*!40000 ALTER TABLE `invoicestate` DISABLE KEYS */;
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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `invoicetype`
--

LOCK TABLES `invoicetype` WRITE;
/*!40000 ALTER TABLE `invoicetype` DISABLE KEYS */;
INSERT INTO `invoicetype` VALUES (1,'發票 Invoice','S'),(2,'取消單據 Void','V'),(3,'退貨單 Return','R'),(4,'換貨單 Exchange','X');
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
  CONSTRAINT `phone_fk_pod` FOREIGN KEY (`poDetail_no`) REFERENCES `podetail` (`poDetail_no`) ON DELETE NO ACTION ON UPDATE CASCADE,
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
  `oprice` int(10) DEFAULT NULL,
  `sprice` int(10) DEFAULT NULL,
  PRIMARY KEY (`phoneType_no`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `phonetype`
--

LOCK TABLES `phonetype` WRITE;
/*!40000 ALTER TABLE `phonetype` DISABLE KEYS */;
/*!40000 ALTER TABLE `phonetype` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `po`
--

DROP TABLE IF EXISTS `po`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `po` (
  `po_no` int(10) NOT NULL,
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
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
INSERT INTO `podetail` VALUES (3,30,10,1,1);
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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `postate`
--

LOCK TABLES `postate` WRITE;
/*!40000 ALTER TABLE `postate` DISABLE KEYS */;
INSERT INTO `postate` VALUES (1,'新PO');
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `productstate`
--

LOCK TABLES `productstate` WRITE;
/*!40000 ALTER TABLE `productstate` DISABLE KEYS */;
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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `retailshop`
--

LOCK TABLES `retailshop` WRITE;
/*!40000 ALTER TABLE `retailshop` DISABLE KEYS */;
INSERT INTO `retailshop` VALUES (1,'FFF000','n/a','n/a','n/a','n/a','MK');
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
  `price` double DEFAULT NULL,
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
INSERT INTO `retailshop_ass` VALUES (1,1,10,23.5);
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
  PRIMARY KEY (`supplier_no`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `supplier`
--

LOCK TABLES `supplier` WRITE;
/*!40000 ALTER TABLE `supplier` DISABLE KEYS */;
INSERT INTO `supplier` VALUES (1,NULL,'TCF company','n/a','n/a','n/a','n/a',NULL);
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

-- Dump completed on 2011-09-22  4:17:51
