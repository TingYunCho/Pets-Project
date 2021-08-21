-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- 主機： 127.0.0.1
-- 產生時間： 2021-08-21 08:34:43
-- 伺服器版本： 10.4.18-MariaDB
-- PHP 版本： 8.0.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 資料庫： `pet-platform`
--

-- --------------------------------------------------------

--
-- 資料表結構 `customers`
--

CREATE TABLE `customers` (
  `sid` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `mobile` varchar(255) NOT NULL,
  `birthday` date NOT NULL,
  `address` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 傾印資料表的資料 `customers`
--

INSERT INTO `customers` (`sid`, `name`, `email`, `mobile`, `birthday`, `address`, `created_at`) VALUES
(3, '小虎', 'wefwe021@gmail.com', '0982917267', '2019-06-20', '花蓮縣', '2021-08-20 01:04:24'),
(4, '桃太郎', 'momo213@gmail.com', '0982917256', '2016-02-20', '鬼島', '2021-08-20 01:31:04'),
(6, '彌豆子', 'nezuko012@gmail.com', '0927182937', '2017-07-06', '台南市', '2021-08-20 01:33:28'),
(7, '善逸', 'zennitu831@wqeq.com', '0928192473', '2019-02-20', '高雄市', '2021-08-20 01:34:22'),
(8, '伊之助', 'inosuke2131@gmail.com', '0927182947', '2013-07-26', '基隆市', '2021-08-20 01:35:29'),
(9, '傑尼龜', 'kamekame123@gmail.com', '0927382983', '2009-06-20', '真新鎮', '2021-08-20 01:37:06'),
(11, '小火龍', '123123@gmail.com', '0975976589', '2005-02-28', '真新鎮', '2021-08-21 03:21:43'),
(12, '水艦龜', 'top32312@gmail.com', '0927816509', '1999-07-22', '真新鎮', '2021-08-21 03:23:44'),
(13, '菊草葉', 'aeqwq123@gmail.com', '0917283627', '2011-05-19', '高雄市', '2021-08-21 03:34:35'),
(14, '鳴人', 'naruto1213@gmail.com', '0972817493', '2014-07-16', '台中市', '2021-08-21 03:35:39'),
(15, '卡卡西', 'qweq1314@gmail.com', '0928179428', '2006-02-02', '新北市', '2021-08-21 03:37:06');

--
-- 已傾印資料表的索引
--

--
-- 資料表索引 `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`sid`);

--
-- 在傾印的資料表使用自動遞增(AUTO_INCREMENT)
--

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `customers`
--
ALTER TABLE `customers`
  MODIFY `sid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
