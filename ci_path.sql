-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 2018-03-30 08:54:45
-- 服务器版本： 10.1.21-MariaDB
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ci_path`
--

-- --------------------------------------------------------

--
-- 表的结构 `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`) VALUES
(10, 'admin', 'cb89c0b02495e9bbd1d2f99f1abe1b6c01b2e38b'),
(11, 'ferre', 'cb89c0b02495e9bbd1d2f99f1abe1b6c01b2e38b'),
(13, 'fade', 'cb89c0b02495e9bbd1d2f99f1abe1b6c01b2e38b');

-- --------------------------------------------------------

--
-- 表的结构 `admin_log`
--

CREATE TABLE `admin_log` (
  `id` int(11) NOT NULL,
  `ip` varchar(255) NOT NULL,
  `type` varchar(50) NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `username` text NOT NULL,
  `password` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `admin_log`
--

INSERT INTO `admin_log` (`id`, `ip`, `type`, `time`, `username`, `password`) VALUES
(1, '127.0.0.1', '1', '2018-03-28 09:37:10', 'admin', 'wh1234'),
(2, '127.0.0.1', '0', '2018-03-28 09:37:20', 'admin', 'asd'),
(3, '127.0.0.1', '1', '2018-03-28 09:37:30', 'admin', 'wh1234'),
(4, '127.0.0.1', '1', '2018-03-29 02:35:10', 'admin', 'wh1234'),
(5, '127.0.0.1', '1', '2018-03-29 05:40:30', 'admin', 'wh1234');

-- --------------------------------------------------------

--
-- 表的结构 `cate`
--

CREATE TABLE `cate` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `sort` int(11) NOT NULL,
  `desc` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `cate`
--

INSERT INTO `cate` (`id`, `title`, `sort`, `desc`) VALUES
(1, '娱乐', 1, '收录一些娱乐网站，包括电影电视读物等'),
(2, 'Web', 2, 'fake'),
(3, '项目', 3, '关于项目');

-- --------------------------------------------------------

--
-- 表的结构 `link`
--

CREATE TABLE `link` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `url` varchar(255) NOT NULL,
  `sort` int(11) NOT NULL,
  `pid` int(11) NOT NULL,
  `desc` text NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `link`
--

INSERT INTO `link` (`id`, `title`, `url`, `sort`, `pid`, `desc`, `time`) VALUES
(1, '掘金', 'https://juejin.im', 1, 2, '掘金，一个帮助开发者成长的社区', '2018-03-27 16:00:00'),
(2, '慕课网', 'https://www.imooc.com', 2, 1, '一个IT技术视频教学网站', '2018-03-26 16:00:00'),
(24, 'CSDN', 'https://www.csdn.net', 6, 2, '国内IT技术平台', '2018-03-29 08:43:29'),
(25, '6v电影', 'http://www.6vhao.tv/', 5, 1, '', '2018-03-29 07:17:51'),
(26, '电影天堂', 'http://www.dytt8.net/', 6, 1, '', '2018-03-29 07:18:14'),
(27, 'Alexa', 'http://alexa.ferre.top/', 3, 3, '', '2018-03-29 07:18:36'),
(28, '种子搜索', 'http://www.btwhat.info/', 5, 1, '一个关于种子搜索的网站', '2018-03-29 08:41:02'),
(29, '电驴', 'http://www.verycd.com/', 5, 1, '一个CD资源下载站', '2018-03-29 08:42:09'),
(30, '库克音乐', 'http://www.kuke.com/', 5, 1, '一个古典音乐门户网站', '2018-03-29 08:44:53');

-- --------------------------------------------------------

--
-- 表的结构 `tourist`
--

CREATE TABLE `tourist` (
  `id` int(11) NOT NULL,
  `type` varchar(50) NOT NULL,
  `ip` varchar(255) NOT NULL,
  `country` varchar(255) NOT NULL,
  `province` text NOT NULL,
  `city` text NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `admin_log`
--
ALTER TABLE `admin_log`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cate`
--
ALTER TABLE `cate`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `link`
--
ALTER TABLE `link`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tourist`
--
ALTER TABLE `tourist`
  ADD PRIMARY KEY (`id`);

--
-- 在导出的表使用AUTO_INCREMENT
--

--
-- 使用表AUTO_INCREMENT `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- 使用表AUTO_INCREMENT `admin_log`
--
ALTER TABLE `admin_log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- 使用表AUTO_INCREMENT `cate`
--
ALTER TABLE `cate`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- 使用表AUTO_INCREMENT `link`
--
ALTER TABLE `link`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;
--
-- 使用表AUTO_INCREMENT `tourist`
--
ALTER TABLE `tourist`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
