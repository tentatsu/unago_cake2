SET SESSION FOREIGN_KEY_CHECKS=0;

/* Drop Tables */

DROP TABLE IF EXISTS addresses;
DROP TABLE IF EXISTS question_choices;
DROP TABLE IF EXISTS questionnaires;
DROP TABLE IF EXISTS owners;
DROP TABLE IF EXISTS companies;
DROP TABLE IF EXISTS owner_registrations;
DROP TABLE IF EXISTS question_options;




/* Create Tables */

CREATE TABLE addresses
(
	id bigint NOT NULL AUTO_INCREMENT,
	owner_id bigint NOT NULL,
	zip1 char(3),
	zip2 char(4),
	prefecture_id int,
	address1 varchar(255),
	address2 varchar(255),
	tel varchar(32),
	created datetime,
	modified datetime,
	PRIMARY KEY (id)
);


CREATE TABLE companies
(
	id int NOT NULL,
	name varchar(128) NOT NULL,
	zip char(7),
  prefecture_id int,
	address varchar(255),
	tel varchar(32),
	created datetime,
	modified datetime,
	PRIMARY KEY (id)
);

CREATE TABLE beers
(
  id int NOT NULL,
  name varchar(128) NOT NULL,
  company_id int NOT NULL,
  bitter int NOT NULL ,
  bottle_body int NOT NULL ,
  created datetime,
  modified datetime,
  PRIMARY KEY (id)
);


CREATE TABLE owners
(
	id bigint NOT NULL AUTO_INCREMENT,
	company_id int,
	last_name varchar(32) NOT NULL,
	first_name varchar(32) NOT NULL,
	last_name_kana varchar(32) NOT NULL,
	first_name_kana varchar(32) NOT NULL,
	section varchar(255),
	email varchar(255) NOT NULL,
	password varchar(255),
	prefecture_id int,
	is_open boolean,
	password_reminder_date datetime,
	password_reminder_token varchar(255),
	created datetime,
	modified datetime,
	PRIMARY KEY (id),
	UNIQUE (email)
);


CREATE TABLE owner_registrations
(
	id bigint NOT NULL AUTO_INCREMENT,
	email varchar(255) NOT NULL,
	token varchar(255),
	registration_date datetime,
	created datetime,
	modified datetime,
	PRIMARY KEY (id),
	UNIQUE (email)
);


CREATE TABLE questionnaires
(
	id bigint NOT NULL AUTO_INCREMENT,
	owner_id bigint NOT NULL,
	question_number smallint,
	answer text,
	answer_others text,
	created datetime,
	modified datetime,
	PRIMARY KEY (id)
);


CREATE TABLE question_choices
(
	questionnaire_id bigint NOT NULL,
	question_option_id int NOT NULL
);


CREATE TABLE question_options
(
	id int NOT NULL,
	name varchar(128) NOT NULL,
	question_number smallint,
	is_others boolean,
	PRIMARY KEY (id)
);



/* Create Foreign Keys */

ALTER TABLE owners
	ADD CONSTRAINT owners_fk_company_id FOREIGN KEY (company_id)
	REFERENCES companies (id)
	ON UPDATE CASCADE
	ON DELETE SET NULL
;




ALTER TABLE addresses
	ADD CONSTRAINT addresses_fk_owner_id FOREIGN KEY (owner_id)
	REFERENCES owners (id)
	ON UPDATE CASCADE
	ON DELETE CASCADE
;



ALTER TABLE questionnaires
	ADD CONSTRAINT questionnaires_fk_owner_id FOREIGN KEY (owner_id)
	REFERENCES owners (id)
	ON UPDATE CASCADE
	ON DELETE CASCADE
;


ALTER TABLE question_choices
	ADD CONSTRAINT q2c_fk_quesionnaire_id FOREIGN KEY (questionnaire_id)
	REFERENCES questionnaires (id)
	ON UPDATE CASCADE
	ON DELETE CASCADE
;


ALTER TABLE question_choices
	ADD CONSTRAINT q2c_fk_q2o_id FOREIGN KEY (question_option_id)
	REFERENCES question_options (id)
	ON UPDATE CASCADE
	ON DELETE CASCADE
;



