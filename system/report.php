<?php
session_start();
require_once("connectDB.php");


//抓出訂單資料
if (isset($_POST['submit'])) {
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

            <select name="type" id="type">
                <option value="產品數量">產品數量</option>
                <option value="收入表">收入表</option>
                <option value="支出表">支出表</option>
            </select>
            <button class="btn btn-primary" type="submit" id="submit" name="submit"> 統計 </button>
        </form>
        <div>
            <button class="btn btn-success" id="day" name="day">以日為單位</button>
            <button class="btn btn-success" id="month" name="month">以月為單位</button>
            <button class="btn btn-success" id="year" name="year">以年為單位</button>
        </div>
    </div>
    <div class="container">
        <table class="table">
            <?php
            //顯示報表
            if (isset($_POST['submit'])) {

                // echo $_POST['sDate'] . "   " . $_POST['eDate'] . "<br>" . $_POST['type'];
                $stime = str_replace("T", " ", $_POST['sDate']);
                $etime = str_replace("T", " ", $_POST['eDate']);
                if ($_POST['type'] == "產品數量") {
                    if($etime!=NULL&&$stime!=NULL)
                    {
                        $getreport = <<<end
                        select DISTINCT i.itemName,remainCount,saleOut,itemState,sum(od.itemCount) 
                        from itemList as i JOIN orderList as o JOIN orderDetail as od on i.itemName=od.itemName and od.orderId=o.orderId 
                        where o.orderDate between "$stime" and "$etime" 
                        GROUP BY i.itemName,remainCount,saleOut,itemState
                        end;
                        echo "開始日期:".$stime."~結束日期:".$etime;
                    }
                    else
                    {
                        $getreport = <<<end
                        select itemName,remainCount,saleOut,itemState from itemList;
                        end;
                    }

                    
            ?>
                    <tr>
                        <th>商品名稱</th>
                        <th>剩餘數量</th>
                        <th>期間銷售數量</th>
                        <th>商品狀態</th>
                    </tr>
            <?php
                    $result=mysqli_query($link,$getreport);
                    
                    while($row=mysqli_fetch_assoc($result))
                    {
                        //商品若是為刪除則跳過
                        if($row['itemState']==4)
                        continue;
                        // var_dump($row);
                        ?>
                        <tr>
                            <td><?=$row['itemName']?></td>
                            <td><?=$row['remainCount']?></td>
                            <td>
                            <?php
                                if($row['sum(od.itemCount)']==NULL)
                                echo "--";
                                else
                                echo $row['sum(od.itemCount)'];
                            ?></td>
                            <td>
                            <?php 
                                if($row['itemState']==1)
                                echo "上架中";
                                else if($row['itemState']==2)
                                echo "已下架";
                                else
                                echo "缺貨中";
                            ?>
                            </td>
                        </tr>
                        <?php
                    }
                } else if ($_POST['type'] == "收入表") {
                    $getreport = <<<end
                    select * from orderList,orderDetail where orderDate between "$stime" and "$etime"
                    end;
                } else if ($_POST['type'] == "支出表") {
                } else {
                }
                // echo $getreport;
            }
            ?>

        </table>
    </div>

    <script>
        // $("#sDate").change(function() {
        //     alert("開始時間" + $("#sDate").val());
        // })

        // $("#eDate").change(function() {
        //     alert("結束時間" + $("#eDate").val());
        // })
    </script>
</body>

</html>