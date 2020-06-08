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
  `fk_id_user` int(11) NOT NULL,
  PRIMARY KEY (`idfollowup`,`idlead`),
  KEY `idlead_idx` (`idlead`),
  KEY `fk_id_user_idx` (`fk_id_user`)
) ENGINE=InnoDB AUTO_INCREMENT=78 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_followup`
--

LOCK TABLES `tb_followup` WRITE;
/*!40000 ALTER TABLE `tb_followup` DISABLE KEYS */;
INSERT INTO `tb_followup` VALUES (66,'rrrrrrrrrrrrrrreeetttttrrrrrrrttt0 PPPPPPPPPP','2020-05-10',61,'2020-06-07 20:05:00',NULL,1),(67,'tttttttyyyooouuuu','2020-05-10',61,'2020-06-07 19:15:00','',0),(74,'eseeccccccxxxxxxxxxxxxxxxxxx','2020-05-14',129,'2020-06-07 17:57:00',NULL,0),(75,'eeeeee','2020-05-07',61,'2020-06-07 19:14:00',NULL,1),(76,'outro testeuuuuu','2020-05-07',61,'2020-06-07 19:28:00',NULL,0),(77,'oooooooo','2020-06-07',61,'2020-06-07 19:28:00',NULL,0);
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

-- Dump completed on 2020-06-08 10:56:05
