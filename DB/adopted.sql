-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- 主機： localhost
-- 產生時間： 2021 年 08 月 22 日 14:56
-- 伺服器版本： 10.4.20-MariaDB
-- PHP 版本： 7.4.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 資料庫: `Micheal`
--

-- --------------------------------------------------------

--
-- 資料表結構 `adopted`
--

CREATE TABLE `adopted` (
  `sid` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `breed` varchar(255) DEFAULT NULL,
  `gender` varchar(255) NOT NULL,
  `age` varchar(255) DEFAULT NULL,
  `family` varchar(255) NOT NULL,
  `intro` varchar(255) NOT NULL,
  `district` varchar(255) NOT NULL,
  `created_at` date NOT NULL,
  `avatar` varchar(255) DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 傾印資料表的資料 `adopted`
--

INSERT INTO `adopted` (`sid`, `name`, `breed`, `gender`, `age`, `family`, `intro`, `district`, `created_at`, `avatar`) VALUES
(1, '黑烏烏', '台灣土狗', 'male', '成年', '犬科', '只剩眼睛和牙齒是白的', '台北', '2021-07-01', NULL),
(6, '脫窗', '英國短毛', 'female', '成年', '貓科', '眼白很大看起來像脫窗', '高雄', '2021-08-22', ''),
(8, 'KOLO', '米克斯', 'male', '幼年', '貓科', '神秘???', '台南', '2021-07-19', ''),
(10, '小花', '米克斯', 'female', '幼年', '貓科', '高傲 喜歡高處觀看', '桃園', '2021-07-17', ''),
(11, '小柴', '柴犬', 'male', '成年', '犬科', '愛跟主人玩耍', '台北', '2021-07-12', ''),
(12, '小黑', '台灣土狗', 'male', '成年', '犬科', '對陌生人警戒性很高', '台北', '2021-08-03', ''),
(13, '小熊', '拉布拉多', 'female', '成年', '犬科', '忠誠', '宜蘭', '2021-07-04', ''),
(14, '小屁', '美國短毛', 'male', '幼年', '貓科', '放屁超臭', '台南', '2021-08-05', ''),
(15, 'poki', '哈士奇', 'female', '成年', '犬科', '很愛笑', '台中', '2021-08-03', ''),
(16, '樂高', '布偶貓', 'female', '成年', '貓科', '愛咬樂高積木', '台中', '2021-08-15', ''),
(17, '小不點', '蘇格蘭摺耳貓', 'female', '成年', '貓科', '超乖巧', '台中', '2021-08-14', ''),
(19, '黑炭', '台灣土狗', 'male', '成年', '犬科', '毛皮黝黑', '宜蘭', '2021-08-05', ''),
(20, 'Blue123', '米克斯', 'male', '幼年', '貓科', '孤僻躲在角落', '桃園', '2021-08-04', NULL),
(42, '小柴', '柴犬', 'female', '幼年', '犬科', '是個可愛乖巧的女孩～個性有些害羞膽小，但是還是會想要撒嬌想要人摸摸～希望能夠在牠有生之年遇到一個愛牠的主人，從來沒有溫暖的窩可以安穩的睡，牠沒做錯什麼事，為什麼找不到愛牠的人？希望牠能夠遇到一個能接納牠並且能愛著牠的家～這個家～會不會是個遙遠的夢？要是你（妳）看見了牠～你（妳）會心疼牠～愛永遠都存在，我相信這麼乖巧的孩子會等到你妳來愛牠的！給牠一個家！', '新北', '2021-08-19', 'b0b2e764a7f5cfd1559f908ff32e71423aefe95f.jpg'),
(43, '黑烏烏', '台灣土狗', 'female', '幼年', '犬科', '除了撒嬌親人，水汪汪的大眼、黑到反金的毛、還有小電臀，都是牠獨一無二的特色，常常在看到純真好奇的可愛模樣後，前一天的壞心情都一掃而空！熱情的就是我們的開心果！此外，食慾很好，喜歡出去散步，也很喜歡我們和牠玩，非常適合當人們的陪伴犬喔！這麼乖巧可愛的，在等一個可以給牠一輩子承諾、愛牠的主人', '台北', '2021-08-19', '06e0bb5e3fd8849d34acd7b2fc5f3087745ea6cf.jpg'),
(77, '洞洞3', '台灣土狗', 'male', '成年', '犬科', '洞洞因為小時候的遭遇，對周遭環境會比較敏感一點，對陌生人也會比較緊張，也不太習慣身邊人太多，不過只要跟牠相處一段時間，讓牠認為這個環境是安全的，洞洞也可以很自在地被撫摸，也會輕輕地舔人的手！  ', '新北', '2021-08-21', 'b0693858a5fc29272e672f1c6ca109ca2db1abca.jpg'),
(79, '傑森', '米克斯', 'male', '幼年', '貓科', '他是一位很黏人很有正義感的小公貓7哥月大了，我們全家都很愛他，但是因為我們家已經有一之14歲的老公貓，本來是要養來陪伴，但老公貓非常排斥，甚至開始出現占地盤的狀況，健康狀況每況愈下，我爸媽迫於無奈，只能先安排傑森送養了，這真的是不得已的情況。\r\n他的身體非常健康，我們把他養的白白壯壯的，希望有愛心的新家人也可以像我們這樣愛他', '台北', '2021-08-21', '5929b9ee05abd3f124b4c3ed743a73cbff9c12c9.jpg'),
(80, '短短', '米克斯', 'female', '成年', '貓科', '中途後留下來當自己的家人照顧著也四年，但因為個人因素希望能找到愛他並且給予更好環境的主子，在家時間少很難照顧周全並且自己經濟狀況也每況愈下，只能忍痛找收養人，', '台北', '2021-08-21', '4b8e7e06158a21599cd1480a04ec9d352148feea.jpg');

--
-- 已傾印資料表的索引
--

--
-- 資料表索引 `adopted`
--
ALTER TABLE `adopted`
  ADD PRIMARY KEY (`sid`);

--
-- 在傾印的資料表使用自動遞增(AUTO_INCREMENT)
--

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `adopted`
--
ALTER TABLE `adopted`
  MODIFY `sid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=91;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
