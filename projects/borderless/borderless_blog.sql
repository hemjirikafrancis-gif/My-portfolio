-- phpMyAdmin SQL Dump
-- version 5.2.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Aug 05, 2026 at 02:30 PM
-- Server version: 8.4.7
-- PHP Version: 8.3.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `borderless_blog`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

DROP TABLE IF EXISTS `admins`;
CREATE TABLE IF NOT EXISTS `admins` (
  `id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(60) NOT NULL,
  `password` varchar(255) NOT NULL,
  `full_name` varchar(120) NOT NULL DEFAULT 'Administrator',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `username`, `password`, `full_name`, `created_at`) VALUES
(1, 'admin', '$2y$12$nN/Y3VkKzv.Fjrlqk6Vn2eEo4Aqt11GIibbTsePMXBctogLdvny92', 'Borderless Administrator', '2026-08-05 12:40:46');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
CREATE TABLE IF NOT EXISTS `categories` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(80) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`) VALUES
(1, 'AI & Automation'),
(2, 'Business Analysis'),
(3, 'Data Analytics'),
(4, 'Financial Analysis'),
(5, 'Strategy'),
(6, 'Technology');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

DROP TABLE IF EXISTS `posts`;
CREATE TABLE IF NOT EXISTS `posts` (
  `id` int NOT NULL AUTO_INCREMENT,
  `title` varchar(200) NOT NULL,
  `slug` varchar(220) NOT NULL,
  `category_id` int DEFAULT NULL,
  `author` varchar(120) NOT NULL DEFAULT 'Borderless Analysts Team',
  `image` varchar(255) DEFAULT NULL,
  `content` longtext NOT NULL,
  `featured` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `slug` (`slug`),
  KEY `fk_post_cat` (`category_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `title`, `slug`, `category_id`, `author`, `image`, `content`, `featured`, `created_at`, `updated_at`) VALUES
(1, 'The AI Revolution in Business: How Intelligent Automation Is Reshaping Industries', 'ai-revolution-in-business', 1, 'Borderless Analysts Team', 'images/img-1.png', 'Artificial intelligence is no longer a futuristic concept — it is here, and it is transforming how businesses operate, compete and grow.\r\n\r\nAt Borderless Analysts we help organisations move from AI curiosity to AI capability. The first step is never the technology; it is the process. We map how work actually flows through a business, identify the repetitive, rules-based tasks that drain analyst hours, and only then introduce automation where it produces measurable return.\r\n\r\nThree patterns deliver the fastest value:\r\n\r\n1. Document intelligence — invoices, contracts and reports are read, classified and summarised automatically, cutting turnaround times from days to minutes.\r\n2. Forecasting copilots — machine learning models sit alongside finance teams, flagging anomalies in cash flow and revenue trends before they become problems.\r\n3. Customer operations — intelligent routing and drafted responses free service teams to handle the conversations that genuinely need a human.\r\n\r\nThe organisations winning with AI are not the ones spending the most. They are the ones with clean data, clear ownership and a disciplined roadmap. Start narrow, measure honestly, and scale what works.', 1, '2026-08-05 12:25:12', '2026-08-05 12:25:12'),
(2, 'Building a Data-Driven Culture: Beyond Dashboards and Reports', 'building-a-data-driven-culture', 3, 'Borderless Analysts Team', 'images/img-9.jpg', 'Most organisations already have data. Very few have a data culture.\r\n\r\nA dashboard nobody opens is not analytics — it is decoration. A genuinely data-driven organisation is one where decisions at every level are routinely defended with evidence, and where being proven wrong by the numbers is normal rather than embarrassing.\r\n\r\nIn our engagements across Africa, Europe and the Middle East, four ingredients consistently separate the leaders from the laggards:\r\n\r\n• A single source of truth. One agreed definition of revenue, one agreed definition of an active customer. Ambiguity kills trust in reporting faster than bad data does.\r\n• Data literacy at the middle. Executives sponsor analytics, but middle managers make or break it. Train them to read a distribution, not just a total.\r\n• Decision rituals. Weekly reviews where a metric owner explains movement, not a slide deck that presents good news only.\r\n• Feedback loops. Every major decision is revisited against outcomes so the organisation learns.\r\n\r\nTechnology is the easiest part of this journey. Behaviour is the work.', 0, '2026-08-05 12:25:12', '2026-08-05 12:25:12'),
(3, 'Financial Forecasting in Uncertain Times: A Practical Framework', 'financial-forecasting-in-uncertain-times', 4, 'Borderless Analysts Team', 'images/img-12.jpeg', 'Volatile exchange rates, shifting interest rates and unpredictable supply chains have made the traditional annual budget close to obsolete.\r\n\r\nWe advise clients to replace the single-point annual forecast with a rolling scenario model, refreshed monthly and built around three disciplined layers.\r\n\r\nLayer one: drivers, not line items. Model the handful of variables that genuinely move your business — volume, price, FX, input cost, headcount — instead of forecasting a hundred general ledger accounts.\r\n\r\nLayer two: scenarios with triggers. Build a base, a downside and an upside case, and attach an observable trigger to each one. When the trigger fires, the plan changes automatically instead of waiting for the next board meeting.\r\n\r\nLayer three: cash first. Profit is an opinion, cash is a fact. Every scenario must translate into a thirteen-week cash view that treasury can act on.\r\n\r\nCompanies that adopt rolling forecasts typically cut planning cycle time by half while significantly improving accuracy. The goal is not to predict the future perfectly — it is to be ready for more than one version of it.', 0, '2026-08-05 12:25:12', '2026-08-05 12:25:12');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `posts`
--
ALTER TABLE `posts` ADD FULLTEXT KEY `ft_search` (`title`,`content`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `fk_post_cat` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
