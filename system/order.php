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
    <title>BearBees -- 管理系統（訂單）</title>
</head>
<body>
    <?php
        require_once("header.php");
    ?>
    <div class="container" style="margin-top:130px">
        <h1>訂單明細</h1>
        <button id="btnfin">顯示已完成訂單</button>
        <table class="table" style="width:100%;">
            <thead>
                <tr>
                    <th>訂單編號</th>
                    <th>顧客名稱</th>
                    <th>下訂時間</th>
                    <th>訂單負責人</th>
                    <th>是否完成</th> 
                    <th>完成日期</th>
                </tr>
            </thead>
            <tbody>
            <?php
                //訂單顯示  若是已經完成則隱藏起來
                $askOrder=<<<end
                select orderId,total,orderCusId,orderDate,orderManageId,finishYN from orderList;
                end;
                $result=mysqli_query($link,$askOrder);
                $countorder=0;
                global $countorder;
                while($row=mysqli_fetch_assoc($result))
                {
                    $cID=$row['orderCusId'];
                    $getName=<<<end
                    select customerName from customerList where customerId=$cID;
                    end;
                    $row2=mysqli_fetch_assoc(mysqli_query($link,$getName));
            ?>
                <tr id="detial<?=$countorder?>">
                    <td><?=$row['orderId']?></td>
                    <td><?=$row2['customerName']?></td>
                    <td><?=$row['orderDate']?></td>
                    <td></td>
                    <td id="YN<?=$countorder?>" value="<?=$row['finishYN']?>">
                        <?php
                        if($row['finishYN']=="Y")
                        {
                            echo "完成";
                        }
                        else
                        {
                            echo "尚未完成";
                        }
                        ?>
                    </td>
                    <td></td>
                </tr>
            <?php
                $countorder++;
                }
            ?>
            </tbody>
        </table>
    </div>
<script>
    for(let i=0;i< <?=$countorder?>;i++)
    {
        // alert($("#YN"+i).text());
        //隱藏尚未完成的訂單
        if($("#YN"+i).text().search("尚未完成")==-1)
        {
            $("#detial"+i).hide();
        }
    }
    let flag=1;
    $("#btnfin").click(function(){
        for(let i=0;i< <?=$countorder?>;i++)
        {
        //顯示完成的訂單
            if($("#YN"+i).text().search("尚未完成")==-1)
            {
                $("#detial"+i).toggle();
                
            }
            else 
            {
                // alert($("#YN"+i).text().search("尚未完成"));
                $("#detial"+i).toggle();
            }
        }
        if(flag==1)
        {
         $("#btnfin").text("隱藏已完成訂單");
         flag=0;
        }
        else
        {
            $("#btnfin").text("顯示已完成訂單");
            flag=1;
        }
    })
</script>
</body>

</html>