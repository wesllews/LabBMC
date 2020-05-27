DROP DATABASE IF EXISTS labbmc;
CREATE DATABASE IF NOT EXISTS labbmc;


-- ************************************** `login`
CREATE TABLE `login`
(
 `email`         varchar(50) NOT NULL ,
 `name`          varchar(50) NOT NULL ,
 `password`      varchar(100) NOT NULL ,
 `privilege`     char NOT NULL ,
 `excluded`      char NULL ,
 `excluded_date` date NULL ,

PRIMARY KEY (`email`)
);

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

INSERT INTO `category` (`id`, `category`) VALUES (NULL, 'captive'), (NULL, 'wild');


-- ************************************** `individual`
CREATE TABLE `individual`
(
 `identification`      varchar(20),
 `id_category`   integer NOT NULL ,
 `sex`           varchar(15) NOT NULL ,
 `name`          varchar(45) NULL ,

PRIMARY KEY (`identification`),
KEY `fkIdx_74` (`id_category`),
CONSTRAINT `FK_74` FOREIGN KEY `fkIdx_74` (`id_category`) REFERENCES `category` (`id`)
);

-- ** Wild e Unkown individual**
INSERT INTO `individual` ( `identification`, `id_category`, `sex`, `name`) VALUES ('WILD', '2', 'Female', 'Wild');
INSERT INTO `individual` ( `identification`, `id_category`, `sex`, `name`) VALUES ('UNKNOWN', '2', 'Unknown', 'Wild');



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

INSERT INTO `events` (`id`, `events`) VALUES (NULL, 'Birth');
INSERT INTO `events` (`id`, `events`) VALUES (NULL, 'Capture');
INSERT INTO `events` (`id`, `events`) VALUES (NULL, 'Transfer');
INSERT INTO `events` (`id`, `events`) VALUES (NULL, 'Loan to');
INSERT INTO `events` (`id`, `events`) VALUES (NULL, 'Release');
INSERT INTO `events` (`id`, `events`) VALUES (NULL, 'Death');

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
 `observation`   varchar(500) NULL,

PRIMARY KEY (`id`),
KEY `fkIdx_186` (`id_event`),
CONSTRAINT `FK_185` FOREIGN KEY `fkIdx_186` (`id_event`) REFERENCES `events` (`id`),
KEY `fkIdx_193` (`id_institute`),
CONSTRAINT `FK_193` FOREIGN KEY `fkIdx_193` (`id_institute`) REFERENCES `institute` (`id`),
KEY `fkIdx_91` (`id_individual`),
CONSTRAINT `FK_91` FOREIGN KEY `fkIdx_91` (`id_individual`) REFERENCES `individual` (`identification`)
) AUTO_INCREMENT=1;


-- ************************************** `status`
CREATE TABLE `status`
(
 `id_individual` varchar(20) NOT NULL ,
 `id_institute`   integer NULL ,
 `alive`          boolean NOT NULL ,

KEY `fkIdx_225` (`identification`),
CONSTRAINT `FK_225` FOREIGN KEY `fkIdx_225` (`identification`) REFERENCES `individual` (`identification`),
KEY `fkIdx_235` (`id_institute`),
CONSTRAINT `FK_235` FOREIGN KEY `fkIdx_235` (`id_institute`) REFERENCES `institute` (`id`)
);


-- ************************************** `kinship`
CREATE TABLE `kinship`
(
 `id_individual` varchar(20) NOT NULL ,
 `sire`          varchar(20) NOT NULL ,
 `dam`           varchar(20) NOT NULL ,
CONSTRAINT FOREIGN KEY (`sire`) REFERENCES `individual` (`identification`),
CONSTRAINT FOREIGN KEY (`dam`) REFERENCES `individual` (`identification`),
CONSTRAINT FOREIGN KEY (`id_individual`) REFERENCES `individual` (`identification`)
);


-- ************************************** `locus`
CREATE TABLE `locus`
(
 `locus`     varchar(30) NOT NULL ,
 `type`      varchar(45) NOT NULL ,
 `reference` text NULL ,
 `forward`   text NULL ,
 `reverse`   text NULL ,

PRIMARY KEY (`locus`)
);


-- ************************************** `genotype`
CREATE TABLE `genotype`
(
 `id_individual` varchar(20) NOT NULL ,
 `id_locus`      varchar(30) NOT NULL ,
 `allele`        integer NOT NULL ,
 `restrict`      char NULL ,

CONSTRAINT FOREIGN KEY (`id_individual`) REFERENCES `individual` (`identification`),
CONSTRAINT FOREIGN KEY (`id_locus`) REFERENCES `locus` (`locus`)
);


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





