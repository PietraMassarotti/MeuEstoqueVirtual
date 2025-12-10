-- MySQL dump 10.13  Distrib 8.0.36, for Win64 (x86_64)
--
-- Host: localhost    Database: sistema_estoque
-- ------------------------------------------------------
-- Server version	8.0.37

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
-- Table structure for table `administradores`
--

DROP TABLE IF EXISTS `administradores`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `administradores` (
  `id` smallint unsigned NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) NOT NULL,
  `email` varchar(70) NOT NULL,
  `senha` varchar(60) NOT NULL,
  `create_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `update_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`),
  UNIQUE KEY `email_UNIQUE` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `administradores`
--

LOCK TABLES `administradores` WRITE;
/*!40000 ALTER TABLE `administradores` DISABLE KEYS */;
INSERT INTO `administradores` VALUES (1,'Claudineia','claudineia@email','$2y$10$Z966ei4rixnC5kxc9N5aYuMC3cYyZHszR83.qutdz1WOGBMFJeHhi','2025-12-09 23:36:46','2025-12-09 23:36:46'),(2,'Teste','teste@email','$2y$10$Z966ei4rixnC5kxc9N5aYuMC3cYyZHszR83.qutdz1WOGBMFJeHhi','2025-12-09 23:37:26','2025-12-09 23:37:26'),(3,'Pietra','pietra@email','$2y$10$Z966ei4rixnC5kxc9N5aYuMC3cYyZHszR83.qutdz1WOGBMFJeHhi','2025-12-09 23:37:26','2025-12-09 23:37:26'),(4,'Maria','maria@email','$2y$10$Z966ei4rixnC5kxc9N5aYuMC3cYyZHszR83.qutdz1WOGBMFJeHhi','2025-12-09 23:37:26','2025-12-09 23:37:26');
/*!40000 ALTER TABLE `administradores` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `categorias`
--

DROP TABLE IF EXISTS `categorias`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `categorias` (
  `id` tinyint unsigned NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) NOT NULL,
  `create_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `update_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`),
  UNIQUE KEY `nome_UNIQUE` (`nome`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categorias`
--

LOCK TABLES `categorias` WRITE;
/*!40000 ALTER TABLE `categorias` DISABLE KEYS */;
INSERT INTO `categorias` VALUES (1,'Roupas','2025-12-09 23:37:57','2025-12-09 23:37:57'),(2,'Cosméticos','2025-12-09 23:38:05','2025-12-09 23:38:05'),(3,'Acessórios','2025-12-09 23:39:12','2025-12-09 23:39:12');
/*!40000 ALTER TABLE `categorias` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `clientes`
--

DROP TABLE IF EXISTS `clientes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `clientes` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) NOT NULL,
  `email` varchar(70) NOT NULL,
  `endereco` varchar(255) NOT NULL,
  `telefone` varchar(11) DEFAULT NULL,
  `nasc` date DEFAULT NULL,
  `create_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `update_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`),
  UNIQUE KEY `email_UNIQUE` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `clientes`
--

LOCK TABLES `clientes` WRITE;
/*!40000 ALTER TABLE `clientes` DISABLE KEYS */;
INSERT INTO `clientes` VALUES (1,'Maria Aparecida','maria@email','Cruzeiro, bairro Village','12981111111','1997-06-21','2025-12-09 23:40:23','2025-12-09 23:40:23'),(2,'Marcos Teixeira','teixeira@gmail','Lavrinhas, bairro Mavisou','12982222222','1985-12-10','2025-12-09 23:42:24','2025-12-09 23:42:24'),(3,'Luciana Batista','luciBatista@gmail','Cruzeiro, bairro Parque Primavera','12988888888','2000-05-06','2025-12-09 23:44:06','2025-12-09 23:44:06'),(4,'Roberto Santos','santos@email','Cruzeiro, bairro Vila Romana','12984444444','1987-06-08','2025-12-10 00:02:43','2025-12-10 00:02:43'),(5,'Aline dos Reis','aline@email','Cruzeiro, bairro Village','1298776666','2002-01-03','2025-12-10 00:04:03','2025-12-10 00:04:03');
/*!40000 ALTER TABLE `clientes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `compras`
--

DROP TABLE IF EXISTS `compras`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `compras` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `create_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `update_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `pedidos_id` int unsigned NOT NULL,
  `parcelamentos_id` tinyint unsigned NOT NULL,
  PRIMARY KEY (`id`,`pedidos_id`,`parcelamentos_id`),
  UNIQUE KEY `id_UNIQUE` (`id`),
  KEY `fk_compras_pedidos1_idx` (`pedidos_id`),
  KEY `fk_compras_parcelamentos1_idx` (`parcelamentos_id`),
  CONSTRAINT `fk_compras_parcelamentos1` FOREIGN KEY (`parcelamentos_id`) REFERENCES `parcelamentos` (`id`),
  CONSTRAINT `fk_compras_pedidos1` FOREIGN KEY (`pedidos_id`) REFERENCES `pedidos` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `compras`
--

LOCK TABLES `compras` WRITE;
/*!40000 ALTER TABLE `compras` DISABLE KEYS */;
INSERT INTO `compras` VALUES (1,'2025-12-10 00:01:29','2025-12-10 00:01:29',2,4),(2,'2025-12-10 00:01:39','2025-12-10 00:01:39',1,1),(3,'2025-12-10 00:04:26','2025-12-10 00:04:26',4,3),(4,'2025-12-10 00:04:38','2025-12-10 00:04:38',5,5);
/*!40000 ALTER TABLE `compras` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `marcas`
--

DROP TABLE IF EXISTS `marcas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `marcas` (
  `id` smallint unsigned NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) NOT NULL,
  `create_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `update_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`),
  UNIQUE KEY `nome_UNIQUE` (`nome`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `marcas`
--

LOCK TABLES `marcas` WRITE;
/*!40000 ALTER TABLE `marcas` DISABLE KEYS */;
INSERT INTO `marcas` VALUES (1,'Oboticário','2025-12-09 23:44:52','2025-12-09 23:44:52'),(3,'Pantene','2025-12-09 23:45:17','2025-12-09 23:45:17'),(4,'Natura','2025-12-09 23:45:33','2025-12-09 23:45:33'),(5,'Nike','2025-12-09 23:46:10','2025-12-09 23:46:10'),(6,'Adidas','2025-12-09 23:46:14','2025-12-09 23:46:14');
/*!40000 ALTER TABLE `marcas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `metodos_pagamento`
--

DROP TABLE IF EXISTS `metodos_pagamento`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `metodos_pagamento` (
  `id` tinyint unsigned NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) NOT NULL,
  `create_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `update_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `metodos_pagamento`
--

LOCK TABLES `metodos_pagamento` WRITE;
/*!40000 ALTER TABLE `metodos_pagamento` DISABLE KEYS */;
INSERT INTO `metodos_pagamento` VALUES (1,'Dinheiro Vivo','2025-12-09 23:46:54','2025-12-09 23:46:54'),(2,'Pix','2025-12-09 23:46:57','2025-12-09 23:46:57'),(3,'Cartão (Crédito)','2025-12-09 23:47:06','2025-12-09 23:47:06'),(4,'Cartão (Débito)','2025-12-09 23:47:14','2025-12-09 23:47:14');
/*!40000 ALTER TABLE `metodos_pagamento` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `parcelamentos`
--

DROP TABLE IF EXISTS `parcelamentos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `parcelamentos` (
  `id` tinyint unsigned NOT NULL AUTO_INCREMENT,
  `quantidade` int unsigned NOT NULL,
  `taxa_juros` float unsigned NOT NULL,
  `create_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `update_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `metodos_pagamento_id` tinyint unsigned NOT NULL,
  PRIMARY KEY (`id`,`metodos_pagamento_id`),
  UNIQUE KEY `id_UNIQUE` (`id`),
  KEY `fk_parcelamentos_metodos_pagamento1_idx` (`metodos_pagamento_id`),
  CONSTRAINT `fk_parcelamentos_metodos_pagamento1` FOREIGN KEY (`metodos_pagamento_id`) REFERENCES `metodos_pagamento` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `parcelamentos`
--

LOCK TABLES `parcelamentos` WRITE;
/*!40000 ALTER TABLE `parcelamentos` DISABLE KEYS */;
INSERT INTO `parcelamentos` VALUES (1,4,2,'2025-12-09 23:59:47','2025-12-09 23:59:47',3),(3,8,5,'2025-12-10 00:00:27','2025-12-10 00:00:27',3),(4,1,0,'2025-12-10 00:00:40','2025-12-10 00:00:40',1),(5,1,0,'2025-12-10 00:00:55','2025-12-10 00:00:55',2);
/*!40000 ALTER TABLE `parcelamentos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `parcelas`
--

DROP TABLE IF EXISTS `parcelas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `parcelas` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `numero` smallint unsigned NOT NULL,
  `valor` float NOT NULL,
  `data` date NOT NULL,
  `status` enum('Pago','Pendente','Não Pago','Cancelado','Atrasado') NOT NULL,
  `create_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `update_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `compras_id` int unsigned NOT NULL,
  PRIMARY KEY (`id`,`compras_id`),
  UNIQUE KEY `id_UNIQUE` (`id`),
  KEY `fk_parcelas_compras1_idx` (`compras_id`),
  CONSTRAINT `fk_parcelas_compras1` FOREIGN KEY (`compras_id`) REFERENCES `compras` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `parcelas`
--

LOCK TABLES `parcelas` WRITE;
/*!40000 ALTER TABLE `parcelas` DISABLE KEYS */;
INSERT INTO `parcelas` VALUES (1,1,20,'2026-01-16','Pendente','2025-12-10 00:06:17','2025-12-10 00:06:17',1),(2,1,10,'2025-10-16','Atrasado','2025-12-10 00:08:26','2025-12-10 00:08:26',2);
/*!40000 ALTER TABLE `parcelas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pedidos`
--

DROP TABLE IF EXISTS `pedidos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `pedidos` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `create_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `update_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `clientes_id` int unsigned NOT NULL,
  PRIMARY KEY (`id`,`clientes_id`),
  UNIQUE KEY `id_UNIQUE` (`id`),
  KEY `fk_pedidos_clientes1_idx` (`clientes_id`),
  CONSTRAINT `fk_pedidos_clientes1` FOREIGN KEY (`clientes_id`) REFERENCES `clientes` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pedidos`
--

LOCK TABLES `pedidos` WRITE;
/*!40000 ALTER TABLE `pedidos` DISABLE KEYS */;
INSERT INTO `pedidos` VALUES (1,'2025-12-09 23:58:55','2025-12-09 23:58:55',1),(2,'2025-12-09 23:58:58','2025-12-09 23:58:58',3),(4,'2025-12-10 00:04:09','2025-12-10 00:04:09',5),(5,'2025-12-10 00:04:12','2025-12-10 00:04:12',4);
/*!40000 ALTER TABLE `pedidos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pedidos_has_produtos`
--

DROP TABLE IF EXISTS `pedidos_has_produtos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `pedidos_has_produtos` (
  `quantidade` int unsigned NOT NULL,
  `produtos_id` int unsigned NOT NULL,
  `pedidos_id` int unsigned NOT NULL,
  PRIMARY KEY (`produtos_id`,`pedidos_id`),
  KEY `fk_pedidos_has_produtos_pedidos1_idx` (`pedidos_id`),
  CONSTRAINT `fk_pedidos_has_produtos_pedidos1` FOREIGN KEY (`pedidos_id`) REFERENCES `pedidos` (`id`),
  CONSTRAINT `fk_pedidos_has_produtos_produtos1` FOREIGN KEY (`produtos_id`) REFERENCES `produtos` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pedidos_has_produtos`
--

LOCK TABLES `pedidos_has_produtos` WRITE;
/*!40000 ALTER TABLE `pedidos_has_produtos` DISABLE KEYS */;
/*!40000 ALTER TABLE `pedidos_has_produtos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `produtos`
--

DROP TABLE IF EXISTS `produtos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `produtos` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) NOT NULL,
  `preco` float unsigned NOT NULL,
  `quantidade` smallint unsigned NOT NULL,
  `genero` enum('Masculino','Feminino','Unissex') DEFAULT NULL,
  `descricao` varchar(255) DEFAULT NULL,
  `data_validade` date DEFAULT NULL,
  `create_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `update_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `marcas_id` smallint unsigned NOT NULL,
  `categorias_id` tinyint unsigned NOT NULL,
  PRIMARY KEY (`id`,`marcas_id`,`categorias_id`),
  UNIQUE KEY `id_UNIQUE` (`id`),
  UNIQUE KEY `nome_UNIQUE` (`nome`),
  KEY `fk_produtos_marcas_idx` (`marcas_id`),
  KEY `fk_produtos_categorias1_idx` (`categorias_id`),
  CONSTRAINT `fk_produtos_categorias1` FOREIGN KEY (`categorias_id`) REFERENCES `categorias` (`id`),
  CONSTRAINT `fk_produtos_marcas` FOREIGN KEY (`marcas_id`) REFERENCES `marcas` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `produtos`
--

LOCK TABLES `produtos` WRITE;
/*!40000 ALTER TABLE `produtos` DISABLE KEYS */;
INSERT INTO `produtos` VALUES (1,'Creme para o Corpo Tododia Algodão',65.9,15,'Unissex','Floral Cremoso (Conforto do algodão)','2027-05-14','2025-12-09 23:50:15','2025-12-09 23:50:15',4,2),(2,'Deo Parfum Essencial',170.98,6,'Masculino','Amadeirado Marcante (Notas de cedro, sândalo, e especiarias)','2026-07-30','2025-12-09 23:51:10','2025-12-09 23:51:10',4,2),(3,'Body Splash Cuide-se Bem Nuvem',75,18,'Unissex','Floral Suave (Conforto, notas frescas)','2026-10-20','2025-12-09 23:53:29','2025-12-09 23:53:29',1,2),(4,'Camiseta Nike Sportswear Club',150.65,4,'Feminino','Feita em algodão ou misturas de tecidos, na cor vermelha',NULL,'2025-12-09 23:56:57','2025-12-09 23:56:57',5,1);
/*!40000 ALTER TABLE `produtos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `registros`
--

DROP TABLE IF EXISTS `registros`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `registros` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `quantidade` smallint unsigned NOT NULL,
  `acao` enum('Entrada','Saida') NOT NULL,
  `descricao` varchar(255) DEFAULT NULL,
  `create_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `update_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `produtos_id` int unsigned NOT NULL,
  PRIMARY KEY (`id`,`produtos_id`),
  UNIQUE KEY `quantidade_UNIQUE` (`id`),
  KEY `fk_registros_produtos1_idx` (`produtos_id`),
  CONSTRAINT `fk_registros_produtos1` FOREIGN KEY (`produtos_id`) REFERENCES `produtos` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `registros`
--

LOCK TABLES `registros` WRITE;
/*!40000 ALTER TABLE `registros` DISABLE KEYS */;
INSERT INTO `registros` VALUES (1,5,'Entrada','','2025-12-09 23:57:51','2025-12-09 23:57:51',3),(2,6,'Saida','','2025-12-09 23:58:04','2025-12-09 23:58:04',2),(4,7,'Saida','','2025-12-09 23:58:41','2025-12-09 23:58:41',3),(5,2,'Entrada','','2025-12-10 00:05:21','2025-12-10 00:05:21',2);
/*!40000 ALTER TABLE `registros` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2025-12-10  0:10:33
