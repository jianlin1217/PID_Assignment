<?php
    session_start();
    //讀取資料庫的顧客資料
    require_once("connectDB.php");
    $_SESSION['cAccount']=Array();     //資料庫中有的使用者名稱
    $_SESSION['cPass']=Array();     //資料庫中有的使用者密碼
    $_SESSION['cId']=Array();       //資料庫存的使用者編號

    $commandText=<<<End
    select * from customerList;
    End;
    $result = mysqli_query($link,$commandText);
    //檢測是不是有登入了  已經是登入狀態則登出並返回首頁
    if( $_SESSION['nowMemberId']!=null)
    {
      $_SESSION['NowLogin']=null;     
      $_SESSION['nowMemberId']=null;
      header("location: index.php");
    }

    // var_dump($result);
    while($row=mysqli_fetch_assoc($result))
    {
            Array_push($_SESSION['cAccount'],$row["customerAccount"]);
            Array_push($_SESSION['cPass'],$row["customerPassword"]);
            Array_push($_SESSION['cId'],$row["customerId"]);
    }

    //儲存使用者名稱及密碼方便比對
    $compareAccount=$_SESSION['cAccount'];
    $comparePass=$_SESSION['cPass'];
    $compareId=$_SESSION['cId'];
    // var_dump($compareId);
    
    if(isset($_POST['Reg']))
    {
        header("location: regAccount.php");
    }
    if(isset($_POST['Index']))
    {
        header("location: index.php");
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
    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <title>熊蜂蜜-登入</title>
</head>

<body>
    <?php
      //檢測是不是還沒登入  非登入狀態則返回登入頁
      if ($_SESSION['nowMemberId'] == null&&$_SESSION['linkTo']==1) {
    ?>
    <script>
      alert("請先登入以便選購！！");
    </script>
    <?php
      $_SESSION['linkTo']=0;
      }
    ?>
<div class="container">
    <h1>熊蜂蜜-登入</h1>
    <form method="post" >
      <div class="form-group row">
        <label for="act" class="col-4 col-form-label">帳號(Account)</label> 
        <div class="col-8">
          <div class="input-group">
            <div class="input-group-prepend">
              <div class="input-group-text">
                <i class="fa fa-address-card"></i>
              </div>
            </div> 
            <input id="act" name="act" type="text" class="form-control" >
          </div>
        </div>
      </div>
      <div class="form-group row">
        <label for="pwd" class="col-4 col-form-label">密碼(Password)</label> 
        <div class="col-8">
          <input id="pwd" name="pwd" type="password" class="form-control" >
        </div>
      </div>
      <div class="form-group row">
        <label class="col-4"></label> 
        <div class="col-8">
          <div class="custom-control custom-checkbox custom-control-inline">
            <input name="checkbox" id="checkbox_0" type="checkbox" class="custom-control-input" value="remember"> 
            <label for="checkbox_0" class="custom-control-label">記住帳號</label>
          </div>
        </div>
      </div> 
      <div class="form-group row">
        <div class="offset-4 col-8">
          <input value="登入" type="submit" id="btnLogin" name="Login" class="btn btn-primary">  </input>
          <input value="註冊" type="submit" id="btnReg" name="Reg" class="btn btn-success">  </input>
          <input value="回首頁" type="submit" id="btnIndex" name="Index" class="btn btn-warning">  </input>
          <!-- <a name="forget" href="">忘記密碼？</a> -->
        </div>
      </div>
    </form>
</div>
<?php
//登入
if(isset($_POST['Login']))
    {
        for($i=0;$i<count($compareAccount);$i++)
        {
            if($compareAccount[$i]==$_POST['act']&&$comparePass[$i]==$_POST['pwd'])
            {
                $_SESSION['nowMemberId']=$compareId[$i];
                $askName=<<<end
                select customerName from customerList where customerAccount ="$compareAccount[$i]"
                end;
                $row=mysqli_fetch_assoc(mysqli_query($link,$askName));
                $_SESSION['NowLogin']=$row['customerName'];
                header("location: index.php");
            }
        }
        ?>
        <script>
          alert("帳號或密碼錯誤！ 登入失敗");
        </script>
        <?php
    }
  ?>
</body>

</html>