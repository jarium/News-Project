-- Adminer 4.8.1 MySQL 5.5.5-10.6.4-MariaDB-1:10.6.4+maria~focal dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

SET NAMES utf8mb4;

DROP TABLE IF EXISTS `comments`;
CREATE TABLE `comments` (
  `_id` int(255) NOT NULL AUTO_INCREMENT,
  `news_id` int(32) NOT NULL,
  `commenter_id` int(32) NOT NULL,
  `commenter_username` varchar(255) NOT NULL,
  `comment` varchar(8000) NOT NULL,
  `create_date` datetime NOT NULL DEFAULT current_timestamp(),
  `isAnon` tinyint(4) NOT NULL DEFAULT 0,
  `update_date` datetime DEFAULT NULL,
  `isDeleted` tinyint(4) NOT NULL DEFAULT 0,
  `delete_date` datetime DEFAULT NULL,
  PRIMARY KEY (`_id`),
  KEY `commenter_id` (`commenter_id`),
  KEY `news_id` (`news_id`),
  CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`commenter_id`) REFERENCES `users` (`_id`),
  CONSTRAINT `comments_ibfk_2` FOREIGN KEY (`news_id`) REFERENCES `news` (`_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


DROP TABLE IF EXISTS `editor_categories`;
CREATE TABLE `editor_categories` (
  `_id` int(11) NOT NULL AUTO_INCREMENT,
  `editor_id` int(32) NOT NULL,
  `editor_username` varchar(255) NOT NULL,
  `science` tinyint(4) NOT NULL DEFAULT 0,
  `technology` tinyint(4) NOT NULL DEFAULT 0,
  `health` tinyint(4) NOT NULL DEFAULT 0,
  `political` tinyint(4) NOT NULL DEFAULT 0,
  `world` tinyint(4) NOT NULL DEFAULT 0,
  `economy` tinyint(4) NOT NULL DEFAULT 0,
  `sports` tinyint(4) NOT NULL DEFAULT 0,
  `art` tinyint(4) NOT NULL DEFAULT 0,
  `education` tinyint(4) NOT NULL DEFAULT 0,
  `social` tinyint(4) NOT NULL DEFAULT 0,
  PRIMARY KEY (`_id`),
  KEY `editor_id` (`editor_id`),
  CONSTRAINT `editor_categories_ibfk_1` FOREIGN KEY (`editor_id`) REFERENCES `users` (`_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


DROP TABLE IF EXISTS `news`;
CREATE TABLE `news` (
  `_id` int(32) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `content` longtext NOT NULL,
  `image` varchar(2048) NOT NULL,
  `author_id` int(32) NOT NULL,
  `author_username` varchar(255) NOT NULL,
  `category` varchar(32) NOT NULL,
  `create_date` datetime NOT NULL DEFAULT current_timestamp(),
  `update_date` datetime DEFAULT NULL,
  `isDeleted` tinyint(4) NOT NULL DEFAULT 0,
  `delete_date` datetime DEFAULT NULL,
  PRIMARY KEY (`_id`),
  KEY `author_id` (`author_id`),
  CONSTRAINT `news_ibfk_2` FOREIGN KEY (`author_id`) REFERENCES `users` (`_id`) ON DELETE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `_id` int(32) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL DEFAULT 'user',
  `science` tinyint(4) NOT NULL DEFAULT 0,
  `health` tinyint(4) NOT NULL DEFAULT 0,
  `political` tinyint(4) NOT NULL DEFAULT 0,
  `technology` tinyint(4) NOT NULL DEFAULT 0,
  `world` tinyint(4) NOT NULL DEFAULT 0,
  `economy` tinyint(4) NOT NULL DEFAULT 0,
  `sports` tinyint(4) NOT NULL DEFAULT 0,
  `art` tinyint(4) NOT NULL DEFAULT 0,
  `education` tinyint(4) NOT NULL DEFAULT 0,
  `social` tinyint(4) NOT NULL DEFAULT 0,
  `create_date` datetime NOT NULL DEFAULT current_timestamp(),
  `isDeleted` tinyint(4) NOT NULL DEFAULT 0,
  `delete_date` datetime DEFAULT NULL,
  PRIMARY KEY (`_id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


DROP TABLE IF EXISTS `users_read_news`;
CREATE TABLE `users_read_news` (
  `_id` int(255) NOT NULL AUTO_INCREMENT,
  `users_id` int(32) NOT NULL,
  `news_id` int(32) NOT NULL,
  `read_date` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`_id`),
  KEY `users_id` (`users_id`),
  KEY `news_id` (`news_id`),
  CONSTRAINT `users_read_news_ibfk_1` FOREIGN KEY (`users_id`) REFERENCES `users` (`_id`),
  CONSTRAINT `users_read_news_ibfk_3` FOREIGN KEY (`news_id`) REFERENCES `news` (`_id`) ON DELETE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


-- 2021-10-12 21:17:02
