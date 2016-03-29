-- phpMyAdmin SQL Dump
-- version 4.0.7
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 28, 2016 at 11:25 PM
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
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `experience`
--

CREATE TABLE IF NOT EXISTS `experience` (
  `cv_ID` int(11) NOT NULL DEFAULT '0',
  `film_tv_ID` int(11) NOT NULL DEFAULT '0',
  `theatre_ID` int(11) NOT NULL DEFAULT '0',
  `training_ID` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`cv_ID`,`film_tv_ID`,`theatre_ID`,`training_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `films`
--

CREATE TABLE IF NOT EXISTS `films` (
  `film_tv_ID` int(11) NOT NULL AUTO_INCREMENT,
  `film_year` date DEFAULT NULL,
  `film_role` varchar(255) DEFAULT NULL,
  `film_production` varchar(255) DEFAULT NULL,
  `film_director` varchar(255) DEFAULT NULL,
  `film_company` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`film_tv_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `images`
--

CREATE TABLE IF NOT EXISTS `images` (
  `image_ID` int(11) NOT NULL AUTO_INCREMENT,
  `image_alloc` varchar(255) DEFAULT NULL,
  `image_title` varchar(255) DEFAULT NULL,
  `image_path` varchar(255) DEFAULT NULL,
  `image_descr` varchar(500) DEFAULT NULL,
  `image_group` varchar(255) NOT NULL,
  `image_folder` varchar(255) NOT NULL,
  PRIMARY KEY (`image_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `media`
--

CREATE TABLE IF NOT EXISTS `media` (
  `usr_ID` int(11) NOT NULL DEFAULT '0',
  `music_ID` int(11) NOT NULL DEFAULT '0',
  `video_ID` int(11) NOT NULL DEFAULT '0',
  `image_ID` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`usr_ID`,`music_ID`,`video_ID`,`image_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `media`
--

INSERT INTO `media` (`usr_ID`, `music_ID`, `video_ID`, `image_ID`) VALUES
(1, 0, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `music`
--

CREATE TABLE IF NOT EXISTS `music` (
  `music_ID` int(11) NOT NULL AUTO_INCREMENT,
  `music_alloc` varchar(255) DEFAULT NULL,
  `music_title` varchar(255) DEFAULT NULL,
  `music_path` varchar(255) DEFAULT NULL,
  `music_descr` varchar(500) DEFAULT NULL,
  PRIMARY KEY (`music_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `theatre`
--

CREATE TABLE IF NOT EXISTS `theatre` (
  `theatre_ID` int(11) NOT NULL AUTO_INCREMENT,
  `theatre_year` date DEFAULT NULL,
  `theatre_role` varchar(255) DEFAULT NULL,
  `theatre_production` varchar(255) DEFAULT NULL,
  `theatre_director` varchar(255) DEFAULT NULL,
  `theatre_company` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`theatre_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `training`
--

CREATE TABLE IF NOT EXISTS `training` (
  `training_ID` int(11) NOT NULL AUTO_INCREMENT,
  `training` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`training_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

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
  `video_ID` int(11) NOT NULL AUTO_INCREMENT,
  `video_title` varchar(255) DEFAULT NULL,
  `video_descr` varchar(500) DEFAULT NULL,
  `video_path` varchar(255) DEFAULT NULL,
  `video_group` varchar(255) NOT NULL,
  `video_folder` varchar(255) NOT NULL,
  PRIMARY KEY (`video_ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `video`
--

INSERT INTO `video` (`video_ID`, `video_title`, `video_descr`, `video_path`, `video_group`, `video_folder`) VALUES
(1, 'Title goes here', 'Description is here (leave title or description fields empty in control panel if you don''t want any)', 'https://www.youtube.com/embed/da5rlEZNgXM', 'showreel', '');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
