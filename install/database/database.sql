-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:4306
-- Generation Time: Dec 08, 2022 at 12:06 PM
-- Server version: 10.4.19-MariaDB
-- PHP Version: 7.4.20

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pro-short`
--

-- --------------------------------------------------------

--
-- Table structure for table `adminpanel_languages`
--

CREATE TABLE `adminpanel_languages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `is_default` tinyint(4) NOT NULL DEFAULT 0,
  `language` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `file` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `rtl` tinyint(4) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `adminpanel_languages`
--

INSERT INTO `adminpanel_languages` (`id`, `is_default`, `language`, `file`, `name`, `rtl`, `created_at`, `updated_at`) VALUES
(1, 1, 'English', '1656222539CIRmkjPv.json', '1656222539CIRmkjPv', 0, NULL, NULL),
(4, 0, 'Bangla', '1656232600Ccju1wtO.json', '1656232600Ccju1wtO', 0, '2022-06-26 02:36:40', '2022-06-26 02:36:40');

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `photo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0,
  `remember_token` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `role_id`, `name`, `email`, `phone`, `photo`, `password`, `status`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 0, 'admin', 'admin@gmail.com', '01976814812', '16564774101556780563user.png', '$2a$12$U7tW1OBfd8x0ynKLoIo5GelEv9AfrtLvYB4xaCOlBmZfDJIgArT5O', 1, NULL, '2022-04-05 07:54:38', '2022-06-28 22:37:14'),
(8, 0, 'pronob', 'shaon@gmail.com', '01976814812', '16564157261556780563user.png', '$2a$12$U7tW1OBfd8x0ynKLoIo5GelEv9AfrtLvYB4xaCOlBmZfDJIgArT5O', 0, NULL, '2022-06-28 05:28:46', '2022-06-28 05:28:46');

-- --------------------------------------------------------

--
-- Table structure for table `admin_user_conversations`
--

CREATE TABLE `admin_user_conversations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `ticket` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `admin_id` int(11) DEFAULT NULL,
  `subject` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(11) NOT NULL,
  `name` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `text` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admin_user_conversations`
--

INSERT INTO `admin_user_conversations` (`id`, `ticket`, `admin_id`, `subject`, `user_id`, `name`, `email`, `phone`, `text`, `created_at`, `updated_at`) VALUES
(9, 'TKT310905', 1, 'ytur568r56', 1, NULL, NULL, NULL, 'retyue67u8456', '2022-05-22 03:23:25', '2022-05-22 03:23:25'),
(10, 'TKT921342', 1, 'ertwrtwert', 1, NULL, NULL, NULL, 'erwetwretwertwret', '2022-05-22 04:07:43', '2022-05-22 04:07:43'),
(11, 'TKT512671', 1, 'test new', 1, NULL, NULL, NULL, 'dsfasdfasdfasdf', '2022-07-05 03:40:43', '2022-07-05 03:40:43');

-- --------------------------------------------------------

--
-- Table structure for table `admin_user_messages`
--

CREATE TABLE `admin_user_messages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `conversation_id` int(11) NOT NULL,
  `message` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admin_user_messages`
--

INSERT INTO `admin_user_messages` (`id`, `conversation_id`, `message`, `user_id`, `created_at`, `updated_at`) VALUES
(2, 2, 'eryuryryt', 1, '2022-04-12 01:45:13', '2022-04-12 01:45:13'),
(5, 6, 'w4t636', 1, '2022-05-22 02:42:51', '2022-05-22 02:42:51'),
(6, 7, 'yturtuytyuyt', 1, '2022-05-22 03:11:36', '2022-05-22 03:11:36'),
(7, 8, 'rtuyyuyuioyuiuio', 1, '2022-05-22 03:20:09', '2022-05-22 03:20:09'),
(8, 9, 'retyue67u8456', 1, '2022-05-22 03:23:25', '2022-05-22 03:23:25'),
(9, 10, 'erwetwretwertwret', 1, '2022-05-22 04:07:43', '2022-05-22 04:07:43'),
(10, 9, 'Ok, done', 0, '2022-05-23 04:05:56', '2022-05-23 04:05:56'),
(11, 9, 'fdhgdghfgjh', 1, '2022-05-23 05:12:29', '2022-05-23 05:12:29'),
(12, 9, 'dfgdfgdf', 1, '2022-05-23 05:15:22', '2022-05-23 05:15:22'),
(13, 9, 'tdhrt', 1, '2022-05-23 05:17:36', '2022-05-23 05:17:36'),
(14, 9, 'hgdfg', 1, '2022-05-23 05:17:43', '2022-05-23 05:17:43'),
(15, 9, 'hdfg', 1, '2022-05-23 05:17:56', '2022-05-23 05:17:56'),
(16, 10, 'ruyreuer', 1, '2022-05-23 05:20:40', '2022-05-23 05:20:40'),
(17, 10, 'ghfhj', 1, '2022-05-23 05:25:54', '2022-05-23 05:25:54'),
(18, 10, 'fgjfjh', 1, '2022-05-23 05:28:17', '2022-05-23 05:28:17'),
(19, 10, 'hgjgj', 1, '2022-05-23 05:28:52', '2022-05-23 05:28:52'),
(20, 11, 'dsfasdfasdfasdf', 1, '2022-07-05 03:40:43', '2022-07-05 03:40:43'),
(21, 11, 'dfgdfg', 1, '2022-07-05 03:42:02', '2022-07-05 03:42:02'),
(22, 11, 'vghjkgjhkgjhk', 1, '2022-07-05 03:42:10', '2022-07-05 03:42:10'),
(23, 11, 'dfgdfhdfgh', 1, '2022-07-05 03:43:29', '2022-07-05 03:43:29'),
(24, 11, 'ghdfghdfgh', 1, '2022-07-05 03:46:23', '2022-07-05 03:46:23'),
(25, 11, 'gfhfgh', 1, '2022-07-05 03:46:31', '2022-07-05 03:46:31'),
(26, 11, 'fxdhfgh', 1, '2022-07-05 03:48:28', '2022-07-05 03:48:28'),
(27, 11, 'fdghdfhdf', 1, '2022-07-05 03:48:37', '2022-07-05 03:48:37'),
(28, 10, 'dfgsdfgsf', 1, '2022-07-05 03:49:15', '2022-07-05 03:49:15'),
(29, 11, 'ghjghfj', 1, '2022-07-05 03:50:02', '2022-07-05 03:50:02'),
(30, 10, 'fghdfgh', 1, '2022-07-05 03:52:28', '2022-07-05 03:52:28'),
(31, 10, 'dfhdfghdfgh', 1, '2022-07-05 03:53:07', '2022-07-05 03:53:07'),
(32, 11, 'ghjfghj', 1, '2022-07-05 03:53:19', '2022-07-05 03:53:19'),
(33, 11, 'fghjfghj', 1, '2022-07-05 03:57:08', '2022-07-05 03:57:08'),
(34, 11, 'hey', 0, '2022-07-05 03:57:32', '2022-07-05 03:57:32'),
(35, 11, 'gfhfgh', 1, '2022-07-05 03:58:56', '2022-07-05 03:58:56'),
(36, 11, 'fgjfghj', 1, '2022-07-05 04:01:42', '2022-07-05 04:01:42'),
(37, 11, 'dgthdfgh', 1, '2022-07-05 04:02:40', '2022-07-05 04:02:40'),
(38, 11, 'fghfghfghf', 1, '2022-07-05 04:02:46', '2022-07-05 04:02:46');

-- --------------------------------------------------------

--
-- Table structure for table `advertisements`
--

CREATE TABLE `advertisements` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `ad_url` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expression` bigint(20) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `advertisements`
--

INSERT INTO `advertisements` (`id`, `ad_url`, `expression`, `status`, `created_at`, `updated_at`) VALUES
(2, 'https://adbtc.top/surf/browse/1702886', 8, 0, '2022-04-17 02:12:30', '2022-11-17 04:42:36'),
(3, 'https://www.coinpayu.com/dashboard', 11, 0, '2022-04-17 02:27:37', '2022-11-17 04:45:02');

-- --------------------------------------------------------

--
-- Table structure for table `blogs`
--

CREATE TABLE `blogs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category_id` int(11) NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `details` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `photo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `source` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `views` int(11) NOT NULL DEFAULT 0,
  `meta_tag` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tags` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `blogs`
--

INSERT INTO `blogs` (`id`, `category_id`, `title`, `slug`, `details`, `photo`, `source`, `views`, `meta_tag`, `meta_description`, `tags`, `created_at`, `updated_at`) VALUES
(2, 1, 'Genious Wallet commodi explicabo aperiam unde maxime debitis.', 'genius-wallet', 'Temporibus labore autem ab quo odit saepe accusamus enim facilis molestiae optio harum quasi modi, soluta tempore nihil, quibusdam iste quisquam ex? Officia doloribus hic aperiam culpa nisi, voluptatem voluptatibus! Sint itaque dolorem repellendus consectetur obcaecati, ratione totam sed, unde quam tempore neque! Animi totam earum quae mollitia est excepturi et ea.\r\n\r\nTemporibus labore autem ab quo odit saepe accusamus enim facilis molestiae optio harum quasi modi, soluta tempore nihil, quibusdam iste quisquam ex? Officia doloribus hic aperiam culpa nisi, voluptatem voluptatibus! Sint itaque dolorem repellendus consectetur obcaecati, ratione totam sed, unde quam tempore neque! Animi totam earum quae mollitia est excepturi et ea.\r\n\r\nOfficia doloribus hic aperiam culpa nisi, voluptatem voluptatibus!\r\nTemporibus labore autem ab quo odit saepe accusamus enim facilis molestiae optio harum quasi modi, soluta tempore nihil, quibusdam iste quisquam ex? Officia doloribus hic aperiam culpa nisi, voluptatem voluptatibus! Sint itaque dolorem repellendus consectetur obcaecati, ratione totam sed, unde quam tempore neque! Animi totam earum quae mollitia est excepturi et ea.\r\n\r\nTemporibus labore autem ab quo odit saepe accusamus enim facilis molestiae optio harum quasi modi, soluta tempore nihil, quibusdam iste quisquam ex? Officia doloribus hic aperiam culpa nisi, voluptatem voluptatibus! Sint itaque dolorem repellendus consectetur obcaecati, ratione totam sed, unde quam tempore neque! Animi totam earum quae mollitia est excepturi et ea.', '1655720248blog1.jpg', 'https://geniusocean.com/', 0, NULL, NULL, 'wallet,genius,Bank', '2022-06-20 04:17:28', '2022-06-20 04:17:28'),
(3, 2, 'Genious Wallet commodi explicabo aperiam unde maxime debitis.', 'wallet-one', 'Temporibus labore autem ab quo odit saepe accusamus enim facilis molestiae optio harum quasi modi, soluta tempore nihil, quibusdam iste quisquam ex? Officia doloribus hic aperiam culpa nisi, voluptatem voluptatibus! Sint itaque dolorem repellendus consectetur obcaecati, ratione totam sed, unde quam tempore neque! Animi totam earum quae mollitia est excepturi et ea.\r\n\r\nTemporibus labore autem ab quo odit saepe accusamus enim facilis molestiae optio harum quasi modi, soluta tempore nihil, quibusdam iste quisquam ex? Officia doloribus hic aperiam culpa nisi, voluptatem voluptatibus! Sint itaque dolorem repellendus consectetur obcaecati, ratione totam sed, unde quam tempore neque! Animi totam earum quae mollitia est excepturi et ea.\r\n\r\nOfficia doloribus hic aperiam culpa nisi, voluptatem voluptatibus!\r\nTemporibus labore autem ab quo odit saepe accusamus enim facilis molestiae optio harum quasi modi, soluta tempore nihil, quibusdam iste quisquam ex? Officia doloribus hic aperiam culpa nisi, voluptatem voluptatibus! Sint itaque dolorem repellendus consectetur obcaecati, ratione totam sed, unde quam tempore neque! Animi totam earum quae mollitia est excepturi et ea.\r\n\r\nTemporibus labore autem ab quo odit saepe accusamus enim facilis molestiae optio harum quasi modi, soluta tempore nihil, quibusdam iste quisquam ex? Officia doloribus hic aperiam culpa nisi, voluptatem voluptatibus! Sint itaque dolorem repellendus consectetur obcaecati, ratione totam sed, unde quam tempore neque! Animi totam earum quae mollitia est excepturi et ea.', '1655720819blog2.jpg', 'https://geniusocean.com/', 0, NULL, NULL, 'compute,business', '2022-06-20 04:26:59', '2022-06-20 04:26:59'),
(4, 4, 'How to design effective arts?', 'how-design', 'The recording starts with the patter of a summer squall. Later, a drifting tone like that of a not-quite-tuned-in radio station rises and for a while drowns out the patter. These are the sounds encountered by NASA’s Cassini spacecraft as it dove the gap between Saturn and its innermost ring on April 26, the first of 22 such encounters before it will plunge into atmosphere in September. What Cassini did not detect were many of the collisions of dust particles hitting the spacecraft it passed through the plane of the ringsen the charged particles oscillate in unison.\r\n\r\nHow its Works ?\r\nMIAMI — For decades, South Florida schoolchildren and adults fascinated by far-off galaxies, earthly ecosystems, the proper ties of light and sound and other wonders of science had only a quaint, antiquated museum here in which to explore their interests. Now, with the long-delayed opening of a vast new science museum downtown set for Monday, visitors will be able to stand underneath a suspended, 500,000-gallon aquarium tank and gaze at hammerhead and tiger sharks, mahi mahi, devil rays and other creatures through a 60,000-pound oculus. \r\n\r\nLens that will give the impression of seeing the fish from the bottom of a huge cocktail glass. And that’s just one of many attractions and exhibits. Officials at the $305 million Phillip and Patricia Frost Museum of Science promise that it will be a vivid expression of modern scientific inquiry and exposition. Its opening follows a series of setbacks and lawsuits and a scramble to finish the 250,000-square-foot structure. At one point, the project ran precariously short of money. The museum high-profile opening is especially significant in a state s', '1655720895blog3.jpg', 'https://geniusocean.com/', 0, NULL, NULL, 'Business,Research,Mechanical,Process', '2022-06-20 04:28:15', '2022-06-20 04:28:15'),
(5, 3, 'How to design effective arts?', 'how-design-effective', 'The recording starts with the patter of a summer squall. Later, a drifting tone like that of a not-quite-tuned-in radio station rises and for a while drowns out the patter. These are the sounds encountered by NASA’s Cassini spacecraft as it dove the gap between Saturn and its innermost ring on April 26, the first of 22 such encounters before it will plunge into atmosphere in September. What Cassini did not detect were many of the collisions of dust particles hitting the spacecraft it passed through the plane of the ringsen the charged particles oscillate in unison.\r\n\r\nHow its Works ?\r\nMIAMI — For decades, South Florida schoolchildren and adults fascinated by far-off galaxies, earthly ecosystems, the proper ties of light and sound and other wonders of science had only a quaint, antiquated museum here in which to explore their interests. Now, with the long-delayed opening of a vast new science museum downtown set for Monday, visitors will be able to stand underneath a suspended, 500,000-gallon aquarium tank and gaze at hammerhead and tiger sharks, mahi mahi, devil rays and other creatures through a 60,000-pound oculus. \r\n\r\nLens that will give the impression of seeing the fish from the bottom of a huge cocktail glass. And that’s just one of many attractions and exhibits. Officials at the $305 million Phillip and Patricia Frost Museum of Science promise that it will be a vivid expression of modern scientific inquiry and exposition. Its opening follows a series of setbacks and lawsuits and a scramble to finish the 250,000-square-foot structure. At one point, the project ran precariously short of money. The museum high-profile opening is especially significant in a state s', '1655720978164543402825png.png', 'https://geniusocean.com/', 1, NULL, NULL, 'Business,Research,Mechanical,Process', '2022-06-20 04:29:38', '2022-07-31 18:48:54'),
(6, 1, 'How to design effective arts?', 'how-design-new', 'The recording starts with the patter of a summer squall. Later, a drifting tone like that of a not-quite-tuned-in radio station rises and for a while drowns out the patter. These are the sounds encountered by NASA’s Cassini spacecraft as it dove the gap between Saturn and its innermost ring on April 26, the first of 22 such encounters before it will plunge into atmosphere in September. What Cassini did not detect were many of the collisions of dust particles hitting the spacecraft it passed through the plane of the ringsen the charged particles oscillate in unison.\r\n\r\nHow its Works ?\r\nMIAMI — For decades, South Florida schoolchildren and adults fascinated by far-off galaxies, earthly ecosystems, the proper ties of light and sound and other wonders of science had only a quaint, antiquated museum here in which to explore their interests. Now, with the long-delayed opening of a vast new science museum downtown set for Monday, visitors will be able to stand underneath a suspended, 500,000-gallon aquarium tank and gaze at hammerhead and tiger sharks, mahi mahi, devil rays and other creatures through a 60,000-pound oculus. \r\n\r\nLens that will give the impression of seeing the fish from the bottom of a huge cocktail glass. And that’s just one of many attractions and exhibits. Officials at the $305 million Phillip and Patricia Frost Museum of Science promise that it will be a vivid expression of modern scientific inquiry and exposition. Its opening follows a series of setbacks and lawsuits and a scramble to finish the 250,000-square-foot structure. At one point, the project ran precariously short of money. The museum high-profile opening is especially significant in a state s', '1655721046164543321016423090171560403662beautiful-brown-hair-casual-1989252jpgjpg.jpg', 'https://geniusocean.com/', 7, NULL, NULL, 'Business,Research,Mechanical,Process', '2022-06-20 04:30:46', '2022-07-03 00:00:35'),
(7, 3, 'How to design effective arts?', 'latest-blog', 'The recording starts with the patter of a summer squall. Later, a drifting tone like that of a not-quite-tuned-in radio station rises and for a while drowns out the patter. These are the sounds encountered by NASA’s Cassini spacecraft as it dove the gap between Saturn and its innermost ring on April 26, the first of 22 such encounters before it will plunge into atmosphere in September. What Cassini did not detect were many of the collisions of dust particles hitting the spacecraft it passed through the plane of the ringsen the charged particles oscillate in unison.\r\n\r\nHow its Works ?\r\nMIAMI — For decades, South Florida schoolchildren and adults fascinated by far-off galaxies, earthly ecosystems, the proper ties of light and sound and other wonders of science had only a quaint, antiquated museum here in which to explore their interests. Now, with the long-delayed opening of a vast new science museum downtown set for Monday, visitors will be able to stand underneath a suspended, 500,000-gallon aquarium tank and gaze at hammerhead and tiger sharks, mahi mahi, devil rays and other creatures through a 60,000-pound oculus. \r\n\r\nLens that will give the impression of seeing the fish from the bottom of a huge cocktail glass. And that’s just one of many attractions and exhibits. Officials at the $305 million Phillip and Patricia Frost Museum of Science promise that it will be a vivid expression of modern scientific inquiry and exposition. Its opening follows a series of setbacks and lawsuits and a scramble to finish the 250,000-square-foot structure. At one point, the project ran precariously short of money. The museum high-profile opening is especially significant in a state s', '16557220051645433260164069206129pngpng.png', 'https://geniusocean.com/', 28, 'tyty,tghdu', 'This is first blog', 'dty', '2022-06-20 04:46:45', '2022-10-18 04:29:53');

-- --------------------------------------------------------

--
-- Table structure for table `blog__categories`
--

CREATE TABLE `blog__categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `blog__categories`
--

INSERT INTO `blog__categories` (`id`, `name`, `slug`, `created_at`, `updated_at`) VALUES
(1, 'Web Service', 'web-service', NULL, NULL),
(2, 'Business Philosophy', 'business-philosophy', NULL, NULL),
(3, 'Business Help', 'business-help', NULL, NULL),
(4, 'Random Thoughtsasdfasdf dsasdfasf', 'random-thoughtt', NULL, NULL),
(5, 'gfert', 'rtwertwer', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `countries`
--

CREATE TABLE `countries` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `phone_code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `country_code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `countries`
--

INSERT INTO `countries` (`id`, `phone_code`, `country_code`, `name`, `status`, `created_at`, `updated_at`) VALUES
(1, '93', 'AF', 'Afghanistan', 0, NULL, NULL),
(2, '358', 'AX', 'Aland Islands', 0, NULL, NULL),
(3, '355', 'AL', 'Albania', 0, NULL, NULL),
(4, '213', 'DZ', 'Algeria', 0, NULL, NULL),
(5, '1684', 'AS', 'American Samoa', 0, NULL, NULL),
(6, '376', 'AD', 'Andorra', 0, NULL, NULL),
(7, '244', 'AO', 'Angola', 0, NULL, NULL),
(8, '1264', 'AI', 'Anguilla', 0, NULL, NULL),
(9, '672', 'AQ', 'Antarctica', 0, NULL, NULL),
(10, '1268', 'AG', 'Antigua and Barbuda', 0, NULL, NULL),
(11, '54', 'AR', 'Argentina', 0, NULL, NULL),
(12, '374', 'AM', 'Armenia', 0, NULL, NULL),
(13, '297', 'AW', 'Aruba', 0, NULL, NULL),
(14, '61', 'AU', 'Australia', 0, NULL, NULL),
(15, '43', 'AT', 'Austria', 0, NULL, NULL),
(16, '994', 'AZ', 'Azerbaijan', 0, NULL, NULL),
(17, '1242', 'BS', 'Bahamas', 0, NULL, NULL),
(18, '973', 'BH', 'Bahrain', 0, NULL, NULL),
(19, '880', 'BD', 'Bangladesh', 0, NULL, NULL),
(20, '1246', 'BB', 'Barbados', 0, NULL, NULL),
(21, '375', 'BY', 'Belarus', 0, NULL, NULL),
(22, '32', 'BE', 'Belgium', 0, NULL, NULL),
(23, '501', 'BZ', 'Belize', 0, NULL, NULL),
(24, '229', 'BJ', 'Benin', 0, NULL, NULL),
(25, '1441', 'BM', 'Bermuda', 0, NULL, NULL),
(26, '975', 'BT', 'Bhutan', 0, NULL, NULL),
(27, '591', 'BO', 'Bolivia', 0, NULL, NULL),
(28, '599', 'BQ', 'Bonaire, Sint Eustatius and Saba', 0, NULL, NULL),
(29, '387', 'BA', 'Bosnia and Herzegovina', 0, NULL, NULL),
(30, '267', 'BW', 'Botswana', 0, NULL, NULL),
(31, '55', 'BV', 'Bouvet Island', 0, NULL, NULL),
(32, '55', 'BR', 'Brazil', 0, NULL, NULL),
(33, '246', 'IO', 'British Indian Ocean Territory', 0, NULL, NULL),
(34, '673', 'BN', 'Brunei Darussalam', 0, NULL, NULL),
(35, '359', 'BG', 'Bulgaria', 0, NULL, NULL),
(36, '226', 'BF', 'Burkina Faso', 0, NULL, NULL),
(37, '257', 'BI', 'Burundi', 0, NULL, NULL),
(38, '855', 'KH', 'Cambodia', 0, NULL, NULL),
(39, '237', 'CM', 'Cameroon', 0, NULL, NULL),
(40, '1', 'CA', 'Canada', 0, NULL, NULL),
(41, '238', 'CV', 'Cape Verde', 0, NULL, NULL),
(42, '1345', 'KY', 'Cayman Islands', 0, NULL, NULL),
(43, '236', 'CF', 'Central African Republic', 0, NULL, NULL),
(44, '235', 'TD', 'Chad', 0, NULL, NULL),
(45, '56', 'CL', 'Chile', 0, NULL, NULL),
(46, '86', 'CN', 'China', 0, NULL, NULL),
(47, '61', 'CX', 'Christmas Island', 0, NULL, NULL),
(48, '672', 'CC', 'Cocos (Keeling) Islands', 0, NULL, NULL),
(49, '57', 'CO', 'Colombia', 0, NULL, NULL),
(50, '269', 'KM', 'Comoros', 0, NULL, NULL),
(51, '242', 'CG', 'Congo', 0, NULL, NULL),
(52, '242', 'CD', 'Congo, Democratic Republic of the Congo', 0, NULL, NULL),
(53, '682', 'CK', 'Cook Islands', 0, NULL, NULL),
(54, '506', 'CR', 'Costa Rica', 0, NULL, NULL),
(55, '225', 'CI', 'Cote D\'Ivoire', 0, NULL, NULL),
(56, '385', 'HR', 'Croatia', 0, NULL, NULL),
(57, '53', 'CU', 'Cuba', 0, NULL, NULL),
(58, '599', 'CW', 'Curacao', 0, NULL, NULL),
(59, '357', 'CY', 'Cyprus', 0, NULL, NULL),
(60, '420', 'CZ', 'Czech Republic', 0, NULL, NULL),
(61, '45', 'DK', 'Denmark', 0, NULL, NULL),
(62, '253', 'DJ', 'Djibouti', 0, NULL, NULL),
(63, '1767', 'DM', 'Dominica', 0, NULL, NULL),
(64, '1809', 'DO', 'Dominican Republic', 0, NULL, NULL),
(65, '593', 'EC', 'Ecuador', 0, NULL, NULL),
(66, '20', 'EG', 'Egypt', 0, NULL, NULL),
(67, '503', 'SV', 'El Salvador', 0, NULL, NULL),
(68, '240', 'GQ', 'Equatorial Guinea', 0, NULL, NULL),
(69, '291', 'ER', 'Eritrea', 0, NULL, NULL),
(70, '372', 'EE', 'Estonia', 0, NULL, NULL),
(71, '251', 'ET', 'Ethiopia', 0, NULL, NULL),
(72, '500', 'FK', 'Falkland Islands (Malvinas)', 0, NULL, NULL),
(73, '298', 'FO', 'Faroe Islands', 0, NULL, NULL),
(74, '679', 'FJ', 'Fiji', 0, NULL, NULL),
(75, '358', 'FI', 'Finland', 0, NULL, NULL),
(76, '33', 'FR', 'France', 0, NULL, NULL),
(77, '594', 'GF', 'French Guiana', 0, NULL, NULL),
(78, '689', 'PF', 'French Polynesia', 0, NULL, NULL),
(79, '262', 'TF', 'French Southern Territories', 0, NULL, NULL),
(80, '241', 'GA', 'Gabon', 0, NULL, NULL),
(81, '220', 'GM', 'Gambia', 0, NULL, NULL),
(82, '995', 'GE', 'Georgia', 0, NULL, NULL),
(83, '49', 'DE', 'Germany', 0, NULL, NULL),
(84, '233', 'GH', 'Ghana', 0, NULL, NULL),
(85, '350', 'GI', 'Gibraltar', 0, NULL, NULL),
(86, '30', 'GR', 'Greece', 0, NULL, NULL),
(87, '299', 'GL', 'Greenland', 0, NULL, NULL),
(88, '1473', 'GD', 'Grenada', 0, NULL, NULL),
(89, '590', 'GP', 'Guadeloupe', 0, NULL, NULL),
(90, '1671', 'GU', 'Guam', 0, NULL, NULL),
(91, '502', 'GT', 'Guatemala', 0, NULL, NULL),
(92, '44', 'GG', 'Guernsey', 0, NULL, NULL),
(93, '224', 'GN', 'Guinea', 0, NULL, NULL),
(94, '245', 'GW', 'Guinea-Bissau', 0, NULL, NULL),
(95, '592', 'GY', 'Guyana', 0, NULL, NULL),
(96, '509', 'HT', 'Haiti', 0, NULL, NULL),
(97, '0', 'HM', 'Heard Island and Mcdonald Islands', 0, NULL, NULL),
(98, '39', 'VA', 'Holy See (Vatican City State)', 0, NULL, NULL),
(99, '504', 'HN', 'Honduras', 0, NULL, NULL),
(100, '852', 'HK', 'Hong Kong', 0, NULL, NULL),
(101, '36', 'HU', 'Hungary', 0, NULL, NULL),
(102, '354', 'IS', 'Iceland', 0, NULL, NULL),
(103, '91', 'IN', 'India', 0, NULL, NULL),
(104, '62', 'ID', 'Indonesia', 0, NULL, NULL),
(105, '98', 'IR', 'Iran, Islamic Republic of', 0, NULL, NULL),
(106, '964', 'IQ', 'Iraq', 0, NULL, NULL),
(107, '353', 'IE', 'Ireland', 0, NULL, NULL),
(108, '44', 'IM', 'Isle of Man', 0, NULL, NULL),
(109, '972', 'IL', 'Israel', 0, NULL, NULL),
(110, '39', 'IT', 'Italy', 0, NULL, NULL),
(111, '1876', 'JM', 'Jamaica', 0, NULL, NULL),
(112, '81', 'JP', 'Japan', 0, NULL, NULL),
(113, '44', 'JE', 'Jersey', 0, NULL, NULL),
(114, '962', 'JO', 'Jordan', 0, NULL, NULL),
(115, '7', 'KZ', 'Kazakhstan', 0, NULL, NULL),
(116, '254', 'KE', 'Kenya', 0, NULL, NULL),
(117, '686', 'KI', 'Kiribati', 0, NULL, NULL),
(118, '850', 'KP', 'Korea, Democratic People\'s Republic of', 0, NULL, NULL),
(119, '82', 'KR', 'Korea, Republic of', 0, NULL, NULL),
(120, '381', 'XK', 'Kosovo', 0, NULL, NULL),
(121, '965', 'KW', 'Kuwait', 0, NULL, NULL),
(122, '996', 'KG', 'Kyrgyzstan', 0, NULL, NULL),
(123, '856', 'LA', 'Lao People\'s Democratic Republic', 0, NULL, NULL),
(124, '371', 'LV', 'Latvia', 0, NULL, NULL),
(125, '961', 'LB', 'Lebanon', 0, NULL, NULL),
(126, '266', 'LS', 'Lesotho', 0, NULL, NULL),
(127, '231', 'LR', 'Liberia', 0, NULL, NULL),
(128, '218', 'LY', 'Libyan Arab Jamahiriya', 0, NULL, NULL),
(129, '423', 'LI', 'Liechtenstein', 0, NULL, NULL),
(130, '370', 'LT', 'Lithuania', 0, NULL, NULL),
(131, '352', 'LU', 'Luxembourg', 0, NULL, NULL),
(132, '853', 'MO', 'Macao', 0, NULL, NULL),
(133, '389', 'MK', 'Macedonia, the Former Yugoslav Republic of', 0, NULL, NULL),
(134, '261', 'MG', 'Madagascar', 0, NULL, NULL),
(135, '265', 'MW', 'Malawi', 0, NULL, NULL),
(136, '60', 'MY', 'Malaysia', 0, NULL, NULL),
(137, '960', 'MV', 'Maldives', 0, NULL, NULL),
(138, '223', 'ML', 'Mali', 0, NULL, NULL),
(139, '356', 'MT', 'Malta', 0, NULL, NULL),
(140, '692', 'MH', 'Marshall Islands', 0, NULL, NULL),
(141, '596', 'MQ', 'Martinique', 0, NULL, NULL),
(142, '222', 'MR', 'Mauritania', 0, NULL, NULL),
(143, '230', 'MU', 'Mauritius', 0, NULL, NULL),
(144, '269', 'YT', 'Mayotte', 0, NULL, NULL),
(145, '52', 'MX', 'Mexico', 0, NULL, NULL),
(146, '691', 'FM', 'Micronesia, Federated States of', 0, NULL, NULL),
(147, '373', 'MD', 'Moldova, Republic of', 0, NULL, NULL),
(148, '377', 'MC', 'Monaco', 0, NULL, NULL),
(149, '976', 'MN', 'Mongolia', 0, NULL, NULL),
(150, '382', 'ME', 'Montenegro', 0, NULL, NULL),
(151, '1664', 'MS', 'Montserrat', 0, NULL, NULL),
(152, '212', 'MA', 'Morocco', 0, NULL, NULL),
(153, '258', 'MZ', 'Mozambique', 0, NULL, NULL),
(154, '95', 'MM', 'Myanmar', 0, NULL, NULL),
(155, '264', 'NA', 'Namibia', 0, NULL, NULL),
(156, '674', 'NR', 'Nauru', 0, NULL, NULL),
(157, '977', 'NP', 'Nepal', 0, NULL, NULL),
(158, '31', 'NL', 'Netherlands', 0, NULL, NULL),
(159, '599', 'AN', 'Netherlands Antilles', 0, NULL, NULL),
(160, '687', 'NC', 'New Caledonia', 0, NULL, NULL),
(161, '64', 'NZ', 'New Zealand', 0, NULL, NULL),
(162, '505', 'NI', 'Nicaragua', 0, NULL, NULL),
(163, '227', 'NE', 'Niger', 0, NULL, NULL),
(164, '234', 'NG', 'Nigeria', 0, NULL, NULL),
(165, '683', 'NU', 'Niue', 0, NULL, NULL),
(166, '672', 'NF', 'Norfolk Island', 0, NULL, NULL),
(167, '1670', 'MP', 'Northern Mariana Islands', 0, NULL, NULL),
(168, '47', 'NO', 'Norway', 0, NULL, NULL),
(169, '968', 'OM', 'Oman', 0, NULL, NULL),
(170, '92', 'PK', 'Pakistan', 0, NULL, NULL),
(171, '680', 'PW', 'Palau', 0, NULL, NULL),
(172, '970', 'PS', 'Palestinian Territory, Occupied', 0, NULL, NULL),
(173, '507', 'PA', 'Panama', 0, NULL, NULL),
(174, '675', 'PG', 'Papua New Guinea', 0, NULL, NULL),
(175, '595', 'PY', 'Paraguay', 0, NULL, NULL),
(176, '51', 'PE', 'Peru', 0, NULL, NULL),
(177, '63', 'PH', 'Philippines', 0, NULL, NULL),
(178, '64', 'PN', 'Pitcairn', 0, NULL, NULL),
(179, '48', 'PL', 'Poland', 0, NULL, NULL),
(180, '351', 'PT', 'Portugal', 0, NULL, NULL),
(181, '1787', 'PR', 'Puerto Rico', 0, NULL, NULL),
(182, '974', 'QA', 'Qatar', 0, NULL, NULL),
(183, '262', 'RE', 'Reunion', 0, NULL, NULL),
(184, '40', 'RO', 'Romania', 0, NULL, NULL),
(185, '70', 'RU', 'Russian Federation', 0, NULL, NULL),
(186, '250', 'RW', 'Rwanda', 0, NULL, NULL),
(187, '590', 'BL', 'Saint Barthelemy', 0, NULL, NULL),
(188, '290', 'SH', 'Saint Helena', 0, NULL, NULL),
(189, '1869', 'KN', 'Saint Kitts and Nevis', 0, NULL, NULL),
(190, '1758', 'LC', 'Saint Lucia', 0, NULL, NULL),
(191, '590', 'MF', 'Saint Martin', 0, NULL, NULL),
(192, '508', 'PM', 'Saint Pierre and Miquelon', 0, NULL, NULL),
(193, '1784', 'VC', 'Saint Vincent and the Grenadines', 0, NULL, NULL),
(194, '684', 'WS', 'Samoa', 0, NULL, NULL),
(195, '378', 'SM', 'San Marino', 0, NULL, NULL),
(196, '239', 'ST', 'Sao Tome and Principe', 0, NULL, NULL),
(197, '966', 'SA', 'Saudi Arabia', 0, NULL, NULL),
(198, '221', 'SN', 'Senegal', 0, NULL, NULL),
(199, '381', 'RS', 'Serbia', 0, NULL, NULL),
(200, '381', 'CS', 'Serbia and Montenegro', 0, NULL, NULL),
(201, '248', 'SC', 'Seychelles', 0, NULL, NULL),
(202, '232', 'SL', 'Sierra Leone', 0, NULL, NULL),
(203, '65', 'SG', 'Singapore', 0, NULL, NULL),
(204, '1', 'SX', 'Sint Maarten', 0, NULL, NULL),
(205, '421', 'SK', 'Slovakia', 0, NULL, NULL),
(206, '386', 'SI', 'Slovenia', 0, NULL, NULL),
(207, '677', 'SB', 'Solomon Islands', 0, NULL, NULL),
(208, '252', 'SO', 'Somalia', 0, NULL, NULL),
(209, '27', 'ZA', 'South Africa', 0, NULL, NULL),
(210, '500', 'GS', 'South Georgia and the South Sandwich Islands', 0, NULL, NULL),
(211, '211', 'SS', 'South Sudan', 0, NULL, NULL),
(212, '34', 'ES', 'Spain', 0, NULL, NULL),
(213, '94', 'LK', 'Sri Lanka', 0, NULL, NULL),
(214, '249', 'SD', 'Sudan', 0, NULL, NULL),
(215, '597', 'SR', 'Suriname', 0, NULL, NULL),
(216, '47', 'SJ', 'Svalbard and Jan Mayen', 0, NULL, NULL),
(217, '268', 'SZ', 'Swaziland', 0, NULL, NULL),
(218, '46', 'SE', 'Sweden', 0, NULL, NULL),
(219, '41', 'CH', 'Switzerland', 0, NULL, NULL),
(220, '963', 'SY', 'Syrian Arab Republic', 0, NULL, NULL),
(221, '886', 'TW', 'Taiwan, Province of China', 0, NULL, NULL),
(222, '992', 'TJ', 'Tajikistan', 0, NULL, NULL),
(223, '255', 'TZ', 'Tanzania, United Republic of', 0, NULL, NULL),
(224, '66', 'TH', 'Thailand', 0, NULL, NULL),
(225, '670', 'TL', 'Timor-Leste', 0, NULL, NULL),
(226, '228', 'TG', 'Togo', 0, NULL, NULL),
(227, '690', 'TK', 'Tokelau', 0, NULL, NULL),
(228, '676', 'TO', 'Tonga', 0, NULL, NULL),
(229, '1868', 'TT', 'Trinidad and Tobago', 0, NULL, NULL),
(230, '216', 'TN', 'Tunisia', 0, NULL, NULL),
(231, '90', 'TR', 'Turkey', 0, NULL, NULL),
(232, '7370', 'TM', 'Turkmenistan', 0, NULL, NULL),
(233, '1649', 'TC', 'Turks and Caicos Islands', 0, NULL, NULL),
(234, '688', 'TV', 'Tuvalu', 0, NULL, NULL),
(235, '256', 'UG', 'Uganda', 0, NULL, NULL),
(236, '380', 'UA', 'Ukraine', 0, NULL, NULL),
(237, '971', 'AE', 'United Arab Emirates', 0, NULL, NULL),
(238, '44', 'GB', 'United Kingdom', 0, NULL, NULL),
(239, '1', 'US', 'United States', 0, NULL, NULL),
(240, '1', 'UM', 'United States Minor Outlying Islands', 0, NULL, NULL),
(241, '598', 'UY', 'Uruguay', 0, NULL, NULL),
(242, '998', 'UZ', 'Uzbekistan', 0, NULL, NULL),
(243, '678', 'VU', 'Vanuatu', 0, NULL, NULL),
(244, '58', 'VE', 'Venezuela', 0, NULL, NULL),
(245, '84', 'VN', 'Viet Nam', 0, NULL, NULL),
(246, '1284', 'VG', 'Virgin Islands, British', 0, NULL, NULL),
(247, '1340', 'VI', 'Virgin Islands, U.s.', 0, NULL, NULL),
(248, '681', 'WF', 'Wallis and Futuna', 0, NULL, NULL),
(249, '212', 'EH', 'Western Sahara', 0, NULL, NULL),
(250, '967', 'YE', 'Yemen', 0, NULL, NULL),
(251, '260', 'ZM', 'Zambia', 0, NULL, NULL),
(252, '263', 'ZW', 'Zimbabwe', 0, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `currencies`
--

CREATE TABLE `currencies` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sign` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` double NOT NULL,
  `is_default` tinyint(4) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `currencies`
--

INSERT INTO `currencies` (`id`, `name`, `sign`, `value`, `is_default`, `created_at`, `updated_at`) VALUES
(1, 'USD', '$', 1, 1, NULL, NULL),
(2, 'INR', '₹', 75, 0, NULL, NULL),
(3, 'BRL', 'R$', 5, 0, NULL, NULL),
(4, 'NGN', '₦', 415, 0, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `deposits`
--

CREATE TABLE `deposits` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED DEFAULT NULL,
  `currency` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `currency_code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `currency_value` double DEFAULT NULL,
  `method` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `txnid` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `flutter_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `amount` double DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `deposits`
--

INSERT INTO `deposits` (`id`, `user_id`, `currency`, `currency_code`, `currency_value`, `method`, `txnid`, `flutter_id`, `amount`, `status`, `created_at`, `updated_at`) VALUES
(45, 1, '$', 'USD', 1, 'Paypal', '6CH93503FH976022S', NULL, 10, 1, '2022-06-19 02:58:08', '2022-06-19 02:58:08'),
(46, 1, '₹', 'INR', 75, 'Paytm', '20220619111212800110168110503811729', NULL, 1, 1, '2022-06-19 02:58:57', '2022-06-19 02:59:20'),
(47, 1, 'R$', 'BRL', 5, 'Mercadopago', '1268365032', NULL, 1, 1, '2022-06-19 03:01:23', '2022-06-19 03:01:23'),
(48, 1, '₦', 'NGN', 415, 'Paystack', '152653', NULL, 1, 1, '2022-06-19 03:02:48', '2022-06-19 03:02:48');

-- --------------------------------------------------------

--
-- Table structure for table `domains`
--

CREATE TABLE `domains` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `domain` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(5) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `email_templates`
--

CREATE TABLE `email_templates` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `email_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_subject` mediumtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_body` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `email_templates`
--

INSERT INTO `email_templates` (`id`, `email_type`, `email_subject`, `email_body`, `status`, `created_at`, `updated_at`) VALUES
(1, 'subscription_accept', 'Successfully Purchased', '<p>Hello {customer_name},<br>Your Vendor Account Activated Successfully. Please Login to your account and build your own shop.</p><p>Thank You<br></p>', 1, '2022-04-06 08:29:12', '2022-04-06 08:29:16'),
(2, 'wallet_deposit', 'Deposite Successfully', '<p>Hello {customer_name},<br>Your Wallet Deposit Successfully.</p><p>Thank You<br></p>', 1, '2022-06-12 11:58:36', '2022-06-12 11:58:36');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `fonts`
--

CREATE TABLE `fonts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `font_family` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `font_value` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_default` tinyint(4) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `fonts`
--

INSERT INTO `fonts` (`id`, `font_family`, `font_value`, `is_default`, `created_at`, `updated_at`) VALUES
(1, 'Roboto', 'Roboto', 1, '2022-04-19 03:15:45', '2022-06-29 03:48:00'),
(2, 'cursive', 'cursive', 0, '2022-06-29 03:22:11', '2022-06-29 03:48:00');

-- --------------------------------------------------------

--
-- Table structure for table `f_a_q_s`
--

CREATE TABLE `f_a_q_s` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `details` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `f_a_q_s`
--

INSERT INTO `f_a_q_s` (`id`, `title`, `details`, `status`, `created_at`, `updated_at`) VALUES
(1, 'She jointure goodness interest debat', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut tincidunt, odio vitae elementum ultricies, mauris massa auctor ipsum, vitae finibus odio eros et dui. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Suspendisse potenti. Cras nec nisl ultricies, vestibulum turpis a, cursus erat. Sed lectus turpis, aliquam eget posuere a, congue non risus. Proin consequat, felis id venenatis porttitor, est lorem luctus nulla, a vehicula orci tortor eget erat. Nunc nec sodales mauris, in scelerisque libero. Proin urna felis, egestas id malesuada non, interdum ut mi. Morbi diam lorem, maximus in felis non, fringilla mollis urna.\r\n\r\nVestibulum pulvinar arcu eget ligula dictum, ac dignissim eros aliquam. Vivamus id elementum mauris. Vivamus iaculis nisi erat, at egestas diam rhoncus eget. Suspendisse at metus quam. Nullam egestas dolor nec est elementum tempus et sit amet est. Vestibulum eu diam sit amet enim varius efficitur. Proin laoreet sapien ac lacus euismod, et malesuada nibh consectetur.', 0, '2022-06-22 00:10:34', '2022-06-22 00:10:34'),
(2, 'She jointure goodness interest debat', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut tincidunt, odio vitae elementum ultricies, mauris massa auctor ipsum, vitae finibus odio eros et dui. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Suspendisse potenti. Cras nec nisl ultricies, vestibulum turpis a, cursus erat. Sed lectus turpis, aliquam eget posuere a, congue non risus. Proin consequat, felis id venenatis porttitor, est lorem luctus nulla, a vehicula orci tortor eget erat. Nunc nec sodales mauris, in scelerisque libero. Proin urna felis, egestas id malesuada non, interdum ut mi. Morbi diam lorem, maximus in felis non, fringilla mollis urna.\r\n\r\nVestibulum pulvinar arcu eget ligula dictum, ac dignissim eros aliquam. Vivamus id elementum mauris. Vivamus iaculis nisi erat, at egestas diam rhoncus eget. Suspendisse at metus quam. Nullam egestas dolor nec est elementum tempus et sit amet est. Vestibulum eu diam sit amet enim varius efficitur. Proin laoreet sapien ac lacus euismod, et malesuada nibh consectetur.', 0, '2022-06-22 00:10:52', '2022-06-22 00:10:52'),
(3, 'Six started far placing saw respect', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut tincidunt, odio vitae elementum ultricies, mauris massa auctor ipsum, vitae finibus odio eros et dui. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Suspendisse potenti. Cras nec nisl ultricies, vestibulum turpis a, cursus erat. Sed lectus turpis, aliquam eget posuere a, congue non risus. Proin consequat, felis id venenatis porttitor, est lorem luctus nulla, a vehicula orci tortor eget erat. Nunc nec sodales mauris, in scelerisque libero. Proin urna felis, egestas id malesuada non, interdum ut mi. Morbi diam lorem, maximus in felis non, fringilla mollis urna.\r\n\r\nVestibulum pulvinar arcu eget ligula dictum, ac dignissim eros aliquam. Vivamus id elementum mauris. Vivamus iaculis nisi erat, at egestas diam rhoncus eget. Suspendisse at metus quam. Nullam egestas dolor nec est elementum tempus et sit amet est. Vestibulum eu diam sit amet enim varius efficitur. Proin laoreet sapien ac lacus euismod, et malesuada nibh consectetur.', 0, '2022-06-22 00:11:14', '2022-06-22 00:11:14'),
(4, 'Civilly why how end viewing related', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut tincidunt, odio vitae elementum ultricies, mauris massa auctor ipsum, vitae finibus odio eros et dui. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Suspendisse potenti. Cras nec nisl ultricies, vestibulum turpis a, cursus erat. Sed lectus turpis, aliquam eget posuere a, congue non risus. Proin consequat, felis id venenatis porttitor, est lorem luctus nulla, a vehicula orci tortor eget erat. Nunc nec sodales mauris, in scelerisque libero. Proin urna felis, egestas id malesuada non, interdum ut mi. Morbi diam lorem, maximus in felis non, fringilla mollis urna.\r\n\r\nVestibulum pulvinar arcu eget ligula dictum, ac dignissim eros aliquam. Vivamus id elementum mauris. Vivamus iaculis nisi erat, at egestas diam rhoncus eget. Suspendisse at metus quam. Nullam egestas dolor nec est elementum tempus et sit amet est. Vestibulum eu diam sit amet enim varius efficitur. Proin laoreet sapien ac lacus euismod, et malesuada nibh consectetur.', 0, '2022-06-22 00:11:31', '2022-06-22 00:11:31'),
(5, 'Man particular insensible celebrated', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut tincidunt, odio vitae elementum ultricies, mauris massa auctor ipsum, vitae finibus odio eros et dui. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Suspendisse potenti. Cras nec nisl ultricies, vestibulum turpis a, cursus erat. Sed lectus turpis, aliquam eget posuere a, congue non risus. Proin consequat, felis id venenatis porttitor, est lorem luctus nulla, a vehicula orci tortor eget erat. Nunc nec sodales mauris, in scelerisque libero. Proin urna felis, egestas id malesuada non, interdum ut mi. Morbi diam lorem, maximus in felis non, fringilla mollis urna.\r\n\r\nVestibulum pulvinar arcu eget ligula dictum, ac dignissim eros aliquam. Vivamus id elementum mauris. Vivamus iaculis nisi erat, at egestas diam rhoncus eget. Suspendisse at metus quam. Nullam egestas dolor nec est elementum tempus et sit amet est. Vestibulum eu diam sit amet enim varius efficitur. Proin laoreet sapien ac lacus euismod, et malesuada nibh consectetur.', 0, '2022-06-22 00:11:54', '2022-09-06 03:55:09');

-- --------------------------------------------------------

--
-- Table structure for table `generalsettings`
--

CREATE TABLE `generalsettings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `logo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `favicon` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `header_email` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `header_phone` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `footer` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `copyright` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `colors` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `loader` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `admin_loader` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_talkto` tinyint(4) NOT NULL DEFAULT 1,
  `talkto` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_language` tinyint(4) NOT NULL DEFAULT 1,
  `is_loader` tinyint(4) NOT NULL DEFAULT 1,
  `map_key` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_disqus` tinyint(4) NOT NULL DEFAULT 0,
  `disqus` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_contact` tinyint(4) NOT NULL DEFAULT 0,
  `currency_format` tinyint(4) NOT NULL DEFAULT 0,
  `mail_host` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mail_port` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mail_pass` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `from_email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `from_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_smtp` tinyint(4) NOT NULL DEFAULT 0,
  `is_currency` tinyint(4) NOT NULL DEFAULT 1,
  `is_affilate` tinyint(4) NOT NULL DEFAULT 1,
  `affilate_charge` int(11) NOT NULL DEFAULT 0,
  `affilate_banner` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_admin_loader` tinyint(4) NOT NULL DEFAULT 0,
  `is_verification_email` tinyint(4) NOT NULL DEFAULT 0,
  `is_capcha` tinyint(4) NOT NULL DEFAULT 0,
  `is_cookie` tinyint(4) NOT NULL DEFAULT 0,
  `error_banner` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_popup` tinyint(4) NOT NULL DEFAULT 0,
  `two_factor` int(5) NOT NULL DEFAULT 1,
  `popup-background` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `popup_time` int(11) NOT NULL DEFAULT 0,
  `invoice_logo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_secure` tinyint(4) NOT NULL DEFAULT 0,
  `footer_logo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_encryption` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_maintain` tinyint(4) NOT NULL DEFAULT 0,
  `maintain_text` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `breadcumb_banner` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `register_id` int(11) NOT NULL DEFAULT 0,
  `preloaded` int(11) NOT NULL DEFAULT 0,
  `withdraw_charge` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `withdraw_limit` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ad_reward` double DEFAULT NULL,
  `mail_driver` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mail_encryption` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deactive_text` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_notify_popup` tinyint(4) NOT NULL DEFAULT 0,
  `user_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tax` int(11) NOT NULL DEFAULT 0,
  `captcha_site_key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `captcha_secret_key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `captcha_url` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ad_timeset` int(5) NOT NULL DEFAULT 10,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `mail_user` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `banner` varchar(555) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `avatar` varchar(555) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `splash_data` varchar(555) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `generalsettings`
--

INSERT INTO `generalsettings` (`id`, `logo`, `favicon`, `title`, `header_email`, `header_phone`, `footer`, `copyright`, `colors`, `loader`, `admin_loader`, `is_talkto`, `talkto`, `is_language`, `is_loader`, `map_key`, `is_disqus`, `disqus`, `is_contact`, `currency_format`, `mail_host`, `mail_port`, `mail_pass`, `from_email`, `from_name`, `is_smtp`, `is_currency`, `is_affilate`, `affilate_charge`, `affilate_banner`, `is_admin_loader`, `is_verification_email`, `is_capcha`, `is_cookie`, `error_banner`, `is_popup`, `two_factor`, `popup-background`, `popup_time`, `invoice_logo`, `is_secure`, `footer_logo`, `email_encryption`, `is_maintain`, `maintain_text`, `breadcumb_banner`, `register_id`, `preloaded`, `withdraw_charge`, `withdraw_limit`, `ad_reward`, `mail_driver`, `mail_encryption`, `deactive_text`, `is_notify_popup`, `user_image`, `tax`, `captcha_site_key`, `captcha_secret_key`, `captcha_url`, `ad_timeset`, `created_at`, `updated_at`, `mail_user`, `banner`, `avatar`, `splash_data`) VALUES
(1, '1655702155logo.png', '1649224778GO-logo.jpg', 'This is Default Splash', 'smtp', '0123 456789', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.11', 'COPYRIGHT © 2021. All Rights Reserved By GeniusOcean.com', '#000000', '1649225354load.gif', '1649225352load.gif', 1, NULL, 1, 1, NULL, 1, NULL, 0, 0, 'smtp.mailtrap.io', '2525', 'ebe6bc12381665', 'urlshortner@gmail.com', 'Link Shortner', 1, 1, 1, 0, NULL, 1, 1, 1, 1, '16492290501566878455404.png', 0, 1, NULL, 0, '16678949241655702155logo.png', 0, '16678949221655702155logo.png', NULL, 0, NULL, '1649226594106.png', 0, 0, '1.2', '100', 0.01, 'smtp', 'tls', NULL, 0, NULL, 0, '6Ld7eN8fAAAAANcosrhbJOtdMhXUGMP8tQZDOR1N', '6Ld7eN8fAAAAAH2GVnsiZeb2dcV5z9xPlbFDYqAX', 'https://www.google.com/recaptcha/api/siteverify', 10, NULL, NULL, '073c69c2b4aaf7', '1667895719.png', '1667895719.wRpng', '{\"title\":\"This is Default Splash\",\"counter\":\"10\",\"product\":\"https:\\/\\/codecanyon.net\\/user\\/geniusocean\\/portfolio\",\"description\":\"<p>You can change this default splash from Admin Panel GeneralSetting option. User can also create custom splash from user panel.<\\/p>\"}');

-- --------------------------------------------------------

--
-- Table structure for table `languages`
--

CREATE TABLE `languages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `rtl` tinyint(4) NOT NULL DEFAULT 0,
  `is_default` tinyint(4) NOT NULL DEFAULT 0,
  `language` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `file` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `languages`
--

INSERT INTO `languages` (`id`, `rtl`, `is_default`, `language`, `name`, `file`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 'EN', '1636017050KyjRNauw', '1636017050KyjRNauw.json', NULL, '2022-06-26 02:53:50'),
(3, 0, 0, 'Bangla', '1656233619opajF5TB', '1656233619opajF5TB.json', '2022-06-25 23:37:01', '2022-06-26 02:53:50');

-- --------------------------------------------------------

--
-- Table structure for table `links`
--

CREATE TABLE `links` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) DEFAULT NULL,
  `alias` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `custom` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `location` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `devices` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `domain` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `click` bigint(20) NOT NULL DEFAULT 0,
  `meta_title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_description` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0,
  `expire_day` bigint(20) DEFAULT NULL,
  `planid` bigint(20) DEFAULT NULL,
  `type` varchar(555) COLLATE utf8mb4_unicode_ci DEFAULT 'direct',
  `splash_id` int(5) DEFAULT NULL,
  `overlay_id` int(55) DEFAULT NULL,
  `pixel` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2022_04_05_064323_create_admins_table', 1),
(6, '2022_04_05_084050_create_generalsettings_table', 2),
(8, '2022_04_06_080934_create_email_templates_table', 3),
(9, '2022_04_06_085648_add_mailuser_to_generalsettings_table', 4),
(11, '2022_04_06_101845_create_subscribers_table', 6),
(16, '2014_10_12_000000_create_users_table', 8),
(18, '2022_04_12_054459_create_admin_user_messages_table', 9),
(19, '2022_04_12_054148_create_admin_user_conversations_table', 10),
(20, '2022_04_12_081803_create_links_table', 11),
(21, '2022_04_17_065017_create_advertisements_table', 12),
(22, '2022_04_17_095020_create_pament_gateways_table', 13),
(23, '2022_04_18_073047_create_currencies_table', 14),
(25, '2022_04_18_082430_create_blog__categories_table', 15),
(26, '2022_04_18_082319_create_blogs_table', 16),
(27, '2022_04_18_095620_create_roles_table', 17),
(28, '2022_04_19_051330_create_socialsettings_table', 18),
(29, '2022_04_19_054336_create_seotools_table', 19),
(31, '2022_04_19_074317_create_languages_table', 21),
(34, '2022_04_19_083409_create_fonts_table', 22),
(35, '2022_04_19_095224_create_withdraws_table', 23),
(36, '2022_05_10_102519_add_email_verified_to_users_table', 24),
(39, '2022_05_11_082949_create_countries_table', 25),
(40, '2022_04_09_075552_create_subscriptions_table', 26),
(41, '2022_05_12_090711_create_pagesettings_table', 27),
(43, '2022_05_15_050245_create_user_subscriptions_table', 28),
(44, '2022_05_18_040028_create_services_table', 29),
(45, '2022_05_18_061120_create_reviews_table', 30),
(46, '2022_05_22_074728_create_notifications_table', 31),
(49, '2022_06_12_104351_create_deposits_table', 32),
(50, '2022_06_12_110046_create_transactions_table', 32),
(51, '2022_06_20_061604_create_pages_table', 33),
(53, '2022_06_20_084457_create_f_a_q_s_table', 34),
(54, '2022_06_26_082804_create_adminpanel_languages_table', 35),
(55, '2022_07_05_043601_create_social_providers_table', 36),
(56, '2022_10_17_044603_create_splashes_table', 37),
(57, '2022_10_20_082504_create_overlays_table', 38),
(58, '2022_11_03_092442_create_domains_table', 39),
(59, '2022_11_16_091027_create_pixels_table', 40),
(60, '2022_11_24_081012_create_qr_codes_table', 41);

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` tinyint(4) NOT NULL,
  `conversation_id` tinyint(4) NOT NULL,
  `is_read` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `user_id`, `conversation_id`, `is_read`, `created_at`, `updated_at`) VALUES
(1, 1, 6, 0, '2022-05-22 02:42:51', '2022-05-22 02:42:51'),
(2, 1, 7, 0, '2022-05-22 03:11:36', '2022-05-22 03:11:36'),
(3, 1, 8, 0, '2022-05-22 03:20:09', '2022-05-22 03:20:09'),
(4, 1, 9, 0, '2022-05-22 03:23:25', '2022-05-22 03:23:25'),
(5, 1, 10, 0, '2022-05-22 04:07:43', '2022-05-22 04:07:43'),
(6, 1, 9, 0, '2022-05-23 05:12:29', '2022-05-23 05:12:29'),
(7, 1, 9, 0, '2022-05-23 05:15:22', '2022-05-23 05:15:22'),
(8, 1, 9, 0, '2022-05-23 05:17:36', '2022-05-23 05:17:36'),
(9, 1, 9, 0, '2022-05-23 05:17:43', '2022-05-23 05:17:43'),
(10, 1, 9, 0, '2022-05-23 05:17:57', '2022-05-23 05:17:57'),
(11, 1, 10, 0, '2022-05-23 05:20:40', '2022-05-23 05:20:40'),
(12, 1, 10, 0, '2022-05-23 05:25:54', '2022-05-23 05:25:54'),
(13, 1, 10, 0, '2022-05-23 05:28:17', '2022-05-23 05:28:17'),
(14, 1, 10, 0, '2022-05-23 05:28:52', '2022-05-23 05:28:52'),
(15, 1, 11, 0, '2022-07-05 03:40:43', '2022-07-05 03:40:43'),
(16, 1, 11, 0, '2022-07-05 03:42:02', '2022-07-05 03:42:02'),
(17, 1, 11, 0, '2022-07-05 03:42:10', '2022-07-05 03:42:10'),
(18, 1, 11, 0, '2022-07-05 03:43:29', '2022-07-05 03:43:29'),
(19, 1, 11, 0, '2022-07-05 03:46:23', '2022-07-05 03:46:23'),
(20, 1, 11, 0, '2022-07-05 03:46:31', '2022-07-05 03:46:31'),
(21, 1, 11, 0, '2022-07-05 03:48:28', '2022-07-05 03:48:28'),
(22, 1, 11, 0, '2022-07-05 03:48:37', '2022-07-05 03:48:37'),
(23, 1, 10, 0, '2022-07-05 03:49:15', '2022-07-05 03:49:15'),
(24, 1, 11, 0, '2022-07-05 03:50:02', '2022-07-05 03:50:02'),
(25, 1, 10, 0, '2022-07-05 03:52:28', '2022-07-05 03:52:28'),
(26, 1, 10, 0, '2022-07-05 03:53:07', '2022-07-05 03:53:07'),
(27, 1, 11, 0, '2022-07-05 03:53:19', '2022-07-05 03:53:19'),
(28, 1, 11, 0, '2022-07-05 03:57:08', '2022-07-05 03:57:08'),
(29, 1, 11, 0, '2022-07-05 03:58:56', '2022-07-05 03:58:56'),
(30, 1, 11, 0, '2022-07-05 04:01:42', '2022-07-05 04:01:42'),
(31, 1, 11, 0, '2022-07-05 04:02:40', '2022-07-05 04:02:40'),
(32, 1, 11, 0, '2022-07-05 04:02:46', '2022-07-05 04:02:46');

-- --------------------------------------------------------

--
-- Table structure for table `overlays`
--

CREATE TABLE `overlays` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `data` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `overlays`
--

INSERT INTO `overlays` (`id`, `user_id`, `name`, `type`, `data`, `created_at`, `updated_at`) VALUES
(4, 1, 'First Overlay', 'contact', '{\"email\":\"admin@gmail.com\",\"subject\":\"This is test\",\"label\":\"Mail Send\"}', '2022-10-29 21:46:49', '2022-10-29 21:46:49'),
(5, 1, 'Identification', 'poll', '{\"question\":\"Where are you from?\",\"options\":[\"Comilla\",\"Dhaka\"]}', '2022-10-29 22:26:21', '2022-10-29 22:26:21'),
(14, 1, 'Message', 'message', '{\"message\":\"Hello\",\"link\":\"https:\\/\\/codecanyon.net\\/user\\/geniusocean\\/portfolio\",\"image\":\"1667387375.aEpng\",\"button\":\"Learn More\",\"label\":\"New\"}', '2022-11-02 05:09:35', '2022-11-02 05:09:35');

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

CREATE TABLE `pages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `details` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `photo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_keywords` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `header` tinyint(4) NOT NULL DEFAULT 0,
  `footer` tinyint(4) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `status` int(5) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pages`
--

INSERT INTO `pages` (`id`, `title`, `slug`, `details`, `photo`, `meta_title`, `meta_description`, `meta_keywords`, `header`, `footer`, `created_at`, `updated_at`, `status`) VALUES
(1, 'About Us', 'about', '<p>Ratione, cupiditate laboriosam nulla eaque.\r\nModi illo, porro minus voluptates delectus dignissimos facilis. Debitis animi, mollitia nostrum obcaecati, officia suscipit saepe dolores ratione, cupiditate laboriosam nulla eaque.\r\n\r\nDignissimos facilis. Debitis animi, mollitia nostrum\r\n Modi illo, porro minus voluptates delectus\r\n dignissimos facilis. Debitis animi, mollitia nostrum\r\n obcaecati, officia suscipit saepe dolores\r\n ratione, cupiditate laboriosam nulla eaque.\r\nModi illo, porro minus voluptates delectus\r\nModi illo, porro minus voluptates delectus\r\ndignissimos facilis. Debitis animi, mollitia nostrum\r\nobcaecati, officia suscipit saepe dolores\r\nratione, cupiditate laboriosam nulla eaque.<span style=\"color: rgb(84, 84, 84); font-family: &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif; font-size: 1rem;\">Hi!</span></p><p style=\"margin-right: 0px; margin-bottom: 20px; margin-left: 0px; padding: 0px; color: rgb(84, 84, 84); font-family: &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif;\">We are GeniusOcean, expert in any kind of Graphic Design, Web Design and Web Development work. We are working as freelancer since 2011 and Completed more than 5400 projects all over the world. We are one of the most loved PHP Laravel script seller at codecanyon and we have sold more than $250000 USD and became ELITE AUTHOR here.<br><br>We are working to produce few quality products for codecanyon. We always believe in quality and our coding is very clean for both frontend and backend.<br><br>We not only sell products here but also take custom orders for any kind of web and Flutter projects. We also customize our products according to clients needs for additional reliable charge.<br><br>Feel free to contact anytime and you will get response within 24 hours.</p><p><b> </b></p>', NULL, NULL, 'This is page meta description', 'about,url', 0, 0, '2022-06-20 03:05:37', '2022-09-06 04:28:21', 1);

-- --------------------------------------------------------

--
-- Table structure for table `pagesettings`
--

CREATE TABLE `pagesettings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `hero_info` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `hero_title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `hero_text` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `brand_title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `brand_text` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pricing_title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pricing_text` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contact_info` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contact_title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contact_text` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `street` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `review_title` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `review_text` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pagesettings`
--

INSERT INTO `pagesettings` (`id`, `hero_info`, `hero_title`, `hero_text`, `brand_title`, `brand_text`, `pricing_title`, `pricing_text`, `contact_info`, `contact_title`, `contact_text`, `street`, `phone`, `email`, `review_title`, `review_text`, `created_at`, `updated_at`) VALUES
(1, 'URL Shortner', 'Here you have full control over your links.', 'Link Management Platform with all features you need in one place. Shorten, brand, manage and track your links the easy way. 11122', 'Link analytics, branded urls, URL shortener', 'Don\'t let the links limit you. Make your links support your brand. The new standard of shortening links. A new standard for link analytics.', 'Genius Short Pricing', 'Don\'t let the links limit you. Make your links support your brand. The new standard of shortening links. A new standard for link analytics.', 'Contact US', 'Get In Touch', 'Deserunt hic consequatur ex placeat! atque repellendus inventore quisquam, perferendis, eum reiciendis quia nesciunt fug 111', '134 Fifth Ave, New York, NY 12004, United States', '+012345678999', 'pronobsarker16@gmail.com', 'Happy Clients Reviews', 'Don\'t let the links limit you. Make your links support your brand. The new standard of shortening links. A new standard for link analytics.', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `pament_gateways`
--

CREATE TABLE `pament_gateways` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `subtitle` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `details` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` tinyint(4) NOT NULL DEFAULT 0,
  `information` mediumtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `keyword` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pament_gateways`
--

INSERT INTO `pament_gateways` (`id`, `subtitle`, `title`, `details`, `name`, `type`, `information`, `keyword`, `status`, `created_at`, `updated_at`) VALUES
(1, NULL, NULL, NULL, 'stripe', 0, '{\"key\":\"pk_test_UnU1Coi1p5qFGwtpjZMRMgJM\",\"secret\":\"sk_test_QQcg3vGsKRPlW6T3dXcNJsor\",\"text\":\"Pay via your Credit Card.\"}', 'stripe', 1, '2022-04-17 10:22:00', '2022-04-17 10:22:05'),
(2, NULL, NULL, NULL, 'Paystac', 0, '{\"key\":\"pk_test_162a56d42131cbb01932ed0d2c48f9cb99d8e8e2\",\"email\":\"junnuns@gmail.com\",\"text\":\"Pay via your Paystack account.\"}', 'paystac', 1, NULL, NULL),
(3, NULL, NULL, NULL, 'Mercadopago', 0, '{\"public_key\":\"TEST-6f72a502-51c8-4e9a-8ca3-cb7fa0addad8\",\"token\":\"TEST-6068652511264159-022306-e78da379f3963916b1c7130ff2906826-529753482\",\"sandbox_check\":1,\"text\":\"Pay Via MercadoPago\"}', 'mercadopago', 1, NULL, NULL),
(4, NULL, NULL, NULL, 'Instamojo', 0, '{\"key\":\"test_172371aa837ae5cad6047dc3052\",\"token\":\"test_4ac5a785e25fc596b67dbc5c267\",\"sandbox_check\":1,\"text\":\"Pay via your Instamojo account.\"}', 'instamojo', 1, NULL, NULL),
(5, NULL, NULL, NULL, 'Flutter Wave', 0, '{\"public_key\":\"FLWPUBK_TEST-299dc2c8bf4c7f14f7d7f48c32433393-X\",\"secret_key\":\"FLWSECK_TEST-afb1f2a4789002d7c0f2185b830450b7-X\",\"text\":\"Pay via your Flutter Wave account.\"}', 'flutterwave', 1, NULL, NULL),
(6, NULL, NULL, NULL, 'Paytm', 0, '{\"merchant\":\"tkogux49985047638244\",\"secret\":\"LhNGUUKE9xCQ9xY8\",\"website\":\"WEBSTAGING\",\"industry\":\"Retail\",\"sandbox_check\":1,\"text\":\"Pay via your Paytm account.\"}', 'paytm', 1, NULL, NULL),
(7, NULL, NULL, NULL, 'paypal', 0, '{\"client_id\":\"AcWYnysKa_elsQIAnlfsJXokR64Z31CeCbpis9G3msDC-BvgcbAwbacfDfEGSP-9Dp9fZaGgD05pX5Qi\",\"client_secret\":\"EGZXTq6d6vBPq8kysVx8WQA5NpavMpDzOLVOb9u75UfsJ-cFzn6aeBXIMyJW2lN1UZtJg5iDPNL9ocYE\",\"sandbox_check\":1,\"text\":\"Pay via your PayPal account.\"}', 'paypal', 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payment_gateways`
--

CREATE TABLE `payment_gateways` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `subtitle` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `details` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` enum('manual','automatic') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'manual',
  `information` mediumtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `keyword` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `payment_gateways`
--

INSERT INTO `payment_gateways` (`id`, `subtitle`, `title`, `details`, `name`, `type`, `information`, `keyword`, `status`, `created_at`, `updated_at`) VALUES
(1, NULL, NULL, NULL, 'stripe', 'automatic', '{\"key\":\"pk_test_UnU1Coi1p5qFGwtpjZMRMgJM\",\"secret\":\"sk_test_QQcg3vGsKRPlW6T3dXcNJsor\",\"text\":\"Pay via your Credit Card.\"}', 'stripe', 1, NULL, NULL),
(2, NULL, NULL, NULL, 'Paystack', 'automatic', '{\"key\":\"pk_test_162a56d42131cbb01932ed0d2c48f9cb99d8e8e2\",\"email\":\"junnuns@gmail.com\",\"text\":\"Pay via your Paystack account.\"}', 'paystack', 1, NULL, NULL),
(3, NULL, NULL, NULL, 'Mercado pago', 'automatic', '{\"public_key\":\"TEST-6f72a502-51c8-4e9a-8ca3-cb7fa0addad8\",\"token\":\"TEST-6068652511264159-022306-e78da379f3963916b1c7130ff2906826-529753482\",\"sandbox_check\":1,\"text\":\"Pay Via MercadoPago\"}', 'mercadopago', 1, NULL, NULL),
(4, NULL, NULL, NULL, 'Instamojo', 'automatic', '{\"key\":\"test_172371aa837ae5cad6047dc3052\",\"token\":\"test_4ac5a785e25fc596b67dbc5c267\",\"sandbox_check\":1,\"text\":\"Pay via your Instamojo account.\"}', 'instamojo', 1, '2021-08-18 04:22:52', NULL),
(5, NULL, NULL, NULL, 'Flutter Wave', 'automatic', '{\"public_key\":\"FLWPUBK_TEST-299dc2c8bf4c7f14f7d7f48c32433393-X\",\"secret_key\":\"FLWSECK_TEST-afb1f2a4789002d7c0f2185b830450b7-X\",\"text\":\"Pay via your Flutter Wave account.\"}', 'flutterwave', 1, NULL, NULL),
(6, NULL, NULL, NULL, 'Paytm', 'automatic', '{\"merchant\":\"tkogux49985047638244\",\"secret\":\"LhNGUUKE9xCQ9xY8\",\"website\":\"WEBSTAGING\",\"industry\":\"Retail\",\"sandbox_check\":1,\"text\":\"Pay via your Paytm account.\"}', 'paytm', 1, NULL, NULL),
(15, NULL, NULL, NULL, 'paypal', 'automatic', '{\"client_id\":\"AcWYnysKa_elsQIAnlfsJXokR64Z31CeCbpis9G3msDC-BvgcbAwbacfDfEGSP-9Dp9fZaGgD05pX5Qi\",\"client_secret\":\"EGZXTq6d6vBPq8kysVx8WQA5NpavMpDzOLVOb9u75UfsJ-cFzn6aeBXIMyJW2lN1UZtJg5iDPNL9ocYE\",\"sandbox_check\":1,\"text\":\"Pay via your PayPal account.\"}', 'paypal', 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pixels`
--

CREATE TABLE `pixels` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tag` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pixels`
--

INSERT INTO `pixels` (`id`, `user_id`, `type`, `name`, `tag`, `created_at`, `updated_at`) VALUES
(1, 1, 'facebook', 'test', '1193334787923539', '2022-11-17 03:57:51', '2022-11-17 03:57:51');

-- --------------------------------------------------------

--
-- Table structure for table `poll_answers`
--

CREATE TABLE `poll_answers` (
  `id` int(10) NOT NULL,
  `poll_id` int(10) DEFAULT NULL,
  `link_id` int(10) DEFAULT NULL,
  `answer` varchar(255) DEFAULT NULL,
  `question` varchar(255) DEFAULT NULL,
  `ipaddress` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `poll_answers`
--

INSERT INTO `poll_answers` (`id`, `poll_id`, `link_id`, `answer`, `question`, `ipaddress`) VALUES
(1, 5, 5, 'Comilla', 'Where are you from?', '::1');

-- --------------------------------------------------------

--
-- Table structure for table `qr_codes`
--

CREATE TABLE `qr_codes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `alias` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `urlid` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `data` varchar(555) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `details` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `photo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `rating` double DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`id`, `name`, `details`, `photo`, `rating`, `created_at`, `updated_at`) VALUES
(1, 'Peter Parkar', 'Incidunt maxime necessitatibus maiores voluptate, error vero velit, consequuntur ut porro cumque beatae sed repellendus in non nulla at!', '1652866839client1.jpg', 4, '2022-05-18 03:40:39', '2022-05-18 03:40:39'),
(2, 'Stephen Gerrard', 'Incidunt maxime necessitatibus maiores voluptate, error vero velit, consequuntur ut porro cumque beatae sed repellendus in non nulla at!', '1652934387client2.jpg', 5, '2022-05-18 22:26:27', '2022-05-18 22:26:27'),
(3, 'Robot Smith', 'Incidunt maxime necessitatibus maiores voluptate, error vero velit, consequuntur ut porro cumque beatae sed repellendus in non nulla at!', '1652934434client3.jpg', 5, '2022-05-18 22:27:14', '2022-05-18 22:27:14'),
(4, 'Jhon Smilga', 'Incidunt maxime necessitatibus maiores voluptate, error vero velit, consequuntur ut porro cumque beatae sed repellendus in non nulla at!111', '1652934515client4.jpg', 5, '2022-05-18 22:28:35', '2022-09-06 03:51:54');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `section` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `section`, `created_at`, `updated_at`) VALUES
(1, 'pronob', 'Link Management , Advertisement , Manage Orders , Plan , General Setting , Homepage Setting , Email Setting , Users , Messages', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `seotools`
--

CREATE TABLE `seotools` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `google_analytics` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_keys` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_title` varchar(555) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_description` varchar(555) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `seotools`
--

INSERT INTO `seotools` (`id`, `google_analytics`, `meta_keys`, `meta_title`, `meta_description`, `created_at`, `updated_at`) VALUES
(1, 'doesn\'t save kkk', 'Genius, Ocean,', 'srtert', '<p>wretwret111</p>', '2022-04-19 05:54:50', '2022-04-19 05:54:50');

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `details` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `photo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`id`, `title`, `details`, `photo`, `created_at`, `updated_at`) VALUES
(1, 'Easy', 'ShortURL is easy and fast, enter the long link to get your shortened link', '16528495101.png', '2022-05-17 22:51:50', '2022-05-17 22:51:50'),
(2, 'Shortened', 'Use any link, no matter what size, ShortURL always shortens', '16528495372.png', '2022-05-17 22:52:17', '2022-05-17 22:52:17'),
(3, 'Secure', 'It is fast and secure, our service have HTTPS protocol and data encryption', '16528495593.png', '2022-05-17 22:52:39', '2022-05-17 22:52:39'),
(4, 'Statistics', 'Check the amount of clicks that your shortened url received', '16528495794.png', '2022-05-17 22:52:59', '2022-05-17 22:52:59'),
(5, 'Reliable', 'All links that try to disseminate spam, viruses and malware are deleted', '16528495995.png', '2022-05-17 22:53:19', '2022-05-17 22:53:19');

-- --------------------------------------------------------

--
-- Table structure for table `socialsettings`
--

CREATE TABLE `socialsettings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `facebook` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gplus` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `twitter` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `linkedin` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `instagram` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `f_status` tinyint(4) NOT NULL DEFAULT 1,
  `g_status` tinyint(4) NOT NULL DEFAULT 1,
  `t_status` tinyint(4) NOT NULL DEFAULT 1,
  `l_status` tinyint(4) NOT NULL DEFAULT 1,
  `i_status` tinyint(4) NOT NULL DEFAULT 1,
  `f_check` tinyint(4) DEFAULT NULL,
  `g_check` tinyint(4) DEFAULT NULL,
  `fclient_id` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fclient_secret` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fredirect` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gclient_id` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gclient_secret` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gredirect` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `socialsettings`
--

INSERT INTO `socialsettings` (`id`, `facebook`, `gplus`, `twitter`, `linkedin`, `instagram`, `f_status`, `g_status`, `t_status`, `l_status`, `i_status`, `f_check`, `g_check`, `fclient_id`, `fclient_secret`, `fredirect`, `gclient_id`, `gclient_secret`, `gredirect`, `created_at`, `updated_at`) VALUES
(1, 'https://www.facebook.com/', 'https://www.google.com/', 'https://twitter.com/', 'https://www.linkedin.com/', 'https://instagram.com/', 1, 1, 1, 1, 1, 1, 1, '503140663460329', 'f66cd670ec43d14209a2728af26dcc43', 'https://localhost/pro-short/auth/facebook/callback', '904681031719-sh1aolu42k7l93ik0bkcboghbpcfi.apps.googleusercontent.com', 'J1gm6PohXAHFhN1cYdSDf7B8', 'http://localhost/pro-short/auth/google/callback', NULL, '2021-06-30 21:28:13');

-- --------------------------------------------------------

--
-- Table structure for table `social_providers`
--

CREATE TABLE `social_providers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `provider_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `provider` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `splashes`
--

CREATE TABLE `splashes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `data` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `banner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `avatar` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `splashes`
--

INSERT INTO `splashes` (`id`, `user_id`, `name`, `data`, `banner`, `avatar`, `created_at`, `updated_at`) VALUES
(4, 1, 'testtt', '{\"counter\":\"10\",\"title\":\"get 10$ discount\",\"product\":\"https:\\/\\/www.fiverr.com\\/users\\/softwarebakery\\/requests\",\"description\":null}', '1667896246.png', '1667896246.1Ijpg', '2022-10-17 22:25:09', '2022-11-08 02:30:46');

-- --------------------------------------------------------

--
-- Table structure for table `subscribers`
--

CREATE TABLE `subscribers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `subscribers`
--

INSERT INTO `subscribers` (`id`, `email`, `created_at`, `updated_at`) VALUES
(1, 'pronobsarker16@gmail.com', '2022-04-07 10:12:36', '2022-04-07 10:12:36'),
(2, 'user@gmail.com', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `subscriptions`
--

CREATE TABLE `subscriptions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `days` int(11) DEFAULT NULL,
  `price` double DEFAULT NULL,
  `free` tinyint(4) NOT NULL DEFAULT 0,
  `expired_limit` bigint(50) DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0,
  `details` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `allowed_url` bigint(20) DEFAULT NULL,
  `click_limit` bigint(20) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `subscriptions`
--

INSERT INTO `subscriptions` (`id`, `title`, `slug`, `days`, `price`, `free`, `expired_limit`, `status`, `details`, `allowed_url`, `click_limit`, `created_at`, `updated_at`) VALUES
(0, 'Free', 'free', 7, 50, 0, 5, 1, NULL, 7, 5, '2022-06-05 03:37:51', '2022-10-18 04:35:35'),
(2, 'Basic', 'basic', 30, 20, 0, 10, 1, 'Ad quis nulla fuga111', 300, 3000, '2022-05-11 23:42:35', '2022-10-18 04:35:31');

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `txn_number` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `amount` double NOT NULL DEFAULT 0,
  `currency_sign` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `currency_code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `currency_value` double DEFAULT NULL,
  `method` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `txnid` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `details` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`id`, `user_id`, `txn_number`, `amount`, `currency_sign`, `currency_code`, `currency_value`, `method`, `txnid`, `details`, `type`, `created_at`, `updated_at`) VALUES
(22, 1, 'ixB9088aM8', 10, '$', 'USD', 1, 'Paypal', '6CH93503FH976022S', 'Payment Deposit', 'plus', '2022-06-19 02:58:08', '2022-06-19 02:58:08'),
(23, 1, '5yQ9160u36', 1, '₹', 'INR', 75, 'Paytm', '20220619111212800110168110503811729', 'Payment Deposit', 'plus', '2022-06-19 02:59:20', '2022-06-19 02:59:20'),
(24, 1, 'twG9283yYT', 1, 'R$', 'BRL', 5, 'Mercadopago', '1268365032', 'Payment Deposit', 'plus', '2022-06-19 03:01:23', '2022-06-19 03:01:23'),
(25, 1, 'W2U9368MpJ', 1, '₦', 'NGN', 415, 'Paystack', NULL, 'Payment Deposit', 'plus', '2022-06-19 03:02:48', '2022-06-19 03:02:48'),
(26, 1, 'mGO1556aif', 19.76, '$', 'USD', 1, 'Paypal', '9MW1556Ziw', 'Withdraw', 'minus', '2022-06-27 00:32:36', '2022-06-27 00:32:36'),
(27, 1, 'cmw4277r8p', 20, '$', 'USD', 1, 'Wallet', 'Not Available', 'Payment for subscription plan', 'minus', '2022-06-27 04:04:37', '2022-06-27 04:04:37'),
(28, 1, '5B34570xPS', 20, '$', 'USD', 1, 'Stripe', 'not available', 'Payment for subscription plan', 'minus', '2022-06-27 04:09:30', '2022-06-27 04:09:30'),
(29, 1, 'tQr1102JT4', 20, '$', 'USD', 1, 'Paypal', 'Pyo1102UYL', 'Withdraw', 'minus', '2022-06-29 05:11:42', '2022-06-29 05:11:42'),
(30, 1, 'xWq2047NRC', 20, '$', 'USD', 1, 'Stripe', 'not available', 'Payment for subscription plan', 'minus', '2022-08-29 12:47:27', '2022-08-29 12:47:27'),
(31, 1, '2pL4024yJ2', 20, '$', 'USD', 1, 'Paypal', '6Y654024GS830562U', 'Payment for subscription plan', 'minus', '2022-10-18 03:07:04', '2022-10-18 03:07:04'),
(32, 1, 'Dpz1530nQr', 20, '$', 'USD', 1, 'Stripe', 'not available', 'Payment for subscription plan', 'minus', '2022-11-17 04:38:50', '2022-11-17 04:38:50');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `photo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fax` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `active` tinyint(4) NOT NULL DEFAULT 1,
  `ban` tinyint(4) NOT NULL DEFAULT 0,
  `go` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `twofa` int(5) NOT NULL DEFAULT 0,
  `api` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `public` tinyint(4) NOT NULL DEFAULT 0,
  `domain` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `media` tinyint(4) NOT NULL DEFAULT 0,
  `planid` int(11) NOT NULL DEFAULT 0,
  `email_verified` tinyint(4) DEFAULT NULL,
  `verification_link` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` int(5) NOT NULL DEFAULT 0,
  `date` date DEFAULT NULL,
  `amount` double NOT NULL DEFAULT 0,
  `mail_sent` int(5) NOT NULL DEFAULT 0,
  `email_token` text COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `photo`, `address`, `country`, `phone`, `fax`, `active`, `ban`, `go`, `twofa`, `api`, `public`, `domain`, `media`, `planid`, `email_verified`, `verification_link`, `status`, `date`, `amount`, `mail_sent`, `email_token`) VALUES
(1, 'userrr', 'username1', 'user@gmail.com', '2022-05-15 04:01:24', '$2y$10$WhU75SYH7BjI1G7g7I6GhOqBxrD1lf48kcMGgVgobJWwu0Vk31UY6', NULL, '2022-05-15 04:01:14', '2022-11-17 04:45:02', '1665994876tie_man_avatar_200_x_200_by_froggyartdesigns_dchixe8-fullview.jpg', 'Uttara, Sector-10', '880', '1976814812', '123456', 1, 0, NULL, 0, NULL, 0, NULL, 0, 2, 1, '8f04818c8905d5c95f2d21a2252510cduserpronobsarker16@gmail.com', 1, '2022-12-17', 28.14, 1, NULL),
(22, 'user', 'username', 'shaon@gmail.com', '2022-05-15 04:01:24', '$2a$12$oAeZQrda1xw8qA0SbunHke270/JVG5ZRJOXc/90wkWYXr4H5tmNoC', NULL, '2022-05-15 04:01:14', '2022-07-07 03:28:51', '16565011761556780563user.png', 'Uttara, Sector-10', '880', '1976814812', '123456', 1, 0, NULL, 0, NULL, 0, NULL, 0, 2, 1, '8f04818c8905d5c95f2d21a2252510cduserpronobsarker16@gmail.com', 1, '2022-07-29', 8.06, 1, '43ef2aba4215a8854b9eec73ac3550e0'),
(27, 'pronob', NULL, 'pronobsarker16@gmail.com', NULL, '$2y$10$3radm.57nWHZVS37IxD1Q.FOEdOKv6VSxY06X6CJWH.hPR8MCI3Xi', NULL, '2022-11-01 00:38:02', '2022-11-01 00:38:02', NULL, NULL, '880', '01976814812', NULL, 1, 0, NULL, 0, NULL, 0, NULL, 0, 0, NULL, 'ae1879dbbd0b453298dd7db19a400703pronobpronobsarker16@gmail.com', 0, NULL, 0, 0, NULL),
(28, 'pronob', NULL, 'admtin@gmail.com', NULL, '$2y$10$yWkDLyh9w.py2QcQel1yku7LnFrI88TGPh5Mbk4JT5giwjGHJQF2C', NULL, '2022-11-01 00:42:37', '2022-11-01 00:42:37', NULL, NULL, '1242', '43545', NULL, 1, 0, NULL, 0, NULL, 0, NULL, 0, 0, NULL, 'd53f7127ce87615c3d3922e2cb0f8a93pronobadmtin@gmail.com', 0, NULL, 0, 0, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_subscriptions`
--

CREATE TABLE `user_subscriptions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `subscription_id` int(11) NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` double NOT NULL,
  `days` int(11) NOT NULL,
  `allowed_url` bigint(20) NOT NULL,
  `click_limit` bigint(20) NOT NULL,
  `method` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `txnid` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `charge_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payment_number` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_subscriptions`
--

INSERT INTO `user_subscriptions` (`id`, `user_id`, `subscription_id`, `title`, `price`, `days`, `allowed_url`, `click_limit`, `method`, `txnid`, `charge_id`, `payment_number`, `status`, `created_at`, `updated_at`) VALUES
(36, 1, 2, 'Basic', 20, 30, 300, 3000, 'Paytm', '20220517111212800110168002903706525', NULL, NULL, 0, '2022-05-17 05:26:31', '2022-05-17 05:27:01'),
(37, 1, 2, 'Basic', 20, 30, 299, 300, 'Stripe', 'txn_3L7ErZJlIV5dN9n71G1KrEVw', 'ch_3L7ErZJlIV5dN9n71d1yigkw', NULL, 0, '2022-06-05 02:31:10', '2022-06-14 23:44:17'),
(38, 1, 0, 'Free', 0, 7, 5, 5, 'Free', NULL, NULL, NULL, 0, '2022-06-05 03:37:51', '2022-06-14 23:44:17'),
(39, 1, 0, 'Free', 0, 7, 5, 5, 'Free', NULL, NULL, NULL, 0, '2022-06-05 03:37:51', '2022-06-15 02:27:43'),
(42, 1, 2, 'Basic', 20, 30, 300, 3000, 'Paypal', '59B642012M8498744', NULL, NULL, 0, '2022-06-15 02:27:43', '2022-06-15 05:25:22'),
(43, 1, 2, 'Basic', 20, 30, 300, 3000, 'Wallet', NULL, NULL, NULL, 0, '2022-05-11 23:42:35', '2022-06-27 04:04:37'),
(44, 1, 2, 'Basic', 20, 30, 300, 3000, 'Wallet', NULL, NULL, NULL, 0, '2022-05-11 23:42:35', '2022-06-27 04:09:30'),
(45, 1, 2, 'Basic', 20, 30, 300, 3000, 'Stripe', 'txn_3LFEsnJlIV5dN9n70fFP3rW2', 'ch_3LFEsnJlIV5dN9n70G9H8PQz', NULL, 0, '2022-06-27 04:09:30', '2022-06-29 05:18:05'),
(46, 1, 2, 'Basic', 20, 30, 300, 3000, 'Paypal', '1V669658Y4138214D', NULL, NULL, 0, '2022-06-29 05:18:05', '2022-08-29 12:47:27'),
(47, 1, 2, 'Basic', 20, 30, 300, 3000, 'Stripe', 'txn_3Lc0okJlIV5dN9n71X4IFCH3', 'ch_3Lc0okJlIV5dN9n71GwMklCa', NULL, 0, '2022-08-29 12:47:27', '2022-10-18 03:04:06'),
(48, 1, 2, 'Basic', 20, 30, 300, 3000, 'Paypal', '6Y654024GS830562U', NULL, NULL, 0, '2022-10-18 03:04:07', '2022-10-18 03:07:04'),
(49, 1, 2, 'Basic', 20, 30, 300, 3000, 'Paypal', '6Y654024GS830562U', NULL, NULL, 0, '2022-10-18 03:07:04', '2022-11-17 04:38:50'),
(50, 23, 0, 'Free', 50, 7, 7, 5, 'Free', NULL, NULL, NULL, 1, '2022-10-31 23:46:42', '2022-10-31 23:46:42'),
(51, 24, 0, 'Free', 50, 7, 7, 5, 'Free', NULL, NULL, NULL, 1, '2022-10-31 23:56:49', '2022-10-31 23:56:49'),
(52, 25, 0, 'Free', 50, 7, 7, 5, 'Free', NULL, NULL, NULL, 1, '2022-11-01 00:26:51', '2022-11-01 00:26:51'),
(53, 26, 0, 'Free', 50, 7, 7, 5, 'Free', NULL, NULL, NULL, 1, '2022-11-01 00:32:27', '2022-11-01 00:32:27'),
(54, 27, 0, 'Free', 50, 7, 7, 5, 'Free', NULL, NULL, NULL, 1, '2022-11-01 00:38:02', '2022-11-01 00:38:02'),
(55, 28, 0, 'Free', 50, 7, 7, 5, 'Free', NULL, NULL, NULL, 1, '2022-11-01 00:42:37', '2022-11-01 00:42:37'),
(56, 29, 0, 'Free', 50, 7, 7, 5, 'Free', NULL, NULL, NULL, 1, '2022-11-01 00:44:18', '2022-11-01 00:44:18'),
(57, 1, 2, 'Basic', 20, 30, 300, 3000, 'Stripe', 'txn_3M55UbJlIV5dN9n71iUVWwKE', 'ch_3M55UbJlIV5dN9n71G80rDMT', NULL, 1, '2022-11-17 04:38:50', '2022-11-17 04:38:50');

-- --------------------------------------------------------

--
-- Table structure for table `withdraws`
--

CREATE TABLE `withdraws` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `method` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `acc_email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `iban` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `acc_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `adress` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `swift` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `reference` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `amount` double(8,2) DEFAULT NULL,
  `fee` double(8,2) NOT NULL DEFAULT 0.00,
  `status` enum('pending','completed','rejected') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `withdraws`
--

INSERT INTO `withdraws` (`id`, `user_id`, `method`, `acc_email`, `iban`, `country`, `acc_name`, `adress`, `swift`, `reference`, `amount`, `fee`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 'Skrill', 'pronobsarker16@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, 49.40, 0.60, 'completed', '2022-06-19 22:04:21', '2022-06-27 00:18:03'),
(2, 1, 'Paypal', 'pronobsarker16@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, 19.76, 0.24, 'completed', '2022-06-27 00:28:38', '2022-06-27 00:32:36'),
(3, 1, 'Paypal', 'pronobsarker16@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, 19.76, 0.24, 'completed', '2022-06-29 05:10:57', '2022-06-29 05:11:42');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `adminpanel_languages`
--
ALTER TABLE `adminpanel_languages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `admin_user_conversations`
--
ALTER TABLE `admin_user_conversations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `admin_user_messages`
--
ALTER TABLE `admin_user_messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `advertisements`
--
ALTER TABLE `advertisements`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `blogs`
--
ALTER TABLE `blogs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `blog__categories`
--
ALTER TABLE `blog__categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `countries`
--
ALTER TABLE `countries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `currencies`
--
ALTER TABLE `currencies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `deposits`
--
ALTER TABLE `deposits`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `domains`
--
ALTER TABLE `domains`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `email_templates`
--
ALTER TABLE `email_templates`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `fonts`
--
ALTER TABLE `fonts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `f_a_q_s`
--
ALTER TABLE `f_a_q_s`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `generalsettings`
--
ALTER TABLE `generalsettings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `languages`
--
ALTER TABLE `languages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `links`
--
ALTER TABLE `links`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `overlays`
--
ALTER TABLE `overlays`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pages`
--
ALTER TABLE `pages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pagesettings`
--
ALTER TABLE `pagesettings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pament_gateways`
--
ALTER TABLE `pament_gateways`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `payment_gateways`
--
ALTER TABLE `payment_gateways`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `pixels`
--
ALTER TABLE `pixels`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `poll_answers`
--
ALTER TABLE `poll_answers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `qr_codes`
--
ALTER TABLE `qr_codes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `seotools`
--
ALTER TABLE `seotools`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `socialsettings`
--
ALTER TABLE `socialsettings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `social_providers`
--
ALTER TABLE `social_providers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `splashes`
--
ALTER TABLE `splashes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subscribers`
--
ALTER TABLE `subscribers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subscriptions`
--
ALTER TABLE `subscriptions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD UNIQUE KEY `users_username_unique` (`username`);

--
-- Indexes for table `user_subscriptions`
--
ALTER TABLE `user_subscriptions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `withdraws`
--
ALTER TABLE `withdraws`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `adminpanel_languages`
--
ALTER TABLE `adminpanel_languages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `admin_user_conversations`
--
ALTER TABLE `admin_user_conversations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `admin_user_messages`
--
ALTER TABLE `admin_user_messages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `advertisements`
--
ALTER TABLE `advertisements`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `blogs`
--
ALTER TABLE `blogs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `blog__categories`
--
ALTER TABLE `blog__categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `countries`
--
ALTER TABLE `countries`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=253;

--
-- AUTO_INCREMENT for table `currencies`
--
ALTER TABLE `currencies`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `deposits`
--
ALTER TABLE `deposits`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `domains`
--
ALTER TABLE `domains`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `email_templates`
--
ALTER TABLE `email_templates`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `fonts`
--
ALTER TABLE `fonts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `f_a_q_s`
--
ALTER TABLE `f_a_q_s`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `generalsettings`
--
ALTER TABLE `generalsettings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `languages`
--
ALTER TABLE `languages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `links`
--
ALTER TABLE `links`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `overlays`
--
ALTER TABLE `overlays`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `pages`
--
ALTER TABLE `pages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `pagesettings`
--
ALTER TABLE `pagesettings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `pament_gateways`
--
ALTER TABLE `pament_gateways`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `payment_gateways`
--
ALTER TABLE `payment_gateways`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pixels`
--
ALTER TABLE `pixels`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `poll_answers`
--
ALTER TABLE `poll_answers`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `qr_codes`
--
ALTER TABLE `qr_codes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `seotools`
--
ALTER TABLE `seotools`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `socialsettings`
--
ALTER TABLE `socialsettings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `social_providers`
--
ALTER TABLE `social_providers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `splashes`
--
ALTER TABLE `splashes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `subscribers`
--
ALTER TABLE `subscribers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `subscriptions`
--
ALTER TABLE `subscriptions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `user_subscriptions`
--
ALTER TABLE `user_subscriptions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT for table `withdraws`
--
ALTER TABLE `withdraws`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
