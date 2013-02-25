-- phpMyAdmin SQL Dump
-- version 2.11.6
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jan 27, 2012 at 07:51 AM
-- Server version: 5.0.51
-- PHP Version: 5.2.6

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

CREATE TABLE `tbl_attendances` (
  `att_id` int(11) NOT NULL auto_increment,
  `att_stu_id` int(11) NOT NULL,
  `att_absent` int(11) NOT NULL,
  `att_date` date NOT NULL,
  `att_attended` int(11) NOT NULL,
  `att_description` text NOT NULL,
  PRIMARY KEY  (`att_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `tbl_attendances`
--


-- --------------------------------------------------------

--
-- Table structure for table `tbl_classes`
--

CREATE TABLE `tbl_classes` (
  `cla_id` int(11) NOT NULL auto_increment,
  `cla_name` varchar(250) NOT NULL,
  `cla_student_number` int(11) NOT NULL,
  `cla_time` time NOT NULL,
  `cla_description` text NOT NULL,
  `cla_age_leval` int(11) NOT NULL,
  `cla_gen_id` int(11) NOT NULL,
  PRIMARY KEY  (`cla_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `tbl_classes`
--


-- --------------------------------------------------------

--
-- Table structure for table `tbl_concerns`
--

CREATE TABLE `tbl_concerns` (
  `con_id` int(11) NOT NULL auto_increment,
  `con_stu_id` int(11) NOT NULL,
  `con_unfocused` varchar(250) NOT NULL,
  `con_disruptive` varchar(250) NOT NULL,
  `con_withdrawn` varchar(250) NOT NULL,
  `con_improved` varchar(250) NOT NULL,
  `con_other_comment` text NOT NULL,
  PRIMARY KEY  (`con_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `tbl_concerns`
--


-- --------------------------------------------------------

--
-- Table structure for table `tbl_generations`
--

CREATE TABLE `tbl_generations` (
  `gen_id` int(11) NOT NULL auto_increment,
  `gen_year` int(11) NOT NULL,
  `gen_description` text NOT NULL,
  PRIMARY KEY  (`gen_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `tbl_generations`
--


-- --------------------------------------------------------

--
-- Table structure for table `tbl_ngos`
--

CREATE TABLE `tbl_ngos` (
  `ngo_id` int(11) NOT NULL auto_increment,
  `ngo_name` varchar(250) NOT NULL,
  `ngo_address` text NOT NULL,
  `ngo_contact_person` varchar(250) NOT NULL,
  `ngo_url` varchar(250) NOT NULL,
  `ngo_email` varchar(250) NOT NULL,
  `ngo_description` text NOT NULL,
  PRIMARY KEY  (`ngo_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `tbl_ngos`
--


-- --------------------------------------------------------

--
-- Table structure for table `tbl_scores`
--

CREATE TABLE `tbl_scores` (
  `sco_id` int(11) NOT NULL auto_increment,
  `sco_stu_id` int(11) NOT NULL,
  `sco_effort` double NOT NULL,
  `sco_pe` double NOT NULL,
  `sco_progress` double NOT NULL,
  `sco_exam` double NOT NULL,
  `sco_total` double NOT NULL,
  `sco_ter_id` int(11) NOT NULL,
  PRIMARY KEY  (`sco_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `tbl_scores`
--


-- --------------------------------------------------------

--
-- Table structure for table `tbl_students`
--

CREATE TABLE `tbl_students` (
  `stu_id` int(11) NOT NULL auto_increment,
  `stu_khmer_name` varchar(250) NOT NULL,
  `stu_first_name` varchar(250) NOT NULL,
  `stu_last_name` varchar(250) NOT NULL,
  `stu_sex` varchar(10) NOT NULL,
  `stu_dob` date NOT NULL,
  `stu_age` int(11) NOT NULL,
  `stu_ngo_id` int(11) NOT NULL,
  PRIMARY KEY  (`stu_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `tbl_students`
--


-- --------------------------------------------------------

--
-- Table structure for table `tbl_teachers`
--

CREATE TABLE `tbl_teachers` (
  `tea_id` int(11) NOT NULL auto_increment,
  `tea_name` varchar(250) NOT NULL,
  `tea_sex` varchar(10) NOT NULL,
  `tea_phone` varchar(250) NOT NULL,
  `tea_address` text NOT NULL,
  `tea_email` varchar(250) NOT NULL,
  `tea_description` text NOT NULL,
  `tea_position` varchar(250) NOT NULL,
  `tea_password` varchar(250) NOT NULL,
  PRIMARY KEY  (`tea_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `tbl_teachers`
--

INSERT INTO `tbl_teachers` (`tea_id`, `tea_name`, `tea_sex`, `tea_phone`, `tea_address`, `tea_email`, `tea_description`, `tea_position`, `tea_password`) VALUES
(1, 'admin', 'admin', 'admin', 'admin', 'admin', 'admin', 'admin', '21232f297a57a5a743894a0e4a801fc3');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_terms`
--

CREATE TABLE `tbl_terms` (
  `tem_id` int(11) NOT NULL auto_increment,
  `tem_gen_id` int(11) NOT NULL,
  `tem_start_date` date NOT NULL,
  `tem_end_date` date NOT NULL,
  PRIMARY KEY  (`tem_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `tbl_terms`
--


-- --------------------------------------------------------

--
-- Table structure for table `tbl_workloads`
--

CREATE TABLE `tbl_workloads` (
  `wor_tea_id` int(11) NOT NULL,
  `wor_cla_id` int(11) NOT NULL,
  `wor_description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_workloads`
--

