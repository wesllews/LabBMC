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

PRIMARY KEY (`id`),
CONSTRAINT key_category UNIQUE (category)
) AUTO_INCREMENT=1;

INSERT INTO `category` (`id`, `category`) VALUES (NULL, 'captive'), (NULL, 'wild');


-- ************************************** `individual`
CREATE TABLE `individual`
(
 `id`             integer  NOT NULL AUTO_INCREMENT,
 `identification` varchar(20) NOT NULL UNIQUE,
 `id_category`    integer NOT NULL ,
 `sex`            varchar(15) NOT NULL ,
 `name`           varchar(45) NULL ,

PRIMARY KEY (`id`),
KEY (`id_category`),
CONSTRAINT FOREIGN KEY  (`id_category`) REFERENCES `category` (`id`)
)AUTO_INCREMENT=1;

-- ************************************** Wild e Unkown individual **
INSERT INTO `individual` (`id`, `identification`, `id_category`, `sex`, `name`) VALUES (NULL,'WILD', '2', 'Unknown', 'Wild');
INSERT INTO `individual` (`id`, `identification`, `id_category`, `sex`, `name`) VALUES (NULL,'UNKNOWN', '2', 'Unknown', 'Wild');


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
 `abbreviation`  varchar(20) NOT NULL UNIQUE ,
 `country`       varchar(30) NOT NULL ,
 `state`         varchar(30) NULL ,
 `city`          varchar(45) NULL ,
 `priority`      integer NULL ,
PRIMARY KEY (`id`)
) AUTO_INCREMENT=1;


-- ************************************** `historic`
CREATE TABLE `historic`
(
 `id`            integer NOT NULL AUTO_INCREMENT ,
 `id_individual` integer NOT NULL ,
 `id_event`      integer NOT NULL ,
 `id_institute`  integer NOT NULL ,
 `local_id`   varchar(15) NULL ,
 `date`          date NULL ,
 `observation`   varchar(500) NULL,

PRIMARY KEY (`id`),
CONSTRAINT FOREIGN KEY (`id_event`) REFERENCES `events` (`id`),
CONSTRAINT FOREIGN KEY (`id_institute`) REFERENCES `institute` (`id`),
CONSTRAINT FOREIGN KEY (`id_individual`) REFERENCES `individual` (`id`)
) AUTO_INCREMENT=1;

-- ************************************** `Fragment`
CREATE TABLE `fragment`
(
 `id`        	integer NOT NULL AUTO_INCREMENT ,
 `fragment`     varchar(45) NOT NULL ,
 `abbreviation` varchar(20) NULL ,
 `country`      varchar(45) NULL ,
 `state`        varchar(45) NULL ,
 `city`         varchar(45) NULL ,

PRIMARY KEY (`id`)
) AUTO_INCREMENT=1;

-- ************************************** `Group`
CREATE TABLE `group`
(
 `id`        	integer NOT NULL AUTO_INCREMENT ,
 `id_fragment` integer NOT NULL ,
 `group`       varchar(45) NOT NULL,
 `longitude`   varchar(15) NULL ,
 `latitude`    varchar(15) NULL ,

PRIMARY KEY (`id`),
CONSTRAINT FOREIGN KEY (`id_fragment`) REFERENCES `fragment` (`id`)
) AUTO_INCREMENT=1;

-- ************************************** `ind_group`
CREATE TABLE `ind_group`
(
 `id_individual` integer NOT NULL ,
 `id_group`		integer NOT NULL ,
 `longitude_ind` varchar(45) NULL ,
 `latitude_ind`  varchar(45) NULL ,


 PRIMARY KEY (`id_individual`),
 CONSTRAINT FOREIGN KEY (`id_individual`) REFERENCES `individual` (`id`),
 CONSTRAINT FOREIGN KEY (`id_group`) REFERENCES `group` (`id`)
 );

-- ************************************** `status`
CREATE TABLE `status`
(
 `id_individual` integer NOT NULL ,
 `id_institute`   integer NULL ,
 `id_fragment`   integer NULL ,
 `alive`          boolean NULL ,

PRIMARY KEY (`id_individual`),
CONSTRAINT FOREIGN KEY (`id_individual`) REFERENCES `individual` (`id`),
CONSTRAINT FOREIGN KEY (`id_institute`) REFERENCES `institute` (`id`),
CONSTRAINT FOREIGN KEY (`id_fragment`) REFERENCES `fragment` (`id`)
);

-- ************************************** `kinship`
CREATE TABLE `kinship`
(
 `id_individual` integer NOT NULL ,
 `sire`          integer NOT NULL ,
 `dam`           integer NOT NULL ,

CONSTRAINT FOREIGN KEY (`sire`) REFERENCES `individual` (`id`),
CONSTRAINT FOREIGN KEY (`dam`) REFERENCES `individual` (`id`),
CONSTRAINT FOREIGN KEY (`id_individual`) REFERENCES `individual` (`id`)
);

-- ************************************** `locus`
CREATE TABLE `locus`
(
 `id`        integer NOT NULL AUTO_INCREMENT ,
 `locus`     varchar(30) NOT NULL ,
 `type`      varchar(45) NOT NULL ,
 `motif` 	 text NULL ,
 `reference` text NULL ,
 `forward`   text NULL ,
 `reverse`   text NULL ,

PRIMARY KEY (`id`)
) AUTO_INCREMENT=1;


-- ************************************** `genotype`
CREATE TABLE `genotype`
(
 `id_individual` integer NOT NULL ,
 `id_locus`      integer(30) NOT NULL ,
 `allele`        integer NOT NULL ,
 `restrict`      char NULL ,

CONSTRAINT FOREIGN KEY (`id_individual`) REFERENCES `individual` (`id`),
CONSTRAINT FOREIGN KEY (`id_locus`) REFERENCES `locus` (`id`)
);

