<?php
session_start();
require_once("connectDB.php");

$proName = array();
$proPrice = array();
$proRemain = array();
$proMeg = array();
$procost = array();
$prostate = array();
$proImgLink=array();
$proId = array();
//產品ＩＤ
$_SESSION['pID'] = array();

//從資料庫中讀取產品
$getProduct = <<<end
    select * from itemList;
    end;
$result = mysqli_query($link, $getProduct);
while ($row = mysqli_fetch_assoc($result)) {
    //商品不為刪除才存入
    if($row['itemState']!=4)
    {
       array_push($proName, $row["itemName"]);
        array_push($proPrice, $row["itemPrice"]);
        array_push($proRemain, $row["remainCount"]);
        array_push($proMeg, $row["ItemMassage"]);
        array_push($proImgLink,$row["drinkImg"]);
        array_push($proId, $row['itemId']);
        array_push($procost, $row['itemmMaterial']);
        array_push($prostate, $row['itemState']); 
    }
    
}
$_SESSION['pID'] = $proId;
// var_dump($proName);
// var_dump($proPrice);
// var_dump($proRemain);
// var_dump($proMeg);
// var_dump($proImgLink);

//總產品數量
$proTotal = count($proName);
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
    require_once("header.php");
    ?>
    <div class="container" style="margin-top: 100px;">
        <h1>商品總覽 (修改後請點重整一下確保資料狀態為最新)</h1>
        <div class="">
            <button id="btnAdd" name="btnAdd">新增</button>
            <button id="btnMod" name="btnMod">修改</button>
            <button id="reload" name="reload">重整</button>
        </div>
        <form action="" method="post" enctype="multipart/form-data">
        <?php
        $result = mysqli_query($link, $getProduct);
        for ($i = 0; $i < $proTotal; $i++) {
            $row = mysqli_fetch_assoc($result);
        ?>            
                <div class="wrapper bound" style="margin-top: 20px;">
                    <img src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($proImgLink[$i]); ?>" alt="ＲＲＲＲ">
                    <div>
                        <input id="Img<?= $i ?>" name="Img<?= $i ?>" style="display:none; width:300px; height:30px; " type="file">
                        <div class="wrapper3 ">
                            <p>
                                商品名稱<br><br><br>
                                <input name="pName<?= $i ?>" id="pName<?= $i ?>" disabled value="<?= $proName[$i] ?>">

                            </p>
                            <p>
                                商品金額<br><br><br>
                                <input name="price<?= $i ?>" id="price<?= $i ?>" disabled value="<?= $proPrice[$i] ?>">

                            </p>
                            <p>
                                商品花費<br><br><br>
                                <input name="cost<?= $i ?>" id="cost<?= $i ?>" disabled value="<?= $procost[$i] ?>">

                            </p>
                            <p>
                                剩餘數量<br><br><br>
                                <input name="remain<?= $i ?>" id="remain<?= $i ?>" disabled value="<?= $proRemain[$i] ?> ">

                            </p>
                            <p>
                                商品狀態<br><br><br>
                                <select name="state<?= $i ?>" id="state<?= $i ?>" disabled>
                                        <?php
                                            if($prostate[$i]==1)
                                            {
                                                ?>
                                                <option value="1" selected>上架中</option>
                                                <option value="2">下架中</option>
                                                <option value="3">缺貨中</option>
                                                <?php
                                            }
                                            else if($prostate[$i]==2)
                                            {
                                                ?>
                                                <option value="1">上架中</option>
                                                <option value="2" selected>下架中</option>
                                                <option value="3">缺貨中</option>
                                                <?php
                                            }
                                            else
                                            {
                                                ?>
                                                <option value="1">上架中</option>
                                                <option value="2">下架中</option>
                                                <option value="3" selected>缺貨中</option>
                                                <?php
                                            }
                                        ?>
                                </select>
                            </p>
                        </div>
                    </div>
                    <div>
                        <p>商品描述:<br></p>
                        <textarea name="textF<?= $i ?>" id="textF<?= $i ?>" cols="24" rows="10" style="width: 200px; height:200px" disabled><?= $proMeg[$i] ?></textarea>
                        <div class="wrapper2">
                            <button id="btnDel<?= $i ?>" name="btnDel<?= $i ?>" style="display:none; float:right">刪除</button>
                            <button id="btnSend<?= $i ?>" name="btnSend<?= $i ?>" style="display:none; float:right">修改送出</button>
                        </div>

                    </div>
                </div>
              

        <?php
        }
        ?>  
            <button id="allSend" name="allSend" style="display:none; float:right">全部修改</button>
        </form>
    </div>
    <!-- php 程式碼區域 -->
    <?php
    //接收修改資料
    for ($i = 0; $i < $proTotal; $i++) {
        if (isset($_POST['btnSend' . $i])) {
            //  echo "這是第 $i 項產品";
            $Pname = $_POST['pName' . $i];
            $Pprice = $_POST['price' . $i];
            $Pcost = $_POST['cost' . $i];
            $Premain = $_POST['remain' . $i];
            $Pstate= $_POST['state' . $i];
            $Pdescribe = $_POST['textF' . $i];
            //找出原本數量為零的
            $findremain0=<<<end
            select remainCount from itemList where itemName="$Pname";
            end;
            echo $findremain0;
            $row0=mysqli_fetch_assoc(mysqli_query($link,$findremain0));
            // echo empty($_FILES["Img$i"]["name"]);
            //圖片修改
            //  var_dump($_FILES["Img$i"]["name"]);
            if (empty($_FILES["Img$i"]["name"]) != 1) {
                $name = $_FILES["Img$i"]["name"];
                // echo $name . "ddd";
                //取得檔案資訊  ＊＊＊＊
                $fileName = basename($name);
                $fileType = pathinfo($name, PATHINFO_EXTENSION);
                // echo "<br>".$fileName."     ".$fileType;
                $allowTypes = array('jpg', 'png', 'jpeg');
                if (in_array($fileType, $allowTypes)) {
                    $image = $_FILES["Img$i"]['tmp_name'];
                    // echo $image;
                    $imgContent = addslashes(file_get_contents($image));
                    // echo $imgContent;
                    //修改資料傳送資料庫
                    $modify = <<<end
                    update itemList set itemPrice = $Pprice,itemmMaterial=$Pcost,itemState=$Pstate , itemName = "$Pname" , remainCount = $Premain ,ItemMassage = "$Pdescribe",drinkImg="$imgContent" where itemId = $proId[$i] ;
                    end;
                }
            }
            else
            {
                    $modify = <<<end
                    update itemList set itemPrice = $Pprice ,itemmMaterial=$Pcost,itemState=$Pstate, itemName = "$Pname" , remainCount = $Premain ,ItemMassage = "$Pdescribe" where itemId = $proId[$i] ;
                    end;
            }
            mysqli_query($link, $modify);
              //若是商品改為非上架狀態,連帶改變購物車品項顯示
              if($Pstate!=1)
              {
                  $deleteCar =<<<end
                  update shopCar set buyCan="N" where buyItemId = $proId[$i];
                  end;
                  mysqli_query($link,$deleteCar);
  
              }
              else
              {
                  $deleteCar =<<<end
                  update shopCar set buyCan="Y" where buyItemId = $proId[$i];
                  end;
                  mysqli_query($link,$deleteCar);
              }
              //更改商品數量小於零的商品為缺貨中
              $notenough=<<<end
              update itemList set itemState=3 where remainCount <=0;
              end;
            //   echo $notenough;
              mysqli_query($link,$notenough);
              //商品數量大於零且原本等於零則自動變為下架中
              if($row0['remainCount']==0)
              {
                $enough=<<<end
                update itemList set itemState=2 where remainCount >0;
                end;
                mysqli_query($link,$enough);
              }
               
        }
    }
    //全部商品一起修改
    if(isset($_POST['allSend']))
    {
        for ($i = 0; $i < $proTotal; $i++) {
                //  echo "這是第 $i 項產品";
                $Pname = $_POST['pName' . $i];
                $Pprice = $_POST['price' . $i];
                $Pcost = $_POST['cost' . $i];
                $Premain = $_POST['remain' . $i];
                $Pstate= $_POST['state' . $i];
                $Pdescribe = $_POST['textF' . $i];
                 //找出原本數量為零的
                $findremain0=<<<end
                select remainCount from itemList where itemName="$Pname";
                end;
                // echo $findremain0;
                $row0=mysqli_fetch_assoc(mysqli_query($link,$findremain0));
                // echo empty($_FILES["Img$i"]["name"]);
                //圖片修改
                //  var_dump($_FILES["Img$i"]["name"]);
                if (empty($_FILES["Img$i"]["name"]) != 1) {
                    $name = $_FILES["Img$i"]["name"];
                    // echo $name . "ddd";
                    //取得檔案資訊  ＊＊＊＊
                    $fileName = basename($name);
                    $fileType = pathinfo($name, PATHINFO_EXTENSION);
                    // echo "<br>".$fileName."     ".$fileType;
                    $allowTypes = array('jpg', 'png', 'jpeg');
                    if (in_array($fileType, $allowTypes)) {
                        $image = $_FILES["Img$i"]['tmp_name'];
                        // echo $image;
                        $imgContent = addslashes(file_get_contents($image));
                        // echo $imgContent;
                        //修改資料傳送資料庫
                        $modify = <<<end
                        update itemList set itemPrice = $Pprice,itemmMaterial=$Pcost,itemState=$Pstate , itemName = "$Pname" , remainCount = $Premain ,ItemMassage = "$Pdescribe",drinkImg="$imgContent" where itemId = $proId[$i] ;
                        end;
                    }
                }
                else
                {
                        $modify = <<<end
                        update itemList set itemPrice = $Pprice ,itemmMaterial=$Pcost,itemState=$Pstate, itemName = "$Pname" , remainCount = $Premain ,ItemMassage = "$Pdescribe" where itemId = $proId[$i] ;
                        end;
                }
                //  echo $modify."<br>";
                mysqli_query($link, $modify);
                //若是商品改為非上架狀態,連帶改變購物車品項顯示
                if($Pstate!=1)
                {
                    $deleteCar =<<<end
                    update shopCar set buyCan="N" where buyItemId = $proId[$i];
                    end;
                    mysqli_query($link,$deleteCar);
    
                }
                else
                {
                    $deleteCar =<<<end
                    update shopCar set buyCan="Y" where buyItemId = $proId[$i];
                    end;
                    mysqli_query($link,$deleteCar);
                }
                //更改商品數量小於零的商品為缺貨中
                $notenough=<<<end
                update itemList set itemState=3 where remainCount <=0;
                end;
                // echo $notenough;
                mysqli_query($link,$notenough);
                 //商品數量大於零且原本等於零則自動變為下架中
                //  echo $row0['remainCount']."<br>";
                if($row0['remainCount']==0)
                {
                    // echo "OAO<br>";
                    $enough=<<<end
                    update itemList set itemState=2 where remainCount >0 and itemName="$Pname";
                    end;
                    mysqli_query($link,$enough);
                }
            
        }
    }
    //刪除商品
    for ($i = 0; $i < $proTotal; $i++) {
        if (isset($_POST['btnDel' . $i])) {
            //刪除商品 改商品狀態為4 不會再顯示
            $deleteP = <<<end
            update itemList set itemState=4 where itemId = $proId[$i] ;
            end;
            mysqli_query($link, $deleteP);
            $deleteCar =<<<end
            update shopCar set buyCan="N" where buyItemId = $proId[$i];
            end;
            mysqli_query($link,$deleteCar);
        }
    }
    ?>
</body>
<script>
    //新增商品
    $("#btnAdd").click(function() {
        location.href = "newProduct.php";
    })
    //重整網頁
    $("#reload").click(function(){
        location.href = "products.php";
    })

    let flag = true;
    $("#btnMod").click(function() {

        //讓管理者可以修改
        if (flag == true) {
            flag = false;
            <?php
            for ($i = 0; $i < $proTotal; $i++) {
            ?>
                $("input[name='pName<?= $i ?>']").attr("disabled", false);
                $("input[name='price<?= $i ?>']").attr("disabled", false);
                $("input[name='cost<?= $i ?>']").attr("disabled", false);
                $("input[name='remain<?= $i ?>']").attr("disabled", false);
                $("select[name='state<?= $i ?>']").attr("disabled", false);
                $("textarea[name='textF<?= $i ?>']").attr("disabled", false);
                document.getElementById("btnSend<?= $i ?>").style.display = "block";
                document.getElementById("allSend").style.display = "block";
                document.getElementById("btnDel<?= $i ?>").style.display = "block";
                document.getElementById("Img<?= $i ?>").style.display = "block";
            <?php
            }
            ?>
        } else {
            flag = true;

            <?php
            for ($i = 0; $i < $proTotal; $i++) {
            ?>
                $("input[name='pName<?= $i ?>']").attr("disabled", true);
                $("input[name='price<?= $i ?>']").attr("disabled", true);
                $("input[name='cost<?= $i ?>']").attr("disabled", true);
                $("input[name='remain<?= $i ?>']").attr("disabled", true);
                $("select[name='state<?= $i ?>']").attr("disabled", true);
                $("textarea[name='textF<?= $i ?>']").attr("disabled", true);
                document.getElementById("btnSend<?= $i ?>").style.display = "none";
                document.getElementById("allSend").style.display = "none";
                document.getElementById("btnDel<?= $i ?>").style.display = "none";
                document.getElementById("Img<?= $i ?>").style.display = "none";
            <?php
            }
            ?>
        }
    })
</script>

</html>