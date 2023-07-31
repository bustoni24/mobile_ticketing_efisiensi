/*
SQLyog Ultimate v8.71 
MySQL - 5.5.36 : Database - joyoboyo
*********************************************************************
*/


/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
/*Table structure for table `kecamatan` */

CREATE TABLE `kecamatan` (
  `kecamatan_id` int(5) NOT NULL AUTO_INCREMENT,
  `kecamatan_nama` varchar(50) NOT NULL,
  `kota_id` int(5) DEFAULT NULL,
  `koordinat` varchar(50) DEFAULT NULL COMMENT 'lat, lng',
  `is_active` tinyint(1) DEFAULT '1',
  PRIMARY KEY (`kecamatan_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `kecamatan` */

insert  into `kecamatan`(`kecamatan_id`,`kecamatan_nama`,`kota_id`,`koordinat`,`is_active`) values (1,'Minggir',NULL,'-7.730943, 110.249010',1),(2,'Kalasan',NULL,'',1);

/*Table structure for table `kota` */

CREATE TABLE `kota` (
  `kota_id` int(5) NOT NULL AUTO_INCREMENT,
  `nama_kota` varchar(50) NOT NULL,
  `provinsi_id` int(2) NOT NULL COMMENT 'ref tabel provinsi',
  `is_active` tinyint(1) DEFAULT '1',
  PRIMARY KEY (`kota_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

/*Data for the table `kota` */

insert  into `kota`(`kota_id`,`nama_kota`,`provinsi_id`,`is_active`) values (1,'Kab. Kulonprogo',34,1),(2,'Kab. Bantul',34,1),(3,'Kab. Gunungkidul',34,1),(4,'Kab. Sleman',34,1),(5,'Kota Yogyakarta',34,1);

/*Table structure for table `permission` */

CREATE TABLE `permission` (
  `permission_id` int(10) NOT NULL AUTO_INCREMENT,
  `permission_name` varchar(30) NOT NULL,
  `group` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`permission_id`),
  UNIQUE KEY `idx_perm_name` (`permission_name`)
) ENGINE=MyISAM AUTO_INCREMENT=66 DEFAULT CHARSET=latin1;

/*Data for the table `permission` */

insert  into `permission`(`permission_id`,`permission_name`,`group`) values (2,'user_view','user'),(3,'user_edit','user'),(4,'user_delete','user'),(5,'user_add','user'),(17,'role_view','role'),(18,'role_edit','role'),(19,'role_add','role'),(20,'role_delete','role'),(21,'permission_view','permission'),(22,'permission_edit','permission'),(23,'permission_add','permission'),(25,'permission_delete','permission'),(61,'settings',''),(43,'report_view','Report'),(57,'banner','Banner');

/*Table structure for table `provinsi` */

CREATE TABLE `provinsi` (
  `id` int(3) NOT NULL AUTO_INCREMENT,
  `kode` varchar(3) DEFAULT NULL,
  `nama_propinsi` varchar(100) NOT NULL,
  `lat` float DEFAULT NULL,
  `lng` float DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=latin1;

/*Data for the table `provinsi` */

insert  into `provinsi`(`id`,`kode`,`nama_propinsi`,`lat`,`lng`,`is_active`) values (1,'11','Aceh',NULL,NULL,1),(2,'51','Bali',NULL,NULL,1),(3,'36','Banten',NULL,NULL,1),(4,'17','Bengkulu',NULL,NULL,1),(5,'75','Gorontalo',NULL,NULL,1),(6,'31','DKI Jakarta',NULL,NULL,1),(7,'15','Jambi',NULL,NULL,1),(8,'32','Jawa Barat',NULL,NULL,1),(9,'33','Jawa Tengah',NULL,NULL,1),(10,'35','Jawa Timur',NULL,NULL,1),(11,'61','Kalimantan Barat',NULL,NULL,1),(12,'63','Kalimantan Selatan',NULL,NULL,1),(13,'62','Kalimantan Tengah',NULL,NULL,1),(14,'64','Kalimantan Timur',NULL,NULL,1),(15,'65','Kalimantan Utara',NULL,NULL,1),(16,'19','Kep. Bangka Belitung',NULL,NULL,1),(17,'21','Kep. Riau',NULL,NULL,1),(18,'18','Lampung',NULL,NULL,1),(19,'81','Maluku',NULL,NULL,1),(20,'82','Maluku Utara',NULL,NULL,1),(21,'52','Nusa Tenggara Barat',NULL,NULL,1),(22,'53','Nusa Tenggara Timur',NULL,NULL,1),(23,'94','Papua',NULL,NULL,1),(24,'91','Papua Barat',NULL,NULL,1),(25,'14','Riau',NULL,NULL,1),(27,'73','Sulawesi Selatan',NULL,NULL,1),(28,'72','Sulawesi Tengah',NULL,NULL,1),(29,'74','Sulawesi Tenggara',NULL,NULL,1),(30,'71','Sulawesi Utara',NULL,NULL,1),(31,'13','Sumatera Barat',NULL,NULL,1),(32,'16','Sumatera Selatan',NULL,NULL,1),(33,'12','Sumatera Utara',NULL,NULL,1),(34,'34','DI Yogyakarta',NULL,NULL,1);

/*Table structure for table `role` */

CREATE TABLE `role` (
  `role_id` int(10) NOT NULL AUTO_INCREMENT,
  `role_name` varchar(30) NOT NULL,
  `description` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`role_id`)
) ENGINE=MyISAM AUTO_INCREMENT=20 DEFAULT CHARSET=latin1;

/*Data for the table `role` */

insert  into `role`(`role_id`,`role_name`,`description`) values (10,'Superadmin','Super Administrator'),(2,'Admin Kota','Operator'),(3,'Admin Provinsi','Operator'),(19,'Freelance','mobile App');

/*Table structure for table `role_permission` */

CREATE TABLE `role_permission` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `role_id` varchar(20) NOT NULL,
  `permission_id` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=160 DEFAULT CHARSET=latin1;

/*Data for the table `role_permission` */

insert  into `role_permission`(`id`,`role_id`,`permission_id`) values (4,'10',1),(12,'10',5),(3,'10',3),(13,'10',6),(11,'10',4),(10,'10',2),(14,'10',7),(15,'10',8),(16,'10',9),(17,'10',10),(18,'10',11),(19,'10',12),(20,'10',13),(21,'10',14),(22,'10',15),(23,'10',16),(24,'10',17),(25,'10',18),(26,'10',19),(27,'10',20),(28,'7',1),(29,'8',1),(30,'8',7),(32,'10',21),(33,'10',22),(61,'10',23),(35,'2',1),(74,'11',32),(73,'11',31),(72,'10',39),(102,'2',41),(40,'8',23),(41,'10',25),(42,'10',27),(43,'10',28),(44,'10',29),(65,'10',33),(64,'10',32),(63,'10',31),(62,'10',30),(66,'10',34),(67,'10',35),(68,'10',36),(69,'10',37),(70,'10',38),(83,'11',30),(86,'12',33),(89,'4',31),(88,'11',35),(90,'4',33),(91,'4',32),(92,'4',30),(99,'4',34),(97,'3',33),(96,'4',35),(100,'10',40),(103,'10',42),(105,'10',43),(106,'3',44),(107,'3',45),(108,'3',47),(109,'13',44),(110,'14',45),(111,'14',46),(112,'15',48),(113,'15',50),(114,'16',48),(115,'16',50),(116,'17',48),(117,'17',50),(118,'15',52),(119,'15',53),(120,'16',52),(121,'16',53),(122,'17',52),(123,'17',53),(124,'10',48),(125,'10',50),(126,'10',51),(127,'10',52),(128,'10',53),(129,'10',54),(130,'10',55),(131,'10',56),(132,'10',57),(133,'10',58),(134,'10',59),(135,'10',60),(136,'10',61),(137,'10',62),(138,'10',63),(139,'10',64),(140,'10',65),(141,'1',43),(142,'1',57),(143,'1',62),(144,'1',63),(145,'1',64),(146,'1',65),(147,'3',61),(148,'3',57),(149,'3',62),(150,'3',63),(151,'3',64),(152,'3',65),(153,'2',61),(154,'2',43),(155,'2',57),(156,'2',62),(157,'2',63),(158,'2',64),(159,'2',65);

/*Table structure for table `settings` */

CREATE TABLE `settings` (
  `setting_id` int(1) NOT NULL AUTO_INCREMENT,
  `telepon` varchar(50) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `about` text,
  `alamat` text,
  `banner_image_url` text,
  PRIMARY KEY (`setting_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `settings` */

insert  into `settings`(`setting_id`,`telepon`,`email`,`about`,`alamat`,`banner_image_url`) values (1,'(0274) 000-0000-0','lpju@email.com','tesssss','alamat...........','');

/*Table structure for table `user` */

CREATE TABLE `user` (
  `userId` int(10) NOT NULL AUTO_INCREMENT,
  `userUsername` varchar(50) NOT NULL,
  `userPassword` varchar(50) NOT NULL,
  `userRealname` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `id_no` varchar(50) NOT NULL,
  `phone` varchar(25) NOT NULL,
  `email` varchar(50) NOT NULL,
  `userRole` tinyint(2) NOT NULL,
  `address` text,
  `provinsi_id` int(2) NOT NULL,
  `kota_id` int(5) NOT NULL,
  `kecamatan_id` int(5) NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`userId`),
  UNIQUE KEY `username` (`userUsername`)
) ENGINE=MyISAM AUTO_INCREMENT=9294 DEFAULT CHARSET=latin1;

/*Data for the table `user` */

insert  into `user`(`userId`,`userUsername`,`userPassword`,`userRealname`,`last_name`,`id_no`,`phone`,`email`,`userRole`,`address`,`provinsi_id`,`kota_id`,`kecamatan_id`,`is_active`) values (1,'adi','e4ef9a1cf32085fd52b149a10f79a57d','Adi','Prabowo','5465476770001','0845634634','adiprabowo.ssi@gmail.com',10,NULL,34,4,1,1),(9163,'tester','1c8e734f4e6245760134d0830fc62d4a','Tester','','','','',3,NULL,0,0,0,1),(9164,'hesti','827ccb0eea8a706c4c34a16891f84e7b','','','','','',3,NULL,34,0,0,1),(9165,'kulonprogo','827ccb0eea8a706c4c34a16891f84e7b','','','','','',2,NULL,34,1,0,1),(9166,'bantul','827ccb0eea8a706c4c34a16891f84e7b','','','','','',2,NULL,34,2,0,1),(9167,'gunungkidul','827ccb0eea8a706c4c34a16891f84e7b','','','','','',2,NULL,34,3,0,1),(9168,'kabsleman','827ccb0eea8a706c4c34a16891f84e7b','','','','','',2,NULL,34,4,0,1),(9169,'yogyakarta','827ccb0eea8a706c4c34a16891f84e7b','','','','','',2,NULL,34,5,0,1),(9291,'tiyas','47bce5c74f589f4867dbd57e9ca9f808','Tiyas','','','','',10,NULL,0,0,0,1),(9293,'baru','b59c67bf196a4758191e42f76670ceba','dhdhf','hdfg','dgfd','5346356','adiprabotsedrwo.ssi@gmail.com',10,NULL,34,4,1,1);

ALTER TABLE `user`     CHANGE `email` `email` VARCHAR(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
