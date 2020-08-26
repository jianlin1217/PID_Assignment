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

# 0826 v1.7   在登入登出部分作購物車的隱藏顯示
設立一個Flag當作是否有登入的依據



### 欠缺
資料庫商品圖片未儲存


