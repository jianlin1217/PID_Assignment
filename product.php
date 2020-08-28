<?php
session_start();
//連接資料庫
require_once("connectDB.php");
//選購者添加到購物車的品項
$_SESSION['wBuyItem'] = array();
$_SESSION['wItemPrice'] = array();
$_SESSION['wItemId']=array();
//判定是不是導向過去登入畫面
$_SESSION['linkTo']=0;

if ($_SESSION['nowMemberId'] != null) {
    $_SESSION['loginState'] = "登出";
    $_SESSION['loginFlag'] = "true";
}
//現在登入id
$nowId = $_SESSION['nowMemberId'];

//取得飲料id  價格   名字  數量 
$drinkId = array();
$drinkName = array();
$drinkPrice = array();
$askCommend = <<<end
    select itemId,itemPrice,itemName,remainCount from itemList;
    end;
$result = mysqli_query($link, $askCommend);
while ($row = mysqli_fetch_assoc($result)) {
    array_push($drinkId, $row['itemId']);
    array_push($drinkName, $row['itemName']);
    array_push($drinkPrice, $row['itemPrice']);
}
//總共商品有哪些
global $totalItem;
$totalItem = count($drinkName);
//將商品放到購物車 並且存到資料庫中
for ($i = 0; $i < $totalItem; $i++) {
    //變數值
    $temp = "btnBuy$i";
    if (isset($_POST[$temp])) {
        //確認無重複擺放品項
        $flag=true;
        $buysameDB=<<<end
        select buyItemId from shopCar where buyCusId = $nowId;
        end;
        $result=mysqli_query($link,$buysameDB);
        while($row=mysqli_fetch_assoc($result))
        {
            if($row['buyItemId']==$drinkId[$i])
            {
                $flag=false;
                // echo "same:".$drinkId[$i]."  ";
            }
            
        }
        if($flag)
        {
            // echo "加入購物車";
            //將品項擺到購物車中
            $buycarDB = <<<end
            insert into shopCar
            (buyCusId,buyItemId)
            values
            ($nowId,$drinkId[$i]);
            end;
            // echo $buycarDB;
            mysqli_query($link,$buycarDB);
        }
        else
        {
            // echo "購物車已有";
        }
    }
}


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
    <?php
    //檢測是不是還沒登入  非登入狀態則返回登入頁
    if ($_SESSION['nowMemberId'] == null) {
        $_SESSION['linkTo']=1;
        header("location: login.php");
    }
    ?>

    <?php
    require_once("header.php"); 
    ?>
    <?php
    $remain = 0;
    for ($i = 0; $i < ceil($totalItem / 3); $i++) {
    ?>
        <div class="wrapper outline bottom">
            <?php
            for ($j = 0; $j < 3 && $remain < $totalItem; $j++, $remain++) {
            ?>
                <div class="pro">
                    <img src="img/blacktea.jpg" alt="找不到圖片ＱＡＯ">
                    <p><?= $drinkName[$remain] ?></p>
                    <p><?= $drinkPrice[$remain] ?></p>
                    <form id="form<?= $remain ?>" action="" method="post">
                        <button id="btnBuy<?= $remain ?>" name="btnBuy<?= $remain ?>" class="buy btn btn-outline-primary">選購</button>
                    </form>
                </div>
            <?php
            }
            ?>
        </div>
    <?php
    }
    ?>

    <?php
    require_once("footer.php"); 
    ?>

    <script>
        //清除歷史避免重複送出表單
        if (window.history.replaceState) {
            window.history.replaceState(null, null, window.location.href);
        }
        //叫出登入畫面
        $("#login").click(function() {
            document.location.href = 'login.php';
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
        //放入購物車
        $('button').click(function() {
            let put = $(this).attr("id").replace("btnBuy", "");
            // alert(put);
            //使用ajax傳值給php，失敗
            // $('form').submit(function(){
            //      var JSsendPHP=$.ajax({
            //     type:"POST",
            //     url:"product.php",
            //     dataType:"JSON",
            //     data:{"id":put},
            //     error:function(e){
            //         console.log(e);
            //     },
            //     suceess:function(s){
            //         console.log(s);
            //     }
            // }).responseText;
            //     // alert(JSsendPHP);
            // });
            //"array_push($_SESSION['wBuyItem']?>","$drinkName)?>";
        })
    </script>
</body>

</html>