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


-- Listage de la structure de la base pour forum
CREATE DATABASE IF NOT EXISTS `forum` /*!40100 DEFAULT CHARACTER SET latin1 */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `forum`;

-- Listage de la structure de table forum. categorie
CREATE TABLE IF NOT EXISTS `categorie` (
  `id_categorie` int NOT NULL AUTO_INCREMENT,
  `nom` varchar(50) NOT NULL DEFAULT '',
  PRIMARY KEY (`id_categorie`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

-- Listage des données de la table forum.categorie : ~3 rows (environ)
INSERT INTO `categorie` (`id_categorie`, `nom`) VALUES
	(1, 'test'),
	(2, 'experimentation'),
	(3, 'verif');

-- Listage de la structure de table forum. membre
CREATE TABLE IF NOT EXISTS `membre` (
  `id_membre` int NOT NULL AUTO_INCREMENT,
  `pseudo` varchar(50) NOT NULL DEFAULT '',
  `email` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT '',
  `password` varchar(255) NOT NULL DEFAULT '',
  `role` varchar(255) NOT NULL DEFAULT 'membre',
  `dateInscription` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `verouiller` tinyint NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_membre`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;

-- Listage des données de la table forum.membre : ~4 rows (environ)
INSERT INTO `membre` (`id_membre`, `pseudo`, `email`, `password`, `role`, `dateInscription`, `verouiller`) VALUES
	(1, 'cedric', 'cedric@mail.fr', 'ced', 'ADMIN', '2022-12-19 12:51:57', 0),
	(2, 'gilles', 'gilles@mail.fr', 'gil', 'MEMBRE', '2022-12-21 07:50:26', 0),
	(9, 'cedriic', 'cedriic@mail.fr', '$2y$10$mXf0ksKL4mmzW5rm7TOof.Bno70qPjgclnLk2xbUFNwlrdT8RRMmO', 'MEMBRE', '2022-12-21 15:43:22', 0),
	(15, 'machin', 'machin@mail.fr', '$2y$10$fUveDVxHToFJyYdWLBYyKep9wvsd.VjhnwKP.G0YQ3VfIV6y249uW', 'MEMBRE', '2023-01-04 12:41:37', 0);

-- Listage de la structure de table forum. message
CREATE TABLE IF NOT EXISTS `message` (
  `id_message` int NOT NULL AUTO_INCREMENT,
  `texte` text NOT NULL,
  `dateCreation` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `membre_id` int NOT NULL DEFAULT '0',
  `sujet_id` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_message`) USING BTREE,
  KEY `membreID` (`membre_id`) USING BTREE,
  KEY `sujetID` (`sujet_id`) USING BTREE,
  CONSTRAINT `membre M` FOREIGN KEY (`membre_id`) REFERENCES `membre` (`id_membre`),
  CONSTRAINT `sujetM` FOREIGN KEY (`sujet_id`) REFERENCES `sujet` (`id_sujet`)
) ENGINE=InnoDB AUTO_INCREMENT=54 DEFAULT CHARSET=latin1;

-- Listage des données de la table forum.message : ~11 rows (environ)
INSERT INTO `message` (`id_message`, `texte`, `dateCreation`, `membre_id`, `sujet_id`) VALUES
	(2, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam fermentum venenatis erat sed eleifend. Nullam maximus nunc vitae metus finibus finibus. In sodales viverra sem sed ornare. Vestibulum vel dignissim nisl, vel luctus tellus. Sed id euismod nulla. Vivamus nec felis sagittis, vehicula ante id, elementum erat. Pellentesque eu dui vel ipsum ultrices tempor et id arcu. Integer dapibus mattis hendrerit. In in congue ex. Duis euismod, purus a interdum hendrerit, ex metus placerat nibh, quis porta turpis nibh sed lectus. In vel turpis tellus. Praesent molestie dictum tempor. Ut eu mauris eleifend, luctus felis vitae, convallis lectus. Maecenas et lacus volutpat, pretium purus convallis, lacinia enim. In hac habitasse platea dictumst. Quisque ultricies justo turpis.', '2022-12-19 12:53:46', 1, 2),
	(3, 'Praesent ut mauris sodales sapien laoreet efficitur eget in purus. Quisque sollicitudin pharetra finibus. Maecenas molestie, nisi aliquam placerat convallis, erat enim consectetur magna, et tristique lectus diam at eros. Nulla quis tellus vestibulum, porttitor urna a, elementum ante. Maecenas cursus faucibus nulla ut elementum. Fusce cursus, magna nec fermentum consequat, nulla urna pulvinar tellus, et efficitur libero elit aliquet leo. Duis eu risus sem. Curabitur vel varius tellus, posuere fringilla turpis. Suspendisse sodales ut ex aliquam pharetra.', '2022-12-21 07:48:06', 1, 3),
	(4, 'Morbi sit amet turpis commodo, gravida lectus ac, vestibulum nisl. Quisque dapibus, orci nec placerat fermentum, enim magna pharetra sem, ac egestas felis ante non orci. Duis laoreet, erat nec viverra elementum, sapien metus hendrerit arcu, a tincidunt lectus dui non tellus. Fusce ac pretium mi. Integer efficitur vitae enim at interdum. Sed non neque vitae lorem consequat volutpat a eget elit. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Etiam nec erat nec mi ultrices congue scelerisque et arcu. Sed sit amet augue condimentum, venenatis leo a, accumsan mauris. ', '2022-12-21 07:48:27', 1, 4),
	(5, 'Sed tristique gravida massa, in maximus magna ornare at. Sed tristique sodales nisi, eget feugiat nisl lacinia at. Phasellus aliquam felis eget pellentesque iaculis. Suspendisse tempus magna sapien, sit amet vulputate magna tristique quis. Vestibulum vitae diam eu metus sollicitudin aliquam vel id augue. Ut sodales pretium ligula, a vulputate ligula gravida eu. Nam sed lacus sed urna volutpat tincidunt quis eu est. Morbi gravida porta tortor. Aenean pharetra imperdiet diam, id sagittis odio aliquet ut. Integer sed laoreet felis. Nullam eget odio dignissim, maximus mauris ac, hendrerit urna. Mauris bibendum dui ac ornare laoreet. ', '2022-12-21 07:48:47', 1, 5),
	(7, 'Duis vel est vitae massa facilisis accumsan. Aliquam vitae eros dui. Nullam tincidunt sit amet justo in finibus. Nulla sed nibh egestas risus convallis fermentum in quis magna. Quisque eget ultrices nibh, tincidunt ultricies nisi. Integer ornare eget dui porta ornare. Vestibulum a justo at arcu tempor porttitor. Nam auctor ultrices nulla ut dapibus. Phasellus erat tortor, cursus a leo eu, rhoncus vehicula quam. Etiam eget rhoncus augue. Nullam a metus mi. Fusce vitae pretium mi, eu rutrum velit.', '2022-12-21 07:49:55', 1, 2),
	(8, 'Phasellus sapien ligula, dictum ut quam at, viverra lacinia neque. Fusce semper, felis sed tristique sodales, lectus odio volutpat nisl, ut pharetra nibh dolor sed enim. Quisque eu accumsan lectus, ac eleifend tortor. Donec efficitur euismod gravida. Nullam hendrerit leo arcu, vitae ultricies mauris commodo quis. Maecenas feugiat mauris lectus, a pellentesque quam fermentum tristique. Aliquam sit amet massa urna. Maecenas ultrices at urna quis vulputate. Curabitur tortor dui, fringilla quis lectus id, pharetra venenatis dui. ', '2022-12-21 07:51:51', 2, 3),
	(12, 'Nulla congue nec odio et rutrum. Donec eleifend, massa id mollis vehicula, diam ligula suscipit arcu, a eleifend arcu mi a tellus. In ac velit et sapien semper accumsan eget ac ante. In pharetra non nibh et lobortis. Vestibulum metus purus, interdum at finibus et, maximus vel est. Pellentesque rutrum nunc a euismod imperdiet. Vivamus a ligula hendrerit leo aliquam ullamcorper. Vivamus scelerisque elit quis erat venenatis consequat. Fusce a arcu lectus. Aliquam id mauris vulputate, ornare tortor sed, ornare lorem. Phasellus elementum fermentum laoreet. Aenean facilisis rutrum urna, ut rutrum enim viverra sit amet. ', '2022-12-21 07:52:47', 2, 5),
	(32, 'lkjjdnsggosbdg', '2023-01-05 05:54:46', 1, 20),
	(36, 'encore un', '2023-01-05 07:02:40', 2, 4),
	(37, '<p>rfhdshjdthb</p>', '2023-01-13 16:39:48', 1, 20),
	(41, '<pre class="">    __!__\r\n_____(_)_____\r\n   !  !  !</pre>', '2023-01-16 08:13:52', 1, 2),
	(42, '&#60;p&#62;tyruyu&#60;/p&#62;&#60;p&#62;iuiuiuooi&#60;/p&#62;&#60;p&#62;grhytht&#60;/p&#62;&#60;p&#62;tgrfgsd&#60;/p&#62;', '2023-01-16 08:34:11', 1, 22),
	(45, '<p>retzer</p>\r\n<p>ertzet</p>\r\n<p>&nbsp;</p>\r\n<p>etrt</p>', '2023-01-16 08:38:16', 1, 22),
	(46, '<p>tyhrtu</p>\r\n<p>ytyuyu</p>\r\n<p>&nbsp;</p>\r\n<p>truytu</p>', '2023-01-16 08:41:00', 1, 22),
	(47, '<p>fzefe</p>\r\n<p>grg</p>\r\n<p>&nbsp;</p>\r\n<p>csdc</p>\r\n<p>xccx</p>\r\n<p>c</p>\r\n<p>xc</p>', '2023-01-16 08:58:55', 1, 22),
	(51, '<pre class="">       __|__\r\n--------(_)--------\r\n  O  O       O  O</pre>', '2023-01-16 12:42:50', 1, 20),
	(52, '<p>&lt;script&gt;&lt;/script&gt;</p>', '2023-01-16 13:41:08', 1, 20),
	(53, '<p>&lt;h1&gt;HELLO&lt;/h1&gt;</p>', '2023-01-16 13:41:36', 1, 20);

-- Listage de la structure de table forum. sujet
CREATE TABLE IF NOT EXISTS `sujet` (
  `id_sujet` int NOT NULL AUTO_INCREMENT,
  `titre` varchar(50) NOT NULL DEFAULT '0',
  `verrouillage` tinytext CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `dateCreation` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `membre_id` int NOT NULL DEFAULT '0',
  `categorie_id` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_sujet`) USING BTREE,
  KEY `categorieID` (`categorie_id`) USING BTREE,
  KEY `membreID` (`membre_id`) USING BTREE,
  CONSTRAINT `categorieS` FOREIGN KEY (`categorie_id`) REFERENCES `categorie` (`id_categorie`),
  CONSTRAINT `membreS` FOREIGN KEY (`membre_id`) REFERENCES `membre` (`id_membre`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=latin1;

-- Listage des données de la table forum.sujet : ~5 rows (environ)
INSERT INTO `sujet` (`id_sujet`, `titre`, `verrouillage`, `dateCreation`, `membre_id`, `categorie_id`) VALUES
	(2, 'exemple', '0', '2022-12-19 12:52:57', 1, 1),
	(3, 'plus d\'exemple', '0', '2022-12-19 13:00:24', 1, 1),
	(4, 'encore un exemple', '0', '2022-12-19 13:00:47', 1, 1),
	(5, 'toujours un exemple', '0', '2022-12-20 08:33:34', 1, 2),
	(20, 'plus d&#39;exemples', '0', '2023-01-05 05:54:46', 1, 2),
	(22, 'exemple formatté', '0', '2023-01-16 08:34:11', 1, 2);

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
