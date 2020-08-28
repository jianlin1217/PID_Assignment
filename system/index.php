<?php
     session_start();
     require_once("connectDB.php");
     //現在登入的人
     $_SESSION['memberAccount']=null;

    echo "12346",$txtlogin=$_POST['act'];;
     if(isset($_POST['btlogin']))
     {
            $txtlogin=$_POST['act'];
            $txtloginpwd=$_POST['pwd'];
            echo $txtlogin . " " . $txtloginpwd;
            $_SESSION['memberAccount']=$txtlogin;
            // header("location: system.php");
     }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BearBees -- 管理系統</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>

<body>
    <div class="container">

        <!-- Modal -->
        <div class="modal-backdrop fade in" id="myModal" role="dialog">
            <div class="modal-dialog" style="width:300px" >

                <!-- Modal content-->
                <form action="" method="post">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" style="color:#1708e4">熊蜂蜜管理系統-登入</h4>
                        </div>
                            <div class="modal-body">
                                <p>帳號</p>
                                <input style="width: 250px;" id="act" name="act" type="text">
                            </div>
                            <div class="modal-body">
                                <p>密碼</p>
                                <input  style="width: 250px;" id="pwd" name="pwd" type="password">
                            </div>
                        <div class="modal-footer">
                            <button type="button"  id="btlogin" name="btlogin" class="btn btn-default" i data-dismiss="modal">登入</button>
                            <!-- <button type="button" id="btnreg" name="btnreg" class="btn btn-default" i data-dismiss="modal">註冊</button> -->
                        </div>
                    </div>
                </form>
            </div>
        </div>

    </div>
</body>

</html>