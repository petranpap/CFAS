-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               5.5.60-MariaDB - MariaDB Server
-- Server OS:                    Linux
-- HeidiSQL Version:             9.5.0.5196
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Dumping database structure for encase
CREATE DATABASE IF NOT EXISTS `encase` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `encase`;

-- Dumping structure for table encase.backend_visibility
CREATE TABLE IF NOT EXISTS `backend_visibility` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `child_id` int(11) NOT NULL DEFAULT '1',
  `parent_id` int(1) NOT NULL DEFAULT '1',
  `backend_visibility_level` int(1) NOT NULL DEFAULT '1',
  `child_aproved` int(1) NOT NULL DEFAULT '0',
  `checkbox` varchar(300) DEFAULT '1',
  `anonymously` int(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

-- Data exporting was unselected.
-- Dumping structure for table encase.childs
CREATE TABLE IF NOT EXISTS `childs` (
  `child_id` int(11) NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) NOT NULL DEFAULT '0',
  `child_first_name` varchar(255) NOT NULL,
  `child_last_name` varchar(255) NOT NULL,
  `child_email` varchar(255) NOT NULL,
  `child_fb_url` varchar(255) NOT NULL,
  `child_twitter` varchar(255) NOT NULL,
  PRIMARY KEY (`child_id`),
  KEY `FK_childs_parent` (`parent_id`),
  CONSTRAINT `FK_childs_parent` FOREIGN KEY (`parent_id`) REFERENCES `parent` (`parent_id`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8;

-- Data exporting was unselected.
-- Dumping structure for table encase.fb_wall
CREATE TABLE IF NOT EXISTS `fb_wall` (
  `fb_wall_id` int(11) NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) DEFAULT NULL,
  `child_id` int(11) DEFAULT NULL,
  `fb_wall_text` longtext,
  PRIMARY KEY (`fb_wall_id`),
  KEY `fb_wall_childs_FK` (`child_id`),
  KEY `fb_wall_parent_FK` (`parent_id`),
  CONSTRAINT `fb_wall_childs_FK` FOREIGN KEY (`child_id`) REFERENCES `childs` (`child_id`),
  CONSTRAINT `fb_wall_parent_FK` FOREIGN KEY (`parent_id`) REFERENCES `parent` (`parent_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- Data exporting was unselected.
-- Dumping structure for table encase.id
CREATE TABLE IF NOT EXISTS `id` (
  `id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Data exporting was unselected.
-- Dumping structure for table encase.notifications
CREATE TABLE IF NOT EXISTS `notifications` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `text` longtext,
  `href` text,
  `read` tinyint(4) NOT NULL DEFAULT '0',
  `child_id` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `FK_notifications_childs` (`child_id`),
  CONSTRAINT `FK_notifications_childs` FOREIGN KEY (`child_id`) REFERENCES `childs` (`child_id`)
) ENGINE=InnoDB AUTO_INCREMENT=1688 DEFAULT CHARSET=utf8;

-- Data exporting was unselected.
-- Dumping structure for table encase.parent
CREATE TABLE IF NOT EXISTS `parent` (
  `parent_id` int(11) NOT NULL AUTO_INCREMENT,
  `parent_first_name` varchar(255) DEFAULT NULL,
  `parent_last_name` varchar(255) DEFAULT NULL,
  `pass` varchar(100) NOT NULL,
  `parent_user_name` varchar(100) NOT NULL,
  `parent_email` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`parent_id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8;

-- Data exporting was unselected.
-- Dumping structure for table encase.parental_visibility
CREATE TABLE IF NOT EXISTS `parental_visibility` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `child_id` int(11) NOT NULL DEFAULT '1',
  `parent_id` int(1) NOT NULL DEFAULT '1',
  `parental_visibility_level` int(1) NOT NULL DEFAULT '1',
  `child_aproved` int(1) NOT NULL DEFAULT '0',
  `checkbox` varchar(300) DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8;

-- Data exporting was unselected.
-- Dumping structure for table encase.security_visibility
CREATE TABLE IF NOT EXISTS `security_visibility` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `child_id` int(11) NOT NULL DEFAULT '1',
  `parent_id` int(1) NOT NULL DEFAULT '1',
  `security_visibility_level` int(1) NOT NULL DEFAULT '1',
  `child_aproved` int(1) NOT NULL DEFAULT '0',
  `checkbox` varchar(300) DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

-- Data exporting was unselected.
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
