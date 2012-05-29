-- MySQL dump 10.13  Distrib 5.1.58, for debian-linux-gnu (i686)
--
-- Host: 127.0.0.1    Database: bloomweb_clickneat
-- ------------------------------------------------------
-- Server version	5.1.53-log

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
-- Table structure for table `acos`
--

DROP TABLE IF EXISTS `acos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `acos` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `parent_id` int(10) DEFAULT NULL,
  `model` varchar(255) DEFAULT NULL,
  `foreign_key` int(10) DEFAULT NULL,
  `alias` varchar(255) DEFAULT NULL,
  `lft` int(10) DEFAULT NULL,
  `rght` int(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `acos`
--

LOCK TABLES `acos` WRITE;
/*!40000 ALTER TABLE `acos` DISABLE KEYS */;
/*!40000 ALTER TABLE `acos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `addresses`
--

DROP TABLE IF EXISTS `addresses`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `addresses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) DEFAULT 'defoult',
  `user_id` int(11) NOT NULL,
  `address` varchar(45) NOT NULL,
  `zip` varchar(45) DEFAULT NULL,
  `country_id` int(11) NOT NULL,
  `city_id` int(11) NOT NULL,
  `created` datetime DEFAULT NULL,
  `updated` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_addresses_countries_INDEX` (`country_id`),
  KEY `fk_addresses_cities_INDEX` (`city_id`),
  KEY `fk_addresses_users_INDEX` (`user_id`),
  CONSTRAINT `fk_addresses_countries` FOREIGN KEY (`country_id`) REFERENCES `countries` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_addresses_cities` FOREIGN KEY (`city_id`) REFERENCES `cities` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_addresses_users` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `addresses`
--

LOCK TABLES `addresses` WRITE;
/*!40000 ALTER TABLE `addresses` DISABLE KEYS */;
/*!40000 ALTER TABLE `addresses` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `aros`
--

DROP TABLE IF EXISTS `aros`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `aros` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `parent_id` int(10) DEFAULT NULL,
  `model` varchar(255) DEFAULT NULL,
  `foreign_key` int(10) DEFAULT NULL,
  `alias` varchar(255) DEFAULT NULL,
  `lft` int(10) DEFAULT NULL,
  `rght` int(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `aros`
--

LOCK TABLES `aros` WRITE;
/*!40000 ALTER TABLE `aros` DISABLE KEYS */;
/*!40000 ALTER TABLE `aros` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `aros_acos`
--

DROP TABLE IF EXISTS `aros_acos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `aros_acos` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `aro_id` int(10) NOT NULL,
  `aco_id` int(10) NOT NULL,
  `_create` varchar(2) NOT NULL DEFAULT '0',
  `_read` varchar(2) NOT NULL DEFAULT '0',
  `_update` varchar(2) NOT NULL DEFAULT '0',
  `_delete` varchar(2) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `ARO_ACO_KEY_UNIQUE` (`aro_id`,`aco_id`),
  KEY `fk_aros_acos_acos_INDEX` (`aco_id`),
  KEY `fk_aros_acos_aros_INDEX` (`aro_id`),
  CONSTRAINT `fk_aros_acos_acos` FOREIGN KEY (`aco_id`) REFERENCES `acos` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_aros_acos_aros` FOREIGN KEY (`aro_id`) REFERENCES `aros` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `aros_acos`
--

LOCK TABLES `aros_acos` WRITE;
/*!40000 ALTER TABLE `aros_acos` DISABLE KEYS */;
/*!40000 ALTER TABLE `aros_acos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cities`
--

DROP TABLE IF EXISTS `cities`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cities` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `country_id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `description` text,
  `image` varchar(255) DEFAULT NULL,
  `is_present` tinyint(1) DEFAULT NULL,
  `code` varchar(45) DEFAULT NULL,
  `lat` varchar(45) DEFAULT NULL,
  `long` varchar(45) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `updated` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_cities_countries_INDEX` (`country_id`),
  CONSTRAINT `fk_cities_countries` FOREIGN KEY (`country_id`) REFERENCES `countries` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cities`
--

LOCK TABLES `cities` WRITE;
/*!40000 ALTER TABLE `cities` DISABLE KEYS */;
INSERT INTO `cities` VALUES (1,2,'Bogota','','',1,'','','','2011-11-23 15:17:39','2011-11-23 15:17:52'),(2,2,'Cali','','',1,'','','','2011-11-23 15:18:12','2011-11-23 15:18:12');
/*!40000 ALTER TABLE `cities` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `comments`
--

DROP TABLE IF EXISTS `comments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `comments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `users_id` int(11) DEFAULT NULL,
  `comment` text,
  `model` varchar(45) DEFAULT NULL,
  `foreign_key` varchar(45) DEFAULT NULL,
  `active` tinyint(1) DEFAULT NULL,
  `alias` varchar(45) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `updated` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_comments_users_INDEX` (`users_id`),
  CONSTRAINT `fk_comments_users` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `comments`
--

LOCK TABLES `comments` WRITE;
/*!40000 ALTER TABLE `comments` DISABLE KEYS */;
/*!40000 ALTER TABLE `comments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `countries`
--

DROP TABLE IF EXISTS `countries`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `countries` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `description` text,
  `image` varchar(255) DEFAULT NULL,
  `language` varchar(45) DEFAULT NULL,
  `is_present` tinyint(1) DEFAULT NULL,
  `code` varchar(45) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `updated` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `countries`
--

LOCK TABLES `countries` WRITE;
/*!40000 ALTER TABLE `countries` DISABLE KEYS */;
INSERT INTO `countries` VALUES (1,'USA','','','eng',1,'','2011-11-23 15:04:24','2011-11-23 15:04:24'),(2,'Colombia','','','spa',1,'','2011-11-23 15:09:59','2011-11-23 15:10:24');
/*!40000 ALTER TABLE `countries` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cuisines`
--

DROP TABLE IF EXISTS `cuisines`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cuisines` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `description` text,
  `image` varchar(255) DEFAULT NULL,
  `slug` varchar(50) NOT NULL,
  `created` datetime DEFAULT NULL,
  `updated` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cuisines`
--

LOCK TABLES `cuisines` WRITE;
/*!40000 ALTER TABLE `cuisines` DISABLE KEYS */;
INSERT INTO `cuisines` VALUES (1,'Mexicana','','','mexicana','2011-11-23 15:14:41','2011-11-23 15:14:41'),(2,'Colombiana','','','colombiana','2011-11-23 15:14:57','2011-11-23 15:14:57'),(3,'Italiana','','','italiana','2011-11-23 15:15:13','2011-11-23 15:15:13'),(4,'Comida Rapida','','','comida-rapida','2011-11-23 15:15:34','2011-11-23 15:15:34'),(5,'Argentina','','','argentina','2011-11-23 15:15:47','2011-11-23 15:15:47'),(6,'China','','','china','2011-11-23 15:16:03','2011-11-23 15:16:03'),(7,'Francesa','','','francesa','2011-11-23 15:16:16','2011-11-23 15:16:37'),(8,'Fusion','','','fusion','2011-11-23 15:16:51','2011-11-23 15:16:51'),(9,'Asiatica','','','asiatica','2011-11-23 15:17:05','2011-11-23 15:17:05');
/*!40000 ALTER TABLE `cuisines` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cuisines_deals`
--

DROP TABLE IF EXISTS `cuisines_deals`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cuisines_deals` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cuisine_id` int(11) NOT NULL,
  `deal_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_cuisines_deals_cuisines_INDEX` (`cuisine_id`),
  KEY `fk_cuisines_deals_deals_INDEX` (`deal_id`),
  CONSTRAINT `fk_cuisines_deals_cuisines` FOREIGN KEY (`cuisine_id`) REFERENCES `cuisines` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_cuisines_deals_deals` FOREIGN KEY (`deal_id`) REFERENCES `deals` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cuisines_deals`
--

LOCK TABLES `cuisines_deals` WRITE;
/*!40000 ALTER TABLE `cuisines_deals` DISABLE KEYS */;
INSERT INTO `cuisines_deals` VALUES (4,5,2),(10,9,1),(13,9,3),(16,1,4),(17,4,4),(20,1,5),(21,4,5);
/*!40000 ALTER TABLE `cuisines_deals` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `deals`
--

DROP TABLE IF EXISTS `deals`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `deals` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `restaurant_id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `description` text,
  `conditions` text,
  `image` varchar(255) DEFAULT NULL,
  `image_large` varchar(255) DEFAULT NULL,
  `amount` int(11) NOT NULL DEFAULT '0',
  `price` double NOT NULL DEFAULT '0',
  `normal_price` double NOT NULL DEFAULT '0',
  `max_buys` int(11) NOT NULL DEFAULT '0',
  `expires` datetime DEFAULT NULL,
  `is_promoted` tinyint(1) NOT NULL DEFAULT '0',
  `visits` int(11) NOT NULL DEFAULT '0',
  `slug` varchar(50) NOT NULL,
  `created` datetime DEFAULT NULL,
  `updated` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_deals_restaurants_INDEX` (`restaurant_id`),
  CONSTRAINT `fk_deals_restaurants` FOREIGN KEY (`restaurant_id`) REFERENCES `restaurants` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `deals`
--

LOCK TABLES `deals` WRITE;
/*!40000 ALTER TABLE `deals` DISABLE KEYS */;
INSERT INTO `deals` VALUES (1,4,'Black Friday','Parrillada Mixta (250gr carne de Pollo, 250gr carde de res, papa criolla, chorizo, papas a la fransesa, jugo natural y postre)','de lunes a viernes de 3:00pm a 9:00pm','parrilladamixta.jpg',NULL,20,30000,50000,3,'2011-11-20 17:45:00',0,0,'black-friday','2011-11-23 15:49:47','2011-11-23 16:05:29'),(2,2,'Parrillada Argentina','Parrillada Argentina (4 personas) + Vino de la casa','de lunes a viernes de 3:00pm a 9:00pm','parrillada.jpg',NULL,100,100000,50000,3,'2011-11-23 18:45:00',0,0,'parrillada-argentina','2011-11-23 15:53:42','2011-11-23 15:53:42'),(3,1,'Combo','Pollo baÃ±ado en salsa wok + gaseosa personal','de lunes a viernes de 3:00pm a 9:00pm','pollo-al-wok (1).jpg',NULL,100,30000,10000,3,'2011-11-23 18:45:00',0,0,'combo','2011-11-23 16:06:51','2011-11-23 16:08:00'),(4,3,'CMBO PARA UNO','TACO Chilly hot + Gaseosa personal + postre','jueves y viernes de 7:00pm a 11:00pm','receta-de-tacos-de-pollo.jpg',NULL,0,8000,15000,2,'2011-11-23 16:10:00',0,0,'cmbo-para-uno','2011-11-23 16:12:19','2011-11-23 16:12:19'),(5,3,'CMBO PARA DOS','2 TACO Chilly hot + Gaseosa 1.5 lts + epostre','jueves y viernes de 7:00pm a 11:00pm','receta-de-tacos-de-pollo.jpg',NULL,0,15000,30000,2,'2011-11-23 16:10:00',0,0,'cmbo-para-dos','2011-11-23 16:13:10','2011-11-23 16:13:10');
/*!40000 ALTER TABLE `deals` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `i18n`
--

DROP TABLE IF EXISTS `i18n`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `i18n` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `locale` varchar(6) NOT NULL,
  `model` varchar(255) NOT NULL,
  `foreign_key` int(10) NOT NULL,
  `field` varchar(255) NOT NULL,
  `content` text,
  PRIMARY KEY (`id`),
  KEY `locale` (`locale`),
  KEY `model` (`model`),
  KEY `row_id` (`foreign_key`),
  KEY `field` (`field`)
) ENGINE=InnoDB AUTO_INCREMENT=159 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `i18n`
--

LOCK TABLES `i18n` WRITE;
/*!40000 ALTER TABLE `i18n` DISABLE KEYS */;
INSERT INTO `i18n` VALUES (5,'eng','Country',2,'name','Colombi'),(6,'eng','Country',2,'description',''),(7,'spa','Country',2,'name','Colombia'),(8,'spa','Country',2,'description',''),(9,'eng','Country',3,'name','asdfa'),(10,'eng','Country',3,'description',''),(11,'spa','Country',3,'name','asdfa'),(12,'spa','Country',3,'description',''),(13,'eng','Country',1,'name','USA'),(14,'eng','Country',1,'description',''),(15,'spa','Country',1,'name','USA'),(16,'spa','Country',1,'description',''),(17,'spa','Cuisine',1,'name','Mexicana'),(18,'spa','Cuisine',1,'description',''),(19,'eng','Cuisine',1,'name','Mexicana'),(20,'eng','Cuisine',1,'description',''),(21,'spa','Cuisine',2,'name','Colombiana'),(22,'spa','Cuisine',2,'description',''),(23,'eng','Cuisine',2,'name','Colombiana'),(24,'eng','Cuisine',2,'description',''),(25,'spa','Cuisine',3,'name','Italiana'),(26,'spa','Cuisine',3,'description',''),(27,'eng','Cuisine',3,'name','Italiana'),(28,'eng','Cuisine',3,'description',''),(29,'spa','Cuisine',4,'name','Comida Rapida'),(30,'spa','Cuisine',4,'description',''),(31,'eng','Cuisine',4,'name','Comida Rapida'),(32,'eng','Cuisine',4,'description',''),(33,'spa','Cuisine',5,'name','Argentina'),(34,'spa','Cuisine',5,'description',''),(35,'eng','Cuisine',5,'name','Argentina'),(36,'eng','Cuisine',5,'description',''),(37,'spa','Cuisine',6,'name','China'),(38,'spa','Cuisine',6,'description',''),(39,'eng','Cuisine',6,'name','China'),(40,'eng','Cuisine',6,'description',''),(41,'spa','Cuisine',7,'name','Francesa'),(42,'spa','Cuisine',7,'description',''),(43,'eng','Cuisine',7,'name','China'),(44,'eng','Cuisine',7,'description','Asiatica'),(45,'spa','Cuisine',8,'name','Fusion'),(46,'spa','Cuisine',8,'description',''),(47,'eng','Cuisine',8,'name','Fusion'),(48,'eng','Cuisine',8,'description',''),(49,'spa','Cuisine',9,'name','Asiatica'),(50,'spa','Cuisine',9,'description',''),(51,'eng','Cuisine',9,'name','Asiatica'),(52,'eng','Cuisine',9,'description',''),(53,'spa','City',1,'name','Bogota'),(54,'spa','City',1,'description',''),(55,'eng','City',1,'name','Bogota'),(56,'eng','City',1,'description',''),(57,'spa','City',2,'name','Cali'),(58,'spa','City',2,'description',''),(59,'eng','City',2,'name','Cali'),(60,'eng','City',2,'description',''),(61,'spa','Zone',1,'name','NORTE'),(62,'spa','Zone',1,'description',''),(63,'eng','Zone',1,'name','NORTE'),(64,'eng','Zone',1,'description',''),(65,'spa','Zone',2,'name','SUR'),(66,'spa','Zone',2,'description',''),(67,'eng','Zone',2,'name','SUR'),(68,'eng','Zone',2,'description',''),(69,'spa','Zone',3,'name','OESTE'),(70,'spa','Zone',3,'description',''),(71,'eng','Zone',3,'name','OESTE'),(72,'eng','Zone',3,'description',''),(73,'spa','Zone',4,'name','Parque del perro'),(74,'spa','Zone',4,'description',''),(75,'eng','Zone',4,'name','Parque del perro'),(76,'eng','Zone',4,'description',''),(77,'spa','Zone',5,'name','Granada'),(78,'spa','Zone',5,'description',''),(79,'eng','Zone',5,'name','Granada'),(80,'eng','Zone',5,'description',''),(81,'spa','Zone',6,'name','NORTE'),(82,'spa','Zone',6,'description',''),(83,'eng','Zone',6,'name','NORTE'),(84,'eng','Zone',6,'description',''),(85,'spa','Zone',7,'name','Parque de la 93'),(86,'spa','Zone',7,'description',''),(87,'eng','Zone',7,'name','Parque de la 93'),(88,'eng','Zone',7,'description',''),(89,'spa','Restaurant',1,'name','Panda Wok'),(90,'spa','Restaurant',1,'description',''),(91,'spa','Restaurant',1,'address',''),(92,'spa','Restaurant',1,'schedule',''),(93,'eng','Restaurant',1,'name','Panda Wok'),(94,'eng','Restaurant',1,'description',''),(95,'eng','Restaurant',1,'address',''),(96,'eng','Restaurant',1,'schedule',''),(97,'spa','Restaurant',2,'name','PAMPERO'),(98,'spa','Restaurant',2,'description',''),(99,'spa','Restaurant',2,'address',''),(100,'spa','Restaurant',2,'schedule',''),(101,'eng','Restaurant',2,'name','PAMPERO'),(102,'eng','Restaurant',2,'description',''),(103,'eng','Restaurant',2,'address',''),(104,'eng','Restaurant',2,'schedule',''),(105,'spa','Restaurant',3,'name','El gran taco'),(106,'spa','Restaurant',3,'description',''),(107,'spa','Restaurant',3,'address',''),(108,'spa','Restaurant',3,'schedule',''),(109,'eng','Restaurant',3,'name','El gran taco'),(110,'eng','Restaurant',3,'description',''),(111,'eng','Restaurant',3,'address',''),(112,'eng','Restaurant',3,'schedule',''),(113,'spa','Restaurant',4,'name','AndrÃ©s carne de res'),(114,'spa','Restaurant',4,'description',''),(115,'spa','Restaurant',4,'address',''),(116,'spa','Restaurant',4,'schedule',''),(117,'eng','Restaurant',4,'name','AndrÃ©s carne de res'),(118,'eng','Restaurant',4,'description',''),(119,'eng','Restaurant',4,'address',''),(120,'eng','Restaurant',4,'schedule',''),(121,'spa','Restaurant',5,'name','Fridays'),(122,'spa','Restaurant',5,'description',''),(123,'spa','Restaurant',5,'address',''),(124,'spa','Restaurant',5,'schedule',''),(125,'eng','Restaurant',5,'name','Fridays'),(126,'eng','Restaurant',5,'description',''),(127,'eng','Restaurant',5,'address',''),(128,'eng','Restaurant',5,'schedule',''),(129,'spa','Deal',1,'name','Black Friday'),(130,'spa','Deal',1,'description','Parrillada Mixta (250gr carne de Pollo, 250gr carde de res, papa criolla, chorizo, papas a la fransesa, jugo natural y postre)'),(131,'spa','Deal',1,'conditions','de lunes a viernes de 3:00pm a 9:00pm'),(132,'eng','Deal',1,'name','COMBO PANDA WOK'),(133,'eng','Deal',1,'description','Incluye un plato de pollo al wok, Gaseosa personal'),(134,'eng','Deal',1,'conditions','de lunes a viernes de 3:00pm a 9:00pm'),(135,'spa','Deal',2,'name','Parrillada Argentina'),(136,'spa','Deal',2,'description','Parrillada Argentina (4 personas) + Vino de la casa'),(137,'spa','Deal',2,'conditions','de lunes a viernes de 3:00pm a 9:00pm'),(138,'eng','Deal',2,'name','Parrillada Argentina'),(139,'eng','Deal',2,'description','Parrillada Argentina (4 personas) + Vino de la casa'),(140,'eng','Deal',2,'conditions','de lunes a viernes de 3:00pm a 9:00pm'),(141,'spa','Deal',3,'name','Combo'),(142,'spa','Deal',3,'description','Pollo baÃ±ado en salsa wok + gaseosa personal'),(143,'spa','Deal',3,'conditions','de lunes a viernes de 3:00pm a 9:00pm'),(144,'eng','Deal',3,'name','Combo'),(145,'eng','Deal',3,'description','Parrillada Argentina (4 personas) + Vino de la casa'),(146,'eng','Deal',3,'conditions','de lunes a viernes de 3:00pm a 9:00pm'),(147,'spa','Deal',4,'name','CMBO PARA UNO'),(148,'spa','Deal',4,'description','TACO Chilly hot + Gaseosa personal + postre'),(149,'spa','Deal',4,'conditions','jueves y viernes de 7:00pm a 11:00pm'),(150,'eng','Deal',4,'name','CMBO PARA UNO'),(151,'eng','Deal',4,'description','TACO Chilly hot + Gaseosa personal + postre'),(152,'eng','Deal',4,'conditions','jueves y viernes de 7:00pm a 11:00pm'),(153,'spa','Deal',5,'name','CMBO PARA DOS'),(154,'spa','Deal',5,'description','2 TACO Chilly hot + Gaseosa 1.5 lts + epostre'),(155,'spa','Deal',5,'conditions','jueves y viernes de 7:00pm a 11:00pm'),(156,'eng','Deal',5,'name','CMBO PARA DOS'),(157,'eng','Deal',5,'description','2 TACO Chilly hot + Gaseosa 1.5 lts + epostre'),(158,'eng','Deal',5,'conditions','jueves y viernes de 7:00pm a 11:00pm');
/*!40000 ALTER TABLE `i18n` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `menu_items`
--

DROP TABLE IF EXISTS `menu_items`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `menu_items` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `menu_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `link` varchar(255) NOT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `lft` int(11) DEFAULT NULL,
  `rght` int(11) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `updated` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name_UNIQUE` (`name`),
  UNIQUE KEY `link_UNIQUE` (`link`),
  KEY `fk_menu_items_menus_INDEX` (`menu_id`),
  CONSTRAINT `fk_menu_items_menus` FOREIGN KEY (`menu_id`) REFERENCES `menus` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `menu_items`
--

LOCK TABLES `menu_items` WRITE;
/*!40000 ALTER TABLE `menu_items` DISABLE KEYS */;
/*!40000 ALTER TABLE `menu_items` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `menus`
--

DROP TABLE IF EXISTS `menus`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `menus` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `created` datetime DEFAULT NULL,
  `updated` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name_UNIQUE` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `menus`
--

LOCK TABLES `menus` WRITE;
/*!40000 ALTER TABLE `menus` DISABLE KEYS */;
/*!40000 ALTER TABLE `menus` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `order_states`
--

DROP TABLE IF EXISTS `order_states`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `order_states` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `order_states`
--

LOCK TABLES `order_states` WRITE;
/*!40000 ALTER TABLE `order_states` DISABLE KEYS */;
INSERT INTO `order_states` VALUES (1,'En Espera De Pago'),(2,'Pagada');
/*!40000 ALTER TABLE `order_states` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `orders` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(45) NOT NULL,
  `user_id` int(11) NOT NULL,
  `address_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL DEFAULT '1',
  `deal_id` int(11) NOT NULL,
  `order_state_id` int(11) NOT NULL,
  `created` datetime DEFAULT NULL,
  `updated` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_orders_users_INDEX` (`user_id`),
  KEY `fk_orders_deals_INDEX` (`deal_id`),
  KEY `fk_orders_address_INDEX` (`address_id`),
  KEY `fk_orders_order_states_INDEX` (`order_state_id`),
  CONSTRAINT `fk_orders_users` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_orders_deals` FOREIGN KEY (`deal_id`) REFERENCES `deals` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_orders_address` FOREIGN KEY (`address_id`) REFERENCES `addresses` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_orders_order_states` FOREIGN KEY (`order_state_id`) REFERENCES `order_states` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `orders`
--

LOCK TABLES `orders` WRITE;
/*!40000 ALTER TABLE `orders` DISABLE KEYS */;
/*!40000 ALTER TABLE `orders` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pages`
--

DROP TABLE IF EXISTS `pages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `description` text,
  `keywords` text,
  `active` tinyint(1) DEFAULT NULL,
  `wysiwyg_content` longtext,
  `slug` varchar(100) NOT NULL,
  `created` datetime DEFAULT NULL,
  `updated` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `title_UNIQUE` (`name`),
  UNIQUE KEY `slug_UNIQUE` (`slug`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pages`
--

LOCK TABLES `pages` WRITE;
/*!40000 ALTER TABLE `pages` DISABLE KEYS */;
/*!40000 ALTER TABLE `pages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `restaurants`
--

DROP TABLE IF EXISTS `restaurants`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `restaurants` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `manager_id` int(11) NOT NULL,
  `zone_id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `phone` varchar(50) DEFAULT NULL,
  `address` varchar(100) DEFAULT NULL,
  `description` text,
  `service_policies` text,
  `schedule` text,
  `image` varchar(255) DEFAULT NULL,
  `lat` varchar(45) NOT NULL,
  `long` varchar(45) NOT NULL,
  `created` datetime DEFAULT NULL,
  `updated` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_restaurants_zones_INDEX` (`zone_id`),
  KEY `fk_restaurants_users_INDEX` (`manager_id`),
  CONSTRAINT `fk_restaurants_zones` FOREIGN KEY (`zone_id`) REFERENCES `zones` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_restaurants_users` FOREIGN KEY (`manager_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `restaurants`
--

LOCK TABLES `restaurants` WRITE;
/*!40000 ALTER TABLE `restaurants` DISABLE KEYS */;
INSERT INTO `restaurants` VALUES (1,1,2,'Panda Wok','','','',NULL,'','sin imagen.png','','','2011-11-23 15:42:27','2011-11-23 15:42:27'),(2,1,5,'PAMPERO','','','',NULL,'','sin imagen.png','','','2011-11-23 15:43:03','2011-11-23 15:43:03'),(3,1,2,'El gran taco','','','',NULL,'','sin imagen.png','','','2011-11-23 15:43:29','2011-11-23 15:43:29'),(4,1,6,'AndrÃ©s carne de res','','','',NULL,'','sin imagen.png','','','2011-11-23 15:44:54','2011-11-23 15:44:54'),(5,1,7,'Fridays','','','',NULL,'','sin imagen.png','','','2011-11-23 15:45:21','2011-11-23 15:45:21');
/*!40000 ALTER TABLE `restaurants` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `roles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name_UNIQUE` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `roles`
--

LOCK TABLES `roles` WRITE;
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` VALUES (1,'admin'),(2,'manager'),(3,'user');
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(100) NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `password` char(40) NOT NULL,
  `role_id` int(11) NOT NULL DEFAULT '2',
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `email_verified` tinyint(1) NOT NULL DEFAULT '0',
  `city_id` int(11) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `updated` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email_UNIQUE` (`email`),
  KEY `fk_users_roles_INDEX` (`role_id`),
  KEY `fk_users_cities_INDEX` (`city_id`),
  CONSTRAINT `fk_users_roles` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_users_cities` FOREIGN KEY (`city_id`) REFERENCES `cities` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'admin@bloomweb.co','','','3d66fec9c10dbc7be728b94116fdbad76c134090',1,1,0,NULL,NULL,NULL,NULL),(2,'jiovanna@clickandeat.co','Jiovanna','Alvarez','d17bec2aee4a56a3387465656d45755c2b4ae5c0',2,1,0,1,'','2011-11-23 15:27:56','2011-11-23 15:27:56'),(3,'diana@clickandeat.co','Diana','Garcia','7afcda2606ba835c11f6b0db4f4ea7247d60b94b',2,1,0,2,'','2011-11-23 15:29:13','2011-11-23 15:29:13');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `zones`
--

DROP TABLE IF EXISTS `zones`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `zones` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `city_id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `description` text,
  `image` varchar(255) DEFAULT NULL,
  `lat` varchar(45) DEFAULT NULL,
  `long` varchar(45) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `updated` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_zones_cities_INDEX` (`city_id`),
  CONSTRAINT `fk_zones_cities` FOREIGN KEY (`city_id`) REFERENCES `cities` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `zones`
--

LOCK TABLES `zones` WRITE;
/*!40000 ALTER TABLE `zones` DISABLE KEYS */;
INSERT INTO `zones` VALUES (1,2,'NORTE','','','','','2011-11-23 15:22:09','2011-11-23 15:22:09'),(2,2,'SUR','','','','','2011-11-23 15:22:27','2011-11-23 15:22:27'),(3,2,'OESTE','','','','','2011-11-23 15:22:45','2011-11-23 15:22:45'),(4,2,'Parque del perro','','','','','2011-11-23 15:23:10','2011-11-23 15:23:10'),(5,2,'Granada','','','','','2011-11-23 15:23:28','2011-11-23 15:23:28'),(6,1,'NORTE','','','','','2011-11-23 15:23:47','2011-11-23 15:23:47'),(7,1,'Parque de la 93','','','','','2011-11-23 15:24:05','2011-11-23 15:24:05');
/*!40000 ALTER TABLE `zones` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2011-12-09 18:08:08
