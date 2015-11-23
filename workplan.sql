-- MySQL dump 10.13  Distrib 5.5.21, for Win32 (x86)
--
-- Host: x.x.x.x    Database: workplan
-- ------------------------------------------------------
-- Server version	5.5.40-0+wheezy1

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
-- Table structure for table `Priority`
--

DROP TABLE IF EXISTS `Priority`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Priority` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Name` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=latin1 AVG_ROW_LENGTH=2730;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Priority`
--

LOCK TABLES `Priority` WRITE;
/*!40000 ALTER TABLE `Priority` DISABLE KEYS */;
INSERT INTO `Priority` VALUES (11,'Priority #1 - WorkPlan'),(12,'Priority # 2 -Water Meters'),(13,'Priority # 3 - E Commerce'),(14,'Priority # 4 - Document Management'),(15,'Priority # 5 - Orthos'),(16,'Statutory Absolute'),(17,'Statutory Flexible'),(18,'Existing Service - Own'),(19,'Existing Service - Shared'),(20,'Zinger');
/*!40000 ALTER TABLE `Priority` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Temporary table structure for view `ProjectView`
--

DROP TABLE IF EXISTS `ProjectView`;
/*!50001 DROP VIEW IF EXISTS `ProjectView`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE `ProjectView` (
  `project_id` int(11),
  `project_type` varchar(50),
  `project_name` varchar(200),
  `date_start` date,
  `date_end` date,
  `year` varchar(4),
  `Objective` char(0),
  `priority` varchar(100),
  `project_lead` varchar(100),
  `approved_budget` int(11),
  `budget_spent` int(11),
  `multi_year` varchar(10),
  `public_engagement` varchar(100),
  `level_of_service` varchar(55),
  `approved_by_cao` varchar(10),
  `progress` varchar(11),
  `DEPARTMENT` varchar(20),
  `total_hours` double,
  `assigned_hours` decimal(32,0),
  `assigned_progress` double
) ENGINE=MyISAM */;
SET character_set_client = @saved_cs_client;

--
-- Table structure for table `department`
--

DROP TABLE IF EXISTS `department`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `department` (
  `DEPT_ID` int(11) NOT NULL AUTO_INCREMENT,
  `DEPARTMENT` varchar(20) NOT NULL,
  `MANAGER` int(11) NOT NULL,
  `DIRECTOR` int(11) NOT NULL,
  `LOCATION` varchar(50) NOT NULL,
  `PHONE_NO` char(20) NOT NULL,
  PRIMARY KEY (`DEPT_ID`)
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=latin1 AVG_ROW_LENGTH=50;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `department`
--

LOCK TABLES `department` WRITE;
/*!40000 ALTER TABLE `department` DISABLE KEYS */;
INSERT INTO `department` VALUES (12,'Finance',0,0,'',''),(4,'Planning',16,20,'CityHall','111-2222'),(5,'Public Works',17,20,'Public Works','222-3333'),(6,'Engineering',17,20,'CityHall','111-2222'),(7,'IT Services',15,19,'IT Building','333-4444'),(8,'Legislative Services',16,20,'CityHall','111-2222'),(9,'Strategic Planning',0,0,'cityhall',''),(10,'Community Services',0,0,'',''),(11,'Human Resources',0,0,'',''),(13,'Parks',0,0,'Public Works',''),(14,'Recreation',0,0,'Filberg',''),(15,'Fire Department',0,0,'Fire Hall','');
/*!40000 ALTER TABLE `department` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pay_period`
--

DROP TABLE IF EXISTS `pay_period`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pay_period` (
  `pay_period_id` int(11) NOT NULL AUTO_INCREMENT,
  `year` int(4) NOT NULL,
  `pay_period_number` int(11) NOT NULL,
  `start_date` datetime NOT NULL,
  `end_date` datetime NOT NULL,
  PRIMARY KEY (`pay_period_id`)
) ENGINE=InnoDB AUTO_INCREMENT=82 DEFAULT CHARSET=latin1 AVG_ROW_LENGTH=204;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pay_period`
--

LOCK TABLES `pay_period` WRITE;
/*!40000 ALTER TABLE `pay_period` DISABLE KEYS */;
INSERT INTO `pay_period` VALUES (1,2015,1,'2015-01-04 00:00:00','2015-01-17 23:59:59'),(2,2015,2,'2015-01-18 00:00:00','2015-01-31 23:59:59'),(3,2015,3,'2015-02-01 00:00:00','2015-02-14 23:59:59'),(4,2015,4,'2015-02-15 00:00:00','2015-02-28 23:59:59'),(5,2015,5,'2015-03-01 00:00:00','2015-03-14 23:59:59'),(6,2015,6,'2015-03-15 00:00:00','2015-03-28 23:59:59'),(7,2015,7,'2015-03-29 00:00:00','2015-04-11 23:59:59'),(8,2015,8,'2015-04-12 00:00:00','2015-04-25 23:59:59'),(9,2015,9,'2015-04-26 00:00:00','2015-05-09 23:59:59'),(10,2015,10,'2015-05-10 00:00:00','2015-05-23 23:59:59'),(11,2015,11,'2015-05-24 00:00:00','2015-06-06 23:59:59'),(12,2015,12,'2015-06-07 00:00:00','2015-06-20 23:59:59'),(13,2015,13,'2015-06-21 00:00:00','2015-07-04 23:59:59'),(14,2015,14,'2015-07-05 00:00:00','2015-07-18 23:59:59'),(15,2015,15,'2015-07-19 00:00:00','2015-08-01 23:59:59'),(16,2015,16,'2015-08-02 00:00:00','2015-08-15 23:59:59'),(17,2015,17,'2015-08-16 00:00:00','2015-08-29 23:59:59'),(18,2015,18,'2015-08-30 00:00:00','2015-09-12 23:59:59'),(19,2015,19,'2015-09-13 00:00:00','2015-09-26 23:59:59'),(20,2015,20,'2015-09-27 00:00:00','2015-10-10 23:59:59'),(21,2015,21,'2015-10-11 00:00:00','2015-10-24 23:59:59'),(22,2015,22,'2015-10-25 00:00:00','2015-11-07 23:59:59'),(23,2015,23,'2015-11-08 00:00:00','2015-11-21 23:59:59'),(24,2015,24,'2015-11-22 00:00:00','2015-12-05 23:59:59'),(25,2015,25,'2015-12-06 00:00:00','2015-12-19 23:59:59'),(26,2015,26,'2015-12-20 00:00:00','2016-01-02 23:59:59'),(27,2016,1,'2016-01-03 00:00:00','2016-01-16 23:59:59'),(29,2016,2,'2016-01-17 00:00:00','2016-01-30 23:59:59'),(30,2016,3,'2016-01-31 00:00:00','2016-02-13 23:59:59'),(31,2016,4,'2016-02-14 00:00:00','2016-02-27 23:59:59'),(32,2016,5,'2016-02-28 00:00:00','2016-03-12 23:59:59'),(33,2016,6,'2016-03-13 00:00:00','2016-03-26 23:59:59'),(34,2016,7,'2016-03-27 00:00:00','2016-04-09 23:59:59'),(35,2016,8,'2016-04-10 00:00:00','2016-04-23 23:59:59'),(36,2016,9,'2016-04-24 00:00:00','2016-05-07 23:59:59'),(37,2016,10,'2016-05-08 00:00:00','2016-05-21 23:59:59'),(38,2016,11,'2016-05-22 00:00:00','2016-06-04 23:59:59'),(39,2016,12,'2016-06-05 00:00:00','2016-06-18 23:59:59'),(40,2016,13,'2016-06-19 00:00:00','2016-07-02 23:59:59'),(41,2016,14,'2016-07-03 00:00:00','2016-07-16 23:59:59'),(42,2016,15,'2016-07-17 00:00:00','2016-07-30 23:59:59'),(43,2016,16,'2016-07-31 00:00:00','2016-08-13 23:59:59'),(44,2016,17,'2016-08-14 00:00:00','2016-08-27 23:59:59'),(45,2016,18,'2016-08-28 00:00:00','2016-09-10 23:59:59'),(46,2016,19,'2016-09-11 00:00:00','2016-09-24 23:59:59'),(47,2016,20,'2016-09-25 00:00:00','2016-10-08 23:59:59'),(48,2016,21,'2016-10-09 00:00:00','2016-10-22 23:59:59'),(49,2016,22,'2016-10-23 00:00:00','2016-11-05 23:59:59'),(50,2016,23,'2016-11-06 00:00:00','2016-11-19 23:59:59'),(51,2016,24,'2016-11-20 00:00:00','2016-12-03 23:59:59'),(52,2016,25,'2016-12-04 00:00:00','2016-12-17 23:59:59'),(53,2016,26,'2016-12-18 00:00:00','2016-12-31 23:59:59'),(54,2017,1,'2017-01-01 00:00:00','2017-01-14 23:59:59'),(55,2017,2,'2017-01-15 00:00:00','2017-01-28 23:59:59'),(56,2017,3,'2017-01-29 00:00:00','2017-02-11 23:59:59'),(57,2017,4,'2017-02-12 00:00:00','2017-02-25 23:59:59'),(58,2017,5,'2017-02-26 00:00:00','2017-03-11 23:59:59'),(59,2017,6,'2017-03-12 00:00:00','2017-03-25 23:59:59'),(60,2017,7,'2017-03-26 00:00:00','2017-04-08 23:59:59'),(61,2017,8,'2017-04-09 00:00:00','2017-04-22 23:59:59'),(62,2017,9,'2017-04-23 00:00:00','2017-05-06 23:59:59'),(63,2017,10,'2017-05-07 00:00:00','2017-05-20 23:59:59'),(64,2017,11,'2017-05-21 00:00:00','2017-06-03 23:59:59'),(65,2017,12,'2017-06-04 00:00:00','2017-06-17 23:59:59'),(66,2017,13,'2017-06-18 00:00:00','2017-07-01 23:59:59'),(67,2017,14,'2017-07-02 00:00:00','2017-07-15 23:59:59'),(68,2017,15,'2017-07-16 00:00:00','2017-07-29 23:59:59'),(69,2017,16,'2017-07-30 00:00:00','2017-08-12 23:59:59'),(70,2017,17,'2017-08-13 00:00:00','2017-08-26 23:59:59'),(71,2017,18,'2017-08-27 00:00:00','2017-09-09 23:59:59'),(72,2017,19,'2017-09-10 00:00:00','2017-09-23 23:59:59'),(73,2017,20,'2017-09-24 00:00:00','2017-10-07 23:59:59'),(74,2017,21,'2017-10-08 00:00:00','2017-10-21 23:59:59'),(75,2017,22,'2017-10-22 00:00:00','2017-11-04 23:59:59'),(76,2017,23,'2017-11-05 00:00:00','2017-11-18 23:59:59'),(77,2017,24,'2017-11-19 00:00:00','2017-12-02 23:59:59'),(78,2017,25,'2017-12-03 00:00:00','2017-12-16 23:59:59'),(79,2017,26,'2017-12-17 00:00:00','2017-12-30 23:59:59'),(80,2018,1,'2017-12-31 00:00:00','2018-01-13 23:59:59'),(81,2018,2,'2018-01-14 00:00:00','2018-01-27 23:59:59');
/*!40000 ALTER TABLE `pay_period` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `program`
--

DROP TABLE IF EXISTS `program`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `program` (
  `program_id` int(11) NOT NULL AUTO_INCREMENT,
  `program_name` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `year` varchar(4) COLLATE utf8_unicode_ci DEFAULT NULL,
  `multi` varchar(4) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'NO',
  `description` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `lead` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `date_start` date DEFAULT NULL,
  `date_end` date DEFAULT NULL,
  `progress` int(11) NOT NULL DEFAULT '0',
  `notes` text COLLATE utf8_unicode_ci,
  PRIMARY KEY (`program_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AVG_ROW_LENGTH=5461;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `program`
--

LOCK TABLES `program` WRITE;
/*!40000 ALTER TABLE `program` DISABLE KEYS */;
INSERT INTO `program` VALUES (4,'GIS Services','2014','0','','Manager Two','2014-07-01','2014-12-31',0,NULL),(5,'IT Services TEST','2014','1','','Manager Three','2014-07-01','2014-12-31',0,NULL),(6,'Corporate Projects',NULL,'NO','','Manager One','2014-07-01','2014-12-31',0,NULL),(7,'Common Administration',NULL,'NO','','Manager One','2014-01-01','2014-07-04',0,NULL);
/*!40000 ALTER TABLE `program` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `project`
--

DROP TABLE IF EXISTS `project`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `project` (
  `project_id` int(11) NOT NULL AUTO_INCREMENT,
  `programm_id` int(11) DEFAULT NULL,
  `project_name` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `date_start` date DEFAULT NULL,
  `date_end` date DEFAULT NULL,
  `approved_budget` int(11) DEFAULT NULL,
  `notes` text COLLATE utf8_unicode_ci NOT NULL,
  `priority` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `lead` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `level_of_service` varchar(55) COLLATE utf8_unicode_ci NOT NULL,
  `multi_year` varchar(10) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `public_engagement` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `year` varchar(4) COLLATE utf8_unicode_ci NOT NULL,
  `approved` varchar(10) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `progress` varchar(11) COLLATE utf8_unicode_ci NOT NULL,
  `staff_id` int(11) NOT NULL,
  `dept_id` int(11) NOT NULL,
  `budget_spent` int(11) NOT NULL,
  `admin_flag` int(11) NOT NULL,
  PRIMARY KEY (`project_id`),
  KEY `fk_project_program` (`programm_id`),
  CONSTRAINT `fk_project_program` FOREIGN KEY (`programm_id`) REFERENCES `program` (`program_id`)
) ENGINE=InnoDB AUTO_INCREMENT=84 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AVG_ROW_LENGTH=4096;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `project`
--

LOCK TABLES `project` WRITE;
/*!40000 ALTER TABLE `project` DISABLE KEYS */;
INSERT INTO `project` VALUES (56,4,'City Limits Boundary Extension','2014-07-03','2014-12-31',25000,'Staff to fill in','Existing Service - Shared','16','New Level Of Service/Asset(s)','0','0 - No Public Engagement (CAO Authorization Only)','2014','0','0.7',16,4,10000,0),(57,6,'Website redesign','2014-01-01','2014-09-26',80000,'','Existing Service - Shared','15','Upgrade Level Of Service','0','1 - Inform','2014','0','0.6',15,7,75000,0),(58,5,'PC Replacement','2014-01-01','2014-12-31',50000,'','Existing Service - Shared','17','Maintain existing Level Of Service','1','0 - No Public Engagement (CAO Authorization Only)','2014','0','0.40',17,7,10000,0),(59,5,'Server replacement','2014-01-01','2014-12-31',50000,'','Existing Service - Shared','17','Maintain existing Level Of Service','1','0 - No Public Engagement (CAO Authorization Only)','2014','0','0.7',17,7,0,0),(61,6,'Document Management','2014-01-01','2014-12-31',25000,'','Existing Service - Own','15','Upgrade Level Of Service','1','0 - No Public Engagement (CAO Authorization Only)','2014','0','0.20',15,6,5000,0),(62,5,'Copier Replacement','2014-01-01','2014-07-01',50000,'','Existing Service - Shared','15','Maintain existing Level Of Service','1','0 - No Public Engagement (CAO Authorization Only)','2014','0','1',15,7,1000,0),(63,5,'Plotter replacement','2014-01-01','2014-07-01',15000,'','Existing Service - Shared','15','Maintain existing Level Of Service','0','0 - No Public Engagement (CAO Authorization Only)','2014','0','1',15,7,0,0),(65,6,'WorkPlan','2014-05-01','2014-09-30',20000,'','Priority #1 - WorkPlan','15','New Level Of Service/Asset(s)','1','0 - No Public Engagement (CAO Authorization Only)','2014','0','0.5',15,6,0,0),(68,6,'Asset Management','2014-01-01','2014-12-31',30000,'','Existing Service - Shared','15','Upgrade Level Of Service','1','0 - No Public Engagement (CAO Authorization Only)','2014','0','0',15,6,0,0),(69,5,'VoIP','2014-01-01','2014-12-31',30000,'','Existing Service - Shared','15','Upgrade Level Of Service','1','0 - No Public Engagement (CAO Authorization Only)','2014','0','0',15,7,0,0),(70,4,'Orthos','2014-04-01','2014-11-28',30000,'','Priority # 5 - Orthos','16','Upgrade Level Of Service','0','0 - No Public Engagement (CAO Authorization Only)','2014','0','0.5',16,4,0,0),(74,5,'Network','2014-01-01','2014-12-31',25000,'Maintain network, firewall,spam etc','Existing Service - Own','15','Maintain existing Level Of Service','0','0 - No Public Engagement (CAO Authorization Only)','2014','0','0',15,7,0,0),(75,7,'Common Office Admin','2014-01-01','2014-12-31',0,'common catch all for office duties.\r\ncommon catch all for office duties.\r\ncommon catch all for office duties...\r\ncommon catch all for office duties\r\ncommon catch all for office dutiescommon catch all for office dutiescommon catch all for office dutiescommon catch all for office dutiescommon catch all for office dutiescommon catch all for office dutiescommon catch all for office duties','Existing Service - Own','16','Maintain existing Level Of Service','0','0 - No Public Engagement (CAO Authorization Only)','2014','0','0',16,4,0,0),(76,6,'Fibre sub project','2014-11-25','2015-12-24',1000,'','Existing Service - Shared','15','New Level Of Service/Asset(s)','0','0 - No Public Engagement (CAO Authorization Only)','2015','0','0',15,6,0,0),(78,5,'WorkPlan Documentation & Training','2015-01-28','2015-02-26',100,'Create working User and Admin documentation for WorkPlan. Provide ongoing training to next level of administration and select exempt staff.','Priority #1 - WorkPlan','15','One-Time only Project','0','0 - No Public Engagement (CAO Authorization Only)','2015','0','0',15,7,3,0),(80,7,'General Office','2015-02-04','2016-02-12',0,'','Existing Service - Own','15','Maintain existing Level Of Service','0','0 - No Public Engagement (CAO Authorization Only)','2015','0','0',15,7,0,0),(81,5,'TEST123','2015-02-13','2015-02-13',0,'','Existing Service - Own','15','Maintain existing Level Of Service','0','0 - No Public Engagement (CAO Authorization Only)','2015','0','0',15,7,0,0),(82,5,'trtyryrtyrtyrt','2015-02-13','2016-02-25',0,'','Existing Service - Own','1','Maintain existing Level Of Service','0','0 - No Public Engagement (CAO Authorization Only)','2015','0','0',1,7,0,0),(83,7,'TEST12345','2015-03-02','2015-03-12',0,'','Existing Service - Own','21','Maintain existing Level Of Service','0','0 - No Public Engagement (CAO Authorization Only)','2015','0','0',21,6,0,0);
/*!40000 ALTER TABLE `project` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `staff`
--

DROP TABLE IF EXISTS `staff`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `staff` (
  `staff_id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `picture` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `dept_id` int(11) NOT NULL,
  `position` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `emp_number` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`staff_id`),
  UNIQUE KEY `UK_staff_username` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AVG_ROW_LENGTH=8192;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `staff`
--

LOCK TABLES `staff` WRITE;
/*!40000 ALTER TABLE `staff` DISABLE KEYS */;
INSERT INTO `staff` VALUES (1,'admin','admin@domain.org','images/small_admin.png','admin',0,'',''),(15,'Manager One','manager1@domain.org','images/small_generic_female.jpg','manager1',6,'Manager of IT Services','ABC123'),(16,'Manager Two','manager2@domain.org','images/small_generic_male.jpg','manager2',4,'',''),(17,'Manager Three','manager3@domain.org','images/small_Generic_Child_Male.jpg','manager3',6,'',''),(19,'Manager Four','director1@domain.org','images/small_User1.jpg','manager4',7,'',''),(20,'Director Two','director2@domain.org','images/small_User2.jpg','director2',7,'',''),(21,'Test User1','test@test','','password',6,'','');
/*!40000 ALTER TABLE `staff` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `task`
--

DROP TABLE IF EXISTS `task`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `task` (
  `task_id` int(11) NOT NULL AUTO_INCREMENT,
  `project_id` int(11) DEFAULT NULL,
  `assigned_to` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `date_start` date DEFAULT NULL,
  `date_end` date DEFAULT NULL,
  `task_name` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `notes` text COLLATE utf8_unicode_ci NOT NULL,
  `hrs` decimal(10,0) DEFAULT NULL,
  `wo` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `staff_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`task_id`),
  KEY `FK_task_staff_username` (`assigned_to`),
  KEY `fk_task_project` (`project_id`),
  CONSTRAINT `fk_task_project` FOREIGN KEY (`project_id`) REFERENCES `project` (`project_id`)
) ENGINE=InnoDB AUTO_INCREMENT=197 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AVG_ROW_LENGTH=4096;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `task`
--

LOCK TABLES `task` WRITE;
/*!40000 ALTER TABLE `task` DISABLE KEYS */;
INSERT INTO `task` VALUES (130,59,'17','2014-07-04','2014-07-04','Server Maintenance or Build','Build new server for  FTP and GIS ',12000,NULL,17),(149,62,'15','2014-01-01','2014-05-30','RFP Preperation','',35,NULL,15),(150,63,'15','2014-01-01','2014-05-30','RFP Preperation','',40,NULL,15),(151,65,'15','2014-01-01','2014-12-31','Software Development','',400,NULL,15),(152,65,'17','2014-01-01','2014-12-31','Software Development','',40,NULL,17),(178,70,'16','2014-09-23','2014-09-23','Project Mangement','text',14,NULL,16),(179,56,'16','2014-09-30','2014-12-31','Zoning Changes','setup fields',24,NULL,16),(181,59,'15','2014-11-20','2014-12-26','General Office Task','TESTING',7,NULL,15),(182,59,'15','2014-11-20','2014-11-20','PC Rollout or Build','',7,NULL,15),(183,61,'19','2014-11-20','2015-11-20','Initiating Process','Testing',7,NULL,19),(184,56,'15','2014-11-21','2015-11-13','Closing Process','TEST',7,NULL,15),(188,76,'17','2014-11-25','2015-11-19','Initiating Process','',77,NULL,15),(189,58,'15','2015-01-07','2015-01-08','Budget','test',21,NULL,15),(190,68,'15','2015-01-23','2015-02-06','PC Rollout or Build','The moon is a balloon and then some...',21,NULL,15),(192,78,'15','2015-01-28','2015-02-12','General Office Task','Review existing User Guide. Navigate site features and expand documentation notes. Parse Admin level details for Users and recreate Admin Guide',40,NULL,15),(193,75,'16','2015-02-04','2016-02-11','General Office Task','',21,NULL,16),(194,80,'15','2015-02-04','2016-02-12','General Office Task','',21,NULL,15),(195,75,'16','2015-02-04','2015-02-04','General Office Task','',21,NULL,16),(196,62,'16','2015-03-30','2015-06-18','General Office Task','',21,NULL,15);
/*!40000 ALTER TABLE `task` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `task_names`
--

DROP TABLE IF EXISTS `task_names`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `task_names` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Name` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=120 DEFAULT CHARSET=latin1 AVG_ROW_LENGTH=4096;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `task_names`
--

LOCK TABLES `task_names` WRITE;
/*!40000 ALTER TABLE `task_names` DISABLE KEYS */;
INSERT INTO `task_names` VALUES (73,'Zoning Changes'),(75,'Server Maintenance or Build'),(76,'Network Maintenance'),(77,'PC Rollout or Build'),(78,'Project Mangement'),(80,'RFP Preperation'),(84,'General Office Task'),(96,'Software Development'),(100,'Zinger '),(107,'Planning Process'),(108,'Executing Process'),(109,'Initiating Process'),(110,'Monitoring and Controlling Process'),(111,'Closing Process'),(117,'Budget'),(118,'Project Planning'),(119,'Workplan Documentation & Training');
/*!40000 ALTER TABLE `task_names` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `timesheet`
--

DROP TABLE IF EXISTS `timesheet`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `timesheet` (
  `timesheet_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `task_id` int(11) DEFAULT NULL,
  `hours` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `notes` text COLLATE utf8_unicode_ci NOT NULL,
  `time_type` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `date` date NOT NULL,
  `staff_id` int(11) NOT NULL,
  PRIMARY KEY (`timesheet_id`),
  KEY `fk_timesheet_staff` (`staff_id`),
  KEY `fk_timesheet_task` (`task_id`),
  CONSTRAINT `FK_timesheet_task_task_id` FOREIGN KEY (`task_id`) REFERENCES `task` (`task_id`)
) ENGINE=InnoDB AUTO_INCREMENT=394 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AVG_ROW_LENGTH=48;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `timesheet`
--

LOCK TABLES `timesheet` WRITE;
/*!40000 ALTER TABLE `timesheet` DISABLE KEYS */;
INSERT INTO `timesheet` VALUES (164,'Manager Two',178,'2','test',NULL,'2014-07-03',16),(168,'Manager One',181,'7','',NULL,'2014-06-27',15),(183,'Manager One',183,'1.5','',NULL,'2014-07-07',15),(375,'Manager Two',179,'7','work with field setup',NULL,'2014-09-30',16),(378,'Manager Three',152,'7','TEST',NULL,'2014-11-25',17),(379,'manager one',190,'12','We are well under way',NULL,'2015-01-23',15),(380,'manager one',190,'8','wazzle woozle: addendum and add one hour',NULL,'2015-01-23',15),(381,'Manager One',189,'4','research',NULL,'2015-01-27',15),(382,'Manager Two',178,'7','',NULL,'2015-01-28',16),(383,'Manager Two',178,'2','',NULL,'2015-01-28',16),(384,'manager one',192,'3','initial review of site',NULL,'2015-01-28',15),(385,'manager one',150,'1','random time allotment',NULL,'2015-01-29',15),(386,'manager one',189,'8','wazzle woozle: addendum to original efforts',NULL,'2015-01-23',15),(387,'manager one',189,'2','timesheet testing',NULL,'2015-01-30',15),(388,'manager one',189,'1','test of timesheet entry',NULL,'2015-01-30',15),(389,'manager one',184,'4','closing process wont go away',NULL,'2015-01-30',15),(390,'manager two',193,'7','',NULL,'2015-02-04',16),(391,'manager one',194,'7','',NULL,'2015-02-04',15),(392,'Manager One',196,'7','',NULL,'2015-03-30',15),(393,'Manager One',151,'7','',NULL,'2015-06-19',15);
/*!40000 ALTER TABLE `timesheet` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `timetype`
--

DROP TABLE IF EXISTS `timetype`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `timetype` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AVG_ROW_LENGTH=21;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `timetype`
--

LOCK TABLES `timetype` WRITE;
/*!40000 ALTER TABLE `timetype` DISABLE KEYS */;
INSERT INTO `timetype` VALUES (1,'Vacation','Vacation'),(2,'Overtime','Overtime'),(3,'Regular Time','Regular Daily time'),(4,'1NSALF','Non Union Salary full time'),(5,'2NSTAT','Non Union Stat Holiday'),(6,'2NTRN','Non Union Training');
/*!40000 ALTER TABLE `timetype` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_permissions`
--

DROP TABLE IF EXISTS `user_permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_permissions` (
  `user_id` int(11) DEFAULT NULL,
  `page_name` varchar(500) DEFAULT NULL,
  `perm_name` varchar(6) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AVG_ROW_LENGTH=28;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_permissions`
--

LOCK TABLES `user_permissions` WRITE;
/*!40000 ALTER TABLE `user_permissions` DISABLE KEYS */;
INSERT INTO `user_permissions` VALUES (1,'','SELECT'),(1,'','UPDATE'),(1,'','INSERT'),(1,'','DELETE'),(1,'','ADMIN'),(15,'Dashboard','SELECT'),(15,'Hours per Project by user','SELECT'),(15,'timesheet','SELECT'),(15,'timesheet','UPDATE'),(15,'timesheet','INSERT'),(15,'timesheet','DELETE'),(15,'Allocated Hrs by Priority','SELECT'),(15,'Project by Approved Budget','SELECT'),(15,'Project Time Line','SELECT'),(15,'Total hrs Estimated Hrs','SELECT'),(15,'Total Allocated Hrs','SELECT'),(15,'Actual Hours','SELECT'),(15,'Hours per project','SELECT'),(15,'total allocated hours small','SELECT'),(15,'actuall hours versus allocated hours small','SELECT'),(15,'project by approved budget small','SELECT'),(15,'allocated hours by priority small','SELECT'),(15,'actual hours small','SELECT'),(15,'hours per project small','SELECT'),(15,'project timeline small','SELECT'),(15,'department_projects','SELECT'),(15,'department_projects','UPDATE'),(15,'department_projects','INSERT'),(15,'department_projects','DELETE'),(15,'department_projects.task','SELECT'),(15,'department_projects.project','SELECT'),(16,'Dashboard','SELECT'),(16,'Hours per Project by user','SELECT'),(16,'task.timesheet','UPDATE'),(16,'task.timesheet','SELECT'),(16,'timesheet','DELETE'),(16,'Allocated Hrs by Priority','SELECT'),(16,'Project by Approved Budget','SELECT'),(16,'Project Time Line','SELECT'),(16,'Total hrs Estimated Hrs','SELECT'),(16,'Total Allocated Hrs','SELECT'),(16,'Actual Hours','SELECT'),(16,'Hours per project','SELECT'),(16,'Pay Period','SELECT'),(16,'total allocated hours small','SELECT'),(16,'actuall hours versus allocated hours small','SELECT'),(16,'project by approved budget small','SELECT'),(16,'allocated hours by priority small','SELECT'),(16,'actual hours small','SELECT'),(16,'hours per project small','SELECT'),(16,'project timeline small','SELECT'),(16,'department_projects','SELECT'),(16,'department_projects','UPDATE'),(16,'department_projects','INSERT'),(16,'department_projects','DELETE'),(16,'department_projects.task','SELECT'),(16,'department_projects.task','UPDATE'),(16,'department_projects.task','INSERT'),(16,'department_projects.task','DELETE'),(16,'department_projects.project','SELECT'),(16,'department_projects.project','UPDATE'),(16,'department_projects.project','INSERT'),(16,'department_projects.project','DELETE'),(17,'Dashboard','SELECT'),(17,'Hours per Project by user','SELECT'),(17,'timesheet','SELECT'),(17,'timesheet','UPDATE'),(17,'timesheet','INSERT'),(17,'timesheet','DELETE'),(17,'Allocated Hrs by Priority','SELECT'),(17,'Project by Approved Budget','SELECT'),(17,'Project Time Line','SELECT'),(17,'Total hrs Estimated Hrs','SELECT'),(17,'Total Allocated Hrs','SELECT'),(17,'Actual Hours','SELECT'),(17,'Hours per project','SELECT'),(17,'Pay Period','SELECT'),(17,'total allocated hours small','SELECT'),(17,'actuall hours versus allocated hours small','SELECT'),(17,'project by approved budget small','SELECT'),(17,'allocated hours by priority small','SELECT'),(17,'actual hours small','SELECT'),(17,'hours per project small','SELECT'),(17,'project timeline small','SELECT'),(17,'department_projects','SELECT'),(17,'department_projects','UPDATE'),(17,'department_projects','INSERT'),(17,'department_projects','DELETE'),(17,'department_projects.task','SELECT'),(17,'department_projects.project','SELECT'),(19,'Dashboard','SELECT'),(19,'task','SELECT'),(19,'task','UPDATE'),(19,'task','INSERT'),(19,'task','DELETE'),(19,'Hours per Project by user','SELECT'),(19,'timesheet','SELECT'),(19,'timesheet','UPDATE'),(19,'timesheet','INSERT'),(19,'timesheet','DELETE'),(19,'Allocated Hrs by Priority','SELECT'),(19,'Project by Approved Budget','SELECT'),(19,'Project Time Line','SELECT'),(19,'Total hrs Estimated Hrs','SELECT'),(19,'Total Allocated Hrs','SELECT'),(19,'Actual Hours','SELECT'),(19,'Hours per project','SELECT'),(19,'Pay Period','SELECT'),(19,'total allocated hours small','SELECT'),(19,'actuall hours versus allocated hours small','SELECT'),(19,'project by approved budget small','SELECT'),(19,'allocated hours by priority small','SELECT'),(19,'actual hours small','SELECT'),(19,'hours per project small','SELECT'),(19,'project timeline small','SELECT'),(19,'department_projects','SELECT'),(19,'department_projects','UPDATE'),(19,'department_projects','INSERT'),(19,'department_projects','DELETE'),(19,'department_projects.task','SELECT'),(19,'department_projects.task','UPDATE'),(19,'department_projects.task','INSERT'),(19,'department_projects.task','DELETE'),(15,'task','SELECT'),(19,'department_projects.project','SELECT'),(19,'department_projects.project','UPDATE'),(19,'department_projects.project','INSERT'),(19,'department_projects.project','DELETE'),(19,'task.timesheet','SELECT'),(15,'task.timesheet','SELECT'),(15,'task.timesheet','UPDATE'),(15,'task','DELETE'),(15,'task','UPDATE'),(15,'task','INSERT'),(15,'task.timesheet','INSERT'),(15,'task.timesheet','DELETE'),(15,'department_projects.task','UPDATE'),(15,'department_projects.task','INSERT'),(15,'department_projects.task','DELETE'),(15,'department_projects.project','UPDATE'),(15,'department_projects.project','INSERT'),(15,'department_projects.project','DELETE'),(15,'project.task','SELECT'),(15,'project','SELECT'),(15,'project.project','SELECT'),(16,'task.timesheet','INSERT'),(16,'task.timesheet','DELETE'),(15,'project','UPDATE'),(15,'project','INSERT'),(15,'project','DELETE'),(21,'Dashboard','SELECT'),(21,'project','SELECT'),(21,'project','UPDATE'),(21,'project','INSERT'),(21,'project','DELETE'),(21,'project.task','SELECT'),(21,'project.project','SELECT'),(21,'task','SELECT'),(21,'task','UPDATE'),(21,'task','INSERT'),(21,'task','DELETE'),(21,'task.timesheet','SELECT'),(21,'task.timesheet','UPDATE'),(21,'task.timesheet','INSERT'),(21,'task.timesheet','DELETE'),(21,'Hours per Project by user','SELECT'),(21,'Allocated Hrs by Priority','SELECT'),(21,'Project by Approved Budget','SELECT'),(21,'Project Time Line','SELECT'),(21,'Total hrs Estimated Hrs','SELECT'),(21,'Total Allocated Hrs','SELECT'),(21,'Actual Hours','SELECT'),(21,'Hours per project','SELECT'),(21,'total allocated hours small','SELECT'),(21,'actuall hours versus allocated hours small','SELECT'),(21,'project by approved budget small','SELECT'),(21,'allocated hours by priority small','SELECT'),(21,'actual hours small','SELECT'),(21,'hours per project small','SELECT'),(21,'project timeline small','SELECT'),(21,'department_projects','SELECT'),(21,'department_projects','UPDATE'),(21,'department_projects','INSERT'),(21,'department_projects','DELETE'),(21,'department_projects.task','SELECT'),(21,'department_projects.task','UPDATE'),(21,'department_projects.task','INSERT'),(21,'department_projects.task','DELETE'),(21,'department_projects.project','SELECT'),(21,'department_projects.project','UPDATE'),(21,'department_projects.project','INSERT'),(21,'department_projects.project','DELETE'),(15,'project.project_timeline_detail','SELECT'),(15,'project_timeline_detail','SELECT'),(16,'task','SELECT'),(16,'task','UPDATE'),(16,'task','INSERT'),(16,'task','DELETE'),(16,'project_timeline_detail','SELECT'),(15,'Pay Period','SELECT'),(15,'project.ProjectView','SELECT'),(15,'View Pay Period','SELECT'),(16,'project','SELECT'),(16,'project.task','SELECT'),(16,'project.project_timeline_detail','SELECT'),(16,'project.ProjectView','SELECT');
/*!40000 ALTER TABLE `user_permissions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Final view structure for view `ProjectView`
--

/*!50001 DROP TABLE IF EXISTS `ProjectView`*/;
/*!50001 DROP VIEW IF EXISTS `ProjectView`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`%` SQL SECURITY DEFINER */
/*!50001 VIEW `ProjectView` AS select `p`.`project_id` AS `project_id`,`m`.`program_name` AS `project_type`,`p`.`project_name` AS `project_name`,`p`.`date_start` AS `date_start`,`p`.`date_end` AS `date_end`,`p`.`year` AS `year`,'' AS `Objective`,`p`.`priority` AS `priority`,`s`.`username` AS `project_lead`,`p`.`approved_budget` AS `approved_budget`,`p`.`budget_spent` AS `budget_spent`,`p`.`multi_year` AS `multi_year`,`p`.`public_engagement` AS `public_engagement`,`p`.`level_of_service` AS `level_of_service`,`p`.`approved` AS `approved_by_cao`,ifnull(`p`.`progress`,0) AS `progress`,`d`.`DEPARTMENT` AS `DEPARTMENT`,ifnull(sum(`i`.`hours`),0) AS `total_hours`,ifnull(sum(`t`.`hrs`),0) AS `assigned_hours`,(1 - ifnull(`p`.`progress`,0)) AS `assigned_progress` from (((((`project` `p` left join `program` `m` on((`p`.`programm_id` = `m`.`program_id`))) left join `staff` `s` on((`p`.`lead` = `s`.`staff_id`))) left join `department` `d` on((`p`.`dept_id` = `d`.`DEPT_ID`))) left join `task` `t` on((`t`.`project_id` = `p`.`project_id`))) left join `timesheet` `i` on((`t`.`task_id` = `i`.`task_id`))) group by `p`.`project_id` */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2015-09-30 14:06:01
