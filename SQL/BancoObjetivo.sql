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
 `identification`      varchar(20),
 `id_category`   integer NOT NULL ,
 `sex`           varchar(15) NOT NULL ,
 `name`          varchar(45) NULL ,
 `excluded`      char NULL ,
 `excluded_date` date NULL ,

PRIMARY KEY (`identification`),
KEY `fkIdx_73` (`id_category`),
CONSTRAINT `FK_73` FOREIGN KEY `fkIdx_73` (`id_category`) REFERENCES `category` (`id`)
) AUTO_INCREMENT=1;

-- ** Wild e Unkown individual**
INSERT INTO `individual` ( `identification`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES ('WILD', '2', 'Unknown', 'Wild', NULL, NULL);
INSERT INTO `individual` ( `identification`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES ('UNKNOWN', '2', 'Unknown', 'Wild', NULL, NULL);



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
INSERT INTO `events` (`id`, `events`, `excluded`, `excluded_date`) VALUES (NULL, 'Loan to', NULL, NULL);
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


-- ************************************** `historic`
CREATE TABLE `historic`
(
 `id`            integer NOT NULL AUTO_INCREMENT ,
 `id_individual` varchar(20) NOT NULL ,
 `id_event`      integer NOT NULL ,
 `id_institute`  integer NOT NULL ,
 `local_id`   varchar(15) NULL ,
 `date`          date NULL ,
 `observation`   varchar(500) NULL ,
 `excluded`      char NULL ,
 `excluded_date` date NULL ,

PRIMARY KEY (`id`),
KEY `fkIdx_186` (`id_event`),
CONSTRAINT `FK_185` FOREIGN KEY `fkIdx_186` (`id_event`) REFERENCES `events` (`id`),
KEY `fkIdx_193` (`id_institute`),
CONSTRAINT `FK_193` FOREIGN KEY `fkIdx_193` (`id_institute`) REFERENCES `institute` (`id`),
KEY `fkIdx_91` (`id_individual`),
CONSTRAINT `FK_91` FOREIGN KEY `fkIdx_91` (`id_individual`) REFERENCES `individual` (`identification`)
) AUTO_INCREMENT=1;


-- ************************************** `kinship`
CREATE TABLE `kinship`
(
 `id_individual` varchar(20) NOT NULL UNIQUE ,
 `sire`          varchar(20) NOT NULL ,
 `dam`           varchar(20) NOT NULL ,
 `excluded`      char NULL ,
 `excluded_date` date NULL ,

KEY `fkIdx_196` (`sire`),
CONSTRAINT `FK_196` FOREIGN KEY `fkIdx_196` (`sire`) REFERENCES `individual` (`identification`),
KEY `fkIdx_199` (`dam`),
CONSTRAINT `FK_199` FOREIGN KEY `fkIdx_199` (`dam`) REFERENCES `individual` (`identification`),
KEY `fkIdx_82` (`id_individual`),
CONSTRAINT `FK_82` FOREIGN KEY `fkIdx_82` (`id_individual`) REFERENCES `individual` (`identification`)
);


-- ************************************** `locus`
CREATE TABLE `locus`
(
 `locus`         varchar(30) NOT NULL UNIQUE,
 `excluded`      char NULL ,
 `excluded_date` date NULL ,

PRIMARY KEY (`locus`)
) AUTO_INCREMENT=1;


-- ************************************** `genotype`
CREATE TABLE `genotype`
(
 `id_individual` varchar(20) NOT NULL ,
 `id_locus`      varchar(30) NOT NULL ,
 `alelo`         integer NOT NULL ,
 `excluded`      char NULL ,
 `excluded_date` date NULL ,

KEY `fkIdx_127` (`id_individual`),
CONSTRAINT `FK_127` FOREIGN KEY `fkIdx_127` (`id_individual`) REFERENCES `individual` (`identification`),
KEY `fkIdx_130` (`id_locus`),
CONSTRAINT `FK_130` FOREIGN KEY `fkIdx_130` (`id_locus`) REFERENCES `locus` (`locus`)
) AUTO_INCREMENT=1;


-- ************************************** `wild_location`
CREATE TABLE `wild_location`
(
 `id_individual` varchar(20) NOT NULL ,
 `fragment`      varchar(45) NOT NULL ,
 `pop`           varchar(25) NULL ,
 `group`         varchar(25) NULL ,
 `longitude`     varchar(15) NULL ,
 `latitude`      varchar(15) NULL ,
 `excluded`      char NULL ,
 `excluded_date` date NULL ,

PRIMARY KEY (`id_individual`),
KEY `fkIdx_153` (`id_individual`),
CONSTRAINT `FK_153` FOREIGN KEY `fkIdx_153` (`id_individual`) REFERENCES `individual` (`identification`)
);





