# ************************************************************
# Sequel Pro SQL dump
# Version 4541
#
# http://www.sequelpro.com/
# https://github.com/sequelpro/sequelpro
#
# Host: bfjrxdpxrza9qllq.cbetxkdyhwsb.us-east-1.rds.amazonaws.com (mysql 5.5.5-10.1.34-MariaDB)
# Database: iyidsqr6mauiscor
# Generation Time: 2020-02-17 21:53:19 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table call
# ------------------------------------------------------------

DROP TABLE IF EXISTS `call`;

CREATE TABLE `call` (
  `call_id` int(11) NOT NULL AUTO_INCREMENT,
  `company_id` int(11) DEFAULT NULL,
  `customer_id` int(11) DEFAULT NULL,
  `call_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `request` text,
  `resolved` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`call_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

LOCK TABLES `call` WRITE;
/*!40000 ALTER TABLE `call` DISABLE KEYS */;

INSERT INTO `call` (`call_id`, `company_id`, `customer_id`, `call_time`, `request`, `resolved`)
VALUES
	(1,1,3,'2018-01-08 15:06:03','Website redesign. This customer already has a website in place but thinks it\'s outdated. Now he wants a new design to keep them up to date and look modern.',0),
	(2,1,2,'2018-01-08 15:06:03','Brand redesign. Customer no longer likes the logo of his company and wants a new image to be presented to the customers.',0),
	(3,1,2,'2018-01-08 15:06:03','Site Proposal. Customer wants someone to come to his office and look over his site and how to make it more efficient. No need to redesign or write code, just wants to brainstorm.',1),
	(4,1,3,'2018-01-08 15:06:03','Whole new site. Customer has never had a website before. Wants one and heard of us on TV and so is calling to talk to owner.',1),
	(5,1,1,'2018-01-08 15:06:03','Website overhaul. Customer likes look and feel of her site but she wants the backend to be much more efficient. It has been years since the site has been written.',0),
	(6,2,3,'2018-01-08 15:06:03','Shrub Removed. There is a shrub that has been growing in his lawn for months and he has a party coming up this weekend and wants it gone by then.',1),
	(7,2,1,'2018-01-08 15:06:03','Tree Removed. Shrub removed. Customer has had both these in his backyard for far too long and wants them removed from sight.',0),
	(8,2,2,'2018-01-08 15:06:03','Customer has a tree that he wants to get mulched but doesn\'t know whther or not the whole thing has to be cut down or if you can just cut down the branches at the top and mulch those.',0),
	(9,1,2,'2018-01-08 15:06:03','CustomercalledandsaidthatJasoniscrazyforwantinganentrythathasnospacesandisatleast50characterslongandisalmostcompletelyunreadabble.Biteme.',0),
	(10,3,4,'2018-01-08 15:06:03','The hot water stopped working. Customer has no idea what it could be but in the middle of a shower the water became cold and has not been wam ever since.',0);

/*!40000 ALTER TABLE `call` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table company
# ------------------------------------------------------------

DROP TABLE IF EXISTS `company`;

CREATE TABLE `company` (
  `company_id` int(11) NOT NULL AUTO_INCREMENT,
  `company_name` varchar(50) DEFAULT NULL,
  `company_address` varchar(50) DEFAULT NULL,
  `company_city` varchar(30) DEFAULT NULL,
  `company_state` char(2) DEFAULT NULL,
  `company_zip` mediumint(5) DEFAULT NULL,
  `company_phone` varchar(17) DEFAULT NULL,
  PRIMARY KEY (`company_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

LOCK TABLES `company` WRITE;
/*!40000 ALTER TABLE `company` DISABLE KEYS */;

INSERT INTO `company` (`company_id`, `company_name`, `company_address`, `company_city`, `company_state`, `company_zip`, `company_phone`)
VALUES
	(1,'3AM Productions','226 E Oakland Ave','Columbus','OH',43201,'614-123-4567'),
	(2,'ABC Lawn Service','12345 Any Street','Columbus','OH',43230,'614-999-9999'),
	(3,'Tim\'s Plumbing Service','3131 Pipeline Lane','New Albany','OH',43054,'614-333-3232');

/*!40000 ALTER TABLE `company` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table complaint
# ------------------------------------------------------------

DROP TABLE IF EXISTS `complaint`;

CREATE TABLE `complaint` (
  `complaint_id` int(11) NOT NULL AUTO_INCREMENT,
  `company_id` int(11) DEFAULT NULL,
  `customer_id` int(11) DEFAULT NULL,
  `employee_id` int(11) DEFAULT NULL,
  `complaint_type` tinyint(4) DEFAULT NULL,
  `complaint_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `complaint` text,
  PRIMARY KEY (`complaint_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

LOCK TABLES `complaint` WRITE;
/*!40000 ALTER TABLE `complaint` DISABLE KEYS */;

INSERT INTO `complaint` (`complaint_id`, `company_id`, `customer_id`, `employee_id`, `complaint_type`, `complaint_time`, `complaint`)
VALUES
	(1,1,2,1,1,'2005-06-08 23:43:50','Gil is the shizzle my nizzle, fo\' rizzle.'),
	(2,1,3,2,2,'2005-06-08 23:39:23','My only problem with Jason is that he\'s not Gil. '),
	(3,1,3,2,2,'2005-06-08 23:39:51','I\'ve got a fever and the only prescription is more Gil.'),
	(4,2,3,3,1,'2005-06-08 23:41:18','This guy never cut the shrubs!'),
	(5,3,4,5,2,'2005-06-08 23:42:24','Caller states that this employee cursed at her when she didn\'t understand what he was saying.');

/*!40000 ALTER TABLE `complaint` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table customer
# ------------------------------------------------------------

DROP TABLE IF EXISTS `customer`;

CREATE TABLE `customer` (
  `customer_id` int(11) NOT NULL AUTO_INCREMENT,
  `fname` varchar(25) DEFAULT NULL,
  `mname` varchar(25) DEFAULT NULL,
  `lname` varchar(25) DEFAULT NULL,
  `address` varchar(50) DEFAULT NULL,
  `city` varchar(30) DEFAULT NULL,
  `state` char(2) DEFAULT NULL,
  `zip` mediumint(5) DEFAULT NULL,
  `phone` varchar(17) DEFAULT NULL,
  PRIMARY KEY (`customer_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

LOCK TABLES `customer` WRITE;
/*!40000 ALTER TABLE `customer` DISABLE KEYS */;

INSERT INTO `customer` (`customer_id`, `fname`, `mname`, `lname`, `address`, `city`, `state`, `zip`, `phone`)
VALUES
	(1,'John',NULL,'Doe','1199 Fernway Ct.','Columbus','OH',43230,'614-111-1111'),
	(2,'Calvin',NULL,'Broadus','229 Crunkway Dr.','Galena','OH',43210,'614-222-2222'),
	(3,'Carlos','Jesus','Santiago','2248 Barrio Ave.','Johnstown','OH',43233,'614-333-3333'),
	(4,'Phillip','Brandon','Webbingston','5784 Wadsworth Way','Granville','OH',43221,'740-444-4954'),
	(5,'Jason','R','Karns','226 E Oakland Ave','Columbus','OH',43201,'777-777-7777'),
	(6,'Tim','James','Robbins','6554 Circle ave','Cagetown','OH',45579,'614-777-7777'),
	(7,'Emmanuel','K','Kant','455 Chartreuse Ave','Oklahoma City','OK',98856,'965-554-7878'),
	(8,'John','Stuart','Mill','5823 Libertarian Lane','Phoenix','AZ',51236,'000-000-0000'),
	(9,'Jeremy',NULL,'Bentham','5656 Philo Lane','New Albany','OH',43230,'614-445-9898');

/*!40000 ALTER TABLE `customer` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table customer_bio
# ------------------------------------------------------------

DROP TABLE IF EXISTS `customer_bio`;

CREATE TABLE `customer_bio` (
  `customer_id` int(11) NOT NULL DEFAULT '0',
  `nickname` varchar(25) DEFAULT NULL,
  `birthday` date DEFAULT NULL,
  `hobbies` text,
  `misc` text,
  PRIMARY KEY (`customer_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

LOCK TABLES `customer_bio` WRITE;
/*!40000 ALTER TABLE `customer_bio` DISABLE KEYS */;

INSERT INTO `customer_bio` (`customer_id`, `nickname`, `birthday`, `hobbies`, `misc`)
VALUES
	(1,'Johnny','1972-08-14','Watching NFL football games','Johnny loves the Steelers and hates the Browns. He prefers personal assurance of quality and is not really impressed by figures and statistics.'),
	(2,'SnoopDogg','1971-10-20',NULL,'Calvin uses language that is sometimes innappropriate and some words he uses he made up himself.'),
	(3,'Carlito','1961-03-14','Carlos watches soccer on tv all the time.','Carlos prefers speaking in Spanish if it\'s ever available.'),
	(4,'Phil','1981-05-11','Avid reader of the Wall Street Journal.',NULL),
	(5,'Bobby',NULL,'Computers and web programming with php and mysql','Likes to chat.'),
	(6,'TR',NULL,'Listening to music all the time','Huge rock fan. Favorite movie is \"School of Rock\".'),
	(7,'Dr. Kant',NULL,'Coming up with philisophical theories.','Be careful with words like \"should\" and \"ought\".'),
	(8,'Stuart','1999-04-07','Coming up with great book dealing with government\'s role.','Avid Reader.'),
	(9,'Benthy',NULL,'Philosophy','This guy has written quite a few books on philosophy. He enjoys when references are made to his books so it would be good to recognize that we know who he is.');

/*!40000 ALTER TABLE `customer_bio` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table employee
# ------------------------------------------------------------

DROP TABLE IF EXISTS `employee`;

CREATE TABLE `employee` (
  `employee_id` int(11) NOT NULL AUTO_INCREMENT,
  `company_id` int(11) DEFAULT NULL,
  `employee_fname` varchar(25) DEFAULT NULL,
  `employee_mname` varchar(25) DEFAULT NULL,
  `employee_lname` varchar(25) DEFAULT NULL,
  PRIMARY KEY (`employee_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

LOCK TABLES `employee` WRITE;
/*!40000 ALTER TABLE `employee` DISABLE KEYS */;

INSERT INTO `employee` (`employee_id`, `company_id`, `employee_fname`, `employee_mname`, `employee_lname`)
VALUES
	(1,1,'Gilbert','Joseph','Velasquez'),
	(2,1,'Jason','Robert','Karns'),
	(3,2,'Sam',NULL,'Johnansen'),
	(4,3,'Tim',NULL,'Smith'),
	(5,3,'Mark','Adam','Ruffinger'),
	(6,3,'Christopher','Thomas','Moneymaker');

/*!40000 ALTER TABLE `employee` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table flow
# ------------------------------------------------------------

DROP TABLE IF EXISTS `flow`;

CREATE TABLE `flow` (
  `call_id` int(11) NOT NULL DEFAULT '0',
  `employee_id` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`call_id`,`employee_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

LOCK TABLES `flow` WRITE;
/*!40000 ALTER TABLE `flow` DISABLE KEYS */;

INSERT INTO `flow` (`call_id`, `employee_id`)
VALUES
	(1,1),
	(2,2),
	(3,2),
	(4,1),
	(4,2),
	(5,1),
	(6,3),
	(7,3),
	(8,3),
	(9,2),
	(10,4),
	(10,6);

/*!40000 ALTER TABLE `flow` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table information
# ------------------------------------------------------------

DROP TABLE IF EXISTS `information`;

CREATE TABLE `information` (
  `information_id` int(11) NOT NULL AUTO_INCREMENT,
  `company_id` int(11) DEFAULT NULL,
  `customer_id` int(11) DEFAULT NULL,
  `information_type` tinyint(4) DEFAULT NULL,
  `information_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `information` text,
  PRIMARY KEY (`information_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

LOCK TABLES `information` WRITE;
/*!40000 ALTER TABLE `information` DISABLE KEYS */;

INSERT INTO `information` (`information_id`, `company_id`, `customer_id`, `information_type`, `information_time`, `information`)
VALUES
	(1,1,3,1,'2005-06-08 23:50:51','How you make  3AM be such a muy bueno company?'),
	(2,2,2,1,'2005-06-08 23:51:39','How get them little shrizzubs to grizzow?'),
	(3,3,4,1,'2005-06-08 23:52:35','Customer wanted to know what year the compnay was founded. He wants an experienced company.');

/*!40000 ALTER TABLE `information` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
