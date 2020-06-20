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
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ads`
--

LOCK TABLES `ads` WRITE;
/*!40000 ALTER TABLE `ads` DISABLE KEYS */;
INSERT INTO `ads` VALUES (1,'/images/1590794957.jpeg',NULL,7,'2020-05-29 23:29:17','2020-05-29 23:29:17'),(2,'/images/1590794973.jpeg',NULL,7,'2020-05-29 23:29:33','2020-05-29 23:29:33'),(6,'/images/1592096520.jpeg',NULL,7,'2020-06-14 01:02:00','2020-06-14 01:02:00');
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
  `latitud` double DEFAULT NULL,
  `longitud` double DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `cars_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cars`
--

LOCK TABLES `cars` WRITE;
/*!40000 ALTER TABLE `cars` DISABLE KEYS */;
INSERT INTO `cars` VALUES (4,11,'2020-06-10 19:55:38','2020-06-10 19:55:38','stratus modelo 2000, rines de aluminio, frenos de disco en las 4 llantas, americano',NULL,NULL);
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
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `comments`
--

LOCK TABLES `comments` WRITE;
/*!40000 ALTER TABLE `comments` DISABLE KEYS */;
INSERT INTO `comments` VALUES (1,'Hola','2020-05-30 20:47:47','2020-05-30 20:47:47',3,7),(2,'Yo lo tengo','2020-05-31 14:41:00','2020-05-31 14:41:00',3,7),(3,'tengo tu espejo, estoy ubicado en la nueva te sale en 300','2020-06-10 01:29:12','2020-06-10 01:29:12',3,11),(4,'yo también lo tengo solo esta un poco roto, te lo dejo bara','2020-06-10 01:30:21','2020-06-10 01:30:21',3,11),(5,'lo tenemos barato','2020-06-14 15:09:10','2020-06-14 15:09:10',11,6),(6,'no lo tenemos en stock','2020-06-14 15:10:04','2020-06-14 15:10:04',11,7),(7,'tiene su muestra','2020-06-14 15:11:01','2020-06-14 15:11:01',11,14);
/*!40000 ALTER TABLE `comments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `comments_car_posts`
--

DROP TABLE IF EXISTS `comments_car_posts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `comments_car_posts` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
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
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `comments_car_posts`
--

LOCK TABLES `comments_car_posts` WRITE;
/*!40000 ALTER TABLE `comments_car_posts` DISABLE KEYS */;
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
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `imgs_cars`
--

LOCK TABLES `imgs_cars` WRITE;
/*!40000 ALTER TABLE `imgs_cars` DISABLE KEYS */;
INSERT INTO `imgs_cars` VALUES (12,'/images/15918189381.jpeg','2020-06-10 19:55:38','2020-06-10 19:55:38',4),(13,'/images/15918189382.jpeg','2020-06-10 19:55:38','2020-06-10 19:55:38',4),(14,'/images/15918189383.jpeg','2020-06-10 19:55:38','2020-06-10 19:55:38',4),(15,'/images/15918189384.jpeg','2020-06-10 19:55:38','2020-06-10 19:55:38',4),(16,'/images/15918189385.jpeg','2020-06-10 19:55:38','2020-06-10 19:55:38',4);
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
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
  `latitud` double DEFAULT NULL,
  `longitud` double DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `owner_id` (`owner_id`),
  CONSTRAINT `negocios_ibfk_1` FOREIGN KEY (`owner_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `negocios`
--

LOCK TABLES `negocios` WRITE;
/*!40000 ALTER TABLE `negocios` DISABLE KEYS */;
/*!40000 ALTER TABLE `negocios` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `notifications`
--

DROP TABLE IF EXISTS `notifications`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `notifications` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned NOT NULL,
  `post_id` bigint(20) unsigned NOT NULL,
  `comment_id` bigint(20) unsigned NOT NULL,
  `to_user_id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `type` tinyint(4) DEFAULT '0',
  `visto` tinyint(4) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `post_id` (`post_id`),
  KEY `comment_id` (`comment_id`),
  KEY `to_user_id` (`to_user_id`),
  CONSTRAINT `notifications_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  CONSTRAINT `notifications_ibfk_2` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`) ON DELETE CASCADE,
  CONSTRAINT `notifications_ibfk_3` FOREIGN KEY (`comment_id`) REFERENCES `comments` (`id`) ON DELETE CASCADE,
  CONSTRAINT `notifications_ibfk_4` FOREIGN KEY (`to_user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `notifications`
--

LOCK TABLES `notifications` WRITE;
/*!40000 ALTER TABLE `notifications` DISABLE KEYS */;
INSERT INTO `notifications` VALUES (1,11,6,5,5,'2020-06-14 15:09:10','2020-06-14 15:09:10',0,0),(2,11,7,6,3,'2020-06-15 19:15:36','2020-06-14 15:10:04',0,1);
/*!40000 ALTER TABLE `notifications` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `notifications_cars`
--

DROP TABLE IF EXISTS `notifications_cars`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `notifications_cars` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned NOT NULL,
  `post_id` bigint(20) unsigned NOT NULL,
  `comment_id` bigint(20) unsigned NOT NULL,
  `to_user_id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `type` tinyint(4) DEFAULT '0',
  `visto` tinyint(4) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `post_id` (`post_id`),
  KEY `comment_id` (`comment_id`),
  KEY `to_user_id` (`to_user_id`),
  CONSTRAINT `notifications_cars_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  CONSTRAINT `notifications_cars_ibfk_2` FOREIGN KEY (`post_id`) REFERENCES `cars` (`id`) ON DELETE CASCADE,
  CONSTRAINT `notifications_cars_ibfk_3` FOREIGN KEY (`comment_id`) REFERENCES `comments_car_posts` (`id`) ON DELETE CASCADE,
  CONSTRAINT `notifications_cars_ibfk_4` FOREIGN KEY (`to_user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `notifications_cars`
--

LOCK TABLES `notifications_cars` WRITE;
/*!40000 ALTER TABLE `notifications_cars` DISABLE KEYS */;
/*!40000 ALTER TABLE `notifications_cars` ENABLE KEYS */;
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
  `latitud` double DEFAULT NULL,
  `longitud` double DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `posts_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `posts`
--

LOCK TABLES `posts` WRITE;
/*!40000 ALTER TABLE `posts` DISABLE KEYS */;
INSERT INTO `posts` VALUES (6,'/images/1590804805.jpeg','Busco volante de vw sedan','2020-05-30 02:13:25','2020-05-30 02:13:25',5,NULL,NULL),(7,'/images/1590854639.jpeg','distribudor de tsuru 3 completo','2020-05-30 16:03:59','2020-05-30 16:03:59',3,NULL,NULL),(10,'/images/1591282009.jpeg','necesito medallon de VW mod 68','2020-06-04 14:46:49','2020-06-04 14:46:49',3,NULL,NULL),(11,'/images/1591282398.jpeg','busco espejo de Ford winstar modelo 2001 americana, electrico','2020-06-04 14:53:18','2020-06-04 14:53:18',3,NULL,NULL),(12,'/images/1591811987.jpeg','defensa de camioneta ford 2005 nacional','2020-06-10 17:59:47','2020-06-10 17:59:47',3,NULL,NULL),(13,'/images/1591813140.jpeg','rin de atos, original','2020-06-10 18:19:00','2020-06-10 18:19:00',11,NULL,NULL),(14,'/images/1591927689.jpeg','disco delantero de stratus americano modelo 2000','2020-06-12 02:08:09','2020-06-12 02:08:09',11,NULL,NULL);
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
INSERT INTO `tipos` VALUES ('2020-05-29 23:26:50','2020-05-29 23:26:50',1,'TALLERES MECÁNICOS'),('2020-05-29 23:26:58','2020-05-29 23:26:58',2,'LAVADO DE AUTOS'),('2020-05-29 23:27:09','2020-05-29 23:27:09',3,'TALLERES DE HOJALATERÍA Y PINTURA'),('2020-05-29 23:27:17','2020-05-29 23:27:17',4,'TALACHERAS'),('2020-05-29 23:27:26','2020-05-29 23:27:26',5,'REPARACIÓN DE CAJAS AUTOMÁTICAS'),('2020-05-29 23:27:41','2020-05-29 23:27:41',6,'AUTOPARTES USADAS'),('2020-05-29 23:27:51','2020-05-29 23:27:51',7,'TALLERES ELÉCTRICOS'),('2020-05-29 23:27:59','2020-05-29 23:27:59',8,'REFACCIONARAS'),('2020-05-29 23:28:05','2020-05-29 23:28:05',9,'LLANTERAS'),('2020-06-01 20:12:40','2020-06-01 20:12:40',11,'Hules Automotrices'),('2020-06-09 18:59:57','2020-06-09 18:59:57',12,'FANTASIA'),('2020-06-10 22:18:23','2020-06-10 22:18:23',13,'BUFETE DE ABOGADOS');
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
  KEY `tipo_id` (`tipo_id`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tipos_negocios`
--

LOCK TABLES `tipos_negocios` WRITE;
/*!40000 ALTER TABLE `tipos_negocios` DISABLE KEYS */;
INSERT INTO `tipos_negocios` VALUES (2,1,2,'2020-04-28 05:27:02','2020-04-28 05:27:02'),(3,1,5,'2020-04-28 05:27:02','2020-04-28 05:27:02'),(10,2,5,'2020-04-30 21:14:16','2020-04-30 21:14:16'),(11,2,8,'2020-04-30 21:14:16','2020-04-30 21:14:16'),(12,3,11,'2020-04-30 21:23:57','2020-04-30 21:23:57'),(25,4,2,'2020-04-30 21:44:56','2020-04-30 21:44:56'),(26,4,8,'2020-04-30 21:44:56','2020-04-30 21:44:56'),(27,5,9,'2020-04-30 21:47:22','2020-04-30 21:47:22'),(28,6,11,'2020-04-30 21:51:41','2020-04-30 21:51:41'),(32,7,9,'2020-05-27 05:42:52','2020-05-27 05:42:52');
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
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'autopartesfary','autopartesfary@gmail.com',NULL,'$2y$10$IvoQ92mJHi0lyryVAlb38ub0QfJnuQGXzavalOXl13E89C91vDq1a','Toluca, Edomex','7292891253',NULL,'2020-05-29 23:23:12','2020-05-29 23:23:12',NULL,'admin'),(2,'Usuario ejemplo','correoprueba1@gmail.com',NULL,'$2y$10$CHe39brP1R62qvWWCbuxMet.9ro4CV/2u6iQl8/5d30pxd8Ubov0e','Atlacomulco, Edomex','7121397374',NULL,'2020-05-29 23:46:55','2020-05-29 23:46:55',NULL,'normal'),(3,'Rodolfo','acevedor180@gmail.com',NULL,'$2y$10$iimSHSLOBnCys0Urjc85WObzn5aGZ7Y9pifEPCT1DLLpi/4gXeWFG','Lago','7222245679',NULL,'2020-05-30 00:16:28','2020-05-30 00:16:28',NULL,'normal'),(5,'José','nitnelav_ah@hotmail.com',NULL,'$2y$10$OP8GJU5isWFK3P3cqtlof.3rur/U2mqxahvER/gmBw.wzWbOMSMbW','San Mateo Oxtotitlán','7221418583',NULL,'2020-05-30 02:12:23','2020-05-30 02:12:23',NULL,'normal'),(10,'Rene','mataconsultor@gmail.com',NULL,'$2y$10$5jYAwvJhCr252WvFPiQv8Oh1EbENki/nXpSzPlt0CnRmgbocKoFX2','Portales 27','2461717447',NULL,'2020-05-31 00:28:47','2020-05-31 00:28:47',NULL,'normal'),(11,'alumno','alumno070180@yahoo.com',NULL,'$2y$10$8aNwhmg.22BBfkIzyms7neS6ft.KRORbfSRO62eBNlEjtqXhwCssi','fdfgfgdgf','2356789012',NULL,'2020-06-10 18:16:46','2020-06-14 15:07:56',NULL,'owner'),(12,'ace','ace_rodolf@hotmail.com',NULL,'$2y$10$3cavSHgD7mcwT4avX0A/GupCZEuHEgUEqc0GGGzo16RYXg6PLiYuS','fdfgfgdgf','7293289123',NULL,'2020-06-12 14:53:33','2020-06-12 14:53:33',NULL,'normal'),(13,'Susan','susan@gmail.com',NULL,'$2y$10$W.isSv1Dq1lBof8UpFP2NuqxSUZX7zHW4FGfph2aI8SYyw/5n/y2S','Gghjkgf','6456665588',NULL,'2020-06-15 19:51:09','2020-06-15 19:51:09',NULL,'normal'),(14,'Rachael Harris','jfboren52@gmail.com',NULL,'$2y$10$3qYdUhAzozjDl0swXOhOiez7AFQFBzr0rb3YEcH.IDX9h6EdfEyTW','979 Kuhic Estate','11601963043',NULL,'2020-06-17 14:42:57','2020-06-17 14:42:57',NULL,'normal'),(15,'Jose Vandervort PhD','ericczerniejewski@yahoo.com',NULL,'$2y$10$mo37sfXy97QyfhN3Sh18Tu46clFCFQOqAZzG85GPLn/xZzyPNdg3.','7878 Rebeka Corners','18918230682',NULL,'2020-06-19 13:25:49','2020-06-19 13:25:49',NULL,'normal');
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

-- Dump completed on 2020-06-20 18:53:22
