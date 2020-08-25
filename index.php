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
    for($i=0;$i<10;$i++)
    {
    ?>
    <div class="wrapper outline" >
        <div class="wrapper2" id="d1">
            <img src="img/bubbleTea.jpg" alt="找不到圖片ＱＡＯ">
            <div class="mid">
                <p>珍珠奶茶（BubbleTea）$:60</p>
            </div>
        </div>
        <div class="wrapper2" id="d2">
            <button class="btn btn-success"> + </button>
            <button class="btn btn-danger"> - </button>
        </div>
        <div id="d3">
            <p class="total">總額為：</p>
        </div>
    </div>
    <?php
    }
    require_once("footer.php") 
    ?>
</body>

</html>