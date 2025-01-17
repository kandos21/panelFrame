-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Versión del servidor:         8.0.30 - MySQL Community Server - GPL
-- SO del servidor:              Win64
-- HeidiSQL Versión:             12.1.0.6537
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Volcando estructura de base de datos para methat
CREATE DATABASE IF NOT EXISTS `methat` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `methat`;

-- Volcando estructura para tabla methat.dispositivo
CREATE TABLE IF NOT EXISTS `dispositivo` (
  `id_dispositivo` int NOT NULL AUTO_INCREMENT,
  `dispositivo_nombre` varchar(40) NOT NULL DEFAULT '0',
  `dispositivo_tipo` varchar(40) NOT NULL DEFAULT '0',
  `ram` varchar(50) DEFAULT NULL,
  `dispositivo_modelo` varchar(50) DEFAULT NULL,
  `dispositivo_fabricante` varchar(50) DEFAULT NULL,
  `dispositivo_serie` varchar(50) DEFAULT NULL,
  `flash` varchar(50) DEFAULT NULL,
  `version_hardware` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_dispositivo`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb3;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla methat.humedad
CREATE TABLE IF NOT EXISTS `humedad` (
  `id_humedad` int NOT NULL AUTO_INCREMENT,
  `humedad` float NOT NULL DEFAULT '0',
  `ids` varchar(50) NOT NULL DEFAULT '0',
  `id_sensor` varchar(50) NOT NULL DEFAULT '0',
  `fecha` datetime DEFAULT NULL,
  `valor_analogico` int DEFAULT NULL,
  PRIMARY KEY (`id_humedad`) USING BTREE,
  KEY `FK_temperatura_sensor` (`id_sensor`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 ROW_FORMAT=DYNAMIC;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla methat.medicion_sensor
CREATE TABLE IF NOT EXISTS `medicion_sensor` (
  `id_medicion` int NOT NULL AUTO_INCREMENT,
  `medicion` varchar(50) NOT NULL DEFAULT '0',
  `id_sensor` int NOT NULL DEFAULT '0',
  `fecha` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id_medicion`),
  KEY `id_sensor` (`id_sensor`),
  CONSTRAINT `FK1_id_sensor` FOREIGN KEY (`id_sensor`) REFERENCES `sensor` (`id_sensor`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb3;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla methat.permiso
CREATE TABLE IF NOT EXISTS `permiso` (
  `idpermiso` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(30) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  PRIMARY KEY (`idpermiso`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb3;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla methat.red_dispositivo
CREATE TABLE IF NOT EXISTS `red_dispositivo` (
  `id_red` int NOT NULL AUTO_INCREMENT,
  `id_dispositivo_slave` int NOT NULL DEFAULT '0',
  `id_dispostivo_master` int NOT NULL DEFAULT '0',
  KEY `id_red` (`id_red`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb3;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla methat.roles
CREATE TABLE IF NOT EXISTS `roles` (
  `id_roles` int NOT NULL AUTO_INCREMENT,
  `nombre_roles` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_roles`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb3;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla methat.sensor
CREATE TABLE IF NOT EXISTS `sensor` (
  `id_sensor` int NOT NULL AUTO_INCREMENT,
  `id_dispositivo` int NOT NULL DEFAULT '0',
  `id_tipo_sensor` int NOT NULL DEFAULT '0',
  `nombre_sensor` varchar(50) NOT NULL DEFAULT '0',
  `serie_sensor` varchar(50) NOT NULL DEFAULT '0',
  `porcentaje_bateria` int DEFAULT NULL,
  `voltaje_bateria` int DEFAULT NULL,
  `fecha_ultima` int DEFAULT NULL,
  PRIMARY KEY (`id_sensor`),
  KEY `id_dispositivo` (`id_dispositivo`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb3;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla methat.temperatura
CREATE TABLE IF NOT EXISTS `temperatura` (
  `id_temperatura` int NOT NULL AUTO_INCREMENT,
  `temperatura` float NOT NULL DEFAULT '0',
  `ids` float NOT NULL DEFAULT '0',
  `id_sensor` varchar(50) NOT NULL DEFAULT '0',
  `fecha` datetime DEFAULT NULL,
  PRIMARY KEY (`id_temperatura`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla methat.tipo_dispositivo
CREATE TABLE IF NOT EXISTS `tipo_dispositivo` (
  `id_tipo_dispositivo` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_tipo_dispositivo`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb3;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla methat.tipo_sensor
CREATE TABLE IF NOT EXISTS `tipo_sensor` (
  `id_tipo_sensor` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) NOT NULL,
  `unidad` varchar(50) NOT NULL,
  `simbolo` varchar(20) NOT NULL,
  PRIMARY KEY (`id_tipo_sensor`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb3;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla methat.ubicacion_dispositivo
CREATE TABLE IF NOT EXISTS `ubicacion_dispositivo` (
  `id_ubicacion` int NOT NULL AUTO_INCREMENT,
  `lat` varbinary(20) NOT NULL DEFAULT '0',
  `long` varbinary(20) NOT NULL DEFAULT '0',
  `direccion` varbinary(20) NOT NULL DEFAULT '0',
  `id_dispositivo` varbinary(20) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_ubicacion`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla methat.usuario
CREATE TABLE IF NOT EXISTS `usuario` (
  `idusuario` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `tipo_documento` varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `num_documento` varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `direccion` varchar(70) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `telefono` varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `email` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `cargo` varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `login` varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `clave` varchar(64) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `imagen` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `condicion` tinyint(1) NOT NULL DEFAULT '1',
  `id_rol` int DEFAULT NULL,
  PRIMARY KEY (`idusuario`),
  UNIQUE KEY `login_UNIQUE` (`login`)
) ENGINE=InnoDB AUTO_INCREMENT=1008 DEFAULT CHARSET=utf8mb3;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla methat.usuario_permiso
CREATE TABLE IF NOT EXISTS `usuario_permiso` (
  `idusuario_permiso` int NOT NULL AUTO_INCREMENT,
  `idusuario` int NOT NULL,
  `idpermiso` int NOT NULL,
  PRIMARY KEY (`idusuario_permiso`),
  KEY `fk_usuario_permiso_permiso_idx` (`idpermiso`),
  KEY `fk_usuario_permiso_usuario_idx` (`idusuario`),
  CONSTRAINT `usuario_permiso_ibfk_1` FOREIGN KEY (`idpermiso`) REFERENCES `permiso` (`idpermiso`),
  CONSTRAINT `usuario_permiso_ibfk_2` FOREIGN KEY (`idusuario`) REFERENCES `usuario` (`idusuario`)
) ENGINE=InnoDB AUTO_INCREMENT=296 DEFAULT CHARSET=utf8mb3;

-- La exportación de datos fue deseleccionada.

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
