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

# 0825 v1.2    購物頁切版面 17:19
未完成


