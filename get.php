<?php
    session_start();
    var_dump($_POST);
    
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
    <title>Document</title>
</head>
<body>
    <script>
        alert("asd");

        //存數量 金額 總額
       function send(){
            let  countA=[4,5,6];
            let  priceA=[1,2,3];
            let  total=0;
            // for(let i=0;i< <?= $totalItem?>;i++)
            // {
            //     countA.push(Number($("#itemcount"+i).text()));
            //     priceA.push(Number($("#price"+i).text()));
            // }
            // // for(let i=0;i<priceA.length;i++)
            // // {
            // //     alert(countA[i]+"  "+priceA[i]);
            // // }
            // total=$("#alltotal").text();
            // // alert("數量:"+$("#itemcount"+i).text()+" 金額:"+$("#price"+i).text());
            // //  alert("總額:"+total);

            $.ajax({
                url:'get.php',
                type:'POST',
                data:{countA:countA,priceA:priceA,total:total},
                error:function(){alert("錯誤");},
                success:function(){alert("已傳遞，你自求多福");}
            });
            // location.href="get.php";
       }
       send();
    </script>
</body>
</html>