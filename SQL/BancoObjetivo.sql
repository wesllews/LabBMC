DROP DATABASE IF EXISTS labbmc;
CREATE DATABASE IF NOT EXISTS labbmc;

-- ************************************** `category`
CREATE TABLE `category`
(
 `id`            integer NOT NULL AUTO_INCREMENT ,
 `category`      varchar(30) NOT NULL ,
 `excluded`      char NULL ,
 `excluded_date` date NULL ,

PRIMARY KEY (`id`),
CONSTRAINT key_category UNIQUE (category)
) AUTO_INCREMENT=1;

INSERT INTO `category` (`id`, `category`, `excluded`, `excluded_date`) VALUES (NULL, 'captive', NULL, NULL), (NULL, 'wild', NULL, NULL);


-- ************************************** `individual`
CREATE TABLE `individual`
(
 `id`            integer NOT NULL AUTO_INCREMENT ,
 `id_category`   integer NOT NULL ,
 `sex`           char NOT NULL ,
 `name`          varchar(45) NULL ,
 `excluded`      char NULL ,
 `excluded_date` date NULL ,

PRIMARY KEY (`id`),
KEY `fkIdx_73` (`id_category`),
CONSTRAINT `FK_73` FOREIGN KEY `fkIdx_73` (`id_category`) REFERENCES `category` (`id`)
) AUTO_INCREMENT=1;


-- ************************************** `events`
CREATE TABLE `events`
(
 `id`            integer NOT NULL AUTO_INCREMENT ,
 `events`         varchar(100) NOT NULL ,
 `excluded`      char NULL ,
 `excluded_date` date NULL ,

PRIMARY KEY (`id`),
CONSTRAINT key_events UNIQUE (events)
) AUTO_INCREMENT=1;

INSERT INTO `events` (`id`, `events`, `excluded`, `excluded_date`) VALUES (NULL, 'Birth', NULL, NULL);
INSERT INTO `events` (`id`, `events`, `excluded`, `excluded_date`) VALUES (NULL, 'Capture', NULL, NULL);
INSERT INTO `events` (`id`, `events`, `excluded`, `excluded_date`) VALUES (NULL, 'Transfer', NULL, NULL);
INSERT INTO `events` (`id`, `events`, `excluded`, `excluded_date`) VALUES (NULL, 'Release', NULL, NULL);
INSERT INTO `events` (`id`, `events`, `excluded`, `excluded_date`) VALUES (NULL, 'Death', NULL, NULL);

-- ************************************** `institute`
CREATE TABLE `institute`
(
 `id`            integer NOT NULL AUTO_INCREMENT ,
 `name`          varchar(100) NOT NULL ,
 `abbreviation`  varchar(20) NULL ,
 `country`       varchar(30) NOT NULL ,
 `state`         varchar(30) NOT NULL ,
 `city`          varchar(45) NULL ,
 `excluded`      char NULL ,
 `excluded_date` date NULL ,

PRIMARY KEY (`id`)
) AUTO_INCREMENT=1;


-- ************************************** `history`
CREATE TABLE `history`
(
 `id`            integer NOT NULL AUTO_INCREMENT ,
 `id_individual` integer NOT NULL ,
 `id_events`      integer NOT NULL ,
 `id_institute`  integer NOT NULL ,
 `observation`   varchar(500) NULL ,
 `excluded`      char NULL ,
 `excluded_date` date NULL ,

PRIMARY KEY (`id`),
KEY `fkIdx_186` (`id_events`),
CONSTRAINT `FK_185` FOREIGN KEY `fkIdx_186` (`id_events`) REFERENCES `events` (`id`),
KEY `fkIdx_193` (`id_institute`),
CONSTRAINT `FK_193` FOREIGN KEY `fkIdx_193` (`id_institute`) REFERENCES `institute` (`id`),
KEY `fkIdx_91` (`id_individual`),
CONSTRAINT `FK_91` FOREIGN KEY `fkIdx_91` (`id_individual`) REFERENCES `individual` (`id`)
) AUTO_INCREMENT=1;


INSERT INTO `individual` (`id`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '1', 'M', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '1', 'F', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '1', 'M', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '1', 'F', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '1', 'M', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '1', 'F', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '1', 'F', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '1', 'M', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '1', 'F', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '1', 'M', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '1', 'F', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '1', 'M', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '1', 'M', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '1', 'F', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '1', 'M', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '1', 'M', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '1', 'M', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '1', 'F', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '1', 'F', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '1', 'F', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '1', 'M', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '1', 'F', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '1', 'M', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '1', 'F', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '1', 'F', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '1', 'M', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '1', 'M', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '1', 'F', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '1', 'M', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '1', 'M', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '1', 'M', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '1', 'M', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '1', 'M', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '1', 'M', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '1', 'F', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '1', 'M', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '1', 'M', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '1', 'M', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '1', 'F', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '1', 'M', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '1', '?', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '1', 'M', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '1', 'M', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '1', 'F', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '1', 'M', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '1', '?', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '1', 'M', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '1', 'F', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '1', 'F', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '1', 'M', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '1', 'M', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '1', 'F', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '1', 'M', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '1', 'M', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '1', 'F', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '1', 'F', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '1', 'F', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '1', 'M', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '1', 'M', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '1', 'F', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '1', '?', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '1', 'F', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '1', 'F', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '1', 'F', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '1', 'F', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '1', 'M', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '1', 'F', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '1', 'F', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '1', 'M', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '1', 'F', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '1', 'M', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '1', 'F', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '1', 'M', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '1', 'F', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '1', 'M', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '1', 'F', '689', 'n', NULL);
INSERT INTO `individual` (`id`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '1', 'M', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '1', 'F', '691', 'n', NULL);
INSERT INTO `individual` (`id`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '1', 'M', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '1', 'M', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '1', 'F', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '1', 'F', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '1', 'M', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '1', 'M', 'CLAUDIO', 'n', NULL);
INSERT INTO `individual` (`id`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '1', 'F', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '1', 'M', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '1', 'M', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '1', 'M', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '1', 'F', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '1', 'F', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '1', 'F', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '1', 'F', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '1', 'M', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '1', 'F', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '1', 'F', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '1', 'M', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '1', 'M', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '1', 'F', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '1', 'M', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '1', 'F', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '1', '?', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '1', '?', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '1', 'M', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '1', 'M', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '1', 'F', 'MARIA', 'n', NULL);
INSERT INTO `individual` (`id`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '1', 'M', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '1', 'M', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '1', 'M', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '1', 'M', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '1', 'F', 'GERTIE', 'n', NULL);
INSERT INTO `individual` (`id`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '1', 'F', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '1', 'M', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '1', 'M', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '1', 'M', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '1', 'M', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '1', 'M', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '1', 'F', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '1', 'M', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '1', 'M', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '1', '?', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '1', 'F', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '1', 'M', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '1', 'M', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '1', 'M', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '1', 'F', 'ESME', 'n', NULL);
INSERT INTO `individual` (`id`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '1', 'M', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '1', 'F', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '1', 'M', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '1', 'M', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '1', 'M', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '1', 'M', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '1', 'M', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '1', 'F', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '1', 'M', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '1', 'F', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '1', 'M', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '1', 'M', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '1', 'F', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '1', 'M', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '1', 'F', 'TINA', 'n', NULL);
INSERT INTO `individual` (`id`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '1', 'F', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '1', 'M', 'CAPTAIN', 'n', NULL);
INSERT INTO `individual` (`id`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '1', 'F', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '1', 'M', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '1', 'M', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '1', 'F', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '1', 'M', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '1', 'F', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '1', 'M', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '1', 'M', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '1', 'F', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '1', 'M', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '1', 'M', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '1', 'M', 'NICEIKE', 'n', NULL);
INSERT INTO `individual` (`id`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '1', 'F', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '1', 'M', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '1', 'M', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '1', 'F', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '1', '?', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '1', 'M', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '1', 'M', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '1', 'F', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '1', 'F', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '1', '?', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '1', 'M', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '1', 'F', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '1', 'F', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '1', 'F', 'DEVRA', 'n', NULL);
INSERT INTO `individual` (`id`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '1', 'M', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '1', 'M', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '1', 'F', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '1', 'F', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '1', 'M', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '1', 'F', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '1', 'M', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '1', 'F', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '1', 'M', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '1', 'F', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '1', 'M', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '1', 'M', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '1', 'F', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '1', 'M', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '1', 'M', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '1', 'M', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '1', 'F', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '1', 'M', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '1', 'M', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '1', 'M', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '1', 'M', 'AMOS', 'n', NULL);
INSERT INTO `individual` (`id`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '1', 'M', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '1', 'F', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '1', 'F', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '1', 'M', 'LAURY', 'n', NULL);
INSERT INTO `individual` (`id`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '1', 'M', 'CLAUDIO', 'n', NULL);
INSERT INTO `individual` (`id`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '1', 'M', 'PINON', 'n', NULL);
INSERT INTO `individual` (`id`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '1', 'F', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '1', 'M', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '1', 'F', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '1', 'M', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '1', 'F', 'TENILLE', 'n', NULL);
INSERT INTO `individual` (`id`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '1', 'M', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '1', 'M', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '1', 'M', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '1', 'F', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '1', 'M', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '1', 'F', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '1', 'M', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '1', 'F', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '1', 'M', 'DIAMANTE', 'n', NULL);
INSERT INTO `individual` (`id`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '1', 'F', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '1', 'F', 'CRISTAL', 'n', NULL);
INSERT INTO `individual` (`id`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '1', 'M', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '1', 'F', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '1', 'F', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '1', 'M', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '1', 'F', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '1', 'F', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '1', 'M', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '1', 'M', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '1', 'F', 'TELVA', 'n', NULL);
INSERT INTO `individual` (`id`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '1', '?', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '1', 'M', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '1', 'M', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '1', 'F', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '1', '?', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '1', '?', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '1', 'M', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '1', 'F', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '1', 'F', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '1', 'F', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '1', 'M', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '1', 'F', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '1', 'F', 'DIANA', 'n', NULL);
INSERT INTO `individual` (`id`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '1', '?', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '1', '?', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '1', 'F', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '1', 'F', 'YARA', 'n', NULL);
INSERT INTO `individual` (`id`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '1', '?', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '1', 'M', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '1', 'F', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '1', 'F', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '1', 'F', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '1', 'F', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '1', '?', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '1', '?', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '1', 'F', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '1', 'M', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '1', 'M', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '1', 'F', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '1', 'F', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '1', 'M', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '1', 'F', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '1', 'M', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '1', 'F', 'CASSIE', 'n', NULL);
INSERT INTO `individual` (`id`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '1', '?', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '1', 'M', 'FERNANDO', 'n', NULL);
INSERT INTO `individual` (`id`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '1', '?', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '1', 'M', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '1', 'M', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '1', 'M', 'MARCO', 'n', NULL);
INSERT INTO `individual` (`id`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '1', 'F', 'INEZ', 'n', NULL);
INSERT INTO `individual` (`id`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '1', '?', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '1', 'M', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '1', 'M', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '1', 'M', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '1', 'F', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '1', 'F', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '1', 'M', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '1', '?', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '1', '?', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '1', '?', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '1', '?', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '1', 'F', 'PRETINHA', 'n', NULL);
INSERT INTO `individual` (`id`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '1', 'M', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '1', '?', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '1', 'M', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '1', 'M', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '1', 'F', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '1', 'M', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '1', 'F', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '1', 'M', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '1', '?', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '1', 'F', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '1', 'M', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '1', 'M', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '1', 'M', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '1', '?', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '1', '?', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '1', '?', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '1', '?', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '1', 'M', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '1', 'M', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '1', 'M', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '1', 'M', 'EPI', 'n', NULL);
INSERT INTO `individual` (`id`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '1', 'M', 'BLAS', 'n', NULL);
INSERT INTO `individual` (`id`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '1', 'F', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '1', 'M', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '1', 'F', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '1', 'F', 'LEONIE', 'n', NULL);
INSERT INTO `individual` (`id`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '1', 'M', 'LEONARDO', 'n', NULL);
INSERT INTO `individual` (`id`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '1', 'F', '1924', 'n', NULL);
INSERT INTO `individual` (`id`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '1', 'F', 'MAGDA', 'n', NULL);
INSERT INTO `individual` (`id`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '1', '?', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '1', '?', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '1', 'M', 'VANDALAI', 'n', NULL);
INSERT INTO `individual` (`id`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '1', 'F', 'ROXANNE', 'n', NULL);
INSERT INTO `individual` (`id`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '1', 'M', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '1', 'M', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '1', 'F', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '1', 'F', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '1', 'F', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '1', 'M', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '1', 'M', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '1', 'F', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '1', 'F', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '1', 'M', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '1', 'M', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '1', 'F', 'EVA ', 'n', NULL);
INSERT INTO `individual` (`id`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '1', 'F', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '1', 'M', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '1', 'M', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '1', '?', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '1', 'F', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '1', 'F', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '1', 'M', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '1', 'M', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '1', 'M', 'ARCHIE', 'n', NULL);
INSERT INTO `individual` (`id`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '1', 'F', 'COCO', 'n', NULL);
INSERT INTO `individual` (`id`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '1', 'M', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '1', 'F', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '1', 'M', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '1', 'M', 'STICKY', 'n', NULL);
INSERT INTO `individual` (`id`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '1', 'M', 'ERIC', 'n', NULL);
INSERT INTO `individual` (`id`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '1', 'M', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '1', 'M', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '1', 'F', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '1', 'F', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '1', '?', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '1', 'F', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '1', '?', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '1', '?', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '1', '?', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '1', '?', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '1', '?', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '1', 'F', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '1', 'M', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '1', 'F', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '1', 'F', 'TAVO', 'n', NULL);
INSERT INTO `individual` (`id`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '1', 'F', 'TRIQUI', 'n', NULL);
INSERT INTO `individual` (`id`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '1', '?', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '1', 'F', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '1', 'F', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '1', 'M', 'tupi', 'n', NULL);
INSERT INTO `individual` (`id`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '1', 'F', 'CAJA', 'n', NULL);
INSERT INTO `individual` (`id`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '1', 'F', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '1', '?', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '1', 'M', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '1', 'M', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '1', '?', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '1', '?', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '1', 'F', 'LUANA', 'n', NULL);
INSERT INTO `individual` (`id`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '1', 'F', 'JAVIER', 'n', NULL);
INSERT INTO `individual` (`id`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '1', 'M', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '1', 'F', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '1', 'M', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '1', 'M', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '1', 'M', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '1', 'F', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '1', 'M', 'ELMO', 'n', NULL);
INSERT INTO `individual` (`id`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '1', 'M', 'ELMO', 'n', NULL);
INSERT INTO `individual` (`id`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '1', 'F', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '1', 'M', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '1', 'F', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '1', '?', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '1', 'M', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '1', 'M', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '1', 'M', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '1', '?', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '1', '?', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '1', 'M', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '1', 'F', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '1', 'M', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '1', 'M', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '1', 'M', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '1', 'M', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '1', '?', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '1', 'M', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '1', 'M', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '1', 'M', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '1', 'M', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '1', '?', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '1', 'F', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '1', 'M', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '1', '?', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '1', 'F', 'BERTHA', 'n', NULL);
INSERT INTO `individual` (`id`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '1', 'F', 'ERNIE', 'n', NULL);
INSERT INTO `individual` (`id`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '1', 'F', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '1', 'F', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '1', '?', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '1', '?', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '1', '?', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '1', '?', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '1', '?', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '1', '?', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '1', '?', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '1', 'F', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '1', 'M', 'FLUFFY', 'n', NULL);
INSERT INTO `individual` (`id`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '1', 'M', 'LENNY', 'n', NULL);
INSERT INTO `individual` (`id`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '1', 'M', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '1', 'M', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '1', 'M', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '1', 'F', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '1', 'F', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '1', 'F', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '1', '?', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '1', 'F', 'GIRL', 'n', NULL);
INSERT INTO `individual` (`id`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '1', 'M', 'RUNT', 'n', NULL);
INSERT INTO `individual` (`id`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '1', 'M', 'BIG BOY', 'n', NULL);
INSERT INTO `individual` (`id`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '1', 'F', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '1', 'F', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '1', 'M', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '1', 'M', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '1', 'M', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '1', 'M', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '1', 'M', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '1', 'M', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '1', 'M', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '1', 'F', 'KINHA', 'n', NULL);
INSERT INTO `individual` (`id`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '1', 'M', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '1', 'F', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '1', 'M', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '1', 'F', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '1', 'M', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '1', '?', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '1', 'F', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '1', '?', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '1', 'F', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '1', '?', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '1', '?', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '1', '?', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '1', '?', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '1', '?', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '1', '?', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '1', '?', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '1', '?', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '1', 'F', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '1', 'M', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '1', 'F', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '1', 'F', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '1', 'F', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '1', 'M', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '1', 'M', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '1', 'M', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '1', 'F', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '1', 'M', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '1', 'M', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '1', '?', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '1', 'F', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '1', '?', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '1', 'M', 'OMERINHO', 'n', NULL);
INSERT INTO `individual` (`id`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '1', 'M', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '1', 'F', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '1', 'F', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '1', 'M', 'FRANCISCO', 'n', NULL);
INSERT INTO `individual` (`id`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '1', 'M', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '1', 'M', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '1', 'M', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '1', 'M', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '1', 'M', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '1', 'M', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '1', 'M', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '1', 'M', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '1', 'M', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '1', 'M', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '1', 'F', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '1', 'M', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '1', 'F', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '1', 'M', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '1', 'M', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '1', 'M', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '1', 'F', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '1', 'M', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '1', 'F', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '1', 'M', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '1', '?', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '1', 'F', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '1', 'M', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '1', 'M', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '1', 'F', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '1', 'F', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '1', 'F', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '1', 'F', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '1', '?', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '1', 'M', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '1', '?', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '1', '?', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '1', '?', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '1', 'F', NULL, 'n', NULL);












INSERT INTO `institute` (`id`, `name`, `abbreviation`, `country`, `state`, `city`, `excluded`, `excluded_date`) VALUES (NULL,'NAME','ABREVIATION','COUNTRY','STATE','CITY
', 'n', NULL);
INSERT INTO `institute` (`id`, `name`, `abbreviation`, `country`, `state`, `city`, `excluded`, `excluded_date`) VALUES (NULL,'Adelaide Zoological Gardens','ADELAIDE','Australia','South Australia','Adelaide
', 'n', NULL);
INSERT INTO `institute` (`id`, `name`, `abbreviation`, `country`, `state`, `city`, `excluded`, `excluded_date`) VALUES (NULL,'Zoologico de Bauru','BAURU ZOO','Brazil','São Paulo','Bauru
', 'n', NULL);
INSERT INTO `institute` (`id`, `name`, `abbreviation`, `country`, `state`, `city`, `excluded`, `excluded_date`) VALUES (NULL,'City of Belfast Zoo','BELFAST','North Ireland','Belfast','NA
', 'n', NULL);
INSERT INTO `institute` (`id`, `name`, `abbreviation`, `country`, `state`, `city`, `excluded`, `excluded_date`) VALUES (NULL,'Jardim Zoologico De Brasilia','BRASILIA','Brazil','Distrito Federal','Brasilia
', 'n', NULL);
INSERT INTO `institute` (`id`, `name`, `abbreviation`, `country`, `state`, `city`, `excluded`, `excluded_date`) VALUES (NULL,'Bristol Zoo','BRISTOL','England','Clifton','Bristol
', 'n', NULL);
INSERT INTO `institute` (`id`, `name`, `abbreviation`, `country`, `state`, `city`, `excluded`, `excluded_date`) VALUES (NULL,'Buri','Buri','Brazil','São Paulo','Buri
', 'n', NULL);
INSERT INTO `institute` (`id`, `name`, `abbreviation`, `country`, `state`, `city`, `excluded`, `excluded_date`) VALUES (NULL,'Central Park Wildlife Center','CENTRALPK','United States of America',' New York',' New York
', 'n', NULL);
INSERT INTO `institute` (`id`, `name`, `abbreviation`, `country`, `state`, `city`, `excluded`, `excluded_date`) VALUES (NULL,'North of England Zoo Society','CHESTER','England','Not specified','NA
', 'n', NULL);
INSERT INTO `institute` (`id`, `name`, `abbreviation`, `country`, `state`, `city`, `excluded`, `excluded_date`) VALUES (NULL,'Fort Worth Zoological Park','FORTWORTH','United States of America','Texas','NA
', 'n', NULL);
INSERT INTO `institute` (`id`, `name`, `abbreviation`, `country`, `state`, `city`, `excluded`, `excluded_date`) VALUES (NULL,'Durrell Wildlife Conservation Trust','JERSEY','United King','Channel Islands','NA
', 'n', NULL);
INSERT INTO `institute` (`id`, `name`, `abbreviation`, `country`, `state`, `city`, `excluded`, `excluded_date`) VALUES (NULL,'Krefelder Zoo','KREFELD','Germany','Not specified','NA
', 'n', NULL);
INSERT INTO `institute` (`id`, `name`, `abbreviation`, `country`, `state`, `city`, `excluded`, `excluded_date`) VALUES (NULL,'La Palmyre Zoo','LA PALMYR','France','Royan','NA
', 'n', NULL);
INSERT INTO `institute` (`id`, `name`, `abbreviation`, `country`, `state`, `city`, `excluded`, `excluded_date`) VALUES (NULL,'Jardim Zoologico de Lisboa','LISBON','Potugal ','Lisboa','NA
', 'n', NULL);
INSERT INTO `institute` (`id`, `name`, `abbreviation`, `country`, `state`, `city`, `excluded`, `excluded_date`) VALUES (NULL,'Morro do Diabo','M DIABO','Brazil','Not specified','NA
', 'n', NULL);
INSERT INTO `institute` (`id`, `name`, `abbreviation`, `country`, `state`, `city`, `excluded`, `excluded_date`) VALUES (NULL,'MIDDLE GOBI  ','M GOBI','Mongólia','Not specified','NA
', 'n', NULL);
INSERT INTO `institute` (`id`, `name`, `abbreviation`, `country`, `state`, `city`, `excluded`, `excluded_date`) VALUES (NULL,'Zoologischer Garten Magdeburg','MAGDEBURG','Gemany','Sachsen-anhalt','NA
', 'n', NULL);
INSERT INTO `institute` (`id`, `name`, `abbreviation`, `country`, `state`, `city`, `excluded`, `excluded_date`) VALUES (NULL,'The Wildlife Conservation Society','NY BRONX','United States of America',' New York',' New York
', 'n', NULL);
INSERT INTO `institute` (`id`, `name`, `abbreviation`, `country`, `state`, `city`, `excluded`, `excluded_date`) VALUES (NULL,'Private Collection','PRIVATE','Brazil','Not specified','NA
', 'n', NULL);
INSERT INTO `institute` (`id`, `name`, `abbreviation`, `country`, `state`, `city`, `excluded`, `excluded_date`) VALUES (NULL,'Prospect Park Wildlife Center','PROSPECTP','United States of America',' New York',' New York
', 'n', NULL);
INSERT INTO `institute` (`id`, `name`, `abbreviation`, `country`, `state`, `city`, `excluded`, `excluded_date`) VALUES (NULL,'Fazenda Ribeirão Bonito','R BONITO','Brazil','São Paulo ','NA
', 'n', NULL);
INSERT INTO `institute` (`id`, `name`, `abbreviation`, `country`, `state`, `city`, `excluded`, `excluded_date`) VALUES (NULL,'Centro Primatologia do Rio de Janeiro','RIO PRIM','Brazil','Rio de Janeiro','Rio de Janeiro
', 'n', NULL);
INSERT INTO `institute` (`id`, `name`, `abbreviation`, `country`, `state`, `city`, `excluded`, `excluded_date`) VALUES (NULL,'Parque Zoological de Sao Paulo','SAO PAULO','Brazil','São Paulo ','São Paulo 
', 'n', NULL);
INSERT INTO `institute` (`id`, `name`, `abbreviation`, `country`, `state`, `city`, `excluded`, `excluded_date`) VALUES (NULL,'Parque Zoológico Municipal Quinzinho de Barros','SOROCABA',' Brazil',' Sao Paulo',' Sorocaba
', 'n', NULL);
INSERT INTO `institute` (`id`, `name`, `abbreviation`, `country`, `state`, `city`, `excluded`, `excluded_date`) VALUES (NULL,'Parque Ecologico de Sao Carlos','SAO CARLOS','Brazil',' Sao Paulo','São Carlos
', 'n', NULL);
INSERT INTO `institute` (`id`, `name`, `abbreviation`, `country`, `state`, `city`, `excluded`, `excluded_date`) VALUES (NULL,'Unknown Location','UNKNOWN','Brazil','Not specified','NA
', 'n', NULL);
INSERT INTO `institute` (`id`, `name`, `abbreviation`, `country`, `state`, `city`, `excluded`, `excluded_date`) VALUES (NULL,'WILD','WILD','Unknown','Not specified',NULL, 'n', NULL);






