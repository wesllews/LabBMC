DROP DATABASE IF EXISTS labbmc;
CREATE DATABASE IF NOT EXISTS labbmc;

-- ************************************** `login`
CREATE TABLE `login`
(
 `email`         varchar(50) NOT NULL ,
 `name`          varchar(50) NOT NULL ,
 `password`      varchar(100) NOT NULL ,
 `adm`           char NOT NULL ,
 `excluded`      char NULL,
 `excluded_date` date NULL,

PRIMARY KEY (`email`)
);
INSERT INTO `login` (`email`, `name`, `password`, `adm`, `excluded`, `excluded_date`) VALUES ('adm@adm.com', 'Administrador', 'adm123', 's', NULL, NULL);
INSERT INTO `login` (`email`, `name`, `password`, `adm`, `excluded`, `excluded_date`) VALUES ('patricia@adm.com', 'Patrícia', 'adm123', 's', NULL, NULL);


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

INSERT INTO `events` (`id`, `events`, `excluded`, `excluded_date`) VALUES (NULL, 'Born', NULL, NULL);
INSERT INTO `events` (`id`, `events`, `excluded`, `excluded_date`) VALUES (NULL, 'Capture', NULL, NULL);
INSERT INTO `events` (`id`, `events`, `excluded`, `excluded_date`) VALUES (NULL, 'Transfer', NULL, NULL);
INSERT INTO `events` (`id`, `events`, `excluded`, `excluded_date`) VALUES (NULL, 'Death', NULL, NULL);


-- ************************************** `institute`
CREATE TABLE `institute`
(
 `id`            integer NOT NULL AUTO_INCREMENT ,
 `name`          varchar(100) NOT NULL ,
 `abbreviation`  varchar(20) NULL ,
 `country`       varchar(20) NOT NULL ,
 `state`         varchar(20) NOT NULL ,
 `city`          varchar(30) NULL ,
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



-- ************************************** `kinship`
CREATE TABLE `kinship`
(
 `id_individual` integer NOT NULL ,
 `sire`          integer NOT NULL ,
 `dam`           integer NOT NULL ,
 `excluded`      char NULL ,
 `excluded_date` date NULL ,

KEY `fkIdx_196` (`sire`),
CONSTRAINT `FK_196` FOREIGN KEY `fkIdx_196` (`sire`) REFERENCES `individual` (`id`),
KEY `fkIdx_199` (`dam`),
CONSTRAINT `FK_199` FOREIGN KEY `fkIdx_199` (`dam`) REFERENCES `individual` (`id`),
KEY `fkIdx_82` (`id_individual`),
CONSTRAINT `FK_82` FOREIGN KEY `fkIdx_82` (`id_individual`) REFERENCES `individual` (`id`)
);


-- ************************************** `especific_id_individual`
CREATE TABLE `especific_id_individual`
(
 `id`            varchar(45) NOT NULL ,
 `id_individual` integer NOT NULL ,
 `id_institute`  integer NOT NULL ,
 `excluded`      char NULL ,
 `excluded_date` date NULL ,

PRIMARY KEY (`id`),
KEY `fkIdx_86` (`id_individual`),
CONSTRAINT `FK_86` FOREIGN KEY `fkIdx_86` (`id_individual`) REFERENCES `individual` (`id`),
KEY `fkIdx_97` (`id_institute`),
CONSTRAINT `FK_97` FOREIGN KEY `fkIdx_97` (`id_institute`) REFERENCES `institute` (`id`)
);


-- ************************************** `locus`
CREATE TABLE `locus`
(
 `id`            integer NOT NULL AUTO_INCREMENT ,
 `locus`         varchar(30) NOT NULL ,
 `excluded`      char NULL ,
 `excluded_date` date NULL ,

PRIMARY KEY (`id`)
) AUTO_INCREMENT=1;


-- ************************************** `genotype`
CREATE TABLE `genotype`
(
 `id`            integer NOT NULL AUTO_INCREMENT ,
 `id_individual` integer NOT NULL ,
 `id_locus`      integer NOT NULL ,
 `excluded`      char NULL ,
 `alelo`         integer NOT NULL ,
 `excluded_date` date NULL ,

PRIMARY KEY (`id`),
KEY `fkIdx_127` (`id_individual`),
CONSTRAINT `FK_127` FOREIGN KEY `fkIdx_127` (`id_individual`) REFERENCES `individual` (`id`),
KEY `fkIdx_130` (`id_locus`),
CONSTRAINT `FK_130` FOREIGN KEY `fkIdx_130` (`id_locus`) REFERENCES `locus` (`id`)
) AUTO_INCREMENT=1;


-- ************************************** `fragment`
CREATE TABLE `fragment`
(
 `id`            integer NOT NULL AUTO_INCREMENT ,
 `name`          varchar(100) NOT NULL ,
 `abbreviation`  varchar(20) NULL ,
 `country`       varchar(45) NOT NULL ,
 `state`         varchar(50) NULL ,
 `excluded`      char NULL ,
 `excluded_date` date NULL ,

PRIMARY KEY (`id`)
) AUTO_INCREMENT=1;


-- ************************************** `population`
CREATE TABLE `population`
(
 `id`            integer NOT NULL AUTO_INCREMENT ,
 `population`    varchar(100) NOT NULL ,
 `excluded`      char NULL ,
 `excluded_date` date NULL ,
 `id_fragment`   integer NOT NULL ,

PRIMARY KEY (`id`),
KEY `fkIdx_110` (`id_fragment`),
CONSTRAINT `FK_110` FOREIGN KEY `fkIdx_110` (`id_fragment`) REFERENCES `fragment` (`id`)
) AUTO_INCREMENT=1;


-- ************************************** `group`
CREATE TABLE `group`
(
 `id`            integer NOT NULL AUTO_INCREMENT ,
 `group`         varchar(100) NOT NULL ,
 `excluded`      char NULL ,
 `excluded_date` date NULL ,
 `id_populatiob` integer NOT NULL ,

PRIMARY KEY (`id`),
KEY `fkIdx_145` (`id_populatiob`),
CONSTRAINT `FK_145` FOREIGN KEY `fkIdx_145` (`id_populatiob`) REFERENCES `population` (`id`)
) AUTO_INCREMENT=1;


-- ************************************** `wild_location`
CREATE TABLE `wild_location`
(
 `email`         varchar(50) NOT NULL ,
 `id_individual` integer NOT NULL ,
 `id_fragment`   integer NOT NULL ,
 `id_population` integer NULL ,
 `id_group`      integer NULL ,
 `excluded`      char NULL ,
 `excluded_date` date NULL ,

PRIMARY KEY (`email`),
KEY `fkIdx_153` (`id_individual`),
CONSTRAINT `FK_153` FOREIGN KEY `fkIdx_153` (`id_individual`) REFERENCES `individual` (`id`),
KEY `fkIdx_156` (`id_group`),
CONSTRAINT `FK_156` FOREIGN KEY `fkIdx_156` (`id_group`) REFERENCES `group` (`id`),
KEY `fkIdx_202` (`id_population`),
CONSTRAINT `FK_202` FOREIGN KEY `fkIdx_202` (`id_population`) REFERENCES `population` (`id`),
KEY `fkIdx_208` (`id_fragment`),
CONSTRAINT `FK_208` FOREIGN KEY `fkIdx_208` (`id_fragment`) REFERENCES `fragment` (`id`)
);


-- ************************************** `estimate_parameter_pop`
CREATE TABLE `estimate_parameter_pop`
(
 `id_population` integer NOT NULL ,
 `id`            integer NOT NULL ,
 `title`         varchar(45) NOT NULL ,
 `observation`   longtext NOT NULL ,

PRIMARY KEY (`id`),
KEY `fkIdx_177` (`id_population`),
CONSTRAINT `FK_177` FOREIGN KEY `fkIdx_177` (`id_population`) REFERENCES `population` (`id`)
);


-- ************************************** `estimate_parameter`
CREATE TABLE `estimate_parameter`
(
 `id`            integer NOT NULL ,
 `id_individual` integer NOT NULL ,
 `title`         varchar(45) NOT NULL ,
 `observation`   longtext NOT NULL ,

PRIMARY KEY (`id`),
KEY `fkIdx_163` (`id_individual`),
CONSTRAINT `FK_163` FOREIGN KEY `fkIdx_163` (`id_individual`) REFERENCES `individual` (`id`)
);




