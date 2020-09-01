# RD1_Assignment

# 0825 v1.1 創立資料庫 13:30
資料庫buy_System

先暫定規劃8個資料表

管理端
會員列表            
1個資料表 orderList
memberId       PK  
memberPhone 
memberAddress
memberPassword
memberName
memberAccount
memberSalary
memberYN  


訂單管理            
1個資料表 memberList
orderId         PK
total
orderCusId
orderManageId
orderItemId
orderCount
orderDate


商品管理            
1個資料表 itemList
itemId          PK
itemPrice
itemName
remainCount
saleOut


使用端
商品列表選購		 同商品管理資料表

註冊／登入（使用者清單）
1個資料表 customerList
customerId      PK
customerName
customerAccount
customerPasswoed
customerPhone
customerAddress
customerMail


購物車	             
1個資料表 shopCar
buyCusId
buyTotal
buyCount
buyItemId


歷史清單	         
1個資料表 hisList
hisListId
whoBuyId
hisTotal
hisItemId
hisItemCount
hisDate

客戶清單           同註冊/登入資料表

# 0825 v1.2    購物頁切版面 
簡單版面完成

# 0826 v1.3    商品數量增加減少  
製作一個可跑回圈
但按鈕相互又不影響數量
來產生多筆飲料的資料
目前皆為同一種飲料

作法：
使用JS對每個增加、刪除的按鈕做點擊事件
php迴圈產生每個金額、數量、總額的id不同
用$(this)取得現在按鈕的id並且將其擷取出來
套用到相符id的金額數量總額

# 0826 v1.4   將資料庫中的商品資料讀取到畫面中  
並將商品名稱及金額顯示在畫面上

# 0826 v1.5   計算總金額，將總計放在footer中 

# 0826 v1.6   顧客登入系統  
先求功能有，將網銀註冊登入部分拿過來使用

# 0826 v1.7   在登入登出部分作購物車和歷史紀錄的隱藏顯示
設立一個Flag當作是否有登入的依據

# 0826 v1.8   將現有畫面設成主頁，另設一個購物車頁面顯示明細
利用JS操作元素的隱藏及顯示

# 0826 v1.9  新增產品選購頁面
從資料庫讀取並顯示在網頁上

# 0827v1.91 產品選購頁面點選會新增至購物車（失敗）
使用JS傳值給PHP失敗

# 0827 v1.92 產品選購頁面點選會新增至購物車（失敗）
使用$_SESSION傳值失敗
後決定將資料存放至資料庫中在讀取操作

# 0827 v1.93 商品選購頁面點選會新增至購物車 （完成）
使用存放到資料庫
在購物車頁面在讀取資料庫購物車資料表的資訓

# 0827 v2.0 將刪除按鈕新增到購物車畫面


# 0827 v2.1 將購物車金額 品項  總價錢 傳送至資料庫訂單（失敗）
$_POST無法抓到值

# 0828 v2.2 將購物車   數量 品項 總價錢  成功php收值
先用ＪＳ處理值再使用$_POST接收值

# 0828 v2.3  將訂單資料上傳到資料庫
同時清空購物車
單子內容同時傳到訂單記錄和歷史紀錄資料表中

# 0828 v3.0 管理後端  登入
讓管理員可以登入

# 0831 v3.1 後端登入判定
判定是不是有登入才進入system.php
沒有的話則請出返回index.php
或者是使用權限被限制也會返回index.php
並且顯示訊息

# 0831 v4.0 商品管理
將資料庫商品顯示在網頁上

# 0831 v4.1 商品管理修改
可以修改資料庫的產品資料
並且存回資料庫

# 0831 v4.2 商品圖片全數顯示資料庫中內容

# 0831 v5.0 新增會員禁用功能
設一個ＹＮ值判定會員能不能進入




### 待改進
歷史品項保存
顧客違規次數、事項
當商品刪除時購物車商品刪除需告知顧客
因登入的權限不同而顯示不同功能
顧客可選擇希望的日期時間
RWD網頁
購物車刪除有選品項後點Ｘ不會即時消失

-- phpMyAdmin SQL Dump
-- version 4.9.3
-- https://www.phpmyadmin.net/
--
-- 主機： localhost:8889
-- 產生時間： 2020 年 08 月 31 日 00:52
-- 伺服器版本： 5.7.26
-- PHP 版本： 7.4.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- 資料庫： `buy_System`
--

-- --------------------------------------------------------

--
-- 資料表結構 `customerList`
--

CREATE TABLE `customerList` (
  `customerId` int(11) NOT NULL,
  `customerName` varchar(20) DEFAULT NULL,
  `customerAccount` varchar(15) DEFAULT NULL,
  `customerPassword` varchar(16) DEFAULT NULL,
  `customerPhone` char(10) DEFAULT NULL,
  `customerAddress` varchar(60) DEFAULT NULL,
  `customerMail` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 傾印資料表的資料 `customerList`
--

INSERT INTO `customerList` (`customerId`, `customerName`, `customerAccount`, `customerPassword`, `customerPhone`, `customerAddress`, `customerMail`) VALUES
(1, '熊仔', 'Bear0826', 'Bearpwd0826', '0978312465', '台中西屯區', 'Bear0826@gamil.com'),
(5, 'BrownBear', 'BBear1217', 'Bear1217', '0958285961', '', 'BBear1217@gmail.com'),
(6, '黑熊', 'Black0828', 'Black0828', '0946587521', '深山', 'BearTest0828@yahoo.com.tw');

-- --------------------------------------------------------

--
-- 資料表結構 `hisList`
--

CREATE TABLE `hisList` (
  `hisListId` int(11) NOT NULL,
  `whoBuyId` int(11) DEFAULT NULL,
  `hisToatl` int(11) DEFAULT NULL,
  `hisItemCount` int(11) DEFAULT NULL,
  `hisDate` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 傾印資料表的資料 `hisList`
--

INSERT INTO `hisList` (`hisListId`, `whoBuyId`, `hisToatl`, `hisItemCount`, `hisDate`) VALUES
(1, 5, 725, 16, '2020-08-28 10:20:43'),
(2, 5, 955, 15, '2020-08-28 10:20:43'),
(3, 5, 775, 12, '2020-08-28 10:20:43'),
(4, 5, 265, 5, '2020-08-28 10:20:43'),
(5, 5, 675, 10, '2020-08-28 10:20:43'),
(6, 5, 280, 4, '2020-08-28 10:20:43'),
(7, 6, 500, 10, '2020-08-28 10:20:43'),
(8, 6, 775, 12, '2020-08-28 10:20:43'),
(9, 5, 275, 4, '2020-08-28 10:20:43'),
(10, 5, 280, 8, '2020-08-28 14:47:40');

-- --------------------------------------------------------

--
-- 資料表結構 `itemList`
--

CREATE TABLE `itemList` (
  `itemId` int(11) NOT NULL,
  `itemPrice` int(11) DEFAULT NULL,
  `itemName` varchar(30) DEFAULT NULL,
  `remainCount` int(11) DEFAULT NULL,
  `saleOut` int(11) DEFAULT NULL,
  `drinkImg` varchar(5000) DEFAULT NULL,
  `ItemMassage` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 傾印資料表的資料 `itemList`
--

INSERT INTO `itemList` (`itemId`, `itemPrice`, `itemName`, `remainCount`, `saleOut`, `drinkImg`, `ItemMassage`) VALUES
(1, 70, '熊掌奶茶', 120, 200, NULL, '由錫蘭紅茶為基底加上牛奶的沖泡\r\n加上特製外形的熊掌Ｑ掌珍珠\r\n每一口都是心的享受'),
(2, 35, '熊蜜紅茶', 70, 250, NULL, ''),
(3, 35, '熊蜜綠茶', 200, 70, NULL, ''),
(4, 60, '北極熊奶茶', 150, 150, NULL, ''),
(5, 65, '黑熊奶茶', 130, 100, NULL, '');

-- --------------------------------------------------------

--
-- 資料表結構 `memberList`
--

CREATE TABLE `memberList` (
  `memberId` int(11) NOT NULL,
  `rankId` int(11) DEFAULT '1',
  `memberName` varchar(30) DEFAULT NULL,
  `memberAccount` varchar(30) DEFAULT NULL,
  `memberPassword` varchar(16) DEFAULT NULL,
  `memberPhone` char(10) DEFAULT NULL,
  `memberAddress` varchar(40) DEFAULT NULL,
  `memberYN` enum('Y','N') NOT NULL DEFAULT 'Y'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 資料表結構 `mRank`
--

CREATE TABLE `mRank` (
  `rankId` int(11) DEFAULT NULL,
  `rankName` varchar(20) DEFAULT NULL,
  `rankSalary` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 傾印資料表的資料 `mRank`
--

INSERT INTO `mRank` (`rankId`, `rankName`, `rankSalary`) VALUES
(1, '一般職員', 25000),
(2, '店長', 32000),
(3, '儲備店長', 30000),
(4, '老闆', 50000);

-- --------------------------------------------------------

--
-- 資料表結構 `orderDetail`
--

CREATE TABLE `orderDetail` (
  `orderId` int(11) DEFAULT NULL,
  `itemPrice` int(11) DEFAULT NULL,
  `itemName` varchar(30) DEFAULT NULL,
  `itemCount` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 傾印資料表的資料 `orderDetail`
--

INSERT INTO `orderDetail` (`orderId`, `itemPrice`, `itemName`, `itemCount`) VALUES
(1, 70, '熊掌奶茶', 4),
(1, 35, '熊蜜綠茶', 5),
(1, 65, '黑熊奶茶', 3),
(1, 35, '熊蜜紅茶', 5),
(2, 65, '黑熊奶茶', 5),
(2, 70, '熊掌奶茶', 3),
(2, 60, '北極熊奶茶', 7),
(3, 65, '黑熊奶茶', 5),
(3, 70, '熊掌奶茶', 3),
(3, 60, '北極熊奶茶', 4),
(4, 65, '黑熊奶茶', 1),
(4, 70, '熊掌奶茶', 1),
(4, 60, '北極熊奶茶', 1),
(4, 35, '熊蜜綠茶', 1),
(4, 35, '熊蜜紅茶', 1),
(5, 70, '熊掌奶茶', 5),
(5, 65, '黑熊奶茶', 5),
(6, 70, '熊掌奶茶', 4),
(7, 35, '熊蜜紅茶', 1),
(7, 35, '熊蜜綠茶', 3),
(7, 60, '北極熊奶茶', 6),
(8, 70, '熊掌奶茶', 4),
(8, 65, '黑熊奶茶', 3),
(8, 60, '北極熊奶茶', 5),
(9, 65, '黑熊奶茶', 1),
(9, 70, '熊掌奶茶', 3),
(10, 35, '熊蜜紅茶', 5),
(10, 35, '熊蜜綠茶', 3);

-- --------------------------------------------------------

--
-- 資料表結構 `orderList`
--

CREATE TABLE `orderList` (
  `orderId` int(11) NOT NULL,
  `total` int(11) DEFAULT NULL,
  `orderCusId` int(11) DEFAULT NULL,
  `orderManageId` int(11) DEFAULT NULL,
  `orderCount` int(11) DEFAULT NULL,
  `orderDate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 傾印資料表的資料 `orderList`
--

INSERT INTO `orderList` (`orderId`, `total`, `orderCusId`, `orderManageId`, `orderCount`, `orderDate`) VALUES
(1, 1030, 5, NULL, 20, '2020-08-28 10:20:43'),
(2, 955, 5, NULL, 15, '2020-08-28 11:00:04'),
(3, 775, 5, NULL, 12, '2020-08-28 11:04:19'),
(4, 265, 5, NULL, 5, '2020-08-28 11:05:10'),
(5, 675, 5, NULL, 10, '2020-08-28 11:05:54'),
(6, 280, 5, NULL, 4, '2020-08-28 12:36:36'),
(7, 500, 6, NULL, 10, '2020-08-28 13:42:04'),
(8, 775, 6, NULL, 12, '2020-08-28 13:43:29'),
(9, 275, 5, NULL, 4, '2020-08-28 14:46:48'),
(10, 280, 5, NULL, 8, '2020-08-28 14:47:40');

-- --------------------------------------------------------

--
-- 資料表結構 `shopCar`
--

CREATE TABLE `shopCar` (
  `putInId` int(11) NOT NULL,
  `buyCusId` int(11) NOT NULL,
  `buyItemId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 傾印資料表的資料 `shopCar`
--

INSERT INTO `shopCar` (`putInId`, `buyCusId`, `buyItemId`) VALUES
(17, 1, 1),
(18, 1, 5),
(19, 1, 2);

--
-- 已傾印資料表的索引
--

--
-- 資料表索引 `customerList`
--
ALTER TABLE `customerList`
  ADD PRIMARY KEY (`customerId`);

--
-- 資料表索引 `hisList`
--
ALTER TABLE `hisList`
  ADD PRIMARY KEY (`hisListId`);

--
-- 資料表索引 `itemList`
--
ALTER TABLE `itemList`
  ADD PRIMARY KEY (`itemId`);

--
-- 資料表索引 `memberList`
--
ALTER TABLE `memberList`
  ADD PRIMARY KEY (`memberId`);

--
-- 資料表索引 `orderList`
--
ALTER TABLE `orderList`
  ADD PRIMARY KEY (`orderId`);

--
-- 資料表索引 `shopCar`
--
ALTER TABLE `shopCar`
  ADD PRIMARY KEY (`putInId`);

--
-- 在傾印的資料表使用自動遞增(AUTO_INCREMENT)
--

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `customerList`
--
ALTER TABLE `customerList`
  MODIFY `customerId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `hisList`
--
ALTER TABLE `hisList`
  MODIFY `hisListId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `itemList`
--
ALTER TABLE `itemList`
  MODIFY `itemId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `memberList`
--
ALTER TABLE `memberList`
  MODIFY `memberId` int(11) NOT NULL AUTO_INCREMENT;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `orderList`
--
ALTER TABLE `orderList`
  MODIFY `orderId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `shopCar`
--
ALTER TABLE `shopCar`
  MODIFY `putInId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
