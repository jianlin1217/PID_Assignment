<nav class="navbar navbar-expand-sm bg-info navbar-dark fixed-bottom" style="position: fixed; width:100%;height:70px;">

            <!-- Links -->
            <ul class="navbar-nav mr-auto">
                
            </ul>
            <ul class="navbar-nav">
                <li class="nav-item">
                    <input style="font-size:30px; display: none; position:relative" type="text" id="pickdate">
                </li>
                <li class="nav-item mr-auto" >
                    <p class="total all" type="" style="display: none; margin-top:20px;margin-right:30px; width:100px; height:50px; font-size:30px; position:relative" id="alltotalN">總計: </p>
                </li>
                <li class="nav-item mr-auto" >
                    <p class="total all" type="" style="display: none; margin-top:20px; width:50px; height:50px; font-size:30px; position:relative" id="alltotal">0</p>
                </li>
                <li class="nav-item">
                    <form  action="" method="post">
                        <label  style="display: none; margin-top:20px; margin-left:20px; width:200px; height:50px; font-size:30px; position:relative" id="label" for="hopedate">希望送達時間</label>
                        <input style="display: none; margin-top:20px; width:200px; height:50px; font-size:small" type="datetime-local" name="hopedate" id="hopedate">
                        <button style="display: none; margin-top:20px; width:70px; height:50px; font-size:small" class="btn btn-success" name="buyorder"  id="icon">結帳</button>
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
    
