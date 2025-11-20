-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 14, 2025 at 06:14 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_saloon`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_admin`
--

CREATE TABLE `tbl_admin` (
  `admin_id` int(11) NOT NULL,
  `admin_name` varchar(40) NOT NULL,
  `admin_email` varchar(40) NOT NULL,
  `admin_password` varchar(30) NOT NULL,
  `admin_status` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_admin`
--

INSERT INTO `tbl_admin` (`admin_id`, `admin_name`, `admin_email`, `admin_password`, `admin_status`) VALUES
(1, 'Admin', 'admin@gmail.com', 'Admin@123', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_booking`
--

CREATE TABLE `tbl_booking` (
  `booking_id` int(11) NOT NULL,
  `booking_date` varchar(40) NOT NULL,
  `booking_todate` varchar(40) NOT NULL,
  `user_id` int(11) NOT NULL,
  `booking_status` int(11) NOT NULL DEFAULT 0,
  `booking_amount` int(11) NOT NULL,
  `booking_total_amount` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_booking`
--

INSERT INTO `tbl_booking` (`booking_id`, `booking_date`, `booking_todate`, `user_id`, `booking_status`, `booking_amount`, `booking_total_amount`) VALUES
(9, '2025-11-14', '2025-11-15', 1, 2, 16, 160),
(10, '2025-11-14', '2025-11-20', 1, 2, 200, 2000),
(11, '2025-11-14', '2025-11-27', 1, 3, 2000, 20000),
(12, '2025-11-14', '2025-11-19', 1, 1, 20, 200),
(13, '2025-11-14', '2025-11-22', 1, 1, 26, 260),
(16, '2025-11-14', '2025-11-15', 3, 2, 200, 2000),
(17, '2025-11-14', '2025-11-20', 3, 3, 30, 300),
(18, '2025-11-14', '2025-11-19', 3, 2, 50, 500),
(19, '2025-11-14', '2025-11-15', 3, 2, 20, 200),
(20, '2025-11-14', '2025-11-15', 3, 1, 20, 200),
(21, '2025-11-14', '2025-11-19', 3, 0, 0, 0),
(22, '2025-11-14', '2025-11-20', 1, 3, 200, 2000),
(23, '2025-11-14', '2025-11-18', 1, 2, 30, 300),
(24, '2025-11-14', '2025-11-15', 7, 2, 16, 160);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_category`
--

CREATE TABLE `tbl_category` (
  `category_id` int(11) NOT NULL,
  `category_name` varchar(40) NOT NULL,
  `category_status` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_category`
--

INSERT INTO `tbl_category` (`category_id`, `category_name`, `category_status`) VALUES
(1, 'HAIR CARE', 1),
(2, 'SKIN AND FACIAL CARE', 1),
(3, 'MAKEUP', 1),
(4, 'SPA AND MASSAGE', 1),
(5, 'NAIL SERVICE', 1),
(6, 'HAIR REMOVAL SERVICE', 1),
(7, 'BARBERING SERVICES', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_complaint`
--

CREATE TABLE `tbl_complaint` (
  `complaint_id` int(11) NOT NULL,
  `complaint_title` varchar(40) NOT NULL,
  `complaint_content` varchar(200) NOT NULL,
  `complaint_reply` varchar(90) NOT NULL,
  `complaint_date` date NOT NULL,
  `complaint_status` int(11) NOT NULL DEFAULT 0,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_complaint`
--

INSERT INTO `tbl_complaint` (`complaint_id`, `complaint_title`, `complaint_content`, `complaint_reply`, `complaint_date`, `complaint_status`, `user_id`) VALUES
(1, 'comfort related', 'seats are uncomfortable.', 'well we will resolve the issue soon', '2025-09-10', 1, 1),
(3, 'service issue', 'Lot of hairs are on the floor and wall.', '', '2025-11-14', 0, 1),
(4, 'Mirror', 'Mirror is cleaned but it is broken.', '', '2025-11-14', 0, 3);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_district`
--

CREATE TABLE `tbl_district` (
  `district_id` int(11) NOT NULL,
  `district_name` varchar(40) NOT NULL,
  `state_id` int(11) NOT NULL,
  `district_status` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_district`
--

INSERT INTO `tbl_district` (`district_id`, `district_name`, `state_id`, `district_status`) VALUES
(1, 'Malappuram', 1, 1),
(2, 'Palakkad', 1, 1),
(3, 'Coim', 2, 0),
(4, 'Coimbatore', 2, 1),
(5, 'Chennai', 2, 1),
(6, 'Banglore', 3, 1),
(7, 'Ballari', 3, 1),
(8, 'Vishakapatanam', 4, 1),
(9, 'Srikakulam', 4, 1),
(10, 'Guntur', 4, 1),
(11, 'Tawang', 8, 1),
(12, 'Itanagar', 8, 1),
(13, 'Ziro', 8, 1),
(14, 'Kamrup Metro', 9, 1),
(15, 'Dibrugarh', 9, 1),
(16, 'Cachar', 9, 1),
(17, 'Patna', 10, 1),
(18, 'Gaya', 10, 1),
(19, 'Raipur', 11, 1),
(20, 'Durg', 11, 1),
(21, 'North Goa', 6, 1),
(22, 'South Goa', 6, 1),
(23, 'Ahmadabad', 28, 1),
(24, 'Vadodara', 28, 1),
(25, 'Gurugram', 7, 1),
(26, 'Mandi', 12, 0),
(27, 'Kangra', 12, 1),
(28, 'Shimla', 12, 1),
(29, 'Faridabad', 7, 1),
(30, 'Ranchi', 13, 1),
(31, 'Jamshedpur', 13, 1),
(32, 'Dhanbad', 13, 1),
(33, 'Mysuru', 3, 1),
(34, 'ERNAKULAM', 1, 1),
(35, 'Bhopal', 14, 1),
(36, 'Indore', 14, 1),
(37, 'Pune', 5, 1),
(38, 'Mumbai', 5, 1),
(39, 'Nagpur', 5, 1),
(40, 'Thoubal', 15, 1),
(41, 'Churachandpur', 15, 1),
(42, 'West Garo Hills', 16, 1),
(43, 'East Khasi Hill', 16, 1),
(44, 'Aizawl', 17, 1),
(45, 'Kolasib', 17, 1),
(46, 'Kohima', 18, 1),
(47, 'Dimapur', 18, 1),
(48, 'Mokokchung', 18, 1),
(49, 'Khordha', 19, 1),
(50, 'Cuttack', 19, 1),
(51, 'Ganjam', 19, 1),
(52, 'Amritsar', 20, 1),
(53, 'Ludhiana', 20, 1),
(54, 'Jalandhar', 20, 1),
(55, 'Jaipur', 21, 1),
(56, 'Jodhpur', 21, 1),
(57, 'Udaipur', 21, 1),
(58, 'East Sikkim', 22, 1),
(59, 'West Sikkim', 22, 1),
(60, 'Madurai', 2, 1),
(61, 'Hyderabad', 23, 1),
(62, 'Warangal', 23, 1),
(63, 'South Tripura', 24, 1),
(64, 'Unakoti', 24, 1),
(65, 'Lucknow', 25, 1),
(66, 'Varanasi', 25, 1),
(67, 'Agra', 25, 1),
(68, 'Dehradun', 26, 1),
(69, 'Nainital', 26, 1),
(70, 'Haridwar', 26, 1),
(71, 'Kolkata', 27, 1),
(72, 'Darjeeling', 27, 1),
(73, 'Howrah', 27, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_feedback`
--

CREATE TABLE `tbl_feedback` (
  `feedback_id` int(11) NOT NULL,
  `feedback_content` varchar(100) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_feedback`
--

INSERT INTO `tbl_feedback` (`feedback_id`, `feedback_content`, `user_id`) VALUES
(1, 'I am really satisfied with your services.', 1),
(2, 'Your service was awesome, i will recommend it.', 1),
(3, 'Awesome service.', 3);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_leave`
--

CREATE TABLE `tbl_leave` (
  `leave_id` int(11) NOT NULL,
  `leave_date` date NOT NULL,
  `saloon_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_leave`
--

INSERT INTO `tbl_leave` (`leave_id`, `leave_date`, `saloon_id`) VALUES
(4, '2025-11-18', 4),
(5, '2025-11-25', 4),
(6, '2025-12-02', 4),
(7, '2025-12-09', 4),
(8, '2025-12-16', 4),
(10, '2025-12-23', 4),
(11, '2025-12-30', 4),
(12, '2025-11-16', 18),
(13, '2025-11-23', 18),
(14, '2025-11-30', 18),
(15, '2025-12-07', 18),
(16, '2025-12-14', 18),
(17, '2025-12-21', 18),
(18, '2025-12-28', 18),
(19, '2025-12-22', 1),
(20, '2025-12-24', 1),
(21, '2026-01-23', 1),
(22, '2025-12-25', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_livebooking`
--

CREATE TABLE `tbl_livebooking` (
  `livebooking_id` int(11) NOT NULL,
  `livebooking_username` varchar(30) NOT NULL,
  `livebooking_usercontact` varchar(30) NOT NULL,
  `livebooking_status` int(11) NOT NULL DEFAULT 0,
  `livebooking_amount` int(11) NOT NULL,
  `livebooking_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_livebooking`
--

INSERT INTO `tbl_livebooking` (`livebooking_id`, `livebooking_username`, `livebooking_usercontact`, `livebooking_status`, `livebooking_amount`, `livebooking_date`) VALUES
(6, 'Asif', '9946111080', 0, 100, '2025-11-14'),
(7, 'Arun', '9967554321', 0, 350, '2025-11-14'),
(8, 'Nithin', '8878987898', 0, 3500, '2025-11-14'),
(9, 'Hamdan', '9930495768', 0, 20000, '2025-11-14'),
(10, 'Samad', '9068574635', 0, 2000, '2025-11-14'),
(11, 'Krish Unni', '9806958493', 0, 500, '2025-11-14'),
(12, 'Safeer', '9980796857', 0, 2000, '2025-11-14'),
(13, 'Kumar', '9046789746', 0, 2469, '2025-11-14');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_liverequirements`
--

CREATE TABLE `tbl_liverequirements` (
  `liverequirements_id` int(11) NOT NULL,
  `salooncategory_id` int(11) NOT NULL,
  `livebooking_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_liverequirements`
--

INSERT INTO `tbl_liverequirements` (`liverequirements_id`, `salooncategory_id`, `livebooking_id`) VALUES
(11, 6, 6),
(12, 2, 7),
(13, 3, 8),
(14, 37, 9),
(15, 42, 10),
(16, 10, 11),
(17, 13, 12),
(18, 43, 13);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_package`
--

CREATE TABLE `tbl_package` (
  `package_id` int(11) NOT NULL,
  `package_name` varchar(40) NOT NULL,
  `package_amount` int(11) NOT NULL,
  `package_description` varchar(100) NOT NULL,
  `package_photo` varchar(100) NOT NULL,
  `package_status` int(11) NOT NULL DEFAULT 1,
  `saloon_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_package`
--

INSERT INTO `tbl_package` (`package_id`, `package_name`, `package_amount`, `package_description`, `package_photo`, `package_status`, `saloon_id`) VALUES
(1, 'Cutting', 280, 'this package include all the cutting facilities with discount.', 'package2.webp', 1, 1),
(4, 'Luxury Care', 1500, 'A premium grooming package including haircut, beard styling, and hair spa for a complete refresh.', 'package photo.jpg', 1, 4),
(5, 'Classic Groomin', 599, 'A standard grooming set with haircut, beard trim, and quick face cleanup.\r\n', 'package photo.jpg', 1, 4),
(6, 'Royal Makeover', 259, 'A high-end makeover package with styling consultation, haircut, beard shaping, and premium hair trea', 'package photo.jpg', 1, 4),
(7, 'Gentle Touch', 3999, 'A soothing grooming experience featuring haircut, head massage, and moisturizing treatment.', 'package photo.jpg', 1, 4),
(8, 'Ultimate Style', 3999, 'A complete styling package that includes haircut, beard design, hair wash, and finishing products.', 'package photo.jpg', 1, 4),
(9, 'Premium', 90000, 'Our top-tier package with all features included.', 'package photo.jpg', 1, 18),
(10, 'Standard', 10000, 'A balanced package for everyday use.', 'package photo.jpg', 1, 18),
(11, 'Basic', 5000, 'Entry-level package with essential features.', 'package photo.jpg', 1, 18),
(12, 'Family', 25000, 'Perfect for families or multiple users.', 'package photo.jpg', 1, 18),
(13, 'Business', 50000, 'Comprehensive package for professionals and businesses.', 'package photo.jpg', 1, 18),
(14, 'Gold', 20000, 'High-value package offering advanced features and priority access.', 'package photo.jpg', 1, 1),
(15, 'Silver', 129, 'Mid-tier option balancing features and affordability.', 'package photo.jpg', 1, 1),
(16, 'Starter', 299, 'Basic package ideal for new users trying the service.', 'package photo.jpg', 1, 1),
(17, 'Ultimate', 29999, 'All-in-one package with maximum features and VIP support.', 'package photo.jpg', 1, 2),
(18, 'Eco', 9999, 'Environment-friendly package focused on minimal usage and savings.', 'package photo.jpg', 1, 2),
(19, 'Deluxe', 30000, 'A feature-rich package designed for users who want more customization and comfort.', 'package photo.jpg', 1, 5),
(20, 'Essentials', 10000, 'Covers all the must-have features at an affordable price.', 'package photo.jpg', 1, 5),
(21, 'Pro', 2000, 'Professional-grade package suitable for advanced users.', 'package photo.jpg', 1, 5),
(22, 'Lite', 1299, 'A minimal, lightweight package with essential functionality only.', 'package photo.jpg', 1, 5),
(23, 'Standard', 110, 'A balanced package \r\n', 'package photo.jpg', 1, 6),
(24, 'Classic Manicur', 150, 'A classic nail care treatment including shaping, cuticle care, massage, and polish\r\n', 'package photo.jpg', 1, 6),
(25, 'Premium Pedicur', 400, 'A luxurious pedicure with exfoliation, mask treatment, and intense moisturization for soft, smooth f', 'package photo.jpg', 1, 8),
(26, 'Bridal Beauty Package', 2000, 'An all-in-one pampering package for brides including makeup, hairstyling, facial, and nail care.', 'package photo.jpg', 1, 8),
(27, 'Radiant Glow Facial', 500, 'A rejuvenating facial package that deeply hydrates and brightens the skin.', 'package photo.jpg', 1, 14),
(28, 'Blossom Aroma Pedicure', 1000, 'A relaxing pedicure with aromatic oils, exfoliation, and soothing foot massage.', 'package photo.jpg', 1, 14);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_packagebooking`
--

CREATE TABLE `tbl_packagebooking` (
  `packagebooking_id` int(11) NOT NULL,
  `packagebooking_date` varchar(100) NOT NULL,
  `packagebooking_todate` varchar(100) NOT NULL,
  `packagebooking_amount` int(11) NOT NULL,
  `packagebooking_status` int(11) NOT NULL DEFAULT 0,
  `user_id` int(11) NOT NULL,
  `package_id` int(11) NOT NULL,
  `slot_id` int(11) NOT NULL,
  `packagebooking_totalamount` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_packagebooking`
--

INSERT INTO `tbl_packagebooking` (`packagebooking_id`, `packagebooking_date`, `packagebooking_todate`, `packagebooking_amount`, `packagebooking_status`, `user_id`, `package_id`, `slot_id`, `packagebooking_totalamount`) VALUES
(5, '2025-11-14', '2025-11-20', 150, 2, 1, 4, 8, 1500),
(6, '2025-11-14', '2025-11-29', 60, 1, 1, 5, 12, 599),
(7, '2025-11-14', '2025-11-20', 150, 0, 1, 4, 10, 1500),
(8, '2025-11-14', '2025-11-21', 400, 1, 1, 8, 12, 3999),
(9, '2025-11-14', '2025-11-27', 9000, 1, 3, 9, 16, 90000),
(10, '2025-11-14', '2025-11-19', 500, 0, 3, 11, 15, 5000),
(11, '2025-11-14', '2025-11-26', 26, 2, 3, 6, 13, 259),
(12, '2025-11-14', '2025-11-19', 9000, 0, 3, 9, 15, 90000),
(13, '2025-11-14', '2025-11-15', 3000, 0, 1, 17, 28, 29999);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_place`
--

CREATE TABLE `tbl_place` (
  `place_id` int(11) NOT NULL,
  `place_name` varchar(30) NOT NULL,
  `district_id` int(11) NOT NULL,
  `place_status` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_place`
--

INSERT INTO `tbl_place` (`place_id`, `place_name`, `district_id`, `place_status`) VALUES
(1, 'Valanchery', 1, 1),
(2, 'Vadakkanchery', 2, 1),
(3, 'Selam', 4, 1),
(4, 'Devanahalli', 6, 1),
(5, 'Kapulappada', 8, 1),
(6, 'Kottakkal', 1, 1),
(7, 'Amaravati', 10, 1),
(8, 'Kailasagiri', 8, 1),
(9, 'Araku Valley', 8, 1),
(10, 'Kondaveedu Fort', 10, 1),
(11, 'Kaviti', 9, 1),
(12, 'Ita Fort', 12, 1),
(13, 'Ganga Lake', 11, 1),
(14, 'Sela Pass', 11, 1),
(15, 'Madhuri Lake', 11, 1),
(16, 'Ziro Valley', 13, 1),
(17, 'Talley Valley', 13, 1),
(18, 'Kile Pakho', 13, 1),
(19, 'Guwahati', 14, 1),
(20, 'Kamakhya Temple', 14, 0),
(21, 'Umananda Island', 14, 1),
(22, 'Brahmaputra Riverfront', 15, 1),
(23, 'Dehing Patkai', 15, 1),
(24, 'Silchar', 16, 0),
(25, 'Maniharan Tunnel', 16, 1),
(26, 'Khaspur Ruins', 16, 1),
(27, 'Golghar', 17, 1),
(28, 'Gandhi Maidan', 17, 1),
(29, 'Mahabodhi Temple', 18, 1),
(30, 'Vishnupad Temple', 18, 1),
(31, 'Vivekananda Sarovar', 19, 1),
(32, 'Nandan Van Zoo', 19, 1),
(33, 'Tandula Dam', 20, 1),
(34, 'Mapusa Market', 21, 1),
(35, 'Fort Aguada', 21, 1),
(36, 'Calangute Beach', 21, 1),
(37, 'Cabo de Rama Fort', 22, 1),
(38, 'Colva Beach', 22, 1),
(39, 'Bopal', 23, 1),
(40, 'Maninagar', 23, 1),
(41, 'Navrangpura', 23, 1),
(42, 'Alkapuri', 24, 1),
(43, 'Gotri', 24, 1),
(44, 'NIT', 29, 1),
(45, 'Ballabhgarh', 29, 1),
(46, 'Sushant Lok', 25, 1),
(47, 'Galliyon wali market', 25, 1),
(48, 'Dharamshala', 27, 1),
(49, 'Kangra town', 27, 1),
(50, 'Chhota Shimla', 28, 1),
(51, 'Lakkar Bazaar', 28, 1),
(52, 'Lalpur', 30, 1),
(53, 'Doranda', 30, 1),
(54, 'Sakchi', 31, 1),
(55, 'Bartand', 32, 1),
(56, 'Vijayanagar', 33, 1),
(57, 'Jayanagar', 6, 1),
(58, 'Indiranagar', 6, 1),
(59, 'Saraswathipuram', 33, 1),
(60, 'Tirur', 1, 1),
(61, 'Pattambi', 2, 1),
(62, 'Kochi', 34, 1),
(63, 'Muvattupuzha', 34, 1),
(64, 'MP Nagar', 35, 1),
(65, 'Arera Colony', 35, 1),
(66, 'Rajwada', 36, 1),
(67, 'Palasia', 36, 1),
(68, 'Dadar', 38, 1),
(69, 'Bandra', 38, 1),
(70, 'Hinjewadi', 37, 1),
(71, 'Kothrud', 37, 1),
(72, 'Sitabuldi', 39, 1),
(73, 'Tuibuong', 41, 1),
(74, 'Hiangtam Lamka', 41, 1),
(75, 'Kakching', 40, 1),
(76, 'Laitumkhrah', 43, 1),
(77, 'Nongrim', 43, 1),
(78, 'Araimile', 42, 1),
(79, 'Hawakhana', 42, 1),
(80, 'Dawrpui', 44, 1),
(81, 'Chanmari', 44, 1),
(82, 'Thingdawl', 45, 1),
(83, 'Diakkawn', 45, 1),
(84, 'Chumoukedima', 47, 1),
(85, 'Purana Bazaar', 47, 0),
(86, 'Phesama', 46, 1),
(87, 'Kumlong', 48, 1),
(88, 'Aongza', 48, 1),
(89, 'Mangalabag', 50, 1),
(90, 'Berhampur', 51, 1),
(91, 'Chatrapur', 49, 1),
(92, 'Hall Bazaar', 52, 1),
(93, 'Ranjit Avenue', 52, 1),
(94, 'Civil Lines', 53, 1),
(95, 'Model Town', 54, 1),
(96, 'Vaishali Nagar', 55, 1),
(97, 'Sardarpura', 56, 1),
(98, 'Surajpole', 57, 1),
(99, 'Tadong', 58, 1),
(100, 'Deorali', 58, 1),
(101, 'Darap', 59, 1),
(102, 'Peelamedu', 4, 1),
(103, 'Velachery', 5, 1),
(104, 'Anna Nagar', 5, 1),
(105, 'Goripalayam', 60, 1),
(106, 'Simmakkal', 60, 1),
(107, 'Kukatpally', 61, 1),
(108, 'Banjara Hills', 61, 1),
(109, 'Kazipet', 62, 1),
(110, 'Subhash Nagar', 63, 1),
(111, 'Hospital Chowmuhani', 63, 1),
(112, 'Kumarghat', 64, 1),
(113, 'Kailashahar', 64, 1),
(114, 'Alambagh', 65, 1),
(115, 'Kamla Nagar', 67, 1),
(116, 'Sadar Bazaar', 67, 1),
(117, 'Sigra', 66, 1),
(118, 'Jakhan', 68, 1),
(119, 'Rajpur Road', 68, 0),
(120, 'Ranipur', 70, 1),
(121, 'Ayarpatta', 69, 1),
(122, 'Lebong', 72, 1),
(123, 'Singamari', 72, 1),
(124, 'Belur', 73, 1),
(125, 'Bally', 73, 1),
(126, 'Salt Lake', 71, 1),
(127, 'Gariahat', 71, 1),
(128, 'Gandhi Nagar', 7, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_requirements`
--

CREATE TABLE `tbl_requirements` (
  `requirements_id` int(11) NOT NULL,
  `salooncategory_id` int(11) NOT NULL,
  `booking_id` int(11) NOT NULL,
  `slot_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_requirements`
--

INSERT INTO `tbl_requirements` (`requirements_id`, `salooncategory_id`, `booking_id`, `slot_id`) VALUES
(18, 1, 9, 5),
(19, 29, 10, 6),
(20, 37, 11, 6),
(21, 5, 12, 8),
(22, 9, 13, 8),
(23, 24, 10, 6),
(24, 1, 13, 15),
(25, 15, 14, 15),
(26, 32, 14, 9),
(27, 7, 15, 8),
(28, 40, 15, 16),
(29, 51, 15, 7),
(30, 29, 16, 16),
(31, 11, 17, 9),
(33, 10, 18, 16),
(34, 30, 19, 6),
(35, 27, 20, 6),
(36, 21, 21, 15),
(40, 29, 22, 32),
(41, 18, 23, 31),
(42, 1, 24, 43);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_review`
--

CREATE TABLE `tbl_review` (
  `review_id` int(11) NOT NULL,
  `review_datetime` varchar(100) NOT NULL,
  `saloon_id` int(11) NOT NULL,
  `user_review` varchar(100) NOT NULL,
  `user_rating` varchar(100) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_review`
--

INSERT INTO `tbl_review` (`review_id`, `review_datetime`, `saloon_id`, `user_review`, `user_rating`, `user_id`) VALUES
(1, '2025-11-13 19:22:28', 1, 'Really like the service\n', '5', 1),
(2, '2025-11-14 17:43:11', 4, 'Awesome service.', '4', 1),
(3, '2025-11-14 20:41:34', 2, 'Nice ', '4', 3);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_saloon`
--

CREATE TABLE `tbl_saloon` (
  `saloon_id` int(11) NOT NULL,
  `saloon_name` varchar(30) NOT NULL,
  `saloon_email` varchar(100) NOT NULL,
  `saloon_contact` varchar(30) NOT NULL,
  `saloon_password` varchar(30) NOT NULL,
  `saloon_address` varchar(40) NOT NULL,
  `saloon_logo` varchar(100) NOT NULL,
  `saloon_proof` varchar(100) NOT NULL,
  `saloon_status` int(11) NOT NULL DEFAULT 0,
  `place_id` int(11) NOT NULL,
  `saloon_ownername` varchar(30) NOT NULL,
  `saloon_gstno` varchar(100) NOT NULL,
  `saloon_doj` date NOT NULL,
  `saloon_reason` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_saloon`
--

INSERT INTO `tbl_saloon` (`saloon_id`, `saloon_name`, `saloon_email`, `saloon_contact`, `saloon_password`, `saloon_address`, `saloon_logo`, `saloon_proof`, `saloon_status`, `place_id`, `saloon_ownername`, `saloon_gstno`, `saloon_doj`, `saloon_reason`) VALUES
(1, 'Serenity Spa', 'Serenity.spa25@gmail.com', '9876545678', 'Serenity@123', '456 Harmony Lane', 'serenity.jpg', 'seenity shopcertificate.jpg', 1, 1, 'Priya Sharma', '09684736XYZA', '2025-08-21', ''),
(2, 'Glamify', 'Glamify123@gmail.com', '7898765434', 'Glamify@123', '456 Street Lane Side', 'WhatsApp Image 2025-08-21 at 4.46.59 PM.jpeg', 'seenity shopcertificate.jpg', 1, 2, 'Rashin Abraham', '12345678ABCVF', '2025-08-21', ''),
(3, 'Adoff', 'Adoff123@gmail.com', '8787654567', 'Adoff@123', '99 Sunset Blvd', 'WhatsApp Image 2025-08-21 at 4.47.00 PM.jpeg', 'seenity shopcertificate.jpg', 1, 3, 'Krishnan ', '9857392719ANBS', '2025-08-21', ''),
(4, 'Kelly', 'Kelly123@gmail.com', '9898976789', 'Kelly@123', '45 Greenfield Road', 'WhatsApp Image 2025-08-21 at 5.00.21 PM.jpeg', 'seenity shopcertificate.jpg', 1, 5, 'Prasad Kuruvay', '478378739AKIN', '2025-08-21', 'cant verify id proofs\r\n'),
(5, 'The Velvet Comb', 'Velvet@gmail.com', '9567890987', 'Velvet@123', '45 Greenfield Road', 'WhatsApp Image 2025-08-21 at 5.00.21 PM.jpeg', 'seenity shopcertificate.jpg', 1, 1, 'Jery', '09684736XYZB', '2025-10-11', ''),
(6, 'The Classic Cur', 'Classic@gmail.com', '9567890997', 'Classic@123', 'Near School bridge', '3d8dfaf723b097c07a25b31a5a5ff52b.jpg', 'seenity shopcertificate.jpg', 1, 60, 'Joseph', '38684736XYZB', '2025-10-11', ''),
(7, 'Avenue Style House', 'Avenue@gmail.com', '9565890997', 'Avenue@123', ' 88 Oakshire Lane', '6607b63e845b7_thumb900.webp', 'seenity shopcertificate.jpg', 0, 6, 'Hasim', '38654736XYZB', '2025-10-11', ''),
(8, 'Blend', 'Blend@gmail.com', '9658906654', 'Blend@123', '211B Canvas Street', 'barber-classic-equipment-logo-design-260nw-2451095065.webp', 'seenity shopcertificate.jpg', 1, 61, 'Yizul', '38658736XYZB', '2025-10-11', ''),
(9, 'Aura Hair Lab', 'Aura Hair Lab@gmail.com', '9658934654', 'Aura@123', ' 4500 Willow Creek Parkway', 'WhatsApp Image 2025-08-21 at 4.47.00 PM.jpeg', 'seenity shopcertificate.jpg', 0, 2, 'Yasul', '38658736XYZB', '2025-10-11', ''),
(10, 'The Loft', 'Loft@gmail.com', '9958934654', 'The Loft@123', '456 Harmony Lane', '9c5945175992415.64bd7b4f87c36.jpg', 'seenity shopcertificate.jpg', 0, 61, 'Bikesh', '38658735XYZB', '2025-10-11', ''),
(11, 'Chroma Salon', 'Chroma@gmail.com', '7687986798', 'Chroma@123', '1245 Crestview Tower Plaza,', 'OIP (1).webp', 'seenity shopcertificate.jpg', 0, 62, 'Sahal', '48658735XYZB', '2025-10-11', ''),
(12, 'The Atelier', 'Atelier@gmail.com', '9987786543', 'The Atelier@123', 'Near Pleasantville Road', 'serenity.jpg', 'seenity shopcertificate.jpg', 0, 63, 'Krishnan ', '09684736XGZA', '2025-10-11', ''),
(13, 'Vision Hair Art', 'Vision@gmail.com', '9987686543', 'Vision@123', '4555 Street Lane Side,school villa', 'barber-classic-equipment-logo-design-260nw-2451095065.webp', 'seenity shopcertificate.jpg', 0, 62, 'Rahul', '59684736XGZA', '2025-10-11', ''),
(14, 'The Dye Lab', 'Dye@gmail.com', '9987680543', 'Dye@1234', 'Near jew street', 'WhatsApp Image 2025-08-21 at 4.46.59 PM.jpeg', 'seenity shopcertificate.jpg', 1, 63, 'Rajesh', '59984736XGZA', '2025-10-11', ''),
(15, 'Brushstroke Beauty', 'Brushstroke@gmail.com', '9987648054', 'Brushstroke@123', '3445 near ABC college', 'OIP (1).webp', 'seenity shopcertificate.jpg', 0, 7, 'Rejo', '09984736XGZA', '2025-10-11', ''),
(16, 'The Gentlemans Cut', 'Gentleman@gmail.com', '8987648054', 'Gentleman@123', '216 Street Lane Side', 'WhatsApp Image 2025-08-21 at 4.47.00 PM.jpeg', 'seenity shopcertificate.jpg', 2, 10, 'Thomas', '3984736XGZA', '2025-10-11', 'Application rejected due to missing business license and incomplete address details.'),
(17, 'The Grooming Room', 'Grooming@gmail.com', '8799998767', 'Grooming@123', 'Near 24 hotel,hospital road', '9c5945175992415.64bd7b4f87c36.jpg', 'seenity shopcertificate.jpg', 1, 11, 'Timo', '89767YTUIO', '2025-10-11', ''),
(18, 'Shear Class Barbershop', 'Shear@gmail.com', '8987876789', 'Shear@123', 'near Gaspery road', 'WhatsApp Image 2025-08-21 at 5.00.21 PM.jpeg', 'seenity shopcertificate.jpg', 1, 11, 'Thoby', 'NFGJJ768568', '2025-10-11', 'Baaaaaaadddddddddd'),
(19, 'The Noble Blade', 'Noble@gmail.com', '8878987898', 'Noble@123', 'near Thomas circle', 'OIP.webp', 'seenity shopcertificate.jpg', 1, 9, 'Hiresh', 'HGGF546789', '2025-10-11', 'bad service\r\n'),
(20, 'Anchor Square', 'Anchor@gmail.com', '8878987899', 'Anchor@123', '465 street jew line', '3d8dfaf723b097c07a25b31a5a5ff52b.jpg', 'seenity shopcertificate.jpg', 1, 8, 'Kumar', 'JLVKF456466', '2025-10-11', 'Bad services drye'),
(21, 'The Executive Trim', 'Executive@gmaill.com', '8878987878', 'Executive@123', 'near Kumarnager Stadium', 'barber-classic-equipment-logo-design-260nw-2451095065.webp', 'seenity shopcertificate.jpg', 0, 12, 'Haru', 'HKJFH257864', '2025-10-11', ''),
(22, 'Oak & Iron Barbers', 'Oak@gmail.com', '8096767557', 'Oak@1234', '456 Street Lane Side', '6607b63e845b7_thumb900.webp', 'seenity shopcertificate.jpg', 0, 13, 'Rashin Abraham', '38658736XYZB', '2025-10-11', ''),
(23, 'Precision Cuts', 'Precision@gmail.com', '7890695056', 'Precision@123', '45 Greenfield Road', 'depositphotos_120363808-stock-photo-vintage-barber-shop-logos-labels.jpg', 'seenity shopcertificate.jpg', 0, 15, 'Hamdan', '38658736XYZB', '2025-10-11', ''),
(24, 'The Mane Den', 'Mane@gmail.com', '8901837441', 'Mane@123', 'near Harmony Lane', 'OIP (1).webp', 'seenity shopcertificate.jpg', 0, 14, 'Jeny', '12345678ABCVF', '2025-10-11', ''),
(25, 'Fade & Co.', 'Fade@gmail.com', '9876543210', 'Fade@123', 'Near School bridge', 'WhatsApp Image 2025-08-21 at 4.47.00 PM.jpeg', 'seenity shopcertificate.jpg', 1, 18, 'Kishor', '38684736XYZB', '2025-10-11', ''),
(26, 'The Dapper Daisy', 'Dapper@gmail.com', '8096767554', 'Dapper@1123', '4500 Willow Creek Parkway', '1000_F_332466637_MJxumBhNHlCFVhNt6PJPxWPZoWDRdlpq.jpg', 'seenity shopcertificate.jpg', 1, 17, 'Izakeel', '12345678ABCVF', '2025-10-11', ''),
(27, ' Curl Up & Dye', 'curlup@gmail.com', '7654321098', 'Curlup@123', '5765 Royal street', 'barbershop-logo-poster-or-banner-design-concept-vector-33524492.webp', 'seenity shopcertificate.jpg', 0, 16, 'Joshi', ' 27ABCCD1234E1F2', '2025-10-11', ''),
(28, 'The Gilded Tress', 'gildedtress@gmail.com', '8798765670', 'Asdff@123', 'Swidney road 123', 'salon-logo-with-symbol-of-scissors-and-men-s-hair-on-a-white-background-illustration-vector.jpg', 'seenity shopcertificate.jpg', 0, 26, 'Rajesh Verma', '38684736XYZB', '2025-10-11', ''),
(29, 'The Victory Roll', 'Victory@gmail.com', '8978766578', 'Victory@123', 'Near western hotel', '1000_F_332466637_MJxumBhNHlCFVhNt6PJPxWPZoWDRdlpq.jpg', 'seenity shopcertificate.jpg', 0, 26, 'Sioh', '38684736XYZB', '2025-10-11', ''),
(30, 'Glamour Days', 'Glamour@gmail.com', '9988766789', 'Glamour@123', '986 Guardian street', 'depositphotos_120363808-stock-photo-vintage-barber-shop-logos-labels.jpg', 'seenity shopcertificate.jpg', 1, 25, 'Ashi', '09684736XYZA', '2025-10-11', ''),
(31, 'The Silver Scissor', 'Silver@gmail.com', '9567890997', 'Scissor@123', 'Near School bridge', '6607b63e845b7_thumb900.webp', 'seenity shopcertificate.jpg', 1, 22, 'Joseph', '38684736XYZB', '2025-10-11', ''),
(32, 'Pin-Up & Pomade', 'Pomade@gmail.com', '9567890997', 'Pin-Up@123', '45 Greenfield Road', 'OIP (1).webp', 'seenity shopcertificate.jpg', 0, 23, 'Sathish', '38684636XYZB', '2025-10-11', ''),
(33, 'The Gatsby Room', 'Gatsby@gmail.com', '9567890997', 'Gatsby@123', '986 Guardian street', 'barbershop-logo-poster-or-banner-design-concept-vector-33524492.webp', 'seenity shopcertificate.jpg', 0, 19, 'Saji', '38684636XYZB', '2025-10-11', ''),
(34, 'Soda Fountain Styles', 'Soda@gmail.com', '8096767554', 'Soda@123', '456 Harmony Lane', 'OIP.webp', 'seenity shopcertificate.jpg', 0, 21, 'Priya Sharma', '12345678ABCVF', '2025-10-11', ''),
(35, 'The Beehive', 'Beehive@gmail.com', '8096767554', 'Beehive123', '4876 Harmony Lane', 'salon-logo-with-symbol-of-scissors-and-men-s-hair-on-a-white-background-illustration-vector.jpg', 'seenity shopcertificate.jpg', 1, 29, 'Riya', '12345678ABCVF', '2025-10-11', ''),
(36, 'Velvet & Vinyl', 'Velvet@gmail.com', '9567890997', 'Vintyl213', 'Near School bridge', '9c5945175992415.64bd7b4f87c36.jpg', 'seenity shopcertificate.jpg', 1, 28, 'Sahil', '38684736XYZB', '2025-10-11', ''),
(37, 'The Twisted Twig', 'Twisted@gmail.com', '9567890997', 'Twisted243', '986 Guardian street', 'salon-logo-with-symbol-of-scissors-and-men-s-hair-on-a-white-background-illustration-vector.jpg', 'seenity shopcertificate.jpg', 0, 27, 'Sohu', '12345678ABCVF', '2025-10-11', ''),
(38, 'The Enchanted Strand', 'Enchanted@gmail.com', '9567890997', 'Enchanted123', 'Near Church bridge', '9c5945175992415.64bd7b4f87c36.jpg', 'seenity shopcertificate.jpg', 0, 33, 'Martin', '38684736XYZB', '2025-10-11', ''),
(39, 'Fable & Mane', 'Fable@gmail.com', '8096767554', 'Fable@123', '4500 Willow Creek Parkway', 'OIP (1).webp', 'seenity shopcertificate.jpg', 1, 32, 'Arysa', '38658736XYZB', '2025-10-11', ''),
(40, 'The Pixie Cut', 'Pixie@gmail.com', '9876543210', 'Pixie@123', '77 Grand Avenue', '3d8dfaf723b097c07a25b31a5a5ff52b.jpg', 'seenity shopcertificate.jpg', 1, 31, 'Gerrard', '12345678ABCVF', '2025-10-11', ''),
(41, 'Alchemy Hair Co.', 'Alchemy@gmail.com', '9567890997', 'Alchemy@123', 'Near School bridge', '1000_F_332466637_MJxumBhNHlCFVhNt6PJPxWPZoWDRdlpq.jpg', 'seenity shopcertificate.jpg', 0, 36, 'Tomy', '38684736XYZB', '2025-10-11', ''),
(42, 'Spellbound Shears', 'Spellbound@gmail.com', '8096767554', 'Spellbound75', '456 Harmony Lane', 'barbershop-logo-poster-or-banner-design-concept-vector-33524492.webp', 'seenity shopcertificate.jpg', 0, 35, 'Arun', '38684636XYZB', '2025-10-11', ''),
(43, 'The Crystal Comb', 'Crystal@gmail.com', '9567890997', 'Crystal123', 'Catel town road,near sillow market', 'WhatsApp Image 2025-08-21 at 4.47.00 PM.jpeg', 'seenity shopcertificate.jpg', 0, 34, 'Fedri', '38684736XYZB', '2025-10-11', ''),
(44, 'Moonlight Tresses', 'Moonlight@gmail.com', '7685647680', 'Moonlight9876', 'Faisalbad town 456 line', 'barber-classic-equipment-logo-design-260nw-2451095065.webp', 'seenity shopcertificate.jpg', 1, 37, 'Toress', '12345678ABCVF', '2025-10-11', ''),
(45, 'The Fairy Knot Mother', 'Fairy@gmail.com', '7685646680', 'Fairy@1234 ', '45 Greenfield Road', 'WhatsApp Image 2025-08-21 at 4.46.59 PM.jpeg', 'seenity shopcertificate.jpg', 1, 38, 'Fernandez', '12345678ABCVF', '2025-10-11', ''),
(46, 'Mystic Mane', 'Mystic@gmail.com', '8096767554', 'Mystic@123', '986 Guardian street', 'OIP (1).webp', 'seenity shopcertificate.jpg', 0, 39, 'Asif', '12345678ABCVF', '2025-10-11', ''),
(47, 'Plume', 'Plume@gmail.com', '9567890997', 'Plume@123', '1245 Crestview Tower Plaza', '6607b63e845b7_thumb900.webp', 'seenity shopcertificate.jpg', 1, 40, 'Harii', '12345678ABCVF', '2025-10-11', ''),
(48, 'Sway', 'Sway@gmail.com', '9567890997', 'Sway@1234', 'Asif city,town block', 'serenity.jpg', 'seenity shopcertificate.jpg', 1, 41, 'Anil', '38684736XYZB', '2025-10-11', ''),
(49, 'Glint', 'Glint@gmail.com', '9878765430', 'Glint@123', 'near Greek villa', 'OIP (1).webp', 'seenity shopcertificate.jpg', 0, 42, 'Yash', '12345678ABCVF', '2025-10-11', ''),
(50, 'Tonic', 'Tonic@gmail.com', '8787878796', 'Tonic123', 'Abc Hotel side', '9c5945175992415.64bd7b4f87c36.jpg', 'seenity shopcertificate.jpg', 0, 43, 'Geruu', '38658736XYZB', '2025-10-11', ''),
(51, 'Crest', 'Crest@gmail.com', '9926477172', 'Glint123', 'Glint city', '1000_F_332466637_MJxumBhNHlCFVhNt6PJPxWPZoWDRdlpq.jpg', 'seenity shopcertificate.jpg', 0, 45, 'Faiz', '12345678ABCVF', '2025-10-11', ''),
(52, 'Flint', 'Flint@gmail.com', '8096767554', 'Flint123', 'Casol street', 'salon-logo-with-symbol-of-scissors-and-men-s-hair-on-a-white-background-illustration-vector.jpg', 'seenity shopcertificate.jpg', 1, 44, 'Tom', '09684736XYZA', '2025-10-11', ''),
(53, 'Grove', 'Grove@gmail.com', '9567890997', 'Grove123', 'Local maktet', 'OIP.webp', 'seenity shopcertificate.jpg', 0, 47, 'Tabhi', '38658736XYZB', '2025-10-11', ''),
(54, 'Thrice', 'Thrice@gmail.com', '9876543210', 'Thrice1324', 'Asm street', 'depositphotos_120363808-stock-photo-vintage-barber-shop-logos-labels.jpg', 'seenity shopcertificate.jpg', 1, 46, 'Rijo', '38658736XYZB', '2025-10-11', ''),
(55, 'Pulse', 'Pulse@gmail.com', '9876543210', 'Pulse123', '234 street', 'barbershop-logo-poster-or-banner-design-concept-vector-33524492.webp', 'seenity shopcertificate.jpg', 1, 48, 'Asi', '38658736XYZB', '2025-10-11', ''),
(56, 'Verve', 'Verve@gmail.com', '9876543210', 'Verve123', '456 street line', 'barbershop-logo-poster-or-banner-design-concept-vector-33524492.webp', 'seenity shopcertificate.jpg', 1, 49, 'Ali', '38658736XYZB', '2025-10-11', ''),
(57, 'Zest', 'Zest@gmail.com', '8096767554', 'Zest2666', '456 Harmony Lane', 'barber-classic-equipment-logo-design-260nw-2451095065.webp', 'seenity shopcertificate.jpg', 0, 50, 'Rashin Abraham', '38684636XYZB', '2025-10-12', ''),
(58, 'Glow', 'Glow@gmail.com', '8901837441', 'Glow1234', 'Asm street', '9c5945175992415.64bd7b4f87c36.jpg', 'seenity shopcertificate.jpg', 0, 51, 'Joseph', '09684736XYZA', '2025-10-12', ''),
(59, 'Swish', 'Swish@gmail.com', '8565890997', 'Swish123', '45 Greenfield Road', '9c5945175992415.64bd7b4f87c36.jpg', 'seenity shopcertificate.jpg', 1, 55, 'Ummer', '386546736XYZB', '2025-10-12', ''),
(60, 'Tusk', 'Tusk@gmail.com', '8564890997', 'Tusk@123', '986 Guardian street', '3d8dfaf723b097c07a25b31a5a5ff52b.jpg', 'seenity shopcertificate.jpg', 1, 54, 'Tal', '3865467367YZB', '2025-10-12', ''),
(61, 'Daze', 'Daze@gmail.com', '9564890997', 'Daze1234', '45 Greenfield Road', 'salon-logo-with-symbol-of-scissors-and-men-s-hair-on-a-white-background-illustration-vector.jpg', 'seenity shopcertificate.jpg', 0, 53, 'Talib', '13865467367YZB', '2025-10-12', ''),
(62, 'Luxe', 'Luxe@gmail.com', '8564890997', 'Luxe1234', ' 88 Oakshire Lane', 'barber-classic-equipment-logo-design-260nw-2451095065.webp', 'seenity shopcertificate.jpg', 0, 52, 'Qadir', '13865467367YZB', '2025-10-12', ''),
(63, 'Pure', 'Pure@gmail.com', '9564890997', 'Pure1234', '456 Yamin alam market', 'barbershop-logo-poster-or-banner-design-concept-vector-33524492.webp', 'seenity shopcertificate.jpg', 0, 4, 'Alas', '13865467367YZB', '2025-10-12', ''),
(64, 'Beam', 'Beam@gmail.com', '9565890997', 'Beam1234', '456 Harmony Lane', '1000_F_332466637_MJxumBhNHlCFVhNt6PJPxWPZoWDRdlpq.jpg', 'seenity shopcertificate.jpg', 0, 128, 'Masim', '38654736XYZB', '2025-10-12', ''),
(65, 'Apex', 'Apex@gmail.com', '8565890997', 'Apex@123', '456 Yamin alam market', 'barbershop-logo-poster-or-banner-design-concept-vector-33524492.webp', 'seenity shopcertificate.jpg', 0, 58, 'Martin', '38654736XYZB', '2025-10-12', ''),
(66, 'Niche', 'Niche@gmail.com', '7565890997', 'Niche123', ' 88 Oakshire Lane', 'salon-logo-with-symbol-of-scissors-and-men-s-hair-on-a-white-background-illustration-vector.jpg', 'seenity shopcertificate.jpg', 0, 57, 'Tom', '38654736XYZB', '2025-10-12', ''),
(67, 'Sol', 'Sol@gmail.com', '9567890997', 'Sol@1234', '45 Greenfield Road', 'depositphotos_120363808-stock-photo-vintage-barber-shop-logos-labels.jpg', 'seenity shopcertificate.jpg', 1, 59, 'Peter', '38684736XYZB', '2025-10-12', ''),
(68, 'Rove', 'Rove@gmail.com', '8565890997', 'Rove@123', ' 88 Oakshire Lane', 'barber-classic-equipment-logo-design-260nw-2451095065.webp', 'seenity shopcertificate.jpg', 1, 56, 'Luis', '38654736XYZB', '2025-10-12', ''),
(69, 'Halo', 'Halo@gmail.com', '8565890997', 'Halo1234', ' 88 Oakshire Lane', '9c5945175992415.64bd7b4f87c36.jpg', 'seenity shopcertificate.jpg', 0, 65, 'Amanda', '38654736XYZB', '2025-10-12', ''),
(70, 'Muse', 'Muse@gmail.com', '9565890997', 'Muse1234', 'Asm street', 'OIP.webp', 'seenity shopcertificate.jpg', 0, 64, 'Alisson', '38654736XYZB', '2025-10-12', ''),
(71, 'Sage', 'Sage@gmail.com', '8096767554', 'Sage@123', '456 Yamin alam market', 'OIP (1).webp', 'seenity shopcertificate.jpg', 1, 67, 'Wahid', '12345678ABCVF', '2025-10-12', ''),
(72, 'Vow', 'Vow@gmail.com', '9565890997', 'Vow@1234', ' 88 Oakshire Lane', 'barber-classic-equipment-logo-design-260nw-2451095065.webp', 'seenity shopcertificate.jpg', 1, 66, 'Kumar', '38654736XYZB', '2025-10-12', ''),
(73, 'Rush', 'Rush@gmail.com', '8565890997', 'Rush@123', ' 88 Oakshire Lane', 'depositphotos_120363808-stock-photo-vintage-barber-shop-logos-labels.jpg', 'seenity shopcertificate.jpg', 0, 69, 'Adhithyan', '38654736XYZB', '2025-10-12', ''),
(74, 'Cove', 'Cove@gmaill.com', '8565890997', 'Cove@123', '456 Harmony Lane', 'OIP (1).webp', '6607b63e845b7_thumb900.webp', 1, 68, 'Ashly', '38654736XYZB', '2025-10-12', ''),
(75, 'Flux', 'Flux@gmail.com', '8565800997', 'Flux@123', '456 Street Lane Side', 'OIP (1).webp', 'seenity shopcertificate.jpg', 1, 72, 'Shalom', '38654736XYZB', '2025-10-12', ''),
(76, 'Arrow', 'Arrow@gmail.com', '8987603245', 'Arrow123', 'Athif aslam corner,876 street', '9c5945175992415.64bd7b4f87c36.jpg', 'seenity shopcertificate.jpg', 0, 70, 'Terry', '52345678ABCVF', '2025-10-12', ''),
(77, 'Canvas', 'Canvas@gmail.com', '8987603245', 'Canvas@123', '456 Yamin alam market', 'WhatsApp Image 2025-08-21 at 4.46.59 PM.jpeg', 'seenity shopcertificate.jpg', 0, 71, 'Otiss', '52345678ABCVF', '2025-10-12', ''),
(78, 'Echo', 'Echo@gmail.com', '7096767554', 'Echo@123', ' 88 Oakshire Lane', 'WhatsApp Image 2025-08-21 at 4.47.00 PM.jpeg', 'seenity shopcertificate.jpg', 0, 74, 'Yaseen', '38654736XYZB', '2025-10-12', ''),
(79, 'Fable', 'Fable@gmail.com', '9565890997', 'Fable123', 'tssm street', 'WhatsApp Image 2025-08-21 at 5.00.21 PM.jpeg', 'seenity shopcertificate.jpg', 1, 73, 'Huan', '38654736XYZB', '2025-10-12', ''),
(80, 'Haven', 'Haven@gmail.com', '9567890997', 'Haven123', '456 Harmony Lane', 'serenity.jpg', 'seenity shopcertificate.jpg', 1, 75, 'Fahim', '38654736XYZB', '2025-10-12', ''),
(81, 'Juno', 'Juno@gmail.com', '8565890997', 'Juno@123', '986 Guardian street', '6607b63e845b7_thumb900.webp', 'seenity shopcertificate.jpg', 0, 76, 'Sulaiman', '28654736XYZB', '2025-10-12', ''),
(82, 'Karma', 'Karma@gmail.com', '9965890997', 'Karma123', '45 Greenfield Road', 'WhatsApp Image 2025-08-21 at 4.47.00 PM.jpeg', 'seenity shopcertificate.jpg', 1, 77, 'Gambhir', '28654736XYZB', '2025-10-12', ''),
(83, 'Locus', 'Locus@gmail.com', '9898799878', 'Locus123', '986 Guardian street', 'serenity.jpg', 'seenity shopcertificate.jpg', 1, 78, 'Virendhar', '09684736XYZA', '2025-10-12', ''),
(84, 'Nexus', 'Nexus@gmail.com', '9878765432', 'Nexus123', '986 Guardian street', 'barbershop-logo-poster-or-banner-design-concept-vector-33524492.webp', 'seenity shopcertificate.jpg', 0, 79, 'Abu', '38654736XYZB', '2025-10-12', ''),
(85, 'Oasis', 'Oasis@gmail.om', '9090987865', 'Oasis@123', '77 Grand Avenue', 'OIP (1).webp', 'seenity shopcertificate.jpg', 1, 81, 'Shiinn', '12345678ABCVF', '2025-10-12', ''),
(86, 'Pivot', 'Pivot@gmail.com', '8987678768', 'Pivot123', '456 Street Lane Side', 'WhatsApp Image 2025-08-21 at 4.47.00 PM.jpeg', 'seenity shopcertificate.jpg', 1, 80, 'Sului', '12345678ABCVF', '2025-10-12', ''),
(87, 'Quest', 'Quest@gmail.com', '9987778652', 'Quest123', '77 Grand Avenue', '9c5945175992415.64bd7b4f87c36.jpg', 'seenity shopcertificate.jpg', 0, 83, 'Watif', '32345678ABCVF', '2025-10-12', ''),
(88, 'Sonder', 'Sonder@gmail.com', '8987654350', 'Sonder123', '456 Yamin alam market', '1000_F_332466637_MJxumBhNHlCFVhNt6PJPxWPZoWDRdlpq.jpg', 'seenity shopcertificate.jpg', 0, 82, 'Sinmra', '62345678ABCVF', '2025-10-12', ''),
(89, 'Blink', 'Blink@gmail.com', '8987867890', 'Blink123', '986 Guardian street', '1000_F_332466637_MJxumBhNHlCFVhNt6PJPxWPZoWDRdlpq.jpg', 'seenity shopcertificate.jpg', 0, 84, 'Uvais', '58654736XYZB', '2025-10-12', ''),
(90, 'Grind', 'Grind@gmail.com', '9565890997', 'Grind123', ' 88 Oakshire Lane', 'OIP (1).webp', 'seenity shopcertificate.jpg', 1, 86, 'Taomi', '09654736XYZB', '2025-10-12', ''),
(91, 'Shard', 'Shard@gmail.com', '7876567876', 'Shard123', '456 Yamin alam market', '3d8dfaf723b097c07a25b31a5a5ff52b.jpg', 'seenity shopcertificate.jpg', 1, 88, 'Tarim', '09654736XYZB', '2025-10-12', ''),
(92, 'Vex', 'Vex@gmail.com', '8096767554', 'Vex@1234', '211B Canvas Street', '9c5945175992415.64bd7b4f87c36.jpg', 'seenity shopcertificate.jpg', 0, 87, 'Lin shan', '38684636XYZB', '2025-10-12', ''),
(93, 'Weld', 'Weld@gmail.com', '6096767554', 'Weld1233', '211B Canvas Street', 'serenity.jpg', 'seenity shopcertificate.jpg', 1, 89, 'Min shan', '88684636XYZB', '2025-10-12', ''),
(94, 'Noir', 'Noir@gmail.com', '9096767554', 'Noir1234', '456 Yamin alam market', 'barbershop-logo-poster-or-banner-design-concept-vector-33524492.webp', 'seenity shopcertificate.jpg', 0, 90, 'Shan', '88084636XYZB', '2025-10-12', ''),
(95, 'Bolt', 'Bolt@gmail.com', '9996767554', 'Bolt1234', '986 Guardian street\r\n', 'OIP (1).webp', 'seenity shopcertificate.jpg', 1, 91, 'Shanif', '78084636XYZB', '2025-10-12', ''),
(96, 'Cusp', 'Cusp@gmail.com', '7996767554', 'Cusp@123', '77 Grand Avenue', '9c5945175992415.64bd7b4f87c36.jpg', 'seenity shopcertificate.jpg', 0, 92, 'Liam', '78084636XYZB', '2025-10-12', ''),
(97, 'Dusk', 'Dusk@gmail.com', '9996767554', 'Dusk@123', 'Asm street', 'barbershop-logo-poster-or-banner-design-concept-vector-33524492.webp', 'seenity shopcertificate.jpg', 1, 93, 'Priam', '68084636XYZB', '2025-10-12', ''),
(98, 'Faze', 'Faze@gmail.com', '9565890997', 'Faze@1223', ' 88 Oakshire Lane', 'WhatsApp Image 2025-08-21 at 4.46.59 PM.jpeg', 'seenity shopcertificate.jpg', 1, 95, 'Deer singh', '38654736XYZB', '2025-10-12', ''),
(99, 'Glyph', 'Glyph@gmail.com', '6565890997', 'Glyph123', ' 88 Oakshire Lane,1443', 'depositphotos_120363808-stock-photo-vintage-barber-shop-logos-labels.jpg', 'seenity shopcertificate.jpg', 0, 94, 'Mann', '38654736XYZB', '2025-10-12', ''),
(100, 'Hinge', 'Hinge@gmail.com', '8096767554', 'Hinge123', 'Near jaidi hotel', 'serenity.jpg', 'seenity shopcertificate.jpg', 0, 96, 'Lal', '12345678ABCVFGGH', '2025-10-12', ''),
(101, 'Ionic', 'Ionic@gmail.com', '9365890997', 'Ionic1223', 'ABC street', 'WhatsApp Image 2025-08-21 at 4.47.00 PM.jpeg', 'seenity shopcertificate.jpg', 1, 97, 'Jaisim', '386464736XYZB', '2025-10-12', ''),
(102, 'Jolt', 'Jolt@gmail.com', '8096767554', 'Jolt1234', 'Nerar sourav mangal corner', 'depositphotos_120363808-stock-photo-vintage-barber-shop-logos-labels.jpg', 'seenity shopcertificate.jpg', 1, 98, 'Abbas', '1897645678ABCVF', '2025-10-12', ''),
(103, 'Lush', 'Lush@gmail.com', '8896767554', 'Lush1234', '1245 Crestview Tower Plaza', '6607b63e845b7_thumb900.webp', 'seenity shopcertificate.jpg', 1, 100, 'Aloshy', '989536HFJVF', '2025-10-12', ''),
(104, 'Myth', 'Myth@gmail.com', '9565890997', 'Myth1234', 'Salt view,lake bridge', 'WhatsApp Image 2025-08-21 at 5.00.21 PM.jpeg', 'seenity shopcertificate.jpg', 1, 99, 'Kailesh', '6554736XYZB', '2025-10-12', ''),
(105, 'Quirk', 'Quirk@gmail.com', '9565590997', 'Quirk@123', '144 Springfield', 'OIP (1).webp', 'depositphotos_120363808-stock-photo-vintage-barber-shop-logos-labels.jpg', 0, 101, 'Annuv', 'GFSGFI6784568', '2025-10-12', ''),
(106, 'Raze', 'Raze@gmail.com', '8565890967', 'Raze@123', '77 Grand Avenue, Uptown, Uptown Heights,', '3d8dfaf723b097c07a25b31a5a5ff52b.jpg', 'seenity shopcertificate.jpg', 1, 104, 'Wasim', '45465789DGFHJ', '2025-10-12', ''),
(107, 'Sync', 'Sync@gmail.com', '9565890997', 'Sync1234', '3765 Harmont line,near vas market', 'WhatsApp Image 2025-08-21 at 4.47.00 PM.jpeg', 'seenity shopcertificate.jpg', 0, 103, 'Narayan das', '23456DFGHJ', '2025-10-12', ''),
(108, 'Aura', 'Aura@gmail.com', '9876543562', 'Aura1234', 'Coimbatore town,144 Street', 'serenity.jpg', 'seenity shopcertificate.jpg', 0, 102, 'Anik', '43567YTGGF', '2025-10-12', ''),
(109, 'Belle', 'Belle@gmail.com', '8975890997', 'Belle@123', '4500 Willow Creek Parkway', 'depositphotos_120363808-stock-photo-vintage-barber-shop-logos-labels.jpg', 'seenity shopcertificate.jpg', 0, 105, 'Ali', '67RDFGH45678', '2025-10-12', ''),
(110, 'Civile', 'Civile@gmail.com', '9875645687', 'Civile123', '211B Canvas Street', 'WhatsApp Image 2025-08-21 at 4.46.59 PM.jpeg', 'seenity shopcertificate.jpg', 0, 106, 'Aneesh', 'DF5688TYF', '2025-10-12', ''),
(111, 'Dreem', 'Dreem@gmail.com', '9876543210', 'Dreem@123', '211B Canvas Street', 'barber-classic-equipment-logo-design-260nw-2451095065.webp', 'seenity shopcertificate.jpg', 1, 108, 'Gerome', 'FGH6754TY89HG', '2025-10-12', ''),
(112, 'Ethos', 'Ethos@gmail.com', '7786987654', 'Ethos123', '456 Yamin alam market', '1000_F_332466637_MJxumBhNHlCFVhNt6PJPxWPZoWDRdlpq.jpg', 'seenity shopcertificate.jpg', 1, 107, 'Haily', '6578YUTGF', '2025-10-12', ''),
(113, 'Grace', 'Grace@gmail.com', '9876543987', 'Grace123', '986 Guardian street', 'OIP (1).webp', 'seenity shopcertificate.jpg', 0, 109, 'Jaison', '4567YGHYU7', '2025-10-12', ''),
(114, 'Hum', 'Hum@gmail.com', '9876789876', 'Hum@1234', '456 Street Lane Side', 'WhatsApp Image 2025-08-21 at 4.47.00 PM.jpeg', 'seenity shopcertificate.jpg', 1, 111, 'Sukumar', '6756YTHJO87I', '2025-10-12', ''),
(115, 'Ivory', 'Ivory@gmail.com', '7865434567', 'Ivory123', '45 Greenfield Road', '1000_F_332466637_MJxumBhNHlCFVhNt6PJPxWPZoWDRdlpq.jpg', 'seenity shopcertificate.jpg', 1, 110, 'Anujj', '8I76URTHG', '2025-10-12', ''),
(116, 'Jest', 'Jest@gmail.com', '9897865665', 'Jest@123', '456 Harmony Lane', 'salon-logo-with-symbol-of-scissors-and-men-s-hair-on-a-white-background-illustration-vector.jpg', 'seenity shopcertificate.jpg', 0, 113, 'Hasik', '567YUGHY7', '2025-10-12', ''),
(117, 'Lane', 'Lane@gmail.com', '9899768765', 'Lane@123', '211B Canvas Street', '9c5945175992415.64bd7b4f87c36.jpg', 'seenity shopcertificate.jpg', 0, 112, 'Ameeen', '56789IUY78TGG', '2025-10-12', ''),
(118, 'Merit', 'Merit@gmail.com', '9998886654', 'Merit123', '211B Canvas Street', '3d8dfaf723b097c07a25b31a5a5ff52b.jpg', 'seenity shopcertificate.jpg', 0, 115, 'Salmy', '6789IUYJHG', '2025-10-12', ''),
(119, 'Rime', 'Rime@gmail.com', '9876543450', 'Rime@123', '986 Guardian street', '6607b63e845b7_thumb900.webp', 'seenity shopcertificate.jpg', 0, 116, 'Gavi', 'GFHJ7U6Y5TRFGV', '2025-10-12', ''),
(120, 'Thyme', 'Thyme@gmaiil.com', '9876787654', 'Thyme123', 'Asm street', 'barber-classic-equipment-logo-design-260nw-2451095065.webp', 'seenity shopcertificate.jpg', 0, 114, 'Hasin Alam', '00987654TRFGHBN', '2025-10-12', ''),
(121, 'Blaze', 'Blaze@gmail.com', '7898767850', 'Blaze13332', '986 Guardian street', 'WhatsApp Image 2025-08-21 at 5.00.21 PM.jpeg', 'seenity shopcertificate.jpg', 0, 117, 'Qarasi', '4567UYHG', '2025-10-12', ''),
(122, 'Coda', 'Coda@gmail.com', '7896534560', 'Coda1234', '211B Canvas Street', 'barbershop-logo-poster-or-banner-design-concept-vector-33524492.webp', 'seenity shopcertificate.jpg', 1, 118, 'Anam', '464578IUYJHG', '2025-10-12', ''),
(123, 'Drip', 'Drip@gmail.com', '8787654563', 'Drip1234', '77 Grand Avenue', '9c5945175992415.64bd7b4f87c36.jpg', 'seenity shopcertificate.jpg', 1, 120, 'Bashi', '98876YUHJN', '2025-10-12', ''),
(124, 'Flick', 'Flick@gmail.com', '9876555445', 'Flick123', '986 Guardian street', '3d8dfaf723b097c07a25b31a5a5ff52b.jpg', 'seenity shopcertificate.jpg', 0, 121, 'Dinesh', '678IYUTHF67', '2025-10-12', ''),
(125, 'Grit', 'Grit@gmail.com', '8976555789', 'Grit1234', '456 Yamin alam market', '1000_F_332466637_MJxumBhNHlCFVhNt6PJPxWPZoWDRdlpq.jpg', 'seenity shopcertificate.jpg', 0, 122, 'Noonus', '567890IUYJGHF', '2025-10-12', ''),
(126, 'Hype', 'Hype@gmail.com', '8976546789', 'Hype1234', '986 Guardian street', 'WhatsApp Image 2025-08-21 at 4.47.00 PM.jpeg', 'seenity shopcertificate.jpg', 0, 123, 'Sanish', 'YUGUI876777GH', '2025-10-12', ''),
(127, 'Jive', 'Jive@gmail.com', '9087656789', 'Jive1324', '986 Guardian street', 'serenity.jpg', 'seenity shopcertificate.jpg', 1, 125, 'Rahim', '6970TT787G', '2025-10-12', ''),
(128, 'Kink', 'Kink@gmail.com', '8976545678', 'Kink4444', '456 Harmony Lane', 'OIP (1).webp', 'seenity shopcertificate.jpg', 1, 124, 'Hima', '456789URDFTY8', '2025-10-12', ''),
(129, 'Nimbus', 'Nimbus@gmail.com', '9876545678', 'Nimbus@123', '456 Street Lane Side', 'barber-classic-equipment-logo-design-260nw-2451095065.webp', 'seenity shopcertificate.jpg', 0, 127, 'Greeshma', '5678UYGFCC', '2025-10-12', ''),
(130, 'Rift', 'Rift@gmail.com', '9876545678', 'Rift1234', '211B Canvas Street', '1000_F_332466637_MJxumBhNHlCFVhNt6PJPxWPZoWDRdlpq.jpg', 'seenity shopcertificate.jpg', 0, 126, 'Fedrik', '456789UYGTF', '2025-10-12', '');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_salooncategory`
--

CREATE TABLE `tbl_salooncategory` (
  `salooncategory_id` int(11) NOT NULL,
  `salooncategory_amount` int(11) NOT NULL,
  `subcategory_id` int(11) NOT NULL,
  `saloon_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_salooncategory`
--

INSERT INTO `tbl_salooncategory` (`salooncategory_id`, `salooncategory_amount`, `subcategory_id`, `saloon_id`) VALUES
(1, 160, 1, 1),
(2, 350, 3, 1),
(3, 3500, 4, 1),
(4, 2500, 6, 1),
(5, 200, 1, 2),
(6, 100, 2, 2),
(7, 150, 7, 2),
(8, 2000, 8, 2),
(9, 100, 3, 2),
(10, 500, 4, 2),
(11, 300, 10, 2),
(12, 3000, 5, 2),
(13, 2000, 17, 2),
(14, 5000, 6, 2),
(15, 4000, 24, 2),
(16, 450, 18, 2),
(17, 500, 19, 2),
(18, 300, 14, 2),
(19, 2000, 15, 2),
(20, 200, 11, 2),
(21, 1500, 12, 2),
(22, 8000, 13, 2),
(23, 150, 1, 4),
(24, 100, 2, 4),
(25, 200, 7, 4),
(26, 2000, 8, 4),
(27, 200, 3, 4),
(28, 500, 9, 4),
(29, 2000, 17, 4),
(30, 200, 16, 4),
(31, 2000, 6, 4),
(32, 500, 20, 4),
(33, 2000, 24, 4),
(34, 100, 19, 4),
(35, 2000, 11, 4),
(36, 3000, 15, 4),
(37, 20000, 13, 4),
(38, 122, 1, 18),
(39, 269, 2, 18),
(40, 200, 4, 18),
(41, 123, 6, 18),
(42, 2000, 3, 18),
(43, 2469, 7, 18),
(44, 1200, 8, 18),
(45, 2000, 9, 18),
(46, 500, 10, 18),
(47, 2000, 5, 18),
(48, 20000, 16, 18),
(49, 3999, 17, 18),
(50, 299, 20, 18),
(51, 2000, 19, 18),
(52, 1239, 14, 18),
(53, 12999, 13, 18),
(54, 200, 17, 1),
(55, 2000, 18, 1),
(56, 200, 1, 5),
(57, 20000, 23, 5),
(58, 3000, 7, 5),
(59, 2000, 9, 5),
(60, 2000, 19, 5),
(61, 120, 1, 6),
(62, 200, 2, 6),
(63, 600, 7, 6),
(64, 8000, 5, 6),
(65, 4000, 17, 6),
(66, 300, 11, 6),
(67, 500, 14, 6),
(68, 150, 1, 8),
(69, 360, 7, 8),
(70, 180, 3, 8),
(71, 200, 4, 8),
(72, 9000, 13, 8),
(73, 180, 1, 14),
(74, 1000, 8, 14),
(75, 300, 2, 14),
(76, 350, 4, 14),
(77, 3000, 6, 14),
(78, 5000, 24, 14),
(79, 800, 18, 14),
(80, 700, 19, 14),
(81, 8000, 15, 14),
(82, 300, 14, 14);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_slot`
--

CREATE TABLE `tbl_slot` (
  `slot_id` int(11) NOT NULL,
  `slot_from` varchar(40) NOT NULL,
  `slot_to` varchar(40) NOT NULL,
  `saloon_id` int(11) NOT NULL,
  `slot_status` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_slot`
--

INSERT INTO `tbl_slot` (`slot_id`, `slot_from`, `slot_to`, `saloon_id`, `slot_status`) VALUES
(5, '09:00', '10:00', 4, 1),
(6, '10:00', '11:00', 4, 1),
(7, '11:00', '12:00', 4, 1),
(8, '12:00', '01:00', 4, 1),
(9, '01:00', '02:00', 4, 1),
(10, '02:00', '03:00', 4, 1),
(11, '03:00', '04:00', 4, 1),
(12, '04:00', '05:00', 4, 1),
(13, '05:00', '06:00', 4, 1),
(14, '10:00', '11:00', 18, 1),
(15, '11:00', '12:00', 18, 1),
(16, '12:00', '01:00', 18, 1),
(17, '02:00', '03:00', 18, 1),
(18, '03:00', '04:00', 18, 1),
(19, '04:00', '05:00', 18, 1),
(20, '10:00', '11:00', 1, 1),
(21, '11:00', '12:00', 1, 1),
(22, '02:00', '03:00', 1, 1),
(23, '04:00', '05:00', 1, 1),
(24, '06:00', '07:00', 1, 1),
(25, '07:00', '08:00', 1, 1),
(26, '09:00', '10:00', 1, 1),
(27, '12:00', '01:00', 2, 1),
(28, '01:00', '02:00', 2, 1),
(29, '02:00', '03:00', 2, 1),
(30, '03:00', '04:00', 2, 1),
(31, '07:00', '08:00', 5, 1),
(32, '08:00', '09:00', 5, 1),
(33, '09:00', '10:00', 5, 1),
(34, '10:00', '11:00', 5, 1),
(35, '12:00', '01:00', 5, 1),
(36, '09:00', '10:00', 6, 1),
(37, '10:00', '11:00', 6, 1),
(38, '11:00', '12:00', 6, 1),
(39, '12:00', '13:00', 6, 1),
(40, '13:00', '14:00', 6, 1),
(41, '14:00', '15:00', 6, 1),
(42, '15:00', '16:00', 6, 1),
(43, '16:00', '17:00', 6, 1),
(44, '10:00', '11:00', 8, 1),
(45, '11:00', '12:00', 8, 1),
(46, '12:00', '13:00', 8, 1),
(47, '13:00', '14:00', 8, 1),
(48, '14:00', '15:00', 8, 1),
(49, '15:00', '16:00', 8, 1),
(50, '16:00', '17:00', 8, 1),
(51, '17:00', '18:00', 8, 1),
(52, '18:00', '19:00', 8, 1),
(53, '09:00', '10:00', 14, 1),
(54, '10:00', '11:00', 14, 1),
(55, '11:00', '12:00', 14, 1),
(56, '12:00', '13:00', 14, 1),
(57, '13:00', '14:00', 14, 1),
(58, '15:00', '16:00', 14, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_state`
--

CREATE TABLE `tbl_state` (
  `state_id` int(11) NOT NULL,
  `state_name` varchar(40) NOT NULL,
  `state_status` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_state`
--

INSERT INTO `tbl_state` (`state_id`, `state_name`, `state_status`) VALUES
(1, 'KERALA', 1),
(2, 'TAMILNADU', 1),
(3, 'KARNATAKA', 1),
(4, 'ANDHRA PRADESH', 1),
(5, 'MAHARASHTRA', 1),
(6, 'GOA', 1),
(7, 'HARYANA', 1),
(8, 'ARUNACHAL PRADESH', 1),
(9, 'ASSAM', 1),
(10, 'BIHAR', 1),
(11, 'CHHATTISGARH', 1),
(12, 'HIMACHAL PRADESH', 1),
(13, 'JHARKHAND', 1),
(14, 'MADHYA PRADESH', 1),
(15, 'MANIPUR', 1),
(16, 'MEGHALAYA', 1),
(17, 'MIZORAM', 1),
(18, 'NAGALAND', 1),
(19, 'ODISHA', 1),
(20, 'PUNJAB', 1),
(21, 'RAJASTHAN', 1),
(22, 'SIKKIM', 1),
(23, 'TELANGANA', 1),
(24, 'TRIPURA', 1),
(25, 'UTTAR PRADESH', 1),
(26, 'UTTARAKHAND', 1),
(27, 'WEST BENGAL', 1),
(28, 'GUJARAT', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_subadmin`
--

CREATE TABLE `tbl_subadmin` (
  `subadmin_id` int(11) NOT NULL,
  `subadmin_name` varchar(40) NOT NULL,
  `subadmin_email` varchar(40) NOT NULL,
  `subadmin_password` varchar(30) NOT NULL,
  `state_id` int(11) NOT NULL,
  `subadmin_status` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_subcategory`
--

CREATE TABLE `tbl_subcategory` (
  `subcat_id` int(11) NOT NULL,
  `subcat_name` varchar(40) NOT NULL,
  `category_id` int(11) NOT NULL,
  `subcategory_status` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_subcategory`
--

INSERT INTO `tbl_subcategory` (`subcat_id`, `subcat_name`, `category_id`, `subcategory_status`) VALUES
(1, 'Hair cutting & styling', 1, 1),
(2, 'Hair Color', 1, 1),
(3, 'Facials', 2, 1),
(4, 'De tan', 2, 1),
(5, 'Bridal makeup', 3, 1),
(6, 'Full body massage', 4, 1),
(7, 'Hair Treatments', 1, 1),
(8, 'Hair Extensions', 1, 1),
(9, 'Deep cleansing', 2, 1),
(10, 'Brightening Facial', 2, 1),
(11, 'Waxing', 6, 1),
(12, 'Classic Cuts & Shaves', 7, 1),
(13, 'Grooming', 7, 1),
(14, 'Threading', 6, 1),
(15, 'Laser Hair Removal', 6, 1),
(16, 'Express / Day Makeup', 3, 1),
(17, 'Wedding Shoot Makeup', 3, 1),
(18, 'Gel / Shellac Manicure', 5, 1),
(19, 'Nail Art & Design', 5, 1),
(20, 'Classic Pedicure', 3, 1),
(21, 'Classic Manicure', 5, 1),
(22, 'Gel / Shellac Pedicure', 5, 1),
(23, 'Spa/Massage Therapy', 4, 1),
(24, 'Full Body Scrub / Polish', 4, 1),
(25, 'Spa/Sports Massage', 4, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user`
--

CREATE TABLE `tbl_user` (
  `user_id` int(11) NOT NULL,
  `user_name` varchar(15) NOT NULL,
  `user_email` varchar(30) NOT NULL,
  `user_contact` varchar(30) NOT NULL,
  `user_password` varchar(30) NOT NULL,
  `user_photo` varchar(100) NOT NULL,
  `user_status` int(11) NOT NULL DEFAULT 0,
  `place_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_user`
--

INSERT INTO `tbl_user` (`user_id`, `user_name`, `user_email`, `user_contact`, `user_password`, `user_photo`, `user_status`, `place_id`) VALUES
(1, 'David', 'David@gmail.com', '9069583858', 'David@123', 'David  photo.webp', 0, 4),
(2, 'Salman', 'Salman123@gmail.com', '8908574837', 'Salman@123', 'OIP.webp', 0, 3),
(3, 'Eldho', 'Eldho123@gmail.com', '7980574839', 'Eldho@123', 'OIP.webp', 0, 5),
(4, 'Nihal', 'nihalvdy456@gmail.com', '9850493829', 'Nihal@123', 'OIP.webp', 0, 1),
(5, 'Koraa', 'Kora123@gmail.com', '6905394859', 'Kora123@', 'OIP.webp', 0, 1),
(7, 'Simon', 'Simon123@gmail.com', '9856483729', 'Simon@123', 'OIP.webp', 0, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `tbl_booking`
--
ALTER TABLE `tbl_booking`
  ADD PRIMARY KEY (`booking_id`);

--
-- Indexes for table `tbl_category`
--
ALTER TABLE `tbl_category`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `tbl_complaint`
--
ALTER TABLE `tbl_complaint`
  ADD PRIMARY KEY (`complaint_id`);

--
-- Indexes for table `tbl_district`
--
ALTER TABLE `tbl_district`
  ADD PRIMARY KEY (`district_id`);

--
-- Indexes for table `tbl_feedback`
--
ALTER TABLE `tbl_feedback`
  ADD PRIMARY KEY (`feedback_id`);

--
-- Indexes for table `tbl_leave`
--
ALTER TABLE `tbl_leave`
  ADD PRIMARY KEY (`leave_id`);

--
-- Indexes for table `tbl_livebooking`
--
ALTER TABLE `tbl_livebooking`
  ADD PRIMARY KEY (`livebooking_id`);

--
-- Indexes for table `tbl_liverequirements`
--
ALTER TABLE `tbl_liverequirements`
  ADD PRIMARY KEY (`liverequirements_id`);

--
-- Indexes for table `tbl_package`
--
ALTER TABLE `tbl_package`
  ADD PRIMARY KEY (`package_id`);

--
-- Indexes for table `tbl_packagebooking`
--
ALTER TABLE `tbl_packagebooking`
  ADD PRIMARY KEY (`packagebooking_id`);

--
-- Indexes for table `tbl_place`
--
ALTER TABLE `tbl_place`
  ADD PRIMARY KEY (`place_id`);

--
-- Indexes for table `tbl_requirements`
--
ALTER TABLE `tbl_requirements`
  ADD PRIMARY KEY (`requirements_id`);

--
-- Indexes for table `tbl_review`
--
ALTER TABLE `tbl_review`
  ADD PRIMARY KEY (`review_id`);

--
-- Indexes for table `tbl_saloon`
--
ALTER TABLE `tbl_saloon`
  ADD PRIMARY KEY (`saloon_id`);

--
-- Indexes for table `tbl_salooncategory`
--
ALTER TABLE `tbl_salooncategory`
  ADD PRIMARY KEY (`salooncategory_id`);

--
-- Indexes for table `tbl_slot`
--
ALTER TABLE `tbl_slot`
  ADD PRIMARY KEY (`slot_id`);

--
-- Indexes for table `tbl_state`
--
ALTER TABLE `tbl_state`
  ADD PRIMARY KEY (`state_id`);

--
-- Indexes for table `tbl_subadmin`
--
ALTER TABLE `tbl_subadmin`
  ADD PRIMARY KEY (`subadmin_id`);

--
-- Indexes for table `tbl_subcategory`
--
ALTER TABLE `tbl_subcategory`
  ADD PRIMARY KEY (`subcat_id`);

--
-- Indexes for table `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_booking`
--
ALTER TABLE `tbl_booking`
  MODIFY `booking_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `tbl_category`
--
ALTER TABLE `tbl_category`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tbl_complaint`
--
ALTER TABLE `tbl_complaint`
  MODIFY `complaint_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_district`
--
ALTER TABLE `tbl_district`
  MODIFY `district_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=74;

--
-- AUTO_INCREMENT for table `tbl_feedback`
--
ALTER TABLE `tbl_feedback`
  MODIFY `feedback_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_leave`
--
ALTER TABLE `tbl_leave`
  MODIFY `leave_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `tbl_livebooking`
--
ALTER TABLE `tbl_livebooking`
  MODIFY `livebooking_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `tbl_liverequirements`
--
ALTER TABLE `tbl_liverequirements`
  MODIFY `liverequirements_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `tbl_package`
--
ALTER TABLE `tbl_package`
  MODIFY `package_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `tbl_packagebooking`
--
ALTER TABLE `tbl_packagebooking`
  MODIFY `packagebooking_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `tbl_place`
--
ALTER TABLE `tbl_place`
  MODIFY `place_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=129;

--
-- AUTO_INCREMENT for table `tbl_requirements`
--
ALTER TABLE `tbl_requirements`
  MODIFY `requirements_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `tbl_review`
--
ALTER TABLE `tbl_review`
  MODIFY `review_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_saloon`
--
ALTER TABLE `tbl_saloon`
  MODIFY `saloon_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=132;

--
-- AUTO_INCREMENT for table `tbl_salooncategory`
--
ALTER TABLE `tbl_salooncategory`
  MODIFY `salooncategory_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=83;

--
-- AUTO_INCREMENT for table `tbl_slot`
--
ALTER TABLE `tbl_slot`
  MODIFY `slot_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT for table `tbl_state`
--
ALTER TABLE `tbl_state`
  MODIFY `state_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `tbl_subadmin`
--
ALTER TABLE `tbl_subadmin`
  MODIFY `subadmin_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_subcategory`
--
ALTER TABLE `tbl_subcategory`
  MODIFY `subcat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
