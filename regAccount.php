<?php
session_start();
require("connectDB.php");
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
    <title>熊蜂蜜會員註冊BearBeesʕ·ᴥ·ʔ</title>
</head>

<body>
    <div class="container">
        <h1>註冊</h1>
        <form method="post" action="">
            <div class="form-group row">
                <label for="act" class="col-4 col-form-label">暱稱(登入時顯示該名稱)</label>
                <div class="col-8">
                    <input id="name" name="name" type="text" class="form-control" required>
                </div>
            </div>
            <div class="form-group row">
                <label for="act" class="col-4 col-form-label">帳號(Account)2~20碼，開頭需為英文</label>
                <div class="col-8">
                    <input id="act" name="act" type="text" class="form-control" pattern="\D{1}\w{1,19}" required>
                </div>
            </div>
            <div class="form-group row">
                <label for="pwd" class="col-4 col-form-label">密碼(Password)6~20碼</label>
                <div class="col-8">
                    <input id="pwd" name="pwd" type="password" class="form-control" pattern="\w{6,20}" required>
                </div>
            </div>
            <div class="form-group row">
                <label for="Phone" class="col-4 col-form-label">手機(Telephone)</label>
                <div class="col-8">
                    <input id="Phone" name="Phone" type="text" class="form-control" pattern="\d{10}|0[2-8][2-9]*[6]*-\d{7}" required>
                </div>
            </div>
            <div class="form-group row">
                <label for="email" class="col-4 col-form-label">信箱(Email)</label>
                <div class="col-8">
                    <input id="email" name="email" type="text" class="form-control" pattern="\w+[-]*\w+@+\w+[.]*\w+[.]*\w+[.]*\w+" required>
                </div>
            </div>
            <div class="form-group row">
                <label for="address" class="col-4 col-form-label">居住地(Address)(可不填)</label>
                <div class="col-8">
                    <input id="address" name="address" type="text" class="form-control">
                </div>
            </div>
            <div class="form-group row">
                <div class="offset-4 col-8">
                    <input name="reg" id="register" value="送出" type="submit" class="btn btn-primary"></input>
                    <button name="submit" id="backIndex" type="button" class="btn btn-success">返回登入</button>
                </div>
            </div>
        </form>
        <?php
        if (isset($_POST['reg'])) {
            $cName = $_POST['name'];
            $cAct = $_POST['act'];
            $cPass = $_POST['pwd'];
            $cAddress = $_POST['address'];
            $cPhone = $_POST['Phone'];
            $cMail = $_POST['email'];
            $sameAsk = <<<end
                    select customerAccount from customerList where customerAccount="$cAct";
                    end;
            // echo mysqli_query($link,$sameAsk)."123456";
            // var_dump(mysqli_fetch_assoc(mysqli_query($link,$sameAsk)));

            //若SQL請求有值代表已有重複的帳號存在
            if (mysqli_fetch_assoc(mysqli_query($link,$sameAsk))!= null) {
        ?>
                <script>
                    alert("已有相同帳號註冊！！");
                </script>
            <?php
            } 
            else {
                //現在時間
                date_default_timezone_set("Asia/Taipei");
                $nowDate = date("Y-m-d H:i:s");
                $regText=<<<end
                insert into customerList
                (customerName,customerAccount,customerPassword,customerAddress,customerPhone,customerMail,joinTime)
                VALUES
                ("$cName","$cAct","$cPass","$cAddress","$cPhone","$cMail","$nowDate");
                end;
                // echo $regText;
                // 存到資料庫中
                $result=mysqli_query($link,$regText);
                var_dump($result);   
            ?>
                <script>
                    alert("註冊成功！");
                    location.href="login.php";
                </script>
        <?php
            }
        }
        ?>
    </div>
    <script>
        $("#backIndex").click(function() {
            location.href = "login.php";
        })
    </script>
</body>

</html>