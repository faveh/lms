-- phpMyAdmin SQL Dump
-- version 4.6.6deb4
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jul 19, 2017 at 12:27 AM
-- Server version: 5.7.18-0ubuntu0.17.04.1
-- PHP Version: 7.0.18-0ubuntu0.17.04.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `lms`
--

-- --------------------------------------------------------

--
-- Table structure for table `lms_admin`
--

CREATE TABLE `lms_admin` (
  `admin_id` int(4) UNSIGNED NOT NULL,
  `username` varchar(32) NOT NULL,
  `email` varchar(72) NOT NULL,
  `password` varchar(50) NOT NULL,
  `name` varchar(64) NOT NULL,
  `mob_no` varchar(32) NOT NULL DEFAULT 'NA',
  `gender` varchar(8) NOT NULL DEFAULT 'M',
  `address` varchar(256) NOT NULL DEFAULT 'NA',
  `admin_uid` varchar(20) NOT NULL DEFAULT 'NA',
  `status` tinyint(1) UNSIGNED NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `lms_admin`
--

INSERT INTO `lms_admin` (`admin_id`, `username`, `email`, `password`, `name`, `mob_no`, `gender`, `address`, `admin_uid`, `status`) VALUES
(1, 'tjay', 'oyenirantunji2339@gmail.com', 'utile', 'Tunji Oyeniran', 'NA', 'M', 'NA', 'NA', 1),
(2, 'adebimpe', 'splendorette05@gmail.com', 'adebimpe', 'adebimpe tolu', '08165779777', 'M', 'NA', '017a3a8ecf765bc74e53', 0);

-- --------------------------------------------------------

--
-- Table structure for table `lms_approval`
--

CREATE TABLE `lms_approval` (
  `approval_code` varchar(1) NOT NULL DEFAULT 'P',
  `approval_meaning` varchar(12) NOT NULL DEFAULT 'PENDING'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `lms_approval`
--

INSERT INTO `lms_approval` (`approval_code`, `approval_meaning`) VALUES
('A', 'APPROVED'),
('D', 'DISAPPROVED'),
('P', 'PENDING');

-- --------------------------------------------------------

--
-- Table structure for table `lms_books`
--

CREATE TABLE `lms_books` (
  `book_id` int(12) UNSIGNED NOT NULL,
  `admin_id` int(4) NOT NULL,
  `title` varchar(128) NOT NULL,
  `author` varchar(128) NOT NULL,
  `year` year(4) NOT NULL,
  `department_code` varchar(8) NOT NULL,
  `publisher` varchar(128) NOT NULL,
  `series_title` varchar(256) NOT NULL,
  `ISBN` varchar(20) NOT NULL,
  `volume` int(4) NOT NULL,
  `edition` int(4) NOT NULL,
  `format_code` varchar(5) NOT NULL,
  `type_code` varchar(10) NOT NULL DEFAULT 'non-fict',
  `date_added` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `copies` int(8) UNSIGNED NOT NULL DEFAULT '1',
  `available` int(8) UNSIGNED NOT NULL DEFAULT '1',
  `borrowed` int(8) UNSIGNED NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `lms_books`
--

INSERT INTO `lms_books` (`book_id`, `admin_id`, `title`, `author`, `year`, `department_code`, `publisher`, `series_title`, `ISBN`, `volume`, `edition`, `format_code`, `type_code`, `date_added`, `copies`, `available`, `borrowed`) VALUES
(1, 1, 'Title Example', 'Author Example', 2016, 'TECH', 'Tee Publishers', '', '987-929-928-9', 1, 13, '', '', '2016-07-07 01:38:12', 1, 1, 0),
(2, 1, '26th European Symposium on Computer Aided Process Engineering', 'Science Direct', 2016, 'SCI', 'Science Direct', 'Computer Aided Chemical Engineering', '978-0-444-63428-3', 38, 2, 'HARD', 'seri', '2016-07-07 15:24:31', 20, 20, 0),
(3, 1, 'Efficiency and Competition in Chinese Banking', 'Science Direct', 2016, 'SCI', 'Science Direct', 'Chandos Asian Studies Series', '978-0-08-100074-8', 0, 1, 'BOTH', 'nonf', '2016-07-07 15:24:31', 30, 30, 0),
(4, 1, 'Advances in Food Traceability Techniques and Technologies', 'Science Direct', 2016, 'SCI', 'Science Direct', 'Woodhead Publishing Series in Food Science, Technology and Nutrition', '978-0-08-100310-7', 0, 1, 'BOTH', 'nonf', '2016-07-07 15:24:31', 30, 30, 0),
(5, 1, 'Performance Testing of Textiles', 'Science Direct', 2016, 'SCI', 'Science Direct', 'Woodhead Publishing Series in Textiles', '978-0-08-100570-5', 0, 1, 'BOTH', 'nonf', '2016-07-07 15:24:31', 30, 30, 0),
(6, 1, 'Marine Concrete Structures', 'Science Direct', 2016, 'SCI', 'Science Direct', '', '978-0-08-100905-5', 0, 1, 'BOTH', 'nonf', '2016-07-07 15:24:31', 30, 30, 0),
(7, 1, 'Advances in Braiding Technology', 'Science Direct', 2016, 'SCI', 'Science Direct', 'Woodhead Publishing Series in Textiles', '978-0-08-100926-0', 0, 1, 'BOTH', 'nonf', '2016-07-07 15:24:31', 30, 30, 0),
(8, 1, 'Advanced Composite Materials for Aerospace Engineering', 'Science Direct', 2016, 'SCI', 'Science Direct', '', '978-0-08-100939-0', 0, 1, 'BOTH', 'nonf', '2016-07-07 15:24:31', 30, 30, 0),
(9, 1, 'Transboundary Water Resources in Afghanistan', 'Science Direct', 2016, 'SCI', 'Science Direct', '', '978-0-12-801886-6', 0, 1, 'BOTH', 'nonf', '2016-07-07 15:24:31', 30, 30, 0),
(10, 1, 'Translational Neuroimmunology in Multiple Sclerosis', 'Science Direct', 2016, 'SCI', 'Science Direct', '', '978-0-12-801914-6', 0, 1, 'BOTH', 'nonf', '2016-07-07 15:24:31', 30, 30, 0),
(11, 1, 'Calculations for Molecular Biology and Biotechnology (Third Edition)', 'Science Direct', 2016, 'SCI', 'Science Direct', '', '978-0-12-802211-5', 0, 1, 'BOTH', 'nonf', '2016-07-07 15:24:31', 30, 30, 0),
(12, 1, 'Solar Photovoltaic Technology Production', 'Science Direct', 2016, 'SCI', 'Science Direct', '', '978-0-12-802953-4', 0, 1, 'BOTH', 'nonf', '2016-07-07 15:24:31', 30, 30, 0),
(13, 1, 'Numerical Modelling of Wave Energy Converters', 'Science Direct', 2016, 'SCI', 'Science Direct', '', '978-0-12-803210-7', 0, 1, 'BOTH', 'nonf', '2016-07-07 15:24:31', 30, 30, 0),
(14, 1, 'Sport and Exercise Psychology Research', 'Science Direct', 2016, 'SCI', 'Science Direct', '', '978-0-12-803634-1', 0, 1, 'BOTH', 'nonf', '2016-07-07 15:24:31', 30, 30, 0),
(15, 1, 'Mustard Lung', 'Science Direct', 2016, 'SCI', 'Science Direct', '', '978-0-12-803952-6', 0, 1, 'BOTH', 'nonf', '2016-07-07 15:24:32', 30, 30, 0),
(16, 1, 'Statistical Aspects of the Microbiological Examination of Foods (Third Edition)', 'Science Direct', 2016, 'SCI', 'Science Direct', '', '978-0-12-803973-1', 0, 1, 'BOTH', 'nonf', '2016-07-07 15:24:32', 30, 30, 0),
(17, 1, 'Emulsions', 'Science Direct', 2016, 'SCI', 'Science Direct', 'Nanotechnology in the Agri-Food Industry', '978-0-12-804306-6', 0, 1, 'BOTH', 'nonf', '2016-07-07 15:24:32', 30, 30, 0),
(18, 1, 'Nanomaterials for Wastewater Remediation', 'Science Direct', 2016, 'SCI', 'Science Direct', '', '978-0-12-804609-8', 0, 1, 'BOTH', 'nonf', '2016-07-07 15:24:32', 30, 30, 0),
(19, 1, 'Nanomaterial and Polymer Membranes', 'Science Direct', 2016, 'SCI', 'Science Direct', '', '978-0-12-804703-3', 0, 1, 'BOTH', 'nonf', '2016-07-07 15:24:32', 30, 30, 0),
(20, 1, 'Additive Manufacturing of Titanium Alloys', 'Science Direct', 2016, 'SCI', 'Science Direct', '', '978-0-12-804782-8', 0, 1, 'BOTH', 'nonf', '2016-07-07 15:24:32', 30, 30, 0),
(21, 1, 'Successes and Failures of Knowledge Management', 'Science Direct', 2016, 'SCI', 'Science Direct', '', '978-0-12-805187-0', 0, 1, 'BOTH', 'nonf', '2016-07-07 15:24:32', 30, 30, 0),
(22, 1, 'Cyber Guerilla', 'Science Direct', 2016, 'SCI', 'Science Direct', '', '978-0-12-805197-9', 0, 1, 'BOTH', 'nonf', '2016-07-07 15:24:32', 30, 30, 0),
(23, 1, 'Materials Science and Engineering of Carbon', 'Science Direct', 2016, 'SCI', 'Science Direct', '', '978-0-12-805256-3', 0, 1, 'BOTH', 'nonf', '2016-07-07 15:24:32', 30, 30, 0),
(24, 1, 'Taking the LEAP', 'Science Direct', 2016, 'SCI', 'Science Direct', '', '978-0-12-805263-1', 0, 1, 'BOTH', 'nonf', '2016-07-07 15:24:32', 30, 30, 0),
(25, 1, 'Autophagy: Cancer, Other Pathologies, Inflammation, Immunity, Infection, and Aging', 'Science Direct', 2016, 'SCI', 'Science Direct', '', '978-0-12-805421-5', 0, 1, 'BOTH', 'nonf', '2016-07-07 15:24:32', 30, 30, 0),
(26, 1, 'Application, Purification, and Recovery of Ionic Liquids', 'Science Direct', 2016, 'SCI', 'Science Direct', '', '978-0-444-63713-0', 0, 1, 'BOTH', 'nonf', '2016-07-07 15:24:32', 30, 30, 0),
(27, 1, 'Modeling in Food Microbiology', 'Science Direct', 2016, 'SCI', 'Science Direct', '', '978-1-78548-155-0', 0, 1, 'BOTH', 'nonf', '2016-07-07 15:24:32', 30, 30, 0),
(28, 1, 'Medizinisches Aufbautraining', 'Science Direct', 2015, 'SCI', 'Science Direct', '', '978-3-437-45052-5', 0, 1, 'BOTH', 'nonf', '2016-07-07 15:24:32', 30, 30, 0),
(29, 1, '{Studies in Natural Products Chemistry, Volume 48}', 'Science Direct', 2016, 'SCI', 'Science Direct', 'Studies in Natural Products Chemistry', '978-0-444-63602-7', 48, 2, 'HARD', 'seri', '2016-07-07 15:24:32', 20, 20, 0),
(30, 1, 'High-Resolution NMR Techniques in Organic Chemistry (Third Edition)', 'Science Direct', 2016, 'SCI', 'Science Direct', '', '978-0-08-099986-9', 0, 1, 'BOTH', 'nonf', '2016-07-07 15:24:32', 30, 30, 0),
(31, 1, 'Computational Systems Biology', 'Science Direct', 2016, 'SCI', 'Science Direct', '', '978-0-08-100095-3', 0, 1, 'BOTH', 'nonf', '2016-07-07 15:24:32', 30, 30, 0),
(32, 1, 'Handbook of Generation IV Nuclear Reactors', 'Science Direct', 2016, 'SCI', 'Science Direct', 'Woodhead Publishing Series in Energy', '978-0-08-100149-3', 0, 1, 'BOTH', 'nonf', '2016-07-07 15:24:32', 30, 30, 0),
(33, 1, 'Materials for the Direct Restoration of Teeth', 'Science Direct', 2016, 'SCI', 'Science Direct', '', '978-0-08-100491-3', 0, 1, 'BOTH', 'nonf', '2016-07-07 15:24:32', 30, 30, 0),
(34, 1, 'Online Learning and its Users', 'Science Direct', 2016, 'SCI', 'Science Direct', '', '978-0-08-100626-9', 0, 1, 'BOTH', 'nonf', '2016-07-07 15:24:32', 30, 30, 0),
(35, 1, 'Fundamentals of Applied Reservoir Engineering', 'Science Direct', 2016, 'SCI', 'Science Direct', '', '978-0-08-101019-8', 0, 1, 'BOTH', 'nonf', '2016-07-07 15:24:33', 30, 30, 0),
(36, 1, 'Biflavanoids', 'Science Direct', 2016, 'SCI', 'Science Direct', '', '978-0-08-101030-3', 0, 1, 'BOTH', 'nonf', '2016-07-07 15:24:33', 30, 30, 0),
(37, 1, 'Forensic Polymer Engineering (Second Edition)', 'Science Direct', 2016, 'SCI', 'Science Direct', 'Woodhead Publishing in Materials', '978-0-08-101055-6', 0, 1, 'BOTH', 'nonf', '2016-07-07 15:24:33', 30, 30, 0),
(38, 1, 'Citation Tracking in Academic Libraries', 'Science Direct', 2016, 'SCI', 'Science Direct', '', '978-0-08-101759-3', 0, 1, 'BOTH', 'nonf', '2016-07-07 15:24:33', 30, 30, 0),
(39, 1, 'Forensic Epidemiology', 'Science Direct', 2016, 'SCI', 'Science Direct', '', '978-0-12-404584-2', 0, 1, 'BOTH', 'nonf', '2016-07-07 15:24:33', 30, 30, 0),
(40, 1, 'Functional Neuromarkers for Psychiatry', 'Science Direct', 2016, 'SCI', 'Science Direct', '', '978-0-12-410513-3', 0, 1, 'BOTH', 'nonf', '2016-07-07 15:24:33', 30, 30, 0),
(41, 1, 'Brewing Materials and Processes', 'Science Direct', 2016, 'SCI', 'Science Direct', '', '978-0-12-799954-8', 0, 1, 'BOTH', 'nonf', '2016-07-07 15:24:33', 30, 30, 0),
(42, 1, 'Weather Analysis and Forecasting (Second Edition)', 'Science Direct', 2016, 'SCI', 'Science Direct', '', '978-0-12-800194-3', 0, 1, 'BOTH', 'nonf', '2016-07-07 15:24:33', 30, 30, 0),
(43, 1, 'Theory and Calculation of Heat Transfer in Furnaces', 'Science Direct', 2016, 'SCI', 'Science Direct', '', '978-0-12-800966-6', 0, 1, 'BOTH', 'nonf', '2016-07-07 15:24:33', 30, 30, 0),
(44, 1, 'Regenerative Medicine for Peripheral Artery Disease', 'Science Direct', 2016, 'SCI', 'Science Direct', '', '978-0-12-801344-1', 0, 1, 'BOTH', 'nonf', '2016-07-07 15:24:33', 30, 30, 0),
(45, 1, 'Sustainability in the Design, Synthesis and Analysis of Chemical Engineering Processes', 'Science Direct', 2016, 'SCI', 'Science Direct', '', '978-0-12-802032-6', 0, 1, 'BOTH', 'nonf', '2016-07-07 15:24:33', 30, 30, 0),
(46, 1, 'Computer Vision Technology for Food Quality Evaluation (Second Edition)', 'Science Direct', 2016, 'SCI', 'Science Direct', '', '978-0-12-802232-0', 0, 1, 'BOTH', 'nonf', '2016-07-07 15:24:33', 30, 30, 0),
(47, 1, 'Retrograde Ureteroscopy', 'Science Direct', 2016, 'SCI', 'Science Direct', '', '978-0-12-802403-4', 0, 1, 'BOTH', 'nonf', '2016-07-07 15:24:33', 30, 30, 0),
(48, 1, 'Autophagy: Cancer, Other Pathologies, Inflammation, Immunity, Infection, and Aging', 'Science Direct', 2016, 'SCI', 'Science Direct', '', '978-0-12-802936-7', 0, 1, 'BOTH', 'nonf', '2016-07-07 15:24:33', 30, 30, 0),
(49, 1, 'Explosion Hazards in the Process Industries (Second Edition)', 'Science Direct', 2016, 'SCI', 'Science Direct', '', '978-0-12-803273-2', 0, 1, 'BOTH', 'nonf', '2016-07-07 15:24:33', 30, 30, 0),
(50, 1, 'DNS Security', 'Science Direct', 2016, 'SCI', 'Science Direct', '', '978-0-12-803306-7', 0, 1, 'BOTH', 'nonf', '2016-07-07 15:24:33', 30, 30, 0),
(51, 1, 'Smart Cities and Homes', 'Science Direct', 2016, 'SCI', 'Science Direct', '', '978-0-12-803454-5', 0, 1, 'BOTH', 'nonf', '2016-07-07 15:24:33', 30, 30, 0),
(52, 1, 'Efficient Methods for Preparing Silicon Compounds', 'Science Direct', 2016, 'SCI', 'Science Direct', '', '978-0-12-803530-6', 0, 1, 'BOTH', 'nonf', '2016-07-07 15:24:33', 30, 30, 0),
(53, 1, 'Management of Hemostasis and Coagulopathies for Surgical and Critically Ill Patients', 'Science Direct', 2016, 'SCI', 'Science Direct', '', '978-0-12-803531-3', 0, 1, 'BOTH', 'nonf', '2016-07-07 15:24:33', 30, 30, 0),
(54, 1, 'Socializing Children Through Language', 'Science Direct', 2016, 'SCI', 'Science Direct', '', '978-0-12-803624-2', 0, 1, 'BOTH', 'nonf', '2016-07-07 15:24:34', 30, 30, 0),
(55, 1, 'Formative Assessment, Learning Data Analytics and Gamification', 'Science Direct', 2016, 'SCI', 'Science Direct', 'Intelligent Data-Centric Systems', '978-0-12-803637-2', 0, 1, 'BOTH', 'nonf', '2016-07-07 15:24:34', 30, 30, 0),
(56, 1, 'Solar Power Generation', 'Science Direct', 2016, 'SCI', 'Science Direct', '', '978-0-12-804004-1', 0, 1, 'BOTH', 'nonf', '2016-07-07 15:24:34', 30, 30, 0),
(57, 1, 'Informed and Healthy', 'Science Direct', 2016, 'SCI', 'Science Direct', '', '978-0-12-804290-8', 0, 1, 'BOTH', 'nonf', '2016-07-07 15:24:34', 30, 30, 0),
(58, 1, 'Protecting Patient Information', 'Science Direct', 2016, 'SCI', 'Science Direct', '', '978-0-12-804392-9', 0, 1, 'BOTH', 'nonf', '2016-07-07 15:24:34', 30, 30, 0),
(59, 1, 'Environmental Data Analysis with Matlab (Second Edition)', 'Science Direct', 2016, 'SCI', 'Science Direct', '', '978-0-12-804488-9', 0, 1, 'BOTH', 'nonf', '2016-07-07 15:24:34', 30, 30, 0),
(60, 1, 'Geometric Measure Theory (Fifth Edition)', 'Science Direct', 2016, 'SCI', 'Science Direct', '', '978-0-12-804489-6', 0, 1, 'BOTH', 'nonf', '2016-07-07 15:24:34', 30, 30, 0),
(61, 1, 'Phasor Measurement Units and Wide Area Monitoring Systems', 'Science Direct', 2016, 'SCI', 'Science Direct', '', '978-0-12-804569-5', 0, 1, 'BOTH', 'nonf', '2016-07-07 15:24:34', 30, 30, 0),
(62, 1, 'Beyond the Bones', 'Science Direct', 2016, 'SCI', 'Science Direct', '', '978-0-12-804601-2', 0, 1, 'BOTH', 'nonf', '2016-07-07 15:24:34', 30, 30, 0),
(63, 1, 'Scaling Chemical Processes', 'Science Direct', 2016, 'SCI', 'Science Direct', '', '978-0-12-804635-7', 0, 1, 'BOTH', 'nonf', '2016-07-07 15:24:34', 30, 30, 0),
(64, 1, 'Developing the Global Bioeconomy', 'Science Direct', 2016, 'SCI', 'Science Direct', '', '978-0-12-805165-8', 0, 1, 'BOTH', 'nonf', '2016-07-07 15:24:34', 30, 30, 0),
(65, 1, 'Linked by Blood: Hemophilia and AIDS', 'Science Direct', 2016, 'SCI', 'Science Direct', '', '978-0-12-805302-7', 0, 1, 'BOTH', 'nonf', '2016-07-07 15:24:34', 30, 30, 0),
(66, 1, 'Joint RES and Distribution Network Expansion Planning Under a Demand Response Framework', 'Science Direct', 2016, 'SCI', 'Science Direct', '', '978-0-12-805322-5', 0, 1, 'BOTH', 'nonf', '2016-07-07 15:24:34', 30, 30, 0),
(67, 1, 'Internet of Things', 'Science Direct', 2016, 'SCI', 'Science Direct', '', '978-0-12-805395-9', 0, 1, 'BOTH', 'nonf', '2016-07-07 15:24:34', 30, 30, 0),
(68, 1, 'Participatory Health Through Social Media', 'Science Direct', 2016, 'SCI', 'Science Direct', '', '978-0-12-809269-9', 0, 1, 'BOTH', 'nonf', '2016-07-07 15:24:34', 30, 30, 0),
(69, 1, 'Colloid and Interface Chemistry for Water Quality Control', 'Science Direct', 2016, 'SCI', 'Science Direct', '', '978-0-12-809315-3', 0, 1, 'BOTH', 'nonf', '2016-07-07 15:24:34', 30, 30, 0),
(70, 1, 'Friction Stir Welding of High Strength 7XXX Aluminum Alloys', 'Science Direct', 2016, 'SCI', 'Science Direct', '', '978-0-12-809465-5', 0, 1, 'BOTH', 'nonf', '2016-07-07 15:24:34', 30, 30, 0),
(71, 1, 'Theory and Methods of Metallurgical Process Integration', 'Science Direct', 2016, 'SCI', 'Science Direct', '', '978-0-12-809568-3', 0, 1, 'BOTH', 'nonf', '2016-07-07 15:24:34', 30, 30, 0),
(72, 1, 'Peanuts: Processing Technology and Product Development', 'Science Direct', 2016, 'SCI', 'Science Direct', '', '978-0-12-809595-9', 0, 1, 'BOTH', 'nonf', '2016-07-07 15:24:35', 30, 30, 0),
(73, 1, 'Disaster Resilient Cities', 'Science Direct', 2016, 'SCI', 'Science Direct', '', '978-0-12-809862-2', 0, 1, 'BOTH', 'nonf', '2016-07-07 15:24:35', 30, 30, 0),
(74, 1, 'Deuterium', 'Science Direct', 2016, 'SCI', 'Science Direct', '', '978-0-12-811040-9', 0, 1, 'BOTH', 'nonf', '2016-07-07 15:24:35', 30, 30, 0),
(75, 1, 'Nano- and Microfabrication for Industrial and Biomedical Applications (Second Edition)', 'Science Direct', 2016, 'SCI', 'Science Direct', 'Micro and Nano Technologies', '978-0-323-37828-4', 0, 1, 'BOTH', 'nonf', '2016-07-07 15:24:35', 30, 30, 0),
(76, 1, 'Color Trends and Selection for Product Design', 'Science Direct', 2016, 'SCI', 'Science Direct', 'Plastics Design Library', '978-0-323-39395-9', 0, 1, 'BOTH', 'nonf', '2016-07-07 15:24:35', 30, 30, 0),
(77, 1, 'Near-Field Radiative Heat Transfer Across Nanometer Vacuum Gaps', 'Science Direct', 2016, 'SCI', 'Science Direct', 'Micro and Nano Technologies', '978-0-323-42994-8', 0, 1, 'BOTH', 'nonf', '2016-07-07 15:24:35', 30, 30, 0),
(78, 1, 'Radioactivity (Second Edition)', 'Science Direct', 2016, 'SCI', 'Science Direct', '', '978-0-444-63489-4', 0, 1, 'BOTH', 'nonf', '2016-07-07 15:24:35', 30, 30, 0),
(79, 1, 'Catalytic Kinetics (Second Edition)', 'Science Direct', 2016, 'SCI', 'Science Direct', '', '978-0-444-63753-6', 0, 1, 'BOTH', 'nonf', '2016-07-07 15:24:35', 30, 30, 0),
(80, 1, 'Accidental Information Discovery', 'Science Direct', 2015, 'SCI', 'Science Direct', 'Chandos Information Professional Series', '978-1-84334-750-7', 0, 1, 'BOTH', 'nonf', '2016-07-07 15:24:35', 30, 30, 0),
(81, 1, 'Gynäkologische Tumoren', 'Science Direct', 2016, 'SCI', 'Science Direct', '', '978-3-437-21131-7', 0, 1, 'BOTH', 'nonf', '2016-07-07 15:24:35', 30, 30, 0),
(82, 1, 'Clothing for Children and Teenagers', 'Science Direct', 2016, 'SCI', 'Science Direct', 'Woodhead Publishing Series in Textiles', '978-0-08-100226-1', 0, 1, 'BOTH', 'nonf', '2016-07-07 15:24:35', 30, 30, 0),
(83, 1, 'Magnetic Fusion Energy', 'Science Direct', 2016, 'SCI', 'Science Direct', '', '978-0-08-100315-2', 0, 1, 'BOTH', 'nonf', '2016-07-07 15:24:35', 30, 30, 0),
(84, 1, 'Medical and Health Genomics', 'Science Direct', 2015, 'SCI', 'Science Direct', '', '978-0-12-420196-5', 0, 1, 'BOTH', 'nonf', '2016-07-07 15:24:35', 30, 30, 0),
(85, 1, 'The Molecular Nutrition of Amino Acids and Proteins', 'Science Direct', 2016, 'SCI', 'Science Direct', '', '978-0-12-802167-5', 0, 1, 'BOTH', 'nonf', '2016-07-07 15:24:35', 30, 30, 0),
(86, 1, 'Biofluid Mechanics', 'Science Direct', 2016, 'SCI', 'Science Direct', '', '978-0-12-802408-9', 0, 1, 'BOTH', 'nonf', '2016-07-07 15:24:35', 30, 30, 0),
(87, 1, 'Insider Threat', 'Science Direct', 2015, 'SCI', 'Science Direct', '', '978-0-12-802410-2', 0, 1, 'BOTH', 'nonf', '2016-07-07 15:24:35', 30, 30, 0),
(88, 1, 'Blinding as a Solution to Bias', 'Science Direct', 2016, 'SCI', 'Science Direct', '', '978-0-12-802460-7', 0, 1, 'BOTH', 'nonf', '2016-07-07 15:24:36', 30, 30, 0),
(89, 1, 'Data Breach Preparation and Response', 'Science Direct', 2016, 'SCI', 'Science Direct', '', '978-0-12-803451-4', 0, 1, 'BOTH', 'nonf', '2016-07-07 15:24:36', 30, 30, 0),
(90, 1, 'How to Validate a Pharmaceutical Process', 'Science Direct', 2016, 'SCI', 'Science Direct', '', '978-0-12-804148-2', 0, 1, 'BOTH', 'nonf', '2016-07-07 15:24:36', 30, 30, 0),
(91, 1, 'Community-Based Psychological First Aid', 'Science Direct', 2016, 'SCI', 'Science Direct', '', '978-0-12-804292-2', 0, 1, 'BOTH', 'nonf', '2016-07-07 15:24:36', 30, 30, 0),
(92, 1, 'Handbook for Transversely Finned Tubes Heat Exchanger Design', 'Science Direct', 2016, 'SCI', 'Science Direct', '', '978-0-12-804397-4', 0, 1, 'BOTH', 'nonf', '2016-07-07 15:24:36', 30, 30, 0),
(93, 1, 'Tissue Engineering Made Easy', 'Science Direct', 2016, 'SCI', 'Science Direct', '', '978-0-12-805361-4', 0, 1, 'BOTH', 'nonf', '2016-07-07 15:24:36', 30, 30, 0),
(94, 1, 'Wound Healing Biomaterials', 'Science Direct', 2016, 'SCI', 'Science Direct', '', '978-1-78242-455-0', 0, 1, 'BOTH', 'nonf', '2016-07-07 15:24:36', 30, 30, 0),
(95, 1, 'Meteorologia e Oceanografia', 'Science Direct', 2016, 'SCI', 'Science Direct', '', '978-85-352-6208-7', 0, 1, 'BOTH', 'nonf', '2016-07-07 15:24:36', 30, 30, 0),
(96, 1, 'Nanosized Tubular Clay Minerals', 'Science Direct', 2016, 'SCI', 'Science Direct', 'Developments in Clay Science', '978-0-08-100293-3', 7, 2, 'HARD', 'seri', '2016-07-07 15:24:36', 20, 20, 0),
(97, 1, 'Scallops', 'Science Direct', 2016, 'SCI', 'Science Direct', 'Developments in Aquaculture and Fisheries Science', '978-0-444-62710-0', 40, 2, 'HARD', 'seri', '2016-07-07 15:24:36', 20, 20, 0),
(98, 1, 'Particle Technology and Engineering', 'Science Direct', 2015, 'SCI', 'Science Direct', '', '978-0-08-098337-0', 0, 1, 'BOTH', 'nonf', '2016-07-07 15:24:36', 30, 30, 0),
(99, 1, 'Flavor', 'Science Direct', 2016, 'SCI', 'Science Direct', 'Woodhead Publishing Series in Food Science, Technology and Nutrition', '978-0-08-100295-7', 0, 1, 'BOTH', 'nonf', '2016-07-07 15:24:36', 30, 30, 0),
(100, 1, 'Advances in Solar Heating and Cooling', 'Science Direct', 2016, 'SCI', 'Science Direct', '', '978-0-08-100301-5', 0, 1, 'BOTH', 'nonf', '2016-07-07 15:24:36', 30, 30, 0),
(101, 1, 'Geothermal Power Generation', 'Science Direct', 2016, 'SCI', 'Science Direct', '', '978-0-08-100337-4', 0, 1, 'BOTH', 'nonf', '2016-07-07 15:24:36', 30, 30, 0),
(102, 1, 'High Dynamic Range Video', 'Science Direct', 2016, 'SCI', 'Science Direct', '', '978-0-08-100412-8', 0, 1, 'BOTH', 'nonf', '2016-07-07 15:24:36', 30, 30, 0),
(103, 1, 'Handbook of Biofuels Production (Second Edition)', 'Science Direct', 2016, 'SCI', 'Science Direct', '', '978-0-08-100455-5', 0, 1, 'BOTH', 'nonf', '2016-07-07 15:24:36', 30, 30, 0),
(104, 1, 'Absorption-Based Post-combustion Capture of Carbon Dioxide', 'Science Direct', 2016, 'SCI', 'Science Direct', '', '978-0-08-100514-9', 0, 1, 'BOTH', 'nonf', '2016-07-07 15:24:36', 30, 30, 0),
(105, 1, 'Stress: Concepts, Cognition, Emotion, and Behavior', 'Science Direct', 2016, 'SCI', 'Science Direct', '', '978-0-12-800951-2', 0, 1, 'BOTH', 'nonf', '2016-07-07 15:24:36', 30, 30, 0),
(106, 1, 'Industrial Catalytic Processes for Fine and Specialty Chemicals', 'Science Direct', 2016, 'SCI', 'Science Direct', '', '978-0-12-801457-8', 0, 1, 'BOTH', 'nonf', '2016-07-07 15:24:36', 30, 30, 0),
(107, 1, 'Emotions, Technology, and Social Media', 'Science Direct', 2016, 'SCI', 'Science Direct', 'Emotions and Technology', '978-0-12-801857-6', 0, 1, 'BOTH', 'nonf', '2016-07-07 15:24:37', 30, 30, 0),
(108, 1, 'Clinical Research Computing', 'Science Direct', 2016, 'SCI', 'Science Direct', '', '978-0-12-803130-8', 0, 1, 'BOTH', 'nonf', '2016-07-07 15:24:37', 30, 30, 0),
(109, 1, 'Oxidative Stress and Biomaterials', 'Science Direct', 2016, 'SCI', 'Science Direct', '', '978-0-12-803269-5', 0, 1, 'BOTH', 'nonf', '2016-07-07 15:24:37', 30, 30, 0),
(110, 1, 'Non-Bovine Milk and Milk Products', 'Science Direct', 2016, 'SCI', 'Science Direct', '', '978-0-12-803361-6', 0, 1, 'BOTH', 'nonf', '2016-07-07 15:24:37', 30, 30, 0),
(111, 1, 'The Gradient Test', 'Science Direct', 2016, 'SCI', 'Science Direct', '', '978-0-12-803596-2', 0, 1, 'BOTH', 'nonf', '2016-07-07 15:24:37', 30, 30, 0),
(112, 1, 'Rethinking Bhopal', 'Science Direct', 2016, 'SCI', 'Science Direct', '', '978-0-12-803778-2', 0, 1, 'BOTH', 'nonf', '2016-07-07 15:24:37', 30, 30, 0),
(113, 1, 'Atom Probe Tomography', 'Science Direct', 2016, 'SCI', 'Science Direct', '', '978-0-12-804647-0', 0, 1, 'BOTH', 'nonf', '2016-07-07 15:24:37', 30, 30, 0),
(114, 1, 'Thermodynamic Approaches in Engineering Systems', 'Science Direct', 2016, 'SCI', 'Science Direct', '', '978-0-12-805462-8', 0, 1, 'BOTH', 'nonf', '2016-07-07 15:24:37', 30, 30, 0),
(115, 1, 'Perception of Pixelated Images', 'Science Direct', 2016, 'SCI', 'Science Direct', '', '978-0-12-809311-5', 0, 1, 'BOTH', 'nonf', '2016-07-07 15:24:37', 30, 30, 0),
(116, 1, 'Spectral Methods in Transition Metal Complexes', 'Science Direct', 2016, 'SCI', 'Science Direct', '', '978-0-12-809591-1', 0, 1, 'BOTH', 'nonf', '2016-07-07 15:24:37', 30, 30, 0),
(117, 1, 'Fluoroelastomers Handbook (Second Edition)', 'Science Direct', 2016, 'SCI', 'Science Direct', 'Plastics Design Library', '978-0-323-39480-2', 0, 1, 'BOTH', 'nonf', '2016-07-07 15:24:37', 30, 30, 0),
(118, 1, 'Petroleum Geology of Libya (Second Edition)', 'Science Direct', 2016, 'SCI', 'Science Direct', '', '978-0-444-63517-4', 0, 1, 'BOTH', 'nonf', '2016-07-07 15:24:37', 30, 30, 0),
(119, 1, 'Wound Healing Biomaterials', 'Science Direct', 2016, 'SCI', 'Science Direct', '', '978-1-78242-456-7', 0, 1, 'BOTH', 'nonf', '2016-07-07 15:24:37', 30, 30, 0),
(120, 1, 'High Temperature Oxidation and Corrosion of Metals (Second Edition)', 'Science Direct', 2016, 'SCI', 'Science Direct', '', '978-0-08-100101-1', 0, 1, 'BOTH', 'nonf', '2016-07-07 15:24:37', 30, 30, 0),
(121, 1, 'Extracellular Matrix-Derived Implants in Clinical Medicine', 'Science Direct', 2016, 'SCI', 'Science Direct', 'Woodhead Publishing Series in Biomaterials', '978-0-08-100166-0', 0, 1, 'BOTH', 'nonf', '2016-07-07 15:24:37', 30, 30, 0),
(122, 1, 'Volcanic Ash', 'Science Direct', 2016, 'SCI', 'Science Direct', '', '978-0-08-100405-0', 0, 1, 'BOTH', 'nonf', '2016-07-07 15:24:37', 30, 30, 0),
(123, 1, 'The Stability and Shelf Life of Food (Second Edition)', 'Science Direct', 2016, 'SCI', 'Science Direct', 'Woodhead Publishing Series in Food Science, Technology and Nutrition', '978-0-08-100435-7', 0, 1, 'BOTH', 'nonf', '2016-07-07 15:24:37', 30, 30, 0),
(124, 1, 'New Roles for Research Librarians', 'Science Direct', 2016, 'SCI', 'Science Direct', '', '978-0-08-100566-8', 0, 1, 'BOTH', 'nonf', '2016-07-07 15:24:37', 30, 30, 0),
(125, 1, 'Thresholds of Genotoxic Carcinogens', 'Science Direct', 2016, 'SCI', 'Science Direct', '', '978-0-12-801663-3', 0, 1, 'BOTH', 'nonf', '2016-07-07 15:24:37', 30, 30, 0),
(126, 1, 'Sensing and Monitoring Technologies for Mines and Hazardous Areas', 'Science Direct', 2016, 'SCI', 'Science Direct', '', '978-0-12-803194-0', 0, 1, 'BOTH', 'nonf', '2016-07-07 15:24:38', 30, 30, 0),
(127, 1, 'Urban DC Microgrid', 'Science Direct', 2016, 'SCI', 'Science Direct', '', '978-0-12-803736-2', 0, 1, 'BOTH', 'nonf', '2016-07-07 15:24:38', 30, 30, 0),
(128, 1, 'Mobilisation of Forest Bioenergy in the Boreal and Temperate Biomes', 'Science Direct', 2016, 'SCI', 'Science Direct', '', '978-0-12-804514-5', 0, 1, 'BOTH', 'nonf', '2016-07-07 15:24:38', 30, 30, 0),
(129, 1, 'GPU-Based Parallel Implementation of Swarm Intelligence Algorithms', 'Science Direct', 2016, 'SCI', 'Science Direct', '', '978-0-12-809362-7', 0, 1, 'BOTH', 'nonf', '2016-07-07 15:24:38', 30, 30, 0),
(130, 1, 'The Geology of the Canary Islands', 'Science Direct', 2016, 'SCI', 'Science Direct', '', '978-0-12-809663-5', 0, 1, 'BOTH', 'nonf', '2016-07-07 15:24:38', 30, 30, 0),
(131, 1, 'Clinical Cardiac Pacing, Defibrillation and Resynchronization Therapy (Fifth Edition)', 'Science Direct', 2017, 'SCI', 'Science Direct', '', '978-0-323-37804-8', 0, 1, 'BOTH', 'nonf', '2016-07-07 15:24:38', 30, 30, 0),
(132, 1, 'Environment and Development', 'Science Direct', 2016, 'SCI', 'Science Direct', '', '978-0-444-62733-9', 0, 1, 'BOTH', 'nonf', '2016-07-07 15:24:38', 30, 30, 0),
(133, 1, 'Big Data and Ethics', 'Science Direct', 2016, 'SCI', 'Science Direct', '', '978-1-78548-025-6', 0, 1, 'BOTH', 'nonf', '2016-07-07 15:24:38', 30, 30, 0),
(134, 1, 'A Concise Geologic Time Scale', 'Science Direct', 2016, 'SCI', 'Science Direct', '', '978-0-444-63771-0', 0, 1, 'BOTH', 'nonf', '2016-07-07 15:24:38', 30, 30, 0),
(135, 1, 'Advances in Ground-Source Heat Pump Systems', 'Science Direct', 2016, 'SCI', 'Science Direct', '', '978-0-08-100311-4', 0, 1, 'BOTH', 'nonf', '2016-07-07 15:24:38', 30, 30, 0),
(136, 1, 'Developing Food Products for Consumers with Specific Dietary Needs', 'Science Direct', 2016, 'SCI', 'Science Direct', 'Woodhead Publishing Series in Food Science, Technology and Nutrition', '978-0-08-100329-9', 0, 1, 'BOTH', 'nonf', '2016-07-07 15:24:38', 30, 30, 0),
(137, 1, 'Chemically Bonded Phosphate Ceramics (Second Edition)', 'Science Direct', 2016, 'SCI', 'Science Direct', '', '978-0-08-100380-0', 0, 1, 'BOTH', 'nonf', '2016-07-07 15:24:38', 30, 30, 0),
(138, 1, 'Start-Up Creation', 'Science Direct', 2016, 'SCI', 'Science Direct', '', '978-0-08-100546-0', 0, 1, 'BOTH', 'nonf', '2016-07-07 15:24:38', 30, 30, 0),
(139, 1, 'Advances in Technical Nonwovens', 'Science Direct', 2016, 'SCI', 'Science Direct', 'Woodhead Publishing Series in Textiles', '978-0-08-100575-0', 0, 1, 'BOTH', 'nonf', '2016-07-07 15:24:38', 30, 30, 0),
(140, 1, 'Threat Forecasting', 'Science Direct', 2015, 'SCI', 'Science Direct', '', '978-0-12-800006-9', 0, 1, 'BOTH', 'nonf', '2016-07-07 15:24:38', 30, 30, 0),
(141, 1, 'Continuous Issues in Numerical Cognition', 'Science Direct', 2016, 'SCI', 'Science Direct', '', '978-0-12-801637-4', 0, 1, 'BOTH', 'nonf', '2016-07-07 15:24:38', 30, 30, 0),
(142, 1, 'Clinical Challenges in Therapeutic Drug Monitoring', 'Science Direct', 2016, 'SCI', 'Science Direct', '', '978-0-12-802025-8', 0, 1, 'BOTH', 'nonf', '2016-07-07 15:24:38', 30, 30, 0),
(143, 1, 'The Gut-Brain Axis', 'Science Direct', 2016, 'SCI', 'Science Direct', '', '978-0-12-802304-4', 0, 1, 'BOTH', 'nonf', '2016-07-07 15:24:38', 30, 30, 0),
(144, 1, 'Sex Differences in Physiology', 'Science Direct', 2016, 'SCI', 'Science Direct', '', '978-0-12-802388-4', 0, 1, 'BOTH', 'nonf', '2016-07-07 15:24:38', 30, 30, 0),
(145, 1, 'Forensic Psychology of Spousal Violence', 'Science Direct', 2016, 'SCI', 'Science Direct', '', '978-0-12-803533-7', 0, 1, 'BOTH', 'nonf', '2016-07-07 15:24:38', 30, 30, 0),
(146, 1, 'Novel Approaches of Nanotechnology in Food', 'Science Direct', 2016, 'SCI', 'Science Direct', 'Nanotechnology in the Agri-Food Industry', '978-0-12-804308-0', 0, 1, 'BOTH', 'nonf', '2016-07-07 15:24:38', 30, 30, 0),
(147, 1, 'Giant Coal-Derived Gas Fields and their Gas Sources in China', 'Science Direct', 2016, 'SCI', 'Science Direct', '', '978-0-12-805093-4', 0, 1, 'BOTH', 'nonf', '2016-07-07 15:24:38', 30, 30, 0),
(148, 1, 'Nanotechnology (Second Edition)', 'Science Direct', 2016, 'SCI', 'Science Direct', 'Micro and Nano Technologies', '978-0-323-39311-9', 0, 1, 'BOTH', 'nonf', '2016-07-07 15:24:39', 30, 30, 0),
(149, 1, 'Nanobiomaterials in Galenic Formulations and Cosmetics', 'Science Direct', 2016, 'SCI', 'Science Direct', '', '978-0-323-42868-2', 0, 1, 'BOTH', 'nonf', '2016-07-07 15:24:39', 30, 30, 0),
(150, 1, 'RFID and Wireless Sensors Using Ultra-Wideband Technology', 'Science Direct', 2016, 'SCI', 'Science Direct', '', '978-1-78548-098-0', 0, 1, 'BOTH', 'nonf', '2016-07-07 15:24:39', 30, 30, 0),
(151, 1, 'Neuronal and Synaptic Dysfunction in Autism Spectrum Disorder and Intellectual Disability', 'Science Direct', 2016, 'SCI', 'Science Direct', '', '978-0-12-800109-7', 0, 1, 'BOTH', 'nonf', '2016-07-07 15:24:39', 30, 30, 0),
(152, 1, 'Food Hygiene and Toxicology in Ready-to-Eat Foods', 'Science Direct', 2016, 'SCI', 'Science Direct', '', '978-0-12-801916-0', 0, 1, 'BOTH', 'nonf', '2016-07-07 15:24:39', 30, 30, 0),
(153, 1, 'Pediatric Brain Stimulation', 'Science Direct', 2016, 'SCI', 'Science Direct', '', '978-0-12-802001-2', 0, 1, 'BOTH', 'nonf', '2016-07-07 15:24:39', 30, 30, 0),
(154, 1, 'Geological Controls for Gas Hydrates and Unconventionals', 'Science Direct', 2016, 'SCI', 'Science Direct', '', '978-0-12-802020-3', 0, 1, 'BOTH', 'nonf', '2016-07-07 15:24:39', 30, 30, 0),
(155, 1, 'Satellite Soil Moisture Retrieval', 'Science Direct', 2016, 'SCI', 'Science Direct', '', '978-0-12-803388-3', 0, 1, 'BOTH', 'nonf', '2016-07-07 15:24:39', 30, 30, 0),
(156, 1, 'Biochar Application', 'Science Direct', 2016, 'SCI', 'Science Direct', '', '978-0-12-803433-0', 0, 1, 'BOTH', 'nonf', '2016-07-07 15:24:39', 30, 30, 0),
(157, 1, 'Pervasive Computing', 'Science Direct', 2016, 'SCI', 'Science Direct', 'Intelligent Data-Centric Systems', '978-0-12-803663-1', 0, 1, 'BOTH', 'nonf', '2016-07-07 15:24:39', 30, 30, 0),
(158, 1, 'Mass Spectrometry', 'Science Direct', 2016, 'SCI', 'Science Direct', '', '978-0-12-804129-1', 0, 1, 'BOTH', 'nonf', '2016-07-07 15:24:39', 30, 30, 0),
(159, 1, 'System Verification (Second Edition)', 'Science Direct', 2016, 'SCI', 'Science Direct', '', '978-0-12-804221-2', 0, 1, 'BOTH', 'nonf', '2016-07-07 15:24:39', 30, 30, 0),
(160, 1, 'Visibility', 'Science Direct', 2016, 'SCI', 'Science Direct', '', '978-0-12-804450-6', 0, 1, 'BOTH', 'nonf', '2016-07-07 15:24:39', 30, 30, 0),
(161, 1, 'Os X Incident Response', 'Science Direct', 2016, 'SCI', 'Science Direct', '', '978-0-12-804456-8', 0, 1, 'BOTH', 'nonf', '2016-07-07 15:24:39', 30, 30, 0),
(162, 1, 'Essentials of Mineral Exploration and Evaluation', 'Science Direct', 2016, 'SCI', 'Science Direct', '', '978-0-12-805329-4', 0, 1, 'BOTH', 'nonf', '2016-07-07 15:24:39', 30, 30, 0),
(163, 1, 'Guide to the Practical Use of Chemicals in Refineries and Pipelines', 'Science Direct', 2016, 'SCI', 'Science Direct', '', '978-0-12-805412-3', 0, 1, 'BOTH', 'nonf', '2016-07-07 15:24:39', 30, 30, 0),
(164, 1, 'Gas and Oil Reliability Engineering (Second Edition)', 'Science Direct', 2016, 'SCI', 'Science Direct', '', '978-0-12-805427-7', 0, 1, 'BOTH', 'nonf', '2016-07-07 15:24:39', 30, 30, 0),
(165, 1, 'Practical Engineering Management of Offshore Oil and Gas Platforms', 'Science Direct', 2016, 'SCI', 'Science Direct', '', '978-0-12-809331-3', 0, 1, 'BOTH', 'nonf', '2016-07-07 15:24:39', 30, 30, 0),
(166, 1, 'Mineral Processing Design and Operations (Second Edition)', 'Science Direct', 2016, 'SCI', 'Science Direct', '', '978-0-444-63589-1', 0, 1, 'BOTH', 'nonf', '2016-07-07 15:24:39', 30, 30, 0),
(167, 1, 'Gold Ore Processing (Second Edition)', 'Science Direct', 2016, 'SCI', 'Science Direct', '', '978-0-444-63658-4', 0, 1, 'BOTH', 'nonf', '2016-07-07 15:24:40', 30, 30, 0),
(168, 1, 'Injection Mold Design Engineering (Second Edition)', 'Science Direct', 2015, 'SCI', 'Science Direct', '', '978-1-56990-570-8', 0, 1, 'BOTH', 'nonf', '2016-07-07 15:24:40', 30, 30, 0),
(169, 1, 'Additive Manufacturing', 'Science Direct', 2015, 'SCI', 'Science Direct', '', '978-1-56990-582-1', 0, 1, 'BOTH', 'nonf', '2016-07-07 15:24:40', 30, 30, 0),
(170, 1, 'Körperlernen', 'Science Direct', 2015, 'SCI', 'Science Direct', '', '978-3-437-45022-8', 0, 1, 'BOTH', 'nonf', '2016-07-07 15:24:40', 30, 30, 0),
(171, 1, 'Encyclopedia of Immunobiology', 'Science Direct', 2016, 'SCI', 'Science Direct', '', '978-0-08-092152-5', 0, 2, 'HARD', 'refe', '2016-07-07 15:24:40', 10, 10, 0),
(172, 1, 'Molecular Virology of Human Pathogenic Viruses', 'Science Direct', 2017, 'SCI', 'Science Direct', '', '978-0-12-800838-6', 0, 1, 'BOTH', 'nonf', '2016-07-07 15:24:40', 30, 30, 0),
(173, 1, 'Elementary Linear Algebra (Fifth Edition)', 'Science Direct', 2016, 'SCI', 'Science Direct', '', '978-0-12-800853-9', 0, 1, 'BOTH', 'nonf', '2016-07-07 15:24:40', 30, 30, 0),
(174, 1, 'Essential Human Virology', 'Science Direct', 2017, 'SCI', 'Science Direct', '', '978-0-12-800947-5', 0, 1, 'BOTH', 'nonf', '2016-07-07 15:24:40', 30, 30, 0),
(175, 1, 'Congenital Heart Disease and Neurodevelopment', 'Science Direct', 2016, 'SCI', 'Science Direct', '', '978-0-12-801640-4', 0, 1, 'BOTH', 'nonf', '2016-07-07 15:24:40', 30, 30, 0),
(176, 1, 'Atlas of Histology of the Juvenile Rat', 'Science Direct', 2016, 'SCI', 'Science Direct', '', '978-0-12-802682-3', 0, 1, 'BOTH', 'nonf', '2016-07-07 15:24:40', 30, 30, 0),
(177, 1, 'Modern Assembly Language Programming with the ARM Processor', 'Science Direct', 2016, 'SCI', 'Science Direct', '', '978-0-12-803698-3', 0, 1, 'BOTH', 'nonf', '2016-07-07 15:24:40', 30, 30, 0),
(178, 1, 'Rural Water Systems for Multiple Uses and Livelihood Security', 'Science Direct', 2016, 'SCI', 'Science Direct', '', '978-0-12-804132-1', 0, 1, 'BOTH', 'nonf', '2016-07-07 15:24:40', 30, 30, 0),
(179, 1, 'Zeolites and Zeolite-Like Materials', 'Science Direct', 2016, 'SCI', 'Science Direct', '', '978-0-444-63506-8', 0, 1, 'BOTH', 'nonf', '2016-07-07 15:24:40', 30, 30, 0),
(180, 1, 'Facharztprüfung Innere Medizin (Fünfte Ausgabe)', 'Science Direct', 2016, 'SCI', 'Science Direct', '', '978-3-437-23335-7', 0, 1, 'BOTH', 'nonf', '2016-07-07 15:24:40', 30, 30, 0),
(181, 1, 'Anatomie Physiologie Für die Physiotherapie (Vierte Ausgabe)', 'Science Direct', 2016, 'SCI', 'Science Direct', '', '978-3-437-45304-5', 0, 1, 'BOTH', 'nonf', '2016-07-07 15:24:40', 30, 30, 0),
(182, 1, 'Neurology Secrets (Sixth Edition)', 'Science Direct', 2017, 'SCI', 'Science Direct', '', '978-0-323-35948-1', 0, 1, 'BOTH', 'nonf', '2016-07-07 15:24:40', 30, 30, 0),
(183, 1, 'Biomaterials and Regenerative Medicine in Ophthalmology (Second Edition)', 'Science Direct', 2016, 'SCI', 'Science Direct', 'Woodhead Publishing Series in Biomaterials', '978-0-08-100147-9', 0, 1, 'BOTH', 'nonf', '2016-07-07 15:24:40', 30, 30, 0),
(184, 1, 'Handbook on Natural Pigments in Food and Beverages', 'Science Direct', 2016, 'SCI', 'Science Direct', '', '978-0-08-100371-8', 0, 1, 'BOTH', 'nonf', '2016-07-07 15:24:40', 30, 30, 0),
(185, 1, 'Smart Textiles and their Applications', 'Science Direct', 2016, 'SCI', 'Science Direct', 'Woodhead Publishing Series in Textiles', '978-0-08-100574-3', 0, 1, 'BOTH', 'nonf', '2016-07-07 15:24:40', 30, 30, 0),
(186, 1, 'Culturally Adapting Psychotherapy for Asian Heritage Populations', 'Science Direct', 2016, 'SCI', 'Science Direct', '', '978-0-12-417304-0', 0, 1, 'BOTH', 'nonf', '2016-07-07 15:24:40', 30, 30, 0),
(187, 1, 'Behavioral Evidence Analysis', 'Science Direct', 2016, 'SCI', 'Science Direct', '', '978-0-12-800607-8', 0, 1, 'BOTH', 'nonf', '2016-07-07 15:24:41', 30, 30, 0),
(188, 1, 'Neuropathology of Drug Addictions and Substance Misuse', 'Science Direct', 2016, 'SCI', 'Science Direct', '', '978-0-12-800634-4', 0, 1, 'BOTH', 'nonf', '2016-07-07 15:24:41', 30, 30, 0),
(189, 1, 'Case Studies in Cell Biology', 'Science Direct', 2016, 'SCI', 'Science Direct', 'Problem Sets in Biological and Biomedical Sciences', '978-0-12-801394-6', 0, 1, 'BOTH', 'nonf', '2016-07-07 15:24:41', 30, 30, 0),
(190, 1, 'Agricultural Law and Economics in Sub-Saharan Africa', 'Science Direct', 2016, 'SCI', 'Science Direct', '', '978-0-12-801771-5', 0, 1, 'BOTH', 'nonf', '2016-07-07 15:24:41', 30, 30, 0),
(191, 1, 'Mechanochemical Organic Synthesis', 'Science Direct', 2016, 'SCI', 'Science Direct', '', '978-0-12-802184-2', 0, 1, 'BOTH', 'nonf', '2016-07-07 15:24:41', 30, 30, 0),
(192, 1, 'Rock Fracture and Blasting', 'Science Direct', 2016, 'SCI', 'Science Direct', '', '978-0-12-802688-5', 0, 1, 'BOTH', 'nonf', '2016-07-07 15:24:41', 30, 30, 0),
(193, 1, 'Fruits, Vegetables, and Herbs', 'Science Direct', 2016, 'SCI', 'Science Direct', '', '978-0-12-802972-5', 0, 1, 'BOTH', 'nonf', '2016-07-07 15:24:41', 30, 30, 0),
(194, 1, 'Human Body Decomposition', 'Science Direct', 2016, 'SCI', 'Science Direct', '', '978-0-12-803691-4', 0, 1, 'BOTH', 'nonf', '2016-07-07 15:24:41', 30, 30, 0),
(195, 1, 'On-Road Intelligent Vehicles', 'Science Direct', 2016, 'SCI', 'Science Direct', '', '978-0-12-803729-4', 0, 1, 'BOTH', 'nonf', '2016-07-07 15:24:41', 30, 30, 0),
(196, 1, 'Environmental Materials and Waste', 'Science Direct', 2016, 'SCI', 'Science Direct', '', '978-0-12-803837-6', 0, 1, 'BOTH', 'nonf', '2016-07-07 15:24:41', 30, 30, 0),
(197, 1, 'Phenotyping Crop Plants for Physiological and Biochemical Traits', 'Science Direct', 2016, 'SCI', 'Science Direct', '', '978-0-12-804073-7', 0, 1, 'BOTH', 'nonf', '2016-07-07 15:24:41', 30, 30, 0),
(198, 1, 'Relational Database Design and Implementation (Fourth Edition)', 'Science Direct', 2016, 'SCI', 'Science Direct', '', '978-0-12-804399-8', 0, 1, 'BOTH', 'nonf', '2016-07-07 15:24:41', 30, 30, 0),
(199, 1, 'Introduction to Finite and Infinite Dimensional Lie (Super)algebras', 'Science Direct', 2016, 'SCI', 'Science Direct', '', '978-0-12-804675-3', 0, 1, 'BOTH', 'nonf', '2016-07-07 15:24:41', 30, 30, 0),
(200, 1, 'Systems Analysis and Synthesis', 'Science Direct', 2016, 'SCI', 'Science Direct', '', '978-0-12-805304-1', 0, 1, 'BOTH', 'nonf', '2016-07-07 15:24:41', 30, 30, 0),
(201, 1, 'Business Intelligence Strategy and Big Data Analytics', 'Science Direct', 2016, 'SCI', 'Science Direct', '', '978-0-12-809198-2', 0, 1, 'BOTH', 'nonf', '2016-07-07 15:24:41', 30, 30, 0),
(202, 1, 'Numerical Methods for Partial Differential Equations', 'Science Direct', 2016, 'SCI', 'Science Direct', '', '978-0-12-849894-1', 0, 1, 'BOTH', 'nonf', '2016-07-07 15:24:41', 30, 30, 0),
(203, 1, 'Boron Nitride Nanotubes in Nanomedicine', 'Science Direct', 2016, 'SCI', 'Science Direct', 'Micro and Nano Technologies', '978-0-323-38945-7', 0, 1, 'BOTH', 'nonf', '2016-07-07 15:24:41', 30, 30, 0),
(204, 1, 'Nanobiomaterials in Drug Delivery', 'Science Direct', 2016, 'SCI', 'Science Direct', '', '978-0-323-42866-8', 0, 1, 'BOTH', 'nonf', '2016-07-07 15:24:41', 30, 30, 0),
(205, 1, 'Qualitative Analysis of Nonsmooth Dynamics', 'Science Direct', 2016, 'SCI', 'Science Direct', '', '978-1-78548-094-2', 0, 1, 'BOTH', 'nonf', '2016-07-07 15:24:42', 30, 30, 0),
(206, 1, 'Multiscale Structural Topology Optimization', 'Science Direct', 2016, 'SCI', 'Science Direct', '', '978-1-78548-100-0', 0, 1, 'BOTH', 'nonf', '2016-07-07 15:24:42', 30, 30, 0),
(207, 1, 'Applications of Time-of-Flight and Orbitrap Mass Spectrometry in Environmental, Food, Doping, and Forensic Analysis', 'Science Direct', 2016, 'SCI', 'Science Direct', 'Comprehensive Analytical Chemistry', '978-0-444-63572-3', 71, 2, 'HARD', 'seri', '2016-07-07 15:24:42', 20, 20, 0),
(208, 1, '{Handbook of the Economics of Education, Volume 5}', 'Science Direct', 2016, 'SCI', 'Science Direct', 'Handbook of the Economics of Education', '978-0-444-63459-7', 5, 2, 'HARD', 'seri', '2016-07-07 15:24:42', 20, 20, 0),
(209, 1, '2D Materials', 'Science Direct', 2016, 'SCI', 'Science Direct', 'Semiconductors and Semimetals', '978-0-12-804272-4', 95, 2, 'HARD', 'seri', '2016-07-07 15:24:42', 20, 20, 0),
(210, 1, 'Particles and Waves in Electron Optics and Microscopy', 'Science Direct', 2016, 'SCI', 'Science Direct', 'Advances in Imaging and Electron Physics', '978-0-12-804814-6', 194, 2, 'HARD', 'seri', '2016-07-07 15:24:42', 20, 20, 0),
(211, 1, 'Autoimmune Neurology', 'Science Direct', 2016, 'SCI', 'Science Direct', 'Handbook of Clinical Neurology', '978-0-444-63432-0', 133, 2, 'HARD', 'seri', '2016-07-07 15:24:42', 20, 20, 0),
(212, 1, 'Multisensory Flavor Perception', 'Science Direct', 2016, 'SCI', 'Science Direct', 'Woodhead Publishing Series in Food Science, Technology and Nutrition', '978-0-08-100350-3', 0, 1, 'BOTH', 'nonf', '2016-07-07 15:24:42', 30, 30, 0),
(213, 1, 'Lightweight Ballistic Composites (Second Edition)', 'Science Direct', 2016, 'SCI', 'Science Direct', 'Woodhead Publishing Series in Composites Science and Engineering', '978-0-08-100406-7', 0, 1, 'BOTH', 'nonf', '2016-07-07 15:24:42', 30, 30, 0),
(214, 1, 'Laser Surface Modification of Biomaterials', 'Science Direct', 2016, 'SCI', 'Science Direct', '', '978-0-08-100883-6', 0, 1, 'BOTH', 'nonf', '2016-07-07 15:24:42', 30, 30, 0),
(215, 1, 'Handbook of Neuro-Oncology Neuroimaging (Second Edition)', 'Science Direct', 2016, 'SCI', 'Science Direct', '', '978-0-12-800945-1', 0, 1, 'BOTH', 'nonf', '2016-07-07 15:24:42', 30, 30, 0),
(216, 1, 'Molecular Basis of Nutrition and Aging', 'Science Direct', 2016, 'SCI', 'Science Direct', '', '978-0-12-801816-3', 0, 1, 'BOTH', 'nonf', '2016-07-07 15:24:42', 30, 30, 0),
(217, 1, 'Ecotoxicology Essentials', 'Science Direct', 2016, 'SCI', 'Science Direct', '', '978-0-12-801947-4', 0, 1, 'BOTH', 'nonf', '2016-07-07 15:24:42', 30, 30, 0),
(218, 1, 'Geology of the Himalayan Belt', 'Science Direct', 2016, 'SCI', 'Science Direct', '', '978-0-12-802021-0', 0, 1, 'BOTH', 'nonf', '2016-07-07 15:24:42', 30, 30, 0),
(219, 1, 'Foreign Direct Investment in Brazil', 'Science Direct', 2016, 'SCI', 'Science Direct', '', '978-0-12-802067-8', 0, 1, 'BOTH', 'nonf', '2016-07-07 15:24:42', 30, 30, 0),
(220, 1, 'Chelation Therapy in the Treatment of Metal Intoxication', 'Science Direct', 2016, 'SCI', 'Science Direct', '', '978-0-12-803072-1', 0, 1, 'BOTH', 'nonf', '2016-07-07 15:24:42', 30, 30, 0),
(221, 1, 'Hydrodynamics and Transport Processes of Inverse Bubbly Flow', 'Science Direct', 2016, 'SCI', 'Science Direct', '', '978-0-12-803287-9', 0, 1, 'BOTH', 'nonf', '2016-07-07 15:24:42', 30, 30, 0),
(222, 1, 'Storing Energy', 'Science Direct', 2016, 'SCI', 'Science Direct', '', '978-0-12-803440-8', 0, 1, 'BOTH', 'nonf', '2016-07-07 15:24:42', 30, 30, 0),
(223, 1, 'Analytical Chemistry for Assessing Medication Adherence', 'Science Direct', 2016, 'SCI', 'Science Direct', '', '978-0-12-805463-5', 0, 1, 'BOTH', 'nonf', '2016-07-07 15:24:42', 30, 30, 0),
(224, 1, 'Encyclopedia of Evolutionary Biology', 'Science Direct', 2016, 'SCI', 'Science Direct', '', '978-0-12-800426-5', 0, 2, 'HARD', 'refe', '2016-07-07 15:24:42', 10, 10, 0),
(225, 1, 'Neurobiology of Epilepsy', 'Science Direct', 2016, 'SCI', 'Science Direct', 'Progress in Brain Research', '978-0-12-803886-4', 226, 2, 'HARD', 'seri', '2016-07-07 15:24:42', 20, 20, 0),
(226, 1, 'Genes and Evolution', 'Science Direct', 2016, 'SCI', 'Science Direct', 'Current Topics in Developmental Biology', '978-0-12-417194-7', 119, 2, 'HARD', 'seri', '2016-07-07 15:24:42', 20, 20, 0),
(227, 1, 'The Mathematical Brain Across the Lifespan', 'Science Direct', 2016, 'SCI', 'Science Direct', 'Progress in Brain Research', '978-0-444-63698-0', 227, 2, 'HARD', 'seri', '2016-07-07 15:24:42', 20, 20, 0),
(228, 1, '{Advances in Clinical Chemistry, Volume 75}', 'Science Direct', 2016, 'SCI', 'Science Direct', 'Advances in Clinical Chemistry', '978-0-12-804688-3', 75, 2, 'HARD', 'seri', '2016-07-07 15:24:43', 20, 20, 0),
(229, 1, 'Emotion Measurement', 'Science Direct', 2016, 'SCI', 'Science Direct', '', '978-0-08-100508-8', 0, 1, 'BOTH', 'nonf', '2016-07-07 15:24:43', 30, 30, 0),
(230, 1, 'Information Systems for the Fashion and Apparel Industry', 'Science Direct', 2016, 'SCI', 'Science Direct', 'Woodhead Publishing Series in Textiles', '978-0-08-100571-2', 0, 1, 'BOTH', 'nonf', '2016-07-07 15:24:43', 30, 30, 0),
(231, 1, 'Antimicrobial Textiles', 'Science Direct', 2016, 'SCI', 'Science Direct', 'Woodhead Publishing Series in Textiles', '978-0-08-100576-7', 0, 1, 'BOTH', 'nonf', '2016-07-07 15:24:43', 30, 30, 0),
(232, 1, 'Project Finance for the International Petroleum Industry', 'Science Direct', 2016, 'SCI', 'Science Direct', '', '978-0-12-800158-5', 0, 1, 'BOTH', 'nonf', '2016-07-07 15:24:43', 30, 30, 0),
(233, 1, 'The Diverse Faces of Bacillus cereus', 'Science Direct', 2016, 'SCI', 'Science Direct', '', '978-0-12-801474-5', 0, 1, 'BOTH', 'nonf', '2016-07-07 15:24:43', 30, 30, 0),
(234, 1, 'Building a Travel Risk Management Program', 'Science Direct', 2016, 'SCI', 'Science Direct', '', '978-0-12-801925-2', 0, 1, 'BOTH', 'nonf', '2016-07-07 15:24:43', 30, 30, 0),
(235, 1, 'Advanced Mechanical Models of DNA Elasticity', 'Science Direct', 2016, 'SCI', 'Science Direct', '', '978-0-12-801999-3', 0, 1, 'BOTH', 'nonf', '2016-07-07 15:24:43', 30, 30, 0),
(236, 1, 'Food Safety', 'Science Direct', 2016, 'SCI', 'Science Direct', '', '978-0-12-803104-9', 0, 1, 'BOTH', 'nonf', '2016-07-07 15:24:43', 30, 30, 0),
(237, 1, 'Lessons in Immunity', 'Science Direct', 2016, 'SCI', 'Science Direct', '', '978-0-12-803252-7', 0, 1, 'BOTH', 'nonf', '2016-07-07 15:24:43', 30, 30, 0),
(238, 1, 'Theory of Approximate Functional Equations', 'Science Direct', 2016, 'SCI', 'Science Direct', '', '978-0-12-803920-5', 0, 1, 'BOTH', 'nonf', '2016-07-07 15:24:43', 30, 30, 0),
(239, 1, 'Eco-Friendly Technology for Postharvest Produce Quality', 'Science Direct', 2016, 'SCI', 'Science Direct', '', '978-0-12-804313-4', 0, 1, 'BOTH', 'nonf', '2016-07-07 15:24:43', 30, 30, 0),
(240, 1, 'Introduction to EEG- and Speech-Based Emotion Recognition', 'Science Direct', 2016, 'SCI', 'Science Direct', '', '978-0-12-804490-2', 0, 1, 'BOTH', 'nonf', '2016-07-07 15:24:43', 30, 30, 0),
(241, 1, 'Neurology for the Speech-Language Pathologist (Sixth Edition)', 'Science Direct', 2017, 'SCI', 'Science Direct', '', '978-0-323-10027-4', 0, 1, 'BOTH', 'nonf', '2016-07-07 15:24:43', 30, 30, 0),
(242, 1, 'Nanobiomaterials in Medical Imaging', 'Science Direct', 2016, 'SCI', 'Science Direct', '', '978-0-323-41736-5', 0, 1, 'BOTH', 'nonf', '2016-07-07 15:24:43', 30, 30, 0),
(243, 1, 'Current Therapy in Avian Medicine and Surgery', 'Science Direct', 2016, 'SCI', 'Science Direct', '', '978-1-4557-4671-2', 0, 1, 'BOTH', 'nonf', '2016-07-07 15:24:43', 30, 30, 0),
(244, 1, 'Deploying Wireless Sensor Networks', 'Science Direct', 2016, 'SCI', 'Science Direct', '', '978-1-78548-099-7', 0, 1, 'BOTH', 'nonf', '2016-07-07 15:24:43', 30, 30, 0),
(245, 1, 'testing', 'tee', 2016, 'TECH', 'Tee Publishing', 'Tee Series', '987-123-1234', 1, 1, 'SOFT', 'fict', '2016-07-19 13:54:09', 21, 21, 0),
(246, 1, 'dsa', 'tee', 2016, 'TECH', 'Tee Publishing', 'Tee Series', '987-123-3214', 1, 21, 'SOFT', 'fict', '2016-07-19 14:01:42', 11, 11, 0),
(247, 1, 'algorithmic', 'tee', 2014, 'TECH', 'Tee publishing', 'Tee Series', '987-123-4322', 2, 12, 'SOFT', 'fict', '2016-07-19 14:01:57', 32, 32, 0),
(248, 1, 'numerical analysis', 'tee', 2016, 'SCI', 'Tee Publishing', 'Tee Series', '987-123-1235', 2, 3, 'HARD', 'nonf', '2016-07-19 14:09:00', 4, 4, 0);

-- --------------------------------------------------------

--
-- Table structure for table `lms_books_format`
--

CREATE TABLE `lms_books_format` (
  `book_format_id` int(2) UNSIGNED NOT NULL,
  `book_format_code` varchar(5) NOT NULL,
  `book_format` varchar(24) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `lms_books_format`
--

INSERT INTO `lms_books_format` (`book_format_id`, `book_format_code`, `book_format`) VALUES
(1, 'SOFT', 'SOFT COPY'),
(2, 'HARD', 'HARD COPY'),
(3, 'BOTH', 'BOTH (Hard & Soft)');

-- --------------------------------------------------------

--
-- Table structure for table `lms_books_type_relation`
--

CREATE TABLE `lms_books_type_relation` (
  `book_type_relation_id` int(14) UNSIGNED NOT NULL,
  `book_id` int(12) NOT NULL,
  `book_type_id` int(3) NOT NULL,
  `book_type_code` varchar(10) NOT NULL,
  `book_type` varchar(72) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `lms_books_type_relation`
--

INSERT INTO `lms_books_type_relation` (`book_type_relation_id`, `book_id`, `book_type_id`, `book_type_code`, `book_type`) VALUES
(1, 0, 0, 'news', 'Newspapers & Magazines'),
(2, 0, 0, 'pamp', 'Pamphlets'),
(3, 0, 0, 'nonf', 'Non-Fiction (Textbooks)'),
(4, 0, 0, 'fict', 'Fiction (Story Books)'),
(5, 0, 0, 'refe', 'Reference Materials'),
(6, 0, 0, 'seri', 'Serials'),
(7, 0, 0, 'gove', 'Government Publications'),
(8, 0, 0, 'ephe', 'Ephemerals'),
(9, 0, 0, 'thes', 'Thesis (Dissertation)'),
(10, 0, 0, 'rare', 'Rare Books'),
(11, 0, 0, 'grap', 'Graphics'),
(12, 0, 0, 'maps', 'Maps & Atlases'),
(13, 0, 0, 'arti', 'Artifacts'),
(14, 0, 0, 'audv', 'Audio Visuals'),
(15, 0, 0, 'audi', 'Audio');

-- --------------------------------------------------------

--
-- Table structure for table `lms_books_type_settings`
--

CREATE TABLE `lms_books_type_settings` (
  `book_type_id` int(3) UNSIGNED NOT NULL,
  `book_type_code` varchar(10) NOT NULL,
  `book_type` varchar(72) NOT NULL,
  `enabled` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `lms_books_type_settings`
--

INSERT INTO `lms_books_type_settings` (`book_type_id`, `book_type_code`, `book_type`, `enabled`) VALUES
(1, 'news', 'Newspapers & Magazines', 1),
(2, 'pamp', 'Pamphlets', 1),
(3, 'nonf', 'Non-Fiction (Textbooks)', 1),
(4, 'fict', 'Fiction (Story Books)', 1),
(5, 'refe', 'Reference Materials', 1),
(6, 'seri', 'Serials', 0),
(7, 'gove', 'Government Publications', 0),
(8, 'ephe', 'Ephemerals', 0),
(9, 'thes', 'Thesis (Dissertation)', 0),
(10, 'rare', 'Rare Books', 0),
(11, 'grap', 'Graphics', 1),
(12, 'maps', 'Maps & Atlases', 1),
(13, 'arti', 'Artifacts', 0),
(14, 'audv', 'Audio Visuals', 1),
(15, 'audi', 'Audio', 1);

-- --------------------------------------------------------

--
-- Table structure for table `lms_borrowed`
--

CREATE TABLE `lms_borrowed` (
  `bid` int(16) UNSIGNED NOT NULL,
  `user_id` int(12) UNSIGNED NOT NULL,
  `book_id` int(12) UNSIGNED NOT NULL,
  `issue_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `approval_code` varchar(1) NOT NULL DEFAULT 'P',
  `admin_id` int(12) UNSIGNED NOT NULL,
  `borrowed_date` datetime NOT NULL,
  `returned_date` datetime NOT NULL,
  `return_status` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `lms_downloaded`
--

CREATE TABLE `lms_downloaded` (
  `did` int(16) UNSIGNED NOT NULL,
  `user_id` int(12) UNSIGNED NOT NULL,
  `book_id` int(12) UNSIGNED NOT NULL,
  `downloaded_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `lms_fields`
--

CREATE TABLE `lms_fields` (
  `lms_field_id` int(8) NOT NULL,
  `lms_department_code` varchar(8) NOT NULL DEFAULT 'CSC',
  `lms_department` varchar(64) NOT NULL DEFAULT 'COMPUTER SCIENCE'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `lms_fields`
--

INSERT INTO `lms_fields` (`lms_field_id`, `lms_department_code`, `lms_department`) VALUES
(1, 'TECH', 'TECHNOLOGY'),
(2, 'SCI', 'SCIENCE'),
(3, 'ARTS', 'ARTS'),
(4, 'ENGR', 'ENGINEERING'),
(5, 'MED', 'MEDICINE'),
(6, 'EDU', 'EDUCATION'),
(7, 'LAW', 'LAW'),
(8, 'ECONS', 'ECONOMICS');

-- --------------------------------------------------------

--
-- Table structure for table `lms_lib_info`
--

CREATE TABLE `lms_lib_info` (
  `lms_lib_id` int(4) UNSIGNED NOT NULL,
  `lms_lib_name` varchar(128) NOT NULL,
  `lms_lib_location` varchar(256) NOT NULL,
  `lms_lib_email` varchar(72) NOT NULL,
  `lms_lib_telephone` varchar(25) NOT NULL DEFAULT 'NA',
  `lms_lib_description` varchar(256) NOT NULL,
  `lms_lib_type_code` varchar(3) NOT NULL DEFAULT 'sch'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `lms_lib_type`
--

CREATE TABLE `lms_lib_type` (
  `lib_type_code` varchar(3) NOT NULL DEFAULT 'sch',
  `lib_type` varchar(8) NOT NULL DEFAULT 'SCHOOL'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `lms_lib_type`
--

INSERT INTO `lms_lib_type` (`lib_type_code`, `lib_type`) VALUES
('pub', 'PUBLIC'),
('sch', 'SCHOOL');

-- --------------------------------------------------------

--
-- Table structure for table `lms_page_setup`
--

CREATE TABLE `lms_page_setup` (
  `page_id` int(3) UNSIGNED NOT NULL,
  `page_name` varchar(24) NOT NULL,
  `render_limit` int(5) NOT NULL DEFAULT '10',
  `tab_pinned` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `lms_page_setup`
--

INSERT INTO `lms_page_setup` (`page_id`, `page_name`, `render_limit`, `tab_pinned`) VALUES
(1, 'dashboard', 10, 1),
(2, 'profile', 10, 1),
(3, 'books', 25, 2),
(4, 'users', 10, 1),
(5, 'catalogue', 10, 1),
(6, 'borrowed', 10, 1),
(7, 'downloaded', 10, 1),
(8, 'settings', 10, 1),
(9, 'backup', 10, 1);

-- --------------------------------------------------------

--
-- Table structure for table `lms_users`
--

CREATE TABLE `lms_users` (
  `user_id` int(12) NOT NULL,
  `username` varchar(32) NOT NULL,
  `email` varchar(72) NOT NULL,
  `password` varchar(50) NOT NULL,
  `name` varchar(64) NOT NULL,
  `mob_no` varchar(32) NOT NULL,
  `gender` varchar(8) NOT NULL DEFAULT 'M',
  `matric_no` varchar(32) NOT NULL,
  `department` varchar(128) NOT NULL DEFAULT 'COMPUTER SCIENCE',
  `occupation` varchar(128) NOT NULL DEFAULT 'STUDENT',
  `downloaded` int(5) NOT NULL DEFAULT '0',
  `borrowed` int(3) NOT NULL DEFAULT '0',
  `user_uid` varchar(10) NOT NULL DEFAULT 'NA',
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `blocked` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `lms_users`
--

INSERT INTO `lms_users` (`user_id`, `username`, `email`, `password`, `name`, `mob_no`, `gender`, `matric_no`, `department`, `occupation`, `downloaded`, `borrowed`, `user_uid`, `status`, `blocked`) VALUES
(1, 'tolu101', 'adebimpetolu@gmail.com', 'teelady', 'Adebimpe Tolu', '', 'F', '', 'COMPUTER SCIENCE', 'STUDENT', 0, 0, '34RDGCE', 0, 0),
(2, 'teejay', 'oyenirantunji2339@gmail.com', 'utile', 'tunji oyeniran', '08166559513', 'M', '', 'COMPUTER SCIENCE', 'STUDENT', 0, 0, '56DPMHW', 0, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `lms_admin`
--
ALTER TABLE `lms_admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `lms_approval`
--
ALTER TABLE `lms_approval`
  ADD PRIMARY KEY (`approval_code`);

--
-- Indexes for table `lms_books`
--
ALTER TABLE `lms_books`
  ADD PRIMARY KEY (`book_id`),
  ADD KEY `field_code` (`department_code`),
  ADD KEY `type_code` (`type_code`),
  ADD KEY `admin_id` (`admin_id`);

--
-- Indexes for table `lms_books_format`
--
ALTER TABLE `lms_books_format`
  ADD PRIMARY KEY (`book_format_id`),
  ADD KEY `lms_book_type_code` (`book_format_code`);

--
-- Indexes for table `lms_books_type_relation`
--
ALTER TABLE `lms_books_type_relation`
  ADD PRIMARY KEY (`book_type_relation_id`),
  ADD KEY `book_type_code` (`book_type_code`),
  ADD KEY `book_id` (`book_id`),
  ADD KEY `book_type` (`book_type`),
  ADD KEY `book_type_code_2` (`book_type_code`),
  ADD KEY `book_type_id` (`book_type_id`),
  ADD KEY `book_id_2` (`book_id`);

--
-- Indexes for table `lms_books_type_settings`
--
ALTER TABLE `lms_books_type_settings`
  ADD PRIMARY KEY (`book_type_id`),
  ADD KEY `book_type_code` (`book_type_code`),
  ADD KEY `book_type` (`book_type`);

--
-- Indexes for table `lms_borrowed`
--
ALTER TABLE `lms_borrowed`
  ADD PRIMARY KEY (`bid`),
  ADD KEY `approval_code` (`approval_code`);

--
-- Indexes for table `lms_downloaded`
--
ALTER TABLE `lms_downloaded`
  ADD PRIMARY KEY (`did`);

--
-- Indexes for table `lms_fields`
--
ALTER TABLE `lms_fields`
  ADD PRIMARY KEY (`lms_field_id`),
  ADD KEY `lms_field_code` (`lms_department_code`);

--
-- Indexes for table `lms_lib_info`
--
ALTER TABLE `lms_lib_info`
  ADD PRIMARY KEY (`lms_lib_id`),
  ADD UNIQUE KEY `lms_lib_type_id` (`lms_lib_type_code`),
  ADD UNIQUE KEY `lms_lib_name` (`lms_lib_name`);

--
-- Indexes for table `lms_lib_type`
--
ALTER TABLE `lms_lib_type`
  ADD UNIQUE KEY `lib_type_code` (`lib_type_code`);

--
-- Indexes for table `lms_page_setup`
--
ALTER TABLE `lms_page_setup`
  ADD PRIMARY KEY (`page_id`);

--
-- Indexes for table `lms_users`
--
ALTER TABLE `lms_users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `lms_admin`
--
ALTER TABLE `lms_admin`
  MODIFY `admin_id` int(4) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `lms_books`
--
ALTER TABLE `lms_books`
  MODIFY `book_id` int(12) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=249;
--
-- AUTO_INCREMENT for table `lms_books_format`
--
ALTER TABLE `lms_books_format`
  MODIFY `book_format_id` int(2) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `lms_books_type_relation`
--
ALTER TABLE `lms_books_type_relation`
  MODIFY `book_type_relation_id` int(14) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `lms_books_type_settings`
--
ALTER TABLE `lms_books_type_settings`
  MODIFY `book_type_id` int(3) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `lms_borrowed`
--
ALTER TABLE `lms_borrowed`
  MODIFY `bid` int(16) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `lms_downloaded`
--
ALTER TABLE `lms_downloaded`
  MODIFY `did` int(16) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `lms_fields`
--
ALTER TABLE `lms_fields`
  MODIFY `lms_field_id` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `lms_lib_info`
--
ALTER TABLE `lms_lib_info`
  MODIFY `lms_lib_id` int(4) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `lms_page_setup`
--
ALTER TABLE `lms_page_setup`
  MODIFY `page_id` int(3) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `lms_users`
--
ALTER TABLE `lms_users`
  MODIFY `user_id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
