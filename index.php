<?php
    session_start();
    $_SESSION['itemNum']=0;
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
    <title>熊蜂蜜－沁涼飲</title>
</head>

<body>
    <?php
    require_once("header.php");
    for ($i = 1; $i < 5; $i++) {
    ?>
        <div class="wrapper outline">
            <div class="wrapper2" id="d1">
                <img src="img/bubbleTea.jpg" alt="找不到圖片ＱＡＯ">
                <div class="mid">
                    <p>珍珠奶茶(BubbleTea)</p><p id="price<?=$i?>" name="price">60</p>
                    
                </div>
            </div>
            <div class="wrapper" id="d2">
                <div class="mid">
                    <button class="btn btn-success" id="btnadd<?=$i?>" name="btnadd"> + </button>
                </div>
                <div style="margin-top: 80%;">
                    <p id="itemcount<?=$i?>" name="itemcount" >0</p>
                </div>
                <div class="mid">
                    <button class="btn btn-danger" id="btnsub<?=$i?>" name="btnsub"> - </button>
                </div>
            </div>
            <div class="wrapper2" id="d3">
                <div style="margin-top: 40%;">
                    <p class="total">總額為：</p>
                </div>
                <div style="margin-top: 40%;">
                    <p class="total" id="totalm<?=$i?>" name="totalm">0</p>
                </div>

            </div>
        </div>
    <?php
    }
    require_once("footer.php")
    ?>
    <script>
            $("button[name='btnadd']").click(function(){
                let count;
                let nowid=$(this).attr("id").replace("btnadd","");
                
                // alert(nowid);
                item="#itemcount"+nowid;
                total="#totalm"+nowid;
                price="#price"+nowid;
                // alert(item);

                count=$(item).text();
                count++;
                $(item).text(count);
                $(total).text($(price).text()*count);
                
            })
            $("button[name='btnsub']").click(function(){
                let count;
                let nowid=$(this).attr("id").replace("btnsub","");
                
                // alert(nowid);
                item="#itemcount"+nowid;
                total="#totalm"+nowid;
                price="#price"+nowid;
                // alert(item);

                count=$(item).text();
                if(count>0)
                count--;
                $(item).text(count);
                $(total).text($(price).text()*count);
                
            })

    </script>
</body>

</html>