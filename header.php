<nav class="navbar navbar-expand-sm bg-info navbar-dark fixed-top" style="position: fixed; width:100%;  height:60px;">
            <!-- Brand/logo -->
            <a class="navbar-brand" src="" href="index.php">BearBeesʕ·ᴥ·ʔ</a>
    
            <!-- Links -->
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link" href="productInfo.php">商品介紹</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="product.php">商品選購</a>
                </li>
                <li class="nav-item" id="buyCar" style="display: none;">
                    <a class="nav-link" href="buycar.php">購物車</a>
                </li>
                <li class="nav-item" id="history" style="display: none;">
                    <a class="nav-link" href="history.php">歷史紀錄</a>
                </li>
            </ul>
            <ul class="navbar-nav">
                <img src="img/BearIcon.jpg" style="height: 60px; width:60px" alt="找不到圖片ＱＡＯ">
                <p class="nav-item " style="text-align:center ;margin-top:15px;" id="welcome">

                </p>
                <li class="nav-item ">
                    <a class="nav-link btn btn-success" style="color:black"  id="login" name="login"><?=$_SESSION['loginState']?></a>
                </li>
            </ul>
            
    
</nav>
