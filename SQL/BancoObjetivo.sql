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
 `studbook`      varchar(15) NULL UNIQUE ,
 `id_category`   integer NOT NULL ,
 `sex`           varchar(15) NOT NULL ,
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
 `id_individual` integer NOT NULL ,
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
CONSTRAINT `FK_91` FOREIGN KEY `fkIdx_91` (`id_individual`) REFERENCES `individual` (`id`)
) AUTO_INCREMENT=1;


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
INSERT INTO `institute` (`id`, `name`, `abbreviation`, `country`, `state`, `city`, `excluded`, `excluded_date`) VALUES (NULL,'Buri','BURI','Brazil','São Paulo','Buri
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
INSERT INTO `institute` (`id`, `name`, `abbreviation`, `country`, `state`, `city`, `excluded`, `excluded_date`) VALUES (NULL,'Brazil','BRAZIL','Brazil','Not specified','NA
', 'n', NULL);
INSERT INTO `institute` (`id`, `name`, `abbreviation`, `country`, `state`, `city`, `excluded`, `excluded_date`) VALUES (NULL,'WILD','WILD','Unknown','Not specified','NA
', 'n', NULL);






INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '1', '1', 'Male', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '2', '1', 'Female', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '3', '1', 'Male', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '4', '1', 'Female', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '5', '1', 'Male', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '6', '1', 'Female', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '7', '1', 'Female', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '8', '1', 'Male', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '9', '1', 'Female', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '10', '1', 'Male', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '11', '1', 'Female', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '12', '1', 'Male', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '13', '1', 'Male', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '14', '1', 'Female', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '15', '1', 'Male', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '16', '1', 'Male', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '17', '1', 'Male', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '18', '1', 'Female', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '19', '1', 'Female', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '20', '1', 'Female', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '21', '1', 'Male', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '22', '1', 'Female', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '23', '1', 'Male', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '24', '1', 'Female', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '25', '1', 'Female', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '26', '1', 'Male', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '27', '1', 'Male', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '28', '1', 'Female', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '29', '1', 'Male', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '30', '1', 'Male', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '31', '1', 'Male', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '32', '1', 'Male', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '33', '1', 'Male', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '34', '1', 'Male', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '35', '1', 'Female', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '36', '1', 'Male', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '37', '1', 'Male', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '38', '1', 'Male', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '39', '1', 'Female', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '40', '1', 'Male', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '41', '1', 'Unknown', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '42', '1', 'Male', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '43', '1', 'Male', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '44', '1', 'Female', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '45', '1', 'Male', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '46', '1', 'Unknown', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '47', '1', 'Male', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '48', '1', 'Female', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '49', '1', 'Female', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '50', '1', 'Male', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '51', '1', 'Male', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '52', '1', 'Female', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '53', '1', 'Male', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '54', '1', 'Male', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '55', '1', 'Female', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '56', '1', 'Female', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '57', '1', 'Female', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '58', '1', 'Male', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '59', '1', 'Male', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '60', '1', 'Female', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '61', '1', 'Unknown', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '62', '1', 'Female', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '63', '1', 'Female', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '64', '1', 'Female', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '65', '1', 'Female', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '66', '1', 'Male', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '67', '1', 'Female', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '68', '1', 'Female', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '69', '1', 'Male', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '70', '1', 'Female', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '71', '1', 'Male', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '72', '1', 'Female', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '73', '1', 'Male', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '74', '1', 'Female', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '75', '1', 'Male', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL,'76' , '1', 'Female', '689', 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '77', '1', 'Male', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL,'78' , '1', 'Female', '691', 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '79', '1', 'Male', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '80', '1', 'Male', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '81', '1', 'Female', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '82', '1', 'Female', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '83', '1', 'Male', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL,'84' , '1', 'Male', 'CLAUDIO', 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '85', '1', 'Female', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '86', '1', 'Male', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '87', '1', 'Male', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '88', '1', 'Male', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '89', '1', 'Female', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '90', '1', 'Female', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '91', '1', 'Female', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '92', '1', 'Female', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '93', '1', 'Male', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '94', '1', 'Female', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '95', '1', 'Female', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '96', '1', 'Male', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '97', '1', 'Male', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '98', '1', 'Female', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '99', '1', 'Male', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '100', '1', 'Female', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '101', '1', 'Unknown', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '102', '1', 'Unknown', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '103', '1', 'Male', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '104', '1', 'Male', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL,'105' , '1', 'Female', 'MARIA', 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '106', '1', 'Male', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '107', '1', 'Male', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '108', '1', 'Male', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '109', '1', 'Male', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL,'110' , '1', 'Female', 'GERTIE', 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '111', '1', 'Female', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '112', '1', 'Male', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '113', '1', 'Male', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '114', '1', 'Male', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '115', '1', 'Male', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '116', '1', 'Male', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '117', '1', 'Female', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '118', '1', 'Male', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '119', '1', 'Male', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '120', '1', 'Unknown', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '121', '1', 'Female', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '122', '1', 'Male', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '123', '1', 'Male', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '124', '1', 'Male', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL,'125' , '1', 'Female', 'ESME', 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '126', '1', 'Male', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '127', '1', 'Female', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '128', '1', 'Male', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '129', '1', 'Male', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '130', '1', 'Male', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '131', '1', 'Male', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '132', '1', 'Male', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '133', '1', 'Female', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '134', '1', 'Male', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '135', '1', 'Female', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '136', '1', 'Male', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '137', '1', 'Male', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '138', '1', 'Female', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '139', '1', 'Male', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL,'140' , '1', 'Female', 'TINA', 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '141', '1', 'Female', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL,'142' , '1', 'Male', 'CAPTAIN', 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '143', '1', 'Female', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '144', '1', 'Male', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '145', '1', 'Male', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '146', '1', 'Female', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '147', '1', 'Male', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '148', '1', 'Female', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '149', '1', 'Male', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '150', '1', 'Male', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '151', '1', 'Female', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '152', '1', 'Male', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '153', '1', 'Male', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL,'154' , '1', 'Male', 'NICEIKE', 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '155', '1', 'Female', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '156', '1', 'Male', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '157', '1', 'Male', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '158', '1', 'Female', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '159', '1', 'Unknown', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '160', '1', 'Male', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '161', '1', 'Male', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '162', '1', 'Female', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '163', '1', 'Female', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '164', '1', 'Unknown', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '165', '1', 'Male', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '166', '1', 'Female', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '167', '1', 'Female', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL,'168' , '1', 'Female', 'DEVRA', 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '169', '1', 'Male', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '170', '1', 'Male', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '171', '1', 'Female', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '172', '1', 'Female', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '173', '1', 'Male', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '174', '1', 'Female', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '175', '1', 'Male', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '176', '1', 'Female', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '177', '1', 'Male', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '178', '1', 'Female', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '179', '1', 'Male', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '180', '1', 'Male', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '181', '1', 'Female', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '182', '1', 'Male', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '183', '1', 'Male', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '184', '1', 'Male', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '185', '1', 'Female', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '186', '1', 'Male', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '187', '1', 'Male', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '188', '1', 'Male', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL,'189' , '1', 'Male', 'AMOS', 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '190', '1', 'Male', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '191', '1', 'Female', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '192', '1', 'Female', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL,'193' , '1', 'Male', 'LAURY', 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL,'194' , '1', 'Male', 'CLAUDIO', 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL,'195' , '1', 'Male', 'PINON', 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '196', '1', 'Female', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '197', '1', 'Male', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '198', '1', 'Female', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '199', '1', 'Male', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL,'200' , '1', 'Female', 'TENILLE', 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '201', '1', 'Male', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '202', '1', 'Male', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '203', '1', 'Male', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '204', '1', 'Female', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '205', '1', 'Male', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '206', '1', 'Female', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '207', '1', 'Male', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '208', '1', 'Female', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL,'209' , '1', 'Male', 'DIAMANTE', 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '210', '1', 'Female', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL,'211' , '1', 'Female', 'CRISTAL', 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '212', '1', 'Male', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '213', '1', 'Female', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '214', '1', 'Female', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '215', '1', 'Male', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '216', '1', 'Female', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '217', '1', 'Female', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '218', '1', 'Male', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '219', '1', 'Male', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL,'220' , '1', 'Female', 'TELVA', 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '221', '1', 'Unknown', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '222', '1', 'Male', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '223', '1', 'Male', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '224', '1', 'Female', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '225', '1', 'Unknown', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '226', '1', 'Unknown', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '227', '1', 'Male', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '228', '1', 'Female', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '229', '1', 'Female', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '230', '1', 'Female', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '231', '1', 'Male', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '232', '1', 'Female', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL,'233' , '1', 'Female', 'DIANA', 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '234', '1', 'Unknown', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '235', '1', 'Unknown', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '236', '1', 'Female', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL,'237' , '1', 'Female', 'YARA', 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '238', '1', 'Unknown', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '239', '1', 'Male', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '240', '1', 'Female', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '241', '1', 'Female', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '242', '1', 'Female', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '243', '1', 'Female', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '244', '1', 'Unknown', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '245', '1', 'Unknown', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '246', '1', 'Female', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '247', '1', 'Male', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '248', '1', 'Male', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '249', '1', 'Female', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '250', '1', 'Female', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '251', '1', 'Male', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '252', '1', 'Female', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '253', '1', 'Male', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL,'254' , '1', 'Female', 'CASSIE', 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '255', '1', 'Unknown', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL,'256' , '1', 'Male', 'FERNANDO', 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '257', '1', 'Unknown', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '258', '1', 'Male', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '259', '1', 'Male', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL,'260' , '1', 'Male', 'MARCO', 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL,'261' , '1', 'Female', 'INEZ', 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '262', '1', 'Unknown', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '263', '1', 'Male', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '264', '1', 'Male', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '265', '1', 'Male', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '266', '1', 'Female', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '267', '1', 'Female', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '268', '1', 'Male', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '269', '1', 'Unknown', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '270', '1', 'Unknown', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '271', '1', 'Unknown', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '272', '1', 'Unknown', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL,'273' , '1', 'Female', 'PRETINHA', 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '274', '1', 'Male', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '275', '1', 'Unknown', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '276', '1', 'Male', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '277', '1', 'Male', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '278', '1', 'Female', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '279', '1', 'Male', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '280', '1', 'Female', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '281', '1', 'Male', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '282', '1', 'Unknown', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '283', '1', 'Female', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '284', '1', 'Male', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '285', '1', 'Male', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '286', '1', 'Male', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '287', '1', 'Unknown', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '288', '1', 'Unknown', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '289', '1', 'Unknown', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '290', '1', 'Unknown', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '291', '1', 'Male', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '292', '1', 'Male', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '293', '1', 'Male', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL,'294' , '1', 'Male', 'EPI', 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL,'295' , '1', 'Male', 'BLAS', 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '296', '1', 'Female', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '297', '1', 'Male', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '298', '1', 'Female', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL,'299' , '1', 'Female', 'LEONIE', 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL,'300' , '1', 'Male', 'LEONARDO', 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL,'301' , '1', 'Female', '1924', 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL,'302' , '1', 'Female', 'MAGDA', 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '303', '1', 'Unknown', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '304', '1', 'Unknown', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL,'305' , '1', 'Male', 'VANDALAI', 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL,'306' , '1', 'Female', 'ROXANNE', 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '307', '1', 'Male', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '308', '1', 'Male', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '309', '1', 'Female', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '310', '1', 'Female', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '311', '1', 'Female', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '312', '1', 'Male', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '313', '1', 'Male', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '314', '1', 'Female', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '315', '1', 'Female', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '316', '1', 'Male', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '317', '1', 'Male', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL,'318' , '1', 'Female', 'EVA ', 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '319', '1', 'Female', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '320', '1', 'Male', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '321', '1', 'Male', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '322', '1', 'Unknown', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '323', '1', 'Female', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '324', '1', 'Female', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '325', '1', 'Male', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '326', '1', 'Male', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL,'327' , '1', 'Male', 'ARCHIE', 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL,'328' , '1', 'Female', 'COCO', 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '329', '1', 'Male', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '330', '1', 'Female', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '331', '1', 'Male', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL,'332' , '1', 'Male', 'STICKY', 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL,'333' , '1', 'Male', 'ERIC', 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '334', '1', 'Male', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '335', '1', 'Male', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '336', '1', 'Female', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '337', '1', 'Female', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '338', '1', 'Unknown', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '339', '1', 'Female', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '340', '1', 'Unknown', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '341', '1', 'Unknown', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '342', '1', 'Unknown', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '343', '1', 'Unknown', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '344', '1', 'Unknown', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '345', '1', 'Female', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '346', '1', 'Male', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '347', '1', 'Female', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL,'348' , '1', 'Female', 'TAVO', 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL,'349' , '1', 'Female', 'TRIQUI', 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '350', '1', 'Unknown', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '351', '1', 'Female', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '352', '1', 'Female', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL,'353' , '1', 'Male', 'tupi', 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL,'354' , '1', 'Female', 'CAJA', 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '355', '1', 'Female', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '356', '1', 'Unknown', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '357', '1', 'Male', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '358', '1', 'Male', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '359', '1', 'Unknown', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '360', '1', 'Unknown', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL,'363' , '1', 'Female', 'LUANA', 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL,'364' , '1', 'Female', 'JAVIER', 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '365', '1', 'Male', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '366', '1', 'Female', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '367', '1', 'Male', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '368', '1', 'Male', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '369', '1', 'Male', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '370', '1', 'Female', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL,'371' , '1', 'Male', 'ELMO', 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL,'372' , '1', 'Male', 'ELMO', 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '373', '1', 'Female', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '374', '1', 'Male', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '375', '1', 'Female', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '376', '1', 'Unknown', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '377', '1', 'Male', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '378', '1', 'Male', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '379', '1', 'Male', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '380', '1', 'Unknown', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '381', '1', 'Unknown', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '382', '1', 'Male', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '383', '1', 'Female', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '384', '1', 'Male', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '385', '1', 'Male', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '386', '1', 'Male', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '387', '1', 'Male', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '388', '1', 'Unknown', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '389', '1', 'Male', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '390', '1', 'Male', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '391', '1', 'Male', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '392', '1', 'Male', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '393', '1', 'Unknown', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '394', '1', 'Female', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '395', '1', 'Male', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '396', '1', 'Unknown', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL,'397' , '1', 'Female', 'BERTHA', 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL,'398' , '1', 'Female', 'ERNIE', 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '399', '1', 'Female', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '400', '1', 'Female', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '401', '1', 'Unknown', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '402', '1', 'Unknown', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '403', '1', 'Unknown', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '404', '1', 'Unknown', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '405', '1', 'Unknown', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '406', '1', 'Unknown', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '407', '1', 'Unknown', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '408', '1', 'Female', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL,'409' , '1', 'Male', 'FLUFFY', 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL,'410' , '1', 'Male', 'LENNY', 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '411', '1', 'Male', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '412', '1', 'Male', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '413', '1', 'Male', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '414', '1', 'Female', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '415', '1', 'Female', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '416', '1', 'Female', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '417', '1', 'Unknown', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL,'418' , '1', 'Female', 'GIRL', 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL,'419' , '1', 'Male', 'RUNT', 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL,'420' , '1', 'Male', 'BIG BOY', 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '421', '1', 'Female', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '422', '1', 'Female', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '423', '1', 'Male', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '424', '1', 'Male', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '425', '1', 'Male', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '426', '1', 'Male', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '427', '1', 'Male', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '428', '1', 'Male', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '429', '1', 'Male', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL,'430' , '1', 'Female', 'KINHA', 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '431', '1', 'Male', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '432', '1', 'Female', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '433', '1', 'Male', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '436', '1', 'Female', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '437', '1', 'Male', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '438', '1', 'Unknown', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '439', '1', 'Female', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '440', '1', 'Unknown', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '441', '1', 'Female', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '442', '1', 'Unknown', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '443', '1', 'Unknown', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '444', '1', 'Unknown', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '445', '1', 'Unknown', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '446', '1', 'Unknown', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '447', '1', 'Unknown', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '448', '1', 'Unknown', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '449', '1', 'Unknown', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '450', '1', 'Female', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '451', '1', 'Male', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '452', '1', 'Female', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '453', '1', 'Female', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '454', '1', 'Female', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '455', '1', 'Male', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '456', '1', 'Male', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '457', '1', 'Male', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '458', '1', 'Female', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '459', '1', 'Male', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '460', '1', 'Male', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '461', '1', 'Unknown', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '462', '1', 'Female', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '463', '1', 'Unknown', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL,'464' , '1', 'Male', 'OMERINHO', 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '465', '1', 'Male', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '466', '1', 'Female', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '467', '1', 'Female', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL,'468' , '1', 'Male', 'FRANCISCO', 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '469', '1', 'Male', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '470', '1', 'Male', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '471', '1', 'Male', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '472', '1', 'Male', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '473', '1', 'Male', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '474', '1', 'Male', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '475', '1', 'Male', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '476', '1', 'Male', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '477', '1', 'Male', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '478', '1', 'Male', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '479', '1', 'Female', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '480', '1', 'Male', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '481', '1', 'Female', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '482', '1', 'Male', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '483', '1', 'Male', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '484', '1', 'Male', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '485', '1', 'Female', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '486', '1', 'Male', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '487', '1', 'Female', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '488', '1', 'Male', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '489', '1', 'Unknown', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '490', '1', 'Female', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '491', '1', 'Male', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '492', '1', 'Male', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '493', '1', 'Female', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '494', '1', 'Female', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '495', '1', 'Female', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '496', '1', 'Female', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '497', '1', 'Unknown', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '498', '1', 'Male', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '499', '1', 'Unknown', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '500', '1', 'Unknown', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '501', '1', 'Unknown', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '502', '1', 'Female', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '503', '1', 'Unknown', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '504', '1', 'Unknown', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '505', '1', 'Unknown', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '506', '1', 'Female', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '507', '1', 'Unknown', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, '508', '1', 'Unknown', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, 'TE64', '1', 'Male', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, 'TE65', '1', 'Unknown', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, 'TE66', '1', 'Unknown', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, 'TE67', '1', 'Unknown', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, 'TE68', '1', 'Male', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, 'TE69', '1', 'Male', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, 'TE70', '1', 'Unknown', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, 'TE71', '1', 'Unknown', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, 'TE72', '1', 'Male', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL,'TE73' , '1', 'Male', 'Kinho', 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, 'TE74', '1', 'Unknown', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, 'TE75', '1', 'Unknown', NULL, 'n', NULL);
INSERT INTO `individual` (`id`, `studbook`, `id_category`, `sex`, `name`, `excluded`, `excluded_date`) VALUES (NULL, 'TE76', '1', 'Unknown', NULL, 'n', NULL);