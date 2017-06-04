-- phpMyAdmin SQL Dump
-- version 4.6.6
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: 2017-06-01 03:03:07
-- 服务器版本： 5.7.17-0ubuntu0.16.04.1
-- PHP Version: 7.1.1-1+deb.sury.org~xenial+1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mall_test`
--

-- --------------------------------------------------------

--
-- 表的结构 `mall_address`
--

CREATE TABLE `mall_address` (
  `addressid` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(32) NOT NULL DEFAULT '',
  `company` varchar(100) NOT NULL DEFAULT '',
  `address` text,
  `postcode` char(6) NOT NULL DEFAULT '',
  `email` varchar(100) NOT NULL DEFAULT '',
  `telephone` varchar(20) NOT NULL DEFAULT '',
  `userid` bigint(20) UNSIGNED NOT NULL DEFAULT '0',
  `createtime` int(10) UNSIGNED NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `mall_address`
--

INSERT INTO `mall_address` (`addressid`, `name`, `company`, `address`, `postcode`, `email`, `telephone`, `userid`, `createtime`) VALUES
(1, 'bokie', '', '辽宁省大连市学府大街10号大连大学', '', '', '18612345678', 5, 0),
(2, 'yyy', '', '辽宁省大连市开发区学府大街', '', '', '18512345678', 5, 0);

-- --------------------------------------------------------

--
-- 表的结构 `mall_admin`
--

CREATE TABLE `mall_admin` (
  `adminid` int(10) UNSIGNED NOT NULL,
  `adminuser` varchar(32) NOT NULL DEFAULT '',
  `adminpass` char(32) NOT NULL DEFAULT '',
  `adminemail` varchar(50) NOT NULL DEFAULT '',
  `logintime` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `loginip` bigint(20) NOT NULL DEFAULT '0',
  `createtime` int(10) UNSIGNED NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `mall_admin`
--

INSERT INTO `mall_admin` (`adminid`, `adminuser`, `adminpass`, `adminemail`, `logintime`, `loginip`, `createtime`) VALUES
(1, 'admin', '202cb962ac59075b964b07152d234b70', 'admin@test.com', 1496138355, 3232238081, 1490190332),
(2, 'test', '202cb962ac59075b964b07152d234b70', '', 0, 0, 1490442475),
(3, 'test1', '202cb962ac59075b964b07152d234b70', 'test1@test.com', 0, 0, 0),
(4, 'liki', '202cb962ac59075b964b07152d234b70', 'test2@test.com', 0, 0, 0),
(5, 'test3', '202cb962ac59075b964b07152d234b70', 'test3@test.com', 0, 0, 0),
(6, 'test4', '202cb962ac59075b964b07152d234b70', 'test4@test.com', 0, 0, 0),
(7, 'test5', '202cb962ac59075b964b07152d234b70', 'test5@test.com', 0, 0, 0),
(8, 'test6', '202cb962ac59075b964b07152d234b70', 'test6@test.com', 0, 0, 0),
(9, 'test7', '202cb962ac59075b964b07152d234b70', 'test7@test.com', 0, 0, 0),
(10, 'test8', '202cb962ac59075b964b07152d234b70', 'test8@test.com', 0, 0, 0),
(11, 'test10', '202cb962ac59075b964b07152d234b70', 'test10@test.com', 0, 0, 0);

-- --------------------------------------------------------

--
-- 表的结构 `mall_cart`
--

CREATE TABLE `mall_cart` (
  `cartid` bigint(20) UNSIGNED NOT NULL,
  `productid` bigint(20) UNSIGNED NOT NULL DEFAULT '0',
  `productnum` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `price` decimal(10,2) NOT NULL DEFAULT '0.00',
  `userid` bigint(20) UNSIGNED NOT NULL DEFAULT '0',
  `createtime` int(10) UNSIGNED NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `mall_cart`
--

INSERT INTO `mall_cart` (`cartid`, `productid`, `productnum`, `price`, `userid`, `createtime`) VALUES
(1, 7, 2, '156.00', 5, 1495702136),
(2, 8, 1, '39.00', 5, 1496285942),
(3, 19, 1, '29.00', 5, 1496285970);

-- --------------------------------------------------------

--
-- 表的结构 `mall_category`
--

CREATE TABLE `mall_category` (
  `cateid` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(32) NOT NULL DEFAULT '',
  `parentid` bigint(20) UNSIGNED NOT NULL DEFAULT '0',
  `createtime` int(10) UNSIGNED NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `mall_category`
--

INSERT INTO `mall_category` (`cateid`, `title`, `parentid`, `createtime`) VALUES
(13, '喂养', 0, 1493881156),
(14, '日用', 0, 1493881165),
(15, '洗护', 0, 1493881172),
(16, '穿着', 0, 1493881179),
(17, '寝居', 0, 1493881184),
(18, '玩具', 0, 1493881188);

-- --------------------------------------------------------

--
-- 表的结构 `mall_comment`
--

CREATE TABLE `mall_comment` (
  `commentid` bigint(20) UNSIGNED NOT NULL,
  `productid` bigint(20) UNSIGNED NOT NULL DEFAULT '0',
  `content` text NOT NULL,
  `userid` bigint(20) UNSIGNED NOT NULL DEFAULT '0',
  `createtime` int(10) UNSIGNED NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `mall_comment`
--

INSERT INTO `mall_comment` (`commentid`, `productid`, `content`, `userid`, `createtime`) VALUES
(1, 7, 'dd', 5, 1495946354),
(2, 7, '诶哟，不错哦', 5, 1495946385);

-- --------------------------------------------------------

--
-- 表的结构 `mall_order`
--

CREATE TABLE `mall_order` (
  `orderid` bigint(20) UNSIGNED NOT NULL,
  `userid` bigint(20) UNSIGNED NOT NULL DEFAULT '0',
  `addressid` bigint(20) UNSIGNED NOT NULL DEFAULT '0',
  `amount` decimal(10,2) NOT NULL DEFAULT '0.00',
  `status` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `expressid` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `expressno` varchar(50) NOT NULL DEFAULT '0',
  `createtime` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `updatetime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `mall_order`
--

INSERT INTO `mall_order` (`orderid`, `userid`, `addressid`, `amount`, `status`, `expressid`, `expressno`, `createtime`, `updatetime`) VALUES
(1, 5, 1, '1716.00', 260, 0, '12365466546468', 1494053531, '2017-05-25 10:51:59'),
(2, 5, 1, '156.00', 220, 0, '123456789999787', 1494168666, '2017-05-25 10:19:39'),
(3, 5, 1, '468.00', 100, 0, '0', 1495189436, '2017-05-25 07:16:36'),
(4, 5, 1, '156.00', 202, 0, '0', 1495611130, '2017-05-25 10:17:46');

-- --------------------------------------------------------

--
-- 表的结构 `mall_order_detail`
--

CREATE TABLE `mall_order_detail` (
  `detailid` bigint(20) UNSIGNED NOT NULL,
  `productid` bigint(20) UNSIGNED NOT NULL DEFAULT '0',
  `price` decimal(10,2) NOT NULL DEFAULT '0.00',
  `productnum` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `orderid` bigint(20) UNSIGNED NOT NULL DEFAULT '0',
  `createtime` int(10) UNSIGNED NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `mall_order_detail`
--

INSERT INTO `mall_order_detail` (`detailid`, `productid`, `price`, `productnum`, `orderid`, `createtime`) VALUES
(1, 7, '156.00', 11, 1, 1494053531),
(2, 7, '156.00', 1, 2, 1494168666),
(3, 7, '156.00', 3, 3, 1495189437),
(4, 7, '156.00', 1, 4, 1495611130);

-- --------------------------------------------------------

--
-- 表的结构 `mall_product`
--

CREATE TABLE `mall_product` (
  `productid` bigint(20) UNSIGNED NOT NULL,
  `cateid` bigint(20) UNSIGNED NOT NULL DEFAULT '0',
  `title` varchar(200) NOT NULL DEFAULT '',
  `descr` text,
  `detail` text,
  `num` bigint(20) UNSIGNED NOT NULL DEFAULT '0',
  `price` decimal(10,2) NOT NULL DEFAULT '0.00',
  `cover` varchar(200) NOT NULL DEFAULT '',
  `pics` text,
  `isreco` enum('0','1') NOT NULL DEFAULT '1',
  `ison` enum('0','1') NOT NULL DEFAULT '1',
  `issale` enum('0','1') NOT NULL DEFAULT '0',
  `saleprice` decimal(10,2) NOT NULL DEFAULT '0.00',
  `createtime` int(10) UNSIGNED NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `mall_product`
--

INSERT INTO `mall_product` (`productid`, `cateid`, `title`, `descr`, `detail`, `num`, `price`, `cover`, `pics`, `isreco`, `ison`, `issale`, `saleprice`, `createtime`) VALUES
(7, 16, '格纹棉质褶皱娃娃裙', '彼得潘领 内搭短裤', '彼得潘领 内搭短裤<br><ul><li>彼得潘领 内搭短裤</li></ul><b>彼得潘领 内搭短裤</b><br><br><br>', 4, '156.00', 'http://onu36t5vy.bkt.clouddn.com/592d53a95904e', '{\"592d53aa48d61\":\"http:\\/\\/onu36t5vy.bkt.clouddn.com\\/592d53aa48d61\",\"592d53aab4252\":\"http:\\/\\/onu36t5vy.bkt.clouddn.com\\/592d53aab4252\",\"592d53ab2bec3\":\"http:\\/\\/onu36t5vy.bkt.clouddn.com\\/592d53ab2bec3\",\"592d53ac8bb90\":\"http:\\/\\/onu36t5vy.bkt.clouddn.com\\/592d53ac8bb90\",\"592d53ad7e33b\":\"http:\\/\\/onu36t5vy.bkt.clouddn.com\\/592d53ad7e33b\"}', '0', '1', '0', '156.00', 0),
(8, 16, '白色素雅短袖T恤（男婴童）', '格纹贴袋，A类无荧光', '格纹贴袋，A类无荧光<br>', 20, '39.00', 'http://onu36t5vy.bkt.clouddn.com/592d42d433dd5', '{\"592d42d56e59a\":\"http:\\/\\/onu36t5vy.bkt.clouddn.com\\/592d42d56e59a\",\"592d42d71b89d\":\"http:\\/\\/onu36t5vy.bkt.clouddn.com\\/592d42d71b89d\",\"592d42d912a9a\":\"http:\\/\\/onu36t5vy.bkt.clouddn.com\\/592d42d912a9a\",\"592d42db0db18\":\"http:\\/\\/onu36t5vy.bkt.clouddn.com\\/592d42db0db18\",\"592d42dd358b4\":\"http:\\/\\/onu36t5vy.bkt.clouddn.com\\/592d42dd358b4\"}', '1', '1', '0', '39.00', 0),
(9, 16, '格纹棉质短袖衬衫（婴童）', '经典格纹风 时尚又百搭', '经典格纹风 时尚又百搭<br>', 20, '99.00', 'http://onu36t5vy.bkt.clouddn.com/592d436123a9c', '{\"592d4374ef756\":\"http:\\/\\/onu36t5vy.bkt.clouddn.com\\/592d4374ef756\",\"592d437c37c9a\":\"http:\\/\\/onu36t5vy.bkt.clouddn.com\\/592d437c37c9a\",\"592d43844fb51\":\"http:\\/\\/onu36t5vy.bkt.clouddn.com\\/592d43844fb51\",\"592d438744f6d\":\"http:\\/\\/onu36t5vy.bkt.clouddn.com\\/592d438744f6d\",\"592d438b3ce38\":\"http:\\/\\/onu36t5vy.bkt.clouddn.com\\/592d438b3ce38\"}', '0', '1', '0', '99.00', 0),
(10, 16, '小绅士直筒五分裤（男婴童）', '休闲西装裤 A类无荧光', '休闲西装裤 A类无荧光<br>', 20, '69.00', 'http://onu36t5vy.bkt.clouddn.com/592d44173d70f', '{\"592d44199cdb0\":\"http:\\/\\/onu36t5vy.bkt.clouddn.com\\/592d44199cdb0\",\"592d441d124ab\":\"http:\\/\\/onu36t5vy.bkt.clouddn.com\\/592d441d124ab\",\"592d4420c5aab\":\"http:\\/\\/onu36t5vy.bkt.clouddn.com\\/592d4420c5aab\",\"592d442402723\":\"http:\\/\\/onu36t5vy.bkt.clouddn.com\\/592d442402723\",\"592d4427d0ec8\":\"http:\\/\\/onu36t5vy.bkt.clouddn.com\\/592d4427d0ec8\"}', '0', '1', '0', '69.00', 0),
(11, 16, '经典海魂纹水手裙（女婴童）', '自由海军领 探索未来梦', '自由海军领 探索未来梦<br>', 20, '69.00', 'http://onu36t5vy.bkt.clouddn.com/592d4482016d9', '{\"592d44832afb1\":\"http:\\/\\/onu36t5vy.bkt.clouddn.com\\/592d44832afb1\",\"592d4485b7b16\":\"http:\\/\\/onu36t5vy.bkt.clouddn.com\\/592d4485b7b16\",\"592d448840b96\":\"http:\\/\\/onu36t5vy.bkt.clouddn.com\\/592d448840b96\",\"592d448b0bc8f\":\"http:\\/\\/onu36t5vy.bkt.clouddn.com\\/592d448b0bc8f\",\"592d448dac848\":\"http:\\/\\/onu36t5vy.bkt.clouddn.com\\/592d448dac848\"}', '0', '1', '0', '69.00', 0),
(12, 16, '海魂纹长袖三角哈衣', '经典海魂纹 三角包屁衣', '经典海魂纹 三角包屁衣<br>', 20, '59.00', 'http://onu36t5vy.bkt.clouddn.com/592d44e3f02fb', '{\"592d44e4dd34b\":\"http:\\/\\/onu36t5vy.bkt.clouddn.com\\/592d44e4dd34b\",\"592d44e6c4cac\":\"http:\\/\\/onu36t5vy.bkt.clouddn.com\\/592d44e6c4cac\",\"592d44e8dc262\":\"http:\\/\\/onu36t5vy.bkt.clouddn.com\\/592d44e8dc262\",\"592d44eaa8aa3\":\"http:\\/\\/onu36t5vy.bkt.clouddn.com\\/592d44eaa8aa3\",\"592d44ecd6f04\":\"http:\\/\\/onu36t5vy.bkt.clouddn.com\\/592d44ecd6f04\"}', '0', '1', '0', '59.00', 0),
(13, 16, '条纹长袖海魂衫（女婴童）', '纯棉亲肤娃娃衫', '纯棉亲肤娃娃衫<br>', 20, '79.00', 'http://onu36t5vy.bkt.clouddn.com/592d454b228eb', '{\"592d454c5e854\":\"http:\\/\\/onu36t5vy.bkt.clouddn.com\\/592d454c5e854\",\"592d454ed7889\":\"http:\\/\\/onu36t5vy.bkt.clouddn.com\\/592d454ed7889\",\"592d45511188f\":\"http:\\/\\/onu36t5vy.bkt.clouddn.com\\/592d45511188f\",\"592d4553dbad1\":\"http:\\/\\/onu36t5vy.bkt.clouddn.com\\/592d4553dbad1\",\"592d4555eef16\":\"http:\\/\\/onu36t5vy.bkt.clouddn.com\\/592d4555eef16\"}', '0', '1', '0', '79.00', 0),
(14, 16, '格纹棉质衬衫', '法式翻领 气质格纹', '法式翻领 气质格纹<br>', 20, '99.00', 'http://onu36t5vy.bkt.clouddn.com/592d45aab0b9b', '{\"592d45ac45842\":\"http:\\/\\/onu36t5vy.bkt.clouddn.com\\/592d45ac45842\",\"592d45b0a0651\":\"http:\\/\\/onu36t5vy.bkt.clouddn.com\\/592d45b0a0651\",\"592d45b37db93\":\"http:\\/\\/onu36t5vy.bkt.clouddn.com\\/592d45b37db93\",\"592d45b63b033\":\"http:\\/\\/onu36t5vy.bkt.clouddn.com\\/592d45b63b033\",\"592d45b9039af\":\"http:\\/\\/onu36t5vy.bkt.clouddn.com\\/592d45b9039af\"}', '0', '1', '0', '99.00', 0),
(15, 16, '格纹内衬棉质休闲裤', '双面可穿 不易褪色', '双面可穿 不易褪色<br>', 20, '119.00', 'http://onu36t5vy.bkt.clouddn.com/592d460c2c181', '{\"592d460d17602\":\"http:\\/\\/onu36t5vy.bkt.clouddn.com\\/592d460d17602\",\"592d460f480f0\":\"http:\\/\\/onu36t5vy.bkt.clouddn.com\\/592d460f480f0\",\"592d461179cc0\":\"http:\\/\\/onu36t5vy.bkt.clouddn.com\\/592d461179cc0\",\"592d4613a9cd7\":\"http:\\/\\/onu36t5vy.bkt.clouddn.com\\/592d4613a9cd7\",\"592d4615bf425\":\"http:\\/\\/onu36t5vy.bkt.clouddn.com\\/592d4615bf425\"}', '1', '1', '0', '119.00', 0),
(16, 16, '毛毛虫大童运动鞋', '尺码偏大，建议拍小一码', '尺码偏大，建议拍小一码<br>', 20, '129.00', 'http://onu36t5vy.bkt.clouddn.com/592d46c0e7b34', '{\"592d46c2679fa\":\"http:\\/\\/onu36t5vy.bkt.clouddn.com\\/592d46c2679fa\",\"592d46ca7e69c\":\"http:\\/\\/onu36t5vy.bkt.clouddn.com\\/592d46ca7e69c\",\"592d46cc35d72\":\"http:\\/\\/onu36t5vy.bkt.clouddn.com\\/592d46cc35d72\",\"592d46ce9a1c3\":\"http:\\/\\/onu36t5vy.bkt.clouddn.com\\/592d46ce9a1c3\",\"592d46d15be2f\":\"http:\\/\\/onu36t5vy.bkt.clouddn.com\\/592d46d15be2f\"}', '0', '1', '0', '129.00', 0),
(17, 13, '小水滴喂养礼盒套组', '以爱回馈 诚挚甄选', '以爱回馈 诚挚甄选<br>', 20, '109.00', 'http://onu36t5vy.bkt.clouddn.com/592d4781e27f0', '{\"592d4783dbc7a\":\"http:\\/\\/onu36t5vy.bkt.clouddn.com\\/592d4783dbc7a\",\"592d478a57271\":\"http:\\/\\/onu36t5vy.bkt.clouddn.com\\/592d478a57271\",\"592d47903f493\":\"http:\\/\\/onu36t5vy.bkt.clouddn.com\\/592d47903f493\",\"592d479ead280\":\"http:\\/\\/onu36t5vy.bkt.clouddn.com\\/592d479ead280\",\"592d47c3aeb4a\":\"http:\\/\\/onu36t5vy.bkt.clouddn.com\\/592d47c3aeb4a\"}', '0', '1', '0', '109.00', 0),
(18, 13, '冰淇淋咬咬水杯', '咬着喝水，训练牙床成长', '咬着喝水，训练牙床成长<br>', 20, '39.00', 'http://onu36t5vy.bkt.clouddn.com/592d485462432', '{\"592d4855274f7\":\"http:\\/\\/onu36t5vy.bkt.clouddn.com\\/592d4855274f7\",\"592d48561a3c1\":\"http:\\/\\/onu36t5vy.bkt.clouddn.com\\/592d48561a3c1\",\"592d4857f0bdf\":\"http:\\/\\/onu36t5vy.bkt.clouddn.com\\/592d4857f0bdf\",\"592d4858b1b1e\":\"http:\\/\\/onu36t5vy.bkt.clouddn.com\\/592d4858b1b1e\",\"592d485ab9b18\":\"http:\\/\\/onu36t5vy.bkt.clouddn.com\\/592d485ab9b18\"}', '1', '1', '0', '39.00', 0),
(19, 13, '打不翻的吸盘碗', '稳固性吸盘，饭碗不打翻', '稳固性吸盘，饭碗不打翻<br>', 20, '29.00', 'http://onu36t5vy.bkt.clouddn.com/592d4898cb40e', '{\"592d489980092\":\"http:\\/\\/onu36t5vy.bkt.clouddn.com\\/592d489980092\",\"592d489a99f99\":\"http:\\/\\/onu36t5vy.bkt.clouddn.com\\/592d489a99f99\",\"592d489c1b459\":\"http:\\/\\/onu36t5vy.bkt.clouddn.com\\/592d489c1b459\",\"592d489d89fcb\":\"http:\\/\\/onu36t5vy.bkt.clouddn.com\\/592d489d89fcb\",\"592d489f8221d\":\"http:\\/\\/onu36t5vy.bkt.clouddn.com\\/592d489f8221d\"}', '0', '1', '0', '29.00', 0),
(20, 13, '2只装 宝宝食饭套碗组合', '一菜一汤，双碗吃大餐', '一菜一汤，双碗吃大餐<br>', 20, '39.00', 'http://onu36t5vy.bkt.clouddn.com/592d48f059b49', '{\"592d48f0cf2fe\":\"http:\\/\\/onu36t5vy.bkt.clouddn.com\\/592d48f0cf2fe\",\"592d48f282172\":\"http:\\/\\/onu36t5vy.bkt.clouddn.com\\/592d48f282172\",\"592d48f46ee6e\":\"http:\\/\\/onu36t5vy.bkt.clouddn.com\\/592d48f46ee6e\",\"592d48f6b28aa\":\"http:\\/\\/onu36t5vy.bkt.clouddn.com\\/592d48f6b28aa\",\"592d48f85937a\":\"http:\\/\\/onu36t5vy.bkt.clouddn.com\\/592d48f85937a\"}', '1', '1', '0', '39.00', 0),
(21, 13, ' 不锈钢叉勺便携套装', '304不锈钢，美国ASTM标准', '304不锈钢，美国ASTM标准<br>', 20, '29.00', 'http://onu36t5vy.bkt.clouddn.com/592d493570454', '{\"592d493614667\":\"http:\\/\\/onu36t5vy.bkt.clouddn.com\\/592d493614667\",\"592d4936911bc\":\"http:\\/\\/onu36t5vy.bkt.clouddn.com\\/592d4936911bc\",\"592d49379aa89\":\"http:\\/\\/onu36t5vy.bkt.clouddn.com\\/592d49379aa89\",\"592d49391d9aa\":\"http:\\/\\/onu36t5vy.bkt.clouddn.com\\/592d49391d9aa\",\"592d493a31f37\":\"http:\\/\\/onu36t5vy.bkt.clouddn.com\\/592d493a31f37\"}', '0', '1', '0', '29.00', 0),
(22, 13, '三格分装零食碗', '韩国进口材质，可装三种零食', '韩国进口材质，可装三种零食<br>', 20, '19.00', 'http://onu36t5vy.bkt.clouddn.com/592d4987cfd73', '{\"592d49885f127\":\"http:\\/\\/onu36t5vy.bkt.clouddn.com\\/592d49885f127\",\"592d4988d61db\":\"http:\\/\\/onu36t5vy.bkt.clouddn.com\\/592d4988d61db\",\"592d498a55408\":\"http:\\/\\/onu36t5vy.bkt.clouddn.com\\/592d498a55408\",\"592d498b70b33\":\"http:\\/\\/onu36t5vy.bkt.clouddn.com\\/592d498b70b33\",\"592d498d08e23\":\"http:\\/\\/onu36t5vy.bkt.clouddn.com\\/592d498d08e23\"}', '0', '1', '0', '19.00', 0),
(23, 13, '小蛙多层奶粉盒', '3层自由组，180g超大容量', '3层自由组，180g超大容量<br>', 20, '29.00', 'http://onu36t5vy.bkt.clouddn.com/592d49de82ab1', '{\"592d49df2be6c\":\"http:\\/\\/onu36t5vy.bkt.clouddn.com\\/592d49df2be6c\",\"592d49e012ba5\":\"http:\\/\\/onu36t5vy.bkt.clouddn.com\\/592d49e012ba5\",\"592d49e18a156\":\"http:\\/\\/onu36t5vy.bkt.clouddn.com\\/592d49e18a156\",\"592d49e2c4df9\":\"http:\\/\\/onu36t5vy.bkt.clouddn.com\\/592d49e2c4df9\",\"592d49e4c11d5\":\"http:\\/\\/onu36t5vy.bkt.clouddn.com\\/592d49e4c11d5\"}', '0', '1', '0', '29.00', 0),
(24, 13, '2支装 果冻色感温小勺', '5秒感温，40℃变色', '5秒感温，40℃变色<br>', 20, '19.00', 'http://onu36t5vy.bkt.clouddn.com/592d4a2cccba9', '{\"592d4a2d5d229\":\"http:\\/\\/onu36t5vy.bkt.clouddn.com\\/592d4a2d5d229\",\"592d4a2dbb38e\":\"http:\\/\\/onu36t5vy.bkt.clouddn.com\\/592d4a2dbb38e\",\"592d4a2e3b261\":\"http:\\/\\/onu36t5vy.bkt.clouddn.com\\/592d4a2e3b261\",\"592d4a2e9605f\":\"http:\\/\\/onu36t5vy.bkt.clouddn.com\\/592d4a2e9605f\",\"592d4a2eee18f\":\"http:\\/\\/onu36t5vy.bkt.clouddn.com\\/592d4a2eee18f\"}', '0', '1', '0', '19.00', 0),
(25, 15, ' 婴幼儿手口湿巾80片家庭装', '加厚材质 满分呵护', '加厚材质 满分呵护<br>', 20, '9.90', 'http://onu36t5vy.bkt.clouddn.com/592d4bd27238e', '{\"592d4bd343949\":\"http:\\/\\/onu36t5vy.bkt.clouddn.com\\/592d4bd343949\",\"592d4bd5a8e63\":\"http:\\/\\/onu36t5vy.bkt.clouddn.com\\/592d4bd5a8e63\",\"592d4bd76fa36\":\"http:\\/\\/onu36t5vy.bkt.clouddn.com\\/592d4bd76fa36\",\"592d4bd992414\":\"http:\\/\\/onu36t5vy.bkt.clouddn.com\\/592d4bd992414\",\"592d4bdbc88e5\":\"http:\\/\\/onu36t5vy.bkt.clouddn.com\\/592d4bdbc88e5\"}', '1', '1', '0', '9.90', 0),
(26, 15, ' 6件装 80片婴儿全棉湿巾特惠装', 'EDI纯水，进口美棉', 'EDI纯水，进口美棉<br>', 20, '99.00', 'http://onu36t5vy.bkt.clouddn.com/592d4c259cb94', '{\"592d4c264409c\":\"http:\\/\\/onu36t5vy.bkt.clouddn.com\\/592d4c264409c\",\"592d4c2793d8f\":\"http:\\/\\/onu36t5vy.bkt.clouddn.com\\/592d4c2793d8f\",\"592d4c293040c\":\"http:\\/\\/onu36t5vy.bkt.clouddn.com\\/592d4c293040c\",\"592d4c2aa854a\":\"http:\\/\\/onu36t5vy.bkt.clouddn.com\\/592d4c2aa854a\",\"592d4c2c8c94d\":\"http:\\/\\/onu36t5vy.bkt.clouddn.com\\/592d4c2c8c94d\"}', '0', '1', '0', '99.00', 0),
(27, 15, ' 10件装 20片婴幼儿全棉湿巾', '出门随身装，即抽即用', '出门随身装，即抽即用<br>', 20, '69.00', 'http://onu36t5vy.bkt.clouddn.com/592d4ca6de86a', '{\"592d4ca777496\":\"http:\\/\\/onu36t5vy.bkt.clouddn.com\\/592d4ca777496\",\"592d4ca7e162a\":\"http:\\/\\/onu36t5vy.bkt.clouddn.com\\/592d4ca7e162a\",\"592d4ca84443c\":\"http:\\/\\/onu36t5vy.bkt.clouddn.com\\/592d4ca84443c\",\"592d4ca89d92c\":\"http:\\/\\/onu36t5vy.bkt.clouddn.com\\/592d4ca89d92c\",\"592d4ca978988\":\"http:\\/\\/onu36t5vy.bkt.clouddn.com\\/592d4ca978988\"}', '0', '1', '0', '69.00', 0),
(28, 15, ' 婴儿两用棉棒', '无荧光，双头多用', '无荧光，双头多用<br>', 20, '9.90', 'http://onu36t5vy.bkt.clouddn.com/592d4d1222a88', '{\"592d4d1382170\":\"http:\\/\\/onu36t5vy.bkt.clouddn.com\\/592d4d1382170\",\"592d4d156e662\":\"http:\\/\\/onu36t5vy.bkt.clouddn.com\\/592d4d156e662\",\"592d4d175ae7d\":\"http:\\/\\/onu36t5vy.bkt.clouddn.com\\/592d4d175ae7d\",\"592d4d1987195\":\"http:\\/\\/onu36t5vy.bkt.clouddn.com\\/592d4d1987195\",\"592d4d1be12b2\":\"http:\\/\\/onu36t5vy.bkt.clouddn.com\\/592d4d1be12b2\"}', '1', '1', '0', '9.90', 0),
(29, 15, ' 儿童3D纳米薄膜口罩3只装', '99%滤霾，0.23mm轻透', '99%滤霾，0.23mm轻透<br>', 20, '19.90', 'http://onu36t5vy.bkt.clouddn.com/592d4d68789e9', '{\"592d4d68d7d20\":\"http:\\/\\/onu36t5vy.bkt.clouddn.com\\/592d4d68d7d20\",\"592d4d69471c8\":\"http:\\/\\/onu36t5vy.bkt.clouddn.com\\/592d4d69471c8\",\"592d4d6a185a2\":\"http:\\/\\/onu36t5vy.bkt.clouddn.com\\/592d4d6a185a2\",\"592d4d6b0727c\":\"http:\\/\\/onu36t5vy.bkt.clouddn.com\\/592d4d6b0727c\",\"592d4d6be6b50\":\"http:\\/\\/onu36t5vy.bkt.clouddn.com\\/592d4d6be6b50\"}', '0', '1', '0', '19.90', 0),
(30, 15, ' 儿童脸盆', '耐热抗摔，磨砂质感', '耐热抗摔，磨砂质感<br>', 20, '12.90', 'http://onu36t5vy.bkt.clouddn.com/592d4e02d7784', '{\"592d4e0346147\":\"http:\\/\\/onu36t5vy.bkt.clouddn.com\\/592d4e0346147\",\"592d4e0450607\":\"http:\\/\\/onu36t5vy.bkt.clouddn.com\\/592d4e0450607\",\"592d4e05d9080\":\"http:\\/\\/onu36t5vy.bkt.clouddn.com\\/592d4e05d9080\",\"592d4e076311a\":\"http:\\/\\/onu36t5vy.bkt.clouddn.com\\/592d4e076311a\",\"592d4e08bb4f9\":\"http:\\/\\/onu36t5vy.bkt.clouddn.com\\/592d4e08bb4f9\"}', '0', '1', '0', '12.90', 0),
(31, 15, ' 粉嫩嫩的感温浴盆', '20°卧躺，可感温的浴盆', '20°卧躺，可感温的浴盆<br>', 20, '139.00', 'http://onu36t5vy.bkt.clouddn.com/592d4e5e72001', '{\"592d4e5f00474\":\"http:\\/\\/onu36t5vy.bkt.clouddn.com\\/592d4e5f00474\",\"592d4e60b2a4a\":\"http:\\/\\/onu36t5vy.bkt.clouddn.com\\/592d4e60b2a4a\",\"592d4e6288bcd\":\"http:\\/\\/onu36t5vy.bkt.clouddn.com\\/592d4e6288bcd\",\"592d4e6407d2e\":\"http:\\/\\/onu36t5vy.bkt.clouddn.com\\/592d4e6407d2e\",\"592d4e6600194\":\"http:\\/\\/onu36t5vy.bkt.clouddn.com\\/592d4e6600194\"}', '1', '1', '0', '139.00', 0),
(32, 15, ' 儿童多功能坐便器', '安全卫生 守护宝宝健康', '安全卫生 守护宝宝健康<br>', 20, '125.00', 'http://onu36t5vy.bkt.clouddn.com/592d4eb1497e0', '{\"592d4eb21e738\":\"http:\\/\\/onu36t5vy.bkt.clouddn.com\\/592d4eb21e738\",\"592d4eb4231e9\":\"http:\\/\\/onu36t5vy.bkt.clouddn.com\\/592d4eb4231e9\",\"592d4eb621f81\":\"http:\\/\\/onu36t5vy.bkt.clouddn.com\\/592d4eb621f81\",\"592d4eb83c4d8\":\"http:\\/\\/onu36t5vy.bkt.clouddn.com\\/592d4eb83c4d8\",\"592d4eb9eca74\":\"http:\\/\\/onu36t5vy.bkt.clouddn.com\\/592d4eb9eca74\"}', '0', '1', '0', '125.00', 0),
(33, 15, ' 婴儿纯棉柔巾', '无荧光剂，干湿两用', '无荧光剂，干湿两用<br>', 20, '15.00', 'http://onu36t5vy.bkt.clouddn.com/592d4f00c4323', '{\"592d4f01428bb\":\"http:\\/\\/onu36t5vy.bkt.clouddn.com\\/592d4f01428bb\",\"592d4f034354e\":\"http:\\/\\/onu36t5vy.bkt.clouddn.com\\/592d4f034354e\",\"592d4f04e7d86\":\"http:\\/\\/onu36t5vy.bkt.clouddn.com\\/592d4f04e7d86\",\"592d4f0680b8b\":\"http:\\/\\/onu36t5vy.bkt.clouddn.com\\/592d4f0680b8b\",\"592d4f08395a5\":\"http:\\/\\/onu36t5vy.bkt.clouddn.com\\/592d4f08395a5\"}', '0', '1', '0', '15.00', 0),
(34, 17, '日式全棉针织三件套', '亲肤舒适，呵护宝贝的每一寸肌肤', '亲肤舒适，呵护宝贝的每一寸肌肤<br>', 299, '299.00', 'http://onu36t5vy.bkt.clouddn.com/592d4ffdcea9a', '{\"592d4ffe5cc28\":\"http:\\/\\/onu36t5vy.bkt.clouddn.com\\/592d4ffe5cc28\",\"592d4fffafd9b\":\"http:\\/\\/onu36t5vy.bkt.clouddn.com\\/592d4fffafd9b\",\"592d5001a7cbb\":\"http:\\/\\/onu36t5vy.bkt.clouddn.com\\/592d5001a7cbb\",\"592d50047ace7\":\"http:\\/\\/onu36t5vy.bkt.clouddn.com\\/592d50047ace7\",\"592d50066d015\":\"http:\\/\\/onu36t5vy.bkt.clouddn.com\\/592d50066d015\"}', '0', '1', '0', '299.00', 0),
(35, 17, ' 300根全棉儿童火烈鸟三件套', '纯棉材质，呵护宝宝的每一寸肌肤', '纯棉材质，呵护宝宝的每一寸肌肤<br>', 20, '399.00', 'http://onu36t5vy.bkt.clouddn.com/592d50779d7e9', '{\"592d5079dcb5e\":\"http:\\/\\/onu36t5vy.bkt.clouddn.com\\/592d5079dcb5e\",\"592d507d241d4\":\"http:\\/\\/onu36t5vy.bkt.clouddn.com\\/592d507d241d4\",\"592d50802456e\":\"http:\\/\\/onu36t5vy.bkt.clouddn.com\\/592d50802456e\",\"592d50837199c\":\"http:\\/\\/onu36t5vy.bkt.clouddn.com\\/592d50837199c\",\"592d508677384\":\"http:\\/\\/onu36t5vy.bkt.clouddn.com\\/592d508677384\"}', '0', '1', '0', '399.00', 0),
(36, 18, '儿童海洋球池', '每套赠送25个海洋球', '每套赠送25个海洋球<br>', 20, '89.00', 'http://onu36t5vy.bkt.clouddn.com/592d50e32a106', '{\"592d50e716660\":\"http:\\/\\/onu36t5vy.bkt.clouddn.com\\/592d50e716660\",\"592d50eb3512f\":\"http:\\/\\/onu36t5vy.bkt.clouddn.com\\/592d50eb3512f\",\"592d50efa6ca8\":\"http:\\/\\/onu36t5vy.bkt.clouddn.com\\/592d50efa6ca8\",\"592d50f44951a\":\"http:\\/\\/onu36t5vy.bkt.clouddn.com\\/592d50f44951a\",\"592d50f8944f3\":\"http:\\/\\/onu36t5vy.bkt.clouddn.com\\/592d50f8944f3\"}', '0', '1', '0', '89.00', 0),
(37, 18, '周日动物园主题爬行垫', '2cm厚度减震，回字格防滑', '2cm厚度减震，回字格防滑<br>', 20, '299.00', 'http://onu36t5vy.bkt.clouddn.com/592d51530d40a', '{\"592d51554c3e3\":\"http:\\/\\/onu36t5vy.bkt.clouddn.com\\/592d51554c3e3\",\"592d5158488a4\":\"http:\\/\\/onu36t5vy.bkt.clouddn.com\\/592d5158488a4\",\"592d515bd7231\":\"http:\\/\\/onu36t5vy.bkt.clouddn.com\\/592d515bd7231\",\"592d515f49195\":\"http:\\/\\/onu36t5vy.bkt.clouddn.com\\/592d515f49195\",\"592d5162be18d\":\"http:\\/\\/onu36t5vy.bkt.clouddn.com\\/592d5162be18d\"}', '0', '1', '0', '299.00', 0),
(38, 14, ' 儿童撞色轻便背包', '0.16KG，一个苹果的重量', '0.16KG，一个苹果的重量<br>', 20, '79.00', 'http://onu36t5vy.bkt.clouddn.com/592d5212460cb', '{\"592d521534dc4\":\"http:\\/\\/onu36t5vy.bkt.clouddn.com\\/592d521534dc4\",\"592d52191fbb1\":\"http:\\/\\/onu36t5vy.bkt.clouddn.com\\/592d52191fbb1\",\"592d521ceb2e0\":\"http:\\/\\/onu36t5vy.bkt.clouddn.com\\/592d521ceb2e0\",\"592d5220e6dbe\":\"http:\\/\\/onu36t5vy.bkt.clouddn.com\\/592d5220e6dbe\",\"592d5227e0bae\":\"http:\\/\\/onu36t5vy.bkt.clouddn.com\\/592d5227e0bae\"}', '1', '1', '0', '79.00', 0),
(39, 14, ' 日式儿童雨伞', '开合安全，日本制造标准', '开合安全，日本制造标准<br>', 20, '59.00', 'http://onu36t5vy.bkt.clouddn.com/592d52741bf0b', '{\"592d5274ba026\":\"http:\\/\\/onu36t5vy.bkt.clouddn.com\\/592d5274ba026\",\"592d527653f75\":\"http:\\/\\/onu36t5vy.bkt.clouddn.com\\/592d527653f75\",\"592d5277a285f\":\"http:\\/\\/onu36t5vy.bkt.clouddn.com\\/592d5277a285f\",\"592d527961f38\":\"http:\\/\\/onu36t5vy.bkt.clouddn.com\\/592d527961f38\",\"592d527b0c13a\":\"http:\\/\\/onu36t5vy.bkt.clouddn.com\\/592d527b0c13a\"}', '0', '1', '0', '59.00', 0);

-- --------------------------------------------------------

--
-- 表的结构 `mall_profile`
--

CREATE TABLE `mall_profile` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `truename` varchar(32) NOT NULL DEFAULT '',
  `age` tinyint(3) UNSIGNED NOT NULL DEFAULT '0',
  `sex` enum('0','1','2') NOT NULL DEFAULT '0',
  `birthday` date NOT NULL DEFAULT '2017-01-01',
  `nickname` varchar(32) NOT NULL DEFAULT '',
  `company` varchar(100) NOT NULL DEFAULT '',
  `userid` bigint(20) UNSIGNED NOT NULL DEFAULT '0',
  `createtime` int(10) UNSIGNED NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `mall_test`
--

CREATE TABLE `mall_test` (
  `id` int(10) UNSIGNED NOT NULL,
  `username` varchar(32) NOT NULL DEFAULT '',
  `password` char(32) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `mall_test`
--

INSERT INTO `mall_test` (`id`, `username`, `password`) VALUES
(1, 'mall', '25d55ad283aa400af464c76d713c07ad');

-- --------------------------------------------------------

--
-- 表的结构 `mall_user`
--

CREATE TABLE `mall_user` (
  `userid` bigint(20) UNSIGNED NOT NULL,
  `username` varchar(32) NOT NULL DEFAULT '',
  `userpass` char(32) NOT NULL DEFAULT '',
  `useremail` varchar(100) NOT NULL DEFAULT '',
  `createtime` int(10) UNSIGNED NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `mall_user`
--

INSERT INTO `mall_user` (`userid`, `username`, `userpass`, `useremail`, `createtime`) VALUES
(1, 'test1', 'd41d8cd98f00b204e9800998ecf8427e', 'test1@test.com', 1490706955),
(2, 'test2', '202cb962ac59075b964b07152d234b70', 'test2@test.com', 1490796322),
(3, 'test3', '202cb962ac59075b964b07152d234b70', 'test3@test3.com', 1490880773),
(4, '', 'e10adc3949ba59abbe56e057f20f883e', 'dd@dd.com', 1493884692),
(5, '', '202cb962ac59075b964b07152d234b70', 'test3@test.com', 1493974544);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `mall_address`
--
ALTER TABLE `mall_address`
  ADD PRIMARY KEY (`addressid`),
  ADD KEY `mall_address_userid` (`userid`);

--
-- Indexes for table `mall_admin`
--
ALTER TABLE `mall_admin`
  ADD PRIMARY KEY (`adminid`),
  ADD UNIQUE KEY `shop_admin_adminuser_adminpass` (`adminuser`,`adminpass`),
  ADD UNIQUE KEY `shop_admin_adminuser_adminemail` (`adminuser`,`adminemail`);

--
-- Indexes for table `mall_cart`
--
ALTER TABLE `mall_cart`
  ADD PRIMARY KEY (`cartid`),
  ADD KEY `mall_cart_productid` (`productid`),
  ADD KEY `mall_cart_userid` (`userid`);

--
-- Indexes for table `mall_category`
--
ALTER TABLE `mall_category`
  ADD PRIMARY KEY (`cateid`),
  ADD KEY `mall_category_parentid` (`parentid`);

--
-- Indexes for table `mall_comment`
--
ALTER TABLE `mall_comment`
  ADD PRIMARY KEY (`commentid`),
  ADD KEY `mall_comment_productid` (`productid`),
  ADD KEY `mall_comment_userid` (`userid`);

--
-- Indexes for table `mall_order`
--
ALTER TABLE `mall_order`
  ADD PRIMARY KEY (`orderid`),
  ADD KEY `mall_order_userid` (`userid`),
  ADD KEY `mall_order_addressid` (`addressid`),
  ADD KEY `mall_order_expressid` (`expressid`);

--
-- Indexes for table `mall_order_detail`
--
ALTER TABLE `mall_order_detail`
  ADD PRIMARY KEY (`detailid`),
  ADD KEY `mall_order_detail_productid` (`productid`),
  ADD KEY `mall_order_detail_orderid` (`orderid`);

--
-- Indexes for table `mall_product`
--
ALTER TABLE `mall_product`
  ADD PRIMARY KEY (`productid`),
  ADD KEY `mall_product_cateid` (`cateid`);

--
-- Indexes for table `mall_profile`
--
ALTER TABLE `mall_profile`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_profile_userid` (`userid`);

--
-- Indexes for table `mall_test`
--
ALTER TABLE `mall_test`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mall_user`
--
ALTER TABLE `mall_user`
  ADD PRIMARY KEY (`userid`),
  ADD UNIQUE KEY `mall_user_username_userpass` (`username`,`userpass`),
  ADD UNIQUE KEY `mall_user_useremail_userpass` (`useremail`,`userpass`);

--
-- 在导出的表使用AUTO_INCREMENT
--

--
-- 使用表AUTO_INCREMENT `mall_address`
--
ALTER TABLE `mall_address`
  MODIFY `addressid` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- 使用表AUTO_INCREMENT `mall_admin`
--
ALTER TABLE `mall_admin`
  MODIFY `adminid` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- 使用表AUTO_INCREMENT `mall_cart`
--
ALTER TABLE `mall_cart`
  MODIFY `cartid` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- 使用表AUTO_INCREMENT `mall_category`
--
ALTER TABLE `mall_category`
  MODIFY `cateid` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
--
-- 使用表AUTO_INCREMENT `mall_comment`
--
ALTER TABLE `mall_comment`
  MODIFY `commentid` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- 使用表AUTO_INCREMENT `mall_order`
--
ALTER TABLE `mall_order`
  MODIFY `orderid` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- 使用表AUTO_INCREMENT `mall_order_detail`
--
ALTER TABLE `mall_order_detail`
  MODIFY `detailid` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- 使用表AUTO_INCREMENT `mall_product`
--
ALTER TABLE `mall_product`
  MODIFY `productid` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;
--
-- 使用表AUTO_INCREMENT `mall_profile`
--
ALTER TABLE `mall_profile`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- 使用表AUTO_INCREMENT `mall_test`
--
ALTER TABLE `mall_test`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- 使用表AUTO_INCREMENT `mall_user`
--
ALTER TABLE `mall_user`
  MODIFY `userid` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
