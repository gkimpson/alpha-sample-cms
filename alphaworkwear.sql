-- phpMyAdmin SQL Dump
-- version 3.4.5
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jan 14, 2013 at 01:42 AM
-- Server version: 5.5.16
-- PHP Version: 5.3.8

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `alphaworkwear`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE IF NOT EXISTS `categories` (
  `id` mediumint(11) unsigned NOT NULL AUTO_INCREMENT,
  `page_title` varchar(255) NOT NULL,
  `meta_description` varchar(255) NOT NULL,
  `meta_keywords` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `rank` mediumint(11) unsigned NOT NULL DEFAULT '0',
  `deleted` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `page_title`, `meta_description`, `meta_keywords`, `title`, `description`, `rank`, `deleted`, `created_at`, `updated_at`) VALUES
(1, '', '', '', 'PPE', '', 0, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(2, '1', '1', '1', 'Footwear', '<p>\r\n 11</p>\r\n', 10, 0, '0000-00-00 00:00:00', '2012-11-25 16:32:17'),
(3, '', '', '', 'High Visibility', '', 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(4, '', '', '', 'Leisure', '', 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(5, '', '', '', 'Outwear', '', 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(6, '', '', '', 'Workwear', '', 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(7, '', '', '', 'Hospitality', '', 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(8, '', '', '', 'Corporate Wear', '', 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `configs`
--

CREATE TABLE IF NOT EXISTS `configs` (
  `id` mediumint(11) unsigned NOT NULL AUTO_INCREMENT,
  `key` varchar(255) NOT NULL,
  `value` varchar(255) NOT NULL,
  `deleted` tinyint(1) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `configs`
--

INSERT INTO `configs` (`id`, `key`, `value`, `deleted`, `created_at`, `updated_at`) VALUES
(1, 'email', 'gkimpson@gmail.com', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

CREATE TABLE IF NOT EXISTS `groups` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `description` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `groups`
--

INSERT INTO `groups` (`id`, `name`, `description`) VALUES
(1, 'admin', 'Administrator'),
(2, 'members', 'General User');

-- --------------------------------------------------------

--
-- Table structure for table `login_attempts`
--

CREATE TABLE IF NOT EXISTS `login_attempts` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `ip_address` varbinary(16) NOT NULL,
  `login` varchar(100) NOT NULL,
  `time` int(11) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

CREATE TABLE IF NOT EXISTS `pages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) NOT NULL,
  `slug` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `meta_description` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `meta_keywords` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `page_title` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `h1` varchar(64) COLLATE latin1_general_ci NOT NULL,
  `link_text` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `content` text COLLATE latin1_general_ci,
  `online` tinyint(1) NOT NULL DEFAULT '0',
  `rank` mediumint(11) NOT NULL DEFAULT '0',
  `deleted` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` datetime DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=4 ;

--
-- Dumping data for table `pages`
--

INSERT INTO `pages` (`id`, `parent_id`, `slug`, `meta_description`, `meta_keywords`, `page_title`, `h1`, `link_text`, `content`, `online`, `rank`, `deleted`, `created_at`, `updated_at`) VALUES
(1, 0, 'test', 'test', 'test', 'test', 'test', 'test', '', 0, 3423, 0, '0000-00-00 00:00:00', '2012-11-25 18:47:35'),
(3, 0, 'mypage', 'mypage', 'sada', 'mypage', '', '', '<p>\r\n <img alt="" src="http://localhost/alphaworkwear-direct/kcfinder/upload/images/gav-ninja(2).jpg"  299px; height: 333px;" /></p>\r\n', 0, 0, 0, '0000-00-00 00:00:00', '2012-11-25 19:15:45');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE IF NOT EXISTS `products` (
  `id` mediumint(11) unsigned NOT NULL AUTO_INCREMENT,
  `category_id` mediumint(11) unsigned NOT NULL,
  `page_title` varchar(255) NOT NULL,
  `meta_description` varchar(255) NOT NULL,
  `meta_keywords` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `title` varchar(255) NOT NULL,
  `price` double(6,2) NOT NULL,
  `hits` mediumint(11) unsigned NOT NULL DEFAULT '0',
  `is_featured` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `deleted` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `category_id`, `page_title`, `meta_description`, `meta_keywords`, `description`, `title`, `price`, `hits`, `is_featured`, `deleted`, `created_at`, `updated_at`) VALUES
(1, 1, '', '', '', '<p>\r\n <img alt="" src="http://nbaschedule2013.com/wp-content/uploads/2012/10/nba.jpg"  1024px; height: 768px;" /></p>\r\n', 'shirt', 0.00, 0, 0, 1, '2012-11-22 17:49:27', '2012-11-27 00:29:08'),
(2, 1, '', '', '', '<p>\r\n <img alt="" src="http://nbaschedule2013.com/wp-content/uploads/2012/10/nba.jpg"  1024px; height: 768px;" /></p>\r\n', 'SHOOOOES', 0.00, 0, 0, 1, '2012-11-22 17:50:18', '2012-11-27 00:29:44'),
(3, 2, 'Page Title', 'Desc.', 'nurses, hospitals', '', 'Nurse Outfit', 0.00, 0, 0, 0, '2012-11-22 17:53:07', '2012-11-28 00:09:25'),
(4, 2, 'aa', '', '', '', '1', 0.00, 0, 0, 1, '2012-11-22 17:59:07', '2012-11-28 00:26:21'),
(5, 1, '', '', '', '', 'HEL', 121.00, 0, 0, 1, '2012-11-22 19:28:22', '2012-11-22 19:28:22');

-- --------------------------------------------------------

--
-- Table structure for table `site_settings`
--

CREATE TABLE IF NOT EXISTS `site_settings` (
  `id` mediumint(11) unsigned NOT NULL AUTO_INCREMENT,
  `config_key` varchar(255) NOT NULL,
  `config_value` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `site_settings`
--

INSERT INTO `site_settings` (`id`, `config_key`, `config_value`, `created_at`, `updated_at`) VALUES
(1, 'website_name', 'Alpha Workwear Direct', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(2, 'default_email_address', 'gkimpson@gmail.com', '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `ip_address` varbinary(16) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(80) NOT NULL,
  `salt` varchar(40) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `activation_code` varchar(40) DEFAULT NULL,
  `forgotten_password_code` varchar(40) DEFAULT NULL,
  `forgotten_password_time` int(11) unsigned DEFAULT NULL,
  `remember_code` varchar(40) DEFAULT NULL,
  `created_on` int(11) unsigned NOT NULL,
  `last_login` int(11) unsigned DEFAULT NULL,
  `active` tinyint(1) unsigned DEFAULT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `company` varchar(100) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `ip_address`, `username`, `password`, `salt`, `email`, `activation_code`, `forgotten_password_code`, `forgotten_password_time`, `remember_code`, `created_on`, `last_login`, `active`, `first_name`, `last_name`, `company`, `phone`) VALUES
(1, '\0\0', 'administrator', '59beecdf7fc966e2f17fd8f65a4a9aeb09d4a3d4', '9462e8eee0', 'admin@admin.com', '', NULL, NULL, NULL, 1268889823, 1358106844, 1, 'Admin', 'istrator', 'ADMIN', '0');

-- --------------------------------------------------------

--
-- Table structure for table `users_groups`
--

CREATE TABLE IF NOT EXISTS `users_groups` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` mediumint(8) unsigned NOT NULL,
  `group_id` mediumint(8) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `users_groups`
--

INSERT INTO `users_groups` (`id`, `user_id`, `group_id`) VALUES
(1, 1, 1),
(2, 1, 2);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
