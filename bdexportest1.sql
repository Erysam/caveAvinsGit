-- --------------------------------------------------------
-- Hôte:                         127.0.0.1
-- Version du serveur:           8.0.30 - MySQL Community Server - GPL
-- SE du serveur:                Win64
-- HeidiSQL Version:             12.1.0.6537
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Listage de la structure de la base pour caveavins
CREATE DATABASE IF NOT EXISTS `caveavins` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `caveavins`;

-- Listage de la structure de table caveavins. bouteille
CREATE TABLE IF NOT EXISTS `bouteille` (
  `refvins` int NOT NULL,
  `bouteille` int NOT NULL AUTO_INCREMENT,
  `datedepot` date NOT NULL,
  `dateretrait` date DEFAULT NULL,
  PRIMARY KEY (`bouteille`),
  KEY `FK_bouteille_vins` (`refvins`)
) ENGINE=InnoDB AUTO_INCREMENT=174 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Listage des données de la table caveavins.bouteille : ~14 rows (environ)
DELETE FROM `bouteille`;
INSERT INTO `bouteille` (`refvins`, `bouteille`, `datedepot`, `dateretrait`) VALUES
	(9, 3, '2023-05-08', '2023-06-22'),
	(10, 4, '2023-06-01', NULL),
	(6, 68, '2023-06-20', NULL),
	(9, 80, '2023-06-22', NULL),
	(1, 95, '2023-06-22', NULL),
	(1, 96, '2023-06-22', NULL),
	(7, 99, '2023-06-22', NULL),
	(7, 100, '2023-06-22', NULL),
	(36, 168, '2023-06-22', '2023-06-22'),
	(36, 169, '2023-06-22', '2023-06-22'),
	(37, 170, '2023-06-22', NULL),
	(37, 171, '2023-06-22', NULL),
	(36, 172, '2023-06-22', NULL),
	(36, 173, '2023-06-22', NULL);

-- Listage de la structure de table caveavins. vins
CREATE TABLE IF NOT EXISTS `vins` (
  `ref` int NOT NULL AUTO_INCREMENT,
  `nom` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin NOT NULL,
  `type` enum('rouge','blanc','rose') CHARACTER SET utf8mb3 COLLATE utf8mb3_bin NOT NULL,
  `annee` year NOT NULL,
  `region` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin NOT NULL,
  `quantite` int NOT NULL DEFAULT '0',
  `description` varchar(250) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  PRIMARY KEY (`ref`)
) ENGINE=InnoDB AUTO_INCREMENT=38 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Listage des données de la table caveavins.vins : ~7 rows (environ)
DELETE FROM `vins`;
INSERT INTO `vins` (`ref`, `nom`, `type`, `annee`, `region`, `quantite`, `description`) VALUES
	(1, 'PENITENT', 'blanc', '2002', 'LOIRE', 2, 'RICHE'),
	(6, 'rouge sang', 'rouge', '2000', 'RED', 1, 'Oulala'),
	(7, 'blanche colombe', 'blanc', '1974', 'PALE', 2, 'ploplop'),
	(9, 'rouge red2', 'rouge', '1912', 'ROUGESANG', 1, 'CA VA SAIGNER'),
	(10, 'rouge rubis', 'rouge', '2003', 'VAR', 1, 'LOLOL'),
	(36, 'Melusine', 'rose', '2002', 'VAR', 2, 'JJJUUUJLL'),
	(37, 'testdu22', 'rose', '2002', 'POT', 2, 'hduzhaihdoizadoza');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
