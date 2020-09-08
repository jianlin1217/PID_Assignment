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
    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.3/dist/Chart.min.js"></script>
    <title>BearBees -- 管理系統（報表）</title>
</head>

<body>
    <?php
    require_once("header.php");
    ?>
    <div class="container" style="margin-top: 130px;">
        <form action="" method="post">
            <h1>報表</h1>
            <label for="sDate">開始時間</label>
            <input type="datetime-local" name="sDate" id="sDate">
            <label for="eDate">結束時間</label>
            <input type="datetime-local" name="eDate" id="eDate">

            <select name="type" id="type">
                <option value="產品數量">產品數量</option>
                <option value="收入表">收入表</option>
                <option value="支出表">支出表</option>
            </select>

            <select name="daytype" id="daytype">
                <option value="0">請選擇</option>
                <option value="1">1天</option>
                <option value="7">7天</option>
                <option value="30">30天</option>
            </select>
            <button class="btn btn-primary" type="submit" id="submit" name="submit"> 統計 </button>
        </form>

    </div>
    <div class="container">
        <table class="table">
            <?php
            //顯示報表
            if (isset($_POST['submit'])) {
                
                // echo $_POST['daytype'];
                $stime = str_replace("T", " ", $_POST['sDate']);
                $etime = str_replace("T", " ", $_POST['eDate']);
                if($_POST['daytype']!=0)
                {
                    date_default_timezone_set("Asia/Taipei");
                    $now=date("Y-m-d");
                    $post;
                    switch($_POST['daytype'])
                    {
                        case 1:
                            $stime=$now;
                            $etime=date("Y-m-d",strtotime("+1 day"));
                            $post="日報表";
                        break;
                        case 7:
                            $w=date("w");
                            $w--;
                            $wd=7-$w;
                            $stime=date("Y-m-d",strtotime("-$w day"));
                            $etime=date("Y-m-d",strtotime("+$wd day"));
                            $post="週報表";
                        break;
                        case 30:
                            $stime=date("Y-m-01");
                            $etime=date("Y-m-01",strtotime("+1 month"));
                            $post="月報表";
                        break;
                    }
                    
                    ?>
                    <p style="text-align: center; font-size:30px">
                    <?php
                        echo $post;
                    ?>
                    </p>
                    <?php
                }
                if ($_POST['type'] == "產品數量") {
                    if ($etime != NULL && $stime != NULL) {
                        $getreport = <<<end
                        select DISTINCT i.itemName,remainCount,saleOut,itemState,sum(od.itemCount) 
                        from itemList as i JOIN orderList as o JOIN orderDetail as od on i.itemName=od.itemName and od.orderId=o.orderId 
                        where o.orderDate between "$stime" and "$etime" 
                        GROUP BY i.itemName,remainCount,saleOut,itemState
                        end;
                        echo "開始日期:" . $stime . "~結束日期:" . $etime;
                        
                    } else {
                        $getreport = <<<end
                        select itemName,remainCount,saleOut,itemState from itemList;
                        end;
                    }


            ?>
                    <tr>
                        <th>商品名稱</th>
                        <th>剩餘數量</th>
                        <th>銷售數量</th>
                        <th>商品狀態</th>
                    </tr>
                    <?php
                    $result = mysqli_query($link, $getreport);

                    while ($row = mysqli_fetch_assoc($result)) {
                        //商品若是為刪除則跳過
                        if ($row['itemState'] == 4)
                            continue;
                        // var_dump($row);
                    ?>
                        <tr>
                            <td><?= $row['itemName'] ?></td>
                            <td><?= $row['remainCount'] ?></td>
                            <td>
                                <?php
                                if ($row['sum(od.itemCount)'] == NULL && $etime != NULL && $stime != NULL)
                                    echo "--";
                                else if ($etime != NULL && $stime != NULL)
                                    echo $row['sum(od.itemCount)'];
                                else
                                    echo $row['saleOut'];
                                ?></td>
                            <td>
                                <?php
                                if ($row['itemState'] == 1)
                                    echo "上架中";
                                else if ($row['itemState'] == 2)
                                    echo "已下架";
                                else
                                    echo "缺貨中";
                                ?>
                            </td>
                        </tr>
                    <?php
                    }
                } else if ($_POST['type'] == "收入表") {
                    if ($etime != NULL && $stime != NULL) {
                    ?>
                        <h2 style="text-align:center"><?= "開始日期:" . $stime . "~結束日期:" . $etime; ?></h2>
                    <?php
                        $getreport = <<<end
                            select DISTINCT i.itemName,sum(total),sum(itemcount),sum(itemcount)*i.itemPrice as itotal
                            from orderList as o JOIN itemList as i JOIN orderDetail as od on o.orderId=od.orderId and i.itemName=od.itemName
                            where o.finishYN='Y'AND o.finishDate between "$stime" AND "$etime" GROUP BY i.itemName,i.itemPrice
                            end;
                    } else {
                        $getreport = <<<end
                            select DISTINCT i.itemName,sum(itemcount),sum(itemcount)*i.itemPrice as itotal
                            from orderList as o JOIN itemList as i JOIN orderDetail as od on o.orderId=od.orderId and i.itemName=od.itemName
                            where o.finishYN='Y' GROUP BY i.itemName,i.itemPrice
                            end;
                    }
                    // echo $getreport;
                    $result = mysqli_query($link, $getreport);
                    $proName = array();
                    $prostotal = array();
                    $proscount = array();
                    $all = 0;
                    while ($row = mysqli_fetch_assoc($result)) {
                        array_push($proName, $row['itemName']);
                        array_push($prostotal, $row['itotal']);
                        array_push($proscount, $row['sum(itemcount)']);
                        $all += $row['itotal'];
                    }
                    $name = json_encode($proName);
                    $price = json_encode($prostotal);
                    $count = json_encode($proscount);
                    ?>
                    <p style="text-align:center; font-size:30px"><?= "總收入為:" . $all ?></p>
                    <canvas id="myChart" width="400" height="400">

                    </canvas>
                    <script>
                        var ctx = document.getElementById('myChart').getContext('2d');
                        var myChart = new Chart(ctx, {
                            type: 'bar',
                            data: {
                                //銷售
                                labels: <?= $name ?>,
                                datasets: [{
                                        label: "銷售金額",

                                        data: <?= $price ?>,
                                        backgroundColor: 'rgba(54, 162, 235, 0.2)',
                                        borderColor: 'rgba(54, 162, 235, 1)',
                                        borderWidth: 1
                                    },
                                    {
                                        label: "銷售數量",

                                        data: <?= $count ?>,
                                        backgroundColor: 'rgba(225, 198, 175, 0.2)',
                                        borderColor: 'rgba(225, 198, 175, 1)',
                                        borderWidth: 1
                                    }

                                ]
                            },
                            options: {
                                scales: {
                                    yAxes: [{
                                        ticks: {
                                            beginAtZero: true
                                        }
                                    }]
                                }
                            }
                        });
                    </script>
                <?php

                } else if ($_POST['type'] == "支出表") {
                    if ($etime != NULL && $stime != NULL) {
                        //找出品項的花費
                        $getreport = <<<end
                        select DISTINCT i.itemName,sum(itemcount)*i.itemmMaterial as ctotal
                        from orderList as o JOIN itemList as i JOIN orderDetail as od on o.orderId=od.orderId and i.itemName=od.itemName
                        where o.finishYN='Y'AND o.finishDate between "$stime" AND "$etime"
                        GROUP BY i.itemName,i.itemmMaterial
                        end;
                    } else {
                        $getreport = <<<end
                        select DISTINCT i.itemName,sum(itemcount)*i.itemmMaterial as ctotal
                        from orderList as o JOIN itemList as i JOIN orderDetail as od on o.orderId=od.orderId and i.itemName=od.itemName
                        where o.finishYN='Y' 
                        GROUP BY i.itemName,i.itemmMaterial
                        end;
                    }
                    //人事成本 扣掉不再職位上的
                    $getmemberreport = <<<end
                    SELECT mr.rankSalary,m.memberName 
                    from memberList as m JOIN mRank as mr on m.rankId=mr.rankId 
                    where memberYN="Y";
                    end;
                    $proName = array();
                    $cost = array();
                    $memName = array();
                    $memcost = array();
                    $all = 0;
                    $mall=0;
                    //將品項支出放入陣列
                    $result1 = mysqli_query($link, $getreport);
                    $result2 = mysqli_query($link, $getmemberreport);
                    while ($row = mysqli_fetch_assoc($result1)) {
                        array_push($proName, $row['itemName']);
                        array_push($cost, $row['ctotal']);
                        $all += $row['ctotal'];
                    }
                    while ($row = mysqli_fetch_assoc($result2)) {
                        array_push($memName, $row['memberName']);
                        array_push($memcost, $row['rankSalary']);
                        $mall += $row['rankSalary'];
                    }
                    //看報表除以天數
                    if($etime != NULL && $stime != NULL)
                    {
                        //一天員工花費
                        $mall/=30;
                        (int)$mall*=((strtotime($etime) -strtotime($stime))/(60*60*24));
                        for($i=0;$i<count($memcost);$i++)
                        {
                            $memcost[$i]=(int)($memcost[$i]/30);
                            $memcost[$i]*=((strtotime($etime) -strtotime($stime))/(60*60*24));
                            // echo $memcost[$i]."<br>";
                        }
                    }
                    
                    $all+=(int)$mall;
                    $pName = json_encode($proName);
                    $mName = json_encode($memName);
                    $c = json_encode($cost);
                    $mc = json_encode($memcost);
                    //顯示圖表
                ?>
                    <p style="text-align:center; font-size:30px"><?= "總支出為:" . $all ?></p>
                    <canvas id="myChart" width="400" height="400"> </canvas>
                    <script>
                        var ctx = document.getElementById('myChart').getContext('2d');
                        var myChart = new Chart(ctx, {
                            type: 'bar',
                            data: {
                                //花費
                                labels: <?= $pName ?>,
                                datasets: [{
                                    label: "物料花費",

                                    data: <?= $c ?>,
                                    backgroundColor: 'rgba(54, 162, 235, 0.2)',
                                    borderColor: 'rgba(54, 162, 235, 1)',
                                    borderWidth: 1
                                }]
                            },
                            options: {
                                scales: {
                                    yAxes: [{
                                        ticks: {
                                            beginAtZero: true
                                        }
                                    }]
                                }
                            }
                        });
                    </script>
                    <canvas id="myChart2" width="400" height="400"> </canvas>
                    <script>
                        var ctx = document.getElementById('myChart2').getContext('2d');
                        var myChart = new Chart(ctx, {
                            type: 'bar',
                            data: {
                                //花費
                                labels: <?= $mName ?>,
                                datasets: [{
                                        label: "人事花費",

                                        data: <?= $mc ?>,
                                        backgroundColor: 'rgba(225, 198, 175, 0.2)',
                                        borderColor: 'rgba(225, 198, 175, 1)',
                                        borderWidth: 1
                                    }

                                ]
                            },
                            options: {
                                scales: {
                                    yAxes: [{
                                        ticks: {
                                            beginAtZero: true
                                        }
                                    }]
                                }
                            }
                        });
                    </script>
            <?php
                }
            }
            //以1天 7天 30天為單位的報表
            if (isset($_POST['day'])) {
            } else if (isset($_POST['7day'])) {
            } else if (isset($_POST['month'])) {
            }
            ?>

        </table>
    </div>
</body>

</html>