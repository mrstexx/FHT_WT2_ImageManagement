
SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

CREATE DATABASE `imagemanagement` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `imagemanagement`;

CREATE TABLE IF NOT EXISTS `t_logindaten` (
  `pk_username` varchar(64) NOT NULL,
  `password` varchar(255) NOT NULL,
  `vorname` varchar(50) NOT NULL,
  `nachname` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `status` int(1) NOT NULL,
  `admin` int(1) NOT NULL,
  PRIMARY KEY (`pk_username`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

CREATE TABLE IF NOT EXISTS `t_geoinfo` (
  `pk_geoinfo_id` int(11) NOT NULL AUTO_INCREMENT,
  `breitengrad` float(10) NOT NULL,
  `längengrad` float(10) NOT NULL,
  PRIMARY KEY (`pk_geoinfo_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

CREATE TABLE IF NOT EXISTS `t_bilder` (
  `pk_bild_id` int(11) NOT NULL AUTO_INCREMENT,
  `fk_pk_username` varchar(64) NOT NULL,
  `fk_pk_geoinfo_id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `geoinfo` varchar(50) NOT NULL,
  `aufnahmedatum` DATE NOT NULL,
  `directory` TEXT NOT NULL,
  `thumbnail_directory` TEXT NOT NULL,
  PRIMARY KEY (`pk_bild_id`),
  FOREIGN KEY (`fk_pk_username`) REFERENCES `t_logindaten` (`pk_username`),
  FOREIGN KEY (`fk_pk_geoinfo_id`) REFERENCES `t_geoinfo` (`pk_geoinfo_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

CREATE TABLE IF NOT EXISTS `t_user_access` (
  `fk_pk_username` varchar(64) NOT NULL,
  `fk_pk_bild_id` int(11) NOT NULL,
  FOREIGN KEY (`fk_pk_username`) REFERENCES t_logindaten (`pk_username`),
  FOREIGN KEY (`fk_pk_bild_id`) REFERENCES t_bilder (`pk_bild_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

CREATE TABLE IF NOT EXISTS `t_tags` (
  `pk_tags` varchar(32) NOT NULL,
   PRIMARY KEY (`pk_tags`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

CREATE TABLE IF NOT EXISTS `t_tags_included` (
  `fk_pk_tags` varchar(32) NOT NULL,
  `fk_pk_bild_id` int(11) NOT NULL,
  FOREIGN KEY (`fk_pk_tags`) REFERENCES t_tags (`pk_tags`),
  FOREIGN KEY (`fk_pk_bild_id`) REFERENCES t_bilder (`pk_bild_id`),
  PRIMARY KEY (`fk_pk_tags`, `fk_pk_bild_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;