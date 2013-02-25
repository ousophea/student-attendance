# HeidiSQL Dump 
#
# --------------------------------------------------------
# Host:                 127.0.0.1
# Database:             db_saa
# Server version:       5.1.53-community-log
# Server OS:            Win64
# Target-Compatibility: MySQL 4.0
# Extended INSERTs:     Y
# max_allowed_packet:   1048576
# HeidiSQL version:     3.0 Revision: 572
# --------------------------------------------------------

/*!40100 SET CHARACTER SET latin1*/;


#
# Database structure for database 'db_saa'
#

DROP DATABASE IF EXISTS `db_saa`;
CREATE DATABASE `db_saa` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `db_saa`;


#
# Table structure for table 'tbl_attendances'
#

CREATE TABLE `tbl_attendances` (
  `att_id` int(11) NOT NULL AUTO_INCREMENT,
  `att_stu_id` int(11) NOT NULL,
  `att_absent` int(11) NOT NULL,
  `att_date` date NOT NULL,
  `att_attended` int(11) NOT NULL,
  `att_description` text NOT NULL,
  PRIMARY KEY (`att_id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8;



#
# Dumping data for table 'tbl_attendances'
#

/*!40000 ALTER TABLE `tbl_attendances` DISABLE KEYS*/;
LOCK TABLES `tbl_attendances` WRITE;
INSERT INTO `tbl_attendances` (`att_id`, `att_stu_id`, `att_absent`, `att_date`, `att_attended`, `att_description`) VALUES (1,1,1,'2012-03-30',0,''),
	(2,17,1,'2012-03-30',0,''),
	(3,10,1,'2012-03-30',0,''),
	(4,18,1,'2012-03-30',0,''),
	(5,13,1,'2012-03-30',0,''),
	(6,7,1,'2012-03-30',0,''),
	(7,8,1,'2012-03-30',0,''),
	(8,4,1,'2012-03-30',0,''),
	(9,16,1,'2012-03-30',0,''),
	(10,12,1,'2012-03-30',0,''),
	(11,15,0,'2012-03-30',1,''),
	(12,11,0,'2012-03-30',1,''),
	(13,5,1,'2012-03-30',0,''),
	(14,6,0,'2012-03-30',1,''),
	(15,14,0,'2012-03-30',1,''),
	(16,3,0,'2012-03-30',1,''),
	(17,9,0,'2012-03-30',1,''),
	(18,19,0,'2012-03-30',1,'');
UNLOCK TABLES;
/*!40000 ALTER TABLE `tbl_attendances` ENABLE KEYS*/;


#
# Table structure for table 'tbl_classes'
#

CREATE TABLE `tbl_classes` (
  `cla_id` int(11) NOT NULL AUTO_INCREMENT,
  `cla_name` varchar(250) NOT NULL,
  `cla_student_number` int(11) NOT NULL,
  `cla_time` varchar(50) NOT NULL,
  `cla_description` text NOT NULL,
  `cla_age_leval` varchar(20) NOT NULL,
  `cla_gen_id` int(11) NOT NULL,
  `cla_status` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`cla_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;



#
# Dumping data for table 'tbl_classes'
#

/*!40000 ALTER TABLE `tbl_classes` DISABLE KEYS*/;
LOCK TABLES `tbl_classes` WRITE;
INSERT INTO `tbl_classes` (`cla_id`, `cla_name`, `cla_student_number`, `cla_time`, `cla_description`, `cla_age_leval`, `cla_gen_id`, `cla_status`) VALUES (1,'ISF 3C',0,'06:00:00','','18',1,1),
	(2,'ISF 4B',0,'00:00:02','','9',1,1),
	(3,'ISF 1D',0,'00:00:00','','6',1,1),
	(4,'ISF 1E',0,'00:00:00','','6',1,1),
	(5,'ISF 2F',0,'00:00:00','','8',1,1),
	(6,'AZAHAR A',0,'00:00:02','','14',1,1),
	(7,'AZAHAR B',0,'00:00:03','','16',1,1),
	(8,'PNC test',0,'5-7','','12-21',1,1);
UNLOCK TABLES;
/*!40000 ALTER TABLE `tbl_classes` ENABLE KEYS*/;


#
# Table structure for table 'tbl_concerns'
#

CREATE TABLE `tbl_concerns` (
  `con_id` int(11) NOT NULL AUTO_INCREMENT,
  `con_stu_id` int(11) NOT NULL,
  `con_unfocused` varchar(250) NOT NULL,
  `con_disruptive` varchar(250) NOT NULL,
  `con_withdrawn` varchar(250) NOT NULL,
  `con_improved` varchar(250) NOT NULL,
  `con_other_comment` text NOT NULL,
  PRIMARY KEY (`con_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



#
# Dumping data for table 'tbl_concerns'
#

/*!40000 ALTER TABLE `tbl_concerns` DISABLE KEYS*/;
LOCK TABLES `tbl_concerns` WRITE;
UNLOCK TABLES;
/*!40000 ALTER TABLE `tbl_concerns` ENABLE KEYS*/;


#
# Table structure for table 'tbl_generations'
#

CREATE TABLE `tbl_generations` (
  `gen_id` int(11) NOT NULL AUTO_INCREMENT,
  `gen_year` varchar(20) NOT NULL,
  `gen_description` text NOT NULL,
  `gen_status` tinyint(4) NOT NULL DEFAULT '1',
  PRIMARY KEY (`gen_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;



#
# Dumping data for table 'tbl_generations'
#

/*!40000 ALTER TABLE `tbl_generations` DISABLE KEYS*/;
LOCK TABLES `tbl_generations` WRITE;
INSERT INTO `tbl_generations` (`gen_id`, `gen_year`, `gen_description`, `gen_status`) VALUES (1,'Yoga 2012','',1);
UNLOCK TABLES;
/*!40000 ALTER TABLE `tbl_generations` ENABLE KEYS*/;


#
# Table structure for table 'tbl_ngos'
#

CREATE TABLE `tbl_ngos` (
  `ngo_id` int(11) NOT NULL AUTO_INCREMENT,
  `ngo_name` varchar(250) NOT NULL,
  `ngo_address` text NOT NULL,
  `ngo_contact_person` varchar(250) NOT NULL,
  `ngo_url` varchar(250) NOT NULL,
  `ngo_email` varchar(250) NOT NULL,
  `ngo_description` text NOT NULL,
  `ngo_status` int(11) NOT NULL DEFAULT '1',
  `ngo_sdate` date NOT NULL,
  `ngo_edate` date NOT NULL,
  PRIMARY KEY (`ngo_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;



#
# Dumping data for table 'tbl_ngos'
#

/*!40000 ALTER TABLE `tbl_ngos` DISABLE KEYS*/;
LOCK TABLES `tbl_ngos` WRITE;
INSERT INTO `tbl_ngos` (`ngo_id`, `ngo_name`, `ngo_address`, `ngo_contact_person`, `ngo_url`, `ngo_email`, `ngo_description`, `ngo_status`, `ngo_sdate`, `ngo_edate`) VALUES (1,'PNC','#55 street 271','Sochy choeun','','pn@pas.com','',1,'0000-00-00','0000-00-00'),
	(2,'AZIZA School','#9A, Street 370, BBK1, PP','0978897889','','sotheasky@yahoo.com','',1,'0000-00-00','0000-00-00'),
	(3,'ISF','#52; street 77; BTP; PP','012500375','','kong_seiha001@yahoo.com','',1,'0000-00-00','0000-00-00'),
	(4,'Riverkids Foudation','#1882 Bis; st. 60; TSK; PP','092826056','','chhunsrun.cambodiaymca@gmail.com','',1,'0000-00-00','0000-00-00'),
	(5,'CKF','#06; st. 514; Psa Dermtkov; PP','012950767','','putsetmanagement@gmail.com','',1,'0000-00-00','0000-00-00'),
	(6,'Transition Global','no','Ms. Sola','092187073','sola@trasiitionglobal.org','',1,'0000-00-00','0000-00-00'),
	(7,'AZAHAR','no','090311341','','lunpiseth@gmail.com','',1,'0000-00-00','0000-00-00');
UNLOCK TABLES;
/*!40000 ALTER TABLE `tbl_ngos` ENABLE KEYS*/;


#
# Table structure for table 'tbl_scores'
#

CREATE TABLE `tbl_scores` (
  `sco_id` int(11) NOT NULL AUTO_INCREMENT,
  `sco_stu_id` int(11) NOT NULL,
  `sco_effort` double NOT NULL,
  `sco_pe` double NOT NULL,
  `sco_progress` double NOT NULL,
  `sco_unfocused` int(1) NOT NULL,
  `sco_discruptive` int(1) NOT NULL,
  `sco_withdrawn` int(1) NOT NULL,
  `sco_improve` int(1) NOT NULL,
  `sco_comment` varchar(500) NOT NULL,
  `sco_ter_id` int(11) NOT NULL,
  PRIMARY KEY (`sco_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;



#
# Dumping data for table 'tbl_scores'
#

/*!40000 ALTER TABLE `tbl_scores` DISABLE KEYS*/;
LOCK TABLES `tbl_scores` WRITE;
UNLOCK TABLES;
/*!40000 ALTER TABLE `tbl_scores` ENABLE KEYS*/;


#
# Table structure for table 'tbl_students'
#

CREATE TABLE `tbl_students` (
  `stu_id` int(11) NOT NULL AUTO_INCREMENT,
  `stu_khmer_name` varchar(250) NOT NULL,
  `stu_first_name` varchar(250) NOT NULL,
  `stu_last_name` varchar(250) NOT NULL,
  `stu_photo` varchar(250) NOT NULL DEFAULT 'default.png',
  `stu_sex` varchar(10) NOT NULL,
  `stu_dob` date NOT NULL,
  `stu_age` int(11) NOT NULL,
  `stu_ngo_id` int(11) NOT NULL,
  `stu_status` int(11) NOT NULL DEFAULT '1',
  `stu_cla_id` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`stu_id`)
) ENGINE=InnoDB AUTO_INCREMENT=40 DEFAULT CHARSET=utf8;



#
# Dumping data for table 'tbl_students'
#

/*!40000 ALTER TABLE `tbl_students` DISABLE KEYS*/;
LOCK TABLES `tbl_students` WRITE;
INSERT INTO `tbl_students` (`stu_id`, `stu_khmer_name`, `stu_first_name`, `stu_last_name`, `stu_photo`, `stu_sex`, `stu_dob`, `stu_age`, `stu_ngo_id`, `stu_status`, `stu_cla_id`) VALUES (1,'????','ou','sophea','IMG_2603.JPG','Male','2000-03-08',22,1,1,1),
	(2,'???????','Phan Mai','?','Delphin.jpeg','Female','2012-09-20',12,1,1,1),
	(3,'?????? ???????','Sreynang','Yuth','default.png','Female','0000-00-00',12,3,1,2),
	(4,'??? ????','Rachana','Keourng','default.png','Female','0000-00-00',14,3,1,2),
	(5,'??? ????','Sophal','Korn','default.png','Male','0000-00-00',11,3,1,2),
	(6,'????????? ?????','Sopheak','Samnang','default.png','Female','0000-00-00',14,3,1,2),
	(7,'???? ??????','Phany','Morng','default.png','Female','2000-10-02',12,3,1,2),
	(8,'???? ???????','Porlrada','Kem','default.png','Male','2002-09-03',10,3,1,2),
	(9,'?????? ????','Tola','Van','default.png','Male','0000-00-00',10,3,1,2),
	(10,'???? ????','Lyhuo','Hot','default.png','Male','0000-00-00',11,3,1,2),
	(11,'???? ??????','Simeng','Sim','default.png','Male','0000-00-00',13,3,1,2),
	(12,'?? ?????','Roitry','Ny','default.png','Female','0000-00-00',10,3,1,2),
	(13,'???? ???????','Meng Leapp','Lay','default.png','Male','0000-00-00',11,3,1,2),
	(14,'??? ???????','Srey Luon','San','default.png','Female','0000-00-00',9,3,1,2),
	(15,'??? ???????','Seng Heang','San','default.png','Male','0000-00-00',11,3,1,2),
	(16,'???? ????','Ratana','Gnem','default.png','Female','0000-00-00',13,3,1,2),
	(17,'???? ?????','Kanha','Pat','default.png','Female','0000-00-00',12,3,1,2),
	(18,'??? ??????','Mara','Lov','default.png','Male','0000-00-00',12,3,1,2),
	(19,'?? ????','Try','Pov','default.png','Female','0000-00-00',11,3,1,2),
	(20,'?? ???????','Vanny','Sorn','default.png','Female','0000-00-00',10,3,1,5),
	(21,'?? ?????','Raksmey','Korn','default.png','Female','0000-00-00',11,3,1,5),
	(22,'??? ???','Poung','Ping','default.png','Male','0000-00-00',11,3,1,5),
	(23,'??? ?????','Skin','Sorl','default.png','Male','0000-00-00',11,3,1,5),
	(24,'?? ????','Dara','Phal','default.png','Male','0000-00-00',11,3,1,5),
	(25,'?? ?????','Chanon','Na','default.png','Male','0000-00-00',11,3,1,5),
	(26,'???? ???','Deth','Men','default.png','Male','0000-00-00',11,3,1,5),
	(27,'?? ???','Horn','Dy','default.png','Female','0000-00-00',11,3,1,5),
	(28,'??? ???????','So Ben','Heng','default.png','Male','0000-00-00',13,3,1,5),
	(29,'??? ??????','Maneath','Khey','default.png','Female','0000-00-00',13,3,1,5),
	(30,'??? ????','Phearak','Nong','default.png','Male','0000-00-00',11,3,1,5),
	(31,'??? ?????????','Vanneth','Nheom','default.png','Male','0000-00-00',9,3,1,5),
	(32,'???? ????','Ratana','Kry','default.png','Male','0000-00-00',12,3,1,5),
	(33,'??? ????','Virak','Khuy','default.png','Male','0000-00-00',9,3,1,5),
	(34,'??? ?????','Konit','Dan','default.png','Male','0000-00-00',10,3,1,5),
	(35,'?? ??????','Rithy','Sam','default.png','Male','0000-00-00',9,3,1,5),
	(36,'????? ??????','Vatana','Gnem','default.png','Male','0000-00-00',11,3,1,5),
	(37,'??? ?????','Vannak','Nang','default.png','Male','0000-00-00',12,3,1,5),
	(38,'????????????? ????','Lina','Vin','default.png','Female','0000-00-00',14,3,1,1),
	(39,'??? ???','Rin','Kham','default.png','Female','0000-00-00',14,3,1,1);
UNLOCK TABLES;
/*!40000 ALTER TABLE `tbl_students` ENABLE KEYS*/;


#
# Table structure for table 'tbl_teachers'
#

CREATE TABLE `tbl_teachers` (
  `tea_id` int(11) NOT NULL AUTO_INCREMENT,
  `tea_name` varchar(250) NOT NULL,
  `tea_sex` varchar(10) NOT NULL,
  `tea_phone` varchar(250) NOT NULL,
  `tea_address` text NOT NULL,
  `tea_email` varchar(250) NOT NULL,
  `tea_description` text NOT NULL,
  `tea_position` varchar(250) NOT NULL,
  `tea_password` varchar(250) NOT NULL,
  `tea_status` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`tea_id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;



#
# Dumping data for table 'tbl_teachers'
#

/*!40000 ALTER TABLE `tbl_teachers` DISABLE KEYS*/;
LOCK TABLES `tbl_teachers` WRITE;
INSERT INTO `tbl_teachers` (`tea_id`, `tea_name`, `tea_sex`, `tea_phone`, `tea_address`, `tea_email`, `tea_description`, `tea_position`, `tea_password`, `tea_status`) VALUES (1,'admin','Male','0972 666 056','Phnom Pehn','sochy.choeun@gmail.comm','Trainer','Admin','21232f297a57a5a743894a0e4a801fc3',1),
	(2,'YanVannac','Male','012584930','#14Eo, St242,Doun Penh,PP,Cambodia','vannac.yan@gmail.com','From 2005','Admin','827ccb0eea8a706c4c34a16891f84e7b',1),
	(3,'Sineth','Female','010696951','','chansineth2008@gmail.com','','Teacher','604039b0b26d104d3ad66d99bd981622',1),
	(4,'Liya','Female','093291912','','','','Teacher','9ec845ce9a42fdccc887ebc6c282c5ae',1),
	(5,'Nich','Female','092955289','','ly.srey.nich@gmail.com','','Teacher','0fb51270e088823829a516f104d7bbce',1),
	(6,'Lita','Female','093323150','','','','Teacher','d6022249ddb33ec5a4e89e31df57cc67',1),
	(7,'Dara','Female','012769315','','','','Teacher','b5664f133f997441cae35e6ea8abf477',1),
	(8,'Piseth','Male','090311341','','lunpiseth@gmail.com','','Admin','d3eb9a9233e52948740d7eb8c3062d14',1),
	(9,'Kate','Female','1237','','','','Teacher','5be0a66b86dd75ac8ca69b73425e6c81',0),
	(10,'tc sophea','Male','','','','','Teacher','827ccb0eea8a706c4c34a16891f84e7b',1);
UNLOCK TABLES;
/*!40000 ALTER TABLE `tbl_teachers` ENABLE KEYS*/;


#
# Table structure for table 'tbl_terms'
#

CREATE TABLE `tbl_terms` (
  `ter_id` int(11) NOT NULL AUTO_INCREMENT,
  `ter_gen_id` int(11) NOT NULL,
  `ter_start_date` date NOT NULL,
  `ter_end_date` date NOT NULL,
  `ter_status` int(11) NOT NULL DEFAULT '1',
  `ter_name` varchar(11) NOT NULL,
  PRIMARY KEY (`ter_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;



#
# Dumping data for table 'tbl_terms'
#

/*!40000 ALTER TABLE `tbl_terms` DISABLE KEYS*/;
LOCK TABLES `tbl_terms` WRITE;
INSERT INTO `tbl_terms` (`ter_id`, `ter_gen_id`, `ter_start_date`, `ter_end_date`, `ter_status`, `ter_name`) VALUES (1,1,'2012-01-01','2012-03-01',1,'Term 1'),
	(2,1,'2012-03-02','2012-05-31',1,'Term 2');
UNLOCK TABLES;
/*!40000 ALTER TABLE `tbl_terms` ENABLE KEYS*/;


#
# Table structure for table 'tbl_workloads'
#

CREATE TABLE `tbl_workloads` (
  `wor_tea_id` int(11) NOT NULL,
  `wor_cla_id` int(11) NOT NULL,
  `wor_description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



#
# Dumping data for table 'tbl_workloads'
#

/*!40000 ALTER TABLE `tbl_workloads` DISABLE KEYS*/;
LOCK TABLES `tbl_workloads` WRITE;
INSERT INTO `tbl_workloads` (`wor_tea_id`, `wor_cla_id`, `wor_description`) VALUES (10,2,''),
	(6,7,''),
	(5,7,''),
	(7,6,''),
	(8,3,''),
	(3,3,''),
	(7,1,''),
	(2,1,'');
UNLOCK TABLES;
/*!40000 ALTER TABLE `tbl_workloads` ENABLE KEYS*/;
