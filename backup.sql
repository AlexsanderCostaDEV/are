-- MySQL dump 10.13  Distrib 8.0.31, for Win64 (x86_64)
--
-- Host: localhost    Database: are
-- ------------------------------------------------------
-- Server version	8.0.31

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

--
-- Table structure for table `events`
--

DROP TABLE IF EXISTS `events`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `events` (
  `id` int NOT NULL AUTO_INCREMENT,
  `title` varchar(220) DEFAULT NULL,
  `color` varchar(10) DEFAULT NULL,
  `start` datetime DEFAULT NULL,
  `end` datetime DEFAULT NULL,
  `usuario_id` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `events`
--

LOCK TABLES `events` WRITE;
/*!40000 ALTER TABLE `events` DISABLE KEYS */;
INSERT INTO `events` VALUES (28,'teste com id update','#436EEE','2023-04-03 00:00:00','2023-04-04 00:00:00',4),(29,'dentista','#FF4500','2023-04-12 00:00:00','2023-04-13 00:00:00',5),(30,'Medico','#0071c5','2023-04-13 00:00:00','2023-04-14 00:00:00',5);
/*!40000 ALTER TABLE `events` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `flashcards`
--

DROP TABLE IF EXISTS `flashcards`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `flashcards` (
  `id_flashcard` int NOT NULL AUTO_INCREMENT,
  `front` varchar(255) NOT NULL,
  `back` varchar(255) NOT NULL,
  `usuario_id` int NOT NULL,
  `hora` datetime NOT NULL,
  PRIMARY KEY (`id_flashcard`)
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `flashcards`
--

LOCK TABLES `flashcards` WRITE;
/*!40000 ALTER TABLE `flashcards` DISABLE KEYS */;
INSERT INTO `flashcards` VALUES (25,'500/2','250',5,'2023-04-02 15:12:51'),(26,'5*5','25',5,'2023-04-02 15:12:52'),(27,'1+89','90',5,'2023-04-02 15:12:52'),(28,'70+30','100',4,'2023-03-18 15:17:59'),(29,'180-30','150',4,'2023-03-19 15:18:00'),(30,'100+10','110\r\n',4,'2023-03-19 15:53:57'),(31,'teste','teste',4,'2023-03-19 15:45:34'),(32,'teste com texto','resposta grande teste blur\r\n',4,'2023-03-19 15:53:58'),(33,'50+50','100',4,'2023-03-18 15:52:26'),(34,'fc aula','fc answer aula',9,'2023-04-11 23:26:39');
/*!40000 ALTER TABLE `flashcards` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `notas`
--

DROP TABLE IF EXISTS `notas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `notas` (
  `id_nota` int NOT NULL AUTO_INCREMENT,
  `campo_nota` varchar(255) NOT NULL,
  `usuario_id` int NOT NULL,
  `nome` varchar(100) NOT NULL,
  `path` varchar(100) NOT NULL,
  `extensao` varchar(10) NOT NULL,
  PRIMARY KEY (`id_nota`)
) ENGINE=InnoDB AUTO_INCREMENT=130 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `notas`
--

LOCK TABLES `notas` WRITE;
/*!40000 ALTER TABLE `notas` DISABLE KEYS */;
INSERT INTO `notas` VALUES (57,'teste555',5,'','',''),(70,'Nota alterado com sucesso',4,'','',''),(74,'Primeira nota 1',9,'','',''),(75,'Segunda nota 2',9,'','',''),(81,'Mais uma nota',4,'','',''),(83,'Nova nota 100',5,'','',''),(115,'Nota 5000',5,'','',''),(123,'cat.png',5,'cat.png','arquivos/64360fd669b14.png','png'),(124,'file_example_WAV_1MG.wav',5,'file_example_WAV_1MG.wav','arquivos/64360fe55a34a.wav','wav'),(125,'cat another.jpg',4,'cat another.jpg','arquivos/643613ded1bb3.jpg','jpg');
/*!40000 ALTER TABLE `notas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `usuarios` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(220) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `usuario` varchar(220) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(220) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `senha` varchar(220) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuarios`
--

LOCK TABLES `usuarios` WRITE;
/*!40000 ALTER TABLE `usuarios` DISABLE KEYS */;
INSERT INTO `usuarios` VALUES (4,'Teemo','teemo@gmail.com','teemo@gmail.com','$2y$10$BnlzLru374C0DQCcImOri.F2kFVEbP1At2RpcLzrMdK5SCByeXQIS'),(5,'Alexsander Souza da Costa','alex@gmail.com','alex@gmail.com','$2y$10$SyfjQpgYGq36u08mfkewreujm1bn9rOeqPVcXVDHvJuLFSdpJ4vK.'),(9,'aula','aula@gmail.com','aula@gmail.com','$2y$10$qGZRVFSTP/zQ8WImbRv3HemVeS0./JdgJcLpFQB5TqF1P9zezbZeS'),(10,'Alexsander','alexsander0souza@gmail.com','alexsander0souza@gmail.com','$2y$10$rUw65hC2jTyvpu9dG4HuO.FOS2BioJ70fa4VYn1Z50wgs2yEqTfW.');
/*!40000 ALTER TABLE `usuarios` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2023-04-15  7:53:52
