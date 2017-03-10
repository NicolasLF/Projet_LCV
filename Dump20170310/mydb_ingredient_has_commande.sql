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
-- Table structure for table `ingredient_has_commande`
--

DROP TABLE IF EXISTS `ingredient_has_commande`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ingredient_has_commande` (
  `ingredient_id` int(10) unsigned NOT NULL,
  `commande_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`ingredient_id`,`commande_id`),
  KEY `fk_ingredient_has_commande_commande1_idx` (`commande_id`),
  KEY `fk_ingredient_has_commande_ingredient_idx` (`ingredient_id`),
  CONSTRAINT `fk_ingredient_has_commande_commande1` FOREIGN KEY (`commande_id`) REFERENCES `commande` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_ingredient_has_commande_ingredient` FOREIGN KEY (`ingredient_id`) REFERENCES `ingredient` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ingredient_has_commande`
--

LOCK TABLES `ingredient_has_commande` WRITE;
/*!40000 ALTER TABLE `ingredient_has_commande` DISABLE KEYS */;
INSERT INTO `ingredient_has_commande` VALUES (1,1),(1,5),(5,5),(8,5),(5,6),(8,6),(5,7),(8,7),(1,8),(5,8),(8,8),(5,9),(8,9),(9,9),(8,10),(9,10),(8,11),(9,11),(5,12),(8,12),(1,13),(5,13),(8,13),(9,13),(11,13),(5,14),(9,14),(11,14),(1,15),(5,15),(9,15),(11,15),(1,16),(5,16),(8,16),(9,16),(11,16),(12,16),(13,16),(5,17),(8,17),(9,17),(11,17),(12,17),(5,19),(8,19),(9,19),(12,19),(8,20),(9,20),(11,20),(8,21),(9,21),(11,21),(9,22),(11,22),(12,22),(5,23),(8,23),(11,23),(12,23),(5,24),(9,24),(11,24),(9,25),(11,25),(1,26),(5,26),(8,26),(11,26),(12,26),(8,27),(9,27),(11,27),(8,28),(9,28),(11,28),(12,28),(1,29),(5,29),(8,29),(1,30),(5,30),(8,30),(9,30),(8,31),(9,31),(11,31),(5,32),(8,32),(9,32),(11,32),(1,33),(5,33),(8,33),(9,33),(11,33),(12,33),(13,33),(1,34),(5,34),(8,34),(9,34),(11,34),(12,34),(13,34),(8,35),(9,35),(11,35),(12,35),(1,36),(5,36),(8,36),(11,36);
/*!40000 ALTER TABLE `ingredient_has_commande` ENABLE KEYS */;
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
