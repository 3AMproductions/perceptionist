-- phpMyAdmin SQL Dump
-- version 4.7.3
-- https://www.phpmyadmin.net/
--
-- Host: perceptionist-db.3amproductions.net
-- Generation Time: Nov 21, 2017 at 06:27 PM
-- Server version: 5.6.34-log
-- PHP Version: 7.1.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `perceptionist`
--

-- --------------------------------------------------------

--
-- Table structure for table `call`
--

CREATE TABLE `call` (
  `call_id` int(11) NOT NULL,
  `company_id` int(11) DEFAULT NULL,
  `customer_id` int(11) DEFAULT NULL,
  `call_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `request` text,
  `resolved` tinyint(4) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `call`
--

INSERT INTO `call` (`call_id`, `company_id`, `customer_id`, `call_time`, `request`, `resolved`) VALUES
(1, 1, 3, '2006-01-04 05:09:36', 'Website redesign. This customer already has a website in place but thinks it\'s outdated. Now he wants a new design to keep them up to date and look modern.', 0),
(2, 1, 2, '2006-01-04 05:09:36', 'Brand redesign. Customer no longer likes the logo of his company and wants a new image to be presented to the customers.', 0),
(3, 1, 2, '2006-01-04 05:09:36', 'Site Proposal. Customer wants someone to come to his office and look over his site and how to make it more efficient. No need to redesign or write code, just wants to brainstorm.', 1),
(4, 1, 3, '2006-01-04 05:09:36', 'Whole new site. Customer has never had a website before. Wants one and heard of us on TV and so is calling to talk to owner.', 1),
(5, 1, 1, '2006-01-04 05:09:36', 'Website overhaul. Customer likes look and feel of her site but she wants the backend to be much more efficient. It has been years since the site has been written.', 0),
(6, 2, 3, '2006-01-04 05:09:36', 'Shrub Removed. There is a shrub that has been growing in his lawn for months and he has a party coming up this weekend and wants it gone by then.', 1),
(7, 2, 1, '2006-01-04 05:09:36', 'Tree Removed. Shrub removed. Customer has had both these in his backyard for far too long and wants them removed from sight.', 0),
(8, 2, 2, '2006-01-04 05:09:36', 'Customer has a tree that he wants to get mulched but doesn\'t know whther or not the whole thing has to be cut down or if you can just cut down the branches at the top and mulch those.', 0),
(9, 1, 2, '2006-01-04 05:09:36', 'CustomercalledandsaidthatJasoniscrazyforwantinganentrythathasnospacesandisatleast50characterslongandisalmostcompletelyunreadabble.Biteme.', 0),
(10, 3, 4, '2006-01-04 05:09:36', 'The hot water stopped working. Customer has no idea what it could be but in the middle of a shower the water became cold and has not been wam ever since.', 0);

-- --------------------------------------------------------

--
-- Table structure for table `company`
--

CREATE TABLE `company` (
  `company_id` int(11) NOT NULL,
  `company_name` varchar(50) DEFAULT NULL,
  `company_address` varchar(50) DEFAULT NULL,
  `company_city` varchar(30) DEFAULT NULL,
  `company_state` char(2) DEFAULT NULL,
  `company_zip` mediumint(5) DEFAULT NULL,
  `company_phone` varchar(17) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `company`
--

INSERT INTO `company` (`company_id`, `company_name`, `company_address`, `company_city`, `company_state`, `company_zip`, `company_phone`) VALUES
(1, '3AM Productions', '226 E Oakland Ave', 'Columbus', 'OH', 43201, '614-123-4567'),
(2, 'ABC Lawn Service', '12345 Any Street', 'Columbus', 'OH', 43230, '614-999-9999'),
(3, 'Tim\'s Plumbing Service', '3131 Pipeline Lane', 'New Albany', 'OH', 43054, '614-333-3232');

-- --------------------------------------------------------

--
-- Table structure for table `complaint`
--

CREATE TABLE `complaint` (
  `complaint_id` int(11) NOT NULL,
  `company_id` int(11) DEFAULT NULL,
  `customer_id` int(11) DEFAULT NULL,
  `employee_id` int(11) DEFAULT NULL,
  `complaint_type` tinyint(4) DEFAULT NULL,
  `complaint_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `complaint` text
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `complaint`
--

INSERT INTO `complaint` (`complaint_id`, `company_id`, `customer_id`, `employee_id`, `complaint_type`, `complaint_time`, `complaint`) VALUES
(1, 1, 2, 1, 1, '2005-06-08 23:43:50', 'Gil is the shizzle my nizzle, fo\' rizzle.'),
(2, 1, 3, 2, 2, '2005-06-08 23:39:23', 'My only problem with Jason is that he\'s not Gil. '),
(3, 1, 3, 2, 2, '2005-06-08 23:39:51', 'I\'ve got a fever and the only prescription is more Gil.'),
(4, 2, 3, 3, 1, '2005-06-08 23:41:18', 'This guy never cut the shrubs!'),
(5, 3, 4, 5, 2, '2005-06-08 23:42:24', 'Caller states that this employee cursed at her when she didn\'t understand what he was saying.');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `customer_id` int(11) NOT NULL,
  `fname` varchar(25) DEFAULT NULL,
  `mname` varchar(25) DEFAULT NULL,
  `lname` varchar(25) DEFAULT NULL,
  `address` varchar(50) DEFAULT NULL,
  `city` varchar(30) DEFAULT NULL,
  `state` char(2) DEFAULT NULL,
  `zip` mediumint(5) DEFAULT NULL,
  `phone` varchar(17) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`customer_id`, `fname`, `mname`, `lname`, `address`, `city`, `state`, `zip`, `phone`) VALUES
(1, 'John', NULL, 'Doe', '1199 Fernway Ct.', 'Columbus', 'OH', 43230, '614-111-1111'),
(2, 'Calvin', NULL, 'Broadus', '229 Crunkway Dr.', 'Galena', 'OH', 43210, '614-222-2222'),
(3, 'Carlos', 'Jesus', 'Santiago', '2248 Barrio Ave.', 'Johnstown', 'OH', 43233, '614-333-3333'),
(4, 'Phillip', 'Brandon', 'Webbingston', '5784 Wadsworth Way', 'Granville', 'OH', 43221, '740-444-4954'),
(5, 'Jason', 'R', 'Karns', '226 E Oakland Ave', 'Columbus', 'OH', 43201, '777-777-7777'),
(6, 'Tim', 'James', 'Robbins', '6554 Circle ave', 'Cagetown', 'OH', 45579, '614-777-7777'),
(7, 'Emmanuel', 'K', 'Kant', '455 Chartreuse Ave', 'Oklahoma City', 'OK', 98856, '965-554-7878'),
(8, 'John', 'Stuart', 'Mill', '5823 Libertarian Lane', 'Phoenix', 'AZ', 51236, '000-000-0000'),
(9, 'Jeremy', NULL, 'Bentham', '5656 Philo Lane', 'New Albany', 'OH', 43230, '614-445-9898');

-- --------------------------------------------------------

--
-- Table structure for table `customer_bio`
--

CREATE TABLE `customer_bio` (
  `customer_id` int(11) NOT NULL DEFAULT '0',
  `nickname` varchar(25) DEFAULT NULL,
  `birthday` date DEFAULT NULL,
  `hobbies` text,
  `misc` text
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customer_bio`
--

INSERT INTO `customer_bio` (`customer_id`, `nickname`, `birthday`, `hobbies`, `misc`) VALUES
(1, 'Johnny', '1972-08-14', 'Watching NFL football games', 'Johnny loves the Steelers and hates the Browns. He prefers personal assurance of quality and is not really impressed by figures and statistics.'),
(2, 'SnoopDogg', '1971-10-20', NULL, 'Calvin uses language that is sometimes innappropriate and some words he uses he made up himself.'),
(3, 'Carlito', '1961-03-14', 'Carlos watches soccer on tv all the time.', 'Carlos prefers speaking in Spanish if it\'s ever available.'),
(4, 'Phil', '1981-05-11', 'Avid reader of the Wall Street Journal.', NULL),
(5, 'Bobby', NULL, 'Computers and web programming with php and mysql', 'Likes to chat.'),
(6, 'TR', NULL, 'Listening to music all the time', 'Huge rock fan. Favorite movie is \"School of Rock\".'),
(7, 'Dr. Kant', NULL, 'Coming up with philisophical theories.', 'Be careful with words like \"should\" and \"ought\".'),
(8, 'Stuart', '1999-04-07', 'Coming up with great book dealing with government\'s role.', 'Avid Reader.'),
(9, 'Benthy', NULL, 'Philosophy', 'This guy has written quite a few books on philosophy. He enjoys when references are made to his books so it would be good to recognize that we know who he is.');

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE `employee` (
  `employee_id` int(11) NOT NULL,
  `company_id` int(11) DEFAULT NULL,
  `employee_fname` varchar(25) DEFAULT NULL,
  `employee_mname` varchar(25) DEFAULT NULL,
  `employee_lname` varchar(25) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`employee_id`, `company_id`, `employee_fname`, `employee_mname`, `employee_lname`) VALUES
(1, 1, 'Gilbert', 'Joseph', 'Velasquez'),
(2, 1, 'Jason', 'Robert', 'Karns'),
(3, 2, 'Sam', NULL, 'Johnansen'),
(4, 3, 'Tim', NULL, 'Smith'),
(5, 3, 'Mark', 'Adam', 'Ruffinger'),
(6, 3, 'Christopher', 'Thomas', 'Moneymaker');

-- --------------------------------------------------------

--
-- Table structure for table `flow`
--

CREATE TABLE `flow` (
  `call_id` int(11) NOT NULL DEFAULT '0',
  `employee_id` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `flow`
--

INSERT INTO `flow` (`call_id`, `employee_id`) VALUES
(1, 1),
(2, 2),
(3, 2),
(4, 1),
(4, 2),
(5, 1),
(6, 3),
(7, 3),
(8, 3),
(9, 2),
(10, 4),
(10, 6);

-- --------------------------------------------------------

--
-- Table structure for table `information`
--

CREATE TABLE `information` (
  `information_id` int(11) NOT NULL,
  `company_id` int(11) DEFAULT NULL,
  `customer_id` int(11) DEFAULT NULL,
  `information_type` tinyint(4) DEFAULT NULL,
  `information_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `information` text
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `information`
--

INSERT INTO `information` (`information_id`, `company_id`, `customer_id`, `information_type`, `information_time`, `information`) VALUES
(1, 1, 3, 1, '2005-06-08 23:50:51', 'How you make  3AM be such a muy bueno company?'),
(2, 2, 2, 1, '2005-06-08 23:51:39', 'How get them little shrizzubs to grizzow?'),
(3, 3, 4, 1, '2005-06-08 23:52:35', 'Customer wanted to know what year the compnay was founded. He wants an experienced company.');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `call`
--
ALTER TABLE `call`
  ADD PRIMARY KEY (`call_id`);

--
-- Indexes for table `company`
--
ALTER TABLE `company`
  ADD PRIMARY KEY (`company_id`);

--
-- Indexes for table `complaint`
--
ALTER TABLE `complaint`
  ADD PRIMARY KEY (`complaint_id`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`customer_id`);

--
-- Indexes for table `customer_bio`
--
ALTER TABLE `customer_bio`
  ADD PRIMARY KEY (`customer_id`);

--
-- Indexes for table `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`employee_id`);

--
-- Indexes for table `flow`
--
ALTER TABLE `flow`
  ADD PRIMARY KEY (`call_id`,`employee_id`);

--
-- Indexes for table `information`
--
ALTER TABLE `information`
  ADD PRIMARY KEY (`information_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `call`
--
ALTER TABLE `call`
  MODIFY `call_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `company`
--
ALTER TABLE `company`
  MODIFY `company_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `complaint`
--
ALTER TABLE `complaint`
  MODIFY `complaint_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `customer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `employee`
--
ALTER TABLE `employee`
  MODIFY `employee_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `information`
--
ALTER TABLE `information`
  MODIFY `information_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
