<?php
session_start();
require_once("connectDB.php");

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
    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <title>BearBees -- 管理系統(新增商品)</title>
</head>

<body>

    <nav class="navbar navbar-expand-sm bg-secondary navbar-dark fixed-top" style=" position: fixed; width:100%;  height:60px;">
        <a class="navbar-brand" src="" href="system.php">BearBees ʕ·ᴥ·ʔ 管理系統</a>
        <ul class="navbar-nav mr-auto">

        </ul>
        <ul class="navbar-nav">
            <li class="nav-item ">
                <p id="whologin" style="text-align:center;" class="nav-link">現在登入： <?= $_SESSION['memberAccount'] ?> </p>
            </li>
            <li class="nav-item ">
                <button class="nav-link btn btn-success" type="submit" style="color:black" id="loginout" name="loginout">登出</button>
            </li>
            <script>
                $("#loginout").click(function() {
                    location.href = "index.php";
                })
            </script>
    </nav>
    <form action="" method="POST" enctype="multipart/form-data">
         <div class="container" style="margin-top:130px">
        <h1>上傳圖片ʕ·ᴥ·ʔ</h1>
        <input type="file" name="image" class="btn btn-success">
    </div>
    <div class="container">
        <label for="Pname">飲品名稱</label><br>
        <input type="text" name="Pname" id="Pname" required="required"><br>
        <label for="Pprice">飲品價錢</label><br>
        <input type="text" name="Pprice" id="Pprice" required="required" pattern="\w{1,3}"><br>
        <label for="Pdes">飲品描述</label><br>
        <textarea name="Pdes" id="Pdes" cols="30" rows="10" required="required"></textarea><br>
        <input class="btn btn-success" type="submit" name="new" ></input>
    </div>
        
    </form>
   
    <?php
    if (isset($_POST["new"])) {
        // echo "123";
        if (!empty($_FILES["image"]["name"])) {
            //取得檔案資訊  ＊＊＊＊
            $fileName = basename($_FILES["image"]["name"]);
            $fileType = pathinfo($fileName, PATHINFO_EXTENSION);
            // echo "123";
            // 允許的圖檔格式
            $allowTypes = array('jpg', 'png', 'jpeg');
            if (in_array($fileType, $allowTypes)) {
                $image = $_FILES['image']['tmp_name'];
                $imgContent = addslashes(file_get_contents($image));

                $n=$_POST['Pname'];
                $p=$_POST['Pprice'];
                $m=$_POST['Pdes'];
                //確認產品有無重複
                $same=<<<end
                select itemId from itemList where itemName = "$n";
                end;
                // echo $same;
                $result=mysqli_query($link,$same);
                $row=mysqli_fetch_assoc($result);

                if(true)
                {

                // 將產品資料上傳到資料庫 
                // $re=<<<end
                //  update itemList set drinkImg = '$imgContent' where itemId = 4;
                //  end;
                $addProduct=<<<end
                insert into itemList
                (itemName,itemPrice,ItemMassage,drinkImg)
                values
                ("$n",$p,"$m","$imgContent");
                end;
                // echo $addProduct;
                $result=mysqli_query($link,$addProduct);
                header("location: products.php");
                }
                
                else
                {
                    ?>
                    <script>
                        alert("產品重複！！");
                    </script>
                    <?php
                }
                
                
            }
            
        }
    }

    ?>
</body>

</html>