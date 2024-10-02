-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 12, 2024 at 07:27 AM
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
-- Database: `ams`
--

-- --------------------------------------------------------

--
-- Table structure for table `tenants`
--

CREATE TABLE `tenants` (
  `r_id` bigint(20) UNSIGNED NOT NULL,
  `landlord_id` bigint(20) DEFAULT NULL,
  `r_name` text DEFAULT NULL,
  `father` text DEFAULT NULL,
  `total_family_member` int(11) DEFAULT NULL,
  `birthday` date DEFAULT NULL,
  `marital_status` text DEFAULT NULL,
  `r_phone` varchar(100) DEFAULT NULL,
  `r_email` varchar(100) DEFAULT NULL,
  `per_address` varchar(255) DEFAULT NULL,
  `occupation` text DEFAULT NULL,
  `company` text DEFAULT NULL,
  `religion` text DEFAULT NULL,
  `qualification` text DEFAULT NULL,
  `r_nid` text DEFAULT NULL,
  `p` int(11) DEFAULT NULL,
  `e_full_name` text DEFAULT NULL,
  `e_rel` text DEFAULT NULL,
  `e_add` text DEFAULT NULL,
  `e_phone` text DEFAULT NULL,
  `member_name_one` text DEFAULT NULL,
  `member_age_one` int(11) DEFAULT NULL,
  `member_occupation_one` text DEFAULT NULL,
  `member_phone_one` text DEFAULT NULL,
  `member_name_two` text DEFAULT NULL,
  `member_age_two` int(11) DEFAULT NULL,
  `member_occupation_two` text DEFAULT NULL,
  `member_phone_two` text DEFAULT NULL,
  `member_name_three` text DEFAULT NULL,
  `member_age_three` int(11) DEFAULT NULL,
  `member_occupation_three` text DEFAULT NULL,
  `member_phone_three` text DEFAULT NULL,
  `maid_name` text DEFAULT NULL,
  `maid_nid` bigint(20) DEFAULT NULL,
  `maid_phone` text DEFAULT NULL,
  `maid_address` text DEFAULT NULL,
  `driver_name` text DEFAULT NULL,
  `driver_nid` text DEFAULT NULL,
  `driver_phone` text DEFAULT NULL,
  `driver_address` text DEFAULT NULL,
  `pre_owner_name` text DEFAULT NULL,
  `pre_owner_phone` text DEFAULT NULL,
  `pre_owner_address` text DEFAULT NULL,
  `reason` text DEFAULT NULL,
  `new_owner_name` text DEFAULT NULL,
  `new_owner_phone` text DEFAULT NULL,
  `new_house_start_date` date DEFAULT NULL,
  `r_image` text DEFAULT NULL,
  `renter_status` int(11) NOT NULL DEFAULT 1 COMMENT '1=active || 0=inactive',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `tenants`
--

INSERT INTO `tenants` (`r_id`, `landlord_id`, `r_name`, `father`, `total_family_member`, `birthday`, `marital_status`, `r_phone`, `r_email`, `per_address`, `occupation`, `company`, `religion`, `qualification`, `r_nid`, `p`, `e_full_name`, `e_rel`, `e_add`, `e_phone`, `member_name_one`, `member_age_one`, `member_occupation_one`, `member_phone_one`, `member_name_two`, `member_age_two`, `member_occupation_two`, `member_phone_two`, `member_name_three`, `member_age_three`, `member_occupation_three`, `member_phone_three`, `maid_name`, `maid_nid`, `maid_phone`, `maid_address`, `driver_name`, `driver_nid`, `driver_phone`, `driver_address`, `pre_owner_name`, `pre_owner_phone`, `pre_owner_address`, `reason`, `new_owner_name`, `new_owner_phone`, `new_house_start_date`, `r_image`, `renter_status`, `created_at`, `updated_at`) VALUES
(7, 1, 'selim', 'helal', 10, '2024-09-11', 'Married', '01720000', 'wliidk@gmail.com', 'dhaka', 'Businessman', 'Byte care limited', 'Islam', 'N/A', '6541656', NULL, 'sohel', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-09-11', '20240912090406.jpg', 1, '2024-09-11 04:18:26', '2024-09-11 22:44:06'),
(8, 1, 'Serena Kirkland', 'Dolor ducimus imped', 16, '2007-07-15', 'Unmarried', '+1 (285) 571-1955', 'baxuj@mailinator.com', 'Asperiores vel et se', 'Student', 'Sargent Maddox Traders', 'Hinduism', 'Ph.D', '27', 20, 'Laurel Carpenter', 'Blanditiis cillum ir', 'Magna ipsum esse se', '+1 (883) 902-6793', 'Vance Stanley', 9, 'Self Employed', '+1 (989) 857-4113', 'Irma Little', 38, 'Housewife', '+1 (887) 879-1361', 'Nerea Brady', 38, 'Housewife', '+1 (912) 668-7113', 'Quynn Holcomb', 23, '+1 (213) 837-6252', 'Mollit accusantium m', 'Randall Wooten', '78', '+1 (825) 478-3359', 'Commodo voluptate of', 'Uriel Wyatt', '+1 (206) 621-5904', 'Nemo ipsam amet ill', 'Illum amet necessi', 'Jaime Hendricks', '+1 (223) 397-9943', '2012-09-13', '', 1, '2024-09-11 22:27:29', '2024-09-11 22:27:29');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tenants`
--
ALTER TABLE `tenants`
  ADD PRIMARY KEY (`r_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tenants`
--
ALTER TABLE `tenants`
  MODIFY `r_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

