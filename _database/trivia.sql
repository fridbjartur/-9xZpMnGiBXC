-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: May 01, 2021 at 12:48 AM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.2.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `trivia`
--

-- --------------------------------------------------------

--
-- Table structure for table `answers`
--

CREATE TABLE `answers` (
  `answer_id` bigint(20) UNSIGNED NOT NULL,
  `answer_question_fk` bigint(20) UNSIGNED NOT NULL,
  `answer_text` varchar(50) NOT NULL,
  `answer_is_correct` tinyint(1) NOT NULL,
  `answer_created` timestamp NOT NULL DEFAULT current_timestamp(),
  `answer_active` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `category_title` varchar(50) NOT NULL,
  `category_created` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`category_id`, `category_title`, `category_created`) VALUES
(1, 'Almenn vitan', '2021-04-30 22:35:28'),
(2, 'Bøkur', '2021-04-30 22:35:28'),
(3, 'Filmar', '2021-04-30 22:35:28'),
(4, 'Tónleikur', '2021-04-30 22:35:28'),
(5, 'Songleikir', '2021-04-30 22:35:28'),
(6, 'Leiklist', '2021-04-30 22:35:28'),
(7, 'Sjónvarp', '2021-04-30 22:35:28'),
(8, 'Videospøl', '2021-04-30 22:35:28'),
(9, 'Borðspøl', '2021-04-30 22:35:28'),
(10, 'Náttúruvísindi', '2021-04-30 22:35:28'),
(11, 'Teldufrøði', '2021-04-30 22:35:28'),
(12, 'Støddfrøði', '2021-04-30 22:35:28'),
(13, 'Gudalæra', '2021-04-30 22:35:28'),
(14, 'Ítróttur', '2021-04-30 22:35:28'),
(15, 'Landalæra', '2021-04-30 22:35:28'),
(16, 'Søga', '2021-04-30 22:35:28'),
(17, 'Politikkur', '2021-04-30 22:35:28'),
(18, 'List', '2021-04-30 22:35:28'),
(19, 'Kend fólk', '2021-04-30 22:35:28'),
(20, 'Dýr', '2021-04-30 22:35:28'),
(21, 'Akfør', '2021-04-30 22:35:28'),
(22, 'Mállæra', '2021-04-30 22:35:28');

-- --------------------------------------------------------

--
-- Table structure for table `difficulties`
--

CREATE TABLE `difficulties` (
  `difficulty_id` bigint(20) UNSIGNED NOT NULL,
  `difficulty_title` varchar(50) NOT NULL,
  `difficulty_created` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `difficulties`
--

INSERT INTO `difficulties` (`difficulty_id`, `difficulty_title`, `difficulty_created`) VALUES
(1, 'kids', '2021-04-30 22:47:09'),
(2, 'easy', '2021-04-30 22:47:09'),
(3, 'medium', '2021-04-30 22:47:09'),
(4, 'hard', '2021-04-30 22:47:09');

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

CREATE TABLE `questions` (
  `question_id` bigint(20) UNSIGNED NOT NULL,
  `question_user_fk` bigint(20) UNSIGNED NOT NULL,
  `question_category_fk` bigint(20) UNSIGNED NOT NULL,
  `question_type_fk` bigint(20) UNSIGNED NOT NULL,
  `question_difficulty_fk` bigint(20) UNSIGNED NOT NULL,
  `question_text` varchar(255) NOT NULL,
  `question_created` timestamp NOT NULL DEFAULT current_timestamp(),
  `question_active` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `types`
--

CREATE TABLE `types` (
  `type_id` bigint(20) UNSIGNED NOT NULL,
  `type_title` varchar(50) NOT NULL,
  `type_created` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `types`
--

INSERT INTO `types` (`type_id`, `type_title`, `type_created`) VALUES
(1, 'multiple', '2021-04-30 22:47:51'),
(2, 'boolean', '2021-04-30 22:47:51'),
(3, 'single', '2021-04-30 22:47:51');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `user_first_name` varchar(20) NOT NULL,
  `user_last_name` varchar(20) NOT NULL,
  `user_username` varchar(50) DEFAULT NULL,
  `user_email` varchar(255) NOT NULL,
  `user_password` varchar(255) NOT NULL,
  `user_verification_code` varchar(255) DEFAULT NULL,
  `user_verified` tinyint(1) NOT NULL DEFAULT 0,
  `user_active` tinyint(1) NOT NULL DEFAULT 1,
  `user_is_staff` tinyint(1) NOT NULL DEFAULT 0,
  `user_last_login` timestamp NOT NULL DEFAULT current_timestamp(),
  `user_created` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `user_first_name`, `user_last_name`, `user_username`, `user_email`, `user_password`, `user_verification_code`, `user_verified`, `user_active`, `user_is_staff`, `user_last_login`, `user_created`) VALUES
(1, 'Fríðbjartur', 'Miðberg', NULL, 'info@midberg.com', '$2y$10$M7TSDgM7BfYoiTCYqDatz.VrS64cySM5mzqVtyoVnghEDa1xX3ffu', '1608c875ea195d', 0, 0, 1, '2021-04-30 22:40:30', '2021-04-30 22:40:30');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `answers`
--
ALTER TABLE `answers`
  ADD PRIMARY KEY (`answer_id`) USING BTREE,
  ADD KEY `answer_question_fk` (`answer_question_fk`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`category_id`) USING BTREE;

--
-- Indexes for table `difficulties`
--
ALTER TABLE `difficulties`
  ADD PRIMARY KEY (`difficulty_id`) USING BTREE;

--
-- Indexes for table `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`question_id`) USING BTREE,
  ADD KEY `question_user_fk` (`question_user_fk`),
  ADD KEY `question_category_fk` (`question_category_fk`),
  ADD KEY `question_type_fk` (`question_type_fk`),
  ADD KEY `question_difficulty_fk` (`question_difficulty_fk`);

--
-- Indexes for table `types`
--
ALTER TABLE `types`
  ADD PRIMARY KEY (`type_id`) USING BTREE;

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`) USING BTREE,
  ADD KEY `user_email` (`user_email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `answers`
--
ALTER TABLE `answers`
  MODIFY `answer_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `category_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `difficulties`
--
ALTER TABLE `difficulties`
  MODIFY `difficulty_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `questions`
--
ALTER TABLE `questions`
  MODIFY `question_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `types`
--
ALTER TABLE `types`
  MODIFY `type_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `answers`
--
ALTER TABLE `answers`
  ADD CONSTRAINT `answer_question_fk` FOREIGN KEY (`answer_question_fk`) REFERENCES `questions` (`question_id`);

--
-- Constraints for table `questions`
--
ALTER TABLE `questions`
  ADD CONSTRAINT `question_category_fk` FOREIGN KEY (`question_category_fk`) REFERENCES `categories` (`category_id`),
  ADD CONSTRAINT `question_difficulty_fk` FOREIGN KEY (`question_difficulty_fk`) REFERENCES `difficulties` (`difficulty_id`),
  ADD CONSTRAINT `question_type_fk` FOREIGN KEY (`question_type_fk`) REFERENCES `types` (`type_id`),
  ADD CONSTRAINT `question_user_fk` FOREIGN KEY (`question_user_fk`) REFERENCES `users` (`user_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
