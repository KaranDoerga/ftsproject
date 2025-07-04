-- MySQL dump 10.13  Distrib 9.0.1, for Win64 (x86_64)
--
-- Host: localhost    Database: ftsdb
-- ------------------------------------------------------
-- Server version	9.0.1

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
-- Table structure for table `bookings`
--

DROP TABLE IF EXISTS `bookings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `bookings` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `festival_id` bigint unsigned NOT NULL,
  `route_id` bigint unsigned DEFAULT NULL,
  `person_amount` int NOT NULL,
  `status` enum('booked','canceled') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'booked',
  `points_earned` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `bookings_user_id_foreign` (`user_id`),
  KEY `bookings_festival_id_foreign` (`festival_id`),
  KEY `bookings_route_id_foreign` (`route_id`),
  CONSTRAINT `bookings_festival_id_foreign` FOREIGN KEY (`festival_id`) REFERENCES `festivals` (`id`) ON DELETE CASCADE,
  CONSTRAINT `bookings_route_id_foreign` FOREIGN KEY (`route_id`) REFERENCES `routes` (`id`) ON DELETE SET NULL,
  CONSTRAINT `bookings_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bookings`
--

LOCK TABLES `bookings` WRITE;
/*!40000 ALTER TABLE `bookings` DISABLE KEYS */;
INSERT INTO `bookings` VALUES (1,1,1,1,1,'booked',890,'2025-06-04 19:11:42','2025-06-04 19:11:42'),(2,1,2,3,1,'booked',890,'2025-06-04 19:13:49','2025-06-04 19:13:49'),(3,1,1,1,3,'booked',69,'2025-06-04 19:19:15','2025-06-04 19:19:15');
/*!40000 ALTER TABLE `bookings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `buses`
--

DROP TABLE IF EXISTS `buses`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `buses` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `capacity` int NOT NULL,
  `license_plate` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `available` tinyint(1) NOT NULL DEFAULT '1',
  `driver` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `buses`
--

LOCK TABLES `buses` WRITE;
/*!40000 ALTER TABLE `buses` DISABLE KEYS */;
/*!40000 ALTER TABLE `buses` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cache`
--

DROP TABLE IF EXISTS `cache`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cache`
--

LOCK TABLES `cache` WRITE;
/*!40000 ALTER TABLE `cache` DISABLE KEYS */;
/*!40000 ALTER TABLE `cache` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cache_locks`
--

DROP TABLE IF EXISTS `cache_locks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cache_locks`
--

LOCK TABLES `cache_locks` WRITE;
/*!40000 ALTER TABLE `cache_locks` DISABLE KEYS */;
/*!40000 ALTER TABLE `cache_locks` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `failed_jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
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
-- Table structure for table `festivals`
--

DROP TABLE IF EXISTS `festivals`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `festivals` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `location_adress` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `postal_code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `city` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `country` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `line_up` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `music_genre` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ticket_price` decimal(8,2) NOT NULL,
  `status` enum('concept','published','sold_out') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'concept',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `festivals`
--

LOCK TABLES `festivals` WRITE;
/*!40000 ALTER TABLE `festivals` DISABLE KEYS */;
INSERT INTO `festivals` VALUES (1,'Lowlands','Groot muziekfestival in Nederland.','2025-08-15','2025-08-17','Spijkweg 30','8256 RJ','Biddinghuizen','Nederland','Dua Lipa, Arctic Monkeys, Bicep','Pop','lowlands.jpg',230.00,'published','2025-06-04 18:41:53','2025-06-04 18:41:53'),(2,'Tomorrowland','Wereldberoemd dancefestival in Belgi├½.','2025-07-20','2025-07-22','De Schorre','2850','Boom','Belgi├½','Martin Garrix, David Guetta, Ti├½sto','EDM','tomorrowland.jpg',310.00,'published','2025-06-04 18:41:53','2025-06-04 18:41:53'),(3,'Rock Werchter','Populair rockfestival in Belgi├½.','2025-07-10','2025-07-13','Haachtsesteenweg','3118','Werchter','Belgi├½','Foo Fighters, Red Hot Chili Peppers','Rock','rockwerchter.jpg',280.00,'published','2025-06-04 18:41:53','2025-06-04 18:41:53'),(4,'Pinkpop','Een van de oudste festivals in Nederland.','2025-06-07','2025-06-09','Megaland','6372 XC','Landgraaf','Nederland','Imagine Dragons, The Script','Pop','pinkpop.jpg',195.00,'published','2025-06-04 18:41:53','2025-06-04 18:41:53'),(5,'Melt Festival','Alternatief elektronisch festival in Duitsland.','2025-07-19','2025-07-21','Ferropolis','06773','Gr├ñfenhainichen','Duitsland','R├Âyksopp, Bonobo','Electronic','melt.jpg',215.00,'published','2025-06-04 18:41:53','2025-06-04 18:41:53'),(6,'Primavera Sound','Eclectisch stadsfestival in Spanje.','2025-06-05','2025-06-07','Parc del F├▓rum','08019','Barcelona','Spanje','Tame Impala, Beck, Lorde','Indie','primavera.jpg',260.00,'published','2025-06-04 18:41:53','2025-06-04 18:41:53'),(7,'Awakenings','Hard techno en house festival.','2025-07-06','2025-07-07','Spaarnwoude','1164','Velsen-Zuid','Nederland','Amelie Lens, Charlotte de Witte','Techno','awakenings.jpg',180.00,'published','2025-06-04 18:41:53','2025-06-04 18:41:53'),(8,'Lollapalooza Berlin','Internationaal festival met pop en alternative.','2025-09-07','2025-09-08','Olympiastadion','14053','Berlijn','Duitsland','Billie Eilish, The Killers','Pop, Indie','lollapalooza.jpg',240.00,'published','2025-06-04 18:41:53','2025-06-04 18:41:53');
/*!40000 ALTER TABLE `festivals` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `job_batches`
--

DROP TABLE IF EXISTS `job_batches`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `job_batches` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `job_batches`
--

LOCK TABLES `job_batches` WRITE;
/*!40000 ALTER TABLE `job_batches` DISABLE KEYS */;
/*!40000 ALTER TABLE `job_batches` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jobs`
--

DROP TABLE IF EXISTS `jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint unsigned NOT NULL,
  `reserved_at` int unsigned DEFAULT NULL,
  `available_at` int unsigned NOT NULL,
  `created_at` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_index` (`queue`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jobs`
--

LOCK TABLES `jobs` WRITE;
/*!40000 ALTER TABLE `jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'0001_01_01_000000_create_users_table',1),(2,'0001_01_01_000001_create_cache_table',1),(3,'0001_01_01_000002_create_jobs_table',1),(4,'2025_05_27_145325_create_festivals_table',1),(5,'2025_05_27_145399_create_buses_table',1),(6,'2025_05_27_145400_create_routes_table',1),(7,'2025_05_27_145406_create_bookings_table',1),(8,'2025_05_27_145420_create_points_table',1),(9,'2025_05_27_145527_create_payments_table',1);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_reset_tokens`
--

DROP TABLE IF EXISTS `password_reset_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_reset_tokens`
--

LOCK TABLES `password_reset_tokens` WRITE;
/*!40000 ALTER TABLE `password_reset_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_reset_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `payments`
--

DROP TABLE IF EXISTS `payments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `payments` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `booking_id` bigint unsigned NOT NULL,
  `amount` decimal(8,2) NOT NULL,
  `original_amount` decimal(8,2) DEFAULT NULL,
  `discount_amount` decimal(8,2) NOT NULL DEFAULT '0.00',
  `points_redeemed` int NOT NULL DEFAULT '0',
  `payment_method` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('pending','paid','failed','refunded') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `paid_at` timestamp NULL DEFAULT NULL,
  `transaction_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `payments_transaction_id_unique` (`transaction_id`),
  KEY `payments_booking_id_foreign` (`booking_id`),
  CONSTRAINT `payments_booking_id_foreign` FOREIGN KEY (`booking_id`) REFERENCES `bookings` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `payments`
--

LOCK TABLES `payments` WRITE;
/*!40000 ALTER TABLE `payments` DISABLE KEYS */;
INSERT INTO `payments` VALUES (1,1,230.00,230.00,0.00,0,'ideal','pending',NULL,NULL,'2025-06-04 19:11:42','2025-06-04 19:11:42'),(2,2,221.00,310.00,89.00,890,'ideal','pending',NULL,NULL,'2025-06-04 19:13:49','2025-06-04 19:13:49'),(3,3,690.00,690.00,0.00,0,'ideal','pending',NULL,NULL,'2025-06-04 19:19:15','2025-06-04 19:19:15');
/*!40000 ALTER TABLE `payments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `points`
--

DROP TABLE IF EXISTS `points`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `points` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `booking_id` bigint unsigned DEFAULT NULL,
  `amount` int NOT NULL,
  `type` enum('earned','redeemed') COLLATE utf8mb4_unicode_ci NOT NULL,
  `reason` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `points_user_id_foreign` (`user_id`),
  KEY `points_booking_id_foreign` (`booking_id`),
  CONSTRAINT `points_booking_id_foreign` FOREIGN KEY (`booking_id`) REFERENCES `bookings` (`id`) ON DELETE SET NULL,
  CONSTRAINT `points_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `points`
--

LOCK TABLES `points` WRITE;
/*!40000 ALTER TABLE `points` DISABLE KEYS */;
INSERT INTO `points` VALUES (1,1,1,890,'earned','Punten voor boeking: Lowlands','2025-06-04 19:11:42','2025-06-04 19:11:42'),(2,1,2,890,'earned','Punten voor boeking: Tomorrowland','2025-06-04 19:13:49','2025-06-04 19:13:49'),(3,1,2,-890,'redeemed','Punten ingewisseld voor korting op boeking: Tomorrowland','2025-06-04 19:13:49','2025-06-04 19:13:49'),(4,1,3,69,'earned','Punten voor boeking: Lowlands','2025-06-04 19:19:15','2025-06-04 19:19:15');
/*!40000 ALTER TABLE `points` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `routes`
--

DROP TABLE IF EXISTS `routes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `routes` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `festival_id` bigint unsigned NOT NULL,
  `departure_location` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_departure` datetime NOT NULL,
  `date_return` datetime NOT NULL,
  `bus_id` bigint unsigned DEFAULT NULL,
  `available` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `routes_festival_id_foreign` (`festival_id`),
  KEY `routes_bus_id_foreign` (`bus_id`),
  CONSTRAINT `routes_bus_id_foreign` FOREIGN KEY (`bus_id`) REFERENCES `buses` (`id`) ON DELETE SET NULL,
  CONSTRAINT `routes_festival_id_foreign` FOREIGN KEY (`festival_id`) REFERENCES `festivals` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `routes`
--

LOCK TABLES `routes` WRITE;
/*!40000 ALTER TABLE `routes` DISABLE KEYS */;
INSERT INTO `routes` VALUES (1,1,'Amsterdam Centraal','2025-08-15 06:00:00','2025-08-17 12:00:00',NULL,1,'2025-06-04 18:41:53','2025-06-04 18:41:53'),(2,1,'Utrecht Jaarbeurs','2025-08-15 08:00:00','2025-08-17 13:00:00',NULL,1,'2025-06-04 18:41:53','2025-06-04 18:41:53'),(3,2,'Amsterdam Centraal','2025-07-20 06:00:00','2025-07-22 12:00:00',NULL,1,'2025-06-04 18:41:53','2025-06-04 18:41:53'),(4,2,'Utrecht Jaarbeurs','2025-07-20 08:00:00','2025-07-22 13:00:00',NULL,1,'2025-06-04 18:41:53','2025-06-04 18:41:53');
/*!40000 ALTER TABLE `routes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sessions`
--

DROP TABLE IF EXISTS `sessions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint unsigned DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sessions`
--

LOCK TABLES `sessions` WRITE;
/*!40000 ALTER TABLE `sessions` DISABLE KEYS */;
INSERT INTO `sessions` VALUES ('zN8Acu8GqQAM2lsj3LlvsT9mW2xUwLgl67yB3voU',1,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36','YToxMTp7czo2OiJfdG9rZW4iO3M6NDA6IlZqSWJudFVYUHFPNDd5MjZxTjRlOHFBUm5Pdm9nUThFYXhoSGx4V1QiO3M6OToiX3ByZXZpb3VzIjthOjE6e3M6MzoidXJsIjtzOjMxOiJodHRwOi8vMTI3LjAuMC4xOjgwMDAvZmVzdGl2YWxzIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTtzOjE0OiJwYXltZW50X21ldGhvZCI7czo1OiJpZGVhbCI7czoxNjoicG9pbnRzX3RvX3JlZGVlbSI7aTowO3M6MjA6ImRpc2NvdW50X2Zyb21fcG9pbnRzIjtpOjA7czoxNDoib3JpZ2luYWxfcHJpY2UiO2Q6MjMwO3M6MTE6ImZpbmFsX3ByaWNlIjtkOjIzMDtzOjI2OiJwb2ludHNfdG9fZWFybl9mb3JfYm9va2luZyI7aTo4OTA7czo3OiJib29raW5nIjthOjM6e3M6NToic3RlcDEiO2E6ODp7czoxMToiZmVzdGl2YWxfaWQiO2k6MTtzOjg6InJvdXRlX2lkIjtzOjE6IjEiO3M6MTM6InBlcnNvbl9hbW91bnQiO3M6MToiMSI7czoxNDoiZGVwYXJ0dXJlX3RpbWUiO3M6NToiMDY6MDAiO3M6NToicHJpY2UiO3M6NjoiMjMwLjAwIjtzOjY6InBvaW50cyI7ZDoyMztzOjg6InN1YnRvdGFsIjtkOjIzMDtzOjEyOiJ0b3RhbF9wb2ludHMiO2Q6MjM7fXM6NToic3RlcDIiO2E6NDp7czoxMjoicGhvbmVfbnVtYmVyIjtzOjEwOiIwNjEyMDk2NjEzIjtzOjY6ImFkcmVzcyI7czo4OiJTdHJhYXQgMSI7czoxMToicG9zdGFsX2NvZGUiO3M6NzoiMTIzNCBBQiI7czo0OiJjaXR5IjtzOjY6Ilp3b2xsZSI7fXM6NToic3RlcDMiO2E6Njp7czoxNDoicGF5bWVudF9tZXRob2QiO3M6NToiaWRlYWwiO3M6MTY6InBvaW50c190b19yZWRlZW0iO2k6MDtzOjIwOiJkaXNjb3VudF9mcm9tX3BvaW50cyI7aTowO3M6MTQ6Im9yaWdpbmFsX3ByaWNlIjtkOjIzMDtzOjExOiJmaW5hbF9wcmljZSI7ZDoyMzA7czoyNjoicG9pbnRzX3RvX2Vhcm5fZm9yX2Jvb2tpbmciO2Q6MjM7fX19',1749072361);
/*!40000 ALTER TABLE `sessions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `first_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `adress` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `postal_code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `city` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` enum('customer','planner','admin') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'customer',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'Test','Gebruiker','test@example.com',NULL,'$2y$12$xcNMpPSX8uxZhGB.P4T99urT/o/7KQpx5oxZfTT8No/kmgmCKmSjq',NULL,'Straat 1','1234 AB','Zwolle','customer',NULL,'2025-06-04 18:41:53','2025-06-04 18:41:53'),(2,'Petra','Planner','planner@example.com','2025-06-04 18:41:53','$2y$12$7bh7oRTmSHE6okR/d1CJA.MfQNM0ofod9wYSsefaGD2b5Zl21RY4a',NULL,'Planstraat 1','1234 PL','Den Haag','planner',NULL,'2025-06-04 18:41:53','2025-06-04 18:41:53'),(3,'Adam','Admin','admin@example.com','2025-06-04 18:41:53','$2y$12$VWNfSBX6iC3irlu3/IvfPOa5y3OFsTH2PgHc0NJlWOZVS/cm.bmg2',NULL,'Beheerweg 1','1234 AD','Utrecht','admin',NULL,'2025-06-04 18:41:53','2025-06-04 18:41:53');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2025-06-04 23:31:57
