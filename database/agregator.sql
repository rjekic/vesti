-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 25, 2018 at 05:43 PM
-- Server version: 5.5.55-0ubuntu0.14.04.1
-- PHP Version: 7.0.19-1+deb.sury.org~trusty+2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `agregator`
--

-- --------------------------------------------------------

--
-- Table structure for table `dogadjajis`
--

CREATE TABLE IF NOT EXISTS `dogadjajis` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `kategorija_oglacis`
--

CREATE TABLE IF NOT EXISTS `kategorija_oglacis` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `kategorija` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci AUTO_INCREMENT=5 ;

--
-- Dumping data for table `kategorija_oglacis`
--

INSERT INTO `kategorija_oglacis` (`id`, `kategorija`, `created_at`, `updated_at`) VALUES
(1, 'Alati i oruđa', NULL, NULL),
(2, 'Antikviteti i umetnička dela', NULL, NULL),
(3, 'Auto-moto', NULL, NULL),
(4, 'Audio, TV i video', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci AUTO_INCREMENT=10 ;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2018_04_20_164739_create_vestis_table', 1),
(4, '2018_04_20_165249_role_user', 1),
(5, '2018_04_20_165346_create_roles_table', 1),
(6, '2018_04_20_165856_create_oglasis_table', 1),
(7, '2018_04_20_165911_create_dogadjajis_table', 1),
(8, '2018_04_25_100237_create_kategorija_oglacis_table', 1),
(9, '2018_04_25_114407_create_slike_oglasis_table', 2);

-- --------------------------------------------------------

--
-- Table structure for table `oglasis`
--

CREATE TABLE IF NOT EXISTS `oglasis` (
  `id` int(222) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(255) NOT NULL,
  `naslov` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `text` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `kategorija` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cena` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `telefon` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci AUTO_INCREMENT=11 ;

--
-- Dumping data for table `oglasis`
--

INSERT INTO `oglasis` (`id`, `user_id`, `naslov`, `text`, `kategorija`, `cena`, `telefon`, `created_at`, `updated_at`) VALUES
(7, 1, 'proizvodna linijaCKDSH', 'jlhkjh hhkjh jh hh khk', 'Alati i oruđa', '87897897', '0641191202', '2018-04-25 16:57:21', '2018-04-25 16:57:21'),
(10, 1, 'test', 'u3o5uul jglkdfjgdkflgj ljldkg jdlkgj dlg', 'Alati i oruđa', 'jhskjfhdfj', '0641191202', '2018-04-25 17:29:57', '2018-04-25 17:29:57');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE IF NOT EXISTS `roles` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `role_user`
--

CREATE TABLE IF NOT EXISTS `role_user` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `role_id` int(10) unsigned NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `slike_oglasis`
--

CREATE TABLE IF NOT EXISTS `slike_oglasis` (
  `id` int(255) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `oglasi_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slika` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tip` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci AUTO_INCREMENT=17 ;

--
-- Dumping data for table `slike_oglasis`
--

INSERT INTO `slike_oglasis` (`id`, `user_id`, `oglasi_id`, `slika`, `tip`, `created_at`, `updated_at`) VALUES
(5, '1', '7', '7_1524675441_55df7b4773ad6_JennaCBBmain.jpg', 'naslovna', '2018-04-25 16:57:21', '2018-04-25 16:57:21'),
(13, '1', '10', '10_1524677397_AcerForte-napred.jpg', 'naslovna', '2018-04-25 17:29:57', '2018-04-25 17:29:57'),
(14, '1', '10', '10_1524677397_office_equipment.jpg', 'ostale', '2018-04-25 17:29:57', '2018-04-25 17:29:57'),
(15, '1', '10', '10_1524677397_phonebook.jpg', 'ostale', '2018-04-25 17:29:57', '2018-04-25 17:29:57'),
(16, '1', '10', '10_1524677397_Phonebook_phone.png', 'ostale', '2018-04-25 17:29:57', '2018-04-25 17:29:57');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `telefon` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci AUTO_INCREMENT=2 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `telefon`, `role`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Predrag Jovicic', 'jovicicpr@gmail.com', '$2y$10$vgX8cBaPA/IJ2HtmWDsJC.zsKNqHE3v5x46pmFEaPMe4Nee4zAzRC', '0641191202', 'oglasi', NULL, '2018-04-25 11:38:46', '2018-04-25 11:38:46');

-- --------------------------------------------------------

--
-- Table structure for table `vestis`
--

CREATE TABLE IF NOT EXISTS `vestis` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `link` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slika` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `naslov` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `text` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `datum` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `izvor` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `privilegija` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci AUTO_INCREMENT=1 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
