<!--對於被禁止的帳戶聲明並返回首頁-->
<?php
    session_start();
        if($_SESSION['accessAbility']==false&&$_SESSION['memberAccount']==null)
        {
    ?>
    <script>
        alert("請先登入!");
        location.href="index.php";
    </script>
    <?php
        }
        else if($_SESSION['accessAbility']==false)
        {
    ?>
    <script> 
        alert("對不起,"+"<?=$_SESSION['memberAccount']?>"+",您已被禁止使用管理系統");
        location.href="index.php";
        
    </script>
    <?php
        }

        
    ?>
<nav class="navbar navbar-expand-sm bg-secondary navbar-dark fixed-top" style=" position: fixed; width:100%;  height:60px;">
    <!-- Brand/logo -->
    <a class="navbar-brand" src="" href="system.php">BearBees ʕ·ᴥ·ʔ 管理系統</a>
    <ul class="navbar-nav mr-auto">
        <li class="nav-item ">
            <a id="productM" class="nav-link" href="../system/products.php">商品管理</a>
        </li>
        <li class="nav-item ">
            <a id="memberM" class="nav-link" href="../system/member.php">員工管理</a>
        </li>
        <li class="nav-item ">
            <a id="orderM" class="nav-link" href="../system/order.php">訂單管理</a>
        </li>
        <li class="nav-item ">
            <a id="reportM" class="nav-link" href="../system/report.php">報表</a>
        </li>
    </ul>
    <ul class="navbar-nav">
        <li class="nav-item ">
            <p id="whologin" style="text-align:center;" class="nav-link">現在登入： <?= $_SESSION['memberAccount'] ?> </p>
        </li>
        <li class="nav-item ">
            <button class="nav-link btn btn-success" type="submit" style="color:black" id="loginout" name="loginout">登出</button>
        </li>
        <script>
            $("#loginout").click(function() {
                location.href = "index.php";
            })
        </script>
        <?php
        if ($_SESSION['Rank'] == 1) {
        ?>
            <script>
                $("#memberM").hide();
                $("#reportM").hide();
                // alert("隱藏ＲＲＲ");
            </script>
        <?php
        }
        ?>
    </ul>


</nav>