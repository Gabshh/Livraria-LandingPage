CREATE DATABASE  IF NOT EXISTS `db_mybrary` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `db_mybrary`;
-- MySQL dump 10.13  Distrib 8.0.20, for Win64 (x86_64)
--
-- Host: localhost    Database: db_mybrary
-- ------------------------------------------------------
-- Server version	8.0.20

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
-- Table structure for table `tbl_contatos`
--

DROP TABLE IF EXISTS `tbl_contatos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbl_contatos` (
  `id_contato` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) NOT NULL,
  `sobrenome` varchar(100) NOT NULL,
  `email` varchar(320) NOT NULL,
  `celular` varchar(19) NOT NULL,
  `mensagem` text,
  PRIMARY KEY (`id_contato`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_contatos`
--

LOCK TABLES `tbl_contatos` WRITE;
/*!40000 ALTER TABLE `tbl_contatos` DISABLE KEYS */;
INSERT INTO `tbl_contatos` VALUES (10,'MC','Queen','LightningMCQueen@gmail.com','11940028922','oi sua livraria é top :)'),(11,'Josh','Door','wheresthedoorjosh@gmail.com','11940028922','is right there see'),(12,'MC','Queen','LightningMCQueen@gmail.com','11940028922','oi sua livraria é top :)'),(13,'MC','Queen','LightningMCQueen@gmail.com','11940028922','oi sua livraria é top :)'),(14,'Josh','Door','wheresthedoorjosh@gmail.com','11940028922','is right there see'),(15,'MC','Queen','LightningMCQueen@gmail.com','11940028922','oi sua livraria é top :)'),(16,'MC','Queen','LightningMCQueen@gmail.com','11940028922','oi sua livraria é top :)'),(17,'Josh','Door','wheresthedoorjosh@gmail.com','11940028922','is right there see'),(18,'MC','Queen','LightningMCQueen@gmail.com','11940028922','oi sua livraria é top :)'),(19,'MC','Queen','LightningMCQueen@gmail.com','11940028922','oi sua livraria é top :)'),(20,'Josh','Door','wheresthedoorjosh@gmail.com','11940028922','is right there see'),(21,'MC','Queen','LightningMCQueen@gmail.com','11940028922','oi sua livraria é top :)'),(22,'MC','Queen','LightningMCQueen@gmail.com','11940028922','oi sua livraria é top :)'),(23,'Josh','Door','wheresthedoorjosh@gmail.com','11940028922','is right there see');
/*!40000 ALTER TABLE `tbl_contatos` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2022-04-07 16:53:41
