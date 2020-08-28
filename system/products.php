<?php
    session_start();
    require_once("connectDB.php");
    
    $proName=array();
    $proPrice=array();
    $proRemain=array();
    $proMeg=array();
    $proImgLink=array();

    //從資料庫中讀取產品
    $getProduct=<<<end
    select * from itemList;
    end;
    

    //產品作用按鈕
    if(isset($_POST['btnAdd']))
    {
        echo "新增";
    }
    if(isset($_POST['btnMod']))
    {
        echo "修改";
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"> 
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="style.css">
    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    
    <title>BearBees -- 管理系統(商品)</title>
</head>
<body>
    <?php
        require_once("header.php");
    ?>
    <div class="container" style="margin-top: 100px;">
        <h1>商品總覽</h1>
        <div class="">
            <form action="" method="post">
                <button id="btnAdd" name="btnAdd">新增</button>
                <button id="btnMod" name="btnMod" >修改</button>
            </form>          
        </div>
        <div class="wrapper bound" style="margin-top: 20px;">
            <img src="../img/bubbleTea.jpg" alt="ＲＲＲＲ">
            <div>
                <div class="wrapper3 " >
                    <p>
                        商品名稱<br><br>

                         <?=123456?> 
                    </p>
                    <p>商品金額</p>
                    <p>剩餘數量</p>
                </div>
            </div>
            <div>
                <p>商品描述</p>
            </div>
        </div>
    </div>
</body>
</html>