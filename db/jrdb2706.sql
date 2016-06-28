-- phpMyAdmin SQL Dump
-- version 4.0.7
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jun 27, 2016 at 11:09 PM
-- Server version: 5.5.47
-- PHP Version: 5.3.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `cl57-jrdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `ai_films`
--

CREATE TABLE IF NOT EXISTS `ai_films` (
  `ai_ID` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`ai_ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `ai_films`
--

INSERT INTO `ai_films` (`ai_ID`) VALUES
(1),
(2),
(3),
(4),
(5),
(6);

-- --------------------------------------------------------

--
-- Table structure for table `ai_images`
--

CREATE TABLE IF NOT EXISTS `ai_images` (
  `ai_ID` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`ai_ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `ai_images`
--

INSERT INTO `ai_images` (`ai_ID`) VALUES
(3);

-- --------------------------------------------------------

--
-- Table structure for table `ai_music`
--

CREATE TABLE IF NOT EXISTS `ai_music` (
  `ai_ID` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`ai_ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

-- --------------------------------------------------------

--
-- Table structure for table `ai_theatre`
--

CREATE TABLE IF NOT EXISTS `ai_theatre` (
  `ai_ID` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`ai_ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `ai_theatre`
--

INSERT INTO `ai_theatre` (`ai_ID`) VALUES
(1),
(2);

-- --------------------------------------------------------

--
-- Table structure for table `ai_training`
--

CREATE TABLE IF NOT EXISTS `ai_training` (
  `ai_ID` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`ai_ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `ai_training`
--

INSERT INTO `ai_training` (`ai_ID`) VALUES
(1),
(2),
(3);

-- --------------------------------------------------------

--
-- Table structure for table `ai_video`
--

CREATE TABLE IF NOT EXISTS `ai_video` (
  `ai_ID` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`ai_ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `ai_video`
--

INSERT INTO `ai_video` (`ai_ID`) VALUES
(7),
(8);

-- --------------------------------------------------------

--
-- Table structure for table `cv`
--

CREATE TABLE IF NOT EXISTS `cv` (
  `cv_ID` int(11) NOT NULL AUTO_INCREMENT,
  `cv_name` varchar(255) DEFAULT NULL,
  `cv_equity` varchar(255) DEFAULT NULL,
  `cv_email` varchar(255) DEFAULT NULL,
  `cv_accents` varchar(255) DEFAULT NULL,
  `cv_skills` varchar(255) DEFAULT NULL,
  `cv_height` varchar(255) DEFAULT NULL,
  `cv_chest` varchar(255) DEFAULT NULL,
  `cv_waist` varchar(255) DEFAULT NULL,
  `cv_inside_leg` varchar(255) DEFAULT NULL,
  `cv_eyes` varchar(255) DEFAULT NULL,
  `cv_hair` varchar(255) DEFAULT NULL,
  `cv_build` varchar(255) DEFAULT NULL,
  `cv_playing_age` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`cv_ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `cv`
--

INSERT INTO `cv` (`cv_ID`, `cv_name`, `cv_equity`, `cv_email`, `cv_accents`, `cv_skills`, `cv_height`, `cv_chest`, `cv_waist`, `cv_inside_leg`, `cv_eyes`, `cv_hair`, `cv_build`, `cv_playing_age`) VALUES
(1, 'Jamie Rodden', 'M00312130', 'jamieroddengigs@hotmail.co.uk', 'Glasgow, Aberdeen (Doric), Fife, German, Russian, Standard American, New York, Irish, Australian, RP, Liverpool, Yorkshire, London.', 'Sing, play guitar, (acoustic/electric/read guitar tab/write own music) Full Clean Driving License, Advanced Stage Fighting and Movement skills. Theatre in Education workshop leader.', '6.2', '42', '36', '32', 'Blue', 'Brown', 'Slim', '25---35 yrs');

-- --------------------------------------------------------

--
-- Table structure for table `experience`
--

CREATE TABLE IF NOT EXISTS `experience` (
  `cv_ID` int(11) NOT NULL,
  `film_tv_ID` int(11) NOT NULL,
  `theatre_ID` int(11) NOT NULL,
  `training_ID` int(11) NOT NULL,
  PRIMARY KEY (`cv_ID`,`film_tv_ID`,`theatre_ID`,`training_ID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `experience`
--

INSERT INTO `experience` (`cv_ID`, `film_tv_ID`, `theatre_ID`, `training_ID`) VALUES
(1, 0, 0, 1),
(1, 0, 0, 2),
(1, 0, 0, 3),
(1, 0, 1, 0),
(1, 0, 2, 0),
(1, 1, 0, 0),
(1, 2, 0, 0),
(1, 3, 0, 0),
(1, 4, 0, 0),
(1, 5, 0, 0),
(1, 6, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `films`
--

CREATE TABLE IF NOT EXISTS `films` (
  `film_tv_ID` int(11) NOT NULL AUTO_INCREMENT,
  `film_year` year(4) DEFAULT NULL,
  `film_role` varchar(255) DEFAULT NULL,
  `film_production` varchar(255) DEFAULT NULL,
  `film_director` varchar(255) DEFAULT NULL,
  `film_company` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`film_tv_ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `films`
--

INSERT INTO `films` (`film_tv_ID`, `film_year`, `film_role`, `film_production`, `film_director`, `film_company`) VALUES
(1, 2015, 'Brother', 'Manifest', 'Darren Campbell', 'Eternal Video'),
(2, 2012, 'G. Orwell', 'Down and Out in Paris and London', 'Graeme Macdonald', '(RGU) Student Film Clanfilms'),
(3, 2011, 'Soldier', 'His Brothers Keeper', 'Lee Hutcheon', ''),
(4, 2009, 'Boyfriend', 'Honolulu Honeyz - Music Video', 'Adam Geddes', '(UWS) Student Film Clanfilms'),
(5, 2007, 'Fisherman', 'The Clan', 'Lee Hutcheon', ''),
(6, 2006, 'Prison Tatooist', 'Forgotten Souls www.tvpfilm.com/forgottensouls.htm', 'Ricky Wood Jnr', 'TVP Films');

-- --------------------------------------------------------

--
-- Table structure for table `images`
--

CREATE TABLE IF NOT EXISTS `images` (
  `image_ID` int(11) NOT NULL,
  `image_title` varchar(255) DEFAULT NULL,
  `image_descr` varchar(500) DEFAULT NULL,
  `image_path` varchar(255) DEFAULT NULL,
  `image_group` varchar(255) DEFAULT NULL,
  `image_folder` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`image_ID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `images`
--

INSERT INTO `images` (`image_ID`, `image_title`, `image_descr`, `image_path`, `image_group`, `image_folder`) VALUES
(3, '', ' ', '../uploaded_photos/6.1466892978.jpg', 'acting', '');

-- --------------------------------------------------------

--
-- Table structure for table `media`
--

CREATE TABLE IF NOT EXISTS `media` (
  `usr_ID` int(11) NOT NULL,
  `music_ID` int(11) NOT NULL,
  `video_ID` int(11) NOT NULL,
  `image_ID` int(11) NOT NULL,
  PRIMARY KEY (`usr_ID`,`music_ID`,`video_ID`,`image_ID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `media`
--

INSERT INTO `media` (`usr_ID`, `music_ID`, `video_ID`, `image_ID`) VALUES
(1, 0, 0, 3),
(1, 0, 1, 0),
(1, 0, 7, 0),
(1, 0, 8, 0);

-- --------------------------------------------------------

--
-- Table structure for table `music`
--

CREATE TABLE IF NOT EXISTS `music` (
  `music_ID` int(11) NOT NULL,
  `music_title` varchar(255) DEFAULT NULL,
  `music_descr` varchar(500) DEFAULT NULL,
  `music_path` varchar(255) DEFAULT NULL,
  `music_group` varchar(255) DEFAULT NULL,
  `music_folder` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`music_ID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `theatre`
--

CREATE TABLE IF NOT EXISTS `theatre` (
  `theatre_ID` int(11) NOT NULL AUTO_INCREMENT,
  `theatre_year` year(4) DEFAULT NULL,
  `theatre_role` varchar(255) DEFAULT NULL,
  `theatre_production` varchar(255) DEFAULT NULL,
  `theatre_director` varchar(255) DEFAULT NULL,
  `theatre_company` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`theatre_ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `theatre`
--

INSERT INTO `theatre` (`theatre_ID`, `theatre_year`, `theatre_role`, `theatre_production`, `theatre_director`, `theatre_company`) VALUES
(1, 2015, 'Ma Rooby Tress', 'Jack and the Beanstalk', 'Wilma Gillanders', 'ACT Aberdeen'),
(2, 2015, 'Lord George Byron', 'Touched By Fire (Ed Fringe)', 'Chris Begg', 'Quids In Theatre');

-- --------------------------------------------------------

--
-- Table structure for table `training`
--

CREATE TABLE IF NOT EXISTS `training` (
  `training_ID` int(11) NOT NULL AUTO_INCREMENT,
  `training` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`training_ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `training`
--

INSERT INTO `training` (`training_ID`, `training`) VALUES
(1, 'BA (HONS) PERFORMANCE --- U.W.S.'),
(2, 'MASTERCLASS KENNY GLENNAN'),
(3, 'HND ACTING & PERFORMANCE --- FIFE COLLEGE');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `usr_ID` int(11) NOT NULL AUTO_INCREMENT,
  `cv_ID` int(11) DEFAULT NULL,
  `usr_name` varchar(255) DEFAULT NULL,
  `usr_psswd` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`usr_ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`usr_ID`, `cv_ID`, `usr_name`, `usr_psswd`) VALUES
(1, 1, '#onlyAdmin', '$2y$15$PYNwHlxwvMkRN3J7QbhlDurjzKNjuS8pAbukg.CTy1vOxjnWHY4Ce');

-- --------------------------------------------------------

--
-- Table structure for table `video`
--

CREATE TABLE IF NOT EXISTS `video` (
  `video_ID` int(11) NOT NULL,
  `video_title` varchar(255) DEFAULT NULL,
  `video_descr` varchar(500) DEFAULT NULL,
  `video_path` varchar(255) DEFAULT NULL,
  `video_group` varchar(255) DEFAULT NULL,
  `video_folder` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`video_ID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `video`
--

INSERT INTO `video` (`video_ID`, `video_title`, `video_descr`, `video_path`, `video_group`, `video_folder`) VALUES
(1, 'title', 'test description', 'https://www.youtube.com/embed/da5rlEZNgXM', 'showreel', ' '),
(8, 'test 2 ', 'ffffff', 'https://www.youtube.com/embed/yQjub-xKF-U', 'acting', 'gjh'),
(7, 'Test video title', 'Some explanatory description... Some explanatory description... Some explanatory description...', 'https://www.youtube.com/embed/yQjub-xKF-U', 'acting', '');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
