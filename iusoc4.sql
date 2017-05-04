-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 25, 2017 at 08:47 AM
-- Server version: 10.1.21-MariaDB
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `iusoc4`
--

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `post_body` text NOT NULL,
  `posted_by` varchar(100) NOT NULL,
  `posted_to` varchar(100) NOT NULL,
  `date_added` datetime NOT NULL,
  `removed` varchar(3) NOT NULL,
  `post_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `post_body`, `posted_by`, `posted_to`, `date_added`, `removed`, `post_id`) VALUES
(1, 'gndkgnd', 'minnie_mouse', 'minnie_mouse', '2017-04-02 08:30:04', 'no', 12),
(2, 'kngkdjnf', 'minnie_mouse', 'minnie_mouse', '2017-04-02 08:30:09', 'no', 12),
(3, 'kjnkjn\r\n', 'minnie_mouse', 'mickey_mouse', '2017-04-02 08:30:47', 'no', 10),
(4, 'nnn', 'mickey_mouse', 'mickey_mouse', '2017-04-02 15:25:14', 'no', 10),
(5, 'kkk', 'mickey_mouse', 'minnie_mouse', '2017-04-02 17:06:46', 'no', 14),
(6, 'shvhsv', 'mickey_mouse', 'mickey_mouse', '2017-04-02 23:50:12', 'no', 16),
(7, 'nsvksnvs', 'mickey_mouse', 'minnie_mouse', '2017-04-02 23:50:18', 'no', 14),
(8, 's vsmnv s', 'mickey_mouse', 'minnie_mouse', '2017-04-02 23:50:29', 'no', 14),
(9, 's vms vmn s', 'mickey_mouse', 'minnie_mouse', '2017-04-02 23:50:34', 'no', 14),
(10, 'vsvsvsv', 'mickey_mouse', 'minnie_mouse', '2017-04-02 23:51:21', 'no', 14),
(11, 'svsvsvsv', 'mickey_mouse', 'minnie_mouse', '2017-04-02 23:51:24', 'no', 14),
(12, 'svsvsvs', 'mickey_mouse', 'minnie_mouse', '2017-04-02 23:51:27', 'no', 14),
(13, 'svsvsvsvd', 'mickey_mouse', 'minnie_mouse', '2017-04-02 23:51:30', 'no', 14),
(14, 'svsdvsdv', 'mickey_mouse', 'minnie_mouse', '2017-04-02 23:51:33', 'no', 14),
(15, 'h  hbhb', 'mickey_mouse', 'mickey_mouse', '2017-04-02 23:59:00', 'no', 16),
(16, 'ncsknvskvjn', 'donald_duck', 'minnie_mouse', '2017-04-03 00:02:42', 'no', 14),
(17, 'kksbvjhsbv\r\n', 'donald_duck', 'mickey_mouse', '2017-04-04 16:32:35', 'no', 16),
(18, 'niusvnksnv\r\n', 'mickey_mouse', 'donald_duck', '2017-04-05 16:29:18', 'no', 8),
(19, 'Yup\r\n', 'rahul_sampat', 'rahul_sampat', '2017-04-13 16:16:51', 'no', 22),
(20, 'glsng', 'mickey_mouse', 'donald_duck', '2017-04-13 16:31:12', 'no', 17),
(21, 'adalda', 'donald_duck', 'mickey_mouse', '2017-04-13 16:46:21', 'no', 24),
(22, 'uyyug', 'mickey_mouse', 'donald_duck', '2017-04-24 00:42:18', 'no', 34),
(23, 'kjcnskcjn', 'mickey_mouse', 'mickey_mouse', '2017-04-25 01:08:42', 'no', 37),
(24, 'nsb csb c', 'mickey_mouse', 'donald_duck', '2017-04-25 01:08:48', 'no', 36);

-- --------------------------------------------------------

--
-- Table structure for table `friend_requests`
--

CREATE TABLE `friend_requests` (
  `id` int(11) NOT NULL,
  `user_to` varchar(100) NOT NULL,
  `user_from` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `friend_requests`
--

INSERT INTO `friend_requests` (`id`, `user_to`, `user_from`) VALUES
(1, 'rahul_sampat', 'mickey_mouse');

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

CREATE TABLE `groups` (
  `gid` int(11) NOT NULL,
  `group_name` varchar(255) NOT NULL,
  `group_owner` varchar(100) NOT NULL,
  `date_created` date NOT NULL,
  `group_pic` varchar(300) NOT NULL,
  `num_posts` int(11) NOT NULL,
  `num_users` int(11) NOT NULL,
  `users_array` text NOT NULL,
  `closed_group` varchar(3) NOT NULL,
  `about` text NOT NULL,
  `genre` varchar(255) NOT NULL,
  `deleted` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `groups`
--

INSERT INTO `groups` (`gid`, `group_name`, `group_owner`, `date_created`, `group_pic`, `num_posts`, `num_users`, `users_array`, `closed_group`, `about`, `genre`, `deleted`) VALUES
(1, 'abd', 'aaa', '2017-04-01', 'fvfv', 0, 1, ',', 'yes', 'bbb', 'bbb', 'no'),
(2, 'Test Group 1', 'donald_duck', '2017-04-20', 'assets/images/group_pics/Group-icon.png', 0, 1, ',', 'yes', 'Group About 1', 'Course', 'no'),
(3, 'Test Group 2', 'donald_duck', '2017-04-20', 'assets/images/group_pics/Group-icon.png', 0, 1, ',donald_duck,', 'yes', 'Group About 2', 'Course', 'no'),
(4, 'Sample_Group_1', 'mickey_mouse', '2017-04-22', 'assets/images/group_pics/Group-icon.png', 0, 1, ',mickey_mouse,', 'no', 'Test', 'Course', 'yes'),
(5, 'Group_2', 'mickey_mouse', '2017-04-22', 'assets/images/group_pics/Group-icon.png', 0, 1, ',mickey_mouse,', 'yes', 'Testing', 'Course', 'no'),
(6, 'Sample_Group_3', 'mickey_mouse', '2017-04-22', 'assets/images/group_pics/Group-icon.png', 1, 2, ',mickey_mouse,donald_duck,', 'no', 'Group 3', 'Course', 'no'),
(7, 'IU_Global_Forum', 'mickey_mouse', '2017-04-24', 'assets/images/group_pics/Group-icon.png', 0, 1, ',mickey_mouse,minnie_mouse,rahul_sampat', 'no', 'IU Global Forum for Student Discussions', 'Courses', 'no');

-- --------------------------------------------------------

--
-- Table structure for table `groups_request`
--

CREATE TABLE `groups_request` (
  `id` int(11) NOT NULL,
  `user_from` varchar(100) NOT NULL,
  `group_to` varchar(100) NOT NULL,
  `group_owner` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `likes`
--

CREATE TABLE `likes` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `post_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `likes`
--

INSERT INTO `likes` (`id`, `username`, `post_id`) VALUES
(4, 'minnie_mouse', 12),
(5, 'minnie_mouse', 10),
(7, 'minnie_mouse', 8),
(8, 'minnie_mouse', 6),
(9, 'mickey_mouse', 10),
(10, 'mickey_mouse', 14),
(14, 'donald_duck', 16),
(15, 'mickey_mouse', 8),
(16, 'donald_duck', 8),
(17, 'mickey_mouse', 17),
(18, 'donald_duck', 24),
(29, 'mickey_mouse', 16),
(30, 'mickey_mouse', 34),
(31, 'mickey_mouse', 37);

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` int(11) NOT NULL,
  `user_to` varchar(100) NOT NULL,
  `group_to` varchar(100) NOT NULL,
  `user_from` varchar(100) NOT NULL,
  `body` text NOT NULL,
  `date` datetime NOT NULL,
  `opened` varchar(3) NOT NULL,
  `viewed` varchar(3) NOT NULL,
  `deleted` varchar(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `user_to`, `group_to`, `user_from`, `body`, `date`, `opened`, `viewed`, `deleted`) VALUES
(1, 'minnie_mouse', 'none', 'mickey_mouse', 'Hey Minnie', '2017-04-02 16:04:17', 'yes', 'yes', 'no'),
(2, 'minnie_mouse', 'none', 'mickey_mouse', 'Yo', '2017-04-02 16:11:10', 'yes', 'yes', 'no'),
(3, 'mickey_mouse', 'none', 'minnie_mouse', 'Yooo', '2017-04-02 16:11:43', 'yes', 'yes', 'no'),
(4, 'donald_duck', 'none', 'minnie_mouse', 'Helloooo', '2017-04-02 16:11:59', 'yes', 'yes', 'no'),
(5, 'mickey_mouse', 'none', 'minnie_mouse', 'YYYYYYYYY', '2017-04-02 16:12:12', 'yes', 'yes', 'no'),
(6, 'minnie_mouse', 'none', 'mickey_mouse', 'nkndvs', '2017-04-02 16:15:22', 'yes', 'yes', 'no'),
(7, 'minnie_mouse', 'none', 'mickey_mouse', 'kjnvkdjnfv', '2017-04-02 16:15:27', 'yes', 'yes', 'no'),
(8, 'minnie_mouse', 'none', 'mickey_mouse', 'djkjvkjnv ', '2017-04-02 16:15:32', 'yes', 'yes', 'no'),
(9, 'minnie_mouse', 'none', 'mickey_mouse', 'kjfnvkdsnkndb', '2017-04-02 16:15:39', 'yes', 'yes', 'no'),
(10, 'minnie_mouse', 'none', 'mickey_mouse', 'knvkndkvnjkdvn', '2017-04-02 16:15:42', 'yes', 'yes', 'no'),
(11, 'minnie_mouse', 'none', 'mickey_mouse', 'fmvdsnbkjdnskbn', '2017-04-02 16:15:46', 'yes', 'yes', 'no'),
(12, 'minnie_mouse', 'none', 'mickey_mouse', 'kjnvksfndkndkbf', '2017-04-02 16:15:48', 'yes', 'yes', 'no'),
(13, 'minnie_mouse', 'none', 'mickey_mouse', 'kvjndkjnvkdnj', '2017-04-02 16:15:51', 'yes', 'yes', 'no'),
(14, 'minnie_mouse', 'none', 'mickey_mouse', 'jnvknvfdknb', '2017-04-02 16:15:54', 'yes', 'yes', 'no'),
(15, 'mickey_mouse', 'none', 'minnie_mouse', 'knkjnk', '2017-04-02 16:16:29', 'yes', 'yes', 'no'),
(16, 'minnie_mouse', 'none', 'minnie_mouse', 'kjkj', '2017-04-02 16:20:14', 'yes', 'yes', 'no'),
(17, 'donald_duck', 'none', 'mickey_mouse', 'sldfnlskbn', '2017-04-02 16:46:59', 'yes', 'yes', 'no'),
(18, 'mickey_mouse', 'none', 'mickey_mouse', 'ksnvskv', '2017-04-04 16:34:00', 'yes', 'yes', 'no'),
(19, 'donald_duck', 'none', 'mickey_mouse', 'skvksv', '2017-04-04 16:34:31', 'yes', 'yes', 'no'),
(20, 'minnie_mouse', 'none', 'mickey_mouse', 'ksvkwbvkajb', '2017-04-05 01:49:17', 'yes', 'yes', 'no'),
(21, 'donald_duck', 'none', 'mickey_mouse', 'skvksv', '2017-04-05 16:29:50', 'yes', 'yes', 'no'),
(22, 'donald_duck', 'none', 'mickey_mouse', 'Helllloooo', '2017-04-05 16:29:57', 'yes', 'yes', 'no'),
(23, 'donald_duck', 'none', 'mickey_mouse', 'Hello', '2017-04-13 16:26:17', 'yes', 'yes', 'no'),
(24, 'mickey_mouse', 'none', 'donald_duck', 'Hi', '2017-04-13 16:27:46', 'yes', 'yes', 'no'),
(25, 'mickey_mouse', 'none', 'donald_duck', 'Hello', '2017-04-13 16:45:55', 'yes', 'yes', 'no'),
(26, 'mickey_mouse', 'none', 'donald_duck', 'Hi', '2017-04-23 18:48:16', 'yes', 'yes', 'no'),
(27, 'mickey_mouse', 'none', 'donald_duck', 'nvjnvjfnv', '2017-04-23 20:06:04', 'yes', 'yes', 'no'),
(28, 'mickey_mouse', 'none', 'donald_duck', 'nvjnvjfnv', '2017-04-23 20:10:10', 'yes', 'yes', 'no'),
(29, 'mickey_mouse', 'none', 'donald_duck', 'jbjhbjhb', '2017-04-23 20:10:47', 'yes', 'yes', 'no'),
(30, 'none', 'Test Group 2', 'donald_duck', 'Hello', '2017-04-23 20:12:02', 'no', 'no', 'no'),
(31, 'none', 'Sample_Group_3', 'mickey_mouse', 'Hellooo', '2017-04-23 20:14:40', 'no', 'no', 'no'),
(32, 'none', 'Sample_Group_3', 'mickey_mouse', 'Hellooo', '2017-04-23 20:16:02', 'no', 'no', 'no'),
(33, 'none', 'Sample_Group_3', 'mickey_mouse', 'Hellooo', '2017-04-23 20:16:09', 'no', 'no', 'no'),
(34, 'none', 'Sample_Group_3', 'mickey_mouse', 'Hellooo', '2017-04-23 20:16:58', 'no', 'no', 'no'),
(35, 'none', 'Sample_Group_3', 'mickey_mouse', 'Yes', '2017-04-23 20:19:06', 'no', 'no', 'no'),
(36, 'none', 'Sample_Group_3', 'donald_duck', 'There', '2017-04-23 20:36:57', 'no', 'no', 'no'),
(37, 'donald_duck', 'none', 'mickey_mouse', 'Hi', '2017-04-23 20:41:40', 'yes', 'yes', 'no'),
(38, 'donald_duck', 'none', 'mickey_mouse', 'Hi', '2017-04-23 21:03:30', 'yes', 'yes', 'no'),
(39, 'minnie_mouse', 'none', 'donald_duck', 'Hiii', '2017-04-24 00:43:14', 'no', 'yes', 'no'),
(40, 'none', 'Sample_Group_3', 'donald_duck', 'hello\r\n\r\n', '2017-04-24 00:46:42', 'no', 'no', 'no'),
(41, 'none', 'Sample_Group_3', 'donald_duck', 'hhhhi', '2017-04-24 00:46:52', 'no', 'no', 'no'),
(42, 'mickey_mouse', 'none', 'donald_duck', 'Rahul', '2017-04-25 02:07:19', 'yes', 'yes', 'no');

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` int(11) NOT NULL,
  `user_to` varchar(100) NOT NULL,
  `user_from` varchar(100) NOT NULL,
  `message` text NOT NULL,
  `link` varchar(100) NOT NULL,
  `datetime` datetime NOT NULL,
  `opened` varchar(3) NOT NULL,
  `viewed` varchar(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `user_to`, `user_from`, `message`, `link`, `datetime`, `opened`, `viewed`) VALUES
(1, 'minnie_mouse', 'mickey_mouse', 'Mickey Mouse liked your post', 'post.php?id=14', '2017-04-02 17:06:39', 'yes', 'yes'),
(2, 'minnie_mouse', 'mickey_mouse', 'Mickey Mouse commented on your post', 'post.php?id=14', '2017-04-02 17:06:46', 'yes', 'yes'),
(3, 'minnie_mouse', 'mickey_mouse', 'Mickey Mouse commented on your profile post', 'post.php?id=16', '2017-04-02 23:50:12', 'yes', 'yes'),
(4, 'minnie_mouse', 'mickey_mouse', 'Mickey Mouse commented on your post', 'post.php?id=14', '2017-04-02 23:50:18', 'yes', 'yes'),
(5, 'minnie_mouse', 'mickey_mouse', 'Mickey Mouse commented on your post', 'post.php?id=14', '2017-04-02 23:50:29', 'yes', 'yes'),
(6, 'minnie_mouse', 'mickey_mouse', 'Mickey Mouse commented on your post', 'post.php?id=14', '2017-04-02 23:50:34', 'yes', 'yes'),
(7, 'minnie_mouse', 'mickey_mouse', 'Mickey Mouse commented on your post', 'post.php?id=14', '2017-04-02 23:51:21', 'yes', 'yes'),
(8, 'minnie_mouse', 'mickey_mouse', 'Mickey Mouse commented on your post', 'post.php?id=14', '2017-04-02 23:51:24', 'yes', 'yes'),
(9, 'minnie_mouse', 'mickey_mouse', 'Mickey Mouse commented on your post', 'post.php?id=14', '2017-04-02 23:51:27', 'yes', 'yes'),
(10, 'minnie_mouse', 'mickey_mouse', 'Mickey Mouse commented on your post', 'post.php?id=14', '2017-04-02 23:51:30', 'yes', 'yes'),
(11, 'minnie_mouse', 'mickey_mouse', 'Mickey Mouse commented on your post', 'post.php?id=14', '2017-04-02 23:51:34', 'yes', 'yes'),
(12, 'minnie_mouse', 'mickey_mouse', 'Mickey Mouse commented on your profile post', 'post.php?id=16', '2017-04-02 23:59:00', 'no', 'yes'),
(13, 'minnie_mouse', 'donald_duck', 'Donald Duck commented on your post', 'post.php?id=14', '2017-04-03 00:02:43', 'no', 'yes'),
(14, 'mickey_mouse', 'donald_duck', 'Donald Duck commented on a post you commented on', 'post.php?id=14', '2017-04-03 00:02:43', 'yes', 'yes'),
(15, 'donald_duck', 'mickey_mouse', 'Mickey2 Mouse2 liked your post', 'post.php?id=8', '2017-04-03 18:35:54', 'yes', 'yes'),
(16, 'mickey_mouse', 'donald_duck', 'Donald Duck liked your post', 'post.php?id=16', '2017-04-03 16:56:53', 'yes', 'yes'),
(17, 'mickey_mouse', 'donald_duck', 'Donald Duck liked your post', 'post.php?id=16', '2017-04-04 16:32:30', 'yes', 'yes'),
(18, 'mickey_mouse', 'donald_duck', 'Donald Duck commented on your post', 'post.php?id=16', '2017-04-04 16:32:35', 'yes', 'yes'),
(19, 'minnie_mouse', 'donald_duck', 'Donald Duck commented on your profile post', 'post.php?id=16', '2017-04-04 16:32:35', 'no', 'yes'),
(20, 'donald_duck', 'mickey_mouse', 'Rahul Sampat commented on your post', 'post.php?id=8', '2017-04-05 16:29:18', 'yes', 'yes'),
(21, 'donald_duck', 'mickey_mouse', 'Rahul Sampat liked your post', 'post.php?id=8', '2017-04-05 16:29:21', 'yes', 'yes'),
(22, 'donald_duck', 'mickey_mouse', 'Rahul Sampat liked your post', 'post.php?id=17', '2017-04-13 16:31:07', 'yes', 'yes'),
(23, 'donald_duck', 'mickey_mouse', 'Rahul Sampat commented on your post', 'post.php?id=17', '2017-04-13 16:31:12', 'yes', 'yes'),
(24, 'mickey_mouse', 'donald_duck', 'Stephen Paul liked your post', 'post.php?id=24', '2017-04-13 16:46:18', 'yes', 'yes'),
(25, 'mickey_mouse', 'donald_duck', 'Stephen Paul commented on your post', 'post.php?id=24', '2017-04-13 16:46:21', 'yes', 'yes'),
(26, 'donald_duck', 'mickey_mouse', 'Rahul Sampat liked your post', 'post.php?id=27', '2017-04-22 20:54:50', 'no', 'yes'),
(27, 'donald_duck', 'mickey_mouse', 'Rahul Sampat liked your post', 'post.php?id=28', '2017-04-22 21:03:00', 'yes', 'yes'),
(28, 'donald_duck', 'mickey_mouse', 'Rahul Sampat liked your post', 'post.php?id=28', '2017-04-22 21:03:02', 'yes', 'yes'),
(29, 'donald_duck', 'mickey_mouse', 'Rahul Sampat liked your post', 'post.php?id=28', '2017-04-22 21:03:04', 'yes', 'yes'),
(30, 'donald_duck', 'mickey_mouse', 'Rahul Sampat liked your post', 'post.php?id=28', '2017-04-22 21:03:06', 'yes', 'yes'),
(31, 'Sample_Group_3', 'mickey_mouse', 'Rahul Sampat liked your post', 'post.php?id=29', '2017-04-23 16:08:56', 'no', 'no'),
(32, 'Sample_Group_3', 'mickey_mouse', 'Rahul Sampat liked your post', 'post.php?id=30', '2017-04-23 16:15:35', 'no', 'no'),
(33, 'Sample_Group_3', 'mickey_mouse', 'Rahul Sampat liked your post', 'post.php?id=31', '2017-04-23 16:16:33', 'no', 'no'),
(34, 'donald_duck', 'mickey_mouse', 'Rahul Sampat liked your post', 'post.php?id=33', '2017-04-23 17:25:37', 'yes', 'yes'),
(35, 'mickey_mouse', 'donald_duck', 'Stephen Paul liked your post', 'post.php?id=34', '2017-04-23 17:32:30', 'no', 'yes'),
(36, 'donald_duck', 'mickey_mouse', 'Rahul Sampat posted on your profile', 'post.php?id=35', '2017-04-23 18:37:17', 'yes', 'yes'),
(37, 'donald_duck', 'mickey_mouse', 'Rahul Sampat liked your post', 'post.php?id=34', '2017-04-24 00:42:01', 'yes', 'yes'),
(38, 'donald_duck', 'mickey_mouse', 'Rahul Sampat commented on your post', 'post.php?id=34', '2017-04-24 00:42:18', 'yes', 'yes'),
(39, 'donald_duck', 'mickey_mouse', 'Rahul Sampat commented on your post', 'post.php?id=36', '2017-04-25 01:08:48', 'yes', 'yes');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` int(11) NOT NULL,
  `body` varchar(1000) NOT NULL,
  `added_by` varchar(120) NOT NULL,
  `user_to` varchar(120) NOT NULL,
  `group_to` varchar(255) NOT NULL,
  `date_added` datetime NOT NULL,
  `user_closed` varchar(3) NOT NULL,
  `deleted` varchar(3) NOT NULL,
  `likes` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `body`, `added_by`, `user_to`, `group_to`, `date_added`, `user_closed`, `deleted`, `likes`) VALUES
(1, 'This is the first post!!', 'mickey_mouse', 'none', 'none', '2017-04-01 19:38:23', 'no', 'no', 0),
(2, 'Third post', 'mickey_mouse', 'none', 'none', '2017-04-01 19:39:49', 'no', 'no', 0),
(3, 'dvkdvn', 'mickey_mouse', 'none', 'none', '2017-04-01 19:46:39', 'no', 'no', 0),
(4, 'dvkdvn', 'mickey_mouse', 'none', 'none', '2017-04-01 19:46:43', 'no', 'no', 0),
(5, 'After full post func', 'mickey_mouse', 'none', 'none', '2017-04-01 21:01:43', 'no', 'no', 0),
(6, 'Yo yo!!', 'mickey_mouse', 'none', 'none', '2017-04-02 03:05:10', 'no', 'yes', 0),
(7, 'Helllllllooo', 'donald_duck', 'none', 'none', '2017-04-02 04:35:11', 'no', 'no', 0),
(8, 'Helllllllooo', 'donald_duck', 'none', 'none', '2017-04-02 04:36:48', 'no', 'no', 2),
(9, 'sda', 'asdfsd', 'asdfsdaf', 'none', '2017-04-02 08:20:11', 'no', 'no', 0),
(10, 'YYYYY', 'mickey_mouse', 'none', 'none', '2017-04-02 08:20:11', 'no', 'no', 2),
(11, 'sda', 'asdfsd', 'asdfsdaf', 'none', '2017-04-02 08:29:51', 'no', 'no', 0),
(12, 'skrgkdng\r\n', 'minnie_mouse', 'none', 'none', '2017-04-02 08:29:51', 'no', 'yes', 1),
(13, 'sda', 'asdfsd', 'asdfsdaf', 'none', '2017-04-02 08:30:29', 'no', 'no', 0),
(14, 'khnkjn', 'minnie_mouse', 'none', 'none', '2017-04-02 08:30:30', 'no', 'no', 1),
(15, 'sda', 'asdfsd', 'asdfsdaf', 'none', '2017-04-02 15:36:01', 'no', 'no', 0),
(16, 'Hey Minnie', 'mickey_mouse', 'minnie_mouse', 'none', '2017-04-02 15:36:01', 'no', 'no', 1),
(17, '<br><iframe width=\'420\' height=\'315\' src=\'https://www.youtube.com/embed/JGwWNGJdvx8\'></iframe><br>', 'donald_duck', 'none', 'none', '2017-04-03 18:54:41', 'no', 'no', 1),
(18, 'Check this <br><iframe width=\'420\' height=\'315\' src=\'out:\r\nhttps://www.youtube.com/embed/JGwWNGJdvx8\'></iframe><br>', 'donald_duck', 'none', 'none', '2017-04-03 18:54:56', 'no', 'yes', 0),
(19, 'Check this <br><iframe width=\'420\' height=\'315\' src=\'out:\r\nhttps://www.youtube.com/embed/JGwWNGJdvx8\'></iframe><br>', 'donald_duck', 'none', 'none', '2017-04-03 14:17:21', 'no', 'yes', 0),
(20, 'nskuusf', 'mickey_mouse', 'none', 'none', '2017-04-04 16:33:06', 'no', 'no', 0),
(21, 'jvjv', 'mickey_mouse', 'none', 'none', '2017-04-05 01:48:50', 'no', 'no', 0),
(22, 'kvnkusbvs', 'rahul_sampat', 'none', 'none', '2017-04-05 16:32:29', 'no', 'no', 0),
(23, 'https://www.linkedin.com/in/ngnishant/', 'rahul_sampat', 'none', 'none', '2017-04-05 16:34:36', 'no', 'no', 0),
(24, 'Hi', 'mickey_mouse', 'none', 'none', '2017-04-13 16:24:08', 'no', 'no', 1),
(25, 'nkvjnkjnv', 'donald_duck', 'none', 'none', '2017-04-20 20:34:25', 'no', 'no', 0),
(26, 'vkjdnvkdjnvkjd', 'donald_duck', 'none', 'none', '2017-04-20 20:35:41', 'no', 'no', 0),
(27, 'fvkjnvkjfv', 'donald_duck', 'none', 'none', '2017-04-20 20:39:22', 'no', 'no', 0),
(28, 'aaa', 'donald_duck', 'none', 'none', '2017-04-20 21:45:16', 'no', 'no', 0),
(29, 'First Group Post', 'mickey_mouse', 'Sample_Group_3', 'none', '2017-04-23 16:08:56', 'no', 'no', 0),
(30, 'First group post', 'mickey_mouse', 'Sample_Group_3', 'none', '2017-04-23 16:15:35', 'no', 'no', 0),
(31, 'First Grouppp Post!!', 'mickey_mouse', 'Sample_Group_3', 'none', '2017-04-23 16:16:33', 'no', 'no', 0),
(32, 'dcdcdc', 'mickey_mouse', 'none', 'Sample_Group_3', '2017-04-23 16:48:59', 'no', 'no', 0),
(33, 'How u??', 'mickey_mouse', 'donald_duck', 'none', '2017-04-23 17:25:37', 'no', 'no', 0),
(34, 'Helloo', 'donald_duck', 'mickey_mouse', 'none', '2017-04-23 17:32:30', 'no', 'no', 1),
(35, 'Helllo', 'mickey_mouse', 'donald_duck', 'none', '2017-04-23 18:37:17', 'no', 'yes', 0),
(36, 'efef', 'donald_duck', 'none', 'Sample_Group_3', '2017-04-24 18:36:17', 'no', 'no', 0),
(37, 'iuwibwv', 'mickey_mouse', 'none', 'none', '2017-04-25 01:08:33', 'no', 'no', 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `username` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `signup_date` date NOT NULL,
  `profile_pic` varchar(255) NOT NULL,
  `num_posts` int(11) NOT NULL,
  `num_likes` int(11) NOT NULL,
  `user_closed` varchar(3) NOT NULL,
  `friend_array` text NOT NULL,
  `title` varchar(50) NOT NULL DEFAULT '" "',
  `type` varchar(15) NOT NULL DEFAULT '" "',
  `about` text NOT NULL,
  `project` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `username`, `email`, `password`, `signup_date`, `profile_pic`, `num_posts`, `num_likes`, `user_closed`, `friend_array`, `title`, `type`, `about`, `project`) VALUES
(2, 'David', 'Cooper', 'rahul_sampat', 'sampatrahul@gmail.com', '5f4dcc3b5aa765d61d8327deb882cf99', '2017-04-01', 'assets/images/profile_pics/defaults/head_pomegranate.png', 2, 0, 'no', ',donald_duck,', 'MS in DS', 'Student', '', ''),
(3, 'Rahul', 'Sampat', 'mickey_mouse', 'mickey_mouse@gmail.com', 'e2ea3e4af5da8abbe3ada277c6c51521', '2017-04-01', 'assets/images/profile_pics/mickey_mouseb5aea36542b3f4b3da16987035960aean.jpeg', 20, 5, 'no', ',minnie_mouse,donald_duck,', 'MS in HCI', 'Student', '', ''),
(4, 'Sai', 'Pardhu', 'minnie_mouse', 'minnie_mouse@gmail.com', 'c6c0329bba537835e48e2be9a8e9c8f7', '2017-04-01', 'assets/images/profile_pics/defaults/head_pomegranate.png', 2, 2, 'no', ',mickey_mouse,donald_duck,', 'MS in HCI', 'Student', '', ''),
(5, 'Stephen', 'Paul', 'donald_duck', 'donald_duck@gmail.com', '0d343c0f0ca763f983c8042350059f56', '2017-04-01', 'assets/images/profile_pics/donald_duckb15f2c6fe403071000061998a21d3478n.jpeg', 11, 4, 'no', ',minnie_mouse,rahul_sampat,mickey_mouse,', 'MS in DS', 'Professor', 'MS in Comp Science', '1) IU Project'),
(10, 'Captain', 'America', 'captain_america', 'camerica@gmail.com', 'ab334feeb31c05124cb73fa12571c2f6', '2017-04-04', 'assets/images/profile_pics/defaults/head_belize_hole.png', 0, 0, 'no', ',', 'Ms In Cs', 'Student', '', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `friend_requests`
--
ALTER TABLE `friend_requests`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`gid`);

--
-- Indexes for table `groups_request`
--
ALTER TABLE `groups_request`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `likes`
--
ALTER TABLE `likes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
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
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
--
-- AUTO_INCREMENT for table `friend_requests`
--
ALTER TABLE `friend_requests`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `groups`
--
ALTER TABLE `groups`
  MODIFY `gid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `groups_request`
--
ALTER TABLE `groups_request`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `likes`
--
ALTER TABLE `likes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;
--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;
--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;
--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
