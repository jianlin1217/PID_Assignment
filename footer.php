<nav class="navbar navbar-expand-sm bg-info navbar-dark fixed-bottom" style="position: fixed; width:100%;height:70px;">

            <!-- Links -->
            <ul class="navbar-nav mr-auto">
                
            </ul>
            <ul class="navbar-nav">
                <li class="nav-item">
                    <input style="font-size:30px; display: none; position:relative" type="text" id="pickdate">
                </li>
                <li class="nav-item mr-auto" >
                    <p class="total all" type="" style="font-size:30px; display: none; position:relative" id="alltotalN">總計: </p>
                </li>
                <li class="nav-item mr-auto" >
                    <p class="total all" type="" style="font-size:30px; display: none; position:relative" id="alltotal">0</p>
                </li>
                <li class="nav-item">
                    <form action="" method="post">
                        <button style="display: none; margin-top:20px; width:70px; height:50px; font-size:small" class="btn btn-success" name="buyorder"  id="icon" alt="can't find picture">結帳</button>
                        <input type="text" name="btotal" id="btotal" style="display: none;">
                        <?php
                                for($h=0;$h<$totalItem;$h++)
                                {
                        ?>
                                <input type="text" name="bcount<?=$h?>" id="bcount<?=$h?>" style="display: none;">
                                <input type="text" name="bname<?=$h?>" id="bname<?=$h?>" style="display: none;">
                        <?php
                                }
                        ?>
                    </form>
                </li>
            </ul>
    </nav>  
    
