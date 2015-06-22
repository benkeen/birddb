-- phpMyAdmin SQL Dump
-- version 4.2.10
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jun 21, 2015 at 07:17 PM
-- Server version: 5.5.38
-- PHP Version: 5.6.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `birds`
--

-- --------------------------------------------------------

--
-- Table structure for table `authors`
--

CREATE TABLE `authors` (
`authorId` mediumint(9) NOT NULL,
  `authorName` varchar(255) NOT NULL,
  `authorEmail` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `images`
--

CREATE TABLE `images` (
`imageId` mediumint(9) NOT NULL,
  `status` enum('incomplete','ready_for_review','live') NOT NULL DEFAULT 'incomplete',
  `dateCreated` datetime NOT NULL,
  `lastEdited` datetime NOT NULL,
  `filename` varchar(30) NOT NULL,
  `speciesId` mediumint(9) DEFAULT NULL,
  `numBirds` enum('single','multiple') DEFAULT NULL,
  `gender` enum('male','female','unknown') DEFAULT NULL,
  `age` enum('juvenile','immature','adult','unknown') DEFAULT NULL,
  `activity` enum('flying','perched','in-nest','sitting','climbing','walking','standing','swimming','unknown','other') DEFAULT NULL,
  `proximity` enum('close','mid-range','far') DEFAULT NULL,
  `idDifficulty` enum('easy','okay','difficult') DEFAULT NULL,
  `lat` varchar(50) NOT NULL,
  `lng` varchar(50) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=46 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `imageTagList`
--

CREATE TABLE `imageTagList` (
`tagId` mediumint(9) NOT NULL,
  `tag` varchar(50) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `imageTags`
--

CREATE TABLE `imageTags` (
  `imageId` int(11) NOT NULL,
  `tagId` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `session_id` varchar(100) NOT NULL DEFAULT '',
  `session_data` text NOT NULL,
  `expires` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `species`
--

CREATE TABLE `species` (
`id` mediumint(9) NOT NULL,
  `numericOrder` mediumint(9) NOT NULL,
  `category` varchar(255) NOT NULL,
  `speciesCode` varchar(255) NOT NULL,
  `sciName` varchar(255) NOT NULL,
  `commonName` varchar(255) NOT NULL,
  `taxonomyOrder` varchar(255) NOT NULL,
  `family` varchar(255) NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=14441 DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `authors`
--
ALTER TABLE `authors`
 ADD PRIMARY KEY (`authorId`);

--
-- Indexes for table `images`
--
ALTER TABLE `images`
 ADD PRIMARY KEY (`imageId`);

--
-- Indexes for table `imageTagList`
--
ALTER TABLE `imageTagList`
 ADD PRIMARY KEY (`tagId`);

--
-- Indexes for table `imageTags`
--
ALTER TABLE `imageTags`
 ADD PRIMARY KEY (`imageId`,`tagId`);

--
-- Indexes for table `species`
--
ALTER TABLE `species`
 ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `authors`
--
ALTER TABLE `authors`
MODIFY `authorId` mediumint(9) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `images`
--
ALTER TABLE `images`
MODIFY `imageId` mediumint(9) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=46;
--
-- AUTO_INCREMENT for table `imageTagList`
--
ALTER TABLE `imageTagList`
MODIFY `tagId` mediumint(9) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `species`
--
ALTER TABLE `species`
MODIFY `id` mediumint(9) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=14441;
