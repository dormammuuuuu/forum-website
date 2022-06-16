-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 16, 2022 at 08:49 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `forum`
--

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `thread_id` varchar(255) NOT NULL,
  `comment_id` varchar(255) NOT NULL,
  `comment_author` varchar(255) NOT NULL,
  `comment_date` date NOT NULL DEFAULT current_timestamp(),
  `comment_time` time NOT NULL DEFAULT current_timestamp(),
  `comment` longtext NOT NULL,
  `answer` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `thread_id`, `comment_id`, `comment_author`, `comment_date`, `comment_time`, `comment`, `answer`) VALUES
(67, 'thrd628138735a129', 'C6281397a3bb70', 'u627754a082c47', '2022-05-16', '01:33:46', 'I love TUP <3 kahit ang sakit sakit na ', 1),
(68, 'thrd628138735a129', 'C62813d50c5d9e', 'u627a6a0b58d37', '2022-05-16', '01:50:08', 'Nice one angas mo naman', 0),
(69, 'thrd62834f012bf4e', 'C628362209d88d', 'u627e6c58bccf1', '2022-05-17', '16:51:44', 'Sample Correct Answer', 1),
(70, 'thrd62834f012bf4e', 'C62836224b3f4f', 'u627e6c58bccf1', '2022-05-17', '16:51:48', 'Wrong Answer', 1),
(71, 'thrd62834f012bf4e', 'C62838b5f73d2e', 'u627a6a0b58d37', '2022-05-17', '19:47:43', 'Sample Sample', 1),
(72, 'thrd62834f012bf4e', 'C6283d3c3e8e77', 'u627754a082c47', '2022-05-18', '00:56:35', 'Sample Comment #1', 0),
(73, 'thrd62834f012bf4e', 'C6283d452e7cdc', 'u627754a082c47', '2022-05-18', '00:58:58', 'Sample Comment #2', 0),
(74, 'thrd62834f012bf4e', 'C6283d47c6da92', 'u627754a082c47', '2022-05-18', '00:59:40', 'Sample Comment #3', 0),
(75, 'thrd62834f012bf4e', 'C6283d48dc2ba7', 'u627754a082c47', '2022-05-18', '00:59:57', 'Sample Comment #4', 0),
(77, 'thrd628e63c369854', 'C6294d4e16cd9b', 'u627754a082c47', '2022-05-30', '22:29:53', 'Sample Comment\n', 0),
(78, 'thrd628e63c369854', 'C6294d4f55a0e5', 'u627754a082c47', '2022-05-30', '22:30:13', 'Ito ay comment', 0),
(79, 'thrd6294d8c4c9e4b', 'C6294d8cc365c8', 'u627754a082c47', '2022-05-30', '22:46:36', 'AA', 1),
(80, 'thrd6294d8c4c9e4b', 'C6294d9d1a1237', 'u627754a082c47', '2022-05-30', '22:50:57', 'Sample Comment', 0),
(81, 'thrd6294d8c4c9e4b', 'C6294d9de15f1e', 'u627754a082c47', '2022-05-30', '22:51:10', 'Sample Comm', 0),
(82, 'thrd6294d8c4c9e4b', 'C6294dab16fcc1', 'u627a6a0b58d37', '2022-05-30', '22:54:41', 'Sample', 0),
(83, 'thrd6294d8c4c9e4b', 'C6294dab180e4f', 'u627a6a0b58d37', '2022-05-30', '22:54:41', '', 0),
(84, 'thrd6294d8c4c9e4b', 'C6294db944b494', 'u627a6a0b58d37', '2022-05-30', '22:58:28', 'Sample', 0),
(85, 'thrd6294d8c4c9e4b', 'C6294db9457f52', 'u627a6a0b58d37', '2022-05-30', '22:58:28', 'Sample', 1),
(86, 'thrd6294d8c4c9e4b', 'C6294dde1496b1', 'u627a6a0b58d37', '2022-05-30', '23:08:17', 'asd', 0),
(87, 'thrd62834edac28f0', 'C6294e390baa82', 'u627a6a0b58d37', '2022-05-30', '23:32:32', 'AD', 0),
(88, 'thrd6294d8c4c9e4b', 'C6294e9d441909', 'u627a6a0b58d37', '2022-05-30', '23:59:16', 'S', 0),
(89, 'thrd6294d8c4c9e4b', 'C6294e9d471d20', 'u627a6a0b58d37', '2022-05-30', '23:59:16', 'S', 0),
(90, 'thrd6294d8c4c9e4b', 'C62950681a916f', 'u627a6a0b58d37', '2022-05-31', '02:01:37', 'AAA', 0),
(91, 'thrd629643d4e50ea', 'C62964ec6046eb', 'u627754a082c47', '2022-06-01', '01:22:14', 'Wow galing\n', 1),
(92, 'thrd6298f42a3ec79', 'C6298f45a3ff3b', 'u6298f3dcd7288', '2022-06-03', '01:33:14', 'ang bastos mo naman', 1),
(93, 'thrd6298f42a3ec79', 'C6298f461a02f5', 'u627754a082c47', '2022-06-03', '01:33:21', 'YAAAAk\n', 1),
(94, 'thrd6298f42a3ec79', 'C62a36ef0aaa0f', 'u62a36c251d916', '2022-06-11', '00:18:56', 'I Love You Benshoooocks', 0),
(95, 'thrd62986a5934109', 'C62a36fda88767', 'u62a36c251d916', '2022-06-11', '00:22:50', 'Ano ang nauna itlog o manok?\n', 1),
(96, 'thrd62986a5934109', 'C62a36fe333e38', 'u62a36c251d916', '2022-06-11', '00:22:59', 'Raymond Baliw\n\n', 0),
(97, 'thrd62a3716ba67f9', 'C62a6f2045df98', 'u62a6eb986662e', '2022-06-13', '16:15:00', 'di ko rin po alam anong meron', 0),
(98, 'thrd6298f42a3ec79', 'C62a6f2a4b9a4b', 'u62a6eb173f2f5', '2022-06-13', '16:17:40', 'baliw kana ba????', 0),
(99, 'thrd62a6f1b73f27e', 'C62a6f79d63e3d', 'u627754a082c47', '2022-06-13', '16:38:53', 'wala kaming pake', 0),
(100, 'thrd62a6f1b73f27e', 'C62a6f82e76d05', 'u62a6eb986662e', '2022-06-13', '16:41:18', 'hala bat ka naman po ganyan? :(((\n', 0),
(101, 'thrd62a6f1b73f27e', 'C62a7213d9e07b', 'u627754a082c47', '2022-06-13', '19:36:29', 'Test Comment', 0),
(102, 'thrd62a8a1b5b5821', 'C62aa0ae72013a', 'u627754a082c47', '2022-06-16', '00:37:59', 'Si Ka.... nvmd', 0),
(103, 'thrd62a6f98f69366', 'C62aa20446ad56', 'u627754a082c47', '2022-06-16', '02:09:08', 'Bakit walang sagot sa tanong kung bakit ka mahalaga?', 0);

-- --------------------------------------------------------

--
-- Table structure for table `declined`
--

CREATE TABLE `declined` (
  `id` int(11) NOT NULL,
  `thread_id` varchar(255) NOT NULL,
  `message` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `declined`
--

INSERT INTO `declined` (`id`, `thread_id`, `message`) VALUES
(1, 'thrd6294d8c4c9e4b', 'This is a mistake'),
(2, '', 'Duplicate Thread'),
(3, '', 'Duplicate Thread'),
(4, '\' + threadID + \'', 'reason'),
(5, '\' + threadID + \'', 'reason'),
(6, '\' + threadID + \'', 'reason'),
(7, 'thrd628e63c369854', 'Duplicate Thread');

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` int(11) NOT NULL,
  `sender` varchar(255) NOT NULL,
  `receiver` varchar(255) NOT NULL,
  `message` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `date` date NOT NULL DEFAULT current_timestamp(),
  `time` time NOT NULL DEFAULT current_timestamp(),
  `seen` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `sender`, `receiver`, `message`, `date`, `time`, `seen`) VALUES
(3, 'u627754a082c47', 'u62a36c251d916', 'Oy raymond', '2022-06-14', '18:10:04', 1),
(4, 'u627754a082c47', 'u62a36c251d916', 'Pre', '2022-06-14', '18:19:28', 1),
(5, 'u627754a082c47', 'u62a36c251d916', 'EH?', '2022-06-14', '18:23:42', 1),
(6, 'u627754a082c47', 'u62a36c251d916', 'Oh baket?', '2022-06-14', '18:39:14', 1),
(7, 'u627754a082c47', 'u62a36c251d916', 'Oh baket?', '2022-06-14', '18:39:14', 1),
(8, 'u62a36c251d916', 'u627754a082c47', 'New', '2022-06-14', '18:48:55', 1),
(9, 'u627754a082c47', 'u62a36c251d916', 'Pre pogi mo', '2022-06-14', '18:52:14', 1),
(10, 'u62a36c251d916', 'u627754a082c47', 'Alam ko', '2022-06-14', '18:52:23', 1),
(11, 'u62a36c251d916', 'u627754a082c47', 'Alam ko', '2022-06-14', '18:52:23', 1),
(12, 'u627754a082c47', 'u627fe814b5bfd', 'Pre', '2022-06-14', '19:42:01', 1),
(13, 'u627754a082c47', 'u62a36c251d916', 'Sana ol', '2022-06-14', '21:22:25', 1),
(14, 'u627754a082c47', 'u62a36c251d916', 'Pre', '2022-06-14', '21:26:33', 1),
(15, 'u627754a082c47', 'u62a36c251d916', 'Pre', '2022-06-14', '21:26:33', 1),
(16, 'u627754a082c47', 'u62a36c251d916', 'Pres', '2022-06-14', '21:26:59', 1),
(17, 'u627754a082c47', 'u62a36c251d916', 'Pres', '2022-06-14', '21:26:59', 1),
(18, 'u62a36c251d916', 'u627754a082c47', 'Bakit?', '2022-06-14', '21:28:58', 1),
(19, 'u627754a082c47', 'u62a36c251d916', 'Wala lang', '2022-06-14', '21:56:35', 1),
(20, 'u62a892ac8a7a0', 'u6298f3dcd7288', 'baho ng itlog mo david', '2022-06-14', '22:05:26', 1),
(21, 'u62a892ac8a7a0', 'u62a36c251d916', 'edi wow', '2022-06-14', '22:05:51', 1),
(22, 'u62a36c251d916', 'u627754a082c47', 'Pasalamat ka pogi ka', '2022-06-14', '23:52:05', 1),
(23, 'u627754a082c47', 'u62a36c251d916', 'RAYMOND', '2022-06-15', '02:25:24', 1),
(24, 'u62a36c251d916', 'u627fe814b5bfd', 'Oy pre', '2022-06-15', '02:56:11', 1),
(25, 'u62a99829973b3', 'u627754a082c47', 'hi', '2022-06-15', '16:29:23', 1),
(26, 'u62a99829973b3', 'u627754a082c47', 'pansinin mo po ako', '2022-06-15', '16:29:36', 1),
(27, 'u627754a082c47', 'u62a99829973b3', 'hello', '2022-06-15', '16:30:50', 1),
(28, 'u627754a082c47', 'u62a99829973b3', 'bakit ka po nagchachat?', '2022-06-15', '16:31:20', 1),
(29, 'u62a99829973b3', 'u627754a082c47', 'nakita ko kasi profile mo pogi mo', '2022-06-15', '16:32:29', 1),
(30, 'u62a99829973b3', 'u627754a082c47', 'sno yang kasama mo iwan mo na yan haha', '2022-06-15', '16:32:38', 1),
(31, 'u627754a082c47', 'u62a99829973b3', 'ahh thank you', '2022-06-15', '16:32:43', 1),
(32, 'u62a99829973b3', 'u627754a082c47', 'aq nalang pls', '2022-06-15', '16:32:47', 1),
(33, 'u62a99829973b3', 'u627754a082c47', 'aq nalang pls', '2022-06-15', '16:32:48', 1),
(34, 'u627754a082c47', 'u62a99829973b3', 'ahh eto ba? longganisa seller samin to e', '2022-06-15', '16:33:00', 1),
(35, 'u62a99829973b3', 'u627754a082c47', 'ay wag kana riyan ', '2022-06-15', '16:33:30', 1),
(36, 'u627754a082c47', 'u62a99829973b3', 'ano ba tinitinda mo?', '2022-06-15', '16:33:41', 1),
(37, 'u62a99829973b3', 'u627754a082c47', 'human meat talaga gamit nila sa longganisa nila ', '2022-06-15', '16:33:43', 1),
(38, 'u62a99829973b3', 'u627754a082c47', 'dito ka nalang sakin', '2022-06-15', '16:33:52', 1),
(39, 'u627754a082c47', 'u62a99829973b3', 'ay grabe naman pala sila', '2022-06-15', '16:34:01', 1),
(40, 'u627754a082c47', 'u62a99829973b3', 'ano ba sa inyo maam?', '2022-06-15', '16:34:08', 1),
(41, 'u62a99829973b3', 'u627754a082c47', 'embutido sir', '2022-06-15', '16:34:44', 1),
(42, 'u627754a082c47', 'u62a99829973b3', 'magkano po yan?', '2022-06-15', '16:35:11', 1),
(43, 'u62a99829973b3', 'u627754a082c47', 'free muna sa unang try nyo ser kasi ang pogi mo eh ', '2022-06-15', '16:35:27', 1),
(44, 'u627754a082c47', 'u62a99829973b3', 'ay thank you po pero wag mo na po ako bolahin', '2022-06-15', '16:36:00', 1),
(45, 'u627754a082c47', 'u62a99829973b3', 'kuha po ako sa inyo maam', '2022-06-15', '16:36:13', 1),
(46, 'u62a99829973b3', 'u627754a082c47', 'kunin mo na embutido ser tas iwan mo na yang ksma mu kse pangit yan haha ms mganda aq ser tsaka sulit embutido ser ', '2022-06-15', '16:36:50', 1),
(47, 'u627754a082c47', 'u62a99829973b3', 'gegegege baka niloloko mo lang ako maam?', '2022-06-15', '16:37:40', 1),
(48, 'u62a99829973b3', 'u627754a082c47', 'd po ser luv u ', '2022-06-15', '16:37:51', 1),
(49, 'u627754a082c47', 'u62a99829973b3', 'reload mo sayo then send ka ulit long message check mo kung humahaba pa rin XD', '2022-06-15', '16:39:10', 1),
(50, 'u627754a082c47', 'u62a99829973b3', 'ambilis mo naman luv u too', '2022-06-15', '16:39:34', 1),
(51, 'u627754a082c47', 'u62a99829973b3', 'Test Enter Button', '2022-06-15', '16:41:17', 1),
(52, 'u627754a082c47', 'u62a99829973b3', 'YEEEY WORKING NA ENTER BUTTON SA PAGSEND XD', '2022-06-15', '16:41:27', 1),
(57, 'u627754a082c47', 'u62a99829973b3', 'Hello. Testing lang ⭐️🌝😁😘😁👍😘😝😉😭😉😭😀😀😞🐼🐦', '2022-06-15', '19:25:51', 1),
(81, 'u627754a082c47', 'u627754a082c47', 'Hello', '2022-06-15', '22:35:44', 1),
(82, 'u627754a082c47', 'u627754a082c47', 'Hello', '2022-06-15', '22:38:04', 1),
(83, 'u627754a082c47', 'u627754a082c47', 'Are you okay?', '2022-06-15', '22:38:11', 1),
(84, 'u627754a082c47', 'u62a99829973b3', 'Test', '2022-06-16', '00:52:26', 1),
(86, 'u627754a082c47', 'u627fe814b5bfd', 'Oy', '2022-06-16', '00:58:25', 1),
(87, 'u627754a082c47', 'u62a99829973b3', 'Hello', '2022-06-16', '01:16:39', 1),
(92, 'u62a892ac8a7a0', 'u627754a082c47', 'Oy', '2022-06-16', '15:25:28', 1),
(96, 'u62a892ac8a7a0', 'u627754a082c47', 'Jo', '2022-06-16', '15:48:09', 1),
(97, 'u627754a082c47', 'u62a892ac8a7a0', 'Pre', '2022-06-16', '15:48:20', 1),
(98, 'u62a892ac8a7a0', 'u627754a082c47', 'Wala lang', '2022-06-16', '15:48:57', 1),
(99, 'u627754a082c47', 'u62a892ac8a7a0', 'GEGEGE', '2022-06-16', '15:49:45', 1),
(100, 'u62a892ac8a7a0', 'u627754a082c47', 'Ano gawa mo?', '2022-06-16', '15:51:17', 1),
(101, 'u627754a082c47', 'u62a892ac8a7a0', 'Wala', '2022-06-16', '15:51:24', 1),
(102, 'u627754a082c47', 'u62a892ac8a7a0', 'Wala', '2022-06-16', '15:51:57', 1),
(103, 'u627754a082c47', 'u62a892ac8a7a0', 'Wala', '2022-06-16', '15:52:09', 1),
(104, 'u62a892ac8a7a0', 'u627754a082c47', 'Alin?', '2022-06-16', '15:52:20', 1),
(105, 'u627754a082c47', 'u62a892ac8a7a0', 'Ha?', '2022-06-16', '15:52:26', 1),
(106, 'u62a892ac8a7a0', 'u627754a082c47', 'Jo', '2022-06-16', '15:52:45', 1),
(107, 'u627754a082c47', 'u62a892ac8a7a0', 'ANO', '2022-06-16', '15:52:57', 1),
(111, 'u62a892ac8a7a0', 'u627754a082c47', 'Pre', '2022-06-16', '15:57:00', 1),
(126, 'u62a891ef10a26', 'u6298f3dcd7288', 'Kiko', '2022-06-16', '16:35:13', 1),
(135, 'u627754a082c47', 'u62a891ef10a26', 'Raymond', '2022-06-16', '18:15:28', 1),
(136, 'u62a891ef10a26', 'u627754a082c47', 'Bakit?', '2022-06-16', '18:15:45', 1),
(137, 'u62a891ef10a26', 'u627754a082c47', 'Pre', '2022-06-16', '18:24:56', 1),
(138, 'u62a891ef10a26', 'u627754a082c47', 'Jerico', '2022-06-16', '18:25:01', 1),
(139, 'u62a891ef10a26', 'u627754a082c47', 'Alam mo ba crush ko si cielo', '2022-06-16', '18:25:10', 1),
(140, 'u62a891ef10a26', 'u627754a082c47', 'sheeesh', '2022-06-16', '18:25:12', 1),
(141, 'u62a891ef10a26', 'u627754a082c47', 'AHAHAHAHAHAHAHAHAHA', '2022-06-16', '18:53:32', 1),
(142, 'u62a891ef10a26', 'u627754a082c47', 'Ay convo na pag open e', '2022-06-16', '18:53:50', 1),
(143, 'u62a891ef10a26', 'u627754a082c47', 'Dipa pala maayos sa phone', '2022-06-16', '18:54:08', 1),
(144, 'u627754a082c47', 'u62a891ef10a26', 'pre', '2022-06-16', '18:54:53', 1),
(145, 'u627754a082c47', 'u62a891ef10a26', 'suntukan nga tayo pre', '2022-06-16', '18:55:03', 1),
(146, 'u62a891ef10a26', 'u627754a082c47', 'Taraaaa', '2022-06-16', '18:57:12', 1),
(147, 'u62a891ef10a26', 'u627754a082c47', '👆👊👊👊👊👊✌️✌️👊👇', '2022-06-16', '18:57:40', 1),
(148, 'u627754a082c47', 'u62a891ef10a26', 'di pa pala maayos mga kulay', '2022-06-16', '18:58:03', 1),
(149, 'u62a891ef10a26', 'u627754a082c47', 'Pero gagi ang angas', '2022-06-16', '18:58:29', 1),
(150, 'u627754a082c47', 'u62a891ef10a26', 'ayusin ko pa kulay HAHAHHAHA', '2022-06-16', '18:58:36', 1),
(151, 'u62a891ef10a26', 'u627754a082c47', '💛b💙💜💚❤️', '2022-06-16', '18:58:43', 1),
(152, 'u62a891ef10a26', 'u627754a082c47', '🌔🌙🌙🌕🌖🌗🌘🌜', '2022-06-16', '18:59:18', 1),
(153, 'u62a891ef10a26', 'u6298f3dcd7288', 'Tara shabu', '2022-06-16', '18:59:33', 0),
(154, 'u62a891ef10a26', 'u62a99829973b3', 'Ediwaw', '2022-06-16', '18:59:51', 0),
(155, 'u627754a082c47', 'u62a891ef10a26', '👀👀👀', '2022-06-16', '19:00:16', 1),
(156, 'u62a891ef10a26', 'u62a36c251d916', 'Beh si ben may kabet, juskoday', '2022-06-16', '19:00:16', 0),
(157, 'u62a891ef10a26', 'u62a36c251d916', 'sana si jake na lang jinowa mo', '2022-06-16', '19:01:48', 0);

-- --------------------------------------------------------

--
-- Table structure for table `save`
--

CREATE TABLE `save` (
  `id` int(11) NOT NULL,
  `thread_id` varchar(255) NOT NULL,
  `uid` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `save`
--

INSERT INTO `save` (`id`, `thread_id`, `uid`) VALUES
(11, 'thrd6298f42a3ec79', 'u627754a082c47'),
(20, 'thrd62a3716ba67f9', 'u627754a082c47'),
(22, 'thrd62986a5934109', 'u627754a082c47'),
(23, 'thrd628138735a129', 'u627754a082c47');

-- --------------------------------------------------------

--
-- Table structure for table `threads`
--

CREATE TABLE `threads` (
  `id` int(11) NOT NULL,
  `thread_id` varchar(255) NOT NULL,
  `author` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `body` longtext NOT NULL,
  `tags` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `status` int(1) NOT NULL DEFAULT 0,
  `thread_status` varchar(255) NOT NULL DEFAULT 'pending',
  `date_posted` date NOT NULL DEFAULT current_timestamp(),
  `time_posted` time NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `threads`
--

INSERT INTO `threads` (`id`, `thread_id`, `author`, `title`, `body`, `tags`, `status`, `thread_status`, `date_posted`, `time_posted`) VALUES
(24, 'thrd628138735a129', 'u627754a082c47', 'FIRST OFFICIAL THREAD', '{\"time\":1653901022353,\"blocks\":[{\"id\":\"MHr46K53Xb\",\"type\":\"header\",\"data\":{\"text\":\"FIRST OFFICIAL THREAD &lt;TUP SPEAK&gt;\",\"level\":2}},{\"id\":\"MYlE21upIX\",\"type\":\"paragraph\",\"data\":{\"text\":\"Ito ang unang thread na aming ginawa na may kaayusan.\"}},{\"id\":\"HauxqEOjcM\",\"type\":\"list\",\"data\":{\"style\":\"ordered\",\"items\":[\"Aming hangarin na maging maayos at malinis ang proyektong ito.\",\"Maging \",\"OPEN - FOR - ALL \",\"ang website.\"]}},{\"id\":\"8DK3YbNVve\",\"type\":\"image\",\"data\":{\"url\":\"data:image/png;base64,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\",\"caption\":\"TUP - Deviantart\",\"withBorder\":false,\"withBackground\":false,\"stretched\":false}}],\"version\":\"2.24.3\"}', '{\"selected\":[\"general\",\"cos\",\"event\"]}', 1, 'close', '2022-05-16', '01:29:23'),
(25, 'thrd62834edac28f0', 'u627a6a0b58d37', 'Sample Thread #1', '{\"time\":1652772570775,\"blocks\":[{\"id\":\"LVfKPy-1ch\",\"type\":\"paragraph\",\"data\":{\"text\":\"Isa itong sample thread\"}},{\"id\":\"8m6zbjf_Fi\",\"type\":\"header\",\"data\":{\"text\":\"Test Test Test\",\"level\":2}}],\"version\":\"2.24.3\"}', '{\"selected\":[\"suspension\",\"missingitem\",\"vandalism\",\"registrar\",\"bullying\"]}', 1, 'open', '2022-05-17', '15:29:30'),
(26, 'thrd62834f012bf4e', 'u627a6a0b58d37', 'Sample Thread #2', '{\"time\":1653925286953,\"blocks\":[{\"id\":\"K7hWnKrqpV\",\"type\":\"paragraph\",\"data\":{\"text\":\"Pangalawang Sample Thread\"}},{\"id\":\"j7ccdLlFPl\",\"type\":\"paragraph\",\"data\":{\"text\":\"Sample Sample SampleAAAAA\"}}],\"version\":\"2.24.3\"}', '{\"selected\":[\"cos\"]}', 1, 'open', '2022-05-17', '15:30:09'),
(32, 'thrd628e63c369854', 'u627754a082c47', 'Editted Thread', '{\"time\":1653919992441,\"blocks\":[{\"id\":\"GD-Q2boFVf\",\"type\":\"paragraph\",\"data\":{\"text\":\"Ito ang thread na inedit ko.\"}},{\"id\":\"YgOt53Qijh\",\"type\":\"paragraph\",\"data\":{\"text\":\"Thank you &lt;3\"}}],\"version\":\"2.24.3\"}', '{\"selected\":[\"general\",\"lgbtq\",\"cos\"]}', 1, 'open', '2022-05-26', '01:13:39'),
(33, 'thrd6294d8c4c9e4b', 'u627754a082c47', 'New Thread Wow ', '{\"time\":1653987520357,\"blocks\":[{\"id\":\"Whv56xWkax\",\"type\":\"paragraph\",\"data\":{\"text\":\"Latest Thread&nbsp;\"}},{\"id\":\"h5BQeSfBt0\",\"type\":\"paragraph\",\"data\":{\"text\":\"WOWOWOW Latest\"}}],\"version\":\"2.24.3\"}', '{\"selected\":[\"general\"]}', 0, 'declined', '2022-05-30', '22:46:28'),
(35, 'thrd62986a5934109', 'u627754a082c47', 'Sample Thread Para Matest yung COLORS', '{\"time\":1654155865196,\"blocks\":[{\"id\":\"bdSbLlsbH_\",\"type\":\"paragraph\",\"data\":{\"text\":\"\\\"Lupang Hinirang\\\", originally titled in Spanish as \\\"Marcha Nacional Filipina\\\" and commonly known by its incipit \\\"Bayang Magiliw\\\", is the national anthem of the Philippines. Its music was composed in 1898 by Julián Felipe, and the lyrics were adopted from the Spanish poem \\\"Filipinas\\\", written by José Palma in 1899.&nbsp;\"}}],\"version\":\"2.24.3\"}', '{\"selected\":[\"bullying\",\"cafa\",\"cie\",\"cit\",\"coe\"]}', 1, 'open', '2022-06-02', '15:44:25'),
(36, 'thrd62986aed369f2', 'u627754a082c47', 'Sample Thread Para Matest yung COLORS PART 2', '{\"time\":1654156013212,\"blocks\":[{\"id\":\"YbNR3YN6EV\",\"type\":\"paragraph\",\"data\":{\"text\":\"Pilipinas Kong Mahal is one of the most popular patriotic songs in the Philippines. The song was composed by Filipino musician, Francisco Santiago and lyrics by Ildefonso Santos. The English text was written by Prescott Ford Jernegan.\"}}],\"version\":\"2.24.3\"}', '{\"selected\":[\"cos\",\"event\",\"general\",\"lgbtq\",\"library\"]}', 1, 'open', '2022-06-02', '15:46:53'),
(37, 'thrd62986b338d7e0', 'u627754a082c47', 'Sample Thread Para Matest yung COLORS PART 3', '{\"time\":1654589778146,\"blocks\":[{\"id\":\"NTuvbj99z3\",\"type\":\"paragraph\",\"data\":{\"text\":\"Sa ugoy ng Duyan\"}},{\"id\":\"pfazDYMuf_\",\"type\":\"paragraph\",\"data\":{\"text\":\"Sa Ugoy ng Duyan is a Filipino lullaby. The music was composed by Lucio San Pedro while the lyrics was written by Levi Celerio. Both of them were National Artists of the Philippines and this song was their most popular collaboration.&nbsp;\"}}],\"version\":\"2.24.3\"}', '{\"selected\":[\"missingitem\",\"vandalism\"]}', 1, 'open', '2022-06-02', '15:48:03');
INSERT INTO `threads` (`id`, `thread_id`, `author`, `title`, `body`, `tags`, `status`, `thread_status`, `date_posted`, `time_posted`) VALUES
(38, 'thrd6298f42a3ec79', 'u6298f3dcd7288', 'bakit baliw si Francis Panaligan', '{\"time\":1654191399654,\"blocks\":[{\"id\":\"xo2AIP58AC\",\"type\":\"header\",\"data\":{\"text\":\"wasted nanaman ako mah gang gang\",\"level\":2}},{\"id\":\"7L-HwcYPsb\",\"type\":\"paragraph\",\"data\":{\"text\":\"baby baby u r my sun and moon u make my world starts collide\"}},{\"id\":\"kjJ1VCW7Es\",\"type\":\"paragraph\",\"data\":{\"text\":\"123&nbsp;\"}}],\"version\":\"2.24.3\"}', '{\"selected\":[\"cos\"]}', 1, 'open', '2022-06-03', '01:32:26'),
(39, 'thrd62a3716ba67f9', 'u62a36c251d916', 'BAKIT BASA ANG TUBIG?', '{\"time\":1654878592343,\"blocks\":[{\"id\":\"iH4q_i4SKM\",\"type\":\"paragraph\",\"data\":{\"text\":\"GUSTO KONG MAPAG ISA KASO WALA AKO KASAMA\"}}],\"version\":\"2.24.3\"}', '{\"selected\":[\"cie\",\"lgbtq\",\"cafa\"]}', 1, 'open', '2022-06-11', '00:29:31'),
(40, 'thrd62a6f1b73f27e', 'u62a6eb986662e', 'Anong oras po ba yung open ng TUP - Manila???', '{\"time\":1655108022040,\"blocks\":[{\"id\":\"9CEkiIJDp6\",\"type\":\"paragraph\",\"data\":{\"text\":\"meron po ba sainyo na nakakaalam kung anong oras nag bubukas yung tup manila? need ko lang po kasi mag pa coc for requirements e, thank you poooo&nbsp;\"}}],\"version\":\"2.24.3\"}', '{\"selected\":[\"registrar\",\"general\"]}', 1, 'open', '2022-06-13', '16:13:43'),
(41, 'thrd62a6f85fa4a0d', 'u62a6eb46bc510', 'pares at mami ang masarap kainin ngayong hapon', '{\"time\":1655109726446,\"blocks\":[{\"id\":\"vzQsq43bws\",\"type\":\"paragraph\",\"data\":{\"text\":\"ako ay kakain ng pares/mami ngayon mainggit kayo mga hinamungkal\"}}],\"version\":\"2.24.3\"}', '{\"selected\":[\"general\",\"event\"]}', 1, 'open', '2022-06-13', '16:42:07'),
(42, 'thrd62a6f98f69366', 'u62a6f897e3940', 'Why matutulog?', '{\"time\":1655110034277,\"blocks\":[{\"id\":\"ZaoZ1_uJIN\",\"type\":\"paragraph\",\"data\":{\"text\":\"Why matutulog kung gigising din naman\"}}],\"version\":\"2.24.3\"}', '{\"selected\":[\"general\"]}', 1, 'open', '2022-06-13', '16:47:11'),
(43, 'thrd62a8a1b5b5821', 'u62a891ef10a26', 'Gusto ko pa pero ayaw mo na :(', '{\"time\":1655218617730,\"blocks\":[{\"id\":\"5VPj1mFf17\",\"type\":\"paragraph\",\"data\":{\"text\":\"Isang round pa please -_-\"}}],\"version\":\"2.24.3\"}', '{\"selected\":[]}', 1, 'open', '2022-06-14', '22:56:53');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `uid` varchar(255) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `avatar` varchar(255) NOT NULL DEFAULT 'assets/images/avatar/default.jpg',
  `cover` varchar(255) NOT NULL DEFAULT 'assets/images/avatar/default-cover.jpg',
  `birthdate` date NOT NULL,
  `privileged` tinyint(1) NOT NULL DEFAULT 0,
  `campus` varchar(100) NOT NULL DEFAULT 'Manila',
  `bio` text NOT NULL,
  `account_type` varchar(255) NOT NULL DEFAULT 'student',
  `restricted` tinyint(1) DEFAULT 0,
  `restricted_reason` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `uid`, `firstname`, `lastname`, `email`, `password`, `avatar`, `cover`, `birthdate`, `privileged`, `campus`, `bio`, `account_type`, `restricted`, `restricted_reason`) VALUES
(58, 'u627754a082c47', 'Jerico', 'Victoria', 'jericovic64@gmail.com', '202cb962ac59075b964b07152d234b70', '../assets/images/avatar/u627754a082c47.jpg', '../assets/images/avatar/u627754a082c47-cover.jpg', '2000-11-18', 1, 'Manila', 'Ay wow may bio na <3', 'admin', 0, '0'),
(59, 'u627a6a0b58d37', 'Jerico', 'Victoria', 'jerico.victoria@tup.edu.ph', '', 'https://lh3.googleusercontent.com/a/AATXAJxIWhnHJ95llxkqm0xfUZKrwzjP-rl2Pc594uHp=s96-c', 'assets/images/avatar/default-cover.jpg', '0000-00-00', 0, 'Manila', '', 'student', 0, NULL),
(61, 'u627e6c58bccf1', 'stream', 'hub', 'streamhubemail@gmail.com', '', 'https://lh3.googleusercontent.com/a-/AOh14Gj0eJWzFoHWkZUooFNblbjkn0TGEOUGlaSs4vTW=s96-c', 'assets/images/avatar/default-cover.jpg', '0000-00-00', 0, 'Manila', '', 'teacher', 0, ''),
(62, 'u627fe814b5bfd', 'Francis', 'Panaligan', 'jericovic65@gmail.com', '202cb962ac59075b964b07152d234b70', 'assets/images/avatar/default.jpg', 'assets/images/avatar/default-cover.jpg', '1231-12-03', 0, 'Manila', '', 'student', 0, ''),
(63, 'u6298f3dcd7288', 'David', 'Uy', 'francisedianpanaligan@gmail.com', 'c6f057b86584942e415435ffb1fa93d4', '../assets/images/avatar/u6298f3dcd7288.jpg', 'assets/images/avatar/default-cover.jpg', '2000-08-16', 0, 'Manila', '', 'student', 0, NULL),
(64, 'u62a35ae88f320', 'ken', 'neth', 'francispanaligan54@gmail.com', '698d51a19d8a121ce581499d7b701668', 'assets/images/avatar/default.jpg', 'assets/images/avatar/default-cover.jpg', '1999-06-16', 0, 'Manila', '', 'student', 0, NULL),
(65, 'u62a35c5f031e9', 'francis', 'wow', 'fff@gmail.com', '698d51a19d8a121ce581499d7b701668', 'assets/images/avatar/default.jpg', 'assets/images/avatar/default-cover.jpg', '2000-06-14', 0, 'Manila', '', 'student', 0, NULL),
(66, 'u62a36c251d916', 'Fae', 'Roguel', 'r.matullano00@gmail.com', 'f5bb0c8de146c67b44babbf4e6584cc0', '../assets/images/avatar/u62a36c251d916.png', '../assets/images/avatar/u62a36c251d916-cover.jpg', '2000-09-22', 0, 'Manila', 'BAKA AKO', 'student', 0, NULL),
(67, 'u62a371217fee6', 'fra', 'cis', 'fff15@gmai.com', '698d51a19d8a121ce581499d7b701668', 'assets/images/avatar/default.jpg', 'assets/images/avatar/default-cover.jpg', '2000-06-07', 0, 'Manila', '', 'student', 0, NULL),
(68, 'u62a37166db10f', 'fra', 'gege', 'femp@gmai.com', '698d51a19d8a121ce581499d7b701668', 'assets/images/avatar/default.jpg', 'assets/images/avatar/default-cover.jpg', '1999-06-09', 0, 'Manila', '', 'student', 0, NULL),
(69, 'u62a6eae75367f', 'Gordon', 'Newman', 'gordon.newman@gmail.com', '202cb962ac59075b964b07152d234b70', '../assets/images/avatar/u62a6eae75367f.jpg', 'assets/images/avatar/default-cover.jpg', '1999-10-21', 0, 'Manila', 'Hello everyone!!!', 'student', 0, NULL),
(70, 'u62a6eb173f2f5', 'Tim', 'Sutherland', 'tim.sutherland@gmail.com', '289dff07669d7a23de0ef88d2f7129e7', '../assets/images/avatar/u62a6eb173f2f5.jpg', 'assets/images/avatar/default-cover.jpg', '2008-03-08', 0, 'Manila', '', 'student', 0, NULL),
(71, 'u62a6eb46bc510', 'Molly', 'Grant', 'molly.grant@gmail.com', 'd81f9c1be2e08964bf9f24b15f0e4900', '../assets/images/avatar/u62a6eb46bc510.jpg', 'assets/images/avatar/default-cover.jpg', '1998-09-08', 0, 'Manila', 'u r a stalker :P', 'student', 0, NULL),
(72, 'u62a6eb986662e', 'Madeleine', 'Howard', 'madeleine.howard@gmail.com', '250cf8b51c773f3f8dc8b4be867a9a02', '../assets/images/avatar/u62a6eb986662e.jpg', 'assets/images/avatar/default-cover.jpg', '2001-06-06', 0, 'Manila', 'welcome to my profile', 'student', 0, NULL),
(73, 'u62a6ebc80b8cc', 'Oliver', 'Carr', 'oliver.carr@gmail.com', '99c5e07b4d5de9d18c350cdf64c5aa3d', '../assets/images/avatar/u62a6ebc80b8cc.jpg', 'assets/images/avatar/default-cover.jpg', '2001-07-19', 0, 'Manila', 'idk', 'student', 0, NULL),
(74, 'u62a6f0d542995', 'Adrian', 'Mackay', 'adrian.mackay@gmail.com', 'a2550eeab0724a691192ca13982e6ebd', '../assets/images/avatar/u62a6f0d542995.jpg', 'assets/images/avatar/default-cover.jpg', '1999-07-03', 0, 'Manila', '', 'student', 0, NULL),
(75, 'u62a6f1c5890e3', 'Max', 'Duncan', 'max.duncan@gmail.com', '0ebb2bda4171d8c3881a68504a46b44e', '../assets/images/avatar/u62a6f1c5890e3.jpg', 'assets/images/avatar/default-cover.jpg', '2003-06-17', 0, 'Manila', '', 'student', 0, NULL),
(76, 'u62a6f29e2f9e9', 'Sebastian', 'Allan	', 'sebastian.allan@gmail.com', '3805248410673a8be6aa4807e61fb5ae', '../assets/images/avatar/u62a6f29e2f9e9.jpg', 'assets/images/avatar/default-cover.jpg', '1999-09-09', 0, 'Manila', '', 'student', 0, NULL),
(77, 'u62a6f36c18e21', 'Abigail', 'Newman', 'abigail.newman@gmail.com', 'bcb759b5b8ab63b06295c7434345d7a5', '../assets/images/avatar/u62a6f36c18e21.jpg', 'assets/images/avatar/default-cover.jpg', '0002-07-05', 0, 'Manila', '', 'student', 0, NULL),
(78, 'u62a6f45f386d6', 'Irene', 'Powel', 'irene.powell@gmail.com', 'ad198a36c4a282982870e3e2e65ae3c6', '../assets/images/avatar/u62a6f45f386d6.jpg', 'assets/images/avatar/default-cover.jpg', '2000-02-08', 0, 'Manila', '', 'student', 0, NULL),
(79, 'u62a6f6d83d666', 'Ruth', 'Baker', 'ruth.baker@gmail.com', 'f3f90bcd1ebcb7e9abb0dcc3f9d4d624', '../assets/images/avatar/u62a6f6d83d666.jpg', 'assets/images/avatar/default-cover.jpg', '1999-09-04', 0, 'Manila', '', 'student', 0, NULL),
(80, 'u62a6f897e3940', 'Abigail', 'Duncan', 'abigail.duncan@gmail.com', '10fc579194195f4f62a622eb72368315', '../assets/images/avatar/u62a6f897e3940.png', 'assets/images/avatar/default-cover.jpg', '1997-09-27', 0, 'Manila', '', 'student', 0, NULL),
(81, 'u62a6f9de393af', 'Amy', 'Nash', 'amy.nash@gmail.com', 'd909d4f34e7eb87cf0c72cecb98724c3', '../assets/images/avatar/u62a6f9de393af.jpg', 'assets/images/avatar/default-cover.jpg', '2003-07-11', 0, 'Manila', '', 'student', 0, NULL),
(82, 'u62a6fa7cbb90f', 'Julian', 'Campbell', 'julian.campbell@gmail.com', '1437cb1c93b538285d005437686876be', '../assets/images/avatar/u62a6fa7cbb90f.jpeg', 'assets/images/avatar/default-cover.jpg', '1999-11-14', 0, 'Manila', '', 'student', 0, NULL),
(83, 'u62a6fb2959999', 'Lilian', 'Welch', 'lilian.welch@gmail.com', '2ddf43d720658012a5b00deee185f350', '../assets/images/avatar/u62a6fb2959999.jpg', 'assets/images/avatar/default-cover.jpg', '2002-10-04', 0, 'Manila', '', 'student', 0, NULL),
(84, 'u62a891ef10a26', 'Raymond', 'Matullano', 'raymond.matullano@tup.edu.ph', '6965855794ac95f891d8172059bd5cd5', '../assets/images/avatar/u62a891ef10a26.jpg', '../assets/images/avatar/u62a891ef10a26-cover.jpg', '2000-09-22', 0, 'Manila', 'Minsan Oo, Minsan Hindi', 'student', 0, NULL),
(85, 'u62a892ac8a7a0', 'Christian', 'Pullman', 'christian.pullman@gmail.com', '7a519571b67279d9e76688779719cbcb', 'assets/images/avatar/default.jpg', 'assets/images/avatar/default-cover.jpg', '1984-05-16', 0, 'Manila', '', 'student', 0, NULL),
(86, 'u62a892fa11c6d', 'Donna', 'Simpson', 'donna.simpson@gmail.com', '25c594da40a5650bb9470a0d2122ddc0', 'assets/images/avatar/default.jpg', 'assets/images/avatar/default-cover.jpg', '2003-06-07', 0, 'Manila', '', 'student', 0, NULL),
(87, 'u62a89331858b2', 'Adam', 'Smith', 'adam.smith@gmail.com', '3e7b522b9756d2578d3a86d8f366be6e', 'assets/images/avatar/default.jpg', 'assets/images/avatar/default-cover.jpg', '1998-04-29', 0, 'Manila', '', 'student', 0, NULL),
(88, 'u62a89371b1385', 'Ella', 'Davies', 'ella.davies@gmail.com', 'efadcf6a697bcc011b573984dcdd3740', 'assets/images/avatar/default.jpg', 'assets/images/avatar/default-cover.jpg', '1908-04-16', 0, 'Manila', '', 'student', 0, NULL),
(89, 'u62a893a63c294', 'Keit', 'Welch', 'keith.welch@gmail.com', 'dff24e6ecbb2e7164196a1513638d4cb', 'assets/images/avatar/default.jpg', 'assets/images/avatar/default-cover.jpg', '2002-09-22', 0, 'Manila', '', 'student', 0, NULL),
(90, 'u62a89c2618d87', 'Bunny', 'Puu', 'bunnypuu@gmail.com', '1d18530344f049533d423aec88df2524', 'assets/images/avatar/default.jpg', 'assets/images/avatar/default-cover.jpg', '2000-02-22', 0, 'Manila', '', 'student', 0, NULL),
(91, 'u62a99829973b3', 'SHARINA', 'ATIENZA', 'shrnatienza@gmail.com', 'aa42b234cb05915716c1434058fe1aee', 'assets/images/avatar/default.jpg', 'assets/images/avatar/default-cover.jpg', '2001-07-26', 0, 'Manila', '', 'student', 0, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users_verification`
--

CREATE TABLE `users_verification` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `code` varchar(255) NOT NULL,
  `token` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users_verification`
--

INSERT INTO `users_verification` (`id`, `email`, `code`, `token`) VALUES
(44, 'francisedian@gmail.com', '111111', NULL),
(46, '123121232@gmail.com', '248184', NULL),
(48, 'francis@gmail.com', '676619', NULL),
(49, 'ffff@gmai.com', '392992', NULL),
(74, 'raymond.m@gmail.com', '111111', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `votes`
--

CREATE TABLE `votes` (
  `id` int(11) NOT NULL,
  `comment_id` varchar(255) NOT NULL,
  `uid` varchar(255) NOT NULL,
  `status` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `votes`
--

INSERT INTO `votes` (`id`, `comment_id`, `uid`, `status`) VALUES
(2, 'C62813d50c5d9e', '', 'upvote'),
(5, 'C6281397a3bb70', '', 'upvote'),
(6, 'C62813d50c5d9e', 'u627a6a0b58d37', 'upvote'),
(15, 'C62836224b3f4f', 'u627754a082c47', 'upvote'),
(17, 'C6281397a3bb70', 'u627754a082c47', 'upvote'),
(18, 'C628362209d88d', '', 'upvote'),
(20, 'C62836224b3f4f', '', 'upvote'),
(21, 'C6281397a3bb70', 'u627a6a0b58d37', 'upvote'),
(22, 'C6283d47c6da92', 'u627a6a0b58d37', 'downvote'),
(23, 'C6283d48dc2ba7', 'u627a6a0b58d37', 'downvote'),
(24, 'C6283d452e7cdc', 'u627a6a0b58d37', 'downvote'),
(25, 'C6283d3c3e8e77', 'u627a6a0b58d37', 'downvote'),
(28, 'C62813d50c5d9e', 'u627754a082c47', 'upvote'),
(32, 'C62838b5f73d2e', 'u627754a082c47', 'upvote'),
(33, 'C6283d3c3e8e77', 'u627754a082c47', 'upvote'),
(35, 'C6283d48dc2ba7', 'u627754a082c47', 'downvote'),
(43, 'C6294d8cc365c8', 'u627754a082c47', 'downvote'),
(44, 'C6294dab180e4f', 'u627a6a0b58d37', 'upvote'),
(45, 'C6294e390baa82', 'u627a6a0b58d37', 'upvote'),
(48, 'C62836224b3f4f', 'u627a6a0b58d37', 'upvote'),
(53, 'C62950681a916f', 'u627a6a0b58d37', 'upvote'),
(54, 'C62838b5f73d2e', 'u627a6a0b58d37', 'upvote'),
(55, 'C6294e9d471d20', 'u627754a082c47', 'upvote'),
(56, 'C6294e9d441909', 'u627754a082c47', 'upvote'),
(57, 'C6294dde1496b1', 'u627754a082c47', 'upvote'),
(58, 'C6294db9457f52', 'u627754a082c47', 'upvote'),
(59, 'C6294db944b494', 'u627754a082c47', 'upvote'),
(60, 'C6294dab16fcc1', 'u627754a082c47', 'upvote'),
(61, 'C6294d9de15f1e', 'u627754a082c47', 'downvote'),
(62, 'C6294dab180e4f', 'u627754a082c47', 'upvote'),
(64, 'C6298f45a3ff3b', 'u6298f3dcd7288', 'upvote'),
(65, 'C6298f461a02f5', 'u6298f3dcd7288', 'upvote'),
(66, 'C6298f461a02f5', 'u627754a082c47', 'upvote'),
(67, 'C6298f45a3ff3b', 'u62a36c251d916', 'upvote'),
(68, 'C6298f461a02f5', 'u62a36c251d916', 'upvote'),
(69, 'C62a36fe333e38', 'u627754a082c47', 'downvote'),
(70, 'C62a36fda88767', 'u627754a082c47', 'downvote'),
(71, 'C62a6f79d63e3d', 'u62a6eb986662e', 'downvote');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `declined`
--
ALTER TABLE `declined`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `save`
--
ALTER TABLE `save`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `threads`
--
ALTER TABLE `threads`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `thread_id` (`thread_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uid` (`uid`);

--
-- Indexes for table `users_verification`
--
ALTER TABLE `users_verification`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `votes`
--
ALTER TABLE `votes`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=104;

--
-- AUTO_INCREMENT for table `declined`
--
ALTER TABLE `declined`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=158;

--
-- AUTO_INCREMENT for table `save`
--
ALTER TABLE `save`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `threads`
--
ALTER TABLE `threads`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=92;

--
-- AUTO_INCREMENT for table `users_verification`
--
ALTER TABLE `users_verification`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=76;

--
-- AUTO_INCREMENT for table `votes`
--
ALTER TABLE `votes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=75;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
