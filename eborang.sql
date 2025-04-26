-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Apr 26, 2025 at 06:41 PM
-- Server version: 8.3.0
-- PHP Version: 8.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `eborang`
--

-- --------------------------------------------------------

--
-- Table structure for table `log`
--

DROP TABLE IF EXISTS `log`;
CREATE TABLE IF NOT EXISTS `log` (
  `id` int NOT NULL AUTO_INCREMENT,
  `action` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `user_id` int DEFAULT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE IF NOT EXISTS `password_resets` (
  `id` int NOT NULL AUTO_INCREMENT,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `expires_at` timestamp NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permohonan`
--

DROP TABLE IF EXISTS `permohonan`;
CREATE TABLE IF NOT EXISTS `permohonan` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int DEFAULT NULL,
  `permohonan_type` text,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `status` int DEFAULT NULL,
  `reason` text,
  `days` int DEFAULT NULL,
  `time_slip` int DEFAULT NULL,
  `file` text,
  `place` text,
  `purpose` text,
  `lecturer_id` int DEFAULT NULL,
  `kb_id` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `permohonan`
--

INSERT INTO `permohonan` (`id`, `user_id`, `permohonan_type`, `created_at`, `status`, `reason`, `days`, `time_slip`, `file`, `place`, `purpose`, `lecturer_id`, `kb_id`) VALUES
(27, 1, 'pelepasan', '2025-04-25 02:50:14', 3, NULL, 2, 0, 'schedule_calendar.pdf', 'asd', 'asdas', 2, 4),
(28, 1, 'pelepasan', '2025-04-26 00:01:55', 3, NULL, 1, 0, 'schedule_calendar.pdf', 'asd', 'asdasd', 2, 4);

-- --------------------------------------------------------

--
-- Table structure for table `permohonan_dates`
--

DROP TABLE IF EXISTS `permohonan_dates`;
CREATE TABLE IF NOT EXISTS `permohonan_dates` (
  `id` int NOT NULL AUTO_INCREMENT,
  `permohonan_id` int DEFAULT NULL,
  `date` date DEFAULT NULL,
  `time_start` time DEFAULT NULL,
  `time_end` time DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=46 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `permohonan_dates`
--

INSERT INTO `permohonan_dates` (`id`, `permohonan_id`, `date`, `time_start`, `time_end`, `created_at`) VALUES
(45, 28, '2025-04-15', '00:00:00', '00:00:00', '2025-04-26 00:01:55'),
(44, 27, '2025-04-09', '00:00:00', '00:00:00', '2025-04-25 02:50:14'),
(43, 27, '2025-04-08', '00:00:00', '00:00:00', '2025-04-25 02:50:14');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `role` int NOT NULL,
  `image` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `role` (`role`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `role`, `image`, `created_at`) VALUES
(1, 'student', 'student@gmail.com', 'a8f5f167f44f4964e6c998dee827110c', 5, NULL, '2025-04-22 22:35:15'),
(2, 'lect', 'lect@gmail.com', 'a8f5f167f44f4964e6c998dee827110c', 3, NULL, '2025-04-22 22:35:15'),
(3, 'bppl', 'bppl@gmail.com', 'a8f5f167f44f4964e6c998dee827110c', 1, NULL, '2025-04-22 22:35:15'),
(4, 'kb', 'kb@gmail.com', 'a8f5f167f44f4964e6c998dee827110c', 2, NULL, '2025-04-22 22:35:15'),
(5, 'guard', 'guard@gmail.com', 'a8f5f167f44f4964e6c998dee827110c', 4, NULL, '2025-04-22 22:35:15');

-- --------------------------------------------------------

--
-- Table structure for table `user_details`
--

DROP TABLE IF EXISTS `user_details`;
CREATE TABLE IF NOT EXISTS `user_details` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `ic` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `image` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `phone` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `birth_date` date DEFAULT NULL,
  `ndp` text COLLATE utf8mb4_general_ci,
  `kursus` text COLLATE utf8mb4_general_ci,
  `semester` int DEFAULT NULL,
  `bengkel` text COLLATE utf8mb4_general_ci,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_details`
--

INSERT INTO `user_details` (`id`, `user_id`, `name`, `ic`, `image`, `phone`, `birth_date`, `ndp`, `kursus`, `semester`, `bengkel`) VALUES
(1, 1, 'asdsad', '123123', NULL, '01123881290', '2025-04-26', '12321', '12321', 321321, 'komputer'),
(2, 2, 'asdsad', '', NULL, '01123881290', NULL, NULL, NULL, NULL, 'komputer'),
(3, 4, 'asdsad', '', NULL, '011221313', NULL, NULL, NULL, NULL, 'komputer');

-- --------------------------------------------------------

--
-- Table structure for table `user_role`
--

DROP TABLE IF EXISTS `user_role`;
CREATE TABLE IF NOT EXISTS `user_role` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_role`
--

INSERT INTO `user_role` (`id`, `name`) VALUES
(1, 'bppl'),
(2, 'kb'),
(3, 'lecturer'),
(4, 'guard'),
(5, 'student');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`role`) REFERENCES `user_role` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `user_details`
--
ALTER TABLE `user_details`
  ADD CONSTRAINT `user_details_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
