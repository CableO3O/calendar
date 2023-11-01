<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        table,tr,td{
            border: 1px solid black;
            border-collapse: collapse;
        }
        table{
            margin: auto;
        }
        td{text-align: center;}
    </style>
</head>
<body>

<?php
$year=date("Y");
$month=date("m");
$monthfirstday=date("$year-$month-1");
$monthfirstdate=date("w",strtotime($monthfirstday));
$monthspaceday=date("Y-m-d",strtotime("-$monthfirstdate days",strtotime($monthfirstday)));
$monthdays=date("t");
$monthlastday=date("$year-$month-$monthdays");
$monthweeks=ceil(($monthdays+$monthfirstdate)/7);

?>
<div class="container">
<table>
    <tr>
        <th >日</th>
        <th>一</th>
        <th>二</th>
        <th>三</th>
        <th>四</th>
        <th>五</th>
        <th>六</th>
    </tr>
    <?php
    for ($i=0; $i <$monthweeks ; $i++) { 
        echo "<tr>";
        for ($j=0; $j <7 ; $j++) { 
            $addday=7*$i+$j;
            $monthallday=strtotime("+$addday days",strtotime($monthspaceday));
            if(date("w",$monthallday)==0||date("w",$monthallday)==6){
                echo "<td style='color:red' >";
            }else{
                echo "<td>";
            }
            if (date("m",$monthallday)==date("m",strtotime($monthfirstday))) {
                echo date("j",$monthallday);
            }
            echo "</td>";
        }
        echo "</tr>";
    }
echo "</table>";
    ?>
</div>
<div class="switch">
    <a href="">上一個月</a>
    <a href="">下一個月</a>
</div>
</body>
</html>

