-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jul 02, 2025 at 01:26 PM
-- Server version: 10.5.29-MariaDB
-- PHP Version: 8.3.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tirthrajtimes_invoice`
--

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` int(11) NOT NULL,
  `invoice` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `address_1` varchar(255) NOT NULL,
  `address_2` varchar(255) NOT NULL,
  `town` varchar(255) NOT NULL,
  `county` varchar(255) NOT NULL,
  `postcode` varchar(255) NOT NULL,
  `phone` varchar(100) NOT NULL,
  `name_ship` varchar(255) NOT NULL,
  `address_1_ship` varchar(255) NOT NULL,
  `address_2_ship` varchar(255) NOT NULL,
  `town_ship` varchar(255) NOT NULL,
  `county_ship` varchar(255) NOT NULL,
  `postcode_ship` varchar(255) NOT NULL,
  `gstin_no` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `invoice`, `name`, `email`, `address_1`, `address_2`, `town`, `county`, `postcode`, `phone`, `name_ship`, `address_1_ship`, `address_2_ship`, `town_ship`, `county_ship`, `postcode_ship`, `gstin_no`) VALUES
(1, '1', 'M G ADVERTISING SERVICES', '', 'M-23 PHASE 1 BADLI INDUSTRIAL ESTATE', 'DELHI', 'DELHI', '', '110042', '8354850018', '', '', '', '', '', '', '09AEVPJ0791E1Z5'),
(2, '2', 'FALCON ADVERTISERS', '', '135/119 HEWETT ROAD', '0', ' PRAYAGRAJ', 'UTTAR PRADESH', ' 211003', '', '', '', '', '', '', '', '09AAAFW3963A1ZA'),
(3, '3', 'ANU IMAGE MAKER ADVT. PVT. LTD.', '', '45, SANGAM PLACE, CIVIL LINES', '0', ' PRAYAGRAJ', 'UTTAR PRADESH', ' 211001', '', '', '', '', '', '', '', '09AACCA0278K1ZL'),
(4, '4', 'DEGREE 360 SOLUTIONS PVT LTD.', '', 'THIRD FLOOR HS-38 OMICRON 1GAUTAM BUDDHA NAGAR GREATER NOIDA ', '0', 'UTTAR PRADESH', '', '201310', '', '', '', '', '', '', '', '09AACCD3150H1ZW'),
(5, '5', 'DEGREE 360 SOLUTIONS PVT LTD.', '', 'THIRD FLOOR HS-38 OMICRON 1GAUTAM BUDDHA NAGAR GREATER NOIDA ', '0', 'UTTAR PRADESH', '', '201310', '', '', '', '', '', '', '', '09AACCD3150H1ZW'),
(6, '6', 'FALCON ADVERTISERS', '', '135/119 HEWETT ROAD', '0', ' PRAYAGRAJ', 'UTTAR PRADESH', ' 211003', '', '', '', '', '', '', '', '09AAAFW3963A1ZA'),
(7, '7', 'DOT COMMUNICATIONS', '', '304 SHALIMAR SQUARE', '0', ' LALBAGH', ' LUCKNOW U.P.', '226001', '', '', '', '', '', '', '', '09AAICD2362D1ZU'),
(8, '8', 'DOT COMMUNICATIONS', '', '304 SHALIMAR SQUARE', '0', ' LALBAGH', ' LUCKNOW U.P.', '226001', '', '', '', '', '', '', '', '09AAICD2362D1ZU'),
(9, '9', 'ADMAN ADVERTISING', '', '201-202 MOHAN COMPLEX ASHOK VIHAR PHASE-I', '0', 'DELHI', '', '110052', '8354850018', '', '', '', '', '', '', '07AAAFA7942D1ZR'),
(10, '10', 'FALCON ADVERTISERS', '', '135/119 HEWETT ROAD', '0', ' PRAYAGRAJ', 'UTTAR PRADESH', ' 211003', '', '', '', '', '', '', '', '09AAAFW3963A1ZA'),
(11, '11', 'FALCON ADVERTISERS', '', '135/119 HEWETT ROAD', '0', ' PRAYAGRAJ', 'UTTAR PRADESH', ' 211003', '', '', '', '', '', '', '', '09AAAFW3963A1ZA'),
(12, '12', 'CRITIQUE COMMUNICATIONS PVT LTD', '', '602 6TH FLOOR AKASHDEEP BUILDING BARAKHAMBA ROAD ', '0', 'NEW DELHI', '', '11001', '9792822200', '', '', '', '', '', '', '07AABCC3732H1ZY'),
(13, '13', 'DEGREE 360 SOLUTIONS PVT LTD.', '', 'THIRD FLOOR HS-38 OMICRON 1GAUTAM BUDDHA NAGAR GREATER NOIDA ', '0', 'UTTAR PRADESH', '', '201310', '', '', '', '', '', '', '', '09AACCD3150H1ZW'),
(14, '14', 'ANU IMAGE MAKER ADVT. PVT. LTD.', '', '45, SANGAM PLACE, CIVIL LINES', '0', ' PRAYAGRAJ', 'UTTAR PRADESH', ' 211001', '', '', '', '', '', '', '', '09AACCA0278K1ZL'),
(15, '15', 'ANU IMAGE MAKER ADVT. PVT. LTD.', '', '45, SANGAM PLACE, CIVIL LINES', '0', ' PRAYAGRAJ', 'UTTAR PRADESH', ' 211001', '', '', '', '', '', '', '', '09AACCA0278K1ZL'),
(16, '16', 'ADMAN ADVERTISING', '', '201-202 MOHAN COMPLEX ASHOK VIHAR PHASE-I', '0', 'DELHI', '', '110052', '8354850018', '', '', '', '', '', '', '07AAAFA7942D1ZR'),
(17, '17', 'FALCON ADVERTISERS', '', '135/119 HEWETT ROAD', '0', ' PRAYAGRAJ', 'UTTAR PRADESH', ' 211003', '', '', '', '', '', '', '', '09AAAFW3963A1ZA'),
(19, '18', 'AIRADS LIMITED ', '', '433 FUNCTIONAL INDUSTRIAL ESTATE PATPARGANJ', '0', 'DELHI', '', '110092', '9871021616', '', '', '', '', '', '', '07AAACA5793R1ZZ'),
(20, '20', 'CRITIQUE COMMUNICATIONS PVT LTD', '', '602 6TH FLOOR AKASHDEEP BUILDING BARAKHAMBA ROAD ', '0', 'NEW DELHI', '', '11001', '9792822200', '', '', '', '', '', '', '07AABCC3732H1ZY'),
(21, '21', 'ADMAN ADVERTISING', '', '201-202 MOHAN COMPLEX ASHOK VIHAR PHASE-I', '0', 'DELHI', '', '110052', '8354850018', '', '', '', '', '', '', '07AAAFA7942D1ZR'),
(22, '22', 'M G ADVERTISING SERVICES', '', 'M-23 PHASE 1 BADLI INDUSTRIAL ESTATE', '0', 'DELHI', '', '110042', '8354850018', '', '', '', '', '', '', '09AEVPJ0791E1Z5'),
(23, '23', 'AIRADS LIMITED ', '', '433 FUNCTIONAL INDUSTRIAL ESTATE PATPARGANJ', '0', 'DELHI', '', '110092', '9871021616', '', '', '', '', '', '', '07AAACA5793R1ZZ'),
(24, '24', 'ANU IMAGE MAKER ADVT. PVT. LTD.', '', '45, SANGAM PLACE, CIVIL LINES', '0', ' PRAYAGRAJ', 'UTTAR PRADESH', ' 211001', '', '', '', '', '', '', '', '09AACCA0278K1ZL'),
(25, '25', 'ADMAN ADVERTISING', '', '201-202 MOHAN COMPLEX ASHOK VIHAR PHASE-I', '0', 'DELHI', '', '110052', '8354850018', '', '', '', '', '', '', '07AAAFA7942D1ZR'),
(26, '26', 'AIRADS LIMITED ', '', '433 FUNCTIONAL INDUSTRIAL ESTATE PATPARGANJ', '0', 'DELHI', '', '110092', '9871021616', '', '', '', '', '', '', '07AAACA5793R1ZZ'),
(27, '27', 'AIRADS LIMITED ', '', '433 FUNCTIONAL INDUSTRIAL ESTATE PATPARGANJ', '0', 'DELHI', '', '110092', '9871021616', '', '', '', '', '', '', '07AAACA5793R1ZZ'),
(28, '28', 'ANU IMAGE MAKER ADVT. PVT. LTD.', '', '45, SANGAM PLACE, CIVIL LINES', '0', ' PRAYAGRAJ', 'UTTAR PRADESH', ' 211001', '', '', '', '', '', '', '', '09AACCA0278K1ZL'),
(29, '29', 'DEGREE 360 SOLUTIONS PVT LTD.', '', 'THIRD FLOOR HS-38 OMICRON 1GAUTAM BUDDHA NAGAR GREATER NOIDA ', '0', 'UTTAR PRADESH', '', '201310', '', '', '', '', '', '', '', '09AACCD3150H1ZW'),
(30, '30', 'FALCON ADVERTISERS', '', '135/119 HEWETT ROAD', '0', ' PRAYAGRAJ', 'UTTAR PRADESH', ' 211003', '', '', '', '', '', '', '', '09AAAFW3963A1ZA'),
(31, '31', 'AIRADS LIMITED ', '', '433 FUNCTIONAL INDUSTRIAL ESTATE PATPARGANJ', '0', 'DELHI', '', '110092', '9871021616', '', '', '', '', '', '', '07AAACA5793R1ZZ'),
(32, '32', 'FALCON ADVERTISERS', '', '135/119 HEWETT ROAD', '0', ' PRAYAGRAJ', 'UTTAR PRADESH', ' 211003', '', '', '', '', '', '', '', '09AAAFW3963A1ZA'),
(33, '33', 'DOT COMMUNICATIONS', '', '304 SHALIMAR SQUARE', '0', ' LALBAGH', ' LUCKNOW U.P.', '226001', '', '', '', '', '', '', '', '09AAICD2362D1ZU'),
(34, '34', 'DOT COMMUNICATIONS', '', '304 SHALIMAR SQUARE', '0', ' LALBAGH', ' LUCKNOW U.P.', '226001', '', '', '', '', '', '', '', '09AAICD2362D1ZU'),
(35, '35', 'ADMAN ADVERTISING', '', '201-202 MOHAN COMPLEX ASHOK VIHAR PHASE-I', '0', 'DELHI', '', '110052', '8354850018', '', '', '', '', '', '', '07AAAFA7942D1ZR'),
(36, '36', 'ANU IMAGE MAKER ADVT. PVT. LTD.', '', '45, SANGAM PLACE, CIVIL LINES', '0', ' PRAYAGRAJ', 'UTTAR PRADESH', ' 211001', '', '', '', '', '', '', '', '09AACCA0278K1ZL'),
(37, '37', 'M G ADVERTISING SERVICES', '', 'M-23 PHASE 1 BADLI INDUSTRIAL ESTATE', '0', 'DELHI', '', '110042', '8354850018', '', '', '', '', '', '', '09AEVPJ0791E1Z5'),
(38, '38', 'ANU IMAGE MAKER ADVT. PVT. LTD.', '', '45, SANGAM PLACE, CIVIL LINES', '0', ' PRAYAGRAJ', 'UTTAR PRADESH', ' 211001', '', '', '', '', '', '', '', '09AACCA0278K1ZL'),
(39, '39', 'CRITIQUE COMMUNICATIONS PVT LTD', '', '602 6TH FLOOR AKASHDEEP BUILDING BARAKHAMBA ROAD ', '0', 'NEW DELHI', '', '11001', '9792822200', '', '', '', '', '', '', '07AABCC3732H1ZY'),
(40, '40', 'ADMAN ADVERTISING', '', '201-202 MOHAN COMPLEX ASHOK VIHAR PHASE-I', '0', 'DELHI', '', '110052', '8354850018', '', '', '', '', '', '', '07AAAFA7942D1ZR'),
(41, '41', 'ANU IMAGE MAKER ADVT. PVT. LTD.', '', '45, SANGAM PLACE, CIVIL LINES', '0', ' PRAYAGRAJ', 'UTTAR PRADESH', ' 211001', '', '', '', '', '', '', '', '09AACCA0278K1ZL'),
(42, '42', 'AIRADS LIMITED ', '', '433 FUNCTIONAL INDUSTRIAL ESTATE PATPARGANJ', '0', 'DELHI', '', '110092', '9871021616', '', '', '', '', '', '', '07AAACA5793R1ZZ'),
(43, '43', 'FALCON ADVERTISERS', '', '135/119 HEWETT ROAD', '0', ' PRAYAGRAJ', 'UTTAR PRADESH', ' 211003', '', '', '', '', '', '', '', '09AAAFW3963A1ZA'),
(44, '44', 'AIRADS LIMITED ', '', '433 FUNCTIONAL INDUSTRIAL ESTATE PATPARGANJ', '0', 'DELHI', '', '110092', '9871021616', '', '', '', '', '', '', '07AAACA5793R1ZZ'),
(45, '45', 'ANU IMAGE MAKER ADVT. PVT. LTD.', '', '45, SANGAM PLACE, CIVIL LINES', '0', ' PRAYAGRAJ', 'UTTAR PRADESH', ' 211001', '', '', '', '', '', '', '', '09AACCA0278K1ZL'),
(46, '46', 'ANU IMAGE MAKER ADVT. PVT. LTD.', '', '45, SANGAM PLACE, CIVIL LINES', '0', ' PRAYAGRAJ', 'UTTAR PRADESH', ' 211001', '', '', '', '', '', '', '', '09AACCA0278K1ZL'),
(47, '47', 'ANU IMAGE MAKER ADVT. PVT. LTD.', '', '45, SANGAM PLACE, CIVIL LINES', '0', ' PRAYAGRAJ', 'UTTAR PRADESH', ' 211001', '', '', '', '', '', '', '', '09AACCA0278K1ZL'),
(48, '48', 'M G ADVERTISING SERVICES', '', 'M-23 PHASE 1 BADLI INDUSTRIAL ESTATE', '0', 'DELHI', '', '110042', '8354850018', '', '', '', '', '', '', '09AEVPJ0791E1Z5'),
(49, '49', 'FALCON ADVERTISERS', '', '135/119 HEWETT ROAD', '0', ' PRAYAGRAJ', 'UTTAR PRADESH', ' 211003', '', '', '', '', '', '', '', '09AAAFW3963A1ZA'),
(50, '50', 'FALCON ADVERTISERS', '', '135/119 HEWETT ROAD', '0', ' PRAYAGRAJ', 'UTTAR PRADESH', ' 211003', '', '', '', '', '', '', '', '09AAAFW3963A1ZA'),
(51, '51', 'CRITIQUE COMMUNICATIONS PVT LTD', '', '602 6TH FLOOR AKASHDEEP BUILDING BARAKHAMBA ROAD ', '0', 'NEW DELHI', '', '11001', '9792822200', '', '', '', '', '', '', '07AABCC3732H1ZY'),
(52, '52', 'DOT COMMUNICATIONS', '', '304 SHALIMAR SQUARE', '0', ' LALBAGH', ' LUCKNOW U.P.', '226001', '', '', '', '', '', '', '', '09AAICD2362D1ZU'),
(53, '53', 'DOT COMMUNICATIONS', '', '304 SHALIMAR SQUARE', '0', ' LALBAGH', ' LUCKNOW U.P.', '226001', '', '', '', '', '', '', '', '09AAICD2362D1ZU'),
(54, '54', 'DOT COMMUNICATIONS', '', '304 SHALIMAR SQUARE', '0', ' LALBAGH', ' LUCKNOW U.P.', '226001', '', '', '', '', '', '', '', '09AAICD2362D1ZU'),
(55, '55', 'AIRADS LIMITED ', '', '433 FUNCTIONAL INDUSTRIAL ESTATE PATPARGANJ', '0', 'DELHI', '', '110092', '9871021616', '', '', '', '', '', '', '07AAACA5793R1ZZ'),
(56, '56', 'R.D. ADVERTISING PVT. LTD.              ', '', '257 CHAK, ZERO ROAD', '0', ' PRAYAGRAJ', 'UTTAR PRADESH', ' 211003', '', '', '', '', '', '', '', ' 09AACCR4712P1ZZ'),
(57, '57', 'CRITIQUE COMMUNICATIONS PVT LTD', '', '602 6TH FLOOR AKASHDEEP BUILDING BARAKHAMBA ROAD ', '0', 'NEW DELHI', '', '11001', '9792822200', '', '', '', '', '', '', '07AABCC3732H1ZY'),
(58, '58', 'ADMAN ADVERTISING', '', '201-202 MOHAN COMPLEX ASHOK VIHAR PHASE-I', '0', 'DELHI', '', '110052', '8354850018', '', '', '', '', '', '', '07AAAFA7942D1ZR'),
(59, '59', 'FALCON ADVERTISERS', '', '135/119 HEWETT ROAD', '0', ' PRAYAGRAJ', 'UTTAR PRADESH', ' 211003', '', '', '', '', '', '', '', '09AAAFW3963A1ZA'),
(60, '60', 'M G ADVERTISING SERVICES', '', 'M-23 PHASE 1 BADLI INDUSTRIAL ESTATE', '0', 'DELHI', '', '110042', '8354850018', '', '', '', '', '', '', '09AEVPJ0791E1Z5'),
(61, '61', 'DOT COMMUNICATIONS', '', '304 SHALIMAR SQUARE', '0', ' LALBAGH', ' LUCKNOW U.P.', '226001', '', '', '', '', '', '', '', '09AAICD2362D1ZU'),
(62, '62', 'ADMAN ADVERTISING', '', '201-202 MOHAN COMPLEX ASHOK VIHAR PHASE-I', '0', 'DELHI', '', '110052', '8354850018', '', '', '', '', '', '', '07AAAFA7942D1ZR'),
(63, '63', 'DEGREE 360 SOLUTIONS PVT LTD.', '', 'THIRD FLOOR HS-38 OMICRON 1GAUTAM BUDDHA NAGAR GREATER NOIDA ', '0', 'UTTAR PRADESH', '', '201310', '', '', '', '', '', '', '', '09AACCD3150H1ZW'),
(64, '64', 'CRITIQUE COMMUNICATIONS PVT LTD', '', '602 6TH FLOOR AKASHDEEP BUILDING BARAKHAMBA ROAD ', '0', 'NEW DELHI', '', '11001', '9792822200', '', '', '', '', '', '', '07AABCC3732H1ZY'),
(65, '65', 'AIRADS LIMITED ', '', '433 FUNCTIONAL INDUSTRIAL ESTATE PATPARGANJ', '0', 'DELHI', '', '110092', '9871021616', '', '', '', '', '', '', '07AAACA5793R1ZZ'),
(66, '66', 'APEX ADVERTISING', '', 'C197 EVERGREEN APARTMENT SHAHEEN BAGH', 'JAMIA NAGAR OKHLA', 'NEW DELHI', '', '110025', '', '', '', '', '', '', '', '07AADFA4855E1ZO');

-- --------------------------------------------------------

--
-- Table structure for table `invoices`
--

CREATE TABLE `invoices` (
  `id` int(11) NOT NULL,
  `invoice` varchar(255) NOT NULL,
  `custom_email` text NOT NULL,
  `invoice_date` date NOT NULL,
  `invoice_due_date` varchar(255) NOT NULL,
  `subtotal` decimal(10,0) NOT NULL,
  `shipping` decimal(10,0) NOT NULL,
  `discount` decimal(10,0) NOT NULL,
  `vat` varchar(11) NOT NULL,
  `gross` varchar(255) NOT NULL,
  `less` varchar(255) NOT NULL,
  `net` varchar(255) NOT NULL,
  `notes` text NOT NULL,
  `invoice_type` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `amount_inword` varchar(255) NOT NULL,
  `tax_type` varchar(11) NOT NULL,
  `GSTN` varchar(256) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `invoices`
--

INSERT INTO `invoices` (`id`, `invoice`, `custom_email`, `invoice_date`, `invoice_due_date`, `subtotal`, `shipping`, `discount`, `vat`, `gross`, `less`, `net`, `notes`, `invoice_type`, `status`, `amount_inword`, `tax_type`, `GSTN`) VALUES
(1, '1', '', '2025-04-10', '', 0, 0, 0, '601.8', '12036.00', '2124.00', '12637.80', '', '', '', 'Twelve Thousand Six Hundred and Thirty Seven  Rupees and Eighty Paise only', 'GST', '09AEVPJ0791E1Z5'),
(2, '2', '', '2025-04-10', '', 0, 0, 0, '97.46', '1949.02', '343.94', '2046.48', '', '', '', 'Two Thousand and Forty Six  Rupees and Forty Eight  Paise only', 'GST', '09AAAFW3963A1ZA'),
(3, '3', '', '2025-04-10', '', 0, 0, 0, '74.52', '1490.42', '263.02', '1564.94', '', '', '', 'One Thousand Five Hundred and Sixty Four  Rupees and Ninety Four  Paise only', 'GST', '09AACCA0278K1ZL'),
(4, '4', '', '2025-04-10', '', 0, 0, 0, '114.64', '2292.96', '404.64', '2407.60', '', '', '', 'Two Thousand Four Hundred and Seven  Rupees and Sixty Paise only', 'GST', '09AACCD3150H1ZW'),
(5, '5', '', '2025-04-10', '', 0, 0, 0, '34.4', '687.89', '121.39', '722.29', '', '', '', 'Seven Hundred and Twenty Two  Rupees and Twenty Nine  Paise only', 'GST', '09AACCD3150H1ZW'),
(6, '6', '', '2025-04-10', '', 0, 0, 0, '80.26', '1605.07', '283.25', '1685.33', '', '', '', 'One Thousand Six Hundred and Eighty Five  Rupees and Thirty Three  Paise only', 'GST', '09AAAFW3963A1ZA'),
(7, '7', '', '2025-04-10', '', 0, 0, 0, '65.2', '1304.12', '230.14', '1369.32', '', '', '', 'One Thousand Three Hundred and Sixty Nine  Rupees and Thirty Two  Paise only', 'GST', '09AAICD2362D1ZU'),
(8, '8', '', '2025-04-10', '', 0, 0, 0, '85.98', '1719.72', '303.48', '1805.70', '', '', '', 'One Thousand Eight Hundred and Five  Rupees and Seventy Paise only', 'GST', '09AAICD2362D1ZU'),
(9, '9', '', '2025-04-10', '', 0, 0, 0, '91.72', '1834.37', '323.71', '1926.09', '', '', '', 'One Thousand Nine Hundred and Twenty Six  Rupees and  Nine  Paise only', 'IGST', '07AAAFA7942D1ZR'),
(10, '10', '', '2025-04-10', '', 0, 0, 0, '74.52', '1490.42', '263.02', '1564.94', '', '', '', 'One Thousand Five Hundred and Sixty Four  Rupees and Ninety Four  Paise only', 'GST', '09AAAFW3963A1ZA'),
(11, '11', '', '2025-04-10', '', 0, 0, 0, '74.52', '1490.42', '263.02', '1564.94', '', '', '', 'One Thousand Five Hundred and Sixty Four  Rupees and Ninety Four  Paise only', 'GST', '09AAAFW3963A1ZA'),
(12, '12', '', '2025-04-10', '', 0, 0, 0, '103.18', '2063.66', '364.18', '2166.84', '', '', '', 'Two Thousand One Hundred and Sixty Six  Rupees and Eighty Four  Paise only', 'IGST', '07AABCC3732H1ZY'),
(13, '13', '', '2025-04-10', '', 0, 0, 0, '57.32', '1146.48', '202.32', '1203.80', '', '', '', 'One Thousand Two Hundred and Three  Rupees and Eighty Paise only', 'GST', '09AACCD3150H1ZW'),
(14, '14', '', '2025-04-10', '', 0, 0, 0, '45.86', '917.18', '161.86', '963.04', '', '', '', 'Nine Hundred and Sixty Three  Rupees and  Four  Paise only', 'GST', '09AACCA0278K1ZL'),
(15, '15', '', '2025-04-20', '', 0, 0, 0, '97.46', '1949.02', '343.94', '2046.48', '', '', '', 'Two Thousand and Forty Six  Rupees and Forty Eight  Paise only', 'GST', '09AACCA0278K1ZL'),
(16, '16', '', '2025-04-20', '', 0, 0, 0, '126.11', '2522.26', '445.10', '2648.37', '', '', '', 'Two Thousand Six Hundred and Forty Eight  Rupees and Thirty Seven  Paise only', 'IGST', '07AAAFA7942D1ZR'),
(17, '17', '', '2025-04-20', '', 0, 0, 0, '80.26', '1605.07', '283.25', '1685.33', '', '', '', 'One Thousand Six Hundred and Eighty Five  Rupees and Thirty Three  Paise only', 'GST', '09AAAFW3963A1ZA'),
(19, '18', '', '2025-04-20', '', 0, 0, 0, '45.86', '917.18', '161.86', '963.04', '', '', '', 'Nine Hundred and Sixty Three  Rupees and  Four  Paise only', 'IGST', '07AAACA5793R1ZZ'),
(20, '20', '', '2025-04-20', '', 0, 0, 0, '85.99', '1719.72', '303.48', '1805.71', '', '', '', 'One Thousand Eight Hundred and Five  Rupees and Seventy One  Paise only', 'IGST', '07AABCC3732H1ZY'),
(21, '21', '', '2025-04-20', '', 0, 0, 0, '45.86', '917.18', '161.86', '963.04', '', '', '', 'Nine Hundred and Sixty Three  Rupees and  Four  Paise only', 'IGST', '07AAAFA7942D1ZR'),
(22, '22', '', '2025-04-20', '', 0, 0, 0, '45.86', '917.18', '161.86', '963.04', '', '', '', 'Nine Hundred and Sixty Three  Rupees and  Four  Paise only', 'GST', '09AEVPJ0791E1Z5'),
(23, '23', '', '2025-04-20', '', 0, 0, 0, '74.52', '1490.42', '263.02', '1564.94', '', '', '', 'One Thousand Five Hundred and Sixty Four  Rupees and Ninety Four  Paise only', 'IGST', '07AAACA5793R1ZZ'),
(24, '24', '', '2025-04-20', '', 0, 0, 0, '114.64', '2292.96', '404.64', '2407.60', '', '', '', 'Two Thousand Four Hundred and Seven  Rupees and Sixty Paise only', 'GST', '09AACCA0278K1ZL'),
(25, '25', '', '2025-04-30', '', 0, 0, 0, '22.93', '458.59', '80.93', '481.52', '', '', '', 'Four Hundred and Eighty One  Rupees and Fifty Two  Paise only', 'IGST', '07AAAFA7942D1ZR'),
(26, '26', '', '2025-04-30', '', 0, 0, 0, '34.39', '687.89', '121.39', '722.28', '', '', '', 'Seven Hundred and Twenty Two  Rupees and Twenty Eight  Paise only', 'IGST', '07AAACA5793R1ZZ'),
(27, '27', '', '2025-04-30', '', 0, 0, 0, '85.99', '1719.72', '303.48', '1805.71', '', '', '', 'One Thousand Eight Hundred and Five  Rupees and Seventy One  Paise only', 'IGST', '07AAACA5793R1ZZ'),
(28, '28', '', '2025-04-30', '', 0, 0, 0, '160.5', '3210.14', '566.50', '3370.64', '', '', '', 'Three Thousand Three Hundred and Seventy  Rupees and Sixty Four  Paise only', 'GST', '09AACCA0278K1ZL'),
(29, '29', '', '2025-04-30', '', 0, 0, 0, '63.06', '1261.13', '222.55', '1324.19', '', '', '', 'One Thousand Three Hundred and Twenty Four  Rupees and one Nine  Paise only', 'GST', '09AACCD3150H1ZW'),
(30, '30', '', '2025-04-30', '', 0, 0, 0, '85.98', '1719.72', '303.48', '1805.70', '', '', '', 'One Thousand Eight Hundred and Five  Rupees and Seventy Paise only', 'GST', '09AAAFW3963A1ZA'),
(31, '31', '', '2025-05-10', '', 0, 0, 0, '28.66', '573.24', '101.16', '601.90', '', '', '', 'Six Hundred and One  Rupees and Ninety Paise only', 'IGST', '07AAACA5793R1ZZ'),
(32, '32', '', '2025-05-10', '', 0, 0, 0, '63.06', '1261.13', '222.55', '1324.19', '', '', '', 'One Thousand Three Hundred and Twenty Four  Rupees and one Nine  Paise only', 'GST', '09AAAFW3963A1ZA'),
(33, '33', '', '2025-05-10', '', 0, 0, 0, '57.32', '1146.48', '202.32', '1203.80', '', '', '', 'One Thousand Two Hundred and Three  Rupees and Eighty Paise only', 'GST', '09AAICD2362D1ZU'),
(34, '34', '', '2025-05-10', '', 0, 0, 0, '28.66', '573.24', '101.16', '601.90', '', '', '', 'Six Hundred and One  Rupees and Ninety Paise only', 'GST', '09AAICD2362D1ZU'),
(35, '35', '', '2025-05-10', '', 0, 0, 0, '40.13', '802.54', '141.62', '842.67', '', '', '', 'Eight Hundred and Forty Two  Rupees and Sixty Seven  Paise only', 'IGST', '07AAAFA7942D1ZR'),
(36, '36', '', '2025-05-10', '', 0, 0, 0, '63.06', '1261.13', '222.55', '1324.19', '', '', '', 'One Thousand Three Hundred and Twenty Four  Rupees and one Nine  Paise only', 'GST', '09AACCA0278K1ZL'),
(37, '37', '', '2025-05-10', '', 0, 0, 0, '57.32', '1146.48', '202.32', '1203.80', '', '', '', 'One Thousand Two Hundred and Three  Rupees and Eighty Paise only', 'GST', '09AEVPJ0791E1Z5'),
(38, '38', '', '2025-05-10', '', 0, 0, 0, '48.14', '962.88', '169.92', '1011.02', '', '', '', 'One Thousand and Eleven  Rupees and  Two  Paise only', 'GST', '09AACCA0278K1ZL'),
(39, '39', '', '2025-05-10', '', 0, 0, 0, '51.59', '1031.83', '182.09', '1083.42', '', '', '', 'One Thousand and Eighty Three  Rupees and Forty Two  Paise only', 'IGST', '07AABCC3732H1ZY'),
(40, '40', '', '2025-05-20', '', 0, 0, 0, '45.86', '917.18', '161.86', '963.04', '', '', '', 'Nine Hundred and Sixty Three  Rupees and  Four  Paise only', 'IGST', '07AAAFA7942D1ZR'),
(41, '41', '', '2025-05-20', '', 0, 0, 0, '45.86', '917.18', '161.86', '963.04', '', '', '', 'Nine Hundred and Sixty Three  Rupees and  Four  Paise only', 'GST', '09AACCA0278K1ZL'),
(42, '42', '', '2025-05-20', '', 0, 0, 0, '40.13', '802.54', '141.62', '842.67', '', '', '', 'Eight Hundred and Forty Two  Rupees and Sixty Seven  Paise only', 'IGST', '07AAACA5793R1ZZ'),
(43, '43', '', '2025-05-20', '', 0, 0, 0, '40.12', '802.54', '141.62', '842.66', '', '', '', 'Eight Hundred and Forty Two  Rupees and Sixty Six  Paise only', 'GST', '09AAAFW3963A1ZA'),
(44, '44', '', '2025-05-20', '', 0, 0, 0, '34.39', '687.89', '121.39', '722.28', '', '', '', 'Seven Hundred and Twenty Two  Rupees and Twenty Eight  Paise only', 'IGST', '07AAACA5793R1ZZ'),
(45, '45', '', '2025-05-20', '', 0, 0, 0, '51.6', '1031.83', '182.09', '1083.43', '', '', '', 'One Thousand and Eighty Three  Rupees and Forty Three  Paise only', 'GST', '09AACCA0278K1ZL'),
(46, '46', '', '2025-05-20', '', 0, 0, 0, '20.06', '401.27', '70.81', '421.33', '', '', '', 'Four Hundred and Twenty One  Rupees and Thirty Three  Paise only', 'GST', '09AACCA0278K1ZL'),
(47, '47', '', '2025-05-20', '', 0, 0, 0, '34.4', '687.89', '121.39', '722.29', '', '', '', 'Seven Hundred and Twenty Two  Rupees and Twenty Nine  Paise only', 'GST', '09AACCA0278K1ZL'),
(48, '48', '', '2025-05-20', '', 0, 0, 0, '68.78', '1375.78', '242.78', '1444.56', '', '', '', 'One Thousand Four Hundred and Forty Four  Rupees and Fifty Six  Paise only', 'GST', '09AEVPJ0791E1Z5'),
(49, '49', '', '2025-05-20', '', 0, 0, 0, '40.12', '802.40', '141.60', '842.52', '', '', '', 'Eight Hundred and Forty Two  Rupees and Fifty Two  Paise only', 'GST', '09AAAFW3963A1ZA'),
(50, '50', '', '2025-05-31', '', 0, 0, 0, '45.86', '917.18', '161.86', '963.04', '', '', '', 'Nine Hundred and Sixty Three  Rupees and  Four  Paise only', 'GST', '09AAAFW3963A1ZA'),
(51, '51', '', '2025-05-31', '', 0, 0, 0, '126.12', '2522.26', '445.10', '2648.38', '', '', '', 'Two Thousand Six Hundred and Forty Eight  Rupees and Thirty Eight  Paise only', 'GST', '07AABCC3732H1ZY'),
(52, '52', '', '2025-05-31', '', 0, 0, 0, '57.32', '1146.48', '202.32', '1203.80', '', '', '', 'One Thousand Two Hundred and Three  Rupees and Eighty Paise only', 'GST', '09AAICD2362D1ZU'),
(53, '53', '', '2025-05-31', '', 0, 0, 0, '51.6', '1031.83', '182.09', '1083.43', '', '', '', 'One Thousand and Eighty Three  Rupees and Forty Three  Paise only', 'GST', '09AAICD2362D1ZU'),
(54, '54', '', '2025-05-31', '', 0, 0, 0, '40.12', '802.54', '141.62', '842.66', '', '', '', 'Eight Hundred and Forty Two  Rupees and Sixty Six  Paise only', 'GST', '09AAICD2362D1ZU'),
(55, '55', '', '2025-05-31', '', 0, 0, 0, '91.72', '1834.37', '323.71', '1926.09', '', '', '', 'One Thousand Nine Hundred and Twenty Six  Rupees and  Nine  Paise only', 'IGST', '07AAACA5793R1ZZ'),
(56, '56', '', '2025-05-31', '', 0, 0, 0, '82.4', '1648.07', '290.83', '1730.47', '', '', '', 'One Thousand Seven Hundred and Thirty  Rupees and Forty Seven  Paise only', 'GST', ' 09AACCR4712P1ZZ'),
(57, '57', '', '2025-05-31', '', 0, 0, 0, '143.31', '2866.20', '505.80', '3009.51', '', '', '', 'Three Thousand and Nine  Rupees and Fifty Paise only', 'IGST', '07AABCC3732H1ZY'),
(58, '58', '', '2025-05-31', '', 0, 0, 0, '131.84', '2636.90', '465.34', '2768.74', '', '', '', 'Two Thousand Seven Hundred and Sixty Eight  Rupees and Seventy Four  Paise only', 'IGST', '07AAAFA7942D1ZR'),
(59, '59', '', '2025-05-31', '', 0, 0, 0, '57.32', '1146.48', '202.32', '1203.80', '', '', '', 'One Thousand Two Hundred and Three  Rupees and Eighty Paise only', 'GST', '09AAAFW3963A1ZA'),
(60, '60', '', '2025-05-31', '', 0, 0, 0, '114.64', '2292.96', '404.64', '2407.60', '', '', '', 'Two Thousand Four Hundred and Seven  Rupees and Sixty Paise only', 'GST', '09AEVPJ0791E1Z5'),
(61, '61', '', '2025-05-31', '', 0, 0, 0, '57.32', '1146.48', '202.32', '1203.80', '', '', '', 'One Thousand Two Hundred and Three  Rupees and Eighty Paise only', 'GST', '09AAICD2362D1ZU'),
(62, '62', '', '2025-05-31', '', 0, 0, 0, '80.25', '1605.07', '283.25', '1685.32', '', '', '', 'One Thousand Six Hundred and Eighty Five  Rupees and Thirty Two  Paise only', 'IGST', '07AAAFA7942D1ZR'),
(63, '63', '', '2025-05-31', '', 0, 0, 0, '143.32', '2866.20', '505.80', '3009.52', '', '', '', 'Three Thousand and Nine  Rupees and Fifty Two  Paise only', 'GST', '09AACCD3150H1ZW'),
(64, '64', '', '2025-05-31', '', 0, 0, 0, '85.99', '1719.72', '303.48', '1805.71', '', '', '', 'One Thousand Eight Hundred and Five  Rupees and Seventy One  Paise only', 'IGST', '07AABCC3732H1ZY'),
(65, '65', '', '2025-05-31', '', 0, 0, 0, '57.32', '1146.48', '202.32', '1203.80', '', '', '', 'One Thousand Two Hundred and Three  Rupees and Eighty Paise only', 'IGST', '07AAACA5793R1ZZ'),
(66, '66', '', '2025-05-31', '', 0, 0, 0, '601.80', '12036.00', '2124.00', '12637.80', '', '', '', 'Twelve Thousand Six Hundred and Thirty Seven  Rupees and Eighty Paise only', 'IGST', '07AADFA4855E1ZO');

-- --------------------------------------------------------

--
-- Table structure for table `invoices_old`
--

CREATE TABLE `invoices_old` (
  `id` int(11) NOT NULL,
  `invoice` varchar(255) NOT NULL,
  `custom_email` text NOT NULL,
  `invoice_date` varchar(255) NOT NULL,
  `invoice_due_date` varchar(255) NOT NULL,
  `subtotal` decimal(10,0) NOT NULL,
  `shipping` decimal(10,0) NOT NULL,
  `discount` decimal(10,0) NOT NULL,
  `vat` varchar(11) NOT NULL,
  `gross` varchar(255) NOT NULL,
  `less` varchar(255) NOT NULL,
  `net` varchar(255) NOT NULL,
  `notes` text NOT NULL,
  `invoice_type` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `amount_inword` varchar(255) NOT NULL,
  `tax_type` varchar(11) NOT NULL,
  `GSTN` varchar(256) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `invoice_items`
--

CREATE TABLE `invoice_items` (
  `id` int(11) NOT NULL,
  `invoice` varchar(255) NOT NULL,
  `product` text NOT NULL,
  `order_no` int(11) NOT NULL,
  `publishing_date` varchar(255) NOT NULL,
  `alloted_space` varchar(11) NOT NULL,
  `rate_type` varchar(256) NOT NULL,
  `release_order_date` varchar(255) NOT NULL,
  `ad_price` varchar(255) NOT NULL,
  `rate_value` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `invoice_items`
--

INSERT INTO `invoice_items` (`id`, `invoice`, `product`, `order_no`, `publishing_date`, `alloted_space`, `rate_type`, `release_order_date`, `ad_price`, `rate_value`) VALUES
(1, '2', 'N.C.R', 221005, '03/04/2025', '136', 'without_color', '02/04/2025', '2292.96', '16.86'),
(2, '3', 'N.C.R', 24449, '03/04/2025', '104', 'without_color', '02/04/2025', '1753.44', '16.86'),
(3, '4', 'N.C.R', 13875, '03/04/2025', '160', 'without_color', '02/04/2025', '2697.60', '16.86'),
(4, '5', 'N.C.R', 62, '04/04/2025', '48', 'without_color', '03/04/2025', '809.28', '16.86'),
(5, '6', 'N.C.R', 221140, '04/04/2025', '112', 'without_color', '03/04/2025', '1888.32', '16.86'),
(6, '7', 'N.C.R', 13595, '04/04/2025', '91', 'without_color', '03/04/2025', '1534.26', '16.86'),
(7, '8', 'N.C.R', 25105, '04/04/2025', '120', 'without_color', '03/04/2025', '2023.20', '16.86'),
(8, '9', 'N.C.R', 630, '05/04/2025', '128', 'without_color', '04/04/2025', '2158.08', '16.86'),
(9, '10', 'N.C.R', 221314, '05/04/2025', '104', 'without_color', '04/04/2025', '1753.44', '16.86'),
(10, '11', 'N.C.R', 221398, '09/04/2025', '104', 'without_color', '08/04/2025', '1753.44', '16.86'),
(11, '12', 'N.C.R', 9969, '09/04/2025', '144', 'without_color', '08/04/2025', '2427.84', '16.86'),
(12, '13', 'N.C.R', 252, '09/04/2025', '80', 'without_color', '08/04/2025', '1348.80', '16.86'),
(13, '14', 'N.C.R', 24865, '09/04/2025', '64', 'without_color', '08/04/2025', '1079.04', '16.86'),
(14, '15', 'N.C.R', 24958, '11/04/2025', '136', 'without_color', '10/04/2025', '2292.96', '16.86'),
(15, '16', 'N.C.R', 1514, '11/04/2025', '176', 'without_color', '10/04/2025', '2967.36', '16.86'),
(16, '17', 'N.C.R', 221675, '13/04/2025', '112', 'without_color', '12/04/2025', '1888.32', '16.86'),
(18, '18', 'N.C.R', 376576, '13/04/2025', '64', 'without_color', '12/04/2025', '1079.04', '16.86'),
(19, '20', 'N.C.R', 10148, '16/04/2025', '120', 'without_color', '15/04/2025', '2023.20', '16.86'),
(20, '21', 'N.C.R', 2212, '17/04/2025', '64', 'without_color', '16/04/2025', '1079.04', '16.86'),
(21, '23', 'N.C.R', 376789, '19/04/2025', '104', 'without_color', '18/04/2025', '1753.44', '16.86'),
(22, '24', 'N.C.R', 25302, '19/04/2025', '160', 'without_color', '18/04/2025', '2697.60', '16.86'),
(23, '25', 'N.C.R', 6037, '25/04/2025', '32', 'without_color', '24/04/2025', '539.52', '16.86'),
(24, '26', 'N.C.R', 377009, '25/04/2025', '48', 'without_color', '24/04/2025', '809.28', '16.86'),
(25, '27', 'N.C.R', 377035, '25/04/2025', '120', 'without_color', '24/04/2025', '2023.20', '16.86'),
(26, '28', 'N.C.R', 25554, '26/04/2025', '224', 'without_color', '25/04/2025', '3776.64', '16.86'),
(27, '29', 'N.C.R', 3657, '25/04/2025', '88', 'without_color', '24/04/2025', '1483.68', '16.86'),
(28, '30', 'N.E.R', 222288, '27/04/2025', '120', 'without_color', '26/04/2025', '2023.20', '16.86'),
(29, '31', 'N.C.R', 377354, '02/05/2025', '40', 'without_color', '01/05/2025', '674.40', '16.86'),
(30, '32', 'N.C.R', 222767, '06/05/2025', '88', 'without_color', '05/05/2025', '1483.68', '16.86'),
(31, '33', 'N.C.R', 26129, '07/05/2025', '80', 'without_color', '06/05/2025', '1348.80', '16.86'),
(32, '34', 'N.C.R', 26060, '07/05/2025', '40', 'without_color', '06/05/2025', '674.40', '16.86'),
(33, '35', 'N.C.R', 4603, '07/05/2025', '56', 'without_color', '06/05/2025', '944.16', '16.86'),
(34, '36', 'N.C.R', 26104, '07/05/2025', '88', 'without_color', '06/05/2025', '1483.68', '16.86'),
(35, '38', 'N.C.R', 26195, '09/05/2025', '48', 'with_color', '08/05/2025', '1132.80', '23.604'),
(36, '39', 'N.C.R', 11024, '10/05/2025', '72', 'without_color', '09/05/2025', '1213.92', '16.86'),
(37, '40', 'N.C.R', 5922, '11/05/2025', '64', 'without_color', '10/05/2025', '1079.04', '16.86'),
(38, '41', 'N.C.R', 26422, '13/05/2025', '64', 'without_color', '10/05/2025', '1079.04', '16.86'),
(39, '42', 'N.C.R', 378022, '15/05/2025', '56', 'without_color', '14/05/2025', '944.16', '16.86'),
(40, '43', 'N.C.R', 223274, '16/05/2025', '56', 'without_color', '15/05/2025', '944.16', '16.86'),
(41, '44', 'N.C.R', 378183, '16/05/2025', '48', 'without_color', '15/05/2025', '809.28', '16.86'),
(42, '45', 'N.C.R', 26492, '16/05/2025', '72', 'without_color', '15/05/2025', '1213.92', '16.86'),
(43, '46', 'N.C.R', 26574, '17/05/2025', '28', 'without_color', '16/05/2025', '472.08', '16.86'),
(44, '47', 'N.C.R', 26634, '18/05/2025', '48', 'without_color', '15/05/2025', '809.28', '16.86'),
(45, '49', 'N.C.R', 223486, '20/05/2025', '40', 'with_color', '19/05/2025', '944.00', '23.604'),
(46, '50', 'N.C.R', 223535, '21/05/2025', '64', 'without_color', '20/05/2025', '1079.04', '16.86'),
(47, '51', 'N.C.R', 11488, '21/05/2025', '176', 'without_color', '20/05/2025', '2967.36', '16.86'),
(48, '52', 'N.E.R', 14324, '22/05/2025', '80', 'without_color', '21/05/2025', '1348.80', '16.86'),
(49, '53', 'N.C.R', 26674, '22/05/2025', '72', 'without_color', '21/05/2025', '1213.92', '16.86'),
(50, '54', 'N.C.R', 26622, '22/05/2025', '56', 'without_color', '21/05/2025', '944.16', '16.86'),
(51, '55', 'N.C.R', 378606, '22/05/2025', '128', 'without_color', '21/05/2025', '2158.08', '16.86'),
(52, '57', 'N.C.R', 11610, '23/05/2025', '200', 'without_color', '22/05/2025', '3372.00', '16.86'),
(53, '58', 'N.C.R', 9977, '23/05/2025', '184', 'without_color', '22/05/2025', '3102.24', '16.86'),
(54, '59', 'N.C.R', 223996, '24/05/2025', '80', 'without_color', '23/05/2025', '1348.80', '16.86'),
(55, '60', 'N.C.R', 2029, '28/05/2025', '160', 'without_color', '27/05/2025', '2697.60', '16.86'),
(56, '61', 'N.C.R', 26941, '29/05/2025', '80', 'without_color', '28/05/2025', '1348.80', '16.86'),
(57, '62', 'N.C.R', 10721, '30/05/2025', '112', 'without_color', '29/05/2025', '1888.32', '16.86'),
(58, '63', 'N.C.R', 4861, '30/05/2025', '200', 'without_color', '29/05/2025', '3372.00', '16.86'),
(59, '65', 'N.C.R', 379216, '31/05/2025', '80', 'without_color', '30/05/2025', '1348.80', '16.86');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `product_id` int(11) NOT NULL,
  `product_name` text NOT NULL,
  `product_desc` text NOT NULL,
  `product_price` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `product_name`, `product_desc`, `product_price`) VALUES
(998, 'with_color', 'color', '23.604'),
(995, 'without_color', 'Without color', '16.86');

-- --------------------------------------------------------

--
-- Table structure for table `store_customers`
--

CREATE TABLE `store_customers` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `address_1` varchar(255) NOT NULL,
  `address_2` varchar(255) NOT NULL,
  `town` varchar(255) NOT NULL,
  `county` varchar(255) NOT NULL,
  `postcode` varchar(255) NOT NULL,
  `phone` varchar(100) NOT NULL,
  `name_ship` varchar(255) NOT NULL,
  `address_1_ship` varchar(255) NOT NULL,
  `address_2_ship` varchar(255) NOT NULL,
  `town_ship` varchar(255) NOT NULL,
  `county_ship` varchar(255) NOT NULL,
  `postcode_ship` varchar(255) NOT NULL,
  `gstin_no` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `store_customers`
--

INSERT INTO `store_customers` (`id`, `name`, `email`, `address_1`, `address_2`, `town`, `county`, `postcode`, `phone`, `name_ship`, `address_1_ship`, `address_2_ship`, `town_ship`, `county_ship`, `postcode_ship`, `gstin_no`) VALUES
(1, 'INTERADS ADVT. PVT. LTD.', '', 'ASAF ALI ROAD', '', ' NEW DELHI', 'INDIA', ' 110002', '', '', '', '', '', '', '', '07AAACI2834D1Z0'),
(2, 'ANU IMAGE MAKER ADVT. PVT. LTD.', '', '45, SANGAM PLACE, CIVIL LINES', '', ' PRAYAGRAJ', 'UTTAR PRADESH', ' 211001', '', '', '', '', '', '', '', '09AACCA0278K1ZL'),
(3, 'KAKA  ADVERTISING AGENCY', '', 'KAMLA NEHRU ROAD', '', ' PRAYAGRAJ', 'UTTAR PRADESH', ' 211001', '', '', '', '', '', '', '', ' 09AEFPG8298D2Z7'),
(4, 'FALCON ADVERTISERS', '', '135/119 HEWETT ROAD', '', ' PRAYAGRAJ', 'UTTAR PRADESH', ' 211003', '', '', '', '', '', '', '', '09AAAFW3963A1ZA'),
(5, 'R.D. ADVERTISING PVT. LTD.              ', '', '257 CHAK, ZERO ROAD', '', ' PRAYAGRAJ', 'UTTAR PRADESH', ' 211003', '', '', '', '', '', '', '', ' 09AACCR4712P1ZZ'),
(6, 'SATYA  ADVERTISING AGENCY           ', '', '138J/30, M.G. MARG, CIVIL LINES', '', ' PRAYAGRAJ', 'UTTAR PRADESH', ' 211001', '', '', '', '', '', '', '', ' 09AARPR8069F1ZW'),
(7, 'SIDDHARTHA ADVERTISING', '', 'FRASER ROAD', '', 'PATNA', 'BIHAR', '800001', '', '', '', '', '', '', '', '10AGRPK0795P1ZU'),
(8, 'PRACHI MEDIA CONSULTANTS', '', '10-GULZAR COLONY, NEW BERRY ROAD', '', ' ', 'HAZRATGANJ, LUCKNOW', '', '', '', '', '', '', '', '', '09AEYPK3458A1Z7'),
(9, 'PAWANSUT AD-CREATIONS PVT. LTD.', '', 'S-12 GOLE MARKET MAHANAGAR', '', '', ' LUCKNOW U.P.', '226006', '', '', '', '', '', '', '', '09AACCP9374M1ZN'),
(10, 'DOT COMMUNICATIONS', '', '304 SHALIMAR SQUARE', '', ' LALBAGH', ' LUCKNOW U.P.', '226001', '', '', '', '', '', '', '', '09AAICD2362D1ZU'),
(11, 'SPAN COMMUNICATIONS', '', '1002 HERITAGE APARTMENT 5-PARK ROAD HAZARATGANJ', '', 'LUCKNOW', '', '226001', '05224028424', '', '', '', '', '', '', '09ADQFS1379H1ZG'),
(12, 'ANJ CREATIONS', '', 'A-1/294 SAFDARJUNG ENCLAVE', '', 'NEW DELHI', '', '110029', '', '', '', '', '', '', '', '07AALCA1398R1ZV'),
(13, 'VERMILLION COMMUNICATION PVT. LTD.', '', 'HIMANSHU SADAN 2ND FLOOR PARK ROAD', '', 'LUCKNOW U.P.', '', '226001', '', '', '', '', '', '', '', '09AACCV0488N1ZQ'),
(14, 'AIRADS LIMITED ', '', '433 FUNCTIONAL INDUSTRIAL ESTATE PATPARGANJ', '', 'DELHI', '', '110092', '9871021616', '', '', '', '', '', '', '07AAACA5793R1ZZ'),
(15, 'PAMM ADVERTISING & MARKETING', '', '302-304 SETHI BHAWAN 7-RAJENDRA PLACE', '', 'NEW DELHI', '', '110008', '', '', '', '', '', '', '', '09AAAFP7680H1ZX'),
(16, 'CONCEPT COMMUNICATION LTD', '', '401 4th FLOOR SHALIMAR LOGIX (NEAR NATIONAL P.G. COLLEGE) 4 RANA PRATAP MARG ', '', 'HAZRATGANJ LUCKNOW U.P.', '', '226001', '9335970638', '', '', '', '', '', '', '09AAACC5102G1Z5'),
(17, 'ARTGRAPHICS ADVERTISING CONSULTANTS', '', '1 JOPLING ROAD', '', 'LUCKNOW U.P.', '', '226001', '', '', '', '', '', '', '', '09AAHPU6228M1ZZ'),
(18, 'ADKNACK ADVERTISING', '', '1st FLOOR 33 CANTT. ROAD NEAR ODEON CINEMA ', '', 'LUCKNOW U.P.', 'India', '226001', '9235624555', '', '', '', '', '', '', '09AAGFA4655H1ZD'),
(19, 'ENHANCE ADVERTISING PVT. LTD.', '', 'C 5/264 GROUND FLOOR VIPUL KHAND-5 GOMTI NAGAR', '', 'LUCKNOW U.P.', '', '226010', '0522-4016088', '', '', '', '', '', '', '09AACCE6732G1ZN'),
(20, 'SRADDHA ADVERTISING', '', 'KHASRA NO 1/1 MANAS TIRAHA INDIRA NAGAR', '', 'LUCKNOW', '', '226016', '7706940538', '', '', '', '', '', '', '09AESPG0786R1ZH'),
(21, 'CENTUM ADVERTISING & MARKETING PVT. LTD.', '', 'A-304 GOPALA APARTMENT 50 RAM TIRATH MARG NARHI', '', 'LUCKNOW', '', '226001', '9125877937, 9794985354', '', '', '', '', '', '', '09AAACC3938N1ZA'),
(22, 'SOPHIA ADVERTISING', 'sophiaglobalads@gmail.com', '2ND FLOOR CHABRA COMPLEX COURT ROAD ', '', 'SAHARANPUR', '', '247001', '9451750363', '', '', '', '', '', '', '09AFYPA9107M2ZR'),
(23, 'VAM ADVERTISING & MARKETING (P) LTD.', 'lucknow@onlyvam.com', '61-A MANAS NAGAR NEAR CANCER HOSPITAL JIYAMAU HAZARATGANJ', '', 'LUCKNOW U.P.', 'INDIA', '226001', '9919029997,9795200300', '', '', '', '', '', '', '09AACCV0313J1Z1'),
(24, 'PUNEET ADVERTISING & MEDIA', 'puneet.advertising@gmail.com', 'SECTOR-18 HOUSE NO:401 INDIRA NAGAR', '', 'LUCKNOW U.P.', 'INDIA', '226016', '9415020830', '', '', '', '', '', '', '09ACRPV0928R1ZF'),
(25, 'DIRECTORATE OF ADVERTISING AND VISUAL PUBLICITY, M/O I&B', '', 'SOOCHANA BHAWAN,PHASE 4, CGO COMPLEX, LODHI ROAD', '', 'NEW DELHI', '', '110003', '', '', '', '', '', '', '', '000000000000'),
(26, 'NATIONAL ADVERTISING AGENCY', '', 'SHAMBHU NIWAS, 25/26 GOKHALE VIHAR MARG,', '', 'LUCKNOW', '', '226001', '9415157842', '', '', '', '', '', '', '09AAFFN8566M1ZG'),
(27, 'DIRECTOR INFORMATION', '', 'UTTAR PRADESH INFORMATION DEPARTMENT', '', 'PARK ROAD, LUCKNOW', '', '226001', '', '', '', '', '', '', '', '..'),
(28, 'SPARKS ADVERTISING', '', 'RAMESH NIKETAN, VALMIKI MARG, LALBAGH', '', 'LUCKNOW', '', '', '', '', '', '', '', '', '', '09AAPFS3947R1ZO'),
(29, 'PRAYAS CREATIONS', '', 'EEL GROUND FLOOR, KANCHANPUR TOWER, MOHADDIPUR', '', 'GORAKHPUR', '', '273008', '9452090857', '', '', '', '', '', '', '09AARPV7973Q1Z2'),
(30, 'HINDUSTHAN SAMACHAR COOPERATIVE SOCIETY LTD.', '', '1, NAVEEN MARKET, KAISER BAGH', '', 'LUCKNOW', '', '226001', '0522-4064872', '', '', '', '', '', '', '09AACAH8146D1ZQ'),
(31, 'ADMAN ADVERTISING', '', '201-202 MOHAN COMPLEX ASHOK VIHAR PHASE-I', '', 'DELHI', '', '110052', '8354850018', '', '', '', '', '', '', '07AAAFA7942D1ZR'),
(32, 'DEGREE 360 SOLUTIONS PVT LTD.', '', 'THIRD FLOOR HS-38 OMICRON 1GAUTAM BUDDHA NAGAR GREATER NOIDA ', '', 'UTTAR PRADESH', '', '201310', '', '', '', '', '', '', '', '09AACCD3150H1ZW'),
(33, 'SRESHTA COMMUNICATIONS', '', '514, 5TH FLOOR NAURANG HOUSE K.G. MARG', '', 'NEW DELHI', '', '110001', '9717154775', '', '', '', '', '', '', '07AAHFS6121R1ZO'),
(34, 'EXECUTIVE (CC)-HR', '', 'MEJA URJA NIGAM PVT LTD', '', ' PRAYAGRAJ', '', '', '', '', '', '', '', '', '', '0'),
(35, 'SPAN COMMUNICATIONS', '', '212-A 2ND FLOOR HUBTOWN SOLARIS ANDHERI EAST', '', 'MUMBAI', '', '400069', '26822360', '', '', '', '', '', '', '27ADQFS1379H1ZI'),
(36, 'PROMODOME COMMUNICATIONS PVT. LTD.', '', '10 GULZAR COLONEY CLYDE ROAD NEAR DALIBAGH COLONY', '', 'LUCKNOW', '', '226001', '9651732818', '', '', '', '', '', '', '07AAGCS2672B1ZK'),
(37, 'SANKET COMMUNICATIONS PRIVATE LIMITED', '', '607 B BLOCK KASMANDA APARTMENT, 2 PARK ROAD HAZRATGANJ', '', 'LUCKNOW', '', '226001', '8700179780', '', '', '', '', '', '', '09AADCS1615D1ZQ'),
(38, 'M M ADVERTISING', '', 'SF-8 ABC COMPLEX NEAR SHUBHAM CINEMA 6 QUNTON ROAD', '', 'LUCKNOW', '', '226001', '9336222242', '', '', '', '', '', '', '09AAZFM7864R2ZN'),
(39, 'CRITIQUE COMMUNICATIONS PVT LTD', '', '602 6TH FLOOR AKASHDEEP BUILDING BARAKHAMBA ROAD ', '', 'NEW DELHI', '', '11001', '9792822200', '', '', '', '', '', '', '07AABCC3732H1ZY'),
(40, 'M G ADVERTISING SERVICES', '', 'M-23 PHASE 1 BADLI INDUSTRIAL ESTATE', '', 'DELHI', '', '110042', '8354850018', '', '', '', '', '', '', '09AEVPJ0791E1Z5'),
(41, 'APPROACH ADVERTISING & EXHIBITERS PVT. LTD.', '', 'FF-II ASHA APARTMENTS-1 RAM MOHAN RAI MARG ', '', 'LUCKNOW', '', '226001', '', '', '', '', '', '', '', '09AAECA2496A1ZZ'),
(42, 'SHARAD ADVERTISING PVT LTD', '', 'BL-13 BASEMENT ALISHA APARTMENT MADAN MOHAN MALVIYA MARG HAZRATGANJ', '', 'LUCKNOW', '', '226001', '', '', '', '', '', '', '', '09AAACS0631C1ZX'),
(43, 'ISHA ADVERTISING PVT. LTD.', '', 'C-301 IInd FLOOR GOVINDA APARTMENTS 1-A SHAHNAZAF ROAD', '', 'LUCKNOW', '', '226001', '0522-2627051, 2612074', '', '', '', '', '', '', '09AAACI8479A1ZH'),
(44, 'DIKSHA ADVERTISING & PRINTING PVT. LTD.', '', 'A-2 ANUJ APARTMENT 93-L DALIBAGH ', '', 'LUCKNOW', '', '226001', '9936436600', '', '', '', '', '', '', '09AACCD0729L1ZK'),
(45, 'CENTRAL BUREAU OF COMMUNICATION', '', 'SOOCHNA BHAWAN PHASE-V CGO COMPLEX LODHI ROAD', '', 'NEW DELHI', '', '110003', '', '', '', '', '', '', '', '0');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `username` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(100) NOT NULL,
  `password` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `email`, `phone`, `password`) VALUES
(1, 'Tirthraj Times', 'TirthADMIN', 'tirthraj_times@rediffmail.com', '', 'd3ab83944114b6c6a146bdc3d8c84492');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `invoices`
--
ALTER TABLE `invoices`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `invoices_old`
--
ALTER TABLE `invoices_old`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `invoice_items`
--
ALTER TABLE `invoice_items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `store_customers`
--
ALTER TABLE `store_customers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;

--
-- AUTO_INCREMENT for table `invoices`
--
ALTER TABLE `invoices`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;

--
-- AUTO_INCREMENT for table `invoices_old`
--
ALTER TABLE `invoices_old`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `invoice_items`
--
ALTER TABLE `invoice_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1000;

--
-- AUTO_INCREMENT for table `store_customers`
--
ALTER TABLE `store_customers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
