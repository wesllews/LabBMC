-- ************************************** `login`
CREATE TABLE `login`
(
 `id`            integer NOT NULL AUTO_INCREMENT ,
 `name`          varchar(50) NOT NULL ,
 `institution`   varchar(70) NOT NULL ,
 `justification` text NOT NULL ,
 `email`         varchar(50) NOT NULL UNIQUE,
 `password`      varchar(100) NULL,
 `permission`        varchar(20) NOT NULL,
 `request_date` date NULL ,
 `analyzed_date` date NULL ,

PRIMARY KEY (`id`)
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
CONSTRAINT FOREIGN KEY (`id_individual`) REFERENCES `individual` (`id`) ON DELETE CASCADE
) AUTO_INCREMENT=1;

-- ************************************** `Fragment`
CREATE TABLE `fragment`
(
 `id`        	integer NOT NULL AUTO_INCREMENT ,
 `fragment`     varchar(45) NOT NULL ,
 `country`      varchar(45) NOT NULL ,
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
CONSTRAINT FOREIGN KEY (`id_fragment`) REFERENCES `fragment` (`id`) ON DELETE CASCADE,
) AUTO_INCREMENT=1;

-- ************************************** `ind_group`
CREATE TABLE `ind_group`
(
 `id_individual` integer NOT NULL ,
 `id_group`		integer NOT NULL ,
 `longitude_ind` varchar(45) NULL ,
 `latitude_ind`  varchar(45) NULL ,


 PRIMARY KEY (`id_individual`),
 CONSTRAINT FOREIGN KEY (`id_individual`) REFERENCES `individual` (`id`) ON DELETE CASCADE,
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
CONSTRAINT FOREIGN KEY (`id_individual`) REFERENCES `individual` (`id`) ON DELETE CASCADE,
CONSTRAINT FOREIGN KEY (`id_institute`) REFERENCES `institute` (`id`),
CONSTRAINT FOREIGN KEY (`id_fragment`) REFERENCES `fragment` (`id`)
);

-- ************************************** `kinship`
CREATE TABLE `kinship`
(
 `id_individual` integer NOT NULL ,
 `sire`          integer NOT NULL ,
 `dam`           integer NOT NULL ,

PRIMARY KEY (`id_individual`),
CONSTRAINT FOREIGN KEY (`sire`) REFERENCES `individual` (`id`),
CONSTRAINT FOREIGN KEY (`dam`) REFERENCES `individual` (`id`),
CONSTRAINT FOREIGN KEY (`id_individual`) REFERENCES `individual` (`id`) ON DELETE CASCADE
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
 `id`        	 integer NOT NULL AUTO_INCREMENT ,
 `id_individual` integer NOT NULL ,
 `id_locus`      integer NOT NULL ,
 `allele`        integer NOT NULL ,
 `restricted`    boolean NULL ,
PRIMARY KEY (`id`),
CONSTRAINT FOREIGN KEY (`id_individual`) REFERENCES `individual` (`id`) ON DELETE CASCADE,
CONSTRAINT FOREIGN KEY (`id_locus`) REFERENCES `locus` (`id`)
) AUTO_INCREMENT=1;


-- ************************************** `genomic`
CREATE TABLE `genomic`
(
 `id`        	 integer NOT NULL AUTO_INCREMENT ,
 `id_individual` integer NOT NULL ,
 `platform`      varchar(15) NOT NULL ,
 `link`        	 text NOT NULL ,
PRIMARY KEY (`id`),
CONSTRAINT FOREIGN KEY (`id_individual`) REFERENCES `individual` (`id`) ON DELETE CASCADE
) AUTO_INCREMENT=1;


-- ************************************** `locus`
CREATE TABLE `mitochondrial_locus`
(
 `id`        integer NOT NULL AUTO_INCREMENT ,
 `mitochondrial_locus`     varchar(30) NOT NULL,
PRIMARY KEY (`id`)
) AUTO_INCREMENT=1;

-- ************************************** `haplotypes`
CREATE TABLE `haplotype`
(
 `id`        	 integer NOT NULL AUTO_INCREMENT ,
 `id_individual` integer NOT NULL ,
 `id_mitochondrial_locus`      integer NOT NULL ,
 `haplotype`        text NOT NULL ,
 `restricted`    boolean NULL ,
PRIMARY KEY (`id`),
CONSTRAINT FOREIGN KEY (`id_individual`) REFERENCES `individual` (`id`) ON DELETE CASCADE,
CONSTRAINT FOREIGN KEY (`id_mitochondrial_locus`) REFERENCES `mitochondrial_locus` (`id`)
) AUTO_INCREMENT=1;