/*
SQLyog Ultimate v9.63 
MySQL - 5.5.24-log : Database - zend2admin
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`zend2admin` /*!40100 DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci */;

USE `zend2admin`;

/*Table structure for table `contact` */

DROP TABLE IF EXISTS `contact`;

CREATE TABLE `contact` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `created` int(11) NOT NULL,
  `updated` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `priority` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

/*Data for the table `contact` */

insert  into `contact`(`id`,`email`,`content`,`created`,`updated`,`status`,`priority`) values (1,'chicuongit913@yahoo.com','ten ten ten',1362465484,1362465484,1,2),(2,'hungxd@gmail.com','ten ten ten\r\n',1362465484,1362465484,1,1),(3,'an_naphamkt@gmail.com','ten ten ten\r\n			',1362465484,1362465484,0,4);

/*Table structure for table `log` */

DROP TABLE IF EXISTS `log`;

CREATE TABLE `log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `action` varchar(100) NOT NULL,
  `updated` int(11) DEFAULT '0',
  `times` int(11) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

/*Data for the table `log` */

insert  into `log`(`id`,`action`,`updated`,`times`) values (1,'login',1362023221,3);

/*Table structure for table `manager` */

DROP TABLE IF EXISTS `manager`;

CREATE TABLE `manager` (
  `username` varchar(200) NOT NULL,
  `password` varchar(200) NOT NULL,
  PRIMARY KEY (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `manager` */

insert  into `manager`(`username`,`password`) values ('admin','trung');

/*Table structure for table `mediafile` */

DROP TABLE IF EXISTS `mediafile`;

CREATE TABLE `mediafile` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `folderid` int(11) DEFAULT NULL,
  `name` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  `type` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `folderid` (`folderid`),
  CONSTRAINT `mediafile_ibfk_1` FOREIGN KEY (`folderid`) REFERENCES `mediafolder` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=64 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `mediafile` */

insert  into `mediafile`(`id`,`folderid`,`name`,`type`) values (1,1,'file_img_01.jpg','test'),(2,1,'file_img_02.jpg','test'),(3,1,'file_img_03.jpg','test'),(4,1,'file_img_04.jpg','test'),(5,1,'file_img_05.jpg','test'),(6,1,'file_img_06.jpg','test'),(7,3,'file_img_01.jpg','test'),(8,3,'file_img_02.jpg','test'),(9,3,'file_img_03.jpg','test'),(10,3,'file_img_04.jpg','test'),(11,3,'file_img_05.jpg','test'),(12,3,'file_img_06.jpg','test'),(13,4,'file_img_01.jpg','test'),(14,4,'file_img_02.jpg','test'),(15,4,'file_img_03.jpg','test'),(16,4,'file_img_04.jpg','test'),(17,4,'file_img_05.jpg','test'),(18,4,'file_img_06.jpg','test'),(19,5,'file_img_01.jpg','test'),(20,5,'file_img_02.jpg','test'),(21,5,'file_img_03.jpg','test'),(22,5,'file_img_04.jpg','test'),(23,5,'file_img_05.jpg','test'),(24,5,'file_img_06.jpg','test'),(25,5,'file_img_07.jpg','test'),(26,6,'file_img_02.jpg',NULL),(27,6,'file_img_03.jpg',NULL),(28,6,'file_img_04.jpg',NULL),(29,6,'file_img_05.jpg',NULL),(30,6,'file_img_06.jpg',NULL),(31,7,'file_img_01.jpg',NULL),(32,7,'file_img_02.jpg',NULL),(33,7,'file_img_03.jpg',NULL),(34,7,'file_img_04.jpg',NULL),(35,7,'file_img_05.jpg',NULL),(36,7,'file_img_06.jpg',NULL),(37,5,'file_img_08.jpg','test'),(38,5,'file_img_09.jpg','test'),(39,5,'file_img_10.jpg','test'),(40,5,'file_img_11.jpg','test'),(41,5,'file_img_12.jpg','test'),(42,5,'file_img_13.jpg','test'),(43,5,'file_img_14.jpg','test'),(44,5,'file_img_15.jpg','test'),(45,5,'file_img_16.jpg','test'),(47,5,'file_img_17.jpg','test'),(48,5,'file_img_18.jpg','test'),(49,5,'file_img_19.jpg','test'),(50,5,'file_img_20.jpg','test'),(51,5,'file_img_21.jpg','test'),(52,5,'file_img_22.jpg','test'),(53,5,'file_img_23.jpg','test'),(54,5,'file_img_24.jpg','test'),(55,5,'file_img_25.jpg','test'),(56,5,'file_img_26.jpg','test'),(57,5,'file_img_27.jpg','test'),(58,5,'file_img_28.jpg','test'),(59,5,'file_img_29.jpg','test'),(60,5,'file_img_30.jpg','test'),(61,5,'file_img_31.jpg','test'),(62,5,'file_img_32.jpg','test');

/*Table structure for table `mediafolder` */

DROP TABLE IF EXISTS `mediafolder`;

CREATE TABLE `mediafolder` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  `parent` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `mediafolder` */

insert  into `mediafolder`(`id`,`name`,`parent`) values (1,'images',0),(2,'videos',0),(3,'images/img_1',1),(4,'images/img_2',1),(5,'images/img_3',1),(6,'images/img_1/img_1_1',3),(7,'images/img_1/img_1_2',3),(8,'videos/video_1',2),(9,'videos/video_2',2),(10,'videos/video_2/video_2_1',9),(11,'videos/video_2/video_2_2',9),(12,'videos/video_2/video_2_3',9);

/*Table structure for table `news` */

DROP TABLE IF EXISTS `news`;

CREATE TABLE `news` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `created` int(11) NOT NULL,
  `updated` int(11) DEFAULT NULL,
  `createdby` int(11) DEFAULT NULL,
  `updatedby` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `priority` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `createdby` (`createdby`),
  KEY `updatedby` (`updatedby`),
  CONSTRAINT `news_ibfk_1` FOREIGN KEY (`createdby`) REFERENCES `user` (`id`),
  CONSTRAINT `news_ibfk_2` FOREIGN KEY (`updatedby`) REFERENCES `user` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;

/*Data for the table `news` */

insert  into `news`(`id`,`title`,`content`,`created`,`updated`,`createdby`,`updatedby`,`status`,`priority`) values (1,'HTML 5 & CSS 5','<p>ten ten ten</p>',1356877025,1363766496,1,1,1,2),(2,'PHP 5.1 & WAMP 2.2','ten ten ten			',1356660508,1356877025,2,3,1,1),(3,'Zend Studio 10','ten ten ten			',1356660508,1356877025,1,2,0,2),(4,'Photoshop Cs5','<p>ten ten ten</p>',1362465484,1362989782,1,1,1,1),(5,'SQL yog 9.63','ten ten ten',1362465484,1362465484,3,1,1,1),(6,'Firefox 27 Ver','ten ten ten',1362465484,1362465484,2,1,1,1),(7,'Chrome 16 Google','ten ten ten',1362465484,1362465484,1,2,1,2),(8,'Internet Explorer','ten ten ten',1362465484,1362465484,1,3,1,4),(9,'Yahoo 12','ten ten ten	',1362465484,1362465484,1,2,1,1),(10,'Skype 8 ','ten ten ten',1362465484,1362465484,2,3,1,1),(11,'Nokia PC suite 7.4','ten ten ten',1362465484,1362465484,2,1,1,4),(12,'Clover for Folder','ten ten ten	',1362465484,1362465484,2,3,0,3),(13,'Word 2010 and Excel 2013 ','<p>ten ten ten</p>',1362988855,1362988855,1,1,1,3);

/*Table structure for table `pages` */

DROP TABLE IF EXISTS `pages`;

CREATE TABLE `pages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `content` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

/*Data for the table `pages` */

insert  into `pages`(`id`,`content`) values (1,'<p style=\"text-align: center;\"><span style=\"color: #00ff00;\">abcd</span></p>'),(2,''),(3,'');

/*Table structure for table `user` */

DROP TABLE IF EXISTS `user`;

CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  `displayname` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  `pass` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `user` */

insert  into `user`(`id`,`username`,`displayname`,`email`,`pass`) values (1,'chicuongit','Cường IT','chicuongit913@yahoo.com','123456'),(2,'chihungxd','Hùng XD','chihungxd@gmail.com','123456'),(3,'annakt','AnNa KT','annaphamkt@gmail.com','123456');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
