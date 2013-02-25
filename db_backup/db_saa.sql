-- phpMyAdmin SQL Dump
-- version 3.3.9
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Feb 17, 2012 at 04:52 AM
-- Server version: 5.1.53
-- PHP Version: 5.3.4

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `db_saa`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_attendances`
--

CREATE TABLE IF NOT EXISTS `tbl_attendances` (
  `att_id` int(11) NOT NULL AUTO_INCREMENT,
  `att_stu_id` int(11) NOT NULL,
  `att_absent` int(11) NOT NULL,
  `att_date` date NOT NULL,
  `att_attended` int(11) NOT NULL,
  `att_description` text NOT NULL,
  PRIMARY KEY (`att_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `tbl_attendances`
--


-- --------------------------------------------------------

--
-- Table structure for table `tbl_classes`
--

CREATE TABLE IF NOT EXISTS `tbl_classes` (
  `cla_id` int(11) NOT NULL AUTO_INCREMENT,
  `cla_name` varchar(250) NOT NULL,
  `cla_student_number` int(11) NOT NULL,
  `cla_time` time NOT NULL,
  `cla_description` text NOT NULL,
  `cla_age_leval` int(11) NOT NULL,
  `cla_gen_id` int(11) NOT NULL,
  `cla_status` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`cla_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `tbl_classes`
--


-- --------------------------------------------------------

--
-- Table structure for table `tbl_concerns`
--

CREATE TABLE IF NOT EXISTS `tbl_concerns` (
  `con_id` int(11) NOT NULL AUTO_INCREMENT,
  `con_stu_id` int(11) NOT NULL,
  `con_unfocused` varchar(250) NOT NULL,
  `con_disruptive` varchar(250) NOT NULL,
  `con_withdrawn` varchar(250) NOT NULL,
  `con_improved` varchar(250) NOT NULL,
  `con_other_comment` text NOT NULL,
  PRIMARY KEY (`con_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `tbl_concerns`
--


-- --------------------------------------------------------

--
-- Table structure for table `tbl_generations`
--

CREATE TABLE IF NOT EXISTS `tbl_generations` (
  `gen_id` int(11) NOT NULL AUTO_INCREMENT,
  `gen_year` int(11) NOT NULL,
  `gen_description` text NOT NULL,
  PRIMARY KEY (`gen_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `tbl_generations`
--


-- --------------------------------------------------------

--
-- Table structure for table `tbl_ngos`
--

CREATE TABLE IF NOT EXISTS `tbl_ngos` (
  `ngo_id` int(11) NOT NULL AUTO_INCREMENT,
  `ngo_name` varchar(250) NOT NULL,
  `ngo_address` text NOT NULL,
  `ngo_contact_person` varchar(250) NOT NULL,
  `ngo_url` varchar(250) NOT NULL,
  `ngo_email` varchar(250) NOT NULL,
  `ngo_description` text NOT NULL,
  `ngo_status` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`ngo_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=16 ;

--
-- Dumping data for table `tbl_ngos`
--

INSERT INTO `tbl_ngos` (`ngo_id`, `ngo_name`, `ngo_address`, `ngo_contact_person`, `ngo_url`, `ngo_email`, `ngo_description`, `ngo_status`) VALUES
(1, 'PNC', 'Test', 'Test', 'Test', 'Test', 'Test', 0),
(2, 'PNC', 'Test', 'Test', 'Test', 'Test', 'Test', 0),
(3, 'PNC', 'Test', 'Test', 'Test', 'Test', 'Test', 0),
(4, 'PNC', 'Test', 'Test', 'Test', 'Test', 'Test', 0),
(5, 'PNC', 'Test', 'Test', 'Test', 'Test', 'Test', 1),
(6, 'test', 'test', 'test', 'test', 'test@test.com', 'test', 1),
(7, 'test1', 'test', 'test', 'test', 'test@test.com', 'sdf dsddsdsd', 1),
(8, 'test3', 'test', 'test', 'test', 'test@test.com', ' ds', 1),
(9, 'test2', 'd', 'test', 'test', 'test@test.com', 'd', 1),
(10, 'test4', 'test', 'test', 'test', 'test@test.com', 'dssd', 1),
(11, 'p', 'test just kidding', 'test', 'test', 'test@test.com', 'd just test dsds', 1),
(12, 'test5', 'testdddddddddddddd', 'test', 'test', 'test@test.com', 'that is just my test', 0),
(13, 'test10', 'test just kidding', 'dd', 'dd', 'dd@dd.xoz', 'xx', 1),
(14, 'test11', 'test just kidding', 'dd', 'dd', 'dd@dd.xoz', 'sd', 1),
(15, 'test14', 'test just kidding', 'dd', 'dd', 'dd@dd.xoz', 'd', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_scores`
--

CREATE TABLE IF NOT EXISTS `tbl_scores` (
  `sco_id` int(11) NOT NULL AUTO_INCREMENT,
  `sco_stu_id` int(11) NOT NULL,
  `sco_effort` double NOT NULL,
  `sco_pe` double NOT NULL,
  `sco_progress` double NOT NULL,
  `sco_exam` double NOT NULL,
  `sco_total` double NOT NULL,
  `sco_ter_id` int(11) NOT NULL,
  PRIMARY KEY (`sco_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `tbl_scores`
--


-- --------------------------------------------------------

--
-- Table structure for table `tbl_students`
--

CREATE TABLE IF NOT EXISTS `tbl_students` (
  `stu_id` int(11) NOT NULL AUTO_INCREMENT,
  `stu_khmer_name` varchar(250) NOT NULL,
  `stu_first_name` varchar(250) NOT NULL,
  `stu_last_name` varchar(250) NOT NULL,
  `stu_sex` varchar(10) NOT NULL,
  `stu_dob` date NOT NULL,
  `stu_age` int(11) NOT NULL,
  `stu_ngo_id` int(11) NOT NULL,
  `stu_status` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`stu_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `tbl_students`
--


-- --------------------------------------------------------

--
-- Table structure for table `tbl_teachers`
--

CREATE TABLE IF NOT EXISTS `tbl_teachers` (
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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `tbl_teachers`
--

INSERT INTO `tbl_teachers` (`tea_id`, `tea_name`, `tea_sex`, `tea_phone`, `tea_address`, `tea_email`, `tea_description`, `tea_position`, `tea_password`, `tea_status`) VALUES
(1, 'admin', 'admin', 'admin', 'admin', 'admin', 'admin', 'admin', '21232f297a57a5a743894a0e4a801fc3', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_terms`
--

CREATE TABLE IF NOT EXISTS `tbl_terms` (
  `ter_id` int(11) NOT NULL AUTO_INCREMENT,
  `ter_gen_id` int(11) NOT NULL,
  `ter_start_date` date NOT NULL,
  `ter_end_date` date NOT NULL,
  PRIMARY KEY (`ter_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `tbl_terms`
--


-- --------------------------------------------------------

--
-- Table structure for table `tbl_workloads`
--

CREATE TABLE IF NOT EXISTS `tbl_workloads` (
  `wor_tea_id` int(11) NOT NULL,
  `wor_cla_id` int(11) NOT NULL,
  `wor_description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_workloads`
--

