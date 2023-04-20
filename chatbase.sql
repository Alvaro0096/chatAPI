DROP DATABASE IF EXISTS `chatbase`;
CREATE DATABASE `chatbase` /*!40100 DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci */;
USE `chatbase`;

-- chatbase.users definition
DROP TABLE IF EXISTS `chatbase`.`users`;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `reference` int(11) NOT NULL DEFAULT 0,
  `username` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `profilePicture` varchar(100) DEFAULT NULL,
  `enabled` int(11) NOT NULL DEFAULT 1 COMMENT '1 = enabled, 0 = disabled',
  `online` tinyint(1) NOT NULL DEFAULT 0,
  `dateCreated` datetime NOT NULL DEFAULT current_timestamp(),
  `dateDisabled` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `username` (`username`),
  KEY `email` (`email`)
) ENGINE=InnoDB;

-- chatbase.messages definition
DROP TABLE IF EXISTS `chatbase`.`messages`;
CREATE TABLE `messages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `senderMessage` int(11) NOT NULL,
  `receiverMessage` int(11) NOT NULL,
  `message` varchar(500) DEFAULT NULL,
  `dateSend` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `senderMessage` (`senderMessage`),
  KEY `receiverMessage` (`receiverMessage`)
) ENGINE=InnoDB;