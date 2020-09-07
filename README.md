# PID_Assignment

# 0825 v1.1 創立資料庫 13:30
資料庫buy_System
建立改放至最下方

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


# 0907 v2.4 商品選購、購物車 商品改善
商品選購時將不會顯示非上架中的商品

購物車若是原本有加入後但是卻不能購買者顯示無法購買（不能更改數量） 而數量為０不會計入購買

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


# 0907 v4.3 商品管理加上商品狀態
1為上架中
２為下架中
３為缺貨中
4為商品刪除
並且商品加上商品的物料花費

# 0901 v5.0 新增會員禁用功能
設一個ＹＮ值判定會員能不能進入

# 0901 v5.1 會員清單購買明細

# 0901 v6.0 訂單明細

# 0901 v6.1 訂單完成日期新增

# 0904 v7.0 報表日期選擇

# 0904 v7.1 報表可顯示內容

# 0907 v7.2 報表顯示商品
顯示 商品名稱	剩餘數量	期間銷售數量	商品狀態
有選日期才有 顯示 期間銷售數量
沒有選擇沒有



# 0907 





### 待改進
- [ ]訂單要新增可讓管理員負責 指定負責
- [x]歷史品項保存->用商品狀態來記住商品
- [ ]若是商品剩餘數量小於0則應該直接顯示缺貨中
- [ ]刪除商品佔資料庫儲存空間
- [ ]顧客違規次數、事項
- [ ]當商品刪除時購物車商品刪除需告知顧客
- [ ]因登入的權限不同而顯示不同功能
- [ ]顧客可選擇希望的日期時間
- [ ]RWD網頁
- [ ]購物車刪除有選品項後點Ｘ不會即時消失
