-- MySQL dump 10.13  Distrib 5.7.30, for Linux (x86_64)
--
-- Host: localhost    Database: autopartes_fary
-- ------------------------------------------------------
-- Server version	5.7.30-0ubuntu0.18.04.1

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `ads`
--

DROP TABLE IF EXISTS `ads`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ads` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `url` text NOT NULL,
  `negocio_id` bigint(20) unsigned DEFAULT NULL,
  `tiempo` tinyint(3) unsigned DEFAULT '7',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `negocio_id` (`negocio_id`),
  CONSTRAINT `ads_ibfk_1` FOREIGN KEY (`negocio_id`) REFERENCES `negocios` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ads`
--

LOCK TABLES `ads` WRITE;
/*!40000 ALTER TABLE `ads` DISABLE KEYS */;
INSERT INTO `ads` VALUES (11,'/images/1589674201.jpeg',2,7,'2020-05-17 00:10:01','2020-05-17 00:10:01'),(12,'/images/1589674212.jpeg',4,7,'2020-05-17 00:10:12','2020-05-17 00:10:12');
/*!40000 ALTER TABLE `ads` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cars`
--

DROP TABLE IF EXISTS `cars`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cars` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `content` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `cars_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cars`
--

LOCK TABLES `cars` WRITE;
/*!40000 ALTER TABLE `cars` DISABLE KEYS */;
INSERT INTO `cars` VALUES (5,9,'2020-05-17 02:47:37','2020-05-17 02:47:37','Taurus mod 2005 prueba 1.3'),(6,9,'2020-05-17 02:53:07','2020-05-17 02:53:07','Prueba 1.4'),(7,9,'2020-05-17 22:13:52','2020-05-17 22:13:52','en venta caribe modelo 80, nacional con detalles de su modelo, motor recien ajustado'),(8,9,'2020-05-17 22:18:01','2020-05-17 22:18:01','Ford, fermont elite mod 82, factura original, caja de 4 velocidades mas reversa, el motor esta desvielado'),(9,9,'2020-05-18 01:17:15','2020-05-18 01:17:15','En venta crusse fire 2004 americano, legalizado color plata'),(10,10,'2020-05-21 01:53:45','2020-05-21 01:53:45','En venta fermont color gris, modelo 80,  caja original, motor desvielado, factura original');
/*!40000 ALTER TABLE `cars` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `comments`
--

DROP TABLE IF EXISTS `comments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `comments` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `content` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `user_id` bigint(20) unsigned NOT NULL,
  `post_id` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `post_id` (`post_id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`) ON DELETE CASCADE,
  CONSTRAINT `comments_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `comments`
--

LOCK TABLES `comments` WRITE;
/*!40000 ALTER TABLE `comments` DISABLE KEYS */;
INSERT INTO `comments` VALUES (6,'De preferencia que sea nacional','2020-05-17 00:13:20','2020-05-17 00:13:20',1,26),(14,'Yo lo tengo amigo te dejo mi numero 7268262828','2020-05-18 23:56:22','2020-05-18 23:56:22',11,43);
/*!40000 ALTER TABLE `comments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `comments_car_posts`
--

DROP TABLE IF EXISTS `comments_car_posts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `comments_car_posts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned NOT NULL,
  `car_post_id` bigint(20) unsigned NOT NULL,
  `content` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `car_post_id` (`car_post_id`),
  CONSTRAINT `comments_car_posts_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  CONSTRAINT `comments_car_posts_ibfk_2` FOREIGN KEY (`car_post_id`) REFERENCES `cars` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `comments_car_posts`
--

LOCK TABLES `comments_car_posts` WRITE;
/*!40000 ALTER TABLE `comments_car_posts` DISABLE KEYS */;
INSERT INTO `comments_car_posts` VALUES (6,9,5,'Cuanto pide','2020-05-17 02:48:07','2020-05-17 02:48:07'),(7,9,5,'Wwwwww','2020-05-17 02:50:00','2020-05-17 02:50:00');
/*!40000 ALTER TABLE `comments_car_posts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `failed_jobs`
--

LOCK TABLES `failed_jobs` WRITE;
/*!40000 ALTER TABLE `failed_jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `failed_jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `imgs_cars`
--

DROP TABLE IF EXISTS `imgs_cars`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `imgs_cars` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `url` text,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `car_id` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `car_id` (`car_id`),
  CONSTRAINT `imgs_cars_ibfk_1` FOREIGN KEY (`car_id`) REFERENCES `cars` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `imgs_cars`
--

LOCK TABLES `imgs_cars` WRITE;
/*!40000 ALTER TABLE `imgs_cars` DISABLE KEYS */;
INSERT INTO `imgs_cars` VALUES (5,'/images/15896836571.jpeg','2020-05-17 02:47:37','2020-05-17 02:47:37',5),(6,'/images/15896839871.jpeg','2020-05-17 02:53:07','2020-05-17 02:53:07',6),(7,'/images/15897536321.jpeg','2020-05-17 22:13:52','2020-05-17 22:13:52',7),(8,'/images/15897538811.jpeg','2020-05-17 22:18:01','2020-05-17 22:18:01',8),(9,'/images/15897646351.jpeg','2020-05-18 01:17:15','2020-05-18 01:17:15',9),(10,'/images/15900260251.jpeg','2020-05-21 01:53:45','2020-05-21 01:53:45',10);
/*!40000 ALTER TABLE `imgs_cars` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'2014_10_12_000000_create_users_table',1),(2,'2014_10_12_100000_create_password_resets_table',2),(3,'2019_08_19_000000_create_failed_jobs_table',2),(4,'2020_04_08_221740_create_negocios_table',3),(7,'2020_04_08_223411_create_posts_table',4),(8,'2020_04_08_223421_create_comments_table',5),(10,'2020_04_08_231812_adds_api_token_to_users_table',6);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `negocios`
--

DROP TABLE IF EXISTS `negocios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `negocios` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `img` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `owner_id` bigint(20) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `owner_id` (`owner_id`),
  CONSTRAINT `negocios_ibfk_1` FOREIGN KEY (`owner_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `negocios`
--

LOCK TABLES `negocios` WRITE;
/*!40000 ALTER TABLE `negocios` DISABLE KEYS */;
INSERT INTO `negocios` VALUES (1,'J19 Software','Toluca, Edomex','7121397374','jova@gmail.com','/negocios/1588051622.png','2020-04-28 10:27:02','2020-04-28 10:27:02',2),(2,'Refaccionaria Automotriz Chavez','Hidalgo, No. 126 Autlan, Jalisco','3173822248','chavez@gmail.com','/negocios/1588275968.jpeg','2020-05-01 00:46:08','2020-05-01 00:46:08',2),(3,'REFACCIONARIA EL ARBOL','Toluca, Edomex','7121397374','correo_del_negocio@gmail.com','/negocios/1588281837.jpeg','2020-05-01 02:23:57','2020-05-01 02:23:57',2),(4,'REFACCIONARIAS LALO´S','TOLUCA','7121397374','ejemplo@gmail.com','/images/1588283096.jpeg','2020-05-01 02:27:11','2020-05-01 02:44:56',2),(5,'Ancona Autopartes','Toluca, Edomex','7121397374','correo@gmail.com','/images/1588283242.jpeg','2020-05-01 02:47:22','2020-05-01 02:47:22',2),(6,'Refaccionaria Automotriz San Pedro S.A. de C.V','Calle 47 No. 75 Av. Gonernadores','7228116330','negocio@gmail.com','/images/1588283501.jpeg','2020-05-01 02:51:41','2020-05-01 02:51:41',2),(7,'ADALJO','LAS TORRES','2345566777','SDFDFSFDS@DDS','/images/1589847174.jpeg','2020-05-19 00:12:54','2020-05-19 00:12:54',2);
/*!40000 ALTER TABLE `negocios` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_resets`
--

LOCK TABLES `password_resets` WRITE;
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `posts`
--

DROP TABLE IF EXISTS `posts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `posts` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `img` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `content` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `user_id` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `posts_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=48 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `posts`
--

LOCK TABLES `posts` WRITE;
/*!40000 ALTER TABLE `posts` DISABLE KEYS */;
INSERT INTO `posts` VALUES (26,'/images/1589674381.jpeg','Busco una puerta derecha Ford f150','2020-05-17 00:13:01','2020-05-17 00:13:01',1),(37,'/images/1589755797.jpeg','busco cabeza de maquina ford 302, en exelentes condiciones','2020-05-17 22:49:57','2020-05-17 22:49:57',9),(38,'/images/1589755854.jpeg','busco tapa de batea, chevrolet modelo 91 nacional','2020-05-17 22:50:54','2020-05-17 22:50:54',9),(39,'/images/1589755918.jpeg','busco el faro de camioneta, ford lobo mod 2001 original','2020-05-17 22:51:58','2020-05-17 22:51:58',9),(40,'/images/1589764513.jpeg','Ocupo un espejo de neon mod 97 lado derecho original','2020-05-18 01:15:13','2020-05-18 01:15:13',9),(43,NULL,'Cofre de TSURU 3 2004','2020-05-18 23:51:59','2020-05-18 23:51:59',11),(44,NULL,'Facia de crossfire','2020-05-19 00:05:21','2020-05-19 00:05:21',11),(46,'/images/1589846797.jpeg','Jshsbshs','2020-05-19 00:06:37','2020-05-19 00:06:37',11),(47,'/images/1589846827.jpeg','F Favor de','2020-05-19 00:07:07','2020-05-19 00:07:07',11);
/*!40000 ALTER TABLE `posts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tipos`
--

DROP TABLE IF EXISTS `tipos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tipos` (
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tipos`
--

LOCK TABLES `tipos` WRITE;
/*!40000 ALTER TABLE `tipos` DISABLE KEYS */;
INSERT INTO `tipos` VALUES ('2020-04-28 10:25:42','2020-04-28 10:25:42',2,'TALLERES MECANICOS'),('2020-04-28 10:25:47','2020-04-28 10:25:47',3,'LAVADO DE AUTOS'),('2020-04-28 10:26:00','2020-04-28 10:26:00',5,'TALLERES DE HOJALATERIA Y PINTURA'),('2020-04-28 10:26:08','2020-04-28 10:26:08',7,'TALACHERAS'),('2020-04-28 10:26:11','2020-04-28 10:26:11',8,'REPARACION DE CAJAS AUTOMATICAS'),('2020-05-01 02:20:24','2020-05-01 02:20:24',9,'NEGOCIOS DE AUTO PARTES USADAS'),('2020-05-01 02:20:45','2020-05-01 02:20:45',10,'TALLERES ELECTRICOS'),('2020-05-01 02:21:34','2020-05-01 02:21:34',11,'REFACCIONARIAS'),('2020-05-19 00:30:34','2020-05-19 00:30:34',13,'LLANTERAS');
/*!40000 ALTER TABLE `tipos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tipos_negocios`
--

DROP TABLE IF EXISTS `tipos_negocios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tipos_negocios` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `negocio_id` bigint(20) unsigned NOT NULL,
  `tipo_id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `negocio_id` (`negocio_id`),
  KEY `tipo_id` (`tipo_id`),
  CONSTRAINT `tipos_negocios_ibfk_1` FOREIGN KEY (`negocio_id`) REFERENCES `negocios` (`id`) ON DELETE CASCADE,
  CONSTRAINT `tipos_negocios_ibfk_2` FOREIGN KEY (`tipo_id`) REFERENCES `tipos` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tipos_negocios`
--

LOCK TABLES `tipos_negocios` WRITE;
/*!40000 ALTER TABLE `tipos_negocios` DISABLE KEYS */;
INSERT INTO `tipos_negocios` VALUES (2,1,2,'2020-04-28 05:27:02','2020-04-28 05:27:02'),(3,1,5,'2020-04-28 05:27:02','2020-04-28 05:27:02'),(10,2,5,'2020-04-30 21:14:16','2020-04-30 21:14:16'),(11,2,8,'2020-04-30 21:14:16','2020-04-30 21:14:16'),(12,3,11,'2020-04-30 21:23:57','2020-04-30 21:23:57'),(25,4,2,'2020-04-30 21:44:56','2020-04-30 21:44:56'),(26,4,8,'2020-04-30 21:44:56','2020-04-30 21:44:56'),(27,5,9,'2020-04-30 21:47:22','2020-04-30 21:47:22'),(28,6,11,'2020-04-30 21:51:41','2020-04-30 21:51:41'),(29,7,9,'2020-05-19 00:12:54','2020-05-19 00:12:54');
/*!40000 ALTER TABLE `tipos_negocios` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `api_token` varchar(60) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `rol` enum('admin','normal','owner') COLLATE utf8mb4_unicode_ci DEFAULT 'normal',
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_api_token_unique` (`api_token`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'jovanny ramírez chimal','jovannyrch@gmail.com',NULL,'$2y$10$Mf3cWSKrXLP0FjpYqMPn8OtgvnwAEmDxp3negDDQ3rJHcwunAm5M.','Toluca Estado de México','7226227577',NULL,'2020-04-09 01:32:32','2020-04-09 01:32:32',NULL,'admin'),(2,'Otro usuario','mrgbep@gmail.com',NULL,'$2y$10$f8rligpiI.vdBYy39k6afu94NE3CcV.0VBz5FME44jKvfnp3.wKAy','Temascalcingo','7122080680',NULL,'2020-04-12 09:44:56','2020-04-28 10:17:15',NULL,'owner'),(3,'Daniela','j19_r10@hotmail.com',NULL,'$2y$10$7WacnlWfxrc2c6pQ0S0C/ueD.971tJ51IacohJiY28Mq8OamAKfhK','San Francisco Tepeolulco, Edomex','7121397374',NULL,'2020-05-01 03:06:08','2020-05-01 03:06:08',NULL,'normal'),(4,'jovanny ramírez chimal','thejovazrch@gmail.com',NULL,'$2y$10$fZohTZxkt68RCLaXCxkRSuQmmrraefmZDh/d770osZ8cVSHEXup/y','Toluca, Edomex','asd',NULL,'2020-05-04 20:58:11','2020-05-04 20:58:11',NULL,'normal'),(5,'Otro usuario','correo3@gmail.com',NULL,'$2y$10$lF4tEs0306UV2zBlh11LhemK.wTPKQmb0Q3Yf9wxTqs6JXFFaiw9O','Toluca, Edomex','1231231231',NULL,'2020-05-05 00:34:45','2020-05-05 00:34:45',NULL,'normal'),(6,'Otro usuario','jovannyrch3@gmail.com',NULL,'$2y$10$YrQnfZxoq4NkmJqFkVSpN.Ln3FnUCVmcg8ZNdR4pBOy5xL9iE2m/6','Toluca, Edomex','123123123',NULL,'2020-05-07 07:38:56','2020-05-07 07:38:56',NULL,'normal'),(7,'Dueño de negocio','correo4@gmail.com',NULL,'$2y$10$bhrHOeiNR351R6M5ulmACO1.inAFzF4sZHsg/kLyl9mnf9svaLu8y','Toluca, Edomex','7121397374',NULL,'2020-05-17 00:17:01','2020-05-17 00:17:01',NULL,'normal'),(8,'Irving Ramírez Cárdenas','irving@gmail.com',NULL,'$2y$10$iglMsG7EbH4d17SqZxvwAu9MXiyyK.FIw/wtFayC3Kxz4Xy5Z71Bu','Toluca, Edomex','7121397374',NULL,'2020-05-17 00:23:31','2020-05-17 00:23:31',NULL,'normal'),(9,'Rodolfo','ace_rodolf@hotmail.com',NULL,'$2y$10$AwjhTPrXM8Xs9evjyWAsDeCmVTrHV5J89lZQbMl1oJKTqLtu.gVFq','Hola','7292891253',NULL,'2020-05-17 00:43:22','2020-05-18 02:03:10',NULL,'admin'),(10,'Rodolfo1','acevedor180@gmail.com',NULL,'$2y$10$PiumZd99MVeXZfTKpIQxDeCZxq9i9YHrTWbpuBoMjYTUDyX1BCZmK','Atitlan','7222345674',NULL,'2020-05-18 23:18:16','2020-05-18 23:18:16',NULL,'normal'),(11,'David García','karlithasecundino@gmail.com',NULL,'$2y$10$Vo0n2wVMgo1JpyXLSVEe7.eBZVf..wKAJamKtGe8ydi3q4Bq6T81y','Hola','7291552383',NULL,'2020-05-18 23:47:07','2020-05-18 23:47:07',NULL,'normal');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `visitas`
--

DROP TABLE IF EXISTS `visitas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `visitas` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `contador` bigint(20) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=koi8u;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `visitas`
--

LOCK TABLES `visitas` WRITE;
/*!40000 ALTER TABLE `visitas` DISABLE KEYS */;
/*!40000 ALTER TABLE `visitas` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2020-05-22 20:20:50
