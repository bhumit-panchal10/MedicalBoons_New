-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Oct 07, 2025 at 11:07 AM
-- Server version: 5.7.23-23
-- PHP Version: 8.1.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `medic6zh_Medical_Boons`
--
CREATE DATABASE IF NOT EXISTS `medic6zh_Medical_Boons` DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;
USE `medic6zh_Medical_Boons`;

-- --------------------------------------------------------

--
-- Table structure for table `associated_members`
--

CREATE TABLE `associated_members` (
  `id` int(11) NOT NULL,
  `service_id` int(11) NOT NULL DEFAULT '0',
  `sub_service_id` int(11) NOT NULL DEFAULT '0',
  `dr_name` varchar(255) DEFAULT NULL,
  `degree` varchar(255) DEFAULT NULL,
  `address_1` varchar(255) DEFAULT NULL,
  `address_2` varchar(255) DEFAULT NULL,
  `about_dr_or_clinic` varchar(255) DEFAULT NULL,
  `iStatus` int(11) NOT NULL DEFAULT '1',
  `isDelete` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `strIP` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `associated_members`
--

INSERT INTO `associated_members` (`id`, `service_id`, `sub_service_id`, `dr_name`, `degree`, `address_1`, `address_2`, `about_dr_or_clinic`, `iStatus`, `isDelete`, `created_at`, `updated_at`, `strIP`) VALUES
(9, 9, 9, 'Dr Dinesh Patel', 'M.Ch. Urology', 'Vadaj,  Maninagar', 'Bopal, Naroda, Kalol', 'DEVASYA Kidney & Multispeciality Hospital', 1, 0, '2025-05-24 09:26:11', '2025-05-24 09:27:51', '103.1.100.226'),
(10, 9, 9, 'Dr Hardik Yadav', 'M.Ch. Urology', 'Gota', '-', 'EXCEL Hospital', 1, 0, '2025-05-24 09:27:09', '2025-05-24 09:27:09', '103.1.100.226'),
(11, 9, 9, 'Dr Vinit Ajitsariya', 'M.Ch. Urology', 'Gota', '-', 'EXCEL Hospital', 1, 0, '2025-05-24 09:27:39', '2025-05-24 09:27:39', '103.1.100.226');

-- --------------------------------------------------------

--
-- Table structure for table `banner`
--

CREATE TABLE `banner` (
  `id` int(11) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `banner`
--

INSERT INTO `banner` (`id`, `image`, `title`, `created_at`, `updated_at`) VALUES
(5, '1758269935_19092025134855.webp', 'testing11', '2025-09-19 06:19:16', '2025-09-19 08:18:55'),
(6, '1758269789_19092025134629.jpg', 'Medical Boons Test', '2025-09-19 06:45:42', '2025-09-19 08:16:29');

-- --------------------------------------------------------

--
-- Table structure for table `blog`
--

CREATE TABLE `blog` (
  `blogId` int(11) NOT NULL,
  `strTitle` varchar(100) DEFAULT NULL,
  `strSlug` varchar(100) DEFAULT NULL,
  `strDescription` text,
  `strPhoto` varchar(100) DEFAULT NULL,
  `metaTitle` varchar(100) DEFAULT NULL,
  `metaKeyword` varchar(100) DEFAULT NULL,
  `metaDescription` text,
  `head` varchar(100) DEFAULT NULL,
  `body` varchar(100) DEFAULT NULL,
  `iStatus` int(11) DEFAULT '1',
  `isDelete` int(11) DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `strIP` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` text NOT NULL,
  `expiration` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `card_member`
--

CREATE TABLE `card_member` (
  `card_member_id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `Age` int(11) DEFAULT '0',
  `plan_id` int(11) DEFAULT '0',
  `member_id` int(11) DEFAULT '0',
  `iStatus` int(11) DEFAULT '1',
  `isDelete` int(11) DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `strIP` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `card_payment`
--

CREATE TABLE `card_payment` (
  `id` int(11) NOT NULL,
  `order_id` varchar(100) DEFAULT NULL,
  `oid` int(11) NOT NULL DEFAULT '0',
  `razorpay_payment_id` varchar(100) DEFAULT NULL,
  `razorpay_order_id` varchar(100) DEFAULT NULL,
  `razorpay_signature` varchar(100) DEFAULT NULL,
  `receipt` varchar(100) DEFAULT NULL,
  `amount` int(11) DEFAULT NULL,
  `currency` varchar(100) DEFAULT NULL,
  `status` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `iPaymentType` int(11) DEFAULT '0',
  `Remarks` varchar(100) DEFAULT NULL,
  `json` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `card_payment`
--

INSERT INTO `card_payment` (`id`, `order_id`, `oid`, `razorpay_payment_id`, `razorpay_order_id`, `razorpay_signature`, `receipt`, `amount`, `currency`, `status`, `created_at`, `updated_at`, `iPaymentType`, `Remarks`, `json`) VALUES
(1, 'order_RHqdfsKB3Qwsd2', 1, 'pay_RHqe8ANH9XVWUq', 'order_RHqdfsKB3Qwsd2', '7ea0b714eddf681bbb2a630c5e56137bf195e434797343310fad605209cd334e', '1-15092025161135', 849, 'INR', 'Success', NULL, '2025-09-15 10:42:19', 1, 'Online Payment', NULL),
(2, 'order_RIBze8dZGhkqdY', 2, NULL, NULL, NULL, '2-16092025130457', 849, 'INR', NULL, NULL, NULL, 0, NULL, NULL),
(3, 'order_RIdpd4iIyvVCDn', 4, 'pay_RIdqRCG82YUJmW', 'order_RIdpd4iIyvVCDn', 'fdd33ee0710a91cdb8973632c82d5514277c29b0881e6a467f1748cd419eae70', '4-17092025161852', 849, 'INR', 'Success', NULL, '2025-09-17 10:49:56', 1, 'Online Payment', NULL),
(4, 'order_RIduJBaYR3ajdo', 5, 'pay_RIduuZBDDHZxE5', 'order_RIduJBaYR3ajdo', '07c410330652da89630593573aa690551735f430151e496a87220e5a7ad37959', '5-17092025162319', 699, 'INR', 'Success', NULL, '2025-09-17 10:54:10', 1, 'Online Payment', NULL),
(5, 'order_RIgf0sVwobSO6Z', 6, 'pay_RIgffwpABwUist', 'order_RIgf0sVwobSO6Z', '4bce4173768cff9f41c3a8b57276180ceae9c4db23fa00a47edfd2b50e7b620a', '6-17092025190454', 999, 'INR', 'Success', NULL, '2025-09-17 13:35:49', 1, 'Online Payment', NULL),
(6, 'order_RIgmaDT37b1Ipi', 1, 'pay_RIgnQKaYzmikT5', 'order_RIgmaDT37b1Ipi', '6a1f21a2ad44d93842d0a8b71de931a779ac075abbdea9567264ecdc5e8c24cb', '1-17092025191205', 999, 'INR', 'Success', NULL, '2025-09-17 13:43:10', 1, 'Online Payment', NULL),
(7, 'order_RIgufF1VdrC7dC', 2, 'pay_RIgvGHItFgikYI', 'order_RIgufF1VdrC7dC', 'f3889ccac1427912896e52f9d1a0330f968cc887cbfed1abbe5135870a9d54ff', '2-17092025191943', 699, 'INR', 'Success', NULL, '2025-09-17 13:50:35', 1, 'Online Payment', NULL),
(8, 'order_RJMR8JjtpzJ6g9', 3, NULL, NULL, NULL, '3-19092025115654', 999, 'INR', NULL, NULL, NULL, 0, NULL, NULL),
(9, 'order_RJMqhoNG5EUbGO', 4, NULL, NULL, NULL, '4-19092025122106', 699, 'INR', NULL, NULL, NULL, 0, NULL, NULL),
(10, 'order_RJN3wbkqMgAZj1', 5, NULL, NULL, NULL, '5-19092025123338', 999, 'INR', NULL, NULL, NULL, 0, NULL, NULL),
(11, 'order_RJPwFihyMB5Kfk', 6, NULL, NULL, NULL, '6-19092025152226', 849, 'INR', NULL, NULL, NULL, 0, NULL, NULL),
(12, 'order_RLKbP2I2UbwatF', 7, NULL, NULL, NULL, '7-24092025112714', 999, 'INR', NULL, NULL, NULL, 0, NULL, NULL),
(13, 'order_RLRK5z7esKAfZW', 8, 'pay_RLRM0w2vky55DV', 'order_RLRK5z7esKAfZW', 'c40f770f8ba03dc90deff2f158fe8c6ce5682597626d5166f5f7df35beeabe2e', '8-24092025180142', 1199, 'INR', 'Success', NULL, '2025-09-24 12:33:50', 1, 'Online Payment', NULL),
(14, 'order_RLRVdyiLMNfkx6', 9, NULL, NULL, NULL, '9-24092025181238', 699, 'INR', NULL, NULL, NULL, 0, NULL, NULL),
(15, 'order_RLoh8bO4DHnegz', 12, NULL, NULL, NULL, '12-25092025165328', 849, 'INR', NULL, NULL, NULL, 0, NULL, NULL),
(16, 'pay_RLoi7YHCHN8Ust', 12, 'pay_RLoi7YHCHN8Ust', 'order_RLoh8bO4DHnegz', '9b4945c482263049094ad3f092888935b1b715f352010a5d75a27e5c600cfd2b', '12-25092025165442', 849, 'INR', 'Success', NULL, NULL, 1, 'Online Payment', '{\"paymentId\":\"pay_RLoi7YHCHN8Ust\",\"orderId\":\"order_RLoh8bO4DHnegz\",\"signature\":\"9b4945c482263049094ad3f092888935b1b715f352010a5d75a27e5c600cfd2b\",\"data\":{\"razorpay_signature\":\"9b4945c482263049094ad3f092888935b1b715f352010a5d75a27e5c600cfd2b\",\"razorpay_order_id\":\"order_RLoh8bO4DHnegz\",\"razorpay_payment_id\":\"pay_RLoi7YHCHN8Ust\"}}'),
(17, 'order_RLqWYPrrbTlOBg', 13, NULL, NULL, NULL, '13-25092025184050', 1199, 'INR', NULL, NULL, NULL, 0, NULL, NULL),
(18, 'pay_RLqWyBuZTRM70w', 13, 'pay_RLqWyBuZTRM70w', 'order_RLqWYPrrbTlOBg', '291bef7b2d6279d050137af92afdb86fc3d884fcd4aaa9cc5090043cc085e91e', '13-25092025184135', 1199, 'INR', 'Success', NULL, NULL, 1, 'Online Payment', '{\"paymentId\":\"pay_RLqWyBuZTRM70w\",\"orderId\":\"order_RLqWYPrrbTlOBg\",\"signature\":\"291bef7b2d6279d050137af92afdb86fc3d884fcd4aaa9cc5090043cc085e91e\",\"data\":{\"razorpay_signature\":\"291bef7b2d6279d050137af92afdb86fc3d884fcd4aaa9cc5090043cc085e91e\",\"razorpay_order_id\":\"order_RLqWYPrrbTlOBg\",\"razorpay_payment_id\":\"pay_RLqWyBuZTRM70w\"}}'),
(19, 'order_RLtGf0tNI8kGLE', 14, NULL, NULL, NULL, '14-25092025212151', 1149, 'INR', NULL, NULL, NULL, 0, NULL, NULL),
(20, 'order_RM6p8WjoTG4hYs', 15, NULL, NULL, NULL, '15-26092025103731', 699, 'INR', NULL, NULL, NULL, 0, NULL, NULL),
(21, 'pay_RM6qOSAPOfucMW', 15, 'pay_RM6qOSAPOfucMW', 'order_RM6p8WjoTG4hYs', 'caefcc3d55f09fd51d85aa3e7ab83f2be4822c25815819dd989c90f9e0817feb', '15-26092025103901', 699, 'INR', 'Success', NULL, NULL, 1, 'Online Payment', '{\"paymentId\":\"pay_RM6qOSAPOfucMW\",\"orderId\":\"order_RM6p8WjoTG4hYs\",\"signature\":\"caefcc3d55f09fd51d85aa3e7ab83f2be4822c25815819dd989c90f9e0817feb\",\"data\":{\"razorpay_signature\":\"caefcc3d55f09fd51d85aa3e7ab83f2be4822c25815819dd989c90f9e0817feb\",\"razorpay_order_id\":\"order_RM6p8WjoTG4hYs\",\"razorpay_payment_id\":\"pay_RM6qOSAPOfucMW\"}}'),
(22, 'order_RM6wzTfyKPbcJz', 16, NULL, NULL, NULL, '16-26092025104458', 999, 'INR', NULL, NULL, NULL, 0, NULL, NULL),
(23, 'pay_RM6yDRs1PhPhyG', 16, 'pay_RM6yDRs1PhPhyG', 'order_RM6wzTfyKPbcJz', 'c3abdff09e3b74508ace4f10f5294c6625568c8473ad02deb881a25c31958f04', '16-26092025104640', 999, 'INR', 'Success', NULL, NULL, 1, 'Online Payment', '{\"paymentId\":\"pay_RM6yDRs1PhPhyG\",\"orderId\":\"order_RM6wzTfyKPbcJz\",\"signature\":\"c3abdff09e3b74508ace4f10f5294c6625568c8473ad02deb881a25c31958f04\",\"data\":{\"razorpay_signature\":\"c3abdff09e3b74508ace4f10f5294c6625568c8473ad02deb881a25c31958f04\",\"razorpay_order_id\":\"order_RM6wzTfyKPbcJz\",\"razorpay_payment_id\":\"pay_RM6yDRs1PhPhyG\"}}'),
(24, 'order_RM7flwbzHTqaLd', 17, NULL, NULL, NULL, '17-26092025112721', 1149, 'INR', NULL, NULL, NULL, 0, NULL, NULL),
(25, 'pay_RM7gEC3fiJ8oO3', 17, 'pay_RM7gEC3fiJ8oO3', 'order_RM7flwbzHTqaLd', '3265be976029e589282fab0b76643c753bf50d6f2788315317ff21c388a9134f', '17-26092025112807', 1149, 'INR', 'Success', NULL, NULL, 1, 'Online Payment', '{\"paymentId\":\"pay_RM7gEC3fiJ8oO3\",\"orderId\":\"order_RM7flwbzHTqaLd\",\"signature\":\"3265be976029e589282fab0b76643c753bf50d6f2788315317ff21c388a9134f\",\"data\":{\"razorpay_signature\":\"3265be976029e589282fab0b76643c753bf50d6f2788315317ff21c388a9134f\",\"razorpay_order_id\":\"order_RM7flwbzHTqaLd\",\"razorpay_payment_id\":\"pay_RM7gEC3fiJ8oO3\"}}'),
(26, 'order_RM833kzGzqCQLo', 18, 'pay_RM83r8urMkqLQw', 'order_RM833kzGzqCQLo', '650af5f6823231649bb4c5a49c16219408803e1259c3c8728f8ab957eb823285', '18-26092025114924', 549, 'INR', 'Success', NULL, '2025-09-26 06:20:28', 1, 'Online Payment', NULL),
(27, 'order_RM9Se1wkSVQpmM', 19, NULL, NULL, NULL, '19-26092025131218', 699, 'INR', NULL, NULL, NULL, 0, NULL, NULL),
(28, 'order_RM9TtBzWmQr7Mc', 19, NULL, NULL, NULL, '19-26092025131330', 699, 'INR', NULL, NULL, NULL, 0, NULL, NULL),
(29, 'order_RM9lJjIb38Zt0M', 20, 'pay_RM9mARtus2JKDw', 'order_RM9lJjIb38Zt0M', '02b0ed04d61a9f000c23e3697ce47a83d6a9cbea35788b2aab62c6c339a1f204', '20-26092025133000', 399, 'INR', 'Success', NULL, '2025-09-26 08:01:10', 1, 'Online Payment', NULL),
(30, 'order_RM9o12SxDtOevV', 21, 'pay_RM9oIpvGZ5hVCB', 'order_RM9o12SxDtOevV', '9105a5565af09174f03eb33d044f56d6716f28c35831debe825236c647e7396e', '21-26092025133233', 399, 'INR', 'Success', NULL, '2025-09-26 08:03:07', 1, 'Online Payment', NULL),
(31, 'order_RMAYTtYZZddEpe', 22, 'pay_RMAYnEFuGSIRpy', 'order_RMAYTtYZZddEpe', 'a6b7b930d59224fc924b523ca191e8f29eb5cd7deb972f60d022f0e628cb4e37', '22-26092025141632', 399, 'INR', 'Success', NULL, '2025-09-26 08:47:07', 1, 'Online Payment', NULL),
(32, 'order_RMBBOfzbRKjkZ2', 24, 'pay_RMBC6Lx7E5szf4', 'order_RMBBOfzbRKjkZ2', '5d146e5bfab4b44c0c5e918773d6f8e5c28fd04d0c6a09e322d48f03f2048bac', '24-26092025145322', 399, 'INR', 'Success', NULL, '2025-09-26 09:24:19', 1, 'Online Payment', NULL),
(33, 'order_RMBgQgC9VZRFfi', 27, NULL, NULL, NULL, '27-26092025152245', 1149, 'INR', NULL, NULL, NULL, 0, NULL, NULL),
(34, NULL, 27, NULL, NULL, NULL, '27-26092025154003', 1149, 'INR', 'Fail', NULL, NULL, 1, 'Online Payment', '{\"message\":\"undefined\",\"error\":{\"reason\":\"payment_error\",\"metadata\":{},\"code\":\"BAD_REQUEST_ERROR\",\"contact\":null,\"description\":\"undefined\",\"step\":\"payment_authentication\",\"source\":\"customer\",\"email\":null},\"code\":2}'),
(35, 'order_RMBz6zUso8Vb9S', 28, NULL, NULL, NULL, '28-26092025154027', 1149, 'INR', NULL, NULL, NULL, 0, NULL, NULL),
(36, NULL, 28, NULL, NULL, NULL, '28-26092025154037', 1149, 'INR', 'Fail', NULL, NULL, 1, 'Online Payment', '{\"message\":\"undefined\",\"error\":{\"reason\":\"payment_error\",\"metadata\":{},\"code\":\"BAD_REQUEST_ERROR\",\"contact\":null,\"description\":\"undefined\",\"step\":\"payment_authentication\",\"source\":\"customer\",\"email\":null},\"code\":2}'),
(37, 'order_RMC3n3vZn10dhz', 29, 'pay_RMC4QYsM8sY750', 'order_RMC3n3vZn10dhz', '9617edea13f10d0c4b190e86a20d327675c7645a882e8400d81cb61422267698', '29-26092025154453', 399, 'INR', 'Success', NULL, '2025-09-26 10:15:46', 1, 'Online Payment', NULL),
(38, 'order_RMC7O1ztERDr3t', 30, NULL, NULL, NULL, '30-26092025154816', 1149, 'INR', NULL, NULL, NULL, 0, NULL, NULL),
(39, NULL, 30, NULL, NULL, NULL, '30-26092025154826', 1149, 'INR', 'Fail', NULL, NULL, 1, 'Online Payment', '{\"message\":\"undefined\",\"error\":{\"reason\":\"payment_error\",\"metadata\":{},\"code\":\"BAD_REQUEST_ERROR\",\"contact\":null,\"description\":\"undefined\",\"step\":\"payment_authentication\",\"source\":\"customer\",\"email\":null},\"code\":2}'),
(40, 'order_RMCJvOQNlp5r8g', 31, 'pay_RMCKO7MmFhBa4p', 'order_RMCJvOQNlp5r8g', '6b6cde6e93837b613fc96798d5e76668ffe883fdf8ddf9d31230389f35bec39e', '31-26092025160009', 699, 'INR', 'Success', NULL, '2025-09-26 10:30:51', 1, 'Online Payment', NULL),
(41, 'order_RMZxDiqjC4ckb8', 34, NULL, NULL, NULL, '34-27092025150717', 699, 'INR', NULL, NULL, NULL, 0, NULL, NULL),
(42, 'order_RMZzAG609Kgn3l', 35, 'pay_RMZzcU5nUtisxa', 'order_RMZzAG609Kgn3l', 'd5ef3086d0fd630f4c4a661863fb5748aa701595ae96f23ffcb022561c8ea6d4', '35-27092025150908', 699, 'INR', 'Success', NULL, '2025-09-27 09:39:52', 1, 'Online Payment', NULL),
(43, 'order_RNIdeSwYlaiUUI', 36, 'pay_RNIeHX8fgwndpO', 'order_RNIdeSwYlaiUUI', '74b7bc6668263e3df9f48faaa366ba8faf7bef4380a23b6c7cc7be99d85a4f48', '36-29092025104958', 1199, 'INR', 'Success', NULL, '2025-09-29 05:20:52', 1, 'Online Payment', NULL),
(44, 'order_RNMBCd1XQZB87E', 1, 'pay_RNMBiaqyPxRBO7', 'order_RNMBCd1XQZB87E', '49a0b3297fe4b356129e601cf34db4d41bc138185d1cf4ecfd40782966ee2d98', '1-29092025141749', 949, 'INR', 'Success', NULL, '2025-09-29 08:48:35', 1, 'Online Payment', NULL),
(45, 'order_RO8hXsQ13QFldt', 3, 'pay_RO8huI9oC2IZWR', 'order_RO8hXsQ13QFldt', 'f2d4877640fb6265ff761946c4392ee84df6559af85fb9fb2b61fac616e3d2da', '3-01102025134544', 699, 'INR', 'Success', NULL, '2025-10-01 08:16:21', 1, 'Online Payment', NULL),
(46, 'order_ROEIhZh6cL7yAp', 4, 'pay_ROEJ8w9zESBmFX', 'order_ROEIhZh6cL7yAp', '8041b8a0af6dc074a54e32ab14e8656efec3aadb1ff6e94c93163b4b3b2f3e2b', '4-01102025191422', 399, 'INR', 'Success', NULL, '2025-10-01 13:45:06', 1, 'Online Payment', NULL),
(47, 'order_ROEOf5vw0ma3H4', 5, NULL, NULL, NULL, '5-01102025192001', 699, 'INR', NULL, NULL, NULL, 0, NULL, NULL),
(48, 'order_ROxa9r6BVNFzad', 6, NULL, NULL, NULL, '6-03102025153206', 999, 'INR', NULL, NULL, NULL, 0, NULL, NULL),
(49, 'order_RPY7KbRF9xrvPm', 8, NULL, NULL, NULL, '8-05102025031629', 5000, 'INR', NULL, NULL, NULL, 0, NULL, NULL),
(50, 'order_RQ788sMKmQV8HQ', 9, 'pay_RQ799iUbMNwd6J', 'order_RQ788sMKmQV8HQ', '46dd468c42f41e025b1c24700d5800c7bd08ceadcb40632ce26050b63f2ef809', '9-06102025133131', 549, 'INR', 'Success', NULL, '2025-10-06 08:02:44', 1, 'Online Payment', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `cms`
--

CREATE TABLE `cms` (
  `id` int(11) NOT NULL,
  `strTitle` text,
  `strDescription` text,
  `iStatus` int(11) NOT NULL DEFAULT '1',
  `isDelete` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `strIP` varchar(255) DEFAULT NULL,
  `slugname` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cms`
--

INSERT INTO `cms` (`id`, `strTitle`, `strDescription`, `iStatus`, `isDelete`, `created_at`, `updated_at`, `strIP`, `slugname`) VALUES
(4, 'Terms & Conditions', '<p>For the purpose of these Terms and Conditions, The term \"we\", \"us\", \"our\" used anywhere on this page shall mean MEDICAL BOONS CONSULTANCY, whose registered/operational office is C/2, Rajkamal plaza-A, Nr C U Shah College, Income-tax, Ahm Ahmedabad GUJARAT 380014 . \"you\", “your”, \"user\", “visitor” shall mean any natural or legal person who is visiting our website and/or agreed to purchase from us.</p><p><strong>Your use of the website and/or purchase from us are governed by following Terms and Conditions:</strong></p><p>The content of the pages of this website is subject to change without notice.</p><p>Neither we nor any third parties provide any warranty or guarantee as to the accuracy, timeliness, performance, completeness or suitability of the information and materials found or offered on this website for any particular purpose. You acknowledge that such information and materials may contain inaccuracies or errors and we expressly exclude liability for any such inaccuracies or errors to the fullest extent permitted by law.</p><p>Your use of any information or materials on our website and/or product pages is entirely at your own risk, for which we shall not be liable. It shall be your own responsibility to ensure that any products, services or information available through our website and/or product pages meet your specific requirements.</p><p>Our website contains material which is owned by or licensed to us. This material includes, but are not limited to, the design, layout, look, appearance and graphics. Reproduction is prohibited other than in accordance with the copyright notice, which forms part of these terms and conditions.</p><p>All trademarks reproduced in our website which are not the property of, or licensed to, the operator are acknowledged on the website.</p><p>Unauthorized use of information provided by us shall give rise to a claim for damages and/or be a criminal offense.</p><p>From time to time our website may also include links to other websites. These links are provided for your convenience to provide further information.</p><p>You may not create a link to our website from another website or document without MEDICAL BOONS CONSULTANCY’s prior written consent.</p><p>Any dispute arising out of use of our website and/or purchase with us and/or any engagement with us is subject to the laws of India .</p><p>We, shall be under no liability whatsoever in respect of any loss or damage arising directly or indirectly out of the decline of authorization for any Transaction, on Account of the Cardholder having exceeded the preset limit mutually agreed by us with our acquiring bank from time to time</p>', 1, 0, '2025-05-08 12:24:41', '2025-09-12 07:35:06', '103.1.100.226', 'terms-conditions'),
(5, 'Privacy Policy', '<p>This privacy policy sets out how MEDICAL BOONS CONSULTANCY uses and protects any information that you give MEDICAL BOONS CONSULTANCY when you visit their website and/or agree to purchase from them.</p><p>MEDICAL BOONS CONSULTANCY is committed to ensuring that your privacy is protected. Should we ask you to provide certain information by which you can be identified when using this website, and then you can be assured that it will only be used in accordance with this privacy statement.</p><p>MEDICAL BOONS CONSULTANCY may change this policy from time to time by updating this page. You should check this page from time to time to ensure that you adhere to these changes.</p><p><strong>We may collect the following information:</strong></p><p>Name</p><p>Contact information including email address</p><p>Demographic information such as postcode, preferences and interests, if required</p><p>Other information relevant to customer surveys and/or offers</p><p><strong>What we do with the information we gather</strong></p><p>We require this information to understand your needs and provide you with a better service, and in particular for the following reasons:</p><p>Internal record keeping.</p><p>We may use the information to improve our products and services.</p><p>We may periodically send promotional emails about new products, special offers or other information which we think you may find interesting using the email address which you have provided.</p><p>From time to time, we may also use your information to contact you for market research purposes. We may contact you by email, phone, fax or mail. We may use the information to customise the website according to your interests.</p><p>We are committed to ensuring that your information is secure. In order to prevent unauthorised access or disclosure we have put in suitable measures.</p><p><strong>How we use cookies</strong></p><p>A cookie is a small file which asks permission to be placed on your computer\'s hard drive. Once you agree, the file is added and the cookie helps analyze web traffic or lets you know when you visit a particular site. Cookies allow web applications to respond to you as an individual. The web application can tailor its operations to your needs, likes and dislikes by gathering and remembering information about your preferences.</p><p>We use traffic log cookies to identify which pages are being used. This helps us analyze data about webpage traffic and improve our website in order to tailor it to customer needs. We only use this information for statistical analysis purposes and then the data is removed from the system.</p><p>Overall, cookies help us provide you with a better website, by enabling us to monitor which pages you find useful and which you do not. A cookie in no way gives us access to your computer or any information about you, other than the data you choose to share with us.</p><p>You can choose to accept or decline cookies. Most web browsers automatically accept cookies, but you can usually modify your browser setting to decline cookies if you prefer. This may prevent you from taking full advantage of the website.</p><p><strong>Controlling your personal information</strong></p><p>You may choose to restrict the collection or use of your personal information in the following ways:</p><p>whenever you are asked to fill in a form on the website, look for the box that you can click to indicate that you do not want the information to be used by anybody for direct marketing purposes</p><p>if you have previously agreed to us using your personal information for direct marketing purposes, you may change your mind at any time by writing to or emailing us at medicalboons@gmail.com</p><p>We will not sell, distribute or lease your personal information to third parties unless we have your permission or are required by law to do so. We may use your personal information to send you promotional information about third parties which we think you may find interesting if you tell us that you wish this to happen.</p><p>If you believe that any information we are holding on you is incorrect or incomplete, please write to C/2, Rajkamal plaza-A, Nr C U Shah College, Income-tax, Ahm Ahmedabad GUJARAT 380014 . or contact us at 9974660451 or medicalboons@gmail.com as soon as possible. We will promptly correct any information found to be incorrect.</p>', 1, 0, '2025-05-08 12:25:40', '2025-09-12 07:35:53', '103.1.100.226', 'privacy-policy'),
(6, 'Refund Policy', '<p>MEDICAL BOONS CONSULTANCY believes in helping its customers as far as possible, and has therefore a liberal cancellation policy. Under this policy:</p><p>Cancellations will be considered only if the request is made within Not applicable of placing the order. However, the cancellation request may not be entertained if the orders have been communicated to the vendors/merchants and they have initiated the process of shipping them.</p><p>MEDICAL BOONS CONSULTANCY does not accept cancellation requests for perishable items like flowers, eatables etc. However, refund/replacement can be made if the customer establishes that the quality of product delivered is not good.</p><p>In case of receipt of damaged or defective items please report the same to our Customer Service team. The request will, however, be entertained once the merchant has checked and determined the same at his own end. This should be reported within Not applicable of receipt of the products.</p><p>In case you feel that the product received is not as shown on the site or as per your expectations, you must bring it to the notice of our customer service within Not applicable of receiving the product. The Customer Service Team after looking into your complaint will take an appropriate decision.</p><p>In case of complaints regarding products that come with a warranty from manufacturers, please refer the issue to them.</p><p>In case of any Refunds approved by the MEDICAL BOONS CONSULTANCY, it’ll take 6-8 days for the refund to be processed to the end customer.</p>', 1, 0, '2025-05-08 12:25:40', '2025-09-12 07:35:22', '103.1.100.226', 'refund-policy'),
(7, 'Shipping & Delivery', '<p>For International buyers, orders are shipped and delivered through registered international courier companies and/or International speed post only. For domestic buyers, orders are shipped through registered domestic courier companies and /or speed post only. Orders are shipped within 0-7 days or as per the delivery date agreed at the time of order confirmation and delivering of the shipment subject to Courier Company / post office norms. MEDICAL BOONS CONSULTANCY is not liable for any delay in delivery by the courier company / postal authorities and only guarantees to hand over the consignment to the courier company or postal authorities within 0-7 days rom the date of the order and payment or as per the delivery date agreed at the time of order confirmation. Delivery of all orders will be to the address provided by the buyer. Delivery of our services will be confirmed on your mail ID as specified during registration. For any issues in utilizing our services you may contact our helpdesk on 9974660451 or medicalboons@gmail.com</p>', 1, 0, '2025-05-08 12:26:45', '2025-09-12 07:35:33', '103.1.100.226', 'ShippingDelivery'),
(8, 'About Us', '<p>At <strong>Medical Boons Consultancy</strong>, we believe healthcare should never be a financial burden. Since our inception, we’ve been helping families access <strong>quality healthcare at affordable rates</strong> through membership-based health savings plans.</p><p>Our mission is simple:<br>✔️ Reduce everyday medical expenses.<br>✔️ Support families with preventive &amp; routine care.<br>✔️ Connect people with trusted doctors, labs, and wellness services.</p><p>With our upcoming digital platform <strong>Carezy – Care Beyond Costs</strong>, we are building a seamless healthcare ecosystem where affordability meets accessibility.</p>', 1, 0, '2025-05-08 12:26:45', '2025-09-12 05:44:06', '103.1.100.226', 'AboutUs');

-- --------------------------------------------------------

--
-- Table structure for table `corporates`
--

CREATE TABLE `corporates` (
  `id` int(11) NOT NULL,
  `company_name` varchar(255) DEFAULT NULL,
  `contact_person` varchar(255) DEFAULT NULL,
  `mobile` varchar(20) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `address` text,
  `type` int(11) NOT NULL DEFAULT '0',
  `main_parent_id` int(11) DEFAULT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `iStatus` int(11) DEFAULT '1',
  `password` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `isDelete` int(11) DEFAULT '0',
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `strIP` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `Corporate_Order`
--

CREATE TABLE `Corporate_Order` (
  `Corporate_Order_id` int(11) NOT NULL,
  `iUserId` int(11) DEFAULT '0',
  `memberid` int(11) NOT NULL DEFAULT '0',
  `iOrderType` int(11) DEFAULT '0' COMMENT '1 = corporate, 2= B2B, 3=Retail',
  `iPlanId` int(11) DEFAULT '0',
  `link` varchar(255) DEFAULT NULL,
  `iStatus` int(11) NOT NULL DEFAULT '1',
  `isDelete` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `strIP` varchar(255) DEFAULT NULL,
  `iExtraMember` int(11) DEFAULT '0',
  `iamountExtraMember` int(11) DEFAULT '0',
  `iPlanMembers` int(11) DEFAULT '0',
  `PlanAmount` int(11) DEFAULT '0',
  `NetAmount` int(11) DEFAULT '0',
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `Guid` text,
  `main_parent_id` int(11) NOT NULL DEFAULT '0',
  `parent_id` int(11) NOT NULL DEFAULT '0',
  `is_corporate` int(11) NOT NULL DEFAULT '0',
  `Name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `mobile` varchar(100) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `state` varchar(255) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `pincode` varchar(255) DEFAULT NULL,
  `isPayment` int(11) NOT NULL DEFAULT '0',
  `invoice_no` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `Corporate_Order`
--

INSERT INTO `Corporate_Order` (`Corporate_Order_id`, `iUserId`, `memberid`, `iOrderType`, `iPlanId`, `link`, `iStatus`, `isDelete`, `created_at`, `updated_at`, `strIP`, `iExtraMember`, `iamountExtraMember`, `iPlanMembers`, `PlanAmount`, `NetAmount`, `start_date`, `end_date`, `Guid`, `main_parent_id`, `parent_id`, `is_corporate`, `Name`, `email`, `mobile`, `address`, `state`, `city`, `pincode`, `isPayment`, `invoice_no`) VALUES
(1, 0, 20, 3, 11, NULL, 1, 0, '2025-09-29 08:47:49', '2025-10-06 06:58:45', '103.1.100.226', 1, 250, 2, 699, 949, '2025-10-01', '2026-09-30', '64cfb46e-2678-433c-ac39-af11c9067286', 0, 0, 0, 'Nisha', 'ai.dev.laravel11@gmail.com', '9898808754', 'Bhairavnath,Isanpur Ahmedabad Road', 'Gujarat', 'Ahmedabad', '345678', 1, 'ORD1234567810'),
(2, 0, 3, 3, 11, NULL, 1, 0, '2025-09-29 08:47:49', '2025-09-29 08:48:36', '103.1.100.226', 1, 250, 2, 699, 949, '2025-10-01', '2026-09-30', '64cfb46e-2678-433c-ac39-af11c9067286', 0, 0, 0, 'Nisha', 'ai.dev.laravel12@gmail.com', '9898808754', 'Bhairavnath,Isanpur Ahmedabad Road', 'Gujarat', 'Ahmedabad', '345678', 1, NULL),
(3, 0, 21, 3, 11, NULL, 1, 0, '2025-10-01 08:15:43', '2025-10-01 08:16:21', '103.1.100.226', NULL, 300, 2, 699, 699, '2025-10-03', '2026-10-02', 'fb164ef8-867b-462d-84ec-5f4c0beca525', 0, 0, 0, 'Pritesh', 'priteshshah223@gmail.com', '7575039002', 'Naranpura', 'Gujarat', 'Ahmedad', '380013', 1, NULL),
(4, 0, 22, 3, 10, NULL, 1, 0, '2025-10-01 13:44:22', '2025-10-01 13:45:07', '103.1.100.226', NULL, 150, 2, 399, 399, '2025-10-03', '2026-10-01', '25066475-a855-4a3b-862c-edb57db63902', 0, 0, 0, 'Nisha', 'dev2.apolloinfotech@gmail.com', '9898808751', 'Bhairavnath,Isanpur Ahmedabad Road', 'Gujarat', 'Ahmedabad', '678900', 1, NULL),
(5, 0, 0, 3, 11, NULL, 1, 0, '2025-10-01 13:50:00', '2025-10-01 13:50:59', '103.1.100.226', NULL, 300, 2, 699, 699, '2025-10-03', '2026-10-01', '92277a5e-3b2b-49cc-83b4-df6780d8d52d', 0, 0, 0, 'Nisha', 'dev3.apolloinfotech@gmail.com', '9898808758', 'Bhairavnath,Isanpur Ahmedabad Road', 'Gujarat', 'Ahmedabad', '678900', 0, NULL),
(6, 0, 0, 3, 10, NULL, 1, 0, '2025-10-03 10:02:06', NULL, '117.97.199.69', 4, 150, 2, 399, 999, '2025-10-05', '2026-10-03', 'aaaeed28-4228-43f7-bc05-5f4e4668e418', 0, 0, 0, 'Nitesh Pardeshi', 'nitesh_pardeshi1981@yahoo.com', '9427629317', '503, Maruti 4, Pratapkunj Society,b/h Vasna Police station, Vasna', 'Gujarat', 'Ahmedabad', '380006', 0, NULL),
(7, 2, 0, 1, 12, NULL, 1, 0, '2025-10-03 13:51:06', '2025-10-06 06:57:06', '103.1.100.226', NULL, 0, 4, 5000, 5000, '2025-10-03', '2026-10-02', 'b2dbfba3-8506-47d3-979b-bbb4deec5be1', 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 'ORD1234567811'),
(8, 0, 3, 2, 13, NULL, 1, 0, '2025-10-04 21:46:29', '2025-10-04 21:46:29', NULL, 1, 0, 4, 5000, 5000, '2026-10-01', '2027-09-29', '0d14573e-10b6-48e3-8c40-a3ac566358a4', 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL),
(9, 0, 23, 3, 10, NULL, 1, 0, '2025-10-06 08:01:31', '2025-10-06 08:02:44', '42.105.168.186', 1, 150, 2, 399, 549, '2025-10-08', '2026-10-06', '3594bdbf-6bfa-4005-afbc-f95dc29c6e29', 0, 0, 0, 'Aditya Jani', 'adijani195@gmail.com', '8401069349', 'A-8, Shantiniketan Bunglows, B/H Prahladnagar garden, Satelite, Ahmedabad-38015, Gujarat, INDIA', 'Gujarat', 'Ahmedabad', '380015', 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `Customer`
--

CREATE TABLE `Customer` (
  `Customer_id` int(11) NOT NULL,
  `Customer_name` varchar(50) DEFAULT NULL,
  `Customer_address` varchar(50) DEFAULT NULL,
  `DOB` date DEFAULT NULL,
  `Customer_email` varchar(50) DEFAULT NULL,
  `Customer_phone` bigint(20) DEFAULT NULL,
  `LandMark` varchar(50) DEFAULT NULL,
  `state_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `strIP` varchar(45) DEFAULT NULL,
  `iStatus` int(11) DEFAULT '1',
  `isDelete` int(11) DEFAULT '0',
  `isOtpVerified` int(11) DEFAULT '0',
  `otp` int(11) DEFAULT NULL,
  `expiry_time` datetime DEFAULT NULL,
  `latitude` varchar(255) DEFAULT NULL,
  `longitude` varchar(255) DEFAULT NULL,
  `Customer_image` varchar(100) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `customer_order_consumption`
--

CREATE TABLE `customer_order_consumption` (
  `id` int(11) NOT NULL,
  `Customer_id` int(11) NOT NULL DEFAULT '0',
  `order_id` int(11) NOT NULL DEFAULT '0',
  `referance_person_id` int(11) NOT NULL DEFAULT '0',
  `service_id` int(11) NOT NULL DEFAULT '0',
  `service_description` text,
  `qty` int(11) NOT NULL DEFAULT '0',
  `request_if_any` varchar(255) DEFAULT NULL,
  `pickup_date_time` timestamp NULL DEFAULT NULL,
  `iStatus` int(11) NOT NULL DEFAULT '1',
  `isDelete` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `strIP` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `ea_fr4a`
--

CREATE TABLE `ea_fr4a` (
  `SR NO` int(2) DEFAULT NULL,
  `LAB NAME` varchar(6) DEFAULT NULL,
  `TEST_NAME` varchar(32) DEFAULT NULL,
  `MRP` int(4) DEFAULT NULL,
  `PATIENT_PRICE` int(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ea_fr4a`
--

INSERT INTO `ea_fr4a` (`SR NO`, `LAB NAME`, `TEST_NAME`, `MRP`, `PATIENT_PRICE`) VALUES
(1, 'EA LAB', 'FOOD ONLY', 1800, 1620),
(2, 'EA LAB', 'NON-VEG ONLY', 1200, 1080),
(3, 'EA LAB', 'INHALENT ONLY', 1500, 1350),
(4, 'EA LAB', 'DRUG ONLY', 2000, 1800),
(5, 'EA LAB', 'FOOD + NON-VEG', 3000, 2700),
(6, 'EA LAB', 'FOOD + DRUG', 3800, 3420),
(7, 'EA LAB', 'FOOD + INHALENT', 2200, 1980),
(8, 'EA LAB', 'FOOD + INHALENT + NON-VEG', 3200, 2880),
(9, 'EA LAB', 'FOOD + INHALENT + DRUG', 3700, 3330),
(10, 'EA LAB', 'FOOD + INHALENT + NON-VEG + DRUG', 5000, 4250);

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `family_member`
--

CREATE TABLE `family_member` (
  `family_member_id` int(11) NOT NULL,
  `member_name` varchar(100) DEFAULT NULL,
  `DOB` date DEFAULT NULL,
  `gender` int(11) DEFAULT '1' COMMENT '1=Male or 2=Female',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `member_id` int(11) DEFAULT '0',
  `active_inactive` tinyint(4) NOT NULL DEFAULT '0' COMMENT '0 = active,1= inactive',
  `discount_apply` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `family_member`
--

INSERT INTO `family_member` (`family_member_id`, `member_name`, `DOB`, `gender`, `created_at`, `updated_at`, `member_id`, `active_inactive`, `discount_apply`) VALUES
(4, 'Nisha', '2002-02-02', 2, '2025-06-17 12:28:26', '2025-06-17 12:28:26', 5, 0, 0),
(5, 'Mignesh', '2000-04-16', 1, '2025-06-20 06:20:57', '2025-06-20 06:20:57', 5, 0, 0),
(6, 'Mihir', '2004-10-26', 1, '2025-06-26 08:52:11', '2025-06-26 08:52:11', 5, 0, 0),
(7, 'Mignesh', '2000-09-16', 1, '2025-09-16 05:19:25', '2025-09-16 05:19:25', 1, 0, 0),
(8, 'Meet Patel', '2001-09-16', 1, '2025-09-16 05:19:51', '2025-09-16 05:19:51', 1, 0, 0),
(9, 'Meet', '2025-09-24', 1, '2025-09-24 11:31:42', '2025-10-04 21:46:29', 3, 1, 1),
(11, 'Rutvik', '1999-09-25', 1, '2025-09-25 11:30:32', '2025-10-04 21:46:29', 3, 1, 1),
(12, 'Prit', '2002-09-01', 1, '2025-09-25 11:31:05', '2025-10-04 21:46:29', 3, 1, 0),
(13, 'Vivek', '2002-09-12', 1, '2025-09-25 11:31:25', '2025-10-04 21:46:29', 3, 1, 0),
(14, 'Bharat', '2012-09-02', 1, '2025-09-25 11:31:40', '2025-10-04 21:46:29', 3, 1, 0),
(15, 'Priya', '2003-08-25', 2, '2025-09-25 11:32:01', '2025-10-04 21:46:29', 3, 1, 0),
(16, 'Purvi Patel', '2006-09-25', 2, '2025-09-25 11:33:13', '2025-10-04 21:46:29', 3, 1, 0),
(17, 'Priya', '2025-09-04', 2, '2025-09-25 13:15:42', '2025-10-04 21:46:29', 3, 1, 0),
(18, 'Krupali Shah', '1985-12-30', 2, '2025-09-26 08:09:34', '2025-09-26 08:09:34', 7, 0, 0),
(19, 'Krunal Shah', '1983-11-23', 1, '2025-09-26 08:10:11', '2025-09-26 08:10:11', 7, 0, 0),
(20, 'Sneh', '2012-09-09', 1, '2025-09-26 08:10:36', '2025-09-26 08:10:36', 7, 0, 0),
(21, 'Bharat', '2025-07-01', 1, '2025-09-26 08:59:17', '2025-10-04 21:46:29', 3, 1, 0),
(22, 'Divyesh', '2025-07-01', 1, '2025-09-26 09:01:39', '2025-10-04 21:46:29', 3, 1, 0),
(23, 'Shivani', '2025-09-26', 2, '2025-09-26 09:06:20', '2025-10-04 21:46:29', 3, 1, 0),
(24, 'Arunabn J Shah', '1954-01-02', 2, '2025-10-01 08:29:12', '2025-10-01 08:29:12', 21, 0, 0),
(25, 'Sejal shh', '1981-12-04', 2, '2025-10-01 08:29:58', '2025-10-01 08:29:58', 21, 0, 0),
(26, 'Aditya Jani', '1986-10-19', 1, '2025-10-06 08:07:21', '2025-10-06 08:07:21', 23, 0, 0),
(27, 'Raksha Jani', '1990-07-02', 2, '2025-10-06 08:08:30', '2025-10-06 08:08:30', 23, 0, 0),
(28, 'Maurya Jani', '2019-09-27', 1, '2025-10-06 08:08:57', '2025-10-06 08:08:57', 23, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `inquiry`
--

CREATE TABLE `inquiry` (
  `inquiry_id` int(11) NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  `mobileNumber` varchar(12) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `message` text,
  `subject` varchar(255) DEFAULT NULL,
  `strIp` varchar(50) NOT NULL,
  `iStatus` int(11) NOT NULL DEFAULT '1',
  `isDelete` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `inquiry`
--

INSERT INTO `inquiry` (`inquiry_id`, `name`, `mobileNumber`, `email`, `message`, `subject`, `strIp`, `iStatus`, `isDelete`, `created_at`, `updated_at`) VALUES
(1, 'Mihir Rathod', '9999999999', 'mihir@gmail.com', 'test', 'test', '103.1.100.226', 1, 0, '2025-01-01 12:22:11', '2025-01-01 12:22:11'),
(2, 'Mihir Rathod', '9999999999', 'mihir@gmail.com', 'test', 'test', '103.1.100.226', 1, 0, '2025-01-01 12:23:07', '2025-01-01 12:23:07'),
(3, 'Bansari Patel', '9987654321', 'dev1.apolloinfotech@gmail.com', 'test', 'test', '103.1.100.226', 1, 0, '2025-01-01 12:53:07', '2025-01-01 12:53:07'),
(4, 'Test', '9876543210', 'Test', 'Test', 'Test', '103.1.100.226', 1, 0, '2025-01-01 13:10:46', '2025-01-01 13:10:46'),
(5, 'Mihir Rathod', '9999999999', 'mihir@gmail.com', 'Hello', 'Hello', '103.1.100.226', 1, 0, '2025-01-01 13:22:05', '2025-01-01 13:22:05'),
(6, 'asd fgh', '9898989898', 'asd@xyz.com', 'test', 'test', '103.1.100.226', 1, 0, '2025-01-01 13:22:37', '2025-01-01 13:22:37'),
(7, 'test', '9987654321', 'test@test.com', 'test', 'test', '103.1.100.226', 1, 0, '2025-01-02 13:09:53', '2025-01-02 13:09:53'),
(8, 'Bansari Patel', '9987654321', 'dev5.apolloinfotech@gmail.com', 'test', 'test', '103.1.100.226', 1, 0, '2025-01-07 09:35:35', '2025-01-07 09:35:35'),
(9, 'Bansari Patel', '9987654321', 'dev1.apolloinfotech@gmail.com', 'test mail message', 'test', '103.1.100.226', 1, 0, '2025-01-07 10:57:45', '2025-01-07 10:57:45'),
(10, 'Bansari Patel', '9987654321', 'dev1.apolloinfotech@gmail.com', 'test test test test test', 'test', '103.1.100.226', 1, 0, '2025-01-08 04:49:00', '2025-01-08 04:49:00'),
(11, 'Rakesh Patanwadia', '9979853842', 'rakesh@dhrutisales.co.in', 'Send MOG price', 'Request for quotation', '152.59.4.26', 1, 0, '2025-01-24 13:26:57', '2025-01-24 13:26:57');

-- --------------------------------------------------------

--
-- Table structure for table `LabReport_Request_detail`
--

CREATE TABLE `LabReport_Request_detail` (
  `LabReport_Request_detail_id` int(11) NOT NULL,
  `member_id` int(11) DEFAULT '0',
  `family_member_id` int(11) DEFAULT '0',
  `Lab_test_master_id` int(11) DEFAULT '0',
  `LabReport_Request_Master_id` int(11) NOT NULL DEFAULT '0',
  `Lab_test_category_id` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `LabReport_Request_detail`
--

INSERT INTO `LabReport_Request_detail` (`LabReport_Request_detail_id`, `member_id`, `family_member_id`, `Lab_test_master_id`, `LabReport_Request_Master_id`, `Lab_test_category_id`, `created_at`, `updated_at`) VALUES
(1, 5, 4, 1, 1, 0, '2025-08-12 12:47:35', '2025-08-12 12:47:35'),
(3, 5, 5, 10, 1, 1, '2025-08-12 13:04:46', '2025-08-12 13:04:46'),
(6, 5, 6, 6, 1, 1, '2025-08-12 13:35:50', '2025-08-12 13:35:50'),
(10, 5, 5, 4, 1, 1, '2025-08-13 06:25:29', '2025-08-13 06:25:29'),
(11, 5, 4, 2, 2, 0, '2025-09-15 08:57:34', '2025-09-15 08:57:34'),
(12, 5, 4, 7, 2, 0, '2025-09-15 08:57:34', '2025-09-15 08:57:34'),
(13, 5, 4, 161, 2, 0, '2025-09-15 08:57:34', '2025-09-15 08:57:34'),
(14, 1, 8, 19, 3, 0, '2025-09-16 06:33:56', '2025-09-16 06:33:56'),
(15, 1, 8, 189, 3, 0, '2025-09-16 06:33:56', '2025-09-16 06:33:56'),
(16, 3, 0, 143, 6, 0, '2025-09-30 10:11:08', '2025-09-30 10:11:08'),
(17, 3, 0, 145, 6, 0, '2025-09-30 10:11:08', '2025-09-30 10:11:08'),
(18, 3, 0, 3, 6, 0, '2025-09-30 10:11:08', '2025-09-30 10:11:08'),
(19, 3, 0, 145, 7, 0, '2025-09-30 11:06:50', '2025-09-30 11:06:50'),
(20, 3, 0, 1, 7, 0, '2025-09-30 11:06:50', '2025-09-30 11:06:50'),
(21, 3, 11, 145, 8, 0, '2025-09-30 11:11:25', '2025-09-30 11:11:25'),
(22, 3, 11, 3, 8, 0, '2025-09-30 11:11:25', '2025-09-30 11:11:25'),
(23, 3, 11, 150, 8, 0, '2025-09-30 11:11:25', '2025-09-30 11:11:25'),
(24, 3, 11, 145, 9, 0, '2025-09-30 11:31:41', '2025-09-30 11:31:41'),
(25, 3, 11, 144, 9, 0, '2025-09-30 11:31:41', '2025-09-30 11:31:41'),
(26, 3, 16, 0, 10, 0, '2025-09-30 11:34:02', '2025-09-30 11:34:02');

-- --------------------------------------------------------

--
-- Table structure for table `LabReport_Request_Master`
--

CREATE TABLE `LabReport_Request_Master` (
  `LabReport_Request_id` int(11) NOT NULL,
  `Lab_id` int(11) DEFAULT '0',
  `date` date DEFAULT NULL,
  `visit` int(11) DEFAULT '0' COMMENT '1=Home Visit\n2 = Center Visit',
  `total_amount` int(11) NOT NULL DEFAULT '0',
  `special_discount` int(11) NOT NULL DEFAULT '0',
  `discount_amount` int(11) DEFAULT '0',
  `NetAmount` int(11) DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `member_id` int(11) DEFAULT '0',
  `family_member_id` int(11) DEFAULT '0',
  `lab_test_id` int(11) DEFAULT '0',
  `appointments_flag` int(11) NOT NULL DEFAULT '0' COMMENT '1 = Associated Member, 2= Lab',
  `preference_date` date DEFAULT NULL,
  `preference_time` varchar(255) DEFAULT NULL,
  `associated_id` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `LabReport_Request_Master`
--

INSERT INTO `LabReport_Request_Master` (`LabReport_Request_id`, `Lab_id`, `date`, `visit`, `total_amount`, `special_discount`, `discount_amount`, `NetAmount`, `created_at`, `updated_at`, `member_id`, `family_member_id`, `lab_test_id`, `appointments_flag`, `preference_date`, `preference_time`, `associated_id`) VALUES
(1, 1, '2025-08-14', 1, 1720, 300, 830, 1550, '2025-08-12 12:47:35', '2025-08-13 06:25:48', 5, 0, 0, 2, NULL, NULL, 0),
(2, 1, '2025-09-16', 1, 1750, 200, 0, 1189, '2025-09-15 08:57:34', NULL, 5, 0, 0, 2, NULL, NULL, 0),
(3, 1, '2025-09-17', 1, 370, 100, 0, 272, '2025-09-16 06:33:56', NULL, 1, 0, 0, 2, NULL, NULL, 0),
(4, 0, NULL, 0, 0, 0, 300, 450, '2025-09-29 10:14:40', '2025-09-29 10:14:40', 3, 0, 0, 0, NULL, NULL, 0),
(5, 0, NULL, 0, 0, 0, 300, 450, '2025-09-30 05:45:06', '2025-09-30 05:45:06', 3, 0, 0, 0, NULL, NULL, 0),
(6, 3, '2025-10-01', 1, 2700, 200, 300, 1250, '2025-09-30 10:11:08', NULL, 3, 0, 0, 2, NULL, NULL, 0),
(7, 3, '2025-10-04', 1, 1300, 100, 300, 600, '2025-09-30 11:06:50', NULL, 3, 0, 0, 2, NULL, NULL, 0),
(8, 3, '2025-10-01', 1, 5100, 200, 0, 3700, '2025-09-30 11:11:25', NULL, 3, 0, 0, 2, NULL, NULL, 0),
(9, 3, '2025-10-01', 1, 1600, 100, 300, 800, '2025-09-30 11:31:41', NULL, 3, 0, 0, 2, NULL, NULL, 0),
(10, 0, NULL, 0, 0, 0, 0, 0, '2025-09-30 11:34:02', '2025-09-30 11:34:02', 3, 0, 0, 1, '2025-10-10', '5:03 PM', 9);

-- --------------------------------------------------------

--
-- Table structure for table `LabReport_Request_temp`
--

CREATE TABLE `LabReport_Request_temp` (
  `LabReport_Request_temp_id` int(11) NOT NULL,
  `member_id` int(11) DEFAULT '0',
  `family_member_id` int(11) DEFAULT '0',
  `lab_test_id` int(11) DEFAULT '0',
  `iStatus` int(11) DEFAULT '1',
  `IsDelete` int(11) DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `LabReport_Request_temp`
--

INSERT INTO `LabReport_Request_temp` (`LabReport_Request_temp_id`, `member_id`, `family_member_id`, `lab_test_id`, `iStatus`, `IsDelete`, `created_at`, `updated_at`) VALUES
(34, 5, 5, 145, 1, 0, '2025-09-15 08:58:06', '2025-09-15 08:58:06'),
(35, 5, 5, 2, 1, 0, '2025-09-15 08:58:13', '2025-09-15 08:58:13'),
(40, 1, 8, 143, 1, 0, '2025-09-16 06:35:03', '2025-09-16 06:35:03'),
(51, 3, NULL, 144, 1, 0, '2025-09-30 13:22:15', '2025-09-30 13:22:15'),
(52, 3, NULL, 145, 1, 0, '2025-09-30 13:22:20', '2025-09-30 13:22:20'),
(53, 21, NULL, 1, 1, 0, '2025-10-01 08:31:43', '2025-10-01 08:31:43');

-- --------------------------------------------------------

--
-- Table structure for table `Lab_Master`
--

CREATE TABLE `Lab_Master` (
  `Lab_Master_id` int(11) NOT NULL,
  `name` varchar(45) DEFAULT NULL,
  `address` varchar(45) DEFAULT NULL,
  `iStatus` int(11) DEFAULT '1',
  `isDelete` int(11) DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `strIP` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `Lab_Master`
--

INSERT INTO `Lab_Master` (`Lab_Master_id`, `name`, `address`, `iStatus`, `isDelete`, `created_at`, `updated_at`, `strIP`) VALUES
(1, 'METROPOLIS', NULL, 1, 0, NULL, NULL, NULL),
(2, 'EA LAB', 'Bhairavnath Road', 1, 0, '2025-08-11 06:15:08', '2025-08-11 06:15:08', '103.1.100.226'),
(3, 'Supratech', 'S.G Highway', 1, 0, '2025-08-11 06:25:02', '2025-08-11 06:25:02', '103.1.100.226');

-- --------------------------------------------------------

--
-- Table structure for table `Lab_Test_Category`
--

CREATE TABLE `Lab_Test_Category` (
  `Lab_Test_Category_id` int(11) NOT NULL,
  `name` varchar(45) DEFAULT NULL,
  `iStatus` int(11) DEFAULT '1',
  `isDelete` int(11) DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `strIP` text,
  `display_priority` int(11) DEFAULT '0',
  `description` varchar(500) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `Lab_Test_Category`
--

INSERT INTO `Lab_Test_Category` (`Lab_Test_Category_id`, `name`, `iStatus`, `isDelete`, `created_at`, `updated_at`, `strIP`, `display_priority`, `description`) VALUES
(1, 'Individual', 1, 0, '2025-08-08 09:27:05', '2025-08-08 09:27:05', '103.1.100.226', 2, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `Lab_Test_Master`
--

CREATE TABLE `Lab_Test_Master` (
  `Lab_Test_Master_id` int(11) NOT NULL,
  `Test_Name` varchar(45) DEFAULT NULL,
  `MRP` int(11) DEFAULT '0',
  `NetAmount` varchar(255) DEFAULT NULL,
  `lab_id` int(11) NOT NULL,
  `iStatus` int(11) DEFAULT '1',
  `isDelete` int(11) DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `lab_test_category_id` int(11) DEFAULT '0',
  `strIP` text,
  `image` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `Lab_Test_Master`
--

INSERT INTO `Lab_Test_Master` (`Lab_Test_Master_id`, `Test_Name`, `MRP`, `NetAmount`, `lab_id`, `iStatus`, `isDelete`, `created_at`, `updated_at`, `lab_test_category_id`, `strIP`, `image`) VALUES
(1, 'Abnormal Haemoglobin Studies', 750, '640', 1, 1, 0, NULL, NULL, 1, NULL, NULL),
(2, 'AFP-Alpha Feto Protein', 650, '529', 1, 1, 0, NULL, NULL, 1, NULL, NULL),
(3, 'ALKALINE PHOSPHATASE', 170, '170', 1, 1, 0, NULL, NULL, 1, NULL, NULL),
(4, 'AMH', 1800, '1080', 1, 1, 0, NULL, NULL, 1, NULL, NULL),
(5, 'Amylase Serum', 400, '265', 1, 1, 0, NULL, NULL, 1, NULL, NULL),
(6, 'ANA by IFA', 1020, '640', 1, 1, 0, NULL, NULL, 1, NULL, NULL),
(7, 'Ante natal profile', 1100, '860', 1, 1, 0, NULL, NULL, 1, NULL, NULL),
(8, 'Anti PRO-BNP', 2000, '1520', 1, 1, 0, NULL, NULL, 1, NULL, NULL),
(9, 'ANTI TPO ANTIBODY', 1200, '695', 1, 1, 0, NULL, NULL, 1, NULL, NULL),
(10, 'APTT', 350, '320', 1, 1, 0, NULL, NULL, 1, NULL, NULL),
(11, 'BilirubinTotal, Direct, IndirectSerum', 170, '170', 1, 1, 0, NULL, NULL, 1, NULL, NULL),
(12, 'Blood Group ABO & Rh Typing', 220, '220', 1, 1, 0, NULL, NULL, 1, NULL, NULL),
(13, 'BUN', 195, '195', 1, 1, 0, NULL, NULL, 1, NULL, NULL),
(14, 'C Reactive Protein serum  (CRP)', 440, '265', 1, 1, 0, NULL, NULL, 1, NULL, NULL),
(15, 'CA 15.3', 1340, '1085', 1, 1, 0, NULL, NULL, 1, NULL, NULL),
(16, 'CA 19.9', 1000, '970', 1, 1, 0, NULL, NULL, 1, NULL, NULL),
(17, 'CA-125', 900, '640', 1, 1, 0, NULL, NULL, 1, NULL, NULL),
(18, 'Calcium Total Serum', 230, '230', 1, 1, 0, NULL, NULL, 1, NULL, NULL),
(19, 'CBC ESR', 370, '272', 1, 1, 0, NULL, NULL, 1, NULL, NULL),
(20, 'CBC Haemogram', 260, '199', 1, 1, 0, NULL, NULL, 1, NULL, NULL),
(21, 'CCP Antibody', 400, '265', 1, 1, 0, NULL, NULL, 1, NULL, NULL),
(22, 'CD3', 2555, '1813', 1, 1, 0, NULL, NULL, 1, NULL, NULL),
(23, 'CD4', 1110, '933', 1, 1, 0, NULL, NULL, 1, NULL, NULL),
(24, 'CEA-Carcino Embryonic Antigen, serum', 570, '485', 1, 1, 0, NULL, NULL, 1, NULL, NULL),
(25, 'Chloride ( Cl )', 215, '215', 1, 1, 0, NULL, NULL, 1, NULL, NULL),
(26, 'Cholesterol-Total  Serum', 170, '170', 1, 1, 0, NULL, NULL, 1, NULL, NULL),
(27, 'Cortisol', 640, '375', 1, 1, 0, NULL, NULL, 1, NULL, NULL),
(28, 'C-PEPTIDE', 1180, '979', 1, 1, 0, NULL, NULL, 1, NULL, NULL),
(29, 'CPK -TOTAL', 460, '370', 1, 1, 0, NULL, NULL, 1, NULL, NULL),
(30, 'CPK-MB', 535, '455', 1, 1, 0, NULL, NULL, 1, NULL, NULL),
(31, 'Creatinine  Serum', 170, '170', 1, 1, 0, NULL, NULL, 1, NULL, NULL),
(32, 'D-DIMER', 1290, '1051', 1, 1, 0, NULL, NULL, 1, NULL, NULL),
(33, 'Dengue IgG antibdy', 650, '495', 1, 1, 0, NULL, NULL, 1, NULL, NULL),
(34, 'Dengue Igm antibdy', 650, '495', 1, 1, 0, NULL, NULL, 1, NULL, NULL),
(35, 'Dengue NS1 Antigen detection Serum', 800, '695', 1, 1, 0, NULL, NULL, 1, NULL, NULL),
(36, 'DENGUE PROFILE', 2000, '1630', 1, 1, 0, NULL, NULL, 1, NULL, NULL),
(37, 'E2', 500, '320', 1, 1, 0, NULL, NULL, 1, NULL, NULL),
(38, 'Electrolytes', 500, '295', 1, 1, 0, NULL, NULL, 1, NULL, NULL),
(39, 'ESR', 110, '110', 1, 1, 0, NULL, NULL, 1, NULL, NULL),
(40, 'Fasting blood sugar', 60, '60', 1, 1, 0, NULL, NULL, 1, NULL, NULL),
(41, 'Ferritin, serum by CLIA*', 800, '475', 1, 1, 0, NULL, NULL, 1, NULL, NULL),
(42, 'Folic acid, Serum by CMIA*', 1180, '695', 1, 1, 0, NULL, NULL, 1, NULL, NULL),
(43, 'Free T3, Serum by CLIA', 220, '210', 1, 1, 0, NULL, NULL, 1, NULL, NULL),
(44, 'Free T4, Serum by CLIA', 220, '210', 1, 1, 0, NULL, NULL, 1, NULL, NULL),
(45, 'FSH - Follicle Stimulating Hormone, Serum by ', 270, '210', 1, 1, 0, NULL, NULL, 1, NULL, NULL),
(46, 'FSH-LH-Prolactin', 850, '530', 1, 1, 0, NULL, NULL, 1, NULL, NULL),
(47, 'FSH-LH-Prolactin-TSH', 1200, '585', 1, 1, 0, NULL, NULL, 1, NULL, NULL),
(48, 'GLUCOSE TOLERANCE TEST 2 SAMPLES', 130, '130', 1, 1, 0, NULL, NULL, 1, NULL, NULL),
(49, 'GLUCOSE TOLERANCE TEST 3 SAMPLES', 270, '270', 1, 1, 0, NULL, NULL, 1, NULL, NULL),
(50, 'Haemoglobin', 120, '120', 1, 1, 0, NULL, NULL, 1, NULL, NULL),
(51, 'HAV-IgM Ab to Hepatitis `A\' Virus,serum by CM', 700, '640', 1, 1, 0, NULL, NULL, 1, NULL, NULL),
(52, 'HbA1c', 500, '298', 1, 1, 0, NULL, NULL, 1, NULL, NULL),
(53, 'HBsAg  by CMIA', 450, '265', 1, 1, 0, NULL, NULL, 1, NULL, NULL),
(54, 'HCO3', 460, '405', 1, 1, 0, NULL, NULL, 1, NULL, NULL),
(55, 'Hepatitis C Virus(HCV) (Antibodies)', 800, '420', 1, 1, 0, NULL, NULL, 1, NULL, NULL),
(56, 'HIV-1-Combo', 7800, '3900', 1, 1, 0, NULL, NULL, 1, NULL, NULL),
(57, 'HIV-DUO', 560, '265', 1, 1, 0, NULL, NULL, 1, NULL, NULL),
(58, 'HLA-B27 Studies', 2450, '1190', 1, 1, 0, NULL, NULL, 1, NULL, NULL),
(59, 'Homocysteine by CMIA', 1000, '750', 1, 1, 0, NULL, NULL, 1, NULL, NULL),
(60, 'IgE serum', 600, '485', 1, 1, 0, NULL, NULL, 1, NULL, NULL),
(61, 'IGG', 775, '710', 1, 1, 0, NULL, NULL, 1, NULL, NULL),
(62, 'IGM', 600, '496', 1, 1, 0, NULL, NULL, 1, NULL, NULL),
(63, 'IGRAS (Gamma Interferon) TB GOLD', 3200, '2312', 1, 1, 0, NULL, NULL, 1, NULL, NULL),
(64, 'Insulin', 650, '540', 1, 1, 0, NULL, NULL, 1, NULL, NULL),
(65, 'IONISED CALVIUM', 645, '467', 1, 1, 0, NULL, NULL, 1, NULL, NULL),
(66, 'IRON , SERUM', 405, '276', 1, 1, 0, NULL, NULL, 1, NULL, NULL),
(67, 'Iron Studies', 750, '475', 1, 1, 0, NULL, NULL, 1, NULL, NULL),
(68, 'LDH Lactate Dehydrogenase Serum', 400, '314', 1, 1, 0, NULL, NULL, 1, NULL, NULL),
(69, 'LFT', 750, '420', 1, 1, 0, NULL, NULL, 1, NULL, NULL),
(70, 'LH-Leutinising Hormone (Specific),serum byCLI', 270, '210', 1, 1, 0, NULL, NULL, 1, NULL, NULL),
(71, 'LIPASE', 500, '430', 1, 1, 0, NULL, NULL, 1, NULL, NULL),
(72, 'Lipid Profle-Mini', 450, '320', 1, 1, 0, NULL, NULL, 1, NULL, NULL),
(73, 'MAGNICIUM', 460, '405', 1, 1, 0, NULL, NULL, 1, NULL, NULL),
(74, 'Malaria Parasite Detection By Smear Examinati', 150, '150', 1, 1, 0, NULL, NULL, 1, NULL, NULL),
(75, 'Microalbumin / Creatinine Ratio*', 550, '460', 1, 1, 0, NULL, NULL, 1, NULL, NULL),
(76, 'Mullerian Inhibiting Substance', 1800, '1080', 1, 1, 0, NULL, NULL, 1, NULL, NULL),
(77, 'PHOSPHROUS', 200, '192', 1, 1, 0, NULL, NULL, 1, NULL, NULL),
(78, 'Post Lunch Glucose', 60, '60', 1, 1, 0, NULL, NULL, 1, NULL, NULL),
(79, 'Potassium ISE Serum', 220, '220', 1, 1, 0, NULL, NULL, 1, NULL, NULL),
(80, 'PRE OPERATIVE PROFILE MAJOR', 2000, '1350', 1, 1, 0, NULL, NULL, 1, NULL, NULL),
(81, 'PRE-OPERATIVE PROFILE MINOR', 1110, '850', 1, 1, 0, NULL, NULL, 1, NULL, NULL),
(82, 'PRO CALCITONIN', 2330, '1738', 1, 1, 0, NULL, NULL, 1, NULL, NULL),
(83, 'PROJESTERON', 500, '320', 1, 1, 0, NULL, NULL, 1, NULL, NULL),
(84, 'Prolactin', 450, '210', 1, 1, 0, NULL, NULL, 1, NULL, NULL),
(85, 'Protein Electrophoresis', 860, '530', 1, 1, 0, NULL, NULL, 1, NULL, NULL),
(86, 'PSA-total', 500, '375', 1, 1, 0, NULL, NULL, 1, NULL, NULL),
(87, 'PT (PROTHOMBIN TIME )', 340, '232', 1, 1, 0, NULL, NULL, 1, NULL, NULL),
(88, 'PTH-Para Thyroid Hormone', 1050, '860', 1, 1, 0, NULL, NULL, 1, NULL, NULL),
(89, 'RA test Rheumatoid Arthritis Serum*', 350, '320', 1, 1, 0, NULL, NULL, 1, NULL, NULL),
(90, 'Random Blood Sugar', 60, '60', 1, 1, 0, NULL, NULL, 1, NULL, NULL),
(91, 'RFT', 750, '420', 1, 1, 0, NULL, NULL, 1, NULL, NULL),
(92, 'SGOT AST Serum', 200, '166', 1, 1, 0, NULL, NULL, 1, NULL, NULL),
(93, 'SGPT ALT Serum', 200, '166', 1, 1, 0, NULL, NULL, 1, NULL, NULL),
(94, 'Sodium ISE Serum', 220, '220', 1, 1, 0, NULL, NULL, 1, NULL, NULL),
(95, 'SYPHILIS', 1485, '1004', 1, 1, 0, NULL, NULL, 1, NULL, NULL),
(96, 'T3 (Triiodothyronine ) Total Serum by CLIA', 235, '166', 1, 1, 0, NULL, NULL, 1, NULL, NULL),
(97, 'T4 (Thyroxine) Total  Serum by CLIA', 235, '166', 1, 1, 0, NULL, NULL, 1, NULL, NULL),
(98, 'Testosterone', 500, '309', 1, 1, 0, NULL, NULL, 1, NULL, NULL),
(99, 'Thyroid panel-1 Total', 450, '188', 1, 1, 0, NULL, NULL, 1, NULL, NULL),
(100, 'Thyroid panel-2 Free', 650, '309', 1, 1, 0, NULL, NULL, 1, NULL, NULL),
(101, 'Torch 8', 2300, '1190', 1, 1, 0, NULL, NULL, 1, NULL, NULL),
(102, 'Triglycerides', 180, '180', 1, 1, 0, NULL, NULL, 1, NULL, NULL),
(103, 'TRUHEALTH DIAMOND ADVANCE BODY PROFILE', 2699, '2399', 1, 1, 0, NULL, NULL, 1, NULL, NULL),
(104, 'TRUHEALTH DIAMOND BODY PROFILE', 1849, '1572', 1, 1, 0, NULL, NULL, 1, NULL, NULL),
(105, 'TRUHEALTH GOLD BODY PROFILE', 1199, '1079', 1, 1, 0, NULL, NULL, 1, NULL, NULL),
(106, 'TRUHEALTH PLATINUM BODY PROFILE', 1649, '1349', 1, 1, 0, NULL, NULL, 1, NULL, NULL),
(107, 'TRUHEALTH SILVER BODY PROFILE', 999, '999', 1, 1, 0, NULL, NULL, 1, NULL, NULL),
(108, 'TRUHEALTH WOMENS\' BODY PROFILE', 2999, '2699', 1, 1, 0, NULL, NULL, 1, NULL, NULL),
(109, 'TSH-Ultrasensitive', 280, '144', 1, 1, 0, NULL, NULL, 1, NULL, NULL),
(110, 'Uric Acid  Serum', 260, '230', 1, 1, 0, NULL, NULL, 1, NULL, NULL),
(111, 'URINE - CS', 800, '600', 1, 1, 0, NULL, NULL, 1, NULL, NULL),
(112, 'URINE-RM', 120, '120', 1, 1, 0, NULL, NULL, 1, NULL, NULL),
(113, 'Vitamin B12', 600, '440', 1, 1, 0, NULL, NULL, 1, NULL, NULL),
(114, 'Vitamin D Total-25 Hydroxy', 1100, '660', 1, 1, 0, NULL, NULL, 1, NULL, NULL),
(115, 'Widal Test for Typhoid Serum', 250, '250', 1, 1, 0, NULL, NULL, 1, NULL, NULL),
(128, 'FOOD ONLY', 1800, '1620', 2, 1, 0, NULL, NULL, 1, NULL, NULL),
(129, 'NON-VEG ONLY', 1200, '1080', 2, 1, 0, NULL, NULL, 1, NULL, NULL),
(130, 'INHALENT ONLY', 1500, '1350', 2, 1, 0, NULL, NULL, 1, NULL, NULL),
(131, 'DRUG ONLY', 2000, '1800', 2, 1, 0, NULL, NULL, 1, NULL, NULL),
(132, 'FOOD + NON-VEG', 3000, '2700', 2, 1, 0, NULL, NULL, 1, NULL, NULL),
(133, 'FOOD + DRUG', 3800, '3420', 2, 1, 0, NULL, NULL, 1, NULL, NULL),
(134, 'FOOD + INHALENT', 2200, '1980', 2, 1, 0, NULL, NULL, 1, NULL, NULL),
(135, 'FOOD + INHALENT + NON-VEG', 3200, '2880', 2, 1, 0, NULL, NULL, 1, NULL, NULL),
(136, 'FOOD + INHALENT + DRUG', 3700, '3330', 2, 1, 0, NULL, NULL, 1, NULL, NULL),
(137, 'FOOD + INHALENT + NON-VEG + DRUG', 5000, '4250', 2, 1, 0, NULL, NULL, 1, NULL, NULL),
(143, '25 OH Cholecalciferol (D2+D3)', 1400, '750', 3, 1, 0, NULL, NULL, 1, NULL, NULL),
(144, 'Absolute Eosinophil Count', 300, '200', 3, 1, 0, NULL, NULL, 1, NULL, NULL),
(145, 'ACTH Level [Adrenocorticotropic hormone]', 1300, '1000', 3, 1, 0, NULL, NULL, 1, NULL, NULL),
(146, 'ADH - Anti Diuretic Hormone', 4100, '4070', 3, 1, 0, NULL, NULL, 1, NULL, NULL),
(147, 'Alkaline Phosphatase level', 250, '200', 3, 1, 0, NULL, NULL, 1, NULL, NULL),
(148, 'Ammonia', 600, '440', 3, 1, 0, NULL, NULL, 1, NULL, NULL),
(149, 'Amylase-Serum', 600, '330', 3, 1, 0, NULL, NULL, 1, NULL, NULL),
(150, 'ANA 25', 3800, '2900', 3, 1, 0, NULL, NULL, 1, NULL, NULL),
(151, 'ANA PROFILE (Auto antibody profile)', 4350, '3300', 3, 1, 0, NULL, NULL, 1, NULL, NULL),
(152, 'Anti CCP Level', 1000, '880', 3, 1, 0, NULL, NULL, 1, NULL, NULL),
(153, 'Anti ds DNA (IIF)', 1400, '880', 3, 1, 0, NULL, NULL, 1, NULL, NULL),
(154, 'Anti Mullerian Hormone -(AMH)', 2000, '1350', 3, 1, 0, NULL, NULL, 1, NULL, NULL),
(155, 'Anti Nuclear Antibody ( IIF )', 800, '550', 3, 1, 0, NULL, NULL, 1, NULL, NULL),
(156, 'Anti Nuclear antibody-FEIA/ELISA', 800, '800', 3, 1, 0, NULL, NULL, 1, NULL, NULL),
(157, 'Anti Thyroid Antibody', 1200, '900', 3, 1, 0, NULL, NULL, 1, NULL, NULL),
(158, 'Apolipoprotein A - 1', 500, '360', 3, 1, 0, NULL, NULL, 1, NULL, NULL),
(159, 'Apolipoprotein A-1+B', 800, '715', 3, 1, 0, NULL, NULL, 1, NULL, NULL),
(160, 'Apolipoprotein B', 500, '360', 3, 1, 0, NULL, NULL, 1, NULL, NULL),
(161, 'Beta HCG level', 600, '330', 3, 1, 0, NULL, NULL, 1, NULL, NULL),
(162, 'Bicarbonate', 500, '440', 3, 1, 0, NULL, NULL, 1, NULL, NULL),
(163, 'Blood Gas (Arterial)', 1200, '1100', 3, 1, 0, NULL, NULL, 1, NULL, NULL),
(164, 'Blood Gas (Venous)', 1200, '1100', 3, 1, 0, NULL, NULL, 1, NULL, NULL),
(165, 'Blood Group & RH', 200, '200', 3, 1, 0, NULL, NULL, 1, NULL, NULL),
(166, 'Blood Urea Nitrogen (BUN)', 250, '200', 3, 1, 0, NULL, NULL, 1, NULL, NULL),
(167, 'C- Reactive Protein', 450, '385', 3, 1, 0, NULL, NULL, 1, NULL, NULL),
(168, 'CA-125 level', 800, '550', 3, 1, 0, NULL, NULL, 1, NULL, NULL),
(169, 'CA-15-3 level', 1200, '770', 3, 1, 0, NULL, NULL, 1, NULL, NULL),
(170, 'CA-19-9 level', 1200, '880', 3, 1, 0, NULL, NULL, 1, NULL, NULL),
(171, 'Calcitonin level', 1300, '1100', 3, 1, 0, NULL, NULL, 1, NULL, NULL),
(172, 'Calcium', 250, '200', 3, 1, 0, NULL, NULL, 1, NULL, NULL),
(173, 'Carcino Embryonic Antigen level', 800, '440', 3, 1, 0, NULL, NULL, 1, NULL, NULL),
(174, 'Chikungunya antibody (IgG+IgM)-FIA', 800, '800', 3, 1, 0, NULL, NULL, 1, NULL, NULL),
(175, 'Chikungunya antibody IgM', 800, '715', 3, 1, 0, NULL, NULL, 1, NULL, NULL),
(176, 'Chikungunya IgG-Rapid', 500, '500', 3, 1, 0, NULL, NULL, 1, NULL, NULL),
(177, 'Chikungunya IgM-Rapid', 500, '500', 3, 1, 0, NULL, NULL, 1, NULL, NULL),
(178, 'Chikungunya Qualitative by Real-time PCR', 2200, '1870', 3, 1, 0, NULL, NULL, 1, NULL, NULL),
(179, 'Chikungunya Viral Load (Quantitative)', 2500, '2420', 3, 1, 0, NULL, NULL, 1, NULL, NULL),
(180, 'Chloride', 250, '200', 3, 1, 0, NULL, NULL, 1, NULL, NULL),
(181, 'Cholesterol', 250, '200', 3, 1, 0, NULL, NULL, 1, NULL, NULL),
(182, 'Clotting Time', 100, '100', 3, 1, 0, NULL, NULL, 1, NULL, NULL),
(183, 'Cortisol 8 AM', 700, '550', 3, 1, 0, NULL, NULL, 1, NULL, NULL),
(184, 'Cortisol level- Random', 700, '550', 3, 1, 0, NULL, NULL, 1, NULL, NULL),
(185, 'Cortisol PM', 700, '550', 3, 1, 0, NULL, NULL, 1, NULL, NULL),
(186, 'C-Peptide level', 1300, '770', 3, 1, 0, NULL, NULL, 1, NULL, NULL),
(187, 'CPK Total', 700, '500', 3, 1, 0, NULL, NULL, 1, NULL, NULL),
(188, 'CPK-MB level', 700, '700', 3, 1, 0, NULL, NULL, 1, NULL, NULL),
(189, 'Creatinine', 250, '200', 3, 1, 0, NULL, NULL, 1, NULL, NULL),
(190, 'Dengue and Chikungunya PCR combo', 3000, '2850', 3, 1, 0, NULL, NULL, 1, NULL, NULL),
(191, 'Dengue antibody IgG - ELISA', 700, '495', 3, 1, 0, NULL, NULL, 1, NULL, NULL),
(192, 'Dengue antibody IgG & IgM-Elisa', 1400, '1320', 3, 1, 0, NULL, NULL, 1, NULL, NULL),
(193, 'Dengue antibody IgG & IgM-FIA', 1400, '1320', 3, 1, 0, NULL, NULL, 1, NULL, NULL),
(194, 'Dengue antibody IgG-Rapid', 700, '550', 3, 1, 0, NULL, NULL, 1, NULL, NULL),
(195, 'Dengue antibody IgM - ELISA', 700, '495', 3, 1, 0, NULL, NULL, 1, NULL, NULL),
(196, 'Dengue antibody IgM-Rapid', 700, '550', 3, 1, 0, NULL, NULL, 1, NULL, NULL),
(197, 'Dengue antibody-Rapid', 700, '550', 3, 1, 0, NULL, NULL, 1, NULL, NULL),
(198, 'Dengue Antigen (NS1)- Rapid', 700, '700', 3, 1, 0, NULL, NULL, 1, NULL, NULL),
(199, 'Dengue Antigen NS1 Elisa', 700, '700', 3, 1, 0, NULL, NULL, 1, NULL, NULL),
(200, 'Dengue antigen NS1-FIA', 700, '700', 3, 1, 0, NULL, NULL, 1, NULL, NULL),
(201, 'Dengue Qualitative by Real-time PCR', 2200, '1870', 3, 1, 0, NULL, NULL, 1, NULL, NULL),
(202, 'Dengue Rapid(NS1+Antibody)', 900, '900', 3, 1, 0, NULL, NULL, 1, NULL, NULL),
(203, 'DHEA-S', 750, '605', 3, 1, 0, NULL, NULL, 1, NULL, NULL),
(204, 'DHR', 4000, '3520', 3, 1, 0, NULL, NULL, 1, NULL, NULL),
(205, 'Diabetes Panel 1 - NIDDM 1', 150, '150', 3, 1, 0, NULL, NULL, 1, NULL, NULL),
(206, 'Digoxin Level (TDM)', 800, '770', 3, 1, 0, NULL, NULL, 1, NULL, NULL),
(207, 'Dihydrotestosterone level', 1500, '1320', 3, 1, 0, NULL, NULL, 1, NULL, NULL),
(208, 'Dilantin (Phenytoin) level (TDM)', 800, '605', 3, 1, 0, NULL, NULL, 1, NULL, NULL),
(209, 'DMD (Duchenne Muscular Dystrophy) deletion/du', 8000, '7000', 3, 1, 0, NULL, NULL, 1, NULL, NULL),
(210, 'DNA Fingerprint (Autosomal STR)', 9000, '8500', 3, 1, 0, NULL, NULL, 1, NULL, NULL),
(211, 'Double Marker', 1750, '1320', 3, 1, 0, NULL, NULL, 1, NULL, NULL),
(212, 'Double marker by Astraia', 2250, '2145', 3, 1, 0, NULL, NULL, 1, NULL, NULL),
(213, 'Double marker by Delfia Xpress', 2250, '2145', 3, 1, 0, NULL, NULL, 1, NULL, NULL),
(214, 'Double marker by DELFIA-Smart report', 2250, '2145', 3, 1, 0, NULL, NULL, 1, NULL, NULL),
(215, 'Double Marker with Delfia Graph', 2250, '2145', 3, 1, 0, NULL, NULL, 1, NULL, NULL),
(216, 'Double marker with PlGF-Astraia', 3200, '2640', 3, 1, 0, NULL, NULL, 1, NULL, NULL),
(217, 'Double marker with PlGF-Delfia', 3200, '2640', 3, 1, 0, NULL, NULL, 1, NULL, NULL),
(218, 'DSA by Luminex (HLA Cross Match)', 6000, '5720', 3, 1, 0, NULL, NULL, 1, NULL, NULL),
(219, 'DsDNA antibody IgG', 1400, '880', 3, 1, 0, NULL, NULL, 1, NULL, NULL),
(220, 'E GFR (MDRD) (Calc)', 300, '275', 3, 1, 0, NULL, NULL, 1, NULL, NULL),
(221, 'Estradiol level', 550, '330', 3, 1, 0, NULL, NULL, 1, NULL, NULL),
(222, 'Fasting Insulin & Glucose', 850, '484', 3, 1, 0, NULL, NULL, 1, NULL, NULL),
(223, 'Ferritin', 600, '330', 3, 1, 0, NULL, NULL, 1, NULL, NULL),
(224, 'Free Beta HCG level', 1000, '770', 3, 1, 0, NULL, NULL, 1, NULL, NULL),
(225, 'Free Kappa Chain', 2100, '2100', 3, 1, 0, NULL, NULL, 1, NULL, NULL),
(226, 'Free Kappa Lambda Chain Ratio', 3500, '3300', 3, 1, 0, NULL, NULL, 1, NULL, NULL),
(227, 'Free Lambda Chain', 2100, '2100', 3, 1, 0, NULL, NULL, 1, NULL, NULL),
(228, 'Free Prostate Specific Antigen', 1000, '605', 3, 1, 0, NULL, NULL, 1, NULL, NULL),
(229, 'Free Testosterone', 1200, '1100', 3, 1, 0, NULL, NULL, 1, NULL, NULL),
(230, 'Free Thyroxine(Free T4)', 300, '209', 3, 1, 0, NULL, NULL, 1, NULL, NULL),
(231, 'Free Triiodothyronine(Free T3)', 300, '209', 3, 1, 0, NULL, NULL, 1, NULL, NULL),
(232, 'Fungus Culture', 1200, '770', 3, 1, 0, NULL, NULL, 1, NULL, NULL),
(233, 'G6PD', 400, '374', 3, 1, 0, NULL, NULL, 1, NULL, NULL),
(234, 'G6PD Qualitative', 450, '374', 3, 1, 0, NULL, NULL, 1, NULL, NULL),
(235, 'G6PD Quantitative', 550, '374', 3, 1, 0, NULL, NULL, 1, NULL, NULL),
(236, 'GAD Antibody', 2000, '2000', 3, 1, 0, NULL, NULL, 1, NULL, NULL),
(237, 'Gamma Glutamyl Transferase (GGT)', 250, '250', 3, 1, 0, NULL, NULL, 1, NULL, NULL),
(238, 'Glucose - Fasting', 80, '80', 3, 1, 0, NULL, NULL, 1, NULL, NULL),
(239, 'Glucose - Post Dinner', 80, '80', 3, 1, 0, NULL, NULL, 1, NULL, NULL),
(240, 'Glucose - Post Prandial', 80, '80', 3, 1, 0, NULL, NULL, 1, NULL, NULL),
(241, 'Glucose - Pre Dinner', 80, '80', 3, 1, 0, NULL, NULL, 1, NULL, NULL),
(242, 'Glucose - Random', 80, '80', 3, 1, 0, NULL, NULL, 1, NULL, NULL),
(243, 'Glyco Hemoglobin (HbA1c)', 600, '275', 3, 1, 0, NULL, NULL, 1, NULL, NULL),
(244, 'GTT 3 Samples', 250, '250', 3, 1, 0, NULL, NULL, 1, NULL, NULL),
(245, 'GTT Extended (5 samples)', 400, '400', 3, 1, 0, NULL, NULL, 1, NULL, NULL),
(246, 'H.Pylori antibody IgA', 450, '440', 3, 1, 0, NULL, NULL, 1, NULL, NULL),
(247, 'H.Pylori antibody IgG', 450, '440', 3, 1, 0, NULL, NULL, 1, NULL, NULL),
(248, 'H.Pylori antibody IgM', 450, '440', 3, 1, 0, NULL, NULL, 1, NULL, NULL),
(249, 'Haemogram (CBC) LAB', 350, '245', 3, 1, 0, NULL, NULL, 1, NULL, NULL),
(250, 'Haemogram and Malaria Parasite (CBC-MP)', 450, '350', 3, 1, 0, NULL, NULL, 1, NULL, NULL),
(251, 'Haemogram with ESR (CBC-ESR)', 450, '440', 3, 1, 0, NULL, NULL, 1, NULL, NULL),
(252, 'HAV antibody IgM', 800, '660', 3, 1, 0, NULL, NULL, 1, NULL, NULL),
(253, 'HB Electrophoresis (Capillary)', 800, '605', 3, 1, 0, NULL, NULL, 1, NULL, NULL),
(254, 'HBs antibody', 800, '495', 3, 1, 0, NULL, NULL, 1, NULL, NULL),
(255, 'HBsAg', 300, '220', 3, 1, 0, NULL, NULL, 1, NULL, NULL),
(256, 'HBV (Hepatitis B) Qualitative by Real-time PC', 1800, '1800', 3, 1, 0, NULL, NULL, 1, NULL, NULL),
(257, 'HBV (Hepatitis B) Quantitative by Real-time P', 2500, '2500', 3, 1, 0, NULL, NULL, 1, NULL, NULL),
(258, 'HCV (Hepatitis C) Qualitative by Real-time PC', 1800, '1800', 3, 1, 0, NULL, NULL, 1, NULL, NULL),
(259, 'HCV (Hepatitis C) Quantitative by Real-time P', 2500, '2500', 3, 1, 0, NULL, NULL, 1, NULL, NULL),
(260, 'HCV antibody IgM', 1450, '1450', 3, 1, 0, NULL, NULL, 1, NULL, NULL),
(261, 'HCV antibody Total', 800, '660', 3, 1, 0, NULL, NULL, 1, NULL, NULL),
(262, 'High Sensitive CRP', 400, '400', 3, 1, 0, NULL, NULL, 1, NULL, NULL),
(263, 'HIV I & II', 600, '330', 3, 1, 0, NULL, NULL, 1, NULL, NULL),
(264, 'HLA B 27 By Real-time PCR', 2500, '1870', 3, 1, 0, NULL, NULL, 1, NULL, NULL),
(265, 'HLAb 27 By Flowcytometry', 2000, '1540', 3, 1, 0, NULL, NULL, 1, NULL, NULL),
(266, 'Homa IR (Mass Unit)', 1000, '880', 3, 1, 0, NULL, NULL, 1, NULL, NULL),
(267, 'Homocysteine level', 1200, '880', 3, 1, 0, NULL, NULL, 1, NULL, NULL),
(268, 'IgA level', 600, '440', 3, 1, 0, NULL, NULL, 1, NULL, NULL),
(269, 'IgE level', 600, '330', 3, 1, 0, NULL, NULL, 1, NULL, NULL),
(270, 'IgG level', 600, '440', 3, 1, 0, NULL, NULL, 1, NULL, NULL),
(271, 'IgH By FISH', 3500, '3500', 3, 1, 0, NULL, NULL, 1, NULL, NULL),
(272, 'IgM level', 600, '440', 3, 1, 0, NULL, NULL, 1, NULL, NULL),
(273, 'IL-6 level', 2000, '1210', 3, 1, 0, NULL, NULL, 1, NULL, NULL),
(274, 'Insulin Fasting', 800, '440', 3, 1, 0, NULL, NULL, 1, NULL, NULL),
(275, 'Insulin Random', 800, '440', 3, 1, 0, NULL, NULL, 1, NULL, NULL),
(276, 'Ionic Calcium', 600, '308', 3, 1, 0, NULL, NULL, 1, NULL, NULL),
(277, 'Iron Level', 500, '275', 3, 1, 0, NULL, NULL, 1, NULL, NULL),
(278, 'Iron Studies (TIBC)', 600, '495', 3, 1, 0, NULL, NULL, 1, NULL, NULL),
(279, 'LDH', 600, '374', 3, 1, 0, NULL, NULL, 1, NULL, NULL),
(280, 'LDL Cholesterol (Direct)', 250, '250', 3, 1, 0, NULL, NULL, 1, NULL, NULL),
(281, 'Leutinizing Hormone level', 550, '209', 3, 1, 0, NULL, NULL, 1, NULL, NULL),
(282, 'Lipid Profile', 700, '418', 3, 1, 0, NULL, NULL, 1, NULL, NULL),
(283, 'Lipoprotein (a)', 800, '660', 3, 1, 0, NULL, NULL, 1, NULL, NULL),
(284, 'Liver Function Test', 1000, '880', 3, 1, 0, NULL, NULL, 1, NULL, NULL),
(285, 'Magnesium Level', 450, '264', 3, 1, 0, NULL, NULL, 1, NULL, NULL),
(286, 'Major Pre Operative Profile', 1850, '1540', 3, 1, 0, NULL, NULL, 1, NULL, NULL),
(287, 'Malarial parasite (  smear )', 200, '200', 3, 1, 0, NULL, NULL, 1, NULL, NULL),
(288, 'Minor Pre Operative Profile', 1450, '1320', 3, 1, 0, NULL, NULL, 1, NULL, NULL),
(289, 'Occult Blood', 150, '150', 3, 1, 0, NULL, NULL, 1, NULL, NULL),
(290, 'Para Thyroid Hormone Intact level', 900, '770', 3, 1, 0, NULL, NULL, 1, NULL, NULL),
(291, 'Potassium', 250, '200', 3, 1, 0, NULL, NULL, 1, NULL, NULL),
(292, 'Procalcitonin', 2400, '1980', 3, 1, 0, NULL, NULL, 1, NULL, NULL),
(293, 'Progesterone level', 600, '275', 3, 1, 0, NULL, NULL, 1, NULL, NULL),
(294, 'Prolactin level', 550, '209', 3, 1, 0, NULL, NULL, 1, NULL, NULL),
(295, 'Prostate Specific Antigen level', 700, '418', 3, 1, 0, NULL, NULL, 1, NULL, NULL),
(296, 'Protein With A/G Ratio', 250, '200', 3, 1, 0, NULL, NULL, 1, NULL, NULL),
(297, 'Prothrombin Time (Photooptical clot detection', 300, '198', 3, 1, 0, NULL, NULL, 1, NULL, NULL),
(298, 'PSA Profile (Free PSA/PSA Ratio)', 1400, '770', 3, 1, 0, NULL, NULL, 1, NULL, NULL),
(299, 'Rapid Malarial Antigen ( Card )', 450, '330', 3, 1, 0, NULL, NULL, 1, NULL, NULL),
(300, 'Rapid Plasma Reagin (VDRL)', 400, '220', 3, 1, 0, NULL, NULL, 1, NULL, NULL),
(301, 'RBC', 100, '100', 3, 1, 0, NULL, NULL, 1, NULL, NULL),
(302, 'Renal Function Test', 900, '770', 3, 1, 0, NULL, NULL, 1, NULL, NULL),
(303, 'Rheumatoid Factor', 400, '330', 3, 1, 0, NULL, NULL, 1, NULL, NULL),
(304, 'SGOT (AST)', 250, '200', 3, 1, 0, NULL, NULL, 1, NULL, NULL),
(305, 'SGPT (ALT)', 250, '200', 3, 1, 0, NULL, NULL, 1, NULL, NULL),
(306, 'Sodium', 250, '200', 3, 1, 0, NULL, NULL, 1, NULL, NULL),
(307, 'Stool Examination', 250, '242', 3, 1, 0, NULL, NULL, 1, NULL, NULL),
(308, 'Syphilis Antibody', 400, '330', 3, 1, 0, NULL, NULL, 1, NULL, NULL),
(309, 'Testosterone level', 550, '297', 3, 1, 0, NULL, NULL, 1, NULL, NULL),
(310, 'Thyroglobulin antibody', 600, '330', 3, 1, 0, NULL, NULL, 1, NULL, NULL),
(311, 'Thyroglobulin level', 1300, '1100', 3, 1, 0, NULL, NULL, 1, NULL, NULL),
(312, 'Thyroid Function Test', 600, '231', 3, 1, 0, NULL, NULL, 1, NULL, NULL),
(313, 'Thyroperoxidase Antibody (Anti-TPO)/Microsoma', 600, '440', 3, 1, 0, NULL, NULL, 1, NULL, NULL),
(314, 'Thyroxine Binding Globulin level', 1000, '1000', 3, 1, 0, NULL, NULL, 1, NULL, NULL),
(315, 'Thyroxine -T4', 200, '180', 3, 1, 0, NULL, NULL, 1, NULL, NULL),
(316, 'Tissue Transglutaminase antibody IgA (TTG-A)', 850, '850', 3, 1, 0, NULL, NULL, 1, NULL, NULL),
(317, 'Tissue Transglutaminase antibody IgG & IgA', 1500, '1320', 3, 1, 0, NULL, NULL, 1, NULL, NULL),
(318, 'Torch Complex (10 Parameters)', 2800, '1800', 3, 1, 0, NULL, NULL, 1, NULL, NULL),
(319, 'Torch Complex (8 parameters)', 2500, '1500', 3, 1, 0, NULL, NULL, 1, NULL, NULL),
(320, 'Torch IgG', 1250, '605', 3, 1, 0, NULL, NULL, 1, NULL, NULL),
(321, 'Torch IgM', 1250, '605', 3, 1, 0, NULL, NULL, 1, NULL, NULL),
(322, 'TORCH Infections Qualitative by Real-Time PCR', 4000, '3740', 3, 1, 0, NULL, NULL, 1, NULL, NULL),
(323, 'Total Kappa Light Chain', 1800, '1540', 3, 1, 0, NULL, NULL, 1, NULL, NULL),
(324, 'Total Lambada Light Chain', 1500, '1320', 3, 1, 0, NULL, NULL, 1, NULL, NULL),
(325, 'Transferrin Saturation', 600, '594', 3, 1, 0, NULL, NULL, 1, NULL, NULL),
(326, 'Triglyceride', 250, '250', 3, 1, 0, NULL, NULL, 1, NULL, NULL),
(327, 'Triiodothyronine - T3', 200, '180', 3, 1, 0, NULL, NULL, 1, NULL, NULL),
(328, 'Troponin I', 1000, '605', 3, 1, 0, NULL, NULL, 1, NULL, NULL),
(329, 'Troponin T', 1000, '605', 3, 1, 0, NULL, NULL, 1, NULL, NULL),
(330, 'TSH', 250, '165', 3, 1, 0, NULL, NULL, 1, NULL, NULL),
(331, 'Unsaturated Iron Binding Capacity', 250, '250', 3, 1, 0, NULL, NULL, 1, NULL, NULL),
(332, 'Urea', 250, '200', 3, 1, 0, NULL, NULL, 1, NULL, NULL),
(333, 'Uric Acid', 250, '200', 3, 1, 0, NULL, NULL, 1, NULL, NULL),
(334, 'Urinary Albumin Creatinine ratio UACR', 850, '440', 3, 1, 0, NULL, NULL, 1, NULL, NULL),
(335, 'Urinary Protein Creatinine Ratio', 350, '350', 3, 1, 0, NULL, NULL, 1, NULL, NULL),
(336, 'Urine Examination -U ( Flow Cytometry )', 170, '170', 3, 1, 0, NULL, NULL, 1, NULL, NULL),
(337, 'Valproic acid (TDM)', 800, '550', 3, 1, 0, NULL, NULL, 1, NULL, NULL),
(338, 'Vancomycin level', 4000, '4000', 3, 1, 0, NULL, NULL, 1, NULL, NULL),
(339, 'Vitamin B - 12 Level', 900, '418', 3, 1, 0, NULL, NULL, 1, NULL, NULL),
(340, 'VLDL Cholesterol', 100, '100', 3, 1, 0, NULL, NULL, 1, NULL, NULL),
(341, 'Voriconazole Level (TDM)', 3800, '3800', 3, 1, 0, NULL, NULL, 1, NULL, NULL),
(342, 'WIDAL by tube method', 300, '187', 3, 1, 0, NULL, NULL, 1, NULL, NULL),
(343, 'Y-Chromosomal Microdeletion by PCR', 4500, '4500', 3, 1, 0, NULL, NULL, 1, NULL, NULL),
(344, 'ZIKA Qualitative by Real-time PCR', 2500, '2500', 3, 1, 0, NULL, NULL, 1, NULL, NULL),
(345, '', 0, ' ', 3, 1, 0, NULL, NULL, 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `Lab_Test_Report_Amount`
--

CREATE TABLE `Lab_Test_Report_Amount` (
  `Lab_Test_Report_Amount_id` int(11) NOT NULL,
  `Lab_Master_id` int(11) DEFAULT '0',
  `Lab_Test_category_id` int(11) DEFAULT '0',
  `Lab_Test_Master_id` int(11) DEFAULT '0',
  `MRP` int(11) DEFAULT '0',
  `Discount` decimal(10,2) DEFAULT NULL,
  `DiscountAmount` int(11) DEFAULT '0',
  `NetAmount` int(255) NOT NULL DEFAULT '0',
  `planId` int(11) DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `iStatus` int(11) DEFAULT '1',
  `isDelete` int(11) DEFAULT '0',
  `strIP` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `Lab_Test_Report_Amount`
--

INSERT INTO `Lab_Test_Report_Amount` (`Lab_Test_Report_Amount_id`, `Lab_Master_id`, `Lab_Test_category_id`, `Lab_Test_Master_id`, `MRP`, `Discount`, `DiscountAmount`, `NetAmount`, `planId`, `created_at`, `updated_at`, `iStatus`, `isDelete`, `strIP`) VALUES
(1, 1, 1, 1, 750, 14.67, 110, 640, 10, NULL, NULL, 1, 0, NULL),
(2, 1, 1, 2, 650, 18.62, 121, 529, 10, NULL, NULL, 1, 0, NULL),
(3, 1, 1, 3, 170, 0.00, 0, 170, 10, NULL, NULL, 1, 0, NULL),
(4, 1, 1, 4, 1800, 40.00, 720, 1080, 10, NULL, NULL, 1, 0, NULL),
(5, 1, 1, 5, 400, 33.75, 135, 265, 10, NULL, NULL, 1, 0, NULL),
(6, 1, 1, 6, 1020, 37.25, 380, 640, 10, NULL, NULL, 1, 0, NULL),
(7, 1, 1, 7, 1100, 21.82, 240, 860, 10, NULL, NULL, 1, 0, NULL),
(8, 1, 1, 8, 2000, 24.00, 480, 1520, 10, NULL, NULL, 1, 0, NULL),
(9, 1, 1, 9, 1200, 42.08, 505, 695, 10, NULL, NULL, 1, 0, NULL),
(10, 1, 1, 10, 350, 8.57, 30, 320, 10, NULL, NULL, 1, 0, NULL),
(11, 1, 1, 11, 170, 0.00, 0, 170, 10, NULL, NULL, 1, 0, NULL),
(12, 1, 1, 12, 220, 0.00, 0, 220, 10, NULL, NULL, 1, 0, NULL),
(13, 1, 1, 13, 195, 0.00, 0, 195, 10, NULL, NULL, 1, 0, NULL),
(14, 1, 1, 14, 440, 39.77, 175, 265, 10, NULL, NULL, 1, 0, NULL),
(15, 1, 1, 15, 1340, 19.03, 255, 1085, 10, NULL, NULL, 1, 0, NULL),
(16, 1, 1, 16, 1000, 3.00, 30, 970, 10, NULL, NULL, 1, 0, NULL),
(17, 1, 1, 17, 900, 28.89, 260, 640, 10, NULL, NULL, 1, 0, NULL),
(18, 1, 1, 18, 230, 0.00, 0, 230, 10, NULL, NULL, 1, 0, NULL),
(19, 1, 1, 19, 370, 26.49, 98, 272, 10, NULL, NULL, 1, 0, NULL),
(20, 1, 1, 20, 260, 23.46, 61, 199, 10, NULL, NULL, 1, 0, NULL),
(21, 1, 1, 21, 400, 33.75, 135, 265, 10, NULL, NULL, 1, 0, NULL),
(22, 1, 1, 22, 2555, 29.04, 742, 1813, 10, NULL, NULL, 1, 0, NULL),
(23, 1, 1, 23, 1110, 15.95, 177, 933, 10, NULL, NULL, 1, 0, NULL),
(24, 1, 1, 24, 570, 14.91, 85, 485, 10, NULL, NULL, 1, 0, NULL),
(25, 1, 1, 25, 215, 0.00, 0, 215, 10, NULL, NULL, 1, 0, NULL),
(26, 1, 1, 26, 170, 0.00, 0, 170, 10, NULL, NULL, 1, 0, NULL),
(27, 1, 1, 27, 640, 41.41, 265, 375, 10, NULL, NULL, 1, 0, NULL),
(28, 1, 1, 28, 1180, 17.03, 201, 979, 10, NULL, NULL, 1, 0, NULL),
(29, 1, 1, 29, 460, 19.57, 90, 370, 10, NULL, NULL, 1, 0, NULL),
(30, 1, 1, 30, 535, 14.95, 80, 455, 10, NULL, NULL, 1, 0, NULL),
(31, 1, 1, 31, 170, 0.00, 0, 170, 10, NULL, NULL, 1, 0, NULL),
(32, 1, 1, 32, 1290, 18.53, 239, 1051, 10, NULL, NULL, 1, 0, NULL),
(33, 1, 1, 33, 650, 23.85, 155, 495, 10, NULL, NULL, 1, 0, NULL),
(34, 1, 1, 34, 650, 23.85, 155, 495, 10, NULL, NULL, 1, 0, NULL),
(35, 1, 1, 35, 800, 13.13, 105, 695, 10, NULL, NULL, 1, 0, NULL),
(36, 1, 1, 36, 2000, 18.50, 370, 1630, 10, NULL, NULL, 1, 0, NULL),
(37, 1, 1, 37, 500, 36.00, 180, 320, 10, NULL, NULL, 1, 0, NULL),
(38, 1, 1, 38, 500, 41.00, 205, 295, 10, NULL, NULL, 1, 0, NULL),
(39, 1, 1, 39, 110, 0.00, 0, 110, 10, NULL, NULL, 1, 0, NULL),
(40, 1, 1, 40, 60, 0.00, 0, 60, 10, NULL, NULL, 1, 0, NULL),
(41, 1, 1, 41, 800, 40.63, 325, 475, 10, NULL, NULL, 1, 0, NULL),
(42, 1, 1, 42, 1180, 41.10, 485, 695, 10, NULL, NULL, 1, 0, NULL),
(43, 1, 1, 43, 220, 4.55, 10, 210, 10, NULL, NULL, 1, 0, NULL),
(44, 1, 1, 44, 220, 4.55, 10, 210, 10, NULL, NULL, 1, 0, NULL),
(45, 1, 1, 45, 270, 22.22, 60, 210, 10, NULL, NULL, 1, 0, NULL),
(46, 1, 1, 46, 850, 37.65, 320, 530, 10, NULL, NULL, 1, 0, NULL),
(47, 1, 1, 47, 1200, 51.25, 615, 585, 10, NULL, NULL, 1, 0, NULL),
(48, 1, 1, 48, 130, 0.00, 0, 130, 10, NULL, NULL, 1, 0, NULL),
(49, 1, 1, 49, 270, 0.00, 0, 270, 10, NULL, NULL, 1, 0, NULL),
(50, 1, 1, 50, 120, 0.00, 0, 120, 10, NULL, NULL, 1, 0, NULL),
(51, 1, 1, 51, 700, 8.57, 60, 640, 10, NULL, NULL, 1, 0, NULL),
(52, 1, 1, 52, 500, 40.40, 202, 298, 10, NULL, NULL, 1, 0, NULL),
(53, 1, 1, 53, 450, 41.11, 185, 265, 10, NULL, NULL, 1, 0, NULL),
(54, 1, 1, 54, 460, 11.96, 55, 405, 10, NULL, NULL, 1, 0, NULL),
(55, 1, 1, 55, 800, 47.50, 380, 420, 10, NULL, NULL, 1, 0, NULL),
(56, 1, 1, 56, 7800, 50.00, 3900, 3900, 10, NULL, NULL, 1, 0, NULL),
(57, 1, 1, 57, 560, 52.68, 295, 265, 10, NULL, NULL, 1, 0, NULL),
(58, 1, 1, 58, 2450, 51.43, 1260, 1190, 10, NULL, NULL, 1, 0, NULL),
(59, 1, 1, 59, 1000, 25.00, 250, 750, 10, NULL, NULL, 1, 0, NULL),
(60, 1, 1, 60, 600, 19.17, 115, 485, 10, NULL, NULL, 1, 0, NULL),
(61, 1, 1, 61, 775, 8.39, 65, 710, 10, NULL, NULL, 1, 0, NULL),
(62, 1, 1, 62, 600, 17.33, 104, 496, 10, NULL, NULL, 1, 0, NULL),
(63, 1, 1, 63, 3200, 27.75, 888, 2312, 10, NULL, NULL, 1, 0, NULL),
(64, 1, 1, 64, 650, 16.92, 110, 540, 10, NULL, NULL, 1, 0, NULL),
(65, 1, 1, 65, 645, 27.60, 178, 467, 10, NULL, NULL, 1, 0, NULL),
(66, 1, 1, 66, 405, 31.85, 129, 276, 10, NULL, NULL, 1, 0, NULL),
(67, 1, 1, 67, 750, 36.67, 275, 475, 10, NULL, NULL, 1, 0, NULL),
(68, 1, 1, 68, 400, 21.50, 86, 314, 10, NULL, NULL, 1, 0, NULL),
(69, 1, 1, 69, 750, 44.00, 330, 420, 10, NULL, NULL, 1, 0, NULL),
(70, 1, 1, 70, 270, 22.22, 60, 210, 10, NULL, NULL, 1, 0, NULL),
(71, 1, 1, 71, 500, 14.00, 70, 430, 10, NULL, NULL, 1, 0, NULL),
(72, 1, 1, 72, 450, 28.89, 130, 320, 10, NULL, NULL, 1, 0, NULL),
(73, 1, 1, 73, 460, 11.96, 55, 405, 10, NULL, NULL, 1, 0, NULL),
(74, 1, 1, 74, 150, 0.00, 0, 150, 10, NULL, NULL, 1, 0, NULL),
(75, 1, 1, 75, 550, 16.36, 90, 460, 10, NULL, NULL, 1, 0, NULL),
(76, 1, 1, 76, 1800, 40.00, 720, 1080, 10, NULL, NULL, 1, 0, NULL),
(77, 1, 1, 77, 200, 4.00, 8, 192, 10, NULL, NULL, 1, 0, NULL),
(78, 1, 1, 78, 60, 0.00, 0, 60, 10, NULL, NULL, 1, 0, NULL),
(79, 1, 1, 79, 220, 0.00, 0, 220, 10, NULL, NULL, 1, 0, NULL),
(80, 1, 1, 80, 2000, 32.50, 650, 1350, 10, NULL, NULL, 1, 0, NULL),
(81, 1, 1, 81, 1110, 23.42, 260, 850, 10, NULL, NULL, 1, 0, NULL),
(82, 1, 1, 82, 2330, 25.41, 592, 1738, 10, NULL, NULL, 1, 0, NULL),
(83, 1, 1, 83, 500, 36.00, 180, 320, 10, NULL, NULL, 1, 0, NULL),
(84, 1, 1, 84, 450, 53.33, 240, 210, 10, NULL, NULL, 1, 0, NULL),
(85, 1, 1, 85, 860, 38.37, 330, 530, 10, NULL, NULL, 1, 0, NULL),
(86, 1, 1, 86, 500, 25.00, 125, 375, 10, NULL, NULL, 1, 0, NULL),
(87, 1, 1, 87, 340, 31.76, 108, 232, 10, NULL, NULL, 1, 0, NULL),
(88, 1, 1, 88, 1050, 18.10, 190, 860, 10, NULL, NULL, 1, 0, NULL),
(89, 1, 1, 89, 350, 8.57, 30, 320, 10, NULL, NULL, 1, 0, NULL),
(90, 1, 1, 90, 60, 0.00, 0, 60, 10, NULL, NULL, 1, 0, NULL),
(91, 1, 1, 91, 750, 44.00, 330, 420, 10, NULL, NULL, 1, 0, NULL),
(92, 1, 1, 92, 200, 17.00, 34, 166, 10, NULL, NULL, 1, 0, NULL),
(93, 1, 1, 93, 200, 17.00, 34, 166, 10, NULL, NULL, 1, 0, NULL),
(94, 1, 1, 94, 220, 0.00, 0, 220, 10, NULL, NULL, 1, 0, NULL),
(95, 1, 1, 95, 1485, 32.39, 481, 1004, 10, NULL, NULL, 1, 0, NULL),
(96, 1, 1, 96, 235, 29.36, 69, 166, 10, NULL, NULL, 1, 0, NULL),
(97, 1, 1, 97, 235, 29.36, 69, 166, 10, NULL, NULL, 1, 0, NULL),
(98, 1, 1, 98, 500, 38.20, 191, 309, 10, NULL, NULL, 1, 0, NULL),
(99, 1, 1, 99, 450, 58.22, 262, 188, 10, NULL, NULL, 1, 0, NULL),
(100, 1, 1, 100, 650, 52.46, 341, 309, 10, NULL, NULL, 1, 0, NULL),
(101, 1, 1, 101, 2300, 48.26, 1110, 1190, 10, NULL, NULL, 1, 0, NULL),
(102, 1, 1, 102, 180, 0.00, 0, 180, 10, NULL, NULL, 1, 0, NULL),
(103, 1, 1, 103, 2699, 11.12, 300, 2399, 10, NULL, NULL, 1, 0, NULL),
(104, 1, 1, 104, 1849, 14.98, 277, 1572, 10, NULL, NULL, 1, 0, NULL),
(105, 1, 1, 105, 1199, 10.01, 120, 1079, 10, NULL, NULL, 1, 0, NULL),
(106, 1, 1, 106, 1649, 18.19, 300, 1349, 10, NULL, NULL, 1, 0, NULL),
(107, 1, 1, 107, 999, 0.00, 0, 999, 10, NULL, NULL, 1, 0, NULL),
(108, 1, 1, 108, 2999, 10.00, 300, 2699, 10, NULL, NULL, 1, 0, NULL),
(109, 1, 1, 109, 280, 48.57, 136, 144, 10, NULL, NULL, 1, 0, NULL),
(110, 1, 1, 110, 260, 11.54, 30, 230, 10, NULL, NULL, 1, 0, NULL),
(111, 1, 1, 111, 800, 25.00, 200, 600, 10, NULL, NULL, 1, 0, NULL),
(112, 1, 1, 112, 120, 0.00, 0, 120, 10, NULL, NULL, 1, 0, NULL),
(113, 1, 1, 113, 600, 26.67, 160, 440, 10, NULL, NULL, 1, 0, NULL),
(114, 1, 1, 114, 1100, 40.00, 440, 660, 10, NULL, NULL, 1, 0, NULL),
(115, 1, 1, 115, 250, 0.00, 0, 250, 10, NULL, NULL, 1, 0, NULL),
(128, 2, 1, 128, 1800, 10.00, 180, 1620, 10, NULL, NULL, 1, 0, NULL),
(129, 2, 1, 129, 1200, 10.00, 120, 1080, 10, NULL, NULL, 1, 0, NULL),
(130, 2, 1, 130, 1500, 10.00, 150, 1350, 10, NULL, NULL, 1, 0, NULL),
(131, 2, 1, 131, 2000, 10.00, 200, 1800, 10, NULL, NULL, 1, 0, NULL),
(132, 2, 1, 132, 3000, 10.00, 300, 2700, 10, NULL, NULL, 1, 0, NULL),
(133, 2, 1, 133, 3800, 10.00, 380, 3420, 10, NULL, NULL, 1, 0, NULL),
(134, 2, 1, 134, 2200, 10.00, 220, 1980, 10, NULL, NULL, 1, 0, NULL),
(135, 2, 1, 135, 3200, 10.00, 320, 2880, 10, NULL, NULL, 1, 0, NULL),
(136, 2, 1, 136, 3700, 10.00, 370, 3330, 10, NULL, NULL, 1, 0, NULL),
(137, 2, 1, 137, 5000, 15.00, 750, 4250, 10, NULL, NULL, 1, 0, NULL),
(143, 3, 1, 143, 1400, 46.43, 650, 750, 10, NULL, NULL, 1, 0, NULL),
(144, 3, 1, 144, 300, 33.33, 100, 200, 10, NULL, NULL, 1, 0, NULL),
(145, 3, 1, 145, 1300, 23.08, 300, 1000, 10, NULL, NULL, 1, 0, NULL),
(146, 3, 1, 146, 4100, 0.73, 30, 4070, 10, NULL, NULL, 1, 0, NULL),
(147, 3, 1, 147, 250, 20.00, 50, 200, 10, NULL, NULL, 1, 0, NULL),
(148, 3, 1, 148, 600, 26.67, 160, 440, 10, NULL, NULL, 1, 0, NULL),
(149, 3, 1, 149, 600, 45.00, 270, 330, 10, NULL, NULL, 1, 0, NULL),
(150, 3, 1, 150, 3800, 23.68, 900, 2900, 10, NULL, NULL, 1, 0, NULL),
(151, 3, 1, 151, 4350, 24.14, 1050, 3300, 10, NULL, NULL, 1, 0, NULL),
(152, 3, 1, 152, 1000, 12.00, 120, 880, 10, NULL, NULL, 1, 0, NULL),
(153, 3, 1, 153, 1400, 37.14, 520, 880, 10, NULL, NULL, 1, 0, NULL),
(154, 3, 1, 154, 2000, 32.50, 650, 1350, 10, NULL, NULL, 1, 0, NULL),
(155, 3, 1, 155, 800, 31.25, 250, 550, 10, NULL, NULL, 1, 0, NULL),
(156, 3, 1, 156, 800, 0.00, 0, 800, 10, NULL, NULL, 1, 0, NULL),
(157, 3, 1, 157, 1200, 25.00, 300, 900, 10, NULL, NULL, 1, 0, NULL),
(158, 3, 1, 158, 500, 28.00, 140, 360, 10, NULL, NULL, 1, 0, NULL),
(159, 3, 1, 159, 800, 10.63, 85, 715, 10, NULL, NULL, 1, 0, NULL),
(160, 3, 1, 160, 500, 28.00, 140, 360, 10, NULL, NULL, 1, 0, NULL),
(161, 3, 1, 161, 600, 45.00, 270, 330, 10, NULL, NULL, 1, 0, NULL),
(162, 3, 1, 162, 500, 12.00, 60, 440, 10, NULL, NULL, 1, 0, NULL),
(163, 3, 1, 163, 1200, 8.33, 100, 1100, 10, NULL, NULL, 1, 0, NULL),
(164, 3, 1, 164, 1200, 8.33, 100, 1100, 10, NULL, NULL, 1, 0, NULL),
(165, 3, 1, 165, 200, 0.00, 0, 200, 10, NULL, NULL, 1, 0, NULL),
(166, 3, 1, 166, 250, 20.00, 50, 200, 10, NULL, NULL, 1, 0, NULL),
(167, 3, 1, 167, 450, 14.44, 65, 385, 10, NULL, NULL, 1, 0, NULL),
(168, 3, 1, 168, 800, 31.25, 250, 550, 10, NULL, NULL, 1, 0, NULL),
(169, 3, 1, 169, 1200, 35.83, 430, 770, 10, NULL, NULL, 1, 0, NULL),
(170, 3, 1, 170, 1200, 26.67, 320, 880, 10, NULL, NULL, 1, 0, NULL),
(171, 3, 1, 171, 1300, 15.38, 200, 1100, 10, NULL, NULL, 1, 0, NULL),
(172, 3, 1, 172, 250, 20.00, 50, 200, 10, NULL, NULL, 1, 0, NULL),
(173, 3, 1, 173, 800, 45.00, 360, 440, 10, NULL, NULL, 1, 0, NULL),
(174, 3, 1, 174, 800, 0.00, 0, 800, 10, NULL, NULL, 1, 0, NULL),
(175, 3, 1, 175, 800, 10.63, 85, 715, 10, NULL, NULL, 1, 0, NULL),
(176, 3, 1, 176, 500, 0.00, 0, 500, 10, NULL, NULL, 1, 0, NULL),
(177, 3, 1, 177, 500, 0.00, 0, 500, 10, NULL, NULL, 1, 0, NULL),
(178, 3, 1, 178, 2200, 15.00, 330, 1870, 10, NULL, NULL, 1, 0, NULL),
(179, 3, 1, 179, 2500, 3.20, 80, 2420, 10, NULL, NULL, 1, 0, NULL),
(180, 3, 1, 180, 250, 20.00, 50, 200, 10, NULL, NULL, 1, 0, NULL),
(181, 3, 1, 181, 250, 20.00, 50, 200, 10, NULL, NULL, 1, 0, NULL),
(182, 3, 1, 182, 100, 0.00, 0, 100, 10, NULL, NULL, 1, 0, NULL),
(183, 3, 1, 183, 700, 21.43, 150, 550, 10, NULL, NULL, 1, 0, NULL),
(184, 3, 1, 184, 700, 21.43, 150, 550, 10, NULL, NULL, 1, 0, NULL),
(185, 3, 1, 185, 700, 21.43, 150, 550, 10, NULL, NULL, 1, 0, NULL),
(186, 3, 1, 186, 1300, 40.77, 530, 770, 10, NULL, NULL, 1, 0, NULL),
(187, 3, 1, 187, 700, 28.57, 200, 500, 10, NULL, NULL, 1, 0, NULL),
(188, 3, 1, 188, 700, 0.00, 0, 700, 10, NULL, NULL, 1, 0, NULL),
(189, 3, 1, 189, 250, 20.00, 50, 200, 10, NULL, NULL, 1, 0, NULL),
(190, 3, 1, 190, 3000, 5.00, 150, 2850, 10, NULL, NULL, 1, 0, NULL),
(191, 3, 1, 191, 700, 29.29, 205, 495, 10, NULL, NULL, 1, 0, NULL),
(192, 3, 1, 192, 1400, 5.71, 80, 1320, 10, NULL, NULL, 1, 0, NULL),
(193, 3, 1, 193, 1400, 5.71, 80, 1320, 10, NULL, NULL, 1, 0, NULL),
(194, 3, 1, 194, 700, 21.43, 150, 550, 10, NULL, NULL, 1, 0, NULL),
(195, 3, 1, 195, 700, 29.29, 205, 495, 10, NULL, NULL, 1, 0, NULL),
(196, 3, 1, 196, 700, 21.43, 150, 550, 10, NULL, NULL, 1, 0, NULL),
(197, 3, 1, 197, 700, 21.43, 150, 550, 10, NULL, NULL, 1, 0, NULL),
(198, 3, 1, 198, 700, 0.00, 0, 700, 10, NULL, NULL, 1, 0, NULL),
(199, 3, 1, 199, 700, 0.00, 0, 700, 10, NULL, NULL, 1, 0, NULL),
(200, 3, 1, 200, 700, 0.00, 0, 700, 10, NULL, NULL, 1, 0, NULL),
(201, 3, 1, 201, 2200, 15.00, 330, 1870, 10, NULL, NULL, 1, 0, NULL),
(202, 3, 1, 202, 900, 0.00, 0, 900, 10, NULL, NULL, 1, 0, NULL),
(203, 3, 1, 203, 750, 19.33, 145, 605, 10, NULL, NULL, 1, 0, NULL),
(204, 3, 1, 204, 4000, 12.00, 480, 3520, 10, NULL, NULL, 1, 0, NULL),
(205, 3, 1, 205, 150, 0.00, 0, 150, 10, NULL, NULL, 1, 0, NULL),
(206, 3, 1, 206, 800, 3.75, 30, 770, 10, NULL, NULL, 1, 0, NULL),
(207, 3, 1, 207, 1500, 12.00, 180, 1320, 10, NULL, NULL, 1, 0, NULL),
(208, 3, 1, 208, 800, 24.38, 195, 605, 10, NULL, NULL, 1, 0, NULL),
(209, 3, 1, 209, 8000, 12.50, 1000, 7000, 10, NULL, NULL, 1, 0, NULL),
(210, 3, 1, 210, 9000, 5.56, 500, 8500, 10, NULL, NULL, 1, 0, NULL),
(211, 3, 1, 211, 1750, 24.57, 430, 1320, 10, NULL, NULL, 1, 0, NULL),
(212, 3, 1, 212, 2250, 4.67, 105, 2145, 10, NULL, NULL, 1, 0, NULL),
(213, 3, 1, 213, 2250, 4.67, 105, 2145, 10, NULL, NULL, 1, 0, NULL),
(214, 3, 1, 214, 2250, 4.67, 105, 2145, 10, NULL, NULL, 1, 0, NULL),
(215, 3, 1, 215, 2250, 4.67, 105, 2145, 10, NULL, NULL, 1, 0, NULL),
(216, 3, 1, 216, 3200, 17.50, 560, 2640, 10, NULL, NULL, 1, 0, NULL),
(217, 3, 1, 217, 3200, 17.50, 560, 2640, 10, NULL, NULL, 1, 0, NULL),
(218, 3, 1, 218, 6000, 4.67, 280, 5720, 10, NULL, NULL, 1, 0, NULL),
(219, 3, 1, 219, 1400, 37.14, 520, 880, 10, NULL, NULL, 1, 0, NULL),
(220, 3, 1, 220, 300, 8.33, 25, 275, 10, NULL, NULL, 1, 0, NULL),
(221, 3, 1, 221, 550, 40.00, 220, 330, 10, NULL, NULL, 1, 0, NULL),
(222, 3, 1, 222, 850, 43.06, 366, 484, 10, NULL, NULL, 1, 0, NULL),
(223, 3, 1, 223, 600, 45.00, 270, 330, 10, NULL, NULL, 1, 0, NULL),
(224, 3, 1, 224, 1000, 23.00, 230, 770, 10, NULL, NULL, 1, 0, NULL),
(225, 3, 1, 225, 2100, 0.00, 0, 2100, 10, NULL, NULL, 1, 0, NULL),
(226, 3, 1, 226, 3500, 5.71, 200, 3300, 10, NULL, NULL, 1, 0, NULL),
(227, 3, 1, 227, 2100, 0.00, 0, 2100, 10, NULL, NULL, 1, 0, NULL),
(228, 3, 1, 228, 1000, 39.50, 395, 605, 10, NULL, NULL, 1, 0, NULL),
(229, 3, 1, 229, 1200, 8.33, 100, 1100, 10, NULL, NULL, 1, 0, NULL),
(230, 3, 1, 230, 300, 30.33, 91, 209, 10, NULL, NULL, 1, 0, NULL),
(231, 3, 1, 231, 300, 30.33, 91, 209, 10, NULL, NULL, 1, 0, NULL),
(232, 3, 1, 232, 1200, 35.83, 430, 770, 10, NULL, NULL, 1, 0, NULL),
(233, 3, 1, 233, 400, 6.50, 26, 374, 10, NULL, NULL, 1, 0, NULL),
(234, 3, 1, 234, 450, 16.89, 76, 374, 10, NULL, NULL, 1, 0, NULL),
(235, 3, 1, 235, 550, 32.00, 176, 374, 10, NULL, NULL, 1, 0, NULL),
(236, 3, 1, 236, 2000, 0.00, 0, 2000, 10, NULL, NULL, 1, 0, NULL),
(237, 3, 1, 237, 250, 0.00, 0, 250, 10, NULL, NULL, 1, 0, NULL),
(238, 3, 1, 238, 80, 0.00, 0, 80, 10, NULL, NULL, 1, 0, NULL),
(239, 3, 1, 239, 80, 0.00, 0, 80, 10, NULL, NULL, 1, 0, NULL),
(240, 3, 1, 240, 80, 0.00, 0, 80, 10, NULL, NULL, 1, 0, NULL),
(241, 3, 1, 241, 80, 0.00, 0, 80, 10, NULL, NULL, 1, 0, NULL),
(242, 3, 1, 242, 80, 0.00, 0, 80, 10, NULL, NULL, 1, 0, NULL),
(243, 3, 1, 243, 600, 54.17, 325, 275, 10, NULL, NULL, 1, 0, NULL),
(244, 3, 1, 244, 250, 0.00, 0, 250, 10, NULL, NULL, 1, 0, NULL),
(245, 3, 1, 245, 400, 0.00, 0, 400, 10, NULL, NULL, 1, 0, NULL),
(246, 3, 1, 246, 450, 2.22, 10, 440, 10, NULL, NULL, 1, 0, NULL),
(247, 3, 1, 247, 450, 2.22, 10, 440, 10, NULL, NULL, 1, 0, NULL),
(248, 3, 1, 248, 450, 2.22, 10, 440, 10, NULL, NULL, 1, 0, NULL),
(249, 3, 1, 249, 350, 30.00, 105, 245, 10, NULL, NULL, 1, 0, NULL),
(250, 3, 1, 250, 450, 22.22, 100, 350, 10, NULL, NULL, 1, 0, NULL),
(251, 3, 1, 251, 450, 2.22, 10, 440, 10, NULL, NULL, 1, 0, NULL),
(252, 3, 1, 252, 800, 17.50, 140, 660, 10, NULL, NULL, 1, 0, NULL),
(253, 3, 1, 253, 800, 24.38, 195, 605, 10, NULL, NULL, 1, 0, NULL),
(254, 3, 1, 254, 800, 38.13, 305, 495, 10, NULL, NULL, 1, 0, NULL),
(255, 3, 1, 255, 300, 26.67, 80, 220, 10, NULL, NULL, 1, 0, NULL),
(256, 3, 1, 256, 1800, 0.00, 0, 1800, 10, NULL, NULL, 1, 0, NULL),
(257, 3, 1, 257, 2500, 0.00, 0, 2500, 10, NULL, NULL, 1, 0, NULL),
(258, 3, 1, 258, 1800, 0.00, 0, 1800, 10, NULL, NULL, 1, 0, NULL),
(259, 3, 1, 259, 2500, 0.00, 0, 2500, 10, NULL, NULL, 1, 0, NULL),
(260, 3, 1, 260, 1450, 0.00, 0, 1450, 10, NULL, NULL, 1, 0, NULL),
(261, 3, 1, 261, 800, 17.50, 140, 660, 10, NULL, NULL, 1, 0, NULL),
(262, 3, 1, 262, 400, 0.00, 0, 400, 10, NULL, NULL, 1, 0, NULL),
(263, 3, 1, 263, 600, 45.00, 270, 330, 10, NULL, NULL, 1, 0, NULL),
(264, 3, 1, 264, 2500, 25.20, 630, 1870, 10, NULL, NULL, 1, 0, NULL),
(265, 3, 1, 265, 2000, 23.00, 460, 1540, 10, NULL, NULL, 1, 0, NULL),
(266, 3, 1, 266, 1000, 12.00, 120, 880, 10, NULL, NULL, 1, 0, NULL),
(267, 3, 1, 267, 1200, 26.67, 320, 880, 10, NULL, NULL, 1, 0, NULL),
(268, 3, 1, 268, 600, 26.67, 160, 440, 10, NULL, NULL, 1, 0, NULL),
(269, 3, 1, 269, 600, 45.00, 270, 330, 10, NULL, NULL, 1, 0, NULL),
(270, 3, 1, 270, 600, 26.67, 160, 440, 10, NULL, NULL, 1, 0, NULL),
(271, 3, 1, 271, 3500, 0.00, 0, 3500, 10, NULL, NULL, 1, 0, NULL),
(272, 3, 1, 272, 600, 26.67, 160, 440, 10, NULL, NULL, 1, 0, NULL),
(273, 3, 1, 273, 2000, 39.50, 790, 1210, 10, NULL, NULL, 1, 0, NULL),
(274, 3, 1, 274, 800, 45.00, 360, 440, 10, NULL, NULL, 1, 0, NULL),
(275, 3, 1, 275, 800, 45.00, 360, 440, 10, NULL, NULL, 1, 0, NULL),
(276, 3, 1, 276, 600, 48.67, 292, 308, 10, NULL, NULL, 1, 0, NULL),
(277, 3, 1, 277, 500, 45.00, 225, 275, 10, NULL, NULL, 1, 0, NULL),
(278, 3, 1, 278, 600, 17.50, 105, 495, 10, NULL, NULL, 1, 0, NULL),
(279, 3, 1, 279, 600, 37.67, 226, 374, 10, NULL, NULL, 1, 0, NULL),
(280, 3, 1, 280, 250, 0.00, 0, 250, 10, NULL, NULL, 1, 0, NULL),
(281, 3, 1, 281, 550, 62.00, 341, 209, 10, NULL, NULL, 1, 0, NULL),
(282, 3, 1, 282, 700, 40.29, 282, 418, 10, NULL, NULL, 1, 0, NULL),
(283, 3, 1, 283, 800, 17.50, 140, 660, 10, NULL, NULL, 1, 0, NULL),
(284, 3, 1, 284, 1000, 12.00, 120, 880, 10, NULL, NULL, 1, 0, NULL),
(285, 3, 1, 285, 450, 41.33, 186, 264, 10, NULL, NULL, 1, 0, NULL),
(286, 3, 1, 286, 1850, 16.76, 310, 1540, 10, NULL, NULL, 1, 0, NULL),
(287, 3, 1, 287, 200, 0.00, 0, 200, 10, NULL, NULL, 1, 0, NULL),
(288, 3, 1, 288, 1450, 8.97, 130, 1320, 10, NULL, NULL, 1, 0, NULL),
(289, 3, 1, 289, 150, 0.00, 0, 150, 10, NULL, NULL, 1, 0, NULL),
(290, 3, 1, 290, 900, 14.44, 130, 770, 10, NULL, NULL, 1, 0, NULL),
(291, 3, 1, 291, 250, 20.00, 50, 200, 10, NULL, NULL, 1, 0, NULL),
(292, 3, 1, 292, 2400, 17.50, 420, 1980, 10, NULL, NULL, 1, 0, NULL),
(293, 3, 1, 293, 600, 54.17, 325, 275, 10, NULL, NULL, 1, 0, NULL),
(294, 3, 1, 294, 550, 62.00, 341, 209, 10, NULL, NULL, 1, 0, NULL),
(295, 3, 1, 295, 700, 40.29, 282, 418, 10, NULL, NULL, 1, 0, NULL),
(296, 3, 1, 296, 250, 20.00, 50, 200, 10, NULL, NULL, 1, 0, NULL),
(297, 3, 1, 297, 300, 34.00, 102, 198, 10, NULL, NULL, 1, 0, NULL),
(298, 3, 1, 298, 1400, 45.00, 630, 770, 10, NULL, NULL, 1, 0, NULL),
(299, 3, 1, 299, 450, 26.67, 120, 330, 10, NULL, NULL, 1, 0, NULL),
(300, 3, 1, 300, 400, 45.00, 180, 220, 10, NULL, NULL, 1, 0, NULL),
(301, 3, 1, 301, 100, 0.00, 0, 100, 10, NULL, NULL, 1, 0, NULL),
(302, 3, 1, 302, 900, 14.44, 130, 770, 10, NULL, NULL, 1, 0, NULL),
(303, 3, 1, 303, 400, 17.50, 70, 330, 10, NULL, NULL, 1, 0, NULL),
(304, 3, 1, 304, 250, 20.00, 50, 200, 10, NULL, NULL, 1, 0, NULL),
(305, 3, 1, 305, 250, 20.00, 50, 200, 10, NULL, NULL, 1, 0, NULL),
(306, 3, 1, 306, 250, 20.00, 50, 200, 10, NULL, NULL, 1, 0, NULL),
(307, 3, 1, 307, 250, 3.20, 8, 242, 10, NULL, NULL, 1, 0, NULL),
(308, 3, 1, 308, 400, 17.50, 70, 330, 10, NULL, NULL, 1, 0, NULL),
(309, 3, 1, 309, 550, 46.00, 253, 297, 10, NULL, NULL, 1, 0, NULL),
(310, 3, 1, 310, 600, 45.00, 270, 330, 10, NULL, NULL, 1, 0, NULL),
(311, 3, 1, 311, 1300, 15.38, 200, 1100, 10, NULL, NULL, 1, 0, NULL),
(312, 3, 1, 312, 600, 61.50, 369, 231, 10, NULL, NULL, 1, 0, NULL),
(313, 3, 1, 313, 600, 26.67, 160, 440, 10, NULL, NULL, 1, 0, NULL),
(314, 3, 1, 314, 1000, 0.00, 0, 1000, 10, NULL, NULL, 1, 0, NULL),
(315, 3, 1, 315, 200, 10.00, 20, 180, 10, NULL, NULL, 1, 0, NULL),
(316, 3, 1, 316, 850, 0.00, 0, 850, 10, NULL, NULL, 1, 0, NULL),
(317, 3, 1, 317, 1500, 12.00, 180, 1320, 10, NULL, NULL, 1, 0, NULL),
(318, 3, 1, 318, 2800, 35.71, 1000, 1800, 10, NULL, NULL, 1, 0, NULL),
(319, 3, 1, 319, 2500, 40.00, 1000, 1500, 10, NULL, NULL, 1, 0, NULL),
(320, 3, 1, 320, 1250, 51.60, 645, 605, 10, NULL, NULL, 1, 0, NULL),
(321, 3, 1, 321, 1250, 51.60, 645, 605, 10, NULL, NULL, 1, 0, NULL),
(322, 3, 1, 322, 4000, 6.50, 260, 3740, 10, NULL, NULL, 1, 0, NULL),
(323, 3, 1, 323, 1800, 14.44, 260, 1540, 10, NULL, NULL, 1, 0, NULL),
(324, 3, 1, 324, 1500, 12.00, 180, 1320, 10, NULL, NULL, 1, 0, NULL),
(325, 3, 1, 325, 600, 1.00, 6, 594, 10, NULL, NULL, 1, 0, NULL),
(326, 3, 1, 326, 250, 0.00, 0, 250, 10, NULL, NULL, 1, 0, NULL),
(327, 3, 1, 327, 200, 10.00, 20, 180, 10, NULL, NULL, 1, 0, NULL),
(328, 3, 1, 328, 1000, 39.50, 395, 605, 10, NULL, NULL, 1, 0, NULL),
(329, 3, 1, 329, 1000, 39.50, 395, 605, 10, NULL, NULL, 1, 0, NULL),
(330, 3, 1, 330, 250, 34.00, 85, 165, 10, NULL, NULL, 1, 0, NULL),
(331, 3, 1, 331, 250, 0.00, 0, 250, 10, NULL, NULL, 1, 0, NULL),
(332, 3, 1, 332, 250, 20.00, 50, 200, 10, NULL, NULL, 1, 0, NULL),
(333, 3, 1, 333, 250, 20.00, 50, 200, 10, NULL, NULL, 1, 0, NULL),
(334, 3, 1, 334, 850, 48.24, 410, 440, 10, NULL, NULL, 1, 0, NULL),
(335, 3, 1, 335, 350, 0.00, 0, 350, 10, NULL, NULL, 1, 0, NULL),
(336, 3, 1, 336, 170, 0.00, 0, 170, 10, NULL, NULL, 1, 0, NULL),
(337, 3, 1, 337, 800, 31.25, 250, 550, 10, NULL, NULL, 1, 0, NULL),
(338, 3, 1, 338, 4000, 0.00, 0, 4000, 10, NULL, NULL, 1, 0, NULL),
(339, 3, 1, 339, 900, 53.56, 482, 418, 10, NULL, NULL, 1, 0, NULL),
(340, 3, 1, 340, 100, 0.00, 0, 100, 10, NULL, NULL, 1, 0, NULL),
(341, 3, 1, 341, 3800, 0.00, 0, 3800, 10, NULL, NULL, 1, 0, NULL),
(342, 3, 1, 342, 300, 37.67, 113, 187, 10, NULL, NULL, 1, 0, NULL),
(343, 3, 1, 343, 4500, 0.00, 0, 4500, 10, NULL, NULL, 1, 0, NULL),
(344, 3, 1, 344, 2500, 0.00, 0, 2500, 10, NULL, NULL, 1, 0, NULL),
(345, 3, 1, 345, 0, NULL, 0, 0, 10, NULL, NULL, 1, 0, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `ledger`
--

CREATE TABLE `ledger` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL DEFAULT '0',
  `openingBalance` decimal(10,2) NOT NULL DEFAULT '0.00',
  `cr` decimal(10,2) NOT NULL DEFAULT '0.00',
  `dr` decimal(10,2) NOT NULL DEFAULT '0.00',
  `closingBalance` decimal(10,2) NOT NULL DEFAULT '0.00',
  `iStatus` int(11) NOT NULL DEFAULT '1',
  `isDelete` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `strIP` varchar(255) DEFAULT NULL,
  `user_id` int(11) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ledger`
--

INSERT INTO `ledger` (`id`, `order_id`, `openingBalance`, `cr`, `dr`, `closingBalance`, `iStatus`, `isDelete`, `created_at`, `updated_at`, `strIP`, `user_id`) VALUES
(1, 1, 0.00, 0.00, 0.00, 0.00, 1, 0, '2025-09-15 10:42:19', NULL, NULL, 0),
(2, 4, 0.00, 0.00, 0.00, 0.00, 1, 0, '2025-09-17 10:49:56', NULL, NULL, 0),
(3, 5, 0.00, 0.00, 0.00, 0.00, 1, 0, '2025-09-17 10:54:10', NULL, NULL, 0),
(4, 6, 0.00, 0.00, 0.00, 0.00, 1, 0, '2025-09-17 13:35:49', NULL, NULL, 0),
(5, 1, 0.00, 0.00, 0.00, 0.00, 1, 0, '2025-09-17 13:43:10', NULL, NULL, 0),
(6, 2, 600.00, 0.00, 0.00, 600.00, 1, 0, '2025-09-17 13:50:35', NULL, NULL, 0),
(7, 8, 1200.00, 0.00, 0.00, 1200.00, 1, 0, '2025-09-24 12:33:50', NULL, NULL, 0),
(8, 18, 450.00, 0.00, 0.00, 450.00, 1, 0, '2025-09-26 06:20:28', NULL, NULL, 0),
(9, 20, 300.00, 0.00, 0.00, 300.00, 1, 0, '2025-09-26 08:01:10', NULL, NULL, 0),
(10, 21, 300.00, 0.00, 0.00, 300.00, 1, 0, '2025-09-26 08:03:07', NULL, NULL, 0),
(11, 22, 300.00, 0.00, 0.00, 300.00, 1, 0, '2025-09-26 08:47:07', NULL, NULL, 0),
(12, 24, 300.00, 0.00, 0.00, 300.00, 1, 0, '2025-09-26 09:24:19', NULL, NULL, 0),
(13, 26, 900.00, 0.00, 0.00, 900.00, 1, 0, '2025-09-26 09:44:36', NULL, NULL, 0),
(14, 26, 900.00, 0.00, 0.00, 900.00, 1, 0, '2025-09-26 09:45:04', NULL, NULL, 0),
(15, 29, 300.00, 0.00, 0.00, 300.00, 1, 0, '2025-09-26 10:15:46', NULL, NULL, 0),
(16, 31, 600.00, 0.00, 0.00, 600.00, 1, 0, '2025-09-26 10:30:51', NULL, NULL, 0),
(17, 33, 450.00, 0.00, 0.00, 450.00, 1, 0, '2025-09-26 12:28:17', NULL, NULL, 0),
(18, 35, 600.00, 0.00, 0.00, 600.00, 1, 0, '2025-09-27 09:39:52', NULL, NULL, 0),
(19, 36, 1200.00, 0.00, 0.00, 1200.00, 1, 0, '2025-09-29 05:20:52', NULL, NULL, 0),
(20, 37, 400.00, 0.00, 0.00, 400.00, 1, 0, '2025-09-29 06:39:01', NULL, NULL, 0),
(21, 37, 400.00, 0.00, 0.00, 400.00, 1, 0, '2025-09-29 06:46:18', NULL, NULL, 0),
(22, 1, 900.00, 0.00, 0.00, 900.00, 1, 0, '2025-09-29 08:48:35', NULL, NULL, 0),
(23, 2, 600.00, 0.00, 300.00, 300.00, 1, 0, '2025-09-29 10:14:40', '2025-09-29 10:14:40', NULL, 0),
(24, 2, 300.00, 0.00, 300.00, 0.00, 1, 0, '2025-09-30 05:45:06', '2025-09-30 05:45:06', NULL, 0),
(25, 3, 600.00, 0.00, 0.00, 600.00, 1, 0, '2025-10-01 08:16:21', NULL, NULL, 0),
(26, 4, 300.00, 0.00, 0.00, 300.00, 1, 0, '2025-10-01 13:45:06', NULL, NULL, 0),
(27, 9, 450.00, 0.00, 0.00, 450.00, 1, 0, '2025-10-06 08:02:44', NULL, NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `members`
--

CREATE TABLE `members` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `mobile` varchar(255) DEFAULT NULL,
  `iStatus` int(11) NOT NULL DEFAULT '1',
  `isDelete` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `strIP` varchar(255) DEFAULT NULL,
  `city` varchar(200) DEFAULT NULL,
  `address` varchar(100) DEFAULT NULL,
  `pincode` int(11) DEFAULT '0',
  `state` varchar(50) DEFAULT NULL,
  `Order_id` int(11) DEFAULT '0',
  `password` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `members`
--

INSERT INTO `members` (`id`, `name`, `email`, `mobile`, `iStatus`, `isDelete`, `created_at`, `updated_at`, `strIP`, `city`, `address`, `pincode`, `state`, `Order_id`, `password`) VALUES
(3, 'Apollo', 'dev7.apolloinfotech@gmail.com', '1234567890', 1, 0, '2025-09-17 13:43:10', '2025-09-26 05:58:07', NULL, 'Ahmedabad', 'Bhairavnath,Isanpur Ahmedabad Road', 678900, 'Gujarat', 2, '$2y$12$ZtEyM8bprOnD57H7zSYGf.eF2gmYKc.fPTBcRYb.FWfrCgKbIu0iy'),
(6, 'J B hsha', 'jbshah95@gmail.com', '9825848657', 1, 0, '2025-09-26 08:01:10', '2025-09-26 08:01:10', NULL, 'Ahmedabad', 'Ahmedabad', 382443, 'Gujarat', 20, '$2y$12$PQPzO9jPE7gPuxf.rAfg6O.gFrO0XK7WCQGCSBqfe39rSP0JGDL66'),
(20, 'Nisha', 'ai.dev.laravel10@gmail.com', '9898808754', 1, 0, '2025-09-29 08:48:36', '2025-09-29 08:48:36', NULL, 'Ahmedabad', 'Bhairavnath,Isanpur Ahmedabad Road', 345678, 'Gujarat', 1, '$2y$12$suCRnGcrpnCDBBxjxGpX8OaPsBaOCLIdseZ.ftUZ4C9Ll72M2luUC'),
(21, 'Pritesh', 'priteshshah223@gmail.com', '7575039002', 1, 0, '2025-10-01 08:16:21', '2025-10-01 08:27:37', NULL, 'Ahmedad', 'Naranpura', 380013, 'Gujarat', 3, '$2y$12$H68jT5v30LzqHGSL/hif7e2AtQpPHHGqN6eOKFfFDeJfXOhOF8a7a'),
(22, 'Nisha', 'dev2.apolloinfotech@gmail.com', '9898808751', 1, 0, '2025-10-01 13:45:07', '2025-10-01 13:45:07', NULL, 'Ahmedabad', 'Bhairavnath,Isanpur Ahmedabad Road', 678900, 'Gujarat', 4, '$2y$12$uqYPUR55nLHdB65ZxACCXuI18nYnr09ygiulYJyrVGpQqmk/sRKzK'),
(23, 'Aditya Jani', 'adijani195@gmail.com', '8401069349', 1, 0, '2025-10-06 08:02:44', '2025-10-06 08:10:27', NULL, 'Ahmedabad', 'A-8, Shantiniketan Bunglows, B/H Prahladnagar garden, Satelite, Ahmedabad-38015, Gujarat, INDIA', 380015, 'Gujarat', 9, '$2y$12$WXvK2lnvrY2p88PYD5NmK.jCPZRBNiTjvlIkP1t3BlMdGRolB1hNC');

-- --------------------------------------------------------

--
-- Table structure for table `Member_Order`
--

CREATE TABLE `Member_Order` (
  `Member_Order_id` int(11) NOT NULL,
  `Member_id` int(11) DEFAULT '0',
  `Order_id` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `Member_Order`
--

INSERT INTO `Member_Order` (`Member_Order_id`, `Member_id`, `Order_id`, `created_at`, `updated_at`) VALUES
(1, 20, '1', '2025-09-29 08:48:36', '2025-09-29 08:48:36'),
(2, 21, '3', '2025-10-01 08:16:21', '2025-10-01 08:16:21'),
(3, 22, '4', '2025-10-01 13:45:07', '2025-10-01 13:45:07'),
(4, 23, '9', '2025-10-06 08:02:44', '2025-10-06 08:02:44');

-- --------------------------------------------------------

--
-- Table structure for table `metropolis_fr4a`
--

CREATE TABLE `metropolis_fr4a` (
  `SR NO` int(3) NOT NULL,
  `LAB_NAME` varchar(10) DEFAULT NULL,
  `TEST_NAME` varchar(49) DEFAULT NULL,
  `MRP` int(4) DEFAULT NULL,
  `PATIENT_PRICE` int(4) DEFAULT NULL,
  `lab_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `metropolis_fr4a`
--

INSERT INTO `metropolis_fr4a` (`SR NO`, `LAB_NAME`, `TEST_NAME`, `MRP`, `PATIENT_PRICE`, `lab_id`) VALUES
(1, 'METROPOLIS', 'Abnormal Haemoglobin Studies', 750, 640, 6),
(2, 'METROPOLIS', 'AFP-Alpha Feto Protein', 650, 529, 6),
(3, 'METROPOLIS', 'ALKALINE PHOSPHATASE', 170, 170, 6),
(4, 'METROPOLIS', 'AMH', 1800, 1080, 6),
(5, 'METROPOLIS', 'Amylase Serum', 400, 265, 6),
(6, 'METROPOLIS', 'ANA by IFA', 1020, 640, 6),
(7, 'METROPOLIS', 'Ante natal profile', 1100, 860, 6),
(8, 'METROPOLIS', 'Anti PRO-BNP', 2000, 1520, 6),
(9, 'METROPOLIS', 'ANTI TPO ANTIBODY', 1200, 695, 6),
(10, 'METROPOLIS', 'APTT', 350, 320, 6),
(11, 'METROPOLIS', 'BilirubinTotal, Direct, IndirectSerum', 170, 170, 6),
(12, 'METROPOLIS', 'Blood Group ABO & Rh Typing', 220, 220, 6),
(13, 'METROPOLIS', 'BUN', 195, 195, 6),
(14, 'METROPOLIS', 'C Reactive Protein serum  (CRP)', 440, 265, 6),
(15, 'METROPOLIS', 'CA 15.3', 1340, 1085, 6),
(16, 'METROPOLIS', 'CA 19.9', 1000, 970, 6),
(17, 'METROPOLIS', 'CA-125', 900, 640, 6),
(18, 'METROPOLIS', 'Calcium Total Serum', 230, 230, 6),
(19, 'METROPOLIS', 'CBC ESR', 370, 272, 6),
(20, 'METROPOLIS', 'CBC Haemogram', 260, 199, 6),
(21, 'METROPOLIS', 'CCP Antibody', 400, 265, 6),
(22, 'METROPOLIS', 'CD3', 2555, 1813, 6),
(23, 'METROPOLIS', 'CD4', 1110, 933, 6),
(24, 'METROPOLIS', 'CEA-Carcino Embryonic Antigen, serum', 570, 485, 6),
(25, 'METROPOLIS', 'Chloride ( Cl )', 215, 215, 6),
(26, 'METROPOLIS', 'Cholesterol-Total  Serum', 170, 170, 6),
(27, 'METROPOLIS', 'Cortisol', 640, 375, 6),
(28, 'METROPOLIS', 'C-PEPTIDE', 1180, 979, 6),
(29, 'METROPOLIS', 'CPK -TOTAL', 460, 370, 6),
(30, 'METROPOLIS', 'CPK-MB', 535, 455, 6),
(31, 'METROPOLIS', 'Creatinine  Serum', 170, 170, 6),
(32, 'METROPOLIS', 'D-DIMER', 1290, 1051, 6),
(33, 'METROPOLIS', 'Dengue IgG antibdy', 650, 495, 6),
(34, 'METROPOLIS', 'Dengue Igm antibdy', 650, 495, 6),
(35, 'METROPOLIS', 'Dengue NS1 Antigen detection Serum', 800, 695, 6),
(36, 'METROPOLIS', 'DENGUE PROFILE', 2000, 1630, 6),
(37, 'METROPOLIS', 'E2', 500, 320, 6),
(38, 'METROPOLIS', 'Electrolytes', 500, 295, 6),
(39, 'METROPOLIS', 'ESR', 110, 110, 6),
(40, 'METROPOLIS', 'Fasting blood sugar', 60, 60, 6),
(41, 'METROPOLIS', 'Ferritin, serum by CLIA*', 800, 475, 6),
(42, 'METROPOLIS', 'Folic acid, Serum by CMIA*', 1180, 695, 6),
(43, 'METROPOLIS', 'Free T3, Serum by CLIA', 220, 210, 6),
(44, 'METROPOLIS', 'Free T4, Serum by CLIA', 220, 210, 6),
(45, 'METROPOLIS', 'FSH - Follicle Stimulating Hormone, Serum by CLIA', 270, 210, 6),
(46, 'METROPOLIS', 'FSH-LH-Prolactin', 850, 530, 6),
(47, 'METROPOLIS', 'FSH-LH-Prolactin-TSH', 1200, 585, 6),
(48, 'METROPOLIS', 'GLUCOSE TOLERANCE TEST 2 SAMPLES', 130, 130, 6),
(49, 'METROPOLIS', 'GLUCOSE TOLERANCE TEST 3 SAMPLES', 270, 270, 6),
(50, 'METROPOLIS', 'Haemoglobin', 120, 120, 6),
(51, 'METROPOLIS', 'HAV-IgM Ab to Hepatitis `A\' Virus,serum by CMIA*', 700, 640, 6),
(52, 'METROPOLIS', 'HbA1c', 500, 298, 6),
(53, 'METROPOLIS', 'HBsAg  by CMIA', 450, 265, 6),
(54, 'METROPOLIS', 'HCO3', 460, 405, 6),
(55, 'METROPOLIS', 'Hepatitis C Virus(HCV) (Antibodies)', 800, 420, 6),
(56, 'METROPOLIS', 'HIV-1-Combo', 7800, 3900, 6),
(57, 'METROPOLIS', 'HIV-DUO', 560, 265, 6),
(58, 'METROPOLIS', 'HLA-B27 Studies', 2450, 1190, 6),
(59, 'METROPOLIS', 'Homocysteine by CMIA', 1000, 750, 6),
(60, 'METROPOLIS', 'IgE serum', 600, 485, 6),
(61, 'METROPOLIS', 'IGG', 775, 710, 6),
(62, 'METROPOLIS', 'IGM', 600, 496, 6),
(63, 'METROPOLIS', 'IGRAS (Gamma Interferon) TB GOLD', 3200, 2312, 6),
(64, 'METROPOLIS', 'Insulin', 650, 540, 6),
(65, 'METROPOLIS', 'IONISED CALVIUM', 645, 467, 6),
(66, 'METROPOLIS', 'IRON , SERUM', 405, 276, 6),
(67, 'METROPOLIS', 'Iron Studies', 750, 475, 6),
(68, 'METROPOLIS', 'LDH Lactate Dehydrogenase Serum', 400, 314, 6),
(69, 'METROPOLIS', 'LFT', 750, 420, 6),
(70, 'METROPOLIS', 'LH-Leutinising Hormone (Specific),serum byCLIA', 270, 210, 6),
(71, 'METROPOLIS', 'LIPASE', 500, 430, 6),
(72, 'METROPOLIS', 'Lipid Profle-Mini', 450, 320, 6),
(73, 'METROPOLIS', 'MAGNICIUM', 460, 405, 6),
(74, 'METROPOLIS', 'Malaria Parasite Detection By Smear Examination ', 150, 150, 6),
(75, 'METROPOLIS', 'Microalbumin / Creatinine Ratio*', 550, 460, 6),
(76, 'METROPOLIS', 'Mullerian Inhibiting Substance', 1800, 1080, 6),
(77, 'METROPOLIS', 'PHOSPHROUS', 200, 192, 6),
(78, 'METROPOLIS', 'Post Lunch Glucose', 60, 60, 6),
(79, 'METROPOLIS', 'Potassium ISE Serum', 220, 220, 6),
(80, 'METROPOLIS', 'PRE OPERATIVE PROFILE MAJOR', 2000, 1350, 6),
(81, 'METROPOLIS', 'PRE-OPERATIVE PROFILE MINOR', 1110, 850, 6),
(82, 'METROPOLIS', 'PRO CALCITONIN', 2330, 1738, 6),
(83, 'METROPOLIS', 'PROJESTERON', 500, 320, 6),
(84, 'METROPOLIS', 'Prolactin', 450, 210, 6),
(85, 'METROPOLIS', 'Protein Electrophoresis', 860, 530, 6),
(86, 'METROPOLIS', 'PSA-total', 500, 375, 6),
(87, 'METROPOLIS', 'PT (PROTHOMBIN TIME )', 340, 232, 6),
(88, 'METROPOLIS', 'PTH-Para Thyroid Hormone', 1050, 860, 6),
(89, 'METROPOLIS', 'RA test Rheumatoid Arthritis Serum*', 350, 320, 6),
(90, 'METROPOLIS', 'Random Blood Sugar', 60, 60, 6),
(91, 'METROPOLIS', 'RFT', 750, 420, 6),
(92, 'METROPOLIS', 'SGOT AST Serum', 200, 166, 6),
(93, 'METROPOLIS', 'SGPT ALT Serum', 200, 166, 6),
(94, 'METROPOLIS', 'Sodium ISE Serum', 220, 220, 6),
(95, 'METROPOLIS', 'SYPHILIS', 1485, 1004, 6),
(96, 'METROPOLIS', 'T3 (Triiodothyronine ) Total Serum by CLIA', 235, 166, 6),
(97, 'METROPOLIS', 'T4 (Thyroxine) Total  Serum by CLIA', 235, 166, 6),
(98, 'METROPOLIS', 'Testosterone', 500, 309, 6),
(99, 'METROPOLIS', 'Thyroid panel-1 Total', 450, 188, 6),
(100, 'METROPOLIS', 'Thyroid panel-2 Free', 650, 309, 6),
(101, 'METROPOLIS', 'Torch 8', 2300, 1190, 6),
(102, 'METROPOLIS', 'Triglycerides', 180, 180, 6),
(103, 'METROPOLIS', 'TRUHEALTH DIAMOND ADVANCE BODY PROFILE', 2699, 2399, 6),
(104, 'METROPOLIS', 'TRUHEALTH DIAMOND BODY PROFILE', 1849, 1572, 6),
(105, 'METROPOLIS', 'TRUHEALTH GOLD BODY PROFILE', 1199, 1079, 6),
(106, 'METROPOLIS', 'TRUHEALTH PLATINUM BODY PROFILE', 1649, 1349, 6),
(107, 'METROPOLIS', 'TRUHEALTH SILVER BODY PROFILE', 999, 999, 6),
(108, 'METROPOLIS', 'TRUHEALTH WOMENS\' BODY PROFILE', 2999, 2699, 6),
(109, 'METROPOLIS', 'TSH-Ultrasensitive', 280, 144, 6),
(110, 'METROPOLIS', 'Uric Acid  Serum', 260, 230, 6),
(111, 'METROPOLIS', 'URINE - CS', 800, 600, 6),
(112, 'METROPOLIS', 'URINE-RM', 120, 120, 6),
(113, 'METROPOLIS', 'Vitamin B12', 600, 440, 6),
(114, 'METROPOLIS', 'Vitamin D Total-25 Hydroxy', 1100, 660, 6),
(115, 'METROPOLIS', 'Widal Test for Typhoid Serum', 250, 250, 6);

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2022_01_12_173356_create_permission_tables', 1);

-- --------------------------------------------------------

--
-- Table structure for table `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(1, 'App\\Models\\User', 1);

-- --------------------------------------------------------

--
-- Table structure for table `offer_master`
--

CREATE TABLE `offer_master` (
  `id` int(11) NOT NULL,
  `text` varchar(255) DEFAULT NULL,
  `promo_code` varchar(255) DEFAULT NULL,
  `value` int(11) DEFAULT NULL COMMENT 'in percentage %',
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `iStatus` int(11) NOT NULL DEFAULT '1',
  `isDelete` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `strIP` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `order`
--

CREATE TABLE `order` (
  `id` int(11) NOT NULL,
  `party_name` varchar(255) DEFAULT NULL,
  `no_of_member` int(11) DEFAULT '0',
  `start_date` timestamp NULL DEFAULT NULL,
  `end_date` timestamp NULL DEFAULT NULL,
  `link` varchar(255) DEFAULT NULL,
  `iStatus` int(11) NOT NULL DEFAULT '1',
  `isDelete` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `strIP` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `order_member`
--

CREATE TABLE `order_member` (
  `order_member_id` int(11) NOT NULL,
  `order_id` int(11) DEFAULT '0',
  `member_id` int(11) DEFAULT '0',
  `is_extra_member` int(11) DEFAULT '0',
  `extra_charge` int(11) DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `our_client`
--

CREATE TABLE `our_client` (
  `our_client_id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `our_client`
--

INSERT INTO `our_client` (`our_client_id`, `name`, `image`, `created_at`, `updated_at`) VALUES
(8, 'Devasya Speciality Hospital', '1756274584_27082025113304.webp', '2025-08-27 06:03:04', '2025-08-27 06:03:04'),
(9, 'Nobal Gastro Hospital', '1756275209_27082025114329.png', '2025-08-27 06:13:29', '2025-08-27 06:13:29'),
(10, 'Arihant Ortho Hospital', '1756275274_27082025114434.png', '2025-08-27 06:14:34', '2025-08-27 06:14:34'),
(11, 'Center For Sight Eye Hospital', '1756276396_27082025120316.svg', '2025-08-27 06:33:16', '2025-08-27 06:33:16'),
(12, 'Fine Feather Dental', '1756276449_27082025120409.webp', '2025-08-27 06:34:09', '2025-08-27 06:34:09'),
(13, 'Dwarkesh Orthopaedic Hospital', '1756276506_27082025120506.png', '2025-08-27 06:35:06', '2025-08-27 06:35:06'),
(14, 'Care & Cure Hospital', '1756276573_27082025120613.webp', '2025-08-27 06:36:13', '2025-08-27 06:36:13'),
(16, 'Unipath Lab', '1756276647_27082025120727.png', '2025-08-27 06:37:27', '2025-08-27 06:37:27'),
(17, 'Infinity Imaging Center', '1756276708_27082025120828.jpg', '2025-08-27 06:38:28', '2025-08-27 06:38:28'),
(19, 'Agilus Lab', '1756276908_27082025121148.jpeg', '2025-08-27 06:41:48', '2025-08-27 06:41:48'),
(24, '', '1757680355_12092025180235.jpg', '2025-09-12 12:32:35', '2025-09-12 12:32:35'),
(25, '', '1757680417_12092025180337.png', '2025-09-12 12:33:37', '2025-09-12 12:33:37');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'user-list', 'web', '2022-09-12 04:33:06', '2022-09-12 04:33:06'),
(2, 'user-create', 'web', '2022-09-12 04:33:06', '2022-09-12 04:33:06'),
(3, 'user-edit', 'web', '2022-09-12 04:33:06', '2022-09-12 04:33:06'),
(4, 'user-delete', 'web', '2022-09-12 04:33:06', '2022-09-12 04:33:06'),
(5, 'role-create', 'web', '2022-09-12 04:33:06', '2022-09-12 04:33:06'),
(6, 'role-edit', 'web', '2022-09-12 04:33:06', '2022-09-12 04:33:06'),
(7, 'role-list', 'web', '2022-09-12 04:33:06', '2022-09-12 04:33:06'),
(8, 'role-delete', 'web', '2022-09-12 04:33:06', '2022-09-12 04:33:06'),
(9, 'permission-list', 'web', '2022-09-12 04:33:06', '2022-09-12 04:33:06'),
(10, 'permission-create', 'web', '2022-09-12 04:33:06', '2022-09-12 04:33:06'),
(11, 'permission-edit', 'web', '2022-09-12 04:33:06', '2022-09-12 04:33:06'),
(12, 'permission-delete', 'web', '2022-09-12 04:33:06', '2022-09-12 04:33:06');

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `plans`
--

CREATE TABLE `plans` (
  `id` int(11) NOT NULL,
  `sequence_no` int(11) NOT NULL DEFAULT '0',
  `name` varchar(255) DEFAULT NULL,
  `amount` int(11) DEFAULT '0',
  `duration_in_days` varchar(255) DEFAULT NULL,
  `plan_image` varchar(255) DEFAULT NULL,
  `no_of_members` int(11) DEFAULT '0',
  `terms_and_condition` text,
  `wallet_balance` int(11) NOT NULL DEFAULT '0',
  `extra_amount_per_person` int(11) NOT NULL DEFAULT '0',
  `extra_amount_per_person_in_wallet` int(11) NOT NULL DEFAULT '0',
  `lab_max_applicable_amount_each_time` int(11) DEFAULT '0',
  `lab_minimum_order_value` int(11) NOT NULL DEFAULT '0',
  `lab_special_terms_and_condition` text,
  `iStatus` int(11) NOT NULL DEFAULT '1',
  `isDelete` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `strIP` varchar(255) DEFAULT NULL,
  `slugname` varchar(255) DEFAULT NULL,
  `plan_detail_pdf` varchar(500) DEFAULT NULL,
  `plan_detail_image` text,
  `is_corporate` int(11) NOT NULL DEFAULT '0' COMMENT '0 = no, 1= yes'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `plans`
--

INSERT INTO `plans` (`id`, `sequence_no`, `name`, `amount`, `duration_in_days`, `plan_image`, `no_of_members`, `terms_and_condition`, `wallet_balance`, `extra_amount_per_person`, `extra_amount_per_person_in_wallet`, `lab_max_applicable_amount_each_time`, `lab_minimum_order_value`, `lab_special_terms_and_condition`, `iStatus`, `isDelete`, `created_at`, `updated_at`, `strIP`, `slugname`, `plan_detail_pdf`, `plan_detail_image`, `is_corporate`) VALUES
(10, 0, 'Silver Plan', 399, '364', '1759313512_01102025154152.jpg', 2, NULL, 300, 150, 150, 150, 500, '<p>-</p>', 1, 0, '2025-05-24 09:37:17', '2025-10-02 06:49:03', '103.1.100.226', 'silver-plan', '1758703311_24092025141151.pdf', '<table cellspacing=\"0\" style=\"border-collapse:collapse; width:748px\">\r\n	<tbody>\r\n		<tr>\r\n			<td colspan=\"2\" style=\"border-bottom:2px solid black; border-left:2px solid black; border-right:2px solid black; border-top:2px solid black; vertical-align:center; width:533px\">\r\n			<p><strong><strong>Medical Boons - Family Health Savings Plan</strong></strong></p>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td style=\"border-bottom:2px solid black; border-left:2px solid black; border-right:2px solid black; border-top:none; vertical-align:center; width:533px\">\r\n			<p><strong><strong>Plan Name</strong></strong></p>\r\n			</td>\r\n			<td style=\"border-bottom:2px solid black; border-left:none; border-right:2px solid black; border-top:none; vertical-align:center; width:214px\">\r\n			<p><strong><strong>Silver</strong></strong></p>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td style=\"border-bottom:2px solid black; border-left:2px solid black; border-right:2px solid black; border-top:none; vertical-align:center; width:533px\">\r\n			<p>Validity of Plan</p>\r\n			</td>\r\n			<td style=\"border-bottom:2px solid black; border-left:none; border-right:2px solid black; border-top:none; vertical-align:center; width:214px\">\r\n			<p>1 Year</p>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td style=\"border-bottom:2px solid black; border-left:2px solid black; border-right:2px solid black; border-top:none; vertical-align:center; width:533px\">\r\n			<p>Waiting Period to avail Benefits</p>\r\n			</td>\r\n			<td style=\"border-bottom:2px solid black; border-left:none; border-right:2px solid black; border-top:none; vertical-align:center; width:214px\">\r\n			<p>3 Days</p>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td colspan=\"2\" style=\"border-bottom:2px solid black; border-left:2px solid black; border-right:2px solid black; border-top:none; vertical-align:center; width:533px\">\r\n			<p><strong>Exclusive Benefits (Wallet)</strong></p>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td style=\"border-bottom:2px solid black; border-left:2px solid black; border-right:2px solid black; border-top:none; vertical-align:center; width:533px\">\r\n			<p>Complementry Drs Consultation (Dental, Eye, Orthopedic, Urology)</p>\r\n			</td>\r\n			<td style=\"border-bottom:2px solid black; border-left:none; border-right:2px solid black; border-top:none; vertical-align:center; width:214px\">\r\n			<p>8000</p>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td style=\"border-bottom:2px solid black; border-left:2px solid black; border-right:2px solid black; border-top:none; vertical-align:center; width:533px\">\r\n			<p>Complementry Healing Session for 2 members</p>\r\n			</td>\r\n			<td style=\"border-bottom:2px solid black; border-left:none; border-right:2px solid black; border-top:none; vertical-align:center; width:214px\">\r\n			<p>1600</p>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td style=\"border-bottom:2px solid black; border-left:2px solid black; border-right:2px solid black; border-top:none; vertical-align:center; width:533px\">\r\n			<p>Complementry Audiometry Services at Home for 1 member</p>\r\n			</td>\r\n			<td style=\"border-bottom:2px solid black; border-left:none; border-right:2px solid black; border-top:none; vertical-align:center; width:214px\">\r\n			<p>1000</p>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td style=\"border-bottom:2px solid black; border-left:2px solid black; border-right:2px solid black; border-top:none; vertical-align:center; width:533px\">\r\n			<p>Complementry Lab discount Coupons worth Rs 150 per member</p>\r\n			</td>\r\n			<td style=\"border-bottom:2px solid black; border-left:none; border-right:2px solid black; border-top:none; vertical-align:center; width:214px\">\r\n			<p><strong><strong>150 x no of members</strong></strong></p>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td style=\"border-bottom:2px solid black; border-left:2px solid black; border-right:2px solid black; border-top:none; vertical-align:center; width:533px\" colspan=\"2\">\r\n			<p><strong>Regular Benefits</strong></p>\r\n			</td>\r\n\r\n		</tr>\r\n		<tr>\r\n			<td style=\"border-bottom:2px solid black; border-left:2px solid black; border-right:2px solid black; border-top:none; vertical-align:center; width:533px\">\r\n			<p>Drs Consultation &ndash; OPD</p>\r\n			</td>\r\n			<td style=\"border-bottom:2px solid black; border-left:none; border-right:2px solid black; border-top:none; vertical-align:center; width:214px\">\r\n			<p>UpTo 50%</p>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td style=\"border-bottom:2px solid black; border-left:2px solid black; border-right:2px solid black; border-top:none; vertical-align:center; width:533px\">\r\n			<p>Lab Testing</p>\r\n			</td>\r\n			<td style=\"border-bottom:2px solid black; border-left:none; border-right:2px solid black; border-top:none; vertical-align:center; width:214px\">\r\n			<p>UpTo 50%</p>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td style=\"border-bottom:2px solid black; border-left:2px solid black; border-right:2px solid black; border-top:none; vertical-align:center; width:533px\">\r\n			<p>Radiology &amp; Scanning</p>\r\n			</td>\r\n			<td style=\"border-bottom:2px solid black; border-left:none; border-right:2px solid black; border-top:none; vertical-align:center; width:214px\">\r\n			<p>UpTo 40%</p>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td style=\"border-bottom:2px solid black; border-left:2px solid black; border-right:2px solid black; border-top:none; vertical-align:center; width:533px\">\r\n			<p>Physiotherapy</p>\r\n			</td>\r\n			<td style=\"border-bottom:2px solid black; border-left:none; border-right:2px solid black; border-top:none; vertical-align:center; width:214px\">\r\n			<p>UpTo 30%</p>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td style=\"border-bottom:2px solid black; border-left:2px solid black; border-right:2px solid black; border-top:none; vertical-align:center; width:533px\">\r\n			<p>Homecare (Care-Taker, Nursing Staff)</p>\r\n			</td>\r\n			<td style=\"border-bottom:2px solid black; border-left:none; border-right:2px solid black; border-top:none; vertical-align:center; width:214px\">\r\n			<p>UpTo 20%</p>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td style=\"border-bottom:2px solid black; border-left:2px solid black; border-right:2px solid black; border-top:none; vertical-align:center; width:533px\">\r\n			<p>Helping Hand - Hospitalization Benefit (Case to Case)</p>\r\n			</td>\r\n			<td style=\"border-bottom:2px solid black; border-left:none; border-right:2px solid black; border-top:none; vertical-align:center; width:214px\">\r\n			<p>UpTo 20%</p>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td style=\"border-bottom:none; border-left:none; border-right:none; border-top:none; vertical-align:center; width:533px\">\r\n			<p>&nbsp;</p>\r\n			</td>\r\n			<td style=\"border-bottom:none; border-left:none; border-right:none; border-top:none; vertical-align:center; width:214px\">\r\n			<p>&nbsp;</p>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td colspan=\"2\" style=\"border-bottom:none; border-left:none; border-right:none; border-top:none; vertical-align:center; width:748px\">\r\n			<p><strong><strong>NOTE : All mentioned benefits are applicable on services avail within Network of Medical Boons Service Provider list.</strong></strong></p>\r\n			</td>\r\n		</tr>\r\n	</tbody>\r\n</table>', 0),
(11, 0, 'Gold Plan', 699, '364', '1759313547_01102025154227.jpg', 2, '<p>-</p>', 600, 300, 300, 300, 700, '<p>-</p>', 1, 0, '2025-08-01 10:12:11', '2025-10-01 12:55:05', '103.1.100.226', 'gold-plan', NULL, '<table cellspacing=\"0\" style=\"border-collapse:collapse; width:707px\">\r\n	<tbody>\r\n		<tr>\r\n			<td colspan=\"2\" style=\"border-bottom:1px solid black; border-left:1px solid black; border-right:1px solid black; border-top:1px solid black; vertical-align:center; width:565px\">\r\n			<p><strong><strong>Medical Boons - Family Health Savings Plan</strong></strong></p>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td style=\"border-bottom:2px solid black; border-left:1px solid black; border-right:2px solid black; border-top:none; vertical-align:center; width:565px\">\r\n			<p><strong><strong>Plan Name</strong></strong></p>\r\n			</td>\r\n			<td style=\"border-bottom:2px solid black; border-left:none; border-right:1px solid black; border-top:none; vertical-align:center; width:141px\">\r\n			<p><strong><strong>Gold</strong></strong></p>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td style=\"border-bottom:2px solid black; border-left:1px solid black; border-right:2px solid black; border-top:none; vertical-align:center; width:565px\">\r\n			<p>Validity of Plan</p>\r\n			</td>\r\n			<td style=\"border-bottom:2px solid black; border-left:none; border-right:1px solid black; border-top:none; vertical-align:center; width:141px\">\r\n			<p>1 Year</p>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td style=\"border-bottom:none; border-left:1px solid black; border-right:2px solid black; border-top:none; vertical-align:center; width:565px\">\r\n			<p>Waiting Period to avail Benefits</p>\r\n			</td>\r\n			<td style=\"border-bottom:none; border-left:none; border-right:1px solid black; border-top:none; vertical-align:center; width:141px\">\r\n			<p>3 Days</p>\r\n			</td>\r\n		</tr>\r\n		<tr id=\"middle-center\">\r\n			<td colspan=\"2\">\r\n			<p><strong><strong>Exclusive Benefits (Wallet) </strong></strong></p>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td style=\"border-bottom:2px solid black; border-left:1px solid black; border-right:2px solid black; border-top:none; vertical-align:center; width:565px\">\r\n			<p>Complementry Drs Consultation (Dental, Eye, Orthopedic, Urology)</p>\r\n			</td>\r\n			<td style=\"border-bottom:2px solid black; border-left:none; border-right:1px solid black; border-top:none; vertical-align:center; width:141px\">\r\n			<p>12000</p>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td style=\"border-bottom:2px solid black; border-left:1px solid black; border-right:2px solid black; border-top:none; vertical-align:center; width:565px\">\r\n			<p>Complementry Healing Session for 2 members</p>\r\n			</td>\r\n			<td style=\"border-bottom:2px solid black; border-left:none; border-right:1px solid black; border-top:none; vertical-align:center; width:141px\">\r\n			<p>1600</p>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td style=\"border-bottom:2px solid black; border-left:1px solid black; border-right:2px solid black; border-top:none; vertical-align:center; width:565px\">\r\n			<p>Complementry Audiometry Services at Home for 1 member</p>\r\n			</td>\r\n			<td style=\"border-bottom:2px solid black; border-left:none; border-right:1px solid black; border-top:none; vertical-align:center; width:141px\">\r\n			<p>2000</p>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td style=\"border-bottom:none; border-left:1px solid black; border-right:2px solid black; border-top:none; vertical-align:center; width:565px\">\r\n			<p>Complementry Lab discount Coupens worth Rs 300 per member</p>\r\n			</td>\r\n			<td style=\"border-bottom:none; border-left:none; border-right:1px solid black; border-top:none; vertical-align:center; width:141px\">\r\n			<p><strong><strong>300 x no of members</strong></strong></p>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td style=\"border-bottom:1px solid black; border-left:1px solid black; border-right:none; border-top:1px solid black; vertical-align:center; width:565px\">\r\n			<p><strong><strong>Regular Benefits</strong></strong></p>\r\n			</td>\r\n			<td style=\"border-bottom:1px solid black; border-left:none; border-right:1px solid black; border-top:1px solid black; vertical-align:center; width:141px\">\r\n			<p>&nbsp;</p>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td style=\"border-bottom:2px solid black; border-left:1px solid black; border-right:2px solid black; border-top:none; vertical-align:center; width:565px\">\r\n			<p>Drs Consultation - OPD</p>\r\n			</td>\r\n			<td style=\"border-bottom:2px solid black; border-left:none; border-right:1px solid black; border-top:none; vertical-align:center; width:141px\">\r\n			<p>UpTo 50%</p>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td style=\"border-bottom:2px solid black; border-left:1px solid black; border-right:2px solid black; border-top:none; vertical-align:center; width:565px\">\r\n			<p>Lab Testing</p>\r\n			</td>\r\n			<td style=\"border-bottom:2px solid black; border-left:none; border-right:1px solid black; border-top:none; vertical-align:center; width:141px\">\r\n			<p>UpTo 50%</p>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td style=\"border-bottom:2px solid black; border-left:1px solid black; border-right:2px solid black; border-top:none; vertical-align:center; width:565px\">\r\n			<p>Radiology &amp; Scanning</p>\r\n			</td>\r\n			<td style=\"border-bottom:2px solid black; border-left:none; border-right:1px solid black; border-top:none; vertical-align:center; width:141px\">\r\n			<p>UpTo 40%</p>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td style=\"border-bottom:2px solid black; border-left:1px solid black; border-right:2px solid black; border-top:none; vertical-align:center; width:565px\">\r\n			<p>Physiotherapy</p>\r\n			</td>\r\n			<td style=\"border-bottom:2px solid black; border-left:none; border-right:1px solid black; border-top:none; vertical-align:center; width:141px\">\r\n			<p>UpTo 30%</p>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td style=\"border-bottom:2px solid black; border-left:1px solid black; border-right:2px solid black; border-top:none; vertical-align:center; width:565px\">\r\n			<p>Homecare (Care-Taker, Nursing Staff)</p>\r\n			</td>\r\n			<td style=\"border-bottom:2px solid black; border-left:none; border-right:1px solid black; border-top:none; vertical-align:center; width:141px\">\r\n			<p>UpTo 20%</p>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td style=\"border-bottom:1px solid black; border-left:1px solid black; border-right:2px solid black; border-top:none; vertical-align:center; width:565px\">\r\n			<p>Helping Hand - Hospitalization Benefit (Case to Case)</p>\r\n			</td>\r\n			<td style=\"border-bottom:1px solid black; border-left:none; border-right:1px solid black; border-top:none; vertical-align:center; width:141px\">\r\n			<p>UpTo 20%</p>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td style=\"border-bottom:none; border-left:none; border-right:none; border-top:none; vertical-align:center; width:565px\">\r\n			<p>&nbsp;</p>\r\n			</td>\r\n			<td style=\"border-bottom:none; border-left:none; border-right:none; border-top:none; vertical-align:center; width:141px\">\r\n			<p>&nbsp;</p>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td colspan=\"2\" style=\"border-bottom:none; border-left:none; border-right:none; border-top:none; vertical-align:center; width:706px\">\r\n			<p><strong><strong>NOTE : All mentioned benefits are applicable on services avail within Network of Medical Boons Service Provider list.</strong></strong></p>\r\n			</td>\r\n		</tr>\r\n	</tbody>\r\n</table>', 0),
(12, 0, 'Corporate Plan', 5000, '364', '1759314398_01102025155638.jpg', 4, '<p>hgjhgjhgj</p>', 0, 0, 0, 0, 500, '<p><strong>One size doesn&rsquo;t fit all &mdash; your plan, your way.</strong></p>\r\n\r\n<p><strong><strong>Tailored health benefits for your employees.</strong></strong></p>\r\n\r\n<p><strong><strong><em>Healthy employees build stronger companies. Our corporate plans are customized for teams of every size, covering preventive and wellness services at flexible pricing. Share your requirements and we&rsquo;ll design a plan just for your workforce.</em></strong></strong></p>', 1, 0, '2025-09-29 05:26:39', '2025-10-01 10:26:38', '103.1.100.226', 'corporate-plan', NULL, '<p>We Provide All Kind Of HealthCare Services Like Doctor Consultation, Hospitalization, Lab Test, Radiology &amp;&nbsp;Imaging Services, Physiotherapy, Healing, Home Care services&nbsp;at most reasonable pricing with top&nbsp;&amp; trusted Healthcare Service Providers in Ahmedabad.</p>\r\n\r\n<p>Every Company has different type of staff &amp; needs. So selection of services are vary from company to&nbsp;company based on the nature of work, size of employees &amp; many more...</p>\r\n\r\n<p>Feel free to Contact Us on 9974660451.</p>\r\n\r\n<p>Or write us on info@medicalboons.com&nbsp;</p>', 1),
(13, 0, 'Community Plan', 5000, '364', '1759313595_01102025154315.jpg', 4, '<p>-</p>', 0, 0, 0, 0, 500, '<p><strong>One size doesn&rsquo;t fit all &mdash; your plan, your way.</strong></p>\r\n\r\n<p><strong><strong>Tailored health benefits for your community.</strong></strong></p>\r\n\r\n<p><strong><strong><em>Stronger communities start with better health. Our community plans are designed for societies, clubs, and groups of all sizes, offering preventive and wellness services at flexible pricing. Share your needs and we&rsquo;ll prepare a customized plan for your members.</em></strong></strong></p>', 1, 0, '2025-10-01 07:39:41', '2025-10-01 10:34:31', '103.1.100.226', 'community-plan', NULL, '<p>We Provide All Kind Of Healthcare Services Like Doctor Consultation, Hospitalization, Lab Test, Radiology &amp;&nbsp;Imaging Services, Physiotherapy, Healing, Home Care services&nbsp;at most reasonable pricing with top&nbsp;&amp; trusted Healthcare Service Providers in Ahmedabad.</p>\r\n\r\n<p>Every Community&nbsp;has different type of members&nbsp;with different age groups and needs. So selection of services are vary for every&nbsp;family members medical history, their location and preferances &amp; many more...</p>\r\n\r\n<p>For more details, Feel free to Contact Us on 9974660451.</p>\r\n\r\n<p>Or write us on info@medicalboons.com&nbsp;</p>', 1);

-- --------------------------------------------------------

--
-- Table structure for table `plan_details`
--

CREATE TABLE `plan_details` (
  `id` int(11) NOT NULL,
  `plan_id` int(11) DEFAULT '0',
  `service_id` int(11) NOT NULL DEFAULT '0',
  `sub_service_id` int(11) NOT NULL DEFAULT '0',
  `service_description` text,
  `amount` int(11) DEFAULT '0',
  `discount` int(11) NOT NULL DEFAULT '0',
  `extra_amount` int(11) NOT NULL DEFAULT '0',
  `iStatus` int(11) NOT NULL DEFAULT '1',
  `isDelete` int(11) NOT NULL DEFAULT '0',
  `strIP` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `session_count` int(11) DEFAULT '0',
  `valuation` int(11) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `plan_details`
--

INSERT INTO `plan_details` (`id`, `plan_id`, `service_id`, `sub_service_id`, `service_description`, `amount`, `discount`, `extra_amount`, `iStatus`, `isDelete`, `strIP`, `created_at`, `updated_at`, `session_count`, `valuation`) VALUES
(4, 4, 5, 0, '<p>FNGFJDGDJGN<br>JFKLFKJG<br>KFJKFLDJ</p>', 400, 0, 400, 1, 0, '103.1.100.226', '2025-04-17 11:00:17', '2025-04-17 12:08:48', 30, 600),
(7, 10, 9, 9, '<p>-</p>', 0, 0, 0, 1, 0, '103.1.100.226', '2025-08-01 09:33:39', '2025-08-01 09:33:39', 2, 1250),
(8, 10, 9, 17, '<p>complementary</p>', 0, 0, 0, 1, 0, '103.1.100.226', '2025-08-01 09:35:26', '2025-08-01 09:35:26', 4, 1400),
(9, 10, 9, 18, '<p>complementary</p>', 0, 0, 0, 1, 0, '103.1.100.226', '2025-08-01 09:36:11', '2025-08-01 09:36:11', 4, 2000),
(10, 10, 9, 16, '<p>complementary</p>', 0, 0, 0, 1, 0, '103.1.100.226', '2025-08-01 09:36:37', '2025-08-01 09:36:37', 2, 1600),
(11, 10, 14, 0, '<p>complementary</p>', 0, 0, 0, 1, 0, '103.1.100.226', '2025-08-01 09:36:58', '2025-08-01 09:36:58', 2, 1000);

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'web', '2022-09-12 04:33:06', '2022-09-12 04:33:06'),
(2, 'Corporate', 'web', '2022-09-12 04:33:06', '2022-09-12 04:33:06'),
(3, 'Agent', 'web', '2022-09-12 04:33:06', '2022-09-12 04:33:06');

-- --------------------------------------------------------

--
-- Table structure for table `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role_has_permissions`
--

INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES
(1, 1),
(2, 1),
(3, 1),
(4, 1),
(5, 1),
(6, 1),
(7, 1),
(8, 1),
(9, 1),
(10, 1),
(11, 1),
(12, 1);

-- --------------------------------------------------------

--
-- Table structure for table `sendemaildetails`
--

CREATE TABLE `sendemaildetails` (
  `id` int(11) NOT NULL,
  `strSubject` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `strTitle` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `strFromMail` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ToMail` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  `strCC` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  `strBCC` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `sendemaildetails`
--

INSERT INTO `sendemaildetails` (`id`, `strSubject`, `strTitle`, `strFromMail`, `ToMail`, `strCC`, `strBCC`) VALUES
(4, 'Contact Inquiry', 'Medical Boons', 'info@medicalboons.com', NULL, '', ''),
(8, 'Product Inquiry', 'Medical Boons', 'info@medicalboons.com', NULL, NULL, NULL),
(9, 'User', 'Medical Boons', 'info@medicalboons.com', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `id` int(11) NOT NULL,
  `sequence_no` int(11) NOT NULL DEFAULT '1000',
  `name` varchar(255) DEFAULT NULL,
  `slug_name` varchar(255) DEFAULT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `description` longtext,
  `iStatus` int(11) NOT NULL DEFAULT '1',
  `isDelete` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `strIP` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`id`, `sequence_no`, `name`, `slug_name`, `photo`, `description`, `iStatus`, `isDelete`, `created_at`, `updated_at`, `strIP`) VALUES
(9, 1000, 'Doctors consultation', 'doctors-consultation', 'download.png', 'OPD/IPD', 1, 0, '2025-05-24 07:34:16', '2025-05-24 07:37:44', '103.1.100.226'),
(10, 1000, 'Scan', 'scan', NULL, '-', 1, 0, '2025-05-24 07:34:26', '2025-05-24 07:34:26', '103.1.100.226'),
(11, 1000, 'Physiotherapy', 'physiotherapy', NULL, '-', 1, 0, '2025-05-24 07:34:51', '2025-05-24 07:34:51', '103.1.100.226'),
(12, 1000, 'Wellness', 'wellness', NULL, '-', 1, 0, '2025-05-24 07:35:09', '2025-05-24 07:35:09', '103.1.100.226'),
(13, 1000, 'Home care', 'home-care', NULL, '-', 1, 0, '2025-05-24 07:35:31', '2025-05-24 07:35:31', '103.1.100.226'),
(14, 1000, 'Healing', 'healing', NULL, '-', 1, 0, '2025-05-24 07:36:03', '2025-05-24 07:36:03', '103.1.100.226'),
(15, 1000, 'Helping hands', 'helping-hands', NULL, 'Health insurance support and weaver self paid cost', 1, 0, '2025-05-24 07:36:25', '2025-09-12 07:00:38', '103.1.100.226'),
(16, 1000, 'Packages', 'packages', NULL, '-', 1, 0, '2025-09-24 08:38:11', '2025-09-24 08:38:11', '103.1.100.226');

-- --------------------------------------------------------

--
-- Table structure for table `sub_service`
--

CREATE TABLE `sub_service` (
  `sub_service_id` int(11) NOT NULL,
  `subservice_name` varchar(45) DEFAULT NULL,
  `service_id` varchar(45) DEFAULT '0',
  `iStatus` int(11) DEFAULT '1',
  `isDelete` int(11) DEFAULT '0',
  `strIP` text,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `sub_description` text,
  `slug_name` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sub_service`
--

INSERT INTO `sub_service` (`sub_service_id`, `subservice_name`, `service_id`, `iStatus`, `isDelete`, `strIP`, `created_at`, `updated_at`, `sub_description`, `slug_name`) VALUES
(9, 'Urology', '9', 1, 0, '103.1.100.226', '2025-05-24 07:38:38', '2025-05-24 07:38:38', '-', ''),
(10, 'Spine surgery', '9', 1, 0, '103.1.100.226', '2025-05-24 07:39:25', '2025-05-24 07:39:25', '-', ''),
(11, 'Oncology', '9', 1, 0, '103.1.100.226', '2025-05-24 07:40:06', '2025-05-24 07:40:06', '-', ''),
(12, 'Gastro- enterology', '9', 1, 0, '103.1.100.226', '2025-05-24 07:40:42', '2025-05-24 07:40:42', '-', ''),
(13, 'Neurology', '9', 1, 0, '103.1.100.226', '2025-05-24 07:41:03', '2025-05-24 07:41:03', '-', ''),
(14, 'Cardiology', '9', 1, 0, '103.1.100.226', '2025-05-24 07:41:26', '2025-05-24 07:41:26', '-', ''),
(15, 'Physiotherapy -  neuro rehabilitation', '11', 1, 0, '103.1.100.226', '2025-05-24 09:19:22', '2025-05-24 09:19:22', '-', ''),
(16, 'Orthopadic', '9', 1, 0, '103.1.100.226', '2025-05-24 09:19:51', '2025-05-24 09:19:51', '-', ''),
(17, 'Ophthl – eye', '9', 1, 0, '103.1.100.226', '2025-05-24 09:21:01', '2025-05-24 09:21:01', '-', ''),
(18, 'Dentistry', '9', 1, 0, '103.1.100.226', '2025-05-24 09:22:07', '2025-05-24 09:22:07', '-', ''),
(19, 'MD physician', '9', 1, 0, '103.1.100.226', '2025-05-24 09:22:33', '2025-05-24 09:22:33', '-', ''),
(20, 'General surgeon', '9', 1, 0, '103.1.100.226', '2025-05-24 09:23:38', '2025-05-24 09:23:38', '-', ''),
(21, 'Gynacology', '9', 1, 0, '103.1.100.226', '2025-05-24 09:23:47', '2025-05-24 09:23:47', '-', ''),
(22, 'Pediatrics', '9', 1, 0, '103.1.100.226', '2025-05-24 09:23:56', '2025-05-24 09:23:56', '-', ''),
(23, 'Homeopathy', '9', 1, 0, '103.1.100.226', '2025-05-24 09:24:10', '2025-05-24 09:24:10', '-', ''),
(24, 'CT Scan', '10', 1, 0, '103.1.100.226', '2025-09-12 07:02:57', '2025-09-12 07:02:57', '-', ''),
(25, 'MRI', '10', 1, 0, '103.1.100.226', '2025-09-12 07:03:09', '2025-09-12 07:03:09', '-', ''),
(26, 'PET-CT Scan', '10', 1, 0, '103.1.100.226', '2025-09-12 07:03:44', '2025-09-12 07:03:44', '-', '');

-- --------------------------------------------------------

--
-- Table structure for table `supratech_fr4a`
--

CREATE TABLE `supratech_fr4a` (
  `SR NO` int(11) NOT NULL,
  `LAB` varchar(9) DEFAULT NULL,
  `TEST_LIST` varchar(62) DEFAULT NULL,
  `MRP` varchar(4) DEFAULT NULL,
  `OFFER_PRICE` varchar(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `supratech_fr4a`
--

INSERT INTO `supratech_fr4a` (`SR NO`, `LAB`, `TEST_LIST`, `MRP`, `OFFER_PRICE`) VALUES
(2, 'Supratech', '25 OH Cholecalciferol (D2+D3)', '1400', '750'),
(3, 'Supratech', 'Absolute Eosinophil Count', '300', '200'),
(4, 'Supratech', 'ACTH Level [Adrenocorticotropic hormone]', '1300', '1000'),
(5, 'Supratech', 'ADH - Anti Diuretic Hormone', '4100', '4070'),
(6, 'Supratech', 'Alkaline Phosphatase level', '250', '200'),
(7, 'Supratech', 'Ammonia', '600', '440'),
(8, 'Supratech', 'Amylase-Serum', '600', '330'),
(9, 'Supratech', 'ANA 25', '3800', '2900'),
(10, 'Supratech', 'ANA PROFILE (Auto antibody profile)', '4350', '3300'),
(12, 'Supratech', 'Anti CCP Level', '1000', '880'),
(13, 'Supratech', 'Anti ds DNA (IIF)', '1400', '880'),
(14, 'Supratech', 'Anti Mullerian Hormone -(AMH)', '2000', '1350'),
(15, 'Supratech', 'Anti Nuclear Antibody ( IIF )', '800', '550'),
(16, 'Supratech', 'Anti Nuclear antibody-FEIA/ELISA', '800', '800'),
(17, 'Supratech', 'Anti Thyroid Antibody', '1200', '900'),
(18, 'Supratech', 'Apolipoprotein A - 1', '500', '360'),
(19, 'Supratech', 'Apolipoprotein A-1+B', '800', '715'),
(20, 'Supratech', 'Apolipoprotein B', '500', '360'),
(21, 'Supratech', 'Beta HCG level', '600', '330'),
(22, 'Supratech', 'Bicarbonate', '500', '440'),
(23, 'Supratech', 'Blood Gas (Arterial)', '1200', '1100'),
(24, 'Supratech', 'Blood Gas (Venous)', '1200', '1100'),
(25, 'Supratech', 'Blood Group & RH', '200', '200'),
(26, 'Supratech', 'Blood Urea Nitrogen (BUN)', '250', '200'),
(27, 'Supratech', 'C- Reactive Protein', '450', '385'),
(28, 'Supratech', 'CA-125 level', '800', '550'),
(29, 'Supratech', 'CA-15-3 level', '1200', '770'),
(30, 'Supratech', 'CA-19-9 level', '1200', '880'),
(31, 'Supratech', 'Calcitonin level', '1300', '1100'),
(32, 'Supratech', 'Calcium', '250', '200'),
(33, 'Supratech', 'Carcino Embryonic Antigen level', '800', '440'),
(34, 'Supratech', 'Chikungunya antibody (IgG+IgM)-FIA', '800', '800'),
(35, 'Supratech', 'Chikungunya antibody IgM', '800', '715'),
(36, 'Supratech', 'Chikungunya IgG-Rapid', '500', '500'),
(37, 'Supratech', 'Chikungunya IgM-Rapid', '500', '500'),
(38, 'Supratech', 'Chikungunya Qualitative by Real-time PCR', '2200', '1870'),
(39, 'Supratech', 'Chikungunya Viral Load (Quantitative)', '2500', '2420'),
(40, 'Supratech', 'Chloride', '250', '200'),
(41, 'Supratech', 'Cholesterol', '250', '200'),
(42, 'Supratech', 'Clotting Time', '100', '100'),
(43, 'Supratech', 'Cortisol 8 AM', '700', '550'),
(44, 'Supratech', 'Cortisol level- Random', '700', '550'),
(45, 'Supratech', 'Cortisol PM', '700', '550'),
(46, 'Supratech', 'C-Peptide level', '1300', '770'),
(47, 'Supratech', 'CPK Total', '700', '500'),
(48, 'Supratech', 'CPK-MB level', '700', '700'),
(49, 'Supratech', 'Creatinine', '250', '200'),
(51, 'Supratech', 'Dengue and Chikungunya PCR combo', '3000', '2850'),
(52, 'Supratech', 'Dengue antibody IgG - ELISA', '700', '495'),
(53, 'Supratech', 'Dengue antibody IgG & IgM-Elisa', '1400', '1320'),
(54, 'Supratech', 'Dengue antibody IgG & IgM-FIA', '1400', '1320'),
(55, 'Supratech', 'Dengue antibody IgG-Rapid', '700', '550'),
(56, 'Supratech', 'Dengue antibody IgM - ELISA', '700', '495'),
(57, 'Supratech', 'Dengue antibody IgM-Rapid', '700', '550'),
(58, 'Supratech', 'Dengue antibody-Rapid', '700', '550'),
(59, 'Supratech', 'Dengue Antigen (NS1)- Rapid', '700', '700'),
(60, 'Supratech', 'Dengue Antigen NS1 Elisa', '700', '700'),
(61, 'Supratech', 'Dengue antigen NS1-FIA', '700', '700'),
(62, 'Supratech', 'Dengue Qualitative by Real-time PCR', '2200', '1870'),
(63, 'Supratech', 'Dengue Rapid(NS1+Antibody)', '900', '900'),
(64, 'Supratech', 'DHEA-S', '750', '605'),
(65, 'Supratech', 'DHR', '4000', '3520'),
(66, 'Supratech', 'Diabetes Panel 1 - NIDDM 1', '150', '150'),
(67, 'Supratech', 'Digoxin Level (TDM)', '800', '770'),
(68, 'Supratech', 'Dihydrotestosterone level', '1500', '1320'),
(69, 'Supratech', 'Dilantin (Phenytoin) level (TDM)', '800', '605'),
(70, 'Supratech', 'DMD (Duchenne Muscular Dystrophy) deletion/duplication by\nMLPA', '8000', '7000'),
(71, 'Supratech', 'DNA Fingerprint (Autosomal STR)', '9000', '8500'),
(72, 'Supratech', 'Double Marker', '1750', '1320'),
(73, 'Supratech', 'Double marker by Astraia', '2250', '2145'),
(74, 'Supratech', 'Double marker by Delfia Xpress', '2250', '2145'),
(75, 'Supratech', 'Double marker by DELFIA-Smart report', '2250', '2145'),
(76, 'Supratech', 'Double Marker with Delfia Graph', '2250', '2145'),
(77, 'Supratech', 'Double marker with PlGF-Astraia', '3200', '2640'),
(78, 'Supratech', 'Double marker with PlGF-Delfia', '3200', '2640'),
(79, 'Supratech', 'DSA by Luminex (HLA Cross Match)', '6000', '5720'),
(80, 'Supratech', 'DsDNA antibody IgG', '1400', '880'),
(81, 'Supratech', 'E GFR (MDRD) (Calc)', '300', '275'),
(84, 'Supratech', 'Estradiol level', '550', '330'),
(85, 'Supratech', 'Fasting Insulin & Glucose', '850', '484'),
(86, 'Supratech', 'Ferritin', '600', '330'),
(87, 'Supratech', 'Free Beta HCG level', '1000', '770'),
(88, 'Supratech', 'Free Kappa Chain', '2100', '2100'),
(89, 'Supratech', 'Free Kappa Lambda Chain Ratio', '3500', '3300'),
(90, 'Supratech', 'Free Lambda Chain', '2100', '2100'),
(91, 'Supratech', 'Free Prostate Specific Antigen', '1000', '605'),
(92, 'Supratech', 'Free Testosterone', '1200', '1100'),
(93, 'Supratech', 'Free Thyroxine(Free T4)', '300', '209'),
(94, 'Supratech', 'Free Triiodothyronine(Free T3)', '300', '209'),
(95, 'Supratech', 'Fungus Culture', '1200', '770'),
(96, 'Supratech', 'G6PD', '400', '374'),
(97, 'Supratech', 'G6PD Qualitative', '450', '374'),
(98, 'Supratech', 'G6PD Quantitative', '550', '374'),
(99, 'Supratech', 'GAD Antibody', '2000', '2000'),
(100, 'Supratech', 'Gamma Glutamyl Transferase (GGT)', '250', '250'),
(101, 'Supratech', 'Glucose - Fasting', '80', '80'),
(102, 'Supratech', 'Glucose - Post Dinner', '80', '80'),
(103, 'Supratech', 'Glucose - Post Prandial', '80', '80'),
(104, 'Supratech', 'Glucose - Pre Dinner', '80', '80'),
(105, 'Supratech', 'Glucose - Random', '80', '80'),
(106, 'Supratech', 'Glyco Hemoglobin (HbA1c)', '600', '275'),
(107, 'Supratech', 'GTT 3 Samples', '250', '250'),
(108, 'Supratech', 'GTT Extended (5 samples)', '400', '400'),
(109, 'Supratech', 'H.Pylori antibody IgA', '450', '440'),
(110, 'Supratech', 'H.Pylori antibody IgG', '450', '440'),
(111, 'Supratech', 'H.Pylori antibody IgM', '450', '440'),
(113, 'Supratech', 'Haemogram (CBC) LAB', '350', '245'),
(114, 'Supratech', 'Haemogram and Malaria Parasite (CBC-MP)', '450', '350'),
(115, 'Supratech', 'Haemogram with ESR (CBC-ESR)', '450', '440'),
(116, 'Supratech', 'HAV antibody IgM', '800', '660'),
(117, 'Supratech', 'HB Electrophoresis (Capillary)', '800', '605'),
(118, 'Supratech', 'HBs antibody', '800', '495'),
(119, 'Supratech', 'HBsAg', '300', '220'),
(120, 'Supratech', 'HBV (Hepatitis B) Qualitative by Real-time PCR', '1800', '1800'),
(121, 'Supratech', 'HBV (Hepatitis B) Quantitative by Real-time PCR', '2500', '2500'),
(122, 'Supratech', 'HCV (Hepatitis C) Qualitative by Real-time PCR', '1800', '1800'),
(123, 'Supratech', 'HCV (Hepatitis C) Quantitative by Real-time PCR', '2500', '2500'),
(124, 'Supratech', 'HCV antibody IgM', '1450', '1450'),
(125, 'Supratech', 'HCV antibody Total', '800', '660'),
(126, 'Supratech', 'High Sensitive CRP', '400', '400'),
(127, 'Supratech', 'HIV I & II', '600', '330'),
(128, 'Supratech', 'HLA B 27 By Real-time PCR', '2500', '1870'),
(129, 'Supratech', 'HLAb 27 By Flowcytometry', '2000', '1540'),
(130, 'Supratech', 'Homa IR (Mass Unit)', '1000', '880'),
(131, 'Supratech', 'Homocysteine level', '1200', '880'),
(132, 'Supratech', 'IgA level', '600', '440'),
(133, 'Supratech', 'IgE level', '600', '330'),
(134, 'Supratech', 'IgG level', '600', '440'),
(135, 'Supratech', 'IgH By FISH', '3500', '3500'),
(136, 'Supratech', 'IgM level', '600', '440'),
(137, 'Supratech', 'IL-6 level', '2000', '1210'),
(138, 'Supratech', 'Insulin Fasting', '800', '440'),
(139, 'Supratech', 'Insulin Random', '800', '440'),
(140, 'Supratech', 'Ionic Calcium', '600', '308'),
(141, 'Supratech', 'Iron Level', '500', '275'),
(142, 'Supratech', 'Iron Studies (TIBC)', '600', '495'),
(143, 'Supratech', 'LDH', '600', '374'),
(144, 'Supratech', 'LDL Cholesterol (Direct)', '250', '250'),
(145, 'Supratech', 'Leutinizing Hormone level', '550', '209'),
(147, 'Supratech', 'Lipid Profile', '700', '418'),
(148, 'Supratech', 'Lipoprotein (a)', '800', '660'),
(149, 'Supratech', 'Liver Function Test', '1000', '880'),
(150, 'Supratech', 'Magnesium Level', '450', '264'),
(151, 'Supratech', 'Major Pre Operative Profile', '1850', '1540'),
(152, 'Supratech', 'Malarial parasite (  smear )', '200', '200'),
(153, 'Supratech', 'Minor Pre Operative Profile', '1450', '1320'),
(154, 'Supratech', 'Occult Blood', '150', '150'),
(155, 'Supratech', 'Para Thyroid Hormone Intact level', '900', '770'),
(156, 'Supratech', 'Potassium', '250', '200'),
(157, 'Supratech', 'Procalcitonin', '2400', '1980'),
(158, 'Supratech', 'Progesterone level', '600', '275'),
(159, 'Supratech', 'Prolactin level', '550', '209'),
(160, 'Supratech', 'Prostate Specific Antigen level', '700', '418'),
(161, 'Supratech', 'Protein With A/G Ratio', '250', '200'),
(162, 'Supratech', 'Prothrombin Time (Photooptical clot detection)', '300', '198'),
(163, 'Supratech', 'PSA Profile (Free PSA/PSA Ratio)', '1400', '770'),
(164, 'Supratech', 'Rapid Malarial Antigen ( Card )', '450', '330'),
(165, 'Supratech', 'Rapid Plasma Reagin (VDRL)', '400', '220'),
(166, 'Supratech', 'RBC', '100', '100'),
(167, 'Supratech', 'Renal Function Test', '900', '770'),
(168, 'Supratech', 'Rheumatoid Factor', '400', '330'),
(169, 'Supratech', 'SGOT (AST)', '250', '200'),
(170, 'Supratech', 'SGPT (ALT)', '250', '200'),
(171, 'Supratech', 'Sodium', '250', '200'),
(172, 'Supratech', 'Stool Examination', '250', '242'),
(173, 'Supratech', 'Syphilis Antibody', '400', '330'),
(174, 'Supratech', 'Testosterone level', '550', '297'),
(175, 'Supratech', 'Thyroglobulin antibody', '600', '330'),
(176, 'Supratech', 'Thyroglobulin level', '1300', '1100'),
(177, 'Supratech', 'Thyroid Function Test', '600', '231'),
(178, 'Supratech', 'Thyroperoxidase Antibody (Anti-TPO)/Microsomal antibody', '600', '440'),
(179, 'Supratech', 'Thyroxine Binding Globulin level', '1000', '1000'),
(180, 'Supratech', 'Thyroxine -T4', '200', '180'),
(181, 'Supratech', 'Tissue Transglutaminase antibody IgA (TTG-A)', '850', '850'),
(182, 'Supratech', 'Tissue Transglutaminase antibody IgG & IgA', '1500', '1320'),
(183, 'Supratech', 'Torch Complex (10 Parameters)', '2800', '1800'),
(184, 'Supratech', 'Torch Complex (8 parameters)', '2500', '1500'),
(185, 'Supratech', 'Torch IgG', '1250', '605'),
(186, 'Supratech', 'Torch IgM', '1250', '605'),
(187, 'Supratech', 'TORCH Infections Qualitative by Real-Time PCR', '4000', '3740'),
(188, 'Supratech', 'Total Kappa Light Chain', '1800', '1540'),
(189, 'Supratech', 'Total Lambada Light Chain', '1500', '1320'),
(190, 'Supratech', 'Transferrin Saturation', '600', '594'),
(191, 'Supratech', 'Triglyceride', '250', '250'),
(192, 'Supratech', 'Triiodothyronine - T3', '200', '180'),
(193, 'Supratech', 'Troponin I', '1000', '605'),
(194, 'Supratech', 'Troponin T', '1000', '605'),
(195, 'Supratech', 'TSH', '250', '165'),
(196, 'Supratech', 'Unsaturated Iron Binding Capacity', '250', '250'),
(197, 'Supratech', 'Urea', '250', '200'),
(198, 'Supratech', 'Uric Acid', '250', '200'),
(199, 'Supratech', 'Urinary Albumin Creatinine ratio UACR', '850', '440'),
(200, 'Supratech', 'Urinary Protein Creatinine Ratio', '350', '350'),
(201, 'Supratech', 'Urine Examination -U ( Flow Cytometry )', '170', '170'),
(202, 'Supratech', 'Valproic acid (TDM)', '800', '550'),
(203, 'Supratech', 'Vancomycin level', '4000', '4000'),
(204, 'Supratech', 'Vitamin B - 12 Level', '900', '418'),
(205, 'Supratech', 'VLDL Cholesterol', '100', '100'),
(206, 'Supratech', 'Voriconazole Level (TDM)', '3800', '3800'),
(207, 'Supratech', 'WIDAL by tube method', '300', '187'),
(208, 'Supratech', 'Y-Chromosomal Microdeletion by PCR', '4500', '4500'),
(209, 'Supratech', 'ZIKA Qualitative by Real-time PCR', '2500', '2500'),
(210, '', '', '', ' ');

-- --------------------------------------------------------

--
-- Table structure for table `Testimonial`
--

CREATE TABLE `Testimonial` (
  `Testimonial_id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `comment` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `Users`
--

CREATE TABLE `Users` (
  `Users_id` int(11) NOT NULL,
  `company_name` varchar(45) DEFAULT NULL,
  `contact_person` varchar(45) DEFAULT NULL,
  `mobile` bigint(20) DEFAULT '0',
  `email` varchar(45) DEFAULT NULL,
  `Address` varchar(45) DEFAULT NULL,
  `Type` int(11) DEFAULT '0' COMMENT 'corporate = 1, B2B = 2',
  `Main_parent_id` int(11) DEFAULT '0',
  `Parent_id` int(11) DEFAULT '0',
  `Guid` text,
  `link` text,
  `password` varchar(100) DEFAULT NULL,
  `iStatus` int(11) DEFAULT '1',
  `isDelete` int(11) DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `strIP` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `Users`
--

INSERT INTO `Users` (`Users_id`, `company_name`, `contact_person`, `mobile`, `email`, `Address`, `Type`, `Main_parent_id`, `Parent_id`, `Guid`, `link`, `password`, `iStatus`, `isDelete`, `created_at`, `updated_at`, `strIP`) VALUES
(1, 'Apollo infotech', 'kunal', 9898808754, 'kunal@gmail.com', 'Narol', 2, 0, 0, 'dfc8669a-24ee-4a1c-b6ee-1d2105432b1b', NULL, '$2y$12$n1aATrvYPt6uSMbkysEd9Odp7PWtyL9YBvnfAaSKgoxgXrRLVCc.K', 1, 0, '2025-09-30 14:06:14', '2025-09-30 14:06:14', '103.1.100.226'),
(2, 'Apollo infotech', 'krupa', 9723151289, 'krupa@gmail.com', 'Isanpur', 1, 0, 0, 'dbd67ff4-9193-42ca-933b-55127b311202', NULL, '$2y$12$nJGSTQIsAA0hNpFfLCPQ8O2jIk7AsDr4k5elx6j2boT7Rwq/fjZeq', 1, 0, '2025-09-30 14:07:16', '2025-09-30 14:07:16', '103.1.100.226');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `first_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `company_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contact_person` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mobile_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` text COLLATE utf8mb4_unicode_ci,
  `guid` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `link` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role_id` int(11) NOT NULL DEFAULT '2' COMMENT '1=Admin, 2=TA/TP',
  `main_parent_id` int(11) NOT NULL DEFAULT '0',
  `parent_id` int(11) NOT NULL DEFAULT '0',
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `company_name`, `contact_person`, `email`, `mobile_number`, `address`, `guid`, `link`, `password`, `role_id`, `main_parent_id`, `parent_id`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Super', 'Admin', NULL, NULL, 'admin@admin.com', '9028187696', 'Narol', NULL, NULL, '$2y$12$6kmxx2hxOBlaVQX5tIPiDuhig1cmNXdtORS5v6jPclUNgZ.0ilc7C', 1, 0, 0, 1, '2022-09-12 04:33:06', '2025-04-17 12:18:19');

-- --------------------------------------------------------

--
-- Table structure for table `wallets`
--

CREATE TABLE `wallets` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `total_amount` decimal(10,2) DEFAULT '0.00',
  `used_amount` decimal(10,2) DEFAULT '0.00',
  `available_amount` decimal(10,2) DEFAULT '0.00',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `associated_members`
--
ALTER TABLE `associated_members`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `banner`
--
ALTER TABLE `banner`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `blog`
--
ALTER TABLE `blog`
  ADD PRIMARY KEY (`blogId`);

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `card_member`
--
ALTER TABLE `card_member`
  ADD PRIMARY KEY (`card_member_id`);

--
-- Indexes for table `card_payment`
--
ALTER TABLE `card_payment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cms`
--
ALTER TABLE `cms`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `corporates`
--
ALTER TABLE `corporates`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `Corporate_Order`
--
ALTER TABLE `Corporate_Order`
  ADD PRIMARY KEY (`Corporate_Order_id`);

--
-- Indexes for table `Customer`
--
ALTER TABLE `Customer`
  ADD PRIMARY KEY (`Customer_id`);

--
-- Indexes for table `customer_order_consumption`
--
ALTER TABLE `customer_order_consumption`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `family_member`
--
ALTER TABLE `family_member`
  ADD PRIMARY KEY (`family_member_id`);

--
-- Indexes for table `inquiry`
--
ALTER TABLE `inquiry`
  ADD PRIMARY KEY (`inquiry_id`);

--
-- Indexes for table `LabReport_Request_detail`
--
ALTER TABLE `LabReport_Request_detail`
  ADD PRIMARY KEY (`LabReport_Request_detail_id`);

--
-- Indexes for table `LabReport_Request_Master`
--
ALTER TABLE `LabReport_Request_Master`
  ADD PRIMARY KEY (`LabReport_Request_id`);

--
-- Indexes for table `LabReport_Request_temp`
--
ALTER TABLE `LabReport_Request_temp`
  ADD PRIMARY KEY (`LabReport_Request_temp_id`);

--
-- Indexes for table `Lab_Master`
--
ALTER TABLE `Lab_Master`
  ADD PRIMARY KEY (`Lab_Master_id`);

--
-- Indexes for table `Lab_Test_Category`
--
ALTER TABLE `Lab_Test_Category`
  ADD PRIMARY KEY (`Lab_Test_Category_id`);

--
-- Indexes for table `Lab_Test_Master`
--
ALTER TABLE `Lab_Test_Master`
  ADD PRIMARY KEY (`Lab_Test_Master_id`),
  ADD UNIQUE KEY `Test_Name` (`Test_Name`);

--
-- Indexes for table `Lab_Test_Report_Amount`
--
ALTER TABLE `Lab_Test_Report_Amount`
  ADD PRIMARY KEY (`Lab_Test_Report_Amount_id`);

--
-- Indexes for table `ledger`
--
ALTER TABLE `ledger`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `members`
--
ALTER TABLE `members`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `mobile` (`mobile`);

--
-- Indexes for table `Member_Order`
--
ALTER TABLE `Member_Order`
  ADD PRIMARY KEY (`Member_Order_id`);

--
-- Indexes for table `metropolis_fr4a`
--
ALTER TABLE `metropolis_fr4a`
  ADD PRIMARY KEY (`SR NO`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  ADD KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  ADD KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `offer_master`
--
ALTER TABLE `offer_master`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order`
--
ALTER TABLE `order`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_member`
--
ALTER TABLE `order_member`
  ADD PRIMARY KEY (`order_member_id`);

--
-- Indexes for table `our_client`
--
ALTER TABLE `our_client`
  ADD PRIMARY KEY (`our_client_id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `plans`
--
ALTER TABLE `plans`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `plan_details`
--
ALTER TABLE `plan_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `role_has_permissions_role_id_foreign` (`role_id`);

--
-- Indexes for table `sendemaildetails`
--
ALTER TABLE `sendemaildetails`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sub_service`
--
ALTER TABLE `sub_service`
  ADD PRIMARY KEY (`sub_service_id`);

--
-- Indexes for table `supratech_fr4a`
--
ALTER TABLE `supratech_fr4a`
  ADD PRIMARY KEY (`SR NO`);

--
-- Indexes for table `Testimonial`
--
ALTER TABLE `Testimonial`
  ADD PRIMARY KEY (`Testimonial_id`);

--
-- Indexes for table `Users`
--
ALTER TABLE `Users`
  ADD PRIMARY KEY (`Users_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `wallets`
--
ALTER TABLE `wallets`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `associated_members`
--
ALTER TABLE `associated_members`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `banner`
--
ALTER TABLE `banner`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `blog`
--
ALTER TABLE `blog`
  MODIFY `blogId` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `card_member`
--
ALTER TABLE `card_member`
  MODIFY `card_member_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `card_payment`
--
ALTER TABLE `card_payment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `cms`
--
ALTER TABLE `cms`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `corporates`
--
ALTER TABLE `corporates`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `Corporate_Order`
--
ALTER TABLE `Corporate_Order`
  MODIFY `Corporate_Order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `Customer`
--
ALTER TABLE `Customer`
  MODIFY `Customer_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `customer_order_consumption`
--
ALTER TABLE `customer_order_consumption`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `family_member`
--
ALTER TABLE `family_member`
  MODIFY `family_member_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `inquiry`
--
ALTER TABLE `inquiry`
  MODIFY `inquiry_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `LabReport_Request_detail`
--
ALTER TABLE `LabReport_Request_detail`
  MODIFY `LabReport_Request_detail_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `LabReport_Request_Master`
--
ALTER TABLE `LabReport_Request_Master`
  MODIFY `LabReport_Request_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `LabReport_Request_temp`
--
ALTER TABLE `LabReport_Request_temp`
  MODIFY `LabReport_Request_temp_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT for table `Lab_Master`
--
ALTER TABLE `Lab_Master`
  MODIFY `Lab_Master_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `Lab_Test_Category`
--
ALTER TABLE `Lab_Test_Category`
  MODIFY `Lab_Test_Category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `Lab_Test_Master`
--
ALTER TABLE `Lab_Test_Master`
  MODIFY `Lab_Test_Master_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=346;

--
-- AUTO_INCREMENT for table `Lab_Test_Report_Amount`
--
ALTER TABLE `Lab_Test_Report_Amount`
  MODIFY `Lab_Test_Report_Amount_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=346;

--
-- AUTO_INCREMENT for table `ledger`
--
ALTER TABLE `ledger`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `members`
--
ALTER TABLE `members`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `Member_Order`
--
ALTER TABLE `Member_Order`
  MODIFY `Member_Order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `metropolis_fr4a`
--
ALTER TABLE `metropolis_fr4a`
  MODIFY `SR NO` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=116;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `offer_master`
--
ALTER TABLE `offer_master`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `order`
--
ALTER TABLE `order`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `order_member`
--
ALTER TABLE `order_member`
  MODIFY `order_member_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `our_client`
--
ALTER TABLE `our_client`
  MODIFY `our_client_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `plans`
--
ALTER TABLE `plans`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `plan_details`
--
ALTER TABLE `plan_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `sendemaildetails`
--
ALTER TABLE `sendemaildetails`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `sub_service`
--
ALTER TABLE `sub_service`
  MODIFY `sub_service_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `supratech_fr4a`
--
ALTER TABLE `supratech_fr4a`
  MODIFY `SR NO` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=211;

--
-- AUTO_INCREMENT for table `Testimonial`
--
ALTER TABLE `Testimonial`
  MODIFY `Testimonial_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `Users`
--
ALTER TABLE `Users`
  MODIFY `Users_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `wallets`
--
ALTER TABLE `wallets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
