<?php
session_start();
//連接資料庫
require_once("connectDB.php");
if($_SESSION['nowMemberId']!=null)
{
    $_SESSION['loginState']="登出";
    $_SESSION['loginFlag']="true";
}
//
$drinkName = array();
$drinkPrice = array();
$nowId = $_SESSION['nowMemberId'];
//總共商品有哪些
global $totalItem;
//取得飲料  價格   名字    
$getItemDB=<<<end
select * from shopCar where buyCusId=$nowId;
end;
$result=mysqli_query($link,$getItemDB);
while($row=mysqli_fetch_assoc($result))
{
    array_push($drinkName,$row['buyName']);
    array_push($drinkPrice,$row['buyPrice']);
}
//將品項金額放入
$totalItem = count($drinkName);

//刪除購物車品項
for ($i = 0; $i < $totalItem; $i++) {
    $temp="delete$i";
    if(isset($_POST[$temp]))
    {
        $deleteItemDB=<<<end
            delete from shopCar where buyCusId=$nowId and buyName="$drinkName[$i]";
        end;
        // echo $deleteItemDB;
        mysqli_query($link,$deleteItemDB);
    }
}
// if(isset($_POST))
// {
//     var_dump($_POST);
// }
// //將購物車訂單送出
// if(isset($_POST['buyorder']))
// {
//     var_dump($_POST['itemcount1']);
//     echo "送出訂單 <br>".$_POST['itemcount1'];
//     for($j=0;$j<$totalItem;$j++)
//     {
//          $number="itemcount$j";
//          echo $number."<br>";
//          echo $_POST[$number];
//          echo "*<br>";
//     }
// }

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
    <title>熊蜂蜜－BearBees 購物車</title>
</head>

<body>

    <?php
    // require_once("header.php");
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
                    <button class="btn btn-success" id="btnadd<?=$i?>" name="btnadd"> + </button>
                </div> 
                
                    <div style="margin-top: 80%;">
                        <p  type="text" id="itemcount<?=$i?>" name="itemcount<?=$i?>">0</p>
                    </div>
                <div class="mid">
                    <button class="btn btn-danger"  id="btnsub<?=$i?>"  name="btnsub"> - </button>
                </div>
            </div>
            <div class="wrapper" id="d3">
                <div style="margin-top: 40%;">
                    <p class="total">小計：</p>
                </div>
                <!--總額-->
                <div style="margin-top: 40%;">
                    <p class="total" id="totalm<?= $i ?>" name="totalm">0</p>
                </div>
                <!--刪除按鈕-->
                <div style="margin-top: 60%;">
                    <form action="" method="post">
                        <button style="width:60px; height:60px;" name="delete<?=$i?>" id="delete<?=$i?>" type="text" class="btn btn-secondary" >X</button>
                    </form>   
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
        //清除歷史避免重複送出表單
        if (window.history.replaceState) {
            window.history.replaceState(null, null, window.location.href);
        }
        //顯示總計和購物車圖示
        $("#alltotal").show();
        $("#alltotalN").show();
        $("#icon").show();
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
            $("#alltotal").text(alltotal);
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
            //個別的數量＊金額
            count = $(item).text();
            if (count > 0)
                count--;
            $(item).text(count);
            $(total).text($(price).text() * count);
            //計算全部數量的錢
            for (i = 0; i < <?= $totalItem ?>; i++) {
                alltotal += Number($("#totalm" + i).text());
            }
            
            $("#alltotal").text(alltotal);
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
        //歡迎會員
        $("#welcome").text("welcome!!  "+"<?= $_SESSION['NowLogin']?>");
        <?php
            }
            else{
        ?>
        $("#buyCar").hide(); 
        $("#history").hide();
        $("#welcome").text("請先登入");
        <?php
            }
        ?>
        

        //存數量 金額 總額
        $("#icon").click(function(){
            let  countA=[];
            let  priceA=[];
            let  total=0;
            for(let i=0;i< <?= $totalItem?>;i++)
            {
                countA.push(Number($("#itemcount"+i).text()));
                priceA.push(Number($("#price"+i).text()));
            }

                alert("???");

            total=$("#alltotal").text();
            $.ajax({
                url:"get.php",
                type:"POST",
                data:{countA:countA,priceA:priceA,total:total},
                error:function(){alert("錯誤");},
                success:function(){}
            });
            location.href="index.php";
        })



    </script>
</body>

</html>