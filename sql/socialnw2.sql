-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Nov 19, 2019 at 02:39 AM
-- Server version: 10.1.30-MariaDB
-- PHP Version: 7.2.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `socialnw2`
--

-- --------------------------------------------------------

--
-- Table structure for table `chat_messages`
--

DROP TABLE IF EXISTS `chat_messages`;
CREATE TABLE IF NOT EXISTS `chat_messages` (
  `chatmsg_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `sender_member_id` int(10) UNSIGNED NOT NULL,
  `receiver_id` int(10) UNSIGNED NOT NULL COMMENT 'depends upon type, 0:memberid,1:strangerid,2:groupid,3:roomid',
  `message_type` set('0','1','2','3') DEFAULT '0',
  `message_body` mediumtext,
  `created_at` datetime DEFAULT NULL,
  PRIMARY KEY (`chatmsg_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

DROP TABLE IF EXISTS `groups`;
CREATE TABLE IF NOT EXISTS `groups` (
  `group_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `group_name` varchar(100) NOT NULL,
  `group_owner` bigint(20) UNSIGNED NOT NULL,
  `parent_groupid` bigint(20) UNSIGNED NOT NULL DEFAULT '0',
  `level1_groupid` bigint(20) UNSIGNED NOT NULL DEFAULT '0',
  `group_type` tinyint(3) UNSIGNED NOT NULL COMMENT '1:PageorGroup,2:ChatGroup',
  `group_level` tinyint(3) UNSIGNED NOT NULL DEFAULT '0',
  PRIMARY KEY (`group_id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `group_members`
--

DROP TABLE IF EXISTS `group_members`;
CREATE TABLE IF NOT EXISTS `group_members` (
  `groupmember_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `group_id` int(11) NOT NULL,
  `member_id` int(11) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  PRIMARY KEY (`groupmember_id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `members`
--

DROP TABLE IF EXISTS `members`;
CREATE TABLE IF NOT EXISTS `members` (
  `member_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(40) NOT NULL,
  `email` varchar(35) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  PRIMARY KEY (`member_id`),
  UNIQUE KEY `email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `member_friends`
--

DROP TABLE IF EXISTS `member_friends`;
CREATE TABLE IF NOT EXISTS `member_friends` (
  `prime_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `member_id` int(11) NOT NULL,
  `friend_id` int(11) NOT NULL COMMENT 'friend id is also member id',
  `invite_status` tinyint(3) UNSIGNED NOT NULL DEFAULT '0' COMMENT '0:invitation_sent,1:approved',
  `created_at` datetime DEFAULT NULL,
  PRIMARY KEY (`prime_id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

DROP TABLE IF EXISTS `posts`;
CREATE TABLE IF NOT EXISTS `posts` (
  `posts_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `posts_owner` bigint(20) NOT NULL COMMENT 'member_id',
  `group_id` bigint(20) NOT NULL DEFAULT '0',
  `post_title` varchar(255) NOT NULL,
  `post_content` mediumtext,
  PRIMARY KEY (`posts_id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
