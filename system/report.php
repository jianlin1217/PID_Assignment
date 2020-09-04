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
    <title>BearBees -- 管理系統（報表）</title>
</head>
<body>
    <?php
        require_once("header.php");
    ?>
    <div class="container" style="margin-top: 130px;">
        <form action="" method="post">
            <h1>報表</h1>
            <label for="sDate">開始時間</label>
            <input type="datetime-local" name="sDate" id="sDate">
            <label for="eDate">結束時間</label>
            <input type="datetime-local" name="eDate" id="eDate">
            
            <select name="" id="">
                <option value="產品數量">產品數量</option>
                <option value="總收入">總收入</option>
                <option value=""></option>
                <option value="">4</option>
            </select>
            <button class="btn btn-primary" type="submit" id="submit" name="submit"> 統計 </button>
        </form>
    </div>
    <table>
        <td>
            <th>日期</th>
            <th>已售出</th>
            <th>剩餘數量</th>
            <th></th>
        </td>
    </table>
    <script>
        $("#sDate").change(function(){
            alert("開始時間"+$("#sDate").val());
        })

        $("#eDate").change(function(){
            alert("結束時間"+$("#eDate").val());
        })
    </script>
</body>
</html>