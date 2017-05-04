-- MySQL dump 10.13  Distrib 5.7.9, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: region-travel
-- ------------------------------------------------------
-- Server version	5.6.16

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
-- Table structure for table `access_limitation`
--

DROP TABLE IF EXISTS `access_limitation`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `access_limitation` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Первичный ключ. Таблица необходима для ограничения доступа пользователей до системы.',
  `time_limit_access` int(11) NOT NULL COMMENT 'Количество времени в секундах, на которое блокируется пользователь.',
  `userinfo_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_access_limitation_UNIQUE` (`id`),
  KEY `fk_access_limitation_userinfo1_idx` (`userinfo_id`),
  CONSTRAINT `fk_access_limitation_userinfo` FOREIGN KEY (`userinfo_id`) REFERENCES `userinfo` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `access_limitation`
--

LOCK TABLES `access_limitation` WRITE;
/*!40000 ALTER TABLE `access_limitation` DISABLE KEYS */;
/*!40000 ALTER TABLE `access_limitation` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bus_driver`
--

DROP TABLE IF EXISTS `bus_driver`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bus_driver` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Первичный ключ. Таблица содержит информацию о водителях автобусов.',
  `FIO` text NOT NULL COMMENT 'Фамилия Имя Отчество водителя',
  `number_license` text COMMENT 'Номер водительского удостоверения.',
  `active` tinyint(1) NOT NULL DEFAULT '1' COMMENT 'Активирована ли запись.',
  `date` datetime DEFAULT NULL COMMENT 'Дата регистрации.',
  `first` tinyint(1) NOT NULL DEFAULT '1' COMMENT 'Признак основного водителя',
  `bus_info_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_bus_driver_bus_info1_idx` (`bus_info_id`),
  CONSTRAINT `fk_bus_driver_bus_info1` FOREIGN KEY (`bus_info_id`) REFERENCES `bus_info` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bus_driver`
--

LOCK TABLES `bus_driver` WRITE;
/*!40000 ALTER TABLE `bus_driver` DISABLE KEYS */;
/*!40000 ALTER TABLE `bus_driver` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bus_info`
--

DROP TABLE IF EXISTS `bus_info`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bus_info` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Первичный ключ. Данная схема содержит информацию об автобусах, их наличии на месте, состоянии, времени в пути, а также планированние поездок на автобусных турах.',
  `name` text NOT NULL,
  `gos_number` varchar(25) DEFAULT NULL,
  `seat` int(11) DEFAULT NULL COMMENT 'Количество посадочных мест в автобусе',
  `date` datetime DEFAULT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bus_info`
--

LOCK TABLES `bus_info` WRITE;
/*!40000 ALTER TABLE `bus_info` DISABLE KEYS */;
/*!40000 ALTER TABLE `bus_info` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bus_route`
--

DROP TABLE IF EXISTS `bus_route`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bus_route` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Первичный ключ. В таблице хранятся все маршруты, которые могут проходить автобусы.',
  `name` text NOT NULL,
  `date` datetime DEFAULT NULL,
  `date_begin` datetime DEFAULT NULL,
  `date_end` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bus_route`
--

LOCK TABLES `bus_route` WRITE;
/*!40000 ALTER TABLE `bus_route` DISABLE KEYS */;
/*!40000 ALTER TABLE `bus_route` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bus_route_has_bus_route_point`
--

DROP TABLE IF EXISTS `bus_route_has_bus_route_point`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bus_route_has_bus_route_point` (
  `bus_route_id` int(11) NOT NULL COMMENT 'Часть составного первичного ключа. Таблица с отношением многие-ко-многим, объеденяющая название маршрута и путевые точки маршрута.',
  `bus_route_point_id` int(11) NOT NULL COMMENT 'Часть составного первичного ключа.',
  `first_point` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'Признак того, что данная точка на маршруте является начальной (значение 1).',
  `end_point` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'Признак того, что данная точка на маршруте является конечной (значение 1).',
  PRIMARY KEY (`bus_route_id`,`bus_route_point_id`),
  KEY `fk_bus_route_has_bus_route_point_bus_route_point1_idx` (`bus_route_point_id`),
  KEY `fk_bus_route_has_bus_route_point_bus_route1_idx` (`bus_route_id`),
  CONSTRAINT `fk_bus_route_has_bus_route_point_bus_route1` FOREIGN KEY (`bus_route_id`) REFERENCES `bus_route` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_bus_route_has_bus_route_point_bus_route_point1` FOREIGN KEY (`bus_route_point_id`) REFERENCES `bus_route_point` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bus_route_has_bus_route_point`
--

LOCK TABLES `bus_route_has_bus_route_point` WRITE;
/*!40000 ALTER TABLE `bus_route_has_bus_route_point` DISABLE KEYS */;
/*!40000 ALTER TABLE `bus_route_has_bus_route_point` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bus_route_point`
--

DROP TABLE IF EXISTS `bus_route_point`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bus_route_point` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Первичный ключ. Таблица содержит путевые точки маршрута.',
  `name` text NOT NULL COMMENT 'Название путевой точки',
  `gps_point_m` text COMMENT 'GPS-координаты меридиана.',
  `gps_point_p` text COMMENT 'GPS-координаты паралели.',
  `active` tinyint(1) DEFAULT NULL COMMENT 'Флаг, указывающий активно ли в данный момент путевая точка.',
  `description` text COMMENT 'Описание путевой точки.',
  `date` datetime DEFAULT NULL COMMENT 'Дата создания',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bus_route_point`
--

LOCK TABLES `bus_route_point` WRITE;
/*!40000 ALTER TABLE `bus_route_point` DISABLE KEYS */;
INSERT INTO `bus_route_point` VALUES (1,'Тамбов','41,25','52,43',1,'',NULL),(2,'Тамбов','5555','666',0,'',NULL);
/*!40000 ALTER TABLE `bus_route_point` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bus_way`
--

DROP TABLE IF EXISTS `bus_way`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bus_way` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Первичный ключ. Данная таблица содержит информацию о всех маршрутах автобусов.',
  `name` text NOT NULL,
  `bus_info_id` int(11) NOT NULL,
  `date_create` datetime DEFAULT NULL,
  `date_begin` datetime DEFAULT NULL,
  `date_end` datetime DEFAULT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1' COMMENT 'Поле указывает, опубликовано (активно) ли событие в данный момент.',
  `ended` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'Поле указывает на завершенное событие',
  `bus_path_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_bus_way_bus_path1_idx` (`bus_path_id`),
  KEY `fk_bus_way_bus_info1_idx` (`bus_info_id`),
  CONSTRAINT `fk_bus_way_bus_info1` FOREIGN KEY (`bus_info_id`) REFERENCES `bus_info` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_bus_way_bus_path1` FOREIGN KEY (`bus_path_id`) REFERENCES `bus_route` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bus_way`
--

LOCK TABLES `bus_way` WRITE;
/*!40000 ALTER TABLE `bus_way` DISABLE KEYS */;
/*!40000 ALTER TABLE `bus_way` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `country`
--

DROP TABLE IF EXISTS `country`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `country` (
  `id` int(11) NOT NULL COMMENT 'Первичный ключ, а также цифровой код страны.\nВся таблица заполняется по общероссийскому классификатору стран мира (ISO-3166-1).',
  `name` varchar(100) NOT NULL COMMENT 'Короткое имя страны',
  `full_name` varchar(150) NOT NULL COMMENT 'Полное наименование страны',
  `code2` varchar(2) NOT NULL COMMENT 'Буквенный 2-х значный код страны. Применяется для международного обмена',
  `code3` varchar(3) NOT NULL COMMENT 'Буквенный 3-х значный код страны.',
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`),
  UNIQUE KEY `name_UNIQUE` (`name`),
  UNIQUE KEY `full_name_UNIQUE` (`full_name`),
  UNIQUE KEY `code2_UNIQUE` (`code2`),
  UNIQUE KEY `code3_UNIQUE` (`code3`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `country`
--

LOCK TABLES `country` WRITE;
/*!40000 ALTER TABLE `country` DISABLE KEYS */;
/*!40000 ALTER TABLE `country` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `dashboard`
--

DROP TABLE IF EXISTS `dashboard`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `dashboard` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `layout_class` varchar(255) NOT NULL,
  `sort` int(11) NOT NULL,
  `options` text,
  `enabled` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `dashboard`
--

LOCK TABLES `dashboard` WRITE;
/*!40000 ALTER TABLE `dashboard` DISABLE KEYS */;
INSERT INTO `dashboard` VALUES (1,'Автобусы','cornernote\\dashboard\\layouts\\DefaultLayout',10,'{\"columns\":\"4\"}',1);
/*!40000 ALTER TABLE `dashboard` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `dashboard_panel`
--

DROP TABLE IF EXISTS `dashboard_panel`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `dashboard_panel` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `panel_class` varchar(255) NOT NULL,
  `options` text,
  `dashboard_id` int(11) NOT NULL,
  `region` varchar(255) NOT NULL,
  `sort` int(11) NOT NULL,
  `enabled` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `fk_dashboard_panel_dashboard_id` (`dashboard_id`),
  CONSTRAINT `fk_dashboard_panel_dashboard_id` FOREIGN KEY (`dashboard_id`) REFERENCES `dashboard` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `dashboard_panel`
--

LOCK TABLES `dashboard_panel` WRITE;
/*!40000 ALTER TABLE `dashboard_panel` DISABLE KEYS */;
/*!40000 ALTER TABLE `dashboard_panel` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `discount`
--

DROP TABLE IF EXISTS `discount`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `discount` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Первичный ключ. Таблица содержит информацию о скидках, действующих в отелях.',
  `name` text NOT NULL COMMENT 'Название скидки',
  `discount` float NOT NULL COMMENT 'Стоимость скидки в процентном или денежном выражении (зависит от поля type_price)',
  `type_price` int(11) NOT NULL DEFAULT '0' COMMENT 'Тип скидки: 0 - фиксированная скидка (цена скидки указывается в поле discount), 1 - процент от стоимости (процент указывается в коле discount)',
  `date_begin` datetime DEFAULT NULL COMMENT 'Дата начала действия скидки',
  `date_end` datetime DEFAULT NULL COMMENT 'Дата окончания действия скидки',
  `active` tinyint(1) NOT NULL DEFAULT '1' COMMENT 'Активна ли скидка? По-умолчанию: активна.',
  `hotels_info_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_discount_hotels_info1_idx` (`hotels_info_id`),
  CONSTRAINT `fk_discount_hotels_info1` FOREIGN KEY (`hotels_info_id`) REFERENCES `hotels_info` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `discount`
--

LOCK TABLES `discount` WRITE;
/*!40000 ALTER TABLE `discount` DISABLE KEYS */;
/*!40000 ALTER TABLE `discount` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `distinct`
--

DROP TABLE IF EXISTS `distinct`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `distinct` (
  `id` int(11) NOT NULL COMMENT 'Первичный ключ. Таблица содержит информацию о районах и округах более крупных областей, регионов и т.д.',
  `name` text NOT NULL COMMENT 'Наименование района, округа.',
  `code` varchar(10) DEFAULT NULL COMMENT 'Код округа',
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `distinct`
--

LOCK TABLES `distinct` WRITE;
/*!40000 ALTER TABLE `distinct` DISABLE KEYS */;
/*!40000 ALTER TABLE `distinct` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `hotels_appartment`
--

DROP TABLE IF EXISTS `hotels_appartment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `hotels_appartment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `hotels_info_id` int(11) NOT NULL,
  `name` text,
  `price` float DEFAULT NULL,
  `type_price` int(11) DEFAULT NULL,
  `hotels_appartment_item_id` int(11) NOT NULL,
  PRIMARY KEY (`id`,`hotels_info_id`),
  KEY `fk_hotels_appartment_hotels_info1_idx` (`hotels_info_id`),
  KEY `fk_hotels_appartment_hotels_appartment_item1_idx` (`hotels_appartment_item_id`),
  CONSTRAINT `fk_hotels_appartment_hotels_appartment_item1` FOREIGN KEY (`hotels_appartment_item_id`) REFERENCES `hotels_appartment_item` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_hotels_appartment_hotels_info1` FOREIGN KEY (`hotels_info_id`) REFERENCES `hotels_info` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `hotels_appartment`
--

LOCK TABLES `hotels_appartment` WRITE;
/*!40000 ALTER TABLE `hotels_appartment` DISABLE KEYS */;
/*!40000 ALTER TABLE `hotels_appartment` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `hotels_appartment_has_hotels_type_of_food`
--

DROP TABLE IF EXISTS `hotels_appartment_has_hotels_type_of_food`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `hotels_appartment_has_hotels_type_of_food` (
  `id` int(11) NOT NULL,
  `hotels_appartment_hotels_info_id` int(11) NOT NULL,
  `hotels_type_of_food_id` int(11) NOT NULL,
  PRIMARY KEY (`id`,`hotels_appartment_hotels_info_id`,`hotels_type_of_food_id`),
  KEY `fk_hotels_appartment_has_hotels_type_of_food_hotels_type_of_idx` (`hotels_type_of_food_id`),
  KEY `fk_hotels_appartment_has_hotels_type_of_food_hotels_appartm_idx` (`id`,`hotels_appartment_hotels_info_id`),
  CONSTRAINT `fk_hotels_appartment_has_hotels_type_of_food_hotels_appartment1` FOREIGN KEY (`id`, `hotels_appartment_hotels_info_id`) REFERENCES `hotels_appartment` (`id`, `hotels_info_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_hotels_appartment_has_hotels_type_of_food_hotels_type_of_f1` FOREIGN KEY (`hotels_type_of_food_id`) REFERENCES `hotels_type_of_food` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `hotels_appartment_has_hotels_type_of_food`
--

LOCK TABLES `hotels_appartment_has_hotels_type_of_food` WRITE;
/*!40000 ALTER TABLE `hotels_appartment_has_hotels_type_of_food` DISABLE KEYS */;
/*!40000 ALTER TABLE `hotels_appartment_has_hotels_type_of_food` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `hotels_appartment_item`
--

DROP TABLE IF EXISTS `hotels_appartment_item`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `hotels_appartment_item` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Первичный ключ. Таблица-справочник, содержит информацию о названиях аппартаментов (номеров) в гостиницах.',
  `name` text NOT NULL COMMENT 'Название типа номера',
  `count_beds` int(11) NOT NULL DEFAULT '2' COMMENT 'Количество спальных мест (по-умолчанию)',
  `active` tinyint(1) NOT NULL DEFAULT '1' COMMENT 'Признак доступности элемента',
  `date_add` datetime DEFAULT NULL COMMENT 'Дата добавления',
  `date_edit` datetime DEFAULT NULL COMMENT 'Дата изменения записи',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `hotels_appartment_item`
--

LOCK TABLES `hotels_appartment_item` WRITE;
/*!40000 ALTER TABLE `hotels_appartment_item` DISABLE KEYS */;
INSERT INTO `hotels_appartment_item` VALUES (1,'Стандартный',2,0,NULL,NULL),(2,'Эконом',2,1,NULL,NULL),(3,'Люкс',2,1,NULL,NULL);
/*!40000 ALTER TABLE `hotels_appartment_item` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `hotels_character`
--

DROP TABLE IF EXISTS `hotels_character`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `hotels_character` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` text NOT NULL COMMENT 'Название характеристики',
  `parent_id` int(11) DEFAULT NULL COMMENT 'Родитель характеристики (из этой же таблицы)',
  `num_hierar` int(11) DEFAULT NULL COMMENT 'Номер уровеня в иерархии характеристик',
  `hotels_info_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_hotels_character_hotels_info1_idx` (`hotels_info_id`),
  CONSTRAINT `fk_hotels_character_hotels_info1` FOREIGN KEY (`hotels_info_id`) REFERENCES `hotels_info` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `hotels_character`
--

LOCK TABLES `hotels_character` WRITE;
/*!40000 ALTER TABLE `hotels_character` DISABLE KEYS */;
/*!40000 ALTER TABLE `hotels_character` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `hotels_character_item`
--

DROP TABLE IF EXISTS `hotels_character_item`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `hotels_character_item` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `value` text NOT NULL,
  `type` varchar(45) DEFAULT NULL,
  `hotels_character_id` int(11) NOT NULL,
  `metrics` text COMMENT 'Единица измерения, если необходимо',
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`),
  KEY `fk_hotels_character_and_item_idx` (`hotels_character_id`),
  CONSTRAINT `fk_hotels_character_and_item` FOREIGN KEY (`hotels_character_id`) REFERENCES `hotels_character` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `hotels_character_item`
--

LOCK TABLES `hotels_character_item` WRITE;
/*!40000 ALTER TABLE `hotels_character_item` DISABLE KEYS */;
/*!40000 ALTER TABLE `hotels_character_item` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `hotels_info`
--

DROP TABLE IF EXISTS `hotels_info`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `hotels_info` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Первичный ключ. Таблица содержит общую информацию об отелях, в частности их название',
  `name` text NOT NULL COMMENT 'Название отеля',
  `address_id` int(11) NOT NULL COMMENT 'Адрес',
  `country` int(11) DEFAULT NULL COMMENT 'Страна',
  `GPS` text COMMENT 'GPS-координаты',
  `links_maps` text COMMENT 'Ссылка на интернет-карту местонахождения отеля',
  `hotels_stars_id` int(11) DEFAULT NULL COMMENT 'Ссылка на звёздность',
  PRIMARY KEY (`id`),
  UNIQUE KEY `idhotels-info_UNIQUE` (`id`),
  KEY `fk_hotels_info_hotels_stars1_idx` (`hotels_stars_id`),
  CONSTRAINT `fk_hotels_info_hotels_stars1` FOREIGN KEY (`hotels_stars_id`) REFERENCES `hotels_stars` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `hotels_info`
--

LOCK TABLES `hotels_info` WRITE;
/*!40000 ALTER TABLE `hotels_info` DISABLE KEYS */;
/*!40000 ALTER TABLE `hotels_info` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `hotels_others_pricing`
--

DROP TABLE IF EXISTS `hotels_others_pricing`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `hotels_others_pricing` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Первичный ключ. Дополнительные услуги, от которых зависит цена проживания в гостинице. А также сезонные скидки и надбавки.',
  `hotels_info_id` int(11) NOT NULL,
  `price` float NOT NULL DEFAULT '0' COMMENT 'Ценовая или процентная надбавка к цене.',
  `type_price` int(11) NOT NULL DEFAULT '0' COMMENT 'Тип цены: 0 - фиксированная цена в денежном выражении(значение по-умолчанию, цена указывается в поле price), 1 - процент от стоимости (процент указывается в поле price)',
  `active` tinyint(1) DEFAULT '1',
  `date_begin` datetime DEFAULT NULL,
  `date_end` datetime DEFAULT NULL,
  `hotels_others_pricing_type_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `active_UNIQUE` (`active`),
  KEY `fk_hotels_others_pricing_hotels_info1_idx` (`hotels_info_id`),
  KEY `fk_hotels_others_pricing_hotels_others_pricing_type1_idx` (`hotels_others_pricing_type_id`),
  CONSTRAINT `fk_hotels_others_pricing_hotels_info1` FOREIGN KEY (`hotels_info_id`) REFERENCES `hotels_info` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_hotels_others_pricing_hotels_others_pricing_type1` FOREIGN KEY (`hotels_others_pricing_type_id`) REFERENCES `hotels_others_pricing_type` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `hotels_others_pricing`
--

LOCK TABLES `hotels_others_pricing` WRITE;
/*!40000 ALTER TABLE `hotels_others_pricing` DISABLE KEYS */;
/*!40000 ALTER TABLE `hotels_others_pricing` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `hotels_others_pricing_type`
--

DROP TABLE IF EXISTS `hotels_others_pricing_type`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `hotels_others_pricing_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Первичный ключ. Таблица-справочник хранит информацию о дополнительных ценах, применяемых к отелям (трансфер, доп. питание, экскурсии и т.д.).',
  `name` text NOT NULL COMMENT 'Название дополнительного типа цены',
  `date_add` datetime DEFAULT NULL COMMENT 'Дата добавления',
  `date_edit` datetime DEFAULT NULL COMMENT 'Дата последнего изменения записи',
  `active` tinyint(1) NOT NULL DEFAULT '1' COMMENT 'Признак активности записи',
  `description` text COMMENT 'Описание дополнительного типа цены',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `hotels_others_pricing_type`
--

LOCK TABLES `hotels_others_pricing_type` WRITE;
/*!40000 ALTER TABLE `hotels_others_pricing_type` DISABLE KEYS */;
/*!40000 ALTER TABLE `hotels_others_pricing_type` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `hotels_pricing`
--

DROP TABLE IF EXISTS `hotels_pricing`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `hotels_pricing` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Первичный ключ. В таблице должно содержаться цены на проживание в гостиницах. Цена будет зависеть от характеристик номера и гостиницы',
  `hotels_appartment_id` int(11) NOT NULL,
  `hotels_appartment_hotels_info_id` int(11) NOT NULL,
  `hotels_others_pricing_id` int(11) NOT NULL,
  `date` datetime NOT NULL,
  `full_price` float DEFAULT NULL,
  `discount_id` int(11) NOT NULL,
  `name` text,
  `date_begin` datetime DEFAULT NULL,
  `date_end` datetime DEFAULT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '0',
  `hotels_type_of_food_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`),
  KEY `fk_hotels_pricing_hotels_appartment1_idx` (`hotels_appartment_id`,`hotels_appartment_hotels_info_id`),
  KEY `fk_hotels_pricing_hotels_others_pricing1_idx` (`hotels_others_pricing_id`),
  KEY `fk_hotels_pricing_discount1_idx` (`discount_id`),
  KEY `fk_hotels_pricing_hotels_type_of_food1_idx` (`hotels_type_of_food_id`),
  CONSTRAINT `fk_hotels_pricing_discount1` FOREIGN KEY (`discount_id`) REFERENCES `discount` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_hotels_pricing_hotels_appartment1` FOREIGN KEY (`hotels_appartment_id`, `hotels_appartment_hotels_info_id`) REFERENCES `hotels_appartment` (`id`, `hotels_info_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_hotels_pricing_hotels_others_pricing1` FOREIGN KEY (`hotels_others_pricing_id`) REFERENCES `hotels_others_pricing` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_hotels_pricing_hotels_type_of_food1` FOREIGN KEY (`hotels_type_of_food_id`) REFERENCES `hotels_type_of_food` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `hotels_pricing`
--

LOCK TABLES `hotels_pricing` WRITE;
/*!40000 ALTER TABLE `hotels_pricing` DISABLE KEYS */;
/*!40000 ALTER TABLE `hotels_pricing` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `hotels_stars`
--

DROP TABLE IF EXISTS `hotels_stars`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `hotels_stars` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` text NOT NULL,
  `count_stars` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `hotels_stars`
--

LOCK TABLES `hotels_stars` WRITE;
/*!40000 ALTER TABLE `hotels_stars` DISABLE KEYS */;
INSERT INTO `hotels_stars` VALUES (1,'Без звезд',0),(2,'Одна звезда',1),(3,'Две звезды',2),(4,'Три звезды',3),(5,'Четыре звезды',4),(6,'Пять звезд',5);
/*!40000 ALTER TABLE `hotels_stars` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `hotels_type_of_food`
--

DROP TABLE IF EXISTS `hotels_type_of_food`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `hotels_type_of_food` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Первичный ключ. Таблица-справочник содержит тип питания в отеле.',
  `name` text NOT NULL,
  `abbrev` varchar(10) NOT NULL,
  `price` decimal(10,2) DEFAULT NULL COMMENT 'Цена или надбавка к стоимости проживания в гостинице',
  `type_price` int(11) DEFAULT NULL COMMENT 'Тип цены к проживанию в гостинице. Либо добавляется цена, либо прибавляется процент от исходной суммы номера.',
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `hotels_type_of_food`
--

LOCK TABLES `hotels_type_of_food` WRITE;
/*!40000 ALTER TABLE `hotels_type_of_food` DISABLE KEYS */;
INSERT INTO `hotels_type_of_food` VALUES (1,'Все включено','AI',10.00,1),(2,'Только завтра','TB',5.00,0);
/*!40000 ALTER TABLE `hotels_type_of_food` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `house`
--

DROP TABLE IF EXISTS `house`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `house` (
  `id` int(11) NOT NULL,
  `n_house` varchar(45) DEFAULT NULL,
  `n_campus` varchar(45) DEFAULT NULL,
  `n_apartment` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `house`
--

LOCK TABLES `house` WRITE;
/*!40000 ALTER TABLE `house` DISABLE KEYS */;
/*!40000 ALTER TABLE `house` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `kontragent_org`
--

DROP TABLE IF EXISTS `kontragent_org`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `kontragent_org` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Первичный ключ. Таблица со списком организаций.',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `kontragent_org`
--

LOCK TABLES `kontragent_org` WRITE;
/*!40000 ALTER TABLE `kontragent_org` DISABLE KEYS */;
/*!40000 ALTER TABLE `kontragent_org` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `kontragent_persons`
--

DROP TABLE IF EXISTS `kontragent_persons`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `kontragent_persons` (
  `kontragent_persons_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Первичный ключ. Информация о пользоателях, являющихся физическими лицами.',
  `fname` varchar(150) NOT NULL COMMENT 'Фамилия',
  `lname` varchar(150) NOT NULL COMMENT 'Имя',
  `oname` varchar(155) DEFAULT NULL COMMENT 'Отчество, необязательно',
  `date_new` varchar(45) NOT NULL,
  `date_edit` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`kontragent_persons_id`),
  UNIQUE KEY `idkontragent_persons_UNIQUE` (`kontragent_persons_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `kontragent_persons`
--

LOCK TABLES `kontragent_persons` WRITE;
/*!40000 ALTER TABLE `kontragent_persons` DISABLE KEYS */;
/*!40000 ALTER TABLE `kontragent_persons` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `locality`
--

DROP TABLE IF EXISTS `locality`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `locality` (
  `id` int(11) NOT NULL COMMENT 'Первичный ключ. Таблица с названиями населенных пунктов.',
  `name` text COMMENT 'Наименование населенных пунктов',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `locality`
--

LOCK TABLES `locality` WRITE;
/*!40000 ALTER TABLE `locality` DISABLE KEYS */;
/*!40000 ALTER TABLE `locality` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `login_history`
--

DROP TABLE IF EXISTS `login_history`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `login_history` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Первичный ключ. Таблица требуется для ведения лога входов пользователей в систему.',
  `date_login` datetime NOT NULL COMMENT 'Время входа в систему',
  `date_logout` datetime DEFAULT NULL COMMENT 'Время выхода (либо, время окончания сессии по таймауту) пользователя из системы',
  `ip_login` varchar(40) DEFAULT NULL COMMENT 'IP-адрес, с которого производился вход в систему',
  `type_client` varchar(150) DEFAULT NULL COMMENT 'Тип клиента, который был подключен.\n2015-10-16 - реализация данной опции в планах.',
  `userinfo_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_login_history_UNIQUE` (`id`),
  KEY `fk_login_history_userinfo1_idx` (`userinfo_id`),
  CONSTRAINT `fk_login_history_userinfo` FOREIGN KEY (`userinfo_id`) REFERENCES `userinfo` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `login_history`
--

LOCK TABLES `login_history` WRITE;
/*!40000 ALTER TABLE `login_history` DISABLE KEYS */;
/*!40000 ALTER TABLE `login_history` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `login_statistic`
--

DROP TABLE IF EXISTS `login_statistic`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `login_statistic` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Первичный ключ. Таблица создана для логирования действий пользователей с информационной системой.\nОчень много данных. Выборка будет очень медленной.\nНеобходим пересмотр реализации ведения истории.',
  `table_name` text COMMENT 'Название таблицы, в которой происходили изменения',
  `column_name` text COMMENT 'Название поля, в котором происходили изменения',
  `column_type` varchar(20) DEFAULT NULL COMMENT 'Тип поля, в котором происходили изменения',
  `value` text COMMENT 'Старое значение, которое изменено в указанную дату',
  `edit_time` datetime DEFAULT NULL COMMENT 'Время изменения',
  `userinfo_id` int(11) NOT NULL,
  PRIMARY KEY (`id`,`userinfo_id`),
  UNIQUE KEY `id_login_statistic_UNIQUE` (`id`),
  KEY `fk_login_statistic_userinfo_idx` (`userinfo_id`),
  CONSTRAINT `fk_login_statistic_userinfo` FOREIGN KEY (`userinfo_id`) REFERENCES `userinfo` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `login_statistic`
--

LOCK TABLES `login_statistic` WRITE;
/*!40000 ALTER TABLE `login_statistic` DISABLE KEYS */;
/*!40000 ALTER TABLE `login_statistic` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `masters_items`
--

DROP TABLE IF EXISTS `masters_items`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `masters_items` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sys_masters_id` int(11) NOT NULL,
  PRIMARY KEY (`id`,`sys_masters_id`),
  UNIQUE KEY `id_master-items_UNIQUE` (`id`),
  KEY `fk_master-items_sys-masters1_idx` (`sys_masters_id`),
  CONSTRAINT `fk_master-items_sys-masters1` FOREIGN KEY (`sys_masters_id`) REFERENCES `sys_masters` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `masters_items`
--

LOCK TABLES `masters_items` WRITE;
/*!40000 ALTER TABLE `masters_items` DISABLE KEYS */;
/*!40000 ALTER TABLE `masters_items` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migration`
--

DROP TABLE IF EXISTS `migration`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migration`
--

LOCK TABLES `migration` WRITE;
/*!40000 ALTER TABLE `migration` DISABLE KEYS */;
INSERT INTO `migration` VALUES ('m000000_000000_base',1454200123),('m130524_201442_init',1454200228),('m150705_000001_create_dashboard',1454281520),('m150705_000002_create_dashboard_panel',1454281521);
/*!40000 ALTER TABLE `migration` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mm_hotels_address`
--

DROP TABLE IF EXISTS `mm_hotels_address`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mm_hotels_address` (
  `hotels_info_id` int(11) NOT NULL,
  `country_id` int(11) NOT NULL,
  `state` int(11) DEFAULT NULL,
  `locality_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`hotels_info_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mm_hotels_address`
--

LOCK TABLES `mm_hotels_address` WRITE;
/*!40000 ALTER TABLE `mm_hotels_address` DISABLE KEYS */;
/*!40000 ALTER TABLE `mm_hotels_address` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mm_kontragent_persons_has_kontragent_org`
--

DROP TABLE IF EXISTS `mm_kontragent_persons_has_kontragent_org`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mm_kontragent_persons_has_kontragent_org` (
  `kontragent_persons_id_kontragent-persons` int(11) NOT NULL,
  `kontragent_org_id_kontragent_org` int(11) NOT NULL,
  PRIMARY KEY (`kontragent_persons_id_kontragent-persons`,`kontragent_org_id_kontragent_org`),
  KEY `k_kontragent_persons_has_kontragent_org_kontragent_org_idx` (`kontragent_org_id_kontragent_org`),
  KEY `fk_kontragent_persons_has_kontragent_org_kontragent_persons_idx` (`kontragent_persons_id_kontragent-persons`),
  CONSTRAINT `fk_kontragent_persons_has_kontragent_org_kontragent_org` FOREIGN KEY (`kontragent_org_id_kontragent_org`) REFERENCES `kontragent_org` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_kontragent_persons_has_kontragent_org_kontragent_persons` FOREIGN KEY (`kontragent_persons_id_kontragent-persons`) REFERENCES `kontragent_persons` (`kontragent_persons_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mm_kontragent_persons_has_kontragent_org`
--

LOCK TABLES `mm_kontragent_persons_has_kontragent_org` WRITE;
/*!40000 ALTER TABLE `mm_kontragent_persons_has_kontragent_org` DISABLE KEYS */;
/*!40000 ALTER TABLE `mm_kontragent_persons_has_kontragent_org` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mm_user-role_has_permissions`
--

DROP TABLE IF EXISTS `mm_user-role_has_permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mm_user-role_has_permissions` (
  `user_role_id` int(11) NOT NULL,
  `permissions_id` int(11) NOT NULL,
  PRIMARY KEY (`user_role_id`,`permissions_id`),
  KEY `fk_user_role_has_permissions_permissions_idx` (`permissions_id`),
  KEY `fk_user_role_has_permissions_user-role_idx` (`user_role_id`),
  CONSTRAINT `fk_user_role_has_permissions_permissions` FOREIGN KEY (`permissions_id`) REFERENCES `permissions` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_user_role_has_permissions_user_role` FOREIGN KEY (`user_role_id`) REFERENCES `user_role` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mm_user-role_has_permissions`
--

LOCK TABLES `mm_user-role_has_permissions` WRITE;
/*!40000 ALTER TABLE `mm_user-role_has_permissions` DISABLE KEYS */;
/*!40000 ALTER TABLE `mm_user-role_has_permissions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mm_userinfo_has_permissions`
--

DROP TABLE IF EXISTS `mm_userinfo_has_permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mm_userinfo_has_permissions` (
  `userinfo_id_userinfo` int(11) NOT NULL,
  `permissions_id-permissions` int(11) NOT NULL,
  PRIMARY KEY (`userinfo_id_userinfo`,`permissions_id-permissions`),
  KEY `fk_userinfo_has_permissions_permissions1_idx` (`permissions_id-permissions`),
  KEY `fk_userinfo_has_permissions_userinfo1_idx` (`userinfo_id_userinfo`),
  CONSTRAINT `fk_userinfo_has_permissions_permissions` FOREIGN KEY (`permissions_id-permissions`) REFERENCES `permissions` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_userinfo_has_permissions_userinfo` FOREIGN KEY (`userinfo_id_userinfo`) REFERENCES `userinfo` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mm_userinfo_has_permissions`
--

LOCK TABLES `mm_userinfo_has_permissions` WRITE;
/*!40000 ALTER TABLE `mm_userinfo_has_permissions` DISABLE KEYS */;
/*!40000 ALTER TABLE `mm_userinfo_has_permissions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `permissions`
--

DROP TABLE IF EXISTS `permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `permissions` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Первичный ключ. Таблица содержит информацию о правах доступа к модулям для групп пользователей.',
  `name_modules` text NOT NULL COMMENT 'Имя модуля',
  `all_access` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'Полный доступ',
  `read_access` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'Доступ только на чтение',
  `write_access` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'Доступ на запись (доступ на чтение также разрешен)',
  PRIMARY KEY (`id`),
  UNIQUE KEY `id-permissions_UNIQUE` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `permissions`
--

LOCK TABLES `permissions` WRITE;
/*!40000 ALTER TABLE `permissions` DISABLE KEYS */;
/*!40000 ALTER TABLE `permissions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `personal_info`
--

DROP TABLE IF EXISTS `personal_info`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `personal_info` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Первичный ключ. Полная информация о физическом лице.',
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_personal-info_UNIQUE` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `personal_info`
--

LOCK TABLES `personal_info` WRITE;
/*!40000 ALTER TABLE `personal_info` DISABLE KEYS */;
/*!40000 ALTER TABLE `personal_info` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `persons`
--

DROP TABLE IF EXISTS `persons`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `persons` (
  `id` int(11) unsigned zerofill NOT NULL COMMENT 'Первичный ключ. Таблица содержит персональную информацию туристах',
  `firstname` text NOT NULL,
  `lastname` text NOT NULL,
  `secondname` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `persons`
--

LOCK TABLES `persons` WRITE;
/*!40000 ALTER TABLE `persons` DISABLE KEYS */;
/*!40000 ALTER TABLE `persons` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `region`
--

DROP TABLE IF EXISTS `region`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `region` (
  `id` int(11) NOT NULL COMMENT 'Первичный ключ выступает в качестве номера области по международному классификатору стран (ISO-3166-2).',
  `country_id` int(11) NOT NULL COMMENT 'Внешний ключ. Указывает на принадлежность к государству.',
  `code` varchar(3) NOT NULL COMMENT 'Часть гео-кода территориальной единицы страны.',
  `name` text NOT NULL,
  PRIMARY KEY (`id`,`country_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `region`
--

LOCK TABLES `region` WRITE;
/*!40000 ALTER TABLE `region` DISABLE KEYS */;
/*!40000 ALTER TABLE `region` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sal_basket`
--

DROP TABLE IF EXISTS `sal_basket`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sal_basket` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date` datetime DEFAULT NULL,
  `userinfo_id` int(11) NOT NULL,
  `tour_info_id` int(11) NOT NULL,
  `hotels_info_id` int(11) NOT NULL,
  `trans_info_id` int(11) NOT NULL,
  `price` float DEFAULT NULL COMMENT 'Цена тура',
  `col_day` int(11) DEFAULT NULL,
  `col_person` int(11) DEFAULT NULL,
  `col_kids` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_sal_basket_userinfo1_idx` (`userinfo_id`),
  KEY `fk_sal_basket_tour_info1_idx` (`tour_info_id`),
  KEY `fk_sal_basket_hotels_info1_idx` (`hotels_info_id`),
  KEY `fk_sal_basket_trans_info1_idx` (`trans_info_id`),
  CONSTRAINT `fk_sal_basket_hotels_info1` FOREIGN KEY (`hotels_info_id`) REFERENCES `hotels_info` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_sal_basket_tour_info1` FOREIGN KEY (`tour_info_id`) REFERENCES `tour_info` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_sal_basket_trans_info1` FOREIGN KEY (`trans_info_id`) REFERENCES `trans_info` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_sal_basket_userinfo1` FOREIGN KEY (`userinfo_id`) REFERENCES `userinfo` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sal_basket`
--

LOCK TABLES `sal_basket` WRITE;
/*!40000 ALTER TABLE `sal_basket` DISABLE KEYS */;
/*!40000 ALTER TABLE `sal_basket` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sal_info`
--

DROP TABLE IF EXISTS `sal_info`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sal_info` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sal_info`
--

LOCK TABLES `sal_info` WRITE;
/*!40000 ALTER TABLE `sal_info` DISABLE KEYS */;
/*!40000 ALTER TABLE `sal_info` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sal_order`
--

DROP TABLE IF EXISTS `sal_order`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sal_order` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Первичный ключ. Таблица содержит полную информацию о заказе. Таблица декомпозирована.',
  `date` datetime DEFAULT NULL COMMENT 'Дата создания заказа',
  `sal_order_status_id` int(11) NOT NULL COMMENT 'Статус заказа.',
  `hotels_info` varchar(45) DEFAULT NULL COMMENT 'Информация об отеле',
  `transport_info` varchar(45) DEFAULT NULL COMMENT 'Информация о транспорте.',
  `persons` varchar(45) DEFAULT NULL COMMENT 'Информация о людях, которые отправляются в тур.',
  `child` int(11) DEFAULT NULL COMMENT 'количество детей',
  `date_begin` datetime DEFAULT NULL COMMENT 'Дата начала тура',
  `date_end` datetime DEFAULT NULL COMMENT 'Дата окончания тура',
  `enable` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'Признак того, что заказ закрыт и его невозможно отредактировать.',
  `full_price` float DEFAULT NULL COMMENT 'Полная цена тура.',
  `insurance_info` varchar(45) DEFAULT NULL COMMENT 'Информация о страховке и страховой компании.',
  PRIMARY KEY (`id`),
  KEY `fk_sal_order_sal_order_status1_idx` (`sal_order_status_id`),
  CONSTRAINT `fk_sal_order_sal_order_status1` FOREIGN KEY (`sal_order_status_id`) REFERENCES `sal_order_status` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sal_order`
--

LOCK TABLES `sal_order` WRITE;
/*!40000 ALTER TABLE `sal_order` DISABLE KEYS */;
/*!40000 ALTER TABLE `sal_order` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sal_order_status`
--

DROP TABLE IF EXISTS `sal_order_status`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sal_order_status` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Первичный ключ. Таблица содержит статусы заказов.',
  `name` text NOT NULL COMMENT 'Название статуса заказа.',
  `color` varchar(6) NOT NULL DEFAULT 'ff0000' COMMENT 'Цвет статуса заказа в формате RGB.',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sal_order_status`
--

LOCK TABLES `sal_order_status` WRITE;
/*!40000 ALTER TABLE `sal_order_status` DISABLE KEYS */;
/*!40000 ALTER TABLE `sal_order_status` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sales`
--

DROP TABLE IF EXISTS `sales`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sales` (
  `id_sales` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id_sales`),
  UNIQUE KEY `id_sales_UNIQUE` (`id_sales`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sales`
--

LOCK TABLES `sales` WRITE;
/*!40000 ALTER TABLE `sales` DISABLE KEYS */;
/*!40000 ALTER TABLE `sales` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `state_status`
--

DROP TABLE IF EXISTS `state_status`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `state_status` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Первичный ключ. Таблица содержит названия статусов территориальных единиц государств, например: область, штат, район.',
  `name` varchar(100) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`),
  UNIQUE KEY `name_UNIQUE` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `state_status`
--

LOCK TABLES `state_status` WRITE;
/*!40000 ALTER TABLE `state_status` DISABLE KEYS */;
/*!40000 ALTER TABLE `state_status` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `street`
--

DROP TABLE IF EXISTS `street`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `street` (
  `id` int(11) NOT NULL,
  `name` text COMMENT 'Название улицы',
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `street`
--

LOCK TABLES `street` WRITE;
/*!40000 ALTER TABLE `street` DISABLE KEYS */;
/*!40000 ALTER TABLE `street` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sys_categories`
--

DROP TABLE IF EXISTS `sys_categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sys_categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Первичный ключ.\nНабор таблиц для обеспечения динамического набора опций и характеристик для категорий, а также для создания подразделов.\nТаблицы набора:\n - sys-categories (данная таблица)\n - sys-categories-items',
  `cat_name` text NOT NULL COMMENT 'Имя элемента',
  `sub_levels` int(11) DEFAULT '1' COMMENT 'Уровень вложенности для элемента. Нулевого уровня не существует. Первый уровень - верхняя категория, остальные - глубина вложенности.\nРасчитывается автоматически. Реализация поля под вопросом.',
  `parent_id` int(11) NOT NULL DEFAULT '0' COMMENT 'Ключ родительской категории',
  `active` tinyint(1) NOT NULL DEFAULT '1' COMMENT 'Поле указывает, ',
  `cat_name_full` text COMMENT 'Полное наименование категории',
  `date_add` datetime NOT NULL,
  `date_edit` datetime NOT NULL,
  `in_main_menu` tinyint(1) NOT NULL DEFAULT '1' COMMENT 'Данная категория находится в главном меню.',
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_sys-categories_UNIQUE` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sys_categories`
--

LOCK TABLES `sys_categories` WRITE;
/*!40000 ALTER TABLE `sys_categories` DISABLE KEYS */;
/*!40000 ALTER TABLE `sys_categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sys_categories_items`
--

DROP TABLE IF EXISTS `sys_categories_items`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sys_categories_items` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Первичный ключ. Таблица содержит информацию об элементе категорий.',
  `sys_categories_id` int(11) NOT NULL COMMENT 'Составной ключ',
  `value` text NOT NULL COMMENT 'Значение элемента категории',
  `type` varchar(50) NOT NULL,
  `size` int(11) NOT NULL,
  `date_add` datetime NOT NULL,
  `date_edit` datetime NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`,`sys_categories_id`),
  UNIQUE KEY `id_sys-categories-items_UNIQUE` (`id`),
  KEY `fk_sys-categories-items_sys-categories1_idx` (`sys_categories_id`),
  CONSTRAINT `fk_sys-categories-items_sys-categories1` FOREIGN KEY (`sys_categories_id`) REFERENCES `sys_categories` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sys_categories_items`
--

LOCK TABLES `sys_categories_items` WRITE;
/*!40000 ALTER TABLE `sys_categories_items` DISABLE KEYS */;
/*!40000 ALTER TABLE `sys_categories_items` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sys_characters`
--

DROP TABLE IF EXISTS `sys_characters`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sys_characters` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Первичный ключ. Таблица содержит значения характеристик того или иного товара/категории.',
  `name` varchar(45) NOT NULL,
  `sys_categories_items_id` int(11) NOT NULL,
  `sys_categories_items_sys_categories_id` int(11) NOT NULL,
  `in_price` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'Поле указывает на то, что от этой характеристики зависит цена.',
  PRIMARY KEY (`id`),
  UNIQUE KEY `idsys-characters_UNIQUE` (`id`),
  KEY `fk_sys-characters_sys-categories-items1_idx` (`sys_categories_items_id`,`sys_categories_items_sys_categories_id`),
  CONSTRAINT `fk_sys-characters_sys-categories-items1` FOREIGN KEY (`sys_categories_items_id`, `sys_categories_items_sys_categories_id`) REFERENCES `sys_categories_items` (`id`, `sys_categories_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sys_characters`
--

LOCK TABLES `sys_characters` WRITE;
/*!40000 ALTER TABLE `sys_characters` DISABLE KEYS */;
/*!40000 ALTER TABLE `sys_characters` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sys_characters_items`
--

DROP TABLE IF EXISTS `sys_characters_items`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sys_characters_items` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `items_value` text NOT NULL,
  `sys_characters_id` int(11) NOT NULL,
  PRIMARY KEY (`id`,`sys_characters_id`),
  KEY `fk_sys-characters-items_sys-characters1_idx` (`sys_characters_id`),
  CONSTRAINT `fk_sys-characters-items_sys-characters1` FOREIGN KEY (`sys_characters_id`) REFERENCES `sys_characters` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sys_characters_items`
--

LOCK TABLES `sys_characters_items` WRITE;
/*!40000 ALTER TABLE `sys_characters_items` DISABLE KEYS */;
/*!40000 ALTER TABLE `sys_characters_items` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sys_masters`
--

DROP TABLE IF EXISTS `sys_masters`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sys_masters` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Первичный ключ. Таблица служит для создания мастеров настройки.',
  `name_masters` text NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_sys-masters_UNIQUE` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sys_masters`
--

LOCK TABLES `sys_masters` WRITE;
/*!40000 ALTER TABLE `sys_masters` DISABLE KEYS */;
/*!40000 ALTER TABLE `sys_masters` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tour_info`
--

DROP TABLE IF EXISTS `tour_info`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tour_info` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Первичный ключ. Сводная информация о туре.',
  `name` text NOT NULL,
  `date_begin` datetime DEFAULT NULL,
  `date_end` datetime DEFAULT NULL,
  `days` int(11) NOT NULL DEFAULT '0' COMMENT 'Количество дней тура',
  `tour_type_id` int(11) NOT NULL,
  `toury_type_transport_id` int(11) NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'Признак активности тура',
  PRIMARY KEY (`id`),
  KEY `fk_tour_info_tour_type1_idx` (`tour_type_id`),
  KEY `fk_tour_info_toury_type_transport1_idx` (`toury_type_transport_id`),
  CONSTRAINT `fk_tour_info_toury_type_transport1` FOREIGN KEY (`toury_type_transport_id`) REFERENCES `tour_type_transport` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_tour_info_tour_type1` FOREIGN KEY (`tour_type_id`) REFERENCES `tour_type` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tour_info`
--

LOCK TABLES `tour_info` WRITE;
/*!40000 ALTER TABLE `tour_info` DISABLE KEYS */;
/*!40000 ALTER TABLE `tour_info` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tour_price`
--

DROP TABLE IF EXISTS `tour_price`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tour_price` (
  `id` int(11) NOT NULL COMMENT 'Первичный ключ. Таблица содержит информацию о ценах на все услуги по датам.\n',
  `price` decimal(10,2) NOT NULL COMMENT 'Цена услуги/товара',
  `date` datetime DEFAULT NULL COMMENT 'Дата создания цены товара',
  `active` tinyint(1) DEFAULT NULL COMMENT 'Актуальна ли цена',
  `date_begin` datetime DEFAULT NULL COMMENT 'Поле показывает, в какое время цена начинает действовать',
  `date_end` datetime DEFAULT NULL COMMENT 'Поле показывает, в какое время цена перестанет действовать',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='.......;l';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tour_price`
--

LOCK TABLES `tour_price` WRITE;
/*!40000 ALTER TABLE `tour_price` DISABLE KEYS */;
/*!40000 ALTER TABLE `tour_price` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tour_type`
--

DROP TABLE IF EXISTS `tour_type`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tour_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Первичный ключ. Данная таблица-справочник содержит типы туров.',
  `name` text NOT NULL COMMENT 'Название типа тура (Автобусные туры, Свадебные туры и т.д.)',
  `days` int(11) NOT NULL COMMENT 'Продолжительность типа тура в днях (шаблонная)',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tour_type`
--

LOCK TABLES `tour_type` WRITE;
/*!40000 ALTER TABLE `tour_type` DISABLE KEYS */;
/*!40000 ALTER TABLE `tour_type` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tour_type_transport`
--

DROP TABLE IF EXISTS `tour_type_transport`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tour_type_transport` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Первичный ключ. Исходный, неизменяемый справочник с типами транспорта: Собственный транспорт, Автобус, Поезд, Самолет.',
  `name` text COMMENT 'Наименование типа тура. Справочник.',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tour_type_transport`
--

LOCK TABLES `tour_type_transport` WRITE;
/*!40000 ALTER TABLE `tour_type_transport` DISABLE KEYS */;
/*!40000 ALTER TABLE `tour_type_transport` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `trans_info`
--

DROP TABLE IF EXISTS `trans_info`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `trans_info` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Первичный ключ. Схема отвечает за структуру транспортной подсистемы. Учет и хранение рейсов ж/д и авиа транспорта.',
  `trans_type_id` int(11) NOT NULL COMMENT 'Необходимый тип трансопрт',
  `name` text NOT NULL COMMENT 'Наименование',
  `trans_route_id` int(11) NOT NULL,
  `trans_price_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_trans_info_trans_type1_idx` (`trans_type_id`),
  KEY `fk_trans_info_trans_route1_idx` (`trans_route_id`),
  KEY `fk_trans_info_trans_price1_idx` (`trans_price_id`),
  CONSTRAINT `fk_trans_info_trans_price1` FOREIGN KEY (`trans_price_id`) REFERENCES `trans_price` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_trans_info_trans_route1` FOREIGN KEY (`trans_route_id`) REFERENCES `trans_route` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_trans_info_trans_type1` FOREIGN KEY (`trans_type_id`) REFERENCES `trans_type` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `trans_info`
--

LOCK TABLES `trans_info` WRITE;
/*!40000 ALTER TABLE `trans_info` DISABLE KEYS */;
/*!40000 ALTER TABLE `trans_info` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `trans_price`
--

DROP TABLE IF EXISTS `trans_price`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `trans_price` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Первичный ключ. Таблица содержит информацию о цене маршрута',
  `price` float DEFAULT NULL,
  `date_add` datetime DEFAULT NULL,
  `date_edit` datetime DEFAULT NULL,
  `trans_price_type_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_trans_price_trans_price_type1_idx` (`trans_price_type_id`),
  CONSTRAINT `fk_trans_price_trans_price_type1` FOREIGN KEY (`trans_price_type_id`) REFERENCES `trans_price_type` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `trans_price`
--

LOCK TABLES `trans_price` WRITE;
/*!40000 ALTER TABLE `trans_price` DISABLE KEYS */;
/*!40000 ALTER TABLE `trans_price` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `trans_price_type`
--

DROP TABLE IF EXISTS `trans_price_type`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `trans_price_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Первичный ключ. Таблица содержит информацию о типах цен (например: плацкарта, купе, бизнес-класс, эконом-класс)',
  `name` text,
  `description` text,
  `date_add` datetime DEFAULT NULL,
  `date_edit` datetime DEFAULT NULL,
  `active` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `trans_price_type`
--

LOCK TABLES `trans_price_type` WRITE;
/*!40000 ALTER TABLE `trans_price_type` DISABLE KEYS */;
/*!40000 ALTER TABLE `trans_price_type` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `trans_route`
--

DROP TABLE IF EXISTS `trans_route`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `trans_route` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Первичный ключ. Таблица содержит информацию о маршрутных точках транспорта.',
  `date_add` datetime DEFAULT NULL,
  `date_edit` datetime DEFAULT NULL,
  `active` tinyint(1) DEFAULT NULL,
  `begin_point` text,
  `end_point` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `trans_route`
--

LOCK TABLES `trans_route` WRITE;
/*!40000 ALTER TABLE `trans_route` DISABLE KEYS */;
/*!40000 ALTER TABLE `trans_route` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `trans_route_has_trans_station`
--

DROP TABLE IF EXISTS `trans_route_has_trans_station`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `trans_route_has_trans_station` (
  `trans_route_id` int(11) NOT NULL,
  `trans_station_id` int(11) NOT NULL,
  PRIMARY KEY (`trans_route_id`,`trans_station_id`),
  KEY `fk_trans_route_has_trans_station_trans_station1_idx` (`trans_station_id`),
  KEY `fk_trans_route_has_trans_station_trans_route1_idx` (`trans_route_id`),
  CONSTRAINT `fk_trans_route_has_trans_station_trans_route1` FOREIGN KEY (`trans_route_id`) REFERENCES `trans_route` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_trans_route_has_trans_station_trans_station1` FOREIGN KEY (`trans_station_id`) REFERENCES `trans_station` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `trans_route_has_trans_station`
--

LOCK TABLES `trans_route_has_trans_station` WRITE;
/*!40000 ALTER TABLE `trans_route_has_trans_station` DISABLE KEYS */;
/*!40000 ALTER TABLE `trans_route_has_trans_station` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `trans_station`
--

DROP TABLE IF EXISTS `trans_station`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `trans_station` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Первичный ключ. Таблица содержит все станции назначения',
  `name` text,
  `description` text,
  `gps_parallel` text,
  `gps_meridian` text,
  `address_id` int(11) DEFAULT NULL,
  `trans_type_station_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_trans_station_trans_type_station1_idx` (`trans_type_station_id`),
  CONSTRAINT `fk_trans_station_trans_type_station1` FOREIGN KEY (`trans_type_station_id`) REFERENCES `trans_type_station` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `trans_station`
--

LOCK TABLES `trans_station` WRITE;
/*!40000 ALTER TABLE `trans_station` DISABLE KEYS */;
/*!40000 ALTER TABLE `trans_station` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `trans_type`
--

DROP TABLE IF EXISTS `trans_type`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `trans_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Первичный ключ. Тип транспорт.',
  `name` text NOT NULL COMMENT 'Название',
  `trans_type_station_id` int(11) NOT NULL COMMENT 'Выберите тип вокзала для текущего транспорта.',
  PRIMARY KEY (`id`),
  KEY `fk_trans_type_trans_type_station_idx` (`trans_type_station_id`),
  CONSTRAINT `fk_trans_type_trans_type_station` FOREIGN KEY (`trans_type_station_id`) REFERENCES `trans_type_station` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `trans_type`
--

LOCK TABLES `trans_type` WRITE;
/*!40000 ALTER TABLE `trans_type` DISABLE KEYS */;
/*!40000 ALTER TABLE `trans_type` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `trans_type_station`
--

DROP TABLE IF EXISTS `trans_type_station`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `trans_type_station` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Первичный ключ. Тип вокзала',
  `name` text NOT NULL COMMENT 'Название',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `trans_type_station`
--

LOCK TABLES `trans_type_station` WRITE;
/*!40000 ALTER TABLE `trans_type_station` DISABLE KEYS */;
/*!40000 ALTER TABLE `trans_type_station` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `auth_key` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `password_hash` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password_reset_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` smallint(6) NOT NULL DEFAULT '10',
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  `role` varchar(100) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'guest',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (1,'admin','2B7lzwCzRdUQ_a4DP4E5WkXd6wrn5ahG','$2y$13$mVE70Sb3.mgGXKOwmkpE5.uchzf4KrXcPem8gvBIZHZsTZXUqu7cC',NULL,'tkirsan4ik@gmail.com',10,1454200291,1454200291,'guest');
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_role`
--

DROP TABLE IF EXISTS `user_role`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_role` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Первичный ключ. Таблица представляет собой справочник ролей пользователей.',
  `role_name` text NOT NULL COMMENT 'Название роли пользователей',
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_user_role_UNIQUE` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_role`
--

LOCK TABLES `user_role` WRITE;
/*!40000 ALTER TABLE `user_role` DISABLE KEYS */;
INSERT INTO `user_role` VALUES (1,'Гость'),(2,'Зарегистрированный пользователь'),(3,'Турагентство'),(4,'Менеджер'),(5,'Администратор'),(6,'Супер-администратор');
/*!40000 ALTER TABLE `user_role` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `userinfo`
--

DROP TABLE IF EXISTS `userinfo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `userinfo` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Первичный ключ. Таблица создана для хранения общей информации.',
  `login` varchar(50) NOT NULL COMMENT 'Логин для входа в систему.',
  `email` varchar(200) DEFAULT NULL COMMENT 'Пароль, привязанный к учетной записи.',
  `password` varchar(32) NOT NULL COMMENT 'Пароль для входа в систему',
  `create_time` datetime NOT NULL COMMENT 'Дата создания учетной записи',
  `last_login` datetime DEFAULT NULL COMMENT 'Время последнего входа в систему',
  `auth_key` varchar(250) DEFAULT NULL COMMENT 'Подтверждение регистрации',
  `user_role_id` int(11) NOT NULL,
  `password_reset_token` text,
  PRIMARY KEY (`id`),
  KEY `fk_userinfo_user_role_idx` (`user_role_id`),
  CONSTRAINT `fk_userinfo_user_role` FOREIGN KEY (`user_role_id`) REFERENCES `user_role` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `userinfo`
--

LOCK TABLES `userinfo` WRITE;
/*!40000 ALTER TABLE `userinfo` DISABLE KEYS */;
/*!40000 ALTER TABLE `userinfo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `userinfo_other`
--

DROP TABLE IF EXISTS `userinfo_other`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `userinfo_other` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Первичный ключ. Таблица содержит прочую информацию о пользователях. Настраеваемые поля.',
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_userinfo-other_UNIQUE` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `userinfo_other`
--

LOCK TABLES `userinfo_other` WRITE;
/*!40000 ALTER TABLE `userinfo_other` DISABLE KEYS */;
/*!40000 ALTER TABLE `userinfo_other` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping routines for database 'region-travel'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2016-02-09  1:38:16
