-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jul 13, 2018 at 09:30 AM
-- Server version: 5.6.12-log
-- PHP Version: 5.4.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `cman`
--
CREATE DATABASE IF NOT EXISTS `cman` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `cman`;

-- --------------------------------------------------------

--
-- Table structure for table `activity_log`
--

CREATE TABLE IF NOT EXISTS `activity_log` (
  `activity_log_id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(100) NOT NULL,
  `date` varchar(100) NOT NULL,
  `action` varchar(128) NOT NULL,
  PRIMARY KEY (`activity_log_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=157 ;

--
-- Dumping data for table `activity_log`
--

INSERT INTO `activity_log` (`activity_log_id`, `username`, `date`, `action`) VALUES
(2, 'admin', '2017-01-11 10:19:34', 'Edited Member Kithinji'),
(3, 'admin', '2017-01-11 10:23:28', 'Edited Member Kithinji'),
(4, 'admin', '2017-01-11 10:26:45', 'Edited Member Kithinji'),
(5, 'admin', '2017-01-11 10:28:02', 'Edited Member Kithinji'),
(6, 'admin', '2017-01-11 10:29:31', 'Edited Member Kithinji'),
(7, 'admin', '2017-01-11 10:32:58', 'Edited Member Kithinji'),
(8, 'admin', '2017-01-11 10:33:24', 'Edited Member Kithinji'),
(11, 'admin', '2017-01-11 11:16:00', 'Edited Visitor Kithinji'),
(12, 'admin', '2017-01-11 19:19:32', 'Added member 0725873436'),
(13, 'admin', '2017-01-11 19:20:31', 'Added member 725873436'),
(14, '', '2017-01-12 06:05:26', 'Added member 00000000000'),
(15, '', '2017-02-15 05:54:40', 'Added member 0733997722'),
(16, 'admin', '2017-02-20 12:30:16', 'Edited member Kithinji'),
(17, '', '2018-03-15 21:38:47', 'Added member 0914196411'),
(18, 'admin', '2018-03-15 22:00:48', 'Added member 6464646'),
(19, 'admin', '2018-03-15 22:05:41', 'Add System User muler'),
(20, 'muler', '2018-03-16 10:47:05', 'Added member 0989'),
(21, 'muler', '2018-03-16 12:05:15', 'Added member 54564'),
(22, 'muler', '2018-03-16 16:39:57', 'Add System User 3232'),
(23, 'muler', '2018-03-16 16:40:53', 'Add System User student'),
(24, 'muler', '2018-03-16 16:41:13', 'Add System User teacher'),
(25, 'muler', '2018-03-16 16:41:36', 'Add System User manager'),
(26, 'muler', '2018-03-16 16:49:32', 'Added member 123456'),
(27, 'muler', '2018-03-19 09:53:07', 'Added member 123'),
(28, 'muler', '2018-03-19 10:53:44', 'Added member 0565'),
(29, 'muler', '2018-03-19 11:39:19', 'Added member 123456789'),
(30, 'muler', '2018-03-19 11:50:17', 'Added member 0914196411'),
(31, 'muler', '2018-03-19 11:52:15', 'Added member 123456'),
(32, 'muler', '2018-03-19 11:55:27', 'Added member 12'),
(33, 'muler', '2018-03-19 13:54:10', 'Added member 147'),
(34, 'muler', '2018-03-19 13:59:02', 'Added member 789'),
(35, 'muler', '2018-03-19 14:02:11', 'Added member 589'),
(36, 'muler', '2018-03-19 14:06:54', 'Added member 51'),
(37, 'muler', '2018-03-19 14:10:04', 'Added member 756'),
(38, 'muler', '2018-03-19 14:37:27', 'Added member 158'),
(39, 'muler', '2018-03-19 14:42:04', 'Added member 1478'),
(40, 'muler', '2018-03-19 14:42:45', 'Added member 47965'),
(41, 'muler', '2018-03-19 14:54:55', 'Added member 1254'),
(42, 'muler', '2018-03-19 15:18:57', 'Added member 147852'),
(43, 'muler', '2018-03-19 15:20:39', 'Edited member helu'),
(44, 'muler', '2018-03-19 15:21:43', 'Added member 347'),
(45, 'muler', '2018-03-19 21:46:30', 'Edited Visitor Kithinji'),
(46, 'muler', '2018-03-19 22:06:13', 'Edited Visitor Kithinji'),
(47, 'muler', '2018-03-19 22:08:58', 'Add System User lili'),
(48, 'muler', '2018-03-19 22:09:18', 'Edit system User lililili'),
(49, 'muler', '2018-03-20 14:17:43', 'Add System User lili'),
(50, 'muler', '2018-03-20 14:24:36', 'Edit system User teacher'),
(51, 'muler', '2018-03-20 14:26:27', 'Added member 159'),
(52, 'muler', '2018-03-20 14:58:16', 'Added member 753951'),
(53, 'muler', '2018-03-20 20:51:15', 'Added member 1234578'),
(54, 'muler', '2018-03-20 20:52:12', 'Added member 4785'),
(55, 'muler', '2018-03-20 20:54:13', 'Added member 789456'),
(56, 'muler', '2018-03-20 20:58:26', 'Added member 8596741'),
(57, 'muler', '2018-03-20 20:58:44', 'Added member 7895412'),
(58, 'muler', '2018-03-20 21:02:32', 'Add System User admin'),
(59, 'muler', '2018-03-20 21:44:23', 'Edited member Mulugeta'),
(60, 'muler', '2018-03-20 21:54:46', 'Edited member Mulugeta'),
(61, 'muler', '2018-03-20 21:56:03', 'Added member 1478521'),
(62, 'muler', '2018-03-20 21:56:32', 'Edited member kebede'),
(63, 'muler', '2018-03-20 22:01:08', 'Added member 896547'),
(64, 'muler', '2018-03-20 22:01:34', 'Edited member kiros'),
(65, 'muler', '2018-03-20 22:02:32', 'Edited member kiros'),
(66, 'muler', '2018-03-20 22:05:00', 'Added member 458796'),
(67, 'muler', '2018-03-20 22:05:32', 'Edited member yared'),
(68, 'muler', '2018-03-20 22:07:36', 'Added member 215489'),
(69, 'muler', '2018-03-20 22:08:37', 'Edited member Tsegay'),
(70, 'muler', '2018-03-20 22:17:11', 'Added member 15874'),
(71, 'muler', '2018-03-21 07:06:19', 'Added member 158746'),
(72, 'muler', '2018-03-21 07:06:52', 'Added member 4587921'),
(73, 'muler', '2018-03-21 07:07:14', 'Added member 87'),
(74, 'muler', '2018-03-21 07:07:36', 'Added member 15896'),
(75, 'muler', '2018-03-21 07:08:02', 'Added member 58964'),
(76, 'muler', '2018-03-21 07:08:54', 'Edited member alem'),
(77, 'muler', '2018-03-21 07:10:27', 'Edited member kebe'),
(78, 'muler', '2018-03-21 07:12:07', 'Edited member yy'),
(79, 'muler', '2018-03-21 07:13:21', 'Edited member yyyy'),
(80, 'muler', '2018-03-21 07:15:40', 'Edited member alem'),
(81, 'muler', '2018-03-21 07:27:35', 'Added member 48596'),
(82, 'muler', '2018-03-21 07:27:55', 'Edited member abebe kebe'),
(83, 'muler', '2018-03-21 10:16:27', 'Add System User bini'),
(84, 'muler', '2018-03-21 10:16:41', 'Edit system User bini Abdi'),
(85, 'muler', '2018-03-21 10:17:18', 'Added member 45879215'),
(86, 'muler', '2018-03-21 10:17:42', 'Edited member teka'),
(87, 'muler', '2018-03-21 10:44:32', 'Add System User misgo'),
(88, 'muler', '2018-03-21 10:44:50', 'Edit system User misganaw'),
(89, 'muler', '2018-03-21 10:45:58', 'Added member 145879'),
(90, 'muler', '2018-03-21 10:46:40', 'Edited member misgo'),
(91, 'muler', '2018-03-21 10:47:09', 'Edited member mn'),
(92, 'muler', '2018-03-21 11:07:01', 'Add System User eyassu'),
(93, 'muler', '2018-03-21 11:07:09', 'Edit system User eyassu12'),
(94, 'muler', '2018-03-22 09:52:36', 'Added member '),
(95, 'muler', '2018-03-22 09:54:07', 'Added member '),
(96, 'muler', '2018-03-22 09:55:17', 'Added member '),
(97, 'muler', '2018-03-22 10:00:30', 'Added member '),
(98, 'muler', '2018-03-22 10:14:05', 'Edited Visitor '),
(99, 'muler', '2018-03-22 12:08:17', 'Added member '),
(102, 'muler', '2018-03-22 12:28:05', 'Edited Visitor '),
(103, 'muler', '2018-03-22 12:28:50', 'Edited Visitor '),
(104, 'muler', '2018-03-22 12:35:56', 'Added member '),
(105, 'muler', '2018-03-22 12:36:09', 'Edited Visitor '),
(106, 'muler', '2018-03-22 15:21:24', 'Added member '),
(107, 'muler', '2018-03-22 15:21:47', 'Edited Visitor '),
(108, 'muler', '2018-03-23 08:58:36', 'Added member '),
(109, 'muler', '2018-03-23 08:58:51', 'Edited Visitor '),
(110, 'muler', '2018-03-23 08:58:51', 'Edited Visitor '),
(111, 'muler', '2018-03-23 09:14:53', 'Added member '),
(112, 'muler', '2018-03-23 09:15:14', 'Edited Visitor '),
(113, 'muler', '2018-03-23 09:17:49', 'Add System User seid'),
(114, 'muler', '2018-03-23 09:17:58', 'Edit system User seid M'),
(115, 'muler', '2018-03-23 11:33:37', 'Edited Visitor '),
(116, 'muler', '2018-03-23 11:33:56', 'Edited Visitor '),
(117, 'muler', '2018-03-23 12:12:50', 'Edited Visitor '),
(118, 'muler', '2018-03-23 12:14:49', 'Edited Visitor '),
(119, 'muler', '2018-03-23 12:15:06', 'Edited Visitor '),
(120, 'muler', '2018-03-23 12:15:38', 'Edited Visitor '),
(121, 'muler', '2018-03-23 13:34:50', 'Edited Visitor '),
(122, 'muler', '2018-03-23 13:58:51', 'Edited Visitor '),
(123, 'muler', '2018-03-23 14:09:56', 'Edited Visitor '),
(124, 'muler', '2018-03-23 14:17:26', 'Edit system User seid M'),
(125, 'muler', '2018-03-23 17:56:40', 'Added member 1478526'),
(126, 'muler', '2018-03-23 17:56:58', 'Edited member ata'),
(127, 'muler', '2018-03-24 20:35:51', 'Edited member mbn'),
(128, 'muler', '2018-03-24 20:38:14', 'Added member 549785'),
(129, 'muler', '2018-03-26 09:28:30', 'Edited Visitor '),
(130, 'muler', '2018-03-26 10:11:09', 'Edited Visitor '),
(131, 'muler', '2018-03-26 10:19:57', 'Edited Visitor '),
(132, 'muler', '2018-03-26 11:37:16', 'Added member '),
(133, 'muler', '2018-03-26 11:37:28', 'Edited Visitor '),
(134, 'muler', '2018-03-26 11:39:06', 'Edited Visitor '),
(135, 'muler', '2018-03-29 11:44:06', 'Added member 0985471'),
(136, 'muler', '2018-03-29 11:44:17', 'Edited member dasta'),
(137, 'muler', '2018-04-02 10:05:03', 'Added member 478512'),
(138, 'muler', '2018-04-02 10:05:30', 'Edited member Dro'),
(139, 'muler', '2018-06-11 17:05:13', 'Edited member mn'),
(140, 'muler', '2018-06-11 17:05:31', 'Edited member mn'),
(141, 'muler', '2018-06-11 17:05:56', 'Added member 0914196411'),
(142, 'muler', '2018-06-11 17:06:10', 'Edited member A'),
(143, 'muler', '2018-06-11 17:11:53', 'Edit system User mastawesh'),
(144, 'muler', '2018-06-11 17:12:52', 'Edited member kebede'),
(145, 'muler', '2018-06-15 08:08:46', 'Added member 0914196411'),
(146, 'muler', '2018-06-15 08:09:01', 'Edited member kentiba'),
(147, 'muler', '2018-06-16 06:50:26', 'Added member 123456789'),
(148, 'muler', '2018-06-16 07:39:46', 'Added member 1452'),
(149, 'muler', '2018-06-16 08:00:28', 'Added member 3545'),
(150, 'muler', '2018-06-16 08:05:02', 'Added member '),
(151, 'muler', '2018-06-16 08:07:57', 'Added member '),
(152, 'muler', '2018-06-16 08:15:05', 'Added member '),
(153, 'muler', '2018-06-16 08:52:09', 'Added member 7845'),
(154, 'muler', '2018-06-16 08:52:43', 'Edited member hussen'),
(155, 'muler', '2018-06-16 08:54:30', 'Added member '),
(156, 'muler', '2018-06-16 08:56:43', 'Add System User bini');

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE IF NOT EXISTS `admin` (
  `admin_id` int(128) NOT NULL AUTO_INCREMENT,
  `firstname` varchar(128) NOT NULL,
  `lastname` varchar(128) NOT NULL,
  `username` varchar(128) NOT NULL,
  `password` varchar(128) NOT NULL,
  `adminthumbnails` varchar(300) NOT NULL,
  PRIMARY KEY (`admin_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=15 ;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `firstname`, `lastname`, `username`, `password`, `adminthumbnails`) VALUES
(3, 'muler', 'muler', 'muler', 'muler123', 'uploads/logo.jpg'),
(14, 'bini', 'bini', 'bini', 'bini', 'images/NO-ImAGE-AVAILABLE.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `answers`
--

CREATE TABLE IF NOT EXISTS `answers` (
  `student_id` int(11) NOT NULL,
  `courses` varchar(150) NOT NULL,
  `qnumber` int(11) NOT NULL,
  `answer` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `answers`
--

INSERT INTO `answers` (`student_id`, `courses`, `qnumber`, `answer`) VALUES
(3545, 'java', 28, 'fami'),
(3545, 'java', 29, 'dfzdf'),
(3545, 'java', 30, 'excelent'),
(3545, 'java', 28, 'famij'),
(3545, 'java', 29, 'fdfds'),
(3545, 'java', 28, 'fami'),
(3545, 'java', 29, 'dsfsdf'),
(3545, 'java', 28, 'fami'),
(3545, 'java', 29, 'dfzdf'),
(3545, 'java', 28, 'fami'),
(3545, 'java', 29, 'czdfzx');

-- --------------------------------------------------------

--
-- Table structure for table `event`
--

CREATE TABLE IF NOT EXISTS `event` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `Title` text NOT NULL,
  `Date` date NOT NULL,
  `content` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `event`
--

INSERT INTO `event` (`id`, `Title`, `Date`, `content`) VALUES
(1, 'kenya', '2017-02-24', 'Prayer day'),
(2, 'geegeg', '2017-02-24', 'egegegeg'),
(3, 'kenya', '2017-02-24', 'd'),
(4, 'fgfgfgfgf', '2018-03-07', 'Eritrea');

-- --------------------------------------------------------

--
-- Table structure for table `giving`
--

CREATE TABLE IF NOT EXISTS `giving` (
  `givingid` int(10) NOT NULL AUTO_INCREMENT,
  `Amount` varchar(100) DEFAULT NULL,
  `Trcode` varchar(100) DEFAULT NULL,
  `paytime` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `na` varchar(10) DEFAULT NULL,
  `ya` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`givingid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `giving`
--

INSERT INTO `giving` (`givingid`, `Amount`, `Trcode`, `paytime`, `na`, `ya`) VALUES
(1, '1000', 'KKKSJKJS', '2016-10-23 16:13:02', '0725873436', 'Church Mission'),
(2, '2000', 'KAJHDJHJD', '2016-10-23 16:42:17', '0725873436', 'Mjengo'),
(4, '2000', 'KAJHDJHJD', '2016-10-23 16:47:43', '0725873436', 'Mjengo'),
(5, '5500', 'WEADADADD', '2017-01-11 07:35:31', '0725873436', 'Godfrey Kithinji'),
(6, '3000', 'ttytegfdg', '2017-01-11 07:38:41', '0725873436', 'Rent');

-- --------------------------------------------------------

--
-- Table structure for table `members`
--

CREATE TABLE IF NOT EXISTS `members` (
  `keyu` int(10) NOT NULL AUTO_INCREMENT,
  `fname` varchar(100) DEFAULT NULL,
  `sname` varchar(100) DEFAULT NULL,
  `lname` varchar(100) DEFAULT NULL,
  `Gender` varchar(100) DEFAULT NULL,
  `Birthday` varchar(100) DEFAULT NULL,
  `Residence` varchar(100) DEFAULT NULL,
  `pob` varchar(100) DEFAULT NULL,
  `ministry` varchar(100) DEFAULT NULL,
  `mobile` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `thumbnail` varchar(500) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `id` varchar(10) DEFAULT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`keyu`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `members`
--

INSERT INTO `members` (`keyu`, `fname`, `sname`, `lname`, `Gender`, `Birthday`, `Residence`, `pob`, `ministry`, `mobile`, `email`, `thumbnail`, `password`, `id`, `date`) VALUES
(1, 'Godfrey', 'Kithinji', 'Mutia', 'Male', '1992-02-24', 'Huruma', 'Meru', 'Praise and Worship', '0725873436', 'godkith@gmail.com', 'uploads/none.jpg', '1234', '0725873436', '2017-01-11 08:34:34'),
(3, 'SIMON', 'Obonyo', 'MUSAU', 'other', '1903-12-01', 'Kiambiu', 'Kiambuu', 'Praise and Worship', '0720571204', 'email', 'uploads/none.png', '1234', '0720571204', '2017-01-11 08:34:34'),
(4, 'Moses', 'Nkoitoi', 'Tiameti', 'Male', '1990-12-19', 'Kiambiu', 'Nairobi', 'Hostessing', '0723437369', 'godkde9@gmail.com', 'uploads/none.png', '0000', '0723437369', '2017-01-11 08:34:34'),
(5, 'GEOFFREY', 'Obonyo', 'MUSAU', 'Male', '2000-03-03', 'Kiambiu', 'Kiambuu', 'Ushering', '00000000000', 'kifrey24@gmail.com', 'uploads/none.png', '0000', '0000000000', '2017-01-12 03:05:26'),
(6, 'baraka', 'abraham', 'abraham', 'Male', '1987-01-16', 'kiambu', 'kiambu', 'Sunday School', '0733997722', 'barakaabraham@gmail.com', 'uploads/none.png', '0000', '0733997722', '2017-02-15 02:54:40');

-- --------------------------------------------------------

--
-- Table structure for table `offering`
--

CREATE TABLE IF NOT EXISTS `offering` (
  `offeringid` int(10) NOT NULL AUTO_INCREMENT,
  `examdesc` varchar(100) DEFAULT NULL,
  `questiondesc` varchar(100) DEFAULT NULL,
  `valueoptions` varchar(10) DEFAULT NULL,
  `valueoptionsb` varchar(50) NOT NULL,
  `valueoptionsc` varchar(50) NOT NULL,
  `valueoptionsd` varchar(50) NOT NULL,
  `questionanswer` varchar(100) NOT NULL,
  PRIMARY KEY (`offeringid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=30 ;

--
-- Dumping data for table `offering`
--

INSERT INTO `offering` (`offeringid`, `examdesc`, `questiondesc`, `valueoptions`, `valueoptionsb`, `valueoptionsc`, `valueoptionsd`, `questionanswer`) VALUES
(28, 'java', 'what is java', 'fami', 'famij', 'dsfsd', 'sportcafe', 'fami'),
(29, 'java', 'what is c++', 'czdfzx', 'dfzdf', 'fdfds', 'dsfsdf', 'csdfs');

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE IF NOT EXISTS `student` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`id`, `username`, `password`) VALUES
(1, 'stud', 'stud123');

-- --------------------------------------------------------

--
-- Table structure for table `sundays`
--

CREATE TABLE IF NOT EXISTS `sundays` (
  `keyu` int(10) NOT NULL AUTO_INCREMENT,
  `fname` varchar(100) DEFAULT NULL,
  `sname` varchar(100) DEFAULT NULL,
  `lname` varchar(100) DEFAULT NULL,
  `Gender` varchar(100) DEFAULT NULL,
  `Birthday` varchar(100) DEFAULT NULL,
  `Residence` varchar(100) DEFAULT NULL,
  `pob` varchar(100) DEFAULT NULL,
  `ministry` varchar(100) DEFAULT NULL,
  `mobile` varchar(100) DEFAULT NULL,
  `thumbnail` varchar(500) DEFAULT NULL,
  `id` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`keyu`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `sundays`
--

INSERT INTO `sundays` (`keyu`, `fname`, `sname`, `lname`, `Gender`, `Birthday`, `Residence`, `pob`, `ministry`, `mobile`, `thumbnail`, `id`) VALUES
(1, 'Godfrey', 'Kithinji', 'Kithinji', '', '2015-09-01', 'Nairobi', 'Nairobi', 'SoftMaven Technologies', '725873436', 'uploads/none.png', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `teens`
--

CREATE TABLE IF NOT EXISTS `teens` (
  `keyu` int(10) NOT NULL AUTO_INCREMENT,
  `fname` varchar(100) DEFAULT NULL,
  `sname` varchar(100) DEFAULT NULL,
  `lname` varchar(100) DEFAULT NULL,
  `Gender` varchar(100) DEFAULT NULL,
  `department` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `mobile` varchar(500) DEFAULT NULL,
  `id` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`keyu`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=42 ;

--
-- Dumping data for table `teens`
--

INSERT INTO `teens` (`keyu`, `fname`, `sname`, `lname`, `Gender`, `department`, `email`, `mobile`, `id`) VALUES
(20, 'Mulugeta', 'muler', 'Mulugeta', 'male', 'computer', 'mulugeta getachew', '4785', '4785'),
(22, 'baby', 'bb', 'bb', 'Female', 'accounting', 'bb@', '8596741', '8596741'),
(30, 'aa', 'df', 'gc', 'male', 'accounting', 'mulugeta getachew', '4587921', '4587921'),
(31, 'mbn', 'mbn', 'mbn', 'male', 'accounting', 'mulugeta@getachew', '87', '87'),
(32, 'mnjunnn', 'mn', 'mn', 'female', 'computer', 'muler.java@gmail.com', '15896', '15896'),
(35, 'bvbv', 'bvbv', 'bvb', 'male', 'computer', 'vb@cc', '549785', '549785'),
(37, 'kentiba', 'kentiba', 'kentiba', 'male', 'computer', 'muler.java@gmail.com', '0914196444', '0914196411'),
(38, 'ebs', 'ebs', 'ebs', 'male', 'computer', 'ebs@gmail.com', '123456789', '123456789'),
(39, 'temari', 'temari', 'temari', 'male', 'accounting', 'temari@gmail.com', '1452', '1452'),
(40, 'lili', 'lili', 'lili', 'Female', 'midwifery', 'lili@gmail.com', '3545', '3545'),
(41, 'fami', 'hussen', 'fami', 'male', 'computer', 'fami@gmail.com', '7845', '7845');

-- --------------------------------------------------------

--
-- Table structure for table `tithe`
--

CREATE TABLE IF NOT EXISTS `tithe` (
  `titheid` int(10) NOT NULL AUTO_INCREMENT,
  `Amount` varchar(100) DEFAULT NULL,
  `Trcode` varchar(100) DEFAULT NULL,
  `paytime` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `na` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`titheid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `tithe`
--

INSERT INTO `tithe` (`titheid`, `Amount`, `Trcode`, `paytime`, `na`) VALUES
(1, '1000', 'KMSMBNJDW', '2016-10-23 12:38:57', '0725873436'),
(2, '2000', 'KAJHDJHJD', '2016-10-23 16:52:58', '0725873436'),
(3, '8000', 'WEADADADD', '2017-01-11 06:57:26', '0725873436'),
(4, '100', 'cc', '2018-03-19 11:52:06', '1245'),
(5, '100100', 's', '2018-03-19 18:44:56', '123456789');

-- --------------------------------------------------------

--
-- Table structure for table `user_log`
--

CREATE TABLE IF NOT EXISTS `user_log` (
  `user_log_id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(25) NOT NULL,
  `login_date` varchar(30) NOT NULL,
  `logout_date` varchar(128) NOT NULL,
  `admin_id` int(128) NOT NULL,
  `student_id` varchar(128) NOT NULL,
  PRIMARY KEY (`user_log_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `visitor`
--

CREATE TABLE IF NOT EXISTS `visitor` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `examdesc` varchar(100) DEFAULT NULL,
  `startdate` date DEFAULT NULL,
  `enddate` date DEFAULT NULL,
  `duration` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=14 ;

--
-- Dumping data for table `visitor`
--

INSERT INTO `visitor` (`id`, `examdesc`, `startdate`, `enddate`, `duration`) VALUES
(13, 'java', '2018-06-06', '2018-06-06', 1);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
