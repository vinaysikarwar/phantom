-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: May 09, 2015 at 06:00 AM
-- Server version: 5.6.21
-- PHP Version: 5.5.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `phantom`
--

-- --------------------------------------------------------

--
-- Table structure for table `email_confirmations`
--

CREATE TABLE IF NOT EXISTS `email_confirmations` (
`id` int(10) unsigned NOT NULL,
  `usersId` int(10) unsigned NOT NULL,
  `code` char(32) NOT NULL,
  `createdAt` int(10) unsigned NOT NULL,
  `modifiedAt` int(10) unsigned DEFAULT NULL,
  `confirmed` char(1) DEFAULT 'N'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `failed_logins`
--

CREATE TABLE IF NOT EXISTS `failed_logins` (
`id` int(10) unsigned NOT NULL,
  `usersId` int(10) unsigned DEFAULT NULL,
  `ipAddress` char(15) NOT NULL,
  `attempted` smallint(5) unsigned NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `password_changes`
--

CREATE TABLE IF NOT EXISTS `password_changes` (
`id` int(10) unsigned NOT NULL,
  `usersId` int(10) unsigned NOT NULL,
  `ipAddress` char(15) NOT NULL,
  `userAgent` varchar(48) NOT NULL,
  `createdAt` int(10) unsigned NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE IF NOT EXISTS `permissions` (
`id` int(10) unsigned NOT NULL,
  `profilesId` int(10) unsigned NOT NULL,
  `resource` varchar(16) NOT NULL,
  `action` varchar(16) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `profilesId`, `resource`, `action`) VALUES
(1, 3, 'users', 'index'),
(2, 3, 'users', 'search'),
(3, 3, 'profiles', 'index'),
(4, 3, 'profiles', 'search'),
(5, 1, 'users', 'index'),
(6, 1, 'users', 'search'),
(7, 1, 'users', 'edit'),
(8, 1, 'users', 'create'),
(9, 1, 'users', 'delete'),
(10, 1, 'users', 'changePassword'),
(11, 1, 'profiles', 'index'),
(12, 1, 'profiles', 'search'),
(13, 1, 'profiles', 'edit'),
(14, 1, 'profiles', 'create'),
(15, 1, 'profiles', 'delete'),
(16, 1, 'permissions', 'index'),
(17, 2, 'users', 'index'),
(18, 2, 'users', 'search'),
(19, 2, 'users', 'edit'),
(20, 2, 'users', 'create'),
(21, 2, 'profiles', 'index'),
(22, 2, 'profiles', 'search');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE IF NOT EXISTS `posts` (
`post_id` int(11) NOT NULL,
  `title` text NOT NULL,
  `short_description` text,
  `description` text NOT NULL,
  `author` varchar(100) NOT NULL,
  `url` varchar(255) NOT NULL,
  `featured_image` text,
  `allow_comment` tinyint(1) DEFAULT NULL,
  `meta_title` text,
  `meta_keywords` text,
  `meta_description` text,
  `custom_data` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `profiles`
--

CREATE TABLE IF NOT EXISTS `profiles` (
`id` int(10) unsigned NOT NULL,
  `name` varchar(64) NOT NULL,
  `active` char(1) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `profiles`
--

INSERT INTO `profiles` (`id`, `name`, `active`) VALUES
(1, 'Administrators', 'Y'),
(2, 'Users', 'Y'),
(3, 'Read-Only', 'Y');

-- --------------------------------------------------------

--
-- Table structure for table `remember_tokens`
--

CREATE TABLE IF NOT EXISTS `remember_tokens` (
`id` int(10) unsigned NOT NULL,
  `usersId` int(10) unsigned NOT NULL,
  `token` char(32) NOT NULL,
  `userAgent` varchar(120) NOT NULL,
  `createdAt` int(10) unsigned NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `reset_passwords`
--

CREATE TABLE IF NOT EXISTS `reset_passwords` (
`id` int(10) unsigned NOT NULL,
  `usersId` int(10) unsigned NOT NULL,
  `code` varchar(48) NOT NULL,
  `createdAt` int(10) unsigned NOT NULL,
  `modifiedAt` int(10) unsigned DEFAULT NULL,
  `reset` char(1) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `reset_passwords`
--

INSERT INTO `reset_passwords` (`id`, `usersId`, `code`, `createdAt`, `modifiedAt`, `reset`) VALUES
(1, 1, 'QNSknCSjsGfl9EFUMqAYFzxWnsd2JI', 1425301171, NULL, 'N'),
(2, 1, 'lY1n9WTOlUyPZe1soYDNTT61WrRI', 1425301583, NULL, 'N'),
(3, 1, '9mRfk19ePzTzmhN7Kfish4Iten0xWujk', 1425301661, NULL, 'N'),
(4, 1, 'yZAhwTeUwqzZc2A58GPuAGMOW7jF2Z', 1425301734, NULL, 'N'),
(5, 1, '94ZIc89RIRc2rqO4y7EDuXhWxvXFLm1R', 1425301743, NULL, 'N'),
(6, 1, 'bUClLlkuIzuMKyVIwYC1F64E997fmYn', 1425301749, NULL, 'N'),
(7, 1, 'haWzf7lHj85YhqPYUEMAOoFAMkW9e', 1425301755, NULL, 'N'),
(8, 1, 'qvS370fCdsExiz9uHbW2yROiALUuiXgD', 1425301781, NULL, 'N'),
(9, 1, '24nW0gvWOtje2GGBCHb4ahSw4BrTz5GB', 1425301834, NULL, 'N'),
(10, 1, 'ij2AfsHNreSJwhThS6tnEcxMvwinRb', 1425301851, NULL, 'N'),
(11, 1, 'NIg3b5Tkpmn0Q1XjueKry0lf2CiYwB', 1425301857, NULL, 'N'),
(12, 1, 'vpPF4dmRFlvPLwa1jh9yzW7LbTShfLP', 1425301880, NULL, 'N'),
(13, 1, 'UxHKlx231vIRxD1iG0KEMmEAN19m4hHH', 1425301925, NULL, 'N'),
(14, 1, 'A2XEdG8pbgudpPCXjDXegGu9H8r8NBoz', 1425301971, NULL, 'N'),
(15, 1, '8Syl7ptBSD5QC0Iog6pJOYypYUIcB5', 1425301986, NULL, 'N'),
(16, 1, 'Dtf3TOGZU6vREShpCSME8gYfiG5mjnb2', 1425301991, NULL, 'N'),
(17, 1, 'RHssvtGbzfhS4loHG6YTymrvl2mIrQ', 1425302058, NULL, 'N'),
(18, 1, 'CbvdyxjETnEz3gmE3Mp7ZVYH4KNGC', 1425437277, 1425437286, 'N'),
(19, 1, '9vdLuLGyhVmjDpIEls4dx8xjyb0B2uYr', 1425437329, NULL, 'N'),
(20, 1, 'zQ9HbttL0o9Pw2cCi6LX7kRqswYCJzKd', 1425437396, NULL, 'N'),
(21, 3, 'gpr4YhpovCPgmTo0WdKG0mJMMr2Fcv1', 1425437734, 1425437747, 'N'),
(22, 3, 'GcSpW082lFUZdTDQa3ctCYuOb4oB', 1426052406, 1426052475, 'N'),
(23, 1, 'arYLSNBLs2bxKLVbDkjETLXnxVczjsTQ', 1427894400, NULL, 'N'),
(24, 10, 'xt0dxzX2X4oSv5TlCgkfc4gdXBzn3R', 1431143103, NULL, 'N'),
(25, 10, 'vTPWndvvQmsIfxx6QPeHfcz6ql0s9Bk', 1431143268, NULL, 'N'),
(26, 10, 'yMEynPBILsAZ2HnbwnkrHtavadPVxe5', 1431143309, NULL, 'N'),
(27, 10, '8nG0S2mWzQ240nY4oyNavQAqDefISF', 1431143336, 1431143351, 'N');

-- --------------------------------------------------------

--
-- Table structure for table `success_logins`
--

CREATE TABLE IF NOT EXISTS `success_logins` (
`id` int(10) unsigned NOT NULL,
  `usersId` int(10) unsigned NOT NULL,
  `ipAddress` char(15) NOT NULL,
  `userAgent` varchar(120) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
`id` int(10) unsigned NOT NULL,
  `username` varchar(40) NOT NULL,
  `email` varchar(40) NOT NULL,
  `password` char(60) NOT NULL,
  `mustChangePassword` char(1) DEFAULT NULL,
  `active` char(1) DEFAULT NULL,
  `firstname` varchar(100) DEFAULT NULL,
  `lastname` varchar(100) DEFAULT NULL,
  `old_password` varchar(100) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users_address`
--

CREATE TABLE IF NOT EXISTS `users_address` (
`address_id` int(20) unsigned NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `company` varchar(255) NOT NULL,
  `telephone` int(20) NOT NULL,
  `street` tinytext NOT NULL,
  `city` varchar(150) NOT NULL,
  `state` varchar(255) NOT NULL,
  `zip` int(20) NOT NULL,
  `default_billing` tinyint(1) DEFAULT NULL,
  `default_shipping` tinyint(1) DEFAULT NULL,
  `country` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `email_confirmations`
--
ALTER TABLE `email_confirmations`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_logins`
--
ALTER TABLE `failed_logins`
 ADD PRIMARY KEY (`id`), ADD KEY `usersId` (`usersId`);

--
-- Indexes for table `password_changes`
--
ALTER TABLE `password_changes`
 ADD PRIMARY KEY (`id`), ADD KEY `usersId` (`usersId`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
 ADD PRIMARY KEY (`id`), ADD KEY `profilesId` (`profilesId`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
 ADD PRIMARY KEY (`post_id`), ADD UNIQUE KEY `url` (`url`);

--
-- Indexes for table `profiles`
--
ALTER TABLE `profiles`
 ADD PRIMARY KEY (`id`), ADD KEY `active` (`active`);

--
-- Indexes for table `remember_tokens`
--
ALTER TABLE `remember_tokens`
 ADD PRIMARY KEY (`id`), ADD KEY `token` (`token`);

--
-- Indexes for table `reset_passwords`
--
ALTER TABLE `reset_passwords`
 ADD PRIMARY KEY (`id`), ADD KEY `usersId` (`usersId`);

--
-- Indexes for table `success_logins`
--
ALTER TABLE `success_logins`
 ADD PRIMARY KEY (`id`), ADD KEY `usersId` (`usersId`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `unique_email` (`email`), ADD UNIQUE KEY `unique_username` (`username`);

--
-- Indexes for table `users_address`
--
ALTER TABLE `users_address`
 ADD PRIMARY KEY (`address_id`), ADD KEY `fk_user_id` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `email_confirmations`
--
ALTER TABLE `email_confirmations`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `failed_logins`
--
ALTER TABLE `failed_logins`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `password_changes`
--
ALTER TABLE `password_changes`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=23;
--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
MODIFY `post_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `profiles`
--
ALTER TABLE `profiles`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `remember_tokens`
--
ALTER TABLE `remember_tokens`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `reset_passwords`
--
ALTER TABLE `reset_passwords`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=28;
--
-- AUTO_INCREMENT for table `success_logins`
--
ALTER TABLE `success_logins`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `users_address`
--
ALTER TABLE `users_address`
MODIFY `address_id` int(20) unsigned NOT NULL AUTO_INCREMENT;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `users_address`
--
ALTER TABLE `users_address`
ADD CONSTRAINT `users_address_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
