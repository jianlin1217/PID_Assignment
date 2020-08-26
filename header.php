<nav class="navbar navbar-expand-sm bg-info navbar-dark fixed-top" style="position: fixed; width:100%;  height:60px;">
            <!-- Brand/logo -->
            <a class="navbar-brand" src="" href="index.php">BearBeesʕ·ᴥ·ʔ</a>
    
            <!-- Links -->
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link" href="#">商品介紹</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">商品選購</a>
                </li>
                <li class="nav-item" id="buyCar" style="display: none;">
                    <a class="nav-link" href="#">購物車</a>
                </li>
                <li class="nav-item" id="history" style="display: none;">
                    <a class="nav-link" href="#">歷史紀錄</a>
                </li>
            </ul>
            <ul class="navbar-nav">
                <p class="nav-item " id="welcome">

                </p>
                <li class="nav-item ">
                    <a class="nav-link btn btn-success" style="color:black"  id="login" name="login"><?=$_SESSION['loginState']?></a>
                </li>
            </ul>
    
</nav>