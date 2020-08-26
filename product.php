<?php
session_start();
//連接資料庫
require_once("connectDB.php");

if ($_SESSION['nowMemberId'] != null) {
    $_SESSION['loginState'] = "登出";
    $_SESSION['loginFlag'] = "true";
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
    <title>熊蜂蜜－BearBees 商品選購</title>
</head>

<body>
    <?php require_once("header.php"); ?>
    <?php
        $remain=0;
        for($i=0;$i<ceil($totalItem/3);$i++)
        {
    ?>
        <div class="wrapper outline bottom" >
        <?php
            for($j=0;$j<3&&$remain<$totalItem;$j++,$remain++)
            {
                // echo $remain."<br>";
        ?>
            <div class="pro">
                <img src="img/blacktea.jpg" alt="找不到圖片ＱＡＯ">
                <p><?=$drinkName[$remain]?></p>
                <p><?=$drinkPrice[$remain]?></p>
                <button class="buy btn btn-outline-primary">選購</button>
            </div>
        <?php
            }
        ?>
        </div>
    <?php
        }
    ?>
   
    <?php require_once("footer.php"); ?>

    <script>
        //叫出登入畫面
        $("#login").click(function() {
            document.location.href='login.php';
        })
        //購物車畫面隱藏或顯示
        <?php
        if ($_SESSION['loginFlag'] == "true") {
        ?>
            $("#buyCar").show();
            $("#history").show();
            //歡迎會員
            $("#welcome").text("welcome!!  " + "<?= $_SESSION['NowLogin'] ?>");
        <?php
        } else {
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