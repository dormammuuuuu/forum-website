-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 13, 2022 at 08:08 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.1.1

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
  `comment` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `thread_id`, `comment_id`, `comment_author`, `comment_date`, `comment_time`, `comment`) VALUES
(30, 'thrd627d4d0ebd758', 'C627e7e3b6d778', 'u627e6c58bccf1', '2022-05-13', '23:50:19', 'ITO ANG LATEST COMMENT KO'),
(33, 'thrd627d4d0ebd758', 'C627e80d138c06', 'u627e6c58bccf1', '2022-05-14', '00:01:21', '{\'statusCode\':200}{\'statusCode\':200}{\'statusCode\':200}{\'statusCode\':200}{\'statusCode\':200}{\'statusCode\':200}{\'statusCode\':200}{\'statusCode\':200}{\'statusCode\':200}'),
(43, 'thrd627d4d0ebd758', 'C627e89eaa9c78', 'u627e6c58bccf1', '2022-05-14', '00:40:10', '                $(\'.comments\').load(\"../php-scripts/thread-scripts.php\", { commentLoad: true, threadID: threadID });\n                $(\'.comments\').load(\"../php-scripts/thread-scripts.php\", { commentLoad: true, threadID: threadID });\n'),
(53, 'thrd627d4d0ebd758', 'C627e92907624f', 'u627e6c58bccf1', '2022-05-14', '01:17:04', 'TANG ENA KA'),
(54, 'thrd627d4d0ebd758', 'C627e9467d5def', 'u627e6c58bccf1', '2022-05-14', '01:24:55', 'asdd'),
(55, 'thrd627d4d0ebd758', 'C627e95dcd0d7c', 'u627e6c58bccf1', '2022-05-14', '01:31:08', 'ABCDEFGHIJKLMNOPQRSTUVWXYZ\n'),
(56, 'thrd627d4d0ebd758', 'C627e971b06b9e', 'u627e6c58bccf1', '2022-05-14', '01:36:27', 'ASDASDSDS'),
(57, 'thrd627d4d0ebd758', 'C627e972cc371a', 'u627e6c58bccf1', '2022-05-14', '01:36:44', 'ASDDDDD'),
(58, 'thrd627d4d0ebd758', 'C627e98a09e1db', 'u627754a082c47', '2022-05-14', '01:42:56', 'HELLO WORLD'),
(59, 'thrd627d4d0ebd758', 'C627e99ab0d24c', 'u627754a082c47', '2022-05-14', '01:47:23', 'HELLO WORLD'),
(60, 'thrd627d4d0ebd758', 'C627e99dfb5f32', 'u627754a082c47', '2022-05-14', '01:48:15', 'HEllo world'),
(61, 'thrd627d4d0ebd758', 'C627e9a30af13d', 'u627754a082c47', '2022-05-14', '01:49:36', ',sjjb');

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
  `status` int(11) NOT NULL,
  `date_posted` date NOT NULL DEFAULT current_timestamp(),
  `time_posted` time NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `threads`
--

INSERT INTO `threads` (`id`, `thread_id`, `author`, `title`, `body`, `tags`, `status`, `date_posted`, `time_posted`) VALUES
(14, 'thrd627d44beafa1d', 'u627a6a0b58d37', 'Images are not displaying in webpage grid from uploaded image folder', 'I\'m trying to make a memory match game using reactjs. I have my components and other files in src folder. index.html,style.css and image folder(img, with all images img folders are inside public folderto display on the grid) in public folder.All images in img folder is pngs.\n\nI have to display these images in the grid , so I made a Card component for individual imagescard component and a cards component for the container. usestate and arraymap function is used to display these images.\n\nWhen I first tried with just a string \'card\' instead of bringing all images into the folder, it worked pretty well and it displayed \'card\' in all grids. Then I imported the images folder and it\'s still showing the grids and its CSS properties, but the images are not loading into the display. I changed the number of images and with respect to that, the number of grids are changing, but the images are not displaying.\n\ncontainer is a class in cards component, and card class for card.js. I have no idea what am I missing in these codes.', '{\"selected\":[\"Dropdown3\",\"Dropdown2\"]}', 0, '2022-05-13', '00:00:00'),
(15, 'thrd627d45a8d10f1', 'u627a6a0b58d37', 'Prevent content from expanding grid items', 'For simplicity, every month in that pen there has 31 days and starts on a Monday.\n\nI also chose a ridiculously small font size to demonstrate the problem:\n\nGrid items (= day cells) are pretty condensed as there are several hundreds of them on the page. And as soon as the day number labels become too large (feel free to play around with the font size in the pen using the buttons on the upper left) the grid will just grow in size and exceed the page\'s body size.\n\nIs there any way to prevent this behaviour?\n\nI initially declared my year grid to be 100% in width and height so that\'s probably the point to start at, but I couldn\'t find any grid-related CSS properties that would\'ve fitted that need.\n\nDisclaimer: I\'m aware that there are pretty easy ways to style that calendar just without using CSS Grid Layout. However, this question is more about the general knowledge on the topic than solving the concrete example.\n\n', '{\"selected\":[\"Dropdown4\",\"Dropdown3\"]}', 0, '2022-05-13', '00:00:00'),
(16, 'thrd627d4d0ebd758', 'u627a6a0b58d37', 'Error in MySQL when setting default value for DATE or DATETIME', 'I\'m running MySql Server 5.7.11 and this sentence:\n\nupdated datetime NOT NULL DEFAULT \'0000-00-00 00:00:00\'\nis not working. Giving the error:\n\nERROR 1067 (42000): Invalid default value for \'updated\'\nBut the following:\n\nupdated datetime NOT NULL DEFAULT \'1000-01-01 00:00:00\'\njust works.\n\nThe same case for DATE.\n\nAs a sidenote, it is mentioned in the MySQL docs:\n\nThe DATE type is used for values with a date part but no time part. MySQL retrieves and displays DATE values in \'YYYY-MM-DD\' format. The supported range is \'1000-01-01\' to \'9999-12-31\'.\n\neven if they also say:\n\nInvalid DATE, DATETIME, or TIMESTAMP values are converted to the “zero” value of the appropriate type (\'0000-00-00\' or \'0000-00-00 00:00:00\').\n\nHaving also into account the second quote from MySQL documentation, could anyone let me know why it is giving that error?', '{\"selected\":[]}', 0, '2022-05-13', '02:08:14');

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
  `birthdate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `uid`, `firstname`, `lastname`, `email`, `password`, `avatar`, `birthdate`) VALUES
(58, 'u627754a082c47', 'Jerico', 'Victoria', 'jericovic64@gmail.com', '132', 'assets/images/avatar/default.jpg', '2000-11-18'),
(59, 'u627a6a0b58d37', 'Jerico', 'Victoria', 'jerico.victoria@tup.edu.ph', '', 'https://lh3.googleusercontent.com/a/AATXAJxIWhnHJ95llxkqm0xfUZKrwzjP-rl2Pc594uHp=s96-c', '0000-00-00'),
(60, 'u627cec7747953', 'MAMMU TECH.', '', 'dormammu.tech@gmail.com', '', 'https://lh3.googleusercontent.com/a-/AOh14Gg3MdUZLHBRKHw19k_TYE44kRfc7n6CnNmfP7Lw=s96-c', '0000-00-00'),
(61, 'u627e6c58bccf1', 'stream', 'hub', 'streamhubemail@gmail.com', '', 'https://lh3.googleusercontent.com/a-/AOh14Gj0eJWzFoHWkZUooFNblbjkn0TGEOUGlaSs4vTW=s96-c', '0000-00-00');

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
(20, 'jericovic65@gmail.comad', '303450', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
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
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT for table `threads`
--
ALTER TABLE `threads`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT for table `users_verification`
--
ALTER TABLE `users_verification`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
