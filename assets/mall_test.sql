-- phpMyAdmin SQL Dump
-- version 4.6.6
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: 2017-05-05 09:46:37
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
  `firstname` varchar(32) NOT NULL DEFAULT '',
  `lastname` varchar(32) NOT NULL DEFAULT '',
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

INSERT INTO `mall_address` (`addressid`, `firstname`, `lastname`, `company`, `address`, `postcode`, `email`, `telephone`, `userid`, `createtime`) VALUES
(6, '李', '华', '', '吉林省长春市茶啊二中', '000000', 'test3@test3.com', '18612345678', 3, 0);

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
(1, 'admin', '202cb962ac59075b964b07152d234b70', 'admin@test.com', 1493977428, 3232238081, 1490190332),
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
(16, '服饰', 0, 1493881179),
(17, '寝居', 0, 1493881184),
(18, '玩具', 0, 1493881188);

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
(1, 3, 0, '0.00', 100, 0, '0', 1491726126, '2017-04-09 08:22:06'),
(2, 3, 0, '0.00', 100, 0, '0', 1491746256, '2017-04-09 13:57:36'),
(3, 3, 0, '0.00', 100, 0, '0', 1491788464, '2017-04-10 01:41:04'),
(4, 3, 6, '40.00', 260, 2, '123456789999787', 1491790807, '2017-04-15 14:05:37');

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
(1, 6, '30.00', 6, 1, 1491726126),
(2, 5, '20.00', 1, 1, 1491726126),
(3, 6, '30.00', 1, 2, 1491746256),
(4, 5, '20.00', 1, 3, 1491788464),
(5, 5, '20.00', 1, 4, 1491790807);

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
(7, 16, '格纹棉质褶皱娃娃裙', '彼得潘领 内搭短裤', '彼得潘领 内搭短裤<br><ul><li>彼得潘领 内搭短裤</li></ul><b>彼得潘领 内搭短裤</b><br><br><br>', 20, '156.00', 'http://onu36t5vy.bkt.clouddn.com/590b16a6560be', '{\"590b16a7a19d1\":\"http:\\/\\/onu36t5vy.bkt.clouddn.com\\/590b16a7a19d1\",\"590b16a8036e4\":\"http:\\/\\/onu36t5vy.bkt.clouddn.com\\/590b16a8036e4\"}', '1', '1', '0', '156.00', 0);

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
  MODIFY `addressid` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- 使用表AUTO_INCREMENT `mall_admin`
--
ALTER TABLE `mall_admin`
  MODIFY `adminid` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- 使用表AUTO_INCREMENT `mall_cart`
--
ALTER TABLE `mall_cart`
  MODIFY `cartid` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- 使用表AUTO_INCREMENT `mall_category`
--
ALTER TABLE `mall_category`
  MODIFY `cateid` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
--
-- 使用表AUTO_INCREMENT `mall_order`
--
ALTER TABLE `mall_order`
  MODIFY `orderid` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- 使用表AUTO_INCREMENT `mall_order_detail`
--
ALTER TABLE `mall_order_detail`
  MODIFY `detailid` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- 使用表AUTO_INCREMENT `mall_product`
--
ALTER TABLE `mall_product`
  MODIFY `productid` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
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
