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
-- Table structure for table `tb_lembrete`
--

DROP TABLE IF EXISTS `tb_lembrete`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tb_lembrete` (
  `id_lembrete` int NOT NULL AUTO_INCREMENT,
  `autor` int NOT NULL,
  `data_lembrete` date NOT NULL,
  `data_lembrete_final` date DEFAULT NULL,
  `date_criado` date NOT NULL,
  `texto_lembrete` varchar(100) NOT NULL,
  `fk_idfollowup` int NOT NULL,
  `fk_id_cliente` int NOT NULL,
  `fk_idlead` int NOT NULL,
  PRIMARY KEY (`id_lembrete`),
  KEY `fk_id_cliente_idx` (`fk_id_cliente`),
  KEY `fk_idfollowup_idx` (`fk_idfollowup`),
  KEY `fk_idlead_idx` (`fk_idlead`)
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_lembrete`
--

LOCK TABLES `tb_lembrete` WRITE;
/*!40000 ALTER TABLE `tb_lembrete` DISABLE KEYS */;
INSERT INTO `tb_lembrete` VALUES (28,1,'2020-09-27','2020-09-30','2020-09-26','teste aaaaaaaaaaaaaaa aaaaaaaaaaa aaaaaaaaaaaaaa a aaaaaaaaa aaaa aaaa a aaa a aaaaaaaaaaaaa aaaaaaa',16,1,173),(29,1,'2020-09-25','2020-09-26','2020-09-26','aaaaarrrr',16,1,173),(30,1,'2020-09-30','2020-09-30','2020-09-26','tttttttttttttttt',16,1,173),(31,1,'2020-09-26','2020-09-27','2020-09-26','ttttttttttttt',16,1,173),(33,1,'2020-10-02',NULL,'2020-10-02','maisssssssssssssssss',16,1,173);
/*!40000 ALTER TABLE `tb_lembrete` ENABLE KEYS */;
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
