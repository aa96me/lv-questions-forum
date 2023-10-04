-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Oct 04, 2023 at 05:53 PM
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
-- Database: `lv-forum-db`
--

-- --------------------------------------------------------

--
-- Table structure for table `answers`
--

DROP TABLE IF EXISTS `answers`;
CREATE TABLE IF NOT EXISTS `answers` (
  `id` int NOT NULL AUTO_INCREMENT,
  `question_id` int NOT NULL,
  `writer` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `user_id` int NOT NULL,
  `comment` mediumtext CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `status` int NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `answers`
--

INSERT INTO `answers` (`id`, `question_id`, `writer`, `user_id`, `comment`, `status`, `created_at`, `updated_at`) VALUES
(1, 2, NULL, 1, 'test answer', 1, '2023-10-04 13:12:05', '2023-10-04 16:58:20'),
(3, 2, NULL, 2, 'TEST ACCOUNT', 1, '2023-10-04 13:15:34', '2023-10-04 13:15:34'),
(4, 2, 'NoName', 0, 'test test test', 1, '2023-10-04 17:07:40', '2023-10-04 17:07:40');

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

DROP TABLE IF EXISTS `questions`;
CREATE TABLE IF NOT EXISTS `questions` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `question` varchar(1000) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `description` mediumtext CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci,
  `slug` varchar(20) COLLATE utf8mb3_unicode_ci NOT NULL,
  `published` int NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `questions`
--

INSERT INTO `questions` (`id`, `user_id`, `question`, `description`, `slug`, `published`, `created_at`, `updated_at`) VALUES
(1, 1, 'Question Example 1', 'Description Description Description Description Description Description Description', '4379642399', 1, '2023-10-04 13:07:59', '2023-10-04 15:18:35'),
(2, 1, 'Question Example 2', 'Description Description Description Description Description Description Description Description Description', '6555702104', 1, '2023-10-04 13:08:30', '2023-10-04 16:50:49'),
(3, 1, 'Question Example 3', 'Description Description Description Description Description Description Description Description Description', '5430472686', 1, '2023-10-04 17:05:09', '2023-10-04 17:05:09'),
(4, 1, 'Question Example 4', 'Description Description Description Description Description Description Description Description Description', '2096403395', 1, '2023-10-04 17:05:18', '2023-10-04 17:05:18'),
(5, 1, 'Question Example 5', 'Description Description Description Description Description Description Description Description Description', '7743514538', 1, '2023-10-04 17:05:25', '2023-10-04 17:05:25'),
(6, 1, 'Question Example 6', 'Description Description Description Description Description Description Description Description Description', '3938007228', 1, '2023-10-04 17:06:03', '2023-10-04 17:06:03'),
(7, 1, 'Question Example 7', 'Description Description Description Description Description Description Description Description Description', '2179115429', 1, '2023-10-04 17:06:10', '2023-10-04 17:06:10'),
(8, 1, 'Question Example 8', 'Description Description Description Description Description Description Description Description Description', '9588046555', 1, '2023-10-04 17:06:18', '2023-10-04 17:06:18'),
(9, 1, 'Question Example 9', 'Description Description Description Description Description Description Description Description Description', '7634968845', 1, '2023-10-04 17:06:24', '2023-10-04 17:06:24'),
(10, 1, 'Question Example 10', 'Description Description Description Description Description Description Description Description Description', '2376477911', 1, '2023-10-04 17:06:30', '2023-10-04 17:06:30'),
(11, 1, 'Question Example 11', 'Description Description Description Description Description Description Description Description Description', '1213094160', 1, '2023-10-04 17:06:44', '2023-10-04 17:06:44');

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

DROP TABLE IF EXISTS `settings`;
CREATE TABLE IF NOT EXISTS `settings` (
  `id` int NOT NULL AUTO_INCREMENT,
  `type` varchar(30) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `value` longtext CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `type`, `value`, `created_at`, `updated_at`) VALUES
(1, 'maintenance_mode', '0', '2019-10-17 11:51:04', '2023-10-04 12:11:29'),
(2, 'meta_description', 'open source example website for a questions and answers forum, developed by AbdulKader Aliwi using PHP Laravel.', '2020-11-16 07:26:36', '2022-04-14 21:26:26'),
(3, 'meta_keywords', 'opensource,example,website,questions,answers,forum,development,AbdulKaderAliwi,aa96me,Abboudi96,Abboudi_Aliwi,sal96me,PHP,Laravel,github,programming,script', '2020-11-16 07:26:36', '2023-10-04 12:36:29');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `email` varchar(191) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `password` varchar(191) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'AbdulKader Aliwi', 'eng.aliwi@gmail.com', '$2y$10$1i5pdjSK236lS2k9aDipDeFU/lTonWKs5b6lHk5AGaDEFXD4q5aFe', '7kWtEyZFQUmmKFH5pdN4vWCWG88EzfOIEELJee3yzAxyxRBwgjZcyw2TeNvR', '2023-09-30 22:11:05', '2023-10-04 17:52:39'),
(2, 'tester', 'test@test.com', '$2y$10$jYfh2tyn2Jrmo.l8Kz8vKu/COYy0.SRaLVivNEjexMJ1HPU5KaUfe', 'FggtkjiGyciJuMry0KYFQwmrgls6mZZW5jasGJ2iYcwICGUFzyZ1AVkI176j', '2023-09-30 22:11:05', '2023-10-04 08:14:00');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
