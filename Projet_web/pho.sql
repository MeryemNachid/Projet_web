SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


CREATE TABLE IF NOT EXISTS `users` (
	`code` int(11) NOT NULL,
  	`nom` varchar(10) NOT NULL,
  	`password` varchar(4) NOT NULL,
  	`email` varchar(60) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

INSERT INTO `users` (`code`, `nom`, `password`, `email`) VALUES
(1, 'toto', '14ma', 'toto@toto.com'),
(3, 'titi', '14ma', 'titi@titi.com');

ALTER TABLE `users`
ADD PRIMARY KEY (`code`), ADD UNIQUE KEY `nom` (`nom`), ADD UNIQUE KEY `email` (`email`);