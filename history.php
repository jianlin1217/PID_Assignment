<?php
    session_start();
    require_once("connectDB.php");
    //現在登入的ID
    $nowId = $_SESSION['nowMemberId'];
    //判定是不是導向過去登入畫面
    $_SESSION['linkTo']=0;

    if ($_SESSION['nowMemberId'] != null) {
        $_SESSION['loginState'] = "登出";
        $_SESSION['loginFlag'] = "true";
    }
    $getHis=<<<end
    select 
    end;

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
    <title>熊蜂蜜－BearBees 歷史清單</title>
</head>
<body>
    <?php
        require_once("header.php");
    ?>
    <div class="container" style=" margin-top: 130px;">
        <h1>點選以查看明細ʕ·ᴥ·ʔ</h1>
        <table class="table" style="width:90%;">
            <thead>
                <tr>
                    <th>訂單序號</th>
                    <th>飲品數量</th>
                    <th>金額</th>
                    <th>日期</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
            </tbody>
        </table>
    </div>

    <?php
        require_once("footer.php");
    ?>
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
    </script>
</body>
</html>