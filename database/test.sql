/*
SQLyog Professional v12.5.1 (64 bit)
MySQL - 10.4.28-MariaDB : Database - login_otp_db
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`login_otp_db` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci */;

USE `login_otp_db`;

/*Table structure for table `users` */

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` int(30) NOT NULL AUTO_INCREMENT,
  `firstname` text NOT NULL,
  `middlename` text DEFAULT NULL,
  `lastname` text NOT NULL,
  `email` text NOT NULL,
  `password` text NOT NULL,
  `otp` varchar(6) DEFAULT NULL,
  `otp_expiration` datetime DEFAULT NULL,
  `date_created` datetime NOT NULL DEFAULT current_timestamp(),
  `qr_code` varchar(255) NOT NULL,
  `securityWord` varchar(32) NOT NULL,
  `forgot_pass_identity` varchar(32) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `users` */

insert  into `users`(`id`,`firstname`,`middlename`,`lastname`,`email`,`password`,`otp`,`otp_expiration`,`date_created`,`qr_code`,`securityWord`,`forgot_pass_identity`) values 
(1,'Tanveer','ahmed','khan','tanveerrajput0894@gmail.com','$2y$10$LSu2y6IjZchpN2p4230H0ekNZ9fTp/Wjl48D2c/u41.nghS3UkXeO','721521','2023-03-23 16:28:00','2023-03-14 04:15:25','images/1679585269.png','',''),
(2,'ali','murtaza','asdasds','ranatanveer0894@gmail.com','$2y$10$HWhrgT9Q8FJ.XfVMwW9c3.Z2ZJ1dmaGg.2zswCqznIN4S8mozUQGy',NULL,NULL,'2023-03-14 04:18:20','','',''),
(3,'amara','asd','ali','amara.tanveer28@gmail.com','$2y$10$6Xx/V9hyhntUHGd4JLD99uUwFvL3F7Z/MARqb1XQtEqVuJp1EnkfK','349732','2023-03-14 00:46:00','2023-03-14 04:44:32','','',''),
(4,'jian','mang','malay','jian@gmail.com','$2y$10$tmUw7yA6pBy5Mb5Ufyfb7OFmraDcYn4p6EF8RWYDWqeiays4HcLzu',NULL,NULL,'2023-03-15 04:06:50','','',''),
(5,'ali','ahmed','urs','ali@gmail.com','$2y$10$jS3jo/X226kq9mFz/y2HF.R6Yaz36dzMUPFJtkw1c4YD8QQ22B5Ry','722548','2023-03-23 09:21:00','2023-03-20 20:51:24','','',''),
(6,'virus','old','dev','virus.old.dev@gmail.com','$2y$10$m21Vqc4vnBD2s4n3CRnD5eD3Q23ipN7Djm5Ozo5VJ6QdM4pVIYtiG',NULL,NULL,'2023-04-26 08:59:02','005_file_4fa993743077c7c464d5a8100314c95b.png','apple','30f91d547271d24270bb56261ee14782'),
(7,'virus','old','dev','virusold0607@gmail.com','$2y$10$63Kw2pTacrJiJ5r.WDYPr.eTkOYM7ti2HyWgMmrxxnC.Oj.UEZB3.',NULL,NULL,'2023-04-26 09:05:10','','Demo',''),
(9,'g','t','b','gtb@gmail.com','$2y$10$m21Vqc4vnBD2s4n3CRnD5eD3Q23ipN7Djm5Ozo5VJ6QdM4pVIYtiG',NULL,NULL,'2023-04-27 00:50:50','images/1682571083.png','Wonder',''),
(10,'qwe','qwe','qwe','qwe@gmail.com','$2y$10$APCTAtNEAeO6Vge/zLTN2unQEgeosYhwi4jjS.3vD7mO0x..EZyMi',NULL,NULL,'2023-04-27 00:56:07','images/1682613717.png','qwe','');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
