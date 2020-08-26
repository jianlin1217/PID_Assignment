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

# 0825 v1.2    購物頁切版面  17:19
簡單版面完成

# 0826 v1.3    商品數量增加減少  10:44
製作一個可跑回圈
但按鈕相互又不影響數量
來產生多筆飲料的資料
目前皆為同一種飲料

作法：
使用JS對每個增加、刪除的按鈕做點擊事件
php迴圈產生每個金額、數量、總額的id不同
用$(this)取得現在按鈕的id並且將其擷取出來
套用到相符id的金額數量總額

# 0826 v1.4   將資料庫中的商品資料讀取到畫面中  11:29
用php對資料庫做存取動作
並將商品名稱及金額顯示在畫面上

# 0826 v1.5   計算總金額，將總計放在footer中  11:45

# 0826 v1.6   顧客登入系統  
先求功能有，將網銀註冊登入部分拿過來使用

# 0826 v1.7   在登入登出部分作購物車和歷史紀錄的隱藏顯示
設立一個Flag當作是否有登入的依據

# 0826 v1.8   將現有畫面設成主頁，另設一個購物車頁面顯示明細（無圖片）
利用JS操作元素的隱藏及顯示


### 欠缺
資料庫商品圖片未儲存


-- phpMyAdmin SQL Dump
-- version 4.9.3
-- https://www.phpmyadmin.net/
--
-- 主機： localhost:8889
-- 產生時間： 2020 年 08 月 26 日 09:52
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
(5, 'BrownBear', 'BBear1217', 'Bear1217', '0958285961', '', 'BBear1217@gmail.com');

--
-- 已傾印資料表的索引
--

--
-- 資料表索引 `customerList`
--
ALTER TABLE `customerList`
  ADD PRIMARY KEY (`customerId`);

--
-- 在傾印的資料表使用自動遞增(AUTO_INCREMENT)
--

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `customerList`
--
ALTER TABLE `customerList`
  MODIFY `customerId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
