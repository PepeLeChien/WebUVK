-- MySQL dump 10.13  Distrib 8.0.38, for Win64 (x86_64)
--
-- Host: monorail.proxy.rlwy.net    Database: DbCine
-- ------------------------------------------------------
-- Server version	8.4.0

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
-- Table structure for table `butaca`
--

DROP TABLE IF EXISTS `butaca`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `butaca` (
  `id` int NOT NULL AUTO_INCREMENT,
  `numero` int DEFAULT NULL,
  `filaButaca` char(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `butaca`
--

LOCK TABLES `butaca` WRITE;
/*!40000 ALTER TABLE `butaca` DISABLE KEYS */;
/*!40000 ALTER TABLE `butaca` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cine`
--

DROP TABLE IF EXISTS `cine`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cine` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) NOT NULL,
  `direccion` varchar(100) DEFAULT NULL,
  `contacto` varchar(50) DEFAULT NULL,
  `latitud` float DEFAULT NULL,
  `longitud` float DEFAULT NULL,
  `url_imagen` varchar(255) DEFAULT NULL,
  `id_ciudad` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_ciudad` (`id_ciudad`),
  CONSTRAINT `cine_ibfk_1` FOREIGN KEY (`id_ciudad`) REFERENCES `ciudad` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cine`
--

LOCK TABLES `cine` WRITE;
/*!40000 ALTER TABLE `cine` DISABLE KEYS */;
INSERT INTO `cine` VALUES (1,'UVK Platino Panorama','Av. Circunvalación Golf Los Incas 134, Santiago de Surco, Lima','123-456-789',-12.0878,-76.9719,'img/cines/panorama.jpg',1),(2,'UVK El Agustino','Centro Comercial Agustino Plaza, Jr. Ancash 2151, El Agustino, Lima','123-456-789',-12.0464,-77.0335,'img/cines/el_agustino.jpg',1),(3,'UVK San Martín','Jr. Ocoña 110, Cercado de Lima, Lima','123-456-789',-12.0464,-77.0428,'img/cines/san_martin.jpg',1),(4,'UVK Huacho','Centro de Huacho','123-456-789',-11.1065,-77.6101,'img/cines/huacho.jpg',2),(5,'UVK Ilo','Centro Comercial Mar Plaza, Jr. Abtao 623, Ilo','123-456-789',-17.6399,-71.3379,'img/cines/ilo.jpg',3),(6,'UVK Piura','Av. Grau 281, Piura','123-456-789',-5.19449,-80.6328,'img/cines/piura.jpg',4),(7,'UVK Tumbes','Costamar Plaza, Jr. San Martín 275, Tumbes','123-456-789',-3.56687,-80.4515,'img/cines/tumbes.jpg',5);
/*!40000 ALTER TABLE `cine` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cineSala`
--

DROP TABLE IF EXISTS `cineSala`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cineSala` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_cine` int NOT NULL,
  `id_sala` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_cine` (`id_cine`),
  KEY `id_sala` (`id_sala`),
  CONSTRAINT `cineSala_ibfk_1` FOREIGN KEY (`id_cine`) REFERENCES `cine` (`id`),
  CONSTRAINT `cineSala_ibfk_2` FOREIGN KEY (`id_sala`) REFERENCES `sala` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cineSala`
--

LOCK TABLES `cineSala` WRITE;
/*!40000 ALTER TABLE `cineSala` DISABLE KEYS */;
INSERT INTO `cineSala` VALUES (1,1,1),(2,1,2),(3,1,3),(4,2,1),(5,2,2),(6,2,3),(7,3,1),(8,3,2),(9,3,3),(10,4,1),(11,4,2),(12,4,3),(13,5,1),(14,5,2),(15,5,3),(16,6,1),(17,6,2),(18,6,3),(19,7,1),(20,7,2),(21,7,3);
/*!40000 ALTER TABLE `cineSala` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ciudad`
--

DROP TABLE IF EXISTS `ciudad`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `ciudad` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ciudad`
--

LOCK TABLES `ciudad` WRITE;
/*!40000 ALTER TABLE `ciudad` DISABLE KEYS */;
INSERT INTO `ciudad` VALUES (1,'Lima'),(2,'Huacho'),(3,'Ilo'),(4,'Piura'),(5,'Tumbes');
/*!40000 ALTER TABLE `ciudad` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `clasificacion`
--

DROP TABLE IF EXISTS `clasificacion`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `clasificacion` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `clasificacion`
--

LOCK TABLES `clasificacion` WRITE;
/*!40000 ALTER TABLE `clasificacion` DISABLE KEYS */;
INSERT INTO `clasificacion` VALUES (3,'APT'),(4,'+14');
/*!40000 ALTER TABLE `clasificacion` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cliente`
--

DROP TABLE IF EXISTS `cliente`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cliente` (
  `id` int NOT NULL AUTO_INCREMENT,
  `dni` varchar(8) DEFAULT NULL,
  `nombre` varchar(50) DEFAULT NULL,
  `apellidos` varchar(50) DEFAULT NULL,
  `telefono` varchar(9) DEFAULT NULL,
  `fecha_nac` date DEFAULT NULL,
  `id_usuario` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_usuario` (`id_usuario`),
  CONSTRAINT `cliente_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cliente`
--

LOCK TABLES `cliente` WRITE;
/*!40000 ALTER TABLE `cliente` DISABLE KEYS */;
/*!40000 ALTER TABLE `cliente` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `compra`
--

DROP TABLE IF EXISTS `compra`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `compra` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_cliente` int NOT NULL,
  `fecha` date NOT NULL,
  `total` decimal(10,2) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_cliente` (`id_cliente`),
  CONSTRAINT `FK_cliente` FOREIGN KEY (`id_cliente`) REFERENCES `cliente` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `compra`
--

LOCK TABLES `compra` WRITE;
/*!40000 ALTER TABLE `compra` DISABLE KEYS */;
/*!40000 ALTER TABLE `compra` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `compraProducto`
--

DROP TABLE IF EXISTS `compraProducto`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `compraProducto` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_compra` int NOT NULL,
  `id_producto` int NOT NULL,
  `cantidad` int NOT NULL,
  `precio_unitario` decimal(10,2) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_compra` (`id_compra`),
  KEY `id_producto` (`id_producto`),
  CONSTRAINT `compraProducto_ibfk_1` FOREIGN KEY (`id_compra`) REFERENCES `compra` (`id`),
  CONSTRAINT `compraProducto_ibfk_2` FOREIGN KEY (`id_producto`) REFERENCES `producto` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `compraProducto`
--

LOCK TABLES `compraProducto` WRITE;
/*!40000 ALTER TABLE `compraProducto` DISABLE KEYS */;
/*!40000 ALTER TABLE `compraProducto` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `compraTicket`
--

DROP TABLE IF EXISTS `compraTicket`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `compraTicket` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_compra` int NOT NULL,
  `id_funcionButaca` int NOT NULL,
  `precio` decimal(10,2) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_compra` (`id_compra`),
  KEY `id_funcionButaca` (`id_funcionButaca`),
  CONSTRAINT `compraTicket_ibfk_1` FOREIGN KEY (`id_compra`) REFERENCES `compra` (`id`),
  CONSTRAINT `compraTicket_ibfk_2` FOREIGN KEY (`id_funcionButaca`) REFERENCES `funcionButaca` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `compraTicket`
--

LOCK TABLES `compraTicket` WRITE;
/*!40000 ALTER TABLE `compraTicket` DISABLE KEYS */;
/*!40000 ALTER TABLE `compraTicket` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `formato`
--

DROP TABLE IF EXISTS `formato`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `formato` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `formato`
--

LOCK TABLES `formato` WRITE;
/*!40000 ALTER TABLE `formato` DISABLE KEYS */;
INSERT INTO `formato` VALUES (1,'2D'),(2,'3D'),(3,'XTREME');
/*!40000 ALTER TABLE `formato` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `funcion`
--

DROP TABLE IF EXISTS `funcion`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `funcion` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_cineSala` int NOT NULL,
  `id_peliculaFormato` int NOT NULL,
  `fecha` date DEFAULT NULL,
  `horario` time DEFAULT NULL,
  `estado` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_cineSala` (`id_cineSala`),
  KEY `id_peliculaFormato` (`id_peliculaFormato`),
  CONSTRAINT `funcion_ibfk_1` FOREIGN KEY (`id_cineSala`) REFERENCES `cineSala` (`id`),
  CONSTRAINT `funcion_ibfk_2` FOREIGN KEY (`id_peliculaFormato`) REFERENCES `peliculaFormato` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=212 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `funcion`
--

LOCK TABLES `funcion` WRITE;
/*!40000 ALTER TABLE `funcion` DISABLE KEYS */;
INSERT INTO `funcion` VALUES (1,1,1,'2024-07-13','15:00:00',1),(2,1,2,'2024-07-13','18:00:00',1),(3,1,3,'2024-07-13','21:00:00',1),(4,1,4,'2024-07-14','15:00:00',1),(5,1,5,'2024-07-14','18:00:00',1),(6,1,6,'2024-07-14','21:00:00',1),(7,1,7,'2024-07-15','15:00:00',1),(8,1,8,'2024-07-15','18:00:00',1),(9,1,9,'2024-07-15','21:00:00',1),(10,1,10,'2024-07-13','12:00:00',1),(11,1,11,'2024-07-13','14:30:00',1),(12,1,12,'2024-07-13','17:00:00',1),(13,1,13,'2024-07-14','12:00:00',1),(14,1,14,'2024-07-14','14:30:00',1),(15,1,15,'2024-07-14','17:00:00',1),(16,1,16,'2024-07-15','12:00:00',1),(17,1,17,'2024-07-15','14:30:00',1),(18,1,18,'2024-07-15','17:00:00',1),(19,1,19,'2024-07-13','13:00:00',1),(20,1,20,'2024-07-13','15:30:00',1),(21,1,21,'2024-07-13','18:00:00',1),(22,1,22,'2024-07-14','13:00:00',1),(23,1,23,'2024-07-14','15:30:00',1),(24,1,24,'2024-07-14','18:00:00',1),(25,1,25,'2024-07-15','13:00:00',1),(26,1,26,'2024-07-15','15:30:00',1),(27,1,27,'2024-07-15','18:00:00',1),(28,1,28,'2024-07-13','11:00:00',1),(29,1,29,'2024-07-13','13:30:00',1),(30,1,30,'2024-07-13','16:00:00',1),(31,1,31,'2024-07-14','11:00:00',1),(32,1,32,'2024-07-14','13:30:00',1),(33,1,33,'2024-07-14','16:00:00',1),(34,1,34,'2024-07-15','11:00:00',1),(35,1,35,'2024-07-15','13:30:00',1),(36,1,36,'2024-07-15','16:00:00',1),(37,4,1,'2024-07-13','15:00:00',1),(38,4,2,'2024-07-13','18:00:00',1),(39,4,3,'2024-07-13','21:00:00',1),(40,4,4,'2024-07-14','15:00:00',1),(41,4,5,'2024-07-14','18:00:00',1),(42,4,6,'2024-07-14','21:00:00',1),(43,4,7,'2024-07-15','15:00:00',1),(44,4,8,'2024-07-15','18:00:00',1),(45,4,9,'2024-07-15','21:00:00',1),(46,4,10,'2024-07-13','12:00:00',1),(47,4,11,'2024-07-13','14:30:00',1),(48,4,12,'2024-07-13','17:00:00',1),(49,4,13,'2024-07-14','12:00:00',1),(50,4,14,'2024-07-14','14:30:00',1),(51,4,15,'2024-07-14','17:00:00',1),(52,4,16,'2024-07-15','12:00:00',1),(53,4,17,'2024-07-15','14:30:00',1),(54,4,18,'2024-07-15','17:00:00',1),(55,4,19,'2024-07-13','13:00:00',1),(56,4,20,'2024-07-13','15:30:00',1),(57,4,21,'2024-07-13','18:00:00',1),(58,4,22,'2024-07-14','13:00:00',1),(59,4,23,'2024-07-14','15:30:00',1),(60,4,24,'2024-07-14','18:00:00',1),(61,4,25,'2024-07-15','13:00:00',1),(62,4,26,'2024-07-15','15:30:00',1),(63,4,27,'2024-07-15','18:00:00',1),(64,4,28,'2024-07-13','11:00:00',1),(65,4,29,'2024-07-13','13:30:00',1),(66,4,30,'2024-07-13','16:00:00',1),(67,4,31,'2024-07-14','11:00:00',1),(68,4,32,'2024-07-14','13:30:00',1),(69,4,33,'2024-07-14','16:00:00',1),(70,4,34,'2024-07-15','11:00:00',1),(71,4,35,'2024-07-15','13:30:00',1),(72,4,36,'2024-07-15','16:00:00',1),(73,7,1,'2024-07-13','15:00:00',1),(74,7,2,'2024-07-13','18:00:00',1),(75,7,3,'2024-07-13','21:00:00',1),(76,7,4,'2024-07-14','15:00:00',1),(77,7,5,'2024-07-14','18:00:00',1),(78,7,6,'2024-07-14','21:00:00',1),(79,7,7,'2024-07-15','15:00:00',1),(80,7,8,'2024-07-15','18:00:00',1),(81,7,9,'2024-07-15','21:00:00',1),(82,7,10,'2024-07-13','12:00:00',1),(83,7,11,'2024-07-13','14:30:00',1),(84,7,12,'2024-07-13','17:00:00',1),(85,7,13,'2024-07-14','12:00:00',1),(86,7,14,'2024-07-14','14:30:00',1),(87,7,15,'2024-07-14','17:00:00',1),(88,7,16,'2024-07-15','12:00:00',1),(89,7,17,'2024-07-15','14:30:00',1),(90,7,18,'2024-07-15','17:00:00',1),(91,7,19,'2024-07-13','13:00:00',1),(92,7,20,'2024-07-13','15:30:00',1),(93,7,21,'2024-07-13','18:00:00',1),(94,7,22,'2024-07-14','13:00:00',1),(95,7,23,'2024-07-14','15:30:00',1),(96,7,24,'2024-07-14','18:00:00',1),(97,7,25,'2024-07-15','13:00:00',1),(98,7,26,'2024-07-15','15:30:00',1),(99,7,27,'2024-07-15','18:00:00',1),(100,7,28,'2024-07-13','11:00:00',1),(101,7,29,'2024-07-13','13:30:00',1),(102,7,30,'2024-07-13','16:00:00',1),(103,7,31,'2024-07-14','11:00:00',1),(104,7,32,'2024-07-14','13:30:00',1),(105,7,33,'2024-07-14','16:00:00',1),(106,7,34,'2024-07-15','11:00:00',1),(107,7,35,'2024-07-15','13:30:00',1),(108,7,36,'2024-07-15','16:00:00',1),(109,10,1,'2024-07-13','15:00:00',1),(110,10,2,'2024-07-13','18:00:00',1),(111,10,3,'2024-07-13','21:00:00',1),(112,10,4,'2024-07-14','15:00:00',1),(113,10,5,'2024-07-14','18:00:00',1),(114,10,6,'2024-07-14','21:00:00',1),(115,10,7,'2024-07-15','15:00:00',1),(116,10,8,'2024-07-15','18:00:00',1),(117,10,9,'2024-07-15','21:00:00',1),(118,10,10,'2024-07-13','12:00:00',1),(119,10,11,'2024-07-13','14:30:00',1),(120,10,12,'2024-07-13','17:00:00',1),(121,10,13,'2024-07-14','12:00:00',1),(122,10,14,'2024-07-14','14:30:00',1),(123,10,15,'2024-07-14','17:00:00',1),(124,10,16,'2024-07-15','12:00:00',1),(125,10,17,'2024-07-15','14:30:00',1),(126,10,18,'2024-07-15','17:00:00',1),(127,10,19,'2024-07-13','13:00:00',1),(128,10,20,'2024-07-13','15:30:00',1),(129,10,21,'2024-07-13','18:00:00',1),(130,10,22,'2024-07-14','13:00:00',1),(131,10,23,'2024-07-14','15:30:00',1),(132,10,24,'2024-07-14','18:00:00',1),(133,10,25,'2024-07-15','13:00:00',1),(134,10,26,'2024-07-15','15:30:00',1),(135,10,27,'2024-07-15','18:00:00',1),(136,10,28,'2024-07-13','11:00:00',1),(137,10,29,'2024-07-13','13:30:00',1),(138,10,30,'2024-07-13','16:00:00',1),(139,10,31,'2024-07-14','11:00:00',1),(140,10,32,'2024-07-14','13:30:00',1),(141,10,33,'2024-07-14','16:00:00',1),(142,10,34,'2024-07-15','11:00:00',1),(143,10,35,'2024-07-15','13:30:00',1),(144,10,36,'2024-07-15','16:00:00',1),(145,13,1,'2024-07-13','15:00:00',1),(146,13,2,'2024-07-13','18:00:00',1),(147,13,3,'2024-07-13','21:00:00',1),(148,13,4,'2024-07-14','15:00:00',1),(149,13,5,'2024-07-14','18:00:00',1),(150,13,6,'2024-07-14','21:00:00',1),(151,14,7,'2024-07-15','15:00:00',1),(152,14,8,'2024-07-15','18:00:00',1),(153,14,9,'2024-07-15','21:00:00',1),(154,14,10,'2024-07-13','12:00:00',1),(155,14,11,'2024-07-13','14:30:00',1),(156,14,12,'2024-07-13','17:00:00',1),(157,15,13,'2024-07-14','12:00:00',1),(158,15,14,'2024-07-14','14:30:00',1),(159,15,15,'2024-07-14','17:00:00',1),(160,15,16,'2024-07-15','12:00:00',1),(161,15,17,'2024-07-15','14:30:00',1),(162,15,18,'2024-07-15','17:00:00',1),(163,16,19,'2024-07-13','13:00:00',1),(164,16,20,'2024-07-13','15:30:00',1),(165,16,21,'2024-07-13','18:00:00',1),(166,16,22,'2024-07-14','13:00:00',1),(167,16,23,'2024-07-14','15:30:00',1),(168,16,24,'2024-07-14','18:00:00',1),(169,16,25,'2024-07-15','13:00:00',1),(170,16,26,'2024-07-15','15:30:00',1),(171,16,27,'2024-07-15','18:00:00',1),(172,17,28,'2024-07-13','11:00:00',1),(173,17,29,'2024-07-13','13:30:00',1),(174,17,30,'2024-07-13','16:00:00',1),(175,17,31,'2024-07-14','11:00:00',1),(176,17,32,'2024-07-14','13:30:00',1),(177,17,33,'2024-07-14','16:00:00',1),(178,17,34,'2024-07-15','11:00:00',1),(179,17,35,'2024-07-15','13:30:00',1),(180,17,36,'2024-07-15','16:00:00',1),(210,6,37,'2024-07-17','05:00:00',1);
/*!40000 ALTER TABLE `funcion` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `funcionButaca`
--

DROP TABLE IF EXISTS `funcionButaca`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `funcionButaca` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_funcion` int NOT NULL,
  `id_butaca` int NOT NULL,
  `estado` enum('Ocupado','Disponible') NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_funcion` (`id_funcion`),
  KEY `id_butaca` (`id_butaca`),
  CONSTRAINT `funcionButaca_ibfk_1` FOREIGN KEY (`id_funcion`) REFERENCES `funcion` (`id`),
  CONSTRAINT `funcionButaca_ibfk_2` FOREIGN KEY (`id_butaca`) REFERENCES `butaca` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `funcionButaca`
--

LOCK TABLES `funcionButaca` WRITE;
/*!40000 ALTER TABLE `funcionButaca` DISABLE KEYS */;
/*!40000 ALTER TABLE `funcionButaca` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `genero`
--

DROP TABLE IF EXISTS `genero`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `genero` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `genero`
--

LOCK TABLES `genero` WRITE;
/*!40000 ALTER TABLE `genero` DISABLE KEYS */;
INSERT INTO `genero` VALUES (1,'Comedia'),(2,'Terror'),(3,'Animación'),(4,'Acción'),(5,'Drama'),(6,'Romance');
/*!40000 ALTER TABLE `genero` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pelicula`
--

DROP TABLE IF EXISTS `pelicula`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `pelicula` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) NOT NULL,
  `descripcion` text,
  `fecha_inicio` date DEFAULT NULL,
  `fecha_fin` date DEFAULT NULL,
  `id_genero` int NOT NULL,
  `id_clasificacion` int NOT NULL,
  `duracion` decimal(10,2) DEFAULT NULL,
  `url_trailer` varchar(100) DEFAULT NULL,
  `url_imagen` varchar(100) DEFAULT NULL,
  `estadoEstreno` enum('Pre-venta','Estreno','Pelicula') NOT NULL,
  `estado` int NOT NULL,
  `url_portada` varchar(200) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_genero` (`id_genero`),
  KEY `id_clasificacion` (`id_clasificacion`),
  CONSTRAINT `pelicula_ibfk_1` FOREIGN KEY (`id_genero`) REFERENCES `genero` (`id`),
  CONSTRAINT `pelicula_ibfk_2` FOREIGN KEY (`id_clasificacion`) REFERENCES `clasificacion` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pelicula`
--

LOCK TABLES `pelicula` WRITE;
/*!40000 ALTER TABLE `pelicula` DISABLE KEYS */;
INSERT INTO `pelicula` VALUES (1,'Viejas Amigas','Una comedia sobre la amistad y la vida en la tercera edad','2024-01-01','2024-01-30',1,3,80.00,'https://example.com/trailer/viejasamigas','public/assets/images/img/peliculas/Amigas.png','Estreno',1,'public/assets/images/img/portadas/viejasAmigas.jpg'),(2,'DeadPool 3','El anti-héroe más irreverente del universo Marvel','2024-02-01','2024-02-28',4,4,108.00,'https://www.youtube.com/embed/UzFZR2dRsSY?enablejsapi=1','public/assets/images/img/peliculas/dealpool.png','Pre-venta',1,'public/assets/images/img/portadas/deadpool3.jpg'),(3,'DemonSlayer','Un joven cazador de demonios busca venganza y redención','2024-03-01','2024-03-31',4,3,103.00,'https://example.com/trailer/demonslayer','public/assets/images/img/peliculas/DemonSlayer.png','Pelicula',1,'public/assets/images/img/portadas/demonSlayer.jpg'),(4,'El Club De Los Vandalos','Un grupo de adolescentes rebeldes cambia su vida a través del arte','2024-04-01','2024-04-30',4,3,116.00,'https://example.com/trailer/clubdelosvandalos','public/assets/images/img/peliculas/ElclubDelosVandalos.png','Pelicula',1,'public/assets/images/img/portadas/clubVandalos.jpg'),(5,'Garfield','El gato más perezoso y cómico del mundo','2024-05-01','2024-05-31',3,3,101.00,'https://example.com/trailer/garfield','public/assets/images/img/peliculas/Garfield.png','Estreno',1,'public/assets/images/img/portadas/garfield.jpg'),(6,'Godzilla','El regreso del rey de los monstruos','2024-06-01','2024-06-30',4,4,115.00,'https://example.com/trailer/godzilla','public/assets/images/img/peliculas/Godzila.png','Pelicula',1,'public/assets/images/img/portadas/godzilla.jpeg'),(7,'Guason2','La continuación de la historia del villano más famoso de Gotham','2024-07-01','2024-07-31',5,4,122.00,'https://example.com/trailer/guason2','public/assets/images/img/peliculas/Guason2.png','Pre-venta',1,'public/assets/images/img/portadas/joker2.jpg'),(8,'Intensamente 2','Las emociones vuelven con nuevas aventuras','2024-08-01','2024-08-31',3,3,96.00,'https://www.youtube-nocookie.com/embed/9bol4Yyx9Gs?si=6oVmq6EI9ygi2Y2W','public/assets/images/img/peliculas/Intensamente2.png','Pre-venta',1,'public/assets/images/img/portadas/intensamente2.jpg'),(9,'OnePiece','El viaje épico de los piratas en busca del tesoro','2024-09-01','2024-09-30',4,3,51.00,'https://example.com/trailer/onepiece','public/assets/images/img/peliculas/onepiece.jpg','Pre-venta',1,'public/assets/images/img/portadas/onePiece.jpg'),(10,'Planeta de los Simios','La guerra por el dominio del planeta entre humanos y simios','2024-10-01','2024-10-31',4,4,145.00,'https://example.com/trailer/planetadelossimios','public/assets/images/img/peliculas/Pelicula.png','Pelicula',1,'public/assets/images/img/portadas/planetaSimios4.jpeg'),(11,'Tarot','Una historia de misterio y predicciones que cambian vidas','2024-11-01','2024-11-30',2,4,92.00,'https://example.com/trailer/tarot','public/assets/images/img/peliculas/Tarot.png','Pre-venta',1,'public/assets/images/img/portadas/tarot.jpg'),(12,'Transformers','La batalla entre Autobots y Decepticons continúa','2024-12-01','2024-12-31',4,3,127.00,'https://example.com/trailer/transformers','public/assets/images/img/peliculas/Transformers.jpg','Pelicula',1,'public/assets/images/img/portadas/transformers7.jpg'),(13,'Un Lugar en Silencio Dia Uno','Sigue a una mujer mientras atraviesa los aterradores primeros momentos de la invasión alienígena en la ciudad más ruidosa del mundo, Nueva York.','2024-07-08','2024-08-05',2,4,100.00,'https://www.youtube-nocookie.com/embed/Xo1iL1cYKxQ?si=1uirL-9Gy16FfFrN','public/assets/images/img\\peliculas\\UnLugarEnSilencion.jpg','Estreno',1,'public/assets/images/img\\portadas\\UnLugarEnSilencionP.jpg');
/*!40000 ALTER TABLE `pelicula` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `peliculaFormato`
--

DROP TABLE IF EXISTS `peliculaFormato`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `peliculaFormato` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_pelicula` int NOT NULL,
  `id_formato` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_pelicula` (`id_pelicula`),
  KEY `id_formato` (`id_formato`),
  CONSTRAINT `peliculaFormato_ibfk_1` FOREIGN KEY (`id_pelicula`) REFERENCES `pelicula` (`id`),
  CONSTRAINT `peliculaFormato_ibfk_2` FOREIGN KEY (`id_formato`) REFERENCES `formato` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=41 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `peliculaFormato`
--

LOCK TABLES `peliculaFormato` WRITE;
/*!40000 ALTER TABLE `peliculaFormato` DISABLE KEYS */;
INSERT INTO `peliculaFormato` VALUES (1,1,1),(2,1,2),(3,1,3),(4,2,1),(5,2,2),(6,2,3),(7,3,1),(8,3,2),(9,3,3),(10,4,1),(11,4,2),(12,4,3),(13,5,1),(14,5,2),(15,5,3),(16,6,1),(17,6,2),(18,6,3),(19,7,1),(20,7,2),(21,7,3),(22,8,1),(23,8,2),(24,8,3),(25,9,1),(26,9,2),(27,9,3),(28,10,1),(29,10,2),(30,10,3),(31,11,1),(32,11,2),(33,11,3),(34,12,1),(35,12,2),(36,12,3),(37,13,1),(38,13,2);
/*!40000 ALTER TABLE `peliculaFormato` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `producto`
--

DROP TABLE IF EXISTS `producto`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `producto` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) NOT NULL,
  `descripcion` text,
  `precio` decimal(10,2) NOT NULL,
  `id_tipo` int NOT NULL,
  `id_tamaño` int NOT NULL,
  `estado` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_tipo` (`id_tipo`),
  KEY `id_tamaño` (`id_tamaño`),
  CONSTRAINT `producto_ibfk_1` FOREIGN KEY (`id_tipo`) REFERENCES `tipo_producto` (`id`),
  CONSTRAINT `producto_ibfk_2` FOREIGN KEY (`id_tamaño`) REFERENCES `tamaño_producto` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `producto`
--

LOCK TABLES `producto` WRITE;
/*!40000 ALTER TABLE `producto` DISABLE KEYS */;
/*!40000 ALTER TABLE `producto` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sala`
--

DROP TABLE IF EXISTS `sala`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `sala` (
  `id` int NOT NULL AUTO_INCREMENT,
  `numero` int DEFAULT NULL,
  `fila` char(1) DEFAULT NULL,
  `id_formato` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_formato` (`id_formato`),
  CONSTRAINT `sala_ibfk_2` FOREIGN KEY (`id_formato`) REFERENCES `formato` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sala`
--

LOCK TABLES `sala` WRITE;
/*!40000 ALTER TABLE `sala` DISABLE KEYS */;
INSERT INTO `sala` VALUES (1,1,NULL,1),(2,2,NULL,2),(3,3,NULL,3);
/*!40000 ALTER TABLE `sala` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tamaño_producto`
--

DROP TABLE IF EXISTS `tamaño_producto`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tamaño_producto` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre` enum('Pequeño','Mediano','Grande') NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tamaño_producto`
--

LOCK TABLES `tamaño_producto` WRITE;
/*!40000 ALTER TABLE `tamaño_producto` DISABLE KEYS */;
INSERT INTO `tamaño_producto` VALUES (1,'Pequeño'),(2,'Mediano'),(3,'Grande');
/*!40000 ALTER TABLE `tamaño_producto` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tipo_producto`
--

DROP TABLE IF EXISTS `tipo_producto`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tipo_producto` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre` enum('Dulce','Salada','Mixta','Bebida','Combo') NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tipo_producto`
--

LOCK TABLES `tipo_producto` WRITE;
/*!40000 ALTER TABLE `tipo_producto` DISABLE KEYS */;
INSERT INTO `tipo_producto` VALUES (1,'Dulce'),(2,'Salada'),(3,'Mixta'),(4,'Bebida'),(5,'Combo');
/*!40000 ALTER TABLE `tipo_producto` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuario`
--

DROP TABLE IF EXISTS `usuario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `usuario` (
  `id` int NOT NULL AUTO_INCREMENT,
  `email` varchar(50) DEFAULT NULL,
  `password` char(60) DEFAULT NULL,
  `rol` enum('Cliente','Administrador') NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuario`
--

LOCK TABLES `usuario` WRITE;
/*!40000 ALTER TABLE `usuario` DISABLE KEYS */;
INSERT INTO `usuario` VALUES (1,'Panetona@correo.com','$2y$10$wTw9kEAn5RHnc.pz1cjXk.18wlU0ET30dw2vhY11wWY26GXV6yxA2','Administrador'),(2,'Lorena@correo.com','$2y$10$33uC8yZaovebfyVTFO3Q0e5qlJ114exGHxv3otzjY7be6sOOZML4.','Administrador');
/*!40000 ALTER TABLE `usuario` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-07-16 11:45:46
