drop database jrdb;
create database jrdb;

use jrdb;

create table ai_images (
	ai_ID int NOT NULL AUTO_INCREMENT,
    PRIMARY KEY(ai_ID)
);

create table user (
	usr_ID int NOT NULL AUTO_INCREMENT,
    cv_ID integer,
    usr_name varchar(255),
    usr_psswd varchar(255),
    PRIMARY KEY(usr_ID)
);

create table cv (
	cv_ID int NOT NULL AUTO_INCREMENT,
    cv_name varchar(255),
    cv_equity varchar(255),
	cv_email varchar(255),
	cv_accents varchar(255),
	cv_skills varchar(255),
	cv_height varchar(255),
	cv_chest varchar(255),
	cv_waist varchar(255),
	cv_inside_leg varchar(255),
	cv_eyes varchar(255),
	cv_hair varchar(255),
	cv_build varchar(255),
	cv_playing_age varchar(255),
	PRIMARY KEY(cv_ID)
);

create table media (
	usr_ID integer,
	music_ID integer,
	video_ID integer,
	image_ID integer,
	PRIMARY KEY(usr_ID,music_ID,video_ID,image_ID)
);

create table music (
	music_ID int,
	music_alloc varchar(255),
	music_title varchar(255),
	music_path varchar(255),
	music_descr varchar(500),
	PRIMARY KEY(music_ID)
);

create table video (
	video_ID int,
	video_alloc varchar(255),
	video_title varchar(255),
	video_path varchar(255),
	video_descr varchar(500),
	PRIMARY KEY(video_ID)
);

create table images (
	image_ID int,
	image_title varchar(255),
	image_descr varchar(500),
	image_path varchar(255),
	image_group varchar(255),
	image_folder varchar(255),
	PRIMARY KEY(image_ID)
);

create table experience (
	cv_ID integer,
	film_tv_ID integer,
	theatre_ID integer,
	training_ID integer,
	PRIMARY KEY(cv_ID,film_tv_ID,theatre_ID,training_ID)
);

create table films (
	film_tv_ID int NOT NULL AUTO_INCREMENT,
	film_year date,
	film_role varchar(255),
	film_production varchar(255),
	film_director varchar(255),
	film_company varchar(255),
	PRIMARY KEY(film_tv_ID)
);

create table theatre (
	theatre_ID int NOT NULL AUTO_INCREMENT,
	theatre_year date,
	theatre_role varchar(255),
	theatre_production varchar(255),
	theatre_director varchar(255),
	theatre_company varchar(255),
	PRIMARY KEY(theatre_ID)
);

create table training (
	training_ID int NOT NULL AUTO_INCREMENT,
	training varchar(255),
	PRIMARY KEY(training_ID)
);

INSERT INTO user (usr_ID, cv_ID, usr_name, usr_psswd) VALUES (1, 1, '#onlyAdmin', '$2y$15$PYNwHlxwvMkRN3J7QbhlDurjzKNjuS8pAbukg.CTy1vOxjnWHY4Ce');