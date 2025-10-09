/*M!999999\- enable the sandbox mode */ 
-- MariaDB dump 10.19-11.4.7-MariaDB, for Linux (x86_64)
--
-- Host: localhost    Database: cimun_db
-- ------------------------------------------------------
-- Server version	11.4.7-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*M!100616 SET @OLD_NOTE_VERBOSITY=@@NOTE_VERBOSITY, NOTE_VERBOSITY=0 */;

--
-- Current Database: `cimun_db`
--


--
-- Table structure for table `areas`
--

DROP TABLE IF EXISTS `areas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `areas` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `created_by` bigint(20) unsigned DEFAULT NULL,
  `updated_by` bigint(20) unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `areas_created_by_foreign` (`created_by`),
  KEY `areas_updated_by_foreign` (`updated_by`),
  CONSTRAINT `areas_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  CONSTRAINT `areas_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `areas`
--

LOCK TABLES `areas` WRITE;
/*!40000 ALTER TABLE `areas` DISABLE KEYS */;
INSERT INTO `areas` (`id`, `name`, `description`, `created_by`, `updated_by`, `created_at`, `updated_at`, `deleted_at`) VALUES (1,'Administración Municipal','Área encargada de la gestión interna, recursos humanos y coordinación general',NULL,7,NULL,'2025-09-01 18:19:23',NULL),
(2,'Secretaría Municipal','Responsable de actas, decretos, transparencia y atención al concejo',NULL,NULL,NULL,NULL,NULL),
(3,'Dirección de Obras Municipales','Supervisa construcciones, permisos, urbanismo y planificación territorial',NULL,NULL,NULL,NULL,NULL),
(4,'Finanzas','Gestiona presupuesto, contabilidad, pagos y recaudación de ingresos',NULL,NULL,NULL,NULL,NULL),
(5,'Desarrollo Comunitario','Promueve participación ciudadana, organizaciones sociales y programas comunitarios',NULL,NULL,NULL,NULL,NULL),
(6,'Educación','Administra establecimientos educacionales municipales y programas escolares',NULL,NULL,NULL,NULL,NULL),
(7,'Salud','Gestiona centros de atención primaria y programas de salud pública',NULL,NULL,NULL,NULL,NULL),
(8,'Aseo y Ornato','Encargada de limpieza urbana, áreas verdes y mantención de espacios públicos',NULL,NULL,NULL,NULL,NULL),
(9,'Seguridad Pública','Coordina patrullajes, prevención del delito y vínculos con Carabineros',NULL,NULL,NULL,NULL,NULL),
(10,'Transporte y Tránsito','Regula el tránsito, señalización, permisos de circulación y transporte público local',NULL,NULL,NULL,NULL,NULL),
(11,'Medio Ambiente','Promueve la sustentabilidad, reciclaje y protección ambiental',NULL,NULL,NULL,NULL,NULL),
(12,'Turismo y Cultura','Fomenta actividades culturales, patrimonio y promoción turística local',NULL,NULL,NULL,NULL,NULL),
(13,'Fomento Productivo','Apoya emprendimientos, ferias, comercio local y desarrollo económico',NULL,NULL,NULL,NULL,NULL),
(14,'Tecnologías de la Información','Administra sistemas informáticos, soporte técnico y transformación digital',NULL,NULL,NULL,NULL,NULL),
(15,'Jurídico','Asesora legalmente al municipio y gestiona litigios y normativas',NULL,NULL,NULL,NULL,NULL),
(16,'Planificación Estratégica','Diseña planes de desarrollo comunal y evalúa proyectos municipales',NULL,NULL,NULL,NULL,NULL),
(17,'Area de prueba','Area',7,7,'2025-08-29 04:15:16','2025-08-29 04:15:16',NULL);
/*!40000 ALTER TABLE `areas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `business_rules`
--

DROP TABLE IF EXISTS `business_rules`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `business_rules` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `incident_id` bigint(20) unsigned NOT NULL,
  `trigger_type` varchar(255) NOT NULL,
  `condition` varchar(255) NOT NULL,
  `action` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `business_rules_incident_id_foreign` (`incident_id`),
  CONSTRAINT `business_rules_incident_id_foreign` FOREIGN KEY (`incident_id`) REFERENCES `incidents` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `business_rules`
--

LOCK TABLES `business_rules` WRITE;
/*!40000 ALTER TABLE `business_rules` DISABLE KEYS */;
/*!40000 ALTER TABLE `business_rules` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cache`
--

DROP TABLE IF EXISTS `cache`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cache`
--

LOCK TABLES `cache` WRITE;
/*!40000 ALTER TABLE `cache` DISABLE KEYS */;
INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES ('cimun_cache_daniel.sanchez.f@gmail.com|181.160.134.182','i:3;',1757087332),
('cimun_cache_daniel.sanchez.f@gmail.com|181.160.134.182:timer','i:1757087332;',1757087332),
('cimun_cache_daniel1_sanchez@hotmail.com|181.160.134.182','i:2;',1757087295),
('cimun_cache_daniel1_sanchez@hotmail.com|181.160.134.182:timer','i:1757087295;',1757087295);
/*!40000 ALTER TABLE `cache` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cache_locks`
--

DROP TABLE IF EXISTS `cache_locks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL,
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
-- Table structure for table `category_municipality_sla`
--

DROP TABLE IF EXISTS `category_municipality_sla`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `category_municipality_sla` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `incident_category_id` bigint(20) unsigned NOT NULL,
  `municipality_id` bigint(20) unsigned NOT NULL,
  `sla_hours` int(10) unsigned NOT NULL DEFAULT 24,
  `sla_type` enum('respuesta','resolución','escalamiento') NOT NULL DEFAULT 'respuesta',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `category_municipality_sla_incident_category_id_foreign` (`incident_category_id`),
  KEY `category_municipality_sla_municipality_id_foreign` (`municipality_id`),
  CONSTRAINT `category_municipality_sla_incident_category_id_foreign` FOREIGN KEY (`incident_category_id`) REFERENCES `incident_categories` (`id`) ON DELETE CASCADE,
  CONSTRAINT `category_municipality_sla_municipality_id_foreign` FOREIGN KEY (`municipality_id`) REFERENCES `municipalities` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `category_municipality_sla`
--

LOCK TABLES `category_municipality_sla` WRITE;
/*!40000 ALTER TABLE `category_municipality_sla` DISABLE KEYS */;
/*!40000 ALTER TABLE `category_municipality_sla` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cities`
--

DROP TABLE IF EXISTS `cities`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `cities` (
  `id_city` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `id_region` int(10) unsigned NOT NULL,
  `id_country` int(10) unsigned NOT NULL,
  `name` varchar(50) NOT NULL,
  PRIMARY KEY (`id_city`),
  KEY `FK_cities_regions` (`id_region`),
  KEY `FK_cities_countries` (`id_country`),
  CONSTRAINT `FK_cities_countries` FOREIGN KEY (`id_country`) REFERENCES `countries` (`id_country`),
  CONSTRAINT `FK_cities_regions` FOREIGN KEY (`id_region`) REFERENCES `regions` (`id_region`)
) ENGINE=InnoDB AUTO_INCREMENT=347 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cities`
--

LOCK TABLES `cities` WRITE;
/*!40000 ALTER TABLE `cities` DISABLE KEYS */;
INSERT INTO `cities` (`id_city`, `id_region`, `id_country`, `name`) VALUES (1,1,1,'Arica'),
(2,1,1,'Camarones'),
(3,1,1,'Putre'),
(4,1,1,'General Lagos'),
(5,2,1,'Iquique'),
(6,2,1,'Alto Hospicio'),
(7,2,1,'Pozo Almonte'),
(8,2,1,'Camiña'),
(9,2,1,'Colchane'),
(10,2,1,'Huara'),
(11,2,1,'Pica'),
(12,3,1,'Antofagasta'),
(13,3,1,'Mejillones'),
(14,3,1,'Sierra Gorda'),
(15,3,1,'Taltal'),
(16,3,1,'Calama'),
(17,3,1,'Ollagüe'),
(18,3,1,'San Pedro de Atacama'),
(19,3,1,'Tocopilla'),
(20,3,1,'María Elena'),
(21,4,1,'Copiapó'),
(22,4,1,'Caldera'),
(23,4,1,'Tierra Amarilla'),
(24,4,1,'Chañaral'),
(25,4,1,'Diego de Almagro'),
(26,4,1,'Vallenar'),
(27,4,1,'Alto del Carmen'),
(28,4,1,'Freirina'),
(29,4,1,'Huasco'),
(30,5,1,'La Serena'),
(31,5,1,'Coquimbo'),
(32,5,1,'Andacollo'),
(33,5,1,'La Higuera'),
(34,5,1,'Paihuano'),
(35,5,1,'Vicuña'),
(36,5,1,'Illapel'),
(37,5,1,'Canela'),
(38,5,1,'Los Vilos'),
(39,5,1,'Salamanca'),
(40,5,1,'Ovalle'),
(41,5,1,'Combarbalá'),
(42,5,1,'Monte Patria'),
(43,5,1,'Punitaqui'),
(44,5,1,'Río Hurtado'),
(45,6,1,'Valparaíso'),
(46,6,1,'Casablanca'),
(47,6,1,'Concón'),
(48,6,1,'Juan Fernández'),
(49,6,1,'Puchuncaví'),
(50,6,1,'Quintero'),
(51,6,1,'Viña del Mar'),
(52,6,1,'Isla de Pascua'),
(53,6,1,'Los Andes'),
(54,6,1,'Calle Larga'),
(55,6,1,'Rinconada'),
(56,6,1,'San Esteban'),
(57,6,1,'La Ligua'),
(58,6,1,'Cabildo'),
(59,6,1,'Papudo'),
(60,6,1,'Petorca'),
(61,6,1,'Zapallar'),
(62,6,1,'Quillota'),
(63,6,1,'La Calera'),
(64,6,1,'Hijuelas'),
(65,6,1,'La Cruz'),
(66,6,1,'Nogales'),
(67,6,1,'San Antonio'),
(68,6,1,'Algarrobo'),
(69,6,1,'Cartagena'),
(70,6,1,'El Quisco'),
(71,6,1,'El Tabo'),
(72,6,1,'Santo Domingo'),
(73,6,1,'San Felipe'),
(74,6,1,'Catemu'),
(75,6,1,'Llay-Llay'),
(76,6,1,'Panquehue'),
(77,6,1,'Putaendo'),
(78,6,1,'Santa María'),
(79,6,1,'Quilpué'),
(80,6,1,'Limache'),
(81,6,1,'Olmué'),
(82,6,1,'Villa Alemana'),
(83,8,1,'Rancagua'),
(84,8,1,'Codegua'),
(85,8,1,'Coinco'),
(86,8,1,'Coltauco'),
(87,8,1,'Doñihue'),
(88,8,1,'Graneros'),
(89,8,1,'Las Cabras'),
(90,8,1,'Machalí'),
(91,8,1,'Malloa'),
(92,8,1,'Mostazal'),
(93,8,1,'Olivar'),
(94,8,1,'Peumo'),
(95,8,1,'Pichidegua'),
(96,8,1,'Quinta de Tilcoco'),
(97,8,1,'Rengo'),
(98,8,1,'Requínoa'),
(99,8,1,'San Vicente'),
(100,8,1,'Pichilemu'),
(101,8,1,'La Estrella'),
(102,8,1,'Litueche'),
(103,8,1,'Marchihue'),
(104,8,1,'Navidad'),
(105,8,1,'Paredones'),
(106,8,1,'San Fernando'),
(107,8,1,'Chépica'),
(108,8,1,'Chimbarongo'),
(109,8,1,'Lolol'),
(110,8,1,'Nancagua'),
(111,8,1,'Palmilla'),
(112,8,1,'Peralillo'),
(113,8,1,'Placilla'),
(114,8,1,'Pumanque'),
(115,8,1,'Santa Cruz'),
(116,9,1,'Talca'),
(117,9,1,'Constitución'),
(118,9,1,'Curepto'),
(119,9,1,'Empedrado'),
(120,9,1,'Maule'),
(121,9,1,'Pelarco'),
(122,9,1,'Pencahue'),
(123,9,1,'Río Claro'),
(124,9,1,'San Clemente'),
(125,9,1,'San Rafael'),
(126,9,1,'Cauquenes'),
(127,9,1,'Chanco'),
(128,9,1,'Pelluhue'),
(129,9,1,'Curicó'),
(130,9,1,'Hualañé'),
(131,9,1,'Licantén'),
(132,9,1,'Molina'),
(133,9,1,'Rauco'),
(134,9,1,'Romeral'),
(135,9,1,'Sagrada Familia'),
(136,9,1,'Teno'),
(137,9,1,'Vichuquén'),
(138,9,1,'Linares'),
(139,9,1,'Colbún'),
(140,9,1,'Longaví'),
(141,9,1,'Parral'),
(142,9,1,'Retiro'),
(143,9,1,'San Javier'),
(144,9,1,'Villa Alegre'),
(145,9,1,'Yerbas Buenas'),
(146,10,1,'Chillán'),
(147,10,1,'Bulnes'),
(148,10,1,'Chillán Viejo'),
(149,10,1,'El Carmen'),
(150,10,1,'Pemuco'),
(151,10,1,'Pinto'),
(152,10,1,'Quillón'),
(153,10,1,'San Ignacio'),
(154,10,1,'Yungay'),
(155,10,1,'Quirihue'),
(156,10,1,'Cobquecura'),
(157,10,1,'Coelemu'),
(158,10,1,'Ninhue'),
(159,10,1,'Portezuelo'),
(160,10,1,'Ránquil'),
(161,10,1,'Treguaco'),
(162,10,1,'San Carlos'),
(163,10,1,'Coihueco'),
(164,10,1,'Ñiquén'),
(165,10,1,'San Fabián'),
(166,10,1,'San Nicolás'),
(167,11,1,'Concepción'),
(168,11,1,'Coronel'),
(169,11,1,'Chiguayante'),
(170,11,1,'Florida'),
(171,11,1,'Hualqui'),
(172,11,1,'Lota'),
(173,11,1,'Penco'),
(174,11,1,'San Pedro de La Paz'),
(175,11,1,'Santa Juana'),
(176,11,1,'Talcahuano'),
(177,11,1,'Tomé'),
(178,11,1,'Hualpén'),
(179,11,1,'Lebu'),
(180,11,1,'Arauco'),
(181,11,1,'Cañete'),
(182,11,1,'Contulmo'),
(183,11,1,'Curanilahue'),
(184,11,1,'Los Álamos'),
(185,11,1,'Tirúa'),
(186,11,1,'Los Ángeles'),
(187,11,1,'Antuco'),
(188,11,1,'Cabrero'),
(189,11,1,'Laja'),
(190,11,1,'Mulchén'),
(191,11,1,'Nacimiento'),
(192,11,1,'Negrete'),
(193,11,1,'Quilaco'),
(194,11,1,'Quilleco'),
(195,11,1,'San Rosendo'),
(196,11,1,'Santa Bárbara'),
(197,11,1,'Tucapel'),
(198,11,1,'Yumbel'),
(199,11,1,'Alto Biobío'),
(200,12,1,'Temuco'),
(201,12,1,'Carahue'),
(202,12,1,'Cunco'),
(203,12,1,'Curarrehue'),
(204,12,1,'Freire'),
(205,12,1,'Galvarino'),
(206,12,1,'Gorbea'),
(207,12,1,'Lautaro'),
(208,12,1,'Loncoche'),
(209,12,1,'Melipeuco'),
(210,12,1,'Nueva Imperial'),
(211,12,1,'Padre Las Casas'),
(212,12,1,'Perquenco'),
(213,12,1,'Pitrufquén'),
(214,12,1,'Pucón'),
(215,12,1,'Saavedra'),
(216,12,1,'Teodoro Schmidt'),
(217,12,1,'Toltén'),
(218,12,1,'Vilcún'),
(219,12,1,'Villarrica'),
(220,12,1,'Cholchol'),
(221,12,1,'Angol'),
(222,12,1,'Collipulli'),
(223,12,1,'Curacautín'),
(224,12,1,'Ercilla'),
(225,12,1,'Lonquimay'),
(226,12,1,'Los Sauces'),
(227,12,1,'Lumaco'),
(228,12,1,'Purén'),
(229,12,1,'Renaico'),
(230,12,1,'Traiguén'),
(231,12,1,'Victoria'),
(232,13,1,'Valdivia'),
(233,13,1,'Corral'),
(234,13,1,'Lanco'),
(235,13,1,'Los Lagos'),
(236,13,1,'Máfil'),
(237,13,1,'Mariquina'),
(238,13,1,'Paillaco'),
(239,13,1,'Panguipulli'),
(240,13,1,'La Unión'),
(241,13,1,'Futrono'),
(242,13,1,'Lago Ranco'),
(243,13,1,'Río Bueno'),
(244,14,1,'Puerto Montt'),
(245,14,1,'Calbuco'),
(246,14,1,'Cochamó'),
(247,14,1,'Fresia'),
(248,14,1,'Frutillar'),
(249,14,1,'Los Muermos'),
(250,14,1,'Llanquihue'),
(251,14,1,'Maullín'),
(252,14,1,'Puerto Varas'),
(253,14,1,'Castro'),
(254,14,1,'Ancud'),
(255,14,1,'Chonchi'),
(256,14,1,'Curaco de Vélez'),
(257,14,1,'Dalcahue'),
(258,14,1,'Puqueldón'),
(259,14,1,'Queilén'),
(260,14,1,'Quellón'),
(261,14,1,'Quemchi'),
(262,14,1,'Quinchao'),
(263,14,1,'Osorno'),
(264,14,1,'Puerto Octay'),
(265,14,1,'Purranque'),
(266,14,1,'Puyehue'),
(267,14,1,'Río Negro'),
(268,14,1,'San Juan de la Costa'),
(269,14,1,'San Pablo'),
(270,14,1,'Chaitén'),
(271,14,1,'Futaleufú'),
(272,14,1,'Hualaihué'),
(273,14,1,'Palena'),
(274,15,1,'Coyhaique'),
(275,15,1,'Lago Verde'),
(276,15,1,'Aysén'),
(277,15,1,'Cisnes'),
(278,15,1,'Guaitecas'),
(279,15,1,'Cochrane'),
(280,15,1,'O\'Higgins'),
(281,15,1,'Tortel'),
(282,15,1,'Chile Chico'),
(283,15,1,'Río Ibáñez'),
(284,16,1,'Punta Arenas'),
(285,16,1,'Laguna Blanca'),
(286,16,1,'Río Verde'),
(287,16,1,'San Gregorio'),
(288,16,1,'Cabo de Hornos'),
(289,16,1,'Antártica'),
(290,16,1,'Porvenir'),
(291,16,1,'Primavera'),
(292,16,1,'Timaukel'),
(293,16,1,'Natales'),
(294,16,1,'Torres del Paine'),
(295,7,1,'Santiago'),
(296,7,1,'Cerrillos'),
(297,7,1,'Cerro Navia'),
(298,7,1,'Conchalí'),
(299,7,1,'El Bosque'),
(300,7,1,'Estación Central'),
(301,7,1,'Huechuraba'),
(302,7,1,'Independencia'),
(303,7,1,'La Cisterna'),
(304,7,1,'La Florida'),
(305,7,1,'La Granja'),
(306,7,1,'La Pintana'),
(307,7,1,'La Reina'),
(308,7,1,'Las Condes'),
(309,7,1,'Lo Barnechea'),
(310,7,1,'Lo Espejo'),
(311,7,1,'Lo Prado'),
(312,7,1,'Macul'),
(313,7,1,'Maipú'),
(314,7,1,'Ñuñoa'),
(315,7,1,'Pedro Aguirre Cerda'),
(316,7,1,'Peñalolén'),
(317,7,1,'Providencia'),
(318,7,1,'Pudahuel'),
(319,7,1,'Quilicura'),
(320,7,1,'Quinta Normal'),
(321,7,1,'Recoleta'),
(322,7,1,'Renca'),
(323,7,1,'San Joaquín'),
(324,7,1,'San Miguel'),
(325,7,1,'San Ramón'),
(326,7,1,'Vitacura'),
(327,7,1,'Puente Alto'),
(328,7,1,'Pirque'),
(329,7,1,'San José de Maipo'),
(330,7,1,'Colina'),
(331,7,1,'Lampa'),
(332,7,1,'Til Til'),
(333,7,1,'San Bernardo'),
(334,7,1,'Buin'),
(335,7,1,'Calera de Tango'),
(336,7,1,'Paine'),
(337,7,1,'Melipilla'),
(338,7,1,'Alhué'),
(339,7,1,'Curacaví'),
(340,7,1,'María Pinto'),
(341,7,1,'San Pedro'),
(342,7,1,'Talagante'),
(343,7,1,'El Monte'),
(344,7,1,'Isla de Maipo'),
(345,7,1,'Padre Hurtado'),
(346,7,1,'Peñaflor');
/*!40000 ALTER TABLE `cities` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `comments`
--

DROP TABLE IF EXISTS `comments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `comments` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `incident_id` bigint(20) unsigned NOT NULL,
  `user_id` bigint(20) unsigned NOT NULL,
  `content` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `notes_incident_id_foreign` (`incident_id`),
  KEY `notes_user_id_foreign` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `comments`
--

LOCK TABLES `comments` WRITE;
/*!40000 ALTER TABLE `comments` DISABLE KEYS */;
INSERT INTO `comments` (`id`, `incident_id`, `user_id`, `content`, `created_at`, `updated_at`) VALUES (14,3,2,'123456789','2025-08-19 23:12:05','2025-08-19 23:12:05'),
(15,3,1,'bien','2025-08-19 23:45:01','2025-08-19 23:45:01'),
(16,3,1,'s','2025-08-20 00:02:46','2025-08-20 00:02:46'),
(17,2,1,'ss','2025-08-20 17:08:25','2025-08-20 17:08:25'),
(18,2,1,'sadasd','2025-08-20 17:08:37','2025-08-20 17:08:37'),
(19,8,1,'Muestra de archivos','2025-08-21 05:52:22','2025-08-21 05:52:22'),
(20,9,1,'test','2025-08-26 18:53:14','2025-08-26 18:53:14'),
(21,8,1,'test','2025-09-02 05:52:52','2025-09-02 05:52:52');
/*!40000 ALTER TABLE `comments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `countries`
--

DROP TABLE IF EXISTS `countries`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `countries` (
  `id_country` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  PRIMARY KEY (`id_country`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `countries`
--

LOCK TABLES `countries` WRITE;
/*!40000 ALTER TABLE `countries` DISABLE KEYS */;
INSERT INTO `countries` (`id_country`, `name`) VALUES (1,'Chile');
/*!40000 ALTER TABLE `countries` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `device_tokens`
--

DROP TABLE IF EXISTS `device_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `device_tokens` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned NOT NULL,
  `token` varchar(255) NOT NULL,
  `platform` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `device_tokens_token_unique` (`token`),
  KEY `device_tokens_user_id_foreign` (`user_id`),
  CONSTRAINT `device_tokens_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `device_tokens`
--

LOCK TABLES `device_tokens` WRITE;
/*!40000 ALTER TABLE `device_tokens` DISABLE KEYS */;
INSERT INTO `device_tokens` (`id`, `user_id`, `token`, `platform`, `created_at`, `updated_at`) VALUES (1,1,'dOfGDwjMApSbZDkgDFwbbY:APA91bF5qfTsYTfYY9TS5wxs6QnxEUFkQuZ_Ni3I1eXad8IDBk62fnQZ_QQGYvRx1jRU__xx95jubYQ4LXXpfASM9XMetb4npllVtFo4hS1CEySHFkWRztQ','Win32','2025-09-02 01:59:28','2025-09-02 02:08:27'),
(2,1,'eeXFeAS_QN2uIosjltFhCh:APA91bFwR6xGKdbpnBrbQFSRjJqgWONIXC5yoL16cxGN9bI7qERSZUjR3tvb4grxlt5HIgi2f3zJImUdtYzFnhjftEKkmcBAp933RPKOLQ3bfXOcAXRqtgY','Linux armv81','2025-09-02 05:20:18','2025-09-02 05:20:18'),
(3,1,'dOfGDwjMApSbZDkgDFwbbY:APA91bHdR-el52JSOV4vzy91V8NmDFiGySDdl8nPv2ZUVfk_J5zUD64RLTiQdO3FAYsLldGdRhNBKiXXzVtBeaLhCDybM_ugGrTAgBbNvxA5me6agWbxEHE','Win32','2025-09-02 05:51:31','2025-09-02 05:51:31'),
(4,1,'dOfGDwjMApSbZDkgDFwbbY:APA91bHrhByK8rMEX1Xf1LOWPiZR2kdVYET-7FesyMED0Sord79AM6u1xJbVpEMKCEn5ZTK-t9DK8GzmQF7hdsCI__dyVPCCBwOXsYaYxnIvRQusH3GLisQ','Win32','2025-09-02 05:56:07','2025-09-02 05:56:07'),
(5,1,'dOfGDwjMApSbZDkgDFwbbY:APA91bFgzldHE2l5dV1t4ThGf9yVpIRl9szfI7wG1kEsotTMIH-vEQv0nFnjt_hXlBTJ8quJaIcW7T94FSNfFuidlxibmdNyk9TsqpGIV98ZmqIhZThh5I8','Win32','2025-09-06 05:55:12','2025-09-06 05:55:12'),
(6,3,'fBoxk-BDqk4VFvFgAJto8z:APA91bEtwz7AOJNfo2FUw4HIII-rR_bEii4cvv5CmUcvn4AJB4A1oWK0IRHdVQw9kl4vNWE8WR6J_-UWrmnj4sa50AhwvcsVg0_IiP832ATGeXld6FmLFFM','Win32','2025-09-09 22:53:56','2025-09-09 22:53:56'),
(7,3,'fBoxk-BDqk4VFvFgAJto8z:APA91bF3elt5b5I9sVbDVfyUZjDlGdsx8A490Yp8WpKxYUR4tGMc5KbqwjBPDxT-C6nFqBaookibnZuWuo5b3ows68e8UH7z8rKWRhi-tz5TQ6wFW2xIBnc','Win32','2025-09-10 16:18:05','2025-09-10 16:18:05'),
(8,1,'dOfGDwjMApSbZDkgDFwbbY:APA91bGhoW1KQF-CP5w3L-NOZwz19Xpq6YfTIg_x_XzCi61Wp0Tg0K-jPBQH5BE1dUVxiFD7bGuK3JtKStraOelRgdid5_3TDwTdcmyXit_BL9kHbTRrc7Q','Win32','2025-09-10 16:48:25','2025-09-10 16:48:25'),
(9,1,'ebpfVGoPTR_GBTxrCthECU:APA91bEiQZaAmUOsGNobSR-PLY6Toog2AdC4hA2sasKbWVI_eSmba2vVQ_GTmNoHtQRYwsdMBEGW5cjl8k82dg-q_i0dwU0Hu_0anMfcjGBYu1skEV2YYaY','Win32','2025-09-22 04:20:13','2025-09-22 04:20:13'),
(10,1,'ebpfVGoPTR_GBTxrCthECU:APA91bH6vZiGUaPvacrDTrNKUY2h9xThWRlCH97DK4Az7IVHDpNTylGaWSokPuwNw2BBhbLGjfUSGve-rMuebBF55D8Lzue0YY4oDCsCHBwheIZk4NgWWuY','Win32','2025-10-03 02:47:06','2025-10-03 02:47:06'),
(11,3,'fyCUaeOyxKX7i6FM5E9IWr:APA91bEEvelteV-Uh2P2BNLsscJr3Kca5sf89D8YkheO2i3zJHM2f71JeLfa9cx8abu3MqBlwVE0T4XJ-k8hV5_q2nb3RUcV8eFuUEzgJXXvCXmfiXHpPqw','Win32','2025-10-05 02:41:22','2025-10-05 02:41:22');
/*!40000 ALTER TABLE `device_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `documents`
--

DROP TABLE IF EXISTS `documents`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `documents` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `incident_id` bigint(20) unsigned NOT NULL,
  `comment_id` bigint(20) NOT NULL DEFAULT 0,
  `name` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `path` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `documents_incident_id_foreign` (`incident_id`),
  CONSTRAINT `documents_incident_id_foreign` FOREIGN KEY (`incident_id`) REFERENCES `incidents` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `documents`
--

LOCK TABLES `documents` WRITE;
/*!40000 ALTER TABLE `documents` DISABLE KEYS */;
INSERT INTO `documents` (`id`, `incident_id`, `comment_id`, `name`, `type`, `path`, `created_at`, `updated_at`) VALUES (1,3,14,'05.png','image/png','attachments/7O4kYd82AcybwOTW62aw85vlv8vjz11MVgjm1cQl.png','2025-08-19 23:12:05','2025-08-19 23:12:05'),
(2,2,18,'icon.png','image/png','attachments/QmWD1BLkgeFJlDnEp5imCCRLSu9wDYNXti09hfwV.png','2025-08-20 17:08:37','2025-08-20 17:08:37'),
(3,8,19,'LOGOGAS.png','image/png','attachments/ZjcJ6IZK04h9q6BoPqNRlqI6zAM8FHCtrGgos8XE.png','2025-08-21 05:52:22','2025-08-21 05:52:22');
/*!40000 ALTER TABLE `documents` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `events`
--

DROP TABLE IF EXISTS `events`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `events` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `type` enum('interna','externa','incidente') NOT NULL DEFAULT 'interna',
  `start` datetime NOT NULL,
  `end` datetime DEFAULT NULL,
  `location` varchar(255) DEFAULT NULL,
  `className` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `events`
--

LOCK TABLES `events` WRITE;
/*!40000 ALTER TABLE `events` DISABLE KEYS */;
INSERT INTO `events` (`id`, `title`, `description`, `type`, `start`, `end`, `location`, `className`, `created_at`, `updated_at`) VALUES (1,'Reunión con alcaldía','Planificación anual con el equipo de trabajo','interna','2025-08-21 10:00:00','2025-08-21 12:00:00',NULL,NULL,'2025-08-20 01:45:23','2025-08-20 01:45:23'),
(2,'123','123456','externa','2025-08-20 00:00:00','2025-08-20 00:00:00',NULL,NULL,'2025-08-20 05:54:48','2025-08-20 05:54:48'),
(3,'123','123456','externa','2025-08-20 00:00:00','2025-08-20 00:00:00',NULL,NULL,'2025-08-20 05:54:52','2025-08-20 05:54:52'),
(5,'Reunión SYVTECH','Reunión con los lideres en soluciones tecnologicas','externa','2025-08-22 15:00:00',NULL,'Oficina Alcalde',NULL,'2025-08-21 20:04:36','2025-08-21 20:04:36'),
(6,'Fiesta de Inauguración','Fiesta de Inauguración','externa','2025-10-22 20:00:00','2025-10-22 22:00:00','Sede Nueva',NULL,'2025-10-05 02:44:12','2025-10-05 02:44:12');
/*!40000 ALTER TABLE `events` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp(),
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
-- Table structure for table `incident_categories`
--

DROP TABLE IF EXISTS `incident_categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `incident_categories` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `sla_hours` int(10) unsigned NOT NULL DEFAULT 24,
  `sla_type` enum('respuesta','resolución','escalamiento') NOT NULL DEFAULT 'respuesta',
  `active` tinyint(1) NOT NULL DEFAULT 1,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `incident_categories_name_unique` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `incident_categories`
--

LOCK TABLES `incident_categories` WRITE;
/*!40000 ALTER TABLE `incident_categories` DISABLE KEYS */;
INSERT INTO `incident_categories` (`id`, `name`, `description`, `sla_hours`, `sla_type`, `active`, `deleted_at`, `created_at`, `updated_at`) VALUES (1,'Alumbrado público','Fallas en luminarias, postes o cableado de alumbrado municipal',48,'resolución',1,NULL,'2025-08-26 22:00:09','2025-08-26 22:00:09'),
(2,'Basura domiciliaria','Retrasos o problemas en la recolección de residuos',24,'respuesta',1,NULL,'2025-08-26 22:00:09','2025-08-26 22:00:09'),
(3,'Áreas verdes','Mantenimiento de plazas, parques y jardines públicos',72,'resolución',1,NULL,'2025-08-26 22:00:09','2025-08-26 22:00:09'),
(4,'Ruidos molestos','Denuncias por ruidos fuera de horario permitido',12,'respuesta',1,NULL,'2025-08-26 22:00:09','2025-08-26 22:00:09'),
(5,'Animales abandonados','Reportes de animales en situación de calle o maltrato',36,'resolución',1,NULL,'2025-08-26 22:00:09','2025-08-26 22:00:09'),
(6,'Eventos masivos','Gestión de permisos y coordinación de eventos públicos',96,'escalamiento',1,NULL,'2025-08-26 22:00:09','2025-08-26 22:00:09'),
(7,'Seguridad ciudadana','Incidentes relacionados con vigilancia o patrullaje municipal',8,'respuesta',1,NULL,'2025-08-26 22:00:09','2025-08-26 22:00:09'),
(8,'Obras en vía pública','Intervenciones, cortes o reparaciones en calles y veredas',72,'resolución',1,NULL,'2025-08-26 22:00:09','2025-08-26 22:00:09'),
(9,'Emergencias climáticas','Inundaciones, caída de árboles, o daños por tormentas',6,'escalamiento',1,NULL,'2025-08-26 22:00:09','2025-08-26 22:00:09'),
(10,'Transporte municipal','Problemas con buses, recorridos o paraderos gestionados por la comuna',24,'respuesta',1,NULL,'2025-08-26 22:00:09','2025-08-26 22:00:09');
/*!40000 ALTER TABLE `incident_categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `incidents`
--

DROP TABLE IF EXISTS `incidents`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `incidents` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL,
  `municipality_id` int(11) NOT NULL DEFAULT 0,
  `assigned_id` int(11) DEFAULT NULL,
  `status` enum('open','closed','pending') NOT NULL DEFAULT 'open',
  `priority` enum('low','medium','high') NOT NULL DEFAULT 'medium',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `incidents_user_id_foreign` (`user_id`),
  CONSTRAINT `incidents_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=42 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `incidents`
--

LOCK TABLES `incidents` WRITE;
/*!40000 ALTER TABLE `incidents` DISABLE KEYS */;
INSERT INTO `incidents` (`id`, `user_id`, `title`, `description`, `category_id`, `municipality_id`, `assigned_id`, `status`, `priority`, `created_at`, `updated_at`) VALUES (2,2,'prueba','2345686323++6653233',NULL,0,NULL,'open','medium','2025-08-19 19:14:47','2025-08-19 19:14:47'),
(3,2,'123456','123456789987456321',NULL,0,NULL,'pending','medium','2025-08-19 19:23:45','2025-08-19 19:49:42'),
(4,2,'123456','56897845632585125',NULL,0,NULL,'pending','low','2025-08-20 06:35:31','2025-08-20 06:35:31'),
(5,2,'123456','56897845632585125',NULL,0,NULL,'pending','low','2025-08-20 06:37:12','2025-08-20 06:37:12'),
(6,2,'holaa','prueba 123456789',NULL,0,NULL,'closed','medium','2025-08-20 06:37:40','2025-08-20 06:37:40'),
(7,2,'hola prueba','prueba 9874652315987566325441',NULL,0,1,'open','medium','2025-08-20 06:40:15','2025-09-02 05:02:14'),
(8,1,'Caida de Árbol','Caída de árbol en zona',NULL,0,1,'open','high','2025-08-21 05:51:13','2025-09-02 04:53:18'),
(9,3,'Lluvia e inundaciones','Lluvias e inundaciones en diferentes puntos de la ciudad',NULL,0,NULL,'open','high','2025-08-21 19:45:37','2025-08-21 19:45:37'),
(36,7,'Prueba incidencia con assigned by','prueba',3,0,7,'open','medium','2025-08-28 19:07:46','2025-08-28 19:07:46'),
(37,7,'Pruebaass','PRUEBAS',2,0,7,'open','low','2025-08-28 20:07:42','2025-08-28 20:07:42'),
(38,7,'Prueba muni id','dasda',5,1,1,'open','low','2025-09-02 20:44:13','2025-09-05 06:49:03'),
(39,7,'Plaza en mal estado','**Incidente Reportado: Plaza en Mal Estado**\r\n\r\nLa plaza reportada presentsa problemas de mantenimiento, con vegetación excesiva y residuos en el suelo. Esto afecta la seguridad y el disfrute de los ciudadanos. Se solicita una intervención para restaurar el espacio público a un estado adecuado.',8,1,7,'open','low','2025-09-07 21:37:18','2025-09-07 21:37:18'),
(40,1,'ruidos molestos en las rastras','**Incidente Reportado:** Ruidos molestos en las rastras\r\n\r\n**Descripción del Incidente:**\r\nSe ha reportado ruido molesto proveniente de las rastras del edificio. Se solicita la intervención de los servicios de mantenimiento para abordar el problema lo antes posible.',5,1,7,'open','medium','2025-09-09 22:51:45','2025-09-09 22:51:45'),
(41,3,'CORTE DE LUZ','\"Se informa un corte de luz en la zona norte del municipio, afectando a aproximadamente 500 hogares. La compañía eléctrica está trabajando para reparar el servicio lo antes posible.\"',1,1,1,'open','medium','2025-10-05 02:41:55','2025-10-05 02:41:55');
/*!40000 ALTER TABLE `incidents` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `job_batches`
--

DROP TABLE IF EXISTS `job_batches`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL,
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
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) unsigned NOT NULL,
  `reserved_at` int(10) unsigned DEFAULT NULL,
  `available_at` int(10) unsigned NOT NULL,
  `created_at` int(10) unsigned NOT NULL,
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
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (1,'0001_01_01_000000_create_users_table',1),
(2,'0001_01_01_000001_create_cache_table',1),
(3,'0001_01_01_000002_create_jobs_table',1),
(8,'2025_08_13_000000_create_incidents_table',2),
(9,'2025_08_13_000002_create_notes_table',2),
(10,'2025_08_13_000003_create_documents_table',2),
(11,'2025_08_13_000004_create_slas_table',2),
(12,'2025_08_13_000005_create_business_rules_table',3),
(13,'2025_08_19_194436_create_events_table',1),
(16,'2025_08_26_000000_create_municipalities_table',4),
(17,'2025_08_26_000001_create_areas_table',4),
(18,'2025_08_26_000002_create_positions_table',4),
(19,'2025_08_26_000003_create_user_positions_table',4),
(20,'2025_08_26_000004_create_incident_categories_table',5),
(21,'2025_08_26_000005_create_category_municipality_sla_table',6),
(22,'2025_09_01_175738_create_device_tokens_table',7);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `municipalities`
--

DROP TABLE IF EXISTS `municipalities`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `municipalities` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `logo_url` varchar(255) DEFAULT NULL,
  `city_id` int(11) NOT NULL DEFAULT 0,
  `created_by` bigint(20) unsigned DEFAULT NULL,
  `updated_by` bigint(20) unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `municipalities_created_by_foreign` (`created_by`),
  KEY `municipalities_updated_by_foreign` (`updated_by`),
  CONSTRAINT `municipalities_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  CONSTRAINT `municipalities_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `municipalities`
--

LOCK TABLES `municipalities` WRITE;
/*!40000 ALTER TABLE `municipalities` DISABLE KEYS */;
INSERT INTO `municipalities` (`id`, `name`, `description`, `logo_url`, `city_id`, `created_by`, `updated_by`, `created_at`, `updated_at`, `deleted_at`) VALUES (1,'Municipalidad de Talca','Comuna ubicada en la Región del Maule, capital regional y centro administrativo',NULL,0,NULL,NULL,NULL,NULL,NULL),
(2,'Municipalidad de Constitución','Comuna costera de la Región del Maule, conocida por su actividad forestal y turística',NULL,0,NULL,NULL,NULL,NULL,NULL),
(3,'Municipalidad de Curepto','Comuna rural de la Región del Maule, con fuerte identidad cultural',NULL,0,NULL,NULL,NULL,NULL,NULL),
(4,'Municipalidad de Empedrado','Comuna forestal de la Región del Maule, rodeada de cerros y bosques',NULL,0,NULL,NULL,NULL,NULL,NULL),
(5,'Municipalidad de Maule','Comuna cercana a Talca, con desarrollo agrícola y urbano',NULL,0,NULL,NULL,NULL,NULL,NULL),
(6,'Municipalidad de Pelarco','Comuna agrícola de la Región del Maule, con paisajes rurales',NULL,0,NULL,NULL,NULL,NULL,NULL),
(7,'Municipalidad de Pencahue','Comuna vitivinícola y agrícola de la Región del Maule',NULL,0,NULL,NULL,NULL,NULL,NULL),
(8,'Municipalidad de Río Claro','Comuna rural con tradición agrícola y paisajes naturales',NULL,0,NULL,NULL,NULL,NULL,NULL),
(9,'Municipalidad de San Clemente','Comuna cordillerana de la Región del Maule, con acceso a lagos y volcanes',NULL,0,NULL,NULL,NULL,NULL,NULL),
(10,'Municipalidad de San Rafael','Comuna agrícola ubicada al norte de Talca',NULL,0,NULL,NULL,NULL,NULL,NULL),
(11,'Municipalidad de Cauquenes','Comuna ubicada en la zona sur del Maule, con actividad agrícola y forestal',NULL,0,NULL,NULL,NULL,NULL,NULL),
(12,'Municipalidad de Chanco','Comuna costera con fuerte tradición cultural y gastronómica',NULL,0,NULL,NULL,NULL,NULL,NULL),
(13,'Municipalidad de Pelluhue','Comuna turística del litoral maulino, conocida por sus playas',NULL,0,NULL,NULL,NULL,NULL,NULL),
(14,'Municipalidad de Curicó','Comuna vitivinícola y comercial, centro económico del norte del Maule',NULL,0,NULL,NULL,NULL,NULL,NULL),
(15,'Municipalidad de Hualañé','Comuna agrícola del secano costero de la Región del Maule',NULL,0,NULL,NULL,NULL,NULL,NULL),
(16,'Municipalidad de Licantén','Comuna costera con actividad agrícola y forestal',NULL,0,NULL,NULL,NULL,NULL,NULL),
(17,'Municipalidad de Rauco','Comuna rural cercana a Curicó, con producción frutícola',NULL,0,NULL,NULL,NULL,NULL,NULL),
(18,'Municipalidad de Romeral','Comuna cordillerana con producción agrícola y acceso a la precordillera',NULL,0,NULL,NULL,NULL,NULL,NULL),
(19,'Municipalidad de Sagrada Familia','Comuna agrícola del Valle Central del Maule',NULL,0,NULL,NULL,NULL,NULL,NULL),
(20,'Municipalidad de Teno','Comuna estratégica con conexión vial y actividad agrícola',NULL,0,NULL,NULL,NULL,NULL,NULL),
(21,'Municipalidad de Vichuquén','Comuna turística con lago y patrimonio colonial',NULL,0,NULL,NULL,NULL,NULL,NULL),
(22,'Municipalidad de Linares','Comuna agrícola e industrial, capital provincial del Maule sur',NULL,0,NULL,NULL,NULL,NULL,NULL),
(23,'Municipalidad de Colbún','Comuna cordillerana con embalses y turismo rural',NULL,0,NULL,NULL,NULL,NULL,NULL),
(24,'Municipalidad de Longaví','Comuna agrícola con producción frutícola y ganadera',NULL,0,NULL,NULL,NULL,NULL,NULL),
(25,'Municipalidad de Parral','Comuna con historia republicana y actividad agrícola',NULL,0,NULL,NULL,NULL,NULL,NULL),
(26,'Municipalidad de Retiro','Comuna rural con producción hortofrutícola',NULL,0,NULL,NULL,NULL,NULL,NULL),
(27,'Municipalidad de San Javier','Comuna vitivinícola y cultural del Valle del Loncomilla',NULL,0,NULL,NULL,NULL,NULL,NULL),
(28,'Municipalidad de Villa Alegre','Comuna tradicional con arquitectura colonial y producción de vino',NULL,0,NULL,NULL,NULL,NULL,NULL),
(29,'Municipalidad de Yerbas Buenas','Comuna histórica con fuerte identidad patrimonial',NULL,0,NULL,NULL,NULL,NULL,NULL);
/*!40000 ALTER TABLE `municipalities` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `notes`
--

DROP TABLE IF EXISTS `notes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `notes` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `incident_id` bigint(20) unsigned NOT NULL,
  `user_id` bigint(20) unsigned NOT NULL,
  `content` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `notes_incident_id_foreign` (`incident_id`),
  KEY `notes_user_id_foreign` (`user_id`),
  CONSTRAINT `notes_incident_id_foreign` FOREIGN KEY (`incident_id`) REFERENCES `incidents` (`id`) ON DELETE CASCADE,
  CONSTRAINT `notes_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `notes`
--

LOCK TABLES `notes` WRITE;
/*!40000 ALTER TABLE `notes` DISABLE KEYS */;
/*!40000 ALTER TABLE `notes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_reset_tokens`
--

DROP TABLE IF EXISTS `password_reset_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_reset_tokens`
--

LOCK TABLES `password_reset_tokens` WRITE;
/*!40000 ALTER TABLE `password_reset_tokens` DISABLE KEYS */;
INSERT INTO `password_reset_tokens` (`email`, `token`, `created_at`) VALUES ('daniel.sanchez.f@gmail.com','$2y$12$w.MxbGIvdn7Sy53wF7KE7uzv7ayEOQfvuTxsrbZDAA82kMxX0bNZK','2025-09-05 19:48:21'),
('mariajosevalenzuela41@gmail.com','$2y$12$lDoeBfJERkPivCLqi.f3iOK0zUasn0KvcCk4K2Rvv4kWNMYmEyz92','2025-08-19 06:28:24'),
('pablo.bravo.tejos@gmail.com','$2y$12$/MNYyxutyCE7M01fLZqtXerr2vWQH6M7hRsc0GzTTX54YYI2Oaw0e','2025-10-05 02:35:07');
/*!40000 ALTER TABLE `password_reset_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `positions`
--

DROP TABLE IF EXISTS `positions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `positions` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `level` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `area_id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `positions_area_id_foreign` (`area_id`),
  CONSTRAINT `positions_area_id_foreign` FOREIGN KEY (`area_id`) REFERENCES `areas` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `positions`
--

LOCK TABLES `positions` WRITE;
/*!40000 ALTER TABLE `positions` DISABLE KEYS */;
INSERT INTO `positions` (`id`, `name`, `level`, `description`, `area_id`, `created_at`, `updated_at`, `deleted_at`) VALUES (1,'Administrador Municipal',NULL,'Coordina la gestión interna y supervisa áreas operativas',1,NULL,NULL,NULL),
(2,'Encargado de Recursos Humanos',NULL,'Gestiona contrataciones, capacitaciones y clima laboral',1,NULL,NULL,NULL),
(3,'Secretario Municipal',NULL,'Responsable de actas, decretos y apoyo al concejo',2,NULL,NULL,NULL),
(4,'Encargado de Transparencia',NULL,'Gestiona solicitudes de información y cumplimiento normativo',2,NULL,NULL,NULL),
(5,'Director de Obras Municipales',NULL,'Supervisa urbanismo, construcción y permisos',3,NULL,NULL,NULL),
(6,'Inspector Técnico de Obras',NULL,'Fiscaliza ejecución de proyectos y cumplimiento técnico',3,NULL,NULL,NULL),
(7,'Director de Finanzas',NULL,'Administra presupuesto, pagos y contabilidad',4,NULL,NULL,NULL),
(8,'Encargado de Tesorería',NULL,'Gestiona pagos, ingresos y caja municipal',4,NULL,NULL,NULL),
(9,'Director de Desarrollo Comunitario',NULL,'Promueve participación ciudadana y programas sociales',5,NULL,NULL,NULL),
(10,'Encargado de Organizaciones Sociales',NULL,'Vincula juntas de vecinos y agrupaciones locales',5,NULL,NULL,NULL),
(11,'Director de Educación',NULL,'Administra escuelas municipales y programas escolares',6,NULL,NULL,NULL),
(12,'Encargado de Apoyo Escolar',NULL,'Coordina becas, útiles y reforzamiento educativo',6,NULL,NULL,NULL),
(13,'Director de Salud',NULL,'Gestiona centros de atención primaria y salud pública',7,NULL,NULL,NULL),
(14,'Encargado de Programas Preventivos',NULL,'Coordina campañas de vacunación y prevención',7,NULL,NULL,NULL),
(15,'Encargado de Aseo y Ornato',NULL,'Coordina limpieza urbana y mantención de áreas verdes',8,NULL,NULL,NULL),
(16,'Supervisor de Cuadrillas',NULL,'Organiza equipos de terreno y rutas de limpieza',8,NULL,NULL,NULL),
(17,'Encargado de Seguridad Pública',NULL,'Coordina patrullajes y prevención del delito',9,NULL,NULL,NULL),
(18,'Encargado de Emergencias',NULL,'Gestiona planes de contingencia y respuesta rápida',9,NULL,NULL,NULL),
(19,'Encargado de Tránsito',NULL,'Regula señalización y permisos de circulación',10,NULL,NULL,NULL),
(20,'Inspector de Transporte',NULL,'Fiscaliza transporte público y cumplimiento de normas',10,NULL,NULL,NULL),
(21,'Encargado de Medio Ambiente',NULL,'Promueve reciclaje y protección ambiental',11,NULL,NULL,NULL),
(22,'Encargado de Gestión de Residuos',NULL,'Coordina puntos limpios y educación ambiental',11,NULL,NULL,NULL),
(23,'Encargado de Cultura',NULL,'Organiza actividades culturales y artísticas',12,NULL,NULL,NULL),
(24,'Encargado de Turismo',NULL,'Promueve atractivos locales y patrimonio comunal',12,NULL,NULL,NULL),
(25,'Encargado de Fomento Productivo',NULL,'Apoya emprendedores y comercio local',13,NULL,NULL,NULL),
(26,'Encargado de Ferias Libres',NULL,'Coordina espacios y permisos para ferias',13,NULL,NULL,NULL),
(27,'Encargado de Informática',NULL,'Administra sistemas y soporte técnico',14,NULL,NULL,NULL),
(28,'Encargado de Transformación Digital',NULL,'Impulsa modernización y automatización de procesos',14,NULL,NULL,NULL),
(29,'Asesor Jurídico',NULL,'Brinda asesoría legal y gestiona normativas',15,NULL,NULL,NULL),
(30,'Encargado de Litigios',NULL,'Representa al municipio en causas judiciales',15,NULL,NULL,NULL),
(31,'Encargado de Planificación Estratégica',NULL,'Diseña planes comunales y evalúa proyectos',16,NULL,NULL,NULL),
(32,'Encargado de Proyectos',NULL,'Formula iniciativas y gestiona fondos externos',16,NULL,NULL,NULL);
/*!40000 ALTER TABLE `positions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `regions`
--

DROP TABLE IF EXISTS `regions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `regions` (
  `id_region` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `id_country` int(10) unsigned NOT NULL,
  `name` varchar(50) NOT NULL,
  PRIMARY KEY (`id_region`),
  KEY `FK_regions_countries` (`id_country`),
  CONSTRAINT `FK_regions_countries` FOREIGN KEY (`id_country`) REFERENCES `countries` (`id_country`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `regions`
--

LOCK TABLES `regions` WRITE;
/*!40000 ALTER TABLE `regions` DISABLE KEYS */;
INSERT INTO `regions` (`id_region`, `id_country`, `name`) VALUES (1,1,'Región de Arica y Parinacota'),
(2,1,'Región de Tarapacá'),
(3,1,'Región de Antofagasta'),
(4,1,'Región de Atacama'),
(5,1,'Región de Coquimbo'),
(6,1,'Región de Valparaíso'),
(7,1,'Región Metropolitana de Santiago'),
(8,1,'Región del Libertador General Bernardo O\'Higgins'),
(9,1,'Región del Maule'),
(10,1,'Región de Ñuble'),
(11,1,'Región del Biobío'),
(12,1,'Región de La Araucanía'),
(13,1,'Región de Los Ríos'),
(14,1,'Región de Los Lagos'),
(15,1,'Región Aysén del General Carlos Ibáñez del Campo'),
(16,1,'Región de Magallanes y de la Antártica Chilena');
/*!40000 ALTER TABLE `regions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sessions`
--

DROP TABLE IF EXISTS `sessions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) unsigned DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL,
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
INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES ('74SwQe7UcnlAGw15Hzj9tvlXm0bd2HCLwNoILO9Q',NULL,'34.172.251.85','Mozilla/5.0 (compatible; CMS-Checker/1.0; +https://example.com)','YTozOntzOjY6Il90b2tlbiI7czo0MDoiMUVkcW9wV3k4U2REaUt1Q3IwdmZTMGtYcDRnbWFoTHI4QXJMWGZDaiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjA6Imh0dHBzOi8vd3d3LmNpbXVuLmNsIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==',1759848592),
('7wfIv7ll2f6OU4zH4V3ubiH12heNF8A5grOqE3lt',NULL,'190.114.43.69','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36','YTozOntzOjY6Il90b2tlbiI7czo0MDoickJmUjJpaUlMMlhhbWNMREtUcHh4Y2NHN25NanRZQWdhY0M2UzdrbiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjA6Imh0dHBzOi8vd3d3LmNpbXVuLmNsIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==',1759855918),
('pzhJmzMAI1yfK9Hahyn08N6PuxzxwUSrOYN3Axol',NULL,'136.114.136.150','Mozilla/5.0 (compatible; CMS-Checker/1.0; +https://example.com)','YTozOntzOjY6Il90b2tlbiI7czo0MDoiQjNQM3N5d1Y5WEs2M2x5ZVFLVW00aEFVRVRrTFVBT2JUTkd2R3ZTWCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjA6Imh0dHBzOi8vd3d3LmNpbXVuLmNsIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==',1759847517),
('ZlWurJKadPrkGwLeV02z7yLCsLcmM6mJMd2sCUTU',NULL,'54.175.172.38','Mozilla/5.0 (Windows NT 6.2; rv:20.0) Gecko/20121202 Firefox/20.0','YTozOntzOjY6Il90b2tlbiI7czo0MDoiTkZLSVZXS1NsVGZsM0o5OXpjekNvb2ZjT09aRno0OGR6c2ttVEVwVSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjA6Imh0dHBzOi8vd3d3LmNpbXVuLmNsIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==',1759836114);
/*!40000 ALTER TABLE `sessions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `slas`
--

DROP TABLE IF EXISTS `slas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `slas` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `incident_id` bigint(20) unsigned NOT NULL,
  `name` varchar(255) NOT NULL,
  `response_time` int(11) NOT NULL,
  `resolution_time` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `slas_incident_id_foreign` (`incident_id`),
  CONSTRAINT `slas_incident_id_foreign` FOREIGN KEY (`incident_id`) REFERENCES `incidents` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `slas`
--

LOCK TABLES `slas` WRITE;
/*!40000 ALTER TABLE `slas` DISABLE KEYS */;
/*!40000 ALTER TABLE `slas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_positions`
--

DROP TABLE IF EXISTS `user_positions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `user_positions` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned NOT NULL,
  `position_id` bigint(20) unsigned NOT NULL,
  `municipality_id` bigint(20) unsigned NOT NULL,
  `assigned_at` date DEFAULT NULL,
  `ended_at` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_positions_user_id_foreign` (`user_id`),
  KEY `user_positions_position_id_foreign` (`position_id`),
  KEY `user_positions_municipality_id_foreign` (`municipality_id`),
  CONSTRAINT `user_positions_municipality_id_foreign` FOREIGN KEY (`municipality_id`) REFERENCES `municipalities` (`id`) ON DELETE CASCADE,
  CONSTRAINT `user_positions_position_id_foreign` FOREIGN KEY (`position_id`) REFERENCES `positions` (`id`) ON DELETE CASCADE,
  CONSTRAINT `user_positions_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_positions`
--

LOCK TABLES `user_positions` WRITE;
/*!40000 ALTER TABLE `user_positions` DISABLE KEYS */;
/*!40000 ALTER TABLE `user_positions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `avatar` varchar(255) DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `municipality_id` int(11) NOT NULL DEFAULT 0,
  `area_id` int(11) NOT NULL,
  `position_id` int(11) NOT NULL DEFAULT 0,
  `is_manager` int(11) NOT NULL DEFAULT 0,
  `is_admin` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`id`, `name`, `email`, `avatar`, `email_verified_at`, `password`, `remember_token`, `municipality_id`, `area_id`, `position_id`, `is_manager`, `is_admin`, `created_at`, `updated_at`) VALUES (1,'Cristian Cisternas','darkjonter@gmail.com','avatars/C83PpuvnBRZWCfYOjqE5BFvXx1heb2qm32XCRqLe.jpg',NULL,'$2y$12$lrKmVp6g7vFRcziagclDIOKGFxqZiVDLsohXkEo9dAkTAe92d21lq',NULL,1,0,0,0,0,'2025-08-19 03:30:25','2025-08-27 01:52:50'),
(2,'Maria Jose valenzuela v','mariajosevalenzuela41@gmail.com',NULL,NULL,'$2y$12$5q1r0EBaez3VgcNEPl7XUedsQ4qTgEGsR1csZkPS1bXvTFZMRIqSu','Wx6fzZGfjPNB3BO0pGAKeRMEhKRlD7jqbhFbuMiNpOJs9ciokBJo6BJLP3u7',0,0,0,0,0,'2025-08-19 04:15:57','2025-08-20 07:25:00'),
(3,'Pablo Andrés Bravo Tejos','pablo.bravo.tejos@gmail.com',NULL,NULL,'$2y$12$drdJragBJCazOBcmZCJqP.KpXPf/n/bcb5ewvQ3L0aLf89igsUr5S','Tor67boho6l54M6gXAxuBibnlBtHpk4PUBaoxUss9bVDjjUSxdmWUdoQR4oP',1,0,0,0,0,'2025-08-21 19:27:38','2025-08-21 19:27:38'),
(4,'Alejandro nelmarAl','belmararquitecto@gmail.com',NULL,NULL,'$2y$12$YSE1oETiaqUbplKHdoIYSepXCc/bZUZa3s/0BnAfzfqBDHs34fWJ2',NULL,0,0,0,0,0,'2025-08-21 19:38:25','2025-08-21 19:38:25'),
(5,'daniel sanchez','daniel.sanchez.f@gmail.com',NULL,NULL,'$2y$12$0cGTR.sy.QMCrmfnpNi.ouCrSirLo1.mF.PAuQNK6qWkZvhM28fBy',NULL,0,0,0,0,0,'2025-08-21 19:40:21','2025-08-21 19:40:21'),
(6,'Luis','luisrmedinabarria@gmail.com',NULL,NULL,'$2y$12$ayVHkks3L4lyr9UAcuKWbO2nqJmYQLcdU6qlUQ1Wz5X/vJ9JBo03O',NULL,1,0,0,0,0,'2025-08-21 23:03:00','2025-08-21 23:03:00'),
(7,'Bastian','b@b.com','avatars/cRCJFsIjTysoze0bU05yOyNlqRys1Gd9TVhT1MqB.png',NULL,'$2y$12$1gGewdJjvHrgyKIxl46J8ONIWACc.bL/11jT2qyUJEY44dZfBCr2m','9dnOJf4nifKUHUSDjkpnGtpPcmYhY9iBtzXin6yCyKZpxyUkND8owjUGYXTa',1,0,1,0,0,'2025-08-26 18:50:41','2025-08-27 01:26:38');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping events for database 'cimun_db'
--

--
-- Dumping routines for database 'cimun_db'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*M!100616 SET NOTE_VERBOSITY=@OLD_NOTE_VERBOSITY */;

-- Dump completed on 2025-10-07 14:07:31
