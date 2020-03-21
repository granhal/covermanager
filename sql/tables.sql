CREATE SCHEMA covermanager;
USE covermanager;

CREATE TABLE students(
    id_student INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    address VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL
)ENGINE=INNODB;
 
INSERT INTO `covermanager`.`students` (`name`, `address`, `email`) VALUES ('a', 'b', 'c');
INSERT INTO `covermanager`.`students` (`name`, `address`, `email`) VALUES ('d', 'e', 'f');

CREATE TABLE telephones(
    id_telephone INT AUTO_INCREMENT PRIMARY KEY,
    number varchar(255) not null UNIQUE,
    id_student INT,
    CONSTRAINT fk_studient_telephone
    FOREIGN KEY (id_student) 
        REFERENCES students(id_student)
        ON UPDATE SET NULL
        ON DELETE SET NULL 
)ENGINE=INNODB;

INSERT INTO `covermanager`.`telephones` (`number`, `id_student`) VALUES ('655', '1');
INSERT INTO `covermanager`.`telephones` (`number`, `id_student`) VALUES ('677', '1');
INSERT INTO `covermanager`.`telephones` (`number`, `id_student`) VALUES ('688', '2');
INSERT INTO `covermanager`.`telephones` (`number`, `id_student`) VALUES ('699', '2');

CREATE TABLE expedients(
    id_expedient INT AUTO_INCREMENT PRIMARY KEY,
    expedient_number varchar(255) not null,
    id_student INT,
    CONSTRAINT fk_studient_expedient
    FOREIGN KEY (id_student) 
        REFERENCES students(id_student)
        ON UPDATE SET NULL
        ON DELETE SET NULL 
)ENGINE=INNODB;

INSERT INTO `covermanager`.`expedients` (`expedient_number`, `id_student`) VALUES ('1', '1');
INSERT INTO `covermanager`.`expedients` (`expedient_number`, `id_student`) VALUES ('2', '1');
INSERT INTO `covermanager`.`expedients` (`expedient_number`, `id_student`) VALUES ('3', '2');
INSERT INTO `covermanager`.`expedients` (`expedient_number`, `id_student`) VALUES ('4', '2');

CREATE TABLE subjects(
    id_subject INT AUTO_INCREMENT PRIMARY KEY,
    name varchar(255) not null,
    note INT,
    id_expedient INT,
    CONSTRAINT fk_subject_expedient
    FOREIGN KEY (id_expedient) 
        REFERENCES expedients(id_expedient)
        ON UPDATE SET NULL
        ON DELETE SET NULL 
)ENGINE=INNODB;

INSERT INTO `covermanager`.`subjects` (`name`, `note`, `id_expedient`) VALUES ('a', '5', '1');
INSERT INTO `covermanager`.`subjects` (`name`, `note`, `id_expedient`) VALUES ('b', '4', '1');
INSERT INTO `covermanager`.`subjects` (`name`, `note`, `id_expedient`) VALUES ('d', '4', '2');
INSERT INTO `covermanager`.`subjects` (`name`, `note`, `id_expedient`) VALUES ('e', '6', '2');
INSERT INTO `covermanager`.`subjects` (`name`, `note`, `id_expedient`) VALUES ('c', '6', '3');
INSERT INTO `covermanager`.`subjects` (`name`, `note`, `id_expedient`) VALUES ('f', '6', '3');
INSERT INTO `covermanager`.`subjects` (`name`, `note`, `id_expedient`) VALUES ('g', '4', '4');
INSERT INTO `covermanager`.`subjects` (`name`, `note`, `id_expedient`) VALUES ('h', '6', '4');
