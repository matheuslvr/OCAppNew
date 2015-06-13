-- phpMyAdmin SQL Dump
-- version 4.4.3
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jun 13, 2015 at 03:52 AM
-- Server version: 5.6.24
-- PHP Version: 5.6.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `ocAppDB`
--

-- --------------------------------------------------------

--
-- Table structure for table `Category`
--

CREATE TABLE IF NOT EXISTS `Category` (
  `category_id` int(11) NOT NULL,
  `category_description` text NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Category`
--

INSERT INTO `Category` (`category_id`, `category_description`) VALUES
(1, 'Category1'),
(2, 'Category2');

-- --------------------------------------------------------

--
-- Table structure for table `Task`
--

CREATE TABLE IF NOT EXISTS `Task` (
  `task_id` int(11) NOT NULL,
  `task_name` text NOT NULL,
  `task_type_id` int(11) NOT NULL,
  `task_description` text NOT NULL,
  `task_time` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `task_date` date NOT NULL,
  `task_status_id` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Task`
--

INSERT INTO `Task` (`task_id`, `task_name`, `task_type_id`, `task_description`, `task_time`, `category_id`, `task_date`, `task_status_id`) VALUES
(1, 'Task1', 1, 'Task1Description', 20, 1, '2015-06-01', 1),
(2, 'Task2', 2, 'Task2Description', 40, 2, '2015-06-03', 2);

-- --------------------------------------------------------

--
-- Table structure for table `Task_status`
--

CREATE TABLE IF NOT EXISTS `Task_status` (
  `task_status_id` int(11) NOT NULL,
  `task_status_description` text NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Task_status`
--

INSERT INTO `Task_status` (`task_status_id`, `task_status_description`) VALUES
(1, 'To do'),
(2, 'In Progress'),
(3, 'Done');

-- --------------------------------------------------------

--
-- Table structure for table `Task_type`
--

CREATE TABLE IF NOT EXISTS `Task_type` (
  `task_type_id` int(11) NOT NULL,
  `task_type_description` text NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Task_type`
--

INSERT INTO `Task_type` (`task_type_id`, `task_type_description`) VALUES
(1, 'TaskType1'),
(2, 'TaskType2');

-- --------------------------------------------------------

--
-- Table structure for table `Team`
--

CREATE TABLE IF NOT EXISTS `Team` (
  `team_id` int(11) NOT NULL,
  `team_description` text NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Team`
--

INSERT INTO `Team` (`team_id`, `team_description`) VALUES
(1, 'Team1'),
(2, 'Team2');

-- --------------------------------------------------------

--
-- Table structure for table `User`
--

CREATE TABLE IF NOT EXISTS `User` (
  `user_id` int(11) NOT NULL,
  `user_login` text NOT NULL,
  `user_password` text NOT NULL,
  `user_first_name` text NOT NULL,
  `user_last_name` text NOT NULL,
  `user_type_id` int(11) NOT NULL,
  `user_tel` text,
  `user_mail` text NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `User`
--

INSERT INTO `User` (`user_id`, `user_login`, `user_password`, `user_first_name`, `user_last_name`, `user_type_id`, `user_tel`, `user_mail`) VALUES
(1, 'admin', '*4ACFE3202A5FF5CF467898FC58AAB1D615029441', 'Admin', 'Admin', 1, '0000000000', 'admin@admin.com'),
(2, 'manager', '*7D2ABFF56C15D67445082FBB4ACD2DCD26C0ED57', 'Manager', 'Manager', 2, '1111111111', 'manager@manager.com'),
(3, 'teammember', '*2EA75752B55BD59CF97094DCAA594A11BABB21D7', 'Teammember', 'Teammember', 3, '22222222222', 'teammember@teammember.com');

-- --------------------------------------------------------

--
-- Table structure for table `User_task`
--

CREATE TABLE IF NOT EXISTS `User_task` (
  `user_task_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `task_id` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `User_task`
--

INSERT INTO `User_task` (`user_task_id`, `user_id`, `task_id`) VALUES
(1, 2, 1),
(2, 3, 2);

-- --------------------------------------------------------

--
-- Table structure for table `User_team`
--

CREATE TABLE IF NOT EXISTS `User_team` (
  `user_team_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `team_id` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `User_team`
--

INSERT INTO `User_team` (`user_team_id`, `user_id`, `team_id`) VALUES
(1, 1, 1),
(2, 2, 2),
(3, 3, 1);

-- --------------------------------------------------------

--
-- Table structure for table `User_type`
--

CREATE TABLE IF NOT EXISTS `User_type` (
  `user_type_id` int(11) NOT NULL,
  `user_type_description` text NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `User_type`
--

INSERT INTO `User_type` (`user_type_id`, `user_type_description`) VALUES
(1, 'Administrator'),
(2, 'Manager'),
(3, 'Team Member');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Category`
--
ALTER TABLE `Category`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `Task`
--
ALTER TABLE `Task`
  ADD PRIMARY KEY (`task_id`);

--
-- Indexes for table `Task_status`
--
ALTER TABLE `Task_status`
  ADD PRIMARY KEY (`task_status_id`);

--
-- Indexes for table `Task_type`
--
ALTER TABLE `Task_type`
  ADD PRIMARY KEY (`task_type_id`);

--
-- Indexes for table `Team`
--
ALTER TABLE `Team`
  ADD PRIMARY KEY (`team_id`),
  ADD UNIQUE KEY `team_id` (`team_id`);

--
-- Indexes for table `User`
--
ALTER TABLE `User`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `User_task`
--
ALTER TABLE `User_task`
  ADD PRIMARY KEY (`user_task_id`);

--
-- Indexes for table `User_team`
--
ALTER TABLE `User_team`
  ADD PRIMARY KEY (`user_team_id`);

--
-- Indexes for table `User_type`
--
ALTER TABLE `User_type`
  ADD PRIMARY KEY (`user_type_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `Category`
--
ALTER TABLE `Category`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `Task`
--
ALTER TABLE `Task`
  MODIFY `task_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `Task_status`
--
ALTER TABLE `Task_status`
  MODIFY `task_status_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `Task_type`
--
ALTER TABLE `Task_type`
  MODIFY `task_type_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `Team`
--
ALTER TABLE `Team`
  MODIFY `team_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `User`
--
ALTER TABLE `User`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `User_task`
--
ALTER TABLE `User_task`
  MODIFY `user_task_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `User_team`
--
ALTER TABLE `User_team`
  MODIFY `user_team_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `User_type`
--
ALTER TABLE `User_type`
  MODIFY `user_type_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
