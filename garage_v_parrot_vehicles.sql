-- MySQL dump 10.13  Distrib 8.0.36, for Win64 (x86_64)
--
-- Host: localhost    Database: garage_v_parrot
-- ------------------------------------------------------
-- Server version	8.0.36

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
-- Table structure for table `vehicles`
--

DROP TABLE IF EXISTS `vehicles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `vehicles` (
  `id` int NOT NULL AUTO_INCREMENT,
  `make` varchar(255) NOT NULL,
  `model` varchar(255) NOT NULL,
  `year` int NOT NULL,
  `mileage` int NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `description` text,
  `image` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `vehicles`
--

LOCK TABLES `vehicles` WRITE;
/*!40000 ALTER TABLE `vehicles` DISABLE KEYS */;
INSERT INTO `vehicles` VALUES (1,'NOUVEAU','TRUC',456789,3456787,34567890.00,'34567890.00','uploads/IMG-65ce3f4b5ecf39.77093239.jpg'),(2,'toyota','124',2003,20,13000.00,'La carrosserie est bonne et belle en bonne etat','uploads/IMG-65ce62b9b443a5.23392233.png'),(4,'hello','dfghjklkihuyjt',27,30,2345678.00,'fdgvbhjkloijuhygftrthyukjloko',''),(5,'NOUVEAU','xdf',8,11,4555.00,'drfghb ','uploads/IMG-65ce65ea16e635.76856670.jpg'),(6,'NOUVEAU','xdf',8,11,4555.00,'drfghb ','../uploads/65ce681f8d417.jpg'),(9,'test ultime','reussite',2003,200,25000.00,'Cette fois c\'est la bonne!','uploads/IMG-65ce6c4a957180.27669380.jpg'),(11,'test ultime','reussite',2003,200,25000.00,'Cette fois c\'est la bonne!','uploads/IMG-65ce6ca12bd919.62636919.png'),(12,'test ultime','reussite',2003,200,25000.00,'Cette fois c\'est la bonne!','uploads/IMG-65ce6ca42aebd9.87178595.png'),(13,'test ultime reussi felicitation','reussite!!!',2003,200,25000.00,'Cette fois c\'est la bonne! JAI REUSIIII','uploads/IMG-65ce6cd955cb34.57672803.jpg');
/*!40000 ALTER TABLE `vehicles` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-02-16 22:26:09
