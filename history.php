<?php
    session_start();
    require_once("connectDB.php");
    //現在登入的ID
    $nowId = $_SESSION['nowMemberId'];
    //判定是不是導向過去登入畫面
    $_SESSION['linkTo']=0;
    //存歷史ID
    $hisId;

    if ($_SESSION['nowMemberId'] != null) {
        $_SESSION['loginState'] = "登出";
        $_SESSION['loginFlag'] = "true";
    }


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <title>熊蜂蜜－BearBees 歷史清單</title>
</head>
<body>
    <?php
        require_once("header.php");
    ?>
    <div class="container" style=" margin-top: 130px;">
        <h1>點選以查看明細ʕ·ᴥ·ʔ</h1>
        <table class="table" style="width:90%;">
            <thead>
                <tr>
                    <th>訂單序號</th>
                    <th>飲品數量</th>
                    <th>總金額</th>
                    <th>日期</th>
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
                    $("#detailAll"+h).hide();
                    $("#detail"+h).show();
                }
                

                if($("#test").text()==0)
                {
                    for(let j=0;j< <?=$countHis?>;j++)
                    {
                        if(i!=j)
                        $("#detail"+j).hide();
                    }
                    $("#detailAll"+i).show();
                    $("#test").text(1);
                }
                else
                {
                    $("#detailAll"+i).hide();
                    $("#test").text(0);
                }
            })
        }
    </script>
</body>
</html>