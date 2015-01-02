-- phpMyAdmin SQL Dump
-- version 3.4.5
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Sep 12, 2013 at 03:13 PM
-- Server version: 5.5.16
-- PHP Version: 5.3.8

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `yougotrated`
--

-- --------------------------------------------------------

--
-- Table structure for table `youg_comments`
--

CREATE TABLE IF NOT EXISTS `youg_comments` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `reviewid` bigint(20) NOT NULL,
  `comment` text CHARACTER SET latin1 NOT NULL,
  `status` enum('Enable','Disable') CHARACTER SET latin1 NOT NULL,
  `commentby` bigint(20) NOT NULL,
  `commentdate` datetime NOT NULL,
  `commentip` varchar(51) CHARACTER SET latin1 NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=28 ;

--
-- Dumping data for table `youg_comments`
--

INSERT INTO `youg_comments` (`id`, `reviewid`, `comment`, `status`, `commentby`, `commentdate`, `commentip`) VALUES
(4, 4, '\\"Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur?\\"', 'Enable', 1, '2013-06-17 16:23:13', '127.0.0.1'),
(5, 1, 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \\''Content here, content here\\'', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \\''lorem ipsum\\'' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose injected humour and the like).', 'Disable', 1, '2013-06-29 18:43:33', '122.170.77.221'),
(6, 6, 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using ', 'Enable', 1, '2013-06-17 16:56:10', '127.0.0.1'),
(7, 1, 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using ', 'Enable', 1, '2013-06-25 08:25:31', '122.179.187.191'),
(8, 1, 'Content here, content here\\'', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \\''lorem ipsum\\'' will uncover many web sites still in their infancy.', 'Enable', 1, '2013-06-25 08:26:01', '122.179.187.191'),
(9, 21, 'hello !!!', 'Enable', 3, '2013-07-06 19:05:39', '122.170.80.213'),
(10, 2, 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \\''Content here, content here\\'', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \\''lorem ipsum\\'' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the', 'Enable', 1, '2013-06-27 00:05:20', '122.169.16.211'),
(11, 2, ' making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \\''lorem ipsum\\'' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose', 'Enable', 2, '2013-06-25 08:39:32', '122.179.187.191'),
(12, 6, ' but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing ', 'Enable', 3, '2013-06-27 00:38:58', '122.169.16.211'),
(13, 1, 'and a search for \\''lorem ipsum\\'' will uncover many web sites still in their infancy. and a search for \\''lorem ipsum\\'' will uncover many web sites still in their infancy. ', 'Enable', 3, '2013-06-27 00:46:38', '122.169.16.211'),
(14, 26, 'test comment on review....tttt', 'Enable', 9, '2013-07-09 11:03:59', '122.169.16.127'),
(15, 24, 'bjnjnjknmkm', 'Enable', 9, '2013-06-27 06:13:00', '122.169.16.211'),
(16, 31, 'please never follow it !!!', 'Enable', 9, '2013-06-28 02:16:06', '122.179.187.20'),
(17, 31, 'I agree with you', 'Enable', 9, '2013-06-28 05:17:57', '122.179.187.20'),
(18, 31, 'ok', 'Disable', 9, '2013-06-28 05:18:25', '122.170.77.221'),
(19, 31, 'test one', 'Enable', 9, '2013-06-28 05:18:37', '122.179.187.20'),
(20, 31, 'test 4', 'Enable', 9, '2013-06-28 05:18:46', '122.179.187.20'),
(22, 31, 'test comment del', 'Disable', 9, '2013-06-28 05:19:53', '122.170.77.221'),
(23, 31, 'tretet', 'Enable', 9, '2013-06-28 05:20:51', '122.179.187.20'),
(24, 31, 'test pagination', 'Enable', 9, '2013-06-28 05:22:39', '122.179.187.20'),
(26, 33, 'Start with the name of the Company, Person or a Phone Number. Then select the complaint type to get started.\n\nAfter you submit a complaint, you can view your complaint status in your dashboard. Yougotrated will notify you of any updates on your complaint.\n\n<ul> <li> <b> Test font size... </b> </li> </ul>', 'Enable', 9, '2013-06-29 12:11:08', '122.170.86.89'),
(27, 33, 'http://awesomescreenshot.com/0d81g85ic4\nhttp://awesomescreenshot.com/0d81g85ic4http://awesomescreenshot.com/0d81g85ic4http://awesomescreenshot.com/0d81g85ic4http://awesomescreenshot.com/0d81g85ic4http://awesomescreenshot.com/0d81g85ic4', 'Enable', 9, '2013-06-29 12:14:11', '122.170.86.89');

-- --------------------------------------------------------

--
-- Table structure for table `youg_company`
--

CREATE TABLE IF NOT EXISTS `youg_company` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `company` varchar(255) NOT NULL,
  `streetaddress` varchar(255) NOT NULL,
  `city` varchar(55) NOT NULL,
  `state` varchar(55) NOT NULL,
  `country` varchar(55) NOT NULL,
  `zip` varchar(55) NOT NULL,
  `email` varchar(255) NOT NULL,
  `siteurl` varchar(255) NOT NULL,
  `paypalid` varchar(255) NOT NULL,
  `logo` varchar(255) NOT NULL,
  `phone` varchar(25) NOT NULL,
  `aboutus` text NOT NULL,
  `companyseokeyword` varchar(255) NOT NULL,
  `status` enum('Enable','Disable') NOT NULL DEFAULT 'Enable',
  `registerip` varchar(50) NOT NULL,
  `registerdate` datetime NOT NULL,
  `editip` varchar(50) NOT NULL,
  `editdate` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=27 ;

--
-- Dumping data for table `youg_company`
--

INSERT INTO `youg_company` (`id`, `company`, `streetaddress`, `city`, `state`, `country`, `zip`, `email`, `siteurl`, `paypalid`, `logo`, `phone`, `aboutus`, `companyseokeyword`, `status`, `registerip`, `registerdate`, `editip`, `editdate`) VALUES
(1, 'Test two', 'Corporate Headquarters,170 West Tasman Dr. San Jose, CA 95134,USA', '', '', '', '', 'viren@mxicoders.com', 'www.cisco.com', '', 'd72111d1abd121bcb65959890172b9e7.jpg', '792456789', 'At Cisco (NASDAQ: CSCO) customers come first and an integral part of our DNA is creating long-lasting customer partnerships and working with them to identify their needs and provide solutions that support their success.\n\nThe concept of solutions being driven to address specific customer challenges has been with Cisco since its inception. Husband and wife Len Bosack and Sandy Lerner, both working for Stanford University, wanted to email each other from their respective offices located in different buildings but were unable to due to technological shortcomings. A technology had to be invented to deal with disparate local area protocols; and as a result of solving their challenge - the multi-protocol router was born.\n\nSince then Cisco has shaped the future of the Internet by creating unprecedented value and opportunity for our customers, employees, investors and ecosystem partners and has become the worldwide leader in networking - transforming how people connect, communicate and collaborate.', 'Test-two', 'Enable', '127.0.0.1', '2013-05-14 11:37:15', '122.169.41.38', '2013-07-11 06:36:05'),
(2, 'Test three', 'Intel Corporation,Attn: Corporate Quality,2200 Mission College Blvd.,Santa Clara, CA 95054-1549USA', '', '', '', '', 'viren@mxicoders.com', 'www.intel.com', '', 'de1ee33879adfbcdcc4b748f5f396080.jpg', '(408) 765-8080', 'Intel Corporation is an American multinational semiconductor chip maker corporation headquartered in Santa Clara, California. Intel is the world\\''s largest and highest valued semiconductor chip maker, based on revenue.[3] It is the inventor of the x86 series of microprocessors, the processors found in most personal computers. Intel Corporation, founded on July 18, 1968, is a portmanteau of Integrated Electronics (the fact that \\"intel\\" is the term for intelligence information was also quite suitable).[4] Intel also makes motherboard chipsets, network interface controllers and integrated circuits, flash memory, graphic chips, embedded processors and other devices related to communications and computing. Founded by semiconductor pioneers Robert Noyce and Gordon Moore and widely associated with the executive leadership and vision of Andrew Grove, Intel combines advanced chip design capability with a leading-edge manufacturing capability. Though Intel was originally known primarily to engineers and technologists, its \\"Intel Inside\\" advertising campaign of the 1990s made it and its Pentium processor household names.\n\nIntel was an early developer of SRAM and DRAM memory chips, and this represented the majority of its business until 1981. Although Intel created the world\\''s first commercial microprocessor chip in 1971, it was not until the success of the personal computer (PC) that this became its primary business. During the 1990s, Intel invested heavily in new microprocessor designs fostering the rapid growth of the computer industry. During this period Intel became the dominant supplier of microprocessors for PCs, and was known for aggressive and sometimes illegal tactics in defense of its market position, particularly against Advanced Micro Devices (AMD), as well as a struggle with Microsoft for control over the direction of the PC industry.[5][6] The 2011 rankings of the world\\''s 100 most valuable brands published by Millward Brown Optimor showed the company\\''s brand value at number 58 and in 2012 at number ', 'Test-three', 'Enable', '127.0.0.1', '2013-05-14 11:37:15', '122.169.41.38', '2013-07-11 06:36:25'),
(3, 'Test Four', 'Mount Poonamallee Road,Manapakkam,P.B.No.979, Chennai – 600089', '', '', '', '', 'viren@mxicoders.com', 'www.lt.com', '', '302ffb833809ed16ee1b45d6afdca1c9.jpg', '+91-44-22526000', 'Larsen & Toubro (L&T) is India’s largest technology, engineering, manufacturing and construction organization with a record of over 70 years. L&T is also adjudged India’s best managed and most respected company on various attributes of customer delight and shareholder value.\nL&T Construction is the largest construction organization in the country. It figures among the World’s 58th Top International Contractors and ranks 27th in global ranking as per the survey conducted by the reputed international contractors magazine Engineering News Record, USA (August 2011).\n\nL&T Construction’s cutting edge capabilities cover every discipline of construction – civil, mechanical, electrical and instrumentation engineering and services extend to large industrial and infrastructure projects from concept to commissioning.\n\nL&T Construction has played a prominent role in India’s industrial and infrastructure development by executing several projects across length and breadth of the country and abroad. For ease of operations and better project management, in-depth technology and business development as well as to focus attention on domestic and international project execution, entire operations of L&T Construction is structured into four Independent Companies.', 'Test-Four', 'Enable', '127.0.0.1', '2013-05-17 09:09:15', '122.169.41.38', '2013-07-11 06:36:43'),
(6, 'Test Six', 'SG Highway, Ahmedabad, Gujarat, India.', '', '', '', '', 'pranay@mxicoders.com', 'www.primeline.com', '', 'f0afe1c64d34f4bf1687f8c311d9299a.jpg', '99335353', 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \\''Content here, content here\\'', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \\''lorem ipsum\\'' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).', 'Test-Six', 'Enable', '127.0.0.1', '2013-05-17 11:03:34', '122.169.41.38', '2013-07-11 06:37:02'),
(7, 'Test Five', 'Newman Tennis Center / Augusta GA 3103 Wrightsboro Rd, Augusta, GA 30909, United States', '', '', '', '', 'viren@mxicoders.com', 'www.newman.com', '', '6d2da58255bb6288dc1f7df58414b692.jpg', '+1 706-821-1600', 'Mobile Camp Data is a community outreach program developed by the City of Augusta\\''s Information Technology Department in cooperation with Recreation, Parks & Facilities.  Children ages 8-11 are invited to come and explore the exciting and fast moving world of technology.', 'Test-Five', 'Enable', '127.0.0.1', '2013-05-18 12:13:55', '122.169.41.38', '2013-07-11 06:37:26'),
(8, 'Testcompany', 'Hyedrabad,India', '', '', '', '', 'viren@mxicoders.com', 'www.testcompany.com ', '', '180555958a3b098948d7f084ca60b185.jpg', '99335353', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\\''s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', 'Testcompany', 'Enable', '127.0.0.1', '2013-05-18 12:32:26', '122.169.41.38', '2013-07-11 06:38:12'),
(9, 'Testone', '1 Infinite Loop,Cupertino, CA 95014, United States,408.996.1010', '', '', '', '', 'pranay@mxicoders.com', 'www.apple.com', '', '4ec3fe8772bbae394dc9b7ab812b92b6.jpg', '8006927753', 'Apple Inc., formerly Apple Computer, Inc., is an American multinational corporation headquartered in Cupertino, California[2] that designs, develops, and sells consumer electronics, computer software and personal computers. Its best-known hardware products are the Mac line of computers, the iPod music player, the iPhone smartphone, and the iPad tablet computer. Its software includes the OS X and iOS operating systems, the iTunes media browser, the Safari web browser, and the iLife and iWork creativity and production suites. The company was founded on April 1, 1976, and incorporated as Apple Computer, Inc. on January 3, 1977.[6] The word \\"Computer\\" was removed from its name on January 9, 2007, reflecting its shifted focus towards consumer electronics after the introduction of the iPhone.[7][8][9]\n\nApple is the world\\''s second-largest information technology company by revenue after Samsung Electronics, and the world\\''s third-largest mobile phone maker after Samsung and Nokia.[10] Fortune magazine named Apple the most admired company in the United States in 2008, and in the world from 2008 to 2012.[11][12][13][14][15] However, the company has received criticism for its contractors\\'' labor practices, and for Apple\\''s own environmental and business practices.[16][17][18]\n\nAs of November 2012, Apple maintains 394 retail stores in fourteen countries[19][20] as well as the online Apple Store and iTunes Store.[21] It is the second-largest publicly traded corporation in the world by market capitalization, with an estimated value of US$414 billion as of January 2013.[22] As of September 29, 2012, the company had 72,800 permanent full-time employees and 3,300 temporary full-time employees worldwide.[4] Its worldwide annual revenue in 2012 totalled $156 billion.[4]. In May 2013, Apple had made it to the top ten of the Fortune 500 list of companies for the first time, taking the 6 position, 11 places up from the previous year', 'Testone', 'Enable', '127.0.0.1', '2013-05-21 12:04:04', '122.169.41.38', '2013-07-11 06:38:24'),
(10, 'Test 7', 'Bodakdev, Ahmedabad, Gujarat, India', '', '', '', '', 'pranay@mxicoders.com', 'www.starline.com', '', 'c8792b563df26f954991cd34aac1c271.jpg', '792456789', 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \\''Content here, content here\\'', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \\''lorem ipsum\\'' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).', 'Test-7', 'Enable', '127.0.0.1', '2013-05-21 14:23:24', '122.170.74.80', '2013-07-12 00:59:18'),
(11, 'Test Company name', 'sector 3', 'gandhinagar', 'gujarat', 'india', '382003', 'viren@mxicoders.com', 'www.worldstar.com', '', '3841b0f7997e2b6bb22399bb6029b025.jpg', '4657896700', 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \\''Content here, content here\\'', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \\''lorem ipsum\\'' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).', 'Test-Company-name-pvt-ltd', 'Enable', '127.0.0.1', '2013-05-21 14:23:24', '122.169.16.100', '2013-08-08 05:20:32'),
(12, 'Test-8', 'Chanakyapuri, New Sama Road, Baroda, Gujarat, India.', 'gandhinagar', 'gujarat', 'india', '741852', 'rushit@mxicoders.com', 'www.sunrise.com', '', '4674207da7be36cf6c9343d147df4400.jpg', '065-2566743', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\\''s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', 'Test-8', 'Enable', '122.179.172.133', '2013-05-23 08:01:30', '122.169.19.88', '2013-08-13 06:06:04'),
(13, 'Mycompany', 'Park ville, London', '', '', '', '', 'pranay@mxicoders.com', 'www.mycompany.com', '', '434de1206ee7313cdd984a7395ae9184.jpeg', '430-345-567', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\\''s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', 'My-company', 'Enable', '122.170.76.252', '2013-05-27 07:30:06', '122.169.41.38', '2013-07-11 06:40:30'),
(17, 'Diamond nexus', 'a', '', '', '', '', 'a@gmail.com', '', '', '', '7418529630', '', 'Diamond-nexus', 'Enable', '173.65.82.79', '2013-07-03 00:13:40', '122.169.41.38', '2013-07-11 06:41:07'),
(20, 'abcd', '', '', '', '', '', '', '', '', '', '', '', 'abcd_20', 'Enable', '122.170.74.80', '2013-07-12 12:14:53', '', '0000-00-00 00:00:00'),
(21, 'ab', '', '', '', '', '', '', '', '', '', '', '', 'ab_21', 'Enable', '122.170.74.80', '2013-07-12 12:16:00', '', '0000-00-00 00:00:00'),
(23, 'DIAMOND NEXUS', 'ahmd', '', '', '', '', 'test@gmail.com', '', '', 'd1cea4ec7b61e88f424352a9b2395ac4.jpg', '9856885556', '', 'DIAMOND-NEXUS_23', 'Enable', '173.169.181.65', '2013-07-16 02:25:40', '122.170.17.63', '2013-07-31 01:50:23'),
(25, 'agape diamonds', '13014 N Dale Mabry hwy Suite 122 Tampa Fl 33618', '', '', '', '', 'pranay@mxicoders.com', 'http://www.diamondslabcreated.com', '', '', '1-800-861-5144', 'lab created diamonds', 'agape-diamonds-25', 'Enable', '173.65.30.199', '2013-08-05 15:15:36', '173.65.30.199', '2013-08-05 04:50:54'),
(26, 'testing 59 inc', '', '', '', '', '', '', '', '', '', '', '', 'testing-59-inc-26', 'Enable', '173.65.58.122', '2013-08-08 19:30:35', '', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `youg_complaints`
--

CREATE TABLE IF NOT EXISTS `youg_complaints` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `type` enum('Company','Person','Phone') NOT NULL,
  `companyid` bigint(20) NOT NULL,
  `userid` bigint(20) NOT NULL,
  `damagesinamt` decimal(10,2) NOT NULL,
  `whendate` date NOT NULL,
  `location` varchar(255) NOT NULL,
  `detail` text NOT NULL,
  `comseokeyword` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `emailid` varchar(255) NOT NULL,
  `status` enum('Enable','Disable') NOT NULL DEFAULT 'Enable',
  `cancel_amount` varchar(155) NOT NULL,
  `transactionid` varchar(255) NOT NULL,
  `transaction_date` datetime NOT NULL,
  `complaindate` datetime NOT NULL,
  `complainip` varchar(51) NOT NULL,
  `like` int(11) NOT NULL,
  `notlike` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=47 ;

--
-- Dumping data for table `youg_complaints`
--

INSERT INTO `youg_complaints` (`id`, `type`, `companyid`, `userid`, `damagesinamt`, `whendate`, `location`, `detail`, `comseokeyword`, `username`, `emailid`, `status`, `cancel_amount`, `transactionid`, `transaction_date`, `complaindate`, `complainip`, `like`, `notlike`) VALUES
(1, 'Person', 10, 1, 333.00, '2013-03-19', '', 'I ordered the complete DVD set of 7th Heaven with promised delivery of 2-4 weeks. Still no delivery and I have e-mailed support to try to get information and have had no response. E-mail was returned rejected. Unable to connect to server.', 'test_7_complaint_1', '', '', 'Disable', '', '', '0000-00-00 00:00:00', '2013-07-12 00:00:00', '122.170.74.80', 0, 0),
(2, 'Company', 1, 1, 65.45, '2013-04-08', 'California, US', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\\''s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', 'test_two_complaint_2', '', '', 'Enable', '', '', '0000-00-00 00:00:00', '2013-07-12 00:00:00', '122.170.74.80', 0, 0),
(3, 'Person', 12, 2, 45.90, '2013-03-05', 'Bodakdev, Ahemdabad', 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \\''Content here, content here\\'', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \\''lorem ipsum\\'' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).', 'Test_8_complaint_3', 'Rahul', 'rahul@gmail.com', 'Enable', '', '', '0000-00-00 00:00:00', '2013-07-12 00:00:00', '122.170.74.80', 0, 0),
(4, 'Person', 6, 2, 80.90, '2013-04-01', '', 'Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of \\"de Finibus Bonorum et Malorum\\" (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, \\"Lorem ipsum dolor sit amet..\\", comes from a line in section 1.10.32.', 'Test_Six_complaint_4', '', '', 'Enable', '', '', '0000-00-00 00:00:00', '2013-07-12 00:00:00', '122.170.74.80', 0, 0),
(5, 'Person', 11, 1, 545.78, '2013-04-05', 'SG Highway, Ahmedabad', 'There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don\\''t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn\\''t anything embarrassing hidden in the middle of text. All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable. The generated Lorem Ipsum is therefore always free from repetition, injected humour, or non-characteristic words etc.', 'Test_company_name_complaint_5', 'Priyanka', 'priyanka@gmail.com', 'Enable', '', '', '0000-00-00 00:00:00', '2013-07-12 00:00:00', '122.170.74.80', 0, 0),
(6, 'Phone', 8, 1, 700.89, '2013-05-01', '', 'When computers came along, Aldus included lorem ipsum in its PageMaker publishing software, and you now see it wherever designers, content designers, art directors, user interface developers and web designer are at work.\n\nThey use it daily when using programs such as Adobe Photoshop, Paint Shop Pro, Dreamweaver, FrontPage, PageMaker, FrameMaker, Illustrator, Flash, Indesign etc.', 'Test_company_one_complaint_6', '', '', 'Enable', '', '', '0000-00-00 00:00:00', '2013-07-12 00:00:00', '122.170.74.80', 0, 0),
(8, 'Company', 1, 3, 250.00, '2013-06-24', 'gandhinagar', 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \\''Content here, content here\\'', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \\''lorem ipsum\\'' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).', 'test_two_complaint_8', '', '', 'Enable', '', '', '0000-00-00 00:00:00', '2013-07-12 00:00:00', '122.170.74.80', 0, 0),
(9, 'Phone', 2, 3, 450.00, '2013-06-15', '', 'lorem ipsum will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).lorem ipsum will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).', 'test_three_complaint_9', '', '', 'Enable', '', '', '0000-00-00 00:00:00', '2013-07-12 00:00:00', '122.170.74.80', 0, 0),
(10, 'Person', 1, 3, 145.00, '2013-06-24', '', 'This book is a treatise on the theory of ethics, very popular during the Renaissance. This book is a treatise on the theory of ethics, very popular during the Renaissance. ', 'test_two_complaint_10', '', '', 'Enable', '', '', '0000-00-00 00:00:00', '2013-07-12 00:00:00', '122.170.74.80', 0, 0),
(11, 'Phone', 2, 3, 235.00, '2013-06-22', '', 'ethics, very popular during the Renaissance. This book is a treatise on the theory of This book is a treatise on the theory of ethics, very popular during the Renaissance. This book is a treatise on the theory of This book is a treatise on the theory of ethics, very popular during the Renaissance. This book is a treatise on the theory of This book is a treatise on the theory of ethics, very popular during the Renaissance. This book is a treatise on the theory of This book is a treatise on the theory of ', 'test_three_complaint_11', '', '', 'Enable', '', '', '0000-00-00 00:00:00', '2013-07-12 00:00:00', '122.170.74.80', 0, 0),
(12, 'Company', 6, 3, 255.00, '2013-06-02', 'gandhinagar', 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that itIt is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it', 'Test_Six_complaint_12', '', '', 'Enable', '', '', '0000-00-00 00:00:00', '2013-07-12 00:00:00', '122.170.74.80', 0, 0),
(13, 'Company', 3, 9, 111.00, '2013-06-01', 'Gurukul,Ahmedabad -380052', 'After you submit a complaint, you can view your complaint status in your dashboard.\nAfter you submit a complaint, you can view your complaint status in your dashboard.\nAfter you submit a complaint, you can view your complaint status in your dashboard.\nAfter you submit a complaint, you can view your complaint status in your dashboard.\nAfter you submit a complaint, you can view your complaint status in your dashboard.After you submit a complaint, you can view your complaint status in your dashboard.\nAfter you submit a complaint, you can view your complaint status in your dashboard.\nAfter you submit a complaint, you can view your complaint status in your dashboard', 'Test_four_complaint_13', '', '', 'Enable', '', '', '0000-00-00 00:00:00', '2013-07-12 00:00:00', '122.170.74.80', 0, 0),
(14, 'Person', 3, 9, 1023.00, '2013-06-20', 'Surat', 'Information about Test was first submitted to Scambook on Sep 12, 2011. Since then the page has accumulated 2 consumer complaint.Information about Test was first submitted to Scambook on Sep 12, 2011. Since then the page has accumulated 2 consumer complaint.Information about Test was first submitted to Scambook on Sep 12, 2011. Since then the page has accumulated 2 consumer complaint.Information about Test was first submitted to Scambook on Sep 12, 2011. Since then the page has accumulated 2 consumer complaint.', 'Test_four_complaint_14', 'Demo User', 'vidhi@mxicoders.com', 'Enable', '', '', '0000-00-00 00:00:00', '2013-07-12 00:00:00', '122.170.74.80', 0, 0),
(15, 'Person', 11, 0, 450.00, '2013-06-27', 'ahmedabad', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\\''s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\\''s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\\''s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', 'Test_company_one_complaint_15', '', '', 'Enable', '', '', '0000-00-00 00:00:00', '2013-07-12 00:00:00', '122.170.74.80', 0, 0),
(16, 'Phone', 12, 0, 1002.00, '2013-06-04', '', 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \\''Content here, content here\\'', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \\''lorem ipsum\\'' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).', 'Test_8_complaint_16', '', '', 'Enable', '', '', '0000-00-00 00:00:00', '2013-07-12 00:00:00', '122.170.74.80', 0, 0),
(17, 'Person', 6, 0, 15002.00, '2013-06-04', 'Ring road,Surat', 'Please give feedback and solution of my problems\nasap give resdponse.\nPlease give feedback and solution of my problems\nasap give resdponse.\nPlease give feedback and solution of my problems\nasap give resdponse.\nPlease give feedback and solution of my problems\nasap give resdponse.\nPlease give feedback and solution of my problems\nasap give resdponse.\n', 'Test_Six_complaint_17', 'Vidhi', 'vidhi@mxicoders.com', 'Enable', '', '', '0000-00-00 00:00:00', '2013-07-12 00:00:00', '122.170.74.80', 0, 0),
(18, 'Company', 3, 0, 10023.00, '2013-06-16', 'Bodakdev', 'i am testing that at prelogin if i have submitted complaint by using type of company it will allow me to add or redirect to logged in. \ni am testing that at prelogin if i have submitted complaint by using type of company it will allow me to add or redirect to logged in. ', 'Test_four_complaint_18', '', '', 'Enable', '', '', '0000-00-00 00:00:00', '2013-07-12 00:00:00', '122.170.74.80', 0, 0),
(19, 'Company', 8, 10, 240.00, '2013-06-28', '', 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \\''Content here, content here\\'', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \\''lorem ipsum\\'' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).\nIt is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \\''Content here, content here\\'', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \\''lorem ipsum\\'' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).', 'Testcompany-complaint-19', '', '', 'Enable', '', '', '0000-00-00 00:00:00', '2013-07-11 00:00:00', '122.169.41.38', 0, 0),
(20, 'Person', 6, 10, 450.00, '2013-06-15', 'surat', 'making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \\''lorem ipsum\\'' will uncover many web sites still in their infancymaking it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \\''lorem ipsum\\'' will uncover many web sites still in their infancy\n', 'Test-Six-complaint-20', 'Pranay', 'pranay9803@gmail.com', 'Enable', '', '', '0000-00-00 00:00:00', '2013-07-11 00:00:00', '122.169.41.38', 0, 0),
(21, 'Phone', 13, 10, 250.00, '2013-06-26', '', 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \\''Content here, content here\\'', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \\''lorem ipsum\\'' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).\nIt is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \\''Content here, content here\\'', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \\''lorem ipsum\\'' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).', 'Mycompany-complaint-21', '', '', 'Enable', '', '', '0000-00-00 00:00:00', '2013-07-11 00:00:00', '122.169.41.38', 0, 0),
(22, 'Company', 9, 0, 650.00, '2013-04-17', 'rajkot', 'combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable. The generated Lorem Ipsum is therefore always free from repetition, injected humour, or non-characteristic words etc.', 'Testone-complaint-22', 'Girish', 'girish@mxicoders.com', 'Disable', '', '', '0000-00-00 00:00:00', '2013-07-11 00:00:00', '122.169.41.38', 0, 0),
(25, 'Company', 17, 0, 1200.00, '2013-07-01', 'ONLINE STORE', 'THIS COMPANY DIAMOND NEXUS STOLE MY MONEY.\nhttp://www.diamondnexus.com/\n\nI WOULD LIKE A REFUND BUT NO ONE AT THERE COMPANY WILL HELP ME.\n\n\nTHIS COMPANY IS A COMPLETE FRAUD', 'diamond-nexus-complaint-25', '', '', 'Disable', '', '', '0000-00-00 00:00:00', '2013-07-11 00:00:00', '122.170.74.80', 0, 0),
(28, 'Company', 13, 0, 100.00, '2013-07-08', 'surat', 'Lorem Ipsum is simply dummy text of the printing and typesetting industryLorem Ipsum is simply dummy text of the printing and typesetting industryLorem Ipsum is simply dummy text of the printing and typesetting industryLorem Ipsum is simply dummy text of the printing and typesetting industryLorem Ipsum is simply dummy text of the printing and typesetting industry', 'Mycompany-complaint-28', '', '', 'Enable', '', '', '0000-00-00 00:00:00', '2013-07-11 00:00:00', '122.169.41.38', 0, 0),
(34, 'Company', 20, 1, 140.00, '2013-07-01', 'ahmedabad', 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \\''Content here, content here\\'', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \\''lorem ipsum\\'' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).', 'abcd_complaint_34', '', '', 'Enable', '', '', '0000-00-00 00:00:00', '2013-07-12 12:14:53', '122.170.74.80', 0, 0),
(35, 'Person', 20, 1, 120.00, '2013-07-03', 'surat', 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \\''Content here, content here\\'', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \\''lorem ipsum\\'' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \\''Content here, content here\\'', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \\''lorem ipsum\\'' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \\''Content here, content here\\'', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \\''lorem ipsum\\'' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \\''Content here, content here\\'', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \\''lorem ipsum\\'' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \\''Content here, content here\\'', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \\''lorem ipsum\\'' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \\''Content here, content here\\'', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \\''lorem ipsum\\'' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).', 'abcd_complaint_35', 'pranay', 'pranay@gmail.com', 'Enable', '', '', '0000-00-00 00:00:00', '2013-07-12 00:00:00', '122.170.74.80', 0, 0),
(36, 'Phone', 21, 1, 250.00, '2013-07-02', '', 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \\''Content here, content here\\'', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text', 'ab-complain-36', '', '', 'Enable', '', '', '0000-00-00 00:00:00', '2013-07-12 00:00:00', '122.170.74.80', 0, 0),
(37, 'Company', 23, 0, 2000.00, '2013-07-01', '5050 W. Ashland Way Franklin, WI 53132', 'THIS COMPANY SOLD ME A CHEAP CZ STONE THAT FELL APART AFTER A FEW DAYS AND REFUSES TO ISSUE A REFUND EVEN THOUGH I AM WITHIN THE TIME TO DO SO.\n\nI CANNOT BELIEVE A COMPANY CAN STAY IN BUSINESS DOING THINGS THIS WAY.\n\nDO NOT BUY FROM THIS COMPANY', 'DIAMONDNEXUS_complaint_37', '', '', 'Enable', '', '', '0000-00-00 00:00:00', '2013-07-16 00:00:00', '122.170.75.17', 0, 0),
(38, 'Company', 17, 0, 150.00, '2013-07-03', 'ahmedabad', 'After you submit a complaint, you can view your complaint status in your dashboard. Yougotrated will notify you of any updates on your complaint. After you submit a complaint, you can view your complaint status in your dashboard. Yougotrated will notify you of any updates on your complaint. ', 'Diamond_nexus_complaint_38', '', '', 'Enable', '', '', '0000-00-00 00:00:00', '2013-07-16 00:00:00', '122.170.75.17', 0, 0),
(40, 'Company', 17, 0, 121.00, '2013-07-10', '', 'Start with the name of the Company, Person or a Phone Number. Then select the complaint type to get started.\nStart with the name of the Company, Person or a Phone Number. Then select the complaint type to get started.\nStart with the name of the Company, Person or a Phone Number. Then select the complaint type to get started.\n', 'Diamond_nexus_complaint_40', '', '', 'Enable', '', '', '0000-00-00 00:00:00', '2013-07-16 00:00:00', '122.170.75.17', 0, 0),
(41, 'Company', 17, 0, 121.00, '2013-07-10', '', 'Start with the name of the Company, Person or a Phone Number. Then select the complaint type to get started.\nStart with the name of the Company, Person or a Phone Number. Then select the complaint type to get started.\nStart with the name of the Company, Person or a Phone Number. Then select the complaint type to get started.\n', 'Diamond_nexus_complaint_41', '', '', 'Enable', '', '', '0000-00-00 00:00:00', '2013-07-16 00:00:00', '122.170.75.17', 0, 0),
(42, 'Company', 11, 0, 150.00, '2013-07-10', '', ' After you submit a complaint, you can view your complaint status in your dashboard. Yougotrated will notify you of any updates on your complaint.  After you submit a complaint, you can view your complaint status in your dashboard. Yougotrated will notify you of any updates on your complaint. ', 'Test-Company-name-pvt-ltd_complaint_42', '', '', 'Enable', '', '', '0000-00-00 00:00:00', '2013-07-16 00:00:00', '122.170.75.17', 0, 0),
(43, 'Company', 23, 0, 11.00, '2013-07-10', '', ' After you submit a complaint, you can view your complaint status in your dashboard. Yougotrated will notify you of any updates on your complaint.  After you submit a complaint, you can view your complaint status in your dashboard. Yougotrated will notify you of any updates on your complaint.  After you submit a complaint, you can view your complaint status in your dashboard. Yougotrated will notify you of any updates on your complaint.  After you submit a complaint, you can view your complaint status in your dashboard. Yougotrated will notify you of any updates on your complaint. ', 'DIAMOND-NEXUS_complaint_43', '', '', 'Enable', '', '', '0000-00-00 00:00:00', '2013-07-16 11:45:41', '122.170.75.17', 0, 0),
(44, 'Company', 17, 0, 120.00, '2013-07-12', '', ' After you submit a complaint, you can view your complaint status in your dashboard. Yougotrated will notify you of any updates on your complaint.  After you submit a complaint, you can view your complaint status in your dashboard. Yougotrated will notify you of any updates on your complaint.  After you submit a complaint, you can view your complaint status in your dashboard. Yougotrated will notify you of any updates on your complaint. ', 'Diamond-nexus_complaint_44', '', '', 'Enable', '', '', '0000-00-00 00:00:00', '2013-07-16 11:47:08', '122.170.75.17', 0, 0),
(45, 'Company', 24, 0, 200.00, '2013-07-01', '13014 N Dale mabry hwy suite 122', 'comapny sold me ring and then one of the stones fell out.\n\nbdsfbjhabdjhcbfajsbdfjbabdf\njhgdhabdhbfa\n\nhdgfhabdfhgahugdfhugasdf\nhvdhgajdhgfas\nahgvdcgSDgfjhsdgfsdF', 'agape-diamonds-complaint-45', '', '', 'Enable', '', '', '0000-00-00 00:00:00', '2013-08-05 14:08:01', '173.65.30.199', 0, 0),
(46, 'Company', 25, 0, 700.00, '2013-06-04', '13014 N dale mabry hwy Suite 122 tampa fl 33618', 'cvbnasdbvjbasdjhvcjhsdc\r\nSDCVHGsvdfvashgdVCHGadf\r\najhsgdchgSDVhgsvdcf\r\najdsfchjasvdjhcvjhsadvfas\r\n\r\nasdvfhgvasDFVjashvdcgvgsfdtcyfawedcasd\r\n\r\nsdFBajhcdjhavejdf\r\nasjCDJHavhgdvjehFD\r\nagape diamonds\r\n\r\nsdvchgvaseDHGCHGasdvcgaD\r\n\r\nADSFCHGavscdhgavDad\r\n\r\nahsGCVHGasghd', 'agape-diamonds-complaint-46', '', '', 'Enable', '', '', '0000-00-00 00:00:00', '2013-08-05 15:15:36', '173.65.30.199', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `youg_coupon`
--

CREATE TABLE IF NOT EXISTS `youg_coupon` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `companyid` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `promocode` varchar(50) NOT NULL,
  `enddate` datetime NOT NULL,
  `status` enum('Enable','Disable') NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `youg_coupon`
--

INSERT INTO `youg_coupon` (`id`, `companyid`, `title`, `promocode`, `enddate`, `status`) VALUES
(4, 2, 'my1', '5231a80134e04', '2013-09-30 00:00:00', 'Enable'),
(5, 12, 'my', '5231a8112a156', '2013-09-12 00:00:00', 'Enable');

-- --------------------------------------------------------

--
-- Table structure for table `youg_elite`
--

CREATE TABLE IF NOT EXISTS `youg_elite` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `company_id` int(11) NOT NULL,
  `payment_amount` decimal(10,2) NOT NULL,
  `payment_currency` varchar(51) COLLATE utf8_bin NOT NULL,
  `transactionid` varchar(255) COLLATE utf8_bin NOT NULL,
  `payment_date` datetime NOT NULL,
  `payment_ip` varchar(21) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=19 ;

--
-- Dumping data for table `youg_elite`
--

INSERT INTO `youg_elite` (`id`, `company_id`, `payment_amount`, `payment_currency`, `transactionid`, `payment_date`, `payment_ip`) VALUES
(1, 1, 10.00, 'USD', '6JT61241X7172241J', '2013-06-24 08:18:49', '122.179.166.150'),
(2, 9, 10.00, 'USD', '63R85897TC7372824', '2013-06-25 00:14:09', '122.169.19.201'),
(9, 10, 10.00, 'USD', '9WW70734CD4231330', '2013-07-01 04:05:23', '122.179.168.103'),
(14, 3, 10.00, 'USD', '90N05797XT0877918', '2013-07-01 05:43:36', '122.179.168.103'),
(15, 23, 10.00, 'USD', '3VE41912FT307430M', '2013-08-13 05:28:30', '122.169.19.88'),
(18, 12, 10.00, 'USD', '8N124651HY898073N', '2013-08-13 06:09:26', '122.169.19.88');

-- --------------------------------------------------------

--
-- Table structure for table `youg_emails`
--

CREATE TABLE IF NOT EXISTS `youg_emails` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `title` text CHARACTER SET latin1 NOT NULL,
  `variables` text CHARACTER SET latin1 NOT NULL,
  `subject` varchar(255) CHARACTER SET latin1 NOT NULL,
  `mailformat` text CHARACTER SET latin1 NOT NULL,
  `editdate` datetime NOT NULL,
  `editip` varchar(50) CHARACTER SET latin1 NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=5 ;

--
-- Dumping data for table `youg_emails`
--

INSERT INTO `youg_emails` (`id`, `title`, `variables`, `subject`, `mailformat`, `editdate`, `editip`) VALUES
(1, 'User Registration', '<font style="background:#FFFFE0">%firstname%</font> -> Provide First Name\r\n<font style="background:#FFFFE0">%lastname%</font>  -> Provide Last Name\r\n<font style="background:#FFFFE0">%email%</font>    -> Provide Email\r\n<font style="background:#FFFFE0">%password%</font>  -> Provide Password\r\n<font style="background:#FFFFE0">%link%</font>      -> Provide Activation link\r\n<font style="background:#FFFFE0">%sitename%</font>  -> Provide Sitename\r\n<font style="background:#FFFFE0">%siteurl%</font>  -> Provide Site URL\r\n<font style="background:#FFFFE0">%sitemail%</font>  -> Provide Site E-mail', 'YouGotRated : User Registration', '<p>\n Dear&nbsp; %firstname% %lastname%,</p>\n<p>\n You have just created your account&nbsp; in <a href=\\"%siteurl%\\" title=\\"%sitename%\\">%sitename%</a> .</p>\n<p>\n You can login with the following credentials after you activate your account by clicking link below or paste it in the address bar.</p>\n<p>\n -------------------------------------------------------------------</p>\n<p>\n Email ID&nbsp; &nbsp;&nbsp; :&nbsp; %email%</p>\n<p>\n Password&nbsp; :&nbsp; %password%</p>\n<p>\n -------------------------------------------------------------------</p>\n<p>\n Please click this link to activate your account.</p>\n<p>\n %link%</p>\n<br />\n<p>\n Regards,<br />\n The %sitename% Team.</p>\n', '2013-06-13 00:00:00', '122.170.77.224'),
(2, 'Forgot Password', '<font style="background:#FFFFE0">%firstname%</font> -> Provide First Name\r\n<font style="background:#FFFFE0">%lastname%</font>  -> Provide Last Name\r\n<font style="background:#FFFFE0">%email%</font>     -> Provide User Emailid\r\n<font style="background:#FFFFE0">%password%</font>  -> Provide Password\r\n<font style="background:#FFFFE0">%sitename%</font>  -> Provide Sitename\r\n<font style="background:#FFFFE0">%siteurl%</font>   -> Provide Site URL\r\n<font style="background:#FFFFE0">%sitemail%</font>  -> Provide Site E-mail', 'YouGotRated : Forgot Password', '<p>\n Dear&nbsp; %firstname% %lastname%,</p>\n<p>\n Your Account Details are as below.</p>\n<p>\n <strong>Login Details : </strong></p>\n<table border=\\"0\\" cellpadding=\\"1\\" cellspacing=\\"1\\">\n <tbody>\n  <tr>\n   <td>\n    Email</td>\n   <td>\n    <strong>:</strong></td>\n   <td>\n    %email%</td>\n  </tr>\n  <tr>\n   <td>\n    Password</td>\n   <td>\n    <strong>:</strong></td>\n   <td>\n    %password%</td>\n  </tr>\n  <tr>\n   <td>\n    URL</td>\n   <td>\n    <strong>:</strong></td>\n   <td>\n    %siteurl%</td>\n  </tr>\n </tbody>\n</table>\n<p>\n Regards,<br />\n The %sitename% Team.</p>\n', '2013-06-13 00:00:00', '122.170.77.224'),
(3, 'User Registration - Admin Mail', '<font style="background:#FFFFE0">%firstname%</font> -> Provide First Name\r\n<font style="background:#FFFFE0">%lastname%</font>  -> Provide Last Name\r\n<font style="background:#FFFFE0">%email%</font>    -> Provide Emailid\r\n<font style="background:#FFFFE0">%sitename%</font>  -> Provide Sitename\r\n<font style="background:#FFFFE0">%siteurl%</font>   -> Provide Site URL\r\n<font style="background:#FFFFE0">%sitemail%</font>  -> Provide Site E-mail', 'User Registration', '<p>\n Dear Admin,</p>\n<p>\n New User is registered.<br />\n <br />\n User&#39;s details are as below.</p>\n<table border=\\"0\\" cellpadding=\\"1\\" cellspacing=\\"1\\" width=\\"300px\\">\n <tbody>\n  <tr>\n   <td width=\\"35%\\">\n    First Name</td>\n   <td width=\\"5%\\">\n    <strong>:</strong></td>\n   <td width=\\"60%\\">\n    %firstname%</td>\n  </tr>\n  <tr>\n   <td width=\\"35%\\">\n    Last Name</td>\n   <td width=\\"5%\\">\n    <strong>:</strong></td>\n   <td width=\\"60%\\">\n    %lastname%</td>\n  </tr>\n  <tr>\n   <td width=\\"35%\\">\n    Email ID</td>\n   <td width=\\"5%\\">\n    <strong>:</strong></td>\n   <td width=\\"60%\\">\n    %email%</td>\n  </tr>\n </tbody>\n</table>\n<p>\n &nbsp;</p>\n', '2013-06-13 00:00:00', '122.170.77.224'),
(4, 'Contact Us- Admin Mail', '<font style="background:#FFFFE0">%username%</font -> Provide User Name\r\n<font style="background:#FFFFE0">%email%</font> -> Provide Emailid\r\n<font style="background:#FFFFE0">%subject%</font> -> Provide Subject\r\n<font style="background:#FFFFE0">%subjectname%</font> -> Provide Subject by user\r\n<font style="background:#FFFFE0">%message%</font> -> Provide Message\r\n<font style="background:#FFFFE0">%sitename% </font>-> Provide Sitename\r\n<font style="background:#FFFFE0">%siteurl%</font> -> Provide Site URL\r\n<font style="background:#FFFFE0">%sitemail%</font> -> Provide Site E-mail', 'Enquiry About', '<table border=\\"0\\" cellpadding=\\"0\\" cellspacing=\\"0\\" width=\\"100%\\">\n <tbody>\n  <tr>\n   <td>\n    Dear Admin,</td>\n  </tr>\n  <tr>\n   <td>\n    &nbsp;</td>\n  </tr>\n  <tr>\n   <td>\n    <p>\n     Please contact this person,</p>\n    <p>\n     Details are as per below</p>\n   </td>\n  </tr>\n  <tr>\n   <td>\n    &nbsp;</td>\n  </tr>\n  <tr>\n   <td>\n    <table border=\\"0\\" cellpadding=\\"0\\" cellspacing=\\"0\\" width=\\"100%\\">\n     <tbody>\n      <tr>\n       <td valign=\\"top\\" width=\\"150\\">\n        Name</td>\n       <td valign=\\"top\\" width=\\"10\\">\n        :</td>\n       <td valign=\\"top\\">\n        %username%</td>\n      </tr>\n      <tr>\n       <td valign=\\"top\\" width=\\"150\\">\n        Email</td>\n       <td valign=\\"top\\" width=\\"10\\">\n        :</td>\n       <td valign=\\"top\\">\n        %email%</td>\n      </tr>\n      <tr>\n       <td valign=\\"top\\" width=\\"150\\">\n        Subject</td>\n       <td valign=\\"top\\" width=\\"10\\">\n        :</td>\n       <td valign=\\"top\\">\n        %subjectname%</td>\n      </tr>\n      <tr>\n       <td valign=\\"top\\" width=\\"150\\">\n        Message</td>\n       <td valign=\\"top\\" width=\\"10\\">\n        :</td>\n       <td valign=\\"top\\">\n        %message%</td>\n      </tr>\n      <tr>\n       <td valign=\\"top\\" width=\\"150\\">\n        &nbsp;</td>\n       <td valign=\\"top\\" width=\\"10\\">\n        &nbsp;</td>\n       <td valign=\\"top\\">\n        &nbsp;</td>\n      </tr>\n     </tbody>\n    </table>\n   </td>\n  </tr>\n  <tr>\n   <td>\n    &nbsp;</td>\n  </tr>\n  <tr>\n   <td>\n    Yours sincerely,<br />\n    The %sitename% Team.</td>\n  </tr>\n </tbody>\n</table>\n<p>\n &nbsp;</p>\n', '2013-07-10 00:00:00', '122.170.64.96');

-- --------------------------------------------------------

--
-- Table structure for table `youg_faq`
--

CREATE TABLE IF NOT EXISTS `youg_faq` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `question` varchar(255) NOT NULL,
  `answer` text NOT NULL,
  `status` enum('Enable','Disable') NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `youg_faq`
--

INSERT INTO `youg_faq` (`id`, `question`, `answer`, `status`) VALUES
(3, 'how can i change my profile pic?', 'Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \\''lorem ipsum\\'' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).\n ', 'Enable'),
(5, 'Contrary to popular belief, Lorem Ipsum is not simply random text.?', ' It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections  It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections ', 'Enable'),
(6, 'Contrary to popular belief, Lorem Ipsum is not simply random text.?', 'on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable. The generated Lorem Ipsum is therefore always free from repetition, injected humour, or non-characteristic words etc.\non the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable. The generated Lorem Ipsum is therefore always free from repetition, injected humour, or non-characteristic words etc.', 'Enable'),
(7, 'how can i post comments or complaints', 'for that 1st register then fill form of complaints', 'Disable');

-- --------------------------------------------------------

--
-- Table structure for table `youg_pages`
--

CREATE TABLE IF NOT EXISTS `youg_pages` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_ci DEFAULT NULL,
  `heading` varchar(255) NOT NULL,
  `metakeywords` text,
  `metadescription` text,
  `pagecontent` text,
  `deviceip` varchar(50) DEFAULT NULL,
  `editdate` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `status` enum('Enable','Disable') NOT NULL DEFAULT 'Enable',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `youg_pages`
--

INSERT INTO `youg_pages` (`id`, `title`, `heading`, `metakeywords`, `metadescription`, `pagecontent`, `deviceip`, `editdate`, `status`) VALUES
(1, 'About us', 'About us', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.', 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. ', '<p>\n It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using &#39;Content here, content here&#39;, making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for &#39;lorem ipsum&#39; will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using &#39;Content here, content here&#39;, making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for &#39;lorem ipsum&#39; will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using &#39;Content here, content here&#39;, making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for &#39;lorem ipsum&#39; will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).</p>\n', '122.170.76.112', '2013-06-03 00:00:00', 'Enable'),
(2, 'Term and conditions', 'Term and conditions', 'Neque porro quisquam est qui dolorem ipsum quia dolor sit amet, consectetur, adipisci veli', 'nd more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', '<p>\n Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>\n<p>\n Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>\n<p>\n Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>\n', '122.170.76.112', '2013-06-03 00:00:00', 'Enable'),
(3, 'OVERVIEW', 'OVERVIEW', 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout.', 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout.', 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout.It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout.It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout.', '127.0.1.1', '2013-07-01 06:19:18', 'Enable'),
(4, 'SUBMISSION', 'SUBMISSION', 'Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for ''lorem ipsum'' wi', 'Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for ''lorem ipsum'' wi', 'Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for ''lorem ipsum'' wiMany desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for ''lorem ipsum'' wi', '127.0.1.1', '2013-07-01 04:22:43', 'Enable'),
(5, 'ADDITIONS', 'ADDITIONS', 'Many desktop publishing packages and web page editors now use Lorem Ipsum', 'Many desktop publishing packages and web page editors now use ', 'here are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don''t look even slightly believable. If you are going to usehere are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don''t look even slightly believable. If you are going to use', '128.0.0.1', '2013-07-02 05:17:23', 'Enable'),
(6, 'Contact Us', 'Contact Us', 'of human happiness. No one rejects, ', 'a complete account of the system, and ', '<p>\n But I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account of the system, and expound the actual teachings of the great explorer of the truth, the master-builder of human happiness. No one rejects, dislikes, or avoids pleasure itself, because it is pleasure, but because those who do not know how to pursue pleasure rationally encounter consequences that</p>\n', '122.170.64.96', '2013-07-10 00:00:00', 'Enable'),
(7, 'Learn how to remove complaint', 'Learn how to remove complaint', 'Learn how to remove complaintLearn how to remove complaintLearn how to remove complaint', 'Learn how to remove complaintLearn how to remove complaintLearn how to remove complaintLearn how to remove complaintLearn how to remove complaintLearn how to remove complaint', '<p>\n =&gt;There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don&#39;t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn&#39;t anything embarrassing hidden in the middle of text.</p>\n<p>\n =&gt;All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable. The generated Lorem Ipsum is therefore always free from repetition, injected humour, or non-characteristic words etc.</p>\n', '122.169.19.88', '2013-08-13 00:00:00', 'Enable');

-- --------------------------------------------------------

--
-- Table structure for table `youg_reviews`
--

CREATE TABLE IF NOT EXISTS `youg_reviews` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `companyid` bigint(20) NOT NULL,
  `rate` int(10) NOT NULL,
  `comment` text NOT NULL,
  `status` enum('Enable','Disable') NOT NULL,
  `reviewby` bigint(20) NOT NULL,
  `reviewdate` datetime NOT NULL,
  `reviewip` varchar(51) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=41 ;

--
-- Dumping data for table `youg_reviews`
--

INSERT INTO `youg_reviews` (`id`, `companyid`, `rate`, `comment`, `status`, `reviewby`, `reviewdate`, `reviewip`) VALUES
(1, 2, 4, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\\''s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.123', 'Enable', 1, '2013-06-05 11:15:41', '127.0.0.1'),
(2, 2, 3, 'test review\n\ntest review', 'Enable', 2, '2013-06-06 07:24:21', '122.169.19.139'),
(3, 10, 4, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\\''s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.', 'Enable', 2, '2013-06-06 07:28:59', '122.169.19.139'),
(4, 6, 3, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\\''s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.', 'Enable', 2, '2013-06-06 07:29:06', '122.169.19.139'),
(6, 6, 5, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\\''s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', 'Enable', 7, '2013-06-15 15:26:31', '122.170.72.29'),
(7, 10, 4, 'test review123', 'Enable', 1, '2013-06-15 16:09:57', '122.170.72.29'),
(19, 2, 4, 'or \\''lorem ipsum\\'' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).', 'Enable', 1, '2013-06-25 12:10:12', '122.169.19.201'),
(20, 1, 4, 'or \\''lorem ipsum\\'' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).', 'Enable', 1, '2013-06-25 01:45:55', '122.169.19.201'),
(21, 1, 5, 'Alingsås Alingsås Alingsås Alingsåsv ag  Alingsås Alingsås Alingsås Alingsås  vAlingsåsAlingsås', 'Enable', 3, '2013-06-25 02:10:31', '122.169.19.201'),
(22, 1, 4, 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \\''Content here, content here\\'', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \\''lorem ipsum\\'' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).', 'Enable', 1, '2013-06-25 08:18:40', '122.179.187.191'),
(23, 1, 4, 'Content here, content here\\'', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \\''lorem ipsum\\'' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).', 'Enable', 1, '2013-06-25 08:29:49', '122.179.187.191'),
(24, 2, 3, 'Content here, content here\\'', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \\''lorem ipsum\\'' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).', 'Enable', 1, '2013-06-25 18:58:49', '122.179.187.191'),
(25, 1, 4, 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \\''Content here, content here\\'', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \\''lorem ipsum\\'' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).', 'Disable', 1, '2013-06-25 19:26:40', '122.179.187.191'),
(26, 2, 4, 'test add review after login...', 'Enable', 9, '2013-06-27 16:30:45', '122.169.16.211'),
(27, 2, 4, 'test reviw add one mr time for one co by same user', 'Enable', 9, '2013-06-27 16:50:11', '122.169.16.211'),
(29, 1, 3, 'test one more..................\nhijf 798090', 'Disable', 9, '2013-06-27 17:06:11', '122.169.16.211'),
(31, 7, 2, 'i dont like  this one', 'Enable', 9, '2013-06-28 12:44:55', '122.179.187.20'),
(32, 8, 1, 'test review of my company', 'Enable', 9, '2013-06-28 16:00:28', '122.179.187.20'),
(33, 10, 1, 'Resolved in Reported Damages Resolved in Reported DamagesResolved in Reported DamagesResolved in Reported DamagesResolved in Reported DamagesResolved in Reported DamagesResolved in Reported DamagesResolved in Reported DamagesResolved in Reported DamagesResolved in Reported DamagesResolved in Reported DamagesResolved in Reported DamagesResolved in Reported Damages<br />\n<br />\nResolved in Reported Damages<br />\nResolved in Reported DamagesResolved in Reported DamagesResolved in Reported DamagesResolved in Reported DamagesResolved in Reported DamagesResolved in Reported DamagesResolved in Reported DamagesResolved in Reported DamagesResolved in Reported DamagesResolved in Reported Damages', 'Enable', 9, '2013-06-29 12:05:42', '122.170.86.89'),
(34, 10, 1, 'hello', 'Enable', 3, '2013-06-29 15:18:23', '122.170.86.89'),
(35, 12, 1, 'dsdds', 'Enable', 3, '2013-06-29 15:23:12', '122.170.86.89'),
(36, 3, 4, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\\''s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\\''s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', 'Enable', 1, '2013-06-29 17:27:57', '122.170.86.89'),
(37, 13, 3, 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \\''Content here, content here\\'', making it look like readable English.', 'Enable', 1, '2013-07-01 12:15:40', '122.179.168.103'),
(38, 9, 4, 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \\''Content here, content here\\'', making it look like readable English.It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \\''Content here, content here\\'', making it look like readable English.', 'Enable', 1, '2013-07-01 12:22:00', '122.179.168.103'),
(39, 8, 3, 'hello', 'Enable', 1, '2013-07-12 12:28:15', '122.170.74.80'),
(40, 25, 3, 'amazing', 'Enable', 13, '2013-08-05 16:38:47', '173.65.30.199');

-- --------------------------------------------------------

--
-- Table structure for table `youg_searches`
--

CREATE TABLE IF NOT EXISTS `youg_searches` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `keyword` varchar(255) NOT NULL,
  `status` enum('Enable','Disable') NOT NULL DEFAULT 'Enable',
  `searchesip` varchar(50) NOT NULL,
  `searchesdate` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Dumping data for table `youg_searches`
--

INSERT INTO `youg_searches` (`id`, `keyword`, `status`, `searchesip`, `searchesdate`) VALUES
(1, 'toms', 'Enable', '122.170.79.184', '2013-05-27 23:45:46'),
(2, 'unknown', 'Enable', '122.170.79.184', '2013-05-27 23:46:45'),
(3, 'distribution', 'Enable', '122.170.72.19', '2013-06-01 01:55:53'),
(4, 'star', 'Enable', '122.170.72.19', '2013-06-01 01:56:14'),
(5, 'line', 'Enable', '122.170.72.19', '2013-06-01 01:56:32'),
(6, 'complaint', 'Enable', '122.170.72.19', '2013-06-01 01:56:59'),
(7, 'Long established fact', 'Disable', '122.170.72.19', '2013-06-01 01:57:26'),
(8, 'dummy', 'Enable', '122.170.72.19', '2013-06-01 01:57:45'),
(9, 'damage', 'Enable', '122.170.72.19', '2013-06-01 01:58:05'),
(10, 'text', 'Enable', '122.170.72.19', '2013-06-01 01:58:24'),
(11, 'information', 'Enable', '122.170.72.19', '2013-06-01 02:01:18'),
(12, 'my', 'Enable', '122.169.21.199', '2013-06-04 04:04:32');

-- --------------------------------------------------------

--
-- Table structure for table `youg_sem`
--

CREATE TABLE IF NOT EXISTS `youg_sem` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) CHARACTER SET latin1 NOT NULL,
  `url` varchar(255) CHARACTER SET latin1 NOT NULL,
  `mainimg` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `thumbimg` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `status` enum('Enable','Disable') CHARACTER SET latin1 NOT NULL DEFAULT 'Enable',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `youg_sem`
--

INSERT INTO `youg_sem` (`id`, `title`, `url`, `mainimg`, `thumbimg`, `status`) VALUES
(1, 'Facebook', 'http://www.facebook.com', 'ade2c15ab85aef450fb2f6e53e8cb825.png', 'ade2c15ab85aef450fb2f6e53e8cb825.png', 'Enable'),
(2, 'Twitter', 'http://www.twitter.com', '51e28dd5af6d2bb51b518b47ae717f1a.png', '51e28dd5af6d2bb51b518b47ae717f1a.png', 'Enable'),
(3, 'Linkedin', 'http://www.linkedin.com', 'ab5b4de4c8fa16f822635c942aafdfb5.jpg', 'ab5b4de4c8fa16f822635c942aafdfb5.jpg', 'Disable'),
(4, 'Google', 'http://www.google.com', 'a7f9c768874a247ae8c6ba3c4e3f5d7e.jpg', 'a7f9c768874a247ae8c6ba3c4e3f5d7e.jpg', 'Enable');

-- --------------------------------------------------------

--
-- Table structure for table `youg_seo`
--

CREATE TABLE IF NOT EXISTS `youg_seo` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `fieldname` varchar(255) CHARACTER SET latin1 NOT NULL,
  `value` text CHARACTER SET latin1,
  `status` enum('Enable','Disable') CHARACTER SET latin1 NOT NULL DEFAULT 'Enable',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `youg_seo`
--

INSERT INTO `youg_seo` (`id`, `fieldname`, `value`, `status`) VALUES
(1, 'Google Analytic', 'Google Analytic', 'Enable'),
(2, 'Google Webmaster', 'Google Webmaster', 'Enable'),
(4, 'General Meta Tag Keywords', 'Keywords - Lorem Ipsum is simply dummy text of the printing and typesetting industry.', 'Enable'),
(5, 'General Meta Tag Description', 'Description - Lorem Ipsum is simply dummy text of the printing and typesetting industry.', 'Enable');

-- --------------------------------------------------------

--
-- Table structure for table `youg_setting`
--

CREATE TABLE IF NOT EXISTS `youg_setting` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `fieldname` varchar(255) CHARACTER SET latin1 NOT NULL,
  `value` text CHARACTER SET latin1,
  `status` enum('Enable','Disable') CHARACTER SET latin1 NOT NULL DEFAULT 'Enable',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=18 ;

--
-- Dumping data for table `youg_setting`
--

INSERT INTO `youg_setting` (`id`, `fieldname`, `value`, `status`) VALUES
(1, 'Site Name', 'YouGotRated', 'Enable'),
(2, 'Site URL', 'http://localhost/yougotrated/', 'Enable'),
(3, 'Site Owner', 'Site Owner', 'Enable'),
(4, 'Address', 'Site Address', 'Enable'),
(5, 'E-Mail', 'pranay@mxicoders.com', 'Enable'),
(6, 'Telephone', '+ 123 456 7890', 'Enable'),
(7, 'Admin Username', 'admin', 'Enable'),
(8, 'Admin Password', 'mxi123', 'Enable'),
(9, 'Elite Membership Amount', '10', 'Enable'),
(10, 'Comment Cancel Amount', '2', 'Enable'),
(11, 'PayPal Mode', 'sandbox', 'Enable'),
(12, 'PayPal ID', 'yritpartner@mxicoders.com', 'Enable'),
(13, 'API User Name', 'sdk-three_api1.sdk.com', 'Enable'),
(14, 'API Password', 'QFZCWN5HZM8VBG7Q', 'Enable'),
(15, 'API Signature', 'A.d9eRKfd1yVkRrtmMfCFLTqa6M9AyodL0SJkhYztxUi8W9pCXF6.4NI', 'Enable'),
(16, 'Currency Code', 'USD', 'Enable'),
(17, 'Verified Logo', 'da67c5af964bcbfefbebae4f351f35f1.png', 'Enable');

-- --------------------------------------------------------

--
-- Table structure for table `youg_settinghome`
--

CREATE TABLE IF NOT EXISTS `youg_settinghome` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `fieldname` varchar(255) CHARACTER SET latin1 NOT NULL,
  `value` text CHARACTER SET latin1,
  `status` enum('Enable','Disable') CHARACTER SET latin1 NOT NULL DEFAULT 'Enable',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=89 ;

--
-- Dumping data for table `youg_settinghome`
--

INSERT INTO `youg_settinghome` (`id`, `fieldname`, `value`, `status`) VALUES
(1, 'Menu1', 'Home', 'Enable'),
(2, 'Menu2', 'Complaints', 'Enable'),
(3, 'Menu3', 'Business Review', 'Enable'),
(4, 'Menu4', 'Business Directory', 'Enable'),
(5, 'Menu5', 'News Releases', 'Enable'),
(6, 'Menu6', 'Business Solution', 'Enable'),
(8, 'Tag Line', 'Have a Complaint? Report It and Get It Resolved!', 'Enable'),
(9, 'Video URL', 'http://www.youtube.com/watch?v=bWQjU1IZkVA', 'Enable'),
(7, 'menu7', 'Coupons', 'Enable');

-- --------------------------------------------------------

--
-- Table structure for table `youg_solutions`
--

CREATE TABLE IF NOT EXISTS `youg_solutions` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `detail` text NOT NULL,
  `status` enum('Enable','Disable') NOT NULL DEFAULT 'Enable',
  `insertdate` date NOT NULL,
  `insertip` varchar(51) NOT NULL,
  `editdate` date NOT NULL,
  `editip` varchar(51) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `youg_solutions`
--

INSERT INTO `youg_solutions` (`id`, `title`, `detail`, `status`, `insertdate`, `insertip`, `editdate`, `editip`) VALUES
(1, 'My solution', '<p>\n Contrary to popular belief, Lorem Ipsum is not simply random text.It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of &quot;de Finibus Bonorum et Malorum&quot; (The Extremes of Good and Evil) by Cicero, written in 45 BC. This&nbsp; book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem&nbsp; Ipsum, &quot;Lorem ipsum dolor sit amet..&quot;, comes from a line in section</p>\n<p>\n <img alt=\\"\\" src=\\"/userfiles/image/business.jpg\\"  250px; height: 162px;\\" /></p>\n', 'Enable', '2013-05-28', '127.0.0.1', '2013-06-01', '122.170.72.19'),
(2, 'Mysolution2', '<p>\r\n	<strong>Lorem Ipsum</strong> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of <strong>Lorem Ipsum.</strong></p>\r\n<p>\r\n	<strong><img alt="" src="/userfiles/image/business2.png" style="width: 500px; height: 500px;" /></strong></p>\r\n', 'Enable', '2013-05-28', '122.170.79.184', '2013-06-13', '122.170.77.224'),
(3, 'Business solution 3', '<p>\r\n	<strong>Lorem Ipsum</strong> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>\r\n<p 0px="" color:="" font-family:="" font-size:="" itemprop="articleBody" line-height:="" new="" p="" style="text-align: justify;" times="">\r\n	<span style="color:#800000;"><span style="background-color:#00ffff;"><u><img alt="" src="/userfiles/image/pic1.jpg" style="width: 602px; height: 452px;" /></u></span></span></p>\r\n<p 0px="" color:="" font-family:="" font-size:="" itemprop="articleBody" line-height:="" new="" p="" style="text-align: center;" times="">\r\n	&nbsp;</p>\r\n<p 0px="" color:="" font-family:="" font-size:="" itemprop="articleBody" line-height:="" new="" p="" times="">\r\n	&nbsp;</p>\r\n<p 0px="" color:="" font-family:="" font-size:="" itemprop="articleBody" line-height:="" new="" p="" times="">\r\n	&nbsp;</p>\r\n<p 0px="" color:="" font-family:="" font-size:="" itemprop="articleBody" line-height:="" new="" p="" times="">\r\n	&nbsp;</p>\r\n<p 0px="" color:="" font-family:="" font-size:="" itemprop="articleBody" line-height:="" new="" p="" times="">\r\n	&nbsp;</p>\r\n<p 0px="" color:="" font-family:="" font-size:="" itemprop="articleBody" line-height:="" new="" p="" times="">\r\n	&nbsp;</p>\r\n<blockquote>\r\n	<p 0px="" color:="" font-family:="" font-size:="" itemprop="articleBody" line-height:="" new="" p="" times="">\r\n		&nbsp;</p>\r\n</blockquote>\r\n<p>\r\n	&nbsp;</p>\r\n', 'Enable', '2013-06-04', '122.169.21.199', '2013-06-28', '122.179.187.20');

-- --------------------------------------------------------

--
-- Table structure for table `youg_user`
--

CREATE TABLE IF NOT EXISTS `youg_user` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `uniqueid` varchar(50) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `gender` enum('Male','Female') NOT NULL DEFAULT 'Male',
  `avatarthum` varchar(255) NOT NULL,
  `avatarbig` varchar(255) NOT NULL,
  `terms` enum('Yes','No') NOT NULL DEFAULT 'Yes',
  `status` enum('Enable','Disable') NOT NULL DEFAULT 'Enable',
  `registerip` varchar(50) NOT NULL,
  `registerdate` datetime NOT NULL,
  `editip` varchar(50) NOT NULL,
  `editdate` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=14 ;

--
-- Dumping data for table `youg_user`
--

INSERT INTO `youg_user` (`id`, `uniqueid`, `firstname`, `lastname`, `email`, `password`, `gender`, `avatarthum`, `avatarbig`, `terms`, `status`, `registerip`, `registerdate`, `editip`, `editdate`) VALUES
(1, '519db2c98fbbd', 'Mayuri', 'Kava', 'mayuri@mxicoders.com', 'mxi123', 'Female', '4e7a512163ac687b5a0ca9f7afab75cc.png', '4e7a512163ac687b5a0ca9f7afab75cc.png', 'Yes', 'Enable', '122.179.172.133', '2013-05-23 01:10:17', '122.170.86.89', '2013-06-29 07:32:55'),
(2, '519db5129a473', 'Mali', 'Pitroda', 'mayureekava@gmail.com', 'mxi123', 'Female', 'f1496a930a1fd7e0531251c4162887a9.jpeg', 'f1496a930a1fd7e0531251c4162887a9.jpeg', 'Yes', 'Enable', '122.179.172.133', '2013-05-23 01:20:02', '122.170.86.89', '2013-06-29 02:16:19'),
(3, '51ad7044845c2', 'Pranay', 'Joshi', 'pranay@mxicoders.com', '', 'Male', '06b87380f0960d4f1b5a23302b911fae.png', '06b87380f0960d4f1b5a23302b911fae.png', 'Yes', 'Enable', '122.169.21.199', '2013-06-03 23:42:44', '122.169.19.88', '2013-08-13 08:00:28'),
(6, '', 'New', 'User', 'user@mxicoder.com', 'mxi123', 'Male', '65cb50f9ff0be961209032466a7e1f2d.jpg', '65cb50f9ff0be961209032466a7e1f2d.jpg', 'Yes', 'Enable', '122.179.185.67', '2013-06-12 05:44:23', '122.179.187.20', '2013-06-28 03:44:32'),
(7, '51b95752ee5d8', 'Minakshi', 'Panchal', 'mayurikava@yahoo.co.in', 'mxi123', 'Female', '1213713d8641c7fb946b77c52f771812.jpg', '1213713d8641c7fb946b77c52f771812.jpg', 'Yes', 'Enable', '122.170.77.224', '2013-06-13 00:23:31', '122.170.77.224', '2013-06-13 00:00:00'),
(9, '51cae4682132f', 'Vidhi', 'Tester', 'vidhi@mxicoders.com', 'mxi123', 'Female', '607051751604f858de3981d46c2db81c.jpg', '607051751604f858de3981d46c2db81c.jpg', 'Yes', 'Enable', '122.170.72.158', '2013-06-26 07:54:00', '122.170.86.89', '2013-06-29 05:58:04'),
(10, '51ce6c00a54ff', 'Pranay', 'Joshi', 'pranay9803@gmail.com', 'mxi123', 'Male', 'd96a8f2ace9e2f542dfe5382cc3ab2e8.png', 'd96a8f2ace9e2f542dfe5382cc3ab2e8.png', 'Yes', 'Enable', '122.170.86.89', '2013-06-29 00:09:20', '122.170.86.89', '2013-06-29 00:25:27'),
(11, '', 'Hiral', 'User', 'hiral@mxicoders.com', 'mxi123', 'Male', '8d61ca132953dfa9f3d7774149659634.jpg', '8d61ca132953dfa9f3d7774149659634.jpg', 'Yes', 'Enable', '122.170.86.89', '2013-06-29 05:56:49', '122.169.16.100', '2013-08-08 08:54:51'),
(12, '51e53092b7d77', 'joshin', 'gomez', 'gomez@mxicoders.com', 'mxi123', 'Male', '1b9589e8dc79dbda789a1312e3d38853.png', '1b9589e8dc79dbda789a1312e3d38853.png', 'Yes', 'Enable', '122.170.75.17', '2013-07-16 06:37:54', '122.170.75.17', '2013-07-16 06:40:16'),
(13, '51ff74e43de8d', 'Jemel', 'Azank', 'agapediamonds@gmail.com', 'ftfbfc5b', 'Male', 'add89b69d9116a66f4e75afd7c6ea874.JPG', 'add89b69d9116a66f4e75afd7c6ea874.JPG', 'Yes', 'Enable', '173.65.30.199', '2013-08-05 04:48:27', '173.65.30.199', '2013-08-05 04:48:41');

-- --------------------------------------------------------

--
-- Table structure for table `youg_votes`
--

CREATE TABLE IF NOT EXISTS `youg_votes` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `reviewid` bigint(20) NOT NULL,
  `vote` enum('helpful','funny','agree','disagree') NOT NULL,
  `votedate` datetime NOT NULL,
  `voteip` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=79 ;

--
-- Dumping data for table `youg_votes`
--

INSERT INTO `youg_votes` (`id`, `reviewid`, `vote`, `votedate`, `voteip`) VALUES
(12, 3, 'agree', '2013-06-14 23:50:36', '122.170.72.29'),
(20, 3, 'helpful', '2013-06-15 06:35:43', '122.170.72.29'),
(21, 2, 'helpful', '2013-06-15 06:35:49', '122.170.72.29'),
(22, 2, 'agree', '2013-06-15 06:35:56', '122.170.72.29'),
(23, 5, 'agree', '2013-06-17 00:15:08', '122.170.75.115'),
(24, 1, 'helpful', '2013-06-17 06:44:04', '122.170.75.115'),
(26, 1, 'helpful', '2013-06-18 05:06:56', '122.179.185.171'),
(27, 1, 'funny', '2013-06-18 05:07:04', '122.179.185.171'),
(30, 7, 'funny', '2013-06-25 05:30:52', '122.179.187.191'),
(31, 7, 'helpful', '2013-06-25 05:30:56', '122.179.187.191'),
(46, 7, 'disagree', '2013-06-25 05:34:35', '122.179.187.191'),
(68, 1, 'helpful', '2013-06-27 04:36:02', '122.169.16.211'),
(69, 26, 'agree', '2013-06-27 06:03:27', '122.169.16.211'),
(75, 1, 'disagree', '2013-06-28 05:17:40', '122.179.187.20'),
(76, 31, 'funny', '2013-06-28 05:27:26', '122.179.187.20'),
(77, 31, 'helpful', '2013-06-29 00:52:16', '122.170.86.89'),
(78, 31, 'funny', '2013-06-29 00:52:18', '122.170.86.89');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
