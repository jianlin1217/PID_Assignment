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
    <title>BearBees -- 管理系統（員工）</title>
</head>
<body>
<?php
        require_once("header.php");
    ?>
    <div class="container" style=" margin-top: 130px;">
        <h1>ʕ·ᴥ·ʔ顧客明細</h1>
        <table class="table" style="width:90%;">
            <thead>
                <tr>
                    <th>客戶編號</th>
                    <th>顧客名稱</th>
                    <th>總消費金額</th>
                    <th>加入日期</th>
                    <th>是否禁用</th>
                </tr>
            </thead>
                <?php
                    $getCusInfo=<<<end
                    select * from customerList;
                    end;
                    $countCus=0;
                    $result=mysqli_query($link,$getCusInfo);
                    //計算總數量
                    $i=0;
                    while($row=mysqli_fetch_assoc($result))
                    {
                        $nowCusId=$row['customerId'];
                        $getspend=<<<end
                        select sum(total) from orderList where orderCusId=$nowCusId;
                        end;
                        $sresult=mysqli_query($link,$getspend);
                        $stotal=mysqli_fetch_assoc($sresult)['sum(total)'];
                        if($stotal==null)
                        $stotal=0;
                ?>
                <tbody>
                    <tr id="customer<?=$i?>">
                        <td><?=$row['customerId']?></td>
                        <td><?=$row['customerName']?></td>
                        <td><?=$stotal?></td>
                        <td><?=$row['joinTime']?></td>
                        <td><?=$row['customerYN']?></td>
                    </tr>
               
                </tbody> 
            <?php
                $i++;
                }
                $countCus=$i;
                global $countCus;
            ?>
        </table>
    </div>

    <?php
        require_once("footer.php");
    ?>
    <script>
         //叫出登入畫面
         $("#login").click(function() {
            document.location.href='login.php';
        })

        //購物車畫面隱藏或顯示
        <?php
            if($_SESSION['loginFlag']=="true")
            {
        ?>
        $("#buyCar").show();
        $("#history").show();
        //歡迎會員
        $("#welcome").text("welcome!!  "+"<?= $_SESSION['NowLogin']?>");
        <?php
            }
            else{
        ?>
        $("#buyCar").hide(); 
        $("#history").hide();
        $("#welcome").text("");
        <?php
            }
        ?>

        for(let i=0;i< <?=$countHis?>;i++)
        {
            $("#detail"+i).click(function(){
                // alert("明細"+i);
                for(let h=0;h< <?=$countHis?>;h++)
                {
                    if(h!=i)
                         $("#detail"+h).toggle();
                }
                
                $("#detailAll"+i).toggle();
            })
        }
    </script>
</body>
</html>