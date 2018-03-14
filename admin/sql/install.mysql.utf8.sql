DROP TABLE IF EXISTS `#__rooms`, `#__customers`, `#__orders`;

CREATE TABLE `#__rooms` (
  `roomId`      INT UNSIGNED  NOT NULL AUTO_INCREMENT,
  `roomNumber`  VARCHAR(10)   NOT NULL,
  `state`       TINYINT(4)    NOT NULL DEFAULT '0',
  `published`   TINYINT(4)    NOT NULL DEFAULT '1',
  `catid`	    int(11)    NOT NULL DEFAULT '0',
  PRIMARY KEY (`roomId`)
)
  ENGINE =MyISAM
  AUTO_INCREMENT =0
  DEFAULT CHARSET =utf8;

CREATE TABLE `#__customers` (
  `customerId`  INT UNSIGNED  NOT NULL AUTO_INCREMENT,
  `name`        VARCHAR(50)   NOT NULL,
  `email`       VARCHAR(50),
  PRIMARY KEY (`customerId`)
)
  ENGINE =MyISAM
  AUTO_INCREMENT =0
  DEFAULT CHARSET =utf8;

CREATE TABLE `#__orders` (
  `orderId`     INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `roomId`      INT UNSIGNED NOT NULL,
  `customerId`  INT UNSIGNED NOT NULL,
  `date`        DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`orderId`),
  FOREIGN KEY (`roomId`) REFERENCES `#__rooms`(`roomId`),
  FOREIGN KEY (`customerId`) REFERENCES `#__customers`(`customerId`)
)
  ENGINE =MyISAM
  AUTO_INCREMENT =0
  DEFAULT CHARSET =utf8;

INSERT INTO `#__rooms` (`roomNumber`) VALUES ('A100');
INSERT INTO `#__rooms` (`roomNumber`) VALUES ('B234');
INSERT INTO `#__customers` (`name`, `email`) VALUES ('Wang Yuchao', 'example@email.com');
INSERT INTO `#__orders` (`roomId`, `customerId`) VALUES ('1', '1');