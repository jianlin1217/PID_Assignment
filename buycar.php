<?php
session_start();
//連接資料庫
require_once("connectDB.php");
if($_SESSION['nowMemberId']!=null)
{
    $_SESSION['loginState']="登出";
    $_SESSION['loginFlag']="true";
}
//取得飲料id  價格 名字
$drinkId = array();
$drinkName = array();
$drinkPrice = array();
$nowId = $_SESSION['nowMemberId'];
//總共商品有哪些
global $totalItem;
//從資料庫取得 飲料id  價格   名字    
$getBuyDB=<<<end
select buyItemId from shopCar where buyCusId=$nowId;
end;
$result=mysqli_query($link,$getBuyDB);
while($row=mysqli_fetch_assoc($result))
{
    array_push($drinkId,$row['buyItemId']);
}
// var_dump($drinkId);
//將品項數量放入
$totalItem = count($drinkId);

for($i=0;$i<$totalItem;$i++)
{
    $getItemDB=<<<end
    select itemName,itemPrice,remainCount from itemList where itemId=$drinkId[$i]
    end;
    $result=mysqli_query($link,$getItemDB);
    $row=mysqli_fetch_assoc($result);
    array_push($drinkName,$row['itemName']);
    array_push($drinkPrice,$row['itemPrice']);
    // echo $drinkName[$i]."  ".$drinkPrice[$i];
}


//刪除購物車品項
for ($i = 0; $i < $totalItem; $i++) {
    $temp="delete$i";
    if(isset($_POST[$temp]))
    {
        //取得商品ID
        $getItemId=<<<end
            select itemId from itemList where itemName="$drinkName[$i]";
        end;
        $pId=mysqli_fetch_assoc(mysqli_query($link,$getItemId))['itemId'];
        $deleteItemDB=<<<end
            delete from shopCar where buyCusId=$nowId and buyItemId=$pId;
        end;
        // echo $deleteItemDB;
        mysqli_query($link,$deleteItemDB);
    }
}

if(isset($_POST['buyorder']))
{
    $orderIcount=array();
    $orderIName=array();
    $orderIPrice=array();
    $orderTotal;
    for($j=0;$j< $totalItem;$j++)
    {
        $temp="bcount$j";
        $temp2="bname$j";
        //數量為零的不放入結算
        if($_POST[$temp]!=0)
        {
            array_push($orderIcount,$_POST[$temp]);
            array_push($orderIName,$_POST[$temp2]); 
            
        }
       
    }
    //訂單總額
    $orderTotal=$_POST['btotal'];
    //取得商品價格
    for($o=0;$o<count($orderIcount);$o++)
    {
        $getPrice=<<<end
        select itemPrice from itemList where itemName = "$orderIName[$o]"
        end;
        $row=mysqli_fetch_assoc(mysqli_query($link,$getPrice));
        $orderIPrice[$o]=intval($row['itemPrice']);
    }
    // var_dump($orderIPrice);
    //現在時間
    date_default_timezone_set("Asia/Taipei");
    $nowDate = date("Y-m-d H:i:s");;
    //計算總共商品數量
    $orderTotalCount=0;
    for($i=0;$i<count($orderIcount);$i++)
    $orderTotalCount+=$orderIcount[$i];
    //將訂單存到訂單資料庫
    $putorderDB=<<<end
    insert into orderList
    (total,orderCusId,orderCount,orderDate)
    values
    ($orderTotal,$nowId,$orderTotalCount,"$nowDate");
    end;
    // echo $putorderDB;
    mysqli_query($link,$putorderDB);

    //將訂單放到訂單明細資料庫
    $getOrderId=<<<end
    select orderId from orderList where orderCusId=$nowId;
    end;
    $result=mysqli_query($link,$getOrderId);
    //因一個顧客可能有多筆訂單  取訂單編號最大的為現在的訂單
    $allOrder=array();
    while($row=mysqli_fetch_assoc($result))
    {
        array_push($allOrder,$row['orderId']);
    }
    $nowOrder=max($allOrder);
    // echo $nowOrder;
    //將訂單明細放到資料庫中
    for($h=0;$h<count($orderIcount);$h++)
    {
        $putdetailDB=<<<end
        insert into orderDetail
        (orderId,itemPrice,itemName,itemCount)
        values
        ($nowOrder,$orderIPrice[$h],"$orderIName[$h]",$orderIcount[$h]);
        end;
        // echo $putdetailDB;
        mysqli_query($link,$putdetailDB);
    }
    //新增到客戶歷史資料
    $putHisDB=<<<end
    insert into hisList
    (hisListId,whoBuyId,hisToatl,hisItemCount,hisDate)
    values
    ($nowOrder,$nowId,$orderTotal,$orderTotalCount,"2020-08-28 10:20:43");
    end;
    mysqli_query($link,$putHisDB);
    // echo $putHisDB;

    //清空購物車
    $deletecar=<<<end
    delete from shopCar where buyCusId=$nowId;
    end;
    mysqli_query($link,$deletecar);
    header("location:history.php");
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
    <title>熊蜂蜜－BearBees 購物車</title>
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
                    <p id="name<?= $i ?>" name="dname"><?= $drinkName[$i] ?></p>
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
            let  total=0;
            for(let i=0;i< <?= $totalItem?>;i++)
            {
                $("#bcount"+i).val(Number($("#itemcount"+i).text()));
                $("#bname"+i).val($("#name"+i).text());
            }
            //將input值改變再送到ＳＥＳＳＩＯＮ中
            total=$("#alltotal").text();
            $("#btotal").val(total);


            //ajax傳送  
            
            // $.ajax({
            //     url:"get.php",
            //     type:"POST",
            //     data:{countA:countA,priceA:priceA,total:total},
            //     error:function(){alert("錯誤");},
            //     success:function(){}
            // });
           
            // alert($("#test").text());
            // location.href="index.php";
        })



    </script>
</body>

</html>