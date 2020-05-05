-- MySQL dump 10.13  Distrib 8.0.16, for Win64 (x86_64)
--
-- Host: localhost    Database: meusite
-- ------------------------------------------------------
-- Server version	5.7.26

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
 SET NAMES utf8 ;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `tb_followup`
--

DROP TABLE IF EXISTS `tb_followup`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `tb_followup` (
  `idfollowup` int(11) NOT NULL AUTO_INCREMENT,
  `texto` varchar(200) NOT NULL,
  `data` date DEFAULT NULL,
  `idlead` int(11) NOT NULL,
  `dataAtualizada` datetime DEFAULT NULL,
  `imagem` varchar(265) DEFAULT NULL,
  PRIMARY KEY (`idfollowup`,`idlead`),
  KEY `idlead_idx` (`idlead`)
) ENGINE=InnoDB AUTO_INCREMENT=58 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_followup`
--

LOCK TABLES `tb_followup` WRITE;
/*!40000 ALTER TABLE `tb_followup` DISABLE KEYS */;
INSERT INTO `tb_followup` VALUES (1,'aaaaaaaaaaaaaaaaa','2020-04-21',119,'2020-05-02 09:33:00',NULL),(3,'nnnnnnnnnnnnnnnnnzzzzzzzzzzzzzzzzz','2020-04-21',125,'2020-05-02 00:00:00',NULL),(7,'nnnnnnnnnnnnnnnnnzzzzzzzzzzzzzzzzz','2020-05-02',125,'2020-05-02 00:00:00',NULL),(9,'ttttt','2020-05-02',113,'2020-05-02 00:00:00',NULL),(14,'eeeeeeeeeeeeexxrr','2020-05-02',122,'2020-05-02 18:53:00',NULL),(15,'eeeeeeeeeeeeexxrraaaaaaaa','2020-05-02',122,'2020-05-02 19:00:00',NULL),(16,'flw2','2020-05-02',126,'2020-05-02 00:00:00',NULL),(17,'flw1','2020-05-02',126,'2020-05-02 00:00:00',NULL),(18,'outroooooooooooooooooxxx','2020-05-02',122,'2020-05-03 09:13:00',NULL),(19,'ssssssssssssssssssssssssssssssssssssssqq','2020-05-03',127,'2020-05-03 17:39:00',NULL),(52,'aaaaaaaaaaaaaaaaeuuuuu222','2020-05-03',127,'2020-05-03 17:52:00',NULL),(56,'nnnn','2020-05-03',127,'2020-05-03 18:06:00',NULL),(57,'Não saber se quer o contrato de SEO','2020-05-05',129,'2020-05-05 19:32:00',NULL);
/*!40000 ALTER TABLE `tb_followup` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2020-05-05 19:43:10
