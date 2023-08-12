-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Aug 12, 2023 at 07:01 AM
-- Server version: 8.0.31
-- PHP Version: 8.0.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `chat`
--

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

DROP TABLE IF EXISTS `messages`;
CREATE TABLE IF NOT EXISTS `messages` (
  `msg_id` int NOT NULL AUTO_INCREMENT,
  `incoming_msg_id` int NOT NULL,
  `outgoing_msg_id` int NOT NULL,
  `msg` varchar(1000) NOT NULL,
  PRIMARY KEY (`msg_id`)
) ENGINE=MyISAM AUTO_INCREMENT=119 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`msg_id`, `incoming_msg_id`, `outgoing_msg_id`, `msg`) VALUES
(112, 437575904, 362741651, 'hello'),
(111, 437575904, 362741651, 'hello'),
(110, 437575904, 362741651, 'hello'),
(109, 437575904, 362741651, 'hello'),
(108, 437575904, 362741651, 'hello'),
(107, 437575904, 362741651, 'hello'),
(106, 362741651, 437575904, 'hello'),
(105, 437575904, 362741651, 'no'),
(104, 455248255, 362741651, 'hello'),
(103, 437575904, 362741651, 'wha'),
(102, 437575904, 362741651, 'nice'),
(101, 437575904, 362741651, 'hello'),
(100, 437575904, 362741651, 'hello'),
(99, 437575904, 362741651, 'cool'),
(98, 362741651, 437575904, 'hello'),
(97, 362741651, 437575904, 'okay'),
(96, 362741651, 437575904, 'nice'),
(95, 362741651, 437575904, 'hello'),
(94, 362741651, 437575904, 'hello'),
(93, 362741651, 437575904, 'no bro what?'),
(92, 437575904, 362741651, 'nice'),
(91, 437575904, 362741651, 'hello'),
(113, 437575904, 362741651, 'nice!'),
(114, 362741651, 437575904, 'hi bro'),
(115, 362741651, 437575904, 'hello'),
(116, 362741651, 437575904, 'hello'),
(117, 437575904, 455248255, 'hello'),
(118, 362741651, 455248255, 'hello');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int NOT NULL AUTO_INCREMENT,
  `unique_id` int NOT NULL,
  `fname` varchar(255) NOT NULL,
  `lname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `image` varchar(400) NOT NULL,
  `status` varchar(255) NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=72 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `unique_id`, `fname`, `lname`, `email`, `password`, `image`, `status`) VALUES
(69, 437575904, 'Harsh', 'Deepanshu', 'harsh@gmail.com', 'harsh', 'Harsh_64d6ec929d19b.jpg', 'Offline now'),
(70, 362741651, 'zodiac', 'singh', 'root@gmail.com', 'root', 'zodiac_64d6ecc7b7d30.png', 'Offline now'),
(71, 455248255, 'Neal', 'Vadariya', 'neal@gmail.com', 'neal', 'Neal_64d70169e263e.jpg', 'Offline now');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
