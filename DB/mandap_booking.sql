-- phpMyAdmin SQL Dump
-- version 4.8.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 06, 2019 at 07:39 AM
-- Server version: 10.1.32-MariaDB
-- PHP Version: 7.2.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mandap_booking`
--

-- --------------------------------------------------------

--
-- Table structure for table `banners`
--

CREATE TABLE `banners` (
  `id` int(11) NOT NULL,
  `banner_photo` varchar(255) NOT NULL,
  `punch_line1` tinytext NOT NULL,
  `punch_line2` tinytext NOT NULL,
  `created_date` date NOT NULL,
  `updated_date` date NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `banners`
--

INSERT INTO `banners` (`id`, `banner_photo`, `punch_line1`, `punch_line2`, `created_date`, `updated_date`) VALUES
(6, 'B_1806181529302590.jpg', '', '', '2017-03-17', '2018-06-18'),
(7, 'B_1806181529302576.jpg', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit,', '', '2017-09-21', '2018-06-18'),
(8, 'B_1806181529302566.jpg', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco.', '2018-04-05', '2018-06-18'),
(11, 'B_1806181529302599.jpg', '', '', '2018-06-18', '2018-06-18');

-- --------------------------------------------------------

--
-- Table structure for table `booking_details`
--

CREATE TABLE `booking_details` (
  `booking_id` bigint(20) NOT NULL,
  `full_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `contact_no` varchar(55) NOT NULL,
  `address` varchar(255) NOT NULL,
  `special_notes` longtext,
  `booking_date` date NOT NULL,
  `booking_time` varchar(55) DEFAULT NULL,
  `mandap_booking_price` float NOT NULL,
  `total_booking_cost` float NOT NULL,
  `adv_amount` float NOT NULL,
  `adv_per` float NOT NULL,
  `booking_due` float NOT NULL,
  `transaction_id` varchar(255) DEFAULT NULL,
  `due_clear_status` varchar(55) NOT NULL,
  `due_clear_date` date DEFAULT NULL,
  `mandap_id` int(11) NOT NULL,
  `booking_reg_date` date NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `booking_details`
--

INSERT INTO `booking_details` (`booking_id`, `full_name`, `email`, `contact_no`, `address`, `special_notes`, `booking_date`, `booking_time`, `mandap_booking_price`, `total_booking_cost`, `adv_amount`, `adv_per`, `booking_due`, `transaction_id`, `due_clear_status`, `due_clear_date`, `mandap_id`, `booking_reg_date`) VALUES
(30, 'Suresh Kumar', 'suresh@bletindia.com', '9861245555', 'Test', 'Test1', '2018-06-29', NULL, 5000, 5000, 1000, 20, 4000, 'sfsdfsd132131', 'Pending', '2018-06-14', 1, '2018-06-11'),
(35, 'Sohan Subham', 'sohansubham12@gmail.com', '9861245555', 'Mancheswar', 'Nothing', '2018-06-19', NULL, 5000, 5000, 1000, 20, 4000, 'fb2a5d7dd6675189bc8f', 'Pending', NULL, 3, '2018-06-11'),
(36, 'Saroj Choudhry', 'saroj@bletindia.com', '989878788', 'Test', 'test1', '2018-06-19', NULL, 5000, 5000, 1000, 20, 4000, '5fc8427562d870d1d1ed', 'Pending', NULL, 1, '2018-06-11'),
(37, 'dd', 'dd@gmail.com', '24223432', 'asdsa', 'dasdsad', '2018-06-19', NULL, 5000, 5000, 1000, 20, 4000, 'asdasdasd3424234234', 'Pending', NULL, 4, '2018-06-12'),
(38, 'Suresh Kumar', 'suresh@bletindia.com', '9338455675', 'Test', 'Test1', '2018-06-19', NULL, 5000, 5010, 1002, 20, 4008, 'bb18dd8581c1f321dc44', 'Cleared', '2018-06-13', 2, '2018-06-13'),
(39, 'Test', 'test1@gmail.com', '2342342442', 'test2', 'test3', '2018-06-17', NULL, 5000, 5000, 1000, 20, 4000, '35ecfa2488bf77cde852', 'Pending', NULL, 1, '2018-06-14'),
(40, 'Test', 'test123@gmail.com', '2432423423', 'sfs', 'sfsd', '2018-06-17', NULL, 5000, 5000, 1000, 20, 4000, 'f15713522fb6610338e3', 'Pending', NULL, 2, '2018-06-14'),
(42, 'Skumar', 'suresh@bletindia.com', '9861245555', 'Test', 'Test', '2018-06-30', NULL, 5000, 5020, 1004, 20, 4016, 'TEST12312OK23423', 'Cleared', '2018-06-26', 2, '2018-06-22'),
(51, 'Skumar', 'suresh@bletindia.com', '3223542352', 'wrewerew', 'werew', '2018-06-30', NULL, 5000, 5008, 1001.6, 20, 4006.4, 'c3efd5ededc96277e9e7', 'Cleared', '2018-06-28', 1, '2018-06-27');

-- --------------------------------------------------------

--
-- Table structure for table `booking_extra_services`
--

CREATE TABLE `booking_extra_services` (
  `bes_id` bigint(20) NOT NULL,
  `booking_id` int(11) NOT NULL,
  `sub_cat_id` int(11) NOT NULL,
  `sub_cat_name` varchar(255) NOT NULL,
  `service_price` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `booking_extra_services`
--

INSERT INTO `booking_extra_services` (`bes_id`, `booking_id`, `sub_cat_id`, `sub_cat_name`, `service_price`) VALUES
(1, 30, 10, ' Bride room decoration ', 5),
(2, 30, 9, ' Mandap building decoration with lichu light ', 10),
(5, 30, 10, ' Bride room decoration ', 5),
(6, 30, 9, 'Mandap building decoration with lichu light ', 10),
(7, 38, 9, ' Mandap building decoration with lichu light ', 10),
(8, 41, 10, ' Bride room decoration ', 5),
(9, 41, 11, ' Groom Room Decoration ', 5),
(10, 41, 9, ' Mandap building decoration with lichu light ', 10),
(11, 42, 10, ' Bride room decoration ', 5),
(12, 42, 11, ' Groom Room Decoration ', 5),
(13, 42, 9, ' Mandap building decoration with lichu light ', 10),
(14, 43, 10, ' Bride room decoration ', 5),
(15, 43, 11, ' Groom Room Decoration ', 5),
(16, 44, 11, ' Groom Room Decoration ', 5),
(17, 47, 9, ' Mandap building decoration with lichu light ', 10),
(18, 48, 9, ' Mandap building decoration with lichu light ', 10),
(19, 49, 9, ' Mandap building decoration with lichu light ', 10),
(20, 50, 9, ' Mandap building decoration with lichu light ', 10),
(21, 50, 7, ' 1000 Watt 2 Sony box ', 10),
(22, 51, 11, ' Groom Room Decoration ', 5),
(23, 51, 6, ' 2 Sony explode box ', 3);

-- --------------------------------------------------------

--
-- Table structure for table `contents`
--

CREATE TABLE `contents` (
  `id` int(11) NOT NULL,
  `page_title` varchar(255) NOT NULL,
  `content` longtext NOT NULL,
  `meta_title` longtext NOT NULL,
  `meta_descr` longtext NOT NULL,
  `meta_keyword` longtext NOT NULL,
  `created_date` date NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `contents`
--

INSERT INTO `contents` (`id`, `page_title`, `content`, `meta_title`, `meta_descr`, `meta_keyword`, `created_date`) VALUES
(1, 'About SR Valley', '<p>Tdolor sit amet, consectetur, adipis civelit sed quia non qui dolorem ipsum quia dolor sit amet, consectetur, adipis civelit. Red quia numquam.</p>\r\n\r\n<p>Tdolor sit amet, consectetur, adipis civelit sed quia non qui dolorem ipsum quia dolor sit amet, consectetur, adipis civelit. Red quia numquam eius modi. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet 123</p>', 'About Us', 'About Us', 'About Us', '2015-11-27'),
(2, 'Booking terms & conditions', '<p>Ut eget dolor eu ex efficitur accumsan. Ut eros nibh, tincidunt nec imperdiet sit amet, aliquam eget leo. Ut finibus sollicitudin ultricies. Fusce a ex lectus. Donec sollicitudin mi leo, nec eleifend quam luctus vel. Morbi vel neque eu libero fermentum molestie. Nam posuere nunc id consequat tempus. Maecenas imperdiet maximus turpis at tincidunt. Phasellus fermentum turpis et libero feugiat, at porttitor eros vestibulum. Suspenisse enim dolor, semper eu ultricies id, tristique nec ipsum 123</p>', 'Booking terms & conditions', 'Booking terms & conditions', 'Booking terms & conditions', '2018-04-05');

-- --------------------------------------------------------

--
-- Table structure for table `core`
--

CREATE TABLE `core` (
  `id` int(11) NOT NULL,
  `admin_name` varchar(120) NOT NULL,
  `email` varchar(80) NOT NULL,
  `alt_email` varchar(80) NOT NULL,
  `contact_no` varchar(55) NOT NULL,
  `fax_no` varchar(55) NOT NULL,
  `mobile_no` varchar(55) NOT NULL,
  `address` varchar(255) NOT NULL,
  `password` longtext NOT NULL,
  `active_status` int(11) NOT NULL,
  `facebook_url` varchar(500) DEFAULT NULL,
  `twitter_url` varchar(500) DEFAULT NULL,
  `googleplus_url` varchar(255) DEFAULT NULL,
  `linkedin_url` varchar(255) DEFAULT NULL,
  `youtube_url` varchar(255) DEFAULT NULL,
  `instagram_url` varchar(500) DEFAULT NULL,
  `pinterest_url` varchar(255) DEFAULT NULL,
  `site_url` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `core`
--

INSERT INTO `core` (`id`, `admin_name`, `email`, `alt_email`, `contact_no`, `fax_no`, `mobile_no`, `address`, `password`, `active_status`, `facebook_url`, `twitter_url`, `googleplus_url`, `linkedin_url`, `youtube_url`, `instagram_url`, `pinterest_url`, `site_url`) VALUES
(1, 'Administrator', 'demo@demo.com', 'info@srvalleydomain.com', '0161 654 7220', '0161 653 9505', '+91 94370 7188', 'Plot No-58, Bankual, Odisha\r\nBhubaneswar- 751002', 'WkdWdGJ3PT0=', 1, 'http://facebook.com', 'https://twitter.com/', '', 'https://in.linkedin.com/', NULL, NULL, '', 'http://192.168.0.170/mandap_booking/');

-- --------------------------------------------------------

--
-- Table structure for table `email_template`
--

CREATE TABLE `email_template` (
  `id` int(11) NOT NULL,
  `title` varchar(255) CHARACTER SET utf8 NOT NULL,
  `contents` text CHARACTER SET utf8 NOT NULL,
  `created_date` date NOT NULL,
  `updated_on` date NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `email_template`
--

INSERT INTO `email_template` (`id`, `title`, `contents`, `created_date`, `updated_on`) VALUES
(1, 'Contact Us :: Email Template', '<table cellpadding=\"0\" cellspacing=\"0\" style=\"border-radius:25px; border:1px solid #EEE; box-shadow:0 0 5px rgba(0,0,0,0.1); margin:35px 25px; overflow:hidden; width:805px\">\r\n\r\n	<tbody>\r\n\r\n		<tr>\r\n\r\n			<td style=\"text-align:center\">\r\n\r\n			<img src=\"http://192.168.0.170/mandap_booking/public/images/logo.png\" style=\"float:left;\" /> \r\n\r\n			</td>\r\n\r\n		</tr>\r\n\r\n		<tr>\r\n\r\n			<td>\r\n\r\n			<div style=\"min-height:300px; padding:35px; color:#555; font-size:14px;\">Dear <strong>%ADMINNAME%</strong> ,<br />\r\n\r\n			&nbsp;\r\n\r\n			<div style=\"padding-left:30px; line-height:20px;\"><strong>Enquiry details as follows</strong><br />\r\n			<br />\r\n			<strong>Name :</strong> %NAME%<br />\r\n            <strong>Email :</strong> %EMAIL%<br />\r\n           \r\n            \r\n            <br /><strong>Message :</strong><br />\r\n            \r\n             %MESSAGE%\r\n            \r\n			\r\n			<br /><br />\r\n			&nbsp;</div>\r\n\r\n			Thanks<br />\r\n\r\n			<strong>%ADMINNAME%</strong><br />\r\n			<strong>%ADMINEMAIL%</strong>\r\n            </div>\r\n\r\n			</td>\r\n\r\n		</tr>\r\n\r\n		<tr>\r\n\r\n			<td>\r\n\r\n			<div style=\"padding:15px; text-align:center; font-size:12px; color:#999;\">Copyright &copy; %CURRENTYEAR% SR Valley.  </div>\r\n\r\n			</td>\r\n\r\n		</tr>\r\n\r\n	</tbody>\r\n\r\n</table>', '2018-06-08', '2018-06-08'),
(3, 'Forgot Password Mail :: User', '<body>\r\n  <table width=\"805\" style=\"border-radius:25px; overflow:hidden; border:1px solid #EEE; margin:35px 25px; box-shadow:0 0 5px rgba(0,0,0,0.1);\" cellpadding=\"0\" cellspacing=\"0\">\r\n    <tr>\r\n        <td style=\"background:#FFF; text-align:center;\">\r\n           <img src=\"http://192.168.0.170/mandap_booking/public/images/logo.png\" style=\"float:left;\" />\r\n        </td>\r\n    </tr>\r\n    \r\n    <tr>\r\n        <td>\r\n          <div style=\"min-height:300px; padding:35px; color:#555; font-size:14px;\">\r\n              Dear <strong>%USERNAME%</strong> ,\r\n              <div style=\"padding-left:30px; line-height:20px;\">\r\n                <strong style=\"font-size:20px;\"><br/>\r\n                    Your Login credential details as follows.\r\n                </strong><br/><br/>\r\n                \r\n                <strong>Email :</strong> %USEREMAIL% <br>\r\n                <strong>Password: </strong> %USERPASSWORD% <br>\r\n                <br/><br/>\r\n                \r\n              </div>\r\n              Thanks<br/>\r\n              <strong>%ADMINNAME%</strong><br/>\r\n              <strong>%ADMINEMAIL%</strong>\r\n          </div>\r\n        </td>\r\n    </tr>\r\n    \r\n    <tr>\r\n      <td style=\"background:#EEE;\">\r\n          <div style=\"padding:15px; text-align:center; font-size:12px; color:#999;\">\r\n          Copyright &copy; %CURRENTYEAR% SR Valley.\r\n          </div>\r\n      </td>\r\n    </tr>\r\n  </table>\r\n</body>', '2018-06-16', '2018-06-16'),
(4, 'Forgot Password Mail :: Admin', '<body>\r\n  <table width=\"805\" style=\"border-radius:25px; overflow:hidden; border:1px solid #EEE; margin:35px 25px; box-shadow:0 0 5px rgba(0,0,0,0.1);\" cellpadding=\"0\" cellspacing=\"0\">\r\n    <tr>\r\n        <td style=\"background:#FFF; text-align:center;\">\r\n           <img src=\"http://192.168.0.170/mandap_booking/public/images/logo.png\" style=\"float:left;\" />\r\n        </td>\r\n    </tr>\r\n    \r\n    <tr>\r\n        <td>\r\n          <div style=\"min-height:300px; padding:35px; color:#555; font-size:14px;\">\r\n              Dear <strong>%ADMINNAME%</strong> ,\r\n              <div style=\"padding-left:30px; line-height:20px;\">\r\n                <strong style=\"font-size:20px;\"><br/>\r\n                    Your Login credential details as follows.\r\n                </strong><br/><br/>\r\n                \r\n                <strong>Email :</strong> %ADMINEMAIL% <br>\r\n                <strong>Password: </strong> %ADMINPASSWORD% <br>\r\n                <br/><br/>\r\n                \r\n              </div>\r\n              Thanks<br/>\r\n              <strong>%ADMINNAME%</strong><br/>\r\n              <strong>%FROMEMAIL%</strong>\r\n          </div>\r\n        </td>\r\n    </tr>\r\n    <tr>\r\n      <td style=\"background:#EEE;\">\r\n          <div style=\"padding:15px; text-align:center; font-size:12px; color:#999;\">Copyright &copy; %CURRENTYEAR% SR Valley.</div>\r\n      </td>\r\n    </tr>\r\n  </table>\r\n</body>', '2018-06-05', '2018-06-05'),
(9, 'Newsletter :: SR Vally', '<table cellpadding=\"0\" cellspacing=\"0\" style=\"border-radius:25px; border:1px solid #EEE; box-shadow:0 0 5px rgba(0,0,0,0.1); margin:35px 25px; overflow:hidden; width:805px\">\r\n\r\n	<tbody>\r\n\r\n		<tr>\r\n\r\n			<td style=\"text-align:center\">\r\n\r\n			<img src=\"http://192.168.0.170/mandap_booking/public/images/logo.png\" style=\"float:left;\" /> \r\n\r\n			</td>\r\n\r\n		</tr>\r\n\r\n		<tr>\r\n\r\n			<td>\r\n\r\n			<div style=\"min-height:300px; padding:35px; color:#555; font-size:14px;\">Dear <strong>Members</strong>,<br />\r\n\r\n			&nbsp;\r\n\r\n			<div style=\"padding-left:30px; line-height:20px;\">\r\n            Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.\r\n            <br /><br /><br />\r\n\r\n			&nbsp;</div>\r\n\r\n            Thanks<br/>\r\n            <strong>%ADMINNAME%</strong><br/>\r\n            <strong>%ADMINEMAIL%</strong>\r\n            \r\n            </div>\r\n\r\n			</td>\r\n\r\n		</tr>\r\n\r\n		<tr>\r\n\r\n			<td>\r\n\r\n			<div style=\"padding:15px; text-align:center; font-size:12px; color:#999;\">Copyright &copy; %CURRENTYEAR% SR Valley.</div>\r\n\r\n			</td>\r\n\r\n		</tr>\r\n\r\n	</tbody>\r\n\r\n</table>', '2017-06-12', '2018-06-12');

-- --------------------------------------------------------

--
-- Table structure for table `mandap_types`
--

CREATE TABLE `mandap_types` (
  `mt_id` int(11) NOT NULL,
  `mandap_type` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mandap_types`
--

INSERT INTO `mandap_types` (`mt_id`, `mandap_type`) VALUES
(1, 'Lan-1'),
(2, 'Lan-2'),
(3, 'Lan-3'),
(4, 'lan-4');

-- --------------------------------------------------------

--
-- Table structure for table `newsletter`
--

CREATE TABLE `newsletter` (
  `id` int(11) NOT NULL,
  `nl_email` varchar(255) NOT NULL,
  `subscribe_date` date NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `newsletter`
--

INSERT INTO `newsletter` (`id`, `nl_email`, `subscribe_date`) VALUES
(6, 'suresh@bletindia.com', '2017-10-13'),
(22, 'demo@demo.com', '2018-06-07');

-- --------------------------------------------------------

--
-- Table structure for table `payment_settings`
--

CREATE TABLE `payment_settings` (
  `id` int(11) NOT NULL,
  `payment_getway_environment` varchar(255) NOT NULL,
  `merchant_key` varchar(255) NOT NULL,
  `salt` varchar(255) NOT NULL,
  `adv_per` float NOT NULL,
  `no_book_per_day` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `payment_settings`
--

INSERT INTO `payment_settings` (`id`, `payment_getway_environment`, `merchant_key`, `salt`, `adv_per`, `no_book_per_day`) VALUES
(1, 'sandbox', 'e5jCDRrh', 'GjpUsgXW55', 20, 4);

-- --------------------------------------------------------

--
-- Table structure for table `photo_gallery`
--

CREATE TABLE `photo_gallery` (
  `ph_id` bigint(20) NOT NULL,
  `photo_title` varchar(255) NOT NULL,
  `gallery_photo` varchar(255) NOT NULL,
  `created_date` date NOT NULL,
  `updated_date` date NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `photo_gallery`
--

INSERT INTO `photo_gallery` (`ph_id`, `photo_title`, `gallery_photo`, `created_date`, `updated_date`) VALUES
(2, 'Test1', 'GP_1906181529391685.jpg', '2018-06-19', '2018-06-19'),
(3, 'Test2', 'GP_1906181529391607.jpg', '2018-06-19', '2018-06-19'),
(4, 'Test3', 'GP_1906181529391617.jpg', '2018-06-19', '2018-06-19'),
(5, 'Test4', 'GP_1906181529391626.jpg', '2018-06-19', '2018-06-19'),
(6, 'Test5', 'GP_1906181529391646.jpg', '2018-06-19', '2018-06-19');

-- --------------------------------------------------------

--
-- Table structure for table `seo`
--

CREATE TABLE `seo` (
  `id` int(11) NOT NULL,
  `meta_title` varchar(1000) NOT NULL,
  `meta_descr` varchar(1000) NOT NULL,
  `meta_keyword` varchar(1000) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `seo`
--

INSERT INTO `seo` (`id`, `meta_title`, `meta_descr`, `meta_keyword`) VALUES
(1, 'SR Valley | Bhubaneswar', 'SR Valley | Bhubaneswar', 'SR Valley | Bhubaneswar');

-- --------------------------------------------------------

--
-- Table structure for table `service_categories`
--

CREATE TABLE `service_categories` (
  `cat_id` int(11) NOT NULL,
  `category_name` varchar(255) NOT NULL,
  `cat_seo_name` varchar(255) NOT NULL,
  `category_photo` varchar(255) NOT NULL,
  `abt_ser_cat` longtext NOT NULL,
  `created_date` date NOT NULL,
  `updated_date` date NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `service_categories`
--

INSERT INTO `service_categories` (`cat_id`, `category_name`, `cat_seo_name`, `category_photo`, `abt_ser_cat`, `created_date`, `updated_date`) VALUES
(1, 'Default Services', 'default-services', 'C_0606181528288678.jpg', '', '2018-06-06', '2018-06-06'),
(2, 'Sound', 'sound', 'C_0606181528288719.jpg', '<p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using &#39;Content here, content here&#39;, making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for &#39;lorem ipsum&#39; will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose</p>', '2018-06-06', '2018-06-06'),
(3, 'Light', 'light', 'C_0606181528288749.jpg', '<p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using &#39;Content here, content here&#39;, making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for &#39;lorem ipsum&#39; will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose</p>', '2018-06-06', '2018-06-06'),
(4, 'Decoration', 'decoration', 'C_0606181528288770.jpg', '<p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using &#39;Content here, content here&#39;, making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for &#39;lorem ipsum&#39; will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose</p>', '2018-06-06', '2018-06-06'),
(5, 'Fooding', 'fooding', 'C_0606181528288786.jpg', '<p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using &#39;Content here, content here&#39;, making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for &#39;lorem ipsum&#39; will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose</p>', '2018-06-06', '2018-06-06'),
(6, 'Flower', 'flower', 'C_0606181528288799.jpg', '<p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using &#39;Content here, content here&#39;, making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for &#39;lorem ipsum&#39; will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose</p>', '2018-06-06', '2018-06-06'),
(7, 'Catering', 'catering', 'C_0606181528288814.jpg', '<p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using &#39;Content here, content here&#39;, making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for &#39;lorem ipsum&#39; will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).</p>', '2018-06-06', '2018-06-06'),
(8, 'Cleaning', 'cleaning', 'C_0606181528288832.jpg', '<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining&nbsp;</p>\r\n\r\n<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining es...</p>', '2018-06-06', '2018-06-06'),
(9, 'Test56', 'test56', 'C_0706181528377770.jpg', '<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>', '2018-06-07', '2018-06-07');

-- --------------------------------------------------------

--
-- Table structure for table `service_sub_categories`
--

CREATE TABLE `service_sub_categories` (
  `sub_cat_id` int(11) NOT NULL,
  `cat_id` int(11) NOT NULL,
  `sub_cat_name` varchar(255) NOT NULL,
  `sub_cat_seo_name` varchar(255) NOT NULL,
  `service_price` float NOT NULL,
  `created_date` date NOT NULL,
  `updated_date` date NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `service_sub_categories`
--

INSERT INTO `service_sub_categories` (`sub_cat_id`, `cat_id`, `sub_cat_name`, `sub_cat_seo_name`, `service_price`, `created_date`, `updated_date`) VALUES
(1, 1, 'Mandap Booking', 'mandap-booking', 5000, '2018-06-08', '2018-06-08'),
(2, 1, '1800 SF Dining Hall', '1800-sf-dining-hall', 0, '2018-06-08', '2018-06-08'),
(3, 1, '1 Room for Bride', '1-room-for-bride', 0, '2018-06-08', '2018-06-08'),
(4, 1, '1 Room for Groom', '1-room-for-groom', 0, '2018-06-08', '2018-06-08'),
(5, 2, '2 JBL BOX', '2-jbl-box', 5, '2018-06-08', '2018-06-08'),
(6, 2, '2 Sony explode box', '2-sony-explode-box', 3, '2018-06-08', '2018-06-08'),
(7, 2, '1000 Watt 2 Sony box', '1000-watt-2-sony-box', 10, '2018-06-11', '2018-06-11'),
(8, 2, '500 Watt 2 sony box', '500-watt-2-sony-box', 5, '2018-06-11', '2018-06-11'),
(9, 3, 'Mandap building decoration with lichu light', 'mandap-building-decoration-with-lichu-light', 10, '2018-06-11', '2018-06-11'),
(10, 4, 'Bride room decoration', 'bride-room-decoration', 5, '2018-06-11', '2018-06-11'),
(11, 4, 'Groom Room Decoration', 'groom-room-decoration', 5, '2018-06-11', '2018-06-11');

-- --------------------------------------------------------

--
-- Table structure for table `testimonials`
--

CREATE TABLE `testimonials` (
  `tm_id` bigint(20) NOT NULL,
  `tm_user_name` varchar(255) NOT NULL,
  `tm_det` text NOT NULL,
  `tm_photo` varchar(255) DEFAULT NULL,
  `created_date` datetime NOT NULL,
  `updated_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `testimonials`
--

INSERT INTO `testimonials` (`tm_id`, `tm_user_name`, `tm_det`, `tm_photo`, `created_date`, `updated_date`) VALUES
(1, 'Malaya', 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters', 'TM_0706181528363850.png', '2018-06-07 00:00:00', '2018-06-07 00:00:00'),
(2, 'Skumar', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries,', 'TM_0706181528363824.png', '2018-06-07 00:00:00', '2018-06-07 00:00:00'),
(3, 'Sarika', 's opposed to using \'Content here, content here\', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy.', 'TM_0706181528363876.png', '2018-06-07 00:00:00', '2018-06-07 00:00:00'),
(4, 'Mahi', 'remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', 'TM_0706181528363896.png', '2018-06-07 00:00:00', '2018-06-07 00:00:00'),
(5, 'Jadu', 'remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', '', '2018-06-07 00:00:00', '2018-06-07 00:00:00'),
(6, 'Skumar', 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \'Content here, content here\', making it look like readable English.', 'TM_1106181528693610.png', '2018-06-11 00:00:00', '2018-06-11 00:00:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `banners`
--
ALTER TABLE `banners`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `booking_details`
--
ALTER TABLE `booking_details`
  ADD PRIMARY KEY (`booking_id`);

--
-- Indexes for table `booking_extra_services`
--
ALTER TABLE `booking_extra_services`
  ADD PRIMARY KEY (`bes_id`);

--
-- Indexes for table `contents`
--
ALTER TABLE `contents`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `core`
--
ALTER TABLE `core`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `email_template`
--
ALTER TABLE `email_template`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mandap_types`
--
ALTER TABLE `mandap_types`
  ADD PRIMARY KEY (`mt_id`);

--
-- Indexes for table `newsletter`
--
ALTER TABLE `newsletter`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payment_settings`
--
ALTER TABLE `payment_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `photo_gallery`
--
ALTER TABLE `photo_gallery`
  ADD PRIMARY KEY (`ph_id`);

--
-- Indexes for table `seo`
--
ALTER TABLE `seo`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `service_categories`
--
ALTER TABLE `service_categories`
  ADD PRIMARY KEY (`cat_id`);

--
-- Indexes for table `service_sub_categories`
--
ALTER TABLE `service_sub_categories`
  ADD PRIMARY KEY (`sub_cat_id`);

--
-- Indexes for table `testimonials`
--
ALTER TABLE `testimonials`
  ADD PRIMARY KEY (`tm_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `banners`
--
ALTER TABLE `banners`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `booking_details`
--
ALTER TABLE `booking_details`
  MODIFY `booking_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT for table `booking_extra_services`
--
ALTER TABLE `booking_extra_services`
  MODIFY `bes_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `contents`
--
ALTER TABLE `contents`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `core`
--
ALTER TABLE `core`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `email_template`
--
ALTER TABLE `email_template`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `mandap_types`
--
ALTER TABLE `mandap_types`
  MODIFY `mt_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `newsletter`
--
ALTER TABLE `newsletter`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `payment_settings`
--
ALTER TABLE `payment_settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `photo_gallery`
--
ALTER TABLE `photo_gallery`
  MODIFY `ph_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `seo`
--
ALTER TABLE `seo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `service_categories`
--
ALTER TABLE `service_categories`
  MODIFY `cat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `service_sub_categories`
--
ALTER TABLE `service_sub_categories`
  MODIFY `sub_cat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `testimonials`
--
ALTER TABLE `testimonials`
  MODIFY `tm_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
