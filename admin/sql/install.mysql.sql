DROP TABLE IF EXISTS `#__rooms`, `#__customers`, `#__orders`;

CREATE TABLE `#__rooms` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `asset_id` INT NOT NULL DEFAULT '0',
  `roomNumber` VARCHAR(10) NOT NULL,
  `state` TINYINT(4) NOT NULL DEFAULT '0',
  `published` TINYINT(4) NOT NULL DEFAULT '1',
  `catid` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
)
  ENGINE =MyISAM
  AUTO_INCREMENT =0
  DEFAULT CHARSET =utf8;

CREATE TABLE `#__customers` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `asset_id` INT NOT NULL DEFAULT '0',
  `name` VARCHAR(50) NOT NULL,
  `email` VARCHAR(50),
  PRIMARY KEY (`id`)
)
  ENGINE =MyISAM
  AUTO_INCREMENT =0
  DEFAULT CHARSET =utf8;

CREATE TABLE `#__orders` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `asset_id` INT NOT NULL DEFAULT '0',
  `roomId` INT UNSIGNED NOT NULL,
  `customerId` INT UNSIGNED NOT NULL,
  `date` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  FOREIGN KEY (`roomId`) REFERENCES `#__rooms`(`id`),
  FOREIGN KEY (`customerId`) REFERENCES `#__customers`(`id`)
)
  ENGINE =MyISAM
  AUTO_INCREMENT =0
  DEFAULT CHARSET =utf8;

INSERT INTO `#__rooms` (`roomNumber`, `state`) VALUES ('A100', '1');
INSERT INTO `#__rooms` (`roomNumber`) VALUES ('B234');
INSERT INTO `#__customers` (`name`, `email`) VALUES ('Wang Yuchao', 'example@email.com');
INSERT INTO `#__orders` (`id`, `id`) VALUES ('1', '1');