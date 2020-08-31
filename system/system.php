<?php
    session_start();
    require_once("connectDB.php");
    //管理階級
    $_SESSION['Rank']=0;
    //獲取管理階級
    $mId=$_SESSION['memberId'];
    $getRank=<<<end
    select rankId from memberList where memberId = $mId;
    end;
    $result=mysqli_query($link,$getRank);
    $_SESSION['Rank']=mysqli_fetch_assoc($result)['rankId'];
    echo $_SESSION['Rank'];
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
    <title>BearBees -- 管理系統</title>
</head>
<body>
    <?php 
        require_once("header.php");
    ?>


    <script>
        $("#whologin").show();
        
    </script>
</body>
</html>