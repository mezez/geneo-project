/*
SQLyog Professional v13.1.1 (64 bit)
MySQL - 10.1.30-MariaDB : Database - geneo
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`geneo` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `geneo`;

/*Table structure for table `acos` */

DROP TABLE IF EXISTS `acos`;

CREATE TABLE `acos` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `parent_id` int(10) DEFAULT NULL,
  `model` varchar(255) DEFAULT NULL,
  `foreign_key` int(10) DEFAULT NULL,
  `alias` varchar(255) DEFAULT NULL,
  `lft` int(10) DEFAULT NULL,
  `rght` int(10) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_acos_lft_rght` (`lft`,`rght`),
  KEY `idx_acos_alias` (`alias`)
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=latin1;

/*Data for the table `acos` */

insert  into `acos`(`id`,`parent_id`,`model`,`foreign_key`,`alias`,`lft`,`rght`) values 
(1,NULL,NULL,NULL,'controllers',1,72),
(2,1,NULL,NULL,'Groups',2,15),
(3,2,NULL,NULL,'index',3,4),
(4,2,NULL,NULL,'view',5,6),
(5,2,NULL,NULL,'add',7,8),
(6,2,NULL,NULL,'edit',9,10),
(7,2,NULL,NULL,'delete',11,12),
(8,2,NULL,NULL,'isAuthorized',13,14),
(9,1,NULL,NULL,'Pages',16,21),
(10,9,NULL,NULL,'display',17,18),
(11,9,NULL,NULL,'isAuthorized',19,20),
(12,1,NULL,NULL,'Posts',22,35),
(13,12,NULL,NULL,'isAuthorized',23,24),
(14,12,NULL,NULL,'index',25,26),
(15,12,NULL,NULL,'view',27,28),
(16,12,NULL,NULL,'add',29,30),
(17,12,NULL,NULL,'edit',31,32),
(18,12,NULL,NULL,'delete',33,34),
(19,1,NULL,NULL,'Users',36,55),
(20,19,NULL,NULL,'index',37,38),
(21,19,NULL,NULL,'view',39,40),
(22,19,NULL,NULL,'add',41,42),
(23,19,NULL,NULL,'edit',43,44),
(24,19,NULL,NULL,'delete',45,46),
(25,19,NULL,NULL,'login',47,48),
(26,19,NULL,NULL,'signup',49,50),
(27,19,NULL,NULL,'logout',51,52),
(28,19,NULL,NULL,'isAuthorized',53,54),
(29,1,NULL,NULL,'Widgets',56,69),
(30,29,NULL,NULL,'index',57,58),
(31,29,NULL,NULL,'view',59,60),
(32,29,NULL,NULL,'add',61,62),
(33,29,NULL,NULL,'edit',63,64),
(34,29,NULL,NULL,'delete',65,66),
(35,29,NULL,NULL,'isAuthorized',67,68),
(36,1,NULL,NULL,'AclExtras',70,71);

/*Table structure for table `aros` */

DROP TABLE IF EXISTS `aros`;

CREATE TABLE `aros` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `parent_id` int(10) DEFAULT NULL,
  `model` varchar(255) DEFAULT NULL,
  `foreign_key` int(10) DEFAULT NULL,
  `alias` varchar(255) DEFAULT NULL,
  `lft` int(10) DEFAULT NULL,
  `rght` int(10) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_aros_lft_rght` (`lft`,`rght`),
  KEY `idx_aros_alias` (`alias`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Data for the table `aros` */

insert  into `aros`(`id`,`parent_id`,`model`,`foreign_key`,`alias`,`lft`,`rght`) values 
(1,NULL,'Group',1,NULL,1,2),
(2,NULL,'Group',2,NULL,3,4),
(3,NULL,'Group',3,NULL,5,6);

/*Table structure for table `aros_acos` */

DROP TABLE IF EXISTS `aros_acos`;

CREATE TABLE `aros_acos` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `aro_id` int(10) NOT NULL,
  `aco_id` int(10) NOT NULL,
  `_create` varchar(2) NOT NULL DEFAULT '0',
  `_read` varchar(2) NOT NULL DEFAULT '0',
  `_update` varchar(2) NOT NULL DEFAULT '0',
  `_delete` varchar(2) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `ARO_ACO_KEY` (`aro_id`,`aco_id`),
  KEY `idx_aco_id` (`aco_id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;

/*Data for the table `aros_acos` */

insert  into `aros_acos`(`id`,`aro_id`,`aco_id`,`_create`,`_read`,`_update`,`_delete`) values 
(1,1,1,'1','1','1','1'),
(2,2,1,'-1','-1','-1','-1'),
(3,2,26,'1','1','1','1'),
(4,2,25,'1','1','1','1'),
(5,2,27,'1','1','1','1'),
(6,2,14,'1','1','1','1'),
(7,2,16,'1','1','1','1'),
(8,2,17,'1','1','1','1'),
(9,2,15,'1','1','1','1'),
(10,2,18,'1','1','1','1'),
(11,3,1,'-1','-1','-1','-1'),
(12,3,15,'1','1','1','1'),
(13,3,14,'1','1','1','1'),
(14,3,26,'1','1','1','1'),
(15,3,25,'1','1','1','1'),
(16,3,27,'1','1','1','1');

/*Table structure for table `groups` */

DROP TABLE IF EXISTS `groups`;

CREATE TABLE `groups` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Data for the table `groups` */

insert  into `groups`(`id`,`name`,`created`,`modified`) values 
(1,'admin','2020-02-17 16:02:04','2020-02-17 16:02:04'),
(2,'authors','2020-02-17 16:02:12','2020-02-17 16:02:12'),
(3,'readers','2020-02-17 16:02:17','2020-02-17 16:02:17');

/*Table structure for table `posts` */

DROP TABLE IF EXISTS `posts`;

CREATE TABLE `posts` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(50) DEFAULT NULL,
  `body` text,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

/*Data for the table `posts` */

insert  into `posts`(`id`,`title`,`body`,`created`,`modified`,`user_id`) values 
(1,'The title','This is the post body.','2020-02-17 10:32:12',NULL,2),
(2,'A title once again','And the post body follows.','2020-02-17 10:32:12',NULL,2),
(3,'Title strikes back','This is really exciting! Not.','2020-02-17 10:32:12',NULL,2),
(4,'Jenni Post','This is a jenni post','2020-02-18 10:59:03','2020-02-18 10:59:03',4);

/*Table structure for table `users` */

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `group_id` int(10) DEFAULT NULL,
  `role` varchar(20) DEFAULT NULL,
  `active` tinyint(1) DEFAULT '1',
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

/*Data for the table `users` */

insert  into `users`(`id`,`username`,`password`,`group_id`,`role`,`active`,`created`,`modified`) values 
(1,'superadmin','$2a$10$R3YPmwxH6tTu2oNeypAwwu1REBMtL7crW7rtpx8yCbnaevfedBG6u',1,'admin',1,'2020-02-17 16:02:42','2020-02-17 16:02:42'),
(2,'mez','$2a$10$zS17zLhr2.OBS42PRvDIKeuKffZyIYcoUUM7XiDtuifQDDNfot0le',2,'author',1,'2020-02-17 16:03:15','2020-02-17 16:03:15'),
(3,'test','$2a$10$877LJwYdAZWnyduZu4gGoeBaYcAtfNGSwhWxsv6m9F5zA2W6et02a',3,'reader',1,'2020-02-17 16:03:37','2020-02-18 13:53:36'),
(4,'jenni','$2a$10$3Hhr8gn739QKIlb7MoA/PeoDvuOylc4TYisKjY9fS9z.GRodsuK4G',2,'author',1,'2020-02-18 10:57:33','2020-02-18 10:57:33');

/*Table structure for table `widgets` */

DROP TABLE IF EXISTS `widgets`;

CREATE TABLE `widgets` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `part_no` varchar(12) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `widgets` */

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
