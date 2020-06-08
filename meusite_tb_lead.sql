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
-- Table structure for table `tb_lead`
--

DROP TABLE IF EXISTS `tb_lead`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `tb_lead` (
  `idlead` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(30) NOT NULL,
  `telefone` varchar(25) NOT NULL,
  `fk_status` int(11) NOT NULL,
  `data` datetime DEFAULT NULL,
  `email` varchar(45) DEFAULT NULL,
  `site` varchar(45) DEFAULT NULL,
  `dataAtualizada` datetime DEFAULT NULL,
  `fk_origem_lead` int(11) NOT NULL,
  `fk_id_user` int(11) NOT NULL,
  PRIMARY KEY (`idlead`,`fk_status`,`fk_origem_lead`,`fk_id_user`),
  KEY `fk_status_idx` (`fk_status`),
  KEY `fk_origem_lead_idx` (`fk_origem_lead`),
  KEY `fk_id_user_idx` (`fk_id_user`),
  KEY `fk_id_user` (`fk_id_user`)
) ENGINE=InnoDB AUTO_INCREMENT=130 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_lead`
--

LOCK TABLES `tb_lead` WRITE;
/*!40000 ALTER TABLE `tb_lead` DISABLE KEYS */;
INSERT INTO `tb_lead` VALUES (1,'Leo','11 88888',2,'2020-04-01 00:00:00',NULL,NULL,NULL,1,3),(3,'Diego','11 984290978',2,'2020-04-01 00:00:00',NULL,NULL,NULL,1,3),(7,'Maria da Silva','11 331111',5,'2020-04-02 00:00:00','','','2020-04-21 00:00:00',1,0),(9,'Jo Pereira','11 900000',2,'2020-04-02 00:00:00',NULL,NULL,NULL,1,0),(50,'zezeca','123 444444444',2,'2020-04-04 00:00:00',NULL,NULL,NULL,1,0),(60,'mister','3333 222',30,'2020-04-04 00:00:00','','','2020-05-15 19:40:00',1,0),(61,'bobddddsxxxx','225544422',2,'2020-04-06 00:00:00',NULL,NULL,'2020-05-16 19:48:00',1,0),(118,'diego','4443333222',5,'2020-04-12 00:00:00','teste@teste.com','','2020-05-10 11:17:00',1,3),(122,'Clis b','2222222555543',20,'2020-04-15 00:00:00','teste@teste.com','www.google.com.br','2020-05-09 18:50:00',2,0),(129,'Diego M Navarro','(11)11111-1111',29,'2020-05-05 19:29:33','diego@agencianovaacao.com.br','https://agencianovaacao.com.br/','2020-06-05 19:10:00',2,0);
/*!40000 ALTER TABLE `tb_lead` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2020-06-08 10:56:04
