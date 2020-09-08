<?php
session_start();
require_once("connectDB.php");
//現在登入id
$nowId = $_SESSION['nowMemberId'];

//取得飲料id  價格   名字  數量 
$drinkId = array();
$drinkName = array();
$drinkDes = array();
$drinkImg = array();
$askCommend = <<<end
        select itemId,drinkImg,ItemMassage,itemName,remainCount from itemList where itemState=1;
        end;
$result = mysqli_query($link, $askCommend);
while ($row = mysqli_fetch_assoc($result)) {
    array_push($drinkId, $row['itemId']);
    array_push($drinkName, $row['itemName']);
    array_push($drinkDes, $row['ItemMassage']);
    array_push($drinkImg, $row['drinkImg']);
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

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <title>熊蜂蜜－BearBees</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <?php require_once("header.php"); ?>
    <div style="margin-top:100px">
        <h1>商品介紹</h1>
        <?php
        for ($i = 0; $i < $totalItem; $i++) {
            if ($i % 2 == 0) {
        ?>
                <div style="display: grid;grid-template-columns: 2fr 2fr 10fr; grid-column-gap: 20px; margin:20px ;margin-top:40px;margin-bottom:100px;">
                    <img style="height: 300px; width:300px" src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($drinkImg[$i]); ?>" alt="">
                    <p style="text-align: center; margin-top:120px; font-size:40px"><?= $drinkName[$i] ?></p>
                    <p style="text-align: center;display: -webkit-box;-webkit-line-clamp: 3; -webkit-box-orient: vertical;white-space: normal; margin-top:100px; font-size:50px"><?= $drinkDes[$i] ?></p>
                </div>

        <?php
            } 
            else 
            {
        ?>
                <div style="display: grid;grid-template-columns: 10fr 2fr 2fr; grid-column-gap: 20px; margin:20px;margin-top:40px;margin-bottom:100px;">
                    <p style="text-align: center;displat:-webkit-box;-webkit-line-clamp: 3; -webkit-box-orient: vertical;white-space: normal; margin-top:100px; font-size:50px"><?= $drinkDes[$i] ?></p>
                    <p style="text-align: center; margin-top:120px; font-size:40px"><?= $drinkName[$i] ?></p>
                    <img style="height: 300px; width:300px"  src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($drinkImg[$i]); ?>" alt="">
                    
                </div>
        <?php
            }
        }
        ?>
    </div>
    <?php require_once("footer.php"); ?>
    <script>
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

        //購物車明細顯示
        $("#addbuycar").click(function() {
            for (j = 0; j < <?= $totalItem ?>; j++) {
                let putcount = "itemcount" + j;
                // alert(putcount);
                // alert($("#"+putcount).text());
                array_push($_SESSION['itemCount']);
            }
            location.href = "buycar.php";
        })
    </script>
</body>

</html>