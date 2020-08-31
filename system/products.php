<?php
    session_start();
    require_once("connectDB.php");
    
    $proName=array();
    $proPrice=array();
    $proRemain=array();
    $proMeg=array();
    // $proImgLink=array();
    $proId=array();
    //產品ＩＤ
    $_SESSION['pID']=array();

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
        // array_push($proImgLink,$row["drinkImg"]);
        array_push($proId,$row['itemId']);
    }
    $_SESSION['pID']=$proId;
    // var_dump($proName);
    // var_dump($proPrice);
    // var_dump($proRemain);
    // var_dump($proMeg);
    // var_dump($proImgLink);

    //總產品數量
    $proTotal=count($proName);
    global $proTotal;
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
             $result=mysqli_query($link,$getProduct);
            for($i=0;$i<$proTotal;$i++)
            {
                $row=mysqli_fetch_assoc($result);
                // echo base64_encode($row["drinkImg"]);
        ?>
        <form action="" method="post">
            <div class="wrapper bound" style="margin-top: 20px;">
            <img src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($row["drinkImg"]); ?>" alt="ＲＲＲＲ">
            
            <div>
                <div class="wrapper3 " >
                    <p>
                        商品名稱<br><br><br>
                        <input name="pName<?=$i?>" id="pName<?=$i?>" disabled value="<?=$proName[$i]?>">
                        
                    </p>
                    <p>
                        商品金額<br><br><br>
                        <input name="price<?=$i?>" id="price<?=$i?>" disabled value="<?=$proPrice[$i]?>">
                        
                    </p>
                    <p>
                        剩餘數量<br><br><br>
                        <input name="remain<?=$i?>" id="remain<?=$i?>" disabled value="<?=$proRemain[$i]?> ">
                        
                    </p>
                </div>
            </div>
            <div>
                <p>商品描述:<br></p>
                <textarea name="textF<?=$i?>" id="textF<?=$i?>" cols="24" rows="10" style="width: 200px; height:200px" disabled><?=$proMeg[$i]?></textarea>
                <div class="wrapper2">
                    <button id="btnDel<?=$i?>" name="btnDel<?=$i?>" style="display:none; float:right">刪除</button>
                    <button id="btnSend<?=$i?>" name="btnSend<?=$i?>" style="display:none; float:right">修改送出</button>
                </div>
                
            </div>
            </div>
            <div class="container">
                

            </div>   
        </form>

        <?php
            }
        ?>
    </div>
    <!-- php 程式碼區域 -->
<?php
     //接收修改資料
     for($i=0;$i<$proTotal;$i++)
     {
         if(isset($_POST['btnSend'.$i]))
         {
             ?>
             <?php
             // echo "這是第 $i 項產品";
             $Pname=$_POST['pName'.$i];
             $Pprice=$_POST['price'.$i];
             $Premain=$_POST['remain'.$i];
             $Pdescribe=$_POST['textF'.$i];
 
             //修改資料傳送資料庫
             $modify=<<<end
             update itemList set itemPrice = $Pprice , itemName = "$Pname" , remainCount = $Premain ,ItemMassage = "$Pdescribe" where itemId = $proId[$i] ;
             end;
             // echo $modify;
             mysqli_query($link,$modify);
         }
     }
     //刪除商品
     for($i=0;$i<$proTotal;$i++)
     {
         if(isset($_POST['btnDel'.$i]))
         {
             //刪除商品
             $deleteP=<<<end
             delete from itemList where itemId = $proId[$i];
             end;
             mysqli_query($link,$deleteP);
         }
     }
?>
</body>
<script>
        //新增商品
        $("#btnAdd").click(function(){
            location.href="newProduct.php";
        })

    let flag=true;
    $("#btnMod").click(function(){
        
        //讓管理者可以修改
        if(flag==true)
        {
            flag=false;
            <?php
                for($i=0;$i<$proTotal;$i++)
                {
            ?>
                $("input[name='pName<?=$i?>']").attr("disabled",false);
                $("input[name='price<?=$i?>']").attr("disabled",false);
                $("input[name='remain<?=$i?>']").attr("disabled",false);
                $("textarea[name='textF<?=$i?>']").attr("disabled",false);
                document.getElementById("btnSend<?=$i?>").style.display="block";
                document.getElementById("btnDel<?=$i?>").style.display="block";
            <?php
                }
            ?>
        }   
        else
        {
            flag=true;
            
            <?php
                for($i=0;$i<$proTotal;$i++)
                {
            ?>
            $("input[name='pName<?=$i?>']").attr("disabled",true);
            $("input[name='price<?=$i?>']").attr("disabled",true);
            $("input[name='remain<?=$i?>']").attr("disabled",true);
            $("textarea[name='textF<?=$i?>']").attr("disabled",true);
            document.getElementById("btnSend<?=$i?>").style.display="none";
            document.getElementById("btnDel<?=$i?>").style.display="none";
            <?php
                }
            ?>
        }
    })
</script>
</html>