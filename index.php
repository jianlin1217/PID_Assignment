<?php
session_start();
//連接資料庫
require_once("connectDB.php");
//存放用SESSION
$_SESSION['loginState']="登入";     //登入登出鈕
$_SESSION['loginFlag']="false";

if($_SESSION['nowMemberId']!=null)
{
    $_SESSION['loginState']="登出";
    $_SESSION['loginFlag']="true";
}
//
$drinkName = array();
$drinkPrice = array();
$canBuy = 0;
global $totalItem;
//取得飲料id  價格   名字  數量  
$askCommend = <<<end
    select itemId,itemPrice,itemName,remainCount from itemList;
    end;
$result = mysqli_query($link, $askCommend);
while ($row = mysqli_fetch_assoc($result)) {
    array_push($drinkName, $row['itemName']);
    array_push($drinkPrice, $row['itemPrice']);
}
$totalItem = count($drinkName);
// var_dump($drinkName);
// echo "<br>";
// var_dump($drinkPrice);

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
    <?php
    require_once("header.php");
    for ($i = 0; $i < $totalItem; $i++) {
    ?>
        <!--網頁顯示-->
        <div class="wrapper outline" id="buyItem">
            <div class="wrapper2" id="d1">
                <img src="img/bubbleTea.jpg" alt="找不到圖片ＱＡＯ">
                <div class="mid">
                    <p><?= $drinkName[$i] ?></p>
                    <p id="price<?= $i ?>" name="price"><?= $drinkPrice[$i] ?></p>

                </div>
            </div>
            <div class="wrapper" id="d2">
                <div class="mid">
                    <button class="btn btn-success" id="btnadd<?= $i ?>" name="btnadd"> + </button>
                </div>
                <div style="margin-top: 80%;">
                    <p id="itemcount<?= $i ?>" name="itemcount">0</p>
                </div>
                <div class="mid">
                    <button class="btn btn-danger" id="btnsub<?= $i ?>" name="btnsub"> - </button>
                </div>
            </div>
            <div class="wrapper2" id="d3">
                <div style="margin-top: 40%;">
                    <p class="total">小計：</p>
                </div>
                <div style="margin-top: 40%;">
                    <p class="total" id="totalm<?= $i ?>" name="totalm">0</p>
                </div>

            </div>
        </div>
    <?php
    }
    ?>
    <?php
    require_once("footer.php")
    ?>
    <script>
        //增加數量
        $("button[name='btnadd']").click(function() {
            let alltotal = 0;
            let count;
            let nowid = $(this).attr("id").replace("btnadd", "");

            // alert(nowid);
            //存放每個操作的id
            item = "#itemcount" + nowid;
            total = "#totalm" + nowid;
            price = "#price" + nowid;
            // alert(item);

            count = $(item).text();
            count++;
            $(item).text(count);
            $(total).text($(price).text() * count);

            for (i = 0; i < <?= $totalItem ?>; i++) {
                alltotal += Number($("#totalm" + i).text());
            }
            $("#alltotal").text("總計:" + alltotal);

        })
        //減少數量
        $("button[name='btnsub']").click(function() {
            let alltotal = 0;
            let count;
            let nowid = $(this).attr("id").replace("btnsub", "");

            // alert(nowid);
            //存放每個操作的id
            item = "#itemcount" + nowid;
            total = "#totalm" + nowid;
            price = "#price" + nowid;
            // alert(item);

            count = $(item).text();
            if (count > 0)
                count--;
            $(item).text(count);
            $(total).text($(price).text() * count);

            for (i = 0; i < <?= $totalItem ?>; i++) {
                alltotal += Number($("#totalm" + i).text());
            }
            $("#alltotal").text("總計:" + alltotal);
        })
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
    </script>
</body>

</html>