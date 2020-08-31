<?php
     session_start();
     require_once("connectDB.php");
     //現在登入的人
     $_SESSION['memberAccount']=null;
     $_SESSION['accessAbility']=false;
     $_SESSION['memberId']=null;

    // echo "12346",$txtlogin=$_POST['act'];;
    // $_POST['btnlogin']=1;
    
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php
        if(isset($_POST['btnlogin']))
        {
               $txtlogin=$_POST['act'];
               $txtloginpwd=$_POST['pwd'];
               $getM=<<<end
               select memberName,memberId,memberYN from memberList where memberAccount = "$txtlogin" AND memberPassword = "$txtloginpwd";
               end;
               $result=mysqli_query($link,$getM);
               $row=mysqli_fetch_assoc($result);
            //    var_dump($row);
               if($row!=NULL&&$row['memberYN']!="N")
               {
                   //存放登入者的名字
                   $_SESSION['memberAccount']=$row['memberName'];
                   $_SESSION['memberId']=$row['memberId'];
                   $_SESSION['accessAbility']=true;
                //    echo "登入成功";
                   header("location: system.php");
               }
               else if($row!=NULL&&$row['memberYN']=="N")
               {
                   //存放登入者的名字
                   $_SESSION['memberAccount']=$row['memberName'];
                //    echo "被禁止使用的";
                   header("location: system.php");
               }
               else
               {
               ?>
               <script>
                   alert("輸入帳號或密碼錯誤");
               </script>
    <?php  
               }         
        }
    ?>
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
                            <h4 class="modal-title" style="color:#1708e4">BearBees 熊蜂蜜管理系統-登入</h4>
                        </div>
                            <div class="modal-body">
                                <p>帳號</p>
                                <input style="width: 250px;" id="act" name="act" type="text" class="form-control" >
                            </div>
                            <div class="modal-body">
                                <p>密碼</p>
                                <input  style="width: 250px;" id="pwd" name="pwd" type="password" class="form-control" >
                            </div>
                        <div class="modal-footer">
                            <button   id="btnlogin" name="btnlogin" class="btn btn-primary" >登入</button>
                            <!-- <button type="button" id="btnreg" name="btnreg" class="btn btn-default" i data-dismiss="modal">註冊</button> -->
                        </div>
                    </div>
                </form>
            </div>
        </div>
        
    </div>
</body>

</html>