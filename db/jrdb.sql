drop database jrdb;
create database jrdb;

use jrdb;

create table ai_images (
	ai_ID int NOT NULL AUTO_INCREMENT,
    PRIMARY KEY(ai_ID)
);

create table ai_exp (
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
	music_title varchar(255),
	music_descr varchar(500),
	music_path varchar(255),
	music_group varchar(255),
	music_folder varchar(255),
	PRIMARY KEY(music_ID)
);

create table video (
	video_ID int,
	video_title varchar(255),
	video_descr varchar(500),
	video_path varchar(255),
	video_group varchar(255),
	video_folder varchar(255),
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
INSERT INTO media (usr_ID, music_ID, video_ID, image_ID) VALUES (1, 0, 1, 0);
INSERT INTO video (video_ID, video_title, video_descr, video_path, video_group, video_folder) VALUES (1, 'title', 'test description', 'https://www.youtube.com/embed/da5rlEZNgXM', 'showreel', ' ');
INSERT INTO cv (cv_ID, cv_name, cv_equity, cv_email, cv_accents, cv_skills, cv_height, cv_chest, cv_waist, cv_inside_leg, cv_eyes, cv_hair, cv_build, cv_playing_age) VALUES (1,"Jamie Rodden","M00312130","jamieroddengigs@hotmail.co.uk","Glasgow, Aberdeen (Doric), Fife, German, Russian, Standard American, New York, Irish, Australian, RP, Liverpool, Yorkshire, London.","Sing, play guitar, (acoustic/electric/read guitar tab/write own music) Full Clean Driving License, Advanced Stage Fighting and Movement skills. Theatre in Education workshop leader.",6.2,42,36,32,"Blue","Brown","Slim","25---35 yrs");
INSERT INTO training (training_ID, training) VALUES (1, "BA (HONS) PERFORMANCE --- U.W.S.");
INSERT INTO experience (cv_ID, film_tv_ID, theatre_ID, training_ID) VALUES (1, 0, 0, 1);
INSERT INTO ai_exp () VALUES ();
INSERT INTO training (training_ID, training) VALUES (2, "MASTERCLASS KENNY GLENNAN");
INSERT INTO experience (cv_ID, film_tv_ID, theatre_ID, training_ID) VALUES (1, 0, 0, 2);
INSERT INTO ai_exp () VALUES ();
INSERT INTO training (training_ID, training) VALUES (3, "HND ACTING & PERFORMANCE --- FIFE COLLEGE");
INSERT INTO experience (cv_ID, film_tv_ID, theatre_ID, training_ID) VALUES (1, 0, 0, 3);
INSERT INTO ai_exp () VALUES ();