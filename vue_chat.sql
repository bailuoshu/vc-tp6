-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- 主机： localhost
-- 生成日期： 2022-05-26 20:17:33
-- 服务器版本： 5.7.26
-- PHP 版本： 7.3.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 数据库： `vue_chat`
--

-- --------------------------------------------------------

--
-- 表的结构 `friend_list`
--

CREATE TABLE `friend_list` (
  `uid` int(9) NOT NULL,
  `friend_uid` varchar(9000) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- 表的结构 `msg_list`
--

CREATE TABLE `msg_list` (
  `msg_id` int(9) NOT NULL,
  `from_uid` int(9) NOT NULL,
  `from_uname` char(200) COLLATE utf8_unicode_ci NOT NULL,
  `to_uid` int(9) NOT NULL,
  `to_uname` char(200) COLLATE utf8_unicode_ci NOT NULL,
  `type` char(36) COLLATE utf8_unicode_ci NOT NULL,
  `data` varchar(2048) COLLATE utf8_unicode_ci NOT NULL,
  `is_see` int(1) DEFAULT '0',
  `time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- 表的结构 `user_list`
--

CREATE TABLE `user_list` (
  `uid` int(9) NOT NULL,
  `uname` char(200) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(1000) COLLATE utf8_unicode_ci NOT NULL,
  `e_mali` char(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `head_url` char(200) COLLATE utf8_unicode_ci DEFAULT 'https://cube.elemecdn.com/9/c2/f0ee8a3c7c9638a54940382568c9dpng.png',
  `time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 转存表中的数据 `user_list`
--

INSERT INTO `user_list` (`uid`, `uname`, `password`, `e_mali`, `head_url`, `time`) VALUES
(111111111, '测试账户(1)', 'test001', NULL, 'https://cube.elemecdn.com/9/c2/f0ee8a3c7c9638a54940382568c9dpng.png', '2022-05-26 20:17:13'),
(222222222, '测试账户(2)', 'test002', NULL, 'https://cube.elemecdn.com/9/c2/f0ee8a3c7c9638a54940382568c9dpng.png', '2022-05-26 20:17:13');

--
-- 转储表的索引
--

--
-- 表的索引 `friend_list`
--
ALTER TABLE `friend_list`
  ADD PRIMARY KEY (`uid`);

--
-- 表的索引 `msg_list`
--
ALTER TABLE `msg_list`
  ADD PRIMARY KEY (`msg_id`);

--
-- 表的索引 `user_list`
--
ALTER TABLE `user_list`
  ADD PRIMARY KEY (`uid`);

--
-- 在导出的表使用AUTO_INCREMENT
--

--
-- 使用表AUTO_INCREMENT `msg_list`
--
ALTER TABLE `msg_list`
  MODIFY `msg_id` int(9) NOT NULL AUTO_INCREMENT;

--
-- 使用表AUTO_INCREMENT `user_list`
--
ALTER TABLE `user_list`
  MODIFY `uid` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=222222223;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
