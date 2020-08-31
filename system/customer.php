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
                    <th>顧客名稱</th>
                    <th>總消費金額</th>
                    <th>加入日期</th>
                    <th>是否禁用</th>
                </tr>
            </thead>
                <?php
                    $getHis=<<<end
                    select hisListId,hisToatl,hisItemCount,hisDate from hisList where whoBuyId=$nowId;
                    end;
                    // echo $getHis;
                    $countHis=0;
                    $result=mysqli_query($link,$getHis);
                    $i=0;
                    while($row=mysqli_fetch_assoc($result))
                    {
                        $nowHisId=$row['hisListId'];
                ?>
                <tbody>
                    <tr id="detail<?=$i?>">
                        <td><?=$row['hisListId']?></td>
                        <td><?=$row['hisItemCount']?></td>
                        <td><?=$row['hisToatl']?></td>
                        <td><?=$row['hisDate']?></td>
                    </tr>
               
                </tbody> 
            <?php
                $i++;
                }
                $countHis=$i;
                global $countHis;
            ?>
        </table>
        <?php
            $result=mysqli_query($link,$getHis);
            $i=0;
            while($row=mysqli_fetch_assoc($result))
            {
                $nowHisId=$row['hisListId'];
        ?>
        <table id="detailAll<?=$i?>" type="table" style="width:90%; display:none; margin-bottom:130px;">
                            <p style="display: none;" id="test">0</p>
                            <tr>
                                <th>飲品名稱</th>
                                <th>飲品金額</th>
                                <th>飲品數量</th>
                                <th>金額</th>
                            </tr>
                            <?php
                                $getdetailDB=<<<end
                                select itemName,itemPrice,itemCount from orderDetail where orderId=$nowHisId;
                                end;
                                $result2=mysqli_query($link,$getdetailDB);
                                while($row2=mysqli_fetch_assoc($result2))
                                {
                            ?>
                            <tr>
                                    <td><?=$row2['itemName']?></td>
                                    <td><?=$row2['itemPrice']?></td>
                                    <td><?=$row2['itemCount']?></td>
                                    <td><?=$row2['itemPrice']*$row2['itemCount']?></td>
                            </tr>
                            <?php
                                }
                            ?>
         </table>
         <?php
            $i++;
            }
         ?>
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