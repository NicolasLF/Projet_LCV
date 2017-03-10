CREATE DATABASE  IF NOT EXISTS `mydb` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `mydb`;
-- MySQL dump 10.13  Distrib 5.7.17, for Linux (x86_64)
--
-- Host: localhost    Database: mydb
-- ------------------------------------------------------
-- Server version	5.7.17-0ubuntu0.16.04.1

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
-- Table structure for table `client`
--

DROP TABLE IF EXISTS `client`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `client` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nom` varchar(45) DEFAULT NULL COMMENT '	',
  `prenom` varchar(45) DEFAULT NULL,
  `mail` varchar(100) DEFAULT NULL,
  `tel` varchar(45) DEFAULT NULL,
  `password` varchar(45) DEFAULT NULL,
  `pseudo` varchar(45) DEFAULT NULL,
  `admin` int(11) DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `client`
--

LOCK TABLES `client` WRITE;
/*!40000 ALTER TABLE `client` DISABLE KEYS */;
INSERT INTO `client` VALUES (1,'LEFLOHIC','Nicolas','nicolas@gmail.com','07.07.07.07.07',NULL,'Nico',NULL),(2,'Martin','Paul','paul@martin.com','06.06.06.06.06',NULL,NULL,NULL),(3,'Nicolas','Pinsard','nicolas@pinsard.fr','07.08.65.54.27',NULL,NULL,NULL),(4,'Solcain','Pin','s@pin.com','06.38.35.45.79',NULL,NULL,NULL),(5,'Nicdocd','dcdvdc','cdcdc','cdcdcd',NULL,NULL,NULL),(6,'Isabelle','isa','isaaaaa@gmail.com','05.03.07.08.06',NULL,NULL,NULL),(7,'Tanguy','dfdf','jljln','jnflsdfdfs',NULL,NULL,NULL),(8,'Isabelle','isa','sdfdf','qsdffs',NULL,NULL,NULL),(9,'Nicolas','LEFLOHIC','sdfdf','qsdffs',NULL,NULL,NULL),(10,'LEFLOHIC','Nicolas','sdfdf','qsdffs',NULL,NULL,NULL),(11,'Nicolas','LEFLOHIC','sdfdf','qsdffs',NULL,NULL,NULL),(12,'LEFLOHIC','Nicolas','nico@nico.fr','06.38.35.45.79','905a90cd58d616c3877051ee1750518db055e2c4','Nicolasssss',1),(13,'Nicolas','LE FLOHIC','lf.nicolas45@gmail.com','0763553890','cf402b4e52a9f9129e129993c17610737a91770e','Nicolas',1),(14,'LE FLOHIC','Nicolas','lf.nicolas45@gmail.com','0763553890',NULL,NULL,NULL),(15,'Nicolas','LE FLOHIC','lf.nicolas45@gmail.com','0763553890',NULL,NULL,NULL),(16,'sqdsdq','qsdqsd','qsdqs','qsdqs','87df545e7c6d81c2da30f45e84bb6b780bb74082','qdfqsdfsdfs',NULL),(17,'qsdqsd','sqdsdq','qsdqs','qsdqs',NULL,NULL,NULL),(18,'LE FLOHIC','Nicolas','lf.nicolas45@gmail.com','0763553890',NULL,NULL,NULL),(19,'sdfsd','sdfsdf','sdfsdfs@sdfsdfs.fr','05.03.07.08.06','cf402b4e52a9f9129e129993c17610737a91770e','Jeremy',0),(20,'kdkdkd','ksksks','kskdks','0763553890','cf402b4e52a9f9129e129993c17610737a91770e','Froskskd',0),(21,'dsfqsdqfsd','seqfzdfqs','qsfsdfqsd','sfgqsrzed','a64d1fc0b5524eb49f5a48209c49cd6a11403c1f','wdfsdfqdf',0),(22,'sqdqsdqs','qsdqsdqs','sqdqfstrqe','qsdqsdqsdq','d7521178b455a5a57aad970bc01db7c2df6fbfd6','ssdZDFQSDQQS',0),(23,'qsdqsdqs','sqdqsdqs','sqdqfstrqe','qsdqsdqsdq',NULL,NULL,0),(24,'dfqsdqsd','lk&ocirc;po','pok','p,',NULL,NULL,0),(25,'zzzzzzzzzz','qsdqsd','qsdqsdqsd@sdqs.fr','06.38.35.45.79',NULL,NULL,0),(26,'kkkkkkkk','llllllllll','lf.nicolas45@gmail.com','05.03.07.08.06',NULL,NULL,0);
/*!40000 ALTER TABLE `client` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2017-03-10 11:57:58
