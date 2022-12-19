-- --------------------------------------------------------
-- Hôte :                        127.0.0.1
-- Version du serveur:           5.7.24 - MySQL Community Server (GPL)
-- SE du serveur:                Win64
-- HeidiSQL Version:             10.2.0.5599
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Listage de la structure de la base pour forum
CREATE DATABASE IF NOT EXISTS `forum` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `forum`;

-- Listage de la structure de la table forum. categories
CREATE TABLE IF NOT EXISTS `categories` (
  `id_categorie` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(50) NOT NULL DEFAULT '',
  PRIMARY KEY (`id_categorie`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- Listage des données de la table forum.categories : ~0 rows (environ)
/*!40000 ALTER TABLE `categories` DISABLE KEYS */;
INSERT INTO `categories` (`id_categorie`, `nom`) VALUES
	(1, 'test'),
	(2, 'experimentation');
/*!40000 ALTER TABLE `categories` ENABLE KEYS */;

-- Listage de la structure de la table forum. membres
CREATE TABLE IF NOT EXISTS `membres` (
  `id_membre` int(11) NOT NULL AUTO_INCREMENT,
  `pseudo` varchar(50) NOT NULL DEFAULT '',
  `mail` varchar(50) NOT NULL DEFAULT '',
  `password` varchar(255) NOT NULL DEFAULT '',
  `role` varchar(255) NOT NULL DEFAULT 'membre',
  `dateInscription` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_membre`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- Listage des données de la table forum.membres : ~0 rows (environ)
/*!40000 ALTER TABLE `membres` DISABLE KEYS */;
INSERT INTO `membres` (`id_membre`, `pseudo`, `mail`, `password`, `role`, `dateInscription`) VALUES
	(1, 'cedric', 'cedric@mail.fr', 'ced', 'membre', '2022-12-19 13:51:57');
/*!40000 ALTER TABLE `membres` ENABLE KEYS */;

-- Listage de la structure de la table forum. messages
CREATE TABLE IF NOT EXISTS `messages` (
  `id_messages` int(11) NOT NULL AUTO_INCREMENT,
  `texte` text NOT NULL,
  `dateCreation` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `id_membres` int(11) NOT NULL DEFAULT '0',
  `id_sujets` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_messages`),
  KEY `membreID` (`id_membres`),
  KEY `sujetID` (`id_sujets`),
  CONSTRAINT `membre M` FOREIGN KEY (`id_membres`) REFERENCES `membres` (`id_membre`),
  CONSTRAINT `sujetM` FOREIGN KEY (`id_sujets`) REFERENCES `sujets` (`id_sujets`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- Listage des données de la table forum.messages : ~0 rows (environ)
/*!40000 ALTER TABLE `messages` DISABLE KEYS */;
INSERT INTO `messages` (`id_messages`, `texte`, `dateCreation`, `id_membres`, `id_sujets`) VALUES
	(2, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam fermentum venenatis erat sed eleifend. Nullam maximus nunc vitae metus finibus finibus. In sodales viverra sem sed ornare. Vestibulum vel dignissim nisl, vel luctus tellus. Sed id euismod nulla. Vivamus nec felis sagittis, vehicula ante id, elementum erat. Pellentesque eu dui vel ipsum ultrices tempor et id arcu. Integer dapibus mattis hendrerit. In in congue ex. Duis euismod, purus a interdum hendrerit, ex metus placerat nibh, quis porta turpis nibh sed lectus. In vel turpis tellus. Praesent molestie dictum tempor. Ut eu mauris eleifend, luctus felis vitae, convallis lectus. Maecenas et lacus volutpat, pretium purus convallis, lacinia enim. In hac habitasse platea dictumst. Quisque ultricies justo turpis.', '2022-12-19 13:53:46', 1, 2);
/*!40000 ALTER TABLE `messages` ENABLE KEYS */;

-- Listage de la structure de la table forum. sujets
CREATE TABLE IF NOT EXISTS `sujets` (
  `id_sujets` int(11) NOT NULL AUTO_INCREMENT,
  `titre` varchar(50) NOT NULL DEFAULT '0',
  `verrouillage` tinytext NOT NULL,
  `dateCreation` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `id_membres` int(11) NOT NULL DEFAULT '0',
  `id_categories` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_sujets`),
  KEY `membreID` (`id_membres`),
  KEY `categorieID` (`id_categories`),
  CONSTRAINT `categorieS` FOREIGN KEY (`id_categories`) REFERENCES `categories` (`id_categorie`),
  CONSTRAINT `membreS` FOREIGN KEY (`id_membres`) REFERENCES `membres` (`id_membre`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- Listage des données de la table forum.sujets : ~3 rows (environ)
/*!40000 ALTER TABLE `sujets` DISABLE KEYS */;
INSERT INTO `sujets` (`id_sujets`, `titre`, `verrouillage`, `dateCreation`, `id_membres`, `id_categories`) VALUES
	(2, 'exemple', '0', '2022-12-19 13:52:57', 1, 1),
	(3, 'plus d\'exemple', '0', '2022-12-19 14:00:24', 1, 1),
	(4, 'encore un exemple', '0', '2022-12-19 14:00:47', 1, 1);
/*!40000 ALTER TABLE `sujets` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
