-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jul 23, 2015 at 02:32 PM
-- Server version: 5.6.21
-- PHP Version: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `jamesmchughadmin`
--

-- --------------------------------------------------------

--
-- Table structure for table `cards`
--

CREATE TABLE IF NOT EXISTS `cards` (
`card_id` int(11) NOT NULL,
  `company_id` int(11) NOT NULL,
  `card_name` varchar(50) NOT NULL,
  `card_number` varchar(20) NOT NULL,
  `issue_number` varchar(3) DEFAULT NULL,
  `card_type` varchar(20) NOT NULL,
  `start_date_month` varchar(2) NOT NULL,
  `start_date_year` varchar(4) NOT NULL,
  `expiry_date_month` varchar(2) NOT NULL,
  `expiry_date_year` varchar(4) NOT NULL,
  `account_number` varchar(10) NOT NULL,
  `sort_code1` varchar(2) NOT NULL,
  `sort_code2` varchar(2) NOT NULL,
  `sort_code3` varchar(2) NOT NULL,
  `security_code` varchar(3) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cards`
--

INSERT INTO `cards` (`card_id`, `company_id`, `card_name`, `card_number`, `issue_number`, `card_type`, `start_date_month`, `start_date_year`, `expiry_date_month`, `expiry_date_year`, `account_number`, `sort_code1`, `sort_code2`, `sort_code3`, `security_code`) VALUES
(1, 1, 'Mr James McHugh', '4134313213213135', '000', 'Visa', '02', '2010', '02', '2018', '1654654545', '45', '45', '52', '253');

-- --------------------------------------------------------

--
-- Table structure for table `companies`
--

CREATE TABLE IF NOT EXISTS `companies` (
`company_id` int(11) NOT NULL,
  `company_name` varchar(200) NOT NULL,
  `profession` varchar(100) NOT NULL,
  `address_1` varchar(150) NOT NULL,
  `address_2` varchar(150) NOT NULL,
  `city` varchar(100) NOT NULL,
  `county` varchar(100) NOT NULL,
  `country` varchar(100) NOT NULL,
  `postcode` varchar(20) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `companies`
--

INSERT INTO `companies` (`company_id`, `company_name`, `profession`, `address_1`, `address_2`, `city`, `county`, `country`, `postcode`) VALUES
(1, 'reece brothers', 'computing', 'Flat 7, 7 Atlingworth Street', '', 'Brighton', 'East Sussex', 'United Kingdom', 'BN2 1PL');

-- --------------------------------------------------------

--
-- Table structure for table `full_databases`
--

CREATE TABLE IF NOT EXISTS `full_databases` (
`full_database_id` int(11) NOT NULL,
  `project_id` int(11) NOT NULL,
  `project_details` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `full_websites`
--

CREATE TABLE IF NOT EXISTS `full_websites` (
`full_website_id` int(11) NOT NULL,
  `project_id` int(11) NOT NULL,
  `pages_known` tinyint(1) NOT NULL,
  `no_of_pages` int(11) DEFAULT NULL,
  `fully_responsive` tinyint(1) NOT NULL,
  `desktop_only` tinyint(1) NOT NULL,
  `tablet_only` tinyint(1) NOT NULL,
  `mobile_only` tinyint(1) NOT NULL,
  `full_website_details` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `graphics`
--

CREATE TABLE IF NOT EXISTS `graphics` (
`graphics_id` int(11) NOT NULL,
  `project_id` int(11) NOT NULL,
  `graphics_details` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `logos`
--

CREATE TABLE IF NOT EXISTS `logos` (
`logo_id` int(11) NOT NULL,
  `project_id` int(11) NOT NULL,
  `logo_details` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `notes`
--

CREATE TABLE IF NOT EXISTS `notes` (
`note_id` int(11) NOT NULL,
  `project_id` int(11) NOT NULL,
  `note` text NOT NULL,
  `date_created` date NOT NULL,
  `time_created` time NOT NULL,
  `created_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `partial_databases`
--

CREATE TABLE IF NOT EXISTS `partial_databases` (
`partial_database_id` int(11) NOT NULL,
  `project_id` int(11) NOT NULL,
  `partial_database_details` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `partial_websites`
--

CREATE TABLE IF NOT EXISTS `partial_websites` (
`partial_website_id` int(11) NOT NULL,
  `project_id` int(11) NOT NULL,
  `partial_website_details` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `projects`
--

CREATE TABLE IF NOT EXISTS `projects` (
`project_id` int(11) NOT NULL,
  `company_id` int(11) NOT NULL,
  `project_name` varchar(100) NOT NULL,
  `full_website` tinyint(1) NOT NULL,
  `partial_website` tinyint(1) NOT NULL,
  `full_database` tinyint(1) NOT NULL,
  `partial_database` tinyint(1) NOT NULL,
  `logos` tinyint(1) NOT NULL,
  `graphics` tinyint(1) NOT NULL,
  `project_details` text NOT NULL,
  `due_date_of_completion` date NOT NULL,
  `actual_date_of_completion` date NOT NULL,
  `cost` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
`user_id` int(11) NOT NULL,
  `company_id` int(11) NOT NULL,
  `email_address` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `title` varchar(10) NOT NULL,
  `forename` varchar(50) NOT NULL,
  `surname` varchar(100) NOT NULL,
  `job_title` varchar(150) NOT NULL,
  `department` varchar(100) DEFAULT NULL,
  `landline_prefix` varchar(5) DEFAULT NULL,
  `landline_number` varchar(20) NOT NULL,
  `mobile_prefix` varchar(5) DEFAULT NULL,
  `mobile_number` varchar(20) DEFAULT NULL,
  `fax_prefix` varchar(5) DEFAULT NULL,
  `fax_number` varchar(20) DEFAULT NULL,
  `legal_check` tinyint(1) NOT NULL,
  `data_check` tinyint(1) NOT NULL,
  `user_level` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `company_id`, `email_address`, `password`, `title`, `forename`, `surname`, `job_title`, `department`, `landline_prefix`, `landline_number`, `mobile_prefix`, `mobile_number`, `fax_prefix`, `fax_number`, `legal_check`, `data_check`, `user_level`) VALUES
(1, 1, 'james.mchugh1988@gmail.com', '$2y$10$ZDQyYTI0N2RiMGI3NDBkMOjJUv3obvU41fIRKoR/52Mvd3BwPq7KO', 'Mr', 'James', 'McHugh', 'programmer', 'media', '44', '156465', '44', '44', '44', '0', 1, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `user_levels`
--

CREATE TABLE IF NOT EXISTS `user_levels` (
`user_level_id` int(11) NOT NULL,
  `user_level` varchar(100) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_levels`
--

INSERT INTO `user_levels` (`user_level_id`, `user_level`) VALUES
(1, 'Admin'),
(2, 'High'),
(4, 'Low'),
(3, 'Medium'),
(5, 'Trainee');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cards`
--
ALTER TABLE `cards`
 ADD PRIMARY KEY (`card_id`,`company_id`,`card_type`), ADD KEY `cards_ibfk_1` (`company_id`);

--
-- Indexes for table `companies`
--
ALTER TABLE `companies`
 ADD PRIMARY KEY (`company_id`);

--
-- Indexes for table `full_databases`
--
ALTER TABLE `full_databases`
 ADD PRIMARY KEY (`full_database_id`,`project_id`), ADD KEY `project_id` (`project_id`);

--
-- Indexes for table `full_websites`
--
ALTER TABLE `full_websites`
 ADD PRIMARY KEY (`full_website_id`,`project_id`), ADD KEY `project_id` (`project_id`);

--
-- Indexes for table `graphics`
--
ALTER TABLE `graphics`
 ADD PRIMARY KEY (`graphics_id`,`project_id`), ADD KEY `project_id` (`project_id`);

--
-- Indexes for table `logos`
--
ALTER TABLE `logos`
 ADD PRIMARY KEY (`logo_id`,`project_id`), ADD KEY `project_id` (`project_id`);

--
-- Indexes for table `notes`
--
ALTER TABLE `notes`
 ADD PRIMARY KEY (`note_id`,`project_id`), ADD KEY `project_id` (`project_id`);

--
-- Indexes for table `partial_databases`
--
ALTER TABLE `partial_databases`
 ADD PRIMARY KEY (`partial_database_id`);

--
-- Indexes for table `partial_websites`
--
ALTER TABLE `partial_websites`
 ADD PRIMARY KEY (`partial_website_id`,`project_id`), ADD KEY `project_id` (`project_id`);

--
-- Indexes for table `projects`
--
ALTER TABLE `projects`
 ADD PRIMARY KEY (`project_id`,`company_id`), ADD KEY `company_id` (`company_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
 ADD PRIMARY KEY (`user_id`,`company_id`), ADD KEY `user_level` (`user_level`), ADD KEY `company_id` (`company_id`);

--
-- Indexes for table `user_levels`
--
ALTER TABLE `user_levels`
 ADD PRIMARY KEY (`user_level_id`), ADD KEY `user_level` (`user_level`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cards`
--
ALTER TABLE `cards`
MODIFY `card_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `companies`
--
ALTER TABLE `companies`
MODIFY `company_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `full_databases`
--
ALTER TABLE `full_databases`
MODIFY `full_database_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `full_websites`
--
ALTER TABLE `full_websites`
MODIFY `full_website_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `graphics`
--
ALTER TABLE `graphics`
MODIFY `graphics_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `logos`
--
ALTER TABLE `logos`
MODIFY `logo_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `notes`
--
ALTER TABLE `notes`
MODIFY `note_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `partial_databases`
--
ALTER TABLE `partial_databases`
MODIFY `partial_database_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `partial_websites`
--
ALTER TABLE `partial_websites`
MODIFY `partial_website_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `projects`
--
ALTER TABLE `projects`
MODIFY `project_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `user_levels`
--
ALTER TABLE `user_levels`
MODIFY `user_level_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `cards`
--
ALTER TABLE `cards`
ADD CONSTRAINT `cards_ibfk_1` FOREIGN KEY (`company_id`) REFERENCES `companies` (`company_id`);

--
-- Constraints for table `full_databases`
--
ALTER TABLE `full_databases`
ADD CONSTRAINT `full_databases_ibfk_1` FOREIGN KEY (`project_id`) REFERENCES `projects` (`project_id`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `full_websites`
--
ALTER TABLE `full_websites`
ADD CONSTRAINT `full_websites_ibfk_1` FOREIGN KEY (`project_id`) REFERENCES `projects` (`project_id`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `graphics`
--
ALTER TABLE `graphics`
ADD CONSTRAINT `graphics_ibfk_1` FOREIGN KEY (`project_id`) REFERENCES `projects` (`project_id`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `logos`
--
ALTER TABLE `logos`
ADD CONSTRAINT `logos_ibfk_1` FOREIGN KEY (`project_id`) REFERENCES `projects` (`project_id`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `notes`
--
ALTER TABLE `notes`
ADD CONSTRAINT `notes_ibfk_1` FOREIGN KEY (`project_id`) REFERENCES `projects` (`project_id`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `partial_websites`
--
ALTER TABLE `partial_websites`
ADD CONSTRAINT `partial_websites_ibfk_1` FOREIGN KEY (`project_id`) REFERENCES `projects` (`project_id`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `projects`
--
ALTER TABLE `projects`
ADD CONSTRAINT `projects_ibfk_1` FOREIGN KEY (`company_id`) REFERENCES `companies` (`company_id`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`company_id`) REFERENCES `companies` (`company_id`),
ADD CONSTRAINT `users_ibfk_3` FOREIGN KEY (`user_level`) REFERENCES `user_levels` (`user_level_id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
