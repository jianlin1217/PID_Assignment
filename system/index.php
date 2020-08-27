<?php
     require_once("connectDB.php");

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
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title" style="color:#1708e4">熊蜂蜜管理系統-登入</h4>
                        </div>
                        <div class="modal-body">
                            <p>帳號</p>
                            <input style="width: 250px;" type="text">
                        </div>
                        <div class="modal-body">
                            <p>密碼</p>
                            <input  style="width: 250px;" type="password">
                        </div>
                        <div class="modal-footer">
                            <button type="button"  class="btn btn-default" i data-dismiss="modal">登入</button>
                        </div>
                    </div>
                </form>
                
            </div>
        </div>

    </div>
</body>

</html>