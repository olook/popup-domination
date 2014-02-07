# ************************************************************
# Sequel Pro SQL dump
# Version 4096
#
# http://www.sequelpro.com/
# http://code.google.com/p/sequel-pro/
#
# Host: 127.0.0.1 (MySQL 5.6.14)
# Database: popup
# Generation Time: 2014-02-07 17:38:53 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


DROP DATABASE IF EXISTS `popup`;

CREATE DATABASE popup;

USE popup;

# Dump of table popup_dom_ab
# ------------------------------------------------------------

DROP TABLE IF EXISTS `popup_dom_ab`;

CREATE TABLE `popup_dom_ab` (
  `id` int(25) unsigned NOT NULL AUTO_INCREMENT,
  `campaigns` varchar(250) NOT NULL,
  `absettings` longtext NOT NULL,
  `astats` longtext NOT NULL,
  `rating` varchar(250) NOT NULL,
  `name` varchar(250) NOT NULL,
  `desc` longtext NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;



# Dump of table popup_dom_analytics
# ------------------------------------------------------------

DROP TABLE IF EXISTS `popup_dom_analytics`;

CREATE TABLE `popup_dom_analytics` (
  `id` int(25) unsigned NOT NULL AUTO_INCREMENT,
  `campname` varchar(250) NOT NULL,
  `views` int(25) NOT NULL,
  `conversions` int(25) NOT NULL,
  `rating` int(25) NOT NULL,
  `previousdata` longtext NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

LOCK TABLES `popup_dom_analytics` WRITE;
/*!40000 ALTER TABLE `popup_dom_analytics` DISABLE KEYS */;

INSERT INTO `popup_dom_analytics` (`id`, `campname`, `views`, `conversions`, `rating`, `previousdata`)
VALUES
	(1,'dsaffadsdsf',32,12,0,'');

/*!40000 ALTER TABLE `popup_dom_analytics` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table popup_dom_campaigns
# ------------------------------------------------------------

DROP TABLE IF EXISTS `popup_dom_campaigns`;

CREATE TABLE `popup_dom_campaigns` (
  `id` int(25) unsigned NOT NULL AUTO_INCREMENT,
  `campaign` varchar(250) NOT NULL,
  `data` longtext NOT NULL,
  `desc` longtext NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `campaign` (`campaign`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

LOCK TABLES `popup_dom_campaigns` WRITE;
/*!40000 ALTER TABLE `popup_dom_campaigns` DISABLE KEYS */;

INSERT INTO `popup_dom_campaigns` (`id`, `campaign`, `data`, `desc`)
VALUES
	(1,'dsaffadsdsf','a:6:{s:8:\"template\";a:9:{s:8:\"template\";s:8:\"lightbox\";s:5:\"color\";s:13:\"bright-orange\";s:12:\"button_color\";s:4:\"blue\";s:11:\"field_title\";s:5:\"Teste\";s:17:\"field_form_header\";s:12:\"Teste header\";s:17:\"field_footer_note\";s:8:\"sfaddfas\";s:18:\"field_name_default\";s:4:\"Nome\";s:19:\"field_email_default\";s:5:\"Email\";s:19:\"field_submit_button\";s:12:\"Cadastre-se!\";}s:8:\"schedule\";a:5:{s:11:\"cookie_time\";s:1:\"7\";s:5:\"delay\";s:1:\"0\";s:10:\"unload_msg\";s:57:\"Would you like to signup to the newsletter before you go?\";s:16:\"impression_count\";s:1:\"0\";s:8:\"show_opt\";s:4:\"open\";}s:6:\"images\";a:0:{}s:7:\"toggled\";i:0;s:4:\"list\";a:1:{i:0;s:7:\"Orloque\";}s:7:\"num_cus\";s:1:\"0\";}','dsfaasfdad'),
	(3,'','a:6:{s:8:\"template\";a:3:{s:8:\"template\";s:0:\"\";s:5:\"color\";s:0:\"\";s:12:\"button_color\";s:0:\"\";}s:8:\"schedule\";a:5:{s:11:\"cookie_time\";s:0:\"\";s:5:\"delay\";s:0:\"\";s:10:\"unload_msg\";s:57:\"Would you like to signup to the newsletter before you go?\";s:16:\"impression_count\";s:0:\"\";s:8:\"show_opt\";s:0:\"\";}s:6:\"images\";a:0:{}s:7:\"toggled\";i:0;s:4:\"list\";a:0:{}s:7:\"num_cus\";N;}','');

/*!40000 ALTER TABLE `popup_dom_campaigns` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table popup_dom_options
# ------------------------------------------------------------

DROP TABLE IF EXISTS `popup_dom_options`;

CREATE TABLE `popup_dom_options` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(64) NOT NULL DEFAULT '',
  `value` longtext NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

LOCK TABLES `popup_dom_options` WRITE;
/*!40000 ALTER TABLE `popup_dom_options` DISABLE KEYS */;

INSERT INTO `popup_dom_options` (`id`, `name`, `value`)
VALUES
	(1,'template','lightbox'),
	(2,'color','blue'),
	(3,'cookie_time','7'),
	(4,'delay','0'),
	(5,'button_color','red'),
	(6,'show','a:1:{s:10:\"everywhere\";s:1:\"Y\";}'),
	(7,'last_modified','Tue, 04 Feb 2014 20:06:40'),
	(8,'show_opt','open'),
	(9,'unload_msg','Would you like to signup to the newsletter before you go?'),
	(10,'impression_count','0'),
	(11,'new_window','N'),
	(12,'promote','Y'),
	(13,'install','8yrgbrhc'),
	(14,'admin_email','admin@olook.com.br'),
	(15,'admin_pass','45091dd9bc08d138f297babe35aa2dcb'),
	(16,'enabled','Y'),
	(17,'formhtml',''),
	(18,'facebook_enabled','N'),
	(19,'custom_fields',''),
	(20,'disable_name','Y'),
	(21,'formapi','YToxOntzOjg6InByb3ZpZGVyIjtzOjQ6ImZvcm0iO30='),
	(22,'action','http://olook.com.br/campaign_email_subscribe'),
	(23,'redirecturl',''),
	(24,'redirectcheck','N'),
	(25,'name_box',''),
	(26,'email_box',''),
	(27,'custom1_box',''),
	(28,'custom2_box',''),
	(29,'hidden_fields','');

/*!40000 ALTER TABLE `popup_dom_options` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
