-- phpMyAdmin SQL Dump
-- version 5.2.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 15, 2026 at 10:17 PM
-- Server version: 10.6.27-MariaDB
-- PHP Version: 8.2.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `thebeng_club`
--

-- --------------------------------------------------------

--
-- Table structure for table `about_us`
--

CREATE TABLE `about_us` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `content` text DEFAULT NULL,
  `image_path` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `about_us`
--

INSERT INTO `about_us` (`id`, `title`, `content`, `image_path`, `created_at`, `updated_at`) VALUES
(1, 'A Premier Social & Business Club', 'The Bengal Club is a premium, membership-based social and business club established with the objective of creating an exclusive, refined, and secure environment for distinguished professionals, entrepreneurs, corporate leaders, and culturally engaged individuals.\r\n\r\nLocated in Dhaka, Bangladesh, the Club aims to foster meaningful connections, professional growth, and social excellence. We provide an unparalleled platform where prestige meets purpose, and where every member is part of an elite community.', 'about-us/G9mOSFKcoMo7IjVrr4nXvm6e63V42f61ROTy6pYM.jpg', '2026-02-05 05:27:26', '2026-03-22 10:26:08');

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `name`, `email`, `password`, `phone`, `status`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin User', 'super@admin.com', '$2y$12$HtkS5m6uJlNmYvNvVFZ86eOXLGmNsX5cqJDKwBa/S8aOB0UQyWO4O', '1234567890', 1, 'SLxBLGE1CGxrXLpfSaVOQYtvQc9mSvXJYhVY40AGSZ6J9WO9AJWubGeoJVSu', '2026-02-05 04:50:46', '2026-02-05 04:50:46');

-- --------------------------------------------------------

--
-- Table structure for table `announcements`
--

CREATE TABLE `announcements` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `message` text DEFAULT NULL,
  `image_path` varchar(255) DEFAULT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `announcements`
--

INSERT INTO `announcements` (`id`, `title`, `message`, `image_path`, `start_date`, `end_date`, `is_active`, `created_at`, `updated_at`) VALUES
(3, 'শুভ নববর্ষ ১৪৩৩', NULL, 'announcements/yyUIDZYks4Cpfi4bYtpK1Mh50eOBYDxdBEuS3JE6.png', '2026-04-13', '2026-04-15', 1, '2026-04-14 02:41:51', '2026-04-14 10:03:42'),
(4, 'President speech', NULL, 'announcements/9YylDEpFtARQH1YH0RmvnuRBFso3L0CdMwaXSgRv.jpg', '2026-04-23', '2026-12-31', 0, '2026-04-23 17:00:11', '2026-06-06 19:29:10'),
(5, 'Eid Get-Together & Discussion Meeting', 'SEL Chayaneer Condominium\r\n(Community Hall-first floor) \r\nKa/115/6/1, Dakkhin Para, Mohakhali, Dhaka-1212. \r\nক/১১৫/৬/১,দক্ষিণ পাড়া,\r\nমহাখালী,ঢাকা -১২১২।', 'announcements/uneSIUpGPELvEF83m4R4u3zAfWtPYGnUCkuaHi2l.png', '2026-06-06', '2026-07-10', 1, '2026-06-06 19:27:08', '2026-06-06 19:27:08');

-- --------------------------------------------------------

--
-- Table structure for table `archives`
--

CREATE TABLE `archives` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `image_path` varchar(255) NOT NULL,
  `order` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `archives`
--

INSERT INTO `archives` (`id`, `title`, `image_path`, `order`, `created_at`, `updated_at`) VALUES
(1, 'Our Award Ceremony', 'archives/FF0neA6FnUYCCwRrntaoTUKZYfFyCviDxUHajQQ5.jpg', 0, '2026-03-17 09:17:14', '2026-03-17 09:17:14');

-- --------------------------------------------------------

--
-- Table structure for table `board_directors`
--

CREATE TABLE `board_directors` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `designation` varchar(255) DEFAULT NULL,
  `social_links` text DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `photo_path` varchar(255) DEFAULT NULL,
  `order` int(11) NOT NULL DEFAULT 0,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `board_directors`
--

INSERT INTO `board_directors` (`id`, `name`, `designation`, `social_links`, `phone`, `email`, `photo_path`, `order`, `status`, `created_at`, `updated_at`) VALUES
(1, 'SHAHRIER SHEHAB', 'President', NULL, NULL, NULL, 'directors/pvqxQzh13cWtaeBN7jXya5fwRwj7tDgzZcWV08Fi.jpg', 1, 1, '2026-02-06 01:14:10', '2026-02-06 01:17:39'),
(2, 'SHAH MD. SIKANDER', 'Vice-President', NULL, '01672314778', 'shahsikanderkajal@gmail.com', 'directors/eLQtrL337vsk4i4uJEmQOhpaBvg4FcUIZv8exC1K.jpg', 2, 1, '2026-02-06 01:16:04', '2026-04-09 14:06:25'),
(3, 'MD. AL-AMIN', 'General Secretary', NULL, NULL, NULL, 'directors/u1o0yEtJNg3DdsXmka5lb7X3KhtWq8z9os7hSVrd.jpg', 3, 1, '2026-02-06 01:18:18', '2026-02-06 01:18:18'),
(4, 'ABDULLAH AL MASUD', 'Joint Secretary', NULL, NULL, NULL, 'directors/6GoqevWLSwEUVzG6syK34itl3pKJ4XC7l3YKyRT3.jpg', 4, 1, '2026-02-06 01:18:53', '2026-04-22 10:48:37'),
(5, 'ARAFAT HABIB', 'Treasurer', NULL, NULL, NULL, 'directors/eQEBG0YSMwKYipXWpZF2HhQauY9iRwDlAaeOnI3h.jpg', 5, 1, '2026-02-06 01:19:27', '2026-02-06 01:19:27'),
(6, 'MOHAMMAD MOSHEUR ALAM', 'Finance Director', NULL, NULL, NULL, 'directors/ckcx303PShLME5LjWpGAhBYQmylLMRp0vLZDUgZ6.jpg', 6, 1, '2026-02-06 01:20:02', '2026-02-06 01:20:02'),
(7, 'MD. MAHMUDUL HASSAN', 'Organizing Secretary', NULL, NULL, NULL, 'directors/5Pfw769sDfvETnSYT2V83tMOHk7Qcmtkl2XojqVm.jpg', 7, 1, '2026-02-06 01:20:37', '2026-02-06 01:20:37');

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `donations`
--

CREATE TABLE `donations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `donation_category_id` bigint(20) UNSIGNED DEFAULT NULL,
  `full_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `payment_method_id` bigint(20) UNSIGNED DEFAULT NULL,
  `transaction_id` varchar(255) DEFAULT NULL,
  `payment_proof_path` varchar(255) DEFAULT NULL,
  `status` enum('pending','verified','canceled') NOT NULL DEFAULT 'pending',
  `note` text DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `donations`
--

INSERT INTO `donations` (`id`, `donation_category_id`, `full_name`, `email`, `amount`, `payment_method_id`, `transaction_id`, `payment_proof_path`, `status`, `note`, `ip_address`, `created_at`, `updated_at`) VALUES
(1, 2, 'Cameran Shaw', 'mdeasinislam6@gmail.com', 1000.00, 1, '34424', 'donation-proofs/JTZGUuZRiO4nvJ0spmltLqLoHCAcn7Cv5KIAkwk5.jpg', 'verified', NULL, '103.187.94.230', '2026-03-25 03:12:42', '2026-03-25 03:13:09'),
(2, 1, 'asd', 'super@admin.com', 10000.00, 1, 'asda', 'donation-proofs/CJxPbONa7yla7frZvoSKrW8jFnlTt4R6hekAjkNz.png', 'verified', NULL, '103.187.94.230', '2026-03-25 03:14:27', '2026-03-25 03:14:37');

-- --------------------------------------------------------

--
-- Table structure for table `donation_categories`
--

CREATE TABLE `donation_categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `image_path` varchar(255) DEFAULT NULL,
  `status` enum('active','disabled') NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `donation_categories`
--

INSERT INTO `donation_categories` (`id`, `name`, `description`, `image_path`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Zakat', 'asdasd', 'donation-categories/Nzf20fBiX2EYFmicEw3cDX2RGZtLGNZ5NyG4UaK0.jpg', 'active', '2026-03-25 03:10:07', '2026-03-25 03:10:07'),
(2, 'বন্যার্থদের জন্য সাহায্য', 'asdasd', 'donation-categories/oOUku8LI0Xlbad4WFQm8iuAmnfPu1KcXTETbrDb4.jpg', 'active', '2026-03-25 03:10:27', '2026-03-25 03:10:27');

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `venue` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `thumbnail_path` varchar(255) NOT NULL,
  `gallery_images` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`gallery_images`)),
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `is_free` tinyint(1) NOT NULL DEFAULT 1,
  `fee` decimal(10,2) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`id`, `title`, `date`, `venue`, `description`, `thumbnail_path`, `gallery_images`, `status`, `is_free`, `fee`, `created_at`, `updated_at`) VALUES
(1, 'Founder Meeting', '2026-02-25', 'Uttara', '<p><font color=\"#efefef\"><span style=\"font-weight: bolder; margin: 0px; padding: 0px; font-family: &quot;Open Sans&quot;, Arial, sans-serif; font-size: 14px; text-align: justify;\">Lorem Ipsum</span><span style=\"font-family: &quot;Open Sans&quot;, Arial, sans-serif; font-size: 14px; text-align: justify;\">&nbsp;is simply dummy text of the printing and typesetting industry.</span></font></p><p><span style=\"font-family: &quot;Open Sans&quot;, Arial, sans-serif; font-size: 14px; text-align: justify;\"><font color=\"#efefef\">Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s,</font></span></p><p><span style=\"font-family: &quot;Open Sans&quot;, Arial, sans-serif; font-size: 14px; text-align: justify;\"><font color=\"#efefef\">when an unknown printer took a galley of type and scrambled it to make a type specimen book.</font></span></p><p><span style=\"font-family: &quot;Open Sans&quot;, Arial, sans-serif; font-size: 14px; text-align: justify;\"><font color=\"#efefef\">It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.</font></span></p><p><span style=\"font-family: &quot;Open Sans&quot;, Arial, sans-serif; font-size: 14px; text-align: justify;\"><font color=\"#efefef\">It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</font></span></p>', 'events/thumbnails/NWbOVQAvKEZtxvxGBk5KU45Ok03jSS7dXPEVNHBF.jpg', '[\"events\\/gallery\\/HCuWFWTvgTdaYeBASBE7Geqjc6in5QAd7MD7UyLE.png\",\"events\\/gallery\\/qaMRjWglytst0343cPtMYoz6pXqYNcAsjaN2zOw5.jpg\",\"events\\/gallery\\/a3yXfa0c8yBC9zHET2mELzU6rRUxhCYFA6av7jhm.png\"]', 1, 1, NULL, '2026-02-14 01:54:01', '2026-02-14 02:21:32'),
(2, 'Eid Get-Together & Discussion Meeting', '2026-07-10', 'SEL Chayaneer Condominium (Community Hall-first floor)  Ka/115/6/1, Dakkhin Para, Mohakhali, Dhaka-1212.  ক/১১৫/৬/১,দক্ষিণ পাড়া, মহাখালী,ঢাকা -১২১২।', '<p><b style=\"font-size: 1rem;\">Eid Mubarak! Kindly register your participation for the Eid Get-Together &amp; Discussion Meeting.</b></p><p><b><br></b><b style=\"color: rgb(31, 31, 31); font-family: docs-Roboto; font-size: 14.6667px; white-space-collapse: preserve;\">Dress code : Formal Dress. </b></p><p><b style=\"color: rgb(31, 31, 31); font-family: docs-Roboto; font-size: 14.6667px; white-space-collapse: preserve;\">Time : 7pm-10pm</b></p><p>Google Map :</p><p><a href=\"https://maps.app.goo.gl/bCTwcq3Xaiq62jtW8?g_st=iw\" target=\"_blank\">https://maps.app.goo.gl/bCTwcq3Xaiq62jtW8?g_st=iw</a></p><p>Registration link :</p><p>&nbsp;https://forms.gle/Vric<span style=\"font-size: 1rem;\">bU9hioDHzGqeA</span></p><p><span style=\"font-size: 1rem;\"><br></span></p><p><span style=\"font-size: 1rem;\"><br></span></p>', 'events/thumbnails/9FRKxt31kvmhQ1SLPoVOTGZM7o4ekhuCZNJJNwNY.png', '[\"events\\/gallery\\/3bmtdcqe8CsqJfWW2jYqStuiwpjLBKtKS0P3cXvw.jpg\"]', 1, 0, 500.00, '2026-06-08 00:39:43', '2026-06-08 01:26:54');

-- --------------------------------------------------------

--
-- Table structure for table `event_registrations`
--

CREATE TABLE `event_registrations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `event_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `is_member` tinyint(1) NOT NULL DEFAULT 0,
  `full_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `payment_method_id` bigint(20) UNSIGNED DEFAULT NULL,
  `transaction_id` varchar(255) DEFAULT NULL,
  `payment_proof_path` varchar(255) DEFAULT NULL,
  `status` enum('pending','approved','cancelled') NOT NULL DEFAULT 'pending',
  `note` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `expenses`
--

CREATE TABLE `expenses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `donation_category_id` bigint(20) UNSIGNED DEFAULT NULL,
  `description` varchar(255) NOT NULL,
  `amount` decimal(12,2) NOT NULL,
  `attachment_path` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `expenses`
--

INSERT INTO `expenses` (`id`, `donation_category_id`, `description`, `amount`, `attachment_path`, `created_at`, `updated_at`) VALUES
(1, 1, '৫ হাজার টাকা দান করা হইছে', 5000.00, NULL, '2026-03-25 03:15:28', '2026-03-25 03:15:28');

-- --------------------------------------------------------

--
-- Table structure for table `facilities`
--

CREATE TABLE `facilities` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `tag_line` varchar(255) DEFAULT NULL,
  `short_bio` text DEFAULT NULL,
  `image_path` varchar(255) DEFAULT NULL,
  `features` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`features`)),
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `facilities`
--

INSERT INTO `facilities` (`id`, `name`, `tag_line`, `short_bio`, `image_path`, `features`, `created_at`, `updated_at`) VALUES
(1, 'Fine Dining Restaurant', 'Members Only', 'Savor gourmet cuisine prepared by award-winning chefs in an elegant atmosphere. Our restaurant offers diverse international and local delicacies.', 'facilities/LdNY62RgmgScxrTCzhOhfSwcbPFn417WokvRYTbK.jpg', '[\"Michelin-star chef cuisine\",\"Private dining rooms\",\"Wine cellar & sommelier\"]', '2026-02-08 04:29:34', '2026-02-08 04:29:34');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `honorary_members`
--

CREATE TABLE `honorary_members` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `designation` text DEFAULT NULL,
  `bio` text DEFAULT NULL,
  `photo_path` varchar(255) DEFAULT NULL,
  `order` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `honorary_members`
--

INSERT INTO `honorary_members` (`id`, `name`, `designation`, `bio`, `photo_path`, `order`, `is_active`, `created_at`, `updated_at`) VALUES
(2, 'Tafsir Ahamed Khan', '[\"Advocate\",\"Bangladesh Supreme Court\"]', NULL, 'honorary-members/YtEbWAQDcuZSxatM0L2LCCc9koG1pmaAuqtMGCcf.jpg', 0, 1, '2026-04-09 00:15:50', '2026-04-09 00:25:21'),
(3, 'MD. NURUL ALAM (MILON)', '[\"Proprietor\",\"SAHEL ENTERPRISE\"]', NULL, 'honorary-members/TI1pC4PoWqukPq1pIDHoBc3hAqGLBPtn2hOakPO7.jpg', 0, 1, '2026-04-11 19:13:45', '2026-04-11 19:13:45'),
(4, 'MOHAMMED HOMAYAN KABIR', '[\"OWNER\",\"PELICAN TRADE INTERNATIONAL\"]', NULL, 'honorary-members/SHMbCpUwiLkvmSzGzcOJmlqO4Opwq74FmGLFFfuD.png', 2, 1, '2026-05-26 04:35:20', '2026-05-26 04:42:34');

-- --------------------------------------------------------

--
-- Table structure for table `inquiries`
--

CREATE TABLE `inquiries` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `subject` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `is_viewed` tinyint(1) NOT NULL DEFAULT 0,
  `ip_address` varchar(45) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `inquiries`
--

INSERT INTO `inquiries` (`id`, `name`, `email`, `phone`, `subject`, `message`, `is_viewed`, `ip_address`, `created_at`, `updated_at`) VALUES
(1, 'asdasd', 'super@admin.com', '01533860142', 'Membership Inquiry', 'asd', 1, '127.0.0.1', '2026-02-14 03:17:19', '2026-02-14 03:17:33');

-- --------------------------------------------------------

--
-- Table structure for table `invitations`
--

CREATE TABLE `invitations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `invite_id` varchar(6) NOT NULL,
  `email` varchar(255) NOT NULL,
  `membership_category_id` bigint(20) UNSIGNED NOT NULL,
  `application_fee` decimal(10,2) NOT NULL,
  `is_used` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `jobs`
--

INSERT INTO `jobs` (`id`, `queue`, `payload`, `attempts`, `reserved_at`, `available_at`, `created_at`) VALUES
(1, 'default', '{\"uuid\":\"1c13932c-f211-457f-b708-71431410933d\",\"displayName\":\"App\\\\Mail\\\\ApplicationReceived\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Mail\\\\SendQueuedMailable\",\"command\":\"O:34:\\\"Illuminate\\\\Mail\\\\SendQueuedMailable\\\":17:{s:8:\\\"mailable\\\";O:28:\\\"App\\\\Mail\\\\ApplicationReceived\\\":5:{s:11:\\\"application\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:32:\\\"App\\\\Models\\\\MembershipApplication\\\";s:2:\\\"id\\\";i:3;s:9:\\\"relations\\\";a:1:{i:0;s:18:\\\"membershipCategory\\\";}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:8:\\\"settings\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:22:\\\"App\\\\Models\\\\SiteSetting\\\";s:2:\\\"id\\\";i:1;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:6:\\\"pdfUrl\\\";s:50:\\\"http:\\/\\/127.0.0.1:8000\\/membership\\/application\\/3\\/pdf\\\";s:2:\\\"to\\\";a:1:{i:0;a:2:{s:4:\\\"name\\\";N;s:7:\\\"address\\\";s:23:\\\"mdeasinislam6@gmail.com\\\";}}s:6:\\\"mailer\\\";s:4:\\\"smtp\\\";}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:13:\\\"maxExceptions\\\";N;s:17:\\\"shouldBeEncrypted\\\";b:0;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:12:\\\"messageGroup\\\";N;s:12:\\\"deduplicator\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;s:3:\\\"job\\\";N;}\"},\"createdAt\":1771317083,\"delay\":null}', 0, NULL, 1771317083, 1771317083),
(2, 'default', '{\"uuid\":\"db4d5f82-f3f2-4fbd-8287-d05166c41558\",\"displayName\":\"App\\\\Mail\\\\ApplicationReceived\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Mail\\\\SendQueuedMailable\",\"command\":\"O:34:\\\"Illuminate\\\\Mail\\\\SendQueuedMailable\\\":17:{s:8:\\\"mailable\\\";O:28:\\\"App\\\\Mail\\\\ApplicationReceived\\\":5:{s:11:\\\"application\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:32:\\\"App\\\\Models\\\\MembershipApplication\\\";s:2:\\\"id\\\";i:4;s:9:\\\"relations\\\";a:1:{i:0;s:18:\\\"membershipCategory\\\";}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:8:\\\"settings\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:22:\\\"App\\\\Models\\\\SiteSetting\\\";s:2:\\\"id\\\";i:1;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:6:\\\"pdfUrl\\\";s:50:\\\"http:\\/\\/127.0.0.1:8000\\/membership\\/application\\/4\\/pdf\\\";s:2:\\\"to\\\";a:1:{i:0;a:2:{s:4:\\\"name\\\";N;s:7:\\\"address\\\";s:23:\\\"mdeasinislam6@gmail.com\\\";}}s:6:\\\"mailer\\\";s:4:\\\"smtp\\\";}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:13:\\\"maxExceptions\\\";N;s:17:\\\"shouldBeEncrypted\\\";b:0;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:12:\\\"messageGroup\\\";N;s:12:\\\"deduplicator\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;s:3:\\\"job\\\";N;}\"},\"createdAt\":1771339190,\"delay\":null}', 0, NULL, 1771339190, 1771339190),
(3, 'default', '{\"uuid\":\"1a3d3a13-76aa-42dc-b3ad-37a754f4b480\",\"displayName\":\"App\\\\Jobs\\\\SendEventNotificationEmail\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"App\\\\Jobs\\\\SendEventNotificationEmail\",\"command\":\"O:35:\\\"App\\\\Jobs\\\\SendEventNotificationEmail\\\":1:{s:5:\\\"event\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:16:\\\"App\\\\Models\\\\Event\\\";s:2:\\\"id\\\";i:2;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}}\"},\"createdAt\":1780853983,\"delay\":null}', 0, NULL, 1780853983, 1780853983),
(4, 'default', '{\"uuid\":\"541e1be2-1372-49b1-a855-5fa1a7636e82\",\"displayName\":\"App\\\\Jobs\\\\SendEventNotificationEmail\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"App\\\\Jobs\\\\SendEventNotificationEmail\",\"command\":\"O:35:\\\"App\\\\Jobs\\\\SendEventNotificationEmail\\\":1:{s:5:\\\"event\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:16:\\\"App\\\\Models\\\\Event\\\";s:2:\\\"id\\\";i:2;s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}}\"},\"createdAt\":1780854880,\"delay\":null}', 0, NULL, 1780854880, 1780854880);

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `membership_applications`
--

CREATE TABLE `membership_applications` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `nid_photo` varchar(255) DEFAULT NULL,
  `date_of_birth` date NOT NULL,
  `nid_passport` varchar(255) NOT NULL,
  `profession_organization` varchar(255) NOT NULL,
  `mobile` varchar(20) NOT NULL,
  `email` varchar(255) NOT NULL,
  `address` text NOT NULL,
  `reference` varchar(500) DEFAULT NULL,
  `membership_category_id` bigint(20) UNSIGNED NOT NULL,
  `payment_method_id` bigint(20) UNSIGNED DEFAULT NULL,
  `transaction_id` varchar(255) DEFAULT NULL,
  `payment_proof_path` varchar(255) DEFAULT NULL,
  `payment_verified_at` timestamp NULL DEFAULT NULL,
  `payment_verified_by_admin_id` bigint(20) UNSIGNED DEFAULT NULL,
  `is_tos_accepted` tinyint(1) NOT NULL DEFAULT 0,
  `status` enum('pending','accepted','rejected') NOT NULL DEFAULT 'pending',
  `ip_address` varchar(45) DEFAULT NULL,
  `invite_id` varchar(6) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `membership_applications`
--

INSERT INTO `membership_applications` (`id`, `name`, `photo`, `nid_photo`, `date_of_birth`, `nid_passport`, `profession_organization`, `mobile`, `email`, `address`, `reference`, `membership_category_id`, `payment_method_id`, `transaction_id`, `payment_proof_path`, `payment_verified_at`, `payment_verified_by_admin_id`, `is_tos_accepted`, `status`, `ip_address`, `invite_id`, `created_at`, `updated_at`) VALUES
(8, 'Allegra Booker', 'application-photos/JTe52O9RMP18KWHQbAdrvdw3kYssLv09fsKBwchN.jpg', 'nid-photos/QiqJERxNeQ671AJldMW4IPspi6ib9FaQbV54xqs0.jpg', '2026-03-04', '228454545', 'Ayers Stout Associates', '+1 (501) 113-2227', 'nezylu@mailinator.com', 'Dolores illum iste', 'Laborum Esse minim', 5, 1, 'ABVCA122', 'payment-proofs/sDO5D1qXyj5YtU01tbOr5kQxQ4SLxBnrNHi4g1a3.png', NULL, NULL, 1, 'accepted', '127.0.0.1', NULL, '2026-03-19 08:13:36', '2026-03-19 08:24:01'),
(9, 'Kirby Durham', NULL, 'nid-photos/gT3jS4fhZy3SJzqwB4nW0GgpuvJRbxZOqjDcyUec.jpg', '2026-03-18', '650', 'Small Holloway Traders', '+1 (421) 669-5535', 'rude@mailinator.com', 'Quas at sit asperior', 'In qui ex magna dolo', 9, 1, 'ABVCA122', 'payment-proofs/M4xppolgPx2ahTQ3fQcQTCdR3n1hc8fxufKhjte6.jpg', '2026-03-25 02:49:42', 1, 1, 'accepted', '103.187.94.230', NULL, '2026-03-25 02:48:24', '2026-03-25 02:51:14');

-- --------------------------------------------------------

--
-- Table structure for table `membership_categories`
--

CREATE TABLE `membership_categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `installment_price` decimal(10,2) NOT NULL DEFAULT 0.00,
  `bio` text DEFAULT NULL,
  `badge_text` varchar(255) DEFAULT NULL,
  `duration` enum('Monthly','Yearly','Lifetime') NOT NULL,
  `is_invite_only` tinyint(1) NOT NULL DEFAULT 0,
  `optional_installment` tinyint(1) NOT NULL DEFAULT 0,
  `features` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`features`)),
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `membership_categories`
--

INSERT INTO `membership_categories` (`id`, `title`, `price`, `installment_price`, `bio`, `badge_text`, `duration`, `is_invite_only`, `optional_installment`, `features`, `created_at`, `updated_at`) VALUES
(4, 'Lifetime  Member', 200000.00, 0.00, NULL, 'Lifetime', 'Lifetime', 0, 0, '[\"Limited and exclusive membership category\",\"Lifetime recognition and priority privileges\",\"Special voting rights and acknowledgements\"]', '2026-02-17 09:52:36', '2026-03-26 23:44:30'),
(5, 'General Member', 10000.00, 0.00, NULL, 'Annual Renew', 'Monthly', 0, 0, '[\"Full access to standard club facilities and events\",\"Participation in networking and social programs\"]', '2026-02-17 09:53:43', '2026-03-22 10:53:03'),
(6, 'Corporate Member', 20000.00, 0.00, NULL, 'Annual Renew', 'Monthly', 0, 0, '[\"Designed for corporate entities\",\"Option to nominate multiple representatives\",\"Corporate branding and networking opportunities\"]', '2026-02-17 09:54:51', '2026-03-22 10:52:56'),
(7, 'Honorary Member', 0.00, 0.00, 'Conferred upon individuals of notable contribution or distinction', 'Invite Only', 'Lifetime', 1, 0, '[\"Nominated by the Executive Committee\"]', '2026-02-17 09:56:09', '2026-03-22 10:52:11'),
(8, 'Friends and Family  Member', 1000.00, 0.00, NULL, NULL, 'Yearly', 1, 1, '[\"Networking events\",\"Business seminar\",\"Selected club events\"]', '2026-03-22 10:42:01', '2026-04-15 19:47:52'),
(9, 'Student / Young Member', 500.00, 500.00, 'Admission Fee: 1000 BDT', NULL, 'Yearly', 0, 1, '[\"Networking events\",\"Business seminar\",\"Selected club events\"]', '2026-03-23 03:46:45', '2026-04-15 19:59:45');

-- --------------------------------------------------------

--
-- Table structure for table `membership_installments`
--

CREATE TABLE `membership_installments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `user_profile_id` bigint(20) UNSIGNED NOT NULL,
  `installment_number` int(10) UNSIGNED NOT NULL,
  `due_date` date NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `status` enum('pending','completed') NOT NULL DEFAULT 'pending',
  `payment_method` varchar(255) DEFAULT NULL,
  `note` text DEFAULT NULL,
  `paid_at` timestamp NULL DEFAULT NULL,
  `completed_by_admin_id` bigint(20) UNSIGNED DEFAULT NULL,
  `member_payment_method_id` bigint(20) UNSIGNED DEFAULT NULL,
  `member_txn_id` varchar(255) DEFAULT NULL,
  `member_proof_path` varchar(255) DEFAULT NULL,
  `member_submitted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `membership_installments`
--

INSERT INTO `membership_installments` (`id`, `user_id`, `user_profile_id`, `installment_number`, `due_date`, `amount`, `status`, `payment_method`, `note`, `paid_at`, `completed_by_admin_id`, `member_payment_method_id`, `member_txn_id`, `member_proof_path`, `member_submitted_at`, `created_at`, `updated_at`) VALUES
(25, 11, 9, 1, '2026-04-01', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-01 19:02:21', '2026-04-01 19:02:21'),
(26, 11, 9, 2, '2026-05-01', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-01 19:02:21', '2026-04-01 19:02:21'),
(27, 11, 9, 3, '2026-06-01', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-01 19:02:21', '2026-04-01 19:02:21'),
(28, 11, 9, 4, '2026-07-01', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-01 19:02:21', '2026-04-01 19:02:21'),
(29, 11, 9, 5, '2026-08-01', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-01 19:02:21', '2026-04-01 19:02:21'),
(30, 11, 9, 6, '2026-09-01', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-01 19:02:21', '2026-04-01 19:02:21'),
(31, 11, 9, 7, '2026-10-01', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-01 19:02:21', '2026-04-01 19:02:21'),
(32, 11, 9, 8, '2026-11-01', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-01 19:02:21', '2026-04-01 19:02:21'),
(33, 11, 9, 9, '2026-12-01', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-01 19:02:21', '2026-04-01 19:02:21'),
(34, 11, 9, 10, '2027-01-01', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-01 19:02:21', '2026-04-01 19:02:21'),
(35, 11, 9, 11, '2027-02-01', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-01 19:02:21', '2026-04-01 19:02:21'),
(36, 11, 9, 12, '2027-03-01', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-01 19:02:21', '2026-04-01 19:02:21'),
(37, 12, 10, 1, '2026-04-01', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-02 01:33:31', '2026-04-02 01:33:31'),
(38, 12, 10, 2, '2026-05-01', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-02 01:33:31', '2026-04-02 01:33:31'),
(39, 12, 10, 3, '2026-06-01', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-02 01:33:31', '2026-04-02 01:33:31'),
(40, 12, 10, 4, '2026-07-01', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-02 01:33:31', '2026-04-02 01:33:31'),
(41, 12, 10, 5, '2026-08-01', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-02 01:33:31', '2026-04-02 01:33:31'),
(42, 12, 10, 6, '2026-09-01', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-02 01:33:31', '2026-04-02 01:33:31'),
(43, 12, 10, 7, '2026-10-01', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-02 01:33:31', '2026-04-02 01:33:31'),
(44, 12, 10, 8, '2026-11-01', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-02 01:33:31', '2026-04-02 01:33:31'),
(45, 12, 10, 9, '2026-12-01', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-02 01:33:31', '2026-04-02 01:33:31'),
(46, 12, 10, 10, '2027-01-01', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-02 01:33:31', '2026-04-02 01:33:31'),
(47, 12, 10, 11, '2027-02-01', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-02 01:33:31', '2026-04-02 01:33:31'),
(48, 12, 10, 12, '2027-03-01', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-02 01:33:31', '2026-04-02 01:33:31'),
(49, 13, 11, 1, '2026-04-01', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-02 01:39:25', '2026-04-02 01:39:25'),
(50, 13, 11, 2, '2026-05-01', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-02 01:39:25', '2026-04-02 01:39:25'),
(51, 13, 11, 3, '2026-06-01', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-02 01:39:25', '2026-04-02 01:39:25'),
(52, 13, 11, 4, '2026-07-01', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-02 01:39:25', '2026-04-02 01:39:25'),
(53, 13, 11, 5, '2026-08-01', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-02 01:39:25', '2026-04-02 01:39:25'),
(54, 13, 11, 6, '2026-09-01', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-02 01:39:25', '2026-04-02 01:39:25'),
(55, 13, 11, 7, '2026-10-01', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-02 01:39:25', '2026-04-02 01:39:25'),
(56, 13, 11, 8, '2026-11-01', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-02 01:39:25', '2026-04-02 01:39:25'),
(57, 13, 11, 9, '2026-12-01', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-02 01:39:25', '2026-04-02 01:39:25'),
(58, 13, 11, 10, '2027-01-01', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-02 01:39:25', '2026-04-02 01:39:25'),
(59, 13, 11, 11, '2027-02-01', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-02 01:39:25', '2026-04-02 01:39:25'),
(60, 13, 11, 12, '2027-03-01', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-02 01:39:25', '2026-04-02 01:39:25'),
(61, 14, 12, 1, '2026-04-01', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-02 01:45:42', '2026-04-02 01:45:42'),
(62, 14, 12, 2, '2026-05-01', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-02 01:45:42', '2026-04-02 01:45:42'),
(63, 14, 12, 3, '2026-06-01', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-02 01:45:42', '2026-04-02 01:45:42'),
(64, 14, 12, 4, '2026-07-01', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-02 01:45:42', '2026-04-02 01:45:42'),
(65, 14, 12, 5, '2026-08-01', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-02 01:45:42', '2026-04-02 01:45:42'),
(66, 14, 12, 6, '2026-09-01', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-02 01:45:42', '2026-04-02 01:45:42'),
(67, 14, 12, 7, '2026-10-01', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-02 01:45:42', '2026-04-02 01:45:42'),
(68, 14, 12, 8, '2026-11-01', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-02 01:45:42', '2026-04-02 01:45:42'),
(69, 14, 12, 9, '2026-12-01', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-02 01:45:42', '2026-04-02 01:45:42'),
(70, 14, 12, 10, '2027-01-01', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-02 01:45:42', '2026-04-02 01:45:42'),
(71, 14, 12, 11, '2027-02-01', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-02 01:45:42', '2026-04-02 01:45:42'),
(72, 14, 12, 12, '2027-03-01', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-02 01:45:42', '2026-04-02 01:45:42'),
(85, 16, 14, 1, '2026-04-02', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-02 09:36:43', '2026-04-02 09:36:43'),
(86, 16, 14, 2, '2026-05-02', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-02 09:36:43', '2026-04-02 09:36:43'),
(87, 16, 14, 3, '2026-06-02', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-02 09:36:43', '2026-04-02 09:36:43'),
(88, 16, 14, 4, '2026-07-02', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-02 09:36:43', '2026-04-02 09:36:43'),
(89, 16, 14, 5, '2026-08-02', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-02 09:36:43', '2026-04-02 09:36:43'),
(90, 16, 14, 6, '2026-09-02', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-02 09:36:43', '2026-04-02 09:36:43'),
(91, 16, 14, 7, '2026-10-02', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-02 09:36:43', '2026-04-02 09:36:43'),
(92, 16, 14, 8, '2026-11-02', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-02 09:36:43', '2026-04-02 09:36:43'),
(93, 16, 14, 9, '2026-12-02', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-02 09:36:43', '2026-04-02 09:36:43'),
(94, 16, 14, 10, '2027-01-02', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-02 09:36:43', '2026-04-02 09:36:43'),
(95, 16, 14, 11, '2027-02-02', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-02 09:36:43', '2026-04-02 09:36:43'),
(96, 16, 14, 12, '2027-03-02', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-02 09:36:43', '2026-04-02 09:36:43'),
(97, 17, 15, 1, '2026-04-02', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-02 12:44:33', '2026-04-02 12:44:33'),
(98, 17, 15, 2, '2026-05-02', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-02 12:44:33', '2026-04-02 12:44:33'),
(99, 17, 15, 3, '2026-06-02', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-02 12:44:33', '2026-04-02 12:44:33'),
(100, 17, 15, 4, '2026-07-02', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-02 12:44:33', '2026-04-02 12:44:33'),
(101, 17, 15, 5, '2026-08-02', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-02 12:44:33', '2026-04-02 12:44:33'),
(102, 17, 15, 6, '2026-09-02', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-02 12:44:33', '2026-04-02 12:44:33'),
(103, 17, 15, 7, '2026-10-02', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-02 12:44:33', '2026-04-02 12:44:33'),
(104, 17, 15, 8, '2026-11-02', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-02 12:44:33', '2026-04-02 12:44:33'),
(105, 17, 15, 9, '2026-12-02', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-02 12:44:33', '2026-04-02 12:44:33'),
(106, 17, 15, 10, '2027-01-02', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-02 12:44:33', '2026-04-02 12:44:33'),
(107, 17, 15, 11, '2027-02-02', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-02 12:44:33', '2026-04-02 12:44:33'),
(108, 17, 15, 12, '2027-03-02', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-02 12:44:33', '2026-04-02 12:44:33'),
(121, 19, 17, 1, '2026-04-02', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-02 13:21:23', '2026-04-02 13:21:23'),
(122, 19, 17, 2, '2026-05-02', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-02 13:21:23', '2026-04-02 13:21:23'),
(123, 19, 17, 3, '2026-06-02', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-02 13:21:23', '2026-04-02 13:21:23'),
(124, 19, 17, 4, '2026-07-02', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-02 13:21:23', '2026-04-02 13:21:23'),
(125, 19, 17, 5, '2026-08-02', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-02 13:21:23', '2026-04-02 13:21:23'),
(126, 19, 17, 6, '2026-09-02', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-02 13:21:23', '2026-04-02 13:21:23'),
(127, 19, 17, 7, '2026-10-02', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-02 13:21:23', '2026-04-02 13:21:23'),
(128, 19, 17, 8, '2026-11-02', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-02 13:21:23', '2026-04-02 13:21:23'),
(129, 19, 17, 9, '2026-12-02', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-02 13:21:23', '2026-04-02 13:21:23'),
(130, 19, 17, 10, '2027-01-02', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-02 13:21:23', '2026-04-02 13:21:23'),
(131, 19, 17, 11, '2027-02-02', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-02 13:21:23', '2026-04-02 13:21:23'),
(132, 19, 17, 12, '2027-03-02', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-02 13:21:23', '2026-04-02 13:21:23'),
(133, 20, 18, 1, '2026-04-02', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-02 14:37:54', '2026-04-02 14:37:54'),
(134, 20, 18, 2, '2026-05-02', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-02 14:37:54', '2026-04-02 14:37:54'),
(135, 20, 18, 3, '2026-06-02', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-02 14:37:54', '2026-04-02 14:37:54'),
(136, 20, 18, 4, '2026-07-02', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-02 14:37:54', '2026-04-02 14:37:54'),
(137, 20, 18, 5, '2026-08-02', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-02 14:37:54', '2026-04-02 14:37:54'),
(138, 20, 18, 6, '2026-09-02', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-02 14:37:54', '2026-04-02 14:37:54'),
(139, 20, 18, 7, '2026-10-02', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-02 14:37:54', '2026-04-02 14:37:54'),
(140, 20, 18, 8, '2026-11-02', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-02 14:37:54', '2026-04-02 14:37:54'),
(141, 20, 18, 9, '2026-12-02', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-02 14:37:54', '2026-04-02 14:37:54'),
(142, 20, 18, 10, '2027-01-02', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-02 14:37:54', '2026-04-02 14:37:54'),
(143, 20, 18, 11, '2027-02-02', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-02 14:37:54', '2026-04-02 14:37:54'),
(144, 20, 18, 12, '2027-03-02', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-02 14:37:54', '2026-04-02 14:37:54'),
(145, 21, 19, 1, '2026-04-02', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-02 15:39:09', '2026-04-02 15:39:09'),
(146, 21, 19, 2, '2026-05-02', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-02 15:39:09', '2026-04-02 15:39:09'),
(147, 21, 19, 3, '2026-06-02', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-02 15:39:09', '2026-04-02 15:39:09'),
(148, 21, 19, 4, '2026-07-02', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-02 15:39:09', '2026-04-02 15:39:09'),
(149, 21, 19, 5, '2026-08-02', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-02 15:39:09', '2026-04-02 15:39:09'),
(150, 21, 19, 6, '2026-09-02', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-02 15:39:09', '2026-04-02 15:39:09'),
(151, 21, 19, 7, '2026-10-02', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-02 15:39:09', '2026-04-02 15:39:09'),
(152, 21, 19, 8, '2026-11-02', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-02 15:39:09', '2026-04-02 15:39:09'),
(153, 21, 19, 9, '2026-12-02', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-02 15:39:09', '2026-04-02 15:39:09'),
(154, 21, 19, 10, '2027-01-02', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-02 15:39:09', '2026-04-02 15:39:09'),
(155, 21, 19, 11, '2027-02-02', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-02 15:39:09', '2026-04-02 15:39:09'),
(156, 21, 19, 12, '2027-03-02', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-02 15:39:09', '2026-04-02 15:39:09'),
(157, 22, 20, 1, '2026-04-02', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-02 19:59:40', '2026-04-02 19:59:40'),
(158, 22, 20, 2, '2026-05-02', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-02 19:59:40', '2026-04-02 19:59:40'),
(159, 22, 20, 3, '2026-06-02', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-02 19:59:40', '2026-04-02 19:59:40'),
(160, 22, 20, 4, '2026-07-02', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-02 19:59:40', '2026-04-02 19:59:40'),
(161, 22, 20, 5, '2026-08-02', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-02 19:59:40', '2026-04-02 19:59:40'),
(162, 22, 20, 6, '2026-09-02', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-02 19:59:40', '2026-04-02 19:59:40'),
(163, 22, 20, 7, '2026-10-02', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-02 19:59:40', '2026-04-02 19:59:40'),
(164, 22, 20, 8, '2026-11-02', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-02 19:59:40', '2026-04-02 19:59:40'),
(165, 22, 20, 9, '2026-12-02', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-02 19:59:40', '2026-04-02 19:59:40'),
(166, 22, 20, 10, '2027-01-02', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-02 19:59:40', '2026-04-02 19:59:40'),
(167, 22, 20, 11, '2027-02-02', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-02 19:59:40', '2026-04-02 19:59:40'),
(168, 22, 20, 12, '2027-03-02', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-02 19:59:40', '2026-04-02 19:59:40'),
(169, 23, 21, 1, '2026-04-02', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-02 21:02:04', '2026-04-02 21:02:04'),
(170, 23, 21, 2, '2026-05-02', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-02 21:02:04', '2026-04-02 21:02:04'),
(171, 23, 21, 3, '2026-06-02', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-02 21:02:04', '2026-04-02 21:02:04'),
(172, 23, 21, 4, '2026-07-02', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-02 21:02:04', '2026-04-02 21:02:04'),
(173, 23, 21, 5, '2026-08-02', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-02 21:02:04', '2026-04-02 21:02:04'),
(174, 23, 21, 6, '2026-09-02', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-02 21:02:04', '2026-04-02 21:02:04'),
(175, 23, 21, 7, '2026-10-02', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-02 21:02:04', '2026-04-02 21:02:04'),
(176, 23, 21, 8, '2026-11-02', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-02 21:02:04', '2026-04-02 21:02:04'),
(177, 23, 21, 9, '2026-12-02', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-02 21:02:04', '2026-04-02 21:02:04'),
(178, 23, 21, 10, '2027-01-02', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-02 21:02:04', '2026-04-02 21:02:04'),
(179, 23, 21, 11, '2027-02-02', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-02 21:02:04', '2026-04-02 21:02:04'),
(180, 23, 21, 12, '2027-03-02', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-02 21:02:04', '2026-04-02 21:02:04'),
(181, 24, 22, 1, '2026-04-02', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-02 21:18:42', '2026-04-02 21:18:42'),
(182, 24, 22, 2, '2026-05-02', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-02 21:18:42', '2026-04-02 21:18:42'),
(183, 24, 22, 3, '2026-06-02', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-02 21:18:42', '2026-04-02 21:18:42'),
(184, 24, 22, 4, '2026-07-02', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-02 21:18:42', '2026-04-02 21:18:42'),
(185, 24, 22, 5, '2026-08-02', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-02 21:18:42', '2026-04-02 21:18:42'),
(186, 24, 22, 6, '2026-09-02', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-02 21:18:42', '2026-04-02 21:18:42'),
(187, 24, 22, 7, '2026-10-02', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-02 21:18:42', '2026-04-02 21:18:42'),
(188, 24, 22, 8, '2026-11-02', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-02 21:18:42', '2026-04-02 21:18:42'),
(189, 24, 22, 9, '2026-12-02', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-02 21:18:42', '2026-04-02 21:18:42'),
(190, 24, 22, 10, '2027-01-02', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-02 21:18:42', '2026-04-02 21:18:42'),
(191, 24, 22, 11, '2027-02-02', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-02 21:18:42', '2026-04-02 21:18:42'),
(192, 24, 22, 12, '2027-03-02', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-02 21:18:42', '2026-04-02 21:18:42'),
(194, 25, 23, 2, '2026-05-02', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-02 21:29:57', '2026-04-02 21:29:57'),
(195, 25, 23, 3, '2026-06-02', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-02 21:29:57', '2026-04-02 21:29:57'),
(196, 25, 23, 4, '2026-07-02', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-02 21:29:57', '2026-04-02 21:29:57'),
(197, 25, 23, 5, '2026-08-02', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-02 21:29:57', '2026-04-02 21:29:57'),
(198, 25, 23, 6, '2026-09-02', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-02 21:29:57', '2026-04-02 21:29:57'),
(199, 25, 23, 7, '2026-10-02', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-02 21:29:57', '2026-04-02 21:29:57'),
(200, 25, 23, 8, '2026-11-02', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-02 21:29:57', '2026-04-02 21:29:57'),
(201, 25, 23, 9, '2026-12-02', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-02 21:29:57', '2026-04-02 21:29:57'),
(202, 25, 23, 10, '2027-01-02', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-02 21:29:57', '2026-04-02 21:29:57'),
(203, 25, 23, 11, '2027-02-02', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-02 21:29:57', '2026-04-02 21:29:57'),
(204, 25, 23, 12, '2027-03-02', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-02 21:29:57', '2026-04-02 21:29:57'),
(205, 26, 24, 1, '2026-04-02', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-03 02:13:06', '2026-04-03 02:13:06'),
(206, 26, 24, 2, '2026-05-02', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-03 02:13:06', '2026-04-03 02:13:06'),
(207, 26, 24, 3, '2026-06-02', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-03 02:13:06', '2026-04-03 02:13:06'),
(208, 26, 24, 4, '2026-07-02', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-03 02:13:06', '2026-04-03 02:13:06'),
(209, 26, 24, 5, '2026-08-02', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-03 02:13:06', '2026-04-03 02:13:06'),
(210, 26, 24, 6, '2026-09-02', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-03 02:13:06', '2026-04-03 02:13:06'),
(211, 26, 24, 7, '2026-10-02', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-03 02:13:06', '2026-04-03 02:13:06'),
(212, 26, 24, 8, '2026-11-02', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-03 02:13:06', '2026-04-03 02:13:06'),
(213, 26, 24, 9, '2026-12-02', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-03 02:13:06', '2026-04-03 02:13:06'),
(214, 26, 24, 10, '2027-01-02', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-03 02:13:06', '2026-04-03 02:13:06'),
(215, 26, 24, 11, '2027-02-02', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-03 02:13:06', '2026-04-03 02:13:06'),
(216, 26, 24, 12, '2027-03-02', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-03 02:13:06', '2026-04-03 02:13:06'),
(217, 27, 25, 1, '2026-04-02', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-03 02:30:07', '2026-04-03 02:30:07'),
(218, 27, 25, 2, '2026-05-02', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-03 02:30:07', '2026-04-03 02:30:07'),
(219, 27, 25, 3, '2026-06-02', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-03 02:30:07', '2026-04-03 02:30:07'),
(220, 27, 25, 4, '2026-07-02', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-03 02:30:07', '2026-04-03 02:30:07'),
(221, 27, 25, 5, '2026-08-02', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-03 02:30:07', '2026-04-03 02:30:07'),
(222, 27, 25, 6, '2026-09-02', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-03 02:30:07', '2026-04-03 02:30:07'),
(223, 27, 25, 7, '2026-10-02', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-03 02:30:07', '2026-04-03 02:30:07'),
(224, 27, 25, 8, '2026-11-02', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-03 02:30:07', '2026-04-03 02:30:07'),
(225, 27, 25, 9, '2026-12-02', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-03 02:30:07', '2026-04-03 02:30:07'),
(226, 27, 25, 10, '2027-01-02', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-03 02:30:07', '2026-04-03 02:30:07'),
(227, 27, 25, 11, '2027-02-02', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-03 02:30:07', '2026-04-03 02:30:07'),
(228, 27, 25, 12, '2027-03-02', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-03 02:30:07', '2026-04-03 02:30:07'),
(229, 28, 26, 1, '2026-04-03', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-03 11:40:40', '2026-04-03 11:40:40'),
(230, 28, 26, 2, '2026-05-03', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-03 11:40:40', '2026-04-03 11:40:40'),
(231, 28, 26, 3, '2026-06-03', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-03 11:40:40', '2026-04-03 11:40:40'),
(232, 28, 26, 4, '2026-07-03', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-03 11:40:40', '2026-04-03 11:40:40'),
(233, 28, 26, 5, '2026-08-03', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-03 11:40:40', '2026-04-03 11:40:40'),
(234, 28, 26, 6, '2026-09-03', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-03 11:40:40', '2026-04-03 11:40:40'),
(235, 28, 26, 7, '2026-10-03', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-03 11:40:40', '2026-04-03 11:40:40'),
(236, 28, 26, 8, '2026-11-03', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-03 11:40:40', '2026-04-03 11:40:40'),
(237, 28, 26, 9, '2026-12-03', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-03 11:40:40', '2026-04-03 11:40:40'),
(238, 28, 26, 10, '2027-01-03', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-03 11:40:40', '2026-04-03 11:40:40'),
(239, 28, 26, 11, '2027-02-03', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-03 11:40:40', '2026-04-03 11:40:40'),
(240, 28, 26, 12, '2027-03-03', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-03 11:40:40', '2026-04-03 11:40:40'),
(241, 29, 27, 1, '2026-04-03', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-03 14:09:20', '2026-04-03 14:09:20'),
(242, 29, 27, 2, '2026-05-03', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-03 14:09:20', '2026-04-03 14:09:20'),
(243, 29, 27, 3, '2026-06-03', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-03 14:09:20', '2026-04-03 14:09:20'),
(244, 29, 27, 4, '2026-07-03', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-03 14:09:20', '2026-04-03 14:09:20'),
(245, 29, 27, 5, '2026-08-03', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-03 14:09:20', '2026-04-03 14:09:20'),
(246, 29, 27, 6, '2026-09-03', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-03 14:09:20', '2026-04-03 14:09:20'),
(247, 29, 27, 7, '2026-10-03', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-03 14:09:20', '2026-04-03 14:09:20'),
(248, 29, 27, 8, '2026-11-03', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-03 14:09:20', '2026-04-03 14:09:20'),
(249, 29, 27, 9, '2026-12-03', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-03 14:09:20', '2026-04-03 14:09:20'),
(250, 29, 27, 10, '2027-01-03', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-03 14:09:20', '2026-04-03 14:09:20'),
(251, 29, 27, 11, '2027-02-03', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-03 14:09:20', '2026-04-03 14:09:20'),
(252, 29, 27, 12, '2027-03-03', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-03 14:09:20', '2026-04-03 14:09:20'),
(253, 31, 28, 1, '2026-04-03', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-03 16:31:46', '2026-04-03 16:31:46'),
(254, 31, 28, 2, '2026-05-03', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-03 16:31:46', '2026-04-03 16:31:46'),
(255, 31, 28, 3, '2026-06-03', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-03 16:31:46', '2026-04-03 16:31:46'),
(256, 31, 28, 4, '2026-07-03', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-03 16:31:46', '2026-04-03 16:31:46'),
(257, 31, 28, 5, '2026-08-03', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-03 16:31:46', '2026-04-03 16:31:46'),
(258, 31, 28, 6, '2026-09-03', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-03 16:31:46', '2026-04-03 16:31:46'),
(259, 31, 28, 7, '2026-10-03', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-03 16:31:46', '2026-04-03 16:31:46'),
(260, 31, 28, 8, '2026-11-03', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-03 16:31:46', '2026-04-03 16:31:46'),
(261, 31, 28, 9, '2026-12-03', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-03 16:31:46', '2026-04-03 16:31:46'),
(262, 31, 28, 10, '2027-01-03', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-03 16:31:46', '2026-04-03 16:31:46'),
(263, 31, 28, 11, '2027-02-03', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-03 16:31:46', '2026-04-03 16:31:46'),
(264, 31, 28, 12, '2027-03-03', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-03 16:31:46', '2026-04-03 16:31:46'),
(266, 32, 29, 2, '2026-05-03', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-04 00:17:25', '2026-04-04 00:17:25'),
(267, 32, 29, 3, '2026-06-03', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-04 00:17:25', '2026-04-04 00:17:25'),
(268, 32, 29, 4, '2026-07-03', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-04 00:17:25', '2026-04-04 00:17:25'),
(269, 32, 29, 5, '2026-08-03', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-04 00:17:25', '2026-04-04 00:17:25'),
(270, 32, 29, 6, '2026-09-03', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-04 00:17:25', '2026-04-04 00:17:25'),
(271, 32, 29, 7, '2026-10-03', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-04 00:17:25', '2026-04-04 00:17:25'),
(272, 32, 29, 8, '2026-11-03', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-04 00:17:25', '2026-04-04 00:17:25'),
(273, 32, 29, 9, '2026-12-03', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-04 00:17:25', '2026-04-04 00:17:25'),
(274, 32, 29, 10, '2027-01-03', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-04 00:17:25', '2026-04-04 00:17:25'),
(275, 32, 29, 11, '2027-02-03', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-04 00:17:25', '2026-04-04 00:17:25'),
(276, 32, 29, 12, '2027-03-03', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-04 00:17:25', '2026-04-04 00:17:25'),
(277, 33, 30, 1, '2026-04-04', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-04 07:48:10', '2026-04-04 07:48:10'),
(278, 33, 30, 2, '2026-05-04', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-04 07:48:10', '2026-04-04 07:48:10'),
(279, 33, 30, 3, '2026-06-04', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-04 07:48:10', '2026-04-04 07:48:10'),
(280, 33, 30, 4, '2026-07-04', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-04 07:48:10', '2026-04-04 07:48:10'),
(281, 33, 30, 5, '2026-08-04', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-04 07:48:10', '2026-04-04 07:48:10'),
(282, 33, 30, 6, '2026-09-04', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-04 07:48:10', '2026-04-04 07:48:10'),
(283, 33, 30, 7, '2026-10-04', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-04 07:48:10', '2026-04-04 07:48:10'),
(284, 33, 30, 8, '2026-11-04', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-04 07:48:10', '2026-04-04 07:48:10'),
(285, 33, 30, 9, '2026-12-04', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-04 07:48:10', '2026-04-04 07:48:10'),
(286, 33, 30, 10, '2027-01-04', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-04 07:48:10', '2026-04-04 07:48:10'),
(287, 33, 30, 11, '2027-02-04', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-04 07:48:10', '2026-04-04 07:48:10'),
(288, 33, 30, 12, '2027-03-04', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-04 07:48:10', '2026-04-04 07:48:10'),
(289, 34, 31, 1, '2026-04-04', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-04 07:53:13', '2026-04-04 07:53:13'),
(290, 34, 31, 2, '2026-05-04', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-04 07:53:13', '2026-04-04 07:53:13'),
(291, 34, 31, 3, '2026-06-04', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-04 07:53:13', '2026-04-04 07:53:13'),
(292, 34, 31, 4, '2026-07-04', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-04 07:53:13', '2026-04-04 07:53:13'),
(293, 34, 31, 5, '2026-08-04', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-04 07:53:13', '2026-04-04 07:53:13'),
(294, 34, 31, 6, '2026-09-04', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-04 07:53:13', '2026-04-04 07:53:13'),
(295, 34, 31, 7, '2026-10-04', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-04 07:53:13', '2026-04-04 07:53:13'),
(296, 34, 31, 8, '2026-11-04', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-04 07:53:13', '2026-04-04 07:53:13'),
(297, 34, 31, 9, '2026-12-04', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-04 07:53:13', '2026-04-04 07:53:13'),
(298, 34, 31, 10, '2027-01-04', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-04 07:53:13', '2026-04-04 07:53:13'),
(299, 34, 31, 11, '2027-02-04', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-04 07:53:13', '2026-04-04 07:53:13'),
(300, 34, 31, 12, '2027-03-04', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-04 07:53:13', '2026-04-04 07:53:13'),
(303, 35, 32, 3, '2026-06-04', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-04 11:17:36', '2026-04-04 11:17:36'),
(304, 35, 32, 4, '2026-07-04', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-04 11:17:36', '2026-04-04 11:17:36'),
(305, 35, 32, 5, '2026-08-04', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-04 11:17:36', '2026-04-04 11:17:36'),
(306, 35, 32, 6, '2026-09-04', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-04 11:17:36', '2026-04-04 11:17:36'),
(307, 35, 32, 7, '2026-10-04', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-04 11:17:36', '2026-04-04 11:17:36'),
(308, 35, 32, 8, '2026-11-04', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-04 11:17:36', '2026-04-04 11:17:36'),
(309, 35, 32, 9, '2026-12-04', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-04 11:17:36', '2026-04-04 11:17:36'),
(310, 35, 32, 10, '2027-01-04', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-04 11:17:36', '2026-04-04 11:17:36'),
(311, 35, 32, 11, '2027-02-04', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-04 11:17:36', '2026-04-04 11:17:36'),
(312, 35, 32, 12, '2027-03-04', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-04 11:17:36', '2026-04-04 11:17:36'),
(313, 36, 33, 1, '2026-04-04', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-04 13:51:21', '2026-04-04 13:51:21'),
(314, 36, 33, 2, '2026-05-04', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-04 13:51:21', '2026-04-04 13:51:21'),
(315, 36, 33, 3, '2026-06-04', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-04 13:51:21', '2026-04-04 13:51:21'),
(316, 36, 33, 4, '2026-07-04', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-04 13:51:21', '2026-04-04 13:51:21'),
(317, 36, 33, 5, '2026-08-04', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-04 13:51:21', '2026-04-04 13:51:21'),
(318, 36, 33, 6, '2026-09-04', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-04 13:51:21', '2026-04-04 13:51:21'),
(319, 36, 33, 7, '2026-10-04', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-04 13:51:21', '2026-04-04 13:51:21'),
(320, 36, 33, 8, '2026-11-04', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-04 13:51:21', '2026-04-04 13:51:21'),
(321, 36, 33, 9, '2026-12-04', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-04 13:51:21', '2026-04-04 13:51:21'),
(322, 36, 33, 10, '2027-01-04', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-04 13:51:21', '2026-04-04 13:51:21'),
(323, 36, 33, 11, '2027-02-04', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-04 13:51:21', '2026-04-04 13:51:21'),
(324, 36, 33, 12, '2027-03-04', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-04 13:51:21', '2026-04-04 13:51:21'),
(325, 37, 34, 1, '2026-04-04', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-04 14:51:40', '2026-04-04 14:51:40'),
(326, 37, 34, 2, '2026-05-04', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-04 14:51:40', '2026-04-04 14:51:40'),
(327, 37, 34, 3, '2026-06-04', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-04 14:51:40', '2026-04-04 14:51:40'),
(328, 37, 34, 4, '2026-07-04', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-04 14:51:40', '2026-04-04 14:51:40'),
(329, 37, 34, 5, '2026-08-04', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-04 14:51:40', '2026-04-04 14:51:40'),
(330, 37, 34, 6, '2026-09-04', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-04 14:51:40', '2026-04-04 14:51:40'),
(331, 37, 34, 7, '2026-10-04', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-04 14:51:40', '2026-04-04 14:51:40'),
(332, 37, 34, 8, '2026-11-04', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-04 14:51:40', '2026-04-04 14:51:40'),
(333, 37, 34, 9, '2026-12-04', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-04 14:51:40', '2026-04-04 14:51:40'),
(334, 37, 34, 10, '2027-01-04', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-04 14:51:40', '2026-04-04 14:51:40'),
(335, 37, 34, 11, '2027-02-04', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-04 14:51:40', '2026-04-04 14:51:40'),
(336, 37, 34, 12, '2027-03-04', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-04 14:51:40', '2026-04-04 14:51:40'),
(337, 39, 35, 1, '2026-04-04', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-04 15:38:54', '2026-04-04 15:38:54'),
(338, 39, 35, 2, '2026-05-04', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-04 15:38:54', '2026-04-04 15:38:54'),
(339, 39, 35, 3, '2026-06-04', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-04 15:38:54', '2026-04-04 15:38:54'),
(340, 39, 35, 4, '2026-07-04', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-04 15:38:54', '2026-04-04 15:38:54'),
(341, 39, 35, 5, '2026-08-04', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-04 15:38:54', '2026-04-04 15:38:54'),
(342, 39, 35, 6, '2026-09-04', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-04 15:38:54', '2026-04-04 15:38:54'),
(343, 39, 35, 7, '2026-10-04', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-04 15:38:54', '2026-04-04 15:38:54'),
(344, 39, 35, 8, '2026-11-04', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-04 15:38:54', '2026-04-04 15:38:54'),
(345, 39, 35, 9, '2026-12-04', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-04 15:38:54', '2026-04-04 15:38:54'),
(346, 39, 35, 10, '2027-01-04', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-04 15:38:54', '2026-04-04 15:38:54'),
(347, 39, 35, 11, '2027-02-04', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-04 15:38:54', '2026-04-04 15:38:54'),
(348, 39, 35, 12, '2027-03-04', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-04 15:38:54', '2026-04-04 15:38:54'),
(361, 41, 37, 1, '2026-04-04', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-04 15:47:07', '2026-04-04 15:47:07'),
(362, 41, 37, 2, '2026-05-04', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-04 15:47:07', '2026-04-04 15:47:07'),
(363, 41, 37, 3, '2026-06-04', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-04 15:47:07', '2026-04-04 15:47:07'),
(364, 41, 37, 4, '2026-07-04', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-04 15:47:07', '2026-04-04 15:47:07'),
(365, 41, 37, 5, '2026-08-04', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-04 15:47:07', '2026-04-04 15:47:07'),
(366, 41, 37, 6, '2026-09-04', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-04 15:47:07', '2026-04-04 15:47:07'),
(367, 41, 37, 7, '2026-10-04', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-04 15:47:07', '2026-04-04 15:47:07'),
(368, 41, 37, 8, '2026-11-04', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-04 15:47:07', '2026-04-04 15:47:07'),
(369, 41, 37, 9, '2026-12-04', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-04 15:47:07', '2026-04-04 15:47:07'),
(370, 41, 37, 10, '2027-01-04', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-04 15:47:07', '2026-04-04 15:47:07'),
(371, 41, 37, 11, '2027-02-04', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-04 15:47:07', '2026-04-04 15:47:07'),
(372, 41, 37, 12, '2027-03-04', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-04 15:47:07', '2026-04-04 15:47:07'),
(373, 42, 38, 1, '2026-04-04', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-04 17:20:59', '2026-04-04 17:20:59'),
(374, 42, 38, 2, '2026-05-04', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-04 17:20:59', '2026-04-04 17:20:59'),
(375, 42, 38, 3, '2026-06-04', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-04 17:20:59', '2026-04-04 17:20:59'),
(376, 42, 38, 4, '2026-07-04', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-04 17:20:59', '2026-04-04 17:20:59'),
(377, 42, 38, 5, '2026-08-04', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-04 17:20:59', '2026-04-04 17:20:59'),
(378, 42, 38, 6, '2026-09-04', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-04 17:20:59', '2026-04-04 17:20:59'),
(379, 42, 38, 7, '2026-10-04', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-04 17:20:59', '2026-04-04 17:20:59'),
(380, 42, 38, 8, '2026-11-04', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-04 17:20:59', '2026-04-04 17:20:59'),
(381, 42, 38, 9, '2026-12-04', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-04 17:20:59', '2026-04-04 17:20:59'),
(382, 42, 38, 10, '2027-01-04', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-04 17:20:59', '2026-04-04 17:20:59'),
(383, 42, 38, 11, '2027-02-04', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-04 17:20:59', '2026-04-04 17:20:59'),
(384, 42, 38, 12, '2027-03-04', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-04 17:20:59', '2026-04-04 17:20:59'),
(385, 43, 39, 1, '2026-04-04', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-04 21:17:37', '2026-04-04 21:17:37'),
(386, 43, 39, 2, '2026-05-04', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-04 21:17:37', '2026-04-04 21:17:37'),
(387, 43, 39, 3, '2026-06-04', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-04 21:17:37', '2026-04-04 21:17:37'),
(388, 43, 39, 4, '2026-07-04', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-04 21:17:37', '2026-04-04 21:17:37'),
(389, 43, 39, 5, '2026-08-04', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-04 21:17:37', '2026-04-04 21:17:37'),
(390, 43, 39, 6, '2026-09-04', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-04 21:17:37', '2026-04-04 21:17:37'),
(391, 43, 39, 7, '2026-10-04', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-04 21:17:37', '2026-04-04 21:17:37'),
(392, 43, 39, 8, '2026-11-04', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-04 21:17:37', '2026-04-04 21:17:37'),
(393, 43, 39, 9, '2026-12-04', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-04 21:17:37', '2026-04-04 21:17:37'),
(394, 43, 39, 10, '2027-01-04', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-04 21:17:37', '2026-04-04 21:17:37'),
(395, 43, 39, 11, '2027-02-04', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-04 21:17:37', '2026-04-04 21:17:37'),
(396, 43, 39, 12, '2027-03-04', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-04 21:17:37', '2026-04-04 21:17:37'),
(397, 44, 40, 1, '2026-04-04', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-04 22:10:43', '2026-04-04 22:10:43'),
(398, 44, 40, 2, '2026-05-04', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-04 22:10:43', '2026-04-04 22:10:43'),
(399, 44, 40, 3, '2026-06-04', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-04 22:10:43', '2026-04-04 22:10:43'),
(400, 44, 40, 4, '2026-07-04', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-04 22:10:43', '2026-04-04 22:10:43'),
(401, 44, 40, 5, '2026-08-04', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-04 22:10:43', '2026-04-04 22:10:43'),
(402, 44, 40, 6, '2026-09-04', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-04 22:10:43', '2026-04-04 22:10:43'),
(403, 44, 40, 7, '2026-10-04', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-04 22:10:43', '2026-04-04 22:10:43'),
(404, 44, 40, 8, '2026-11-04', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-04 22:10:43', '2026-04-04 22:10:43'),
(405, 44, 40, 9, '2026-12-04', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-04 22:10:43', '2026-04-04 22:10:43'),
(406, 44, 40, 10, '2027-01-04', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-04 22:10:43', '2026-04-04 22:10:43'),
(407, 44, 40, 11, '2027-02-04', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-04 22:10:43', '2026-04-04 22:10:43'),
(408, 44, 40, 12, '2027-03-04', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-04 22:10:43', '2026-04-04 22:10:43'),
(409, 45, 41, 1, '2026-04-05', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-05 15:17:41', '2026-04-05 15:17:41'),
(410, 45, 41, 2, '2026-05-05', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-05 15:17:41', '2026-04-05 15:17:41'),
(411, 45, 41, 3, '2026-06-05', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-05 15:17:41', '2026-04-05 15:17:41'),
(412, 45, 41, 4, '2026-07-05', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-05 15:17:41', '2026-04-05 15:17:41'),
(413, 45, 41, 5, '2026-08-05', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-05 15:17:41', '2026-04-05 15:17:41'),
(414, 45, 41, 6, '2026-09-05', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-05 15:17:41', '2026-04-05 15:17:41'),
(415, 45, 41, 7, '2026-10-05', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-05 15:17:41', '2026-04-05 15:17:41'),
(416, 45, 41, 8, '2026-11-05', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-05 15:17:41', '2026-04-05 15:17:41');
INSERT INTO `membership_installments` (`id`, `user_id`, `user_profile_id`, `installment_number`, `due_date`, `amount`, `status`, `payment_method`, `note`, `paid_at`, `completed_by_admin_id`, `member_payment_method_id`, `member_txn_id`, `member_proof_path`, `member_submitted_at`, `created_at`, `updated_at`) VALUES
(417, 45, 41, 9, '2026-12-05', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-05 15:17:41', '2026-04-05 15:17:41'),
(418, 45, 41, 10, '2027-01-05', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-05 15:17:41', '2026-04-05 15:17:41'),
(419, 45, 41, 11, '2027-02-05', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-05 15:17:41', '2026-04-05 15:17:41'),
(420, 45, 41, 12, '2027-03-05', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-05 15:17:41', '2026-04-05 15:17:41'),
(433, 47, 43, 1, '2026-04-06', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-06 17:00:23', '2026-04-06 17:00:23'),
(434, 47, 43, 2, '2026-05-06', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-06 17:00:23', '2026-04-06 17:00:23'),
(435, 47, 43, 3, '2026-06-06', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-06 17:00:23', '2026-04-06 17:00:23'),
(436, 47, 43, 4, '2026-07-06', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-06 17:00:23', '2026-04-06 17:00:23'),
(437, 47, 43, 5, '2026-08-06', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-06 17:00:23', '2026-04-06 17:00:23'),
(438, 47, 43, 6, '2026-09-06', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-06 17:00:23', '2026-04-06 17:00:23'),
(439, 47, 43, 7, '2026-10-06', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-06 17:00:23', '2026-04-06 17:00:23'),
(440, 47, 43, 8, '2026-11-06', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-06 17:00:23', '2026-04-06 17:00:23'),
(441, 47, 43, 9, '2026-12-06', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-06 17:00:23', '2026-04-06 17:00:23'),
(442, 47, 43, 10, '2027-01-06', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-06 17:00:23', '2026-04-06 17:00:23'),
(443, 47, 43, 11, '2027-02-06', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-06 17:00:23', '2026-04-06 17:00:23'),
(444, 47, 43, 12, '2027-03-06', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-06 17:00:23', '2026-04-06 17:00:23'),
(445, 48, 44, 1, '2026-04-06', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-06 17:30:55', '2026-04-06 17:30:55'),
(446, 48, 44, 2, '2026-05-06', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-06 17:30:55', '2026-04-06 17:30:55'),
(447, 48, 44, 3, '2026-06-06', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-06 17:30:55', '2026-04-06 17:30:55'),
(448, 48, 44, 4, '2026-07-06', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-06 17:30:55', '2026-04-06 17:30:55'),
(449, 48, 44, 5, '2026-08-06', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-06 17:30:55', '2026-04-06 17:30:55'),
(450, 48, 44, 6, '2026-09-06', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-06 17:30:55', '2026-04-06 17:30:55'),
(451, 48, 44, 7, '2026-10-06', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-06 17:30:55', '2026-04-06 17:30:55'),
(452, 48, 44, 8, '2026-11-06', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-06 17:30:55', '2026-04-06 17:30:55'),
(453, 48, 44, 9, '2026-12-06', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-06 17:30:55', '2026-04-06 17:30:55'),
(454, 48, 44, 10, '2027-01-06', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-06 17:30:55', '2026-04-06 17:30:55'),
(455, 48, 44, 11, '2027-02-06', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-06 17:30:55', '2026-04-06 17:30:55'),
(456, 48, 44, 12, '2027-03-06', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-06 17:30:55', '2026-04-06 17:30:55'),
(469, 50, 46, 1, '2026-04-06', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-06 20:00:27', '2026-04-06 20:00:27'),
(470, 50, 46, 2, '2026-05-06', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-06 20:00:27', '2026-04-06 20:00:27'),
(471, 50, 46, 3, '2026-06-06', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-06 20:00:27', '2026-04-06 20:00:27'),
(472, 50, 46, 4, '2026-07-06', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-06 20:00:27', '2026-04-06 20:00:27'),
(473, 50, 46, 5, '2026-08-06', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-06 20:00:27', '2026-04-06 20:00:27'),
(474, 50, 46, 6, '2026-09-06', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-06 20:00:27', '2026-04-06 20:00:27'),
(475, 50, 46, 7, '2026-10-06', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-06 20:00:27', '2026-04-06 20:00:27'),
(476, 50, 46, 8, '2026-11-06', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-06 20:00:27', '2026-04-06 20:00:27'),
(477, 50, 46, 9, '2026-12-06', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-06 20:00:27', '2026-04-06 20:00:27'),
(478, 50, 46, 10, '2027-01-06', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-06 20:00:27', '2026-04-06 20:00:27'),
(479, 50, 46, 11, '2027-02-06', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-06 20:00:27', '2026-04-06 20:00:27'),
(480, 50, 46, 12, '2027-03-06', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-06 20:00:27', '2026-04-06 20:00:27'),
(493, 52, 48, 1, '2026-04-07', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-07 23:35:21', '2026-04-07 23:35:21'),
(494, 52, 48, 2, '2026-05-07', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-07 23:35:21', '2026-04-07 23:35:21'),
(495, 52, 48, 3, '2026-06-07', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-07 23:35:21', '2026-04-07 23:35:21'),
(496, 52, 48, 4, '2026-07-07', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-07 23:35:21', '2026-04-07 23:35:21'),
(497, 52, 48, 5, '2026-08-07', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-07 23:35:21', '2026-04-07 23:35:21'),
(498, 52, 48, 6, '2026-09-07', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-07 23:35:21', '2026-04-07 23:35:21'),
(499, 52, 48, 7, '2026-10-07', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-07 23:35:21', '2026-04-07 23:35:21'),
(500, 52, 48, 8, '2026-11-07', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-07 23:35:21', '2026-04-07 23:35:21'),
(501, 52, 48, 9, '2026-12-07', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-07 23:35:21', '2026-04-07 23:35:21'),
(502, 52, 48, 10, '2027-01-07', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-07 23:35:21', '2026-04-07 23:35:21'),
(503, 52, 48, 11, '2027-02-07', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-07 23:35:21', '2026-04-07 23:35:21'),
(504, 52, 48, 12, '2027-03-07', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-07 23:35:21', '2026-04-07 23:35:21'),
(505, 53, 49, 1, '2026-04-08', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-08 11:23:37', '2026-04-08 11:23:37'),
(506, 53, 49, 2, '2026-05-08', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-08 11:23:37', '2026-04-08 11:23:37'),
(507, 53, 49, 3, '2026-06-08', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-08 11:23:37', '2026-04-08 11:23:37'),
(508, 53, 49, 4, '2026-07-08', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-08 11:23:37', '2026-04-08 11:23:37'),
(509, 53, 49, 5, '2026-08-08', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-08 11:23:37', '2026-04-08 11:23:37'),
(510, 53, 49, 6, '2026-09-08', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-08 11:23:37', '2026-04-08 11:23:37'),
(511, 53, 49, 7, '2026-10-08', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-08 11:23:37', '2026-04-08 11:23:37'),
(512, 53, 49, 8, '2026-11-08', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-08 11:23:37', '2026-04-08 11:23:37'),
(513, 53, 49, 9, '2026-12-08', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-08 11:23:37', '2026-04-08 11:23:37'),
(514, 53, 49, 10, '2027-01-08', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-08 11:23:37', '2026-04-08 11:23:37'),
(515, 53, 49, 11, '2027-02-08', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-08 11:23:37', '2026-04-08 11:23:37'),
(516, 53, 49, 12, '2027-03-08', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-08 11:23:37', '2026-04-08 11:23:37'),
(541, 60, 54, 1, '2026-04-08', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-08 16:45:38', '2026-04-08 16:45:38'),
(542, 60, 54, 2, '2026-05-08', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-08 16:45:38', '2026-04-08 16:45:38'),
(543, 60, 54, 3, '2026-06-08', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-08 16:45:38', '2026-04-08 16:45:38'),
(544, 60, 54, 4, '2026-07-08', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-08 16:45:38', '2026-04-08 16:45:38'),
(545, 60, 54, 5, '2026-08-08', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-08 16:45:38', '2026-04-08 16:45:38'),
(546, 60, 54, 6, '2026-09-08', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-08 16:45:38', '2026-04-08 16:45:38'),
(547, 60, 54, 7, '2026-10-08', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-08 16:45:38', '2026-04-08 16:45:38'),
(548, 60, 54, 8, '2026-11-08', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-08 16:45:38', '2026-04-08 16:45:38'),
(549, 60, 54, 9, '2026-12-08', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-08 16:45:38', '2026-04-08 16:45:38'),
(550, 60, 54, 10, '2027-01-08', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-08 16:45:38', '2026-04-08 16:45:38'),
(551, 60, 54, 11, '2027-02-08', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-08 16:45:38', '2026-04-08 16:45:38'),
(552, 60, 54, 12, '2027-03-08', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-08 16:45:38', '2026-04-08 16:45:38'),
(553, 61, 55, 1, '2026-04-08', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-08 16:52:33', '2026-04-08 16:52:33'),
(554, 61, 55, 2, '2026-05-08', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-08 16:52:33', '2026-04-08 16:52:33'),
(555, 61, 55, 3, '2026-06-08', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-08 16:52:33', '2026-04-08 16:52:33'),
(556, 61, 55, 4, '2026-07-08', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-08 16:52:33', '2026-04-08 16:52:33'),
(557, 61, 55, 5, '2026-08-08', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-08 16:52:33', '2026-04-08 16:52:33'),
(558, 61, 55, 6, '2026-09-08', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-08 16:52:33', '2026-04-08 16:52:33'),
(559, 61, 55, 7, '2026-10-08', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-08 16:52:33', '2026-04-08 16:52:33'),
(560, 61, 55, 8, '2026-11-08', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-08 16:52:33', '2026-04-08 16:52:33'),
(561, 61, 55, 9, '2026-12-08', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-08 16:52:33', '2026-04-08 16:52:33'),
(562, 61, 55, 10, '2027-01-08', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-08 16:52:33', '2026-04-08 16:52:33'),
(563, 61, 55, 11, '2027-02-08', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-08 16:52:33', '2026-04-08 16:52:33'),
(564, 61, 55, 12, '2027-03-08', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-08 16:52:33', '2026-04-08 16:52:33'),
(565, 63, 57, 1, '2026-04-08', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-09 00:21:12', '2026-04-09 00:21:12'),
(566, 63, 57, 2, '2026-05-08', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-09 00:21:12', '2026-04-09 00:21:12'),
(567, 63, 57, 3, '2026-06-08', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-09 00:21:12', '2026-04-09 00:21:12'),
(568, 63, 57, 4, '2026-07-08', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-09 00:21:12', '2026-04-09 00:21:12'),
(569, 63, 57, 5, '2026-08-08', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-09 00:21:12', '2026-04-09 00:21:12'),
(570, 63, 57, 6, '2026-09-08', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-09 00:21:12', '2026-04-09 00:21:12'),
(571, 63, 57, 7, '2026-10-08', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-09 00:21:12', '2026-04-09 00:21:12'),
(572, 63, 57, 8, '2026-11-08', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-09 00:21:12', '2026-04-09 00:21:12'),
(573, 63, 57, 9, '2026-12-08', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-09 00:21:12', '2026-04-09 00:21:12'),
(574, 63, 57, 10, '2027-01-08', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-09 00:21:12', '2026-04-09 00:21:12'),
(575, 63, 57, 11, '2027-02-08', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-09 00:21:12', '2026-04-09 00:21:12'),
(576, 63, 57, 12, '2027-03-08', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-09 00:21:12', '2026-04-09 00:21:12'),
(577, 64, 58, 1, '2026-04-08', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-09 00:32:13', '2026-04-09 00:32:13'),
(578, 64, 58, 2, '2026-05-08', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-09 00:32:13', '2026-04-09 00:32:13'),
(579, 64, 58, 3, '2026-06-08', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-09 00:32:13', '2026-04-09 00:32:13'),
(580, 64, 58, 4, '2026-07-08', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-09 00:32:13', '2026-04-09 00:32:13'),
(581, 64, 58, 5, '2026-08-08', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-09 00:32:13', '2026-04-09 00:32:13'),
(582, 64, 58, 6, '2026-09-08', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-09 00:32:13', '2026-04-09 00:32:13'),
(583, 64, 58, 7, '2026-10-08', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-09 00:32:13', '2026-04-09 00:32:13'),
(584, 64, 58, 8, '2026-11-08', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-09 00:32:13', '2026-04-09 00:32:13'),
(585, 64, 58, 9, '2026-12-08', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-09 00:32:13', '2026-04-09 00:32:13'),
(586, 64, 58, 10, '2027-01-08', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-09 00:32:13', '2026-04-09 00:32:13'),
(587, 64, 58, 11, '2027-02-08', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-09 00:32:13', '2026-04-09 00:32:13'),
(588, 64, 58, 12, '2027-03-08', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-09 00:32:13', '2026-04-09 00:32:13'),
(589, 65, 59, 1, '2026-04-08', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-09 00:54:31', '2026-04-09 00:54:31'),
(590, 65, 59, 2, '2026-05-08', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-09 00:54:31', '2026-04-09 00:54:31'),
(591, 65, 59, 3, '2026-06-08', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-09 00:54:31', '2026-04-09 00:54:31'),
(592, 65, 59, 4, '2026-07-08', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-09 00:54:31', '2026-04-09 00:54:31'),
(593, 65, 59, 5, '2026-08-08', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-09 00:54:31', '2026-04-09 00:54:31'),
(594, 65, 59, 6, '2026-09-08', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-09 00:54:31', '2026-04-09 00:54:31'),
(595, 65, 59, 7, '2026-10-08', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-09 00:54:31', '2026-04-09 00:54:31'),
(596, 65, 59, 8, '2026-11-08', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-09 00:54:31', '2026-04-09 00:54:31'),
(597, 65, 59, 9, '2026-12-08', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-09 00:54:31', '2026-04-09 00:54:31'),
(598, 65, 59, 10, '2027-01-08', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-09 00:54:31', '2026-04-09 00:54:31'),
(599, 65, 59, 11, '2027-02-08', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-09 00:54:31', '2026-04-09 00:54:31'),
(600, 65, 59, 12, '2027-03-08', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-09 00:54:31', '2026-04-09 00:54:31'),
(625, 68, 62, 1, '2026-04-08', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-09 01:26:50', '2026-04-09 01:26:50'),
(626, 68, 62, 2, '2026-05-08', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-09 01:26:50', '2026-04-09 01:26:50'),
(627, 68, 62, 3, '2026-06-08', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-09 01:26:50', '2026-04-09 01:26:50'),
(628, 68, 62, 4, '2026-07-08', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-09 01:26:50', '2026-04-09 01:26:50'),
(629, 68, 62, 5, '2026-08-08', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-09 01:26:50', '2026-04-09 01:26:50'),
(630, 68, 62, 6, '2026-09-08', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-09 01:26:50', '2026-04-09 01:26:50'),
(631, 68, 62, 7, '2026-10-08', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-09 01:26:50', '2026-04-09 01:26:50'),
(632, 68, 62, 8, '2026-11-08', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-09 01:26:50', '2026-04-09 01:26:50'),
(633, 68, 62, 9, '2026-12-08', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-09 01:26:50', '2026-04-09 01:26:50'),
(634, 68, 62, 10, '2027-01-08', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-09 01:26:50', '2026-04-09 01:26:50'),
(635, 68, 62, 11, '2027-02-08', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-09 01:26:50', '2026-04-09 01:26:50'),
(636, 68, 62, 12, '2027-03-08', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-09 01:26:50', '2026-04-09 01:26:50'),
(637, 69, 63, 1, '2026-04-09', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-09 13:57:22', '2026-04-09 13:57:22'),
(638, 69, 63, 2, '2026-05-09', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-09 13:57:22', '2026-04-09 13:57:22'),
(639, 69, 63, 3, '2026-06-09', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-09 13:57:22', '2026-04-09 13:57:22'),
(640, 69, 63, 4, '2026-07-09', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-09 13:57:22', '2026-04-09 13:57:22'),
(641, 69, 63, 5, '2026-08-09', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-09 13:57:22', '2026-04-09 13:57:22'),
(642, 69, 63, 6, '2026-09-09', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-09 13:57:22', '2026-04-09 13:57:22'),
(643, 69, 63, 7, '2026-10-09', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-09 13:57:22', '2026-04-09 13:57:22'),
(644, 69, 63, 8, '2026-11-09', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-09 13:57:22', '2026-04-09 13:57:22'),
(645, 69, 63, 9, '2026-12-09', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-09 13:57:22', '2026-04-09 13:57:22'),
(646, 69, 63, 10, '2027-01-09', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-09 13:57:22', '2026-04-09 13:57:22'),
(647, 69, 63, 11, '2027-02-09', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-09 13:57:22', '2026-04-09 13:57:22'),
(648, 69, 63, 12, '2027-03-09', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-09 13:57:22', '2026-04-09 13:57:22'),
(649, 76, 70, 1, '2026-04-09', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-10 02:00:20', '2026-04-10 02:00:20'),
(650, 76, 70, 2, '2026-05-09', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-10 02:00:20', '2026-04-10 02:00:20'),
(651, 76, 70, 3, '2026-06-09', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-10 02:00:20', '2026-04-10 02:00:20'),
(652, 76, 70, 4, '2026-07-09', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-10 02:00:20', '2026-04-10 02:00:20'),
(653, 76, 70, 5, '2026-08-09', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-10 02:00:20', '2026-04-10 02:00:20'),
(654, 76, 70, 6, '2026-09-09', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-10 02:00:20', '2026-04-10 02:00:20'),
(655, 76, 70, 7, '2026-10-09', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-10 02:00:20', '2026-04-10 02:00:20'),
(656, 76, 70, 8, '2026-11-09', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-10 02:00:20', '2026-04-10 02:00:20'),
(657, 76, 70, 9, '2026-12-09', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-10 02:00:20', '2026-04-10 02:00:20'),
(658, 76, 70, 10, '2027-01-09', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-10 02:00:20', '2026-04-10 02:00:20'),
(659, 76, 70, 11, '2027-02-09', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-10 02:00:20', '2026-04-10 02:00:20'),
(660, 76, 70, 12, '2027-03-09', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-10 02:00:20', '2026-04-10 02:00:20'),
(673, 78, 72, 1, '2026-04-11', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-11 14:20:00', '2026-04-11 14:20:00'),
(674, 78, 72, 2, '2026-05-11', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-11 14:20:00', '2026-04-11 14:20:00'),
(675, 78, 72, 3, '2026-06-11', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-11 14:20:00', '2026-04-11 14:20:00'),
(676, 78, 72, 4, '2026-07-11', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-11 14:20:00', '2026-04-11 14:20:00'),
(677, 78, 72, 5, '2026-08-11', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-11 14:20:00', '2026-04-11 14:20:00'),
(678, 78, 72, 6, '2026-09-11', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-11 14:20:00', '2026-04-11 14:20:00'),
(679, 78, 72, 7, '2026-10-11', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-11 14:20:00', '2026-04-11 14:20:00'),
(680, 78, 72, 8, '2026-11-11', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-11 14:20:00', '2026-04-11 14:20:00'),
(681, 78, 72, 9, '2026-12-11', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-11 14:20:00', '2026-04-11 14:20:00'),
(682, 78, 72, 10, '2027-01-11', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-11 14:20:00', '2026-04-11 14:20:00'),
(683, 78, 72, 11, '2027-02-11', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-11 14:20:00', '2026-04-11 14:20:00'),
(684, 78, 72, 12, '2027-03-11', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-11 14:20:00', '2026-04-11 14:20:00'),
(685, 80, 74, 1, '2026-04-11', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-11 23:43:36', '2026-04-11 23:43:36'),
(686, 80, 74, 2, '2026-05-11', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-11 23:43:36', '2026-04-11 23:43:36'),
(687, 80, 74, 3, '2026-06-11', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-11 23:43:36', '2026-04-11 23:43:36'),
(688, 80, 74, 4, '2026-07-11', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-11 23:43:36', '2026-04-11 23:43:36'),
(689, 80, 74, 5, '2026-08-11', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-11 23:43:36', '2026-04-11 23:43:36'),
(690, 80, 74, 6, '2026-09-11', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-11 23:43:36', '2026-04-11 23:43:36'),
(691, 80, 74, 7, '2026-10-11', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-11 23:43:36', '2026-04-11 23:43:36'),
(692, 80, 74, 8, '2026-11-11', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-11 23:43:36', '2026-04-11 23:43:36'),
(693, 80, 74, 9, '2026-12-11', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-11 23:43:36', '2026-04-11 23:43:36'),
(694, 80, 74, 10, '2027-01-11', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-11 23:43:36', '2026-04-11 23:43:36'),
(695, 80, 74, 11, '2027-02-11', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-11 23:43:36', '2026-04-11 23:43:36'),
(696, 80, 74, 12, '2027-03-11', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-11 23:43:36', '2026-04-11 23:43:36'),
(697, 81, 75, 1, '2026-04-12', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-12 22:22:45', '2026-04-12 22:22:45'),
(698, 81, 75, 2, '2026-05-12', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-12 22:22:45', '2026-04-12 22:22:45'),
(699, 81, 75, 3, '2026-06-12', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-12 22:22:45', '2026-04-12 22:22:45'),
(700, 81, 75, 4, '2026-07-12', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-12 22:22:45', '2026-04-12 22:22:45'),
(701, 81, 75, 5, '2026-08-12', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-12 22:22:45', '2026-04-12 22:22:45'),
(702, 81, 75, 6, '2026-09-12', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-12 22:22:45', '2026-04-12 22:22:45'),
(703, 81, 75, 7, '2026-10-12', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-12 22:22:45', '2026-04-12 22:22:45'),
(704, 81, 75, 8, '2026-11-12', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-12 22:22:45', '2026-04-12 22:22:45'),
(705, 81, 75, 9, '2026-12-12', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-12 22:22:45', '2026-04-12 22:22:45'),
(706, 81, 75, 10, '2027-01-12', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-12 22:22:45', '2026-04-12 22:22:45'),
(707, 81, 75, 11, '2027-02-12', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-12 22:22:45', '2026-04-12 22:22:45'),
(708, 81, 75, 12, '2027-03-12', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-12 22:22:45', '2026-04-12 22:22:45'),
(721, 83, 77, 1, '2026-04-12', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-13 00:56:25', '2026-04-13 00:56:25'),
(722, 83, 77, 2, '2026-05-12', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-13 00:56:25', '2026-04-13 00:56:25'),
(723, 83, 77, 3, '2026-06-12', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-13 00:56:25', '2026-04-13 00:56:25'),
(724, 83, 77, 4, '2026-07-12', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-13 00:56:25', '2026-04-13 00:56:25'),
(725, 83, 77, 5, '2026-08-12', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-13 00:56:25', '2026-04-13 00:56:25'),
(726, 83, 77, 6, '2026-09-12', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-13 00:56:25', '2026-04-13 00:56:25'),
(727, 83, 77, 7, '2026-10-12', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-13 00:56:25', '2026-04-13 00:56:25'),
(728, 83, 77, 8, '2026-11-12', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-13 00:56:25', '2026-04-13 00:56:25'),
(729, 83, 77, 9, '2026-12-12', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-13 00:56:25', '2026-04-13 00:56:25'),
(730, 83, 77, 10, '2027-01-12', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-13 00:56:25', '2026-04-13 00:56:25'),
(731, 83, 77, 11, '2027-02-12', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-13 00:56:25', '2026-04-13 00:56:25'),
(732, 83, 77, 12, '2027-03-12', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-13 00:56:25', '2026-04-13 00:56:25'),
(733, 84, 78, 1, '2026-04-15', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-15 20:05:01', '2026-04-15 20:05:01'),
(734, 85, 79, 1, '2026-04-15', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-15 21:46:56', '2026-04-15 21:46:56'),
(735, 86, 80, 1, '2026-04-17', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-17 16:36:53', '2026-04-17 16:36:53'),
(736, 87, 81, 1, '2026-04-17', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-17 17:37:05', '2026-04-17 17:37:05'),
(737, 88, 82, 1, '2026-04-17', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-17 17:40:07', '2026-04-17 17:40:07'),
(738, 89, 83, 1, '2026-04-18', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-18 17:21:19', '2026-04-18 17:21:19'),
(739, 90, 84, 1, '2026-04-18', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-18 21:52:59', '2026-04-18 21:52:59'),
(740, 91, 85, 1, '2026-04-19', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-20 00:21:51', '2026-04-20 00:21:51'),
(741, 92, 86, 1, '2026-04-26', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-26 22:59:36', '2026-04-26 22:59:36'),
(742, 93, 87, 1, '2026-04-26', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-26 23:02:36', '2026-04-26 23:02:36'),
(743, 94, 88, 1, '2026-04-27', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-27 10:38:44', '2026-04-27 10:38:44'),
(744, 95, 89, 1, '2026-04-27', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-27 16:05:27', '2026-04-27 16:05:27'),
(745, 96, 90, 1, '2026-05-05', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-05-05 10:18:16', '2026-05-05 10:18:16'),
(746, 97, 91, 1, '2026-05-06', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-05-06 18:12:15', '2026-05-06 18:12:15'),
(747, 98, 92, 1, '2026-05-08', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-05-08 16:38:04', '2026-05-08 16:38:04'),
(748, 100, 94, 1, '2026-05-09', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-05-09 13:11:22', '2026-05-09 13:11:22'),
(749, 101, 95, 1, '2026-05-11', 0.00, 'completed', 'Bkash', '2000/-', '2026-05-11 21:27:05', 1, NULL, NULL, NULL, NULL, '2026-05-11 20:56:08', '2026-05-11 21:27:05'),
(750, 102, 96, 1, '2026-05-11', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-05-11 21:14:48', '2026-05-11 21:14:48'),
(751, 103, 97, 1, '2026-05-11', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-05-11 23:12:05', '2026-05-11 23:12:05'),
(752, 104, 98, 1, '2026-06-13', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-06-14 00:11:54', '2026-06-14 00:11:54'),
(753, 105, 99, 1, '2026-06-13', 0.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-06-14 01:08:23', '2026-06-14 01:08:23');

-- --------------------------------------------------------

--
-- Table structure for table `membership_transactions`
--

CREATE TABLE `membership_transactions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `membership_installment_id` bigint(20) UNSIGNED DEFAULT NULL,
  `amount` decimal(10,2) NOT NULL,
  `payment_type` varchar(255) NOT NULL,
  `trx_id` varchar(255) DEFAULT NULL,
  `admin_id` bigint(20) UNSIGNED DEFAULT NULL,
  `completed_by` enum('admin','user') NOT NULL,
  `status` enum('pending','completed','failed') NOT NULL DEFAULT 'completed',
  `notes` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `membership_transactions`
--

INSERT INTO `membership_transactions` (`id`, `user_id`, `membership_installment_id`, `amount`, `payment_type`, `trx_id`, `admin_id`, `completed_by`, `status`, `notes`, `created_at`, `updated_at`) VALUES
(1, 101, 749, 0.00, 'Bkash', NULL, 1, 'admin', 'completed', NULL, '2026-05-11 21:26:35', '2026-05-11 21:26:35'),
(2, 101, 749, 0.00, 'Bkash', NULL, 1, 'admin', 'completed', '2000/-', '2026-05-11 21:27:05', '2026-05-11 21:27:05');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2026_02_05_104149_create_admins_table', 1),
(5, '2026_02_05_105558_create_slideshow_banners_table', 2),
(6, '2026_02_05_111234_create_board_directors_table', 3),
(7, '2026_02_05_112705_create_about_us_table', 4),
(9, '2026_02_08_102511_create_facilities_table', 5),
(10, '2026_02_13_200201_create_membership_categories_table', 6),
(11, '2026_02_14_064923_create_vision_mission_table', 7),
(12, '2026_02_14_074259_create_events_table', 8),
(13, '2026_02_14_090113_create_inquiries_table', 9),
(14, '2026_02_14_093730_create_site_settings_table', 10),
(15, '2026_02_14_093734_create_seo_settings_table', 10),
(16, '2026_02_14_143257_create_membership_applications_table', 11),
(17, '2026_02_14_150251_create_user_profiles_table', 12),
(18, '2026_02_17_073413_add_reference_and_signature_to_membership_applications', 13),
(19, '2026_02_17_074944_add_photo_to_membership_applications', 14),
(20, '2026_02_17_090108_add_photo_to_user_profiles_table', 15),
(21, '2026_02_17_151144_create_password_reset_otps_table', 16),
(22, '2026_02_19_063634_add_application_fee_to_site_settings_table', 17),
(23, '2026_02_19_073614_add_membership_dates_to_user_profiles_table', 17),
(24, '2026_02_19_073614_create_membership_installments_table', 17),
(25, '2026_02_19_073614_create_membership_transactions_table', 17),
(26, '2026_02_19_094410_create_invitations_table', 17),
(27, '2026_02_22_095345_add_nid_photo_remove_digital_signature_from_membership_applications', 17),
(28, '2026_02_22_102311_add_whatsapp_url_to_site_settings_table', 17),
(29, '2026_03_17_144002_create_archives_table', 18),
(30, '2026_03_19_120253_create_payment_methods_table', 19),
(31, '2026_03_19_120718_add_qr_image_to_payment_methods_table', 20),
(32, '2026_03_19_132512_add_payment_fields_to_membership_applications_table', 21),
(33, '2026_03_19_132512_create_transactions_table', 21),
(34, '2026_03_19_143108_add_member_payment_fields_to_membership_installments_table', 22),
(35, '2026_03_20_112222_create_announcements_table', 23),
(36, '2026_03_21_062114_create_orders_table', 24),
(37, '2026_03_21_062114_create_products_table', 24),
(38, '2026_03_21_062115_create_order_items_table', 24),
(39, '2026_03_24_000001_add_installment_price_to_membership_categories', 25),
(40, '2026_03_24_000002_create_honorary_members_table', 25),
(41, '2026_03_24_000003_create_donations_table', 25),
(42, '2026_03_25_000001_create_donation_categories_table', 25),
(43, '2026_03_25_000002_update_donations_table', 25),
(44, '2026_03_25_000003_create_expenses_table', 25),
(45, '2026_03_29_000001_add_suspension_to_users_table', 26),
(46, '2026_04_01_000001_change_designation_to_json_in_honorary_members_table', 26),
(47, '2026_04_02_000001_add_fee_to_events_table', 26),
(48, '2026_04_02_000002_create_event_registrations_table', 26),
(49, '2026_04_03_182142_add_label_to_payment_methods', 26),
(50, '2026_04_06_000001_create_tan_samitis_table', 26),
(51, '2026_04_06_000002_create_tan_samiti_members_table', 26),
(52, '2026_04_06_000003_create_tan_samiti_installments_table', 26),
(53, '2026_04_06_000004_create_tan_samiti_draws_table', 26),
(54, '2026_04_06_100001_add_rejected_at_to_tan_samiti_installments_table', 26),
(55, '2026_04_09_120640_add_invite_id_to_membership_applications_table', 27),
(56, '2026_04_09_124557_add_optional_installment_to_membership_categories_table', 27),
(57, '2026_04_11_064743_add_social_links_to_user_profiles_table', 27),
(58, '2026_04_14_000001_add_investment_plan_fields_to_tan_samitis_table', 27),
(59, '2026_05_07_120000_add_manual_member_id_to_user_profiles_table', 28);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `full_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `billing_address` text NOT NULL,
  `shipping_address` text NOT NULL,
  `payment_method_id` bigint(20) UNSIGNED DEFAULT NULL,
  `transaction_id` varchar(255) NOT NULL,
  `payment_proof_path` varchar(255) DEFAULT NULL,
  `subtotal` decimal(10,2) NOT NULL DEFAULT 0.00,
  `delivery_charge` decimal(10,2) NOT NULL DEFAULT 0.00,
  `total_amount` decimal(10,2) NOT NULL DEFAULT 0.00,
  `status` enum('pending','processing','shipped','delivered','cancelled') NOT NULL DEFAULT 'pending',
  `admin_notes` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `full_name`, `email`, `phone`, `billing_address`, `shipping_address`, `payment_method_id`, `transaction_id`, `payment_proof_path`, `subtotal`, `delivery_charge`, `total_amount`, `status`, `admin_notes`, `created_at`, `updated_at`) VALUES
(1, NULL, 'Kirby Durham', 'rude@mailinator.com', '+1 (421) 669-5535', 'Quas at sit asperior', 'Quas at sit asperior', 1, 'ABVCA122', 'order-proofs/JisplIKhbD5Ae3NXhShclcAr0L2M1M75uSeSV3hS.jpg', 1000.00, 80.00, 1080.00, 'cancelled', NULL, '2026-03-25 03:06:34', '2026-03-26 23:38:06');

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `quantity` int(10) UNSIGNED NOT NULL DEFAULT 1,
  `unit_price` decimal(10,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`id`, `order_id`, `product_id`, `quantity`, `unit_price`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 1, 1000.00, '2026-03-25 03:06:34', '2026-03-25 03:06:34');

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_otps`
--

CREATE TABLE `password_reset_otps` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `email` varchar(255) NOT NULL,
  `otp` varchar(255) NOT NULL,
  `expires_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payment_methods`
--

CREATE TABLE `payment_methods` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `label` varchar(255) DEFAULT NULL,
  `logo_path` varchar(255) DEFAULT NULL,
  `instruction` text DEFAULT NULL,
  `wallet_number` varchar(255) DEFAULT NULL,
  `qr_image_path` varchar(255) DEFAULT NULL,
  `status` enum('active','inactive') NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `payment_methods`
--

INSERT INTO `payment_methods` (`id`, `name`, `label`, `logo_path`, `instruction`, `wallet_number`, `qr_image_path`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Bkash', NULL, 'payment-methods/95bdbf9OuPcVjxbE5oIzUfbc3ZGB6W337Tij2U53.png', 'Scan the QR or Go to your bkash app and choose make payment option and enter the exact amount.', '01816096238', 'payment-methods/qr/uZDw8iZuICm2eOoxtUgOuajjRjogFzvD9kfOWZ0w.png', 'active', '2026-03-19 07:11:28', '2026-03-25 03:19:56'),
(3, 'Bank Transfer', NULL, 'payment-methods/LYcJVuLFzl0KCGLGHmfqSp0O0rX68FIbbYaiNMBm.png', 'Bank Name: Dutch Bangla Bank PLC\r\nBranch: Mohakhali CA\r\nA/C Name: The Bengal Club \r\nA/C No: 1141100473498\r\nRouting No: 090263194\r\nSwift Code: DBBLBDDH114', '1141100473498', NULL, 'active', '2026-03-19 07:14:36', '2026-03-23 04:37:06');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `image_path` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `price` decimal(10,2) NOT NULL,
  `delivery_charge` decimal(10,2) NOT NULL DEFAULT 0.00,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `title`, `image_path`, `description`, `price`, `delivery_charge`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'Membership Card', 'products/tJ8ukqmPzmCnyqOP5IOfFfLWJPQ1PIwcXOumTRIg.jpg', 'Plastic printed premium membership QR card.', 1000.00, 80.00, 1, '2026-03-22 10:36:13', '2026-04-24 19:49:14'),
(2, 'Membership Certificate', 'products/K4Yxkt9Ew2thg6PCmW1Y5q0OeJmksX7fL00yfBlm.jpg', 'A certificate issued by our club', 1000.00, 80.00, 1, '2026-03-22 10:36:41', '2026-03-23 04:31:52');

-- --------------------------------------------------------

--
-- Table structure for table `seo_settings`
--

CREATE TABLE `seo_settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `meta_title` varchar(255) DEFAULT NULL,
  `meta_description` text DEFAULT NULL,
  `meta_keywords` text DEFAULT NULL,
  `meta_author` varchar(255) DEFAULT NULL,
  `canonical_url` varchar(255) DEFAULT NULL,
  `og_title` varchar(255) DEFAULT NULL,
  `og_description` text DEFAULT NULL,
  `og_image` varchar(255) DEFAULT NULL,
  `og_url` varchar(255) DEFAULT NULL,
  `og_type` varchar(255) NOT NULL DEFAULT 'website',
  `og_site_name` varchar(255) DEFAULT NULL,
  `fb_app_id` varchar(255) DEFAULT NULL,
  `twitter_card` varchar(255) NOT NULL DEFAULT 'summary_large_image',
  `twitter_site` varchar(255) DEFAULT NULL,
  `twitter_creator` varchar(255) DEFAULT NULL,
  `twitter_title` varchar(255) DEFAULT NULL,
  `twitter_description` text DEFAULT NULL,
  `twitter_image` varchar(255) DEFAULT NULL,
  `google_analytics_id` varchar(255) DEFAULT NULL,
  `google_site_verification` varchar(255) DEFAULT NULL,
  `facebook_pixel_id` varchar(255) DEFAULT NULL,
  `custom_head_code` text DEFAULT NULL,
  `custom_body_code` text DEFAULT NULL,
  `index_page` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `seo_settings`
--

INSERT INTO `seo_settings` (`id`, `meta_title`, `meta_description`, `meta_keywords`, `meta_author`, `canonical_url`, `og_title`, `og_description`, `og_image`, `og_url`, `og_type`, `og_site_name`, `fb_app_id`, `twitter_card`, `twitter_site`, `twitter_creator`, `twitter_title`, `twitter_description`, `twitter_image`, `google_analytics_id`, `google_site_verification`, `facebook_pixel_id`, `custom_head_code`, `custom_body_code`, `index_page`, `created_at`, `updated_at`) VALUES
(1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'website', NULL, NULL, 'summary_large_image', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2026-02-14 09:26:43', '2026-02-14 09:26:43');

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('17GeomuNIVi6hKOyQs3l9fnyEo6GsSkEnnldELeH', NULL, '43.157.188.74', 'Mozilla/5.0 (iPhone; CPU iPhone OS 13_2_3 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/13.0.3 Mobile/15E148 Safari/604.1', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoia2s4RGd4WGJqcE1kVG1MZHN5aExLbW9YOHdVRUNUd3FsaHhoWUlyYiI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjY6Imh0dHBzOi8vd3d3LnRoZWJlbmdhbC5jbHViIjtzOjU6InJvdXRlIjtzOjE0OiJmcm9udGVuZC5pbmRleCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1781523740),
('2cWLrSSvUGpYrwlqzbvkJYSeO7zk3G29NZ8YGC8N', NULL, '173.252.95.19', 'facebookexternalhit/1.1 (+http://www.facebook.com/externalhit_uatext.php)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiVnpodWh6anpCem5Ed1l4T0ducjR5aDB5YlN2cUdieFNqMUt2bDV6aSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjY6Imh0dHBzOi8vd3d3LnRoZWJlbmdhbC5jbHViIjtzOjU6InJvdXRlIjtzOjE0OiJmcm9udGVuZC5pbmRleCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1781564464),
('2U2gADtvybqCJKZvwkStBsbc4weyF8K8owLndZHV', NULL, '140.235.169.198', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/124.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiRXBhZG11Tlh1UUtqcXlJbWVRMkcxd0JHQ09nUGRyM0k4ZXMwNjV5MyI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjI6Imh0dHBzOi8vdGhlYmVuZ2FsLmNsdWIiO3M6NToicm91dGUiO3M6MTQ6ImZyb250ZW5kLmluZGV4Ijt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1781531100),
('2WmOcKNftBP0cXzBI4CZ2KbQLMZcAzISwp8cWqdv', NULL, '185.191.171.10', 'Mozilla/5.0 (compatible; SemrushBot/7~bl; +http://www.semrush.com/bot.html)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoicVpPQXNZcGQ5bGNHbjd1MnpVTE9XSVF2aHdlTmRLVW5TTkpkUzhSZiI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzU6Imh0dHBzOi8vdGhlYmVuZ2FsLmNsdWIvc2hvcC8xL29yZGVyIjtzOjU6InJvdXRlIjtzOjEwOiJzaG9wLm9yZGVyIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1781515680),
('68eTbwLV5s1nCtpuWKGYh0AmkI2h0RE2LHWijqNU', NULL, '49.51.183.84', 'Mozilla/5.0 (iPhone; CPU iPhone OS 13_2_3 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/13.0.3 Mobile/15E148 Safari/604.1', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiV3k1T0Jkb0dveFRSc0szMHNUTHdpVWljVW40MEROejc0SmZwTTE1UCI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjY6Imh0dHBzOi8vd3d3LnRoZWJlbmdhbC5jbHViIjtzOjU6InJvdXRlIjtzOjE0OiJmcm9udGVuZC5pbmRleCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1781551660),
('72q3vYnsZlSM8j8WJyJwEv0KckVo9I3spKegvNrY', NULL, '175.178.110.121', 'Mozilla/5.0 (iPhone; CPU iPhone OS 13_2_3 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/13.0.3 Mobile/15E148 Safari/604.1', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoieGk4NFpVNVNDazN4WEdkcWhacUZ0c0x1cFFhdmtKT0dmcDlBY1RobCI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjI6Imh0dHBzOi8vdGhlYmVuZ2FsLmNsdWIiO3M6NToicm91dGUiO3M6MTQ6ImZyb250ZW5kLmluZGV4Ijt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1781506088),
('962F56dLuluifWHQ8dSwQt45ZBNFqmJSJTX83T4a', NULL, '34.159.69.188', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/124.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiU0lDcXBDVHFIQXNTcElXRkpiMmVyNkxidjZqZUpHMkhJQzZXNUlNUyI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjY6Imh0dHBzOi8vd3d3LnRoZWJlbmdhbC5jbHViIjtzOjU6InJvdXRlIjtzOjE0OiJmcm9udGVuZC5pbmRleCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1781571881),
('a6ExDhyyXlKlulwv0TwyyNfkz5Yk2jxg6PmpPy2g', NULL, '202.134.14.234', 'Mozilla/5.0 (iPhone; CPU iPhone OS 18_7 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/26.3 Mobile/15E148 Safari/604.1', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiU1QzSUdGTEh4bG10MmM5cGh2VW8yb0twQzBRdDl5Q0JNUE9GRWZsZSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NDA6Imh0dHBzOi8vdGhlYmVuZ2FsLmNsdWIvbWVtYmVyLzkwL3FyLWNvZGUiO3M6NToicm91dGUiO3M6MTQ6Im1lbWJlci5xci1jb2RlIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1781505088),
('Ad5GezfCuD1VDqxO9tCi3tJRUf9JLamroGkP5Xt3', NULL, '52.167.144.18', 'Mozilla/5.0 AppleWebKit/537.36 (KHTML, like Gecko; compatible; bingbot/2.0; +http://www.bing.com/bingbot.htm) Chrome/116.0.1938.76 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiTU0xeG1hc0hXQjEyeVdFb0p1bUVqcDdNZTZ1N2tWYktrTmZmQmtsYiI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjI6Imh0dHBzOi8vdGhlYmVuZ2FsLmNsdWIiO3M6NToicm91dGUiO3M6MTQ6ImZyb250ZW5kLmluZGV4Ijt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1781517249),
('C1K88GY9vQVm3gyg1Zfxwh9rcvDg7cUNzQEj0HrT', NULL, '74.80.182.90', 'Python/3.11 aiohttp/3.13.3', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiVVZVMVFQMzZxY1MwelNnNGZWMWhhblpUcmtsakRURnZDSTRDelhGbSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjI6Imh0dHBzOi8vdGhlYmVuZ2FsLmNsdWIiO3M6NToicm91dGUiO3M6MTQ6ImZyb250ZW5kLmluZGV4Ijt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1781555280),
('C5DpfAIQrCP0w1ePuh8fhMMJf67JtPCkkuuk4viP', NULL, '162.62.231.139', 'Mozilla/5.0 (iPhone; CPU iPhone OS 13_2_3 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/13.0.3 Mobile/15E148 Safari/604.1', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiVWtCZ0VqU0pLT1FZN3d3YU5HNG9sZDBPcTdhYnpGNFZjNzdxSUFiUSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjY6Imh0dHBzOi8vd3d3LnRoZWJlbmdhbC5jbHViIjtzOjU6InJvdXRlIjtzOjE0OiJmcm9udGVuZC5pbmRleCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1781567062),
('CRavvxf6NAfU6YH2nyFpv1OEtYACKw5gVkD3lOfN', NULL, '150.109.119.38', 'Mozilla/5.0 (iPhone; CPU iPhone OS 13_2_3 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/13.0.3 Mobile/15E148 Safari/604.1', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiMjNwTkpjOFlQYzBPazVrNU12ZUFBZTEzYlFXQnFneVhXNmR5Q1ZKZiI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjI6Imh0dHBzOi8vdGhlYmVuZ2FsLmNsdWIiO3M6NToicm91dGUiO3M6MTQ6ImZyb250ZW5kLmluZGV4Ijt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1781520988),
('GlRzv5LuZykIILlBxQwp7ymcX9ylNf7CeFYwIXXB', NULL, '51.222.95.156', 'Mozilla/5.0 (compatible; AhrefsBot/7.0; +http://ahrefs.com/robot/)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiZVVNeUNHVTl1eTBHcTZEUFFqQ24xQ2JnaE8wSjlXcHAzVU84R3dRRCI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzE6Imh0dHBzOi8vdGhlYmVuZ2FsLmNsdWIvZXZlbnRzLzEiO3M6NToicm91dGUiO3M6MjA6ImZyb250ZW5kLmV2ZW50cy5zaG93Ijt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1781565908),
('It6NRUeBxVfqPDuXtGsUTTTzCoRCTDAqOQGGMAKy', NULL, '217.160.202.182', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.114 Safari/537.36 Edg/91.0.864.54', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiOXZuMERqQjdTRW9rR05Tc0pVVWx6OWYxMTRxSEVyTTNJUks1YmgwYSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjI6Imh0dHBzOi8vdGhlYmVuZ2FsLmNsdWIiO3M6NToicm91dGUiO3M6MTQ6ImZyb250ZW5kLmluZGV4Ijt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1781574954),
('JCrxtmxxf0Nb5LgRqe45cTxaF90eXRSEOXOauOCH', NULL, '175.27.163.171', 'Mozilla/5.0 (iPhone; CPU iPhone OS 13_2_3 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/13.0.3 Mobile/15E148 Safari/604.1', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiMEs2cW56SmJOZlJJTHE1MU9aZnd2NDBrZ2NsSHdHeU9mWHlpYkFiWCI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjI6Imh0dHBzOi8vdGhlYmVuZ2FsLmNsdWIiO3M6NToicm91dGUiO3M6MTQ6ImZyb250ZW5kLmluZGV4Ijt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1781551019),
('JNliUgwlka5AyhRNPNMWgV6RKhYZT5DmBpBvqYTA', NULL, '173.252.109.2', 'facebookexternalhit/1.1 (+http://www.facebook.com/externalhit_uatext.php)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiVGFuTkhMRlZWMlZDemhCb0xKSzRBUDN1VWpPdVlmZnJDU2lwUW5kQSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjY6Imh0dHBzOi8vd3d3LnRoZWJlbmdhbC5jbHViIjtzOjU6InJvdXRlIjtzOjE0OiJmcm9udGVuZC5pbmRleCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1781556641),
('jWR85s4A3UAnwpWYcYml94aSADOsFVLlj3bFFIsO', NULL, '4.196.118.112', 'Mozilla/5.0 AppleWebKit/537.36 (KHTML, like Gecko); compatible; ChatGPT-User/1.0; +https://openai.com/bot', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoicEF0Qkx0TjN4dFVuQThmZFIwdFBnS1pCalExbHhUMlFGZzBWZVZOVCI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjI6Imh0dHBzOi8vdGhlYmVuZ2FsLmNsdWIiO3M6NToicm91dGUiO3M6MTQ6ImZyb250ZW5kLmluZGV4Ijt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1781515317),
('kq3RNoLcTmvzykNAQt8CqwWuvTTQB3g57kQ7sNyX', NULL, '193.186.4.159', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiR2FpZ1dnaGhVVWt2WlBhV0Rvd3RYeXUyOVFoQzFqV2RZRGoyTWtubCI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjY6Imh0dHBzOi8vd3d3LnRoZWJlbmdhbC5jbHViIjtzOjU6InJvdXRlIjtzOjE0OiJmcm9udGVuZC5pbmRleCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1781525686),
('L2V5qSKru7cPxXIYGWv60A4erxxRx7yrs28ppLYl', NULL, '43.157.20.63', 'Mozilla/5.0 (iPhone; CPU iPhone OS 13_2_3 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/13.0.3 Mobile/15E148 Safari/604.1', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiRVU5eDh6bk9ndDZDcndhdGltdFFhYzVqR3h2bkNVQnBldjRYdFRIYyI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjI6Imh0dHBzOi8vdGhlYmVuZ2FsLmNsdWIiO3M6NToicm91dGUiO3M6MTQ6ImZyb250ZW5kLmluZGV4Ijt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1781564032),
('LCzRyzvqmklubGVeBL4nJdgvSUadg5vNKtkulRN1', NULL, '185.247.137.242', 'Mozilla/5.0 (compatible; InternetMeasurement/1.0; +https://internet-measurement.com/)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoidm52YzBIeUZYd2RBR0dUMGJodERYb09TNnYwUEVKczdpYWh0dDJWQSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjY6Imh0dHBzOi8vd3d3LnRoZWJlbmdhbC5jbHViIjtzOjU6InJvdXRlIjtzOjE0OiJmcm9udGVuZC5pbmRleCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1781555103),
('mkrZfFS1G2yJbKgAyUm9O4dskAsF9iz4BsbLYPrd', NULL, '54.39.89.146', 'Mozilla/5.0 (compatible; AhrefsBot/7.0; +http://ahrefs.com/robot/)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiQ3VweE54M1REeUNMa3kxajZhY21CQjNUdHlSaHJBajI2R3ZXU0ZPWSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzU6Imh0dHBzOi8vd3d3LnRoZWJlbmdhbC5jbHViL2V2ZW50cy8xIjtzOjU6InJvdXRlIjtzOjIwOiJmcm9udGVuZC5ldmVudHMuc2hvdyI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1781546187),
('MwFumPuDn2EQH2hZEGvRVtBwxwbvxPDTiupQvAU1', NULL, '143.244.178.69', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiYkw4ejJ4N1RTMEhKRTczYTJRUkw3a212bzNtdDQ0M3dQVVp0TlUxTiI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjI6Imh0dHBzOi8vdGhlYmVuZ2FsLmNsdWIiO3M6NToicm91dGUiO3M6MTQ6ImZyb250ZW5kLmluZGV4Ijt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1781525994),
('OhnU23CES78qN93Z73nND41nTwceWi4NgePRkGYy', NULL, '198.235.24.155', 'Hello from Palo Alto Networks, find out more about our scans in https://docs-cortex.paloaltonetworks.com/r/1/Cortex-Xpanse/Scanning-activity', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiaU9VQnprNnQ5NzBuZDFSNGMyVFV5d3pnZ2JudmZ6Y0FiVmhlUkZaYyI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjY6Imh0dHBzOi8vd3d3LnRoZWJlbmdhbC5jbHViIjtzOjU6InJvdXRlIjtzOjE0OiJmcm9udGVuZC5pbmRleCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1781514292),
('oli8uJmYD7xGecAm2z8NMkKfT1RN8mqQjOwhjDlr', NULL, '66.249.74.39', 'Mozilla/5.0 (Linux; Android 6.0.1; Nexus 5X Build/MMB29P) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.7778.96 Mobile Safari/537.36 (compatible; Googlebot/2.1; +http://www.google.com/bot.html)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiWmtLbnhEcTVDUTNMenN3Vjc2SEs3SFByMHNoZ09KdHQ1SEw3YUVQeiI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjI6Imh0dHBzOi8vdGhlYmVuZ2FsLmNsdWIiO3M6NToicm91dGUiO3M6MTQ6ImZyb250ZW5kLmluZGV4Ijt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1781548741),
('rzLUhW0wIOr9yAntPE4bURGOPWgAqicHsykdODO3', NULL, '34.38.173.165', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/124.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoidHp6QnBzZFhVVmlJQnhZaFh5ZTdOZ1hLQlAyVkZsY2FsWVlqYm1LcSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjY6Imh0dHBzOi8vd3d3LnRoZWJlbmdhbC5jbHViIjtzOjU6InJvdXRlIjtzOjE0OiJmcm9udGVuZC5pbmRleCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1781564587),
('SH30haMDey1QWyuetCaTW32R5bDqwlVCxPZRclR3', NULL, '45.248.151.65', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiVlQxaGM3Rk9kY05SOGZFNVlGQ0s4TzgwN1NTSDkwMHdFYUxPSTJQcCI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzE6Imh0dHBzOi8vdGhlYmVuZ2FsLmNsdWIvZXZlbnRzLzIiO3M6NToicm91dGUiO3M6MjA6ImZyb250ZW5kLmV2ZW50cy5zaG93Ijt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1781583484),
('SolMSdcrknjtjWPATXoGhxjJvwhMHN37bEoKVINB', NULL, '51.68.236.71', 'Mozilla/5.0 (compatible; MJ12bot/v2.0.5; http://mj12bot.com/)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiZGFkdkhDMXFRdkpYMGtwUURIc0hwcWNkREppY2xSMEI3aER1YXk0UCI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjI6Imh0dHBzOi8vdGhlYmVuZ2FsLmNsdWIiO3M6NToicm91dGUiO3M6MTQ6ImZyb250ZW5kLmluZGV4Ijt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1781508260),
('t7wYnkouKaDnqagOKBDbHHkoPWpBp6BBg08cKXW5', NULL, '23.98.142.191', 'Mozilla/5.0 AppleWebKit/537.36 (KHTML, like Gecko); compatible; ChatGPT-User/1.0; +https://openai.com/bot', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoid3V3cTh0bklrVVdRZ0x1STZja0d0Tk9PV0NGWWJVMjlrQXJqYjZYayI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjY6Imh0dHBzOi8vd3d3LnRoZWJlbmdhbC5jbHViIjtzOjU6InJvdXRlIjtzOjE0OiJmcm9udGVuZC5pbmRleCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1781556382),
('va2OkCMca1Knct1J6JKAHTrBw8igRMaq5th2x76V', NULL, '129.226.193.122', 'Mozilla/5.0 (iPhone; CPU iPhone OS 13_2_3 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/13.0.3 Mobile/15E148 Safari/604.1', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiOHB4djUxMW05VjdHTXJWNE52UVZReUxGZ2hFcEZTNlVZZTdNd1B2MiI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjI6Imh0dHBzOi8vdGhlYmVuZ2FsLmNsdWIiO3M6NToicm91dGUiO3M6MTQ6ImZyb250ZW5kLmluZGV4Ijt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1781548786),
('wavGzQnh38piGAEt2ybf1zEGsIG4bxyKarvkpx8c', NULL, '43.165.167.69', 'Mozilla/5.0 (iPhone; CPU iPhone OS 13_2_3 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/13.0.3 Mobile/15E148 Safari/604.1', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiSWdvQVVMRHhPZmV6TGdMVVF1WDFXMWNjRWkyb2xBWW9zSE15cUN3VCI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjY6Imh0dHBzOi8vd3d3LnRoZWJlbmdhbC5jbHViIjtzOjU6InJvdXRlIjtzOjE0OiJmcm9udGVuZC5pbmRleCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1781537716),
('wxiYWYtnaQIOBnhh7ywySIArexFWFmYMv1Denot9', NULL, '43.130.26.3', 'Mozilla/5.0 (iPhone; CPU iPhone OS 13_2_3 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/13.0.3 Mobile/15E148 Safari/604.1', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiamViWDllSzhIR2ZPZzloMmR1Y0RkNUpvWUVpOGNCa09LQ3F5WGNqRyI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjY6Imh0dHBzOi8vd3d3LnRoZWJlbmdhbC5jbHViIjtzOjU6InJvdXRlIjtzOjE0OiJmcm9udGVuZC5pbmRleCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1781509518),
('xbyB0uKgBa2ZRbARiWb7eeOXOpwal131P5iekIf4', NULL, '43.153.15.51', 'Mozilla/5.0 (iPhone; CPU iPhone OS 13_2_3 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/13.0.3 Mobile/15E148 Safari/604.1', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiY1RYTmpoSktsNFJsODBoUHJHdnpBUHB5Und4WFlkUFRhSkdQMTVDTyI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjI6Imh0dHBzOi8vdGhlYmVuZ2FsLmNsdWIiO3M6NToicm91dGUiO3M6MTQ6ImZyb250ZW5kLmluZGV4Ijt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1781506670),
('XsXQGrhHt07dnsKiADQ0orYjCyjaTN7WHOKpxuzN', NULL, '43.153.62.161', 'Mozilla/5.0 (iPhone; CPU iPhone OS 13_2_3 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/13.0.3 Mobile/15E148 Safari/604.1', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoieFdIOHJoUnZidEM4MlBRUWxsMGlHVUFpZ3dmc1ZwbXZkbGl2cExKaCI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjI6Imh0dHBzOi8vdGhlYmVuZ2FsLmNsdWIiO3M6NToicm91dGUiO3M6MTQ6ImZyb250ZW5kLmluZGV4Ijt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1781534923),
('xwAbfDUftCh816osCtzuFDIX6hbgdu7vT49VBHvf', NULL, '173.252.95.16', 'facebookexternalhit/1.1 (+http://www.facebook.com/externalhit_uatext.php)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiU1RvWHB1YjlZaWVyb2V4Wklmc1RqSW45MjZ5R2JwNG4xZjJoa2RmYiI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjY6Imh0dHBzOi8vd3d3LnRoZWJlbmdhbC5jbHViIjtzOjU6InJvdXRlIjtzOjE0OiJmcm9udGVuZC5pbmRleCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1781564464),
('zlaI11gsuXcHLefvn3vN7qkkmrGstBO13BlIXnoe', NULL, '129.211.229.121', 'Mozilla/5.0 (iPhone; CPU iPhone OS 13_2_3 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/13.0.3 Mobile/15E148 Safari/604.1', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiQkZzOVB2SkZIVzl4WDFYUkdRMGFEdlBUMkVyOFA3TlF0Nmg3eUk5SiI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjY6Imh0dHBzOi8vd3d3LnRoZWJlbmdhbC5jbHViIjtzOjU6InJvdXRlIjtzOjE0OiJmcm9udGVuZC5pbmRleCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1781528984);

-- --------------------------------------------------------

--
-- Table structure for table `site_settings`
--

CREATE TABLE `site_settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `site_name` varchar(255) NOT NULL DEFAULT 'BengalClub',
  `site_tagline` varchar(255) DEFAULT NULL,
  `logo` varchar(255) DEFAULT NULL,
  `favicon` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `phone_secondary` varchar(255) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `state` varchar(255) DEFAULT NULL,
  `zip_code` varchar(255) DEFAULT NULL,
  `country` varchar(255) NOT NULL DEFAULT 'Bangladesh',
  `total_members` int(11) NOT NULL DEFAULT 0,
  `application_fee` decimal(10,2) NOT NULL DEFAULT 0.00,
  `facebook_url` varchar(255) DEFAULT NULL,
  `twitter_url` varchar(255) DEFAULT NULL,
  `instagram_url` varchar(255) DEFAULT NULL,
  `linkedin_url` varchar(255) DEFAULT NULL,
  `youtube_url` varchar(255) DEFAULT NULL,
  `whatsapp_url` varchar(255) DEFAULT NULL,
  `google_maps_url` varchar(255) DEFAULT NULL,
  `footer_text` text DEFAULT NULL,
  `copyright_text` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `site_settings`
--

INSERT INTO `site_settings` (`id`, `site_name`, `site_tagline`, `logo`, `favicon`, `email`, `phone`, `phone_secondary`, `address`, `city`, `state`, `zip_code`, `country`, `total_members`, `application_fee`, `facebook_url`, `twitter_url`, `instagram_url`, `linkedin_url`, `youtube_url`, `whatsapp_url`, `google_maps_url`, `footer_text`, `copyright_text`, `created_at`, `updated_at`) VALUES
(1, 'The Bengal Club', 'Building your future', 'settings/pvFzbVIQsEn0y2r7h21OaM8kF4lS54SUBA3ulySK.png', NULL, 'info@thebengal.club', '+8801988855507', NULL, 'Mohakhali School Road, Banani,Dhaka-1212', 'Dhaka', 'Dhaka', '1212', 'Bangladesh', 1000, 1000.00, 'https://www.facebook.com/', 'https://www.facebook.com/', 'https://www.facebook.com/', 'https://www.facebook.com/', 'https://www.facebook.com/', NULL, 'https://www.facebook.com/', NULL, '2025 Bengal Club', '2026-02-14 09:10:49', '2026-03-19 07:31:17');

-- --------------------------------------------------------

--
-- Table structure for table `slideshow_banners`
--

CREATE TABLE `slideshow_banners` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `subtitle` varchar(255) DEFAULT NULL,
  `extra_text` text DEFAULT NULL,
  `enable_action_button` tinyint(1) NOT NULL DEFAULT 0,
  `button_text` varchar(255) DEFAULT NULL,
  `action_link` varchar(255) DEFAULT NULL,
  `order` int(11) NOT NULL DEFAULT 0,
  `image_path` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `slideshow_banners`
--

INSERT INTO `slideshow_banners` (`id`, `title`, `subtitle`, `extra_text`, `enable_action_button`, `button_text`, `action_link`, `order`, `image_path`, `created_at`, `updated_at`) VALUES
(1, 'The Bengal Club', NULL, 'A prestigious institution dedicated to fostering community, culture, and excellence. Join us in creating lasting memories and meaningful connections.', 1, 'Join Now', 'https://thebengal.club/membership/apply', 1, 'slideshow-banners/6nwDlgKUTf1s0V0wDfr1rvdaxgfpgKxlMoha1Yso.jpg', '2026-02-17 09:44:46', '2026-02-17 12:57:57'),
(3, 'The Bengal Club', 'A premier social and business club', NULL, 0, NULL, NULL, 2, 'slideshow-banners/ejhU9QxqGcnKr2EHQ3ZNvNZCoW8o7fDzD5xAsdXp.jpg', '2026-03-22 10:08:18', '2026-03-22 10:08:18');

-- --------------------------------------------------------

--
-- Table structure for table `tan_samitis`
--

CREATE TABLE `tan_samitis` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `monthly_amount` decimal(10,2) NOT NULL,
  `total_cycles` int(10) UNSIGNED NOT NULL,
  `enable_lottery_draw` tinyint(1) NOT NULL DEFAULT 1,
  `member_limit` int(10) UNSIGNED DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `status` enum('active','inactive') NOT NULL DEFAULT 'active',
  `created_by_admin_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tan_samitis`
--

INSERT INTO `tan_samitis` (`id`, `name`, `description`, `monthly_amount`, `total_cycles`, `enable_lottery_draw`, `member_limit`, `start_date`, `status`, `created_by_admin_id`, `created_at`, `updated_at`) VALUES
(3, 'Monthly Savings', NULL, 1000.00, 24, 0, NULL, '2026-06-01', 'active', 1, '2026-05-10 13:31:15', '2026-05-10 13:31:15'),
(2, 'Monthly Savings', NULL, 500.00, 12, 0, NULL, '2026-05-05', 'active', 1, '2026-04-15 19:56:49', '2026-04-16 19:10:46'),
(4, 'Monthly Savings', NULL, 2000.00, 24, 0, NULL, '2026-06-01', 'active', 1, '2026-05-10 13:33:17', '2026-05-10 13:33:17');

-- --------------------------------------------------------

--
-- Table structure for table `tan_samiti_draws`
--

CREATE TABLE `tan_samiti_draws` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tan_samiti_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `cycle_number` int(10) UNSIGNED NOT NULL,
  `drawn_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `drawn_by_admin_id` bigint(20) UNSIGNED DEFAULT NULL,
  `note` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tan_samiti_installments`
--

CREATE TABLE `tan_samiti_installments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tan_samiti_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `cycle_number` int(10) UNSIGNED NOT NULL,
  `due_date` date NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `status` enum('pending','completed') NOT NULL DEFAULT 'pending',
  `member_payment_method_id` bigint(20) UNSIGNED DEFAULT NULL,
  `member_txn_id` varchar(255) DEFAULT NULL,
  `member_proof_path` varchar(255) DEFAULT NULL,
  `member_submitted_at` timestamp NULL DEFAULT NULL,
  `rejected_at` timestamp NULL DEFAULT NULL,
  `rejected_by_admin_id` bigint(20) UNSIGNED DEFAULT NULL,
  `rejection_reason` varchar(255) DEFAULT NULL,
  `completed_by_admin_id` bigint(20) UNSIGNED DEFAULT NULL,
  `paid_at` timestamp NULL DEFAULT NULL,
  `note` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tan_samiti_installments`
--

INSERT INTO `tan_samiti_installments` (`id`, `tan_samiti_id`, `user_id`, `cycle_number`, `due_date`, `amount`, `status`, `member_payment_method_id`, `member_txn_id`, `member_proof_path`, `member_submitted_at`, `rejected_at`, `rejected_by_admin_id`, `rejection_reason`, `completed_by_admin_id`, `paid_at`, `note`, `created_at`, `updated_at`) VALUES
(1, 2, 17, 1, '2026-05-01', 500.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-16 02:31:09', '2026-04-16 02:31:09'),
(2, 2, 17, 2, '2026-06-01', 500.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-16 02:31:09', '2026-04-16 02:31:09'),
(3, 2, 17, 3, '2026-07-01', 500.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-16 02:31:09', '2026-04-16 02:31:09'),
(4, 2, 17, 4, '2026-08-01', 500.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-16 02:31:09', '2026-04-16 02:31:09'),
(5, 2, 17, 5, '2026-09-01', 500.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-16 02:31:09', '2026-04-16 02:31:09'),
(6, 2, 17, 6, '2026-10-01', 500.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-16 02:31:09', '2026-04-16 02:31:09'),
(7, 2, 17, 7, '2026-11-01', 500.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-16 02:31:09', '2026-04-16 02:31:09'),
(8, 2, 17, 8, '2026-12-01', 500.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-16 02:31:09', '2026-04-16 02:31:09'),
(9, 2, 17, 9, '2027-01-01', 500.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-16 02:31:09', '2026-04-16 02:31:09'),
(10, 2, 17, 10, '2027-02-01', 500.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-16 02:31:09', '2026-04-16 02:31:09'),
(11, 2, 17, 11, '2027-03-01', 500.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-16 02:31:09', '2026-04-16 02:31:09'),
(12, 2, 17, 12, '2027-04-01', 500.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-16 02:31:09', '2026-04-16 02:31:09'),
(13, 2, 17, 1, '2026-05-05', 500.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-16 19:10:35', '2026-04-16 19:10:35'),
(14, 2, 17, 2, '2026-06-05', 500.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-16 19:10:35', '2026-04-16 19:10:35'),
(15, 2, 17, 3, '2026-07-05', 500.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-16 19:10:35', '2026-04-16 19:10:35'),
(16, 2, 17, 4, '2026-08-05', 500.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-16 19:10:35', '2026-04-16 19:10:35'),
(17, 2, 17, 5, '2026-09-05', 500.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-16 19:10:35', '2026-04-16 19:10:35'),
(18, 2, 17, 6, '2026-10-05', 500.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-16 19:10:35', '2026-04-16 19:10:35'),
(19, 2, 17, 7, '2026-11-05', 500.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-16 19:10:35', '2026-04-16 19:10:35'),
(20, 2, 17, 8, '2026-12-05', 500.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-16 19:10:35', '2026-04-16 19:10:35'),
(21, 2, 17, 9, '2027-01-05', 500.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-16 19:10:35', '2026-04-16 19:10:35'),
(22, 2, 17, 10, '2027-02-05', 500.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-16 19:10:35', '2026-04-16 19:10:35'),
(23, 2, 17, 11, '2027-03-05', 500.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-16 19:10:35', '2026-04-16 19:10:35'),
(24, 2, 17, 12, '2027-04-05', 500.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-16 19:10:35', '2026-04-16 19:10:35'),
(25, 2, 17, 1, '2026-05-05', 500.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-16 19:10:46', '2026-04-16 19:10:46'),
(26, 2, 17, 2, '2026-06-05', 500.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-16 19:10:46', '2026-04-16 19:10:46'),
(27, 2, 17, 3, '2026-07-05', 500.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-16 19:10:46', '2026-04-16 19:10:46'),
(28, 2, 17, 4, '2026-08-05', 500.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-16 19:10:46', '2026-04-16 19:10:46'),
(29, 2, 17, 5, '2026-09-05', 500.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-16 19:10:46', '2026-04-16 19:10:46'),
(30, 2, 17, 6, '2026-10-05', 500.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-16 19:10:46', '2026-04-16 19:10:46'),
(31, 2, 17, 7, '2026-11-05', 500.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-16 19:10:46', '2026-04-16 19:10:46'),
(32, 2, 17, 8, '2026-12-05', 500.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-16 19:10:46', '2026-04-16 19:10:46'),
(33, 2, 17, 9, '2027-01-05', 500.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-16 19:10:46', '2026-04-16 19:10:46'),
(34, 2, 17, 10, '2027-02-05', 500.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-16 19:10:46', '2026-04-16 19:10:46'),
(35, 2, 17, 11, '2027-03-05', 500.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-16 19:10:46', '2026-04-16 19:10:46'),
(36, 2, 17, 12, '2027-04-05', 500.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-16 19:10:46', '2026-04-16 19:10:46'),
(37, 2, 28, 1, '2026-05-05', 500.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-16 22:58:14', '2026-04-16 22:58:14'),
(38, 2, 28, 2, '2026-06-05', 500.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-16 22:58:14', '2026-04-16 22:58:14'),
(39, 2, 28, 3, '2026-07-05', 500.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-16 22:58:14', '2026-04-16 22:58:14'),
(40, 2, 28, 4, '2026-08-05', 500.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-16 22:58:14', '2026-04-16 22:58:14'),
(41, 2, 28, 5, '2026-09-05', 500.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-16 22:58:14', '2026-04-16 22:58:14'),
(42, 2, 28, 6, '2026-10-05', 500.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-16 22:58:14', '2026-04-16 22:58:14'),
(43, 2, 28, 7, '2026-11-05', 500.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-16 22:58:14', '2026-04-16 22:58:14'),
(44, 2, 28, 8, '2026-12-05', 500.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-16 22:58:14', '2026-04-16 22:58:14'),
(45, 2, 28, 9, '2027-01-05', 500.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-16 22:58:14', '2026-04-16 22:58:14'),
(46, 2, 28, 10, '2027-02-05', 500.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-16 22:58:14', '2026-04-16 22:58:14'),
(47, 2, 28, 11, '2027-03-05', 500.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-16 22:58:14', '2026-04-16 22:58:14'),
(48, 2, 28, 12, '2027-04-05', 500.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-16 22:58:14', '2026-04-16 22:58:14'),
(49, 1, 36, 1, '2026-05-05', 500.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-17 01:57:34', '2026-04-17 01:57:34'),
(50, 1, 36, 2, '2026-06-05', 500.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-17 01:57:34', '2026-04-17 01:57:34'),
(51, 1, 36, 3, '2026-07-05', 500.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-17 01:57:34', '2026-04-17 01:57:34'),
(52, 1, 36, 4, '2026-08-05', 500.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-17 01:57:34', '2026-04-17 01:57:34'),
(53, 1, 36, 5, '2026-09-05', 500.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-17 01:57:34', '2026-04-17 01:57:34'),
(54, 1, 36, 6, '2026-10-05', 500.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-17 01:57:34', '2026-04-17 01:57:34'),
(55, 1, 36, 7, '2026-11-05', 500.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-17 01:57:34', '2026-04-17 01:57:34'),
(56, 1, 36, 8, '2026-12-05', 500.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-17 01:57:34', '2026-04-17 01:57:34'),
(57, 1, 36, 9, '2027-01-05', 500.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-17 01:57:34', '2026-04-17 01:57:34'),
(58, 1, 36, 10, '2027-02-05', 500.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-17 01:57:34', '2026-04-17 01:57:34'),
(59, 2, 36, 1, '2026-05-05', 500.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-17 01:58:10', '2026-04-17 01:58:10'),
(60, 2, 36, 2, '2026-06-05', 500.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-17 01:58:10', '2026-04-17 01:58:10'),
(61, 2, 36, 3, '2026-07-05', 500.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-17 01:58:10', '2026-04-17 01:58:10'),
(62, 2, 36, 4, '2026-08-05', 500.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-17 01:58:10', '2026-04-17 01:58:10'),
(63, 2, 36, 5, '2026-09-05', 500.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-17 01:58:10', '2026-04-17 01:58:10'),
(64, 2, 36, 6, '2026-10-05', 500.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-17 01:58:10', '2026-04-17 01:58:10'),
(65, 2, 36, 7, '2026-11-05', 500.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-17 01:58:10', '2026-04-17 01:58:10'),
(66, 2, 36, 8, '2026-12-05', 500.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-17 01:58:10', '2026-04-17 01:58:10'),
(67, 2, 36, 9, '2027-01-05', 500.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-17 01:58:10', '2026-04-17 01:58:10'),
(68, 2, 36, 10, '2027-02-05', 500.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-17 01:58:10', '2026-04-17 01:58:10'),
(69, 2, 36, 11, '2027-03-05', 500.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-17 01:58:10', '2026-04-17 01:58:10'),
(70, 2, 36, 12, '2027-04-05', 500.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-17 01:58:10', '2026-04-17 01:58:10'),
(71, 2, 11, 1, '2026-05-05', 500.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-17 15:38:49', '2026-04-17 15:38:49'),
(72, 2, 11, 2, '2026-06-05', 500.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-17 15:38:49', '2026-04-17 15:38:49'),
(73, 2, 11, 3, '2026-07-05', 500.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-17 15:38:49', '2026-04-17 15:38:49'),
(74, 2, 11, 4, '2026-08-05', 500.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-17 15:38:49', '2026-04-17 15:38:49'),
(75, 2, 11, 5, '2026-09-05', 500.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-17 15:38:49', '2026-04-17 15:38:49'),
(76, 2, 11, 6, '2026-10-05', 500.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-17 15:38:49', '2026-04-17 15:38:49'),
(77, 2, 11, 7, '2026-11-05', 500.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-17 15:38:49', '2026-04-17 15:38:49'),
(78, 2, 11, 8, '2026-12-05', 500.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-17 15:38:49', '2026-04-17 15:38:49'),
(79, 2, 11, 9, '2027-01-05', 500.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-17 15:38:49', '2026-04-17 15:38:49'),
(80, 2, 11, 10, '2027-02-05', 500.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-17 15:38:49', '2026-04-17 15:38:49'),
(81, 2, 11, 11, '2027-03-05', 500.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-17 15:38:49', '2026-04-17 15:38:49'),
(82, 2, 11, 12, '2027-04-05', 500.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-17 15:38:49', '2026-04-17 15:38:49'),
(83, 1, 11, 1, '2026-05-05', 500.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-17 15:39:11', '2026-04-17 15:39:11'),
(84, 1, 11, 2, '2026-06-05', 500.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-17 15:39:11', '2026-04-17 15:39:11'),
(85, 1, 11, 3, '2026-07-05', 500.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-17 15:39:11', '2026-04-17 15:39:11'),
(86, 1, 11, 4, '2026-08-05', 500.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-17 15:39:11', '2026-04-17 15:39:11'),
(87, 1, 11, 5, '2026-09-05', 500.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-17 15:39:11', '2026-04-17 15:39:11'),
(88, 1, 11, 6, '2026-10-05', 500.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-17 15:39:11', '2026-04-17 15:39:11'),
(89, 1, 11, 7, '2026-11-05', 500.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-17 15:39:11', '2026-04-17 15:39:11'),
(90, 1, 11, 8, '2026-12-05', 500.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-17 15:39:11', '2026-04-17 15:39:11'),
(91, 1, 11, 9, '2027-01-05', 500.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-17 15:39:11', '2026-04-17 15:39:11'),
(92, 1, 11, 10, '2027-02-05', 500.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-17 15:39:11', '2026-04-17 15:39:11'),
(93, 1, 93, 1, '2026-05-05', 500.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-26 23:50:55', '2026-04-26 23:50:55'),
(94, 1, 93, 2, '2026-06-05', 500.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-26 23:50:55', '2026-04-26 23:50:55'),
(95, 1, 93, 3, '2026-07-05', 500.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-26 23:50:55', '2026-04-26 23:50:55'),
(96, 1, 93, 4, '2026-08-05', 500.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-26 23:50:55', '2026-04-26 23:50:55'),
(97, 1, 93, 5, '2026-09-05', 500.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-26 23:50:55', '2026-04-26 23:50:55'),
(98, 1, 93, 6, '2026-10-05', 500.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-26 23:50:55', '2026-04-26 23:50:55'),
(99, 1, 93, 7, '2026-11-05', 500.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-26 23:50:55', '2026-04-26 23:50:55'),
(100, 1, 93, 8, '2026-12-05', 500.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-26 23:50:55', '2026-04-26 23:50:55'),
(101, 1, 93, 9, '2027-01-05', 500.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-26 23:50:55', '2026-04-26 23:50:55'),
(102, 1, 93, 10, '2027-02-05', 500.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-26 23:50:55', '2026-04-26 23:50:55'),
(103, 2, 93, 1, '2026-05-05', 500.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-26 23:51:23', '2026-04-26 23:51:23'),
(104, 2, 93, 2, '2026-06-05', 500.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-26 23:51:23', '2026-04-26 23:51:23'),
(105, 2, 93, 3, '2026-07-05', 500.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-26 23:51:23', '2026-04-26 23:51:23'),
(106, 2, 93, 4, '2026-08-05', 500.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-26 23:51:23', '2026-04-26 23:51:23'),
(107, 2, 93, 5, '2026-09-05', 500.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-26 23:51:23', '2026-04-26 23:51:23'),
(108, 2, 93, 6, '2026-10-05', 500.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-26 23:51:23', '2026-04-26 23:51:23'),
(109, 2, 93, 7, '2026-11-05', 500.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-26 23:51:23', '2026-04-26 23:51:23'),
(110, 2, 93, 8, '2026-12-05', 500.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-26 23:51:23', '2026-04-26 23:51:23'),
(111, 2, 93, 9, '2027-01-05', 500.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-26 23:51:23', '2026-04-26 23:51:23'),
(112, 2, 93, 10, '2027-02-05', 500.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-26 23:51:23', '2026-04-26 23:51:23'),
(113, 2, 93, 11, '2027-03-05', 500.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-26 23:51:23', '2026-04-26 23:51:23'),
(114, 2, 93, 12, '2027-04-05', 500.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-04-26 23:51:23', '2026-04-26 23:51:23'),
(115, 3, 7, 1, '2026-06-01', 1000.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-05-10 17:06:21', '2026-05-10 17:06:21'),
(116, 3, 7, 2, '2026-07-01', 1000.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-05-10 17:06:21', '2026-05-10 17:06:21'),
(117, 3, 7, 3, '2026-08-01', 1000.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-05-10 17:06:21', '2026-05-10 17:06:21'),
(118, 3, 7, 4, '2026-09-01', 1000.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-05-10 17:06:21', '2026-05-10 17:06:21'),
(119, 3, 7, 5, '2026-10-01', 1000.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-05-10 17:06:21', '2026-05-10 17:06:21'),
(120, 3, 7, 6, '2026-11-01', 1000.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-05-10 17:06:21', '2026-05-10 17:06:21'),
(121, 3, 7, 7, '2026-12-01', 1000.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-05-10 17:06:21', '2026-05-10 17:06:21'),
(122, 3, 7, 8, '2027-01-01', 1000.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-05-10 17:06:21', '2026-05-10 17:06:21'),
(123, 3, 7, 9, '2027-02-01', 1000.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-05-10 17:06:21', '2026-05-10 17:06:21'),
(124, 3, 7, 10, '2027-03-01', 1000.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-05-10 17:06:21', '2026-05-10 17:06:21'),
(125, 3, 7, 11, '2027-04-01', 1000.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-05-10 17:06:21', '2026-05-10 17:06:21'),
(126, 3, 7, 12, '2027-05-01', 1000.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-05-10 17:06:21', '2026-05-10 17:06:21'),
(127, 3, 7, 13, '2027-06-01', 1000.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-05-10 17:06:21', '2026-05-10 17:06:21'),
(128, 3, 7, 14, '2027-07-01', 1000.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-05-10 17:06:21', '2026-05-10 17:06:21'),
(129, 3, 7, 15, '2027-08-01', 1000.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-05-10 17:06:21', '2026-05-10 17:06:21'),
(130, 3, 7, 16, '2027-09-01', 1000.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-05-10 17:06:21', '2026-05-10 17:06:21'),
(131, 3, 7, 17, '2027-10-01', 1000.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-05-10 17:06:21', '2026-05-10 17:06:21'),
(132, 3, 7, 18, '2027-11-01', 1000.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-05-10 17:06:21', '2026-05-10 17:06:21'),
(133, 3, 7, 19, '2027-12-01', 1000.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-05-10 17:06:21', '2026-05-10 17:06:21'),
(134, 3, 7, 20, '2028-01-01', 1000.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-05-10 17:06:21', '2026-05-10 17:06:21'),
(135, 3, 7, 21, '2028-02-01', 1000.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-05-10 17:06:21', '2026-05-10 17:06:21'),
(136, 3, 7, 22, '2028-03-01', 1000.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-05-10 17:06:21', '2026-05-10 17:06:21'),
(137, 3, 7, 23, '2028-04-01', 1000.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-05-10 17:06:21', '2026-05-10 17:06:21'),
(138, 3, 7, 24, '2028-05-01', 1000.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-05-10 17:06:21', '2026-05-10 17:06:21'),
(139, 4, 101, 1, '2026-06-01', 2000.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-05-11 21:07:56', '2026-05-11 21:07:56'),
(140, 4, 101, 2, '2026-07-01', 2000.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-05-11 21:07:56', '2026-05-11 21:07:56'),
(141, 4, 101, 3, '2026-08-01', 2000.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-05-11 21:07:56', '2026-05-11 21:07:56'),
(142, 4, 101, 4, '2026-09-01', 2000.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-05-11 21:07:56', '2026-05-11 21:07:56'),
(143, 4, 101, 5, '2026-10-01', 2000.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-05-11 21:07:56', '2026-05-11 21:07:56'),
(144, 4, 101, 6, '2026-11-01', 2000.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-05-11 21:07:56', '2026-05-11 21:07:56'),
(145, 4, 101, 7, '2026-12-01', 2000.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-05-11 21:07:56', '2026-05-11 21:07:56'),
(146, 4, 101, 8, '2027-01-01', 2000.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-05-11 21:07:56', '2026-05-11 21:07:56'),
(147, 4, 101, 9, '2027-02-01', 2000.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-05-11 21:07:56', '2026-05-11 21:07:56'),
(148, 4, 101, 10, '2027-03-01', 2000.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-05-11 21:07:56', '2026-05-11 21:07:56'),
(149, 4, 101, 11, '2027-04-01', 2000.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-05-11 21:07:56', '2026-05-11 21:07:56'),
(150, 4, 101, 12, '2027-05-01', 2000.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-05-11 21:07:56', '2026-05-11 21:07:56'),
(151, 4, 101, 13, '2027-06-01', 2000.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-05-11 21:07:56', '2026-05-11 21:07:56'),
(152, 4, 101, 14, '2027-07-01', 2000.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-05-11 21:07:56', '2026-05-11 21:07:56'),
(153, 4, 101, 15, '2027-08-01', 2000.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-05-11 21:07:56', '2026-05-11 21:07:56'),
(154, 4, 101, 16, '2027-09-01', 2000.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-05-11 21:07:56', '2026-05-11 21:07:56'),
(155, 4, 101, 17, '2027-10-01', 2000.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-05-11 21:07:56', '2026-05-11 21:07:56'),
(156, 4, 101, 18, '2027-11-01', 2000.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-05-11 21:07:56', '2026-05-11 21:07:56'),
(157, 4, 101, 19, '2027-12-01', 2000.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-05-11 21:07:56', '2026-05-11 21:07:56'),
(158, 4, 101, 20, '2028-01-01', 2000.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-05-11 21:07:56', '2026-05-11 21:07:56'),
(159, 4, 101, 21, '2028-02-01', 2000.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-05-11 21:07:56', '2026-05-11 21:07:56'),
(160, 4, 101, 22, '2028-03-01', 2000.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-05-11 21:07:56', '2026-05-11 21:07:56'),
(161, 4, 101, 23, '2028-04-01', 2000.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-05-11 21:07:56', '2026-05-11 21:07:56'),
(162, 4, 101, 24, '2028-05-01', 2000.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-05-11 21:07:56', '2026-05-11 21:07:56'),
(163, 4, 45, 1, '2026-06-01', 2000.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-05-15 15:42:36', '2026-05-15 15:42:36'),
(164, 4, 45, 2, '2026-07-01', 2000.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-05-15 15:42:36', '2026-05-15 15:42:36'),
(165, 4, 45, 3, '2026-08-01', 2000.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-05-15 15:42:36', '2026-05-15 15:42:36'),
(166, 4, 45, 4, '2026-09-01', 2000.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-05-15 15:42:36', '2026-05-15 15:42:36'),
(167, 4, 45, 5, '2026-10-01', 2000.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-05-15 15:42:36', '2026-05-15 15:42:36'),
(168, 4, 45, 6, '2026-11-01', 2000.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-05-15 15:42:36', '2026-05-15 15:42:36'),
(169, 4, 45, 7, '2026-12-01', 2000.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-05-15 15:42:36', '2026-05-15 15:42:36'),
(170, 4, 45, 8, '2027-01-01', 2000.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-05-15 15:42:36', '2026-05-15 15:42:36'),
(171, 4, 45, 9, '2027-02-01', 2000.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-05-15 15:42:36', '2026-05-15 15:42:36'),
(172, 4, 45, 10, '2027-03-01', 2000.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-05-15 15:42:36', '2026-05-15 15:42:36'),
(173, 4, 45, 11, '2027-04-01', 2000.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-05-15 15:42:36', '2026-05-15 15:42:36'),
(174, 4, 45, 12, '2027-05-01', 2000.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-05-15 15:42:36', '2026-05-15 15:42:36'),
(175, 4, 45, 13, '2027-06-01', 2000.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-05-15 15:42:36', '2026-05-15 15:42:36'),
(176, 4, 45, 14, '2027-07-01', 2000.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-05-15 15:42:36', '2026-05-15 15:42:36'),
(177, 4, 45, 15, '2027-08-01', 2000.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-05-15 15:42:36', '2026-05-15 15:42:36'),
(178, 4, 45, 16, '2027-09-01', 2000.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-05-15 15:42:36', '2026-05-15 15:42:36'),
(179, 4, 45, 17, '2027-10-01', 2000.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-05-15 15:42:36', '2026-05-15 15:42:36'),
(180, 4, 45, 18, '2027-11-01', 2000.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-05-15 15:42:36', '2026-05-15 15:42:36'),
(181, 4, 45, 19, '2027-12-01', 2000.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-05-15 15:42:36', '2026-05-15 15:42:36'),
(182, 4, 45, 20, '2028-01-01', 2000.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-05-15 15:42:36', '2026-05-15 15:42:36'),
(183, 4, 45, 21, '2028-02-01', 2000.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-05-15 15:42:36', '2026-05-15 15:42:36'),
(184, 4, 45, 22, '2028-03-01', 2000.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-05-15 15:42:36', '2026-05-15 15:42:36'),
(185, 4, 45, 23, '2028-04-01', 2000.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-05-15 15:42:36', '2026-05-15 15:42:36'),
(186, 4, 45, 24, '2028-05-01', 2000.00, 'pending', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-05-15 15:42:36', '2026-05-15 15:42:36');

-- --------------------------------------------------------

--
-- Table structure for table `tan_samiti_members`
--

CREATE TABLE `tan_samiti_members` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tan_samiti_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `status` enum('active','inactive') NOT NULL DEFAULT 'active',
  `joined_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tan_samiti_members`
--

INSERT INTO `tan_samiti_members` (`id`, `tan_samiti_id`, `user_id`, `status`, `joined_at`, `created_at`, `updated_at`) VALUES
(1, 2, 17, 'active', '2026-04-16 02:31:09', '2026-04-16 02:31:09', '2026-04-16 02:31:09'),
(2, 2, 28, 'active', '2026-04-16 22:58:14', '2026-04-16 22:58:14', '2026-04-16 22:58:14'),
(3, 1, 36, 'active', '2026-04-17 01:57:34', '2026-04-17 01:57:34', '2026-04-17 01:57:34'),
(4, 2, 36, 'active', '2026-04-17 01:58:10', '2026-04-17 01:58:10', '2026-04-17 01:58:10'),
(5, 2, 11, 'active', '2026-04-17 15:38:49', '2026-04-17 15:38:49', '2026-04-17 15:38:49'),
(6, 1, 11, 'active', '2026-04-17 15:39:11', '2026-04-17 15:39:11', '2026-04-17 15:39:11'),
(7, 1, 93, 'active', '2026-04-26 23:50:55', '2026-04-26 23:50:55', '2026-04-26 23:50:55'),
(8, 2, 93, 'active', '2026-04-26 23:51:23', '2026-04-26 23:51:23', '2026-04-26 23:51:23'),
(9, 3, 7, 'active', '2026-05-10 17:06:21', '2026-05-10 17:06:21', '2026-05-10 17:06:21'),
(10, 4, 101, 'active', '2026-05-11 21:07:56', '2026-05-11 21:07:56', '2026-05-11 21:07:56'),
(11, 4, 45, 'active', '2026-05-15 15:42:36', '2026-05-15 15:42:36', '2026-05-15 15:42:36');

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `reason` varchar(255) NOT NULL,
  `payment_date` date NOT NULL,
  `payment_method_id` bigint(20) UNSIGNED DEFAULT NULL,
  `membership_application_id` bigint(20) UNSIGNED DEFAULT NULL,
  `recorded_by_admin_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `suspended_at` timestamp NULL DEFAULT NULL,
  `suspension_reason` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `suspended_by_admin_id` bigint(20) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `suspended_at`, `suspension_reason`, `created_at`, `updated_at`, `suspended_by_admin_id`) VALUES
(7, 'Shahrier Shehab', 'shahrier004@gmail.com', NULL, '$2y$12$nsu4nN1DI30ZuypPvSpljuI8kx/oT7mmw8NRuiOvpMZnXUkFUyfga', NULL, NULL, NULL, '2026-02-18 05:46:56', '2026-02-18 05:52:33', NULL),
(11, 'Sifat Mahmud', 'sifatmahmud333@gmail.com', NULL, '$2y$12$Y4/FdgOlwVW4ojHfRmGIxOEKWEqKGngQc5CUZV0Oz812mCGn3F/pK', NULL, NULL, NULL, '2026-04-01 19:02:21', '2026-04-02 10:45:29', NULL),
(12, 'Md. Ruhul Amin', 'mruhul.mr@gmail.com', NULL, '$2y$12$haTyT0NwZ/mlPWn6dly9h.m4MynVv72gu3b7/N6MaKZfdfQXRJFZC', NULL, NULL, NULL, '2026-04-02 01:33:31', '2026-04-02 01:33:31', NULL),
(13, 'Shajedul Haque Sajib', 'sajibhaque71@gmail.com', NULL, '$2y$12$fr7swrEAIYQ7c5ZyoYMZ6O8apsZwE4M1Euc.sDRguHTbh43.H9JMa', NULL, NULL, NULL, '2026-04-02 01:39:25', '2026-04-03 22:39:26', NULL),
(14, 'Md. Rezaur Rahman', 'rezaur49@gmail.com', NULL, '$2y$12$Urc7kqW/zNrIT4B9hwxN3eP3N/68LBh.Aa/WNeqI6Rj521w1ezOdu', NULL, NULL, NULL, '2026-04-02 01:45:42', '2026-04-02 15:43:38', NULL),
(16, 'Shahadat Hossain', 'rudro_ewu@yahoo.com', NULL, '$2y$12$3IhEzldNtQB7M1qjEDcVAeS5PjaaV6vfmD7V4H8j90fcBvVWDvaki', NULL, NULL, NULL, '2026-04-02 09:36:43', '2026-04-02 09:36:43', NULL),
(17, 'MD HASAN', 'md.hasan.16.12.1998@gmail.com', NULL, '$2y$12$kGwVF8r/WaQPRLzanBSxqudtGcTaIOxfUp9j1fBktIwktmd5HRaoK', 'ye0DwQrfphPL5Y4moCC0RS6PEpabbMzRTGiAaOb7iwi1W4UM8WVEWEmEfkAI', NULL, NULL, '2026-04-02 12:44:33', '2026-06-07 21:32:52', NULL),
(19, 'MD SOHEL RANA', 'sohelmiya3280@gmail.com', NULL, '$2y$12$WtHLd7/0U0LrMqDojdj.zOn2xcms6rCY7oG5dBZCPC4IXDDmck27i', 'LBxKbcUeuEiurUwpDyM5xO8blVEDtP8xm7IQhC5wa12BgE1Pakf25ssVzTOY', NULL, NULL, '2026-04-02 13:21:23', '2026-04-03 18:38:18', NULL),
(20, 'Mohammad Kamrul Alam', 'riyadornob@gmail.com', NULL, '$2y$12$P67Or1xn2IL4xXttApdvL.bQfvQUkIgs8KWWbbZW.RePwEKVZr6x2', NULL, NULL, NULL, '2026-04-02 14:37:54', '2026-04-02 16:52:04', NULL),
(21, 'Tushar Khan', 'tawfiqkhantushar@gmail.com', NULL, '$2y$12$4ss4LqqAwDdg0DCPhhktLOOrvWP9sFvA832SZ94QbD4ZmBGuTbLZC', NULL, NULL, NULL, '2026-04-02 15:39:09', '2026-04-12 13:54:47', NULL),
(22, 'Mehedi Hasan Raju', 'mehedihasanmahi@gmail.com', NULL, '$2y$12$NruXLPHIi7yG9TUPM77YBOttIJwqAbcajGpPa4T3Zh6/Ezjx01vFe', NULL, NULL, NULL, '2026-04-02 19:59:40', '2026-04-02 20:21:19', NULL),
(23, 'Md Mahede Hasan Uzzal', 'uzzalbadboy99@gmail.com', NULL, '$2y$12$YyKouU7tDs19Kg1OTXNy5eQ3sFPpt8yxsbldRQCpp3AlwfyGu5ZMm', NULL, NULL, NULL, '2026-04-02 21:02:04', '2026-04-02 21:07:11', NULL),
(24, 'Md. Rubel', 'hellomdrubeel@gmail.com', NULL, '$2y$12$xLi5JiJobqPPSJJXX66UAe9BRrtOCpsXy6wox5mGMir9VKxMbVwxu', NULL, NULL, NULL, '2026-04-02 21:18:42', '2026-04-02 22:17:58', NULL),
(25, 'MD.ROKIBUR ISLAM', 'rokibursakib@gmail.com', NULL, '$2y$12$F.Sxk6TvzQaZjILA4YnRruYH70Dild3k/8EZPXWlI3a0AtanmsT0q', NULL, NULL, NULL, '2026-04-02 21:29:57', '2026-04-04 17:04:20', NULL),
(26, 'MD.Salauddin Sunny', 'mdsunny0045@gmail.com', NULL, '$2y$12$dOzAkIM4Uew9/wLKSiBmHuaPIGq6nd0sRb4wuLLhJaKwA9G1bnhRu', NULL, NULL, NULL, '2026-04-03 02:13:06', '2026-04-03 02:13:06', NULL),
(27, 'SHEIKH RIAD KARIM', 'sheikhriad9@gmail.com', NULL, '$2y$12$KmHy.W.Zp.K13QmBdvND7eYm.GiS.3yaWXQhuwF.AWJXPXTxElvzi', 'TMI1rwn1XC7WQfLwk8mJZFh2lN36EaWuM1mZwKgnrCkUklZ7MrZS3pI3ES3A', NULL, NULL, '2026-04-03 02:30:07', '2026-04-03 02:30:07', NULL),
(28, 'MD RAFIQUL ISLAM', 'im.rafiqulislam007@gmail.com', NULL, '$2y$12$yZsNxuAOKOEYOWPjsmLXVeWt0UKYZoCV1moFHkH34zk09PpfmGNp2', NULL, NULL, NULL, '2026-04-03 11:40:40', '2026-04-03 12:15:03', NULL),
(29, 'A.B.M. SHAMIM SUVO', 'shamimshuvo600470@gmail.com', NULL, '$2y$12$4JDhTB6cuMzcyyOvEzl6.OdpTxJiBkx.elGD9.pwwwBdvzV4YHrVS', 'J5jCVgsEgrYHorMyqBbBCFOLtcKRdJnBDJlsHGWAfPjKptMGe0rU0QbsjckJ', NULL, NULL, '2026-04-03 14:09:20', '2026-04-03 18:49:36', NULL),
(31, 'K M ARIF', 'arif27mar@gmail.com', NULL, '$2y$12$Wbav42mVLO627a13IbhPDuRu2MGmlmFEoYC/LtKjsJL4fvyZ3nKwG', NULL, NULL, NULL, '2026-04-03 16:31:46', '2026-04-03 19:02:25', NULL),
(32, 'Raton', 'raijon087@gmail.com', NULL, '$2y$12$1GR9XnEFfqVaS9hyeiJBK.TwQTcpwDPpuICIMUlOlfWTi622Y6yZy', 'OwBdSZMreMb8t8vscBaksV66VING2PdFQgh0OgqF6K0lFYwJoJV0rDE6NDhn', NULL, NULL, '2026-04-04 00:17:25', '2026-04-06 13:42:53', NULL),
(33, 'Md. Mehedi Hassan', 'mehedi93847@gmail.com', NULL, '$2y$12$DLDcJIza/7r8.B7TrinCbeNTQS3CTwBMkBfygXphE7XEvsOFqXIU.', NULL, NULL, NULL, '2026-04-04 07:48:10', '2026-04-04 19:41:27', NULL),
(34, 'MOHAMMAD ABDUL KADER', 'mohammadabdulkader75@gmail.com', NULL, '$2y$12$PPjRkebBI5dYjVDlQ3M3E.C02IUDtidI7F9bc.vPMvotDdHjEeF0y', NULL, NULL, NULL, '2026-04-04 07:53:13', '2026-04-04 10:52:47', NULL),
(35, 'JAMIL REDWAN (Shovon)', 'jamil_redwan@outlook.com', NULL, '$2y$12$dh0XojJSuW0UkbUybheYc.Z5S/GlEPkabSrIh1immRHpurWMnvDrS', 'MiFID62nXxA9qM7vx8jyrrozEI9dFtRjg5W93E8boHxd1XMYSKENgYdsGz5u', NULL, NULL, '2026-04-04 11:17:36', '2026-04-04 11:17:36', NULL),
(36, 'FARUK AHMED', 'md.farukahamed087@gmail.com', NULL, '$2y$12$rjYlXI26BMTz0IWU2HMOveqHtgztClMGVLVrRMhuk/SoC8ILixL7a', NULL, NULL, NULL, '2026-04-04 13:51:21', '2026-04-04 19:11:27', NULL),
(37, 'MD. ABDUL KUDDUS', 'abdulk.dhaka@gmail.com', NULL, '$2y$12$AeWGSiGBK6n.bmZFniFY3uu8st6cB2FrSLrDRlA4imvDOc3sO0tz.', 'iVvChdH77WKC1dnprM8kJ0bBQCjhN6hsrGLOUKKmQ10iFNF4xan5Cb8GoV16', NULL, NULL, '2026-04-04 14:51:40', '2026-05-11 21:42:40', NULL),
(39, 'Shahidul islam (Shopon)', 'Shoponkbr@gmail.com', NULL, '$2y$12$srR9HiVSK8yGtCnp8hXqxu05BRxc2T2pQjiOgxPVgTYPz99fDtLRy', '4LmO64weiI9qpRV1MKBoAz9mioONxdI7mFcohCAuk13iv41WcuYwsC3fb34Y', NULL, NULL, '2026-04-04 15:38:54', '2026-04-04 16:11:57', NULL),
(41, 'Farhan Uddin Chowdhury', 'farhan_akib@yahoo.com', NULL, '$2y$12$6I3Oznv11x/3SRzC28mgH.SHOyDLQQ93oTfuxPzWWoDve8MbADo8i', NULL, NULL, NULL, '2026-04-04 15:47:07', '2026-04-04 16:56:26', NULL),
(42, 'MD Sunny alam', 'sunnyeva666@gmail.com', NULL, '$2y$12$foBKGx7ckN93h7iNwglhleBLyEL9wYBk1hUEpN1ckM32KBw6DV7H2', 'T5euzbS3kqV91tlk4bndSh7MT4rTzspccHhhorGCJzgWmMeRofPK0ZCsgrbf', NULL, NULL, '2026-04-04 17:20:59', '2026-04-04 17:20:59', NULL),
(43, 'Noor Mohammad', 'mmahin07@gmail.com', NULL, '$2y$12$qwX0r08HWnx0dvxy8Er35udBM3ZBu3K2j0Keab87IpLkMKvIGmmk2', NULL, NULL, NULL, '2026-04-04 21:17:37', '2026-04-04 21:21:08', NULL),
(44, 'Mohammad Somesuddaha', 'sdsajib7@gmail.com', NULL, '$2y$12$869h6uhb3mMsIdPymEkbDO0Igf0uAqTEG7rZ5ZmwjnEAZQSvdCJRa', NULL, NULL, NULL, '2026-04-04 22:10:43', '2026-04-04 22:14:12', NULL),
(45, 'Lutfur Rahman Opu', 'opu3300@gmail.com', NULL, '$2y$12$Va0u3CoMGe3I/F6JQVIpG.s1MWsM5v22vCsJ/8RJRVmfSrXkAC/3K', 'WAJuZrFGtspT1mcn2D5PNnCM15p4EPgsn8FsdtishmZBPuTdgeT7YnGBtzw9', NULL, NULL, '2026-04-05 15:17:41', '2026-04-05 15:17:41', NULL),
(47, 'Asif Hazari', 'asifhazari1990@gmail.com', NULL, '$2y$12$0k75VoBhU8ZvUoDAwGHhMeIqJ8hGI1nPIMFkt1cZ55LN1Co85X1Ry', NULL, NULL, NULL, '2026-04-06 17:00:23', '2026-04-07 18:43:22', NULL),
(48, 'MD.Mamun Khan', 'imamun660@gmail.com', NULL, '$2y$12$lpBksyylqKDgaf8WevH4FeC4W47gUVO6qwVksgtkVYzDQEx96fpn.', NULL, NULL, NULL, '2026-04-06 17:30:55', '2026-04-06 17:30:55', NULL),
(50, 'Limon Ahammad Bhuiyan', 'limonahammad@gmail.com', NULL, '$2y$12$PCuSWiLOEVFGDcirB4.qBOpym.nFuZFCJXwc9Y2pkM6AfA9TI2gE.', NULL, NULL, NULL, '2026-04-06 20:00:27', '2026-04-06 20:15:35', NULL),
(52, 'Md. Rokon', 'rokon00070@gmail.com', NULL, '$2y$12$Q2GOE5fAfNJLhxOcwpKT/erXTZAhr8mEZSEKM/DjD.qEX0RUR3Yme', NULL, NULL, NULL, '2026-04-07 23:35:21', '2026-04-08 11:09:01', NULL),
(53, 'Md Arafat Hossain', 'kochi932@gmail.com', NULL, '$2y$12$J1YOMwTSx88.MbpJE.bq3OwtPJQpMMhmqW9Rz4mAKnEu4rQCNb6Mm', NULL, NULL, NULL, '2026-04-08 11:23:37', '2026-04-09 01:12:08', NULL),
(57, 'Tafsir Ahamed Khan', 'tafsir.3schambers@gmail.com', NULL, '$2y$12$Cs0IyjNgmMJe2m.voap5keUuS1N/2MQ4qIvZIJCrZ1vO/Yx8eCpNi', NULL, NULL, NULL, '2026-04-08 12:40:37', '2026-04-08 13:45:20', NULL),
(60, 'Md Topon Chowdhury', 'mdtoponchowdhury694@gmail.com', NULL, '$2y$12$iLRRvatShjxYK/KnYWc8vOODz7TVgw00Eljv6vXsZYq1NPmubTdua', 'mlcABGmvUBavw7C9b4FYX3cQk5e4jk5VADqpNC3GzMAgMfz2KbalDjGko1nH', NULL, NULL, '2026-04-08 16:45:38', '2026-04-08 16:58:05', NULL),
(61, 'MD.Motaher Hossain Johny', 'futureinteriorltd@gmail.com', NULL, '$2y$12$3Jyxj4ShlvOlOVbzgxJNdu5pkK4OgCpjbodhwBmFZVnW/DPZxPty.', NULL, NULL, NULL, '2026-04-08 16:52:33', '2026-04-08 18:41:54', NULL),
(62, 'Mohammad Mosheur Alam', 'mosheuralamritu@gmail.com', NULL, '$2y$12$uyFUvn50f.pv6P3Wqq1l9.PWP.kDmlcfOxzPM7aAln9oWrSmxovhC', '2a3zfOMM3Y6CV9dITfBR0f6HFEYjEUbto1SvcOKUGkKJXemtF6qIii4tMl0j', NULL, NULL, '2026-04-08 23:32:52', '2026-04-16 22:54:40', NULL),
(63, 'Md.Mahmudul Hasan', 'rocky69king@gmail.com', NULL, '$2y$12$yf.CdD8vGsXs2mxEE1DsPOrJgR7k0N/cyrfIH4CBq1FBUH1OQoH.e', NULL, NULL, NULL, '2026-04-09 00:21:12', '2026-04-09 00:21:12', NULL),
(64, 'MD ABU SUFIAN', 'sufianpappu@gmail.com', NULL, '$2y$12$qaN3wu.RObbobFxXn0fUtO9ppsJ8RwlwL/MiOT72uD/5koLZA4dfi', 'qXVbrXVMfvJNPXulIxCoro0UK2M8UzTc5dGku7wgIy1DdW94Nyv8XXOBQs2d', NULL, NULL, '2026-04-09 00:32:13', '2026-04-09 00:32:13', NULL),
(65, 'Abdullah Al Zahid', 'abdullahalzahid12@gmail.com', NULL, '$2y$12$0H33E5Ybi714PeV4Kge9fOc3Lr02kVZMAL/bS2gTugw/t4YLfj9RS', NULL, NULL, NULL, '2026-04-09 00:54:31', '2026-04-09 00:54:31', NULL),
(68, 'A K M Ariful Hoq', 'arifhsoikat@gmail.com', NULL, '$2y$12$YXEFa016ue33CdFSviG0h.DfOgqJv5QmVrNOwKL8fx/hXbupyR.Hu', NULL, NULL, NULL, '2026-04-09 01:26:50', '2026-04-09 01:26:50', NULL),
(69, 'Ariful Islam Rana Sikdar', 'arifulislamrana619@gmail.com', NULL, '$2y$12$rjmCwCtocwhHQEwwbC/89uA0p7XW6jq/R1QMZCU40O3JvVOesSuz6', NULL, NULL, NULL, '2026-04-09 13:57:22', '2026-04-09 14:34:42', NULL),
(70, 'SHAH MD. SIKANDER', 'shahsikanderkajal@gmail.com', NULL, '$2y$12$xDaiE38zymdD5kIEjUFZOOQco4kgLsjBeqXbSIIyuG6PZO/4q4IM.', NULL, NULL, NULL, '2026-04-09 14:09:11', '2026-04-09 18:00:42', NULL),
(71, 'MD. AL-AMIN', 'assettedbuilders@gmail.com', NULL, '$2y$12$46jEtimASu1szj9Ta8FiTujtPU7fBkvrB9ImAdFl.Yl.LHOadFRsq', NULL, NULL, NULL, '2026-04-09 14:12:22', '2026-04-09 18:16:28', NULL),
(72, 'ABDULLAH AL MASUD', 'aamasud30@gmail.com', NULL, '$2y$12$EoQ74WH0BWh8zabCs/NaMOq/YDFfFaHS2XqpKFEJehzhUKzguOSHO', 'AYm6iSrSZtlLM2lBUXxINj7HPjYjTlLAk8oBuYeu92Oo5tPaCpIWiQe2ClVY', NULL, NULL, '2026-04-09 14:15:38', '2026-04-17 18:04:16', NULL),
(73, 'ARAFAT HABIB', 'habibashik1990@gmail.com', NULL, '$2y$12$gjY1c/UpHCf8ywxlTSTbxOkc5cK2vrkK4PtXAENuIRbG.uY8x/DSu', NULL, NULL, NULL, '2026-04-09 14:18:50', '2026-04-10 00:36:21', NULL),
(74, 'MD. FAZLAY ABBAS', 'babor_786@yahoo.com', NULL, '$2y$12$0braJuJjVsqNrgVguadZpeHynNS2r7uogdEsitYJsk1kU/Mxqj1Fe', NULL, NULL, NULL, '2026-04-09 14:28:33', '2026-04-09 14:28:33', NULL),
(75, 'B.M.A. RAFIQ', 'bmarafiq@yahoo.com', NULL, '$2y$12$yJZXpq5LF0OMgLRKilVrDe.BRQTZbChH.KIFIHPBy8ZruqgJZxWsy', NULL, NULL, NULL, '2026-04-09 14:32:33', '2026-04-09 14:32:33', NULL),
(76, 'MD Rasel islam', 'raselfrance@gmail.com', NULL, '$2y$12$20lxLC6QlXSgouwsywFX2.Tpe554EpMJUv70Vv/PS/BhNi0XSdUi.', '5MsTP9LO1UhqmK06o2xer5vrmoAH9dHeMImaznar2H9TvzIj6oiM5tF778AX', NULL, NULL, '2026-04-10 02:00:20', '2026-04-10 02:00:20', NULL),
(78, 'Md.Mostafizur Rahman', 'mostafiz077@gmail.com', NULL, '$2y$12$PnDozo7YYhwaWqK.iesZ/.YYzX90i6G5p4HQGTLG79WuFW74QRUUO', '31x6iursbq4uVs2boHgSQzD2Av5ddC83rJTD0p6dy8qPX7SHIMSskN21BVxJ', NULL, NULL, '2026-04-11 14:20:00', '2026-04-11 15:39:28', NULL),
(79, 'MD. NURUL ALAM', 'nurula2020@icloud.com', NULL, '$2y$12$FqlGEPtynVPTftQGkhWsY.rE7va8ijZkZ.G74gPBmRXc/OeKBVjJi', NULL, NULL, NULL, '2026-04-11 18:42:40', '2026-04-11 18:51:17', NULL),
(80, 'MD. SAMIULLAH', 'mdsami791@gmail.com', NULL, '$2y$12$V/mT.bqdP9fdTGqrfdVqYOjnBg15SB4NbKsLBTFb3WJzku7oe3b16', NULL, NULL, NULL, '2026-04-11 23:43:36', '2026-04-11 23:43:36', NULL),
(81, 'MD RIFAT', 'mrenterprise.biz.bd@gmail.com', NULL, '$2y$12$YTQwrbHJUADUjAQ8A1e8puRiB4AOVg.wY3OG09VU6CghO4zn8r.KW', NULL, NULL, NULL, '2026-04-12 22:22:45', '2026-04-12 22:24:38', NULL),
(83, 'Runa Akter', 'runaakter4400@gmail.com', NULL, '$2y$12$WMDQ2LuDAVu2ky1glBFzjeWifYWSJlXPsvRJ0oF.z6VU9Iq.ilfnq', NULL, NULL, NULL, '2026-04-13 00:56:25', '2026-04-13 00:58:45', NULL),
(84, 'Mohammad S. Boshor', 'im.boshortutul@gmail.com', NULL, '$2y$12$WYFNPUvcLOAVZpCOS0SU6u/LoQMTDBygR2uKnPqLBxAalJmfEh9MS', NULL, NULL, NULL, '2026-04-15 20:05:01', '2026-04-15 20:05:01', NULL),
(85, 'SULTAN ZUBAYER', 'sultanzubayer1@gmail.com', NULL, '$2y$12$MzR.pjvasz0/ckzLB2DYeu5u3Njs6XHAHXj7n.o4BXFDV0sdxu6.e', 'zG7rcxdX7HMtRl1oBuOHp8RSbmUmlDOjuaz4M5JDZX71d4KyhrkzDA2u0Shm', NULL, NULL, '2026-04-15 21:46:56', '2026-04-15 21:50:30', NULL),
(86, 'Md Nazmul Islam Limon', 'limon7336@gmail.com', NULL, '$2y$12$umm7ZJ3H7JPL7dH1/CmB5O0SYeTE424HNeAh3ftyu9C9FUdDjuaym', NULL, NULL, NULL, '2026-04-17 16:36:53', '2026-04-17 16:36:53', NULL),
(87, 'Afsana Akter', 'afsanamuna41@gmail.com', NULL, '$2y$12$CAKp76hcBenISMxNDHCKkuqjPC3ZavYWH3Kq26MGUJ/CAya4uJTge', NULL, NULL, NULL, '2026-04-17 17:37:05', '2026-04-17 18:04:19', NULL),
(88, 'MD Riaz Uddin', 'riazahamed283@gmail.com', NULL, '$2y$12$EeZU0e01u7F9Ghp8pdEyb.rCD1jkh6qbQgDN43dzT8oXYxAFufeMW', NULL, NULL, NULL, '2026-04-17 17:40:07', '2026-04-17 19:00:23', NULL),
(89, 'Md.Akter hossain', 'gaziturjo.gt@gmail.com', NULL, '$2y$12$o2PXIY4pM/sna32muHvVwu7QkOY3JzVDwt4nTDNB70kVgn28wGEni', NULL, NULL, NULL, '2026-04-18 17:21:19', '2026-04-18 18:25:29', NULL),
(90, 'Mazbha Uddin Tanmoy', 'tmazbha@gmail.com', NULL, '$2y$12$ko34fYOs80EqGLbGWpD8Y.eL4PZF12csChtGpe9yLeMrNjVo6vpp6', NULL, NULL, NULL, '2026-04-18 21:52:59', '2026-04-18 22:21:37', NULL),
(91, 'MD SAMIUL ISLAM', 'samiulshabbir01710@gmail.com', NULL, '$2y$12$G.zSKTipK3VqPhQgtfkquOCBo3XKgiWSnN7N.kfO5pZA7XeLsVBsC', NULL, NULL, NULL, '2026-04-20 00:21:51', '2026-04-20 00:26:37', NULL),
(92, 'Saifur Rahman', 'saifurr543@gmail.com', NULL, '$2y$12$kuUHEErAPLD3X1lwiGjXD.vSvODfQvmhsddhGeUKPuNftyoVDLBiK', NULL, NULL, NULL, '2026-04-26 22:59:36', '2026-04-27 07:34:18', NULL),
(93, 'Imran Sarkar', 'sathiosimoan@gmail.com', NULL, '$2y$12$bEzEnPNTpZx.AmGXR9QRfuoA0D4kg2qZYwlUNP39X3eMXJAJaSwwm', 'fsMXJz37ENegIDRatYO9MjuCXqf9fBlHVMLjB0K4YZeViaW2Y4tbcYZQAOxS', NULL, NULL, '2026-04-26 23:02:36', '2026-04-26 23:49:44', NULL),
(94, 'MD ARMAN HOSSAIN JULHAS', 'armanhussainm238@gmail.com', NULL, '$2y$12$4g3vh0q4T1GZOUBWorXBluaQw6ikvf/KQd8TCiIbzWCNGCE1867fy', NULL, NULL, NULL, '2026-04-27 10:38:44', '2026-04-27 10:38:44', NULL),
(95, 'MD. KAMRUL ALAM', 'kamrul.alam02@northsouth.edu', NULL, '$2y$12$9B3syYCQy06VHfniOCJrdOhf.Sz0gGE9LCLtxAcDLM4dSOqyETTU.', NULL, NULL, NULL, '2026-04-27 16:05:27', '2026-04-27 16:05:27', NULL),
(96, 'Palash Dhar', 'palashdhar7@gmail.com', NULL, '$2y$12$3/IB4MplVBfq37x6NlQz1.cLotobcPbqQCx3Rv5WS6YLpTAaYblFu', NULL, NULL, NULL, '2026-05-05 10:18:16', '2026-05-05 10:18:16', NULL),
(97, 'MD SALAHUDDIN', 'mdaalahuddin56895@gmail.com', NULL, '$2y$12$ONLSaWpLigG6kLL.6LsPquieDE832ETFcUEEUHBfqlllK6nOlSmui', NULL, NULL, NULL, '2026-05-06 18:12:15', '2026-05-06 18:25:17', NULL),
(98, 'Raju Ahmed', 'rajupapon@gmail.com', NULL, '$2y$12$vlFvfYvV5y1m3AV6Jn8zEu4OKLuvjLajTcUJq5u1nSsSEmaO5ONfS', NULL, NULL, NULL, '2026-05-08 16:38:04', '2026-05-08 16:38:04', NULL),
(99, 'MOHAMMED HOMAYAN KABIR', 'pelican5454@gmail.com', NULL, '$2y$12$i7cCi5DkMSpYF4np1Q8EkO3K7iP5r.lO6.Cs0dvVQ8JBv4auwXlWW', NULL, NULL, NULL, '2026-05-09 00:51:56', '2026-05-09 00:51:56', NULL),
(100, 'Prince Rasel khan', 'pkjuly0710@gmail.com', NULL, '$2y$12$QXe.p6.G1Sdn3NGRe82QteRqUHe2mNYn9Dvq/tgwaRZpqyeGq1xC2', NULL, NULL, NULL, '2026-05-09 13:11:22', '2026-05-09 13:11:22', NULL),
(101, 'Md. Newaz Morshed', 'newazmorshed89@gmail.com', NULL, '$2y$12$dtRZmmD3Ki.p17Dqd6xpEO9AviehAqoFCc3ll1GzPfjQbK/uj2Bye', 'wvVYCQ9QARenpy2JbDpOTDN8mxE1JhncNVgQMBJzsw8zIrZlnXatweKcSmo8', NULL, NULL, '2026-05-11 20:56:08', '2026-05-11 20:56:08', NULL),
(102, 'Mokaram Hossain', 'mokaramhossain23@gmail.com', NULL, '$2y$12$GCELX8IiMlGEHY/nQRJubue7H5kl8jCTLMg2V1.0RBJii60bqybjq', NULL, NULL, NULL, '2026-05-11 21:14:48', '2026-05-11 21:14:48', NULL),
(103, 'Md.Islamul Haque Mujahid', 'mujahid07fbd@gmail.com', NULL, '$2y$12$BvLlI.xwOEMqI1O1JNbRWeS9TWyF7OVzpAwscdj5vHTkMQL7RKMKu', NULL, NULL, NULL, '2026-05-11 23:12:05', '2026-05-11 23:12:05', NULL),
(104, 'Md. Rezwanul Haque', 'haqrez@gmail.com', NULL, '$2y$12$I.v.u7ktmCXWuab7Ts/Ql.TzEww8Lo7fRM2LkknfoCvbGtCD4tao2', NULL, NULL, NULL, '2026-06-14 00:11:54', '2026-06-14 00:26:08', NULL),
(105, 'Md. Ruhan Chowdhury Arian', 'ruhanchowdhury927@gmail.com', NULL, '$2y$12$qius4yBu5uYPOYfn0rh5IuwfYBRE8ygGnk61tSDsi9ARIhLMzS/YK', NULL, NULL, NULL, '2026-06-14 01:08:23', '2026-06-14 01:08:23', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_profiles`
--

CREATE TABLE `user_profiles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `membership_application_id` bigint(20) UNSIGNED DEFAULT NULL,
  `date_of_birth` date NOT NULL,
  `nid_passport` varchar(255) NOT NULL,
  `profession_organization` varchar(255) NOT NULL,
  `mobile` varchar(20) NOT NULL,
  `address` text NOT NULL,
  `facebook_url` varchar(255) DEFAULT NULL,
  `instagram_url` varchar(255) DEFAULT NULL,
  `linkedin_url` varchar(255) DEFAULT NULL,
  `twitter_url` varchar(255) DEFAULT NULL,
  `youtube_url` varchar(255) DEFAULT NULL,
  `membership_category_id` bigint(20) UNSIGNED NOT NULL,
  `manual_member_id` varchar(255) DEFAULT NULL,
  `membership_start_at` datetime DEFAULT NULL,
  `membership_end_at` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_profiles`
--

INSERT INTO `user_profiles` (`id`, `user_id`, `photo`, `membership_application_id`, `date_of_birth`, `nid_passport`, `profession_organization`, `mobile`, `address`, `facebook_url`, `instagram_url`, `linkedin_url`, `twitter_url`, `youtube_url`, `membership_category_id`, `manual_member_id`, `membership_start_at`, `membership_end_at`, `created_at`, `updated_at`) VALUES
(6, 7, 'member-photos/SEy6mzGc1zoEbnLHJiwRwVm7p8oIzvMwroA9WXEX.jpg', NULL, '1989-10-17', '6445326439', 'Business', '01988855507', 'Mohakhali School Road,Wireless Gate,House:G.P.GA-194,Dhaka-1212.', 'https://www.facebook.com/share/1Fb9gwqufY/', NULL, NULL, NULL, NULL, 4, '20250001', NULL, NULL, '2026-02-18 05:46:56', '2026-05-10 13:51:38'),
(9, 11, 'member-photos/WogtXrt144jEP1FtFCZ3wdj3AOVtJBF9cfafBAB7.jpg', NULL, '1989-12-09', '4648673533', 'Accounts', '01676282672', 'H-118,Khilbarirtek,School Road,Vatara,\r\nGulshan-1212,Dhaka.', NULL, NULL, NULL, NULL, NULL, 8, NULL, '2026-04-01 12:02:21', '2027-04-01 12:02:21', '2026-04-01 19:02:21', '2026-04-02 10:46:01'),
(10, 12, NULL, NULL, '1989-04-01', '9559695797', 'Private Job', '01511691369', 'House:279, Raod-3/1, Anandnagar, Badda Dhaka.', NULL, NULL, NULL, NULL, NULL, 8, NULL, '2026-04-01 18:33:31', '2027-04-01 18:33:31', '2026-04-02 01:33:31', '2026-04-02 01:33:31'),
(11, 13, NULL, NULL, '1988-01-01', '6014164260', 'IT Officer', '01911902922', 'Ga- 155, Wairless Gate, Mohakhali.', NULL, NULL, NULL, NULL, NULL, 8, NULL, '2026-04-01 18:39:25', '2027-04-01 18:39:25', '2026-04-02 01:39:25', '2026-04-03 22:40:09'),
(12, 14, NULL, NULL, '1989-04-02', '1908046459', 'Business', '01674793917', 'House 53, road 16, sector 1. Uttara Dhaka 1230', NULL, NULL, NULL, NULL, NULL, 8, NULL, '2026-04-01 18:45:42', '2027-04-01 18:45:42', '2026-04-02 01:45:42', '2026-04-02 01:45:42'),
(14, 16, NULL, NULL, '1992-11-23', '3268000142', 'City Bank Plc', '01671418007', 'House: cha-161, Mohakhali,Dhaka-1212', NULL, NULL, NULL, NULL, NULL, 8, NULL, '2026-04-02 02:36:43', '2027-04-02 02:36:43', '2026-04-02 09:36:43', '2026-04-02 09:36:43'),
(15, 17, 'member-photos/LaQrCNJ8uvsr1UuyOaqprBaIuPi1L3DEhn6lhZPq.jpg', NULL, '2000-05-20', '2864017880', 'Business', '+8801625326945', '37 dinnaht sen rod, Gandaria, Dhaka.', 'https://www.facebook.com/mdkamrulhasancairo', NULL, NULL, NULL, NULL, 8, NULL, '2026-04-02 05:44:33', '2027-04-02 05:44:33', '2026-04-02 12:44:33', '2026-04-15 23:16:08'),
(17, 19, 'member-photos/G5gNLrcqh95GcH774yx5ZuzGp0CUeczvR4McuN8b.jpg', NULL, '1994-10-12', '7345674969', 'Business', '01627685774', 'soniahkra', NULL, NULL, NULL, NULL, NULL, 8, NULL, '2026-04-02 06:21:23', '2027-04-02 06:21:23', '2026-04-02 13:21:23', '2026-04-03 18:37:30'),
(18, 20, 'member-photos/6cAtE1xgatilgfHtUdkVlFRcEEiMBrU0WoSPuzQm.jpg', NULL, '1989-04-17', '19872692619479187', 'Private Job', '01670260025', 'E8/B BTCL colony Banani dhaka', NULL, NULL, NULL, NULL, NULL, 8, NULL, '2026-04-02 07:37:54', '2027-04-02 07:37:54', '2026-04-02 14:37:54', '2026-04-02 16:52:47'),
(19, 21, 'member-photos/LsxXYlcluLdIgRR0oIa2kZuTSRm85sRf1xQoYrUq.jpg', NULL, '1988-10-25', '1495253351', 'Job', '01766409509', '29Mitali housing,south kafrul, Dhaka.', NULL, NULL, NULL, NULL, NULL, 8, NULL, '2026-04-02 08:39:09', '2027-04-02 08:39:09', '2026-04-02 15:39:09', '2026-04-02 16:10:09'),
(20, 22, 'member-photos/dg1xuSELXmEptT5kLwHNCX3pX7a4vS1iRRrlONmy.jpg', NULL, '1988-02-01', '7787997902', 'Business', '01914522765', 'Sector 12, Road 16,House 53 Uttara, 1230 Dhaka.', NULL, NULL, NULL, NULL, NULL, 8, NULL, '2026-04-02 12:59:40', '2027-04-02 12:59:40', '2026-04-02 19:59:40', '2026-04-02 20:25:44'),
(21, 23, 'member-photos/yzAiZ7l7AoG4o4KrXvNIxWXNovwhF4255xz9f2QS.jpg', NULL, '1994-10-01', 'A04731588', 'Job', '01770132474', 'GP GA-133 Mohakhali, Hazari Bari, Banani, Dhaka -1213.', NULL, NULL, NULL, NULL, NULL, 8, NULL, '2026-04-02 14:02:04', '2027-04-02 14:02:04', '2026-04-02 21:02:04', '2026-04-02 23:23:50'),
(22, 24, 'member-photos/NTsXXvBwPZEW8EPKfy5iAT4K5VNF0X5K8chCwSqg.jpg', NULL, '1989-04-10', '4645579535', 'Head of Accounts', '01632701149', 'J. P. JA. 46/3,\r\nMohakhali. Banani. Dhaka 1213.', NULL, NULL, NULL, NULL, NULL, 8, NULL, '2026-04-02 14:18:42', '2027-04-02 14:18:42', '2026-04-02 21:18:42', '2026-04-02 22:12:56'),
(23, 25, 'member-photos/1tKJf7Wv2GSOkz9rJwydpWK9O2OZgGlHtlkrh4VZ.jpg', NULL, '1992-09-06', '9145288990', 'Job', '01914573769', 'Mohakhali TB Gate G P Cha 192 Baitun kunjo, Banani Gulshan,Dhaka-1212.', NULL, NULL, NULL, NULL, NULL, 8, NULL, '2026-04-02 14:29:57', '2027-04-02 14:29:57', '2026-04-02 21:29:57', '2026-04-04 17:00:45'),
(24, 26, 'member-photos/SOvtFyqR3p6fnvTcYetRTHyEyxWKjckz5MwiNjfK.jpg', NULL, '1988-08-05', '4603746936', 'Bike  Mechanic', '01615183607', 'G.P.JA-29/A,\r\nAkijpara,Mohakhali,Dhaka-1213', NULL, NULL, NULL, NULL, NULL, 8, NULL, '2026-04-02 19:13:06', '2027-04-02 19:13:06', '2026-04-03 02:13:06', '2026-04-03 22:42:23'),
(25, 27, NULL, NULL, '1999-04-03', '9556070267', 'Business', '01534315827', 'G.p.cha-71/1, Mohakhali wirelessgate, Dhaka-1212.', NULL, NULL, NULL, NULL, NULL, 8, NULL, '2026-04-02 19:30:07', '2027-04-02 19:30:07', '2026-04-03 02:30:07', '2026-04-03 02:30:07'),
(26, 28, 'member-photos/5t4RZOgqBjARsZNhxVGlRS4m5RflBjX9yCpOVnZ7.jpg', NULL, '1989-07-01', '2801445186', 'Private Service', '01680040236', 'TB Gate, Mohakhali, Dhaka.', NULL, NULL, NULL, NULL, NULL, 8, NULL, '2026-04-03 04:40:40', '2027-04-03 04:40:40', '2026-04-03 11:40:40', '2026-04-03 12:28:27'),
(27, 29, 'member-photos/2FR1X6AA96ZqeqSfiSe2OpVNuCw0MRPMsi0E4sjg.jpg', NULL, '1988-12-17', '7341499148', 'BUSINESS', '01737600470', 'H-37, R-13, S-13 Uttara Dhaka.', NULL, NULL, NULL, NULL, NULL, 8, NULL, '2026-04-03 07:09:20', '2027-04-03 07:09:20', '2026-04-03 14:09:20', '2026-04-03 18:48:37'),
(28, 31, 'member-photos/jZeSFoyIFw2jPS9HLle7fGAPASdOaf0GSKMn6yGe.jpg', NULL, '1988-03-27', '5095245576', 'Assistant Manager', '01722229952', 'Cha-118/1 Mohakhali Moddapara, Gulshan, Dhaka-1212.', NULL, NULL, NULL, NULL, NULL, 8, NULL, '2026-04-03 09:31:46', '2027-04-03 09:31:46', '2026-04-03 16:31:46', '2026-04-03 19:18:55'),
(29, 32, 'member-photos/Eb2fAkFi7sf7ZAYhPgifRmqMoVewbHYWzrpWzC8P.jpg', NULL, '1988-04-03', '6444563966', 'Private job', '01670232866', 'Dhaka', NULL, NULL, NULL, NULL, NULL, 8, NULL, '2026-04-03 17:17:25', '2027-04-03 17:17:25', '2026-04-04 00:17:25', '2026-04-09 17:06:02'),
(30, 33, 'member-photos/7ziAGiQxSc03zqqrY9utbmh5zjWV75vSs5jgHKVj.png', NULL, '1990-02-03', '865 084 2118', 'Freelancer', '01670093847', 'Cha-192, T.B.Gate, Mohakhali, Dhaka.', NULL, NULL, NULL, NULL, NULL, 8, NULL, '2026-04-04 00:48:10', '2027-04-04 00:48:10', '2026-04-04 07:48:10', '2026-04-04 22:44:36'),
(31, 34, 'member-photos/wBVMPsTEdalzW6E259NcIhYtgkkOijwduBogjCAO.jpg', NULL, '1987-04-04', '9571709998', 'Private Job', '01886383077', 'Banani BTCL Colony, Dhaka-1213', NULL, NULL, NULL, NULL, NULL, 8, NULL, '2026-04-04 00:53:13', '2027-04-04 00:53:13', '2026-04-04 07:53:13', '2026-04-04 10:57:11'),
(32, 35, 'member-photos/7WOiNQd94pHxlEcqhIudpe1Cj7l508BEuccvpFo3.jpg', NULL, '1987-11-21', '865411344', 'Chief technical and operation officer (CTOO)', '01912397138', 'G.P.JA-30, road-1, Mohakhali, Wairlessgate, Dhaka.', NULL, NULL, NULL, NULL, NULL, 8, NULL, '2026-04-04 04:17:36', '2027-04-04 04:17:36', '2026-04-04 11:17:36', '2026-04-12 00:16:09'),
(33, 36, 'member-photos/bUaPXVGjYyh9ZAke0MXVb7lg1eoZBDdIgalzd1UY.jpg', NULL, '1987-02-19', '6895653894', 'Private job', '01882657072', 'House: 1020\r\nRoad: Eidgah road \r\nPost : Ibrahimpur\r\nP.S.- Kafrul ,Dhaka.', NULL, NULL, NULL, NULL, NULL, 8, NULL, '2026-04-04 06:51:21', '2027-04-04 06:51:21', '2026-04-04 13:51:21', '2026-04-04 18:51:49'),
(34, 37, 'member-photos/v8jOghIw0BMXBsLUub7ofHeuD74hNsdnsc4M7rX2.jpg', NULL, '1985-09-05', '8695320401', 'DIRECTOR', '01911475333', 'G.P Cha-27, Mohakhali School Road, Banani, Gulshan, Dhaka.', NULL, NULL, NULL, NULL, NULL, 8, NULL, '2026-04-04 07:51:40', '2027-04-04 07:51:40', '2026-04-04 14:51:40', '2026-04-04 21:57:36'),
(35, 39, 'member-photos/aBYcm9AziHXuuhTLaLoBkUjS2EEDByXGhsTsTOOp.jpg', NULL, '1989-04-04', '7793589495', 'Job', '01911701649', 'Mohakhali btcl colony', NULL, NULL, NULL, NULL, NULL, 8, NULL, '2026-04-04 08:38:54', '2027-04-04 08:38:54', '2026-04-04 15:38:54', '2026-04-04 16:16:36'),
(37, 41, 'member-photos/QeUZMTa2s9gwktyqTbuqfoXiH1EnVgxvK33UlArc.jpg', NULL, '1990-05-10', '9128454791', 'Private Job', '01671807565', 'Fair Kazi, 36/1,Mohakhali Wirless Gate, Dhaka-1213.', NULL, NULL, NULL, NULL, NULL, 8, NULL, '2026-04-04 08:47:07', '2027-04-04 08:47:07', '2026-04-04 15:47:07', '2026-04-04 17:09:48'),
(38, 42, 'member-photos/R7pxSMHfcqcQBxxHhhytIXibsKJ2en5FSo2Yk9hK.jpg', NULL, '1989-04-04', '019892692620517741', 'Business', '01674876277', 'Mohakhali,TB gate, G.P. chha-16.', NULL, NULL, NULL, NULL, NULL, 8, NULL, '2026-04-04 10:20:59', '2027-04-04 10:20:59', '2026-04-04 17:20:59', '2026-04-04 17:42:34'),
(39, 43, 'member-photos/DBIeJthdH5YWj72RoirK0EpdbbZURm1oe1l3m6BT.jpg', NULL, '1990-05-01', '3250228602', 'Government Job', '01675651251', 'B.A.E.C housing colony,banani,Dhaka:-1213.', NULL, NULL, NULL, NULL, NULL, 8, NULL, '2026-04-04 14:17:37', '2027-04-04 14:17:37', '2026-04-04 21:17:37', '2026-04-04 21:30:19'),
(40, 44, 'member-photos/EDF13Vx0s1FhExuqyuIzoVpAK2WskQS5mCbOX7CT.jpg', NULL, '1991-01-15', '5074362798', 'Private service', '01676162017', 'Cha-140, TV gate, Mohakhali, Gulshan,Banani,Dhaka-1212.', NULL, NULL, NULL, NULL, NULL, 8, NULL, '2026-04-04 15:10:43', '2027-04-04 15:10:43', '2026-04-04 22:10:43', '2026-04-04 22:13:16'),
(41, 45, NULL, NULL, '1988-02-29', '2692620524239', 'Job Holder', '01715020143', 'H-Ta-22/c, R-2, Banani Dhaka-1213.', NULL, NULL, NULL, NULL, NULL, 8, NULL, '2026-04-05 08:17:41', '2027-04-05 08:17:41', '2026-04-05 15:17:41', '2026-04-05 19:21:30'),
(43, 47, 'member-photos/gDVelSkQZA2afhIXgDEk1XG6aWYdjTIM93ozeqKp.jpg', NULL, '1990-04-06', 'A07958871', 'Business', '01790043512', 'Mohakali,Hazari bari, G.P.CHA- 1/b,Dhaka-1212.', NULL, NULL, NULL, NULL, NULL, 8, NULL, '2026-04-06 10:00:23', '2027-04-06 10:00:23', '2026-04-06 17:00:23', '2026-04-07 18:47:05'),
(44, 48, NULL, NULL, '1990-04-06', '1476403777', 'Business', '01719085511', 'G.P.CHA-195/1,Mohakhali, TV Gate,Banani,Dhaka-1212.', NULL, NULL, NULL, NULL, NULL, 8, NULL, '2026-04-06 10:30:55', '2027-04-06 10:30:55', '2026-04-06 17:30:55', '2026-04-06 17:30:55'),
(46, 50, 'member-photos/sXdXAUAa3R4r6kxnHGwrl1syGqxaPtgWGUMfaOAL.jpg', NULL, '1987-04-06', '5976966357', 'Service Holder', '01717-070700', 'Chowdhury House, House no#1799, Road no#04, Smritydhara R/A, Japani Bazar, Shonir Akhra, Dhaka-1236.', NULL, NULL, NULL, NULL, NULL, 8, NULL, '2026-04-06 13:00:27', '2027-04-06 13:00:27', '2026-04-06 20:00:27', '2026-04-06 20:27:54'),
(48, 52, 'member-photos/D8mZxTSCTAEUgWeg7P2P31PP1EhzokZZWdbGMKBq.jpg', NULL, '1987-01-10', '2395908037', 'Business', '01711945600', 'House#51,Road#15,Sector#11,\r\nUttara.', NULL, NULL, NULL, NULL, NULL, 8, NULL, '2026-04-07 16:35:21', '2027-04-07 16:35:21', '2026-04-07 23:35:21', '2026-04-08 11:04:51'),
(49, 53, 'member-photos/jW2AkqaQD2o9HmNKp68v3qXDM6Y1Ia2WCWn7rYcc.png', NULL, '1993-12-31', '6860670931', 'Government job', '01715634158', '3/1 IHT STAFF QUATER MOHAKHALI, SHAKA, Dhaka-1212.', NULL, NULL, NULL, NULL, NULL, 8, NULL, '2026-04-08 04:23:37', '2027-04-08 04:23:37', '2026-04-08 11:23:37', '2026-04-09 01:28:01'),
(51, 57, 'member-photos/ZwpgCUtnchZhjXlpGqTdPaYXisqRbsjYE1TeFWrB.jpg', NULL, '1991-11-14', 'A17126775', 'Advocate', '01717944712', 'Flat No: D3, House No-1188, Pakar Matha, East Shewrapara.', NULL, NULL, NULL, NULL, NULL, 7, NULL, '2026-04-08 05:40:37', '2046-04-08 05:40:37', '2026-04-08 12:40:37', '2026-04-09 00:24:30'),
(54, 60, 'member-photos/d1ITPyDzsZM2HsBK6z16kqn0jtKeNhly3WAB97q1.jpg', NULL, '1992-05-25', '6872724254', 'Service', '01408340150', 'I.P.H,Mohakhli, Dhaka-1212.', NULL, NULL, NULL, NULL, NULL, 8, NULL, '2026-04-08 09:45:38', '2027-04-08 09:45:38', '2026-04-08 16:45:38', '2026-04-08 16:59:48'),
(55, 61, 'member-photos/KjqHJFL3QTR89Aey7BWOSYwZEUnqBLkWUYLgQENu.jpg', NULL, '1988-08-17', '6007878694', 'Business', '01612112223', 'Mohakhali,Dhaka-1212', NULL, NULL, NULL, NULL, NULL, 8, NULL, '2026-04-08 09:52:33', '2027-04-08 09:52:33', '2026-04-08 16:52:33', '2026-04-08 18:51:13'),
(56, 62, 'member-photos/bCBmHOqLsWvhIRapVuiJJaF95bwt3d7IXoIN8cJz.jpg', NULL, '1987-04-08', '5544974248', 'Business', '01925668024', '33/1 Purano Paltan,Dhaka-1000.', 'https://www.facebook.com/mosheur.alam', NULL, NULL, NULL, NULL, 4, NULL, '2026-04-08 16:32:52', '2046-04-09 23:59:59', '2026-04-08 23:32:52', '2026-04-16 22:54:01'),
(57, 63, 'member-photos/lMSQEWNvGuMLR72bIQuodYcCCVhXqUjsSb9rXiir.jpg', NULL, '1990-04-08', '3719841029', 'Business', '01688877799', '36 Shirish Dash Lane', NULL, NULL, NULL, NULL, NULL, 8, NULL, '2026-04-08 17:21:12', '2027-04-08 17:21:12', '2026-04-09 00:21:12', '2026-04-09 18:38:50'),
(58, 64, NULL, NULL, '1989-10-28', '8200358367', 'Medical Technologist', '01674777922', 'H-40,Kawlar Uttorpara,Dakshinkhan,Dhaka', NULL, NULL, NULL, NULL, NULL, 8, NULL, '2026-04-08 17:32:13', '2027-04-08 17:32:13', '2026-04-09 00:32:13', '2026-04-09 15:46:01'),
(59, 65, 'member-photos/39x7UrenXqoToBw2aOPBCtJDNrPR0uv7g6e0W2Fb.jpg', NULL, '1988-10-21', '1948210099', 'Job', '01538026392', 'G.P.JA: 157, Mohakhali, Wireless Gate', NULL, NULL, NULL, NULL, NULL, 8, NULL, '2026-04-08 17:54:31', '2027-04-08 17:54:31', '2026-04-09 00:54:31', '2026-04-09 00:59:39'),
(62, 68, NULL, NULL, '1987-04-09', '3285558866', 'Manager', '01620717778', 'Shanti tower,Sahebpara, mijmiji, Signboard', NULL, NULL, NULL, NULL, NULL, 8, NULL, '2026-04-08 18:26:50', '2027-04-08 18:26:50', '2026-04-09 01:26:50', '2026-04-09 01:26:50'),
(63, 69, 'member-photos/8rqrsHKfJymNDK1gGjBwN9GIWHivq7OjvOT1ZGvj.jpg', NULL, '1987-09-25', '373 635 2372', 'Furniture Business', '01911224237', 'Nikunja 2, Road 14, House# 6.', NULL, NULL, NULL, NULL, NULL, 8, NULL, '2026-04-09 06:57:22', '2027-04-09 06:57:22', '2026-04-09 13:57:22', '2026-04-09 14:41:28'),
(64, 70, 'member-photos/oZPeZO94FBuKYhS5aGgkThwTD5ouj8RFgRMxTgRF.jpg', NULL, '1992-01-23', '1013312663', 'Business', '01672314778', 'Mohakhali', NULL, NULL, NULL, NULL, NULL, 4, NULL, '2026-04-09 07:09:11', '2046-04-09 07:09:11', '2026-04-09 14:09:11', '2026-04-09 18:00:03'),
(65, 71, 'member-photos/5Qrs70FwttGOvIdK7SknF4tZsphxjlduypZviR98.jpg', NULL, '1994-10-12', '8231178032', 'Real state & Developer', '01706664962', 'Sayed Nagar', NULL, NULL, NULL, NULL, NULL, 4, NULL, '2026-04-09 07:12:22', '2046-04-09 07:12:22', '2026-04-09 14:12:22', '2026-04-09 18:18:39'),
(66, 72, 'member-photos/TLtFdwIaaC9khhdDCPZJ5cMdzdpfw1aZiEneDccX.jpg', NULL, '1993-08-22', '3302427301', 'Business (RHM Corporation)', '01912124832', 'Woodland Ananna G.P.Ja-67/3/C Mohakhali Dhaka 1212.', 'https://www.facebook.com/share/1JHueEWivh/?mibextid=wwXIfr', NULL, NULL, NULL, NULL, 4, NULL, '2026-04-09 07:15:38', '2046-04-09 07:15:38', '2026-04-09 14:15:38', '2026-04-17 18:07:20'),
(67, 73, 'member-photos/XCIksZzLqhJ5j85k3dx0zqqclfLBlRYtxzZ7imC4.jpg', NULL, '1990-09-12', '19902692620000731', 'Doctor', '01916955067', 'Mohakhali', NULL, NULL, NULL, NULL, NULL, 4, NULL, '2026-04-09 07:18:50', '2046-04-09 07:18:50', '2026-04-09 14:18:50', '2026-04-10 00:35:54'),
(68, 74, NULL, NULL, '1970-05-14', '9566954096', 'Business', '01763399875', 'House #10,Apt. #A6,Road #11,Gulshan-1,Dhaka-1212.', NULL, NULL, NULL, NULL, NULL, 7, NULL, '2026-04-09 07:28:33', '2046-04-09 07:28:33', '2026-04-09 14:28:33', '2026-04-09 14:28:33'),
(69, 75, NULL, NULL, '1990-06-10', '1946119409', 'Business', '01711774444', 'Baitun Titas,G.P.GA-118,School Road,Mohakhali,Dhaka-1212.', NULL, NULL, NULL, NULL, NULL, 7, NULL, '2026-04-09 07:32:33', '2046-04-09 07:32:33', '2026-04-09 14:32:33', '2026-04-09 14:32:33'),
(70, 76, 'member-photos/kE06dw4A4Y6AjsaNolr4GdeKUFSoxzTZZaHJBOPA.jpg', NULL, '1987-04-10', '5095139415', 'Business', '01676004770', 'Mohakhali, G.P.JA :-61,Dhaka-1212', NULL, NULL, NULL, NULL, NULL, 8, NULL, '2026-04-09 19:00:20', '2027-04-09 19:00:20', '2026-04-10 02:00:20', '2026-04-18 23:17:01'),
(72, 78, 'member-photos/ueFqzh2x1CU8fzyCPpbF8JyOdl34qRV25IVYpsxn.jpg', NULL, '1987-04-11', '2397939196', 'Business', '01620653753', 'Banani Housing complex, 4/1, Road-2, Banani Dhaka 1213.', NULL, NULL, NULL, NULL, NULL, 8, NULL, '2026-04-11 07:20:00', '2027-04-11 07:20:00', '2026-04-11 14:20:00', '2026-04-11 15:41:44'),
(73, 79, 'member-photos/kQTu9Tp3FD1nQubi1HVKw8Oibj8cqKLbd7vJEsZd.jpg', NULL, '1976-06-15', '5507726197', 'Business', '0184652746', 'Mohakhali, Hazari Bari,House: G.P.GA-117/2(Munshi cottage),Dhaka-1212.', NULL, NULL, NULL, NULL, NULL, 7, NULL, '2026-04-11 11:42:40', '2046-04-11 11:42:40', '2026-04-11 18:42:40', '2026-04-11 19:05:50'),
(74, 80, NULL, NULL, '1994-01-05', '148 920 6274', 'Coordinator Operations and Lead', '01622144144', 'GP Cha 80/1, Mohakhali, Banani, Dhaka 1213.', NULL, NULL, NULL, NULL, NULL, 8, NULL, '2026-04-11 16:43:36', '2027-04-11 16:43:36', '2026-04-11 23:43:36', '2026-04-11 23:43:36'),
(75, 81, NULL, NULL, '1994-05-09', '8230828918', 'Business', '01855257767', 'Cha - 215/1, Mohakhali, Dhaka-1212.', NULL, NULL, NULL, NULL, NULL, 8, NULL, '2026-04-12 15:22:45', '2027-04-12 15:22:45', '2026-04-12 22:22:45', '2026-04-12 22:22:45'),
(77, 83, NULL, NULL, '1992-04-12', 'EN0478231', 'Pastry Chef', '0123456789', 'Narayanganj', NULL, NULL, NULL, NULL, NULL, 8, NULL, '2026-04-12 17:56:25', '2027-04-12 17:56:25', '2026-04-13 00:56:25', '2026-04-13 00:56:25'),
(78, 84, NULL, NULL, '1988-04-15', '554 509 8575', 'Consultant', '01601161171', 'GA-188, Mohakhali, Dhaka-1213.', NULL, NULL, NULL, NULL, NULL, 8, NULL, '2026-04-15 13:05:01', '2027-04-15 13:05:01', '2026-04-15 20:05:01', '2026-04-15 20:05:01'),
(79, 85, 'member-photos/dEIDTK2sCdD5T4wpFrI2X6Vq64BCeyCWfGYtHADQ.jpg', NULL, '1986-07-14', '1494785338', 'Business', '01972122127', 'Mohakhali', 'https://www.facebook.com/share/1Dx2bGN5nX/', NULL, NULL, NULL, NULL, 8, NULL, '2026-04-15 14:46:56', '2027-04-15 14:46:56', '2026-04-15 21:46:56', '2026-04-15 23:07:57'),
(80, 86, NULL, NULL, '1990-04-17', '7353723021', 'Business', '01785071009', 'Mohakhali, Dhaka 1212, Bangladesh.', NULL, NULL, NULL, NULL, NULL, 8, NULL, '2026-04-17 09:36:53', '2027-04-17 09:36:53', '2026-04-17 16:36:53', '2026-04-17 16:36:53'),
(81, 87, 'member-photos/xAi0px5UDUJXJGIyNrDbVMHNmZn6FtAqHpAIjY1G.jpg', NULL, '1990-04-17', '826245577', 'Business', '01982606003', 'Kadamtoli, Keraniganj', NULL, NULL, NULL, NULL, NULL, 8, NULL, '2026-04-17 10:37:05', '2027-04-17 10:37:05', '2026-04-17 17:37:05', '2026-04-17 18:08:20'),
(82, 88, NULL, NULL, '1987-04-17', '7802432422', 'Business', '01611599969', 'Mohakhali,Dhaka-1212', NULL, NULL, NULL, NULL, NULL, 8, NULL, '2026-04-17 10:40:07', '2027-04-17 10:40:07', '2026-04-17 17:40:07', '2026-04-17 17:40:07'),
(83, 89, NULL, NULL, '1986-12-05', '1591904350897', 'Self-Employment', '01670442734', 'kawla Dakshinkhan', NULL, NULL, NULL, NULL, NULL, 8, NULL, '2026-04-18 10:21:19', '2027-04-18 10:21:19', '2026-04-18 17:21:19', '2026-04-18 18:26:01'),
(84, 90, 'member-photos/ONrS9FMmnYAlvkNDx19LcqmK4aURkx2txbhBpX8p.jpg', NULL, '1988-09-21', '9150344951', 'Business', '01747501475', 'Mohakhali wireless gat GPJ - 153.', NULL, NULL, NULL, NULL, NULL, 8, NULL, '2026-04-18 14:52:59', '2027-04-18 14:52:59', '2026-04-18 21:52:59', '2026-04-18 22:18:19'),
(85, 91, 'member-photos/rytRWUSoDONkRKlVrCR75mqwMohyYDCz7krJXwoJ.jpg', NULL, '1994-01-19', '8210162825', 'Business', '01710265948', 'House: 74,GP-J, Mohakhali Wirless Gate,Dhaka-1212.', 'https://www.facebook.com/share/18W5p9YuMf/?mibextid=wwXIfr', NULL, NULL, NULL, NULL, 8, NULL, '2026-04-19 17:21:51', '2027-04-19 17:21:51', '2026-04-20 00:21:51', '2026-04-20 00:25:43'),
(86, 92, 'member-photos/3rMMVJOBBytx3ABlv72KSeQFi3AlzBvdu1JiZ7Wk.jpg', NULL, '1991-09-01', '2365970835', 'Private Service', '01670100219', 'House: 14, Block: E, Mainroad, South Banasree, Khilgaon, Dhaka 1219.', NULL, NULL, 'https://www.linkedin.com/in/saifur-r-197060a0', NULL, NULL, 8, NULL, '2026-04-26 15:59:36', '2027-04-26 15:59:36', '2026-04-26 22:59:36', '2026-04-27 07:55:05'),
(87, 93, 'member-photos/63ii5eVOj3nKPCfGkCRwWHDKD8FlSDFRfvpHJdr2.jpg', NULL, '1988-09-24', '8221473666', 'Revenue Inspector. Dhaka Wasa', '01684686964', 'Mohakhali tb gate gp cha 209/2', NULL, NULL, NULL, NULL, NULL, 8, NULL, '2026-04-26 16:02:36', '2027-04-26 16:02:36', '2026-04-26 23:02:36', '2026-04-26 23:49:01'),
(88, 94, NULL, NULL, '1990-04-27', '5991352815', 'BUSINESS', '01642574696', 'GA-, Mohakhali, Dhaka-1213', NULL, NULL, NULL, NULL, NULL, 8, NULL, '2026-04-27 03:38:44', '2027-04-27 03:38:44', '2026-04-27 10:38:44', '2026-04-27 10:38:44'),
(89, 95, NULL, NULL, '1990-04-27', '1468290919', 'Assistant Manager, Medical Data Processor(Augmedix Bangladesh Ltd.)', '01784653525', 'House: G. P. GA-193, FLAT-B1 2ND FLOOR, Mohakhali school road, Mohakhali, Dhaka.', NULL, NULL, NULL, NULL, NULL, 8, NULL, '2026-04-27 09:05:27', '2027-04-27 09:05:27', '2026-04-27 16:05:27', '2026-04-27 16:05:27'),
(90, 96, NULL, NULL, '1988-05-05', '19912690421001104', 'Job Holder', '01759466888', '101/3, West Shewrapara', NULL, NULL, NULL, NULL, NULL, 8, NULL, '2026-05-05 03:18:16', '2027-05-05 03:18:16', '2026-05-05 10:18:16', '2026-05-05 10:18:16'),
(91, 97, NULL, NULL, '1996-03-25', '1961411764', 'Job', '01937348892', 'Brahmanbaria.', NULL, NULL, NULL, NULL, NULL, 8, NULL, '2026-05-06 11:12:15', '2027-05-06 11:12:15', '2026-05-06 18:12:15', '2026-05-06 18:26:03'),
(92, 98, 'member-photos/fn1lHXKvjhGAmhcs7PzzoPnw2ocrpnBEfBSIKXYm.jpg', NULL, '1994-06-16', '9139623111', 'Business', '01770675496', 'Ja #67/3B , Mohakhali, Wirelessgate,Dhaka 1212.', NULL, NULL, NULL, NULL, NULL, 8, NULL, '2026-05-08 09:38:04', '2027-05-08 09:38:04', '2026-05-08 16:38:04', '2026-05-08 18:29:00'),
(93, 99, NULL, NULL, '1974-01-01', '2809727155', 'Business', '01747221040', 'Road-17 House: 21.. NikenJo-z Khilkhet Dheka-1229', NULL, NULL, NULL, NULL, NULL, 7, NULL, '2026-05-08 17:51:56', '2046-05-08 17:51:56', '2026-05-09 00:51:56', '2026-05-09 00:51:56'),
(94, 100, NULL, NULL, '1989-05-09', '6421090827', 'Business', '+12342829343', 'America', NULL, NULL, NULL, NULL, NULL, 8, NULL, '2026-05-09 06:11:22', '2027-05-09 06:11:22', '2026-05-09 13:11:22', '2026-05-09 13:11:22'),
(95, 101, 'member-photos/6n3MuPvyshu1vyVQAXgeH5aBtvpOmjya8inX66jI.jpg', NULL, '1990-05-11', '2911860173683', 'Private Service', '01955599912', 'Dhaka', NULL, NULL, NULL, NULL, NULL, 8, NULL, '2026-05-11 13:56:08', '2027-05-11 13:56:08', '2026-05-11 20:56:08', '2026-05-11 21:36:22'),
(96, 102, 'member-photos/kHUwgDtwKC32i5aJvo6GqkZrNV7TMbGL7Rbj4gxg.jpg', NULL, '1994-09-23', '4152748440', 'Job Holder', '01918185425', 'Mohakhali,Wireless Gate,House: G.P.Cha-80,Dhaka-1212', 'https://www.facebook.com/share/1LGNRRm7tH/?mibextid=wwXIfr', NULL, NULL, NULL, 'https://youtube.com/@agdumbagdum7776?si=IwP7BN7Eg91bj9CJ', 8, NULL, '2026-05-11 14:14:48', '2027-05-11 14:14:48', '2026-05-11 21:14:48', '2026-05-11 21:54:36'),
(97, 103, 'member-photos/7uoPcv7b4gCENdjvFcln8G9e1YHhG0IUKwqYzIDQ.jpg', NULL, '1989-04-01', '3294681600', 'Job Holder', '01816056789', 'Dhaka', NULL, NULL, NULL, NULL, NULL, 8, NULL, '2026-05-11 16:12:05', '2027-05-11 16:12:05', '2026-05-11 23:12:05', '2026-05-11 23:19:25'),
(98, 104, 'member-photos/LtSScVwU6N9vTu7k8z1sD7MrFEW1DuWHKWn7Y30o.jpg', NULL, '1989-02-04', '5095869870', 'Private Service', '01817180523', 'Flat 5A, House 34,Road 10,Sector 10,Uttara, Dhaka.', NULL, NULL, NULL, NULL, NULL, 8, NULL, '2026-06-13 17:11:54', '2027-06-13 17:11:54', '2026-06-14 00:11:54', '2026-06-14 00:34:06'),
(99, 105, 'member-photos/Ct79Arblen2b2NiRPd1qax8dxeEtPjrcH1vOLePU.jpg', NULL, '1994-07-09', '1025114727', 'Job', '01962077670', 'Mohakhali, Hajari bai, Dhaka-1212.', NULL, NULL, NULL, NULL, NULL, 8, NULL, '2026-06-13 18:08:23', '2027-06-13 18:08:23', '2026-06-14 01:08:23', '2026-06-14 17:40:44');

-- --------------------------------------------------------

--
-- Table structure for table `vision_mission`
--

CREATE TABLE `vision_mission` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `vision` text DEFAULT NULL,
  `mission` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `vision_mission`
--

INSERT INTO `vision_mission` (`id`, `vision`, `mission`, `created_at`, `updated_at`) VALUES
(1, 'To be recognized as one of Bangladesh\'s most prestigious and well-governed premium social clubs.', 'Provide a high-standard social and business networking platform. Organize exclusive events, discussions, and cultural engagements. Promote professionalism, mutual respect, and community values among members.', '2026-02-14 01:01:53', '2026-02-14 01:01:53');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `about_us`
--
ALTER TABLE `about_us`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `admins_email_unique` (`email`);

--
-- Indexes for table `announcements`
--
ALTER TABLE `announcements`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `archives`
--
ALTER TABLE `archives`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `board_directors`
--
ALTER TABLE `board_directors`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_expiration_index` (`expiration`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_locks_expiration_index` (`expiration`);

--
-- Indexes for table `donations`
--
ALTER TABLE `donations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `donations_payment_method_id_foreign` (`payment_method_id`),
  ADD KEY `donations_donation_category_id_foreign` (`donation_category_id`);

--
-- Indexes for table `donation_categories`
--
ALTER TABLE `donation_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `event_registrations`
--
ALTER TABLE `event_registrations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `event_registrations_event_id_foreign` (`event_id`),
  ADD KEY `event_registrations_user_id_foreign` (`user_id`),
  ADD KEY `event_registrations_payment_method_id_foreign` (`payment_method_id`);

--
-- Indexes for table `expenses`
--
ALTER TABLE `expenses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `expenses_donation_category_id_foreign` (`donation_category_id`);

--
-- Indexes for table `facilities`
--
ALTER TABLE `facilities`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `honorary_members`
--
ALTER TABLE `honorary_members`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `inquiries`
--
ALTER TABLE `inquiries`
  ADD PRIMARY KEY (`id`),
  ADD KEY `inquiries_is_viewed_index` (`is_viewed`),
  ADD KEY `inquiries_ip_address_index` (`ip_address`),
  ADD KEY `inquiries_created_at_index` (`created_at`);

--
-- Indexes for table `invitations`
--
ALTER TABLE `invitations`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `invitations_invite_id_unique` (`invite_id`),
  ADD KEY `invitations_membership_category_id_foreign` (`membership_category_id`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `membership_applications`
--
ALTER TABLE `membership_applications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `membership_applications_membership_category_id_foreign` (`membership_category_id`),
  ADD KEY `membership_applications_status_index` (`status`),
  ADD KEY `membership_applications_email_status_index` (`email`,`status`),
  ADD KEY `membership_applications_mobile_status_index` (`mobile`,`status`),
  ADD KEY `membership_applications_payment_method_id_foreign` (`payment_method_id`),
  ADD KEY `membership_applications_payment_verified_by_admin_id_foreign` (`payment_verified_by_admin_id`);

--
-- Indexes for table `membership_categories`
--
ALTER TABLE `membership_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `membership_installments`
--
ALTER TABLE `membership_installments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `membership_installments_user_profile_id_foreign` (`user_profile_id`),
  ADD KEY `membership_installments_completed_by_admin_id_foreign` (`completed_by_admin_id`),
  ADD KEY `membership_installments_user_id_status_index` (`user_id`,`status`),
  ADD KEY `membership_installments_due_date_index` (`due_date`),
  ADD KEY `membership_installments_member_payment_method_id_foreign` (`member_payment_method_id`);

--
-- Indexes for table `membership_transactions`
--
ALTER TABLE `membership_transactions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `membership_transactions_membership_installment_id_foreign` (`membership_installment_id`),
  ADD KEY `membership_transactions_admin_id_foreign` (`admin_id`),
  ADD KEY `membership_transactions_user_id_status_index` (`user_id`,`status`),
  ADD KEY `membership_transactions_completed_by_index` (`completed_by`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `orders_user_id_foreign` (`user_id`),
  ADD KEY `orders_payment_method_id_foreign` (`payment_method_id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_items_order_id_foreign` (`order_id`),
  ADD KEY `order_items_product_id_foreign` (`product_id`);

--
-- Indexes for table `password_reset_otps`
--
ALTER TABLE `password_reset_otps`
  ADD PRIMARY KEY (`id`),
  ADD KEY `password_reset_otps_email_index` (`email`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `payment_methods`
--
ALTER TABLE `payment_methods`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `seo_settings`
--
ALTER TABLE `seo_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `site_settings`
--
ALTER TABLE `site_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `slideshow_banners`
--
ALTER TABLE `slideshow_banners`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tan_samitis`
--
ALTER TABLE `tan_samitis`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tan_samitis_created_by_admin_id_foreign` (`created_by_admin_id`);

--
-- Indexes for table `tan_samiti_draws`
--
ALTER TABLE `tan_samiti_draws`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `tan_samiti_draws_tan_samiti_id_cycle_number_unique` (`tan_samiti_id`,`cycle_number`),
  ADD UNIQUE KEY `tan_samiti_draws_tan_samiti_id_user_id_unique` (`tan_samiti_id`,`user_id`),
  ADD KEY `tan_samiti_draws_user_id_foreign` (`user_id`),
  ADD KEY `tan_samiti_draws_drawn_by_admin_id_foreign` (`drawn_by_admin_id`),
  ADD KEY `tan_samiti_draws_tan_samiti_id_index` (`tan_samiti_id`);

--
-- Indexes for table `tan_samiti_installments`
--
ALTER TABLE `tan_samiti_installments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tan_samiti_installments_member_payment_method_id_foreign` (`member_payment_method_id`),
  ADD KEY `tan_samiti_installments_completed_by_admin_id_foreign` (`completed_by_admin_id`),
  ADD KEY `tan_samiti_installments_tan_samiti_id_cycle_number_index` (`tan_samiti_id`,`cycle_number`),
  ADD KEY `tan_samiti_installments_user_id_status_index` (`user_id`,`status`),
  ADD KEY `tan_samiti_installments_due_date_index` (`due_date`),
  ADD KEY `tan_samiti_installments_rejected_by_admin_id_foreign` (`rejected_by_admin_id`);

--
-- Indexes for table `tan_samiti_members`
--
ALTER TABLE `tan_samiti_members`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `tan_samiti_members_tan_samiti_id_user_id_unique` (`tan_samiti_id`,`user_id`),
  ADD KEY `tan_samiti_members_user_id_foreign` (`user_id`),
  ADD KEY `tan_samiti_members_tan_samiti_id_status_index` (`tan_samiti_id`,`status`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `transactions_user_id_foreign` (`user_id`),
  ADD KEY `transactions_payment_method_id_foreign` (`payment_method_id`),
  ADD KEY `transactions_membership_application_id_foreign` (`membership_application_id`),
  ADD KEY `transactions_recorded_by_admin_id_foreign` (`recorded_by_admin_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `users_suspended_by_admin_id_foreign` (`suspended_by_admin_id`);

--
-- Indexes for table `user_profiles`
--
ALTER TABLE `user_profiles`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_profiles_membership_category_id_foreign` (`membership_category_id`),
  ADD KEY `user_profiles_user_id_index` (`user_id`),
  ADD KEY `user_profiles_membership_application_id_index` (`membership_application_id`);

--
-- Indexes for table `vision_mission`
--
ALTER TABLE `vision_mission`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `about_us`
--
ALTER TABLE `about_us`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `announcements`
--
ALTER TABLE `announcements`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `archives`
--
ALTER TABLE `archives`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `board_directors`
--
ALTER TABLE `board_directors`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `donations`
--
ALTER TABLE `donations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `donation_categories`
--
ALTER TABLE `donation_categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `event_registrations`
--
ALTER TABLE `event_registrations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `expenses`
--
ALTER TABLE `expenses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `facilities`
--
ALTER TABLE `facilities`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `honorary_members`
--
ALTER TABLE `honorary_members`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `inquiries`
--
ALTER TABLE `inquiries`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `invitations`
--
ALTER TABLE `invitations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `membership_applications`
--
ALTER TABLE `membership_applications`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `membership_categories`
--
ALTER TABLE `membership_categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `membership_installments`
--
ALTER TABLE `membership_installments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=754;

--
-- AUTO_INCREMENT for table `membership_transactions`
--
ALTER TABLE `membership_transactions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `password_reset_otps`
--
ALTER TABLE `password_reset_otps`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `payment_methods`
--
ALTER TABLE `payment_methods`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `seo_settings`
--
ALTER TABLE `seo_settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `site_settings`
--
ALTER TABLE `site_settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `slideshow_banners`
--
ALTER TABLE `slideshow_banners`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tan_samitis`
--
ALTER TABLE `tan_samitis`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tan_samiti_draws`
--
ALTER TABLE `tan_samiti_draws`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tan_samiti_installments`
--
ALTER TABLE `tan_samiti_installments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=187;

--
-- AUTO_INCREMENT for table `tan_samiti_members`
--
ALTER TABLE `tan_samiti_members`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=106;

--
-- AUTO_INCREMENT for table `user_profiles`
--
ALTER TABLE `user_profiles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=100;

--
-- AUTO_INCREMENT for table `vision_mission`
--
ALTER TABLE `vision_mission`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `donations`
--
ALTER TABLE `donations`
  ADD CONSTRAINT `donations_donation_category_id_foreign` FOREIGN KEY (`donation_category_id`) REFERENCES `donation_categories` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `donations_payment_method_id_foreign` FOREIGN KEY (`payment_method_id`) REFERENCES `payment_methods` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `expenses`
--
ALTER TABLE `expenses`
  ADD CONSTRAINT `expenses_donation_category_id_foreign` FOREIGN KEY (`donation_category_id`) REFERENCES `donation_categories` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `invitations`
--
ALTER TABLE `invitations`
  ADD CONSTRAINT `invitations_membership_category_id_foreign` FOREIGN KEY (`membership_category_id`) REFERENCES `membership_categories` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `membership_applications`
--
ALTER TABLE `membership_applications`
  ADD CONSTRAINT `membership_applications_membership_category_id_foreign` FOREIGN KEY (`membership_category_id`) REFERENCES `membership_categories` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `membership_applications_payment_method_id_foreign` FOREIGN KEY (`payment_method_id`) REFERENCES `payment_methods` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `membership_applications_payment_verified_by_admin_id_foreign` FOREIGN KEY (`payment_verified_by_admin_id`) REFERENCES `admins` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `membership_installments`
--
ALTER TABLE `membership_installments`
  ADD CONSTRAINT `membership_installments_completed_by_admin_id_foreign` FOREIGN KEY (`completed_by_admin_id`) REFERENCES `admins` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `membership_installments_member_payment_method_id_foreign` FOREIGN KEY (`member_payment_method_id`) REFERENCES `payment_methods` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `membership_installments_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `membership_installments_user_profile_id_foreign` FOREIGN KEY (`user_profile_id`) REFERENCES `user_profiles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `membership_transactions`
--
ALTER TABLE `membership_transactions`
  ADD CONSTRAINT `membership_transactions_admin_id_foreign` FOREIGN KEY (`admin_id`) REFERENCES `admins` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `membership_transactions_membership_installment_id_foreign` FOREIGN KEY (`membership_installment_id`) REFERENCES `membership_installments` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `membership_transactions_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_payment_method_id_foreign` FOREIGN KEY (`payment_method_id`) REFERENCES `payment_methods` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `orders_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `order_items_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`);

--
-- Constraints for table `transactions`
--
ALTER TABLE `transactions`
  ADD CONSTRAINT `transactions_membership_application_id_foreign` FOREIGN KEY (`membership_application_id`) REFERENCES `membership_applications` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `transactions_payment_method_id_foreign` FOREIGN KEY (`payment_method_id`) REFERENCES `payment_methods` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `transactions_recorded_by_admin_id_foreign` FOREIGN KEY (`recorded_by_admin_id`) REFERENCES `admins` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `transactions_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_suspended_by_admin_id_foreign` FOREIGN KEY (`suspended_by_admin_id`) REFERENCES `admins` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `user_profiles`
--
ALTER TABLE `user_profiles`
  ADD CONSTRAINT `user_profiles_membership_application_id_foreign` FOREIGN KEY (`membership_application_id`) REFERENCES `membership_applications` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `user_profiles_membership_category_id_foreign` FOREIGN KEY (`membership_category_id`) REFERENCES `membership_categories` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `user_profiles_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
