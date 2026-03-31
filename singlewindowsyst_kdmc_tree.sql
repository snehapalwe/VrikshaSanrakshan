-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 31, 2026 at 04:31 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `singlewindowsyst_kdmc_tree`
--

-- --------------------------------------------------------

--
-- Table structure for table `accept_reject`
--

CREATE TABLE `accept_reject` (
  `id` int(11) NOT NULL,
  `db_name` varchar(255) NOT NULL,
  `rec_id` int(11) NOT NULL,
  `status` varchar(255) NOT NULL,
  `remark` text NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `accept_reject2`
--

CREATE TABLE `accept_reject2` (
  `id` int(11) NOT NULL,
  `rec_id` int(11) NOT NULL,
  `action` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `remark` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp(),
  `db_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `upload_rejection_note` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `application_form`
--

CREATE TABLE `application_form` (
  `id` int(11) NOT NULL,
  `fy` varchar(255) NOT NULL,
  `count` int(11) NOT NULL,
  `applicant_name` varchar(255) NOT NULL,
  `location_of_tree` varchar(255) NOT NULL,
  `no_of_trees` int(11) NOT NULL,
  `cut_purpose` varchar(255) NOT NULL,
  `amount` varchar(255) NOT NULL,
  `extract_7_12` varchar(255) NOT NULL,
  `noc_of_property` varchar(255) NOT NULL,
  `tree_dimensions` varchar(255) NOT NULL,
  `tree_color_photo` varchar(255) NOT NULL,
  `reason_to_cut_tree` text NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp(),
  `user_id` int(11) NOT NULL,
  `details` varchar(255) NOT NULL,
  `name_of_person_present` varchar(255) NOT NULL,
  `photo_upload` varchar(255) NOT NULL,
  `application_type` varchar(255) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `upload` text NOT NULL,
  `city_survey_number` varchar(255) NOT NULL,
  `peth` varchar(255) NOT NULL,
  `advertisement_fees` varchar(255) NOT NULL,
  `flag_inspection` int(11) NOT NULL,
  `flag_payment` int(11) NOT NULL,
  `flag_order` int(11) NOT NULL,
  `flag_advertisement` int(11) NOT NULL,
  `status` float NOT NULL,
  `flag_objection` varchar(255) NOT NULL,
  `flag_final_decision` varchar(255) NOT NULL,
  `flag_reject` varchar(255) NOT NULL,
  `flag_accept` varchar(255) NOT NULL,
  `property_owner_name` varchar(255) NOT NULL,
  `approval_date` varchar(255) NOT NULL,
  `flag_ins_photo` int(11) NOT NULL,
  `applicant_address` varchar(255) NOT NULL,
  `upload_tipnni` varchar(255) NOT NULL,
  `upload_permission` varchar(255) NOT NULL,
  `demand_id` int(11) NOT NULL,
  `application_no` varchar(255) NOT NULL,
  `mobile_no` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `application_mapping`
--

CREATE TABLE `application_mapping` (
  `id` int(11) NOT NULL,
  `db_name` varchar(255) NOT NULL,
  `rec_id` varchar(255) NOT NULL,
  `appl_type` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `authorization_sequence`
--

CREATE TABLE `authorization_sequence` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `stage` int(11) NOT NULL,
  `db_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `can_reject` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `authorization_sequence`
--

INSERT INTO `authorization_sequence` (`id`, `user_id`, `stage`, `db_name`, `can_reject`) VALUES
(1, 97, 2, 'commencement_certificate', 'YES'),
(2, 98, 3, 'commencement_certificate', 'YES'),
(3, 99, 4, 'commencement_certificate', 'YES'),
(5, 41, 1, 'commencement_certificate', 'NO');

-- --------------------------------------------------------

--
-- Table structure for table `ccav_orders`
--

CREATE TABLE `ccav_orders` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `payment_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `cc_photo_inspection`
--

CREATE TABLE `cc_photo_inspection` (
  `id` int(11) NOT NULL,
  `rec_id` varchar(255) NOT NULL,
  `latitude` varchar(255) NOT NULL,
  `longitude` varchar(255) NOT NULL,
  `upload_photo_of_tree` varchar(255) NOT NULL,
  `photo` varchar(255) NOT NULL,
  `photo2` varchar(255) NOT NULL,
  `photo3` varchar(255) NOT NULL,
  `name_of_tree` varchar(255) NOT NULL,
  `inspection_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `tree_count` int(11) NOT NULL,
  `enter_name_of_tree` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `certificate_data`
--

CREATE TABLE `certificate_data` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `cert_data` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `commencement_certificate`
--

CREATE TABLE `commencement_certificate` (
  `id` int(11) NOT NULL,
  `cc_application_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `bpms_project_code` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `application_type` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `applicant_full_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `applicant_address` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `property_owner_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ward` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `address_of_plot` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `google_link` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `no_of_trees_if_available` int(11) DEFAULT NULL,
  `trees_added` int(11) NOT NULL,
  `architech_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `architect_address` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `architect_pin_code` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `architect_mobile_number` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `builder_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `builder_address` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `builder_pin_code` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `builder_mobile_number` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `plot_area_in_sq_mtr` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `phisical_colored_map_with_tree_located` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `architech_application` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `google_map_with_polygone` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `document_7_12_` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `flag` int(11) NOT NULL,
  `status` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `user_id` int(11) NOT NULL,
  `inspection_report_by_cg` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp(),
  `type_of_residence` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `tippni_upload` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `tippni_data` text COLLATE utf8_unicode_ci NOT NULL,
  `demand` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `cc_affidavit` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `permission_upload` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `paid_1` int(11) NOT NULL,
  `paid_2` int(11) NOT NULL,
  `amount` double(10,2) NOT NULL,
  `trees_to_be_planted` int(11) NOT NULL,
  `names_of_trees_be_planted` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `fy` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `count` int(11) NOT NULL,
  `application_no` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `mobile_no` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `latitude` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `longitude` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `current_tiimestamp` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_timestamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `mouje` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `survey_no` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `outward_no` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `commencement_certificate_deleted`
--

CREATE TABLE `commencement_certificate_deleted` (
  `id` int(11) NOT NULL,
  `cc_application_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `bpms_project_code` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `application_type` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `applicant_full_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `applicant_address` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `property_owner_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ward` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `address_of_plot` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `google_link` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `no_of_trees_if_available` int(11) DEFAULT NULL,
  `trees_added` int(11) NOT NULL,
  `architech_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `architect_address` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `architect_pin_code` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `architect_mobile_number` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `builder_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `builder_address` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `builder_pin_code` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `builder_mobile_number` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `plot_area_in_sq_mtr` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `phisical_colored_map_with_tree_located` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `architech_application` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `google_map_with_polygone` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `document_7_12_` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `flag` int(11) NOT NULL,
  `status` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `user_id` int(11) NOT NULL,
  `inspection_report_by_cg` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp(),
  `type_of_residence` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `tippni_upload` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `tippni_data` text COLLATE utf8_unicode_ci NOT NULL,
  `demand` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `cc_affidavit` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `permission_upload` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `paid_1` int(11) NOT NULL,
  `paid_2` int(11) NOT NULL,
  `amount` double(10,2) NOT NULL,
  `trees_to_be_planted` int(11) NOT NULL,
  `names_of_trees_be_planted` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `fy` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `count` int(11) NOT NULL,
  `application_no` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `mobile_no` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `latitude` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `longitude` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `current_tiimestamp` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_timestamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `mouje` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `survey_no` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `outward_no` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `demand`
--

CREATE TABLE `demand` (
  `id` int(11) NOT NULL,
  `rec_id` int(11) NOT NULL,
  `db_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `recieved_from` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `amount` int(11) NOT NULL,
  `payment_mode` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `purpose` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp(),
  `chq_no` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `chq_date` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `bank` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `final_decision`
--

CREATE TABLE `final_decision` (
  `id` int(11) NOT NULL,
  `final_decision` varchar(255) NOT NULL,
  `meeting_date` varchar(255) NOT NULL,
  `resolution_number` varchar(255) NOT NULL,
  `upload_meeting_resolution` varchar(255) NOT NULL,
  `remark` varchar(255) NOT NULL,
  `upload` varchar(255) NOT NULL,
  `rec_id` int(11) NOT NULL,
  `resolution_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `inspection`
--

CREATE TABLE `inspection` (
  `id` int(11) NOT NULL,
  `user_id` varchar(255) NOT NULL,
  `rec_id` varchar(255) NOT NULL,
  `report_upload` varchar(255) NOT NULL,
  `longitude` varchar(255) NOT NULL,
  `latitude` varchar(255) NOT NULL,
  `photo_of_tree` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `remark` text NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `label_names`
--

CREATE TABLE `label_names` (
  `id` int(11) NOT NULL,
  `db_name` varchar(255) NOT NULL,
  `field` varchar(255) NOT NULL,
  `label_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `label_names`
--

INSERT INTO `label_names` (`id`, `db_name`, `field`, `label_name`) VALUES
(1, 'accept_reject', 'id', 'ID '),
(2, 'accept_reject', 'db_name', 'DATABASE NAME '),
(3, 'accept_reject', 'rec_id', 'RECORD ID '),
(4, 'accept_reject', 'status', 'STATUS '),
(5, 'accept_reject', 'remark', 'REMARK '),
(6, 'accept_reject', 'timestamp', 'TIMESTAMP '),
(7, 'accept_reject2', 'id', 'ID '),
(8, 'accept_reject2', 'rec_id', 'RECORD ID '),
(9, 'accept_reject2', 'action', 'ACTION '),
(10, 'accept_reject2', 'remark', 'REMARK '),
(11, 'accept_reject2', 'timestamp', 'TIMESTAMP '),
(12, 'accept_reject2', 'db_name', 'DATABASE NAME '),
(13, 'accept_reject2', 'status', 'STATUS '),
(14, 'application_form', 'id', 'ID '),
(15, 'application_form', 'fy', 'FINANCIAL YEAR '),
(16, 'application_form', 'count', 'COUNT '),
(17, 'application_form', 'applicant_name', 'APPLICANT NAME '),
(18, 'application_form', 'location_of_tree', 'TREE LOCATION '),
(19, 'application_form', 'no_of_trees', 'NUMBER OF TREES '),
(20, 'application_form', 'cut_purpose', 'PURPOSE OF CUTTING '),
(21, 'application_form', 'amount', 'AMOUNT '),
(22, 'application_form', 'extract_7_12', 'EXTRACT 7-12 '),
(23, 'application_form', 'noc_of_property', 'NOC OF PROPERTY '),
(24, 'application_form', 'tree_dimensions', 'TREE DIMENSIONS '),
(25, 'application_form', 'tree_color_photo', 'TREE COLOR PHOTO '),
(26, 'application_form', 'reason_to_cut_tree', 'REASON TO CUT TREE '),
(27, 'application_form', 'timestamp', 'TIMESTAMP '),
(28, 'application_form', 'user_id', 'USER ID '),
(29, 'application_form', 'details', 'DETAILS '),
(30, 'application_form', 'name_of_person_present', 'NAME OF PERSON PRESENT '),
(31, 'application_form', 'photo_upload', 'PHOTO UPLOAD '),
(32, 'application_form', 'application_type', 'APPLICATION TYPE '),
(33, 'application_form', 'subject', 'SUBJECT '),
(34, 'application_form', 'upload', 'UPLOAD '),
(35, 'application_form', 'city_survey_number', 'CITY SURVEY NUMBER '),
(36, 'application_form', 'peth', 'PETH '),
(37, 'application_form', 'advertisement_fees', 'ADVERTISEMENT FEES '),
(38, 'application_form', 'flag_inspection', 'INSPECTION FLAG '),
(39, 'application_form', 'flag_payment', 'PAYMENT FLAG '),
(40, 'application_form', 'flag_order', 'ORDER FLAG '),
(41, 'application_form', 'flag_advertisement', 'ADVERTISEMENT FLAG '),
(42, 'application_form', 'status', 'STATUS '),
(43, 'application_form', 'flag_objection', 'OBJECTION FLAG '),
(44, 'application_form', 'flag_final_decision', 'FINAL DECISION FLAG '),
(45, 'application_form', 'flag_reject', 'REJECT FLAG '),
(46, 'application_form', 'flag_accept', 'ACCEPT FLAG '),
(47, 'application_form', 'property_owner_name', 'PROPERTY OWNER NAME '),
(48, 'application_form', 'approval_date', 'APPROVAL DATE '),
(49, 'application_form', 'flag_ins_photo', 'INSPECTION PHOTO FLAG '),
(50, 'application_form', 'applicant_address', 'APPLICANT ADDRESS '),
(51, 'application_form', 'upload_tipnni', 'UPLOAD TIPPANI '),
(52, 'application_form', 'upload_permission', 'UPLOAD PERMISSION '),
(53, 'application_form', 'demand_id', 'DEMAND ID '),
(54, 'application_form', 'application_no', 'APPLICATION NUMBER '),
(55, 'application_form', 'mobile_no', 'MOBILE NUMBER '),
(56, 'authorization_sequence', 'id', 'ID '),
(57, 'authorization_sequence', 'user_id', 'USER ID '),
(58, 'authorization_sequence', 'stage', 'STAGE '),
(59, 'authorization_sequence', 'db_name', 'DATABASE NAME '),
(60, 'authorization_sequence', 'can_reject', 'CAN REJECT '),
(61, 'ccav_orders', 'id', 'ID '),
(62, 'ccav_orders', 'order_id', 'ORDER ID '),
(63, 'ccav_orders', 'payment_id', 'PAYMENT ID '),
(64, 'cc_photo_inspection', 'id', 'ID '),
(65, 'cc_photo_inspection', 'rec_id', 'RECORD ID '),
(66, 'cc_photo_inspection', 'latitude', 'LATITUDE '),
(67, 'cc_photo_inspection', 'longitude', 'LONGITUDE '),
(68, 'cc_photo_inspection', 'upload_photo_of_tree', 'UPLOAD PHOTO OF TREE '),
(69, 'cc_photo_inspection', 'photo', 'PHOTO 1 '),
(70, 'cc_photo_inspection', 'photo2', 'PHOTO 2 '),
(71, 'cc_photo_inspection', 'photo3', 'PHOTO 3 '),
(72, 'cc_photo_inspection', 'name_of_tree', 'NAME OF TREE '),
(73, 'cc_photo_inspection', 'inspection_date', 'INSPECTION DATE '),
(74, 'certificate_data', 'id', 'ID '),
(75, 'certificate_data', 'name', 'NAME '),
(76, 'certificate_data', 'certificate_data', 'CERTIFICATE DATA '),
(77, 'commencement_certificate', 'id', 'ID '),
(78, 'commencement_certificate', 'cc_application_id', 'CC APPLICATION  '),
(79, 'commencement_certificate', 'application_type', 'APPLICATION TYPE '),
(80, 'commencement_certificate', 'applicant_full_name', 'APPLICANT FULL NAME '),
(81, 'commencement_certificate', 'applicant_address', 'APPLICANT ADDRESS '),
(82, 'commencement_certificate', 'property_owner_name', 'PROPERTY OWNER NAME '),
(83, 'commencement_certificate', 'ward', 'WARD '),
(84, 'commencement_certificate', 'address_of_plot', 'ADDRESS OF PLOT '),
(85, 'commencement_certificate', 'google_link', 'GOOGLE LINK '),
(86, 'commencement_certificate', 'no_of_trees_if_available', 'NO. OF TREES IF AVAILABLE '),
(87, 'commencement_certificate', 'trees_added', 'TREES ADDED '),
(88, 'commencement_certificate', 'architech_name', 'ARCHITECT NAME '),
(89, 'commencement_certificate', 'architect_address', 'ARCHITECT ADDRESS '),
(90, 'commencement_certificate', 'architect_pin_code', 'ARCHITECT PIN CODE '),
(91, 'commencement_certificate', 'architect_mobile_number', 'ARCHITECT MOBILE NUMBER '),
(92, 'commencement_certificate', 'builder_name', 'BUILDER NAME '),
(93, 'commencement_certificate', 'builder_address', 'BUILDER ADDRESS '),
(94, 'commencement_certificate', 'builder_pin_code', 'BUILDER PIN CODE '),
(95, 'commencement_certificate', 'builder_mobile_number', 'BUILDER MOBILE NUMBER '),
(96, 'commencement_certificate', 'plot_area_in_sq_mtr', 'PLOT AREA (SQ.M) '),
(97, 'commencement_certificate', 'phisical_colored_map_with_tree_located', 'PHYSICAL COLORED MAP WITH TREE LOCATED '),
(98, 'commencement_certificate', 'architech_application', 'ARCHITECT APPLICATION '),
(99, 'commencement_certificate', 'google_map_with_polygone', 'GOOGLE MAP WITH POLYGON '),
(100, 'commencement_certificate', 'document_7_12_', 'DOCUMENT 7-12 '),
(101, 'commencement_certificate', 'flag', 'FLAG '),
(102, 'commencement_certificate', 'status', 'STATUS '),
(103, 'commencement_certificate', 'user_id', 'USER ID '),
(104, 'commencement_certificate', 'inspection_report_by_cg', 'INSPECTION REPORT BY CG '),
(105, 'commencement_certificate', 'date', 'DATE '),
(106, 'commencement_certificate', 'type_of_residence', 'TYPE OF RESIDENCE '),
(107, 'commencement_certificate', 'tippni_upload', 'TIPPANI UPLOAD '),
(108, 'commencement_certificate', 'tippni_data', 'TIPPANI DATA '),
(109, 'commencement_certificate', 'demand', 'DEMAND '),
(110, 'commencement_certificate', 'cc_affidavit', 'CC AFFIDAVIT '),
(111, 'commencement_certificate', 'permission_upload', 'PERMISSION UPLOAD '),
(112, 'commencement_certificate', 'paid_1', 'PAID 1 '),
(113, 'commencement_certificate', 'paid_2', 'PAID 2 '),
(114, 'commencement_certificate', 'amount', 'AMOUNT '),
(115, 'commencement_certificate', 'trees_to_be_planted', 'TREES TO BE PLANTED '),
(116, 'commencement_certificate', 'names_of_trees_be_planted', 'NAMES OF TREES TO BE PLANTED '),
(117, 'commencement_certificate', 'fy', 'FINANCIAL YEAR '),
(118, 'commencement_certificate', 'count', 'COUNT '),
(119, 'commencement_certificate', 'application_no', 'APPLICATION NUMBER '),
(120, 'commencement_certificate', 'mobile_no', 'MOBILE NUMBER '),
(121, 'commencement_certificate', 'latitude', 'LATITUDE '),
(122, 'commencement_certificate', 'longitude', 'LONGITUDE '),
(123, 'demand', 'id', 'ID '),
(124, 'demand', 'rec_id', 'RECORD ID '),
(125, 'demand', 'db_name', 'DATABASE NAME '),
(126, 'demand', 'recieved_from', 'RECEIVED FROM '),
(127, 'demand', 'amount', 'AMOUNT '),
(128, 'demand', 'payment_mode', 'PAYMENT MODE '),
(129, 'demand', 'purpose', 'PURPOSE '),
(130, 'demand', 'timestamp', 'TIMESTAMP '),
(131, 'demand', 'chq_no', 'CHEQUE NUMBER '),
(132, 'demand', 'chq_date', 'CHEQUE DATE '),
(133, 'final_decision', 'id', 'ID '),
(134, 'final_decision', 'final_decision', 'FINAL DECISION '),
(135, 'final_decision', 'meeting_date', 'MEETING DATE '),
(136, 'final_decision', 'resolution_number', 'RESOLUTION NUMBER '),
(137, 'final_decision', 'upload_meeting_resolution', 'UPLOAD MEETING RESOLUTION '),
(138, 'final_decision', 'remark', 'REMARK '),
(139, 'final_decision', 'upload', 'UPLOAD '),
(140, 'final_decision', 'rec_id', 'RECORD ID '),
(141, 'final_decision', 'resolution_date', 'RESOLUTION DATE '),
(142, 'inspection', 'id', 'ID '),
(143, 'inspection', 'user_id', 'USER ID '),
(144, 'inspection', 'rec_id', 'RECORD ID '),
(145, 'inspection', 'report_upload', 'REPORT UPLOAD '),
(146, 'inspection', 'longitude', 'LONGITUDE '),
(147, 'inspection', 'latitude', 'LATITUDE '),
(148, 'inspection', 'photo_of_tree', 'PHOTO OF TREE '),
(149, 'inspection', 'date', 'DATE '),
(150, 'inspection', 'remark', 'REMARK '),
(151, 'inspection', 'timestamp', 'TIMESTAMP '),
(152, 'login_token', 'id', 'ID '),
(153, 'login_token', 'username', 'USERNAME '),
(154, 'login_token', 'time', 'TIME '),
(155, 'login_token', 'token', 'TOKEN '),
(156, 'master_for_name_of_news_paper', 'id', 'ID '),
(157, 'master_for_name_of_news_paper', 'Name_of_news_paper', 'NAME OF NEWS PAPER '),
(158, 'master_name_of_tree', 'id', 'ID '),
(159, 'master_name_of_tree', 'name_of_tree', 'NAME OF TREE '),
(160, 'master_residence', 'id', 'ID '),
(161, 'master_residence', 'residence_type_name', 'RESIDENCE TYPE NAME '),
(162, 'master_zone', 'id', 'ID '),
(163, 'master_zone', 'zone_name', 'ZONE NAME '),
(164, 'master_zone', 'peth', 'PETH '),
(165, 'name_designation_master', 'id', 'ID '),
(166, 'name_designation_master', 'name', 'NAME '),
(167, 'name_designation_master', 'designation', 'DESIGNATION '),
(168, 'objections', 'id', 'ID '),
(169, 'objections', 'rec_id', 'RECORD ID '),
(170, 'objections', 'name_of_applicant', 'NAME OF APPLICANT '),
(171, 'objections', 'mobile', 'MOBILE NUMBER '),
(172, 'objections', 'email', 'EMAIL '),
(173, 'objections', 'date_of_ad', 'DATE OF ADVERTISEMENT '),
(174, 'objections', 'name_of_news_paper', 'NAME OF NEWS PAPER '),
(175, 'objections', 'description', 'DESCRIPTION '),
(176, 'objections', 'upload_attachment', 'UPLOAD ATTACHMENT '),
(177, 'objections', 'flag_payment', 'PAYMENT FLAG '),
(178, 'objections', 'meeting_date', 'MEETING DATE '),
(179, 'objections', 'meeting_time', 'MEETING TIME '),
(180, 'objections', 'resolution', 'RESOLUTION '),
(181, 'objections', 'upload', 'UPLOAD '),
(182, 'objections', 'remark', 'REMARK '),
(183, 'objections', 'timestamp', 'TIMESTAMP '),
(184, 'objections', 'user_id', 'USER ID '),
(185, 'objections_hod_approval', 'id', 'ID '),
(186, 'objections_hod_approval', 'rec_id', 'RECORD ID '),
(187, 'objections_hod_approval', 'objection_id', 'OBJECTION ID '),
(188, 'objections_hod_approval', 'decision', 'DECISION '),
(189, 'objections_hod_approval', 'decision_upload', 'DECISION UPLOAD '),
(190, 'objections_hod_approval', 'remark', 'REMARK '),
(191, 'objections_hod_approval', 'status', 'STATUS '),
(192, 'objections_payments', 'id', 'ID '),
(193, 'objections_payments', 'amount', 'AMOUNT '),
(194, 'objections_payments', 'recieved_from', 'RECEIVED FROM '),
(195, 'objections_payments', 'payment_mode', 'PAYMENT MODE '),
(196, 'objections_payments', 'timestamp', 'TIMESTAMP '),
(197, 'occupancy_certificate', 'id', 'ID '),
(198, 'occupancy_certificate', 'fy', 'FINANCIAL YEAR '),
(199, 'occupancy_certificate', 'count', 'COUNT '),
(200, 'occupancy_certificate', 'oc_application_id', 'OC APPLICATION  '),
(201, 'occupancy_certificate', 'application_type', 'APPLICATION TYPE '),
(202, 'occupancy_certificate', 'applicant_full_name', 'APPLICANT FULL NAME '),
(203, 'occupancy_certificate', 'applicant_address', 'APPLICANT ADDRESS '),
(204, 'occupancy_certificate', 'property_owner_name', 'PROPERTY OWNER NAME '),
(205, 'occupancy_certificate', 'ward', 'WARD '),
(206, 'occupancy_certificate', 'address_of_plot', 'ADDRESS OF PLOT '),
(207, 'occupancy_certificate', 'google_link', 'GOOGLE LINK '),
(208, 'occupancy_certificate', 'no_of_trees_if_available', 'NO. OF TREES IF AVAILABLE '),
(209, 'occupancy_certificate', 'trees_added', 'TREES ADDED '),
(210, 'occupancy_certificate', 'architech_name', 'ARCHITECT NAME '),
(211, 'occupancy_certificate', 'architect_address', 'ARCHITECT ADDRESS '),
(212, 'occupancy_certificate', 'architect_pin_code', 'ARCHITECT PIN CODE '),
(213, 'occupancy_certificate', 'architect_mobile_number', 'ARCHITECT MOBILE NUMBER '),
(214, 'occupancy_certificate', 'builder_name', 'BUILDER NAME '),
(215, 'occupancy_certificate', 'builder_address', 'BUILDER ADDRESS '),
(216, 'occupancy_certificate', 'builder_pin_code', 'BUILDER PIN CODE '),
(217, 'occupancy_certificate', 'builder_mobile_number', 'BUILDER MOBILE NUMBER '),
(218, 'occupancy_certificate', 'plot_area_in_sq_mtr', 'PLOT AREA (SQ.M) '),
(219, 'occupancy_certificate', 'phisical_colored_map_with_tree_located', 'PHYSICAL COLORED MAP WITH TREE LOCATED '),
(220, 'occupancy_certificate', 'architech_application', 'ARCHITECT APPLICATION '),
(221, 'occupancy_certificate', 'google_map_with_polygone', 'GOOGLE MAP WITH POLYGON '),
(222, 'occupancy_certificate', 'document_7_12', 'DOCUMENT 7-12 '),
(223, 'occupancy_certificate', 'cc_number', 'CC NUMBER '),
(224, 'occupancy_certificate', 'building_area_oc_in_sq_mtr', 'BUILDING AREA (OC) IN SQ.M '),
(225, 'occupancy_certificate', 'tree_plantation_noc_old', 'TREE PLANTATION NOC OLD '),
(226, 'occupancy_certificate', 'town_planning_cc_copy_rdp_copy', 'TOWN PLANNING CC COPY '),
(227, 'occupancy_certificate', 'status', 'STATUS '),
(228, 'occupancy_certificate', 'user_id', 'USER ID '),
(229, 'occupancy_certificate', 'inspection_report_by_cg', 'INSPECTION REPORT BY CG '),
(230, 'occupancy_certificate', 'date', 'DATE '),
(231, 'occupancy_certificate', 'type_of_residence', 'TYPE OF RESIDENCE '),
(232, 'occupancy_certificate', 'tippni_upload', 'TIPPANI UPLOAD '),
(233, 'occupancy_certificate', 'tippni_data', 'TIPPANI DATA '),
(234, 'occupancy_certificate', 'demand', 'DEMAND '),
(235, 'occupancy_certificate', 'oc_affidavit', 'OC AFFIDAVIT '),
(236, 'occupancy_certificate', 'permission_upload', 'PERMISSION UPLOAD '),
(237, 'occupancy_certificate', 'application_number', 'APPLICATION NUMBER '),
(238, 'occupancy_certificate', 'application_date', 'APPLICATION DATE '),
(239, 'occupancy_certificate', 'town_planning_cc_date', 'TOWN PLANNING CC DATE '),
(240, 'occupancy_certificate', 'cc_not_taken_remark', 'CC NOT TAKEN REMARK '),
(241, 'occupancy_certificate', 'number_of_trees_to_be_planted', 'NUMBER OF TREES TO BE PLANTED '),
(242, 'occupancy_certificate', 'name_of_trees_to_be_planted', 'NAMES OF TREES TO BE PLANTED '),
(243, 'occupancy_certificate', 'building_address_details', 'BUILDING ADDRESS DETAILS '),
(244, 'occupancy_certificate', 'paid_1', 'PAID 1 '),
(245, 'occupancy_certificate', 'paid_2', 'PAID 2 '),
(246, 'occupancy_certificate', 'tippni', 'TIPPNI '),
(247, 'occupancy_certificate', 'cc_certificate_copy', 'CC CERTIFICATE COPY '),
(248, 'occupancy_certificate', 'amount', 'AMOUNT '),
(249, 'occupancy_certificate', 'application_no', 'APPLICATION NUMBER '),
(250, 'occupancy_certificate', 'mobile_no', 'MOBILE NUMBER '),
(251, 'occupancy_certificate', 'latitude', 'LATITUDE '),
(252, 'occupancy_certificate', 'longitude', 'LONGITUDE '),
(253, 'oc_photo_inspection', 'id', 'ID '),
(254, 'oc_photo_inspection', 'rec_id', 'RECORD ID '),
(255, 'oc_photo_inspection', 'latitude', 'LATITUDE '),
(256, 'oc_photo_inspection', 'longitude', 'LONGITUDE '),
(257, 'oc_photo_inspection', 'upload_photo_of_tree', 'UPLOAD PHOTO OF TREE '),
(258, 'oc_photo_inspection', 'name_of_tree', 'NAME OF TREE '),
(259, 'oc_photo_inspection', 'inspection_date', 'INSPECTION DATE '),
(260, 'oc_photo_inspection', 'photo', 'PHOTO '),
(261, 'oc_photo_inspection', 'photo2', 'PHOTO 2 '),
(262, 'oc_photo_inspection', 'photo3', 'PHOTO 3 '),
(263, 'orders', 'id', 'ID '),
(264, 'orders', 'rec_id', 'RECORD ID '),
(265, 'orders', 'order_date', 'ORDER DATE '),
(266, 'orders', 'upload_order', 'UPLOAD ORDER '),
(267, 'orders', 'timestamp', 'TIMESTAMP '),
(268, 'paper_notice', 'id', 'ID '),
(269, 'paper_notice', 'rec_id', 'RECORD ID '),
(270, 'paper_notice', 'upload_paper_cutting', 'UPLOAD PAPER CUTTING '),
(271, 'paper_notice', 'name_of_news_paper', 'NAME OF NEWS PAPER '),
(272, 'paper_notice', 'timestamp', 'TIMESTAMP '),
(273, 'paper_notice', 'advertisement_date', 'ADVERTISEMENT DATE '),
(274, 'payment2', 'id', 'ID '),
(275, 'payment2', 'rec_id', 'RECORD ID '),
(276, 'payment2', 'db_name', 'DATABASE NAME '),
(277, 'payment2', 'recieved_from', 'RECEIVED FROM '),
(278, 'payment2', 'amount', 'AMOUNT '),
(279, 'payment2', 'payment_mode', 'PAYMENT MODE '),
(280, 'payment2', 'purpose', 'PURPOSE '),
(281, 'payment2', 'timestamp', 'TIMESTAMP '),
(282, 'payments', 'id', 'ID '),
(283, 'payments', 'recieved_from', 'RECEIVED FROM '),
(284, 'payments', 'amount', 'AMOUNT '),
(285, 'payments', 'payment_mode', 'PAYMENT MODE '),
(286, 'payments', 'timestamp', 'TIMESTAMP '),
(287, 'payments', 'text', 'TEXT '),
(288, 'payments', 'rec_id', 'RECORD ID '),
(289, 'payments', 'purpose', 'PURPOSE '),
(290, 'payments', 'db_name', 'DATABASE NAME '),
(291, 'photo_of_inspection', 'id', 'ID '),
(292, 'photo_of_inspection', 'rec_id', 'RECORD ID '),
(293, 'photo_of_inspection', 'latitude', 'LATITUDE '),
(294, 'photo_of_inspection', 'longitude', 'LONGITUDE '),
(295, 'photo_of_inspection', 'upload_photo_of_tree', 'UPLOAD PHOTO OF TREE '),
(296, 'photo_of_inspection', 'width', 'WIDTH '),
(297, 'photo_of_inspection', 'height', 'HEIGHT '),
(298, 'photo_of_inspection', 'feet', 'FEET '),
(299, 'photo_of_inspection_refund', 'id', 'ID '),
(300, 'photo_of_inspection_refund', 'rec_id', 'RECORD ID '),
(301, 'photo_of_inspection_refund', 'latitude', 'LATITUDE '),
(302, 'photo_of_inspection_refund', 'longitude', 'LONGITUDE '),
(303, 'photo_of_inspection_refund', 'upload_photo_of_tree', 'UPLOAD PHOTO OF TREE '),
(304, 'photo_of_tree', 'id', 'ID '),
(305, 'photo_of_tree', 'rec_id', 'RECORD ID '),
(306, 'photo_of_tree', 'latitude', 'LATITUDE '),
(307, 'photo_of_tree', 'longitude', 'LONGITUDE '),
(308, 'photo_of_tree', 'upload_photo_of_tree', 'UPLOAD PHOTO OF TREE '),
(309, 'photo_of_tree', 'name_of_tree', 'NAME OF TREE '),
(310, 'refund', 'id', 'ID '),
(311, 'refund', 'date_of_permission', 'DATE OF PERMISSION '),
(312, 'refund', 'application_id', 'APPLICATION ID '),
(313, 'refund', 'no_of_tree_cut', 'NUMBER OF TREES CUT '),
(314, 'refund', 'no_of_tree_planted', 'NUMBER OF TREES PLANTED '),
(315, 'refund', 'upload_original_reciept', 'UPLOAD ORIGINAL RECEIPT '),
(316, 'refund', 'complete_address_of_plantation', 'COMPLETE ADDRESS OF PLANTATION '),
(317, 'refund', 'bank_name', 'BANK NAME '),
(318, 'refund', 'account_number', 'ACCOUNT NUMBER '),
(319, 'refund', 'ifsc_code', 'IFSC CODE '),
(320, 'refund', 'account_holder_name', 'ACCOUNT HOLDER NAME '),
(321, 'refund', 'timestamp', 'TIMESTAMP '),
(322, 'refund', 'status', 'STATUS '),
(323, 'refund', 'amount', 'AMOUNT '),
(324, 'refund', 'user_id', 'USER ID '),
(325, 'refund', 'flag_inspection', 'INSPECTION FLAG '),
(326, 'refund_inspection', 'id', 'ID '),
(327, 'refund_inspection', 'user_id', 'USER ID '),
(328, 'refund_inspection', 'rec_id', 'RECORD ID '),
(329, 'refund_inspection', 'report_upload', 'REPORT UPLOAD '),
(330, 'refund_inspection', 'longitude', 'LONGITUDE '),
(331, 'refund_inspection', 'latitude', 'LATITUDE '),
(332, 'refund_inspection', 'photo_of_tree', 'PHOTO OF TREE '),
(333, 'refund_inspection', 'date', 'DATE '),
(334, 'refund_inspection', 'remark', 'REMARK '),
(335, 'refund_inspection', 'timestamp', 'TIMESTAMP '),
(336, 'report_of_tree', 'id', 'ID '),
(337, 'report_of_tree', 'rec_id', 'RECORD ID '),
(338, 'report_of_tree', 'latitude', 'LATITUDE '),
(339, 'report_of_tree', 'longitude', 'LONGITUDE '),
(340, 'report_of_tree', 'upload_photo_of_plantation', 'UPLOAD PHOTO OF PLANTATION '),
(341, 'report_of_tree', 'upload_photo_of_tree_now', 'UPLOAD PHOTO OF TREE NOW '),
(342, 'roles', 'role_id', 'ROLE ID '),
(343, 'roles', 'role_name', 'ROLE NAME '),
(344, 'role_permissions', 'id', 'ID '),
(345, 'role_permissions', 'role_id', 'ROLE ID '),
(346, 'role_permissions', 'page_name', 'PAGE NAME '),
(347, 'role_permissions', 'action_name', 'ACTION NAME '),
(348, 'tippani_data', 'id', 'ID '),
(349, 'tippani_data', 'rec_id', 'RECORD ID '),
(350, 'tippani_data', 'db_name', 'DATABASE NAME '),
(351, 'tippani_data', 'application_number', 'APPLICATION NUMBER '),
(352, 'tippani_data', 'application_date', 'APPLICATION DATE '),
(353, 'tippani_data', 'town_planning_cc_date', 'TOWN PLANNING CC DATE '),
(354, 'tippani_data', 'cc_not_taken_remark', 'CC NOT TAKEN REMARK '),
(355, 'tippani_data', 'village_and_survey_number', 'VILLAGE AND SURVEY NUMBER '),
(356, 'tippani_data', 'number_of_trees_to_be_planted', 'NUMBER OF TREES TO BE PLANTED '),
(357, 'tippani_data', 'name_of_trees_to_be_planted', 'NAMES OF TREES TO BE PLANTED '),
(358, 'tippani_data', 'tippni_data', 'TIPPNI DATA '),
(359, 'tippani_data', 'building_address_details', 'BUILDING ADDRESS DETAILS '),
(360, 'tree_matrix_subentry', 'id', 'ID '),
(361, 'tree_matrix_subentry', 'rec_id', 'RECORD ID '),
(362, 'tree_matrix_subentry', 'photos', 'PHOTOS '),
(363, 'tree_matrix_subentry', 'remark', 'REMARK '),
(364, 'tree_matrix_subentry', 'timestamp', 'TIMESTAMP '),
(365, 'tree_report_matrix', 'id', 'ID '),
(366, 'tree_report_matrix', 'rec_id', 'RECORD ID '),
(367, 'tree_report_matrix', 'date', 'DATE '),
(368, 'tree_report_matrix', 'report', 'REPORT '),
(369, 'user_info', 'id', 'ID '),
(370, 'user_info', 'username', 'USERNAME '),
(371, 'user_info', 'password', 'PASSWORD '),
(372, 'user_info', 'email', 'EMAIL '),
(373, 'user_info', 'login_session_key', 'LOGIN SESSION KEY '),
(374, 'user_info', 'email_status', 'EMAIL STATUS '),
(375, 'user_info', 'password_expire_date', 'PASSWORD EXPIRY DATE '),
(376, 'user_info', 'password_reset_key', 'PASSWORD RESET KEY '),
(377, 'user_info', 'user_role_id', 'USER ROLE ID '),
(378, 'user_info', 'ward', 'WARD '),
(379, 'user_info', 'mobile_number', 'MOBILE NUMBER '),
(380, 'user_info', 'applicant_full_name', 'APPLICANT FULL NAME '),
(381, 'user_info', 'applicant_address', 'APPLICANT ADDRESS ');

-- --------------------------------------------------------

--
-- Table structure for table `login_token`
--

CREATE TABLE `login_token` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `time` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `token` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `master_for_name_of_news_paper`
--

CREATE TABLE `master_for_name_of_news_paper` (
  `id` int(11) NOT NULL,
  `Name_of_news_paper` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `master_for_name_of_news_paper`
--

INSERT INTO `master_for_name_of_news_paper` (`id`, `Name_of_news_paper`) VALUES
(1, 'दै. चौफेर संघर्ष '),
(2, 'दै. जागल्या '),
(3, 'दै. नरविर चिमजी '),
(4, 'दै. आमची मुंबई '),
(5, 'दै. परशुराम समाचार '),
(6, 'दै. सोशीतांचे समर्थन '),
(7, 'दै. मुंबई केसरी ');

-- --------------------------------------------------------

--
-- Table structure for table `master_name_of_tree`
--

CREATE TABLE `master_name_of_tree` (
  `id` int(11) NOT NULL,
  `name_of_tree` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `master_name_of_tree`
--

INSERT INTO `master_name_of_tree` (`id`, `name_of_tree`) VALUES
(1, 'Ain'),
(2, 'Akashneem'),
(3, 'Alu'),
(4, 'Amati'),
(5, 'Amba'),
(6, 'Anjeer'),
(7, 'Ankul'),
(8, 'Apta'),
(9, 'Areca Tree'),
(10, 'Arjun'),
(11, 'Asana'),
(12, 'Asupalav'),
(13, 'Athruna'),
(14, 'Avla'),
(15, 'Babool'),
(16, 'Bael Tree'),
(17, 'Bahava'),
(18, 'Bakneem'),
(19, 'Bakul'),
(20, 'Bartondi'),
(21, 'Bat Tree'),
(22, 'Behada'),
(23, 'Benjamin Tree'),
(24, 'Bhend'),
(25, 'Bhokar'),
(26, 'Bibba'),
(27, 'Bilimbi'),
(28, 'Bismarckia Palm'),
(29, 'Bitter wood'),
(30, 'Bivla'),
(31, 'Bondara '),
(32, 'Bor'),
(33, 'Bottle Brush'),
(34, 'Bottle Palm'),
(35, 'Butterfly Palm'),
(36, 'Buttonwood tree'),
(37, 'Calabash Tree'),
(38, 'Chanda'),
(39, 'Chandan'),
(40, 'Chapha'),
(41, 'Charcoal Tree'),
(42, 'Chenduphal'),
(43, 'Chiku'),
(44, 'Chinch'),
(45, 'Chinese Banyan Tree'),
(46, 'Chinese Fan Palm'),
(47, 'Chippi'),
(48, 'Christmas palm'),
(49, 'Christmas Tree'),
(50, 'Cluster Palm'),
(51, 'Dalchini'),
(52, 'Dandus'),
(53, 'Deshi Anjeer'),
(54, 'Deshi Badam'),
(55, 'Dhaman'),
(56, 'Dhatriphal'),
(57, 'Dhavda'),
(58, 'Dikmali'),
(59, 'Earleaf Acacia'),
(60, 'Fern pine'),
(61, 'Fern Tree'),
(62, 'Fiddle Leaf Fig'),
(63, 'Fishtail Palm'),
(64, 'Fox Tail Palm'),
(65, 'Garbel'),
(66, 'Ghela'),
(67, 'Giripushpa'),
(68, 'Golden Bottle Brush'),
(69, 'Grey Mangrove'),
(70, 'Guest Tree'),
(71, 'Gulmohar'),
(72, 'Haldu'),
(73, 'Hatga'),
(74, 'Humb'),
(75, 'Id Limbu'),
(76, 'Indian Rubber Tree'),
(77, 'Jam'),
(78, 'Jamba'),
(79, 'Jambhool'),
(80, 'Jangali Badam'),
(81, 'Kadamb'),
(82, 'Kadipatta'),
(83, 'Kaduneem'),
(84, 'Kailashpati'),
(85, 'Kaju'),
(86, 'Kakad'),
(87, 'Kala Kuda'),
(88, 'Kala Umber'),
(89, 'Kalam'),
(90, 'Kanak Champa'),
(91, 'Kanchan'),
(92, 'Kandel'),
(93, 'kandol'),
(94, 'Kanher'),
(95, 'Karamal'),
(96, 'Karambol'),
(97, 'Karanj'),
(98, 'Kashid'),
(99, 'Katesavar'),
(100, 'Kavath'),
(101, 'Kavti Chapha'),
(102, 'Khair'),
(103, 'Khajur'),
(104, 'Kharoti'),
(105, 'Khaya'),
(106, 'Khirni'),
(107, 'Kinhai'),
(108, 'Kokam'),
(109, 'Kuda'),
(110, 'Kumbhi'),
(111, 'Kumkum'),
(112, 'Kusum'),
(113, 'Lettuce Tree'),
(114, 'Limbu'),
(115, 'Lipstick Plam'),
(116, 'Litchi'),
(117, 'Lokhandi'),
(118, 'Madagascar almond'),
(119, 'Mahalunga'),
(120, 'Mahaneem'),
(121, 'Mahogani'),
(122, 'Manila palm'),
(123, 'Markhamia'),
(124, 'Medhshingi'),
(125, 'Menjim'),
(126, 'Moha '),
(127, 'Mosambi'),
(128, 'Naral'),
(129, 'Narikel'),
(130, 'Nilgiri'),
(131, 'Nirguni'),
(132, 'Nirphanas'),
(133, 'Pakhad'),
(134, 'Palas'),
(135, 'Pandhra Savar'),
(136, 'Pangara'),
(137, 'Papanas'),
(138, 'Parijatak'),
(139, 'Payar'),
(140, 'Peru'),
(141, 'Petari'),
(142, 'Phanas'),
(143, 'Pichkari'),
(144, 'Pimpal'),
(145, 'Pimpari'),
(146, 'Pink Shower'),
(147, 'Pink Tabebuia'),
(148, 'Pony Tail Palm'),
(149, 'Pritchardia Palm'),
(150, 'Putranjiva'),
(151, 'Pygmy Date Palm '),
(152, 'Rai Awla'),
(153, 'Rain Tree'),
(154, 'Rakt Chandan'),
(155, 'Ramphal'),
(156, 'Ratangunj'),
(157, 'Ritha'),
(158, 'Royal Palm'),
(159, 'Sag'),
(160, 'Samudraphal'),
(161, 'Santra'),
(162, 'Saptaparni'),
(163, 'Sausage Tree'),
(164, 'Scarlet Cordia'),
(165, 'Shemat'),
(166, 'Shendri'),
(167, 'Shevga'),
(168, 'Shirish'),
(169, 'Shisam'),
(170, 'Shivan'),
(171, 'Silver Oak'),
(172, 'Singapore Cherry'),
(173, 'Sita Ashok'),
(174, 'Sitaphal'),
(175, 'Sonchapha'),
(176, 'Sonmohar'),
(177, 'Star Apple'),
(178, 'Subabul'),
(179, 'Supari'),
(180, 'Suru'),
(181, 'Tad'),
(182, 'Tamal Patra'),
(183, 'Tambada Kuda'),
(184, 'Tambat'),
(185, 'Tamhan'),
(186, 'Tecoma'),
(187, 'Temburi'),
(188, 'Tendu'),
(189, 'Tetu'),
(190, 'The Lettuce Tree'),
(191, 'Tiwar'),
(192, 'Toothbrush Tree'),
(193, 'Travellar palm'),
(194, 'Triangular Palm'),
(195, 'Tuti'),
(196, 'Umber'),
(197, 'Umbrella Tree'),
(198, 'Undi'),
(199, 'Vad'),
(200, 'Vaivarna'),
(201, 'Varas'),
(202, 'Varun'),
(203, 'Vavla'),
(204, 'Villayati Babul'),
(205, 'Villayati Chinch'),
(206, 'Yellow Tabebuia'),
(207, 'Ashok'),
(208, 'Chafa'),
(209, 'Other');

-- --------------------------------------------------------

--
-- Table structure for table `master_residence`
--

CREATE TABLE `master_residence` (
  `id` int(11) NOT NULL,
  `residence_type_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `master_residence`
--

INSERT INTO `master_residence` (`id`, `residence_type_name`) VALUES
(1, 'Residential'),
(2, 'Commercial'),
(3, 'Industrial'),
(4, 'Mixed'),
(5, 'Educational'),
(6, 'Group Housing'),
(7, 'Institutuional'),
(13, 'Recreational Structu');

-- --------------------------------------------------------

--
-- Table structure for table `master_zone`
--

CREATE TABLE `master_zone` (
  `id` int(11) NOT NULL,
  `zone_name` varchar(255) NOT NULL,
  `peth` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `master_zone`
--

INSERT INTO `master_zone` (`id`, `zone_name`, `peth`) VALUES
(1, 'A', 'A'),
(2, 'B', 'B'),
(10, 'C', 'C'),
(11, 'D', 'D'),
(12, 'E', 'E'),
(13, 'F', 'F'),
(14, 'G', 'G'),
(15, 'H', 'H'),
(16, 'I', 'I'),
(17, 'J', 'J');

-- --------------------------------------------------------

--
-- Table structure for table `name_designation_master`
--

CREATE TABLE `name_designation_master` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `designation` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `name_designation_master`
--

INSERT INTO `name_designation_master` (`id`, `name`, `designation`) VALUES
(1, 'XYZ (dEP)', ''),
(2, 'XYZ2 (dEP)', ''),
(3, 'XYZ3 (dEP)', ''),
(4, 'xxx', 'Panch');

-- --------------------------------------------------------

--
-- Table structure for table `objections`
--

CREATE TABLE `objections` (
  `id` int(11) NOT NULL,
  `rec_id` int(11) NOT NULL,
  `name_of_applicant` varchar(255) NOT NULL,
  `mobile` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `date_of_ad` date NOT NULL,
  `name_of_news_paper` varchar(255) NOT NULL,
  `description` longtext NOT NULL,
  `upload_attachment` varchar(255) NOT NULL,
  `flag_payment` int(11) NOT NULL,
  `meeting_date` date NOT NULL,
  `meeting_time` varchar(255) NOT NULL,
  `resolution` varchar(255) NOT NULL,
  `upload` varchar(255) NOT NULL,
  `remark` varchar(255) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp(),
  `user_id` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `objections_hod_approval`
--

CREATE TABLE `objections_hod_approval` (
  `id` int(11) NOT NULL,
  `rec_id` varchar(255) NOT NULL,
  `objection_id` varchar(255) NOT NULL,
  `decision` varchar(255) NOT NULL,
  `decision_upload` varchar(255) NOT NULL,
  `remark` varchar(255) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `objections_payments`
--

CREATE TABLE `objections_payments` (
  `id` int(11) NOT NULL,
  `amount` int(11) NOT NULL,
  `recieved_from` varchar(255) NOT NULL,
  `payment_mode` varchar(255) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `occupancy_certificate`
--

CREATE TABLE `occupancy_certificate` (
  `id` int(11) NOT NULL,
  `fy` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `count` int(11) NOT NULL,
  `oc_application_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `bpms_project_code` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `application_type` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `applicant_full_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `applicant_address` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `property_owner_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ward` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `address_of_plot` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `google_link` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `no_of_trees_if_available` int(11) DEFAULT NULL,
  `trees_added` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `architech_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `architect_address` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `architect_pin_code` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `architect_mobile_number` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `builder_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `builder_address` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `builder_pin_code` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `builder_mobile_number` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `plot_area_in_sq_mtr` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `phisical_colored_map_with_tree_located` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `architech_application` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `google_map_with_polygone` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `document_7_12` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cc_number` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `user_id` int(11) NOT NULL,
  `inspection_report_by_cg` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp(),
  `type_of_residence` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `tippni_upload` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `tippni_data` text COLLATE utf8_unicode_ci NOT NULL,
  `demand` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `oc_affidavit` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `permission_upload` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `number_of_trees_to_be_planted` int(11) NOT NULL,
  `name_of_trees_to_be_planted` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `paid_1` int(11) NOT NULL,
  `paid_2` int(11) NOT NULL,
  `tippni` int(11) NOT NULL,
  `cc_certificate_copy` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `application_no` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `mobile_no` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `latitude` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `longitude` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `current_tiimestamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_timestamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `mouje` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `survey_no` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `outward_oc` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `oc_photo_inspection`
--

CREATE TABLE `oc_photo_inspection` (
  `id` int(11) NOT NULL,
  `rec_id` varchar(255) NOT NULL,
  `latitude` varchar(255) NOT NULL,
  `longitude` varchar(255) NOT NULL,
  `upload_photo_of_tree` varchar(255) NOT NULL,
  `name_of_tree` varchar(255) NOT NULL,
  `inspection_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `photo` varchar(255) NOT NULL,
  `photo2` varchar(255) NOT NULL,
  `photo3` varchar(255) NOT NULL,
  `tree_count` int(11) NOT NULL,
  `enter_name_of_tree` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `rec_id` int(11) NOT NULL,
  `order_date` date NOT NULL,
  `upload_order` varchar(255) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `paper_notice`
--

CREATE TABLE `paper_notice` (
  `id` int(11) NOT NULL,
  `rec_id` int(11) NOT NULL,
  `upload_paper_cutting` varchar(255) NOT NULL,
  `name_of_news_paper` varchar(255) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp(),
  `advertisement_date` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `payment2`
--

CREATE TABLE `payment2` (
  `id` int(11) NOT NULL,
  `rec_id` int(11) NOT NULL,
  `db_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `recieved_from` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `amount` int(11) NOT NULL,
  `payment_mode` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `purpose` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `id` int(11) NOT NULL,
  `recieved_from` varchar(255) NOT NULL,
  `amount` int(11) NOT NULL,
  `payment_mode` varchar(255) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp(),
  `text` text NOT NULL,
  `rec_id` int(11) NOT NULL,
  `purpose` varchar(255) NOT NULL,
  `db_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `photo_of_inspection`
--

CREATE TABLE `photo_of_inspection` (
  `id` int(11) NOT NULL,
  `rec_id` varchar(255) NOT NULL,
  `latitude` varchar(255) NOT NULL,
  `longitude` varchar(255) NOT NULL,
  `upload_photo_of_tree` varchar(255) NOT NULL,
  `width` float NOT NULL,
  `height` float NOT NULL,
  `feet` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `photo_of_inspection_refund`
--

CREATE TABLE `photo_of_inspection_refund` (
  `id` int(11) NOT NULL,
  `rec_id` varchar(255) NOT NULL,
  `latitude` varchar(255) NOT NULL,
  `longitude` varchar(255) NOT NULL,
  `upload_photo_of_tree` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `photo_of_tree`
--

CREATE TABLE `photo_of_tree` (
  `id` int(11) NOT NULL,
  `rec_id` varchar(255) NOT NULL,
  `latitude` varchar(255) NOT NULL,
  `longitude` varchar(255) NOT NULL,
  `upload_photo_of_tree` varchar(255) NOT NULL,
  `name_of_tree` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `refund`
--

CREATE TABLE `refund` (
  `id` int(11) NOT NULL,
  `date_of_permission` varchar(255) NOT NULL,
  `application_id` varchar(255) NOT NULL,
  `no_of_tree_cut` varchar(255) NOT NULL,
  `no_of_tree_planted` varchar(255) NOT NULL,
  `upload_original_reciept` varchar(255) NOT NULL,
  `complete_address_of_plantation` text NOT NULL,
  `bank_name` varchar(255) NOT NULL,
  `account_number` varchar(255) NOT NULL,
  `ifsc_code` varchar(255) NOT NULL,
  `account_holder_name` varchar(255) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` varchar(255) NOT NULL,
  `amount` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `flag_inspection` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `refund_inspection`
--

CREATE TABLE `refund_inspection` (
  `id` int(11) NOT NULL,
  `user_id` varchar(255) NOT NULL,
  `rec_id` varchar(255) NOT NULL,
  `report_upload` varchar(255) NOT NULL,
  `longitude` varchar(255) NOT NULL,
  `latitude` varchar(255) NOT NULL,
  `photo_of_tree` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `remark` text NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `report_of_tree`
--

CREATE TABLE `report_of_tree` (
  `id` int(11) NOT NULL,
  `rec_id` varchar(255) NOT NULL,
  `latitude` varchar(255) NOT NULL,
  `longitude` varchar(255) NOT NULL,
  `upload_photo_of_plantation` varchar(255) NOT NULL,
  `upload_photo_of_tree_now` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `role_id` int(11) NOT NULL,
  `role_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`role_id`, `role_name`) VALUES
(1, 'Administrator'),
(4, 'Auth1'),
(11, 'Authority'),
(10, 'Chief Garden Superintendent'),
(13, 'Chief_Gardener'),
(14, 'commissioner'),
(7, 'Garden Inspector'),
(9, 'Garden Superintendent'),
(3, 'Hod'),
(6, 'Objection_uploads'),
(5, 'Postmortem'),
(12, 'superadmin'),
(15, 'town_planning_admin'),
(2, 'User');

-- --------------------------------------------------------

--
-- Table structure for table `role_permissions`
--

CREATE TABLE `role_permissions` (
  `permission_id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  `page_name` varchar(255) NOT NULL,
  `action_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `role_permissions`
--

INSERT INTO `role_permissions` (`permission_id`, `role_id`, `page_name`, `action_name`) VALUES
(1, 0, 'page_name', 'action_name'),
(504, 4, 'application_form', 'list'),
(505, 4, 'application_form', 'objection_advertise'),
(506, 4, 'application_form', 'cert_view'),
(507, 4, 'application_form', 'postmortem'),
(663, 4, 'inspection', 'list'),
(664, 4, 'inspection', 'add'),
(665, 4, 'inspection', 'view'),
(666, 4, 'payments', 'view'),
(667, 4, 'orders', 'list'),
(668, 4, 'orders', 'add'),
(669, 4, 'orders', 'view'),
(670, 4, 'paper_notice', 'view'),
(671, 4, 'paper_notice', 'add'),
(672, 4, 'objections', 'list'),
(673, 4, 'objections', 'edit'),
(677, 4, 'objections', 'edit2'),
(682, 4, 'final_decision', 'view'),
(684, 4, 'application_form', 'edit2'),
(692, 4, 'objections_payments', 'view'),
(693, 4, 'payments', 'view'),
(707, 4, 'photo_of_inspection', 'edit'),
(708, 4, 'photo_of_tree', 'list'),
(709, 4, 'photo_of_tree', 'edit'),
(710, 4, 'photo_of_inspection', 'list'),
(711, 4, 'refund', 'list'),
(712, 4, 'photo_of_inspection_refund', 'list'),
(713, 4, 'photo_of_inspection_refund', 'edit'),
(714, 4, 'refund_inspection', 'add'),
(715, 4, 'refund_inspection', 'view'),
(718, 4, 'refund', 'edit2'),
(724, 4, 'application_form', 'licence'),
(727, 4, 'objections', 'add'),
(10253, 9, 'commencement_certificate', 'inpection_report_upload'),
(10254, 10, 'commencement_certificate', 'inpection_report_upload'),
(10255, 11, 'application_form', 'list'),
(10256, 11, 'application_form', 'view'),
(10257, 11, 'application_form', 'add'),
(10258, 11, 'application_form', 'edit'),
(10259, 11, 'application_form', 'editfield'),
(10260, 11, 'application_form', 'delete'),
(10261, 11, 'application_form', 'licence'),
(10262, 11, 'application_form', 'cert_view'),
(10263, 11, 'application_form', 'refund'),
(10264, 11, 'application_form', 'postmortem'),
(10265, 11, 'application_form', 'objection_advertise'),
(10266, 11, 'application_form', 'edit2'),
(10267, 11, 'application_form', 'view_tipnni'),
(10268, 11, 'application_form', 'view_permission'),
(10269, 11, 'application_form', 'edit_tipnni'),
(10270, 11, 'application_form', 'edit_permission'),
(10271, 11, 'application_form', 'view_advt_tipnni'),
(10272, 11, 'application_form', 'import_data'),
(10273, 11, 'report_of_tree', 'list'),
(10274, 11, 'report_of_tree', 'view'),
(10275, 11, 'report_of_tree', 'add'),
(10276, 11, 'report_of_tree', 'edit'),
(10277, 11, 'report_of_tree', 'editfield'),
(10278, 11, 'report_of_tree', 'delete'),
(10279, 11, 'report_of_tree', 'import_data'),
(10280, 11, 'name_designation_master', 'list'),
(10281, 11, 'name_designation_master', 'view'),
(10282, 11, 'name_designation_master', 'add'),
(10283, 11, 'name_designation_master', 'edit'),
(10284, 11, 'name_designation_master', 'editfield'),
(10285, 11, 'name_designation_master', 'delete'),
(10286, 11, 'name_designation_master', 'import_data'),
(10287, 11, 'master_zone', 'list'),
(10288, 11, 'master_zone', 'view'),
(10289, 11, 'master_zone', 'add'),
(10290, 11, 'master_zone', 'edit'),
(10291, 11, 'master_zone', 'editfield'),
(10292, 11, 'master_zone', 'delete'),
(10293, 11, 'master_zone', 'import_data'),
(10294, 11, 'inspection', 'list'),
(10295, 11, 'inspection', 'view'),
(10296, 11, 'inspection', 'add'),
(10297, 11, 'inspection', 'edit'),
(10298, 11, 'inspection', 'editfield'),
(10299, 11, 'inspection', 'delete'),
(10300, 11, 'inspection', 'import_data'),
(10301, 11, 'objections', 'list'),
(10302, 11, 'orders', 'list'),
(10303, 11, 'orders', 'view'),
(10304, 11, 'orders', 'add'),
(10305, 11, 'orders', 'edit'),
(10306, 11, 'orders', 'editfield'),
(10307, 11, 'orders', 'delete'),
(10308, 11, 'orders', 'import_data'),
(10309, 11, 'paper_notice', 'list'),
(10310, 11, 'paper_notice', 'view'),
(10311, 11, 'paper_notice', 'add'),
(10312, 11, 'paper_notice', 'edit'),
(10313, 11, 'paper_notice', 'editfield'),
(10314, 11, 'paper_notice', 'delete'),
(10315, 11, 'paper_notice', 'import_data'),
(10316, 11, 'payments', 'list'),
(10317, 11, 'payments', 'view'),
(10318, 11, 'payments', 'add'),
(10319, 11, 'payments', 'edit'),
(10320, 11, 'payments', 'editfield'),
(10321, 11, 'payments', 'delete'),
(10322, 11, 'payments', 'import_data'),
(10323, 11, 'refund', 'list'),
(10324, 11, 'refund', 'view'),
(10325, 11, 'refund', 'add'),
(10326, 11, 'refund', 'edit'),
(10327, 11, 'refund', 'editfield'),
(10328, 11, 'refund', 'delete'),
(10329, 11, 'refund', 'edit2'),
(10330, 11, 'refund', 'import_data'),
(10331, 11, 'objections_payments', 'list'),
(10332, 11, 'objections_payments', 'view'),
(10333, 11, 'objections_payments', 'add'),
(10334, 11, 'objections_payments', 'edit'),
(10335, 11, 'objections_payments', 'editfield'),
(10336, 11, 'objections_payments', 'delete'),
(10337, 11, 'objections_payments', 'import_data'),
(10338, 11, 'objections_hod_approval', 'list'),
(10339, 11, 'objections_hod_approval', 'view'),
(10340, 11, 'objections_hod_approval', 'add'),
(10341, 11, 'objections_hod_approval', 'edit'),
(10342, 11, 'objections_hod_approval', 'editfield'),
(10343, 11, 'objections_hod_approval', 'delete'),
(10344, 11, 'objections_hod_approval', 'import_data'),
(10345, 11, 'final_decision', 'list'),
(10346, 11, 'final_decision', 'view'),
(10347, 11, 'final_decision', 'add'),
(10348, 11, 'final_decision', 'edit'),
(10349, 11, 'final_decision', 'editfield'),
(10350, 11, 'final_decision', 'delete'),
(10351, 11, 'final_decision', 'import_data'),
(10352, 11, 'photo_of_tree', 'list'),
(10353, 11, 'photo_of_tree', 'view'),
(10354, 11, 'photo_of_tree', 'add'),
(10355, 11, 'photo_of_tree', 'edit'),
(10356, 11, 'photo_of_tree', 'editfield'),
(10357, 11, 'photo_of_tree', 'delete'),
(10358, 11, 'photo_of_tree', 'import_data'),
(10359, 11, 'photo_of_inspection', 'list'),
(10360, 11, 'photo_of_inspection', 'view'),
(10361, 11, 'photo_of_inspection', 'add'),
(10362, 11, 'photo_of_inspection', 'edit'),
(10363, 11, 'photo_of_inspection', 'editfield'),
(10364, 11, 'photo_of_inspection', 'delete'),
(10365, 11, 'photo_of_inspection', 'import_data'),
(10366, 11, 'photo_of_inspection_refund', 'list'),
(10367, 11, 'photo_of_inspection_refund', 'view'),
(10368, 11, 'photo_of_inspection_refund', 'add'),
(10369, 11, 'photo_of_inspection_refund', 'edit'),
(10370, 11, 'photo_of_inspection_refund', 'editfield'),
(10371, 11, 'photo_of_inspection_refund', 'delete'),
(10372, 11, 'photo_of_inspection_refund', 'import_data'),
(10373, 11, 'refund_inspection', 'list'),
(10374, 11, 'refund_inspection', 'view'),
(10375, 11, 'refund_inspection', 'add'),
(10376, 11, 'refund_inspection', 'edit'),
(10377, 11, 'refund_inspection', 'editfield'),
(10378, 11, 'refund_inspection', 'delete'),
(10379, 11, 'refund_inspection', 'import_data'),
(10380, 11, 'ccav_orders', 'list'),
(10381, 11, 'ccav_orders', 'view'),
(10382, 11, 'ccav_orders', 'add'),
(10383, 11, 'ccav_orders', 'edit'),
(10384, 11, 'ccav_orders', 'editfield'),
(10385, 11, 'ccav_orders', 'delete'),
(10386, 11, 'ccav_orders', 'import_data'),
(10387, 11, 'login_token', 'list'),
(10388, 11, 'login_token', 'view'),
(10389, 11, 'login_token', 'add'),
(10390, 11, 'login_token', 'edit'),
(10391, 11, 'login_token', 'editfield'),
(10392, 11, 'login_token', 'delete'),
(10393, 11, 'login_token', 'import_data'),
(10394, 11, 'master_for_name_of_news_paper', 'list'),
(10395, 11, 'master_for_name_of_news_paper', 'view'),
(10396, 11, 'master_for_name_of_news_paper', 'add'),
(10397, 11, 'master_for_name_of_news_paper', 'edit'),
(10398, 11, 'master_for_name_of_news_paper', 'editfield'),
(10399, 11, 'master_for_name_of_news_paper', 'delete'),
(10400, 11, 'master_for_name_of_news_paper', 'import_data'),
(10401, 11, 'accept_reject_', 'list'),
(10402, 11, 'accept_reject', 'view'),
(10403, 11, 'accept_reject', 'add'),
(10404, 11, 'accept_reject', 'edit'),
(10405, 11, 'accept_reject', 'editfield'),
(10406, 11, 'accept_reject', 'delete'),
(10407, 11, 'accept_reject', 'import_data'),
(10408, 11, 'cc_photo_inspection', 'list'),
(10409, 11, 'cc_photo_inspection', 'view'),
(10410, 11, 'cc_photo_inspection', 'add'),
(10411, 11, 'cc_photo_inspection', 'edit'),
(10412, 11, 'cc_photo_inspection', 'editfield'),
(10413, 11, 'cc_photo_inspection', 'delete'),
(10414, 11, 'cc_photo_inspection', 'import_data'),
(10415, 11, 'certificate_data', 'list'),
(10416, 11, 'certificate_data', 'view'),
(10417, 11, 'certificate_data', 'add'),
(10418, 11, 'certificate_data', 'edit'),
(10419, 11, 'certificate_data', 'editfield'),
(10420, 11, 'certificate_data', 'delete'),
(10421, 11, 'certificate_data', 'import_data'),
(10422, 11, 'commencement_certificate', 'list'),
(10423, 11, 'commencement_certificate', 'view'),
(10424, 11, 'commencement_certificate', 'add'),
(10425, 11, 'commencement_certificate', 'edit'),
(10426, 11, 'commencement_certificate', 'editfield'),
(10427, 11, 'commencement_certificate', 'delete'),
(10428, 11, 'commencement_certificate', 'import_data'),
(10429, 11, 'master_name_of_tree', 'list'),
(10430, 11, 'master_name_of_tree', 'view'),
(10431, 11, 'master_name_of_tree', 'add'),
(10432, 11, 'master_name_of_tree', 'edit'),
(10433, 11, 'master_name_of_tree', 'editfield'),
(10434, 11, 'master_name_of_tree', 'delete'),
(10435, 11, 'master_name_of_tree', 'import_data'),
(10436, 11, 'occupancy_certificate', 'list'),
(10437, 11, 'occupancy_certificate', 'view'),
(10438, 11, 'occupancy_certificate', 'add'),
(10439, 11, 'occupancy_certificate', 'edit'),
(10440, 11, 'occupancy_certificate', 'editfield'),
(10441, 11, 'occupancy_certificate', 'delete'),
(10442, 11, 'occupancy_certificate', 'import_data'),
(10443, 11, 'accept_reject2', 'list'),
(10444, 11, 'accept_reject2', 'view'),
(10445, 11, 'accept_reject2', 'add'),
(10446, 11, 'accept_reject2', 'edit'),
(10447, 11, 'accept_reject2', 'editfield'),
(10448, 11, 'accept_reject2', 'delete'),
(10449, 11, 'accept_reject2', 'import_data'),
(10450, 11, 'authorization_sequence', 'list'),
(10451, 11, 'authorization_sequence', 'view'),
(10452, 11, 'authorization_sequence', 'add'),
(10453, 11, 'authorization_sequence', 'edit'),
(10454, 11, 'authorization_sequence', 'editfield'),
(10455, 11, 'authorization_sequence', 'delete'),
(10456, 11, 'authorization_sequence', 'import_data'),
(10457, 11, 'payment2', 'list'),
(10458, 11, 'commencement_certificate', 'inpection_report_upload'),
(11572, 9, 'application_form', 'list'),
(11573, 9, 'inspection', 'view'),
(11574, 9, 'inspection', 'add'),
(11575, 9, 'objections', 'list'),
(11576, 9, 'objections', 'view'),
(11577, 9, 'objections', 'add'),
(11578, 9, 'objections', 'edit'),
(11579, 9, 'objections', 'editfield'),
(11580, 9, 'objections', 'edit2'),
(11581, 9, 'orders', 'view'),
(11582, 9, 'orders', 'add'),
(11583, 9, 'paper_notice', 'list'),
(11584, 9, 'paper_notice', 'view'),
(11585, 9, 'paper_notice', 'add'),
(11586, 9, 'payments', 'view'),
(11587, 9, 'payments', 'add'),
(11588, 9, 'payments', 'edit'),
(11589, 9, 'payments', 'editfield'),
(11590, 9, 'objections_payments', 'view'),
(11591, 9, 'photo_of_tree', 'list'),
(11592, 9, 'photo_of_inspection', 'list'),
(11593, 9, 'photo_of_inspection', 'edit'),
(11594, 9, 'photo_of_inspection', 'editfield'),
(11595, 9, 'accept_reject_', 'list'),
(11596, 9, 'accept_reject', 'view'),
(11597, 9, 'accept_reject', 'add'),
(11598, 9, 'accept_reject', 'edit'),
(11599, 9, 'accept_reject', 'editfield'),
(11600, 9, 'accept_reject', 'delete'),
(11601, 9, 'application_form', 'view_tipnni'),
(11602, 9, 'application_form', 'view_permission'),
(11603, 9, 'application_form', 'edit_tipnni'),
(11604, 9, 'application_form', 'edit_permission'),
(11605, 9, 'application_form', 'view_advt_tipnni'),
(11606, 9, 'accept_reject2', 'list'),
(11607, 9, 'accept_reject2', 'view'),
(11608, 9, 'accept_reject2', 'add'),
(11609, 9, 'accept_reject2', 'edit'),
(11610, 9, 'accept_reject2', 'editfield'),
(11611, 9, 'accept_reject2', 'delete'),
(11612, 9, 'cc_photo_inspection', 'list'),
(11613, 9, 'cc_photo_inspection', 'view'),
(11614, 9, 'cc_photo_inspection', 'add'),
(11615, 9, 'cc_photo_inspection', 'edit'),
(11616, 9, 'cc_photo_inspection', 'editfield'),
(11617, 9, 'cc_photo_inspection', 'delete'),
(11618, 9, 'commencement_certificate', 'list'),
(11619, 9, 'commencement_certificate', 'view'),
(11620, 9, 'commencement_certificate', 'add'),
(11621, 9, 'commencement_certificate', 'edit'),
(11622, 9, 'commencement_certificate', 'editfield'),
(11623, 9, 'commencement_certificate', 'delete'),
(11624, 9, 'occupancy_certificate', 'list'),
(11625, 9, 'occupancy_certificate', 'view'),
(11626, 9, 'occupancy_certificate', 'add'),
(11627, 9, 'occupancy_certificate', 'edit'),
(11628, 9, 'occupancy_certificate', 'editfield'),
(11629, 9, 'occupancy_certificate', 'delete'),
(11630, 9, 'payment2', 'list'),
(11631, 9, 'payment2', 'view'),
(11632, 9, 'payment2', 'add'),
(11633, 9, 'payment2', 'edit'),
(11634, 9, 'payment2', 'editfield'),
(11635, 9, 'payment2', 'delete'),
(11636, 9, 'commencement_certificate', 'inspection_report_upload'),
(11637, 9, 'commencement_certificate', 'tippni_upload'),
(11638, 10, 'application_form', 'list'),
(11639, 10, 'inspection', 'view'),
(11640, 10, 'inspection', 'add'),
(11641, 10, 'objections', 'list'),
(11642, 10, 'objections', 'view'),
(11643, 10, 'objections', 'add'),
(11644, 10, 'objections', 'edit'),
(11645, 10, 'objections', 'editfield'),
(11646, 10, 'objections', 'edit2'),
(11647, 10, 'orders', 'view'),
(11648, 10, 'orders', 'add'),
(11649, 10, 'paper_notice', 'list'),
(11650, 10, 'paper_notice', 'view'),
(11651, 10, 'paper_notice', 'add'),
(11652, 10, 'payments', 'view'),
(11653, 10, 'payments', 'add'),
(11654, 10, 'payments', 'edit'),
(11655, 10, 'payments', 'editfield'),
(11656, 10, 'objections_payments', 'view'),
(11657, 10, 'photo_of_tree', 'list'),
(11658, 10, 'photo_of_inspection', 'list'),
(11659, 10, 'photo_of_inspection', 'edit'),
(11660, 10, 'photo_of_inspection', 'editfield'),
(11661, 10, 'accept_reject_', 'list'),
(11662, 10, 'accept_reject', 'view'),
(11663, 10, 'accept_reject', 'add'),
(11664, 10, 'accept_reject', 'edit'),
(11665, 10, 'accept_reject', 'editfield'),
(11666, 10, 'accept_reject', 'delete'),
(11667, 10, 'application_form', 'view_tipnni'),
(11668, 10, 'application_form', 'view_permission'),
(11669, 10, 'application_form', 'edit_tipnni'),
(11670, 10, 'application_form', 'edit_permission'),
(11671, 10, 'application_form', 'view_advt_tipnni'),
(11672, 10, 'accept_reject2', 'list'),
(11673, 10, 'accept_reject2', 'view'),
(11674, 10, 'accept_reject2', 'add'),
(11675, 10, 'accept_reject2', 'edit'),
(11676, 10, 'accept_reject2', 'editfield'),
(11677, 10, 'accept_reject2', 'delete'),
(11678, 10, 'cc_photo_inspection', 'list'),
(11679, 10, 'cc_photo_inspection', 'view'),
(11680, 10, 'cc_photo_inspection', 'add'),
(11681, 10, 'cc_photo_inspection', 'edit'),
(11682, 10, 'cc_photo_inspection', 'editfield'),
(11683, 10, 'cc_photo_inspection', 'delete'),
(11684, 10, 'commencement_certificate', 'list'),
(11685, 10, 'commencement_certificate', 'view'),
(11686, 10, 'commencement_certificate', 'add'),
(11687, 10, 'commencement_certificate', 'edit'),
(11688, 10, 'commencement_certificate', 'editfield'),
(11689, 10, 'commencement_certificate', 'delete'),
(11690, 10, 'occupancy_certificate', 'list'),
(11691, 10, 'occupancy_certificate', 'view'),
(11692, 10, 'occupancy_certificate', 'add'),
(11693, 10, 'occupancy_certificate', 'edit'),
(11694, 10, 'occupancy_certificate', 'editfield'),
(11695, 10, 'occupancy_certificate', 'delete'),
(11696, 10, 'payment2', 'list'),
(11697, 10, 'payment2', 'view'),
(11698, 10, 'payment2', 'add'),
(11699, 10, 'payment2', 'edit'),
(11700, 10, 'payment2', 'editfield'),
(11701, 10, 'payment2', 'delete'),
(11702, 10, 'commencement_certificate', 'inspection_report_upload'),
(11703, 10, 'commencement_certificate', 'tippni_upload'),
(12090, 9, 'commencement_certificate', 'tippni'),
(12483, 10, 'commencement_certificate', 'permission'),
(12484, 9, 'commencement_certificate', 'permission'),
(13275, 9, 'commencement_certificate', 'tippni_data'),
(13680, 9, 'commencement_certificate', 'demand_button'),
(14094, 9, 'demand', 'list'),
(14095, 9, 'demand', 'view'),
(14096, 9, 'demand', 'add'),
(16227, 9, 'occupancy_certificate', 'demand_button'),
(16673, 9, 'occupancy_certificate', 'tippni_data'),
(17143, 9, 'commencement_certificate', 'permission_upload'),
(17144, 9, 'occupancy_certificate', 'tippni_upload'),
(17145, 9, 'occupancy_certificate', 'permission_upload'),
(17146, 9, 'occupancy_certificate', 'tippni'),
(17147, 10, 'occupancy_certificate', 'permission'),
(17150, 9, 'tree_report_matrix', 'list'),
(17151, 10, 'tree_report_matrix', 'list'),
(17635, 9, 'occupancy_certificate', 'permission'),
(18129, 9, 'tippani_data', 'list'),
(18130, 9, 'tippani_data', 'view'),
(18131, 9, 'tippani_data', 'add'),
(18132, 9, 'tippani_data', 'edit'),
(18133, 9, 'tippani_data', 'editfield'),
(18134, 9, 'tippani_data', 'delete'),
(18135, 9, 'tree_matrix_subentry', 'list'),
(18136, 10, 'tree_matrix_subentry', 'list'),
(19155, 10, 'demand', 'view'),
(19156, 9, 'demand', 'view'),
(19159, 9, 'tree_matrix_subentry', 'list'),
(19160, 9, 'tree_matrix_subentry', 'edit'),
(19161, 9, 'tree_report_matrix', 'list'),
(19162, 9, 'tree_report_matrix', 'edit'),
(19163, 9, 'oc_photo_inspection', 'list'),
(19164, 10, 'oc_photo_inspection', 'list'),
(19165, 9, 'cc_photo_inspection', 'list'),
(19166, 10, 'cc_photo_inspection', 'list'),
(19324, 9, 'commencement_certificate', 'inpection_report_upload'),
(19325, 9, 'application_form', 'list'),
(19326, 9, 'inspection', 'view'),
(19327, 9, 'inspection', 'add'),
(19328, 9, 'objections', 'list'),
(19329, 9, 'objections', 'view'),
(19330, 9, 'objections', 'add'),
(19331, 9, 'objections', 'edit'),
(19332, 9, 'objections', 'editfield'),
(19333, 9, 'objections', 'edit2'),
(19334, 9, 'orders', 'view'),
(19335, 9, 'orders', 'add'),
(19336, 9, 'paper_notice', 'list'),
(19337, 9, 'paper_notice', 'view'),
(19338, 9, 'paper_notice', 'add'),
(19339, 9, 'payments', 'view'),
(19340, 9, 'payments', 'add'),
(19341, 9, 'payments', 'edit'),
(19342, 9, 'payments', 'editfield'),
(19343, 9, 'objections_payments', 'view'),
(19344, 9, 'photo_of_tree', 'list'),
(19345, 9, 'photo_of_inspection', 'list'),
(19346, 9, 'photo_of_inspection', 'edit'),
(19347, 9, 'photo_of_inspection', 'editfield'),
(19348, 9, 'accept_reject_', 'list'),
(19349, 9, 'accept_reject', 'view'),
(19350, 9, 'accept_reject', 'add'),
(19351, 9, 'accept_reject', 'edit'),
(19352, 9, 'accept_reject', 'editfield'),
(19353, 9, 'accept_reject', 'delete'),
(19354, 9, 'application_form', 'view_tipnni'),
(19355, 9, 'application_form', 'view_permission'),
(19356, 9, 'application_form', 'edit_tipnni'),
(19357, 9, 'application_form', 'edit_permission'),
(19358, 9, 'application_form', 'view_advt_tipnni'),
(19359, 9, 'accept_reject2', 'list'),
(19360, 9, 'accept_reject2', 'view'),
(19361, 9, 'accept_reject2', 'add'),
(19362, 9, 'accept_reject2', 'edit'),
(19363, 9, 'accept_reject2', 'editfield'),
(19364, 9, 'accept_reject2', 'delete'),
(19365, 9, 'cc_photo_inspection', 'list'),
(19366, 9, 'cc_photo_inspection', 'view'),
(19367, 9, 'cc_photo_inspection', 'add'),
(19368, 9, 'cc_photo_inspection', 'edit'),
(19369, 9, 'cc_photo_inspection', 'editfield'),
(19370, 9, 'cc_photo_inspection', 'delete'),
(19371, 9, 'commencement_certificate', 'list'),
(19372, 9, 'commencement_certificate', 'view'),
(19373, 9, 'commencement_certificate', 'add'),
(19374, 9, 'commencement_certificate', 'edit'),
(19375, 9, 'commencement_certificate', 'editfield'),
(19376, 9, 'commencement_certificate', 'delete'),
(19377, 9, 'occupancy_certificate', 'list'),
(19378, 9, 'occupancy_certificate', 'view'),
(19379, 9, 'occupancy_certificate', 'add'),
(19380, 9, 'occupancy_certificate', 'edit'),
(19381, 9, 'occupancy_certificate', 'editfield'),
(19382, 9, 'occupancy_certificate', 'delete'),
(19383, 9, 'payment2', 'list'),
(19384, 9, 'payment2', 'view'),
(19385, 9, 'payment2', 'add'),
(19386, 9, 'payment2', 'edit'),
(19387, 9, 'payment2', 'editfield'),
(19388, 9, 'payment2', 'delete'),
(19389, 9, 'commencement_certificate', 'inspection_report_upload'),
(19390, 9, 'commencement_certificate', 'tippni_upload'),
(19391, 9, 'commencement_certificate', 'tippni'),
(19392, 9, 'commencement_certificate', 'permission'),
(19393, 9, 'commencement_certificate', 'tippni_data'),
(19394, 9, 'commencement_certificate', 'demand_button'),
(19395, 9, 'demand', 'list'),
(19396, 9, 'demand', 'view'),
(19397, 9, 'demand', 'add'),
(19398, 9, 'occupancy_certificate', 'demand_button'),
(19399, 9, 'occupancy_certificate', 'tippni_data'),
(19400, 9, 'commencement_certificate', 'permission_upload'),
(19401, 9, 'occupancy_certificate', 'tippni_upload'),
(19402, 9, 'occupancy_certificate', 'permission_upload'),
(19403, 9, 'occupancy_certificate', 'tippni'),
(19404, 9, 'tree_report_matrix', 'list'),
(19405, 9, 'occupancy_certificate', 'permission'),
(19406, 9, 'tippani_data', 'list'),
(19407, 9, 'tippani_data', 'view'),
(19408, 9, 'tippani_data', 'add'),
(19409, 9, 'tippani_data', 'edit'),
(19410, 9, 'tippani_data', 'editfield'),
(19411, 9, 'tippani_data', 'delete'),
(19412, 9, 'tree_matrix_subentry', 'list'),
(19413, 9, 'demand', 'view'),
(19414, 9, 'tree_matrix_subentry', 'list'),
(19415, 9, 'tree_matrix_subentry', 'edit'),
(19416, 9, 'tree_report_matrix', 'list'),
(19417, 9, 'tree_report_matrix', 'edit'),
(19418, 9, 'oc_photo_inspection', 'list'),
(19419, 9, 'cc_photo_inspection', 'list'),
(19420, 10, 'commencement_certificate', 'inpection_report_upload'),
(19421, 10, 'application_form', 'list'),
(19422, 10, 'inspection', 'view'),
(19423, 10, 'inspection', 'add'),
(19424, 10, 'objections', 'list'),
(19425, 10, 'objections', 'view'),
(19426, 10, 'objections', 'add'),
(19427, 10, 'objections', 'edit'),
(19428, 10, 'objections', 'editfield'),
(19429, 10, 'objections', 'edit2'),
(19430, 10, 'orders', 'view'),
(19431, 10, 'orders', 'add'),
(19432, 10, 'paper_notice', 'list'),
(19433, 10, 'paper_notice', 'view'),
(19434, 10, 'paper_notice', 'add'),
(19435, 10, 'payments', 'view'),
(19436, 10, 'payments', 'add'),
(19437, 10, 'payments', 'edit'),
(19438, 10, 'payments', 'editfield'),
(19439, 10, 'objections_payments', 'view'),
(19440, 10, 'photo_of_tree', 'list'),
(19441, 10, 'photo_of_inspection', 'list'),
(19442, 10, 'photo_of_inspection', 'edit'),
(19443, 10, 'photo_of_inspection', 'editfield'),
(19444, 10, 'accept_reject_', 'list'),
(19445, 10, 'accept_reject', 'view'),
(19446, 10, 'accept_reject', 'add'),
(19447, 10, 'accept_reject', 'edit'),
(19448, 10, 'accept_reject', 'editfield'),
(19449, 10, 'accept_reject', 'delete'),
(19450, 10, 'application_form', 'view_tipnni'),
(19451, 10, 'application_form', 'view_permission'),
(19452, 10, 'application_form', 'edit_tipnni'),
(19453, 10, 'application_form', 'edit_permission'),
(19454, 10, 'application_form', 'view_advt_tipnni'),
(19455, 10, 'accept_reject2', 'list'),
(19456, 10, 'accept_reject2', 'view'),
(19457, 10, 'accept_reject2', 'add'),
(19458, 10, 'accept_reject2', 'edit'),
(19459, 10, 'accept_reject2', 'editfield'),
(19460, 10, 'accept_reject2', 'delete'),
(19461, 10, 'cc_photo_inspection', 'list'),
(19462, 10, 'cc_photo_inspection', 'view'),
(19463, 10, 'cc_photo_inspection', 'add'),
(19464, 10, 'cc_photo_inspection', 'edit'),
(19465, 10, 'cc_photo_inspection', 'editfield'),
(19466, 10, 'cc_photo_inspection', 'delete'),
(19467, 10, 'commencement_certificate', 'list'),
(19468, 10, 'commencement_certificate', 'view'),
(19469, 10, 'commencement_certificate', 'add'),
(19470, 10, 'commencement_certificate', 'edit'),
(19471, 10, 'commencement_certificate', 'editfield'),
(19472, 10, 'commencement_certificate', 'delete'),
(19473, 10, 'occupancy_certificate', 'list'),
(19474, 10, 'occupancy_certificate', 'view'),
(19475, 10, 'occupancy_certificate', 'add'),
(19476, 10, 'occupancy_certificate', 'edit'),
(19477, 10, 'occupancy_certificate', 'editfield'),
(19478, 10, 'occupancy_certificate', 'delete'),
(19479, 10, 'payment2', 'list'),
(19480, 10, 'payment2', 'view'),
(19481, 10, 'payment2', 'add'),
(19482, 10, 'payment2', 'edit'),
(19483, 10, 'payment2', 'editfield'),
(19484, 10, 'payment2', 'delete'),
(19485, 10, 'commencement_certificate', 'inspection_report_upload'),
(19486, 10, 'commencement_certificate', 'tippni_upload'),
(19487, 10, 'commencement_certificate', 'permission'),
(19488, 10, 'occupancy_certificate', 'permission'),
(19489, 10, 'tree_report_matrix', 'list'),
(19490, 10, 'tree_matrix_subentry', 'list'),
(19491, 10, 'demand', 'view'),
(19492, 10, 'oc_photo_inspection', 'list'),
(19493, 10, 'cc_photo_inspection', 'list'),
(21520, 7, 'application_form', 'list'),
(21521, 7, 'application_form', 'view'),
(21522, 7, 'inspection', 'view'),
(21523, 7, 'inspection', 'add'),
(21524, 7, 'objections', 'list'),
(21525, 7, 'objections', 'view'),
(21526, 7, 'objections', 'add'),
(21527, 7, 'objections', 'edit'),
(21528, 7, 'objections', 'editfield'),
(21529, 7, 'objections', 'edit2'),
(21530, 7, 'orders', 'view'),
(21531, 7, 'orders', 'add'),
(21532, 7, 'paper_notice', 'list'),
(21533, 7, 'paper_notice', 'view'),
(21534, 7, 'paper_notice', 'add'),
(21535, 7, 'payments', 'view'),
(21536, 7, 'payments', 'add'),
(21537, 7, 'payments', 'edit'),
(21538, 7, 'payments', 'editfield'),
(21539, 7, 'objections_payments', 'view'),
(21540, 7, 'photo_of_tree', 'list'),
(21541, 7, 'photo_of_inspection', 'list'),
(21542, 7, 'photo_of_inspection', 'edit'),
(21543, 7, 'photo_of_inspection', 'editfield'),
(21544, 7, 'accept_reject_', 'list'),
(21545, 7, 'accept_reject', 'view'),
(21546, 7, 'accept_reject', 'add'),
(21547, 7, 'accept_reject', 'edit'),
(21548, 7, 'accept_reject', 'editfield'),
(21549, 7, 'accept_reject', 'delete'),
(21550, 7, 'application_form', 'view_tipnni'),
(21551, 7, 'application_form', 'view_permission'),
(21552, 7, 'application_form', 'edit_tipnni'),
(21553, 7, 'application_form', 'edit_permission'),
(21554, 7, 'application_form', 'view_advt_tipnni'),
(21555, 7, 'accept_reject2', 'list'),
(21556, 7, 'accept_reject2', 'view'),
(21557, 7, 'accept_reject2', 'add'),
(21558, 7, 'accept_reject2', 'edit'),
(21559, 7, 'accept_reject2', 'editfield'),
(21560, 7, 'accept_reject2', 'delete'),
(21561, 7, 'cc_photo_inspection', 'list'),
(21562, 7, 'cc_photo_inspection', 'view'),
(21563, 7, 'cc_photo_inspection', 'add'),
(21564, 7, 'cc_photo_inspection', 'edit'),
(21565, 7, 'cc_photo_inspection', 'editfield'),
(21566, 7, 'cc_photo_inspection', 'delete'),
(21567, 7, 'commencement_certificate', 'list'),
(21568, 7, 'commencement_certificate', 'view'),
(21569, 7, 'commencement_certificate', 'add'),
(21570, 7, 'commencement_certificate', 'edit'),
(21571, 7, 'commencement_certificate', 'editfield'),
(21572, 7, 'commencement_certificate', 'delete'),
(21573, 7, 'occupancy_certificate', 'list'),
(21574, 7, 'occupancy_certificate', 'view'),
(21575, 7, 'occupancy_certificate', 'add'),
(21576, 7, 'occupancy_certificate', 'edit'),
(21577, 7, 'occupancy_certificate', 'editfield'),
(21578, 7, 'occupancy_certificate', 'delete'),
(21579, 7, 'payment2', 'list'),
(21580, 7, 'payment2', 'view'),
(21581, 7, 'payment2', 'add'),
(21582, 7, 'payment2', 'edit'),
(21583, 7, 'payment2', 'editfield'),
(21584, 7, 'payment2', 'delete'),
(21585, 7, 'commencement_certificate', 'inspection_report_upload'),
(21586, 7, 'commencement_certificate', 'tippni_upload'),
(21587, 7, 'commencement_certificate', 'tippni'),
(21588, 7, 'commencement_certificate', 'permission'),
(21589, 7, 'demand', 'list'),
(21590, 7, 'demand', 'view'),
(21591, 7, 'demand', 'add'),
(21592, 7, 'oc_photo_inspection', 'list'),
(21593, 7, 'oc_photo_inspection', 'view'),
(21594, 7, 'oc_photo_inspection', 'add'),
(21595, 7, 'occupancy_certificate', 'inspection_report_upload'),
(21596, 7, 'occupancy_certificate', 'tippni_data'),
(21597, 7, 'commencement_certificate', 'permission_upload'),
(21598, 7, 'occupancy_certificate', 'tippni_upload'),
(21599, 7, 'occupancy_certificate', 'permission_upload'),
(21600, 7, 'occupancy_certificate', 'tippni'),
(21601, 7, 'occupancy_certificate', 'permission'),
(21602, 7, 'tippani_data', 'list'),
(21603, 7, 'tippani_data', 'view'),
(21604, 7, 'tippani_data', 'add'),
(21605, 7, 'tippani_data', 'edit'),
(21606, 7, 'tippani_data', 'editfield'),
(21607, 7, 'tippani_data', 'delete'),
(21608, 7, 'commencement_certificate', 'demand_button'),
(21609, 7, 'occupancy_certificate', 'demand_button'),
(21610, 7, 'commencement_certificate', 'tippni_data'),
(21611, 7, 'payments', 'view2'),
(21918, 7, 'inspection', 'view'),
(21919, 7, 'photo_of_inspection', 'list'),
(21921, 7, 'photo_of_tree', 'list'),
(21923, 7, 'paper_notice', 'view'),
(21925, 7, 'payments', 'add2'),
(21926, 7, 'payments', 'add3'),
(21927, 7, 'payments', 'add4'),
(21928, 9, 'payments', 'add4'),
(22749, 14, 'application_form', 'list'),
(22750, 14, 'application_form', 'view'),
(22751, 14, 'application_form', 'add'),
(22752, 14, 'application_form', 'edit'),
(22753, 14, 'application_form', 'editfield'),
(22754, 14, 'application_form', 'delete'),
(22755, 14, 'application_form', 'import_data'),
(22756, 14, 'report_of_tree', 'list'),
(22757, 14, 'report_of_tree', 'view'),
(22758, 14, 'report_of_tree', 'add'),
(22759, 14, 'report_of_tree', 'edit'),
(22760, 14, 'report_of_tree', 'editfield'),
(22761, 14, 'report_of_tree', 'delete'),
(22762, 14, 'report_of_tree', 'import_data'),
(22763, 14, 'user_info', 'list'),
(22764, 14, 'user_info', 'view'),
(22765, 14, 'user_info', 'add'),
(22766, 14, 'user_info', 'edit'),
(22767, 14, 'user_info', 'editfield'),
(22768, 14, 'user_info', 'import_data'),
(22769, 14, 'user_info', 'userregister'),
(22770, 14, 'user_info', 'accountedit'),
(22771, 14, 'user_info', 'accountview'),
(22772, 14, 'application_form', 'licence'),
(22773, 14, 'application_form', 'cert_view'),
(22774, 15, 'application_form', 'list'),
(22775, 15, 'application_form', 'view'),
(22776, 15, 'application_form', 'add'),
(22777, 15, 'application_form', 'edit'),
(22778, 15, 'application_form', 'editfield'),
(22779, 15, 'application_form', 'delete'),
(22780, 15, 'application_form', 'import_data'),
(22781, 15, 'report_of_tree', 'list'),
(22782, 15, 'report_of_tree', 'view'),
(22783, 15, 'report_of_tree', 'add'),
(22784, 15, 'report_of_tree', 'edit'),
(22785, 15, 'report_of_tree', 'editfield'),
(22786, 15, 'report_of_tree', 'delete'),
(22787, 15, 'report_of_tree', 'import_data'),
(22788, 15, 'user_info', 'list'),
(22789, 15, 'user_info', 'view'),
(22790, 15, 'user_info', 'add'),
(22791, 15, 'user_info', 'edit'),
(22792, 15, 'user_info', 'editfield'),
(22793, 15, 'user_info', 'import_data'),
(22794, 15, 'user_info', 'userregister'),
(22795, 15, 'user_info', 'accountedit'),
(22796, 15, 'user_info', 'accountview'),
(22797, 15, 'application_form', 'licence'),
(22798, 15, 'application_form', 'cert_view'),
(22799, 1, 'application_form', 'list'),
(22800, 1, 'application_form', 'view'),
(22801, 1, 'application_form', 'add'),
(22802, 1, 'application_form', 'edit'),
(22803, 1, 'application_form', 'editfield'),
(22804, 1, 'application_form', 'delete'),
(22805, 1, 'application_form', 'import_data'),
(22806, 1, 'report_of_tree', 'list'),
(22807, 1, 'report_of_tree', 'view'),
(22808, 1, 'report_of_tree', 'add'),
(22809, 1, 'report_of_tree', 'edit'),
(22810, 1, 'report_of_tree', 'editfield'),
(22811, 1, 'report_of_tree', 'delete'),
(22812, 1, 'report_of_tree', 'import_data'),
(22813, 1, 'user_info', 'list'),
(22814, 1, 'user_info', 'view'),
(22815, 1, 'user_info', 'add'),
(22816, 1, 'user_info', 'edit'),
(22817, 1, 'user_info', 'editfield'),
(22818, 1, 'user_info', 'import_data'),
(22819, 1, 'user_info', 'userregister'),
(22820, 1, 'user_info', 'accountedit'),
(22821, 1, 'user_info', 'accountview'),
(22822, 1, 'application_form', 'licence'),
(22823, 1, 'application_form', 'cert_view'),
(22824, 1, 'application_form', 'refund'),
(22825, 1, 'application_form', 'postmortem'),
(22826, 1, 'name_designation_master', 'list'),
(22827, 1, 'name_designation_master', 'view'),
(22828, 1, 'name_designation_master', 'add'),
(22829, 1, 'name_designation_master', 'edit'),
(22830, 1, 'name_designation_master', 'editfield'),
(22831, 1, 'name_designation_master', 'delete'),
(22832, 1, 'application_form', 'objection_advertise'),
(22833, 1, 'master_zone', 'list'),
(22834, 1, 'master_zone', 'view'),
(22835, 1, 'master_zone', 'add'),
(22836, 1, 'master_zone', 'edit'),
(22837, 1, 'master_zone', 'editfield'),
(22838, 1, 'master_zone', 'delete'),
(22839, 1, 'inspection', 'list'),
(22840, 1, 'inspection', 'view'),
(22841, 1, 'inspection', 'add'),
(22842, 1, 'inspection', 'edit'),
(22843, 1, 'inspection', 'editfield'),
(22844, 1, 'inspection', 'delete'),
(22845, 1, 'objections', 'list'),
(22846, 1, 'objections', 'view'),
(22847, 1, 'objections', 'add'),
(22848, 1, 'objections', 'edit'),
(22849, 1, 'objections', 'editfield'),
(22850, 1, 'objections', 'delete'),
(22851, 1, 'orders', 'list'),
(22852, 1, 'orders', 'view'),
(22853, 1, 'orders', 'add'),
(22854, 1, 'orders', 'edit'),
(22855, 1, 'orders', 'editfield'),
(22856, 1, 'orders', 'delete'),
(22857, 1, 'paper_notice', 'list'),
(22858, 1, 'paper_notice', 'view'),
(22859, 1, 'paper_notice', 'add'),
(22860, 1, 'paper_notice', 'edit'),
(22861, 1, 'paper_notice', 'editfield'),
(22862, 1, 'paper_notice', 'delete'),
(22863, 1, 'payments', 'list'),
(22864, 1, 'payments', 'view'),
(22865, 1, 'payments', 'add'),
(22866, 1, 'payments', 'edit'),
(22867, 1, 'payments', 'editfield'),
(22868, 1, 'payments', 'delete'),
(22869, 1, 'refund', 'list'),
(22870, 1, 'refund', 'view'),
(22871, 1, 'refund', 'add'),
(22872, 1, 'refund', 'edit'),
(22873, 1, 'refund', 'editfield'),
(22874, 1, 'refund', 'delete'),
(22875, 1, 'objections_payments', 'list'),
(22876, 1, 'objections_payments', 'view'),
(22877, 1, 'objections_payments', 'add'),
(22878, 1, 'objections_payments', 'edit'),
(22879, 1, 'objections_payments', 'editfield'),
(22880, 1, 'objections_payments', 'delete'),
(22881, 1, 'objections', 'edit2'),
(22882, 1, 'objections_hod_approval', 'list'),
(22883, 1, 'objections_hod_approval', 'view'),
(22884, 1, 'objections_hod_approval', 'add'),
(22885, 1, 'objections_hod_approval', 'edit'),
(22886, 1, 'objections_hod_approval', 'editfield'),
(22887, 1, 'objections_hod_approval', 'delete'),
(22888, 1, 'final_decision', 'list'),
(22889, 1, 'final_decision', 'view'),
(22890, 1, 'final_decision', 'add'),
(22891, 1, 'final_decision', 'edit'),
(22892, 1, 'final_decision', 'editfield'),
(22893, 1, 'final_decision', 'delete'),
(22894, 1, 'application_form', 'edit2'),
(22895, 1, 'photo_of_tree', 'list'),
(22896, 1, 'photo_of_tree', 'view'),
(22897, 1, 'photo_of_tree', 'add'),
(22898, 1, 'photo_of_tree', 'edit'),
(22899, 1, 'photo_of_tree', 'editfield'),
(22900, 1, 'photo_of_tree', 'delete'),
(22901, 1, 'photo_of_inspection', 'list'),
(22902, 1, 'photo_of_inspection', 'view'),
(22903, 1, 'photo_of_inspection', 'add'),
(22904, 1, 'photo_of_inspection', 'edit'),
(22905, 1, 'photo_of_inspection', 'editfield'),
(22906, 1, 'photo_of_inspection', 'delete'),
(22907, 1, 'photo_of_inspection_refund', 'list'),
(22908, 1, 'photo_of_inspection_refund', 'view'),
(22909, 1, 'photo_of_inspection_refund', 'add'),
(22910, 1, 'photo_of_inspection_refund', 'edit'),
(22911, 1, 'photo_of_inspection_refund', 'editfield'),
(22912, 1, 'photo_of_inspection_refund', 'delete'),
(22913, 1, 'refund_inspection', 'list'),
(22914, 1, 'refund_inspection', 'view'),
(22915, 1, 'refund_inspection', 'add'),
(22916, 1, 'refund_inspection', 'edit'),
(22917, 1, 'refund_inspection', 'editfield'),
(22918, 1, 'refund_inspection', 'delete'),
(22919, 1, 'refund', 'edit2'),
(22920, 1, 'ccav_orders', 'view'),
(22921, 1, 'ccav_orders', 'add'),
(22922, 1, 'ccav_orders', 'edit'),
(22923, 1, 'ccav_orders', 'editfield'),
(22924, 1, 'ccav_orders', 'delete'),
(22925, 1, 'login_token', 'view'),
(22926, 1, 'login_token', 'add'),
(22927, 1, 'login_token', 'edit'),
(22928, 1, 'login_token', 'editfield'),
(22929, 1, 'login_token', 'delete'),
(22930, 1, 'master_for_name_of_news_paper', 'list'),
(22931, 1, 'master_for_name_of_news_paper', 'view'),
(22932, 1, 'master_for_name_of_news_paper', 'add'),
(22933, 1, 'master_for_name_of_news_paper', 'edit'),
(22934, 1, 'master_for_name_of_news_paper', 'editfield'),
(22935, 1, 'master_for_name_of_news_paper', 'delete'),
(22936, 1, 'master_name_of_tree', 'list'),
(22937, 1, 'master_name_of_tree', 'view'),
(22938, 1, 'master_name_of_tree', 'add'),
(22939, 1, 'master_name_of_tree', 'edit'),
(22940, 1, 'master_name_of_tree', 'editfield'),
(22941, 1, 'master_name_of_tree', 'delete'),
(22942, 1, 'accept_reject', 'view'),
(22943, 1, 'accept_reject', 'add'),
(22944, 1, 'accept_reject', 'edit'),
(22945, 1, 'accept_reject', 'editfield'),
(22946, 1, 'accept_reject', 'delete'),
(22947, 1, 'application_form', 'view_tipnni'),
(22948, 1, 'application_form', 'view_permission'),
(22949, 1, 'application_form', 'edit_tipnni'),
(22950, 1, 'application_form', 'edit_permission'),
(22951, 1, 'certificate_data', 'view'),
(22952, 1, 'certificate_data', 'add'),
(22953, 1, 'certificate_data', 'edit'),
(22954, 1, 'certificate_data', 'editfield'),
(22955, 1, 'certificate_data', 'delete'),
(22956, 1, 'application_form', 'view_advt_tipnni'),
(22957, 1, 'accept_reject2', 'view'),
(22958, 1, 'accept_reject2', 'add'),
(22959, 1, 'accept_reject2', 'edit'),
(22960, 1, 'accept_reject2', 'editfield'),
(22961, 1, 'accept_reject2', 'delete'),
(22962, 1, 'authorization_sequence', 'view'),
(22963, 1, 'authorization_sequence', 'add'),
(22964, 1, 'authorization_sequence', 'edit'),
(22965, 1, 'authorization_sequence', 'editfield'),
(22966, 1, 'authorization_sequence', 'delete'),
(22967, 1, 'cc_photo_inspection', 'list'),
(22968, 1, 'cc_photo_inspection', 'view'),
(22969, 1, 'cc_photo_inspection', 'add'),
(22970, 1, 'cc_photo_inspection', 'edit'),
(22971, 1, 'cc_photo_inspection', 'editfield'),
(22972, 1, 'cc_photo_inspection', 'delete'),
(22973, 1, 'commencement_certificate', 'list'),
(22974, 1, 'commencement_certificate', 'view'),
(22975, 1, 'commencement_certificate', 'edit'),
(22976, 1, 'commencement_certificate', 'editfield'),
(22977, 1, 'commencement_certificate', 'delete'),
(22978, 1, 'occupancy_certificate', 'list'),
(22979, 1, 'occupancy_certificate', 'view'),
(22980, 1, 'occupancy_certificate', 'add'),
(22981, 1, 'occupancy_certificate', 'edit'),
(22982, 1, 'occupancy_certificate', 'editfield'),
(22983, 1, 'occupancy_certificate', 'delete'),
(22984, 1, 'payment2', 'list'),
(22985, 1, 'payment2', 'view'),
(22986, 1, 'payment2', 'add'),
(22987, 1, 'payment2', 'edit'),
(22988, 1, 'payment2', 'editfield'),
(22989, 1, 'payment2', 'delete'),
(22990, 1, 'commencement_certificate', 'inspection_report_upload'),
(22991, 1, 'commencement_certificate', 'tippni_upload'),
(22992, 1, 'commencement_certificate', 'tippni'),
(22993, 1, 'commencement_certificate', 'permission'),
(22994, 1, 'demand', 'list'),
(22995, 1, 'demand', 'view'),
(22996, 1, 'demand', 'add'),
(22997, 1, 'demand', 'edit'),
(22998, 1, 'demand', 'editfield'),
(22999, 1, 'demand', 'delete'),
(23000, 1, 'oc_photo_inspection', 'list'),
(23001, 1, 'oc_photo_inspection', 'view'),
(23002, 1, 'oc_photo_inspection', 'add'),
(23003, 1, 'oc_photo_inspection', 'edit'),
(23004, 1, 'oc_photo_inspection', 'editfield'),
(23005, 1, 'oc_photo_inspection', 'delete'),
(23006, 1, 'occupancy_certificate', 'inspection_report_upload'),
(23007, 1, 'occupancy_certificate', 'tippni_data'),
(23008, 1, 'commencement_certificate', 'permission_upload'),
(23009, 1, 'occupancy_certificate', 'tippni_upload'),
(23010, 1, 'occupancy_certificate', 'permission_upload'),
(23011, 1, 'occupancy_certificate', 'tippni'),
(23012, 1, 'tree_report_matrix', 'list'),
(23013, 1, 'tree_report_matrix', 'view'),
(23014, 1, 'tree_report_matrix', 'add'),
(23015, 1, 'tree_report_matrix', 'edit'),
(23016, 1, 'tree_report_matrix', 'editfield'),
(23017, 1, 'tree_report_matrix', 'delete'),
(23018, 1, 'occupancy_certificate', 'permission'),
(23019, 1, 'tippani_data', 'list'),
(23020, 1, 'tippani_data', 'view'),
(23021, 1, 'tippani_data', 'add'),
(23022, 1, 'tippani_data', 'edit'),
(23023, 1, 'tippani_data', 'editfield'),
(23024, 1, 'tippani_data', 'delete'),
(23025, 1, 'tree_matrix_subentry', 'list'),
(23026, 1, 'tree_matrix_subentry', 'view'),
(23027, 1, 'tree_matrix_subentry', 'add'),
(23028, 1, 'tree_matrix_subentry', 'edit'),
(23029, 1, 'tree_matrix_subentry', 'editfield'),
(23030, 1, 'tree_matrix_subentry', 'delete'),
(23031, 1, 'master_residence', 'list'),
(23032, 1, 'master_residence', 'view'),
(23033, 1, 'master_residence', 'add'),
(23034, 1, 'master_residence', 'edit'),
(23035, 1, 'master_residence', 'editfield'),
(23036, 1, 'master_residence', 'delete'),
(23037, 1, 'commencement_certificate', 'demand_button'),
(23038, 1, 'occupancy_certificate', 'demand_button'),
(23039, 1, 'commencement_certificate', 'tippni_data'),
(23040, 1, 'payments', 'view2'),
(23041, 1, 'payments', 'add2'),
(23042, 1, 'payments', 'add3'),
(23043, 1, 'payments', 'add4'),
(23044, 2, 'application_form', 'list'),
(23045, 2, 'application_form', 'add'),
(23046, 2, 'report_of_tree', 'list'),
(23047, 2, 'report_of_tree', 'add'),
(23048, 2, 'user_info', 'userregister'),
(23049, 2, 'user_info', 'accountedit'),
(23050, 2, 'user_info', 'accountview'),
(23051, 2, 'application_form', 'cert_view'),
(23052, 2, 'application_form', 'objection_advertise'),
(23053, 2, 'objections', 'list'),
(23054, 2, 'objections', 'add'),
(23055, 2, 'paper_notice', 'list'),
(23056, 2, 'paper_notice', 'view'),
(23057, 2, 'payments', 'view'),
(23058, 2, 'payments', 'add'),
(23059, 2, 'payments', 'edit'),
(23060, 2, 'payments', 'editfield'),
(23061, 2, 'refund', 'list'),
(23062, 2, 'objections_payments', 'view'),
(23063, 2, 'objections', 'edit2'),
(23064, 2, 'application_form', 'edit2'),
(23065, 2, 'photo_of_tree', 'list'),
(23066, 2, 'photo_of_tree', 'edit'),
(23067, 2, 'photo_of_tree', 'editfield'),
(23068, 2, 'refund', 'edit2'),
(23069, 2, 'application_form', 'view_tipnni'),
(23070, 2, 'application_form', 'view_permission'),
(23071, 2, 'application_form', 'edit_tipnni'),
(23072, 2, 'application_form', 'edit_permission'),
(23073, 2, 'application_form', 'view_advt_tipnni'),
(23074, 2, 'accept_reject2', 'list'),
(23075, 2, 'accept_reject2', 'view'),
(23076, 2, 'accept_reject2', 'add'),
(23077, 2, 'accept_reject2', 'edit'),
(23078, 2, 'accept_reject2', 'editfield'),
(23079, 2, 'accept_reject2', 'delete'),
(23080, 2, 'commencement_certificate', 'list'),
(23081, 2, 'commencement_certificate', 'add'),
(23082, 2, 'commencement_certificate', 'edit'),
(23083, 2, 'commencement_certificate', 'editfield'),
(23084, 2, 'occupancy_certificate', 'list'),
(23085, 2, 'occupancy_certificate', 'view'),
(23086, 2, 'occupancy_certificate', 'add'),
(23087, 2, 'occupancy_certificate', 'edit'),
(23088, 2, 'occupancy_certificate', 'editfield'),
(23089, 2, 'payment2', 'list'),
(23090, 2, 'payment2', 'view'),
(23091, 2, 'payment2', 'add'),
(23092, 2, 'payment2', 'edit'),
(23093, 2, 'payment2', 'editfield'),
(23094, 2, 'payment2', 'delete'),
(23095, 2, 'commencement_certificate', 'inspection_report_upload'),
(23096, 2, 'commencement_certificate', 'tippni_upload'),
(23097, 2, 'commencement_certificate', 'tippni'),
(23098, 2, 'commencement_certificate', 'permission'),
(23099, 2, 'demand', 'view'),
(23100, 2, 'oc_photo_inspection', 'list'),
(23101, 2, 'occupancy_certificate', 'inspection_report_upload'),
(23102, 2, 'occupancy_certificate', 'tippni_data'),
(23103, 2, 'commencement_certificate', 'permission_upload'),
(23104, 2, 'occupancy_certificate', 'tippni_upload'),
(23105, 2, 'occupancy_certificate', 'permission_upload'),
(23106, 2, 'occupancy_certificate', 'tippni'),
(23107, 2, 'tree_report_matrix', 'list'),
(23108, 2, 'tree_report_matrix', 'view'),
(23109, 2, 'tree_report_matrix', 'add'),
(23110, 2, 'occupancy_certificate', 'permission'),
(23111, 2, 'commencement_certificate', 'demand_button'),
(23112, 2, 'occupancy_certificate', 'demand_button'),
(23113, 2, 'commencement_certificate', 'tippni_data'),
(23114, 2, 'payments', 'view2'),
(23115, 2, 'payments', 'add2'),
(23116, 2, 'payments', 'add3'),
(23117, 2, 'payments', 'add4'),
(23118, 5, 'application_form', 'list'),
(23119, 5, 'application_form', 'cert_view'),
(23120, 5, 'application_form', 'postmortem'),
(23121, 5, 'application_form', 'objection_advertise'),
(23122, 5, 'objections', 'edit2'),
(23123, 5, 'application_form', 'edit2'),
(23124, 5, 'refund', 'edit2'),
(23125, 5, 'application_form', 'view_tipnni'),
(23126, 5, 'application_form', 'view_permission'),
(23127, 5, 'application_form', 'edit_tipnni'),
(23128, 5, 'application_form', 'edit_permission'),
(23129, 5, 'application_form', 'view_advt_tipnni'),
(23130, 5, 'commencement_certificate', 'inspection_report_upload'),
(23131, 5, 'commencement_certificate', 'tippni_upload'),
(23132, 5, 'commencement_certificate', 'tippni'),
(23133, 5, 'commencement_certificate', 'permission'),
(23134, 5, 'occupancy_certificate', 'inspection_report_upload'),
(23135, 5, 'occupancy_certificate', 'tippni_data'),
(23136, 5, 'commencement_certificate', 'permission_upload'),
(23137, 5, 'occupancy_certificate', 'tippni_upload'),
(23138, 5, 'occupancy_certificate', 'permission_upload'),
(23139, 5, 'occupancy_certificate', 'tippni'),
(23140, 5, 'occupancy_certificate', 'permission'),
(23141, 5, 'commencement_certificate', 'demand_button'),
(23142, 5, 'occupancy_certificate', 'demand_button'),
(23143, 5, 'commencement_certificate', 'tippni_data'),
(23144, 5, 'payments', 'view2'),
(23145, 5, 'payments', 'add2'),
(23146, 5, 'payments', 'add3'),
(23147, 5, 'payments', 'add4'),
(23148, 6, 'application_form', 'list'),
(23149, 6, 'application_form', 'cert_view'),
(23150, 6, 'application_form', 'postmortem'),
(23151, 6, 'application_form', 'objection_advertise'),
(23152, 6, 'objections', 'edit2'),
(23153, 6, 'application_form', 'edit2'),
(23154, 6, 'refund', 'edit2'),
(23155, 6, 'application_form', 'view_tipnni'),
(23156, 6, 'application_form', 'view_permission'),
(23157, 6, 'application_form', 'edit_tipnni'),
(23158, 6, 'application_form', 'edit_permission'),
(23159, 6, 'application_form', 'view_advt_tipnni'),
(23160, 6, 'commencement_certificate', 'inspection_report_upload'),
(23161, 6, 'commencement_certificate', 'tippni_upload'),
(23162, 6, 'commencement_certificate', 'tippni'),
(23163, 6, 'commencement_certificate', 'permission'),
(23164, 6, 'occupancy_certificate', 'inspection_report_upload'),
(23165, 6, 'occupancy_certificate', 'tippni_data'),
(23166, 6, 'commencement_certificate', 'permission_upload'),
(23167, 6, 'occupancy_certificate', 'tippni_upload'),
(23168, 6, 'occupancy_certificate', 'permission_upload'),
(23169, 6, 'occupancy_certificate', 'tippni'),
(23170, 6, 'occupancy_certificate', 'permission'),
(23171, 6, 'commencement_certificate', 'demand_button'),
(23172, 6, 'occupancy_certificate', 'demand_button'),
(23173, 6, 'commencement_certificate', 'tippni_data'),
(23174, 6, 'payments', 'view2'),
(23175, 6, 'payments', 'add2'),
(23176, 6, 'payments', 'add3'),
(23177, 6, 'payments', 'add4'),
(23178, 3, 'application_form', 'list'),
(23179, 3, 'report_of_tree', 'list'),
(23180, 3, 'application_form', 'licence'),
(23181, 3, 'application_form', 'cert_view'),
(23182, 3, 'application_form', 'refund'),
(23183, 3, 'application_form', 'postmortem'),
(23184, 3, 'application_form', 'objection_advertise'),
(23185, 3, 'objections', 'list'),
(23186, 3, 'objections', 'view'),
(23187, 3, 'payments', 'view'),
(23188, 3, 'payments', 'add'),
(23189, 3, 'payments', 'edit'),
(23190, 3, 'payments', 'editfield'),
(23191, 3, 'objections', 'edit2'),
(23192, 3, 'objections_hod_approval', 'list'),
(23193, 3, 'objections_hod_approval', 'edit'),
(23194, 3, 'objections_hod_approval', 'editfield'),
(23195, 3, 'application_form', 'edit2'),
(23196, 3, 'refund', 'edit2'),
(23197, 3, 'accept_reject', 'list'),
(23198, 3, 'accept_reject', 'add'),
(23199, 3, 'application_form', 'view_tipnni'),
(23200, 3, 'application_form', 'view_permission'),
(23201, 3, 'application_form', 'edit_tipnni'),
(23202, 3, 'application_form', 'edit_permission'),
(23203, 3, 'application_form', 'view_advt_tipnni'),
(23204, 3, 'commencement_certificate', 'inspection_report_upload'),
(23205, 3, 'commencement_certificate', 'tippni_upload'),
(23206, 3, 'commencement_certificate', 'tippni'),
(23207, 3, 'commencement_certificate', 'permission'),
(23208, 3, 'occupancy_certificate', 'inspection_report_upload'),
(23209, 3, 'occupancy_certificate', 'tippni_data'),
(23210, 3, 'commencement_certificate', 'permission_upload'),
(23211, 3, 'occupancy_certificate', 'tippni_upload'),
(23212, 3, 'occupancy_certificate', 'permission_upload'),
(23213, 3, 'occupancy_certificate', 'tippni'),
(23214, 3, 'occupancy_certificate', 'permission'),
(23215, 3, 'commencement_certificate', 'demand_button'),
(23216, 3, 'occupancy_certificate', 'demand_button'),
(23217, 3, 'commencement_certificate', 'tippni_data'),
(23218, 3, 'payments', 'view2'),
(23219, 3, 'payments', 'add2'),
(23220, 3, 'payments', 'add3'),
(23221, 3, 'payments', 'add4'),
(23222, 13, 'application_form', 'list'),
(23223, 13, 'application_form', 'view'),
(23224, 13, 'inspection', 'view'),
(23225, 13, 'inspection', 'add'),
(23226, 13, 'objections', 'list'),
(23227, 13, 'objections', 'view'),
(23228, 13, 'objections', 'add'),
(23229, 13, 'objections', 'edit'),
(23230, 13, 'objections', 'editfield'),
(23231, 13, 'objections', 'edit2'),
(23232, 13, 'orders', 'view'),
(23233, 13, 'orders', 'add'),
(23234, 13, 'paper_notice', 'list'),
(23235, 13, 'paper_notice', 'view'),
(23236, 13, 'paper_notice', 'add'),
(23237, 13, 'payments', 'view'),
(23238, 13, 'payments', 'add'),
(23239, 13, 'payments', 'edit'),
(23240, 13, 'payments', 'editfield'),
(23241, 13, 'objections_payments', 'view'),
(23242, 13, 'photo_of_tree', 'list'),
(23243, 13, 'photo_of_inspection', 'list'),
(23244, 13, 'photo_of_inspection', 'edit'),
(23245, 13, 'photo_of_inspection', 'editfield'),
(23246, 13, 'accept_reject', 'list'),
(23247, 13, 'accept_reject', 'view'),
(23248, 13, 'accept_reject', 'add'),
(23249, 13, 'accept_reject', 'edit'),
(23250, 13, 'accept_reject', 'editfield'),
(23251, 13, 'accept_reject', 'delete'),
(23252, 13, 'application_form', 'view_tipnni'),
(23253, 13, 'application_form', 'view_permission'),
(23254, 13, 'application_form', 'edit_tipnni'),
(23255, 13, 'application_form', 'edit_permission'),
(23256, 13, 'application_form', 'view_advt_tipnni'),
(23257, 13, 'accept_reject2', 'list'),
(23258, 13, 'accept_reject2', 'view'),
(23259, 13, 'accept_reject2', 'add'),
(23260, 13, 'accept_reject2', 'edit'),
(23261, 13, 'accept_reject2', 'editfield'),
(23262, 13, 'accept_reject2', 'delete'),
(23263, 13, 'cc_photo_inspection', 'list'),
(23264, 13, 'cc_photo_inspection', 'view'),
(23265, 13, 'cc_photo_inspection', 'add'),
(23266, 13, 'cc_photo_inspection', 'edit'),
(23267, 13, 'cc_photo_inspection', 'editfield'),
(23268, 13, 'cc_photo_inspection', 'delete'),
(23269, 13, 'commencement_certificate', 'list'),
(23270, 13, 'commencement_certificate', 'view'),
(23271, 13, 'commencement_certificate', 'add'),
(23272, 13, 'commencement_certificate', 'edit'),
(23273, 13, 'commencement_certificate', 'editfield'),
(23274, 13, 'commencement_certificate', 'delete'),
(23275, 13, 'occupancy_certificate', 'list'),
(23276, 13, 'occupancy_certificate', 'view'),
(23277, 13, 'occupancy_certificate', 'add'),
(23278, 13, 'occupancy_certificate', 'edit'),
(23279, 13, 'occupancy_certificate', 'editfield'),
(23280, 13, 'occupancy_certificate', 'delete'),
(23281, 13, 'payment2', 'list'),
(23282, 13, 'payment2', 'view'),
(23283, 13, 'payment2', 'add'),
(23284, 13, 'payment2', 'edit'),
(23285, 13, 'payment2', 'editfield'),
(23286, 13, 'payment2', 'delete'),
(23287, 13, 'commencement_certificate', 'inspection_report_upload'),
(23288, 13, 'commencement_certificate', 'tippni_upload'),
(23289, 13, 'commencement_certificate', 'tippni'),
(23290, 13, 'commencement_certificate', 'permission'),
(23291, 13, 'demand', 'list'),
(23292, 13, 'demand', 'view'),
(23293, 13, 'demand', 'add'),
(23294, 13, 'oc_photo_inspection', 'list'),
(23295, 13, 'oc_photo_inspection', 'view'),
(23296, 13, 'oc_photo_inspection', 'add'),
(23297, 13, 'occupancy_certificate', 'inspection_report_upload'),
(23298, 13, 'occupancy_certificate', 'tippni_data'),
(23299, 13, 'commencement_certificate', 'permission_upload'),
(23300, 13, 'occupancy_certificate', 'tippni_upload'),
(23301, 13, 'occupancy_certificate', 'permission_upload'),
(23302, 13, 'occupancy_certificate', 'tippni'),
(23303, 13, 'occupancy_certificate', 'permission'),
(23304, 13, 'tippani_data', 'list');
INSERT INTO `role_permissions` (`permission_id`, `role_id`, `page_name`, `action_name`) VALUES
(23305, 13, 'tippani_data', 'view'),
(23306, 13, 'tippani_data', 'add'),
(23307, 13, 'tippani_data', 'edit'),
(23308, 13, 'tippani_data', 'editfield'),
(23309, 13, 'tippani_data', 'delete'),
(23310, 13, 'commencement_certificate', 'demand_button'),
(23311, 13, 'occupancy_certificate', 'demand_button'),
(23312, 13, 'commencement_certificate', 'tippni_data'),
(23313, 13, 'payments', 'view2'),
(23314, 13, 'payments', 'add2'),
(23315, 13, 'payments', 'add3'),
(23316, 13, 'payments', 'add4'),
(23317, 12, 'application_form', 'list'),
(23318, 12, 'application_form', 'view'),
(23319, 12, 'application_form', 'add'),
(23320, 12, 'application_form', 'edit'),
(23321, 12, 'application_form', 'editfield'),
(23322, 12, 'application_form', 'delete'),
(23323, 12, 'application_form', 'licence'),
(23324, 12, 'application_form', 'cert_view'),
(23325, 12, 'application_form', 'refund'),
(23326, 12, 'application_form', 'postmortem'),
(23327, 12, 'application_form', 'objection_advertise'),
(23328, 12, 'application_form', 'edit2'),
(23329, 12, 'application_form', 'view_tipnni'),
(23330, 12, 'application_form', 'view_permission'),
(23331, 12, 'application_form', 'edit_tipnni'),
(23332, 12, 'application_form', 'edit_permission'),
(23333, 12, 'application_form', 'view_advt_tipnni'),
(23334, 12, 'application_form', 'import_data'),
(23335, 12, 'report_of_tree', 'list'),
(23336, 12, 'report_of_tree', 'view'),
(23337, 12, 'report_of_tree', 'add'),
(23338, 12, 'report_of_tree', 'edit'),
(23339, 12, 'report_of_tree', 'editfield'),
(23340, 12, 'report_of_tree', 'delete'),
(23341, 12, 'report_of_tree', 'import_data'),
(23342, 12, 'user_info', 'list'),
(23343, 12, 'user_info', 'view'),
(23344, 12, 'user_info', 'userregister'),
(23345, 12, 'user_info', 'accountedit'),
(23346, 12, 'user_info', 'accountview'),
(23347, 12, 'user_info', 'add'),
(23348, 12, 'user_info', 'edit'),
(23349, 12, 'user_info', 'editfield'),
(23350, 12, 'user_info', 'delete'),
(23351, 12, 'user_info', 'import_data'),
(23352, 12, 'role_permissions', 'list'),
(23353, 12, 'role_permissions', 'view'),
(23354, 12, 'role_permissions', 'add'),
(23355, 12, 'role_permissions', 'edit'),
(23356, 12, 'role_permissions', 'editfield'),
(23357, 12, 'role_permissions', 'delete'),
(23358, 12, 'role_permissions', 'import_data'),
(23359, 12, 'roles', 'list'),
(23360, 12, 'roles', 'view'),
(23361, 12, 'roles', 'add'),
(23362, 12, 'roles', 'edit'),
(23363, 12, 'roles', 'editfield'),
(23364, 12, 'roles', 'delete'),
(23365, 12, 'roles', 'import_data'),
(23366, 12, 'name_designation_master', 'list'),
(23367, 12, 'name_designation_master', 'view'),
(23368, 12, 'name_designation_master', 'add'),
(23369, 12, 'name_designation_master', 'edit'),
(23370, 12, 'name_designation_master', 'editfield'),
(23371, 12, 'name_designation_master', 'delete'),
(23372, 12, 'name_designation_master', 'import_data'),
(23373, 12, 'master_zone', 'list'),
(23374, 12, 'master_zone', 'view'),
(23375, 12, 'master_zone', 'add'),
(23376, 12, 'master_zone', 'edit'),
(23377, 12, 'master_zone', 'editfield'),
(23378, 12, 'master_zone', 'delete'),
(23379, 12, 'master_zone', 'import_data'),
(23380, 12, 'inspection', 'list'),
(23381, 12, 'inspection', 'view'),
(23382, 12, 'inspection', 'add'),
(23383, 12, 'inspection', 'edit'),
(23384, 12, 'inspection', 'editfield'),
(23385, 12, 'inspection', 'delete'),
(23386, 12, 'inspection', 'import_data'),
(23387, 12, 'objections', 'list'),
(23388, 12, 'objections', 'view'),
(23389, 12, 'objections', 'add'),
(23390, 12, 'objections', 'edit'),
(23391, 12, 'objections', 'editfield'),
(23392, 12, 'objections', 'delete'),
(23393, 12, 'objections', 'edit2'),
(23394, 12, 'objections', 'import_data'),
(23395, 12, 'orders', 'list'),
(23396, 12, 'orders', 'view'),
(23397, 12, 'orders', 'add'),
(23398, 12, 'orders', 'edit'),
(23399, 12, 'orders', 'editfield'),
(23400, 12, 'orders', 'delete'),
(23401, 12, 'orders', 'import_data'),
(23402, 12, 'paper_notice', 'list'),
(23403, 12, 'paper_notice', 'view'),
(23404, 12, 'paper_notice', 'add'),
(23405, 12, 'paper_notice', 'edit'),
(23406, 12, 'paper_notice', 'editfield'),
(23407, 12, 'paper_notice', 'delete'),
(23408, 12, 'paper_notice', 'import_data'),
(23409, 12, 'payments', 'list'),
(23410, 12, 'payments', 'view'),
(23411, 12, 'payments', 'add'),
(23412, 12, 'payments', 'edit'),
(23413, 12, 'payments', 'editfield'),
(23414, 12, 'payments', 'delete'),
(23415, 12, 'payments', 'import_data'),
(23416, 12, 'refund', 'list'),
(23417, 12, 'refund', 'view'),
(23418, 12, 'refund', 'add'),
(23419, 12, 'refund', 'edit'),
(23420, 12, 'refund', 'editfield'),
(23421, 12, 'refund', 'delete'),
(23422, 12, 'refund', 'edit2'),
(23423, 12, 'refund', 'import_data'),
(23424, 12, 'objections_payments', 'list'),
(23425, 12, 'objections_payments', 'view'),
(23426, 12, 'objections_payments', 'add'),
(23427, 12, 'objections_payments', 'edit'),
(23428, 12, 'objections_payments', 'editfield'),
(23429, 12, 'objections_payments', 'delete'),
(23430, 12, 'objections_payments', 'import_data'),
(23431, 12, 'objections_hod_approval', 'list'),
(23432, 12, 'objections_hod_approval', 'view'),
(23433, 12, 'objections_hod_approval', 'add'),
(23434, 12, 'objections_hod_approval', 'edit'),
(23435, 12, 'objections_hod_approval', 'editfield'),
(23436, 12, 'objections_hod_approval', 'delete'),
(23437, 12, 'objections_hod_approval', 'import_data'),
(23438, 12, 'final_decision', 'list'),
(23439, 12, 'final_decision', 'view'),
(23440, 12, 'final_decision', 'add'),
(23441, 12, 'final_decision', 'edit'),
(23442, 12, 'final_decision', 'editfield'),
(23443, 12, 'final_decision', 'delete'),
(23444, 12, 'final_decision', 'import_data'),
(23445, 12, 'photo_of_tree', 'list'),
(23446, 12, 'photo_of_tree', 'view'),
(23447, 12, 'photo_of_tree', 'add'),
(23448, 12, 'photo_of_tree', 'edit'),
(23449, 12, 'photo_of_tree', 'editfield'),
(23450, 12, 'photo_of_tree', 'delete'),
(23451, 12, 'photo_of_tree', 'import_data'),
(23452, 12, 'photo_of_inspection', 'list'),
(23453, 12, 'photo_of_inspection', 'view'),
(23454, 12, 'photo_of_inspection', 'add'),
(23455, 12, 'photo_of_inspection', 'edit'),
(23456, 12, 'photo_of_inspection', 'editfield'),
(23457, 12, 'photo_of_inspection', 'delete'),
(23458, 12, 'photo_of_inspection', 'import_data'),
(23459, 12, 'photo_of_inspection_refund', 'list'),
(23460, 12, 'photo_of_inspection_refund', 'view'),
(23461, 12, 'photo_of_inspection_refund', 'add'),
(23462, 12, 'photo_of_inspection_refund', 'edit'),
(23463, 12, 'photo_of_inspection_refund', 'editfield'),
(23464, 12, 'photo_of_inspection_refund', 'delete'),
(23465, 12, 'photo_of_inspection_refund', 'import_data'),
(23466, 12, 'refund_inspection', 'list'),
(23467, 12, 'refund_inspection', 'view'),
(23468, 12, 'refund_inspection', 'add'),
(23469, 12, 'refund_inspection', 'edit'),
(23470, 12, 'refund_inspection', 'editfield'),
(23471, 12, 'refund_inspection', 'delete'),
(23472, 12, 'refund_inspection', 'import_data'),
(23473, 12, 'ccav_orders', 'list'),
(23474, 12, 'ccav_orders', 'view'),
(23475, 12, 'ccav_orders', 'add'),
(23476, 12, 'ccav_orders', 'edit'),
(23477, 12, 'ccav_orders', 'editfield'),
(23478, 12, 'ccav_orders', 'delete'),
(23479, 12, 'ccav_orders', 'import_data'),
(23480, 12, 'login_token', 'list'),
(23481, 12, 'login_token', 'view'),
(23482, 12, 'login_token', 'add'),
(23483, 12, 'login_token', 'edit'),
(23484, 12, 'login_token', 'editfield'),
(23485, 12, 'login_token', 'delete'),
(23486, 12, 'login_token', 'import_data'),
(23487, 12, 'master_for_name_of_news_paper', 'list'),
(23488, 12, 'master_for_name_of_news_paper', 'view'),
(23489, 12, 'master_for_name_of_news_paper', 'add'),
(23490, 12, 'master_for_name_of_news_paper', 'edit'),
(23491, 12, 'master_for_name_of_news_paper', 'editfield'),
(23492, 12, 'master_for_name_of_news_paper', 'delete'),
(23493, 12, 'master_for_name_of_news_paper', 'import_data'),
(23494, 12, 'master_name_of_tree', 'list'),
(23495, 12, 'master_name_of_tree', 'view'),
(23496, 12, 'master_name_of_tree', 'add'),
(23497, 12, 'master_name_of_tree', 'edit'),
(23498, 12, 'master_name_of_tree', 'editfield'),
(23499, 12, 'master_name_of_tree', 'delete'),
(23500, 12, 'master_name_of_tree', 'import_data'),
(23501, 12, 'accept_reject', 'list'),
(23502, 12, 'accept_reject', 'view'),
(23503, 12, 'accept_reject', 'add'),
(23504, 12, 'accept_reject', 'edit'),
(23505, 12, 'accept_reject', 'editfield'),
(23506, 12, 'accept_reject', 'delete'),
(23507, 12, 'accept_reject', 'import_data'),
(23508, 12, 'certificate_data', 'list'),
(23509, 12, 'certificate_data', 'view'),
(23510, 12, 'certificate_data', 'add'),
(23511, 12, 'certificate_data', 'edit'),
(23512, 12, 'certificate_data', 'editfield'),
(23513, 12, 'certificate_data', 'delete'),
(23514, 12, 'certificate_data', 'import_data'),
(23515, 12, 'accept_reject2', 'list'),
(23516, 12, 'accept_reject2', 'view'),
(23517, 12, 'accept_reject2', 'add'),
(23518, 12, 'accept_reject2', 'edit'),
(23519, 12, 'accept_reject2', 'editfield'),
(23520, 12, 'accept_reject2', 'delete'),
(23521, 12, 'accept_reject2', 'import_data'),
(23522, 12, 'authorization_sequence', 'list'),
(23523, 12, 'authorization_sequence', 'view'),
(23524, 12, 'authorization_sequence', 'add'),
(23525, 12, 'authorization_sequence', 'edit'),
(23526, 12, 'authorization_sequence', 'editfield'),
(23527, 12, 'authorization_sequence', 'delete'),
(23528, 12, 'authorization_sequence', 'import_data'),
(23529, 12, 'cc_photo_inspection', 'list'),
(23530, 12, 'cc_photo_inspection', 'view'),
(23531, 12, 'cc_photo_inspection', 'add'),
(23532, 12, 'cc_photo_inspection', 'edit'),
(23533, 12, 'cc_photo_inspection', 'editfield'),
(23534, 12, 'cc_photo_inspection', 'delete'),
(23535, 12, 'cc_photo_inspection', 'import_data'),
(23536, 12, 'commencement_certificate', 'list'),
(23537, 12, 'commencement_certificate', 'view'),
(23538, 12, 'commencement_certificate', 'add'),
(23539, 12, 'commencement_certificate', 'edit'),
(23540, 12, 'commencement_certificate', 'editfield'),
(23541, 12, 'commencement_certificate', 'delete'),
(23542, 12, 'commencement_certificate', 'inspection_report_upload'),
(23543, 12, 'commencement_certificate', 'tippni_upload'),
(23544, 12, 'commencement_certificate', 'tippni'),
(23545, 12, 'commencement_certificate', 'permission'),
(23546, 12, 'commencement_certificate', 'permission_upload'),
(23547, 12, 'commencement_certificate', 'demand_button'),
(23548, 12, 'commencement_certificate', 'tippni_data'),
(23549, 12, 'commencement_certificate', 'import_data'),
(23550, 12, 'occupancy_certificate', 'list'),
(23551, 12, 'occupancy_certificate', 'view'),
(23552, 12, 'occupancy_certificate', 'add'),
(23553, 12, 'occupancy_certificate', 'edit'),
(23554, 12, 'occupancy_certificate', 'editfield'),
(23555, 12, 'occupancy_certificate', 'delete'),
(23556, 12, 'occupancy_certificate', 'inspection_report_upload'),
(23557, 12, 'occupancy_certificate', 'tippni_data'),
(23558, 12, 'occupancy_certificate', 'tippni_upload'),
(23559, 12, 'occupancy_certificate', 'permission_upload'),
(23560, 12, 'occupancy_certificate', 'tippni'),
(23561, 12, 'occupancy_certificate', 'permission'),
(23562, 12, 'occupancy_certificate', 'demand_button'),
(23563, 12, 'occupancy_certificate', 'import_data'),
(23564, 12, 'payment2', 'list'),
(23565, 12, 'payment2', 'view'),
(23566, 12, 'payment2', 'add'),
(23567, 12, 'payment2', 'edit'),
(23568, 12, 'payment2', 'editfield'),
(23569, 12, 'payment2', 'delete'),
(23570, 12, 'payment2', 'import_data'),
(23571, 12, 'demand', 'list'),
(23572, 12, 'demand', 'view'),
(23573, 12, 'demand', 'add'),
(23574, 12, 'demand', 'edit'),
(23575, 12, 'demand', 'editfield'),
(23576, 12, 'demand', 'delete'),
(23577, 12, 'demand', 'import_data'),
(23578, 12, 'oc_photo_inspection', 'list'),
(23579, 12, 'oc_photo_inspection', 'view'),
(23580, 12, 'oc_photo_inspection', 'add'),
(23581, 12, 'oc_photo_inspection', 'edit'),
(23582, 12, 'oc_photo_inspection', 'editfield'),
(23583, 12, 'oc_photo_inspection', 'delete'),
(23584, 12, 'oc_photo_inspection', 'import_data'),
(23585, 12, 'tree_report_matrix', 'list'),
(23586, 12, 'tree_report_matrix', 'view'),
(23587, 12, 'tree_report_matrix', 'add'),
(23588, 12, 'tree_report_matrix', 'edit'),
(23589, 12, 'tree_report_matrix', 'editfield'),
(23590, 12, 'tree_report_matrix', 'delete'),
(23591, 12, 'tree_report_matrix', 'import_data'),
(23592, 12, 'tippani_data', 'list'),
(23593, 12, 'tippani_data', 'view'),
(23594, 12, 'tippani_data', 'add'),
(23595, 12, 'tippani_data', 'edit'),
(23596, 12, 'tippani_data', 'editfield'),
(23597, 12, 'tippani_data', 'delete'),
(23598, 12, 'tippani_data', 'import_data'),
(23599, 12, 'tree_matrix_subentry', 'list'),
(23600, 12, 'tree_matrix_subentry', 'view'),
(23601, 12, 'tree_matrix_subentry', 'add'),
(23602, 12, 'tree_matrix_subentry', 'edit'),
(23603, 12, 'tree_matrix_subentry', 'editfield'),
(23604, 12, 'tree_matrix_subentry', 'delete'),
(23605, 12, 'tree_matrix_subentry', 'import_data'),
(23606, 12, 'master_residence', 'list'),
(23607, 12, 'master_residence', 'view'),
(23608, 12, 'master_residence', 'add'),
(23609, 12, 'master_residence', 'edit'),
(23610, 12, 'master_residence', 'editfield'),
(23611, 12, 'master_residence', 'delete'),
(23612, 12, 'master_residence', 'import_data'),
(23613, 12, 'payments', 'view2'),
(23614, 12, 'payments', 'add2'),
(23615, 12, 'payments', 'add3'),
(23616, 12, 'payments', 'add4'),
(23617, 2, 'cc_photo_inspection', 'list'),
(23618, 2, 'oc_photo_inspection', 'list'),
(23619, 2, 'commencement_certificate', 'revert'),
(23620, 10, 'api', 'offlineredirect'),
(23621, 1, 'occupancy_certificate', 'csv_report_oc'),
(23622, 3, 'occupancy_certificate', 'csv_report_oc'),
(23623, 10, 'occupancy_certificate', 'csv_report_oc'),
(23624, 12, 'occupancy_certificate', 'csv_report_oc'),
(23625, 3, 'commencement_certificate', 'csv_report'),
(23626, 10, 'commencement_certificate', 'csv_report'),
(23627, 12, 'commencement_certificate', 'csv_report'),
(23628, 1, 'commencement_certificate', 'csv_report'),
(23629, 7, 'commencement_certificate', 'csv_report'),
(23630, 9, 'commencement_certificate', 'csv_report'),
(23631, 7, 'occupancy_certificate', 'csv_report_oc'),
(23632, 9, 'occupancy_certificate', 'csv_report_oc'),
(23633, 12, 'oc_photo_inspection', '7'),
(23634, 7, 'oc_photo_inspection', 'delete'),
(23635, 7, 'oc_photo_inspection', 'edit');

-- --------------------------------------------------------

--
-- Table structure for table `temp_data`
--

CREATE TABLE `temp_data` (
  `id` int(11) NOT NULL,
  `tablename` varchar(255) NOT NULL,
  `field` varchar(255) NOT NULL,
  `user_id` varchar(255) NOT NULL,
  `value` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tippani_data`
--

CREATE TABLE `tippani_data` (
  `id` int(11) NOT NULL,
  `rec_id` int(11) NOT NULL,
  `db_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `application_number` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `application_date` date NOT NULL,
  `town_planning_cc_date` date NOT NULL,
  `cc_not_taken_remark` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `village_and_survey_number` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `number_of_trees_to_be_planted` int(11) NOT NULL,
  `name_of_trees_to_be_planted` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `tippni_data` text COLLATE utf8_unicode_ci NOT NULL,
  `building_address_details` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tree_matrix_subentry`
--

CREATE TABLE `tree_matrix_subentry` (
  `id` int(11) NOT NULL,
  `rec_id` int(11) NOT NULL,
  `photos` varchar(255) NOT NULL,
  `remark` text NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tree_report_matrix`
--

CREATE TABLE `tree_report_matrix` (
  `id` int(11) NOT NULL,
  `rec_id` int(11) NOT NULL,
  `date` varchar(255) NOT NULL,
  `report` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `user_info`
--

CREATE TABLE `user_info` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `login_session_key` varchar(255) DEFAULT NULL,
  `email_status` varchar(255) DEFAULT NULL,
  `password_expire_date` datetime DEFAULT '2024-02-16 00:00:00',
  `password_reset_key` varchar(255) DEFAULT NULL,
  `user_role_id` int(11) NOT NULL,
  `ward` varchar(255) NOT NULL,
  `mobile_number` varchar(255) NOT NULL,
  `applicant_full_name` varchar(255) NOT NULL,
  `applicant_address` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_info`
--

INSERT INTO `user_info` (`id`, `username`, `password`, `email`, `login_session_key`, `email_status`, `password_expire_date`, `password_reset_key`, `user_role_id`, `ward`, `mobile_number`, `applicant_full_name`, `applicant_address`) VALUES
(1, 'admin', '$2y$10$jGXwrI4HKTAWem2CZTzw2OnYIdVqZhEI/f2sbnKdDyLGB3GENGs3.', 'admin@admin.com', 'fb42fcce3b7b72029aab64777fecb9a2', NULL, '2024-02-16 00:00:00', NULL, 1, '', '', '', ''),
(42, 'auth1', '$2y$10$W3H2W.sxGNsHiC5Ch14Q8udMTImdydC5CmOTe/9UVoCTaKwlrd8na', 'as@a.com', '46f05b3947ce1ff8e9c073f148e60232', NULL, '2024-02-16 00:00:00', NULL, 4, '', '', '', ''),
(43, 'hod', '$2y$10$pKnWVzSD3PERLRS.28Jd/eVsE2blKNisqb3RySLN34j5.JIOy8OXG', 'sd@as.in', 'a3894ab02eb688e53f0a0d5dab3af3e7', NULL, '2024-02-16 00:00:00', NULL, 3, '', '', '', ''),
(51, 'h', '$2y$10$FQ6VN89rZth5/ziTtcXwqOwD6022R22H/xYuKcBYDeNkZeDet5vOu', 'h@h.com', NULL, NULL, '2024-02-16 00:00:00', NULL, 1, '', '', '', ''),
(52, 'cg', '$2y$10$0EJRMH55mfbTCJU2wcj1AegStzWJ2wFoCUbDogvGyj2IS0NNTr4Zq', '1@cg.in', '1d684befb715872cfa1c7a4eabaea937', NULL, '2024-02-16 00:00:00', NULL, 7, 'A', '', '', ''),
(60, 'demo', '$2y$10$T.WIGk/60Rd8RC0A1uPo2eGWBF9GUS7WfMbqtIHWmxhnBoUhLJ7FO', 'deadshot9987@gmail.com', NULL, NULL, '2024-02-16 00:00:00', NULL, 1, 'A', '', '', ''),
(79, 'cg_b', '$2y$10$2OH7dbIH2su4lrvEcaNm1e0yT8OqfFOvu2fGuo69LIRQX1HbTZQL.', 'cg@vvcmc.com', '41dda564e49e7a0103f0571dfb77eeb9', NULL, '2024-02-16 00:00:00', NULL, 7, 'B', '', '', ''),
(80, 'cg_c', '$2y$10$dLc.CWj1SS/gIt.xyI7AYec7WMtaTaMp11JJ8V1vDYHdNF7GvWFCq', 'cgc@vvcmc.com', 'b42378c903ee8a391f2b32e31dd04371', NULL, '2024-02-16 00:00:00', NULL, 7, 'C', '', '', ''),
(81, 'cg_d', '$2y$10$vDfwF1.Dcm2TYZaWw2Ufjedqe9SIQk9NF1Cl/FORwo1vf1VdOaCTm', 'cgd@vvcmc.com', '78c09fe9e5c074fe9ba9cb79035968ee', NULL, '2024-02-16 00:00:00', NULL, 7, 'D', '', '', ''),
(82, 'Cg_e', '$2y$10$kajHd12KuOysfFRaVqCyEOsvInnld1HY1RqXHOYgpPq2GDH9brjIi', 'cge@vvcmc.com', 'b123b9d2fae95147255621b513ec9774', NULL, '2024-02-16 00:00:00', NULL, 7, 'E', '', '', ''),
(87, 'cg_f', '$2y$10$zRPjAGikJ3BAn2oZ2z/guuVRpK5GHb1yAdtZBuK1Lg6A/WVWJaZjm', 'cgf@vvcmc.com', '55ba3ca5dce3d9af907e738201569cda', NULL, '2024-02-16 00:00:00', NULL, 7, 'F', '', '', ''),
(88, 'cg_g', '$2y$10$XNk7OKzNXLVfCZlhzdT8/eGo6cdiyEwhnKsR1vEPwBxIClpf9hhDu', 'cgg@vvcmc.com', '9f9700ccb2734a7e449c5114666c6457', NULL, '2024-02-16 00:00:00', NULL, 7, 'G', '', '', ''),
(89, 'cg_h', '$2y$10$xUi0RWQYhoDTNqPS/bZSS.tguVU4I4uzZBN7F9llt5YtadG4nG7Di', 'cgh@vvcmc.com', '2f2abb19b12b9d2929c5e56b1287d2e1', NULL, '2024-02-16 00:00:00', NULL, 7, 'H', '', '', ''),
(90, 'Cg_i', '$2y$10$vVmUqEUz3KKbVbsl8A9MKew4zxhe8q27GVeUlAsJbjQHJ2G3DxcdO', 'cgi@vvcmc.com', '213a9bccfb0e78db717e2f2202e929be', NULL, '2024-02-16 00:00:00', NULL, 7, 'I', '', '', ''),
(106, 'superadmin', '$2y$10$Kv7WlHeRGU6jdZI6vZj79.XSw4XOKr22lwWCjesEHgBqNAKdVeo3i', 'superadmin@gmail.com', NULL, NULL, '2024-02-16 00:00:00', NULL, 12, 'A', '', '', ''),
(107, 'gar_sup', '$2y$10$dXC46TVBZvQtbmhGtdEwEOfpl7FNy5DrT6FLOfDGw7pXnM1QGqt3y', 'Gs@vvmc.com', '4899ebbb6846cee0db0edf4dc02bb1e6', NULL, '2024-02-16 00:00:00', NULL, 9, 'A', '', '', ''),
(108, 'ho_dmc', '$2y$10$XrBozslJySzUBjazRqkOkOgk5XKcoW6TpH7JPyLGnilHCRL1m.Rni', 'Dmc@vvmc.com', NULL, NULL, '2024-02-16 00:00:00', NULL, 10, 'A', '', '', ''),
(109, 'gs', '$2y$10$y5QqkaITwCIHkeJiD0OGR.oqnyYqpv82le6qcdjDs05MESnyLXXUe', 'gsa@gmail.com', NULL, NULL, '2024-02-16 00:00:00', NULL, 9, 'A', '', '', ''),
(111, 'dmc1', '$2y$10$pKnWVzSD3PERLRS.28Jd/eVsE2blKNisqb3RySLN34j5.JIOy8OXG', 'test@dss.com', NULL, NULL, '2024-02-16 00:00:00', NULL, 10, 'a', '', '', ''),
(112, 'dmc2', '$2y$10$W27TnVkG/g3PZoSa3CJw8OU.gl29FLRrQiior/u6idBKIsovKDlk6', 'dmcb@gmail.com', NULL, NULL, '2024-02-16 00:00:00', NULL, 10, 'B', '', '', ''),
(217, 'CGS0001', '$2y$10$YX42RD0kTxDL1tuP54MBbuoXLtv7ksYz6ulgsnlHuFRXWUEQVwm1q', 'sanjaykdmc@gmail.com', '55c342f490032b478e652a925df2a83d', NULL, '2024-02-16 00:00:00', NULL, 10, '', '9224583840', 'SANJAY JADHAV', 'KDMC'),
(218, 'GSUP002', '$2y$10$7CwZ/4kuv3ZFsB/TsgvcKOZDG39S6KPz/Jf0sNoq4922TH1o8N7li', 'aniltamorekdmc@gmail.com', NULL, NULL, '2024-02-16 00:00:00', NULL, 9, '', '9221717223', 'ANIL TAMORE', 'KDMC'),
(219, 'GINSP003', '$2y$10$MF.xSPa78SJz8y5xEPhwF.OpNbkZYBVHqsDMmOzbUT./loxTAm/rK', 'snehal2085@gmail.com', '39da78dd530cbf0926f7f3f38bacdd84', NULL, '2024-02-16 00:00:00', NULL, 7, '', '9967663517', 'SNEHAL DHANDE', 'KDMC'),
(226, 'gispb', '$2y$10$ScYSayTP623IquWNzMrPQetUAd7wud/.4CCy/mzv/RsTjewyp17kW', '1@gispb1.com', NULL, NULL, '2024-02-16 00:00:00', NULL, 7, 'B', '1000000000', '123456789', '123123456789'),
(244, 'KDMCC-25-121047_515740', 'xyz_auto', 'emergearchitect@gmail.com', '49a1ca24d33139eb0d7c6cd53e18f442', NULL, '2024-02-16 00:00:00', NULL, 2, '', '', '', ''),
(245, 'KDMCC-25-ENTRY-129478_525100', 'xyz_auto', 'rkassociates0805@gmail.com', '6bc14327ddf69bd9d617219b38607161', NULL, '2024-02-16 00:00:00', NULL, 2, '', '', '', ''),
(246, 'KDMCC-25-104418_497518', 'xyz_auto', 'sandy.patil78@yahoo.com', '0b5f930299adfc49cbac7eba33192fc6', NULL, '2024-02-16 00:00:00', NULL, 2, '', '', '', ''),
(247, 'KDMCC-25-120462_515105', 'xyz_auto', 'vijaypandeyandassociates@gmail.com', '12a387b034761f556c158b355bf9bb29', NULL, '2024-02-16 00:00:00', NULL, 2, '', '', '', ''),
(248, 'KDMCC-25-130802_526570', 'xyz_auto', 'aj@jalalarchitects.com', 'a6d78660d9e68a20f566bf7fa02304bb', NULL, '2024-02-16 00:00:00', NULL, 2, '', '', '', ''),
(249, 'KDMCC-25-129486_525109', 'xyz_auto', 'anilnirgude99@gmail.com', '3aa7470a528a70eaf3b85a6f329f9588', NULL, '2024-02-16 00:00:00', NULL, 2, '', '', '', ''),
(250, 'KDMCC-25-76577_467379', 'xyz_auto', 'gopinath.gandhe@gmail.com', '0d6cfbe9da55cb063b541edf465b99f1', NULL, '2024-02-16 00:00:00', NULL, 2, '', '', '', ''),
(251, 'KDMCC-25-ENTRY-87355_479074', 'xyz_auto', 'aj@jalalarchitects.com', '089a3fc895b9f7e7895ed1f64f62af95', NULL, '2024-02-16 00:00:00', NULL, 2, '', '', '', ''),
(252, 'KDMCC-25-26552_413569', 'xyz_auto', 'ar.nv.office@gmail.com', '8562aca6777c1e6db866a422c30ed700', NULL, '2024-02-16 00:00:00', NULL, 2, '', '', '', ''),
(253, 'KDMCC-25-ENTRY-122216_517026', 'xyz_auto', 'vijaypandeyandassociates@gmail.com', 'e0f4566bd4765eba75bb9d3bcdcd5f7e', NULL, '2024-02-16 00:00:00', NULL, 2, '', '', '', ''),
(254, 'KDMCC-25-132392_528308', 'xyz_auto', 'emergearchitect@gmail.com', '2e633f1369f1836eaea7e90d049a907d', NULL, '2024-02-16 00:00:00', NULL, 2, '', '', '', ''),
(255, 'KDMCC-25-129403_525013', 'xyz_auto', 'deconcon009@gmail.com', '87e82cdaf27a1d35ab875b4d65c2ea12', NULL, '2024-02-16 00:00:00', NULL, 2, '', '', '', ''),
(256, 'KDMCC-25-96066_488491', 'xyz_auto', 'ankurshetye@gmail.com', '6a1d36e2c470be6690780ddf29d341a9', NULL, '2024-02-16 00:00:00', NULL, 2, '', '', '', ''),
(257, 'KDMCC-25-122229_517042', 'xyz_auto', 'ankurshetye@gmail.com', '327fbd089413966aec10064bc94c9a6d', NULL, '2024-02-16 00:00:00', NULL, 2, '', '', '', ''),
(258, 'KDMCC-25-118781_513268', 'xyz_auto', 'sthapathyanirmaan@gmail.com', '22064e4f166a7846703b769024068c02', NULL, '2024-02-16 00:00:00', NULL, 2, '', '', '', ''),
(259, 'KDMCC-25-134617_530770', 'xyz_auto', 'emergearchitect@gmail.com', 'f497558457701aac14a15a7fd0badde7', NULL, '2024-02-16 00:00:00', NULL, 2, '', '', '', ''),
(260, 'KDMCC-25-125265_520422', 'xyz_auto', 'shirish_nachane@rediffmail.com', '827f425cfcd322682f0327b703e4d7ca', NULL, '2024-02-16 00:00:00', NULL, 2, '', '', '', ''),
(261, 'KDMCC-25-ENTRY-131725_527577', 'xyz_auto', 'vijaypandeyandassociates@gmail.com', 'f9ef2f4bb08a0570a483d3196838902d', NULL, '2024-02-16 00:00:00', NULL, 2, '', '', '', ''),
(262, 'KDMCC-25-ENTRY-119582_514156', 'xyz_auto', 'aj@jalalarchitects.com', '40df4d2d358ae4fafb4905c2738d5952', NULL, '2024-02-16 00:00:00', NULL, 2, '', '', '', ''),
(263, 'KDMCC-25-136900_533281', 'xyz_auto', 'arkishan280493@gmail.com', 'f5af7efa3c171db0c4596f99a809c27f', NULL, '2024-02-16 00:00:00', NULL, 2, '', '', '', ''),
(264, 'KDMCC-25-ENTRY-135342_531579', 'xyz_auto', 'rajanmodak1955@gmail.com', '63acd6dbf88f3adda3a94225bb4c9001', NULL, '2024-02-16 00:00:00', NULL, 2, '', '', '', ''),
(265, 'KDMCC-25-133119_529123', 'xyz_auto', 'tejasnirgude@gmail.com', 'be7720c919b7d0a017481c101e0a0dbf', NULL, '2024-02-16 00:00:00', NULL, 2, '', '', '', ''),
(266, 'KDMCC-25-137394_533849', 'xyz_auto', 'nehanakwe23@gmail.com', '9add7afd6618bcb239d9fa696d3159eb', NULL, '2024-02-16 00:00:00', NULL, 2, '', '', '', ''),
(267, 'KDMCC-25-132760_528714', 'xyz_auto', 'tonsonthomas12345@gmail.com', '211cc67c84b7d9fc60d8fdadc30e0627', NULL, '2024-02-16 00:00:00', NULL, 2, '', '', '', ''),
(268, 'KDMCC-25-129210_524800', 'xyz_auto', 'vijaypandeyandassociates@gmail.com', 'a30f55d926ca36a566e00bf049e1edcf', NULL, '2024-02-16 00:00:00', NULL, 2, '', '', '', ''),
(269, 'KDMCC-23-70189_201456', 'xyz_auto', 'khatimitiumair9545@gmail.com', '4079345137d14c8dacf7aa91ee892f00', NULL, '2024-02-16 00:00:00', NULL, 2, '', '', '', ''),
(270, 'KDMCC-25-ENTRY-134997_531198', 'xyz_auto', 'tejasnirgude@gmail.com', 'e6757e34ba1c0eeb4c5cf50facb84e65', NULL, '2024-02-16 00:00:00', NULL, 2, '', '', '', ''),
(271, 'KDMCC-25-ENTRY-136637_532996', 'xyz_auto', 'vijaypandeyandassociates@gmail.com', 'ab28474f81e7ec47d6114003db65f613', NULL, '2024-02-16 00:00:00', NULL, 2, '', '', '', ''),
(272, 'KDMCC-25-128528_524050', 'xyz_auto', 'aj@jalalarchitects.com', 'a63e369d4fa93b07dba980b31250da15', NULL, '2024-02-16 00:00:00', NULL, 2, '', '', '', ''),
(273, 'KDMCC-25-ENTRY-112959_506859', 'xyz_auto', 'arsandeep21@gmail.com', 'e72625e8c3a1067af7a7a5addacbf764', NULL, '2024-02-16 00:00:00', NULL, 2, '', '', '', ''),
(274, 'KDMCC-25-137063_533463', 'xyz_auto', 'emergearchitect@gmail.com', 'a8ed35aabef6e46db5cdfd842ec8c0c9', NULL, '2024-02-16 00:00:00', NULL, 2, '', '', '', ''),
(275, 'KDMCC-25-ENTRY-140948_537821', 'xyz_auto', 'ssvinayak7@rediffmail.com', 'fb4818d727f3a34cd6c5d340f33dcf95', NULL, '2024-02-16 00:00:00', NULL, 2, '', '', '', ''),
(276, 'KDMCC-25-138599_535204', 'xyz_auto', 'boradenikhil36@gmail.com', '44276cdebd679757b2316b0060aabd65', NULL, '2024-02-16 00:00:00', NULL, 2, '', '', '', ''),
(277, 'KDMCC-25-135403_531645', 'xyz_auto', 'tejasnirgude@gmail.com', '11ed7cf6c634c59f8dd627f3aa594fed', NULL, '2024-02-16 00:00:00', NULL, 2, '', '', '', ''),
(278, 'KDMCC-25-138842_535481', 'xyz_auto', 'boradenikhil36@gmail.com', '1c87e7465b82e9dfdf2bc348e263383d', NULL, '2024-02-16 00:00:00', NULL, 2, '', '', '', ''),
(279, 'KDMCC-25-ENTRY-135338_531575', 'xyz_auto', 'anilnirgude99@gmail.com', '0d1e3b1d3300b28a87e396aa8f9bd163', NULL, '2024-02-16 00:00:00', NULL, 2, '', '', '', ''),
(280, 'KDMCC-25-139643_536355', 'xyz_auto', 'tejasnirgude@gmail.com', 'd7a7beaa2c3ee9f462b39681a124a500', NULL, '2024-02-16 00:00:00', NULL, 2, '', '', '', ''),
(281, 'KDMCC-25-139565_536269', 'xyz_auto', 'dmdarchitects@yahoo.com', 'f1b5f37c82e7b85630618a1ca38ca290', NULL, '2024-02-16 00:00:00', NULL, 2, '', '', '', ''),
(282, 'KDMCC-25-138146_534691', 'xyz_auto', 'vijaypandeyandassociates@gmail.com', 'fa236429b0ea2b465ff5f12656751511', NULL, '2024-02-16 00:00:00', NULL, 2, '', '', '', ''),
(283, 'KDMCC-25-ENTRY-104630_497748', 'xyz_auto', 'archuday.satavalekar@gmail.com', '515d5e855ae0bee729a4b6070ba16821', NULL, '2024-02-16 00:00:00', NULL, 2, '', '', '', ''),
(284, 'KDMCC-25-102479_495415', 'xyz_auto', 'sthapathyanirmaan@gmail.com', 'ac1407f44dc77bc483733d5ee18108d1', NULL, '2024-02-16 00:00:00', NULL, 2, '', '', '', ''),
(285, 'KDMCC-25-138686_535305', 'xyz_auto', 'sandy.patil78@yahoo.com', '8f1476f350096c45ab4ca5925c2cbf9d', NULL, '2024-02-16 00:00:00', NULL, 2, '', '', '', ''),
(286, 'KDMCC-25-141634_538571', 'xyz_auto', 'dmdarchitects@yahoo.com', '3813583ef86c236acdbc88db09136a89', NULL, '2024-02-16 00:00:00', NULL, 2, '', '', '', ''),
(287, 'KDMCC-25-140225_536993', 'xyz_auto', 'nehanakwe23@gmail.com', '02f158ede132bf92e61be7c91873b397', NULL, '2024-02-16 00:00:00', NULL, 2, '', '', '', ''),
(288, 'KDMCC-25-143031_540076', 'xyz_auto', 'sagarpalkar04@gmail.com', '011d9e998699ec693f30f1727e0a03c7', NULL, '2024-02-16 00:00:00', NULL, 2, '', '', '', ''),
(289, 'KDMCC-25-118587_513056', 'xyz_auto', 'emergearchitect@gmail.com', '74c61968bd81f6d98873a5a26e551593', NULL, '2024-02-16 00:00:00', NULL, 2, '', '', '', ''),
(290, 'KDMCC-23-77350_209140', 'xyz_auto', 'ucassociates29@gmail.com', '45776e7bf424b04cd2a11fa2ecdde2db', NULL, '2024-02-16 00:00:00', NULL, 2, '', '', '', ''),
(291, 'KDMCC-25-ENTRY-136924_533305', 'xyz_auto', 'rkassociates0805@gmail.com', '0882c08edf31ba44101dba9fe48d203d', NULL, '2024-02-16 00:00:00', NULL, 2, '', '', '', ''),
(292, 'KDMCC-25-ENTRY-143442_540511', 'xyz_auto', 'harshdewoolkar13@gmail.com', '68571091a4613e6645e0408944f8aa45', NULL, '2024-02-16 00:00:00', NULL, 2, '', '', '', ''),
(293, 'KDMCC-25-144183_541315', 'xyz_auto', 'sthapathyanirmaan@gmail.com', '3e667e0508ca8b3e20c334e2ecf0f0ac', NULL, '2024-02-16 00:00:00', NULL, 2, '', '', '', ''),
(294, 'KDMCC-25-137227_533655', 'xyz_auto', 'ar.nv.office@gmail.com', '4c38188001e014728dae1e842587d05e', NULL, '2024-02-16 00:00:00', NULL, 2, '', '', '', ''),
(295, 'KDMCC-25-143994_541114', 'xyz_auto', 'boradenikhil36@gmail.com', '02bb56a1ea9a776778a381e28fdf7ec8', NULL, '2024-02-16 00:00:00', NULL, 2, '', '', '', ''),
(296, 'KDMCC-25-137183_533604', 'xyz_auto', 'tejasnirgude@gmail.com', 'd9f51c95911f3e8c19dfa0d6f5d862dd', NULL, '2024-02-16 00:00:00', NULL, 2, '', '', '', ''),
(297, 'KDMCC-25-140178_536938', 'xyz_auto', 'tejasnirgude@gmail.com', 'de90bf2879324b59c64b587ff6c62180', NULL, '2024-02-16 00:00:00', NULL, 2, '', '', '', ''),
(298, 'KDMCC-25-132645_528586', 'xyz_auto', 'tejasnirgude@gmail.com', '4963e376974ef727028c963a08cefd46', NULL, '2024-02-16 00:00:00', NULL, 2, '', '', '', ''),
(299, 'KDMCC-25-83339_474705', 'xyz_auto', 'rajeev@tayshete.com', '6e8239b00b44992c1cbbc1fa4e6739e4', NULL, '2024-02-16 00:00:00', NULL, 2, '', '', '', ''),
(300, 'KDMCC-25-138122_534665', 'xyz_auto', 'tejasnirgude@gmail.com', 'b97ae5bd5b0c3495cda6f6005151cdf1', NULL, '2024-02-16 00:00:00', NULL, 2, '', '', '', ''),
(301, 'KDMCC-24-09140_257246', 'xyz_auto', 'ankurshetye@gmail.com', '6fa5f591761e73426b8d07cb62ed81bd', NULL, '2024-02-16 00:00:00', NULL, 2, '', '', '', ''),
(302, 'KDMCC-24-95306_349176', 'xyz_auto', 'anilnirgude99@gmail.com', '9f522eb6c0817c89658bc18cc132cc90', NULL, '2024-02-16 00:00:00', NULL, 2, '', '', '', ''),
(303, 'KDMCC-24-102443_356804', 'xyz_auto', 'rajeev@tayshete.com', '1a30fce420e11d6168f6628fdf13d3e8', NULL, '2024-02-16 00:00:00', NULL, 2, '', '', '', ''),
(304, 'KDMCC-22-ENTRY-84250_109824', 'xyz_auto', 'asdaa.98.17@gmail.com', 'f22d0841426d55d50c96938c103d2fc5', NULL, '2024-02-16 00:00:00', NULL, 2, '', '', '', ''),
(305, 'KDMCC-25-141396_538317', 'xyz_auto', 'shirish_nachane@rediffmail.com', '7a7def6e30e6a46f8c19f9c5ca81bad7', NULL, '2024-02-16 00:00:00', NULL, 2, '', '', '', ''),
(306, 'KDMCC-25-145754_542991', 'xyz_auto', 'sthapathyanirmaan@gmail.com', '4c4da0defcf3838782831e001b510f4c', NULL, '2024-02-16 00:00:00', NULL, 2, '', '', '', ''),
(307, 'KDMCC-25-140206_536975', 'xyz_auto', 'aj@jalalarchitects.com', '61cef45072dedc6354b83fbac83901bb', NULL, '2024-02-16 00:00:00', NULL, 2, '', '', '', ''),
(308, 'KDMCC-25-ENTRY-131270_527080', 'xyz_auto', 'shirish_nachane@rediffmail.com', 'c9e72bcc3c46f1be64281b0a239e7aa3', NULL, '2024-02-16 00:00:00', NULL, 2, '', '', '', ''),
(309, 'KDMCC-25-145598_542826', 'xyz_auto', 'sagarpalkar04@gmail.com', 'cdf6d806cfdb8831b04b5a91b99d6f50', NULL, '2024-02-16 00:00:00', NULL, 2, '', '', '', ''),
(310, 'KDMCC-26-00504_544929', 'xyz_auto', 'ar.nv.office@gmail.com', '62177c2763a4fd7ba457b579425b7b51', NULL, '2024-02-16 00:00:00', NULL, 2, '', '', '', ''),
(311, 'KDMCC-25-ENTRY-142131_539119', 'xyz_auto', 'deconcon009@gmail.com', '081b15cb39287bca20740b6356039573', NULL, '2024-02-16 00:00:00', NULL, 2, '', '', '', ''),
(312, 'KDMCC-24-ENTRY-44955_295261', 'xyz_auto', 'asdaa.98.17@gmail.com', '61a02b4002f82a8158ff95ed88bdf297', NULL, '2024-02-16 00:00:00', NULL, 2, '', '', '', ''),
(313, 'KDMCC-25-139410_536099', 'xyz_auto', 'paranjapemadh@gmail.com', '6b7d2b6231e63c76e55c53552f293928', NULL, '2024-02-16 00:00:00', NULL, 2, '', '', '', ''),
(314, 'KDMCC-25-145628_542856', 'xyz_auto', 'sagarpalkar04@gmail.com', '75282eb53dfd400c89e5d94babdae3ea', NULL, '2024-02-16 00:00:00', NULL, 2, '', '', '', ''),
(315, 'KDMCC-25-ENTRY-134977_531173', 'xyz_auto', 'tejasnirgude@gmail.com', 'dd97194f2bebaf266b30010f069f3ebd', NULL, '2024-02-16 00:00:00', NULL, 2, '', '', '', ''),
(316, 'KDMCC-23-76618_208354', 'xyz_auto', 'pankajrp075@gmail.com', 'e117efc1b868110e8e56d5333dade278', NULL, '2024-02-16 00:00:00', NULL, 2, '', '', '', ''),
(317, 'KDMCC-25-130873_526650', 'xyz_auto', 'madangadgil@rediffmail.com', 'e3e101309a65381559074e551aea5433', NULL, '2024-02-16 00:00:00', NULL, 2, '', '', '', ''),
(318, 'KDMCC-25-ENTRY-117519_511859', 'xyz_auto', 'rajanmodak1955@gmail.com', '2d8a1b605cbfccc8ed6a9dd89562fdaa', NULL, '2024-02-16 00:00:00', NULL, 2, '', '', '', ''),
(319, 'KDMCC-25-143431_540500', 'xyz_auto', 'dudhe.nikhil@gmail.com', '952591e4098d11c8c6be0f3f6e889d8a', NULL, '2024-02-16 00:00:00', NULL, 2, '', '', '', ''),
(320, 'KDMCC-26-02507_547103', 'xyz_auto', 'saakaararchitects@yahoo.co.in', '63c6025831405a43b7db000b346d42e0', NULL, '2024-02-16 00:00:00', NULL, 2, '', '', '', ''),
(321, 'KDMCC-25-ENTRY-108836_502330', 'xyz_auto', 'nirmitee.arcint@gmail.com', '79f7f0055d6b6305946e9991af906cd5', NULL, '2024-02-16 00:00:00', NULL, 2, '', '', '', ''),
(322, 'KDMCC-25-144406_541552', 'xyz_auto', 'sugatvivekarchitects@gmail.com', '6f3b94b7c1016eff97f8e869872528f1', NULL, '2024-02-16 00:00:00', NULL, 2, '', '', '', ''),
(323, 'KDMCC-26-ENTRY-01934_546493', 'xyz_auto', 'aone.architects1@gmail.com', '91c19f436fbd2861ac5e49496e5b49e6', NULL, '2024-02-16 00:00:00', NULL, 2, '', '', '', ''),
(324, 'KDMCC-26-04691_549440', 'xyz_auto', 'pankajrp075@gmail.com', '7f88908cdccdc117c90225bb32fa4434', NULL, '2024-02-16 00:00:00', NULL, 2, '', '', '', ''),
(325, 'KDMCC-25-133966_530064', 'xyz_auto', 'damini5253@gmail.com', 'd2ff9016118c9dcae2f24ec431e69e3e', NULL, '2024-02-16 00:00:00', NULL, 2, '', '', '', ''),
(326, 'KDMCC-26-ENTRY-01617_546135', 'xyz_auto', 'tejasnirgude@gmail.com', 'a0e3577d02aeebf93be9ff3835bd92df', NULL, '2024-02-16 00:00:00', NULL, 2, '', '', '', ''),
(327, 'KDMCC-25-142378_539377', 'xyz_auto', 'vijaypandeyandassociates@gmail.com', 'a2a7d279a6ff18be7c397e4a53545900', NULL, '2024-02-16 00:00:00', NULL, 2, '', '', '', ''),
(328, 'KDMCC-26-07142_552085', 'xyz_auto', 'vrs.roshan@gmail.com', '32ac7e7d8b5dd41a0f94c8fe786e1edf', NULL, '2024-02-16 00:00:00', NULL, 2, '', '', '', ''),
(329, 'KDMCC-26-ENTRY-08179_553224', 'xyz_auto', 'ucassociates29@gmail.com', '646d02d8acfd3ab4c922becab0dceb3c', NULL, '2024-02-16 00:00:00', NULL, 2, '', '', '', ''),
(330, 'KDMCC-25-ENTRY-135785_532068', 'xyz_auto', 'tonsonthomas12345@gmail.com', '0ecf1d48d530c7010d839d25fc8d32d6', NULL, '2024-02-16 00:00:00', NULL, 2, '', '', '', ''),
(331, 'KDMCC-26-01792_546334', 'xyz_auto', 'tejasnirgude@gmail.com', 'cbfc622ed520eadaca909c18cc5af121', NULL, '2024-02-16 00:00:00', NULL, 2, '', '', '', ''),
(332, 'KDMCC-25-ENTRY-09321_395147', 'xyz_auto', 'ar.santoshmadan@gmail.com', '0dbe35345624459342adb1966c268399', NULL, '2024-02-16 00:00:00', NULL, 2, '', '', '', ''),
(333, 'KDMCC-26-ENTRY-08151_553196', 'xyz_auto', 'rkassociates0805@gmail.com', 'cf8216838dddb72ffb8932c0f6c60a93', NULL, '2024-02-16 00:00:00', NULL, 2, '', '', '', ''),
(334, 'KDMCC-25-139504_536202', 'xyz_auto', 'asdaa.98.17@gmail.com', '3830ad55477369ae95d25a6365a0b375', NULL, '2024-02-16 00:00:00', NULL, 2, '', '', '', ''),
(335, 'KDMCC-26-08301_553356', 'xyz_auto', 'ar.prajaktalaxmanchavan@gmail.com', '7abe738cc9499c5fcf6e27cab9bb888f', NULL, '2024-02-16 00:00:00', NULL, 2, '', '', '', ''),
(336, 'KDMCC-25-134180_530299', 'xyz_auto', 'asdaa.98.17@gmail.com', '3de0a77928e6562f17ebc65cf2b10cc7', NULL, '2024-02-16 00:00:00', NULL, 2, '', '', '', ''),
(337, 'KDMCC-25-ENTRY-144858_542034', 'xyz_auto', 'sthapathyanirmaan@gmail.com', '33075270ffc47c265a786c701527a328', NULL, '2024-02-16 00:00:00', NULL, 2, '', '', '', ''),
(338, 'KDMCC-26-ENTRY-00368_544785', 'xyz_auto', 'sthapathyanirmaan@gmail.com', '50026755710520916fb0c740b53e003f', NULL, '2024-02-16 00:00:00', NULL, 2, '', '', '', ''),
(339, 'KDMCC-26-04586_549314', 'xyz_auto', 'aj@jalalarchitects.com', '5d00a0af4a0b48708f0329eb892d223c', NULL, '2024-02-16 00:00:00', NULL, 2, '', '', '', ''),
(340, 'KDMCC-26-ENTRY-09291_554450', 'xyz_auto', 'sthapathyanirmaan@gmail.com', '2e4ac45a038455befa41a4175cd77ea0', NULL, '2024-02-16 00:00:00', NULL, 2, '', '', '', ''),
(341, 'KDMCC-26-ENTRY-12134_557541', 'xyz_auto', 'tejasnirgude@gmail.com', '8aea938b3175da527e97bfb9359e6e45', NULL, '2024-02-16 00:00:00', NULL, 2, '', '', '', ''),
(342, 'KDMCC-26-ENTRY-01069_545544', 'xyz_auto', 'tejasnirgude@gmail.com', '3b95672dbdc41a91c04df84f1b67a126', NULL, '2024-02-16 00:00:00', NULL, 2, '', '', '', ''),
(343, 'KDMCC-26-06965_551901', 'xyz_auto', 'architectvp.mumbai@gmail.com', '247c7424ebeef8d1712f409fc57972ff', NULL, '2024-02-16 00:00:00', NULL, 2, '', '', '', ''),
(344, 'KDMCC-25-ENTRY-145146_542350', 'xyz_auto', 'tejasnirgude@gmail.com', '762bec1e1707e96b01f77e7bff54c83e', NULL, '2024-02-16 00:00:00', NULL, 2, '', '', '', ''),
(345, 'KDMCC-26-13168_558654', 'xyz_auto', 'shirish_nachane@rediffmail.com', '25fa42827f67b2c957210a7846ed1170', NULL, '2024-02-16 00:00:00', NULL, 2, '', '', '', ''),
(346, 'KDMCC-26-06911_551843', 'xyz_auto', 'designteam@creations.org.in', 'a85dc901d0bd40ed15293a378728514d', NULL, '2024-02-16 00:00:00', NULL, 2, '', '', '', ''),
(347, 'KDMCC-26-08723_553829', 'xyz_auto', 'tejasnirgude@gmail.com', '00fdb84e9ca9a9d72efbb8bead0da168', NULL, '2024-02-16 00:00:00', NULL, 2, '', '', '', ''),
(348, 'KDMCC-25-ENTRY-86868_478551', 'xyz_auto', 'gopinath.gandhe@gmail.com', 'd054a22d81e2b191b87ff482070537ef', NULL, '2024-02-16 00:00:00', NULL, 2, '', '', '', ''),
(349, 'KDMCC-26-11843_557226', 'xyz_auto', 'ivisiondesignstudio@gmail.com', 'cfd382dd9564ebc575a9bf6ae6e95053', NULL, '2024-02-16 00:00:00', NULL, 2, '', '', '', ''),
(350, 'KDMCC-26-11847_557230', 'xyz_auto', 'archuday.satavalekar@gmail.com', 'b300bafd4384afdabced4d523cfc2d88', NULL, '2024-02-16 00:00:00', NULL, 2, '', '', '', ''),
(351, 'KDMCC-26-14988_560613', 'xyz_auto', 'nehanakwe23@gmail.com', '703a0641c0b11efbf9cbdf7745695cd1', NULL, '2024-02-16 00:00:00', NULL, 2, '', '', '', ''),
(352, 'KDMCC-26-ENTRY-16250_561981', 'xyz_auto', 'ucassociates29@gmail.com', 'a8957745f5d401f2196b0fe9a7853930', NULL, '2024-02-16 00:00:00', NULL, 2, '', '', '', ''),
(353, 'KDMCC-25-126060_521329', 'xyz_auto', 'vijaypandeyandassociates@gmail.com', 'e91af2b51b713d16cb8358c288567253', NULL, '2024-02-16 00:00:00', NULL, 2, '', '', '', ''),
(354, 'KDMCC-26-05472_550280', 'xyz_auto', 'tejasnirgude@gmail.com', '955f45f36bab192a673ebe4f29545365', NULL, '2024-02-16 00:00:00', NULL, 2, '', '', '', ''),
(355, 'KDMCC-26-14385_559961', 'xyz_auto', 'deconcon009@gmail.com', 'd5a2cdb6c7d1d3a15541d3e0fc125efc', NULL, '2024-02-16 00:00:00', NULL, 2, '', '', '', ''),
(356, 'KDMCC-25-ENTRY-69737_459972', 'xyz_auto', 'vastushilp10@yahoo.com', '5032c6db5acdc2b9548c0336803db091', NULL, '2024-02-16 00:00:00', NULL, 2, '', '', '', ''),
(357, 'KDMCC-26-00111_544510', 'xyz_auto', 'vijaypandeyandassociates@gmail.com', 'b1e445ee4828c995796595c34eba8c84', NULL, '2024-02-16 00:00:00', NULL, 2, '', '', '', ''),
(358, 'KDMCC-26-13876_559415', 'xyz_auto', 'deconcon009@gmail.com', 'cec66bb7c100015058aae107aaff7d99', NULL, '2024-02-16 00:00:00', NULL, 2, '', '', '', ''),
(359, 'KDMCC-26-00098_544496', 'xyz_auto', 'emergearchitect@gmail.com', 'ded6d9fb7ac97380fa5397ade98c37e7', NULL, '2024-02-16 00:00:00', NULL, 2, '', '', '', ''),
(360, 'KDMCC-26-18505_564514', 'xyz_auto', 'boradenikhil36@gmail.com', '0048cb800fdb61ca68c8b0c48b1146b6', NULL, '2024-02-16 00:00:00', NULL, 2, '', '', '', ''),
(361, 'KDMCC-26-19956_566054', 'xyz_auto', 'boradenikhil36@gmail.com', '3a759230aced25bab6574755c43c53be', NULL, '2024-02-16 00:00:00', NULL, 2, '', '', '', ''),
(362, 'KDMCC-23-39493_168745', 'xyz_auto', 'akash94sonawane@gmail.com', '10033484675023f8cbb342fb8d761e7e', NULL, '2024-02-16 00:00:00', NULL, 2, '', '', '', ''),
(363, 'KDMCC-25-131620_527462', 'xyz_auto', 'chandrakant.auti@yahoo.com', '578c5987d78adc9104f3a8d9c82219a5', NULL, '2024-02-16 00:00:00', NULL, 2, '', '', '', ''),
(364, 'KDMCC-22-23886_46085', 'xyz_auto', 'sthapathyanirmaan@gmail.com', '01c00666cc3847fbb0f41f29567e30bf', NULL, '2024-02-16 00:00:00', NULL, 2, '', '', '', ''),
(365, 'KDMCC-26-09658_554856', 'xyz_auto', 'aone.architects1@gmail.com', 'a9af38ccc60f9d40b50b1d3c11a8cba7', NULL, '2024-02-16 00:00:00', NULL, 2, '', '', '', ''),
(366, 'KDMCC-26-19129_565173', 'xyz_auto', 'designteam@creations.org.in', '39641fc9863fa1f78ae4ffd73213e766', NULL, '2024-02-16 00:00:00', NULL, 2, '', '', '', ''),
(367, 'KDMCC-26-ENTRY-16552_562335', 'xyz_auto', 'sthapathyanirmaan@gmail.com', 'b18cce177e0df22cf66cc4237ca3306c', NULL, '2024-02-16 00:00:00', NULL, 2, '', '', '', ''),
(368, 'KDMCC-25-139933_536672', 'xyz_auto', 'tejasnirgude@gmail.com', '6532242f1a4cd23a174d45795d3aa73a', NULL, '2024-02-16 00:00:00', NULL, 2, '', '', '', ''),
(369, 'KDMCC-26-02858_547479', 'xyz_auto', 'emergearchitect@gmail.com', '0bcccc42a96e48043c3b0e657b6599fe', NULL, '2024-02-16 00:00:00', NULL, 2, '', '', '', ''),
(370, 'KDMCC-25-136618_532977', 'xyz_auto', 'tejasnirgude@gmail.com', '6043df6b5e9a2ff26ce001d10a622519', NULL, '2024-02-16 00:00:00', NULL, 2, '', '', '', ''),
(371, 'KDMCC-26-20209_566332', 'xyz_auto', 'yash210995@gmail.com', '34a3e4fe9eeca6bf86e7daa540a2fe76', NULL, '2024-02-16 00:00:00', NULL, 2, '', '', '', ''),
(372, 'KDMCC-26-22055_568505', 'xyz_auto', 'akash94sonawane@gmail.com', 'e61784abc7dd5f0b94210121b870b465', NULL, '2024-02-16 00:00:00', NULL, 2, '', '', '', ''),
(373, 'KDMCC-25-96582_489049', 'xyz_auto', 'shehbazmoulvi@gmail.com', '858d3e8414c8cf9c69dd476d6d0676ca', NULL, '2024-02-16 00:00:00', NULL, 2, '', '', '', ''),
(374, 'KDMCC-26-15007_560636', 'xyz_auto', 'saakaararchitects@yahoo.co.in', '46385b09c40564e0b3c75a5f769941e7', NULL, '2024-02-16 00:00:00', NULL, 2, '', '', '', ''),
(375, 'KDMCC-26-ENTRY-09257_554409', 'xyz_auto', 'tejasnirgude@gmail.com', '6ce478cddf51fa3d0771088f0ab2df6d', NULL, '2024-02-16 00:00:00', NULL, 2, '', '', '', ''),
(376, 'KDMCC-26-23418_570047', 'xyz_auto', 'deconcon009@gmail.com', '20330c188b6c85938f9b816fc59bc9b8', NULL, '2024-02-16 00:00:00', NULL, 2, '', '', '', ''),
(377, 'KDMCC-26-ENTRY-10603_555881', 'xyz_auto', 'sthapathyanirmaan@gmail.com', '7391e9b1758aa35d328d07382af2ea9a', NULL, '2024-02-16 00:00:00', NULL, 2, '', '', '', ''),
(378, 'KDMCC-25-ENTRY-67181_457211', 'xyz_auto', 'shindepramodr985@gmail.com', 'a5b63071bfae81e9c6fad85199c2da2f', NULL, '2024-02-16 00:00:00', NULL, 2, '', '', '', ''),
(379, 'KDMCC-26-ENTRY-07871_552886', 'xyz_auto', 'sthapathyanirmaan@gmail.com', '2b9ba25f43fda98baccfb515d9fa6b4f', NULL, '2024-02-16 00:00:00', NULL, 2, '', '', '', ''),
(380, 'KDMCC-24-103526_357956', 'xyz_auto', 'arsandeep21@gmail.com', '935f950e89c8dd45e9c359a30297d15b', NULL, '2024-02-16 00:00:00', NULL, 2, '', '', '', ''),
(381, 'KDMCC-26-23909_570599', 'xyz_auto', 'boradenikhil36@gmail.com', 'ec7dc293f606a2b1d79aef28f97f4559', NULL, '2024-02-16 00:00:00', NULL, 2, '', '', '', ''),
(382, 'KDMCC-25-116449_510667', 'xyz_auto', 'tripathibinod1974@gmail.com', 'd594894049152852e899e893b021c8c2', NULL, '2024-02-16 00:00:00', NULL, 2, '', '', '', ''),
(383, 'KDMCC-26-24671_571419', 'xyz_auto', 'ar.ujwaljamdare@gmail.com', '16ce740e457b5fd6418b1a86a2f946f3', NULL, '2024-02-16 00:00:00', NULL, 2, '', '', '', ''),
(384, 'KDMCC-26-ENTRY-02863_547484', 'xyz_auto', 'asdaa.98.17@gmail.com', '0869939b1e708716648e30405a6e3e79', NULL, '2024-02-16 00:00:00', NULL, 2, '', '', '', ''),
(385, 'KDMCC-26-19641_565718', 'xyz_auto', 'vijaypandeyandassociates@gmail.com', '71079b79b466b723978b8a4fe7f6a38c', NULL, '2024-02-16 00:00:00', NULL, 2, '', '', '', ''),
(386, 'KDMCC-26-24678_571427', 'xyz_auto', 'ar.ujwaljamdare@gmail.com', 'a2496a0e5f2f3291af29b279aab0e6f3', NULL, '2024-02-16 00:00:00', NULL, 2, '', '', '', ''),
(387, 'KDMCC-25-ENTRY-35838_423452', 'xyz_auto', 'tripathibinod1974@gmail.com', 'e68215c9f695e9b5eab223d0a0f45cdf', NULL, '2024-02-16 00:00:00', NULL, 2, '', '', '', ''),
(388, 'KDMCC-26-26667_573577', 'xyz_auto', 'emergearchitect@gmail.com', 'f563ab1083b3f474cc2493b980ce5a2d', NULL, '2024-02-16 00:00:00', NULL, 2, '', '', '', ''),
(389, 'KDMCC-26-24580_571324', 'xyz_auto', 'emergearchitect@gmail.com', 'bdadceb0cbdc6fdc61e67dc1b57f9622', NULL, '2024-02-16 00:00:00', NULL, 2, '', '', '', ''),
(390, 'KDMCC-26-21076_567324', 'xyz_auto', 'akash94sonawane@gmail.com', '3b2de64a21d28e626d09781d28fcf1c1', NULL, '2024-02-16 00:00:00', NULL, 2, '', '', '', ''),
(391, 'KDMCC-26-ENTRY-22833_569400', 'xyz_auto', 'deconcon009@gmail.com', 'e6b9a02b2f4ab8ca8991a5b149cbf976', NULL, '2024-02-16 00:00:00', NULL, 2, '', '', '', ''),
(392, 'KDMCC-26-ENTRY-23701_570363', 'xyz_auto', 'tejasnirgude@gmail.com', '045be0c3e01412a6a49b0adedcf56efb', NULL, '2024-02-16 00:00:00', NULL, 2, '', '', '', ''),
(393, 'KDMCC-26-20974_567209', 'xyz_auto', 'boradenikhil36@gmail.com', 'dd4a32d2f7734777f2110121001d6f84', NULL, '2024-02-16 00:00:00', NULL, 2, '', '', '', ''),
(394, 'KDMCC-26-21082_567330', 'xyz_auto', 'patel.nitiksha@gmail.com', '5507d22ebaf8ad9a2219e46a722f4db2', NULL, '2024-02-16 00:00:00', NULL, 2, '', '', '', ''),
(395, 'KDMCC-26-27894_574898', 'xyz_auto', 'ar.deeppatel2023@gmail.com', 'f0c27174fa31a25b18b20f934f4cce04', NULL, '2024-02-16 00:00:00', NULL, 2, '', '', '', ''),
(396, 'KDMCC-26-ENTRY-27251_574204', 'xyz_auto', 'architects.incorporate@rediffmail.com', '337bb8f4d1e6259b28b95b4e0e63d97f', NULL, '2024-02-16 00:00:00', NULL, 2, '', '', '', ''),
(397, 'KDMCC-26-ENTRY-21995_568430', 'xyz_auto', 'yashv.patil9997@gmail.com', '436f5b0a62e69cad282d1c3dfa9b3f27', NULL, '2024-02-16 00:00:00', NULL, 2, '', '', '', ''),
(398, 'KDMCC-26-ENTRY-21892_568311', 'xyz_auto', 'deconcon009@gmail.com', '74e685f72c4d1e455d79b67daa9258eb', NULL, '2024-02-16 00:00:00', NULL, 2, '', '', '', ''),
(399, 'KDMCC-26-11883_557268', 'xyz_auto', 'tejasnirgude@gmail.com', '3f10214da601a7f05af56a4172f2f908', NULL, '2024-02-16 00:00:00', NULL, 2, '', '', '', ''),
(400, 'KDMCC-26-ENTRY-27556_574535', 'xyz_auto', 'deconcon009@gmail.com', 'd76f22f2811939a68c6b7f2f89f774d5', NULL, '2024-02-16 00:00:00', NULL, 2, '', '', '', ''),
(401, 'KDMCC-26-16098_561815', 'xyz_auto', 'priyadinodiya18@gmail.com', '119c8974592ae8e1d11630a45df7ca4a', NULL, '2024-02-16 00:00:00', NULL, 2, '', '', '', ''),
(402, 'KDMCC-26-28797_575883', 'xyz_auto', 'rajanmodak1955@gmail.com', 'cd43d04143cae80657e7cfeefc2c4193', NULL, '2024-02-16 00:00:00', NULL, 2, '', '', '', ''),
(403, 'KDMCC-26-21320_567627', 'xyz_auto', 'arsandeep21@gmail.com', '82e5a2ac890084c47115920688d34979', NULL, '2024-02-16 00:00:00', NULL, 2, '', '', '', ''),
(404, 'KDMCC-26-ENTRY-22416_568923', 'xyz_auto', 'vijaypandeyandassociates@gmail.com', '997f9e273ad73bd634b448b7d417333d', NULL, '2024-02-16 00:00:00', NULL, 2, '', '', '', ''),
(405, 'KDMCC-26-ENTRY-28614_575681', 'xyz_auto', 'shirish_nachane@rediffmail.com', '6250f49f61977ea92980d0f72f78a14c', NULL, '2024-02-16 00:00:00', NULL, 2, '', '', '', ''),
(406, 'KDMCC-26-ENTRY-28101_575120', 'xyz_auto', 'deconcon009@gmail.com', '5c6d61e4593bcac12d0c40fcb38c6e72', NULL, '2024-02-16 00:00:00', NULL, 2, '', '', '', ''),
(407, 'KDMCC-26-25227_572028', 'xyz_auto', 'archdeshmukh@rediffmail.com', '790a14a6f3e0406864e20ac240fd8bb1', NULL, '2024-02-16 00:00:00', NULL, 2, '', '', '', ''),
(408, 'KDMCC-26-30960_578251', 'xyz_auto', 'sthapathyanirmaan@gmail.com', '5c0e3839b0d5797dc8e100d362731b9f', NULL, '2024-02-16 00:00:00', NULL, 2, '', '', '', ''),
(409, 'KDMCC-26-24905_571675', 'xyz_auto', 'asdaa.98.17@gmail.com', 'f5890c42c72f61255687e7725db2550a', NULL, '2024-02-16 00:00:00', NULL, 2, '', '', '', ''),
(410, 'KDMCC-23-ENTRY-61660_192361', 'xyz_auto', 'architects.incorporate@rediffmail.com', '03651bde6368ede1f415a2f8ef8cd4bf', NULL, '2024-02-16 00:00:00', NULL, 2, '', '', '', ''),
(411, 'KDMCC-26-28805_575891', 'xyz_auto', 'yash210995@gmail.com', '754ce4d43a0ea93ba32368540daa0ff2', NULL, '2024-02-16 00:00:00', NULL, 2, '', '', '', ''),
(412, 'KDMCC-26-23207_569819', 'xyz_auto', 'asdaa.98.17@gmail.com', 'c8d63d3cb25677bce151b68429572527', NULL, '2024-02-16 00:00:00', NULL, 2, '', '', '', ''),
(413, 'KDMCC-25-ENTRY-16097_402426', 'xyz_auto', 'sbaoffice2023@gmail.com', '80671bdee2b8e59960effb8efb833412', NULL, '2024-02-16 00:00:00', NULL, 2, '', '', '', ''),
(414, 'KDMCC-23-59065_189570', 'xyz_auto', 'tripathibinod1974@gmail.com', '58bc9f3031472b2b57b6428819873545', NULL, '2024-02-16 00:00:00', NULL, 2, '', '', '', ''),
(415, 'KDMCC-25-ENTRY-89005_480846', 'xyz_auto', 'dt.architect@rediffmail.com', '4929710a50834f740b3dc1e66fc2609c', NULL, '2024-02-16 00:00:00', NULL, 2, '', '', '', ''),
(416, 'KDMCC-26-ENTRY-21284_567582', 'xyz_auto', 'tejasnirgude@gmail.com', 'de6c24099cf85f20dcc3f6c995195415', NULL, '2024-02-16 00:00:00', NULL, 2, '', '', '', ''),
(417, 'KDMCC-26-32513_579924', 'xyz_auto', 'ar.ujwaljamdare@gmail.com', '1a70c03eddaf21eda55670a071a7bab1', NULL, '2024-02-16 00:00:00', NULL, 2, '', '', '', ''),
(418, 'KDMCC-26-21491_567831', 'xyz_auto', 'tejasnirgude@gmail.com', '70de7c9e0f6fd8872c3752bd31a3909c', NULL, '2024-02-16 00:00:00', NULL, 2, '', '', '', ''),
(419, 'KDMCC-26-28828_575916', 'xyz_auto', 'kkkamble@yahoo.com', 'b72397a75f9225ed2810118082a00631', NULL, '2024-02-16 00:00:00', NULL, 2, '', '', '', ''),
(420, 'KDMCC-26-32533_579945', 'xyz_auto', 'sthapathyanirmaan@gmail.com', '49d57e0a75079d650cfae473948c28b8', NULL, '2024-02-16 00:00:00', NULL, 2, '', '', '', ''),
(421, 'KDMCC-26-ENTRY-30910_578201', 'xyz_auto', 'rkassociates0805@gmail.com', '790d62cd4052b3e6004ad4fc798faff3', NULL, '2024-02-16 00:00:00', NULL, 2, '', '', '', ''),
(422, 'KDMCC-26-ENTRY-24631_571377', 'xyz_auto', 'tushar_tendolkar@yahoo.co.in', '51ed2af639a38222d0cc8c29fedb497e', NULL, '2024-02-16 00:00:00', NULL, 2, '', '', '', ''),
(423, 'KDMCC-26-ENTRY-33141_580596', 'xyz_auto', 'tejasnirgude@gmail.com', '9648682e92b52dd874dd937f8158a09b', NULL, '2024-02-16 00:00:00', NULL, 2, '', '', '', ''),
(424, 'KDMCC-26-33221_580682', 'xyz_auto', 'sthapathyanirmaan@gmail.com', 'f424ecae3ac7bca929b8737e96375998', NULL, '2024-02-16 00:00:00', NULL, 2, '', '', '', ''),
(425, 'KDMCC-26-15509_561182', 'xyz_auto', 'rafiq@siapl.com', '039808f0d4c0a1e67a93c6812262693f', NULL, '2024-02-16 00:00:00', NULL, 2, '', '', '', ''),
(426, 'KDMCC-25-136359_532698', 'xyz_auto', 'ar.santoshmadan@gmail.com', 'ea68fc505b25385f782a10aaabbd05f2', NULL, '2024-02-16 00:00:00', NULL, 2, '', '', '', ''),
(427, 'KDMCC-26-27901_574905', 'xyz_auto', 'ar.santoshmadan@gmail.com', 'c3f0423448b8353feccf2a154225a9a5', NULL, '2024-02-16 00:00:00', NULL, 2, '', '', '', ''),
(428, 'KDMCC-26-21907_568331', 'xyz_auto', 'ar.santoshmadan@gmail.com', '4a9f68a4ebaec7189a84fcbca0c223c9', NULL, '2024-02-16 00:00:00', NULL, 2, '', '', '', ''),
(429, 'KDMCC-26-33051_580499', 'xyz_auto', 'ar.ujwaljamdare@gmail.com', '441163c80e6d02dc18aaad71603c6b8b', NULL, '2024-02-16 00:00:00', NULL, 2, '', '', '', ''),
(430, 'KDMCC-25-137330_533774', 'xyz_auto', 'sandy.patil78@yahoo.com', '35a3969699afecb0a30d2931b67e09c8', NULL, '2024-02-16 00:00:00', NULL, 2, '', '', '', ''),
(431, 'KDMCC-26-34449_582006', 'xyz_auto', 'gopinath.gandhe@gmail.com', '34e65bf7d383ac7b0cf6275c4b4ef9c4', NULL, '2024-02-16 00:00:00', NULL, 2, '', '', '', ''),
(432, 'KDMCC-25-123567_518508', 'xyz_auto', 'tushar_tendolkar@yahoo.co.in', 'b17b0e2c745ab6218a6816de99234710', NULL, '2024-02-16 00:00:00', NULL, 2, '', '', '', ''),
(433, 'KDMCC-26-ENTRY-33529_581015', 'xyz_auto', 'raunak29k@gmail.com', '480e371a81f54e2b5dec25f264cc51c2', NULL, '2024-02-16 00:00:00', NULL, 2, '', '', '', ''),
(434, 'KDMCC-26-34819_582401', 'xyz_auto', 'boradenikhil36@gmail.com', '1585895c560aa26d24f75b9b36453cef', NULL, '2024-02-16 00:00:00', NULL, 2, '', '', '', ''),
(435, 'KDMCC-22-ENTRY-69883_94509', 'xyz_auto', 'asdaa.98.17@gmail.com', 'c50fb5addbcb81bbb7532add8374a3e9', NULL, '2024-02-16 00:00:00', NULL, 2, '', '', '', ''),
(436, 'KDMCC-26-34485_582044', 'xyz_auto', 'gopinath.gandhe@gmail.com', '9aa074c8144272a2564974e4e2e6a6be', NULL, '2024-02-16 00:00:00', NULL, 2, '', '', '', ''),
(437, 'KDMCC-26-32219_579615', 'xyz_auto', 'phonemail9898@gmail.com', '8fbace99da7480f950381cadf4ddf7e1', NULL, '2024-02-16 00:00:00', NULL, 2, '', '', '', ''),
(438, 'KDMCC-25-ENTRY-143697_540785', 'xyz_auto', 'ar.santoshmadan@gmail.com', '620dff668bfc1a0c19efdaae447ac7b4', NULL, '2024-02-16 00:00:00', NULL, 2, '', '', '', ''),
(439, 'KDMCC-25-ENTRY-142928_539965', 'xyz_auto', 'ucassociates29@gmail.com', 'b90e3df4aba02de9a5d47b558d32568d', NULL, '2024-02-16 00:00:00', NULL, 2, '', '', '', ''),
(440, 'KDMCC-26-35423_583065', 'xyz_auto', 'vrs.roshan@gmail.com', '79520f9b9a526a9dc3907be558b5db09', NULL, '2024-02-16 00:00:00', NULL, 2, '', '', '', ''),
(441, 'KDMCC-26-ENTRY-16775_562601', 'xyz_auto', 'designteam@creations.org.in', 'a4ef2997fa05e0aeb892ba5de2764a11', NULL, '2024-02-16 00:00:00', NULL, 2, '', '', '', ''),
(442, 'KDMCC-24-51495_302209', 'xyz_auto', 'ankurshetye@gmail.com', '7dbc5b28d6a8228df4b3088ca30ba7b1', NULL, '2024-02-16 00:00:00', NULL, 2, '', '', '', ''),
(443, 'KDMCC-26-ENTRY-26833_573764', 'xyz_auto', 'sthapathyanirmaan@gmail.com', '5566e260821c0158cef63358411db36e', NULL, '2024-02-16 00:00:00', NULL, 2, '', '', '', ''),
(444, 'KDMCC-26-ENTRY-32463_579872', 'xyz_auto', 'kkkamble@yahoo.com', 'a638cab7d3e452879c2ea9823b7c2094', NULL, '2024-02-16 00:00:00', NULL, 2, '', '', '', ''),
(445, 'KDMCC-25-ENTRY-56227_445390', 'xyz_auto', 'ar.santoshmadan@gmail.com', 'ec532112cdc69c533d92d6273ca49bc5', NULL, '2024-02-16 00:00:00', NULL, 2, '', '', '', ''),
(446, 'KDMCC-26-ENTRY-38039_585931', 'xyz_auto', 'saliljoshi18@yahoo.com', '66b113382525b06bcce085d57bcd566f', NULL, '2024-02-16 00:00:00', NULL, 2, '', '', '', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accept_reject`
--
ALTER TABLE `accept_reject`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `accept_reject2`
--
ALTER TABLE `accept_reject2`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `application_form`
--
ALTER TABLE `application_form`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `application_mapping`
--
ALTER TABLE `application_mapping`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `authorization_sequence`
--
ALTER TABLE `authorization_sequence`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ccav_orders`
--
ALTER TABLE `ccav_orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cc_photo_inspection`
--
ALTER TABLE `cc_photo_inspection`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `certificate_data`
--
ALTER TABLE `certificate_data`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `commencement_certificate`
--
ALTER TABLE `commencement_certificate`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `commencement_certificate_deleted`
--
ALTER TABLE `commencement_certificate_deleted`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `demand`
--
ALTER TABLE `demand`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `final_decision`
--
ALTER TABLE `final_decision`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `inspection`
--
ALTER TABLE `inspection`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `label_names`
--
ALTER TABLE `label_names`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `login_token`
--
ALTER TABLE `login_token`
  ADD PRIMARY KEY (`id`),
  ADD KEY `token` (`token`(768));

--
-- Indexes for table `master_for_name_of_news_paper`
--
ALTER TABLE `master_for_name_of_news_paper`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `master_name_of_tree`
--
ALTER TABLE `master_name_of_tree`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `master_residence`
--
ALTER TABLE `master_residence`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `master_zone`
--
ALTER TABLE `master_zone`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `name_designation_master`
--
ALTER TABLE `name_designation_master`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `objections`
--
ALTER TABLE `objections`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `objections_hod_approval`
--
ALTER TABLE `objections_hod_approval`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `objections_payments`
--
ALTER TABLE `objections_payments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `occupancy_certificate`
--
ALTER TABLE `occupancy_certificate`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `oc_photo_inspection`
--
ALTER TABLE `oc_photo_inspection`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `paper_notice`
--
ALTER TABLE `paper_notice`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payment2`
--
ALTER TABLE `payment2`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `photo_of_inspection`
--
ALTER TABLE `photo_of_inspection`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `photo_of_inspection_refund`
--
ALTER TABLE `photo_of_inspection_refund`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `photo_of_tree`
--
ALTER TABLE `photo_of_tree`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `refund`
--
ALTER TABLE `refund`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `refund_inspection`
--
ALTER TABLE `refund_inspection`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `report_of_tree`
--
ALTER TABLE `report_of_tree`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`role_id`),
  ADD UNIQUE KEY `role_name` (`role_name`);

--
-- Indexes for table `role_permissions`
--
ALTER TABLE `role_permissions`
  ADD PRIMARY KEY (`permission_id`);

--
-- Indexes for table `temp_data`
--
ALTER TABLE `temp_data`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tablename` (`tablename`),
  ADD KEY `field` (`field`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `tippani_data`
--
ALTER TABLE `tippani_data`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tree_matrix_subentry`
--
ALTER TABLE `tree_matrix_subentry`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tree_report_matrix`
--
ALTER TABLE `tree_report_matrix`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_info`
--
ALTER TABLE `user_info`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accept_reject`
--
ALTER TABLE `accept_reject`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `accept_reject2`
--
ALTER TABLE `accept_reject2`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `application_form`
--
ALTER TABLE `application_form`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `application_mapping`
--
ALTER TABLE `application_mapping`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `authorization_sequence`
--
ALTER TABLE `authorization_sequence`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `ccav_orders`
--
ALTER TABLE `ccav_orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `cc_photo_inspection`
--
ALTER TABLE `cc_photo_inspection`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `certificate_data`
--
ALTER TABLE `certificate_data`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `commencement_certificate`
--
ALTER TABLE `commencement_certificate`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `commencement_certificate_deleted`
--
ALTER TABLE `commencement_certificate_deleted`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `demand`
--
ALTER TABLE `demand`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `final_decision`
--
ALTER TABLE `final_decision`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `inspection`
--
ALTER TABLE `inspection`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `label_names`
--
ALTER TABLE `label_names`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=382;

--
-- AUTO_INCREMENT for table `login_token`
--
ALTER TABLE `login_token`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `master_for_name_of_news_paper`
--
ALTER TABLE `master_for_name_of_news_paper`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `master_name_of_tree`
--
ALTER TABLE `master_name_of_tree`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=210;

--
-- AUTO_INCREMENT for table `master_residence`
--
ALTER TABLE `master_residence`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `master_zone`
--
ALTER TABLE `master_zone`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `name_designation_master`
--
ALTER TABLE `name_designation_master`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `objections`
--
ALTER TABLE `objections`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `objections_hod_approval`
--
ALTER TABLE `objections_hod_approval`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `objections_payments`
--
ALTER TABLE `objections_payments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `occupancy_certificate`
--
ALTER TABLE `occupancy_certificate`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `oc_photo_inspection`
--
ALTER TABLE `oc_photo_inspection`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `paper_notice`
--
ALTER TABLE `paper_notice`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `payment2`
--
ALTER TABLE `payment2`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `photo_of_inspection`
--
ALTER TABLE `photo_of_inspection`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `photo_of_inspection_refund`
--
ALTER TABLE `photo_of_inspection_refund`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `photo_of_tree`
--
ALTER TABLE `photo_of_tree`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `refund`
--
ALTER TABLE `refund`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `refund_inspection`
--
ALTER TABLE `refund_inspection`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `report_of_tree`
--
ALTER TABLE `report_of_tree`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `role_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `role_permissions`
--
ALTER TABLE `role_permissions`
  MODIFY `permission_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23636;

--
-- AUTO_INCREMENT for table `temp_data`
--
ALTER TABLE `temp_data`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tippani_data`
--
ALTER TABLE `tippani_data`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tree_matrix_subentry`
--
ALTER TABLE `tree_matrix_subentry`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tree_report_matrix`
--
ALTER TABLE `tree_report_matrix`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user_info`
--
ALTER TABLE `user_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=447;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
