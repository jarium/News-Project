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

INSERT INTO `comments` (`_id`, `news_id`, `commenter_id`, `commenter_username`, `comment`, `create_date`, `isAnon`, `update_date`, `isDeleted`, `delete_date`) VALUES
(30,	9,	1,	'admin',	'Bence güzell',	'2021-10-04 18:15:35',	0,	'2021-10-09 19:37:23',	0,	'2021-10-07 22:06:15'),
(32,	9,	1,	'admin',	'kesme',	'2021-10-04 20:36:41',	1,	'2021-10-10 00:28:05',	0,	'2021-10-10 00:28:21'),
(33,	12,	1,	'admin',	'Hayırlı olsun',	'2021-10-07 23:17:09',	1,	NULL,	0,	NULL),
(34,	12,	1,	'admin',	'Evet',	'2021-10-07 23:17:11',	0,	NULL,	0,	NULL),
(35,	12,	17,	'fkjdsfjsdfj',	'abi telefon ne alaka',	'2021-10-07 23:42:03',	0,	'2021-10-09 20:12:09',	1,	'2021-10-10 16:58:23'),
(36,	7,	17,	'fkjdsfjsdfj',	'bu ne ya okunmuyor',	'2021-10-07 23:42:25',	0,	NULL,	1,	'2021-10-07 23:49:37'),
(37,	11,	17,	'fkjdsfjsdfj',	'şokella bile lüks oldu :(',	'2021-10-07 23:44:43',	0,	NULL,	1,	'2021-10-07 23:49:37'),
(38,	6,	17,	'fkjdsfjsdfj',	'abi bu nece',	'2021-10-07 23:45:07',	0,	NULL,	1,	'2021-10-07 23:49:37'),
(39,	6,	17,	'fkjdsfjsdfj',	'Filipince kardeşim. :))',	'2021-10-07 23:45:18',	1,	NULL,	1,	'2021-10-07 23:49:37'),
(40,	6,	17,	'fkjdsfjsdfj',	'(idx yanlış yazılmış',	'2021-10-07 23:45:36',	1,	NULL,	1,	'2021-10-07 23:49:37'),
(41,	10,	17,	'fkjdsfjsdfj',	'bıktım şu telefondan !!! :)) ://',	'2021-10-07 23:46:20',	1,	NULL,	1,	'2021-10-07 23:49:37'),
(42,	11,	1,	'admin',	'Sevmedim',	'2021-10-09 19:38:23',	0,	NULL,	0,	NULL),
(43,	11,	1,	'admin',	'Ne',	'2021-10-09 19:38:26',	0,	NULL,	0,	NULL),
(44,	11,	1,	'admin',	'xcv',	'2021-10-09 19:38:56',	0,	NULL,	0,	NULL),
(45,	11,	1,	'admin',	'Anonim',	'2021-10-09 19:39:52',	1,	NULL,	0,	NULL),
(46,	11,	1,	'admin',	'What',	'2021-10-09 19:39:58',	0,	NULL,	0,	NULL),
(47,	11,	1,	'admin',	'fgdffgdsdfsggffgdfgdsgfdsdsfggdfgdfsdfgsdsfgdsfgdfsgfsdgfgsddfsgfsgddfgsdfsgdsfgfdsgfdsgfsgdfdsgfdsgdsfgdsfgfdsgfdsgdfsgdfsgdsfgdfsgdfsgdfsgdfsgdsfgdfsgdfsgdfsgdfsgdfsgdfsg',	'2021-10-09 19:41:33',	0,	NULL,	0,	NULL),
(48,	11,	1,	'admin',	'fgdffgdsdfsggffgdfgdsgfdsdsfggdfgdfsdfgsdsfgdsfgdfsgfsdgfgsddfsgfsgddfgsdfsgdsfgfdsgfdsgfsgdfdsgfdsgdsfgdsfgfdsgfdsgdfsgdfsgdsfgdfsgdfsgdfsgdfsgdsfgdfsgdfsgdfsgdfsgdfsgdfsgfgdffgdsdfsggffgdfgdsgfdsdsfggdfgdfsdfgsdsfgdsfgdfsgfsdgfgsddfsgfsgddfgsdfsgdsfgfdsgfdsgfsgdfdsgfdsgdsfgdsfgfdsgfdsgdfsgdfsgdsfgdfsgdfsgdfsgdfsgdsfgdfsgdfsgdfsgdfsgdfsgdfsg',	'2021-10-09 19:41:40',	0,	NULL,	1,	'2021-10-10 17:14:46'),
(49,	22,	4,	'egebuyuk',	'güzelmiş',	'2021-10-10 16:13:51',	0,	NULL,	0,	NULL),
(50,	22,	4,	'egebuyuk',	'Güzel',	'2021-10-10 16:14:01',	1,	NULL,	0,	NULL),
(51,	20,	4,	'egebuyuk',	'ne',	'2021-10-10 16:21:52',	0,	NULL,	0,	NULL),
(52,	26,	1,	'admin',	'asdjasd',	'2021-10-10 21:12:46',	0,	NULL,	0,	NULL),
(53,	26,	1,	'admin',	'dfsdfsdfsadfa',	'2021-10-10 21:12:49',	1,	'2021-10-11 00:22:41',	1,	'2021-10-11 00:22:44');

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

INSERT INTO `editor_categories` (`_id`, `editor_id`, `editor_username`, `science`, `technology`, `health`, `political`, `world`, `economy`, `sports`, `art`, `education`, `social`) VALUES
(19,	3,	'efebuyuk',	1,	0,	1,	0,	0,	0,	0,	0,	0,	0),
(21,	4,	'egebuyuk',	1,	0,	1,	0,	0,	0,	0,	0,	0,	0),
(22,	12,	'sdfsdfsdf',	0,	0,	0,	0,	0,	0,	0,	0,	0,	0);

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
  CONSTRAINT `news_ibfk_1` FOREIGN KEY (`author_id`) REFERENCES `users` (`_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `news` (`_id`, `title`, `content`, `image`, `author_id`, `author_username`, `category`, `create_date`, `update_date`, `isDeleted`, `delete_date`) VALUES
(6,	'998',	'998',	'images/TUrXRu5O/49639-brown-medieval-picture-text-frame-paper-pattern.png',	1,	'admin',	'Sports',	'2021-10-03 13:05:59',	'2021-10-10 14:14:18',	0,	NULL),
(7,	'Mayphone 22 İle Matrix\'e Bağlanıldı',	'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer pellentesque odio augue, vel efficitur quam finibus at. Integer fringilla sed massa quis pretium. Phasellus vel scelerisque est, quis maximus quam. Pellentesque aliquet neque ut augue tristique, id dictum magna ornare. Nunc commodo nulla id sem tristique laoreet. Aenean fringilla massa a orci fermentum, vitae maximus nunc elementum. Suspendisse rutrum, lacus feugiat vestibulum molestie, arcu est pulvinar augue, in ultricies enim purus at ex.\r\n\r\nProin laoreet justo non enim rhoncus, eu commodo magna posuere. Suspendisse potenti. Aliquam erat volutpat. Sed sagittis risus ac scelerisque pulvinar. Maecenas consequat sit amet lorem at congue. Phasellus sodales lectus quis est finibus efficitur. Aliquam molestie libero non nibh consequat, ut semper ex consectetur. Vivamus semper neque vitae euismod aliquam. Aenean mattis interdum tempor. Aenean facilisis et odio quis vehicula. Nulla in eros sed diam elementum tincidunt sodales vitae nisl. Aenean dapibus congue nulla in eleifend. Vivamus vulputate augue quis mauris ultrices ultrices. Fusce lectus est, luctus interdum consectetur nec, dictum ac eros. Nullam ac eros lacinia, blandit erat eget, imperdiet ligula.\r\n\r\nDuis sit amet leo eros. Donec ultricies nulla in metus suscipit bibendum. Integer arcu ante, feugiat in dolor eu, viverra commodo erat. Aliquam erat volutpat. Suspendisse venenatis felis et laoreet fringilla. Interdum et malesuada fames ac ante ipsum primis in faucibus. Aenean quis mi mollis odio lacinia porttitor. Nam eu dui nulla.\r\n\r\nSed maximus nunc viverra, eleifend risus in, mattis felis. Sed laoreet felis id augue facilisis, eu viverra erat ornare. Praesent ac consectetur ipsum, sit amet laoreet tellus. Morbi vehicula vulputate mi ut sodales. Ut justo felis, facilisis non luctus id, aliquet eu magna. Morbi et arcu commodo, finibus eros eget, ullamcorper ligula. Pellentesque eu porttitor ligula, mattis gravida nunc. Quisque lorem mi, tempus ut mollis sit amet, dignissim quis massa. Sed augue dolor, elementum vitae dictum id, pharetra in ligula.\r\n\r\nProin aliquam odio eu elementum laoreet. Donec vitae sapien rhoncus, suscipit nibh eu, commodo metus. Mauris vitae magna sit amet risus consectetur cursus. Donec tincidunt bibendum blandit. Curabitur consequat cursus varius. Nullam pharetra odio massa, at congue eros gravida ut. Ut maximus nisi quam, scelerisque finibus leo blandit ut. Proin enim urna, vehicula sit amet dapibus euismod, molestie quis purus. Integer molestie nec sem eget aliquet.',	'images/huOuLyUv/iPhone-8-Siri-concept.png',	1,	'admin',	'Technology',	'2021-10-03 21:30:46',	NULL,	0,	NULL),
(8,	'gdfgfdfgdfgdfgdgfdfd',	'jjjjjjjjjjjjj',	'images/BfQ4zSTa/123d823b1b40961f8ec004d5f72aa806.jpg',	1,	'admin',	'Economy',	'2021-10-03 23:00:05',	NULL,	0,	NULL),
(9,	'Çok',	'dfdddddddddddd',	'images/Tp3BTQGf/iPhone-8-Siri-concept.png',	1,	'admin',	'World',	'2021-10-04 17:23:11',	NULL,	0,	NULL),
(10,	'Sezarın Mezarı',	'FGSFGFGDSFSGDSFDGSFGDFDSGSFDGSGDFSFDGSFDGGFDHHFGHDGFFGHFGHDFHGDFGHGHDFFGDGFHFHFGHDGFHDFGHDFGH',	'images/1uVHPDPT/iPhone-8-Siri-concept.png',	1,	'admin',	'Science',	'2021-10-05 20:37:02',	NULL,	1,	NULL),
(11,	'Şokellalı Ekmek',	'dfdgffgdfgdfdsgghghjhgjhgfjgfhjgfhjgfhjgfhjgfhjgfhjgfhjgfhjghfjgfhjghfjghfjgfhjgfhjgfhjghfjghjghjfghjgfhjgfhjfghjghfjgfhjfghghj',	'images/WpeipIuR/iPhone-8-Siri-concept.png',	1,	'admin',	'Art',	'2021-10-05 20:38:47',	'2021-10-10 17:16:53',	1,	'2021-10-10 17:16:10'),
(12,	'Obama Yine Geldi',	'Dünya işleri ne beklersin',	'images/5tj1J9P4/iPhone-8-Siri-concept.png',	1,	'admin',	'Political',	'2021-10-05 20:39:43',	'2021-10-10 00:17:45',	1,	'2021-10-11 00:26:51'),
(13,	'Konya',	'dsfsdfsdafsdfsadfsdafsadfdsa',	'images/IFDT7iWP/iPhone-8-Siri-concept.png',	1,	'admin',	'Science',	'2021-10-07 11:58:01',	'2021-10-10 14:13:19',	0,	NULL),
(14,	'HULOOOOO934',	'DSFSDFSDF',	'images/qQpCRxun/iPhone-8-Siri-concept.png',	1,	'admin',	'Education',	'2021-10-07 19:04:03',	'2021-10-09 23:13:27',	0,	NULL),
(15,	'6767676767',	'sadfsdfsdfsdafad',	'images/Gi1LCSVX/iPhone-8-Siri-concept.png',	4,	'egebuyuk',	'Science',	'2021-10-10 02:25:38',	'2021-10-10 16:08:12',	0,	NULL),
(16,	'673',	'serseri',	'images/GYFnYmDT/49639-brown-medieval-picture-text-frame-paper-pattern.png',	4,	'egebuyuk',	'Science',	'2021-10-09 02:26:43',	'2021-10-09 16:03:46',	0,	NULL),
(17,	'Egenin İlk Haberi',	'LOREMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMM JOHN CENAAAAAAAAAAAAAAAAAAA',	'images/GEBreFIE/iPhone-8-Siri-concept.png',	4,	'egebuyuk',	'Science',	'2021-10-10 02:41:35',	NULL,	0,	NULL),
(18,	'dsfsdfsdafsadf',	'sdfsdfsdf',	'images/fcjZQgFV/iPhone-8-Siri-concept.png',	4,	'egebuyuk',	'Science',	'2021-10-10 03:12:01',	NULL,	0,	NULL),
(19,	'Sağlıklı Elma Çok Güzel',	'Ekonomi',	'images/Ro7KSwwq/iPhone-8-Siri-concept.png',	4,	'egebuyuk',	'Health',	'2021-10-10 13:28:28',	NULL,	0,	NULL),
(20,	'BBBB',	'BBBBBBB',	'images/ihgfT3g3/iPhone-8-Siri-concept.png',	1,	'admin',	'Economy',	'2021-10-10 13:30:27',	NULL,	0,	NULL),
(21,	'sdfsdfsdf',	'sdfsdfdsf',	'images/HBnZM8NH/iPhone-8-Siri-concept.png',	1,	'admin',	'Technology',	'2021-10-10 13:32:42',	NULL,	0,	NULL),
(22,	'Politik',	'dfgdfgdsfgsdfgdfsgdfsg',	'images/O3OHQkqt/iPhone-8-Siri-concept.png',	1,	'admin',	'Political',	'2021-10-10 13:36:39',	NULL,	0,	NULL),
(23,	'Political',	'dfssdfsdafsdaf',	'images/o0iJdOYI/iPhone-8-Siri-concept.png',	1,	'admin',	'Economy',	'2021-10-10 13:37:16',	NULL,	0,	NULL),
(24,	'dsfsdfsdafsdfsdfsadf',	'fgddfgdfgdfsgdfg',	'images/XyOq9u1w/iPhone-8-Siri-concept.png',	1,	'admin',	'Art',	'2021-10-10 13:41:21',	NULL,	0,	NULL),
(25,	'Bu son haberimd',	'123123123123123',	'images/3vknSdGC/iPhone-8-Siri-concept.png',	1,	'admin',	'Education',	'2021-10-10 13:42:22',	'2021-10-11 00:22:21',	0,	NULL),
(26,	'Editör3',	'KIZLAAAAAR',	'images/LLYFpkd0/iPhone-8-Siri-concept.png',	4,	'egebuyuk',	'Science',	'2021-10-10 13:48:25',	'2021-10-11 22:55:43',	1,	'2021-10-11 00:20:42');

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

INSERT INTO `users` (`_id`, `username`, `firstname`, `lastname`, `email`, `password`, `role`, `science`, `health`, `political`, `technology`, `world`, `economy`, `sports`, `art`, `education`, `social`, `create_date`, `isDeleted`, `delete_date`) VALUES
(1,	'admin',	'Efe',	'Büyük',	'efebyk97@gmail.com',	'$2y$10$wX0POZeGUGsWL.e71QHm5u43ALmv2dKMVq93IYVtaB11qxhpav1ve',	'admin',	0,	1,	1,	0,	1,	1,	1,	1,	0,	0,	'2021-10-01 15:33:33',	0,	'2021-10-07 22:06:15'),
(3,	'efebuyuk',	'Efe',	'Büyük',	'drgonefe2@hotmail.com',	'$2y$10$4kOws9ZAKUpRfLL2MVlbquTfyi23VBKxv0M5cc5WqtMZgsoH1HQMa',	'admin',	0,	0,	0,	0,	0,	0,	0,	0,	0,	0,	'2021-10-01 23:38:53',	0,	NULL),
(4,	'egebuyuk',	'Ege',	'Büyük',	'egerafet11@hotmail.com',	'$2y$10$PreOreBf19iqzJcQsUaUD.0F.q8MS3FzNeJ3c1woOHHo/3cIH500q',	'mod',	0,	0,	0,	0,	0,	0,	0,	0,	0,	0,	'2021-10-02 00:36:27',	0,	NULL),
(5,	'abuzer',	'Avatar',	'Avatar',	'safakciplak1990@gmail.com',	'$2y$10$RyGo3ieWShh6f8fwctmwEOeB5jSARG.5CuFVpBrvQX.KJbBSq3Jna',	'user',	0,	0,	0,	0,	0,	0,	0,	0,	0,	0,	'2021-10-02 01:03:48',	0,	NULL),
(6,	'dasdasdasdas',	'asdasdasd',	'asdasdasdas',	'dasdasdas@ssdf.com',	'$2y$10$jYhaojU7/cGlsZUx5Go36eiUOWQZB7AoefaH4HS1NdnzCGdRaGZyy',	'user',	0,	0,	0,	0,	0,	0,	0,	0,	0,	0,	'2021-10-02 23:17:22',	0,	NULL),
(7,	'CRAZYPATRON',	'Malik Talih Dursun',	'Abasıyanık',	'malikdursun99_atesli@hotmail.com',	'$2y$10$cAuKLNj519Ov9rvhN/Ui4usqZCDYcbPTFJO6icR0pl/uymtsqtBmq',	'user',	0,	0,	1,	1,	0,	0,	0,	0,	0,	0,	'2021-10-04 15:26:31',	0,	'2021-10-07 17:32:53'),
(8,	'sadsad',	'aqqqqqqq',	'qqqqqq',	'dfdfsdf@h.com',	'$2y$10$Vi4kGsATW2m0hU8o3egXJOXmGbbBqbWhjNvSwqmqgLdCh.XI2LkYm',	'user',	0,	0,	0,	0,	0,	0,	0,	0,	0,	0,	'2021-10-06 21:39:19',	0,	NULL),
(9,	'dsfsdf',	'Eren',	'Delen',	'sdfsd@hotmail.com',	'$2y$10$Pcl26yNdjAaoAm34WyDQc.jQjADtZ71NPBbzRqhMeIqALwloYzFnO',	'admin',	1,	1,	0,	0,	0,	0,	0,	0,	0,	0,	'2021-10-06 21:42:55',	0,	NULL),
(10,	'sdfsdfssfad',	'Hacı',	'Hoca',	'asfsdffsadqsdfsdf@fdf.com',	'$2y$10$JSLIsQIDlFDk0I45L/4Y4.0WaE.3W8WMivU9LCFh4SFqN0OQxUEKu',	'user',	0,	0,	0,	0,	0,	0,	0,	0,	0,	0,	'2021-10-06 21:43:33',	0,	NULL),
(11,	'fdfdfsdf',	'asdasdasd',	'dfgdfgdfg',	'safdsdfsdf@sdfasfd.com',	'$2y$10$Xtz5eF56MfMX.uj48KRMwORy1SRP8W8nSqRJPjp0Kvu25.VT9IEpC',	'user',	1,	1,	1,	0,	0,	0,	0,	0,	0,	0,	'2021-10-07 02:33:32',	0,	NULL),
(12,	'sdfsdfsdf',	'KEREM',	'SAYER',	'fdgdfgdfg@sdfs.com',	'$2y$10$gQmBvkOAxPIxNS.0dqKb7u/Bdt/R9AUSpaj.kMjRgu0suMupAXWPC',	'editor',	1,	0,	0,	0,	0,	0,	0,	0,	0,	0,	'2021-10-07 11:33:25',	0,	NULL),
(13,	'hasanpasa',	'Hasan',	'Paşa',	'hasan@hasan.com',	'$2y$10$CtuQDJsR8eS7SPG8WBkMJemRv.d7CKGL/RmXyj7daynvyZhuWLSMa',	'user',	0,	0,	0,	0,	0,	0,	0,	0,	0,	0,	'2021-10-07 19:20:04',	0,	NULL),
(14,	'dsfsdsdfsdf',	'AHHHHH',	'HHHHHHHHH',	'dsfsdafsdfsdfs@df.com',	'$2y$10$rPwH88dU0ZD05fxjUmq7m.qDmU098JyhGwBYqAEVbnNXQo7.f0G8a',	'user',	0,	0,	0,	0,	0,	0,	0,	0,	0,	0,	'2021-10-07 22:22:07',	0,	NULL),
(15,	'123123',	'Süleyman',	'Teksoy',	'sdfsdfsadf@dsfsa.com',	'$2y$10$e/ezH3Ho95nQk5tuNwde2um5.jhJK3buboTPZxivzPtXrl8Irpwla',	'user',	0,	0,	0,	0,	0,	0,	0,	0,	0,	0,	'2021-10-07 23:18:22',	0,	NULL),
(16,	'mermet12mercimek',	'Mehmet',	'Mercimek',	'12+4+25-10mercomehmo@hotmail.com',	'$2y$10$aIm8qK67uOYkhwLIcWwyyObtoUFdHLOc0/2BRRK/SHEuXFB.A5AbW',	'user',	0,	0,	0,	1,	1,	1,	0,	1,	1,	0,	'2021-10-07 23:39:36',	0,	NULL),
(17,	'fkjdsfjsdfj',	'Ahmet',	'Hüseyin',	'sdfsdjfsdf@asadasd.com',	'$2y$10$XODFHTtHaYoFENQ2sHqueOhX0d4wNh8ORro3J3rqxR5en9wnH2jfG',	'user',	1,	0,	0,	0,	0,	0,	0,	0,	0,	0,	'2021-10-07 23:40:50',	0,	'2021-10-07 23:49:37'),
(18,	'abdul53',	'Abdülrezzak',	'Sabuncu',	'fdsfdgfdsfsdg@sdfsdf.com',	'$2y$10$5JvkRvtBtI6KxsszbSnNDOutt5jkVq8vXCKGJp2pVuueqcwnGoOc2',	'user',	0,	0,	0,	1,	0,	0,	0,	0,	0,	0,	'2021-10-11 17:59:04',	0,	NULL);

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

INSERT INTO `users_read_news` (`_id`, `users_id`, `news_id`, `read_date`) VALUES
(1,	1,	13,	'2021-10-07 14:18:59'),
(2,	1,	9,	'2021-10-07 14:19:58'),
(3,	7,	13,	'2021-10-07 16:54:58'),
(4,	7,	7,	'2021-10-07 16:55:01'),
(5,	7,	9,	'2021-10-07 16:55:16'),
(6,	7,	10,	'2021-10-07 17:02:32'),
(7,	1,	11,	'2021-10-07 18:24:09'),
(8,	1,	7,	'2021-10-07 18:24:20'),
(9,	1,	10,	'2021-10-07 18:42:00'),
(10,	1,	6,	'2021-10-07 18:42:21'),
(11,	1,	8,	'2021-10-07 18:42:25'),
(12,	1,	12,	'2021-10-07 18:42:31'),
(13,	1,	14,	'2021-10-07 19:04:10'),
(14,	13,	12,	'2021-10-07 19:21:13'),
(15,	13,	14,	'2021-10-07 19:21:15'),
(16,	13,	6,	'2021-10-07 19:21:24'),
(17,	13,	10,	'2021-10-07 19:21:39'),
(18,	13,	11,	'2021-10-07 19:21:46'),
(19,	13,	7,	'2021-10-07 21:39:21'),
(20,	13,	13,	'2021-10-07 22:03:08'),
(21,	14,	14,	'2021-10-07 22:22:17'),
(22,	15,	11,	'2021-10-07 23:20:53'),
(23,	17,	12,	'2021-10-07 23:41:53'),
(24,	17,	7,	'2021-10-07 23:42:11'),
(25,	17,	10,	'2021-10-07 23:42:31'),
(26,	17,	11,	'2021-10-07 23:44:28'),
(27,	17,	6,	'2021-10-07 23:44:54'),
(28,	17,	14,	'2021-10-07 23:45:45'),
(29,	4,	16,	'2021-10-10 02:42:15'),
(30,	4,	22,	'2021-10-10 16:13:47'),
(31,	4,	20,	'2021-10-10 16:21:49'),
(32,	4,	11,	'2021-10-10 16:27:56'),
(33,	1,	26,	'2021-10-10 21:12:39'),
(34,	1,	19,	'2021-10-10 21:13:02'),
(35,	1,	25,	'2021-10-11 15:01:17');

-- 2021-10-12 13:48:50
