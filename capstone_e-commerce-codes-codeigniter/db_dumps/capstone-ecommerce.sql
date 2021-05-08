-- MySQL dump 10.13  Distrib 8.0.24, for Win64 (x86_64)
--
-- Host: localhost    Database: capstone-ecommerce
-- ------------------------------------------------------
-- Server version	5.7.9-log

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
-- Table structure for table `admins`
--

DROP TABLE IF EXISTS `admins`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `admins` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `admins`
--

LOCK TABLES `admins` WRITE;
/*!40000 ALTER TABLE `admins` DISABLE KEYS */;
INSERT INTO `admins` VALUES (1,'Cesar','Francisco','princexcesar@gmail.com','b28cbdb51d552dc1eda79833b98c8f80',NULL,NULL);
/*!40000 ALTER TABLE `admins` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category_name` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1217 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categories`
--

LOCK TABLES `categories` WRITE;
/*!40000 ALTER TABLE `categories` DISABLE KEYS */;
INSERT INTO `categories` VALUES (1205,'Breakfast','2021-05-06 14:48:29','2021-05-06 14:48:29'),(1206,'Lunch','2021-05-06 14:48:54','2021-05-06 14:48:54'),(1207,'Dinner','2021-05-06 14:51:30','2021-05-06 14:51:30');
/*!40000 ALTER TABLE `categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `customers_billing_address`
--

DROP TABLE IF EXISTS `customers_billing_address`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `customers_billing_address` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `address2` varchar(45) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `state` varchar(255) DEFAULT NULL,
  `zipcode` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=173 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `customers_billing_address`
--

LOCK TABLES `customers_billing_address` WRITE;
/*!40000 ALTER TABLE `customers_billing_address` DISABLE KEYS */;
INSERT INTO `customers_billing_address` VALUES (147,'Emilio','Agbayani','Purok #10, Forestgold, Bakakeng Phase 1','','Baguio City','Benguet',2600,'2021-05-07 15:10:37','2021-05-07 15:10:37'),(148,'Pedro','Penduko','Purok #10, Forestgold, Bakakeng Phase 1','','Baguio City','Benguet',2600,'2021-05-07 15:11:54','2021-05-07 15:11:54'),(149,'Maria','Juana','Purok #10, Forestgold, Bakakeng Phase 1','','Baguio City','Benguet',2600,'2021-05-07 16:51:45','2021-05-07 16:51:45'),(150,'Sheldon','Young','Purok #10, Forestgold, Bakakeng Phase 1, purok 7','','Baguio City','Benguet',2600,'2021-05-07 19:18:23','2021-05-07 19:18:23'),(151,'','','','','','',0,'2021-05-07 19:51:38','2021-05-07 19:51:38'),(152,'Amy','Peryong','Purok #10, Forestgold, Bakakeng Phase 1','','Baguio City','Benguet',2600,'2021-05-07 20:02:15','2021-05-07 20:02:15'),(153,'Cesar','Francisco','Purok #10, Forestgold, Bakakeng Phase 1','','Baguio City','Benguet',2600,'2021-05-07 20:11:33','2021-05-07 20:11:33'),(154,'Cesar','Francisco','Purok #10, Forestgold, Bakakeng Phase 1','','Baguio City','Benguet',2600,'2021-05-07 23:33:13','2021-05-07 23:33:13'),(155,'Yue','Young','Purok #10, Forestgold, Bakakeng Phase 1, purok 7','','Baguio City','Benguet',2600,'2021-05-08 18:32:18','2021-05-08 18:32:18'),(156,'Kathleen','Garcia','Purok #10, Forestgold, Bakakeng Phase 1','','Baguio City','Benguet',2600,'2021-05-08 18:35:17','2021-05-08 18:35:17'),(157,'Maria','Juana','Purok #10, Forestgold, Bakakeng Phase 1','','Baguio City','Benguet',2600,'2021-05-08 18:36:23','2021-05-08 18:36:23'),(158,'Yue','Young','Purok #10, Forestgold, Bakakeng Phase 1, purok 7','','Baguio City','Benguet',2600,'2021-05-08 18:37:39','2021-05-08 18:37:39'),(159,'Sheldon','Young','Purok #10, Forestgold, Bakakeng Phase 1, purok 7','','Baguio City','Benguet',2600,'2021-05-08 18:38:19','2021-05-08 18:38:19'),(160,'Emilio','Agbayani','Purok #10, Forestgold, Bakakeng Phase 1','','Baguio City','Benguet',2600,'2021-05-08 18:39:03','2021-05-08 18:39:03'),(161,'Amy','Peryong','Purok #10, Forestgold, Bakakeng Phase 1','','Baguio City','Benguet',2600,'2021-05-08 18:39:49','2021-05-08 18:39:49'),(162,'Yue','Young','Purok #10, Forestgold, Bakakeng Phase 1, purok 7','','Baguio City','Benguet',2600,'2021-05-08 18:42:20','2021-05-08 18:42:20'),(163,'Pedro','Penduko','Purok #10, Forestgold, Bakakeng Phase 1','','Baguio City','Benguet',2600,'2021-05-08 18:43:01','2021-05-08 18:43:01'),(164,'Maria','Juana','Purok #10, Forestgold, Bakakeng Phase 1','','Baguio City','Benguet',2600,'2021-05-08 18:47:05','2021-05-08 18:47:05'),(165,'Sheldon','Young','Purok #10, Forestgold, Bakakeng Phase 1, purok 7','','Baguio City','Benguet',2600,'2021-05-08 18:50:10','2021-05-08 18:50:10'),(166,'Emilio','Agbayani','Purok #10, Forestgold, Bakakeng Phase 1','','Baguio City','Benguet',2600,'2021-05-08 18:55:59','2021-05-08 18:55:59'),(167,'Amy','Peryong','Purok #10, Forestgold, Bakakeng Phase 1','','Baguio City','Benguet',2600,'2021-05-08 19:04:41','2021-05-08 19:04:41'),(168,'Pedro','Penduko','Purok #10, Forestgold, Bakakeng Phase 1','','Baguio City','Benguet',2600,'2021-05-08 19:06:38','2021-05-08 19:06:38'),(169,'Yue','Young','Purok #10, Forestgold, Bakakeng Phase 1, purok 7','','Baguio City','Benguet',2600,'2021-05-08 19:09:03','2021-05-08 19:09:03'),(170,'Maria','Juana','Purok #10, Forestgold, Bakakeng Phase 1','','Baguio City','Benguet',2600,'2021-05-08 19:12:02','2021-05-08 19:12:02'),(171,'Sheldon','Young','Purok #10, Forestgold, Bakakeng Phase 1, purok 7','','Baguio City','Benguet',2600,'2021-05-08 19:31:15','2021-05-08 19:31:15'),(172,'Cesar','Francisco','Purok #10, Forestgold, Bakakeng Phase 1','','Baguio City','Benguet',2600,'2021-05-08 20:38:57','2021-05-08 20:38:57');
/*!40000 ALTER TABLE `customers_billing_address` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `orders` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `ordered_quantity` int(11) DEFAULT NULL,
  `total_price` float DEFAULT NULL,
  `order_status_id` int(11) NOT NULL,
  `shipping_id` int(11) NOT NULL,
  `stripe_charged_id` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_products_has_customers_customers1_idx` (`customer_id`),
  KEY `fk_products_has_customers_products1_idx` (`product_id`),
  KEY `fk_orders_shipping1_idx` (`shipping_id`),
  KEY `fk_orders_orders_status1_idx` (`order_status_id`),
  CONSTRAINT `fk_orders_orders_status1` FOREIGN KEY (`order_status_id`) REFERENCES `orders_status` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_orders_shipping1` FOREIGN KEY (`shipping_id`) REFERENCES `shippings` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_products_has_customers_customers1` FOREIGN KEY (`customer_id`) REFERENCES `customers_billing_address` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_products_has_customers_products1` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `orders`
--

LOCK TABLES `orders` WRITE;
/*!40000 ALTER TABLE `orders` DISABLE KEYS */;
INSERT INTO `orders` VALUES (1,18,147,1,95.5,3,127,'ch_1IoNpaHY4bgJZaAvYCYLVxLb','2021-05-07 15:10:38','2021-05-07 15:10:38'),(2,17,147,2,399.98,3,127,'ch_1IoNpaHY4bgJZaAvYCYLVxLb','2021-05-07 15:10:38','2021-05-07 15:10:38'),(3,19,148,3,135,1,128,'ch_1IoNqpHY4bgJZaAvpc1uUn4I','2021-05-07 15:11:55','2021-05-07 15:11:55'),(4,17,148,2,399.98,1,128,'ch_1IoNqpHY4bgJZaAvpc1uUn4I','2021-05-07 15:11:55','2021-05-07 15:11:55'),(5,18,148,6,573,1,128,'ch_1IoNqpHY4bgJZaAvpc1uUn4I','2021-05-07 15:11:55','2021-05-07 15:11:55'),(6,24,149,2,579.5,2,129,'ch_1IoPPSHY4bgJZaAvVycVyMr6','2021-05-07 16:51:46','2021-05-07 16:51:46'),(7,23,149,5,876.25,2,129,'ch_1IoPPSHY4bgJZaAvVycVyMr6','2021-05-07 16:51:46','2021-05-07 16:51:46'),(8,17,150,6,1199.94,2,130,'ch_1IoRhMHY4bgJZaAvm7HKP8YC','2021-05-07 19:18:24','2021-05-07 19:18:24'),(10,18,152,10,955,1,132,'ch_1IoSNoHY4bgJZaAvxR4CCmQX','2021-05-07 20:02:16','2021-05-07 20:02:16'),(11,23,153,4,701,1,133,'ch_1IoSWoHY4bgJZaAvu0Cb1axQ','2021-05-07 20:11:34','2021-05-07 20:11:34'),(12,22,153,4,998,1,133,'ch_1IoSWoHY4bgJZaAvu0Cb1axQ','2021-05-07 20:11:34','2021-05-07 20:11:34'),(13,22,154,2,499,3,134,'ch_1IoVfyHY4bgJZaAvKJQDNHmQ','2021-05-07 23:33:14','2021-05-07 23:33:14'),(14,18,154,4,382,3,134,'ch_1IoVfyHY4bgJZaAvKJQDNHmQ','2021-05-07 23:33:14','2021-05-07 23:33:14'),(15,19,155,2,90,1,135,'ch_1IonSJHY4bgJZaAvzzEsw2A5','2021-05-08 18:32:19','2021-05-08 18:32:19'),(16,18,156,2,191,1,136,'ch_1IonVCHY4bgJZaAv2NoZwzLS','2021-05-08 18:35:18','2021-05-08 18:35:18'),(17,18,157,4,382,1,137,'ch_1IonWGHY4bgJZaAvVMqBp06X','2021-05-08 18:36:24','2021-05-08 18:36:24'),(18,18,158,5,477.5,1,138,'ch_1IonXUHY4bgJZaAvmmmnYFsE','2021-05-08 18:37:40','2021-05-08 18:37:40'),(19,17,159,2,399.98,3,139,'ch_1IonY8HY4bgJZaAvUhhjssqF','2021-05-08 18:38:20','2021-05-08 18:38:20'),(20,18,160,3,286.5,1,140,'ch_1IonYqHY4bgJZaAvCKvVm5Nn','2021-05-08 18:39:04','2021-05-08 18:39:04'),(21,18,161,3,286.5,1,141,'ch_1IonZaHY4bgJZaAvdnaSxDUu','2021-05-08 18:39:50','2021-05-08 18:39:50'),(22,18,162,3,286.5,1,142,'ch_1Ionc1HY4bgJZaAvyNWEOMmY','2021-05-08 18:42:21','2021-05-08 18:42:21'),(23,17,163,3,599.97,1,143,'ch_1IoncgHY4bgJZaAvGfimsF1i','2021-05-08 18:43:03','2021-05-08 18:43:03'),(24,17,164,1,199.99,1,144,'ch_1IongcHY4bgJZaAv5AXkZtJt','2021-05-08 18:47:06','2021-05-08 18:47:06'),(25,18,165,1,95.5,1,145,'ch_1IonjbHY4bgJZaAvScFEKEnC','2021-05-08 18:50:11','2021-05-08 18:50:11'),(26,18,166,2,191,1,146,'ch_1IonpEHY4bgJZaAvrR5RiM96','2021-05-08 18:56:00','2021-05-08 18:56:00'),(27,18,167,3,286.5,2,147,'ch_1IonxeHY4bgJZaAvqy7QZPIf','2021-05-08 19:04:42','2021-05-08 19:04:42'),(28,18,168,2,191,3,148,'ch_1IonzXHY4bgJZaAvvcfxE9Ef','2021-05-08 19:06:39','2021-05-08 19:06:39'),(29,18,169,2,191,1,149,'ch_1Ioo1sHY4bgJZaAv1cDI1ruA','2021-05-08 19:09:04','2021-05-08 19:09:04'),(30,17,170,2,399.98,1,150,'ch_1Ioo4lHY4bgJZaAv6lK4wDIX','2021-05-08 19:12:03','2021-05-08 19:12:03'),(31,22,170,2,499,1,150,'ch_1Ioo4lHY4bgJZaAv6lK4wDIX','2021-05-08 19:12:03','2021-05-08 19:12:03'),(32,18,171,1,95.5,2,151,'ch_1IooNMHY4bgJZaAv5zfkAahc','2021-05-08 19:31:16','2021-05-08 19:31:16'),(33,17,172,6,1199.94,2,152,'ch_1IopQsHY4bgJZaAvNTN2FGJ6','2021-05-08 20:38:58','2021-05-08 20:38:58'),(34,18,172,2,191,2,152,'ch_1IopQsHY4bgJZaAvNTN2FGJ6','2021-05-08 20:38:58','2021-05-08 20:38:58');
/*!40000 ALTER TABLE `orders` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `orders_status`
--

DROP TABLE IF EXISTS `orders_status`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `orders_status` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `status_name` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `orders_status`
--

LOCK TABLES `orders_status` WRITE;
/*!40000 ALTER TABLE `orders_status` DISABLE KEYS */;
INSERT INTO `orders_status` VALUES (1,'Order in process',NULL,NULL),(2,'Delivered',NULL,NULL),(3,'Cancelled',NULL,NULL);
/*!40000 ALTER TABLE `orders_status` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `products` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_name` varchar(255) DEFAULT NULL,
  `description` text,
  `price` float DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `images` text,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `admin_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_products_users1_idx` (`admin_id`),
  KEY `fk_products_categories1_idx` (`category_id`),
  CONSTRAINT `fk_products_categories1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_products_users1` FOREIGN KEY (`admin_id`) REFERENCES `admins` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `products`
--

LOCK TABLES `products` WRITE;
/*!40000 ALTER TABLE `products` DISABLE KEYS */;
INSERT INTO `products` VALUES (17,'Fresh Chicken Salad','This family favorite chicken salad is made with celery, bell pepper, green olives, apple, lettuce, and mayo—plus a secret ingredient that makes all the difference!',199.99,50,'[\"chicken-salad-img1.jpg\",\"chicken-salad-img3.png\"]','2021-05-06 14:57:38','2021-05-06 14:57:38',1,1205),(18,'Fruit Salad','Fruit salad is a dish consisting of various kinds of fruit, sometimes served in a liquid, either their own juices or syrup. In different forms, fruit salad can be served as an appetizer, a side salad, or a dessert.',95.5,35,'[\"fruit-salad-img1.jpg\",\"fruit-salad-img2.jpg\",\"fruit-salad-img3.jpg\",\"fruit-salad-img4.png\"]','2021-05-06 15:01:48','2021-05-06 15:01:48',1,1205),(19,'Eggs Omelette','In cuisine, an omelette or omelet is a dish made from beaten eggs, fried with butter or oil in a frying pan. It is quite common for the omelette to be folded around fillings such as cheese, chives, vegetables, mushrooms, meat, or some combination of the above.',45,15,'[\"egg-omelette-img1.jpg\",\"egg-omelette-img2.jpg\",\"egg-omelette-img3.jpg\",\"egg-omelette-img4.png\"]','2021-05-06 15:06:44','2021-05-06 15:06:44',1,1205),(20,'Smoked Salmon Sandwich','The sandwich itself is pretty simple, featuring ingredients such as cream cheese, smoked salmon, avocados (because they’re the best in sandwiches), tomatoes, radishes and alfalfa sprouts in between 2 slices of delicious whole wheat grain bread, but simple doesn’t make it boring! This sandwich is full of fresh flavor and is sure to satisfy.',55,12,'[\"smoked-salmon-sandwich-img1.jpg\",\"smoked-salmon-sandwich-img2.jpg\",\"smoked-salmon-sandwich-img3.jpg\"]','2021-05-06 15:13:14','2021-05-06 15:13:14',1,1205),(21,'Spaghetti Carbonara','Carbonara is an Italian pasta dish from Rome made with egg, hard cheese, cured pork, and black pepper. The dish arrived at its modern form, with its current name, in the middle of the 20th century. The cheese is usually Pecorino Romano, Parmigiano-Reggiano, or a combination of the two.',124.99,25,'[\"spaghetti-carbonara-img1.jpg\",\"spaghetti-carbonara-img2.jpg\",\"spaghetti-carbonara-img3.jpg\"]','2021-05-06 15:17:00','2021-05-06 15:17:00',1,1206),(22,'Beef Steak','A beefsteak, often called just steak, is a flat cut of beef with parallel faces, usually cut perpendicular to the muscle fibers. In common restaurant service a single serving will have a raw mass ranging from 120 to 600 grams. Beef steaks are usually grilled, pan fried, or broiled.',249.5,27,'[\"beef-steak-img1.jpg\",\"beef-steak-img2.jpg\",\"beef-steak-img3.jpg\"]','2021-05-06 15:21:48','2021-05-06 15:21:48',1,1206),(23,'Shrimp Tempura','Shrimp Tempura is a Japanese dish made with fresh shrimp dipped in tempura batter and deep-fried until perfectly crispy. Serve it with soy sauce or tempura dipping sauce.',175.25,16,'[\"shrimp-tempura-img1.jpg\",\"shrimp-tempura-img2.jpg\",\"shrimp-tempura-img3.jpg\",\"shrimp-tempura-img4.jpg\"]','2021-05-06 15:26:28','2021-05-06 15:26:28',1,1207),(24,'Pork Belly Salad','Crispy pork belly on a salad with a Chili Ginger Caramel Sauce!',289.75,19,'[\"pork-belly-salad-img1.jpg\",\"pork-belly-salad-img2.jpg\",\"pork-belly-salad-img3.png\",\"pork-belly-salad-img4.jpg\"]','2021-05-06 15:31:21','2021-05-06 15:31:21',1,1207),(28,'Pork Adobo','Pork Adobo made with succulent pork belly braised in vinegar, soy sauce, garlic, and onions.  A delicious balance of salty and savory, this hearty stew is Philippine’s national dish for a good reason!',149.78,25,'[\"pork-adobo-img1.jpg\",\"pork-adobo-img2.jpg\",\"pork-adobo-img3.jpg\",\"pork-adobo-img4.jpg\"]','2021-05-08 20:26:09','2021-05-08 20:26:09',1,1207);
/*!40000 ALTER TABLE `products` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `shippings`
--

DROP TABLE IF EXISTS `shippings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `shippings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `shipping_first_name` varchar(255) DEFAULT NULL,
  `shipping_last_name` varchar(255) DEFAULT NULL,
  `shipping_address` varchar(255) DEFAULT NULL,
  `shipping_address2` varchar(255) DEFAULT NULL,
  `shipping_city` varchar(255) DEFAULT NULL,
  `shipping_state` varchar(255) DEFAULT NULL,
  `shipping_zipcode` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=153 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `shippings`
--

LOCK TABLES `shippings` WRITE;
/*!40000 ALTER TABLE `shippings` DISABLE KEYS */;
INSERT INTO `shippings` VALUES (127,'Emilio','Agbayani','Purok #10, Forestgold, Bakakeng Phase 1','','Baguio City','Benguet',2600,'2021-05-07 15:10:37','2021-05-07 15:10:37'),(128,'Pedro','Penduko','Purok #10, Forestgold, Bakakeng Phase 1','','Baguio City','Benguet',2600,'2021-05-07 15:11:54','2021-05-07 15:11:54'),(129,'Maria','Juana','Purok #10, Forestgold, Bakakeng Phase 1','','Baguio City','Benguet',2600,'2021-05-07 16:51:45','2021-05-07 16:51:45'),(130,'Sheldon','Young','Purok #10, Forestgold, Bakakeng Phase 1, purok 7','','Baguio City','Benguet',2600,'2021-05-07 19:18:23','2021-05-07 19:18:23'),(132,'Amy','Peryong','Purok #10, Forestgold, Bakakeng Phase 1','','Baguio City','Benguet',2600,'2021-05-07 20:02:15','2021-05-07 20:02:15'),(133,'Cesar','Francisco','Purok #10, Forestgold, Bakakeng Phase 1','','Baguio City','Benguet',2600,'2021-05-07 20:11:33','2021-05-07 20:11:33'),(134,'Cesar','Francisco','Purok #10, Forestgold, Bakakeng Phase 1','','Baguio City','Benguet',2600,'2021-05-07 23:33:13','2021-05-07 23:33:13'),(135,'Yue','Young','Purok #10, Forestgold, Bakakeng Phase 1, purok 7','','Baguio City','Benguet',2600,'2021-05-08 18:32:18','2021-05-08 18:32:18'),(136,'Kathleen','Garcia','Purok #10, Forestgold, Bakakeng Phase 1','','Baguio City','Benguet',2600,'2021-05-08 18:35:17','2021-05-08 18:35:17'),(137,'Maria','Juana','Purok #10, Forestgold, Bakakeng Phase 1','','Baguio City','Benguet',2600,'2021-05-08 18:36:23','2021-05-08 18:36:23'),(138,'Yue','Young','Purok #10, Forestgold, Bakakeng Phase 1, purok 7','','Baguio City','Benguet',2600,'2021-05-08 18:37:39','2021-05-08 18:37:39'),(139,'Sheldon','Young','Purok #10, Forestgold, Bakakeng Phase 1, purok 7','','Baguio City','Benguet',2600,'2021-05-08 18:38:19','2021-05-08 18:38:19'),(140,'Emilio','Agbayani','Purok #10, Forestgold, Bakakeng Phase 1','','Baguio City','Benguet',2600,'2021-05-08 18:39:03','2021-05-08 18:39:03'),(141,'Amy','Peryong','Purok #10, Forestgold, Bakakeng Phase 1','','Baguio City','Benguet',2600,'2021-05-08 18:39:49','2021-05-08 18:39:49'),(142,'Yue','Young','Purok #10, Forestgold, Bakakeng Phase 1, purok 7','','Baguio City','Benguet',2600,'2021-05-08 18:42:20','2021-05-08 18:42:20'),(143,'Pedro','Penduko','Purok #10, Forestgold, Bakakeng Phase 1','','Baguio City','Benguet',2600,'2021-05-08 18:43:01','2021-05-08 18:43:01'),(144,'Maria','Juana','Purok #10, Forestgold, Bakakeng Phase 1','','Baguio City','Benguet',2600,'2021-05-08 18:47:05','2021-05-08 18:47:05'),(145,'Sheldon','Young','Purok #10, Forestgold, Bakakeng Phase 1, purok 7','','Baguio City','Benguet',2600,'2021-05-08 18:50:10','2021-05-08 18:50:10'),(146,'Emilio','Agbayani','Purok #10, Forestgold, Bakakeng Phase 1','','Baguio City','Benguet',2600,'2021-05-08 18:55:59','2021-05-08 18:55:59'),(147,'Amy','Peryong','Purok #10, Forestgold, Bakakeng Phase 1','','Baguio City','Benguet',2600,'2021-05-08 19:04:41','2021-05-08 19:04:41'),(148,'Pedro','Penduko','Purok #10, Forestgold, Bakakeng Phase 1','','Baguio City','Benguet',2600,'2021-05-08 19:06:38','2021-05-08 19:06:38'),(149,'Yue','Young','Purok #10, Forestgold, Bakakeng Phase 1, purok 7','','Baguio City','Benguet',2600,'2021-05-08 19:09:03','2021-05-08 19:09:03'),(150,'Maria','Juana','Purok #10, Forestgold, Bakakeng Phase 1','','Baguio City','Benguet',2600,'2021-05-08 19:12:02','2021-05-08 19:12:02'),(151,'Sheldon','Young','Purok #10, Forestgold, Bakakeng Phase 1, purok 7','','Baguio City','Benguet',2600,'2021-05-08 19:31:15','2021-05-08 19:31:15'),(152,'Cesar','Francisco','Purok #10, Forestgold, Bakakeng Phase 1','','Baguio City','Benguet',2600,'2021-05-08 20:38:57','2021-05-08 20:38:57');
/*!40000 ALTER TABLE `shippings` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2021-05-08 23:37:44
