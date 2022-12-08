-- MySQL dump 10.13  Distrib 8.0.19, for Win64 (x86_64)
--
-- Host: db3.super10.com.br    Database: medusa
-- ------------------------------------------------------
-- Server version	8.0.26-google

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
SET @MYSQLDUMP_TEMP_LOG_BIN = @@SESSION.SQL_LOG_BIN;
SET @@SESSION.SQL_LOG_BIN= 0;

--
-- GTID state at the beginning of the backup 
--

SET @@GLOBAL.GTID_PURGED=/*!80000 '+'*/ '1ff83fde-5606-11ed-b4ac-42010a80000c:1-737063';

--
-- Table structure for table `messages`
--

DROP TABLE IF EXISTS `messages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `messages` (
  `msg_id` int NOT NULL AUTO_INCREMENT,
  `incoming_msg_id` int NOT NULL,
  `outgoing_msg_id` int NOT NULL,
  `msg` varchar(1000) NOT NULL,
  PRIMARY KEY (`msg_id`)
) ENGINE=InnoDB AUTO_INCREMENT=47 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `messages`
--

LOCK TABLES `messages` WRITE;
/*!40000 ALTER TABLE `messages` DISABLE KEYS */;
INSERT INTO `messages` VALUES (1,964987096,989469550,'teste de mensagem'),(2,989469550,964987096,'mensagem recebida'),(3,363684958,964987096,'oi'),(4,964987096,363684958,'oi'),(5,363684958,964987096,'voltou'),(6,989469550,964987096,'dGVzdGUgZW52aW8='),(7,989469550,964987096,'bWVuc2FnZW0gbm92YQ=='),(8,964987096,989469550,'outra mensagem'),(9,989469550,964987096,'tente de envio'),(10,964987096,228742888,'OI'),(11,228742888,964987096,'oi'),(12,964987096,363684958,'ola'),(13,228742888,964987096,'teste'),(14,228742888,964987096,'lçjdhfslaksjhfds'),(15,228742888,964987096,'ALGUMA COISA '),(16,228742888,964987096,'1'),(17,228742888,964987096,'1'),(18,228742888,964987096,'1'),(19,228742888,964987096,'1'),(20,228742888,964987096,'1'),(21,228742888,964987096,'1'),(22,228742888,964987096,'1'),(23,228742888,964987096,'1'),(24,228742888,964987096,'1'),(25,228742888,964987096,'1'),(26,228742888,964987096,'1'),(27,228742888,964987096,'1'),(28,228742888,964987096,'1'),(29,228742888,964987096,'1'),(30,228742888,964987096,'1'),(31,228742888,964987096,'1'),(32,228742888,964987096,'1'),(33,228742888,964987096,'1'),(34,228742888,964987096,'1'),(35,228742888,964987096,'1'),(36,228742888,964987096,'1'),(37,228742888,964987096,'1'),(38,228742888,964987096,'1'),(39,228742888,964987096,'1'),(40,228742888,964987096,'1'),(41,228742888,964987096,'1'),(42,228742888,964987096,'333333333'),(43,228742888,964987096,'4444444444444444444'),(44,228742888,964987096,'teste mensagem'),(45,964987096,228742888,'eu enviei a mensagem'),(46,964987096,1585435088,'teste ');
/*!40000 ALTER TABLE `messages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `user_id` int NOT NULL AUTO_INCREMENT,
  `unique_id` int NOT NULL,
  `fname` varchar(255) NOT NULL,
  `lname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `img` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,964987096,'Manoel','Gonzaga','ludwigmanoelcarneirogonzaga@gmail.com','f31e846ddc9b4e2a783c7544c07c8783','1667327188teste4k.jpg','Active now'),(2,989469550,'Ludwig','Iriustech','ludwiggonzaga@iriustech.com','f31e846ddc9b4e2a783c7544c07c8783','1667327551fundo.jpg','Offline now'),(3,363684958,'nome laercio 1','last laercio','laercio.reis@iriustech.com','76bb1ff3699e0af3750e9fa119dea44e','1667330569WhatsApp Image 2022-10-20 at 11.30.22.jpeg','Active now'),(4,228742888,'Miguel','Bispo','miguel.bispo@iriustech.com','e10adc3949ba59abbe56e057f20f883e','1669388328Stiker-16 (1).png','Offline now'),(5,1585435088,'User','Test','test@test.com','b88def5dd231ecb62c59d31832cf681b','e2112337dc4e83ce0f8d4e97118fd0d2-resized.png','Active now');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping routines for database 'medusa'
--
SET @@SESSION.SQL_LOG_BIN = @MYSQLDUMP_TEMP_LOG_BIN;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2022-12-07 16:06:52
