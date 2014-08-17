-- MySQL dump 10.13  Distrib 5.6.19, for osx10.9 (x86_64)
--
-- Host: localhost    Database: fieldworksdiarydb
-- ------------------------------------------------------
-- Server version	5.6.19

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
-- Table structure for table `finding`
--

DROP TABLE IF EXISTS `finding`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `finding` (
  `id` varchar(48) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL COMMENT 'Finding-Reference',
  `specimenId` varchar(48) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL COMMENT 'Specimen-Reference',
  `specimenCountAll` int(11) DEFAULT NULL,
  `specimenCountMale` int(11) DEFAULT NULL,
  `specimenCountFemales` int(11) DEFAULT NULL,
  `taxon` varchar(200) DEFAULT NULL COMMENT 'Taxon',
  `taxonId` varchar(48) DEFAULT NULL COMMENT 'Taxon-Reference',
  `determiner` varchar(200) DEFAULT NULL COMMENT 'Determinativ',
  `determinationPersonId` varchar(48) DEFAULT NULL COMMENT 'Determined from',
  `determinationDate` date DEFAULT NULL COMMENT 'Date of determination',
  PRIMARY KEY (`id`),
  KEY `specimenId` (`specimenId`),
  KEY `taxonId` (`taxonId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Finding of a specimen';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `label_template`
--

DROP TABLE IF EXISTS `label_template`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `label_template` (
  `id` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `tpl` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL COMMENT 'Etiketten-Vorlage',
  `lw` decimal(4,1) NOT NULL DEFAULT '0.0' COMMENT 'Etiketten-Breite',
  `lh` decimal(4,1) NOT NULL DEFAULT '0.0' COMMENT 'Etiketten-Höhe',
  `b` tinyint(4) NOT NULL DEFAULT '0',
  `bw` decimal(4,1) NOT NULL DEFAULT '0.0' COMMENT 'Randstärke',
  `ls` decimal(4,1) NOT NULL DEFAULT '0.0' COMMENT 'Abstand zwischen den Etiketten',
  `mw` decimal(4,1) NOT NULL DEFAULT '0.0' COMMENT 'Abstand vom Innenrand zum Text',
  `f` varchar(80) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT '' COMMENT 'Schriftart',
  `fs` decimal(4,1) NOT NULL DEFAULT '0.0' COMMENT 'Schriftgröße',
  `lc` decimal(4,1) NOT NULL DEFAULT '0.0' COMMENT 'Anzahl max. Textzeilen',
  `tva` enum('top','middle','bottom') CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT 'middle' COMMENT 'Vertikale Textausrichtung',
  `vlc` tinyint(4) NOT NULL DEFAULT '0' COMMENT 'Anzahl max. vertikale Textzeilen',
  `vtb` enum('right','left') CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT 'left',
  `vtd` enum('bt','tb') CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `c` tinyint(4) NOT NULL DEFAULT '0',
  `cs` enum('inner','outer','all') CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT 'all',
  `p` tinyint(4) NOT NULL DEFAULT '0',
  `pa` enum('custom','center') CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT 'custom',
  `pl` decimal(4,1) NOT NULL DEFAULT '0.0',
  `pe` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `pes` enum('tv','th','fc') CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `pem` decimal(4,1) NOT NULL DEFAULT '0.0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `label_template_preferences`
--

DROP TABLE IF EXISTS `label_template_preferences`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `label_template_preferences` (
  `id` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `ps` varchar(20) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `po` char(1) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `pc` tinyint(4) DEFAULT NULL,
  `lser` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `v` tinyint(4) DEFAULT NULL,
  `vlser` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `specimen`
--

DROP TABLE IF EXISTS `specimen`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `specimen` (
  `id` varchar(48) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL COMMENT 'Reference of specimen',
  `specimenId` varchar(20) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL COMMENT 'Exkursions-Nummer',
  `country` varchar(200) NOT NULL COMMENT 'z.B. Germany',
  `countryCodeIso` varchar(2) DEFAULT NULL,
  `administrative_area_level_1` varchar(200) DEFAULT NULL COMMENT 'administrativeArea (z.B. Bavaria)',
  `administrative_area_level_2` varchar(200) DEFAULT NULL COMMENT 'z.B. Würzburg',
  `administrative_area_level_3` varchar(200) DEFAULT NULL,
  `locality` varchar(200) DEFAULT NULL,
  `sublocality` varchar(200) DEFAULT NULL,
  `latitude` double DEFAULT NULL,
  `longitude` double DEFAULT NULL,
  `horizontalAccuracy` int(6) DEFAULT NULL,
  `altitude` smallint(5) DEFAULT NULL,
  `verticalAccuracy` smallint(5) DEFAULT NULL,
  `beginDate` datetime NOT NULL,
  `endDate` datetime DEFAULT NULL,
  `legit` varchar(200) DEFAULT NULL COMMENT 'gesammelt von',
  `localityName` varchar(200) DEFAULT NULL COMMENT 'Name of locality',
  `localityDescription` varchar(1000) DEFAULT NULL,
  `localityPrefix` varchar(100) DEFAULT NULL,
  `localityMajorId` varchar(100) DEFAULT NULL,
  `localityMinorId` varchar(100) DEFAULT NULL,
  `mgrs` varchar(18) DEFAULT NULL,
  `circumstance` text,
  `notes` text COMMENT 'Diary notes',
  `wetherConditions` text,
  `label` text,
  `fieldsMeta` text COMMENT 'Meta-Daten zu den Feldern',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2014-08-17 18:34:06
