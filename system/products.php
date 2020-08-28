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
    $result=mysqli_query($link,$getProduct);
    while($row=mysqli_fetch_assoc($result))
    {
        array_push($proName,$row["itemName"]);
        array_push($proPrice,$row["itemPrice"]);
        array_push($proRemain,$row["remainCount"]);
        array_push($proMeg,$row["ItemMassage"]);
        array_push($proImgLink,$row["drinkImg"]);
    }
    // var_dump($proName);
    // var_dump($proPrice);
    // var_dump($proRemain);
    // var_dump($proMeg);
    // var_dump($proImgLink);

    //總產品數量
    $proTotal=count($proName);
    global $proTotal;

    //產品作用按鈕
    if(isset($_POST['btnAdd']))
    {
        echo "新增";
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
        // require_once("header.php");
    ?>
    <div class="container" style="margin-top: 100px;">
        <h1>商品總覽</h1>
        <div class="">
                <button id="btnAdd" name="btnAdd">新增</button>
                <button id="btnMod" name="btnMod">修改</button>        
        </div>
        <?php
            for($i=0;$i<$proTotal;$i++)
            {
        ?>
        <div class="wrapper bound" style="margin-top: 20px;">
            <img src="../img/bubbleTea.jpg" alt="ＲＲＲＲ">
            <div>
                <div class="wrapper3 " >
                    <p>
                        商品名稱<br><br><br>
                        <input name="pName" id="pName<?=$i?>" disabled value="<?=$proName[$i]?>">
                        
                    </p>
                    <p>
                        商品金額<br><br><br>
                        <input name="price" id="price<?=$i?>" disabled value="<?=$proPrice[$i]?>">
                        
                    </p>
                    <p>
                        剩餘數量<br><br><br>
                        <input name="remain" id="remain<?=$i?>" disabled value="<?=$proRemain[$i]?> ">
                        
                    </p>
                </div>
            </div>
            <div>
                <p>商品描述:<br></p>
                <textarea name="textF" id="textF<?=$i?>" cols="24" rows="10" style="width: 200px; height:200px" disabled><?=$proMeg[$i]?></textarea>
                
            </div>
        </div>
        <?php
            }
        ?>
    </div>
    <button id="btnSend" name="btnSend" style="display: none ;">送出</button>
</body>
<script>
    let flag=true;
    $("#btnMod").click(function(){
        
        //讓管理者可以修改
        if(flag)
        {
            $flag=false;
            $("input[name='pName']").attr("disabled",false);
            $("input[name='price']").attr("disabled",false);
            $("input[name='remain']").attr("disabled",false);
            $("textarea[name='textF']").attr("disabled",false);
            $("#btnSend").hide();
        }   
        else
        {
            $flag=true;
            $("input[name='pName']").attr("disabled");
            $("input[name='price']").attr("disabled");
            $("input[name='remain']").attr("disabled");
            $("textarea[name='textF']").attr("disabled");
            $("#btnSend").show();
        }
    })
</script>
</html>