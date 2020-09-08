-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 07, 2019 at 10:41 AM
-- Server version: 10.1.40-MariaDB
-- PHP Version: 7.1.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `timesheet`
--

-- --------------------------------------------------------

--
-- Table structure for table `assignment`
--

CREATE TABLE `assignment` (
  `project_name` varchar(100) NOT NULL,
  `task` varchar(50) NOT NULL,
  `emp_name` varchar(50) NOT NULL,
  `estimated` int(11) NOT NULL,
  `from_date` date NOT NULL,
  `to_date` date NOT NULL,
  `status` varchar(50) NOT NULL,
  `duration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `client_information`
--

CREATE TABLE `client_information` (
  `client_name` varchar(50) NOT NULL,
  `org_name` varchar(50) NOT NULL,
  `telephone` varchar(11) NOT NULL,
  `address` varchar(200) NOT NULL,
  `status` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `client_information`
--

INSERT INTO `client_information` (`client_name`, `org_name`, `telephone`, `address`, `status`) VALUES
('Aidan', 'Livefish Ltd', '97358589', '28, Nisi Road,New York', 'Active'),
('Christina Yang', 'Pixelberry', '91234567', '5th Cross Street,Washington D.C.', 'Active'),
('Marshall', 'Divanoodle LLP', '934975606', '56,Gravida Road,California', 'Active'),
('Theodore	', 'Wikido Inc.', '98764536', '470, Hendrerit Avenue,Florida', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `employee_information`
--

CREATE TABLE `employee_information` (
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `name` varchar(50) NOT NULL,
  `telephone` varchar(12) NOT NULL,
  `email` varchar(110) NOT NULL,
  `role` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `employee_information`
--

INSERT INTO `employee_information` (`username`, `password`, `name`, `telephone`, `email`, `role`) VALUES
('Izzy			', '1234', 'Izzy Eliasson', '983 985 0508', 'ieliasson4@gmail.com', 'Employee');

-- --------------------------------------------------------

--
-- Table structure for table `project_info`
--

CREATE TABLE `project_info` (
  `name` varchar(50) NOT NULL,
  `client_name` varchar(50) NOT NULL,
  `org_name` varchar(50) NOT NULL,
  `mail` varchar(50) NOT NULL,
  `contact` varchar(50) NOT NULL,
  `status` varchar(10) NOT NULL,
  `start` date NOT NULL,
  `end` date NOT NULL,
  `est_hours` int(11) NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `project_info`
--

INSERT INTO `project_info` (`name`, `client_name`, `org_name`, `mail`, `contact`, `status`, `start`, `end`, `est_hours`, `description`) VALUES
('A Chef kitchen game', 'Marshall', 'Divanoodle LLP', 'marshall@yahoo.com', '934975606', 'Active', '2019-06-01', '2019-08-31', 2000, 'A cooking based game by Divanoodle LLP, a tokyo based kitchen cooking game'),
('Choices-UI/UX makeover', 'Christina Yang', 'Pixelberry', 'YangChris@gmail.com', '91234567', 'Active', '2019-06-22', '2019-07-05', 200, 'Choices is an interactive storytelling game that enables users to change the story flow based on their choice ---They require an entire revamp of their app design'),
('DataBase Expansion', 'Theodore	', 'Wikido Inc.', 'Teddy@yahoo.com', '98764536', 'Completed', '2019-05-01', '2019-05-31', 300, 'Wikido is an information retrieval system, they require the services of our database administrators for expansion of our storage system'),
('Fishes Management System', 'Aidan', 'Livefish Ltd', 'aiden@gmail.com', '97358589', 'Active', '2019-06-01', '2019-06-30', 500, 'Livefish Ltd is an non-Profit Organisation aiming towards protecting varieties of fishes around the world.They Require a new database management system to maintain their fish content');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `assignment`
--
ALTER TABLE `assignment`
  ADD PRIMARY KEY (`project_name`,`task`),
  ADD KEY `emp_name` (`emp_name`);

--
-- Indexes for table `client_information`
--
ALTER TABLE `client_information`
  ADD PRIMARY KEY (`client_name`,`org_name`);

--
-- Indexes for table `employee_information`
--
ALTER TABLE `employee_information`
  ADD PRIMARY KEY (`name`);

--
-- Indexes for table `project_info`
--
ALTER TABLE `project_info`
  ADD PRIMARY KEY (`name`),
  ADD KEY `client_name` (`client_name`,`org_name`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `assignment`
--
ALTER TABLE `assignment`
  ADD CONSTRAINT `assignment_ibfk_1` FOREIGN KEY (`project_name`) REFERENCES `project_info` (`name`),
  ADD CONSTRAINT `assignment_ibfk_2` FOREIGN KEY (`emp_name`) REFERENCES `employee_information` (`name`);

--
-- Constraints for table `project_info`
--
ALTER TABLE `project_info`
  ADD CONSTRAINT `project_info_ibfk_1` FOREIGN KEY (`client_name`,`org_name`) REFERENCES `client_information` (`client_name`, `org_name`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
