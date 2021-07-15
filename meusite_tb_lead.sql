-- MySQL dump 10.13  Distrib 8.0.22, for Win64 (x86_64)
--
-- Host: localhost    Database: meusite
-- ------------------------------------------------------
-- Server version	8.0.21

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
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
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tb_lead` (
  `idlead` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(30) NOT NULL,
  `empresa` varchar(45) DEFAULT NULL,
  `telefone` varchar(25) NOT NULL,
  `fk_status` int NOT NULL,
  `data` datetime DEFAULT NULL,
  `email` varchar(45) DEFAULT NULL,
  `site` varchar(45) DEFAULT NULL,
  `dataAtualizada` datetime DEFAULT NULL,
  `fk_origem_lead` int NOT NULL,
  `fk_id_user` int NOT NULL,
  `fk_id_user_atualiza` int NOT NULL,
  `ultimo_followup` varchar(50) DEFAULT NULL,
  `fk_id_cliente` int NOT NULL,
  PRIMARY KEY (`idlead`,`fk_status`,`fk_origem_lead`,`fk_id_user`,`fk_id_cliente`),
  KEY `fk_status_idx` (`fk_status`),
  KEY `fk_origem_lead_idx` (`fk_origem_lead`),
  KEY `fk_id_user_idx` (`fk_id_user`),
  KEY `fk_id_user` (`fk_id_user`),
  KEY `fk_id_cliente_idx` (`fk_id_cliente`)
) ENGINE=InnoDB AUTO_INCREMENT=179 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_lead`
--

LOCK TABLES `tb_lead` WRITE;
/*!40000 ALTER TABLE `tb_lead` DISABLE KEYS */;
INSERT INTO `tb_lead` VALUES (170,'rrrrrrrr','eeeeeeeeee','(33)33333-3333',27,'2020-08-16 18:00:10','','','2020-09-24 18:54:00',1,1,1,'2020-09-21 11:24',1),(171,'jojo','xxxx','(33)33333-3333',1,'2020-09-08 17:56:34','teste@este.com','','2020-09-08 17:56:34',1,0,0,'2020-10-25 12:18',2),(172,'xxxxxxxxxxxxxxxx','aaaaaaaaaaaa','(44)44444-4444',20,'2020-09-10 18:49:49','teste@tese.com','','2020-09-18 20:38:00',1,1,1,'2020-09-18 17:32',1),(173,'João','ABC auto','(11)11111-1111',20,'2020-09-26 08:51:17','jo@gmail.com','','2020-10-05 19:42:00',3,0,1,'2020-09-26 08:57',1),(174,'pedro','larara','(11)11111-1111',1,'2020-10-25 12:56:21','teste@tete.com','','2020-10-25 12:56:21',1,0,0,'2020-10-25 12:57',2),(178,'teste','aaasssss','(11)1111-1',1,'2020-11-01 17:51:24','test@tet.com','','2020-11-01 19:05:00',1,0,1,'2021-01-16 13:15',1);
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

-- Dump completed on 2021-07-15 20:26:45
