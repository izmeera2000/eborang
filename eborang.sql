-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: May 15, 2025 at 10:53 PM
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
  `permohonan_type` text COLLATE utf8mb4_general_ci,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `status` int DEFAULT NULL,
  `reason` text COLLATE utf8mb4_general_ci,
  `days` int DEFAULT NULL,
  `time_slip` int DEFAULT NULL,
  `file` text COLLATE utf8mb4_general_ci,
  `place` text COLLATE utf8mb4_general_ci,
  `purpose` text COLLATE utf8mb4_general_ci,
  `lecturer_id` int DEFAULT NULL,
  `kb_id` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=57 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `permohonan`
--

INSERT INTO `permohonan` (`id`, `user_id`, `permohonan_type`, `created_at`, `status`, `reason`, `days`, `time_slip`, `file`, `place`, `purpose`, `lecturer_id`, `kb_id`) VALUES
(55, 1, 'perlepasan', '2025-05-11 07:57:50', 3, 'asd', 1, 0, 'images.png', 'test', 'test', 7, NULL),
(56, 6, 'perlepasan', '2025-05-11 07:57:50', 3, 'asd', 1, 0, 'images.png', 'test', 'test', 2, NULL);

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
) ENGINE=MyISAM AUTO_INCREMENT=74 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `permohonan_dates`
--

INSERT INTO `permohonan_dates` (`id`, `permohonan_id`, `date`, `time_start`, `time_end`, `created_at`) VALUES
(73, 56, '2025-05-15', '00:00:00', '00:00:00', '2025-05-11 07:57:50'),
(72, 55, '2025-05-15', '00:00:00', '00:00:00', '2025-05-11 07:57:50');

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
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `role` (`role`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `role`, `created_at`) VALUES
(1, 'student', 'student@gmail.com', '$2y$10$UHedN43A5Yl5ZmQ5AtQYLubdZ2uZ96wjPYvK6PN2ZFpw.WEKhnGBG', 5, '2025-04-22 22:35:15'),
(2, 'lect', 'lect@gmail.com', '$2y$10$UHedN43A5Yl5ZmQ5AtQYLubdZ2uZ96wjPYvK6PN2ZFpw.WEKhnGBG', 3, '2025-04-22 22:35:15'),
(3, 'bppl', 'bppl@gmail.com', '$2y$10$UHedN43A5Yl5ZmQ5AtQYLubdZ2uZ96wjPYvK6PN2ZFpw.WEKhnGBG', 1, '2025-04-22 22:35:15'),
(5, 'guard', 'guard@gmail.com', '$2y$10$UHedN43A5Yl5ZmQ5AtQYLubdZ2uZ96wjPYvK6PN2ZFpw.WEKhnGBG', 4, '2025-04-22 22:35:15'),
(6, 'test123', 'test@123.com.my', '$2y$10$UHedN43A5Yl5ZmQ5AtQYLubdZ2uZ96wjPYvK6PN2ZFpw.WEKhnGBG', 5, '2025-05-03 17:00:43'),
(7, 'test2123', 'test2@123.com.my', '$2y$10$UHedN43A5Yl5ZmQ5AtQYLubdZ2uZ96wjPYvK6PN2ZFpw.WEKhnGBG', 3, '2025-05-03 17:00:43'),
(8, 'student3', 'student3@gmail.com', '$2y$10$UHedN43A5Yl5ZmQ5AtQYLubdZ2uZ96wjPYvK6PN2ZFpw.WEKhnGBG', 5, '2025-05-15 11:20:51'),
(13, '', 'rosnani@adtectaiping.edu.my', '$2y$10$6Tx2T.83gJqrhbGky5rvi.n/RuQAHYDkf3eTa600UvUNAT.z3pOlq', 2, '2025-05-15 22:30:07'),
(14, '', 'fauziah@adtectaiping.edu.my', '$2y$10$KmS.tAfTFUKwsO1KLKAI/OCRu9pAGZykeJ7jLhvN9OZv32DF.cUkq', 3, '2025-05-15 22:39:58'),
(15, '', 'badrul@adtectaiping.edu.my', '$2y$10$79gFkAqZVucZAfPtsAJ1SuKfOzG2adZR/WJ8e14wt8ogJGnOfJQCK', 2, '2025-05-15 22:42:46');

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
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_details`
--

INSERT INTO `user_details` (`id`, `user_id`, `name`, `ic`, `image`, `phone`, `birth_date`, `ndp`, `kursus`, `semester`, `bengkel`) VALUES
(1, 1, 'asdsad', '123123', 'splash-1.png', '01123881290', '2025-04-26', '12321', '12321', NULL, 'komputer'),
(2, 2, 'lect', 'lec', NULL, '01123881290', NULL, NULL, NULL, NULL, 'komputer'),
(4, 6, 'test123', '12312321321', 'nopic.png', '1321321321', '2025-05-05', '123123', 'dtk', NULL, 'komputer'),
(5, 7, 'lect2', 'lec', NULL, '01123881290', NULL, NULL, NULL, NULL, 'meka'),
(6, 3, 'asda', '12312321', 'splash-2.png', '13212321312', '2025-05-17', 'NULL', 'NULL', 0, 'NULL'),
(8, 13, 'Siti Rosnani Binti Hussin', '12312321', 'images.png', '1231232', '2025-05-15', NULL, NULL, NULL, 'komputer'),
(9, 14, 'Fauziah Binti Muhammad', '990585142322', 'images.png', '1231232132', '2025-05-13', NULL, NULL, NULL, 'komputer'),
(10, 15, 'Mohd Badrul Hisham Bin Mamat', '12312311', 'images.png', '12321312321', '2025-05-17', NULL, NULL, NULL, 'mekatronik');

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
