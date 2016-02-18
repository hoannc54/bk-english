-- phpMyAdmin SQL Dump
-- version 4.5.3.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1:3306
-- Generation Time: Feb 18, 2016 at 09:11 PM
-- Server version: 5.6.26
-- PHP Version: 5.6.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `laravel_5`
--

-- --------------------------------------------------------

--
-- Table structure for table `examples`
--

CREATE TABLE `examples` (
  `id` int(10) UNSIGNED NOT NULL,
  `example` text COLLATE utf8_unicode_ci NOT NULL,
  `mean` text COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `examples`
--

INSERT INTO `examples` (`id`, `example`, `mean`, `created_at`, `updated_at`) VALUES
(1, 'gggg dd sssa ddk  	 abbreviate ', 'abattoir gggg dd sssa ddk', '2016-02-15 03:03:05', '2016-02-15 03:03:46'),
(2, 'abattoir hsah adá đs sad ads ád', 'ddd', '2016-02-17 20:27:14', '2016-02-17 20:27:14');

-- --------------------------------------------------------

--
-- Table structure for table `learneds`
--

CREATE TABLE `learneds` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `word_id_list` text COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `learnings`
--

CREATE TABLE `learnings` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `word_id_list` text COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `learnts`
--

CREATE TABLE `learnts` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `word_id_list` text COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`migration`, `batch`) VALUES
('2014_10_12_000000_create_users_table', 1),
('2014_10_12_100000_create_password_resets_table', 1),
('2016_01_15_033540_create_words_table', 1),
('2016_01_15_033658_create_examples_table', 1),
('2016_01_15_034553_create_learnings_table', 1),
('2016_01_15_034608_create_learnts_table', 1),
('2016_01_15_034622_create_learneds_table', 1),
('2016_01_15_034642_create_not_learns_table', 1),
('2016_01_16_095751_create_word_exes_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `not_learns`
--

CREATE TABLE `not_learns` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `word_id_list` text COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `level` smallint(6) NOT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `words`
--

CREATE TABLE `words` (
  `id` int(10) UNSIGNED NOT NULL,
  `word` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `spell` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `mean` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `sound` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `parent_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `words`
--

INSERT INTO `words` (`id`, `word`, `spell`, `mean`, `sound`, `parent_id`, `created_at`, `updated_at`) VALUES
(2, 'abattoir', 'ss', 'ff', 'public/sound/abattoir.mp3', 0, '2016-02-14 07:20:21', '2016-02-14 07:20:21'),
(4, 'Abbott and Costello', 'xxx', 'eee', 'public/sound/Abbott and Costello.mp3', 0, '2016-02-14 07:22:52', '2016-02-14 07:22:52'),
(6, 'abdicate', 'xxxx', 'deeeww', 'public/sound/abdicate.mp3', 0, '2016-02-14 07:23:43', '2016-02-14 07:23:43'),
(7, 'agreement', 'ə\'gri:mənt', 'Hợp đồng,  giao kèo', 'public/sound/agreement.mp3', 0, '2016-02-17 20:39:05', '2016-02-17 20:39:05'),
(8, 'agree', 'ə\'gri:', 'Đồng ý, tán thành', '', 7, '2016-02-17 20:39:05', '2016-02-17 20:39:05'),
(9, 'agreementgggg', 'ə\'gri:mənt', 'Hợp đồng,  giao kèo', 'public/sound/agreementgggg.mp3', 0, '2016-02-17 20:41:45', '2016-02-17 20:41:45'),
(10, 'abc', 'dđ', 'dđ', '', 9, '2016-02-17 20:41:45', '2016-02-17 20:41:45'),
(11, 'ssss', 'aa', 'dđ', '', 9, '2016-02-17 20:41:45', '2016-02-17 20:41:45');

-- --------------------------------------------------------

--
-- Table structure for table `word_exes`
--

CREATE TABLE `word_exes` (
  `id` int(10) UNSIGNED NOT NULL,
  `word_id` int(10) UNSIGNED NOT NULL,
  `example_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `word_exes`
--

INSERT INTO `word_exes` (`id`, `word_id`, `example_id`, `created_at`, `updated_at`) VALUES
(3, 2, 2, '0000-00-00 00:00:00', '0000-00-00 00:00:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `examples`
--
ALTER TABLE `examples`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `learneds`
--
ALTER TABLE `learneds`
  ADD PRIMARY KEY (`id`),
  ADD KEY `learneds_user_id_foreign` (`user_id`);

--
-- Indexes for table `learnings`
--
ALTER TABLE `learnings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `learnings_user_id_foreign` (`user_id`);

--
-- Indexes for table `learnts`
--
ALTER TABLE `learnts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `learnts_user_id_foreign` (`user_id`);

--
-- Indexes for table `not_learns`
--
ALTER TABLE `not_learns`
  ADD PRIMARY KEY (`id`),
  ADD KEY `not_learns_user_id_foreign` (`user_id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`),
  ADD KEY `password_resets_token_index` (`token`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `words`
--
ALTER TABLE `words`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `word_exes`
--
ALTER TABLE `word_exes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `word_exes_word_id_foreign` (`word_id`),
  ADD KEY `word_exes_example_id_foreign` (`example_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `examples`
--
ALTER TABLE `examples`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `learneds`
--
ALTER TABLE `learneds`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `learnings`
--
ALTER TABLE `learnings`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `learnts`
--
ALTER TABLE `learnts`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `not_learns`
--
ALTER TABLE `not_learns`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `words`
--
ALTER TABLE `words`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `word_exes`
--
ALTER TABLE `word_exes`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `learneds`
--
ALTER TABLE `learneds`
  ADD CONSTRAINT `learneds_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `learnings`
--
ALTER TABLE `learnings`
  ADD CONSTRAINT `learnings_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `learnts`
--
ALTER TABLE `learnts`
  ADD CONSTRAINT `learnts_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `not_learns`
--
ALTER TABLE `not_learns`
  ADD CONSTRAINT `not_learns_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `word_exes`
--
ALTER TABLE `word_exes`
  ADD CONSTRAINT `word_exes_example_id_foreign` FOREIGN KEY (`example_id`) REFERENCES `examples` (`id`),
  ADD CONSTRAINT `word_exes_word_id_foreign` FOREIGN KEY (`word_id`) REFERENCES `words` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
