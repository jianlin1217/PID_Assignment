<?php
session_start();
//連接資料庫
require_once("connectDB.php");
//存放用SESSION
$_SESSION['NowLogin'];     //現在登入的是誰
$_SESSION['nowMemberId'];  //現在登入的id
$_SESSION['loginState']="登入";     //登入登出鈕
$_SESSION['loginFlag']="false";     //判斷是不是登入以顯示購物車以及歷史明細
$_SESSION['itemCount']=array();     //儲存對應的商品數量
$_SESSION['itemPrice']=array();     //儲存商品的金額
$_SESSION['itemName']=array();      //儲存商品的名稱
$_SESSION['total'];                 //儲存總金額


if($_SESSION['nowMemberId']!=null)
{
    $_SESSION['loginState']="登出";
    $_SESSION['loginFlag']="true";
}
//
$drinkName = array();
$drinkPrice = array();
$canBuy = 0;

//取得飲料id  價格   名字  數量  
$askCommend = <<<end
    select itemId,itemPrice,itemName,remainCount from itemList;
    end;
$result = mysqli_query($link, $askCommend);
while ($row = mysqli_fetch_assoc($result)) {
    array_push($drinkName, $row['itemName']);
    array_push($drinkPrice, $row['itemPrice']);
}
//將品項金額放入
$_SESSION['itemPrice']=$drinkPrice;
$_SESSION['itemName']=$drinkName;

//總共商品有哪些
global $totalItem;
$totalItem = count($drinkName);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <title>熊蜂蜜－BearBees</title>
</head>

<body>
    <?php require_once("header.php");?>
    <?php require_once("footer.php");?>
    <script>
        //叫出登入畫面
        $("#login").click(function() {
            document.location.href='login.php';
        })

        //購物車畫面隱藏或顯示
        <?php
            if($_SESSION['loginFlag']=="true")
            {
        ?>
        $("#buyCar").show();
        $("#history").show();
        //歡迎會員
        $("#welcome").text("welcome!!  "+"<?= $_SESSION['NowLogin']?>");
        <?php
            }
            else{
        ?>
        $("#buyCar").hide(); 
        $("#history").hide();
        $("#welcome").text("");
        <?php
            }
        ?>

        //購物車明細顯示
        $("#addbuycar").click(function(){
           for(j=0;j< <?=$totalItem?>;j++) 
            {
                let putcount="itemcount"+j;
                // alert(putcount);
                // alert($("#"+putcount).text());
                array_push($_SESSION['itemCount']);
            }
           location.href="buycar.php";
        })

    </script>
</body>

</html>