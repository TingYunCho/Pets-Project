-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- 主機： 127.0.0.1
-- 產生時間： 2021-08-21 08:34:04
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
-- 資料表結構 `members`
--

CREATE TABLE `members` (
  `id` int(11) NOT NULL,
  `avatar` varchar(255) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `nickname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `mobile` varchar(255) NOT NULL,
  `birthday` date DEFAULT NULL,
  `address` varchar(255) NOT NULL,
  `hash` varchar(255) DEFAULT NULL,
  `activated` varchar(255) DEFAULT NULL,
  `create_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 傾印資料表的資料 `members`
--

INSERT INTO `members` (`id`, `avatar`, `name`, `nickname`, `email`, `password`, `mobile`, `birthday`, `address`, `hash`, `activated`, `create_at`) VALUES
(1, 'S__4292684.jpg.jpg', '褚小淵', '圓圓', 'sharon097@gmail.com', 'abc123456', '0900974033', '2013-08-01', '新北市中正區233號五樓', NULL, '0', '2021-08-16 13:21:50'),
(4, '20180702092006121.jpg.jpg', '可達鴨', '鴨子', 'swqqw99@yahoo.com.tw', 'Qp0987211', '0920965055', '2021-08-11', '新北市', NULL, NULL, '2021-08-18 18:46:43'),
(5, '64e2027739a3d075959471d0e82249ec.jpg.jpg', '伊布', '阿布', '8230232k@yahoo.com.tw', 'pQ098u943', '0975976543', '2021-08-19', '新北市', NULL, NULL, '2021-08-18 18:51:22'),
(6, 'S__4333628.jpg.jpg', '小次郎', '次郎', 'fff99088@yahoo.com.tw', 'ui0987543', '0975976543', '2021-08-19', '新北市', NULL, NULL, '2021-08-18 19:03:30'),
(12, '20h51md.jpg.jpg', '皮卡丘', '小丘', 'pikacyo@gmail.com', 'pikacyo99', '0962819635', '2021-08-13', '永和區', NULL, NULL, '2021-08-19 16:56:45'),
(13, 'Dl2MXmCV4AAdxsS.jpg.jpg', '郎人人', '小貓貓', 'jj1623123@gmail.com', 'hj6890087', '0927816537', '2021-06-09', '永和', NULL, NULL, '2021-08-19 19:36:31'),
(14, 'D2Q0RQyUkAAjvap.jpg.jpg', '小星星', '小星', 'hjw979102@gmail.com', 'ty78972213', '0991725398', '2012-06-19', '高雄市', NULL, NULL, '2021-08-19 19:47:13'),
(20, '311C02ED-7A00-48B1-B063-D83DF53EF175.jpg.jpg', '陸特', '陸陸', 'sharon0912312@gmail.com', '123aee1133', '0927816537', '2021-08-18', '新北市永和區', NULL, NULL, '2021-08-20 14:34:07'),
(21, NULL, '老王', '隔壁老王', 'a789789@gmail.com', '123456', '0921123123', NULL, '', NULL, NULL, '2021-08-20 00:00:00');

--
-- 已傾印資料表的索引
--

--
-- 資料表索引 `members`
--
ALTER TABLE `members`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email_2` (`email`),
  ADD KEY `email` (`email`);

--
-- 在傾印的資料表使用自動遞增(AUTO_INCREMENT)
--

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `members`
--
ALTER TABLE `members`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
